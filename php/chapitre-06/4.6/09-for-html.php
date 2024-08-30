<?php
// Initialiser deux variables.
$numéro = 0;
$nombre = 5;
?>
<!DOCTYPE html>
<html xmlns="http://www.w3.org/1999/xhtml" lang="fr">
  <head>
    <meta charset="utf-8" />
    <title>for (deuxième syntaxe, avec incorporation de code HTML)</title>
  </head>
  <body>
    <form>
       <div>
       Indiquez vos cinq compétences principales :<br />
       <?php // boucle PHP
       for($numéro = 1; $numéro <= $nombre; $numéro++):
       ?>
          <!-- Code HTML -->
          <input type="text" /><br />
       <?php endfor; // fin de la boucle PHP ?>
       <input type="submit" value = "OK" /><br />
       </div>
    </form>
  </body>
</html>
