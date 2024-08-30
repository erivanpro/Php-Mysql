<!DOCTYPE html>
<html xmlns="http://www.w3.org/1999/xhtml" lang="fr">
  <head>
    <meta charset="utf-8" />
    <title>Manipuler les chaînes de caractères</title>
    <style>
      h1 { font-family: "Courier New",Courier,monospace ; font-size: 100% ; margin-top: 20pt }
    </style>
  </head>
  <body>
    <div>
    
    <h1>strlen()</h1>
    <?php
    $x = 'Olivier Heurtel';
    echo "strlen('$x') = ",strlen($x);
    ?>
    
    <h1>strtolower() - strtoupper() - ucfirst() - ucwords()</h1>
    <?php
    $x = 'OLIVIER HEURTEL';
    $y = 'olivier heurtel';
    echo "strtolower('$x') = ",strtolower($x),'<br />';
    echo "strtoupper('$y') = ",strtoupper($y),'<br />';
    echo "ucfirst('$y') = ",ucfirst($y),'<br />';
    echo "lcfirst('$x') = ",lcfirst($x),'<br />';
    echo "ucwords('$y') = ",ucwords($y),'<br />';
    ?>

    <h1>strcmp() - strcasecmp()</h1>
    <?php
    $x = 'Olivier';
    $y = 'olivier';
    echo "strcmp('$x','$y') = ",strcmp($x,$y),'<br />';
    echo "strcasecmp('$x','$y') = ",strcasecmp($x,$y),'<br />';
    ?>

    <h1>[s]printf()</h1>
    <?php
    echo 'Mise en forme d’une date : ',
         sprintf('%02d/%02d/%04d',1,1,2001),'<br />';
    echo 'Mise en forme de nombres : ',
         sprintf('%01.2f - %01.2f',1/3,12345678.9),'<br />';
    echo 'Pourcentage : ',
         sprintf('%01.2f %%',12.3),'<br />';
    echo 'Utilisation des options de remplissage :<br />';
    echo '<pre>'; // police non proportionnelle
    printf("%'.-10s%'.5.2f<br />",'Livres',9.35); // printf direct
    printf("%'.-10s%'.5.2f<br />",'Disques',99.9); // printf direct
    echo '</pre>';
    echo 'Numérotation des arguments : ',
         sprintf('My name is %2$s, %1$s %2$s.','Olivier','Heurtel'),'<br />';
    ?>
    
    <h1>v[s]printf()</h1>
    <?php
    $données = array(array('Livres',9.35),array('Disques',99.9));
    echo '<code>'; // police non proportionnelle
    foreach($données as $ligne) {
      vprintf("%'.-10s%'.5.2f<BR>",$ligne); // printf direct
    }
    echo "</code>"; 
    ?>
    
    <h1>number_format()</h1>
    <?php
    $x = 1234.567;
    echo "number_format($x) = ",number_format($x),'<br />';
    echo "number_format($x,1,',',' ') = ",
          number_format($x,2,',',' '),'<br />';
    ?>
    
    <h1>ltrim() - rtrim() - trim()</h1>
    <?php
    $x = "\t\t\t x \n\r";
    echo 'strlen($x) = ',strlen($x),'<br />';
    echo 'strlen(ltrim($x)) = ',strlen(ltrim($x)),'<br />';
    echo 'strlen(rtrim($x)) = ',strlen(rtrim($x)),'<br />';
    echo 'strlen(trim($x)) = ',strlen(trim($x)),'<br />';
    $x = '***+-Olivier-+***';
    echo "trim('$x','*+-') = ",trim($x,'*+-'), '<br />';
    ?>

    <h1>substr()</h1>
    <?php
    //    0123456 => pour le contrôle
    $x = 'Olivier';
    echo "substr('$x',3) = ",substr($x,3),'<br />';
    echo "substr('$x',3,2) = ",substr($x,3,2),'<br />';
    echo "substr('$x',-4) = ",substr($x,-4),'<br />';
    echo "substr('$x',-4,3) = ",substr($x,-4,3),'<br />';
    ?>
    
    <h1>str_repeat()</h1>
    <?php
    echo str_repeat('abc',3);
    ?>
    
    <h1>strpos() - strrpos() - stripos() - strripos()</h1>
    <?php
    //       0123456789 … => pour le contrôle
    $mail = 'contact@olivier-heurtel.fr';
    // strrpos
    $position = strrpos($mail,'@');
    echo "@ est à la position $position dans $mail<br />";
    // strpos
    $position = strpos($mail,'olivier');
    echo "'olivier' est à la position $position dans $mail<br />";
    // occurrence en début de chaîne
    $position = strpos($mail,'contact');
    if ($position === FALSE) { // bon test : ===
      echo "'contact' est introuvable dans $mail<br />";
    } else {
      echo "'contact' est à la position $position 
              dans $mail<br />";
    }
    // occurrence non trouvée
    $position = strpos($mail,'information');
    if ($position === FALSE) { // bon test : ===
      echo "'information' est introuvable dans $mail<br />";
    } else {
      echo "'information' est à la position $position 
              dans $mail<br />";
    }
    ?>
    
    <h1>strstr() - stristr() - strrchr()</h1>
    <?php
    $mail = 'Olivier-Heurtel@olivier-heurtel.fr';
    echo "Reste de $mail commençant par :<br />";
    // strrchr
    $reste = strrchr($mail,'-');
    echo "- la dernière occurrence de '-'<br />----> $reste <br />";
    // strstr
    $reste = strstr($mail,'olivier');
    echo "- la première occurrence de 'olivier' 
          (sensible à la casse)<br />----> $reste <br />";
    // stristr
    $reste = stristr($mail,'olivier');
    echo "- la première occurrence de 'olivier' 
          (insensible à la casse)<br />----> $reste <br />";
    echo "Début de $mail terminant par :<br />";
    // strstr
    $reste = strstr($mail,'@',TRUE);
    echo "- la première occurrence de '@'<br />----> $reste <br />";
    ?>
    
    <h1>str_replace() - str_ireplace()</h1>
    <?php
    // première syntaxe
    $x = 'cet été, à la plage';
    $rechercher = 'été';
    $remplacer = 'hiver';
    echo '<b>Première syntaxe :</b><br />';
    echo "$rechercher => $remplacer <br />";
    echo "$x => ",str_replace($rechercher,$remplacer,$x),'<br />';
    // deuxième syntaxe
    $x = array('cet été, à la plage','le bateau bleu et vert');
    $rechercher = array('été','plage','bleu','vert');
    $remplacer = array('hiver','montage','rouge','jaune');
    echo "<b>Deuxième syntaxe :</b><br />";
    foreach($rechercher as $indice => $avant)
      { echo "$avant => $remplacer[$indice]<br />"; }
    // Utilisation de la variable $nombre pour récupérer 
    // le nombre de remplacements.
    $y = str_replace($rechercher,$remplacer,$x,$nombre);
    echo "$x[0] => $y[0]<br />";
    echo "$x[1] => $y[1]<br />";
    echo "$nombre remplacements<br />";
    ?>
    
    <h1>strtr()</h1>
    <?php
    // première syntaxe
    $x = 'cet été, à la plage';
    $avant = 'éèà';
    $après = 'eea';
    echo '<b>Première syntaxe :</b><br />';
    echo "$avant => $après<br />";
    echo "$x => ",
         strtr(iconv('UTF-8','ISO-8859-1',$x),iconv('UTF-8','ISO-8859-1',$avant),$après),
         '<br />';
    // deuxième syntaxe
    $x = 'le bateau bleu et vert';
    $correspondance = array('bleu'=>'rouge','vert'=>'jaune');
    echo '<b>Deuxième syntaxe :</b><br />';
    foreach($correspondance as $avant => $après)
      { echo "$avant => $après<br />"; }
    echo "$x => ",strtr($x,$correspondance),'<br />';
    ?>
        
    </div>
  </body>
</html>