<?php
$text = file_get_contents('php://input');//Читает содержимое файла в строку
$json = json_decode($text);//переводит $json в строку
//запись в файл
//die();
$filename = 'say.json'; //путь к файлу
$file = file_get_contents($filename); //получаем данные из файла
$arr = json_decode($file);
$users = $arr->users;
$arr->users[count($users)] = $json->say;
echo print_r($users);
file_put_contents($filename, json_encode($arr));
?>