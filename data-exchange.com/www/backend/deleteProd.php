<?php 
	
	include_once "connect.php"; //соединение с БД

	$json = file_get_contents('php://input');
	$data = json_decode($json);

	$result = mysql_query("DELETE FROM `products` WHERE `id_product`='$data->idProd'");

	if($result) {
		print_r(true);
	}
	else {
		print_r(false);
	}



?>