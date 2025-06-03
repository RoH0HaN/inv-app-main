<?php

namespace App\Http\Controllers\main;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;

class CategoryListController extends Controller
{
    public function index() {
        return view('main.items.categorylist');
    }

    public function createCategory() {
        return view('main.items.createcategory');
    }
}