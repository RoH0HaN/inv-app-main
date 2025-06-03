<?php

namespace App\Http\Controllers\main\target;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;

class OrganizationController extends Controller
{
    public function index() {
        return view('main.target.organizationtarget');
    }

    public function createOrganizationTarget() {
        return view('main.target.createorganizationtarget');
    }
}