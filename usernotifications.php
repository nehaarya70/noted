<?php include 'connection.php';?>
<?php

session_start();
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
<?php include_once "userheader.html";?>

<?php include_once "socialbar.html"; ?>

	<div class="container">
	
		<div class="col-md-8 offset-2">
		
			<div class="topic">
				Notifications
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
