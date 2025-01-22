@extends('admin.body.adminmaster')

@section('admin')
<div class="page-wrapper">
    <div class="container-fluid">
<div class="content-wrapper">
    <!-- Content Header (Page header) -->
    <section class="content-header">
        <div class="container-fluid">
            <div class="row mb-2">
                <div class="col-sm-6">
                    <h4>Manage System Users</h4>
                </div>
                <div class="col-sm-6">
                    <ol class="breadcrumb float-sm-right">
                        <li class="breadcrumb-item"><a href="#">Home</a></li>
                        <li class="breadcrumb-item active">System Users</li>
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
                        <div class="card-header border-0 d-flex justify-content-between align-items-center">
                            <h5 class="mb-0">System Users</h5>
                            <a href="#" class="btn btn-sm btn-outline-primary">Add System User</a>
                        </div>
                        <div class="card-innr">
                            <div class="gaps-1-5x"></div>
                            <table class="table table-striped table-bordered">
                                <thead>
                                    <tr>
                                        <th>ID</th>
                                        <th>Username</th>
                                        <th>Mobile</th>
                                        <th>Email</th>
                                        <th>Role</th>
                                        <th>Actions</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    <!-- Static Data Rows -->
                                    <tr>
                                        <td>1</td>
                                        <td>JohnDoe</td>
                                        <td>9876543210</td>
                                        <td>john@example.com</td>
                                        <td>Admin</td>
                                        <td>
                                            <a href="#" class="btn btn-sm btn-info">Edit</a>
                                            <a href="#" class="btn btn-sm btn-danger">Delete</a>
                                        </td>
                                    </tr>
                                    <tr>
                                        <td>2</td>
                                        <td>JaneDoe</td>
                                        <td>8765432109</td>
                                        <td>jane@example.com</td>
                                        <td>Editor</td>
                                        <td>
                                            <a href="#" class="btn btn-sm btn-info">Edit</a>
                                            <a href="#" class="btn btn-sm btn-danger">Delete</a>
                                        </td>
                                    </tr>
                                </tbody>
                            </table>
                        </div>
                    </div><!-- .card -->
                </div>
            </div>
        </div>
    </section>
</div>

@endsection
