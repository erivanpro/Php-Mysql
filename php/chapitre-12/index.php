<?php
// Est-ce que la page est appelée avec le paramètre "source" 
// dans l'URL ?
$afficher_source = isset($_GET['source']);
if ($afficher_source) {
  // Oui.
  // Il faut afficher le code source d'une page.
  $titre_page = "Source de {$_GET['source']}";  
  $source = $_GET['source'];
} else {
  // Non.
  // Il faut afficher une liste de liens.
  $titre_page = 'Chapitre 12';
  // Liste des liens.
  $liens['01-identification-formulaire.php'] = 'Identification par formulaire';
  $liens['02-identification-http.php'] = 'Identification par authentification HTTP';
  $liens['03-cookie-page-1.php'] = 'Utiliser des cookies';
  $liens['04-tester-cookie.php'] = 'Tester si un poste accepte les cookies';
  $liens['05-session-data-page-1.php'] = 'Manipuler les données enregistrées dans une session';
  $liens['06-session-annuler-page-1.php'] = 'Annuler une session';
  $liens['07-session-reinitialiser-page-1.php'] = 'Réinitialiser une session';
  $liens['08-session-supprimer-page-1.php'] = 'Supprimer une session';
  $liens['09-session-statut.php'] = 'Statut de la session';
  $liens['10-session-authentification-accueil.php'] = 'Gérer les sessions (avec authentification)';
  $liens['11-personnaliser.php'] = 'Conserver des informations d’une visite à une autre';
  $liens['12-synthese-gpcs-page-1.php'] = 'Petite synthèse sur les variables Get/Post/Cookie/Session';
}
// Inclure le fichier qui va afficher la page.
include('../include/index-chapitre.inc.php');
?>
