@extends('admin.body.adminmaster')

@section('admin')
<div class="page-wrapper">
    <div class="container-fluid">
        <div class="text-center mb-5">
            <a href="{{ route('manage_products') }}" class="btn btn-outline-secondary">Show All Products</a>
        </div>
        
        <h2 class="my-4 text-center text-primary">Add New Product</h2>
        
        <form action="{{ route('store_product') }}" method="POST" enctype="multipart/form-data" class="shadow p-4 rounded bg-white">
            @csrf

            <!-- Category & Subcategory Section -->
            <div class="mb-4">
                <h4 class="section-title text-secondary mb-3">Category & Subcategory</h4>
                <div class="row">
                    <div class="col-md-6">
                        <div class="mb-3">
                            <label for="category_id" class="form-label">Category</label>
                            <select class="form-select" id="category_id" name="category_id" required>
                                <option value="">Select a Category</option>
                                @foreach($categories as $category)
                                    <option value="{{ $category->id }}">{{ $category->name }}</option>
                                @endforeach
                            </select>
                        </div>
                    </div>

                    <div class="col-md-6">
                        <div class="mb-3" id="subcategory_div" style="display: none;">
                            <label for="subcategory_id" class="form-label">Subcategory</label>
                            <select class="form-select" id="subcategory_id" name="subcategory_id">
                                <option value="">Select a Subcategory</option>
                            </select>
                        </div>
                    </div>
                </div>
            </div>

            <!-- Product Details Section -->
            <div class="mb-4">
                <h4 class="section-title text-secondary mb-3">Product Details</h4>
                <div class="mb-3">
                    <label for="product_name" class="form-label">Product Name</label>
                    <input type="text" class="form-control" id="product_name" name="product_name" placeholder="Enter product name" required>
                </div>

                <div class="mb-3">
                    <label for="short_description" class="form-label">Short Description</label>
                    <textarea class="form-control" id="short_description" name="short_description" rows="3" placeholder="Enter short description" required></textarea>
                </div>

                <div class="mb-3">
                    <label for="images" class="form-label">Product Images</label>
                    <span class="text-danger">@error('images') {{$message}} @enderror</span>
                    <input type="file" class="form-control" id="images" name="images[]" multiple onchange="updateImageList()">
                    <div id="image-names" class="mt-2"></div>
                </div>

                <div class="mb-3">
                    <label for="tags" class="form-label">Tags</label>
                    <input type="text" class="form-control" id="tags" name="tags" placeholder="Enter tags (comma-separated)">
                </div>

                <div class="mb-3">
                    <label for="made_in" class="form-label">Made In</label>
                    <input type="text" class="form-control" id="made_in" name="made_in" placeholder="Enter manufacturing country">
                </div>
            </div>

            <!-- Product Highlights Section -->
            <div class="mb-4">
                <h4 class="section-title text-secondary mb-3">Product Highlights</h4>
                <div class="mb-3">
                    <label for="product_highlight" class="form-label">Product Highlight</label>
                    <textarea class="form-control" id="product_highlight" name="product_highlight" rows="2" placeholder="Highlight product features"></textarea>
                </div>

                <div class="mb-3">
                    <label for="description" class="form-label">Description</label>
                    <textarea class="form-control" id="description" name="description" rows="4" placeholder="Enter product description"></textarea>
                </div>
            </div>

            <!-- Variant Section (Price & Size) -->
            <div class="mb-4">
                <h4 class="section-title text-secondary mb-3">Product Variant</h4>
                
                <div class="mb-3">
                    <label for="product_size" class="form-label">Size</label>
                    <select class="form-select" id="product_size" name="product_size" required>
                        <option value="">Select a Size</option>
                        @foreach($sizes as $size)
                            <option value="{{ $size->id }}">{{ $size->size }}</option>
                        @endforeach
                    </select>
                </div>

                <div class="mb-3">
                    <label for="product_color" class="form-label">Color</label>
                    <select class="form-select" id="product_color" name="product_color" required>
                        <option value="">Select a Color</option>
                        @foreach($colors as $color)
                            <option value="{{ $color->id }}">{{ $color->name }}</option>
                        @endforeach
                    </select>
                </div>

                

                <div class="mb-3">
                    <label for="price" class="form-label">Price</label>
                    <input type="number" step="0.01" class="form-control" id="price" name="price" placeholder="Enter price" required>
                </div>

                <div class="mb-3">
                    <label for="percentage_off" class="form-label">Percentage Off</label>
                    <input type="number" step="0.01" class="form-control" id="percentage_off" name="percentage_off" placeholder="Enter percentage off">
                </div>

                <div class="mb-3">
                    <label for="special_price" class="form-label">Special Price</label>
                    <input type="number" step="0.01" class="form-control" id="special_price" name="special_price" placeholder="Special price will be calculated" readonly>
                </div>
            </div>

            <!-- Product Options Section -->
            <div class="mb-4">
                <h4 class="section-title text-secondary mb-3">Product Options</h4>
                
                <div class="row mb-3 g-3">
                    <div class="col-md-4">
                        <label for="cancelable" class="form-label">Cancelable</label>
                        <input type="checkbox" class="form-check-input" id="cancelable" name="cancelable" value="1">
                        <label class="form-check-label" for="cancelable">This product is cancelable</label>
                    </div>

                    <div class="col-md-4">
                        <label for="returnable" class="form-label">Returnable</label>
                        <input type="checkbox" class="form-check-input" id="returnable" name="returnable" value="1">
                        <label class="form-check-label" for="returnable">This product is returnable</label>
                    </div>

                    <div class="col-md-4">
                        <label for="cod" class="form-label">COD</label>
                        <input type="checkbox" class="form-check-input" id="cod" name="cod" value="1">
                        <label class="form-check-label" for="cod">This product is COD</label>
                    </div>
                </div>
            </div>

            <!-- Submit Button -->
            <div class="text-center">
                <button type="submit" class="btn btn-primary px-4 py-2 rounded-pill shadow-lg w-50">Add Product</button>
            </div>
        </form>
    </div>
