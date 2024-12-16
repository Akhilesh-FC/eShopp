@extends('admin.body.adminmaster')
@section('admin')

<div class="container-fluid">
    <form action="{{ route('attributes') }}" method="get"></form>

    <div class="content-wrapper">
        <!-- Content Header (Page header) -->
        <section class="content-header">
            <div class="container-fluid">
                <div class="row mb-2">
                    <div class="col-sm-6">
                        <h4>Manage Attribute</h4>
                    </div>
                    <div class="col-sm-6">
                        <ol class="breadcrumb float-sm-right">
                            <li class="breadcrumb-item"><a href="#">Home</a></li>
                            <li class="breadcrumb-item active">Attribute</li>
                        </ol>
                    </div>
                </div>
            </div>
        </section>

        <section class="content">
            <div class="container-fluid">
                <div class="row">
                    <!-- Modal for Editing -->
                    <div class="modal fade edit-modal-lg" tabindex="-1" role="dialog" aria-labelledby="myLargeModalLabel" aria-hidden="true">
                        <div class="modal-dialog modal-lg">
                            <div class="modal-content">
                                <div class="modal-header">
                                    <h5 class="modal-title" id="exampleModalLongTitle">Edit Attribute</h5>
                                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                                        <span aria-hidden="true">&times;</span>
                                    </button>
                                </div>
                                <div class="modal-body p-0">
                                    <!-- Content for editing can be placed here -->
                                </div>
                            </div>
                        </div>
                    </div>

                    <div class="col-md-12">
                        <div class="card content-area p-4">
                            <div class="card-header border-0">
                                <div class="card-tools">
                                    <a href="#" class="btn btn-block btn-outline-primary btn-sm">Manage Attribute</a>
                                </div>
                            </div>
                            <div class="card-innr">
                                <div class="card-head">
                                    <h4 class="card-title">Attributes</h4>
                                </div>
                                <div class="gaps-1-5x"></div>

                                <!-- Static Data Table -->
                                <table class="table table-striped">
                                    <thead>
                                        <tr>
                                            <th>ID</th>
                                            <th>Attributes</th>
                                            <th>Name</th>
                                            <th>Status</th>
                                            <th class="text-right">Action</th>
                                        </tr>
                                    </thead>
                                    <tbody>
                                        <tr>
                                            <td>1</td>
                                            <td>Color</td>
                                            <td>Red</td>
                                            <td>Active</td>
                                            <td class="text-right">
                                                <button class="btn btn-sm btn-primary">Edit</button>
                                                <button class="btn btn-sm btn-danger">Delete</button>
                                            </td>
                                        </tr>
                                        <tr>
                                            <td>2</td>
                                            <td>Size</td>
                                            <td>Large</td>
                                            <td>Inactive</td>
                                            <td class="text-right">
                                                <button class="btn btn-sm btn-primary">Edit</button>
                                                <button class="btn btn-sm btn-danger">Delete</button>
                                            </td>
                                        </tr>
                                        <tr>
                                            <td>3</td>
                                            <td>Material</td>
                                            <td>Cotton</td>
                                            <td>Active</td>
                                            <td class="text-right">
                                                <button class="btn btn-sm btn-primary">Edit</button>
                                                <button class="btn btn-sm btn-danger">Delete</button>
                                            </td>
                                        </tr>
                                    </tbody>
                                </table>
                            </div><!-- .card-innr -->
                        </div><!-- .card -->
                    </div>
                </div>
            </div><!-- /.container-fluid -->
        </section>
    </div>
</div>

@endsection
