@extends('admin.body.adminmaster')

@section('admin')
<div class="page-wrapper">
    <div class="container-fluid">
        <form action="{{ route('promo_code') }}" method="get"></form>

        <div class="content-wrapper">
            <section class="content-header">
                <div class="container-fluid">
                    <div class="row mb-2">
                        <div class="col-sm-6">
                            <h4 class="font-weight-bold text-dark">Manage Promo Codes</h4>
                        </div>
                        <div class="col-sm-6">
                            <ol class="breadcrumb float-sm-right">
                                <li class="breadcrumb-item"><a href="https://avrluxe.com/admin/home">Home</a></li>
                                <li class="breadcrumb-item active">Manage Promo Codes</li>
                            </ol>
                        </div>
                    </div>
                </div><!-- /.container-fluid -->
            </section>

            <section class="content">
                <div class="container-fluid">
                    <div class="row">
                        <div class="col-md-12 main-content">
                            <div class="card content-area p-4 shadow-sm">
                                <div class="card-header border-0">
                                    <div class="card-tools">
                                        <input type="text" class="form-control" placeholder="Search Promo Code" id="searchBox">
                                    </div>
                                </div>
                                <div class="card-innr">
                                    <div class="gaps-1-5x"></div>
                                    <table class="table table-bordered table-striped table-hover">
                                        <thead class="thead-dark">
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
                                            @foreach ($promo_codes as $promo)
                                            <tr>
                                                <td>{{ $promo->id }}</td>
                                                <td>{{ $promo->promo_code }}</td>
                                                <td><img src="{{ asset('path/to/images/'.$promo->image) }}" alt="Promo Image" width="50" class="img-fluid rounded"></td>
                                                <td>{{ $promo->message }}</td>
                                                <td>{{ $promo->start_date }}</td>
                                                <td>{{ $promo->end_date }}</td>
                                                <td>{{ $promo->discount }}%</td>
                                                <td>{{ $promo->discount_type }}</td>
                                                <td>
                                                    <span class="badge {{ $promo->status == 'Active' ? 'badge-success' : 'badge-danger' }}">
                                                        {{ $promo->status }}
                                                    </span>
                                                </td>
                                               <td>
                                                    <a href="{{ route('promo_code.edit', $promo->id) }}" class="btn btn-primary btn-sm">
                                                        <i class="fa fa-edit"></i> Edit
                                                    </a>
                                                    
                                                    <form action="{{ route('promo_code.delete', $promo->id) }}" method="POST" style="display:inline;" onsubmit="return confirmDelete();">
                                                        @csrf
                                                        @method('DELETE')
                                                        <button type="submit" class="btn btn-danger btn-sm">
                                                            <i class="fa fa-trash"></i> Delete
                                                        </button>
                                                    </form>
                                                </td>
                                                
                                                <script>
                                                    function confirmDelete() {
                                                        return confirm('Are you sure you want to delete this promo code?');
                                                    }
                                                </script>

                                            </tr>
                                            @endforeach
                                        </tbody>
                                    </table>

                                    <!-- Pagination -->
                                    <nav aria-label="Page navigation example">
                                        <ul class="pagination justify-content-center">
                                            <!-- Add pagination links here if needed -->
                                        </ul>
                                    </nav>
                                </div><!-- .card-innr -->
                            </div><!-- .card -->
                        </div>
                    </div>
                </div><!-- /.container-fluid -->
            </section>
        </div>
    </div>
@endsection
