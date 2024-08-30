<?php 
// Ouvrir/réactiver la session. 
session_start(); 
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
    // Afficher la donnée de session. 
    echo 'nom = ',$_SESSION['nom'],'<br />'; 
    // Modifier la données de session. 
    $_SESSION['nom'] = '?'; 
    // Annuler la session. 
    session_abort(); 
    // Afficher la donnée de session. 
    echo 'nom = ',$_SESSION['nom'],'<br />'; 
    ?> 
    <a href="06-session-annuler-page-3.php">Page 3</a><br /> 
    </div> 
  </body> 
</html>
