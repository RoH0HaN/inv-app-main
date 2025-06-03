<?php

namespace App\Http\Controllers\main\settings;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;

class TcsTdsRatesController extends Controller
{
    public function index() {
        return view('main.settings.tcs-tds-rates');
    }

    public function createTcsTds() {
        return view('main.settings.create-tcs-tds');
    }
}