
 <div class="row">
    <?php if($role == 1){ ?>
    <div class="col-md-6 col-xl-4">
        <div class="mini-stat clearfix bg-white">
            <span class="mini-stat-icon bg-light"><a href="<?php echo base_url(); ?>admin/manage_brokers" class="text-danger"><i class="mdi mdi-account-network text-danger"></i></a></span>
            <div class="mini-stat-info text-right text-muted">
                <span class="counter text-danger"><a href="<?php echo base_url(); ?>admin/manage_brokers" class="text-danger"><?php echo $total_brokers; ?></a></span>
             <?php  echo get_phrase("total_brokers") ?>
            </div>
            <!--p class="mb-0 m-t-20 text-muted">Total income: $22506 <span class="pull-right"><i class="fa fa-caret-up m-r-5"></i>10.25%</span></p-->
        </div>
    </div>
    <?php } ?>
    <?php if($role == 1 || $role == 2){ ?>
    <div class="col-md-6 <?php if($role == 1){ echo 'col-xl-4'; }else if($role == 2){ echo 'col-xl-6'; } ?>">
        <div class="mini-stat clearfix bg-success">
            <span class="mini-stat-icon bg-light">
                <?php if($role == 2){ ?><a href="<?php echo base_url(); ?>admin/manage_employees" class="text-danger"><?php } ?>
                    <i class="mdi mdi-account-multiple-outline text-success"></i>
                <?php if($role == 2){ ?></a><?php } ?>
            </span>
            <div class="mini-stat-info text-right text-white">
                <span class="counter text-white">
                <?php if($role == 2){ ?>
                    <a href="<?php echo base_url(); ?>admin/manage_employees" class="text-white">
                <?php } ?>        
                <?php echo $total_employees; ?>
                <?php if($role == 2){ ?>
                </a>
                <?php } ?>        
                </span>
                <?php echo get_phrase("total_employee")  ?>
                <!--Total Employees-->
            </div>
        </div>
    </div>
    <?php } ?>
    
    <div class="col-md-6 <?php if($role == 1){ echo 'col-xl-4'; }else if($role == 2){ echo 'col-xl-6'; }else if($role == 3){ echo 'col-xl-4'; } ?>">
        <div class="mini-stat clearfix bg-white">
            <div class="row">
                <div class="col-md-8">
                    <div class="duplex">
                        <p>
                     <?php echo get_phrase ("contract duration (1-2 months ago)") ?>:<a  href="<?php echo base_url().admin_ctrl(); ?>/manage_leads/duration/0/2" class="bg-info <?php if($leads_bullets['info_count'] ==0){ echo 'disabled'; }?>"><?php echo $leads_bullets['info_count']; ?></a>
                        </p>
                        <p>
                     <?php echo get_phrase ("contract duration (3-4 months ago)") ?> : <a  href="<?php echo base_url().admin_ctrl(); ?>/manage_leads/duration/2/4"  class="bg-warning <?php if($leads_bullets['warning_count'] ==0){ echo 'disabled'; }?>"><?php echo $leads_bullets['warning_count']; ?></a>
                        </p>
                        <p>
                        <?php echo get_phrase ("contract duration (5-6 months ago)") ?> : <a  href="<?php echo base_url().admin_ctrl(); ?>/manage_leads/duration/4/6" class="bg-danger <?php if($leads_bullets['danger_count'] ==0){ echo 'disabled'; }?>"><?php echo $leads_bullets['danger_count']; ?></a>
                        </p>
                    </div>
                </div>
                <div class="col-md-4 cdt">
                    <span class="counter text-warning">
                        <a href="<?php echo base_url(); ?>admin/manage_leads" class="text-warning">
                        <?php echo $total_leads; ?>
                        </a>
                    </span>
            <?php  echo get_phrase ("total_leads")  ?>
                </div>
            </div>
        </div>
    </div>
    <div class="col-md-6 <?php if($role == 1){ echo 'col-xl-4'; }else if($role == 2){ echo 'col-xl-6'; }else if($role == 3){ echo 'col-xl-4'; } ?>">
        <div class="mini-stat clearfix bg-info">
             <div class="row">
                <div class="col-md-8">
                    <div class="duplex">
                        <p class="text-white">
                            <?php echo get_phrase ("contract duration (1-2 months ago)") ?>: <a  href="<?php echo base_url().admin_ctrl(); ?>/manage_customer/duration/0/2" class="bg-info <?php if($customer_bullets['info_count'] ==0){ echo 'disabled'; }?>" style="background-color: #047f8d !important;"><?php echo $customer_bullets['info_count']; ?></a>
                        </p>
                        <p class="text-white">
                        <?php echo get_phrase ("contract duration (3-4 months ago)") ?>: <a  href="<?php echo base_url().admin_ctrl(); ?>/manage_customer/duration/2/4" class="bg-warning <?php if($customer_bullets['warning_count'] ==0){ echo 'disabled'; }?>"><?php echo $customer_bullets['warning_count']; ?></a>
                        </p>
                        <p class="text-white">
                        <?php echo get_phrase ("contract duration (5-6 months ago)") ?>: <a  href="<?php echo base_url().admin_ctrl(); ?>/manage_customer/duration/4/6" class="bg-danger <?php if($customer_bullets['danger_count'] ==0){ echo 'disabled'; }?>"><?php echo $customer_bullets['danger_count']; ?></a>
                        </p>
                    </div>
                </div>
                <div class="col-md-4 cdt text-white" style="padding-left: 0px;">
                    <span class="counter text-white">
                    <?php if($role != 1){ ?>
                    <a href="<?php echo base_url(); ?>admin/manage_customer" class="text-white">
                    <?php } ?>        
                        <?php echo $total_customer; ?>
                    <?php if($role != 1){ ?>
                    </a>
                    <?php } ?>
                    </span>
                    <?php echo get_phrase ("total_customers") ?>
                </div>
            </div>
        </div>
    </div>
    <div class="col-md-6 <?php if($role == 1){ echo 'col-xl-4'; }else if($role == 2){ echo 'col-xl-6'; }else if($role == 3){ echo 'col-xl-4'; } ?>">
        <div class="mini-stat clearfix bg-primary">
            <div class="row">
                <div class="col-md-8">
                    <div class="duplex">
                        <p class="text-white">
                            <?php echo get_phrase ("contract duration (1-2 months ago)") ?>: <a  href="<?php echo base_url().admin_ctrl(); ?>/manage_sold/duration/0/2" class="bg-info <?php if($sold_bullets['info_count'] ==0){ echo 'disabled'; }?>" style="background-color: #047f8d !important;"><?php echo $sold_bullets['info_count']; ?></a>
                        </p>
                        <p class="text-white">
                        <?php echo get_phrase ("contract duration (3-4 months ago)") ?>: <a  href="<?php echo base_url().admin_ctrl(); ?>/manage_sold/duration/2/4" class="bg-warning <?php if($sold_bullets['warning_count'] ==0){ echo 'disabled'; }?>"><?php echo $sold_bullets['warning_count']; ?></a>
                        </p>
                        <p class="text-white">
                        <?php echo get_phrase ("contract duration (4-6 months ago)") ?>: <a  href="<?php echo base_url().admin_ctrl(); ?>/manage_sold/duration/4/6" class="bg-danger <?php if($sold_bullets['danger_count'] ==0){ echo 'disabled'; }?>"><?php echo $sold_bullets['danger_count']; ?></a>
                        </p>
                    </div>
                </div>
                <div class="col-md-4 cdt text-white">
                    <span class="counter text-white">
                    <?php if($role != 1){ ?>
                    <a href="<?php echo base_url(); ?>admin/manage_sold" class="text-white">
                    <?php } ?>     
                        <?php echo $total_sold; ?>
                    <?php if($role != 1){ ?>
                    </a>
                    <?php } ?>
                    </span>
                    <?php echo get_phrase ("total_solds") ?>
                </div>
            </div>
        </div>
    </div>
    
