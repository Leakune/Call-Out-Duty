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
-- Table structure for table `address`
--

DROP TABLE IF EXISTS `address`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
 SET character_set_client = utf8mb4 ;
CREATE TABLE `address` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `noStreet` int(11) DEFAULT NULL,
  `nameStreet` varchar(100) DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=2 DEFAULT CHARSET=utf8;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `address`
--

LOCK TABLES `address` WRITE;
/*!40000 ALTER TABLE `address` DISABLE KEYS */;
INSERT INTO `address` VALUES (1,24,'Bd Evasion');
/*!40000 ALTER TABLE `address` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `address_has_city`
--

DROP TABLE IF EXISTS `address_has_city`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
 SET character_set_client = utf8mb4 ;
CREATE TABLE `address_has_city` (
  `Address_id` int(11) NOT NULL,
  `City_id` int(11) NOT NULL,
  PRIMARY KEY (`Address_id`,`City_id`),
  KEY `fk_Address_has_City_City1` (`City_id`),
  CONSTRAINT `fk_Address_has_City_Address1` FOREIGN KEY (`Address_id`) REFERENCES `address` (`id`),
  CONSTRAINT `fk_Address_has_City_City1` FOREIGN KEY (`City_id`) REFERENCES `city` (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `address_has_city`
--

LOCK TABLES `address_has_city` WRITE;
/*!40000 ALTER TABLE `address_has_city` DISABLE KEYS */;
/*!40000 ALTER TABLE `address_has_city` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `admin_has_client`
--

DROP TABLE IF EXISTS `admin_has_client`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
 SET character_set_client = utf8mb4 ;
CREATE TABLE `admin_has_client` (
  `User_id` int(11) NOT NULL,
  `User_id1` int(11) NOT NULL,
  PRIMARY KEY (`User_id`,`User_id1`),
  KEY `fk_USER_has_USER_USER2` (`User_id1`),
  CONSTRAINT `fk_USER_has_USER_USER1` FOREIGN KEY (`User_id`) REFERENCES `user` (`id`),
  CONSTRAINT `fk_USER_has_USER_USER2` FOREIGN KEY (`User_id1`) REFERENCES `user` (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `admin_has_client`
--

LOCK TABLES `admin_has_client` WRITE;
/*!40000 ALTER TABLE `admin_has_client` DISABLE KEYS */;
/*!40000 ALTER TABLE `admin_has_client` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `admin_has_subscription_offer`
--

DROP TABLE IF EXISTS `admin_has_subscription_offer`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
 SET character_set_client = utf8mb4 ;
CREATE TABLE `admin_has_subscription_offer` (
  `User_id` int(11) NOT NULL,
  `SubscriptionOffer_id` int(11) NOT NULL,
  PRIMARY KEY (`User_id`,`SubscriptionOffer_id`),
  KEY `fk_USER_has_SubscriptionOffer_SubscriptionOffer1` (`SubscriptionOffer_id`),
  CONSTRAINT `fk_USER_has_SubscriptionOffer_SubscriptionOffer1` FOREIGN KEY (`SubscriptionOffer_id`) REFERENCES `subscription_offer` (`id`),
  CONSTRAINT `fk_USER_has_SubscriptionOffer_USER1` FOREIGN KEY (`User_id`) REFERENCES `user` (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `admin_has_subscription_offer`
--

LOCK TABLES `admin_has_subscription_offer` WRITE;
/*!40000 ALTER TABLE `admin_has_subscription_offer` DISABLE KEYS */;
/*!40000 ALTER TABLE `admin_has_subscription_offer` ENABLE KEYS */;
UNLOCK TABLES;

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
-- Table structure for table `category`
--

DROP TABLE IF EXISTS `category`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
 SET character_set_client = utf8mb4 ;
CREATE TABLE `category` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `name` varchar(100) DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=2 DEFAULT CHARSET=utf8;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `category`
--

