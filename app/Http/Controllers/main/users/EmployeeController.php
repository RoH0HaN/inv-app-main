<?php

namespace App\Http\Controllers\main\users;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;

class EmployeeController extends Controller
{
    public function index() {
        return view('main.users.employeelist');
    }

    public function createEmployee() {
        return view('main.users.createemployee');
    }
}