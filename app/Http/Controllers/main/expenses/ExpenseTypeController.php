<?php

namespace App\Http\Controllers\main\expenses;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;

class ExpenseTypeController extends Controller
{
    public function index() {
        return view('main.expenses.expensetype');
    }

    public function createExpenseType() {
        return view('main.expenses.createexpensetype');
    }
}