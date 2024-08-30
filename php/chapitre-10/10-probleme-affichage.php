<!DOCTYPE html>
<html xmlns="http://www.w3.org/1999/xhtml" lang="fr">
  <head>
    <meta charset="utf-8" />
    <title>Gérer les problèmes d'affichage</title>
    <style>
      h1 { font-family: "Courier New",Courier,monospace ; font-size: 100% ; margin-top: 20pt }
    </style>
  </head>
  <body>
    <div>
    
    <h1>htmlspecialchars()</h1>
    <?php
    $texte = 'Olivier & Co. a déclaré : "c\'est l\'été !"';
    echo htmlspecialchars($texte,ENT_QUOTES,'UTF-8');
    ?>

    <h1>htmlentities()</h1>
    <?php
    $texte = 'Olivier & Co. a déclaré : "c\'est l\'été !"';
    echo htmlentities($texte,ENT_QUOTES,'UTF-8');
    ?>

    <h1>nl2br()</h1>
    <?php
    $texte = "Première ligne.\nDeuxième ligne.";
    echo nl2br($texte);
    ?>

    <h1>strip_tags()</h1>
    <?php
    $texte = "<b>Olivier</b> <i>Heurtel</i>";
    echo $texte,'<br />';
    echo strip_tags($texte),'<br />';
    echo strip_tags($texte,'<b>'),'<br />';
    ?>

    </div>
  </body>
</html>