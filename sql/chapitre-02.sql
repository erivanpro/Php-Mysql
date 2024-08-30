/*
** Exemples du chapitre 2
*/


-- 5.2. Obtenir des informations
--
SHOW DATABASES;
USE eni;
SHOW TABLES;
DESCRIBE collection;


-- 5.3.	Afficher les erreurs et les alertes
--
SELECT 1/0;
SHOW WARNINGS;


-- 5.4.1.	Syntaxe de base de l'ordre SELECT
--
-- SELECT FROM
SELECT * FROM collection;
SELECT id,nom FROM collection;
SELECT nom,prix_ht+ROUND(prix_ht*5.5/100,2) FROM collection;
--
-- Clause DISTINCT
SELECT annee_parution FROM livre;
SELECT DISTINCT annee_parution FROM livre;
SELECT annee_parution,niveau FROM livre;
SELECT DISTINCT annee_parution,niveau FROM livre;
--
-- Alias de colonne
SELECT nom,prix_ht+ROUND(prix_ht*5.5/100,2) prix_ttc
FROM collection; 
--
-- Alias de table
SELECT col.nom FROM collection col;
SELECT id FROM livre,collection;


-- 5.4.2.	Restreindre le résultat : clause WHERE
--
-- Opérateurs usuels 
SELECT nom FROM collection WHERE id = 1;
SELECT id,nom FROM collection WHERE id <> 1;
SELECT id,nom FROM collection WHERE id IN (1,2);
SELECT nom,prix_ht FROM collection WHERE prix_ht < 25;
SELECT nom,prix_ht FROM collection 
WHERE prix_ht BETWEEN 25 AND 30;
SELECT prix_ht FROM collection WHERE nom = 'TECHNOTE';
--
-- Recherche sensible à la casse
SELECT prix_ht FROM collection WHERE nom = BINARY 'TECHNOTE';
--
-- Recherche sur un couple de colonnes
SELECT titre FROM livre
WHERE (niveau,annee_parution) = ('Initié',2015);
--
-- Recherche sur une date comportant une composante horaire
SELECT titre FROM livre WHERE date_maj = '2016-04-01';
SELECT titre FROM livre WHERE DATE(date_maj) = '2016-04-01';
SELECT titre FROM livre
WHERE date_maj BETWEEN
          '2016-04-01 00:00:00' AND '2016-04-01 23:59:59';
--
-- Recherche des valeurs NULL 
SELECT nom FROM collection WHERE frais_ht = NULL;
SELECT nom FROM collection WHERE frais_ht IS NULL;
SELECT nom FROM collection WHERE frais_ht IS NOT NULL;
--
-- Attention à la valeur NULL dans la liste d'une requête NOT IN  
SELECT nom,frais_ht FROM collection 
WHERE frais_ht NOT IN (NULL,1.25,1.5);
SELECT nom,frais_ht FROM collection 
WHERE frais_ht NOT IN (1.25,1.5) OR frais_ht IS NULL;
--
-- LIKE
SELECT DISTINCT titre FROM livre WHERE titre LIKE 'PHP%';
SELECT DISTINCT titre FROM livre
WHERE titre LIKE 'PHP%MySQL%';
--
-- AND/OR
SELECT titre FROM livre
WHERE annee_parution = 2016 AND id_collection = 1;
SELECT titre,annee_parution FROM livre
WHERE (annee_parution = 2016 OR annee_parution = 2015)
      AND id_collection = 1;


-- 5.4.3.	Trier le résultat : clause ORDER BY
--
-- Colonne
SELECT nom,prix_ht+ROUND(prix_ht*5.5/100,2)
FROM collection
ORDER BY nom;
-- Expression
SELECT nom,prix_ht+ROUND(prix_ht*5.5/100,2)
FROM collection
ORDER BY prix_ht+ROUND(prix_ht*5.5/100,2);
--
-- Alias de colonne
SELECT nom,prix_ht+ROUND(prix_ht*5.5/100,2) prix_ttc
FROM collection
ORDER BY prix_ttc DESC;
--
-- 2 niveaux
SELECT id_parent,titre
FROM rubrique
ORDER BY id_parent,titre;


