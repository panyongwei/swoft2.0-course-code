-- MySQL dump 10.13  Distrib 5.7.21, for osx10.9 (x86_64)
--
-- Host: localhost    Database: lv
-- ------------------------------------------------------
-- Server version	5.7.21

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
-- Table structure for table `sunny_member`
--

DROP TABLE IF EXISTS `sunny_member`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `sunny_member` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `username` varchar(45) DEFAULT NULL,
  `passwd` char(32) DEFAULT NULL COMMENT '密码',
  `views` int(11) unsigned DEFAULT '0' COMMENT '查看次数	',
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=14 DEFAULT CHARSET=utf8mb4;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `sunny_member`
--

LOCK TABLES `sunny_member` WRITE;
/*!40000 ALTER TABLE `sunny_member` DISABLE KEYS */;
INSERT INTO `sunny_member` VALUES (1,'sunnytest','sunnytestpasswd',0),(2,'a1566705853','sunny001passswd',0),(3,'sunny01','sunny001passswd',0),(4,'sunny01','sunny001passswd',0),(5,'sunny01','sunny001passswd',0),(6,'sunny01','sunny001passswd',0),(7,'sunny01','sunny001passswd',0),(8,'sunny01','sunny001passswd',0),(9,'sunny01','sunny001passswd',0),(10,'sunny01','sunny001passswd',0),(11,'sunny01','sunny001passswd',0),(12,'sunny01','sunny001passswd',0),(13,'sunny01','sunny001passswd',0);
/*!40000 ALTER TABLE `sunny_member` ENABLE KEYS */;
UNLOCK TABLES;


/*!40103 SET TIME_ZONE=@OLD_TIME_ZONE */;
/*!40101 SET SQL_MODE=@OLD_SQL_MODE */;
/*!40014 SET FOREIGN_KEY_CHECKS=@OLD_FOREIGN_KEY_CHECKS */;
/*!40014 SET UNIQUE_CHECKS=@OLD_UNIQUE_CHECKS */;
/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
/*!40111 SET SQL_NOTES=@OLD_SQL_NOTES */;

-- Dump completed on 2019-08-26 16:10:00
