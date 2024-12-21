<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Storage;
use App\Models\Slider;

class SlidersController extends Controller
{
    // public function viewsliders(Request $request)  
    // { 
    //     $perPage = $request->input('per_page', 5); 
    //     $viewsliders = DB::table('sliders')->orderBy('id', 'desc')->paginate($perPage); 
    //     return view('sliders', compact('viewsliders', 'perPage')); 
    // }
    
    public function viewsliders(Request $request)
{
    // Get the number of rows per page from the request, default to 5 if not set
    $perPage = $request->input('per_page', 5);

    // Fetch sliders with pagination, ordered by 'id' in descending order
    $viewsliders = DB::table('sliders')->orderBy('id', 'desc')->paginate($perPage);

    // Pass the paginated data and perPage value to the view
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

    // public function destroy($id)
    // {
    //     $slider = Slider::find($id);
        
    //     if ($slider) {
    //         // Delete the slider from the database
    //         $slider->delete();

    //         // Return a response or redirect to the slider list with success message
    //         return redirect()->route('sliders.index')->with('success', 'Slider deleted successfully!');
    //     } else {
    //         // If slider doesn't exist, show an error message
    //         return redirect()->route('sliders')->with('error', 'Slider not found!');
    //     }
    // }
    
   public function destroy($id)
    {
        // Find the slider in the database by its ID
        $slider = DB::table('sliders')->where('id', $id)->first();

        if ($slider) {
            // Optionally delete the image if it exists
            if ($slider->image && file_exists(public_path('path/to/images/' . $slider->image))) {
                // Delete the image file
                unlink(public_path('path/to/images/' . $slider->image));
            }

            // Delete the slider from the database
            DB::table('sliders')->where('id', $id)->delete();

            // Redirect with success message
            return redirect()->route('sliders')->with('success', 'Slider deleted successfully!');
        } else {
            // If the slider is not found
            return redirect()->route('sliders')->with('error', 'Slider not found!');
        }
    }


}
