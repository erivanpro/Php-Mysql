<!DOCTYPE html>
<html xmlns="http://www.w3.org/1999/xhtml" lang="fr">
  <head>
    <meta charset="utf-8" />
    <title>Utilisation des filtres (exemple 2)</title>
  </head>
  <body>
    <div>

    <?php
    $texte = "<b>c'est l'été</b>";
    echo "// texte affiché sans précaution<br />\n";
    echo $texte,"<br />\n";
    echo "// FILTER_SANITIZE_SPECIAL_CHARS<br />\n";
    echo filter_var($texte,FILTER_SANITIZE_SPECIAL_CHARS),"<br />\n";
    echo "// FILTER_SANITIZE_STRING<br />\n";
    echo filter_var($texte,FILTER_SANITIZE_STRING),"<br />\n";
    ?>

    </div>
  </body>
</html>