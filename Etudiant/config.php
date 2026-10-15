<?php 
// Connection sur BD
try{
    $conn = new PDO("mysql:host=localhost;dbname=etudiants;charset=utf8", "root", "henriT@1234!");
    $conn->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
    $message = "<p>✅DB connecte</p> <br>";

}catch(PDOException $e){
   
    die( $message = "<p>⚠️DB non connecte</p> <br>");
}
// Ajouter
 if(isset($_POST['ajouter'])){
    $nom = $_POST['nom'];
    $prenom = $_POST['prenom'];
    $age = $_POST['age'];
    $participation = $_POST['participation'];
    $idRegion = $_POST['idRegion'];
    $sql = $conn->prepare("INSERT INTO etudiant (nom, prenom, age, participation, idRegion) VALUES (?, ?, ?, ? ,?)");
    if( $sql->execute([$nom, $prenom, $age, $participation, $idRegion])){
        $message = "<p>☑️Etudiant ajout avec succes</p> <br>";
        } else {
        $message = "<p>⚠️erreur d'ajouter</p> <br>";
    }
}
?>