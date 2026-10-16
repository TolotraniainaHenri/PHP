<?php
    session_start();

    $_SESSION = [] ;  // vider le donnee
    session_destroy(); // Destruire la session cote server 
    // echo "Hello".$_SESSION["username"].session_id();
    header("location:login.php");
    exit;
?>