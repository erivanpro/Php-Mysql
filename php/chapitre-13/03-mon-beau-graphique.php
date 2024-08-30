<?php

// Définir un en-tête indiquant qu'il s'agit d'une image (ici PNG).
header('Content-type: image/png');

/*

Les fonctions définies dans le script utilisent deux variables globales :
- $image         = ressource image en cours de création
- $hauteur_image = hauteur de l'image

Pour les coordonnées, l'origine de l'image est le coin supérieur gauche.
Pour le dessin de notre graphique, nous utilisons une origine dans le
coin inférieur gauche (plus pratique). Les fonctions effectuent la
conversion.

*/

// Fontion de dessin d'un rectangle
// - $x1,$y1         = point 1
// - $x2,$y2         = point 2
// - $bordure, $fond = couleurs de la bordure et du fond
//
function rectangle($x1,$y1,$x2,$y2,$bordure,$fond) {

  global $image;
  global $hauteur_image;

  // Conversion du système de coordonnées pour l'axe y.
  $y1 = $hauteur_image - 1 - $y1;
  $y2 = $hauteur_image - 1 - $y2;

  // Dessiner le bord d'un rectangle = imagerectangle
  imagerectangle($image,$x1,$y1,$x2,$y2,$bordure);

  // Remplissage (si demandé i.e. $fond renseigné)
  if ( ( $fond != NULL) and ($x1 != $x2) and ($y1 != $y2) ) {

    // Remplir un rectangle = imagefilledrectangle
    imagefilledrectangle($image,$x1+1,$y1-1,$x2-1,$y2+1,$fond);
  }
}

// Fontion de dessin d'une ligne
// - $x1,$y1  = point 1
// - $x2,$y2  = point 2
// - $couleur = couleur
//
function ligne($x1,$y1,$x2,$y2,$couleur) {

  global $image;
  global $hauteur_image;

  // Conversion du système de coordonnées pour l'axe y
  $y1 = $hauteur_image - 1 - $y1;
  $y2 = $hauteur_image - 1 - $y2;

  // Dessiner une ligne = imageline
  imageline($image,$x1,$y1,$x2,$y2,$couleur);

}

// Fontion de dessin d'un texte
// - $police     = code de la police prédéfinie (1 à 5)
// - $x,$y       = point de référence
// - $texte      = texte
// - $couleur    = couleur
// - $horizontal = alignement horizontal par rapport au point 
//                 de référence
//      > D = aligné à droite, C = centré, G = aligné à gauche
// - $vertical   = alignement vertical par rapport au point de référence
//      > H = texte en haut, C = centré, B = texte en bas
//
function texte($police,$x,$y,$texte,$couleur,$horizontal,$vertical) {

  global $image;
  global $hauteur_image;

  // Conversion du système de coordonnées pour l'axe y
  $y = $hauteur_image - 1 - $y;

  // Calculer la largeur d'un caractère dans une police = 
  // imagefontwidth
  $largeur = imagefontwidth($police) * strlen($texte);

  // Calculer la hauteur d'un caractère dans une police = 
  // imagefontheight
  $hauteur = imagefontheight($police);

  // Calcul des coordonnées en fonction de l'alignement
  switch ($horizontal) {
    case 'D':
      $x = $x - $largeur;
      break;
    case 'C':
      $x = $x - floor($largeur/2);
      break;
    case 'G':
      break;
  }
  switch ($vertical) {
    case 'H':
      $y = $y - $hauteur;
      break;
    case 'C':
      $y = $y - floor($hauteur/2);
      break;
    case 'B':
      break;
  }

  // Dessiner un texte = imagestring
  imagestring($image,$police,$x,$y,$texte,$couleur);
}

// Pour cet exemple, les données du graphes sont calculées de 
// façon aléatoires.
// - unité, valeur min et valeur max pour l'axe y
$axe_y_unite = 10;
$axe_y_min = 0;
$axe_y_max = 40;
// - nombre de barres : entre 5 et 15
$nombre_barres = rand(5,15);
// - mettre les données dans le tableau
$données = array();
for ($i = 1 ; $i <= $nombre_barres ; $i++) {
  $données[$i] = rand($axe_y_min,$axe_y_max);
}

