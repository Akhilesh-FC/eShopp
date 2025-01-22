@extends('admin.body.adminmaster')

@section('admin')
<div class="page-wrapper">
    <div class="container-fluid">
         <div class="row mb-4">
            <div class="col-12">
                <a href="{{ route('add_promo_code') }}" class="btn btn-primary">
                    <i class="fas fa-arrow-up"></i> Add Promo Code 
                </a>
            </div>
        </div>
        <form action="{{ route('promo_code') }}" method="get"></form>

        <div class="content-wrapper">
            <section class="content-header">
                <div class="container-fluid">
                    <div class="row mb-2">
                        <div class="col-sm-6">
                            <h4 class="font-weight-bold text-dark">Manage Promo Codes</h4>
                        </div>
                        <!--<div class="col-sm-6">-->
                        <!--    <ol class="breadcrumb float-sm-right">-->
                        <!--        <li class="breadcrumb-item"><a href="">Home</a></li>-->
                        <!--        <li class="breadcrumb-item active">Manage Promo Codes</li>-->
                        <!--    </ol>-->
                        <!--</div>-->
                    </div>
                </div><!-- /.container-fluid -->
            </section>

            <section class="content">
                <div class="container-fluid">
                    <div class="row">
                        <div class="col-md-12 main-content">
                            <div class="card content-area p-4 shadow-sm">
                                <!--<div class="card-header border-0">-->
                                <!--    <div class="card-tools">-->
                                <!--        <input type="text" class="form-control" placeholder="Search Promo Code" id="searchBox">-->
                                <!--    </div>-->
                                <!--</div>-->
                                <div class="card-innr">
                                    <div class="gaps-1-5x"></div>
                                    <table class="table table-bordered table-striped table-hover">
                                        <thead class="thead-dark">
                                            <tr>
                                                <th>ID</th>
                                                <th>Promo Code</th>
                                                <th>Promo Code Name</th>
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
                                                <td>{{ $promo->promo_code_name }}</td>
                                                <td><img src="{{ asset('path/to/images/'.$promo->image) }}" alt="Promo Image" width="50" class="img-fluid rounded"></td>
                                                <td>{{ $promo->message }}</td>
                                                <td>{{ $promo->start_date }}</td>
                                                <td>{{ $promo->end_date }}</td>
                                                <td>{{ $promo->discount }}%</td>
                                                <td>{{ $promo->discount_type }}</td>
                                                <td>
                                                    <span class="badge {{ $promo->status == 'Active' ? 'badge-success' : 'badge-danger' }}">{{
                                                        $promo->status }}</span>
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
                                            <!-- Pagination Links -->
                                            {{ $promo_codes->links('pagination::bootstrap-4') }}
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

    <!-- Modal for Pagination Info -->
    <div class="modal fade" id="paginationModal" tabindex="-1" aria-labelledby="paginationModalLabel" aria-hidden="true">
        <div class="modal-dialog">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="paginationModalLabel">Pagination Info</h5>
                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                </div>
                <div class="modal-body">
                    <p>Showing {{ $promo_codes->firstItem() }} to {{ $promo_codes->lastItem() }} of {{ $promo_codes->total() }} promo codes</p>
                    <form action="{{ route('promo_code') }}" method="GET" class="d-inline-block">
                        <label for="per_page">Rows per page:</label>
                        <select name="per_page" id="per_page" class="form-control d-inline-block w-auto" onchange="this.form.submit()">
                            <option value="5" {{ request('per_page') == 5 ? 'selected' : '' }}>5</option>
                            <option value="10" {{ request('per_page') == 10 ? 'selected' : '' }}>10</option>
                            <option value="15" {{ request('per_page') == 15 ? 'selected' : '' }}>15</option>
                            <option value="20" {{ request('per_page') == 20 ? 'selected' : '' }}>20</option>
                        </select>
                    </form>
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Close</button>
                    <button type="button" class="btn btn-primary" data-bs-dismiss="modal">Save changes</button>
                </div>
            </div>
        </div>
    </div>
</div>



@endsection
