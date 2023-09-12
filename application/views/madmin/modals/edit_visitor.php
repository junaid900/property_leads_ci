<?php
    $request = $this->db->get_where('leads_visitors', array('visitor_id'=>$param1))->row(); 
 ?>
<div class="row">
	<div class="col-md-12">
		<div class="card m-b-30">
			<h4 class="card-header mt-0"><i class="fa fa-pencil"></i> 
			    Edit Visitor
			</h4>
			<form method="POST" action="<?php echo base_url().admin_ctrl(); ?>/view_lead/edit_visitor/<?php echo $param1.'/'.$param2.'/'.$param4; ?>"  enctype="multipart/form-data">
    			<div class="card-body" style="padding-top: 0px;">
    			    <input type="hidden" name="parent_id" value="<?php echo $param3; ?>">
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
                    		<input type="email" name="email" class="form-control" placeholder="" value="<?php echo $request->email; ?>" required>
                    	</div>
                    	<div class="col-md-6">
                    		<label class="col-form-label">Phone Number<sup class="text-danger">*</sup>:</label>
                    		<input type="text" name="phone_number" class="form-control" placeholder="" value="<?php echo $request->phone_number; ?>" required>
                    	</div>
                    </div>
                   
                    <div class="row my-2">
                        <div class="col-md-6">
                    		<label class="col-form-label">Address:</label>
                    		<textarea type="text" name="address" class="form-control" placeholder=""  ><?php echo $request->address; ?></textarea>
                    	</div>
                    	<div class="col-md-6">
                    		<label class="col-form-label">Notes:</label>
                    		<textarea type="text" name="additional_notes" class="form-control" placeholder=""  ><?php echo $request->additional_notes; ?></textarea>
                    	</div>
                    </div>
                    <div class="row my-2">
                      	<div class="col-md-6">
                    		<label class="col-form-label">Offered Price:</label>
                    		<input type="text" name="offered_amount" class="form-control" placeholder="" value="<?php echo $request->offered_amount; ?>" oninput="this.value = this.value.replace(/[^0-9.]/g, '').replace(/(\..*?)\..*/g, '$1');" >
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