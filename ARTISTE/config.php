<?php
error_reporting(E_ALL);  //active l'affichage des erreurs a l'ecran
ini_set('display_errors',1); //signale tous les erreurs

$bd_server= "localhost";
$db_user= "root";
$db_pasword= "henriT@1234!";
$db_name= "artisteMada";

$message="";

$conn=mysqli_connect($bd_server,$db_user,$db_pasword,$db_name);
mysqli_set_charset($conn,"utf8");

if ($conn){
    $message="<p>DB Connecter</p><br>";
}
else{
    $message="<p>DB Non connecter</p>";
}

//============================Ajouter un Artiste================================
if (isset($_POST['Ajouter_un_artiste']))
  {
    $nom = mysqli_real_escape_string($conn,$_POST['nom']);
    $annee = mysqli_real_escape_string($conn,$_POST['lieu']);
    
    $sql= "INSERT INTO Artiste(Nom,Lieu) VALUE ('$nom','$annee')";
    
    if(mysqli_query($conn,$sql))
      {
        $message="<p>Artiste ajoute avec succes !</p>";
      }
    else
      {
             $message="<p>Erreur :".mysqli_error($conn)."</p>";
        }    

    }
  //==========================Ajouter un  Album=======================================

  if(isset($_POST['ajouter_un_album']))
    {
      $titre = mysqli_real_escape_string($conn,$_POST['titre']);
      $annee = mysqli_real_escape_string($conn,$_POST['annee_de_sortie']);
      $idArtiste = mysqli_real_escape_string($conn,$_POST['idArtiste']);
      $sql="INSERT INTO Album (Titre,Annee,IdArtiste) VALUE (' $titre','$annee','$idArtiste')";

      if(mysqli_query($conn,$sql))
        {
          $message="<p>Album ajoute avec succes !</p>";
        }
        else{
          $message="<p>Erreur :".mysqli_error($conn)."</p>";
        }

    }
    
?>   