-- 5.4.4.	Limiter le nombre de lignes : clause LIMIT
--
-- Afficher les trois plus "gros" livres (en nombre de pages)
SELECT titre,nombre_pages
FROM livre
ORDER BY nombre_pages DESC
LIMIT 3;
--
-- Afficher les deux suivants
SELECT titre,nombre_pages
FROM livre
ORDER BY nombre_pages DESC
LIMIT 3,2;


-- 5.4.5.	Lire dans plusieurs tables : jointure
--
-- Jointure interne avec 2 tables : première syntaxe
SELECT col.nom,liv.titre
FROM collection col,livre liv
WHERE col.id = liv.id_collection
      AND liv.annee_parution=2018;
--
-- Jointure interne avec 2 tables  : deuxième syntaxe
SELECT col.nom,liv.titre
FROM collection col JOIN livre liv
     ON (col.id = liv.id_collection)
WHERE liv.annee_parution=2018;
--
-- Jointure interne avec 3 tables : première syntaxe
SELECT
   liv.id,
   liv.titre,
   aut.nom
FROM
   livre liv,
   auteur_livre aul,
   auteur aut
WHERE
   liv.id = aul.id_livre
   AND aul.id_auteur = aut.id
   AND liv.annee_parution >= 2018
ORDER BY
   liv.titre;
--
-- Jointure interne avec 3 tables : deuxième syntaxe
SELECT
   liv.id,
   liv.titre,
   aut.nom
FROM
   livre liv
      JOIN
   auteur_livre aul
      ON (liv.id = aul.id_livre)
      JOIN
   auteur aut
      ON (aul.id_auteur = aut.id)
WHERE
   liv.annee_parution >= 2018
ORDER BY
   liv.titre;
--
-- Jointure externe : description du problème
SELECT titre,id_promotion FROM livre
WHERE annee_parution >= 2018;
SELECT liv.titre,pro.intitule
FROM livre liv JOIN promotion pro 
     ON (liv.id_promotion = pro.id)
WHERE liv.annee_parution >= 2018;
--
-- Jointure externe : solution
SELECT liv.titre,pro.intitule
FROM livre liv LEFT JOIN promotion pro 
     ON (liv.id_promotion = pro.id)
WHERE liv.annee_parution >= 2018;
--
-- Jointure externe : condition sur la table externe
SELECT liv.titre,pro.intitule
FROM livre liv LEFT JOIN promotion pro
     ON (liv.id_promotion = pro.id)
WHERE liv.annee_parution >= 2018
      AND pro.est_active = TRUE;
SELECT liv.titre,pro.intitule
FROM livre liv LEFT JOIN promotion pro
     ON (liv.id_promotion = pro.id
         AND pro.est_active = TRUE)
WHERE liv.annee_parution >= 2018;
--
-- Auto-jointure
SELECT par.titre rubrique,enf.titre sous_rubrique
FROM rubrique par,rubrique enf
WHERE enf.id_parent = par.id;


