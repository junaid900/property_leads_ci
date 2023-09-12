<div class="row">
	<div class="col-md-12">
		<div class="card m-b-30">
			<h4 class="card-header mt-0"><i class="fa fa-pencil"></i> 
			    Add to sold
			</h4>
			<form method="POST" action="<?php echo base_url().admin_ctrl(); ?>/view_lead/add_to_sold/<?php echo $param1.'/'.$param2.'/'.$param4; ?>"  enctype="multipart/form-data">
    			<div class="card-body" style="padding-top: 0px;">
    			    <input type="hidden" name="parent_id" value="<?php echo $param3; ?>">
    			    <div class="row my-2">
    					<div class="col-md-6">
    						<label class="col-form-label">Sold Price<sup class="text-danger">*</sup>:</label>
    						<input type="text" name="sold_price" class="form-control" placeholder="" oninput="this.value = this.value.replace(/[^0-9.]/g, '').replace(/(\..*?)\..*/g, '$1');" required>
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