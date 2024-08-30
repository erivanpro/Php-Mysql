/*
** Exemples du chapitre 5
*/


-- 1.	Grouper les données
--
-- Nombre de livres par collection.
SELECT id_collection,COUNT(*) 
FROM livre 
GROUP BY id_collection;
--
-- Nombre de livres et nombre moyen de pages par collection
-- (avec le nom de la collection au lieu de l'identifiant).
SELECT
  col.nom collection,
  COUNT(liv.id) nb_livres,
  ROUND(AVG(liv.nombre_pages)) nb_pages_moy
FROM 
  livre liv JOIN collection col 
  ON (liv.id_collection = col.id)
GROUP BY
  col.nom
ORDER BY
  nb_livres; -- tri sur le nombre de livres
--
-- Nombre de livre par tranche d'année et collection.
SELECT
  CASE
    WHEN annee_parution BETWEEN 2005 AND 2011
    THEN '2005-2011'
    WHEN annee_parution BETWEEN 2012 AND 2019
    THEN '2012-2019'
  END tranche_annee,
  col.nom collection,
  COUNT(liv.id) nb_livres
FROM 
  livre liv JOIN collection col 
  ON (liv.id_collection = col.id)
GROUP BY -- utilisation des alias de colonne
  tranche_annee,
  collection
ORDER BY
  tranche_annee;
--
-- Utilisation d'une expression non reprise dans le GROUP BY
SELECT
  col.nom collection, -- non présent dans le GROUP BY
  col.prix_ht, -- non présent dans le GROUP BY
  COUNT(liv.id) nb_livres
FROM 
  livre liv JOIN collection col 
  ON (liv.id_collection = col.id)
GROUP BY
  col.id;
--
-- Utilisation d'une expression non unique dans le groupe 
-- et non reprise dans le GROUP BY
-- Génère une erreur si le mode SQL ONLY_FULL_GROUP_BY est actif 
-- (ce qui est le cas par défaut depuis la version 5.7.5)
SELECT
  col.nom collection,
  liv.annee_parution, -- pas unique dans le groupe !
  COUNT(liv.id) nb_livres
FROM 
  livre liv JOIN collection col 
  ON (liv.id_collection = col.id)
GROUP BY
  col.nom;
-- 
-- "Solution" : appliquer une fonction de groupe
SELECT
  col.nom collection,
  MIN(liv.annee_parution) premiere_parution,
  COUNT(liv.id) nb_livres
FROM 
  livre liv JOIN collection col 
  ON (liv.id_collection = col.id)
GROUP BY
  col.nom
ORDER BY
  col.nom;
--
-- Clause HAVING
-- Afficher uniquement les lignes qui ont
-- au moins deux livres.
SELECT 
  (nombre_pages DIV 100) * 100 tranche_pages,
  COUNT(*) nb_livres,
  MAX(annee_parution) derniere_parution
FROM
  livre
GROUP BY
  tranche_pages
HAVING -- utilisation des alias
  nb_livres > 1
ORDER BY
  tranche_pages;
--  
-- Afficher uniquement les lignes qui ont
-- au moins deux livres et une dernière 
-- parution postérieure à 2015.
SELECT 
  (nombre_pages DIV 100) * 100 tranche_pages,
  COUNT(*) nb_livres,
  MAX(annee_parution) derniere_parution
FROM
  livre
GROUP BY
  tranche_pages
HAVING -- utilisation des alias
  nb_livres > 1
  AND derniere_parution > 2015
ORDER BY
  tranche_pages;


-- 2.2.	Sous-requête scalaire
--
-- Dans un SELECT.
-- Ecart entre le prix de la collection 1 et le prix moyen
-- des collections.
SELECT
  ROUND(prix_ht - (SELECT AVG(prix_ht) FROM collection),2) ecart
FROM
  collection
WHERE
  id = 1;
--
-- Dans un UPDATE.
-- Prix TTC catalogue de l'article de code "RI7PHP".
SELECT prix_ttc FROM catalogue WHERE code = 'RI7PHP';
-- Affecter le prix TTC de la collection à l'article
-- du catalogue ayant le code "RI7PHP".
UPDATE catalogue 
SET prix_ttc = 
  (SELECT prix_ht+ROUND(prix_ht*5.5/100)
   FROM collection WHERE id = 1) -- sous-requête
WHERE code = 'RI7PHP';
-- Vérifier
SELECT prix_ttc FROM catalogue WHERE code = 'RI7PHP';


-- 2.3.	Comparaison avec une sous-requête
--
-- Opérateur scalaire
-- Collection la plus chère.
SELECT nom,prix_ht FROM collection 
WHERE prix_ht = (SELECT MAX(prix_ht) FROM collection);
-- Collections dont le prix est inférieur à la moyenne 
-- du prix des collections.
SELECT nom,prix_ht FROM collection 
WHERE prix_ht <= (SELECT AVG(prix_ht) FROM collection);
--
-- IN
-- Titre des ouvrages des collections qui 
-- n'ont qu'un ouvrage.
SELECT titre,id_collection
FROM livre 
WHERE id_collection IN
  -- La sous-requête donne la liste des identifiants
  -- des collections qui n'ont qu'un ouvrage.
  (SELECT id_collection FROM livre 
   GROUP BY id_collection HAVING COUNT(*) = 1);
--
-- ANY - ALL
-- Livres dont le nombre de pages est supérieur au nombre
-- de pages d'au moins un livre de la collection 1.
SELECT titre,nombre_pages,id_collection FROM livre
WHERE nombre_pages > ANY 
  (SELECT nombre_pages FROM livre WHERE id_collection = 1);
-- Livres dont le nombre de pages est supérieur au nombre
-- de pages de tous les livres de la collection 1.
SELECT titre,nombre_pages,id_collection FROM livre
WHERE nombre_pages > ALL 
  (SELECT nombre_pages FROM livre WHERE id_collection = 1);
--
-- Attention à l’utilisation de certains opérateurs (NOT IN ou > ALL par exemple) 
-- lorsque la sous-requête retourne une valeur NULL
SELECT titre FROM rubrique
WHERE 
  id_parent NOT IN 
    (SELECT id_parent FROM rubrique GROUP BY id_parent HAVING COUNT(*) > 2);
SELECT id_parent FROM rubrique GROUP BY id_parent HAVING COUNT(*) > 2; 
SELECT titre FROM rubrique
WHERE 
  id_parent NOT IN 
    (SELECT id_parent FROM rubrique 
     WHERE id_parent IS NOT NULL -- ne pas retourner les valeurs NULL
     GROUP BY id_parent HAVING COUNT(*) > 2);



-- 2.4.	Sous-requête corrélée
--
-- Dans un SELECT.
-- Livres qui ont plus d'un auteur (requête EXISTS).
SELECT liv.titre FROM livre liv
WHERE EXISTS
  (SELECT 1 FROM auteur_livre aul WHERE aul.id_livre = liv.id
   GROUP BY aul.id_livre HAVING COUNT(*) > 1);
-- Livres qui ont plus d'un auteur (comparaison avec une
-- sous-requête scalaire).
SELECT liv.titre FROM livre liv
WHERE
  (SELECT COUNT(*) FROM auteur_livre aul 
   WHERE aul.id_livre = liv.id) > 1;