-- 5.5.	Ajouter des lignes dans une table
-- 
-- Premiers exemples
DESCRIBE collection;
INSERT INTO collection
VALUES(6,'Solutions Informatiques',36.97,1.25);
INSERT INTO collection(nom)
VALUES('ExpertIT');
SELECT * FROM collection WHERE id >= 6;
--
-- Mode SQL et valeurs par défaut 
SELECT @@sql_mode; 
INSERT INTO collection()  -- un peu bizarre comme INSERT
VALUES();                 -- mais c'est pour tester !
SET @ancien_sql_mode=@@sql_mode;  -- sauvegarder le mode actuel
SET @@sql_mode=''; -- modifier le mode SQL
INSERT INTO collection()
VALUES();
SHOW WARNINGS;
SELECT nom,prix_ht FROM collection 
WHERE id = last_insert_id();
SET @@sql_mode=@ancien_sql_mode; -- remettre le mode SQL initial
--
-- Mode SQL et valeurs invalides 
SELECT @@sql_mode; -- afficher le mode SQL
INSERT INTO collection(nom,prix_ht)
VALUES('Coffret Technique Certification',1234);
SET @ancien_sql_mode=@@sql_mode;  -- sauvegarder le mode actuel
SET @@sql_mode=''; -- modifier le mode SQL
INSERT INTO collection(nom,prix_ht)
VALUES('Coffret Technique Certification',1234);
SHOW WARNINGS;
SELECT nom,prix_ht FROM collection 
WHERE id = last_insert_id();
SET @@sql_mode=@ancien_sql_mode; -- remettre le mode SQL initial
--
-- Clause IGNORE
INSERT INTO collection(id,nom,prix_ht)
VALUES(1,'Coffret Epsilon',102.37);
INSERT IGNORE INTO collection(id,nom,prix_ht)
VALUES(1,'Coffret Epsilon',102.37);
SHOW WARNINGS;
SELECT nom FROM collection WHERE id = 1;
--
-- Clause ON DUPLICATE KEY UPDATE
INSERT INTO auteur(nom,prenom,mail)
VALUES('HEURTEL','Olivier','contact@olivier-heurtel.fr');
INSERT INTO auteur(nom,prenom,mail)
VALUES('HEURTEL','Olivier','contact@olivier-heurtel.fr')
ON DUPLICATE KEY UPDATE mail = VALUES(mail);
SELECT mail FROM auteur WHERE nom = 'HEURTEL';
--
-- Insertion de plusieurs lignes
CREATE TABLE test_trans(valeur INT PRIMARY KEY)
ENGINE InnoDB; -- moteur transactionnel
CREATE TABLE test_non_trans(valeur INT PRIMARY KEY)
ENGINE MyISAM; -- moteur non transactionnel
INSERT INTO test_trans VALUES(2);
INSERT INTO test_non_trans VALUES(2);
INSERT INTO test_trans
VALUES
   (1),
   (2), -- existe déjà !!
   (3);
INSERT INTO test_non_trans
VALUES
   (1),
   (2), -- existe déjà !!
   (3);
SELECT * FROM test_trans;
SELECT * FROM test_non_trans;
DROP TABLE test_trans;
DROP TABLE test_non_trans;


-- 5.6.	Modifier des lignes dans une table
--
-- Premiers exemples
UPDATE auteur SET mail = 'olivier.heurtel@gmail.com'
WHERE nom = 'HEURTEL' AND prenom = 'Olivier';
UPDATE collection SET nom = 'Coffret Epsilon',prix_ht=102.37 
WHERE nom = '';
UPDATE collection
SET prix_ht = ROUND(prix_ht*1.015,2) -- augmentation de 1,5%
WHERE nom = 'Coffret Epsilon';
UPDATE livre SET niveau='Confirmé' WHERE id_collection = 2;
--
-- Nombre de lignes trouvées/modifiées
UPDATE livre SET id_promotion=2 WHERE id_collection=1;
--
-- Valeur invalide
SELECT @@sql_mode; -- afficher le mode SQL
UPDATE collection SET prix_ht = 5200 WHERE nom = 'Coffret Epsilon';
SET @ancien_sql_mode=@@sql_mode;  -- sauvegarder le mode actuel
SET @@sql_mode=''; -- modifier le mode SQL
UPDATE collection SET prix_ht = 5200 WHERE nom = 'Coffret Epsilon';
SHOW WARNINGS;
SELECT prix_ht FROM collection WHERE nom = 'Coffret Epsilon';
SET @@sql_mode=@ancien_sql_mode; -- remettre le mode SQL initial
--
-- Clauses ORDER BY et LIMIT
SELECT nom,prix_ht FROM collection ORDER BY prix_ht LIMIT 1;
UPDATE collection SET prix_ht = prix_ht + 0.50 
ORDER BY prix_ht LIMIT 1;
SELECT nom,prix_ht FROM collection ORDER BY prix_ht LIMIT 1;
--
-- Clause IGNORE
UPDATE collection SET nom = 'TechNote' WHERE id = 1;
UPDATE IGNORE collection SET nom = 'TechNote' WHERE id = 1;
SELECT nom FROM collection WHERE id = 1;
--
-- Mise à jour dans plusieurs tables jointes
SELECT col.nom,col.prix_ht,liv.isbn,liv.id_promotion
FROM livre liv JOIN collection col 
     ON (liv.id_collection = col.id)
