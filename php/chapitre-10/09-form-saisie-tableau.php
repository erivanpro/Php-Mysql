<!DOCTYPE html>
<html xmlns="http://www.w3.org/1999/xhtml" lang="fr">
  <head>
    <title>Saisie</title>
  </head>
  <body>
    <div>

    <?php
    // Inclusion d'un fichier contenant des fonctions génériques 
    // (dont la fonction afficher_tableau définie dans le 
    // chapitre 8)
    include('../include/fonctions.inc.php') ;
    afficher_tableau($_POST,'$_POST :');
    ?>

    </div>
  </body>
</html>