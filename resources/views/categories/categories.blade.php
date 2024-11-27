@extends('admin.body.adminmaster')
@section('admin')
  
<div class="container-fluid">

<form action="{{route('categories')}}" method="get"></form>
                
<div class="content-wrapper">
    <!-- Content Header (Page header) -->
    <!-- Main content -->
    <section class="content-header">
        <div class="container-fluid">
            <div class="row mb-2">
                <div class="col-sm-6">
                    <h4>Manage Categories Order</h4>
                </div>
                <div class="col-sm-6">
                    <ol class="breadcrumb float-sm-right">
                        <li class="breadcrumb-item"><a href="https://avrluxe.com/admin/home">Home</a></li>
                        <li class="breadcrumb-item active">Categories Orders</li>
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
                            <div class="card-body">
                                <div class="row">
                                    <div class="col-md-6 col-12 offset-md-3">
                                        <label for="subcategory_id" class="col-form-label">Category List</label>
                                        <div class="row font-weight-bold">
                                            <div class="col-2">No.</div>
                                            <div class="col-4">Row Order</div>
                                            <div class="col-3">Name</div>
                                            <div class="col-3">Image</div>
                                        </div>
                                        <ul class="list-group bg-grey move order-container" id="sortable">
                                                                                                <li class="list-group-item d-flex bg-gray-light align-items-center h-25" id="category_id-13">
                                                        <div class="col-2"><span> 0 </span></div>
                                                        <div class="col-4"><span> 0 </span></div>
                                                        <div class="col-3"><span>Kids Clothes</span></div>
                                                        <div class="col-3">
                                                            <img src="https://avrluxe.com/uploads/media/2023/thumb-sm/_DSC6157.JPG" class="image-box-100">
                                                        </div>
                                                    </li>
                                                                                                    <li class="list-group-item d-flex bg-gray-light align-items-center h-25" id="category_id-16">
                                                        <div class="col-2"><span> 1 </span></div>
                                                        <div class="col-4"><span> 1 </span></div>
                                                        <div class="col-3"><span>Earrings</span></div>
                                                        <div class="col-3">
                                                            <img src="https://avrluxe.com/uploads/media/2023/thumb-sm/IMG_20230801_230326.jpg" class="image-box-100">
                                                        </div>
                                                    </li>
                                                                                                    <li class="list-group-item d-flex bg-gray-light align-items-center h-25" id="category_id-17">
                                                        <div class="col-2"><span> 2 </span></div>
                                                        <div class="col-4"><span> 2 </span></div>
                                                        <div class="col-3"><span>Rings</span></div>
                                                        <div class="col-3">
                                                            <img src="https://avrluxe.com/uploads/media/2023/thumb-sm/IMG_20230801_231008.jpg" class="image-box-100">
                                                        </div>
                                                    </li>
                                                                                                    <li class="list-group-item d-flex bg-gray-light align-items-center h-25" id="category_id-18">
                                                        <div class="col-2"><span> 3 </span></div>
                                                        <div class="col-4"><span> 3 </span></div>
                                                        <div class="col-3"><span>Bangles</span></div>
                                                        <div class="col-3">
                                                            <img src="https://avrluxe.com/uploads/media/2023/thumb-sm/IMG_20230731_221816.jpg" class="image-box-100">
                                                        </div>
                                                    </li>
                                                                                                    <li class="list-group-item d-flex bg-gray-light align-items-center h-25" id="category_id-19">
                                                        <div class="col-2"><span> 4 </span></div>
                                                        <div class="col-4"><span> 4 </span></div>
                                                        <div class="col-3"><span>Necklace</span></div>
                                                        <div class="col-3">
                                                            <img src="https://avrluxe.com/uploads/media/2023/thumb-sm/IMG_20230801_230126.jpg" class="image-box-100">
                                                        </div>
                                                    </li>
                                                                                                    <li class="list-group-item d-flex bg-gray-light align-items-center h-25" id="category_id-20">
                                                        <div class="col-2"><span> 5 </span></div>
                                                        <div class="col-4"><span> 5 </span></div>
                                                        <div class="col-3"><span>Hair Accessories</span></div>
                                                        <div class="col-3">
                                                            <img src="https://avrluxe.com/uploads/media/2023/thumb-sm/IMG_20230801_232555.jpg" class="image-box-100">
                                                        </div>
                                                    </li>
                                                                                                    <li class="list-group-item d-flex bg-gray-light align-items-center h-25" id="category_id-21">
                                                        <div class="col-2"><span> 6 </span></div>
                                                        <div class="col-4"><span> 6 </span></div>
                                                        <div class="col-3"><span>Hamper Box</span></div>
                                                        <div class="col-3">
                                                            <img src="https://avrluxe.com/uploads/media/2023/thumb-sm/IMG_20230801_232054.jpg" class="image-box-100">
                                                        </div>
                                                    </li>
                                                                                                    <li class="list-group-item d-flex bg-gray-light align-items-center h-25" id="category_id-22">
                                                        <div class="col-2"><span> 7 </span></div>
                                                        <div class="col-4"><span> 7 </span></div>
                                                        <div class="col-3"><span>Rakhi</span></div>
                                                        <div class="col-3">
                                                            <img src="https://avrluxe.com/uploads/media/2023/thumb-sm/IMG_20230801_232450.jpg" class="image-box-100">
                                                        </div>
                                                    </li>
                                                                                        </ul>
                                        <button type="button" class="btn btn-block btn-success btn-lg mt-3" id="save_category_order">Save</button>
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