<?php 
    $details = $this->db->get_where('users_system', array('users_system_id'=>$param1))->row_array(); 
 ?>
<div class="row">
	<div class="col-md-12">
		<div class="card m-b-30">
			<h4 class="card-header mt-0"><i class="fa fa-eye"></i> 
			    View 
			</h4> 
			<div class="card-body" style="padding-top: 0px;">
                <table class="table">
                    <tbody>
                        <tr>
                            <th> <?=get_phrase("name")?></th> 
                            <td> <?php echo $details['user_name']; ?></td>
                        </tr>
                        <tr>
                            <th> <?=get_phrase("business_name")?></th> 
                            <td> <?php echo $details['business_name']; ?></td>
                        </tr>
                        <tr>
                            <th> <?=get_phrase("email")?></th> 
                            <td> <?php echo $details['email']; ?></td>
                        </tr>
                        <tr>
                            <th> <?=get_phrase("date_of_birth")?></th> 
                            <td> <?php echo $details['date_of_birth']; ?></td>
                        </tr>
                        <tr>
                            <th> <?=get_phrase("biv_number")?></th> 
                            <td> <?php echo $details['biv_number']; ?></td>
                        </tr>
                        <tr>
                            <th> <?=get_phrase("number_of_time_data_exported")?></th> 
                            <td> <?php echo $details['number_of_time_data_exported']; ?></td>
                        </tr>
                        <tr>
                            <th> <?=get_phrase("maximum_number_leads_allowed")?></th> 
                            <td> <?php echo $details['maximum_number_leads_allowed']; ?></td>
                        </tr>
                        <tr>
                            <th> <?=get_phrase("number_of_employees_allowed")?></th> 
                            <td> <?php echo $details['number_of_employees_allowed']; ?></td>
                        </tr>
                        <!--tr>
                            <th> <?=get_phrase("is_approve")?></th> 
                            <td> <?php echo $details['is_approve']; ?></td>
                        </tr-->
                        <tr>
                            <th> <?=get_phrase("mobile")?></th> 
                            <td> <?php echo $details['mobile']; ?></td>
                        </tr>
                        <tr>
                            <th> <?=get_phrase("city")?></th> 
                            <td> <?php echo $details['city']; ?></td>
                        </tr>
                         <tr>
                            <th> <?=get_phrase("address")?></th> 
                            <td> <?php echo $details['address']; ?></td>
                        </tr>
                        <!--tr>
                            <th> <?=get_phrase("status")?></th> 
                            <td> <?php echo $details['status']; ?></td>
                        </tr>
                         <tr>
                            <th> <?=get_phrase("last_logged_in")?></th> 
                            <td> <?php echo $details['last_logged_time']; ?></td>
                        </tr-->
                    </tbody>
                </table>
			</div>
        </div>
    </div>
</div> 
