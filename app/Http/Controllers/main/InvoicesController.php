<?php

namespace App\Http\Controllers\main;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;

class InvoicesController extends Controller
{
    public function index() {
        return view('main.sale.invoices');
    }

    public function createSale() {
        return view('main.sale.createsale');
    }

    public function completePayment() {
        return view('main.sale.completepayment');
    }
}
