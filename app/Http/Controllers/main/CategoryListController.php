<?php

namespace App\Http\Controllers\main;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Str;

class CategoryListController extends Controller
{
    public function index() {
        return view('main.items.categorylist');
    }

    public function createCategory() {
        return view('main.items.createcategory');
    }

    public function saveCategoryToDatabase(Request $req) {

        print_r($req->all());

        // $category = DB::table('categories')->insert([
        //     'name' => Str::snake($req->category_name),
        //     'display_name' => $req->category_name,
        //     'description' => $req->category_description
        // ]);
        
    }
}