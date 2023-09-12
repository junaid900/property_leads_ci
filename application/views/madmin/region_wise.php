<div class="row">
    <div class="col-12">
        <div class="card m-b-30">
            <div class="card-body">
              <fieldset style="border: 1px solid #eeeeee;border-top: none;border-radius: 14px;padding: 0.3em 3em 1.5em 3em;margin: 1em 3em;">
                <legend style="color: #0097a7;">Search:-</legend>
                <form action="<?php echo base_url().admin_ctrl(); ?>/region_wise_report/search" method="post">
                    <div class="row">
    					<div class="col-md-6">
    					    <select class="form-control" name="postal_code">
    					        <option>Please select postal code</option>
    				           <?php if(!empty($postal_codes)){foreach($postal_codes as $data){ ?>
    				           <option value="<?php echo $data['postal_code']; ?>" <?php if(!empty($postal_code) && $data['postal_code'] == $postal_code){ echo 'selected'; }?>><?php echo $data['postal_code']; ?></option>
    				           <?php } } ?>
    					    </select>
    					</div>
    					<div class="col-md-3" > 
    					<button class="btn btn-info" type="submit" ><span><i class="fa fa-search mar_right"></i>&nbsp;Search</span></button>
    					<?php if(!empty($param1)){?>
    					<a href="<?php echo base_url().admin_ctrl(); ?>/region_wise_report">&nbsp;<i class="fa fa-refresh" style="color: #4e5467;"></i></a>
    				    <?php } ?>
    					</div>
    				</div>
				</form>
				</fieldset>
                <table id="datatable-buttons" class="table table-striped table-bordered" cellspacing="0" width="100%">
                    <thead>
                    <tr>
                       	<th>#</th>
                       	<th><?php echo get_phrase('city'); ?></th>
    					<th><?php echo get_phrase('name'); ?></th>
    					<th>EP-SP</th>
    					<th>LP-SP</th>
    					<th>Time (lead to customer)</th>
    			    </tr>
                    </thead>
                    <tbody>
                        	<?php 
                        		$count=0; if(!empty($leads_data)){foreach($leads_data as $data): $count++;  
                        		$date1 = new DateTime($data['first_contact']);
                                $date2 = new DateTime($data['type_changed_date']);
                                $interval = $date1->diff($date2);
                                $date='';
						        if($interval->y != 0 ){
						             $date.=  $interval->y . " years,";
						        }
						        if($interval->m !=0){
						            $date.= $interval->m." months,";
						        }
						        if($interval->d !=0){
						            $date.=$interval->d." days";
						        }
        					?>
        					<tr>
        						<td><?php echo $count; ?></td>
        						<td><?php echo $data['city']; ?></td>
        						<td><?php echo $data['first_name'].' '.$data['last_name']; ?></td>
        						<td><?php echo $data['estimate_price'] - $data['listing_price'] ; ?></td>
        						<td><?php echo $data['listing_price'] - $data['sold_price'] ; ?></td>
        						<td>
        						    <?php 
        						        echo  $date; 
        						    ?>
        						</td>
        					</tr>
        					<?php endforeach; }?>
                    </tbody>
                </table>
            </div>
        </div>
    </div> <!-- end col -->
</div> <!-- end row -->