</div>
<div class="row">
     <?php if($role == 1){ ?>
        <div class="col-md-3 text-left">
            <div class="form-group">
                <label><?php echo get_phrase ("filtered_by_broker") ?></label>
                    <select class="form-control"  id="broker_id">
                    <option value=""><?php echo get_phrase ("please_select_broker") ?></option>
                    <?php if(!empty($broker_list)){foreach($broker_list as $data){ ?>
                    <option value="<?php echo $data['users_system_id']; ?>" ><?php echo $data['first_name'].' '.$data['last_name']; ?></option>
                    <?php } } ?>
            </select>
            </div>
        </div>
     <?php }else if($role == 2){ ?>
     <div class="col-md-3 text-left">
            <div class="form-group">
                <label><?php echo get_phrase ("filtered_by_employee") ?></label>
                    <select class="form-control"  id="broker_id">
                    <option value=""><?php echo get_phrase ("please_select_employee") ?></option>
                    <?php if(!empty($employee_list)){foreach($employee_list as $data){ ?>
                    <option value="<?php echo $data['users_system_id']; ?>" ><?php echo $data['first_name'].' '.$data['last_name']; ?></option>
                    <?php } } ?>
            </select>
            </div>
        </div>
     <?php } ?>
     <div class="col-lg-4">
         <div class="form-group">
            <label><?php echo get_phrase ("filtered_by_date") ?></label>
            <div>
                <div class="input-daterange input-group" id="date-range">
                    <input type="text" class="form-control" name="start" id="start" placeholder="Start Date" />
                    <input type="text" class="form-control" name="end"  id="end" placeholder="End Date" />
                    <select class="form-control" id="report_type" >
                        <option value="lead"><?php echo get_phrase ("listing") ?></option>
                        <option value="sold"><?php echo get_phrase ("sold") ?></option>
                    </select>
                    &nbsp;<button class="btn btn-info" type="button" onclick="get_stats_by_date()"><span><i class="fa fa-search mar_right"></i></span></button>
                    &nbsp; <span><i class="fa fa-refresh mar_right" onclick="windowReload()" style="margin-top: 10px;margin-left: 1em;cursor:pointer"></i></span>
                </div>
            </div>
        </div>    
     </div>
 	<div class="col-md-<?php if($role == 2){ echo '5'; }else if($role == 3){ echo '8'; }?>" style="text-align: right;"> 
	<?php if($role == 1){?>
	    <!--label style="visibility:hidden;display:block">Export</label>
	    <a class="btn btn-sm btn-info" href="javascript:;" onclick="exportDashboardPDf()"><span><i class="fa fa-download mar_right"></i>&nbsp;Export PDF</span></a-->
	<?php }else{ ?>
	<?php if(!empty($number_of_time_data_exported) && $total_exports <$number_of_time_data_exported){ ?>
	    <label style="visibility:hidden;display:block"><?php echo get_phrase ("export") ?></label>
	    <a class="btn btn-sm btn-info" href="javascript:;" onclick="exportDashboardPDf()"><span><i class="fa fa-download mar_right"></i>&nbsp;<?php echo get_phrase ("export_PDF") ?></span></a>
	<?php } ?>
	<?php } ?>
	
	<?php if(!empty($number_of_time_data_exported) && $total_exports >=$number_of_time_data_exported){ ?>
	 <label style="visibility:hidden;display:block"><?php echo get_phrase ("export") ?></label>
	<div class="col-md-12" style="padding: 0em 1em;"> 
    	<div class="alert alert-danger text-left">
		  <strong><?php echo get_phrase ("info") ?>!</strong><?php echo get_phrase ("your_export_limit_has_been_reached") ?>.
		</div>
	</div>
    <?php } ?>
	</div>
