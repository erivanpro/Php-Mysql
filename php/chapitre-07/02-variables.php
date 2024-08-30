<!DOCTYPE html>
<html xmlns="http://www.w3.org/1999/xhtml" lang="fr">
  <head>
    <meta charset="utf-8" />
    <title>Manipuler les variables</title>
    <style>
      h1 { font-family: "Courier New",Courier,monospace ; font-size: 100% ; margin-top: 20pt }
    </style>
  </head>
  <body>
    <div>
    
    <h1>empty()</h1>
    <?php
    // Test d'une variable non initialisée.
    $est_vide = empty($variable);
    echo '$variable non initialisé<br />';
    if ($est_vide) {
      echo '=> $variable est vide.<br />';
    } else {
      echo '=> $variable n\'est pas vide.<br />';
    }
    // Test d'une variable contenant une chaîne vide.
    $variable = '';
    $est_vide = empty($variable);
    echo '$variable = \'\'<br />';
    if ($est_vide) {
      echo '=> $variable est vide.<br />';
    } else {
      echo '=> $variable n\'est pas vide.<br />';
    }
    // Test d'une variable contenant une chaîne égale à 0.
    $variable = '0';
    $est_vide = empty($variable);
    echo '$variable = \'',$variable,'\'<br />';
    if ($est_vide) {
      echo '=> $variable est vide.<br />';
    } else {
      echo '=> $variable n\'est pas vide.<br />';
    }
    // Test d'une variable contenant 0.
    $variable = 0;
    $est_vide = empty($variable);
    echo '$variable = ',$variable,'<br />';
    if ($est_vide) {
      echo '=> $variable est vide.<br />';
    } else {
      echo '=> $variable n\'est pas vide.<br />';
    }
    // Test d'une variable contenant une chaîne non vide.
    $variable = 'x';
    $est_vide = empty($variable);
    echo '$variable = \'',$variable,'\'<br />';
    if ($est_vide) {
      echo '=> $variable est vide.<br />';
    } else {
      echo '=> $variable n\'est pas vide.<br />';
    }
    ?>

    <?php
    // Supprimer la variable pour la suite du test.
    unset($variable);
    ?>
    
    <h1>isset()</h1>
    <?php
    // Test d'une variable non initialisée.
    $est_définie = isset($variable);
    echo '$variable non initialisé<br />';
    if ($est_définie) {
      echo '=> $variable est définie.<br />';
    } else {
      echo '=> $variable n\'est pas définie.<br />';
    }
    // Test d'une variable contenant une chaîne vide.
    $variable = '';
    $est_définie = isset($variable);
    echo '$variable = \'\'<br />';
    if ($est_définie) {
      echo '=> $variable est définie.<br />';
    } else {
      echo '=> $variable n\'est pas définie.<br />';
    }
    // Test d'une variable contenant une chaîne égale à 0.
    $variable = '0';
    $est_définie = isset($variable);
    echo '$variable = \'',$variable,'\'<br />';
    if ($est_définie) {
      echo '=> $variable est définie.<br />';
    } else {
      echo '=> $variable n\'est pas définie.<br />';
    }
    // Test d'une variable contenant 0.
    $variable = 0;
    $est_définie = isset($variable);
    echo '$variable = ',$variable,'<br />';
    if ($est_définie) {
      echo '=> $variable est définie.<br />';
    } else {
      echo '=> $variable n\'est pas définie.<br />';
    }
    // Test d'une variable contenant une chaîne non vide.
    $variable = 'x';
    $est_définie = isset($variable);
    echo '$variable = \'',$variable,'\'<br />';
    if ($est_définie) {
      echo '=> $variable est définie.<br />';
    } else {
      echo '=> $variable n\'est pas définie.<br />';
    }
    ?>
    
    <h1>unset()</h1>
    <?php
    // Définir une variable.
    $variable = 1;
    // Afficher la variable et tester si elle est définie.
    $est_définie = isset($variable);
    echo '$variable = ',$variable,'<br />';
    if ($est_définie) {
      echo '=> $variable est définie.<br />';
    } else {
      echo '=> $variable n\'est pas définie.<br />';
    }
    // Supprimer la variable.
    unset($variable);
    // Afficher la variable et tester si elle est définie.
    $est_définie = isset($variable);
    echo '$variable = ',$variable,'<br />';
    if ($est_définie) {
      echo '=> $variable est définie.<br />';
    } else {
      echo '=> $variable n\'est pas définie.<br />';
    }
    ?>
    
    <h1>var_dump()</h1>
    <?php
    // Variable non initialisée.
    var_dump($variable);
    // Variable initialisée avec un nombre entier.
    $variable = 10;
    echo '<br />';
    var_dump($variable);
    // Variable initialisée avec un nombre décimal.
    $variable = 3.14;
    echo '<br />';
    var_dump($variable);
    // Variable initialisée avec une chaîne.
    $variable = 'abc';
    echo '<br />';
    var_dump($variable);
    ?>

    </div>
  </body>
</html>