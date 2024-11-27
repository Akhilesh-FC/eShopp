@extends('admin.body.adminmaster')
@section('admin')

<div class="container mt-5">
    <h2 class="mb-4">Ticket system</h2>

    <!-- Notification Form -->
    <form class="form-horizontal form-submit-event" action="{{ route('ticket') }}" method="POST" enctype="multipart/form-data">
        @csrf

  
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
                <th data-field="title" data-sortable="true">Ticket Type</th>
                <th data-field="action">User Name</th>
                <th data-field="action">subject</th>
                <th data-field="action">email</th>
                <th data-field="action">description</th>
                <th data-field="action">Status</th>
                <th data-field="action">Date Created</th>
                <th data-field="action">Action</th>
            </tr>
        </thead>
        <tbody>
            <tr>
                <td>1</td>
                <td>Waiting</td>
                <td>Akhil</td>
                <td>Train</td>
                <td>ak@gmail.com</td>
                <td>We are updating the system, please bear with us.</td>
                <td>Pending</td>
                <td>13 July </td>
                <td><button class="btn btn-danger">Delete</button></td>
            </tr>
            <tr>
                <td>1</td>
                <td>Waiting</td>
                <td>Akhil</td>
                <td>Train</td>
                <td>ak@gmail.com</td>
                <td>We are updating the system, please bear with us.</td>
                <td>Pending</td>
                <td>13 July </td>
                <td><button class="btn btn-danger">Delete</button></td>
            </tr>
            <tr>
                <td>1</td>
                <td>Waiting</td>
                <td>Akhil</td>
                <td>Train</td>
                <td>ak@gmail.com</td>
                <td>We are updating the system, please bear with us.</td>
                <td>Pending</td>
                <td>13 July </td>
                <td><button class="btn btn-danger">Delete</button></td>
            </tr>
        </tbody>
    </table>
</div>

@endsection
