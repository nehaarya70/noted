<?php include 'connection.php';?>
<?php

session_start();
?>
<?php
if (isset($_POST['add'])){
	$about = $_POST['about'];
	$des = $_POST['des'];
	$user = $_SESSION['username'];
	$status = 'not solved yet';
	$query = "INSERT INTO complaints(about,description,user,status) VALUES ('$about' , '$des', '$user', '$status')";
				  $result = mysqli_query($conn , $query) or die(mysqli_error($conn));
				  
				  if (mysqli_affected_rows($conn) > 0) { 
					 header("location:shareproblem.php?msg=0");
		
				}
				else {
					header("location:shareproblem.php?msg=1");
		
				}
}
?>

<html>
<head>
    
	
	<?php include_once "headerfiles.html";?>
	
  
    <meta charset="UTF-8">
	<title>
        Noted. | Issues
    </title>
	<script>
        $(document).ready(function () {
            $('#myform').validate();
            $('#photoform').validate();
		
        });
    </script>
	

    

    
</head>
<body>
<?php include_once "userheader.html";?>
<?php include_once "socialbar.html"; ?>

<div class="container">
	
		<div class="col-md-6 offset-3">
		<div class="topic">
			Share your problem.
				
		</div>
		
			<form id="myform" action="" method="POST" enctype="multipart/form-data">
			
			
							 <div class="form-group" >
							 
									
								<?php
									if (isset($_REQUEST["msg"])) {
										if ($_REQUEST["msg"] == 0) {
											?>
											<div class="alert alert-success alert-dismissible">
												  <a href="shareproblem.php" class="close" data-dismiss="alert" aria-label="close">&times;</a>
												  <strong>Problem shared Successfully!!</strong> 
											</div>
										<?php
										} 
										 
									else {
												?>
												<div class="alert alert-danger alert-dismissible">
													  <a href="shareproblem.php" class="close" data-dismiss="alert" aria-label="close">&times;</a>
													  <strong>Opps some error occured !!</strong> 
												</div>
												<?php
											} 
										}
									?>

									
							</div>
							
							
							<div class="form-group">
								<label class="heading">About</label>
								<input class="form-control box" type="text" name="about" data-rule-required="true"
									   data-msg-required="write about your issue">
							</div>
							
							
							<div class="form-group">
								<label class="heading">Description</label>
								<textarea  class="form-control text" name="des" id="" cols="30" rows="5" data-rule-required="true"
									   data-msg-required="Please elaborate your issue"></textarea>
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
						
						<a href="usershowissues.php">Show all my issues.</span>
							
					</div>
						
		</div>
	</div>

	
</body>
</html>
