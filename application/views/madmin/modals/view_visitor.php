<?php 
    $details = $this->Db_model->get_single_visitor($param2,$param1); 
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
                            <th> <?=get_phrase("user_name")?></th> 
                            <td> <?php echo $details['first_name'].' '.$details['last_name']; ?></td>
                        </tr>
                        <tr>
                            <th> <?=get_phrase("email")?></th> 
                            <td> <?php echo $details['email']; ?></td>
                        </tr>
                        <tr>
                            <th> <?=get_phrase("address")?></th> 
                            <td> <?php echo $details['address']; ?></td>
                        </tr>
                        <tr>
                            <th> <?=get_phrase("phone_number")?></th> 
                            <td> <?php echo $details['phone_number']; ?></td>
                        </tr>
                        <tr>
                            <th> <?=get_phrase("offered_amount")?></th> 
                            <td> <?php echo $details['offered_amount']; ?></td>
                        </tr>
                         <tr>
                            <th> <?=get_phrase("additional_notes")?></th> 
                            <td> <?php echo $details['additional_notes']; ?></td>
                        </tr>
                        <tr>
                            <th> <?=get_phrase("added_by")?></th> 
                            <td> <?php echo $details['user_name']; ?> <span class="badge badge-info"><?php echo $details['role']; ?></span></td>
                        </tr>
                        <tr>
                            <th> <?=get_phrase("date_time")?></th> 
                            <td> <?php echo $details['created_at']; ?></td>
                        </tr>
                    </tbody>
                </table>
			</div>
        </div>
    </div>
</div> 
