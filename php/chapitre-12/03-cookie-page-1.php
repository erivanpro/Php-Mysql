<?php
// Premier cookie expirant à la fin de la session.
$ok1 = setcookie('prenom','Olivier');
// Deuxième cookie expirant dans 30 jours.
$ok2 = setcookie('nom','HEURTEL',time()+(30*24*3600));
// Résultat.
if ($ok1 and $ok2) {
   $message = 'Cookies déposés (du moins, a priori)';
} else {
   $message = 'L\'un des cookies n\'a pas pu être déposé';
}
?>
<!DOCTYPE html>
<html xmlns="http://www.w3.org/1999/xhtml" lang="fr">
  <head>
    <meta charset="utf-8" />
    <title>Cookie - Page 1</title>
  </head>
  <body>
    <div>
    <?php echo $message; ?><br />
    <!-- lien vers la page 2 -->
    <a href="03-cookie-page-2.php">Page 2</a>
    </div>
  </body>
</html>