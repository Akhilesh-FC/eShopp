@extends('admin.body.adminmaster')

@section('admin')
<div class="page-wrapper">
    <div class="container-fluid">

<div class="content-wrapper">
    <section class="content">
        <div class="container-fluid">
            <div class="row">
                <div class="col-md-8 offset-md-2">
                    <div class="card shadow-sm">
                        <div class="card-header bg-primary text-white">
                            <h3 class="card-title">Add SubCategory</h3>
                        </div>
                        <div class="card-body">
                           
                            <form action="{{ route('subcategory.store') }}" method="POST" enctype="multipart/form-data">
                                @csrf
                            
                                <!-- Category Dropdown -->
                                <div class="form-group">
                                    <label for="category_id">Select Category <span class="text-danger">*</span></label>
                                    <select name="category_id" id="category_id" class="form-control" required>
                                        <option value="">Select Category</option>
                                        @foreach ($categories as $category)
                                            <option value="{{ $category->id }}">{{ $category->name }}</option>
                                        @endforeach
                                    </select>
                                </div>
                            
                                <!-- SubCategory Name -->
                                <div class="form-group">
                                    <label for="name">SubCategory Name <span class="text-danger">*</span></label>
                                    <input type="text" name="name" id="name" class="form-control" placeholder="Enter Subcategory name" required>
                                </div>
                            
                                <!-- Main Image -->
                                <div class="form-group">
                                    <label for="image">SubCategory Image <span class="text-danger">*</span></label>
                                    <span>@error('image')
                                    {{$message}}
                                            @enderror
                                            
                                    </span>
                                    <input type="file" name="image" id="image" class="form-control-file" required>
                                    <small class="form-text text-muted">Recommended size: 131 x 131 pixels</small>
                                </div>
                            
                                <!-- Buttons -->
                                <div class="form-group text-center">
                                    <button type="submit" class="btn btn-success mr-2">Add SubCategory</button>
                                    <button type="reset" class="btn btn-secondary">Reset</button>
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
