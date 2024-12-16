@extends('admin.body.adminmaster')
@section('admin')

<div class="container-fluid">
  <form action="{{ route('wallet_transaction') }}" method="get"></form>
  <section class="content-header">
    <div class="container-fluid">
      <div class="row mb-2">
        <div class="col-sm-6">
          <h4>Seller Wallet Transactions</h4>
        </div>
        <div class="col-sm-6">
          <ol class="breadcrumb float-sm-right">
            <li class="breadcrumb-item"><a href="#">Home</a></li>
            <li class="breadcrumb-item active">Seller Wallet</li>
          </ol>
        </div>
      </div>
    </div><!-- /.container-fluid -->
  </section>

  <section class="content">
    <div class="container-fluid">
      <div class="row">
        <div class="col-md-12 main-content">
          <div class="card content-area p-4">
            <div class="card-innr">
              <div class="gaps-1-5x"></div>
              <table class="table table-striped" id="wallet_transaction_table">
                <thead>
                  <tr>
                    <th>ID</th>
                    <th>User Name</th>
                    <th>Type</th>
                    <th>Amount</th>
                    <th>Status</th>
                    <th>Message</th>
                    <th>Date</th>
                  </tr>
                </thead>
                <tbody>
                  <tr>
                    <td>1</td>
                    <td>John Doe</td>
                    <td>Credit</td>
                    <td>$100.00</td>
                    <td>Completed</td>
                    <td>Transaction successful</td>
                    <td>2024-11-20</td>
                  </tr>
                  <tr>
                    <td>2</td>
                    <td>Jane Smith</td>
                    <td>Debit</td>
                    <td>$50.00</td>
                    <td>Pending</td>
                    <td>Awaiting confirmation</td>
                    <td>2024-11-19</td>
                  </tr>
                  <tr>
                    <td>3</td>
                    <td>Michael Brown</td>
                    <td>Credit</td>
                    <td>$200.00</td>
                    <td>Failed</td>
                    <td>Insufficient funds</td>
                    <td>2024-11-18</td>
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
</div>
@endsection
