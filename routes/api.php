<?php

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\API;
use App\Http\Controller\Api\AuthController;
use App\Http\Controllers\API\{PublicApiController,ListController};

Route::get('/user', function (Request $request) {
    return $request->user();
})->middleware('auth:sanctum');

Route::post('/store-token', [PublicApiController::class, 'Token']);
Route::post('/register', [PublicApiController::class,'register']);
Route::post('/login', [PublicApiController::class,'login']);
Route::get('/sliders', [PublicApiController::class, 'showSliders']);
Route::get('/categories', [PublicApiController::class, 'showCategories']);
Route::post('/subcategories', [PublicApiController::class, 'subcategories']);
Route::get('/products', [PublicApiController::class, 'getProductsByCategory']);
Route::post('/cart/add', [PublicApiController::class, 'addToCart']);



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






  




