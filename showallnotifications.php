<?php include 'connection.php';?>
<?php

session_start();
?>


<?php
 
    if (isset($_GET['del'])) {
        $id = ($_GET['del']);
        $del_query = "DELETE FROM notifications WHERE id='$id'";
        $run_del_query = mysqli_query($conn, $del_query) or die (mysqli_error($conn));
        if (mysqli_affected_rows($conn) > 0) {
			
			
			header("location:showallnotifications.php?msg=1");
			
        }
        else {
			header("location:showallnotifications.php?msg=2");
         }
    }
?>

<html>
<head>
    
	
	<?php include_once "headerfiles.html";?>
	
  
    <meta charset="UTF-8">
	<title>
        Noted. | Notifications
    </title>
    

    
</head>
<body>
<?php include_once "adminheader.html";?>
<?php include_once "admindashboardsidebar.html";?>

<?php include_once "socialbar.html"; ?>

	<div class="container">
	
		<div class="col-md-8 offset-2">
		
			<div class="topic">
				Notifications
			</div>
			<div class="text">
				
								<?php
									if (isset($_REQUEST["msg"])) {
										if ($_REQUEST["msg"] == 1) {
											?>
											<div class="alert alert-success alert-dismissible">
												  <a href="showallnotifications.php" class="close" data-dismiss="alert" aria-label="close">&times;</a>
												  <strong>Deleted Successfully!!</strong> 
											</div>
										<?php
										} 
										 
									else {
												?>
												<div class="alert alert-danger alert-dismissible">
													  <a href="showallnotifications.php" class="close" data-dismiss="alert" aria-label="close">&times;</a>
													  <strong>Opps some error occured !!</strong> 
												</div>
												<?php
											} 
										}
									?>

							
			</div>		
			
				<?php

				$query = "SELECT * FROM notifications  ORDER BY time DESC";
				$run_query = mysqli_query($conn, $query) or die(mysqli_error($conn));
				if (mysqli_num_rows($run_query) > 0) {
				while ($row = mysqli_fetch_array($run_query)) {
					$id = $row['id'];
					$title = $row['title'];
					$description = $row['description'];
					$time = $row['time'];
					
		
				?>
		
			<div class="notify-row">
				<div class="row">
					<div class="col-md-4 offset-4">
							<h1 class="text-capitalize text-info text  addlink"><?php echo $title ?></h1>
					</div>
				
				</div>
			<div class="row detail">
				<p class="text-justify"> <?php echo $description ?></p>
			</div>
			
			<div class="row">
				
				<div class="col-md-4 offset-4">
					<span class="text" style="float:center;"><?php echo $time ?></span>
				</div>
				
				<div class="col-md-4 ">
					<a href='?del=<?php echo $id ?>' class="btn-danger btn-sm text" style="font-size:15px;float:right;">
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
