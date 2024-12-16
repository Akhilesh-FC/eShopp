@extends('admin.body.adminmaster')
@section('admin')

    <form action="{{route('theme') }}" method="get"></form>
    
   <div class="content-wrapper">
    <section class="content-header">
        <div class="container-fluid">
            <div class="row mb-2">
                <div class="col-sm-6">
                    <h4>Themes</h4>
                </div>
                <div class="col-sm-6">
                    <ol class="breadcrumb float-sm-right">
                        <li class="breadcrumb-item"><a href="https://avrluxe.com/admin/home">Home</a></li>
                        <li class="breadcrumb-item active">Themes</li>
                    </ol>
                </div>
            
                        
                    
        </div>
    </section>
    <section class="content address-section">
        <div class="container-fluid">
            
            <div class="row">
                
                <div class="col-md-12 main-content">
                    <div class="card content-area p-4">
                        <div class="card-innr">
                            <div class="d-flex justify-content-end">
                            <input type="text" class="form-control w-25" placeholder="Search">
                            <button class="btn btn-light ml-2"><i class="fa fa-refresh"></i></button>
                            <button class="btn btn-light ml-2"><i class="fa fa-download"></i></button>
                            <button class="btn btn-light ml-2"><i class="fa fa-bars"></i></button>
                        </div>
                        
                            <div class="gaps-1-5x"></div>
                            <!-- Static Table -->
                            <table class='table table-striped' id='customer-address-table'>
                                <thead>
                                    <tr>
                                        <th>Id</th>
                                        <th>Name</th>
                                        <th>Image</th>
                                        <th>Default</th>
                                        <th>Status</th>
                                        <th>Created On</th>
                                        <th>Action</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    <!-- Row 1 -->
                                    <tr>
                                        <td>1</td>
                                        <td>Theme One</td>
                                        <td><img src="https://via.placeholder.com/50" alt="Theme One" style="width: 50px; height: 50px;"></td>
                                        <td>Yes</td>
                                        <td>Active</td>
                                        <td>2024-11-25</td>
                                        <td>
                                            <button class="btn btn-primary btn-sm">Edit</button>
                                            <button class="btn btn-danger btn-sm">Delete</button>
                                        </td>
                                    </tr>
                                    <!-- Row 2 -->
                                    <tr>
                                        <td>2</td>
                                        <td>Theme Two</td>
                                        <td><img src="https://via.placeholder.com/50" alt="Theme Two" style="width: 50px; height: 50px;"></td>
                                        <td>No</td>
                                        <td>Inactive</td>
                                        <td>2024-11-20</td>
                                        <td>
                                            <button class="btn btn-primary btn-sm">Edit</button>
                                            <button class="btn btn-danger btn-sm">Delete</button>
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

    
    
@endsection
