<?php
// Ouvrir une session et enregistrer une information de
// session nommée "x" de valeur "SESSION".
session_start();
$_SESSION['x'] = 'SESSION';
// Déposer un cookie nommé "x" de valeur "COOKIE".
setcookie('x','COOKIE');
?>
<!DOCTYPE html>
<html xmlns="http://www.w3.org/1999/xhtml" lang="fr">
  <head>
    <meta charset="utf-8" />
    <title>Page 2</title>
  </head>
  <body>
    <div>

    <?php
    // Réactiver la session.
    session_start();
    // Afficher les valeurs de 'x' à partir des tableaux.
    echo '$_GET[\'x\'] = ',
         isset($_GET['x'])?$_GET['x']:'','<br />';
    echo '$_POST[\'x\'] = ',
         isset($_POST['x'])?$_POST['x']:'','<br />';
    echo '$_COOKIE[\'x\'] = ',
         isset($_COOKIE['x'])?$_COOKIE['x']:'','<br />';
    echo '$_SESSION[\'x\'] = ',
         isset($_SESSION['x'])?$_SESSION['x']:'','<br />';
    echo '$_REQUEST[\'x\'] = ',
         isset($_REQUEST['x'])?$_REQUEST['x']:'','<br />';
    ?>

    </div>
  </body>
</html>
