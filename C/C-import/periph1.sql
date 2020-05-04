-- MySQL dump 10.13  Distrib 8.0.15, for Win64 (x86_64)
--
-- Host: localhost    Database: call-out-duty p1
-- ------------------------------------------------------
-- Server version	5.7.24

/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
 SET NAMES utf8mb4 ;
/*!40103 SET @OLD_TIME_ZONE=@@TIME_ZONE */;
/*!40103 SET TIME_ZONE='+00:00' */;
/*!40014 SET @OLD_UNIQUE_CHECKS=@@UNIQUE_CHECKS, UNIQUE_CHECKS=0 */;
/*!40014 SET @OLD_FOREIGN_KEY_CHECKS=@@FOREIGN_KEY_CHECKS, FOREIGN_KEY_CHECKS=0 */;
/*!40101 SET @OLD_SQL_MODE=@@SQL_MODE, SQL_MODE='NO_AUTO_VALUE_ON_ZERO' */;
/*!40111 SET @OLD_SQL_NOTES=@@SQL_NOTES, SQL_NOTES=0 */;

--
-- Table structure for table `bill`
--

DROP TABLE IF EXISTS `bill`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
 SET character_set_client = utf8mb4 ;
CREATE TABLE `bill` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `emissionDate` date DEFAULT NULL,
  `pathBill` varchar(200) DEFAULT NULL,
  `currency` varchar(10) NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `bill`
--

