<!DOCTYPE html>
<html xmlns="http://www.w3.org/1999/xhtml" lang="fr">
  <head>
    <meta charset="utf-8" />
    <title>restore_error_handler()</title>
  </head>
  <body>
    <div>

    <?php
    // Définir un premier gestionnaire d'erreur.
    function gestionnaire1 ($numéro,$message) {
       // Affiche un simple message
       echo '=> gestionnaire n° 1<br />';
    }
    // Définir un deuxième gestionnaire d'erreur.
    function gestionnaire2 ($numéro,$message) {
       // Affiche un simple message
       echo '=> gestionnaire n° 2<br />';
    }
    // Définir une fonction qui génère une erreur.
    function générer_erreur() {
       // Afficher un message.
       echo 'Générer une erreur<br />';
       // Lire un fichier qui n'existe pas.
       readfile('/chemin/vers/fichier_inexistant');
    }
    // Première séquence : pas de gestionnaire.
    echo '<b>Pas de gestionnaire</b><br />';
    générer_erreur();
    // Deuxième séquence : gestionnaire numéro 1.
    set_error_handler('gestionnaire1');
    echo '<b>Utiliser le gestionnaire n° 1</b><br />';
    générer_erreur();
    // Troisième séquence : gestionnaire numéro 2.
    set_error_handler('gestionnaire2');
    echo '<b> Utiliser le gestionnaire n° 2</b><br />';
    générer_erreur();
    // Quatrième séquence : restaurer l'ancien gestionnaire.
    restore_error_handler();
    echo '<b>Premier restore_error_handler()</b><br />';
    générer_erreur();
    // Cinquième séquence : restaurer l'ancien gestionnaire.
    restore_error_handler();
    echo '<b>Deuxième restore_error_handler()</b><br />';
    générer_erreur();
    ?>

    </div>
  </body>
</html>
