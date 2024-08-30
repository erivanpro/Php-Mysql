<!DOCTYPE html>
<html xmlns="http://www.w3.org/1999/xhtml" lang="fr">
  <head>
    <meta charset="utf-8" />
    <title>Utilisation des filtres (exemple 1)</title>
  </head>
  <body>
    <div>

    <?php
    function afficher($x,$f) { // utilisée pour afficher les résultats
      echo var_export($x,TRUE),' => ',var_export($f,TRUE),'<br />';    
    }
    echo "<b>Filtrer un nombre entier</b><br />";
    $valeurs = array('123','abc','1.2',NULL);
    foreach ($valeurs as $x) {
      afficher($x,filter_var($x,FILTER_VALIDATE_INT));
    }
    echo "<b>+ NULL au lieu de FALSE en cas d'erreur</b><br />";
    $x = 'abc';
    // indicateur passé en option directement
    $options = FILTER_NULL_ON_FAILURE;
    afficher($x,filter_var($x,FILTER_VALIDATE_INT,$options));
    echo "<b>Filtrer un nombre entier (0-100)</b><br />";
    // options du filtre définies via un tableau associatif
    $options = 
      array
        (
        'options' => array('min_range' => 0,'max_range' => 100)
        );
    $valeurs = array('0','100','101');
    foreach ($valeurs as $x) {
      afficher($x,filter_var($x,FILTER_VALIDATE_INT,$options));
    }
    echo "<b>+ NULL au lieu de FALSE en cas d'erreur</b><br />";
    // indicateur ajouté dans le tableaux des options
    $options = 
      array
        (
        'options' => array('min_range' => 0,'max_range' => 100),
        'flags' => FILTER_NULL_ON_FAILURE
        );
    $x = '101';
    afficher($x,filter_var($x,FILTER_VALIDATE_INT,$options));
    echo "<b>Filtrer avec une expression rationnelle</b><br />";
    $regexp = '<^[0-9]{2}/[0-9]{2}/[0-9]{4}$>';
    $options = 
      array
        (
        'options' => array('regexp' => $regexp)
        );
    $valeurs = array('01/01/2016','01/01/16');
    foreach ($valeurs as $x) {
      afficher($x,filter_var($x,FILTER_VALIDATE_REGEXP,$options));
    }
    ?>

    </div>
  </body>
</html>