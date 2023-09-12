<!DOCTYPE html>
<html lang="en">
	<head>
       <?php $this->load->view(strtolower($this->session->userdata('directory')).'/theme/header');?>
	</head>

	<body>
    	    
    <!-- Loader -->
    <div id="preloader"><div id="status"><div class="spinner"></div></div></div>
    <?php $this->load->view(strtolower($this->session->userdata('directory')).'/theme/navbar');?>
    <div class="wrapper">
        <div class="container-fluid">
            <div class="row">
                <div class="col-sm-12">
                    <div class="page-title-box">
                        <div class="btn-group pull-right">
                            <ol class="breadcrumb hide-phone p-0 m-0">
                                <li class="breadcrumb-item"><a href="<?php echo base_url(); ?>">Dashboard</a></li>
                                <?php if(!empty($main_page_link)){?>
                                <li class="breadcrumb-item"><a href="<?php echo base_url().admin_ctrl().'/'.$main_page_link; ?>"><?=$main_page_name; ?></a></li>
                                <?php } ?>
                                <?php if(!empty($page_sub_title)){?>
                                <li class="breadcrumb-item"><a href="javascript:;"><?=$page_sub_title; ?></a></li>
                                <?php } ?>
                            </ol>
                        </div>
                        <h4 class="page-title"><?php echo $page_title; ?></h4>
                    </div>
                </div>
            </div>
             <?php $this->load->view(strtolower($this->session->userdata('directory')).'/'.$htmlPage);?>
        </div> 
    </div>
        <?php $this->load->view(strtolower($this->session->userdata('directory')).'/theme/footer'); ?>
    	<?php $this->load->view(strtolower($this->session->userdata('directory')).'/theme/script'); ?>
		<?php $this->load->view('modal'); ?>
        <script> 
            const showThumbnail = (btnHasClicked) => {
                const imgTag = btnHasClicked.parentNode.querySelector('.img-thumbnail');
                const file = btnHasClicked.files[0];
                const reader = new FileReader();
        
                reader.onloadend = function () {
                    imgTag.src = reader.result;
                }
        
                if (file) {
                    reader.readAsDataURL(file);
                } else {
                    imgTag.src = "<?php echo base_url(); ?>assets/3204121.png";
                 
                }
            }
        </script>
	</body>
</html>
