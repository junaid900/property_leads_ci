<style>
    .datepicker{
        z-index:9999;
    }
    #map {
      height: 300px;
    }
    
    #floating-panel {
      position: absolute;
      top: 10px;
      left: 25%;
      z-index: 5;
      background-color: #fff;
      padding: 5px;
      border: 1px solid #999;
      text-align: center;
      font-family: "Roboto", "sans-serif";
      line-height: 30px;
      padding-left: 10px;
    }
    
    #floating-panel {
      background-color: #fff;
      border: 1px solid #999;
      left: 25%;
      padding: 5px;
      position: absolute;
      top: 10px;
      z-index: 5;
    }
</style>
<div class="row">
    <div class="col-12">
        <div class="card m-b-30">
            <div class="card-body">
                <div class="row">
                    <?php if(!empty($number_of_time_data_exported) && $total_exports >=$number_of_time_data_exported){ ?>
					<div class="col-md-12" style="padding: 0em 1em;"> 
				    	<div class="alert alert-danger">
    					  <strong>Info!</strong> Your export limit has been reached.
    					</div>
    				</div>
				    <?php } ?>
                </div>
                <div class="row">
					<div class="col-md-9">
					    <h4 class="text-primary"><i class="mdi mdi-account-box"></i><span class="text-capitalize"><?php echo $param1; ?></span> Detail</h4>
					    <p class="text-info" style="margin-bottom: 0px;"><b><?php echo $broker_data->user_name; ?></b></p>
					    <p class="text-danger" style="margin-bottom: 0px;"><b><?php echo $broker_data->biv_number; ?></b></p>
					    <p class="text-danger"><b><?php echo $broker_data->address; ?></b></p>
					    
					 </div>
					<div class="col-md-3" style="text-align: center;position: relative;left: 39px;padding: 5px;"> 
					<?php if($role == 1){?>
					    <a class="btn btn-sm btn-info" href="javascript:;" onclick="exportPDf()"><span><i class="fa fa-download mar_right"></i>&nbsp;Export PDF</span></a>
					<?php }else{ ?>
					<?php if(!empty($number_of_time_data_exported) && $total_exports <$number_of_time_data_exported){ ?>
					    <a class="btn btn-sm btn-info" href="javascript:;" onclick="exportPDf()"><span><i class="fa fa-download mar_right"></i>&nbsp;Export PDF</span></a>
					<?php } ?>
					<?php } ?>
					</div>
				</div>
                <div class="row">
                     <div class="col-lg-4">
                         <div class="form-group">
                            <label>Filtered By Date</label>
                            <div>
                                <div class="input-daterange input-group" id="date-range">
                                    <input type="text" class="form-control" name="start" id="start" placeholder="Start Date" />
                                    <input type="text" class="form-control" name="end"  id="end" placeholder="End Date" />
                                    <select class="form-control" id="report_type" >
                                        <option value="lead">Listing</option>
                                        <option value="sold">Sold</option>
                                    </select>
                                    &nbsp;<button class="btn btn-info" type="button" onclick="get_stats_by_date()"><span><i class="fa fa-search mar_right"></i></span></button>
                                </div>
                            </div>
                        </div>    
                     </div>
                </div>
                <div class="col-md-12">
                    <div>
                        <h4>Percentage of type of house</h4>
                    </div>
                </div>
                <div class="row" id="round_graphs">
   
    
                </div>
                <div class="row">
                    <div class="col-lg-6">
                        <div class="card m-b-30">
                            <div class="card-body">
                             <h4 class="mt-0 header-title">Amount of <span class="lead_listing">listing</span> per region</h4>
                             <canvas id="bar" height="300"></canvas>
                            </div>
                        </div>
                    </div> 
                    <div class="col-lg-6">
                        <div class="card m-b-30">
                             <div class="card-body">
                                <h4 class="mt-0 header-title">Amount of <span class="lead_listing">listing</span> Per region</h4>
                                <canvas id="doughnut" height="260"></canvas>
                            </div>
                        </div>
                    </div> 
                </div> 
                <div class="row">
                    <div class="col-lg-6">
                        <div class="card m-b-30">
                            <div class="card-body">
                             <h4 class="mt-0 header-title">Amount of <span class="lead_listing">listing</span> per type</h4>
                             <canvas id="listing_per_type" height="300"></canvas>
                            </div>
                        </div>
                    </div> 
                    <div class="col-lg-6">
                        <div class="card m-b-30">
                            <div class="card-body">
                             <h4 class="mt-0 header-title"> Average <span class="lead_listing">listing</span> price per type</h4>
                             <canvas id="avg_selling_per_type" height="300"></canvas>
                            </div>
                        </div>
                    </div> 
                </div> 
                <div class="row">
                     <div class="col-lg-6">
                        <div class="card m-b-30">
                            <div class="card-body">
                             <h4 class="mt-0 header-title">Average <span class="lead_listing">listing</span> per region</h4>
                             <canvas id="avg_selling_per_region" height="300"></canvas>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="row">
                    <div class="col-lg-12">
                        <div class="card m-b-30">
                            <div class="card-body">
                                <div class="row">
                                    <div class="col-md-3">
                                        <h4 class="mt-0 header-title">Average Duration Report</h4>
                                        <p class="text-muted m-b-30 font-14">Lead Report </p>
                                    </div>
                                    <div class="col-md-3">
                    					<label class="col-form-label">Region List:</label>
                    					<select class="form-control" name="region_id" id="region_id" onchange="avg_listing_by_duration();avg_percentage_listing_off();">
                				        <option value="" disabled selected>Please select region</option>
                    			        <?php if(!empty($region_list)){foreach($region_list as $data){ ?>
                    			        <option value="<?php echo $data['postal_code']; ?>" ><?php echo $data['city'].' '.$data['postal_code']; ?></option>
                			            <?php } } ?>
                				    </select>
                    				</div>
                                    <div class="col-md-3">
                    					<label class="col-form-label">House Types:</label>
                    					<select name="house_types" id="house_types" class="form-control" onchange="avg_listing_by_duration();avg_percentage_listing_off();"  required>
                    					    <option value="" disabled selected>Please select type of houses</option>
                    					    <?php foreach($house_types as $data){?>  
                						    <option value="<?php echo $data['house_types_id']; ?>"><?php echo $data['name']; ?></option>
                						    <?php } ?>
                    					</select>
                    				</div>
                    				<div class="col-md-3">
                    					<label class="col-form-label">Axis:</label>
                    					<select name="axis" id="axis" class="form-control" onchange="avg_listing_by_duration()"  required>
                    					    <option value="" disabled selected>Please select Y-Axis value</option>
                    					    <option value="Monthly">Monthly</option>
                    					    <option value="Yearly">Yearly</option>
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
                                             <h4 class="mt-0 header-title">Average Percentage Listing Price is off</h4>
                                              <canvas id="estimate_is_off"  style="width:100%;max-width:600px"></canvas>
                                            </div>
                                        </div>
                                    </div> 
                    		    </div>
                    		    
                    		    <div class="row">
                    		        <div class="col-md-12">
                    		            <!--button onclick="getLatLngByZipcode('66000')">Export map</button-->
                    		            <div id="floating-panel">
                                          <button id="toggle-heatmap">Toggle Heatmap</button>
                                          <button id="change-gradient">Change gradient</button>
                                          <button id="change-radius">Change radius</button>
                                          <button id="change-opacity">Change opacity</button>
                                        </div>
                                        <div id="map"></div>
                    		        </div>
                    		    </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>