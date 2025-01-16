@extends('admin.body.adminmaster')

@section('admin')
<div class="page-wrapper">
    <div class="container-fluid">
        <h2 class="my-4 text-center text-primary">Add New Product</h2>

        <form action="{{ route('store_product') }}" method="POST" enctype="multipart/form-data">
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
                    <input type="text" class="form-control" id="product_name" name="product_name" required>
                </div>

                <div class="mb-3">
                    <label for="short_description" class="form-label">Short Description</label>
                    <textarea class="form-control" id="short_description" name="short_description" required></textarea>
                </div>

                <div class="mb-3">
                    <label for="tags" class="form-label">Tags</label>
                    <input type="text" class="form-control" id="tags" name="tags">
                </div>
            </div>

            <!-- Product Variants Section -->
            <div id="variant_section">
                <h4 class="section-title text-secondary mb-3">Product Variants</h4>
                <div class="variant-group" id="variant_1">
                    <h5>Variant 1</h5>
                    <div class="mb-3">
                        <label for="size_1" class="form-label">Size</label>
                        <input type="text" class="form-control" id="size_1" name="variants[0][size]" placeholder="Enter Size">
                    </div>

                    <div class="mb-3">
                        <label for="price_1" class="form-label">Price</label>
                        <input type="number" class="form-control" id="price_1" name="variants[0][price]" placeholder="Enter Price">
                    </div>

                    <div class="mb-3">
                        <label for="special_price_1" class="form-label">Special Price</label>
                        <input type="number" class="form-control" id="special_price_1" name="variants[0][special_price]" placeholder="Enter Special Price">
                    </div>

                    <div class="mb-3">
                        <label for="percentage_off_1" class="form-label">Percentage Off</label>
                        <input type="number" class="form-control" id="percentage_off_1" name="variants[0][percentage_off]" placeholder="Enter Discount Percentage">
                    </div>

                    <div class="mb-3">
                        <label for="color_1" class="form-label">Color</label>
                        <input type="text" class="form-control" id="color_1" name="variants[0][colors][0][color]" placeholder="Enter Color">
                    </div>

                    <div class="mb-3">
                        <label for="stock_1" class="form-label">Stock</label>
                        <input type="number" class="form-control" id="stock_1" name="variants[0][colors][0][stock]" placeholder="Enter Stock Quantity">
                    </div>

                    <!-- Add More Colors -->
                    <button type="button" class="btn btn-outline-secondary" onclick="addColorField(1)">Add More Colors</button>
                </div>
            </div>

            <!-- Add More Variants -->
            <div class="text-center mt-4">
                <button type="button" class="btn btn-outline-primary" onclick="addVariant()">Add Another Variant</button>
            </div>

            <!-- Submit Button -->
            <div class="text-center mt-4">
                <button type="submit" class="btn btn-primary px-4 py-2 rounded-pill shadow-lg">Save Product</button>
            </div>
        </form>
    </div>
</div>

<script>
// Function to add another variant group
let variantCount = 1;

function addVariant() {
    variantCount++;
    let variantHTML = `
        <div class="variant-group" id="variant_${variantCount}">
            <h5>Variant ${variantCount}</h5>
            <div class="mb-3">
                <label for="size_${variantCount}" class="form-label">Size</label>
                <input type="text" class="form-control" id="size_${variantCount}" name="variants[${variantCount - 1}][size]" placeholder="Enter Size">
            </div>

            <div class="mb-3">
                <label for="price_${variantCount}" class="form-label">Price</label>
                <input type="number" class="form-control" id="price_${variantCount}" name="variants[${variantCount - 1}][price]" placeholder="Enter Price">
            </div>

            <div class="mb-3">
                <label for="special_price_${variantCount}" class="form-label">Special Price</label>
                <input type="number" class="form-control" id="special_price_${variantCount}" name="variants[${variantCount - 1}][special_price]" placeholder="Enter Special Price">
            </div>

            <div class="mb-3">
                <label for="percentage_off_${variantCount}" class="form-label">Percentage Off</label>
                <input type="number" class="form-control" id="percentage_off_${variantCount}" name="variants[${variantCount - 1}][percentage_off]" placeholder="Enter Discount Percentage">
            </div>

            <div class="mb-3">
                <label for="color_${variantCount}" class="form-label">Color</label>
                <input type="text" class="form-control" id="color_${variantCount}" name="variants[${variantCount - 1}][colors][0][color]" placeholder="Enter Color">
            </div>

            <div class="mb-3">
                <label for="stock_${variantCount}" class="form-label">Stock</label>
                <input type="number" class="form-control" id="stock_${variantCount}" name="variants[${variantCount - 1}][colors][0][stock]" placeholder="Enter Stock Quantity">
            </div>

            <button type="button" class="btn btn-outline-secondary" onclick="addColorField(${variantCount})">Add More Colors</button>
        </div>
    `;
    document.getElementById('variant_section').insertAdjacentHTML('beforeend', variantHTML);
}

// Function to add a color field within a variant
function addColorField(variantId) {
    let colorCount = document.querySelectorAll(`#variant_${variantId} .mb-3`).length / 2;  // Get number of color inputs for the variant
    let colorHTML = `
        <div class="mb-3">
            <label for="color_${variantId}_${colorCount}" class="form-label">Color ${colorCount + 1}</label>
            <input type="text" class="form-control" id="color_${variantId}_${colorCount}" name="variants[${variantId - 1}][colors][${colorCount}][color]" placeholder="Enter Color">
        </div>
        <div class="mb-3">
            <label for="stock_${variantId}_${colorCount}" class="form-label">Stock ${colorCount + 1}</label>
            <input type="number" class="form-control" id="stock_${variantId}_${colorCount}" name="variants[${variantId - 1}][colors][${colorCount}][stock]" placeholder="Enter Stock Quantity">
        </div>
    `;
    document.querySelector(`#variant_${variantId}`).insertAdjacentHTML('beforeend', colorHTML);
}
</script>

@endsection
