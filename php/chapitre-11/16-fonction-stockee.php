<!DOCTYPE html>
<html xmlns="http://www.w3.org/1999/xhtml" lang="fr">
  <head>
    <meta charset="utf-8" />
    <title>Fonction stockée (requête non préparée)</title>
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
    $sql = "SELECT fs_nombre_sous_rubriques($id_rubrique) nb";
    $requête = mysqli_query($db,$sql);
    $ligne = mysqli_fetch_assoc($requête);
    echo 'Nombre de sous-rubriques = ',$ligne['nb'];
    // Déconnexion.
    $ok = mysqli_close($db);
    ?>

    </div>
  </body>
</html>
