@extends('admin.body.adminmaster')
@section('admin')

    <form action="{{route('firebase') }}" method="get"></form>
    
    <div class="content-wrapper">
    <section class="content-header">
        <div class="container-fluid">
            <div class="row mb-2">
                <div class="col-sm-6">
                    <h4>Firebase Settings</h4>
                </div>
                <div class="col-sm-6">
                    <ol class="breadcrumb float-sm-right">
                        <li class="breadcrumb-item"><a href="https://avrluxe.com/admin/home">Home</a>
                        </li>
                        <li class="breadcrumb-item active">Firebase Settings</li>
                    </ol>
                </div>
            </div>
        </div>
    </section>
    <section class="content">
        <div class="container-fluid">
            <div class="row">
                <div class="col-md-12">
                    <div class="card card-info">
                        <form class="form-horizontal form-submit-event" action="https://avrluxe.com/admin/web-setting/store_firebase" method="POST" id="system_setting_form" enctype="multipart/form-data">
                            <div class="card-body">
                                <div class="row">
                                    <div class="form-group col-md-6">
                                        <label for="apiKey">apiKey <span class='text-danger text-xs'>*</span></label>
                                        <input type="text" class="form-control" name="apiKey" value="AIzaSyBXZIGKoYCG6YknutOiywet2FIgcdPaJN8" placeholder="apiKey" />
                                    </div>
                                    <div class="form-group col-md-6">
                                        <label for="authDomain">authDomain <span class='text-danger text-xs'>*</span></label>
                                        <input type="text" class="form-control" name="authDomain" value="avrluxe.firebaseapp.com" placeholder="authDomain" />
                                    </div>
                                    <div class="form-group col-md-6">
                                        <label for="databaseURL">databaseURL <span class='text-danger text-xs'>*</span></label>
                                        <input type="text" class="form-control" name="databaseURL" value="https://avrluxe-default-rtdb.firebaseio.com" placeholder="databaseURL" />
                                    </div>
                                    <div class="form-group col-md-6">
                                        <label for="projectId">projectId <span class='text-danger text-xs'>*</span></label>
                                        <input type="text" class="form-control" name="projectId" value="avrluxe" placeholder="projectId" />
                                    </div>
                                    <div class="form-group col-md-6">
                                        <label for="storageBucket">storageBucket <span class='text-danger text-xs'>*</span></label>
                                        <input type="text" class="form-control" name="storageBucket" value="avrluxe.appspot.com" placeholder="storageBucket" />
                                    </div>
                                    <div class="form-group col-md-6">
                                        <label for="messagingSenderId">messagingSenderId <span class='text-danger text-xs'>*</span></label>
                                        <input type="text" class="form-control" name="messagingSenderId" value="467428708818" placeholder="messagingSenderId" />
                                    </div>
                                    <div class="form-group col-md-6">
                                        <label for="appId">appId <span class='text-danger text-xs'>*</span></label>
                                        <input type="text" class="form-control" name="appId" value="1:467428708818:web:a4cd8daa6ede7a8021380b" placeholder="appId" />
                                    </div>
                                    <div class="form-group col-md-6">
                                        <label for="measurementId">measurementId <span class='text-danger text-xs'>*</span></label>
                                        <input type="text" class="form-control" name="measurementId" value="G-HFPDF99RFK" placeholder="measurementId" />
                                    </div>
                                    <div class="form-group">
                                        <button type="reset" class="btn btn-warning">Reset</button>
                                        <button type="submit" class="btn btn-success" id="submit_btn">Update Settings</button>
                                    </div>
                                </div>
                                <hr>
                            </div>
                        </form>
                    </div>
                </div>
            </div>
    </section>
    
@endsection
