<?php 
// Ouvrir/réactiver la session. 
session_start(); 
// Enregistrer une information dans la session. 
$_SESSION['nom'] = 'Olivier'; 
?> 
<!DOCTYPE html> 
<html xmlns="http://www.w3.org/1999/xhtml" lang="fr"> 
  <head>
    <meta charset="utf-8" />
    <title>Page 1</title>
  </head> 
  <body> 
    <div> 
    <b>Page 1</b><br /> 
    <?php 
    // Afficher la donnée de session. 
    echo 'nom = ',$_SESSION['nom'],'<br />'; 
    ?> 
    <a href="07-session-reinitialiser-page-2.php">Page 2</a><br /> 
    </div> 
  </body> 
</html>
