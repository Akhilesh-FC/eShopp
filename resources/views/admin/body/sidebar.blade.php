<aside class="left-sidebar" data-sidebarbg="skin5">
            <!-- Sidebar scroll-->
            
            <style>
                .scroll-sidebar {
                    max-height: 100vh;  /* Sidebar ka max height viewport ki height ke barabar hoga */
                    overflow-y: auto;   /* Vertical scroll enable karega jab content zyada ho */
                }
            </style>
            
            <div class="scroll-sidebar">
                <!-- Sidebar navigation-->
                <nav class="sidebar-nav">
                    <ul id="sidebarnav">
                                               <li class="sidebar-item"> <a class="sidebar-link waves-effect waves-dark sidebar-link" href="{{ route('dashboard') }}" aria-expanded="false"><i class="mdi mdi-view-dashboard"></i><span class="hide-menu">Dashboard</span></a></li>
                        <li class="sidebar-item"> <a class="sidebar-link has-arrow waves-effect waves-dark" href="javascript:void(0)" aria-expanded="false"><i class="nav-icon fas fa-shopping-cart text-warning"></i><span class="hide-menu">Orders </span></a>
                            <ul aria-expanded="false" class="collapse  first-level">
                                <li class="sidebar-item"><a href="{{ route('orders') }}" class="sidebar-link"><i class="fa fa-shopping-cart nav-icon"></i><span class="hide-menu"> Orders </span></a></li>
                                <li class="sidebar-item"><a href="{{ route('orders_track') }}" class="sidebar-link"><i class="fa fa-map-marker-alt nav-icon"></i><span class="hide-menu"> Order Tracking  </span></a></li>
                                <!--<li class="sidebar-item"><a href="{{ route('system_notification') }}" class="sidebar-link"><i class="fas fa-bell nav-icon"></i><span class="hide-menu"> System Notification </span></a></li>-->
                            </ul>
                        </li>
                        <li class="sidebar-item"> <a class="sidebar-link has-arrow waves-effect waves-dark" href="javascript:void(0)" aria-expanded="false"><i class="nav-icon fas fa-bullseye text-success"></i><span class="hide-menu">Categories</span></a>
                            <ul aria-expanded="false" class="collapse  first-level">  
                                <li class="sidebar-item"><a href="{{  route('category')  }}" class="sidebar-link"><i class="fas fa-bell nav-icon"></i><span class="hide-menu"> Category </span></a></li> 
                                <li class="sidebar-item"><a href="{{  route('subcategory')  }}" class="sidebar-link"><i class="fas fa-bell nav-icon"></i><span class="hide-menu"> Sub Category </span></a></li> 
                                
                            </ul>
                        </li> 
                        
                        <li class="sidebar-item"> <a class="sidebar-link has-arrow waves-effect waves-dark" href="javascript:void(0)" aria-expanded="false"><i class="nav-icon fa fa-user text-success"></i><span class="hide-menu">Customer </span></a>
                            <ul aria-expanded="false" class="collapse  first-level">
                                <li class="sidebar-item"><a href="{{route('view_customer')}}" class="sidebar-link"><i class="fas fa-users nav-icon"></i><span class="hide-menu"> View Customers </span></a></li>
                                <li class="sidebar-item"><a href="{{route('address')}}" class="sidebar-link"><i class="far fa-address-book nav-icon"></i><span class="hide-menu">  Addressess  </span></a></li>
                                <li class="sidebar-item"><a href="{{route('transaction')}}" class="sidebar-link"><i class="fas fa-money-bill-wave nav-icon "></i><span class="hide-menu">  Transactions   </span></a></li>
                                <li class="sidebar-item"><a href="{{route('wallet_transactions')}}" class="sidebar-link"><i class="fas fa-wallet nav-icon "></i><span class="hide-menu">  Wallet Transactions  </span></a></li>
                            </ul>
                        </li>
                        
                        
                        <li class="sidebar-item"> <a class="sidebar-link waves-effect waves-dark sidebar-link" href="{{ route('vendor') }}" aria-expanded="false"><i class="nav-icon fas fa-user-tie text-danger"></i><span class="hide-menu">Vendor</span></a></li>
                            <li class="sidebar-item"> <a class="sidebar-link waves-effect waves-dark sidebar-link" href="{{ route('color') }}" aria-expanded="false"><i class="fa-solid fa-palette menu-icon"></i><span class="hide-menu">Color</span></a></li>
                            <li class="sidebar-item"> <a class="sidebar-link waves-effect waves-dark sidebar-link" href="{{ route('size') }}" aria-expanded="false"><i class="fa-solid fa-list-ol menu-icon"></i><span class="hide-menu">Size</span></a></li>
                        
                        <li class="sidebar-item"> <a class="sidebar-link has-arrow waves-effect waves-dark" href="javascript:void(0)" aria-expanded="false"><i class="nav-icon fas fa-cubes text-primary"></i><span class="hide-menu">Products </span></a>
                            <ul aria-expanded="false" class="collapse  first-level">
                               
                                <li class="sidebar-item"><a href="{{ route('add_products')}}" class="sidebar-link"><i class="fas fa-plus-square nav-icon"></i><span class="hide-menu"> Add Products </span></a></li>
                                <li class="sidebar-item"><a href="{{ route('manage_products')}}" class="sidebar-link"><i class="fas fa-boxes nav-icon"></i><span class="hide-menu"> Manage Products </span></a></li>
                                <li class="sidebar-item"><a href="{{ route('product_order') }}" class="sidebar-link"><i class="fa fa-bars nav-icon"></i><span class="hide-menu"> Products Order</span></a></li>
                                 <li class="sidebar-item"><a href="{{ route('attributes') }}" class="sidebar-link"><i class="fas fa-sliders-h nav-icon"></i><span class="hide-menu"> Attributes </span></a></li>
                                <li class="sidebar-item"><a href="{{ route('tax') }}" class="sidebar-link"><i class="fas fa-percentage nav-icon"></i><span class="hide-menu"> Tax </span></a></li>
                                <li class="sidebar-item"><a href="{{ route('bulk_upload') }}" class="sidebar-link"><i class="fas fa-upload nav-icon"></i><span class="hide-menu"> Bulk Upload </span></a></li>
                                
                                <li class="sidebar-item"><a href="{{ route('products_faqs')}}" class="sidebar-link"><i class="fas fa-question-circle nav-icon"></i><span class="hide-menu"> Products FAQs</span></a></li>
                                
                            </ul>
                        </li>
                        <li class="sidebar-item"> <a class="sidebar-link waves-effect waves-dark sidebar-link" href="{{ route('sliders') }}" aria-expanded="false"><i class="nav-icon far fa-image text-success"></i><span class="hide-menu">Sliders</span></a></li>
                         <li class="sidebar-item"> <a class="sidebar-link waves-effect waves-dark sidebar-link" href="{{route ('promo_code') }}" aria-expanded="false"><i class="nav-icon fa fa-puzzle-piece text-warning"></i><span class="hide-menu">Promo Code</span></a></li>
                        <li class="sidebar-item"> <a class="sidebar-link has-arrow waves-effect waves-dark" href="javascript:void(0)" aria-expanded="false"><i class="nav-icon fas fa-blog text-warning"></i><span class="hide-menu">Blogs </span></a>
                            <ul aria-expanded="false" class="collapse  first-level">
                                <li class="sidebar-item"><a href="{{ route('blog_categories') }}" class="sidebar-link"><i class="fas fa-bullseye nav-icon"></i><span class="hide-menu"> Blog Categories </span></a></li>
                                <li class="sidebar-item"><a href="{{ route('create_blog')}}" class="sidebar-link"><i class="fas fa-upload nav-icon"></i><span class="hide-menu">  Create Blog  </span></a></li>
                            </ul>
                        </li>
                        <li class="sidebar-item"> <a class="sidebar-link has-arrow waves-effect waves-dark" href="javascript:void(0)" aria-expanded="false"><i class="nav-icon fab fa-adversal text-primary"></i><span class="hide-menu">Brands </span></a>
                            <ul aria-expanded="false" class="collapse  first-level">
                                <li class="sidebar-item"><a href="{{ route('brand') }}" class="sidebar-link"><i class="fab fa-adversal nav-icon"></i><span class="hide-menu"> Brand </span></a></li>
                                <li class="sidebar-item"><a href="{{ route('bulk_upload') }}" class="sidebar-link"><i class="fas fa-upload nav-icon"></i><span class="hide-menu">  Bulk Upload  </span></a></li>
                            </ul>
                        </li>
                        <li class="sidebar-item"> <a class="sidebar-link waves-effect waves-dark sidebar-link" href="{{ route('media') }}" aria-expanded="false"><i class="nav-icon fas fa-icons text-danger"></i><span class="hide-menu">Media</span></a></li>
                        
                        <li class="sidebar-item"> <a class="sidebar-link waves-effect waves-dark sidebar-link" href="{{ route('offers') }}" aria-expanded="false"><i class="nav-icon fa fa-gift text-primary"></i><span class="hide-menu">Offers</span></a></li>
                        <li class="sidebar-item"> <a class="sidebar-link waves-effect waves-dark sidebar-link" href="{{ route('manage_stock') }}" aria-expanded="false"><i class="nav-icon fa fa-cube text-success"></i><span class="hide-menu">Manage Stock</span></a></li>
                        <li class="sidebar-item"> <a class="sidebar-link has-arrow waves-effect waves-dark" href="javascript:void(0)" aria-expanded="false"><i class="nav-icon fas fa-ticket-alt text-danger"></i><span class="hide-menu">Support Tickets </span></a>
                            <ul aria-expanded="false" class="collapse  first-level">
                                <li class="sidebar-item"><a href="{{route('ticket_type')}}" class="sidebar-link"><i class="fas fa-money-bill-wave nav-icon"></i><span class="hide-menu"> Ticket Types </span></a></li>
                                <li class="sidebar-item"><a href="{{'ticket'}}" class="sidebar-link"><i class="fas fa-ticket-alt nav-icon"></i><span class="hide-menu">  Tickets </span></a></li>
                            </ul>
                        </li>
                       
                        <li class="sidebar-item"> <a class="sidebar-link has-arrow waves-effect waves-dark" href="javascript:void(0)" aria-expanded="false"><i class="nav-icon fas fa-layer-group text-danger"></i><span class="hide-menu">Featured sections </span></a>
                            <ul aria-expanded="false" class="collapse  first-level">
                                <li class="sidebar-item"><a href="{{route('manage_section')}}" class="sidebar-link"><i class="fas fa-folder-plus nav-icon"></i><span class="hide-menu"> Manage Sections </span></a></li>
                                <li class="sidebar-item"><a href="{{route('section_order')}}" class="sidebar-link"><i class="fa fa-bars nav-icon"></i><span class="hide-menu">  Sections Orders  </span></a></li>
                            </ul>
                        </li>
                        
                        <li class="sidebar-item"> <a class="sidebar-link waves-effect waves-dark sidebar-link" href="{{ route('return_request') }}" aria-expanded="false"><i class="nav-icon fas fa-undo text-warning"></i><span class="hide-menu">Return Request</span></a></li>
                        <li class="sidebar-item"> <a class="sidebar-link has-arrow waves-effect waves-dark" href="javascript:void(0)" aria-expanded="false"><i class="nav-icon fas fa-id-card-alt text-info"></i><span class="hide-menu">Delivery Boys </span></a>
                            <ul aria-expanded="false" class="collapse  first-level">
                                <li class="sidebar-item"><a href="{{route('manage_delivery_boy')}}" class="sidebar-link"><i class="fas fa-user-cog nav-icon "></i><span class="hide-menu"> Manage Delivery Boys </span></a></li>
                                <li class="sidebar-item"><a href="{{route('fund_transfer')}}" class="sidebar-link"><i class="fa fa-rupee-sign nav-icon "></i><span class="hide-menu">  Fund Transfer  </span></a></li>
                                <li class="sidebar-item"><a href="{{route('manage_cash')}}" class="sidebar-link"><i class="fas fa-money-bill-alt nav-icon "></i><span class="hide-menu">  Manage Cash Collection  </span></a></li>
                            </ul>
                        </li>
                        <li class="sidebar-item"> <a class="sidebar-link waves-effect waves-dark sidebar-link" href="{{ route('paymentrequest') }}" aria-expanded="false"><i class="nav-icon fas fa-money-bill-wave text-danger"></i><span class="hide-menu">Payment Request</span></a></li>
                        <li class="sidebar-item"> <a class="sidebar-link waves-effect waves-dark sidebar-link" href="{{route('send_notification')}}" aria-expanded="false"><i class="nav-icon fas fa-paper-plane text-success"></i><span class="hide-menu">Send Notifications</span></a></li>
                        <li class="sidebar-item"> <a class="sidebar-link waves-effect waves-dark sidebar-link" href="pages-elements.html" aria-expanded="false"><i class="nav-icon fas fa-bell text-info"></i><span class="hide-menu">Custom message</span></a></li>
                        <li class="sidebar-item"> <a class="sidebar-link has-arrow waves-effect waves-dark" href="javascript:void(0)" aria-expanded="false"><i class="nav-icon fa fa-wrench text-primary"></i><span class="hide-menu">System </span></a>
                            <ul aria-expanded="false" class="collapse  first-level">
                                <li class="sidebar-item"><a href="{{route('store_settings')}}" class="sidebar-link"><i class="fas fa-store nav-icon "></i><span class="hide-menu"> Store Settings </span></a></li>
                                <li class="sidebar-item"><a href="{{route('email_settings')}}" class="sidebar-link"><i class="fas fa-envelope-open-text nav-icon "></i><span class="hide-menu"> Email Settings  </span></a></li>
                                <li class="sidebar-item"><a href="{{route('payments_methods')}}" class="sidebar-link"><i class="fas fa-rupee-sign nav-icon "></i><span class="hide-menu"> Payments Methods  </span></a></li>
                                <li class="sidebar-item"><a href="{{route('shipping_methods')}}" class="sidebar-link"><i class="fas fa-rocket nav-icon "></i><span class="hide-menu"> Shipping Methods </span></a></li>
                                <li class="sidebar-item"><a href="{{route('time_slots')}}" class="sidebar-link"><i class="fas fa-calendar-alt nav-icon "></i><span class="hide-menu"> Time Slot </span></a></li>
                                <li class="sidebar-item"><a href="{{route('notification_settings')}}" class="sidebar-link"><i class="fa fa-bell nav-icon "></i><span class="hide-menu"> Notification Settings </span></a></li>
                                <li class="sidebar-item"><a href="{{route('contact_us')}}"  class="sidebar-link"><i class="fa fa-phone-alt nav-icon "></i><span class="hide-menu"> Contact US </span></a></li>
                                <li class="sidebar-item"><a href="{{route('about_us')}}" class="sidebar-link"><i class="fas fa-info-circle nav-icon "></i><span class="hide-menu"> About US </span></a></li>
                                <li class="sidebar-item"><a href="{{route('privacy_policy')}}" class="sidebar-link"><i class="fa fa-user-secret nav-icon "></i><span class="hide-menu"> Privacy Policy   </span></a></li>
                                <li class="sidebar-item"><a href="{{route('shipping_policy')}}" class="sidebar-link"><i class="fa fa-shipping-fast nav-icon "></i><span class="hide-menu"> Shipping Policy   </span></a></li>
                                <li class="sidebar-item"><a href="{{route('return_policy')}}" class="sidebar-link"><i class="fa fa-undo nav-icon "></i><span class="hide-menu"> Return Policy   </span></a></li>
                                <li class="sidebar-item"><a href="{{route('admin_policies')}}" class="sidebar-link"><i class="fa fa-exclamation-triangle nav-icon  "></i><span class="hide-menu"> Admin Policies  </span></a></li>
                                <li class="sidebar-item"><a href="{{route('delivery_boy_policies')}}" class="sidebar-link"><i class="fa fa-exclamation-triangle nav-icon  "></i><span class="hide-menu"> Delivery Boy Policies </span></a></li>
                                <li class="sidebar-item"><a href="{{route('seller_policies')}}" class="sidebar-link"><i class="fa fa-exclamation-triangle nav-icon  "></i><span class="hide-menu"> Seller Policies </span></a></li>
                                <li class="sidebar-item"><a href="{{route('system_updater')}}" class="sidebar-link"><i class="fas fa-sync nav-icon "></i><span class="hide-menu"> System Updater </span></a></li>
                                <li class="sidebar-item"><a href="{{route('system_registration')}}" class="sidebar-link"><i class="fas fa-check nav-icon"></i><span class="hide-menu"> System Registeration </span></a></li>
                            </ul>
                        </li>
                        <li class="sidebar-item"> <a class="sidebar-link has-arrow waves-effect waves-dark" href="javascript:void(0)" aria-expanded="false"><i class="nav-icon fa fa-globe-asia text-warning"></i><span class="hide-menu">Web Settings </span></a>
                            <ul aria-expanded="false" class="collapse  first-level">
                                <li class="sidebar-item"><a href="{{route('general_settings') }}"  class="sidebar-link"><i class="fa fa-laptop nav-icon "></i><span class="hide-menu"> General Settings </span></a></li>
                                <li class="sidebar-item"><a href="{{route('theme')}}" class="sidebar-link"><i class="fa fa-palette nav-icon "></i><span class="hide-menu">  Themes  </span></a></li>
                                <li class="sidebar-item"><a href="{{route('languages')}}" class="sidebar-link"><i class="fa fa-language nav-icon "></i><span class="hide-menu">  Languages  </span></a></li>
                                <li class="sidebar-item"><a href="{{route('firebase')}}" class="sidebar-link"><i class="bx bxl-firebase nav-icon "></i><span class="hide-menu">  Firebase  </span></a></li>
                            </ul>
                        </li>
                        <li class="sidebar-item"> <a class="sidebar-link waves-effect waves-dark sidebar-link" href="{{route('pickup_location')}}" aria-expanded="false"><i class="nav-icon fas fa-shipping-fast text-success"></i><span class="hide-menu">Pickup Location</span></a></li>
                        <li class="sidebar-item"> <a class="sidebar-link has-arrow waves-effect waves-dark" href="javascript:void(0)" aria-expanded="false"><i class="nav-icon fas fa-map-marked-alt text-danger"></i><span class="hide-menu">Location </span></a>
                            <ul aria-expanded="false" class="collapse  first-level">
                                <li class="sidebar-item"><a href="{{route('zip_code')}}" class="sidebar-link"><i class="fa fa-map-pin nav-icon "></i><span class="hide-menu"> Zip Code </span></a></li>
                                <li class="sidebar-item"><a href="{{route('city')}}" class="sidebar-link"><i class="fa fa-location-arrow nav-icon "></i><span class="hide-menu">  City  </span></a></li>
                                <li class="sidebar-item"><a href="{{route('area')}}" class="sidebar-link"><i class="fas fa-street-view nav-icon "></i><span class="hide-menu">  Area  </span></a></li>
                                <li class="sidebar-item"><a href="{{route('counteries')}}" class="sidebar-link"><i class="fas fa-solid fa-globe nav-icon "></i><span class="hide-menu">  Counteries  </span></a></li>
                                <li class="sidebar-item"><a href="{{route('bulk_uploads')}}"  class="sidebar-link"><i class="fas fa-upload nav-icon"></i><span class="hide-menu">  Bulk Upload  </span></a></li>
                            </ul>
                        </li>
                        <li class="sidebar-item"> <a class="sidebar-link has-arrow waves-effect waves-dark" href="javascript:void(0)" aria-expanded="false"><i class="fas fa-chart-pie nav-icon text-primary"></i><span class="hide-menu">Reports </span></a>
                            <ul aria-expanded="false" class="collapse  first-level"> 
                                <li class="sidebar-item"><a href="{{route('sales_report')}}" class="sidebar-link"><i class="fa fa-chart-line nav-icon "></i><span class="hide-menu"> Sales Report </span></a></li>
                                <li class="sidebar-item"><a href="{{route('sales_inventory')}}"class="sidebar-link"><i class="fa fa-chart-line nav-icon "></i><span class="hide-menu">   Sale Inventory Report  </span></a></li>
                            </ul>
                        </li> 
                        <li class="sidebar-item"> <a class="sidebar-link waves-effect waves-dark sidebar-link" href="{{route('faq')}}" aria-expanded="false"><i class="nav-icon fas fa-question-circle text-warning"></i><span class="hide-menu">FAQ</span></a></li>
                        <li class="sidebar-item"> <a class="sidebar-link waves-effect waves-dark sidebar-link" href="{{route('system_user')}}" aria-expanded="false"><i class="nav-icon fas fa-user-tie text-danger"></i><span class="hide-menu">System User </span></a></li>
                    </ul>
                </nav>
                <!-- End Sidebar navigation -->
            </div>
            <!-- End Sidebar scroll-->
        </aside>