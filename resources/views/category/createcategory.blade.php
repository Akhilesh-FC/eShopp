@extends('admin.body.adminmaster')

@section('admin')
<div class="content-wrapper">
    <section class="content">
        <div class="container-fluid">
            <div class="row">
                <div class="col-md-8 offset-md-2">
                    <div class="card shadow-sm">
                        <div class="card-header bg-primary text-white">
                            <h3 class="card-title">Add Category</h3>
                        </div>
                        <div class="card-body">
                           <form action="{{ route('category.store') }}" method="POST" enctype="multipart/form-data">
                                @csrf
                                <!-- Category Name -->
                                <div class="form-group">
                                    <label for="name">Category Name <span class="text-danger">*</span></label>
                                    <input type="text" name="name" id="name" class="form-control" placeholder="Enter category name" required>
                                </div>
                            
                                <!-- Main Image -->
                                <div class="form-group">
                                    <label for="image">Main Image <span class="text-danger">*</span></label>
                                    <input type="file" name="image" id="image" class="form-control-file" required>
                                    <small class="form-text text-muted">Recommended size: 131 x 131 pixels</small>
                                </div>
                            
                                <!-- Banner Image -->
                                <div class="form-group">
                                    <label for="banner">Banner Image</label>
                                    <input type="file" name="banner" id="banner" class="form-control-file">
                                </div>
                            
                                <!-- Buttons -->
                                <div class="form-group text-center">
                                    <button type="submit" class="btn btn-success mr-2">Add Category</button>
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
