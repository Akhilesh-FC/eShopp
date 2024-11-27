@extends('admin.body.adminmaster')
@section('admin')

    <form action="{{route('contact_us') }}" method="get"></form>
    
     <div class="content-wrapper">
  <!-- Content Header (Page header) -->
  <!-- Main content -->
  <section class="content-header">
    <div class="container-fluid">
      <div class="row mb-2">
        <div class="col-sm-6">
          <h4>Contact Us</h4>
        </div>
        <div class="col-sm-6">
          <ol class="breadcrumb float-sm-right">
            <li class="breadcrumb-item"><a href="https://avrluxe.com/admin/home">Home</a></li>
            <li class="breadcrumb-item active">Contact Us</li>
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
            <form class="form-horizontal form-submit-event" action="https://avrluxe.com/admin/Contact_us/update-contact-settings" method="POST" enctype="multipart/form-data">
              <div class="card-body pad">
                <label for="other_images">Contact Us </label>
                <div class="mb-3">

                  <textarea name="contact_input_description" class="textarea addr_editor" placeholder="Place some text here text_editor">
                          <h2><strong xss=removed>Contact Us</strong></h2>

<p>For any kind of queries related to products, orders or services feel free to contact us on our official email address or phone number as given below :</p>

<p> </p>

<h3><strong>Areas we deliver : </strong></h3>

<p> </p>

<h3><strong>Delivery Timings :</strong></h3>

<ol>
 <li><strong>  8:00 AM To 10:30 AM</strong></li>
 <li><strong>10:30 AM To 12:30 PM</strong></li>
 <li><strong>  4:00 PM To  7:00 PM</strong></li></ol><h3> <strong></strong>

</h3><p><strong>Note : </strong>You can order for maximum 2days in advance. i.e., Today & Tomorrow only.  <br></p>                        </textarea>
                </div>
                <div class="d-flex justify-content-center">
                  <div class="form-group" id="error_box">
                  </div>
                </div>
                <div class="form-group">
                  <button type="reset" class="btn btn-warning">Reset</button>
                  <button type="submit" class="btn btn-success" id="submit_btn">Update Contact Info</button>
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
    
    
@endsection
