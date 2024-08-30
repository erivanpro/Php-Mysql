-- Création de la base de données.
DROP DATABASE IF EXISTS eni ;
CREATE DATABASE eni;
USE eni;

-- Création de la table RUBRIQUE.
CREATE TABLE rubrique
  (
  id INT PRIMARY KEY AUTO_INCREMENT,
  titre VARCHAR(20) NOT NULL,
  id_parent INT
  );
INSERT INTO rubrique
  (id,titre,id_parent)
VALUES
  (1,'Base de données',NULL),
  (2,'Développement',NULL),
  (3,'Internet',NULL),
  (4,'Open Source',NULL)
;
INSERT INTO rubrique
  (titre,id_parent)
VALUES
  ('MySQL',1),
  ('Oracle',1),
  ('Langages',2),
  ('Méthode',2),
  ('HTML - XML',3),
  ('Conception Web',3),
  ('Sécurité',3),
  ('Système',4),
  ('Langages',4),
  ('Base de données',4)
;

-- Création de la table COLLECTION.
CREATE TABLE collection
  (
  id INT PRIMARY KEY AUTO_INCREMENT,
  nom VARCHAR(25) NOT NULL UNIQUE,
  prix_ht DECIMAL(5,2) DEFAULT 20,
  frais_ht DECIMAL(5,2)
  );
INSERT INTO collection
  (nom,prix_ht,frais_ht)
VALUES
  ('Ressources Informatiques',28.48,1.5),
  ('TechNote',10.48,NULL),
  ('Les TP Informatiques',25.71,1.5),
  ('Coffret Technique',54.19,2),
  ('Epsilon',51.43,2)
;

-- Création de la table AUTEUR.
CREATE TABLE auteur
  (
  id INT PRIMARY KEY AUTO_INCREMENT,
  nom VARCHAR(40) NOT NULL,
  prenom VARCHAR(40) NOT NULL,
  mail VARCHAR(200),
  tel_bureau VARCHAR(10),
  tel_portable VARCHAR(10),
  tel_domicile VARCHAR(10),
  mot_de_passe BLOB,
  profil BLOB,
  UNIQUE (nom,prenom)
  );
INSERT INTO auteur
  (nom,prenom,mail,tel_bureau,tel_portable,tel_domicile)
VALUES
  ('HEURTEL','Olivier',NULL,NULL,'0687731346','0102030405'),
  ('COMBAUDON','Stéphane',NULL,'0203040506',NULL,NULL),
  ('DASINI','Olivier',NULL,'0203040506',NULL,NULL),
  ('SCETBON','Cyril',NULL,'0203040506',NULL,NULL),
  ('GUERIN','Brice-Arnaud',NULL,NULL,NULL,'0304050607'),
  ('HUMBLOT','Emmanuel',NULL,'0908070605',NULL,NULL),
  ('PETIBON','Thierry',NULL,NULL,NULL,NULL)
;

-- Création de la table PROMOTION.
CREATE TABLE promotion
  (
  id INT PRIMARY KEY AUTO_INCREMENT,
  intitule VARCHAR(40) NOT NULL,
  date_debut DATE,
  date_fin DATE,
  est_active BOOLEAN
  );
INSERT INTO promotion
  (intitule,date_debut,date_fin,est_active)
VALUES
  ('-5% sur cet ouvrage',CURDATE(),ADDDATE(CURDATE(),10),TRUE),
  ('Frais de port offerts sur cet ouvrage',NULL,NULL,FALSE),
  ('Un superbe marque-page en cadeau',NULL,NULL,FALSE),
  ('5% de remise sur un deuxième livre',NULL,NULL,FALSE)
;

-- Création de la table LIVRE.
CREATE TABLE livre
  (
  id INT PRIMARY KEY AUTO_INCREMENT,
  isbn VARCHAR(20),
  titre VARCHAR(100) NOT NULL,
  sous_titre VARCHAR(100),
  nombre_pages INT,
  annee_parution YEAR(4),
  niveau ENUM('Débutant','Initié','Confirmé','Expert'),
  id_collection INT,
  id_promotion INT,
  description TEXT,
  couverture BLOB,
  date_maj TIMESTAMP
  );
INSERT INTO livre
  (isbn,titre,sous_titre,nombre_pages,annee_parution,niveau,id_collection,
   id_promotion,description,couverture)
VALUES
  ('978-2-7460-0946-6','PHP 5.6',
   'Développer un site Web dynamique et interactif',
   566,2015,'Initié',1,NULL,NULL,NULL),
  ('978-2-409-01511-3','PHP 7',
   'Développer un site Web dynamique et interactif',
   651,2018,'Initié',1,NULL,NULL,NULL),
  ('2-7460-3104-3','PHP 5',
   'L\'accès aux données (MySQL, Oracle, SQL Server, SQLite...)',   
   211,2006,'Expert',2,2,NULL,NULL),   
  ('978-2-7460-4614-6','Oracle 11g',
   'Administration',
   568,2011,'Initié',1,NULL,NULL,NULL),
  ('978-2-7460-9116-0','Oracle 12c',
   'Administration',
   723,2014,'Initié',1,NULL,NULL,NULL),
  ('978-2-409-00255-7','PHP et MySQL',
   'Maîtrisez le développement d\'un site Web dynamique et interactif',
   739,2016,'Initié',1,2,NULL,NULL),
  ('978-2-7460-4057-1','PHP 5 - MySQL 5 - AJAX',
   'Entraînez-vous à créer des applications professionnelles',
   302,2007,'Initié',3,NULL,NULL,NULL),
  ('978-2-7460-8852-8','Oracle 11g',
   'Optimisez vos bases de données en production',
   552,2016,'Confirmé',5,NULL,NULL,NULL),
  ('978-2-7460-4159-2','BusinessObjects XI',
   'Web Intelligence',
   305,2008,'Initié',1,2,NULL,NULL),
  ('978-2-409-00375-2','MySQL 5.7',
   'Administration et optimisation',
   503,2016,'Initié',1,NULL,NULL,NULL),
  ('978-2-409-01976-0','PHP et MySQL',
  'Développez un site web et administrez ses données',
   1166,2019,'Initié',4,1,NULL,NULL)
