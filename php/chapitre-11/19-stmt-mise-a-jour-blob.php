<!DOCTYPE html>
<html xmlns="http://www.w3.org/1999/xhtml" lang="fr">
  <head>
    <meta charset="utf-8" />
    <title>Mise à jour d'une image (requête préparée)</title>
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
    $titre= 'Oracle 12c';
    $fichier_image = '../images/RI12CORAA.jpg';
    // Lecture de contenu du fichier image.
    $image = file_get_contents($fichier_image);
    // Préparation de la requête de mise à jour de l'image.
    $sql = 'UPDATE livre SET couverture = ? ' .
           'WHERE titre = ?';
    $requête = mysqli_prepare($db,$sql);
    $ok = mysqli_stmt_bind_param($requête,'bs',$image,$titre);
    // Envoi des données de l'image.
    $ok = mysqli_stmt_send_long_data($requête,0,$image);
    // Exécution de la requête.
    $ok = mysqli_stmt_execute($requête);
    if ($ok) {
      echo 'Mise à jour terminée avec succès.';
    } else {
      echo 'Erreur lors de la mise à jour.<br />',
           mysqli_stmt_error($requête);
    }
    // Déconnexion.
    $ok = mysqli_close($db);
    ?>

    </div>
  </body>
</html>
