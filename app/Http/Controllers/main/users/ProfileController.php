<?php

namespace App\Http\Controllers\main\users;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Str;

class ProfileController extends Controller
{
    public function index() {
        return view('main.users.profile');
    }

    public function updateProfile(Request $req) {

        $user = DB::table('users')->where('id', $req->id)->first();

        if (!$user) {
            return redirect()->back()->withErrors(['user' => 'User not found.']);
        }

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
       $updatedUser =  DB::table('users')->where('id', $req->id)->update([
            'first_name' => $req->first_name,
            'last_name' => $req->last_name,
            'username' => $req->username,
            'mobile' => $req->mobile,
            'email' => $req->email,
            'profile_picture' => $imagePath,
            'updated_at' => now()
        ]);

        if (!$updatedUser) {
            return redirect()->back()->withErrors(['user' => 'Failed to update user.']);
        }

        return redirect()->back()->with('success', 'User updated successfully!');
    }

    public function changePassword(Request $req) {
        $user = DB::table('users')->where('id', $req->id)->first();

        if (!$user) {
            return redirect()->back()->withErrors(['user' => 'User not found.']);
        }

        $oldPassword = $req->input('old_password');
        $newPassword = $req->input('new_password');
        $confirmPassword = $req->input('confirm_password');

        if ($newPassword !== $confirmPassword) {
            return redirect()->back()->withErrors(['confirm_password' => 'Confirm passwords do not match.']);
        }

        if (!Hash::check($oldPassword, $user->password)) {
            return redirect()->back()->withErrors(['current_password' => 'Current password is incorrect.']);
        }

        $hashedPassword = Hash::make($newPassword);

        $updatedUser = DB::table('users')->where('id', $req->id)->update([
            'password' => $hashedPassword,
            'updated_at' => now()
        ]);

        if (!$updatedUser) {
            return redirect()->back()->withErrors(['user' => 'Failed to update user.']);
        }

        return redirect()->back()->with('success', 'Password updated successfully!');
    }
}