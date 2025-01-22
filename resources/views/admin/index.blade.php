@extends('admin.body.adminmaster')
@section('admin')


<div class="page-wrapper">
     <div class="container-fluid">
    
    <!---->
    <style>
  
/* Make the page wrapper full height and have scrollable content */
.page-wrapper {
    height: calc(100vh - 60px); /* Subtract the height of footer */
    overflow-y: auto;           /* Enable vertical scroll */
    padding-bottom: 60px;       /* Give space for footer */
}


</style>
    
    
            <div class="row">
                <div class="col-xl-3 col-lg-3 col-md-3 col-12">
                    <div class="card pull-up">
                        <div class="card-content">
                            <div class="card-body">
                                <div class="media d-flex">
                                    <div class="align-self-center text-warning">
                                        <i class="ion-ios-cart-outline display-4"></i>
                                    </div>
                                    <div class="media-body text-right">
                                        <h5 class="text-muted text-bold-500">Orders</h5>
                                        <!-- Dynamic totalOrders display -->
                                        <h3 class="text-bold-600">{{ $totalorders }}</h3>
                                        
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>

                <div class="col-xl-3 col-lg-3 col-md-3 col-12">
                    <div class="card pull-up">
                        <div class="card-content">
                            <div class="card-body">
                                <div class="media d-flex">
                                    <div class="align-self-center text-primary">
                                        <i class="ion-ios-personadd-outline display-4"></i>
                                    </div>
                                    <div class="media-body text-right">
                                        <h5 class="text-muted text-bold-500">New Signups</h5>
                                        <h3 class="text-bold-600">{{$newsingup}}</h3>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="col-xl-3 col-lg-3 col-md-3 col-12">
                    <div class="card pull-up">
                        <div class="card-content">
                            <div class="card-body">
                                <div class="media d-flex">
                                    <div class="align-self-center text-success">
                                        <i class="ion-ios-people-outline display-4"></i>
                                    </div>
                                    <div class="media-body text-right">
                                        <h5 class="text-muted text-bold-500">Vendors</h5>
                                        <h3 class="text-bold-600">{{$vendor}}</h3>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="col-xl-3 col-lg-3 col-md-3 col-12">
                    <div class="card pull-up">
                        <div class="card-content">
                            <div class="card-body">
                                <div class="media d-flex">
                                    <div class="align-self-center text-info">
                                        <i class="ion-ios-albums-outline display-4 display-4"></i>
                                    </div>
                                    <div class="media-body text-right">
                                        <h5 class="text-muted text-bold-500">Products</h5>
                                        <h3 class="text-bold-600">{{$products}}</h3>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
            
                <h5 class="col">Vendors Details</h5>
                 <!--<h5 class="text-muted text-bold-500">Vendors Details</h5>-->
                <div class="row col-12 d-flex">

                    <div class="col-4">
                        <div class="small-box bg-success">
                            <div class="inner">
                                <h3 style="text-align: center;">1</h3>

                                <p><button class='btn btn-outline-success text-white border-0' data-toggle="modal" data-target="#approved_sellers" style="text-align: center; display: block; width: 100%"><strong>Approved Vendors</strong></button></p>
                            </div>
                            <div class="icon d-flex justify-content-center align-items-center" style="height: 80px;">
                                <!-- Use fa-5x or fa-6x for a larger icon size -->
                                <i class="fa fa-check-circle fa-5x"></i>
                            </div>
                        </div>
                    </div>

                    <div class="col-4">
                        <div class="small-box bg-info">
                            <div class="inner">
                                <h3 style="text-align: center;">12</h3>

                                <p><button class='btn btn-outline-secondary text-white border-0' data-toggle="modal" data-target="#not_approved_sellers" style="text-align: center; display: block; width: 100%"><b>Not Approved Vendors</b></button></p>

                            </div>
                            <div class="icon d-flex justify-content-center align-items-center" style="height: 80px;">

                               <i class="fa fa-ban fa-5x"></i>

                            </div>
                        </div>
                    </div>
                    <div class="col-4">
                        <div class="small-box bg-danger">
                            <div class="inner">
                                <h3 style="text-align: center;">10</h3>

                                <!--<p><button class='btn btn-outline-danger text-white border-0' data-toggle="modal" data-target="#deactive_sellers"><b>Deactiveted Vendors</b></button></p>-->
                                <p><button class='btn btn-outline-danger text-white border-0' data-toggle="modal" data-target="#deactive_sellers" style="text-align: center; display: block; width: 100%"><b>Deactivated Vendors</b></button></p>

                            </div>
                            <div class="icon d-flex justify-content-center align-items-center" style="height: 80px;">
                                <i class="fa fa-user-slash fa-5x"></i>

                            </div>
                        </div>
                    </div>
                </div>
                <br>
                <div class="container">
                <div class="row">
                    <!-- Top Sellers Table -->
                    <div class="col-md-6">
                        <div class="card h-100">
                            <div class="m-3"><b>Top Vendors</b></div>
                            <div class="card-body">
                                <table class="table table-striped" id="top_seller_table">
                                    <thead>
                                        <tr>
                                            <th>ID</th>
                                            <th>Vendor Name</th>
                                            <th>Store Name</th>
                                            <th>Total</th>
                                        </tr>
                                    </thead>
                                    <tbody>
                                        <tr>
                                            <td>1</td>
                                            <td>John Doe</td>
                                            <td>John's Store</td>
                                            <td>$1,200</td>
                                        </tr>
                                        <tr>
                                            <td>2</td>
                                            <td>Jane Smith</td>
                                            <td>Jane's Boutique</td>
                                            <td>$950</td>
                                        </tr>
                                        <tr>
                                            <td>3</td>
                                            <td>Sam Wilson</td>
                                            <td>Sam's Market</td>
                                            <td>$780</td>
                                        </tr>
                                    </tbody>
                                </table>
                            </div>
                        </div>
                    </div>

                            <!-- Top Categories Table -->
                            <div class="col-md-6">
                                <div class="card h-100">
                                    <div class="m-3"><b>Top Categories</b></div>
                                    <div class="card-body">
                                        <table class="table table-striped" id="top_category_table">
                                            <thead>
                                                <tr>
                                                    <th>ID</th>
                                                    <th>Category Name</th>
                                                    <th>Clicks</th>
                                                </tr>
                                            </thead>
                                            <tbody>
                                                <tr>
                                                    <td>1</td>
                                                    <td>Electronics</td>
                                                    <td>1,500</td>
                                                </tr>
                                                <tr>
                                                    <td>2</td>
                                                    <td>Fashion</td>
                                                    <td>1,200</td>
                                                </tr>
                                                <tr>
                                                    <td>3</td>
                                                    <td>Home & Garden</td>
                                                    <td>900</td>
                                                </tr>
                                            </tbody>
                                        </table>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div><br>

                <h5 class="col">Order Outlines</h5>
