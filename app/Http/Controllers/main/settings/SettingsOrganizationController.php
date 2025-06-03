<?php

namespace App\Http\Controllers\main\settings;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;

class SettingsOrganizationController extends Controller
{
    public function index() {
        return view('main.settings.organization');
    }
}