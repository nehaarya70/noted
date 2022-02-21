
<?php include 'connection.php';?>
<?php

session_start();
?>


<html>
<head>
    
	<?php include_once "userheader.html";?>
	
	<?php include_once "headerfiles.html";?>
	
  
    <meta charset="UTF-8">
	

    
</head>
<body>

	<?php
		$user=$_SESSION['username'];
		$type = $_GET['type'];
		if($type=='all')
		{
			$query = "SELECT * FROM complaints  WHERE user= '$user'  ORDER BY date DESC";
		}
		
		else{
		
			$query = "SELECT * FROM complaints where user='".$user."' and status='$type' ORDER BY date DESC ";
		}
				$select_users = mysqli_query($conn, $query) or die(mysqli_error($conn));
				if (mysqli_num_rows($select_users) > 0 ) {
					while ($row = mysqli_fetch_array($select_users)) {
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
				<div class="col-md-4" >
				
					<span class="text-warning text"> <?php echo $status ?> </span>
										
					<a onClick=\"javascript: return confirm('Are you sure you want to delete this post?')\" href='?del=<?php echo $id ?>' class="btn-danger btn-sm text" style="font-size:15px;float:right;">
						<span class="glyphicon glyphicon-remove"></span> Delete 
					</a>
					
				</div>

			</div>
			
			
		</div>
				<?php
				}
				}
			else{
				?>
				
				<div class="col-md-4 offset-4">
				<span class="text" style="align:center;color:rgb(211,211,211);">No results found</span>
				</div>
		<?php
			}
		
	?>
	
		
		
</body>
</html>
