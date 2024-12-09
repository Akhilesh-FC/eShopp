@extends('admin.body.adminmaster')

@section('admin')
<div class="content-wrapper">
    <section class="content-header">
        <div class="container-fluid">
            <div class="row mb-2">
                <div class="col-sm-6">
                    <h4>View Customers</h4>
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
                        <table class="table table-hover table-bordered">
                            <thead class="thead-dark">
                                <tr>
                                    <th>ID</th>
                                    <th>Name</th>
                                    <th>Email</th>
                                    <th>Mobile No</th>
                                    <th>Balance</th>
                                    <th>Street</th>
                                    <th>Area</th>
                                    <th>City</th>
                                    <th>Date</th>
                                    <th>Status</th>
                                    <th>Action</th>
                                </tr>
                            </thead>
                            <tbody>
                                @forelse($viewCustomers as $customer)
                                    <tr>
                                        <td>{{ $customer->id }}</td>  
                                        <td>{{ $customer->username }}</td> 
                                        <td>{{ $customer->email }}</td> 
                                        <td>{{ $customer->mobile }}</td>
                                        <td>{{ $customer->balance }}</td>
                                        <td>{{ $customer->street }}</td>
                                        <td>{{ $customer->area }}</td>
                                        <td>{{ $customer->city }}</td>
                                        <td>{{ $customer->updated_at }}</td>
                    
                                    </tr>
                                @empty
                                    <tr>
                                        <td colspan="4" class="text-center">No customers found</td> 
                                    </tr>
                                @endforelse
                            </tbody> 
                        </table>

                        <!-- Rows per page selector -->
                        <div class="row mb-3">
                            <div class="col-md-6">
                                <form action="{{ route('view_customer') }}" method="GET">
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
                                    Showing {{ $viewCustomers->firstItem() }} to {{ $viewCustomers->lastItem() }} of {{ $viewCustomers->total() }} rows
                                </p>
                            </div>
                        </div>

                        <!-- Pagination links -->
                        <div class="d-flex justify-content-center">
                            {{ $viewCustomers->appends(['per_page' => request('per_page')])->links('pagination::bootstrap-4') }}
                        </div>

                    </div>
                </div>
            </div>
        </div>
    </div>
</section>

</div>
@endsection
