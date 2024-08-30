<?php
// Inclure le fichier qui contient les définitions de nos 
// fonctions générales.
include('../include/fonctions.inc.php');
// Tester comment le script est appelé.
if (isset($_POST['ok'])) {
  // Traitement du formulaire.
  // Récupérer les valeurs saisies dans le formulaire.
  $nom = trim($_POST['nom']);
  // Contrôler les valeurs saisies.
  if ($nom == '')
    { $message .= "Le nom est obligatoire.\n"; }
  if (strlen($nom) > 10)
    { $message .= "Le nom doit avoir au plus 10 caractères.\n"; }
  // Tester s'il y a des erreurs.
  if ($message == '') {
    // Pas d'erreur.
    // Rediriger l'utilisateur vers une autre page et interrompre
    // l'exécution du script.
    header('location: 00-accueil.php');
    exit;
  } else {
    // Erreur.
    // Préparer le message pour l'affichage.
    $message = vers_page($message);
  }
}
// Dans le code HTML qui suit, inclusion d'un petit bout de
// code PHP pour afficher le message.
?>
<!DOCTYPE html>
<html xmlns="http://www.w3.org/1999/xhtml" lang="fr">
  <head>
    <meta charset="utf-8" />
    <title>Erreur</title>
  </head>
  <body>
    <!-- Petit formulaire contenant un bouton permettant
    ---- de revenir en arrière (avec du JavaScript) pour corriger.
    -->
    <form>
    <div>
      <?php echo $message; ?><br />
      <input type="button" value="Corriger" onClick="self.history.back()">
    </div>
    </form>
  </body>
</html>
