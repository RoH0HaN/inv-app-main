<?php

namespace App\Http\Controllers\main\warehouse;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Str;

class OutletListController extends Controller
{
    public function index(Request $request) {
        $query = DB::table('outlets')
            ->leftJoin('users', 'outlets.created_by_id', '=', 'users.id')
            ->select(
                'outlets.*',
                'users.first_name',
                'users.last_name'
            );

        if ($request->has('search') && !empty($request->search)) {
            $query->where('outlets.organization_name', 'like', '%' . $request->search . '%');
        }

        $outlets = $query->paginate(15);
        return view('main.warehouse.outletslist', ['outlets' => $outlets]);
    }

    public function createOutlet() {

        // to get the available warehouses to add with outlet
        $warehouses = DB::table('warehouses')->select(['organization_name', 'id'])->get();

        return view('main.warehouse.createoutlet', ['warehouses' => $warehouses]);
    }

    public function saveOutletToDatabase(Request $req) {
        // validating the data
        $req->validate([
            'organization_logo' => 'required|image|mimes:jpeg,png,jpg,gif,svg|max:2048',
            'organization_name' => 'required',
            'mobile' =>'required|unique:warehouses,mobile|numeric|digits:10',
            'alternative_mobile' =>'required|unique:warehouses,mobile|numeric|digits:10',
            'email' =>'required|unique:warehouses,email',
            'tax_number' =>'required|unique:warehouses,tax_number',
            'address' =>'required',
            'warehouse_id' =>'required|exists:warehouses,id',
            'invoice_prefix_gst' =>'required',
            'invoice_prefix_ngst' =>'required',
            'invoice_number_gst' =>'required',
            'invoice_number_ngst' =>'required',
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
        DB::table('outlets')->insert([
            'organization_logo' => $imagePath,
            'organization_name' => $req->organization_name,
            'mobile' => $req->mobile,
            'alternative_mobile' => $req->alternative_mobile,
            'email' => $req->email,
            'tax_number' => $req->tax_number,
            'address' => $req->address,
            'warehouse_id' => $req->warehouse_id,
            'invoice_prefix_gst' => $req->invoice_prefix_gst,
            'invoice_prefix_ngst' => $req->invoice_prefix_ngst,
            'invoice_number_gst' => $req->invoice_number_gst,
            'invoice_number_ngst' => $req->invoice_number_ngst,
            'created_by_id'=> Auth::id(),
            'created_at' => now(),
            'updated_at' => now(),
        ]);

        return redirect()->back()->with('success', 'Outlet created successfully.');
    }
}