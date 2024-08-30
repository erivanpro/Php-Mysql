<!DOCTYPE html>
<html xmlns="http://www.w3.org/1999/xhtml" lang="fr">
  <head>
    <meta charset="utf-8" />
    <title>Manipuler les nombres</title>
    <style>
      h1 { font-family: "Courier New",Courier,monospace ; font-size: 100% ; margin-top: 20pt }
    </style>
  </head>
  <body>
    <div>
    
    <h1>abs()</h1>
    <?php 
    echo 'abs(123) = ',abs(123),'<br />'; 
    echo 'abs(-321) = ',abs(-321); 
    ?>
    
    <h1>ceil()</h1>
    <?php 
    echo 'ceil(123.45) = ',ceil(123.45),'<br />'; 
    echo 'ceil(-123.45) = ',ceil (-123.45); 
    ?>
    
    <h1>floor()</h1>
    <?php 
    echo 'floor(1234.56) = ',floor(1234.56),'<br />'; 
    echo 'floor(-1234.56) = ',floor (-1234.56); 
    ?>
    
    <h1>intdiv()</h1>
    <?php 
    echo 'intdiv(8,3) = ',intdiv(8,3),'<br />'; 
    echo 'intdiv(8.8,3) = ',intdiv(8.8,3); 
    ?>
    
    <h1>max()</h1>
    <?php 
    echo 'max(2**3,3**2,2*3,2+3) = ',max(2**3,3**2,2*3,2+3),'<br />'; 
    echo "max('bleu','blanc','rouge') = ",max('bleu','blanc','rouge'); 
    ?>

    <h1>min()</h1>
    <?php 
    echo 'min(2**3,3**2,2*3,2+3) = ',min(2**3,3**2,2*3,2+3),'<br />'; 
    echo "min('bleu','blanc','rouge') = ",min('bleu','blanc','rouge'); 
    ?>

    <h1>rand()</h1>
    <?php
    echo rand().'<br />';
    echo rand().'<br />';
    echo rand(1,100).'<br />';
    echo rand(1,100).'<br />';
    ?>
    
    <h1>round()</h1>
    <?php 
    echo 'round(1.2) = ',round(1.2),'<br />'; 
    echo 'round(1.5) = ',round(1.5),'<br />'; 
    echo 'round(1.9) = ',round(1.9),'<br />'; 
    echo 'round(123.456,2) = ',round(123.456,2),'<br />'; 
    echo 'round(123.456,-2) = ',round(123.456,-2),'<br />'; 
    echo 'round(2.5,0,PHP_ROUND_HALF_UP) = ',
            round(2.5,0,PHP_ROUND_HALF_UP),'<br />'; 
    echo 'round(2.5,0,PHP_ROUND_HALF_DOWN) = ',
            round(2.5,0,PHP_ROUND_HALF_DOWN),'<br />'; 
    echo 'round(2.5,0,PHP_ROUND_HALF_EVEN) = ',
            round(2.5,0,PHP_ROUND_HALF_EVEN),'<br />'; 
    echo 'round(2.5,0,PHP_ROUND_HALF_ODD) = ',
            round(2.5,0,PHP_ROUND_HALF_ODD),'<br />'; 
    ?>    
        
    </div>
  </body>
</html>