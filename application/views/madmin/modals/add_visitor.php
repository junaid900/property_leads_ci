<div class="row">
	<div class="col-md-12">
		<div class="card m-b-30">
			<h4 class="card-header mt-0"><i class="fa fa-plus"></i> 
			    Add Visitor
			</h4>
			<form method="POST" action="<?php echo base_url().admin_ctrl(); ?>/view_lead/add_visitor/<?php echo $param1.'/'.$param3; ?>"  enctype="multipart/form-data">
    			<div class="card-body" style="padding-top: 0px;">
    			    <input type="hidden" name="parent_id" value="<?php echo $param2; ?>">
                    <div class="row my-2">
                    	<div class="col-md-6">
                    		<label class="col-form-label">First Name<sup class="text-danger">*</sup>:</label>
                    		<input type="text" name="first_name" class="form-control" placeholder="" value="" required>
                    	</div>
                    	<div class="col-md-6">
                    		<label class="col-form-label">Last Name<sup class="text-danger">*</sup>:</label>
                    		<input type="text" name="last_name" class="form-control" placeholder="" value="" required>
                    	</div>
                    </div>
                    <div class="row my-2">
                    	<div class="col-md-6">
                    		<label class="col-form-label">Email<sup class="text-danger">*</sup>:</label>
                    		<input type="email" name="email" class="form-control" placeholder="" value="" required>
                    	</div>
                    	<div class="col-md-6">
                    		<label class="col-form-label">Phone Number<sup class="text-danger">*</sup>:</label>
                    		<input type="text" name="phone_number" class="form-control" placeholder="" value="" required>
                    	</div>
                    </div>
                   
                    <div class="row my-2">
                        <div class="col-md-6">
                    		<label class="col-form-label">Address:</label>
                    		<textarea type="text" name="address" class="form-control" placeholder=""  ></textarea>
                    	</div>
                    	<div class="col-md-6">
                    		<label class="col-form-label">Notes:</label>
                    		<textarea type="text" name="additional_notes" class="form-control" placeholder=""  ></textarea>
                    	</div>
                    </div>
                    <div class="row my-2">
                      	<div class="col-md-6">
                    		<label class="col-form-label">Offered Price:</label>
                    		<input type="text" name="offered_amount" class="form-control" placeholder="" value="" oninput="this.value = this.value.replace(/[^0-9.]/g, '').replace(/(\..*?)\..*/g, '$1');" >
                    	</div>
                    </div>
                    <div class="row">
    					<div class="col-sm-12 col-lg-12 text-right">
    						<button type="submit" class="btn btn-primary waves-effect waves-light btn_right">Save</button>
    					</div>
    				</div>
                </div>
			</form>
        </div>
    </div>
</div> 