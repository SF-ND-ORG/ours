-- MySQL dump 10.13  Distrib 5.7.29, for Linux (x86_64)
--
-- Host: localhost    Database: ours
-- ------------------------------------------------------
-- Server version	5.7.29-0ubuntu0.16.04.1

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
-- Table structure for table `atc`
--

DROP TABLE IF EXISTS `atc`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `atc` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `tmp_id` int(11) DEFAULT NULL,
  `name` char(20) DEFAULT NULL,
  `penname` char(20) DEFAULT NULL,
  `grade` char(4) DEFAULT NULL,
  `class_type` char(1) DEFAULT NULL,
  `class` int(11) DEFAULT NULL,
  `qq` char(20) DEFAULT NULL,
  `tel` char(20) DEFAULT NULL,
  `title` char(30) DEFAULT NULL,
  `noshow` int(11) DEFAULT NULL,
  `name_type` int(11) DEFAULT NULL,
  `tag` text,
  `link` text,
  `date` datetime DEFAULT NULL,
  `atc_type` char(1) DEFAULT NULL,
  `atc` longtext,
  `size` int(11) DEFAULT NULL,
  `mail` char(30) DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=7 DEFAULT CHARSET=utf8;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Table structure for table `atc_rbs`
--

DROP TABLE IF EXISTS `atc_rbs`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `atc_rbs` (
  `tmp_id` int(11) NOT NULL,
  `name` char(20) DEFAULT NULL,
  `penname` char(20) DEFAULT NULL,
  `grade` char(4) DEFAULT NULL,
  `class_type` char(1) DEFAULT NULL,
  `class` int(11) DEFAULT NULL,
  `qq` char(20) DEFAULT NULL,
  `tel` char(20) DEFAULT NULL,
  `title` char(30) DEFAULT NULL,
  `noshow` int(11) DEFAULT NULL,
  `name_type` int(11) DEFAULT NULL,
  `tag` text,
  `link` text,
  `date` datetime DEFAULT NULL,
  `atc_type` char(1) DEFAULT NULL,
  `atc` longtext,
  `size` int(11) DEFAULT NULL,
  `mail` char(30) DEFAULT NULL,
  PRIMARY KEY (`tmp_id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Table structure for table `atc_tag`
--

DROP TABLE IF EXISTS `atc_tag`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `atc_tag` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `tag` text,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=13 DEFAULT CHARSET=utf8;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Table structure for table `atc_tmp`
--

DROP TABLE IF EXISTS `atc_tmp`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `atc_tmp` (
  `tmp_id` int(11) NOT NULL AUTO_INCREMENT,
  `name` char(20) DEFAULT NULL,
  `penname` char(20) DEFAULT NULL,
  `grade` char(4) DEFAULT NULL,
  `class_type` char(1) DEFAULT NULL,
  `class` int(11) DEFAULT NULL,
  `qq` char(20) DEFAULT NULL,
  `tel` char(20) DEFAULT NULL,
  `title` char(30) DEFAULT NULL,
  `noshow` int(11) DEFAULT NULL,
  `name_type` int(11) DEFAULT NULL,
  `tag` text,
  `link` text,
  `date` datetime DEFAULT NULL,
  `atc_type` char(1) DEFAULT NULL,
  `atc` longtext,
  `size` int(11) DEFAULT NULL,
  `mail` char(30) DEFAULT NULL,
  PRIMARY KEY (`tmp_id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Table structure for table `follow`
--

DROP TABLE IF EXISTS `follow`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `follow` (
  `qq` varchar(50) DEFAULT NULL,
  `name` varchar(50) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Table structure for table `img`
--

DROP TABLE IF EXISTS `img`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `img` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `tmp_id` int(11) DEFAULT NULL,
  `name` char(20) DEFAULT NULL,
  `grade` char(4) DEFAULT NULL,
  `class_type` char(1) DEFAULT NULL,
  `class` int(11) DEFAULT NULL,
  `qq` char(20) DEFAULT NULL,
  `tel` char(20) DEFAULT NULL,
  `title` char(100) DEFAULT NULL,
  `noshow` int(11) DEFAULT NULL,
  `tag` text,
  `date` datetime DEFAULT NULL,
  `file_type` char(10) DEFAULT NULL,
  `height` int(11) DEFAULT NULL,
  `width` int(11) DEFAULT NULL,
  `size` int(11) DEFAULT NULL,
  `mail` char(30) DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=341 DEFAULT CHARSET=utf8;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Table structure for table `img_rbs`
--

DROP TABLE IF EXISTS `img_rbs`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `img_rbs` (
  `tmp_id` int(11) NOT NULL,
  `name` char(20) DEFAULT NULL,
  `grade` char(4) DEFAULT NULL,
  `class_type` char(1) DEFAULT NULL,
  `class` int(11) DEFAULT NULL,
  `qq` char(20) DEFAULT NULL,
  `tel` char(20) DEFAULT NULL,
  `title` char(100) DEFAULT NULL,
  `noshow` int(11) DEFAULT NULL,
  `tag` text,
  `date` datetime DEFAULT NULL,
  `file_type` char(10) DEFAULT NULL,
  `height` int(11) DEFAULT NULL,
  `width` int(11) DEFAULT NULL,
  `size` int(11) DEFAULT NULL,
  `mail` char(30) DEFAULT NULL,
  PRIMARY KEY (`tmp_id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Table structure for table `img_tag`
--

DROP TABLE IF EXISTS `img_tag`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `img_tag` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `tag` text,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=707 DEFAULT CHARSET=utf8;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Table structure for table `img_tmp`
--

DROP TABLE IF EXISTS `img_tmp`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `img_tmp` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `name` char(20) DEFAULT NULL,
  `grade` char(4) DEFAULT NULL,
  `class_type` char(1) DEFAULT NULL,
  `class` int(11) DEFAULT NULL,
  `qq` char(20) DEFAULT NULL,
  `tel` char(20) DEFAULT NULL,
  `title` char(100) DEFAULT NULL,
  `noshow` int(11) DEFAULT NULL,
  `tag` text,
  `date` datetime DEFAULT NULL,
  `file_type` char(10) DEFAULT NULL,
  `height` int(11) DEFAULT NULL,
  `width` int(11) DEFAULT NULL,
  `size` int(11) DEFAULT NULL,
  `mail` char(30) DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=430 DEFAULT CHARSET=utf8;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Table structure for table `link`
--

DROP TABLE IF EXISTS `link`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `link` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `atc` int(11) DEFAULT NULL,
  `img` int(11) DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=5 DEFAULT CHARSET=utf8;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Table structure for table `music`
--

DROP TABLE IF EXISTS `music`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `music` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `title` varchar(100) DEFAULT NULL,
  `auth` varchar(100) DEFAULT NULL,
  `site` varchar(100) DEFAULT NULL,
  `qq` varchar(100) DEFAULT NULL,
  `used` int(11) DEFAULT NULL,
  `time` datetime DEFAULT NULL,
  `img` varchar(100) DEFAULT NULL,
  `src` varchar(100) DEFAULT NULL,
  `jump` varchar(100) DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=832 DEFAULT CHARSET=utf8;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Table structure for table `probpool`
--

DROP TABLE IF EXISTS `probpool`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `probpool` (
  `probnum` int(11) NOT NULL AUTO_INCREMENT,
  `prob` varchar(500) DEFAULT NULL,
  `ans` varchar(100) DEFAULT NULL,
  PRIMARY KEY (`probnum`)
) ENGINE=InnoDB AUTO_INCREMENT=7 DEFAULT CHARSET=utf8;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Table structure for table `tmlt`
--

DROP TABLE IF EXISTS `tmlt`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `tmlt` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `from_name` char(100) DEFAULT NULL,
  `to_name` char(100) DEFAULT NULL,
  `from_qq` char(20) DEFAULT NULL,
  `from_tel` char(20) DEFAULT NULL,
  `from_mail` char(30) DEFAULT NULL,
  `to_qq` char(20) DEFAULT NULL,
  `to_tel` char(20) DEFAULT NULL,
  `to_mail` char(30) DEFAULT NULL,
  `status` int(11) DEFAULT NULL,
  `sendt` datetime DEFAULT NULL,
  `recvt` datetime DEFAULT NULL,
  `atc` longtext,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=170 DEFAULT CHARSET=utf8;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Table structure for table `zan`
--

DROP TABLE IF EXISTS `zan`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `zan` (
  `id` int(11) DEFAULT NULL,
  `zan` int(11) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Table structure for table `zanlog`
--

DROP TABLE IF EXISTS `zanlog`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `zanlog` (
  `name` varchar(30) DEFAULT NULL,
  `imgid` int(11) DEFAULT NULL,
  `time` int(11) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;
/*!40101 SET character_set_client = @saved_cs_client */;
/*!40103 SET TIME_ZONE=@OLD_TIME_ZONE */;

/*!40101 SET SQL_MODE=@OLD_SQL_MODE */;
/*!40014 SET FOREIGN_KEY_CHECKS=@OLD_FOREIGN_KEY_CHECKS */;
/*!40014 SET UNIQUE_CHECKS=@OLD_UNIQUE_CHECKS */;
/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
/*!40111 SET SQL_NOTES=@OLD_SQL_NOTES */;

-- Dump completed on 2020-09-14 22:43:18
