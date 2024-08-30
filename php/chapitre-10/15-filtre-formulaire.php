<?php
// Tester si la page est appelée après validation du formulaire
if (filter_has_var(INPUT_POST, 'ok')) {
  // Définir les filtres pour les données saisies.
  $filtres =
    array
      (
      'nom' => array('filter'=> FILTER_SANITIZE_STRING,
                     'flags' => FILTER_FLAG_ENCODE_LOW)
      );
  // Récupérer la saisie filtrée.
  $saisie = filter_input_array(INPUT_POST,$filtres);
  $nom = $saisie['nom'];
  // La valeur saisie est réaffichée dans le formulaire et 
  // dans la page ...
}
?>
<!DOCTYPE html>
<html xmlns="http://www.w3.org/1999/xhtml" lang="fr">
  <head>
    <meta charset="utf-8" />
    <title>Saisie</title>
  </head>
  <body>
    <form action="15-filtre-formulaire.php" method="post">
    <div>
      Nom : 
      <input type="text" name="nom" 
        value="<?php echo $nom; ?>" />
      <input type="submit" name="ok" value="OK" /><br />
      <?php echo $nom; ?>
    </div>
    </form>
  </body>
</html>
