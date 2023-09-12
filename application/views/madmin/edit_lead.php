<div class="row">
    <div class="col-lg-12">
        <div class="card m-b-30">
            <div class="card-body">
            	<form method="POST" action="<?php echo base_url().admin_ctrl(); ?>/edit_lead/edit/<?php echo $param1; ?>"  enctype="multipart/form-data">
    					<div class="row">
    						<div class="col-md-12">
    						    <input type="hidden" name="parent_id" value="<?php echo $param2; ?>">
    						    <input type="hidden" name="redirect" value="<?php echo $param3; ?>">
    						    
    						    <div class="row my-2">
        							<div class="col-md-6">
        								<label class="col-form-label">First Name<sup class="text-danger">*</sup>:</label>
        								<input type="text" name="first_name" class="form-control" placeholder="" value="<?php echo $request->first_name; ?>" required>
        							</div>
        							<div class="col-md-6">
        								<label class="col-form-label">Last Name<sup class="text-danger">*</sup>:</label>
        								<input type="text" name="last_name" class="form-control" placeholder="" value="<?php echo $request->last_name; ?>" required>
        							</div>
    							</div>
    					    	<div class="row my-2">
        							<div class="col-md-6">
        								<label class="col-form-label">Email<sup class="text-danger">*</sup>:</label>
        								<input type="email" name="email" class="form-control" placeholder="" value="<?php echo $request->email; ?>" required>
        							</div>
        							<div class="col-md-6">
        								<label class="col-form-label">Postal Code<sup class="text-danger">*</sup>:</label>
        								<input type="text" name="postal_code" class="form-control" placeholder="" value="<?php echo $request->postal_code; ?>" oninput="this.value = this.value.replace(/[^0-9.]/g, '').replace(/(\..*?)\..*/g, '$1');" required>
        							</div>
        							
    							</div>
    							<div class="row my-2">
        						    <div class="col-md-6">
        								<label class="col-form-label">City<sup class="text-danger"></sup>:</label>
        								<input type="text" name="city" class="form-control" placeholder="" value="<?php echo $request->city; ?>" >
        							</div>
        						    <div class="col-md-6">
        								<label class="col-form-label">Address<sup class="text-danger"></sup>:</label>
        								<textarea type="text" name="address" class="form-control" placeholder=""  ><?php echo $request->address; ?></textarea>
        							</div>
        						</div>
    							<div class="row my-2">
    							    <div class="col-md-6">
        								<label class="col-form-label">Phone Number<sup class="text-danger"></sup>:</label>
        								<input type="text" name="phone_number" class="form-control" placeholder="" value="<?php echo $request->phone_number; ?>" >
        							</div>
        							<div class="col-md-6">
        								<label class="col-form-label">DOB:</label>
        								<div class="input-group">
                                            <input type="text" class="form-control" name="dob" placeholder="mm/dd/yyyy" id="datepicker-autoclose" value="<?php echo date('m/d/Y',strtotime($request->date_of_birth)); ?>">
                                            <div class="input-group-append bg-custom b-0"><span class="input-group-text"><i class="mdi mdi-calendar"></i></span></div>
                                        </div>
        							</div>
        						</div>
        					
        						<div class="row my-2">
        						    <div class="col-md-6">
        								<label class="col-form-label">House Types<sup class="text-danger">*</sup>:</label>
        								<select name="house_types" class="form-control" required>
        								    <option value="" disabled selected>Please select type of houses</option>
        								   
        								    <?php foreach($house_types as $data){?>  
        								    <option value="<?php echo $data['house_types_id']; ?>" <?php if($data['house_types_id'] == $request->house_types_id){ echo 'selected'; } ?>><?php echo $data['name']; ?></option>
        								    <?php } ?>
        								</select>
        							</div>
        							<div class="col-md-6">
        								<label class="col-form-label">Situation of House<sup class="text-danger">*</sup>:</label>
        								<select name="house_situation" class="form-control" required>
        								    <option value="" disabled selected>Please select type of houses</option>
        								    <?php foreach($house_situation as $data){?>  
        								    <option value="<?php echo $data['house_situation_id']; ?>" <?php if($data['house_situation_id'] == $request->house_situation_id){ echo 'selected'; } ?>><?php echo $data['name']; ?></option>
        								    <?php } ?>
        								</select>
        							</div>
        						</div>
        						<div class="row my-2">
        						   	<div class="col-md-6">
        								<label class="col-form-label">Estimate Price<sup class="text-danger">*</sup>:</label>
        								<input type="text" name="estimate_price" class="form-control" placeholder="" value="<?php echo $request->estimate_price; ?>" oninput="this.value = this.value.replace(/[^0-9.]/g, '').replace(/(\..*?)\..*/g, '$1');" >
        							</div>
        							<div class="col-md-6">
        								<label class="col-form-label">Listing Price:</label>
        								<input type="text" name="listing_price" class="form-control" placeholder="" value="<?php echo $request->listing_price; ?>" oninput="this.value = this.value.replace(/[^0-9.]/g, '').replace(/(\..*?)\..*/g, '$1');" >
        							</div>
        						</div>
        						<!--div class="row my-2">
        						   	<div class="col-md-6">
        								<label class="col-form-label">Sold Price:</label>
        								<input type="text" name="sold_price" class="form-control" placeholder="" value="<?php echo $request->sold_price; ?>" oninput="this.value = this.value.replace(/[^0-9.]/g, '').replace(/(\..*?)\..*/g, '$1');" >
        							</div>
        							<div class="col-md-6">
        							    <label class="col-form-label">Lead Type:</label><br>
    							       <div class="btn-group btn-group-toggle" data-toggle="buttons">
                                            <label class="btn btn-info  <?php if($request->lead_type =='lead'){ echo 'active'; } ?>">
                                                <input type="radio" name="lead_type" id="lead" autocomplete="off"  value="lead" onchange="revenue_field('lead')"  <?php if($request->lead_type =='lead'){ echo 'checked'; } ?> > Lead
                                            </label>
                                            <label class="btn btn-info <?php if($request->lead_type =='customer'){ echo 'active'; } ?>">
                                                <input type="radio" name="lead_type" id="customer" autocomplete="off" value="customer" onchange="revenue_field('customer')" <?php if($request->lead_type =='customer'){ echo 'checked'; } ?>> Customer
                                            </label>
                                        </div>
                                        <input type="text" name="revenue" id="revenue" value="<?php echo $request->revenue; ?>" placeholder="revenue" oninput="this.value = this.value.replace(/[^0-9.]/g, '').replace(/(\..*?)\..*/g, '$1');" style="<?php if($request->lead_type == 'lead'){ echo 'display:none'; } ?>">
        							</div>
        						</div-->
    							<div class="row">
    								<div class="col-sm-12 col-lg-12 text-right">
    									<button type="submit" class="btn btn-primary waves-effect waves-light btn_right">Save</button>
    								</div>
    							</div>
    							
    						</div>
    						
    					</div>
    				</form>
            </div>
        </div>
    </div>
</div>