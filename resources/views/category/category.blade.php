@extends('admin.body.adminmaster')

@section('admin')
<div class="content-wrapper">
    <section class="content">
        <div class="container-fluid">
            <div class="row">
                <div class="col-md-12">
                    <div class="card shadow-sm">
                        <div class="card-header bg-primary text-white">
                            <h3 class="card-title">Categories</h3>
                        </div>
                        <div class="card-body">
                            <!-- Make table responsive -->
                            <div class="table-responsive">
                                <table class="table table-hover table-bordered">
                                    <thead class="thead-dark">
                                        <tr>
                                            <th>Name</th>
                                            <th>Image</th>
                                            <th>Banner</th>
                                            <th>Status</th>
                                            <th>Action</th>
                                        </tr>
                                    </thead>
                                    <tbody>
                                        @forelse($viewCategories as $categories)
                                            <tr>
                                                <td>{{ $categories->name }}</td>
                                                
                                                <!-- Show Image -->
                                                <td>
                                                    @if($categories->image)
                                                        <img src="{{ $categories->image }}" alt="Category Image" class="img-thumbnail" style="max-width: 100px; height: auto;">
                                                    @else
                                                        <span>No Image</span>
                                                    @endif  
                                                </td>
                                                
                                                <!-- Show Banner -->
                                                <td>
                                                    @if($categories->banner) 
                                                        <!-- Display the image if the URL is valid -->
                                                        <img src="{{ $categories->banner }}" alt="Category Banner" class="img-fluid" style="max-width: 100px; height: 50;"> 
                                                    @else
                                                        <span>No Banner</span> 
                                                    @endif 
                                                </td>

                                                 
                                                <!-- Show Status -->
                                                <td>
                                                    <span class="badge {{ $categories->status == 1 ? 'badge-success' : 'badge-danger' }}">
                                                        {{ $categories->status == 1 ? 'Active' : 'Inactive' }} 
                                                    </span>
                                                </td>
                                                
                                                <!-- Action Buttons -->
                                                <td>
                                                    <div class="d-flex align-items-center">
                                                        <a href="#" class="btn btn-sm btn-warning mr-1" title="Edit">
                                                            <i class="fas fa-edit"></i>
                                                        </a>
                                                        <a href="#" class="btn btn-sm btn-danger mr-1" title="Delete">
                                                            <i class="fas fa-trash"></i>
                                                        </a>
                                                        <a href="#" class="btn btn-sm btn-info mr-1" title="View">
                                                            <i class="fas fa-eye"></i>
                                                        </a>
                                                    </div>
                                                </td>
                                            </tr>
                                        @empty
                                            <tr>
                                                <td colspan="5" class="text-center">No categories found</td>
                                            </tr>
                                        @endforelse
                                    </tbody>
                                </table>
                            </div>

                            <!-- Pagination Section -->
                            <div class="row mb-3">
                                <div class="col-md-6"> 
                                    <form action="{{ route('category') }}" method="GET">
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
                                        Showing {{ $viewCategories->firstItem() }} to {{ $viewCategories->lastItem() }} of {{ $viewCategories->total() }} rows
                                    </p>
                                </div>  
                            </div>

                            <!-- Pagination links -->
                            <div class="d-flex justify-content-center">
                                {{ $viewCategories->appends(['per_page' => request('per_page')])->links('pagination::bootstrap-4') }}
                            </div>

                        </div>
                    </div>
                </div>
            </div>
        </div>
    </section>
</div>
@endsection
