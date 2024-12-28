<?php
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\SystemController;
use App\Http\Controllers\CustomerController;   
use App\Http\Controllers\CategoriesController;     
use App\Http\Controllers\ProductsController;         
use App\Http\Controllers\{OrdersController,SlidersController,LoginsController,VendorController};          

//=============================Login/Logout Routes=================================//
Route::get('/', [LoginsController::class, 'showLoginForm'])->name('login');
Route::post('login', [LoginsController::class, 'login']);
Route::post('logout', [LoginsController::class, 'logout'])->name('logout');
//=============================END Login/Logout Routes=================================//


Route::get('/dashboard', function () {return view('admin.index');})->name('dashboard');
//=============================Orders Routes=================================//
Route::controller(OrdersController::class)->group(function()
{
    Route::get('/orders','manageOrders')->name('orders');
    Route::get('/orders_track', function () {return view('orders.ordertrack');})->name('orders_track');
    Route::get('/system_notification', function () {return view('orders.sysnotic');})->name('system_notification');
    Route::get('/order/{orderId}', 'viewOrderDetails')->name('view_orderdetails');
});
//=============================Orders Routes END=================================//


Route::controller(VendorController::class)->group(function()
{
    Route::get('vendors','index')->name('vendor');
    Route::put('vendor/{id}/status',  'updateStatus')->name('update_vendor_status');
    Route::get('vendor/{id}/details',  'showDetails')->name('vendor_details');
    Route::get('vendor/{id}/products',  'showProducts')->name('vendor_products');
    Route::get('vendor/{id}/profile', 'showDetails')->name('vendor.showDetails');
    Route::get('vendor/{id}/productdetails',  'showProductDetails')->name('vendor_productdetails');


//<form action="{{ route('vendor_productdetails', $vendor->id) }}" method="POST" enctype="multipart/form-data">
});

//=============================Categories Routes=================================//
Route::controller(CategoriesController::class)->group(function() { 
    Route::get('/category', 'ViewCategory')->name('category'); 
    Route::get('/category_order', function () {return view('category.categorieorder'); })->name('categories_order');
    
    Route::get('/categories.create','create' )->name('category.create'); 
    Route::post('/categories.store', 'store')->name('category.store');  
     
    Route::post('/categories/update/{id}', 'update')->name('category.update');
    Route::post('/categories/delete/{id}', 'destroy')->name('category.delete');
    Route::get('/categories/toggle-status/{id}', 'toggleStatus')->name('category.toggleStatus');
    Route::get('category/edit/{id}', 'edit')->name('category.edit');
});
//=============================Categories Routes END=================================//

//=============================Brand Routes=================================//
Route::get('/brand', function() {return view('brand.brand');})->name('brand');
Route::get('/bulk_upload', function() {return view('brand.bulkupload');})->name('bulk_upload');
//=============================Sellers Routes=================================//
Route::get('/sellers', function() {return view('sellers.sellers');})->name('sellers');
Route::get('/wallet_transaction', function() {return view('sellers.wallet');})->name('wallet_transaction');

//=============================Blog Routes=================================//
Route::get('/blog_categories', function() {return view('blog.blogcategories');})->name('blog_categories');
Route::get('/create_blog', function() {return view('blog.createblog');})->name('create_blog');

//=============================Products Routes=================================//
Route::get('/attributes', function() {return view('products.attributes');})->name('attributes');
Route::get('/tax', function() {return view('products.tax');})->name('tax');
Route::get('/bulk_upload', function() { return view('products.bulkupload');})->name('bulk_upload');
Route::get('/products_faqs', function() { return view('products.productsfaqs');})->name('products_faqs');
Route::get('/product_order', function() { return view('products.productorder');})->name('product_order');

Route::controller(ProductsController::class)->group(function() {  
    Route::get('/add_products', 'showAddProductForm')->name('add_products');   
    Route::post('/add_products', 'showAddProductForm')->name('store_product');  
    
    Route::get('/manage_products', 'manageProducts')->name('manage_products');
    Route::get('/admin/product/{id}', 'viewProduct')->name('view_product'); 
    Route::get('/admin/product/{id}/edit', 'editProduct')->name('edit_product'); 
    Route::post('/admin/product/{id}/update-rating', 'updateRating')->name('update_rating'); 
    Route::delete('/admin/product/{id}', 'deleteProduct')->name('delete_product');  
    Route::get('/get-subcategories/{categoryId}',  'getSubcategories');
    // Fix for the toggle_active_inactive route:
    Route::get('/manage_products/toggle/{id}', 'toggleActiveInactive')->name('toggle_active_inactive');
    
});


//=============================Products Routes END=================================//

Route::get('/media', function() {return view('media');})->name('media');

//=============================Sliders Routes=================================//
Route::controller(SlidersController::class)->group(function() {
    Route::get('/slider', 'viewsliders')->name('sliders');
    Route::post('/slider/store', 'store')->name('sliders.store');
    Route::get('/slider/edit/{id}', 'edit')->name('sliders.edit');
    Route::post('/slider/update/{id}', 'update')->name('sliders.update');
    Route::delete('/sliders/{id}', 'destroy')->name('sliders.destroy');
    //Route::delete('sliders/{id}', [SliderController::class, 'destroy'])->name('sliders.destroy');
});
//=============================Sliders Routes END=================================//