</div>
<div class="row">
    <div class="col-lg-6">
        <div class="card m-b-30">
            <div class="card-body">
                <h4 class="mt-0 header-title"><?php echo get_phrase ("amount_of_listing") ?> </h4>
                <canvas id="lineChart" height="300"></canvas>
            </div>
        </div>
    </div> <!-- end col -->
    
    <div class="col-lg-6">
        <div class="card m-b-30">
            <div class="card-body">
             <h4 class="mt-0 header-title"><?php echo get_phrase ("amount_of_listing_per_region") ?> </h4>
             <canvas id="bar" height="300"></canvas>
            </div>
        </div>
    </div> <!-- end col -->
</div> <!-- end row -->

<div class="row">
    
    <div class="col-lg-6">
        <div class="card m-b-30">
            <div class="card-body">
                <h4 class="mt-0 header-title"><?php echo get_phrase ("amount_of_listing_per_region") ?></h4>
                <canvas id="doughnut" height="260"></canvas>
            </div>
        </div>
    </div> <!-- end col -->
    
    <div class="col-lg-6">
        <div class="card m-b-30">
            <div class="card-body">
                <h4 class="mt-0 header-title"><?php echo get_phrase ("average_asking_price_per_region") ?></h4> 
                <canvas id="avg_listing_by_region" height="300"></canvas>
            </div>
        </div>
    </div>
