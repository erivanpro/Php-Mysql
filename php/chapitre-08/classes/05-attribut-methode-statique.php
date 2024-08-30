<!DOCTYPE html>
<html xmlns="http://www.w3.org/1999/xhtml" lang="fr">
  <head>
    <meta charset="utf-8" />
    <title>Attribut ou méthode statique - Constante de classe</title>
  </head>
  <body>
    <div>

    <?php
    // Définition d'une classe.
    class uneClasse {
      // Attribut privé quelconque.
      private $x;
      // Attribut privé statique pour stocker
      // le nombre d'objets instanciés.
      static private $nombre = 0;
      // Constante de classe pour définir une valeur
      // par défaut.
      const DEFAUT = 'X';
      // Fonction publique statique qui retourne le
      // nombre d'objets.
      static public function nombreObjets() {
        return uneClasse::$nombre;
      }
      // Méthode constructeur
      // - récupérer la valeur de l'attribut (valeur par défaut
      //   = la constante de classe)
      // - incrémenter le nombre d'objets
      public function __construct($valeur = uneClasse::DEFAUT) {
        $this->x = $valeur;
        uneClasse::$nombre++;
        echo "Création de l'objet : $this->x<br />";
      }
      // Méthode destructeur.
      // - décrémenter le nombre d'objets
      public function __destruct() {
        uneClasse::$nombre--;
        echo "Suppression de l'objet : $this->x<br />";
      }
    }
    // Afficher la valeur de la constante de classe.
    echo 'uneClasse::DEFAUT = ',uneClasse::DEFAUT,'<br />';
    // Afficher le nombre d'objets.
    echo uneClasse::nombreObjets(),' objet(s)<br />';
    // Créer deux objets.
    $inconnu = new uneClasse();
    $abc = new uneClasse ('ABC');
    // Afficher le nombre d'objets.
    echo uneClasse::nombreObjets(),' objet(s)<br />';
    // "Supprimer" un objet.
    unset($inconnu);
    // Afficher le nombre d'objets.
    echo uneClasse::nombreObjets(),' objet(s)<br />';
    ?>
    
    </div>
  </body>
</html>
