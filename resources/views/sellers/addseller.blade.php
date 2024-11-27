<div class="col-md-12">
                    <div class="card card-info">
                        <!-- form start -->
                        <form class="form-horizontal form-submit-event" action="https://avrluxe.com/admin/sellers/add_seller" method="POST" id="add_product_form">
                                                        <div class="card-body">
                                <div class="form-group row">
                                    <textarea cols="20" rows="20" id="cat_data" name="commission_data" style="display:none;"></textarea>
                                    <label for="name" class="col-sm-2 col-form-label">Name <span class='text-danger text-sm'>*</span></label>
                                    <div class="col-sm-10">
                                        <input type="text" class="form-control" id="name" placeholder="Seller Name" name="name" value="">
                                    </div>
                                </div>
                                <div class="form-group row">
                                    <label for="mobile" class="col-sm-2 col-form-label">Mobile <span class='text-danger text-sm'>*</span></label>
                                    <div class="col-sm-10">
                                        <input type="number" class="form-control" id="mobile" placeholder="Enter Mobile" name="mobile" value="">
                                    </div>
                                </div>
                                <div class="form-group row">
                                    <label for="email" class="col-sm-2 col-form-label">Email <span class='text-danger text-sm'>*</span></label>
                                    <div class="col-sm-10">
                                        <input type="email" class="form-control" id="email" placeholder="Enter Email" name="email" value="">
                                    </div>
                                </div>
                                                                    <div class="form-group row ">
                                        <label for="password" class="col-sm-2 col-form-label">Password <span class='text-danger text-sm'>*</span></label>
                                        <div class="col-sm-10">
                                            <input type="password" class="form-control" id="password" placeholder="Enter Passsword" name="password" value="">
                                        </div>
                                    </div>
                                    <div class="form-group row ">
                                        <label for="confirm_password" class="col-sm-2 col-form-label">Confirm Password <span class='text-danger text-sm'>*</span></label>
                                        <div class="col-sm-10">
                                            <input type="password" class="form-control" id="confirm_password" placeholder="Enter Confirm Password" name="confirm_password">
                                        </div>
                                    </div>
                                                                <div class="form-group row">
                                    <label for="address" class="col-sm-2 col-form-label">Address <span class='text-danger text-sm'>*</span></label>
                                    <div class="col-sm-10">
                                        <textarea type="text" class="form-control" id="address" placeholder="Enter Address" name="address"></textarea>
                                    </div>
                                </div>
                                <div class="form-group row">
                                    <label for="address_proof" class="col-sm-2 col-form-label">Address Proof <span class='text-danger text-sm'>*</span> </label>
                                    <div class="col-sm-10">
                                                                                <input type="file" class="form-control" name="address_proof" id="address_proof" accept="image/*" />
                                    </div>
                                </div>
                                                                <div class="form-group row">
                                    <label for="authorized_signature" class="col-sm-2 col-form-label">Authorized Signature <span class='text-danger text-sm'>*</span></label>
                                    <div class="col-sm-10">
                                                                                <input type="file" class="form-control" name="authorized_signature" id="authorized_signature" accept="image/*" />
                                    </div>
                                </div>
                                                              
                                <div class="form-group row">
                                    <label for="commission" class="col-sm-2 col-form-label">Commission(%) <small>(Commission(%) to be given to the Super Admin on order item globally.)</small> </label>
                                    <div class="col-sm-10">
                                        <input type="number" class="form-control" id="global_commission" placeholder="Enter Commission(%) to be given to the Super Admin on order item." name="global_commission" value="">
                                    </div>
                                </div>
                                <div class="form-group row">
                                                                        <label for="commission" class="col-sm-8 col-form-label">Choose Categories & Commission(%) <small>(Commission(%) to be given to the Super Admin on order item by Category you select.If you do not set the commission beside category then it will get global commission other wise perticuler category commission will be consider.)</small> </label>
                                    <div style="display:none" id="cat_html">
                                        <option value="13" class="l0"   >Kids Clothes</option><option value="16" class="l0"   >Earrings</option><option value="17" class="l0"   >Rings</option><option value="24" class="l1"   >tets</option><option value="18" class="l0"   >Bangles</option><option value="19" class="l0"   >Necklace</option><option value="20" class="l0"   >Hair Accessories</option><option value="21" class="l0"   >Hamper Box</option><option value="22" class="l0"   >Rakhi</option>                                    </div>
                                </div>
                                <div class="form-group row">
                                    <div class="col-sm-3 offset-2">
                                        <a href="javascript:void(0)" id="seller_model" data-seller_id="" data-cat_ids="" class=" btn btn-block  btn-outline-primary btn-sm" title="Manage Categories & Commission" data-target="#set_commission_model" data-toggle="modal">Manage</a>
                                    </div>
                                </div>
                                <h4>Store Details</h4>
                                <hr>
                                <div class="form-group row">
                                    <label for="store_name" class="col-sm-2 col-form-label">Name <span class='text-danger text-sm'>*</span></label>
                                    <div class="col-sm-10">
                                        <input type="text" class="form-control" id="store_name" placeholder="Store Name" name="store_name" value="">
                                    </div>
                                </div>
                                <div class="form-group row">
                                    <label for="store_url" class="col-sm-2 col-form-label">URL </label>
                                    <div class="col-sm-10">
                                        <input type="text" class="form-control" id="store_url" placeholder="Store URL" name="store_url" value="">
                                    </div>
                                </div>
                                <div class="form-group row">
                                    <label for="store_description" class="col-sm-2 col-form-label">Description </label>
                                    <div class="col-sm-10">
                                        <textarea type="text" class="form-control" id="store_description" placeholder="Store Description" name="store_description"></textarea>
                                    </div>
                                </div>
                                <div class="form-group row">
                                    <label for="logo" class="col-sm-2 col-form-label">Logo <span class='text-danger text-sm'>*</span></label>
                                    <div class="col-sm-10">
                                                                                <input type="file" class="form-control" name="store_logo" id="store_logo" accept="image/*" />
                                    </div>
                                </div>
                                                                <h4>Bank Details</h4>
                                <hr>
                                <div class="form-group row">
                                    <label for="account_number" class="col-sm-2 col-form-label">Account Number </label>
                                    <div class="col-sm-10">
                                        <input type="text" class="form-control" id="account_number" placeholder="Account Number" name="account_number" value="">
                                    </div>
                                </div>
                                <div class="form-group row">
                                    <label for="account_name" class="col-sm-2 col-form-label">Account Name </label>
                                    <div class="col-sm-10">
                                        <input type="text" class="form-control" id="account_name" placeholder="Account Name" name="account_name" value="">
                                    </div>
                                </div>
                                <div class="form-group row">
                                    <label for="bank_code" class="col-sm-2 col-form-label">Bank Code</label>
                                    <div class="col-sm-10">
                                        <input type="text" class="form-control" id="bank_code" placeholder="Bank Code" name="bank_code" value="">
                                    </div>
                                </div>
                                <div class="form-group row">
                                    <label for="bank_name" class="col-sm-2 col-form-label">Bank Name </label>
                                    <div class="col-sm-10">
                                        <input type="text" class="form-control" id="bank_name" placeholder="Bank Name" name="bank_name" value="">
                                    </div>
                                </div>
                                <h4>Other Details</h4>
                                <hr>
                                <div class="form-group row">
                                    <label class="col-sm-2 col-form-label">Status <span class='text-danger text-sm'>*</span></label>
                                    <div id="status" class="btn-group col-sm-4">
                                        <label class="btn btn-default" data-toggle-class="btn-default" data-toggle-passive-class="btn-default">
                                            <input type="radio" name="status" value="0" > Deactive
                                        </label>
                                        <label class="btn btn-primary" data-toggle-class="btn-primary" data-toggle-passive-class="btn-default">
                                            <input type="radio" name="status" value="1" > Approved
                                        </label>
                                        <label class="btn btn-danger" data-toggle-class="btn-danger" data-toggle-passive-class="btn-default">
                                            <input type="radio" name="status" value="2" > Not-Approved
                                        </label>
                                    </div>
                                </div>
                                <div class="form-group row">
                                    <label for="national_identity_card" class="col-sm-2 col-form-label">National Identity Card <span class='text-danger text-sm'>*</span></label>
                                    <div class="col-sm-10">
                                                                                <input type="file" class="form-control" name="national_identity_card" id="national_identity_card" accept="image/*" />
                                    </div>
                                </div>
                                                                <div class="form-group row">
                                    <label for="tax_name" class="col-sm-2 col-form-label">Tax Name <span class='text-danger text-sm'>*</span></label>
                                    <div class="col-sm-10">
                                        <input type="text" class="form-control" id="tax_name" placeholder="Tax Name" name="tax_name" value="">
                                    </div>
                                </div>
                                <div class="form-group row">
                                    <label for="tax_number" class="col-sm-2 col-form-label">Tax Number <span class='text-danger text-sm'>*</span></label>
                                    <div class="col-sm-10">
                                        <input type="text" class="form-control" id="tax_number" placeholder="Tax Number" name="tax_number" value="">
                                    </div>
                                </div>
                                <div class="form-group row">
                                    <label for="pan_number" class="col-sm-2 col-form-label">Pan Number </label>
                                    <div class="col-sm-10">
                                        <input type="text" class="form-control" id="pan_number" placeholder="Pan Number" name="pan_number" value="">
                                    </div>
                                </div>
                                <div class="form-group row">
                                    <label for="latitude" class="col-sm-2 col-form-label">Latitude </label>
                                    <div class="col-sm-10">
                                        <input type="text" class="form-control" id="latitude" placeholder="Latitude" name="latitude" value="">
                                    </div>
                                </div>
                                <div class="form-group row">
                                    <label for="longitude" class="col-sm-2 col-form-label">Longitude </label>
                                    <div class="col-sm-10">
                                        <input type="text" class="form-control" id="longitude" placeholder="Longitude" name="longitude" value="">
                                    </div>
                                </div>
                                <h4>Permissions </h4>
                                <hr>
                                                                <div class="form-group row">
                                    <label for="require_products_approval" class="col-sm-2 form-label">Require Product's Approval? <span class='text-danger text-sm'>*</span></label>
                                    <div class="col-sm-1">
                                        <input type="checkbox" name="require_products_approval"  data-bootstrap-switch data-off-color="danger" data-on-color="success">
                                    </div>
                                    <label for="customer_privacy" class="form-label">View Customer's Details? <span class='text-danger text-sm'>*</span></label>
                                    <div class="col-sm-1">
                                        <input type="checkbox" name="customer_privacy"  data-bootstrap-switch data-off-color="danger" data-on-color="success">
                                    </div>
                                    <label for="view_order_otp" class="form-label">View Order's OTP? & Can chnage deliver status? <span class='text-danger text-sm'>*</span></label>
                                    <div class="col-sm-1">
                                        <input type="checkbox" name="view_order_otp"  data-bootstrap-switch data-off-color="danger" data-on-color="success">
                                    </div>
                                    <label for="assign_delivery_boy" class="form-label">Can assign delivery boy? <span class='text-danger text-sm'>*</span></label>
                                    <div class="col-sm-1">
                                        <input type="checkbox" name="assign_delivery_boy"  data-bootstrap-switch data-off-color="danger" data-on-color="success">
                                    </div>
                                </div>

                                <div class="form-group">
                                    <button type="reset" class="btn btn-warning">Reset</button>
                                    <button type="submit" class="btn btn-success" id="submit_btn">Add Seller</button>
                                </div>
                            </div>
                            <div class="d-flex justify-content-center">
                                <div class="form-group" id="error_box">
                                    <div class="card text-white d-none mb-3">
                                    </div>
                                </div>
                            </div>
                            <!-- /.card-footer -->
                        </form>
                    </div>
                    <!--/.card-->
                </div>
                <!--/.col-md-12-->
            </div>