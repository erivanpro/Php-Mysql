<!DOCTYPE html>
<html xmlns="http://www.w3.org/1999/xhtml" lang="fr">
  <head>
    <meta charset="utf-8" />
    <title>Requête non préparée : lecture</title>
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
    $sql = 'SELECT id,titre FROM livre WHERE id_collection = 1';
    $requête = mysqli_query($db,$sql);
    // Lecture du résultat.
    while ($ligne = mysqli_fetch_assoc($requête)) {
      echo $ligne['id'],' - ',$ligne['titre'],'<br />';
    }
    // Déconnexion.
    $ok = mysqli_close($db);
    ?>

    </div>
  </body>
</html>
