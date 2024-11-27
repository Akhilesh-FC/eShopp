@extends('admin.body.adminmaster')
@section('admin')

<div class="container-fluid">
    <form action="{{ route('offers') }}" method="get"></form>

    <div class="content-wrapper">
        <!-- Content Header (Page header) -->
        <section class="content-header">
            <div class="container-fluid">
                <div class="row mb-2">
                    <div class="col-sm-6">
                        <h4>Offers Management</h4>
                    </div>
                    <div class="col-sm-6">
                        <ol class="breadcrumb float-sm-right">
                            <li class="breadcrumb-item"><a href="https://avrluxe.com/admin/home">Home</a></li>
                            <li class="breadcrumb-item active">Offers</li>
                        </ol>
                    </div>
                </div>
            </div>
        </section>

        <!-- Main content -->
        <section class="content">
            <div class="container-fluid">
                <div class="row">
                    <!-- Offers Table -->
                    <div class="col-md-12 main-content">
                        <div class="card content-area p-4">
                            <div class="card-header border-0 d-flex justify-content-between align-items-center">
                                <h5 class="mb-0">Offers List</h5>
                                <!-- Add Offer Button -->
                                <button class="btn btn-outline-primary btn-sm" data-toggle="modal" data-target="#addOfferModal">
                                    Add Offer
                                </button>
                            </div>
                            <div class="card-innr">
                                <div class="gaps-1-5x"></div>
                                <!-- Static Data Table -->
                                <table class="table table-striped">
                                    <thead>
                                        <tr>
                                            <th>ID</th>
                                            <th>Type</th>
                                            <th>Type ID</th>
                                            <th>Image</th>
                                            <th>Link</th>
                                            <th>Created At</th>
                                            <th>Action</th>
                                        </tr>
                                    </thead>
                                    <tbody>
                                        <tr>
                                            <td>1</td>
                                            <td>Discount</td>
                                            <td>101</td>
                                            <td><img src="https://via.placeholder.com/50" alt="Offer Image" /></td>
                                            <td><a href="https://example.com">https://example.com</a></td>
                                            <td>2024-11-18</td>
                                            <td>
                                                <button class="btn btn-sm btn-warning">Edit</button>
                                                <button class="btn btn-sm btn-danger">Delete</button>
                                            </td>
                                        </tr>
                                        <!-- More static data rows as needed -->
                                    </tbody>
                                </table>
                            </div><!-- .card-innr -->
                        </div><!-- .card -->
                    </div>
                </div>
            </div>
        </section>
    </div>
</div>

<!-- Add Offer Modal -->
<div class="modal fade" id="addOfferModal" tabindex="-1" role="dialog" aria-labelledby="addOfferModalLabel" aria-hidden="true">
    <div class="modal-dialog" role="document">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="addOfferModalLabel">Add New Offer</h5>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>
            <div class="modal-body">
                <!-- Form to Add New Offer -->
                <form action="#" method="POST" enctype="multipart/form-data">
                    @csrf
                    <div class="form-group">
                        <label for="offerType">Offer Type</label>
                        <input type="text" class="form-control" id="offerType" name="type" placeholder="Enter offer type" required>
                    </div>
                    <div class="form-group">
                        <label for="typeId">Type ID</label>
                        <input type="number" class="form-control" id="typeId" name="type_id" placeholder="Enter type ID" required>
                    </div>
                    <div class="form-group">
                        <label for="offerImage">Image</label>
                        <input type="file" class="form-control-file" id="offerImage" name="image" required>
                    </div>
                    <div class="form-group">
                        <label for="offerLink">Link</label>
                        <input type="url" class="form-control" id="offerLink" name="link" placeholder="Enter offer link" required>
                    </div>
                    <div class="form-group">
                        <label for="createdAt">Created At</label>
                        <input type="date" class="form-control" id="createdAt" name="date_added" required>
                    </div>
                    <button type="submit" class="btn btn-primary">Save Offer</button>
                </form>
            </div>
        </div>
    </div>
</div>

@endsection
