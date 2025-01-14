@extends('admin.body.adminmaster')

@section('admin')
<div class="page-wrapper">
     <div class="container-fluid">
        <h2 class="mb-4">Send Notification</h2>

        <!-- Notification Form -->
        <form class="form-horizontal form-submit-event" action="{{ route('send_notification') }}" method="POST" enctype="multipart/form-data">
            @csrf
            <div class="row mb-3">
                <label class="col-sm-2 col-form-label" for="send_to">Send To:</label>
                <div class="col-sm-10">
                    <select name="send_to" id="send_to" class="form-control" required>
                        <option value="all">All</option>
                        <option value="user">User</option>
                        <option value="admin">Admin</option>
                    </select>
                </div>
            </div>

            <div class="row mb-3">
                <label class="col-sm-2 col-form-label" for="type">Type:</label>
                <div class="col-sm-10">
                    <select name="type" id="type" class="form-control" required>
                        <option value="info">Info</option>
                        <option value="alert">Alert</option>
                        <option value="success">Success</option>
                    </select>
                </div>
            </div>

            <div class="row mb-3">
                <label class="col-sm-2 col-form-label" for="title">Title:</label>
                <div class="col-sm-10">
                    <input type="text" name="title" id="title" class="form-control" required>
                </div>
            </div>

            <div class="row mb-3">
                <label class="col-sm-2 col-form-label" for="message">Message:</label>
                <div class="col-sm-10">
                    <textarea name="message" id="message" rows="4" class="form-control" required></textarea>
                </div>
            </div>

            <div class="row mb-3">
                <label class="col-sm-2 col-form-label" for="link">Link (optional):</label>
                <div class="col-sm-10">
                    <input type="url" name="link" id="link" class="form-control">
                </div>
            </div>

            <div class="text-end">
                <button type="submit" class="btn btn-primary">Send Notification</button>
            </div>
        </form>

        <!-- Notifications Table -->
        <h2 class="mt-5 mb-4">Notifications</h2>
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
                    <th data-field="type" data-sortable="true">Type</th>
                    <th data-field="message">Message</th>
                    <th data-field="send_to">Send To</th>
                    <th data-field="link">Link</th>
                    <th data-field="link">User ID</th>
                    <th data-field="link">Action</th>
                </tr>
            </thead>
            <tbody>
                <tr>
                    <td>1</td>
                    <td>System Update</td>
                    <td>Alert</td>
                    <td>We are updating the system, please bear with us.</td>
                    <td>All</td>
                    <td><a href="https://example.com/update">View Update</a></td>
                    <td>22</td>
                    <td>Delete</td>
                </tr>
                <tr>
                    <td>2</td>
                    <td>Maintenance Alert</td>
                    <td>Info</td>
                    <td>Scheduled maintenance will happen tonight.</td>
                    <td>User</td>
                    <td><a href="https://example.com/maintenance">View Maintenance</a></td>
                    <td>22</td>
                    <td>Delete</td>
                </tr>
                <tr>
                    <td>3</td>
                    <td>New Features</td>
                    <td>Success</td>
                    <td>We have added new features to improve your experience!</td>
                    <td>Admin</td>
                    <td><a href="https://example.com/features">View Features</a></td>
                    <td>22</td>
                    <td>Delete</td>
                </tr>
            </tbody>
        </table>
    </div>

@endsection
