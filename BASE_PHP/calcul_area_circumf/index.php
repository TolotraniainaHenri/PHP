<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Document</title>
</head>
<body>
    <form action="index.php" method="post">
        Raduis:
        <input type="text" name="raduis"><br>
        <input type="submit" value="Calculate">
    </form>
</body>
</html>
<?php 
    $raduis = $_POST["raduis"];
    $area = null;
    $circumference = null;

    $circumference = 2 * pi() * $raduis;
    $circumference = round($circumference, 2);

    $area = pi() * pow($raduis, 2);
    $area = round($area, 2);
    
    echo"Circumference = {$circumference} ";
    echo"Area = {$area}";

?>
