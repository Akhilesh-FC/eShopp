@extends('admin.body.adminmaster')

@section('admin')
<div class="page-wrapper">
    <div class="container-fluid">
    <form action="{{route('languages') }}" method="get"></form>
    
    <div class="content-wrapper">
    <!-- Content Header (Page header) -->
    <!-- Main content -->
    <section class="content-header">
        <div class="container-fluid">
            <div class="row mb-2">
                <div class="col-sm-6">
                    <h4>Languages</h4>
                </div>
                <div class="col-sm-6">
                    <ol class="breadcrumb float-sm-right">
                        <li class="breadcrumb-item"><a href="https://avrluxe.com/admin/home">Home</a></li>
                        <li class="breadcrumb-item active">Languages</li>
                    </ol>
                </div>
            </div>
        </div><!-- /.container-fluid -->
    </section>
    <section class="content">
        <div class="container-fluid">
            <div class="row">
                <div class="col-md-12">
                    <div class="text-right m-2">
                        <a href="#" class="btn btn-primary" data-toggle="modal" data-target="#language-modal">Add Language</a>
                    </div>
                    <div class="card card-info">
                        <!-- form start -->
                        <div class="card-body">
                            <div class="col-md-12">
                                <div class="msg_error p-3 mb-3">Select the Language to add labels.</div>
                                <div class="form-group">
                                    <label for="">Languages</label>
                                    <select name="selected_language" id="selected_language" class="form-control">
                                                                                    <option value="1" >english</option>
                                                                            </select>
                                </div>
                            </div>
                            <form class="form-horizontal" id="update-language-form" action="https://avrluxe.com/admin/language/save" method="POST">
                                <input type="hidden" id="id" name="language_id" value="1">
                                <div class="row">
                                    <hr class="w-100">
                                    <div class="col-md-12 text-center mb-2">
                                        <h4 class="h4">Labels</h4>
                                    </div>
                                    <div class="col-md-12">
                                        <div class="form-group">
                                            <input type="checkbox" name="is_rtl" class="form-checkbox" id="is_rtl" value="0"  />
                                            <label for="is_rtl" class="control-checkbox">Enable RTL</label>
                                        </div>
                                    </div>
                                    <div class="col-md-6">
                                        <div class="form-group">
                                            <label for="menu" class="control-checkbox">Menu</label>
                                            <input type="text" name="menu" class="form-control" value="Menu" />
                                        </div>
                                    </div>
                                    <div class="col-md-6">
                                        <div class="form-group">
                                            <label for="products" class="control-checkbox">Products</label>
                                            <input type="text" name="products" class="form-control" value="Products" />
                                        </div>
                                    </div>
                                    <div class="col-md-6">
                                        <div class="form-group">
                                            <label for="my_account" class="control-checkbox">My Account</label>
                                            <input type="text" name="my_account" class="form-control" value="My Account" />
                                        </div>
                                    </div>
                                    <div class="col-md-6">
                                        <div class="form-group">
                                            <label for="my_orders" class="control-checkbox">My Orders</label>
                                            <input type="text" name="my_orders" class="form-control" value="My Orders" />
                                        </div>
                                    </div>
                                    <div class="col-md-6">
                                        <div class="form-group">
                                            <label for="favorite" class="control-checkbox">Favorite</label>
                                            <input type="text" name="favorite" class="form-control" value="Favorite" />
                                        </div>
                                    </div>
                                    <div class="col-md-6">
                                        <div class="form-group">
                                            <label for="sellers" class="control-checkbox">Sellers</label>
                                            <input type="text" name="sellers" class="form-control" value="sellers" />
                                        </div>
                                    </div>
                                    <div class="col-md-6">
                                        <div class="form-group">
                                            <label for="login" class="control-checkbox">Login</label>
                                            <input type="text" name="login" class="form-control" value="Login" />
                                        </div>
                                    </div>
                                    <div class="col-md-6">
                                        <div class="form-group">
                                            <label for="register" class="control-checkbox">Register</label>
                                            <input type="text" name="register" class="form-control" value="Register" />
                                        </div>
                                    </div>
                                    <div class="col-md-6">
                                        <div class="form-group">
                                            <label for="about_us" class="control-checkbox">About Us</label>
                                            <input type="text" name="about_us" class="form-control" value="About Us" />
                                        </div>
                                    </div>
                                    <div class="col-md-6">
                                        <div class="form-group">
                                            <label for="contact_us" class="control-checkbox">Contact Us</label>
                                            <input type="text" name="contact_us" class="form-control" value="Contact Us" />
                                        </div>
                                    </div>
                                    <div class="col-md-6">
                                        <div class="form-group">
                                            <label for="logout" class="control-checkbox">Logout</label>
                                            <input type="text" name="logout" class="form-control" value="Logout" />
                                        </div>
                                    </div>
                                    <div class="col-md-6">
                                        <div class="form-group">
                                            <label for="language" class="control-checkbox">Language</label>
                                            <input type="text" name="language" class="form-control" value="Language" />
                                        </div>
                                    </div>
                                    <div class="col-md-6">
                                        <div class="form-group">
                                            <label for="shopping_cart" class="control-checkbox">Shopping Cart</label>
                                            <input type="text" name="shopping_cart" class="form-control" value="Shopping Cart" />
                                        </div>
                                    </div>
                                    <div class="col-md-6">
                                        <div class="form-group">
                                            <label for="close" class="control-checkbox">Close</label>
                                            <input type="text" name="close" class="form-control" value="Close" />
                                        </div>
                                    </div>
                                    <div class="col-md-6">
                                        <div class="form-group">
                                            <label for="return_to_shop" class="control-checkbox">Return To Shop</label>
                                            <input type="text" name="return_to_shop" class="form-control" value="Return To Shop" />
                                        </div>
                                    </div>
                                    <div class="col-md-6">
                                        <div class="form-group">
                                            <label for="empty_cart_message" class="control-checkbox">Your Cart Is Empty</label>
                                            <input type="text" name="empty_cart_message" class="form-control" value="Your Cart Is Empty" />
                                        </div>
                                    </div>
                                    <div class="col-md-6">
                                        <div class="form-group">
                                            <label for="view_cart" class="control-checkbox">View Cart</label>
                                            <input type="text" name="view_cart" class="form-control" value="View Cart" />
                                        </div>
                                    </div>
                                    <div class="col-md-6">
                                        <div class="form-group">
                                            <label for="faq" class="control-checkbox">FAQs</label>
                                            <input type="text" name="faq" class="form-control" value="FAQs" />
                                        </div>
                                    </div>
                                    <div class="col-md-6">
                                        <div class="form-group">
                                            <label for="compare" class="control-checkbox">Compare</label>
                                            <input type="text" name="compare" class="form-control" value="Compare" />
                                        </div>
                                    </div>
                                    <div class="col-md-6">
                                        <div class="form-group">
                                            <label for="pages" class="control-checkbox">Pages</label>
                                            <input type="text" name="pages" class="form-control" value="Pages" />
                                        </div>
                                    </div>
                                    <div class="col-md-6">
                                        <div class="form-group">
                                            <label for="social_media" class="control-checkbox">Social Media</label>
                                            <input type="text" name="social_media" class="form-control" value="Social Media" />
                                        </div>
                                    </div>
                                    <div class="col-md-6">
                                        <div class="form-group">
                                            <label for="terms_and_condition" class="control-checkbox">Terms & Condition</label>
                                            <input type="text" name="terms_and_condition" class="form-control" value="Terms & Condition" />
                                        </div>
                                    </div>
                                    <div class="col-md-6">
                                        <div class="form-group">
                                            <label for="privacy_policy" class="control-checkbox">Privacy Policy</label>
                                            <input type="text" name="privacy_policy" class="form-control" value="Privacy Policy" />
                                        </div>
                                    </div>
                                    <div class="col-md-6">
                                        <div class="form-group">
                                            <label for="reviews" class="control-checkbox">Reviews</label>
                                            <input type="text" name="reviews" class="form-control" value="Reviews" />
                                        </div>
                                    </div>
                                    <div class="col-md-6">
                                        <div class="form-group">
                                            <label for="add_to_cart" class="control-checkbox">Add to Cart</label>
                                            <input type="text" name="add_to_cart" class="form-control" value="Add to Cart" />
                                        </div>
                                    </div>
                                    <div class="col-md-6">
                                        <div class="form-group">
                                            <label for="add_to_favorite" class="control-checkbox">Add to Favorite</label>
                                            <input type="text" name="add_to_favorite" class="form-control" value="Add to Favorite" />
                                        </div>
                                    </div>
                                    <div class="col-md-6">
                                        <div class="form-group">
                                            <label for="cancel" class="control-checkbox">Cancel</label>
                                            <input type="text" name="cancel" class="form-control" value="Cancel" />
                                        </div>
                                    </div>
                                    <div class="col-md-6">
                                        <div class="form-group">
                                            <label for="send_otp" class="control-checkbox">Send OTP</label>
                                            <input type="text" name="send_otp" class="form-control" value="Send OTP" />
                                        </div>
                                    </div>
                                    <div class="col-md-6">
                                        <div class="form-group">
                                            <label for="submit" class="control-checkbox">Submit</label>
                                            <input type="text" name="submit" class="form-control" value="Submit" />
                                        </div>
                                    </div>
                                    <div class="col-md-6">
                                        <div class="form-group">
                                            <label for="home" class="control-checkbox">Home</label>
                                            <input type="text" name="home" class="form-control" value="Home" />
                                        </div>
                                    </div>
                                     <div class="col-md-6">
                                        <div class="form-group">
                                            <label for="name" class="control-checkbox">Name</label>
                                            <input type="text" name="name" class="form-control" value="Name" />
                                        </div>
                                    </div>
                                    <div class="col-md-6">
                                        <div class="form-group">
                                            <label for="mobile_number" class="control-checkbox">Mobile Number</label>
                                            <input type="text" name="mobile_number" class="form-control" value="Mobile Number" />
                                        </div>
                                    </div>
                                    <div class="col-md-6">
                                        <div class="form-group">
                                            <label for="address" class="control-checkbox">Address</label>
                                            <input type="text" name="address" class="form-control" value="Address" />
                                        </div>
                                    </div>
                                    <div class="col-md-6">
                                        <div class="form-group">
                                            <label for="city" class="control-checkbox">City</label>
                                            <input type="text" name="city" class="form-control" value="City" />
                                        </div>
                                    </div>
                                    <div class="col-md-6">
                                        <div class="form-group">
                                            <label for="select_city" class="control-checkbox">Select City</label>
                                            <input type="text" name="select_city" class="form-control" value="Select City" />
                                        </div>
                                    </div>
                                    <div class="col-md-6">
                                        <div class="form-group">
                                            <label for="select_area" class="control-checkbox">Select Area</label>
                                            <input type="text" name="select_area" class="form-control" value="Select Area" />
                                        </div>
                                    </div>
                                    <div class="col-md-6">
                                        <div class="form-group">
                                            <label for="area" class="control-checkbox">Area</label>
                                            <input type="text" name="area" class="form-control" value="Area" />
                                        </div>
                                    </div>
                                    <div class="col-md-6">
                                        <div class="form-group">
                                            <label for="pincode" class="control-checkbox">Pincode</label>
                                            <input type="text" name="pincode" class="form-control" value="Pincode" />
                                        </div>
                                    </div>
                                    <div class="col-md-6">
                                        <div class="form-group">
                                            <label for="state" class="control-checkbox">State</label>
                                            <input type="text" name="state" class="form-control" value="State" />
                                        </div>
                                    </div>
                                    <div class="col-md-6">
                                        <div class="form-group">
                                            <label for="country" class="control-checkbox">Country</label>
                                            <input type="text" name="country" class="form-control" value="Country" />
                                        </div>
                                    </div>
                                    <div class="col-md-6">
                                        <div class="form-group">
                                            <label for="type" class="control-checkbox">Type</label>
                                            <input type="text" name="type" class="form-control" value="Type" />
                                        </div>
                                    </div>
                                    <div class="col-md-6">
                                        <div class="form-group">
                                            <label for="office" class="control-checkbox">Office</label>
                                            <input type="text" name="office" class="form-control" value="Office" />
                                        </div>
                                    </div>
                                    <div class="col-md-6">
                                        <div class="form-group">
                                            <label for="other" class="control-checkbox">Other</label>
                                            <input type="text" name="other" class="form-control" value="Other" />
                                        </div>
                                    </div>
                                    <div class="col-md-6">
                                        <div class="form-group">
                                            <label for="alternate_mobile" class="control-checkbox">Alternate Mobile</label>
                                            <input type="text" name="alternate_mobile" class="form-control" value="Alternate Mobile" />
                                        </div>
                                    </div>
                                    <div class="col-md-6">
                                        <div class="form-group">
                                            <label for="landmark" class="control-checkbox">Landmark</label>
                                            <input type="text" name="landmark" class="form-control" value="Landmark" />
                                        </div>
                                    </div>
                                    <div class="col-md-6">
                                        <div class="form-group">
                                            <label for="action" class="control-checkbox">Action</label>
                                            <input type="text" name="action" class="form-control" value="Action" />
                                        </div>
                                    </div>
                                    <div class="col-md-6">
                                        <div class="form-group">
                                            <label for="edit_address" class="control-checkbox">Edit Address</label>
                                            <input type="text" name="edit_address" class="form-control" value="Edit Address" />
                                        </div>
                                    </div>
                                    <div class="col-md-6">
                                        <div class="form-group">
                                            <label for="image" class="control-checkbox">Image</label>
                                            <input type="text" name="image" class="form-control" value="Image" />
                                        </div>
                                    </div>
                                    <div class="col-md-6">
                                        <div class="form-group">
                                            <label for="price" class="control-checkbox">Price</label>
                                            <input type="text" name="price" class="form-control" value="Price" />
                                        </div>
                                    </div>
                                    <div class="col-md-6">
                                        <div class="form-group">
                                            <label for="quantity" class="control-checkbox">Quantity</label>
                                            <input type="text" name="quantity" class="form-control" value="Quantity" />
                                        </div>
                                    </div>
                                    <div class="col-md-6">
                                        <div class="form-group">
                                            <label for="total" class="control-checkbox">Total</label>
                                            <input type="text" name="total" class="form-control" value="Total" />
                                        </div>
                                    </div>
                                    <div class="col-md-6">
                                        <div class="form-group">
                                            <label for="save_for_later" class="control-checkbox">Save For Later</label>
                                            <input type="text" name="save_for_later" class="form-control" value="Save For Later" />
                                        </div>
                                    </div>
                                    <div class="col-md-6">
                                        <div class="form-group">
                                            <label for="remove" class="control-checkbox">Remove</label>
                                            <input type="text" name="remove" class="form-control" value="Remove" />
                                        </div>
                                    </div>
                                    <div class="col-md-6">
                                        <div class="form-group">
                                            <label for="subtotal" class="control-checkbox">Subtotal</label>
                                            <input type="text" name="subtotal" class="form-control" value="Subtotal" />
                                        </div>
                                    </div>
                                    <div class="col-md-6">
                                        <div class="form-group">
                                            <label for="tax" class="control-checkbox">Tax</label>
                                            <input type="text" name="tax" class="form-control" value="Tax" />
                                        </div>
                                    </div>
                                    <div class="col-md-6">
                                        <div class="form-group">
                                            <label for="delivery_charge" class="control-checkbox">Delivery Charge</label>
                                            <input type="text" name="delivery_charge" class="form-control" value="Delivery Charge" />
                                        </div>
                                    </div>
                                    <div class="col-md-6">
                                        <div class="form-group">
                                            <label for="grand_total" class="control-checkbox">Grand Total</label>
                                            <input type="text" name="grand_total" class="form-control" value="Grand Total" />
                                        </div>
                                    </div>
                                    <div class="col-md-6">
                                        <div class="form-group">
                                            <label for="checkout" class="control-checkbox">Checkout</label>
                                            <input type="text" name="checkout" class="form-control" value="Checkout" />
                                        </div>
                                    </div>
                                    <div class="col-md-6">
                                        <div class="form-group">
                                            <label for="move_to_cart" class="control-checkbox">Move to cart</label>
                                            <input type="text" name="move_to_cart" class="form-control" value="Move to cart" />
                                        </div>
                                    </div>
                                    <div class="col-md-6">
                                        <div class="form-group">
                                            <label for="category" class="control-checkbox">Category</label>
                                            <input type="text" name="category" class="form-control" value="Category" />
                                        </div>
                                    </div>
                                    <div class="col-md-6">
                                        <div class="form-group">
                                            <label for="cart" class="control-checkbox">Cart</label>
                                            <input type="text" name="cart" class="form-control" value="Cart" />
                                        </div>
                                    </div>
                                    <div class="col-md-6">
                                        <div class="form-group">
                                            <label for="your_cart" class="control-checkbox">Your cart</label>
                                            <input type="text" name="your_cart" class="form-control" value="Your cart" />
                                        </div>
                                    </div>
                                    <div class="col-md-6">
                                        <div class="form-group">
                                            <label for="promo_code" class="control-checkbox">Promo code</label>
                                            <input type="text" name="promo_code" class="form-control" value="Promo code" />
                                        </div>
                                    </div>
                                    <div class="col-md-6">
                                        <div class="form-group">
                                            <label for="redeem" class="control-checkbox">Redeem</label>
                                            <input type="text" name="redeem" class="form-control" value="Redeem" />
                                        </div>
                                    </div>
                                    <div class="col-md-6">
                                        <div class="form-group">
                                            <label for="clear" class="control-checkbox">Clear</label>
                                            <input type="text" name="clear" class="form-control" value="Clear" />
                                        </div>
                                    </div>
                                    <div class="col-md-6">
                                        <div class="form-group">
                                            <label for="billing_address" class="control-checkbox">Billing address</label>
                                            <input type="text" name="billing_address" class="form-control" value="Billing address" />
                                        </div>
                                    </div>
                                    <div class="col-md-6">
                                        <div class="form-group">
                                            <label for="preferred_delivery_date_time" class="control-checkbox">Preferred Delivery Date / Time</label>
                                            <input type="text" name="preferred_delivery_date_time" class="form-control" value="Preferred Delivery Date / Time" />
                                        </div>
                                    </div>
                                    <div class="col-md-6">
                                        <div class="form-group">
                                            <label for="select_payment_method" class="control-checkbox">Select Payment Method</label>
                                            <input type="text" name="select_payment_method" class="form-control" value="Select Payment Method" />
                                        </div>
                                    </div>
                                    <div class="col-md-6">
                                        <div class="form-group">
                                            <label for="cash_on_delivery" class="control-checkbox">Cash On Delivery</label>
                                            <input type="text" name="cash_on_delivery" class="form-control" value="Cash On Delivery" />
                                        </div>
                                    </div>
                                    <div class="col-md-6">
                                        <div class="form-group">
                                            <label for="create_a_new_address" class="control-checkbox">Create a New Address</label>
                                            <input type="text" name="create_a_new_address" class="form-control" value="Create a New Address" />
                                        </div>
                                    </div>
                                    <div class="col-md-6">
                                        <div class="form-group">
                                            <label for="shipping_address" class="control-checkbox">Shipping Address</label>
                                            <input type="text" name="shipping_address" class="form-control" value="Shipping Address" />
                                        </div>
                                    </div>
                                    <div class="col-md-6">
                                        <div class="form-group">
                                            <label for="save" class="control-checkbox">Save</label>
                                            <input type="text" name="save" class="form-control" value="Save" />
                                        </div>
                                    </div>
                                    <div class="col-md-6">
                                        <div class="form-group">
                                            <label for="username" class="control-checkbox">Username</label>
                                            <input type="text" name="username" class="form-control" value="Username" />
                                        </div>
                                    </div>
                                    <div class="col-md-6">
                                        <div class="form-group">
                                            <label for="email" class="control-checkbox">Email</label>
                                            <input type="text" name="email" class="form-control" value="Email" />
                                        </div>
                                    </div>
                                    <div class="col-md-6">
                                        <div class="form-group">
                                            <label for="subject" class="control-checkbox">Subject</label>
                                            <input type="text" name="subject" class="form-control" value="Subject" />
                                        </div>
                                    </div>
                                    <div class="col-md-6">
                                        <div class="form-group">
                                            <label for="message" class="control-checkbox">Message</label>
                                            <input type="text" name="message" class="form-control" value="Message" />
                                        </div>
                                    </div>
                                    <div class="col-md-6">
                                        <div class="form-group">
                                            <label for="send_message" class="control-checkbox">Send Message</label>
                                            <input type="text" name="send_message" class="form-control" value="Send Message" />
                                        </div>
                                    </div>
                                    <div class="col-md-6">
                                        <div class="form-group">
                                            <label for="dashboard" class="control-checkbox">Dashboard</label>
                                            <input type="text" name="dashboard" class="form-control" value="Dashboard" />
                                        </div>
                                    </div>
                                    <div class="col-md-6">
                                        <div class="form-group">
                                            <label for="profile" class="control-checkbox">Profile</label>
                                            <input type="text" name="profile" class="form-control" value="Profile" />
                                        </div>
                                    </div>
                                    <div class="col-md-6">
                                        <div class="form-group">
                                            <label for="orders" class="control-checkbox">Orders</label>
                                            <input type="text" name="orders" class="form-control" value="Orders" />
                                        </div>
                                    </div>
                                    <div class="col-md-6">
                                        <div class="form-group">
                                            <label for="notification" class="control-checkbox">Notification</label>
                                            <input type="text" name="notification" class="form-control" value="Notification" />
                                        </div>
                                    </div>
                                    <div class="col-md-6">
                                        <div class="form-group">
                                            <label for="wallet" class="control-checkbox">Wallet</label>
                                            <input type="text" name="wallet" class="form-control" value="Wallet" />
                                        </div>
                                    </div>
                                    <div class="col-md-6">
                                        <div class="form-group">
                                            <label for="transaction" class="control-checkbox">Transaction</label>
                                            <input type="text" name="transaction" class="form-control" value="Transaction" />
                                        </div>
                                    </div>
                                    <div class="col-md-6">
                                        <div class="form-group">
                                            <label for="no_favorite_product_message" class="control-checkbox">No Favorite Products Found</label>
                                            <input type="text" name="no_favorite_product_message" class="form-control" value="No Favorite Products Found" />
                                        </div>
                                    </div>
                                    <div class="col-md-6">
                                        <div class="form-group">
                                            <label for="amazing_categories" class="control-checkbox">Amazing Categories</label>
                                            <input type="text" name="amazing_categories" class="form-control" value="Amazing Categories" />
                                        </div>
                                    </div>
                                    <div class="col-md-6">
                                        <div class="form-grouplabel_create_new
                                            <label for=" view_more" class="control-checkbox">View More</label>
                                            <input type="text" name="view_more" class="form-control" value="View More" />
                                        </div>
                                    </div>
                                    <div class="col-md-6">
                                        <div class="form-group">
                                            <label for="mobile_app" class="control-checkbox">Mobile App</label>
                                            <input type="text" name="mobile_app" class="form-control" value="Mobile App" />
                                        </div>
                                    </div>
                                    <div class="col-md-6">
                                        <div class="form-group">
                                            <label for="order_id" class="control-checkbox">Order ID</label>
                                            <input type="text" name="order_id" class="form-control" value="Order ID" />
                                        </div>
                                    </div>
                                    <div class="col-md-6">
                                        <div class="form-group">
                                            <label for="place_on" class="control-checkbox">Place On</label>
                                            <input type="text" name="place_on" class="form-control" value="Place On" />
                                        </div>
                                    </div>
                                    <div class="col-md-6">
                                        <div class="form-group">
                                            <label for="invoice" class="control-checkbox">Invoice</label>
                                            <input type="text" name="invoice" class="form-control" value="Invoice" />
                                        </div>
                                    </div>
                                    <div class="col-md-6">
                                        <div class="form-group">
                                            <label for="back_to_list" class="control-checkbox">Back to List</label>
                                            <input type="text" name="back_to_list" class="form-control" value="Back to List" />
                                        </div>
                                    </div>
                                    <div class="col-md-6">
                                        <div class="form-group">
                                            <label for="return" class="control-checkbox">Return</label>
                                            <input type="text" name="return" class="form-control" value="Return" />
                                        </div>
                                    </div>
                                    <div class="col-md-6">
                                        <div class="form-group">
                                            <label for="shipping_details" class="control-checkbox">Shipping Details</label>
                                            <input type="text" name="shipping_details" class="form-control" value="Shipping Details" />
                                        </div>
                                    </div>
                                    <div class="col-md-6">
                                        <div class="form-group">
                                            <label for="total_order_price" class="control-checkbox">Total Order Price</label>
                                            <input type="text" name="total_order_price" class="form-control" value="Total Order Price" />
                                        </div>
                                    </div>
                                    <div class="col-md-6">
                                        <div class="form-group">
                                            <label for="promocode_discount" class="control-checkbox">Promocode Discount</label>
                                            <input type="text" name="promocode_discount" class="form-control" value="Promocode Discount" />
                                        </div>
                                    </div>
                                    <div class="col-md-6">
                                        <div class="form-group">
                                            <label for="wallet_used" class="control-checkbox">Wallet Used</label>
                                            <input type="text" name="wallet_used" class="form-control" value="Wallet Used" />
                                        </div>
                                    </div>
                                    <div class="col-md-6">
                                        <div class="form-group">
                                            <label for="final_total" class="control-checkbox">Final Total</label>
                                            <input type="text" name="final_total" class="form-control" value="Final Total" />
                                        </div>
                                    </div>
                                    <div class="col-md-6">
                                        <div class="form-group">
                                            <label for="view_details" class="control-checkbox">View Details</label>
                                            <input type="text" name="view_details" class="form-control" value="View Details" />
                                        </div>
                                    </div>
                                    <div class="col-md-6">
                                        <div class="form-group">
                                            <label for="payment_cancelled" class="control-checkbox">Payment Cancelled / Failed</label>
                                            <input type="text" name="payment_cancelled" class="form-control" value="Payment Cancelled / Failed" />
                                        </div>
                                    </div>
                                    <div class="col-md-6">
                                        <div class="form-group">
                                            <label for="payment_cancelled_message" class="control-checkbox">It seems like payment process is failed or cancelled.Please Try again.</label>
                                            <input type="text" name="payment_cancelled_message" class="form-control" value="It seems like payment process is failed or cancelled.Please Try again." />
                                        </div>
                                    </div>
                                    <div class="col-md-6">
                                        <div class="form-group">
                                            <label for="payment_completed" class="control-checkbox">Payment Complete</label>
                                            <input type="text" name="payment_completed" class="form-control" value="Payment Complete" />
                                        </div>
                                    </div>
                                    <div class="col-md-6">
                                        <div class="form-group">
                                            <label for="payment_completed_message" class="control-checkbox">Payment Completed Succesfully</label>
                                            <input type="text" name="payment_completed_message" class="form-control" value="Payment Completed Succesfully" />
                                        </div>
                                    </div>
                                    <div class="col-md-6">
                                        <div class="form-group">
                                            <label for="thank_you_for_shopping_with_us" class="control-checkbox">Thank you for Shopping with Us</label>
                                            <input type="text" name="thank_you_for_shopping_with_us" class="form-control" value="Thank you for Shopping with Us" />
                                        </div>
                                    </div>
                                    <div class="col-md-6">
                                        <div class="form-group">
                                            <label for="filter" class="control-checkbox">Filter</label>
                                            <input type="text" name="filter" class="form-control" value="Filter" />
                                        </div>
                                    </div>
                                    <div class="col-md-6">
                                        <div class="form-group">
                                            <label for="top_rated" class="control-checkbox">Top Rated</label>
                                            <input type="text" name="top_rated" class="form-control" value="Top Rated" />
                                        </div>
                                    </div>
                                    <div class="col-md-6">
                                        <div class="form-group">
                                            <label for="newest_first" class="control-checkbox">Newest First</label>
                                            <input type="text" name="newest_first" class="form-control" value="Newest First" />
                                        </div>
                                    </div>
                                    <div class="col-md-6">
                                        <div class="form-group">
                                            <label for="oldest_first" class="control-checkbox">Oldest First</label>
                                            <input type="text" name="oldest_first" class="form-control" value="Oldest First" />
                                        </div>
                                    </div>
                                    <div class="col-md-6">
                                        <div class="form-group">
                                            <label for="price_low_to_high" class="control-checkbox">Price - Low To High</label>
                                            <input type="text" name="price_low_to_high" class="form-control" value="Price - Low To High" />
                                        </div>
                                    </div>
                                    <div class="col-md-6">
                                        <div class="form-group">
                                            <label for="price_high_to_low" class="control-checkbox">Price - High To Low</label>
                                            <input type="text" name="price_high_to_low" class="form-control" value="Price - High To Low" />
                                        </div>
                                    </div>
                                    <div class="col-md-6">
                                        <div class="form-group">
                                            <label for="relevance" class="control-checkbox">Relevance</label>
                                            <input type="text" name="relevance" class="form-control" value="Relevance" />
                                        </div>
                                    </div>
                                    <div class="col-md-6">
                                        <div class="form-group">
                                            <label for="sale" class="control-checkbox">Sale</label>
                                            <input type="text" name="sale" class="form-control" value="Sale" />
                                        </div>
                                    </div>
                                    <div class="col-md-6">
                                        <div class="form-group">
                                            <label for="view" class="control-checkbox">View</label>
                                            <input type="text" name="view" class="form-control" value="View" />
                                        </div>
                                    </div>
                                    <div class="col-md-6">
                                        <div class="form-group">
                                            <label for="back_to_top" class="control-checkbox">Back to top</label>
                                            <input type="text" name="back_to_top" class="form-control" value="Back to top" />
                                        </div>
                                    </div>
                                    <div class="col-md-6">
                                        <div class="form-group">
                                            <label for="go_to_shop" class="control-checkbox">Go to Shop</label>
                                            <input type="text" name="go_to_shop" class="form-control" value="Go to Shop" />
                                        </div>
                                    </div>
                                    <div class="col-md-6">
                                        <div class="form-group">
                                            <label for="details" class="control-checkbox">Details</label>
                                            <input type="text" name="details" class="form-control" value="Details" />
                                        </div>
                                    </div>
                                    <div class="col-md-6">
                                        <div class="form-group">
                                            <label for="remove_from_favorite" class="control-checkbox">Remove from Favorite</label>
                                            <input type="text" name="remove_from_favorite" class="form-control" value="Remove from Favorite" />
                                        </div>
                                    </div>
                                    <div class="col-md-6">
                                        <div class="form-group">
                                            <label for="specification" class="control-checkbox">Specifications</label>
                                            <input type="text" name="specification" class="form-control" value="Specifications" />
                                        </div>
                                    </div>
                                    <div class="col-md-6">
                                        <div class="form-group">
                                            <label for="rating" class="control-checkbox">Rating</label>
                                            <input type="text" name="rating" class="form-control" value="Rating" />
                                        </div>
                                    </div>
                                    <div class="col-md-6">
                                        <div class="form-group">
                                            <label for="related_products" class="control-checkbox">Related Products</label>
                                            <input type="text" name="related_products" class="form-control" value="Related Products" />
                                        </div>
                                    </div>
                                    <div class="col-md-6">
                                        <div class="form-group">
                                            <label for="old_password" class="control-checkbox">Old Password</label>
                                            <input type="text" name="old_password" class="form-control" value="Old Password" />
                                        </div>
                                    </div>
                                    <div class="col-md-6">
                                        <div class="form-group">
                                            <label for="new_password" class="control-checkbox">New Password</label>
                                            <input type="text" name="new_password" class="form-control" value="New Password" />
                                        </div>
                                    </div>
                                    <div class="col-md-6">
                                        <div class="form-group">
                                            <label for="confirm_new_password" class="control-checkbox">Confirm New Password</label>
                                            <input type="text" name="confirm_new_password" class="form-control" value="Confirm New Password" />
                                        </div>
                                    </div>
                                    <div class="col-md-6">
                                        <div class="form-group">
                                            <label for="reset" class="control-checkbox">Reset</label>
                                            <input type="text" name="reset" class="form-control" value="Reset" />
                                        </div>
                                    </div>
                                    <div class="col-md-6">
                                        <div class="form-group">
                                            <label for="update_profile" class="control-checkbox">Update Profile</label>
                                            <input type="text" name="update_profile" class="form-control" value="Update Profile" />
                                        </div>
                                    </div>
                                    <div class="col-md-6">
                                        <div class="form-group">
                                            <label for="transactions" class="control-checkbox">Transactions</label>
                                            <input type="text" name="transactions" class="form-control" value="Transactions" />
                                        </div>
                                    </div>
                                    <div class="col-md-6">
                                        <div class="form-group">
                                            <label for="wallet" class="control-checkbox">Wallet</label>
                                            <input type="text" name="wallet" class="form-control" value="Wallet" />
                                        </div>
                                    </div>
                                    <div class="col-md-6">
                                        <div class="form-group">
                                            <label for="newsletter" class="control-checkbox">Newsletter</label>
                                            <input type="text" name="newsletter" class="form-control" value="Newsletter" />
                                        </div>
                                    </div>
                                    <div class="col-md-6">
                                        <div class="form-group">
                                            <label for="useful_links" class="control-checkbox">Useful Links</label>
                                            <input type="text" name="useful_links" class="form-control" value="Useful Links" />
                                        </div>
                                    </div>
                                    <div class="col-md-6">
                                        <div class="form-group">
                                            <label for="subscribe" class="control-checkbox">Subscribe</label>
                                            <input type="text" name="subscribe" class="form-control" value="Subscribe" />
                                        </div>
                                    </div>
                                    <div class="col-md-6">
                                        <div class="form-group">
                                            <label for="follow_us" class="control-checkbox">Follow us</label>
                                            <input type="text" name="follow_us" class="form-control" value="Follow us" />
                                        </div>
                                    </div>
                                    <div class="col-md-6">
                                        <div class="form-group">
                                            <label for="find_us" class="control-checkbox">Find Us</label>
                                            <input type="text" name="find_us" class="form-control" value="Find Us" />
                                        </div>
                                    </div>
                                    <div class="col-md-6">
                                        <div class="form-group">
                                            <label for="call_us" class="control-checkbox">Call Us</label>
                                            <input type="text" name="call_us" class="form-control" value="Call Us" />
                                        </div>
                                    </div>
                                    <div class="col-md-6">
                                        <div class="form-group">
                                            <label for="wallet" class="control-checkbox">Mail Us</label>
                                            <input type="text" name="mail_us" class="form-control" value="Mail Us" />
                                        </div>
                                    </div>
                                    <div class="col-md-6">
                                        <div class="form-group">
                                            <label for="mail_us" class="control-checkbox">Mail Us</label>
                                            <input type="text" name="mail_us" class="form-control" value="Mail Us" />
                                        </div>
                                    </div>
                                    <div class="col-md-6">
                                        <div class="form-group">
                                            <label for="forgot_password" class="control-checkbox">Forgot Password</label>
                                            <input type="text" name="forgot_password" class="form-control" value="Forgot Password" />
                                        </div>
                                    </div>
                                    <div class="col-md-6">
                                        <div class="form-group">
                                            <label for="see_all" class="control-checkbox">See All</label>
                                            <input type="text" name="see_all" class="form-control" value="See All" />
                                        </div>
                                    </div>
                                    <div class="col-md-6">
                                        <div class="form-group">
                                            <label for="sort_by" class="control-checkbox">Sort By</label>
                                            <input type="text" name="sort_by" class="form-control" value="Sort By" />
                                        </div>
                                    </div>
                                    <div class="col-md-6">
                                        <div class="form-group">
                                            <label for="show" class="control-checkbox">Show</label>
                                            <input type="text" name="show" class="form-control" value="Show" />
                                        </div>
                                    </div>
                                    <div class="col-md-6">
                                        <div class="form-group">
                                            <label for="product_listing" class="control-checkbox">Product Listing</label>
                                            <input type="text" name="product_listing" class="form-control" value="Product Listing" />
                                        </div>
                                    </div>
                                    <div class="col-md-6">
                                        <div class="form-group">
                                            <label for="balance" class="control-checkbox">Balance</label>
                                            <input type="text" name="balance" class="form-control" value="Balance" />
                                        </div>
                                    </div>
                                    <div class="col-md-6">
                                        <div class="form-group">
                                            <label for="sellers" class="control-checkbox">Sellers</label>
                                            <input type="text" name="sellers" class="form-control" value="Sellers" />
                                        </div>
                                    </div>
                                    <div class="col-md-6">
                                        <div class="form-group">
                                            <label for="enter_valid_number" class="control-checkbox">Enter Valid Number</label>
                                            <input type="text" name="enter_valid_number" class="form-control" value="Enter Valid Number" />
                                        </div>
                                    </div>
                                    <div class="col-md-6">
                                        <div class="form-group">
                                            <label for="compare" class="control-checkbox">Compare</label>
                                            <input type="text" name="compare" class="form-control" value="Compare" />
                                        </div>
                                    </div>
                                    <div class="col-md-6">
                                        <div class="form-group">
                                            <label for="clear_cart" class="control-checkbox">Clear Cart</label>
                                            <input type="text" name="clear_cart" class="form-control" value="Clear Cart" />
                                        </div>
                                    </div>
                                    <div class="col-md-6">
                                        <div class="form-group">
                                            <label for="product" class="control-checkbox">Product</label>
                                            <input type="text" name="product" class="form-control" value="Product" />
                                        </div>
                                    </div>
                                    <div class="col-md-6">
                                        <div class="form-group">
                                            <label for="cart_total" class="control-checkbox">Cart Total</label>
                                            <input type="text" name="cart_total" class="form-control" value="Cart Total" />
                                        </div>
                                    </div>
                                    <div class="col-md-6">
                                        <div class="form-group">
                                            <label for="go_to_checkout" class="control-checkbox">Go To Checkout</label>
                                            <input type="text" name="go_to_checkout" class="form-control" value="Go To Checkout" />
                                        </div>
                                    </div>
                                    <div class="col-md-6">
                                        <div class="form-group">
                                            <label for="billing_details" class="control-checkbox">Billing Details</label>
                                            <input type="text" name="billing_details" class="form-control" value="Billing Details" />
                                        </div>
                                    </div>
                                    <div class="col-md-6">
                                        <div class="form-group">
                                            <label for="wallet_balance" class="control-checkbox">Wallet Balance</label>
                                            <input type="text" name="wallet_balance" class="form-control" value="Wallet Balance" />
                                        </div>
                                    </div>
                                    <div class="col-md-6">
                                        <div class="form-group">
                                            <label for="available_balance" class="control-checkbox">Available Balance</label>
                                            <input type="text" name="available_balance" class="form-control" value="Available Balance" />
                                        </div>
                                    </div>
                                    <div class="col-md-6">
                                        <div class="form-group">
                                            <label for="payment_method" class="control-checkbox">Payment Method</label>
                                            <input type="text" name="payment_method" class="form-control" value="Payment Method" />
                                        </div>
                                    </div>
                                    <div class="col-md-6">
                                        <div class="form-group">
                                            <label for="account_details" class="control-checkbox">Account Details</label>
                                            <input type="text" name="account_details" class="form-control" value="Account Details" />
                                        </div>
                                    </div>
                                    <div class="col-md-6">
                                        <div class="form-group">
                                            <label for="account_name" class="control-checkbox">Account Name</label>
                                            <input type="text" name="account_name" class="form-control" value="Account Name" />
                                        </div>
                                    </div>
                                    <div class="col-md-6">
                                        <div class="form-group">
                                            <label for="account_number" class="control-checkbox">Account Number</label>
                                            <input type="text" name="account_number" class="form-control" value="Account Number" />
                                        </div>
                                    </div>
                                    <div class="col-md-6">
                                        <div class="form-group">
                                            <label for="bank_name" class="control-checkbox">Bank Name</label>
                                            <input type="text" name="bank_name" class="form-control" value="Bank Name" />
                                        </div>
                                    </div>
                                    <div class="col-md-6">
                                        <div class="form-group">
                                            <label for="bank_code" class="control-checkbox">Bank Code</label>
                                            <input type="text" name="bank_code" class="form-control" value="Bank Code" />
                                        </div>
                                    </div>
                                    <div class="col-md-6">
                                        <div class="form-group">
                                            <label for="extra_details" class="control-checkbox">Extra Details</label>
                                            <input type="text" name="extra_details" class="form-control" value="Extra Details" />
                                        </div>
                                    </div>
                                    <div class="col-md-6">
                                        <div class="form-group">
                                            <label for="order_summary" class="control-checkbox">Order Summary</label>
                                            <input type="text" name="order_summary" class="form-control" value="Order Summary" />
                                        </div>
                                    </div>
                                    <div class="col-md-6">
                                        <div class="form-group">
                                            <label for="qty" class="control-checkbox">Quantity</label>
                                            <input type="text" name="qty" class="form-control" value="Qty" />
                                        </div>
                                    </div>
                                    <div class="col-md-6">
                                        <div class="form-group">
                                            <label for="promocode" class="control-checkbox">Promo Code</label>
                                            <input type="text" name="promocode" class="form-control" value="Promo Code" />
                                        </div>
                                    </div>
                                    <div class="col-md-6">
                                        <div class="form-group">
                                            <label for="see_all_offers" class="control-checkbox">See All Offers</label>
                                            <input type="text" name="see_all_offers" class="form-control" value="See All Offers" />
                                        </div>
                                    </div>
                                    <div class="col-md-6">
                                        <div class="form-group">
                                            <label for="place_order" class="control-checkbox">Place Order</label>
                                            <input type="text" name="place_order" class="form-control" value="Place Order" />
                                        </div>
                                    </div>
                                    <div class="col-md-6">
                                        <div class="form-group">
                                            <label for="thank_you_for_shopping" class="control-checkbox">Thank You For Shopping</label>
                                            <input type="text" name="thank_you_for_shopping" class="form-control" value="Thank You For Shopping" />
                                        </div>
                                    </div>
                                    <div class="col-md-6">
                                        <div class="form-group">
                                            <label for="continue_shopping" class="control-checkbox">Continue Shopping</label>
                                            <input type="text" name="continue_shopping" class="form-control" value="Continue Shopping" />
                                        </div>
                                    </div>
                                    <div class="col-md-6">
                                        <div class="form-group">
                                            <label for="shipping_policy" class="control-checkbox">Shipping Policy</label>
                                            <input type="text" name="shipping_policy" class="form-control" value="Shipping Policy" />
                                        </div>
                                    </div>
                                    <div class="col-md-6">
                                        <div class="form-group">
                                            <label for="return_policy" class="control-checkbox">Return Policy</label>
                                            <input type="text" name="return_policy" class="form-control" value="Return Policy" />
                                        </div>
                                    </div>
                                    <div class="col-md-6">
                                        <div class="form-group">
                                            <label for="payment_cancelled_description" class="control-checkbox">Payment Cancelled Description</label>
                                            <input type="text" name="payment_cancelled_description" class="form-control" value="Payment Cancelled Description" />
                                        </div>
                                    </div>
                                    <div class="col-md-6">
                                        <div class="form-group">
                                            <label for="pick_your_favorite_color" class="control-checkbox">Pick Your Favorite Color</label>
                                            <input type="text" name="pick_your_favorite_color" class="form-control" value="Pick Your Favorite Color" />
                                        </div>
                                    </div>
                                    <div class="col-md-6">
                                        <div class="form-group">
                                            <label for="buy_now" class="control-checkbox">Buy Now</label>
                                            <input type="text" name="buy_now" class="form-control" value="Buy Now" />
                                        </div>
                                    </div>
                                    <div class="col-md-6">
                                        <div class="form-group">
                                            <label for="email_us" class="control-checkbox">Buy Now</label>
                                            <input type="text" name="email_us" class="form-control" value="Email Us" />
                                        </div>
                                    </div>
                                    <div class="col-md-6">
                                        <div class="form-group">
                                            <label for="email_us" class="control-checkbox">Blogs</label>
                                            <input type="text" name="blogs" class="form-control" value="Blogs" />
                                        </div>
                                    </div>
                                    <div class="col-md-6">
                                        <div class="form-group">
                                            <label for="email_us" class="control-checkbox">Become a Seller</label>
                                            <input type="text" name="become_a_seller" class="form-control" value="Become a Seller" />
                                        </div>
                                    </div>
                                    <div class="col-md-12">
                                        <div class="form-group">
                                            <button type="submit" class="btn btn-success" id="update_btn">Update</button>
                                        </div>
                                    </div>

                                    <div class="d-flex justify-content-center form-group">
                                        <div id="update-result" class="p-3"></div>
                                    </div>
                                </div>
                            </form>
                        </div>
                    </div>
                    <!--/.card-->
                </div>
            </div>
        </div><!-- /.container-fluid -->
    </section>
    <!-- /.content -->
