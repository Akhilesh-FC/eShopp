@extends('admin.body.adminmaster')

@section('admin')
<div class="container">
    <h2 class="my-4 text-center">Vendors List</h2>
    
    
    <table class="table table-bordered">
        <thead>
            <tr>
                <th>#</th>
                <th>Vendor Name</th>
                <th>Image</th>
                <th>Mobile</th>
                <th>Address</th>
                <th>Status</th>
                <th>Action</th>
            </tr>
        </thead>
        <tbody>
            @foreach($vendors as $vendor)
                <tr>
                    <td>{{ $vendor->id }}</td>
                    <td>{{ $vendor->name }}</td>
                    <td>
                        @if(isset($vendor->vendor_image) && $vendor->vendor_image)
                            <img src="{{ $vendor->vendor_image }}" alt="Vendor Image" class="img-thumbnail" style="max-width: 100px; height: auto;">
                        @else
                            <span>No Image</span>
                        @endif
                    </td>
                    <td>{{ $vendor->mobile }}</td>
                    <td>{{ $vendor->address }}</td>
                    <td>
                        <form action="#" method="POST">
                            @csrf
                            @method('PUT')
                            <select class="form-select" name="status" onchange="this.form.submit()">
                                <option value="active" {{ $vendor->status == 'active' ? 'selected' : '' }}>Active</option>
                                <option value="inactive" {{ $vendor->status == 'inactive' ? 'selected' : '' }}>Inactive</option>
                            </select>
                        </form>
                    </td>
                    <td>
                       <a href="{{ route('vendor_details', $vendor->id) }}" class="btn btn-info btn-sm">Vendor Details</a>
                        <!-- Blade File -->
                        <a href="{{ route('vendor_productdetails', $vendor->id) }}" class="btn btn-primary btn-sm mt-1">Vendor Product Details</a>

                    </td>
                </tr>
            @endforeach
        </tbody>
    </table>
</div>
@endsection
