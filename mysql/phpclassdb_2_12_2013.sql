CREATE DATABASE  IF NOT EXISTS `phpclassdb` /*!40100 DEFAULT CHARACTER SET utf8 */;
USE `phpclassdb`;
-- MySQL dump 10.13  Distrib 5.5.16, for Win32 (x86)
--
-- Host: localhost    Database: phpclassdb
-- ------------------------------------------------------
-- Server version	5.5.27

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
-- Table structure for table `course_t`
--

DROP TABLE IF EXISTS `course_t`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `course_t` (
  `course_crn` int(5) NOT NULL,
  `course_desc` text,
  `course_code` varchar(45) DEFAULT NULL,
  PRIMARY KEY (`course_crn`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `course_t`
--

LOCK TABLES `course_t` WRITE;
/*!40000 ALTER TABLE `course_t` DISABLE KEYS */;
INSERT INTO `course_t` VALUES (45549,'Desn & Implement. Database','3071'),(45550,'Open Source Appl Dev.','3072'),(45551,'Sys Implement.Test & Mainten,','3071'),(52820,'Game Development','3064');
/*!40000 ALTER TABLE `course_t` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `user_t`
--

DROP TABLE IF EXISTS `user_t`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `user_t` (
  `employee_id` int(32) NOT NULL AUTO_INCREMENT,
  `first_name` varchar(45) DEFAULT NULL,
  `last_name` varchar(45) DEFAULT NULL,
  `username` varchar(45) DEFAULT NULL,
  `password` varchar(45) DEFAULT NULL,
  `admin` bit DEFAULT 0,
  PRIMARY KEY (`employee_id`)
) ENGINE=InnoDB AUTO_INCREMENT=4 DEFAULT CHARSET=utf8;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `user_t`
--

LOCK TABLES `user_t` WRITE;
/*!40000 ALTER TABLE `user_t` DISABLE KEYS */;
INSERT INTO `user_t` VALUES (100000001,'','','admin','password',1),(100323437,'Biljana','Vucetic','Vucetic','comp3072',0),(100323438,'Prezemyslaw','Pawluk','Pawluk','comp3072',0),(100323439,'Rajib','Verma','Verma','comp3072',0),(100323440,'Abid','Rana','Rana','comp3072',0);
/*!40000 ALTER TABLE `user_t` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `room_t`
--

DROP TABLE IF EXISTS `room_t`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `room_t` (
  `room_id` int(32) NOT NULL AUTO_INCREMENT,
  `room_size` int(11) DEFAULT NULL,
  `room_type` varchar(45) DEFAULT NULL,
  `room_number` varchar(45) DEFAULT NULL,
  PRIMARY KEY (`room_id`)
) ENGINE=InnoDB AUTO_INCREMENT=5 DEFAULT CHARSET=utf8;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `room_t`
--

LOCK TABLES `room_t` WRITE;
/*!40000 ALTER TABLE `room_t` DISABLE KEYS */;
INSERT INTO `room_t` VALUES (23,40,'Lab','C416'),(24,40,'Lab','C422'),(25,40,'Lab','C418'),(26,60,'Lecture','E311'),(27,60,'Lecture','E322');
/*!40000 ALTER TABLE `room_t` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `section_t`
--

DROP TABLE IF EXISTS `section_t`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `section_t` (
  `section_id` int(32) NOT NULL AUTO_INCREMENT,
  `section_name` varchar(45) DEFAULT NULL,
  `section_desc` text,
  `section_size` int(11) DEFAULT NULL,
  PRIMARY KEY (`section_id`)
) ENGINE=InnoDB AUTO_INCREMENT=2 DEFAULT CHARSET=utf8;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `section_t`
--

LOCK TABLES `section_t` WRITE;
/*!40000 ALTER TABLE `section_t` DISABLE KEYS */;
INSERT INTO `section_t` VALUES (3492,'T127-B','Computer Analyst/Programmer Section B',35),(3493,'T127-A','Computer Analyst/Programmer Section A',25);
/*!40000 ALTER TABLE `section_t` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `schedule_t`
--

DROP TABLE IF EXISTS `schedule_t`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `schedule_t` (
  `schedule_id` int(32) NOT NULL AUTO_INCREMENT,
  `day` varchar(50) NOT NULL,
  `startTime` varchar(6) NOT NULL,
  `endTime` varchar(6) NOT NULL,
  `course_crn` int(5),
  `room_id` int(32),
  `teacher_id` int(32),
  `section_id` int(32),
  `semester_id` int(32),
  PRIMARY KEY (`schedule_id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Constraints for SCHEDULE_T
--
ALTER TABLE `schedule_t`
    ADD FOREIGN KEY
    (course_crn) 
    REFERENCES `course_t` (course_crn);
ALTER TABLE `schedule_t`
    ADD FOREIGN KEY
    (room_id) 
    REFERENCES `room_t` (room_id);
ALTER TABLE `schedule_t`
    ADD FOREIGN KEY
    (teacher_id) 
    REFERENCES `user_t` (employee_id);
ALTER TABLE `schedule_t`
    ADD FOREIGN KEY
    (section_id) 
    REFERENCES `section_t` (section_id);
ALTER TABLE `schedule_t`
    ADD FOREIGN KEY
    (semester_id) 
    REFERENCES `semester_t` (semester_id);


--
-- Dumping data for table `schedule_t`
--

/*NO DATA */;

--
-- Table structure for table `schedule_t`
--

DROP TABLE IF EXISTS `semester_t`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `semester_t` (
  `semester_id` int(32) NOT NULL AUTO_INCREMENT,
  `year` varchar(50),
  `quarter` varchar(50),
  `startDate` varchar(50) NOT NULL,
  `endDate` varchar(50) NOT NULL,
  PRIMARY KEY (`semester_id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `semester_t`
--

LOCK TABLES `semester_t` WRITE;
/*!40000 ALTER TABLE `semester_t` DISABLE KEYS */;
INSERT INTO `semester_t` VALUES (50931,'2013','Winter','2013-01-09','2013-04-19'),(50932,'2013','Fall','2013-09-09','2013-12-16'),(50933,'2014','Winter','2014-01-05','2014-04-19'),(50934,'2014','Summer','2014-05-06','2014-08-26');
/*!40000 ALTER TABLE `semester_t` ENABLE KEYS */;
UNLOCK TABLES;


/*!40101 SET SQL_MODE=@OLD_SQL_MODE */;
/*!40014 SET FOREIGN_KEY_CHECKS=@OLD_FOREIGN_KEY_CHECKS */;
/*!40014 SET UNIQUE_CHECKS=@OLD_UNIQUE_CHECKS */;
/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
/*!40111 SET SQL_NOTES=@OLD_SQL_NOTES */;

-- Dump completed on 2013-02-12 19:23:56
