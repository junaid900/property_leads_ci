<?php 
 
    
    $user_permit = $this->session->userdata('permissions');
    $leads_id =$this->uri->segment(3);
    $parent_id =$this->uri->segment(4);
     $lead_type =$this->uri->segment(5);

    
    $data     = $this->db->get_where('leads',array('leads_id'=>$leads_id))->result_array();
    // print_r ($data[0]['lead_type']);
     /* $this->db->select("*");
    $this->db->from("leads");
    $this->db->where('leads_id',$leads_id); 
    $query = $this->db->get();
    echo "<pre>";
    print_r($query);   */
  ?>
<div class="row">
  <div class="col-lg-12">
      <div class="card m-b-30">
          <div class="card-body">
              <div class= "row">
                  <div class="col-md-8">
              <h4 class="text-primary"><i class="mdi mdi-account-box"></i>Customer Detail</h4>
              <div>
                  <h6 class="name text-danger"><?php echo $request->first_name.' '.$request->last_name;?></h6>
                                    <p><?php echo $request->phone_number; ?> <br> <?php echo $request->email; ?> <br><?php echo $request->postal_code; ?> <br> <?php echo $request->address.' , '.$request->city; ?></p>
                  <p><b>Est.</b> <?php echo $request->estimate_price; ?> - <b>List.</b> <?php echo $request->listing_price; ?></p>
              </div>
              </div>
                <div class="col-md-4">
                    <div class= "row">
                <!--Add to sold Button-->
                <!--&& $data[0]['lead_type'] ==  "customer" -->
            <?php    if($data[0]['lead_type'] != "sold"){ ?>
                    <div class="col-md-2"></div>
                    <div class="col-md-5" style="text-align: center;"> 
                      <a class="btn btn-sm btn-info btn_sold"  href="javascript:;" onclick="showAjaxModal('<?php echo base_url(); ?>modal/popup/add_to_sold/<?php echo $leads_id.'/'.$parent_id; ?>', '<?php echo system_name(); ?>');"><i class="fa fa-plus mar_right"></i> Add To Sold</a>
                    </div>
                     <div class="col-md-5" style="text-align: center;"> 
                       <a class="btn btn-sm btn-info" href="<?php echo base_url(); ?>admin/edit_lead/<?php echo  $leads_id.'/'.$parent_id.'/leads' ?>"><i class="fa  fa-pencil mar_right"></i> Edit <?php if(!empty($param3)){ echo $param3; }?></a>
                    </div>
			<?php	}	?>
			
		
        
        
                  </div>
                  </div>

              </div>
              
              <!-- <br> -->
              <h6 class="info text-info">Contract Information:</h6>
              <div class="d-flex"><span class="badge badge-info" style="line-height: 1.4;">StartDate:</span>
                  <span class="start">&nbsp;<td><?php echo set_date_for_display($request->start_date); ?></td> &nbsp;</span>
                  <?php if(!empty($request->end_date) && $request->end_date !='0000-00-00'){?>
                  <span  class="badge badge-info" style="line-height: 1.4;">EndDate:</span>
                  <span>&nbsp;<?php echo set_date_for_display($request->end_date); ?></span>
                  <?php } ?>
              </div>
              <br>
              <!--h5>Notes</h5--->
              <div class="row">
                  <div class="col-lg-12">
                      <div class="card m-b-30">
                          <div class="card-body">
                              <h4 class="mt-0 header-title text-info px-lg-5">Notes 
                              <?php if($user_permit->add_note == 1){ ?>
                              <button class="btn btn-sm btn-info" onclick="showAjaxModal('<?php echo base_url(); ?>modal/popup/add_note/<?php echo $param1.'/'.$param2.'/'.$param3; ?>', '<?php echo system_name(); ?>');" > <i class="fa fa-plus mar_right"></i> Add</button>
                              <?php } ?>
                              </h4>
                                    <div class="table-responsive">
                                        <table id="datatable-fourcols" class="table table-striped table-bordered lead_tbl_view" cellspacing="0"  width="100%">
                                          <thead>
                                            <tr>
                                                <th>Sr#</th>
                                                <th>Task</th>
                                                <th>Description</th>
                                                <th>Added By</th>
                                                <th>Date Time</th>
                                                <th>Action</th>
                                            </tr>
                                          </thead>
                                          <tbody>
                                                <?php if(!empty($notes)){
                                                    $count = 0;
                                                foreach($notes as $not){ $count++; ?>
                                                <tr>
                                                  <th scope="row"><?php echo $count; ?></th>
                                                  <td><?php echo $not['task']; ?></td>
                                                  <td><?php echo $not['description']; ?></td>
                                                  <td><?php echo $not['user_name']; ?> <span class="badge badge-info"><?php echo $not['role']; ?></span></td>
                                                  <td><?php echo set_date_for_display($not['created_at']); ?></td>
                                                  <td>
                            						<div class="btn-group">
                                                        <button type="button" class="btn btn-info dropdown-toggle " data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                                                            Action
                                                        </button>
                                                        <div class="dropdown-menu dropdown-menu-right">
                                                            <?php if($user_permit->view_note == 1){ ?>
                                                            <a class="dropdown-item" href="javascript:;" onclick="showAjaxModal('<?php echo base_url(); ?>modal/popup/view_note/<?php echo $not['notes_id'].'/'.$param1; ?>', '<?php echo system_name(); ?>');"><i class="fa  fa-eye mar_right"></i> View</a>
                                                            <?php } ?>
                                                            <?php if($user_permit->edit_note == 1){ ?>
                                                            <a class="dropdown-item" href="javascript:;" onclick="showAjaxModal('<?php echo base_url(); ?>modal/popup/edit_note/<?php echo $not['notes_id'].'/'.$param1.'/'.$param2.'/'.$param3; ?>', '<?php echo system_name(); ?>');"><i class="fa  fa-pencil mar_right"></i> Edit</a>
                                                            <?php } ?>
                                                            <?php if($user_permit->delete_note == 1){ ?>
                                                            <a class="dropdown-item" href="javascript:;"
                                                       onclick="confirm_modal_action('<?php echo base_url().admin_ctrl(); ?>/view_lead/delete/<?php echo $not['notes_id'].'/'.$param1.'/'.$param2.'/'.$param3; ?>');"><i class="fa  fa-trash-o mar_right"></i> Delete</a>
                                                            <?php } ?>
                                                        </div>
                                                    </div>
                        					       </td>
                                                </tr>
                                                <?php } }?>
                                          </tbody>
                                        </table>
                                    </div>
                                </div>
                              <hr>
                              <br>
                              <h4 class="mt-0 header-title text-info px-lg-5">Visitors 
                              <?php if($user_permit->add_visitor == 1){ ?>
                              <button class="btn btn-sm btn-info" onclick="showAjaxModal('<?php echo base_url(); ?>modal/popup/add_visitor/<?php echo $param1.'/'.$param2.'/'.$param3; ?>', '<?php echo system_name(); ?>');" > <i class="fa fa-plus mar_right"></i> Add</button>
                               <?php } ?>
                              </h4>
                              
                              <div class="table-responsive">
                                 <table id="datatable-sixcols" class="table table-striped table-bordered lead_tbl_view" cellspacing="0"  width="100%">
                                  <thead>
                                    <tr>
                                        <th>Sr#</th>
                                        <th>Name</th>
                                        <th>Email</th>
                                        <th>Added By</th>
                                        <th>Address</th>
                                        <th>Notes</th>
                                        <th>Created</th>
                                        <th>Action</th>
                                    </tr>
                                  </thead>
                                  <tbody>
                                        <?php 
                                            $sold_array = array();
                                            if(!empty($visitor)){
                                            $count = 0;
                                            foreach($visitor as $not){ $count++; 
                                            if($not['type'] == 'sold'){
                                               $sold_array =  $not;
                                            }
                                            if($not['type'] != 'sold'){
                                            ?>
                                        <tr>
                                          <th scope="row"><?php echo $count; ?></th>
                                          <td><?php echo $not['first_name'].' '.$not['last_name']; ?></td>
                                          <td><?php echo $not['email']; ?></td>
                                          <td><?php echo $not['user_name']; ?> <span class="badge badge-info"><?php echo $not['role']; ?></span></td>
                                          <td><?php echo $not['address']; ?></td>
                                          <td><?php echo $not['additional_notes']; ?></td>
                                          <td><?php echo set_date_for_display($not['created_at']); ?></td>
                                          <td>
                    						<div class="btn-group">
                                                <button type="button" class="btn btn-info dropdown-toggle" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                                                    Action
                                                </button>
                                                <div class="dropdown-menu dropdown-menu-right">
                                                    <?php if($param3 != 'sold'){ ?>
                                                    <a class="dropdown-item" href="javascript:;" onclick="showAjaxModal('<?php echo base_url(); ?>modal/popup/sold_to_visitor/<?php echo $not['visitor_id'].'/'.$param1.'/'.$param2.'/'.$param3; ?>', '<?php echo system_name(); ?>');"><i class="fa  fa-plus mar_right"></i> Add to Sold</a>
                                                    <?php } ?>
                                                    <?php if($user_permit->view_visitor == 1){ ?>
                                                    <a class="dropdown-item" href="javascript:;" onclick="showAjaxModal('<?php echo base_url(); ?>modal/popup/view_visitor/<?php echo $not['visitor_id'].'/'.$param1; ?>', '<?php echo system_name(); ?>');"><i class="fa  fa-eye mar_right"></i> View</a>
                                                    <?php } ?>
                                                    <?php if($user_permit->edit_visitor == 1){ ?>
                                                    <a class="dropdown-item" href="javascript:;" onclick="showAjaxModal('<?php echo base_url(); ?>modal/popup/edit_visitor/<?php echo $not['visitor_id'].'/'.$param1.'/'.$param2.'/'.$param3; ?>', '<?php echo system_name(); ?>');"><i class="fa  fa-pencil mar_right"></i> Edit</a>
                                                    <?php } ?>
                                                    <?php if($user_permit->edit_visitor == 1 && $param3 != 'sold'){ ?>
                                                    <a class="dropdown-item" href="javascript:;"
                                               onclick="confirm_modal_action('<?php echo base_url().admin_ctrl(); ?>/view_lead/delete_visitor/<?php echo $not['visitor_id'].'/'.$param1.'/'.$param3; ?>');"><i class="fa  fa-trash-o mar_right"></i> Delete</a>
                                                    <?php } ?>
                                                </div>
                                            </div>
                					       </td>
                                        </tr>
                                        <?php } } }?>
                                  </tbody>
                              </table>
                          </div>
                          <!-- sold data -->
                          
                          <?php  if(!empty($sold_array)){ $not = $sold_array;?>
                          <div class="col-lg-12" style="padding: 2em 3em;">
                              <h4 class="mt-0 header-title text-info ">Sold</h4>
                              <table  class="table table-striped table-bordered lead_tbl_view" cellspacing="0"  width="100%">
                                  <thead>
                                    <tr>
                                        <th>Sr#</th>
                                        <th> Name</th>
                                        <th>Email</th>
                                        <th>Sold Price</th>
                                        <th>Added By</th>
                                        <th>Address</th>
                                        <th>Notes</th>
                                        <th>Created</th>
                                        
                                        <th>Action</th>
                                    </tr>
                                  </thead>
                                  <tbody>
                                        
                                        <tr>
                                          <th scope="row">1</th>
                                          <td><?php echo $not['first_name'].' '.$not['last_name']; ?></td>
                                          <td><?php echo $not['email']; ?></td>
                                          <td><?php echo $not['sold_amount']; ?></td>
                                          <td><?php echo $not['user_name']; ?> <span class="badge badge-info"><?php echo $not['role']; ?></span></td>
                                          <td><?php echo $not['address']; ?></td>
                                          <td><?php echo $not['additional_notes']; ?></td>
                                          <td><?php echo set_date_for_display($not['created_at']); ?></td>
                                          <td>
                    						<div class="btn-group">
                                                <button type="button" class="btn btn-info dropdown-toggle" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                                                    Action
                                                </button>
                                                <div class="dropdown-menu dropdown-menu-right">
                                                    <?php if($user_permit->view_visitor == 1){ ?>
                                                    <a class="dropdown-item" href="javascript:;" onclick="showAjaxModal('<?php echo base_url(); ?>modal/popup/view_visitor/<?php echo $not['visitor_id'].'/'.$param1; ?>', '<?php echo system_name(); ?>');"><i class="fa  fa-eye mar_right"></i> View</a>
                                                    <?php } ?>
                                                    <?php if($user_permit->edit_visitor == 1){ ?>
                                                    <a class="dropdown-item" href="javascript:;" onclick="showAjaxModal('<?php echo base_url(); ?>modal/popup/edit_sold/<?php echo $not['visitor_id'].'/'.$param1.'/'.$param2.'/'.$param3; ?>', '<?php echo system_name(); ?>');"><i class="fa  fa-pencil mar_right"></i> Edit</a>
                                                    <?php } ?>
                                                    <?php if($user_permit->edit_visitor == 1 && $param3 != 'sold'){ ?>
                                                    <a class="dropdown-item" href="javascript:;"
                                               onclick="confirm_modal_action('<?php echo base_url().admin_ctrl(); ?>/view_lead/delete_visitor/<?php echo $not['visitor_id'].'/'.$param1.'/'.$param3; ?>');"><i class="fa  fa-trash-o mar_right"></i> Delete</a>
                                                    <?php } ?>
                                                </div>
                                            </div>
                					       </td>
                                        </tr>
                                  </tbody>
                              </table>
                          </div>
                          <?php } ?>
                          <!-- sold data -->
                          
                          
                      </div>
                  </div> <!-- end col -->
              </div>
          </div>
      </div>
  </div>
</div>