</div> <!-- end row -->
<div class="row">
    <div class="col-lg-6">
        <div class="card m-b-30">
            <div class="card-body">
             <h4 class="mt-0 header-title"><?php echo get_phrase ("amount_of") ?> <span class="lead_listing"><?php echo get_phrase ("listing") ?></span> <?php echo get_phrase ("per type") ?></h4>
             <canvas id="listing_per_type" height="300"></canvas>
            </div>
        </div>
    </div> 
    <div class="col-lg-6">
        <div class="card m-b-30">
            <div class="card-body">
             <h4 class="mt-0 header-title"> <?php echo get_phrase ("average") ?> <span class="lead_listing"><?php echo get_phrase ("listing") ?></span> <?php echo get_phrase ("price per type") ?></h4>
             <canvas id="avg_selling_per_type" height="300"></canvas>
            </div>
        </div>
    </div> 
</div> 
<div class="row">
     <div class="col-lg-6">
        <div class="card m-b-30">
            <div class="card-body">
             <h4 class="mt-0 header-title"><?php echo get_phrase ("average") ?><span class="lead_listing"><?php echo get_phrase ("listing") ?></span> <?php echo get_phrase ("per region") ?></h4>
             <canvas id="avg_selling_per_region" height="300"></canvas>
            </div>
        </div>
    </div>
</div>
<div class="row">

     <!-- end col -->
    
    <!--div class="col-lg-6">
        <div class="card m-b-30">
            <div class="card-body">
             <h4 class="mt-0 header-title">Avg Percentage our estimate is off <div class="row per_detail"><div class="positives"></div><span>Positive</span><div class="negatives"></div><span>Negative</span><div class="balances"></div><span>Balance</span></div> </h4>
             <div id="estimate_off" style="height: 305px"></div>
            </div>
        </div>
    </div--> 
</div> 
 <div class="row" id="round_graphs">
   
    
</div>

<div class="row">
    <div class="col-lg-12">
        <div class="card m-b-30">
            <div class="card-body">
                <div class="row">
                    <div class="col-md-3">
                        <h4 class="mt-0 header-title"><?php echo get_phrase ("average_duration_report") ?></h4>
                        <p class="text-muted m-b-30 font-14"><?php echo get_phrase ("lead_reports") ?> <span class="badge badge-primary"><i class="fa fa-download" style="cursor:pointer" onclick="saveAsPDF('avg_listing_by_duration')"></i></span></p>
                    </div>
                    <div class="col-md-3">
    					<label class="col-form-label"><?php echo get_phrase ("region_list") ?>:</label>
    					<select class="form-control" name="region_id" id="region_id" onchange="avg_listing_by_duration();avg_percentage_listing_off();">
				        <option value="" disabled selected><?php echo get_phrase ("please_select_region") ?></option>
    			        <?php if(!empty($region_list)){foreach($region_list as $data){ ?>
    			        <option value="<?php echo $data['postal_code']; ?>" ><?php echo $data['city'].' '.$data['postal_code']; ?></option>
			            <?php } } ?>
				    </select>
    				</div>
                    <div class="col-md-3">
    					<label class="col-form-label"><?php echo get_phrase ("house_type") ?>:</label>
    					<select name="house_types" id="house_types" class="form-control" onchange="avg_listing_by_duration();avg_percentage_listing_off();"  required>
    					    <option value="" disabled selected><?php echo get_phrase ("please_select_type_of_houses") ?></option>
    					    <?php foreach($house_types as $data){?>  
						    <option value="<?php echo $data['house_types_id']; ?>"><?php echo $data['name']; ?></option>
						    <?php } ?>
    					</select>
    				</div>
    				<div class="col-md-3">
    					<label class="col-form-label"><?php echo get_phrase ("axis") ?>:</label>
    					<select name="axis" id="axis" class="form-control" onchange="avg_listing_by_duration()"  required>
    					    <option value="" disabled selected><?php echo get_phrase ("please_select_Y-axix_value") ?></option>
    					    <option value="Monthly"><?php echo get_phrase ("monthly") ?></option>
    					    <option value="Yearly"><?php echo get_phrase ("yearly") ?></option>
    					</select>
    				</div>
    				
    		    </div>
    		    <div class="row">
    		        <div class="col-md-6">
    		             <div class="card m-b-30">
                            <div class="card-body">
                                 <canvas id="avg_listing_by_duration" height="300"></canvas>
                            </div>
                        </div>
    		        </div>
    		         <div class="col-md-6">
    		             <div class="card m-b-30">
                            <div class="card-body">
                                 <canvas id="avg_listing_by_house_type" height="300"></canvas>
                            </div>
                        </div>
    		        </div>
    		        
    		    </div>
    		   <div class="row">
    		       <div class="col-lg-6">
                        <div class="card m-b-30">
                            <div class="card-body">
                             <h4 class="mt-0 header-title"><?php echo get_phrase ("average_percentage_listing_price_is_off") ?></h4>
                              <canvas id="estimate_is_off"  style="width:100%;max-width:600px"></canvas>
                            </div>
                        </div>
                    </div> 
    		   </div>
            </div>
        </div>
    </div>
