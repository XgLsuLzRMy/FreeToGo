-- MySQL dump 10.13  Distrib 5.7.22, for Linux (x86_64)
--
-- Host: localhost    Database: freetogo
-- ------------------------------------------------------
-- Server version	5.7.22-0ubuntu0.16.04.1

/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8 */;
/*!40103 SET @OLD_TIME_ZONE=@@TIME_ZONE */;
/*!40103 SET TIME_ZONE='+00:00' */;
/*!40014 SET @OLD_UNIQUE_CHECKS=@@UNIQUE_CHECKS, UNIQUE_CHECKS=0 */;
/*!40014 SET @OLD_FOREIGN_KEY_CHECKS=@@FOREIGN_KEY_CHECKS, FOREIGN_KEY_CHECKS=0 */;
/*!40101 SET @OLD_SQL_MODE=@@SQL_MODE, SQL_MODE='NO_AUTO_VALUE_ON_ZERO' */;
/*!40111 SET @OLD_SQL_NOTES=@@SQL_NOTES, SQL_NOTES=0 */;

--
-- Table structure for table `client`
--

DROP TABLE IF EXISTS `client`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `client` (
  `idClient` int(11) NOT NULL AUTO_INCREMENT,
  `nom` varchar(30) NOT NULL,
  `mail` varchar(30) NOT NULL,
  `prenom` varchar(30) DEFAULT NULL,
  `adresse` varchar(90) DEFAULT NULL,
  `description` varchar(500) DEFAULT NULL,
  `age` int(11) DEFAULT NULL,
  `photoProfil` varchar(30) DEFAULT NULL,
  `pays` varchar(30) DEFAULT NULL,
  `telephone` varchar(30) DEFAULT NULL,
  PRIMARY KEY (`idClient`)
) ENGINE=InnoDB AUTO_INCREMENT=16 DEFAULT CHARSET=utf8;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `client`
--

