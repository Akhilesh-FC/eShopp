@extends('admin.body.adminmaster')
@section('admin')

    <form action="{{ route('transaction') }}" method="get"></form>


  <div class="row mb-2">
                <div class="col-sm-6">
                    <h4> View Transaction </h4>
                </div>
                <div class="col-sm-6">
                    <ol class="breadcrumb float-sm-right">
                        <li class="breadcrumb-item"><a href="#">Home</a></li>
                        <li class="breadcrumb-item active">Transaction</li>
                    </ol>
                </div>
            </div>
    
    </section>
    <section class="content">
        <div class="container-fluid">
            <div class="row">
                <div class="col-md-12 main-content">
                    <div class="card content-area p-4">
                        <div class="card-innr">
                            <div class="gaps-1-5x"></div>
                            <input type='hidden' id='transaction_user_id' value=''>
                            <table class='table table-striped' data-toggle="table" data-url="#" data-click-to-select="true" data-side-pagination="server" data-pagination="true" data-page-list="[5, 10, 20, 50, 100, 200]" data-search="true" data-show-columns="true" data-show-refresh="true" data-trim-on-search="false" data-sort-name="id" data-sort-order="desc" data-mobile-responsive="true" data-toolbar="" data-show-export="true" data-maintain-selected="true" data-query-params="transaction_query_params">
                                <thead>
                                    <tr>
                                        <th data-field="id" data-sortable="true">Id</th>
                                        <th data-field="name" data-sortable="false">User Name</th>
                                        <th data-field="order_id" data-sortable="false">Order Id</th>
                                        <th data-field="txn_id" data-sortable="false">Transaction Id</th>
                                        <th data-field="type" data-sortable="false">Transaction type</th>
                                        <th data-field="payu_txn_id" data-sortable="false" data-visible="false">Pay Transaction Id</th>
                                        <th data-field="amount" data-sortable="false">Amount</th>
                                        <th data-field="status" data-sortable="false">Status</th>
                                        <th data-field="message" data-sortable="false" data-visible="false">Message</th>
                                        <th data-field="txn_date" data-sortable="false">Date</th>
                                        <th data-field="operate" data-sortable="false">Actions</th>
                                    </tr>
                                </thead>
                                <tbody>
        <!-- Static Data Row 1 -->
        <tr>
            <td>1</td>
            <td>John Doe</td>
            <td>ORD12345</td>
            <td>TXN67890</td>
            <td>Credit</td>
            <td>PAYU12345</td>
            <td>500.00</td>
            <td>Success</td>
            <td>Payment Successful</td>
            <td>2024-11-22</td>
            <td>
                <button class="btn btn-primary btn-sm">View</button>
            </td>
        </tr>
        <!-- Static Data Row 2 -->
        <tr>
            <td>2</td>
            <td>Jane Smith</td>
            <td>ORD54321</td>
            <td>TXN09876</td>
            <td>Debit</td>
            <td>PAYU54321</td>
            <td>300.00</td>
            <td>Pending</td>
            <td>Payment Pending</td>
            <td>2024-11-22</td>
            <td>
                <button class="btn btn-primary btn-sm">View</button>
            </td>
        </tr>
    </tbody>
                            </table>
                        </div><!-- .card-innr -->
                    </div><!-- .card -->
                </div>
            </div>
            <!-- /.row -->
        </div><!-- /.container-fluid -->
    </section>


@endsection