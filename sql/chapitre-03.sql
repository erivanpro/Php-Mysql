/*
** Exemples du chapitre 3
*/


-- 2.	Fonctions de contrôle
--
-- IF
SELECT 
  titre,
  annee_parution,
  IF(annee_parution < 2013,'Ancien','Récent') age
FROM livre 
WHERE id_collection = 1;
-- 
-- IFNULL
SELECT 
	nom,prix_ht,frais_ht,prix_ht+frais_ht total_ht
FROM collection;
SELECT 
	nom,prix_ht,frais_ht,prix_ht+IFNULL(frais_ht,0) total_ht
FROM collection;
--
-- CASE : syntaxe 1
SELECT 
  titre,
  nombre_pages,
  CASE
    WHEN nombre_pages < 400 
    THEN 1.5
    WHEN nombre_pages BETWEEN 400 AND 600 
    THEN 2
    ELSE 2.5
  END frais_envoi
FROM livre
WHERE id_collection IN (1,2,3)
ORDER BY nombre_pages;
--
-- CASE : syntaxe 2
SELECT 
  titre,
  annee_parution,
  CASE annee_parution
    WHEN 2018 THEN 'Très récent'
    WHEN 2016 THEN 'Récent'
    ELSE           'Ancien'
  END age
FROM livre
WHERE id_collection = 1;


-- 3.	Fonctions de comparaison
--
-- LEAST – GREATEST
-- Calcul du montant d'une remise de 5% plafonnée à 1.5
SELECT
  nom,
  prix_ht,
  LEAST(ROUND(prix_ht*5/100,2),1.5) remise
FROM collection;
-- Calcul du montant d'une remise de 5% avec un minimum de 1
SELECT
  nom,
  prix_ht,
  GREATEST(ROUND(prix_ht*5/100,2),1) remise
FROM collection;
--
-- COALESCE
SELECT
  nom,
  tel_bureau,
  tel_portable,
  tel_domicile,
  COALESCE(tel_bureau,tel_portable,tel_domicile) telephone
FROM
  auteur;


-- 4.	Fonctions numériques
-- 
-- CEIL
SELECT nom,prix_ht,CEIL(prix_ht) FROM collection;
--
-- DIV
SELECT 
  titre,nombre_pages,nombre_pages DIV 100 nb_cent_pages
FROM livre WHERE id_collection = 1;
--
-- FLOOR
SELECT nom,prix_ht,FLOOR(prix_ht) FROM collection;
--
-- MOD
SELECT 
  titre,nombre_pages,nombre_pages MOD 100 reste_pages
FROM livre WHERE id_collection = 1;
--
-- RAND
SELECT RAND(),RAND(),RAND();
SELECT nom FROM collection ORDER BY RAND() LIMIT 1;
--
-- ROUND
SELECT 
  nom,
  prix_ht,
  ROUND(prix_ht) r1,
  ROUND(prix_ht,1) r2,
  ROUND(prix_ht,-1) r3
FROM collection;
--
-- TRUNCATE
SELECT 
  nom,
  prix_ht,
  TRUNCATE(prix_ht,0) r1,
  TRUNCATE(prix_ht,1) r2,
  TRUNCATE(prix_ht,-1) r3
FROM collection;


-- 5.	Fonctions caractères
--
-- CONCAT – CONCAT_WS
SELECT CONCAT(prenom,' ',nom) FROM auteur;
SELECT CONCAT_WS(',',nom,prenom) FROM auteur;
--
-- INSTR
SELECT nom,INSTR(nom,'Informatique') FROM collection;
--
-- LEFT - RIGHT
SELECT nom,LEFT(nom,8),RIGHT(nom,8) FROM collection;
--
-- LENGTH
SELECT nom,LENGTH(nom) FROM collection;
--
-- LOWER – UPPER
SELECT LOWER(nom),UPPER(prenom) FROM auteur;
--
-- LPAD – RPAD
SELECT LPAD(nom,30,'.') FROM collection;
SELECT RPAD(nom,30,'.') FROM collection;
--
-- LTRIM – RTRIM – TRIM
SET @x='   abc   ';
SELECT
  CONCAT('|',@x,'|') x,
  CONCAT('|',LTRIM(@x),'|') "ltrim(x)",
  CONCAT('|',RTRIM(@x),'|') "rtrim(x)",
  CONCAT('|',TRIM(@x),'|') "trim(x)";
SET @x='***abc***';
SELECT
  @x x,
  TRIM(BOTH '*' FROM @x) "trim(x)";
--
-- REPEAT – SPACE
SELECT CONCAT(REPEAT('*',5),SPACE(5),REPEAT('*',5)) x;
--
-- REPLACE
SELECT nom,REPLACE(nom,'Informatiques','Techniques') nouveau
FROM collection WHERE nom LIKE '%informatiques%';
--
-- SUBSTRING – SUBSTR
SELECT
	nom,
  SUBSTR(nom,6),
  SUBSTR(nom,6,3)
FROM collection;
SELECT
	nom,
  SUBSTR(nom,-6),
  SUBSTR(nom,-6,3)
FROM collection;
--
-- SUBSTRING_INDEX
SET @x='/chemin/vers/fichier.txt';
SELECT SUBSTRING_INDEX(@x,'/',2);
SELECT SUBSTRING_INDEX(@x,'/',-1);


