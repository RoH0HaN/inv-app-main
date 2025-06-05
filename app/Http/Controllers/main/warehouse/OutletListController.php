<?php

namespace App\Http\Controllers\main\warehouse;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class OutletListController extends Controller
{
    public function index() {
        return view('main.warehouse.outletslist');
    }

    public function createOutlet() {

        $warehouses = DB::table('warehouses')->select(['organization_name', 'id'])->get();

        return view('main.warehouse.createoutlet', ['warehouses' => $warehouses]);
    }
}