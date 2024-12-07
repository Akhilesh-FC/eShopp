@extends('admin.body.adminmaster')
@section('admin')
  
<div class="container-fluid">

<form action="{{route('product_order')}}" method="get"></form>
                

<div class="content-wrapper">
    <!-- Content Header (Page header) -->
    <!-- Main content -->
    <section class="content-header">
        <div class="container-fluid">
            <div class="row mb-2">
                <div class="col-sm-6">
                    <h4>Manage Products Order</h4>
                </div>
                <div class="col-sm-6">
                    <ol class="breadcrumb float-sm-right">
                        <li class="breadcrumb-item"><a href="#">Home</a></li>
                        <li class="breadcrumb-item active">Products Orders</li>
                    </ol>
                </div>
            </div>
        </div><!-- /.container-fluid -->
    </section>
    <section class="content">
        <div class="container-fluid">
            <div class="row">
                <div class="col-md-12 main-content">
                    <div class="card content-area p-4">
                        <div class="card-header border-0">
                        </div>
                        <div class="card-innr">
                            <div class="card-head ">
                                <h4 class="card-title float-none mb-2">Filter By Product Category</h4>
                            </div>
                            <div class="card-body">
                                <div class="row">
                                    <div class=" col-md-4">
                                        <label for="subcategory_id" class="col-form-label">Category</label>
                                        <select name="category_parent" id="category_parent" class="form-control col-12">
                                            <option value="">--Select Category--</option>
                                            <option value="0" selected="">All</option>
                                            <option value="13" class="l0"   >Kids Clothes</option><option value="16" class="l0"   >Earrings</option><option value="17" class="l0"   >Rings</option><option value="24" class="l1"   >tets</option><option value="18" class="l0"   >Bangles</option><option value="19" class="l0"   >Necklace</option><option value="20" class="l0"   >Hair Accessories</option><option value="21" class="l0"   >Hamper Box</option><option value="22" class="l0"   >Rakhi</option>                                        </select>
                                    </div>
                                    <div class="col-md-4 d-flex align-items-center pt-4">
                                        <button type="button" class="btn btn-outline-primary btn-sm" id="row_order_search" onclick="search_category_wise_products()">Search</button>
                                    </div>
                                </div>
                            </div>
                        </div><!-- .card-innr -->
                    </div><!-- .card -->
                </div>

                <div class="col-md-12 main-content">
                    <div class="card content-area p-4">
                        <div class="card-header border-0">
                        </div>
                        <div class="card-innr">
                            <div class="card-body">
                                <div class="row">
                                    <div class="col-md-6 col-12 offset-md-3">
                                        <label for="subcategory_id" class="col-form-label">Products List</label>
                                        <div class="row font-weight-bold">
                                            <div class="col-1">No.</div>
                                            <div class="col-3">Row Order Id</div>
                                            <div class="col-4">Product Name</div>
                                            <div class="col-4">Image</div>
                                        </div>
                                        <ul class="list-group bg-grey move order-container" id="sortable">
                                                <li class="list-group-item d-flex bg-gray-light align-items-center h-25" id="product_id-17">
                                                    <div class="col-md-1"><span> 0 </span></div>
                                                    <div class="col-md-3"><span> 0 </span></div>
                                                    <div class="col-md-4"><span>Razi</span></div>
                                                    <div class="col-md-4">
                                                        <img src="https://avrluxe.com/uploads/media/2023/IMG_20230729_144605.jpg" class="image-box-100">
                                                    </div>
                                                </li>
                                                <li class="list-group-item d-flex bg-gray-light align-items-center h-25" id="product_id-11">
                                                    <div class="col-md-1"><span> 1 </span></div>
                                                    <div class="col-md-3"><span> 0 </span></div>
                                                    <div class="col-md-4"><span>Jeans</span></div>
                                                    <div class="col-md-4">
                                                        <img src="https://avrluxe.com/uploads/media/2023/download_(2).png" class="image-box-100">
                                                    </div>
                                                </li>
                                                <li class="list-group-item d-flex bg-gray-light align-items-center h-25" id="product_id-57">
                                                    <div class="col-md-1"><span> 9 </span></div>
                                                    <div class="col-md-3"><span> 0 </span></div>
                                                    <div class="col-md-4"><span>test product</span></div>
                                                    <div class="col-md-4">
                                                        <img src="https://avrluxe.com/uploads/media/2023/IMG_20230815_153449.jpg" class="image-box-100">
                                                    </div>
                                                </li>
                                                                                    </ul>
                                        <button type="button" class="btn btn-block btn-success btn-lg mt-3" id="save_product_order">Save</button>
                                    </div>
                                </div>
                            </div><!-- .card-innr -->
                        </div><!-- .card -->
                    </div>

                </div>
                <!-- /.row -->
            </div><!-- /.container-fluid -->
    </section>
</div>
@endsection

<style>
    .image-box-100 {
    max-width: 100px; /* Set the maximum width */
    max-height: 100px; /* Set the maximum height */
    width: auto; /* Maintain aspect ratio */
    height: auto; /* Maintain aspect ratio */
    object-fit: contain; /* Ensure the image is contained within the dimensions */
}

</style>
