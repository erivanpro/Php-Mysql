<!DOCTYPE html>
<html xmlns="http://www.w3.org/1999/xhtml" lang="fr">
  <head>
    <meta charset="utf-8" />
    <title>Cookie - Page 2</title>
  </head>
  <body>
    <div>
    <?php
    if ( isset($_COOKIE['prenom']) ) {
      echo "\$_COOKIE['prenom'] = {$_COOKIE['prenom']}<br />";
    } else {
      echo "\$_COOKIE['prénom'] = <br />";
    }
    if ( isset($_COOKIE['nom']) ) {
      echo "\$_COOKIE['nom'] = {$_COOKIE['nom']}<br />";
    } else {
      echo "\$_COOKIE['nom'] = <br />";
    }
    ?>
    </div>
  </body>
</html>
