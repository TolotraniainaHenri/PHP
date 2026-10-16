<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Document</title>
</head>
<body>
    <form action="index.php" method="post">
        x:
        <input type="text" name="x"><br>
        y:
        <input type="text" name="y"><br>
        z:
        <input type="text" name="z"><br>
        <input type="submit" value="Total">
    </form>
</body>
</html>
<?php
$x = $_POST["x"];
$y = $_POST["y"];
$z = $_POST["z"];
$total = null;

//$total = round($x);
//$total = ceil($x);
//$total = abs($x);
//$total = pow($x, $y);
//$total = max($x, $y, $z);
//$total = min($x, $y,  $z);
$total = rand(90, 100);

echo $total;
?>