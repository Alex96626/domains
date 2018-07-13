<?php 
	    
	include_once "headers.php";
	include_once "connect.php"; //соединение с БД

	$json = file_get_contents('php://input');
	$user = json_decode($json);

	/* проверяем данные в БД */
	$result = mysql_query("SELECT * FROM `users` WHERE `email`='$user->email' && `password`='$user->password'");
	
	$found_user;
	
	if($result && mysql_num_rows($result) > 0){ //если есть хотя бы одна запись в таблице
		$found_user = mysql_fetch_array($result); //создание массива
	}


	print_r(json_encode($found_user));

 ?>