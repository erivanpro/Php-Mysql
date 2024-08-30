<!DOCTYPE html>
<html xmlns="http://www.w3.org/1999/xhtml" lang="fr">
  <head>
    <meta charset="utf-8" />
    <title>Parcourir un tableau</title>
    <style>
      h1 { font-family: verdana,arial,helvetica,sans-serif ; font-size: 100% ; margin-top: 20pt }
    </style>
  </head>
  <body>
  <div>
  <?php
  // Initialisation d'un tableau.
  $nombres = array('zéro','un','deux',
                   'zéro' => 0,'un' => 1,'deux' => 2);
  // Parcours du tableau avec la première syntaxe.
  echo '<h1>Première syntaxe :</h1>';
  foreach($nombres as $nombre) {
    echo "$nombre<br />";
  }
  // Parcours du tableau avec la deuxième syntaxe
  echo '<h1>Deuxième syntaxe :</h1>';
  foreach($nombres as $clé => $nombre) {
    echo "$clé => $nombre<br />";
  }
  ?>
  <?php
  // Initialisation d'un tableau à deux dimensions.
  $capitales = [['FRANCE','Paris'],['ITALIE','Rome']];
  // Parcours du tableau avec foreach et list.
  echo '<h1>Troisième syntaxe :</h1>';
  foreach ($capitales as list($pays,$ville)) {
    echo "$pays : $ville<br />";
  }
  // Parcours du tableau avec foreach et [].
  echo '<h1>Quatrième syntaxe :</h1>';
  foreach ($capitales as [$pays,$ville]) {
    echo "$pays : $ville<br />";
  }
  ?>
  <?php
  // Initialisation d'un tableau à deux dimensions.
  $capitales = [['pays' => 'FRANCE','ville' => 'Paris'],
                ['pays' => 'ITALIE','ville' => 'Rome']];
  // Parcours du tableau avec foreach et list.
  echo '<h1>Cinquième syntaxe :</h1>';
  foreach ($capitales as list('pays' => $pays,'ville' => $ville)) {
    echo "$pays : $ville<br />";
  }
  // Parcours du tableau avec foreach et [].
  echo '<h1>Sixième syntaxe :</h1>';
  foreach ($capitales as ['pays' => $pays,'ville' => $ville]) {
    echo "$pays : $ville<br />";
  }
  ?>
  </div>
  </body>
</html>