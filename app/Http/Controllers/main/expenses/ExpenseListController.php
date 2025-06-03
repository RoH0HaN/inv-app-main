<?php

namespace App\Http\Controllers\main\expenses;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;

class ExpenseListController extends Controller
{
    public function index() {
        return view('main.expenses.expenselist');
    }

    public function createExpense() {
        return view('main.expenses.createexpense');
    }
}