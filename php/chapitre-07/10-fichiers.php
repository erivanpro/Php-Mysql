<!DOCTYPE html>
<html xmlns="http://www.w3.org/1999/xhtml" lang="fr">
  <head>
    <meta charset="utf-8" />
    <title>Manipuler les fichiers sur le serveur</title>
    <style>
      h1 { font-family: verdana,arial,helvetica,sans-serif ; font-size: 100% ; margin-top: 20pt }
    </style>
  </head>
  <body>
    <div>
    
    <?php
    // Ouvrir un fichier en écriture.
    $f = fopen('../documents/info.txt','wb');
    // Ecrire dans le fichier.
    fwrite($f, 'Olivier HEURTEL');
    // Fermer le fichier.
    fclose($f);
    // Ouvrir un fichier en lecture
    $f = fopen('../documents/info.txt','rb');
    // Lire dans le fichier.
    $texte = fread($f, filesize('../documents/info.txt'));
    // Fermer le fichier.
    fclose($f);
    // Afficher les informations lues.
    echo $texte,'<br />';
    // Plus simple : utiliser file_get_contents.
    $texte = file_get_contents('../documents/info.txt');
    // Afficher les informations lues.
    echo $texte;
    ?>

    </div>
  </body>
</html>