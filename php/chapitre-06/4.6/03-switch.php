<!DOCTYPE html>
<html xmlns="http://www.w3.org/1999/xhtml" lang="fr">
  <head>
    <meta charset="utf-8" />
    <title>switch (première syntaxe)</title>
    <style>
      h1 { font-family: verdana,arial,helvetica,sans-serif ; font-size: 100% ; margin-top: 20pt }
    </style>
  </head>
  <body>
    <div>
    
    <h1>Sans instruction break</h1>
    <?php
    $nom = rand(0,1)?'Olivier':NULL;
    switch ($nom) {
       case NULL :
          echo 'Bonjour inconnu ! ',
               'Je vais vous appeler Olivier.<br />';
          $nom = 'Olivier';
          // break;
       case 'Olivier' :
          echo "Bonjour Maître $nom !<br />";
          // break;
       default :
          echo "Bonjour élève $nom !<br />";
    }
    ?>

    <h1>Avec instruction break</h1>
    <?php
    $nom = rand(0,1)?'Olivier':NULL;
    switch ($nom) {
       case NULL :
          echo 'Bonjour inconnu ! ',
               'Je vais vous appeler Olivier.<br />';
          $nom = 'Olivier';
          break;
       case 'Olivier' :
          echo "Bonjour Maître $nom !<br />";
          break;
       default :
          echo "Bonjour élève $nom !<br />";
    }
    ?>
    
    <h1>Clause case vide</h1>
    <?php 
    $i = rand(1,5); 
    switch ($i) { 
       case 1 : 
       case 3 : 
       case 5 : 
          echo "$i est impair.<br />";  
          break;
       default : 
          echo "$i est pair.<br />";  
    } 
    ?>

    </div>
  </body>
</html>

