@extends('admin.body.adminmaster')

@section('admin')
<div class="page-wrapper">
    <div class="container-fluid">
<form action="{{route('promo_code')}}" method="get"></form>

<div class="content-wrapper">
    <!-- Content Header (Page header) -->
    <section class="content-header">
        <div class="container-fluid">
            <div class="row mb-2">
                <div class="col-sm-6">
                    <h4>Manage Promo Code</h4>
                </div>
                <div class="col-sm-6">
                    <ol class="breadcrumb float-sm-right">
                        <li class="breadcrumb-item"><a href="https://avrluxe.com/admin/home">Home</a></li>
                        <li class="breadcrumb-item active">Manage Promo Code</li>
                    </ol>
                </div>
            </div>
        </div><!-- /.container-fluid -->
    </section>

    <!-- Main content -->
    <section class="content">
        <div class="container-fluid">
            <div class="row">
                <div class="col-md-12 main-content">
                    <div class="card content-area p-4">
                        <div class="card-header border-0">
                            <div class="card-tools">
                                <input type="text" class="form-control" placeholder="Search Promo Code" id="searchBox">
                            </div>
                        </div>
                        <div class="card-innr">
                            <div class="gaps-1-5x"></div>
                            <table class='table table-striped'>
                                <thead>
                                    <tr>
                                        <th>ID</th>
                                        <th>Promo Code</th>
                                        <th>Image</th>
                                        <th>Message</th>
                                        <th>Start Date</th>
                                        <th>End Date</th>
                                        <th>Discount</th>
                                        <th>Discount Type</th>
                                        <th>Status</th>
                                        <th>Actions</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    <!-- Static Data Rows -->
                                    <tr>
                                        <td>1</td>
                                        <td>SUMMER20</td>
                                        <td><img src="path/to/image.jpg" alt="Promo Image" width="50"></td>
                                        <td>Get 20% off on all items</td>
                                        <td>2024-06-01</td>
                                        <td>2024-06-30</td>
                                        <td>20%</td>
                                        <td>Percentage</td>
                                        <td>Active</td>
                                        <td><button class="btn btn-primary btn-sm">Edit</button></td>
                                    </tr>
                                    <tr>
                                        <td>2</td>
                                        <td>WINTER10</td>
                                        <td><img src="path/to/image.jpg" alt="Promo Image" width="50"></td>
                                        <td>Flat 10% discount on winter collection</td>
                                        <td>2024-12-01</td>
                                        <td>2024-12-31</td>
                                        <td>10%</td>
                                        <td>Flat</td>
                                        <td>Inactive</td>
                                        <td><button class="btn btn-primary btn-sm">Edit</button></td>
                                    </tr>
                                </tbody>
                            </table>
                            <!-- Pagination -->
                            <nav aria-label="Page navigation example">
                                <ul class="pagination justify-content-center">
                                    <li class="page-item"><a class="page-link" href="#">Previous</a></li>
                                    <li class="page-item"><a class="page-link" href="#">1</a></li>
                                    <li class="page-item"><a class="page-link" href="#">2</a></li>
                                    <li class="page-item"><a class="page-link" href="#">3</a></li>
                                    <li class="page-item"><a class="page-link" href="#">Next</a></li>
                                </ul>
                            </nav>
                        </div><!-- .card-innr -->
                    </div><!-- .card -->
                </div>
            </div>
        </div><!-- /.container-fluid -->
    </section>
</div>



@endsection
