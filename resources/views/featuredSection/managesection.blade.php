@extends('admin.body.adminmaster')
@section('admin')
  
<div class="container-fluid">

<form action="{{ route('manage_section') }}" method="get"></form>

 <div class="content-wrapper">
    <!-- Content Header (Page header) -->
    <!-- Main content -->
    <section class="content-header">
        <div class="container-fluid">
            <div class="row mb-2">
                <div class="col-sm-6">
                    <h4>Manage Featured Section (Show Products Exclusively)</h4>
                </div>
                <div class="col-sm-6">
                    <ol class="breadcrumb float-sm-right">
                        <li class="breadcrumb-item"><a href="https://avrluxe.com/admin/home">Home</a></li>
                        <li class="breadcrumb-item active">Featured Section </li>
                    </ol>
                </div>
            </div>
        </div><!-- /.container-fluid -->
    </section>
    <section class="content">
        <div class="container-fluid">
            <div class="row">
                <div class="col-md-12">
                    <div class="card card-info">
                        <!-- form start -->
                        <form class="form-horizontal form-submit-event" action="https://avrluxe.com/admin/Featured_sections/add_featured_section" method="POST" enctype="multipart/form-data">
                                                        <div class="card-body">
                                <div class="form-group row">
                                    <label for="title" class="control-label">Title for section <span class='text-danger text-sm'>*</span></label>
                                    <div class="col-md-12">
                                        <input type="text" class="form-control" name="title" id="title" value="" placeholder="Title">
                                    </div>
                                </div>
                                <div class="form-group row">
                                    <label for="short_description" class="control-label">Short description <span class='text-danger text-sm'>*</span></label>
                                    <div class="col-md-12">
                                        <input type="text" class="form-control" name="short_description" id="short_description" value="" placeholder="Short description">
                                    </div>
                                </div>
                                <div class="form-group row select-categories">
                                    <label for="categories" class="control-label">Categories</label>
                                    <div class="col-md-12">
                                        <select name="categories[]" class="select_multiple w-100" multiple data-placeholder="Type to search and select categories">
                                            <option value="13" class="l0">Kids Clothes</option>
                                            <option value="16" class="l0">Earrings</option>
                                            <option value="17" class="l0">Rings</option>
                                            <option value="24" class="l1">Test</option>
                                            <option value="18" class="l0">Bangles</option>
                                            <option value="19" class="l0">Necklace</option>
                                            <option value="20" class="l0">Hair Accessories</option>
                                            <option value="21" class="l0">Hamper Box</option>
                                            <option value="22" class="l0">Rakhi</option>
                                        </select>
                                    </div>
                                </div>


                                <div class="form-group row">
                                                                        <label for="style" class="control-label">Style <span class='text-danger text-sm'>*</span></label>
                                    <div class="col-md-12">
                                        <select name="style" class="form-control">
                                            <option value=" ">Select Style</option>
                                                                                            <option value="default" >Default</option>
                                                                                            <option value="style_1" >Style 1</option>
                                                                                            <option value="style_2" >Style 2</option>
                                                                                            <option value="style_3" >Style 3</option>
                                                                                            <option value="style_4" >Style 4</option>
                                                                                    </select>
                                                                            </div>
                                </div>

                                <div class="form-group row">
                                                                        <label for="product_type" class="control-label">Product Types <span class='text-danger text-sm'> * </span></label>
                                    <div class="col-md-12">
                                        <select name="product_type" class="form-control product_type">
                                            <option value=" ">Select Types</option>
                                                                                            <option value="new_added_products" >New Added Products</option>
                                                                                            <option value="products_on_sale" >Products On Sale</option>
                                                                                            <option value="top_rated_products" >Top Rated Products</option>
                                                                                            <option value="most_selling_products" >Most Selling Products</option>
                                                                                            <option value="custom_products" >Custom Products</option>
                                                                                            <option value="digital_product" >Digital Product</option>
                                                                                    </select>
                                                                            </div>
                                </div>

                                <!-- for custom product -->

                                <div class="form-group row custom_products d-none">
                                    <label for="product_ids" class="control-label">Products *</label>
                                    <div class="col-md-12">
                                        <select name="product_ids[]" class="search_admin_product w-100" multiple data-placeholder=" Type to search and select products" onload="multiselect()">
                                                                                    </select>
                                    </div>
                                </div>

                                <!-- for digital product -->

                                <div class="form-group row digital_products d-none">
                                    <label for="digital_product_ids" class="control-label">Products *</label>
                                    <div class="col-md-12">
                                        <select name="digital_product_ids[]" class="search_admin_digital_product w-100" multiple data-placeholder=" Type to search and select products" onload="multiselect()">
                                                                                    </select>
                                    </div>
                                </div>

                                <div class="form-group">
                                    <button type="reset" class="btn btn-warning">Reset</button>
                                    <button type="submit" class="btn btn-success" id="submit_btn">Add Fetured Section</button>
                                </div>
                            </div>
                            <div class="d-flex justify-content-center form-group">
                                <div id="error_box">
                                </div>
                            </div>
                        </form>
                    </div>
                </div>
                <!--/.card-->
            </div>
            <div class="modal fade edit-modal-lg" tabindex="-1" role="dialog" aria-labelledby="myLargeModalLabel" aria-hidden="true">
                <div class="modal-dialog modal-lg">
                    <div class="modal-content">
                        <div class="modal-header">
                            <h5 class="modal-title" id="exampleModalLongTitle">Edit Fetured Section Details</h5>
                            <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                                <span aria-hidden="true">&times;</span>
                            </button>
                        </div>
                        <div class="modal-body">
                        </div>
                    </div>
                </div>
            </div>
            <div class="col-md-12 main-content">
                <div class="card content-area p-4">
                    <div class="card-head">
                        <h4 class="card-title">Featured Section</h4>
                    </div>
                    <div class="card-innr">
                        <div class="gaps-1-5x"></div>
                        <table class="table table-striped">
                            <thead>
                                <tr>
                                    <th>ID</th>
                                    <th>Title</th>
                                    <th>Short Description</th>
                                    <th>Style</th>
                                    <th>Categories</th>
                                    <th>Product IDs</th>
                                    <th>Product Type</th>
                                    <th>Date</th>
                                    <th>Actions</th>
                                </tr>
                            </thead>
                            <tbody>
                                <!-- Static Data Row 1 -->
                                <tr>
                                    <td>1</td>
                                    <td>Summer Collection</td>
                                    <td>Bright and trendy styles</td>
                                    <td>Casual</td>
                                    <td>Clothing</td>
                                    <td>101, 102, 103</td>
                                    <td>Seasonal</td>
                                    <td>2024-11-20</td>
                                    <td>
                                        <button class="btn btn-primary btn-sm">Edit</button>
                                        <button class="btn btn-danger btn-sm">Delete</button>
                                    </td>
                                </tr>
                                <!-- Static Data Row 2 -->
                                <tr>
                                    <td>2</td>
                                    <td>Winter Collection</td>
                                    <td>Warm and cozy outfits</td>
                                    <td>Formal</td>
                                    <td>Apparel</td>
                                    <td>201, 202, 203</td>
                                    <td>Seasonal</td>
                                    <td>2024-11-21</td>
                                    <td>
                                        <button class="btn btn-primary btn-sm">Edit</button>
                                        <button class="btn btn-danger btn-sm">Delete</button>
                                    </td>
                                </tr>
                            </tbody>
                        </table>
                    </div><!-- .card-innr -->
                </div><!-- .card -->
            </div>

        </div>
        <!-- /.row -->
</div><!-- /.container-fluid -->
</section>



@endsection
