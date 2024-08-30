<?php
// Initialisation d'une variable.
$nom='Olivier';
?>
<!DOCTYPE html>
<html xmlns="http://www.w3.org/1999/xhtml" lang="fr">
  <head>
    <meta charset="utf-8" />
    <title>URL - Page 1</title>
  </head>
  <body>
    <div>
    <!-- lien vers la page 2 en passant la valeur de $nom 
         dans l’URL -->
    <a href="05-url-page-2.php?nom=<?= $nom; ?>">Page 2</a>
    </div>
  </body>
</html>
