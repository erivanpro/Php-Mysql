<!DOCTYPE html>
<html xmlns="http://www.w3.org/1999/xhtml" lang="fr">
  <head>
    <meta charset="utf-8" />
    <title>Les constantes et les fonctions</title>
  </head>
  <body>
    <div>

    <?php
    // Définition d'une constante dans le script.
    define('CONSTANTE_SCRIPT','constante script');
    // Définition d'une fonction.
    function constante() {
      // Qui définit une constante.
      define('CONSTANTE_FONCTION','constante fonction');
      // Et qui affiche une constante du script appelant.
      echo 'Dans la fonction, CONSTANTE_SCRIPT = ',
            CONSTANTE_SCRIPT,'<br />';
    }
    // Appel de la fonction.
    constante();
    // Affichage de la constante définie dans la fonction.
    echo 'Dans le script, CONSTANTE_FONCTION = ',
       CONSTANTE_FONCTION,'<br />';
    ?>
    
    </div>
  </body>
</html>
