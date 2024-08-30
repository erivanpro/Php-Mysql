<!DOCTYPE html>
<html xmlns="http://www.w3.org/1999/xhtml" lang="fr">
  <head>
    <meta charset="utf-8" />
    <title>Utilisation des filtres avec un tableau</title>
  </head>
  <body>
    <div>

    <?php
    function afficher($x,$f) { // utilisée pour afficher les résultats
      echo var_export($x,TRUE),'<br /> => ',var_export($f,TRUE),'<br />';    
    }
    echo '<b>Filtrer un tableau de nombres entiers</b><br />';
    $valeurs = array('123','abc');
    // Même filtre à appliquer à toutes les données,
    // sans indicateur ni option.
    afficher($valeurs,filter_var_array($valeurs,FILTER_VALIDATE_INT));
    echo '<b>Filtrer un tableau de données diverses (1)</b><br />';
    $valeurs = array
        (
        'age' => 123,
        'taille' => 'abc',
        'mail' => 'contact@olivier-heurtel.fr'
        );
    // Filtre différent mais "simple" (sans indicateur
    // ni option) à appliquer aux données.
    $filtres = array
        (
        'age' => FILTER_VALIDATE_INT,
        'taille' => FILTER_VALIDATE_INT,
        'mail' => FILTER_VALIDATE_EMAIL
        );
    afficher($valeurs,filter_var_array($valeurs,$filtres));
    echo '<b>Filtrer un tableau de données diverses (2)</b><br />';
    $valeurs = array
        (
        'age' => 123,
        'taille' => 'abc',
        'mail' => 'contact@olivier-heurtel.fr'
        );
    // Filtre avec options et indicateur à appliquer à une
    // des données.
    $filtre_age = array
        (
        'filter' => FILTER_VALIDATE_INT,
        'options' => array('min_range' => 0,'max_range' => 100),
        'flags' => FILTER_NULL_ON_FAILURE
        );
    // Noter la mention d'un filtre pour une donnée
    // qui n'existe pas.
    $filtres = array
        (
        'age' => $filtre_age,
        'taille' => FILTER_VALIDATE_INT,
        'poids' => FILTER_VALIDATE_INT, // n'existe pas
        'mail' => FILTER_VALIDATE_EMAIL
        );
    afficher($valeurs,filter_var_array($valeurs,$filtres));
    // Désactiver l'ajout des éléments vides.
    echo '<b>La même chose en désactivant l\'ajout d\'éléments vides</b><br />';
    afficher($valeurs,filter_var_array($valeurs,$filtres,FALSE));
    ?>

    </div>
  </body>
</html>