@extends('admin.body.adminmaster')

@section('admin')
<div class="container mt-4">
    <div class="row">
        <div class="col-12">
            <a href="{{ route('orders') }}" class="btn btn-primary btn-sm position-absolute" style="top: 20px; right: 20px;">Back to Orders</a>
            <h3 class="mb-4">Order Details</h3>

            <!-- Order Info Card -->
            <div class="card">
                <div class="card-header bg-primary text-white">
                    <h5>Order Information</h5>
                </div>
                <div class="card-body">
                    <div class="row">
                        <div class="col-md-6">
                            <p><strong>User Name:</strong></p>
                            <p><strong>Order ID:</strong> #{{ $order->order_id }}</p>
                            <p><strong>Transaction ID:</strong> {{ $order->transaction_id }}</p>
                            <p><strong>Total:</strong> ₹{{ $order->final_total }}</p>
                        </div>
                        <div class="col-md-6">
                            <p><strong>Promo Discount:</strong> %{{ $order->promo_discount }}</p>
                            <p><strong>Final Payment:</strong> ₹{{ $order->final_total }}</p>
                            <p><strong>Payment Method:</strong> {{ $order->payment_method }}</p>
                            <p><strong>Order Date:</strong> {{ $order->created_at }}</p>
                        </div>
                    </div>
                </div>
            </div>

            <!-- Product Information and Actions -->
            <div class="row mt-4">
                <div class="col-md-6">
                    <div class="card">
                        <div class="card-header bg-success text-white">
                            <h5>Product Information</h5>
                        </div>
                        <div class="card-body text-center">
                            @foreach ($products as $product) <!-- Loop through products -->
                                <img src="{{ asset('storage/'.$product->image) }}" alt="Product Image" class="img-fluid" style="max-width: 200px; max-height: 200px;">
                                <p class="mt-3"><strong>Product ID:</strong> {{ $product->id }}</p>
                                <p><strong>Product Name:</strong> {{ $product->name }}</p>
                            @endforeach
                        </div>
                    </div>
                </div>

                <!-- Action Buttons & Status Card -->
                <div class="col-md-6">
                    <div class="card">
                        <div class="card-header bg-info text-white">
                            <h5>Actions & Status</h5>
                        </div>
                        <div class="card-body">
                            <!-- Action Buttons -->
                            <a href="{{ route('view_orderdetails', ['orderId' => $order->order_id]) }}" class="btn btn-warning btn-block mb-3">View</a>
                            <button class="btn btn-danger btn-block mb-3">Delete</button>
                            
                            <!-- Status Dropdown -->
                            <div class="form-group">
                                <label for="orderStatus">Order Status</label>
                                <select id="orderStatus" class="form-select">
                                    <option value="pending" {{ $order->status == 'pending' ? 'selected' : '' }}>Pending</option>
                                    <option value="completed" {{ $order->status == 'completed' ? 'selected' : '' }}>Completed</option>
                                    <option value="shipped" {{ $order->status == 'shipped' ? 'selected' : '' }}>Shipped</option>
                                    <option value="cancelled" {{ $order->status == 'cancelled' ? 'selected' : '' }}>Cancelled</option>
                                </select>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>

<style>
    .card {
    border-radius: 8px;
    box-shadow: 0 4px 8px rgba(0, 0, 0, 0.1);
}

.card-header {
    font-weight: bold;
}

.btn-block {
    width: 100%;
}

.card-body img {
    border-radius: 8px;
}

.select-status {
    border: 1px solid #ccc;
}
.btn-primary:hover {
    background-color: #0056b3;  /* Darker blue for hover effect */
    color: white;
}


</style>

@endsection
