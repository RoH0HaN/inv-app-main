<?php

namespace App\Http\Controllers\main;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;

class CategoryListController extends Controller
{
    public function index(Request $request) {
        
        $query = DB::table('categories')->leftJoin('users', 'categories.created_by_id', '=', 'users.id')
        ->select(
            'categories.*',
            'users.first_name',
            'users.last_name'
        );

        if ($request->has('search') && !empty($request->search)) {
            $query->where('categories.name', 'like', '%' . $request->search . '%');
        }

        $categories = $query->paginate(15);

        return view('main.items.categorylist',compact('categories'));
    }

    public function createCategory() {
        return view('main.items.createcategory');
    }

    public function saveCategoryToDatabase(Request $req) {

        // Validating the input
        $req->validate([
            'name' => 'required|string|max:20',
            'description' => 'required|string|max:100',
        ]);

        
        if (!Auth::check()) {
            return redirect()->route('admin.login')->with('error', 'You must be logged in to create a category.');
        }

        // Inserting Tax using DB class
        DB::table('categories')->insert([
            'name' => $req->name,
            'display_name' => strtoupper($req->name),
            'description' => $req->description,
            'created_by_id' => Auth::id(),
            'created_at' => now(),
            'updated_at' => now()
        ]);

        return redirect()->back()->with('success', 'Registered successfully!');
    }

    public function updateCategoryToDatabase(Request $req) {

        // Validating the input
        $req->validate([
            'name' => 'required|string|max:20',
            'description' => 'required|string|max:100',
        ]);

        // Fetch categories record
        $categories = DB::table('categories')->where('id', $req->id)->first();

        if (!$categories) {
            return redirect()->back()->with('error', 'Category not found!');
        }

        // Inserting Tax using DB class
        DB::table('categories')->where('id', $req->id)->update([
            'name' => $req->name,
            'description' => $req->description,
            'display_name' => strtoupper($req->name),
            'updated_at' => now()
        ]);

        return redirect()->back()->with('success', 'Updated successfully!');
    }


      public function deleteCategoryToDatabase(Request $req){
        // Fetch warehouse record
        $categories = DB::table('categories')->where('id', $req->id)->first();
        if (!$categories) {
            return redirect()->back()->with('error', 'Category not found!');
        }
        DB::table('categories')->where('id', $req->id)->delete();
        return redirect()->back()->with('success', 'Category deleted successfully!');
    }
}