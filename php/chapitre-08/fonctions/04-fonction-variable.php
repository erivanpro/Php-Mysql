<!DOCTYPE html>
<html xmlns="http://www.w3.org/1999/xhtml" lang="fr">
  <head>
    <meta charset="utf-8" />
    <title>Fonction variable</title>
  </head>
  <body>
    <div>

    <?php
    // Fonction qui effectue un produit.
    function produit($valeur1,$valeur2) {
      return $valeur1 * $valeur2;
    }
    // Fonction qui effectue une somme.
    function somme($valeur1,$valeur2) {
      return $valeur1 + $valeur2;
    }
    // Fonction qui effectue un calcul, le nom du calcul
    //('somme' ou 'produit') étant passé en paramètre.
    function calculer($opération,$valeur1,$valeur2) {
      // $opération contient le nom de la fonction
      // a exécuter => appel $opération().
      return $opération($valeur1,$valeur2);
    }
    // Utilisation de la fonction calculer.
    echo '3 + 5 = ',calculer('somme',3,5).'<br />';
    echo '3 x 5 = ',calculer('produit',3,5).'<br />';
    
    ?>

    </div>
  </body>
</html>
