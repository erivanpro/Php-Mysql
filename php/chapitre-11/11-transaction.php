<!DOCTYPE html>
<html xmlns="http://www.w3.org/1999/xhtml" lang="fr">
  <head>
    <meta charset="utf-8" />
    <title>Gérer les transactions</title>
  </head>
  <body>
    <div>

    <?php
    // Définition d’une petite fonction d’affichage du catalogue. 
    // Cette fonction utilise une requête préparée qui ne sera 
    // préparée qu'une fois, lors du premier appel.
    // La variable qui stocke le résultat de la préparation ainsi que
    // le tableau utilisé pour la liaison sont des variables statiques
    // dont les valeurs sont préservées d'un appel à un autre.
    function afficher_catalogue($db) { 
      static $requête;
      static $ligne = array();
      if (! isset($requête)) { // $requête non définie = premier appel
        $sql = 'SELECT * FROM catalogue'; 
        $requête = mysqli_prepare($db,$sql);
        $ok = mysqli_stmt_bind_result($requête,$ligne[],$ligne[],$ligne[]); 
      }
      $ok = mysqli_stmt_execute($requête); 
      echo '<b>Catalogue :</b><br />';
      while (mysqli_stmt_fetch($requête)) { 
        echo $ligne[0],' - ',$ligne[1],' - ',$ligne[2],'<br />'; 
      } 
      if (mysqli_stmt_num_rows($requête) == 0) {
        echo '<i>Le catalogue est vide</i><br />';
      }
    } 
    // Connexion et sélection de la base de données.
    $db = mysqli_connect('localhost','eniweb','web','eni');
    if (! $db) { 
      exit('Echec de la connexion.'); 
    } 
    // Affichage de contrôle. 
    afficher_catalogue($db); 
    
    // Démarrer une transaction.
    $ok = mysqli_begin_transaction($db);
    // Requête INSERT (paramétrée).
    $sql = 'INSERT INTO catalogue(code,titre,prix_ttc) VALUES(?,?,?)';
    $requête = mysqli_prepare($db, $sql);
    $ok = mysqli_stmt_bind_param($requête,'ssd',$code,$titre,$prix_ttc);
    $code = 'RI7PHP';
    $titre = 'PHP 7 - Développer un site web dynamique et interactif';
    $prix_ttc = 34.5;
    $ok = mysqli_stmt_execute($requête);
    // Nouvelle exécution de la requête.
    $code = 'IM12CORAA';
    $titre = 'Oracle 12c - Cours et Exercices corrigés - Administration d\'une base de données';
    $prix_ttc = 56.9;
    $ok = mysqli_stmt_execute($requête); 
    // COMMIT.
    $ok = mysqli_commit($db);
    
    // Désactiver le COMMIT automatique.
    $ok = mysqli_autocommit($db,FALSE);
    // Requête DELETE de tous le catalogue (oups !). 
    $sql = 'DELETE FROM catalogue '; 
    $requête = mysqli_query($db, $sql); 
    // ROLLBACK (ouf !). 
    $ok = mysqli_rollback($db); 
    
    // Affichage de contrôle.
    afficher_catalogue($db);
    // Déconnexion. 
    $ok = mysqli_close($db); 
    ?>

    </div>
  </body>
</html>
