@extends('admin.body.adminmaster')

@section('admin')
<div class="page-wrapper">
    <div class="container-fluid">
 <form action="{{ route('faq') }}" method="get"></form>
 
 <div class="content-wrapper">
  <!-- Content Header (Page header) -->
  <!-- Main content -->
  <section class="content-header">
    <div class="container-fluid">
      <div class="row mb-2">
        <div class="col-sm-6">
          <h4>Manage FAQ</h4>
        </div>
        <div class="col-sm-6">
          <ol class="breadcrumb float-sm-right">
            <li class="breadcrumb-item"><a href="https://avrluxe.com/admin/home">Home</a></li>
            <li class="breadcrumb-item active">FAQ</li>
          </ol>
        </div>
      </div>
    </div><!-- /.container-fluid -->
  </section>
  <section class="content">
    <div class="container-fluid">
      <div class="row">
        <div class="modal fade" id="faqModal" tabindex="-1" role="dialog" aria-hidden="true">
          <div class="modal-dialog" role="document">
            <div class="modal-content">
              <form class="form-horizontal form-submit-event" action="https://avrluxe.com/admin/faq/add_faq" method="POST" enctype="multipart/form-data">
                <div class="modal-header mb-1">
                  <h5 class="modal-title">Add FAQ</h5>
                  <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                  </button>
                </div>
                <div class="modal-body">

                  <div class="form-group">
                    <label for="question" class="col-form-label">Question <span class='text-danger text-xs'>*</span></label>
                    <input type="text" class="form-control" name="question">
                  </div>
                  <div class="form-group">
                    <label for="answer" class="col-form-label">Answer <span class='text-danger text-xs'>*</span></label>
                    <textarea class="form-control" name="answer"></textarea>
                  </div>
                  <div class="d-flex justify-content-center">
                    <div class="form-group" id="error_box">
                    </div>
                  </div>

                </div>
                <div class="modal-footer">
                  <button type="button" class="btn btn-warning" data-dismiss="modal">Close</button>
                  <button type="submit" class="btn btn-success">Add Faq</button>
                </div>
              </form>
            </div>
          </div>
        </div>
        <div class="col-md-12 text-right mb-2">
          <button class="btn btn-success" data-toggle="modal" data-target="#faqModal">Add FAQ</button>
        </div>
        <div class="col-10 mx-auto">
          <div class="accordion" id="faqExample">
                          <form class="form-horizontal form-submit-event" action="https://avrluxe.com/admin/faq/add_faq" method="POST" enctype="multipart/form-data">
                <input type="hidden" name="edit_faq" value="2">
                <div class="card">
                  <div class="card-body p-2 row" id="headingOne">
                    <div class="col-md-6 d-flex display-content-between">
                      <h5 class="mb-0">
                        <span class="btn btn-link " data-toggle="collapse" data-target="#collapseOne1" aria-expanded="true" aria-controls="collapseOne">
                          1. <span class="faq_question">GST</span>
                        </span>
                      </h5>
                      <input type="type" name="question" placeholder="Enter question here " class="ml-3 form-control col-md-12 d-none">
                    </div>
                    <div class="col-md-6 text-right">
                      <button class="btn btn-success btn-xs edit_faq action-btn mr-1 mb-1 ml-1" type="button">
                        <i class="fa fa-pen"></i>
                      </button>
                      <a href="javascript:void(0)" class="btn btn-danger action-btn btn-xs delete_faq mb-1 ml-1 mr-1" type="button" data-id="2">
                        <i class="fa fa-trash"></i>
                      </a>
                    </div>
                  </div>
                  <div id="collapseOne1" class="collapse" aria-labelledby="headingOne" data-parent="#faqExample">
                    <div class="card-body">
                      <b>Answer :</b> <span class="faq_answer">10 % GST</span>
                      <textarea class="d-none form-control col-md-12" name="answer" placeholder="Enter The Answer Here"></textarea>
                    </div>
                  </div>
                  <div class="col-md-12 m-2 save d-none">
                    <button class="btn btn-success" type="submit">
                      <i class="fa fa-save"></i> Save
                    </button>
                  </div>
                </div>
              </form>
                      </div>

        </div>
      </div>
      <!-- /.row -->
    </div><!-- /.container-fluid -->
  </section>
 
 @endsection