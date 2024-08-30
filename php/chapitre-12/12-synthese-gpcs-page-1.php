<?php
// Ouvrir une session et enregistrer une information de
// session nommée "x" de valeur "SESSION".
session_start();
$_SESSION['x'] = 'SESSION';
// Déposer un cookie nommé "x" de valeur "COOKIE".
setcookie('x','COOKIE');
?>
<!DOCTYPE html>
<html xmlns="http://www.w3.org/1999/xhtml" lang="fr">
  <head>
    <meta charset="utf-8" />
    <title>Page 1</title>
  </head>
  <body>
    <!-- Dans un formulaire, mettre une variable donnée 
         nommée "x" de valeur "GET" dans l'URL de 
         l'attribut "action" -->
    <form action="12-synthese-gpcs-page-2.php?x=GET" method="post">
    <!-- Mettre aussi une zone nommée "x" de 
         valeur "POST" -->
    <input type="hidden" name="x" value="POST" />
    <!-- Plus un bouton pour aller sur la page 2 -->
    <input type="submit" name="ok" value="Page 2">
    </form>
  </body>
</html>
