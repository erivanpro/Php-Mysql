<!DOCTYPE html>
<html xmlns="http://www.w3.org/1999/xhtml" lang="fr">
  <head>
    <meta charset="utf-8" />
    <title>Connexion et déconnexion</title>
  </head>
  <body>
    <div>

    <?php
    // Définition d'une petite fonction qui ouvre une connexion.
    function connecter($hôte,$utilisateur,$mot_de_passe) {
      $db = @mysqli_connect($hôte,$utilisateur,$mot_de_passe);
      if ($db) {
        echo 'Connexion réussie.<br />';
        echo 'Informations sur le serveur : ',
             mysqli_get_host_info($db),'<br />';
        echo 'Version du serveur : ',
             mysqli_get_server_info($db),'<br />';
        echo 'Jeu de caractères utilisé par la connexion : ',
             mysqli_character_set_name($db),'<br />';
      } else {
        printf(
          'Erreur %d : %s.<br />',
          mysqli_connect_errno(),mysqli_connect_error());
      }
      return $db;
    }
    // Définition d'une petite fonction qui ferme une connexion.
    function déconnecter($connexion) {
      if ($connexion) {
        $ok = @mysqli_close($connexion);
        if ($ok) {
          echo 'Déconnexion réussie.<br />';
        } else {
          echo 'Echec de la déconnexion. <br />';
        }
      } else {
          echo 'Connexion non ouverte.<br />';
      }
    }
    // Premier test de connexion/déconnexion.
    echo '<b>Premier test</b><br />';
    $db = connecter('localhost','eniweb','web');
    déconnecter($db);
    // Deuxième test de connexion/déconnexion.
    echo '<b>Deuxième test</b><br />';
    $db = connecter('localhost','inconnu','inconnu');
    déconnecter($db);
    ?>

    </div>
  </body>
</html>
