<?php

Class Clazz { public $value; }
$b = new Clazz;
$b->newValue = 1;
$a = $b;
$a->newValue = 2;
echo $b->newValue;

?>