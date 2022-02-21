
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
			$query = "SELECT * FROM uploads  WHERE file_uploader= '$user'  ORDER BY file_uploaded_on DESC";
		}
		
		else{
		
			$query = "SELECT * FROM uploads where file_uploader='".$user."' and status='$type' ORDER BY file_uploaded_on DESC ";
		}
				$select_users = mysqli_query($conn, $query) or die(mysqli_error($conn));
				if (mysqli_num_rows($select_users) > 0 ) {
					while ($row = mysqli_fetch_array($select_users)) {
						$file_id = $row['file_id'];
						$file_name = $row['file_name'];
						$file_description = $row['file_description'];
						$file_type = $row['file_type'];
						$file_date = $row['file_uploaded_on'];
						$file_uploader = $row['file_uploader'];
						$file_status = $row['status'];
						$file = $row['file'];
					
					?>	
			<div class="note-row">
			<div class="row">
				<div class="col-md-10">
				<a href='allfiles/<?php echo $file ?>' target='_blank'>
					<h1 class="text-capitalize text-info text text-center addlink"><?php echo $file_name ?></h1>
				</a>
				</div>
				<div class="col-md-2">
					<span style="float:right;"><h5><?php echo $file_type ?></h5></span>
				</div>
			</div>
			<div class="row detail">
				<p class="text-justify"> <?php echo $file_description ?></p>
			</div>
			
			<div class="row">
				<div class="col-md-4">
				<a href='uploaderdata.php?name=<?php echo $file_uploader ?>'>
					<span class="text-success text addlink"> <?php echo $file_uploader ?></span>
				</a>
				</div>
				<div class="col-md-4">
					<span class="text" style="float:center;"><?php echo $file_date ?></span>
				</div>
				<div class="col-md-4" >
					<span class="text-warning text"> <?php echo $file_status ?> </span>
					<a onClick=\"javascript: return confirm('Are you sure you want to delete this post?')\" href='?del=<?php echo $file_id ?>' class="btn-danger btn-sm text" style="font-size:15px;float:right;">
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
