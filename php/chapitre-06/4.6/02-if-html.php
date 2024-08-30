<?php
// Un peu d'aléatoire pour définir les variables $nom et $âge.
$nom = rand(0,1)?'Olivier':NULL;
$âge = rand(0,1)?rand(7,77):NULL;
?>
<!DOCTYPE html>
<html xmlns="http://www.w3.org/1999/xhtml" lang="fr">
  <head>
    <meta charset="utf-8" />
    <title>if (deuxième syntaxe, avec incorporation de code HTML)</title>
    <style type="text/css" media="all">
      .ko {font-weight: bold; color: red;}
      .ok {font-weight: bold; color: green;}
    </style>
  </head>
  <body>
    <div>
    <?php if ($nom == NULL) : // condition PHP ?>
       <!-- Code HTML -->
       Bonjour inconnu !<br />
    <?php elseif ($âge == NULL) : // suite de la condition ?>
       <!-- Code HTML -->
       Je connais votre <span class="ok">nom</span> 
       mais pas votre <span class="ko">âge</span>.<br />
    <?php else : // suite de la condition PHP ?>
       <!-- Code HTML -->
       Je connais votre <span class="ok">nom</span> 
       et votre <span class="ok">âge</span>, 
       mais je ne dirai rien !<br />
    <?php endif; // fin de la condition PHP ?>
    </div>
  </body>
</html>