Route::get('/offers', function() {return view('offers');})->name('offers');
Route::get('/manage_stock', function() {return view('managestock');})->name('manage_stock');

Route::get('/ticket_type', function() {return view('supportticket.tickettype');})->name('ticket_type');
Route::get('/ticket', function() {return view('supportticket.ticket');})->name('ticket');

Route::get('/promo_code', function() {return view('promocode');})->name('promo_code');
Route::get('/return_request', function() { return view('returnrequest');})->name('return_request');
Route::get('/send_notification', function() {return view('sendnotic');})->name('send_notification');


Route::get('/paymentrequest', function() {return view('paymentrequest');})->name('paymentrequest');

Route::get('/manage_section', function() {return view('featuredSection.managesection');})->name('manage_section');
Route::get('/section_order', function() {return view('featuredSection.sectionorder');})->name('section_order');


Route::controller(CustomerController::class)->group(function () {   
    Route::get('/view_customer', 'ViewCustomers')->name('view_customer'); 
    Route::get('/view_customer/toggle-status/{id}', 'toggleStatus')->name('view_customer.toggleStatus');
    Route::get('/view_address', 'ViewAddress')->name('address');
    
   
    
});

// Route::get('/address', function() {return view('customer.address');})->name('address');
Route::get('/transaction', function() {return view('customer.transaction');})->name('transaction');
Route::get('/wallet_transactions', function() {return view('customer.wallettransaction');})->name('wallet_transactions');

Route::get('/manage_delivery_boy', function() {return view('deliveryboy.manageboy');})->name('manage_delivery_boy');
Route::get('/fund_transfer', function() {return view('deliveryboy.fundtransfer');})->name('fund_transfer');
Route::get('/manage_cash', function() {return view('deliveryboy.managecash');})->name('manage_cash');


Route::get('/store_settings', function() {return view('system.storesettings');})->name('store_settings');
Route::get('/email_settings', function() {return view('system.emailsettings');})->name('email_settings');
Route::get('/payments_methods',  function() {return view('system.paymetmethods');})->name('payments_methods');
Route::get('/shipping_methods', function() {return view('system.shippingmethods');})->name('shipping_methods');
Route::get('/time_slots', function() {return view('system.timeslots');})->name('time_slots');
Route::get('/notification_settings', function() {return view('system.notificationsettings');})->name('notification_settings');

Route::get('/delivery_boy_policies', function() {return view('system.deliveryboypolicies');})->name('delivery_boy_policies');
Route::get('/seller_policies', function() {return view('system.sellerpolicies');})->name('seller_policies');
Route::get('/system_updater', function() {return view('system.systemupdater');})->name('system_updater');
Route::get('/system_registration', function() {return view('system.systemregistration');})->name('system_registration');

//=============================System Routes=================================//
Route::controller(SystemController::class)->group(function () {  
    Route::get('/privacy_policy', 'privacy_policy')->name('privacy_policy');         
    Route::get('/term_condition', 'term_condition')->name('term_condition'); 
    Route::post('/update_privacy', 'update_privacy')->name('update.privacy'); 
    Route::post('/update_termcondition', 'update_termcondition')->name('update.termcondition');
    Route::post('/update_privacy', 'update_privacy')->name('update.privacy');
    
    Route::get('/shipping_policy', 'shipping_policy')->name('shipping_policy');
    Route::get('/about_us', 'about_us')->name('about_us');  
    ROute::get('/contact_us', 'contact_us')->name('contact_us');
    ROute::get('/return_policy', 'return_policy')->name('return_policy');  
    Route::get('/admin_policies', 'admin_policies')->name('admin_policies');      
});
//=============================System Routes END=================================//


Route::get('/firebase', function() {return view('websettings.firebase');})->name('firebase');
Route::get('/general_settings',  function() {return view('websettings.generalsetting');})->name('general_settings');
Route::get('/languages', function() {return view('websettings.languages');})->name('languages');
Route::get('/theme', function() {return view('websettings.theme');})->name('theme');

Route::get('/pickup_location', function() {return view('pickuplocation');})->name('pickup_location');
////Location Route
Route::get('/zip_code', function() {return view('location.zip');})->name('zip_code');
Route::get('/city', function() {return view('location.city');})->name('city');
Route::get('/area', function() {return view('location.area');})->name('area');
Route::get('/counteries', function() {return view('location.counteries');})->name('counteries');
Route::get('/bulks_uploadss', function() { return view('location.bulkupload');})->name('bulk_uploads');

Route::get('/sales_report', function() {return view('reports.salesreport');})->name('sales_report');
Route::get('/sales_inventory', function() {return view('reports.salesinventory');})->name('sales_inventory');
Route::get('/faq', function() {return view('faq');})->name('faq');
Route::get('/system_user', function() {return view('systemuser');})->name('system_user');












