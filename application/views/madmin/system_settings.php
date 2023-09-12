<form role="form" method="POST" action="<?php echo base_url().admin_ctrl(); ?>/system_settings/update"  enctype="multipart/form-data">
    <div class="row">
        <div class="col-lg-6">
               <div class="card m-b-30">
                    <div class="card-body">
                       <div class="form-group">
                             <label for="name"><?php echo get_phrase('company_name'); ?>:</label>
                            <input type="text" name="system_name" class="form-control" placeholder="" value="<?php echo $system_data[0]->description; ?>">
                        </div>
                        <div class="form-group">
                            <label for="home_page_SEO_title"><?php echo get_phrase('home_page_SEO_title'); ?></label>
                            <input type="text" name="home-page-seo-title" class="form-control" placeholder="" value="<?php echo $system_data[16]->description; ?>">
                        </div>
                        <div class="form-group">
                            <label for="home_page_SEO_description"><?php echo get_phrase('home_page_SEO_description'); ?></label>
                            <input type="text"  name="home-page-seo-description" class="form-control" placeholder="" value="<?php echo $system_data[17]->description; ?>" >
                        </div>
                        <div class=" ">
                        	<b><?php echo get_phrase('contact_settings'); ?></b>
                        	<hr>
                        </div>
                        
                        <div class="form-group">
                            <label><?php echo get_phrase('email'); ?></label>
                            <input type="text"  name="email" class="form-control" placeholder="" value="<?php echo $system_data[1]->description; ?>"  required>
						</div>
                        
                        <div class="form-group">
                            <label><?php echo get_phrase('phone'); ?></label>
                            <input type="text"  name="phone" class="form-control" placeholder="" value="<?php echo $system_data[2]->description; ?>"required>
						</div>
                        
                        <div class="form-group">
                            <label><?php echo get_phrase('address'); ?></label>
                        	<textarea rows="5" cols="5" name="address" class="form-control" placeholder="Address" required><?php echo $system_data[4]->description; ?></textarea>
                        </div>
					     
                        <!--div class=" ">
						    <hr>
                        	<b>Social Links</b>
                        	<hr>
                        </div>
                        <div class="form-group">
                            <label><?php echo get_phrase('linkdin'); ?></label>
                            <input type="text"  name="linkdin" class="form-control" placeholder="" value="<?php echo $system_data[34]->description; ?>"  required>
						</div>
						<div class="form-group">
                            <label><?php echo get_phrase('wechat'); ?></label>
                            <input type="text"  name="wechat" class="form-control" placeholder="" value="<?php echo $system_data[35]->description; ?>"  required>
						</div>
						<div class="form-group">
                            <label><?php echo get_phrase('youtube'); ?></label>
                            <input type="text"  name="youtube" class="form-control" placeholder="" value="<?php echo $system_data[36]->description; ?>"  required>
						</div>
						<div class="form-group">
                            <label><?php echo get_phrase('tiktok'); ?></label>
                            <input type="text"  name="tiktok" class="form-control" placeholder="" value="<?php echo $system_data[37]->description; ?>"  required>
						</div>
						<div class="form-group">
                            <label><?php echo get_phrase('instagram'); ?></label>
                            <input type="text"  name="instagram" class="form-control" placeholder="" value="<?php echo $system_data[38]->description; ?>"  required>
						</div>
						<div class="form-group">
                            <label><?php echo get_phrase('twitter'); ?></label>
                            <input type="text"  name="twitter" class="form-control" placeholder="" value="<?php echo $system_data[39]->description; ?>"  required>
						</div>
						<div class="form-group">
                            <label><?php echo get_phrase('youku'); ?></label>
                            <input type="text"  name="youku" class="form-control" placeholder="" value="<?php echo $system_data[40]->description; ?>"  required>
						</div>
                        <div class="form-group">
                            <label><?php echo get_phrase('facebook'); ?></label>
                            <input type="text"  name="facebook" class="form-control" placeholder="" value="<?php echo $system_data[44]->description; ?>"  required>
						</div-->
						 <button type="submit" class="btn btn-primary waves-effect waves-light btn_right"><?php echo get_phrase('update_system'); ?></button>
                       
                </div>
            </div>
        </div>
        <div class="col-lg-6">
            <div class="card m-b-30">
                <div class="card-body">
                    <center>
						<?php if(empty($system_data[5]->description)){ ?>
							<img src="<?php echo base_url(); ?>assets/admin/images/admin.png" style="width:200px;">
						<?php }else{ ?>
							<img src="<?php echo base_url(); ?>uploads/admin/<?php echo $system_data[5]->description; ?>" style="width:210px;">
						<?php } ?>
						<br/>
						<br/>
						<div class="input-group  col-md-10 col-md-offset-1">
							<span class="input-group-addon"><i class="fa fa-image"></i></span>
							<input type="file" name="system_image" class="form-control"/>
						</div>
					</center>
                </div>
            </div>
        </div>
    </div>
</form>
