<?php

namespace App\Http\Controllers\main\settings;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;

class PaymentOptionController extends Controller
{
    public function index() {
        return view('main.settings.payment-options');
    }

    public function createPaymentOption() {
        return view('main.settings.create-payment-option');
    }
}