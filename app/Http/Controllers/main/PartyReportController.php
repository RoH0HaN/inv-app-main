<?php

namespace App\Http\Controllers\main;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;

class PartyReportController extends Controller
{
    public function index() {
        return view('main.reports.partyreport');
    }

    public function viewStatement() {
        return view('main.reports.viewstatement');
    }
}
