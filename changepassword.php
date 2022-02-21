<?php include 'connection.php';?>
<?php

session_start();
?>


<?php
if (isset($_SESSION['username'])) {
	$username = $_SESSION['username'];
	$query = "SELECT * FROM users WHERE username = '$username'" ; 
	$result= mysqli_query($conn , $query) or die (mysqli_error($conn));
	if (mysqli_num_rows($result) > 0 ) {
		$row = mysqli_fetch_array($result);
		$userid = $row['id'];
		$userpassword = $row['password'];
	}	
		if (isset($_POST['update'])) {
			
			$current =  $_POST['currentpwd'];
			$new =  $_POST['newpwd'];
			$confirm =  $_POST['confirmpwd'];
			
				
					if (!password_verify($current ,  $userpassword)){
							header("location:changepassword.php?msg=1");
					}
					
					else{
						
							if($new==$confirm){
								$userpassword = password_hash("$new" , PASSWORD_DEFAULT);

								$updatequery = "UPDATE users SET password = '$userpassword' WHERE id='$userid'";
								$result1 = mysqli_query($conn , $updatequery) or die(mysqli_error($conn));
								if (mysqli_affected_rows($conn) > 0) {
										header("location:changepassword.php?msg=0");
									}
								else {
									header("location:changepassword.php?msg=2");
								}
								
							}
							
							else{
								
								header("location:changepassword.php?msg=3");
							}
					}
						
					
		}
			
}	
	
	else{
		
		header("location:home.php");
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
				Change Password.
		</div>
		
		
		<form role="form" id="myform" action="" method="POST" enctype="multipart/form-data">
		
							
			
							 <div class="form-group" >
							 
									
								<?php
									if (isset($_REQUEST["msg"])) {
										if ($_REQUEST["msg"] == 0) {
											?>
											<div class="alert alert-success alert-dismissible">
												  <a href="changepassword.php" class="close" data-dismiss="alert" aria-label="close">&times;</a>
												  <strong>Password changed Successfully!!</strong> 
											</div>
										<?php
										} 
										
									else if ($_REQUEST["msg"] == 1) {
												?>
												<div class="alert alert-danger alert-dismissible">
													  <a href="changepassword.php" class="close" data-dismiss="alert" aria-label="close">&times;</a>
													  <strong>Wrong password entered!!</strong> 
												</div>
											<?php
											} 
									
									else if ($_REQUEST["msg"] == 2) {
												?>
												<div class="alert alert-danger alert-dismissible">
													  <a href="changepassword.php" class="close" data-dismiss="alert" aria-label="close">&times;</a>
													  <strong>Some Server error occured!!</strong> 
												</div>
												<?php
											} 
									else if ($_REQUEST["msg"] == 3) {
												?>
												<div class="alert alert-danger alert-dismissible">
													  <a href="changepassword.php" class="close" data-dismiss="alert" aria-label="close">&times;</a>
													  <strong>New password and confirm password must be same!!</strong> 
												</div>
												<?php
											} 
										}
									?>

									
							</div>
							
							
							<div class="form-group">
								<label class="heading">Current Password</label>
								<input class="form-control box" type="password" name="currentpwd" data-rule-required="true"
									   data-msg-required="Please Enter Current Password">
							</div>
							

							<div class="form-group">
								<label class="heading">New Password </label>
								<input class="form-control box" type="password" name="newpwd" data-rule-required="true"
									   data-msg-required="Please Enter New Password" minlength="6" maxlength="12">
							</div>
							
							
							<div class="form-group">
								<label class="heading">Confirm Password</label>
								<input class="form-control box" type="password" name="confirmpwd" data-rule-required="true"
									   data-msg-required="Please Enter Confirm Password" minlength="6" maxlength="12">
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
</body>
</html>