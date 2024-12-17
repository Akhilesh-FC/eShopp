@extends('admin.body.adminmaster')
@section('admin')

<div class="container-fluid">
    <form action="{{ route('orders') }}" method="get"></form>
    <div class="row mt-4">
        <div class="col-12">
            <div class="d-flex justify-content-between align-items-center mb-3">
                <h4>Manage Orders</h4>
                <div class="d-flex align-items-center">
                    <input type="text" class="form-control mr-2" placeholder="Search" />
                    <button class="btn btn-outline-secondary"><i class="fa fa-refresh"></i></button>
                    <button class="btn btn-outline-secondary"><i class="fa fa-download"></i></button>
                    <button class="btn btn-outline-secondary"><i class="fa fa-bars"></i></button>
                </div>
            </div>

            <div class="card p-4">
                <div class="d-flex justify-content-between mb-4">
                    <div class="d-flex flex-wrap">
                        <div class="small-box bg-secondary mx-3 mb-3" style="width: 150px;">
                            <div class="inner">
                                <h3 id="awaiting-count">2</h3>
                                <p>Awaiting</p>
                            </div>
                            <div class="icon">
                                <i class="fa fa-history"></i>
                            </div>
                        </div>
                        <div class="small-box bg-primary mx-2 mb-3" style="width: 150px;">
                            <div class="inner">
                                <h3>0</h3>
                                <p>Received</p>
                            </div>
                            <div class="icon">
                                <i class="fa fa-level-down-alt"></i>
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
                        
                        <div class="small-box bg-info mx-2 mb-3" style="width: 150px;">
                            <div class="inner">
                                <h3>0</h3>
                                <p>Processed</p>
                            </div>
                            <div class="icon">
                                <i class="fa fa-people-carry"></i>
                            </div>
                        </div>
                        <div class="small-box bg-warning mx-2 mb-3" style="width: 150px;">
                            <div class="inner">
                                <h3>1</h3>
                                <p>Shipped</p>
                            </div>
                            <div class="icon">
                                <i class="fa fa-shipping-fast"></i>
                            </div>
                        </div>
                        <div class="small-box bg-success mx-2 mb-3" style="width: 150px;">
                            <div class="inner">
                                <h3>0</h3>
                                <p>Delivered</p>
                            </div>
                            <div class="icon">
                                <i class="fa fa-user-check"></i>
                            </div>
                        </div>
                        <div class="small-box bg-danger mx-2 mb-3" style="width: 150px;">
                            <div class="inner">
                                <h3>0</h3>
                                <p>Cancelled</p>
                            </div>
                            <div class="icon">
                                <i class="fa fa-times-circle"></i>
                            </div>
                        </div>
                        <div class="small-box bg-danger mx-2 mb-3" style="width: 150px;">
                            <div class="inner">
                                <h3>0</h3>
                                <p>Returned</p>
                            </div>
                            <div class="icon">
                                <i class="fa fa-level-up-alt"></i>
                            </div>
                        </div>
                    </div>
                </div>

                <div class="row mb-3">
                    <div class="col-md-3">
                        <label for="datepicker">Date and Time Range</label>
                        <div class="input-group">
                            <input type="text" class="form-control" id="datepicker">
                            <input type="hidden" id="start_date">
                            <input type="hidden" id="end_date">
                        </div>
                    </div>
                    <div class="col-md-3">
                        <label for="order_status">Filter Order Status</label>
                        <select id="order_status" name="order_status" class="form-control">
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
                    <div class="col-md-3">
                        <label for="payment_method">Filter by Payment Method</label>
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
                    <div class="col-md-3">
                        <label for="order_type">Filter by Order Type</label>
                        <select id="order_type" name="order_type" class="form-control">
                            <option value="">All Orders</option>
                            <option value="physical_order">Physical Orders</option>
                            <option value="digital_order">Digital Orders</option>
                        </select>
                    </div>
                </div>

                <div class="d-flex justify-content-end mb-3">
                    <button type="button" class="btn btn-outline-primary btn-sm" onclick="status_date_wise_search()">Filter</button>
                </div>

                <hr>

                <div class="d-flex justify-content-end mb-4">
                    <a href="#" class="btn btn-primary btn-sm">Settle Promo Code Discount</a>
                </div>

                <ul class="nav nav-tabs mb-4" role="tablist">
                    <li class="nav-item">
                        <a class="nav-link active" data-toggle="tab" href="#orders_table">Orders</a>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link" data-toggle="tab" href="#order_items_table">Order Items</a>
                    </li>
                </ul>

                <div class="tab-content">
                    <div id="orders_table" class="tab-pane active">
                        <table class="table table-striped" data-toggle="table" data-pagination="true" data-search="true">
                            <thead>
                                <tr>
                                    <th data-field="id" data-sortable="true">Order ID</th>
                                    <th data-field="name" data-sortable="true">User Name</th>
                                    <th data-field="sellers" data-sortable="true">Sellers</th>
                                    <th data-field="notes">O. Notes</th>
                                    <th data-field="total" data-sortable="true">Total(₹)</th>
                                    <th data-field="wallet_balance" data-sortable="true">Wallet Used(₹)</th>
                                    <th data-field="promo_discount" data-sortable="true">Promo Discount(₹)</th>
                                    <th data-field="final_total" data-sortable="true">Final Total(₹)</th>
                                    <th data-field="payment_method" data-sortable="true">Payment Method</th>
                                    <th data-field="date_added" data-sortable="true">Order Date</th>
                                    <th data-field="operate">Action</th>
                                </tr>
                            </thead>
                            <tbody>
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
                        <table class="table table-striped" data-toggle="table" data-pagination="true" data-search="true">
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
</div>

@endsection
