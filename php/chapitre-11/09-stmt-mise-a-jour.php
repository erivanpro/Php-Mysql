<!DOCTYPE html>
<html xmlns="http://www.w3.org/1999/xhtml" lang="fr">
  <head>
    <meta charset="utf-8" />
    <title>Requête préparée : mise à jour</title>
  </head>
  <body>
    <div>

    <?php
    // Connexion et sélection de la base de données.
    $db = mysqli_connect('localhost','eniweb','web','eni');
    if (! $db) {
      exit('Echec de la connexion.');
    }
    // Préparation de la requête (UPDATE).
    $sql = 'UPDATE collection SET frais_ht = ? ' . 
           'WHERE frais_ht IS NULL';
    $requête = mysqli_prepare($db, $sql);
    // Liaison des paramètres.
    $ok = mysqli_stmt_bind_param($requête,'d',$frais_ht);
    // Exécution de la requête.
    $frais_ht = 1;
    $ok = mysqli_stmt_execute($requête);
    echo 'Nombre de collection(s) modifiée(s) = ',
         mysqli_stmt_affected_rows ($requête),'<br />';
    // Préparation de la requête (INSERT).
    $sql = 'INSERT INTO collection(nom) VALUES(?)';
    $requête = mysqli_prepare($db, $sql);
    // Liaison des paramètres.
    $ok = mysqli_stmt_bind_param($requête,'s',$nom);
    // Exécution de la requête.
    $nom = 'Solution Informatiques';
    $ok = mysqli_stmt_execute($requête);
    echo 'Identifiant de la nouvelle collection = ',
         mysqli_stmt_insert_id($requête),'<br />';
    // Déconnexion.
    $ok = mysqli_close($db);
    ?>
    
    </div>
  </body>
</html>
