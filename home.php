<?php include 'connection.php';?>

<?php

session_start();
if (isset($_POST['submit']))
{

		$user=$_POST['user'];
		$password=$_POST['password'];
		mysqli_real_escape_string($conn, $user);
		mysqli_real_escape_string($conn, $password);
		
		
		$sql = "SELECT * FROM users WHERE username = '$user';";
		$result = mysqli_query ($conn, $sql) or die ('request "Could not execute SQL query" '.$sql);
		if (mysqli_num_rows($result) > 0) {
			  while ($row = mysqli_fetch_array($result)) {
					$id = $row['id'];
					$username = $row['username'];
					$pass = $row['password'];
					$name = $row['name'];
					$email = $row['email'];
					$role= $row['role'];
					$course = $row['course'];
					$image = $row['image'];
					$about = $row['about'];
					if (password_verify($password, $pass )) {
						  $_SESSION['id'] = $id;
						  $_SESSION['username'] = $username;
						  $_SESSION['name'] = $name;
						  $_SESSION['email']  = $email;
						  $_SESSION['role'] = $role;
						  $_SESSION['course'] = $course;
						  $_SESSION['image'] = $image;
						  $_SESSION['bio'] = $about;
						  
						  if ($_SESSION['role']=='admin'){
						  
								header('location: dashboard.php');
						  }
						  
						  else{
							  
							  header('location: userhome.php');
						  }
					
					
					}
							else{
									header('location:home.php?msg=1');
								
								}
			  }
		}
		else{
			
			header('location:home.php?msg=1');
		}


}
?>


<html>
<head>
    
	
	<?php include_once "headerfiles.html";?>
  
    <meta charset="UTF-8">
	<title>
        Noted. | Home
    </title>
    <script>
        $(document).ready(function () {
            $('#myform').validate();
		
        });
    </script>
    
</head>
<body class="bg">
<?php include_once "hometopbar.html"; ?>

<?php include_once "socialbar.html"; ?>
<div class="container">

    <div class="col-md-5" >
			<div class="middle">
					<form id="myform" action="home.php" method="POST" enctype="multipart/form-data">
							<div class="form-group">
								<label <div class="heading">Username</label>
								<input class="form-control box" type="text" name="user" data-rule-required="true"
									   data-msg-required="Please Enter Your Name">
							</div>


							<div class="form-group">
								<label <div class="heading">Password</label>
								<input class="form-control box" type="password" name="password" data-rule-required="true"
									   data-msg-required="Please Enter Password">
							</div>


							<div class="form-group">
									<div class="form-row  text-center">
									<div class="col-12">
										<button type="submit" name="submit" class="btn btn-primary">Submit</button>
									</div>
								 </div>
							</div>
							
							
							<div class="form-group">
							<label class="btntext">
									Don't have an account? <a href="register.php" style="color:blue">Sign up</a>
							</label>
							</div>
							
							
							 <div class="form-group">
									<?php
									if (isset($_REQUEST["msg"])) {
										if ($_REQUEST["msg"] == 1) {
											?>
											<div class="alert alert-danger text">Invalid username or password!!"</div>
											<?php
										} 
									}
									?>
							</div>
					</form>
				</div>
		</div>

</div>
</body>
</html>