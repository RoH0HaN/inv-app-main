<?php

namespace App\Http\Controllers\main\warehouse;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;

class OutletListController extends Controller
{
    public function index() {
        return view('main.warehouse.outletslist');
    }

    public function createOutlet() {
        return view('main.warehouse.createoutlet');
    }
}