<div class="row col-12 d-flex">
    <div class="col-3 mb-3"> <!-- Added margin-bottom -->
        <div class="small-box awaiting-box bg-primary">
            <div class="inner">
                <h3 class="text-white">0</h3>
                <p class="text-white">Awaiting</p>
            </div>
            <div class="icon">
                <i class="fas fa-history"></i>
            </div>
        </div>
    </div>
    <div class="col-3 mb-3"> <!-- Added margin-bottom -->
        <div class="small-box received-box bg-success">
            <div class="inner">
                <h3 class="text-white">0</h3>
                <p class="text-white">Received</p>
            </div>
            <div class="icon">
                <i class="fas fa-level-down-alt"></i> 
            </div>
        </div>
    </div>
    <div class="col-3 mb-3"> <!-- Added margin-bottom -->
        <div class="small-box processed-box bg-warning">
            <div class="inner">
                <h3 class="text-white">0</h3>
                <p class="text-white">Processed</p>
            </div>
            <div class="icon">
                <i class="fas fa-people-carry"></i> 
            </div>
        </div>
    </div>
    <div class="col-3 mb-3"> <!-- Added margin-bottom -->
        <div class="small-box shipped-box bg-info">
            <div class="inner">
                <h3 class="text-white">1</h3>
                <p class="text-white">Shipped</p>
            </div>
            <div class="icon">
                <i class="fas fa-shipping-fast"></i> <!-- Updated icon class -->
            </div>
        </div>
    </div>
</div>
<br>
<div class="row col-12 d-flex">
    <div class="col-3 mb-3"> <!-- Added margin-bottom -->
        <div class="small-box delivered-box bg-secondary">
            <div class="inner">
                <h3 class="text-white">0</h3>
                <p class="text-white">Delivered</p>
            </div>
            <div class="icon">
                <i class="fas fa-user-check"></i> <!-- Updated icon class -->
            </div>
        </div>
    </div>
    <div class="col-3 mb-3"> <!-- Added margin-bottom -->
        <div class="small-box bg-danger">
            <div class="inner">
                <h3>0</h3>
                <p>Cancelled</p>
            </div>
            <div class="icon">
                <i class="fas fa-times-circle"></i> <!-- Updated icon class -->
            </div>
        </div>
    </div>
    <div class="col-3 mb-3"> <!-- Added margin-bottom -->
        <div class="small-box bg-dark">
            <div class="inner">
                <h3>0</h3>
                <p>Returned</p>
            </div>
            <div class="icon">
                <i class="fas fa-level-up-alt"></i> <!-- Updated icon class -->
            </div>
        </div>
    </div>
