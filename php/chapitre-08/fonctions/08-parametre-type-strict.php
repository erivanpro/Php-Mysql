<?php
// Activation du typage strict.
declare(strict_types=1);
?>
<!DOCTYPE html>
<html xmlns="http://www.w3.org/1999/xhtml" lang="fr">
  <head>
    <meta charset="utf-8" />
    <title>Paramètres : déclaration du type de données (type strict)</title>
  </head>
  <body>
    <div>

    <?php
    // Déclaration d'une fonction qui affiche la valeur de ses
    // 2 paramètres, le deuxième étant déclaré de type "entier".
    function afficher($valeur1,int $valeur2) {
      echo '$valeur1 => ',var_dump($valeur1),'<br />';
      echo '$valeur2 => ',var_dump($valeur2),'<br />';
    }
    // Appel de la fonction en passant la même valeur réelle
    // aux deux paramètres.
    afficher(20/7,20/7);
    ?>

    </div>
  </body>
</html>
