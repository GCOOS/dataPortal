<?php
	// Module: countObsRecoveryAll.php
	// Object: recover number of counts for a single day if the counter failed to 
	// execute the day before
	// Return: Void

	// LICENSE: Creative Commons by Attribution 3.0 United States (CC BY 3.0 US)
	//          Details at: http://creativecommons.org/licenses/by/3.0/us/legalcode
	
	date_default_timezone_set("UTC");

	try { 
		include_once("config/config.php");
		$dbh->beginTransaction();

		if(isset($_GET["recover_date"])) { 
			$setDate = $_GET['recover_date'];
			//$setDate = '2015-09-22';
		} else {
			break;
		}
		
		$currentDate = new DateTime($setDate);
		$sqlSelect = "SELECT * FROM organization";
		$sqlDelete = "DELETE FROM dataObsCount WHERE countDate = '" . $setDate . "'";
		$dbh->exec($sqlDelete);

		foreach($dbh->query($sqlSelect) as $org){	
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
			$waveCount = 0;
			$windsCount = 0;
			
			$airPressureSelect = "SELECT COUNT(*) AS currentCount, date(observationDate) AS formDate FROM airPressure a JOIN sensor s ON (a.sensorId = s.rowid) JOIN platform p ON (s.platformId = p.rowid) JOIN organization o ON (p.organizationId = o.rowid) WHERE o.rowid = " . $org['rowid'] . " AND formDate = '" . $currentDate->format("Y-m-d") . "'";
			foreach($dbh->query($airPressureSelect) as $ap){
				$airPressureCount = $ap['currentCount'];
			}

			$airTemperatureSelect = "SELECT COUNT(*) AS currentCount, date(observationDate) AS formDate  FROM airTemperature at JOIN sensor s ON (at.sensorId = s.rowid) JOIN platform p ON (s.platformId = p.rowid) JOIN organization o ON (p.organizationId = o.rowid) WHERE o.rowid = " . $org['rowid'] . " AND formDate = '" . $currentDate->format("Y-m-d") . "'";
			foreach($dbh->query($airTemperatureSelect) as $at){
				$airTemperatureCount = $at['currentCount'];
			}

			$chlorophyllSelect = "SELECT COUNT(*) AS currentCount, date(observationDate) AS formDate  FROM chlorophyll chl JOIN sensor s ON (chl.sensorId = s.rowid) JOIN platform p ON (s.platformId = p.rowid) JOIN organization o ON (p.organizationId = o.rowid) WHERE o.rowid = " . $org['rowid'] . " AND formDate = '" . $currentDate->format("Y-m-d") . "'";
			foreach($dbh->query($chlorophyllSelect) as $chl){
				$chlorophyllCount = $chl['currentCount'];
			}

			$dewPointSelect = "SELECT COUNT(*) AS currentCount, date(observationDate) AS formDate  FROM dewPoint dp JOIN sensor s ON (dp.sensorId = s.rowid) JOIN platform p ON (s.platformId = p.rowid) JOIN organization o ON (p.organizationId = o.rowid) WHERE o.rowid = " . $org['rowid'] . " AND formDate = '" . $currentDate->format("Y-m-d") . "'";
			foreach($dbh->query($dewPointSelect) as $dp){
				$dewPointCount = $dp['currentCount'];
			}

			$dissolvedOxygenSelect = "SELECT COUNT(*) AS currentCount, date(observationDate) AS formDate  FROM dissolvedOxygen do JOIN sensor s ON (do.sensorId = s.rowid) JOIN platform p ON (s.platformId = p.rowid) JOIN organization o ON (p.organizationId = o.rowid) WHERE o.rowid = " . $org['rowid'] . " AND formDate = '" . $currentDate->format("Y-m-d") . "'";
			foreach($dbh->query($dissolvedOxygenSelect) as $do){
				$dissolvedOxygenCount = $do['currentCount'];
			}

			$oceanCurrentsSelect = "SELECT COUNT(*) AS currentCount, date(observationDate) AS formDate  FROM oceanCurrents oc JOIN sensor s ON (oc.sensorId = s.rowid) JOIN platform p ON (s.platformId = p.rowid) JOIN organization o ON (p.organizationId = o.rowid) WHERE o.rowid = " . $org['rowid'] . " AND formDate = '" . $currentDate->format("Y-m-d") . "'";
			foreach($dbh->query($oceanCurrentsSelect) as $oc){
				$oceanCurrentsCount = $oc['currentCount'];
			}

			$relHumiditySelect = "SELECT COUNT(*) AS currentCount, date(observationDate) AS formDate  FROM relHumidity rel JOIN sensor s ON (rel.sensorId = s.rowid) JOIN platform p ON (s.platformId = p.rowid) JOIN organization o ON (p.organizationId = o.rowid) WHERE o.rowid = " . $org['rowid'] . " AND formDate = '" . $currentDate->format("Y-m-d") . "'";
			foreach($dbh->query($relHumiditySelect) as $rel){
				$relHumidityCount = $rel['currentCount'];
			}			

			$salinitySelect = "SELECT COUNT(*) AS currentCount, date(observationDate) AS formDate  FROM salinity sal JOIN sensor s ON (sal.sensorId = s.rowid) JOIN platform p ON (s.platformId = p.rowid) JOIN organization o ON (p.organizationId = o.rowid) WHERE o.rowid = " . $org['rowid'] . " AND formDate = '" . $currentDate->format("Y-m-d") . "'";
			foreach($dbh->query($salinitySelect) as $sal){
				$salinityCount = $sal['currentCount'];
			}

			$solarSelect = "SELECT COUNT(*) AS currentCount, date(observationDate) AS formDate  FROM solar sol JOIN sensor s ON (sol.sensorId = s.rowid) JOIN platform p ON (s.platformId = p.rowid) JOIN organization o ON (p.organizationId = o.rowid) WHERE o.rowid = " . $org['rowid'] . " AND formDate = '" . $currentDate->format("Y-m-d") . "'";
			foreach($dbh->query($solarSelect) as $sol){
				$solarCount = $sol['currentCount'];
			}

			$turbiditySelect = "SELECT COUNT(*) AS currentCount, date(observationDate) AS formDate  FROM turbidity tur JOIN sensor s ON (tur.sensorId = s.rowid) JOIN platform p ON (s.platformId = p.rowid) JOIN organization o ON (p.organizationId = o.rowid) WHERE o.rowid = " . $org['rowid'] . " AND formDate = '" . $currentDate->format("Y-m-d") . "'";
			foreach($dbh->query($turbiditySelect) as $tur){
				$turbidityCount = $tur['currentCount'];
			}

			$waterLevelSelect = "SELECT COUNT(*) AS currentCount, date(observationDate) AS formDate  FROM waterLevel wl JOIN sensor s ON (wl.sensorId = s.rowid) JOIN platform p ON (s.platformId = p.rowid) JOIN organization o ON (p.organizationId = o.rowid) WHERE o.rowid = " . $org['rowid'] . " AND formDate = '" . $currentDate->format("Y-m-d") . "'";
			foreach($dbh->query($waterLevelSelect) as $wl){
				$waterLevelCount = $wl['currentCount'];
			}

			$waterTemperatureSelect = "SELECT COUNT(*) AS currentCount, date(observationDate) AS formDate  FROM waterTemperature wt JOIN sensor s ON (wt.sensorId = s.rowid) JOIN platform p ON (s.platformId = p.rowid) JOIN organization o ON (p.organizationId = o.rowid) WHERE o.rowid = " . $org['rowid'] . " AND formDate = '" . $currentDate->format("Y-m-d") . "'";
			foreach($dbh->query($waterTemperatureSelect) as $wt){
				$waterTemperatureCount = $wt['currentCount'];
			}

			$windsSelect = "SELECT COUNT(*) AS currentCount, date(observationDate) AS formDate  FROM winds win JOIN sensor s ON (win.sensorId = s.rowid) JOIN platform p ON (s.platformId = p.rowid) JOIN organization o ON (p.organizationId = o.rowid) WHERE o.rowid = " . $org['rowid'] . " AND formDate = '" . $currentDate->format("Y-m-d") . "'";
			foreach($dbh->query($windsSelect) as $win){
				$windsCount = $win['currentCount'];
			}
			$waveSelect = "SELECT COUNT(*) AS currentCount, date(observationDate) AS formDate  FROM wave wa JOIN sensor s ON (wa.sensorId = s.rowid) JOIN platform p ON (s.platformId = p.rowid) JOIN organization o ON (p.organizationId = o.rowid) WHERE o.rowid = " . $org['rowid'] . " AND formDate = '" . $currentDate->format("Y-m-d") . "'";
			foreach($dbh->query($waveSelect) as $wa){
				$waveCount = $wa['currentCount'];
			}

			$sqlInsert = "INSERT INTO dataObsCount VALUES ('" . $currentDate->format("Y-m-d") . "', " . $org['rowid'] . ", " . $airPressureCount . ", " . $airTemperatureCount . ", " . $chlorophyllCount . ", " . $dewPointCount . ", " . $dissolvedOxygenCount . ", " . $oceanCurrentsCount . ", " . $relHumidityCount . ", " . $salinityCount . ", " . $solarCount . ", " . $turbidityCount . ", " . $waterLevelCount . ", " . $waterTemperatureCount . ", " . $windsCount . ", " . $waveCount. ")";
			echo $sqlInsert . "\n";
			$dbh->exec($sqlInsert);
		}

		$dbh->commit();
		
	} catch (PDOException $e) {
		$dbh->rollBack();
		echo "Error!" . $e->getMessage() . "<br/>";
		die();
	}

	// terminal messages and actions
	$dbh = null;
	echo '<br/> DONE! \n';	

?>
