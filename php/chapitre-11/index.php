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
  $titre_page = 'Chapitre 11';
  // Liste des liens.
  $liens['<1>'] = 'Connexion et déconnexion';
  $liens['01-connexion.php'] = 'Connexion et déconnexion';
  $liens['<2>'] = 'Requête non préparée';
  $liens['02-nombre-lignes.php'] = 'Nombre de lignes dans le résultat d\'une requête de lecture';
  $liens['03-fetch.php'] = 'Tester les différentes techniques de fetch';
  $liens['04-lecture.php'] = 'Lecture';
  $liens['05-mise-a-jour.php'] = 'Mise à jour';
  $liens['06-gestion-erreurs.php'] = 'Gestion des erreurs';
  $liens['<3>'] = 'Requête préparée';
  $liens['07-stmt-lecture.php'] = 'Lecture';
  $liens['08-stmt-lecture-resultat-stocke.php'] = 'Lecture avec résultat stocké';
  $liens['09-stmt-mise-a-jour.php'] = 'Mise à jour';
  $liens['10-stmt-gestion-erreurs.php'] = 'Gestion des erreurs';
  $liens['<4>'] = 'Gérer les transactions';
  $liens['11-transaction.php'] = 'Gérer les transactions';
  $liens['<5>'] = 'Appeler un programme stocké';
  $liens['12-procedure-stockee-out.php'] = 'Procédure stockée avec paramètre OUT (requête non préparée)';
  $liens['13-stmt-procedure-stockee-out.php'] = 'Procédure stockée avec paramètre OUT (requête préparée)';
  $liens['14-procedure-stockee-resultat.php'] = 'Procédure stockée qui retourne un résultat directement (requête non préparée)';
  $liens['15-stmt-procedure-stockee-resultat.php'] = 'Procédure stockée qui retourne un résultat directement (requête préparée)';
  $liens['16-fonction-stockee.php'] = 'Fonction stockée (requête non préparée)';
  $liens['17-stmt-fonction-stockee.php'] = 'Fonction stockée (requête préparée)';
  $liens['<6>'] = 'Utiliser les types de données BLOB';
  $liens['18-mise-a-jour-blob.php'] = 'Mise à jour d\'une image (requête non préparée)';
  $liens['19-stmt-mise-a-jour-blob.php'] = 'Mise à jour d\'une image (requête préparée)';
  $liens['20-lecture-blob.php'] = 'Lecture d\'une image (requête non préparée)';
  $liens['21-stmt-lecture-blob.php'] = 'Lecture d\'une image (requête préparée)';
  $liens['<7>'] = 'PHP Data Objects (PDO)';
  $liens['22-extension-pdo.php'] = 'Utilisation de l\'extension PHP Data Objects (PDO)';
  $liens['<8>'] = 'Gestion des apostrophes dans le texte des requêtes';
  $liens['23-apostrophe-probleme.php'] = 'Problème';
  $liens['24-apostrophe-solution.php'] = 'Solution';
  $liens['25-construire-requete.php'] = 'Construire une requête';
  $liens['26-apostrophe-stmt.php'] = 'Requêtes préparées';
  $liens['<9>'] = 'Exemples d\'intégration dans des formulaires';
  $liens['27-saisie-collection.php'] = 'Formulaire de saisie en liste';
  $liens['28-charger-images.php'] = 'Formulaire de recherche : chargement préalable des images';
  $liens['29-recherche-livre.php'] = 'Formulaire de recherche';
  $liens['30-saisie-livre.php'] = 'Formulaire de saisie';
}
// Inclure le fichier qui va afficher la page.
include('../include/index-chapitre.inc.php');
?>