;

-- Modification d'une date de mise à jour pour un test ultérieur.
UPDATE livre SET date_maj = '2016-04-01 12:00:00' WHERE id = 1;

-- Création de la table AUTEUR_LIVRE.
CREATE TABLE auteur_livre
  (
  id_auteur INT,
  id_livre INT,
  PRIMARY KEY (id_auteur,id_livre)
  );
INSERT INTO auteur_livre
  (id_auteur,id_livre)
VALUES
  (1,1),
  (1,2),
  (1,3),
  (1,4),
  (1,5),
  (1,6),
  (4,7),  
  (6,8),
  (7,9),
  (2,10),
  (1,11),
  (2,11)
;

-- Création de la table RUBRIQUE_LIVRE.
CREATE TABLE rubrique_livre
  (
  id_rubrique INT,
  id_livre INT,
  PRIMARY KEY (id_rubrique,id_livre)
  );
INSERT INTO rubrique_livre
SELECT rub.id,liv.id
FROM livre liv,rubrique rub
WHERE 
liv.titre like '%PHP%'
AND rub.titre IN ('Langages','Conception Web')
AND rub.id_parent IS NOT NULL;
INSERT INTO rubrique_livre
SELECT rub.id,liv.id
FROM livre liv,rubrique rub
WHERE 
liv.titre like '%MySQL%'
AND rub.titre IN ('MySQL','Base de données')
AND rub.id_parent IS NOT NULL;
INSERT INTO rubrique_livre
SELECT rub.id,liv.id
FROM livre liv,rubrique rub
WHERE 
liv.titre like '%Oracle%'
AND rub.titre IN ('Oracle')
AND rub.id_parent IS NOT NULL;

-- Création de la table CATALOGUE.
CREATE TABLE catalogue
  (
  code VARCHAR(10) NOT NULL UNIQUE,
  titre VARCHAR(100) NOT NULL UNIQUE,
  prix_ttc DECIMAL(5,2) NOT NULL
  );

-- Création de la table CATALOGUE_ANCIEN.
CREATE TABLE catalogue_ancien
  (
  code VARCHAR(10) NOT NULL UNIQUE,
  titre VARCHAR(100) NOT NULL UNIQUE,
  prix_ttc DECIMAL(5,2) NOT NULL
  );
INSERT INTO catalogue_ancien
  (code,titre,prix_ttc)
VALUES
  ('RI410GORAA','Oracle 10g - Administration',33.18),
  ('TE5PHPAD','PHP 5 - L''accès aux données',33.18);

-- Création de la table UTILISATEURS.
CREATE TABLE utilisateurs
  (
  identifiant VARCHAR(20) NOT NULL UNIQUE,
  mot_de_passe VARCHAR(20) NOT NULL
  );
INSERT INTO utilisateurs
	(identifiant,mot_de_passe)
VALUES
	('heurtel','olivier');

-- Création de trois programmes stockés
delimiter //
CREATE PROCEDURE ps_creer_collection
  (
  -- Nom de la nouvelle collection.
  IN p_nom VARCHAR(25),
  -- Prix HT de la nouvelle collection.
  IN p_prix_ht DECIMAL(5,2),
  -- Identifiant de la nouvelle collection.
  OUT p_id INT
  )
BEGIN
  /* 
  ** Insérer la nouvelle collection et
  ** récupérer l'identifiant affecté.
  */
  INSERT INTO collection (nom,prix_ht)
  VALUES (p_nom,p_prix_ht);
  SET p_id = LAST_INSERT_ID();
END;
//
CREATE PROCEDURE ps_lire_sous_rubriques
  (
  -- Identifiant d'une rubrique (parent).
  IN p_id_parent INT
  )
BEGIN
  /*
  ** Sélectionner les sous-rubriques d'une
  ** rubrique dont l'identifiant est passé 
  ** en paramètre.
  */
  SELECT
    titre
  FROM
    rubrique
  WHERE
    id_parent = p_id_parent;
END;
//
CREATE FUNCTION fs_nombre_sous_rubriques
  (
  -- Identifiant d'une rubrique (parent).
  p_id_parent INT
  )
  RETURNS INT
  READS SQL DATA
BEGIN
  /*
  ** Compter le nombre de sous-rubriques d'une
  ** rubrique dont l'identifiant est passé 
  ** en paramètre.
  */
  DECLARE v_resultat INT;
  SELECT
    COUNT(*)
  INTO
    v_resultat
  FROM
    rubrique
  WHERE
    id_parent = p_id_parent;
  RETURN v_resultat;
END;
//
delimiter ;

-- Création d'un utilisateur 'eniweb'.
DROP USER IF EXISTS eniweb@localhost;
CREATE USER eniweb@localhost IDENTIFIED BY 'web';
GRANT SELECT,INSERT,UPDATE,DELETE,EXECUTE ON eni.* 
TO eniweb@localhost;

-- Affichage des tables.
SHOW TABLES;
