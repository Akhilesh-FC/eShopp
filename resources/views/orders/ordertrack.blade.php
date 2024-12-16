@extends('admin.body.adminmaster')
@section('admin')
  
<form action="{{route('orders_track')}}" method="get"></form>
                
<div class="container">
    <div class="row">
        <div class="col-12">
            <h4 class="mb-4">Order Tracking</h4>
            <nav aria-label="breadcrumb">
                <ol class="breadcrumb">
                    <li class="breadcrumb-item"><a href="#">Home</a></li>
                    <li class="breadcrumb-item active" aria-current="page">Order Tracking</li>
                </ol>
            </nav>
            <div class="card">
                <div class="card-body">
                    <div class="mt-3">
                        <div class="d-flex justify-content-end">
                            <input type="text" class="form-control w-25" placeholder="Search">
                            <button class="btn btn-light ml-2"><i class="fa fa-refresh"></i></button>
                            <button class="btn btn-light ml-2"><i class="fa fa-download"></i></button>
                            <button class="btn btn-light ml-2"><i class="fa fa-bars"></i></button>
                        </div>
                    </div><br>
                    <div class="table-responsive">
                        <table class="table table-bordered table-striped">
                            <thead class="thead-light">
                                <tr>
                                    <th>ID</th>
                                    <th>Order ID</th>
                                    <th>Order Item ID</th>
                                    <th>courier_agency</th>
                                    <th>tracking_id</th>
                                    <th>URL</th>
                                    <th>Date</th>
                                    <th>Actions</th>
                                </tr>
                            </thead>
                            <tbody>
                                <tr>
                                    <td colspan="8" class="text-center">No matching records found</td>
                                </tr>
                            </tbody>
                        </table>
                    </div>
                    
                </div>
            </div>
        </div>
    </div>
</div>
@endsection



