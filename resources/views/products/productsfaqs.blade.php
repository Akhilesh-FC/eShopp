@extends('admin.body.adminmaster')

@section('admin')
<div class="page-wrapper">
     <div class="container-fluid">

    <form action="{{route('products_faqs')}}" method="get"></form>

    <div class="content-wrapper">
        <!-- Content Header (Page header) -->
        <!-- Main content -->
        <section class="content-header">
            <div class="container-fluid">
                <div class="row mb-2">
                    <div class="col-sm-6">
                        <h4>Manage Products FAQs</h4>
                    </div>
                    <div class="col-sm-6">
                        <ol class="breadcrumb float-sm-right">
                            <li class="breadcrumb-item"><a href="#">Home</a></li>
                            <li class="breadcrumb-item active">Product FAQs</li>
                        </ol>
                    </div>
                </div>
            </div><!-- /.container-fluid -->
        </section>

        <section class="content">
            <div class="container-fluid">
                <div class="row">

                    <div id="product_faq_value_id" class="modal fade edit-modal-lg" tabindex="-1" role="dialog" aria-labelledby="myLargeModalLabel" aria-hidden="true">
                        <div class="modal-dialog modal-lg">
                            <div class="modal-content">
                                <div class="modal-header">
                                    <h5 class="modal-title" id="exampleModalLongTitle">Edit Product FAQs</h5>
                                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                                        <span aria-hidden="true">&times;</span>
                                    </button>
                                </div>

                                <div class="modal-body p-0">
                                    <form class="form-horizontal form-submit-event" id="product_edit_faq_form" action="#" method="POST" enctype="multipart/form-data">
                                        <div class="card-body">
                                            <div class="form-group row">
                                                <label for="question" class="col-sm-2 col-form-label">Question </label>
                                                <div class="col-sm-10">
                                                    <input type="text" class="form-control" id="question" placeholder="question" name="question" value="" disabled>
                                                </div>
                                            </div>
                                            <div class="form-group row">
                                                <label for="answer" class="col-sm-2 col-form-label">Answer <span class='text-danger text-sm'>*</span></label>
                                                <div class="col-sm-10">
                                                    <input type="text" class="form-control" id="answer" placeholder="Answer" name="answer" value="">
                                                </div>
                                            </div>

                                            <div class="form-group">
                                                <button type="reset" class="btn btn-warning">Reset</button>
                                                <button type="submit" class="btn btn-success" id="submit_btn">Add Product FAQ</button>
                                            </div>
                                        </div>
                                        <div class="d-flex justify-content-center">
                                            <div class="form-group" id="error_box">
                                            </div>
                                        </div>
                                    </form>
                                </div>
                            </div>
                        </div>
                    </div>

                    <div class="col-md-12 main-content">
    <div class="card content-area p-4">
        <div class="card-header border-0">
            <div class="card-tools">
                <!-- Custom styles for button -->
                <a href="#" class="btn btn-outline-primary btn-sm float-right">Add Product FAQs</a>
            </div>
        </div>
                            <div class="card-innr">
                                <div class="gaps-1-5x"></div>
                                <table class='table table-striped' id='products_faqs_table'>
                                    <thead>
                                        <tr>
                                            <th data-field="id" data-sortable="true" data-align='center'>ID</th>
                                            <th data-field="question" data-sortable="false" data-align='center'>Question</th>
                                            <th data-field="answer" data-sortable="false">Answer</th>
                                            <th data-field="answered_by" data-sortable="false" data-align='center'>Answered by</th>
                                            <th data-field="answered_by_name" data-sortable="false" data-align='center'>Answered by Name</th>
                                            <th data-field="username" data-sortable="false" data-align='center'>Username</th>
                                            <th data-field="date_added" data-sortable="false" data-align='center'>Date added</th>
                                            <th data-field="operate" data-sortable="false" data-align='center'>Operate</th>
                                        </tr>
                                    </thead>
                                    <tbody>
                                        <!-- Static data for testing -->
                                        <tr>
                                            <td>1</td>
                                            <td>What is the return policy?</td>
                                            <td>Our return policy allows returns within 30 days of purchase.</td>
                                            <td>Admin</td>
                                            <td>John Doe</td>
                                            <td>johndoe</td>
                                            <td>2024-11-20</td>
                                            <td>
                                                <button class="btn btn-warning btn-sm" data-toggle="modal" data-target="#product_faq_value_id">Edit</button>
                                            </td>
                                        </tr>
                                        <tr>
                                            <td>2</td>
                                            <td>How can I track my order?</td>
                                            <td>You can track your order through the tracking link sent to your email.</td>
                                            <td>Admin</td>
                                            <td>Jane Doe</td>
                                            <td>janedoe</td>
                                            <td>2024-11-19</td>
                                            <td>
                                                <button class="btn btn-warning btn-sm" data-toggle="modal" data-target="#product_faq_value_id">Edit</button>
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

    </div>
@endsection
