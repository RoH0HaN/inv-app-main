<?php

namespace App\Http\Controllers\admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Session;

class AdminLoginController extends Controller
{
    public function index() {
        if (Auth::check()) {
            return redirect()->route('dashboard');
        }

        return view('welcome');
    }
    
    public function logout() {
        Auth::logout();
        return redirect()->route('login');
    }


    public function login(Request $req) {
        $credentials = $req->validate([
            'email' => ['required', 'email'],
            'password' => ['required'],
        ]);

        if (Auth::attempt($credentials)) {
            $user = Auth::user();

            // Fetch warehouse or outlet based on entity_name
            $entity = null;
            if ($user->entity_name === 'warehouse') {
                $entity = DB::table('warehouses')->where('id', $user->warehouse_id)->first();
            } elseif ($user->entity_name === 'outlet') {
                $entity = DB::table('outlets')->where('id', $user->outlet_id)->first();
            } else {
                $entity = null;
            }

            
            // Store entity info in session
            if ($entity) {
                Session::put('user_entity', [
                    'type' => $user->entity_name,
                    'id' => $entity->id,
                    'name' => $entity->organization_name ?? 'N/A',
                ]);
            }

            return redirect()->route('dashboard')->with('success', 'Login successful');
        }

        return back()->withErrors([
            'email' => 'The provided email does not match our records.',
            'password' => 'The provided password does not match our records.'
        ]);
    }

}