<!DOCTYPE html>
<html xmlns="http://www.w3.org/1999/xhtml" lang="fr">
  <head>
    <meta charset="utf-8" />
    <title>Statut de la session</title>
  </head>
  <body>
    <div>
    <?php 
    // Fonction qui affiche le nom de la constante 
    // de statut à partir de sa valeur. 
    function texte_statut($valeur) { 
      switch ($valeur) { 
        case PHP_SESSION_DISABLED: 
            return 'PHP_SESSION_DISABLED'; 
        case PHP_SESSION_NONE: 
            return 'PHP_SESSION_NONE'; 
        case PHP_SESSION_ACTIVE: 
            return 'PHP_SESSION_ACTIVE'; 
      } 
      return '?'; 
    } 
    echo 'Avant session_start() : ', 
         texte_statut(session_status()),'<br />'; 
    session_start(); 
    echo 'Après session_start() : ', 
         texte_statut(session_status()),'<br />'; 
    session_destroy(); 
    echo 'Après session_destroy() : ', 
         texte_statut(session_status()),'<br />'; 
    ?>
    </div>
  </body>
</html>
