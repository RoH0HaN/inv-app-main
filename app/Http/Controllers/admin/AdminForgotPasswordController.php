<?php

namespace App\Http\Controllers\admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;

class AdminForgetPasswordController extends Controller
{
    public function forgetPassword() {
        return view('admin.forgotpassword');
    }
}