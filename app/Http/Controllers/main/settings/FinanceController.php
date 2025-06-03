<?php

namespace App\Http\Controllers\main\settings;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;

class FinanceController extends Controller
{
    public function index() {
        return view('main.settings.finances-list');
    }

    public function createFinance() {
        return view('main.settings.create-finance');
    }

    public function viewFinanceDetails() {
        return view('main.settings.finance-details-page');
    }
}