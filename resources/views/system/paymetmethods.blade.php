@extends('admin.body.adminmaster')

@section('admin')
<div class="page-wrapper">
     <div class="container-fluid">

    <form action="{{ route('payments_methods') }}" method="get"></form>
    
    <!--<div class="content-wrapper">-->
    <!-- Content Header (Page header) -->
    <!-- Main content -->
    <section class="content-header">
        <div class="container-fluid">
            <div class="row mb-2">
                <div class="col-sm-6">
                    <h4>Payment Methods Settings</h4>
                </div>
                <div class="col-sm-6">
                    <ol class="breadcrumb float-sm-right">
                        <li class="breadcrumb-item"><a href="#">Home</a>
                        </li>
                        <li class="breadcrumb-item active">Payment Methods Settings</li>
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
                        <form class="form-horizontal form-submit-event" action="#" method="POST" id="payment_setting_form">
                            <div class="card-body">
                                <h5>Paypal Payments</h5>
                                <hr>
                                <div class="row">
                                    <div class="form-group col-md-4">
                                        <label for="paypal_payment_method">Paypal Payments <small>[ Enable / Disable ] </small></label>
                                    </div>
                                    <div class="form-group col-md-8">
                                        <input class="pull-right" type="checkbox" name="paypal_payment_method"  data-bootstrap-switch data-off-color="danger" data-on-color="success">
                                    </div>
                                </div>
                                <div class="row">
                                    <div class="form-group col-md-4">
                                        <label for="">Payment Mode <small>[ sandbox / live ]</small></label>
                                    </div>
                                    <div class="form-group col-md-8">
                                        <select name="paypal_mode" class="form-control" required>
                                            <option value="">Select Mode</option>
                                            <option value="sandbox" selected>Sandbox ( Testing )</option>
                                            <option value="production" >Production ( Live )</option>
                                        </select>
                                    </div>
                                </div>
                                <div class="row">
                                    <div class="form-group col-md-4">
                                        <label for="paypal_business_email">Paypal Business Email</label>
                                    </div>
                                    <div class="form-group col-md-8">
                                        <input type="text" class="form-control" name="paypal_business_email" value="paypal_business_email" placeholder="Paypal Business Email" />
                                    </div>
                                </div>
                                <div class="row">
                                    <div class="form-group col-md-4">
                                        <label for="currency_code">Currency code</label>
                                    </div>
                                    <div class="form-group col-md-8">
                                        <select class="form-control" name="currency_code" value="USD">
                                            <option value="AUD" >AUD</option>
                                            <option value="BRL" >BRL</option>
                                            <option value="CAD" >CAD</option>
                                            <option value="CNY" >CNY</option>
                                            <option value="CZK" >CZK</option>
                                            <option value="DKK" >DKK</option>
                                            <option value="EUR" >EUR</option>
                                            <option value="HKD" >HKD</option>
                                            <option value="HUF" >HUF</option>
                                            <option value="INR" >INR</option>
                                            <option value="ILS" >ILS</option>
                                            <option value="JPY" >JPY</option>
                                            <option value="MYR" >MYR</option>
                                            <option value="MXN" >MXN</option>
                                            <option value="TWD" >TWD</option>
                                            <option value="NZD" >NZD</option>
                                            <option value="NOK" >NOK</option>
                                            <option value="PHP" >PHP</option>
                                            <option value="PLN" >PLN</option>
                                            <option value="GBP" >GBP</option>
                                            <option value="RUB" >RUB</option>
                                            <option value="SGD" >SGD</option>
                                            <option value="SEK" >SEK</option>
                                            <option value="CHF" >CHF</option>
                                            <option value="THB" >THB</option>
                                            <option value="USD" selected>USD</option>
                                        </select>
                                    </div>
                                </div>
                                <div class="row">
                                    <div class="form-group col-md-4">
                                        <label>Notification URL <small>(Set this as IPN notification URL in you PayPal account)</small></label>
                                    </div>
                                    <div class="form-group col-md-8">
                                        <input type="text" class="form-control" readonly value="https://avrluxe.com/app/v1/api/ipn" />
                                    </div>
                                </div>
                                <h5>Razorpay Payments </h5>
                                <hr>
                                <div class="row">
                                    <div class="form-group col-md-4">
                                        <label for="razorpay_payment_method">Razorpay Payments <small>[ Enable / Disable ] </small>
                                        </label>
                                    </div>
                                    <div class="form-group col-md-8">
                                        <input type="checkbox" name="razorpay_payment_method"  data-bootstrap-switch data-off-color="danger" data-on-color="success">
                                    </div>
                                </div>
                                <div class="row">
                                    <div class="form-group col-md-4">
                                        <label for="razorpay_key_id">Razorpay key ID</label>
                                    </div>
                                    <div class="form-group col-md-8">
                                        <input type="text" class="form-control" name="razorpay_key_id" value="rzp_test_key" placeholder="Razor Key ID" />
                                    </div>
                                </div>
                                <div class="row">
                                    <div class="form-group col-md-4">
                                        <label for="razorpay_secret_key">Secret Key</label>
                                    </div>
                                    <div class="form-group col-md-8">
                                        <input type="text" class="form-control" name="razorpay_secret_key" value="secret_key" placeholder="Razorpay Secret Key " />
                                    </div>
                                </div>
                                <div class="row">
                                    <div class="form-group col-md-4">
                                        <label for="razorpay__webhook_url">Payment Endpoint URL <small>(Set this as Endpoint URL in your Razorpay account)</small></label>
                                    </div>
                                    <div class="form-group col-md-8">
                                        <input type="text" class="form-control" name="razorpay__webhook_url" value="https://avrluxe.com/admin/webhook/razorpay" disabled />
                                    </div>
                                </div>
                                <div class="row">
                                    <div class="form-group col-md-4">
                                        <label for="refund_webhook_secret_key">Webhoook Secret Key</label>
                                    </div>
                                    <div class="form-group col-md-8">
                                        <input type="text" class="form-control" name="refund_webhook_secret_key" value="" />
                                    </div>
                                </div>

                                <h5>Paystack Payments </h5>
                                <hr>
                                <div class="row">
                                    <div class="form-group col-md-4">
                                        <label for="paystack_payment_method">Paystack Payments <small>[ Enable / Disable ] </small></label>
                                    </div>
                                    <div class="form-group col-md-8">
                                        <input type="checkbox" name="paystack_payment_method"  data-bootstrap-switch data-off-color="danger" data-on-color="success">
                                    </div>
                                </div>
                                <div class="row">
                                    <div class="form-group col-md-4">
                                        <label for="paystack_key_id">Paystack key ID</label>
                                    </div>
                                    <div class="form-group col-md-8">
                                        <input type="text" class="form-control" name="paystack_key_id" value="paystack_public_key" placeholder="Paystack Public Key" />
                                    </div>
                                </div>
                                <div class="row">
                                    <div class="form-group col-md-4">
                                        <label for="paystack_secret_key">Secret Key</label>
                                    </div>
                                    <div class="form-group col-md-8">
                                        <input type="text" class="form-control" name="paystack_secret_key" value="paystack_secret_key" placeholder="Paystack Secret Key " />
                                    </div>
                                </div>
                                <div class="row">
                                    <div class="form-group col-md-4">
                                        <label for="paystack_webhook_url">Payment Endpoint URL <small>(Set this as Endpoint URL in your paystack account)</small></label>
                                    </div>
                                    <div class="form-group col-md-8">
                                        <input type="text" class="form-control" name="paystack_webhook_url" value="#" disabled />
                                    </div>
                                </div>
                                <h5>Stripe Payments </h5>
                                <hr>
                                <div class="row">
                                    <div class="form-group col-md-4">
                                        <label for="stripe_payment_method">Stripe Payments <small>[ Enable / Disable ] </small></label>
                                    </div>
                                    <div class="form-group col-md-8">
                                        <input type="checkbox" name="stripe_payment_method"  data-bootstrap-switch data-off-color="danger" data-on-color="success">
                                    </div>
                                </div>

                                <div class="row">
                                    <div class="form-group col-md-4">
                                        <label for="">Payment Mode <small>[ sandbox / live ]</small></label>
                                    </div>
                                    <div class="form-group col-md-8">
                                        <select name="stripe_payment_mode" class="form-control" required>
                                            <option value="">Select Mode</option>
                                            <option value="test" selected>Test</option>
                                            <option value="live" >Live</option>
                                        </select>
                                    </div>
                                </div>
                                <div class="row">
                                    <div class="form-group col-md-4">
                                        <label for="stripe_webhook_url">Payment Endpoint URL <small>(Set this as Endpoint URL in your Stripe account)</small></label>
                                    </div>
                                    <div class="form-group col-md-8">
                                        <input type="text" class="form-control" name="stripe_webhook_url" value="#" disabled />
                                    </div>
                                </div>
                                <div class="row">
                                    <div class="form-group col-md-4">
                                        <label for="stripe_publishable_key">Stripe Publishable Key</label>
                                    </div>
                                    <div class="form-group col-md-8">
                                        <input type="text" class="form-control" name="stripe_publishable_key" value="test_key" placeholder="Stripe Publishable Key" />
                                    </div>
                                </div>
                                <div class="row">
                                    <div class="form-group col-md-4">
                                        <label for="stripe_secret_key">Stripe Secret Key</label>
                                    </div>
                                    <div class="form-group col-md-8">
                                        <input type="text" class="form-control" name="stripe_secret_key" value="test_key" placeholder="Stripe Secret Key" />
                                    </div>
                                </div>
                                <div class="row">
                                    <div class="form-group col-md-4">
                                        <label for="stripe_webhook_secret_key">Stripe Webhook Secret Key</label>
                                    </div>
                                    <div class="form-group col-md-8">
                                        <input type="text" class="form-control" name="stripe_webhook_secret_key" value="webhook_secret" placeholder="Stripe Webhook Secret Key" />
                                    </div>
                                </div>
                                <div class="row">
                                    <div class="form-group col-md-4">
                                        <label for="">Currency Code <small>[ Stripe supported ]</small> <a href="#" target="_BLANK"><i class="fa fa-link"></i></a></label>
                                    </div>
                                    <div class="form-group col-md-8">
                                        <select name="stripe_currency_code" class="form-control">
                                            <option value="">Select Currency Code </option>
                                            <option value="INR" selected>Indian rupee </option>
                                            <option value="USD" >United States dollar </option>
                                            <option value="AED" >United Arab Emirates Dirham </option>
                                            <option value="AFN" >Afghan Afghani </option>
                                            <option value="ALL" >Albanian Lek </option>
                                            <option value="AMD" >Armenian Dram </option>
                                            <option value="ANG" >Netherlands Antillean Guilder </option>
                                            <option value="AOA" >Angolan Kwanza </option>
                                            <option value="ARS" >Argentine Peso</option>
                                            <option value="AUD" > Australian Dollar</option>
                                            <option value="AWG" > Aruban Florin</option>
                                            <option value="AZN" > Azerbaijani Manat </option>
                                            <option value="BAM" > Bosnia-Herzegovina Convertible Mark </option>
                                            <option value="BBD" > Bajan dollar </option>
                                            <option value="BDT" > Bangladeshi Taka</option>
                                            <option value="BGN" > Bulgarian Lev </option>
                                            <option value="BIF" >Burundian Franc</option>
                                            <option value="BMD" > Bermudan Dollar</option>
                                            <option value="BND" > Brunei Dollar </option>
                                            <option value="BOB" > Bolivian Boliviano </option>
                                            <option value="BRL" > Brazilian Real </option>
                                            <option value="BSD" > Bahamian Dollar </option>
                                            <option value="BWP" > Botswanan Pula </option>
                                            <option value="BZD" > Belize Dollar </option>
                                            <option value="CAD" > Canadian Dollar </option>
                                            <option value="CDF" > Congolese Franc </option>
                                            <option value="CHF" > Swiss Franc </option>
                                            <option value="CLP" > Chilean Peso </option>
                                            <option value="CNY" > Chinese Yuan </option>
                                            <option value="COP" > Colombian Peso </option>
                                            <option value="CRC" > Costa Rican Colón </option>
                                            <option value="CVE" > Cape Verdean Escudo </option>
                                            <option value="CZK" > Czech Koruna </option>
                                            <option value="DJF" > Djiboutian Franc </option>
                                            <option value="DKK" > Danish Krone </option>
                                            <option value="DOP" > Dominican Peso </option>
                                            <option value="DZD" > Algerian Dinar </option>
                                            <option value="EGP" > Egyptian Pound </option>
                                            <option value="ETB" > Ethiopian Birr </option>
                                            <option value="EUR" > Euro </option>
                                            <option value="FJD" > Fijian Dollar </option>
                                            <option value="FKP" > Falkland Island Pound </option>
                                            <option value="GBP" > Pound sterling </option>
                                            <option value="GEL" > Georgian Lari </option>
                                            <option value="GIP" > Gibraltar Pound </option>
                                            <option value="GMD" > Gambian dalasi </option>
                                            <option value="GNF" > Guinean Franc </option>
                                            <option value="GTQ" > Guatemalan Quetzal </option>
                                            <option value="GYD" > Guyanaese Dollar </option>
                                            <option value="HKD" > Hong Kong Dollar </option>
                                            <option value="HNL" > Honduran Lempira </option>
                                            <option value="HRK" > Croatian Kuna </option>
                                            <option value="HTG" > Haitian Gourde </option>
                                            <option value="HUF" > Hungarian Forint </option>
                                            <option value="IDR" > Indonesian Rupiah </option>
                                            <option value="ILS" > Israeli New Shekel </option>
                                            <option value="ISK" > Icelandic Króna </option>
                                            <option value="JMD" > Jamaican Dollar </option>
                                            <option value="JPY" > Japanese Yen </option>
                                            <option value="KES" > Kenyan Shilling </option>
                                            <option value="KGS" > Kyrgystani Som </option>
                                            <option value="KHR" > Cambodian riel </option>
                                            <option value="KMF" > Comorian franc </option>
                                            <option value="KRW" > South Korean won </option>
                                            <option value="KYD" > Cayman Islands Dollar </option>
                                            <option value="KZT" > Kazakhstani Tenge </option>
                                            <option value="LAK" > Laotian Kip </option>
                                            <option value="LBP" > Lebanese pound </option>
                                            <option value="LKR" > Sri Lankan Rupee </option>
                                            <option value="LRD" > Liberian Dollar </option>
                                            <option value="LSL" >Lesotho loti </option>
                                            <option value="MAD" > Moroccan Dirham </option>
                                            <option value="MDL" > Moldovan Leu </option>
                                            <option value="MGA" > Malagasy Ariary </option>
                                            <option value="MKD" > Macedonian Denar </option>
                                            <option value="MMK" > Myanmar Kyat </option>
                                            <option value="MNT" > Mongolian Tugrik </option>
                                            <option value="MOP" > Macanese Pataca </option>
                                            <option value="MRO" > Mauritanian Ouguiya </option>
                                            <option value="MUR" > Mauritian Rupee</option>
                                            <option value="MVR" > Maldivian Rufiyaa </option>
                                            <option value="MWK" > Malawian Kwacha </option>
                                            <option value="MXN" > Mexican Peso </option>
                                            <option value="MYR" > Malaysian Ringgit </option>
                                            <option value="MZN" > Mozambican metical </option>
                                            <option value="NAD" > Namibian dollar </option>
                                            <option value="NGN" > Nigerian Naira </option>
                                            <option value="NIO" >Nicaraguan Córdoba </option>
                                            <option value="NOK" > Norwegian Krone </option>
                                            <option value="NPR" > Nepalese Rupee </option>
                                            <option value="NZD" > New Zealand Dollar </option>
                                            <option value="PAB" > Panamanian Balboa </option>
                                            <option value="PEN" > Sol </option>
                                            <option value="PGK" > Papua New Guinean Kina </option>
                                            <option value="PHP" >Philippine peso </option>
                                            <option value="PKR" > Pakistani Rupee </option>
                                            <option value="PLN" > Poland złoty </option>
                                            <option value="PYG" > Paraguayan Guarani </option>
                                            <option value="QAR" > Qatari Rial </option>
                                            <option value="RON" >Romanian Leu </option>
                                            <option value="RSD" > Serbian Dinar </option>
                                            <option value="RUB" > Russian Ruble </option>
                                            <option value="RWF" > Rwandan franc </option>
                                            <option value="SAR" > Saudi Riyal </option>
                                            <option value="SBD" > Solomon Islands Dollar </option>
                                            <option value="SCR" >Seychellois Rupee </option>
                                            <option value="SEK" > Swedish Krona </option>
                                            <option value="SGD" > Singapore Dollar </option>
                                            <option value="SHP" > Saint Helenian Pound </option>
                                            <option value="SLL" > Sierra Leonean Leone </option>
                                            <option value="SOS" >Somali Shilling </option>
                                            <option value="SRD" > Surinamese Dollar </option>
                                            <option value="STD" > Sao Tome Dobra </option>
                                            <option value="SZL" > Swazi Lilangeni </option>
                                            <option value="THB" > Thai Baht </option>
                                            <option value="TJS" > Tajikistani Somoni </option>
                                            <option value="TOP" > Tongan Paʻanga </option>
                                            <option value="TRY" > Turkish lira </option>
                                            <option value="TTD" > Trinidad & Tobago Dollar </option>
                                            <option value="TWD" > New Taiwan dollar </option>
                                            <option value="TZS" > Tanzanian Shilling </option>
                                            <option value="UAH" > Ukrainian hryvnia </option>
                                            <option value="UGX" > Ugandan Shilling </option>
                                            <option value="UYU" > Uruguayan Peso </option>
                                            <option value="UZS" > Uzbekistani Som </option>
                                            <option value="VND" > Vietnamese dong </option>
                                            <option value="VUV" > Vanuatu Vatu </option>
                                            <option value="WST" > Samoa Tala</option>
                                            <option value="XAF" > Central African CFA franc </option>
                                            <option value="XCD" > East Caribbean Dollar </option>
                                            <option value="XOF" > West African CFA franc </option>
                                            <option value="XPF" > CFP Franc </option>
                                            <option value="YER" > Yemeni Rial </option>
                                            <option value="ZAR" > South African Rand </option>
                                            <option value="ZMW" > Zambian Kwacha </option>
                                        </select>
                                    </div>
                                </div>

                                <h5>Flutterwave Payments </h5>
                                <hr>
                                <div class="row">
                                    <div class="form-group col-md-4">
                                        <label for="flutterwave_payment_method">Flutterwave Payments <small>[ Enable / Disable ] </small></label>
                                    </div>
                                    <div class="form-group col-md-8">
                                        <input type="checkbox" name="flutterwave_payment_method"  data-bootstrap-switch data-off-color="danger" data-on-color="success">
                                    </div>
                                </div>

                                <div class="row">
                                    <div class="form-group col-md-4">
                                        <label for="flutterwave_public_key">Flutterwave Public Key</label>
                                    </div>
                                    <div class="form-group col-md-8">
                                        <input type="text" class="form-control" name="flutterwave_public_key" value="public_key" placeholder="Flutterwave Public Key" />
                                    </div>
                                </div>
                                <div class="row">
                                    <div class="form-group col-md-4">
                                        <label for="flutterwave_secret_key">Secret Key</label>
                                    </div>
                                    <div class="form-group col-md-8">
                                        <input type="text" class="form-control" name="flutterwave_secret_key" value="secret_key" placeholder="Flutterwave Secret Key " />
                                    </div>
                                </div>
                                <div class="row">
                                    <div class="form-group col-md-4">
                                        <label for="flutterwave_encryption_key">Flutterwave Encryption key</label>
                                    </div>
                                    <div class="form-group col-md-8">
                                        <input type="text" class="form-control" name="flutterwave_encryption_key" value="enc_key" placeholder="Flutterwave Encryption Key " />
                                    </div>
                                </div>
                                <div class="row">
                                    <div class="form-group col-md-4">
                                        <label for="flutterwave_currency_code">Currency Code <small>[ Flutterwave supported ]</small> </label>
                                    </div>
                                    <div class="form-group col-md-8">
                                        <select name="flutterwave_currency_code" class="form-control">
                                            <option value="">Select Currency Code </option>
                                            <option value="NGN" selected>Nigerian Naira</option>
                                            <option value="USD" >United States dollar</option>
                                            <option value="TZS" >Tanzanian Shilling</option>
                                            <option value="SLL" >Sierra Leonean Leone</option>
                                            <option value="MUR" >Mauritian Rupee</option>
                                            <option value="MWK" >Malawian Kwacha </option>
                                            <option value="GBP" >UK Bank Accounts</option>
                                            <option value="GHS" >Ghanaian Cedi</option>
                                            <option value="RWF" >Rwandan franc</option>
                                            <option value="UGX" >Ugandan Shilling</option>
                                            <option value="ZMW" >Zambian Kwacha</option>
                                            <option value="KES" >Mpesa</option>
                                            <option value="ZAR" >South African Rand</option>
                                            <option value="XAF" >Central African CFA franc</option>
                                            <option value="XOF" >West African CFA franc</option>
                                            <option value="AUD" >Australian Dollar</option>
                                        </select>
                                    </div>
                                </div>
                                <div class="row">
                                    <div class="form-group col-md-4">
                                        <label for="flutterwave_webhook_secret_key">Flutterwave Webhook Secret Key</label>
                                    </div>
                                    <div class="form-group col-md-8">
                                        <input type="text" class="form-control" name="flutterwave_webhook_secret_key" value="" placeholder="Flutterwave Webhook Secret Key" />
                                    </div>
                                </div>
                                <div class="row">
                                    <div class="form-group col-md-4">
                                        <label for="flutterwave_webhook_url">Payment Endpoint URL <small>(Set this as Endpoint URL in your flutterwave account)</small></label>
                                    </div>
                                    <div class="form-group col-md-8">
                                        <input type="text" class="form-control" name="flutterwave_webhook_url" value="https://avrluxe.com/app/v1/api/flutterwave-webhook" disabled />
                                    </div>
                                </div>

                                <h5>Paytm Payments </h5>
                                <hr>
                                <div class="row">
                                    <div class="form-group col-md-4">
                                        <label for="paytm_payment_method">Paytm Payments <small>[ Enable / Disable ] </small></label>
                                    </div>
                                    <div class="form-group col-md-8">
                                        <input type="checkbox" name="paytm_payment_method"  data-bootstrap-switch data-off-color="danger" data-on-color="success">
                                    </div>
                                </div>
                                <div class="row">
                                    <div class="form-group col-md-4">
                                        <label for="">Paytm Mode <small>[ sandbox / live ]</small></label>
                                    </div>
                                    <div class="form-group col-md-8">
                                        <select name="paytm_payment_mode" class="form-control" required>
                                            <option value="">Select Mode</option>
                                            <option value="sandbox" selected>Sandbox</option>
                                            <option value="production" >Production</option>
                                        </select>
                                    </div>
                                </div>
                                <div class="row">
                                    <div class="form-group col-md-4">
                                        <label for="paytm_merchant_key">Paytm Merchant Key </label>
                                    </div>
                                    <div class="form-group col-md-8">
                                        <input type="text" class="form-control" name="paytm_merchant_key" value="merchant_key" placeholder="Paytm Merchant Key" />
                                    </div>
                                </div>
                                <div class="row">
                                    <div class="form-group col-md-4">
                                        <label for="paytm_merchant_id">Paytm Merchant ID </label>
                                    </div>
                                    <div class="form-group col-md-8">
                                        <input type="text" class="form-control" name="paytm_merchant_id" value="merchant_id" placeholder="Paytm Merchant ID" />
                                    </div>
                                </div>
                                                                    <div class="row">
                                        <div class="form-group col-md-4">
                                            <label for="paytm_website">Paytm Website <small>[<a href="https://dashboard.paytm.com/next/apikeys?src=dev" target="_blank">click here</a> to know]</small></label>
                                        </div>
                                        <div class="form-group col-md-8">
                                            <input type="text" class="form-control" name="paytm_website" placeholder="Paytm Website" />
                                        </div>
                                    </div>
                                    <div class="row">
                                        <div class="form-group col-md-4">
                                            <label for="paytm_industry_type_id">Industry Type ID <small>[<a href="https://dashboard.paytm.com/next/apikeys?src=dev" target="_blank">click here</a> to know]</small></label>
                                        </div>
                                        <div class="form-group col-md-8">
                                            <input type="text" class="form-control" name="paytm_industry_type_id" placeholder="Industry Type ID" />
                                        </div>
                                    </div>
                                
                                <h5>Midtrans Payments </h5>
                                <hr>
                                <div class="row">
                                    <div class="form-group col-md-4">
                                        <label for="midtrans_payment_method">Midtrans Payments <small>[ Enable / Disable ] </small></label>
                                    </div>
                                    <div class="form-group col-md-8">
                                        <input type="checkbox" name="midtrans_payment_method"  data-bootstrap-switch data-off-color="danger" data-on-color="success">
                                    </div>
                                </div>
                                <div class="row">
                                    <div class="form-group col-md-4">
                                        <label for="">Midtrans Mode <small>[ sandbox / live ]</small></label>
                                    </div>
                                    <div class="form-group col-md-8">
                                        <select name="midtrans_payment_mode" class="form-control" required>
                                            <option value="">Select Mode</option>
                                            <option value="sandbox" selected>Sandbox</option>
                                            <option value="production" >Live</option>
                                        </select>
                                    </div>
                                </div>
                                <div class="row">
                                    <div class="form-group col-md-4">
                                        <label for="midtrans_client_key">Midtrans Client Key </label>
                                    </div>
                                    <div class="form-group col-md-8">
                                        <input type="text" class="form-control" name="midtrans_client_key" value="" placeholder="Midtrans Client Key" />
                                    </div>
                                </div>
                                <div class="row">
                                    <div class="form-group col-md-4">
                                        <label for="midtrans_merchant_id">Midtrans Merchant ID </label>
                                    </div>
                                    <div class="form-group col-md-8">
                                        <input type="text" class="form-control" name="midtrans_merchant_id" value="" placeholder="Midtrans Merchant ID" />
                                    </div>
                                </div>
                                <div class="row">
                                    <div class="form-group col-md-4">
                                        <label for="midtrans_server_key">Midtrans Server Key </label>
                                    </div>
                                    <div class="form-group col-md-8">
                                        <input type="text" class="form-control" name="midtrans_server_key" value="" placeholder="Midtrans Server Key" />
                                    </div>
                                </div>
                                <div class="row">
                                    <div class="form-group col-md-4">
                                        <label>Notification URL <small>(Set this as Webhook URL in your Midtrans account)</small></label>
                                    </div>
                                    <div class="form-group col-md-8">
                                        <input type="text" class="form-control" readonly value="https://avrluxe.com/app/v1/api/midtrans_webhook" />
                                    </div>
                                </div>
                                <div class="row">
                                    <div class="form-group col-md-4">
                                        <label>Payment Return URL <small>(Set this as Finish URL in your Midtrans account)</small></label>
                                    </div>
                                    <div class="form-group col-md-8">
                                        <input type="text" class="form-control" readonly value="https://avrluxe.com/app/v1/api/midtrans_payment_process" />
                                    </div>
                                </div>
                                <!-- -------------------------------  Myfaroorah Payments  -------------------------------- -->


                                <h5>Myfatoorah Payments Settings</h5>
                                <hr>
                                <div class="row">
                                    <div class="form-group col-md-4">
                                        <label for="myfaoorah_payment_method">Myfatoorah Payments <small>[ Enable / Disable ] </small></label>
                                    </div>
                                    <div class="form-group col-md-8">
                                        <input type="checkbox" name="myfaoorah_payment_method"  data-bootstrap-switch data-off-color="danger" data-on-color="success">
                                    </div>
                                </div>
                                <div class="row">
                                    <div class="form-group col-md-4">
                                        <label for="myfatoorah_token">Myfatoorah Token </label>
                                    </div>
                                    <div class="form-group col-md-8">
                                        <textarea rows=4 name="myfatoorah_token" class="form-control">0</textarea>
                                    </div>
                                </div>
                                <div class="row">
                                    <div class="form-group col-md-4">
                                        <label for="">Myfatoorah Mode <small>[ test / live ]</small>
                                        </label>
                                    </div>
                                    <div class="form-group col-md-8">
                                        <select name="myfatoorah_payment_mode" class="form-control" required>
                                            <option value="">Select Mode</option>
                                            <option value="test" selected>Test</option>
                                            <option value="live" >Live</option>
                                        </select>
                                    </div>
                                </div>
                                <div class="row">
                                    <div class="form-group col-md-4">
                                        <label for="myfatoorah_language">Myfatoorah Language </label>
                                    </div>
                                    <div class="form-group col-md-8">
                                        <select name="myfatoorah_language" class="form-control" required>
                                            <option value="">Select Language</option>
                                            <option value="english" selected>English</option>
                                            <option value="arabic" >Arabic</option>
                                        </select>
                                    </div>
                                </div>
                                <div class="row">
                                    <div class="form-group col-md-4">
                                        <label for="myfatoorah_webhook_url">Payment Endpoint URL <small>(Set this as Endpoint URL in your Myfatoorah account)</small></label>
                                    </div>
                                    <div class="form-group col-md-8">
                                        <input type="text" class="form-control" name="myfatoorah__webhook_url" value="https://avrluxe.com/admin/webhook/myfatoorah" readonly />
                                    </div>
                                </div>
                                <div class="row">
                                    <div class="form-group col-md-4">
                                        <label for="myfatoorah_country">Myfatoorah Country <small>[ test / live ]</small></label>
                                    </div>
                                    <div class="form-group col-md-8">
                                        <select name="myfatoorah_country" class="form-control" required>
                                            <option value="">Select country</option>
                                            <option value="Kuwait" selected>Kuwait</option>
                                            <option value="SaudiArabia" >SaudiArabia</option>
                                            <option value="Bahrain" >Bahrain</option>
                                            <option value="UAE" >UAE</option>
                                            <option value="Qatar" >Qatar</option>
                                            <option value="Oman" >Oman</option>
                                            <option value="Jordan" >Jordan</option>
                                        </select>
                                    </div>
                                </div>
                                <div class="row">
                                    <div class="form-group col-md-4">
                                        <label for="myfatoorah__successUrl">Payment success Url </label>
                                    </div>
                                    <div class="form-group col-md-8">
                                        <input type="text" class="form-control" name="myfatoorah__successUrl" value="https://avrluxe.com/admin/webhook/myfatoorah_success_url" readonly />
                                    </div>
                                </div>
                                <div class="row">
                                    <div class="form-group col-md-4">
                                        <label for="myfatoorah__errorUrl">Payment error Url </label>
                                    </div>
                                    <div class="form-group col-md-8">
                                        <input type="text" class="form-control" name="myfatoorah__errorUrl" value="https://avrluxe.com/admin/webhook/myfatoorah_error_url" readonly />
                                    </div>
                                </div>
                                <div class="row">
                                    <div class="form-group col-md-4">
                                        <label for="myfatoorah__secret_key">Myfatoorah Secret Key </label>
                                    </div>
                                    <div class="form-group col-md-8">
                                        <input type="text" class="form-control" name="myfatoorah__secret_key" value="" />

                                    </div>
                                </div>
                                <!--------------------------------------------------------------------------------------------------  -->
                                <h5>Direct Bank Transfer </h5>
                                <hr>
                                <div class="row">
                                    <div class="form-group col-md-4">
                                        <label for="direct_bank_transfer">Direct Bank Transfer <small>[ Enable / Disable ] </small></label>
                                    </div>
                                    <div class="form-group col-md-8">
                                        <input type="checkbox" name="direct_bank_transfer"  data-bootstrap-switch data-off-color="danger" data-on-color="success">
                                    </div>
                                </div>
                                <div class="row">
                                    <div class="form-group col-md-4">
                                        <label for="account_name">Account Name</label>
                                    </div>
                                    <div class="form-group col-md-8">
                                        <input type="text" class="form-control" name="account_name" value="Asdfghj" placeholder="Account Name" />
                                    </div>
                                </div>
                                <div class="row">
                                    <div class="form-group col-md-4">
                                        <label for="account_number">Account Number</label>
                                    </div>
                                    <div class="form-group col-md-8">
                                        <input type="number" step="any" class="form-control" name="account_number" value="020211022000001" placeholder="Account Number " />
                                    </div>
                                </div>
                                <div class="row">
                                    <div class="form-group col-md-4">
                                        <label for="bank_name">Bank Name</label>
                                    </div>
                                    <div class="form-group col-md-8">
                                        <input type="text" class="form-control" name="bank_name" value="State Bank of India" placeholder="Bank Name " />
                                    </div>
                                </div>
                                <div class="row">
                                    <div class="form-group col-md-4">
                                        <label for="bank_code">Bank Code</label>
                                    </div>
                                    <div class="form-group col-md-8">
                                        <input type="text" class="form-control" name="bank_code" value="SBIIN00073333333" placeholder="Bank Code " />
                                    </div>
                                </div>
                                <div class="row">
                                    <div class="form-group col-md-12">
                                        <label for="notes">Extra Notes</label>
                                        <textarea name="notes" class="textarea addr_editor" placeholder="Extra Notes">  <p>Please do not forget to upload the bank transfer receipt upon sending / depositing money to the above-mentioned account. Once the amount deposit is confirmed the order will be processed further. To upload the receipt go to your order details page or screen and find a form to upload the receipt.</p></textarea>
                                    </div>
                                </div>
                                <h5>Cash On Delivery </h5>
                                <hr>
                                <div class="row">
                                    <div class="form-group col-md-4">
                                        <label for="cod_method">COD <small>[ Enable / Disable ] </small></label>
                                    </div>
                                    <div class="form-group col-md-8">
                                        <input type="checkbox" name="cod_method" Checked data-bootstrap-switch data-off-color="danger" data-on-color="success">
                                    </div>
                                </div>
                                <div class="form-group">
                                    <button type="reset" class="btn btn-warning">Reset</button>
                                    <button type="submit" class="btn btn-success" id="submit_btn">Update Payment Settings</button>
                                </div>
                            </div>
                            <div class="d-flex justify-content-center">
                                <div class="form-group" id="error_box">
                                </div>
                            </div>
                        </form>
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
