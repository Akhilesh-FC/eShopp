@extends('admin.body.adminmaster')

@section('admin')

<div class="container">
    <div class="row">
        <div class="col-12">
            <h3>Product Details Add By Vendor</h3>
            <form action="{{ route('vendor_productdetails', $vendor->id) }}" method="POST" enctype="multipart/form-data">
                @csrf

                <!-- Display Vendor Information -->
                <div class="mb-3">
                    <h5>Vendor: {{ $vendor->name }}</h5>
                    <p>Email: {{ $vendor->email }}</p>
                    <p>Phone: {{ $vendor->mobile }}</p>
                </div>

                <!-- Display Products -->
                <div class="table-responsive">
                    <table class="table table-bordered table-striped">
                        <thead>
                            <tr>
                                <th>Product ID</th>
                                <th>Product Name</th>
                                <th>Image</th>
                                <th>Category</th>
                                <th>Subcategory</th>
                                <th>Tags</th>
                                <th>Short Description</th>
                                <th>Total Quantity</th>
                                <th>Min Order Quantity</th>
                                <th>Price</th>
                                <!--<th>Discount</th>-->
                                <!--<th>Special Price</th>-->
                            </tr>
                        </thead>
                        <tbody>
                            @foreach($products as $product)
                                <tr>
                                    <td>{{ $product->id }}</td>
                                    <td>{{ $product->name }}</td>
                                    <td>
                                        <img src="{{ asset('uploads/products/' . $product->image) }}" alt="{{ $product->name }}" width="100">
                                    </td>
                                    <td>{{ $product->category_id }}</td>
                                    <td>{{ $product->subcategory }}</td>
                                    <td>{{ $product->tags }}</td>
                                    <td>{{ $product->short_description }}</td>
                                    <td>{{ $product->total_allowed_quantity }}</td>
                                    <td>{{ $product->minimum_order_quantity }}</td>

                                    <!-- Price and Discount -->
                                    <td>
                                        @php
                                            $variant = $productVariants->firstWhere('product_id', $product->id);
                                        @endphp
                                        @if($variant)
                                            <p>Price: {{ $variant->price }} </p>
                                            <p>Discount: {{ $variant->percentage_off }}%</p>
                                            <p>Special Price: {{ $variant->special_price }}</p>
                                        @else
                                            <p>No variant available</p>
                                        @endif
                                    </td>
                                </tr>
                            @endforeach
                        </tbody>
                    </table>
                </div>

            </form>
        </div>
    </div>
</div>

@endsection
