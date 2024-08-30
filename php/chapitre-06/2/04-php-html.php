<?php
// Déclaration de variables qui sont utilisées plus loin.
$nom = 'Olivier'; // nom de l'utilisateur
$titre_page = 'Les éditions ENI présentent ...'; // titre de la page
$aujourdhui = date("d/m/Y"); // date du jour
$heure = date("H:i:s"); // heure 
// Génération des balises d'ouverture du document HTML.
echo '<!DOCTYPE html>';
echo '<html xmlns="http://www.w3.org/1999/xhtml" lang="fr">';
echo '<head>';
echo '<meta charset="utf-8" />';
echo "<title>$titre_page</title>";
echo '</head>';
echo '<body>';
echo '<p>';
 /* Affichage du nom de l'utilisateur.
 ** Les tags de mise en gras du nom (<B>) et de retour à la ligne 
 ** (<br />) sont inclus dans la chaîne envoyée par le echo.
 */
echo "Bonjour <b>$nom</b> !<br />";
// Affichage de la date et de l'heure.
echo "Nous sommes le $aujourdhui ; il est $heure.";
echo '</p>';
echo '</body>';
echo '</html>';
?>
