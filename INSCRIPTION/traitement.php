<?php
// ============================================
// FICHIER DE TRAITEMENT - CRUD Étudiants
// ============================================

// Inclure le fichier de connexion à la base de données
require_once 'config.php';

// Variable pour stocker les messages d'information
$message = "";

// ============================================
// 1. AJOUTER UN ÉTUDIANT
// ============================================
// isset($_POST['ajouter_etudiant']) vérifie si le formulaire a été soumis
if (isset($_POST['ajouter_etudiant'])) {

    // mysqli_real_escape_string() protège contre les injections SQL
    $nom = mysqli_real_escape_string($conn, $_POST['nom']);
    $prenom = mysqli_real_escape_string($conn, $_POST['prenom']);
    $github = mysqli_real_escape_string($conn, $_POST['github']);
    $email = mysqli_real_escape_string($conn, $_POST['email']);

    // Construction de la requête INSERT
    $sql = "INSERT INTO etudiants (nom, prenom, github, email) 
            VALUES ('$nom', '$prenom', '$github', '$email')";

    // Exécution de la requête
    if (mysqli_query($conn, $sql)) {
        // Succès : message vert
        $message = "<p style='color:green; background:#d4edda; padding:10px; border-radius:5px;'>
                    ✅ Étudiant ajouté avec succès !</p>";
    } else {
        // Échec : message rouge avec l'erreur
        $message = "<p style='color:red; background:#f8d7da; padding:10px; border-radius:5px;'>
                    ❌ Erreur : " . mysqli_error($conn) . "</p>";
    }
}

// ============================================
// 2. MODIFIER UN ÉTUDIANT
// ============================================
if (isset($_POST['modifier_etudiant'])) {

    // Récupération des données du formulaire
    $id = $_POST['id'];  // ID de l'étudiant à modifier
    $nom = mysqli_real_escape_string($conn, $_POST['nom']);
    $prenom = mysqli_real_escape_string($conn, $_POST['prenom']);
    $github = mysqli_real_escape_string($conn, $_POST['github']);
    $email = mysqli_real_escape_string($conn, $_POST['email']);

    // Construction de la requête UPDATE
    $sql = "UPDATE etudiants 
            SET nom='$nom', prenom='$prenom', github='$github', email='$email' 
            WHERE id=$id";

    if (mysqli_query($conn, $sql)) {
        $message = "<p style='color:green; background:#d4edda; padding:10px; border-radius:5px;'>
                    ✅ Étudiant modifié avec succès !</p>";
    } else {
        $message = "<p style='color:red; background:#f8d7da; padding:10px; border-radius:5px;'>
                    ❌ Erreur : " . mysqli_error($conn) . "</p>";
    }
}

// ============================================
// 3. SUPPRIMER UN ÉTUDIANT
// ============================================
// isset($_GET['supprimer_etudiant']) car la suppression se fait par lien (GET)
if (isset($_GET['supprimer_etudiant'])) {

    $id = $_GET['supprimer_etudiant'];  // Récupération de l'ID

    // Construction de la requête DELETE
    $sql = "DELETE FROM etudiants WHERE id=$id";

    if (mysqli_query($conn, $sql)) {
        $message = "<p style='color:green; background:#d4edda; padding:10px; border-radius:5px;'>
                    ✅ Étudiant supprimé avec succès !</p>";
    } else {
        $message = "<p style='color:red; background:#f8d7da; padding:10px; border-radius:5px;'>
                    ❌ Erreur : " . mysqli_error($conn) . "</p>";
    }
}
