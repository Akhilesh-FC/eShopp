@extends('admin.body.adminmaster')

@section('admin')
<div class="page-wrapper">
     <div class="container-fluid">


<!---->

<div class="container-fluid">
    <form action="{{ route('orders') }}" method="get">
    <div class="row mt-4">
        <div class="col-12">
            <div class="d-flex align-items-center">
                    <input type="text" name="search" value="{{ request('search') }}" 
                        class="form-control mr-2" 
                        placeholder="Search by Order ID, Transaction ID, or Payment Method"
                        style="font-size: 18px; width: 400px;">
                    <button type="submit" class="btn btn-primary">Search</button>
                </div>
        </div>
    </div>
</form>


    <div class="row mt-4">
        <div class="col-12">
            <div class="card p-4">
                <div class="tab-content">
                    <div id="orders_table" class="tab-pane active">
                        <div class="table-responsive">
                            <table class="table table-bordered table-hover" data-toggle="table" data-pagination="true" data-search="true">
                                <thead class="thead-dark">
                                    <tr>
                                        <th data-field="id" data-sortable="true">Order ID</th>
                                        <th data-field="transaction_id" data-sortable="true">Transaction ID</th>
                                        <th data-field="total" data-sortable="true">Total (₹)</th>
                                        <th data-field="promo_discount" data-sortable="true">Promo Discount (₹)</th>
                                        <th data-field="final_total" data-sortable="true">Final Total (₹)</th>
                                        <th data-field="payment_method" data-sortable="true">Payment Method</th>
                                        <th data-field="date_added" data-sortable="true">Order Date</th>
                                        <th data-field="operate">Action</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    @foreach($orders as $order)
                                        <tr>
                                            <td>{{ $order->order_id }}</td>
                                            <td>{{ $order->transaction_id }}</td>
                                            <td>₹{{ $order->final_total }}</td>
                                            <td>₹{{ $order->promo_discount }}</td>
                                            <td>₹{{ $order->final_total }}</td>
                                            <td>{{ $order->payment_method }}</td>
                                            <td>{{ $order->created_at }}</td>
                                            <td>
                                                <a href="{{ route('view_orderdetails', ['orderId' => $order->id]) }}" class="btn btn-warning btn-sm">View</a>
                                            </td>
                                        </tr>
                                    @endforeach
                                </tbody>
                            </table>
                        </div>
                    </div>
                </div>

                <!-- Pagination Info -->
                <div class="row mt-3">
                    <div class="col-md-6">
                        <p>Showing {{ $orders->firstItem() }} to {{ $orders->lastItem() }} of {{ $orders->total() }} rows</p>
                    </div>
                    <div class="col-md-6 text-right">
                        <!-- "Rows per page" dropdown -->
                        <form action="{{ route('orders') }}" method="GET" class="d-inline-block">
                            <label for="per_page" class="mr-2">Rows per page:</label>
                            <select name="per_page" id="per_page" class="form-control d-inline-block w-auto" onchange="this.form.submit()">
                                <option value="5" {{ request('per_page') == 5 ? 'selected' : '' }}>5</option>
                                <option value="10" {{ request('per_page') == 10 ? 'selected' : '' }}>10</option>
                                <option value="15" {{ request('per_page') == 15 ? 'selected' : '' }}>15</option>
                                <option value="20" {{ request('per_page') == 20 ? 'selected' : '' }}>20</option>
                            </select>
                        </form>
                    </div>
                </div>

                <!-- Pagination Links -->
                <div class="d-flex justify-content-center">
                    {{ $orders->appends(['per_page' => request('per_page'), 'search' => request('search')])->links('pagination::bootstrap-4') }}
                </div>

            </div>
        </div>
    </div>
</div>

<style>
    .table th, .table td {
        text-align: center;
        vertical-align: middle;
    }

    .table img {
        max-width: 100%;
        height: auto;
    }

    .btn {
        margin: 0 5px;
    }
</style>


@endsection
