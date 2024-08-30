<!DOCTYPE html>
<html xmlns="http://www.w3.org/1999/xhtml" lang="fr">
  <head>
    <meta charset="utf-8" />
    <title>Générer une liste d'options à sélection multiple</title>
  </head>
  <body>
    <div>

    <?php
    // Liste des fruits à afficher dans la liste, sous la 
    // forme d'un tableau associatif donnant le code du
    // fruits (clé du tableau) et l'intitulé du fruit.
    $fruits_du_marché = array(
      'A' => 'Abricots',
      'C' => 'Cerises',
      'F' => 'Fraises',
      'P' => 'Pêches',
      '?' => 'Ne sait pas');
    // Liste des fruits préférés de l'utilisateur, sous la
    // forme d'un tableau donnant le code des fruits concernés.
    $fruits_préférés = array("A","F");
    // Remarque : nous verrons ultérieurement comment récupérer
    //            ces informations dans une base.
    ?>
    <!-- construction du formulaire -->
    <form action="00-a-faire.php" method="POST">
    Fruits préférés :<br />
    <select name="fruits[]" multiple size="8">
    <?php
    // Code PHP générant la partie dynamique du formulaire.
    // Parcourir la liste à afficher et récupérer le code
    // et l'intitulé.
    foreach($fruits_du_marché as $code => $intitulé) {
      // Déterminer si la ligne doit être sélectionnée
      //  - oui si le code figure dans la liste des fruits
      //    préférés de l'utilisateur => recherche de $code
      //    dans $fruits_préférés avec la fonction in_array
      //  - si c'est le cas, mettre l'attribut "selected" dans
      //    la balise "option", sinon ne rien mettre.
      $sélection = 
        in_array($code,$fruits_préférés)?'selected="selected"':'';
      // Générer la balise "option" avec la variable $code pour
      // l'attribut "value", la variable $sélection pour 
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
