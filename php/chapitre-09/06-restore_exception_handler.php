<!DOCTYPE html>
<html xmlns="http://www.w3.org/1999/xhtml" lang="fr">
  <head>
    <meta charset="utf-8" />
    <title>restore_exception_handler()</title>
  </head>
  <body>
    <div>

    <?php
    // Définir un premier gestionnaire d'exception.
    function gestionnaire1 ($exception) {
       // Affiche un simple message
       echo '=> gestionnaire n° 1<br />';
    }
    // Définir un deuxième gestionnaire d'exception.
    function gestionnaire2 ($exception) {
       // Affiche un simple message
       echo '=> gestionnaire n° 2<br />';
    }
    // Définir une fonction qui génère une erreur.
    function générer_erreur() {
       throw new Exception('Erreur !'); 
    }
    // Définir le gestionnaire numéro 1.
    set_exception_handler('gestionnaire1');
    // Code ...
    // Définir le gestionnaire numéro 2.
    set_exception_handler('gestionnaire2');
    // Code nécessitant un gestionnaire particulier 
    // ...
    // Restaurer l'ancien gestionnaire.
    restore_exception_handler();
    // Générer une erreur.
    générer_erreur();
    ?>

    </div>
  </body>
</html>
