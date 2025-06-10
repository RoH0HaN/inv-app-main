<?php

namespace App\Http\Controllers\main;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;

class BrandListController extends Controller
{
    public function index(Request $request) {

        $query = DB::table('brands')->leftJoin('users', 'brands.created_by_id', '=', 'users.id')
        ->select(
            'brands.*',
            'users.first_name',
            'users.last_name'
        );

        if ($request->has('search') && !empty($request->search)) {
            $query->where('brands.name', 'like', '%' . $request->search . '%');
        }

        $brands = $query->paginate(15);

        return view('main.items.brandlist',compact('brands'));
    }

    public function createBrand() {
        return view('main.items.createbrand');
    }

    public function saveBrandToDatabase(Request $req) {

        // Validating the input
        $req->validate([
            'name' => 'required|string|max:20',
            'description' => 'required|string|max:100',
        ]);

        
        if (!Auth::check()) {
            return redirect()->route('admin.login')->with('error', 'You must be logged in to create a brand.');
        }

        // Inserting Tax using DB class
        DB::table('brands')->insert([
            'name' => $req->name,
            'display_name' => strtoupper($req->name),
            'description' => $req->description,
            'created_by_id' => Auth::id(),
            'created_at' => now(),
            'updated_at' => now()
        ]);

        return redirect()->back()->with('success', 'Registered successfully!');
    }

    public function updateBrandToDatabase(Request $req) {

        // Validating the input
        $req->validate([
            'name' => 'required|string|max:20',
            'description' => 'required|string|max:100',
        ]);

        // Fetch brands record
        $brands = DB::table('brands')->where('id', $req->id)->first();

        if (!$brands) {
            return redirect()->back()->with('error', 'Brand not found!');
        }

        // Inserting Tax using DB class
        DB::table('brands')->where('id', $req->id)->update([
            'name' => $req->name,
            'description' => $req->description,
            'display_name' => strtoupper($req->name),
            'updated_at' => now()
        ]);

        return redirect()->back()->with('success', 'Updated successfully!');
    }


      public function deleteBrandToDatabase(Request $req){
        // Fetch warehouse record
        $brands = DB::table('brands')->where('id', $req->id)->first();
        if (!$brands) {
            return redirect()->back()->with('error', 'Brand not found!');
        }
        DB::table('brands')->where('id', $req->id)->delete();
        return redirect()->back()->with('success', 'Brand deleted successfully!');
    }
}