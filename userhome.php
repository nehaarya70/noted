<?php include 'connection.php';?>
<?php

session_start();
?>


<html>
<head>
    
	
	<?php include_once "headerfiles.html";?>
	<?php include_once "userheader.html";?>
	<?php include_once "socialbar.html"; ?>
	
	
	<script>
		function shownotes(){
			
			
            var displaynote = document.getElementById('category').value;
			
			xmlhttp = new XMLHttpRequest();
			xmlhttp.onreadystatechange = function() {
            if (this.readyState == 4 && this.status == 200) {
                document.getElementById("shownotes").innerHTML = this.responseText;
				}
			};
			
			xmlhttp.open("GET","shownotes.php?type="+displaynote,true);
			xmlhttp.send();
			
		}
	</script>

	
    
</head>
<body>
<div class="container">
		
				<div class="topic">
					Welcome to Student Portal.
				</div>
		
	
		<div class="col-md-8">
				
							<div  class="form-group">
									<label class="heading">Show notes from</label>
									
									
									<?php
									if ($_SESSION['course']=="Computer Science"){
										?>
									
										<select class="form-control box text"  name="category" id="category" onchange="shownotes()">
											
											<option value="all" class="text">All</option>
											<option value="Python" class="text">Python</option>
											<option value="Cloud Computing" class="text">Cloud Computing</option>
											<option value="Artificial Inteliigence" class="text">Artificial Inteliigence</option>
										</select>
										
										<?php
									}
									else if($_SESSION['course']=="Electrical"){
										
										?>
										
										
										<select class="form-control box text"  name="category" id="category" onchange="shownotes()">
											<option value="all" class="text">All</option>
											<option value="DCLD" class="text">DCLD</option>
											<option value="HAINA" class="text">HAINA</option>
											<option value="CISCO" class="text">CISCO</option>
										</select>
										
										<?php
									}
									 else if($_SESSION['course']=="Mechaical"){
										 ?>
										 
										<select class="form-control box text"  name="category" id="category" onchange="shownotes()">
											<option value="all" class="text">All</option>
											<option value="TOM" class="text">TOM</option>
											<option value="SOM" class="text">SOM</option>
											<option value="MAT" class="text">MAT</option>
										</select>
										
										<?php
									}
									?>
										 
									
						
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
				$course=$_SESSION['course'];
				$query = "SELECT * FROM uploads  WHERE file_uploaded_to= '$course'  ORDER BY file_uploaded_on DESC";
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
				?>
			
		</div>
		</div>
		
		
		<div class="col-md-3 offset-1">
		<div class="row">
			<a href="shareproblem.php" class="topic-home addlink">Share your problem</a>
		</div>
		<div class="row">
			<a href="usershowissues.php" class="topic-home addlink">My issues</a>
		</div>
				
		</div>
	
	</div>
	
</div>

</body>
</html>