<!DOCTYPE html>
<html xmlns="http://www.w3.org/1999/xhtml" lang="fr">
  <head>
    <meta charset="utf-8" />
    <title>Fonctions générateur</title>
    <style>
      h1 { font-family: verdana,arial,helvetica,sans-serif ; font-size: 100% ; margin-top: 20pt }
    </style>
  </head>
  <body>
    <div>

    <h1>Génération d'une liste de valeurs</h1> 
    <?php
    // définition d'une fonction qui génère des nombres aléatoires
    function lanceur_de_dés($nombre=3) {
      for ($i = 1; $i <= $nombre; $i++) {
        yield rand(1,6);
      }
    }
    // appel de la fonction dans une variable
    $valeurs = lanceur_de_dés();
    // dump de la variable (pour voir)
    echo '<b>Dump de la variable :</b><br />'; 
    var_dump($valeurs);
    echo '<b>  // c\'est bien un objet</b><br />';
    // parcours des valeurs
    echo '<b>Parcours des valeurs :</b><br />'; 
    foreach ($valeurs as $valeur) {
      echo "$valeur ";
    }
    echo '<br />';
    // nouvel appel (avec 5 valeurs) et parcours directement
    // dans la structure foreach
    echo '<b>Nouvelle génération (5 valeurs) :</b><br />'; 
    foreach (lanceur_de_dés(5) as $valeur) {
      echo "$valeur ";
    }
    ?>
    
    <h1>Génération d'une liste de paires clé/valeur</h1> 
    <?php
    // définition d'une fonction qui fourni une à une les lettres d'un
    // texte en utilisant la code ASCII de la lettre comme indice
    function lettres($texte) {
      for ($i = 0; $i < strlen($texte); $i++) {
        yield ord($texte[$i]) => $texte[$i];
      }
    }
    foreach (lettres('OLIVIER') as $code => $lettre) {
      echo "$lettre ($code) ";
    }
    ?>

    <h1>Retour d'une expression</h1> 
    <?php
    // définition d'une fonction qui génère un nombre aléatoire de
    // puissances de 2 et qui retourne le nombre de valeur générées
    function puissance() {
      $n = rand(1,10);
      for ($i = 0; $i < $n; $i++) {        
        yield 2**$i;
      }
      return $n;
    }
    // appel du générateur dans une variable (objet) pour pouvoir 
    // ensuite appeler la méthode getReturn()
    $puissance = puissance();
    foreach ($puissance as $valeur) {
      echo "$valeur ";
    }
    echo '<br /> Nombre de valeurs générées = ',$puissance->getReturn();
    ?>

    <h1>Délégation du générateur</h1> 
    <?php
    // définition d'une fonction qui génère les chiffres impairs
    function impair() {
      for ($i = 0; $i < 5; $i++) {        
        yield 2*$i+1;
      }
    }
    // définition d'une fonction qui génère les chiffres impairs
    // suivis des chiffres pairs
    function chiffres() {
      yield from impair();  // délégation à un autre générateur
      yield from [2,4,6,8]; // délégation à un tableau
    }
    // appel du générateur de chiffres
    foreach (chiffres() as $valeur) {
      echo "$valeur ";
    }
    ?>

    </div>
  </body>
</html>
