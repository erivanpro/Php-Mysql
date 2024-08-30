/*
** Exemples du chapitre 4
*/


-- 1.	Cr�er et supprimer une base de donn�es
--
-- DROP DATABASE - CREATE DATABASE
DROP DATABASE IF EXISTS biblio;
CREATE DATABASE biblio;


-- 2.2.1.	Cr�er des utilisateurs
--
-- Un peu de m�nage pour commencer ...
DROP USER eniadm,eniadm@localhost,oheurtel@localhost;
--
CREATE USER eniadm IDENTIFIED BY 'eni';
CREATE USER oheurtel@localhost IDENTIFIED BY 'oh';
SELECT host,user,authentication_string 
FROM mysql.user WHERE user IN ('eniadm','oheurtel');
-- "Deuxi�me" utilisateur "eniadm"
CREATE USER eniadm@localhost IDENTIFIED BY 'eni';
SELECT host,user,authentication_string 
FROM mysql.user WHERE user = 'eniadm';


-- 2.2.3.	Modifier le mot de passe des utilisateurs
--
SET PASSWORD FOR eniadm = 'secret';
SELECT host,user,authentication_string 
FROM mysql.user WHERE user = 'eniadm';
SET PASSWORD FOR eniadm@localhost = 'secret';
SELECT host,user,authentication_string 
FROM mysql.user WHERE user = 'eniadm';
ALTER USER oheurtel@localhost IDENTIFIED BY 'secret';
SELECT host,user,authentication_string 
FROM mysql.user WHERE user = 'oheurtel';


-- 2.3.1.	Attribuer des droits aux utilisateurs
-- 
-- L'utilisateur "eniadm" est l'administrateur de 
-- la base "eni" : il a tous les droits sur cette base.
GRANT ALL ON eni.* TO eniadm,eniadm@localhost;
-- L'utilisateur "oheurtel" est un utilisateur de 
-- la base "eni" : il a uniquement les droits de
-- lire et mettre � jour les donn�es, et d'ex�cuter
-- les programmes stock�s.
GRANT SELECT,INSERT,UPDATE,DELETE,EXECUTE ON eni.* 
TO oheurtel@localhost;
-- Donnons aussi � l'utilisateur "oheurtel" le droit
-- de charger et d�charger des donn�es.
GRANT FILE ON *.* TO oheurtel@localhost;


-- 2.3.2.	Lister les droits d�un utilisateur
-- 
SHOW GRANTS FOR oheurtel@localhost;


-- 2.3.3.	R�voquer des droits des utilisateurs
-- 
-- Finalement, l'utilisateur "oheurtel" n'a plus le droit
-- de charger et d�charger des donn�es.
REVOKE FILE ON *.* FROM oheurtel@localhost;
SHOW GRANTS FOR oheurtel@localhost;


-- 2.4.2.	Cr�er un r�le
-- 
-- R�le pour la consultation de certaines tables.
CREATE ROLE eniconsult;


-- 2.4.3.	Attribuer des droits � un r�le
-- 
-- Droits SELECT sur certaines tables de la base de 
-- donn�es "eni". 
GRANT SELECT ON eni.collection TO eniconsult;
GRANT SELECT ON eni.livre TO eniconsult;
GRANT SELECT ON eni.utilisateurs TO eniconsult;
--
-- Visualiser les droits attribu�s au r�le.
SHOW GRANTS FOR eniconsult;


-- 2.4.4.	R�voquer des droits d'un r�le
-- 
-- Finalement, le r�le n'a plus le droit de lire la table
-- "utilisateurs".
REVOKE SELECT ON eni.utilisateurs FROM eniconsult;
--
-- Visualiser les droits attribu�s au r�le.
SHOW GRANTS FOR eniconsult;


-- 2.4.5.	Attribuer un r�le � un utilisateur ou � un r�le
-- 
-- Cr�er un nouvel utilisateur nomm� "stagiaire".
CREATE USER stagiaire IDENTIFIED BY 'photocopie';
-- Attribuer le r�le "eniconsult" � cet utilisateur.
GRANT eniconsult TO stagiaire;
-- Visualiser les droits attribu�s � l'utilisateur.
SHOW GRANTS FOR stagiaire;
-- Visualiser les droits attribu�s � l'utilisateur 
-- � travers le r�le.
SHOW GRANTS FOR stagiaire USING eniconsult;


-- 2.4.6.	Activer les r�les
-- 
-- Se connecter avec l'utilisateur "stagiaire".
-- Consulter la liste des r�les actifs (aucun � ce stade).
SELECT CURRENT_ROLE();
-- Tenter de compter le nombre de lignes de la table LIVRE.
SELECT COUNT(*) FROM eni.livre;
-- Activer le r�le "eniconsult".
SET ROLE eniconsult;
SELECT CURRENT_ROLE();
-- La table est accessible.
SELECT COUNT(*) FROM eni.livre;
-- 
-- Se connecter avec l'utilisateur "root".
-- Activer le r�le par d�faut pour l'utilisateur "stagiaire".
SET DEFAULT ROLE eniconsult TO stagiaire;
-- 
-- Se connecter de nouveau avec l'utilisateur "stagiaire".
-- V�rifier que le r�le est bien actif par d�faut.
SELECT CURRENT_ROLE();
-- V�rifier que la table est accessible.
SELECT COUNT(*) FROM eni.livre;


