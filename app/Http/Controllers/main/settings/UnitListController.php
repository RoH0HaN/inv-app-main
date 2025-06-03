<?php

namespace App\Http\Controllers\main\settings;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;

class UnitListController extends Controller
{
    public function index() {
        return view('main.settings.unitlist');
    }

    public function createUnit() {
        return view('main.settings.createunit');
    }
}