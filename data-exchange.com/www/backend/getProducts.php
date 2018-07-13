<?php 

	include_once "headers.php";
	include_once "connect.php";

	$json = file_get_contents('php://input');
	$data = json_decode($json);

	// запрос в БД 
	$result = mysql_query("SELECT * FROM `products` WHERE `id_user`='$data->id' ORDER BY `id_product` DESC");

	if($result && mysql_num_rows($result) > 0){ //если есть хотя бы одна запись в таблице
		$prod = mysql_fetch_array($result); //создание массива

		$i = 0;
		do { //проходим по спику всех пользователей
			$products[$i] = array(
				"idProduct" =>$prod["id_product"],
				"name"=>$prod["name_prod"],
				"img"=>$prod["img"],
				"text"=>$prod["description"],
				"type"=>$prod["type"]
			);
			$i++;
		}
		while( $prod = mysql_fetch_array($result));

		print_r(json_encode($products));
	}
?>
