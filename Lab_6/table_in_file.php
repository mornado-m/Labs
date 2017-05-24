<?php	
	include_once("connect_db.php");
	session_start();
	
	$file = $_FILES['file']["name"];
	$file = fopen($file, 'a');
	ftruncate($file, 0);

	$name = $_POST['table_name'];
	$headers = $_POST['headers'];
	fwrite($file, $name . "\n");
	fwrite($file, $headers . "\n");
	$headers = split(" ", $headers);

	$table = mysql_query("SELECT * FROM $name");
					
	while ($row = mysql_fetch_assoc($table)) {
		$one = $row[$headers[0]];
		for ($i=1; $i < count($headers); $i++) { 
			$one .= " " . $row[$headers[$i]];
		}	
		fwrite($file, $one . "\n");		
	}
	
	fclose($file);
	mysql_close();	

	echo json_encode($name);
?>