<?php include 'connection.php';?>
<?php

session_start();
?>


<html>
<head>
    
	
	<?php include_once "headerfiles.html";?>
	
  
    <meta charset="UTF-8">
	<title>
        Noted. | Dashboard
    </title>
	
</head>
<body>
<?php include_once "adminheader.html";?>
<?php include_once "admindashboardsidebar.html";?>

<?php include_once "socialbar.html"; ?>

<div class="container">
	<div class="col-md-6">
			<div id="piechart"></div>

			<script type="text/javascript" src="https://www.gstatic.com/charts/loader.js"></script>

			<script type="text/javascript">
			// Load google charts
			google.charts.load('current', {'packages':['corechart']});
			google.charts.setOnLoadCallback(drawChart);

			// Draw the chart and set the chart values
			function drawChart() {
			  var data = google.visualization.arrayToDataTable([
			  ['Task', 'Hours per Day'],
			  ['CSE', 8],
			  ['EE', 2],
			  ['ME', 4],
			  
			]);

			  // Optional; add a title and set the width and height of the chart
			  var options = {'title':'STUDENTS VISULIZATION', 'width':750, 'height':600};

			  // Display the chart inside the <div> element with id="piechart"
			  var chart = new google.visualization.PieChart(document.getElementById('piechart'));
			  chart.draw(data, options);
			}
			</script>
		</div>
		
	<div class="col-md-6">
		
		<div id="piechartnotes"></div>

			
			<script type="text/javascript">
			// Load google charts
			google.charts.load('current', {'packages':['corechart']});
			google.charts.setOnLoadCallback(drawChart);

			// Draw the chart and set the chart values
			function drawChart() {
			  var data = google.visualization.arrayToDataTable([
			  ['Task', 'Hours per Day'],
			  ['CSE', 8],
			  ['EE', 1],
			  ['ME', 1],
			  
			]);

			  // Optional; add a title and set the width and height of the chart
			  var options = {'title':'UPLOADED NOTES VISULIZATION', 'width':750, 'height':600};

			  // Display the chart inside the <div> element with id="piechart"
			  var chart = new google.visualization.PieChart(document.getElementById('piechartnotes'));
			  chart.draw(data, options);
			}
			</script>
	</div>

<h1> hello</h1>

</body>

</html>