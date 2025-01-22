@extends('admin.body.adminmaster')

@section('admin')
<div class="page-wrapper">
     <div class="container-fluid">

    <form action="{{ route('blog_categories') }}" method="get"></form>

    <div class="content-wrapper">
        <section class="content-header">
            <div class="container-fluid">
                <div class="row mb-2">
                    <div class="col-sm-6">
                        <h4>Manage Blog's Category</h4>
                    </div>
                    <div class="col-sm-6">
                        <ol class="breadcrumb float-sm-right">
                            <li class="breadcrumb-item"><a href="#">Home</a></li>
                            <li class="breadcrumb-item active">Category Blogs</li>
                        </ol>
                    </div>
                </div>
            </div>
        </section>

        <section class="content">
            <div class="container-fluid">
                <div class="row">
                    <div class="modal fade edit-modal-lg" id="category_form" tabindex="-1" role="dialog" aria-labelledby="myLargeModalLabel" aria-hidden="true">
                        <div class="modal-dialog modal-lg">
                            <div class="modal-content">
                                <div class="modal-header">
                                    <h5 class="modal-title" id="exampleModalLongTitle">Edit Category</h5>
                                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                                        <span aria-hidden="true">&times;</span>
                                    </button>
                                </div>
                                <div class="modal-body p-0"></div>
                            </div>
                        </div>
                    </div>

                    <div class="col-md-12">
                        <div class="card content-area p-4">
                            <div class="card-header border-0 d-flex justify-content-between align-items-center">
                                <h4 class="card-title mb-0">Category Blogs</h4>
                                <a href="https://avrluxe.com/admin/blogs/create-category" class="btn btn-outline-primary btn-sm">Add Category</a>
                            </div>
                            <div class="card-innr" id="list_view_html">
                                <div class="gaps-1-5x"></div>
                                <table class='table table-striped' id='category_table'>
                                    <thead>
                                        <tr>
                                            <th>ID</th>
                                            <th>Name</th>
                                            <th>Image</th>
                                            <th>Banner</th>
                                            <th>Status</th>
                                            <th>Action</th>
                                        </tr>
                                    </thead>
                                    <tbody>
                                        <tr>
                                            <td>1</td>
                                            <td>Technology</td>
                                            <td><img src="https://via.placeholder.com/50" alt="Image" class="img-thumbnail"></td>
                                            <td><img src="https://via.placeholder.com/100x50" alt="Banner" class="img-thumbnail"></td>
                                            <td><span class="badge badge-success">Active</span></td>
                                            <td>
                                                <a href="#" class="btn btn-sm btn-info">Edit</a>
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
</div>
@endsection
