<?php
// Inclusion du fichier qui contient les fonctions générales.
include('../include/fonctions.inc.php');
// Variable pour un éventuel message.
$message = '';
// Traitement du formulaire.
if (isset($_POST['ok'])) {
  // Récupérer le texte saisi.
  $recherche = $_POST['recherche'];
  if (empty($recherche)) {
    $message = 'Vous devez saisir le texte recherché.';
  } else {
    // Connexion.
    // Utilisation de l'opérateur @ pour masquer les alertes.
    $db = @mysqli_connect('localhost','eniweb','web','eni');
    if ($db === FALSE) {
      $erreur = mysqli_connect_error();
      $message = "Erreur de connexion à la base de données ($erreur).";
    } else {
      // Exécuter la requête de recherche.
      $sql = 'SELECT liv.id,liv.titre,liv.sous_titre,col.nom ' .
             'FROM livre liv JOIN collection col ' .
             '     ON (liv.id_collection = col.id) ' .
             'WHERE MATCH(titre,sous_titre,description) ' .
             '      AGAINST(?)';
      if ($requête = mysqli_prepare($db,$sql)) {
        $ok = mysqli_stmt_bind_param($requête,'s',$recherche);
        if ($ok) { 
          $ok = mysqli_stmt_bind_result
                  ($requête,$id,$titre,$sous_titre,$collection);
        }
        if ($ok) { $ok = mysqli_execute($requête); }
        if (! $ok) { $message = mysqli_stmt_error($requête);}
      } else {
        $message = mysqli_error($db);
      }
      if ($message) {
        $message = "Erreur lors de la recherche ($message).";
      }
    }
  }
}
// Affichage de la page ...
?>
<!DOCTYPE html>
<html xmlns="http://www.w3.org/1999/xhtml" lang="fr">
  <head>
    <meta charset="utf-8" />
    <title>Rechercher un livre</title>
    <style>
    table { border-collapse: collapse; }
    table, td, th { border: 0px solid black; }
    td, th { padding: 4px; }
    </style>
  </head>
  <body>
    <!-- Formulaire de recherche (très simple !) -->
    <form action="<?= $_SERVER['REQUEST_URI'] ?>" method="post">
    <div>Rechercher : 
    <input type="text" name="recherche" 
       value="<?php echo vers_formulaire($recherche) ?>" />
    <input type="submit" name="ok" value="OK" /></div>
    </form>
    <!-- Résultat de la recherche -->
    <?php
    // Compteur du nombre de livres trouvés.
    $nombre_livres = 0;
    if ($requête) { // S'il y a un résultat à afficher
      // Balise d'ouverture de la table HTML.
      echo '<table>',"\n";
      // Boucle de fetch.
      while (mysqli_stmt_fetch($requête)) {
        $nombre_livres++;
        // Mise en forme des données.
        $titre = vers_page($titre);
        $sous_titre = vers_page($sous_titre);
        $collection = vers_page($collection);
        // Génération de la ligne de la table HTML.
        // L'image est affichée par appel à un autre script.
        printf(
        "<tr><td>%s</td><td>%s<br />%s<br />%s</td></tr>\n",
        "<img alt=\"\" src=\"00-image-livre.php?id=$id\" />",
        "<b>$titre</b>",
        $sous_titre,
        "Collection : $collection");
      } // while
      // Balise de fermeture de la table HTML.
      echo '</table>',"\n";
      // Si le résultat est vide, afficher un message.
      if ($nombre_livres == 0) {
        $message = 'Aucun livre trouvé.';
      }
    } // if ($requête)
    ?>
    <div><?php echo vers_page($message); ?></div>
  </body>
</html>