@extends('admin.body.adminmaster')

@section('admin')
<div class="page-wrapper">
    <div class="container-fluid">
    <form action="{{ route('zip_code') }}" method="get"></form>
    
    <div class="content-wrapper">
  <!-- Content Header (Page header) -->
  <!-- Main content -->
  <section class="content-header">
    <div class="container-fluid">
      <div class="row mb-2">
        <div class="col-sm-6">
          <h4>Manage Zipcodes</h4>
        </div>
        <div class="col-sm-6">
          <ol class="breadcrumb float-sm-right">
            <li class="breadcrumb-item"><a href="#">Home</a></li>
            <li class="breadcrumb-item active">Zipcodes</li>
          </ol>
        </div>
      </div>
    </div><!-- /.container-fluid -->
  </section>
  <section class="content">
    <div class="container-fluid">
      <div class="row">
        <div class="col-md-12">
          <div class="card card-info">
            <!-- form start -->
            <form class="form-horizontal form-submit-event" action="#" method="POST" id="add_product_form" enctype="multipart/form-data">
                            <div class="card-body">
                <div class="form-group">
                  <label for="city_name">Zipcode <span class='text-danger text-sm'>*</span></label>
                  <input type="text" class="form-control" name="zipcode" id="zipcode" value="">
                </div>
                <div class="form-group">
                  <button type="reset" class="btn btn-warning">Reset</button>
                  <button type="submit" class="btn btn-success" id="submit_btn">Add Zipcode</button>
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
        <div class="modal fade edit-modal-lg" tabindex="-1" role="dialog" aria-labelledby="myLargeModalLabel" aria-hidden="true">
          <div class="modal-dialog modal-lg">
            <div class="modal-content">
              <div class="modal-header">
                <h5 class="modal-title" id="exampleModalLongTitle">Edit Zipcode</h5>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                  <span aria-hidden="true">&times;</span>
                </button>
              </div>
              <div class="modal-body">
              </div>
            </div>
          </div>
        </div>
        <div class="col-md-12 main-content">
          <div class="card content-area p-4">
            <div class="card-head">
              <h4 class="card-title">Zipcode Details</h4>
            </div>
            <div class="card-innr">
              <div class="gaps-1-5x"></div>
              <table class='table-striped' data-toggle="table" data-url="#" data-click-to-select="true" data-side-pagination="server" data-pagination="true" data-page-list="[5, 10, 20, 50, 100, 200]" data-search="true" data-show-columns="true" data-show-refresh="true" data-trim-on-search="false" data-sort-name="id" data-sort-order="asc" data-mobile-responsive="true" data-toolbar="" data-show-export="true" data-maintain-selected="true" data-export-types='["txt","excel"]' data-query-params="queryParams">
                <thead>
                  <tr>
                    <th data-field="id" data-sortable="true">ID</th>
                    <th data-field="zipcode" data-sortable="false">Zipcode</th>
                    <th data-field="operate" data-sortable="true">Actions</th>
                  </tr>
                </thead>
              </table>
            </div><!-- .card-innr -->
          </div><!-- .card -->
        </div>
      </div>
      <!-- /.row -->
    </div><!-- /.container-fluid -->
  </section>
    
@endsection    