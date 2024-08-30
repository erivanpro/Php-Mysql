<?php
// Définition d'une classe destinée à stocker des informations 
// sur un utilisateur.
class utilisateur {
  // Définition des attributs.
  public  $nom; // nom de l'utilisateur
  public  $prénom; // prénom de l'utilisateur
  public  $langue = 'fr_FR'; // langue de l'utilisateur
                             // français par défaut
  private $timestamp; // date/heure de création (privé)
  // Définition des méthodes :
  // - méthode constructeur
  public function __construct($prénom,$nom) {
    // Initialiser le nom et le prénom
    // avec les valeurs passées en paramètre.
    $this->prénom = $prénom;
    $this->nom = $nom;
    // Initialiser le timestamp avec la fonction time().
    $this->timestamp = time();
  }
  // - méthode destructeur
  public function __destruct() {
    // Se contente d'afficher un message.
    echo "<p><b>Suppression de $this->nom</b></p>";
  }
  // - méthode de conversion de l'objet en chaîne
  public function __toString() {
    // Retourne juste le nom et le prénom.
    return "__toString = $this->nom - $this->prénom";
  }
  // - méthode qui modifie la langue de l'utilisateur.
  public function langue($langue) {
    $this->langue = $langue;
  }
  // - méthode (privée) qui met en forme la date/heure
  //   de création de l'utilisateur.
  private function miseEnFormeTimestamp() {
    setlocale(LC_TIME,$this->langue.'.UTF8'); // jeu de caractères UTF8
    return strftime('%c', $this->timestamp);
  }
  // - méthode qui donne des informations sur l'utilisateur
  public function informations() {
    $création = $this->miseEnFormeTimestamp();
    return "$this->prénom $this->nom - $création";
  }
}
?>