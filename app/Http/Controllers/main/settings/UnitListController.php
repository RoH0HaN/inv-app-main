<?php

namespace App\Http\Controllers\main\settings;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;

class UnitListController extends Controller
{
    public function index(Request $request) {

        $query = DB::table('units')->leftJoin('users', 'units.created_by_id', '=', 'users.id')
        ->select(
            'units.*',
            'users.first_name',
            'users.last_name'
        );

        if ($request->has('search') && !empty($request->search)) {
            $query->where('units.name', 'like', '%' . $request->search . '%');
        }

        $units = $query->paginate(15);

        return view('main.settings.unit_list',compact('units'));
    }

    public function createUnit() {
        return view('main.settings.create_unit');
    }

    public function saveUnitToDatabase(Request $req) {

        // Validating the input
        $req->validate([
            'name' => 'required|string|max:20',
            'description' => 'required|string|max:100',
        ]);

        
        if (!Auth::check()) {
            return redirect()->route('admin.login')->with('error', 'You must be logged in to create a unit.');
        }

        // Inserting Tax using DB class
        DB::table('units')->insert([
            'name' => $req->name,
            'code' => strtoupper($req->name),
            'description' => $req->description,
            'created_by_id' => Auth::id(),
            'created_at' => now(),
            'updated_at' => now()
        ]);

        return redirect()->back()->with('success', 'Registered successfully!');
    }

    public function updateUnitToDatabase(Request $req) {

        // Validating the input
        $req->validate([
            'name' => 'required|string|max:20',
            'description' => 'required|string|max:100',
        ]);

        // Fetch units record
        $units = DB::table('units')->where('id', $req->id)->first();

        if (!$units) {
            return redirect()->back()->with('error', 'Unit not found!');
        }

        // Inserting Tax using DB class
        DB::table('units')->where('id', $req->id)->update([
            'name' => $req->name,
            'description' => $req->description,
            'code' => strtoupper($req->name),
            'updated_at' => now()
        ]);

        return redirect()->back()->with('success', 'Updated successfully!');
    }


      public function deleteUnitToDatabase(Request $req){
        // Fetch warehouse record
        $units = DB::table('units')->where('id', $req->id)->first();
        if (!$units) {
            return redirect()->back()->with('error', 'Unit not found!');
        }
        DB::table('units')->where('id', $req->id)->delete();
        return redirect()->back()->with('success', 'Unit deleted successfully!');
    }

}