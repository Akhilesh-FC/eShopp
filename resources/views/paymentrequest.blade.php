@extends('admin.body.adminmaster')
@section('admin')

<div class="container-fluid">
    <div class="col-md-12 main-content">
        <div class="card content-area p-4">
            <div class="card-innr">
                <!-- Filter Section -->
                <div class="row">
                    
                    <div class="row mb-3">
    <!-- Filter By User Dropdown -->
    <div class="col-md-3">
        <label for="user_filter" class="col-form-label">Filter By User</label>
        <select class="form-control" name="user_filter" id="user_filter">
            <option value="">Select User Type</option>
            <option value="customer">Customer</option>
            <option value="seller">Seller</option>
            <option value="delivery_boy">Delivery Boy</option>
        </select>
    </div>

    <!-- Action Buttons and Search -->
    <div class="col-md-9 d-flex justify-content-end align-items-end">
        <input type="text" class="form-control w-25" placeholder="Search">
        <button class="btn btn-light ml-2" title="Refresh">
            <i class="fa fa-refresh"></i>
        </button>
        <button class="btn btn-light ml-2" title="Download">
            <i class="fa fa-download"></i>
        </button>
        <button class="btn btn-light ml-2" title="More Options">
            <i class="fa fa-bars"></i>
        </button>
    </div>
</div>


                <div class="gaps-1-5x"></div>
                
                
                <!-- Static Data Table -->
                <table class='table table-striped' id='payment_request_table'>
                    <thead>
                        <tr>
                            <th>ID</th>
                            <th>Username</th>
                            <th>Type</th>
                            <th>Payment Address</th>
                            <th>Amount Requested</th>
                            <th>Remarks</th>
                            <th>Status</th>
                            <th>Date Created</th>
                            <th>Actions</th>
                        </tr>
                    </thead>
                    <tbody>
                        <tr>
                            <td>1</td>
                            <td>John Doe</td>
                            <td>Credit Card</td>
                            <td>1234-5678-9012</td>
                            <td>$500</td>
                            <td>Urgent</td>
                            <td>Pending</td>
                            <td>2024-11-20</td>
                            <td>
                                <button class="btn btn-sm btn-primary">Approve</button>
                                <button class="btn btn-sm btn-danger">Reject</button>
                            </td>
                        </tr>
                        <tr>
                            <td>2</td>
                            <td>Jane Smith</td>
                            <td>PayPal</td>
                            <td>janesmith@email.com</td>
                            <td>$200</td>
                            <td>None</td>
                            <td>Approved</td>
                            <td>2024-11-19</td>
                            <td>
                                <button class="btn btn-sm btn-primary">Approve</button>
                                <button class="btn btn-sm btn-danger">Reject</button>
                            </td>
                        </tr>
                        <tr>
                            <td>3</td>
                            <td>Bob Johnson</td>
                            <td>Bank Transfer</td>
                            <td>9876-5432-1011</td>
                            <td>$1000</td>
                            <td>Follow-up Required</td>
                            <td>Rejected</td>
                            <td>2024-11-18</td>
                            <td>
                                <button class="btn btn-sm btn-primary">Approve</button>
                                <button class="btn btn-sm btn-danger">Reject</button>
                            </td>
                        </tr>
                    </tbody>
                </table>
            </div><!-- .card-innr -->
        </div><!-- .card -->
    </div>
</div>

@endsection
