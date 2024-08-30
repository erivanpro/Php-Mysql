<!DOCTYPE html>
<html xmlns="http://www.w3.org/1999/xhtml" lang="fr">
  <head>
    <meta charset="utf-8" />
    <title>Variable statique</title>
  </head>
  <body>
    <div>

    <?php
    // Définition d'une fonction
    function variable_statique() {
      // Initialisation d'une variable statique.
      static $variable_statique = 0;
      // Initialisation d'une autre variable.
      $autre_variable = 0;
      // Affichage des deux variables.
      echo "\$variable_statique = $variable_statique <br />";
      echo "\$autre_variable = $autre_variable<br />";
      // Incrémentation des deux variables.
      $variable_statique++;
      $autre_variable++;
    }
    // Premier appel de la fonction.
    echo '<b>Premier appel de la fonction :</b><br />';
    variable_statique();
    // ...
    // Deuxième appel de la fonction.
    echo '<b>Deuxième appel de la fonction :</b><br />';
    variable_statique();
    //...
    // Troisième appel de la fonction.
    echo '<b>Troisième appel de la fonction :</b><br />';
    variable_statique();
    ?>
    
    </div>
  </body>
</html>
