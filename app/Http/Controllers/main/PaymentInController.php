<?php

namespace App\Http\Controllers\main;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;

class PaymentInController extends Controller
{
    public function index() {
        return view('main.sale.paymentin');
    }
}
