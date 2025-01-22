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
    
    // public function Product_list_rating(){
    // $data = DB::table('categories')
    //     ->select(
    //         'categories.id as category_id',
    //         'categories.name as category_id_name',
    //         'categories.title as category_title',
    //         'products.id',
    //         'products.subcategory',
    //         'products.subcategory2',
    //         'products.category_id',
    //         'products.vendor_id',
    //         'products.tax',
    //         'products.row_order',
    //         'products.type',
    //         'products.stock_type',
    //         'products.name as product_name',
    //         'products.short_description',
    //         'products.slug',
    //         'products.indicator',
    //         'products.cod_allowed',
    //         'products.download_allowed',
    //         'products.download_type',
    //         'products.download_link',
    //         'products.minimum_order_quantity',
    //         'products.quantity_step_size',
    //         'products.total_allowed_quantity',
    //         'products.is_prices_inclusive_tax',
    //         'products.is_returnable',
    //         'products.is_cancelable',
    //         'products.cancelable_till',
    //         'products.image',
    //         'products.video_type',
    //         'products.video',
    //         'products.tags',
    //         'products.warranty_period',
    //         'products.guarantee_period',
    //         'products.made_in',
    //         'products.hsn_code',
    //         'products.brand',
    //         'products.product_highlight',
    //         'products.sku',
    //         'products.stock',
    //         'products.in_day_to_sell',
    //         'products.item_to_sell',
    //         'products.availability',
    //         'products.rating',
    //         'products.no_of_ratings',
    //         'products.description',
    //         'products.extra_description',
    //         'products.deliverable_type',
    //         'products.deliverable_zipcodes',
    //         'products.pickup_location',
    //         'products.status',
    //         'products.date_added',
    //         'product_variants.price',
    //         'product_variants.special_price', 
    //         'product_variants.percentage_off' 
    //     )
    //     ->leftJoin('products', 'categories.id', '=', 'products.category_id')
    //     ->leftJoin('product_variants', 'products.id', '=', 'product_variants.product_id')
    //     ->whereNotNull('products.id') // Exclude categories without products
    //     ->where('products.is_vendor', 1)
    //     ->get()
    //     ->groupBy('category_id')
    //     ->map(function ($items, $category_id) {
    //         $category = $items->first();
    //         return [
    //             'category_id' => $category->category_id,
    //             'category_id_name' => $category->category_id_name,
    //             'category_title' => $category->category_title,
    //             'products' => $items->map(function ($item) {
    //                 return [
    //                     'id' => $item->id,
    //                     'subcategory' => $item->subcategory,
    //                     'subcategory2' => $item->subcategory2,
    //                     'category_id' => $item->category_id,
    //                     'vendor_id' => $item->vendor_id,
    //                     'tax' => $item->tax,
    //                     'row_order' => $item->row_order,
    //                     'type' => $item->type,
    //                     'stock_type' => $item->stock_type,
    //                     'name' => $item->product_name,
    //                     'short_description' => $item->short_description,
    //                     'slug' => $item->slug,
    //                     'indicator' => $item->indicator,
    //                     'cod_allowed' => $item->cod_allowed,
    //                     'download_allowed' => $item->download_allowed,
    //                     'download_type' => $item->download_type,
    //                     'download_link' => $item->download_link,
    //                     'minimum_order_quantity' => $item->minimum_order_quantity,
    //                     'quantity_step_size' => $item->quantity_step_size,
    //                     'total_allowed_quantity' => $item->total_allowed_quantity,
    //                     'is_prices_inclusive_tax' => $item->is_prices_inclusive_tax,
    //                     'is_returnable' => $item->is_returnable,
    //                     'is_cancelable' => $item->is_cancelable,
    //                     'cancelable_till' => $item->cancelable_till,
    //                     'image' => $item->image,
    //                     'video_type' => $item->video_type,
    //                     'video' => $item->video,
    //                     'tags' => $item->tags,
    //                     'warranty_period' => $item->warranty_period,
    //                     'guarantee_period' => $item->guarantee_period,
    //                     'made_in' => $item->made_in,
    //                     'hsn_code' => $item->hsn_code,
    //                     'brand' => $item->brand,
    //                     'product_highlight' => $item->product_highlight,
    //                     'sku' => $item->sku,
    //                     'stock' => $item->stock,
    //                     'in_day_to_sell' => $item->in_day_to_sell,
    //                     'item_to_sell' => $item->item_to_sell,
    //                     'availability' => $item->availability,
    //                     'rating' => $item->rating,
    //                     'no_of_ratings' => $item->no_of_ratings,
    //                     'description' => $item->description,
    //                     'extra_description' => $item->extra_description,
    //                     'deliverable_type' => $item->deliverable_type,
    //                     'deliverable_zipcodes' => $item->deliverable_zipcodes,
    //                     'pickup_location' => $item->pickup_location,
    //                     'status' => $item->status,
    //                     'date_added' => $item->date_added,
    //                     'price' => $item->price,
    //                     'special_price' => $item->special_price,
    //                     'percentage_off' => $item->percentage_off,
    //                 ]; 
    //             }),
    //         ];
    //     })
    //     ->values(); // Re-index the array
    
    // // return response()->json($data);
    
    // return response()->json([
    //         'success' => true,
    //         'message' => 'Filtered data grouped by type and category retrieved successfully',
    //         'data' => $data,
    //     ], 200);
    // }
    
    public function Product_list_rating() {
    $data = DB::table('categories')
        ->select(
            'categories.id as category_id',
            'categories.name as category_name',
            'categories.title as category_title',
            'products.id',
            'products.subcategory',
            'products.subcategory2',
            'products.category_id',
            'products.vendor_id',
            'products.tax',
            'products.row_order',
            'products.type',
            'products.stock_type',
            'products.name as product_name',
            'products.short_description',
            'products.slug',
            'products.indicator',
            'products.cod_allowed',
            'products.download_allowed',
            'products.download_type',
            'products.download_link',
            'products.minimum_order_quantity',
            'products.quantity_step_size',
            'products.total_allowed_quantity',
            'products.is_prices_inclusive_tax',
            'products.is_returnable',
            'products.is_cancelable',
            'products.cancelable_till',
            'products.image',
            'products.video_type',
            'products.video',
            'products.tags',
            'products.warranty_period',
            'products.guarantee_period',
            'products.made_in',
            'products.hsn_code',
            'products.brand',
            'products.product_highlight',
            'products.sku',
            'products.stock',
            'products.in_day_to_sell',
            'products.item_to_sell',
            'products.availability',
            'products.rating',
            'products.no_of_ratings',
            'products.description',
            'products.extra_description',
            'products.deliverable_type',
            'products.deliverable_zipcodes',
            'products.pickup_location',
            'products.status',
            'products.date_added',
            // Select the first variant for each product
            DB::raw('
                (SELECT price FROM product_variants WHERE product_variants.product_id = products.id LIMIT 1) as price'),
            DB::raw('
                (SELECT special_price FROM product_variants WHERE product_variants.product_id = products.id LIMIT 1) as special_price'),
            DB::raw('
                (SELECT percentage_off FROM product_variants WHERE product_variants.product_id = products.id LIMIT 1) as percentage_off')
        )
        ->leftJoin('products', 'categories.id', '=', 'products.category_id')
        ->whereNotNull('products.id')
        ->where('products.is_vendor', 1)
        ->get()
        ->groupBy('category_id')
        ->map(function ($items) {
            $category = $items->first();
            $products = $items->map(fn($item) => [
                'id' => $item->id,
                'subcategory' => $item->subcategory,
                'subcategory2' => $item->subcategory2,
                'category_id' => $item->category_id,
                'vendor_id' => $item->vendor_id,
                'tax' => $item->tax,
                'row_order' => $item->row_order,
                'type' => $item->type,
                'stock_type' => $item->stock_type,
                'name' => $item->product_name,
                'short_description' => $item->short_description,
                'slug' => $item->slug,
                'indicator' => $item->indicator,
                'cod_allowed' => $item->cod_allowed,
                'download_allowed' => $item->download_allowed,
                'download_type' => $item->download_type,
                'download_link' => $item->download_link,
                'minimum_order_quantity' => $item->minimum_order_quantity,
                'quantity_step_size' => $item->quantity_step_size,
                'total_allowed_quantity' => $item->total_allowed_quantity,
                'is_prices_inclusive_tax' => $item->is_prices_inclusive_tax,
                'is_returnable' => $item->is_returnable,
                'is_cancelable' => $item->is_cancelable,
                'cancelable_till' => $item->cancelable_till,
                'image' => $item->image,
                'video_type' => $item->video_type,
                'video' => $item->video,
                'tags' => $item->tags,
                'warranty_period' => $item->warranty_period,
                'guarantee_period' => $item->guarantee_period,
                'made_in' => $item->made_in,
                'hsn_code' => $item->hsn_code,
                'brand' => $item->brand,
                'product_highlight' => $item->product_highlight,
                'sku' => $item->sku,
                'stock' => $item->stock,
                'in_day_to_sell' => $item->in_day_to_sell,
                'item_to_sell' => $item->item_to_sell,
                'availability' => $item->availability,
                'rating' => $item->rating,
                'no_of_ratings' => $item->no_of_ratings,
                'description' => $item->description,
                'extra_description' => $item->extra_description,
                'deliverable_type' => $item->deliverable_type,
                'deliverable_zipcodes' => $item->deliverable_zipcodes,
                'pickup_location' => $item->pickup_location,
                'status' => $item->status,
                'date_added' => $item->date_added,
                'price' => $item->price,
                'special_price' => $item->special_price,
                'percentage_off' => $item->percentage_off
            ]);
            return [
                'category_id' => $category->category_id,
                'category_id_name' => $category->category_name,
                'category_title' => $category->category_title,
                'products' => $products
            ];
        })
        ->values();

    return response()->json([
        'success' => true,
        'message' => 'Filtered data grouped by category retrieved successfully',
        'data' => $data,
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
    
    public function product_explore(Request $request) 
    {
        $search = $request->input('search'); // Search term from JSON payload
        $userId = $request->input('user_id'); // Optional user ID for checking cart and favorites
        $sortBy = $request->input('sort_by'); // Sorting option from the request (1-5)
    
        // Fetch products with optional search filter and vendor check
        $products = DB::table('products')
            ->leftJoin('product_variants', function ($join) {
                // Subquery to get the first variant for each product
                $join->on('products.id', '=', 'product_variants.product_id')
                     ->whereRaw('product_variants.id = (SELECT MIN(id) FROM product_variants WHERE product_variants.product_id = products.id)');
            })
            ->select(
                'products.*',
                'product_variants.id as variant_id',
                'product_variants.price',
                'product_variants.special_price',
                'product_variants.percentage_off'
            )
            ->whereNotNull('products.id') // Ensure the product ID is not null
            ->where('products.is_vendor', 1) // Only products that are from vendors
            ->when($search, function ($query, $search) {
                return $query->where('products.name', 'like', '%' . $search . '%');
            })
            ->when($sortBy, function ($query, $sortBy) {
                switch ($sortBy) {
                    case 1:
                        return $query->orderByDesc('products.rating');
                    case 2:
                        return $query->orderByDesc('products.created_at');
                    case 3:
                        return $query->orderBy('products.created_at');
                    case 4:
                        return $query->orderBy('product_variants.price');
                    case 5:
                        return $query->orderByDesc('product_variants.price');
                    default:
                        return $query;
                }
            })
            ->get();
    
        // Initialize cart and favorites arrays
        $cartItems = [];
        $favoriteItems = [];
    
        // Only fetch cart and favorite items if userId is provided
        if ($userId) {
            // Fetch the cart items for the given user
            $cartItems = DB::table('cart')
                ->where('user_id', $userId)
                ->where('status', '0') // New cart items (status '0')
                ->get(['product_id', 'quantity']) 
                ->keyBy('product_id') // Key by product_id
                ->map(function ($item) {
                    return $item->quantity; // Return the quantity for each product in the cart
                });
            
            // Fetch product IDs in the user's favorites
            $favoriteItems = DB::table('favorites')
                ->where('user_id', $userId)
                ->pluck('product_id') // Fetch only product IDs
                ->toArray();
        }
    
        // Add `is_added_to_cart`, `is_added_to_fav`, and `quantity_in_cart` flags to each product
        $products = $products->map(function ($product) use ($cartItems, $favoriteItems) {
            // Check if product is in the cart
            $product->is_added_to_cart = isset($cartItems[$product->id]) ? 1 : 0; // Check for existence of product in the cart
    
            // Check if product is in the favorites
            $product->is_added_to_fav = in_array($product->id, $favoriteItems) ? 1 : 0;
    
            // Get the quantity of the product in the cart, or 0 if not present
            $product->quantity_in_cart = isset($cartItems[$product->id]) ? $cartItems[$product->id] : 0;
    
            return $product;
        });
    
        // Add a custom message based on the result
        $message = $products->isEmpty() 
            ? 'No products found matching your search.' 
            : 'Products retrieved successfully.';
    
        // Return the response with success status and data
        return response()->json([
            'message' => $message,
            "success" => true,
            'data' => $products
        ]);
    }

}