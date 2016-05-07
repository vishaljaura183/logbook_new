<?php
include('header.php');
$sql="SELECT * FROM admin WHERE usertype='2'";
$result=mysqli_query($db,$sql);


?>
			<!-- start: Content -->
			<div id="content" class="span10">
			
			
			<ul class="breadcrumb">
				<li>
					<i class="icon-home"></i>
					<a href="index.php">Home</a> 
					<i class="icon-angle-right"></i>
				</li>
				<li><a href="#">Officers</a></li>
			</ul>
			<a href="add_officers.php">Add Officer</a>
			<div class="row-fluid sortable">		
				<div class="box span12">
					<div class="box-header" data-original-title>
						<h2><i class="halflings-icon user"></i><span class="break"></span>Officers</h2>
						<div class="box-icon">
							
							<a href="#" class="btn-minimize"><i class="halflings-icon chevron-up"></i></a>
							<a href="#" class="btn-close"><i class="halflings-icon remove"></i></a>
						</div>
					</div>
					<div class="box-content">
						<table class="table table-striped table-bordered bootstrap-datatable datatable">
						  <thead>
							  <tr>
								  <th>Name</th>
								  <th>Username</th>
								  <th>Email</th>
								  <th>Created At</th>
								  <th>Actions</th>
							  </tr>
						  </thead>   
						  <tbody>
						  <?php
  while($results_users=mysqli_fetch_array($result,MYSQLI_ASSOC)){ 
   $object = $results_users;
	$id = $object['id'];
  ?>
							<tr id="tr_<?php echo $id; ?>">
								<td><?php echo $object['name'];?></td>
								 <td><?php echo $object['username']; ?></td>
								<td><?php echo $object['email']; ?></td>
								<td class="center">
									<?php echo $object['created_at']; ?>
								</td>
								<td class="center">
									<a class="btn btn-success" title="Edit Profile" href="profile_officer.php?id=<?php echo $id;?>">
										<i class="halflings-icon white zoom-in"></i>  
									</a>
									
									<a class="btn btn-danger" title="Delete" href="javascript:void(0);" onclick="del_officer('<?php echo $id; ?>')">
										<i class="halflings-icon white trash"></i> 
									</a>
								</td>
							</tr>
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
	<script>
	function del_officer(id){
	var url  = "<?php echo LIVE_SITE; ?>/process/delete_officer.php";
	var confirmm = confirm("Are you sure to delete?");
	//var r = confirm("Press a button!");
	if(confirmm == true){
	
	$.ajax({
	url: url,
	method: "POST",
	data: { del_id : id },
	dataType: "html",
	success: function(data){
	if(data =='success'){
		$("tr#tr_"+id).remove();
	}
	}
	});
	}
}
	</script>
<?php
include('footer.php');
?>