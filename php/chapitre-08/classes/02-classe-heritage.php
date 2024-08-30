<!DOCTYPE html>
<html xmlns="http://www.w3.org/1999/xhtml" lang="fr">
  <head>
    <meta charset="utf-8" />
    <title>Héritage de classe</title>
  </head>
  <body>
    <div>

    <?php
    // Définition d'une classe de base.
    class utilisateur {
      // Définition des attributs.
      public $nom; // nom de l'utilisateur
      public $prénom; // prénom de l'utilisateur
      // Définition des méthodes :
      // - méthode constructeur
      public function __construct($prénom,$nom) {
        // Initialiser le nom et le prénom
        // avec les valeurs passées en paramètre
        $this->prénom = $prénom;
        $this->nom = $nom;
      }
      // - méthode qui donne les informations sur l'utilisateur
      public function informations() {
        return "$this->prénom $this->nom";
      }
    }
    // Définition d'une classe qui hérite de la première
    class utilisateur_couleur extends utilisateur{
      // Définition des attributs complémentaires.
      public $couleurs; // couleurs préférées de l'utilisateur
      // Définition des méthodes complémentaires
      // - méthode constructeur
      public function __construct($prénom,$couleurs) {
        // Appel au constructeur de la classe mère
        // pour la première partie de l'initialisation.
        parent::__construct ($prénom,'X');
        // Initialisation spécifique complémentaire.
        $this->couleurs = explode(",",$couleurs);
      }
      // - liste des couleurs préférées de l’utilisateur
      public function couleurs() {
        return implode(',',$this->couleurs);
      }
    }
    // Instanciation d'un objet sur la classe fille.
    $moi = new utilisateur_couleur('Olivier','bleu,blanc,rouge');
    // Utilisation des méthodes :
    // - de la classe mère
    echo "{$moi->informations()}<br />"; // existe par héritage
    // - de la classe fille
    echo "{$moi->couleurs()}<br />"; // existe dans la classe
    ?>
    
    </div>
  </body>
</html>
