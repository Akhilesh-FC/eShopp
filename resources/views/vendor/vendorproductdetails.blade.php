@extends('admin.body.adminmaster')

@section('admin')

<div class="container">
    <a href="{{ route('vendor', $vendor->id) }}" class="btn btn-primary mb-4">&larr; Back to Vendor List</a>
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
                        <thead class="thead-dark">
                            <tr>
                                <th>Product ID</th>
                                <th>Product Name</th>
                                <th>Action</th>
                                <th>Category</th>
                                <th>Subcategory</th>
                                <th>Tags</th>
                                <th>Short Description</th>
                                <th>Total Quantity</th>
                                <th>Min Order Quantity</th>
                                <th>Price</th>
                            </tr>
                        </thead>
                        <tbody>
                            @foreach($products as $product)
                                <tr>
                                    <td>{{ $product->id }}</td>
                                    <td>{{ $product->name }}</td>
                                    <td>
                                        @if($product->image && is_array(json_decode($product->image)))
                                            <!-- Button to open the modal -->
                                            <button type="button" class="btn btn-info btn-sm" data-toggle="modal" data-target="#imageModal{{ $product->id }}">View All Images</button>
                                        @else
                                            <span>No Images Available</span>
                                        @endif
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

                                <!-- Modal for showing all images -->
                                <div class="modal fade" id="imageModal{{ $product->id }}" tabindex="-1" role="dialog" aria-labelledby="imageModalLabel" aria-hidden="true">
                                    <div class="modal-dialog modal-lg" role="document">
                                        <div class="modal-content">
                                            <div class="modal-header">
                                                <h5 class="modal-title" id="imageModalLabel">Product Images</h5>
                                                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                                                    <span aria-hidden="true">&times;</span>
                                                </button>
                                            </div>
                                            <div class="modal-body">
                                                <div class="d-flex flex-wrap justify-content-start">
                                                    @foreach(json_decode($product->image) as $image)
                                                        <div class="image-wrapper mb-3">
                                                            <img src="{{ $image }}" alt="Product Image" class="img-fluid img-thumbnail" style="object-fit: cover; height: 200px; width: 200px; margin-right: 10px;">
                                                        </div>
                                                    @endforeach
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            @endforeach
                        </tbody>
                    </table>
                </div>

            </form>
        </div>
    </div>
</div>

<style>
    .image-wrapper {
        margin-bottom: 10px; /* Adds space below each image */
        display: inline-block; /* Makes images appear side by side */
        text-align: center; /* Centers the images within the container */
        width: 20%; /* Allows for 4-5 images per row */
    }

    .image-wrapper img {
        object-fit: cover;
        height: 150px; /* Fixed image height */
        width: 150px; /* Fixed image width */
        margin-right: 10px; /* Adds space between images */
    }

    /* Adjusts the layout of the images to be responsive */
    @media (max-width: 768px) {
        .image-wrapper {
            width: 30%; /* Displays images in 3 per row on medium screens */
        }
    }

    @media (max-width: 576px) {
        .image-wrapper {
            width: 45%; /* Displays images in 2 per row on small screens */
        }
    }

    /* Add alternate background color to table rows for better readability */
    tbody tr:nth-child(even) {
        background-color: #f2f2f2;
    }

    /* Style the table headers */
    .thead-dark th {
        background-color: #343a40;
        color: white;
    }
</style>

<!-- Bootstrap Modal Script (Make sure to include Bootstrap JS and jQuery in your project) -->
<script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
<script src="https://cdn.jsdelivr.net/npm/bootstrap@4.5.2/dist/js/bootstrap.bundle.min.js"></script>

@endsection
