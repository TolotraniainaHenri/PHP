<?php
include('config.php');
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Modifier  un Album</title>
    <link rel="stylesheet" href="style1.css">
</head>
<body>
    <div class="container">
        <div class="Texte"> 
        
           <h3>Modifier un album</h3>
        </div>
          <form method='post'>
            <div class='btn'>
                <label for='1'>IdAlbum:</label>
              <?php
          //if(isset($_GET['id'])){

            $id=(int)$_GET['id'];
            $sql=$conn->prepare("SELECT*FROM Album WHERE IdAlbum= ?");
            $sql->execute([$id]);
            $sql->fetchAll();
            //foreach($sql as $Album)
               // {
                   echo" <input type='number' id='1' name='idAlbum' value='{$Album['IdAlbum']}'>";
            echo"</div>";
            echo" <div class='btn'>";
                echo"  <label for='1'>Titre:</label>";
                 echo" <input type='text' id='1' name='titre' value='{$Album['Titre']}' required>";
             echo" </div>";
             echo" <div class='btn'>";
                echo"  <label for='2'>Annee de sortie:</label>";
                 echo" <input type='text' id='2' name='annee' value='{$Album['Annee']}'>";
             echo"</div>";
                //}
            // }  
            ?>
             <div class="btn">
                <label for="2">Artiste: </label>
               <select name="artiste" id="3" required>
                  <option value=''>Selectionner un artiste</option>
                <?php
                 $albums=$conn->prepare("SELECT*FROM Artiste ORDER BY Nom");
                 $albums->execute();
                 $lines=$albums->fetchAll();
                 foreach( $lines as $line)
                    {
                     echo"<option value='{$line['IdArtiste']}'>{$line['Nom']}</option>";
                    }
                 ?> 
                   </select>
             </div >
              <?php echo"{$message}"; ?>
            <div class="ligne">
                <input type="submit" name="modifier_album" value="Modifier">
                <a href="index.php"><div class="bouton">Retour</div></a>
            </div>
           </form>
          
    </div> 
</body>
</html>