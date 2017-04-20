<?php	
	include_once("connect_db.php");
	session_start();
	$data = array();
	$data['login'] = $_SESSION['UserName'];
	$login = $data['login'];

	$db_data = mysql_query(" SELECT UserName,Password,FirstName,LastName,E_mail,Photo FROM users WHERE UserName = '$login' ");
	$result = mysql_fetch_assoc($db_data);
	$data['pass'] = $result['Password'];
	$data['f_name'] = $result['FirstName'];
	$data['l_name']	= $result['LastName'];
	$data['e_mail']	= $result['E_mail'];
	$data['photo']	= $result['Photo'];	

	mysql_close();
	echo json_encode($data);
?>