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
		function getallnotes(){
			
				var availableTags=["india","iran"];
				
                $("#note").autocomplete({
					source: availableTags
				});
				
		}
	</script>

	
    
</head>
<body onload="getallnotes()">
<div class="container">
		
				<div class="topic">
					Search Note.
				</div>
		
	
		<div class="col-md-6">
			<div class="form-group">
				<input class="form-control box" type="text" name="note" id="note" data-rule-required="true" placeholder="Search"
									   data-msg-required="Please Enter Your Email" >
			</div>
			
			<div class="form-group">
								<div class="form-row  text-center">
									<div class="col-12">
										<button type="submit" name="update" class="btn btn-primary">Update</button>
									</div>
								 </div>
							</div>
					
			</div>
		
	
	</div>
	
</div>

</body>
</html>