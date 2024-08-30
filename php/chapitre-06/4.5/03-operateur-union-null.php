<!DOCTYPE html>
<html xmlns="http://www.w3.org/1999/xhtml" lang="fr">
  <head>
    <meta charset="utf-8" />
    <title>L'opérateur d'union NULL</title>
  </head>
  <body>
    <div>
    <?php
    // Affichage d'un message dépendant de la valeur de $nom.
    // Pour l'instant, cette variable n'est pas initialisée.
    echo 'Bonjour '.($nom??'inconnu').' ! <br />';
    // Affectation d'une valeur à la variable $nom.
    $nom = 'Olivier';
    // Nouvelle tentative.
    echo 'Bonjour '.($nom??'inconnu').' ! <br />';
    // Fonctionne avec plusieurs opérandes.
    // Ici, la variable $surnom n'est pas initialisée.
    echo 'Bonjour '.($surnom??$nom??'inconnu').' ! <br />';
    ?>
    </div>
  </body>
</html>