--
-- Dans un DELETE.
-- Sous-rubriques de la rubrique 2 qui n'ont 
-- pas de livre affecté. 
SELECT rub.titre FROM rubrique rub
WHERE 
  rub.id_parent = 2
  AND NOT EXISTS
    (SELECT 1 FROM rubrique_livre rul 
     WHERE rul.id_rubrique = rub.id);
-- Supprimer les sous-rubriques de la rubrique 2 
-- qui n'ont pas de livre affecté. 
DELETE FROM rubrique rub -- utilisation d'un alias 
WHERE 
  id_parent = 2
  AND NOT EXISTS
    (SELECT 1 FROM rubrique_livre rul 
     WHERE rul.id_rubrique = rub.id);
--
-- Dans la clause WHERE d'un UPDATE.
-- Collections qui ont au moins un livre de plus de 500 pages.
SELECT id,nom,frais_ht FROM collection col
WHERE EXISTS
  (SELECT 1 FROM livre liv 
   WHERE liv.id_collection = col.id AND nombre_pages > 500);
-- Augmenter de 25 centimes les frais pour les collections
-- qui ont au moins un livre de plus de 500 pages.
UPDATE collection col SET frais_ht = frais_ht + 0.25
WHERE EXISTS
  (SELECT 1 FROM livre liv 
   WHERE liv.id_collection = col.id AND nombre_pages > 500);
-- Vérifier.
SELECT id,nom,frais_ht FROM collection col WHERE id IN (1,4,5);
--
-- Dans la clause SET d'un UPDATE.
-- Frais des collections 4 et 5.
SELECT id,frais_ht FROM collection WHERE id IN (4,5);
-- Calculer les frais des collections 4 et 5.
-- Formule = 0,004 centimes x le nombre de pages moyen des 
--                            livres de la collection
UPDATE collection col
SET col.frais_ht = 
  (SELECT ROUND(AVG(nombre_pages)*0.004,2) FROM livre liv
   WHERE liv.id_collection = col.id)
WHERE id IN (4,5);
-- Vérifier.
SELECT id,frais_ht FROM collection WHERE id IN (4,5);


-- 2.5.	Sous-requête dans la clause FROM
--
-- Afficher le nom de la collection et le premier livre
-- de la collection (ordre alphabétique du titre).
SELECT col.nom,liv.titre 
FROM
  collection col
    JOIN
  ( -- premier titre de la collection
  SELECT id_collection,MIN(titre) titre  
  FROM livre GROUP BY id_collection
  ) liv
    ON (col.id = liv.id_collection);


-- 2.6.	Insérer des lignes à l’aide d’une sous-requête
--
-- Créer une nouvelle table destinée à stocker des 
-- informations statistiques sur les collections 
CREATE TABLE statistique_collection
  (
  collection VARCHAR(30) PRIMARY KEY,
  nombre_livres INT,
  premiere_parution YEAR(4)
  );
-- Alimenter la table.
INSERT INTO statistique_collection
  (collection,nombre_livres,premiere_parution)
SELECT
  col.nom,COUNT(liv.id),MIN(liv.annee_parution)
FROM 
  livre liv JOIN collection col 
  ON (liv.id_collection = col.id)
GROUP BY
  col.nom
ON DUPLICATE KEY UPDATE
  nombre_livres = VALUES(nombre_livres),
  premiere_parution = VALUES(premiere_parution);
-- Vérifier.
SELECT * FROM statistique_collection;


-- 2.7.	Clause WITH
--
-- Pour chaque livre paru après 2015, afficher le nombre 
-- de rubriques du livre et le nombre d'auteurs du livre.
WITH
  rub AS (SELECT id_livre,COUNT(*) nombre 
          FROM rubrique_livre 
          GROUP BY id_livre),
  aut AS (SELECT id_livre,COUNT(*) nombre 
          FROM auteur_livre 
          GROUP BY id_livre)
SELECT
  liv.titre,
  liv.annee_parution,
  rub.nombre nombre_rubriques,
  aut.nombre nombre_auteurs
FROM
  livre liv
  JOIN rub ON rub.id_livre = liv.id
  JOIN aut ON aut.id_livre = liv.id
WHERE
  liv.annee_parution > 2015
ORDER BY
  liv.titre;


-- 3.1 Introduction
--
-- Créer la table utilisée par les fonctions de fenêtrage
CREATE TABLE formateurs
  (
  id INT PRIMARY KEY AUTO_INCREMENT,
  nom VARCHAR(30) NOT NULL,
  code_departement CHAR(2),
  salaire INT,
  date_naissance DATE
  );
INSERT INTO formateurs
  (nom,code_departement,salaire,date_naissance)
