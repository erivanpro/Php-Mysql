<!DOCTYPE html>
<html xmlns="http://www.w3.org/1999/xhtml" lang="fr">
  <head>
    <meta charset="utf-8" />
    <title>Requête non préparée : nombre de lignes dans le résultat d'une requête de lecture</title>
  </head>
  <body>
    <div>

    <?php 
    // Connexion (avec sélection de la base de données). 
    $db = mysqli_connect('localhost','eniweb','web','eni'); 
    if (! $db) { 
      exit('Echec de la connexion.'); 
    } 
    // Exécution d'une requête 
    $requête = mysqli_query($db,'SELECT * FROM collection'); 
    if ($requête === FALSE) { 
      echo 'Echec de l\'exécution de la requête'; 
    } else { 
      // Affichage du nombre de lignes dans le résultat 
      echo 'Nombre de collections : ',mysqli_num_rows($requête); 
    } 
    // Déconnexion. 
    $ok = mysqli_close($db); 
    ?>

    </div>
  </body>
</html>
