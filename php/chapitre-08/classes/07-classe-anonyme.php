<!DOCTYPE html>
<html xmlns="http://www.w3.org/1999/xhtml" lang="fr">
  <head>
    <meta charset="utf-8" />
    <title>Classe anonyme</title>
  </head>
  <body>
    <div>

    <?php
    // Définition d'une classe permettant de faire de la géométrie.
    class euclide {
      // Figure géométrique (objet).
      private $figure;
      // Méthode qui définit la figure géométrique manipulée.
      public function attribuerFigure($figure) {
        $this->figure = $figure;
      }
      // Méthode qui affiche la surface de la figure.
      public function afficherSurface() {
        echo 'Surface = ',$this->figure->surface();
      }
    }
    // Instanciation d'un objet.
    $euclide = new euclide();
    // Définition de la figure (objet) manipulée à l'aide d'une classe anonyme.
    $euclide->attribuerFigure(
      new class(2,5) { // arguments passés au constructeur
        private $largeur;
        private $longueur;
        public function __construct($largeur,$longueur) { 
          $this->largeur = $largeur;
          $this->longueur = $longueur; 
        } 
        public function surface() { 
          return $this->largeur * $this->longueur; 
        } 
      });
    // Affichage de la surface.
    echo $euclide->afficherSurface();
    ?>

    </div>
  </body>
</html>
