@extends('admin.body.adminmaster')

@section('admin')
<div class="page-wrapper">
    <div class="container-fluid">
        <form action="{{ route('promo_code.update', $promo->id) }}" method="POST">
            @csrf
            @method('PUT')
            <div class="form-group">
                <label for="promo_code">Promo Code</label>
                <input type="text" name="promo_code" class="form-control" value="{{ $promo->promo_code }}">
            </div>
            <div class="form-group">
                <label for="message">Message</label>
                <textarea name="message" class="form-control">{{ $promo->message }}</textarea>
            </div>
            <!-- Add other fields like Image, Start Date, End Date, Discount, etc. -->
            <button type="submit" class="btn btn-success">Update Promo Code</button>
        </form>
    </div>
</div>
@endsection
