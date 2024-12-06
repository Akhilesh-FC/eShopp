@extends('admin.body.adminmaster')
@section('admin')

<script src="https://cdn.ckeditor.com/ckeditor5/40.1.0/classic/ckeditor.js"></script>

<div class="container-xxl flex-grow-1 container-p-y">

    <!-- Privacy Policy Section -->
    <div class="card">
        <div class="card-header d-flex justify-content-between">
            <h5>Privacy Policy</h5>
        </div>

        <div class="card-body">
            <form action="{{ route('privacy_policy') }}" method="post" enctype="multipart/form-data">
                @csrf

                <div class="row mb-2">
                    <div class="col-sm-12">
                        <label for="privacyEditor">Description</label>
                        <textarea id="privacyEditor" name="description">{{$settings[0]->value}}</textarea>
                    </div>
                </div>

                <div>
                    <button type="submit" class="btn btn-success btn-sm">Submit</button>
                </div>
            </form>
        </div>
    </div>

    <!-- Terms and Conditions Section -->
    <div class="card">
        <div class="card-header d-flex justify-content-between">
            <h5>Terms and Conditions</h5> 
        </div>

        <div class="card-body">
            <form action="{{ route('term_condition') }}" method="post" enctype="multipart/form-data">
                @csrf
                <div class="row mb-2">
                    <div class="col-sm-12">
                        <label for="termsEditor">Description</label>
                        <textarea id="termsEditor" name="description">{{$settings[0]->value}}</textarea>
                    </div>
                </div>

                <div>
                    <button type="submit" class="btn btn-success btn-sm">Submit</button>
                </div>
            </form>
        </div>
    </div>

</div>

<script>
    // ClassicEditor
    //     .create(document.querySelector('#editor'))
    //     .catch(error => { console.error(error); });
        
        ClassicEditor
        .create(document.querySelector('#privacyEditor'))
        .catch(error => { console.error(error); });

    ClassicEditor
        .create(document.querySelector('#termsEditor'))
        .catch(error => { console.error(error); });

    // Image Preview for Slider Images
    document.getElementById('imageInput').addEventListener('change', handleFileSelectSlider);

    function handleFileSelectSlider(event) {
        const selectedFiles = event.target.files;
        const selectedImagesContainer = document.getElementById('selectedImages');
        selectedImagesContainer.innerHTML = ''; // Clear previous selections

        for (let i = 0; i < selectedFiles.length; i++) {
            const file = selectedFiles[i];
            const imageElement = document.createElement('img');
            imageElement.src = URL.createObjectURL(file);
            imageElement.style.maxWidth = '100px';
            imageElement.style.maxHeight = '100px';
            selectedImagesContainer.appendChild(imageElement);
        }
    }

    // Image Preview for Thumbnail
    document.getElementById('thumbnailInput').addEventListener('change', handleFileSelectThumbnail);

    function handleFileSelectThumbnail(event) {
        const selectedFiles = event.target.files;
        const selectedImagesContainer = document.getElementById('thumbnailImages');
        selectedImagesContainer.innerHTML = ''; // Clear previous selections

        for (let i = 0; i < selectedFiles.length; i++) {
            const file = selectedFiles[i];
            const thumbnail = document.createElement('canvas');
            const thumbnailContext = thumbnail.getContext('2d');
            thumbnail.width = 100;
            thumbnail.height = 100;

            const imageElement = new Image();
            imageElement.onload = function() {
                thumbnailContext.drawImage(imageElement, 0, 0, thumbnail.width, thumbnail.height);
                const thumbnailElement = document.createElement('img');
                thumbnailElement.src = thumbnail.toDataURL('image/png');
                selectedImagesContainer.appendChild(thumbnailElement);
            };
            imageElement.src = URL.createObjectURL(file);
        }
    }
</script>

@endsection
