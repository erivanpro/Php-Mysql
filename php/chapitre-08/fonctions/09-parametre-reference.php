<!DOCTYPE html>
<html xmlns="http://www.w3.org/1999/xhtml" lang="fr">
  <head>
    <meta charset="utf-8" />
    <title>Paramètres : passage par référence</title>
  </head>
  <body>
    <div>

    <?php
    // Définition d'une fonction qui prend deux paramètres :
    // un passé par valeur et l'autre par référence.
    function une_fonction($par_valeur,&$par_référence) {
      // Incrémentation des deux paramètres.
      $par_valeur++;
      $par_référence++;
      // Affichage des deux paramètres à l'intérieur 
      // de la fonction.
      echo "\$par_valeur = $par_valeur<br />";
      echo "\$par_référence = $par_référence<br />";
    }
    
    // Initialisation de deux variables.
    $x = 1;
    $y = 10;
    // Affichage des variables avant l'appel à la fonction.
    echo "\$x avant appel = $x<br />";
    echo "\$y avant appel = $y<br />";
    // Appel de la fonction en utilisant les deux variables comme
    // valeur des paramètres.
    une_fonction($x,$y);
    // Affichage des variables après l'appel à la fonction.
    echo "\$x après appel = $x<br />";
    echo "\$y après appel = $y<br />";
    ?>
    
    </div>
  </body>
</html>
