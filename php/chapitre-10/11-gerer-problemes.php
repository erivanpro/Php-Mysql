<?php
// Inclusion du fichier qui contient les définitions de nos 
// fonctions générales.
include('../include/fonctions.inc.php');
// Tester si la page est appelée après validation du formulaire
if (isset($_POST['ok'])) {
  // Récupération de la valeur saisie dans le formulaire
  $nom = isset($_POST['nom'])?$_POST['nom']:'';
  // La valeur saisie est réaffichée dans le formulaire et 
  // dans la page ...
}
?>
<!DOCTYPE html>
<html xmlns="http://www.w3.org/1999/xhtml" lang="fr">
  <head>
    <meta charset="utf-8" />
    <title>Saisie</title>
  </head>
  <body>
    <form action="11-gerer-problemes.php" method="post">
    <div>
      Nom : 
      <input type="text" name="nom" 
        value="<?= vers_formulaire($nom) ?>" />
      <input type="submit" name="ok" value="OK" /><br />
      <?= vers_page($nom) ?>
    </div>
    </form>
  </body>
</html>