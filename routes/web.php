<?php
use Illuminate\Support\Facades\Route;

// Route::get('/', function () {return view('welcome');});
Route::get('/dashboard', function () {return view('admin.index');})->name('dashboard');
//==============================Orders Routes================================//          
Route::get('/orders', function () {return view('orders.orders');})->name('orders');
Route::get('/orders_track', function () {return view('orders.ordertrack');})->name('orders_track');
Route::get('/system_notification', function () {return view('orders.sysnotic');})->name('system_notification');
//=============================Categories Routes=================================//
Route::get('/categories', function() {return view('categories.categories');})->name('categories');
Route::get('/categories_order', function() {return view('categories.categorieorder');})->name('categories_order');
//=============================Brand Routes=================================//
Route::get('/brand', function() {return view('brand.brand');})->name('brand');
Route::get('/bulk_upload', function() {return view('brand.bulkupload');})->name('bulk_upload');
//=============================Sellers Routes=================================//
Route::get('/sellers', function() {return view('sellers.sellers');})->name('sellers');
Route::get('/wallet_transaction', function() {return view('sellers.wallet');})->name('wallet_transaction');

Route::get('/blog_categories', function() {return view('blog.blogcategories');})->name('blog_categories');
Route::get('/create_blog', function() {return view('blog.createblog');})->name('create_blog');

Route::get('/attributes', function() {return view('products.attributes');})->name('attributes');
Route::get('/tax', function() {return view('products.tax');})->name('tax');
Route::get('/add_products', function() { return view('products.addproducts');})->name('add_products');
Route::get('/bulk_upload', function() { return view('products.bulkupload');})->name('bulk_upload');
Route::get('/manage_products', function() { return view('products.manageproducts');})->name('manage_products');
Route::get('/products_faqs', function() { return view('products.productsfaqs');})->name('products_faqs');
Route::get('/product_order', function() { return view('products.productorder');})->name('product_order');

Route::get('/media', function() {return view('media');})->name('media');
Route::get('/sliders', function() {return view('sliders');})->name('sliders');
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

Route::get('/view_customer', function() {return view('customer.viewcustomer');})->name('view_customer');
Route::get('/address', function() {return view('customer.address');})->name('address');
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
Route::get('/contact_us', function()  {return view('system.contactus');})->name('contact_us');
Route::get('/about_us', function() { return view('system.aboutus');})->name('about_us');
Route::get('/privacy_policy', function() {return view('system.privacypolicy');})->name('privacy_policy');
Route::get('/shipping_policy', function() {return view('system.shippingpolicy');})->name('shipping_policy');
Route::get('/return_policy', function() {return view('system.returnpolicy');})->name('return_policy');
Route::get('/admin_policies', function() {return view('system.adminpolicies');})->name('admin_policies');
Route::get('/delivery_boy_policies', function() {return view('system.deliveryboypolicies');})->name('delivery_boy_policies');
Route::get('/seller_policies', function() {return view('system.sellerpolicies');})->name('seller_policies');
Route::get('/system_updater', function() {return view('system.systemupdater');})->name('system_updater');
Route::get('/system_registration', function() {return view('system.systemregistration');})->name('system_registration');

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













