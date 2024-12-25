@extends('admin.body.adminmaster')

@section('admin')
<div class="container mt-4">
    <h3 class="mb-4">Manage Products</h3>

    <!-- Success or Error Messages -->
    @if(session('success'))
        <div class="alert alert-success">
            {{ session('success') }}
        </div>
    @endif

    @if(session('error'))
        <div class="alert alert-danger">
            {{ session('error') }}
        </div>
    @endif

    <!-- Table -->
    <table class="table table-bordered table-hover">
        <thead class="thead-dark">
            <tr>
                <th>Image</th>
                <th>Name</th>
                <th>Brand</th>
                <th>Category Name</th>
                <th>Rating</th>
                <th>Action</th>
            </tr>
        </thead>
        <tbody>
            @foreach ($products as $product)
                <tr>
                    <td>
                        @php
                            // Assuming $product->image is a JSON array
                            $images = json_decode($product->image);
                            $firstImage = $images[0] ?? null;  // Get the first image URL or null if no image
                        @endphp
                        
                        @if ($firstImage)
                            <img src="{{ $firstImage }}" alt="{{ $product->name }}" class="img-fluid" style="width: 50px; height: auto;">
                        @else
                            <span>No image available</span>
                        @endif
                    </td>
                    <td>{{ $product->name }}</td>
                    <td>{{ $product->brand }}</td>
                    <td>{{ $product->category_name ?? 'No Category' }}</td>
                    <td>
                        <form action="{{ route('update_rating', $product->id) }}" method="POST" class="d-inline-block">
                            @csrf
                            <input type="number" name="rating" value="{{ $product->rating }}" min="1" max="5" class="form-control form-control-sm" style="width: 80px; display: inline-block;">
                            <button type="submit" class="btn btn-primary btn-sm ml-2">Update</button>
                        </form>
                    </td>
                    <td>
                        <a href="{{ route('toggle_active_inactive', $product->id) }}" class="btn btn-sm 
                            {{ $product->status == 0 ? 'btn-success' : 'btn-warning' }}">
                            {{ $product->status == 0 ? 'Active' : 'Inactive' }}
                        </a>
                    </td>
                </tr>
            @endforeach
        </tbody>
    </table>

    <!-- Pagination Info -->
    <div class="row mt-3">
        <div class="col-md-6">
            <p>Showing {{ $products->firstItem() }} to {{ $products->lastItem() }} of {{ $products->total() }} rows</p>
        </div>
        <div class="col-md-6 text-right">
            <!-- "Rows per page" dropdown -->
            <form action="{{ route('manage_products') }}" method="GET" class="d-inline-block">
                <label for="per_page">Rows per page:</label>
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
        {{ $products->appends(['per_page' => request('per_page')])->links('pagination::bootstrap-4') }}
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
                    <p>Showing {{ $products->firstItem() }} to {{ $products->lastItem() }} of {{ $products->total() }} rows</p>
                    <form action="{{ route('manage_products') }}" method="GET" class="d-inline-block">
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

<style>
    .modal-header {
        background-color: #007bff;
        color: white;
    }

    /* Custom Table Styles */
    .table th, .table td {
        text-align: center;
        vertical-align: middle;
    }

    .table-hover tbody tr:hover {
        background-color: #f8f9fa;
    }

    .btn-sm {
        margin-left: 5px;
    }

    .alert {
        margin-bottom: 15px;
    }
</style>

<script>
    // Trigger modal when needed, e.g., when user clicks the "Rows per page" dropdown.
    document.getElementById('per_page').addEventListener('change', function() {
        $('#paginationModal').modal('show');
    });
</script>

@endsection
