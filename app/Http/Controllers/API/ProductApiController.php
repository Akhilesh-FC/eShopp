<?php

namespace App\Http\Controllers\API;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Http;
use Illuminate\Support\Facades\Storage;
use Illuminate\Support\Str;

class ProductApiController extends Controller
{
    // public function Product_list_rating(Request $request)
    // {
    //     // Fetch all products data with conditions applied
    //     $data = \DB::table('products')
    //         ->join('product_rating', 'products.id', '=', 'product_rating.product_id')
    //         ->join('categories', 'products.category_id', '=', 'categories.id') // Join with category table
    //         ->select(
    //             'products.*', 
    //             'product_rating.rating', 
    //             'categories.id as category_id', 
    //             'categories.name as title', 
    //             'products.short_description' // Get short_description from products table
    //         )
    //         ->where('products.no_of_ratings', '>=', 10) // Condition for no_of_ratings
    //         ->where('product_rating.rating', '>=', 3) // Condition for rating
    //         ->get();
    
    //     // Group data by 'type' (from products table)
    //     $groupedData = $data->groupBy('type');
    
    //     // Transform the grouped data into an object structure and fetch category info
    //     $result = $groupedData->map(function ($items, $type) {
    //         // Get category details based on category_id from the products table
    //         $categoryInfo = \DB::table('categories')
    //             ->where('id', $items[0]->category_id)
    //             ->first(['id', 'name']); // Fetch id and name for the category
            
    //         return [
    //             'type' => $type,
    //             'category_id' => $categoryInfo->id,  // Category id
    //             'category_title' => $categoryInfo->name,  // Category title (name)
    //             'category_description' => $items[0]->short_description,  // Short description from products table
    //             'products' => $items->toArray()
    //         ];
    //     })->values();
    
    //     return response()->json([
    //         'success' => true,
    //         'message' => 'Filtered data grouped by type and category retrieved successfully',
    //         'data' => $result,
    //     ], 200);
    // }

    
    
    
//     public function Product_list_rating(){
        
//         $Diwali = DB::table('products')
//                   ->leftJoin('product_variants','products.id','=','product_variants.product_id')
//                   ->select('products.*',
//                   'product_variants.price as price',
//                   'product_variants.special_price as special_price',
//                   'product_variants.percentage_off as percentage_off'
//                   )
//                   ->where('products.category_id', '=', 1)
//                   ->limit(4)
//                   ->get();
                   
//         $Clothes = DB::table('products')
//             ->leftJoin('product_variants','products.id','=','product_variants.product_id')
//                   ->select('products.*',
//                   'product_variants.price as price',
//                   'product_variants.special_price as special_price',
//                   'product_variants.percentage_off as percentage_off'
//                   )
//                 ->where('products.category_id', '=', 2)->limit(4)->get();
                
//         $Digital = DB::table('products')
//         ->leftJoin('product_variants','products.id','=','product_variants.product_id')
//                   ->select('products.*',
//                   'product_variants.price as price',
//                   'product_variants.special_price as special_price',
//                   'product_variants.percentage_off as percentage_off'
//                   )
//         ->where('products.category_id', '=', 3)->limit(4)->get();
        
//         $Furniture = DB::table('products')
//         ->leftJoin('product_variants','products.id','=','product_variants.product_id')
//                   ->select('products.*',
//                   'product_variants.price as price',
//                   'product_variants.special_price as special_price',
//                   'product_variants.percentage_off as percentage_off'
//                   )
//         ->where('products.category_id', '=', 4)->limit(4)->get();
        
        
//         $Electronics= DB::table('products')
//         ->leftJoin('product_variants','products.id','=','product_variants.product_id')
//                   ->select('products.*',
//                   'product_variants.price as price',
//                   'product_variants.special_price as special_price',
//                   'product_variants.percentage_off as percentage_off'
//                   )
//         ->where('products.category_id', '=', 5)->limit(4)->get();
        
//         return response()->json([
//             (object)[
//             'category_id'=>1,
//             'category_id_name'=>'Diwali',
//             'category_title'=>'Top deals on diwali',
//             'products'=>$Diwali
//             ],
//             (object)[
//             'category_id'=>2,
//             'category_id_name'=>'Clothes',
//             'category_title'=>'Top deals on clothes',
//             'products'=>$Clothes
//             ],
//             (object)[
//             'category_id'=>3,
//             'category_id_name'=>'Digital',
//             'category_title'=>'Top deals on Digital',
//             'products'=>$Digital
//             ],
//             (object)[
//             'category_id'=>4,
//             'category_id_name'=>'Furniture',
//             'category_title'=>'Top deals on Furniture',
//             'products'=>$Furniture
//             ],
//             (object)[
//             'category_id'=>5,
//             'category_id_name'=>'Electronics',
//             'category_title'=>'Top deals on Electronics',
//             'products'=>$Electronics
//             ],
//             ]);
//                       return response()->json([
//             'data' => $data,
//             'success' => true,
//             'message' => 'Filtered data grouped by type and category retrieved successfully',
    
// ], 200);
        
//     }
    
