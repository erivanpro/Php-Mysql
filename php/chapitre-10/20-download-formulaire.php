<?php
// Liste des documents (viendrait sans doute d'une
// base de données dans une vraie application).
$documents = array('cv.pdf','photo.png');
// Traitement du formulaire si $_POST non vide
if (! empty($_POST)) {
  // Récupérer le numéro du document.
  // Prendre la clé de la première ligne de $_POST
  // (normalement du type n_x, n étant le numéro du document).
  $numéro = key($_POST);
  // Convertir la chaîne en entier => seul le n° reste.
  $numéro = (integer) $numéro;
  // En déduire le nom du document.
  $nom_fichier = $documents[$numéro];
  // Envoyer l'en-tête d'attachement.
  $header  = "Content-Disposition: attachment; ";
  $header .= "filename=$nom_fichier\n" ;
  header($header);
  // Envoyer l'en-tête du type MIME (ici, "inconnu").
  header("Content-Type: x/y\n");
  // Envoyer le document.
  // Pas d'encodage magic quotes avant de lire le fichier.
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
    <form action="20-download-formulaire.php" method="post">
    <table>
    <tr><th>Document</th><th>Télécharger</th></tr>
    <?php
    // Un petit bout de code PHP pour générer les lignes du
    // tableau présentant la liste des documents.
    // Parcourir la liste des documents et utiliser le nom
    // pour l'affichage et le numéro comme nom de l'image.
    foreach($documents as $numéro => $document) {
      echo sprintf
          (
          "<tr><td>%s</td><td style=\"text-align:center\">%s</td></tr>\n",
          $document,
          "<input type=\"image\" name=\"$numéro\"
          alt=\"download\" src=\"../images/download.png\" />"
          );
    }
    ?>
    </table>
    </form>
  </body>
</html>
