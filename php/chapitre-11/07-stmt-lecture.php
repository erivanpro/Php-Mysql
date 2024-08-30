<!DOCTYPE html>
<html xmlns="http://www.w3.org/1999/xhtml" lang="fr">
  <head>
    <meta charset="utf-8" />
    <title>Requête préparée : lecture</title>
  </head>
  <body>
    <div>

    <?php
    // Connexion et sélection de la base de données.
    $db = mysqli_connect('localhost','eniweb','web','eni');
    if (! $db) {
      exit('Echec de la connexion.');
    }
    // Préparation de la requête.
    $sql = 'SELECT id,titre FROM livre WHERE id_collection = ?';
    $requête = mysqli_prepare($db, $sql);
    // Liaison des paramètres.
    $ok = mysqli_stmt_bind_param($requête,'i',$id_collection);
    // Exécution de la requête.
    $id_collection = 1;
    $ok = mysqli_stmt_execute($requête);
    // Liaison des colonnes du résultat.
    $ok = mysqli_stmt_bind_result($requête,$id,$titre);
    // Lecture du résultat.
    echo "<b>Collection numéro $id_collection</b><br />";
    while (mysqli_stmt_fetch($requête)) {
      echo "$id - $titre<br />";
    }
    // Nouvelle exécution et lecture du résultat
    // (inutile de refaire les liaisons).
    $id_collection = 3;
    $ok = mysqli_stmt_execute($requête);
    echo "<b>Collection numéro $id_collection</b><br />";
    while (mysqli_stmt_fetch($requête)) {
      echo "$id - $titre<br />";
    }
    // Déconnexion.
    $ok = mysqli_close($db);
    ?>
    
    </div>
  </body>
</html>
