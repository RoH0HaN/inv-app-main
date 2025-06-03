<?php

namespace App\Http\Controllers\main;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;

class CustomerController extends Controller
{
    public function index() {
        return view('main.contacts.customers');
    }

    public function createCustomer() {
        return view('main.contacts.createcustomer');
    }
}
