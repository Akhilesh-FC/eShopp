@extends('admin.body.adminmaster')

@section('admin')
<div class="page-wrapper">
     <div class="container-fluid">
<!--<div class="container mt-4">-->
    <div class="text-center mb-4">
        <div class="col-md-6">
            <!-- Search Form -->
            <form action="{{ route('manage_products') }}" method="GET" class="form-inline">
                <input type="text" name="search" value="{{ request('search') }}" class="form-control mr-2" placeholder="Search products...">
                <button type="submit" class="btn btn-primary">Search</button>
            </form>
        </div>
        <a href="{{ route('add_products') }}" class="btn btn-secondary">Add products</a>
    </div>
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
                <!--<th>Brand</th>-->
                <th>Category Name</th>
                <th>Rating</th>
                <th>No.of Rating</th>
                <th>Action</th>
            </tr>
        </thead>
        <tbody>
            @foreach ($products as $product)
                <tr>
                   
                    <td>
                        @php
                            // Assuming $product->image is a JSON array of images
                            $images = json_decode($product->image);
                            $firstImage = $images[0] ?? null;  // Get the first image URL or null if no image
                        @endphp
            
                        @if ($firstImage)
                            <!-- Display the first image -->
                            <img src="{{ $firstImage }}" alt="{{ $product->name }}" class="img-fluid" style="width: 50px; height: auto;">
                            
                            <!-- Check if there are more than one image -->
                            @if (count($images) > 1)
                                <!-- Button to open modal -->
                                <button type="button" class="btn btn-primary" data-toggle="modal" data-target="#imageModal{{ $product->id }}">
                                    Show Images
                                </button>
                            @endif
                        @else
                            <span>No image available</span>
                        @endif
                    </td>

                        <!-- Modal to display all images for this product -->
                        <div class="modal fade" id="imageModal{{ $product->id }}" tabindex="-1" role="dialog" aria-labelledby="imageModalLabel" aria-hidden="true">
                            <div class="modal-dialog modal-lg" role="document">
                                <div class="modal-content">
                                    <div class="modal-header">
                                        <h5 class="modal-title" id="imageModalLabel">Product Images for {{ $product->name }}</h5>
                                        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                                            <span aria-hidden="true">&times;</span>
                                        </button>
                                    </div>
                                    <div class="modal-body">
                                        <!-- Display all images for this product in a responsive grid -->
                                        <div class="row">
                                            @foreach($images as $image)
                                                <div class="col-4 mb-3">
                                                    <img src="{{ $image }}" alt="Product Image" class="img-fluid" style="width: 100%; height: auto;">
                                                </div>
                                            @endforeach
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    


                    <td>{{ $product->name }}</td>
                    <!--<td>{{ $product->brand }}</td>-->
                    <td>{{ $product->category_name ?? 'No Category' }}</td>
                    <td>
                        <form action="{{ route('update_rating', $product->id) }}" method="POST" class="d-inline-block">
                            @csrf
                            <input type="number" name="rating" value="{{ $product->rating }}" min="1" max="5" step="0.1" class="form-control form-control-sm" style="width: 80px; display: inline-block;">

                            <button type="submit" class="btn btn-primary btn-sm ml-2">Update</button>
                        </form>
                    </td>
                     <td>
                        <form action="{{ route('update_rating', $product->id) }}" method="POST" class="d-inline-block">
                            @csrf
                            <input type="number" name="no_of_ratings" value="{{ $product->no_of_ratings }}" min="1" max="50" class="form-control form-control-sm" style="width: 80px; display: inline-block;">
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
