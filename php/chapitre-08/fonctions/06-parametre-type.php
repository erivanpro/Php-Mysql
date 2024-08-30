<!DOCTYPE html>
<html xmlns="http://www.w3.org/1999/xhtml" lang="fr">
  <head>
    <meta charset="utf-8" />
    <title>Paramètres : déclaration du type de données</title>
    <style>
      h1 { font-family: verdana,arial,helvetica,sans-serif ; font-size: 100% ; margin-top: 20pt }
    </style>
  </head>
  <body>
    <div>

    <h1>Paramètre de type scalaire (possible depuis la version 7)</h1>
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

    <h1>Paramètre de type tableau (possible avant la version 7)</h1>
    <?php
    // Déclaration d'une fonction qui accepte uniquement un  
    // paramètre de type "tableau".
    function taille(array $tableau) {
      return count($tableau); 
    }
    // Appel de cette fonction une première fois avec un bon
    // type de données et une deuxième fois avec un type de 
    // données incorrect.
    echo 'taille([1,2,3]) = ',taille([1,2,3]),'<br />';
    echo 'taille(NULL) = ',taille(NULL),'<br />';
    ?>

    </div>
  </body>
</html>
