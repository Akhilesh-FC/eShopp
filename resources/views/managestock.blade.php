@extends('admin.body.adminmaster')
@section('admin')

<div class="container-fluid">
    <form action="{{ route('manage_stock') }}" method="get"></form>

    <div class="content-wrapper">
        <!-- Content Header (Page header) -->
        <section class="content-header">
            <div class="container-fluid">
                <div class="row mb-2">
                    <div class="col-sm-6">
                        <h4>Manage Products Stock</h4>
                    </div>
                    <div class="col-sm-6">
                        <ol class="breadcrumb float-sm-right">
                            <li class="breadcrumb-item"><a href="https://avrluxe.com/admin/home">Home</a></li>
                            <li class="breadcrumb-item active">Product Stock</li>
                        </ol>
                    </div>
                </div>
            </div>
        </section>

        <!-- Main Content -->
        <section class="content">
            <div class="container-fluid">
                <div class="row">
                    <!-- Modal for Stock Adjustment -->
                    <div id="product_faq_value_id" class="modal fade edit-modal-lg" tabindex="-1" role="dialog" aria-labelledby="myLargeModalLabel" aria-hidden="true">
                        <div class="modal-dialog modal-m">
                            <div class="modal-content">
                                <div class="modal-header">
                                    <h5 class="modal-title">Manage Stock</h5>
                                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                                        <span aria-hidden="true">&times;</span>
                                    </button>
                                </div>
                                <div class="modal-body">
                                    <form class="form-horizontal form-submit-event" id="stock_adjustment_form" action="https://avrluxe.com/admin/manage_stock/update_stock" method="POST" enctype="multipart/form-data">
                                        <div class="card-body">
                                            <div class="row">
                                                <div class="col-12">
                                                    <div class="form-group">
                                                        <label for="product_name">Product</label>
                                                        <input type="text" class="form-control" id="product_name" placeholder="Product name" name="product_name" value="" readonly>
                                                    </div>
                                                </div>
                                                <div class="col-4">
                                                    <div class="form-group">
                                                        <label for="current_stock">Current Stock</label>
                                                        <input type="text" class="form-control" name="current_stock" id="current_stock" value="" readonly>
                                                    </div>
                                                </div>
                                                <div class="col-4">
                                                    <div class="form-group">
                                                        <label for="quantity">Quantity</label><span class="text-danger">*</span>
                                                        <input type="number" class="form-control" name="quantity" id="quantity" min="1">
                                                    </div>
                                                </div>
                                                <div class="col-4">
                                                    <div class="form-group">
                                                        <label for="type">Type</label>
                                                        <select class="form-control" id="type" name="type">
                                                            <option value="add">Add</option>
                                                            <option value="subtract">Subtract</option>
                                                        </select>
                                                    </div>
                                                </div>
                                                <button type="submit" class="btn btn-success">Update Stock</button>
                                            </div>
                                        </div>
                                    </form>
                                </div>
                            </div>
                        </div>
                    </div>

                    <!-- Filters for Seller and Category -->
                    <div class="col-md-12 main-content">
                        <div class="card content-area p-4">
                            <div class="card-header border-0">
                                <div class="row">
                                    <div class="col-md-3">
                                        <label for="seller_filter" class="col-form-label">Filter By Seller</label>
                                        <select class="form-control" name="seller_id" id="seller_filter">
                                            <option value="">Select Seller</option>
                                            <option value="12">AVR LUXE</option>
                                        </select>
                                    </div>
                                    <div class="col-md-3">
                                        <label for="category_parent" class="col-form-label">Filter By Product Category</label>
                                        <select class="form-control" id="category_parent" name="category_parent">
                                            <option value="">Select Categories</option>
                                            <option value="13">Kids Clothes</option>
                                            <option value="16">Earrings</option>
                                            <option value="17">Rings</option>
                                            <option value="24">tets</option>
                                            <option value="18">Bangles</option>
                                            <option value="19">Necklace</option>
                                            <option value="20">Hair Accessories</option>
                                            <option value="21">Hamper Box</option>
                                            <option value="22">Rakhi</option>
                                        </select>
                                    </div>
                                </div>
                            </div>

                            <!-- Products Table -->
                            <div class="card-innr">
                                <div class="gaps-1-5x"></div>
                                <table class="table table-striped" id="products_table"
                                       data-toggle="table"
                                       data-url="https://avrluxe.com/admin/manage_stock/get_stock_list"
                                       data-click-to-select="true"
                                       data-side-pagination="server"
                                       data-pagination="true"
                                       data-page-list="[5, 10, 20, 50, 100, 200]"
                                       data-search="true"
                                       data-show-columns="true"
                                       data-show-refresh="true"
                                       data-trim-on-search="false"
                                       data-sort-name="id"
                                       data-sort-order="desc"
                                       data-mobile-responsive="true"
                                       data-show-export="true"
                                       data-maintain-selected="true"
                                       data-export-types='["txt","excel","csv"]'
                                       data-export-options='{"fileName": "products-list", "ignoreColumn": ["state"] }'
                                       data-query-params="stock_query_params">
                                    <thead>
                                        <tr>
                                            <th data-field="id" data-sortable="true" data-align="center">Variant ID</th>
                                            <th data-field="name" data-sortable="false" data-align="center">Name</th>
                                            <th data-field="image" data-sortable="false" data-align="center">Image</th>
                                            <th data-field="operate" data-sortable="true" data-align="center">Variants - Stock</th>
                                        </tr>
                                    </thead>
                                </table>
                            </div>
                        </div><!-- .card -->
                    </div>
                </div>
            </div>
        </section>
    </div>
</div>

@endsection
