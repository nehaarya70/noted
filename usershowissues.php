<?php include 'connection.php';?>
<?php

session_start();
?>

 <?php
 
    if (isset($_GET['del'])) {
		$id=$_GET['del'];
        $del_query = "DELETE FROM complaints WHERE id='$id'";
        $run_del_query = mysqli_query($conn, $del_query) or die (mysqli_error($conn));
        if (mysqli_affected_rows($conn) > 0) {
			
			
			header("location:usershowissues.php?msg=1");
			
        }
        else {
			header("location:usershowissues.php?msg=2");
         }
        }

        
       

?>


<html>
<head>
    
	
	<?php include_once "headerfiles.html";?>
	
  
    <meta charset="UTF-8">
	<title>
        Noted. | Notes | All
    </title>
    
	
	<script>
		function usershownotes(){
			
			
            var displaynote = document.getElementById('displaynote').value;
			
			xmlhttp = new XMLHttpRequest();
			xmlhttp.onreadystatechange = function() {
            if (this.readyState == 4 && this.status == 200) {
                document.getElementById("shownotes").innerHTML = this.responseText;
				}
			};
			
			xmlhttp.open("GET","getuserissues.php?type="+displaynote,true);
			xmlhttp.send();
			
		}
	</script>
    
</head>
<body>
<?php include_once "userheader.html";?>
<?php include_once "socialbar.html"; ?>

	<div class="container">
	
		<div class="col-md-8 offset-2" >
		
			<div class="topic">
				My Issues.
			</div>
			
			
							<div  class="form-group">
									<label class="heading">Show issues</label>
									
										<select class="form-control box text"  onchange="usershownotes()" id="displaynote">
											<option value="all" class="text">All</option>
											<option value="solved" class="text">Solved</option>
											<option value="not solved yet" class="text">Not Solved Yet</option>
										</select>
									
							</div>
			
			
			<div class="text">
				<?php
						if (isset($_REQUEST["msg"])) {
								if ($_REQUEST["msg"] == 1) {
											?>
										<div class="alert alert-success alert-dismissible">
										  <a href="usershowissues.php" class="close" data-dismiss="alert" aria-label="close">&times;</a>
										  <strong>Deleted Successfully!!</strong> 
										</div>
													<?php
											} 
									else if ($_REQUEST["msg"] == 2) {
												?>
												<div class="alert alert-danger alert-dismissible">
												  <a href="usershowissues.php" class="close" data-dismiss="alert" aria-label="close">&times;</a>
												  <strong> Some error Occurred!!</strong>
												</div>
										<?php
											} 
									else if ($_REQUEST["msg"] == 3) {
												?>
										<div class="alert alert-success alert-dismissible">
										  <a href="usershowissues.php" class="close" data-dismiss="alert" aria-label="close">&times;</a>
										  <strong>Approved Successfully!!</strong> 
										</div>
										<?php
											} 
										}
									?>
							
			</div>		

			<div id="shownotes">
			<?php
				$user=$_SESSION['username'];
				$query = "SELECT * FROM complaints  WHERE user= '$user'  ORDER BY date DESC";
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
			
		</div>
		</div>
	</div>
</body>
</html>