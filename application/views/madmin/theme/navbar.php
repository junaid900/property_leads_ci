<?php 
    $user_data = $this->db->get_where('users_system',array('users_system_id'=>$this->session->userdata('users_id')))->row();
    $user_permit = $this->session->userdata('permissions');
    $user_roles_id = $this->session->userdata('user_roles_id');
    
?>

<!-- Navigation Bar-->
<header id="topnav">
    <div class="topbar-main">
        <div class="container-fluid">

            <!-- Logo container-->
            <div class="logo">
                <!-- Text Logo -->
             
                <!-- Image Logo -->
                <a href="javascript:;" class="logo">
                     <?php if(!empty(system_image())){ ?>
                    <img src="<?php echo base_url(); ?>uploads/admin/<?php echo system_image(); ?>" alt="" height="22" class="logo-small">
                    <img src="<?php echo base_url(); ?>uploads/admin/<?php echo system_image(); ?>" class="logo-large" style="height: 45px;" alt="image">
                    <?php }else{ ?>
                    <img src="https://via.placeholder.com/70" width="100%" height="24px" alt="">
                    <?php } ?>
                    <!--img src="assets/images/logo-sm.png" alt="" height="22" class="logo-small">
                    <img src="assets/images/logo.png" alt="" height="24" class="logo-large"-->
                </a>

            </div>
            <!-- End Logo container-->


            <div class="menu-extras topbar-custom">

                <!-- Search input -->
                <div class="search-wrap" id="search-wrap">
                    <div class="search-bar">
                        <input class="search-input" type="search" placeholder="Search" />
                        <a href="#" class="close-search toggle-search" data-target="#search-wrap">
                            <i class="mdi mdi-close-circle"></i>
                        </a>
                    </div>
                </div>

                <ul class="list-inline float-right mb-0">
                    <!-- Search -->
                    <li class="list-inline-item dropdown notification-list">
                        <a class="nav-link waves-effect toggle-search" href="#"  data-target="#search-wrap">
                            <i class="mdi mdi-magnify noti-icon"></i>
                        </a>
                    </li>
                    <!-- Messages-->
                    <!--li class="list-inline-item dropdown notification-list">
                        <a class="nav-link dropdown-toggle arrow-none waves-effect" data-toggle="dropdown" href="#" role="button"
                           aria-haspopup="false" aria-expanded="false">
                            <i class="mdi mdi-email-outline noti-icon"></i>
                            <span class="badge badge-danger noti-icon-badge">3</span>
                        </a>
                        <div class="dropdown-menu dropdown-menu-right dropdown-arrow dropdown-menu-lg">
                            <div class="dropdown-item noti-title">
                                <h5><span class="badge badge-danger float-right">745</span>Messages</h5>
                            </div>

                            <a href="javascript:void(0);" class="dropdown-item notify-item">
                                View All
                            </a>

                        </div>
                    </li-->
                    <!-- notification-->
                    <li class="list-inline-item dropdown notification-list">
                        <a class="nav-link dropdown-toggle arrow-none waves-effect" data-toggle="dropdown" href="#" role="button"
                           aria-haspopup="false" aria-expanded="false">
                            <i class="fa fa-language noti-icon"></i>
                        </a>
                        <div class="dropdown-menu dropdown-menu-right dropdown-arrow dropdown-menu-lg">
                         
                            <a href="javascript:void(0);" onclick="changeLanguage('English')" class="dropdown-item notify-item active">
                                <div class="notify-icon"><img src="https://themesdesign.in/upcube/layouts/assets/images/flags/us.jpg" style="height: 56%;margin-top: -13px;"></div>
                                <p class="notify-details"><b>English</b></p>
                            </a>
                            <a href="javascript:void(0);" onclick="changeLanguage('dutch')"  class="dropdown-item notify-item active">
                                <div class="notify-icon"><img src="https://upload.wikimedia.org/wikipedia/commons/thumb/2/20/Flag_of_the_Netherlands.svg/2560px-Flag_of_the_Netherlands.svg.png" style="height: 56%;margin-top: -13px;"></div>
                                <p class="notify-details"><b>Dutch</b></p>
                            </a>


                        </div>
                    </li>
                    <!-- User-->
                    
                    <li class="list-inline-item dropdown notification-list">
                        <a class="nav-link dropdown-toggle arrow-none waves-effect nav-user" data-toggle="dropdown" href="#" role="button"
                           aria-haspopup="false" aria-expanded="false">
                            <?php if(!empty($user_data->user_image)){ ?>
                            <img src="<?php echo base_url(); ?>uploads/users/<?php echo $user_data->user_image; ?>" alt="user" class="rounded-circle">
                            <?php }else{ ?>
                             <img src="<?php echo base_url(); ?>assets/admin/images/avatar-1.jpeg" alt="user" class="rounded-circle">
                            <?php } ?>
                        </a>
                        <div class="dropdown-menu dropdown-menu-right profile-dropdown ">
                            <a class="dropdown-item" href="javascript:;" style="padding-top: 0px; padding-bottom: 0px;cursor: not-allowed;"><b><?php if(!empty($user_data->user_name)){ echo $user_data->user_name; } ?></b></a>
                            <div class="dropdown-divider"></div>
                            <?php if($user_permit->myprofile == 1){ ?>
                            <a class="dropdown-item" href="<?=base_url().admin_ctrl(). '/myprofile'; ?>"><i class="dripicons-user text-muted"></i> Profile</a>
                            <?php } ?>
                            <?php if($user_permit->manage_system == 1){ ?>
                            <a class="dropdown-item" href="<?=base_url().admin_ctrl(). '/system_settings'; ?>"><i class="dripicons-gear text-muted"></i> Settings</a>
                            <?php } ?>
                            <div class="dropdown-divider"></div>
                            <a class="dropdown-item" href="<?=base_url().admin_ctrl(). '/logout'; ?>"><i class="dripicons-exit text-muted"></i> Logout</a>
                        </div>
                    </li>
                    <li class="menu-item list-inline-item">
                        <!-- Mobile menu toggle-->
                        <a class="navbar-toggle nav-link">
                            <div class="lines">
                                <span></span>
                                <span></span>
                                <span></span>
                            </div>
                        </a>
                        <!-- End mobile menu toggle-->
                    </li>

                </ul>
            </div>
            <!-- end menu-extras -->

            <div class="clearfix"></div>

        </div> <!-- end container -->
    </div>
    <!-- end topbar-main -->

    <!-- MENU Start -->
    <div class="navbar-custom">
        <div class="container-fluid">
            <div id="navigation">
                <!-- Navigation Menu-->
                <?php 
                    $view_param = '';
                    if(!empty($param3)){
                        $view_param = $param3;
                    }
                ?>
                <ul class="navigation-menu">
                    <?php if($user_permit->dashboard == 1){ ?>
                    <li class="has-submenu <?=$page_name == "dashboard"?"active":"" ?>">
                        <a href="<?=base_url().admin_ctrl(). '/dashboard' ?>"><i class="ti-home"></i><?php echo get_phrase('dashboard')   ?></a>
                    </li>
                    <?php } ?>
                    <?php if($user_roles_id ==1){ ?>
                    <li class="has-submenu">
                        <a href="#"><i class="mdi mdi-account-multiple-outline"></i><?php echo get_phrase('manage_leads')   ?></a>
                        <ul class="submenu">
                           <li><a href="<?=base_url().admin_ctrl(). '/manage_leads' ?>">Leads</a></li> 
                           <li><a href="<?=base_url().admin_ctrl(). '/manage_customer' ?>">Customer</a></li>
                           <li><a href="<?=base_url().admin_ctrl(). '/manage_sold' ?>">Sold</a></li>
                        </ul>
                    </li>
                    
                    <?php }else{ ?>
                    <?php if($user_permit->manage_leads == 1){ ?>
                    <li class="has-submenu <?=$page_name == "manage_leads" || $view_param=='lead' || $page_name == "add_lead" || $page_name == "edit_lead"?"active":"" ?>">
                        <a href="<?=base_url().admin_ctrl(). '/manage_leads' ?>"><i class="mdi mdi-account-multiple-outline"></i><?php echo get_phrase('manage_leads')   ?></a>
                    </li>
                    <?php } ?>
                    <?php } ?>
                    
                    
                    
                    <?php if($user_permit->manage_customer == 1){ ?>
                    <li class="has-submenu <?=$page_name == "manage_customer" || $view_param=='customer'?"active":"" ?>">
                        <a href="<?=base_url().admin_ctrl(). '/manage_customer' ?>"><i class="mdi mdi-account-convert"></i><?php echo get_phrase('manage_customers')   ?></a>
                    </li>
                    <?php } ?>
                    <?php if($user_permit->manage_sold == 1){ ?>
                    <li class="has-submenu <?=$page_name == "manage_sold" || $view_param=='sold'?"active":"" ?>">
                        <a href="<?=base_url().admin_ctrl(). '/manage_sold' ?>"><i class="mdi mdi-account-check"></i><?php echo get_phrase('manage_solds')   ?></a>
                    </li>
                    <?php } ?>
                    <?php if($user_permit->manage_employees == 1){ ?>
                    <li class="has-submenu <?=$page_name == "manage_employees"?"active":"" ?>">
                        <a href="<?=base_url().admin_ctrl(). '/manage_employees' ?>"><i class="mdi mdi-account-multiple-outline"></i><?php echo get_phrase('manage_employees')   ?></a>
                    </li>
                    <?php } ?>
                    <?php if($user_permit->manage_brokers == 1){ ?>
                    <li class="has-submenu <?=$page_name == "manage_brokers"?"active":"" ?>">
                        <a href="<?=base_url().admin_ctrl(). '/manage_brokers' ?>"><i class="mdi mdi-account-network"></i><?php echo get_phrase('manage_brokers')   ?></a>
                    </li>
                    <?php } ?>
                    <?php if($user_permit->email_templates == 1){ ?>
                     <li class="has-submenu <?=$page_name == "email_templates"?"active":"" ?>">
                        <a href="<?=base_url().admin_ctrl(). '/email_templates' ?>"><i class="ti-email"></i>Email Templates</a>
                    </li>
                    <?php } ?>
                   
                    <?php if($user_permit->manage_house_types == 1 || $user_permit->manage_house_situation == 1){ ?>
                    <li class="has-submenu">
                        <a href="#"><i class="mdi mdi-home-variant"></i>Houses</a>
                        <ul class="submenu">
                            <?php if($user_permit->manage_house_situation == 1){ ?>
                           <li><a href="<?=base_url().admin_ctrl(). '/manage_house_situation' ?>">House Situation</a></li> 
                           <?php } ?>
                           <?php if($user_permit->manage_house_types == 1){ ?>
                           <li><a href="<?=base_url().admin_ctrl(). '/manage_house_types' ?>">House Types</a></li>
                           <?php } ?>
                        </ul>
                    </li>
                    <?php } ?>
                    <?php if($user_permit->roles == 1){ ?>
                    <li class="has-submenu <?=$page_name == "manage_roles"?"active":"" ?>">
                        <a href="<?=base_url().admin_ctrl(). '/manage_roles' ?>"><i class="mdi mdi-account-key"></i> <?php echo get_phrase('manage_permissions')   ?></a>
                    </li>
                    <?php } ?>
                    <?php if($user_permit->roles == 1){ ?>
                        <li class="has-submenu <?=$page_name == "manage_language" || $page_name == "edit_language" ?"active":"" ?>">
                        <a href="<?=base_url().admin_ctrl(). '/language' ?>"><i class="ti-tag"></i><?php echo get_phrase('manage_languages')   ?></a>
                    </li>
                    <?php } ?>
                    <!--li class="has-submenu">
                        <a href="#"><i class="ti-crown"></i>Advanced UI</a>
                        <ul class="submenu">
                            <li><a href="advanced-animation.html">Animation</a></li>
                            <li><a href="advanced-highlight.html">Highlight</a></li>
                            <li><a href="advanced-rating.html">Rating</a></li>
                            <li><a href="advanced-nestable.html">Nestable</a></li>
                            <li><a href="advanced-alertify.html">Alertify</a></li>
                            <li><a href="advanced-rangeslider.html">Range Slider</a></li>
                            <li><a href="advanced-sessiontimeout.html">Session Timeout</a></li>
                        </ul>
                    </li-->

                    <!--li class="has-submenu">
                        <a href="#"><i class="ti-bookmark-alt"></i>Components</a>
                        <ul class="submenu">
                            <li class="has-submenu">
                                <a href="#">Forms</a>
                                <ul class="submenu">
                                    <li><a href="form-elements.html">Form Elements</a></li>
                                    <li><a href="form-validation.html">Form Validation</a></li>
                                    <li><a href="form-advanced.html">Form Advanced</a></li>
                                    <li><a href="form-editors.html">Form Editors</a></li>
                                    <li><a href="form-uploads.html">Form File Upload</a></li>
                                    <li><a href="form-mask.html">Form Mask</a></li>
                                    <li><a href="form-summernote.html">Summernote</a></li>
                                    <li><a href="form-xeditable.html">Form Xeditable</a></li>
                                </ul>
                            </li>
                            <li class="has-submenu">
                                <a href="#">Icons</a>
                                <ul class="submenu">
                                    <li><a href="icons-material.html">Material Design</a></li>
                                    <li><a href="icons-ion.html">Ion Icons</a></li>
                                    <li><a href="icons-fontawesome.html">Font Awesome</a></li>
                                    <li><a href="icons-themify.html">Themify Icons</a></li>
                                    <li><a href="icons-dripicons.html">Dripicons</a></li>
                                    <li><a href="icons-typicons.html">Typicons Icons</a></li>
                                </ul>
                            </li>
                            <li>
                                <a href="calendar.html">Calendar</a>
                            </li>
                            <li class="has-submenu">
                                <a href="#">Charts</a>
                                <ul class="submenu">
                                    <li><a href="charts-morris.html">Morris Chart</a></li>
                                    <li><a href="charts-chartist.html">Chartist Chart</a></li>
                                    <li><a href="charts-chartjs.html">Chartjs Chart</a></li>
                                    <li><a href="charts-flot.html">Flot Chart</a></li>
                                    <li><a href="charts-c3.html">C3 Chart</a></li>
                                    <li><a href="charts-other.html">Jquery Knob Chart</a></li>
                                </ul>
                            </li>
                            <li class="has-submenu">
                                <a href="#">Tables </a>
                                <ul class="submenu">
                                    <li><a href="tables-basic.html">Basic Tables</a></li>
                                    <li><a href="tables-datatable.html">Data Table</a></li>
                                    <li><a href="tables-responsive.html">Responsive Table</a></li>
                                    <li><a href="tables-editable.html">Editable Table</a></li>
                                </ul>
                            </li>
                            <li class="has-submenu">
                                <a href="#">Maps</a>
                                <ul class="submenu">
                                    <li><a href="maps-google.html"> Google Map</a></li>
                                    <li><a href="maps-vector.html"> Vector Map</a></li>
                                </ul>
                            </li>
                        </ul>
                    </li-->


                </ul>
                <!-- End navigation menu -->
            </div> <!-- end #navigation -->
        </div> <!-- end container -->
    </div> <!-- end navbar-custom -->
</header>
<!-- End Navigation Bar-->
