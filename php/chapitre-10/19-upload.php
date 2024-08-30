<?php
// Inclusion du fichier qui contient les fonctions générales.
include('../include/fonctions.inc.php');
// Initialisation de la variable de message.
$message = '';
// Traitement du formulaire.
if (isset($_POST['ok'])) {
  // Récupérer les informations sur le fichier.
  $informations = $_FILES['fichier'];
  // En extraire :
  //    - son nom
  $nom = $informations['name'];
  //    - son type MIME
  $type_mime = $informations['type'];
  //    - sa taille
  $taille = $informations['size'];
  //    - l'emplacement du fichier temporaire
  $fichier_temporaire = $informations['tmp_name'];
  //    - le code d'erreur
  $code_erreur = $informations['error'];
  // Contrôles et traitement
  switch ($code_erreur) {
  case UPLOAD_ERR_OK :
    // Fichier bien reçu.
    // Déterminer sa destination finale
    $destination = "../documents/$nom";
    // Copier le fichier temporaire (tester le résultat).
    if (copy($fichier_temporaire,$destination)) {
      // Copie OK => mettre un message de confirmation.
      $message  = "Transfert terminé - Fichier = $nom - ";
      $message .= "Taille = $taille octets - ";
      $message .= "Type MIME = $type_mime.";
    } else {
      // Problème de copie => mettre un message d'erreur.
      $message = 'Problème de copie sur le serveur.';
    }
    break;
  case UPLOAD_ERR_NO_FILE :
    // Pas de fichier saisi.
    $message = 'Pas de fichier saisi.';
    break;
  case UPLOAD_ERR_INI_SIZE :
    // Taille fichier > upload_max_filesize.
    $message  = "Fichier '$nom' non transféré ";
    $message .= ' (taille > upload_max_filesize).';
    break;
  case UPLOAD_ERR_FORM_SIZE :
    // Taille fichier > MAX_FILE_SIZE.
    $message  = "Fichier '$nom' non transféré ";
    $message .= ' (taille > MAX_FILE_SIZE).';
    break;
  case UPLOAD_ERR_PARTIAL :
    // Fichier partiellement transféré.
    $message  = "Fichier '$nom' non transféré ";
    $message .= ' (problème lors du tranfert).';
    break;
  case UPLOAD_ERR_NO_TMP_DIR :
    // Pas de répertoire temporaire.
    $message  = "Fichier '$nom' non transféré ";
    $message .= ' (pas de répertoire temporaire).';
    break;
  case UPLOAD_ERR_CANT_WRITE :
    // Erreur lors de l'écriture du fichier sur disque.
    $message  = "Fichier '$nom' non transféré ";
    $message .= ' (erreur lors de l\'écriture du fichier sur disque).';
    break;
  case UPLOAD_ERR_EXTENSION :
    // Transfert stoppé par l'extension.
    $message  = "Fichier '$nom' non transféré ";
    $message .= ' (transfert stoppé par l\'extension).';
    break;
  default :
    // Erreur non prévue !
    $message  = "Fichier non transféré ";
    $message .= " (erreur inconnue : $code_erreur ).";
  }
}
?>
<!DOCTYPE html>
<html xmlns="http://www.w3.org/1999/xhtml" lang="fr">
  <head>
    <meta charset="utf-8" />
    <title>Upload</title>
  </head>
  <body>
    <form action="19-upload.php" method="post" 
                   enctype="multipart/form-data">
    <div>
      Fichier : 
      <input size="100" type="file" name="fichier" />
      <input type="submit" name="ok" value="OK" /><br />
      <?php echo vers_page($message); ?>
    </div>
    </form>
  </body>
</html>
