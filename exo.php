<?php
$numbers = array (1, 8, 12, 7, 14, -13, 8, 1, -1, 14, 7);

$total = 0;

foreach($numbers as $number)
{
  if($number > 0) {
    $total =$total+ $number;
  }
 
}

echo $total;
?>