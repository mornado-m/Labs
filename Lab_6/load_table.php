<?php	
	include_once("connect_db.php");
	session_start();
	
	$name = $_POST["table_name"];
	$count = $_POST["field_count"];
	$table = "<table class='table'>";

	$headers = mysql_query("SELECT COLUMN_NAME FROM information_schema.columns WHERE table_name = '$name'");
	$table .= "<tr>";

	while ($header = mysql_fetch_array($headers)) {
		$table .= "<th>" . $header[0] . "</th>";		
	}

	$table .= "</tr>";
	$rows = mysql_query("SELECT * FROM $name");
	while ($row = mysql_fetch_array($rows)) {
		$table .= "<tr>";
		for ($i = 0; $i < $count; $i++) { 
			$table .= "<td>" . $row[$i] . "</td>";
		}
		$table .= "</tr>";
	}
	
	mysql_close();

	echo json_encode($table);	
?>