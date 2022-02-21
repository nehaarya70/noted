<?php include 'connection.php';?>
<?php

session_start();
?>

 <?php
 
    if (isset($_GET['del'])) {
        $note_del = mysqli_real_escape_string($conn, $_GET['del']);
        $file_uploader = $_SESSION['username'];
        $del_query = "DELETE FROM uploads WHERE file_id='$note_del'";
        $run_del_query = mysqli_query($conn, $del_query) or die (mysqli_error($conn));
        if (mysqli_affected_rows($conn) > 0) {
			
			
			header("location:usermyupload.php?msg=1");
			
        }
        else {
			header("location:usermyupload.php?msg=2");
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
			
			xmlhttp.open("GET","getusernotes.php?type="+displaynote,true);
			xmlhttp.send();
			
		}
	</script>
    
</head>
<body>
<?php include_once "userheader.html";?>
<?php include_once "useruploadsidebar.html";?>

<?php include_once "socialbar.html"; ?>

	<div class="container">
	
		<div class="col-md-8 offset-2" >
		
			<div class="topic">
				My Notes.
			</div>
			
			
							<div  class="form-group">
									<label class="heading">Show notes</label>
									
										<select class="form-control box text"  onchange="usershownotes()" id="displaynote">
											<option value="all" class="text">All</option>
											<option value="approved" class="text">Approved</option>
											<option value="not approved yet" class="text">Not Approved Yet</option>
										</select>
									
							</div>
			
			
			<div class="text">
				<?php
						if (isset($_REQUEST["msg"])) {
								if ($_REQUEST["msg"] == 1) {
											?>
										<div class="alert alert-success alert-dismissible">
										  <a href="usermyupload.php" class="close" data-dismiss="alert" aria-label="close">&times;</a>
										  <strong>Deleted Successfully!!</strong> 
										</div>
													<?php
											} 
									else if ($_REQUEST["msg"] == 2) {
												?>
												<div class="alert alert-danger alert-dismissible">
												  <a href="usermyupload.php" class="close" data-dismiss="alert" aria-label="close">&times;</a>
												  <strong> Some error Occurred!!</strong>
												</div>
										<?php
											} 
									else if ($_REQUEST["msg"] == 3) {
												?>
										<div class="alert alert-success alert-dismissible">
										  <a href="usermyupload.php" class="close" data-dismiss="alert" aria-label="close">&times;</a>
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
				$query = "SELECT * FROM uploads  WHERE file_uploader= '$user'  ORDER BY file_uploaded_on DESC";
				$run_query = mysqli_query($conn, $query) or die(mysqli_error($conn));
				if (mysqli_num_rows($run_query) > 0) {
				while ($row = mysqli_fetch_array($run_query)) {
					$file_id = $row['file_id'];
					$file_name = $row['file_name'];
					$file_description = $row['file_description'];
					$file_type = $row['file_type'];
					$file_date = $row['file_uploaded_on'];
					$file_uploader = $row['file_uploader'];
					$file_status = $row['status'];
					$file_cat = $row['category'];
					$file = $row['file'];
		
			?>
		
			<div class="note-row">
			<div class="row">
				<div class="col-md-2">
					<span style="float:left; color:brown;"><h5><?php echo $file_cat ?></h5></span>
				</div>
				<div class="col-md-8">
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
			
		</div>
		</div>
	</div>
</body>
</html>