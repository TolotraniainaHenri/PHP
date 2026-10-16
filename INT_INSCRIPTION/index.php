<?php
error_reporting(E_ALL);
ini_set('display_errors', 1);

// Connexion à MySQL
$conn = mysqli_connect('localhost', 'root', 'VotreMotDePasse', 'musique');

if (!$conn) {
    die("<p style='color:red'>❌ Erreur de connexion : " . mysqli_connect_error() . "</p>");
}

// ========== TRAITEMENT DES FORMULAIRES ==========

// 1. AJOUTER UN ÉTUDIANT
if (isset($_POST['ajouter_etudiant'])) {
    $nom = mysqli_real_escape_string($conn, $_POST['nom']);
    $prenom = mysqli_real_escape_string($conn, $_POST['prenom']);
    $github = mysqli_real_escape_string($conn, $_POST['github']);
    $email = mysqli_real_escape_string($conn, $_POST['email']);
    
    $sql = "INSERT INTO etudiants (nom, prenom, github, email) VALUES ('$nom', '$prenom', '$github', '$email')";
    if (mysqli_query($conn, $sql)) {
        $message = "<p style='color:green; background:#d4edda; padding:10px; border-radius:5px;'>✅ Étudiant ajouté avec succès !</p>";
    } else {
        $message = "<p style='color:red; background:#f8d7da; padding:10px; border-radius:5px;'>❌ Erreur : " . mysqli_error($conn) . "</p>";
    }
}

// 2. MODIFIER UN ÉTUDIANT
if (isset($_POST['modifier_etudiant'])) {
    $id = $_POST['id'];
    $nom = mysqli_real_escape_string($conn, $_POST['nom']);
    $prenom = mysqli_real_escape_string($conn, $_POST['prenom']);
    $github = mysqli_real_escape_string($conn, $_POST['github']);
    $email = mysqli_real_escape_string($conn, $_POST['email']);
    
    $sql = "UPDATE etudiants SET nom='$nom', prenom='$prenom', github='$github', email='$email' WHERE id=$id";
    if (mysqli_query($conn, $sql)) {
        $message = "<p style='color:green; background:#d4edda; padding:10px; border-radius:5px;'>✅ Étudiant modifié avec succès !</p>";
    } else {
        $message = "<p style='color:red; background:#f8d7da; padding:10px; border-radius:5px;'>❌ Erreur : " . mysqli_error($conn) . "</p>";
    }
}

// 3. SUPPRIMER UN ÉTUDIANT
if (isset($_GET['supprimer_etudiant'])) {
    $id = $_GET['supprimer_etudiant'];
    $sql = "DELETE FROM etudiants WHERE id=$id";
    if (mysqli_query($conn, $sql)) {
        $message = "<p style='color:green; background:#d4edda; padding:10px; border-radius:5px;'>✅ Étudiant supprimé avec succès !</p>";
    } else {
        $message = "<p style='color:red; background:#f8d7da; padding:10px; border-radius:5px;'>❌ Erreur : " . mysqli_error($conn) . "</p>";
    }
}
?>

