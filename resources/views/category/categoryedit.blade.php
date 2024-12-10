@extends('admin.body.adminmaster')

@section('admin')
<div class="content-wrapper">
    <section class="content">
        <div class="container-fluid">
            <div class="row">
                <div class="col-md-12">
                    <div class="card shadow-sm">
                        <!-- Header Section -->
                        <div class="card-header bg-primary text-white">
                            <h3 class="card-title">Edit Category</h3>
                        </div>

                        <!-- Edit Form -->
                        <div class="card-body">
                            <form action="{{ route('category.update', $category->id) }}" method="POST" enctype="multipart/form-data">
                                @csrf
                                @method('POST')

                                <div class="form-group">
                                    <label for="name">Category Name</label>
                                    <input type="text" name="name" id="name" class="form-control" value="{{ $category->name }}" required>
                                </div>

                                <div class="form-group">
                                    <label for="image">Category Image</label>
                                    <input type="file" name="image" id="image" class="form-control">
                                    @if($category->image)
                                        <img src="{{ $category->image }}" alt="Category Image" class="img-thumbnail mt-2" style="max-width: 100px; height: auto;">
                                    @else
                                        <p>No Image Available</p>
                                    @endif
                                </div>

                                <div class="form-group">
                                    <label for="banner">Category Banner</label>
                                    <input type="file" name="banner" id="banner" class="form-control">
                                    @if($category->banner)
                                        <img src="{{ $category->banner }}" alt="Category Banner" class="img-thumbnail mt-2" style="max-width: 100px; height: auto;">
                                    @else
                                        <p>No Banner Available</p>
                                    @endif
                                </div>

                                <div class="form-group">
                                    <label for="status">Status</label>
                                    <select name="status" id="status" class="form-control">
                                        <option value="1" {{ $category->status == 1 ? 'selected' : '' }}>Active</option>
                                        <option value="0" {{ $category->status == 0 ? 'selected' : '' }}>Inactive</option>
                                    </select>
                                </div>

                                <div class="form-group">
                                    <button type="submit" class="btn btn-primary">Update Category</button>
                                </div>
                            </form>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </section>
</div>
@endsection
