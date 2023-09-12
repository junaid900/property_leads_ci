<?php 
    $details = $this->Db_model->get_single_note($param2,$param1); 
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
                            <th> <?=get_phrase("task")?></th> 
                            <td> <?php echo $details['task']; ?></td>
                        </tr>
                        <tr>
                            <th> <?=get_phrase("description")?></th> 
                            <td> <?php echo $details['description']; ?></td>
                        </tr>
                        <tr>
                            <th> <?=get_phrase("user_name")?></th> 
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
