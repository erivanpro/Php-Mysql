<!DOCTYPE html>
<html xmlns="http://www.w3.org/1999/xhtml" lang="fr">
  <head>
    <meta charset="utf-8" />
    <title>Variable dynamique</title>
  </head>
  <body>
    <div>

    <?php
    $une_variable = 10;
    $nom_variable = 'une_variable';
    echo '$une_variable = ',$une_variable,'<br />';
    echo '$nom_variable = ',$nom_variable,'<br />';
    echo '$$nom_variable = ',$$nom_variable,'<br />';
    ?>
    
    </div>
  </body>
</html>