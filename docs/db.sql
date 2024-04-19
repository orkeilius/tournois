-- MySQL dump 10.13  Distrib 5.5.62, for Win64 (AMD64)
--
-- Host: 127.0.0.1    Database: tournois
-- ------------------------------------------------------
-- Server version	5.5.5-10.4.33-MariaDB-1:10.4.33+maria~ubu2004

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
-- Table structure for table `admin`
--

DROP TABLE IF EXISTS `admin`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `admin` (
  `user` varchar(100) NOT NULL,
  `password` text NOT NULL,
  PRIMARY KEY (`user`)
) ENGINE=InnoDB DEFAULT CHARSET=latin1 COLLATE=latin1_swedish_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Table structure for table `game`
--

DROP TABLE IF EXISTS `game`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `game` (
  `game_id` int(10) unsigned NOT NULL AUTO_INCREMENT,
  `player1` int(10) unsigned DEFAULT NULL,
  `player2` int(10) unsigned DEFAULT NULL,
  `judge` int(10) unsigned DEFAULT NULL,
  `place` int(10) unsigned DEFAULT NULL,
  `score1` int(10) unsigned DEFAULT NULL,
  `score2` int(10) unsigned DEFAULT NULL,
  `date` time NOT NULL,
  PRIMARY KEY (`game_id`),
  KEY `game_user_FK` (`player1`),
  KEY `game_user_FK_1` (`player2`),
  KEY `game_user_FK_2` (`judge`),
  KEY `game_place_FK` (`place`),
  CONSTRAINT `game_place_FK` FOREIGN KEY (`place`) REFERENCES `place` (`place_id`) ON DELETE CASCADE,
  CONSTRAINT `game_user_FK` FOREIGN KEY (`player1`) REFERENCES `user` (`user_id`) ON DELETE CASCADE,
  CONSTRAINT `game_user_FK_1` FOREIGN KEY (`player2`) REFERENCES `user` (`user_id`) ON DELETE CASCADE,
  CONSTRAINT `game_user_FK_2` FOREIGN KEY (`judge`) REFERENCES `user` (`user_id`) ON DELETE CASCADE,
  CONSTRAINT `game_check` CHECK (`player1` <> `player2`)
) ENGINE=InnoDB AUTO_INCREMENT=7 DEFAULT CHARSET=latin1 COLLATE=latin1_swedish_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Table structure for table `place`
--

DROP TABLE IF EXISTS `place`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `place` (
  `name` varchar(100) DEFAULT NULL,
  `description` text DEFAULT NULL,
  `place_id` int(10) unsigned NOT NULL AUTO_INCREMENT,
  PRIMARY KEY (`place_id`)
) ENGINE=InnoDB AUTO_INCREMENT=5 DEFAULT CHARSET=latin1 COLLATE=latin1_swedish_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Table structure for table `user`
--

DROP TABLE IF EXISTS `user`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `user` (
  `user_id` int(10) unsigned NOT NULL AUTO_INCREMENT,
  `firstName` varchar(100) NOT NULL,
  `lastName` varchar(100) NOT NULL,
  `description` text DEFAULT NULL,
  `country` varchar(100) DEFAULT NULL,
  `role` enum('player','judge') NOT NULL,
  PRIMARY KEY (`user_id`)
) ENGINE=InnoDB AUTO_INCREMENT=20 DEFAULT CHARSET=latin1 COLLATE=latin1_swedish_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping routines for database 'tournois'
--
/*!40103 SET TIME_ZONE=@OLD_TIME_ZONE */;

/*!40101 SET SQL_MODE=@OLD_SQL_MODE */;
/*!40014 SET FOREIGN_KEY_CHECKS=@OLD_FOREIGN_KEY_CHECKS */;
/*!40014 SET UNIQUE_CHECKS=@OLD_UNIQUE_CHECKS */;
/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
/*!40111 SET SQL_NOTES=@OLD_SQL_NOTES */;

-- Dump completed on 2024-04-19  9:30:32


--  ! add admin account

INSERT INTO `user`(`user`, `password`) VALUES ('admin','$2y$10$S/njclznUmSfEd1G7SXNquQ.QsO2IkbuzQq./oWVdYU86Bc3wGEXO')
