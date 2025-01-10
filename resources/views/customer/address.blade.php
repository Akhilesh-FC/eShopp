@extends('admin.body.adminmaster')

@section('admin')
<div class="content-wrapper">
    <section class="content">
        <div class="container-fluid">
            <div class="row">
                <div class="col-md-12">
                    <div class="card shadow-sm">
                        <div class="card-header bg-primary text-white">
                            <h3 class="card-title">Customer Address</h3>
                        </div>
                        <div class="card-body">
                            <!-- Search Form -->
                            <form action="{{ route('address') }}" method="get" class="mb-4">
                                <div class="row">
                                    <div class="col-md-8 pr-1"> <!-- Reduced padding on the right -->
                                        <input type="text" name="search" value="{{ request('search') }}" 
                                            class="form-control shadow-sm" 
                                            placeholder="Search by User Name, Mobile, City, etc."
                                            style="font-size: 16px; max-width: 100%;">
                                    </div>
                                    <div class="col-md-4">
                                        <button type="submit" class="btn btn-primary w-100">Search</button>
                                    </div>
                                </div>
                            </form>

                            <div class="table-responsive"> <!-- Added responsiveness to the table -->
                                <table class="table table-hover table-bordered">
                                    <thead class="thead-dark">
                                        <tr>
                                            <th>ID</th>
                                            <th>User Name</th>
                                            <th>Type</th>
                                            <th>Mobile</th>
                                            <th>Alternate Mobile</th>
                                            <th>Landmark</th>
                                            <th>Area</th>
                                            <th>City</th>
                                            <th>State</th>
                                            <th>Pincode</th>
                                            <th>Country</th>
                                        </tr>
                                    </thead>
                                    <tbody>
                                        @forelse($viewAddress as $address)
                                            <tr>
                                                <td>{{ $loop->iteration }}</td>
                                                <td>{{ $address->name }}</td>
                                                <td>{{ $address->type }}</td>
                                                <td>{{ $address->mobile }}</td>
                                                <td>{{ $address->alternate_mobile }}</td>
                                                <td>{{ $address->landmark }}</td>
                                                <td>{{ $address->area }}</td>
                                                <td>{{ $address->city }}</td>
                                                <td>{{ $address->state }}</td>
                                                <td>{{ $address->pincode }}</td>
                                                <td>{{ $address->country }}</td>
                                            </tr>
                                        @empty
                                            <tr>
                                                <td colspan="11" class="text-center">No addresses found</td>
                                            </tr>
                                        @endforelse
                                    </tbody>
                                </table>
                            </div>

                            <!-- Rows per page selector -->
                            <div class="row mb-3">
                                <div class="col-md-6">
                                    <form action="{{ route('address') }}" method="GET">
                                        <label for="per_page">Rows per page:</label>
                                        <select name="per_page" id="per_page" class="form-control d-inline-block w-auto" onchange="this.form.submit()">
                                            <option value="5" {{ request('per_page') == 5 ? 'selected' : '' }}>5</option>
                                            <option value="10" {{ request('per_page') == 10 ? 'selected' : '' }}>10</option>
                                            <option value="15" {{ request('per_page') == 15 ? 'selected' : '' }}>15</option>
                                            <option value="20" {{ request('per_page') == 20 ? 'selected' : '' }}>20</option>
                                        </select>
                                    </form>
                                </div>
                                <div class="col-md-6 text-right">
                                    <p>
                                        Showing {{ $viewAddress->firstItem() }} to {{ $viewAddress->lastItem() }} of {{ $viewAddress->total() }} rows
                                    </p>
                                </div>
                            </div>

                            <!-- Pagination links -->
                            <div class="d-flex justify-content-center">
                                {{ $viewAddress->appends(['per_page' => request('per_page'), 'search' => request('search')])->links('pagination::bootstrap-4') }}
                            </div>

                        </div>
                    </div>
                </div>
            </div>
        </div>
    </section>
</div>
@endsection
