<?php 
	
	include_once "connect.php"; //соединение с БД

	$json = file_get_contents('php://input');
	$user = json_decode($json);

	$result = mysql_query("SELECT * FROM `users` WHERE `email`='$user->email'");
	
	$found_user = array("find"=>false);
	if($result && mysql_num_rows($result) > 0){ //если есть хотя бы одна запись в таблице
		$found_user = array("find"=>true);
		print_r(json_encode($found_user));
	}
	else {
		/* проверяем данные в БД */
		$result = mysql_query("INSERT INTO `users` VALUES (null, '$user->name', '$user->lastName', '$user->email', '$user->password', 'avatar.jpg')");

		if($result) {
			print_r(json_encode(array("register"=>true)));
		}
		else {
			print_r(json_encode(array("register"=>false)));
		}
	}


	

	


 ?>