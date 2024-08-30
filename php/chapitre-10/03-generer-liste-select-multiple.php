<!DOCTYPE html>
<html xmlns="http://www.w3.org/1999/xhtml" lang="fr">
  <head>
    <meta charset="utf-8" />
    <title>Générer une liste d'options à sélection unique</title>
  </head>
  <body>
    <div>

    <?php
    // Liste des langues à afficher dans la liste, sous la 
    // forme d'un tableau associatif donnant le code de
    // la langue (clé du tableau) et l'intitulé de la langue.
    $langues_disponibles = array(
      'E' => 'Espagnol',
      'F' => 'Français',
      'I' => 'Italien');
    // Code de la langue de l'utilisateur
    $langue = 'F';
    ?>
    <!-- construction du formulaire -->
    <form action="00-a-faire.php" method="POST">
    Langue :<br />
    <select name="langue">
    <?php
    // Code PHP générant la partie dynamique du formulaire.
    // Parcourir la liste à afficher et récupérer le code
    // et l'intitulé.
    foreach($langues_disponibles as $code => $intitulé) {
      // Déterminer si la ligne doit être sélectionnée
      //  - oui si le code est égal au code de la langue de 
      //    l'utilisateur
      //  - si c'est le cas, mettre l'attribut "selected" dans
      //    la balise "option", sinon ne rien mettre
      $sélection = ($code == $langue)?'selected="selected"':'';
      // Générer la balise "option" avec la variable $code pour
      // l'option "value", la variable $sélection pour 
      // l'indication de sélection et la variable $intitulé 
      // pour le texte affiché dans la liste.
      echo "<option value=\"$code\" $sélection>$intitulé</option>";
    }
    ?>
    </select>
    </form>

    </div>
  </body>
</html>