VALUES
  ('Olivier','49',21000,'1989-08-03'),
  ('Philippe','56',22300,'1993-10-21'),
  ('Pierre','92',22100,'1992-11-26'),
  ('Thomas','49',22400,'1990-02-21'),
  ('David','56',20500,'1993-04-16'),
  ('Xavier','92',20000,'1991-11-20'),
  ('Marc','49',20700,'1990-06-10'),
  ('Jean','56',24800,'1992-04-08'),
  ('Alain','92',20600,'1992-08-06'),
  ('Didier','49',20900,'1990-03-06'),
  ('Marie','56',21200,'1992-04-12'),
  ('Nathalie','92',18600,'1990-06-18'),
  ('Valérie','49',20000,'1990-10-30'),
  ('Séverine','56',19200,'1992-01-10'),
  ('Isabelle','92',22100,'1991-08-09'),
  ('Anne','49',21400,'1991-10-23'),
  ('Sylvie','56',24900,'1992-08-10'),
  ('Alice','92',24100,'1990-09-04'),
  ('Agathe','49',24400,'1989-09-23'),
  ('Véronique','56',23500,'1993-05-10');
CREATE TABLE departements
  (
  code CHAR(2) PRIMARY KEY,
  nom VARCHAR(30) NOT NULL
  );
INSERT INTO departements
  (code,nom)
VALUES
  ('49','Maine-et-Loire'),
  ('56','Morbihan'),
  ('92','Hauts-de-Seine');


-- 3.2 Fonctions de classement
--
-- Classement en fonction du salaire.
-- Différence entre les fonctions ROW_NUMBER, RANK et DENSE_RANK.
SELECT
  nom,
  salaire,
  ROW_NUMBER() OVER(ORDER BY salaire DESC) "row_number",
  RANK() OVER(ORDER BY salaire DESC) "rank",
  DENSE_RANK() OVER(ORDER BY salaire DESC) "dense_rank"
FROM
  formateurs
WHERE
  code_departement = '92';
-- 
-- Double classement, un en fonction du salaire et un en fonction de la
-- date de naissance.
--
--   a. Avec un tri sur le classement en fonction du salaire. 
SELECT
  nom,
  salaire,
  ROW_NUMBER() OVER(ORDER BY salaire DESC) rang_salaire,
  date_naissance,
  ROW_NUMBER() OVER(ORDER BY date_naissance) rang_date_naissance
FROM
  formateurs
WHERE
  code_departement = '92'
ORDER BY
  rang_salaire;
--  
--   b. Avec un tri alphabétique sur le nom du formateur.
SELECT
  nom,
  salaire,
  ROW_NUMBER() OVER(ORDER BY salaire DESC) rang_salaire,
  date_naissance,
  ROW_NUMBER() OVER(ORDER BY date_naissance) rang_date_naissance
FROM
  formateurs
WHERE
  code_departement = '92'
ORDER BY
  nom;
--
-- Classement sur un critère multiple.
SELECT
  nom,
  salaire,
  date_naissance,
  RANK() OVER(ORDER BY salaire DESC) rang1,
  RANK() OVER(ORDER BY salaire DESC,date_naissance) rang2
FROM
  formateurs
WHERE
  code_departement = '92';
--
-- Utilisation d'une fonction de fenêtrage dans une requête qui comporte
-- une jointure.
SELECT
  frm.nom,
  frm.salaire,
  dep.nom departement,
  RANK() OVER(ORDER BY frm.salaire DESC) rang
FROM
  formateurs frm JOIN departements dep 
  ON (frm.code_departement = dep.code)
WHERE
  frm.salaire <= 20000;
--
-- Utilisation d'une fonction de fenêtrage dans une requête qui comporte
-- une clause GROUP BY.
--  
--   a. Requête de base : salaire moyen par département.
SELECT
  code_departement,
  ROUND(AVG(salaire)) salaire_moyen
FROM
  formateurs
GROUP BY
  code_departement;
--  
--   b. Classement des départements en fonction du salaire moyen.
SELECT
  code_departement,
  ROUND(AVG(salaire)) salaire_moyen,
  RANK() OVER(ORDER BY ROUND(AVG(salaire)) DESC) rang
FROM
  formateurs
GROUP BY
  code_departement;
--
-- Sélectionner les trois formateurs qui gagnent le plus.
--  
--   a. Syntaxe interdite.
SELECT
  nom,
  salaire,
  RANK() OVER(ORDER BY salaire DESC) rang
FROM
  formateurs
WHERE
  RANK() OVER(ORDER BY salaire DESC) <= 3;
--  
--   b. Solution 1 : clause LIMIT.
SELECT
  nom,
  salaire,
  RANK() OVER(ORDER BY salaire DESC) rang
FROM
  formateurs
WHERE
  code_departement = '92'
ORDER BY rang LIMIT 3;
--  
--   c. Solution 2 : sous-requête.
WITH
  classement AS
  (
  SELECT
    nom,
    salaire,
    RANK() OVER(ORDER BY salaire DESC) rang
  FROM
    formateurs
WHERE
  code_departement = '92'
  )
SELECT * FROM classement WHERE rang <= 3;


-- 3.3 Partitionnement
--
-- Classement en fonction du salaire pour chaque département.
SELECT
  nom,
  code_departement,
  salaire,
  RANK() OVER(PARTITION BY code_departement ORDER BY salaire DESC) rang
FROM
  formateurs
WHERE
  salaire >= 21000 ;
--
-- Conserver uniquement les trois premiers formateurs de chaque département.
WITH
  classement AS
  (
  SELECT
    nom,
    code_departement,
    salaire,
    RANK() OVER(PARTITION BY code_departement 
                ORDER BY salaire DESC) rang
  FROM
    formateurs
  WHERE
    salaire >= 21000
  )
