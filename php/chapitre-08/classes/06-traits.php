<!DOCTYPE html>
<html xmlns="http://www.w3.org/1999/xhtml" lang="fr">
  <head>
    <meta charset="utf-8" />
    <title>Traits</title>
  </head>
  <body>
    <div>

    <?php
    // Définition d'un trait qui contient des méthodes de calcul.
    trait JeSaisCalculer {
      function somme($a,$b) {
        return $a+$b;
      }
      function produit($a,$b) {
        return $a*$b;
      }
    }
    // Définition d'un trait qui contient une méthode qui  
    // affiche un message.
    trait JeSuisPoli {
      // La méthode teste s'il existe un attribut 'prénom' dans
      // la classe et si c'est le cas l'utilise dans le message.
      function direBonjour() {
        if (isset($this->prénom)) {
          echo "Bonjour {$this->prénom} !<br />";
        } else {
          echo 'Bonjour !<br />';
        }
      }
    }
    // Définition d'une classe qui utilise les deux traits.
    class utilisateur {
      use JeSaisCalculer,JeSuisPoli;
      // Attributs et méthodes de la classe.
      private $prénom; // prénom de l'utilisateur
      public function __construct($prénom) {
        // Initialiser le prénom avec la valeur passée en paramètre.
        $this->prénom = $prénom;
        // Dire bonjour (appel d'une méthode d'un des traits).
        $this->direBonjour();
      }
    }
    // Instancier un nouvel objet.
    $moi = new utilisateur('Olivier');
    // Faire un calcul (appel d'une méthode d'un des traits)
    echo 'Je sais calculer : ';
    echo '10821 x 11409 = ',$moi->produit(10821,11409);
    ?>

    </div>
  </body>
</html>
