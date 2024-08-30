<!DOCTYPE html>
<html xmlns="http://www.w3.org/1999/xhtml" lang="fr">
  <head>
    <meta charset="utf-8" />
    <title>Chargement des images</title>
  </head>
  <body>
    <div>

    <?php
    // Connexion et sélection de la base de données.
    $db = mysqli_connect('localhost','eniweb','web','eni');
    if (! $db) {
      exit('Echec de la connexion.');
    }
    // Liste des numéro ISBN des livres avec le nom du fichier image 
    // correspondant à leur couverture.
    $livres['978-2-7460-0946-6'] = 'RI56PHP.jpg';
    $livres['978-2-409-01511-3'] = 'RI7PHP.jpg';
    $livres['2-7460-3104-3']     = 'TE5PHPAD.jpg';    
    $livres['978-2-7460-4614-6'] = 'RI11GORAA.jpg';
    $livres['978-2-7460-9116-0'] = 'RI12CORAA.jpg';
    $livres['978-2-409-00255-7'] = 'RI25PH5MY.jpg';
    $livres['978-2-7460-4057-1'] = 'TP5PHMY.jpg';
    $livres['978-2-7460-8852-8'] = 'EP11GORA.jpg';
    $livres['978-2-7460-4159-2'] = 'RIWXIBUSO.jpg';
    $livres['978-2-409-00375-2'] = 'RI57MYSA.jpg';
    $livres['978-2-409-01976-0'] = 'CORI4PHMYSA.jpg';
    // Préparation de la requête de mise à jour de l'image.
    $sql = 'UPDATE livre SET couverture = ? ' .
           'WHERE isbn = ?';
    $requête = mysqli_prepare($db,$sql);
    $ok = mysqli_stmt_bind_param($requête,'bs',$image,$isbn);
    // Parcourir tous les livres.
    foreach ($livres as $isbn => $fichier_image) {
      // Lecture de contenu du fichier image.
      $image = file_get_contents('../images/'.$fichier_image);
     // Envoi des données de l'image.
      $ok = mysqli_stmt_send_long_data($requête,0,$image);
      // Exécution de la requête.
      $ok = mysqli_stmt_execute($requête);
      if ($ok) {
        echo "Mise à jour terminée avec succès ($isbn).<br />";
      } else {
        echo "Erreur lors de la mise à jour ($isbn) : ",
             mysqli_stmt_error($requête);
      }
    }
    // Déconnexion.
    $ok = mysqli_close($db);
    // Un petit rappel.
    echo '<br />Pour que le formulaire de recherche fonctionne, ',
         'n\'oubliez pas de créer l\'index FULLTEXT :<br />',
         '<code># mysql -u root eni<br />',
         'mysql> CREATE FULLTEXT INDEX ix_texte ON livre(titre,sous_titre,description);</code>';
    ?>

    </div>
  </body>
</html>
