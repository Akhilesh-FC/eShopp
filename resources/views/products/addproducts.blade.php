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

        <!-- Subcategory Dropdown (hidden initially) -->
        <div class="mb-3" id="subcategory_div" style="display: none;">
            <label for="subcategory_id" class="form-label">Subcategory</label>
            <select class="form-select" id="subcategory_id" name="subcategory_id">
                <option value="">Select a Subcategory</option>
                <!-- Subcategories will be populated dynamically -->
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
            <label for="description" class="form-label">Color</label>
            <input type="text" class="form-control" id="product_color" name="product_name" placeholder="Enter product color" required>
        </div>
        
        <div class="mb-3">
            <label for="description" class="form-label">Size</label>
            <input type="text" class="form-control" id="product_size" name="product_name" placeholder="Enter product size" required>
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

            <script>
                // Function to calculate the special price based on price and percentage off
                function calculateSpecialPrice() {
                    var price = parseFloat(document.getElementById('price').value);
                    var percentageOff = parseFloat(document.getElementById('percentage_off').value);
                    
                    if (!isNaN(price) && !isNaN(percentageOff)) {
                        var discount = (percentageOff / 100) * price;
                        var specialPrice = price - discount;
                        document.getElementById('special_price').value = specialPrice.toFixed(2); // Set the special price
                    } else {
                        document.getElementById('special_price').value = ''; // Clear special price if inputs are invalid
                    }
                }
            
                // Event listeners to trigger the calculation when price or percentage off changes
                document.getElementById('price').addEventListener('input', calculateSpecialPrice);
                document.getElementById('percentage_off').addEventListener('input', calculateSpecialPrice);
            </script>


        

        <button type="submit" class="btn btn-primary w-100">Add Product</button>
    </form>
</div>

<script>
    document.getElementById('category_id').addEventListener('change', function() {
        var categoryId = this.value;
        
        if (categoryId) {
            // Make an AJAX request to fetch subcategories based on selected category
            fetch(`/get-subcategories/${categoryId}`)
                .then(response => response.json())
                .then(data => {
                    // Show subcategory dropdown
                    var subcategoryDiv = document.getElementById('subcategory_div');
                    subcategoryDiv.style.display = 'block';
                    
                    // Populate subcategory options
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
            // Hide subcategory dropdown if no category is selected
            document.getElementById('subcategory_div').style.display = 'none';
        }
    });
</script>
@endsection
