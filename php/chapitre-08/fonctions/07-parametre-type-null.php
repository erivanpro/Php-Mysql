<!DOCTYPE html>
<html xmlns="http://www.w3.org/1999/xhtml" lang="fr">
  <head>
    <meta charset="utf-8" />
    <title>Paramètres : déclaration du type de données (NULL accepté)</title>
  </head>
  <body>
    <div>

    <?php 
    // Déclaration d'une fonction qui accepte un 
    // paramètre de type entier qui peut être NULL.
    function cube(?int $valeur ) { 
      if (is_null($valeur)) {
        return NULL;
      } else {
       return $valeur ** 3 ;
      } 
    } 
    // Appels de la fonction.
    echo 'cube(<b>2</b>) => ',var_dump(cube(2)),'<br />'; 
    echo 'cube(<b>NULL</b>) => ',var_dump(cube(NULL)),'<br />';
    echo 'cube() => ',var_dump(cube()),'<br />';
    ?>

    </div>
  </body>
</html>
