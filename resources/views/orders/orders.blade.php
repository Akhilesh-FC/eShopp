@extends('admin.body.adminmaster')
@section('admin')

<div class="container-fluid">
    <form action="{{ route('orders') }}" method="get"></form>
    <body>
        <div class="row">
            <div class="col-xl-3 col-lg-3 col-md-3 col-12">
                <div class="container-fluid">
                    <div class="row mb-2">
                        <div class="col-sm-6">
                            <h4>Manage Orders</h4>
                        </div>
                    </div>
                </div>
            </div>
        </div>

        <div class="col-md-12 main-content">
            <div class="card content-area p-4">
                <div class="card-innr">
                    <div class="gaps-1-5x row d-flex align-items-center">
                        <h5 class="col">Order Outlines</h5>
                        <div class="row col-12 d-flex">
                            <div class="col-md-3">
                                <div class="small-box bg-secondary">
                                    <div class="inner">
                                        <h3>0</h3>
                                        <p>Awaiting</p>
                                    </div>
                                    <div class="icon">
                                        <i class="fa fa-xs fa-history"></i>
                                    </div>
                                </div>
                            </div>
                            <div class="col-md-3">
                                <div class="small-box bg-primary">
                                    <div class="inner">
                                        <h3>0</h3>
                                        <p>Received</p>
                                    </div>
                                    <div class="icon">
                                        <i class="fa fa-xs fa-level-down-alt"></i>
                                    </div>
                                </div>
                            </div>
                            <div class="col-md-3">
                                <div class="small-box bg-info">
                                    <div class="inner">
                                        <h3>0</h3>
                                        <p>Processed</p>
                                    </div>
                                    <div class="icon">
                                        <i class="fa fa-xs fa-people-carry"></i>
                                    </div>
                                </div>
                            </div>
                            <div class="col-md-3">
                                <div class="small-box bg-warning">
                                    <div class="inner">
                                        <h3>1</h3>
                                        <p>Shipped</p>
                                    </div>
                                    <div class="icon">
                                        <i class="fa fa-xs fa-shipping-fast"></i>
                                    </div>
                                </div>
                            </div>
                            <div class="col-md-3">
                                <div class="small-box bg-success">
                                    <div class="inner">
                                        <h3>0</h3>
                                        <p>Delivered</p>
                                    </div>
                                    <div class="icon">
                                        <i class="fa fa-xs fa-user-check"></i>
                                    </div>
                                </div>
                            </div>
                            <div class="col-md-3">
                                <div class="small-box bg-danger">
                                    <div class="inner">
                                        <h3>0</h3>
                                        <p>Cancelled</p>
                                    </div>
                                    <div class="icon">
                                        <i class="fa fa-xs fa-times-circle"></i>
                                    </div>
                                </div>
                            </div>
                            <div class="col-md-3">
                                <div class="small-box bg-danger">
                                    <div class="inner">
                                        <h3>0</h3>
                                        <p>Returned</p>
                                    </div>
                                    <div class="icon">
                                        <i class="fa fa-xs fa-level-up-alt"></i>
                                    </div>
                                </div>
                            </div>
                        </div>
                        <div class="row col-md-12">
                            <div class="form-group col-md-3">
                                <label>Date and time range:</label>
                                <div class="input-group">
                                    <div class="input-group-prepend">
                                        <span class="input-group-text"><i class="far fa-clock"></i></span>
                                    </div>
                                    <input type="text" class="form-control float-right" id="datepicker">
                                    <input type="hidden" id="start_date" class="form-control float-right">
                                    <input type="hidden" id="end_date" class="form-control float-right">
                                </div>
                            </div>
                            <div class="form-group col-md-3">
                                <label>Filter Order Items By Status</label>
                                <select id="order_status" name="order_status" class="form-control" required>
                                    <option value="">All Orders</option>
                                    <option value="awaiting">Awaiting</option>
                                    <option value="received">Received</option>
                                    <option value="processed">Processed</option>
                                    <option value="shipped">Shipped</option>
                                    <option value="delivered">Delivered</option>
                                    <option value="cancelled">Cancelled</option>
                                    <option value="returned">Returned</option>
                                </select>
                            </div>
                            <div class="form-group col-md-3">
                                <label>Filter By Payment Method</label>
                                <select id="payment_method" name="payment_method" class="form-control" required>
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
                            <div class="form-group col-md-3">
                                <label>Filter By Order Type</label>
                                <select id="order_type" name="order_type" class="form-control" required>
                                    <option value="">All Orders</option>
                                    <option value="physical_order">Physical Orders</option>
                                    <option value="digital_order">Digital Orders</option>
                                </select>
                            </div>
                            <div class="form-group col-md-4 d-flex align-items-center pt-4">
                                <button type="button" class="btn btn-outline-primary btn-sm" onclick="status_date_wise_search()">Filter</button>
                            </div>
                        </div>
                    </div>

                    <input type='hidden' id='order_user_id' value=''>
                    <input type='hidden' id='order_seller_id' value=''>

                    <div class="row col-md-6">
                        <div class="row col-md-4 pull-right">
                            <a href="#" class="btn btn-primary btn-sm add_promo_code_discount">Settle Promo Code Discount</a>
                        </div>
                    </div>
                    <hr>
                    
                    <div class="mt-3">
                        <div class="d-flex justify-content-end">
                            <input type="text" class="form-control w-25" placeholder="Search">
                            <button class="btn btn-light ml-2"><i class="fa fa-refresh"></i></button>
                            <button class="btn btn-light ml-2"><i class="fa fa-download"></i></button>
                            <button class="btn btn-light ml-2"><i class="fa fa-bars"></i></button>
                        </div>
                    </div><br>

                    <ul class="nav nav-tabs" role="tablist">
                        <li class="nav-item">
                            <a class="nav-link active" data-toggle="tab" href="#orders_table">Orders</a>
                        </li>
                        <li class="nav-item">
                            <a class="nav-link" data-toggle="tab" href="#order_items_table">Order Items</a>
                        </li>
                    </ul>
                    

                    <div class="tab-content">
                        <div id="orders_table" class="tab-pane active"><br>
                            <table class='table-striped' data-toggle="table" data-url="#" data-click-to-select="true" data-side-pagination="server" data-pagination="true" data-page-list="[5, 10, 20, 50, 100, 200]" data-search="true" data-show-columns="true" data-show-refresh="true" data-trim-on-search="false" data-sort-name="o.id" data-sort-order="desc" data-mobile-responsive="true" data-show-export="true" data-maintain-selected="true" data-export-types='["txt","excel","csv"]' data-export-options='{"fileName": "orders-list"}'>
                                <thead>
                                    <tr>
                                        <th data-field="id" data-sortable='true'>Order ID</th>
                                        <th data-field="name" data-sortable='true'>User Name</th>
                                        <th data-field="sellers" data-sortable='true'>Sellers</th>
                                        <th data-field="notes" data-sortable='false'>O. Notes</th>
                                        <th data-field="total" data-sortable='true'>Total(₹)</th>
                                        <th data-field="wallet_balance" data-sortable='true'>Wallet Used(₹)</th>
                                        <th data-field="promo_discount" data-sortable='true'>Promo disc.(₹)</th>
                                        <th data-field="final_total" data-sortable='true'>Final Total(₹)</th>
                                        <th data-field="payment_method" data-sortable='true'>Payment Method</th>
                                        <th data-field="date_added" data-sortable='true'>Order Date</th>
                                        <th data-field="operate">Action</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    <!-- Static Data for Orders -->
                                    <tr>
                                        <td>1001</td>
                                        <td>John Doe</td>
                                        <td>Seller A</td>
                                        <td>Urgent Order</td>
                                        <td>₹2000</td>
                                        <td>₹500</td>
                                        <td>₹100</td>
                                        <td>₹1500</td>
                                        <td>Paypal</td>
                                        <td>2024-11-18</td>
                                        <td><button class="btn btn-warning btn-sm">View</button></td>
                                    </tr>
                                    <tr>
                                        <td>1002</td>
                                        <td>Jane Smith</td>
                                        <td>Seller B</td>
                                        <td>Standard Delivery</td>
                                        <td>₹1500</td>
                                        <td>₹0</td>
                                        <td>₹50</td>
                                        <td>₹1450</td>
                                        <td>Paytm</td>
                                        <td>2024-11-18</td>
                                        <td><button class="btn btn-warning btn-sm">View</button></td>
                                    </tr>
                                </tbody>
                            </table>
                        </div>

                        <div id="order_items_table" class="tab-pane fade">
                    <br>
                    <table class="table table-striped" 
                           data-toggle="table" 
                           data-url="#" 
                           data-click-to-select="true" 
                           data-side-pagination="server" 
                           data-pagination="true" 
                           data-page-list="[5, 10, 20, 50, 100, 200]" 
                           data-search="true" 
                           data-show-columns="true" 
                           data-show-refresh="true" 
                           data-trim-on-search="false" 
                           data-sort-name="oi.id" 
                           data-sort-order="desc" 
                           data-mobile-responsive="true" 
                           data-show-export="true" 
                           data-maintain-selected="true" 
                           data-export-types='["txt","excel","csv"]' 
                           data-export-options='{"fileName": "order-items-list"}'>
                        <thead>
                            <tr>
                                <th data-field="id" data-sortable="true">Item ID</th>
                                <th data-field="order_id" data-sortable="true">Order ID</th>
                                <th data-field="product_name" data-sortable="true">Product Name</th>
                                <th data-field="quantity" data-sortable="true">Quantity</th>
                                <th data-field="price" data-sortable="true">Price</th>
                                <th data-field="total" data-sortable="true">Total(₹)</th>
                            </tr>
                        </thead>
                        <tbody>
                            <!-- Example of Dynamic Data for Order Items -->
                            <tr>
                                <td>101</td>
                                <td>1001</td>
                                <td>Product A</td>
                                <td>2</td>
                                <td>₹500</td>
                                <td>₹1000</td>
                            </tr>
                            <tr>
                                <td>102</td>
                                <td>1002</td>
                                <td>Product B</td>
                                <td>1</td>
                                <td>₹1500</td>
                                <td>₹1500</td>
                            </tr>
                        </tbody>
                    </table>
                </div>

                    </div>

                </div>
            </div>
        </div>
    </body>
</div>
@endsection
