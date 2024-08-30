<!DOCTYPE html>
<html xmlns="http://www.w3.org/1999/xhtml" lang="fr">
  <head>
    <meta charset="utf-8" />
    <title>Mise à jour d'une image (requête non préparée)</title>
  </head>
  <body>
    <div>

    <?php
    // Connexion et sélection de la base de données.
    $db = mysqli_connect('localhost','eniweb','web','eni');
    if (! $db) {
      exit('Echec de la connexion.');
    }
    // Titre du livre dont il faut charger l'image de couverture
    // et nom du fichier image correspondant.
    $titre= 'PHP 7';
    $fichier_image = '../images/RI7PHP.jpg';
    // Lecture de contenu du fichier image.
    $image = file_get_contents($fichier_image);
    // Protection des caractères spéciaux de l'image.
    $image = mysqli_real_escape_string($db,$image);
    // Exécution d'une requête de mise à jour de l'image.
    $sql = "UPDATE livre SET couverture = '$image' " .
           "WHERE titre = '$titre'";
    $ok = mysqli_query($db,$sql);
    if ($ok) {
      echo 'Mise à jour terminée avec succès.';
    } else {
      echo 'Erreur lors de la mise à jour.<br />',
           mysqli_error($db);
    }
    // Déconnexion.
    $ok = mysqli_close($db);
    ?>

    </div>
  </body>
</html>
