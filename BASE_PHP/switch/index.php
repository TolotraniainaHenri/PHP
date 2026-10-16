<?php
   //switch = remplace to write elseif statements, 
   //  more effecient and less code;
   
  $grade = "K";
  switch($grade){
    case "A":
        echo " you did greate";
        break;
    case "B" :
        echo " you did good";
        break;
    case "C" :
        echo " you did okay";
        break;
    case "D": 
        echo " you did poorly";
        break;
    case "F":
        echo " You failed";
        break;
    default:
    echo "{$grade} is not valid";
  }
?>