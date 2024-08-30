<!DOCTYPE html>
<html xmlns="http://www.w3.org/1999/xhtml" lang="fr">
  <head>
    <meta charset="utf-8" />
    <title><?php echo $titre_page; ?></title>
    <style>
      h1 { font-family: verdana,arial,helvetica,sans-serif ; font-size: 100% ; margin-top: 20pt }
    </style>
  </head>
  <body>
    <div>
    <?php
    if ($afficher_source) {
      // Affichage du code source d'une page.
      highlight_file($source);
    } else {
      // Code JavaScript pour l'affichage du lien dans une autre fenêtre.
      $onclick="window.open(this.href,'_blank'); return false;";
      // Affichage d'une liste de liens.
      foreach ($liens as $lien => $titre) {
        if (preg_match('/<[0-9.-]+>/',$lien) > 0) { // titre séparateur
          echo "<h1>$titre</h1>\n";
        } else {
          printf // lien vers la page
            (
            "<a href=\"%s\" onclick=\"%s\">%s</a>&nbsp;&nbsp;&nbsp;&nbsp;",
            $lien,
            $onclick,
            htmlentities($titre,ENT_QUOTES,'UTF-8')
            );
          printf // lien vers le code source de la page
            (
            "<a href=\"index.php?source=%s\" onclick=\"%s\">(source)</a><br />\n",
            $lien,
            $onclick
            );
        }
      }
    }
    ?>
    </div>
  </body>
</html>