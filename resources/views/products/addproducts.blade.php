@extends('admin.body.adminmaster')

@section('admin')
<div class="page-wrapper">
     <div class="container-fluid">
        <div class="text-center mb-5">
            <a href="{{ route('manage_products') }}" class="btn btn-lg btn-outline-primary rounded-pill px-4 py-2">Show All Products</a>
        </div>
        
        <h2 class="my-4 text-center text-dark" style="font-family: 'Roboto', sans-serif;">Add New Product</h2>
        
        <form action="{{ route('store_product') }}" method="POST" enctype="multipart/form-data" class="form-container">
            @csrf

            <!-- Category & Subcategory Section -->
            <div class="section">
                <h4 class="section-title">Category & Subcategory</h4>
                <div class="row">
                    <div class="col-md-6">
                        <div class="form-group">
                            <label for="category_id" class="form-label">Category</label>
                            <select class="form-control" id="category_id" name="category_id" required>
                                <option value="">Select a Category</option>
                                @foreach($categories as $category)
                                    <option value="{{ $category->id }}">{{ $category->name }}</option>
                                @endforeach
                            </select>
                        </div>
                    </div>

                    <div class="col-md-6">
                        <div class="form-group" id="subcategory_div" style="display: none;">
                            <label for="subcategory_id" class="form-label">Subcategory</label>
                            <select class="form-control" id="subcategory_id" name="subcategory_id">
                                <option value="">Select a Subcategory</option>
                            </select>
                        </div>
                    </div>
                </div>
            </div>

            <!-- Product Details Section -->
            <div class="section">
                <h4 class="section-title">Product Details</h4>
                <div class="form-group">
                    <label for="product_name" class="form-label">Product Name</label>
                    <input type="text" class="form-control" id="product_name" name="product_name" placeholder="Enter product name" required>
                </div>
                
                <div class="form-group">
                    <label for="description" class="form-label">Description</label>
                    <textarea class="form-control" id="description" name="description" rows="4" placeholder="Enter product description"></textarea>
                </div>

                <div class="form-group">
                    <label for="short_description" class="form-label">Short Description</label>
                    <textarea class="form-control" id="short_description" name="short_description" rows="3" placeholder="Enter short description" required></textarea>
                </div>

                <div class="form-group">
                    <label for="images" class="form-label">Product Images</label>
                    <input type="file" class="form-control" id="images" name="images[]" multiple>
                </div>
                
                <h4 class="section-title">Product Highlights</h4>
                <div class="form-group">
                    <label for="product_highlight" class="form-label">Product Highlight</label>
                    <textarea class="form-control" id="product_highlight" name="product_highlight" rows="2" placeholder="Highlight product features"></textarea>
                </div>

                <div class="form-group">
                    <label for="tags" class="form-label">Tags</label>
                    <input type="text" class="form-control" id="tags" name="tags" placeholder="Enter tags (comma-separated)">
                </div>

                <div class="form-group">
                    <label for="made_in" class="form-label">Made In</label>
                    <input type="text" class="form-control" id="made_in" name="made_in" placeholder="Enter manufacturing country">
                </div>
                
                <div class="form-group">
                    <label for="minimum_order_quantity" class="form-label">Minimum Order Quantity</label>
                    <input type="text" class="form-control" id="minimum_order_quantity" name="minimum_order_quantity" placeholder="Enter minimum order quantity">
                </div>
                
                <div class="form-group">
                    <label for="total_allowed_quantity" class="form-label">Total Allowed Quantity</label>
                    <input type="text" class="form-control" id="total_allowed_quantity" name="total_allowed_quantity" placeholder="Enter total allowed quantity">
                </div>

                <div class="form-group">
                    <label for="price" class="form-label">Product Price</label>
                    <input type="number" class="form-control" id="price" name="price" placeholder="Enter product price" required>
                </div>

                <div class="form-group">
                    <label for="percentage_off" class="form-label">Discount Percentage</label>
                    <input type="number" class="form-control" id="percentage_off" name="percentage_off" placeholder="Enter discount percentage" min="0" max="100">
                </div>

                <div class="form-group">
                    <label for="special_price" class="form-label">Special Price</label>
                    <input type="number" class="form-control" id="special_price" name="special_price" placeholder="Special Price" readonly>
                </div>
            </div>
            
            <!-- Additional Options Section -->
            <div class="section">
                <h4 class="section-title">Additional Options</h4>
                <div class="form-check">
                    <input class="form-check-input" type="checkbox" name="cod_allowed" value="1" id="cod_allowed">
                    <label class="form-check-label" for="cod_allowed">
                        COD Allowed
                    </label>
                </div>

                <div class="form-check">
                    <input class="form-check-input" type="checkbox" name="is_returnable" value="1" id="is_returnable">
                    <label class="form-check-label" for="is_returnable">
                        Is Returnable
                    </label>
                </div>

                <div class="form-check">
                    <input class="form-check-input" type="checkbox" name="is_cancelable" value="1" id="is_cancelable">
                    <label class="form-check-label" for="is_cancelable">
                        Is Cancelable
                    </label>
                </div>
            </div>

            <!-- Product Variants Section -->
            <div class="section" id="product-variants">
                <h4 class="section-title">Product Variants (Size & Color)</h4>
                <div class="variant-group" id="variant-1">
                    <div class="row">
                        <div class="col-md-4">
                            <label class="form-label">Size</label>
                            <select class="form-control" name="variants[0][size]" required>
                                <option value="">Select Size</option>
                                @foreach($sizes as $size)
                                    <option value="{{ $size->id }}">{{ $size->size }}</option>
                                @endforeach
                            </select>
                        </div>

                        <div class="col-md-4">
                            <label class="form-label">Color</label>
                            <select class="form-control" name="variants[0][color]" required>
                                <option value="">Select Color</option>
                                @foreach($colors as $color)
                                    <option value="{{ $color->id }}">{{ $color->name }}</option>
                                @endforeach
                            </select>
                        </div>

                        <div class="col-md-4">
                            <label for="variant_quantity" class="form-label">Quantity</label>
                            <input type="number" class="form-control" name="variants[0][quantity]" placeholder="Enter quantity" required>
                        </div>
                    </div>
                </div>

                <div class="text-center">
                    <button type="button" class="btn btn-outline-success btn-lg" id="add-variant-btn">Add Another Variant</button>
                </div>
            </div>

            <!-- Submit Button -->
            <div class="text-center mt-4">
                <button type="submit" class="btn btn-primary btn-lg w-50 rounded-pill">Add Product</button>
            </div>
        </form>
    </div>
