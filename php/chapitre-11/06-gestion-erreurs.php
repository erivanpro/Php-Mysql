<!DOCTYPE html>
<html xmlns="http://www.w3.org/1999/xhtml" lang="fr">
  <head>
    <meta charset="utf-8" />
    <title>Requête non préparée : gestion des erreurs</title>
  </head>
  <body>
    <div>

    <?php 
    // Connexion. 
    $db = mysqli_connect('localhost','eniweb','web'); 
    if (! $db) { 
      exit('Echec de la connexion.'); 
    }  
    // Sélection d'une mauvaise base de données. 
    $ok = mysqli_select_db($db,'hermes'); 
    echo '1 : ',mysqli_errno($db),' - ', 
                mysqli_error($db),'<br />'; 
    // Sélection de la bonne base de données. 
    $ok = mysqli_select_db($db,'eni'); 
    // Requête sur une table qui n'existe pas. 
    $sql = 'SELECT * FROM article'; 
    $requête = mysqli_query($db,$sql); 
    echo '2 : ',mysqli_errno($db),' - ', 
                mysqli_error($db),'<br />'; 
    // Fetch sur un mauvais résultat. 
    $ligne = mysqli_fetch_assoc($requête); 
    echo '3 : ',mysqli_errno($db),' - ', 
                mysqli_error($db),'<br />'; 
    // Requête INSERT qui viole une clé unique.  
    $sql = "UPDATE collection SET nom = 'TechNote' WHERE id = 1"; 
    $requête = mysqli_query($db,$sql); 
    echo '4 : ',mysqli_errno($db),' - ', 
                mysqli_error($db),'<br />'; 
    ?>

    </div>
  </body>
</html>
