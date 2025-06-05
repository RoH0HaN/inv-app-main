<?php

namespace App\Http\Controllers\main\warehouse;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Str;

class WarehouseListController extends Controller
{
    public function index() {

        $warehouses = DB::table('warehouses')->get();

        // TODO: calculate items, available stock, worth(cost)

        return view('main.warehouse.warehouseslist', ['warehouses' => $warehouses]);
    }

    public function createWarehouse() {
        return view('main.warehouse.createwarehouse');
    }

    public function saveWarehouseToDatabase(Request $req) {
        echo "<pre>";
        print_r($req->all());

        // validating the data
        $req->validate([
            'organization_logo' => 'required|image|mimes:jpeg,png,jpg,gif,svg|max:2048',
            'organization_name' => 'required',
            'mobile' =>'required|unique:warehouses,mobile|numeric|digits:10',
            'alternative_mobile' =>'required|unique:warehouses,mobile|numeric|digits:10',
            'email' =>'required|unique:warehouses,email',
            'tax_number' =>'required|unique:warehouses,tax_number',
            'address' =>'required',
        ]);

        if (!Auth::check()) {
            return redirect()->route('admin.login')->with('error', 'You must be logged in to create a warehouse.');
        }

        // Handling image upload
        $imagePath = null;
        if ($req->hasFile('organization_logo')) {
            $image = $req->file('organization_logo');
            $imageName = Str::uuid() . '.' . $image->getClientOriginalExtension();
            $image->move(public_path('uploads/organization_logos'), $imageName);
            $imagePath = 'uploads/organization_logos/' . $imageName;
        }

        // Inserting user using DB class
        DB::table('warehouses')->insert([
            'organization_logo' => $imagePath,
            'organization_name' => $req->organization_name,
            'mobile' => $req->mobile,
            'alternative_mobile' => $req->alternative_mobile,
            'email' => $req->email,
            'tax_number' => $req->tax_number,
            'address' => $req->address,
            'created_by_id'=> Auth::id()
        ]);

        return redirect()->back()->with('success', 'Warehouse created successfully.');
    }
}