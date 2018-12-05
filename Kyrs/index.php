<?php
//hello git
// $arr = array(1,5,6,8,9);
//
// foreach ($_SERVER as $key => $a)
//{
//
//    echo $key.' -----------'.$a.'<br/>';
//}

 //echo $_SERVER["HTTP_USER_AGENT"];
$braw = $_SERVER["HTTP_USER_AGENT"];

if(strpos($braw , "Mazilla")!==false) echo "true Mazilla";
//elseif(strpos($braw , "Chrome") !==false) echo "true Chrome";
elseif(strpos($braw ,"YaBrowser")!==false ) echo " YaBrowser";


?>
