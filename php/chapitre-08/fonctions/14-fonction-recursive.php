<!DOCTYPE html>
<html xmlns="http://www.w3.org/1999/xhtml" lang="fr">
  <head>
    <meta charset="utf-8" />
    <title>Exemple de fonction récursive</title>
  </head>
  <body>
    <div>

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
          // Afficher la clé (avec indentation fonction
          // du niveau).
          echo
            str_pad('',12*$niveau, '&nbsp;'),
            htmlentities($cle),' = ';
          // Afficher la valeur
          if (is_array($valeur)) { // c'est un tableau ...
            // mettre une balise <br />
            echo '<br />';
            // Et appeler récursivement afficher_tableau pour
            // afficher le tableau en question (sans titre et
            // au niveau suivant pour l'indentation)
            afficher_tableau($valeur,'',$niveau+1);
          } else { // c'est une valeur scalaire
            // Afficher la valeur.
            echo htmlentities($valeur),'<br />';
          }
        }
      } else { // pas de données
        // Mettre une simple balise <br />
        echo '<br />';
      }
    }
    // Afficher un tableau de couleurs.
    $couleurs = array('Bleu','Blanc','Rouge');
    afficher_tableau($couleurs,'Couleurs');
    // Afficher un tableau à deux dimensions (pays/ville).
    $pays = array('France' => array('Paris','Lyon','Nantes'),
                  'Italie' => array('Rome','Venise'));
    afficher_tableau($pays,'Pays/Villes');
    ?>
    
    </div>
  </body>
</html>
