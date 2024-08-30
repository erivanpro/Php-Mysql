<!DOCTYPE html>
<html xmlns="http://www.w3.org/1999/xhtml" lang="fr">
  <head>
    <meta charset="utf-8" />
    <title>Lire un document XML</title>
  </head>
  <body>
  <div>
  
  <?php

  // Charger le document XML = simplexml_load_file()
  // - retourne un objet de la classe simplexml_element
  //   ou FALSE en cas d'erreur (document XML mal formé par exemple)
  $xml = simplexml_load_file('articles.xml');
  if (! $xml) { exit; }

  // L'objet $xml a une structure qui correspond à la
  // structure de notre document :
  // - article (tableau d'objets)
  //     - identifiant
  //     - libelle
  //     - prix

  // Parcours du noeud article (tableau).
  echo "<b>Parcours de \$xml->article</b><br />\n";
  foreach ($xml->article as $article) {
    printf("%s,%s,%s,%s,%s<br />\n",
           $article->identifiant,
           $article->libelle,
           $article->prix,
           $article['code'],
           $article['couleur']);
  }

  // Accès à une information particulière.
  echo "<b>Accès à une information particulière</b><br />\n";
  printf("Avant - Prix de %s = %s (code = %s)<br />\n",
         $xml->article[2]->libelle,
         $xml->article[2]->prix,
         $xml->article[2]['code']);
  $xml->article[2]->prix = 123;
  $xml->article[2]['code'] .= '+';
  printf("Après - Prix de %s = %s (code = %s)<br />\n",
         $xml->article[2]->libelle,
         $xml->article[2]->prix,
         $xml->article[2]['code']);

  // Extraction des attributs d'un noeud = méthode attributes()
  // - retourne un objet de la classe simplexml_element
  // - sur notre exemple, récupération des attributs du 1er article
  $attributs = $xml->article[0]->attributes();

  // Parcours des attributs ainsi récupérés.
  echo "<b>Attributs du premier article</b><br />\n";
  foreach($attributs as $nom => $valeur) {
    printf("%s = %s<br />\n",$nom,$valeur);
  }

  // Extraire les enfants d'un noeud = méthode children()
  // - retourne un objet de la classe simplexml_element
  echo "<b>Parcours de l'arborescence</b><br />\n";
  echo "racine<br />\n";
  foreach ($xml->children() as $nom1 => $niveau1) {
    printf("----%s (%s,%s)<br />\n",
           $nom1,$niveau1['code'],$niveau1['couleur']);
    foreach ($niveau1->children() as $nom2 => $niveau2) {
      printf("--------%s = %s<br />\n",$nom2,$niveau2);
    }
  }

  // Effectuer une recherche Xpath = méthode xpath()
  // - retourne un tableau d'objets de la classe simplexml_element
  echo "<b>Recherche Xpath : /articles/article</b><br />\n";
  $résultat = $xml->xpath("/articles/article");
  foreach ($résultat as $valeur) {
    printf("%s,%s<br />\n",$valeur->identifiant,$valeur->libelle);
  }
  echo "<b>Recherche Xpath : article/libelle</b><br />\n";
  $résultat = $xml->xpath("article/libelle");
  foreach ($résultat as $valeur) {
    printf("%s<br />\n",$valeur);
  }
  echo "<b>Recherche Xpath : //prix</b><br />\n";
  $résultat = $xml->xpath("//prix");
  foreach ($résultat as $valeur) {
    printf("%s<br />\n",$valeur);
  }

  // Générer une chaîne XML = méthode asXML()
  echo "<b>Chaîne XML</b><br />\n";
  file_put_contents ('les_articles.xml',$xml->asXML());
  file_put_contents ('un_article.xml',$xml->article[0]->asXML());
  echo "Voir les fichiers 'les_articles.xml' et 'un_article.xml'<br />\n";

  ?>
  
  </div>
  </body>
</html>