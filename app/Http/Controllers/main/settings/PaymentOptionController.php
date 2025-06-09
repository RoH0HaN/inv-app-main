<?php

namespace App\Http\Controllers\main\settings;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;

class PaymentOptionController extends Controller
{
    public function index(Request $request) {
        $query = DB::table('payment_options')->leftJoin('users', 'payment_options.created_by_id', '=', 'users.id')
        ->select(
            'payment_options.*',
            'users.first_name',
            'users.last_name'
        );

        if ($request->has('search') && !empty($request->search)) {
            $query->where('payment_options.name', 'like', '%' . $request->search . '%');
        }

        $paymentOptions = $query->paginate(15);

        return view('main.settings.payment-options',compact('paymentOptions'));
    }

    public function createPaymentOption() {
        return view('main.settings.create-payment-option');
    }

    
    public function savePaymentOptionToDatabase(Request $req) {

        // Validating the input
        $req->validate([
            'name' => 'required|string|max:20',
            'description' => 'required|string|max:100',
        ]);

        
        if (!Auth::check()) {
            return redirect()->route('admin.login')->with('error', 'You must be logged in to create a Payment Options.');
        }

        // Inserting Tax using DB class
        DB::table('payment_options')->insert([
            'name' => $req->name,
            'display_name' => strtoupper($req->name),
            'description' => $req->description,
            'created_by_id' => Auth::id(),
            'created_at' => now(),
            'updated_at' => now()
        ]);

        return redirect()->back()->with('success', 'Registered successfully!');
    }


    public function updatePaymentOptionToDatabase(Request $req) {

        // Validating the input
        $req->validate([
            'name' => 'required|string|max:20',
            'description' => 'required|string|max:100',
        ]);

        // Fetch Payment Options record
        $paymentOptions = DB::table('payment_options')->where('id', $req->id)->first();

        if (!$paymentOptions) {
            return redirect()->back()->with('error', 'Payment Options not found!');
        }

        // Inserting Tax using DB class
        DB::table('payment_options')->where('id', $req->id)->update([
            'name' => $req->name,
            'display_name' => strtoupper($req->name),
            'description' => $req->description,
            'updated_at' => now()
        ]);

        return redirect()->back()->with('success', 'Updated successfully!');
    }


      public function deletePaymentOptionToDatabase(Request $req){
        // Fetch warehouse record
        $units = DB::table('payment_options')->where('id', $req->id)->first();
        if (!$units) {
            return redirect()->back()->with('error', 'Payment Options not found!');
        }
        DB::table('payment_options')->where('id', $req->id)->delete();
        return redirect()->back()->with('success', 'Payment Options deleted successfully!');
    }
}