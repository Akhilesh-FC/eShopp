@extends('admin.body.adminmaster')

@section('admin')
<div class="page-wrapper">
    <div class="container-fluid">
        <div class="row mb-4">
            <div class="col-12">
                <a href="{{ route('promo_code') }}" class="btn btn-primary">
                    <i class="fas fa-arrow-left"></i> Back to Promo Code Section
                </a>
            </div>
        </div>

        <div class="card shadow-lg border-0">
            <div class="card-header bg-info text-white">
                <h4 class="mb-0">Update Promo Code</h4>
            </div>
            <div class="card-body">
                <form action="{{ route('promo_code.update', $promo->id) }}" method="POST" enctype="multipart/form-data">
                    @csrf
                    @method('POST')

                    <div class="form-group">
                        <label for="promo_code" class="font-weight-bold">Promo Code</label>
                        <input type="text" name="promo_code" class="form-control" value="{{ old('promo_code', $promo->promo_code) }}" placeholder="Enter promo code" required>
                    </div>

                    <div class="form-group">
                        <label for="promo_code_name" class="font-weight-bold">Promo Code Name</label>
                        <input type="text" name="promo_code_name" class="form-control" value="{{ old('promo_code_name', $promo->promo_code_name) }}" placeholder="Enter promo code name" required>
                    </div>

                    <div class="form-group">
                        <label for="image" class="font-weight-bold">Image</label>
                        <input type="file" name="image" class="form-control-file">
                        <!-- Display current image if it exists -->
                        @if($promo->image)
                            <div class="mt-2">
                                <img src="{{ asset('storage/'.$promo->image) }}" alt="Current Image" width="100">
                            </div>
                        @endif
                    </div>

                    <div class="form-group">
                        <label for="message" class="font-weight-bold">Message</label>
                        <textarea name="message" class="form-control" rows="3" placeholder="Enter promo message">{{ old('message', $promo->message) }}</textarea>
                    </div>

                    <div class="form-group row">
                        <div class="col-md-6">
                            <label for="start_date" class="font-weight-bold">Start Date</label>
                            <input type="date" name="start_date" class="form-control" value="{{ old('start_date', $promo->start_date) }}" required>
                        </div>
                        <div class="col-md-6">
                            <label for="end_date" class="font-weight-bold">End Date</label>
                            <input type="date" name="end_date" class="form-control" value="{{ old('end_date', $promo->end_date) }}" required>
                        </div>
                    </div>

                    <div class="form-group">
                        <label for="minimum_order_amount" class="font-weight-bold">Minimum Order Amount</label>
                        <input type="number" name="minimum_order_amount" class="form-control" value="{{ old('minimum_order_amount', $promo->minimum_order_amount) }}" placeholder="Enter minimum order amount">
                    </div>

                    <div class="form-group">
                        <label for="discount" class="font-weight-bold">Discount</label>
                        <input type="number" name="discount" class="form-control" value="{{ old('discount', $promo->discount) }}" placeholder="Enter discount amount" required>
                    </div>

                    <div class="form-group">
                        <label for="discount_type" class="font-weight-bold">Discount Type</label>
                        <select name="discount_type" class="form-control" required>
                            <option value="percentage" {{ old('discount_type', $promo->discount_type) == 'percentage' ? 'selected' : '' }}>Percentage</option>
                            <option value="flat" {{ old('discount_type', $promo->discount_type) == 'flat' ? 'selected' : '' }}>Flat</option>
                        </select>
                    </div>

                    <div class="form-group">
                        <label for="max_discount_amount" class="font-weight-bold">Max Discount Amount</label>
                        <input type="number" name="max_discount_amount" class="form-control" value="{{ old('max_discount_amount', $promo->max_discount_amount) }}" placeholder="Enter max discount amount">
                    </div>

                    <button type="submit" class="btn btn-success btn-lg mt-3">Update Promo Code</button>
                </form>
            </div>
        </div>
    </div>
</div>
@endsection
