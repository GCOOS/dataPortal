<?php
	// Module: countObsCurrent.php
	// Object: get the number of observations for the current day (set for 23:45H)
	// Return: Void

	// LICENSE: Creative Commons by Attribution 3.0 United States (CC BY 3.0 US)
	//          Details at: http://creativecommons.org/licenses/by/3.0/us/legalcode
	
	date_default_timezone_set("UTC");
	
	try { 
		include_once("config/config.php");
		$dbh->beginTransaction();

		$currentDate = new DateTime("now");
		$currentDate->setTime(00,00,00);
		$upperCurrentDate = new DateTime("now");
		$upperCurrentDate->setTime(23,59,59);

		$airPressureCount = 0;
		$airTemperatureCount = 0;
		$chlorophyllCount = 0;
		$dewPointCount = 0;
		$dissolvedOxygenCount = 0;
		$oceanCurrentsCount = 0;
		$relHumidityCount = 0;
		$salinityCount = 0;
		$solarCount = 0;
		$turbidityCount = 0;
		$waterLevelCount = 0;
		$waterTemperatureCount = 0;
		$windsCount = 0;

		$sqlSelect = "SELECT COUNT(rowid) as total FROM airPressure WHERE observationDate BETWEEN '" . $currentDate->format("Y-m-d\TH:i:s\Z") . "' AND '" . $upperCurrentDate->format("Y-m-d\TH:i:s\Z") . "'";
		foreach($dbh->query($sqlSelect) as $data)
		{
			$airPressureCount = $data['total'];
		}

		$sqlSelect = "SELECT COUNT(rowid) as total FROM airTemperature WHERE observationDate BETWEEN '" . $currentDate->format("Y-m-d\TH:i:s\Z") . "' AND '" . $upperCurrentDate->format("Y-m-d\TH:i:s\Z") . "'";
		foreach($dbh->query($sqlSelect) as $data)
		{
			$airTemperatureCount = $data['total'];
		}

		$sqlSelect = "SELECT COUNT(rowid) as total FROM chlorophyll WHERE observationDate BETWEEN '" . $currentDate->format("Y-m-d\TH:i:s\Z") . "' AND '" . $upperCurrentDate->format("Y-m-d\TH:i:s\Z") . "'";
		foreach($dbh->query($sqlSelect) as $data)
		{
			$chlorophyllCount = $data['total'];
		}

		$sqlSelect = "SELECT COUNT(rowid) as total FROM dewPoint WHERE observationDate BETWEEN '" . $currentDate->format("Y-m-d\TH:i:s\Z") . "' AND '" . $upperCurrentDate->format("Y-m-d\TH:i:s\Z") . "'";
		foreach($dbh->query($sqlSelect) as $data)
		{
			$dewPointCount = $data['total'];
		}

		$sqlSelect = "SELECT COUNT(rowid) as total FROM dissolvedOxygen WHERE observationDate BETWEEN '" . $currentDate->format("Y-m-d\TH:i:s\Z") . "' AND '" . $upperCurrentDate->format("Y-m-d\TH:i:s\Z") . "'";
		foreach($dbh->query($sqlSelect) as $data)
		{
			$dissolvedOxygenCount = $data['total'];
		}

		$sqlSelect = "SELECT COUNT(rowid) as total FROM oceanCurrents WHERE observationDate BETWEEN '" . $currentDate->format("Y-m-d\TH:i:s\Z") . "' AND '" . $upperCurrentDate->format("Y-m-d\TH:i:s\Z") . "'";
		foreach($dbh->query($sqlSelect) as $data)
		{
			$oceanCurrentsCount = $data['total'];
		}

		$sqlSelect = "SELECT COUNT(rowid) as total FROM relHumidity WHERE observationDate BETWEEN '" . $currentDate->format("Y-m-d\TH:i:s\Z") . "' AND '" . $upperCurrentDate->format("Y-m-d\TH:i:s\Z") . "'";
		foreach($dbh->query($sqlSelect) as $data)
		{
			$relHumidityCount = $data['total'];
		}

		$sqlSelect = "SELECT COUNT(rowid) as total FROM salinity WHERE observationDate BETWEEN '" . $currentDate->format("Y-m-d\TH:i:s\Z") . "' AND '" . $upperCurrentDate->format("Y-m-d\TH:i:s\Z") . "'";
		foreach($dbh->query($sqlSelect) as $data)
		{
			$salinityCount = $data['total'];
		}

		$sqlSelect = "SELECT COUNT(rowid) as total FROM solar WHERE observationDate BETWEEN '" . $currentDate->format("Y-m-d\TH:i:s\Z") . "' AND '" . $upperCurrentDate->format("Y-m-d\TH:i:s\Z") . "'";
		foreach($dbh->query($sqlSelect) as $data)
		{
			$solarCount = $data['total'];
		}

		$sqlSelect = "SELECT COUNT(rowid) as total FROM turbidity WHERE observationDate BETWEEN '" . $currentDate->format("Y-m-d\TH:i:s\Z") . "' AND '" . $upperCurrentDate->format("Y-m-d\TH:i:s\Z") . "'";
		foreach($dbh->query($sqlSelect) as $data)
		{
			$turbidityCount = $data['total'];
		}

		$sqlSelect = "SELECT COUNT(rowid) as total FROM waterLevel WHERE observationDate BETWEEN '" . $currentDate->format("Y-m-d\TH:i:s\Z") . "' AND '" . $upperCurrentDate->format("Y-m-d\TH:i:s\Z") . "'";
		foreach($dbh->query($sqlSelect) as $data)
		{
			$waterLevelCount = $data['total'];
		}

		$sqlSelect = "SELECT COUNT(rowid) as total FROM waterTemperature WHERE observationDate BETWEEN '" . $currentDate->format("Y-m-d\TH:i:s\Z") . "' AND '" . $upperCurrentDate->format("Y-m-d\TH:i:s\Z") . "'";
		foreach($dbh->query($sqlSelect) as $data)
		{
			$waterTemperatureCount = $data['total'];
		}

		$sqlSelect = "SELECT COUNT(rowid) as total FROM winds WHERE observationDate BETWEEN '" . $currentDate->format("Y-m-d\TH:i:s\Z") . "' AND '" . $upperCurrentDate->format("Y-m-d\TH:i:s\Z") . "'";
		foreach($dbh->query($sqlSelect) as $data)
		{
			$windsCount = $data['total'];
		}

		$sqlInsert = "INSERT INTO dataObsCount VALUES ('" . $currentDate->format("Y-m-d\TH:i:s\Z"). "'," . $airPressureCount . "," . $airTemperatureCount . "," . $chlorophyllCount . "," . $dewPointCount . "," . $dissolvedOxygenCount . "," . $oceanCurrentsCount . "," . $relHumidityCount . "," . $salinityCount . "," . $solarCount . "," . $turbidityCount . "," . $waterLevelCount . "," . $waterTemperatureCount . "," . $windsCount . ")"; 
		$dbh->exec($sqlInsert);

		$dbh->commit();
		
	} catch (PDOException $e) {
		$dbh->rollBack();
		echo "Error!" . $e->getMessage() . "<br/>";
		die();
	}

	// terminal messages and actions
	$dbh = null;
	echo '<br/> DONE!' . strtotime('now');	

?>