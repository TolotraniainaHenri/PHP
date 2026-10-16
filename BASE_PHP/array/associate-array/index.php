<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Document</title>
</head>
<body>
    <form action="index.php" method="post">
        <label>Enter a country:</label><br>
        <input type="text" name="country"><br>
        <input type="submit" value="Submit">
    </form>
</body>
</html>

<?php
$capitals = array("USA" => "Wahingtone DC",
                 "Japan" => "Kyoto",
                 "South Korea" => "Seoul",
                 "India" => "New Delhi");

$capitals["Chine"] = "Beijing";

//array_pop($capitals);
//array_shift($capitals);
//array_keys($capitals);

//  foreach($capitals as $key => $value){
//      echo "{$key} :{$value} <br>";
//  }

echo "Capital :".$capitals[$_POST['country']];
?>