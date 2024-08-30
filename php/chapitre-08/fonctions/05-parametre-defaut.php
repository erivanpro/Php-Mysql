<!DOCTYPE html>
<html xmlns="http://www.w3.org/1999/xhtml" lang="fr">
  <head>
    <meta charset="utf-8" />
    <title>Paramètres : valeur par défaut</title>
  </head>
  <body>
    <div>

    <?php
    // Définition d'une constante
    define('UN',1);
    // Définition de la fonction produit avec des valeurs
    // par défaut pour les paramètres (dont une constante
    // pour le premier paramètre).
    function produit($valeur1=UN,$valeur2=2) {
      return $valeur1 * $valeur2;
    }
    // Appels
    // - sans paramètre
    echo 'produit() = ',produit(),'<br />';
    // - avec un seul paramètre = forcément le premier
    echo 'produit(3) = ',produit(3),'<br />';
    ?>
    
    </div>
  </body>
</html>
