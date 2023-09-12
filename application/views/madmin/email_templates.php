
<div class="row">
    <div class="col-12">
        <div class="card m-b-30">
            <div class="card-body">
                <div class="row">
					<div class="col-md-9"> </div>
					<div class="col-md-3" style="text-align: center;position: relative;left: 39px;padding: 5px;"> 
					    <a class="btn btn-sm btn-info" href="<?php echo base_url().admin_ctrl().'/add_email_template'; ?>" ><span><i class="fa fa-plus mar_right"></i>Add Template</span></a>
					</div>
				</div>
                <table id="datatable-buttons-view" class="table table-striped table-bordered" cellspacing="0" width="100%">
                    <thead>
                    <tr>
                       	<th>#</th>
    					<th><?php echo get_phrase('type'); ?></th>
    					<th><?php echo get_phrase('subject'); ?></th>
    					<th><?php echo get_phrase('status'); ?></th>
    					<th><?php echo get_phrase('action'); ?></th>
                    </tr>
                    </thead>
                    <tbody>
                        	<?php 
        						$count=0; if(!empty($email_templates)){foreach($email_templates as $data): $count++;  
        					?>
        					<tr>
        						<td><?php echo $count; ?></td>
        						<td><?php echo $data['type']; ?></td>
        						<td><?php echo $data['subject']; ?></td>
        						<td>
        						    <div class="table-toggle">
                                        <div class="toggle-btn1 <?php if ($data['status'] == 'Active') {
                                            echo 'active';
                                        } ?>">
                                            <input type="checkbox" class="cb-value"
                                                   value="<?php echo $data['email_templates_id']; ?>" <?php if ($data['status'] == 'Active') {
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
                                            <a class="dropdown-item" href="<?php echo base_url(); ?>admin/edit_email_template/<?php echo $data['email_templates_id']; ?>"><i class="fa  fa-pencil mar_right"></i> Edit</a>
                                            <a class="dropdown-item" href="javascript:;"
                                       onclick="confirm_modal_action('<?php echo base_url().admin_ctrl(); ?>/email_templates/delete/<?php echo $data['email_templates_id']; ?>');"><i class="fa  fa-trash-o mar_right"></i> Delete</a>
                                        </div>
                                    </div>
        						</td>
        					</tr>
        					<?php endforeach; }?>
                    </tbody>
                </table>
            </div>
        </div>
    </div> <!-- end col -->
</div> <!-- end row -->
