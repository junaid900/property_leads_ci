<!--<div class="row wrapper page-heading">-->
    <!--<div class="col-md-12">-->
        <!--<div class="alert alert-info" style="width:100%">-->
    	  <!--<h2><?= $page_title ?></h2>-->
   
<!--            <br>-->
<!--    	    <div class="row mb_min" role="group" aria-label="Basic example">-->
<!--              <div class="trapezoid active"><span style="font-size: 11px;"><?= $page_title ?></span></div>-->
<!--            </div>-->
    	<!--</div>-->
    	<!--<div class="row col-md-12">-->
     <!--       <span class="page-main-heading" ><?php echo $page_sub_title; ?></span>-->
     <!--       <ol class="page_tree">-->
     <!--           <li class="breadcrumb-item">-->
     <!--               &nbsp;>&nbsp;<a><?= $page_title ?></a>-->
     <!--           </li>-->
     <!--       </ol>-->
     <!--   </div>-->
    <!--</div>-->
<!--</div>-->
<!--Body -->
<!--<div class="wrapper wrapper-content animated fadeInRight">-->
    <div class="row">
        <div class="col-lg-12">
            <div class="card">
                <div class="card-body">
                    <div class="table-responsive">
                        <table id="datatable-leads" class="table table-striped table-bordered" cellspacing="0" width="100%">
                            <thead>
                            <tr>
                                <th>#</th>

                				<th><?php echo get_phrase('language'); ?></th>
                				
                				<th><?php echo get_phrase('action'); ?></th>
                            </tr>
                            </thead>
                            <tbody >
                               	<tr>
    
                    				<td>1</td>
                    
                    				<td>English</td>
                    				
                    				<td>													
                                         <a href="<?php echo base_url().admin_ctrl(); ?>/edit_language/english">
                                           <button class="btn btn-primary"><i class="fa fa-pencil"></i> Edit</button>
                                        </a>
                    				   
                    				</td>
                    
                    			</tr>
                    				<tr>
                    
                    				<td>2</td>
                    
                    				<td>Bilingual</td>
                    				
                    				<td>													
                                       <a href="<?php echo base_url().admin_ctrl(); ?>/edit_language/Bilingual">
                                        <button class="btn btn-primary"><i class="fa fa-pencil"></i> Edit</button>
                                        </a>
                    				   
                    				</td>
                    
                    
                    			</tr>

                             </tbody>
                        </table>
                    </div>
                </div>
            </div>
        </div>
    </div>
<!--</div>-->
<!--Body End-->
