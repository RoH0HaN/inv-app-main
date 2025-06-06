<?php

namespace App\Http\Controllers\main\settings;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;

class TaxRatesController extends Controller
{
    public function index(Request $request) {

        $query = DB::table('tax_rates')->leftJoin('users', 'tax_rates.created_by_id', '=', 'users.id')
        ->select(
            'tax_rates.*',
            'users.first_name',
            'users.last_name'
        );

        if ($request->has('search') && !empty($request->search)) {
            $query->where('tax_rates.name', 'like', '%' . $request->search . '%');
        }

        $taxes = $query->paginate(15);

        return view('main.settings.taxrates',compact('taxes'));
    }

    public function createTax() {
        return view('main.settings.createtax');
    }

    public function saveTaxToDatabase(Request $req) {

        // Validating the input
        $req->validate([
            'name' => 'required|string|max:20',
            'rate' => 'required|numeric',
        ]);

        
        if (!Auth::check()) {
            return redirect()->route('admin.login')->with('error', 'You must be logged in to create a warehouse.');
        }

        // Inserting Tax using DB class
        DB::table('tax_rates')->insert([
            'name' => $req->name,
            'rate' => $req->rate,
            'display_name' => strtoupper($req->name),
            'created_by_id' => Auth::id(),
            'created_at' => now(),
            'updated_at' => now()
        ]);

        return redirect()->back()->with('success', 'Registered successfully!');
    }

    public function updateTaxToDatabase(Request $req) {

        // Validating the input
        $req->validate([
            'name' => 'required|string|max:20',
            'rate' => 'required|numeric',
        ]);

        // Fetch tax_rates record
        $tax_rates = DB::table('tax_rates')->where('id', $req->id)->first();

        if (!$tax_rates) {
            return redirect()->back()->with('error', 'Warehouse not found!');
        }

        // Inserting Tax using DB class
        DB::table('tax_rates')->where('id', $req->id)->update([
            'name' => $req->name,
            'rate' => $req->rate,
            'display_name' => strtoupper($req->name),
            'updated_at' => now()
        ]);

        return redirect()->back()->with('success', 'Updated successfully!');
    }

}