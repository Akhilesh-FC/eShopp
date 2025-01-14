@extends('admin.body.adminmaster')

@section('admin')
<div class="page-wrapper">
     <div class="container-fluid">
    <form action="{{ route('store_settings') }}" method="get"></form>
    
     <!--<div class="content-wrapper">-->
    <!-- Content Header (Page header) -->
    <!-- Main content -->
    <section class="content-header">
        <div class="container-fluid">
            <div class="row mb-2">
                <div class="col-sm-6">
                    <h4>System Settings</h4>
                </div>
                <div class="col-sm-6">
                    <ol class="breadcrumb float-sm-right">
                        <li class="breadcrumb-item"><a href="#">Home</a>
                        </li>
                        <li class="breadcrumb-item active">Products</li>
                    </ol>
                </div>
            </div>
        </div>
        <!-- /.container-fluid -->
    </section>
    <section class="content">
        <div class="container-fluid">
            <div class="row">
                <div class="col-md-12">
                    <div class="card card-info">
                        <form class="form-horizontal form-submit-event" action="#" method="POST" id="system_setting_form" enctype="multipart/form-data">
                            <input type="hidden" id="system_configurations" name="system_configurations" required="" value="1" aria-required="true">
                            <input type="hidden" id="system_timezone_gmt" name="system_timezone_gmt" value="+05:30" aria-required="true">
                            <input type="hidden" id="system_configurations_id" name="system_configurations_id" value="13" aria-required="true">
                            <div class="card-body">
                                <div class="row">
                                    <div class="form-group col-md-4">
                                        <label for="app_name">App Name <span class='text-danger text-xs'>*</span></label>
                                        <input type="text" class="form-control" name="app_name" value="Avrluxe" placeholder="Name of the App - used in whole system" />
                                    </div>
                                    <div class="form-group col-md-4">
                                        <label for="support_number">Support Number <span class='text-danger text-xs'>*</span></label>
                                        <input type="text" class="form-control" name="support_number" value="6386490030" placeholder="Customer support mobile number - used in whole system" />
                                    </div>
                                    <div class="form-group col-md-4">
                                        <label for="support_email">Support Email <span class='text-danger text-xs'>*</span></label>
                                        <input type="text" class="form-control" name="support_email" value="vandana.rbl.singh@gmail.com" placeholder="Customer support email - used in whole system" />
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
                                </div>
                                <h4>Version Settings</h4>
                                <hr>
                                <div class="row">
                                    <div class="form-group col-md-6">
                                        <label for="current_version">Current Version Of Android APP <span class='text-danger text-xs'>*</span></label>
                                        <input type="text" class="form-control" name="current_version" value="1.0.0" placeholder='Current For Version For Android APP' />
                                    </div>
                                    <div class="form-group col-md-6">
                                        <label for="current_version">Current Version Of IOS APP <span class='text-danger text-xs'>*</span></label>
                                        <input type="text" class="form-control" name="current_version_ios" value="1.0.0" placeholder='Current Version For IOS APP' />
                                    </div>
                                    <div class="form-group col-md-6">
                                        <label for="is_version_system_on">Version System Status </label>
                                        <div class="card-body">
                                            <input type="checkbox" name="is_version_system_on" Checked data-bootstrap-switch data-off-color="danger" data-on-color="success">
                                        </div>
                                    </div>
                                    <hr>
                                                                        <div class="form-group area_wise_delivery_charge col-md-6">
                                        <label for="area_wise_delivery_charge">Area Wise Delivery Charge <small>( Enable / Disable )</small></label>
                                        <div class="card-body">
                                            <input type="checkbox" name="area_wise_delivery_charge" id="area_wise_delivery_charge" value="area_wise_delivery_charge" Checked data-bootstrap-switch data-off-color="danger" data-on-color="success">
                                        </div>
                                    </div>
                                                                        <div class="form-group col-md-4 delivery_charge d-none">
                                        <label for="delivery_charge">Delivery Charge Amount (₹) <span class='text-danger text-xs'>*</span></label>
                                        <input type="number" class="form-control" name="delivery_charge" value="10" placeholder='Delivery Charge on Shopping' min='0' />
                                    </div>
                                    <div class="form-group col-md-4 min_amount d-none">
                                        <label for="min_amount">Minimum Amount for Free Delivery (₹) <span class='text-danger text-xs'>*</span>
                                        </label>
                                        <input type="number" class="form-control" name="min_amount" value="100" placeholder='Minimum Order Amount for Free Delivery' min='0' />
                                    </div>
                                    <div class="form-group col-md-6">
                                        <label class="system_timezone" for="system_timezone">System Timezone <span class='text-danger text-xs'>*</span></label>
                                        <select id="system_timezone" name="system_timezone" required class="form-control col-md-12 select2">
                                            <option value=" ">--Select Timezones--</option>
                                                                                            ?>
                                                <option value="Africa/Abidjan" data-gmt="+00:00" >Africa/Abidjan - +00:00 - 04:07:12 PM </option>
                                                                                            ?>
                                                <option value="Africa/Accra" data-gmt="+00:00" >Africa/Accra - +00:00 - 04:07:12 PM </option>
                                                                                            ?>
                                                <option value="Africa/Addis_Ababa" data-gmt="+03:00" >Africa/Addis_Ababa - +03:00 - 07:07:12 PM </option>
                                                                                            ?>
                                                <option value="Africa/Algiers" data-gmt="+01:00" >Africa/Algiers - +01:00 - 05:07:12 PM </option>
                                                                                            ?>
                                                <option value="Africa/Asmara" data-gmt="+03:00" >Africa/Asmara - +03:00 - 07:07:12 PM </option>
                                                                                            ?>
                                                <option value="Africa/Bamako" data-gmt="+00:00" >Africa/Bamako - +00:00 - 04:07:12 PM </option>
                                                                                            ?>
                                                <option value="Africa/Bangui" data-gmt="+01:00" >Africa/Bangui - +01:00 - 05:07:12 PM </option>
                                                                                            ?>
                                                <option value="Africa/Banjul" data-gmt="+00:00" >Africa/Banjul - +00:00 - 04:07:12 PM </option>
                                                                                            ?>
                                                <option value="Africa/Bissau" data-gmt="+00:00" >Africa/Bissau - +00:00 - 04:07:12 PM </option>
                                                                                            ?>
                                                <option value="Africa/Blantyre" data-gmt="+02:00" >Africa/Blantyre - +02:00 - 06:07:12 PM </option>
                                                                                            ?>
                                                <option value="Africa/Brazzaville" data-gmt="+01:00" >Africa/Brazzaville - +01:00 - 05:07:12 PM </option>
                                                                                            ?>
                                                <option value="Africa/Bujumbura" data-gmt="+02:00" >Africa/Bujumbura - +02:00 - 06:07:12 PM </option>
                                                                                            ?>
                                                <option value="Africa/Cairo" data-gmt="+02:00" >Africa/Cairo - +02:00 - 06:07:12 PM </option>
                                                                                            ?>
                                                <option value="Africa/Casablanca" data-gmt="+01:00" >Africa/Casablanca - +01:00 - 05:07:12 PM </option>
                                                                                            ?>
                                                <option value="Africa/Ceuta" data-gmt="+01:00" >Africa/Ceuta - +01:00 - 05:07:12 PM </option>
                                                                                            ?>
                                                <option value="Africa/Conakry" data-gmt="+00:00" >Africa/Conakry - +00:00 - 04:07:12 PM </option>
                                                                                            ?>
                                                <option value="Africa/Dakar" data-gmt="+00:00" >Africa/Dakar - +00:00 - 04:07:12 PM </option>
                                                                                            ?>
                                                <option value="Africa/Dar_es_Salaam" data-gmt="+03:00" >Africa/Dar_es_Salaam - +03:00 - 07:07:12 PM </option>
                                                                                            ?>
                                                <option value="Africa/Djibouti" data-gmt="+03:00" >Africa/Djibouti - +03:00 - 07:07:12 PM </option>
                                                                                            ?>
                                                <option value="Africa/Douala" data-gmt="+01:00" >Africa/Douala - +01:00 - 05:07:12 PM </option>
                                                                                            ?>
                                                <option value="Africa/El_Aaiun" data-gmt="+01:00" >Africa/El_Aaiun - +01:00 - 05:07:12 PM </option>
                                                                                            ?>
                                                <option value="Africa/Freetown" data-gmt="+00:00" >Africa/Freetown - +00:00 - 04:07:12 PM </option>
                                                                                            ?>
                                                <option value="Africa/Gaborone" data-gmt="+02:00" >Africa/Gaborone - +02:00 - 06:07:12 PM </option>
                                                                                            ?>
                                                <option value="Africa/Harare" data-gmt="+02:00" >Africa/Harare - +02:00 - 06:07:12 PM </option>
                                                                                            ?>
                                                <option value="Africa/Johannesburg" data-gmt="+02:00" >Africa/Johannesburg - +02:00 - 06:07:12 PM </option>
                                                                                            ?>
                                                <option value="Africa/Juba" data-gmt="+02:00" >Africa/Juba - +02:00 - 06:07:12 PM </option>
                                                                                            ?>
                                                <option value="Africa/Kampala" data-gmt="+03:00" >Africa/Kampala - +03:00 - 07:07:12 PM </option>
                                                                                            ?>
                                                <option value="Africa/Khartoum" data-gmt="+02:00" >Africa/Khartoum - +02:00 - 06:07:12 PM </option>
                                                                                            ?>
                                                <option value="Africa/Kigali" data-gmt="+02:00" >Africa/Kigali - +02:00 - 06:07:12 PM </option>
                                                                                            ?>
                                                <option value="Africa/Kinshasa" data-gmt="+01:00" >Africa/Kinshasa - +01:00 - 05:07:12 PM </option>
                                                                                            ?>
                                                <option value="Africa/Lagos" data-gmt="+01:00" >Africa/Lagos - +01:00 - 05:07:12 PM </option>
                                                                                            ?>
                                                <option value="Africa/Libreville" data-gmt="+01:00" >Africa/Libreville - +01:00 - 05:07:12 PM </option>
                                                                                            ?>
                                                <option value="Africa/Lome" data-gmt="+00:00" >Africa/Lome - +00:00 - 04:07:12 PM </option>
                                                                                            ?>
                                                <option value="Africa/Luanda" data-gmt="+01:00" >Africa/Luanda - +01:00 - 05:07:12 PM </option>
                                                                                            ?>
                                                <option value="Africa/Lubumbashi" data-gmt="+02:00" >Africa/Lubumbashi - +02:00 - 06:07:12 PM </option>
                                                                                            ?>
                                                <option value="Africa/Lusaka" data-gmt="+02:00" >Africa/Lusaka - +02:00 - 06:07:12 PM </option>
                                                                                            ?>
                                                <option value="Africa/Malabo" data-gmt="+01:00" >Africa/Malabo - +01:00 - 05:07:12 PM </option>
                                                                                            ?>
                                                <option value="Africa/Maputo" data-gmt="+02:00" >Africa/Maputo - +02:00 - 06:07:12 PM </option>
                                                                                            ?>
                                                <option value="Africa/Maseru" data-gmt="+02:00" >Africa/Maseru - +02:00 - 06:07:12 PM </option>
                                                                                            ?>
                                                <option value="Africa/Mbabane" data-gmt="+02:00" >Africa/Mbabane - +02:00 - 06:07:12 PM </option>
                                                                                            ?>
                                                <option value="Africa/Mogadishu" data-gmt="+03:00" >Africa/Mogadishu - +03:00 - 07:07:12 PM </option>
                                                                                            ?>
                                                <option value="Africa/Monrovia" data-gmt="+00:00" >Africa/Monrovia - +00:00 - 04:07:12 PM </option>
                                                                                            ?>
                                                <option value="Africa/Nairobi" data-gmt="+03:00" >Africa/Nairobi - +03:00 - 07:07:12 PM </option>
                                                                                            ?>
                                                <option value="Africa/Ndjamena" data-gmt="+01:00" >Africa/Ndjamena - +01:00 - 05:07:12 PM </option>
                                                                                            ?>
                                                <option value="Africa/Niamey" data-gmt="+01:00" >Africa/Niamey - +01:00 - 05:07:12 PM </option>
                                                                                            ?>
                                                <option value="Africa/Nouakchott" data-gmt="+00:00" >Africa/Nouakchott - +00:00 - 04:07:12 PM </option>
                                                                                            ?>
                                                <option value="Africa/Ouagadougou" data-gmt="+00:00" >Africa/Ouagadougou - +00:00 - 04:07:12 PM </option>
                                                                                            ?>
                                                <option value="Africa/Porto-Novo" data-gmt="+01:00" >Africa/Porto-Novo - +01:00 - 05:07:12 PM </option>
                                                                                            ?>
                                                <option value="Africa/Sao_Tome" data-gmt="+00:00" >Africa/Sao_Tome - +00:00 - 04:07:12 PM </option>
                                                                                            ?>
                                                <option value="Africa/Tripoli" data-gmt="+02:00" >Africa/Tripoli - +02:00 - 06:07:12 PM </option>
                                                                                            ?>
                                                <option value="Africa/Tunis" data-gmt="+01:00" >Africa/Tunis - +01:00 - 05:07:12 PM </option>
                                                                                            ?>
                                                <option value="Africa/Windhoek" data-gmt="+02:00" >Africa/Windhoek - +02:00 - 06:07:12 PM </option>
                                                                                            ?>
                                                <option value="America/Adak" data-gmt="-10:00" >America/Adak - -10:00 - 06:07:12 AM </option>
                                                                                            ?>
                                                <option value="America/Anchorage" data-gmt="-09:00" >America/Anchorage - -09:00 - 07:07:12 AM </option>
                                                                                            ?>
                                                <option value="America/Anguilla" data-gmt="-04:00" >America/Anguilla - -04:00 - 12:07:12 PM </option>
                                                                                            ?>
                                                <option value="America/Antigua" data-gmt="-04:00" >America/Antigua - -04:00 - 12:07:12 PM </option>
                                                                                            ?>
                                                <option value="America/Araguaina" data-gmt="-03:00" >America/Araguaina - -03:00 - 01:07:12 PM </option>
                                                                                            ?>
                                                <option value="America/Argentina/Buenos_Aires" data-gmt="-03:00" >America/Argentina/Buenos_Aires - -03:00 - 01:07:12 PM </option>
                                                                                            ?>
                                                <option value="America/Argentina/Catamarca" data-gmt="-03:00" >America/Argentina/Catamarca - -03:00 - 01:07:12 PM </option>
                                                                                            ?>
                                                                                            <option value="America/Argentina/Cordoba" data-gmt="-03:00" >America/Argentina/Cordoba - -03:00 - 01:07:12 PM </option>
                                                                                            ?>
                                                <option value="America/Argentina/Jujuy" data-gmt="-03:00" >America/Argentina/Jujuy - -03:00 - 01:07:12 PM </option>
                                                                                            ?>
                                                <option value="America/Argentina/La_Rioja" data-gmt="-03:00" >America/Argentina/La_Rioja - -03:00 - 01:07:12 PM </option>
                                                                                            ?>
                                                <option value="America/Argentina/Mendoza" data-gmt="-03:00" >America/Argentina/Mendoza - -03:00 - 01:07:12 PM </option>
                                                                                            ?>
                                                <option value="America/Argentina/Rio_Gallegos" data-gmt="-03:00" >America/Argentina/Rio_Gallegos - -03:00 - 01:07:12 PM </option>
                                                                                            ?>
                                                <option value="America/Argentina/Salta" data-gmt="-03:00" >America/Argentina/Salta - -03:00 - 01:07:12 PM </option>
                                                                                            ?>
                                                <option value="America/Argentina/San_Juan" data-gmt="-03:00" >America/Argentina/San_Juan - -03:00 - 01:07:12 PM </option>
                                                                                            ?>
                                                <option value="America/Argentina/San_Luis" data-gmt="-03:00" >America/Argentina/San_Luis - -03:00 - 01:07:12 PM </option>
                                                                                            ?>
                                                <option value="America/Argentina/Tucuman" data-gmt="-03:00" >America/Argentina/Tucuman - -03:00 - 01:07:12 PM </option>
                                                                                            ?>
                                                <option value="America/Argentina/Ushuaia" data-gmt="-03:00" >America/Argentina/Ushuaia - -03:00 - 01:07:12 PM </option>
                                                                                            ?>
                                                <option value="America/Aruba" data-gmt="-04:00" >America/Aruba - -04:00 - 12:07:12 PM </option>
                                                                                            ?>
                                                <option value="America/Asuncion" data-gmt="-03:00" >America/Asuncion - -03:00 - 01:07:12 PM </option>
                                                                                            ?>
                                                <option value="America/Atikokan" data-gmt="-05:00" >America/Atikokan - -05:00 - 11:07:12 AM </option>
                                                                                            ?>
                                                <option value="America/Bahia" data-gmt="-03:00" >America/Bahia - -03:00 - 01:07:12 PM </option>
                                                                                            ?>
                                                <option value="America/Bahia_Banderas" data-gmt="-06:00" >America/Bahia_Banderas - -06:00 - 10:07:12 AM </option>
                                                                                            ?>
                                                <option value="America/Barbados" data-gmt="-04:00" >America/Barbados - -04:00 - 12:07:12 PM </option>
                                                                                            ?>
                                                <option value="America/Belem" data-gmt="-03:00" >America/Belem - -03:00 - 01:07:12 PM </option>
                                                                                            ?>
                                                <option value="America/Belize" data-gmt="-06:00" >America/Belize - -06:00 - 10:07:12 AM </option>
                                                                                            ?>
                                                <option value="America/Blanc-Sablon" data-gmt="-04:00" >America/Blanc-Sablon - -04:00 - 12:07:12 PM </option>
                                                                                            ?>
                                                <option value="America/Boa_Vista" data-gmt="-04:00" >America/Boa_Vista - -04:00 - 12:07:12 PM </option>
                                                                                            ?>
                                                <option value="America/Bogota" data-gmt="-05:00" >America/Bogota - -05:00 - 11:07:12 AM </option>
                                                                                            ?>
                                                <option value="America/Boise" data-gmt="-07:00" >America/Boise - -07:00 - 09:07:12 AM </option>
                                                                                            ?>
                                                <option value="America/Cambridge_Bay" data-gmt="-07:00" >America/Cambridge_Bay - -07:00 - 09:07:12 AM </option>
                                                                                            ?>
                                                <option value="America/Campo_Grande" data-gmt="-04:00" >America/Campo_Grande - -04:00 - 12:07:12 PM </option>
                                                                                            ?>
                                                <option value="America/Cancun" data-gmt="-05:00" >America/Cancun - -05:00 - 11:07:12 AM </option>
                                                                                            ?>
                                                <option value="America/Caracas" data-gmt="-04:00" >America/Caracas - -04:00 - 12:07:12 PM </option>
                                                                                            ?>
                                                <option value="America/Cayenne" data-gmt="-03:00" >America/Cayenne - -03:00 - 01:07:12 PM </option>
                                                                                            ?>
                                                <option value="America/Cayman" data-gmt="-05:00" >America/Cayman - -05:00 - 11:07:12 AM </option>
                                                                                            ?>
                                                <option value="America/Chicago" data-gmt="-06:00" >America/Chicago - -06:00 - 10:07:12 AM </option>
                                                                                            ?>
                                                <option value="America/Chihuahua" data-gmt="-07:00" >America/Chihuahua - -07:00 - 09:07:12 AM </option>
                                                                                            ?>
                                                <option value="America/Costa_Rica" data-gmt="-06:00" >America/Costa_Rica - -06:00 - 10:07:12 AM </option>
                                                                                            ?>
                                                <option value="America/Creston" data-gmt="-07:00" >America/Creston - -07:00 - 09:07:12 AM </option>
                                                                                            ?>
                                                <option value="America/Cuiaba" data-gmt="-04:00" >America/Cuiaba - -04:00 - 12:07:12 PM </option>
                                                                                            ?>
                                                <option value="America/Curacao" data-gmt="-04:00" >America/Curacao - -04:00 - 12:07:12 PM </option>
                                                                                            ?>
                                                <option value="America/Danmarkshavn" data-gmt="+00:00" >America/Danmarkshavn - +00:00 - 04:07:12 PM </option>
                                                                                            ?>
                                                <option value="America/Dawson" data-gmt="-07:00" >America/Dawson - -07:00 - 09:07:12 AM </option>
                                                                                            ?>
                                                <option value="America/Dawson_Creek" data-gmt="-07:00" >America/Dawson_Creek - -07:00 - 09:07:12 AM </option>
                                                                                            ?>
                                                <option value="America/Denver" data-gmt="-07:00" >America/Denver - -07:00 - 09:07:12 AM </option>
                                                                                            ?>
                                                <option value="America/Detroit" data-gmt="-05:00" >America/Detroit - -05:00 - 11:07:12 AM </option>
                                                                                            ?>
                                                <option value="America/Dominica" data-gmt="-04:00" >America/Dominica - -04:00 - 12:07:12 PM </option>
                                                                                            ?>
                                                <option value="America/Edmonton" data-gmt="-07:00" >America/Edmonton - -07:00 - 09:07:12 AM </option>
                                                                                            ?>
                                                <option value="America/Eirunepe" data-gmt="-05:00" >America/Eirunepe - -05:00 - 11:07:12 AM </option>
                                                                                            ?>
                                                <option value="America/El_Salvador" data-gmt="-06:00" >America/El_Salvador - -06:00 - 10:07:12 AM </option>
                                                                                            ?>
                                                <option value="America/Fort_Nelson" data-gmt="-07:00" >America/Fort_Nelson - -07:00 - 09:07:12 AM </option>
                                                                                            ?>
                                                <option value="America/Fortaleza" data-gmt="-03:00" >America/Fortaleza - -03:00 - 01:07:12 PM </option>
                                                                                            ?>
                                                <option value="America/Glace_Bay" data-gmt="-04:00" >America/Glace_Bay - -04:00 - 12:07:12 PM </option>
                                                                                            ?>
                                                <option value="America/Goose_Bay" data-gmt="-04:00" >America/Goose_Bay - -04:00 - 12:07:12 PM </option>
                                                                                            ?>
                                                <option value="America/Grand_Turk" data-gmt="-05:00" >America/Grand_Turk - -05:00 - 11:07:12 AM </option>
                                                                                            ?>
                                                <option value="America/Grenada" data-gmt="-04:00" >America/Grenada - -04:00 - 12:07:12 PM </option>
                                                                                            ?>
                                                <option value="America/Guadeloupe" data-gmt="-04:00" >America/Guadeloupe - -04:00 - 12:07:12 PM </option>
                                                                                            ?>
                                                <option value="America/Guatemala" data-gmt="-06:00" >America/Guatemala - -06:00 - 10:07:12 AM </option>
                                                                                            ?>
                                                <option value="America/Guayaquil" data-gmt="-05:00" >America/Guayaquil - -05:00 - 11:07:12 AM </option>
                                                                                            ?>
                                                <option value="America/Guyana" data-gmt="-04:00" >America/Guyana - -04:00 - 12:07:12 PM </option>
                                                                                            ?>
                                                <option value="America/Halifax" data-gmt="-04:00" >America/Halifax - -04:00 - 12:07:12 PM </option>
                                                                                            ?>
                                                <option value="America/Havana" data-gmt="-05:00" >America/Havana - -05:00 - 11:07:12 AM </option>
                                                                                            ?>
                                                <option value="America/Hermosillo" data-gmt="-07:00" >America/Hermosillo - -07:00 - 09:07:12 AM </option>
                                                                                            ?>
                                                <option value="America/Indiana/Indianapolis" data-gmt="-05:00" >America/Indiana/Indianapolis - -05:00 - 11:07:12 AM </option>
                                                                                            ?>
                                                <option value="America/Indiana/Knox" data-gmt="-06:00" >America/Indiana/Knox - -06:00 - 10:07:12 AM </option>
                                                                                            ?>
                                                <option value="America/Indiana/Marengo" data-gmt="-05:00" >America/Indiana/Marengo - -05:00 - 11:07:12 AM </option>
                                                                                            ?>
                                                <option value="America/Indiana/Petersburg" data-gmt="-05:00" >America/Indiana/Petersburg - -05:00 - 11:07:12 AM </option>
                                                                                            ?>
                                                <option value="America/Indiana/Tell_City" data-gmt="-06:00" >America/Indiana/Tell_City - -06:00 - 10:07:12 AM </option>
                                                                                            ?>
                                                <option value="America/Indiana/Vevay" data-gmt="-05:00" >America/Indiana/Vevay - -05:00 - 11:07:12 AM </option>
                                                                                            ?>
                                                <option value="America/Indiana/Vincennes" data-gmt="-05:00" >America/Indiana/Vincennes - -05:00 - 11:07:12 AM </option>
                                                                                            ?>
                                                <option value="America/Indiana/Winamac" data-gmt="-05:00" >America/Indiana/Winamac - -05:00 - 11:07:12 AM </option>
                                                                                            ?>
                                                <option value="America/Inuvik" data-gmt="-07:00" >America/Inuvik - -07:00 - 09:07:12 AM </option>
                                                                                            ?>
                                                <option value="America/Iqaluit" data-gmt="-05:00" >America/Iqaluit - -05:00 - 11:07:12 AM </option>
                                                                                            ?>
                                                <option value="America/Jamaica" data-gmt="-05:00" >America/Jamaica - -05:00 - 11:07:12 AM </option>
                                                                                            ?>
                                                <option value="America/Juneau" data-gmt="-09:00" >America/Juneau - -09:00 - 07:07:12 AM </option>
                                                                                            ?>
                                                <option value="America/Kentucky/Louisville" data-gmt="-05:00" >America/Kentucky/Louisville - -05:00 - 11:07:12 AM </option>
                                                                                            ?>
                                                <option value="America/Kentucky/Monticello" data-gmt="-05:00" >America/Kentucky/Monticello - -05:00 - 11:07:12 AM </option>
                                                                                            ?>
                                                <option value="America/Kralendijk" data-gmt="-04:00" >America/Kralendijk - -04:00 - 12:07:12 PM </option>
                                                                                            ?>
                                                <option value="America/La_Paz" data-gmt="-04:00" >America/La_Paz - -04:00 - 12:07:12 PM </option>
                                                                                            ?>
                                                <option value="America/Lima" data-gmt="-05:00" >America/Lima - -05:00 - 11:07:12 AM </option>
                                                                                            ?>
                                                <option value="America/Los_Angeles" data-gmt="-08:00" >America/Los_Angeles - -08:00 - 08:07:12 AM </option>
                                                                                            ?>
                                                <option value="America/Lower_Princes" data-gmt="-04:00" >America/Lower_Princes - -04:00 - 12:07:12 PM </option>
                                                                                            ?>
                                                <option value="America/Maceio" data-gmt="-03:00" >America/Maceio - -03:00 - 01:07:12 PM </option>
                                                                                            ?>
                                                <option value="America/Managua" data-gmt="-06:00" >America/Managua - -06:00 - 10:07:12 AM </option>
                                                                                            ?>
                                                <option value="America/Manaus" data-gmt="-04:00" >America/Manaus - -04:00 - 12:07:12 PM </option>
                                                                                            ?>
                                                <option value="America/Marigot" data-gmt="-04:00" >America/Marigot - -04:00 - 12:07:12 PM </option>
                                                                                            ?>
                                                <option value="America/Martinique" data-gmt="-04:00" >America/Martinique - -04:00 - 12:07:12 PM </option>
                                                                                            ?>
                                                <option value="America/Matamoros" data-gmt="-06:00" >America/Matamoros - -06:00 - 10:07:12 AM </option>
                                                                                            ?>
                                                <option value="America/Mazatlan" data-gmt="-07:00" >America/Mazatlan - -07:00 - 09:07:12 AM </option>
                                                                                            ?>
                                                <option value="America/Menominee" data-gmt="-06:00" >America/Menominee - -06:00 - 10:07:12 AM </option>
                                                                                            ?>
                                                <option value="America/Merida" data-gmt="-06:00" >America/Merida - -06:00 - 10:07:12 AM </option>
                                                                                            ?>
                                                <option value="America/Metlakatla" data-gmt="-09:00" >America/Metlakatla - -09:00 - 07:07:12 AM </option>
                                                                                            ?>
                                                <option value="America/Mexico_City" data-gmt="-06:00" >America/Mexico_City - -06:00 - 10:07:12 AM </option>
                                                                                            ?>
                                                <option value="America/Miquelon" data-gmt="-03:00" >America/Miquelon - -03:00 - 01:07:12 PM </option>
                                                                                            ?>
                                                <option value="America/Moncton" data-gmt="-04:00" >America/Moncton - -04:00 - 12:07:12 PM </option>
                                                                                            ?>
                                                <option value="America/Monterrey" data-gmt="-06:00" >America/Monterrey - -06:00 - 10:07:12 AM </option>
                                                                                            ?>
                                                <option value="America/Montevideo" data-gmt="-03:00" >America/Montevideo - -03:00 - 01:07:12 PM </option>
                                                                                            ?>
                                                <option value="America/Montserrat" data-gmt="-04:00" >America/Montserrat - -04:00 - 12:07:12 PM </option>
                                                                                            ?>
                                                <option value="America/Nassau" data-gmt="-05:00" >America/Nassau - -05:00 - 11:07:12 AM </option>
                                                                                            ?>
                                                <option value="America/New_York" data-gmt="-05:00" >America/New_York - -05:00 - 11:07:12 AM </option>
                                                                                            ?>
                                                <option value="America/Nipigon" data-gmt="-05:00" >America/Nipigon - -05:00 - 11:07:12 AM </option>
                                                                                            ?>
                                                <option value="America/Nome" data-gmt="-09:00" >America/Nome - -09:00 - 07:07:12 AM </option>
                                                                                            ?>
                                                <option value="America/Noronha" data-gmt="-02:00" >America/Noronha - -02:00 - 02:07:12 PM </option>
                                                                                            ?>
                                                <option value="America/North_Dakota/Beulah" data-gmt="-06:00" >America/North_Dakota/Beulah - -06:00 - 10:07:12 AM </option>
                                                                                            ?>
                                                <option value="America/North_Dakota/Center" data-gmt="-06:00" >America/North_Dakota/Center - -06:00 - 10:07:12 AM </option>
                                                                                            ?>
                                                <option value="America/North_Dakota/New_Salem" data-gmt="-06:00" >America/North_Dakota/New_Salem - -06:00 - 10:07:12 AM </option>
                                                                                            ?>
                                                <option value="America/Nuuk" data-gmt="-03:00" >America/Nuuk - -03:00 - 01:07:12 PM </option>
                                                                                            ?>
                                                <option value="America/Ojinaga" data-gmt="-07:00" >America/Ojinaga - -07:00 - 09:07:12 AM </option>
                                                                                            ?>
                                                <option value="America/Panama" data-gmt="-05:00" >America/Panama - -05:00 - 11:07:12 AM </option>
                                                                                            ?>
                                                <option value="America/Pangnirtung" data-gmt="-05:00" >America/Pangnirtung - -05:00 - 11:07:12 AM </option>
                                                                                            ?>
                                                <option value="America/Paramaribo" data-gmt="-03:00" >America/Paramaribo - -03:00 - 01:07:12 PM </option>
                                                                                            ?>
                                                <option value="America/Phoenix" data-gmt="-07:00" >America/Phoenix - -07:00 - 09:07:12 AM </option>
                                                                                            ?>
                                                <option value="America/Port-au-Prince" data-gmt="-05:00" >America/Port-au-Prince - -05:00 - 11:07:12 AM </option>
                                                                                            ?>
                                                <option value="America/Port_of_Spain" data-gmt="-04:00" >America/Port_of_Spain - -04:00 - 12:07:12 PM </option>
                                                                                            ?>
                                                <option value="America/Porto_Velho" data-gmt="-04:00" >America/Porto_Velho - -04:00 - 12:07:12 PM </option>
                                                                                            ?>
                                                <option value="America/Puerto_Rico" data-gmt="-04:00" >America/Puerto_Rico - -04:00 - 12:07:12 PM </option>
                                                                                            ?>
                                                <option value="America/Punta_Arenas" data-gmt="-03:00" >America/Punta_Arenas - -03:00 - 01:07:12 PM </option>
                                                                                            ?>
                                                <option value="America/Rainy_River" data-gmt="-06:00" >America/Rainy_River - -06:00 - 10:07:12 AM </option>
                                                                                            ?>
                                                <option value="America/Rankin_Inlet" data-gmt="-06:00" >America/Rankin_Inlet - -06:00 - 10:07:12 AM </option>
                                                                                            ?>
                                                <option value="America/Recife" data-gmt="-03:00" >America/Recife - -03:00 - 01:07:12 PM </option>
                                                                                            ?>
                                                <option value="America/Regina" data-gmt="-06:00" >America/Regina - -06:00 - 10:07:12 AM </option>
                                                                                            ?>
                                                <option value="America/Resolute" data-gmt="-06:00" >America/Resolute - -06:00 - 10:07:12 AM </option>
                                                                                            ?>
                                                <option value="America/Rio_Branco" data-gmt="-05:00" >America/Rio_Branco - -05:00 - 11:07:12 AM </option>
                                                                                            ?>
                                                <option value="America/Santarem" data-gmt="-03:00" >America/Santarem - -03:00 - 01:07:12 PM </option>
                                                                                            ?>
                                                <option value="America/Santiago" data-gmt="-03:00" >America/Santiago - -03:00 - 01:07:12 PM </option>
                                                                                            ?>
                                                <option value="America/Santo_Domingo" data-gmt="-04:00" >America/Santo_Domingo - -04:00 - 12:07:12 PM </option>
                                                                                            ?>
                                                <option value="America/Sao_Paulo" data-gmt="-03:00" >America/Sao_Paulo - -03:00 - 01:07:12 PM </option>
                                                                                            ?>
                                                <option value="America/Scoresbysund" data-gmt="-01:00" >America/Scoresbysund - -01:00 - 03:07:12 PM </option>
                                                                                            ?>
                                                <option value="America/Sitka" data-gmt="-09:00" >America/Sitka - -09:00 - 07:07:12 AM </option>
                                                                                            ?>
                                                <option value="America/St_Barthelemy" data-gmt="-04:00" >America/St_Barthelemy - -04:00 - 12:07:12 PM </option>
                                                                                            ?>
                                                <option value="America/St_Johns" data-gmt="-03:30" >America/St_Johns - -03:30 - 12:37:12 PM </option>
                                                                                            ?>
                                                <option value="America/St_Kitts" data-gmt="-04:00" >America/St_Kitts - -04:00 - 12:07:12 PM </option>
                                                                                            ?>
                                                <option value="America/St_Lucia" data-gmt="-04:00" >America/St_Lucia - -04:00 - 12:07:12 PM </option>
                                                                                            ?>
                                                <option value="America/St_Thomas" data-gmt="-04:00" >America/St_Thomas - -04:00 - 12:07:12 PM </option>
                                                                                            ?>
                                                <option value="America/St_Vincent" data-gmt="-04:00" >America/St_Vincent - -04:00 - 12:07:12 PM </option>
                                                                                            ?>
                                                <option value="America/Swift_Current" data-gmt="-06:00" >America/Swift_Current - -06:00 - 10:07:12 AM </option>
                                                                                            ?>
                                                <option value="America/Tegucigalpa" data-gmt="-06:00" >America/Tegucigalpa - -06:00 - 10:07:12 AM </option>
                                                                                            ?>
                                                <option value="America/Thule" data-gmt="-04:00" >America/Thule - -04:00 - 12:07:12 PM </option>
                                                                                            ?>
                                                <option value="America/Thunder_Bay" data-gmt="-05:00" >America/Thunder_Bay - -05:00 - 11:07:12 AM </option>
                                                                                            ?>
                                                <option value="America/Tijuana" data-gmt="-08:00" >America/Tijuana - -08:00 - 08:07:12 AM </option>
                                                                                            ?>
                                                <option value="America/Toronto" data-gmt="-05:00" >America/Toronto - -05:00 - 11:07:12 AM </option>
                                                                                            ?>
                                                <option value="America/Tortola" data-gmt="-04:00" >America/Tortola - -04:00 - 12:07:12 PM </option>
                                                                                            ?>
                                                <option value="America/Vancouver" data-gmt="-08:00" >America/Vancouver - -08:00 - 08:07:12 AM </option>
                                                                                            ?>
                                                <option value="America/Whitehorse" data-gmt="-07:00" >America/Whitehorse - -07:00 - 09:07:12 AM </option>
                                                                                            ?>
                                                <option value="America/Winnipeg" data-gmt="-06:00" >America/Winnipeg - -06:00 - 10:07:12 AM </option>
                                                                                            ?>
                                                <option value="America/Yakutat" data-gmt="-09:00" >America/Yakutat - -09:00 - 07:07:12 AM </option>
                                                                                            ?>
                                                <option value="America/Yellowknife" data-gmt="-07:00" >America/Yellowknife - -07:00 - 09:07:12 AM </option>
                                                                                            ?>
                                                <option value="Antarctica/Casey" data-gmt="+11:00" >Antarctica/Casey - +11:00 - 03:07:12 AM </option>
                                                                                            ?>
                                                <option value="Antarctica/Davis" data-gmt="+07:00" >Antarctica/Davis - +07:00 - 11:07:12 PM </option>
                                                                                            ?>
                                                <option value="Antarctica/DumontDUrville" data-gmt="+10:00" >Antarctica/DumontDUrville - +10:00 - 02:07:12 AM </option>
                                                                                            ?>
                                                <option value="Antarctica/Macquarie" data-gmt="+11:00" >Antarctica/Macquarie - +11:00 - 03:07:12 AM </option>
                                                                                            ?>
                                                <option value="Antarctica/Mawson" data-gmt="+05:00" >Antarctica/Mawson - +05:00 - 09:07:12 PM </option>
                                                                                            ?>
                                                <option value="Antarctica/McMurdo" data-gmt="+13:00" >Antarctica/McMurdo - +13:00 - 05:07:12 AM </option>
                                                                                            ?>
                                                <option value="Antarctica/Palmer" data-gmt="-03:00" >Antarctica/Palmer - -03:00 - 01:07:12 PM </option>
                                                                                            ?>
                                                <option value="Antarctica/Rothera" data-gmt="-03:00" >Antarctica/Rothera - -03:00 - 01:07:12 PM </option>
                                                                                            ?>
                                                <option value="Antarctica/Syowa" data-gmt="+03:00" >Antarctica/Syowa - +03:00 - 07:07:12 PM </option>
                                                                                            ?>
                                                <option value="Antarctica/Troll" data-gmt="+00:00" >Antarctica/Troll - +00:00 - 04:07:12 PM </option>
                                                                                            ?>
                                                <option value="Antarctica/Vostok" data-gmt="+06:00" >Antarctica/Vostok - +06:00 - 10:07:12 PM </option>
                                                                                            ?>
                                                <option value="Arctic/Longyearbyen" data-gmt="+01:00" >Arctic/Longyearbyen - +01:00 - 05:07:12 PM </option>
                                                                                            ?>
                                                <option value="Asia/Aden" data-gmt="+03:00" >Asia/Aden - +03:00 - 07:07:12 PM </option>
                                                                                            ?>
                                                <option value="Asia/Almaty" data-gmt="+06:00" >Asia/Almaty - +06:00 - 10:07:12 PM </option>
                                                                                            ?>
                                                <option value="Asia/Amman" data-gmt="+02:00" >Asia/Amman - +02:00 - 06:07:12 PM </option>
                                                                                            ?>
                                                <option value="Asia/Anadyr" data-gmt="+12:00" >Asia/Anadyr - +12:00 - 04:07:12 AM </option>
                                                                                            ?>
                                                <option value="Asia/Aqtau" data-gmt="+05:00" >Asia/Aqtau - +05:00 - 09:07:12 PM </option>
                                                                                            ?>
                                                <option value="Asia/Aqtobe" data-gmt="+05:00" >Asia/Aqtobe - +05:00 - 09:07:12 PM </option>
                                                                                            ?>
                                                <option value="Asia/Ashgabat" data-gmt="+05:00" >Asia/Ashgabat - +05:00 - 09:07:12 PM </option>
                                                                                            ?>
                                                <option value="Asia/Atyrau" data-gmt="+05:00" >Asia/Atyrau - +05:00 - 09:07:12 PM </option>
                                                                                            ?>
                                                <option value="Asia/Baghdad" data-gmt="+03:00" >Asia/Baghdad - +03:00 - 07:07:12 PM </option>
                                                                                            ?>
                                                <option value="Asia/Bahrain" data-gmt="+03:00" >Asia/Bahrain - +03:00 - 07:07:12 PM </option>
                                                                                            ?>
                                                <option value="Asia/Baku" data-gmt="+04:00" >Asia/Baku - +04:00 - 08:07:12 PM </option>
                                                                                            ?>
                                                <option value="Asia/Bangkok" data-gmt="+07:00" >Asia/Bangkok - +07:00 - 11:07:12 PM </option>
                                                                                            ?>
                                                <option value="Asia/Barnaul" data-gmt="+07:00" >Asia/Barnaul - +07:00 - 11:07:12 PM </option>
                                                                                            ?>
                                                <option value="Asia/Beirut" data-gmt="+02:00" >Asia/Beirut - +02:00 - 06:07:12 PM </option>
                                                                                            ?>
                                                <option value="Asia/Bishkek" data-gmt="+06:00" >Asia/Bishkek - +06:00 - 10:07:12 PM </option>
                                                                                            ?>
                                                <option value="Asia/Brunei" data-gmt="+08:00" >Asia/Brunei - +08:00 - 12:07:12 AM </option>
                                                                                            ?>
                                                <option value="Asia/Chita" data-gmt="+09:00" >Asia/Chita - +09:00 - 01:07:12 AM </option>
                                                                                            ?>
                                                <option value="Asia/Choibalsan" data-gmt="+08:00" >Asia/Choibalsan - +08:00 - 12:07:12 AM </option>
                                                                                            ?>
                                                <option value="Asia/Colombo" data-gmt="+05:30" >Asia/Colombo - +05:30 - 09:37:12 PM </option>
                                                                                            ?>
                                                <option value="Asia/Damascus" data-gmt="+02:00" >Asia/Damascus - +02:00 - 06:07:12 PM </option>
                                                                                            ?>
                                                <option value="Asia/Dhaka" data-gmt="+06:00" >Asia/Dhaka - +06:00 - 10:07:12 PM </option>
                                                                                            ?>
                                                <option value="Asia/Dili" data-gmt="+09:00" >Asia/Dili - +09:00 - 01:07:12 AM </option>
                                                                                            ?>
                                                <option value="Asia/Dubai" data-gmt="+04:00" >Asia/Dubai - +04:00 - 08:07:12 PM </option>
                                                                                            ?>
                                                <option value="Asia/Dushanbe" data-gmt="+05:00" >Asia/Dushanbe - +05:00 - 09:07:12 PM </option>
                                                                                            ?>
                                                <option value="Asia/Famagusta" data-gmt="+02:00" >Asia/Famagusta - +02:00 - 06:07:12 PM </option>
                                                                                            ?>
                                                <option value="Asia/Gaza" data-gmt="+02:00" >Asia/Gaza - +02:00 - 06:07:12 PM </option>
                                                                                            ?>
                                                <option value="Asia/Hebron" data-gmt="+02:00" >Asia/Hebron - +02:00 - 06:07:12 PM </option>
                                                                                            ?>
                                                <option value="Asia/Ho_Chi_Minh" data-gmt="+07:00" >Asia/Ho_Chi_Minh - +07:00 - 11:07:12 PM </option>
                                                                                            ?>
                                                <option value="Asia/Hong_Kong" data-gmt="+08:00" >Asia/Hong_Kong - +08:00 - 12:07:12 AM </option>
                                                                                            ?>
                                                <option value="Asia/Hovd" data-gmt="+07:00" >Asia/Hovd - +07:00 - 11:07:12 PM </option>
                                                                                            ?>
                                                <option value="Asia/Irkutsk" data-gmt="+08:00" >Asia/Irkutsk - +08:00 - 12:07:12 AM </option>
                                                                                            ?>
                                                <option value="Asia/Jakarta" data-gmt="+07:00" >Asia/Jakarta - +07:00 - 11:07:12 PM </option>
                                                                                            ?>
                                                <option value="Asia/Jayapura" data-gmt="+09:00" >Asia/Jayapura - +09:00 - 01:07:12 AM </option>
                                                                                            ?>
                                                <option value="Asia/Jerusalem" data-gmt="+02:00" >Asia/Jerusalem - +02:00 - 06:07:12 PM </option>
                                                                                            ?>
                                                <option value="Asia/Kabul" data-gmt="+04:30" >Asia/Kabul - +04:30 - 08:37:12 PM </option>
                                                                                            ?>
                                                <option value="Asia/Kamchatka" data-gmt="+12:00" >Asia/Kamchatka - +12:00 - 04:07:12 AM </option>
                                                                                            ?>
                                                <option value="Asia/Karachi" data-gmt="+05:00" >Asia/Karachi - +05:00 - 09:07:12 PM </option>
                                                                                            ?>
                                                <option value="Asia/Kathmandu" data-gmt="+05:45" >Asia/Kathmandu - +05:45 - 09:52:12 PM </option>
                                                                                            ?>
                                                <option value="Asia/Khandyga" data-gmt="+09:00" >Asia/Khandyga - +09:00 - 01:07:12 AM </option>
                                                                                            ?>
                                                <option value="Asia/Kolkata" data-gmt="+05:30" selected>Asia/Kolkata - +05:30 - 09:37:12 PM </option>
                                                                                            ?>
                                                <option value="Asia/Krasnoyarsk" data-gmt="+07:00" >Asia/Krasnoyarsk - +07:00 - 11:07:12 PM </option>
                                                                                            ?>
                                                <option value="Asia/Kuala_Lumpur" data-gmt="+08:00" >Asia/Kuala_Lumpur - +08:00 - 12:07:12 AM </option>
                                                                                            ?>
                                                <option value="Asia/Kuching" data-gmt="+08:00" >Asia/Kuching - +08:00 - 12:07:12 AM </option>
                                                                                            ?>
                                                <option value="Asia/Kuwait" data-gmt="+03:00" >Asia/Kuwait - +03:00 - 07:07:12 PM </option>
                                                                                            ?>
                                                <option value="Asia/Macau" data-gmt="+08:00" >Asia/Macau - +08:00 - 12:07:12 AM </option>
                                                                                            ?>
                                                <option value="Asia/Magadan" data-gmt="+11:00" >Asia/Magadan - +11:00 - 03:07:12 AM </option>
                                                                                            ?>
                                                <option value="Asia/Makassar" data-gmt="+08:00" >Asia/Makassar - +08:00 - 12:07:12 AM </option>
                                                                                            ?>
                                                <option value="Asia/Manila" data-gmt="+08:00" >Asia/Manila - +08:00 - 12:07:12 AM </option>
                                                                                            ?>
                                                <option value="Asia/Muscat" data-gmt="+04:00" >Asia/Muscat - +04:00 - 08:07:12 PM </option>
                                                                                            ?>
                                                <option value="Asia/Nicosia" data-gmt="+02:00" >Asia/Nicosia - +02:00 - 06:07:12 PM </option>
                                                                                            ?>
                                                <option value="Asia/Novokuznetsk" data-gmt="+07:00" >Asia/Novokuznetsk - +07:00 - 11:07:12 PM </option>
                                                                                            ?>
                                                <option value="Asia/Novosibirsk" data-gmt="+07:00" >Asia/Novosibirsk - +07:00 - 11:07:12 PM </option>
                                                                                            ?>
                                                <option value="Asia/Omsk" data-gmt="+06:00" >Asia/Omsk - +06:00 - 10:07:12 PM </option>
                                                                                            ?>
                                                <option value="Asia/Oral" data-gmt="+05:00" >Asia/Oral - +05:00 - 09:07:12 PM </option>
                                                                                            ?>
                                                <option value="Asia/Phnom_Penh" data-gmt="+07:00" >Asia/Phnom_Penh - +07:00 - 11:07:12 PM </option>
                                                                                            ?>
                                                <option value="Asia/Pontianak" data-gmt="+07:00" >Asia/Pontianak - +07:00 - 11:07:12 PM </option>
                                                                                            ?>
                                                <option value="Asia/Pyongyang" data-gmt="+09:00" >Asia/Pyongyang - +09:00 - 01:07:12 AM </option>
                                                                                            ?>
                                                <option value="Asia/Qatar" data-gmt="+03:00" >Asia/Qatar - +03:00 - 07:07:12 PM </option>
                                                                                            ?>
                                                <option value="Asia/Qostanay" data-gmt="+06:00" >Asia/Qostanay - +06:00 - 10:07:12 PM </option>
                                                                                            ?>
                                                <option value="Asia/Qyzylorda" data-gmt="+05:00" >Asia/Qyzylorda - +05:00 - 09:07:12 PM </option>
                                                                                            ?>
                                                <option value="Asia/Riyadh" data-gmt="+03:00" >Asia/Riyadh - +03:00 - 07:07:12 PM </option>
                                                                                            ?>
                                                <option value="Asia/Sakhalin" data-gmt="+11:00" >Asia/Sakhalin - +11:00 - 03:07:12 AM </option>
                                                                                            ?>
                                                <option value="Asia/Samarkand" data-gmt="+05:00" >Asia/Samarkand - +05:00 - 09:07:12 PM </option>
                                                                                            ?>
                                                <option value="Asia/Seoul" data-gmt="+09:00" >Asia/Seoul - +09:00 - 01:07:12 AM </option>
                                                                                            ?>
                                                <option value="Asia/Shanghai" data-gmt="+08:00" >Asia/Shanghai - +08:00 - 12:07:12 AM </option>
                                                                                            ?>
                                                <option value="Asia/Singapore" data-gmt="+08:00" >Asia/Singapore - +08:00 - 12:07:12 AM </option>
                                                                                            ?>
                                                <option value="Asia/Srednekolymsk" data-gmt="+11:00" >Asia/Srednekolymsk - +11:00 - 03:07:12 AM </option>
                                                                                            ?>
                                                <option value="Asia/Taipei" data-gmt="+08:00" >Asia/Taipei - +08:00 - 12:07:12 AM </option>
                                                                                            ?>
                                                <option value="Asia/Tashkent" data-gmt="+05:00" >Asia/Tashkent - +05:00 - 09:07:12 PM </option>
                                                                                            ?>
                                                <option value="Asia/Tbilisi" data-gmt="+04:00" >Asia/Tbilisi - +04:00 - 08:07:12 PM </option>
                                                                                            ?>
                                                <option value="Asia/Tehran" data-gmt="+03:30" >Asia/Tehran - +03:30 - 07:37:12 PM </option>
                                                                                            ?>
                                                <option value="Asia/Thimphu" data-gmt="+06:00" >Asia/Thimphu - +06:00 - 10:07:12 PM </option>
                                                                                            ?>
                                                <option value="Asia/Tokyo" data-gmt="+09:00" >Asia/Tokyo - +09:00 - 01:07:12 AM </option>
                                                                                            ?>
                                                <option value="Asia/Tomsk" data-gmt="+07:00" >Asia/Tomsk - +07:00 - 11:07:12 PM </option>
                                                                                            ?>
                                                <option value="Asia/Ulaanbaatar" data-gmt="+08:00" >Asia/Ulaanbaatar - +08:00 - 12:07:12 AM </option>
                                                                                            ?>
                                                <option value="Asia/Urumqi" data-gmt="+06:00" >Asia/Urumqi - +06:00 - 10:07:12 PM </option>
                                                                                            ?>
                                                <option value="Asia/Ust-Nera" data-gmt="+10:00" >Asia/Ust-Nera - +10:00 - 02:07:12 AM </option>
                                                                                            ?>
                                                <option value="Asia/Vientiane" data-gmt="+07:00" >Asia/Vientiane - +07:00 - 11:07:12 PM </option>
                                                                                            ?>
                                                <option value="Asia/Vladivostok" data-gmt="+10:00" >Asia/Vladivostok - +10:00 - 02:07:12 AM </option>
                                                                                            ?>
                                                <option value="Asia/Yakutsk" data-gmt="+09:00" >Asia/Yakutsk - +09:00 - 01:07:12 AM </option>
                                                                                            ?>
                                                <option value="Asia/Yangon" data-gmt="+06:30" >Asia/Yangon - +06:30 - 10:37:12 PM </option>
                                                                                            ?>
                                                <option value="Asia/Yekaterinburg" data-gmt="+05:00" >Asia/Yekaterinburg - +05:00 - 09:07:12 PM </option>
                                                                                            ?>
                                                <option value="Asia/Yerevan" data-gmt="+04:00" >Asia/Yerevan - +04:00 - 08:07:12 PM </option>
                                                                                            ?>
                                                <option value="Atlantic/Azores" data-gmt="-01:00" >Atlantic/Azores - -01:00 - 03:07:12 PM </option>
                                                                                            ?>
                                                <option value="Atlantic/Bermuda" data-gmt="-04:00" >Atlantic/Bermuda - -04:00 - 12:07:12 PM </option>
                                                                                            ?>
                                                <option value="Atlantic/Canary" data-gmt="+00:00" >Atlantic/Canary - +00:00 - 04:07:12 PM </option>
                                                                                            ?>
                                                <option value="Atlantic/Cape_Verde" data-gmt="-01:00" >Atlantic/Cape_Verde - -01:00 - 03:07:12 PM </option>
                                                                                            ?>
                                                <option value="Atlantic/Faroe" data-gmt="+00:00" >Atlantic/Faroe - +00:00 - 04:07:12 PM </option>
                                                                                            ?>
                                                <option value="Atlantic/Madeira" data-gmt="+00:00" >Atlantic/Madeira - +00:00 - 04:07:12 PM </option>
                                                                                            ?>
                                                <option value="Atlantic/Reykjavik" data-gmt="+00:00" >Atlantic/Reykjavik - +00:00 - 04:07:12 PM </option>
                                                                                            ?>
                                                <option value="Atlantic/South_Georgia" data-gmt="-02:00" >Atlantic/South_Georgia - -02:00 - 02:07:12 PM </option>
                                                                                            ?>
                                                <option value="Atlantic/St_Helena" data-gmt="+00:00" >Atlantic/St_Helena - +00:00 - 04:07:12 PM </option>
                                                                                            ?>
                                                <option value="Atlantic/Stanley" data-gmt="-03:00" >Atlantic/Stanley - -03:00 - 01:07:12 PM </option>
                                                                                            ?>
                                                <option value="Australia/Adelaide" data-gmt="+10:30" >Australia/Adelaide - +10:30 - 02:37:12 AM </option>
                                                                                            ?>
                                                <option value="Australia/Brisbane" data-gmt="+10:00" >Australia/Brisbane - +10:00 - 02:07:12 AM </option>
                                                                                            ?>
                                                <option value="Australia/Broken_Hill" data-gmt="+10:30" >Australia/Broken_Hill - +10:30 - 02:37:12 AM </option>
                                                                                            ?>
                                                <option value="Australia/Darwin" data-gmt="+09:30" >Australia/Darwin - +09:30 - 01:37:12 AM </option>
                                                                                            ?>
                                                <option value="Australia/Eucla" data-gmt="+08:45" >Australia/Eucla - +08:45 - 12:52:12 AM </option>
                                                                                            ?>
                                                                                            
                                                                                            <option value="Australia/Hobart" data-gmt="+11:00" >Australia/Hobart - +11:00 - 03:07:12 AM </option>
                                                                                            ?>
                                                <option value="Australia/Lindeman" data-gmt="+10:00" >Australia/Lindeman - +10:00 - 02:07:12 AM </option>
                                                                                            ?>
                                                <option value="Australia/Lord_Howe" data-gmt="+11:00" >Australia/Lord_Howe - +11:00 - 03:07:12 AM </option>
                                                                                            ?>
                                                <option value="Australia/Melbourne" data-gmt="+11:00" >Australia/Melbourne - +11:00 - 03:07:12 AM </option>
                                                                                            ?>
                                                <option value="Australia/Perth" data-gmt="+08:00" >Australia/Perth - +08:00 - 12:07:12 AM </option>
                                                                                            ?>
                                                <option value="Australia/Sydney" data-gmt="+11:00" >Australia/Sydney - +11:00 - 03:07:12 AM </option>
                                                                                            ?>
                                                <option value="Europe/Amsterdam" data-gmt="+01:00" >Europe/Amsterdam - +01:00 - 05:07:12 PM </option>
                                                                                            ?>
                                                <option value="Europe/Andorra" data-gmt="+01:00" >Europe/Andorra - +01:00 - 05:07:12 PM </option>
                                                                                            ?>
                                                <option value="Europe/Astrakhan" data-gmt="+04:00" >Europe/Astrakhan - +04:00 - 08:07:12 PM </option>
                                                                                            ?>
                                                <option value="Europe/Athens" data-gmt="+02:00" >Europe/Athens - +02:00 - 06:07:12 PM </option>
                                                                                            ?>
                                                <option value="Europe/Belgrade" data-gmt="+01:00" >Europe/Belgrade - +01:00 - 05:07:12 PM </option>
                                                                                            ?>
                                                <option value="Europe/Berlin" data-gmt="+01:00" >Europe/Berlin - +01:00 - 05:07:12 PM </option>
                                                                                            ?>
                                                <option value="Europe/Bratislava" data-gmt="+01:00" >Europe/Bratislava - +01:00 - 05:07:12 PM </option>
                                                                                            ?>
                                                <option value="Europe/Brussels" data-gmt="+01:00" >Europe/Brussels - +01:00 - 05:07:12 PM </option>
                                                                                            ?>
                                                <option value="Europe/Bucharest" data-gmt="+02:00" >Europe/Bucharest - +02:00 - 06:07:12 PM </option>
                                                                                            ?>
                                                <option value="Europe/Budapest" data-gmt="+01:00" >Europe/Budapest - +01:00 - 05:07:12 PM </option>
                                                                                            ?>
                                                <option value="Europe/Busingen" data-gmt="+01:00" >Europe/Busingen - +01:00 - 05:07:12 PM </option>
                                                                                            ?>
                                                <option value="Europe/Chisinau" data-gmt="+02:00" >Europe/Chisinau - +02:00 - 06:07:12 PM </option>
                                                                                            ?>
                                                <option value="Europe/Copenhagen" data-gmt="+01:00" >Europe/Copenhagen - +01:00 - 05:07:12 PM </option>
                                                                                            ?>
                                                <option value="Europe/Dublin" data-gmt="+00:00" >Europe/Dublin - +00:00 - 04:07:12 PM </option>
                                                                                            ?>
                                                <option value="Europe/Gibraltar" data-gmt="+01:00" >Europe/Gibraltar - +01:00 - 05:07:12 PM </option>
                                                                                            ?>
                                                <option value="Europe/Guernsey" data-gmt="+00:00" >Europe/Guernsey - +00:00 - 04:07:12 PM </option>
                                                                                            ?>
                                                <option value="Europe/Helsinki" data-gmt="+02:00" >Europe/Helsinki - +02:00 - 06:07:12 PM </option>
                                                                                            ?>
                                                <option value="Europe/Isle_of_Man" data-gmt="+00:00" >Europe/Isle_of_Man - +00:00 - 04:07:12 PM </option>
                                                                                            ?>
                                                <option value="Europe/Istanbul" data-gmt="+03:00" >Europe/Istanbul - +03:00 - 07:07:12 PM </option>
                                                                                            ?>
                                                <option value="Europe/Jersey" data-gmt="+00:00" >Europe/Jersey - +00:00 - 04:07:12 PM </option>
                                                                                            ?>
                                                <option value="Europe/Kaliningrad" data-gmt="+02:00" >Europe/Kaliningrad - +02:00 - 06:07:12 PM </option>
                                                                                            ?>
                                                <option value="Europe/Kiev" data-gmt="+02:00" >Europe/Kiev - +02:00 - 06:07:12 PM </option>
                                                                                            ?>
                                                <option value="Europe/Kirov" data-gmt="+03:00" >Europe/Kirov - +03:00 - 07:07:12 PM </option>
                                                                                            ?>
                                                <option value="Europe/Lisbon" data-gmt="+00:00" >Europe/Lisbon - +00:00 - 04:07:12 PM </option>
                                                                                            ?>
                                                <option value="Europe/Ljubljana" data-gmt="+01:00" >Europe/Ljubljana - +01:00 - 05:07:12 PM </option>
                                                                                            ?>
                                                <option value="Europe/London" data-gmt="+00:00" >Europe/London - +00:00 - 04:07:12 PM </option>
                                                                                            ?>
                                                <option value="Europe/Luxembourg" data-gmt="+01:00" >Europe/Luxembourg - +01:00 - 05:07:12 PM </option>
                                                                                            ?>
                                                <option value="Europe/Madrid" data-gmt="+01:00" >Europe/Madrid - +01:00 - 05:07:12 PM </option>
                                                                                            ?>
                                                <option value="Europe/Malta" data-gmt="+01:00" >Europe/Malta - +01:00 - 05:07:12 PM </option>
                                                                                            ?>
                                                <option value="Europe/Mariehamn" data-gmt="+02:00" >Europe/Mariehamn - +02:00 - 06:07:12 PM </option>
                                                                                            ?>
                                                <option value="Europe/Minsk" data-gmt="+03:00" >Europe/Minsk - +03:00 - 07:07:12 PM </option>
                                                                                            ?>
                                                <option value="Europe/Monaco" data-gmt="+01:00" >Europe/Monaco - +01:00 - 05:07:12 PM </option>
                                                                                            ?>
                                                <option value="Europe/Moscow" data-gmt="+03:00" >Europe/Moscow - +03:00 - 07:07:12 PM </option>
                                                                                            ?>
                                                <option value="Europe/Oslo" data-gmt="+01:00" >Europe/Oslo - +01:00 - 05:07:12 PM </option>
                                                                                            ?>
                                                <option value="Europe/Paris" data-gmt="+01:00" >Europe/Paris - +01:00 - 05:07:12 PM </option>
                                                                                            ?>
                                                <option value="Europe/Podgorica" data-gmt="+01:00" >Europe/Podgorica - +01:00 - 05:07:12 PM </option>
                                                                                            ?>
                                                <option value="Europe/Prague" data-gmt="+01:00" >Europe/Prague - +01:00 - 05:07:12 PM </option>
                                                                                            ?>
                                                <option value="Europe/Riga" data-gmt="+02:00" >Europe/Riga - +02:00 - 06:07:12 PM </option>
                                                                                            ?>
                                                <option value="Europe/Rome" data-gmt="+01:00" >Europe/Rome - +01:00 - 05:07:12 PM </option>
                                                                                            ?>
                                                <option value="Europe/Samara" data-gmt="+04:00" >Europe/Samara - +04:00 - 08:07:12 PM </option>
                                                                                            ?>
                                                <option value="Europe/San_Marino" data-gmt="+01:00" >Europe/San_Marino - +01:00 - 05:07:12 PM </option>
                                                                                            ?>
                                                <option value="Europe/Sarajevo" data-gmt="+01:00" >Europe/Sarajevo - +01:00 - 05:07:12 PM </option>
                                                                                            ?>
                                                <option value="Europe/Saratov" data-gmt="+04:00" >Europe/Saratov - +04:00 - 08:07:12 PM </option>
                                                                                            ?>
                                                <option value="Europe/Simferopol" data-gmt="+03:00" >Europe/Simferopol - +03:00 - 07:07:12 PM </option>
                                                                                            ?>
                                                <option value="Europe/Skopje" data-gmt="+01:00" >Europe/Skopje - +01:00 - 05:07:12 PM </option>
                                                                                            ?>
                                                <option value="Europe/Sofia" data-gmt="+02:00" >Europe/Sofia - +02:00 - 06:07:12 PM </option>
                                                                                            ?>
                                                <option value="Europe/Stockholm" data-gmt="+01:00" >Europe/Stockholm - +01:00 - 05:07:12 PM </option>
                                                                                            ?>
                                                <option value="Europe/Tallinn" data-gmt="+02:00" >Europe/Tallinn - +02:00 - 06:07:12 PM </option>
                                                                                            ?>
                                                <option value="Europe/Tirane" data-gmt="+01:00" >Europe/Tirane - +01:00 - 05:07:12 PM </option>
                                                                                            ?>
                                                <option value="Europe/Ulyanovsk" data-gmt="+04:00" >Europe/Ulyanovsk - +04:00 - 08:07:12 PM </option>
                                                                                            ?>
                                                <option value="Europe/Uzhgorod" data-gmt="+02:00" >Europe/Uzhgorod - +02:00 - 06:07:12 PM </option>
                                                                                            ?>
                                                <option value="Europe/Vaduz" data-gmt="+01:00" >Europe/Vaduz - +01:00 - 05:07:12 PM </option>
                                                                                            ?>
                                                <option value="Europe/Vatican" data-gmt="+01:00" >Europe/Vatican - +01:00 - 05:07:12 PM </option>
                                                                                            ?>
                                                <option value="Europe/Vienna" data-gmt="+01:00" >Europe/Vienna - +01:00 - 05:07:12 PM </option>
                                                                                            ?>
                                                <option value="Europe/Vilnius" data-gmt="+02:00" >Europe/Vilnius - +02:00 - 06:07:12 PM </option>
                                                                                            ?>
                                                <option value="Europe/Volgograd" data-gmt="+03:00" >Europe/Volgograd - +03:00 - 07:07:12 PM </option>
                                                                                            ?>
                                                <option value="Europe/Warsaw" data-gmt="+01:00" >Europe/Warsaw - +01:00 - 05:07:12 PM </option>
                                                                                            ?>
                                                <option value="Europe/Zagreb" data-gmt="+01:00" >Europe/Zagreb - +01:00 - 05:07:12 PM </option>
                                                                                            ?>
                                                <option value="Europe/Zaporozhye" data-gmt="+02:00" >Europe/Zaporozhye - +02:00 - 06:07:12 PM </option>
                                                                                            ?>
                                                <option value="Europe/Zurich" data-gmt="+01:00" >Europe/Zurich - +01:00 - 05:07:12 PM </option>
                                                                                            ?>
                                                <option value="Indian/Antananarivo" data-gmt="+03:00" >Indian/Antananarivo - +03:00 - 07:07:12 PM </option>
                                                                                            ?>
                                                <option value="Indian/Chagos" data-gmt="+06:00" >Indian/Chagos - +06:00 - 10:07:12 PM </option>
                                                                                            ?>
                                                <option value="Indian/Christmas" data-gmt="+07:00" >Indian/Christmas - +07:00 - 11:07:12 PM </option>
                                                                                            ?>
                                                <option value="Indian/Cocos" data-gmt="+06:30" >Indian/Cocos - +06:30 - 10:37:12 PM </option>
                                                                                            ?>
                                                <option value="Indian/Comoro" data-gmt="+03:00" >Indian/Comoro - +03:00 - 07:07:12 PM </option>
                                                                                            ?>
                                                <option value="Indian/Kerguelen" data-gmt="+05:00" >Indian/Kerguelen - +05:00 - 09:07:12 PM </option>
                                                                                            ?>
                                                <option value="Indian/Mahe" data-gmt="+04:00" >Indian/Mahe - +04:00 - 08:07:12 PM </option>
                                                                                            ?>
                                                <option value="Indian/Maldives" data-gmt="+05:00" >Indian/Maldives - +05:00 - 09:07:12 PM </option>
                                                                                            ?>
                                                <option value="Indian/Mauritius" data-gmt="+04:00" >Indian/Mauritius - +04:00 - 08:07:12 PM </option>
                                                                                            ?>
                                                <option value="Indian/Mayotte" data-gmt="+03:00" >Indian/Mayotte - +03:00 - 07:07:12 PM </option>
                                                                                            ?>
                                                <option value="Indian/Reunion" data-gmt="+04:00" >Indian/Reunion - +04:00 - 08:07:12 PM </option>
                                                                                            ?>
                                                <option value="Pacific/Apia" data-gmt="+13:00" >Pacific/Apia - +13:00 - 05:07:12 AM </option>
                                                                                            ?>
                                                <option value="Pacific/Auckland" data-gmt="+13:00" >Pacific/Auckland - +13:00 - 05:07:12 AM </option>
                                                                                            ?>
                                                <option value="Pacific/Bougainville" data-gmt="+11:00" >Pacific/Bougainville - +11:00 - 03:07:12 AM </option>
                                                                                            ?>
                                                <option value="Pacific/Chatham" data-gmt="+13:45" >Pacific/Chatham - +13:45 - 05:52:12 AM </option>
                                                                                            ?>
                                                <option value="Pacific/Chuuk" data-gmt="+10:00" >Pacific/Chuuk - +10:00 - 02:07:12 AM </option>
                                                                                            ?>
                                                <option value="Pacific/Easter" data-gmt="-05:00" >Pacific/Easter - -05:00 - 11:07:12 AM </option>
                                                                                            ?>
                                                <option value="Pacific/Efate" data-gmt="+11:00" >Pacific/Efate - +11:00 - 03:07:12 AM </option>
                                                                                            ?>
                                                <option value="Pacific/Fakaofo" data-gmt="+13:00" >Pacific/Fakaofo - +13:00 - 05:07:12 AM </option>
                                                                                            ?>
                                                <option value="Pacific/Fiji" data-gmt="+13:00" >Pacific/Fiji - +13:00 - 05:07:12 AM </option>
                                                                                            ?>
                                                <option value="Pacific/Funafuti" data-gmt="+12:00" >Pacific/Funafuti - +12:00 - 04:07:12 AM </option>
                                                                                            ?>
                                                <option value="Pacific/Galapagos" data-gmt="-06:00" >Pacific/Galapagos - -06:00 - 10:07:12 AM </option>
                                                                                            ?>
                                                <option value="Pacific/Gambier" data-gmt="-09:00" >Pacific/Gambier - -09:00 - 07:07:12 AM </option>
                                                                                            ?>
                                                <option value="Pacific/Guadalcanal" data-gmt="+11:00" >Pacific/Guadalcanal - +11:00 - 03:07:12 AM </option>
                                                                                            ?>
                                                <option value="Pacific/Guam" data-gmt="+10:00" >Pacific/Guam - +10:00 - 02:07:12 AM </option>
                                                                                            ?>
                                                <option value="Pacific/Honolulu" data-gmt="-10:00" >Pacific/Honolulu - -10:00 - 06:07:12 AM </option>
                                                                                            ?>
                                                <option value="Pacific/Kanton" data-gmt="+13:00" >Pacific/Kanton - +13:00 - 05:07:12 AM </option>
                                                                                            ?>
                                                <option value="Pacific/Kiritimati" data-gmt="+14:00" >Pacific/Kiritimati - +14:00 - 06:07:12 AM </option>
                                                                                            ?>
                                                <option value="Pacific/Kosrae" data-gmt="+11:00" >Pacific/Kosrae - +11:00 - 03:07:12 AM </option>
                                                                                            ?>
                                                <option value="Pacific/Kwajalein" data-gmt="+12:00" >Pacific/Kwajalein - +12:00 - 04:07:12 AM </option>
                                                                                            ?>
                                                <option value="Pacific/Majuro" data-gmt="+12:00" >Pacific/Majuro - +12:00 - 04:07:12 AM </option>
                                                                                            ?>
                                                <option value="Pacific/Marquesas" data-gmt="-09:30" >Pacific/Marquesas - -09:30 - 06:37:12 AM </option>
                                                                                            ?>
                                                <option value="Pacific/Midway" data-gmt="-11:00" >Pacific/Midway - -11:00 - 05:07:12 AM </option>
                                                                                            ?>
                                                <option value="Pacific/Nauru" data-gmt="+12:00" >Pacific/Nauru - +12:00 - 04:07:12 AM </option>
                                                                                            ?>
                                                <option value="Pacific/Niue" data-gmt="-11:00" >Pacific/Niue - -11:00 - 05:07:12 AM </option>
                                                                                            ?>
                                                <option value="Pacific/Norfolk" data-gmt="+12:00" >Pacific/Norfolk - +12:00 - 04:07:12 AM </option>
                                                                                            ?>
                                                <option value="Pacific/Noumea" data-gmt="+11:00" >Pacific/Noumea - +11:00 - 03:07:12 AM </option>
                                                                                            ?>
                                                <option value="Pacific/Pago_Pago" data-gmt="-11:00" >Pacific/Pago_Pago - -11:00 - 05:07:12 AM </option>
                                                                                            ?>
                                                <option value="Pacific/Palau" data-gmt="+09:00" >Pacific/Palau - +09:00 - 01:07:12 AM </option>
                                                                                            ?>
                                                <option value="Pacific/Pitcairn" data-gmt="-08:00" >Pacific/Pitcairn - -08:00 - 08:07:12 AM </option>
                                                                                            ?>
                                                <option value="Pacific/Pohnpei" data-gmt="+11:00" >Pacific/Pohnpei - +11:00 - 03:07:12 AM </option>
                                                                                            ?>
                                                <option value="Pacific/Port_Moresby" data-gmt="+10:00" >Pacific/Port_Moresby - +10:00 - 02:07:12 AM </option>
                                                                                            ?>
                                                <option value="Pacific/Rarotonga" data-gmt="-10:00" >Pacific/Rarotonga - -10:00 - 06:07:12 AM </option>
                                                                                            ?>
                                                <option value="Pacific/Saipan" data-gmt="+10:00" >Pacific/Saipan - +10:00 - 02:07:12 AM </option>
                                                                                            ?>
                                                <option value="Pacific/Tahiti" data-gmt="-10:00" >Pacific/Tahiti - -10:00 - 06:07:12 AM </option>
                                                                                            ?>
                                                <option value="Pacific/Tarawa" data-gmt="+12:00" >Pacific/Tarawa - +12:00 - 04:07:12 AM </option>
                                                                                            ?>
                                                <option value="Pacific/Tongatapu" data-gmt="+13:00" >Pacific/Tongatapu - +13:00 - 05:07:12 AM </option>
                                                                                            ?>
                                                <option value="Pacific/Wake" data-gmt="+12:00" >Pacific/Wake - +12:00 - 04:07:12 AM </option>
                                                                                            ?>
                                                <option value="Pacific/Wallis" data-gmt="+12:00" >Pacific/Wallis - +12:00 - 04:07:12 AM </option>
                                                                                            ?>
                                                <option value="UTC" data-gmt="+00:00" >UTC - +00:00 - 04:07:12 PM </option>
                                                                                    </select>
                                    </div>
                                    <div class="form-group col-md-6">
                                        <label for="minimum_cart_amt">Minimum Cart Amount(₹) <span class='text-danger text-xs'>*</span></label>
                                        <input type="number" class="form-control" name="minimum_cart_amt" value="50" placeholder='Minimum Cart Amount' min='0' />
                                    </div>
                                    <div class="form-group col-md-6">
                                        <label for="max_items_cart"> Maximum Items Allowed In Cart <span class='text-danger text-xs'>*</span></label>
                                        <input type="number" class="form-control" name="max_items_cart" value="12" placeholder='Maximum Items Allowed In Cart' min='0' />
                                    </div>
                                    <div class="form-group col-md-6">
                                        <label for="max_items_cart"> Low stock limit <small>(Product will be considered as low stock)</small> </label>
                                        <input type="number" class="form-control" name="low_stock_limit" value="15" placeholder='Product low stock limit' min='1' />
                                    </div>
                                    <div class="form-group col-md-6">
                                        <label for="">Max days to return item</label>
                                        <input type="number" class="form-control" name="max_product_return_days" value="1" placeholder='Max days to return item' />
                                    </div>
                                    <div class="form-group col-md-6">
                                        <label for="">Delivery Boy Bonus (%)</label>
                                        <input type="number" class="form-control" name="delivery_boy_bonus_percentage" value="1" placeholder='Delivery Boy Bonus' />
                                    </div>
                                </div>
                                <hr>
                                <h4>Delivery Boy Settings</h4>
                                <hr>
                                <div class="row">
                                    <div class="form-group col-md-12 col-sm-12">
                                        <label for="is_delivery_boy_otp_setting_on"> Order Delivery OTP System
                                        </label>
                                        <div class="card-body">
                                            <input type="checkbox" name="is_delivery_boy_otp_setting_on" Checked data-bootstrap-switch data-off-color="danger" data-on-color="success">
                                        </div>
                                    </div>
                                </div>
                                <h4>App & System Settings</h4>
                                <hr>
                                <div class="row">
                                    <div class="form-group col-md-3">
                                        <label for="cart_btn_on_list"> Enable Cart Button on Products List view? </label>
                                        <div class="card-body">
                                            <input type="checkbox" name="cart_btn_on_list" Checked data-bootstrap-switch data-off-color="danger" data-on-color="success">
                                        </div>
                                    </div>
                                    <div class="form-group col-md-3">
                                        <label for="expand_product_images"> Expand Product Images? <small>( Image will be stretched in the product image boxes )</small> </label>
                                        <div class="card-body">
                                            <input type="checkbox" name="expand_product_images"  data-bootstrap-switch data-off-color="danger" data-on-color="success">
                                        </div>
                                    </div>
                                    <div class="form-group col-md-3">
                                        <label for="tax_name">Tax Name <small>( This will be visible on your invoice )</small></label>
                                        <input type="text" class="form-control" name="tax_name" value="GST Number" placeholder='Example : GST Number / VAT / TIN Number' />
                                    </div>
                                    <div class="form-group col-md-3">
                                        <label for="tax_number">Tax Number </label>
                                        <input type="text" class="form-control" name="tax_number" value="24GSTIN1022520" placeholder='Example : GSTIN240000120' />
                                    </div>
                                    <div class="form-group col-md-6">
                                        <label for="cart_btn_on_list"> Social login ? </label>
                                        <div class="card-body">
                                            <label for="cart_btn_on_list "> Google </label>
                                            <input type="checkbox" name="google_login" class="mr-3" Checked data-bootstrap-switch data-off-color="danger" data-on-color="success">

                                            <label for="cart_btn_on_list"> Facebook </label>
                                            <input type="checkbox" name="facebook_login"  data-bootstrap-switch data-off-color="danger" data-on-color="success">

                                            <label for="cart_btn_on_list"> Apple </label>
                                            <input type="checkbox" name="apple_login"  data-bootstrap-switch data-off-color="danger" data-on-color="success">
                                        </div>
                                    </div>
                                    
                                </div>
                                <h4>Refer & Earn Settings</h4>
                                <hr>
                                <div class="row">
                                    <div class="form-group col-md-4">
                                        <label for="is_refer_earn_on"> Refer & Earn Status? </label>
                                        <div class="card-body">
                                            <input type="checkbox" name="is_refer_earn_on" Checked data-bootstrap-switch data-off-color="danger" data-on-color="success">
                                        </div>
                                    </div>
                                    <div class="form-group col-md-4">
                                        <label for="min_refer_earn_order_amount"> Minimum Refer & Earn Order Amount (₹) </label>
                                        <input type="text" name="min_refer_earn_order_amount" class="form-control" value="100" placeholder="Amount of order eligible for bonus" />
                                    </div>
                                    <div class="form-group col-md-4">
                                        <label for="refer_earn_bonus">Refer & Earn Bonus (₹ OR %)</label>
                                        <input type="text" class="form-control" name="refer_earn_bonus" value="10" placeholder='In amount or percentages' />
                                    </div>
                                    <div class="form-group col-md-4">
                                        <label for="refer_earn_method">Refer & Earn Method </label>
                                        <select name="refer_earn_method" class="form-control">
                                            <option value="">Select</option>
                                            <option value="percentage" selected>Percentage</option>
                                            <option value="amount" >Amount</option>
                                        </select>
                                    </div>
                                    <div class="form-group col-md-4">
                                        <label for="max_refer_earn_amount">Maximum Refer & Earn Amount (₹)</label>
                                        <input type="text" class="form-control" name="max_refer_earn_amount" value="50" placeholder='Maximum Refer & Earn Bonus Amount' />
                                    </div>
                                    <div class="form-group col-md-4">
                                        <label for="refer_earn_bonus_times">Number of times Bonus to be given to the cusomer</label>
                                        <input type="text" class="form-control" name="refer_earn_bonus_times" value="2" placeholder='No of times customer will get bonus' />
                                    </div>
                                </div>

                                <span class="d-flex align-items-center ">
                                    <h4>Welcome Wallet Balance &nbsp;</h4>
                                </span>
                                <hr>
                                <div class="row">
                                    <div class="form-group col-md-4">
                                        <label for="welcome_wallet_balance_on"> Wallet Balance Status? </label>
                                        <div class="card-body">
                                            <input type="checkbox" name="welcome_wallet_balance_on"  data-bootstrap-switch data-off-color="danger" data-on-color="success">
                                        </div>
                                    </div>
                                    <div class="form-group col-md-4">
                                        <label for="wallet_balance_amount"> Wallet Balance Amount (₹) </label>
                                        <input type="text" name="wallet_balance_amount" class="form-control" value="" placeholder="Amount of Welcome Wallet Balance" />
                                    </div>
                                </div>
                                <span class="d-flex align-items-center ">
                                    <h4>Country Currency &nbsp;</h4>
                                </span>
                                <hr>
                                <div class="row">
                                    <div class="form-group col-md-4">
                                        <label for="supported_locals">Country Currency Code</label>
                                        <select name="supported_locals" class="form-control">
                                                                                            <option value="AED" selected>AED - United Arab Emirates Dirham</option>
                                                                                            <option value="AFN" >AFN - Afghanistan Afghani</option>
                                                                                            <option value="ALL" >ALL - Albania Lek</option>
                                                                                            <option value="AMD" >AMD - Armenia Dram</option>
                                                                                            <option value="ANG" >ANG - Netherlands Antilles Guilder</option>
                                                                                            <option value="AOA" >AOA - Angola Kwanza</option>
                                                                                            <option value="ARS" >ARS - Argentina Peso</option>
                                                                                            <option value="AUD" >AUD - Australia Dollar</option>
                                                                                            <option value="AWG" >AWG - Aruba Guilder</option>
                                                                                            <option value="AZN" >AZN - Azerbaijan Manat</option>
                                                                                            <option value="BAM" >BAM - Bosnia and Herzegovina Convertible Mark</option>
                                                                                            <option value="BBD" >BBD - Barbados Dollar</option>
                                                                                            <option value="BDT" >BDT - Bangladesh Taka</option>
                                                                                            <option value="BGN" >BGN - Bulgaria Lev</option>
                                                                                            <option value="BHD" >BHD - Bahrain Dinar</option>
                                                                                            <option value="BIF" >BIF - Burundi Franc</option>
                                                                                            <option value="BMD" >BMD - Bermuda Dollar</option>
                                                                                            <option value="BND" >BND - Brunei Darussalam Dollar</option>
                                                                                            <option value="BOB" >BOB - Bolivia Bolíviano</option>
                                                                                            <option value="BRL" >BRL - Brazil Real</option>
                                                                                            <option value="BSD" >BSD - Bahamas Dollar</option>
                                                                                            <option value="BTN" >BTN - Bhutan Ngultrum</option>
                                                                                            <option value="BWP" >BWP - Botswana Pula</option>
                                                                                            <option value="BYN" >BYN - Belarus Ruble</option>
                                                                                            <option value="BZD" >BZD - Belize Dollar</option>
                                                                                            <option value="CAD" >CAD - Canada Dollar</option>
                                                                                            <option value="CDF" >CDF - Congo/Kinshasa Franc</option>
                                                                                            <option value="CHF" >CHF - Switzerland Franc</option>
                                                                                            <option value="CLP" >CLP - Chile Peso</option>
                                                                                            <option value="CNY" >CNY - China Yuan Renminbi</option>
                                                                                            <option value="COP" >COP - Colombia Peso</option>
                                                                                            <option value="CRC" >CRC - Costa Rica Colon</option>
                                                                                            <option value="CUC" >CUC - Cuba Convertible Peso</option>
                                                                                            <option value="CUP" >CUP - Cuba Peso</option>
                                                                                            <option value="CVE" >CVE - Cape Verde Escudo</option>
                                                                                            <option value="CZK" >CZK - Czech Republic Koruna</option>
                                                                                            <option value="DJF" >DJF - Djibouti Franc</option>
                                                                                            <option value="DKK" >DKK - Denmark Krone</option>
                                                                                            <option value="DOP" >DOP - Dominican Republic Peso</option>
                                                                                            <option value="DZD" >DZD - Algeria Dinar</option>
                                                                                            <option value="EGP" >EGP - Egypt Pound</option>
                                                                                            <option value="ERN" >ERN - Eritrea Nakfa</option>
                                                                                            <option value="ETB" >ETB - Ethiopia Birr</option>
                                                                                            <option value="EUR" >EUR - Euro Member Countries</option>
                                                                                            <option value="FJD" >FJD - Fiji Dollar</option>
                                                                                            <option value="FKP" >FKP - Falkland Islands (Malvinas) Pound</option>
                                                                                            <option value="GBP" >GBP - United Kingdom Pound</option>
                                                                                            <option value="GEL" >GEL - Georgia Lari</option>
                                                                                            <option value="GGP" >GGP - Guernsey Pound</option>
                                                                                            <option value="GHS" >GHS - Ghana Cedi</option>
                                                                                            <option value="GIP" >GIP - Gibraltar Pound</option>
                                                                                            <option value="GMD" >GMD - Gambia Dalasi</option>
                                                                                            <option value="GNF" >GNF - Guinea Franc</option>
                                                                                            <option value="GTQ" >GTQ - Guatemala Quetzal</option>
                                                                                            <option value="GYD" >GYD - Guyana Dollar</option>
                                                                                            <option value="HKD" >HKD - Hong Kong Dollar</option>
                                                                                            <option value="HNL" >HNL - Honduras Lempira</option>
                                                                                            <option value="HRK" >HRK - Croatia Kuna</option>
                                                                                            <option value="HTG" >HTG - Haiti Gourde</option>
                                                                                            <option value="HUF" >HUF - Hungary Forint</option>
                                                                                            <option value="IDR" >IDR - Indonesia Rupiah</option>
                                                                                            <option value="ILS" >ILS - Israel Shekel</option>
                                                                                            <option value="IMP" >IMP - Isle of Man Pound</option>
                                                                                            <option value="INR" >INR - India Rupee</option>
                                                                                            <option value="IQD" >IQD - Iraq Dinar</option>
                                                                                            <option value="IRR" >IRR - Iran Rial</option>
                                                                                            <option value="ISK" >ISK - Iceland Krona</option>
                                                                                            <option value="JEP" >JEP - Jersey Pound</option>
                                                                                            <option value="JMD" >JMD - Jamaica Dollar</option>
                                                                                            <option value="JOD" >JOD - Jordan Dinar</option>
                                                                                            <option value="JPY" >JPY - Japan Yen</option>
                                                                                            <option value="KES" >KES - Kenya Shilling</option>
                                                                                            <option value="KGS" >KGS - Kyrgyzstan Som</option>
                                                                                            <option value="KHR" >KHR - Cambodia Riel</option>
                                                                                            <option value="KMF" >KMF - Comorian Franc</option>
                                                                                            <option value="KPW" >KPW - Korea (North) Won</option>
                                                                                            <option value="KRW" >KRW - Korea (South) Won</option>
                                                                                            <option value="KWD" >KWD - Kuwait Dinar</option>
                                                                                            <option value="KYD" >KYD - Cayman Islands Dollar</option>
                                                                                            <option value="KZT" >KZT - Kazakhstan Tenge</option>
                                                                                            <option value="LAK" >LAK - Laos Kip</option>
                                                                                            <option value="LBP" >LBP - Lebanon Pound</option>
                                                                                            <option value="LKR" >LKR - Sri Lanka Rupee</option>
                                                                                            <option value="LRD" >LRD - Liberia Dollar</option>
                                                                                            <option value="LSL" >LSL - Lesotho Loti</option>
                                                                                            <option value="LYD" >LYD - Libya Dinar</option>
                                                                                            <option value="MAD" >MAD - Morocco Dirham</option>
                                                                                            <option value="MDL" >MDL - Moldova Leu</option>
                                                                                            <option value="MGA" >MGA - Madagascar Ariary</option>
                                                                                            <option value="MKD" >MKD - Macedonia Denar</option>
                                                                                            <option value="MMK" >MMK - Myanmar (Burma) Kyat</option>
                                                                                            <option value="MNT" >MNT - Mongolia Tughrik</option>
                                                                                            <option value="MOP" >MOP - Macau Pataca</option>
                                                                                            <option value="MRU" >MRU - Mauritania Ouguiya</option>
                                                                                            <option value="MUR" >MUR - Mauritius Rupee</option>
                                                                                            <option value="MVR" >MVR - Maldives (Maldive Islands) Rufiyaa</option>
                                                                                            <option value="MWK" >MWK - Malawi Kwacha</option>
                                                                                            <option value="MXN" >MXN - Mexico Peso</option>
                                                                                            <option value="MYR" >MYR - Malaysia Ringgit</option>
                                                                                            <option value="MZN" >MZN - Mozambique Metical</option>
                                                                                            <option value="NAD" >NAD - Namibia Dollar</option>
                                                                                            <option value="NGN" >NGN - Nigeria Naira</option>
                                                                                            <option value="NIO" >NIO - Nicaragua Cordoba</option>
                                                                                            <option value="NOK" >NOK - Norway Krone</option>
                                                                                            <option value="NPR" >NPR - Nepal Rupee</option>
                                                                                            <option value="NZD" >NZD - New Zealand Dollar</option>
                                                                                            <option value="OMR" >OMR - Oman Rial</option>
                                                                                            <option value="PAB" >PAB - Panama Balboa</option>
                                                                                            <option value="PEN" >PEN - Peru Sol</option>
                                                                                            <option value="PGK" >PGK - Papua New Guinea Kina</option>
                                                                                            <option value="PHP" >PHP - Philippines Peso</option>
                                                                                            <option value="PKR" >PKR - Pakistan Rupee</option>
                                                                                            <option value="PLN" >PLN - Poland Zloty</option>
                                                                                            <option value="PYG" >PYG - Paraguay Guarani</option>
                                                                                            <option value="QAR" >QAR - Qatar Riyal</option>
                                                                                            <option value="RON" >RON - Romania Leu</option>
                                                                                            <option value="RSD" >RSD - Serbia Dinar</option>
                                                                                            <option value="RUB" >RUB - Russia Ruble</option>
                                                                                            <option value="RWF" >RWF - Rwanda Franc</option>
                                                                                            <option value="SAR" >SAR - Saudi Arabia Riyal</option>
                                                                                            <option value="SBD" >SBD - Solomon Islands Dollar</option>
                                                                                            <option value="SCR" >SCR - Seychelles Rupee</option>
                                                                                            <option value="SDG" >SDG - Sudan Pound</option>
                                                                                            <option value="SEK" >SEK - Sweden Krona</option>
                                                                                            <option value="SGD" >SGD - Singapore Dollar</option>
                                                                                            <option value="SHP" >SHP - Saint Helena Pound</option>
                                                                                            <option value="SLL" >SLL - Sierra Leone Leone</option>
                                                                                            <option value="SOS" >SOS - Somalia Shilling</option>
                                                                                            <option value="SPL*" >SPL* - Seborga Luigino</option>
                                                                                            <option value="SRD" >SRD - Suriname Dollar</option>
                                                                                            <option value="STN" >STN - São Tomé and Príncipe Dobra</option>
                                                                                            <option value="SVC" >SVC - El Salvador Colon</option>
                                                                                            <option value="SYP" >SYP - Syria Pound</option>
                                                                                            <option value="SZL" >SZL - eSwatini Lilangeni</option>
                                                                                            <option value="THB" >THB - Thailand Baht</option>
                                                                                            <option value="TJS" >TJS - Tajikistan Somoni</option>
                                                                                            <option value="TMT" >TMT - Turkmenistan Manat</option>
                                                                                            <option value="TND" >TND - Tunisia Dinar</option>
                                                                                            <option value="TOP" >TOP - Tonga Pa'anga</option>
                                                                                            <option value="TRY" >TRY - Turkey Lira</option>
                                                                                            <option value="TTD" >TTD - Trinidad and Tobago Dollar</option>
                                                                                            <option value="TVD" >TVD - Tuvalu Dollar</option>
                                                                                            <option value="TWD" >TWD - Taiwan New Dollar</option>
                                                                                            <option value="TZS" >TZS - Tanzania Shilling</option>
                                                                                            <option value="UAH" >UAH - Ukraine Hryvnia</option>
                                                                                            <option value="UGX" >UGX - Uganda Shilling</option>
                                                                                            <option value="USD" >USD - United States Dollar</option>
                                                                                            <option value="UYU" >UYU - Uruguay Peso</option>
                                                                                            <option value="UZS" >UZS - Uzbekistan Som</option>
                                                                                            <option value="VEF" >VEF - Venezuela Bolívar</option>
                                                                                            <option value="VND" >VND - Viet Nam Dong</option>
                                                                                            <option value="VUV" >VUV - Vanuatu Vatu</option>
                                                                                            <option value="WST" >WST - Samoa Tala</option>
                                                                                            <option value="XAF" >XAF - Communauté Financière Africaine (BEAC) CFA Franc BEAC</option>
                                                                                            <option value="XCD" >XCD - East Caribbean Dollar</option>
                                                                                            <option value="XDR" >XDR - International Monetary Fund (IMF) Special Drawing Rights</option>
                                                                                            <option value="XOF" >XOF - Communauté Financière Africaine (BCEAO) Franc</option>
                                                                                            <option value="XPF" >XPF - Comptoirs Français du Pacifique (CFP) Franc</option>
                                                                                            <option value="YER" >YER - Yemen Rial</option>
                                                                                            <option value="ZAR" >ZAR - South Africa Rand</option>
                                                                                            <option value="ZMW" >ZMW - Zambia Kwacha</option>
                                                                                            <option value="ZWD" >ZWD - Zimbabwe Dollar</option>
                                                                                    </select>
                                                                                    
                                                                                    </div>
                                    <div class="form-group col-md-4">
                                        <label for="currency">Store Currency ( Symbol or Code - $ or USD - Anyone ) <span class='text-danger text-xs'>*</span></label>
                                        <input type="text" class="form-control" name="currency" value="₹" placeholder="Either Symbol or Code - For Example $ or USD" />
                                    </div>
                                    <div class="form-group col-md-4">
                                        <label for="currency">Decimal Point</label>
                                        <select name="decimal_point" class="form-control">
                                                                                            <option value="0" >0</option>
                                                                                            <option value="1" >1</option>
                                                                                            <option value="2" >2</option>
                                                                                    </select>
                                    </div>
                                </div>
                                <hr>
                                <h4>Order Settings</h4>
                                <hr>
                                <div class="row">
                                    <div class="form-group col-md-12 col-sm-12">
                                        <label for="is_single_seller_order"> Single Seller Order System
                                        </label>
                                        <div class="card-body">
                                            <input type="checkbox" name="is_single_seller_order"  data-bootstrap-switch data-off-color="danger" data-on-color="success">
                                        </div>
                                    </div>
                                </div>
                                <h4>Maintenance Mode</h4><small>(If you Enable Maintenance Mode of App your App Will be in "Under Maintenance")</small>
                                <hr>
                                <div class="row">
                                    <div class="form-group col-md-4">
                                        <label for="is_customer_app_under_maintenance"> Customer App</label>
                                        <div class="card-body pl-0">
                                            <input type="checkbox" name="is_customer_app_under_maintenance"  data-bootstrap-switch data-off-color="danger" data-on-color="success">
                                        </div>
                                        <label for="message_for_customer_app"> Message for Customer App</label>
                                        <div class="card-body pl-0">
                                            <textarea type="text" class="form-control" id="message_for_customer_app" placeholder="Message for Customer App" name="message_for_customer_app"></textarea>
                                        </div>
                                    </div>
                                    <div class="form-group col-md-4">
                                        <label for="is_seller_app_under_maintenance"> Seller App</label>
                                        <div class="card-body pl-0">
                                            <input type="checkbox" name="is_seller_app_under_maintenance"  data-bootstrap-switch data-off-color="danger" data-on-color="success">
                                        </div>
                                        <label for="message_for_seller_app"> Message for Seller App</label>
                                        <div class="card-body pl-0">
                                            <textarea type="text" class="form-control" id="message_for_seller_app" placeholder="Message for Seller App" name="message_for_seller_app"></textarea>
                                        </div>
                                    </div>
                                    <div class="form-group col-md-4">
                                        <label for="is_delivery_boy_app_under_maintenance"> Delivery boy App</label>
                                        <div class="card-body pl-0">
                                            <input type="checkbox" name="is_delivery_boy_app_under_maintenance"  data-bootstrap-switch data-off-color="danger" data-on-color="success">
                                        </div>
                                        <label for="message_for_delivery_boy_app"> Message for Delivery boy App</label>
                                        <div class="card-body pl-0">
                                            <textarea type="text" class="form-control" id="message_for_delivery_boy_app" placeholder="Message for Delivery boy App" name="message_for_delivery_boy_app"></textarea>
                                        </div>
                                    </div>

                                </div>
                                <h4>Cron Job URL for Seller commission</h4>
                                <hr>
                                <div class="row">
                                    <div class="form-group col-md-8">
                                        <label for="app_name">Cron Job URL <span class='text-danger text-xs'>*</span> <small>(Set this URL at your server cron job list for "once a day")</small></label>
                                        <a class="btn btn-xs btn-primary text-white mb-2" data-toggle="modal" data-target="#howItWorksModal" title="How it works">How seller commission works?</a>
                                        <input type="text" class="form-control" name="app_name" value="https://avrluxe.com/admin/cron-job/settle-seller-commission" disabled />
                                    </div>
                                </div>
                                <h4>Cron Job URL for Add Promo Code Discount</h4>
                                <hr>
                                <div class="row">
                                    <div class="form-group col-md-8">
                                        <label for="app_name">Add Promo Code Discount URL <span class='text-danger text-xs'>*</span> <small>(Set this URL at your server cron job list for "once a day")</small></label>
                                        <a class="btn btn-xs btn-primary text-white mb-2" data-toggle="modal" data-target="#howItWorksModal1" title="How it works">How Promo Code Discount works?</a>
                                        <input type="text" class="form-control" name="app_name" value="https://avrluxe.com/admin/cron_job/settle_cashback_discount" disabled />
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
                        <div class="modal fade" id="howItWorksModal1" tabindex="-1" role="dialog" aria-labelledby="myLargeModalLabel" aria-hidden="true">
                            <div class="modal-dialog modal-lg" role="document">
                                <div class="modal-content">
                                    <div class="modal-header">
                                        <h4 class="modal-title" id="myModalLabel">How Promo Code Discount will get credited?</h4>
                                        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                                            <span aria-hidden="true">&times;</span>
                                        </button>
                                    </div>
                                    <div class="modal-body ">
                                        <ol>
                                            <li>Cron job must be set on your server for Promo Code Discount to be work.</li>

                                            <li> Cron job will run every mid night at 12:00 AM. </li>

                                            <li> Formula for Add Promo Code Discount is <b>Sub total (Excluding delivery charge) - promo code discount percentage / Amount</b> </li>

                                            <li> For example sub total is 1300 and promo code discount is 100 then 1300 - 100 = 1200 so 100 will get credited into Users's wallet </li>

                                            <li> If Order status is delivered And Return Policy is expired then only users will get Promo Code Discount. </li>

                                            <li> Ex - 1. Order placed on 10-Sep-22 and return policy days are set to 1 so 10-Sep + 1 days = 11-Sep Promo code discount will get credited on 11-Sep-22 at 12:00 AM (Mid night) </li>

                                            <li> If Promo Code Discount doesn't works make sure cron job is set properly and it is working. If you don't know how to set cron job for once in a day please take help of server support or do search for it. </li>
                                        </ol>
                                    </div>
                                </div>
                            </div>
                        </div>
                        <div class="modal fade" id="howItWorksModal" tabindex="-1" role="dialog" aria-labelledby="myLargeModalLabel" aria-hidden="true">
                            <div class="modal-dialog modal-lg" role="document">
                                <div class="modal-content">
                                    <div class="modal-header">
                                        <h4 class="modal-title" id="myModalLabel">How seller commission will get credited?</h4>
                                        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                                            <span aria-hidden="true">&times;</span>
                                        </button>
                                    </div>
                                    <div class="modal-body ">
                                        <ol>
                                            <li>
                                                Cron job must be set (For once in a day) on your server for seller commission to be work.
                                            </li>
                                            <li>
                                                Cron job will run every mid night at 12:00 AM.
                                            </li>
                                            <li>
                                                Formula for seller commision is <b>Sub total (Excluding delivery charge) / 100 * seller commission percentage</b>
                                            </li>
                                            <li>
                                                For example sub total is 1378 and seller commission is 20% then 1378 / 100 X 20 = 275.6 so 1378 - 275.6 = 1102.4 will get credited into seller's wallet
                                            </li>
                                            <li>
                                                If Order item's status is delivered then only seller will get commisison.
                                            </li>
                                            <li>
                                                Ex - 1. Order placed on 11-Aug-21 and product return days are set to 0 so 11-Aug + 0 days = 11-Aug seller commission will get credited on 12-Aug-21 at 12:00 AM (Mid night)
                                            </li>
                                            <li>
                                                Ex - 2. Order placed on 11-Aug-21 and product return days are set to 7 so 11-Aug + 7 days = 18-Aug seller commission will get credited on 19-Aug-21 at 12:00 AM (Mid night)
                                            </li>
                                            <li>
                                                If seller commission doesn't works make sure cron job is set properly and it is working. If you don't know how to set cron job for once in a day please take help of server support or do search for it.
                                            </li>
                                        </ol>
                                    </div>
                                </div>
                            </div>
                        </div>
                        <!--/.card-->
                    </div>
                    <!--/.col-md-12-->
                </div>
                <!-- /.row -->
            </div>
            <!-- /.container-fluid -->
    </section>
    
@endsection
