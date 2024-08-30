<!DOCTYPE html>
<html xmlns="http://www.w3.org/1999/xhtml" lang="fr">
  <head>
    <meta charset="utf-8" />
    <title>Requête non préparée : tester les différentes techniques de fetch</title>
  </head>
  <body>
    <div>

    <?php
    // Inclusion du fichier qui contient la définition de
    // la fonction 'afficher_tableau'.
    require('../include/fonctions.inc.php');
    // Connexion (avec sélection de la base de données).
    $db = mysqli_connect('localhost','eniweb','web','eni');
    if (! $db) {
      exit('Echec de la connexion.');
    }
    // Exécution d'une requête
    $sql = 'SELECT id,nom,prix_ht FROM collection LIMIT 4';
    $requête = mysqli_query($db,$sql);
    // Premier fetch avec mysqli_fetch_row.
    $ligne = mysqli_fetch_row($requête);
    afficher_tableau($ligne,'mysql_fetch_row');
    // Deuxième fetch avec mysql_fetch_assoc.
    $ligne = mysqli_fetch_assoc($requête);
    afficher_tableau($ligne,'mysql_fetch_assoc');
    // Troisième fetch avec mysql_fetch_array :
    // -> sans deuxième paramètre = MYSQLI_BOTH
    $ligne = mysqli_fetch_array($requête);
    afficher_tableau($ligne,'mysql_fetch_array');
    // Quatrième fetch avec mysql_fetch_object.
    $ligne = mysqli_fetch_object($requête);
    echo "<p><b>mysql_fetch_object</b><br />";
    echo "\$ligne->id = $ligne->id<br />";
    echo "\$ligne->nom = $ligne->nom<br />";
    echo "\$ligne->prix_ht = $ligne->prix_ht<br /></p>";
    // Cinquième fetch de nouveau avec mysql_fetch_row :
    // -> normalement, plus de ligne.
    $ligne = mysqli_fetch_row($requête);
    if ($ligne === NULL) {
      echo '<p><b>Cinquième fetch : plus rien</b></p>';
    }
    // Déconnexion.
    $ok = mysqli_close($db);
    ?>

    </div>
  </body>
</html>
