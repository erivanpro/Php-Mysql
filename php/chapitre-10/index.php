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
  $titre_page = 'Chapitre 10';
  // Liste des liens.
  $liens['<1>'] = 'Construire un formulaire dynamiquement';
  $liens['01-generer-formulaire.php'] = 'Générer la totalité d\'un formulaire';
  $liens['02-generer-liste-select-unique.php'] = 'Générer une liste d\'options à sélection unique';
  $liens['03-generer-liste-select-multiple.php'] = 'Générer une liste d\'options à sélection multiple';
  $liens['<2-3>'] = 'Récupérer les données';
  $liens['04-form-saisie-post.htm'] = 'Récupérer les données d\'un formulaire avec $_POST ou $_REQUEST';
  $liens['05-url-page-1.php'] = 'Récupérer les données d\'une URL avec $_GET ou $_REQUEST';
  $liens['06-url-speciaux-page-1.php'] = 'Transmettre des caractères spéciaux dans l\'URL';
  $liens['07-zone-cachee-page-1.php'] = 'Passer des informations dans une zone de formulaire cachée';
  $liens['08-form-saisie.htm'] = 'Traitement des différentes zones d\'un formulaire';
  $liens['09-form-saisie-tableau.htm'] = 'Traitement des différentes zones d\'un formulaire (utilisation d\'un tableau)';
  $liens['<5>'] = 'Contrôler les données récupérées';
  $liens['10-probleme-affichage.php'] = 'Gérer les problèmes d\'affichage';
  $liens['11-gerer-problemes.php'] = 'Gérér les problèmes avec les données saisies';
  $liens['<6>'] = 'Utilisation des filtres';
  $liens['12-filtre-exemple-1.php'] = 'Utilisation des filtres (exemple 1)';
  $liens['13-filtre-exemple-2.php'] = 'Utilisation des filtres (exemple 2)';
  $liens['14-filtre-exemple-tableau.php'] = 'Utilisation des filtres avec un tableau';
  $liens['15-filtre-formulaire.php'] = 'Utiliser des filtres dans le traitement d\'un formulaire';
  $liens['<7>'] = 'Aller sur une autre page';
  $liens['16-aller-autre-page-simple.php'] = 'Aller sur une autre page (exemple simple)';
  $liens['17-aller-autre-page-exemple-1.php'] = 'Aller sur une autre page (exemple 1)';
  $liens['18-aller-autre-page-exemple-2.htm'] = 'Aller sur une autre page (exemple 2)';  
  $liens['<8>'] = 'Echanger un fichier entre le client et le serveur';
  $liens['19-upload.php'] = 'Envoyer un fichier depuis le client (upload)';
  $liens['20-download-formulaire.php'] = 'Télécharger un fichier à partir du serveur (download)';
  $liens['21-download-lien.php'] = 'Télécharger un fichier à partir du serveur (download)';

}
// Inclure le fichier qui va afficher la page.
include('../include/index-chapitre.inc.php');
?>

