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
  $titre_page = 'Chapitre 13';
  // Liste des liens.
  $liens['01-lire-document-XML.php'] = 'Lire un document XML';
  $liens['02-generer-PDF.php'] = 'Générer un document PDF';
  $liens['03-generer-image.php'] = 'Générer une image';
}
// Inclure le fichier qui va afficher la page.
include('../include/index-chapitre.inc.php');
?>
