<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="utf-8" />
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0, user-scalable=0, minimal-ui">
    <title>Real Estate - Forgot Password</title>
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
    	.btnDisabled{
			cursor: not-allowed; 
			pointer-events: none;
		}
		.error{
    	    margin: 0px;
            color: red;
            
    	}
        @media only screen and (max-width: 600px) {
          .wrapper-page {
           margin-top: 50%;
          }
        }
    </style>
</head>
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
                    <h4 class="text-muted text-center font-18"><b>Reset Password</b></h4>

                    <div class="p-3">
                        <form class="form-horizontal m-t-20" id="retreive" method="POST" action="<?php echo base_url(); ?>admin/retrieve_password">
                            <div class="alert alert-info alert-dismissible">
                                <button type="button" class="close" data-dismiss="alert" aria-hidden="true">×</button>
                                Enter your <b>Email</b> and instructions will be sent to you!
                            </div>
                            <div class="form-group row form-primary">
                                <div class="col-12">
    								<input type="text" name="retrive_email" class="form-control" id="email" onkeyup="CheckEmail(this.value)" required="" placeholder="Your Email">
    								<span class="form-bar"></span>
    								<p id="error_email" style="color:red;margin:0px"></p>
								</div>
							</div>
							<!--div class="row">
							    <div class="col-md-6">
							        <input type="text" id="random_value">
							        <i class="fa fa-remove" style="color:red;cursor: pointer;" onclick="clearfeild()"></i>
							        <p class="error" id="error_captcha"></p>
							    </div>
							    <div class="col-md-6">
							        <p id="random_text" style="color: green;font-weight: bold;font-size: 24px;font-family: fantasy;text-align: center;margin-top: 5px;font-style: italic;">
							            
							         </p>
							    </div>
							</div-->
                            
                            
                            
                            <div class="form-group text-center row">
                                <div class="col-12">
                                    <button class="btn btn-info btn-block waves-effect waves-light" id="forgotBtn" type="button" onclick="submitForm()">Send Email</button>
                                </div>
                            </div>

                            <div class="form-group m-t-10 mb-0 row">
                                <div class="col-sm-7">
                                    <a href="<?php echo base_url(); ?>admin" class="text-muted"><i class="mdi mdi-lock"></i> Back to Login?</a>
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
		function CheckEmail(value){
			$.ajax({
				type : 'POST',    
				url : '<?php echo base_url(); ?>admin/CheckEmail', 
				data : {'email':value},
				success: function(response) {
					console.log(response);
					if(value !=''){
						if(response == 'notexist'){
							$('#error_email').text('Email Not Exist');
							$('#forgotBtn').addClass('btnDisabled');
						}else{
							$('#error_email').text(' ');
							$('#forgotBtn').removeClass('btnDisabled');
						}
					}
				}
			});
		}
		 function submitForm(){
            var email    = $('#email').val();
            $('#error_email').text('');
           
            if(email ==''){
                $('#error_email').text('Please fill the email field');
                return false;
            }else{
                 $('#retreive').submit();
            }
           
        }
	
		</script>
	</body>
</html>
