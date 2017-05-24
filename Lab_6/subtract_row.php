<?php	
	include_once("connect_db.php");
	session_start();

	$headers = split(" ", $_POST["headers"]);
	$values = split(" ", $_POST["params"]);
	$name = $_POST["table_name"];

	$query = "DELETE FROM $name WHERE ";
	for ($i = 0; $i < count($headers); $i++) { 
		$query .= $headers[$i] . "='" . $values[$i] . "' AND ";
	}
	$query = substr($query, 0, -5);
	mysql_query($query) Or die (mysql_error());;

	mysql_close();
	echo json_encode(true);
?>