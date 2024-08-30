<?php
// Tester si c'est le deuxième appel de la page.
if (! isset($_GET['retour'])) {
  // Non ...
  // Déposer le cookie.
  setcookie('test','test');
  // Et recharger la page avec une information dans
  // l'URL indiquant que c'est le deuxième passage.
  header('Location: 04-tester-cookie.php?retour=1');
  exit;
}
// Sinon, laisser la page s'afficher ...
?>
<!DOCTYPE html>
<html xmlns="http://www.w3.org/1999/xhtml" lang="fr">
  <head>
    <meta charset="utf-8" />
    <title>Tester si le poste accepte les cookies</title>
  </head>
  <body>
    <div>
    <?php
    // Tester si le cookie est "revenu".
    if (isset($_COOKIE['test'])) { // oui ...
      echo 'Cookie accepté';
    } else { // non ...
      echo 'Cookie refusé';
    }
    ?>
    </div>
  </body>
</html>
