
<form role="form" method="POST" action="<?php echo base_url().admin_ctrl(); ?>/myprofile/update"  enctype="multipart/form-data">
    <div class="row">
        <div class="col-lg-6">
               <div class="card m-b-30">
                    <div class="card-body">
                       <div class="form-group">
                            <input type="hidden" name="admin_id" value="<?php echo $profile_data->users_system_id; ?>" required>
                            <label for="name"><?php echo get_phrase('full_name'); ?>:</label>
                            <input type="text" class="form-control"  name="first_name" placeholder="Enter name" value="<?php echo $profile_data->first_name; ?>">
                        </div>
                        <div class="form-group">
                            <label for="email"><?php echo get_phrase('email'); ?></label>
                            <input type="email" class="form-control" name="email" onkeyup="CheckEmail(this.value,<?php echo $profile_data->users_system_id; ?>)" value="<?php echo $profile_data->email; ?>" placeholder="Enter email">
                        	<span class="form-bar"></span>
							<p id="error_email" style="color:red;margin:0px"></p>
                        </div>
                        <div class="form-group">
                            <label for="Password"><?php echo get_phrase('password'); ?></label>
                            <input type="password"  name="password" class="form-control"  placeholder="Password">
                        </div>
                        <div class="form-group">
                            <label><?php echo get_phrase('phone'); ?></label>
                            <input type="text" name="mobile" class="form-control" placeholder="" value="<?php echo $profile_data->mobile; ?>" required>
						</div>
						<?php if($this->session->userdata('user_roles_id') != 1){?>
						<div class="form-group">
                            <label><?php echo get_phrase('biv_number'); ?></label>
                            <input type="text" name="biv_number" class="form-control" placeholder="" value="<?php echo $profile_data->biv_number; ?>" required>
						</div>
                        <?php } ?>
                        <button type="submit" class="btn btn-primary waves-effect waves-light btn_right" id="btn_update_user" ><?php echo get_phrase('update_profile'); ?></button>
                    </div>
                </div>
            </div>
        <div class="col-lg-6">
            <div class="card m-b-30">
                <div class="card-body">
                	<center>
                	   	<?php if(empty($profile_data->user_image)){ ?>
							<img src="<?php echo base_url(); ?>assets/admin/images/avatar-1.jpeg" style="width:200px;">
						<?php }else{ ?>
							<img src="<?php echo base_url(); ?>uploads/users/<?php echo $profile_data->user_image; ?>" style="width:200px;">
						<?php } ?>
						<br/>
						<br/>
						<div class="input-group  col-md-10 col-md-offset-1">
							<span class="input-group-addon"><i class="fa fa-image"></i></span>
							<input type="file" name="user_image" class="form-control"/>
						</div>
					</center>
                </div>
            </div>
        </div>
    </div>
</form>

