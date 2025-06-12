<?php

namespace App\Http\Controllers\main\expenses;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;

class ExpenseTypeController extends Controller
{
    public function index(Request $request) {
        $query = DB::table('expense_types')->leftJoin('users', 'expense_types.created_by_id', '=', 'users.id')
        ->select(
            'expense_types.*',
            'users.first_name',
            'users.last_name'
        );;

        if ($request->has('search') && !empty($request->search)) {
            $searchTerm = $request->search;
        
            $query->where(function ($q) use ($searchTerm) {
                $q->where('expense_types.name', 'like', '%' . $searchTerm . '%')
                  ->orWhere('expense_types.display_name', 'like', '%' . $searchTerm . '%')
                  ->orWhere('expense_types.description', 'like', '%' . $searchTerm . '%');
            });
        }
        

        $expenseTypes = $query->paginate(15);

        return view('main.expenses.expensetype', ['expenseTypes' => $expenseTypes]);
    }

    public function createExpenseType() {
        return view('main.expenses.createexpensetype');
    }

    public function saveExpenseTypeToDatabase(Request $req) {
        $req->validate([
            'name' => 'required',
            'description' => 'required',
        ]);

        $expense_type = DB::table('expense_types')->insert([
            'name' => str($req->name)->lower()->snake(),
            'display_name' => $req->name,
            'description' => $req->description,
            'created_by_id' => Auth::id(),
            'created_at' => now(),
            'updated_at' => now()
        ]);

        if (!$expense_type) {
            return redirect()->back()->withErrors(['expense_type' => 'Expense type not created.']);
        }
        return redirect()->back()->with('success', 'Expense type created successfully!');
    }

    public function updateExpenseType(Request $req) {
        $req->validate([
            'name' =>'required',
            'description' =>'required',
        ]);
        $expenseType = DB::table('expense_types')->where('id', $req->id)->first();
        if (!$expenseType) {
            return redirect()->back()->with('error', 'Expense type not found!');
        }
        $updatedExpenseType = DB::table('expense_types')->where('id', $req->id)->update([
            'name' => str($req->name)->lower()->snake(),
            'display_name' => $req->name,
            'description' => $req->description,
            'updated_at' => now(),
        ]);

        if (!$updatedExpenseType) {
            return redirect()->back()->withErrors(['expense_type' => 'Expense type not updated.']);
        }
        return redirect()->back()->with('success', 'Expense type updated successfully!');

    }

    public function deleteExpenseType(Request $req){ 
        $expenseTypes = DB::table('expense_types')->where('id', $req->id)->first();
        if (!$expenseTypes) {
            return redirect()->back()->with('error', 'Expense type not found!');
        }
        DB::table('expense_types')->where('id', $req->id)->delete();
        return redirect()->back()->with('success', 'Expense type deleted successfully!');
    }
}