<?php

$json = file_get_contents('php://input');//Читает содержимое файла в строку
$user = json_decode($json);//переводит $json в строку
?>