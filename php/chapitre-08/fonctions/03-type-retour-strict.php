<?php
// Activation du typage strict.
declare(strict_types=1);
?>
<!DOCTYPE html>
<html xmlns="http://www.w3.org/1999/xhtml" lang="fr">
  <head>
    <meta charset="utf-8" />
    <title>Déclaration du type de données de retour (typage strict)</title>
  </head>
  <body>
    <div>

    <?php
    // Déclaration de 2 fonctions qui retournent le produit
    // des 2 paramètres, la deuxième spécifiant un type
    // de données "entier" pour la valeur de retour.
    function produit1($valeur1,$valeur2) {
      return $valeur1 * $valeur2;
    }
    function produit2($valeur1,$valeur2) : int {
      return $valeur1 * $valeur2;
    }
    // Appel des deux fonctions avec les mêmes paramètres
    echo 'produit1(20,1/7) = ',produit1(20,1/7),'<br />';
    echo 'produit2(20,1/7) = ',produit2(20,1/7),'<br />';
    ?>

    </div>
  </body>
</html>
