<?php 

	include_once "connect.php";

	$json = file_get_contents('php://input');
	$data = json_decode($json);

	$date = date('Y-m-d H:m:s');

	$result = mysql_query("INSERT INTO `messages` VALUES (null, '$date', '$data->msg', '$data->fromUser', '$data->toUser') ");

	/*if($result) {
		print_r(json_encode(array("status"=>true)));
	}
	else {
		print_r(json_encode($data));
		//print_r(json_encode(array("status"=>false)));
	}*/



	print_r(json_encode($result));




 ?>