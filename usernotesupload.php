<?php include 'connection.php';?>
<?php

session_start();
?>


<?php

if (isset($_SESSION['id'])) {			
		if (isset($_POST['upload'])) {
					$file_title = $_POST['title'];
					$file_description = $_POST['description'];
					$category = $_POST['category'];

					$file = $_FILES['file']['name'];
					$ext = pathinfo($file, PATHINFO_EXTENSION);
					$validExt = array ('pdf', 'txt', 'doc', 'docx', 'ppt' , 'zip', 'pptx');
					
					if ($_FILES['file']['size'] <= 0 || $_FILES['file']['size'] > 30720000 )
					{
						header("location:usernotesupload.php?msg=3");
					}
					else if (!in_array($ext, $validExt)){
						header("location:usernotesupload.php?msg=4");
					}
					else {
						$file_uploader = $_SESSION['username'];
						$file_uploaded_to = $_SESSION['course'];
						$folder  = 'allfiles/';
						$fileext = strtolower(pathinfo($file, PATHINFO_EXTENSION) );
						$notefile = rand(1000 , 1000000) .'.'.$fileext;
						if (move_uploaded_file($_FILES['file']['tmp_name'], $folder.$notefile)) {
							$query = "INSERT INTO uploads(file_name, file_description, file_type, file_uploader, file_uploaded_to, file, category) VALUES ('$file_title' , '$file_description' , '$fileext' , '$file_uploader' , '$file_uploaded_to' , '$notefile', '$category')";
							$result = mysqli_query($conn , $query) or die(mysqli_error($conn));
							if (mysqli_affected_rows($conn) > 0) {
								header("location:usernotesupload.php?msg=1");
							}
							else {
								
								header("location:usernotesupload.php?msg=5");
							}
						}
						else {
							header("location:usernotesupload.php?msg=2");
						}
				}
		}
}

?>



<html>
<head>
    
	
	<?php include_once "headerfiles.html";?>
	
  
    <meta charset="UTF-8">
	<title>
        Noted. | Note Upload
    </title>
	<script>
        $(document).ready(function () {
            $('#myform').validate();
            
		
        });
    </script>
	

    

    
</head>

<body>
<?php include_once "userheader.html";?>
<?php include_once "socialbar.html"; ?>
<?php include_once "useruploadsidebar.html"; ?>

	<div class="container">
	
		<div class="col-md-6 offset-3">
		<div class="topic">
				Upload a note.
		</div>
		
		
		<form role="form" id="myform" action="" method="POST" enctype="multipart/form-data">
		
							
			
							 <div class="form-group" >
							 
									
								
									
								<?php
									if (isset($_REQUEST["msg"])) {
										if ($_REQUEST["msg"] == 1) {
											?>
											<div class="alert alert-success alert-dismissible">
												  <a href="usernotesupload.php" class="close" data-dismiss="alert" aria-label="close">&times;</a>
												  <strong>Note uploaded Successfully!!</strong> 
											</div>
										<?php
										} 
										
									else if ($_REQUEST["msg"] == 2) {
												?>
												<div class="alert alert-danger alert-dismissible">
													  <a href="usernotesupload.php" class="close" data-dismiss="alert" aria-label="close">&times;</a>
													  <strong>Some error occured while uploading!!</strong> 
												</div>
											<?php
											} 
											
									 else if ($_REQUEST["msg"] == 3) {
												?>
												<div class="alert alert-danger alert-dismissible">
													  <a href="usernotesupload.php" class="close" data-dismiss="alert" aria-label="close">&times;</a>
													  <strong>Document size is not proper!!</strong> 
												</div>
											<?php
											} 
									else if ($_REQUEST["msg"] == 4) {
												?>
												<div class="alert alert-danger alert-dismissible">
													  <a href="usernotesupload.php" class="close" data-dismiss="alert" aria-label="close">&times;</a>
													  <strong>Not a valid document!!</strong> 
												</div>
												<?php
											} 
									else if ($_REQUEST["msg"] == 5) {
												?>
												<div class="alert alert-danger alert-dismissible">
													  <a href="usernotesupload.php" class="close" data-dismiss="alert" aria-label="close">&times;</a>
													  <strong>Opps some error occured !!</strong> 
												</div>
												<?php
											} 
										}
									?>

							</div>
							
							
							<div class="form-group">
								<label class="heading">Title</label>
								<input class="form-control box" type="text" placeholder="Eg: Php Tutorial File" name="title" data-rule-required="true"
									   data-msg-required="Please Enter Title">
							</div>
							
							<div class="form-group">
								<label class="heading">Description</label>
								<textarea  class="form-control text" name="description"  cols="30" rows="5" 
									placeholder="Eg: Php Tutorial File includes basic php programming ...."	data-rule-required="true"
									   data-msg-required="Please write something about the file else write N/A"></textarea>
							</div>
							
							<div class="form-group">
								<label class="heading">Select File</label>
								<label class="text" style="color:brown">
									(allowed file type: 'pdf','doc','ppt','txt','zip','docx','pptx' | allowed maximum size: 30 mb )
								</label>
								<input class="form-control box" type="file" name="file" data-rule-required="true"
									   data-msg-required="Please Select a File" >
							</div>
							
							<div  class="form-group">
									<label class="heading">Category </label>
									
									<?php
									if ($_SESSION['course']=="Computer Science"){
										?>
									
										<select class="form-control box text"  name="category" id="category">
											<option value="Python" class="text">Python</option>
											<option value="Cloud Computing" class="text">Cloud Computing</option>
											<option value="Artificial Inteliigence" class="text">Artificial Inteliigence</option>
										</select>
										
										<?php
									}
									else if($_SESSION['course']=="Electrical"){
										
										?>
										
										
										<select class="form-control box text"  name="category" id="category">
											<option value="DCLD" class="text">DCLD</option>
											<option value="HAINA" class="text">HAINA</option>
											<option value="CISCO" class="text">CISCO</option>
										</select>
										
										<?php
									}
									 else if($_SESSION['course']=="Mechaical"){
										 ?>
										 
										<select class="form-control box text"  name="category" id="category">
											<option value="TOM" class="text">TOM</option>
											<option value="SOM" class="text">SOM</option>
											<option value="MAT" class="text">MAT</option>
										</select>
										
										<?php
									}
									?>
										 
									
							</div>
							
							
							<div class="form-group">
								<div class="form-row  text-center">
									<div class="col-12">
										<button type="submit" name="upload" class="btn btn-primary">Upload</button>
									</div>
								 </div>
							</div>
							
							
		
		</form>
	</div>
	</div>
</body>
</html>