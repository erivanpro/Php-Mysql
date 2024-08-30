<!DOCTYPE html>
<html xmlns="http://www.w3.org/1999/xhtml" lang="fr">
  <head>
    <meta charset="utf-8" />
    <title>for (première syntaxe)</title>
    <style>
      h1 { font-family: verdana,arial,helvetica,sans-serif ; font-size: 100% ; margin-top: 20pt }
    </style>
  </head>
  <body>
    <div>
    
    <h1>Exemple 1</h1>
    <?php
    // Utilisation de la structure for pour parcourir un tableau
    // à indices entiers consécutifs
    // Initialisation du tableau.
    $couleurs = array('bleu','blanc','rouge');
    $nombre = 3;
    // Boucle utilisant un indice $i qui démarre à 0 ($i = 0) 
    // qui est incrémenté d'une unité à chaque itération ($i++) ;
    // la boucle se poursuite tant que l'indice est inférieur au 
    // nombre d'éléments présents dans le tableau ($i < $nombre).
    for ($i = 0; $i < $nombre; $i++) {
      echo "$couleurs[$i]<br />";
    }
    ?>
    
    <h1>Exemple 2</h1>
    <?php
    // tout se passe dans l'instruction for !
    for
      (
      // première itération : initialisation d'un indice $i à 1
      // et d'une variable $total à 0
      $i = 1,$total = 0;
      // condition d'arrêt de la boucle : $i = 5
      $i <= 5;
      // à chaque itération : incrémentation de $total avec le
      // valeur courante de $i puis stockage dans un tableau de
      // la valeur courante de $i juste avant de l'incrémenter
      $total += $i,$nombres[] = $i++
      );
    // à la sortie de la boucle, le tableau contient la liste des
    // cinq premier entiers, et la variable $total la somme des
    // cinq premiers entiers
    // il ne reste plus qu'à afficher tout cela ...
    echo implode($nombres,'+')."=$total";
    ?>

    </div>
  </body>
</html>

