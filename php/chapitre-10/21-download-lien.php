<?php
// Liste des documents (viendrait sans doute d'une
// base de données dans une vraie application).
$documents = array('cv.pdf','photo.png');
// Traitement du formulaire si $_GET non vide
if (! empty($_GET)) {
  // Récupérer le numéro du document.
  $numéro = $_GET['no'];
  // En déduire le nom du document.
  $nom_fichier = $documents[$numéro];
  // Envoyer l'en-tête d'attachement.
  $header  = "Content-Disposition: attachment; ";
  $header .= "filename=$nom_fichier\n" ;
  header($header);
  // Envoyer l'en-tête du type MIME (ici, "inconnu").
  header("Content-Type: x/y\n");
  // Envoyer le document.
  readfile("../documents/$nom_fichier");
}
?>
<!DOCTYPE html>
<html xmlns="http://www.w3.org/1999/xhtml" lang="fr">
  <head>
    <meta charset="utf-8" />
    <title>Download</title>
    <style>
    table { border-collapse: collapse; }
    table, td, th { border: 1px solid black; }
    td, th { padding: 4px; }
    </style>
  </head>
  <body>
    <table>
    <tr><th>Document</th></tr>
    <?php
    // Un petit bout de code PHP pour générer les lignes du
    // tableau présentant la liste des documents.
    // Parcourir la liste des documents et utiliser le nom
    // pour l'affichage et le numéro dans.
    foreach($documents as $numéro => $document) {
      echo sprintf
          (
          "<tr><td>%s</td></tr>\n",
          "<a href=\"21-download-lien.php?no=$numéro\">$document</a>"
          );
    }
    ?>
    </table>
  </body>
</html>