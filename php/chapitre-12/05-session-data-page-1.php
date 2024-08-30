<?php
// Ouvrir/réactiver la session.
session_start();
// Enregistrer deux informations dans la session.
$_SESSION['prénom'] = 'Olivier';
$_SESSION['informations'] =  // c'est un tableau ...
      array('prénom'=>'Olivier','nom'=>'HEURTEL');
?>
<!DOCTYPE html>
<html xmlns="http://www.w3.org/1999/xhtml" lang="fr">
  <head>
    <meta charset="utf-8" />
    <title>Session - Page 1</title>
  </head>
  <body>
    <div><a href="05-session-data-page-2.php">Page 2</a></div>
  </body>
</html>