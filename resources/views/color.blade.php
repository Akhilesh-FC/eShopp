@extends('admin.body.adminmaster')

@section('admin')

@if(session('success'))
    <div class="alert alert-success">
        {{ session('success') }}
    </div>
@endif

<div class="container">
    <button type="button" class="btn btn-primary" data-toggle="modal" data-target="#addColorModal">Add Color</button>

    <form action="{{ route('color.store') }}" method="post" enctype="multipart/form-data">
        @csrf
        <!-- Table to display data -->
        <table class="table table-bordered">
            <thead>
                <tr>
                    <th>ID</th>
                    <th>Name</th>
                    <th>Color</th>
                    <th>Status</th>
                    <th>Action</th>
                </tr>
            </thead>
            <tbody>
                @foreach($colors as $color)
                <tr>
                    <td>{{ $color->id }}</td>
                    <td>{{ $color->name }}</td>
                    <td>{{ $color->color }}</td>
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
                        <button type="button" class="btn btn-warning btn-sm" data-toggle="modal" data-target="#editColorModal" data-id="{{ $color->id }}" data-name="{{ $color->name }}" data-color="{{ $color->color }}">Edit</button>
                    </td>
                </tr>
                @endforeach
            </tbody>
        </table>
        
        <!-- Modal for adding a new color -->
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
                            
                            <button type="submit" class="btn btn-primary">Save Color</button>
                        </form>
                    </div>
                </div>
            </div>
        </div>
        
        <!-- Modal for editing a color -->
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
                        <form action="" method="POST" id="editColorForm">
                            @csrf
                            <div class="form-group">
                                <label for="color">Color</label>
                                <input type="color" class="form-control" id="color" name="color" required>
                            </div>
                            <div class="form-group">
                                <label for="name">Color Name</label>
                                <input type="text" class="form-control" id="name" name="name" required>
                            </div>
                            
                            <button type="submit" class="btn btn-primary">Save Changes</button>
                        </form>
                    </div>
                </div>
            </div>
        </div>
    </form>
</div>

@endsection

<script>
    $('#editColorModal').on('show.bs.modal', function (event) {
        var button = $(event.relatedTarget); // Button that triggered the modal
        var id = button.data('id'); // Extract info from data-* attributes
        var name = button.data('name');
        var color = button.data('color');

        var modal = $(this);
        modal.find('#name').val(name);
        modal.find('#color').val(color);

        // Set the form action URL dynamically
        modal.find('#editColorForm').attr('action', '{{ route('color.update', ['id' => '__ID__']) }}'.replace('__ID__', id));
    });
</script>
