<div class="row">
    <div class="col-lg-12">
        <div class="card m-b-30">
            <div class="card-body">
            	<form method="POST" action="<?php echo base_url().admin_ctrl(); ?>/edit_house_situation/edit/<?php echo $param1; ?>"  enctype="multipart/form-data">
    					<div class="row">
    						<div class="col-md-12">
    						    <div class="row my-2">
        							<div class="col-md-6">
        								<label class="col-form-label">Name<sup class="text-danger">*</sup>:</label>
        								<input type="text" name="name" class="form-control" placeholder="" value="<?php echo $request->name; ?>" required>
        							</div>
        						</div>
    							
    							
    							<div class="row">
    								<div class="col-sm-12 col-lg-12 text-right">
    									<button type="submit" class="btn btn-primary waves-effect waves-light btn_right">Save</button>
    								</div>
    							</div>
    							
    						</div>
    						
    					</div>
    				</form>
            </div>
        </div>
    </div>
</div>