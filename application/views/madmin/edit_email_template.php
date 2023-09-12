<div class="row">
    <div class="col-lg-12">
        <div class="card m-b-30">
            <div class="card-body">
            	<form method="POST" action="<?php echo base_url().admin_ctrl(); ?>/edit_email_template/edit/<?php echo $request->email_templates_id; ?>"  enctype="multipart/form-data">
    					<div class="alert alert-info">
    					  <strong>Info!</strong> Please use these widgets for  -   user Name: {user_name} , user Email: {user_email}
    					</div>
    					<div class="row">
    						<div class="col-md-12">
    							<div class="row">
    								<label class="col-sm-2 col-lg-2 col-form-label">Subject:</label>
    								<div class="col-sm-10 col-lg-10">
    									<input type="text" name="subject" class="form-control" placeholder="" value="<?php //echo $request->subject; ?>" required>
    								</div>
    							</div>
    							
    							
    							
    							<div class="form-group row" style="margin-top:2em;">
    								<label class="col-sm-2 col-form-label">Body:</label>
    								<div class="col-sm-10">
    									<textarea rows="5" cols="5" name="body" class="form-control summernote"
    											  placeholder="Address"><?php echo $request->body; ?></textarea>
    								</div>
    							</div>
    							
    							<div class="row">
    								<label class="col-sm-2 col-lg-2 col-form-label"> </label>
    								<div class="col-sm-10 col-lg-10">
    									<div class="input-group">
    										<button type="submit" class="btn btn-primary waves-effect waves-light btn_right">Save</button>
    									</div>
    								</div>
    							</div>
    							
    						</div>
    						
    					</div>
    				</form>
            </div>
        </div>
    </div>
</div>