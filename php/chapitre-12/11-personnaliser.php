<?php
// Inclusion du fichier contenant les fonctions générales.
include('../include/fonctions.inc.php');
// Ouvrir/réactiver la session.
session_start();
// Initialisation des variables.
$message = '';
// La session a-t'elle été ouverte au niveau applicatif ?
if (isset($_SESSION['identifiant'])) { // oui
  // Récupérer les informations de session.
  $identifiant = $_SESSION['identifiant'];
  $mot_de_passe = $_SESSION['mot_de_passe'];
  // Le script est-il appelé en traitement du formulaire ?
  if (isset($_POST['activer'])) { // oui
    // Activer la connexion automatique.
    // Déposer deux cookies d'une durée de vie de 30 jours,
    // un pour l'identifiant de l'utilisateur et un pour son
    // mot de passe.
    $expiration = time()+ (30 * 24 * 3600);
    setcookie('identifiant',$identifiant,$expiration);
    setcookie('mot_de_passe',$mot_de_passe,$expiration);
    // Préparer un message.
    $message = 'Connexion automatique activée';
  } elseif (isset($_POST['désactiver'])) { // oui
    // Désactiver la connexion automatique.
    // Supprimer les deux cookies.
    setcookie('identifiant');
    setcookie('mot_de_passe');
    // Préparer un message.
    $message = 'Connexion automatique désactivée';
  }
} else { // Session non ouverte au niveau applicatif.
  // Rediriger l'utilisateur vers la page de login
  header('Location: 11-login.php');
  exit;
}
?>
<!DOCTYPE html>
<html xmlns="http://www.w3.org/1999/xhtml" lang="fr">
  <head>
    <meta charset="utf-8" />
    <title>MonSite.com - Personnaliser</title>
  </head>
  <body>
    <form action="11-personnaliser.php" method="post">
    <div>
    <input type="submit" name="activer" 
           value="Activer la connexion automatique" /><br />
    <input type="submit" name="désactiver" 
           value="Désactiver la connexion automatique" /><br />
    <?php echo $message; ?><br />
    </div>
    </form>
  </body>
</html>