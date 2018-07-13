<?php 
	
	include_once "connect.php"; //соединение с БД

	$json = file_get_contents('php://input');
	$user = json_decode($json);

	/* проверяем данные в БД */
	$result = mysql_query("SELECT * FROM `users` LEFT JOIN `products` USING(id_user) WHERE `id_user`='$user->id'");


	if($result && mysql_num_rows($result) > 0){ //если есть хотя бы одна запись в таблице
		$prod = mysql_fetch_array($result); //создание массива

		$i = 0;

		$user = array(
			"idUser"=>$prod["id_user"],
			"userName"=>$prod["name"],
			"lastName"=>$prod["last_name"],
			"email"=>$prod["email"],
			"avatar"=>$prod["avatar"],
			"tel"=>$prod["tel"]
		);

		do { //проходим по спику всех пользователей
			$products[$i] = array(
				"idProduct" =>$prod["id_product"],
				"name"=>$prod["name_prod"],
				"img"=>$prod["img"],
				"text"=>$prod["description"],
				"views"=>$prod["views"]
			);

			$i++;
		}
		while( $prod = mysql_fetch_array($result));

		$data = array("user" => $user, "userProducts" => $products);

		print_r(json_encode($data));
	}

 ?>