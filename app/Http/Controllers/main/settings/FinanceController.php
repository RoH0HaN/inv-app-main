<?php

namespace App\Http\Controllers\main\settings;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;

class FinanceController extends Controller
{
    public function index(Request $request) {
        $query = DB::table('finance_details')->leftJoin('users', 'finance_details.created_by_id', '=', 'users.id')
        ->select(
            'finance_details.*',
            'users.first_name',
            'users.last_name'
        );

        if ($request->has('search') && !empty($request->search)) {
            $query->where('finance_details.name', 'like', '%' . $request->search . '%');
        }

        $finances = $query->paginate(15);

        return view('main.settings.finances-list',compact('finances'));
    }

    public function createFinance() {
        return view('main.settings.create-finance');
    }

    public function viewFinanceDetails() {
        return view('main.settings.finance-details-page');
    }

        public function saveFinanceToDatabase(Request $req) {

            // print('<pre>');
            // print_r($req->all());
            // print('</pre>');

            // return;
        // Validating the input
        $req->validate([
            'name' => 'required|string|max:50',
            'email' => 'required|string|max:50',
            'whatsapp_number' => 'required|numeric',
            'mobile' => 'required|numeric',
            'opening_balance' => 'required|numeric',
            'opening_balance_type' => 'required|in:to_receive,to_pay',
        ]);

        
        if (!Auth::check()) {
            return redirect()->route('admin.login')->with('error', 'You must be logged in to create a Finances.');
        }

        // Inserting Tax using DB class
        DB::table('finance_details')->insert([
            'name' => $req->name,
            'display_name' => strtoupper($req->name),
            'email' => $req->email,
            'whatsapp_number' => $req->whatsapp_number,
            'mobile' => $req->mobile,
            'opening_balance' => $req->opening_balance,
            'opening_balance_type' => $req->opening_balance_type,
            'created_by_id' => Auth::id(),
            'created_at' => now(),
            'updated_at' => now()
        ]);

        return redirect()->back()->with('success', 'Registered successfully!');
    }


    public function updateFinanceToDatabase(Request $req) {

        // Validating the input
        $req->validate([
            'name' => 'required|string|max:20',
            'email' => 'required|string|max:50',
            'whatsapp_number' => 'required|numeric|max:12',
            'mobile' => 'required|numeric|max:12',
            'opening_balance' => 'required|numeric',
            'opening_balance_type' => 'required|in:to_receive,to_pay',
        ]);

        // Fetch Finances record
        $finances = DB::table('finance_details')->where('id', $req->id)->first();

        if (!$finances) {
            return redirect()->back()->with('error', 'Finances not found!');
        }

        // Inserting Tax using DB class
        DB::table('finance_details')->where('id', $req->id)->update([
            'name' => $req->name,
            'display_name' => strtoupper($req->name),
            'email' => $req->email,
            'whatsapp_number' => $req->whatsapp_number,
            'mobile' => $req->mobile,
            'opening_balance' => $req->opening_balance,
            'opening_balance_type' => $req->opening_balance_type,
            'updated_at' => now()
        ]);

        return redirect()->back()->with('success', 'Updated successfully!');
    }


      public function deleteFinanceToDatabase(Request $req){
        // Fetch warehouse record
        $units = DB::table('finance_details')->where('id', $req->id)->first();
        if (!$units) {
            return redirect()->back()->with('error', 'Finances not found!');
        }
        DB::table('finance_details')->where('id', $req->id)->delete();
        return redirect()->back()->with('success', 'Finances deleted successfully!');
    }
}