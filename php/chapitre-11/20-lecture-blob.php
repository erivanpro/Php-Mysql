<?php
// Connexion et sélection de la base de données.
$db = mysqli_connect('localhost','eniweb','web','eni');
if (! $db) {
  exit('Echec de la connexion.');
}
// Titre du livre dont il faut afficher l'image 
// de couverture et type MIME de l'image (ici JPEG).
$titre= 'PHP 7';
$type_mime = 'image/jpeg';
// Exécution d'une requête de lecture de l'image.
$sql = "SELECT couverture FROM livre WHERE titre = '$titre'";
$requête = mysqli_query($db,$sql);
$ligne = mysqli_fetch_assoc($requête);
// Déconnexion.
$ok = mysqli_close($db);
// Envoi de l'image au navigateur (le type MIME de l'image
// est communiqué au navigateur à l'aide de la fonction 
// header).
header("Content-type: $type_mime");
echo $ligne['couverture'];
?>
