 <?php
   session_start();
   // protection si n'a pas connecter  ,retoure au login

   if(!isset($_SESSION["username"])){
        header('location:login.php');
    exit;
   }
    echo"Connecter a: ".$_SESSION['username'].$_SESSION['heure'];
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Document</title>
</head>
<body>
    <h2>Welcome to my page Bro </h2>
    <a href = "logout.php">Deconnecter</a>
</body>
</html>