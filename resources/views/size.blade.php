@extends('admin.body.adminmaster')

@section('admin')

@if(session('success'))
    <div class="alert alert-success alert-dismissible fade show" role="alert">
        {{ session('success') }}
        <button type="button" class="close" data-dismiss="alert" aria-label="Close">
            <span aria-hidden="true">&times;</span>
        </button>
    </div>
@endif

<div class="container">
    <div class="row mb-4">
        <!-- Search Form -->
        <div class="col-md-6">
            <form action="{{ route('size') }}" method="GET" class="form-inline">
                <input type="text" name="search" value="{{ request('search') }}" class="form-control mr-2" placeholder="Search size...">
                <button type="submit" class="btn btn-primary">Search</button>
            </form>
        </div>
        <!-- Add Size Button -->
        <div class="col-md-6 text-right">
            <button type="button" class="btn btn-success" data-toggle="modal" data-target="#addSizeModal">Add Size</button>
        </div>
    </div>

    <!-- Table to display data -->
    <table class="table table-bordered table-striped">
        <thead class="thead-dark">
            <tr>
                <th>ID</th>
                <th>Size</th>
                <th>Status</th>
                <th>Action</th>
            </tr>
        </thead>
        <tbody>
            @foreach($sizes as $size)
            <tr>
                <td>{{ $size->id }}</td>
                <td>{{ $size->size }}</td>
                <td class="text-center">
                    @if($size->status == 0)
                        <a href="{{ route('sizestatus.activate', $size->id) }}" class="text-success" data-toggle="tooltip" data-placement="top" title="Activate">
                            <i class="fa-solid fa-toggle-off fa-2xl"></i>
                        </a>
                    @elseif($size->status == 1)
                        <a href="{{ route('sizestatus.inactive', $size->id) }}" class="text-danger" data-toggle="tooltip" data-placement="top" title="Deactivate">
                            <i class="fa-solid fa-toggle-on fa-2xl"></i>
                        </a>
                    @else
                        <span class="text-muted">N/A</span>
                    @endif
                </td>
                <td>
                    <!-- Edit Button: Modal Trigger -->
                    <button class="btn btn-warning btn-sm text-white" data-toggle="modal" data-target="#editSizeModal{{$size->id}}">
                        <i class="fas fa-edit"></i> Edit
                    </button>
                </td>
            </tr>
            @endforeach
        </tbody>
    </table>

    <!-- Add New Size Modal -->
    <div class="modal fade" id="addSizeModal" tabindex="-1" role="dialog" aria-labelledby="addSizeModalLabel" aria-hidden="true">
        <div class="modal-dialog" role="document">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="addSizeModalLabel">Add New Size</h5>
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                    </button>
                </div>
                <div class="modal-body">
                    <!-- Form for submitting new size -->
                    <form action="{{ route('size.store') }}" method="POST" enctype="multipart/form-data">
                        @csrf
                        <div class="form-group">
                            <label for="size">Size</label>
                            <input type="text" class="form-control" id="size" name="size" required>
                            @if($errors->has('size'))
                                <span class="text-danger">{{ $errors->first('size') }}</span>
                            @endif
                        </div>
                        <button type="submit" class="btn btn-primary btn-block">Save Size</button>
                    </form>
                </div>
            </div>
        </div>
    </div>

    <!-- Edit Size Modal (For Each Size) -->
    @foreach($sizes as $size)
    <div class="modal fade" id="editSizeModal{{$size->id}}" tabindex="-1" role="dialog" aria-labelledby="editSizeModalLabel{{$size->id}}" aria-hidden="true">
        <div class="modal-dialog modal-dialog-centered" role="document">
            <div class="modal-content">
                <div class="modal-header bg-primary text-white">
                    <h5 class="modal-title" id="editSizeModalLabel{{$size->id}}">Edit Size</h5>
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                    </button>
                </div>
                <form action="{{ route('size.update', $size->id) }}" method="post" enctype="multipart/form-data">
                    @csrf
                    <div class="modal-body">
                        <div class="form-group">
                            <label for="size">Size</label>
                            <input type="text" class="form-control" name="size" value="{{ $size->size }}" id="size" placeholder="Enter new size">
                            @error('size')
                                <div class="alert alert-danger">{{ $message }}</div>
                            @enderror
                        </div>
                    </div>
                    <div class="modal-footer">
                        <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
                        <button type="submit" class="btn btn-warning">Update</button>
                    </div>
                </form>
            </div>
        </div>
    </div>
    @endforeach
</div>

@endsection

@section('scripts')
<script>
    $(function () {
        // Enable tooltips
        $('[data-toggle="tooltip"]').tooltip();
    });
</script>
@endsection
