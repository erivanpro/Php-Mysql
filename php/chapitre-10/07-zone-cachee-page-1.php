<?php
// Initialisation d'une variable.
$nom='Olivier & Xavier';
?>
<!DOCTYPE html>
<html xmlns="http://www.w3.org/1999/xhtml" lang="fr">
  <head>
    <meta charset="utf-8" />
    <title>Zone de formulaire cachée - Page 1</title>
  </head>
  <body>
    <div>
    <!-- lien vers la page 2 avec un bouton de formulaire -->
    <form action="07-zone-cachee-page-2.php" method="post">
    <!-- l'information à transmettre est cachée -->
    <input type="hidden" name="nom" value="<?= $nom; ?>" />
    <input type="submit" name="page2" value="Page 2" />
    </form>
    </div>
  </body>
</html>