// Dimensions du dessin (pixels)
$largeur_image = 400; // largeur de l'image
$hauteur_image = 200; // hauteur de l'image
$marge_blanche = 2;   // marge blanche
$marge_gauche = 25;   // marge gauche avec la zone de traçage
$marge_droite = 20;   // marge droite avec la zone de traçage
$marge_haute = 20;    // marge haute avec la zone de traçage
$marge_basse = 30;    // marge basse avec la zone de traçage
$écart_barres = 5;    // écart entre les barres

// En déduire la largeur et la hauteur de la zone de traçage.
$largeur_tracé = $largeur_image - $marge_droite - $marge_gauche;
$hauteur_tracé = $hauteur_image - $marge_haute - $marge_basse;

// En déduire la largeur des barres et l'échelle de l'axe y.
$largeur_barre = ($largeur_tracé-$écart_barres)/$nombre_barres - $écart_barres ;
$échelle_axe_y = ($hauteur_tracé-1) / $axe_y_max ;

// Créer l'image = imagecreatetruecolor
$image = imagecreatetruecolor($largeur_image,$hauteur_image);

// Définir des couleurs = imagecolorallocate
// - en RGB
$blanc = imagecolorallocate($image, 255, 255, 255);
$noir = imagecolorallocate($image, 0, 0, 0);
$gris_clair = imagecolorallocate($image, 192, 192, 192);
$gris_foncé = imagecolorallocate($image, 100, 100, 100);
$vert = imagecolorallocate($image, 0, 128, 0);

// Coordonnées de l'image.
$ox1 = 0; $oy1 = 0;
$ox2 = $largeur_image - 1; $oy2 = $hauteur_image - 1;
// dessiner le cadre extérieur
rectangle($ox1,$oy1,$ox2,$oy2,$noir,$blanc);

// Coordonnées de l'image moins le bord blanc.
$mx1 = $ox1 + $marge_blanche; $my1 = $oy1 + $marge_blanche;
$mx2 = $ox2 - $marge_blanche; $my2 = $oy2 - $marge_blanche;
// dessiner le fond gris clair
rectangle($mx1,$my1,$mx2,$my2,$gris_clair,$gris_clair);

// Coordonnées de la zone de traçage.
$tx1 = $ox1 + $marge_gauche; $ty1 = $oy1 + $marge_basse;
$tx2 = $ox2 - $marge_droite; $ty2 = $oy2 - $marge_haute;
// dessiner le cadre de la zone de traçage
rectangle($tx1,$ty1,$tx2,$ty2,$noir,NULL);

// Dessin des lignes horizontales avec leur étiquette.
$x1 = $tx1;
$x2 = $tx2;
for ($axe = $axe_y_min ; $axe <= $axe_y_max ; $axe += $axe_y_unite) {
  $y1 = $ty1 + $axe * $échelle_axe_y;
  $y2 = $y1;
  // ne pas dessiner la ligne en bas et en haut
  if ( ( $axe > $axe_y_min ) and ( $axe < $axe_y_max ) ) {
    ligne($x1,$y1,$x2,$y2,$gris_foncé);
  }
  texte(3,$x1-2,$y1,$axe,$noir,"D","C");
}

// Dessin des barres.
$i = 0;
foreach($données as $clé => $valeur) {
  $i++;
  $x1 = $tx1 + $écart_barres + ($i-1)*($écart_barres+$largeur_barre);
  $x2 = $x1 + $largeur_barre;
  $y1 = $ty1;
  $y2 = $y1 + $valeur * $échelle_axe_y;
  rectangle($x1,$y1,$x2,$y2,$noir,$vert);
  texte(3,($x1+$x2)/2,$y1,$clé,$noir,"C","B");
}

// Générer l'image au format PNG = imagepng
// - soit à l'écran (pas de deuxième paramètre)
// - soit dans un fichier (deuxième paramètre = nom du fichier)
// Il existe des fonctions similaires pour d'autres formats.
imagepng($image /*, 'image.png' */);

// Supprimer l'image = imagedestroy
imagedestroy($image);

?>