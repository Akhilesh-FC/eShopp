@extends('admin.body.adminmaster')

@section('admin')
<div class="page-wrapper">
    <div class="container-fluid">

<div class="container-fluid mt-4">
    <!-- File Select and Upload Section -->
    <div class="upload-section">
        <form action="{{ route('media') }}" method="post" class="dropzone" id="media-upload-form" enctype="multipart/form-data">
            @csrf

            <!-- Select File Button -->
            <div class="dz-message needsclick text-center" style="border: 2px dashed #cccccc; padding: 30px; cursor: pointer;">
                <label for="file-select" class="btn btn-primary">Select File</label>
                <input type="file" id="file-select" class="d-none" multiple onchange="handleFileSelect(event)">
                <p> or</p>
                <h4 class="mb-3">Drag and Drop Media Files Here</h4>
            </div>
        </form>
    </div>

    <!-- Upload Button -->
    <div class="mt-3 text-right">
        <button id="upload-files-btn" class="btn btn-success">Upload</button>
    </div>
</div>
<!-- Filters Section -->
<div class="container-fluid mt-4">
    <div class="row mb-3">
        <!-- Media Gallery Heading -->
        <div class="col-12">
            <h4>Media Gallery</h4>
        </div>
    </div>

    <div class="row">
        <!-- Date and Time Range Filter -->
        <div class="form-group col-md-4">
            <label>Date and Time Range:</label>
            <div class="input-group">
                <div class="input-group-prepend">
                    <span class="input-group-text"><i class="far fa-clock"></i></span>
                </div>
                <input type="text" class="form-control float-right" autocomplete="off" id="datepicker" placeholder="Select date of range to filter">
                <input type="hidden" id="start_date">
                <input type="hidden" id="end_date">
            </div>
        </div>

        <!-- Media Type Filter -->
        <div class="form-group col-md-4">
            <label>Media Type:</label>
            <select class="form-control" id="media-type">
                <option value="">All Media Items</option>
                <option value="image">Images</option>
                <option value="audio">Audio</option>
                <option value="video">Video</option>
                <option value="archive">Archive</option>
                <option value="spreadsheet">Spreadsheet</option>
                <option value="documents">Documents</option>
            </select>
        </div>

        <!-- Search and Reset Buttons -->
        <div class="form-group col-md-4 d-flex align-items-center">
            <button class="btn btn-outline-primary btn-sm mr-2" onclick="status_date_wise_search()">Search</button>
            <button class="btn btn-outline-danger btn-sm" onclick="resetfilters()">Reset</button>
        </div>
    </div>
</div>
<!-- Media Table Section -->
<div class="main-content">
    <div class="card content-area p-4">
        <div class="card-head">
            <h4 class="card-title">Media Details</h4>
        </div>
        <div class="card-innr">
            <div class="gaps-1-5x"></div>
            <table class="table table-striped" id="media-table">
                <thead>
                    <tr>
                        <th data-field="state" data-checkbox="true"><input type="checkbox" id="select-all"></th>
                        <th data-field="id" data-sortable="true" data-visible="false">ID</th>
                        <th data-field="name">Name</th>
                        <th data-field="image">Image</th>
                        <th data-field="extension">Extension</th>
                        <th data-field="sub_directory">Sub Directory</th>
                        <th data-field="size">Size</th>
                        <th data-field="operate">Actions</th>
                    </tr>
                </thead>
                <tbody>
                    <!-- Static data row for demonstration -->
                    <tr>
                        <td><input type="checkbox" class="select-item"></td>
                        <td>1</td>
                        <td>Example File 1</td>
                        <td><img src="path/to/image1.jpg" alt="Image" width="50"></td>
                        <td>jpg</td>
                        <td>subdir/example1</td>
                        <td>2 MB</td>
                        <td>
                            <button class="btn btn-danger btn-sm" onclick="deleteFile(1)">
                                <i class="fas fa-trash-alt"></i> Delete
                            </button>
                            <button class="btn btn-secondary btn-sm" onclick="copyToClipboard('path/to/image1.jpg')">
                                <i class="fas fa-copy"></i> Copy Path
                            </button>
                            <button class="btn btn-info btn-sm" onclick="copyImagePath('path/to/image1.jpg')">
                                <i class="fas fa-link"></i> Copy Image Path
                            </button>
                        </td>
                    </tr>
                    <tr>
                        <td><input type="checkbox" class="select-item"></td>
                        <td>2</td>
                        <td>Example File 2</td>
                        <td><img src="path/to/image2.jpg" alt="Image" width="50"></td>
                        <td>png</td>
                        <td>subdir/example2</td>
                        <td>3 MB</td>
                        <td>
                            <button class="btn btn-danger btn-sm" onclick="deleteFile(2)">
                                <i class="fas fa-trash-alt"></i> Delete
                            </button>
                            <button class="btn btn-secondary btn-sm" onclick="copyToClipboard('path/to/image2.jpg')">
                                <i class="fas fa-copy"></i> Copy Path
                            </button>
                            <button class="btn btn-info btn-sm" onclick="copyImagePath('path/to/image2.jpg')">
                                <i class="fas fa-link"></i> Copy Image Path
                            </button>
                        </td>
                    </tr>
                    <!-- Add more static rows as needed -->
                </tbody>
            </table>
        </div>
    </div>
</div>

</div>

@endsection

<script>
    // Initialize Dropzone
    Dropzone.options.mediaUploadForm = {
        autoProcessQueue: false,
        parallelUploads: 10,
        init: function () {
            var myDropzone = this;
            document.getElementById("upload-files-btn").addEventListener("click", function () {
                myDropzone.processQueue(); // Manually upload file
            });
        }
    };

    // Custom functions for date filters and resetting
    function status_date_wise_search() {
        // Your custom date search logic
    }

    function resetfilters() {
        // Your custom reset filters logic
    }

    function deleteFile(id) {
        // Implement file deletion logic
        alert("Delete file with ID: " + id);
    }

    function copyToClipboard(text) {
        navigator.clipboard.writeText(text).then(() => {
            alert("Path copied to clipboard: " + text);
        });
    }

    function copyImagePath(imagePath) {
        navigator.clipboard.writeText(imagePath).then(() => {
            alert("Image path copied: " + imagePath);
        });
    }

    // Select/Deselect all checkboxes
    document.getElementById('select-all').addEventListener('change', function (event) {
        let checkboxes = document.querySelectorAll('.select-item');
        checkboxes.forEach(checkbox => checkbox.checked = event.target.checked);
    });
</script>

