<!DOCTYPE html>
<html xmlns="http://www.w3.org/1999/xhtml" lang="fr">
  <head>
    <meta charset="utf-8" />
    <title>L'opérateur ternaire</title>
  </head>
  <body>
    <div>
    <?php
    // Initialisation d'une variable.
    $nom = '';
    // Affichage d'un message dépendant de la valeur de $nom.
    echo 'Bonjour '.(($nom=='')?'inconnu':$nom).' ! <br />';
    echo 'Bonjour '.($nom?:'inconnu').' ! <br />'; // version 5.3
    // Affectation d'une valeur à la variable $nom.
    $nom = 'Olivier';
    // Nouvelle tentative.
    echo 'Bonjour '.(($nom=='')?'inconnu':$nom).' ! <br />';
    echo 'Bonjour '.($nom?:'inconnu').' ! <br />'; // version 5.3
    ?>
    </div>
  </body>
</html>
