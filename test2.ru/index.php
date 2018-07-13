<!doctype html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport"
          content="width=device-width, user-scalable=no, initial-scale=1.0, maximum-scale=1.0, minimum-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>Document</title>
</head>
<body>
<?php
$arg = 6;
?>


<form>
    <label>
        <textarea cols="40" rows="5"  id="code">function(<?php  $arg = 5 ?>){<?php  $arg++?>}</textarea>
    </label><br>
    <input type="button" value="Компилировать" id="but">
    <script src="script.js"></script>
</body>
</html>