<?php

namespace App\Http\Controllers\main\warehouse;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;

class WarehouseListController extends Controller
{
    public function index() {
        return view('main.warehouse.warehouseslist');
    }

    public function createWarehouse() {
        return view('main.warehouse.createwarehouse');
    }
}