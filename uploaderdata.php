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
	$username = $row['username'];
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
        Noted. | User Data
    </title>
    
	<script>
		function showuseruploads(){
			
			
            var user = document.getElementById('user').innerHTML;
			
			xmlhttp = new XMLHttpRequest();
			xmlhttp.onreadystatechange = function() {
            if (this.readyState == 4 && this.status == 200) {
                document.getElementById("uploads").innerHTML = this.responseText;
				}
			};
			
			xmlhttp.open("GET","getuseruploads.php?user="+user,true);
			xmlhttp.send();
			
		}
	</script>
	
    
</head>
<body>
<?php include_once "adminheader.html";?>
<?php include_once "adminusersidebar.html";?>
	
<?php include_once "socialbar.html"; ?>

	<div class="container">
	
		<div class="col-md-8 offset-2">
		
			<div class="topic">
				User Data.
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
					<span style="float:right;" >Username:</span>
				</div>
				
				<div class="col-md-6  text">
					<span id="user"><?php echo $username; ?></span>
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
			
			<div class="row">
				<div class="col-md-6 offset-5 text-info heading addlink">
					<button class="btn btn-info" onclick="showuseruploads()" >see all uploads</button>
				</div>
			</div>
			
			<div id="uploads">
				
			</div>
			
		</div>
	</div>
</body>
</html>