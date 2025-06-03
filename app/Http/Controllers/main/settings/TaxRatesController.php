<?php

namespace App\Http\Controllers\main\settings;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;

class TaxRatesController extends Controller
{
    public function index() {
        return view('main.settings.taxrates');
    }

    public function createTax() {
        return view('main.settings.createtax');
    }
}