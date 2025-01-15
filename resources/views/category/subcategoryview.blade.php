@extends('admin.body.adminmaster')

@section('admin')
<div class="page-wrapper">
    <div class="container-fluid">
    <section class="content">
        <div class="container-fluid">
            <div class="row">
                <div class="col-md-12">
                    <div class="card shadow-sm">
                        <div class="card-header bg-primary text-white d-flex justify-content-between align-items-center">
                            <h3 class="card-title">SubCategories</h3>
                            <a href="{{ route('subcategory.create') }}" class="btn btn-success btn-sm">
                                <i class="fas fa-plus"></i> Add Category
                            </a>
                        </div>

                        <div class="card-body">
                            <div class="table-responsive">
                                <table class="table table-hover table-bordered">
                                    <thead class="thead-dark">
                                        <tr>
                                            <th>Parent Categories</th>
                                            <th>SubCategories</th>
                                            <th>Image</th>
                                            <th>Status</th>
                                            <th>Actions</th>
                                        </tr>
                                    </thead>
                                    <tbody>
                                        @forelse($categories as $category)
                                            @foreach($subcategories->where('category_id', $category->id) as $subcategory)
                                                <tr>
                                                    <td>{{ $category->name }}</td>
                                                    <td>{{ $subcategory->name }}</td> 
                                                     <td>
                                                    @if($category->image) 
                                                        <img src="{{ $subcategory->image }}" alt="SubCategory Image" class="img-thumbnail" style="max-width: 100px; height: auto;">    
                                                        @else 
                                                        <span>No Image</span> 
                                                    @endif
                                                </td>
                                                    <td>
                                                        <div class="d-flex align-items-center">
                                                            <!-- Edit Button -->
                                                            <a href="#" class="btn btn-sm btn-warning mr-1" title="Edit">
                                                                <i class="fas fa-edit"></i>
                                                            </a>
                                                        </div>
                                                    </td>
                                                    <td>
                                                        <div class="d-flex align-items-center">
                                                            <!-- Edit Button -->
                                                            <a href="#" class="btn btn-sm btn-warning mr-1" title="Edit">
                                                                <i class="fas fa-edit"></i>
                                                            </a>

                                                            <!-- Activate/Deactivate Button -->
                                                            <a href="#" class="btn btn-sm btn-info" title="Activate/Deactivate">
                                                                <i class="fas fa-eye"></i>
                                                            </a>
                                                        </div>
                                                    </td>
                                                </tr>
                                            @endforeach
                                        @empty
                                            <tr>
                                                <td colspan="5" class="text-center">No Subcategories found</td>
                                            </tr>
                                        @endforelse
                                    </tbody>
                                </table>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </section>
</div>
@endsection
