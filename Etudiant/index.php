<?php 
include "config.php";
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Document</title>
    <link rel="stylesheet" href="style.css">
</head>
<body>
    <?php echo"{$message}"; ?>

    <h2>Ajouter un Etudiant</h2>
    <form action="" method="post">
        <label for="1" >Nom</label> <br>
        <input type="text" id="1" name="nom" placeholder="RABESIHARISON" required> <br>

        <label for="2">Prenom</label><br>
        <input type="text" id="2" name="prenom" placeholder="Henri"> <br>

         <label for="3">Age</label> <br>
        <input type="number" id="3" name="age" placeholder="26"> <br>

         <label for="4">Participation</label><br>
         <input type="number" id="4" name="participation" placeholder="2000"> <br>

         <label for="5">Region</label><br>
         <select name="idRegion" id="5">
            <option value="">selectionner un region</option>
            
            <?php 
            $sql = $conn -> prepare("SELECT*FROM region ORDER BY nmReg ASC");
            $sql -> execute();
            $regions = $sql->fetchAll();
            foreach($regions as $region){
                echo"<option value='{$region['id']}'>{$region['nmReg']}</option>";
            }
             ?>
         </select> <br>
         <input type="submit" name="ajouter" value="Ajouter">
    </form> <br>
    <table>
        <thead>
           <tr><th>nom</th> <th>prenom</th> <th>age</th> <th>date_inscription</th> <th>participation </th> <th>Region</th> </tr> 
        </thead>
        <tbody>
            <?php 
               $sql = $conn -> prepare("SELECT etudiant.nom, etudiant.prenom, etudiant.age, etudiant.date_inscription, etudiant.participation , region.nmReg FROM etudiant INNER JOIN region ON etudiant.IdRegion = region.id ");
               $sql-> execute();
               $tabs= $sql->fetchAll();
               foreach($tabs as $tab){
                   echo" <tr><td>{$tab['nom']}</td><td>{$tab['prenom']}</td><td>{$tab['age']}</td><td>{$tab['date_inscription']}</td><td>{$tab['participation']}</td><td>{$tab['nmReg']}</td></tr>";
               }
            ?>
        </tbody>
    </table>
</body>
</html>