SELECT * FROM classement WHERE rang <= 3;
--
-- Utilisation de plusieurs fonctions de fenêtrage qui utilisent différentes 
-- clauses de partitionnement (éventuellement aucune).
--  
--   a. Exemple 1
SELECT
  nom,
  code_departement,
  salaire,
  RANK() OVER(PARTITION BY code_departement 
              ORDER BY salaire DESC) rang_dept,
  RANK() OVER(ORDER BY salaire DESC) rang_total
FROM
  formateurs
WHERE
  salaire >= 21000 
ORDER BY
  code_departement,
  rang_dept;
--  
--   b. Exemple 2
SELECT
  nom,
  code_departement departement,
  YEAR(date_naissance) annee,
  salaire,
  RANK() OVER(PARTITION BY code_departement 
              ORDER BY salaire DESC) rang_dept,
  RANK() OVER(PARTITION BY YEAR(date_naissance) 
              ORDER BY salaire DESC) rang_annee
FROM
  formateurs
WHERE
  salaire >= 21000 
ORDER BY
  code_departement,
  rang_dept;


-- 3.4 Fonctions d'agrégat
--
-- Pourcentage de chaque salaire par rapport à la somme des salaires.
SELECT
  nom,
  salaire,
  SUM(salaire) OVER() total,
  ROUND((salaire / SUM(salaire) OVER())*100,2) pourcent
FROM
  formateurs
WHERE
  code_departement = '92';
--  
-- La même chose au sein de chaque département (partitionnement).
SELECT
  nom,
  code_departement,
  salaire,
  ROUND(AVG(salaire) OVER(PARTITION BY code_departement)) moyenne,
  salaire - ROUND(AVG(salaire) OVER(PARTITION BY code_departement)) ecart
FROM
  formateurs
WHERE
  salaire >= 21000
ORDER BY
  code_departement,
  salaire;


-- 3.5 Fenêtres glissantes
--
-- Exemple 1 - Fenêtre glissante de type ROWS.
SELECT
  nom,
  salaire,
  SUM(salaire) 
    OVER(ORDER BY salaire 
         ROWS BETWEEN 1 PRECEDING AND 1 FOLLOWING) total
FROM
  formateurs
WHERE
  code_departement = '92';
--
-- Exemple 2 - Fenêtre glissante de type ROWS avec partitions.
SELECT
  nom,
  code_departement,
  salaire,
  SUM(salaire) 
    OVER(PARTITION BY code_departement
         ORDER BY salaire 
         ROWS BETWEEN 1 PRECEDING AND 1 FOLLOWING) total
FROM
  formateurs
WHERE
  salaire >= 21000
ORDER BY
  code_departement,
  salaire;
--
-- Exemple 3 - Fenêtre glissante de type RANGE.
SELECT
  nom,
  salaire,
  SUM(salaire) 
    OVER(ORDER BY salaire 
         RANGE BETWEEN 2000 PRECEDING AND 2000 FOLLOWING) total
FROM
  formateurs
WHERE
  code_departement = '92';
--
-- Exemple 4 : Somme cumulative.
SELECT
  nom,
  salaire,
  SUM(salaire) OVER(ORDER BY salaire) total1,
  SUM(salaire) 
    OVER(ORDER BY salaire 
         RANGE BETWEEN UNBOUNDED PRECEDING AND CURRENT ROW) total2,
  SUM(salaire) 
    OVER(ORDER BY salaire 
         ROWS BETWEEN UNBOUNDED PRECEDING AND CURRENT ROW) total3
FROM
  formateurs
WHERE
  code_departement = '92';
--
-- Exemple 5 - Fenêtre glissante temporelle.
SELECT
  nom,
  salaire,
  date_naissance,
  AVG(salaire)
    OVER(ORDER BY date_naissance 
         RANGE BETWEEN INTERVAL 1 YEAR PRECEDING 
                   AND INTERVAL 1 YEAR FOLLOWING) moyenne,
  COUNT(*)
    OVER(ORDER BY date_naissance 
         RANGE BETWEEN INTERVAL 1 YEAR PRECEDING 
                   AND INTERVAL 1 YEAR FOLLOWING) nombre
FROM
  formateurs
WHERE
  code_departement = '92';
--
-- Exemple 6 - Fenêtre nommée.
SELECT
  nom,
  salaire,
  date_naissance,
  AVG(salaire) OVER w moyenne,
  COUNT(*) OVER w nombre
FROM
  formateurs
WHERE
  code_departement = '92'
WINDOW w AS
  (ORDER BY date_naissance 
   RANGE BETWEEN INTERVAL 1 YEAR PRECEDING 
             AND INTERVAL 1 YEAR FOLLOWING);
--
-- Exemple 7 - Fenêtre nommée complétée.
SELECT
  nom,
  code_departement AS departement,
  date_naissance AS naissance,
  RANK() OVER (w ORDER BY date_naissance ASC) rang1,
  salaire,
  RANK() OVER (w ORDER BY salaire DESC) rang2
FROM
  formateurs
WHERE
  salaire >= 21000
WINDOW w AS
  (PARTITION BY code_departement)
ORDER BY
  code_departement,
  nom;


-- 3.6 Accès à d'autres lignes que la ligne courante
--
-- LAG et LEAD.
SELECT
  nom,
  code_departement,
  salaire,
  LAG(salaire) OVER w precedent,
  LEAD(salaire) OVER w suivant
FROM
  formateurs
WHERE
  salaire >= 21000
WINDOW w AS
  (PARTITION BY code_departement ORDER BY salaire)
ORDER BY
  code_departement,
  salaire;
--
-- LAG et LEAD avec paramètres supplémentaires.
SELECT
  nom,
  salaire,
  LAG(salaire) OVER w avant_1,
  LAG(salaire,1,0) OVER w avant_1_bis,
  LAG(salaire,2,0) OVER w avant_2
FROM
  formateurs
WHERE
  code_departement = '92'
WINDOW w AS 
  (ORDER BY salaire);
--
-- FIRST_VALUE et LAST_VALUE.
SELECT
  nom,
  salaire,
  date_naissance,
  FIRST_VALUE(salaire) OVER w premier,
  LAST_VALUE(salaire) OVER w dernier
