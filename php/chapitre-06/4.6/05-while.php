<!DOCTYPE html>
<html xmlns="http://www.w3.org/1999/xhtml" lang="fr">
  <head>
    <meta charset="utf-8" />
    <title>while (première syntaxe)</title>
  </head>
  <body>
    <div>
    
    <?php
    // Initialiser deux variables.
    $nom = 'OLIVIER';
    $longueur = 7;
    // Initialiser un indice.
    $indice = 0;
    // Tant que l'indice est inférieur à la longueur de la chaîne
    while ($indice < $longueur) {
      // Afficher le caractère correspondant à l’indice suivi 
      // d'un point.
      echo "$nom[$indice].";
      // Incrémenter l'indice
      $indice++;
    }
    ?>
    
    </div>
  </body>
</html>

