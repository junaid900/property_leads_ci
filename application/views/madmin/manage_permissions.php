
<div class="row">
    <div class="col-12">
        <div class="card m-b-30">
            <div class="card-body">
<?php foreach($previleges as $pre){ ?>
<?php echo form_open('admin/manage_permissions/do_update/'.$pre['permission_id'], 
			array('class' => 'form-horizontal form-groups-bordered validate','target'=>'_top'));?>
						<div class="row">
						<div class="col-sm-12">
							<!-- Basic Form Inputs card start -->
							<div class="card">
								   <div class="card-block">
										<h4 class="sub-title"><b><?php echo $this->db->get_where('users_roles',array('users_roles_id'=>$pre['users_roles_id']))->row()->name;?></b></h4>
											<div class="form-group row">
												<div class="col-sm-12">
												   <div class="card">
													<div class="card-block accordion-block">
														<div id="accordion" >
															<div class="card">
															    <div class="card-header" id="headingOne" style="margin-bottom: 0px;">
                                                                    <h5 class="mb-0 mt-0 font-16">
                                                                        <a data-toggle="collapse" data-parent="#accordion"
                                                                           href="#collapseOne" aria-expanded="false"
                                                                           aria-controls="collapseOne" class="text-dark">
                                                                            Catalog
                                                                        </a>
                                                                    </h5>
                                                                </div>
															
																<div id="collapseOne" class="collapse" aria-labelledby="headingOne" data-parent="#accordion">
																	<div class="card-body">
																		<p>
																		
																		<div class="border-checkbox-section">
																			<div class="border-checkbox-group border-checkbox-group-primary">
																				<input  type="checkbox" class="border-checkbox" id="checkbox5" name="reports"  value="<?php if('Checked') echo '1'; else echo '0'; ?>" <?php if($pre['reports']==1) {echo 'Checked';}?>>
																				<label class="border-checkbox-label" for="checkbox5">reports</label>
																			</div>
																		</div>
																		</p>
																	</div>
																</div>
															</div>
															<div class="card">
														        <div class="card-header" id="headingTwo" style="margin-bottom: 0px;">
                                                                    <h5 class="mb-0 mt-0 font-16">
                                                                        <a class="collapsed text-dark" data-toggle="collapse"
                                                                           data-parent="#accordion" href="#collapseTwo"
                                                                           aria-expanded="true" aria-controls="collapseTwo">
                                                                           System
                                                                        </a>
                                                                    </h5>
                                                                </div>
															
																<div id="collapseTwo" class="collapse show" aria-labelledby="headingTwo" data-parent="#accordion">
																	<div class="card-body">
																		<p>
																		<div class="border-checkbox-section">
																			<div class="border-checkbox-group border-checkbox-group-primary">
																				<input  type="checkbox" class="border-checkbox" id="checkbox12" name="dashboard" value="<?php if('Checked') echo '1'; else echo '0'; ?>" <?php if($pre['dashboard']==1) {echo 'Checked';}?>>
																				<label class="border-checkbox-label" for="checkbox12">Dashboard</label>
																			</div>
																		</div>
																		<!--div class="border-checkbox-section">
																			<div class="border-checkbox-group border-checkbox-group-primary">
																				<input  type="checkbox" class="border-checkbox" id="checkbox13" name="roles" value="<?php if('Checked') echo '1'; else echo '0'; ?>" <?php if($pre['roles']==1) {echo 'Checked';}?> >
																				<label class="border-checkbox-label" for="checkbox13">Roles</label>
																			</div>
																		</div>
																		<div class="border-checkbox-section">
																			<div class="border-checkbox-group border-checkbox-group-primary">
																				<input  type="checkbox" class="border-checkbox" id="checkbox14" name="myprofile" value="<?php if('Checked') echo '1'; else echo '0'; ?>" <?php if($pre['myprofile']==1) {echo 'Checked';}?>>
																				<label class="border-checkbox-label" for="checkbox14">My Profile</label>
																			</div>
																		</div>
																		<div class="border-checkbox-section">
																			<div class="border-checkbox-group border-checkbox-group-primary">
																				<input  type="checkbox" class="border-checkbox" id="checkbox15" name="manage_system" value="<?php if('Checked') echo '1'; else echo '0'; ?>" <?php if($pre['manage_system']==1) {echo 'Checked';}?> >
																				<label class="border-checkbox-label" for="checkbox15">Manage System</label>
																			</div>
																		</div-->
																		
																		
																		<div class="border-checkbox-section">
																			<div class="border-checkbox-group border-checkbox-group-primary">
																				<input  type="checkbox" class="border-checkbox" id="checkbox16" name="manage_leads" value="<?php if('Checked') echo '1'; else echo '0'; ?>" <?php if($pre['manage_leads']==1) {echo 'Checked';}?> >
																				<label class="border-checkbox-label" for="checkbox16">Manage Leads</label>
																			</div>
																		</div>
																		
																		<div class="border-checkbox-section">
																			<div class="border-checkbox-group border-checkbox-group-primary">
																				<input  type="checkbox" class="border-checkbox" id="checkbox22" name="add_lead" value="<?php if('Checked') echo '1'; else echo '0'; ?>" <?php if($pre['add_lead']==1) {echo 'Checked';}?> >
																				<label class="border-checkbox-label" for="checkbox22">Add Leads</label>
																			</div>
																		</div>
																		<div class="border-checkbox-section">
																			<div class="border-checkbox-group border-checkbox-group-primary">
																				<input  type="checkbox" class="border-checkbox" id="checkbox23" name="add_visitor" value="<?php if('Checked') echo '1'; else echo '0'; ?>" <?php if($pre['add_visitor']==1) {echo 'Checked';}?> >
																				<label class="border-checkbox-label" for="checkbox23">Add Visitor</label>
																			</div>
																		</div>
																		<div class="border-checkbox-section">
																			<div class="border-checkbox-group border-checkbox-group-primary">
																				<input  type="checkbox" class="border-checkbox" id="checkbox24" name="view_lead" value="<?php if('Checked') echo '1'; else echo '0'; ?>" <?php if($pre['view_lead']==1) {echo 'Checked';}?> >
																				<label class="border-checkbox-label" for="checkbox24">View Lead</label>
																			</div>
																		</div>
																	
																		
																		
																		<div class="border-checkbox-section">
																			<div class="border-checkbox-group border-checkbox-group-primary">
																				<input  type="checkbox" class="border-checkbox" id="checkbox25" name="edit_lead" value="<?php if('Checked') echo '1'; else echo '0'; ?>" <?php if($pre['edit_lead']==1) {echo 'Checked';}?> >
																				<label class="border-checkbox-label" for="checkbox25">Edit Lead</label>
																			</div>
																		</div>
																		<div class="border-checkbox-section">
																			<div class="border-checkbox-group border-checkbox-group-primary">
																				<input  type="checkbox" class="border-checkbox" id="checkbox26" name="delete_lead" value="<?php if('Checked') echo '1'; else echo '0'; ?>" <?php if($pre['delete_lead']==1) {echo 'Checked';}?> >
																				<label class="border-checkbox-label" for="checkbox26">Delete Leads</label>
																			</div>
																		</div>
																		<div class="border-checkbox-section">
																			<div class="border-checkbox-group border-checkbox-group-primary">
																				<input  type="checkbox" class="border-checkbox" id="checkbox27" name="view_note" value="<?php if('Checked') echo '1'; else echo '0'; ?>" <?php if($pre['view_note']==1) {echo 'Checked';}?> >
																				<label class="border-checkbox-label" for="checkbox27">View Note</label>
																			</div>
																		</div>
																		<div class="border-checkbox-section">
																			<div class="border-checkbox-group border-checkbox-group-primary">
																				<input  type="checkbox" class="border-checkbox" id="checkbox28" name="edit_note" value="<?php if('Checked') echo '1'; else echo '0'; ?>" <?php if($pre['edit_note']==1) {echo 'Checked';}?> >
																				<label class="border-checkbox-label" for="checkbox28">Edit Note</label>
																			</div>
																		</div>
																		<div class="border-checkbox-section">
																			<div class="border-checkbox-group border-checkbox-group-primary">
																				<input  type="checkbox" class="border-checkbox" id="checkbox29" name="delete_note" value="<?php if('Checked') echo '1'; else echo '0'; ?>" <?php if($pre['delete_note']==1) {echo 'Checked';}?> >
																				<label class="border-checkbox-label" for="checkbox29">Delete Note</label>
																			</div>
																		</div>
																		<div class="border-checkbox-section">
																			<div class="border-checkbox-group border-checkbox-group-primary">
																				<input  type="checkbox" class="border-checkbox" id="checkbox30" name="view_visitor" value="<?php if('Checked') echo '1'; else echo '0'; ?>" <?php if($pre['view_visitor']==1) {echo 'Checked';}?> >
																				<label class="border-checkbox-label" for="checkbox30">View Visitor</label>
																			</div>
																		</div>
																		<div class="border-checkbox-section">
																			<div class="border-checkbox-group border-checkbox-group-primary">
																				<input  type="checkbox" class="border-checkbox" id="checkbox31" name="edit_visitor" value="<?php if('Checked') echo '1'; else echo '0'; ?>" <?php if($pre['edit_visitor']==1) {echo 'Checked';}?> >
																				<label class="border-checkbox-label" for="checkbox31">Edit Visitor</label>
																			</div>
																		</div>
																		<div class="border-checkbox-section">
																			<div class="border-checkbox-group border-checkbox-group-primary">
																				<input  type="checkbox" class="border-checkbox" id="checkbox32" name="delete_visitor" value="<?php if('Checked') echo '1'; else echo '0'; ?>" <?php if($pre['delete_visitor']==1) {echo 'Checked';}?> >
																				<label class="border-checkbox-label" for="checkbox32">Delete Visitor</label>
																			</div>
																		</div>
																		
																		
																		
																		
																		
																		<!--div class="border-checkbox-section">
																			<div class="border-checkbox-group border-checkbox-group-primary">
																				<input  type="checkbox" class="border-checkbox" id="checkbox18" name="manage_brokers" value="<?php if('Checked') echo '1'; else echo '0'; ?>" <?php if($pre['manage_brokers']==1) {echo 'Checked';}?> >
																				<label class="border-checkbox-label" for="checkbox18">Manage Brokers</label>
																			</div>
																		</div>
																		<div class="border-checkbox-section">
																			<div class="border-checkbox-group border-checkbox-group-primary">
																				<input  type="checkbox" class="border-checkbox" id="checkbox21" name="manage_employees" value="<?php if('Checked') echo '1'; else echo '0'; ?>" <?php if($pre['manage_employees']==1) {echo 'Checked';}?> >
																				<label class="border-checkbox-label" for="checkbox21">Manage Employees</label>
																			</div>
																		</div>
																		
																		
																		<div class="border-checkbox-section">
																			<div class="border-checkbox-group border-checkbox-group-primary">
																				<input  type="checkbox" class="border-checkbox" id="checkbox19" name="manage_system" value="<?php if('Checked') echo '1'; else echo '0'; ?>" <?php if($pre['email_templates']==1) {echo 'Checked';}?> >
																				<label class="border-checkbox-label" for="checkbox19">Email Templates</label>
																			</div>
																		</div>
																		<div class="border-checkbox-section">
																			<div class="border-checkbox-group border-checkbox-group-primary">
																				<input  type="checkbox" class="border-checkbox" id="checkbox20" name="manage_system" value="<?php if('Checked') echo '1'; else echo '0'; ?>" <?php if($pre['manage_system']==1) {echo 'Checked';}?> >
																				<label class="border-checkbox-label" for="checkbox20">Manage Permissions</label>
																			</div>
																		</div>
																		<div class="border-checkbox-section">
																			<div class="border-checkbox-group border-checkbox-group-primary">
																				<input  type="checkbox" class="border-checkbox" id="checkbox20" name="add_house_types" value="<?php if('Checked') echo '1'; else echo '0'; ?>" <?php if($pre['add_house_types']==1) {echo 'Checked';}?> >
																				<label class="border-checkbox-label" for="checkbox20">Add House Types</label>
																			</div>
																		</div>
																		<div class="border-checkbox-section">
																			<div class="border-checkbox-group border-checkbox-group-primary">
																				<input  type="checkbox" class="border-checkbox" id="checkbox20" name="add_house_types" value="<?php if('Checked') echo '1'; else echo '0'; ?>" <?php if($pre['add_house_types']==1) {echo 'Checked';}?> >
																				<label class="border-checkbox-label" for="checkbox20">Edit House Types</label>
																			</div>
																		</div>
																		<div class="border-checkbox-section">
																			<div class="border-checkbox-group border-checkbox-group-primary">
																				<input  type="checkbox" class="border-checkbox" id="checkbox20" name="delete_house_types" value="<?php if('Checked') echo '1'; else echo '0'; ?>" <?php if($pre['delete_house_types']==1) {echo 'Checked';}?> >
																				<label class="border-checkbox-label" for="checkbox20">Delete House Types</label>
																			</div>
																		</div>
																		<div class="border-checkbox-section">
																			<div class="border-checkbox-group border-checkbox-group-primary">
																				<input  type="checkbox" class="border-checkbox" id="checkbox20" name="add_house_situation" value="<?php if('Checked') echo '1'; else echo '0'; ?>" <?php if($pre['add_house_situation']==1) {echo 'Checked';}?> >
																				<label class="border-checkbox-label" for="checkbox20">Add House Situation</label>
																			</div>
																		</div>
																		<div class="border-checkbox-section">
																			<div class="border-checkbox-group border-checkbox-group-primary">
																				<input  type="checkbox" class="border-checkbox" id="checkbox20" name="edit_house_situation" value="<?php if('Checked') echo '1'; else echo '0'; ?>" <?php if($pre['edit_house_situation']==1) {echo 'Checked';}?> >
																				<label class="border-checkbox-label" for="checkbox20">Edit House Situation</label>
																			</div>
																		</div-->
																		<!--<div class="border-checkbox-section">-->
																		<!--	<div class="border-checkbox-group border-checkbox-group-primary">-->
																		<!--		<input  type="checkbox" class="border-checkbox" id="checkbox20" name="delete_house_situation" value="<?php if('Checked') echo '1'; else echo '0'; ?>" <?php if($pre['delete_house_situation']==1) {echo 'Checked';}?> >-->
																		<!--		<label class="border-checkbox-label" for="checkbox20">Delete House Situation</label>-->
																		<!--	</div>-->
																		<!--</div>-->
																		
																		
																		</p>
																	</div>
																</div>
															</div>
														
															
														</div>
													</div>
												</div>
											</div>
										</div> 
										<!---value="<?php //if('Checked') echo '1'; else echo '0'; ?>" <?php //if($pre['cancelled_bookings']==1) {echo 'Checked';}?>-->
										<div class="row">
											<div class="col-sm-12 text-right">
												<button type="submit" class="btn btn-primary waves-effect waves-light btn_right">Save</button>
											</div>
										</div>
									</div>
								</div>
							</div>
						</div>
				</form>
				<?php } ?>
				</div>
			</div>
		</div>
	</div>
</div>
