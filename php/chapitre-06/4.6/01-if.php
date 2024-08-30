<!DOCTYPE html>
<html xmlns="http://www.w3.org/1999/xhtml" lang="fr">
  <head>
    <meta charset="utf-8" />
    <title>if (première syntaxe)</title>
  </head>
  <body>
    <div>
    
    <?php
    // Structure if / elseif / else
    $nom = 'Olivier';
    $âge = NULL;
    if ($nom == NULL) {
      echo "Bonjour inconnu !<br />";
    } elseif ($âge == NULL) {
      echo "Bonjour $nom ! Je ne connais pas votre âge.<br />";
    } else {
      echo "Bonjour $nom ! Vous avez $âge ans.<br />";
    }
    ?>
    
    </div>
  </body>
</html>

