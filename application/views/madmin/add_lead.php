<div class="row">
    <div class="col-lg-12">
        <div class="card m-b-30">
            <div class="card-body">
            	<form method="POST" action="<?php echo base_url().admin_ctrl(); ?>/add_lead/add"  name="add_lead" enctype="multipart/form-data">
    					<div class="row">
    					    <input type="hidden" name="parent_id" value="<?php echo $param1; ?>">
    						<div class="col-md-12">
    						    <div class="row my-2">
        							<div class="col-md-6">
        								<label class="col-form-label">First Name<sup class="text-danger">*</sup>:</label>
        								<input type="text" id="first_name" name="first_name" class="form-control" placeholder="" >
        							</div>
        							<div class="col-md-6">
        								<label class="col-form-label">Last Name<sup class="text-danger">*</sup>:</label>
                                								<input type="text" name="last_name" id="last_name" class="form-control" placeholder=""  >
        							</div>
    							</div>
    							<div class="row my-2">
        							<div class="col-md-6">
        								<label class="col-form-label">Email<sup class="text-danger">*</sup>:</label>
        								<input type="email" name="email" id="email" class="form-control" placeholder=""  >
        							</div>
        							<div class="col-md-6">
        								<label class="col-form-label">Postal Code<sup class="text-danger">*</sup>:</label>
        								<input type="text" name="postal_code" id="code" class="form-control" placeholder=""  >
        							</div>
        						</div>
    							<div class="row my-2">
        						    <div class="col-md-6">
        								<label class="col-form-label">City:</label>
        								<input type="text" name="city" class="form-control" id="city" placeholder="" >
        							</div>
        						    <div class="col-md-6">
        								<label class="col-form-label">Address:</label>
        								<textarea type="text" name="address" class="form-control" id="address" placeholder=""  ></textarea>
        							</div>
        						</div>
    							<div class="row my-2">
        							<div class="col-md-6">
        								<label class="col-form-label">DOB:</label>
        								<div class="input-group">
                                            <input type="text" class="form-control" id="dob" name="dob" placeholder="mm/dd/yyyy" id="datepicker-autoclose">
                                            <div class="input-group-append bg-custom b-0"><span class="input-group-text"><i class="mdi mdi-calendar"></i></span></div>
                                        </div>
        							</div>
        							<div class="col-md-6">
        								<label class="col-form-label">Phone Number:</label>
        								<input type="text" name="phone_number" id="phone" class="form-control" placeholder="" >
        							</div>
        						</div>
        					
        						<div class="row my-2">
        						    <div class="col-md-6">
        								<label class="col-form-label">House Types<sup class="text-danger">*</sup>:</label>
        								<select name="house_types" class="form-control" id="house_type" >
        								    <option value="" disabled selected>Please select type of houses</option>
        								    <?php foreach($house_types as $data){?>  
        								    <option value="<?php echo $data['house_types_id']; ?>"><?php echo $data['name']; ?></option>
        								    <?php } ?>
        								</select>
        							</div>
        							<div class="col-md-6">
        								<label class="col-form-label">Situation of House<sup class="text-danger">*</sup>:</label>
        								<select name="house_situation" class="form-control" id="situation" >
        								    <option value="" disabled selected>Please select type of houses</option>
        								    <?php foreach($house_situation as $data){?>  
        								    <option value="<?php echo $data['house_situation_id']; ?>"><?php echo $data['name']; ?></option>
        								    <?php } ?>
        								</select>
        							</div>
        						</div>
        						<div class="row my-2">
        						   	<div class="col-md-6">
        								<label class="col-form-label">Estimate Price:</label>
        								<input type="text" name="estimate_price" id="est_price" class="form-control" placeholder="" oninput="this.value = this.value.replace(/[^0-9.]/g, '').replace(/(\..*?)\..*/g, '$1');" >
        							</div>
        							<div class="col-md-6">
        								<label class="col-form-label">Listing Price:</label>
        								<input type="text" name="listing_price"  id="lst_price" class="form-control" placeholder="" oninput="this.value = this.value.replace(/[^0-9.]/g, '').replace(/(\..*?)\..*/g, '$1');" >
        							</div>
        						</div>
        						
        						<!--div class="row my-2">
        						   	<div class="col-md-6">
        								<label class="col-form-label">Sold Price:</label>
        								<input type="text" name="sold_price" class="form-control" placeholder="" oninput="this.value = this.value.replace(/[^0-9.]/g, '').replace(/(\..*?)\..*/g, '$1');" >
        							</div>
        							<div class="col-md-6">
        							    <label class="col-form-label">Lead Type:</label><br>
    							       <div class="btn-group btn-group-toggle" data-toggle="buttons">
                                            <label class="btn btn-info active">
                                                <input type="radio" name="lead_type" id="lead" autocomplete="off" value="lead" onchange="revenue_field('lead')" checked> Lead
                                            </label>
                                            <label class="btn btn-info">
                                                <input type="radio" name="lead_type" id="customer" autocomplete="off" value="customer" onchange="revenue_field('customer')"> Customer
                                            </label>
                                        </div>
                                        <input type="text" name="revenue" id="revenue" placeholder="revenue" oninput="this.value = this.value.replace(/[^0-9.]/g, '').replace(/(\..*?)\..*/g, '$1');" style="display:none">
        							</div>
        						</div-->
        						<div class="row">
            						<div class="send_email">
            						    <label style="padding-left:1em"><input type="checkbox" id="check" name="send_email" value="send" ><a href="javascript:;" data-toggle="modal" data-target="#sendEmail" >&nbsp;&nbsp;Send Email</a></label>
            						</div>
        						</div>
        						<!--EMAIL MODEL--->
        						 <div class="modal fade" id="sendEmail">
                                    <div class="modal-dialog modal-lg">
                                        <div class="modal-content">
                                            
                                            <div class="modal-header">
                                                <h4 class="modal-title" id="modal_title" style="margin-top: 0px;"><?php echo system_name(); ?></h4>
                                                <button type="button" class="close" data-dismiss="modal" aria-hidden="true" style="margin: 5px 0px 0px 0px;padding: 0px;">&times;</button>
                                            </div>
                                            
                                            <div class="modal-body" style="height:100%; overflow:auto;padding-top: 0;">
                                            	<br>
                                            	<div class="alert alert-info">
                            					  <strong>Info!</strong> Please use these widgets for  -   user Name: {user_name} , user Email: {user_email} , listing Price : {listing_price}
                            					</div>
                            					<div class="row">
                            						<div class="col-md-12">
                            						    <div class="row ">
                            								<label class="col-sm-2 col-lg-2 col-form-label">Email:</label>
                            								<div class="col-sm-10 col-lg-10">
                            									<input type="text"  class="form-control" placeholder="" value="{user_email}" disabled>
                            								</div>
                            							</div>
                            							<div class="row mtp_hf email_fields">
                            								<label class="col-sm-2 col-lg-2 col-form-label visible_hide" >Email:</label>
                            								<div class="col-sm-8 col-lg-8">
                            									<input type="email" class="form-control"  name="emails[]" placeholder="add more email"  value="" >
                            								</div>
                            								<div class="col-sm-2 col-lg-2 text-right">
                            								    <button type="button" class="btn btn-primary" onclick="clone_input_email()"><i class="fa fa-plus"></i></button>
                            								</div>
                            							</div>
                            							<div id="multiple_users_email">
                            							    
                            							</div>
                            	
                            								<div class="row mtp_hf">
                            								<label class="col-sm-2 col-lg-2 col-form-label">Choose Template:</label>
                            								<div class="col-sm-10 col-lg-10 form-group">
                            									 <select class="form-control" name="names" onchange="getTemplate(this.value)">
                            									     
                                                              <option value="NULL" selected="selected" disable="disabled">Select Email Type</option>
                                                              <?php foreach($request as  $value){ ?>
                                                              <option value="<?php echo $value->email_templates_id;?>"><?php echo $value->type;?></option> 
                                                                <?php } ?>
                                                                         </select>
                                    								</div>
                            							</div>
                            								<div class="row mtp_hf">
                            								<label class="col-sm-2 col-lg-2 col-form-label">Subject:</label>
                            								<div class="col-sm-10 col-lg-10">
                            									<input type="text" name="subject" id="subject" class="form-control" placeholder="" >
                            								</div>
                            							</div>
                            							<div class="form-group row" style="margin-top:2em;">
                            								<label class="col-sm-2 col-form-label">Body:</label>
                            								<div class="col-sm-10">
                            									<textarea  id="body"   rows="2" cols="3" name="body" id="body"  class="form-control summernote"
                            											  placeholder="Address" ></textarea>
                            								</div>
                            							</div>
                                                    </div>
                                                </div>
                                            </div>
                                            <div class="modal-footer" style="padding: 1em 1em;">
                                                <button type="button" class="btn btn-primary waves-effect waves-light btn_right" data-dismiss="modal">Save</button>
                            					<button type="button" class="btn btn-default" data-dismiss="modal">Close</button>
                                            </div>
                                        </div>
                                    </div>
                                </div>
    
    							<div class="row">
    								    
    								<div class="col-sm-12 col-lg-12 text-right">
    								
                                        	<button type="button" onclick="submit_Lead()" id="btn_add_lead" name="btn" class="btn btn-primary waves-effect waves-light btn_right">Submit</button>
    								</div>
    							</div>
    							
    						</div>
    						
    					</div>
    				</form>
            </div>
        </div>
    </div>
</div>
<script>
    function clone_input_email(){
            var div = '';
            var counter = $('.email_fields').length;
        	div+='<div class="row mtp_hf email_fields" id="email_field_'+counter+'">';
			div+='	<label class="col-sm-2 col-lg-2 col-form-label visible_hide" >Email:</label>';
			div+='	<div class="col-sm-8 col-lg-8">';
			div+='		<input type="email" class="form-control"  name="emails[]" placeholder="add more email" value="" >';
			div+='	</div>';
			div+='	<div class="col-sm-2 col-lg-2 text-right">';
			div+='	    <button type="button" class="btn btn-primary" onclick="clone_input_email()"><i class="fa fa-plus"></i></button>';
			div+='	    <button type="button" class="btn btn-danger" onclick="remove_input_email('+counter+')"><i class="fa fa-minus"></i></button>';
			div+='	</div>';
			div+='</div>';
			$('#multiple_users_email').append(div);
    }
    function remove_input_email(param){
        $('#email_field_'+param).remove();
    }
    

</script>