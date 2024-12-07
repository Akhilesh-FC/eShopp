@extends('admin.body.adminmaster')
@section('admin')
<div class="container-fluid">
    <form action="{{ route('sellers') }}" method="get"></form>
    
    <section class="content-header">
        <div class="container-fluid">
            <div class="row mb-2">
                <div class="col-sm-6">
                    <h4>Manage Seller</h4>
                </div>
                <div class="col-sm-6">
                    <ol class="breadcrumb float-sm-right">
                        <li class="breadcrumb-item"><a href="#">Home</a></li>
                        <li class="breadcrumb-item active">Seller</li>
                    </ol>
                </div>
            </div>
        </div>
    </section>
    
    <section class="content">
        <div class="container-fluid">
            <div class="row">
                <div class="col-md-12 main-content">
                    <div class="card content-area p-4">
                        <div class="card-header border-0 d-flex justify-content-between align-items-center">
                            <h5 class="mb-0">Seller List</h5>
                            <div class="card-tools">
                                <a href="#" class="btn btn-outline-primary btn-sm">
                                    Add Seller
                                </a>
                            </div>
                        </div>
                        <div class="card-innr">
                            <div class="mb-3 text-right">
                                <a href="#" class="btn btn-success update-seller-commission" title="If you found seller commission not crediting using cron job you can update seller commission from here!">
                                    Update Seller Commission
                                </a>
                            </div>
                            <!-- Static Table -->
                            <table class="table table-striped" id="seller_table">
                                <thead>
                                    <tr>
                                        <th>ID</th>
                                        <th>Name</th>
                                        <th>Email</th>
                                        <th>Mobile No</th>
                                        <th>Balance</th>
                                        <th>Status</th>
                                        <th>Logo</th>
                                        <th>Actions</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    <!-- Static Data -->
                                    <tr>
                                        <td>1</td>
                                        <td>John Doe</td>
                                        <td>johndoe@example.com</td>
                                        <td>+123456789</td>
                                        <td>$500</td>
                                        <td>Active</td>
                                        <td><img src="path_to_logo.jpg" alt="Logo" width="50"></td>
                                        <td><button class="btn btn-sm btn-primary">Edit</button></td>
                                    </tr>
                                    <tr>
                                        <td>2</td>
                                        <td>Jane Smith</td>
                                        <td>janesmith@example.com</td>
                                        <td>+987654321</td>
                                        <td>$300</td>
                                        <td>Inactive</td>
                                        <td><img src="path_to_logo.jpg" alt="Logo" width="50"></td>
                                        <td><button class="btn btn-sm btn-primary">Edit</button></td>
                                    </tr>
                                    <!-- Add more static rows as needed -->
                                </tbody>
                            </table>
                            
                        </div><!-- .card-innr -->
                    </div><!-- .card -->
                </div>
            </div>
        </div>
    </section>
</div>

<!-- Optional: Add slider JS (e.g., Slick or Swiper) -->
<script>
    $(document).ready(function(){
        $('#slider').slick({
            autoplay: true,
            autoplaySpeed: 2000,
            arrows: true,
            dots: true,
        });
    });
</script>
@endsection
