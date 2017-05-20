<?php 
	include_once("connect_db.php");
	session_start();
	$Success = true;

	if (isset($_POST["username"]) && isset($_POST["password"])) {
		$login = strip_tags(trim($_POST["username"]));
		$pass = strip_tags(trim($_POST["password"]));
		$f_name = strip_tags(trim($_POST["name1"]));
		$l_name = strip_tags(trim($_POST["name2"]));
		$e_mail = strip_tags(trim($_POST["E_mail"]));
		$photo = strip_tags(trim($_POST["photo"]));

		$usernames = mysql_query(" SELECT UserName FROM users ");
					
		while ($result = mysql_fetch_assoc($usernames)) {
			if ($result["UserName"] == $login) {
				$Success = false;
				break;
			}				
		}

		if ($Success) {
			$res = mysql_query(" INSERT INTO users(UserName, Password, FirstName, LastName, E_mail, Photo) 
										VALUES ('$login', '$pass', '$f_name', '$l_name', '$e_mail', '$photo') ");
			$_SESSION['UserName'] = $login;
		}

	}

	mysql_close();

	echo json_encode($Success);
?>