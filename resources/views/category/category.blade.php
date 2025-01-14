@extends('admin.body.adminmaster')

@section('admin')
<div class="page-wrapper">
     <div class="container-fluid">

        <div class="container-fluid">
            <div class="row">
                <div class="col-md-12">
                    <div class="card shadow-sm">
                        <!-- Header Section -->
                        <div class="card-header bg-primary text-white d-flex justify-content-between align-items-center">
                            <h3 class="card-title">Categories</h3>
                            <a href="{{ route('category.create') }}" class="btn btn-success btn-sm">
                                <i class="fas fa-plus"></i> Add Category
                            </a>
                        </div>

                        <!-- Table Section -->
                        <div class="card-body">
                            <div class="table-responsive">
                                <table class="table table-hover table-bordered">
                                    <thead class="thead-dark">
                                        <tr>
                                            <th>Name</th>
                                            <th>Image</th>
                                            <th>Banner</th>
                                            <th>Status</th>
                                            <th>Actions</th>
                                        </tr>
                                    </thead>
                                    <tbody>
                                        @forelse($viewCategories as $category)
                                            <tr>
                                                <td>{{ $category->name }}</td> 
                                                <td>
                                                    @if($category->image) 
                                                        <img src="{{ $category->image }}" alt="Category Image" class="img-thumbnail" style="max-width: 100px; height: auto;">    
                                                        @else 
                                                        <span>No Image</span> 
                                                    @endif
                                                </td>

                                                <!-- Category Banner -->
                                                <td>
                                                    @if($category->banner)
                                                        <img src="{{ $category->banner }}" alt="Banner" class="img-thumbnail" style="max-width: 100px;">
                                                    @else
                                                        <span>No Banner</span>
                                                    @endif
                                                </td>

                                                <!-- Status -->
                                                <td>
                                                    <span class="badge {{ $category->status == 1 ? 'badge-success' : 'badge-danger' }}">
                                                        {{ $category->status == 1 ? 'Active' : 'Inactive' }}
                                                    </span>
                                                </td>

                                                <!-- Action Buttons -->
                                                <td>
                                                    <div class="d-flex align-items-center">
                                                        <a href="{{ route('category.edit', $category->id) }}" class="btn btn-sm btn-warning mr-1" title="Edit">
                                                            <i class="fas fa-edit"></i>
                                                        </a>

                                                        <!-- Activate/Deactivate -->
                                                        <a href="{{ route('category.toggleStatus', $category->id) }}" class="btn btn-sm btn-info" title="Activate/Deactivate">
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
                            <div class="row">
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

                            <!-- Pagination Links -->
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
