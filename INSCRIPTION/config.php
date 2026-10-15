<?php
// ============================================
// FICHIER DE CONFIGURATION - CONNEXION MySQL
// ============================================

// Activer l'affichage de toutes les erreurs PHP
error_reporting(E_ALL);
ini_set('display_errors', 1);

// Définition des constantes de connexion
define('DB_HOST', 'localhost');      // Serveur MySQL (local)
define('DB_USER', 'root');            // Nom d'utilisateur MySQL
define('DB_PASS', 'henriT@1234!'); // Mot de passe MySQL (À MODIFIER)
define('DB_NAME', 'musique');         // Nom de la base de données

// Établir la connexion avec MySQL
$conn = mysqli_connect(DB_HOST, DB_USER, DB_PASS, DB_NAME);

// Vérifier si la connexion a réussi
if (!$conn) {
    // Afficher l'erreur et arrêter le script
    die("<p style='color:red'>❌ Erreur de connexion : " . mysqli_connect_error() . "</p>");
}

// Définir l'encodage UTF-8 pour éviter les problèmes d'accents
mysqli_set_charset($conn, "utf8");