-- 2.4.7.	R�voquer un r�le d�un utilisateur ou d�un r�le
-- 
REVOKE eniconsult FROM stagiaire;


-- 2.4.8.	Supprimer un r�le
-- 
DROP ROLE eniconsult;


-- 3.	G�rer les tables
-- Travailler avec la base "eni"
USE eni;


-- 3.1.	Cr�er une table
--
-- Exemple simple
CREATE TABLE evenement
  (
  id INT,
  nom VARCHAR(20)
  );
DESC evenement;
--
-- Exemple plus complet
CREATE TABLE utilisateur
  (
  id INT PRIMARY KEY AUTO_INCREMENT,
  nom VARCHAR(40) NOT NULL,
  prenom VARCHAR(40) NOT NULL,
  nom_complet VARCHAR(91) AS (CONCAT_WS(' ',prenom,nom)) NOT NULL,
  mail VARCHAR(200) NOT NULL UNIQUE KEY,
  mot_de_passe BLOB NOT NULL,
  est_actif BOOLEAN NOT NULL DEFAULT TRUE,
  date_maj TIMESTAMP DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP
  );
DESC utilisateur;
INSERT INTO utilisateur(prenom,nom,mail,mot_de_passe) 
VALUES('Olivier','Heurtel','contact@olivier-heurtel.fr','secret');
SELECT id,nom_complet,est_actif,date_maj FROM utilisateur;


-- 3.2.	Cr�er une table par copie
--
-- Copie d'une autre table
CREATE TABLE responsable_collection LIKE auteur;
DESC responsable_collection;
--
-- Copie du r�sultat d'une requ�te SELECT
CREATE TABLE categorie(id INT PRIMARY KEY AUTO_INCREMENT)
AS SELECT titre nom FROM rubrique WHERE id_parent IS NULL;
DESC categorie;
SELECT * FROM categorie;


-- 3.3.	Renommer une table
--
RENAME TABLE utilisateur TO client;


-- 3.4.	Modifier la structure d'une table
-- 
-- Ajouter une ou plusieurs colonnes
ALTER TABLE evenement ADD
  (
  date_debut DATE,
  date_fin DATE,
  id_collection INT DEFAULT 1,
  pays VARCHAR(50) 
  );
DESC evenement;
--
-- Supprimer une colonne
ALTER TABLE evenement DROP id_collection;
DESC evenement;
--
-- Modifier ou supprimer la valeur par d�faut d�une colonne
ALTER TABLE evenement ALTER pays SET DEFAULT 'FRANCE';
DESC evenement;
--
-- Modifier les attributs des colonnes
-- CHANGE
ALTER TABLE evenement CHANGE
  pays code_pays VARCHAR(50) DEFAULT 'FR';
DESC evenement;
-- MODIFY
ALTER TABLE evenement MODIFY
  code_pays CHAR(2) NOT NULL;
DESC evenement;
-- AUTO_INCREMENT possible unique si colonne ind�x�e
ALTER TABLE evenement MODIFY id INT AUTO_INCREMENT;


-- 4.1.2. Gestion (cl� primaire ou unique)
--
-- Cr�er une cl� primaire lors du CREATE TABLE
CREATE TABLE collection_evenement
  (
  id_evenement INT,
  id_collection INT,
  PRIMARY KEY (id_evenement,id_collection)
  );
DESC collection_evenement;
--
-- Ajouter une cl� primaire avec un ALTER TABLE
ALTER TABLE evenement ADD
  (
  CONSTRAINT pk_evenement PRIMARY KEY(id),
  CONSTRAINT uk_nom UNIQUE KEY(nom)
  );
-- L'attribut AUTO_INCREMENT peut maintenant �tre
-- affect� � la colonne "id".
ALTER TABLE evenement MODIFY id INT AUTO_INCREMENT;
DESC evenement;
--
ALTER TABLE auteur ADD
  CONSTRAINT nom_prenom_unique UNIQUE KEY(nom,prenom);
DESC auteur;
--
-- Afficher les index d'une table
SHOW INDEXES FROM evenement;
--
-- Supprimer une cl� unique/primaire
ALTER TABLE auteur DROP KEY nom_prenom_unique;
DESC auteur;


-- 4.2.2. Gestion (index)
--
-- Ajouter un index avec un ALTER TABLE
ALTER TABLE rubrique ADD INDEX (id_parent);
DESC rubrique;
--
-- Ajouter un index avec un CREATE INDEX
CREATE INDEX ix_annee ON livre(annee_parution);
CREATE INDEX ix_nom_prenom ON auteur(nom,prenom);
CREATE INDEX ix_mot_de_passe ON auteur(mot_de_passe(8));
--
-- Supprimer un index
DROP INDEX ix_mot_de_passe ON auteur;


