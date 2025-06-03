<?php

namespace App\Http\Controllers\main\target;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;

class OutletController extends Controller
{
    public function index() {
        return view('main.target.outlettarget');
    }

    public function createOutletTarget() {
        return view('main.target.createoutlettarget');
    }
}