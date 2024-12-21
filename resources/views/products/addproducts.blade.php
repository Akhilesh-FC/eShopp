@extends('admin.body.adminmaster')
@section('admin')
<div class="container">
    <h2 class="my-4 text-center">Add New Product</h2>
    <form action="{{ route('store_product') }}" method="POST" enctype="multipart/form-data">
        @csrf
        <div class="mb-3">
            <label for="product_name" class="form-label">Product Name</label>
            <input type="text" class="form-control" id="product_name" name="product_name" placeholder="Enter product name" required>
        </div>

        
        <div class="mb-3">
            <label for="category_id" class="form-label">Category</label>
            <select class="form-select" id="category_id" name="category_id" required>
                <option value="">Select a Category</option>
                @foreach($categories as $category)
                    <option value="{{ $category->id }}">{{ $category->name }}</option>
                @endforeach
            </select>
        </div>

        <div class="mb-3">
            <label for="short_description" class="form-label">Short Description</label>
            <textarea class="form-control" id="short_description" name="short_description" rows="3" placeholder="Enter short description" required></textarea>
        </div>

        <div class="mb-3">
            <label for="images" class="form-label">Product Images</label>
            <input type="file" class="form-control" id="images" name="images[]" multiple>
        </div>

        <div class="mb-3">
            <label for="tags" class="form-label">Tags</label>
            <input type="text" class="form-control" id="tags" name="tags" placeholder="Enter tags (comma-separated)">
        </div>

        <div class="mb-3">
            <label for="made_in" class="form-label">Made In</label>
            <input type="text" class="form-control" id="made_in" name="made_in" placeholder="Enter manufacturing country">
        </div>

        <div class="mb-3">
            <label for="product_highlight" class="form-label">Product Highlight</label>
            <textarea class="form-control" id="product_highlight" name="product_highlight" rows="2" placeholder="Highlight product features"></textarea>
        </div>

        <div class="mb-3">
            <label for="description" class="form-label">Description</label>
            <textarea class="form-control" id="description" name="description" rows="4" placeholder="Enter product description"></textarea>
        </div>

        <div class="mb-3">
            <label for="price" class="form-label">Price</label>
            <input type="number" step="0.01" class="form-control" id="price" name="price" placeholder="Enter price" required>
        </div>

        <div class="mb-3">
            <label for="special_price" class="form-label">Special Price</label>
            <input type="number" step="0.01" class="form-control" id="special_price" name="special_price" placeholder="Enter special price">
        </div>

        <div class="mb-3">
            <label for="percentage_off" class="form-label">Percentage Off</label>
            <input type="number" step="0.01" class="form-control" id="percentage_off" name="percentage_off" placeholder="Enter percentage off">
        </div>

        <button type="submit" class="btn btn-primary w-100">Add Product</button>
    </form>
</div>
@endsection
