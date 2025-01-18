@extends('admin.body.adminmaster')

@section('admin')
<div class="page-wrapper">
    <div class="container-fluid">

        @if(session('success'))
        <div class="alert alert-success alert-dismissible fade show" role="alert">
            {{ session('success') }}
            <button type="button" class="close" data-dismiss="alert" aria-label="Close">
                <span aria-hidden="true">&times;</span>
            </button>
        </div>
        @endif

        @if(session('error'))
        <div class="alert alert-danger alert-dismissible fade show" role="alert">
            {{ session('error') }}
            <button type="button" class="close" data-dismiss="alert" aria-label="Close">
                <span aria-hidden="true">&times;</span>
            </button>
        </div>
        @endif

        <div class="container">
            <div class="row">
                <div class="col-md-6">
                    <!-- Search Form -->
                    <form action="{{ route('color') }}" method="GET" class="form-inline">
                        <input type="text" name="search" value="{{ request('search') }}" class="form-control mr-2" placeholder="Search colors..." style="border-radius: 20px; padding: 8px;">
                        <button type="submit" class="btn btn-primary" style="border-radius: 20px; padding: 8px;">Search</button>
                    </form>
                </div>

                <!-- Add Color Button -->
                <div class="col-md-6 text-right">
                    <button type="button" class="btn btn-success" data-toggle="modal" data-target="#addColorModal" style="border-radius: 20px; padding: 8px; font-weight: bold;">
                        Add Color
                    </button>
                </div>
            </div>

            <!-- Color List Table -->
            <table class="table table-bordered mt-4" style="border-radius: 10px; box-shadow: 0 4px 8px rgba(0, 0, 0, 0.1);">
                <thead class="thead-light">
                    <tr>
                        <th>ID</th>
                        <th>Name</th>
                        <th>Color</th>
                        <th>Status</th>
                        <th>Actions</th>
                    </tr>
                </thead>
                <tbody>
                    @foreach($colors as $color)
                    <tr>
                        <td>{{ $color->id }}</td>
                        <td>{{ $color->name }}</td>
                        <td>
                            <span style="background-color: {{ $color->color }}; color: {{ $color->color }}; font-size: 20px; padding: 5px; border-radius: 50%;">
                                &#x25A0;
                            </span>
                        </td>
                        <td class="text-center">
                            @if($color->status == 0)
                            <a href="{{ route('colorstatus.activate', $color->id) }}">
                                <i class="fa-solid fa-toggle-on fa-2xl" style="color: green;"></i>
                            </a>
                            @elseif($color->status == 1)
                            <a href="{{ route('colorstatus.inactive', $color->id) }}">
                                <i class="fa-solid fa-toggle-on fa-2xl" style="color: red;"></i>
                            </a>
                            @else
                            <span>N/A</span>
                            @endif
                        </td>
                        <td>
                            <!-- Edit Color Button -->
                            <button type="button" class="btn btn-warning btn-sm" data-toggle="modal" data-target="#editColorModal" data-id="{{ $color->id }}" data-name="{{ $color->name }}" data-color="{{ $color->color }}" style="border-radius: 20px; font-weight: bold;">
                                Edit
                            </button>
                        </td>
                    </tr>
                    @endforeach
                </tbody>
            </table>

            <!-- Add Color Modal -->
            <div class="modal fade" id="addColorModal" tabindex="-1" role="dialog" aria-labelledby="addColorModalLabel" aria-hidden="true">
                <div class="modal-dialog" role="document">
                    <div class="modal-content">
                        <div class="modal-header">
                            <h5 class="modal-title" id="addColorModalLabel">Add New Color</h5>
                            <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                                <span aria-hidden="true">&times;</span>
                            </button>
                        </div>
                        <div class="modal-body">
                            <!-- Form for Adding Color -->
                            <form action="{{ route('color.store') }}" method="POST">
                                @csrf
                                <div class="form-group">
                                    <label for="color">Color</label>
                                    <input type="color" class="form-control" id="color" name="color" required>
                                </div>
                                <div class="form-group">
                                    <label for="name">Color Name</label>
                                    <input type="text" class="form-control" id="name" name="name" required>
                                </div>
                                <button type="submit" class="btn btn-primary btn-block" style="border-radius: 20px; font-weight: bold;">Save Color</button>
                            </form>
                        </div>
                    </div>
                </div>
            </div>

            <!-- Edit Color Modal -->
            <div class="modal fade" id="editColorModal" tabindex="-1" role="dialog" aria-labelledby="editColorModalLabel" aria-hidden="true">
                <div class="modal-dialog" role="document">
                    <div class="modal-content">
                        <div class="modal-header">
                            <h5 class="modal-title" id="editColorModalLabel">Edit Color</h5>
                            <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                                <span aria-hidden="true">&times;</span>
                            </button>
                        </div>
                        <div class="modal-body">
                            <!-- Hidden Input for the ID -->
                            <input type="hidden" id="editColorId" name="id">

                            <form id="editColorForm" method="POST" action="">
                                @csrf
                                @method('POST')

                                <div class="form-group">
                                    <label for="editColor">Color</label>
                                    <input type="color" class="form-control" id="editColor" name="color" required>
                                </div>
                                <div class="form-group">
                                    <label for="editName">Color Name</label>
                                    <input type="text" class="form-control" id="editName" name="name" required>
                                </div>

                                <button type="submit" class="btn btn-warning btn-block" style="border-radius: 20px; font-weight: bold;">Save Changes</button>
                            </form>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>

@endsection

@section('scripts')
<script>
    function openEditColorModal(id) {
        // Make an AJAX call to get the color details by id
        $.ajax({
            url: '/color/' + id + '/edit',  // Assuming the edit route is '/color/{id}/edit'
            method: 'GET',
            success: function(response) {
                // Populate the modal fields with the response data
                $('#editColorId').val(response.id);
                $('#editColor').val(response.color);
                $('#editName').val(response.name);

                // Set the form action dynamically
                $('#editColorForm').attr('action', '/color/' + response.id + '/update');

                // Show the modal
                $('#editColorModal').modal('show');
            }
        });
    }
</script>
@endsection
