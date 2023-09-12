<div class="row">
    <div class="col-lg-12">
        <div class="card m-b-30">
            <div class="card-body">
            	<form method="POST" action="<?php echo base_url().admin_ctrl(); ?>/edit_employee/edit/<?php echo $param1; ?>"  enctype="multipart/form-data">
    					<div class="row">
    						<div class="col-md-12">
    						    <input type="hidden" name="parent_id" value="<?php echo $param2; ?>">
    						    <div class="row my-2">
        							<div class="col-md-6">
        								<label class="col-form-label">First Name<sup class="text-danger">*</sup>:</label>
        								<input type="text" name="first_name" class="form-control" placeholder="" value="<?php echo $request->first_name; ?>" required>
        							</div>
        							<div class="col-md-6">
        								<label class="col-form-label">Last Name<sup class="text-danger">*</sup>:</label>
        								<input type="text" name="last_name" class="form-control" placeholder="" value="<?php echo $request->last_name; ?>" required>
        							</div>
    							</div>
    							<div class="row my-2">
        							<div class="col-md-6">
        								<label class="col-form-label">Email<sup class="text-danger">*</sup>:</label>
        									<input type="email" name="email" id="email" onkeyup="CheckEmail(this.value,<?php echo $param1; ?>)"  value="<?php echo $request->email; ?>" class="form-control" placeholder=""  required>
        									<span class="form-bar"></span>
						                	<p id="error_email" style="color:red;margin:0px"></p>
        							</div>
        							<div class="col-md-6">
        								<label class="col-form-label">Password<sup class="text-danger">*</sup>:</label>
        								<input type="password" name="password" class="form-control" placeholder="" value="" >
        							</div>
        						</div>
    							<div class="row my-2">
        							<div class="col-md-6">
        								<label class="col-form-label">Phone Number<sup class="text-danger"></sup>:</label>
        								<input type="text" name="mobile" class="form-control" placeholder="" value="<?php echo $request->mobile; ?>" >
        							</div>
        						    <div class="col-md-6">
        								<label class="col-form-label">BIV Number<sup class="text-danger"></sup>:</label>
        								<input type="text" name="biv_number" class="form-control" placeholder=""  value="<?php echo $request->biv_number; ?>" >
        							</div>
        						</div>
        						<div class="row my-2">
        						    <div class="col-md-6">
        								<label class="col-form-label">City<sup class="text-danger"></sup>:</label>
        								<input type="text" name="city" class="form-control" placeholder="" value="<?php echo $request->city; ?>" >
        							</div>
        							<div class="col-md-6">
        								<label class="col-form-label">Address<sup class="text-danger"></sup>:</label>
        								<textarea type="text" name="address" class="form-control" placeholder=""  ><?php echo $request->address; ?></textarea>
        							</div>
        						</div>
        						
    							
    							
    							<div class="row">
    								<div class="col-sm-12 col-lg-12 text-right">
    										<button type="submit"   class="btn btn-primary waves-effect waves-light btn_right" id="btn_update_user">Save</button>
    								</div>
    							</div>
    							
    						</div>
    						
    					</div>
    				</form>
            </div>
        </div>
    </div>
</div>
