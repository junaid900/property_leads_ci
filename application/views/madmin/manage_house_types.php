<?php $user_permit = $this->session->userdata('permissions'); 
?>
<div class="row">
    <div class="col-12">
        <div class="card m-b-30">
            <div class="card-body">
                <div class="row">
					<div class="col-md-9"> </div>
					<div class="col-md-3" style="text-align: center;position: relative;left: 39px;padding: 5px;"> 
					<a class="btn btn-sm btn-info" href="<?php echo base_url().admin_ctrl().'/add_house_types'; ?>" ><span><i class="fa fa-plus mar_right"></i>Add House Types</span></a>
					</div>
				</div>
				<div class="table-responsive">
                <table id="datatable-buttons-view" class="table table-striped table-bordered" cellspacing="0" width="100%">
                    <thead>
                    <tr>
                       	<th>#</th>
    					<th><?php echo get_phrase('name'); ?></th>
    					<th><?php echo get_phrase('status'); ?></th>
    					<th><?php echo get_phrase('action'); ?></th>
    			    </tr>
                    </thead>
                    <tbody>
                        	<?php 
        						$count=0; if(!empty($house_types_data)){foreach($house_types_data as $data): $count++;  
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
                                                   value="<?php echo $data['house_types_id']; ?>" <?php if ($data['status'] == 'Active') {
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
                                            <?php if($user_permit->edit_house_types == 1){ ?>
                                            <a class="dropdown-item" href="<?php echo base_url(); ?>admin/edit_house_types/<?php echo $data['house_types_id']; ?>"><i class="fa  fa-pencil mar_right"></i> Edit</a>
                                            <?php } ?>
                                            <?php if($user_permit->delete_house_types == 1){ ?>
                                            <a class="dropdown-item" href="javascript:;"
                                       onclick="confirm_modal_action('<?php echo base_url().admin_ctrl(); ?>/manage_house_types/delete/<?php echo $data['house_types_id']; ?>');"><i class="fa  fa-trash-o mar_right"></i> Delete</a>
                                        <?php } ?>
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