<div class="modal fade" id="language-modal" tabindex="-1" role="dialog" aria-labelledby="myLargeModalLabel" aria-hidden="true">
    <div class="modal-dialog modal-lg">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="exampleModalLongTitle">Add Language</h5>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>
            <div class="modal-body">
                <form class="form-horizontal" id="add-new-language-form" action="https://avrluxe.com/admin/language/create" method="POST">
                    <div class="card-body">
                        <div class="row">
                            <div class="col-md-6">
                                <div class="form-group">
                                    <label for="">Name <small>(Language name should be in english)<small< /label>
                                                <input type="text" name="language" id="language" class="form-control" placeholder="Ex. English , Hindi" />
                                </div>
                            </div>
                            <div class="col-md-6">
                                <div class="form-group">
                                    <label for="">Code</label>
                                    <input type="text" name="code" id="code" class="form-control" placeholder="Ex. EN , हिन्दी" />
                                </div>
                            </div>
                        </div>

                        <div class="form-group">
                            <input type="checkbox" name="is_rtl" class="form-checkbox" id="is_rtl_create" value="1" />
                            <label for="is_rtl_create" class="control-checkbox">Enable RTL</label>
                        </div>
                        <div class="form-group">
                            <button type="submit" class="btn btn-success" id="submit_btn">Save</button>
                        </div>
                    </div>
                    <div class="d-flex justify-content-center form-group">
                        <div id="result" class="p-3"></div>
                    </div>
                </form>
            </div>
        </div>
    </div>
</div>
    
    
@endsection
