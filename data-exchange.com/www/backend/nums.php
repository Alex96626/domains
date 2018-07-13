<?php 
	
	include_once "connect.php"; //соединение с БД

	//кол-во пользователей
	$users = mysql_query("SELECT COUNT(*) FROM `users`");
	$rowUsers = mysql_fetch_assoc($users);
	$countUsers = $rowUsers['COUNT(*)'];

	//кол-во товаров
	$products = mysql_query("SELECT COUNT(*) FROM `products` WHERE `type`='item'");
	$rowProducts = mysql_fetch_assoc($products);
	$countProducts = $rowProducts['COUNT(*)'];

	// кол-во "закзов"
	$orders = mysql_query("SELECT COUNT(*) FROM `products` WHERE `type`='order'");
	$rowOrders = mysql_fetch_assoc($orders);
	$countOrders = $rowOrders['COUNT(*)'];

	print_r(json_encode(array("users"=>$countUsers, "lots"=>$countProducts, "orders"=>$countOrders)));

?>