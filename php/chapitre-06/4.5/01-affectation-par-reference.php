<!DOCTYPE html>
<html xmlns="http://www.w3.org/1999/xhtml" lang="fr">
  <head>
    <meta charset="utf-8" />
    <title>Affectation par référence</title>
  </head>
  <body>
    <div>
    <?php 
    // Initialisation d'une variable. 
    $nom = 'Olivier'; 
    // Affectation dans une autre variable par référence. 
    $patronyme = &$nom; 
    // Affichage du résultat. 
    echo "<b>Initialement :</b><br />"; 
    echo "\$nom = $nom<br />"; 
    echo "\$patronyme = $patronyme<br />"; 
    // Modification de première variable. 
    $nom = 'Heurtel'; 
    // Affichage du résultat. 
    echo "<b>Après modification de \$nom :</b><br />"; 
    echo "\$nom = $nom<br />"; 
    echo "\$patronyme = $patronyme<br />"; 
    ?>
    </div>
  </body>
</html>
