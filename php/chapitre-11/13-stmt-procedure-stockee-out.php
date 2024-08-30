<!DOCTYPE html>
<html xmlns="http://www.w3.org/1999/xhtml" lang="fr">
  <head>
    <meta charset="utf-8" />
    <title>Procédure stockée avec paramètre OUT (requête préparée)</title>
  </head>
  <body>
    <div>

    <?php
    // Connexion et sélection de la base de données.
    $db = mysqli_connect('localhost','eniweb','web','eni');
    if (! $db) {
      exit('Echec de la connexion.');
    }
    // Définition des caractéristiques de la nouvelle collection.
    $nom = 'Objectif Solutions';
    $prix_ht = 20.81;
    // Exécution de la requête d'appel de la procédure.
    // Le paramètre OUT de la procédure est récupéré dans la
    // variable MySQL @id.
    $sql = 'CALL ps_creer_collection(?,?,@id)';
    $requête = mysqli_prepare($db,$sql);
    $ok = mysqli_stmt_bind_param($requête,'sd',$nom,$prix_ht);
    $ok = mysqli_stmt_execute($requête);
    // Exécution de la requête qui lit le contenu de la 
    // variable MySQL @id.
    $sql='SELECT @id';
    $requête = mysqli_prepare($db,$sql);
    $ok = mysqli_stmt_bind_result($requête,$id);
    $ok = mysqli_stmt_execute($requête);
    $ok = mysqli_stmt_fetch($requête);
    // Affichage du résultat.
    echo "Identifiant de la nouvelle collection = $id"; 
    // Libération du résultat.
    $ok = mysqli_stmt_free_result($requête);
    // Exécution d'une requête qui supprime la nouvelle collection.
    $sql = "DELETE FROM collection WHERE id = $id";
    $ok = mysqli_query($db,$sql);
    // Déconnexion.
    $ok = mysqli_close($db);
    ?>

    </div>
  </body>
</html>
