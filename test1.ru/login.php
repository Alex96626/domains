<?php
$login = trim($_GET['login']);
$pass = trim($_GET['pass']);


if($login == ' ' || $pass == ''){
    echo "Ошибка,заполните полян";
    return;
}

 if($login != 'login' || $pass != '123'){
    echo "Такой пользователь не найден";

 } else {
     echo "Добро пожаловать";
 }

?>