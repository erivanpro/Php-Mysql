<!DOCTYPE html>
<html xmlns="http://www.w3.org/1999/xhtml" lang="fr">
  <head>
    <meta charset="utf-8" />
    <title>error_log()</title>
  </head>
  <body>
    <div>

    <?php
    // Pas d'affichage des erreurs dans le script.
    error_reporting(0);
    // Lecture d'un fichier qui n'existe pas.
    $nom_fichier = '/chemin/vers/fichier_inexistant';
    if (! readfile($nom_fichier)) {
       // Ecriture d'un message d'erreur dans un fichier de trace 
       // spécifique à l'application
       error_log("Impossible de lire le fichier $nom_fichier.\n",
                 3,'../log/monApplication.log');
       // Affichage d'un message pour l'utilisateur.
       echo 'Votre requête ne peut pas aboutir ; ',
            'essayez de nouveau plus tard.';
    };
    ?>

    </div>
  </body>
</html>
