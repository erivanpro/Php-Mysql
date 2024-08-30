<!DOCTYPE html>
<html xmlns="http://www.w3.org/1999/xhtml" lang="fr">
  <head>
    <meta charset="utf-8" />
    <title>Exemples PHP</title>
  </head>
  <body>
    <div>
    <?php
    // Liste des liens.
    $liens['./chapitre-06/'] = 'Chapitre 6  - Introduction à PHP';
    $liens['./chapitre-07/'] = 'Chapitre 7  - Utiliser les fonctions PHP';
    $liens['./chapitre-08/'] = 'Chapitre 8  - Écrire des fonctions et des classes PHP';
    $liens['./chapitre-09/'] = 'Chapitre 9  - Gérer les erreurs dans un script PHP';
    $liens['./chapitre-10/'] = 'Chapitre 10 - Gérer les formulaires et les liens avec PHP';
    $liens['./chapitre-11/'] = 'Chapitre 11 - Accéder à MySQL';
    $liens['./chapitre-12/'] = 'Chapitre 12 - Gérer les sessions';
    $liens['./chapitre-13/'] = 'Chapitre 13 - Annexes';
    // Code JavaScript pour l'affichage du lien dans une autre fenêtre.
    $onclick="window.open(this.href,'_blank'); return false;";
    // Affichage d'une liste de liens.
    foreach ($liens as $lien => $titre) {
      printf // lien vers la page
        (
        "<a href=\"%s\" onclick=\"%s\">%s</a><br />",
        $lien,
        $onclick,
        $titre
        );
    }
    ?>
    </div>
  </body>
</html>