LOCK TABLES `bill` WRITE;
/*!40000 ALTER TABLE `bill` DISABLE KEYS */;
/*!40000 ALTER TABLE `bill` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `prestataire`
--

DROP TABLE IF EXISTS `prestataire`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
 SET character_set_client = utf8mb4 ;
CREATE TABLE `prestataire` (
  `prestataire_id` int(11) NOT NULL AUTO_INCREMENT,
  `lastname` varchar(100) NOT NULL,
  `firstname` varchar(40) NOT NULL,
  `birth_date` date DEFAULT NULL,
  `address` varchar(100) DEFAULT NULL,
  `cp` varchar(15) DEFAULT NULL,
  `city` varchar(40) DEFAULT NULL,
  `phonehome` varchar(15) DEFAULT NULL,
  `phonepro` varchar(15) DEFAULT NULL,
  `phonepers` varchar(15) DEFAULT NULL,
  `numid` varchar(15) DEFAULT NULL,
  `placeid` varchar(40) DEFAULT NULL,
  `dateid` date DEFAULT NULL,
  `qrcode` varchar(100) DEFAULT NULL,
  PRIMARY KEY (`prestataire_id`)
) ENGINE=InnoDB AUTO_INCREMENT=8 DEFAULT CHARSET=utf8;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `prestataire`
--

LOCK TABLES `prestataire` WRITE;
/*!40000 ALTER TABLE `prestataire` DISABLE KEYS */;
INSERT INTO `prestataire` VALUES (1,'elmatroro','mohamed','1999-09-12','40 rue pontoise','0','pontoise','0','0','0','0','agadir','2012-09-12','qrcodes/elmatroro.png'),(2,'matror','med','1998-02-12','1242536','0','paris','0','0','0','0','agadir','2005-08-12','qrcodes/matror.png'),(3,'matador','med','1998-05-12','30 rue les roses','95000','cergy','0789876765','0756432345','0678765434','1567865','paris','2006-09-10','qrcodes/matador.png'),(4,'elmatror','med','1999-10-12','20 rue agadir','80000','agadir','0789898767','0876676567','0876676545','1243562','agadir','2007-10-03','qrcodes/elmatror.png'),(5,'momo','momo','1999-12-10','20 rue paris','75000','paris','0789878987','0789878987','0789876765','152425426','paris','2014-12-10','qrcodes/momo.png'),(6,'zjd','jdj','1999-09-09','ajofjf','79768','paris','08898787','7989889','8989898','152425427','djdjf','2011-09-09','qrcodes/zjd.png'),(7,'med','med','1999-09-12','24 rue paris','98765','paris','0978765654','0978765654','0978765654','152425422','paris','2014-06-12','qrcodes/med.png');
/*!40000 ALTER TABLE `prestataire` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `rhs`
--

DROP TABLE IF EXISTS `rhs`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
 SET character_set_client = utf8mb4 ;
CREATE TABLE `rhs` (
  `id` smallint(5) unsigned NOT NULL AUTO_INCREMENT,
  `mail` varchar(100) NOT NULL,
  `password` varchar(20) NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=4 DEFAULT CHARSET=utf8;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `rhs`
--

LOCK TABLES `rhs` WRITE;
/*!40000 ALTER TABLE `rhs` DISABLE KEYS */;
INSERT INTO `rhs` VALUES (1,'med@calloutduty.com','medmet'),(2,'med@mail.com','medmat'),(3,'momo@mail.com','medmat');
/*!40000 ALTER TABLE `rhs` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `subscription`
--

DROP TABLE IF EXISTS `subscription`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
 SET character_set_client = utf8mb4 ;
CREATE TABLE `subscription` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `startDate` date DEFAULT NULL,
  `addressSub` varchar(45) DEFAULT NULL,
  `soldeHour` time DEFAULT NULL,
  `SubscriptionOffer_id` int(11) DEFAULT NULL,
  `Bill_id` int(11) DEFAULT NULL,
  PRIMARY KEY (`id`),
  KEY `fk_Subscription_SubscriptionOffer` (`SubscriptionOffer_id`),
  KEY `fk_Subscription_Bill` (`Bill_id`)
) ENGINE=InnoDB AUTO_INCREMENT=2 DEFAULT CHARSET=utf8;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `subscription`
--

LOCK TABLES `subscription` WRITE;
/*!40000 ALTER TABLE `subscription` DISABLE KEYS */;
INSERT INTO `subscription` VALUES (1,'2020-04-06','1','12:00:00',NULL,NULL);
/*!40000 ALTER TABLE `subscription` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `subscription_offer`
--

DROP TABLE IF EXISTS `subscription_offer`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
 SET character_set_client = utf8mb4 ;
CREATE TABLE `subscription_offer` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `name` varchar(100) DEFAULT NULL,
  `price` float DEFAULT NULL,
  `hourPerMonth` int(11) DEFAULT NULL,
  `openTime` int(11) DEFAULT NULL,
  `status` tinyint(4) DEFAULT NULL,
  `intervaltime` varchar(10) NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=110 DEFAULT CHARSET=utf8;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `subscription_offer`
--

LOCK TABLES `subscription_offer` WRITE;
/*!40000 ALTER TABLE `subscription_offer` DISABLE KEYS */;
INSERT INTO `subscription_offer` VALUES (106,'KAJEIOU',230,5,232,0,'year'),(107,'Familial',3600,6,25,0,'year'),(108,'Premium',6000,7,50,0,'year'),(109,'Base',2400,5,12,-1,'year');
/*!40000 ALTER TABLE `subscription_offer` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `users`
--

DROP TABLE IF EXISTS `users`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
 SET character_set_client = utf8mb4 ;
CREATE TABLE `users` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `name` varchar(60) NOT NULL,
  `firstname` varchar(60) NOT NULL,
  `pseudo` varchar(64) NOT NULL,
  `pwd` varchar(64) NOT NULL,
  `email` varchar(100) NOT NULL,
  `birthday` date NOT NULL,
  `gender` varchar(10) NOT NULL,
  `phone` char(11) NOT NULL,
  `status` tinyint(4) DEFAULT NULL,
  `Subscription_id` int(11) DEFAULT NULL,
  `dateRegister` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP,
  `dateUpdated` timestamp NULL DEFAULT NULL ON UPDATE CURRENT_TIMESTAMP,
  PRIMARY KEY (`id`),
  KEY `fk_User_Subscription` (`Subscription_id`)
) ENGINE=InnoDB AUTO_INCREMENT=8 DEFAULT CHARSET=utf8;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `users`
--

LOCK TABLES `users` WRITE;
/*!40000 ALTER TABLE `users` DISABLE KEYS */;
INSERT INTO `users` VALUES (2,'KAJEIOU','Mohamed','Mohamed-ESG','$2y$10$JhIAs4Hr4tEsFt8L6azYx.lm4rYgfComZtbcKBlMn8og8AjVhUfO.','m.kajeiou123@gmail.com','2000-03-24','Mr','0682286955',1,NULL,'2020-02-20 01:49:31','2020-05-03 13:06:25'),(4,'Favier','Ludovic','Ludo','$2y$10$K.BZciKaJOfUlyJvrBpNQeAS6RpDCqgePsq4XSEjpnJCxcEAy.Tye','lfavier@live.fr','1998-02-27','Mme.','0600120012',1,NULL,'2020-03-19 18:55:39','2020-05-03 13:06:29'),(5,'KAJEIOU','Mohamed','Mohamed-ESGI','$2y$10$yQjELmPSSNqZPP9daSkXO.FWx/HjV5F9YyKawRiYr9k5ySyn2RT2q','mkajeiou3@myges.fr','2000-03-24','Mr','0781575960',2,NULL,'2020-03-19 19:06:52','2020-05-03 13:06:33'),(6,'FAVIER','Ludovic','lidi','$2y$10$0rw7HWYX2LQu1SE7MOdXp.RvwhQMdWNPlUSGRE9iP.vx0HToK.jYq','lfav@live.fr','1998-03-12','M.','0699999999',2,NULL,'2020-04-13 15:26:27','2020-05-03 13:06:37'),(7,'FAVIER','Ludovic','lidii','$2y$10$4VwbRv5ZvzRbIzlP9IJPgu2g72xVbXHMgwnMYvZkP00lsllax0qMe','lfavp@live.fr','1998-05-20','M.','0655555555',3,NULL,'2020-04-14 12:43:30','2020-05-03 13:06:40');
/*!40000 ALTER TABLE `users` ENABLE KEYS */;
UNLOCK TABLES;
/*!40103 SET TIME_ZONE=@OLD_TIME_ZONE */;

/*!40101 SET SQL_MODE=@OLD_SQL_MODE */;
/*!40014 SET FOREIGN_KEY_CHECKS=@OLD_FOREIGN_KEY_CHECKS */;
/*!40014 SET UNIQUE_CHECKS=@OLD_UNIQUE_CHECKS */;
/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
/*!40111 SET SQL_NOTES=@OLD_SQL_NOTES */;

-- Dump completed on 2020-05-03 23:27:07
