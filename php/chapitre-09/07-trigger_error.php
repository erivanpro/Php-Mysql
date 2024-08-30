<!DOCTYPE html>
<html xmlns="http://www.w3.org/1999/xhtml" lang="fr">
  <head>
    <meta charset="utf-8" />
    <title>trigger_error()</title>
    <style>
      h1 { font-family: verdana,arial,helvetica,sans-serif ; font-size: 100% ; margin-top: 20pt }
    </style>
  </head>
  <body>
    <div>

    <h1>Avec un gestionnaire externe</h1>
    <?php
    // Définir le gestionnaire d'erreurs.
    function gestionnaire_erreurs($niveau,$message) {
       // Afficher simplement le niveau et le message.
       echo "Niveau = $niveau <br />";
       echo "Message = $message<br />";
       // Ne pas interrompre le script.
       // exit;
    }
    // Spécifier le gestionnaire à utiliser.
    set_error_handler('gestionnaire_erreurs');
    // déclencher une erreur E_USER_NOTICE
    trigger_error('*** mon message ***',E_USER_NOTICE);
    // déclencher une erreur E_USER_WARNING
    trigger_error('*** mon message ***',E_USER_WARNING);
    // Déclencher une erreur E_USER_DEPRECATED. 
    trigger_error('*** mon message ***',E_USER_DEPRECATED); 
    // déclencher une erreur E_USER_ERROR
    trigger_error('*** mon message ***',E_USER_ERROR);
    // afficher un message de fin
    echo 'Fin';    
    ?>

    <h1>Avec le gestionnaire interne</h1>
    <?php
    // Remettre le gestionnaire par défaut.
    set_error_handler(NULL);
    // déclencher une erreur E_USER_NOTICE
    trigger_error('*** mon message ***',E_USER_NOTICE);
    // déclencher une erreur E_USER_WARNING
    trigger_error('*** mon message ***',E_USER_WARNING);
    // Déclencher une erreur E_USER_DEPRECATED. 
    trigger_error('*** mon message ***',E_USER_DEPRECATED); 
    // déclencher une erreur E_USER_ERROR
    trigger_error('*** mon message ***',E_USER_ERROR);
    // afficher un message de fin
    echo 'Fin';    
    ?>

    </div>
  </body>
</html>
