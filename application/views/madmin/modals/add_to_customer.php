<?php $start_date = $this->db->get_where('leads',array('leads_id'=>$param1))->row()->start_date; ?>
<div class="row">
	<div class="col-md-12">
		<div class="card m-b-30">
			<h4 class="card-header mt-0"><i class="fa fa-plus"></i> 
			    Add To Customer
			</h4>
			<form method="POST" action="<?php echo base_url().admin_ctrl(); ?>/manage_leads/add_to_customer/<?php echo $param1; ?>"  enctype="multipart/form-data">
    			<div class="card-body" style="padding-top: 0px;">
    			    <input type="hidden" name="parent_id" value="<?php echo $param2; ?>">
    				<div class="form-group">
                        <label>Start Date</label>
                        <div>
                            <div class="input-group">
                                <input type="text" class="form-control" name="start_date" placeholder="dd/mm/yyyy" value="<?php echo set_date_for_display($start_date);?>" id="datepicker-autoclose-two">
                                <div class="input-group-append bg-custom b-0"><span class="input-group-text"><i class="mdi mdi-calendar"></i></span></div>
                            </div>
                        </div>
                    </div>
                    <div class="form-group">
                        <label>End Date</label>
                        <div>
                            <div class="input-group">
                                <input type="text" class="form-control" name="end_date" placeholder="dd/mm/yyyy" id="datepicker-autoclose" required>
                                <div class="input-group-append bg-custom b-0"><span class="input-group-text"><i class="mdi mdi-calendar"></i></span></div>
                            </div>
                        </div>
                    </div>
                    <div class="row" style="padding-left: 1em;">
                        <button type="button" class="btn btn-success btn-sm" onclick="changeDate(3)">3</button>&nbsp;
                        <button  type="button" class="btn btn-success btn-sm" onclick="changeDate(6)">6</button>&nbsp;
                        <button  type="button" class="btn btn-success btn-sm" onclick="changeDate(12)">12</button>
                    </div>
    				<div class="row">
    					<div class="col-sm-12 col-lg-12 text-right">
    						<button type="submit" class="btn btn-primary waves-effect waves-light btn_right">Add</button>
    					</div>
    				</div>
    			</div>
			</form>
        </div>
    </div>
</div> 
<script src="<?php echo assets_dir();?>plugins/bootstrap-datepicker/js/bootstrap-datepicker.min.js"></script>
<script src="<?php echo assets_dir();?>pages/form-advanced.js"></script>
<script>
    jQuery('#datepicker-autoclose-two').datepicker({
        autoclose: true,
        todayHighlight: true,
        format: "dd/mm/yyyy",
    });
   
</script>