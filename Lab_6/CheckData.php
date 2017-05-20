<?php
	include_once("connect_db.php");
	session_start();
	$success = false;

	if (isset($_POST["username"]) && isset($_POST["password"])) {
		$login = strip_tags(trim($_POST["username"]));
		$pass = strip_tags(trim($_POST["password"]));

		$data = mysql_query(" SELECT UserName,Password FROM users ");
					
		while ($result = mysql_fetch_assoc($data)) {
			if ($result["UserName"] == $login && $result["Password"] == $pass) {
				$_SESSION['UserName'] = $login;
				$success = true;				
				break;
			}				
		}
	}
	
	mysql_close();	

	echo json_encode($success);			
?>