<?php
$arr = array('Lorem',' ', 'ipsum',' ', 'dolor',' ', 'sit',' ','amet',' ','consectetur',' ','adipiscing',' ',' elit.');
$file_name = 'somefile.txt';

file_put_contents($file_name,$arr);

$text =str_split(file_get_contents($file_name)) ;
    foreach ($text as  $t)
    print_r ($t);
?>