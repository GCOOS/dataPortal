<?php
	// Module: lumconChart.php
	// Object: generate data for atm chart
	// Return: Void

	// LICENSE: Creative Commons by Attribution 3.0 United States (CC BY 3.0 US)
	//          Details at: http://creativecommons.org/licenses/by/3.0/us/legalcode
	
	
	
	try {		
		include_once("config/config.php");
		$frontStr = "";
		$sumArr = array("airPressure" => 0, "airTemperature" => 0, "chlorophyll" => 0, "dewPoint" => 0, "dissolvedOxygen" => 0, "oceanCurrents" => 0, "relHumidity" => 0, "salinity" => 0, "solar" => 0, "turbidity" => 0, "waterLevel" => 0, "waterTemperature" => 0, "winds" => 0);
		$first = true;

		$sqlSelect = "SELECT * FROM dataObsCount WHERE organizationId = 4 ORDER BY countDate";

		$frontStr .= "atmData.addRows([";

		foreach($dbh->query($sqlSelect) as $data){
			$sumArr['airPressure'] = $sumArr['airPressure'] + $data['airPressure'];
			$sumArr['airTemperature'] = $sumArr['airTemperature'] + $data['airTemperature'];
			$sumArr['chlorophyll'] = $sumArr['chlorophyll'] + $data['chlorophyll'];
			$sumArr['dewPoint'] = $sumArr['dewPoint'] + $data['dewPoint'];
			$sumArr['dissolvedOxygen'] = $sumArr['dissolvedOxygen'] + $data['dissolvedOxygen'];
			$sumArr['oceanCurrents'] = $sumArr['oceanCurrents'] + $data['oceanCurrents'];
			$sumArr['relHumidity'] = $sumArr['relHumidity'] + $data['relHumidity'];
			$sumArr['salinity'] = $sumArr['salinity'] + $data['salinity'];
			$sumArr['solar'] = $sumArr['solar'] + $data['solar'];
			$sumArr['turbidity'] = $sumArr['turbidity'] + $data['turbidity'];
			$sumArr['waterLevel'] = $sumArr['waterLevel'] + $data['waterLevel'];
			$sumArr['waterTemperature'] = $sumArr['waterTemperature'] + $data['waterTemperature'];
			$sumArr['winds'] = $sumArr['winds'] + $data['winds'];

			$parsedDateArr = date_parse($data['countDate']);
			$year = $parsedDateArr['year'];
			$month = $parsedDateArr['month'] - 1;
			$day = $parsedDateArr['day'];
			if($first){
				$frontStr .= "\n[new Date(" . $year . "," . $month . "," . $day . "), " . $sumArr['airPressure']   . "," . $sumArr['airTemperature']   . ", " . $sumArr['chlorophyll']  . ", " . $sumArr['dewPoint']   . ", " . $sumArr['dissolvedOxygen']   . ", " . $sumArr['oceanCurrents']  . ", " . $sumArr['relHumidity']   . ", " . $sumArr['salinity']  . ", " . $sumArr['solar']   . ", " . $sumArr['turbidity']  . ", " . $sumArr['waterLevel']  . ", " . $sumArr['waterLevel']  . ", " . $sumArr['winds']   . "]";
				$first = false;
			}
			else{
				$frontStr .= "\n,[new Date(" . $year . "," . $month . "," . $day . "), " . $sumArr['airPressure']   . "," . $sumArr['airTemperature']   . ", " . $sumArr['chlorophyll']  . ", " . $sumArr['dewPoint']   . ", " . $sumArr['dissolvedOxygen']   . ", " . $sumArr['oceanCurrents']  . ", " . $sumArr['relHumidity']   . ", " . $sumArr['salinity']  . ", " . $sumArr['solar']   . ", " . $sumArr['turbidity']  . ", " . $sumArr['waterLevel']  . ", " . $sumArr['waterLevel']  . ", " . $sumArr['winds']   . "]";
			}
		}

		$frontStr .= "]);";
		echo $frontStr;

	} 
	catch (PDOException $e) {
		die();
	}

	// terminal messages and actions
	$dbh = null;
?>