LOCK TABLES `client` WRITE;
/*!40000 ALTER TABLE `client` DISABLE KEYS */;
INSERT INTO `client` VALUES (1,'compte inexistant','mail@mail.com',NULL,NULL,NULL,NULL,NULL,NULL,NULL),(2,'Abregado','5nikhil.waghmare1@johnpo.cf','Maldonado','Calle Carril de la Fuente 11 13191 Los Pozuelos de Calatrava,737570865,Espagne','Voyageur confirmÃ©!',20,'./images/profil_2.png',NULL,'0737570865'),(3,'Jasinski','bepicchri@satisfyme.club','Albert','Symanska,ul. Krakowska 61 42-600 Tarnowskie Gory, Pologne','Voyager c\'est la vie!',44,'./images/profil_3.png',NULL,'0694132387'),(4,'ricc','masad_sharaba1@7pccf.tk','Ethan','Via Galileo Ferraris 147 46040-Cerlongo MN, Italie','Nice engineer..',46,'./images/profil_4.jpeg',NULL,'0342597304'),(5,'Pirozzi','itan@janganjadiabu4.cf','','Via delle Viole 150 60010-Scapezzano AN, Italie','',21,NULL,NULL,'0328708059'),(6,'Siciliani','8aouadi.limem2w@satcom.ml','','Via Capo le Case 67 39035-Welsberg BZ, Italie','',19,NULL,NULL,'0379472825'),(7,'Ylonen','kchel@a458a534na4.cf','','Linnoitustie 45 36240 KANGASALA, Finlande','',30,NULL,NULL,'0460537137'),(8,'Salmi','relmakd@baban.ml','','Sahantie 66 33230 TAMPERE, Finalnde','',28,NULL,NULL,'0505648804'),(9,'Seppinen','mastrcrazy555r@redmail.tech','','Tawastintie 50 15300 LAHTI, Finlande','',27,NULL,NULL,'0411044651'),(10,'Haataja','idevamani2242@tempm.gq','','Korkeakoulunkatu 36 50520 MIKKELI, Finlande','',26,NULL,NULL,'0501122070'),(11,'Sterling','tdrenzkeef@wwwmail.gq','','1589 Blackwell Street Kazakof Bay AK 99615','',23,NULL,NULL,'0907379653'),(12,'rodr','vzaking98x@bringluck.pw','','4418 Simpson Square Pike City OK 73438, Etats-Unis','',27,NULL,NULL,'0580673514'),(13,'Gatton','khbbmouni@sahrulselow.ml','','2973 Pine Tree Lane Myersville MD 21773, Etats-Unis','',37,NULL,NULL,'0240385844'),(14,'Rowley','xbiju2skya@rejo.technology','','59 Essex Rd TATWORTH TA20 6LP,070 6773 4657, Angleterre','',18,NULL,NULL,'0706773465'),(15,'Woodward','ddzhamodav@renaulttrucks.ml','','59 Essex Rd TATWORTH TA20 6LP, Angleterre','',18,NULL,NULL,'0706773465');
/*!40000 ALTER TABLE `client` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `commentaire`
--

DROP TABLE IF EXISTS `commentaire`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `commentaire` (
  `idCommentaire` int(11) NOT NULL AUTO_INCREMENT,
  `comment` varchar(500) NOT NULL,
  `idClient` int(11) NOT NULL,
  `idLogement` int(11) NOT NULL,
  PRIMARY KEY (`idCommentaire`),
  KEY `idClient` (`idClient`),
  KEY `idLogement` (`idLogement`),
  CONSTRAINT `commentaire_ibfk_1` FOREIGN KEY (`idClient`) REFERENCES `client` (`idClient`),
  CONSTRAINT `commentaire_ibfk_2` FOREIGN KEY (`idLogement`) REFERENCES `logement` (`idLogement`)
) ENGINE=InnoDB AUTO_INCREMENT=5 DEFAULT CHARSET=utf8;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `commentaire`
--

LOCK TABLES `commentaire` WRITE;
/*!40000 ALTER TABLE `commentaire` DISABLE KEYS */;
INSERT INTO `commentaire` VALUES (1,'HÃ´te trÃ¨s sympathique!',3,7),(2,'Merveilleux!',4,9),(3,'Un peu trop basique mais ca passe!',3,10),(4,'Rafraichissant!',3,4);
/*!40000 ALTER TABLE `commentaire` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `logement`
--

DROP TABLE IF EXISTS `logement`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `logement` (
  `idLogement` int(11) NOT NULL AUTO_INCREMENT,
  `prix` int(11) NOT NULL,
  `type` varchar(30) NOT NULL,
  `idClient` int(11) NOT NULL,
  `nomLogement` varchar(30) NOT NULL,
  `effectif` int(11) DEFAULT NULL,
  `adresse` varchar(90) DEFAULT NULL,
  `photo` varchar(50) DEFAULT NULL,
  `description` varchar(240) DEFAULT NULL,
  `ville` varchar(30) DEFAULT NULL,
  `pays` varchar(30) DEFAULT NULL,
  `wifi` tinyint(1) DEFAULT '0',
  `cuisine` tinyint(1) DEFAULT '0',
  `salledebain` tinyint(1) DEFAULT '0',
  PRIMARY KEY (`idLogement`),
  KEY `idClient` (`idClient`),
  CONSTRAINT `logement_ibfk_1` FOREIGN KEY (`idClient`) REFERENCES `client` (`idClient`)
) ENGINE=InnoDB AUTO_INCREMENT=11 DEFAULT CHARSET=utf8;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `logement`
--

LOCK TABLES `logement` WRITE;
/*!40000 ALTER TABLE `logement` DISABLE KEYS */;
INSERT INTO `logement` VALUES (1,45,'appartement',2,'Appartement en bord de mer',1,'Ventanilla de Beas 43 27880','./images/logements/logement_default.png','Petit appartement pour une personne.\r\nTrÃ¨s agrÃ©able et vue sur la mer.','Burela','Espagne',0,0,1),(2,49,'maison',9,'petite maison proche du centre',4,'Jalonkatu 70 90240','./images/logements/logement_default.png','Maison trÃ¨s confortable. Proche du centre de Oulu et de la mer.\r\nLa gare est Ã  10 minutes Ã  pieds.','Oulu','Finlande',1,1,1),(3,25,'appartement',3,'apart\' vintage',2,'ul GÃ³rna 21 71-803','./images/logements/logement_default.png','Petite appartement au style vintage.\r\nSituÃ© au bord d\'un lac et Ã  la frontiÃ¨re avec l\'Allemagne.','Szczecin','Pologne',1,0,1),(4,55,'appartement',14,'appart\' fraÃ®cheur',2,'89 Gordon Terrace','./images/logements/logement_default.png','Cet appartement a pour objectif de vous faire passer des vacances rafraichissante et calmes.','Bawburgh','Angleterre',0,1,1),(5,48,'maison',15,'maison chic',3,'8 Netherpark Crescent','./images/logements/logement_default.png','Petite maison bien situÃ©e et agrÃ©able.','Bawburgh','Angleterre',1,1,1),(6,132,'appartement',14,'appartement de luxe',2,'26 Newgate Street','./images/logements/logement_default.png','Cet appartement moderne et luxueux est parfait pour un voyage pour le travail ou prendre des vacances reposantes.','Bawburgh','Angleterre',1,1,1),(7,56,'Appartement',2,'Apartement Ã  Paris',7,'Rue de Hollande','./images/logements/logement_default.png','Appartement agrÃ©able.','Paris','France',1,1,1),(9,58,'Maison',3,'La maison de vos rÃªves',10,'Rue de la Fiesta','./images/logements/photo_9.jpg','Vous n\'aurez pas mieux!','Nice','France',1,1,1),(10,91,'Maison',4,'Simple et basique',5,'Rua de la Concordia','./images/logements/photo_10.jpg','Une maison simple et basique qui va vous faire aimer l\'Italie.','Rome','Italie',0,0,1);
/*!40000 ALTER TABLE `logement` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `reserver`
--

DROP TABLE IF EXISTS `reserver`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `reserver` (
  `numeroReservation` int(11) NOT NULL AUTO_INCREMENT,
  `idClient` int(11) DEFAULT NULL,
  `idLogement` int(11) DEFAULT NULL,
  `dateDebut` date DEFAULT NULL,
  `dateFin` date DEFAULT NULL,
  PRIMARY KEY (`numeroReservation`),
  KEY `idClient` (`idClient`),
  KEY `idLogement` (`idLogement`),
  CONSTRAINT `reserver_ibfk_1` FOREIGN KEY (`idClient`) REFERENCES `client` (`idClient`),
  CONSTRAINT `reserver_ibfk_2` FOREIGN KEY (`idLogement`) REFERENCES `logement` (`idLogement`)
) ENGINE=InnoDB AUTO_INCREMENT=7 DEFAULT CHARSET=utf8;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `reserver`
--

LOCK TABLES `reserver` WRITE;
/*!40000 ALTER TABLE `reserver` DISABLE KEYS */;
INSERT INTO `reserver` VALUES (1,3,7,'2018-05-28','2018-05-30'),(2,3,5,'2018-06-07','2018-06-09'),(3,3,2,'2018-08-16','2018-09-09'),(4,4,9,'2018-06-07','2018-06-08'),(5,3,10,'2018-06-21','2018-06-23'),(6,3,4,'2018-09-06','2018-09-13');
/*!40000 ALTER TABLE `reserver` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `session`
--

DROP TABLE IF EXISTS `session`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `session` (
  `login` varchar(30) NOT NULL,
  `mdp` varchar(512) NOT NULL,
  `idClient` int(11) DEFAULT NULL,
  PRIMARY KEY (`login`),
  KEY `idClient` (`idClient`),
  CONSTRAINT `session_ibfk_1` FOREIGN KEY (`idClient`) REFERENCES `client` (`idClient`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `session`
--

LOCK TABLES `session` WRITE;
/*!40000 ALTER TABLE `session` DISABLE KEYS */;
INSERT INTO `session` VALUES ('abre','fe3d8503f2590db0694286e5700626d77e96517b0877a0143b04ab9dc93bdc981c51190cca3e3a3a26d4830153a4b44fb9618cd53ddf677bcf2bb6946846e241',2),('gatt','f61ae0ba43d497a417bd35fc5020148bf5c76e44564c6d69b6c886ef6b9a994df2311a7812ce98b5a957fb238d40194eaf23e38f36cb962a732d68cde0fd4dca',13),('haat','e388ed9be2ba6b17f0c99f9f0191e38a66592f595dc89a3341d7cc2de5379e3a92def166afb71d498985d18266d4adc778b0fb6d01b9662382746677fc451eca',10),('jasi','a35f19c5331058a2da11aac1a384aad7a404d4bfd50af23c8eec14c9dfca3e111bb1e1ff9dede00b387d85252e7bb8cff9e0c449eb7515d3a1b8953d67cab0dd',3),('piro','9e3573d0ec5e872f38b7118a1bc59ef716681fefcb5123c7b3d140220dac960cbd8dbee45159a7ffae8d7c1d36a587b075af6f7745a2b35ddea5bfe206a4f387',5),('ricc','1838d34a156897e9372739aece27ab305cde0aa2315640ea9b1c194e02552202653b2b3746d68eefc8337c268143f14ee4660719a4e3b2758592b0cf310ec269',4),('rodr','632e0df1847de6d41a5ad033db66a310b5f5f9dd3bad5a47f93824409aadc93719eaa5f3384ac61655454df1a3f15f6844cdb605ffaf283a78840ce0dc65e5fa',12),('rowl','9b7f6a4156c86d45535d11f7ad8558b5e19839825ddc0c249a694afb0c3441c53769a1e877480750dc713f39afc19044057bd53b01af3d299c36e52db412a496',14),('salm','8b2a18da9fd14db25d4b85cfb09908db19e55f3aaa4b4371effcb19f96f809df729bc97b016105aa94560cbdcb3c7cd5464e1763720389f25f4b4d918b15b0aa',8),('sepp','af773b5e2a0502a830e9ee589897587eacb93dc5c6898f135d87a537b9dc5e79ceee74aacabc1f35c6a58cae9e4e1e9ce8604960eb2c2cfa17439a5642715b8e',9),('sici','c78102d87283710cb7c2729f2447fca33c63e75d947cd5eaaa33ee32ed0d2e9c76d1d702de22add97e065461ab0961b3b12362ca7ec6846aee712b834bf5cc92',6),('ster','1fa5c72c33497cd002f5151f2f146709707b02e9cb2de21decbac1a22aad4256ca554555014c8dab4d1913bf2cfd7450fb2832985328c7c0ca7ab6a438078d72',11),('wood','5c465e0ffb585013d74270112485a79287d51942cd2d2a4bd24999a5cfe8dccf10ac144640eaabadf4badc5263233b33239137d8563f17cd82aabd5e1ca4ad33',15),('ylon','87f96e7a0d8a8ab761f6ba7cba7c86c66d8a32d75d5d93242c56c9af5cffff815204aed9863b01c4eb741362c10f458f90d8828ccebc79944b342b2365bdd3ab',7);
/*!40000 ALTER TABLE `session` ENABLE KEYS */;
UNLOCK TABLES;
/*!40103 SET TIME_ZONE=@OLD_TIME_ZONE */;

/*!40101 SET SQL_MODE=@OLD_SQL_MODE */;
/*!40014 SET FOREIGN_KEY_CHECKS=@OLD_FOREIGN_KEY_CHECKS */;
/*!40014 SET UNIQUE_CHECKS=@OLD_UNIQUE_CHECKS */;
/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
/*!40111 SET SQL_NOTES=@OLD_SQL_NOTES */;

-- Dump completed on 2018-05-15  1:11:14
