<?php
// Inclusion du fichier contenant les fonctions générales.
include('../include/fonctions.inc.php');
// Fonction qui vérifie que l'identification saisie 
// est correcte.
function utilisateur_existe($identifiant,$mot_de_passe) {
  // Connexion et sélection de la base de données
  $connexion = mysqli_connect('localhost','eniweb','web','eni');
  // Définition et exécution d'une requête préparée
  $sql  = 'SELECT 1 FROM utilisateurs ';
  $sql .= 'WHERE identifiant = ? AND mot_de_passe = ?';
  $requête = mysqli_stmt_init($connexion);
  $ok = mysqli_stmt_prepare($requête,$sql);
  $ok = mysqli_stmt_bind_param
          ($requête,'ss',$identifiant,$mot_de_passe);
  $ok = mysqli_stmt_execute($requête);
  mysqli_stmt_bind_result($requête,$existe);
  $ok = mysqli_stmt_fetch($requête);
  mysqli_stmt_free_result($requête);
  // L'identification est bonne si la requête a retourné 
  // une ligne (l'utilisateur existe et le mot de passe 
  // est bon).
  // Si c'est le cas $existe contient 1, sinon elle est 
  // vide. Il suffit de la retourner en tant que booléen.
  return (bool) $existe;
}
// Initialisation des variables.
$identifiant = '';
$mot_de_passe = '';
$message = '';
$action = '';
// Le script est-il appelé en validation du formulaire ?
if (isset($_POST['connexion'])) { // oui
  // => connexion manuelle.
  // Récupérer les information saisies.
  $identifiant = $_POST['identifiant'];
  $mot_de_passe = $_POST['mot_de_passe'];
  // Indiquer l'action à effectuer pour la suite.
  $action = 'connexion';
  // Préparer un message en cas de problème.
  $message = 'Identification incorrecte. '.
             'Essayez de nouveau.';
// Sinon, existe-t'il un cookie "identifiant" ?
} elseif (isset($_COOKIE['identifiant'])) { // oui
  // => connexion automatique.
  // Récupérer les informations des cookies
  $identifiant = $_COOKIE['identifiant'];
  $mot_de_passe =  $_COOKIE['mot_de_passe'];
  // Indiquer l'action à effectuer pour la suite.
  $action = 'connexion';
  // Préparer un message en cas de problème.
  $message = 'Identification automatique incorrecte. '.
             'Essayez manuellement.';
}
// Finalement, que fait-on ?
if ($action == 'connexion') { // tenter une connexion
  // Vérifier que l'utilisateur existe.
  if (utilisateur_existe($identifiant,$mot_de_passe)) {
    // L'utilisateur existe ...
    // => ouvrir la session au niveau applicatif
    session_start();
    session_regenerate_id(); // au cas ou ...
    $_SESSION['identifiant'] = $identifiant;
    $_SESSION['mot_de_passe'] = $mot_de_passe;
    // Rediriger l'utilisateur vers une autre page du site
    // (il n'y en a qu'une !).
    header('location: '.url('11-personnaliser.php'));
    exit;
  } // utilisateur_existe
} // $action == 'connexion'
// Si c'est le premier appel, ou si la connexion manuelle
// ou automatique a échoué, laisser le formulaire s'afficher.
?>
<!DOCTYPE html>
<html xmlns="http://www.w3.org/1999/xhtml" lang="fr">
  <head>
    <meta charset="utf-8" />
    <title>MonSite.com - Identification</title>
  </head>
  <body>
    <form action="11-login.php" method="post">
    <table>
    <tr>
      <td style="text-align:right">Identifiant :</td>
      <td><input type="text" Name="identifiant" value=
           "<?php echo vers_formulaire($identifiant); ?>" /></td>
    </tr>
    <tr>
      <td style="text-align:right">Mot de passe :</td>
      <td><input type="password" Name="mot_de_passe" value=
           "<?php echo vers_formulaire($mot_de_passe); ?>" /></td>
    </tr>
    <tr>
      <td></td>
      <td style="text-align:right"><input type="submit" name="connexion" 
                         value="Connexion" /></td>
    </tr>
    </table>
    <?php echo $message; ?>
    </form>
  </body>
</html>