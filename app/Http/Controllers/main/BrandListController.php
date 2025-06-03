<?php

namespace App\Http\Controllers\main;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;

class BrandListController extends Controller
{
    public function index() {
        return view('main.items.brandlist');
    }

    public function createBrand() {
        return view('main.items.createbrand');
    }
}