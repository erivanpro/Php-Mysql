<!DOCTYPE html>
<html xmlns="http://www.w3.org/1999/xhtml" lang="fr">
  <head>
    <meta charset="utf-8" />
    <title>continue - break</title>
  </head>
  <body>
    <div>
    
    <?php 
    $couleurs = array('bleu','invisible','blanc','rouge'); 
    for ($i = 0; $i <= 3; $i++) { 
      // Passer à l'itération suivante pour  
      // la couleur "invisible" 
      if ($couleurs[$i] == 'invisible') { 
        continue; 
      } 
      echo "$couleurs[$i] "; 
    } 
    echo '<br />'; 
    for ($i = 0; $i <= 3; $i++) { 
      // Interrompre la boucle à la couleur "invisible" 
      if ($couleurs[$i] == 'invisible') { 
        break; 
      } 
      echo "$couleurs[$i] "; 
    } 
    ?>
    
    </div>
  </body>
</html>

