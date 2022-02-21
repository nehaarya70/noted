
<?php include 'connection.php';?>
<?php

session_start();
?>


<html>
<head>
    
	<?php include_once "adminheader.html";?>
	
	<?php include_once "headerfiles.html";?>
	
  
    <meta charset="UTF-8">
	

    
</head>
<body>
<?php


if (isset($_GET['image'])) {
			$image = $_FILES['image']['name'];
			$ext = $_FILES['image']['type'];
			$validExt = array ("image/gif",  "image/jpeg",  "image/pjpeg", "image/png");
			if (empty($image)) {
				$picture = $image;
			}
			else if ($_FILES['image']['size'] <= 0 || $_FILES['image']['size'] > 1024000 )
			{
				header("location:uploadpicture.php?msg=3");
			}
			else if (!in_array($ext, $validExt)){
				header("location:uploadpicture.php?msg=4");
			}
			else {
				$folder  = 'profilepics/';
				$imgext = strtolower(pathinfo($image, PATHINFO_EXTENSION) );
				$picture = rand(1000 , 1000000) .'.'.$imgext;
				if (move_uploaded_file($_FILES['image']['tmp_name'], $folder.$picture)) {
					$queryupdate = "UPDATE users SET image = '$picture' WHERE id= '$userid' " ;
					$result = mysqli_query($conn , $queryupdate) or die(mysqli_error($conn));
					if (mysqli_affected_rows($conn) > 0) {
						echo "<script>alert('Profile Photo uploaded successfully');
						window.location.href= 'userprofile.php';</script>";
						header("location:uploadpicture.php?msg=1");
					}
					else {
						header("location:uploadpicture.php?msg=5");
					}
				}
				else {
					header("location:uploadpicture.php?msg=2");
				}
		}
}
else  {
	$picture = $row['image'];
}

?>


<?php
									if (isset($_REQUEST["msg"])) {
										if ($_REQUEST["msg"] == 1) {
											?>
											<div class="alert alert-success text">Photo Updated successfully.!!"</div>
											<?php
										} 
										
									else if ($_REQUEST["msg"] == 2) {
												?>
												<div class="alert alert-danger text">Error occured while uploading.!!"</div>
												<?php
											} 
											
									 else if ($_REQUEST["msg"] == 3) {
												?>
												<div class="alert alert-danger text">Image size is not proper.!!"</div>
												<?php
											} 
									else if ($_REQUEST["msg"] == 4) {
												?>
												<div class="alert alert-danger text">Not a valid Image.!!"</div>
												<?php
											} 
									else if ($_REQUEST["msg"] == 5) {
												?>
												<div class="alert alert-danger text">Oops! Some error occured.!!"</div>
												<?php
											} 
										}
									?>
</body>
</html>