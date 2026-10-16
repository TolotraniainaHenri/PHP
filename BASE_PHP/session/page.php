
<?php
/*
C’est quoi une session ?

 Le protocole HTTP est sans état (stateless) : à chaque requête,
 le serveur « oublie » qui vous êtes. Si vous vous connectez sur la page login.php,
 puis allez sur profil.php, le serveur ne sait pas que c’est la même personne.
*/
 session_start();

 if(isset($_SESSION['name'])){
    echo "Bonjour ".htmlspecialchars($_SESSION['name']).session_id();
 }else{
    echo "Vous etes n'est pas connecter!";
 }

 ?>