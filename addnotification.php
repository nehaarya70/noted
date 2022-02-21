<?php include 'connection.php';?>
<?php

session_start();
?>

<?php
if (isset($_POST['add'])){
	$title = $_POST['title'];
	$des = $_POST['des'];
	$query = "INSERT INTO notifications(title,description) VALUES ('$title' , '$des')";
				  $result = mysqli_query($conn , $query) or die(mysqli_error($conn));
				  
				  if (mysqli_affected_rows($conn) > 0) { 
					 header("location:addnotification.php?msg=0");
		
				}
				else {
					header("location:addnotification.php?msg=1");
		
				}
}
?>

<html>
<head>
    
	
	<?php include_once "headerfiles.html";?>
	
  
    <meta charset="UTF-8">
	<title>
        Noted. | Notification
    </title>
	<script>
        $(document).ready(function () {
            $('#myform').validate();
            $('#photoform').validate();
		
        });
    </script>
	

    

    
</head>
<body>
<?php include_once "adminheader.html";?>
<?php include_once "admindashboardsidebar.html";?>
<?php include_once "socialbar.html"; ?>

<div class="container">
	
		<div class="col-md-6 offset-3">
		<div class="topic">
			Add a notification.
				
		</div>
		
			<form id="myform" action="" method="POST" enctype="multipart/form-data">
			
			
							 <div class="form-group" >
							 
									
								<?php
									if (isset($_REQUEST["msg"])) {
										if ($_REQUEST["msg"] == 0) {
											?>
											<div class="alert alert-success alert-dismissible">
												  <a href="addnotification.php" class="close" data-dismiss="alert" aria-label="close">&times;</a>
												  <strong>Notification updated Successfully!!</strong> 
											</div>
										<?php
										} 
										 
									else {
												?>
												<div class="alert alert-danger alert-dismissible">
													  <a href="addnotification.php" class="close" data-dismiss="alert" aria-label="close">&times;</a>
													  <strong>Opps some error occured !!</strong> 
												</div>
												<?php
											} 
										}
									?>

									
							</div>
							
							
							<div class="form-group">
								<label class="heading">Title</label>
								<input class="form-control box" type="text" name="title" data-rule-required="true"
									   data-msg-required="Please add title">
							</div>
							
							
							<div class="form-group">
								<label class="heading">Description</label>
								<textarea  class="form-control text" name="des" id="" cols="30" rows="5" data-rule-required="true"
									   data-msg-required="Please write something about notification "></textarea>
							</div>
													
							<div class="form-group">
								<div class="form-row  text-center">
									<div class="col-12">
										<button type="submit" name="add" class="btn btn-primary">Add</button>
									</div>
								 </div>
							</div>
					
					</form>
					
					<div class=" text addlink" >
						
						<a href="showallnotifications.php">Show all notifications.</span>
							
					</div>
						
		</div>
	</div>

	
</body>
</html>
