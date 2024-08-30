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
  // Donnée "identifiant"déjà enregistrée :
  // => l'utilisateur est connecté ;
  // => récupérer les données de session utilisées dans 
  //    le script.
  $date = $_SESSION ['date'];
  $identifiant = $_SESSION['identifiant'];
  // Récupérer l'identifiant de la session (pour l'exemple).
  $session = session_id();
  // Préparer un message.
  $message = "Session : $session - $identifiant - $date";
}
// Détermination de la date et de l'heure actuelle (pas celle
// de l'ouverture de la session).
$actuel = 'Nous sommes le '.date('d/m/Y').
          ' ; il est '.date('H:i:s');
?>
<!DOCTYPE html>
<html xmlns="http://www.w3.org/1999/xhtml" lang="fr">
  <head>
    <meta charset="utf-8" />
    <title>Accueil</title>
  </head>
  <body>
    <div>
      <b>Accueil - <?php echo $actuel; ?></b><br />
      <?php echo $message; ?><br />
      <!-- Lien vers une autre page. 
           Utiliser notre fonction générique url() pour être
           certain que l'identifiant de session est transmis
           quelles que soient les conditions.  -->
      <a href="<?php echo url('10-session-authentification-action.php'); ?>">Action</a>
    </div>
  </body>
</html>
