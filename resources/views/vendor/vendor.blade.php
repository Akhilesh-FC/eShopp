@extends('admin.body.adminmaster')

@section('admin')
<div class="container">
    <h2 class="my-4 text-center">Vendors List</h2>
    
    <div class="table-responsive">
        <table class="table table-striped table-hover table-bordered">
            <thead class="thead-dark">
                <tr>
                    <th>#</th>
                    <th>Vendor Name</th>
                    <th>Image</th>
                    <th>Mobile</th>
                    <th>Address</th>
                    <th>Status</th>
                    <th>Action</th>
                </tr>
            </thead>
            <tbody>
                @foreach($vendors as $vendor)
                    <tr>
                        <td>{{ $vendor->id }}</td>
                        <td>{{ $vendor->name }}</td>
                        <td>
                            @if(isset($vendor->vendor_image) && $vendor->vendor_image)
                                <img src="{{ $vendor->vendor_image }}" alt="Vendor Image" class="img-thumbnail" style="max-width: 100px; height: auto;">
                            @else
                                <span>No Image</span>
                            @endif
                        </td>
                        <td>{{ $vendor->mobile }}</td>
                        <td>{{ $vendor->address }}</td>
                        <td>
                            @if($vendor->active == 1)
                                <!-- Form to Inactive vendor -->
                                <form action="{{ route('update_vendor_status', ['v_id' => $vendor->id, 'status' => 0]) }}" method="POST" style="display: inline-block;">
                                    @method('PUT')
                                    @csrf
                                    <button class="btn btn-danger btn-sm" type="submit">Inactive</button>
                                </form>
                            @elseif($vendor->active == 0)
                                <!-- Form to Active vendor -->
                                <form action="{{ route('update_vendor_status', ['v_id' => $vendor->id, 'status' => 1]) }}" method="POST" style="display: inline-block;">
                                    @method('PUT')
                                    @csrf
                                    <button class="btn btn-success btn-sm" type="submit">Active</button>
                                </form>
                            @else
                                <span>Unknown Status</span>
                            @endif
                        </td>
                        <td>
                            <a href="{{ route('vendor_details', $vendor->id) }}" class="btn btn-info btn-sm">Vendor Details</a>
                            <a href="{{ route('vendor_productdetails', $vendor->id) }}" class="btn btn-primary btn-sm mt-1">Vendor Product Details</a>
                        </td>
                    </tr>
                @endforeach
            </tbody>
        </table>
    </div>

    <div class="row mt-3">
        <div class="col-md-6">
            <p>Showing {{ $vendors->firstItem() }} to {{ $vendors->lastItem() }} of {{ $vendors->total() }} rows</p>
        </div>
        <div class="col-md-6 text-right">
            <!-- "Rows per page" dropdown -->
            <form action="{{ route('vendor') }}" method="GET" class="d-inline-block">
                <label for="per_page" class="mr-2">Rows per page:</label>
                <select name="per_page" id="per_page" class="form-control d-inline-block w-auto" onchange="this.form.submit()">
                    <option value="5" {{ request('per_page') == 5 ? 'selected' : '' }}>5</option>
                    <option value="10" {{ request('per_page') == 10 ? 'selected' : '' }}>10</option>
                    <option value="15" {{ request('per_page') == 15 ? 'selected' : '' }}>15</option>
                    <option value="20" {{ request('per_page') == 20 ? 'selected' : '' }}>20</option>
                </select>
            </form>
        </div>
    </div>

    <!-- Pagination Links -->
    <div class="d-flex justify-content-center">
        {{ $vendors->appends(['per_page' => request('per_page')])->links('pagination::bootstrap-4') }}
    </div>
    
</div>
@endsection
