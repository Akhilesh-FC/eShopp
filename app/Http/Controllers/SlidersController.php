<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Storage;
use App\Models\Slider;

class SlidersController extends Controller
{
    public function viewsliders(Request $request)  
    { 
        $perPage = $request->input('per_page', 10); 
        $viewsliders = DB::table('sliders')->orderBy('id', 'desc')->paginate($perPage); 
        return view('sliders', compact('viewsliders', 'perPage')); 
    }
    

public function store(Request $request)
{
    $request->validate([
        'type' => 'nullable|string',
        'slider_image' => 'required|image|mimes:jpeg,png,jpg,gif,svg|max:2048',
        'link' => 'nullable|url',
    ]);

    if ($request->hasFile('slider_image')) {
        $file = $request->file('slider_image');
        $fileName = time() . '.' . $file->getClientOriginalExtension();

        $filePath = $file->storeAs('public/sliders', $fileName);
        
        //$imageUrl = env('APP_URL') . 'public/sliders/' . $fileName; 
        $imageUrl = asset('public/sliders/' . $fileName);
    }

    DB::table('sliders')->insert([
        'type' => $request->type,
        'image' => $imageUrl,  
        'link' => $request->link,
    ]);

    return redirect()->route('sliders')->with('success', 'Slider added successfully!');
}

    // public function edit($id)
    // {
    //     // Fetch slider details from the database
    //     $slider = DB::table('sliders')->where('id', $id)->first();
        
    //     if ($slider) {
    //         return view('edit_slider', compact('slider'));
    //     } else {
    //         return redirect()->route('sliders')->with('error', 'Slider not found!');
    //     }
    // }
    
    public function update(Request $request, $id)
    {
        $request->validate([
            'type' => 'required|string',
            'slider_image' => 'nullable|image|mimes:jpeg,png,jpg,gif,svg|max:2048',
            'link' => 'required|url'
        ]);

        // Get the existing slider details
        $slider = DB::table('sliders')->where('id', $id)->first();
        if (!$slider) {
            return redirect()->route('sliders')->with('error', 'Slider not found!');
        }

        $fileName = $slider->image; // Default to existing image

        // If a new image is uploaded, store it and update the file name
        if ($request->hasFile('slider_image')) {
            $file = $request->file('slider_image');
            $fileName = time() . '.' . $file->getClientOriginalExtension();
            $file->move(public_path('sliders'), $fileName); // Store the new image in 'public/sliders' folder

            // Optionally, delete the old image file
            $oldImagePath = public_path('sliders/' . $slider->image);
            if (File::exists($oldImagePath)) {
                File::delete($oldImagePath);
            }
        }

        // Update the slider data in the database
        DB::table('sliders')->where('id', $id)->update([
            'type' => $request->type,
            'image' => $fileName,
            'link' => $request->link,
            'updated_at' => now()
        ]);

        return redirect()->route('sliders')->with('success', 'Slider updated successfully!');
    }

// SliderController.php
public function destroy($id)
    {
        // Find the slider by ID
        $slider = Slider::find($id);
        
        // Check if the slider exists
        if ($slider) {
            // Delete the slider from the database
            $slider->delete();

            // Return a response or redirect to the slider list with success message
            return redirect()->route('sliders.index')->with('success', 'Slider deleted successfully!');
        } else {
            // If slider doesn't exist, show an error message
            return redirect()->route('sliders')->with('error', 'Slider not found!');
        }
    }


}
