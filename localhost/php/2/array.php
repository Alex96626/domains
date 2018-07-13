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

$market =[
    [
   'title' => Nokia,
    'price'=> 12400,
    'kredit' =>true
    ],
[
    'title' => Ipad,
    'price'=> 23000,
    'kredit' =>true
],
[
    'title' => Mac,
    'price'=> 26000,
    'kredit' =>true
],
[
    'title' => Asus,
    'price'=> 29000,
    'kredit' =>true
]
];


//$cout = 1;
$n = 0;
while ($n <count($market)) {
   // $cout++;

    echo "<div>";
    echo $market[$n]['title']."-".$market[$n]['price'];
echo"</div>";
    $n++;
}
?>
</body>
</html>
