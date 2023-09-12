<?php 
    $leads_list = $this->db->get_where('leads_visitors',array('type'=>'visitor','leads_id'=>$param1))->result_array(); 
    
?>
<div class="row">
	<div class="col-md-12">
		<div class="card m-b-30">
			<h4 class="card-header mt-0"><i class="fa fa-plus"></i> 
			    Add To Sold
			</h4>
			<form method="POST" action="<?php echo base_url().admin_ctrl(); ?>/manage_leads/add_to_sold/<?php echo $param1; ?>"  enctype="multipart/form-data">
    			<div class="card-body" style="padding-top: 0px;">
    			    <input type="hidden" name="parent_id" value="<?php echo $param2; ?>">
                    <div class="row my-2">
                    	<div class="col-md-6">
                    		<label class="col-form-label">Existing Visitor<sup class="text-danger">*</sup>:</label>
                    	    <select class="form-control" name="visitor_id" id="leads_id" onchange="putLeads()">
                    	        <option value="" disabled selected>Please select visitor</option>
                    	        <?php foreach($leads_list as $lead){ ?>
                    	        <option value="<?php echo $lead['visitor_id']; ?>"><?php echo $lead['first_name'].' '.$lead['last_name']; ?></option>
                    	        <?php } ?>
                    	        <option value="0">other</option>
                    	    </select>
                    	</div>
                    	<div class="col-md-6">
                    		<label class="col-form-label">Sold Price<sup class="text-danger">*</sup>:</label>
                    		<input type="text" name="sold_price" class="form-control" placeholder="" value="" oninput="this.value = this.value.replace(/[^0-9.]/g, '').replace(/(\..*?)\..*/g, '$1');" required>
                    	</div>
                    </div>
                    <div id="input_visitor" style="display:none">
                        <div class="row my-2">
                        	<div class="col-md-6">
                        		<label class="col-form-label">First Name<sup class="text-danger">*</sup>:</label>
                        		<input type="text" name="first_name" class="form-control required" placeholder="" value="" required>
                        	</div>
                        	<div class="col-md-6">
                        		<label class="col-form-label">Last Name<sup class="text-danger">*</sup>:</label>
                        		<input type="text" name="last_name" class="form-control required" placeholder="" value="" required>
                        	</div>
                        </div>
                        <div class="row my-2">
                        	<div class="col-md-6">
                        		<label class="col-form-label">Email<sup class="text-danger">*</sup>:</label>
                        		<input type="email" name="email" class="form-control required" placeholder="" value="" required>
                        	</div>
                        	<div class="col-md-6">
                        		<label class="col-form-label">Phone Number:</label>
                        		<input type="text" name="phone_number" class="form-control " placeholder="" value="" >
                        	</div>
                        </div>
                       
                        <div class="row my-2">
                            <div class="col-md-6">
                        		<label class="col-form-label">Address:</label>
                        		<textarea type="text" name="address" class="form-control " placeholder=""  ></textarea>
                        	</div>
                        	<div class="col-md-6">
                        		<label class="col-form-label">Notes:</label>
                        		<textarea type="text" name="additional_notes" class="form-control " placeholder=""  ></textarea>
                        	</div>
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
<script>
    function putLeads(){
        var leads = $('#leads_id').val();
        $('#input_visitor').css('display','none');
        $('.required').removeAttr('required','required');
        if(leads == 0){
            $('#input_visitor').css('display','block');
            $('.required').attr('required','required');
        }
    }
</script>