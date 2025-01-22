@extends('admin.body.adminmaster')

@section('admin')
<div class="page-wrapper">
    <div class="container-fluid">
    <form action="{{ route('system_updater') }}" method="get"></form>
    
    <div class="content-wrapper">
    <section class="content-header">
        <div class="container-fluid">
            <div class="row mb-2">
                <div class="col-sm-6">
                    <h4>Update (Version 2.5.0)</h4>
                </div>
            </div>
        </div>
    </section>
    <section class="content">
        <div class="container-fluid">
            <div class="alert alert-danger">
                <div class="alert-title">NOTE:</div>
                Make sure you update system in sequence. Like if you have current version 1.0 and you want to update this version to 1.5 then you can't update it directly. You must have to update in sequence like first update version 1.2 then 1.3 and 1.4 so on.
            </div>
            
                        <div class="row">
                <div class="col-md-12">
                    <div class="card card-info">
                        <form class="form-horizontal form-submit-event" action="#" method="POST" enctype="multipart/form-data">
                            <div class="card-body">
                                <div class="dropzone" id="system-update-dropzone">
                                </div>
                                <div class="form-group pt-3">
                                    <button class="btn btn-success" id="system_update_btn">Update The System</button>
                                </div>
                                <div class="d-flex justify-content-center">
                                    <div class="form-group" id="error_box">
                                    </div>
                                </div>
                            </div>
                        </form>
                    </div>
                    <!--/.card-->
                </div>
                <!--/.col-md-12-->
            </div>
            <!-- /.row -->
        </div><!-- /.container-fluid -->
    </section>
    
    
@endsection