FROM
  formateurs
WINDOW w AS
  (ORDER BY date_naissance 
   RANGE BETWEEN INTERVAL 1 YEAR PRECEDING 
             AND INTERVAL 1 YEAR FOLLOWING);


-- 4.	Réunir le résultat de plusieurs requêtes
--
-- UNION
SELECT titre FROM catalogue
  UNION
SELECT IFNULL(CONCAT(titre,' - ',sous_titre),titre)
FROM livre WHERE id_collection = 1;
--
-- UNION ALL
SELECT titre FROM catalogue
  UNION ALL
SELECT IFNULL(CONCAT(titre,' - ',sous_titre),titre)
FROM livre WHERE id_collection = 1;
--
-- UNION + ORDER BY
SELECT titre FROM catalogue
  UNION
SELECT IFNULL(CONCAT(titre,' - ',sous_titre),titre)
FROM livre WHERE id_collection = 1
  ORDER BY titre;


-- 5.2.	Gérer les transactions
--
-- Exemple de transaction annulée
START TRANSACTION;
INSERT INTO commande(date_commande) VALUES(DATE(NOW()));
SET @id = LAST_INSERT_ID();
INSERT INTO ligne_commande
  (id_commande,numero_ligne,article,quantite,prix_unitaire)
VALUES
  (@id,1,'PHP 7',1,30);
ROLLBACK;
SELECT * FROM commande;
SELECT * FROM ligne_commande;
--
-- Exemple de transaction validée
START TRANSACTION;
INSERT INTO commande(date_commande) VALUES(DATE(NOW()));
SET @id = LAST_INSERT_ID();
INSERT INTO ligne_commande
  (id_commande,numero_ligne,article,quantite,prix_unitaire)
VALUES
  (@id,1,'PHP 7',1,30);
COMMIT;
SELECT * FROM commande;
SELECT * FROM ligne_commande;


-- 5.3.	Annuler une partie d'une transaction
--
START TRANSACTION;
INSERT INTO commande(date_commande) VALUES(DATE(NOW()));
SET @id = LAST_INSERT_ID();
INSERT INTO ligne_commande
  (id_commande,numero_ligne,article,quantite,prix_unitaire)
VALUES
  (@id,1,'MySQL 5',1,25);
SAVEPOINT p1;
INSERT INTO ligne_commande
  (id_commande,numero_ligne,article,quantite,prix_unitaire)
VALUES
  (@id,2,'MySQL 7',1,30);
ROLLBACK TO SAVEPOINT p1;
INSERT INTO ligne_commande
  (id_commande,numero_ligne,article,quantite,prix_unitaire)
VALUES
  (@id,2,'PHP 7',1,30);
COMMIT;
SELECT * FROM commande WHERE id = @id;
SELECT * FROM ligne_commande WHERE id_commande = @id;


-- 6.	Effectuer des recherches à l’aide des expressions régulières
-- 
-- Titres qui commencent par "php" suivi 
-- d'un espace et d'un numéro de version
-- sous la forme x.y.
SELECT titre FROM livre 
WHERE REGEXP_LIKE(titre,'^php [1-9]\.[0-9]');
--
-- La même chose avec l'ancienne fonction.
SELECT titre FROM livre 
WHERE titre REGEXP '^php [1-9]\.[0-9]';
--
-- Titres qui contiennent "mysql" et "php" 
-- dans n'importe quel ordre.
SELECT titre FROM livre  
WHERE REGEXP_LIKE(titre,'((mysql).*(php))|((php).*(mysql))');
--
-- Titres qui contiennent un chiffre.
SELECT titre FROM livre WHERE REGEXP_LIKE(titre,'[[:digit:]]');
--
-- Extraire la mention à MySQL dans les titres qui parlent de MySQL.
SELECT DISTINCT REGEXP_SUBSTR(titre,'mysql( [1-9](\.[0-9])?)?') titre
FROM livre WHERE titre LIKE '%mysql%'; -- LIKE classique
--
-- Remplacer la version dans les titres qui parlent d'Oracle.
SELECT
  titre ancien,
  REGEXP_REPLACE(titre,'[1-9]{2}[gc]','19c') nouveau
FROM livre WHERE titre LIKE '%Oracle%'; 


-- 7.2.	Création de l'index FULLTEXT
--
CREATE FULLTEXT INDEX ix_texte ON livre(titre,sous_titre,description);
SHOW WARNINGS;


-- 7.3.1. Recherche classique (texte intégral)
--
SELECT CONCAT(titre,'\n  ',sous_titre) titre FROM livre
WHERE MATCH(titre,sous_titre,description) 
      AGAINST('mysql');
--
SELECT CONCAT(titre,'\n  ',sous_titre) titre FROM livre
WHERE MATCH(titre,sous_titre,description) 
      AGAINST('mysql php');
--
SELECT CONCAT(titre,'\n  ',sous_titre) titre FROM livre
WHERE MATCH(titre,sous_titre,description) 
      AGAINST('je veux développer des applications');


-- 7.3.2. Recherche en mode booléen (texte intégral)
--
-- MySQL et PHP.
SELECT CONCAT(titre,'\n  ',sous_titre) titre FROM livre
WHERE MATCH(titre,sous_titre,description) 
      AGAINST('+mysql +php' IN BOOLEAN MODE);
--
-- MySQL mais pas PHP.
SELECT CONCAT(titre,'\n  ',sous_titre) titre FROM livre
WHERE MATCH(titre,sous_titre,description) 
      AGAINST('+mysql -php' IN BOOLEAN MODE);
--
-- Administration de MySQL ou d'Oracle.
SELECT CONCAT(titre,'\n  ',sous_titre) titre FROM livre
WHERE MATCH(titre,sous_titre,description) 
      AGAINST('+administration +(oracle,mysql)' IN BOOLEAN MODE);


