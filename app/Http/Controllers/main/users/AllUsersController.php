<?php

namespace App\Http\Controllers\main\users;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;

class AllUsersController extends Controller
{
    public function index() {
        return view('main.users.userslist');
    }

    public function createUser() {
        return view('main.users.createuser');
    }
}