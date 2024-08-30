<!DOCTYPE html>
<html xmlns="http://www.w3.org/1999/xhtml" lang="fr">
  <head>
    <meta charset="utf-8" />
    <title>Interface</title>
  </head>
  <body>
    <div>

    <?php
    // Définition de deux interfaces.
    interface lecture {
      function get();
    }
    interface écriture {
      function put($valeur);
    }
    // Définition d'une classe qui implémente les deux interfaces.
    class uneClasse implements lecture,écriture {
      // Définition d'un attribut quelconque.
      private $x;
      // Implémentation de la méthode de lecture.
      public function get() {
        return $this->x;
      }
      // Implémentation de la méthode d'écriture.
      public function put($valeur) {
        $this->x = $valeur;
      }
    }
    // Utilisation de la classe.
    $objet = new uneClasse();
    $objet->put(123);
    echo "{$objet->get()} <br />";
    ?>
    
    </div>
  </body>
</html>