-- 7.3.2.	Recherche avec extension de requête (texte intégral)
--
-- Recherche "normale"
SELECT CONCAT(titre,'\n  ',sous_titre) titre FROM livre
WHERE MATCH(titre,sous_titre,description) 
      AGAINST('production');
--
-- WITH QUERY EXPANSION
SELECT CONCAT(titre,'\n  ',sous_titre) titre FROM livre
WHERE MATCH(titre,sous_titre,description) 
      AGAINST('production' WITH QUERY EXPANSION);


-- 8.3.	Gestion des programmes stockés
--
-- Exemples simples
delimiter //
-- Procédure stockée
DROP PROCEDURE IF EXISTS ps_creer_rubrique //
CREATE PROCEDURE ps_creer_rubrique
  (
  -- Titre de la nouvelle rubrique.
  IN p_titre VARCHAR(20),
  -- Identifiant de la rubrique parent.
  IN p_id_parent INT,
  -- Identifiant de la nouvelle rubrique.
  OUT p_id INT
  )
BEGIN
  /* 
  ** Insérer la nouvelle rubrique et
  ** récupérer l'identifiant affecté.
  */
  INSERT INTO rubrique (titre,id_parent)
  VALUES (p_titre,p_id_parent);
  SET p_id = LAST_INSERT_ID();
END;
//
-- Fonction stockée
DROP FUNCTION IF EXISTS fs_titre_long //
CREATE FUNCTION fs_titre_long
  (
  p_titre VARCHAR(100),
  p_sous_titre VARCHAR(100)
  )
  RETURNS VARCHAR(210)
  DETERMINISTIC 
BEGIN
  RETURN CONCAT(p_titre,' - ',p_sous_titre);
END;
//
delimiter ;


-- 8.4.	Exécuter un programme stocké
--
-- Procédure stockée
CALL ps_creer_rubrique('Système et réseau',NULL,@id);
SELECT * FROM rubrique WHERE id = @id;
--
-- Fonction stockée
SELECT fs_titre_long(titre,sous_titre) FROM livre LIMIT 1;


-- 8.5.3.	Intégration d'ordres SQL
--
delimiter //
DROP PROCEDURE IF EXISTS ps_creer_rubrique //
CREATE PROCEDURE ps_creer_rubrique
  (
  -- Titre de la nouvelle rubrique.
  IN p_titre VARCHAR(20),
  -- Titre de la rubrique parent.
  IN p_titre_parent VARCHAR(20),
  -- Identifiant de la nouvelle rubrique.
  OUT p_id INT
  )
BEGIN
  -- Identifiant de la rubrique parent.
  DECLARE v_id_parent INT;
  -- Lire l'identifiant de la rubrique parent.
  SELECT id INTO v_id_parent 
  FROM rubrique WHERE titre = p_titre_parent;
  -- Insérer la nouvelle rubrique.
  INSERT INTO rubrique (titre,id_parent)
  VALUES (p_titre,v_id_parent);
  -- Lire l'identifiant de la nouvelle rubrique.
  SET p_id = LAST_INSERT_ID();
END;
//
delimiter ;


-- 8.5.4.	Les structures de contrôle
--
-- IF
delimiter //
DROP PROCEDURE IF EXISTS ps_calculer_frais_collection //
CREATE PROCEDURE ps_calculer_frais_collection(p_id INT)
BEGIN
  -- Prix de la collection.
  DECLARE v_prix_ht INT;
  -- Frais de la collection.
  DECLARE v_frais_ht INT;
  -- Lire le prix de la collection.
  SELECT prix_ht INTO v_prix_ht 
  FROM collection WHERE id = p_id;
  -- Calculer les frais de la collection.
  IF v_prix_ht <= 15
  THEN
    SET v_frais_ht = 1;
  ELSEIF v_prix_ht <= 40
  THEN
    SET v_frais_ht = 1.5;
  ELSE
    SET v_frais_ht = 2;
  END IF;
  -- Metter à jour les frais dans la table.
  UPDATE collection 
  SET frais_ht = v_frais_ht 
  WHERE id = p_id;
END;
//
delimiter ;
--
-- CASE
delimiter //
DROP PROCEDURE IF EXISTS ps_calculer_frais_collection //
CREATE PROCEDURE ps_calculer_frais_collection(p_id INT)
BEGIN
  -- Prix de la collection.
  DECLARE v_prix_ht INT;
  -- Frais de la collection.
  DECLARE v_frais_ht INT;
  -- Lire le prix de la collection.
  SELECT prix_ht INTO v_prix_ht 
  FROM collection WHERE id = p_id;
  -- Calculer les frais de la collection.
  CASE 
    WHEN v_prix_ht <= 15
    THEN
      SET v_frais_ht = 1;
    WHEN v_prix_ht <= 40
    THEN
      SET v_frais_ht = 1.5;
    ELSE
      SET v_frais_ht = 2;
  END CASE;
  -- Metter à jour les frais dans la table.
  UPDATE collection 
  SET frais_ht = v_frais_ht 
  WHERE id = p_id;
END;
//
delimiter ;
--
-- LOOP
delimiter //
DROP PROCEDURE IF EXISTS ps_test //
CREATE PROCEDURE ps_test()
BEGIN
  DECLARE v_indice INT DEFAULT 0;
  boucle: LOOP
    SET v_indice = v_indice + 1;
    IF v_indice = 10
    THEN
      LEAVE boucle;
    END IF;
  END LOOP boucle;
  SELECT v_indice;
END;
//
delimiter ;
--
-- REPEAT
delimiter //
DROP PROCEDURE IF EXISTS ps_test //
CREATE PROCEDURE ps_test()
BEGIN
  DECLARE v_indice INT DEFAULT 0;
  REPEAT
    SET v_indice = v_indice + 1;
  UNTIL v_indice = 10
  END REPEAT;
  SELECT v_indice;
END;
//
delimiter ;
--
-- WHILE
delimiter //
DROP PROCEDURE IF EXISTS ps_test //
CREATE PROCEDURE ps_test()
BEGIN
  DECLARE v_indice INT DEFAULT 0;
  WHILE v_indice < 10 DO
    SET v_indice = v_indice + 1;
  END WHILE;
  SELECT v_indice;
