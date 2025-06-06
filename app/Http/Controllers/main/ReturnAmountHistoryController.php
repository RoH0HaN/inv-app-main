<?php

namespace App\Http\Controllers\main;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;

class ReturnAmountHistoryController extends Controller
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
        $query = DB::table('return_amount_transactions')
            ->leftJoin('users', 'return_amount_transactions.created_by_id', '=', 'users.id')
            ->where('return_amount_transactions.customer_id', $id)
            ->select(
                'return_amount_transactions.*',
                'users.first_name as created_by_first_name',
                'users.last_name as created_by_last_name'
            )
            ->orderBy('return_amount_transactions.date', 'desc');
    
        // Apply search filter if present
        if ($request->has('search') && !empty($request->search)) {
            $search = $request->search;
    
            $query->where(function ($q) use ($search) {
                $q->where('return_amount_transactions.note', 'like', '%' . $search . '%')
                  ->orWhere('return_amount_transactions.referral_number', 'like', '%' . $search . '%')
                  ->orWhere('return_amount_transactions.date', 'like', '%' . $search . '%')
                  ->orWhere('return_amount_transactions.particular', 'like', '%' . $search . '%');
            });
        }
    
        // Paginate the result
        $returnAmountTransactions = $query->paginate(15)->withQueryString();
    
        return view('main.customer.returnamounthistory', [
            'customer' => $customer,
            'returnAmountTransactions' => $returnAmountTransactions
        ]);
    }

    public function returnAmountEntry($id = null) {
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

        return view('main.customer.returnamountentryfrom',['tcsTds' => $tcsTds, 'customers' => $customers, 'selectedCustomerId' => $id]);
    }

    public function saveReturnAmountEntryToDatabase(Request $req) {
        $req->validate([
            'date' => 'required',
            'customer_id' => 'required',
            'particular' => 'required',
            'tcs_tds' => 'required',
            'amount' => 'required|numeric',
            'note' => 'required',
            'referral_number' => 'required'
        ]);
    
        DB::beginTransaction();
    
        try {
            DB::table('return_amount_transactions')->insert([
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
                DB::rollBack();
                return redirect()->back()->with('error', 'Could not update balance.');
            }
    
            DB::commit();
            return redirect()->back()->with('success', 'Return amount entry saved successfully!');
    
        } catch (\Throwable $e) {
            DB::rollBack();
            return redirect()->back()->with('error', 'Something went wrong. ' . $e->getMessage());
        }
    }

    public function updateCustomerBalance(float $amount, int $customerId): bool {
        $customer = DB::table('customers')->where('id', $customerId)->first();
    
        if (!$customer) {
            return false;
        }
    
        $advance = (float) $customer->advance_amount;
        $due = (float) $customer->due_amount;
        $dueDate = $customer->due_date;
        $creditDays = (int) $customer->credit_period;
    
        // Deduct from advance first
        if ($advance > 0) {
            if ($amount >= $advance) {
                $amount -= $advance;
                $advance = 0;
            } else {
                $advance -= $amount;
                $amount = 0;
            }
        }
    
        // Remaining amount becomes due
        if ($amount > 0) {
            $due += $amount;
            if (!$dueDate) {
                $dueDate = now()->addDays($creditDays)->toDateString();
            }
        } elseif ($due == 0) {
            $dueDate = null;
        }
    
        return DB::table('customers')->where('id', $customerId)->update([
            'advance_amount' => $advance,
            'due_amount' => $due,
            'due_date' => $dueDate,
            'updated_at' => now(),
        ]) > 0;
    }
    
}