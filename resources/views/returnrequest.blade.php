@extends('admin.body.adminmaster')
@section('admin')

<form action="{{route('return_request')}}" method="get"></form>
<div class="content-wrapper">
    <!-- Content Header (Page header) -->
    <section class="content-header">
        <div class="container-fluid">
            <div class="row mb-2">
                <div class="col-sm-6">
                    <h4>Return Request</h4>
                </div>
                <div class="col-sm-6">
                    <ol class="breadcrumb float-sm-right">
                        <li class="breadcrumb-item"><a href="https://avrluxe.com/admin/home">Home</a></li>
                        <li class="breadcrumb-item active">Return Request</li>
                    </ol>
                </div>
            </div>
        </div>
    </section>
    <!-- Main content -->
    <section class="content">
        <div class="container-fluid">
            <div class="row">
                <div class="col-md-12 main-content">
                    <div class="card content-area p-4">
                        <div class="card-header d-flex justify-content-between align-items-center">
                            <h5 class="mb-0">Manage Return Requests</h5>
                            <button class="btn btn-outline-primary btn-sm" data-toggle="modal" data-target="#request_rating_modal">
                                Add New Request
                            </button>
                        </div>
                        <div class="card-innr">
                            <div class="table-responsive">
                            <table class="table table-striped">
                                    <thead>
                                        <tr>
                                            <th>ID</th>
                                            <th>Order ID</th>
                                            <th>Order Item ID</th>
                                            <th>Username</th>
                                            <th>Product Name</th>
                                            <th>Price</th>
                                            <th>Discounted Price</th>
                                            <th>Quantity</th>
                                            <th>Sub Total</th>
                                            <th>Status</th>
                                            <th>Actions</th>
                                        </tr>
                                    </thead>
                                    <tbody>
                                        <tr>
                                            <td>1</td>
                                            <td>ORD12345</td>
                                            <td>ITM67890</td>
                                            <td>John Doe</td>
                                            <td>Wireless Headphones</td>
                                            <td>$150.00</td>
                                            <td>$120.00</td>
                                            <td>1</td>
                                            <td>$120.00</td>
                                            <td>Pending</td>
                                            <td>
                                                <button class="btn btn-sm btn-primary">Edit</button>
                                                <button class="btn btn-sm btn-danger">Delete</button>
                                            </td>
                                        </tr>
                                        <tr>
                                            <td>2</td>
                                            <td>ORD54321</td>
                                            <td>ITM09876</td>
                                            <td>Jane Smith</td>
                                            <td>Smart Watch</td>
                                            <td>$200.00</td>
                                            <td>$180.00</td>
                                            <td>1</td>
                                            <td>$180.00</td>
                                            <td>Approved</td>
                                            <td>
                                                <button class="btn btn-sm btn-primary">Edit</button>
                                                <button class="btn btn-sm btn-danger">Delete</button>
                                            </td>
                                        </tr>
                                    </tbody>
                                </table>

                            </div>
                        </div><!-- .card-innr -->
                    </div><!-- .card -->
                </div>
            </div>
        </div><!-- /.container-fluid -->
    </section>
</div>
@endsection
