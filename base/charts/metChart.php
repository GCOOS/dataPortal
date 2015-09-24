<?php
	// Module: metChart.php
	// Object: create google line chart with observaton counts for each day plotted
	// Return: Void

	// LICENSE: Creative Commons by Attribution 3.0 United States (CC BY 3.0 US)
	//          Details at: http://creativecommons.org/licenses/by/3.0/us/legalcode
?>

<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
	<head>
		<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
		<title>GCOOS Assets: Observations Total</title>
		<script type="text/javascript" src="https://www.google.com/jsapi"></script>
		<script type="text/javascript">
			google.load('visualization', '1.1', {'packages':['annotationchart']});

			google.setOnLoadCallback(drawChart);

			function drawChart(){
				var data = new google.visualization.DataTable();
				data.addColumn('date', 'Date');
				data.addColumn('number', 'Air Pressure');
				data.addColumn('number', 'Air Temperature');
				data.addColumn('number', 'Dew Point');
				data.addColumn('number', 'Dissolved Oxygen');
				data.addColumn('number', 'Relative Humidity');
				data.addColumn('number', 'Solar');
				data.addColumn('number', 'Winds');
				<?php		include_once("config/config.php");
$frontStr = "";
					$sumArr = array("airPressure" => 0, "airTemperature" => 0, "chlorophyll" => 0, "dewPoint" => 0, "dissolvedOxygen" => 0, "oceanCurrents" => 0, "relHumidity" => 0, "salinity" => 0, "solar" => 0, "turbidity" => 0, "waterLevel" => 0, "waterTemperature" => 0, "winds" => 0);
					$first = true;

					$sqlSelect = "SELECT * FROM dataObsCount";

					$frontStr .= "data.addRows([";

					foreach($dbh->query($sqlSelect) as $data){
						$sumArr['airPressure'] = $sumArr['airPressure'] + $data['airPressure'];
						$sumArr['airTemperature'] = $sumArr['airTemperature'] + $data['airTemperature'];
						$sumArr['dewPoint'] = $sumArr['dewPoint'] + $data['dewPoint'];
						$sumArr['dissolvedOxygen'] = $sumArr['dissolvedOxygen'] + $data['dissolvedOxygen'];
						$sumArr['relHumidity'] = $sumArr['relHumidity'] + $data['relHumidity'];
						$sumArr['solar'] = $sumArr['solar'] + $data['solar'];
						$sumArr['winds'] = $sumArr['winds'] + $data['winds'];

						$parsedDateArr = date_parse($data['currentDate']);
						$year = $parsedDateArr['year'];
						$month = $parsedDateArr['month'] - 1;
						$day = $parsedDateArr['day'];
						if($first){
							$frontStr .= "\n[new Date(" . $year . "," . $month . "," . $day . "), " . $sumArr['airPressure'] / 1000 . "," . $sumArr['airTemperature'] / 1000 . ", " . $sumArr['dewPoint'] / 1000 . ", " . $sumArr['dissolvedOxygen'] / 1000 . ", " . $sumArr['relHumidity'] / 1000 . ", " . $sumArr['solar'] / 1000 . ", " . $sumArr['winds'] / 1000 . "]";
							$first = false;
						}
						else{
							$frontStr .= "\n,[new Date(" . $year . "," . $month . "," . $day . "), " . $sumArr['airPressure'] / 1000 . "," . $sumArr['airTemperature'] / 1000 . ", " . $sumArr['dewPoint'] / 1000 . ", " . $sumArr['dissolvedOxygen'] / 1000 . ", " . $sumArr['relHumidity'] / 1000 . ", " . $sumArr['solar'] / 1000 . ", " . $sumArr['winds'] / 1000 . "]";
						}
					}

					$frontStr .= "]);";
					echo $frontStr;
				?>

				var annotatedChart = new google.visualization.AnnotationChart(document.getElementById('visualization'));
				annotatedChart.draw(data, {'displayAnnotations': true, 'legendPosition': 'newRow'});
			}
		</script>
	</head>
	<body>
		<div id="visualization" style="width: 100%; height: 100%;"></div>
	</body>
</html>

