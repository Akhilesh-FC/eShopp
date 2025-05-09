@extends('admin.body.adminmaster')

@section('admin')
<div class="page-wrapper">
    <div class="container-fluid">
    <form action="{{ route('time_slots') }}" method="get"></form>
    
     <div class="content-wrapper">
    <!-- Content Header (Page header) -->
    <!-- Main content -->
    <section class="content-header">
        <div class="container-fluid">
            <div class="row mb-2">
                <div class="col-sm-6">
                    <h4>Time Slots</h4>
                </div>
                <div class="col-sm-6">
                    <ol class="breadcrumb float-sm-right">
                        <li class="breadcrumb-item"><a href="#">Home</a></li>
                        <li class="breadcrumb-item active">Time Slots</li>
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
                            <form class="form-horizontal form-submit-event" action="#" method="POST" enctype="multipart/form-data">
                                <input type="hidden" id="time_slot_config" name="time_slot_config" required="" value="1" aria-required="true">
                                <div class="card-body">
                                    <div class="row">
                                        <div class="form-group col-md-4">
                                            <label for="">Enable / Disable Time Slots</label>
                                        </div>
                                        <div class="form-group col-md-8">
                                            <input type="checkbox" name="is_time_slots_enabled" Checked data-bootstrap-switch data-off-color="danger" data-on-color="success">
                                        </div>
                                    </div>
                                    <div class="row">
                                        <div class="form-group col-md-4">
                                            <label for="">Delivery Starts From ?</label>
                                        </div>
                                        <div class="form-group col-md-8">
                                            <select class="form-control" name="delivery_starts_from">
                                                <option value="">Select</option>
                                                <option value="1" selected>Today</option>
                                                <option value="2" >Tomorrow</option>
                                                <option value="3" >Third Day</option>
                                                <option value="4" >Fourth Day</option>
                                                <option value="5" >Fifth Day</option>
                                                <option value="6" >Sixth Day</option>
                                                <option value="7" >Seventh Day</option>
                                            </select>
                                        </div>
                                    </div>
                                    <div class="row">
                                        <div class="form-group col-md-4">
                                            <label for="">How many days you want to allow ?</label>
                                        </div>
                                        <div class="form-group col-md-8">
                                            <select class="form-control" name="allowed_days">
                                                <option value="">Select</option>
                                                <option value="1" >1</option>
                                                <option value="7" selected>7</option>
                                                <option value="15" >15</option>
                                                <option value="30" >30</option>
                                            </select>
                                        </div>
                                        <div class="form-group">
                                            <button type="reset" class="btn btn-warning">Reset</button>
                                            <button type="submit" class="btn btn-success" id="submit_btn">Save</button>
                                        </div>
                                    </div><!-- /.box-body -->
                                    <div class="d-flex justify-content-center form-group">
                                        <div id="error_box"></div>
                                    </div>
                                </div>
                            </form>
                        </div>
                        <!--/.card-->
                    </div>
                                <!--/.col-md-12-->
                <div class="col-md-12">
                    <div class="card card-info">
                        <!-- form start -->
                        <form class="form-horizontal form-submit-event" action="#" method="POST" enctype="multipart/form-data">
                                                            <input type="hidden" id="add_time_slot" name="add_time_slot" required="" value="1" aria-required="true">
                                                        <div class="card-body">
                                <div class="row">
                                    <div class="form-group col-md-4">
                                        <label for="">Title</label>
                                    </div>
                                    <div class="form-group col-md-8">
                                        <input type="text" class="form-control" name="title" value="" placeholder="Morning 9AM to 12PM">
                                    </div>
                                </div>
                                <div class="row">
                                    <div class="form-group col-md-4">
                                        <label for="">From Time</label>
                                    </div>
                                    <div class="form-group col-md-8">
                                        <input type="time" class="form-control" name="from_time" value="" placeholder="09:00:00">
                                    </div>
                                </div>
                                <div class="row">
                                    <div class="form-group col-md-4">
                                        <label for="">To Time</label>
                                    </div>
                                    <div class="form-group col-md-8">
                                        <input type="time" class="form-control" name="to_time" value="" placeholder="12:00:00">
                                    </div>
                                </div>
                                <div class="row">
                                <div class="form-group col-md-4">
                                        <label for="">Last Order Time</label>
                                    </div>
                                    <div class="form-group col-md-8">
                                        <input type="time" class="form-control" name="last_order_time" value="" placeholder="11:00:00">
                                    </div>
                                </div>
                                <div class="row">
                                <div class="form-group col-md-4">
                                        <label for="">Status</label>
                                    </div>
                                    <div class="form-group col-md-8">
                                        <select name="status" class="form-control">
                                            <option value="">Select</option>
                                            <option value="1" >Active</option>
                                            <option value="0" >Deactive</option>
                                        </select>
                                    </div>
                                </div>
                                <div class="form-group">
                                    <button type="reset" class="btn btn-warning">Reset</button>
                                    <button type="submit" class="btn btn-success" id="submit_btn">Add Time Slots</button>
                                </div>

                                <div class="d-flex justify-content-center ">
                                    <div id="error_box">
                                    </div>
                                </div>
                            </div><!-- /.box-body -->

                        </form>
                    </div>
                    <!--/.card-->
                    <div class="modal fade edit-modal-lg" tabindex="-1" role="dialog" aria-labelledby="myLargeModalLabel" aria-hidden="true">
                        <div class="modal-dialog modal-lg">
                            <div class="modal-content">
                                <div class="modal-header">
                                    <h5 class="modal-title" id="exampleModalLongTitle">Edit Fetured Section Details</h5>
                                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                                        <span aria-hidden="true">&times;</span>
                                    </button>
                                </div>
                                <div class="modal-body">
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
                <!--/.col-md-12-->
            </div>
            <!-- /.row -->
            <div class="row">
                <div class="col-md-12 main-content">
                    <div class="card content-area p-4">
                        <div class="card-innr">
                            <div class="gaps-1-5x"></div>
                            <table class='table-striped' data-toggle="table" data-url="#" data-click-to-select="true" data-side-pagination="server" data-pagination="true" data-page-list="[5, 10, 20, 50, 100, 200]" data-search="true" data-show-columns="true" data-show-refresh="true" data-trim-on-search="false" data-sort-name="id" data-sort-order="asc" data-mobile-responsive="true" data-toolbar="" data-show-export="true" data-maintain-selected="true" data-export-types='["txt","excel"]' data-query-params="queryParams">
                                <thead>
                                    <tr>
                                        <th data-field="id" data-sortable="true">ID</th>
                                        <th data-field="title" data-sortable="false">Title</th>
                                        <th data-field="from_time" data-sortable="true">From Time</th>
                                        <th data-field="to_time" data-sortable="true">To Time</th>
                                        <th data-field="last_order_time" data-sortable="true">Last Order Time</th>
                                        <th data-field="status" data-sortable="true">Status</th>
                                        <th data-field="operate" data-sortable="true">Action</th>
                                    </tr>
                                </thead>
                            </table>
                        </div><!-- .card-innr -->
                    </div><!-- .card -->
                </div>
            </div> <!-- /.row -->
        </div><!-- /.container-fluid -->
    </section>
    
    
@endsection
