<?php
// Ouvrir/réactiver la session.
session_start();
?>
<!DOCTYPE html>
<html xmlns="http://www.w3.org/1999/xhtml" lang="fr">
  <head>
    <meta charset="utf-8" />
    <title>Page 3</title>
  </head>
  <body>
    <div>
    <b>Page 3</b><br />
    <?php 
    echo 'Bonjour ',$_SESSION['nom'],'<br />';
    echo 'session_id() = ',session_id(),'<br />';
    ?>
    </div>
  </body>
</html>
