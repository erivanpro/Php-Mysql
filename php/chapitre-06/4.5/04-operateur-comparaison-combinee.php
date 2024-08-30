<!DOCTYPE html>
<html xmlns="http://www.w3.org/1999/xhtml" lang="fr">
  <head>
    <meta charset="utf-8" />
    <title>L'opérateur de comparaison combinée</title>
  </head>
  <body>
    <div>
    <?php 
    // Initialisation de trois variables. 
    $a = 1+2+3+4+5+6+7+8+9; 
    $b = 1+3+5+7+9; 
    $c = (9*10)/2; 
    echo "<b>\$a = $a - \$b = $b - \$c = $c </b><br />"; 
    // Comparaisons. 
    echo '$a &lt;=&gt; $b : ',$a <=> $b,'<br />'; 
    echo '$b &lt;=&gt; $a : ',$b <=> $a,'<br />'; 
    echo '$a &lt;=&gt; $c : ',$a <=> $c,'<br />'; 
    // Fonctionne aussi avec des chaînes de caractère. 
    $a = 'abc'; 
    $b = 'xyz'; 
    echo "<b>\$a = '$a' - \$b = '$b' </b><br />"; 
    // Comparaisons. 
    echo '$a &lt;=&gt; $b : ',$a <=> $b,'<br />'; 
    echo '$b &lt;=&gt; $a : ',$b <=> $a,'<br />'; 
    ?>
    </div>
  </body>
</html>
