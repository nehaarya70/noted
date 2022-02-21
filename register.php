<?php include 'connection.php';?>

<?php

if (isset($_POST['signup']))
{
    $username = $_POST['username'];
	$email = $_POST['email'];
	$password = $_POST['password'];
	$repassword = $_POST['repassword'];
 
	if($password!=$repassword)
	{
		header("location:register.php?msg=1");
	}
    else{
			
			$checkusername = "SELECT * FROM users WHERE username = '$username'";
			$run_check = mysqli_query($conn , $checkusername) or die(mysqli_error($conn));
			$countusername = mysqli_num_rows($run_check); 
			if ($countusername > 0 ) {
				header("location:register.php?msg=2");
			}
			
			$checkemail = "SELECT * FROM users WHERE email = '$email'";
			$run_check = mysqli_query($conn , $checkemail) or die(mysqli_error($conn));
			$countemail = mysqli_num_rows($run_check); 
			if ($countemail > 0 ) {
				header("location:register.php?msg=3");
			}

			else {
				  $name =  $_POST['name'];
				  $email= $_POST['email'];
				  $pass =  $_POST['password'];
				  $password = password_hash("$pass" , PASSWORD_DEFAULT);
				  $role = $_POST['role'];
				  $course = $_POST['course'];
				  $gender = $_POST['gender'];
				  $joindate = date("F j, Y");
				  $query = "INSERT INTO users(username,name,email,password,role,course,gender,joindate,token) VALUES ('$username' , '$name' , '$email', '$password' , '$role', '$course', '$gender' , '$joindate' , '' )";
				  $result = mysqli_query($conn , $query) or die(mysqli_error($conn));
				  
				  if (mysqli_affected_rows($conn) > 0) { 
					 header("location:register.php?msg=4");
		
				}
				else {
					header("location:register.php?msg=5");
		
				}
			}
	}
}
?>





<html>
	<head>
	<?php include_once "headerfiles.html";?>
		<title>
			Noted. | Registration
		</title>
		<script>
        $(document).ready(function () {
            $('#myform').validate();
		
        });
    </script>
		
	<body>
	
	<?php include_once "registertopbar.html"; ?>
	<?php include_once "socialbar.html"; ?>
	
	<div class="container">
		<div class="col-md-6 offset-3">
			<form id="myform" action="register.php" method="POST" enctype="multipart/form-data">
			
							
							 <div class="form-group">
									<?php
									if (isset($_REQUEST["msg"])) {
										if ($_REQUEST["msg"] == 1) {
											?>
											<div class="alert alert-danger text">Password doesn't match.!!"</div>
											<?php
										} 
										
									else if ($_REQUEST["msg"] == 2) {
												?>
												<div class="alert alert-danger text">Username already taken.!!"</div>
												<?php
											} 
											
									 else if ($_REQUEST["msg"] == 3) {
												?>
												<div class="alert alert-danger text">Email already registered.!!"</div>
												<?php
											} 
									else if ($_REQUEST["msg"] == 4) {
												?>
												<div class="alert alert-success text">Congrats! You're successfully registered.!!"</div>
												<?php
											} 
									else if ($_REQUEST["msg"] == 5) {
												?>
												<div class="alert alert-danger text">Oops! Some error occured.!!"</div>
												<?php
											} 
										}
									?>
							</div>
					
							<div class="form-group">
								<label class="heading">Name </label>
								<div class="form-group">
										<div class="radio-inline heading">
												<label><input type="radio" name="gender" value="Male" checked>Mr.</label>
										</div>
										<div class="radio-inline heading">
												<label><input type="radio" name="gender" value="Female">Ms.</label>
										</div>											
													
								</div>
								<input class="form-control box" type="text" name="name" data-rule-required="true"
									   data-msg-required="Please Enter Your Name">
							</div>
								
							<div class="form-group">
								<label class="heading">Email</label>
								<input class="form-control box" type="email" name="email" data-rule-required="true"
									   data-msg-required="Please Enter Your Email">
							</div>
							
							<div class="form-group">
								<label class="heading">Create a Username</label>
								<input class="form-control box" type="text" name="username" data-rule-required="true"
									   data-msg-required="Please Create a Username">
							</div>

							<div class="form-group">
								<label class="heading">Password</label>
								<input class="form-control box" type="password" name="password" data-rule-required="true"
									   data-msg-required="Please Enter Password" minlength="6" maxlength="12">
							</div>
							
							
							<div class="form-group">
								<label class="heading">Confirm Password</label>
								<input class="form-control box" type="password" name="repassword" data-rule-required="true"
									   data-msg-required="Please Enter Password" minlength="6" maxlength="12">
							</div>
							
							
							<div  class="form-group">
									<label class="heading">I am a</label>
									
										<select class="form-control box text"  name="role" id="role">
											<option value="student" class="text">Student</option>
											<option value="teacher" class="text">Teacher</option>
										</select>
									
							</div>
							
							<div  class="form-group">
									<label class="heading">I study/teach</label>
									
										<select class="form-control box text"  name="course" id="course">
											<option value="Computer Science" class="text">Computer Science and Engineering</option>
											<option value="Electrical" class="text">Electrical Engineering</option>
											<option value="Mechanical" class="text">Mechaical Engineering</option>
										</select>
									
							</div>
							<div class="form-group">
								<div class="form-row  text-center">
									<div class="col-12">
										<button type="submit" name="signup" class="btn btn-primary">Sign Me Up</button>
									</div>
								 </div>
							</div>
							
							
							<div class="form-group">
							<label class="btntext">
									Already have an account? <a href="home.php" style="color:blue">Login</a>
							</label>
							</div>
							
							</form>
			
		</div>
	</div>
	
	
	</body>
</html>