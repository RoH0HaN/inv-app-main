<?php

namespace App\Http\Controllers\main;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;

class PurchaseBillsController extends Controller
{
    public function index() {
        return view('main.purchase.purchasebills');
    }

    public function createPurchase() {
        return view('main.purchase.createpurchase');
    }
}