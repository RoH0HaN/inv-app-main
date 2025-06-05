<?php

namespace App\Http\Controllers\main\warehouse;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Str;

class WarehouseListController extends Controller
{
    public function index(Request $request){
        $query = DB::table('warehouses')
            ->leftJoin('users', 'warehouses.created_by_id', '=', 'users.id')
            ->select(
                'warehouses.*',
                'users.first_name',
                'users.last_name'
            );

        if ($request->has('search') && !empty($request->search)) {
            $query->where('warehouses.organization_name', 'like', '%' . $request->search . '%');
        }

        $warehouses = $query->paginate(15);

        return view('main.warehouse.warehouseslist', compact('warehouses'));
    }


    public function createWarehouse() {
        return view('main.warehouse.createwarehouse');
    }

    public function saveWarehouseToDatabase(Request $req) {
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
            'created_by_id'=> Auth::id(),
            'created_at' => now(),
            'updated_at' => now(),
        ]);

        return redirect()->back()->with('success', 'Warehouse created successfully.');
    }

    
    public function updateWarehouse(Request $req){
        // validating the data
        $req->validate([
            'organization_name' => 'required',
            'mobile' => 'required|numeric|digits:10',
            'alternative_mobile' => 'required|numeric|digits:10',
            'email' => 'required|email',
            'tax_number' => 'required',
            'address' => 'required',
        ]);

        // Fetch warehouse record
        $warehouse = DB::table('warehouses')->where('id', $req->id)->first();

        if (!$warehouse) {
            return redirect()->back()->with('error', 'Warehouse not found!');
        }

        $imagePath = $warehouse->organization_logo; // keep current logo by default

        if ($req->hasFile('warehouse_image')) {
            // Delete old image if exists
            if ($imagePath && file_exists(public_path($imagePath))) {
                unlink(public_path($imagePath));
            }

            $image = $req->file('warehouse_image');
            $imageName = Str::uuid() . '.' . $image->getClientOriginalExtension();
            $image->move(public_path('uploads/organization_logos'), $imageName);

            $imagePath = 'uploads/organization_logos/' . $imageName; // update path
        }

        // Update the warehouse with new or old image path
        $updatedWarehouse = DB::table('warehouses')->where('id', $req->id)->update([
            'organization_logo' => $imagePath,
            'organization_name' => $req->organization_name,
            'mobile' => $req->mobile,
            'alternative_mobile' => $req->alternative_mobile,
            'email' => $req->email,
            'tax_number' => $req->tax_number,
            'address' => $req->address,
            'updated_at' => now(),
        ]);

        if (!$updatedWarehouse) {
            return redirect()->back()->with('error', 'Failed to update warehouse!');
        }

        return redirect()->back()->with('success', 'Warehouse updated successfully!');
    }

}