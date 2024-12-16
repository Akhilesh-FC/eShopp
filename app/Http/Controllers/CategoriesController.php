<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use App\Models\User;
use Illuminate\Support\Facades\Storage;


class CategoriesController extends Controller
{ 
    public function ViewCategory(Request $request)  
    { 
        $perPage = $request->input('per_page', 10);
        $viewCategories = DB::table('categories')->orderBy('id', 'desc')->paginate($perPage); 
        return view('category.category', compact('viewCategories', 'perPage')); 
    }
    
    public function create() 
    {
        return view('category.createcategory');  
    }

    // public function store(Request $request)
    // {
    //     $request->validate([
    //         'name' => 'required|string|max:255',
    //         'image' => 'required|image|mimes:jpeg,png,jpg|max:2048',
    //         'banner' => 'nullable|image|mimes:jpeg,png,jpg|max:2048',
    //     ]);
    
    //     $imagePath = null;
    //     if ($request->hasFile('image')) {
    //         $imagePath = $request->file('image')->store('categories', 'public');
    //     }
    
    //     $bannerPath = null;
    //     if ($request->hasFile('banner')) {
    //         $bannerPath = $request->file('banner')->store('categories', 'public');
    //     }
    
    //     DB::table('categories')->insert([
    //         'name' => $request->name,
    //         'image' => $imagePath,
    //         'banner' => $bannerPath
    //     ]);

    //     return redirect()->route('category.create')->with('success', 'Category added successfully!');
    // }
    
    public function store(Request $request)
{
    $request->validate([
        'name' => 'required|string|max:255',
        'image' => 'required|image|mimes:jpeg,png,jpg|max:2048',
        'banner' => 'nullable|image|mimes:jpeg,png,jpg|max:2048',
    ]);

    $imagePath = null;
    if ($request->hasFile('image')) {
        $imagePath = $request->file('image')->store('categories', 'public');
        $imagePath = url('storage/' . $imagePath); // Convert to full URL
    }

    $bannerPath = null;
    if ($request->hasFile('banner')) {
        $bannerPath = $request->file('banner')->store('categories', 'public');
        $bannerPath = url('storage/' . $bannerPath); // Convert to full URL
    }

    DB::table('categories')->insert([
        'name' => $request->name,
        'image' => $imagePath,
        'banner' => $bannerPath
    ]);

    return redirect()->route('category.create')->with('success', 'Category added successfully!');
}

    
    public function edit($id)
{
    // Fetch the category from the database using DB query
    $category = DB::table('categories')->where('id', $id)->first();

    // Check if the category exists
    if (!$category) {
        return redirect()->route('category.create')->with('error', 'Category not found');
    }

    // Return the edit view with the category data
    return view('category.categoryedit', compact('category'));
}
    
   public function update(Request $request, $id)
{
    // Validate the incoming data
    $validatedData = $request->validate([
        'name' => 'required|string|max:255',
        'image' => 'nullable|image|mimes:jpeg,png,jpg,gif|max:2048',
        'banner' => 'nullable|image|mimes:jpeg,png,jpg,gif|max:2048',
        'status' => 'required|in:0,1',
    ]);

    // Find the category
    $category = DB::table('categories')->where('id', $id)->first();

    // Handle file upload for image
    if ($request->hasFile('image')) {
        $imagePath = $request->file('image')->store('categories/images', 'public');
    } else {
        $imagePath = $category->image;
    }

    // Handle file upload for banner
    if ($request->hasFile('banner')) {
        $bannerPath = $request->file('banner')->store('categories/banners', 'public');
    } else {
        $bannerPath = $category->banner;
    }

    // Update the category
    DB::table('categories')
        ->where('id', $id)
        ->update([
            'name' => $request->name,
            'image' => $imagePath,
            'banner' => $bannerPath,
            'status' => $request->status,
        ]);

    // Redirect back with success message
    return redirect()->route('category.create')->with('success', 'Category updated successfully');   
}



    public function destroy($id)
    {
        $category = DB::table('categories')->where('id', $id)->first();
    
        if ($category->image) {
            Storage::disk('public')->delete($category->image);
        }
    
        if ($category->banner) {
            Storage::disk('public')->delete($category->banner);
        }
    
        DB::table('categories')->where('id', $id)->delete();
    
        return redirect()->route('category')->with('success', 'Category deleted successfully.');
    }

    public function toggleStatus($id)
    {
        $category = DB::table('categories')->where('id', $id)->first();
        $newStatus = $category->status == 1 ? 0 : 1;
    
        DB::table('categories')->where('id', $id)->update(['status' => $newStatus]);
    
        $statusMessage = $newStatus == 1 ? 'activated' : 'deactivated';
        return redirect()->route('category')->with('success', "Category $statusMessage successfully.");
    }


    

    

}
