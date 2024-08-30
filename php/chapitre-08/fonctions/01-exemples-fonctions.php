<!DOCTYPE html>
<html xmlns="http://www.w3.org/1999/xhtml" lang="fr">
  <head>
    <meta charset="utf-8" />
    <title>Exemples de fonctions</title>
  </head>
  <body>
    <div>

    <?php
    // Fonction sans paramètre qui affiche "Bonjour !"
    // Pas de valeur de retour.
    function afficher_bonjour() {
      echo 'Bonjour !<br />';
    }
    // Fonction avec 2 paramètres qui retourne le produit
    // des deux paramètres.
    function produit($valeur1,$valeur2) {
      return $valeur1 * $valeur2;
    }
    // Appel de la fonction afficher_bonjour
    afficher_bonjour();
    // Utilisations de la fonction produit :
    // - dans une affectation
    $résultat = produit(2,4);
    echo "2 x 4 = $résultat<br />";
    // - dans une comparaison
    if (produit(10,12) > 100) {
      echo '10 x 12 est supérieur à 100.<br />';
    }
    // Fonction avec 3 paramètres qui retourne la somme
    // des 3 paramètres.
    function somme($valeur1,$valeur2,$valeur3) {
      return $valeur1 + $valeur2 + $valeur3;
    }
    // Transformation du contenu d'un tableau en 
    // liste de paramètres (apparu en version 5.6).
    $valeurs = [1,2,3];
    echo '1 + 2 + 3 = ',somme(...$valeurs),'<br />';
    // La même chose pour une partie seulement des paramètres
    // avec un tableau défini directement dans l'appel.
    echo '1 + 2 + 4 = ',somme(1,...[2,4]),'<br />';
    // Définition d'une fonction qui retourne un tableau. 
    function qui() {
      return ['Olivier','Heurtel'];
    }
    // Appel de la fonction et récupération directe du prénom stocké
    // à l'indice 0 du tableau retourné.
    $prénom = qui()[0];
    echo "qui()[0] = $prénom<br />";
    ?>

    </div>
  </body>
</html>
