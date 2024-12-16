@extends('admin.body.adminmaster')
@section('admin')
  
<div class="container-fluid">

<form action="{{ route('create_blog') }}" method="get"></form>

<div class="content-wrapper">
    <!-- Content Header (Page header) -->
    <section class="content-header">
        <div class="container-fluid">
            <div class="row mb-2">
                <div class="col-sm-6">
                    <h4>Manage Blogs</h4>
                </div>
                <div class="col-sm-6">
                    <ol class="breadcrumb float-sm-right">
                        <li class="breadcrumb-item"><a href="#">Home</a></li>
                        <li class="breadcrumb-item active">Blogs</li>
                    </ol>
                </div>
            </div>
        </div>
    </section>

    <!-- Main content -->
    <section class="content">
        <div class="container-fluid">
            <div class="row">
                <div class="modal fade edit-modal-lg" id="category_form" tabindex="-1" role="dialog" aria-labelledby="myLargeModalLabel" aria-hidden="true">
                    <div class="modal-dialog modal-lg">
                        <div class="modal-content">
                            <div class="modal-header">
                                <h5 class="modal-title" id="exampleModalLongTitle">Edit Blog</h5>
                                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                                    <span aria-hidden="true">&times;</span>
                                </button>
                            </div>
                            <div class="modal-body p-0">
                                <!-- Modal Content Here -->
                            </div>
                        </div>
                    </div>
                </div>

                <div class="col-md-12">
                    <div class="card content-area p-4">
                        <div class="card-header border-0 d-flex justify-content-between align-items-center">
                            <div class="col-md-3">
                                <label for="category_parent" class="col-form-label">Filter By Category</label>
                                <select class='form-control' name='category_parent' id="category_parent">
                                    <option value="">Select Category</option>
                                </select>
                            </div>
                            <div class="card-tools">
                                <a href="https://avrluxe.com/admin/blogs/create-blog" class="btn btn-dark btn-sm">Add Blog</a>
                            </div>
                        </div>

                        <div class="card-innr" id="list_view_html">
                            <div class="card-head">
                                <h4 class="card-title">Blogs</h4>
                            </div>
                            <div class="gaps-1-5x"></div>

                            <table class="table table-striped">
                                <thead>
                                    <tr>
                                        <th>ID</th>
                                        <th>Category</th>
                                        <th>Title</th>
                                        <th>Description</th>
                                        <th>Image</th>
                                        <th>Action</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    <tr>
                                        <td>1</td>
                                        <td>Technology</td>
                                        <td>Latest Tech Trends</td>
                                        <td>A blog about the latest trends in technology.</td>
                                        <td>
                                            <img src="https://via.placeholder.com/100" alt="Blog Image" width="50">
                                        </td>
                                        <td>
                                            <a href="#" class="btn btn-sm btn-primary">Edit</a>
                                            <a href="#" class="btn btn-sm btn-danger">Delete</a>
                                        </td>
                                    </tr>
                                </tbody>
                            </table>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </section>
</div>

@endsection
