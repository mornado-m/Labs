<?php	
	include_once("connect_db.php");
	session_start();
	
	$file = $_FILES['file']["name"];
	$file = fopen($file, 'r');

	$name = strip_tags(trim(fgets($file, 999)));
	$headers = split(" ", fgets($file, 999));
	$headers[count($headers) - 1] = substr($headers[count($headers) - 1], 0, -1);

	$table = array();
	$i = 0;
	while (!feof($file))
	{
		$table[$i++] = strip_tags(trim(fgets($file, 999)));		
	}
	fclose($file);


	$first_header = $headers[0]; 
	$str = "CREATE TABLE $name ( $first_header VARCHAR(50) )";	
	mysql_query($str) Or die(mysql_error());
	
	for ($i = 1; $i < count($headers); $i++) { 
		$header = $headers[$i];
		$str = "ALTER TABLE $name ADD $header VARCHAR(50)";
		mysql_query($str);
	}

	for ($j=0; $j < count($table); $j++) { 
		$row = split(" ", $table[$j]);

		$query = "INSERT INTO $name (";
		for ($i = 0; $i < count($headers); $i++) { 
			$query .= $headers[$i] . ", ";
		}
		$query = substr($query, 0, -2);

		$query .= ") VALUES (";
		for ($i = 0; $i < count($row); $i++) { 
			$query .= "'" . $row[$i] . "', ";
		}
		$query = substr($query, 0, -2);
		$query .= ")";

		mysql_query($query) Or die (mysql_error());		
	}	
	
	mysql_close();	
?>