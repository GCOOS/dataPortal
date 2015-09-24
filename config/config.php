<?php
	//declare variables; path to DB
	$db = "<data source path>";	
	// setup PDO if preferred	
	$dbh = new PDO("sqlite:".$db);
	// set PDO attributes
	$dbh->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
?>