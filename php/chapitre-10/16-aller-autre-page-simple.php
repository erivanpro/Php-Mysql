<?php
// Affecter une valeur à $nom si un nombre tiré aléatoirement
// entre 0 et 1 est égal à 1.
$nom = (rand(0,1)==1)?'Olivier':'';
// Tester si $nom est renseigné.
if ($nom == '') {
  // La variable $nom est vide, ce n'est pas normal :
  // => rediriger l'utilisateur vers une page d'erreur.
  header('location: 16-aller-autre-page-simple-erreur.htm');
  // Interrompre l'exécution de ce script.
  exit;
}
// La variable $nom n'est pas vide, laisser le script se poursuivre.
$message = "Bonjour $nom !"; // préparer un message
?>
<!DOCTYPE html>
<html xmlns="http://www.w3.org/1999/xhtml" lang="fr">
  <head>
    <meta charset="utf-8" />
    <title>Saisie</title>
  </head>
  <body>
  <p><?php echo $message; ?></p>
  </body>
</html>
