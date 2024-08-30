<?php

function afficher_tableau(array $tableau,$titre="",$niveau=0) {

  // Paramètres
  //    - $tableau = tableau dont il faut afficher le contenu
  //    - $titre = titre à afficher au dessus du contenu
  //    - $niveau = niveau d'affichage

  // S'il y a un titre, l'afficher.
  if ($titre != "") {
    echo "<br /><b>$titre</b><br />";
  }

  // Tester s'il y des données.
  if (isset($tableau)) { // il y a des données

    // Parcourir le tableau passé en paramètre.
    reset ($tableau);
    foreach ($tableau as $cle => $valeur) {

      // afficher la clé (avec indentation fonction 
      // du niveau).
      echo
        str_pad('',12*$niveau, '&nbsp;'),
        htmlentities($cle,ENT_QUOTES|ENT_XHTML,'UTF-8'),' = ';

      // afficher la valeur
      if (is_array($valeur)) { // c'est un tableau ...

        // mettre une balise <br />
        echo '<br />';
        // et appeler récursivement afficher_tableau pour 
        // afficher le tableau en question (sans titre et
        // au niveau suivant pour l'indentation)
        afficher_tableau($valeur,'',$niveau+1);

      } else { // c'est une valeur scalaire

        // Afficher la valeur.
        echo htmlentities($valeur,ENT_QUOTES|ENT_XHTML,'UTF-8'),'<br />';

      }
      
    }

  } else { // pas de données

    // Mettre une simple balise <br />
    echo '<br />';

  }

}


function vers_formulaire($valeur) {

  // affichage dans un formulaire

  // encoder tous les caractères HTML spéciaux
  //  - ENT_QUOTES : dont " et '
  return htmlentities($valeur,ENT_QUOTES|ENT_XHTML,'UTF-8');

}


function vers_page($valeur) {

  // affichage direct dans une page

  // 1. encoder tous les caractères HTML spéciaux
  //  - ENT_QUOTES : dont " et '
  // 2. transformer les sauts de ligne en <br />
  return nl2br(htmlentities($valeur,ENT_QUOTES|ENT_XHTML,'UTF-8'));

}


function construire_requête($db,$sql) {

  // Récupérer le nombre de paramètre.
  $nombre_param = func_num_args();

  // Boucler sur tous les paramètres à partir du troisième
  // (le premier contient l'identifiant de base de données
  //  et le deuxième la requête de base).
  for($i=2;$i<$nombre_param;$i++) {

    // Récupérer la valeur du paramètre.
    $valeur = func_get_arg($i);

    // Si c'est une chaîne, l'échapper.
    if (is_string($valeur)) {
      $valeur = mysqli_escape_string($db,$valeur);
    }

    // Mettre la valeur à son emplacement %n (n = $i-1).
    $sql = str_replace('%'.($i-1),$valeur,$sql);

  }

  // Retourner la requête.
  return $sql;

}


function identifiant_unique() {

  // génération de l'identifiant
  return md5(uniqid(rand()));

}


function url($url) {

  // si la directive de configuration session.use_trans_sid 
  // est à 0 (pas de transmission automatique par l'URL) et 
  // si SID est non vide (le poste a refusé le cookie) alors
  // il faut gérer soi même la transmission

  if ((get_cfg_var("session.use_trans_sid") == 0) and (SID != "")) {
  
    // ajouter la constante SID derrière l'URL avec un ? 
    // s'il n'y a pas encore de paramètre ou avec un & dans
    // le cas contraire

    $url .= ((strpos($url,"?") === FALSE)?"?":"&").SID;

  }

  return $url;

}

?>
