<!DOCTYPE html>
<html xmlns="http://www.w3.org/1999/xhtml" lang="fr">
  <head>
    <meta charset="utf-8" />
    <title>Requêtes préparées et apostrophes</title>
  </head>
  <body>
    <div>

    <?php 
    // Donnée qui pose problème (peut être saisie innocemment  
    // dans un formulaire). 
    $nom = "L'Atout Réussite +"; 
    $prix_ht = 10; 
    // Requête d'insertion. 
    $sql = 'INSERT INTO collection(nom,prix_ht) VALUES(?,?)';  
    // Exécution. 
    $db = mysqli_connect('localhost','eniweb','web','eni'); 
    $requête = mysqli_prepare($db,$sql); 
    $ok = mysqli_stmt_bind_param($requête,'sd',$nom,$prix_ht); 
    $ok = mysqli_execute($requête); 
    if ($ok) { 
      echo mysqli_stmt_affected_rows($requête), 
          ' collection insérée<br />';  
    } else { 
      echo mysqli_stmt_error($requête),'<br />';  
    } 
    $ok = mysqli_close($db); 
    ?>

    </div>
  </body>
</html>
