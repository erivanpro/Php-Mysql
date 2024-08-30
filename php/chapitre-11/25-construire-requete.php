<!DOCTYPE html>
<html xmlns="http://www.w3.org/1999/xhtml" lang="fr">
  <head>
    <meta charset="utf-8" />
    <title>Construire une requête</title>
  </head>
  <body>
    <div>

    <?php 
    function construire_requête($db,$sql) { 
      // Récupérer le nombre de paramètres. 
      $nombre_param = func_num_args(); 
      // Boucler sur tous les paramètres à partir du troisième. 
      for($i=2;$i<$nombre_param;$i++) { 
        // Récupérer la valeur du paramètre. 
        $valeur = func_get_arg($i); 
        // Si c'est une chaîne, l'échapper. 
        if (is_string($valeur)) { 
          $valeur = mysqli_escape_string($db,$valeur); 
        } 
        // Mettre la valeur à son emplacement %n (n = $i-1). 
        $sql = str_replace('%'.($i-1),$valeur,$sql); 
      } 
      // Retourner la requête. 
      return $sql; 
    } 
    // Donnée qui pose problème (peut être saisie innocemment  
    // dans un formulaire). 
    $nom = "L'Atout Réussite"; 
    $prix_ht = 10; 
    // Connexion. 
    $db = mysqli_connect('localhost','eniweb','web','eni'); 
    // Construction de la requête. 
    $sql =  
      construire_requête( 
        $db, 
        " INSERT INTO collection(nom,prix_ht) VALUES('%1',%2)", 
        $nom, 
        $prix_ht); 
    echo $sql,'<br />'; 
    // Déconnexion. 
    $ok = mysqli_close($db); 
    ?>

    </div>
  </body>
</html>