</div>


<div class="row">
    <div class="col-lg-12">
        <div class="card m-b-30">
            <div class="card-body">
            <div class="row">
                <div class="col-md-6">
                    <h4 class="mt-0 header-title"><?php echo get_phrase ("lead_reports") ?></h4>
                    <p class="text-muted m-b-30 font-14"><?php echo get_phrase ("region_wise_lead_reports") ?></p>
                </div>
                <div class="col-md-3 text-right">
                    <?php if($role == 1){ ?>
                    <select class="form-control" name="broker_id" onchange="get_employees(this.value)">
				        <option><?php echo get_phrase ("please_select_broker") ?></option>
    			        <?php if(!empty($broker_list)){foreach($broker_list as $data){ ?>
    			        <option value="<?php echo $data['users_system_id']; ?>" ><?php echo $data['first_name'].' '.$data['last_name']; ?></option>
			            <?php } } ?>
				    </select>
				    <?php } ?>
                </div>
                 <?php if($role != 3){ ?>
                <div class="col-md-3 text-right">
                    <select class="form-control" name="employee_id" id="employee_id" onchange="get_regions(this.value)">
				        <option><?php echo get_phrase ("please_select_employee") ?></option>
    			        <?php if(!empty($employee_list)){foreach($employee_list as $data){ ?>
    			        <option value="<?php echo $data['users_system_id']; ?>" ><?php echo $data['first_name'].' '.$data['last_name']; ?></option>
			            <?php } } ?>
				    </select>
                </div>
                <?php } ?>
            </div>
            
            <div id="accordion">
                <?php 
                    if(!empty($distinct_regions)){foreach($distinct_regions as $key=>$data){
                ?>
                <div class="card">
                    <div class="card-header" id="headingOne_<?php echo $key; ?>" style="padding:0px">
                        <h5 class="mb-0 mt-0 font-16">
                            <a data-toggle="collapse" data-parent="#accordion"
                               href="#collapseOne_<?php echo $key; ?>" aria-expanded="false"
                               aria-controls="collapseOne" class="text-dark" onclick="get_customer_data(<?php echo $data['postal_code']; ?>,<?php echo $key; ?>)" style="display: block;padding: 0.75rem 1.25rem;">
                                <?php echo $data['city']; ?> (<?php echo $data['postal_code']; ?>) - <b><?php echo $data['total_leads']; ?> <?php echo get_phrase ("leads") ?></b>
                            </a>
                        </h5>
                    </div>
                    <div id="collapseOne_<?php echo $key; ?>" class="collapse <?php //if($key == 0){ echo 'show'; } ?>"
                    aria-labelledby="headingOne_<?php echo $key; ?>" data-parent="#accordion">
                        <div class="card-body">
                            <div class="row">
                                <div class="table-responsive">
                                    <table class="table table-hover mb-0">
                                        <thead>
                                            <tr>
                                                <th>#</th>
                                                <th><?php echo get_phrase('city'); ?></th>
                                                <th><?php echo get_phrase('name'); ?></th>
                                                <th><?php echo get_phrase ("Est.P") ?>  - <?php echo get_phrase ("Sell.P") ?></th>
                                                <th><?php echo get_phrase ("List.P") ?> - <?php echo get_phrase ("Sell.P") ?></th>
                                                <th><?php echo get_phrase ("duration_(leads_to_customer)") ?></th>
                                            </tr>  
                                        </thead>
                                        <tbody id="tbl_bd_<?php echo $key; ?>">
                                        </tbody>
                                    </table>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
                <?php }} ?>
                </div>
            </div>
        </div>
    </div>
