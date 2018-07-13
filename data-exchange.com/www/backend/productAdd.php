<?php 
	include_once "connect.php";


	//добавить id products в имя файла для избежания сопадений имен
	$fileName = basename($_FILES['productImg']['name']);
	$uploadfile = "N:/home/data-exchange.com/www/images/products/" . $fileName;

	$data = json_decode($_POST["data"]);

	print_r(json_encode($data));

	if (move_uploaded_file($_FILES['productImg']["tmp_name"], $uploadfile)) {
		$result = mysql_query("INSERT INTO `products` VALUES (null, '$data->name', '$fileName', '$data->description', '$data->idCategory', '$data->idUser', 0, '$data->type')");
	}

	
?>