<!DOCTYPE html>
<html xmlns="http://www.w3.org/1999/xhtml" lang="fr">
  <head>
    <meta charset="utf-8" />
    <title>Paramètres : liste variable de paramètres</title>
    <style> 
      h1 { font-family: verdana,arial,helvetica,sans-serif ; font-size: 100% ; margin-top: 20pt } 
    </style> 
  </head>
  <body>
    <div>

    <h1>Première méthode</h1>  
    <?php
    // Fonction qui accepte un premier paramètre par référence 
    // et qui y stocke le produit de tous les autres paramètres.
    function produit(&$résultat) {
      switch (func_num_args()) {
        case 1: 
          // Un seul paramètre (la variable pour le résultat)
          // Retourner 0 (choix arbitraire).
          $résultat = 0;
          break;
        default: 
          // Récupérer les paramètres dans un tableau
          // et supprimer le premier élément (le premier
          // paramètre).
          $paramètres = func_get_args();
          unset($paramètres[0]);
          // Initialiser le résultat à 1
          $résultat = 1;
          // Faire une boucle sur le tableau des paramètres
          // pour multiplier le résultat par le paramètre.
          foreach($paramètres as $paramètre) {
            $résultat *= $paramètre;
          }
          break;
      }
    }
    // appels
    produit($résultat);
    echo 'produit($résultat) => ',$résultat,'<br />';
    produit($résultat,1,2,3);
    echo 'produit($résultat,1,2,3) => ',$résultat,'<br />';
    ?>

    <h1>Deuxième méthode</h1>  
    <?php
    // Fonction qui accepte un premier paramètre par référence 
    // et qui y stocke la somme de tous les autres paramètres.
    function somme(&$résultat,...$valeurs) {
      $résultat = 0;
      foreach ($valeurs as $valeur) {
        $résultat += $valeur;
      }
    }
    // appels
    somme($résultat);
    echo 'somme($résultat) => ',$résultat,'<br />';
    somme($résultat,1,2,3,4);
    echo 'somme($résultat,1,2,3,4) => ',$résultat,'<br />';
    $valeurs = [1,2,4,8];
    somme($résultat,...$valeurs);
    echo 'somme($résultat,...[1,2,4,8]) => ',$résultat,'<br />';
    ?>
    
    </div>
  </body>
</html>
