<div class="row">
    <div class="col-lg-12">
        <div class="card m-b-30">
            <div class="card-body">
            	<form method="POST" action="<?php echo base_url().admin_ctrl(); ?>/edit_broker/edit/<?php echo $param1; ?>"  enctype="multipart/form-data">
    					<div class="row">
    						<div class="col-md-12">
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
        								<input type="email" name="email" class="form-control" onkeyup="CheckEmail(this.value,<?php echo $param1; ?>)" placeholder="" value="<?php echo $request->email; ?>" required>
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
        								<label class="col-form-label">Phone Number:</label>
        								<input type="text" name="mobile" class="form-control" placeholder="" value="<?php echo $request->mobile; ?>" >
        							</div>
        							<div class="col-md-6">
        								<label class="col-form-label">BIV Number:</label>
        								<input type="text" name="biv_number" class="form-control" placeholder="" value="<?php echo $request->biv_number; ?>" >
        							</div>
        						</div>
        						<div class="row my-2">
        						    <div class="col-md-6">
        								<label class="col-form-label">Business Name:</label>
        								<input type="text" name="business_name" class="form-control" placeholder="" value="<?php echo $request->business_name; ?>" >
        							</div>
            						<div class="col-md-6">
        								<label class="col-form-label">Address:</label>
        								<textarea type="text" name="address" class="form-control" placeholder=""  ><?php echo $request->address; ?></textarea>
        							</div>
    							</div>
    							<div class="row my-2">
        							<div class="col-md-6">
        								<label class="col-form-label">City:</label>
        								<input type="text" name="city" class="form-control" placeholder="" value="<?php echo $request->city; ?>" required>
        							</div>
        							<div class="col-md-6">
        								<label class="col-form-label">DOB:</label>
        								<input type="text"  name="date_of_birth" class="form-control" id="datepicker-autoclose" value="<?php echo date('m/d/Y',strtotime($request->date_of_birth)); ?>"  placeholder=""  >
        							</div>
    							</div>
    							<div class="row my-2">
        							<div class="col-md-6">
        								<label class="col-form-label">How many number of employees allowed?</label>
        								<input type="number" name="number_of_employees_allowed" class="form-control" placeholder=""  oninput="this.value = this.value.replace(/[^0-9.]/g, '').replace(/(\..*?)\..*/g, '$1');"  value="<?php echo $request->number_of_employees_allowed; ?>" required>
        							</div>
        							<div class="col-md-6">
        								<label class="col-form-label">How many number of months, past data shown?</label>
        								<input type="number" name="past_data_shown_allowed" class="form-control" placeholder=""  oninput="this.value = this.value.replace(/[^0-9.]/g, '').replace(/(\..*?)\..*/g, '$1');"  value="<?php echo $request->past_data_shown_allowed; ?>" >
        							</div>
    							</div>
    							<div class="row my-2">
        							<div class="col-md-6">
        								<label class="col-form-label">How many times in a week data can be exported? </label>
        								<input type="number" name="past_data_shown_allowed" class="form-control" placeholder=""  oninput="this.value = this.value.replace(/[^0-9.]/g, '').replace(/(\..*?)\..*/g, '$1');"  value="<?php echo $request->past_data_shown_allowed; ?>" >
        							</div>
        							<div class="col-md-6">
        								<label class="col-form-label">Maximum number of leads allowed in a week  </label>
        								<input type="number" name="maximum_number_leads_allowed" class="form-control" placeholder=""  oninput="this.value = this.value.replace(/[^0-9.]/g, '').replace(/(\..*?)\..*/g, '$1');"  value="<?php echo $request->maximum_number_leads_allowed; ?>" >
        							</div>
    							</div>
    							
    							<div class="row">
    								<div class="col-sm-12 col-lg-12 text-right">
    									<button type="submit" class="btn btn-primary waves-effect waves-light btn_right"  id="btn_update_user">Save</button>
    								</div>
    							</div>
    							
    						</div>
    						
    					</div>
    				</form>
            </div>
        </div>
    </div>
</div>