@extends('admin.body.adminmaster')

@section('admin')
<div class="page-wrapper">
    <div class="container-fluid">
  
<div class="container-fluid">

<form action="{{ route('section_order') }}" method="get"></form>

 <div class="content-wrapper">
    <!-- Content Header (Page header) -->
    <!-- Main content -->
    <section class="content-header">
        <div class="container-fluid">
            <div class="row mb-2">
                <div class="col-sm-6">
                    <h4>Manage Section Order</h4>
                </div>
                <div class="col-sm-6">
                    <ol class="breadcrumb float-sm-right">
                        <li class="breadcrumb-item"><a href="">Home</a></li>
                        <li class="breadcrumb-item active">Section Order</li>
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
                        <div class="card-header border-0">
                        </div>
                        <div class="card-innr">
                            <div class="card-body">
                                <div class="row">
                                    <div class="col-md-6 col-12 offset-md-3">
                                        <label for="subcategory_id" class="col-form-label">Section List</label>
                                        <div class="row font-weight-bold">
                                            <div class="col-2">No.</div>
                                            <div class="col-6">Row Order Id</div>
                                            <div class="col-4">Title</div>
                                        </div>
                                        <ul class="list-group bg-grey move order-container" id="sortable">
                                                                                            <li class="list-group-item d-flex bg-gray-light align-items-center h-25" id="section_id-6">
                                                    <div class="col-md-2"><span> 0 </span></div>
                                                    <div class="col-md-6"><span> 0 </span></div>
                                                    <div class="col-md-4"><span>Diwali Offer</span></div>
                                                </li>
                                                                                    </ul>
                                        <button type="button" class="btn btn-block btn-success btn-lg mt-3" id="save_section_order">Save</button>
                                    </div>
                                </div>
                            </div><!-- .card-innr -->
                        </div><!-- .card -->
                    </div>

                </div>
                <!-- /.row -->
            </div><!-- /.container-fluid -->
    </section>



@endsection
