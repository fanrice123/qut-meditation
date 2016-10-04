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
-- Current Database: `meditation`
--

CREATE DATABASE /*!32312 IF NOT EXISTS*/ `meditation` /*!40100 DEFAULT CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci */;

USE `meditation`;

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
INSERT INTO `classtable` VALUES (30,13),(31,1),(30,1),(35,1);
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
) ENGINE=InnoDB AUTO_INCREMENT=37 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `course`
--

LOCK TABLES `course` WRITE;
/*!40000 ALTER TABLE `course` DISABLE KEYS */;
INSERT INTO `course` VALUES (30,'2016-10-06',10,'2016-10-15'),(31,'2016-09-30',3,'2016-10-02'),(32,'2016-09-15',30,'2016-10-14'),(34,'2016-10-08',10,'2016-10-17'),(35,'2016-10-18',10,'2016-10-27'),(36,'2016-11-28',3,'2016-11-30');
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
-- Table structure for table `report`
--

DROP TABLE IF EXISTS `report`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `report` (
  `reportID` int(11) NOT NULL AUTO_INCREMENT,
  `courseID` int(11) NOT NULL,
  `studentID` int(11) NOT NULL,
  `title` varchar(150) COLLATE utf8mb4_unicode_ci NOT NULL,
  `content` text COLLATE utf8mb4_unicode_ci NOT NULL,
  `date` date NOT NULL,
  PRIMARY KEY (`reportID`),
  KEY `courseID` (`courseID`),
  KEY `studentID` (`studentID`),
  CONSTRAINT `report_ibfk_1` FOREIGN KEY (`courseID`) REFERENCES `course` (`courseID`),
  CONSTRAINT `report_ibfk_2` FOREIGN KEY (`studentID`) REFERENCES `user` (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=4 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `report`
--

LOCK TABLES `report` WRITE;
/*!40000 ALTER TABLE `report` DISABLE KEYS */;
INSERT INTO `report` VALUES (2,31,1,'Test','# Heading 1 #\r\n\r\nParagraphs are separated by a blank line.\r\n\r\n2nd paragraph. *Italic*, **bold**, `monospace`. Itemized lists\r\nlook like:\r\n\r\n  * this one\r\n  * that one\r\n  * the other one\r\n\r\nNote that --- not considering the asterisk --- the actual text\r\ncontent starts at 3-columns in.\r\n\r\n> Block quotes are\r\n> written like so.\r\n>\r\n> They can span multiple paragraphs,\r\n> if you like.\r\n\r\nWith `smartyPants` set to true in the markdown module configuration, you can \r\nformat your content smartly:\r\n\r\n - Use 3 dashes `---` for an em-dash. (e.g. Note --- Its a cool day)\r\n - Use 2 dashes `--` for an en-dash or ranges (e.g. \"It\'s all in chapters 12--14\"). \r\n - Three dots `...` will be converted to an ellipsis. (e.g. He goes on and on ...)\r\n - Straight quotes ( `\"` and `\'` ) will be converted to \"curly double\" and \'curly single\'\r\n - Backticks-style quotes (<code>``like this\'\'</code>) will be shown as curly entities as well\r\n \r\n  \r\n## Heading 2 ##\r\n\r\nHere is a numbered list:\r\n\r\n1. first item\r\n2. second item\r\n3. third item\r\n\r\nNote again how the actual text starts at 3 columns in (3 characters\r\nfrom the left side). \r\n\r\nHere\'s a code block sample:\r\n\r\n    # Let me re-iterate ...\r\n    for i in 1 .. 10 { do-something(i) }\r\n\r\nAs you probably guessed, indented 4 spaces. By the way, instead of\r\nindenting the block, you can use delimited blocks, if you like:\r\n\r\n~~~\r\ndefine foobar() {\r\n    print \"Welcome to flavor country!\";\r\n}\r\n~~~\r\n\r\n(which makes copying & pasting easier). You can optionally mark the\r\ndelimited block for syntax highlighting with any code pretty CSS framework.\r\n\r\n~~~python\r\nimport time\r\n# Quick, count to ten!\r\nfor i in range(10):\r\n    # (but not *too* quick)\r\n    time.sleep(0.5)\r\n    print i\r\n~~~\r\n\r\n  \r\n### Heading 3 ###\r\n\r\nNow a nested list:\r\n\r\n1. First, get these ingredients: \r\n   - carrots\r\n   - celery\r\n   - lentils\r\n\r\n2. Boil some water.\r\n\r\n3. Dump everything in the pot and follow  \r\n   this algorithm:\r\n   - find wooden spoon \r\n   - manage pot\r\n      - uncover pot  \r\n      - stir  \r\n      - cover pot  \r\n      - balance wooden spoon precariously on pot handle  \r\n   - wait 10 minutes \r\n   - goto first step (or shut off burner when done) \r\n   \r\n* Do not bump wooden spoon or it will fall.\r\n\r\nNotice again how text always lines up on at 3-space indents (including\r\nthat last line which continues item 3 above). \r\n\r\nHere\'s a link to [a website](http://foo.bar). Here\'s a link to a [local\r\ndoc](local-doc.html). Here\'s a footnote [^1].\r\n\r\n[^1]: Footnote text goes here.\r\n\r\n### Tables ###\r\n\r\nTables can look like this:\r\n\r\nsize | material     | color\r\n---- | ------------ | ------------\r\n9    | leather      | brown\r\n10   | hemp canvas  | natural\r\n11   | glass        | transparent\r\n\r\nYou can specify alignment for each column by adding colons to separator lines. \r\nA colon at the left of the separator line will make the column left-aligned; a \r\ncolon on the right of the line will make the column right-aligned; colons at both \r\nside means the column is center-aligned.\r\n\r\n| Item      | Description | Value|\r\n|:--------- |:-----------:|-----:|\r\n| Computer  | Desktop PC  |$1600 |\r\n| Phone     | iPhone 5s   |  $12 |\r\n| Pipe      | Steel Pipe  |   $1 |\r\n\r\nYou can apply span-level formatting to the content of each cell using regular Markdown syntax:\r\n\r\n| Function name | Description                    |\r\n| ------------- | ------------------------------ |\r\n| `help()`      | Display the help window.       |\r\n| `destroy()`   | **Destroy your computer!**     |\r\n\r\n### Definition Lists ###\r\n\r\nApple\r\n   : Pomaceous fruit of plants of the genus Malus in \r\n   the family Rosaceae.\r\n  \r\nOrange\r\n   : The fruit of an evergreen tree of the genus Citrus.  \r\n  \r\nTomatoes\r\n   : There\'s no \"e\" in tomato.\r\n\r\nYou can put blank lines in between each of the above definition list lines to spread things\r\nout more.\r\n\r\nApple\r\n\r\n:   Pomaceous fruit of plants of the genus Malus in \r\n    the family Rosaceae.\r\n\r\nOrange\r\n\r\n:   The fruit of an evergreen tree of the genus Citrus.\r\n\r\nTomatoes\r\n\r\n  : There\'s no \"e\" in tomato.  \r\n\r\nYou can also associate more than one term to a definition:\r\n\r\nTerm 1\r\nTerm 2\r\n\r\n:   Definition a\r\n\r\nTerm 3\r\n\r\n:   Definition b\r\n\r\n\r\n### Other ###\r\n\r\n#### Abbreviations ####\r\n\r\n(Note heading 4 above)\r\n\r\nMarkdown Extra adds supports for abbreviations. How it works is pretty simple: \r\n\r\nCreate an abbreviation definition like this:\r\n~~~\r\n*[HTML]: Hyper Text Markup Language\r\n*[W3C]:  World Wide Web Consortium\r\n~~~\r\n\r\n*[HTML]: Hyper Text Markup Language\r\n*[W3C]:  World Wide Web Consortium\r\n\r\nthen, elsewhere in the document, write text such as:\r\n\r\nThe HTML specification\r\nis maintained by the W3C.\r\n\r\nand watch how the instance of those words in the text are highlighted.\r\n\r\nClosing line below.\r\n\r\n---\r\n\r\n##### Done. #####\r\n','2016-10-02'),(3,31,1,'Test2','># Heading 2 #\r\n\r\n\r\n***test2*** is just testing the paragraph.\r\n---\r\n- test3- content.\r\n\r\n','2016-10-02');
/*!40000 ALTER TABLE `report` ENABLE KEYS */;
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
  `banned` tinyint(1) NOT NULL DEFAULT '0',
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
) ENGINE=InnoDB AUTO_INCREMENT=15 DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `user`
--

LOCK TABLES `user` WRITE;
/*!40000 ALTER TABLE `user` DISABLE KEYS */;
INSERT INTO `user` VALUES (1,'admin123',0,1,'Admin','Istrator','LnOv87CVH320bAemt3zrwXL6kPkEMaYk','$2y$13$wH9ETEBeMGim6Wf3rqzD5usLSmGkqkqcnMsPCumIgOZ5GyIPezbs2',NULL,'test@gmail.com','1995-07-12','female','61477888999',NULL,10,1473412170,1475222162,'103, Wickham Terrace',9999,'QLD','Brisbane',1,'test2\r\neafsf \r\nfaef\r\n f\r\nawefew\r\nf a\r\nf es\r\n f\r\nfew\r\naf','test'),(3,'test123',0,0,'aeffaf','Faffef','X2zXMs4OFJmIbNOP_SvmI1CTJIvZl2JD','$2y$13$KcFOQOVPn3bbFr38qa8.8ONN77KblfQVXHpCC.MJBzOEVixj2yv6G',NULL,'wsfewf@gmmm.com','2016-09-01','male','525256255522',NULL,10,1473441763,1473441763,'efgsdfgsvserfseg res grsgsdfg sdfg sfdg ',5454,'sfes','sdf gvsdg sreg',0,NULL,NULL),(4,'benNERD',0,0,'bebebebe','lalalala','3UdeCb0atfDZ3IjgjfrBdaCing9Ot9wI','$2y$13$qAwvY3Mjns.7t0bHDIf4PORsz.FnZAGpv7Do/mfSfedsRJ4hU6IUu',NULL,'baaaa222@yahoo.com','0000-00-00','other','01212354',NULL,10,1473482211,1473482211,'wefaawefawefawefawe',3432,'erar','swag',0,NULL,NULL),(5,'abcdefg',0,0,'Tee','TA','BLybGtjxTYHlZ_qcaCuNrMm2pxcm-LKH','$2y$13$96ThALz8QZ./Cl3cpqO1SuPT9FlHxykMbkj4raafOKEbzlA3qhRnu',NULL,'ttt@yahoo.com','0000-00-00','other','55462421342434',NULL,10,1474350139,1474350139,'wefsdvf wfas sfg  gg cx',3435,'fase','dfe ef sfs',0,NULL,NULL),(6,'test111',0,0,'ttt','eee','GqzG9M69eDDGTyaMy2eT0R5eIk-qH6fc','$2y$13$x1dphFzAbeoPz6Ube1sw9e5pBEn07kN7cKY2FfcdKB4PWZw5CIsuu',NULL,'test101@yahoo.com','0000-00-00','other','342426525245',NULL,10,1474381914,1475314625,'awerfa3 4r fagfw3se faef3',4322,'rgdg','wef 3w4r ',0,NULL,NULL),(8,'test1',0,0,'BBB','CCC','vCRBGUgiao8rlUwGTxuGIhq35XTF3L0h','$2y$13$bE9zPel0ItDDb3gIsOyRt.Skr8EYd1Opluam4N2ntSsdgOdTpGPf.',NULL,'1111eed@gmail.com','2004-12-01','female','23434515','',10,1474405694,1474405694,'awefr3 4t3rfar4r3arfa3wr2',3424,'rege','awefae rfeaw',1,'',''),(9,'test2',0,0,'CCC','BBB','lyu6_5_1__HbO6DyXhByoCzgmcrbwWZ2','$2y$13$N1VLayfEsEXn0W6Tta8JmuNNAC1NrNW2Srs4KvBc633OjvHWkiJjW',NULL,'vvv@kamen.com','1908-11-26','female','3453452342',NULL,10,1474409916,1474409916,'3rfserfse rfref s',3424,'awef','wefawef aw',1,NULL,NULL),(10,'test3',0,0,'xxxxx','yyyyy','Wp4oDagETwPOA0ntchu2ZiyWH8-EN6iA','$2y$13$E6SJnbVKxSiC7Ynj3HKBMu.yKaZMQq3RmhLHlpp.kVq/KCIg95/8O',NULL,'tete@gmail.com','1994-07-05','female','342342523',NULL,10,1474410153,1474410153,'awefweafawe fa efsefdzv',3224,'wef ','zzefew fw',1,NULL,NULL),(11,'qqqq',0,0,'zzz','xxx','3btW4kvjtEtSwH6h050aU0THIPOfgWzg','$2y$13$/hBoOixGJ9NDvNH4Evek9uU3/BnRyBuiLoCPEbJ5LkT0/qfFYLEPa',NULL,'wfwe@ggg.com','2016-09-14','other','2423452454253',NULL,10,1474410335,1474410335,'awefwae fweafsfsefsfgefaf a',2321,'zsdf','awfda efawf',1,NULL,NULL),(12,'testa',0,0,'qwedfwef','awdaw da','KV8-hrTcBZPfZ2wXNgHzTE23y2mw9JeL','$2y$13$DCnuXFokISa76MfvSmmAh.nTETbSQtJBNTYLX1JsOZyFpy3SCkc3q',NULL,'efw@ggg.om','2016-09-14','male','2342535234141',NULL,10,1474410472,1474410472,'awef awefaw',3321,'awef','awef wefa fewaf aw',1,'awefawe fweaf vfsdbdfgbdrtbdxtgb hstgs4e5rg3a 4 tf4aw3','ef 3a4f g4egfvrseg re grg\r\nr grg\r\n s\r\ng s\r\n'),(13,'test1234',0,1,'Royce','Fan','5djDFFxqNIUVXSfDV8Qn3IJ2ZC7HuYZi','$2y$13$sw0jtqxcVQ2e8ukaE1KcKu.9mjbPoYpWh8Q5WJMSXe8BwtfuXJh/G',NULL,'fch@ayaya.com','1994-10-25','male','234342',NULL,10,1474628352,1474628352,'afwfwwef eaf few',2321,'wef','awefea ewfae ffew',1,'fa wefea fewaf e f','efaew feaw fewa fewaefwf'),(14,'Last',0,1,'Jenny','Sabaski','NXrwzIPlDf0LOgMhc3GDEwW9OIwp1PrN','$2y$13$zG0NhCaY7N7SHa1BLWLPzer0k/sdhqT5sA6zMsZ.ytY4ApB6MSybG',NULL,'jenny.love@gmail.com','1993-12-01','female','61424777948','',10,1475149874,1475149874,'11, Jalan Ampang',4000,'QLD','Ampang',0,'','');
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
INSERT INTO `volunteer` VALUES (1,31),(1,34),(6,30),(1,32),(1,35);
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

-- Dump completed on 2016-10-05  1:52:49
