<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="utf-8" />
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0, user-scalable=0, minimal-ui">
    <title>Real Estate - login</title>
    <meta content="Admin Dashboard" name="description" />
    <meta content="Mjcoders" name="author" />
    <meta http-equiv="X-UA-Compatible" content="IE=edge" />

    <!-- App Icons -->
    <link rel="shortcut icon" href="<?php echo base_url(); ?>uploads/admin/<?php echo system_image(); ?>">

    <!-- App css -->
    <link href="<?php echo assets_dir();?>css/bootstrap.min.css" rel="stylesheet" type="text/css" />
    <link href="<?php echo assets_dir();?>css/icons.css" rel="stylesheet" type="text/css" />
    <link href="<?php echo assets_dir();?>css/style.css" rel="stylesheet" type="text/css" />
    <!--toastr-->
    <link rel="stylesheet" type="text/css" href="<?php echo assets_dir();?>notification/notification.css">
    <style>
        @media only screen and (max-width: 600px) {
          .wrapper-page {
           margin-top: 50%;
          }
        }
    </style>
</head>
<?php  
    $this->session->set_userdata('current_language','english');
	$this->session->set_userdata('language_country','english');
?>
<body>

        <!-- Begin page -->
        <div class="accountbg"></div>
        <div class="wrapper-page" style="">

            <div class="card">
                <div class="card-body">

                    <h3 class="text-center mt-0 m-b-15">
                        <a href="javascript:;" class="logo logo-admin">
                            <?php if(!empty(system_image())){ ?>
                            <img src="<?php echo base_url(); ?>uploads/admin/<?php echo system_image(); ?>"  style="width:150px;height:auto" alt="">
                            <?php }else{ ?>
                            <img src="https://via.placeholder.com/150" alt="">
                            <?php } ?>
                        </a>
                    </h3>
                    <!--h2>Welcome to <?php echo system_name(); ?></h2-->
                    <h4 class="text-muted text-center font-18"><b>Login In</b></h4>

                    <div class="p-3">
                        <form class="form-horizontal m-t-20" id="login_form" action="<?php echo base_url().admin_ctrl(); ?>/login" method="post">

                            <div class="form-group row">
                                <div class="col-12">
                                    <input type="email" class="form-control" name="email" id="email" required="" onblur="validate()" placeholder="<?php echo get_phrase('your_username'); ?>" required="">
                                    <p class="error" id="email_error">Please fill the email field</p>
                                </div>
                            </div>

                            <div class="form-group row">
                                <div class="col-12">
                                    <input type="password" class="form-control" name="password" id="password"  onblur="validate()"  required="" placeholder="<?php echo get_phrase('password'); ?>">
                                    <p class="error" id="password_error">Please fill the password field</p>
                                </div>
                            </div>
                            <!--div class="form-group row">
                                <div class="col-md-6">
                                    <input type="text" id="random_value"  onblur="validate()" value="">
                                    <i class="fa fa-remove" style="color:red;cursor: pointer;" onclick="clearfeild()"></i>
                                    <p class="error" id="captcha_error">Please fill the captcha field</p>
                                </div>
                                <div class="col-md-6">
                                    <p id="random_text" style="color: green;font-weight: bold;font-size: 24px;font-family: fantasy;text-align: center;margin-top: 5px;font-style: italic;user-select: none;">
                                        
                                     </p>
                                </div>
                            </div-->
                            <div class="form-group text-center row m-t-20">
                                <div class="col-12">
                                    <button class="btn btn-info btn-block waves-effect waves-light" type="button" onclick="submitForm()">Log In</button>
                                </div>
                            </div>

                            <div class="form-group m-t-10 mb-0 row">
                                <div class="col-sm-7 m-t-20">
                                    <a href="<?php echo base_url(); ?>admin/forgot_password" class="text-muted"><i class="mdi mdi-lock"></i> Forgot your password?</a>
                                </div>
                                <!--div class="col-sm-5 m-t-20">
                                    <a href="pages-register.html" class="text-muted"><i class="mdi mdi-account-circle"></i> Create an account</a>
                                </div-->
                            </div>
                        </form>
                    </div>

                </div>
            </div>
        </div>



        <!-- jQuery  -->
        <script src="<?php echo assets_dir();?>js/jquery.min.js"></script>
        <script src="<?php echo assets_dir();?>js/popper.min.js"></script>
        <script src="<?php echo assets_dir();?>js/bootstrap.min.js"></script>
        <script src="<?php echo assets_dir();?>js/modernizr.min.js"></script>
        <script src="<?php echo assets_dir();?>js/waves.js"></script>
        <script src="<?php echo assets_dir();?>js/jquery.slimscroll.js"></script>
        <script src="<?php echo assets_dir();?>js/jquery.nicescroll.js"></script>
        <script src="<?php echo assets_dir();?>js/jquery.scrollTo.min.js"></script>
        <!-- notification js -->
        <script type="text/javascript" src="<?php echo assets_dir();?>bootstrap-growl.min.js"></script>
        <script type="text/javascript" src="<?php echo assets_dir();?>notification/notification.js"></script>
        <!-- App js -->
        <script src="<?php echo assets_dir();?>js/app.js"></script>
 
        <script>
            <?php if($this->session->flashdata('msg_success')){ ?>
        		notify('fa fa-comments', 'success', 'Title ', '<?php echo $this->session->flashdata("msg_success")?>');
        	<?php } else if($this->session->flashdata('msg_error')){ ?>
        		notify('fa fa-comments', 'danger', 'Title ', '<?php echo $this->session->flashdata("msg_error")?>');
        	<?php } else if($this->session->flashdata('msg_warning')){ ?>
        		notify('fa fa-comments', 'warning', 'Title ', '<?php echo $this->session->flashdata("msg_warning")?>');
        	<?php } else if($this->session->flashdata('msg_info')){ ?>
        		notify('fa fa-comments', 'info', 'Title ', '<?php echo $this->session->flashdata("msg_info")?>');
        	<?php } ?>
        </script>
    	<script>
    	 //   $('#random_text').text(makeid(5));
    	    
            $("#password").keypress(function(event) {
                var keycode = event.keyCode || event.which;
                if(keycode == '13') {
                    submitForm();  
                }
            });
            function submitForm(){
               // var val = $('#random_value').val();
               // var txt = $('#random_text').text();
                var email    = $('#email').val();
                var password = $('#password').val();
                if(email ==''){
                    $('#email_error').css('display','block'); 
                    return false;
                }else if(password == ''){
                    $('#password_error').css('display','block'); 
                    return false;
                }else if(email !='' && password != ''){
                     $('#login_form').submit();
                }
                /*else if(val == ''){
                    $('#captcha_error').css('display','block'); 
                    return false;
                }*/
                
               /* if(val == txt){
                    $('#login_form').submit();
                }else{
                   $('#random_value').val('');
                    $('#random_text').text(makeid(5));
                } */
            }
            function validate(){
             //   var val = $('#random_value').val();
              //  var txt = $('#random_text').text();
                var email    = $('#email').val();
                var password = $('#password').val();
                $('#email_error').css('display','none'); 
                $('#password_error').css('display','none'); 
             //   $('#captcha_error').css('display','none'); 
                if(email ==''){
                    $('#email_error').css('display','block'); 
                }else if(password == ''){
                    $('#password_error').css('display','block'); 
                }
                /*else if(val == ''){
                    $('#captcha_error').css('display','block'); 
                    //return false;
                }*/
            }
            function makeid(length) {
               var result           = '';
               var characters       = 'ABCDEFGHIJKLMNOPQRSTUVWXYZabcdefghijklmnopqrstuvwxyz0123456789';
               var charactersLength = characters.length;
               for ( var i = 0; i < length; i++ ) {
                  result += characters.charAt(Math.floor(Math.random() * charactersLength));
               }
               return result;
            }
            function clearfeild(){
                $('#random_value').val(' ')
            }
            
    	</script>
	</body>
</html>