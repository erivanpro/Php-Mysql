<?php
// Déclaration de variables qui seront utilisées plus loin.
// Cette section de code PHP ne génère par de sortie dans la page
// HTML (pas d’appel à echo).
$nom = 'Olivier'; // nom de l'utilisateur
$titre_page = 'Les éditions ENI présentent ...'; // titre de la page
$aujourdhui = date("d/m/Y"); // date du jour
$heure = date("H:i:s"); // heure 
?>
<!DOCTYPE html>
<html xmlns="http://www.w3.org/1999/xhtml" lang="fr">
  <head>
    <meta charset="utf-8" />
    <title>
    <?php /* affichage du titre */ echo $titre_page; ?>
    </title>
  </head>
  <body>
    <p>
    <?php
    /* Affichage du nom de l'utilisateur.
    ** Les tags de mise en gras du nom (<B>) et de retour à la ligne 
    ** (<br />) sont inclus dans la chaîne envoyée par le echo.
    */
    echo "Bonjour <b>$nom</b> !<br />";
    // Affichage de la date et de l'heure
    echo "Nous sommes le $aujourdhui ; il est $heure.";
    ?>
    </p>
  </body>
</html>
