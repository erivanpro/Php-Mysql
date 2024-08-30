<!DOCTYPE html>
<html xmlns="http://www.w3.org/1999/xhtml" lang="fr">
  <head>
    <meta charset="utf-8" />
    <title>Fonctions anonyme</title>
    <style>
      h1 { font-family: verdana,arial,helvetica,sans-serif ; font-size: 100% ; margin-top: 20pt }
    </style>
  </head>
  <body>
    <div>

    <h1>Fonction anonyme définie dans une variable</h1> 
    <?php
    // définition d'une fonction anonyme stockée dans une variable
    $fonction_anonyme = function ($nom) {
      echo "Bonjour $nom !<br />";
    };
    // appel de la fonction anonyme
    $fonction_anonyme('tout le monde');
    // utilisation de la fonction anonyme comme fonction de rappel
    $noms = array('Olivier','David','Thomas');
    array_walk($noms,$fonction_anonyme);
    ?>
    
    <h1>Fonction anonyme définie directement dans l'appel</h1> 
    <?php
    $noms = array('Olivier','David','Thomas');
    array_walk
       (
       $noms,
       function ($nom) {echo "Bonjour $nom !<br />";}
       );
    ?>

    <h1>Importer des variables du contexte parent</h1> 
    <?php
    // définition d'une variable
    $nom = 'Olivier';
    // définition d'une fonction anonyme stockée dans une variable
    // cette fonction importe la variable $nom
    $fonction_anonyme = function () use ($nom) {
      echo "Bonjour $nom !<br />";
    };
    // appel de la fonction anonyme
    $fonction_anonyme();
    ?>

    </div>
  </body>
</html>
