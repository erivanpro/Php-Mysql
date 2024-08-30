<!DOCTYPE html>
<html xmlns="http://www.w3.org/1999/xhtml" lang="fr">
  <head>
    <meta charset="utf-8" />
    <title>error_get_last()</title>
  </head>
  <body>
    <div>

    <?php
    // Générer une erreur (sans l'afficher : @...).
    @readfile('/chemin/vers/fichier_inexistant');
    // Poursuivre le script.
    echo 'suite ...<br />';
    // Afficher des informations sur la dernière erreur.
    foreach (error_get_last() as $clé => $valeur) {
      echo "$clé => $valeur<br />";
    }
    ?>

    </div>
  </body>
</html>
