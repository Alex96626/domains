<?php
$var = 'Hello world';
$var = ' page title';

?>
<!doctype html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport"
          content="width=device-width, user-scalable=no, initial-scale=1.0, maximum-scale=1.0, minimum-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title><?php echo $var; ?></title>
</head>
<body>
<?php
$i = 0;
echo '<table border="1">';
while ($i<9) {
    $i++;
    echo "<tr></tr>";
    $n = 0;
    $num = 0;//первый множититель(табица умножениян а это число -_-)
    for($n=0;$n<9;$n++){
   // while ($n <9) {
        //$n++;
        $num++;
        echo "<td>$num * $i = ".$num * $i."</td>";

    }
}
echo '</table>';


?>


</body>
</html>