<?php 

	function addMessage($id, $msg) {
		$msgInfo= array(
			"id_msg" =>$msg["id_message"],
			"date"=>$msg["date_msg"],
			"text"=>$msg["text_msg"]
		);

		$user = mysql_query("SELECT * FROM `users` WHERE `id_user`='$id'");
		$msgToUser = mysql_fetch_array($user);

		$userTo = array(
			"idUser"=>$msgToUser["id_user"],
			"userName"=>$msgToUser["name"],
			"lastName"=>$msgToUser["last_name"],
			"email"=>$msgToUser["email"],
			"avatar"=>$msgToUser["avatar"]
		);

		//echo $id;

		return array("userTo" => $userTo, "msgInfo" => $msgInfo);
	}

	include_once "connect.php"; //соединение с БД

	$json = file_get_contents('php://input');
	$user = json_decode($json);

	/* проверяем данные в БД */
	$result = mysql_query("SELECT * FROM `messages` WHERE `from_user`='$user->id' || `to_user`='$user->id'");



	if($result && mysql_num_rows($result) > 0){ //если есть хотя бы одна запись в таблице
		//echo $user->id;
		$msg = mysql_fetch_array($result); //создание массива

		$msgFrom = array(); //отправленные сообщения `id_user`='$user->id' (от Селима)
		$msgTo = array(); // полученные смс

		$i=0;
		$j=0;

		do { //проходим по спику всех сообщений
			if($user->id == $msg["from_user"]) { //отправленные
				
				$msgFrom[$i] = addMessage($msg['to_user'], $msg); //
				$i++;
			}
			else { //полученные смс
				$msgTo[$j] = addMessage($msg['from_user'], $msg);
				$j++;
			}

		}
		while( $msg = mysql_fetch_array($result));

		

		$data = array("msgFrom" => $msgFrom, "msgTo" => $msgTo);

		print_r(json_encode($data));

		//echo $user->id;

	}




 ?>