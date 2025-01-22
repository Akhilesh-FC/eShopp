@extends('admin.body.adminmaster')

@section('admin')
<div class="page-wrapper">
    <div class="container-fluid">

<script src="https://cdn.ckeditor.com/ckeditor5/40.1.0/classic/ckeditor.js"></script>

<div class="container-xxl flex-grow-1 container-p-y">

    <!-- Success/Error Messages -->
    @if(session('success'))
    <div class="alert alert-success alert-dismissible fade show" role="alert">
        {{ session('success') }}
        <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
    </div>
    @elseif(session('error'))
    <div class="alert alert-danger alert-dismissible fade show" role="alert">
        {{ session('error') }}
        <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
    </div>
    @endif

    <!-- Privacy Policy Section --> 
    <div class="card mb-4 shadow-sm">
        <div class="card-header bg-primary text-white d-flex justify-content-between align-items-center">
            <h5 class="mb-0">Privacy Policy</h5>
        </div>
        <div class="card-body">
            <form action="{{ route('update.privacy') }}" method="post" enctype="multipart/form-data"> 
                @csrf
                <div class="mb-3"> 
                    <label for="privacyEditor" class="form-label">Description</label>
                    <input type="hidden" name="id" value="{{ $settings[19]->id}}" 
                    <div class="editor-container">
                        <textarea id="privacyEditor" name="description">{{ $settings[19]->value ?? '' }}</textarea> 
                    </div>
                </div>
                <div class="d-flex justify-content-end">
                    <button type="submit" class="btn btn-success">Submit</button>   
                </div> 
            </form>
        </div>
    </div> 

    <!-- Terms and Conditions Section -->
    <div class="card shadow-sm"> 
        <div class="card-header bg-primary text-white d-flex justify-content-between align-items-center">
            <h5 class="mb-0">Terms and Conditions</h5>
        </div>
        <div class="card-body"> 
            <form action="{{ route('update.privacy') }}" method="post" enctype="multipart/form-data">
                @csrf
                <div class="mb-3"> 
                    <label for="termsEditor" class="form-label">Description</label>
                    <input type="hidden" name="id" value="{{ $settings[20]->id}}" 
                    <div class="editor-container"> 
                        <textarea id="termsEditor" name="description">{{ $settings[20]->value ?? '' }}</textarea>
                    </div>
                </div>
                <div class="d-flex justify-content-end">
                    <button type="submit" class="btn btn-success">Submit</button> 
                </div>
            </form>
        </div>
    </div>

</div>

<script>
    // Initialize CKEditor with a fixed height
    function initializeEditor(selector) {
        ClassicEditor
            .create(document.querySelector(selector), {
                toolbar: [
                    'heading', '|', 'bold', 'italic', 'link', 'bulletedList', 'numberedList', '|', 'undo', 'redo'
                ]
            })
            .then(editor => {
                editor.ui.view.editable.element.style.height = '250px'; // Fixed height for scrollable content
                editor.ui.view.editable.element.style.overflowY = 'auto'; // Add vertical scrolling
            })
            .catch(error => console.error(error));
    }

    document.addEventListener('DOMContentLoaded', function () {
        initializeEditor('#privacyEditor');
        initializeEditor('#termsEditor');
    });
</script>

<style>
    .editor-container {
        border: 1px solid #ddd;
        border-radius: 4px;
        padding: 10px;
        background: #f9f9f9;
        max-height: 300px;
        overflow: hidden;
    }

    .card {
        border-radius: 10px;
    }

    .btn-success {
        background-color: #28a745;
        border-color: #28a745;
        transition: all 0.3s ease;
    }

    .btn-success:hover {
        background-color: #218838;
        border-color: #1e7e34;
    }

    .card-header {
        border-bottom: 2px solid #ddd;
    }

    .card-body {
        padding: 20px;
    }
</style>

@endsection



