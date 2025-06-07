<?php

namespace App\Http\Controllers\main;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;

class CustomerController extends Controller
{
    public function index(Request $request) {
        $query = DB::table('customers')
            ->leftJoin('users', 'customers.created_by_id', '=', 'users.id')
            ->select(
                'customers.*',
                'users.first_name as created_by_first_name',
                'users.last_name as created_by_last_name'
            );


            if ($request->has('search') && !empty($request->search)) {
                $searchTerm = $request->search;
            
                $query->where(function ($q) use ($searchTerm) {
                    $q->where('customers.first_name', 'like', '%' . $searchTerm . '%')
                      ->orWhere('customers.last_name', 'like', '%' . $searchTerm . '%')
                      ->orWhere('customers.email', 'like', '%' . $searchTerm . '%')
                      ->orWhere('customers.mobile', 'like', '%' . $searchTerm . '%')
                      ->orWhere('customers.whatsapp_number', 'like', '%' . $searchTerm . '%')
                      ->orWhere('customers.address', 'like', '%' . $searchTerm . '%');
                });
            }
            

        $customers = $query->paginate(15);
        return view('main.contacts.customers', ['customers' => $customers]);
    }

    public function createCustomer() {
        return view('main.contacts.createcustomer');
    }

    public function saveCustomerToDatabase(Request $req){
        $req->validate([
            'first_name' => 'required|min:3|max:50',
            'last_name' => 'required|min:3|max:50',
            'email' => 'required|email|unique:customers',
            'mobile' => 'required|min:10|max:12|unique:customers',
            'whatsapp_number' => 'required|min:10|max:12|unique:customers',
            'address' => 'required',
            'opening_balance' => 'required|numeric',
            'opening_balance_type' => 'required|in:to_receive,to_pay',
            'credit_period' => 'required|integer',
        ]);

        try {
            DB::transaction();

            $customerId = DB::table('customers')->insert([
                'first_name' => $req->first_name,
                'last_name' => $req->last_name,
                'email' => $req->email,
                'mobile' => $req->mobile,
                'whatsapp_number' => $req->whatsapp_number,
                'address' => $req->address,
                'opening_balance_type' => $req->opening_balance_type,
                'due_amount' => $req->opening_balance_type == 'to_receive' ? (double) $req->opening_balance : 0,
                'advance_amount' => $req->opening_balance_type == 'to_pay' ? (double) $req->opening_balance : 0,
                'due_date' => $req->opening_balance_type == 'to_receive' && (double) $req->opening_balance > 0
                    ? now()->addDays((int) $req->credit_period)
                    : null,
                'credit_period' => (int) $req->credit_period,
                'credit_limit' => (double) $req->credit_limit ?? 0,
                'created_by_id' => Auth::id(),
                'created_at' => now(),
                'updated_at' => now(),
            ]);

            DB::table('credit_infos')->insert([
                'customer_id' => $customerId,
                'opening_balance' => (double) $req->opening_balance,
                'opening_balance_type' => $req->opening_balance_type,
                'credit_period' => 0,
                'credit_limit' => (double) $req->credit_limit?? 0,
                'created_at' => now(),
                'updated_at' => now(),
            ]);

            DB::commit();
    
            return redirect()->back()->with('success', 'Customer created successfully!');
        } catch (\Throwable $e) {
            DB::rollback();
            return redirect()->back()->with('error', 'Failed to create customer!');
        }
    }

    public function updateCustomer(Request $req){
        // Fetch warehouse record
        $customer = DB::table('customers')->where('id', $req->id)->first();
        if (!$customer) {
            return redirect()->back()->with('error', 'Customer not found!');
        }
        
        // validating the data
        $req->validate([
            'first_name' => 'required|min:3|max:50',
            'last_name' => 'required|min:3|max:50',
            'email' => 'required|email|unique:customers,email,' . $req->id,
            'mobile' => 'required|min:10|max:12|unique:customers,mobile,' . $req->id,
            'whatsapp_number' => 'required|min:10|max:12|unique:customers,whatsapp_number,' . $req->id,
            'address' => 'required',
            'opening_balance' => 'required|numeric',
            'opening_balance_type' => 'required|in:to_receive,to_pay',
            'credit_period' => 'required|integer',
            'credit_limit' =>'required|integer',
        ]);

        try {
            DB::transaction();

            $updatedCustomer = DB::table('customers')->where('id', $req->id)->update([
                'first_name' => $req->first_name,
                'last_name' => $req->last_name,
                'email' => $req->email,
                'mobile' => $req->mobile,
                'whatsapp_number' => $req->whatsapp_number,
                'address' => $req->address,
                'opening_balance_type' => $req->opening_balance_type,
                'due_amount' => $req->opening_balance_type == 'to_receive' ? (double) $req->opening_balance : 0,
                'advance_amount' => $req->opening_balance_type == 'to_pay' ? (double) $req->opening_balance : 0,
                'due_date' => $req->opening_balance_type == 'to_receive' && (double) $req->opening_balance > 0
                    ? now()->addDays((int) $req->credit_period)
                    : null,
                'credit_period' => (int) $req->credit_period,
                'credit_limit' => (double) $req->credit_limit ?? 0,
                'updated_at' => now(),
            ]);
    
            $updatedCreditInfo = DB::table('credit_infos')->where('customer_id', $req->id)->update([
                'opening_balance' => (double) $req->opening_balance,
                'opening_balance_type' => $req->opening_balance_type,
                'credit_period' => $req->credit_period,
                'credit_limit' => (double) $req->credit_limit?? 0,
                'updated_at' => now(),
            ]);
    
            if (!$updatedCustomer || !$updatedCreditInfo) {
                DB::rollback();
                return redirect()->back()->with('error', 'Failed to update customer!');
            }
            DB::commit();
            return redirect()->back()->with('success', 'Customer updated successfully!');
        } catch (\Throwable $e) {
            DB::rollback();
            return redirect()->back()->with('error', 'Failed to update customer!');
        }

    }

    public function deleteCustomer(Request $req){
        // Fetch warehouse record
        $customer = DB::table('customers')->where('id', $req->id)->first();
        if (!$customer) {
            return redirect()->back()->with('error', 'Customer not found!');
        }
        DB::table('customers')->where('id', $req->id)->delete();
        return redirect()->back()->with('success', 'Customer deleted successfully!');
    }

}
