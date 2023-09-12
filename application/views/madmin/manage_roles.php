<div class="row">
    <div class="col-12">
        <div class="card m-b-30">
            <div class="card-body">
                <div class="table-responsive">
                <table id="datatable-buttons-view" class="table table-striped table-bordered" cellspacing="0" width="100%">
                    <thead>
                    <tr>
                       	<th>#</th>
    					<th><?php echo get_phrase('role'); ?></th>
    					<th><?php echo get_phrase('status'); ?></th>
    					<th><?php echo get_phrase('action'); ?></th>
                    </tr>
                    </thead>
                    <tbody>
                        	<?php 
        						$count=0; if(!empty($user_roles)){foreach($user_roles as $data): $count++;  
        					?>
        					<tr>
        						<td><?php echo $count; ?></td>
        						<td><?php echo $data['name']; ?></td>
        						<td>
        						    <div class="table-toggle">
                                        <div class="toggle-btn1 <?php if ($data['status'] == 'Active') {
                                            echo 'active';
                                        } ?>">
                                            <input type="checkbox" class="cb-value"
                                                   value="<?php echo $data['users_roles_id']; ?>" <?php if ($data['status'] == 'Active') {
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
                                            <a class="dropdown-item" href="<?php echo base_url(); ?>admin/manage_permissions/<?php echo $data['users_roles_id']; ?>"><i class="fa  fa-pencil mar_right"></i> Edit</a>
                                            <!--a class="dropdown-item" href="javascript:;"
                                       onclick="confirm_modal_action('<?php echo base_url().strtolower($this->session->userdata('directory')); ?>/manage_roles/delete_roles/<?php echo $data['users_roles_id']; ?>');">Delete</a-->
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
