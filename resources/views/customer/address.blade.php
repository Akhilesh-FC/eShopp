@extends('admin.body.adminmaster')
@section('admin')

<form action="{{ route('address') }}" method="get"></form>

<div class="content-wrapper">
    <section class="content-header">
        <div class="container-fluid">           
            <div class="row mb-2">
                <div class="col-sm-6">
                    <h4>Customer Address</h4>
                </div>
                <div class="col-sm-6">
                    <ol class="breadcrumb float-sm-right">
                        <li class="breadcrumb-item"><a href="#">Home</a></li>
                        <li class="breadcrumb-item active">Customer Address</li>
                    </ol>
                </div>
            </div>
        </div><!-- /.container-fluid -->
    </section>
    <section class="content address-section">
        <div class="container-fluid">
            <div class="row">
                <div class="col-md-12 main-content">
                    <div class="card content-area p-4">
                        <div class="card-innr">
                            <div class="gaps-1-5x"></div>
                            <input type='hidden' id='address_user_id' value=''>
                            <table class='table-striped' id='customer-address-table' data-toggle="table" data-url="#" data-click-to-select="true" data-side-pagination="server" data-pagination="true" data-page-list="[5, 10, 20, 50, 100, 200]" data-search="true" data-show-columns="true" data-show-refresh="true" data-trim-on-search="false" data-sort-name="id" data-sort-order="desc" data-mobile-responsive="true" data-toolbar="" data-show-export="true" data-maintain-selected="true" data-query-params="address_query_params">
                                <thead>
                                    <tr>
                                        <th data-field="id" data-sortable="true">Id</th>
                                        <th data-field="name" data-sortable="false">User Name</th>
                                        <th data-field="type" data-sortable="false">Type</th>
                                        <th data-field="mobile" data-sortable="false">mobile</th>
                                        <th data-field="alternate_mobile" data-sortable="false">Alternate mobile</th>
                                        <th data-field="address" data-sortable="false" data-visible="false">Address</th>
                                        <th data-field="landmark" data-sortable="false">Landmark</th>
                                        <th data-field="area" data-sortable="false">Area</th>
                                        <th data-field="city" data-sortable="false">City</th>
                                        <th data-field="state" data-sortable="false">State</th>
                                        <th data-field="pincode" data-sortable="false">Pincode</th>
                                        <th data-field="country" data-sortable="false">Country</th>
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
    <!-- /.content -->
</div>
        <div class="modal fade " id='media-upload-modal' tabindex="-1" role="dialog" aria-labelledby="myLargeModalLabel" aria-hidden="true">
    <div class="modal-dialog modal-xl">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="exampleModalLongTitle">Media</h5>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>
            <div class="modal-body">
                <div class="col-md-12 main-content">
                    <div class="content-area p-4">
                        <div class="card-innr">
                            <div class="gaps-1-5x"></div>
                            <input type='hidden' name='media_type' id='media_type' value='image'>
                            <input type='hidden' name='current_input'>
                            <input type='hidden' name='remove_state'>
                            <input type='hidden' name='multiple_images_allowed_state'>
                            <div class="col-md-12 mt-3 mb-3 mb-5">
                                <!-- Change /upload-target to your upload address -->
                                <div id="dropzone" class="dropzone"></div>
                                <br>
                                <a href="" id="upload-files-btn" class="btn btn-success float-right">Upload</a>
                            </div>
                            <div class="alert alert-warning">Select media and click choose media</div>
                            <div id="toolbar">
                                <button id='upload-media' class="btn btn-danger">
                                    <i class="fa fa-plus"></i> Choose Media
                                </button>
                            </div>
                            <table class='table-striped' data-toolbar="#toolbar" id='media-upload-table' data-page-size="5" data-toggle="table" data-url="https://avrluxe.com/admin/media/fetch" data-click-to-select="true" data-side-pagination="server" data-pagination="true" data-page-list="[5, 10, 20, 50, 100, 200]" data-search="true" data-show-columns="true" data-show-refresh="true" data-trim-on-search="false" data-sort-name="id" data-sort-order="asc" data-mobile-responsive="true" data-toolbar="" data-show-export="true" data-query-params="mediaParams">
                                <thead>
                                    <tr>
                                        <th data-field="state" data-checkbox="true"></th>
                                        <th data-field="id" data-sortable="true" data-visible='false'>ID</th>
                                        <th data-field="image" data-sortable="false">Image</th>
                                        <th data-field="name" data-sortable="false">Name</th>
                                        <th data-field="size" data-sortable="false">Size</th>
                                        <th data-field="extension" data-sortable="false" data-visible='false'>Extension</th>
                                        <th data-field="sub_directory" data-sortable="false" data-visible='false'>Sub directory</th>
                                    </tr>
                                </thead>
                            </table>
                        </div><!-- .card-innr -->
                    </div><!-- .card -->
                </div>
            </div>
        </div>
    </div>


@endsection