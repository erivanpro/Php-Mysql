<?php
// Inclusion du fichier contenant les fonctions générales.
include('../include/fonctions.inc.php');
// Ouvrir/réactiver la session.
session_start();
// Tester si la session est nouvelle (ouverte par 
// l'appel session_start() ci-dessus) ou ancienne (ouverte
// par un appel antérieur à session_start()).
// Le mieux est de tester si une de nos données de session
// est déjà enregistrée.
if (! isset($_SESSION['identifiant'])) {
  // Donnée "identifiant" pas encore enregistrée :
  // => l'utilisateur n'est pas connecté ;
  // => le rediriger vers la page de login.
  header('location: 10-session-authentification-login.php');
  exit;
} else {
  // ...
}
// ...
?>
<!DOCTYPE html>
<html xmlns="http://www.w3.org/1999/xhtml" lang="fr">
  <head>
    <meta charset="utf-8" />
    <title>Action</title>
  </head>
  <body>
    <div>
    Action ...
    </div>
  </body>
</html>
