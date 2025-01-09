<?php

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\API;
use App\Http\Controller\Api\AuthController;
use App\Http\Controllers\API\{PublicApiController,ListController, ProductApiController, CartApiController, AddressApiController, VendorApiController,VarientsApiController};

Route::get('/user', function (Request $request) { return $request->user();})->middleware('auth:sanctum');
Route::post('/tokens', [ListController::class, 'tokens']);

Route::controller(PublicApiController::class)->group(function () {
    Route::post('/store-token', 'Token');
    Route::post('/register','register');
    Route::post('/login','login');
    Route::get('/sliders', 'showSliders');
    Route::get('/categories', 'showCategories');
    Route::post('/subcategories',  'subcategories');
    
    Route::post('/products', 'getProductsBySubcategory');
    Route::get('/profile/{id}', 'getProfile');
    Route::post('/update-profile', 'updateProfile');
    Route::get('/about_us','about_us');
    Route::get('/contact_us','contact_us');
    Route::get('/privacy_policy','Privacy_Policy');
    Route::get('/return_policy','Return_Policy');
    Route::get('/shipping_policy','Shipping_Policy');
    Route::get('/faqs','FAQs');
    Route::get('/Terms_Condition','Terms_Condition');
    Route::post('/product_details','ProductDetails'); 
    
    
});

Route::controller(VarientsApiController::class)->group(function (){
    Route::get('/get_color', 'get_color');
    Route::get('/get_size', 'get_size');
    Route::get('/notification_type','notification_type'); 
    Route::post('/notifications','notifications'); 
});

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

Route::controller(VendorApiController::class)->group(function(){
    Route::post('/vendor_register', 'vendor_register');  
    Route::post('/vendor_login', 'vendor_login');  
    Route::get('/vendor/{vendor_id}', 'viewProfile');
    Route::post('/add_product', 'add_product');
    Route::get('/vendor_products/{vendorId}', 'view_products_by_vendor');
    Route::post('/product_remove', 'product_remove');
    Route::post('/enable_disable_product', 'enable_disable_product');
    Route::post('/vendor_order_history', 'vendor_order_history');
    Route::post('/vendor_order_status', 'vendor_order_status');
    Route::post('/vendor_order_dispatch', 'vendor_order_dispatch');

  
     
});



  




