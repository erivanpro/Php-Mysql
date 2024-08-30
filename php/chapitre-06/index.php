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
  $titre_page = 'Chapitre 6';
  // Liste des liens.
  $liens['<2>'] = 'Structure de base d\'une page PHP';
  $liens['2/01-bonjour.php'] = 'Ma première page PHP';
  $liens['2/02-echo.php'] = 'Fonction echo()';
  $liens['2/03-php-html.php'] = 'Page contenant du code PHP en plusieurs endroits';
  $liens['2/04-php-html.php'] = 'Page générée entièrement par du code PHP';
  $liens['<3>'] = 'Configuration de PHP';
  $liens['3/01-phpinfo.php'] = 'Fonction phpinfo()';
  $liens['<4.1-4>'] = 'Constantes - Variables - Types de données - Tableaux';
  $liens['4.1-4/01-constantes.php'] = 'Constantes';
  $liens['4.1-4/02-variables.php'] = 'Initialisation et affectation d\'une variable';
  $liens['4.1-4/03-variable-dynamique.php'] = 'Variable dynamique';
  $liens['4.1-4/04-conversion-chaine-nombre.php'] = 'Conversion d\'une chaîne en nombre';
  $liens['4.1-4/05-lecture-element-tableau.php'] = 'Accéder à un élément individuel d\'un tableau';
  $liens['4.1-4/06-parcourir-tableau.php'] = 'Parcourir un tableau';
  $liens['<4.5>'] = 'Opérateurs';
  $liens['4.5/01-affectation-par-reference.php'] = 'Affectation par référence';
  $liens['4.5/02-operateur-ternaire.php'] = 'L\'opérateur ternaire';
  $liens['4.5/03-operateur-union-null.php'] = 'L\'opérateur d\'union NULL';
  $liens['4.5/04-operateur-comparaison-combinee.php'] = 'L\'opérateur de comparaison combinée';
  $liens['<4.6>'] = 'Structures de contrôle';
  $liens['4.6/01-if.php'] = 'if (première syntaxe)';
  $liens['4.6/02-if-html.php'] = 'if (deuxième syntaxe, avec incorporation de code HTML)';
  $liens['4.6/03-switch.php'] = 'switch (première syntaxe)';
  $liens['4.6/04-switch-html.php'] = 'switch (deuxième syntaxe, avec incorporation de code HTML)';
  $liens['4.6/05-while.php'] = 'while (première syntaxe)';
  $liens['4.6/06-while-html.php'] = 'while (deuxième syntaxe, avec incorporation de code HTML)';
  $liens['4.6/07-do-while.php'] = 'do ... while';
  $liens['4.6/08-for.php'] = 'for (première syntaxe)';
  $liens['4.6/09-for-html.php'] = 'for (deuxième syntaxe, avec incorporation de code HTML)';
  $liens['4.6/10-continue-break.php'] = 'continue - break';
  $liens['<4.7>'] = 'Inclure un fichier';
  $liens['4.7/01-include-1.php'] = 'include';
  $liens['4.7/02-include-2.php'] = 'include (deux inclusions de commun.inc)';
  $liens['4.7/03-include_once.php'] = 'include_once';
  $liens['4.7/04-exemple-utilisation-include.php'] = 'Exemple d\'utilisation de include';
  $liens['<4.8>'] = 'Interrompre le script';
  $liens['4.8/01-exit-sans-message.php'] = 'exit (sans message)';
  $liens['4.8/02-exit-avec-message.php'] = 'exit (avec message)';
}
// Inclure le fichier qui va afficher la page.
include('../include/index-chapitre.inc.php');
?>
