<!DOCTYPE html>
<html xmlns="http://www.w3.org/1999/xhtml" lang="fr">
  <head>
    <meta charset="utf-8" />
    <title>Fonction stockée (requête préparée)</title>
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
    // Exécution de la requête qui appelle la fonction
    // (l'expression qui appelle la fonction est nommée avec
    // un alias de colonne).
    $sql = 'SELECT fs_nombre_sous_rubriques(?) nb';
    $requête = mysqli_prepare($db,$sql);
    $ok = mysqli_stmt_bind_param($requête,'i',$id_rubrique);
    $ok = mysqli_stmt_execute($requête);
    $ok = mysqli_stmt_bind_result($requête,$nb);
    $ok = mysqli_stmt_fetch($requête);
    echo 'Nombre de sous-rubriques = ',$nb;
    // Déconnexion.
    $ok = mysqli_close($db);
    ?>

    </div>
  </body>
</html>
