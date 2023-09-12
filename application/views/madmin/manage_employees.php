<div class="row">
    <div class="col-12">
        <div class="card m-b-30">
            <div class="card-body">
                <div class="row">
					
					<?php if(!empty($broker_detail) && COUNT($employees_data) >= $broker_detail->number_of_employees_allowed){ ?>
					<div class="col-md-12" style="padding: 0em 4em;"> 
				    	<div class="alert alert-danger">
    					  <strong>Info!</strong> Your employee limit has been reached.
    					</div>
    				</div>
				    <?php } ?>
				
				    <?php if($role == 1){?>
				        <div class="col-md-9"> </div>
					   	<div class="col-md-3" style="text-align: center;position: relative;left: 39px;padding: 5px;"> 
				    	    <a class="btn btn-sm btn-info" href="<?php echo base_url().admin_ctrl().'/add_employee/'.$param1; ?>" ><span><i class="fa fa-plus mar_right"></i>Add Employee</span></a>
				        </div>
				    <?php }else{ ?>
					<?php if(!empty($broker_detail) && COUNT($employees_data) < $broker_detail->number_of_employees_allowed){ ?>
					   	<div class="col-md-9"> </div>
					   	<div class="col-md-3" style="text-align: center;position: relative;left: 39px;padding: 5px;"> 
				    	    <a class="btn btn-sm btn-info" href="<?php echo base_url().admin_ctrl().'/add_employee/'.$param1; ?>" ><span><i class="fa fa-plus mar_right"></i>Add Employee</span></a>
				        </div>
					<?php } ?>
					<?php } ?>
				
				</div>
				<div class="table-responsive">
                <table id="datatable-fourcols" class="table table-striped table-bordered" cellspacing="0" width="100%">
                    <thead>
                    <tr>
                       	<th>#</th>
    					<th><?php echo get_phrase('name'); ?></th>
    					<th><?php echo get_phrase('email'); ?></th>
    					<th><?php echo get_phrase('Phone'); ?></th>
    						<th><?php echo get_phrase('duration'); ?></th>
    					<th><?php echo get_phrase('last_logged_in'); ?></th>
    					<th><?php echo get_phrase('status'); ?></th>
    					<th><?php echo get_phrase('action'); ?></th>
                    </tr>
                    </thead>
                    <tbody>
                        	<?php 
        						$count=0; if(!empty($employees_data)){foreach($employees_data as $data): $count++;  
        						$date1 = new DateTime($data['created_at']);
                                $date2 = new DateTime();
                                
                                $interval = $date1->diff($date2);
                                $duration='';
                                $class='';
            			        if($interval->y != 0 ){
            			             $duration =  $interval->y . " year(s) ago";
            			        }else if($interval->m !=0){
            			            $duration = $interval->m." month(s) ago";
            			        }else if($interval->d !=0){
            			            $duration =$interval->d." day(s) ago";
            			        }
        					?>
        					<tr>
        						<td><?php echo $count; ?></td>
        						<td><?php echo $data['user_name']; ?></td>
        						<td><?php echo $data['email']; ?></td>
        						<td><?php echo $data['mobile']; ?></td>
        						<td><b><?php echo $duration==''?'0 days':$duration; ?></b></td>
        						<td><?php echo date('d/m/Y h:i',strtotime($data['last_logged_time'])); ?></td>
        						<td>
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
        						</td>
        						<td>
            						<div class="btn-group">
                                        <button type="button" class="btn btn-info dropdown-toggle" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                                            Action
                                        </button>
                                        <div class="dropdown-menu dropdown-menu-right">
                                            <a class="dropdown-item" href="javascript:;" onclick="showAjaxModal('<?php echo base_url(); ?>modal/popup/view_employee/<?php echo $data['users_system_id']; ?>', '<?php echo system_name(); ?>');"><i class="fa  fa-eye mar_right"></i> View</a>
                                            <a class="dropdown-item" href="<?php echo base_url(); ?>admin/manage_leads/<?php echo $data['users_system_id']; ?>"><i class="fa  fa-list mar_right"></i> Leads (<?php echo $data['total_leads']; ?>)</a>
                                             <a class="dropdown-item" href="<?php echo base_url(); ?>admin/export_report/employee/<?php echo $data['users_system_id']; ?>" ><i class="fa  fa-file mar_right"></i> View Report</a>
                                            <a class="dropdown-item" href="<?php echo base_url(); ?>admin/edit_employee/<?php echo $data['users_system_id'].'/'.$param1; ?>"><i class="fa  fa-pencil mar_right"></i> Edit</a>
                                            <a class="dropdown-item" href="javascript:;"
                                       onclick="confirm_modal_action('<?php echo base_url().admin_ctrl(); ?>/manage_employees/delete/<?php echo $data['users_system_id'].'/'.$param1; ?>');"><i class="fa  fa-trash-o mar_right"></i> Delete</a>
                                        </div>
                                    </div>
        						</td>
        					</tr>
        					<?php endforeach; }?>
                    </tbody>
                </table>
                </div>
            </div>
        </div>
    </div> <!-- end col -->
</div> <!-- end row -->
