<?php include 'connection.php';?>
<?php

session_start();
?>


<?php 
if (isset($_GET['name'])) {
    $user = mysqli_real_escape_string($conn , $_GET['name']);
    $query = "SELECT * FROM users WHERE username= '$user' ";
    $run_query = mysqli_query($conn, $query) or die(mysqli_error($conn)) ;
    if (mysqli_num_rows($run_query) > 0 ) {
    while ($row = mysqli_fetch_array($run_query)) {
	$name = $row['name'];
	$email = $row['email'];
	$course = $row['course'];
	$role = $row['role'];
	$bio = $row['about'];
	$image = $row['image'];
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
	
		<div class="col-md-8 offset-2">
		
			<div class="topic">
				My Profile.
			</div>
			
			<div class="row">
				<img style="width:150px; height:150px ;background-size:cover" src="profilepics/<?php echo $image; ?>" alt=""
				class="rounded-circle mx-auto d-block img-responsive">
			</div>
			
			<div class="row">
				<div class="mx-auto d-block">
					<h1 class="text-info text-capitalize" style="font-family:Enriqueta;"><?php echo $name; ?></h1>
				</div>
			</div>
			
			<div class="row">
				<div class="col-md-6 text-danger text">
					<span style="float:right;">Department:</span>
				</div>
				
				<div class="col-md-6  text">
					<?php echo $course; ?>
				</div>
			</div>
			
			<div class="row">
				<div class="col-md-6 text-danger text">
					<span style="float:right;">Role:</span>
				</div>
				
				<div class="col-md-6  text">
					<?php echo $role; ?>
				</div>
			</div>
			
			<div class="row">
				<div class="col-md-6 text-danger text">
					<span style="float:right;">Gender:</span>
				</div>
				
				<div class="col-md-6  text">
					<?php echo $gender; ?>
				</div>
			</div>
			
			<div class="row">
				<div class="col-md-6 text-danger text">
					<span style="float:right;">Email:</span>
				</div>
				
				<div class="col-md-6  text">
					<?php echo $email; ?>
				</div>
			</div>
			
			<div class="row">
				<div class="col-md-6 text-danger text">
					<span style="float:right;">Join Date:</span>
				</div>
				
				<div class="col-md-6  text">
					<?php echo $joindate; ?>
				</div>
			</div>
			
			<div class="row">
				<div class="col-md-6 text-danger text">
					<span style="float:right;">Bio:</span>
				</div>
				
				<div class="col-md-6  text">
					<?php echo $bio; ?>
				</div>
			</div>
			
		</div>
	</div>
</body>
</html>