-- 6.	Fonctions dates
--
-- ADDDATE
SET @d='2019-01-01';
SELECT 
  @d,
  ADDDATE(@d,1) "+ 1 jour",
  ADDDATE(@d,INTERVAL 10 DAY)  "+ 10 jours",
  ADDDATE(@d,INTERVAL '1-3' YEAR_MONTH)  "+ 1 an et 3 mois";
--
-- CURDATE
SELECT CURDATE();
SELECT date_debut,date_fin FROM promotion WHERE id = 2;
UPDATE promotion
SET date_debut = CURDATE(),date_fin = ADDDATE(CURDATE(),7)
WHERE id = 2;
SELECT date_debut,date_fin FROM promotion WHERE id = 2;
--
-- CURTIME
SELECT CURTIME();
--
-- NOW - UTC_TIMESTAMP
SELECT NOW(),UTC_TIMESTAMP();
--
-- DATE
SELECT date_maj,DATE(date_maj) FROM livre WHERE id = 1;
--
-- DATEDIFF
SELECT DATEDIFF(date_fin,date_debut) 
FROM promotion WHERE id = 2;
--
-- DAYOFWEEK – DAYOFMONTH – DAYOFYEAR – WEEKDAY
SET @d='1966-08-26'; -- vendredi 26 août 
SELECT
  @d,
  DAYOFWEEK(@d),
  DAYOFMONTH(@d),
  DAYOFYEAR(@d)
  ; 
--
-- EXTRACT
SELECT
  NOW(),
  EXTRACT(DAY FROM NOW()) jour,
  EXTRACT(MONTH FROM NOW()) mois,
  EXTRACT(YEAR FROM NOW()) annee,
  EXTRACT(HOUR FROM NOW()) heure
  ; 
--
-- LASTDAY
SELECT
	LAST_DAY(NOW()),
	LAST_DAY(NOW()+INTERVAL 1 MONTH);
--
-- MONTH
SELECT CURRENT_DATE(),MONTH(CURRENT_DATE());
--
-- WEEKOFYEAR
SELECT CURRENT_DATE(),WEEKOFYEAR(CURRENT_DATE());
--
-- YEAR
SELECT CURRENT_DATE(),YEAR(CURRENT_DATE());


-- 7.	Fonctions de transtypage et de mise en forme
--
-- BINARY
-- Recherche non sensible à la casse
SELECT prix_ht FROM collection WHERE nom = 'TECHNOTE';
-- Recherche sensible à la casse
SELECT prix_ht FROM collection WHERE nom = BINARY 'TECHNOTE';
--
-- CAST
SELECT
  prix_ht,
  CAST(prix_ht AS SIGNED) entier,
  CAST(prix_ht AS CHAR) chaine
FROM
  collection;
--
-- DATE_FORMAT
SELECT
  NOW(),
  DATE_FORMAT(NOW(),'%d/%m/%Y %H:%i:%s') france,
  DATE_FORMAT(NOW(),GET_FORMAT(TIMESTAMP,'EUR')) europe;
--
-- FORMAT
SET @x=1234.567;
SELECT @x,FORMAT(@x,2);
--
-- STR_TO_DATE
SET @x='19690721-035620';
SELECT @x,STR_TO_DATE(@x,'%Y%m%d-%H%i%s');


-- 8.	Fonctions système
--
-- CURRENT_USER - USER
SELECT CURRENT_USER(),USER();
--
-- DATABASE - SCHEMA
SELECT DATABASE(),SCHEMA();
USE eni;
SELECT DATABASE(),SCHEMA();
--
-- FOUND_ROWS
SELECT nom FROM collection WHERE frais_ht IS NULL;
SELECT FOUND_ROWS();
--
-- LAST_INSERT_ID
INSERT INTO rubrique(titre) VALUES('Certification');
SELECT LAST_INSERT_ID();
--
-- ROW_COUNT
DELETE FROM catalogue_ancien;
SELECT ROW_COUNT();
--
-- VERSION
SELECT VERSION();


-- 9.	Fonctions de chiffrement et de compression
--
-- AES_ENCRYPT – AES_DECRYPT
UPDATE auteur 
SET mot_de_passe = AES_ENCRYPT('abc123','secretdefense')
WHERE id = 1;
SELECT mot_de_passe FROM auteur WHERE id = 1;
SELECT AES_DECRYPT(mot_de_passe,'secretdefense') 
FROM auteur WHERE id = 1;
--
-- COMPRESS – UNCOMPRESS
UPDATE auteur 
SET profil = COMPRESS('Une longue description ...')
WHERE id = 1;
SELECT profil FROM auteur WHERE id = 1;
SELECT UNCOMPRESS(profil) FROM auteur WHERE id = 1;
--
-- MD5 – SHA1 – SHA 
SELECT SHA1('Olivier Heurtel');
SELECT SHA2('Olivier Heurtel',256);


-- 10.	Fonctions d’agrégat
--
-- MIN - MAX
SELECT MIN(nombre_pages),MAX(nombre_pages)
FROM livre WHERE id_collection = 1;
--
-- SUM - AVG
SELECT frais_ht FROM collection;
SELECT SUM(frais_ht),AVG(frais_ht),AVG(IFNULL(frais_ht,0)) 
FROM collection;
--
-- COUNT
SELECT
  COUNT(*),
  COUNT(frais_ht),
  COUNT(DISTINCT frais_ht)
FROM collection;
