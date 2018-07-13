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
$array1 = array( "green", "red",  "blue");
$array2 = array("b" => "green", "yellow", "red");
$result = array_diff($array1, $array2);
//echo "<pre>";
//print_r($result);
//var_dump($result);
//echo "</pre>";
//foreach ($array1 as $ket=>$item)
//    echo $ket."-".$item . '<br>';
//for($i =0;$i<=30;$i++)
//    if($i == 10) {
//        for ($j = 0; $i>=20; $j++) continue;
//    }
//echo $i;
//foreach ($array1 as $color){
//    if($color === "red" || $color === "green") continue;
//    echo $color.'<br>';
//}
$bool = true;
$s = "hello";
$s1 = "hello11";
$s2 = "hello111";
?>
<?php  if($bool):?>
<table class="table" border="1">
    <tr>
        <td><?php echo$s?></td>
        <td><?php echo$s1?></td>
        <td><?php echo$s2?></td>


    </tr>

</table>
    <?php endif;    ?>
</body>
</html>
