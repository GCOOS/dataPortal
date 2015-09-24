<?php
	// Module: dislHtml.php
	// Object: create google line chart with observaton counts for each day plotted
	// Return: Void

	// LICENSE: Creative Commons by Attribution 3.0 United States (CC BY 3.0 US)
	//          Details at: http://creativecommons.org/licenses/by/3.0/us/legalcode
?>

<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
 	<head>
    	<title>Test Script for Charting</title>
		<script type="text/javascript" src="https://www.google.com/jsapi"></script>
    	<script src="//code.jquery.com/jquery-1.9.1.js"></script>
 	 	<script src="//code.jquery.com/ui/1.10.4/jquery-ui.js"></script>
 	 	<script type="text/javascript">
 	 		$(window).resize(function(){
 	 			$('#chartdiv').css("width", "100%");
 	 			$('#chartdiv').css("height", "100%");
 	 			drawChartOnResize();
 	 		});

 	 		var isMobile = {
			    Android: function() {
			        return navigator.userAgent.match(/Android/i);
			    },
			    BlackBerry: function() {
			        return navigator.userAgent.match(/BlackBerry/i);
			    },
			    iOS: function() {
			        return navigator.userAgent.match(/iPhone|iPad|iPod/i);
			    },
			    Opera: function() {
			        return navigator.userAgent.match(/Opera Mini/i);
			    },
			    Windows: function() {
			        return navigator.userAgent.match(/IEMobile/i);
			    },
			    any: function() {
			        return (isMobile.Android() || isMobile.BlackBerry() || isMobile.iOS() || isMobile.Opera() || isMobile.Windows());
			    }
			};

			var atmData;
			var atmAnnotatedChart;

			if(isMobile.any()){
				google.load('visualization', '1.1', {'packages':['annotationchart', 'corechart']});
			}
			else{
				google.load('visualization', '1', {'packages':['annotatedtimeline', 'controls', 'corechart']});
			}

			google.setOnLoadCallback(drawChart);

			function drawChart(){
				 atmData = new google.visualization.DataTable();
				 atmData.addColumn("date", "Date");
				 atmData.addColumn("number", "Air Pressure");
				 atmData.addColumn("number", "Air Temperature");
				 atmData.addColumn("number", "Chlorophyll");
				 atmData.addColumn("number", "Dew Point");
				 atmData.addColumn("number", "Dissolved Oxygen");
				 atmData.addColumn("number", "Currents");
				 atmData.addColumn("number", "Relative Humidity");
				 atmData.addColumn("number", "Salinity");				
				 atmData.addColumn("number", "Solar");
				 atmData.addColumn("number", "Turbidity");
				 atmData.addColumn("number", "Water Level");
				 atmData.addColumn("number", "Water Temperature");
				 atmData.addColumn("number", "Winds");

				<?php
					include_once "dislChart.php";
				?>

				 if(isMobile.any())
				 {
					atmAnnotatedChart = new google.visualization.AnnotationChart(document.getElementById("chartdiv"));
					atmAnnotatedChart.draw(atmData, {displayAnnotations: true, legendPosition: "newRow"});
				 }
				 else
				 {
					atmAnnotatedChart = new google.visualization.AnnotatedTimeLine(document.getElementById("chartdiv"));
				   	atmAnnotatedChart.draw(atmData, {displayAnnotations: true, legendPosition: "newRow", zoomStartTime: new Date(new Date().getFullYear(), 0, 1), zoomEndTime: new Date()});
				 }
			}

			function drawChartOnResize(){
				if(isMobile.any())
				 {
					atmAnnotatedChart.draw(atmData, {displayAnnotations: true, legendPosition: "newRow"});
				 }
				 else
				 {
				   	atmAnnotatedChart.draw(atmData, {displayAnnotations: true, legendPosition: "newRow", zoomStartTime: new Date(new Date().getFullYear(), 0, 1), zoomEndTime: new Date()});
				 }
			}
 	 	</script>
	</head>
	<body>
		<div id="chartdiv" style="width: 100%; height: 100%;"></div>
	</body>
</html>
