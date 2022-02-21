<?php include 'connection.php';?>
<?php

session_start();
?>

<?php
if (isset($_GET['delete'])) {
        $the_user_id = mysqli_real_escape_string($conn , $_GET['delete']);
        $query0 = "SELECT role FROM users WHERE id = '$the_user_id'";
        $result = mysqli_query($conn , $query0) or die(mysqli_error($conn));
        if (mysqli_num_rows($result) > 0 ) {
            $row = mysqli_fetch_array($result);
            $id1 = $row['role'];
        }
			if ($id1 == 'admin') {
				header("location:users.php?msg=3");
			}
			else {

			$query = "DELETE FROM users WHERE id = '$the_user_id'";

			$delete_query = mysqli_query($conn, $query) or die (mysqli_error($conn));
				if (mysqli_affected_rows($conn) > 0 ) {
					header("location:users.php?msg=1");
				}
				else {
					 header("location:users.php?msg=2");
				}
		}
}

    ?>



<html>
<head>
    
	<?php include_once "adminheader.html";?>
	<?php include_once "adminusersidebar.html";?>
	
	<?php include_once "headerfiles.html";?>
	
  
    <meta charset="UTF-8">
	<title>
        Noted. | Notes | Students
    </title>
    

    
</head>
<body>

<?php include_once "socialbar.html"; ?>

	<div class="container">
		
		<div class=" col-md-8 offset-2">
		
			<div class="topic">
			Users.
			</div>
			<div class="text">
				<?php
						if (isset($_REQUEST["msg"])) {
								if ($_REQUEST["msg"] == 1) {
											?>
										<div class="alert alert-success alert-dismissible">
										  <a href="users.php" class="close" data-dismiss="alert" aria-label="close">&times;</a>
										  <strong>Deleted Successfully!!</strong> 
										</div>
													<?php
											} 
									else if ($_REQUEST["msg"] == 2) {
												?>
												<div class="alert alert-info alert-dismissible">
												  <a href="users.php" class="close" data-dismiss="alert" aria-label="close">&times;</a>
												  <strong> Some error Occurred!!</strong>
												</div>
										<?php
											} 
									else if ($_REQUEST["msg"] == 3) {
												?>
										<div class="alert alert-danger alert-dismissible">
										  <a href="users.php" class="close" data-dismiss="alert" aria-label="close">&times;</a>
										  <strong>Admin cannot be deleted!!</strong> 
										</div>
										<?php
											} 
										}
									?>
							
			</div>			
			<?php

				$query = "SELECT * FROM users WHERE role = 'student' ORDER BY name ASC ";
				$select_users = mysqli_query($conn, $query) or die(mysqli_error($conn));
				if (mysqli_num_rows($select_users) > 0 ) {
					while ($row = mysqli_fetch_array($select_users)) {
						$user_id = $row['id'];
						$username = $row['username'];
						$name = $row['name'];
						$user_email = $row['email'];
						$user_role = $row['role'];
						$user_course = $row['course'];
						$image = $row['image'];
			
			?>
			
			<div class="note-row">
			
			<div class="row text">
				<div class="col-md-4">
					  <img style="width:40px; height:40px ;background-size:cover" src="profilepics/<?php echo $image; ?>" alt=""
							class="rounded-circle img-responsive">
				
				</div>
				
				<div class="col-md-4">
					<a href='uploaderdata.php?name=<?php echo $username ?>'>
					
					<h1 class="text-capitalize text-info text text-center addlink"><?php echo $name ?></h1>
					</a>
				</div>
				
				<div class="col-md-4 text" >
					<span style="float:right;">
							 <?php echo $user_email ?>
							
					</span>
				</div >
			</div>
			
			
			<div class="row text">
				<div class="col-md-4">
					Username:
					<span class="text-info text"> <?php echo $username ?></span>
				
				</div>
			</div>
			<div class="row text">
				<div class="col-md-6">
					role:
					<span class="text text-info" style="float:center;"><?php echo $user_role ?></span>
				</div>
				<div class="col-md-6" >
					
					<a onClick=\"javascript: return confirm('Are you sure you want to delete this user?')\" href='users.php?delete=<?php echo $user_id ?>' 
					class="btn-danger btn-sm text" style="font-size:15px;float:right;">
						<span class="glyphicon glyphicon-remove"></span> Delete 
					</a>
					
				</div>

			</div>
			
			
		</div>
		<?php
				}
				}
				?>
			
		
		</div>
	
	</div>
</body>
</html>