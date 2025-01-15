@extends('admin.body.adminmaster')

@section('admin')
<div class="page-wrapper">
    <div class="container-fluid">
<!--<div class="container-fluid">-->

<form action="{{route('brand')}}" method="get"></form>
                
<section class="content-header">
        <div class="container-fluid">
            <div class="row mb-2">
                <div class="col-sm-6">
                    <h4>Manage Brand</h4>
                </div>
                <div class="col-sm-6">
                    <ol class="breadcrumb float-sm-right">
                        <li class="breadcrumb-item"><a href="#">Home</a></li>
                        <li class="breadcrumb-item active">Brand</li>
                    </ol>
                </div>
            </div>
        </div><!-- /.container-fluid -->
    </section>
    <section class="content">
        <div class="container-fluid">
            <div class="row">
                <div class="modal fade edit-modal-lg" id="brand_form" tabindex="-1" role="dialog" aria-labelledby="myLargeModalLabel" aria-hidden="true">
                    <div class="modal-dialog modal-lg">
                        <div class="modal-content">
                            <div class="modal-header">
                                <h5 class="modal-title" id="exampleModalLongTitle">Edit Brand</h5>
                                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                                    <span aria-hidden="true">&times;</span>
                                </button>
                            </div>
                            <div class="modal-body p-0">
                            </div>
                        </div>
                    </div>
                </div>
                <div class="col-md-12 ">
                    <div class="card content-area p-4">
                        <div class="card-header border-0">
                            <div class="card-tools">
                                <!-- Move the button to the side and make it smaller -->
                                <a href="#" class="btn btn-outline-primary btn-sm float-right">Add Brand</a>
                            </div>
                        </div>
                        <div class="card-innr" id="list_view_html">
                            <div class="card-head">
                                <h4 class="card-title">Brand</h4>
                            </div>
                            <div class="gaps-1-5x"></div>
                            <table class="table table-striped" id="brand_table">
                                <thead>
                                    <tr>
                                        <th>ID</th>
                                        <th>Name</th>
                                        <th>Image</th>
                                        <th>Status</th>
                                        <th>Action</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    <!-- Static Data Example: -->
                                    @php
                                        $brands = [
                                            ['id' => 1, 'name' => 'Brand 1', 'image' => 'image1.jpg', 'status' => 'Active'],
                                            ['id' => 2, 'name' => 'Brand 2', 'image' => 'image2.jpg', 'status' => 'Inactive'],
                                        ];
                                    @endphp
                                    @foreach($brands as $brand)
                                        <tr>
                                            <td>{{ $brand['id'] }}</td>
                                            <td>{{ $brand['name'] }}</td>
                                            <td><img src="{{ asset('images/'.$brand['image']) }}" alt="{{ $brand['name'] }}" style="width: 50px; height: 50px;"></td>
                                            <td>{{ $brand['status'] }}</td>
                                            <td>
                                                <a href="#" class="btn btn-warning btn-sm">Edit</a>
                                                <a href="#" class="btn btn-danger btn-sm">Delete</a>
                                            </td>
                                        </tr>
                                    @endforeach
                                </tbody>
                            </table>
                        </div><!-- .card-innr -->
                    </div><!-- .card-innr -->
                </div><!-- .card -->
            </div>
        </div>
        <!-- /.row -->
</div><!-- /.container-fluid -->
</section>

</div>
@endsection