END;
//
delimiter ;


-- 8.5.5.	La gestion des erreurs
--
delimiter //
DROP PROCEDURE IF EXISTS ps_creer_rubrique //
CREATE PROCEDURE ps_creer_rubrique
  (
  -- Titre de la nouvelle rubrique.
  IN p_titre VARCHAR(20),
  -- Titre de la rubrique parent.
  IN p_titre_parent VARCHAR(20),
  -- Identifiant de la nouvelle rubrique.
  OUT p_id INT
  )
BEGIN
  -- Identifiant de la rubrique parent.
  DECLARE v_id_parent INT;
  -- Indicateur d'existence de la rubrique parent.
  DECLARE v_parent_existe BOOLEAN;
  -- Lire l'identifiant de la rubrique parent
  -- (si le titre de la rubrique parent passé en 
  -- paramètre est non vide).
  IF p_titre_parent IS NOT NULL
  THEN
    -- Utiliser un bloc imbriqué avec un 
    -- gestionnaire d'erreur.
    -- Si le parent n'est pas trouvé, positionner
    -- l'indicateur à FALSE et quitter le sous-bloc.
    BEGIN
      DECLARE EXIT HANDLER FOR NOT FOUND 
      SET v_parent_existe = FALSE;
      SELECT id INTO v_id_parent 
      FROM rubrique WHERE titre = p_titre_parent;
      SET v_parent_existe = TRUE; -- c'est bon !
    END;
  ELSE
    -- Pas de rubrique parent passé en paramètre.
    -- Considérer que le parent existe.
    SET v_parent_existe = TRUE;
  END IF;
  -- Si le parent existe
  IF v_parent_existe
  THEN
    -- Insérer la nouvelle rubrique.
    INSERT INTO rubrique (titre,id_parent)
    VALUES (p_titre,v_id_parent);
    -- Lire l'identifiant de la nouvelle rubrique.
    SET p_id = LAST_INSERT_ID();
  ELSE
    -- La rubrique parent n'existe pas, retourner -1.
    SET p_id = -1;
  END IF;
END;
//
delimiter ;
--
-- Tester
--
-- Créer une rubrique parent.
CALL ps_creer_rubrique('Bureautique',NULL,@id);
SELECT * FROM rubrique WHERE id = @id;
--
-- Créer une sous-rubrique de la rubrique "Bureautique".
CALL ps_creer_rubrique('Tableur','Bureautique',@id);
SELECT * FROM rubrique WHERE id = @id;
--
-- Créer une sous-rubrique pour une rubrique parent
-- qui n'existe pas.
CALL ps_creer_rubrique('Suite','Burotik',@id);
SELECT @id;
--
-- GET DIAGNOSTICS
delimiter //
DROP PROCEDURE IF EXISTS ps_creer_collection //
CREATE PROCEDURE ps_creer_collection
  (
  -- Nom de la collection.
  IN p_nom VARCHAR(25),
  -- Prix H.T. des livres de la collection.
  IN p_prix_ht DECIMAL(5,2),
  -- Message d'erreur éventuel.
  OUT p_message TEXT
  )
BEGIN
  -- Définir un gestionnaire d'erreur.
  DECLARE EXIT HANDLER FOR SQLEXCEPTION
  BEGIN
    -- Nombre d'erreurs.
    DECLARE v_nombre_erreurs INT;
    -- Code d'erreur SQL.
    DECLARE v_code_erreur_sql CHAR(5);
    -- Numéro d'erreur MySQL.
    DECLARE v_numero_erreur_mysql INT;
    -- Message d'erreur.
    DECLARE v_message_erreur TEXT;
    -- Récupérer le nombre d'erreur.
    GET STACKED DIAGNOSTICS v_nombre_erreurs = NUMBER;
    -- Récupérer les informations sur la dernière erreur.
    GET STACKED DIAGNOSTICS CONDITION v_nombre_erreurs
      v_code_erreur_sql = RETURNED_SQLSTATE, 
      v_numero_erreur_mysql = MYSQL_ERRNO, 
      v_message_erreur = MESSAGE_TEXT;
    -- Construire le message de retour.
    SET p_message = 
      CONCAT('ERREUR ',v_numero_erreur_mysql,
             ' (',v_code_erreur_sql,') : ',v_message_erreur);
  END;
  -- Effectuer l'insertion.
  INSERT INTO collection(nom,prix_ht)
  VALUES (p_nom,p_prix_ht);
END;
//
delimiter ;
--
-- Tester
CALL ps_creer_collection('TechNote',12,@message);
SELECT @message;
--
-- SIGNAL
delimiter //
DROP PROCEDURE IF EXISTS ps_creer_collection //
CREATE PROCEDURE ps_creer_collection
   (
   -- Nom de la collection.
   IN p_nom VARCHAR(25),
   -- Prix H.T. des livres de la collection.
   IN p_prix_ht DECIMAL(5,2),
   -- Frais H.T. des livres de la collection.
   IN p_frais_ht DECIMAL(5,2)
   )
 BEGIN
   -- Déclarer une condition d'erreur.
   DECLARE e_frais_trop_chers CONDITION FOR SQLSTATE '99002';
   -- Tester les paramètres.
   IF COALESCE(p_prix_ht,0) <= 0 OR COALESCE(p_frais_ht,0) <= 0
   THEN
     SIGNAL SQLSTATE '99001' -- définition directe du code d'erreur
       SET MESSAGE_TEXT = 'Les montants doivent être strictement positifs.';
   ELSEIF p_frais_ht > p_prix_ht * 0.1
   THEN
     SIGNAL e_frais_trop_chers -- utilisation de la condition d'erreur
       SET MESSAGE_TEXT = 'Les frais sont trop élevés.';
   END IF; 
   -- Effectuer l'insertion.
   INSERT INTO collection(nom,prix_ht,frais_ht)
   VALUES (p_nom,p_prix_ht,p_frais_ht);
 END;
 //
