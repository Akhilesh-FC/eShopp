@extends('admin.body.adminmaster')
@section('admin')

    <form action="{{route('general_settings') }}" method="get"></form>
    
     <div class="content-wrapper">
    <section class="content-header">
        <div class="container-fluid">
            <div class="row mb-2">
                <div class="col-sm-6">
                    <h4>General Website Settings</h4>
                </div>
                <div class="col-sm-6">
                    <ol class="breadcrumb float-sm-right">
                        <li class="breadcrumb-item"><a href="https://avrluxe.com/admin/home">Home</a>
                        </li>
                        <li class="breadcrumb-item active">General Website Settings</li>
                    </ol>
                </div>
            </div>
        </div>
    </section>
    <section class="content">
        <div class="container-fluid">
            <div class="row">
                <div class="col-md-12">
                    <div class="card card-info">
                        <form class="form-horizontal form-submit-event" action="https://avrluxe.com/admin/setting/update_web_settings" method="POST" id="system_setting_form" enctype="multipart/form-data">
                            <div class="card-body">
                                <div class="row">
                                    <div class="form-group col-md-4">
                                        <label for="site_title">Site Title <span class='text-danger text-xs'>*</span></label>
                                        <input type="text" class="form-control" name="site_title" value="Avr Luxe-" placeholder="Prefix title for the website. " />
                                    </div>
                                    <div class="form-group col-md-4">
                                        <label for="support_number">Support Number <span class='text-danger text-xs'>*</span></label>
                                        <input type="text" class="form-control" name="support_number" value="6386490030" placeholder="Customer support mobile number" />
                                    </div>
                                    <div class="form-group col-md-4">
                                        <label for="support_email">Support Email <span class='text-danger text-xs'>*</span></label>
                                        <input type="text" class="form-control" name="support_email" value="vandana.rbl.singh@gmail.com" placeholder="Customer support email" />
                                    </div>
                                    <div class="form-group col-md-12">
                                        <label for="address">Copyright Details <span class='text-danger text-xs'>*</span></label>
                                        <textarea name="copyright_details" id="copyright_details" class="form-control" cols="30" rows="3">Copyright ©foundercodes.com</textarea>
                                    </div>
                                    <div class="form-group col-md-12">
                                        <label for="address">Address <span class='text-danger text-xs'>*</span></label>
                                        <textarea name="address" id="address" class="form-control" cols="30" rows="5">SS-968, Sector-G, LDA Colony, Kanpur Road, Lucknow-226012</textarea>
                                    </div>
                                    <div class="form-group col-md-12">
                                        <label for="app_short_description">Short Description <span class='text-danger text-xs'>*</span></label>
                                        <textarea name="app_short_description" id="app_short_description" class="form-control" cols="30" rows="5">AVR LUXE is a multipurpose Ecommerce Platform best suitable for all kinds of sectors like Fashion, Life Style, Handmade jewellery like Earrings, Choker sets, Bangles, Hair Accessories, Hamper Box, Rings, Rakhi, Gift articles and more ..</textarea>
                                    </div>
                                    <div class="form-group col-md-12">
                                        <label for="map_iframe">Map Iframe <span class='text-danger text-xs'>*</span></label>
                                        <textarea name="map_iframe" id="map_iframe" class="form-control" cols="30" rows="5">&lt;iframe src="https://www.google.com/maps/embed?pb=!1m18!1m12!1m3!1d58652.60185263579!2d69.63381478835316!3d23.250814410717105!2m3!1f0!2f0!3f0!3m2!1i1024!2i768!4f13.1!3m3!1m2!1s0x3950e209000b6f17:0x7077f358af0774a6!2sBhuj, Gujarat!5e0!3m2!1sen!2sin!4v1614852897708!5m2!1sen!2sin" width="600" height="450" style="border:0;" allowfullscreen="" loading="lazy"&gt;&lt;/iframe&gt;</textarea>
                                    </div>
                                    <div class="form-group col-md-12">
                                        <div class="row">
                                            <div class="col-md-6 form-group">
                                                <label for="logo">Logo <span class='text-danger text-xs'>*</span><small>(Recommended Size : larger than 120 x 120 & smaller than 150 x 150 pixels.)</small></label>
                                                <div class="col-sm-10">
                                                    <div class='col-md-3'><a class="uploadFile img btn btn-primary text-white btn-sm" data-input='logo' data-isremovable='0' data-is-multiple-uploads-allowed='0' data-toggle="modal" data-target="#media-upload-modal" value="Upload Photo"><i class='fa fa-upload'></i> Upload</a></div>
                                                                                                            <label class="text-danger mt-3">*Only Choose When Update is necessary</label>
                                                        <div class="container-fluid row image-upload-section">
                                                            <div class="col-md-3 col-sm-12 shadow p-3 mb-5 bg-white rounded m-4 text-center grow image">
                                                                <div class=''>
                                                                    <div class='upload-media-div'><img class="img-fluid mb-2" src="https://avrluxe.com/uploads/media/2021/avrluxe.jpg" alt="Image Not Found"></div>
                                                                    <input type="hidden" name="logo" id='logo' value='uploads/media/2021/avrluxe.jpg'>
                                                                </div>
                                                            </div>
                                                        </div>
                                                                                                    </div>
                                            </div>
                                            <div class="col-md-6 form-group">
                                                <label for="favicon">Favicon <span class='text-danger text-xs'>*</span></label>
                                                <div class="col-sm-10">
                                                    <div class='col-md-3'><a class="uploadFile img btn btn-primary text-white btn-sm" data-input='favicon' data-isremovable='0' data-is-multiple-uploads-allowed='0' data-toggle="modal" data-target="#media-upload-modal" value="Upload Photo"><i class='fa fa-upload'></i> Upload</a></div>
                                                                                                            <label class="text-danger mt-3">*Only Choose When Update is necessary</label>
                                                        <div class="container-fluid row image-upload-section">
                                                            <div class="col-md-3 col-sm-12 shadow p-3 mb-5 bg-white rounded m-4 text-center grow image">
                                                                <img class="img-fluid mb-2" src="https://avrluxe.com/uploads/media/2021/avrluxe.jpg" alt="Image Not Found">
                                                                <input type="hidden" name="favicon" id='favicon' value='uploads/media/2021/avrluxe.jpg'>
                                                            </div>
                                                        </div>
                                                                                                    </div>
                                            </div>
                                        </div>
                                    </div>
                                    <div class="form-group col-md-12">
                                        <label for="support_email">Meta Keywords <span class='text-danger text-xs'>*</span></label>
                                        <textarea name="meta_keywords" id="meta_keywords" class="form-control" cols="30" rows="5">AVR luxe, E-commece</textarea>
                                    </div>
                                    <div class="form-group col-md-12">
                                        <label for="support_email">Meta Description <span class='text-danger text-xs'>*</span></label>
                                        <textarea name="meta_description" id="meta_description" class="form-control" cols="30" rows="5">AVR luxe is an ecommerce platform</textarea>
                                    </div>
                                </div>
                                <hr>
                                <h4>App downlod Section</h4>
                                <div class="row">
                                    <div class="form-group col-md-12 col-sm-12">
                                        <label for="is_delivery_boy_otp_setting_on"> Enable / Disable</label>
                                        <div class="card-body">
                                            <input type="checkbox" name="app_download_section"  data-bootstrap-switch data-off-color="danger" data-on-color="success">
                                        </div>
                                    </div>
                                    <div class="form-group col-md-6">
                                        <label for="app_download_section_title">Title <span class='text-danger text-xs'>*</span></label>
                                        <input type="text" class="form-control" name="app_download_section_title" value="AVR Luxe Mobile App" placeholder="App download section title. " />
                                    </div>
                                    <div class="form-group col-md-6">
                                        <label for="app_download_section_tagline">Tagline<span class='text-danger text-xs'>*</span></label>
                                        <input type="text" class="form-control" name="app_download_section_tagline" value="Affordable Ecommerce Platform" placeholder="App download section Tagline." />
                                    </div>
                                    <div class="form-group col-md-12">
                                        <label for="app_download_section_short_description">Short Description <span class='text-danger text-xs'>*</span></label>
                                        <textarea name="app_download_section_short_description" id="app_download_section_short_description" class="form-control" cols="30" rows="5">Shop with us at affordable prices and get exciting cashback & offers.</textarea>
                                    </div>
                                    <div class="form-group col-md-6">
                                        <label for="app_download_section_title">Playstore URL <span class='text-danger text-xs'>*</span></label>
                                        <input type="text" class="form-control" name="app_download_section_playstore_url" value="https://play.google.com/" placeholder="Playstore URL. " />
                                    </div>
                                    <div class="form-group col-md-6">
                                        <label for="app_download_section_tagline">Tagline<span class='text-danger text-xs'>*</span></label>
                                        <input type="text" class="form-control" name="app_download_section_appstore_url" value="https://www.apple.com/in/app-store/" placeholder="Appstore URL." />
                                    </div>
                                </div>
                                <hr>
                                <h4>Social Media Links</h4>
                                <div class="row">
                                    <div class="form-group col-md-6">
                                        <label for="twitter_link">Twitter</label>
                                        <input type="text" class="form-control" name="twitter_link" value="https://twitter.com/" placeholder="Twitter Link" />
                                    </div>
                                    <div class="form-group col-md-6">
                                        <label for="facebook_link">Facebook</label>
                                        <input type="text" class="form-control" name="facebook_link" value="https://facebook.com/" placeholder="Facebook Link" />
                                    </div>
                                    <div class="form-group col-md-6">
                                        <label for="instagram_link">Instagram</label>
                                        <input type="text" class="form-control" name="instagram_link" value="https://instagram.com/" placeholder="Instagram Link" />
                                    </div>
                                    <div class="form-group col-md-6">
                                        <label for="youtube_link">Youtube</label>
                                        <input type="text" class="form-control" name="youtube_link" value="https://youtube.com/" placeholder="Youtube Link" />
                                    </div>
                                </div>
                                <hr>
                                <h4>Feature Section</h4>
                                <div class="row">
                                    <h4 class="h4 col-md-12">Shipping</h4>
                                    <div class="form-group col-md-2 col-sm-4">
                                        <label for="shipping_mode"> Enable / Disable</label>
                                        <div class="card-body">
                                            <input type="checkbox" name="shipping_mode"  data-bootstrap-switch data-off-color="danger" data-on-color="success">
                                        </div>
                                    </div>
                                    <div class="form-group col-md-4">
                                        <label for="shipping_title">Title</label>
                                        <input type="text" class="form-control" name="shipping_title" value="Free Shipping" placeholder="Shipping Title" />
                                    </div>
                                    <div class="form-group col-md-4">
                                        <label for="shipping_description">Description</label>
                                        <textarea name="shipping_description" class="form-control" id="shipping_description" cols="30" rows="4" placeholder="Shipping Description">Free Shipping at your door step.</textarea>
                                    </div>

                                    <h4 class="h4 col-md-12">Returns</h4>
                                    <div class="form-group col-md-2 col-sm-4">
                                        <label for="return_mode"> Enable / Disable</label>
                                        <div class="card-body">
                                            <input type="checkbox" name="return_mode" Checked data-bootstrap-switch data-off-color="danger" data-on-color="success">
                                        </div>
                                    </div>
                                    <div class="form-group col-md-4">
                                        <label for="return_title">Title</label>
                                        <input type="text" class="form-control" name="return_title" value="Free Returns" placeholder="Return Title" />
                                    </div>
                                    <div class="form-group col-md-4">
                                        <label for="return_description">Description</label>
                                        <textarea name="return_description" class="form-control" id="return_description" cols="30" rows="4" placeholder="Return Description">Free return if products are damaged.</textarea>
                                    </div>

                                    <h4 class="h4 col-md-12">Support</h4>
                                    <div class="form-group col-md-2 col-sm-4">
                                        <label for="support_mode"> Enable / Disable</label>
                                        <div class="card-body">
                                            <input type="checkbox" name="support_mode" Checked data-bootstrap-switch data-off-color="danger" data-on-color="success">
                                        </div>
                                    </div>
                                    <div class="form-group col-md-4">
                                        <label for="support_title">Title</label>
                                        <input type="text" class="form-control" name="support_title" value="Support 24/7" placeholder="Support Title" />
                                    </div>
                                    <div class="form-group col-md-4">
                                        <label for="shipping_description">Description</label>
                                        <textarea name="support_description" class="form-control" id="support_description" cols="30" rows="4" placeholder="Support Description">24/7 and 365 days support is available.</textarea>
                                    </div>

                                    <h4 class="h4 col-md-12">Safety & Security</h4>
                                    <div class="form-group col-md-2 col-sm-4">
                                        <label for="safety_security_mode"> Enable / Disable</label>
                                        <div class="card-body">
                                            <input type="checkbox" name="safety_security_mode" Checked data-bootstrap-switch data-off-color="danger" data-on-color="success">
                                        </div>
                                    </div>
                                    <div class="form-group col-md-4">
                                        <label for="safety_security_title">Title</label>
                                        <input type="text" class="form-control" name="safety_security_title" value="100% Safe & Secure" placeholder="Safety & Security Title" />
                                    </div>
                                    <div class="form-group col-md-4">
                                        <label for="safety_security_description">Description</label>
                                        <textarea name="safety_security_description" class="form-control" id="safety_security_description" cols="30" rows="4" placeholder="Safety & Security Description">100% safe & secure.</textarea>
                                    </div>

                                    <!-- Header colour -->
                                    <h4 class="h4 col-md-12">Dynamic Header Colour & Font Colour</h4>
                                    <div class="form-group col-md-2 col-sm-4">
                                        <label for="primary_color"> Primary Colour</label>
                                        <input type="text" class="coloris form-control" name="primary_color" id="primary_color" value="" />
                                    </div>
                                    <div class="form-group col-md-2 col-sm-4">
                                        <label for="secondary_color"> Secondary Colour</label>
                                        <input type="text" class="coloris form-control" name="secondary_color" id="secondary_color" value="" />
                                    </div>
                                    <div class="form-group col-md-2 col-sm-4">
                                        <label for="font_color"> Font Colour</label>
                                        <input type="text" class="coloris form-control" name="font_color" id="font_color" value="" />
                                    </div>


                                </div>
                                <div class="d-flex justify-content-center">
                                    <div class="form-group" id="error_box">
                                    </div>
                                </div>
                                <div class="form-group">
                                    <button type="reset" class="btn btn-warning">Reset</button>
                                    <button type="submit" class="btn btn-success" id="submit_btn">Update Settings</button>
                                </div>
                            </div>
                        </form>
                    </div>
                </div>
            </div>
    </section>
    
    
@endsection
