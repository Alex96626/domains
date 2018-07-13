<?php
	
	include_once "headers.php";

	define("DB_SERVER", "localhost");
	define("DB_USER", "root");
	define("DB_PASS", "");
	define("DB_NAME", "data_exchange");

	$connect = mysql_connect(DB_SERVER,DB_USER, DB_PASS) or die(mysql_error());
		mysql_select_db(DB_NAME) or die("Cannot select DB");
		
?>