</div>
            <div class="row">
    <div class="col-md-12 main-content">
        <div class="card content-area p-4">
            <div class="card-innr">
                <div class="gaps-1-5x row d-flex adjust-items-center">
                    <div class="row col-md-12">
                        <div class="form-group col-md-4">
                            <label>Date and time range:</label>
                            <div class="input-group col-md-12">
                                <div class="input-group-prepend">
                                    <span class="input-group-text"><i class="far fa-clock"></i></span>
                                </div>
                                <input type="text" class="form-control float-right" id="datepicker">
                                <input type="hidden" id="start_date" class="form-control float-right">
                                <input type="hidden" id="end_date" class="form-control float-right">
                            </div>
                        </div>
                        <!-- Filter By payment -->
                        <div class="form-group col-md-3">
                            <div>
                                <label>Filter By Payment Method</label>
                                <select id="payment_method" name="payment_method" class="form-control">
                                    <option value="">All Payment Methods</option>
                                    <option value="COD">Cash On Delivery</option>
                                    <option value="Paypal">Paypal</option>
                                    <option value="RazorPay">RazorPay</option>
                                    <option value="Paystack">Paystack</option>
                                    <option value="Flutterwave">Flutterwave</option>
                                    <option value="Paytm">Paytm</option>
                                    <option value="Stripe">Stripe</option>
                                    <option value="bank_transfer">Direct Bank Transfers</option>
                                </select>
                            </div>
                        </div>
                        <div class="form-group col-md-4 d-flex align-items-center pt-4">
                            <button type="button" class="btn btn-outline-primary btn-sm" onclick="status_date_wise_search()">Filter</button>
                        </div>
                    </div>
                </div>
                <table class='table table-striped'>
                    <thead>
                        <tr>
                            <th>Order ID</th>
                            <th>User Name</th>
                            <th>Sellers</th>
                            <th>Total (₹)</th>
                            <th>D.Charge</th>
                            <th>Wallet Used (₹)</th>
                            <th>Promo disc. (₹)</th>
                            <th>Final Total (₹)</th>
                            <th>Payment Method</th>
                            <th>Address</th>
                            <th>Order Date</th>
                            <th>Action</th>
                        </tr>
                    </thead>
                    <tbody>
                        <tr>
                            <td>1001</td>
                            <td>John Doe</td>
                            <td>Seller A</td>
                            <td>500</td>
                            <td>50</td>
                            <td>30</td>
                            <td>20</td>
                            <td>500</td>
                            <td>Paypal</td>
                            <td>123 Main St</td>
                            <td>2024-11-16</td>
                            <td><button class="btn btn-sm btn-primary">View</button></td>
                        </tr>
                        <tr>
                            <td>1002</td>
                            <td>Jane Smith</td>
                            <td>Seller B</td>
                            <td>1000</td>
                            <td>80</td>
                            <td>50</td>
                            <td>30</td>
                            <td>1000</td>
                            <td>COD</td>
                            <td>456 Oak St</td>
                            <td>2024-11-15</td>
                            <td><button class="btn btn-sm btn-primary">View</button></td>
                        </tr>
                        <tr>
                            <td>1003</td>
                            <td>Mike Brown</td>
                            <td>Seller C</td>
                            <td>750</td>
                            <td>60</td>
                            <td>40</td>
                            <td>25</td>
                            <td>750</td>
                            <td>RazorPay</td>
                            <td>789 Pine St</td>
                            <td>2024-11-14</td>
                            <td><button class="btn btn-sm btn-primary">View</button></td>
                        </tr>
                    </tbody>
                </table>
            </div>
        </div>
    </div>
</div>

    
    
    
    
    
    
    <!---->
    
    </div>
    <footer class="footer text-center">
        <p>All Rights Reserved by <strong>Free2kart</strong>. Designed and Developed by <strong>Founder Code technology Lucknow</strong>. Developer: <strong>Akhilesh K yadav</strong>.</p>
       <p>Powered by <a href="https://foundercodes.com/" target="_blank">Free2kart</a>.</p>

    </footer>
</div>


@endsection