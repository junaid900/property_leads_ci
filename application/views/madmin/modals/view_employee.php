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
                            <th> <?=get_phrase("email")?></th> 
                            <td> <?php echo $details['email']; ?></td>
                        </tr>
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
                        <tr>
                            <th> <?=get_phrase("status")?></th> 
                            <td> <?php echo $details['status']; ?></td>
                        </tr>
                         <tr>
                            <th> <?=get_phrase("last_logged_in")?></th> 
                            <td> <?php echo date('d/m/Y h:i',strtotime($details['last_logged_time'])); ?> </td>
                        </tr>
                    </tbody>
                </table>
			</div>
        </div>
    </div>
</div> 
