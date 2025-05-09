@extends('admin.body.adminmaster')

@section('admin')
<div class="page-wrapper">
    <div class="container-fluid">

    <form action="{{ route('shipping_methods') }}" method="get"></form>
    
     <div class="content-wrapper">
    <!-- Content Header (Page header) -->
    <!-- Main content -->
    <section class="content-header">
        <div class="container-fluid">
            <div class="row mb-2">
                <div class="col-sm-6">
                    <h4>Shipping Methods Settings</h4>
                </div>
                <div class="col-sm-6">
                    <ol class="breadcrumb float-sm-right">
                        <li class="breadcrumb-item"><a href="#">Home</a>
                        </li>
                        <li class="breadcrumb-item active">Shipping Methods Settings</li>
                    </ol>
                </div>
            </div>
        </div>
        <!-- /.container-fluid -->
    </section>
    <section class="content">
        <div class="container-fluid">
            <div class="row">
                <div class="col-md-12">
                    <div class="card card-info">
                        <form class="form-horizontal form-submit-event" action="#" method="POST" id="payment_setting_form">
                            <div class="card-body">
                                <div class="row">
                                    <div class="form-group col-md-4">
                                        <label for="local_shipping_method">Enable Local Shipping <small> ( Use Local Delivery Boy For Shipping) </small>
                                        </label>
                                        <div class="card-body">
                                            <input type="checkbox" Checked data-bootstrap-switch data-off-color="danger" data-on-color="success" name="local_shipping_method">
                                        </div>
                                    </div>
                                </div>

                                <div class="row">
                                    <div class="form-group col-12">
                                        <label for="shiprocket_shipping_method">Standard delivery method (Shiprocket) <small>( Enable/Disable ) <a href="https://app.shiprocket.in/api-user" target="_blank"> Click here </a> </small>to get credentials. <small> <a href="https://www.shiprocket.in/" target="_blank">What is shiprocket? </a></small>
                                        </label>
                                        <br>
                                        <div class="card-body">
                                            <input type="checkbox" Checked data-bootstrap-switch data-off-color="danger" data-on-color="success" name="shiprocket_shipping_method">
                                        </div>
                                    </div>
                                </div>
                                <div class="row">
                                    <div class="form-group col-5">
                                        <label for="email">Email</label>
                                        <input type="email" class="form-control" name="email" id="email" value="1234567890@gmail.com" placeholder="Shiprocket acount email" />
                                    </div>
                                    <div class="form-group col-5">
                                        <label for="password">Password</label>
                                        <input type="password" class="form-control" name="password" id="" value="12345678" placeholder="Shiprocket acount Password" />
                                    </div>
                                    <div class="form-group col-5">
                                        <label for="webhook_url">Shiprocket Webhoook Url</label>
                                        <input type="text" class="form-control" name="webhook_url" id="" value="https://avrluxe.com/admin/webhook/spr_webhook" disabled />
                                    </div>
                                    <div class="form-group col-5">
                                        <label for="webhook_token">Shiprocket webhook token</label>
                                        <input type="text" class="form-control" name="webhook_token" id="" value="" />
                                    </div>
                                </div>

                                <div class="row mt-4">
                                    <div class="form-group col-md-12">
                                        <span class="text-danger"><b>Note:</b> You can give free delivery charge only when <b>Standard delivery method </b> is enable.</span>
                                    </div>
                                </div>
                                <div class="row">
                                    <div class="form-group col-5">
                                        <label for="local_shipping_method">Enable Free Delivery Charge </label>
                                        <div class="card-body">
                                            <input type="checkbox"  data-bootstrap-switch data-off-color="danger" data-on-color="success" name="standard_shipping_free_delivery">
                                        </div>
                                    </div>
                                    <div class="form-group col-5">
                                        <label for="local_shipping_method">Minimum free delivery order amount </label>
                                        <div>
                                            <input type="text" class="form-control" name="minimum_free_delivery_order_amount" id="" value="499" />
                                        </div>
                                    </div>
                                </div>

                                <div class="row">
                                    <div class="form-group col-5"></div>
                                </div>
                                <div class="row">

                                    <div class="form-group">
                                        <button type="reset" class="btn btn-warning">Reset</button>
                                        <button type="submit" class="btn btn-success" id="submit_btn">Update Shipping Settings</button>
                                    </div>
                                </div>
                                <div class="d-flex justify-content-center">
                                    <div class="form-group" id="error_box">
                                    </div>
                                </div>
                        </form>
                    </div>
                    <!--/.card-->
                </div>
                <!--/.col-md-12-->
            </div>
            <!-- /.row -->
        </div>
        <!-- /.container-fluid -->
    </section>
    
    
@endsection
