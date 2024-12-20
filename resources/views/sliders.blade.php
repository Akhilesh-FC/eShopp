@extends('admin.body.adminmaster')
@section('admin')

<form action="{{ route('sliders') }}" method="get"></form>

<div class="container-fluid">
    <!-- Page Header -->
    <section class="content-header">
        <div class="container-fluid">
            <div class="row mb-2">
                <div class="col-sm-6">
                    <h4>Slider Image for Add-on Offers and Other Benefits</h4>
                </div>
                <div class="col-sm-6">
                    <ol class="breadcrumb float-sm-right">
                        <li class="breadcrumb-item"><a href="https://free2kart.tirangawin.club/dashboard">Home</a></li>
                        <li class="breadcrumb-item active">Slider</li>
                    </ol>
                </div>
            </div>
        </div>
    </section>

    <!-- Main Content -->
    <section class="content">
        <div class="container-fluid">
            <div class="row">
                <!-- Slider Table -->
                <div class="col-md-12 main-content">
                    <div class="card content-area p-4">
                        <div class="card-header border-0 d-flex justify-content-between">
                            <h5 class="mb-0">Slider List</h5>
                            <!-- Add Slider Button to Open Modal -->
                            <a href="#" class="btn btn-outline-primary btn-sm" data-toggle="modal" data-target="#addSliderModal">
                                Add Slider
                            </a>
                        </div>
                        <div class="card-innr">
                            <div class="gaps-1-5x"></div>
                            <table class="table table-striped" id="slider-table"
                                   data-toggle="table"
                                   data-url="https://avrluxe.com/admin/slider/view_slider"
                                   data-click-to-select="true"
                                   data-side-pagination="server"
                                   data-pagination="true"
                                   data-page-list="[5, 10, 20, 50, 100, 200]"
                                   data-search="true"
                                   data-show-columns="true"
                                   data-show-refresh="true"
                                   data-trim-on-search="false"
                                   data-sort-name="id"
                                   data-sort-order="asc"
                                   data-mobile-responsive="true"
                                   data-show-export="true"
                                   data-maintain-selected="true"
                                   data-query-params="queryParams">
                                <thead>
                                    <tr>
                                        <th data-field="id" data-sortable="true" data-align="center">ID</th>
                                        <th data-field="type" data-sortable="false" data-align="center">Type</th>
                                        <th data-field="type_id" data-sortable="true" data-align="center">Type ID</th>
                                        <th data-field="image" data-sortable="true" data-align="center">Image</th>
                                        <th data-field="link" data-sortable="true" data-align="center">Link</th>
                                        <th data-field="operate" data-sortable="false" data-align="center">Actions</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    <!-- Dynamically populate rows -->
                                    @foreach($viewsliders as $slider)
                                    <tr>
                                        <td>{{ $slider->id }}</td>
                                        <td>{{ ucfirst($slider->type) }}</td>
                                        <td>{{ $slider->type_id }}</td>
                                        <td><img src="{{ asset('path/to/images/' . $slider->image) }}" alt="Slider Image" width="50"></td>
                                        <td><a href="{{ $slider->link }}" target="_blank">Visit Link</a></td>
                                        <td>
                                            <!-- Action Buttons -->
                                            <button class="btn btn-success btn-sm" title="Edit" onclick="editSlider({{ $slider->id }})">
                                                <i class="fas fa-edit"></i>
                                            </button>
                                            
                                            <!-- Delete Button -->
                                            <form action="{{ route('sliders.destroy', $slider->id) }}" method="POST" style="display:inline;" id="delete-form-{{ $slider->id }}">
                                                @csrf
                                                @method('DELETE')
                                                <button type="button" class="btn btn-danger btn-sm" title="Delete" onclick="confirmDelete({{ $slider->id }})">
                                                    <i class="fas fa-trash-alt"></i>
                                                </button>
                                            </form>
                                        </td>
                                    </tr>
                                    @endforeach
                                </tbody>
                            </table>
                            <!-- Pagination -->
                            <div class="pagination">
                                {{ $viewsliders->links() }}
                            </div>
                        </div> <!-- .card-innr -->
                    </div> <!-- .card -->
                </div> <!-- .main-content -->
            </div> <!-- .row -->
        </div> <!-- .container-fluid -->
    </section>
</div>

<!-- Add Slider Modal -->
<div class="modal fade" id="addSliderModal" tabindex="-1" role="dialog" aria-labelledby="addSliderModalLabel" aria-hidden="true">
    <div class="modal-dialog" role="document">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="addSliderModalLabel">Add Slider Image</h5>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>
            <div class="modal-body">
                <form action="{{ route('sliders.store') }}" method="POST" enctype="multipart/form-data">
                    @csrf
                    <div class="form-group">
                        <label for="type">Select Type</label>
                        <select class="form-control" id="type" name="type">
                            <option value="">-- Select Type --</option>
                            <option value="offer">Offer</option>
                            <option value="benefit">Benefit</option>
                            <option value="promotion">Promotion</option>
                        </select>
                    </div>

                    <div class="form-group">
                        <label for="slider_image">Slider Image</label>
                        <input type="file" class="form-control-file" id="slider_image" name="slider_image" required>
                    </div>

                    <div class="form-group">
                        <label for="link">Link (Optional)</label>
                        <input type="url" class="form-control" id="link" name="link" placeholder="http://example.com">
                    </div>

                    <div class="form-group d-flex justify-content-between">
                        <button type="reset" class="btn btn-secondary">Reset</button>
                        <button type="submit" class="btn btn-primary">Add Slider</button>
                    </div>
                </form>
            </div>
        </div>
    </div>
</div>

@endsection

<script>
function editSlider(id) {
    alert("Edit slider with ID: " + id);
}

function confirmDelete(id) {
    if (confirm("Are you sure you want to delete this slider?")) {
        // Submit the form for deletion
        document.getElementById('delete-form-' + id).submit();
    }
}
</script>