</div>

<script>
    // Dynamic Subcategory Loading
    document.getElementById('category_id').addEventListener('change', function() {
        let categoryId = this.value;
        
        if (categoryId) {
            fetch(`/get-subcategories/${categoryId}`)
                .then(response => response.json())
                .then(data => {
                    let subcategorySelect = document.getElementById('subcategory_id');
                    subcategorySelect.innerHTML = '<option value="">Select a Subcategory</option>';
                    data.subcategories.forEach(subcategory => {
                        subcategorySelect.innerHTML += `<option value="${subcategory.id}">${subcategory.name}</option>`;
                    });
                    document.getElementById('subcategory_div').style.display = 'block';
                });
        } else {
            document.getElementById('subcategory_div').style.display = 'none';
        }
    });

    // Special Price Calculation
    document.getElementById('price').addEventListener('input', calculateSpecialPrice);
    document.getElementById('percentage_off').addEventListener('input', calculateSpecialPrice);

    function calculateSpecialPrice() {
        let price = parseFloat(document.getElementById('price').value) || 0;
        let discount = parseFloat(document.getElementById('percentage_off').value) || 0;

        if (price && discount) {
            let specialPrice = price - (price * (discount / 100));
            document.getElementById('special_price').value = specialPrice.toFixed(2);
        } else {
            document.getElementById('special_price').value = '';
        }
    }
    
    // Dynamic Variant Adding
    document.getElementById('add-variant-btn').addEventListener('click', function() {
        var variantIndex = document.querySelectorAll('.variant-group').length;
        var newVariantGroup = document.createElement('div');
        newVariantGroup.classList.add('variant-group');
        newVariantGroup.id = 'variant-' + variantIndex;
        
        newVariantGroup.innerHTML = `
            <div class="row">
                <div class="col-md-4">
                    <label class="form-label">Size</label>
                    <select class="form-control" name="variants[${variantIndex}][size]" required>
                        <option value="">Select Size</option>
                        @foreach($sizes as $size)
                            <option value="{{ $size->id }}">{{ $size->size }}</option>
                        @endforeach
                    </select>
                </div>

                <div class="col-md-4">
                    <label class="form-label">Color</label>
                    <select class="form-control" name="variants[${variantIndex}][color]" required>
                        <option value="">Select Color</option>
                        @foreach($colors as $color)
                            <option value="{{ $color->id }}">{{ $color->name }}</option>
                        @endforeach
                    </select>
                </div>

                <div class="col-md-4">
                    <label for="variant_quantity" class="form-label">Quantity</label>
                    <input type="number" class="form-control" name="variants[${variantIndex}][quantity]" placeholder="Enter quantity" required>
                </div>
            </div>
        `;
        
        document.getElementById('product-variants').appendChild(newVariantGroup);
    });
</script>

@endsection
