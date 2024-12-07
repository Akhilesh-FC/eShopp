@extends('admin.body.adminmaster')
@section('admin')
  
<div class="container-fluid">

<form action="{{route('add_products')}}" method="get"></form>

   
<div class="content-wrapper">
    <!-- Content Header (Page header) -->
    <!-- Main content -->
    <section class="content-header">
        <div class="container-fluid">
            <div class="row mb-2">
                <div class="col-sm-6">
                    <h4>Add Product</h4>
                </div>
                <div class="col-sm-6">
                    <ol class="breadcrumb float-sm-right">
                        <li class="breadcrumb-item"><a href="#">Home</a></li>
                        <li class="breadcrumb-item active">Products</li>
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
                        <form class="form-horizontal" action="#" method="POST" enctype="multipart/form-data" id="save-product">
                                                        <div class="card-body">

                                <div class="form-group col-md-12">
                                    <label for="pro_input_text" class="col-form-label">Name <span class='text-danger text-sm'>*</span> </label>
                                    <input type="text" class="form-control" id="pro_input_text" placeholder="Product Name" name="pro_input_name" value="">
                                </div>
                                <div class="row col-md-12">
                                    <div class="form-group col-md-6">
                                        <label for="seller" class="col-form-label">Seller <span class='text-danger text-sm'>*</span></label>
                                        <select class='form-control' name='seller_id' id="seller_id">
                                            <option value="">Select Seller </option>
                                                                                            <option value="12" >AVR LUXE - AVR (store)</option>
                                                                                    </select>
                                    </div>
                                                                            <div class="form-group col-md-6">
                                            <label for="seller" class="col-form-label">Product Type </label>
                                            <select class='form-control' name='product_type_menu' id="product_type_menu">
                                                <option value="physical_product"> Physical Product </option>
                                                <option value="digital_product"> Digital Product </option>
                                            </select>
                                        </div>
                                                                    </div>

                                <div class="form-group col-md-12">
                                    <label for="pro_short_description" class="col-form-label">Short Description <span class='text-danger text-sm'>*</span></label>
                                    <textarea type="text" class="form-control" id="short_description" placeholder="Product Short Description" name="short_description"></textarea>
                                </div>
                                <div class="form-group">
                                    <div class="col-md-12">
                                        <label for="tags">Tags <small>( These tags help you in search result )</small></label>
                                        <input name='tags' class='' id='tags' placeholder="Type in some tags for example AC, Cooler, Flagship Smartphones, Mobiles, Sport Shoes etc" value="" />
                                    </div>
                                </div>
                                <div class="form-group row">
                                    <div class="col-md-8">
                                        <div class="row col mt-3">
                                            <div class="col-md-4">
                                                <label for="pro_input_tax" class="col-form-label">Tax</label>
                                                <select class="col-md-12 form-control" name="pro_input_tax">
                                                                                                                                                                <option value="6" >Tax(3%)</option>
                                                                                                            <option value="7" >Tax1(12%)</option>
                                                                                                    </select>

                                            </div>
                                            <div class="col-md-4 indicator ">
                                                <label for="indicator" class="col-form-label">Indicator</label>
                                                <select class='form-control' name='indicator'>
                                                    <option value='0' >None</option>
                                                    <option value='1' >Veg</option>
                                                    <option value='2' >Non-Veg</option>
                                                </select>
                                            </div>
                                            <div class="col-md-4">
                                                <label for="made_in" class="col-form-label">Made In</label>
                                                <select class="col-md-12 form-control country_list" id="country_list" name="made_in">
                                                                                                        <!-- countries display here  -->
                                                </select>
                                            </div>
                                            <div class="col-md-4">
                                                <label for="brand" class="col-form-label">Brand</label>
                                                <select class=" col-md-12  form-control admin_brand_list" id="admin_brand_list" name="brand">
                                                                                                        <!-- brands display here  -->
                                                </select>
                                            </div>
                                            <div class="col-md-4 total_allowed_quantity ">
                                                <label for="total_allowed_quantity" class="col-form-label">Total Allowed Quantity</label>
                                                <input type="number" class="col-md-12 form-control" name="total_allowed_quantity" value="" placeholder='Total Allowed Quantity'>
                                            </div>
                                            <div class="col-md-4 minimum_order_quantity ">
                                                <label for="minimum_order_quantity" class="col-form-label">Minimum Order Quantity</label>
                                                <input type="number" class="col-md-12 form-control" name="minimum_order_quantity" min="1" value="1" placeholder='Minimum Order Quantity'>
                                            </div>
                                            <div class="col-md-4 quantity_step_size ">
                                                <label for="quantity_step_size" class="col-form-label">Quantity Step Size</label>
                                                <input type="number" class="col-md-12 form-control" name="quantity_step_size" min="1" value="1" placeholder='Quantity Step Size'>
                                            </div>
                                            <div class="col-md-4 warranty_period ">
                                                <label for="warranty_period" class="col-form-label">Warranty Period</label>
                                                <input type="text" class="col-md-12 form-control" name="warranty_period" value="" placeholder='Warranty Period if any'>
                                            </div>
                                            <div class="col-md-4 guarantee_period ">
                                                <label for="guarantee_period" class="col-form-label">Guarantee Period</label>
                                                <input type="text" class="col-md-12 form-control" name="guarantee_period" value="" placeholder='Guarantee Period if any'>
                                            </div>
                                            <div class="row col mt-3 deliverable_type ">
                                                <div class="col-md-6">
                                                    <label for="zipcode" class="col-form-label">Deliverable Type</label>
                                                    <select class='form-control' name='deliverable_type' id="deliverable_type">
                                                        <option value=0 >None</option>
                                                                                                                    <option value=1 selected>All</option>
                                                                                                                <option value=2 >Included</option>
                                                        <option value=3 >Excluded</option>
                                                    </select>
                                                </div>
                                                                                                <div class="col-md-6">
                                                    <label for="zipcodes" class="col-form-label">Deliverable Zipcodes</label>
                                                    <select name="deliverable_zipcodes[]" class="search_zipcode form-control w-100" multiple onload="multiselect()" id="deliverable_zipcodes" disabled>
                                                                                                            </select>
                                                </div>
                                            </div>


                                            <!-- HSN Code -->
                                            <div class="col-md-4 col-sm-12 mt-3 hsn_code ">
                                                <label for="zipcodes" class="col-form-label">HSN Code</label>
                                                <input type="text" class="col-md-12 form-control" name="hsn_code" value="" placeholder='HSN Code'>
                                            </div>
                                        </div>
                                        <div class="row col mt-3 pickup_locations ">
                                            <div class="col-md-8 standdard_shipping">
                                                <label for="shipping_type" class="col-form-label">For standdard shipping <span class='text-danger text-sm'>*</span></label>
                                                <!-- drop down menu in while create product -->
                                                <select class='form-control shiprocket_type' name="pickup_location" id="pickup_location">
                                                    <option value=" ">Select Pickup Location</option>
                                                                                                    </select>
                                            </div>
                                        </div>
                                        <div class="row col mt-3">
                                            <div class="col-md-3 col-xs-6">
                                                <label for="is_prices_inclusive_tax" class="col-form-label">Tax included in prices?</label>
                                                <input type="checkbox" name="is_prices_inclusive_tax"  data-bootstrap-switch data-off-color="danger" data-on-color="success" data-on-text="Yes" data-off-text="No">
                                            </div>
                                            <div class="col-md-2 col-xs-6 cod_allowed ">
                                                <label for="is_cod_allowed" class="col-form-label">Is COD allowed?</label>
                                                <input type="checkbox" name="cod_allowed"  data-bootstrap-switch data-off-color="danger" data-on-color="success">
                                            </div>
                                            <div class="col-md-2 col-xs-6 is_returnable ">
                                                <label for="is_returnable" class="col-form-label">IS Returnable ?</label>
                                                <input type="checkbox" name="is_returnable"  data-bootstrap-switch data-off-color="danger" data-on-color="success">
                                            </div>
                                            <div class="col-md-2 col-xs-6 is_cancelable ">
                                                <label for="is_cancelable" class="col-form-label">Is cancelable ? </label>
                                                <input type="checkbox" name="is_cancelable" id="is_cancelable" class="switch"  data-bootstrap-switch data-off-color="danger" data-on-color="success">
                                            </div>
                                            <div class="col-md-3 col-xs-6 collapse" id='cancelable_till'>
                                                <label for="cancelable_till" class="col-form-label">Till which status ? <span class='text-danger text-sm'>*</span></label>
                                                <select class='form-control' name="cancelable_till">
                                                    <option value='received' >Received</option>
                                                    <option value='processed' >Processed</option>
                                                    <option value='shipped' >Shipped</option>
                                                </select>
                                            </div>
                                        </div>
                                        <div class="row col mt-3">

                                            <div class="col pt-4 pb-4">
                                                <div class="form-group col-sm-12">
                                                    <label for="image">Main Image <span class='text-danger text-sm'>*</span><small>(Recommended Size : 180 x 180 pixels)</small></label>
                                                    <div class='col-md-12'><a class="uploadFile img btn btn-primary text-white btn-sm" data-input='pro_input_image' data-isremovable='0' data-is-multiple-uploads-allowed='0' data-toggle="modal" data-target="#media-upload-modal" value="Upload Photo"><i class='fa fa-upload'></i> Upload</a></div>
                                                                                                            <div class="container-fluid row image-upload-section">
                                                            <div class="col-md-3 col-sm-12 shadow p-3 mb-5 bg-white rounded m-4 text-center grow image d-none">
                                                            </div>
                                                        </div>
                                                    

                                                </div>
                                                <div class="form-group">
                                                    <label for="other_images">Other Images <small>(Recommended Size : 180 x 180 pixels)</small></label>
                                                    <div class="col-sm-12">
                                                        <div class='col-md-3'><a class="uploadFile img btn btn-primary text-white btn-sm" data-input='other_images[]' data-isremovable='1' data-is-multiple-uploads-allowed='1' data-toggle="modal" data-target="#media-upload-modal" value="Upload Photo"><i class='fa fa-upload'></i> Upload</a></div>
                                                                                                                    <div class="container-fluid row image-upload-section">
                                                            </div>
                                                                                                            </div>
                                                </div>
                                                <div class="form-group d-flex">
                                                    <div class="form-group col-md-6">
                                                        <label for="video_type" class="col-form-label">Video Type</label>
                                                        <select class='form-control' name='video_type' id='video_type'>
                                                            <option value='' >None</option>
                                                            <option value='self_hosted' >Self Hosted</option>
                                                            <option value='youtube' >Youtube</option>
                                                            <option value='vimeo' >Vimeo</option>
                                                        </select>
                                                    </div>
                                                    <div class="col-md-6 d-none" id="video_link_container">
                                                        <label for="video" class="col-form-label">Video Link <span class='text-danger text-sm'>*</span></label>
                                                        <input type="text" class='form-control' name='video' id='video' value="" placeholder="Paste Youtube / Vimeo Video link or URL here">
                                                    </div>
                                                    <div class="col-md-6 mt-2 d-none" id="video_media_container">
                                                        <label for="image" class="ml-2">Video <span class='text-danger text-sm'>*</span></label>
                                                        <div class='col-md-3'><a class="uploadFile img btn btn-primary text-white btn-sm" data-input='pro_input_video' data-isremovable='1' data-media_type='video' data-is-multiple-uploads-allowed='0' data-toggle="modal" data-target="#media-upload-modal" value="Upload Photo"><i class='fa fa-upload'></i> Upload</a></div>
                                                                                                                    <div class="container-fluid row image-upload-section">
                                                                <div class="col-md-3 col-sm-12 shadow p-3 mb-5 bg-white rounded m-4 text-center grow image d-none">
                                                                </div>
                                                            </div>
                                                        
                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                        <div id="attributes_values_json_data" class="d-none">
                                            <select class="select_single" data-placeholder=" Type to search and select attributes">
                                                <option value=""></option>
                                                                                                    <optgroup label="Size">Size                                                                                                                    <option name='Size_number' value='Size_number' data-values='[{"id":"1","text":"2.4","data-values":"2.4"},{"id":"2","text":"2.6","data-values":"2.6"},{"id":"5","text":"2.8","data-values":"2.8"}]'>Size_number</option>
                                                                                                            </optgroup>
                                                                                                    <optgroup label="Color">Color                                                                                                                    <option name='Color1' value='Color1' data-values='[{"id":"3","text":"Blue","data-values":"Blue"},{"id":"4","text":"Red","data-values":"Red"}]'>Color1</option>
                                                                                                                    <option name='red' value='red' data-values='[{"id":"6","text":"red","data-values":"red"}]'>red</option>
                                                                                                            </optgroup>
                                                                                            </select>
                                        </div>
                                    </div>
                                    <div class="col-md-4 mt-3">
                                        <label for="pro_input_tax" class="col-form-label">Select Category <span class='text-danger text-sm'>*</span></label>
                                        <div id="product_category_tree_view_html" class='category-tree-container'></div>
                                    </div>
                                    <div class="form-group  col-md-12 mb-3">
                                        <h3 class="card-title">Additional Info</h3>

                                                                                            <div class="col-12 row additional-info existing-additional-settings">
                                                        <div class="row mt-4 col-md-12 ">
                                                            <nav class="w-100">
                                                                <div class="nav nav-tabs" id="product-tab" role="tablist"> <a class="nav-item nav-link active" id="tab-for-general-price" data-toggle="tab" href="#general-settings" role="tab" aria-controls="general-price" aria-selected="true">General</a> <a class="nav-item nav-link disabled product-attributes" id="tab-for-attributes" data-toggle="tab" href="#product-attributes" role="tab" aria-controls="product-attributes" aria-selected="false">Attributes</a> <a class="nav-item nav-link disabled product-variants d-none" id="tab-for-variations" data-toggle="tab" href="#product-variants" role="tab" aria-controls="product-variants" aria-selected="false">Variations</a>
                                                                </div>
                                                            </nav>
                                                            <div class="tab-content p-3 col-md-12" id="nav-tabContent">
                                                                <div class="tab-pane fade active show" id="general-settings" role="tabpanel" aria-labelledby="general-settings-tab">
                                                                    <div class="form-group">
                                                                        <label for="type" class="col-md-12">Type Of Product :</label>
                                                                        <div class="col-md-12">
                                                                            <input type="hidden" name="product_type">
                                                                            <input type="hidden" name="simple_product_stock_status">
                                                                            <input type="hidden" name="variant_stock_level_type">
                                                                            <input type="hidden" name="variant_stock_status">
                                                                            <select name="type" id="product-type" class="form-control product-type" data-placeholder=" Type to search and select type">
                                                                                <option value=" ">Select Type</option>
                                                                                <option value="simple_product">Simple Product</option>
                                                                                <option value="variable_product">Variable Product</option>
                                                                            </select>
                                                                        </div>
                                                                    </div>
                                                                    <div id="product-general-settings">
                                                                        <div id="general_price_section" class="collapse">
                                                                            <div class="form-group">
                                                                                <label for="type" class="col-md-2">Price:</label>
                                                                                <div class="col-md-12">
                                                                                    <input type="number" name="simple_price" class="form-control stock-simple-mustfill-field price" min='1' step="0.01">
                                                                                </div>
                                                                            </div>
                                                                            <div class="form-group">
                                                                                <label for="type" class="col-md-2">Special Price:</label>
                                                                                <div class="col-md-12">
                                                                                    <input type="number" name="simple_special_price" class="form-control discounted_price" min='0' step="0.01">
                                                                                </div>
                                                                            </div>
                                                                            <div class="form-group row mt-3" id="product-dimensions">
                                                                                <div class="col-6">
                                                                                    <label for="weight" class="control-label col-md-12"><small>(These are the product parcel's dimentions.)</small></label>
                                                                                </div>
                                                                            </div>
                                                                            <div class="form-group row" id="product-dimensions">
                                                                                <div class="col-3">
                                                                                    <label for="weight" class="control-label col-md-12">Weight <small>(kg)</small> <span class='text-danger text-xs'>*</span></label>
                                                                                    <input type="number" class="form-control" name="weight" placeholder="Weight" id="weight" value="" step="0.01">
                                                                                </div>
                                                                                <div class="col-3">
                                                                                    <label for="height" class="control-label col-md-12">Height <small>(cms)</small></label>
                                                                                    <input type="number" class="form-control" name="height" placeholder="Height" id="height" value="" step="0.01">
                                                                                </div>
                                                                                <div class="col-3">
                                                                                    <label for="breadth" class="control-label col-md-12">Breadth <small>(cms)</small></label>
                                                                                    <input type="number" class="form-control" name="breadth" placeholder="Breadth" id="breadth" value="" step="0.01">
                                                                                </div>
                                                                                <div class="col-3">
                                                                                    <label for="length" class="control-label col-md-12">Length <small>(cms)</small></label>
                                                                                    <input type="number" class="form-control" name="length" placeholder="Length" id="length" value="" step="0.01">
                                                                                </div>
                                                                            </div>

                                                                            <div class="form-group  simple_stock_management">
                                                                                <div class="col">
                                                                                    <input type="checkbox" name="simple_stock_management_status" class="align-middle simple_stock_management_status"> <span class="align-middle">Enable Stock Management</span>
                                                                                </div>
                                                                            </div>
                                                                        </div>
                                                                        <div class="form-group simple-product-level-stock-management collapse">
                                                                            <div class="col col-xs-12">
                                                                                <label class="control-label">SKU :</label>
                                                                                <input type="text" name="product_sku" class="col form-control simple-pro-sku">
                                                                            </div>
                                                                            <div class="col col-xs-12">
                                                                                <label class="control-label">Total Stock :</label>
                                                                                <input type="number" min="1" name="product_total_stock" class="col form-control stock-simple-mustfill-field">
                                                                            </div>
                                                                            <div class="col col-xs-12">
                                                                                <label class="control-label">Stock Status :</label>
                                                                                <select type="text" class="col form-control stock-simple-mustfill-field" id="simple_product_stock_status">
                                                                                    <option value="1">In Stock</option>
                                                                                    <option value="0">Out Of Stock</option>
                                                                                </select>
                                                                            </div>
                                                                        </div>
                                                                        <div class="form-group collapse simple-product-save">
                                                                            <div class="col"> <a href="javascript:void(0);" class="btn btn-primary save-settings">Save Settings</a>
                                                                            </div>
                                                                        </div>
                                                                    </div>
                                                                    <div id="variant_stock_level" class="collapse">
                                                                        <div class="form-group">
                                                                            <div class="col">
                                                                                <input type="checkbox" name="variant_stock_management_status" class="align-middle variant_stock_status"> <span class="align-middle"> Enable Stock Management</span>
                                                                            </div>
                                                                        </div>
                                                                        <div class="form-group collapse" id="stock_level">
                                                                            <label for="type" class="col-md-2">Choose Stock Management Type:</label>
                                                                            <div class="col-md-12">
                                                                                <select id="stock_level_type" class="form-control variant-stock-level-type" data-placeholder=" Type to search and select type">
                                                                                    <option value=" ">Select Stock Type</option>
                                                                                    <option value="product_level">Product Level ( Stock Will Be Managed Generally )</option>
                                                                                    <option value="variable_level">Variable Level ( Stock Will Be Managed Variant Wise )</option>
                                                                                </select>
                                                                                <div class="form-group row variant-product-level-stock-management collapse">
                                                                                    <div class="col col-xs-12">
                                                                                        <label class="control-label">SKU :</label>
                                                                                        <input type="text" name="sku_variant_type" class="col form-control">
                                                                                    </div>
                                                                                    <div class="col col-xs-12">
                                                                                        <label class="control-label">Total Stock :</label>
                                                                                        <input type="number" min="1" name="total_stock_variant_type" class="col form-control variant-stock-mustfill-field">
                                                                                    </div>
                                                                                    <div class="col col-xs-12">
                                                                                        <label class="control-label">Stock Status :</label>
                                                                                        <select type="text" id="stock_status_variant_type" name="variant_status" class="col form-control variant-stock-mustfill-field">
                                                                                            <option value="1">In Stock</option>
                                                                                            <option value="0">Out Of Stock</option>
                                                                                        </select>
                                                                                    </div>
                                                                                </div>
                                                                            </div>
                                                                        </div>
                                                                        <div class="form-group">
                                                                            <div class="col"> <a href="javascript:void(0);" class="btn btn-primary save-variant-general-settings">Save Settings</a>
                                                                            </div>
                                                                        </div>
                                                                    </div>
                                                                    <div id="digital_product_setting" class="collapse">
                                                                        <div class="row form-group">
                                                                            <div class="col-md-2 col-xs-6 ml-2">
                                                                                <label for="is_cod_allowed" class="col-form-label">Is Download allowed?</label>
                                                                                <input type="checkbox" name="download_allowed" id="download_allowed" class="switch"  data-bootstrap-switch data-off-color="danger" data-on-color="success">
                                                                            </div>
                                                                            <div class="col-md-3 col-xs-6 collapse" id='download_type'>
                                                                                <label for="download_allowed" class="col-form-label">Download Link Type <span class='text-danger text-sm'>*</span></label>
                                                                                <select class='form-control' name="download_link_type" id="download_link_type">
                                                                                    <option value=''>None</option>
                                                                                    <option value='self_hosted'>Self Hosted</option>
                                                                                    <option value='add_link'>Add Link</option>
                                                                                </select>
                                                                            </div>
                                                                            <div class="col-md-6 d-none" id="digital_link_container">
                                                                                <label for="video" class="col-form-label ml-1">Digital Product Link <span class='text-danger text-sm'>*</span></label>
                                                                                <input type="url" class='form-control' name='download_link' id='download_link' value="" placeholder="Paste digital product link or URL here">
                                                                            </div>
                                                                            <div class="col-md-6 mt-2 d-none" id="digital_media_container">
                                                                                <label for="image" class="ml-2">File <span class='text-danger text-sm'>*</span></label>
                                                                                <div class='col-md-3'><a class="uploadFile img btn btn-primary text-white btn-sm" data-input='pro_input_zip' data-isremovable='1' data-media_type='archive,document' data-is-multiple-uploads-allowed='0' data-toggle="modal" data-target="#media-upload-modal" value="Upload Photo"><i class='fa fa-upload'></i> Upload</a></div>
                                                                                <div class="container-fluid row image-upload-section">
                                                                                    <div class="col-md-3 col-sm-12 shadow p-3 mb-5 bg-white rounded m-4 text-center grow image d-none">
                                                                                    </div>
                                                                                </div>
                                                                            </div>
                                                                        </div>
                                                                        <div class="row">
                                                                            <div class="form-group mt-3 ml-2">
                                                                                <div class="col"> <a href="javascript:void(0);" class="btn btn-primary save-digital-product-settings">Save Settings</a></div>
                                                                            </div>
                                                                        </div>
                                                                    </div>

                                                                </div>
                                                                <div class="tab-pane fade" id="product-attributes" role="tabpanel" aria-labelledby="product-attributes-tab">
                                                                    <div class="info col-12 p-3 d-none" id="note">
                                                                        <div class=" col-12 d-flex align-center"> <strong>Note : </strong>
                                                                            <input type="checkbox" checked="checked" class="ml-3 my-auto custom-checkbox" disabled> <span class="ml-3">check if the attribute is to be used for variation </span>
                                                                        </div>
                                                                    </div>
                                                                    <div class="col-md-12"> <a href="javascript:void(0);" id="add_attributes" class="btn btn-block btn-outline-primary col-md-2 float-right m-2 btn-sm">Add Attributes</a> <a href="javascript:void(0);" id="save_attributes" class="btn btn-block btn-outline-primary col-md-2 float-right m-2 btn-sm d-none">Save Attributes</a>
                                                                    </div>
                                                                    <div class="clearfix"></div>
                                                                    <div id="attributes_process">
                                                                        <div class="form-group text-center row my-auto p-2 border rounded bg-gray-light col-md-12 no-attributes-added">
                                                                            <div class="col-md-12 text-center">No Product Attribures Are Added !</div>
                                                                        </div>
                                                                    </div>
                                                                </div>
                                                                <div class="tab-pane fade" id="product-variants" role="tabpanel" aria-labelledby="product-variants-tab">
                                                                    <div class="clearfix"></div>
                                                                    <div class="form-group text-center row my-auto p-2 border rounded bg-gray-light col-md-12 no-variants-added">
                                                                        <div class="col-md-12 text-center">No Product Variations Are Added !</div>
                                                                    </div>
                                                                    <div id="variants_process" class="ui-sortable"></div>
                                                                </div>
                                                            </div>
                                                        </div>
                                                    </div>
                                                                                                </div>
                                            </div>
                                    </div>
                                    <div class="card-body pad">
                                        <div class="form-group col-md-12">
                                            <label for="pro_input_description">Description </label>
                                            <div class="mb-3">
                                                <textarea name="pro_input_description" class="textarea addr_editor" placeholder="Place some text here"></textarea>
                                            </div>
                                            <label for="pro_input_description">Extra Description </label>
                                            <div class="mb-3">
                                                <textarea name="extra_input_description" class="textarea addr_editor" placeholder="Place some text here"></textarea>
                                            </div>
                                            <div class="d-flex justify-content-center">
                                                <div class="form-group" id="error_box">
                                                </div>
                                            </div>
                                            <div class="form-group">
                                                <button type="reset" class="btn btn-warning">Reset</button>
                                                <button type="submit" class="btn btn-success" id="submit_btn">Add Product</button>
                                            </div>
                                        </div>
                                    </div>

                                </div>
                            </div>
                        </form>
                    </div>
                    <!--/.card-->
                </div>
                <!--/.col-md-12-->
            </div>
            <!-- /.row -->
        </div><!-- /.container-fluid -->
    </section>

</div>
@endsection