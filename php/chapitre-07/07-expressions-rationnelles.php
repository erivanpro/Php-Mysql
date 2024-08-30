<!DOCTYPE html>
<html xmlns="http://www.w3.org/1999/xhtml" lang="fr">
  <head>
    <meta charset="utf-8" />
    <title>Utiliser les expressions rationnelles</title>
    <style>
      h1 { font-family: verdana,arial,helvetica,sans-serif ; font-size: 100% ; margin-top: 20pt }
    </style>
  </head>
  <body>
    <div>
    
    <h1>Quantificateur gourmand / non gourmand</h1>
    <?php
    $texte = '<a href="http://www.olivier-heurtel.fr/">Auteur</a>';
    echo htmlentities($texte),'<br />';
    // Quantificateur gourmand.
    $motif = '#<a href=(.*)>#';
    preg_match($motif,$texte,$résultat);
    echo htmlentities($motif),'<br />';
    echo ' => ',htmlentities($résultat[1]),'<br />';
    // Quantificateur non gourmand.
    $motif = '#<a href=(.*?)>#';
    preg_match($motif,$texte,$résultat);
    echo htmlentities($motif),'<br />';
    echo ' => ',htmlentities($résultat[1]);
    ?>
    
    <h1>Références arrières</h1>
    <?php
    $texte = '<personne><nom>Heurtel</nom><prenom>Olivier</prenom></personne>';
    $motif = '#<(prenom|nom)>(.*?)</\1>#';
    preg_match_all($motif,$texte,$résultat);
    echo htmlentities($texte),'<br />';
    echo htmlentities($motif),'<br />';
    echo ' => ',htmlentities($résultat[2][0]),'<br />';
    echo ' => ',htmlentities($résultat[2][1]);
    ?>
    
    <h1>Assertions</h1>
    <?php
    $texte = '<img src="images/logo.png" alt="Logo" />...<img src="http://monsite.com/images/logo.png" alt="Logo" />';
    echo htmlentities($texte),'<br />';
    $motif = '#<img(?:.+?)src="(.+?)"#';
    echo htmlentities($motif),'<br />';
    preg_match_all($motif,$texte,$résultat);
    echo ' => ',htmlentities($résultat[1][0]),'<br />';
    echo ' => ',htmlentities($résultat[1][1]),'<br />';
    $motif = '#<img(?:.+?)src="(?=http)(.+?)"#';
    echo htmlentities($motif),'<br />';
    preg_match_all($motif,$texte,$résultat);
    echo ' => ',htmlentities($résultat[1][0]),'<br />';
    echo ' => ',htmlentities($résultat[1][1]);
    ?>
    
    <h1>Vérifier la structure d'une chaîne</h1>
    <?php
    // Vérifier qu'une chaîne commence par une lettre et 
    // est suivie d’au moins 3 lettres ou chiffres ou caractères 
    // spéciaux _(#*$).
    $motif = '/^[a-z][a-z0-9_#*$]{3,}/i';
    // Tableau contenant les chaînes à tester.
    $chaînes[] = 'A0_#b*1$2'; // OK;
    $chaînes[] = '0_#b*1$2';  // ne commence pas par une lettre;
    $chaînes[] = 'A0_';       // longueur insuffisante;
    $chaînes[] = 'A0_€#';     // caractère invalide;
    // Utilisation de preg_match.
    foreach ($chaînes as $chaîne) {
      if (preg_match($motif,$chaîne) == 0) {
        echo "$chaîne => pas OK<br />";
      } else {
        echo "$chaîne => OK<br />";
      }
    }?>
    
    <h1>Vérifier le format d'une chaîne contenant une date</h1>
    <?php
    // Vérifier qu’une chaîne à une structure conforme à celle
    // d'une date au format [J]J/[M]M/AAAA et récupérer les
    // 3 composantes jour, mois et année.
    $motif = '#^([0-9]{1,2})/([0-9]{1,2})/([0-9]{4})$#';
    // Tableau contenant les chaînes à tester.
    $dates[] = '21/09/2001'; // OK
    $dates[] = '1/2/2001';   // OK
    $dates[]  = '21/09/01';   // année incomplète
    // Utilisation de preg_match.
    foreach ($dates as $date) {
      $ok = (preg_match($motif,$date,$résultat) > 0);
      if ($ok) {
        echo "$date valide.<br />";
        echo "- jour = $résultat[1]<br />";
        echo "- mois = $résultat[2]<br />";
        echo "- année = $résultat[3]<br />";
      } else {
        echo "$date invalide.<br />";
      }
    }
    ?>

    <h1>Réorganiser une chaîne</h1>
    <?php
    // Utiliser preg_replace pour réorganiser une chaîne.
    // En l'occurrence, il s'agit de transformer une date
    // au format JJ/MM/AAAA en date au format AAAA-MM-JJ
    $avant = '17/11/1969';
    $après = preg_replace(
                 '#^([0-9]{2})/([0-9]{2})/([0-9]{4})$#',
                 '$3-$2-$1',
                 $avant);
    echo "$avant => $après";
    ?>
        
    </div>
  </body>
</html>