delimiter ;
--
-- Tester
CALL ps_creer_collection('Top Micro',10,-1);
CALL ps_creer_collection('Top Micro',10,5);
--
-- RESIGNAL
-- Création d'une table utilisée comme journal des erreurs.
DROP TABLE IF EXISTS journal_erreur;
CREATE TABLE journal_erreur
  (
  quand TIMESTAMP(3) DEFAULT CURRENT_TIMESTAMP(3),
  qui VARCHAR(100),
  contexte VARCHAR(100),
  code_erreur_sql CHAR(5),
  numero_erreur_mysql INT,
  message_erreur TEXT
  );
-- Création de la procédure.
delimiter //
DROP PROCEDURE IF EXISTS ps_creer_collection //
CREATE PROCEDURE ps_creer_collection
  (
  -- Nom de la collection.
  IN p_nom VARCHAR(25),
  -- Prix H.T. des livres de la collection.
  IN p_prix_ht DECIMAL(5,2)
  )
BEGIN
  -- Définir un gestionnaire d'erreur.
  DECLARE EXIT HANDLER FOR SQLEXCEPTION
  BEGIN
    -- Nombre d'erreurs.
    DECLARE v_nombre_erreurs INT;
    -- Code d'erreur SQL.
    DECLARE v_code_erreur_sql CHAR(5);
    -- Numéro d'erreur MySQL.
    DECLARE v_numero_erreur_mysql INT;
    -- Message d'erreur.
    DECLARE v_message_erreur TEXT;
    -- Récupérer le nombre d'erreur.
    GET STACKED DIAGNOSTICS v_nombre_erreurs = NUMBER;
    -- Récupérer les informations sur la dernière erreur.
    GET STACKED DIAGNOSTICS CONDITION v_nombre_erreurs
      v_code_erreur_sql = RETURNED_SQLSTATE, 
      v_numero_erreur_mysql = MYSQL_ERRNO, 
      v_message_erreur = MESSAGE_TEXT;
    -- Insérer une ligne dans le journal des erreurs.
    INSERT INTO journal_erreur
      (qui,contexte,
       code_erreur_sql,numero_erreur_mysql,message_erreur)
    VALUES
      (USER(),'ps_creer_collection',
       v_code_erreur_sql,v_numero_erreur_mysql,v_message_erreur);
    -- Propager l'erreur d'origine.
    RESIGNAL;
  END;
  -- Effectuer l'insertion.
  INSERT INTO collection(nom,prix_ht)
  VALUES (p_nom,p_prix_ht);
END;
//
delimiter ;
--
-- Tester
CALL ps_creer_collection('TechNote',12);
SELECT * FROM journal_erreur;


-- 8.5.6.	Les curseurs
--
delimiter //
DROP FUNCTION IF EXISTS fs_rubriques_livre //
CREATE FUNCTION fs_rubriques_livre
  (
  p_id_livre INT -- identifiant d'un livre
  )
  RETURNS TEXT
  READS SQL DATA
BEGIN
  -- Titre d'une rubrique.
  DECLARE v_titre VARCHAR(20);
  -- Résultat de la fonction.
  DECLARE v_resultat TEXT DEFAULT '';
  -- Indicateur de fin de parcours du curseur.
  DECLARE v_fin BOOLEAN DEFAULT FALSE;
  -- Curseur qui sélectionne les rubriques (parents)
  -- d'un livre.
  DECLARE cur_rubriques CURSOR FOR
  SELECT
    rub.titre 
  FROM
    rubrique rub -- rubrique parent
      JOIN
    rubrique sru -- sous-rubrique
      ON (rub.id = sru.id_parent)
      JOIN
    rubrique_livre rul -- (sous-)rubrique d'un livre
      ON (sru.id = rul.id_rubrique)
  WHERE rul.id_livre = p_id_livre;
  -- Gestionnaire de détection de la fin du curseur.
  DECLARE CONTINUE HANDLER FOR NOT FOUND SET v_fin = TRUE;
  -- Ouvrir le curseur.
  OPEN cur_rubriques;
  -- Boucle permettant de parcourir le résultat du curseur.
  curseur: LOOP
    -- Lire la ligne courante du curseur.
    FETCH cur_rubriques INTO v_titre;
    -- Quitter la boucle si tout a été lu.
    IF v_fin
    THEN
      LEAVE curseur;
    END IF;
    -- Ajouter la rubrique dans la liste.
    SET v_resultat = CONCAT(v_resultat,',',v_titre);
  END LOOP curseur;
  -- Fermer le curseur.
  CLOSE cur_rubriques;
  -- Retourner le résultat (enlever la virgule de tête).
  RETURN TRIM(',' FROM v_resultat);
END;
//
delimiter ;
--
-- Test de la fonction.
SELECT titre,fs_rubriques_livre(id) rubriques
FROM livre LIMIT 1 ;


-- 9.2.	Gestion des triggers
--
delimiter //
DROP TRIGGER IF EXISTS tr_calculer_frais_collection //
CREATE TRIGGER tr_calculer_frais_collection
  BEFORE INSERT ON collection
  FOR EACH ROW 
BEGIN
  -- Calculer les frais de la collection s'ils sont
  -- vides ou égaux à zéro.
  IF IFNULL(NEW.frais_ht,0) = 0
  THEN
    CASE 
      WHEN NEW.prix_ht <= 15
      THEN
        SET NEW.frais_ht = 1;
      WHEN NEW.prix_ht <= 40
      THEN
        SET NEW.frais_ht = 1.5;
      ELSE
        SET NEW.frais_ht = 2;
    END CASE;
  END IF;
END;
//
delimiter ;
--
-- Test du trigger.
INSERT INTO collection(nom,prix_ht)
VALUES('Coffret Expert',73.93);
SELECT nom,prix_ht,frais_ht FROM collection 
WHERE id = LAST_INSERT_ID();