    public function Product_list_rating(){
        
    $Diwali = DB::table('products')
                ->leftJoin('product_variants','products.id','=','product_variants.product_id')
                ->select('products.*',
                'product_variants.price as price',
                'product_variants.special_price as special_price',
                'product_variants.percentage_off as percentage_off'
                )
                ->where('products.category_id', '=', 1)
                ->limit(4)
                ->get();
                
    $Clothes = DB::table('products')
        ->leftJoin('product_variants','products.id','=','product_variants.product_id')
                ->select('products.*',
                'product_variants.price as price',
                'product_variants.special_price as special_price',
                'product_variants.percentage_off as percentage_off'
                )
            ->where('products.category_id', '=', 2)->limit(4)->get();
            
    $Digital = DB::table('products')
    ->leftJoin('product_variants','products.id','=','product_variants.product_id')
                ->select('products.*',
                'product_variants.price as price',
                'product_variants.special_price as special_price',
                'product_variants.percentage_off as percentage_off'
                )
    ->where('products.category_id', '=', 3)->limit(4)->get();
    
    $Furniture = DB::table('products')
    ->leftJoin('product_variants','products.id','=','product_variants.product_id')
                ->select('products.*',
                'product_variants.price as price',
                'product_variants.special_price as special_price',
                'product_variants.percentage_off as percentage_off'
                )
    ->where('products.category_id', '=', 4)->limit(4)->get();
    
    
    $Electronics= DB::table('products')
    ->leftJoin('product_variants','products.id','=','product_variants.product_id')
                ->select('products.*',
                'product_variants.price as price',
                'product_variants.special_price as special_price',
                'product_variants.percentage_off as percentage_off'
                )
    ->where('products.category_id', '=', 5)->limit(4)->get();
    
    return response()->json([
        'data' => [
            (object)[
                'category_id'=>1,
                'category_id_name'=>'Diwali',
                'category_title'=>'Top deals on diwali',
                'products'=>$Diwali
            ],
            (object)[
                'category_id'=>2,
                'category_id_name'=>'Clothes',
                'category_title'=>'Top deals on clothes',
                'products'=>$Clothes
            ],
            (object)[
                'category_id'=>3,
                'category_id_name'=>'Digital',
                'category_title'=>'Top deals on Digital',
                'products'=>$Digital
            ],
            (object)[
                'category_id'=>4,
                'category_id_name'=>'Furniture',
                'category_title'=>'Top deals on Furniture',
                'products'=>$Furniture
            ],
            (object)[
                'category_id'=>5,
                'category_id_name'=>'Electronics',
                'category_title'=>'Top deals on Electronics',
                'products'=>$Electronics
            ]
        ],
        'success' => true,
        'message' => 'Filtered data grouped by type and category retrieved successfully',
    ], 200);
}

    
    
public function Product_list_rating_old(Request $request)
{
    // Fetch all products data with conditions applied
    $data = \DB::table('products')
        ->join('product_rating', 'products.id', '=', 'product_rating.product_id')
        ->join('categories', 'products.category_id', '=', 'categories.id') // Join with category table
        ->leftJoin('product_variants', 'products.id', '=', 'product_variants.product_id') // Left join with product_variants table to fetch pricing info
        ->select(
            'products.*',  // Select product id
             // Rating from product_rating table
            'categories.id as category_id', // Category id from categories table
            'categories.name as title', // Category title from categories table
            'product_variants.price', // Price from product_variants table
            'product_variants.special_price', // Special price from product_variants table
            'product_variants.percentage_off' // Percentage off from product_variants table
        )
        ->where('products.no_of_ratings', '>=', 10) // Condition for no_of_ratings
        ->where('product_rating.rating', '>=', 3) // Condition for rating
        ->get();
    
    // Group data by 'type' (from products table)
    $groupedData = $data->groupBy('type');
    
    // Transform the grouped data into an object structure and fetch category info
    $result = $groupedData->map(function ($items, $type) {
        // Get category details based on category_id from the products table
        $categoryInfo = \DB::table('categories')
            ->where('id', $items[0]->category_id)
            ->first(['id', 'name']); // Fetch id and name for the category
        
        return [
            'type' => $type,
            'category_id' => $categoryInfo->id,  // Category id
            'category_title' => $categoryInfo->name,  // Category title (name)
            'category_description' => $items[0]->short_description,  // Short description from products table
            'products' => $items
        ];
    })->values();
    
    return response()->json([
        'success' => true,
        'message' => 'Filtered data grouped by type and category retrieved successfully',
        'data' => $result,
    ], 200);
}


    public function productRating(Request $request)
    {
        // Validate the incoming request
        $validator = Validator::make($request->all(), [
            'user_id' => 'required|integer|exists:users,id', // Match user_id from users table
            'product_id' => 'required|integer|exists:products,id', // Match product_id from products table
            'rating' => 'required|integer|min:1|max:5', // Rating between 1 and 5
        ]);
    
        if ($validator->fails()) {
            return response()->json([
                'success' => false,
                'errors' => $validator->errors()
            ], 400);
        }
    
        // Fetch user ID from the users table
        $user = \DB::table('users')->where('id', $request->user_id)->first();
        if (!$user) {
            return response()->json([
                'success' => false,
                'message' => 'User ID not found'
            ], 404);
        }
    
        // Fetch product ID from the products table
        $product = \DB::table('products')->where('id', $request->product_id)->first();
        if (!$product) {
            return response()->json([
                'success' => false,
                'message' => 'Product ID not found'
            ], 404);
        }
    
        // Create or update the rating in the product_ratings table
        $rating = \DB::table('product_rating')->updateOrInsert(
            [
                'product_id' => $product->id,
                'user_id' => $user->id
            ],
            ['rating' => $request->rating, 'updated_at' => now()]
        );
        return response()->json([
            'success' => true,
            'message' => 'Product rated successfully!',
            'data' => [
                'user_id' => $user->id,
                'product_id' => $product->id,
                'rating' => $request->rating
            ]
        ], 200);
    }
    



    

}