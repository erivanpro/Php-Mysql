<!DOCTYPE html>
<html xmlns="http://www.w3.org/1999/xhtml" lang="fr">
  <head>
    <meta charset="utf-8" />
    <title>error_get_last()</title>
  </head>
  <body>
    <div>

    <?php 
    // Générer une erreur (sans l'afficher : @...). 
    @readfile('/tmp/infos.txt'); 
    // Afficher le type de error_get_last(). 
    echo 'error_get_last() = ',gettype(error_get_last()),'<br />'; 
    // Effacer la dernière erreur.
    error_clear_last() ;
    // Afficher le type de error_get_last(). 
    echo 'error_get_last() = ',gettype(error_get_last()),'<br />'; 
    ?>

    </div>
  </body>
</html>
