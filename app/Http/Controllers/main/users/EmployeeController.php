<?php

namespace App\Http\Controllers\main\users;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;

class EmployeeController extends Controller
{
    public function index(Request $request) {
        $outlets = DB::table('outlets')->select(['id', 'organization_name'])->get();


        // TODO: sales db need to be connect for bill count , sale amount and last sale date


        $query = DB::table('employees')->leftJoin('outlets', 'employees.outlet_id', '=', 'outlets.id')
        ->select(
            'employees.*',
            'outlets.organization_name'
        );

        if ($request->has('search') && !empty($request->search)) {
            $query->where('employees.name', 'like', '%' . $request->search . '%');
        }

        $employees = $query->paginate(15);

        return view('main.users.employeelist',['outlets'=>$outlets,'employees'=>$employees]);
    }

    public function createEmployee() {
        $outlets = DB::table('outlets')->select(['id', 'organization_name'])->get();
        return view('main.users.createemployee',compact('outlets'));
    }


    public function saveEmployeeToDatabase(Request $req) {
        
        // Validating the input
        $req->validate([
            'first_name' => 'required|string|max:50',
            'last_name' => 'required|string|max:50',
            'email' => 'required|unique:employees,email|email',
            'mobile' => 'required|numeric|unique:employees,mobile|digits:10',
            'whatsapp_number' => 'required|numeric|unique:employees,mobile|digits:10',
            'address' => 'required|string|max:100',
            'outlet_id' => 'required|exists:outlets,id',
        ]);

        
        if (!Auth::check()) {
            return redirect()->route('admin.login')->with('error', 'You must be logged in to create a unit.');
        }

        // Inserting Tax using DB class
        DB::table('employees')->insert([
            'first_name' => $req->first_name,
            'last_name' => $req->last_name,
            'email' => $req->email,
            'mobile' => $req->mobile,
            'whatsapp_number' => $req->whatsapp_number,
            'address' => $req->address,
            'outlet_id' => $req->outlet_id,
            'created_at' => now(),
            'updated_at' => now()
        ]);

        return redirect()->back()->with('success', 'Registered successfully!');
    }


    // TODO: update, delete employee not completed


    public function updateEmployeeToDatabase(Request $req) {
        
        // Validating the input
        $req->validate([
            'first_name' => 'required|string|max:50',
            'last_name' => 'required|string|max:50',
            'email' => 'required|email|unique:employees,email,'.$req->id,
            'mobile' => 'required|numeric|digits:10|unique:employees,mobile,'.$req->id,
            'whatsapp_number' => 'required|numeric|digits:10|unique:employees,mobile,'.$req->id,
            'address' => 'required|string|max:100',
            'outlet_id' => 'required|exists:outlets,id',
        ]);
         // Fetch employees record
        $employee = DB::table('employees')->where('id', $req->id)->first();

        if (!$employee) {
            return redirect()->back()->with('error', 'Employee not found!');
        }

        // Inserting Tax using DB class
        DB::table('employees')->where('id', $req->id)->update([
            'first_name' => $req->first_name,
            'last_name' => $req->last_name,
            'email' => $req->email,
            'mobile' => $req->mobile,
            'whatsapp_number' => $req->whatsapp_number,
            'address' => $req->address,
            'outlet_id' => $req->outlet_id,
            'updated_at' => now()
        ]);

        return redirect()->back()->with('success', 'Updated successfully!');
    }


    public function deleteEmployeeToDatabase(Request $req){ 
        $employees = DB::table('employees')->where('id', $req->id)->first();
        if (!$employees) {
            return redirect()->back()->with('error', 'Employee not found!');
        }
        DB::table('employees')->where('id', $req->id)->delete();
        return redirect()->back()->with('success', 'Employee deleted successfully!');
    }

}