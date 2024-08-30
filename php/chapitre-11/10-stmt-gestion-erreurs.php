<!DOCTYPE html>
<html xmlns="http://www.w3.org/1999/xhtml" lang="fr">
  <head>
    <meta charset="utf-8" />
    <title>Requête préparée : gestion des erreurs</title>
  </head>
  <body>
    <div>

    <?php 
    // Connexion et sélection de la base de données. 
    $db = mysqli_connect('localhost','eniweb','web','eni'); 
    if (! $db) { 
      exit('Echec de la connexion.'); 
    } 
    // Préparation d'une requête sur une table qui n'existe pas. 
    $sql = 'SELECT * FROM article'; 
    $requête = mysqli_prepare($db, $sql); 
    // Utilisation de mysqli_errno et mysqli_error à ce stade. 
    echo '1 : ',mysqli_errno($db),' - ', 
                mysqli_error($db),'<br />'; 
    // Préparation d'une requête (sur une table qui existe). 
    $sql = 'UPDATE collection SET nom = ? WHERE id = ?'; 
    $requête = mysqli_prepare($db, $sql); 
    // Liaison des paramètres. 
    $ok = mysqli_stmt_bind_param($requête,'si',$nom,$id); 
    // Exécution de la requête (viole une clé unique). 
    $id = 1; 
    $nom = 'TechNote'; 
    $ok = mysqli_stmt_execute($requête); 
    echo '2 : ',mysqli_stmt_errno($requête),' - ', 
                mysqli_stmt_error($requête),'<br />'; 
    // Déconnexion. 
    $ok = mysqli_close($db); 
    ?>

    </div>
  </body>
</html>
