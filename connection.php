<?php

	$conn = mysqli_connect("localhost","root","","notes");
    
	if(!$conn){  
	echo "<script type='text/javascript'>alert('Database failed');</script>";
  	die('Could not connect: '.mysqli_connect_error());  
}
?>