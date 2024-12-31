@extends('admin.body.adminmaster')

@section('admin')
<div class="container">
    <!-- Back Button on Top -->
    <!--<a href="{{ route('vendor', $vendor->id) }}" class="btn btn-primary mb-4">Back to Vendor List</a>-->
    <a href="{{ route('vendor', $vendor->id) }}" class="btn btn-primary mb-4">&larr; Back to Vendor List</a>
    
    <h2 class="my-4 text-center">Vendor Profile</h2>

    <div class="row">
        <!-- Vendor Information Section -->
        <div class="col-md-6">
            <h4>Personal Information</h4>
            <ul class="list-group">
                <li class="list-group-item"><strong>Name:</strong> {{ $vendor->name }}</li>
                <li class="list-group-item"><strong>Email:</strong> {{ $vendor->email }}</li>
                <li class="list-group-item"><strong>Phone Number:</strong> {{ $vendor->mobile }}</li>
                <li class="list-group-item"><strong>Address:</strong> {{ $vendor->address }}</li>
            </ul>
        </div>

        <!-- Vendor Images and Documents Section -->
        <div class="col-md-6">
            <h4>Vendor Images & Documents</h4>
            <div class="row">
                <div class="col-md-6 mb-4">
                    <h5>Aadhaar Image</h5>
                    @if($vendor->upload_adharcard)
                        <img src="{{ $vendor->upload_adharcard }}" alt="Aadhaar Image" class="img-fluid img-thumbnail" style="object-fit: cover; height: 150px;">
                    @else
                        <span>No Aadhaar Image</span>
                    @endif
                </div>

                <div class="col-md-6 mb-4">
                    <h5>Vendor Photo</h5>
                    @if($vendor->vendor_image)
                        <img src="{{ $vendor->vendor_image }}" alt="Vendor Photo" class="img-fluid img-thumbnail" style="object-fit: cover; height: 150px;">
                    @else
                        <span>No Vendor Photo</span>
                    @endif
                </div>
           
                <div class="col-md-6 mb-4">
                    <h5>GST Image</h5>
                    @if($vendor->upload_gst)
                        <img src="{{ $vendor->upload_gst }}" alt="GST Image" class="img-fluid img-thumbnail" style="object-fit: cover; height: 150px;">
                    @else
                        <span>No GST Image</span>
                    @endif
                </div>
            
                <div class="col-md-6 mb-4">
                    <h5>PAN Image</h5>
                    @if($vendor->upload_pan)
                        <img src="{{ $vendor->upload_pan }}" alt="PAN Image" class="img-fluid img-thumbnail" style="object-fit: cover; height: 150px;">
                    @else
                        <span>No PAN Image</span>
                    @endif
                </div>
           </div>
        </div>
    </div>

    <div class="row mt-5">
        <!-- Shop Details Section -->
        <div class="col-md-6">
            <h4>Shop Information</h4>
            <ul class="list-group">
                <li class="list-group-item"><strong>Shop Name:</strong> {{ $vendor->shoap_name }}</li>
                <li class="list-group-item"><strong>Shop Address:</strong> {{ $vendor->shoap_address }}</li>
                <li class="list-group-item"><strong>GST Number:</strong> {{ $vendor->gst_no }}</li>
                <li class="list-group-item"><strong>PAN Number:</strong> {{ $vendor->pan_no }}</li>
            </ul>
        </div>
    </div>
</div>
@endsection
