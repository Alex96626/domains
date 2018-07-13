<?php 
	include_once "connect.php";

	$json = file_get_contents('php://input');
	$data = json_decode($json);

	// запрос в БД 
	$result = mysql_query("SELECT * FROM `products` LEFT JOIN `users` USING(id_user) ORDER BY `id_user` DESC");

	if($result && mysql_num_rows($result) > 0){ //если есть хотя бы одна запись в таблице
		$prod = mysql_fetch_array($result); //создание массива

		$i = 0;
		do { //проходим по спику всех пользователей
			$products[$i] = array(
				"idLot" => $prod["id_product"],
				"name" => $prod["name_prod"],
				"img" => $prod["img"],
				"avatar" =>  $prod["avatar"],
				"views" => $prod["views"],
				"userName" => $prod["name"],
				"lastName" => $prod["last_name"],
				"text" => $prod["description"],
				"idCat" => $prod["id_category"],
				"idUser" => $prod["id_user"],
				"show" => true,
				"type" => $prod["type"]
			);
			$i++;
		}
		while( $prod = mysql_fetch_array($result));

		print_r(json_encode($products));
	}
?>
