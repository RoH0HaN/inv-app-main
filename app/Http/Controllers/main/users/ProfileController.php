<?php

namespace App\Http\Controllers\main\users;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;

class ProfileController extends Controller
{
    public function index() {
        return view('main.users.profile');
    }
}