-- MySQL dump 10.16  Distrib 10.1.16-MariaDB, for Win32 (AMD64)
--
-- Host: localhost    Database: meditation
-- ------------------------------------------------------
-- Server version	10.1.16-MariaDB

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
-- Table structure for table `classtable`
--

DROP TABLE IF EXISTS `classtable`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `classtable` (
  `courseID` int(11) NOT NULL,
  `studentID` int(11) NOT NULL,
  KEY `studentID` (`studentID`),
  KEY `courseID` (`courseID`),
  CONSTRAINT `classtable_ibfk_1` FOREIGN KEY (`studentID`) REFERENCES `user` (`id`),
  CONSTRAINT `classtable_ibfk_2` FOREIGN KEY (`courseID`) REFERENCES `course` (`courseID`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `classtable`
--

LOCK TABLES `classtable` WRITE;
/*!40000 ALTER TABLE `classtable` DISABLE KEYS */;
/*!40000 ALTER TABLE `classtable` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `course`
--

DROP TABLE IF EXISTS `course`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `course` (
  `courseID` int(11) NOT NULL AUTO_INCREMENT,
  `start` date NOT NULL,
  `duration` int(11) NOT NULL,
  `end` date NOT NULL,
  PRIMARY KEY (`courseID`)
) ENGINE=InnoDB AUTO_INCREMENT=31 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `course`
--

LOCK TABLES `course` WRITE;
/*!40000 ALTER TABLE `course` DISABLE KEYS */;
INSERT INTO `course` VALUES (30,'2016-10-06',10,'2016-10-16');
/*!40000 ALTER TABLE `course` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `migration`
--

DROP TABLE IF EXISTS `migration`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `migration` (
  `version` varchar(180) CHARACTER SET utf8 COLLATE utf8_unicode_520_ci NOT NULL,
  `apply_time` int(11) DEFAULT NULL,
  PRIMARY KEY (`version`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `migration`
--

LOCK TABLES `migration` WRITE;
/*!40000 ALTER TABLE `migration` DISABLE KEYS */;
INSERT INTO `migration` VALUES ('m000000_000000_base',1473403432),('m130524_201442_init',1473403438);
/*!40000 ALTER TABLE `migration` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `user`
--

DROP TABLE IF EXISTS `user`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `user` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `username` varchar(255) COLLATE utf8_unicode_ci NOT NULL,
  `admin` tinyint(1) NOT NULL,
  `firstName` varchar(40) COLLATE utf8_unicode_ci NOT NULL,
  `lastName` varchar(40) COLLATE utf8_unicode_ci NOT NULL,
  `auth_key` varchar(32) COLLATE utf8_unicode_ci NOT NULL,
  `password_hash` varchar(255) COLLATE utf8_unicode_ci NOT NULL,
  `password_reset_token` varchar(255) COLLATE utf8_unicode_ci DEFAULT NULL,
  `email` varchar(255) COLLATE utf8_unicode_ci NOT NULL,
  `dob` date NOT NULL,
  `gender` varchar(6) COLLATE utf8_unicode_ci NOT NULL,
  `phone` varchar(20) COLLATE utf8_unicode_ci NOT NULL,
  `tel` varchar(20) COLLATE utf8_unicode_ci DEFAULT NULL,
  `status` smallint(6) NOT NULL DEFAULT '10',
  `created_at` int(11) NOT NULL,
  `updated_at` int(11) NOT NULL,
  `address` varchar(250) COLLATE utf8_unicode_ci NOT NULL,
  `postcode` smallint(6) NOT NULL,
  `state` varchar(4) COLLATE utf8_unicode_ci NOT NULL,
  `suburb` varchar(50) COLLATE utf8_unicode_ci NOT NULL,
  `vegan` tinyint(1) NOT NULL,
  `allergies` varchar(255) COLLATE utf8_unicode_ci DEFAULT NULL,
  `medicInfo` varchar(255) COLLATE utf8_unicode_ci DEFAULT NULL,
  PRIMARY KEY (`id`),
  UNIQUE KEY `username` (`username`),
  UNIQUE KEY `email` (`email`),
  UNIQUE KEY `password_reset_token` (`password_reset_token`)
) ENGINE=InnoDB AUTO_INCREMENT=13 DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `user`
--

LOCK TABLES `user` WRITE;
/*!40000 ALTER TABLE `user` DISABLE KEYS */;
INSERT INTO `user` VALUES (1,'admin123',1,'Admin','Nistrator','LnOv87CVH320bAemt3zrwXL6kPkEMaYk','$2y$13$wH9ETEBeMGim6Wf3rqzD5usLSmGkqkqcnMsPCumIgOZ5GyIPezbs2',NULL,'test@gmail.com','1995-07-11','male','61477888999',NULL,10,1473412170,1473412170,'103, Wickham Terrace',4000,'QLD','Brisbane',0,'',''),(3,'test123',0,'aeffaf','Faffef','X2zXMs4OFJmIbNOP_SvmI1CTJIvZl2JD','$2y$13$KcFOQOVPn3bbFr38qa8.8ONN77KblfQVXHpCC.MJBzOEVixj2yv6G',NULL,'wsfewf@gmmm.com','2016-09-01','male','525256255522',NULL,10,1473441763,1473441763,'efgsdfgsvserfseg res grsgsdfg sdfg sfdg ',5454,'sfes','sdf gvsdg sreg',0,NULL,NULL),(4,'benNERD',0,'bebebebe','lalalala','3UdeCb0atfDZ3IjgjfrBdaCing9Ot9wI','$2y$13$qAwvY3Mjns.7t0bHDIf4PORsz.FnZAGpv7Do/mfSfedsRJ4hU6IUu',NULL,'baaaa222@yahoo.com','0000-00-00','other','01212354',NULL,10,1473482211,1473482211,'wefaawefawefawefawe',3432,'erar','swag',0,NULL,NULL),(5,'abcdefg',0,'Tee','TA','BLybGtjxTYHlZ_qcaCuNrMm2pxcm-LKH','$2y$13$96ThALz8QZ./Cl3cpqO1SuPT9FlHxykMbkj4raafOKEbzlA3qhRnu',NULL,'ttt@yahoo.com','0000-00-00','other','55462421342434',NULL,10,1474350139,1474350139,'wefsdvf wfas sfg  gg cx',3435,'fase','dfe ef sfs',0,NULL,NULL),(6,'test111',0,'ttt','eee','jtz6fkqs4DSIyRoZj8aW0ahUPeCniR4P','$2y$13$yIuI8zvZiuCyycN07KSgauItWFiDaqenSiXyG/IYQoMERR.RwEYOy',NULL,'sttt@yahoo.com','0000-00-00','other','342426525245',NULL,10,1474381914,1474381914,'awerfa3 4r fagfw3se faef3',4322,'rgdg','wef 3w4r ',0,NULL,NULL),(8,'test1',0,'BBB','CCC','vCRBGUgiao8rlUwGTxuGIhq35XTF3L0h','$2y$13$bE9zPel0ItDDb3gIsOyRt.Skr8EYd1Opluam4N2ntSsdgOdTpGPf.',NULL,'1111eed@gmail.com','2004-12-01','female','23434515','',10,1474405694,1474405694,'awefr3 4t3rfar4r3arfa3wr2',3424,'rege','awefae rfeaw',1,'',''),(9,'test2',0,'CCC','BBB','lyu6_5_1__HbO6DyXhByoCzgmcrbwWZ2','$2y$13$N1VLayfEsEXn0W6Tta8JmuNNAC1NrNW2Srs4KvBc633OjvHWkiJjW',NULL,'vvv@kamen.com','1908-11-26','female','3453452342',NULL,10,1474409916,1474409916,'3rfserfse rfref s',3424,'awef','wefawef aw',1,NULL,NULL),(10,'test3',0,'xxxxx','yyyyy','Wp4oDagETwPOA0ntchu2ZiyWH8-EN6iA','$2y$13$E6SJnbVKxSiC7Ynj3HKBMu.yKaZMQq3RmhLHlpp.kVq/KCIg95/8O',NULL,'tete@gmail.com','1994-07-05','female','342342523',NULL,10,1474410153,1474410153,'awefweafawe fa efsefdzv',3224,'wef ','zzefew fw',1,NULL,NULL),(11,'qqqq',0,'zzz','xxx','3btW4kvjtEtSwH6h050aU0THIPOfgWzg','$2y$13$/hBoOixGJ9NDvNH4Evek9uU3/BnRyBuiLoCPEbJ5LkT0/qfFYLEPa',NULL,'wfwe@ggg.com','2016-09-14','other','2423452454253',NULL,10,1474410335,1474410335,'awefwae fweafsfsefsfgefaf a',2321,'zsdf','awfda efawf',1,NULL,NULL),(12,'testa',0,'qwedfwef','awdaw da','KV8-hrTcBZPfZ2wXNgHzTE23y2mw9JeL','$2y$13$DCnuXFokISa76MfvSmmAh.nTETbSQtJBNTYLX1JsOZyFpy3SCkc3q',NULL,'efw@ggg.om','2016-09-14','male','2342535234141',NULL,10,1474410472,1474410472,'awef awefaw',3321,'awef','awef wefa fewaf aw',1,'awefawe fweaf vfsdbdfgbdrtbdxtgb hstgs4e5rg3a 4 tf4aw3','ef 3a4f g4egfvrseg re grg\r\nr grg\r\n s\r\ng s\r\n');
/*!40000 ALTER TABLE `user` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `volunteer`
--

DROP TABLE IF EXISTS `volunteer`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `volunteer` (
  `studentID` int(11) NOT NULL,
  `courseID` int(11) NOT NULL,
  KEY `studentID` (`studentID`),
  KEY `courseID` (`courseID`),
  CONSTRAINT `volunteer_ibfk_1` FOREIGN KEY (`studentID`) REFERENCES `user` (`id`),
  CONSTRAINT `volunteer_ibfk_2` FOREIGN KEY (`courseID`) REFERENCES `course` (`courseID`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `volunteer`
--

LOCK TABLES `volunteer` WRITE;
/*!40000 ALTER TABLE `volunteer` DISABLE KEYS */;
/*!40000 ALTER TABLE `volunteer` ENABLE KEYS */;
UNLOCK TABLES;
/*!40103 SET TIME_ZONE=@OLD_TIME_ZONE */;

/*!40101 SET SQL_MODE=@OLD_SQL_MODE */;
/*!40014 SET FOREIGN_KEY_CHECKS=@OLD_FOREIGN_KEY_CHECKS */;
/*!40014 SET UNIQUE_CHECKS=@OLD_UNIQUE_CHECKS */;
/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
/*!40111 SET SQL_NOTES=@OLD_SQL_NOTES */;

-- Dump completed on 2016-09-23  2:15:14
