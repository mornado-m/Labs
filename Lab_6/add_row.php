<!DOCTYPE html>
<html>
<head>
	<title></title>
	<script type="text/javascript">
		function Load(){

		}		
	</script>
</head>
<body onload="document.location.href = 'Index.html';">

<?php	
	include_once("connect_db.php");
	session_start();

	$Other_Params = split(" ", $_POST["Other_Params"]);
	$name = $Other_Params[0];
	$count = $Other_Params[1];

	$params = array();
	$query = "INSERT INTO " . $name . " (";
	for ($i = 2; $i < $count + 2; $i++) { 
		$query .= $Other_Params[$i] . ", ";
	}
	$query = substr($query, 0, -2);
	$query .= ") VALUES (";

	for ($i = 0; $i < $count; $i++) { 
		$str = 'param' . $i;
		$query .= "'" . $_POST[$str] . "', ";
	}
	$query = substr($query, 0, -2);
	$query .= ")";

	mysql_query($query);

	mysql_close();
?>

</body> 
</html>

