<?php

namespace App\Http\Controllers\main\cashandbank;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;

class BanksController extends Controller
{
    public function index() {
        return view('main.cashandbank.banks');
    }

    public function addBankAccount() {
        return view('main.cashandbank.add-bank-account');
    }

    public function viewAccountDetails() {
        return view('main.cashandbank.account-details');
    }
}