<?php
// Récupération de l'identifiant du livre dont il faut 
// afficher l'image de couverture : passé dans l'URL.
// Utilisation d'un filtre pour s'assurer que la valeur
// passée est bien un entier.
$id = filter_input(INPUT_GET,'id',FILTER_VALIDATE_INT);
// Le filtre a "échoué" : quitter le script.
if ($id === FALSE OR $id === NULL) {
  exit('Paramètre invalide ou absent.');
}
// Connexion et sélection de la base de données.
$db = mysqli_connect('localhost','eniweb','web','eni');
if (! $db) {
  exit('Echec de la connexion.');
}
// Type MIME des images.
$type_mime = 'image/jpeg';
// Exécution d'une requête de lecture de l'image.
$sql = "SELECT couverture FROM livre WHERE id = $id";
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