WHERE
   col.nom NOT LIKE '%informatiques%';
UPDATE
   livre liv JOIN collection col 
   ON (liv.id_collection = col.id)
SET
   -- augmenter le prix de la collection
   col.prix_ht = col.prix_ht + 0.47, 
   -- mettre les livres (de la collection) en promotion
   liv.id_promotion = 3 
WHERE
   col.nom NOT LIKE '%informatiques%'
   AND liv.id_promotion IS NULL; -- pas déjà en promotion
SELECT col.nom,col.prix_ht,liv.isbn,liv.id_promotion
FROM livre liv JOIN collection col
     ON (liv.id_collection = col.id)
WHERE
   col.nom NOT LIKE '%informatiques%';


-- 5.7.	Supprimer des lignes dans une table
-- 
-- Premiers exemples
DELETE FROM promotion WHERE id = 4;
DELETE FROM collection WHERE prix_ht = 999.99;
--
-- Clauses ORDER BY et LIMIT
SELECT id,nom FROM collection ORDER BY id DESC LIMIT 1;
DELETE FROM collection ORDER BY id DESC LIMIT 1;
SELECT id,nom FROM collection ORDER BY id DESC LIMIT 1;
--
-- Suppression dans plusieurs tables jointes
SELECT id,isbn FROM livre WHERE id = 3;
SELECT * FROM rubrique_livre WHERE id_livre = 3;
SELECT * FROM auteur_livre WHERE id_livre = 3;
DELETE FROM
   liv,rul,aul -- alias définis dans la clause USING
USING
   livre liv,rubrique_livre rul,auteur_livre aul
WHERE
   liv.id = rul.id_livre
   AND liv.id = aul.id_livre
   AND liv.isbn = '2-7460-3104-3';
SELECT id,isbn FROM livre WHERE id = 3;
SELECT * FROM rubrique_livre WHERE id_livre = 3;
SELECT * FROM auteur_livre WHERE id_livre = 3;


-- 5.8.2.	Exporter des données
--
-- Utilisation des clauses par défaut
SELECT liv.isbn,liv.annee_parution,pro.intitule 
FROM livre liv LEFT JOIN promotion pro 
     ON liv.id_promotion = pro.id
INTO OUTFILE '/tmp/liste-livre-1.txt';
--
-- Spécification de certaines clauses
SELECT liv.isbn,liv.annee_parution,pro.intitule 
FROM livre liv LEFT JOIN promotion pro 
     ON liv.id_promotion = pro.id
INTO OUTFILE '/tmp/liste-livre-2.txt '
FIELDS TERMINATED BY '|' 
       OPTIONALLY ENCLOSED BY '"'
LINES STARTING BY '->';

-- 5.8.3.	Importer des données
--
-- Cet exemple suppose que le fichier "catalogue.txt" est présent
-- dans le répertoire "/tmp".
LOAD DATA INFILE '/tmp/catalogue.txt' INTO TABLE catalogue
FIELDS TERMINATED BY '|' -- séparateur de champ
LINES TERMINATED BY '\n'
IGNORE 1 LINES -- ignorer la ligne de titre
(titre,code,@prix_ht) -- charger le prix HT dans une variable
-- calculer le prix TTC stocké dans la table 
-- à partir du prix HT
SET prix_ttc = @prix_ht+ROUND(@prix_ht*5.5/100,2);
SELECT * FROM catalogue;

