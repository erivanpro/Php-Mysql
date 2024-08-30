<!DOCTYPE html>
<html xmlns="http://www.w3.org/1999/xhtml" lang="fr">
  <head>
    <meta charset="utf-8" />
    <title>Procédure stockée qui retourne un résultat directement (requête non préparée)</title>
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
    $sql = "CALL ps_lire_sous_rubriques($id_rubrique)";
    $requête = mysqli_query($db,$sql);
    while ($ligne = mysqli_fetch_assoc($requête)) {
      echo $ligne['titre'],'<br />';
    }
    // Déconnexion.
    $ok = mysqli_close($db);
    ?>

    </div>
  </body>
</html>
