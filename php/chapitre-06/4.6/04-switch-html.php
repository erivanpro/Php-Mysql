<?php
$langue = 'fr';
?>
<!DOCTYPE html>
<html xmlns="http://www.w3.org/1999/xhtml" lang="fr">
  <head>
    <meta charset="utf-8" />
    <title>switch (deuxième syntaxe, avec incorporation de code HTML)</title>
    <style type="text/css" media="all">
    .en {font-weight: bold; color: green;}
    .sp {font-weight: bold; color: orange;}
    .fr {font-weight: bold; color: blue;}
    .inconnu {font-weight: bold; color: red;}
    </style>
  </head>
  <body>
    <div>
    <?php switch ($langue) : // switch
            case 'en' :      // premier case 
    ?>
       <!-- Code HTML -->
       Hello <span class="en">my friend</span> !<br />
    <?php   break;           // break premier case ?>
    <?php   case 'sp' :      // deuxième case ?>
       <!-- Code HTML -->
       ¡ Buenos dias <span class="sp">amigo</span> !<br />
    <?php   break;           // break deuxième case ?>
    <?php   case 'fr' :      // troisième case ?>
       <!-- Code HTML -->
       Salut <span class="fr">mon pote</span> !<br />
    <?php   break;           // break troisième case ?>
    <?php   default :        // défaut ?>
       <!-- Code HTML -->
       <span class="inconnu">?????</span>
    <?php endswitch;         // fin du switch ?>
    </div>
  </body>
</html>
