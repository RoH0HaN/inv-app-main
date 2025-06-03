<?php

namespace App\Http\Controllers\admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;

class AdminForgotPasswordController extends Controller
{
    public function forgotPassword() {
        return view('admin.forgotpassword');
    }
}