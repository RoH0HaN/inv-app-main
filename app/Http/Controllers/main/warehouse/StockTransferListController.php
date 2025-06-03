<?php

namespace App\Http\Controllers\main\warehouse;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;

class StockTransferListController extends Controller
{
    public function index() {
        return view('main.warehouse.stocktransferlist');
    }

    public function newTransfer() {
        return view('main.warehouse.newtransfer');
    }
}