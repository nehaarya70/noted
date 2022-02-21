<?php include 'connection.php';?>
<?php

session_start();
?>


<?php 
if (isset($_SESSION['username'])) {
    $user = mysqli_real_escape_string($conn , $_SESSION['username']);
    $query = "SELECT * FROM users WHERE username= '$user' ";
    $run_query = mysqli_query($conn, $query) or die(mysqli_error($conn)) ;
    if (mysqli_num_rows($run_query) > 0 ) {
		while ($row = mysqli_fetch_array($run_query)) {
		$userid=$row['id'];
		$name = $row['name'];
		$username = $row['username'];
		$email = $row['email'];
		$course = $row['course'];
		$role = $row['role'];
		$bio = $row['about'];
		$userimage = $row['image'];
		$joindate = $row['joindate'];
		$gender = $row['gender'];
			}
		}
	else {
		$name = "N/A";
		$email = "N/A";
		$course = "N/A";
		$role = "N/A";
		$bio = "N/A";
		$image = "profile.jpg";
		$gender = "N/A";
		$joindate = "N/A";
	}
	
		
		if (isset($_POST['uploadphoto'])) {
					
					$image = $_FILES['image']['name'];
					$ext = $_FILES['image']['type'];
					$validExt = array ("image/gif",  "image/jpeg",  "image/pjpeg", "image/png");
					if (empty($image)) {
						$picture = $userimage;
					}
					else if ($_FILES['image']['size'] <= 0 || $_FILES['image']['size'] > 1024000 )
					{
						header("location:editprofile.php?msg=3");
					}
					else if (!in_array($ext, $validExt)){
						header("location:editprofile.php?msg=4");
					}
					else {
						$folder  = 'profilepics/';
						$imgext = strtolower(pathinfo($image, PATHINFO_EXTENSION) );
						$picture = rand(1000 , 1000000) .'.'.$imgext;
						if (move_uploaded_file($_FILES['image']['tmp_name'], $folder.$picture)) {
							$queryupdate = "UPDATE users SET image = '$picture' WHERE id= '$userid' " ;
							$result = mysqli_query($conn , $queryupdate) or die(mysqli_error($conn));
							if (mysqli_affected_rows($conn) > 0) {
								header("location:editprofile.php");
							}
							else {
								
								header("location:editprofile.php?msg=5");
							}
						}
						else {
							header("location:editprofile.php?msg=2");
						}
				}
		}
		else  {
			$picture = $row['image'];
		}
		
		
		
		if (isset($_POST['update'])) {
						$name =  $_POST['name'];
						 $email= $_POST['email'];
						 $bio= $_POST['bio'];
						 $query =  "UPDATE users SET email = '$email', name='$name', about= '$bio' WHERE id='$userid'";
						$result = mysqli_query($conn , $query) or die(mysqli_error($conn));
						  
						  if (mysqli_affected_rows($conn) > 0) { 
							header("location:editprofile.php");
			
				
						}
						else {
							header("location:register.php?msg=5");
				
						}
						
					}
		
} 

else {
    header("location:dashboard.php");
    }
	
?>



<html>
<head>
    
	
	<?php include_once "headerfiles.html";?>
	
  
    <meta charset="UTF-8">
	<title>
        Noted. | Admin Data
    </title>
	<script>
        $(document).ready(function () {
            $('#myform').validate();
            $('#photoform').validate();
		
        });
    </script>
	

    

    
</head>

<body>
<?php
	if($_SESSION['role']=='admin')
	{
		 include_once "adminheader.html";
	}
	else{
		 include_once "userheader.html";
	}
?>
<?php include_once "admindatasidebar.html";?>
<?php include_once "socialbar.html"; ?>

	<div class="container">
	
		<div class="col-md-6 offset-3">
		<div class="topic">
				Edit Profile.
		</div>
		
		<form role="form" id="photoform" action="" method="POST" enctype="multipart/form-data">

			<div class="form-group">
				<img style="width:200px; height:200px ;background-size:cover" src="profilepics/<?php echo $userimage; ?>" alt=""
				class="rounded-circle mx-auto d-block img-responsive">
				
				<input class="mx-auto d-block" type="file" name="image" data-rule-required="true"
                       data-msg-required="Please Select a Picture">
					   
				<button type="submit" name="uploadphoto" class="btn btn-primary mx-auto d-block" >upload photo</button>
			</div>
		</form>

			
		
			<form id="myform" action="editprofile.php" method="POST" enctype="multipart/form-data">
			
			
							 <div class="form-group" >
							 
									
								<?php
									if (isset($_REQUEST["msg"])) {
										if ($_REQUEST["msg"] == 1) {
											?>
											<div class="alert alert-success alert-dismissible">
												  <a href="editprofile.php" class="close" data-dismiss="alert" aria-label="close">&times;</a>
												  <strong>Data updated Successfully!!</strong> 
											</div>
										<?php
										} 
										
									else if ($_REQUEST["msg"] == 2) {
												?>
												<div class="alert alert-danger alert-dismissible">
													  <a href="editprofile.php" class="close" data-dismiss="alert" aria-label="close">&times;</a>
													  <strong>Some error occured while uploading!!</strong> 
												</div>
											<?php
											} 
											
									 else if ($_REQUEST["msg"] == 3) {
												?>
												<div class="alert alert-danger alert-dismissible">
													  <a href="editprofile.php" class="close" data-dismiss="alert" aria-label="close">&times;</a>
													  <strong>Image size is not proper!!</strong> 
												</div>
											<?php
											} 
									else if ($_REQUEST["msg"] == 4) {
												?>
												<div class="alert alert-danger alert-dismissible">
													  <a href="editprofile.php" class="close" data-dismiss="alert" aria-label="close">&times;</a>
													  <strong>Not a valid image!!</strong> 
												</div>
												<?php
											} 
									else if ($_REQUEST["msg"] == 5) {
												?>
												<div class="alert alert-danger alert-dismissible">
													  <a href="editprofile.php" class="close" data-dismiss="alert" aria-label="close">&times;</a>
													  <strong>Opps some error occured !!</strong> 
												</div>
												<?php
											} 
										}
									?>

									
							</div>
							
							
							<div class="form-group">
								<label class="heading">Username </label>
								
								<input class="form-control box" type="text" name="username" data-rule-required="true"
									   data-msg-required="Please Enter Your Name" value=" <?php echo $username; ?>" readonly>
							</div>
								
							<div class="form-group">
								<label class="heading">Email</label>
								<input class="form-control box" type="email" name="email" data-rule-required="true"
									   data-msg-required="Please Enter Your Email" value=" <?php echo $email ?>" readonly>
							</div>
							
							<div class="form-group">
								<label class="heading">Name</label>
								<input class="form-control box" type="text" name="name" data-rule-required="true"
									   data-msg-required="Please add your name" value=" <?php echo $name; ?>">
							</div>
							
							
							<div class="form-group">
								<label class="heading">Bio</label>
								<textarea  class="form-control text" name="bio" id="" cols="30" rows="5" data-rule-required="true"
									   data-msg-required="Please write something about yourself else write N/A"><?php  echo $bio;  ?></textarea>
							</div>
													
							<div class="form-group">
								<div class="form-row  text-center">
									<div class="col-12">
										<button type="submit" name="update" class="btn btn-primary">Update</button>
									</div>
								 </div>
							</div>
					
					</form>
			
		</div>
	</div>

		</div>
	</div>
	
</body>
</html>