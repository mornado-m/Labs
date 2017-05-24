<!DOCTYPE html>
<html>
<head>
	<title></title>
	<script type="text/javascript">		
	//
	</script>
</head>
<body onload="document.location.href = 'Index.html';">

<?php	
	include_once("connect_db.php");
	session_start();
	
	$name = $_POST["TableName"];
	$count = $_POST["count"];
	$headers = array();
	$types = array();

	for($i = 1; $i <= $count; $i++){
		$str = 'header' . $i;
		$headers[$i - 1] = $_POST[$str];
		$str = 'TYPE' . $i;
		$types[$i - 1] = $_POST[$str];
	}

	$first_header = $headers[0]; 
	$first_type = $types[0] . '(50)';
	$str = "CREATE TABLE $name ( $first_header $first_type )";	
	mysql_query($str) Or die(mysql_error());
	
	for ($i = 1; $i < $count; $i++) { 
		$header = $headers[$i];
		$type = $types[$i] . '(50)';
		$str = "ALTER TABLE $name ADD $header $type";
		mysql_query($str);
	}
	
	mysql_close();
	//echo json_encode($str);
?>

</body> 
</html>