<?php

namespace App\Http\Controllers\main\settings;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;

class TcsTdsRatesController extends Controller
{
    public function index(Request $request) {

        $query = DB::table('tcs_tds_rates')->leftJoin('users', 'tcs_tds_rates.created_by_id', '=', 'users.id')
        ->select(
            'tcs_tds_rates.*',
            'users.first_name',
            'users.last_name'
        );

        if ($request->has('search') && !empty($request->search)) {
            $query->where('tcs_tds_rates.name', 'like', '%' . $request->search . '%');
        }

        $tcsTdsRates = $query->paginate(15);

        return view('main.settings.tcs-tds-rates',compact('tcsTdsRates'));
    }

    public function createTcsTds() {
        return view('main.settings.create-tcs-tds');
    }

    public function saveTcsTdsToDatabase(Request $req) {

        // Validating the input
        $req->validate([
            'name' => 'required|string|max:20',
            'rate' => 'required|numeric',
            'type' => 'required|in:tcs,tds',
        ]);

        
        if (!Auth::check()) {
            return redirect()->route('admin.login')->with('error', 'You must be logged in to create a Tcs/Tds.');
        }

        // Inserting Tax using DB class
        DB::table('tcs_tds_rates')->insert([
            'name' => $req->name,
            'display_name' => strtoupper($req->name),
            'rate' => $req->rate,
            'type' => $req->type,
            'created_by_id' => Auth::id(),
            'created_at' => now(),
            'updated_at' => now()
        ]);

        return redirect()->back()->with('success', 'Registered successfully!');
    }

    
    public function updateTcsTdsToDatabase(Request $req) {

        // Validating the input
        $req->validate([
            'name' => 'required|string|max:20',
            'rate' => 'required|numeric',
            'type' => 'required|in:tcs,tds',
        ]);

        // Fetch units record
        $tcsTdsRate = DB::table('tcs_tds_rates')->where('id', $req->id)->first();

        if (!$tcsTdsRate) {
            return redirect()->back()->with('error', 'Tcs/Tds not found!');
        }

        // Inserting Tax using DB class
        DB::table('tcs_tds_rates')->where('id', $req->id)->update([
            'name' => $req->name,
            'display_name' => strtoupper($req->name),
            'rate' => $req->rate,
            'type' => $req->type,
            'updated_at' => now()
        ]);

        return redirect()->back()->with('success', 'Updated successfully!');
    }

     public function deleteTcsTdsToDatabase(Request $req){
        // Fetch warehouse record
        $units = DB::table('tcs_tds_rates')->where('id', $req->id)->first();
        if (!$units) {
            return redirect()->back()->with('error', 'Tcs/Tds not found!');
        }
        DB::table('tcs_tds_rates')->where('id', $req->id)->delete();
        return redirect()->back()->with('success', 'Tcs/Tds deleted successfully!');
    }

}