<!DOCTYPE html>
<html lang="fr">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>INT - Gestion des étudiants</title>
    <style>
        * {
            margin: 0;
            padding: 0;
            box-sizing: border-box;
        }
        
        body {
            font-family: 'Segoe UI', Tahoma, Geneva, Verdana, sans-serif;
            min-height: 100vh;
            padding: 20px;
            position: relative;
        }
        
        /* ========== FOND BICOLORE OBLIQUE ========== */
        /* Calque 1 : Fond bleu dégradé (arrière-plan complet) */
        body::before {
            content: "";
            position: fixed;
            top: 0;
            left: 0;
            width: 100%;
            height: 100%;
            z-index: -2;
            background: linear-gradient(135deg, #1e3c72 0%, #2a5298 100%);
        }
        
        /* Calque 2 : Image de l'université avec découpe diagonale */
        body::after {
            content: "";
            position: fixed;
            top: 0;
            left: 0;
            width: 100%;
            height: 100%;
            z-index: -1;
            /* REMPLACEZ CE CHEMIN PAR LE VOTRE */
            background-image: url('uploads/universite.jpg');
            background-size: cover;
            background-position: center;
            background-repeat: no-repeat;
            /* Découpe en diagonale (oblique) - l'image occupe la partie droite */
            clip-path: polygon(45% 0%, 100% 0%, 100% 100%, 35% 100%);
        }
        
        /* Variante : diagonale inverse (image à gauche) - décommentez pour tester */
        /*
        body::after {
            clip-path: polygon(0% 0%, 55% 0%, 100% 100%, 0% 100%);
        }
        */
        
        .container {
            max-width: 1200px;
            margin: 0 auto;
            position: relative;
            z-index: 1;
        }
        
        h1 {
            text-align: center;
            color: white;
            margin-bottom: 10px;
            font-size: 2.5em;
            text-shadow: 2px 2px 4px rgba(0,0,0,0.5);
        }
        
        .subtitle {
            text-align: center;
            color: rgba(255,255,255,0.9);
            margin-bottom: 30px;
            font-size: 1.1em;
        }
        
        .message {
            margin-bottom: 20px;
        }
        
        .grid {
            display: grid;
            grid-template-columns: 1fr 1fr;
            gap: 30px;
            margin-bottom: 30px;
        }
        
        .card {
            background: rgba(255, 255, 255, 0.95);
            border-radius: 15px;
            padding: 25px;
            box-shadow: 0 10px 30px rgba(0,0,0,0.2);
            backdrop-filter: blur(2px);
        }
        
        .card h2 {
            color: #1e3c72;
            margin-bottom: 20px;
            padding-bottom: 10px;
            border-bottom: 3px solid #2a5298;
        }
        
        .form-group {
            margin-bottom: 15px;
        }
        
        label {
            display: block;
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
        }
        
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
            box-shadow: 0 5px 15px rgba(0,0,0,0.2);
        }
        
        .table-container {
            background: rgba(255, 255, 255, 0.95);
            border-radius: 15px;
            padding: 25px;
            box-shadow: 0 10px 30px rgba(0,0,0,0.2);
            overflow-x: auto;
            backdrop-filter: blur(2px);
        }
        
        table {
            width: 100%;
            border-collapse: collapse;
        }
        
        th {
            background: linear-gradient(135deg, #1e3c72 0%, #2a5298 100%);
            color: white;
            padding: 12px;
            text-align: left;
        }
        
        td {
            padding: 12px;
            border-bottom: 1px solid #ddd;
            background: rgba(255,255,255,0.9);
        }
        
        tr:hover td {
            background: #f5f5f5;
        }
        
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
        
        .btn-modifier:hover, .btn-supprimer:hover, .btn-github:hover {
            opacity: 0.8;
            transform: none;
        }
        
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
        
        .modal {
            display: none;
            position: fixed;
            top: 0;
            left: 0;
            width: 100%;
            height: 100%;
            background: rgba(0,0,0,0.5);
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
        
        .close:hover {
            color: #333;
        }
        
        @media (max-width: 768px) {
            .grid {
                grid-template-columns: 1fr;
            }
        }
    </style>
</head>
<body>
<div class="container">
    <h1>🎓 Promotion Innovation et Technologie (INT)</h1>
    <div class="subtitle">Gestion des étudiants - 2025/2026</div>
    
    <?php if(isset($message)) echo "<div class='message'>$message</div>"; ?>
    
    <!-- Statistiques -->
    <div class="stats">
        <?php
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
        
        <!-- Petit guide -->
        <div class="card">
            <h2>📖 Guide rapide</h2>
            <ul style="margin-left: 20px; line-height: 1.8;">
                <li>🔹 <strong>Ajouter</strong> : Remplissez le formulaire et cliquez sur "Ajouter"</li>
                <li>🔹 <strong>Modifier</strong> : Cliquez sur le bouton "Modifier" dans la liste</li>
                <li>🔹 <strong>Supprimer</strong> : Cliquez sur "Supprimer" (confirmation demandée)</li>
                <li>🔹 <strong>GitHub</strong> : Le lien GitHub s'ouvre dans un nouvel onglet</li>
            </ul>
            <br>
            <p style="color: #666; font-size: 14px;">💡 Astuce : Les emails doivent être uniques dans la base.</p>
        </div>
    </div>
    
    <!-- Liste des étudiants -->
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
                $result = mysqli_query($conn, "SELECT * FROM etudiants ORDER BY nom, prenom");
                if (mysqli_num_rows($result) > 0) {
                    while($row = mysqli_fetch_assoc($result)) {
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
                    echo "<tr><td colspan='6' style='text-align:center; padding:40px;'>📭 Aucun étudiant pour le moment. Ajoutez-en via le formulaire !</td></tr>";
                }
                ?>
            </tbody>
        </table>
    </div>
</div>

<!-- MODAL POUR MODIFIER -->
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

<script>
    function modifierEtudiant(id, nom, prenom, github, email) {
        document.getElementById('edit_id').value = id;
        document.getElementById('edit_nom').value = nom;
        document.getElementById('edit_prenom').value = prenom;
        document.getElementById('edit_github').value = github;
        document.getElementById('edit_email').value = email;
        document.getElementById('modalEtudiant').style.display = 'block';
    }
    
    function fermerModal() {
        document.getElementById('modalEtudiant').style.display = 'none';
    }
    
    window.onclick = function(event) {
        if (event.target == document.getElementById('modalEtudiant')) {
            fermerModal();
        }
    }
</script>

<?php mysqli_close($conn); ?>
</body>
</html>