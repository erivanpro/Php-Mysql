<!DOCTYPE html>
<html xmlns="http://www.w3.org/1999/xhtml" lang="fr">
  <head>
    <meta charset="utf-8" />
    <title>set_error_handler()</title>
  </head>
  <body>
    <div>

    <?php
    // Définir le gestionnaire d'erreurs.
    function gestionnaire_erreurs
                 ($niveau,$message,$fichier,$ligne) {
       // Afficher le fichier concerné, avec le numéro de ligne.
       echo "Fichier = $fichier<br />";
       echo "Ligne   = $ligne<br />";
       // Afficher le niveau et le message.
       echo "Niveau = $niveau <br />";
       echo "Message = $message<br />";
       // Interrompre le script
       exit;
    }
    // Spécifier le gestionnaire à utiliser.
    set_error_handler('gestionnaire_erreurs');
    // Générer une erreur.
    readfile('/chemin/vers/fichier_inexistant');
    // Afficher un message de fin.
    echo 'Fin';
    ?>

    </div>
  </body>
</html>
