@extends('admin.body.adminmaster')

@section('admin')
<div class="content-wrapper">
    <section class="content-header">
        <div class="container-fluid">
            <div class="row mb-2">
                <div class="col-sm-6">
                    <h4>View Customers</h4>
                </div>
                <div class="col-sm-6 text-right">
                    <!-- Search Form -->
                    <form action="{{ route('view_customer') }}" method="GET" class="form-inline">
                        <div class="input-group" style="width: 100%; max-width: 500px;">
                            <!-- Larger input with more width -->
                            <input type="text" name="search" value="{{ request('search') }}" class="form-control" placeholder="Search by Name, Email, or Mobile" style="font-size: 16px; padding: 10px;">
                            <div class="input-group-append">
                                <button type="submit" class="btn btn-primary" style="padding: 10px 15px;">
                                    <i class="fas fa-search"></i> Search
                                </button>
                            </div>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </section>

    <section class="content">
        <div class="container-fluid">
            <div class="row">
                <div class="col-md-12">
                    <div class="card shadow-sm">
                        <div class="card-header bg-primary text-white">
                            <h3 class="card-title">Customer List</h3>
                        </div>
                        <div class="card-body">
                            <!-- Table to display customers -->
                            <table class="table table-hover table-bordered">
                                <thead class="thead-dark">
                                    <tr>
                                        <th>ID</th>
                                        <th>Name</th>
                                        <th>Image</th>
                                        <th>Email</th>
                                        <th>Mobile No</th>
                                        <th>Status</th>
                                        <th>Action</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    @forelse($viewCustomers as $customer)
                                        <tr>
                                            <td>{{ $customer->id }}</td>
                                            <td>{{ $customer->username }}</td> 
                                            <td>
                                                @if($customer->image) 
                                                    <img src="{{ $customer->image }}" alt="Customer Image" class="img-thumbnail" style="max-width: 100px; height: auto;">    
                                                @else 
                                                    <span>No Image</span> 
                                                @endif
                                            </td>
                                            <td>{{ $customer->email }}</td> 
                                            <td>{{ $customer->mobile }}</td>
                                            <td>
                                                <form action="{{ route('view_customer.toggleStatus', $customer->id) }}" method="GET" style="display: inline;">
                                                    <button type="submit" class="btn btn-sm {{ $customer->active == 0 ? 'btn-danger' : 'btn-success' }}">
                                                        {{ $customer->active == 1 ? 'Deactivate' : 'Activate' }}
                                                    </button>
                                                </form>
                                            </td>
                                            <td>
                                                <a href="#" class="btn btn-warning btn-sm">Edit</a>
                                                <a href="#" class="btn btn-danger btn-sm" onclick="return confirm('Are you sure?')">Delete</a>
                                            </td>
                                        </tr>
                                    @empty
                                        <tr>
                                            <td colspan="7" class="text-center">No customers found</td> 
                                        </tr>
                                    @endforelse
                                </tbody> 
                            </table>

                            <!-- Rows per page and pagination -->
                            <div class="row mb-3">
                                <div class="col-md-6">
                                    <form action="{{ route('view_customer') }}" method="GET">
                                        <label for="per_page" class="mr-2">Rows per page:</label>
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
                                        Showing {{ $viewCustomers->firstItem() }} to {{ $viewCustomers->lastItem() }} of {{ $viewCustomers->total() }} rows
                                    </p>
                                </div>
                            </div>

                            <!-- Pagination links -->
                            <div class="d-flex justify-content-center">
                                {{ $viewCustomers->appends(['per_page' => request('per_page'), 'search' => request('search')])->links('pagination::bootstrap-4') }}
                            </div>

                        </div>
                    </div>
                </div>
            </div>
        </div>
    </section>

</div>
@endsection
