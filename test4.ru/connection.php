<?php
require_once 'data_base.php';
$link = mysqli_connect($host, $user, $password, $database)
or die("Ошибка " . mysqli_error($link));

// выполняем операции с базой данных
$query ="SELECT * FROM people";
$result = mysqli_query($link, $query) or die("Ошибка " . mysqli_error($link));
?>