LOCK TABLES `category` WRITE;
/*!40000 ALTER TABLE `category` DISABLE KEYS */;
INSERT INTO `category` VALUES (1,'normal');
/*!40000 ALTER TABLE `category` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `city`
--

DROP TABLE IF EXISTS `city`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
 SET character_set_client = utf8mb4 ;
CREATE TABLE `city` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `noDepartment` int(11) DEFAULT NULL,
  `name` varchar(100) DEFAULT NULL,
  `postcode` char(5) DEFAULT NULL,
  `Region_id` int(11) DEFAULT NULL,
  PRIMARY KEY (`id`),
  KEY `fk_City_Region` (`Region_id`),
  CONSTRAINT `fk_City_Region` FOREIGN KEY (`Region_id`) REFERENCES `region` (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=2 DEFAULT CHARSET=utf8;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `city`
--

LOCK TABLES `city` WRITE;
/*!40000 ALTER TABLE `city` DISABLE KEYS */;
INSERT INTO `city` VALUES (1,95,'Cergy','95800',1);
/*!40000 ALTER TABLE `city` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `cost_estimate`
--

DROP TABLE IF EXISTS `cost_estimate`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
 SET character_set_client = utf8mb4 ;
CREATE TABLE `cost_estimate` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `emissionDate` date DEFAULT NULL,
  `pathCostEstimate` varchar(200) DEFAULT NULL,
  `Bill_id` int(11) DEFAULT NULL,
  PRIMARY KEY (`id`),
  KEY `fk_CostEstimate_Bill` (`Bill_id`),
  CONSTRAINT `fk_CostEstimate_Bill` FOREIGN KEY (`Bill_id`) REFERENCES `bill` (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `cost_estimate`
--

LOCK TABLES `cost_estimate` WRITE;
/*!40000 ALTER TABLE `cost_estimate` DISABLE KEYS */;
/*!40000 ALTER TABLE `cost_estimate` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `region`
--

DROP TABLE IF EXISTS `region`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
 SET character_set_client = utf8mb4 ;
CREATE TABLE `region` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `name` varchar(100) DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=2 DEFAULT CHARSET=utf8;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `region`
--

LOCK TABLES `region` WRITE;
/*!40000 ALTER TABLE `region` DISABLE KEYS */;
INSERT INTO `region` VALUES (1,'île de France');
/*!40000 ALTER TABLE `region` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `reservation`
--

DROP TABLE IF EXISTS `reservation`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
 SET character_set_client = utf8mb4 ;
CREATE TABLE `reservation` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `dateCreation` date DEFAULT NULL,
  `duration` time DEFAULT NULL,
  `amount` float DEFAULT NULL,
  `dateMeeting` date DEFAULT NULL,
  `CostEstimate_id` int(11) DEFAULT NULL,
  `User_id` int(11) DEFAULT NULL,
  `Service_id` int(11) DEFAULT NULL,
  PRIMARY KEY (`id`),
  KEY `fk_Reservation_CostEstimate1` (`CostEstimate_id`),
  KEY `fk_Reservation_User1` (`User_id`),
  KEY `fk_Reservation_Service1` (`Service_id`),
  CONSTRAINT `fk_Reservation_CostEstimate1` FOREIGN KEY (`CostEstimate_id`) REFERENCES `cost_estimate` (`id`),
  CONSTRAINT `fk_Reservation_Service1` FOREIGN KEY (`Service_id`) REFERENCES `service` (`id`),
  CONSTRAINT `fk_Reservation_User1` FOREIGN KEY (`User_id`) REFERENCES `user` (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `reservation`
--

LOCK TABLES `reservation` WRITE;
/*!40000 ALTER TABLE `reservation` DISABLE KEYS */;
/*!40000 ALTER TABLE `reservation` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `service`
--

DROP TABLE IF EXISTS `service`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
 SET character_set_client = utf8mb4 ;
CREATE TABLE `service` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `name` varchar(100) DEFAULT NULL,
  `price` float DEFAULT NULL,
  `description` text,
  `Category_id` int(11) DEFAULT NULL,
  PRIMARY KEY (`id`),
  KEY `fk_Service_Category1` (`Category_id`),
  CONSTRAINT `fk_Service_Category1` FOREIGN KEY (`Category_id`) REFERENCES `category` (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=2 DEFAULT CHARSET=utf8;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `service`
--

LOCK TABLES `service` WRITE;
/*!40000 ALTER TABLE `service` DISABLE KEYS */;
INSERT INTO `service` VALUES (1,'plombier',20,'Répare les canalisations',1);
/*!40000 ALTER TABLE `service` ENABLE KEYS */;
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
  KEY `fk_Subscription_Bill` (`Bill_id`),
  CONSTRAINT `fk_Subscription_Bill` FOREIGN KEY (`Bill_id`) REFERENCES `bill` (`id`),
  CONSTRAINT `fk_Subscription_SubscriptionOffer` FOREIGN KEY (`SubscriptionOffer_id`) REFERENCES `subscription_offer` (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `subscription`
--

LOCK TABLES `subscription` WRITE;
/*!40000 ALTER TABLE `subscription` DISABLE KEYS */;
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
  `openTime` varchar(30) DEFAULT NULL,
  `hourPerMonth` int(11) DEFAULT NULL,
  `price` float DEFAULT NULL,
  `name` varchar(100) DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=3 DEFAULT CHARSET=utf8;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `subscription_offer`
--

LOCK TABLES `subscription_offer` WRITE;
/*!40000 ALTER TABLE `subscription_offer` DISABLE KEYS */;
INSERT INTO `subscription_offer` VALUES (1,'7',30,2600,'premium'),(2,'7',30,2600,'premium');
/*!40000 ALTER TABLE `subscription_offer` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `user`
--

DROP TABLE IF EXISTS `user`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
 SET character_set_client = utf8mb4 ;
CREATE TABLE `user` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `name` varchar(60) DEFAULT NULL,
  `firstName` varchar(60) DEFAULT NULL,
  `pwd` varchar(50) DEFAULT NULL,
  `email` varchar(100) DEFAULT NULL,
  `birthday` date DEFAULT NULL,
  `gender` varchar(5) DEFAULT NULL,
  `phone` char(14) DEFAULT NULL,
  `address` varchar(200) DEFAULT NULL,
  `qrCode` varchar(200) DEFAULT NULL,
  `status` tinyint(4) DEFAULT NULL,
  `dateRegister` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP,
  `dateUpdated` timestamp NULL DEFAULT NULL ON UPDATE CURRENT_TIMESTAMP,
  `Subscription_id` int(11) DEFAULT NULL,
  PRIMARY KEY (`id`),
  KEY `fk_User_Subscription` (`Subscription_id`),
  CONSTRAINT `fk_User_Subscription` FOREIGN KEY (`Subscription_id`) REFERENCES `subscription` (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=2 DEFAULT CHARSET=utf8;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `user`
--

LOCK TABLES `user` WRITE;
/*!40000 ALTER TABLE `user` DISABLE KEYS */;
INSERT INTO `user` VALUES (1,'admin120 0','adminfn1','pwda1','email@adp1.fr','2020-06-06','homme','7777777777','rue p1',NULL,1,'2020-03-16 17:28:31',NULL,NULL);
/*!40000 ALTER TABLE `user` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `user_has_address`
--

DROP TABLE IF EXISTS `user_has_address`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
 SET character_set_client = utf8mb4 ;
CREATE TABLE `user_has_address` (
  `User_id` int(11) NOT NULL,
  `Address_id` int(11) NOT NULL,
  PRIMARY KEY (`User_id`,`Address_id`),
  KEY `fk_USER_has_Address_Address` (`Address_id`),
  CONSTRAINT `fk_USER_has_Address_Address` FOREIGN KEY (`Address_id`) REFERENCES `address` (`id`),
  CONSTRAINT `fk_USER_has_Address_USER` FOREIGN KEY (`User_id`) REFERENCES `user` (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `user_has_address`
--

LOCK TABLES `user_has_address` WRITE;
/*!40000 ALTER TABLE `user_has_address` DISABLE KEYS */;
INSERT INTO `user_has_address` VALUES (1,1);
/*!40000 ALTER TABLE `user_has_address` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `user_has_service`
--

DROP TABLE IF EXISTS `user_has_service`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
 SET character_set_client = utf8mb4 ;
CREATE TABLE `user_has_service` (
  `User_id` int(11) NOT NULL,
  `Service_id` int(11) NOT NULL,
  PRIMARY KEY (`User_id`,`Service_id`),
  KEY `fk_User_has_Service_Service1` (`Service_id`),
  CONSTRAINT `fk_User_has_Service_Service1` FOREIGN KEY (`Service_id`) REFERENCES `service` (`id`),
  CONSTRAINT `fk_User_has_Service_User` FOREIGN KEY (`User_id`) REFERENCES `user` (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `user_has_service`
--

LOCK TABLES `user_has_service` WRITE;
/*!40000 ALTER TABLE `user_has_service` DISABLE KEYS */;
INSERT INTO `user_has_service` VALUES (1,1);
/*!40000 ALTER TABLE `user_has_service` ENABLE KEYS */;
UNLOCK TABLES;
/*!40103 SET TIME_ZONE=@OLD_TIME_ZONE */;

/*!40101 SET SQL_MODE=@OLD_SQL_MODE */;
/*!40014 SET FOREIGN_KEY_CHECKS=@OLD_FOREIGN_KEY_CHECKS */;
/*!40014 SET UNIQUE_CHECKS=@OLD_UNIQUE_CHECKS */;
/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
/*!40111 SET SQL_NOTES=@OLD_SQL_NOTES */;

-- Dump completed on 2020-03-17 12:05:09
