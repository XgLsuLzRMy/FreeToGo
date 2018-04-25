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
  `idClient` int(11) NOT NULL,
  `nom` varchar(30) DEFAULT NULL,
  `adresse` varchar(30) DEFAULT NULL,
  `telephone` varchar(30) DEFAULT NULL,
  `pays` varchar(30) DEFAULT NULL,
  PRIMARY KEY (`idClient`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `client`
--

LOCK TABLES `client` WRITE;
/*!40000 ALTER TABLE `client` DISABLE KEYS */;
INSERT INTO `client` VALUES (1,'Abrego Maldonado','Calle Carril de la Fuente, 11,','737 570 865','Espagne'),(2,'Jasinski','ul. Dziecięca 12, 04-919 Warsz','67 112 04 56','Pologne'),(3,'Symanska','ul. Krakowska 61, 42-600 Tarno','69 413 23 87','Pologne'),(4,'Ricci','Via Galileo Ferraris, 147, 460','0342 5973042','Italie'),(5,'Pirozzi','Via delle Viole, 150, 60010-Sc','0328 7080599','Italie'),(6,'Siciliani','Via Capo le Case, 67, 39035-We','0379 4728252','Italie'),(7,'Ylonen','Linnoitustie 45, 36240 KANGASA','046 053 7137','Finlande'),(8,'Salmi','Sahantie 66, 33230 TAMPERE','050 564 8804','Finlande'),(9,'Seppinen','Tawastintie 50, 15300 LAHTI ','041 104 4651','Finlande'),(10,'Haataja','Korkeakoulunkatu 36, 50520 MIK','050 112 2070','Finlande'),(11,'Sterling','1589 Blackwell Street, Kazakof','907-379-6539','Etats-Unis'),(12,'Rodriguez','4418 Simpson Square, Pike City','580-673-5146','Etats-Unis'),(13,'Gatton','2973 Pine Tree Lane, Myersvill','240-385-8449','Etats-Unis'),(14,'Rowley','59 Essex Rd TATWORTH TA20 6LP','070 6773 4657','Angleterre'),(15,'Woodward','18 Dunmow Road GROVE DN22 4XN','079 4711 8225','Angleterre'),(16,'Booth','83 Station Rd QUOYS OF REISS K','079 3909 1896','Angleterre'),(17,'Wilkins','27 Iolaire Road NEW FARNLEY LS','077 2371 3370','Angleterre'),(18,'Bernier','Obere Haltenstrasse 101 6900 L','091 784 22 57','Suisse'),(19,'Houle','Erlenweg 105 8836 Bennau','055 300 40 76','Suisse'),(20,'Maur','Bahnhofplatz 100 8560 Altenkli','052 550 52 56','Suisse'),(21,'Kluge','Puntstrasse 6 4495 Zeglingen','061 787 26 42','Suisse');
/*!40000 ALTER TABLE `client` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `hote`
--

DROP TABLE IF EXISTS `hote`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `hote` (
  `idHote` int(11) NOT NULL,
  `nom` varchar(30) DEFAULT NULL,
  `adresse` varchar(30) DEFAULT NULL,
  `pays` varchar(30) DEFAULT NULL,
  `telephone` varchar(30) DEFAULT NULL,
  PRIMARY KEY (`idHote`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `hote`
--

LOCK TABLES `hote` WRITE;
/*!40000 ALTER TABLE `hote` DISABLE KEYS */;
INSERT INTO `hote` VALUES (1,'Sauriol','24, boulevard Bryas, 92400 COU','01.89.78.47.19','France'),(2,'Primeau','80, Cours Marechal-Joffre, 691','02.87.49.54.41','France'),(3,'Fluet','32, avenue Ferdinand de Lessep','02.99.55.30.04','France'),(4,'Fecteau','85, Cours Marechal-Joffre, 592','01.24.42.06.13','France'),(5,'Rouleau','24, route de Lyon, 67400 ILLKI','03.74.44.59.05','France'),(9,'Lachance','33, rue Victor Hugo, 78700 CON','03.30.87.94.95','France'),(10,'Faucher','37, rue du Président Roosevelt','05.46.11.06.36','France'),(11,'Fresne','Jahnstrasse 28, 84149 Velden ','08086 30 21 06','Allemagne'),(12,'Lemann','Borstelmannsweg 98, 92239 Hirs','09608 71 71 36','Allemagne'),(13,'Farber','Hans-Grade-Allee 53, 22941 Bar','04532 30 13 16','Allemagne'),(14,'Shuster','Landhausstraße 95, 16540 Hohen','03303 87 35 94','Allemagne'),(15,'Abend','Brandenburgische Straße 90, 14','030 33 68 99','Allemagne'),(16,'Becerra Camarillo','Avda. Los llanos, 82, 26288 Zo','638309325','Espagne'),(17,'Rivero Salas','Av. Santiago Lapuente, 22, 507','645230093','Espagne'),(18,'Rentería Longoria','Visitación de la Encina, 56, 3','604043595','Espagne'),(19,'Aranda Rivas','Celso Emilio Ferreiro, 64, 506','646431645','Espagne'),(20,'Mills','35, Daskalaki Street, 4620 Epi','96 983719','Chypre'),(21,'Morrison','45, Eleftherias Street, 7743 P','95 320346','Chypre'),(22,'Krol','ul. Wrocławska 70, 71-034 Szcz','51 618 72 56','Pologne');
/*!40000 ALTER TABLE `hote` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `logement`
--

DROP TABLE IF EXISTS `logement`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `logement` (
  `idLogement` int(11) NOT NULL,
  `idHote` int(11) DEFAULT NULL,
  `adresse` varchar(30) DEFAULT NULL,
  `ville` varchar(30) DEFAULT NULL,
  `pays` varchar(30) DEFAULT NULL,
  PRIMARY KEY (`idLogement`),
  KEY `idHote` (`idHote`),
  CONSTRAINT `logement_ibfk_1` FOREIGN KEY (`idHote`) REFERENCES `hote` (`idHote`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `logement`
--

LOCK TABLES `logement` WRITE;
/*!40000 ALTER TABLE `logement` DISABLE KEYS */;
INSERT INTO `logement` VALUES (1,1,'1, rue du Blues, Paris','Paris','France'),(2,2,'66, rue Léon Dierx, 14100 Lisi','Lisieux','France'),(3,3,'64, rue Clement Marot, 66100 P','Perpignan','France'),(4,4,'90, Square de la Couronne,7500','Paris','France'),(5,5,'81, avenue Ferdinand de Lessep','Grasse','France'),(9,9,'Ventanilla de Beas,  43, 27880','Burela','Espagne'),(10,10,'C/ Libertad, 24, 06000 Badajoz','Badajoz','Espagne'),(11,11,'Outid de Arriba, 88, 43717 La ','La Bisbal del Penedès','Espagne'),(12,12,'Carretera Cádiz-Málaga, 79, 20','Aretxabaleta ','Espagne'),(13,13,'Rúa Olmos, 26, 37316 Bóveda de','Bóveda del Río Almar ','Espagne'),(14,14,'Alt-Moabit 43, 14750 Brandenbu','Brandenburg','Allemagne'),(15,15,'Am Borsigturm 13, 47800 Krefel','Krefeld ','Allemagne'),(16,16,'Schaarsteinweg 18, 93099 Mötzi','Mötzing ','Allemagne'),(17,17,'Meininger Strasse, 72, 66515 N','Neunkirchen ','Allemagne'),(18,18,'Augsburger Strasse 39, 54673 B','Bauler ','Allemagne'),(19,19,'Baumgarten 57, 4282 NIEDERHOFS','NIEDERHOFSTETTEN ','Autriche'),(20,20,'Ausergassen, 80,3370 YBBS AN D','YBBS AN DER DONAU','Autriche'),(21,21,'Gralla 17, 8742 GROSSPRETHAL','GROSSPRETHAL','Autriche'),(22,22,'Villacher Strasse 67, 5120 PFA','PFAFFING','Autriche'),(23,1,'86, Kondilaki Street, 2963 Cha','Challeri ','Chypre'),(24,2,'204, Athens Sounio Avenue, 862','Agios Nikolaos Salamiou','Chypre'),(25,3,'270, Iroon Politehniou Square,','Limassol ','Chypre'),(26,4,'Jalonkatu,70, 90240 OULU ','Oulu','Finlande'),(27,5,'Visiokatu 38, 38950 HONKAJOKI ','HONKAJOKI ','Finlande'),(31,9,'ul. Fiołków 99, 40-046 Katowic','Katowice ','Pologne'),(32,10,'Pl. Ducha Świętego 35,15-204 B','Białystok ','Pologne'),(33,11,'ul. Przemszy 58, 41-400 Mysłow','Mysłowice','Pologne'),(34,12,'Via Longhena, 98,00188-Labaro ','Labaro RM','Italie'),(35,13,'Via Nolana, 119, 19010-Maissan','Maissana SP','Italie'),(36,14,'Via Medina, 55, 34071-Brazzano','Brazzano GO','Italie'),(37,15,'Via Matteo Schilizzi, 49,16046','Mezzanego GE ','Italie'),(38,16,'Via degli Aldobrandeschi, 135,','Borgo Petilia CL ','Italie'),(39,17,'38, rue Sébastopol, 97438 SAIN','SAINTE-MARIE ','France'),(40,18,'18, Chemin Du Lavarin Sud, 068','CAGNES-SUR-MER ','France'),(41,19,'26, rue des Lacs, 78800 HOUILL','HOUILLES','France'),(42,20,'13, rue Marguerite, 94300 VINC',' VINCENNES ','France'),(43,21,'80, rue Petite Fusterie, 18000','BOURGES ','France'),(44,22,'10, boulevard de la Liberation','MARSEILLE','France'),(45,1,'66, rue Banaudon, 69009 LYON','LYON','France'),(46,2,'36, rue des Chaligny, 06000 NI','NICE','France'),(47,3,'18, rue des Lacs, 83400 HYÈRES','HYÈRES ','France'),(48,4,'91, rue de la République, 6900',' LYON ','France'),(49,5,'22, rue de Raymond Poincaré, 4','NANTES','France'),(53,9,'63, rue La Boétie, 75013 PARIS','PARIS ','France'),(54,10,'21, rue Reine Elisabeth, 06500','MENTON ','France'),(55,11,'9, Cours Marechal-Joffre, 7620','DIEPPE ','France'),(56,12,' 81, rue du Château, 78100 SAI','SAINT-GERMAIN-EN-LAYE','France'),(57,13,'26, Faubourg Saint Honoré, 750',' PARIS ','France');
/*!40000 ALTER TABLE `logement` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `reserver`
--

DROP TABLE IF EXISTS `reserver`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `reserver` (
  `numeroReservation` int(11) NOT NULL,
  `idClient` int(11) DEFAULT NULL,
  `idLogement` int(11) DEFAULT NULL,
  `dateDebut` date DEFAULT NULL,
  `dateFin` date DEFAULT NULL,
  PRIMARY KEY (`numeroReservation`),
  KEY `idClient` (`idClient`),
  KEY `idLogement` (`idLogement`),
  CONSTRAINT `reserver_ibfk_1` FOREIGN KEY (`idClient`) REFERENCES `client` (`idClient`),
  CONSTRAINT `reserver_ibfk_2` FOREIGN KEY (`idLogement`) REFERENCES `logement` (`idLogement`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `reserver`
--

LOCK TABLES `reserver` WRITE;
/*!40000 ALTER TABLE `reserver` DISABLE KEYS */;
INSERT INTO `reserver` VALUES (1,7,19,'2018-06-09','2018-06-29'),(2,10,54,'2018-09-28','2018-10-07'),(3,18,44,'2018-11-01','2018-11-25'),(4,12,38,'2018-07-13','2018-08-13'),(5,1,53,'2018-01-12','2018-03-12'),(7,4,57,'2018-10-27','2018-12-15'),(8,15,38,'2018-09-08','2018-10-02'),(9,3,9,'2018-07-26','2018-07-29'),(10,17,53,'2018-06-30','2018-07-12'),(11,12,22,'2018-12-05','2018-12-23'),(12,12,24,'2018-06-02','2018-06-17'),(13,12,38,'2018-11-08','2018-11-22'),(14,3,54,'2018-01-17','2018-02-05'),(15,2,42,'2018-01-12','2018-01-23');
/*!40000 ALTER TABLE `reserver` ENABLE KEYS */;
UNLOCK TABLES;
/*!40103 SET TIME_ZONE=@OLD_TIME_ZONE */;

/*!40101 SET SQL_MODE=@OLD_SQL_MODE */;
/*!40014 SET FOREIGN_KEY_CHECKS=@OLD_FOREIGN_KEY_CHECKS */;
/*!40014 SET UNIQUE_CHECKS=@OLD_UNIQUE_CHECKS */;
/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
/*!40111 SET SQL_NOTES=@OLD_SQL_NOTES */;

-- Dump completed on 2018-04-24 12:28:34
