<?php 
	include_once "connect.php";

	$json = file_get_contents('php://input');
	$data = json_decode($json);

	// запрос в БД 
	$result = mysql_query("SELECT * FROM `products` WHERE `id_product`='$data->id'");

	if($result && mysql_num_rows($result) > 0){ //если есть хотя бы одна запись в таблице
		$prod = mysql_fetch_array($result); //создание массива

		$products = array(
			"idProduct" => $prod["id_product"],
			"name" => $prod["name_prod"],
			"img" => $prod["img"],
			"text" => $prod["description"],
			"views" => $prod["views"]
		);

		print_r(json_encode($products));
	}
?>
