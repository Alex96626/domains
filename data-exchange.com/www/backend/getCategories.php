<?php 
	include_once "connect.php";

	$json = file_get_contents('php://input');
	$user = json_decode($json);

	// проверяем данные в БД 
	$result = mysql_query("SELECT * FROM `categories`");

	if($result && mysql_num_rows($result) > 0){ //если есть хотя бы одна запись в таблице
		$cat = mysql_fetch_array($result); //создание массива

		$i = 0;
		do { //проходим по спику всех пользователей
			$categories[$i] = array("id" =>$cat["id_category"], "name"=>$cat["name"]);
			$i++;
		}
		while( $cat = mysql_fetch_array($result));

		print_r(json_encode($categories));
	}

?>