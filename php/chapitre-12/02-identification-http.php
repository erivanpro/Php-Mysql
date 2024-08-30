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
// Fonction qui affiche l'authentification HTTP.
function authentification($message) {
  header("WWW-Authenticate: Basic realm=\"$message\"");
  // Si l'utilisateur clique sur le bouton annuler,
  // Les lignes suivantes s'exécutent (sinon, le script est
  // de nouveau appelé mais avec PHP_AUTH_USER renseigné
  // et le script ne passera plus par ici).
  // Afficher un message et proposer à l'utilisateur 
  // d'essayer de nouveau
  include('02-identification-http-erreur.php');
  exit;
}
if (! isset($_SERVER['PHP_AUTH_USER'])) {
  // Pas de variable PHP_AUTH_USER = premier appel du script.
  // Demande d'identifiation.
  authentification('MonSite.com');
} else {
  // Variable PHP_AUTH_USER existe = appel après saisie.
  // Récupérer les information saisies.
  $identifiant = $_SERVER['PHP_AUTH_USER'];
  $mot_de_passe = $_SERVER['PHP_AUTH_PW'];
  // Vérifier que l'utilisateur existe.
  if (utilisateur_existe($identifiant,$mot_de_passe)) {
    // L'utilisateur existe ...
    // Partir sur une autre page et interrompre le script
    header('location: 00-accueil.php');
    exit;
  } else {
    // L'utilisateur n'existe pas ...
    // Essayer de nouveau.
    authentification('MonSite.com : identification incorrecte');
  }
}
?>
