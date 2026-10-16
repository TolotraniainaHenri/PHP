========= C’est quoi une session ? ===============

Le protocole HTTP est sans état (stateless) : à chaque requête, le serveur « oublie » qui vous êtes. Si vous vous connectez sur la page login.php, puis allez sur profil.php, le serveur ne sait pas que c’est la même personne.

========= Pour tester ============================

Placez le dossier dans htdocs (XAMPP) ou lancez depuis le dossier :

php -S localhost:8000

puis ouvrez http://localhost:8000/login.php.

================= Explications des points importants 

1. exit; après header('Location: ...')
header() ne stoppe pas le script. Sans exit, le reste du code continue de s’exécuter, ce qui peut afficher une page protégée par erreur.

2. password_hash() et password_verify()
On ne compare jamais un mot de passe en clair avec ===. password_verify() compare le mot de passe saisi avec le hash. Même si password_hash() génère un hash différent à chaque appel, password_verify() fonctionne toujours.

3. session_regenerate_id(true)
Après la connexion, on change l’identifiant de session. Si un pirate connaissait l’ancien ID, il devient inutile. Le true supprime l’ancienne session.

4. $_POST['nom'] ?? ''
L’opérateur ?? évite une erreur si la clé n’existe pas (renvoie '' à la place).

5. htmlspecialchars()
Il empêche l’injection de code HTML/JavaScript (faille XSS) quand on affiche une donnée venant de l’utilisateur.

6. La protection de page

php
if (!isset($_SESSION['nom'])) { header(...); exit; }


Notice: TENA IMPORTANT ITY BRO!
