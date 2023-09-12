<?php $user_permit = $this->session->userdata('permissions'); 
?>
<div class="row">
    <div class="col-12">
        <div class="card m-b-30">
            <div class="card-body">
                <?php if($param1 !='duration'){?>
                <?php if(!empty($maximum_number_leads_allowed) && $total_leads >= $maximum_number_leads_allowed){ ?>
					<div class="col-md-12" style="padding: 0em 3em;"> 
				    	<div class="alert alert-danger">
    					  <strong>Info!</strong> Your leads limit has been reached.
    					</div>
    				</div>
				    <?php } ?>
                <div class="row">
					<div class="col-md-7"><b style="padding-left:3em"><?php if(!empty($parent_name)){ echo "Leads for  <code class='text-capitalize'>".$parent_name."</code>"; }?></code></b> </div>
					<?php if($user_permit->add_lead == 1){ ?>
					<?php  if(!empty($maximum_number_leads_allowed) && $total_leads < $maximum_number_leads_allowed ){ ?>
					<div class="col-md-5" style="text-align: center;position: relative;left: 39px;padding: 5px;"> 
				        <a class="btn btn-sm btn-info" href="<?php echo base_url().admin_ctrl().'/add_lead/'.$param1; ?>" ><span><i class="fa fa-plus mar_right"></i>Add Lead</span></a>
				        <a class="btn btn-sm btn-info" href="javascript:;" onclick="showAjaxModal('<?php echo base_url(); ?>modal/popup/excel_import/<?php echo $param1; ?>', '<?php echo system_name(); ?>');" ><span><i class="fa fa-plus mar_right"></i>Import Leads</span></a>
					    <a class="btn btn-sm btn-info" href="<?php echo base_url(); ?>assets/Real Estate Example.xlsx" style="margin-right: 1em;"><span><i class="fa fa-download mar_right"></i>Template</span></a>
					</div>
					<?php } ?>
					<?php } ?>
				</div>
				<?php } ?>
                <div class="table-responsive">
                <table id="datatable-leads" class="table table-striped table-bordered" cellspacing="0" width="100%">
                    <thead>
                    <tr>
                       	<th>#</th>
    					<th><?php echo get_phrase('name'); ?></th>
    					<th><?php echo get_phrase('email'); ?></th>
    					<th><?php echo get_phrase('Phone'); ?></th>
    					<th><?php echo get_phrase('city'); ?></th>
    					<th><?php echo get_phrase('Address'); ?></th>
    					<th><?php echo get_phrase('created'); ?></th>
    					<th><?php echo get_phrase('duration'); ?></th>
    					<th><?php echo get_phrase('added_by'); ?></th>
    					<?php if($user_permit->add_note == 1 || $user_permit->add_visitor == 1 || $user_permit->view_lead == 1 || $user_permit->edit_lead == 1 || $user_permit->delete_lead == 1){ ?>
        				<th><?php echo get_phrase('action'); ?></th>
    					<?php } ?>
                    </tr>
                    </thead>
                    <tbody>
                        	<?php 
        						$count=0; if(!empty($leads_data)){foreach($leads_data as $data): $count++;
        						$date1 = new DateTime($data['first_contact']);
                                $date2 = new DateTime();
                                
                                $interval = $date1->diff($date2);
                                $duration='';
                                $class='';
            			        if($interval->y != 0 ){
            			             $duration =  $interval->y . " year(s) ago";
            			        }else if($interval->m !=0){
            			            $duration = $interval->m." month(s) ago";
            			            if($interval->m>=1 && $interval->m<=2){
            			               $class = 'text-info'; 
            			            }else if($interval->m>2 && $interval->m<=4){
            			                $class="text-warning";
            			            }else if($interval->m>=5){
            			                $class="text-danger";
            			            }
            			        }else if($interval->d !=0){
            			            $duration =$interval->d." day(s) ago";
            			        }
        					?>
        					<tr>
        						<td><?php echo $count; ?></td>
        						<td><a href="<?php echo base_url(); ?>admin/view_lead/<?php echo $data['leads_id'].'/'.$data['parent_id']; ?>"><?php echo $data['first_name'].' '.$data['last_name']; ?></a></td>
        						<td><?php echo $data['email']; ?></td>
        						<td><?php echo $data['phone_number']; ?></td>
        						<td><?php echo $data['city']; ?></td>
        						<td><?php echo $data['address']; ?></td>
        						<!--td><?php 
        						    if($data['lead_type'] == 'lead'){
        						        echo '<span class="badge badge-secondary">lead</span>';
        						    }else{
        						        echo '<span class="badge badge-info">customer</span>';
        						    } ?></td-->
        						<td><?php echo set_date_for_display($data['created_at']); ?></td>
        						<td><b class="<?php echo $class; ?>"><?php echo $duration==''?'0 days':$duration; ?></b></td>
        						
        						<!--td>
        						    <div class="table-toggle">
                                        <div class="toggle-btn1 <?php if ($data['status'] == 'Active') {
                                            echo 'active';
                                        } ?>">
                                            <input type="checkbox" class="cb-value"
                                                   value="<?php echo $data['users_system_id']; ?>" <?php if ($data['status'] == 'Active') {
                                                echo 'checked';
                                            } ?>/>
                                            <span class="round-btn"></span>
                                        </div>
                                    </div>
        						</td-->
        						<td>
        						    <?php echo $data['added_by']; ?> 
        						    <span class="badge badge-info">
        						        <?php if($data['role'] == 2){ echo 'broker'; }else if($data['role'] == 3){ echo 'employee'; } ?>
        						    </span>
        						</td>
        						<?php if($user_permit->add_note == 1 || $user_permit->add_visitor == 1 || $user_permit->view_lead == 1 || $user_permit->edit_lead == 1 || $user_permit->delete_lead == 1){ ?>
        						<td>
            						<div class="btn-group">
                                        <button type="button" class="btn btn-info dropdown-toggle" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                                            Action
                                        </button>
                                        <div class="dropdown-menu dropdown-menu-right">
                                            <?php if($user_permit->add_to_customer == 1){ ?>
                                            <a class="dropdown-item"  href="javascript:;" onclick="showAjaxModal('<?php echo base_url(); ?>modal/popup/add_to_customer/<?php echo $data['leads_id'].'/'.$data['parent_id']; ?>', '<?php echo system_name(); ?>');"><i class="fa fa-plus mar_right"></i> Add To Customer</a>
                                            <?php } ?>
                                            <?php if($user_permit->add_to_sold == 1){ ?>
                                            <a class="dropdown-item"  href="javascript:;" onclick="showAjaxModal('<?php echo base_url(); ?>modal/popup/add_to_sold/<?php echo $data['leads_id'].'/'.$data['parent_id']; ?>', '<?php echo system_name(); ?>');"><i class="fa fa-plus mar_right"></i> Add To Sold</a>
                                            <?php } ?>
                                            <?php if($user_permit->view_lead == 1){ ?>
                                            <a class="dropdown-item" href="<?php echo base_url(); ?>admin/view_lead/<?php echo $data['leads_id'].'/'.$data['parent_id'].'/lead'; ?>"><i class="fa  fa-eye mar_right"></i> View Lead</a>
                                           <?php } ?>
                                            <?php if($user_permit->edit_lead == 1){ ?>
                                            <a class="dropdown-item" href="<?php echo base_url(); ?>admin/edit_lead/<?php echo $data['leads_id'].'/'.$data['parent_id'].'/leads'; ?>"><i class="fa  fa-pencil mar_right"></i> Edit Lead</a>
                                            <?php } ?>
                                            <?php if($user_permit->delete_lead == 1){ ?>
                                            <a class="dropdown-item" href="javascript:;"
                                       onclick="confirm_modal_action('<?php echo base_url().admin_ctrl(); ?>/manage_leads/delete/<?php echo $data['leads_id'].'/'.$data['parent_id']; ?>');"><i class="fa  fa-trash-o mar_right"></i> Delete Lead</a>
                                            <?php } ?>
                                        </div>
                                    </div>
        						</td>
        						<?php } ?>
        					</tr>
        					<?php endforeach; }?>
                    </tbody>
                </table>
                </div>
            </div>
        </div>
    </div> <!-- end col -->
</div> <!-- end row -->
