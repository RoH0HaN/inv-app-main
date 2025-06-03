<?php

namespace App\Http\Controllers\main\cashandbank;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;

class CashInHandController extends Controller
{
    public function index() {
        return view('main.cashandbank.cashinhand');
    }
}