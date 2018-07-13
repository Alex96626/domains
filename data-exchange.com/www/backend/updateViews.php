<?php 
	include_once "connect.php";

	$json = file_get_contents('php://input');
	$data = json_decode($json);

	// запрос в БД 
	$result = mysql_query("UPDATE `products` SET `views`='$data->views' WHERE `id_product`='$data->id'");

	print_r(json_encode($data));


?>