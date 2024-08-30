<?php

// Inclusion de la librairie.
include ('../include/fpdf/fpdf.php');

// Sélectionner les données dans la base de données.
$db = @mysqli_connect('localhost','eniweb','web','eni');
if (! $db) {
  exit('Erreur lors de la connexion.');
}
$sql = 'SELECT nom,prix_ht FROM collection LIMIT 4';
$ok = ($requête = mysqli_prepare($db, $sql));
if ($ok) { $ok = @mysqli_stmt_execute($requête); }
if ($ok) { $ok = @mysqli_stmt_bind_result($requête,$nom,$prix); }
if (! $ok) {
  exit('Erreur lors de la sélection des données dans la base.');
}

// Créer un nouveau document PDF = new FPDF()
// - premier paramètre = orientation
//     > P = portrait - L = Paysage
// - deuxième paramètre = unité de mesure
//     > pt = point - mm = millimètre - cm = centimètre
// - troisième paramètre = format (A3, A4, etc)
// Tous les paramètres sont optionnels. Défaut = P, mm, A4.
$pdf = new FPDF('P','mm','A4');

// Définir les sauts de page automatiques = SetAutoPageBreak()
// - premier paramètre = automatique (true/false)
//     > P = portrait - L = Paysage
// - deuxième paramètre = marge
//     > distance par rapport au bas de la page qui déclenche
//       le saut (2 cm par défaut, si actif)
$pdf->SetAutoPageBreak(false);

// Créer une nouvelle page dans le document = AddPage()
// - premier paramètre = orientation
//     > P = portrait - L = Paysage
//       Par défaut, celle du document.
$pdf->AddPage();

// Définir les informations de résumé du document = SetTitle(), 
// SetAuthor(), SetSubject().
$pdf->SetTitle('Liste des collections');
$pdf->SetAuthor('Olivier HEURTEL');
$pdf->SetSubject('Collections');

// Définir la police à utiliser = SetFont()
// - premier paramètre = famille
//     > nom d'une famille standard (Courier, Helvetica ou Arial, 
//       Times, Symbol, ZapfDingbats) ou d'un nom défini par
//       AddFont().
// - deuxième paramètre (optionnel) = style
//     > combinaison de : B = gras - I = italique - U = souligné
// - troisième paramètre (optionnel) = taille en points
// Voir aussi la méthode SetFontSize() pour modifier la taille.
$pdf->SetFont('Arial','B',16);

// Ecrire du texte à partir de la position courante = Write()
// - premier paramètre = hauteur de la ligne
// - deuxième paramètre = texte à écrire
// Utilise les caractéristiques actuelles de police, couleurs, etc.
// Le retour à la ligne est automatique lorsque la marge droite est
// atteinte (ou que le caractère \n est rencontré).
$pdf->Write(5, 'Liste des collections');

// Effectuer un saut de ligne = Ln()
// - premier paramètre (optionnel) = hauteur de la ligne
// L'abcisse revient à la valeur de la marge gauche.
$pdf->Ln(10);

// Changer la taille de police = SetFontSize()
// - premier paramètre = taille en points
$pdf->SetFontSize(12);

// Définir la couleur à utiliser pour le texte = SetTextColor()
// - si un seul paramètre = niveau de gris (entre 0 et 255)
// - si 3 paramètres = composantes RGB (entre 0 et 255)
$pdf->SetTextColor(255,0,0); // rouge

// Définir la couleur à utiliser pour le fond = SetFillColor()
// - si un seul paramètre = niveau de gris (entre 0 et 255)
// - si 3 paramètres = composantes RGB (entre 0 et 255)
$pdf->SetFillColor(255,255,140); // jaune pale

// Ecrire une cellule = Cell()
// - premier paramètre = largeur (0 = jusqu'à la marge droite)
// - deuxième paramètre = hauteur
// - troisième paramètre = texte à écrie
// - quatrième paramètre = bordure
//     > soit un nombre  : 0 = aucun bord - 1 = cadre
//     > soit une chaîne : combinaison de L (gauche), T (haut),
//                         R (droit), B (bas)
// - cinquième paramètre = position à la fin
//     > 0 = à droite - 1 = début ligne suivante - 2 = en dessous
// - sixième paramètre = alignement
//     > L ou chaîne vide = à gauche - C = centré - R = à droite
// - septième paramètre = remplissage
//     > 0 = non - 1 = oui
// Seul premier paramètre est obligatoire.
$pdf->Cell(80,7,'Nom',1,0,'C',1); // titre de colonne
$pdf->Cell(40,7,'Prix H.T.',1,1,'C',1); // titre de colonne

// Changer de couleur et de police
$pdf->SetFont('Arial','',12); // '' = normal
$pdf->SetTextColor(0,0,0); // noir

// Dans une boucle, écrire les données du tableau.
while (mysqli_stmt_fetch($requête)) { // fetch de la requête
  $prix = number_format($prix,2,',',' ');
  $pdf->Cell(80,7,iconv('UTF-8','windows-1252',$nom),1);
  $pdf->Cell(40,7,$prix,1,1,'R'); // ligne suivante + à droite
}

// Se positionner à un endroit précis dans la page = SetXY()
// - premier paramètre = abscisse (x)
// - deuxième paramètre = ordonnée (y)
// L'origine est le coin supérieur gauche.
// Si les valeurs sont négatives, l'origine est le coin 
// inférieur droit.
// Voir aussi SetX() et SetY().
$pdf->SetXY(10,-10); // 1 cm à gauche, 1 cm du bas

// Afficher le numéro de page = PageNo()
$pdf->SetFontSize(10);
$pdf->Cell(0,0,'Page '.$pdf->PageNo(),0,0,'R');

// Afficher une image = Image()
// - premier paramètre = nom du fichier
// - deuxième paramètre = abscisse du coin supérieur gauche
// - troisième paramètre = ordonnée du coin supérieur gauche
// - quatrième paramètre (optionnel) = largeur de l'image
//     > 0 ou absent = calculée automatiquement
// - cinquième paramètre (optionnel) = hauteur de l'image
//     > 0 ou absent = calculée automatiquement
// - sixième paramètre (optionnel) = type
//     > JPG ou JPEG ou PNG
//     > Déduit de l'extension si absent
$pdf->Image('../images/logo.png',10,285,10);

// Définir la couleur à utiliser pour le dessin = SetDrawColor()
// - si un seul paramètre = niveau de gris (entre 0 et 255)
// - si 3 paramètres = composantes RGB (entre 0 et 255)
$pdf->SetDrawColor(128); // niveau de gris
$pdf->line(10,15,200,15); // ligne horizontale en haut
$pdf->line(10,285-2,200,285-2); // ligne horizontale en bas

// Envoyer le document vers une destination = Output()
// - premier paramètre (optionnel) = nom du fichier
// - deuxième paramètre (optionnel) = type de destination
//     > F = fichier sur le serveur
//       I = navigateur (en ligne)
//       D = navigateur (téléchargement)
// Si aucun paramètre : destination = I
// Si un nom est spécifié : destination par défaut = F
$pdf->Output(); // navigateur (en ligne)

?>
