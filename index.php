<?php 

require 'PriceComparer.php';

$v=new \tests\PriceComparer(['dt'=>1,'t0'=>4]);
echo $v->diff()."\n";
echo $v->amount."\n";

$v->currentPrice=3;
echo $v->diff()."\n";
echo $v->amount."\n";
print_r($v);