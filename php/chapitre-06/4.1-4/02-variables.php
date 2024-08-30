<!DOCTYPE html>
<html xmlns="http://www.w3.org/1999/xhtml" lang="fr">
  <head>
    <meta charset="utf-8" />
    <title>Initialisation et affectation d'une variable</title>
  </head>
  <body>
    <div>
    
    <?php
    // Initialiser une variable $nom.
    $nom = 'Olivier';
    // Afficher la variable $nom.
    echo '$nom = ',$nom,'<br />';
    // Afficher la variable $Nom.
    echo '$<b>N</b>om = ',$Nom;
    echo ' => vide (c\'est une autre variable)<br />';
    // Modifier la valeur (et le type) de la variable $nom.
    $nom = 123;
    // Afficher la variable $nom.
    echo '$nom = ',$nom,'<br />';
    ?>

    </div>
  </body>
</html>