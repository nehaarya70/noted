<?php include 'connection.php';?>
<?php

session_start();
?>

 <?php
 

         if (isset($_GET['approve'])) {
        $id=$_GET['approve'];
        $approve_query = "UPDATE complaints SET status='solved' WHERE file_id='$id'";
        $run_approve_query = mysqli_query($conn, $approve_query) or die (mysqli_error($conn));
        if (mysqli_affected_rows($conn) > 0) {
            header("location:complaints.php?msg=3");
        }
        else {
         header("location:complaints.php?msg=2");
        }
        }
       

?>


<html>
<head>
    
	
	<?php include_once "headerfiles.html";?>
	
  
    <meta charset="UTF-8">
	<title>
        Noted. | Complaints
    </title>
    

    
</head>
<body>
<?php include_once "adminheader.html";?>
<?php include_once "admincomplaintsidebar.html";?>

<?php include_once "socialbar.html"; ?>

	<div class="container">
	
		<div class="col-md-8 offset-2">
		
			<div class="topic">
				Solved complaints.
			</div>
			<div class="text">
				<?php
						if (isset($_REQUEST["msg"])) {
								if ($_REQUEST["msg"] == 1) {
											?>
										<div class="alert alert-success alert-dismissible">
										  <a href="complaints.php" class="close" data-dismiss="alert" aria-label="close">&times;</a>
										  <strong>Deleted Successfully!!</strong> 
										</div>
													<?php
											} 
									else if ($_REQUEST["msg"] == 2) {
												?>
												<div class="alert alert-danger alert-dismissible">
												  <a href="complaints.php" class="close" data-dismiss="alert" aria-label="close">&times;</a>
												  <strong> Some error Occurred!!</strong>
												</div>
										<?php
											} 
									else if ($_REQUEST["msg"] == 3) {
												?>
										<div class="alert alert-success alert-dismissible">
										  <a href="complaints.php" class="close" data-dismiss="alert" aria-label="close">&times;</a>
										  <strong>Status changed Successfully!!</strong> 
										</div>
										<?php
											} 
										}
									?>
							
			</div>			
			<?php

				$query = "SELECT * FROM complaints  WHERE status='solved' ORDER BY date DESC";
				$run_query = mysqli_query($conn, $query) or die(mysqli_error($conn));
				if (mysqli_num_rows($run_query) > 0) {
				while ($row = mysqli_fetch_array($run_query)) {
						$id = $row['id'];
						$about = $row['about'];
						$description = $row['description'];
						$date = $row['date'];
						$user = $row['user'];
						$status = $row['status'];
					
		
			?>
		
			<div class="note-row">
			<div class="row">
			<div class="col-md-4 offset-4">
				
					<h1 class="text-capitalize text-info text text-center addlink"><?php echo $about ?></h1>
				
				</div>
				
			</div>
			<div class="row detail">
				<p class="text-justify"> <?php echo $description ?></p>
			</div>
			
			<div class="row">
				
				<div class="col-md-4 offset-4">
					<span class="text" style="float:center;"><?php echo $date ?></span>
				</div>
				
			<div class="col-md-4">
				<span class="text-success text" style="float:right;"> Solved </span>
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