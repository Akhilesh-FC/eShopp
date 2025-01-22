@extends('admin.body.adminmaster')

@section('admin')
<div class="page-wrapper">
    <div class="container-fluid">
 <form action="{{ route('sales_report') }}" method="get"></form>
 
 <div class="content-wrapper">
    <!-- Content Header (Page header) -->
    <!-- Main content -->
    <section class="content-header">
        <div class="container-fluid">
            <div class="row mb-2">
                <div class="col-sm-6">
                    <h4>View Sale Reports</h4>
                </div>
                <div class="col-sm-6">
                    <ol class="breadcrumb float-sm-right">
                        <li class="breadcrumb-item"><a href="#">Home</a></li>
                        <li class="breadcrumb-item active">Sales Reports</li>
                    </ol>
                </div>
            </div>
        </div><!-- /.container-fluid -->
    </section>
    <section class="content">
        <div class="container-fluid">
            <div class="row">
                <div class="col-md-12 main-content">
                    <div class="card content-area p-4">
                        <div class="card-innr">
                            <div class="gaps-1-5x row d-flex adjust-items-center">
                                <div class="row col-md-12">
                                    <div class="form-group col-md-4">
                                        <label>From & To Date</label>
                                        <div class="input-group col-md-12">
                                            <div class="input-group-prepend">
                                                <span class="input-group-text"><i class="far fa-clock"></i></span>
                                            </div>
                                            <input type="text" class="form-control float-right" id="datepicker">
                                            <input type="hidden" id="start_date" class="form-control float-right">
                                            <input type="hidden" id="end_date" class="form-control float-right">
                                        </div>
                                        <!-- /.input group -->
                                    </div>
                                    <div class="form-group col-md-4">
                                        <div>
                                            <label>Seller Name</label>
                                            <select class='form-control' name='seller_id' id="seller_id">
                                                <option value="">Select Seller </option>
                                                                                                    <option value="12" >AVR LUXE</option>
                                                                                            </select>
                                        </div>
                                    </div>
                                    <div class="form-group col-md-4 d-flex align-items-center pt-4">
                                        <button type="button" class="btn btn-outline-primary btn-sm" onclick="status_date_wise_search()">Filter</button>
                                    </div>
                                </div>
                            </div>
                        </div>
                        <table class="table table-striped" data-detail-view="true" data-detail-formatter="salesReport" data-auto-refresh="true" data-toggle="table" data-url="https://avrluxe.com/admin/Sales_report/get_sales_report_list" data-side-pagination="server" data-pagination="true" data-page-list="[5, 10, 25, 50, 100, 200, All]" data-search="true" data-show-columns="true" data-show-columns-search="true" data-show-refresh="true" data-sort-name="id" data-sort-order="DESC" data-query-params="sales_report_query_params">
                            <thead>
                                <tr>
                                    <th data-field="id" data-sortable='true'>Order item ID</th>
                                    <th data-field="user_id" data-sortable='true' >User ID</th>
                                    <th data-field="name" data-sortable='true'>User Name</th>
                                    <th data-field="product_name" data-sortable='true'>Product name</th>
                                    <th data-field="mobile" data-visiable="false" data-sortable='true'> Mobile</th>
                                    <th data-field="address" data-sortable='true'>Address</th>
                                    <th data-field="final_total" data-sortable='true'>Final Total</th>
                                    <th data-field="date_added" data-sortable='true'>Order Date</th>
                                </tr>
                            </thead>
                            <tbody>
        <tr>
            <td>1</td>
            <td>101</td>
            <td>John Doe</td>
            <td>Smartphone</td>
            <td>9876543210</td>
            <td>123 Elm Street</td>
            <td>$500</td>
            <td>2024-12-01</td>
        </tr>
        <tr>
            <td>2</td>
            <td>102</td>
            <td>Jane Smith</td>
            <td>Laptop</td>
            <td>8765432109</td>
            <td>456 Oak Avenue</td>
            <td>$1200</td>
            <td>2024-12-02</td>
        </tr>
    </tbody>
                        </table>
                    </div><!-- .card-innr -->
                </div><!-- .card -->
            </div>

        </div><!-- /.container-fluid -->
    </section>


@endsection
