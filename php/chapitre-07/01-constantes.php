<!DOCTYPE html>
<html xmlns="http://www.w3.org/1999/xhtml" lang="fr">
  <head>
    <meta charset="utf-8" />
    <title>Manipuler les constantes</title>
    <style>
      h1 { font-family: "Courier New",Courier,monospace ; font-size: 100% ; margin-top: 20pt }
    </style>
  </head>
  <body>
    <div>
    
    <h1>defined()</h1>
    <?php
    // Tester si la constante CONSTANTE est définie.
    $ok = defined('CONSTANTE');
    if ($ok) {
      echo 'CONSTANTE est définie.<br />';
    } else {
      echo 'CONSTANTE n\'est pas définie.<br />';
    };
    // Définir la constante CONSTANTE
    define('CONSTANTE','valeur de CONSTANTE');
    // Tester si la constante CONSTANTE est définie.
    $ok = defined('CONSTANTE');
    if ($ok) {
      echo 'CONSTANTE est définie.<br />';
    } else {
      echo 'CONSTANTE n\'est pas définie.<br />';
    };
    ?>
    
    <h1>constant()</h1>
    <?php
    // Définir le nom de la constante dans une variable.
    $nomConstante = 'CONSTANTE';
    // Définir la valeur de la constante.
    define($nomConstante,'valeur de CONSTANTE');
    // Afficher la valeur de la constante.
    echo $nomConstante,' = ',constant($nomConstante);
    ?>

    </div>
  </body>
</html>