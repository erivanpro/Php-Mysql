<!DOCTYPE html>
<html xmlns="http://www.w3.org/1999/xhtml" lang="fr">
  <head>
    <meta charset="utf-8" />
    <title>Gestion des apostrophes (solution)</title>
  </head>
  <body>
    <div>

    <?php 
    // Donnée corrigée. 
    $nom = "L\'Atout Réussite"; 
    $prix_ht = 10; 
    // Requête d'insertion. 
    $sql = "INSERT INTO collection(nom,prix_ht) " . 
           "VALUES('$nom',$prix_ht)"; 
    echo $sql,'<br />'; 
    // Exécution. 
    $db = mysqli_connect('localhost','eniweb','web','eni'); 
    $requête = mysqli_query($db,$sql); 
    echo mysqli_error($db),'<br />';  
    $ok = mysqli_close($db); 
    ?>

    </div>
  </body>
</html>
