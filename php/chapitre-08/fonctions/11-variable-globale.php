<!DOCTYPE html>
<html xmlns="http://www.w3.org/1999/xhtml" lang="fr">
  <head>
    <meta charset="utf-8" />
    <title>Variable locale / globale</title>
  </head>
  <body>
    <div>

    <?php
    // Objectif : écrire une fonction qui effectue le produit 
    //            des variables $x et $y et qui stocke le résultat
    //            dans la variable $z.
    // Initialisation de deux variables dans le script appelant. 
    $x = 2;
    $y = 5;
    echo '<b>Cas 1 : pas d\'utilisation des variables ',
         'globales</b><br />';
    function produit1() {
      // $x et $y sont vides à l'intérieur de la fonction.
      echo "\$x = $x<br />";
      echo "\$y = $y<br />";
      $z = 0 + $x * $y;
    }
    produit1();
    // $z est vide dans le script principal.
    echo "\$z = $z<br />";
    // Résolution du problème en utilisant des variables globales :
    // - avec le mot clé global pour $x et $y
    // - avec le tableau $GLOBALS pour $z
    echo '<b>Cas 2 : utilisation des variables globales</b><br />';
    function produit2() {
      global $x, $y;
      echo "\$x = $x<br />";
      echo "\$y = $y<br />";
      $GLOBALS['z'] = 0 + $x * $y;
    }
    produit2();
    echo "\$z = $z<br />";
    ?>
    
    </div>
  </body>
</html>
