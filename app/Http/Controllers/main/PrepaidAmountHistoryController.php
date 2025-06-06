<?php

namespace App\Http\Controllers\main;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;
use PhpParser\Node\Expr\Cast\Double;

class PrepaidAmountHistoryController extends Controller
{
    public function index($id = null, Request $request) {

        if (!$id) {
            return redirect()->back()->with('error', 'Customer id not provided.');
        }

        $customer = DB::table('customers')->where('id', $id)->first();
        if (!$customer) {
            return redirect()->back()->with('error', 'Customer not found.');
        }
    
        // Build query to fetch prepaid amount transactions
        $query = DB::table('prepaid_amount_transactions')
            ->leftJoin('users', 'prepaid_amount_transactions.created_by_id', '=', 'users.id')
            ->where('prepaid_amount_transactions.customer_id', $id)
            ->select(
                'prepaid_amount_transactions.*',
                'users.first_name as created_by_first_name',
                'users.last_name as created_by_last_name'
            )
            ->orderBy('prepaid_amount_transactions.date', 'desc');
    
        // Apply search filter if present
        if ($request->has('search') && !empty($request->search)) {
            $search = $request->search;
    
            $query->where(function ($q) use ($search) {
                $q->where('prepaid_amount_transactions.note', 'like', '%' . $search . '%')
                  ->orWhere('prepaid_amount_transactions.referral_number', 'like', '%' . $search . '%')
                  ->orWhere('prepaid_amount_transactions.date', 'like', '%' . $search . '%')
                  ->orWhere('prepaid_amount_transactions.particular', 'like', '%' . $search . '%');
            });
        }
    
        // Paginate the result
        $prepaidAmountTransactions = $query->paginate(15)->withQueryString();
    
        return view('main.customer.prepaidamounthistory', [
            'customer' => $customer,
            'prepaidAmountTransactions' => $prepaidAmountTransactions
        ]);
    }

    public function prepaidAmountEntry($id = null) {
        $tcsTds = json_decode(json_encode([
            [
                'id' => 1,
                'name' => 'TCS@0.01%',
                'rate' => 0.01,
                'type' => 'tcs'
            ],
            [
                'id' => 2,
                'name' => 'TCS@0.02%',
                'rate' => 0.02,
                'type' => 'tcs'
            ],
            [
                'id' => 3,
                'name' => 'TDS@0.01%',
                'rate' => 0.01,
                'type' => 'tds'
            ],
            [
                'id' => 4,
                'name' => 'TDS@0.02%',
                'rate' => 0.02,
                'type' => 'tds'
            ],
        ]), false); // <- false means decode as objects

        $customers = DB::table('customers')->select(['id', 'first_name', 'last_name'])->get();

        return view('main.customer.prepaidamountentryfrom',['tcsTds' => $tcsTds, 'customers' => $customers, 'selectedCustomerId' => $id]);
        
    }

    public function savePrepaidAmountEntryToDatabase(Request $req) {
        $req->validate([
            'date' => 'required',
            'customer_id' => 'required',
            'particular' =>'required',
            'tcs_tds' => 'required',
            'amount' =>'required',
            'note' => 'required',
            'referral_number' =>'required'
        ]);

        DB::table('prepaid_amount_transactions')->insert([
            'date' => $req->date,
            'customer_id' => $req->customer_id,
            'particular' => $req->particular,
            'tcs_tds' => $req->tcs_tds,
            'amount' => $req->amount,
            'note' => $req->note,
            'referral_number' => $req->referral_number,
            'created_by_id' => Auth::id(),
            'created_at' => now(),
            'updated_at' => now()
        ]);

        if (!$this->updateCustomerBalance((float) $req->amount, $req->customer_id)) {
            return redirect()->back()->with('error', 'Could not update balance.');
        }        

        return redirect()->back()->with('success', 'Prepaid amount entry saved successfully!');
    }

    public function updateCustomerBalance(float $amount, int $customerId): bool {
        $customer = DB::table('customers')->where('id', $customerId)->first();

        if (!$customer) {
            return false;
        }

        $dueAmount = (float) $customer->due_amount;
        $advanceAmount = (float) $customer->advance_amount;
        $dueDate = $customer->due_date;

        if ($dueAmount > 0) {
            if ($amount >= $dueAmount) {
                $amount -= $dueAmount;
                $dueAmount = 0;
                $dueDate = null; // Clear due date since no dues left
            } else {
                $dueAmount -= $amount;
                $amount = 0;
            }
        }

        $advanceAmount += $amount; // Add leftover to advance

        return DB::table('customers')->where('id', $customerId)->update([
            'advance_amount' => $advanceAmount,
            'due_amount' => $dueAmount,
            'due_date' => $dueDate,
            'updated_at' => now(),
        ]) > 0;
    }

}