</div>

<script>
    // Function to calculate special price based on price and discount percentage
    function calculateSpecialPrice() {
        var price = parseFloat(document.getElementById('price').value);
        var percentageOff = parseFloat(document.getElementById('percentage_off').value);

        if (!isNaN(price) && !isNaN(percentageOff)) {
            var discount = (percentageOff / 100) * price;
            var specialPrice = price - discount;
            document.getElementById('special_price').value = specialPrice.toFixed(2);
        } else {
            document.getElementById('special_price').value = '';
        }
    }

    document.getElementById('price').addEventListener('input', calculateSpecialPrice);
    document.getElementById('percentage_off').addEventListener('input', calculateSpecialPrice);

    // Handle Category and Subcategory Dropdown
    document.getElementById('category_id').addEventListener('change', function() {
        var categoryId = this.value;

        if (categoryId) {
            fetch(`/get-subcategories/${categoryId}`)
                .then(response => response.json())
                .then(data => {
                    var subcategoryDiv = document.getElementById('subcategory_div');
                    subcategoryDiv.style.display = 'block';
                    
                    var subcategorySelect = document.getElementById('subcategory_id');
                    subcategorySelect.innerHTML = '<option value="">Select a Subcategory</option>';
                    data.subcategories.forEach(subcategory => {
                        var option = document.createElement('option');
                        option.value = subcategory.id;
                        option.textContent = subcategory.name;
                        subcategorySelect.appendChild(option);
                    });
                });
        } else {
            document.getElementById('subcategory_div').style.display = 'none';
        }
    });

    // Update Image List
    function updateImageList() {
        var imageInput = document.getElementById('images');
        var imageNamesContainer = document.getElementById('image-names');
        imageNamesContainer.innerHTML = '';

        var files = imageInput.files;
        for (var i = 0; i < files.length; i++) {
            var imageName = document.createElement('div');
            imageName.textContent = files[i].name;
            imageNamesContainer.appendChild(imageName);
        }
    }
</script>

<style>
    .section-title {
        font-size: 1.4rem;
        font-weight: 600;
    }

    .form-label {
        font-weight: bold;
    }

    .form-select, .form-control {
        border-radius: 8px;
        box-shadow: inset 0 1px 3px rgba(0, 0, 0, 0.12);
    }

    .btn-primary {
        font-size: 1rem;
        font-weight: 600;
    }

    .form-check-label {
        font-weight: normal;
    }

    .form-check-input {
        margin-top: 0.3rem;
    }

    .rounded-pill {
        border-radius: 30px;
    }

    .shadow-lg {
        box-shadow: 0 4px 8px rgba(0, 0, 0, 0.1);
    }

    .form-check-input:checked {
        background-color: #007bff;
        border-color: #007bff;
    }
</style>

@endsection

