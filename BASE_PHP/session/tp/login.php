<?php
  session_start();
  
  $user_valide = "henri";
  $password = "henri1234";
  $erreur = '';
  

  if($_SERVER['REQUEST_METHOD'] == 'POST'){
    $name = $_POST['username'];
    $hash_valid = password_hash($_POST['password'], PASSWORD_DEFAULT);
     
        if($name == $user_valide && password_verify($password, $hash_valid) == 1){
             session_regenerate_id(true);               // protege contre la fixation de session
             $_SESSION['username']=$name;
             $_SESSION['heure']=date('H:i:s');

              header('location:profil.php');
             //echo"Password verify!".$_SESSION['heure'].$_SESSION['username'].$_SESSION['heure'];
        exit;
      }else{
        $erreur='Nom ou mot de pass incorrect!';
      }
    }
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Document</title>
</head>
<body>
    <h2>Connexion</h2>
    <?php if($erreur != ''){ echo $erreur;   } ?>
    <form action="login.php" method="post">
        <label>username:</label><br>
        <input type="text" name="username" required><br>
        <label>Password:</label><br>
        <input type="password" name="password" required><br>
        <input type="submit" name="submit "value="Login">
    </form>

 
    
</body>
</html>

