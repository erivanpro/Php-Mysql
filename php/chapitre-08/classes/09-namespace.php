<?php
// Définition de l'espace de nom.
namespace MonProjet;
// Inclusion de la librairie.
include('09-librairie.inc.php');
// Définition d'une constante.
const UN = 'un';
// Définition d'une classe.
class uneClasse {
  static function information() {
    echo 'MonProjet<br />';
  }
}
// Définition d'une fonction.
function uneFonction() {
  echo __FUNCTION__,'<br />';
}
?>
<!DOCTYPE html>
<html xmlns="http://www.w3.org/1999/xhtml" lang="fr">
  <head>
    <meta charset="utf-8" />
    <title>Espace de nom</title>
  </head>
  <body>
    <div>

    <?php
    // Affichage de l'espace de nom courant.
    echo 'Espace de nom courant = ',__NAMESPACE__,'<br />';
    // Appel de uneFonction() :
    // nom non qualifié = espace de nom courant
    echo 'uneFonction() = ';
    uneFonction();
    // Appel de Librairie\uneFonction() :
    // nom qualifié relatif
    echo 'Librairie\uneFonction() = ';
    Librairie\uneFonction();
    // Affichage de \MonProjet\Librairie\UN :
    // nom qualifié absolu
    echo '\MonProjet\Librairie\UN = ',
         \MonProjet\Librairie\UN,
         '<br />';
    // Affichage de namespace\UN :
    // utilisation du mot clé 'namespace' (espcae courant)
    echo 'namespace\UN = ',
         namespace\UN,
         '<br />';
    // Définition d’un alias de classe.
    use \MonProjet\Librairie\uneClasse as cl;
    echo 'cl::information() = ';
    cl::information();
    // Définition d’un alias d’espace de nom.
    use MonProjet\Librairie as lib;
    echo ' lib\uneFonction() = ';
    lib\uneFonction();
    // Définition d'un alias de constante.
    use const MonProjet\Librairie\UN as ONE;
    echo 'ONE = ',ONE,'<br />';
    // Définition d'un alias de fonction.
    use function MonProjet\Librairie\uneFonction as f;
    echo ' f() = ';
    f();
    ?>

    </div>
  </body>
</html>
