<?php

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\API;
use App\Http\Controller\Api\AuthController;
use App\Http\Controllers\API\{PublicApiController,ListController, ProductApiController, CartApiController, AddressApiController};

Route::get('/user', function (Request $request) {
    return $request->user();
})->middleware('auth:sanctum');

Route::post('/store-token', [PublicApiController::class, 'Token']);
Route::post('/register', [PublicApiController::class,'register']);
Route::post('/login', [PublicApiController::class,'login']);
Route::get('/sliders', [PublicApiController::class, 'showSliders']);
Route::get('/categories', [PublicApiController::class, 'showCategories']);
Route::post('/subcategories', [PublicApiController::class, 'subcategories']);

Route::post('/products', [PublicApiController::class, 'getProductsBySubcategory']);
Route::get('/profile/{id}', [PublicApiController::class, 'getProfile']);
Route::post('/update-profile', [PublicApiController::class, 'updateProfile']);
Route::get('/about_us',[PublicApiController::class,'about_us']);
Route::get('/contact_us',[PublicApiController::class,'contact_us']);
Route::get('/privacy_policy',[PublicApiController::class,'Privacy_Policy']);
Route::get('/return_policy',[PublicApiController::class,'Return_Policy']);
Route::get('/shipping_policy',[PublicApiController::class,'Shipping_Policy']);
Route::get('/faqs',[PublicApiController::class,'FAQs']);
Route::get('/Terms_Condition',[PublicApiController::class,'Terms_Condition']);
Route::post('/tokens', [ListController::class, 'tokens']);
Route::post('/product_details',[PublicApiController::class,'ProductDetails']);

Route::controller(ProductApiController::class)->group(function () {
   // Route::get('/orders/{id}', 'show');
    Route::get('/product_list_rating', 'Product_list_rating');
    Route::post('/product/rating', 'productRating');
    Route::post('/product_explore', 'product_explore');    
});


Route::controller(CartApiController::class)->group(function () {
    Route::post('/addtocart', 'addToCart');
    Route::post('/updatecart', 'updateFromCart');
    Route::post('/view_cart', 'viewCart'); 
    Route::post('/remove_from_cart', 'removeFromCart'); 
    Route::post('/deleteFromCart', 'deleteFromCart');   
 
    Route::post('/addtofav', 'addToFavorite'); 
    Route::post('/view_fav', 'viewFavorites');   
    Route::post('/removeFromFavorite', 'removeFromFavorite'); 
    Route::post('/deletefromfav', 'deletefromfav'); 
    Route::post('/checkout', 'checkout'); 
    
    Route::post('/payin','payin'); 
    Route::post('/checkPayment','checkPayment');     
    Route::post('/viewcheckout','viewcheckout'); 
    Route::post('/viewcheckout_history','viewcheckout_history'); 
    

});
Route::controller(AddressApiController::class)->group(function() {
    Route::post('/add_address', 'add_address');
    Route::post('/view_address', 'view_address');   
    Route::post('/edit_address','edit_address'); 
    Route::post('/delete_address','delete_address');  

}); 



  




