<!DOCTYPE html>
<html xmlns="http://www.w3.org/1999/xhtml" lang="fr">
  <head>
    <meta charset="utf-8" />
    <title>Accéder à un élément individuel d'un tableau</title>
  </head>
  <body>
    <div>
    
    <?php
    $nombres = array('zéro','un','deux','trois',5 => 'cinq','six','un' => 1,'sept',-1 => 'moins un');
    echo $nombres[1],'<br />';
    echo $nombres['un'],'<br />';
    $villes = array('FRANCE' => array('Paris','Lyon','Nantes'),'ITALIE' => array('Rome','Venise'));
    echo $villes['FRANCE'][0],'<br />';
    echo $villes['ITALIE'][1],'<br />';
    echo "\$nombres[1] = $nombres[1]<br />";
    echo "\$nombres['un'] = {$nombres['un']}<br />";
    echo "\$villes['FRANCE'][0] = {$villes['FRANCE'][0]}<br />";
    ?>

    </div>
  </body>
</html>