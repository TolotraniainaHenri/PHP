<?php
  
  // array : variable whitch can hold more than on value;

  $foods= array("apple", "orange","banana","coconut");

  //array_push($foods, "peneapple");  add
  //array_pop($foods);                delete-after
  //array_shift($foods);                delete-before
  //$foods = array_reverse($foods);
  //echo count($foods);
  //echo $foods[1]."<br>";

  foreach ($foods as $food){
    echo $food."<br>";
  }

?>