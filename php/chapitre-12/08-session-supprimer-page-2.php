<?php
// Ouvrir/réactiver la session.
session_start();
// Effacer toutes les informations de session.
$_SESSION = array();
// Supprimer le cookie de session (si utilisé).
// Le cookie porte le nom de la variable qui stocke 
// l'identifiant de session.
if (isset($_COOKIE[session_name()])) {
  setcookie(session_name(),'',time()-1,'/');
}
// Détruire la session.
session_destroy();
?>
<!DOCTYPE html>
<html xmlns="http://www.w3.org/1999/xhtml" lang="fr">
  <head>
    <meta charset="utf-8" />
    <title>Page 2</title>
  </head>
  <body>
    <div>
    <b>Page 2</b><br />
    <?php 
    echo 'Bonjour ',$_SESSION['nom'],'<br />';
    echo 'session_id() = ',session_id(),'<br />';
    ?>
    <a href="08-session-supprimer-page-3.php">Page 3</a><br />
    </div>
  </body>
</html>
