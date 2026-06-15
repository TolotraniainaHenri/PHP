
<?php 
   include "config.php"; 
?>
<!doctype html>
<html lang="en">
  <head>
    <meta charset="UTF-8" />
    <meta name="viewport" content="width=device-width, initial-scale=1.0" />
    <title><Artiste-Mada2026></Artiste-Mada2026></title>
    <link rel="stylesheet" href="style.css" />
  </head>
  <body>
    <div class="titre">
      <h2>LES STARTS DE MADA</h2>
    </div>
    <div class="message"><?php echo $message; ?></div>
    <div class="ligne">
      <div class="colonne1">
        <h2>Ajouter un artiste</h2>
        <form method="post">
          <div class="input-box">
            <input type="text" id="nom1" name="nom" />
            <label for="nom1">Nom</label>
          </div>
          <div class="input-box">
            <input type="text" id="lieu1" name="lieu" />
            <label for="lieu1">Lieu</label>
          </div>
          <div class="input-box">
            <input type="submit" id="submit"  name="Ajouter_un_artiste" value="Ajouter un artiste" />
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
              <option id="a2" value="">Seletionner un artiste</option>
              <?php
              $sql="SELECT*FROM Artiste order by nom";
              $result=mysqli_query($conn,$sql);
              while($artiste=mysqli_fetch_assoc($result))
                {
                  echo "<option value='{$artiste['IdArtiste']}'>{$artiste['Nom']}</option>";
                  }
                  ?> 
               <label for="a2">Artiste:</label>
            </select>
          </div>
          <div class="input-box">
            <input type="submit" id="submit" name="ajouter_un_album" value="Ajouter un album" />
          </div>
        </form>
      </div>
    </div>
    <div class="liste"><h2>Liste des Artistes</h2></div>
    <div class="table1">
        <table>
          <thead>
            <tr>
              <th>IdArtiste</th>
              <th>Nom</th>
              <th>lieu</th>
            </tr>
          </thead>
          <tbody>
            <?php 
            $sql="SELECT*FROM Artiste order by Nom";
            $result=mysqli_query($conn,$sql);
            while($artiste=mysqli_fetch_assoc($result))
              {
                echo "<tr><td>{$artiste['IdArtiste']}</td><td>{$artiste['Nom']}</td><td>{$artiste['Lieu']}</td></tr>";
              };
            ?>
          </tbody>
        </table>
      </div>
    </div>
    <div class="liste"><h2>Liste des Albums </h2></div>
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
          $sql = "SELECT*FROM Album ORDER BY Titre";
          $result = mysqli_query($conn,$sql);
          while($Album = mysqli_fetch_assoc($result))
            {
              echo"<tr></tbody><td>{$Album['IdAlbum']}</td><td>{$Album['Titre']}</td><td>{$Album['Annee']}</td><td>{$Album['IdArtiste']}</td>";
              echo"<td classe='iconne'>";
              echo"<a href='voir.php?id='{$Album['IdAlbum']}'><img src='./icone/regarde.png' alt='Voir'></a>";
              echo"<a href='modifier.php?id={$Album['IdAlbum']}'><img src='./icone/modifier.png' alt='Modifier'></a>";
              echo"<a href='supprimer.php?id={$Album['IdAlbum']}''><img src='./icone/supr.png' alt='Supprimer'></a></td></tr>";
            }
          ?>
      </table>
    </div>
    <?php mysqli_close($conn) ?>
  </body>
</html>
