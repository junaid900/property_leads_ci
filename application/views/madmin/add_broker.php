<div class="row">
    <div class="col-lg-12">
        <div class="card m-b-30">
            <div class="card-body">
            	<form method="POST" action="<?php echo base_url().admin_ctrl(); ?>/add_broker/add"  enctype="multipart/form-data">
    					<div class="row">
    						<div class="col-md-12">
    						    <div class="row my-2">
        							<div class="col-md-6">
        								<label class="col-form-label">First Name<sup class="text-danger">*</sup>:</label>
        								<input type="text" name="first_name" class="form-control" placeholder="" required>
        							</div>
        							<div class="col-md-6">
        								<label class="col-form-label">Last Name<sup class="text-danger">*</sup>:</label>
        								<input type="text" name="last_name" class="form-control" placeholder=""  required>
        							</div>
    							</div>
    							<div class="row my-2">
        							<div class="col-md-6">
        								<label class="col-form-label">Email<sup class="text-danger">*</sup>:</label>
        									<input type="email" name="email" id="email" onkeyup="CheckEmailExist(this.value)"  class="form-control" placeholder=""  required>
                                            <span class="form-bar"></span>
                                            <p id="error_email" style="color:red;margin:0px"></p>
        							</div>
        							<div class="col-md-6">
        								<label class="col-form-label">Password<sup class="text-danger">*</sup>:</label>
        								<input type="password" name="password" class="form-control" placeholder=""  required>
        							</div>
    							</div>
    							<div class="row my-2">
        							<div class="col-md-6">
        								<label class="col-form-label">Phone Number<sup class="text-danger"></sup>:</label>
        								<input type="text" name="mobile" class="form-control" placeholder="" >
        							</div>
        							<div class="col-md-6">
        								<label class="col-form-label">BIV Number<sup class="text-danger"></sup>:</label>
        								<input type="text" name="biv_number" class="form-control" placeholder=""  >
        							</div>
    							</div>
    							<div class="row my-2">
        							<div class="col-md-6">
        								<label class="col-form-label">City<sup class="text-danger"></sup>:</label>
        								<input type="text" name="city" class="form-control" placeholder="" >
        							</div>
        							<div class="col-md-6">
        								<label class="col-form-label">DOB<sup class="text-danger"></sup>:</label>
        								<input type="text"  name="date_of_birth" class="form-control" id="datepicker-autoclose" placeholder=""  >
        							</div>
    							</div>
    							<div class="row my-2">
    							    <div class="col-md-6">
        								<label class="col-form-label">Business Name<sup class="text-danger"></sup>:</label>
        								<input type="text" name="business_name" class="form-control" placeholder=""  >
        							</div>
    							    <div class="col-md-6">
        								<label class="col-form-label">Address<sup class="text-danger"></sup>:</label>
        								<textarea type="text" name="address" class="form-control" placeholder=""  ></textarea>
        							</div>
    							</div>
    							<div class="row my-2">
        							<div class="col-md-6">
        								<label class="col-form-label">How many number of employees allowed?<sup class="text-danger"></sup></label>
        								<input type="text" name="number_of_employees_allowed" class="form-control" placeholder="" oninput="this.value = this.value.replace(/[^0-9.]/g, '').replace(/(\..*?)\..*/g, '$1');" >
        							</div>
        							<div class="col-md-6">
        								<label class="col-form-label">How many number of months, past data shown? </label>
        								<input type="text" name="past_data_shown_allowed" class="form-control" placeholder="" oninput="this.value = this.value.replace(/[^0-9.]/g, '').replace(/(\..*?)\..*/g, '$1');" >
        							</div>
    							</div>
    							<div class="row my-2">
        							<div class="col-md-6">
        								<label class="col-form-label">How many times in a week data can be exported? </label>
        								<input type="text" name="number_of_time_data_exported" class="form-control" placeholder=""  oninput="this.value = this.value.replace(/[^0-9.]/g, '').replace(/(\..*?)\..*/g, '$1');">
        							</div>
        							<div class="col-md-6">
        								<label class="col-form-label">Maximum number of leads allowed in a week  </label>
        								<input type="text" name="maximum_number_leads_allowed" class="form-control" placeholder="" oninput="this.value = this.value.replace(/[^0-9.]/g, '').replace(/(\..*?)\..*/g, '$1');" >
        							</div>
    							</div>
    							
    							<div class="row">
    								<div class="col-sm-12 col-lg-12 text-right">
    									<button type="submit" id="btn_update_user" class="btn btn-primary waves-effect waves-light btn_right">Save</button>
    								</div>
    							</div>
    							
    						</div>
    						
    					</div>
    				</form>
            </div>
        </div>
    </div>
</div>