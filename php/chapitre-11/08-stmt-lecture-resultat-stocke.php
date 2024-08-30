<!DOCTYPE html>
<html xmlns="http://www.w3.org/1999/xhtml" lang="fr">
  <head>
    <meta charset="utf-8" />
    <title>Requête préparée : lecture avec résultat stocké</title>
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
    echo '<b>Avant appel à mysqli_stmt_store_result</b><br />',
         'Nombre de lignes sélectionnées = ',
         mysqli_stmt_num_rows($requête),'<br />';
    $ok = mysqli_stmt_store_result($requête);
    echo '<b>Après appel à mysqli_stmt_store_result</b><br />',
         'Nombre de lignes sélectionnées = ',
         mysqli_stmt_num_rows($requête),'<br />';
    // Lecture du résultat.
    echo "<b>Collection numéro $id_collection</b><br />";
    while (mysqli_stmt_fetch($requête)) {
      echo "$id - $titre<br />";
    }
    // Libération du résultat.
    mysqli_stmt_free_result($requête);
    // Déconnexion.
    $ok = mysqli_close($db);
    ?>

    </div>
  </body>
</html>