</div>
<div class="row">

    <div class="col-xl-6">
        <div class="card m-b-30">
            <div class="card-body">
                <h4 class="mt-0 m-b-15 header-title"><?php echo get_phrase ("recent_leads") ?></h4>

                <div class="table-responsive">
                    <table class="table table-hover mb-0">
                        <thead>
                        <tr>
                            <th>#</th>
                            <th><?php echo get_phrase ("name") ?></th>
                            <th><?php echo get_phrase ("email") ?></th>
                            <th><?php echo get_phrase ("phone") ?></th>
                            <th><?php echo get_phrase ("created_at") ?></th>
                        </tr>

                        </thead>
                        <tbody>
                        <?php $count=1; if(!empty($leads_data)){ foreach($leads_data as $data){ ?>
                        <tr>
                            <td><?php echo $count++; ?></td>
                            <td>
                                <a href="<?php echo base_url(); ?>admin/view_lead/<?php echo $data['leads_id']; ?>/<?php echo $data['parent_id']; ?>">
                                <?php echo $data['first_name'].' '.$data['last_name']; ?>
                                </a>
                            </td>
                            <td><?php echo $data['email']; ?></td>
                            <td><?php echo $data['phone_number']; ?></td>
                            <td><?php echo set_date_for_display($data['created_at']); ?></td>
                        </tr>
                        <?php } } ?>
                        </tbody>
                    </table>
                </div>

            </div>
        </div>
    </div>
    <div class="col-xl-6">
        <div class="card m-b-30">
            <div class="card-body">
                <h4 class="mt-0 m-b-15 header-title"><?php echo get_phrase ("recent_customers") ?></h4>

                <div class="table-responsive">
                    <table class="table table-hover mb-0">
                        <thead>
                        <tr>
                            <th>#</th>
                            <th><?php echo get_phrase ("name") ?></th>
                            <th><?php echo get_phrase ("email") ?></th>
                            <th><?php echo get_phrase ("phone") ?></th>
                            <th><?php echo get_phrase ("created_At") ?></th>
                        </tr>

                        </thead>
                        <tbody>
                        <?php $count=1; if(!empty($customer_data)){ foreach($customer_data as $data){ ?>
                        <tr>
                            <td><?php echo $count++; ?></td>
                            <td>
                                <a href="<?php echo base_url(); ?>admin/view_lead/<?php echo $data['leads_id']; ?>/<?php echo $data['parent_id']; ?>">
                                <?php echo $data['first_name'].' '.$data['last_name']; ?>
                                </a>
                            </td>
                            <td><?php echo $data['email']; ?></td>
                            <td><?php echo $data['phone_number']; ?></td>
                            <td><?php echo set_date_for_display($data['created_at']); ?></td>
                        </tr>
                        <?php } } ?>
                        </tbody>
                    </table>
                </div>

            </div>
        </div>
    </div>

    <!--div class="col-xl-4">
        <div class="card m-b-30">
            <div class="card-body">
                <h4 class="mt-0 header-title">Monthly Earnings</h4>

                <ul class="list-inline widget-chart m-t-20 text-center">
                    <li>
                        <h4 class=""><b>3654</b></h4>
                        <p class="text-muted m-b-0">Marketplace</p>
                    </li>
                    <li>
                        <h4 class=""><b>954</b></h4>
                        <p class="text-muted m-b-0">Last week</p>
                    </li>
                    <li>
                        <h4 class=""><b>8462</b></h4>
                        <p class="text-muted m-b-0">Last Month</p>
                    </li>
                </ul>

                <div id="morris-donut-example" style="height: 265px"></div>
            </div>
        </div>
    </div-->

</div>