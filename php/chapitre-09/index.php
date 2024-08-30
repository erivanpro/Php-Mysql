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
  $titre_page = 'Chapitre 9';
  // Liste des liens.
  $liens['01-error_reporting.php'] = 'error_reporting()';
  $liens['02-error_log.php'] = 'error_log()';
  $liens['03-set_error_handler.php'] = 'set_error_handler()';
  $liens['04-restore_error_handler.php'] = 'restore_error_handler()';
  $liens['05-set_exception_handler.php'] = 'set_exception_handler()';
  $liens['06-restore_exception_handler.php'] = 'restore_exception_handler()';
  $liens['07-trigger_error.php'] = 'trigger_error()';
  $liens['08-error_get_last.php'] = 'error_get_last()';
  $liens['09-error_clear_last.php'] = 'error_clear_last()';
}
// Inclure le fichier qui va afficher la page.
include('../include/index-chapitre.inc.php');
?>

