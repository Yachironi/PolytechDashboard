BEGIN TRANSACTION;
CREATE TABLE "UE" (
	`id`	INTEGER PRIMARY KEY AUTOINCREMENT,
	`nom`	TEXT,
	`idFormation`	INTEGER,
	`Coeff`	INTEGER,
	`ECTS`	INTEGER,
	`Semestre`	INTEGER,
	FOREIGN KEY(`idFormation`) REFERENCES Formation ( id )
);
INSERT INTO `UE` VALUES (1,'Langues et communication I',41,5,3,7);
INSERT INTO `UE` VALUES (2,'L''entreprise et son environnement',41,11,6,7);
INSERT INTO `UE` VALUES (3,'Génie logiciel',41,10,7,7);
INSERT INTO `UE` VALUES (4,'Langages et calcul',41,11,6,7);
INSERT INTO `UE` VALUES (5,'Modélisation, optimisation, trait. Symbolique I',41,13,8,7);
INSERT INTO `UE` VALUES (6,'Langues et communication II',41,4,2,8);
INSERT INTO `UE` VALUES (7,'L''entreprise et son environnement',41,6,4,8);
INSERT INTO `UE` VALUES (8,'Projet',41,7,4,8);
INSERT INTO `UE` VALUES (9,'Architecture matérielle et logicielle',41,9,5,8);
INSERT INTO `UE` VALUES (10,'Sécurité, tests et preuves de programmes',41,10,6,8);
INSERT INTO `UE` VALUES (11,'Stage',41,14,9,8);
CREATE TABLE "TacheGestionnaire" (
	`idTache`	INTEGER,
	`idGestionnaire`	INTEGER,
	`idEtudiant`	INTEGER,
	`status`	TEXT,
	PRIMARY KEY(idTache,idGestionnaire,idEtudiant),
	FOREIGN KEY(`idTache`) REFERENCES Tache ( id ),
	FOREIGN KEY(`idGestionnaire`) REFERENCES Gestionnaire ( id ),
	FOREIGN KEY(`idEtudiant`) REFERENCES Etudiant(id)
);
INSERT INTO `TacheGestionnaire` VALUES (5,2,21303181,'NONLU');
INSERT INTO `TacheGestionnaire` VALUES (6,3,21303181,'NONLU');
CREATE TABLE `TacheEtudiant` (
	`idEtudiant`	INTEGER,
	`idTache`	INTEGER,
	`status`	TEXT,
	PRIMARY KEY(idEtudiant,idTache),
	FOREIGN KEY(`idEtudiant`) REFERENCES Etudiant(id),
	FOREIGN KEY(`idTache`) REFERENCES Tache(id)
);
INSERT INTO `TacheEtudiant` VALUES (21303181,1,'LU');
INSERT INTO `TacheEtudiant` VALUES (2,1,'NONLU');
INSERT INTO `TacheEtudiant` VALUES (3,1,'LU');
INSERT INTO `TacheEtudiant` VALUES (4,1,'LU');
INSERT INTO `TacheEtudiant` VALUES (5,1,'NONLU');
INSERT INTO `TacheEtudiant` VALUES (6,1,'LU');
INSERT INTO `TacheEtudiant` VALUES (7,1,'LU');
INSERT INTO `TacheEtudiant` VALUES (8,1,'VALIDE');
INSERT INTO `TacheEtudiant` VALUES (21303181,2,'LU');
INSERT INTO `TacheEtudiant` VALUES (2,2,'LU');
INSERT INTO `TacheEtudiant` VALUES (3,2,'LU');
INSERT INTO `TacheEtudiant` VALUES (4,2,'LU');
INSERT INTO `TacheEtudiant` VALUES (5,2,'NONLU');
INSERT INTO `TacheEtudiant` VALUES (6,2,'NONLU');
INSERT INTO `TacheEtudiant` VALUES (7,2,'VALIDE');
INSERT INTO `TacheEtudiant` VALUES (8,2,'LU');
INSERT INTO `TacheEtudiant` VALUES (21303181,3,'NONLU');
INSERT INTO `TacheEtudiant` VALUES (21303181,4,'NONLU');
CREATE TABLE "Tache" (
	`id`	INTEGER PRIMARY KEY AUTOINCREMENT,
	`type`	TEXT,
	`nom`	TEXT,
	`idGestionnaire`	INTEGER,
	`idEtudiant`	INTEGER,
	`dateCreation`	TEXT,
	`dateFin`	TEXT,
	`structure`	REAL,
	`importance`	INTEGER,
	FOREIGN KEY(`idGestionnaire`) REFERENCES Gestionnaire ( id ),
	FOREIGN KEY(`idEtudiant`) REFERENCES Etudiant ( id )
);
INSERT INTO `Tache` VALUES (1,'Rendu Rapport','Rendu tp CO',2,NULL,'2015-03-12','2015-04-30 18:00','Veuillez rendre votre projet de complément Objet, ce travail comprends des diagrammes explicatifs de votre modélisation, ainsi que le code commenté.
 Veuillez a bien inclure les patrons de conception utilisés',3);
INSERT INTO `Tache` VALUES (2,'Rendu Projet','Rendu projet C++',5,NULL,'2015-03-12','2015-04-30 23:59','Vous devez rendre le Projet de C++ a vos gestionnaires,
Votre rendu doit ètr ecomposé d''une archive contenant un rapport et vos codes sources.
Ces derniers doivent compiler sans aucun warnings.',3);
INSERT INTO `Tache` VALUES (3,'Rendu Dossier VISA','Visa for china',NULL,21303181,'2015-04-01','2015-04-17 23:59','penser a bien préparer tous les papiers, y compris l''original de l''attestation d''accueil de l''université chinoise',1);
INSERT INTO `Tache` VALUES (4,'Candidature M2R','candidature au Master recherche',NULL,21303181,'2015-04-01','2015-05-12 23:59','LM a Mme frenoux + choix des UE',2);
INSERT INTO `Tache` VALUES (5,NULL,'[Compilation - TP]',2,21303181,'2015-04-23','2015-05-30 23:59',NULL,1);
INSERT INTO `Tache` VALUES (6,NULL,'[Convention de stage]',3,21303181,'2015-04-23','2015-05-30 23:59',NULL,1);
CREATE TABLE "ReponseTache" (
	`id`	INTEGER PRIMARY KEY AUTOINCREMENT,
	`donnee`	TEXT,
	`idEtudiant`	INTEGER,
	`idTache`	INTEGER,
	`idGestionnaire`	INTEGER,
	FOREIGN KEY(`idEtudiant`) REFERENCES Etudiant ( id ),
	FOREIGN KEY(`idTache`) REFERENCES Tache ( id ),
	FOREIGN KEY(`idGestionnaire`) REFERENCES Gestionnaire ( id )
);
INSERT INTO `ReponseTache` VALUES (1,'RENDU',8,1,2);
INSERT INTO `ReponseTache` VALUES (2,'RENDU',7,2,2);
CREATE TABLE `Notification` (
	`id`	INTEGER,
	`valeur`	TEXT,
	`idEtudiant`	INTEGER,
	`categorie`	TEXT,
	`status`	TEXT,
	PRIMARY KEY(id),
	FOREIGN KEY(`idEtudiant`) REFERENCES Etudiant(id)
);
INSERT INTO `Notification` VALUES (1,'Veuillez envoyer votre candidature M2R avant le 04/05/15',1,'Tache','NONLU');
INSERT INTO `Notification` VALUES (2,'Changement dans l''Emploi du temps',2,'Planning','LU');
CREATE TABLE "Note" (
	`idEtudiant`	INTEGER,
	`idDetailNote`	INTEGER,
	`note`	NUMERIC,
	PRIMARY KEY(idEtudiant,idDetailNote),
	FOREIGN KEY(`idEtudiant`) REFERENCES Etudiant ( id ),
	FOREIGN KEY(`idDetailNote`) REFERENCES Cours ( id )
);
INSERT INTO `Note` VALUES (21303181,2,'13,5');
INSERT INTO `Note` VALUES (21341021,2,12);
INSERT INTO `Note` VALUES (23456987,2,15);
INSERT INTO `Note` VALUES (23456988,2,16);
INSERT INTO `Note` VALUES (21354254,2,12);
INSERT INTO `Note` VALUES (23456989,2,14);
INSERT INTO `Note` VALUES (23456989,1,11);
INSERT INTO `Note` VALUES (23456988,1,19);
INSERT INTO `Note` VALUES (21303181,1,12);
CREATE TABLE `GestionnaireStage` (
	`idGestionnaire`	INTEGER,
	`idFormation`	INTEGER,
	PRIMARY KEY(idGestionnaire,idFormation),
	FOREIGN KEY(`idGestionnaire`) REFERENCES Gestionnaire(id),
	FOREIGN KEY(`idFormation`) REFERENCES Formation(id)
);
INSERT INTO `GestionnaireStage` VALUES (1,41);
CREATE TABLE `GestionnaireFormation` (
	`idGestionnaire`	INTEGER,
	`idFormation`	INTEGER,
	PRIMARY KEY(idGestionnaire,idFormation),
	FOREIGN KEY(`idGestionnaire`) REFERENCES Gestionnaire(id),
	FOREIGN KEY(`idFormation`) REFERENCES Formation(id)
);
INSERT INTO `GestionnaireFormation` VALUES (5,41);
INSERT INTO `GestionnaireFormation` VALUES (8,31);
INSERT INTO `GestionnaireFormation` VALUES (10,34);
CREATE TABLE `GestionnaireCours` (
	`idGestionnaire`	INTEGER,
	`idCours`	INTEGER,
	PRIMARY KEY(idGestionnaire,idCours),
	FOREIGN KEY(`idGestionnaire`) REFERENCES Gestionnaire(id),
	FOREIGN KEY(`idCours`) REFERENCES Cours(id)
);
INSERT INTO `GestionnaireCours` VALUES (1,24);
INSERT INTO `GestionnaireCours` VALUES (2,9);
INSERT INTO `GestionnaireCours` VALUES (2,12);
INSERT INTO `GestionnaireCours` VALUES (2,13);
INSERT INTO `GestionnaireCours` VALUES (5,10);
INSERT INTO `GestionnaireCours` VALUES (7,28);
INSERT INTO `GestionnaireCours` VALUES (8,29);
INSERT INTO `GestionnaireCours` VALUES (9,14);
INSERT INTO `GestionnaireCours` VALUES (9,15);
CREATE TABLE `GestionnaireAdmin` (
	`idGestionnaire`	INTEGER,
	`idFormation`	INTEGER,
	PRIMARY KEY(idGestionnaire,idFormation),
	FOREIGN KEY(`idGestionnaire`) REFERENCES Gestionnaire(id),
	FOREIGN KEY(`idFormation`) REFERENCES Formation(id)
);
INSERT INTO `GestionnaireAdmin` VALUES (3,41);
INSERT INTO `GestionnaireAdmin` VALUES (3,42);
INSERT INTO `GestionnaireAdmin` VALUES (3,43);
INSERT INTO `GestionnaireAdmin` VALUES (3,44);
INSERT INTO `GestionnaireAdmin` VALUES (3,61);
INSERT INTO `GestionnaireAdmin` VALUES (3,62);
INSERT INTO `GestionnaireAdmin` VALUES (3,63);
INSERT INTO `GestionnaireAdmin` VALUES (3,64);
INSERT INTO `GestionnaireAdmin` VALUES (3,71);
INSERT INTO `GestionnaireAdmin` VALUES (3,72);
INSERT INTO `GestionnaireAdmin` VALUES (3,73);
INSERT INTO `GestionnaireAdmin` VALUES (3,74);
INSERT INTO `GestionnaireAdmin` VALUES (3,81);
INSERT INTO `GestionnaireAdmin` VALUES (3,82);
INSERT INTO `GestionnaireAdmin` VALUES (3,83);
INSERT INTO `GestionnaireAdmin` VALUES (3,84);
CREATE TABLE "Gestionnaire" (
	`id`	INTEGER PRIMARY KEY AUTOINCREMENT,
	`nom`	TEXT,
	`prenom`	TEXT,
	`email`	TEXT
);
INSERT INTO `Gestionnaire` VALUES (1,'Max','Aurélien','aurelien.max@limsi.fr');
INSERT INTO `Gestionnaire` VALUES (2,'Voisin','Frédéric','fv@lri.fr');
INSERT INTO `Gestionnaire` VALUES (3,'Chapiteau','Nadia','nadia.chapiteau@u-psud.fr');
INSERT INTO `Gestionnaire` VALUES (4,'Zouhdi','Said','said.zouhdi@u-psud.fr');
INSERT INTO `Gestionnaire` VALUES (5,'Frenoux','Emmanuelle','emanuelle.frenoux@lri.fr');
INSERT INTO `Gestionnaire` VALUES (6,'Marie','Benjamin','benjamin.marie@limsi.fr');
INSERT INTO `Gestionnaire` VALUES (7,'Soufflet','Gilles','gilles.souflet@u-psud.fr');
INSERT INTO `Gestionnaire` VALUES (8,'Longuet','Delphine','longuet@lri.fr');
INSERT INTO `Gestionnaire` VALUES (9,'Lisser','Abdel','lisser@limsi.fr');
INSERT INTO `Gestionnaire` VALUES (10,'Koeniguer','Cedric','cedric.koeniguer@u-psud.fr');
INSERT INTO `Gestionnaire` VALUES (11,'Poulard','Christophe','christophe.poulard@u-psud.fr');
INSERT INTO `Gestionnaire` VALUES (12,'Bernez','Cedric','cedric.bernez@u-psud.fr');
INSERT INTO `Gestionnaire` VALUES (13,'Le Hegarat','Sylvie','sylvie.le-hegarat@u-psud.fr');
INSERT INTO `Gestionnaire` VALUES (14,'Marsi','Marino','marino.marsi@u-psud.fr');
INSERT INTO `Gestionnaire` VALUES (15,'Zomer','Fabian','fabian.zomer@u-psud.fr');
INSERT INTO `Gestionnaire` VALUES (16,'Mounier','Hugues','hugues.mounier@u-psud.fr');
INSERT INTO `Gestionnaire` VALUES (17,'Legros','Corinne','corinne.legros@u-psud.fr');
INSERT INTO `Gestionnaire` VALUES (18,'Farcy','Rene','Rene.Farcy@u-psud.fr');
CREATE TABLE "Formation" (
	`id`	INTEGER,
	`specialite`	TEXT,
	`anneeEtude`	INTEGER,
	`type`	TEXT,
	PRIMARY KEY(id)
);
INSERT INTO `Formation` VALUES (31,'Informatique',3,'Etudiant');
INSERT INTO `Formation` VALUES (32,'Matériaux',3,'Etudiant');
INSERT INTO `Formation` VALUES (33,'Optronique',3,'Etudiant');
INSERT INTO `Formation` VALUES (34,'Electronique',3,'Etudiant');
INSERT INTO `Formation` VALUES (41,'Informatique',4,'Etudiant');
INSERT INTO `Formation` VALUES (42,'Matériaux',4,'Etudiant');
INSERT INTO `Formation` VALUES (43,'Optronique',4,'Etudiant');
INSERT INTO `Formation` VALUES (44,'Electronique',4,'Etudiant');
INSERT INTO `Formation` VALUES (51,'Informatique',5,'Etudiant');
INSERT INTO `Formation` VALUES (52,'Matériaux',5,'Etudiant');
INSERT INTO `Formation` VALUES (53,'Optronique',5,'Etudiant');
INSERT INTO `Formation` VALUES (54,'Electronique',5,'Etudiant');
INSERT INTO `Formation` VALUES (71,'Informatique',3,'Apprenti');
INSERT INTO `Formation` VALUES (72,'Matériaux',3,'Apprenti');
INSERT INTO `Formation` VALUES (73,'Optronique',3,'Apprenti');
INSERT INTO `Formation` VALUES (74,'Electronique',3,'Apprenti');
INSERT INTO `Formation` VALUES (81,'Informatique',4,'Apprenti');
INSERT INTO `Formation` VALUES (82,'Matériaux',4,'Apprenti');
INSERT INTO `Formation` VALUES (83,'Optronique',4,'Apprenti');
INSERT INTO `Formation` VALUES (84,'Electronique',4,'Apprenti');
INSERT INTO `Formation` VALUES (91,'Informatique',5,'Apprenti');
INSERT INTO `Formation` VALUES (92,'Matériaux',5,'Apprenti');
INSERT INTO `Formation` VALUES (93,'Optronique',5,'Apprenti');
INSERT INTO `Formation` VALUES (94,'Electronique',5,'Apprenti');
CREATE TABLE "EtudiantFormation" (
	`idEtudiant`	INTEGER,
	`idFormation`	INTEGER,
	PRIMARY KEY(idEtudiant,idFormation),
	FOREIGN KEY(`idEtudiant`) REFERENCES Etudiant ( id ),
	FOREIGN KEY(`idFormation`) REFERENCES Formation ( id )
);
INSERT INTO `EtudiantFormation` VALUES (21303181,41);
INSERT INTO `EtudiantFormation` VALUES (21341021,41);
INSERT INTO `EtudiantFormation` VALUES (21354254,41);
INSERT INTO `EtudiantFormation` VALUES (22121021,41);
INSERT INTO `EtudiantFormation` VALUES (22303165,41);
INSERT INTO `EtudiantFormation` VALUES (23456987,41);
INSERT INTO `EtudiantFormation` VALUES (23456988,41);
INSERT INTO `EtudiantFormation` VALUES (23456989,41);
CREATE TABLE "EtudiantCours" (
	`idEtudiant`	INTEGER,
	`idCours`	INTEGER,
	PRIMARY KEY(idCours),
	FOREIGN KEY(`idEtudiant`) REFERENCES Etudiant ( id ),
	FOREIGN KEY(`idCours`) REFERENCES Cours ( id )
);
INSERT INTO `EtudiantCours` VALUES (12410121,1);
INSERT INTO `EtudiantCours` VALUES (12410121,2);
INSERT INTO `EtudiantCours` VALUES (23456988,3);
INSERT INTO `EtudiantCours` VALUES (23456988,4);
CREATE TABLE "Etudiant" (
	`id`	INTEGER,
	`nom`	TEXT,
	`prenom`	TEXT,
	`email`	TEXT,
	`password`	TEXT,
	PRIMARY KEY(id)
);
INSERT INTO `Etudiant` VALUES (21303181,'Blanchard','Guillaume','guillaume.blanchard@u-psud.fr','7e240de74fb1ed08fa08d38063f6a6a91462a815');
INSERT INTO `Etudiant` VALUES (21341021,'Rabi','Yasser','yachironi@ubuntu.fr','5cb138284d431abd6a053a56625ec088bfb88912');
INSERT INTO `Etudiant` VALUES (21354254,'Preisner','Julien','jpreisner@free.fr','f36b4825e5db2cf7dd2d2593b3f5c24c0311d8b2');
INSERT INTO `Etudiant` VALUES (22121021,'Portaneri','Cédric','cportaneri@gmail.com','9c969ddf454079e3d439973bbab63ea6233e4087');
INSERT INTO `Etudiant` VALUES (22303165,'Akbaraly','Gishan','gishan.akbaraly@u-psud.fr','637a81ed8e8217bb01c15c67c39b43b0ab4e20f1');
INSERT INTO `Etudiant` VALUES (23456987,'Messaoudi','Amin','aminmessaoudi@gmail.com','f6949a8c7d5b90b4a698660bbfb9431503fbb995');
INSERT INTO `Etudiant` VALUES (23456988,'Zhang','Zheng','zzcooljay@gmail.com','07dcd371560bc43c48f56a2f55739ac66741d59d');
INSERT INTO `Etudiant` VALUES (23456989,'Heng','Daro','darob13@hotmail.fr','effdb5f96a28acd2eb19dcb15d8f43af762bd0ae');
CREATE TABLE "DetailNote" (
	`id`	INTEGER PRIMARY KEY AUTOINCREMENT,
	`idCours`	INTEGER,
	`detail`	TEXT,
	`pourcentage`	INTEGER,
	FOREIGN KEY(`detail`) REFERENCES Cours(id)
);
INSERT INTO `DetailNote` VALUES (1,13,'DM',50);
INSERT INTO `DetailNote` VALUES (2,13,'Examen',20);
INSERT INTO `DetailNote` VALUES (3,1,'DS',20);
INSERT INTO `DetailNote` VALUES (4,2,'Projet',50);
INSERT INTO `DetailNote` VALUES (5,2,'Examen',50);
INSERT INTO `DetailNote` VALUES (6,4,'Projet',100);
INSERT INTO `DetailNote` VALUES (7,5,'TP',40);
INSERT INTO `DetailNote` VALUES (8,5,'Projet',60);
INSERT INTO `DetailNote` VALUES (9,6,'TP',40);
INSERT INTO `DetailNote` VALUES (10,6,'Examen',60);
CREATE TABLE "Cours" (
	`id`	INTEGER PRIMARY KEY AUTOINCREMENT,
	`nomCours`	TEXT,
	`idFormation`	INTEGER,
	`coefficient`	INTEGER,
	`idUE`	INTEGER,
	`CoursH`	REAL,
	`CTDH`	REAL,
	`TDH`	REAL,
	`TPH`	REAL,
	`ProjetH`	REAL,
	`StageH`	REAL,
	FOREIGN KEY(`idFormation`) REFERENCES Formation ( id ),
	FOREIGN KEY(`idUE`) REFERENCES UE ( id )
);
INSERT INTO `Cours` VALUES (1,'Anglais',41,3,1,0.0,0.0,32.0,0.0,0.0,0.0);
INSERT INTO `Cours` VALUES (2,'Option Langue',41,2,1,0.0,0.0,10.5,0.0,0.0,0.0);
INSERT INTO `Cours` VALUES (3,'FLE',41,0,1,0.0,0.0,15.5,0.0,0.0,0.0);
INSERT INTO `Cours` VALUES (4,'Gestion de projet',41,4,2,1.5,15.0,0.0,12.0,4.0,0.0);
INSERT INTO `Cours` VALUES (5,'Management d''equipe',41,1,2,2.0,10.0,0.0,0.0,0.0,0.0);
INSERT INTO `Cours` VALUES (6,'Droit social et des contrats',41,3,2,24.0,0.0,0.0,0.0,0.0,0.0);
INSERT INTO `Cours` VALUES (7,'Gestion d''entreprise',41,2,2,0.0,18.0,0.0,0.0,0.0,0.0);
INSERT INTO `Cours` VALUES (8,'Projet personnel professionnel 1',41,1,2,0.0,0.0,0.0,8.0,0.0,0.0);
INSERT INTO `Cours` VALUES (9,'Complement Objet',41,5,3,18.0,0.0,12.0,12.0,0.0,0.0);
INSERT INTO `Cours` VALUES (10,'Outils de programmation et C++',41,5,3,24.0,0.0,0.0,24.0,0.0,0.0);
INSERT INTO `Cours` VALUES (11,'Langages formels et automates',41,3,4,8.0,0.0,10.0,0.0,0.0,0.0);
INSERT INTO `Cours` VALUES (12,'Projet compilation',41,4,4,0.0,0.0,0.0,0.0,24.0,0.0);
INSERT INTO `Cours` VALUES (13,'Compilation',41,4,4,18.0,0.0,16.0,0.0,4.0,0.0);
INSERT INTO `Cours` VALUES (14,'Programmation en nombres entiers',41,3,5,12.0,0.0,12.0,0.0,0.0,0.0);
INSERT INTO `Cours` VALUES (15,'Programmation stochastique',41,3,5,12.0,0.0,12.0,0.0,0.0,0.0);
INSERT INTO `Cours` VALUES (16,'Base de données',41,3,5,12.0,0.0,12.0,4.0,0.0,0.0);
INSERT INTO `Cours` VALUES (17,'Réseaux avancés',41,4,5,12.0,0.0,12.0,6.0,0.0,0.0);
INSERT INTO `Cours` VALUES (18,'Anglais',41,2,6,0.0,0.0,22.0,0.0,0.0,0.0);
INSERT INTO `Cours` VALUES (19,'Option langue',41,2,6,0.0,0.0,13.5,0.0,0.0,0.0);
INSERT INTO `Cours` VALUES (20,'FLE',41,0,6,0.0,0.0,8.5,0.0,0.0,0.0);
INSERT INTO `Cours` VALUES (21,'Jeu d''entreprise',41,2,7,0.0,24.0,0.0,0.0,0.0,0.0);
INSERT INTO `Cours` VALUES (22,'Projet personnel professionnel 2',41,2,7,2.0,9.0,0.0,0.0,0.0,0.0);
INSERT INTO `Cours` VALUES (23,'Analyse de cycle de vie',41,2,7,7.0,0.0,0.0,8.0,0.0,0.0);
INSERT INTO `Cours` VALUES (24,'Projet',41,7,8,0.0,0.0,0.0,0.0,19.5,0.0);
INSERT INTO `Cours` VALUES (25,'Architecture logicielle distribuée',41,4,9,12.0,0.0,0.0,14.0,0.0,0.0);
INSERT INTO `Cours` VALUES (26,'Architecture matérielle, parallèle',41,5,9,22.0,0.0,16.0,6.0,0.0,0.0);
INSERT INTO `Cours` VALUES (27,'Extraction de textes',41,3,10,10.0,0.0,8.0,8.0,0.0,0.0);
INSERT INTO `Cours` VALUES (28,'Securité',41,3,10,12.0,0.0,18.0,0.0,0.0,0.0);
INSERT INTO `Cours` VALUES (29,'Vérification et validation',41,4,10,12.0,0.0,14.0,8.0,0.0,0.0);
INSERT INTO `Cours` VALUES (30,'Stage 2 - assistant ingénieur',41,14,11,0.0,0.0,0.0,0.0,0.0,12.0);
COMMIT;
