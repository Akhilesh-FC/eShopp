@extends('admin.body.adminmaster')
@section('admin')
<div class="content-wrapper">
    <section class="content-header">
        <div class="container-fluid">
            <div class="row mb-2">
                <div class="col-sm-6">
                    <h4>View Customers</h4>
                </div>
            </div>
        </div>
    </section>

    <section class="content">
        <div class="container-fluid">
            <div class="row">
                <div class="col-md-12">
                    <div class="card shadow-sm">
                        <div class="card-header bg-primary text-white">
                            <h3 class="card-title">Customer List</h3>
                        </div>
                        <div class="card-body">
                            <table class="table table-hover table-bordered">
                                <thead class="thead-dark">
                                    <tr>
                                        <th>ID</th>
                                        <th>Name</th>
                                        <th>Email</th>
                                        <th>Mobile No</th>
                                        <th>Balance</th>
                                        <th>Street</th>
                                        <th>Area</th>
                                        <th>City</th>
                                        <th>Status</th>
                                        <th>Date</th>
                                        <th>Actions</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    <tr>
                                        <td>1</td>
                                        <td>John Doe</td>
                                        <td>john.doe@example.com</td>
                                        <td>9876543210</td>
                                        <td>$100.00</td>
                                        <td>Main Street</td>
                                        <td>Downtown</td>
                                        <td>New York</td>
                                        <td><span class="badge badge-success">Active</span></td>
                                        <td>05 December 2024</td> 
                                        <td>
                                            <button class="btn btn-warning btn-sm">Edit</button>
                                            <button class="btn btn-danger btn-sm">Delete</button>
                                        </td>
                                    </tr>
                                    <tr>
                                        <td>2</td>
                                        <td>Jane Smith</td>
                                        <td>jane.smith@example.com</td>
                                        <td>9123456789</td>
                                        <td>$250.00</td>
                                        <td>Elm Street</td>
                                        <td>Uptown</td>
                                        <td>Los Angeles</td>
                                        <td><span class="badge badge-danger">Inactive</span></td>
                                        <td>05 December 2024</td>
                                        <td>
                                            <button class="btn btn-warning btn-sm">Edit</button>
                                            <button class="btn btn-danger btn-sm">Delete</button>
                                        </td>
                                    </tr>
                                </tbody>
                            </table>
                        </div>
                        <div class="card-footer text-center">
                            <p class="text-muted">Showing 2 out of 2 entries</p>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </section>
</div>
@endsection
