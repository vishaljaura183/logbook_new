<?php
include('header.php');
use Parse\ParseObject;
use Parse\ParseQuery;
use Parse\ParseUser;


$querylog = new ParseQuery("logBookNewEntry");
 /*$results = $querylog->equalTo("drivingMode","Daytime");
 $results = $querylog->equalTo("supervisor","cathy maree hamilton");
 $results = $querylog->lessThanOrEqualTo("durationOfTrip", 65);*/
 $results = $querylog->find();
 
// print_r($results); die;
?>
			<!-- start: Content -->
			<div id="content" class="span10">
			
			
			<ul class="breadcrumb">
				<li>
					<i class="icon-home"></i>
					<a href="users.php">Home</a> 
					<i class="icon-angle-right"></i>
				</li>
				<li><a href="#">LogBook Entries</a></li>
			</ul>

			<div class="row-fluid sortable">		
				<div class="box span12">
					<div class="box-header" data-original-title>
						<h2><i class="halflings-icon user"></i><span class="break"></span>LogBook Entries</h2>
						<div class="box-icon">
							
							<a href="#" class="btn-minimize"><i class="halflings-icon chevron-up"></i></a>
							<a href="#" class="btn-close"><i class="halflings-icon remove"></i></a>
						</div>
					</div>
					<div class="box-content">
						<table class="table table-striped table-bordered bootstrap-datatable datatable">
						  <thead>
							  <tr>
								  <th>Learner</th>
								  <th>Supervisor</th>
								  <th>Driving Mode</th>
								  <th>Duration Trip</th>
								  <th>Vehicle</th>
								  <th>End Journey Reson</th>
								  <th>Actions</th>
							  </tr>
						  </thead>   
						  <tbody>
						  <?php
						//  print_r($results); die;
						  if(count($results) >0){
  for ($i = 0; $i < count($results); $i++) {
  $object = $results[$i];

 // print_r($object); die;
  ?>
							<tr>
								
								 <td><?php echo $object->get('learner'); ?></td>
								<td><?php echo $object->get('supervisor'); ?></td>
								<td><?php echo $object->get('drivingMode'); ?></td>
								<td><?php echo $object->get('durationOfTrip'); ?></td>
								
								<td class="center">
									<?php echo $object->get('vehicle'); ?>
								</td>
								<td><?php echo $object->get('endJourneyReason'); ?></td>
								<td class="center">
									<a title="Generate Report" class="btn btn-success" target="blank" href="<?php // echo LIVE_SITE;?>pdf/docs/report.php?id=<?php echo $object->getObjectId();?>">
										<i  class="halflings-icon white zoom-in"></i>  
									</a>
									
									
								</td>
							</tr>
							     <?php
}
}
else{
?>
<tr><td>No Result Found!</td></tr>
<?php
}?>                                
							  </tbody>
						 </table>  
						  
					</div>
				</div><!--/span-->
			</div><!--/row-->
    

	</div><!--/.fluid-container-->
	
			<!-- end: Content -->
		</div><!--/#content.span10-->
		</div><!--/fluid-row-->
		
	<div class="modal hide fade" id="myModal">
		<div class="modal-header">
			<button type="button" class="close" data-dismiss="modal">×</button>
			<h3>Settings</h3>
		</div>
		<div class="modal-body">
			<p>Here settings can be configured...</p>
		</div>
		<div class="modal-footer">
			<a href="#" class="btn" data-dismiss="modal">Close</a>
			<a href="#" class="btn btn-primary">Save changes</a>
		</div>
	</div>
	
<?php
include('footer.php');
?>