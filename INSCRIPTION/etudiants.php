<?php
// ============================================
// FICHIER PRINCIPAL - INTERFACE UTILISATEUR
// ============================================

// Inclure le fichier de traitement (contient la logique PHP)
require_once 'traitement.php';
require_once 'config.php';
?>

<!DOCTYPE html>
<html lang="fr">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>INT - Gestion des étudiants</title>
    <style>
        /* ============================================ */
        /* SECTION CSS - STYLES ET MISE EN PAGE         */
        /* ============================================ */

        /* Réinitialisation des marges et paddings par défaut */
        * {
            margin: 0;
            padding: 0;
            box-sizing: border-box;
            /* Inclut la bordure dans la largeur */
        }

        /* Style du corps de la page */
        body {
            font-family: 'Segoe UI', Tahoma, Geneva, Verdana, sans-serif;
            min-height: 100vh;
            /* Hauteur minimale = 100% de l'écran */
            padding: 20px;
            position: relative;
        }

        /* ===== FOND BICOLORE OBLIQUE ===== */
        /* Calque 1 : Fond bleu dégradé (arrière-plan complet) */
        body::before {
            content: "";
            position: fixed;
            top: 0;
            left: 0;
            width: 100%;
            height: 100%;
            z-index: -2;
            /* Placé derrière tout le contenu */
            background: linear-gradient(135deg, #1e3c72 0%, #2a5298 100%);
        }

        /* Calque 2 : Image avec découpe diagonale */
        body::after {
            content: "";
            position: fixed;
            top: 0;
            left: 0;
            width: 100%;
            height: 100%;
            z-index: -1;
            background-image: url('uploads/universite.jpg');
            background-size: cover;
            /* L'image couvre toute la zone */
            background-position: center;
            background-repeat: no-repeat;
            clip-path: polygon(45% 0%, 100% 0%, 100% 100%, 35% 100%);
        }

        /* Conteneur principal (largeur maximale 1200px) */
        .container {
            max-width: 1200px;
            margin: 0 auto;
            /* Centrage horizontal */
            position: relative;
            z-index: 1;
            /* Au-dessus du fond */
        }

        /* Titre principal */
        h1 {
            text-align: center;
            color: white;
            margin-bottom: 10px;
            font-size: 2.5em;
            text-shadow: 2px 2px 4px rgba(0, 0, 0, 0.5);
        }

        /* Sous-titre */
        .subtitle {
            text-align: center;
            color: rgba(255, 255, 255, 0.9);
            margin-bottom: 30px;
            font-size: 1.1em;
        }

        /* Zone des messages d'erreur/succès */
        .message {
            margin-bottom: 20px;
        }

        /* Grille pour les cartes (2 colonnes) */
        .grid {
            display: grid;
            grid-template-columns: 1fr 1fr;
            /* 2 colonnes égales */
            gap: 30px;
            /* Espace entre les colonnes */
            margin-bottom: 30px;
        }

        /* Style des cartes (formulaires) */
        .card {
            background: rgba(255, 255, 255, 0.95);
            border-radius: 15px;
            padding: 25px;
            box-shadow: 0 10px 30px rgba(0, 0, 0, 0.2);
            backdrop-filter: blur(2px);
            /* Légère transparence */
        }

        .card h2 {
            color: #1e3c72;
            margin-bottom: 20px;
            padding-bottom: 10px;
            border-bottom: 3px solid #2a5298;
        }

        /* Groupe de champs de formulaire */
        .form-group {
            margin-bottom: 15px;
        }

        label {
            display: block;
            /* Le label prend toute la ligne */
            margin-bottom: 5px;
            color: #555;
            font-weight: bold;
        }

        input {
            width: 100%;
            padding: 10px;
            border: 1px solid #ddd;
            border-radius: 5px;
            font-size: 14px;
            transition: border-color 0.3s;
        }

        input:focus {
            outline: none;
            border-color: #2a5298;
            /* Changement de couleur au clic */
        }

        /* Style des boutons */
        button {
            background: linear-gradient(135deg, #1e3c72 0%, #2a5298 100%);
            color: white;
            border: none;
            padding: 12px 25px;
            border-radius: 5px;
            cursor: pointer;
            font-size: 16px;
            font-weight: bold;
            transition: transform 0.2s;
        }

        button:hover {
            transform: translateY(-2px);
            /* Légère élévation au survol */
            box-shadow: 0 5px 15px rgba(0, 0, 0, 0.2);
        }

        /* Conteneur du tableau */
        .table-container {
            background: rgba(255, 255, 255, 0.95);
            border-radius: 15px;
            padding: 25px;
            box-shadow: 0 10px 30px rgba(0, 0, 0, 0.2);
            overflow-x: auto;
            /* Scroll horizontal si besoin */
            backdrop-filter: blur(2px);
        }

        /* Style du tableau */
        table {
            width: 100%;
            border-collapse: collapse;
            /* Supprime les doubles bordures */
        }

        /* En-tête du tableau */
        th {
            background: linear-gradient(135deg, #1e3c72 0%, #2a5298 100%);
            color: white;
            padding: 12px;
            text-align: left;
        }

        /* Cellules du tableau */
        td {
            padding: 12px;
            border-bottom: 1px solid #ddd;
            background: rgba(255, 255, 255, 0.9);
        }

        /* Survol des lignes */
        tr:hover td {
            background: #f5f5f5;
        }

        /* Boutons d'action dans le tableau */
        .btn-modifier {
            background: #ffc107;
            color: #333;
            padding: 5px 12px;
            text-decoration: none;
            border-radius: 5px;
            margin-right: 5px;
            display: inline-block;
            font-size: 12px;
        }

        .btn-supprimer {
            background: #dc3545;
            color: white;
            padding: 5px 12px;
            text-decoration: none;
            border-radius: 5px;
            display: inline-block;
            font-size: 12px;
        }

        .btn-github {
            background: #333;
            color: white;
            padding: 5px 12px;
            text-decoration: none;
            border-radius: 5px;
            display: inline-block;
            font-size: 12px;
        }

        /* Cartes de statistiques */
        .stats {
            display: flex;
            gap: 15px;
            margin-bottom: 30px;
        }

        .stat-card {
            background: rgba(255, 255, 255, 0.95);
            padding: 15px;
            border-radius: 10px;
            text-align: center;
            flex: 1;
            backdrop-filter: blur(2px);
        }

        .stat-number {
            font-size: 32px;
            font-weight: bold;
            color: #2a5298;
        }

        /* Fenêtre modale (popup) */
        .modal {
            display: none;
            position: fixed;
            top: 0;
            left: 0;
            width: 100%;
            height: 100%;
            background: rgba(0, 0, 0, 0.5);
            z-index: 1000;
        }

        .modal-content {
            background: white;
            width: 500px;
            margin: 100px auto;
            padding: 30px;
            border-radius: 15px;
            position: relative;
        }

        .close {
            position: absolute;
            right: 20px;
            top: 15px;
            font-size: 25px;
            cursor: pointer;
            color: #999;
        }

        /* Version responsive (mobile) */
        @media (max-width: 768px) {
            .grid {
                grid-template-columns: 1fr;
                /* Une seule colonne sur mobile */
            }
        }
    </style>
</head>

<body>
    <div class="container">
        <!-- TITRE PRINCIPAL -->
        <h1>🎓 Promotion Innovation et Technologie (INT)</h1>
        <div class="subtitle">Gestion des étudiants - 2025/2026</div>

        <!-- AFFICHAGE DES MESSAGES PHP -->
        <?php if (isset($message)) echo "<div class='message'>$message</div>"; ?>

        <!-- SECTION STATISTIQUES -->
        <div class="stats">
            <?php
            // Requêtes SQL pour compter les étudiants
            $total_etudiants = mysqli_fetch_assoc(mysqli_query($conn, "SELECT COUNT(*) as total FROM etudiants"))['total'];
            $github_count = mysqli_fetch_assoc(mysqli_query($conn, "SELECT COUNT(*) as total FROM etudiants WHERE github IS NOT NULL AND github != ''"))['total'];
            ?>
            <div class="stat-card">
                <div class="stat-number"><?= $total_etudiants ?></div>
                <div>👨‍🎓 Étudiants</div>
            </div>
            <div class="stat-card">
                <div class="stat-number"><?= $github_count ?></div>
                <div>🐙 Ont GitHub</div>
            </div>
            <div class="stat-card">
                <div class="stat-number"><?= round(($github_count / max($total_etudiants, 1)) * 100, 1) ?>%</div>
                <div>Taux d'activité</div>
            </div>
        </div>

        <!-- SECTION FORMULAIRES (2 colonnes) -->
        <div class="grid">
            <!-- Formulaire d'ajout -->
            <div class="card">
                <h2>➕ Ajouter un étudiant</h2>
                <form method="POST">
                    <div class="form-group">
                        <label>Nom :</label>
                        <input type="text" name="nom" required placeholder="Dupont">
                    </div>
                    <div class="form-group">
                        <label>Prénom :</label>
                        <input type="text" name="prenom" required placeholder="Jean">
                    </div>
                    <div class="form-group">
                        <label>GitHub :</label>
                        <input type="text" name="github" placeholder="nomutilisateur">
                    </div>
                    <div class="form-group">
                        <label>Email :</label>
                        <input type="email" name="email" required placeholder="jean.dupont@example.com">
                    </div>
                    <button type="submit" name="ajouter_etudiant">📝 Ajouter l'étudiant</button>
                </form>
            </div>

            <!-- Guide rapide -->
            <div class="card">
                <h2>📖 Guide rapide</h2>
                <ul style="margin-left: 20px; line-height: 1.8;">
                    <li>🔹 <strong>Ajouter</strong> : Remplissez le formulaire</li>
                    <li>🔹 <strong>Modifier</strong> : Cliquez sur "Modifier"</li>
                    <li>🔹 <strong>Supprimer</strong> : Cliquez sur "Supprimer"</li>
                    <li>🔹 <strong>GitHub</strong> : Lien vers le profil</li>
                </ul>
            </div>
        </div>

        <!-- TABLEAU DES ÉTUDIANTS -->
        <div class="table-container">
            <h2 style="margin-bottom: 20px; color: #1e3c72;">📋 Liste des étudiants INT</h2>
            <table>
                <thead>
                    <tr>
                        <th>ID</th>
                        <th>Nom complet</th>
                        <th>Email</th>
                        <th>GitHub</th>
                        <th>Date d'inscription</th>
                        <th>Actions</th>
                    </tr>
                </thead>
                <tbody>
                    <?php
                    // Récupération de tous les étudiants (triés par nom)
                    $result = mysqli_query($conn, "SELECT * FROM etudiants ORDER BY nom, prenom");

                    if (mysqli_num_rows($result) > 0) {
                        while ($row = mysqli_fetch_assoc($result)) {
                            echo "<tr>";
                            echo "<td>{$row['id']}</td>";
                            echo "<td><strong>" . htmlspecialchars($row['prenom']) . " " . htmlspecialchars($row['nom']) . "</strong></td>";
                            echo "<td><a href='mailto:{$row['email']}' style='color:#2a5298;'>{$row['email']}</a></td>";
                            echo "<td>";
                            if (!empty($row['github'])) {
                                echo "<a href='https://github.com/{$row['github']}' target='_blank' class='btn-github'>🐙 {$row['github']}</a>";
                            } else {
                                echo "<span style='color:#999;'>Non renseigné</span>";
                            }
                            echo "</td>";
                            echo "<td>" . date('d/m/Y', strtotime($row['date_inscription'])) . "</td>";
                            echo "<td>";
                            echo "<button class='btn-modifier' onclick='modifierEtudiant({$row['id']}, \"{$row['nom']}\", \"{$row['prenom']}\", \"{$row['github']}\", \"{$row['email']}\")'>✏️ Modifier</button>";
                            echo "<a href='?supprimer_etudiant={$row['id']}' class='btn-supprimer' onclick='return confirm(\"Supprimer définitivement cet étudiant ?\")'>🗑️ Supprimer</a>";
                            echo "</td>";
                            echo "</tr>";
                        }
                    } else {
                        echo "<tr><td colspan='6' style='text-align:center; padding:40px;'>📭 Aucun étudiant pour le moment.</td></tr>";
                    }
                    ?>
                </tbody>
            </table>
        </div>
    </div>

    <!-- ============================================ -->
    <!-- MODALE (POPUP) POUR LA MODIFICATION          -->
    <!-- ============================================ -->
    <div id="modalEtudiant" class="modal">
        <div class="modal-content">
            <span class="close" onclick="fermerModal()">&times;</span>
            <h2 style="margin-bottom: 20px;">✏️ Modifier l'étudiant</h2>
            <form method="POST">
                <input type="hidden" name="id" id="edit_id">
                <div class="form-group">
                    <label>Nom :</label>
                    <input type="text" name="nom" id="edit_nom" required>
                </div>
                <div class="form-group">
                    <label>Prénom :</label>
                    <input type="text" name="prenom" id="edit_prenom" required>
                </div>
                <div class="form-group">
                    <label>GitHub :</label>
                    <input type="text" name="github" id="edit_github">
                </div>
                <div class="form-group">
                    <label>Email :</label>
                    <input type="email" name="email" id="edit_email" required>
                </div>
                <button type="submit" name="modifier_etudiant">💾 Enregistrer les modifications</button>
            </form>
        </div>
    </div>

    <!-- ============================================ -->
    <!-- SECTION JAVASCRIPT                           -->
    <!-- ============================================ -->
    <script>
        /**
         * Ouvre la modale de modification avec les données de l'étudiant
         * @param {number} id - ID de l'étudiant
         * @param {string} nom - Nom de l'étudiant
         * @param {string} prenom - Prénom de l'étudiant
         * @param {string} github - Nom GitHub
         * @param {string} email - Adresse email
         */
        function modifierEtudiant(id, nom, prenom, github, email) {
            // Remplir les champs du formulaire avec les données existantes
            document.getElementById('edit_id').value = id;
            document.getElementById('edit_nom').value = nom;
            document.getElementById('edit_prenom').value = prenom;
            document.getElementById('edit_github').value = github;
            document.getElementById('edit_email').value = email;

            // Afficher la fenêtre modale
            document.getElementById('modalEtudiant').style.display = 'block';
        }

        /**
         * Ferme la fenêtre modale
         */
        function fermerModal() {
            document.getElementById('modalEtudiant').style.display = 'none';
        }

        /**
         * Ferme la modale si l'utilisateur clique en dehors
         */
        window.onclick = function(event) {
            if (event.target == document.getElementById('modalEtudiant')) {
                fermerModal();
            }
        }
    </script>

    <?php
    // Fermeture de la connexion MySQL
    mysqli_close($conn);
    ?>
</body>

</html>