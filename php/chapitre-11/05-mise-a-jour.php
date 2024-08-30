<!DOCTYPE html>
<html xmlns="http://www.w3.org/1999/xhtml" lang="fr">
  <head>
    <meta charset="utf-8" />
    <title>Requête non préparée : mise à jour</title>
  </head>
  <body>
    <div>

    <?php
    // Définition d'une petite fonction d'affichage de la liste
    // des collections.
    function afficher_collections($db) {
      $sql = 'SELECT * FROM collection';
      $requête = mysqli_query($db,$sql);
      echo "<b>Liste des collections :</b><br />";
      while ($ligne = mysqli_fetch_assoc($requête)) {
        echo $ligne['id'],' - ',$ligne['nom'],
             ' - ',$ligne['prix_ht'],'<br />';
      }
    }
    // Connexion (avec sélection de la base de données).
    $db = mysqli_connect('localhost','eniweb','web','eni');
    if (! $db) {
      exit('Echec de la connexion.');
    } 
    // Affichage de contrôle.
    afficher_collections ($db);
     // Requête INSERT.
    $sql = "INSERT INTO collection(nom,prix_ht) " .
           "VALUES('Coffret Solutions',73.93)";
    $requête = mysqli_query($db,$sql);
    $identifiant = mysqli_insert_id($db); 
    echo 'Identifiant de la nouvelle collection = ',
         $identifiant,'<br />';
    // Requête UPDATE.
    $sql = "UPDATE collection SET prix_ht = prix_ht * 1.05 " . 
           "WHERE prix_ht < 30";
    $requête = mysqli_query($db,$sql);
    $nombre = mysqli_affected_rows($db);
    echo "$nombre collections(s) augmentée(s).<br />";
    // Affichage de contrôle.
    afficher_collections($db);
    ?>

    </div>
  </body>
</html>
