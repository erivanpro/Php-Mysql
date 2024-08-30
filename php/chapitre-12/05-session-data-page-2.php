<?php
// Appel à session_start.
session_start();
?>
<!DOCTYPE html>
<html xmlns="http://www.w3.org/1999/xhtml" lang="fr">
  <head>
    <meta charset="utf-8" />
    <title>Session - Page 2</title>
  </head>
  <body>
    <div>

    <?php
    // Affichage.
    echo '$_SESSION[\'prénom\'] =',
         isset($_SESSION['prénom'])?$_SESSION['prénom']:'',
         '<br />';
    echo '$_SESSION[\'informations\'][\'nom\'] =',
         isset($_SESSION['informations']['nom'])?
                     $_SESSION['informations']['nom']:'',
         '<br />';
    ?>

    </div>
  </body>
</html>