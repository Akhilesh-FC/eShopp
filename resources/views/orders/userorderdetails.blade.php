@extends('admin.body.adminmaster')

@section('admin')
<div class="page-wrapper">
     <div class="container-fluid">
<div class="container mt-4">
    <div class="row">
        <div class="col-12">
            <a href="{{ route('orders') }}" class="btn btn-primary btn-sm position-absolute" style="top: 20px; right: 20px;"> <i class="fas fa-arrow-left"></i>Back to Orders</a>
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
                                <form action="{{ route('update_orderstatus', ['orderId' => $order->order_id]) }}" method="POST">
                                    @csrf
                                    @method('POST')
                                    <select id="orderStatus" class="form-select" name="status" onchange="this.form.submit()">
                                        <option value="0" {{ $order->status == 0 ? 'selected' : '' }}>Order Placed</option>
                                        <option value="1" {{ $order->status == 1 ? 'selected' : '' }}>Shipped</option>
                                        <option value="2" {{ $order->status == 2 ? 'selected' : '' }}>Out For Delivery</option>
                                        <option value="3" {{ $order->status == 3 ? 'selected' : '' }}>Delivered</option>
                                    </select>
                                </form>
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
