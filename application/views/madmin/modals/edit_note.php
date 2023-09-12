<?php
    $details = $this->db->get_where('notes', array('notes_id'=>$param1))->row(); 
 ?>
<div class="row">
	<div class="col-md-12">
		<div class="card m-b-30">
			<h4 class="card-header mt-0"><i class="fa fa-pencil"></i> 
			    Edit Note
			</h4>
			<form method="POST" action="<?php echo base_url().admin_ctrl(); ?>/view_lead/edit_note/<?php echo $param1.'/'.$param2.'/'.$param4; ?>"  enctype="multipart/form-data">
    			<div class="card-body" style="padding-top: 0px;">
    			    <input type="hidden" name="parent_id" value="<?php echo $param3; ?>">
    			    <div class="row my-2">
    					<div class="col-md-12">
    						<label class="col-form-label">Task<sup class="text-danger">*</sup>:</label>
    						<input type="text" name="task" class="form-control" placeholder="" value="<?php echo $details->task; ?>" required>
    					</div>
    				</div>
    				<div class="row my-2">
    					<div class="col-md-12">
    						<label class="col-form-label">Description<sup class="text-danger">*</sup>:</label>
    						<textarea name="description" class="form-control" placeholder="" value="" required><?php echo $details->description; ?></textarea>
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