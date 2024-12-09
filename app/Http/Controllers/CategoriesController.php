<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use App\Models\User;

class CategoriesController extends Controller
{ 
    public function ViewCategory(Request $request)  
    { 
        $perPage = $request->input('per_page', 10);
        $viewCategories = DB::table('categories')->orderBy('id', 'desc')->paginate($perPage); 
        return view('category.category', compact('viewCategories', 'perPage')); 
    }
    
    

}
