@extends('admin.body.adminmaster')

@section('admin')
<div class="page-wrapper">
     <div class="container-fluid">
        <!-- Back Button -->
        <div class="text-center mb-4">
            <div class="col-md-6">
                <a href="{{ route('manage_products') }}" class="btn btn-lg btn-outline-primary rounded-pill px-4 py-2">Back to Products</a>
            </div>
            <form action="{{ route('view_product_details', $product->id) }}" method="POST" style="display:none;">
                @csrf
                <!-- No button or input fields, just a hidden form for submission -->
            </form>

        </div>

        <!-- Product Details Section -->
        <div class="text-center">
            <h2 class="my-4 text-dark" style="font-family: 'Roboto', sans-serif;">Product Details</h2>
        </div>

        <!-- Product Info -->
        <div class="row">
            <div class="col-md-6">
                <h4 class="text-dark">Product Name</h4>
                <p>{{ $product->product_name }}</p>
            </div>
            <div class="col-md-6">
                <h4 class="text-dark">Category</h4>
                <p>{{ $product->category->name ?? 'N/A' }}</p>
            </div>
        </div>

        <div class="row">
            <div class="col-md-6">
                <h4 class="text-dark">Description</h4>
                <p>{{ $product->description }}</p>
            </div>
            <div class="col-md-6">
                <h4 class="text-dark">Short Description</h4>
                <p>{{ $product->short_description }}</p>
            </div>
        </div>

        <!-- Product Price and Discount -->
        <div class="row">
            <div class="col-md-6">
                <h4 class="text-dark">Product Price</h4>
                <p>{{ $product->price }}</p>
            </div>
            <div class="col-md-6">
                <h4 class="text-dark">Discount Percentage</h4>
                <p>{{ $product->percentage_off }}%</p>
            </div>
        </div>

        <!-- Product Special Price -->
        <div class="row">
            <div class="col-md-6">
                <h4 class="text-dark">Special Price</h4>
                <p>{{ $product->special_price }}</p>
            </div>
        </div>

        <!-- Product Images -->
        <div class="row">
            <div class="col-md-12">
                <h4 class="text-dark">Product Images</h4>
                <div class="d-flex">
                    @foreach($product->images as $image)
                        <img src="{{ asset('storage/' . $image->image_path) }}" alt="Product Image" class="img-thumbnail mr-3" style="width: 100px; height: 100px;">
                    @endforeach
                </div>
            </div>
        </div>

        <!-- Product Highlights -->
        <div class="row">
            <div class="col-md-12">
                <h4 class="text-dark">Product Highlights</h4>
                <p>{{ $product->product_highlight }}</p>
            </div>
        </div>

        <!-- Product Variants Section -->
        <div class="row">
            <div class="col-md-12">
                <h4 class="text-dark">Product Variants</h4>
                <div class="table-responsive">
                    <table class="table table-bordered">
                        <thead>
                            <tr>
                                <th>Size</th>
                                <th>Color</th>
                                <th>Quantity</th>
                            </tr>
                        </thead>
                        <tbody>
                            @foreach($product->variants as $variant)
                                <tr>
                                    <td>{{ $variant->size->size ?? 'N/A' }}</td>
                                    <td>{{ $variant->color->name ?? 'N/A' }}</td>
                                    <td>{{ $variant->quantity }}</td>
                                </tr>
                            @endforeach
                        </tbody>
                    </table>
                </div>
            </div>
        </div>

        <!-- Product Additional Options -->
        <div class="row">
            <div class="col-md-6">
                <h4 class="text-dark">COD Allowed</h4>
                <p>{{ $product->cod_allowed ? 'Yes' : 'No' }}</p>
            </div>
            <div class="col-md-6">
                <h4 class="text-dark">Returnable</h4>
                <p>{{ $product->is_returnable ? 'Yes' : 'No' }}</p>
            </div>
            <div class="col-md-6">
                <h4 class="text-dark">Cancelable</h4>
                <p>{{ $product->is_cancelable ? 'Yes' : 'No' }}</p>
            </div>
        </div>
    </div>
</div>
@endsection
