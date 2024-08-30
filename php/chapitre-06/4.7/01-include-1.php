<!DOCTYPE html>
<html xmlns="http://www.w3.org/1999/xhtml" lang="fr">
  <head>
    <meta charset="utf-8" />
    <title>include</title>
  </head>
  <body>
    <div>
    
    <?php
    // Inclusion d'un fichier
    include('commun.inc');
    // Déclaration d'une variable $x dans le script principal.
    $x = 1;
    // Affichage de la variable $x.
    echo "Valeur de \$x dans le script principal : $x<br />";
    // Affichage de la variable $y (définie dans le fichier 
    // inclus).
    echo "Valeur de \$y dans le script principal : $y<br />";
    ?>
    
    </div>
  </body>
</html>

