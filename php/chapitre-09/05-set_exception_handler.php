<!DOCTYPE html>
<html xmlns="http://www.w3.org/1999/xhtml" lang="fr">
  <head>
    <meta charset="utf-8" />
    <title>set_exception_handler()</title>
  </head>
  <body>
    <div>

    <?php 
    // Définir le gestionnaire d'exception. 
    function gestionnaire_exception($exception) { 
       // Afficher le fichier concerné, avec le numéro de ligne. 
       echo 'Fichier = ',$exception->getFile(),'<br />'; 
       echo 'Ligne   = ',$exception->getLine(),'<br />'; 
       // Afficher le message. 
       echo 'Message = ',$exception->getMessage(),'<br />'; 
    } 
    // Spécifier le gestionnaire à utiliser. 
    set_exception_handler('gestionnaire_exception'); 
    // Lever une exception. 
    throw new Exception('Erreur !'); 
    // Afficher un message de fin. 
    echo 'Fin'; 
    ?>

    </div>
  </body>
</html>
