@extends('admin.body.adminmaster')

@section('admin')
<div class="page-wrapper">
    <div class="container-fluid">
        
        <h2>Add Promo Code</h2>

        <!-- Display success or error messages if any -->
        @if(session('success'))
            <div class="alert alert-success">{{ session('success') }}</div>
        @elseif(session('error'))
            <div class="alert alert-danger">{{ session('error') }}</div>
        @endif

        <form action="{{ route('add_promo_code_store') }}" method="POST" enctype="multipart/form-data">
    @csrf
    @method('POST')
            
            <div class="row">
                <!-- Promo Code -->
                <div class="col-md-6 mb-3">
                    <label for="promo_code">Promo Code</label>
                    <input type="text" class="form-control" id="promo_code" name="promo_code" required>
                </div>

                <!-- Promo Code Name -->
                <div class="col-md-6 mb-3">
                    <label for="promo_code_name">Promo Code Name</label>
                    <input type="text" class="form-control" id="promo_code_name" name="promo_code_name" required>
                </div>
            </div>

            <div class="row">
                <!-- Image -->
                <div class="col-md-6 mb-3">
                    <label for="image">Image</label>
                    <input type="file" class="form-control" id="image" name="image" accept="image/*">
                </div>

                <!-- Message -->
                <div class="col-md-6 mb-3">
                    <label for="message">Message</label>
                    <textarea class="form-control" id="message" name="message" rows="4"></textarea>
                </div>
            </div>

            <div class="row">
                <!-- Start Date -->
                <div class="col-md-6 mb-3">
                    <label for="start_date">Start Date</label>
                    <input type="date" class="form-control" id="start_date" name="start_date" required>
                </div>

                <!-- End Date -->
                <div class="col-md-6 mb-3">
                    <label for="end_date">End Date</label>
                    <input type="date" class="form-control" id="end_date" name="end_date" required>
                </div>
            </div>

            <div class="row">
                <!-- Discount -->
                <div class="col-md-6 mb-3">
                    <label for="discount">Discount</label>
                    <input type="number" class="form-control" id="discount" name="discount" required>
                </div>

                <!-- Discount Type -->
                <div class="col-md-6 mb-3">
                    <label for="discount_type">Discount Type</label>
                    <select class="form-control" id="discount_type" name="discount_type" required>
                        <option value="percentage">Percentage</option>
                        <option value="flat">Flat Amount</option>
                    </select>
                </div>
            </div>

            <div class="row">
                <!-- Minimum Discount Amount -->
                <div class="col-md-6 mb-3">
                    <label for="min_discount_amount">Minimum Discount Amount</label>
                    <input type="number" class="form-control" id="min_discount_amount" name="min_discount_amount" step="0.01" required>
                </div>

                <!-- Minimum Order Amount -->
                <div class="col-md-6 mb-3">
                    <label for="min_order_amount">Minimum Order Amount</label>
                    <input type="number" class="form-control" id="min_order_amount" name="min_order_amount" step="0.01" required>
                </div>
            </div>

            <!-- Submit Button -->
            <div class="form-group">
                <button type="submit" class="btn btn-primary">Add Promo Code</button>
            </div>
        </form>
    </div>
</div>
@endsection
