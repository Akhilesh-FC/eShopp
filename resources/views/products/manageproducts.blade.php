@extends('admin.body.adminmaster')

@section('admin')
<div class="container">
    <h3>Manage Products</h3>

    <table class="table table-bordered">
        <thead>
            <tr>
                <th>Image</th>
                <th>Name</th>
                <th>Brand</th>
                <th>Category Name</th>
                <th>Rating</th>
                <th>Action</th>
            </tr>
        </thead>
        <tbody>
            @foreach ($products as $product)
                <tr>
                    <td><img src="{{ $product->image }}" alt="{{ $product->name }}" width="50"></td>
                    
                    <td>{{ $product->name }}</td>
                    <td>{{ $product->brand }}</td>
                    <td>{{ $product->category->name ?? 'No Category' }}</td> <!-- Category Name -->
                    <td>
                        <form action="{{ route('update_rating', $product->id) }}" method="POST">
                            @csrf
                            <input type="number" name="rating" value="{{ $product->rating }}" min="1" max="5" style="width: 60px;">
                            <button type="submit" class="btn btn-primary btn-sm">Update</button>
                        </form>
                    </td>
                        
                        <!-- Success or Error Messages -->
                        @if(session('success'))
                            <div class="alert alert-success">
                                {{ session('success') }}
                            </div>
                        @endif
                        
                        @if(session('error'))
                            <div class="alert alert-danger">
                                {{ session('error') }}
                            </div>
                        @endif

                    
                    <td>
                        <a href="{{ route('view_product', $product->id) }}" class="btn btn-info btn-sm">View</a>
                        <a href="{{ route('edit_product', $product->id) }}" class="btn btn-warning btn-sm">Edit</a>
                        <form action="{{ route('delete_product', $product->id) }}" method="POST" style="display:inline-block;">
                            @csrf
                            @method('DELETE')
                            <button type="submit" class="btn btn-danger btn-sm">Delete</button>
                        </form>
                    </td>
                </tr>
            @endforeach
        </tbody>
    </table>
</div>
@endsection
