<?php 
include('config.php');

?>
<!doctype html>
<html lang="en">
  <head>
    <meta charset="UTF-8" />
    <meta name="viewport" content="width=device-width, initial-scale=1.0" />
    <title>Artiste-Mada</title>
    <link rel="stylesheet" href="style.css" />
  </head>
  <body>
    <div class="titre">
      <h2>LES STARS DE MADA</h2>
    </div>
    <div class="message">
      <?php
      echo $message; 
       ?>
    </div>
    <div class="ligne">
      <div class="colonne1">
        <h2>Ajouter un artiste</h2>
        <form method="post">
          <div class="input-box">
            <input type="text" id="nom1" name="nom" />
            <label for="nom1">Nom:</label>
          </div>
          <div class="input-box">
            <input type="text" id="lieu1" name="lieu" />
            <label for="lieu1">Lieu:</label>
          </div>
          <div class="input-box">
            <input type="submit" id="submit" name="Ajouter_un_artiste" value="Ajouter un artiste" />
          </div>
        </form>
      </div>
      <div class="colonne2">
        <h2>Ajouter un album</h2>
        <form method="post">
          <div class="input-box">
            <input type="text" id="t1" name="titre" />
            <label for="t1">Titre: </label>
          </div>
          <div class="input-box">
            <input type="text" id="a1" name="annee_de_sortie"/>
            <label for="a1">Annee de sortie:</label>
          </div>
          <div class="input-box">
            <select name="idArtiste" required>
              <option value="">Sélectionner un artiste</option>
              <?php 
              $artistes=$conn->prepare("SELECT*FROM Artiste ORDER BY Nom");
              $artistes->execute();
              $ArtistesTable=$artistes->fetchAll(PDO::FETCH_ASSOC);
              foreach( $ArtistesTable as $artiste)
                {
                  echo" <option value='{$artiste['IdArtiste']}'>{$artiste['Nom']}</option>";
                }
              ?>
            </select>
            <label for="a2">Artiste:</label>
          </div>
          <div class="input-box">
            <input type="submit" name="ajouter_un_album" value="Ajouter un album" />
          </div>
        </form>
      </div>
    </div>
    <div class="liste">
      <h2>Liste des Artistes</h2>
    </div>
    <div class="table1">
      <table>
        <thead>
          <tr>
            <th>IdArtiste</th>
            <th>Nom</th>
            <th>Lieu</th>
          </tr>
        </thead>
        <tbody>
          <?php 
          $artistes=$conn->prepare("SELECT*FROM Artiste ORDER BY Nom");
          $artistes->execute();
          $artistesTable=$artistes->fetchAll(PDO::FETCH_ASSOC);
          foreach ($artistesTable as $artiste)
            {  
            echo"<tr><td>{$artiste['IdArtiste']}</td><td>{$artiste['Nom']}</td><td>{$artiste['Lieu']}</td></tr>";
            }
          ?>
        </tbody>
      </table>
    </div>
    <div class="liste"><h2>Liste des Albums</h2></div>
    <div class="table2">
      <table>
        <thead>
          <tr>
            <th>IdAlbum</th>
            <th>Titre</th>
            <th>Annee</th>
            <th>IdArtiste</th>
            <th>Option</th>
          </tr>
        </thead>
        <tbody>
         <?php
          $albums=$conn->prepare("SELECT*FROM Album ORDER BY Titre");
          $albums->execute();
          $albumsTable=$albums->fetchAll(PDO::FETCH_ASSOC);
          foreach ( $albumsTable as $album){
            echo"<tr><td>{$album['IdAlbum']}</td><td>{$album['Titre']}</td><td>{$album['Annee']}</td><td>{$album['IdArtiste']}</td>";
            echo"<td class='iconne'>";
            echo"<a href='voir.php?id={$album['IdAlbum']}'><img src='./iconne/regarde.png' alt='Voir'></a>";
            echo"<a href='modifier.php?id={$album['IdAlbum']}'><img src='./iconne/modifier.png' alt='Modifier'></a>";
            echo"<a href='?idSuprim={$album['IdAlbum']}' onclick='return confirm(\"Hamafa  Album ?\")'><img src='./iconne/supr.png' alt='Supprimer'></a></td></tr>";
          }
          ?>
        </tbody>
      </table>
    </div>
  </body>
</html>