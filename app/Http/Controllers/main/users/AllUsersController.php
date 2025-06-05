<?php

namespace App\Http\Controllers\main\users;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Str;

class AllUsersController extends Controller
{
    public function index() {
        return view('main.users.userslist');
    }

    public function createUser() {
        return view('main.users.createuser');
    }

    public function saveUserToDatabase(Request $req) {
        
        // Validating the input
        $req->validate([
            'profile_image' => 'nullable|image|mimes:jpeg,png,jpg,gif|max:2048',
            'first_name' => 'required|string|max:50',
            'last_name' => 'required|string|max:50',
            'username' => 'required|string|max:50',
            'email' => 'required|email|unique:users,email',
            'mobile' => 'required|numeric|digits:10|unique:users,mobile',
            'role' =>'required|string|max:6',
            'status' =>'required|string|max:10'
        ]);

        //Handling image upload
        $imagePath = null;
        if ($req->hasFile('profile_image')) {
            $image = $req->file('profile_image');
            $imageName = Str::uuid() . '.' . $image->getClientOriginalExtension();
            $image->move(public_path('uploads/profile_images'), $imageName);
            $imagePath = 'uploads/profile_images/' . $imageName;
        }

        // Inserting user using DB class
        DB::table('users')->insert([
            'first_name' => $req->first_name,
            'last_name' => $req->last_name,
            'username' => $req->username,
            'mobile' => $req->mobile,
            'role' => $req->role,
            'status' => $req->status,
            'email' => $req->email,
            'password' => Hash::make('12345678'),
            'profile_picture' => $imagePath,
            'created_at' => now(),
            'updated_at' => now()
        ]);

        return redirect()->back()->with('success', 'Registered successfully!');
    }
}