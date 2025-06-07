<?php

namespace App\Http\Controllers\main\users;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Str;

class AllUsersController extends Controller
{
    public function index(Request $request) {
        $query = DB::table('users');

        if ($request->has('search') && !empty($request->search)) {
            $searchTerm = $request->search;
        
            $query->where(function ($q) use ($searchTerm) {
                $q->where('users.first_name', 'like', '%' . $searchTerm . '%')
                  ->orWhere('users.last_name', 'like', '%' . $searchTerm . '%')
                  ->orWhere('users.email', 'like', '%' . $searchTerm . '%')
                  ->orWhere('users.mobile', 'like', '%' . $searchTerm . '%')
                  ->orWhere('users.role', 'like', '%' . $searchTerm . '%');
            });
        }
        

        $users = $query->paginate(15);

        $warehouses = DB::table('warehouses')->select(['id', 'organization_name'])->get();
        $outlets = DB::table('outlets')->select(['id', 'organization_name'])->get();

        return view('main.users.userslist', ['users' => $users, 'warehouses' => $warehouses, 'outlets' => $outlets]);
    }

    public function createUser() {
        $warehouses = DB::table('warehouses')->select(['id', 'organization_name'])->get();
        $outlets = DB::table('outlets')->select(['id', 'organization_name'])->get();

        return view('main.users.createuser', ['warehouses' => $warehouses, 'outlets' => $outlets]);
    }

    public function saveUserToDatabase(Request $req) {
        // Extract warehouse_id or outlet_id from location_id
        $warehouse_id = null;
        $outlet_id = null;
    
        if ($req->role === 'user' && $req->has('location_id')) {
            [$type, $id] = explode('_', $req->location_id);
            if ($type === 'warehouse') {
                $warehouse_id = $id;
            } elseif ($type === 'outlet') {
                $outlet_id = $id;
            }
        }
    
        // Base validation rules
        $rules = [
            'profile_image' => 'nullable|image|mimes:jpeg,png,jpg,gif|max:2048',
            'first_name' => 'required|string|max:50',
            'last_name' => 'required|string|max:50',
            'username' => 'required|string|max:50',
            'email' => 'required|email|unique:users,email',
            'mobile' => 'required|numeric|digits:10|unique:users,mobile',
            'role' => 'required|string|in:user,admin,viewer',
            'status' => 'required|string|max:10'
        ];
    
        // Custom validation for warehouse/outlet IDs
        if ($req->role === 'user') {
            if (!$warehouse_id && !$outlet_id || $warehouse_id && $outlet_id) {
                return redirect()->back()->withErrors([
                    'location_id' => 'Select either a warehouse or an outlet, not both or none.',
                ])->withInput();
            }
    
            if ($warehouse_id && !DB::table('warehouses')->where('id', $warehouse_id)->exists()) {
                return redirect()->back()->withErrors(['location_id' => 'Selected warehouse is invalid.'])->withInput();
            }
    
            if ($outlet_id && !DB::table('outlets')->where('id', $outlet_id)->exists()) {
                return redirect()->back()->withErrors(['location_id' => 'Selected outlet is invalid.'])->withInput();
            }
        }
    
        // Validate the rest
        $req->validate($rules);
    
        // Handle image
        $imagePath = null;
        if ($req->hasFile('profile_image')) {
            $image = $req->file('profile_image');
            $imageName = Str::uuid() . '.' . $image->getClientOriginalExtension();
            $image->move(public_path('uploads/profile_images'), $imageName);
            $imagePath = 'uploads/profile_images/' . $imageName;
        }
    
        // Save user
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
            'warehouse_id' => $warehouse_id,
            'outlet_id' => $outlet_id,
            'created_at' => now(),
            'updated_at' => now()
        ]);
    
        return redirect()->back()->with('success', 'User registered successfully!');
    }

    public function updateUser(Request $req){
        $userId = $req->input('id');
        $user = DB::table('users')->where('id', $userId)->first();

        if (!$user) {
            return redirect()->back()->withErrors(['user' => 'User not found.']);
        }

        // Extract location
        $warehouse_id = null;
        $outlet_id = null;

        if ($req->role === 'user' && $req->has('location_id')) {
            [$type, $id] = explode('_', $req->location_id);
            if ($type === 'warehouse') {
                $warehouse_id = $id;
            } elseif ($type === 'outlet') {
                $outlet_id = $id;
            }
        }

        // Validation
        $rules = [
            'profile_image' => 'nullable|image|mimes:jpeg,png,jpg,gif|max:2048',
            'first_name' => 'required|string|max:50',
            'last_name' => 'required|string|max:50',
            'username' => 'required|string|max:50',
            'email' => 'required|email|unique:users,email,' . $userId,
            'mobile' => 'required|numeric|digits:10|unique:users,mobile,' . $userId,
            'role' => 'required|string|in:user,admin,viewer',
            'status' => 'required|string|max:10',
        ];

        $req->validate($rules);

        // Validate location selection
        if ($req->role === 'user') {
            if ((!$warehouse_id && !$outlet_id) || ($warehouse_id && $outlet_id)) {
                return redirect()->back()->withErrors([
                    'location_id' => 'Select either a warehouse or an outlet, not both or none.',
                ])->withInput();
            }

            if ($warehouse_id && !DB::table('warehouses')->where('id', $warehouse_id)->exists()) {
                return redirect()->back()->withErrors(['location_id' => 'Selected warehouse is invalid.'])->withInput();
            }

            if ($outlet_id && !DB::table('outlets')->where('id', $outlet_id)->exists()) {
                return redirect()->back()->withErrors(['location_id' => 'Selected outlet is invalid.'])->withInput();
            }
        }else if($req->role === 'viewer' || $req->role === 'admin'){
            if($req->has('location_id')){
                return redirect()->back()->withErrors([
                    'location_id' => 'Cannot select a warehouse or an outlet for a viewer or admin.',
                ])->withInput();
            }
        }

        // Image logic
        $imagePath = $user->profile_picture;

        if ($req->hasFile('profile_image')) {
            if ($imagePath && file_exists(public_path($imagePath))) {
                unlink(public_path($imagePath));
            }

            $image = $req->file('profile_image');
            $imageName = Str::uuid() . '.' . $image->getClientOriginalExtension();
            $image->move(public_path('uploads/profile_images'), $imageName);

            $imagePath = 'uploads/profile_images/' . $imageName;
        }

        // Perform update
        DB::table('users')->where('id', $userId)->update([
            'first_name' => $req->first_name,
            'last_name' => $req->last_name,
            'username' => $req->username,
            'mobile' => $req->mobile,
            'role' => $req->role,
            'status' => $req->status,
            'email' => $req->email,
            'profile_picture' => $imagePath,
            'warehouse_id' => $warehouse_id,
            'outlet_id' => $outlet_id,
            'updated_at' => now()
        ]);

        return redirect()->back()->with('success', 'User updated successfully!');
    }


    public function deleteUser(Request $req){
        // Fetch warehouse record
        $user = DB::table('users')->where('id', $req->id)->first();
        if (!$user) {
            return redirect()->back()->with('error', 'User not found!');
        }

        if($user->role == 'admin'){
            return redirect()->back()->with('error', 'You cannot delete an admin!');
        }

        DB::table('users')->where('id', $req->id)->delete();
        return redirect()->back()->with('success', 'User deleted successfully!');
    }
    
}