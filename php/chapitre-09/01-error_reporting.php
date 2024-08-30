<!DOCTYPE html>
<html xmlns="http://www.w3.org/1999/xhtml" lang="fr">
  <head>
    <meta charset="utf-8" />
    <title>error_reporting()</title>
  </head>
  <body>
    <div>

    <?php
    // Valeur courante de error_reporting.
    echo '<b>error_reporting = ',error_reporting(),'</b><br />';
    // Par défaut égal à tout sauf E_NOTICE = E_ALL - E_NOTICE.
    echo '= E_ALL - E_NOTICE = ',(E_ALL-E_NOTICE),'<br />';
    // Affichage d'une variable non initialisée.
    echo "\$x (non initialisée) = $x => pas de message <br />";
    // Passage de error_reporting à E_ALL (tout)
    error_reporting(E_ALL);
    echo '<b>error_reporting = E_ALL</b><br />';
    // Affichage d’une variable non initialisée.
    echo "\$x (non initialisée) = $x => message <br />";
    // Lecture d’un fichier qui n'existe pas.
    if (! readfile('/chemin/vers/fichier_inexistant')) {
       echo 'Erreur dans readfile => message<br />';
    };
    // Passage de error_reporting à 0 (rien).
    error_reporting(0);
    echo '<b>error_reporting = 0</b><br />';
    // Lecture d’un fichier qui n'existe pas.
    if (! readfile('/tmp/infos.txt')) {
       echo 'Erreur dans readfile => plus de message<br />';
    };
    ?>

    </div>
  </body>
</html>
