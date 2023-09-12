<?php  $user_permit = $this->session->userdata('permissions'); 
?>
<div class="row">
    <div class="col-12">
        <div class="card m-b-30">
            <div class="card-body">
                <div class="row">
					<div class="col-md-9"> </div>
					<div class="col-md-3" style="text-align: center;position: relative;left: 39px;padding: 5px;"> 
					<!--<a class="btn btn-sm btn-info" href="<?php // echo base_url().admin_ctrl().'/add_event'; ?>" ><span><i class="fa fa-plus mar_right"></i>&nbsp;<?php echo get_phrase('add_events')  ?></span></a>-->
					</div>
				</div>
				<div class="table-responsive">
                <table id="datatable-buttons-view" class="table table-striped table-bordered" cellspacing="0" width="100%">
                    <thead>
                            <tr>
                              	<th>#</th>
    				
                				<th><?php echo get_phrase('translation'); ?></th>
                                <th style="width:200px"><?php echo get_phrase('translation'); ?></th>
                				
                				<th><?php echo get_phrase('phrase'); ?></th>
                				
                				
                				<th><?php echo get_phrase('action'); ?></th>
                            </tr>
                            </thead>
                                                  <tbody>

                    				<?php $lang = $this->db->get("language")->result_array(); ?>
                    				<?php $count= 1; foreach($lang as $l){ ?>
                    				<tr>
                    
                    					<td><?php echo $count++; ?></td>
                                        <td><?php echo $l[$param1]; ?></td>
                    					<td style="width:200px"><input id="phrase_<?php echo $l['phrase_id']; ?>" class="form-control" value="<?php echo $l[$param1]; ?>" ></td>
                    				
                    					<td>													
                                    		<button class="btn btn-success" onclick="save_language(<?php echo $l['phrase_id']; ?>,'<?php echo $param1; ?>')"><?php echo get_phrase('save'); ?></button>
                                    	</td>
                    					<td><?php echo $l['phrase']; ?></td>
                    				</tr>
                    				<?php } ?>
                    
                    			 </tbody>
                </table>
                </div>
            </div>
        </div>
    </div> <!-- end col -->
</div> <!-- end row -->

<!--Body End-->