-- 4.2.3. Consid�ration
--
-- Ajouter une colonne calcul�e � une table et l'indexer
ALTER TABLE client ADD prefixe_nom VARCHAR(4) AS (LEFT(nom,4));
CREATE INDEX ix_prefixe_nom ON client(prefixe_nom);
-- Une recherche sur cette colonne calcul�e utilise l'index
SELECT nom,prenom,mail FROM client WHERE prefixe_nom = 'HEUR';
-- De m�me d'une recherche qui utilise l'expression de la colonne
SELECT nom,prenom,mail FROM client WHERE LEFT(nom,4) = 'HEUR';


-- 4.3.2. Gestion (cl� �trang�re)
--
-- Cr�ation des tables "commande" et "ligne_commande".
CREATE TABLE commande
  (
  id INT PRIMARY KEY AUTO_INCREMENT,
  date_commande DATE
  )
  ENGINE innodb; -- clause inutile, c'est le moteur par d�faut
CREATE TABLE ligne_commande
  (
  id_commande INT,
  numero_ligne INT,
  article VARCHAR(50),
  quantite INT,
  prix_unitaire DECIMAL(8,2),
  PRIMARY KEY(id_commande,numero_ligne)
  )
  ENGINE innodb; -- clause inutile, c'est le moteur par d�faut 
--
-- Cr�ation d'une contrainte de cl� �trang�re entre
-- "ligne_commande" et "commande".
ALTER TABLE ligne_commande ADD
  FOREIGN KEY (id_commande)
  REFERENCES commande(id);
--
-- Insertion d'une commande avec une ligne de commande.
INSERT INTO commande(date_commande) VALUES(DATE(NOW()));
SET @id = LAST_INSERT_ID();
INSERT INTO ligne_commande
  (id_commande,numero_ligne,article,quantite,prix_unitaire)
VALUES
  (@id,1,'PHP 7',1,25);
--
-- Insertion d'une ligne de commande avec un identifiant
-- de commande qui n'existe pas => erreur.
INSERT INTO ligne_commande
  (id_commande,numero_ligne,article,quantite,prix_unitaire)
VALUES
  (2,1,'MySQL 5',1,25);
--
-- Suppression de la commande => erreur (par d�faut, 
-- la suppression d'un parent est interdite s'il a des
-- enfants).
DELETE FROM commande WHERE id = @id;
--
-- Recr�ation de la contrainte de cl� �trang�re pour avoir
-- une suppression en cascade.
ALTER TABLE ligne_commande 
  DROP FOREIGN KEY ligne_commande_ibfk_1;
ALTER TABLE ligne_commande ADD
  FOREIGN KEY (id_commande)
  REFERENCES commande(id)
  ON DELETE CASCADE;
--
-- Suppression de la commande => OK. 
DELETE FROM commande WHERE id = @id;
SELECT COUNT(*) FROM ligne_commande WHERE id_commande = @id;


-- 4.4.2. Gestion (contrainte CHECK)
--
-- Ajout d'une contraine sur les dates (date de d�but ant�rieure
-- � la date de fin).
ALTER TABLE evenement ADD CONSTRAINT CHECK (date_debut <= date_fin);
-- Insertion de valeurs erron�es.
INSERT INTO evenement (nom,date_debut,date_fin,code_pays)
VALUES ('F�te du livre','2019-09-15','2019-09-13','FR');
-- Insertion de valeurs correctes.
INSERT INTO evenement (nom,date_debut,date_fin,code_pays)
VALUES ('F�te du livre','2019-09-13','2019-09-15','FR');


-- 5.2. Gestion (vues)
-- 
-- Premier exemple
CREATE OR REPLACE VIEW
  liste_rubriques(rubrique,sous_rubrique)
AS
SELECT par.titre rubrique,enf.titre sous_rubrique
FROM rubrique par,rubrique enf
WHERE enf.id_parent = par.id;
SELECT * FROM liste_rubriques;
--
-- Clause WITH CHECK OPTION
CREATE OR REPLACE VIEW rubrique_db AS
SELECT * FROM rubrique WHERE id_parent = 1
WITH CHECK OPTION;
SELECT * FROM rubrique_db;
SELECT * FROM rubrique_db WHERE id_parent = 2;
INSERT INTO rubrique_db(titre,id_parent) VALUES('SQLite',1);
INSERT INTO rubrique_db(titre,id_parent) VALUES('Langages',4);


-- 6.1. La commande SHOW
--
SHOW COLUMNS FROM collection;
SHOW CREATE TABLE collection;


-- 7.2.	La base de donn�es INFORMATION_SCHEMA
--
SELECT
  column_name,
  data_type,
  column_default,
  is_nullable,
  column_key
FROM
  information_schema.columns
WHERE
  table_schema = 'eni'
  AND table_name = 'collection'
ORDER BY
  ordinal_position;
