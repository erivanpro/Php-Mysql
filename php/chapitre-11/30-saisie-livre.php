<?php
// Inclusion du fichier qui contient les fonctions générales.
include('../include/fonctions.inc.php');
// Variables qui indiquent si un livre doit être chargé et/ou
// si un livre doit être enregistré.
$charger_livre = FALSE;
$enregistrer_livre = FALSE;
// Initialiser la variable de message (sous la forme d'un tableau 
// pour pouvoir stocker plusieurs messages).
$messages = [];
// Tester si le script est appelé en traitement d'un formulaire.
if (isset($_POST['charger']) OR isset($_POST['ok'])) { // oui
  // Récupérer l'identifiant du livre.
  // Utilisation d'un filtre pour s'assurer que la valeur
  // récupérée est bien un entier.
  $id_livre = filter_input(INPUT_POST,'id',FILTER_VALIDATE_INT);
  // Identifiant absent ou invalide => message.
  // Sinon, déterminer l'action à effectuer.
  if ($id_livre === FALSE OR $id_livre === NULL) {
    $messages[] = 'Identifiant absent ou invalide.';
  } else {
    $enregistrer_livre = isset($_POST['ok']);
    $charger_livre = // enregistrer => rechargement
      (isset($_POST['charger']) OR $enregistrer_livre);
  }
}
// Connexion si nécessaire.
if ($charger_livre OR $enregistrer_livre) {
  // Utilisation de l'opérateur @ pour masquer les alertes.
  $db = @mysqli_connect('localhost','eniweb','web','eni');
  // En cas d'erreur, on arrête tout.
  if ($db === FALSE) {
    $erreur = mysqli_connect_error();
    $messages[] = "Erreur de connexion à la base de données ($erreur).";
    $charger_livre = FALSE;
    $enregistrer_livre = FALSE;
  }
}
// S'il y a un livre à enregistrer ...
if ($enregistrer_livre) {  
  // Récupérer le contenu du formulaire.
  // Il faudrait vérifier la saisie ...
  $livre = $_POST;
  // Enregistrement du livre.
  $sql = 'UPDATE livre SET ' .
           'isbn = ?,' .
           'titre = ?,' .
           'sous_titre = ?,' .
           'nombre_pages = ?,' .
           'annee_parution = ?,' .
           'niveau = ?,' .
           'id_collection = ?,' .
           'description = ? ' .
         'WHERE id = ?';
  if ($ok = ($req_maj = mysqli_prepare($db,$sql))) {
    $ok = mysqli_stmt_bind_param
            (
            $req_maj,
            'sssiisisi',
            $livre['isbn'],
            $livre['titre'],
            $livre['sous_titre'],
            $livre['nombre_pages'],
            $livre['annee_parution'],
            $livre['niveau'],
            $livre['collection'],
            $livre['description'],
            $id_livre
            );
    if ($ok) { $ok = mysqli_stmt_execute($req_maj); }
    if (! $ok) { $erreur  = mysqli_stmt_error($req_maj);}
    mysqli_stmt_close($req_maj);
  } else {
    $erreur  = mysqli_error($db);
  }
  if (! $ok) {
    $messages[] = "Erreur lors de la mise à jour du livre ($erreur).";
  }
  // Enregistrement des rubriques du livre.
  // Annule (DELETE) et remplace (INSERT) l'existant.
  if ($ok) {
    // Suppression des rubriques actuelles.
    $sql = 'DELETE FROM rubrique_livre WHERE id_livre = ?';
    if ($ok = ($req_maj = mysqli_prepare($db,$sql))) {
      $ok = mysqli_stmt_bind_param($req_maj,'i',$id_livre);
      if ($ok) { $ok = mysqli_stmt_execute($req_maj); }
      if (! $ok) { $erreur = mysqli_stmt_error($req_maj);}
      mysqli_stmt_close($req_maj);
    } else {
      $erreur = mysqli_error($db);
    }
    // Insertions des nouvelles rubriques (s'il y en a).
    if ($ok AND ($rubriques = $livre['rubriques'])) {
      $sql = 'INSERT INTO rubrique_livre(id_livre,id_rubrique) '.
             'VALUES(?,?)';
      if ($ok = ($req_maj = mysqli_prepare($db,$sql))) {
        $ok = mysqli_stmt_bind_param
                ($req_maj,'ii',$_POST['id'],$id_rubrique);
        if ($ok) {
          foreach ($rubriques as $id_rubrique) {
            $ok = mysqli_stmt_execute($req_maj);
            if (! $ok) { 
              $erreur = mysqli_stmt_error($req_maj);
              break;
            }
          }
        }
        mysqli_stmt_close($req_maj);
      } else {
        $erreur = mysqli_error($db);
      }
    }
    if (! $ok) {
      $messages[] = "Erreur lors de la mise à jour des rubriques ($erreur).";
    }
  }
  // Enregistrement de l'image de couverture
  if ($ok) {
    // Si un fichier a été téléchargé avec succès, lire 
    // son contenu.
    switch ($_FILES['couverture']['error']) {
      case UPLOAD_ERR_NO_FILE :
        break;
      case UPLOAD_ERR_OK :
        $couverture = 
          @file_get_contents($_FILES['couverture']['tmp_name']);
        if (! $couverture) {
          $erreur = 'problème avec l\'image de couverture';
          $ok = FALSE;
        }
        break;
      default :
        $erreur = 'image de couverture non transférée';
        $ok = FALSE;
        break;
    }
    if ($couverture) { // il a bien une image ...
      $sql = 'UPDATE livre SET couverture = ? WHERE id = ?';
      if ($ok = $req_maj = mysqli_prepare($db,$sql)) {
        $ok = mysqli_stmt_bind_param
                ($req_maj,'bi',$couverture,$_POST['id']);
        if ($ok) {
          $ok = mysqli_stmt_send_long_data
                  ($req_maj,0,$couverture);
        }
        if ($ok) { $ok = mysqli_stmt_execute($req_maj); };
        if (! $ok) { $erreur = mysqli_stmt_error($req_maj);}
        mysqli_stmt_close($req_maj);
      } else {
        $erreur = mysqli_error($db);
      }
    }
    if (! $ok) {
      $messages[] = "Erreur lors de la mise à jour de la couverture ($erreur).";
    }
  }
}
// S'il y a un livre à charger ...
if ($charger_livre) {
  // Charger les informations sur le livre proprement dit, 
  // dans le tableau associatif $livre.
  $sql = "SELECT *  FROM livre WHERE id = $id_livre";
  if ($ok = ($req_liv = mysqli_query($db,$sql))) {
    $livre = mysqli_fetch_assoc($req_liv);
    if (! $livre) {
      $messages[] = 'Aucun livre trouvé.';
    }
  }
  // Si tout est OK à ce stade, sélectionner la liste
  // des collections (pour la liste déroulante).
  // Le fetch sera fait plus tard.
  if ($ok AND $livre) {
    $sql = 'SELECT id,nom FROM collection';
    $ok = ($req_col = mysqli_query($db,$sql));
  }
  // Si tout est OK à ce stade, sélectionner la liste
  // des rubriques (pour la liste de sélection).
  // Le fetch sera fait plus tard.
  if ($ok AND $livre) {
    // La requête utilisée permet d'avoir une colonne
    // 'selection' qui est à 1 lorsque la rubrique est
    // sélectionnée pour le livre.
    $sql = 
      "SELECT rub.id,rub.titre,rul.selection
      FROM
        ( /* liste des sous-rubriques, sous la forme
            '<rubrique> - <sous-rubrique>' */
        SELECT sru.id,CONCAT(rub.titre,' - ',sru.titre) titre
        FROM rubrique sru JOIN rubrique rub 
             ON (sru.id_parent = rub.id) 
        WHERE sru.id_parent IS NOT NULL
        ) rub
        LEFT JOIN
        ( /* liste des rubriques sélectionnées pour le livre */
        SELECT id_rubrique,1 selection
        FROM rubrique_livre
        WHERE id_livre = $id_livre
        ) rul
        ON (rub.id = rul.id_rubrique)";
    $ok = ($req_rub = mysqli_query($db,$sql));
  }
  // En cas d'erreur, initialisation d'un message et effacement
  // du tableau $livre.
  if (! $ok) {
    $erreur = mysqli_error($db);
    $messages[] = "Erreur lors du chargement du livre ($erreur).";
    unset($livre);
  }
}
// Affichage de la page ...
?>
<!DOCTYPE html>
<html xmlns="http://www.w3.org/1999/xhtml" lang="fr">
  <head>
    <meta charset="utf-8" />
    <title>Saisir un livre</title>
  </head>
  <body>
    <!-- Formulaire de saisie de l'identifiant. -->
    <form action="<?= $_SERVER['REQUEST_URI'] ?>" method="post">
    <div>
    Identifiant : 
    <input type="text" name="id" size="6" 
       value="<?php echo vers_formulaire($id_livre); ?>" />
    <input type="submit" name="charger" value="Charger" />
    </div>
    </form>
    <!-- Formulaire de saisie du livre (affiché uniquement si
         un livre a été chargé avec succès) -->
    <?php if ($livre): ?>
    <form action="<?= $_SERVER['REQUEST_URI'] ?>" method="post" 
     enctype="multipart/form-data">
    <div>
      <br />ISBN :
      <input type="text" name="isbn" size="20" maxlength="20"
       value="<?php echo vers_formulaire($livre['isbn']); ?>" />
      <br />Titre : 
      <input type="text" name="titre" size="75" maxlength="75"
       value="<?php echo vers_formulaire($livre['titre']); ?>" />
      <br />Sous-titre :
      <input type="text" name="sous_titre" size="75" maxlength="75"
       value=
        "<?php echo vers_formulaire($livre['sous_titre']); ?>" />
      <br />Nombre pages :
      <input type="text" name="nombre_pages" size="4" maxlength="4"
       value=
        "<?php echo vers_formulaire($livre['nombre_pages']); ?>" />
      Année de parution :
      <input type="text" name="annee_parution" 
       size="4" maxlength="4"
       value=
       "<?php echo vers_formulaire($livre['annee_parution']); ?>" 
      />
      <br />Niveau :
      <?php
      // Génération dynamique des boutons radios utilisés pour
      // le niveau.
      $niveaux = array('Débutant','Initié','Confirmé','Expert');
      foreach ($niveaux as $niveau) {
        // Niveau du livre = niveau courant => bouton coché.
        if ($livre['niveau'] == $niveau) {
          $sélection = 'checked="checked"';
        } else {
          $sélection = '';
        }
        printf
          (
          '<input type="radio" name="niveau" %s value="%s" />%s',
          $sélection,$niveau,$niveau
          );
      }
      ?>
      <br />Collection :
      <select name="collection">
      <?php
      // Génération dynamique de la liste utilisée pour
      // la collection.
      while ($collection = mysqli_fetch_assoc($req_col)) {
        // Collection du livre = collection courante
        // => ligne sélectionnée.
        if ($livre['id_collection'] == $collection['id']) {
          $sélection = 'selected="selected"';
        } else {
          $sélection = '';
        }
        printf
          ('<option %s value="%s">%s</option>',
           $sélection,$collection['id'],$collection['nom']);
      }
      ?>
      </select>
      <br />Rubriques :<br />
      <select name="rubriques[]" multiple="multiple" size="8">
      <?php
      // Génération dynamique de la liste utilisée pour
      // les rubriques.
      while ($rubrique = mysqli_fetch_assoc($req_rub)) {
        // Colonne 'selection' = 1 = rubrique du livre
        // => ligne sélectionnée.
        if ($rubrique['selection'] == 1) {
          $sélection = 'selected="selected"';
        } else {
          $sélection = '';
        }
        printf
          ('<option %s value="%s">%s</option>',
           $sélection,$rubrique['id'],$rubrique['titre']);
      }
      ?>
      </select>
      <br />Description :<br />
      <textarea name="description" rows="6" cols="65"><?php 
      echo vers_formulaire($livre['description']); ?></textarea>
      <br />
      <!-- L'image de couverture est affichée par appel à un
           autre script PHP. -->
      <img alt="Couverture :" 
       src="00-image-livre.php?id=<?php echo $id_livre; ?>" />
      <input type="file" name="couverture" value="" size="65" />
      <input type="hidden" name="id" 
       value="<?php echo $id_livre; ?>" />
      <br />
      <input type="submit" name="ok" value="Enregistrer" />
    </div>
    </form>
    <?php endif; ?>
    <!-- afficher les éventuels messages -->
    <div><?= vers_page(implode("\n",$messages)) ?></div>
  </body>
</html>