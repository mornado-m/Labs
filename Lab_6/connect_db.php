<?php
	$db_name = "list_of_my_databases";
	$connection = mysql_connect("localhost", "root", "")
		or die("Can't connect to DB.");
	$db = mysql_select_db("$db_name")
		or die("Can't select DB.");
	mysql_set_charset("utf8");

?>