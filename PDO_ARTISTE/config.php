<?php
// CONNEXION PDO
try {
    $conn = new PDO("mysql:host=localhost;dbname=artisteMada;charset=utf8", "root", "henriT@1234!");
    $conn->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
    $message = "<p>DB Connectée</p><br>";
} catch(PDOException $e) {
    $message = "<p> DB Non connectée</p>";
    die();
}

// Ajouter un artiste
if (isset($_POST['Ajouter_un_artiste'])) {
    $sql = $conn->prepare("INSERT INTO Artiste (Nom, Lieu) VALUES (?, ?)");
    if ($sql->execute([$_POST['nom'], $_POST['lieu']])) {
        $message = "<p>Artiste ajouté !</p>";
    } else {
        $message = "<p>Erreur !</p>";
    }
}

//supprimer un Album
if(isset($_GET['idSuprim']))
    {   $id = (int)$_GET['idSuprim'];
        $sql = $conn->prepare("DELETE FROM Album WHERE IdAlbum = ?");
        if($sql->execute([$id]))
            {
              $message= "<p> Album supprimer avec succes !</p>";
            }
        else {
            $message="<p>Erreur de supprimer Album !</p>";
        }
    }

// Ajouter un album
if (isset($_POST['ajouter_un_album'])) {
    $sql = $conn->prepare("INSERT INTO Album (Titre, Annee, IdArtiste) VALUES (?, ?, ?)");
    if ($sql->execute([$_POST['titre'], $_POST['annee_de_sortie'], $_POST['idArtiste']])) {
        $message = "<p>Album ajouté !</p>";
    } else {
        $message = "<p>Erreur !</p>";
    }
}

//modifier un album
if (isset($_POST["modifier_album"])) {
    
    $idAlbum = (int)$_POST['idAlbum'];
    $titre = $_POST['titre'];
    $annee = (int)$_POST['annee'];
    $idArtiste = (int)$_POST['artiste'];
    
    // Requête avec ? comme placeholder
    $sql = $conn->prepare("UPDATE Album SET Titre = ?, Annee = ?, IdArtiste = ? WHERE IdAlbum = ?");
    
    if ($sql->execute([$titre, $annee, $idArtiste, $idAlbum])) {
        $message = "<p >✅ Album Modifié avec succès !</p>";
    } else {
        $message = "<p >❌ Erreur de modification de l'Album!</p>";
    }
}

?>



