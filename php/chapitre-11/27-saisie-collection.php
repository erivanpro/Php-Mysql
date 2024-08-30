<?php
// Inclusion du fichier qui contient les fonctions générales.
include('../include/fonctions.inc.php');
// Initialiser la variable de message (sous la forme d'un tableau 
// pour pouvoir stocker plusieurs messages).
$messages = [];
// Connexion.
// Utilisation de l'opérateur @ pour masquer les alertes.
$ok = (bool) ($db = @mysqli_connect('localhost','eniweb','web','eni'));
if (! $ok) {
  $erreur = mysqli_connect_error();
  $messages[] = "Erreur de connexion à la base de données ($erreur).";
}
// Traitement du formulaire.
if ($ok and isset($_POST['ok'])) {
  // Récupérer le tableau contenant la saisie.
  $lignes = $_POST['saisie'];
  // Initialiser les variables utilisées pour les curseurs paramétrés.
  $req_ins = NULL;
  $req_del = NULL;
  $req_upd = NULL;
  // Initialiser la variable utilisée pour compter les mises à jour.
  $nombre = 0;
  // Parcourir le résultat de la saisie.
  foreach($lignes as $id => $ligne) {
    // Nettoyage de la saisie.
    $nom = trim($ligne['nom']);
    // Pour le prix, remplacer la virgule par un point
    // et supprimer les espaces.
    $prix_ht = str_replace([',',' '],['.',''],$ligne['prix_ht']);
    // A ce stade, il faudrait vérifier un peu mieux la saisie ...
    // Initialiser l'indicateur de succès.
    $ok_maj = TRUE;
    // Définir la requête à exécuter.
    // Pour chaque action, nous allons utiliser une requête
    // préparée. Lorsqu'un cas est recontré pour la première 
    // fois, il faut préparer la requête et lier les variables.
    $requête = NULL;
    if ($id < 0 and $nom.$prix_ht != '') {
      // Identifiant négatif et quelque chose de saisi = création = INSERT
      if ($req_ins == NULL) {
        $sql = 'INSERT INTO collection(nom,prix_ht) VALUES(?,?)';
        $ok_maj = (bool) ($req_ins = mysqli_prepare($db,$sql));
        if ($ok_maj) {
          $ok_maj = mysqli_stmt_bind_param($req_ins,'sd',$nom,$prix_ht);
        }
      }
      $requête = $req_ins;
    } elseif (isset($ligne['supprimer'])) {
      // Case "supprimer" cochée = suppression = DELETE
      if ($req_del == NULL) {
        $sql = 'DELETE FROM collection WHERE id = ?';
        $ok_maj = (bool) ($req_del = mysqli_prepare($db,$sql));
        if ($ok_maj) {
          $ok_maj = mysqli_stmt_bind_param($req_del,'i',$id);
        }
      }
      $requête = $req_del;
    } elseif (! empty($ligne['modifier'])) {
      // Zone "modifier" non vide = modification = UPDATE
      if ($req_upd == NULL) {
        $sql = 'UPDATE collection SET nom = ?, prix_ht = ? ' .
               'WHERE id = ?';
        $ok_maj = (bool) ($req_upd = mysqli_prepare($db,$sql));
        if ($ok_maj) {
          $ok_maj = mysqli_stmt_bind_param($req_upd,'sdi',$nom,$prix_ht,$id);
        }
      }
      $requête = $req_upd;
    }
    // Si tout est OK et qu'une requête a été définie, l'exécuter.
    if ($ok_maj and $requête != NULL) {
      $ok_maj = mysqli_stmt_execute($requête);
      if ($ok_maj) {$nombre++;}
    }
    if (! $ok_maj) {
      if (! $requête) { // erreur lors de la préparation
        $erreur = mysqli_error($db);
      } else { // erreur ailleurs
        $erreur = mysqli_stmt_error($requête);
      }
      $messages[] = 
        sprintf(
          'Erreur lors de la mise à jour de la collection [%s] (%s).',
          "$id / $nom / $prix_ht",
          $erreur);
    }
  } // foreach
  // Définir le message final.
  if ($nombre == 0) {
    $messages[] = 'Aucune mise à jour effectuée.';
  } else {
    $messages[] = "$nombre collection(s) mise(s) à jour avec succès.";
  }
}
// Recharger les collections (ici avec une requête non préparée).
if ($ok) {
  $sql = 'SELECT * FROM collection';
  $ok = (bool) ($résultat = mysqli_query($db,$sql));
  if (! $ok) {
    $erreur = mysqli_error($db);
    $messages[] = "Erreur lors du chargement des collections ($erreur).";
  }
}
// Affichage de la page ...
?>
<!DOCTYPE html>
<html xmlns="http://www.w3.org/1999/xhtml" lang="fr">
  <head>
    <meta charset="utf-8" />
    <title>Gestion des collections</title>
    <style>
    table { border-collapse: collapse; }
    table, td, th { border: 1px solid black; }
    td, th { padding: 4px; }
    </style>
  </head>
  <body>
    <?php if ($ok): ?>
    <!-- construction d'une table HTML à l'intérieur 
    ++++ d'un formulaire -->
    <form name="formulaire" action="<?= $_SERVER['REQUEST_URI'] ?>" 
          method="post">
    <table>
    <!-- ligne de titre -->
    <tr style="text-align:center">
    <th>Identifiant</th><th>Nom</th><th>Prix H.T.</th>
                <th>Supprimer</th>
    </tr>
    <?php
    // Code PHP générant les lignes du tableau.
    // Initialisation d'un compteur de ligne.
    $i = 0;
    // Boucle de fetch.
    while ($ligne = mysqli_fetch_assoc($résultat)) {
      // Incrémentation du compteur de ligne.
      $i++;
      // Calcul du numéro d'ordre dans le formulaire de la
      // zone cachée correspondant à l'identifiant.
      $n = 4 * ($i - 1);
      // Mise en forme des données.
      $ligne['nom'] = vers_page($ligne['nom']);
      $ligne['prix_ht'] = 
        vers_page
          (number_format($ligne['prix_ht'],2,"," ," "));
      // Génération de la ligne de la table HTML.
      // Insertion des balises INPUT du formulaire.
      printf(
      "<tr><td>%s</td><td>%s</td><td>%s</td><td>%s</td></tr>",
      "$ligne[id]
       <input type=\"hidden\"
          name=\"saisie[$ligne[id]][modifier]\" />",
      "<input type=\"text\"
          name=\"saisie[$ligne[id]][nom]\"
          value=\"$ligne[nom]\"
          onchange=\"document.formulaire[$n].value=1\" />",
      "<input type=\"text\"
          name=\"saisie[$ligne[id]][prix_ht]\"
          value=\"$ligne[prix_ht]\"
          onchange=\"document.formulaire[$n].value=1\" />",
      "<input type=\"checkbox\"
          name=\"saisie[$ligne[id]][supprimer]\"
          value=\"$ligne[id]\" />");
    } // while
    // Ajout de 5 lignes vides pour la création
    // (sans identifiant, sans case de suppression).
    for($i=1;$i<=5;$i++) {
      printf(
      "<tr><td>%s</td><td>%s</td><td>%s</td><td>%s</td></tr>",
      "",
      "<input type=\"text\" name=\"saisie[-$i][nom]\" value=\"\" />",
      "<input type=\"text\" name=\"saisie[-$i][prix_ht]\" value=\"\" />",
      "");
    } // for
    ?>    
    </table>
    <p><input type="submit" name="ok" value="Enregistrer" /></p>
    </form>
    <?php endif; ?>
    <!-- afficher les éventuels messages -->
    <div><?= vers_page(implode("\n",$messages)) ?></div>
  </body>
</html>
