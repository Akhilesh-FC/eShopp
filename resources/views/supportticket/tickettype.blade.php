@extends('admin.body.adminmaster')
@section('admin')

<div class="container mt-5">
    <h2 class="mb-4">Manage Ticket Type</h2>

    <!-- Notification Form -->
    <form class="form-horizontal form-submit-event" action="{{ route('ticket_type') }}" method="POST" enctype="multipart/form-data">
        @csrf


    <!-- Ticket Type Button -->
    <div class="text-end mt-4">
        <a href="#" class="btn btn-success">Add Ticket Type</a>
    </div>

  
    <table class="table table-striped"
           data-toggle="table"
           data-url="#"
           data-pagination="true"
           data-search="true"
           data-side-pagination="server"
           data-show-columns="true"
           data-show-refresh="true"
           data-sort-name="id"
           data-sort-order="desc">
        <thead>
            <tr>
                <th data-field="id" data-sortable="true">ID</th>
                <th data-field="title" data-sortable="true">Title</th>
                <th data-field="action">Action</th>
            </tr>
        </thead>
        <tbody>
            <tr>
                <td>1</td>
                <td>We are updating the system, please bear with us.</td>
                <td><button class="btn btn-danger">Delete</button></td>
            </tr>
            <tr>
                <td>2</td>
                <td>Maintenance Alert</td>
                <td><button class="btn btn-danger">Delete</button></td>
            </tr>
            <tr>
                <td>3</td>
                <td>New Features</td>
                <td><button class="btn btn-danger">Delete</button></td>
            </tr>
        </tbody>
    </table>
</div>

@endsection
