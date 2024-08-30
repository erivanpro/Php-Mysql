<!DOCTYPE html>
<html xmlns="http://www.w3.org/1999/xhtml" lang="fr">
  <head>
    <meta charset="utf-8" />
    <title>Procédure stockée qui retourne un résultat directement (requête préparée)</title>
  </head>
  <body>
    <div>

    <?php
    // Connexion et sélection de la base de données.
    $db = mysqli_connect('localhost','eniweb','web','eni');
    if (! $db) {
      exit('Echec de la connexion.');
    }
    // Identifiant de la rubrique parent.
    $id_rubrique = 1;
    // Exécution de la requête d'appel de la procédure.
    $sql = 'CALL ps_lire_sous_rubriques(?)';
    $requête = mysqli_prepare($db,$sql);
    $ok = mysqli_stmt_bind_param($requête,'i',$id_rubrique);
    $ok = mysqli_stmt_execute($requête);
    // Important de faire le bind du résultat après le execute
    // car la structure du résultat n'est pas connue avant.
    $ok = mysqli_stmt_bind_result($requête,$titre);
    while (mysqli_stmt_fetch($requête)) {
      echo $titre,'<br />';
    }
    // Déconnexion.
    $ok = mysqli_close($db);
    ?>

    </div>
  </body>
</html>
