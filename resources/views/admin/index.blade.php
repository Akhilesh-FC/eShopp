@extends('admin.body.adminmaster')
@section('admin')
<form action="{{route('dashboard')}}" method="get"></form>

    <style>
        .card {
            border: none;
            border-radius: 10px;
            box-shadow: 0 2px 5px rgba(0, 0, 0, 0.1);
        }
        .icon {
            font-size: 24px;
        }
        .btn-custom {
            border: none;
            border-radius: 5px;
            background-color: #004085;
            color: #fff;
            padding: 5px 15px;
            margin-right: 5px;
        }
        .chart-container {
            text-align: center;
        }
    </style>
</head>
<body>
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
                                        <h3 class="text-bold-600">1</h3>
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
                                        <h3 class="text-bold-600">10</h3>
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
                                        <h5 class="text-muted text-bold-500">Delivery Boys</h5>
                                        <h3 class="text-bold-600">1</h3>
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
                                        <h3 class="text-bold-600">40</h3>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
            <!--<div class="row">-->
            <!--    <div class="col-xl-6 col-6" id="ecommerceChartView">-->
            <!--        <div class="card card-shadow chart-height">-->
            <!--            <div class="m-3">Product Sales</div>-->
            <!--            <div class="card-header card-header-transparent py-20 border-0">-->
            <!--                <ul class="nav nav-pills nav-pills-rounded chart-action float-right btn-group sales-tab" role="group">-->
            <!--                    <li class="nav-item"><a class="nav-link active" data-toggle="tab" href="#scoreLineToDay">Day</a></li>-->
            <!--                    <li class="nav-item"><a class="nav-link" data-toggle="tab" href="#scoreLineToWeek">Week</a></li>-->
            <!--                    <li class="nav-item"><a class="nav-link" data-toggle="tab" href="#scoreLineToMonth">Month</a></li>-->
            <!--                </ul>-->
            <!--            </div>-->
            <!--            <div class="widget-content tab-content bg-white p-20">-->
            <!--                <div class="ct-chart tab-pane active scoreLineShadow" id="scoreLineToDay"></div>-->
            <!--                <div class="ct-chart tab-pane scoreLineShadow" id="scoreLineToWeek"></div>-->
            <!--                <div class="ct-chart tab-pane scoreLineShadow" id="scoreLineToMonth"></div>-->
            <!--            </div>-->
            <!--        </div>-->
            <!--    </div>-->
            <!--    <div class="col-md-6">-->
                    <!-- Category Wise Product's Sales -->
            <!--        <div class="card ">-->
            <!--            <h3 class="card-title m-3">Category Wise Product's Count</h3>-->
            <!--            <div class="card-body">-->
            <!--                <div id="piechart_3d" class='piechat_height'></div>-->
            <!--            </div>-->
            <!--        </div>-->
            <!--    </div>-->
            <!--</div>-->
            <!--<div class="row">-->
            <!--    <div class="col-md-4 col-sm-6 col-12">-->
            <!--        <div class="info-box total-info-box bg-primary">-->
            <!--            <span class="info-box-icon text-white"> <i class="far fa-money-bill-alt"></i></span>-->
            <!--            <div class="info-box-content">-->
            <!--                <span class="info-box-text text-white">Total Earnings (₹)</span>-->
            <!--                <span class="info-box-number text-white">0.00</span>-->
            <!--            </div>-->
            <!--        </div>-->
            <!--    </div>-->
            <!--    <div class="col-md-4 col-sm-6 col-12">-->
            <!--        <div class="info-box details-box bg-success">-->
            <!--            <span class="info-box-icon text-white"> <i class="far fa-money-bill-alt"></i></span>-->
            <!--            <div class="info-box-content">-->
            <!--                <span class="info-box-text text-white">Admin Earnings (₹)</span>-->
            <!--                <span class="info-box-number text-white">0.00</span>-->
            <!--            </div>-->
            <!--        </div>-->
            <!--    </div>-->
            <!--    <div class="col-md-4 col-sm-6 col-12">-->
            <!--        <div class="info-box bg-secondary">-->
            <!--            <span class="info-box-icon text-white"> <i class="far fa-money-bill-alt"></i></span>-->
            <!--            <div class="info-box-content">-->
            <!--                <span class="info-box-text text-white">Seller Earnings (₹)</span>-->
            <!--                <span class="info-box-number text-white">0.00</span>-->
            <!--            </div>-->
            <!--        </div>-->
            <!--    </div>-->
            <!--</div>-->
            <!--<div class="row">-->
            <!--    <div class="col-md-6 col-xs-12">-->
            <!--        <div class="alert sold-products ">-->
            <!--            <button type="button" class="close" data-dismiss="alert" aria-hidden="true">×</button>-->
            <!--            <h6><i class="icon fa fa-info"></i> 0 Product(s) sold out!</h6>-->
            <!--            <a href="https://avrluxe.com/admin/product/?flag=sold" class="text-decoration-none small-box-footer">More info <i class="fa fa-arrow-circle-right"></i></a>-->
            <!--        </div>-->
            <!--    </div>-->

            <!--    <div class="col-md-6 col-xs-12">-->
            <!--        <div class="alert alert-primary alert-dismissible">-->
            <!--            <button type="button" class="close" data-dismiss="alert" aria-hidden="true">×</button>-->
            <!--            <h6><i class="icon fa fa-info"></i> 2 Product(s) low in stock!<small> (Low stock limit 15)</small></h6>-->
            <!--            <a href="https://avrluxe.com/admin/product/?flag=low" class="text-decoration-none small-box-footer">More info <i class="fa fa-arrow-circle-right"></i></a>-->
            <!--        </div>-->
            <!--    </div>-->
            <!--</div>-->
            <!--</div>-->

            <h5 class="col">Sellers Details</h5>
                <div class="row col-12 d-flex">

                    <div class="col-4">
                        <div class="small-box bg-success">
                            <div class="inner">
                                <h3>1</h3>
                                <p><button class='btn btn-outline-success text-white border-0' data-toggle="modal" data-target="#approved_sellers">Approved sellers</button></p>
                            </div>
                            <div class="icon">
                                <i class="fa fa-xs fa-check-circle"></i>
                            </div>
                        </div>
                    </div>
                    <div class="col-4">
                        <div class="small-box bg-info">
                            <div class="inner">
                                <h3>0</h3>
                                <p><button class='btn btn-outline-secondary text-white border-0' data-toggle="modal" data-target="#not_approved_sellers">Not Approved Sellers</button></p>

                            </div>
                            <div class="icon">

                                <i class="fa fa-xs fa-pause-circle"></i>
                            </div>
                        </div>
                    </div>
                    <div class="col-4">
                        <div class="small-box bg-danger">
                            <div class="inner">
                                <h3>0</h3>
                                <p><button class='btn btn-outline-danger text-white border-0' data-toggle="modal" data-target="#deactive_sellers">Deactiveted sellers</button></p>
                            </div>
                            <div class="icon">
                                <i class="fa fa-xs fa-times-circle"></i>
                            </div>
                        </div>
                    </div>
                </div>
                <br>
                <div class="container-fluid">
                <div class="row">
                    <!-- Top Sellers Table -->
                    <div class="col-md-6">
                        <div class="card h-100">
                            <div class="m-3">Top Sellers</div>
                            <div class="card-body">
                                <table class="table table-striped" id="top_seller_table">
                                    <thead>
                                        <tr>
                                            <th>ID</th>
                                            <th>Seller Name</th>
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
                                    <div class="m-3">Top Categories</div>
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


            </div>
        </div>
    </div>
</body>
@endsection