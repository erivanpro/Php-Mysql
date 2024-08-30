<!DOCTYPE html>
<html xmlns="http://www.w3.org/1999/xhtml" lang="fr">
  <head>
    <meta charset="utf-8" />
    <title>Générer la totalité du formulaire</title>
  </head>
  <body>
    <div>

    <?php
    // Tableau contenant la description du formulaire.
    $formulaire = array(
      array('Nom : ','text','nom','HEURTEL'),
      array('','submit','ok','OK') );
    // Génération du formulaire à l'aide d'une boucle
    // sur le tableau.
    echo '<form action="00-a-faire.php" method="POST">';
    foreach($formulaire as $zone) {
      echo "$zone[0]<input type=\"$zone[1]\" ", 
           "name=\"$zone[2]\" value=\"$zone[3]\" /><br />";
    }
    echo '</form>';
    ?>

    </div>
  </body>
</html>
