<!DOCTYPE html>
<html xmlns="http://www.w3.org/1999/xhtml" lang="fr">
  <head>
    <meta charset="utf-8" />
    <title>Classe ou méthode abstraite</title>
  </head>
  <body>
    <div>

    <?php
    // Définition d'une classe abstraite.
    abstract class classeMère {
      // Attribut protégé.
      protected $x;
      // Deux méthodes pour accéder à l'attribut protégé :
      // - pour lire
      public function get() {
        return "GET = $this->x";
      }
      // - pour écrire
      //   > méthode abstraite
      abstract public function put($valeur);
    }
    // Définition d'une classe fille qui hérite de la classe mère.
    class classeFille extends classeMère {
      // Implémentation de la méthode d'écriture.
      public function put($valeur) {
        $this->x = $valeur;
      }
    }
    // Utilisation de la classe fille.
    $objet = new classeFille();
    $objet->put(123);
    echo "{$objet->get()} <br />";
    ?>
    
    </div>
  </body>
</html>
