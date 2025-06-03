<?php

namespace App\Http\Controllers\main;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;

class PrepaidAmountHistoryController extends Controller
{
    public function index() {
        return view('main.customer.prepaidamounthistory');
    }

    public function prepaidAmountEntry() {
        return view('main.customer.prepaidamountentryfrom');
    }
}
