/*
SQLyog Ultimate v10.00 Beta1
MySQL - 5.5.25a : Database - inventory
*********************************************************************
*/

/*!40101 SET NAMES utf8 */;

/*!40101 SET SQL_MODE=''*/;

/*!40014 SET @OLD_UNIQUE_CHECKS=@@UNIQUE_CHECKS, UNIQUE_CHECKS=0 */;
/*!40014 SET @OLD_FOREIGN_KEY_CHECKS=@@FOREIGN_KEY_CHECKS, FOREIGN_KEY_CHECKS=0 */;
/*!40101 SET @OLD_SQL_MODE=@@SQL_MODE, SQL_MODE='NO_AUTO_VALUE_ON_ZERO' */;
/*!40111 SET @OLD_SQL_NOTES=@@SQL_NOTES, SQL_NOTES=0 */;
CREATE DATABASE /*!32312 IF NOT EXISTS*/`inventory` /*!40100 DEFAULT CHARACTER SET latin1 */;

/*Table structure for table `bf_activities` */

DROP TABLE IF EXISTS `bf_activities`;

CREATE TABLE `bf_activities` (
  `activity_id` bigint(20) NOT NULL AUTO_INCREMENT,
  `user_id` bigint(20) NOT NULL DEFAULT '0',
  `activity` varchar(255) NOT NULL,
  `module` varchar(255) NOT NULL,
  `created_on` datetime NOT NULL,
  `deleted` tinyint(12) NOT NULL DEFAULT '0',
  PRIMARY KEY (`activity_id`)
) ENGINE=InnoDB AUTO_INCREMENT=304 DEFAULT CHARSET=utf8;

/*Data for the table `bf_activities` */

insert  into `bf_activities`(`activity_id`,`user_id`,`activity`,`module`,`created_on`,`deleted`) values (1,1,'logged in from: 127.0.0.1','users','2013-12-07 09:40:11',0),(2,1,'logged in from: 127.0.0.1','users','2013-12-07 10:25:48',0),(3,1,'logged in from: 127.0.0.1','users','2013-12-07 10:26:28',0),(4,1,'deleted user: admin','users','2013-12-07 10:28:09',0),(5,1,'App settings saved from: 127.0.0.1','core','2013-12-07 10:29:05',0),(6,1,'logged in from: 127.0.0.1','users','2013-12-08 07:12:06',0),(7,1,'Created Module: teachers : 127.0.0.1','modulebuilder','2013-12-08 07:51:46',0),(8,1,'Deleted Module: teachers : 127.0.0.1','builder','2013-12-08 07:52:13',0),(9,1,'Created Module: Teachers : 127.0.0.1','modulebuilder','2013-12-08 07:52:59',0),(10,1,'Created Module: Students : 127.0.0.1','modulebuilder','2013-12-08 08:01:19',0),(11,1,'Created Module: Lab Incharge : 127.0.0.1','modulebuilder','2013-12-08 08:05:09',0),(12,1,'Created Module: Laboratories : 127.0.0.1','modulebuilder','2013-12-08 08:24:29',0),(13,1,'Created Module: Subjects : 127.0.0.1','modulebuilder','2013-12-08 08:32:03',0),(14,1,'Created Module: Items : 127.0.0.1','modulebuilder','2013-12-08 08:38:42',0),(15,1,'Created Module: Items : 127.0.0.1','modulebuilder','2013-12-08 08:38:45',0),(16,1,'Created Module: Returned Items : 127.0.0.1','modulebuilder','2013-12-08 08:44:20',0),(17,1,'logged in from: 127.0.0.1','users','2013-12-08 17:17:47',0),(18,1,'logged in from: 127.0.0.1','users','2013-12-08 17:20:30',0),(19,1,'logged in from: 127.0.0.1','users','2013-12-10 14:13:52',0),(20,1,'logged in from: 127.0.0.1','users','2013-12-11 14:13:03',0),(21,3,'registered a new account.','users','2013-12-11 16:06:01',0),(22,4,'registered a new account.','users','2013-12-11 16:08:32',0),(23,7,'registered a new account.','lab_incharge','2013-12-11 16:22:41',0),(24,8,'registered a new account.','lab_incharge','2013-12-11 16:24:54',0),(25,9,'registered a new account.','lab_incharge','2013-12-11 16:28:38',0),(26,10,'registered a new account.','lab_incharge','2013-12-11 16:29:56',0),(27,11,'registered a new account.','lab_incharge','2013-12-11 16:34:43',0),(28,1,'Created record with ID: 1 : 127.0.0.1','lab_incharge','2013-12-11 16:34:43',0),(29,12,'registered a new account.','lab_incharge','2013-12-11 16:40:38',0),(30,1,'Created record with ID: 1 : 127.0.0.1','lab_incharge','2013-12-11 16:40:38',0),(31,1,'Created record with ID: 8 : 127.0.0.1','lab_incharge','2013-12-11 16:54:06',0),(32,1,'Created record with ID: 9 : 127.0.0.1','lab_incharge','2013-12-11 16:56:29',0),(33,1,'Updated record with ID: 9 : 127.0.0.1','lab_incharge','2013-12-11 17:31:54',0),(34,1,'Updated record with ID: 9 : 127.0.0.1','lab_incharge','2013-12-11 17:32:04',0),(35,1,'Created record with ID: 14 : 127.0.0.1','lab_incharge','2013-12-11 17:56:03',0),(36,1,'Updated record with ID: 14 : 127.0.0.1','lab_incharge','2013-12-11 17:59:57',0),(37,1,'Updated record with ID: 14 : 127.0.0.1','lab_incharge','2013-12-11 18:00:03',0),(38,1,'Deleted record with ID: 14 : 127.0.0.1','lab_incharge','2013-12-11 18:00:29',0),(39,1,'logged in from: 127.0.0.1','users','2013-12-12 15:33:17',0),(40,1,'logged in from: 127.0.0.1','users','2013-12-12 16:27:59',0),(41,1,'logged in from: 127.0.0.1','users','2013-12-12 17:27:42',0),(42,1,'logged in from: 127.0.0.1','users','2013-12-13 15:05:06',0),(43,1,'Created record with ID: 2 : 127.0.0.1','students','2013-12-13 15:18:38',0),(44,1,'Created record with ID: 3 : 127.0.0.1','students','2013-12-13 15:20:18',0),(45,1,'Created record with ID: 4 : 127.0.0.1','students','2013-12-13 15:21:47',0),(46,1,'Created record with ID: 2 : 127.0.0.1','teachers','2013-12-13 15:36:38',0),(47,1,'Created record with ID: 1 : 127.0.0.1','lab_incharge','2013-12-13 15:46:23',0),(48,1,'Created record with ID: 5 : 127.0.0.1','students','2013-12-13 15:47:03',0),(49,1,'Created record with ID: 3 : 127.0.0.1','teachers','2013-12-13 15:48:16',0),(50,1,'Created record with ID: 1 : 127.0.0.1','laboratories','2013-12-13 16:20:21',0),(51,1,'Created record with ID: 2 : 127.0.0.1','lab_incharge','2013-12-13 16:21:04',0),(52,1,'Updated record with ID: 1 : 127.0.0.1','laboratories','2013-12-13 16:21:28',0),(53,1,'Updated record with ID: 1 : 127.0.0.1','laboratories','2013-12-13 17:12:05',0),(54,1,'logged in from: 127.0.0.1','users','2013-12-14 08:28:57',0),(55,1,'Created record with ID: 1 : 127.0.0.1','subjects','2013-12-14 10:31:33',0),(56,1,'logged in from: 127.0.0.1','users','2013-12-14 11:04:45',0),(57,1,'logged in from: 127.0.0.1','users','2014-01-06 17:11:09',0),(58,1,'logged in from: 127.0.0.1','users','2014-01-06 17:13:31',0),(59,1,'logged in from: 127.0.0.1','users','2014-01-07 13:29:26',0),(60,1,'Created record with ID: 1 : 127.0.0.1','items','2014-01-07 13:49:33',0),(61,1,'Updated record with ID: 1 : 127.0.0.1','items','2014-01-07 13:49:50',0),(62,1,'Created record with ID: 2 : 127.0.0.1','items','2014-01-07 13:50:07',0),(63,1,'Updated record with ID: 1 : 127.0.0.1','laboratories','2014-01-07 13:55:21',0),(64,1,'logged in from: 127.0.0.1','users','2014-01-07 14:50:23',0),(65,1,'Updated record with ID: 5 : 127.0.0.1','students','2014-01-07 15:26:14',0),(66,1,'logged in from: 127.0.0.1','users','2014-01-07 15:26:51',0),(67,1,'Updated record with ID: 3 : 127.0.0.1','teachers','2014-01-07 15:32:47',0),(68,1,'Updated record with ID: 5 : 127.0.0.1','students','2014-01-07 15:33:28',0),(69,10,'logged in from: 127.0.0.1','users','2014-01-07 15:35:33',0),(70,1,'logged in from: 127.0.0.1','users','2014-01-08 15:24:55',0),(71,1,'logged in from: 127.0.0.1','users','2014-01-08 15:32:57',0),(72,1,'Updated record with ID: 1 : 127.0.0.1','subjects','2014-01-08 15:37:22',0),(73,1,'Created Module: Test : 127.0.0.1','modulebuilder','2014-01-08 15:45:27',0),(74,1,'Created record with ID: 1 : 127.0.0.1','test','2014-01-08 15:45:56',0),(75,1,'Deleted Module: Test : 127.0.0.1','builder','2014-01-08 15:46:29',0),(76,1,'logged in from: 127.0.0.1','users','2014-01-10 13:21:26',0),(77,1,'logged in from: 127.0.0.1','users','2014-01-11 13:32:22',0),(78,1,'Updated record with ID: 1 : 127.0.0.1','items','2014-01-11 14:45:05',0),(79,1,'Updated record with ID: 1 : 127.0.0.1','items','2014-01-11 14:47:39',0),(80,1,'Updated record with ID: 1 : 127.0.0.1','items','2014-01-11 14:48:42',0),(81,1,'Updated record with ID: 1 : 127.0.0.1','items','2014-01-11 14:50:24',0),(82,1,'Updated record with ID: 1 : 127.0.0.1','items','2014-01-11 14:56:58',0),(83,1,'Updated record with ID: 1 : 127.0.0.1','items','2014-01-11 14:57:43',0),(84,1,'Updated record with ID: 1 : 127.0.0.1','items','2014-01-11 15:01:31',0),(85,1,'Updated record with ID: 1 : 127.0.0.1','items','2014-01-11 15:02:30',0),(86,1,'Updated record with ID: 1 : 127.0.0.1','items','2014-01-11 15:02:51',0),(87,1,'Updated record with ID: 1 : 127.0.0.1','items','2014-01-11 15:03:06',0),(88,1,'Updated record with ID: 2 : 127.0.0.1','items','2014-01-11 16:34:10',0),(89,1,'Updated record with ID: 1 : 127.0.0.1','items','2014-01-11 16:34:50',0),(90,1,'Updated record with ID: 2 : 127.0.0.1','items','2014-01-11 16:35:08',0),(91,1,'logged in from: 127.0.0.1','users','2014-01-12 04:02:30',0),(92,1,'Created record with ID: 3 : 127.0.0.1','items','2014-01-12 04:03:24',0),(93,1,'Updated record with ID: 3 : 127.0.0.1','items','2014-01-12 04:03:34',0),(94,1,'Created record with ID: 4 : 127.0.0.1','items','2014-01-12 04:03:58',0),(95,1,'Updated record with ID: 4 : 127.0.0.1','items','2014-01-12 04:04:07',0),(96,1,'Created record with ID: 5 : 127.0.0.1','items','2014-01-12 04:04:41',0),(97,1,'Updated record with ID: 5 : 127.0.0.1','items','2014-01-12 04:04:48',0),(98,1,'Created record with ID: 6 : 127.0.0.1','items','2014-01-12 07:16:35',0),(99,1,'Created record with ID: 7 : 127.0.0.1','items','2014-01-12 07:16:46',0),(100,1,'Created record with ID: 8 : 127.0.0.1','items','2014-01-12 07:16:52',0),(101,1,'Created record with ID: 9 : 127.0.0.1','items','2014-01-12 07:16:59',0),(102,1,'Created record with ID: 10 : 127.0.0.1','items','2014-01-12 07:17:04',0),(103,1,'Created record with ID: 11 : 127.0.0.1','items','2014-01-12 07:29:43',0),(104,1,'logged in from: 127.0.0.1','users','2014-01-12 12:17:48',0),(105,1,'logged in from: 127.0.0.1','users','2014-01-12 12:37:21',0),(106,1,'logged in from: 127.0.0.1','users','2014-01-12 13:02:08',0),(107,1,'logged in from: 127.0.0.1','users','2014-01-12 13:59:20',0),(108,1,'Created record with ID: 6 : 127.0.0.1','students','2014-01-12 15:30:19',0),(109,13,'logged in from: 127.0.0.1','users','2014-01-12 15:30:35',0),(110,1,'logged in from: 127.0.0.1','users','2014-01-12 16:09:58',0),(111,13,'logged in from: 127.0.0.1','users','2014-01-12 16:58:34',0),(112,1,'logged in from: 127.0.0.1','users','2014-01-12 17:04:53',0),(113,13,'logged in from: 127.0.0.1','users','2014-01-12 17:37:51',0),(114,1,'logged in from: 127.0.0.1','users','2014-01-13 13:17:38',0),(115,13,'logged in from: 127.0.0.1','users','2014-01-13 13:57:44',0),(116,13,'logged in from: 127.0.0.1','users','2014-01-14 14:09:27',0),(117,1,'logged in from: 127.0.0.1','users','2014-01-14 14:12:48',0),(118,13,'logged in from: 127.0.0.1','users','2014-01-15 12:21:10',0),(119,1,'logged in from: 127.0.0.1','users','2014-01-15 12:41:14',0),(120,1,'Updated record with ID: 20 : 127.0.0.1','returned_items','2014-01-15 13:35:14',0),(121,1,'Updated record with ID: 20 : 127.0.0.1','returned_items','2014-01-15 13:36:54',0),(122,1,'Updated record with ID: 20 : 127.0.0.1','returned_items','2014-01-15 13:37:35',0),(123,1,'Updated record with ID: 20 : 127.0.0.1','returned_items','2014-01-15 13:45:23',0),(124,1,'Updated record with ID: 20 : 127.0.0.1','returned_items','2014-01-15 13:45:42',0),(125,1,'Updated record with ID: 20 : 127.0.0.1','returned_items','2014-01-15 13:45:46',0),(126,1,'Updated record with ID: 20 : 127.0.0.1','returned_items','2014-01-15 14:04:51',0),(127,1,'Updated record with ID: 20 : 127.0.0.1','returned_items','2014-01-15 14:05:05',0),(128,1,'Updated record with ID: 20 : 127.0.0.1','returned_items','2014-01-15 14:07:07',0),(129,1,'Updated record with ID: 20 : 127.0.0.1','returned_items','2014-01-15 14:07:12',0),(130,1,'Updated record with ID: 20 : 127.0.0.1','returned_items','2014-01-15 14:15:44',0),(131,1,'Updated record with ID: 20 : 127.0.0.1','returned_items','2014-01-15 14:18:00',0),(132,1,'Updated record with ID: 20 : 127.0.0.1','returned_items','2014-01-15 14:18:09',0),(133,1,'Updated record with ID: 20 : 127.0.0.1','returned_items','2014-01-15 14:21:25',0),(134,15,'registered a new account.','users','2014-01-15 14:55:01',0),(135,15,'logged in from: 127.0.0.1','users','2014-01-15 14:55:17',0),(136,16,'registered a new account.','users','2014-01-15 14:58:13',0),(137,16,'logged in from: 127.0.0.1','users','2014-01-15 14:58:26',0),(138,1,'logged in from: 127.0.0.1','users','2014-01-15 15:50:47',0),(139,1,'logged in from: 127.0.0.1','users','2014-01-15 16:13:53',0),(140,16,'logged in from: 127.0.0.1','users','2014-01-15 16:14:29',0),(141,1,'logged in from: 127.0.0.1','users','2014-01-15 16:46:05',0),(142,16,'logged in from: 127.0.0.1','users','2014-01-15 17:16:50',0),(143,1,'logged in from: 127.0.0.1','users','2014-01-15 17:17:16',0),(144,16,'logged in from: 127.0.0.1','users','2014-01-15 17:17:37',0),(145,1,'logged in from: 127.0.0.1','users','2014-01-15 17:29:30',0),(146,1,'logged in from: 127.0.0.1','users','2014-01-15 18:11:00',0),(147,1,'Updated record with ID: 33 : 127.0.0.1','returned_items','2014-01-15 18:28:38',0),(148,1,'Updated record with ID: 33 : 127.0.0.1','returned_items','2014-01-15 18:29:51',0),(149,16,'logged in from: 127.0.0.1','users','2014-01-15 18:44:02',0),(150,1,'logged in from: 127.0.0.1','users','2014-01-15 18:45:46',0),(151,1,'Updated record with ID: 34 : 127.0.0.1','returned_items','2014-01-15 18:46:09',0),(152,16,'logged in from: 127.0.0.1','users','2014-01-15 18:46:44',0),(153,1,'logged in from: 127.0.0.1','users','2014-01-15 18:47:28',0),(154,1,'Updated record with ID: 34 : 127.0.0.1','returned_items','2014-01-15 18:47:48',0),(155,1,'Updated record with ID: 34 : 127.0.0.1','returned_items','2014-01-15 18:52:45',0),(156,16,'logged in from: 127.0.0.1','users','2014-01-15 18:53:29',0),(157,1,'logged in from: 127.0.0.1','users','2014-01-15 18:54:19',0),(158,1,'Updated record with ID: 35 : 127.0.0.1','returned_items','2014-01-15 18:54:44',0),(159,1,'Updated record with ID: 35 : 127.0.0.1','returned_items','2014-01-15 19:00:53',0),(160,16,'logged in from: 127.0.0.1','users','2014-01-15 19:01:37',0),(161,1,'logged in from: 127.0.0.1','users','2014-01-15 19:03:45',0),(162,1,'Updated record with ID: 35 : 127.0.0.1','returned_items','2014-01-15 19:05:00',0),(163,16,'logged in from: 127.0.0.1','users','2014-01-15 19:11:03',0),(164,1,'logged in from: 127.0.0.1','users','2014-01-15 19:12:09',0),(165,1,'Updated record with ID: 36 : 127.0.0.1','returned_items','2014-01-15 19:13:00',0),(166,16,'logged in from: 127.0.0.1','users','2014-01-15 19:13:37',0),(167,1,'logged in from: 127.0.0.1','users','2014-01-15 19:14:15',0),(168,1,'Updated record with ID: 36 : 127.0.0.1','returned_items','2014-01-15 19:15:36',0),(169,16,'logged in from: 127.0.0.1','users','2014-01-15 19:16:13',0),(170,16,'logged in from: 127.0.0.1','users','2014-01-15 19:23:18',0),(171,16,'updated their profile: Nica','users','2014-01-15 19:25:08',0),(172,16,'updated their profile: Nica','users','2014-01-15 19:34:50',0),(173,16,'updated their profile: Nica','users','2014-01-15 19:35:58',0),(174,16,'updated their profile: Nica','users','2014-01-15 19:36:11',0),(175,16,'updated their profile: Nica','users','2014-01-15 19:46:55',0),(176,16,'updated their profile: Nica','users','2014-01-15 19:47:08',0),(177,16,'updated their profile: Nica','users','2014-01-15 19:47:14',0),(178,1,'logged in from: 127.0.0.1','users','2014-01-15 19:48:28',0),(179,1,'App settings saved from: 127.0.0.1','core','2014-01-15 19:48:51',0),(180,1,'App settings saved from: 127.0.0.1','core','2014-01-15 19:49:27',0),(181,1,'logged in from: 127.0.0.1','users','2014-01-15 19:50:07',0),(182,16,'logged in from: 127.0.0.1','users','2014-01-15 19:51:52',0),(183,1,'logged in from: 127.0.0.1','users','2014-01-15 20:09:16',0),(184,1,'Updated record with ID: 37 : 127.0.0.1','returned_items','2014-01-15 20:09:55',0),(185,16,'logged in from: 127.0.0.1','users','2014-01-15 20:10:25',0),(186,1,'logged in from: 127.0.0.1','users','2014-01-15 20:11:29',0),(187,1,'Updated record with ID: 37 : 127.0.0.1','returned_items','2014-01-15 20:11:57',0),(188,1,'Created record with ID: 15 : 127.0.0.1','items','2014-01-15 20:13:17',0),(189,1,'Created record with ID: 16 : 127.0.0.1','items','2014-01-15 20:13:20',0),(190,1,'Created record with ID: 17 : 127.0.0.1','items','2014-01-15 20:13:33',0),(191,1,'Created record with ID: 18 : 127.0.0.1','items','2014-01-15 20:13:45',0),(192,16,'logged in from: 127.0.0.1','users','2014-01-15 20:27:00',0),(193,1,'logged in from: 127.0.0.1','users','2014-01-15 20:33:30',0),(194,16,'logged in from: 127.0.0.1','users','2014-01-15 20:41:07',0),(195,1,'logged in from: 127.0.0.1','users','2014-01-16 02:51:59',0),(196,1,'Created Module: Notifications : 127.0.0.1','modulebuilder','2014-01-16 03:12:39',0),(197,17,'registered a new account.','users','2014-01-16 03:42:17',0),(198,1,'logged in from: 127.0.0.1','users','2014-01-16 04:07:36',0),(199,16,'logged in from: 127.0.0.1','users','2014-01-16 04:08:26',0),(200,1,'logged in from: 127.0.0.1','users','2014-01-16 04:59:22',0),(201,1,'logged in from: 127.0.0.1','users','2014-01-16 06:04:39',0),(202,16,'logged in from: 127.0.0.1','users','2014-01-16 06:06:17',0),(203,1,'logged in from: 127.0.0.1','users','2014-01-16 10:10:54',0),(204,16,'logged in from: 127.0.0.1','users','2014-01-16 10:16:42',0),(205,1,'logged in from: 127.0.0.1','users','2014-01-16 10:21:05',0),(206,16,'logged in from: 127.0.0.1','users','2014-01-16 10:24:05',0),(207,1,'logged in from: 127.0.0.1','users','2014-01-16 10:26:20',0),(208,1,'logged in from: 127.0.0.1','users','2014-01-16 10:27:52',0),(209,1,'Updated record with ID: 3 : 127.0.0.1','items','2014-01-16 13:57:22',0),(210,1,'Updated record with ID: 3 : 127.0.0.1','items','2014-01-16 14:00:26',0),(211,16,'logged in from: 127.0.0.1','users','2014-01-16 16:15:02',0),(212,1,'logged in from: 127.0.0.1','users','2014-01-16 16:16:16',0),(213,16,'logged in from: 127.0.0.1','users','2014-01-16 17:14:11',0),(214,1,'logged in from: 127.0.0.1','users','2014-01-16 17:16:26',0),(215,16,'logged in from: 127.0.0.1','users','2014-01-16 17:37:38',0),(216,1,'logged in from: 127.0.0.1','users','2014-01-16 17:38:09',0),(217,16,'logged in from: 127.0.0.1','users','2014-01-16 19:02:44',0),(218,1,'logged in from: 127.0.0.1','users','2014-01-16 19:06:41',0),(219,16,'logged in from: 127.0.0.1','users','2014-01-16 19:13:15',0),(220,1,'logged in from: 127.0.0.1','users','2014-01-16 19:24:57',0),(221,18,'registered a new account.','users','2014-01-16 19:29:09',0),(222,18,'logged in from: 127.0.0.1','users','2014-01-16 19:29:50',0),(223,1,'logged in from: 127.0.0.1','users','2014-01-16 19:31:26',0),(224,16,'logged in from: 127.0.0.1','users','2014-01-16 19:37:46',0),(225,1,'logged in from: 127.0.0.1','users','2014-01-16 19:45:45',0),(226,16,'logged in from: 127.0.0.1','users','2014-01-16 19:57:10',0),(227,1,'logged in from: 127.0.0.1','users','2014-01-16 19:57:49',0),(228,1,'logged in from: 127.0.0.1','users','2014-01-16 20:37:36',0),(229,1,'Updated record with ID: 1 : 127.0.0.1','items','2014-01-16 20:41:55',0),(230,1,'logged in from: 127.0.0.1','users','2014-01-16 20:44:04',0),(231,16,'logged in from: 127.0.0.1','users','2014-01-16 20:44:20',0),(232,19,'registered a new account.','users','2014-01-16 20:59:37',0),(233,19,'logged in from: 127.0.0.1','users','2014-01-16 20:59:52',0),(234,16,'logged in from: 127.0.0.1','users','2014-01-16 21:00:55',0),(235,19,'logged in from: 127.0.0.1','users','2014-01-16 21:01:26',0),(236,1,'logged in from: 127.0.0.1','users','2014-01-22 15:58:45',0),(237,1,'logged in from: 127.0.0.1','users','2014-01-22 17:10:42',0),(238,19,'logged in from: 127.0.0.1','users','2014-01-22 17:14:45',0),(239,1,'logged in from: 127.0.0.1','users','2014-01-22 17:14:58',0),(240,1,'FIXME (\"us_log_status_change\"): nico : Deactivateed','users','2014-01-22 17:15:21',0),(241,1,'logged in from: 127.0.0.1','users','2014-01-22 17:16:21',0),(242,1,'FIXME (\"us_log_status_change\"): nico : Activateed','users','2014-01-22 17:16:31',0),(243,19,'logged in from: 127.0.0.1','users','2014-01-22 17:16:53',0),(244,20,'registered a new account.','users','2014-01-22 17:17:47',0),(245,1,'logged in from: 127.0.0.1','users','2014-01-22 17:19:14',0),(246,1,'logged in from: 127.0.0.1','users','2014-01-22 17:20:27',0),(247,1,'FIXME (\"us_log_status_change\"): sinulog : Activateed','users','2014-01-22 17:20:44',0),(248,20,'logged in from: 127.0.0.1','users','2014-01-22 17:21:41',0),(249,1,'logged in from: 127.0.0.1','users','2014-01-22 17:22:56',0),(250,1,'logged in from: 127.0.0.1','users','2014-01-22 17:29:20',0),(251,1,'logged in from: 127.0.0.1','users','2014-01-22 17:30:53',0),(252,1,'logged in from: 127.0.0.1','users','2014-01-25 11:45:02',0),(253,1,'logged in from: 127.0.0.1','users','2014-01-28 15:10:53',0),(254,19,'logged in from: 127.0.0.1','users','2014-01-28 15:27:25',0),(255,19,'logged in from: 127.0.0.1','users','2014-01-28 15:28:05',0),(256,1,'logged in from: 127.0.0.1','users','2014-01-28 15:28:31',0),(257,19,'logged in from: 127.0.0.1','users','2014-01-28 16:07:22',0),(258,1,'logged in from: 127.0.0.1','users','2014-01-28 16:09:14',0),(259,1,'logged in from: 127.0.0.1','users','2014-02-01 07:02:30',0),(260,19,'logged in from: 127.0.0.1','users','2014-02-01 07:24:03',0),(261,1,'logged in from: 127.0.0.1','users','2014-02-01 07:45:31',0),(262,16,'logged in from: 127.0.0.1','users','2014-02-01 07:46:16',0),(263,1,'logged in from: 127.0.0.1','users','2014-02-01 07:47:00',0),(264,19,'logged in from: 127.0.0.1','users','2014-02-01 08:11:49',0),(265,1,'logged in from: 127.0.0.1','users','2014-02-01 08:12:18',0),(266,19,'logged in from: 127.0.0.1','users','2014-02-01 08:15:38',0),(267,1,'logged in from: 127.0.0.1','users','2014-02-01 08:16:27',0),(268,19,'logged in from: 127.0.0.1','users','2014-02-01 08:19:26',0),(269,1,'logged in from: 127.0.0.1','users','2014-02-01 08:20:16',0),(270,19,'logged in from: 127.0.0.1','users','2014-02-01 08:28:37',0),(271,1,'logged in from: 127.0.0.1','users','2014-02-01 08:29:08',0),(272,19,'logged in from: 127.0.0.1','users','2014-02-01 08:30:12',0),(273,1,'logged in from: 127.0.0.1','users','2014-02-01 08:32:08',0),(274,1,'logged in from: 127.0.0.1','users','2014-02-01 08:34:42',0),(275,19,'logged in from: 127.0.0.1','users','2014-02-04 14:56:54',0),(276,1,'logged in from: 127.0.0.1','users','2014-02-04 14:57:32',0),(277,19,'logged in from: 127.0.0.1','users','2014-02-04 15:00:14',0),(278,1,'logged in from: 127.0.0.1','users','2014-02-04 15:00:38',0),(279,1,'logged in from: 127.0.0.1','users','2014-02-09 13:57:20',0),(280,19,'logged in from: 127.0.0.1','users','2014-02-09 14:18:37',0),(281,1,'logged in from: 127.0.0.1','users','2014-02-11 15:40:03',0),(282,16,'logged in from: 127.0.0.1','users','2014-02-11 15:44:43',0),(283,1,'Updated record with ID: 14 : 127.0.0.1','items','2014-02-11 16:30:39',0),(284,1,'Updated record with ID: 15 : 127.0.0.1','items','2014-02-11 16:31:03',0),(285,1,'Updated record with ID: 16 : 127.0.0.1','items','2014-02-11 16:50:57',0),(286,1,'logged in from: 127.0.0.1','users','2014-02-12 14:03:13',0),(287,19,'logged in from: 127.0.0.1','users','2014-02-12 14:03:49',0),(288,1,'Updated record with ID: 16 : 127.0.0.1','items','2014-02-12 14:14:16',0),(289,1,'Updated record with ID: 5 : 127.0.0.1','items','2014-02-12 14:28:14',0),(290,1,'Updated record with ID: 4 : 127.0.0.1','items','2014-02-12 14:28:21',0),(291,1,'Created Module: Sales Order : 127.0.0.1','modulebuilder','2014-02-12 17:52:49',0),(292,16,'logged in from: 127.0.0.1','users','2014-02-12 18:26:39',0),(293,1,'logged in from: 127.0.0.1','users','2014-02-13 15:16:36',0),(294,1,'Created Module: Purchase Order : 127.0.0.1','modulebuilder','2014-02-13 15:53:44',0),(295,1,'logged in from: 127.0.0.1','users','2014-02-15 07:32:28',0),(296,19,'logged in from: 127.0.0.1','users','2014-02-15 07:32:41',0),(297,1,'logged in from: 127.0.0.1','users','2014-02-15 10:22:12',0),(298,1,'logged in from: 127.0.0.1','users','2014-02-15 10:52:44',0),(299,1,'Created record with ID: 1 : 127.0.0.1','lab_incharge','2014-02-15 13:45:00',0),(300,1,'logged in from: 127.0.0.1','users','2014-02-16 09:05:56',0),(301,1,'logged in from: 127.0.0.1','users','2014-02-16 09:24:42',0),(302,1,'logged in from: 127.0.0.1','users','2014-02-16 17:44:45',0),(303,19,'logged in from: 127.0.0.1','users','2014-02-16 18:47:07',0);

/*Table structure for table `bf_countries` */

DROP TABLE IF EXISTS `bf_countries`;

CREATE TABLE `bf_countries` (
  `iso` char(2) NOT NULL DEFAULT 'US',
  `name` varchar(80) NOT NULL,
  `printable_name` varchar(80) NOT NULL,
  `iso3` char(3) DEFAULT NULL,
  `numcode` smallint(6) DEFAULT NULL,
  PRIMARY KEY (`iso`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

/*Data for the table `bf_countries` */

insert  into `bf_countries`(`iso`,`name`,`printable_name`,`iso3`,`numcode`) values ('AD','ANDORRA','Andorra','AND',20),('AE','UNITED ARAB EMIRATES','United Arab Emirates','ARE',784),('AF','AFGHANISTAN','Afghanistan','AFG',4),('AG','ANTIGUA AND BARBUDA','Antigua and Barbuda','ATG',28),('AI','ANGUILLA','Anguilla','AIA',660),('AL','ALBANIA','Albania','ALB',8),('AM','ARMENIA','Armenia','ARM',51),('AN','NETHERLANDS ANTILLES','Netherlands Antilles','ANT',530),('AO','ANGOLA','Angola','AGO',24),('AQ','ANTARCTICA','Antarctica',NULL,NULL),('AR','ARGENTINA','Argentina','ARG',32),('AS','AMERICAN SAMOA','American Samoa','ASM',16),('AT','AUSTRIA','Austria','AUT',40),('AU','AUSTRALIA','Australia','AUS',36),('AW','ARUBA','Aruba','ABW',533),('AZ','AZERBAIJAN','Azerbaijan','AZE',31),('BA','BOSNIA AND HERZEGOVINA','Bosnia and Herzegovina','BIH',70),('BB','BARBADOS','Barbados','BRB',52),('BD','BANGLADESH','Bangladesh','BGD',50),('BE','BELGIUM','Belgium','BEL',56),('BF','BURKINA FASO','Burkina Faso','BFA',854),('BG','BULGARIA','Bulgaria','BGR',100),('BH','BAHRAIN','Bahrain','BHR',48),('BI','BURUNDI','Burundi','BDI',108),('BJ','BENIN','Benin','BEN',204),('BM','BERMUDA','Bermuda','BMU',60),('BN','BRUNEI DARUSSALAM','Brunei Darussalam','BRN',96),('BO','BOLIVIA','Bolivia','BOL',68),('BR','BRAZIL','Brazil','BRA',76),('BS','BAHAMAS','Bahamas','BHS',44),('BT','BHUTAN','Bhutan','BTN',64),('BV','BOUVET ISLAND','Bouvet Island',NULL,NULL),('BW','BOTSWANA','Botswana','BWA',72),('BY','BELARUS','Belarus','BLR',112),('BZ','BELIZE','Belize','BLZ',84),('CA','CANADA','Canada','CAN',124),('CC','COCOS (KEELING) ISLANDS','Cocos (Keeling) Islands',NULL,NULL),('CD','CONGO, THE DEMOCRATIC REPUBLIC OF THE','Congo, the Democratic Republic of the','COD',180),('CF','CENTRAL AFRICAN REPUBLIC','Central African Republic','CAF',140),('CG','CONGO','Congo','COG',178),('CH','SWITZERLAND','Switzerland','CHE',756),('CI','COTE D\'IVOIRE','Cote D\'Ivoire','CIV',384),('CK','COOK ISLANDS','Cook Islands','COK',184),('CL','CHILE','Chile','CHL',152),('CM','CAMEROON','Cameroon','CMR',120),('CN','CHINA','China','CHN',156),('CO','COLOMBIA','Colombia','COL',170),('CR','COSTA RICA','Costa Rica','CRI',188),('CS','SERBIA AND MONTENEGRO','Serbia and Montenegro',NULL,NULL),('CU','CUBA','Cuba','CUB',192),('CV','CAPE VERDE','Cape Verde','CPV',132),('CX','CHRISTMAS ISLAND','Christmas Island',NULL,NULL),('CY','CYPRUS','Cyprus','CYP',196),('CZ','CZECH REPUBLIC','Czech Republic','CZE',203),('DE','GERMANY','Germany','DEU',276),('DJ','DJIBOUTI','Djibouti','DJI',262),('DK','DENMARK','Denmark','DNK',208),('DM','DOMINICA','Dominica','DMA',212),('DO','DOMINICAN REPUBLIC','Dominican Republic','DOM',214),('DZ','ALGERIA','Algeria','DZA',12),('EC','ECUADOR','Ecuador','ECU',218),('EE','ESTONIA','Estonia','EST',233),('EG','EGYPT','Egypt','EGY',818),('EH','WESTERN SAHARA','Western Sahara','ESH',732),('ER','ERITREA','Eritrea','ERI',232),('ES','SPAIN','Spain','ESP',724),('ET','ETHIOPIA','Ethiopia','ETH',231),('FI','FINLAND','Finland','FIN',246),('FJ','FIJI','Fiji','FJI',242),('FK','FALKLAND ISLANDS (MALVINAS)','Falkland Islands (Malvinas)','FLK',238),('FM','MICRONESIA, FEDERATED STATES OF','Micronesia, Federated States of','FSM',583),('FO','FAROE ISLANDS','Faroe Islands','FRO',234),('FR','FRANCE','France','FRA',250),('GA','GABON','Gabon','GAB',266),('GB','UNITED KINGDOM','United Kingdom','GBR',826),('GD','GRENADA','Grenada','GRD',308),('GE','GEORGIA','Georgia','GEO',268),('GF','FRENCH GUIANA','French Guiana','GUF',254),('GH','GHANA','Ghana','GHA',288),('GI','GIBRALTAR','Gibraltar','GIB',292),('GL','GREENLAND','Greenland','GRL',304),('GM','GAMBIA','Gambia','GMB',270),('GN','GUINEA','Guinea','GIN',324),('GP','GUADELOUPE','Guadeloupe','GLP',312),('GQ','EQUATORIAL GUINEA','Equatorial Guinea','GNQ',226),('GR','GREECE','Greece','GRC',300),('GS','SOUTH GEORGIA AND THE SOUTH SANDWICH ISLANDS','South Georgia and the South Sandwich Islands',NULL,NULL),('GT','GUATEMALA','Guatemala','GTM',320),('GU','GUAM','Guam','GUM',316),('GW','GUINEA-BISSAU','Guinea-Bissau','GNB',624),('GY','GUYANA','Guyana','GUY',328),('HK','HONG KONG','Hong Kong','HKG',344),('HM','HEARD ISLAND AND MCDONALD ISLANDS','Heard Island and Mcdonald Islands',NULL,NULL),('HN','HONDURAS','Honduras','HND',340),('HR','CROATIA','Croatia','HRV',191),('HT','HAITI','Haiti','HTI',332),('HU','HUNGARY','Hungary','HUN',348),('ID','INDONESIA','Indonesia','IDN',360),('IE','IRELAND','Ireland','IRL',372),('IL','ISRAEL','Israel','ISR',376),('IN','INDIA','India','IND',356),('IO','BRITISH INDIAN OCEAN TERRITORY','British Indian Ocean Territory',NULL,NULL),('IQ','IRAQ','Iraq','IRQ',368),('IR','IRAN, ISLAMIC REPUBLIC OF','Iran, Islamic Republic of','IRN',364),('IS','ICELAND','Iceland','ISL',352),('IT','ITALY','Italy','ITA',380),('JM','JAMAICA','Jamaica','JAM',388),('JO','JORDAN','Jordan','JOR',400),('JP','JAPAN','Japan','JPN',392),('KE','KENYA','Kenya','KEN',404),('KG','KYRGYZSTAN','Kyrgyzstan','KGZ',417),('KH','CAMBODIA','Cambodia','KHM',116),('KI','KIRIBATI','Kiribati','KIR',296),('KM','COMOROS','Comoros','COM',174),('KN','SAINT KITTS AND NEVIS','Saint Kitts and Nevis','KNA',659),('KP','KOREA, DEMOCRATIC PEOPLE\'S REPUBLIC OF','Korea, Democratic People\'s Republic of','PRK',408),('KR','KOREA, REPUBLIC OF','Korea, Republic of','KOR',410),('KW','KUWAIT','Kuwait','KWT',414),('KY','CAYMAN ISLANDS','Cayman Islands','CYM',136),('KZ','KAZAKHSTAN','Kazakhstan','KAZ',398),('LA','LAO PEOPLE\'S DEMOCRATIC REPUBLIC','Lao People\'s Democratic Republic','LAO',418),('LB','LEBANON','Lebanon','LBN',422),('LC','SAINT LUCIA','Saint Lucia','LCA',662),('LI','LIECHTENSTEIN','Liechtenstein','LIE',438),('LK','SRI LANKA','Sri Lanka','LKA',144),('LR','LIBERIA','Liberia','LBR',430),('LS','LESOTHO','Lesotho','LSO',426),('LT','LITHUANIA','Lithuania','LTU',440),('LU','LUXEMBOURG','Luxembourg','LUX',442),('LV','LATVIA','Latvia','LVA',428),('LY','LIBYAN ARAB JAMAHIRIYA','Libyan Arab Jamahiriya','LBY',434),('MA','MOROCCO','Morocco','MAR',504),('MC','MONACO','Monaco','MCO',492),('MD','MOLDOVA, REPUBLIC OF','Moldova, Republic of','MDA',498),('MG','MADAGASCAR','Madagascar','MDG',450),('MH','MARSHALL ISLANDS','Marshall Islands','MHL',584),('MK','MACEDONIA, THE FORMER YUGOSLAV REPUBLIC OF','Macedonia, the Former Yugoslav Republic of','MKD',807),('ML','MALI','Mali','MLI',466),('MM','MYANMAR','Myanmar','MMR',104),('MN','MONGOLIA','Mongolia','MNG',496),('MO','MACAO','Macao','MAC',446),('MP','NORTHERN MARIANA ISLANDS','Northern Mariana Islands','MNP',580),('MQ','MARTINIQUE','Martinique','MTQ',474),('MR','MAURITANIA','Mauritania','MRT',478),('MS','MONTSERRAT','Montserrat','MSR',500),('MT','MALTA','Malta','MLT',470),('MU','MAURITIUS','Mauritius','MUS',480),('MV','MALDIVES','Maldives','MDV',462),('MW','MALAWI','Malawi','MWI',454),('MX','MEXICO','Mexico','MEX',484),('MY','MALAYSIA','Malaysia','MYS',458),('MZ','MOZAMBIQUE','Mozambique','MOZ',508),('NA','NAMIBIA','Namibia','NAM',516),('NC','NEW CALEDONIA','New Caledonia','NCL',540),('NE','NIGER','Niger','NER',562),('NF','NORFOLK ISLAND','Norfolk Island','NFK',574),('NG','NIGERIA','Nigeria','NGA',566),('NI','NICARAGUA','Nicaragua','NIC',558),('NL','NETHERLANDS','Netherlands','NLD',528),('NO','NORWAY','Norway','NOR',578),('NP','NEPAL','Nepal','NPL',524),('NR','NAURU','Nauru','NRU',520),('NU','NIUE','Niue','NIU',570),('NZ','NEW ZEALAND','New Zealand','NZL',554),('OM','OMAN','Oman','OMN',512),('PA','PANAMA','Panama','PAN',591),('PE','PERU','Peru','PER',604),('PF','FRENCH POLYNESIA','French Polynesia','PYF',258),('PG','PAPUA NEW GUINEA','Papua New Guinea','PNG',598),('PH','PHILIPPINES','Philippines','PHL',608),('PK','PAKISTAN','Pakistan','PAK',586),('PL','POLAND','Poland','POL',616),('PM','SAINT PIERRE AND MIQUELON','Saint Pierre and Miquelon','SPM',666),('PN','PITCAIRN','Pitcairn','PCN',612),('PR','PUERTO RICO','Puerto Rico','PRI',630),('PS','PALESTINIAN TERRITORY, OCCUPIED','Palestinian Territory, Occupied',NULL,NULL),('PT','PORTUGAL','Portugal','PRT',620),('PW','PALAU','Palau','PLW',585),('PY','PARAGUAY','Paraguay','PRY',600),('QA','QATAR','Qatar','QAT',634),('RE','REUNION','Reunion','REU',638),('RO','ROMANIA','Romania','ROM',642),('RU','RUSSIAN FEDERATION','Russian Federation','RUS',643),('RW','RWANDA','Rwanda','RWA',646),('SA','SAUDI ARABIA','Saudi Arabia','SAU',682),('SB','SOLOMON ISLANDS','Solomon Islands','SLB',90),('SC','SEYCHELLES','Seychelles','SYC',690),('SD','SUDAN','Sudan','SDN',736),('SE','SWEDEN','Sweden','SWE',752),('SG','SINGAPORE','Singapore','SGP',702),('SH','SAINT HELENA','Saint Helena','SHN',654),('SI','SLOVENIA','Slovenia','SVN',705),('SJ','SVALBARD AND JAN MAYEN','Svalbard and Jan Mayen','SJM',744),('SK','SLOVAKIA','Slovakia','SVK',703),('SL','SIERRA LEONE','Sierra Leone','SLE',694),('SM','SAN MARINO','San Marino','SMR',674),('SN','SENEGAL','Senegal','SEN',686),('SO','SOMALIA','Somalia','SOM',706),('SR','SURINAME','Suriname','SUR',740),('ST','SAO TOME AND PRINCIPE','Sao Tome and Principe','STP',678),('SV','EL SALVADOR','El Salvador','SLV',222),('SY','SYRIAN ARAB REPUBLIC','Syrian Arab Republic','SYR',760),('SZ','SWAZILAND','Swaziland','SWZ',748),('TC','TURKS AND CAICOS ISLANDS','Turks and Caicos Islands','TCA',796),('TD','CHAD','Chad','TCD',148),('TF','FRENCH SOUTHERN TERRITORIES','French Southern Territories',NULL,NULL),('TG','TOGO','Togo','TGO',768),('TH','THAILAND','Thailand','THA',764),('TJ','TAJIKISTAN','Tajikistan','TJK',762),('TK','TOKELAU','Tokelau','TKL',772),('TL','TIMOR-LESTE','Timor-Leste',NULL,NULL),('TM','TURKMENISTAN','Turkmenistan','TKM',795),('TN','TUNISIA','Tunisia','TUN',788),('TO','TONGA','Tonga','TON',776),('TR','TURKEY','Turkey','TUR',792),('TT','TRINIDAD AND TOBAGO','Trinidad and Tobago','TTO',780),('TV','TUVALU','Tuvalu','TUV',798),('TW','TAIWAN, PROVINCE OF CHINA','Taiwan, Province of China','TWN',158),('TZ','TANZANIA, UNITED REPUBLIC OF','Tanzania, United Republic of','TZA',834),('UA','UKRAINE','Ukraine','UKR',804),('UG','UGANDA','Uganda','UGA',800),('UM','UNITED STATES MINOR OUTLYING ISLANDS','United States Minor Outlying Islands',NULL,NULL),('US','UNITED STATES','United States','USA',840),('UY','URUGUAY','Uruguay','URY',858),('UZ','UZBEKISTAN','Uzbekistan','UZB',860),('VA','HOLY SEE (VATICAN CITY STATE)','Holy See (Vatican City State)','VAT',336),('VC','SAINT VINCENT AND THE GRENADINES','Saint Vincent and the Grenadines','VCT',670),('VE','VENEZUELA','Venezuela','VEN',862),('VG','VIRGIN ISLANDS, BRITISH','Virgin Islands, British','VGB',92),('VI','VIRGIN ISLANDS, U.S.','Virgin Islands, U.s.','VIR',850),('VN','VIET NAM','Viet Nam','VNM',704),('VU','VANUATU','Vanuatu','VUT',548),('WF','WALLIS AND FUTUNA','Wallis and Futuna','WLF',876),('WS','SAMOA','Samoa','WSM',882),('YE','YEMEN','Yemen','YEM',887),('YT','MAYOTTE','Mayotte',NULL,NULL),('ZA','SOUTH AFRICA','South Africa','ZAF',710),('ZM','ZAMBIA','Zambia','ZMB',894),('ZW','ZIMBABWE','Zimbabwe','ZWE',716);

/*Table structure for table `bf_email_queue` */

DROP TABLE IF EXISTS `bf_email_queue`;

CREATE TABLE `bf_email_queue` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `to_email` varchar(128) NOT NULL,
  `subject` varchar(255) NOT NULL,
  `message` text NOT NULL,
  `alt_message` text,
  `max_attempts` int(11) NOT NULL DEFAULT '3',
  `attempts` int(11) NOT NULL DEFAULT '0',
  `success` tinyint(1) NOT NULL DEFAULT '0',
  `date_published` datetime DEFAULT NULL,
  `last_attempt` datetime DEFAULT NULL,
  `date_sent` datetime DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

/*Data for the table `bf_email_queue` */

/*Table structure for table `bf_items` */

DROP TABLE IF EXISTS `bf_items`;

CREATE TABLE `bf_items` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `category` enum('apparatus','chemical') NOT NULL DEFAULT 'apparatus',
  `name` varchar(255) NOT NULL,
  `description` text,
  `specifications` text,
  `quantity` int(11) DEFAULT NULL,
  `price` float(14,2) NOT NULL DEFAULT '0.00',
  `unit_of_measure` enum('grams','milligrams','liters') DEFAULT NULL,
  `penalty` float(14,2) NOT NULL DEFAULT '0.00',
  `damage_charge` float(14,2) NOT NULL DEFAULT '0.00',
  `status` enum('Active','Inactive') NOT NULL,
  `photo` text,
  `created_on` datetime NOT NULL DEFAULT '0000-00-00 00:00:00',
  `modified_on` datetime NOT NULL DEFAULT '0000-00-00 00:00:00',
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=17 DEFAULT CHARSET=utf8;

/*Data for the table `bf_items` */

insert  into `bf_items`(`id`,`category`,`name`,`description`,`specifications`,`quantity`,`price`,`unit_of_measure`,`penalty`,`damage_charge`,`status`,`photo`,`created_on`,`modified_on`) values (1,'apparatus','Pestel and Mortel','Pestel and Mortel','Pestel and Mortel',334,0.00,NULL,2.00,3.00,'Active','pestel-mortar.jpg','2014-01-07 13:49:33','2014-01-16 20:41:55'),(2,'apparatus','Burrete','Burrete','Burrete',4,0.00,NULL,0.00,0.00,'Active','burrete.jpg','2014-01-07 13:50:07','2014-01-14 14:10:21'),(3,'apparatus','Filter Funnel','Filter Funnel','Filter Funnel',20,0.00,NULL,20.00,0.00,'Active','filter-funnel.jpg','2014-01-12 04:03:24','2014-01-16 14:00:26'),(4,'apparatus','Gas Jar','Gas Jar','Gas Jar',20,0.00,'grams',33.00,44.00,'Active','gas-jar.JPG','2014-01-12 04:03:58','2014-02-12 14:28:21'),(5,'apparatus','Conical Flask','Conical Flask','Conical Flask',20,0.00,'grams',11.00,22.00,'Active','conical-flask.jpg','2014-01-12 04:04:41','2014-02-12 14:28:14'),(13,'apparatus','Pipet','Pipet','Pipet',20,0.00,NULL,30.00,25.00,'Active','pipet.jpg','2014-01-12 17:36:03','2014-01-15 17:26:45'),(14,'chemical','Sulfuric Acid','Sulfuric Acid','100g',100,23.15,'grams',0.00,0.00,'Active',NULL,'2014-02-09 13:57:48','2014-02-11 16:30:39'),(15,'chemical','Phosphorous acid','Phosphorous acid','50mg',155,45.23,'grams',0.00,0.00,'Active',NULL,'2014-02-09 14:01:22','2014-02-11 16:31:03'),(16,'chemical','Sodium Hydroxide','Sodium Hydroxide','100grams',100,24.23,'grams',22.00,33.00,'Active',NULL,'2014-02-11 16:50:17','2014-02-12 14:14:16');

/*Table structure for table `bf_lab_incharge` */

DROP TABLE IF EXISTS `bf_lab_incharge`;

CREATE TABLE `bf_lab_incharge` (
  `worker_id` int(11) NOT NULL AUTO_INCREMENT,
  `user_id` bigint(20) unsigned DEFAULT '0',
  `id_number` varchar(255) DEFAULT NULL,
  `firstname` varchar(255) NOT NULL,
  `lastname` varchar(255) NOT NULL,
  `address` text NOT NULL,
  `contact_details` text NOT NULL,
  `status` enum('Active','Inactive') DEFAULT NULL,
  `created_on` datetime NOT NULL DEFAULT '0000-00-00 00:00:00',
  `modified_on` datetime NOT NULL DEFAULT '0000-00-00 00:00:00',
  PRIMARY KEY (`worker_id`),
  KEY `SECONDARY` (`user_id`)
) ENGINE=InnoDB AUTO_INCREMENT=2 DEFAULT CHARSET=utf8;

/*Data for the table `bf_lab_incharge` */

insert  into `bf_lab_incharge`(`worker_id`,`user_id`,`id_number`,`firstname`,`lastname`,`address`,`contact_details`,`status`,`created_on`,`modified_on`) values (1,21,NULL,'Test','Testing','...','',NULL,'2014-02-15 13:44:59','0000-00-00 00:00:00');

/*Table structure for table `bf_laboratories` */

DROP TABLE IF EXISTS `bf_laboratories`;

CREATE TABLE `bf_laboratories` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `name` varchar(255) NOT NULL,
  `teacher_id` int(11) NOT NULL,
  `worker_id` int(11) NOT NULL,
  `subject_id` int(11) NOT NULL,
  `status` enum('Active','Inactive') NOT NULL,
  `created_on` datetime NOT NULL DEFAULT '0000-00-00 00:00:00',
  `modified_on` datetime NOT NULL DEFAULT '0000-00-00 00:00:00',
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=2 DEFAULT CHARSET=utf8;

/*Data for the table `bf_laboratories` */

insert  into `bf_laboratories`(`id`,`name`,`teacher_id`,`worker_id`,`subject_id`,`status`,`created_on`,`modified_on`) values (1,'Test',3,1,1,'Inactive','2013-12-13 16:20:21','2014-01-07 13:55:21');

/*Table structure for table `bf_login_attempts` */

DROP TABLE IF EXISTS `bf_login_attempts`;

CREATE TABLE `bf_login_attempts` (
  `id` bigint(20) NOT NULL AUTO_INCREMENT,
  `ip_address` varchar(40) NOT NULL,
  `login` varchar(50) NOT NULL,
  `time` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

/*Data for the table `bf_login_attempts` */

/*Table structure for table `bf_notifications` */

DROP TABLE IF EXISTS `bf_notifications`;

CREATE TABLE `bf_notifications` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `user_id` int(11) NOT NULL DEFAULT '0',
  `role_user` enum('admin','labincharge','teacher','student') DEFAULT NULL,
  `description` text NOT NULL,
  `page` varchar(255) NOT NULL,
  `details` text,
  `seen` enum('Yes','No') NOT NULL,
  `created_on` datetime NOT NULL DEFAULT '0000-00-00 00:00:00',
  `modified_on` datetime NOT NULL DEFAULT '0000-00-00 00:00:00',
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=80 DEFAULT CHARSET=utf8;

/*Data for the table `bf_notifications` */

insert  into `bf_notifications`(`id`,`user_id`,`role_user`,`description`,`page`,`details`,`seen`,`created_on`,`modified_on`) values (1,1,'admin','New Student has registered to the system','http://borrowme.local/admin/users/student/edit/9',NULL,'Yes','2014-01-16 03:42:15','2014-01-22 17:30:59'),(2,1,'admin','Student borrowed an item','http://borrowme.local/admin/logs/returned_items/edit/38',NULL,'Yes','2014-01-16 04:49:14','2014-01-22 16:44:16'),(3,1,'admin','Student borrowed an item','http://borrowme.local/admin/logs/returned_items/edit/40',NULL,'Yes','2014-01-16 17:15:46','2014-01-22 17:30:59'),(4,1,'admin','Student borrowed an item','http://borrowme.local/admin/logs/returned_items/edit/41',NULL,'Yes','2014-01-16 17:37:49','2014-01-22 16:44:16'),(5,1,'admin','Student borrowed an item','http://borrowme.local/admin/logs/returned_items/edit/42',NULL,'Yes','2014-01-16 17:37:49','2014-01-22 16:50:33'),(6,1,'admin','Student borrowed an item','http://borrowme.local/admin/logs/returned_items/edit/43',NULL,'Yes','2014-01-16 19:02:50','2014-01-22 17:30:59'),(7,1,'admin','Student borrowed an item','http://borrowme.local/admin/logs/returned_items/edit/44',NULL,'Yes','2014-01-16 19:20:44','2014-01-22 16:40:41'),(8,1,'admin','Student borrowed an item','http://borrowme.local/admin/logs/returned_items/edit/45',NULL,'Yes','2014-01-16 19:20:44','2014-01-22 16:33:31'),(9,1,'admin','New Student has registered to the system','http://borrowme.local/admin/users/student/edit/10',NULL,'Yes','2014-01-16 19:29:07','2014-01-22 17:30:59'),(10,1,'admin','Student borrowed an item','http://borrowme.local/admin/logs/returned_items/edit/46',NULL,'Yes','2014-01-16 19:57:26','2014-01-22 16:44:16'),(11,1,'admin','New Student has registered to the system','http://borrowme.local/admin/users/student/edit/11',NULL,'Yes','2014-01-16 20:59:35','2014-01-22 16:33:31'),(12,1,'admin','New Student has registered to the system','http://borrowme.local/admin/users/student/edit/12',NULL,'Yes','2014-01-22 17:17:47','2014-01-22 17:20:30'),(13,1,'admin','Student borrowed an item','http://borrowme.local/admin/logs/returned_items/edit/47',NULL,'Yes','2014-01-28 15:27:40','2014-01-28 16:24:52'),(14,1,'admin','Student borrowed an item','http://borrowme.local/admin/logs/returned_items/edit/48',NULL,'Yes','2014-01-28 15:28:13','2014-01-28 16:24:52'),(15,1,'admin','Student borrowed an item','http://borrowme.local/admin/logs/returned_items/edit/49',NULL,'Yes','2014-01-28 15:28:13','2014-01-28 16:24:52'),(16,1,'admin','Student borrowed an item','http://borrowme.local/admin/logs/returned_items/edit/50',NULL,'Yes','2014-01-28 16:08:33','2014-01-28 16:24:52'),(17,1,'admin','Student borrowed an item','http://borrowme.local/admin/logs/returned_items/edit/51',NULL,'Yes','2014-01-28 16:08:33','2014-01-28 16:24:52'),(18,1,'admin','Student borrowed an item','http://borrowme.local/admin/logs/returned_items/edit/52',NULL,'Yes','2014-02-01 07:46:34','2014-02-01 07:47:03'),(19,1,'admin','Student borrowed an item','http://borrowme.local/admin/logs/returned_items/edit/53',NULL,'Yes','2014-02-01 07:46:34','2014-02-01 07:47:03'),(20,1,'admin','Student borrowed an item','http://borrowme.local/admin/logs/returned_items/edit/54',NULL,'Yes','2014-02-01 07:46:35','2014-02-01 07:47:03'),(21,1,'admin','Student borrowed an item','http://borrowme.local/admin/logs/returned_items/edit/55',NULL,'Yes','2014-02-01 08:12:02','2014-02-01 08:12:20'),(22,1,'admin','Student borrowed an item','http://borrowme.local/admin/logs/returned_items/edit/56',NULL,'Yes','2014-02-01 08:12:02','2014-02-01 08:12:20'),(23,1,'admin','Student borrowed an item','http://borrowme.local/admin/logs/returned_items/edit/57',NULL,'Yes','2014-02-01 08:12:02','2014-02-01 08:12:20'),(24,1,'admin','Student borrowed an item','http://borrowme.local/admin/logs/returned_items/edit/58',NULL,'Yes','2014-02-01 08:16:04','2014-02-01 08:16:29'),(25,1,'admin','Student borrowed an item','http://borrowme.local/admin/logs/returned_items/edit/59',NULL,'Yes','2014-02-01 08:16:04','2014-02-01 08:16:29'),(26,1,'admin','Student borrowed an item','http://borrowme.local/admin/logs/returned_items/edit/60',NULL,'Yes','2014-02-01 08:16:04','2014-02-01 08:16:29'),(27,1,'admin','Student borrowed an item','http://borrowme.local/admin/logs/returned_items/edit/61',NULL,'Yes','2014-02-01 08:19:48','2014-02-01 08:20:20'),(28,1,'admin','Student borrowed an item','http://borrowme.local/admin/logs/returned_items/edit/62',NULL,'Yes','2014-02-01 08:19:48','2014-02-01 08:20:20'),(29,1,'admin','Student borrowed an item','http://borrowme.local/admin/logs/returned_items/edit/63',NULL,'Yes','2014-02-01 08:19:48','2014-02-01 08:20:20'),(30,1,'admin','Student borrowed an item','http://borrowme.local/admin/logs/returned_items/edit/64',NULL,'Yes','2014-02-01 08:28:52','2014-02-01 08:29:10'),(31,1,'admin','Student borrowed an item','http://borrowme.local/admin/logs/returned_items/edit/65',NULL,'Yes','2014-02-01 08:28:52','2014-02-01 08:29:10'),(32,1,'admin','Student borrowed an item','http://borrowme.local/admin/logs/returned_items/edit/66',NULL,'Yes','2014-02-01 08:28:52','2014-02-01 08:29:10'),(33,1,'admin','Student borrowed an item','http://borrowme.local/admin/logs/returned_items/edit/67',NULL,'Yes','2014-02-01 08:31:56','2014-02-01 08:32:12'),(34,1,'admin','Student borrowed an item','http://borrowme.local/admin/logs/returned_items/edit/68',NULL,'Yes','2014-02-01 08:31:56','2014-02-01 08:32:12'),(35,1,'admin','Student borrowed an item','http://borrowme.local/admin/logs/returned_items/edit/69',NULL,'Yes','2014-02-01 08:31:56','2014-02-01 08:32:12'),(36,1,'admin','Student borrowed an item','http://borrowme.local/admin/logs/returned_items/edit/70',NULL,'Yes','2014-02-04 15:00:20','2014-02-04 15:00:41'),(37,1,'admin','Student borrowed an item','http://borrowme.local/admin/logs/returned_items/edit/71',NULL,'Yes','2014-02-11 15:51:41','2014-02-11 15:51:47'),(38,1,'admin','Student borrowed an item','http://borrowme.local/admin/logs/returned_items/edit/72',NULL,'Yes','2014-02-11 15:51:41','2014-02-11 15:51:47'),(39,1,'admin','Student borrowed an item','http://borrowme.local/admin/logs/returned_items/edit/73',NULL,'Yes','2014-02-11 16:06:01','2014-02-11 16:06:15'),(40,1,'admin','Student borrowed an item','http://borrowme.local/admin/logs/returned_items/edit/74',NULL,'Yes','2014-02-11 16:06:01','2014-02-11 16:06:15'),(41,16,'student','Student borrowed an item','http://borrowme.local/admin/logs/returned_items/edit/75',NULL,'Yes','2014-02-11 16:12:07','2014-02-11 16:12:33'),(42,16,'student','Student borrowed an item','http://borrowme.local/admin/logs/returned_items/edit/76',NULL,'Yes','2014-02-11 16:12:07','2014-02-11 16:12:33'),(43,16,'student','ITEMS: Pestel and Mortel,Burrete are available for pick-up. If DONE, ignore this message.','','[ID:76] [DATE:2014-02-11]','Yes','2014-02-11 16:12:20','2014-02-11 16:12:33'),(44,1,'admin','Student borrowed an item','http://borrowme.local/admin/logs/returned_items/edit/77',NULL,'Yes','2014-02-11 17:08:56','2014-02-11 17:09:04'),(45,1,'admin','Student borrowed an item','http://borrowme.local/admin/logs/returned_items/edit/78',NULL,'Yes','2014-02-11 17:08:56','2014-02-11 17:09:04'),(46,16,'student','ITEMS: Sodium Hydroxide,Conical Flask are available for pick-up. If DONE, ignore this message.','','[ID:78] [DATE:2014-02-11]','Yes','2014-02-11 17:12:11','2014-02-11 17:23:00'),(47,1,'admin','Student borrowed an item','http://borrowme.local/admin/logs/returned_items/edit/79',NULL,'Yes','2014-02-11 17:23:17','2014-02-11 17:23:24'),(48,1,'admin','ITEMS: Sodium Hydroxide are available for pick-up. If DONE, ignore this message.','','[ID:79] [DATE:2014-02-11]','Yes','2014-02-12 14:13:21','2014-02-12 14:25:49'),(49,1,'admin','Student borrowed an item','http://borrowme.local/admin/logs/returned_items/edit/80',NULL,'Yes','2014-02-12 14:25:44','2014-02-12 14:25:49'),(50,1,'admin','Student borrowed an item','http://borrowme.local/admin/logs/returned_items/edit/81',NULL,'Yes','2014-02-12 14:25:44','2014-02-12 14:25:49'),(51,19,'student','ITEMS: Conical Flask,Gas Jar are available for pick-up. If DONE, ignore this message.','','[ID:81] [DATE:2014-02-12]','Yes','2014-02-12 14:27:37','2014-02-12 14:59:20'),(52,1,'admin','Student borrowed an item','http://borrowme.local/admin/logs/returned_items/edit/82',NULL,'Yes','2014-02-12 15:00:01','2014-02-12 15:00:06'),(53,1,'admin','Student borrowed an item','http://borrowme.local/admin/logs/returned_items/edit/83',NULL,'Yes','2014-02-12 15:00:01','2014-02-12 15:00:06'),(54,19,'student','ITEMS: Sulfuric Acid,Phosphorous acid are available for pick-up. If DONE, ignore this message.','','[ID:83] [DATE:2014-02-12]','Yes','2014-02-12 15:02:09','2014-02-12 15:02:13'),(55,1,'admin','Student borrowed an item','http://borrowme.local/admin/logs/returned_items/edit/84',NULL,'Yes','2014-02-12 15:03:09','2014-02-12 15:03:14'),(56,1,'admin','Student borrowed an item','http://borrowme.local/admin/logs/returned_items/edit/85',NULL,'Yes','2014-02-12 15:03:09','2014-02-12 15:03:14'),(57,1,'admin','Student borrowed an item','http://borrowme.local/admin/logs/returned_items/edit/86',NULL,'Yes','2014-02-12 15:03:09','2014-02-12 15:03:14'),(58,1,'admin','Student borrowed an item','http://borrowme.local/admin/logs/returned_items/edit/87',NULL,'Yes','2014-02-12 15:03:09','2014-02-12 15:03:14'),(59,19,'student','ITEMS: Filter Funnel,Gas Jar,Sulfuric Acid,Phosphorous acid are available for pick-up. If DONE, ignore this message.','','[ID:87] [DATE:2014-02-12] [TOTAL:]','Yes','2014-02-12 15:07:52','2014-02-12 15:07:57'),(60,1,'admin','Student borrowed an item','http://borrowme.local/admin/logs/returned_items/edit/88',NULL,'Yes','2014-02-12 15:09:40','2014-02-12 15:09:46'),(61,1,'admin','Student borrowed an item','http://borrowme.local/admin/logs/returned_items/edit/89',NULL,'Yes','2014-02-12 15:09:40','2014-02-12 15:09:46'),(62,1,'admin','Student borrowed an item','http://borrowme.local/admin/logs/returned_items/edit/90',NULL,'Yes','2014-02-12 15:09:40','2014-02-12 15:09:46'),(63,1,'admin','Student borrowed an item','http://borrowme.local/admin/logs/returned_items/edit/91',NULL,'Yes','2014-02-12 15:09:40','2014-02-12 15:09:46'),(64,19,'student','ITEMS: Filter Funnel,Gas Jar,Phosphorous acid,Sodium Hydroxide are available for pick-up. If DONE, ignore this message.','','[ID:91] [DATE:2014-02-12] [TOTAL:]','Yes','2014-02-12 15:10:55','2014-02-12 15:10:59'),(65,1,'admin','Student borrowed an item','http://borrowme.local/admin/logs/returned_items/edit/92',NULL,'Yes','2014-02-12 15:11:30','2014-02-12 15:11:35'),(66,1,'admin','Student borrowed an item','http://borrowme.local/admin/logs/returned_items/edit/93',NULL,'Yes','2014-02-12 15:11:30','2014-02-12 15:11:35'),(67,1,'admin','Student borrowed an item','http://borrowme.local/admin/logs/returned_items/edit/94',NULL,'Yes','2014-02-12 15:11:30','2014-02-12 15:11:35'),(68,19,'student','ITEMS: Sulfuric Acid,Phosphorous acid,Sodium Hydroxide are available for pick-up. If DONE, ignore this message.','','[ID:94] [DATE:2014-02-12] [TOTAL:185.22]','Yes','2014-02-12 15:18:35','2014-02-12 15:18:45'),(69,1,'admin','Student borrowed an item','http://borrowme.local/admin/logs/returned_items/edit/95',NULL,'Yes','2014-02-12 15:21:07','2014-02-12 15:21:13'),(70,1,'admin','Student borrowed an item','http://borrowme.local/admin/logs/returned_items/edit/96',NULL,'Yes','2014-02-12 15:21:08','2014-02-12 15:21:13'),(71,1,'admin','Student borrowed an item','http://borrowme.local/admin/logs/returned_items/edit/97',NULL,'Yes','2014-02-12 15:21:08','2014-02-12 15:21:13'),(72,1,'admin','Student borrowed an item','http://borrowme.local/admin/logs/returned_items/edit/98',NULL,'Yes','2014-02-12 15:21:08','2014-02-12 15:21:13'),(73,1,'admin','Student borrowed an item','http://borrowme.local/admin/logs/returned_items/edit/99',NULL,'Yes','2014-02-12 15:21:08','2014-02-12 15:21:13'),(74,19,'student','ITEMS: Pestel and Mortel,Burrete,Filter Funnel,Gas Jar,Conical Flask are available for pick-up. If DONE, ignore this message.','','[ID:99] [DATE:2014-02-12] [TOTAL:0]','Yes','2014-02-12 15:21:24','2014-02-12 15:23:19'),(75,19,'student','You have a PENALTY CHARGE to pay!','','[ID:99] [DATE:2014-02-12] [TOTAL:69]','Yes','2014-02-12 15:23:15','2014-02-12 15:23:19'),(76,1,'admin','Student borrowed an item','http://borrowme.local/admin/logs/returned_items/edit/100',NULL,'Yes','2014-02-12 15:23:42','2014-02-12 15:29:13'),(77,1,'admin','Student borrowed an item','http://borrowme.local/admin/logs/returned_items/edit/101',NULL,'Yes','2014-02-12 15:23:42','2014-02-12 15:29:13'),(78,1,'admin','Student borrowed an item','http://borrowme.local/admin/logs/returned_items/edit/102',NULL,'Yes','2014-02-12 15:23:43','2014-02-12 15:29:13'),(79,19,'student','ITEMS: Sulfuric Acid,Phosphorous acid,Sodium Hydroxide are available for pick-up. If DONE, ignore this message.','','[ID:102] [DATE:2014-02-12] [TOTAL:209.45]','Yes','2014-02-12 15:29:33','2014-02-12 15:33:02');

/*Table structure for table `bf_permissions` */

DROP TABLE IF EXISTS `bf_permissions`;

CREATE TABLE `bf_permissions` (
  `permission_id` int(11) NOT NULL AUTO_INCREMENT,
  `name` varchar(255) NOT NULL,
  `description` varchar(100) NOT NULL,
  `status` enum('active','inactive','deleted') NOT NULL DEFAULT 'active',
  PRIMARY KEY (`permission_id`)
) ENGINE=InnoDB AUTO_INCREMENT=101 DEFAULT CHARSET=utf8;

/*Data for the table `bf_permissions` */

insert  into `bf_permissions`(`permission_id`,`name`,`description`,`status`) values (2,'Site.Content.View','Allow users to view the Content Context','active'),(3,'Site.Reports.View','Allow users to view the Reports Context','active'),(4,'Site.Settings.View','Allow users to view the Settings Context','active'),(5,'Site.Developer.View','Allow users to view the Developer Context','active'),(6,'Bonfire.Roles.Manage','Allow users to manage the user Roles','active'),(7,'Bonfire.Users.Manage','Allow users to manage the site Users','active'),(8,'Bonfire.Users.View','Allow users access to the User Settings','active'),(9,'Bonfire.Users.Add','Allow users to add new Users','active'),(10,'Bonfire.Database.Manage','Allow users to manage the Database settings','active'),(11,'Bonfire.Emailer.Manage','Allow users to manage the Emailer settings','active'),(12,'Bonfire.Logs.View','Allow users access to the Log details','active'),(13,'Bonfire.Logs.Manage','Allow users to manage the Log files','active'),(14,'Bonfire.Emailer.View','Allow users access to the Emailer settings','active'),(15,'Site.Signin.Offline','Allow users to login to the site when the site is offline','active'),(16,'Bonfire.Permissions.View','Allow access to view the Permissions menu unders Settings Context','active'),(17,'Bonfire.Permissions.Manage','Allow access to manage the Permissions in the system','active'),(18,'Bonfire.Roles.Delete','Allow users to delete user Roles','active'),(19,'Bonfire.Modules.Add','Allow creation of modules with the builder.','active'),(20,'Bonfire.Modules.Delete','Allow deletion of modules.','active'),(21,'Permissions.Administrator.Manage','To manage the access control permissions for the Administrator role.','active'),(22,'Permissions.Editor.Manage','To manage the access control permissions for the Editor role.','active'),(24,'Permissions.User.Manage','To manage the access control permissions for the User role.','active'),(25,'Permissions.Developer.Manage','To manage the access control permissions for the Developer role.','active'),(27,'Activities.Own.View','To view the users own activity logs','active'),(28,'Activities.Own.Delete','To delete the users own activity logs','active'),(29,'Activities.User.View','To view the user activity logs','active'),(30,'Activities.User.Delete','To delete the user activity logs, except own','active'),(31,'Activities.Module.View','To view the module activity logs','active'),(32,'Activities.Module.Delete','To delete the module activity logs','active'),(33,'Activities.Date.View','To view the users own activity logs','active'),(34,'Activities.Date.Delete','To delete the dated activity logs','active'),(35,'Bonfire.UI.Manage','Manage the Bonfire UI settings','active'),(36,'Bonfire.Settings.View','To view the site settings page.','active'),(37,'Bonfire.Settings.Manage','To manage the site settings.','active'),(38,'Bonfire.Activities.View','To view the Activities menu.','active'),(39,'Bonfire.Database.View','To view the Database menu.','active'),(40,'Bonfire.Migrations.View','To view the Migrations menu.','active'),(41,'Bonfire.Builder.View','To view the Modulebuilder menu.','active'),(42,'Bonfire.Roles.View','To view the Roles menu.','active'),(43,'Bonfire.Sysinfo.View','To view the System Information page.','active'),(44,'Bonfire.Translate.Manage','To manage the Language Translation.','active'),(45,'Bonfire.Translate.View','To view the Language Translate menu.','active'),(46,'Bonfire.UI.View','To view the UI/Keyboard Shortcut menu.','active'),(49,'Bonfire.Profiler.View','To view the Console Profiler Bar.','active'),(50,'Bonfire.Roles.Add','To add New Roles','active'),(51,'Site.Users.View','Allow user to view the Users Context.','active'),(56,'Teachers.Users.View','','active'),(57,'Teachers.Users.Create','','active'),(58,'Teachers.Users.Edit','','active'),(59,'Teachers.Users.Delete','','active'),(60,'Students.Users.View','','active'),(61,'Students.Users.Create','','active'),(62,'Students.Users.Edit','','active'),(63,'Students.Users.Delete','','active'),(64,'Lab_Incharge.Users.View','','active'),(65,'Lab_Incharge.Users.Create','','active'),(66,'Lab_Incharge.Users.Edit','','active'),(67,'Lab_Incharge.Users.Delete','','active'),(68,'Site.Resources.View','Allow user to view the Resources Context.','active'),(69,'Laboratories.Resources.View','','active'),(70,'Laboratories.Resources.Create','','active'),(71,'Laboratories.Resources.Edit','','active'),(72,'Laboratories.Resources.Delete','','active'),(73,'Subjects.Resources.View','','active'),(74,'Subjects.Resources.Create','','active'),(75,'Subjects.Resources.Edit','','active'),(76,'Subjects.Resources.Delete','','active'),(77,'Items.Resources.View','','active'),(78,'Items.Resources.Create','','active'),(79,'Items.Resources.Edit','','active'),(80,'Items.Resources.Delete','','active'),(81,'Site.Logs.View','Allow user to view the Logs Context.','active'),(82,'Returned_Items.Resources.View','','active'),(83,'Returned_Items.Resources.Create','','active'),(84,'Returned_Items.Resources.Edit','','active'),(85,'Returned_Items.Resources.Delete','','active'),(86,'Returned_Items.Logs.View','','active'),(87,'Returned_Items.Logs.Create','','active'),(88,'Returned_Items.Logs.Edit','','active'),(89,'Returned_Items.Logs.Delete','','active'),(90,'Notifications.Logs.View','','active'),(91,'Notifications.Logs.Delete','','active'),(92,'Site.Orders.View','Allow user to view the Orders Context.','active'),(93,'Sales_Order.Orders.View','','active'),(94,'Sales_Order.Orders.Create','','active'),(95,'Sales_Order.Orders.Edit','','active'),(96,'Sales_Order.Orders.Delete','','active'),(97,'Purchase_Order.Orders.View','','active'),(98,'Purchase_Order.Orders.Create','','active'),(99,'Purchase_Order.Orders.Edit','','active'),(100,'Purchase_Order.Orders.Delete','','active');

/*Table structure for table `bf_purchase_order` */

DROP TABLE IF EXISTS `bf_purchase_order`;

CREATE TABLE `bf_purchase_order` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `purchase_order_no` varchar(255) NOT NULL,
  `sales_order_id` int(11) NOT NULL,
  `supplier` varchar(255) DEFAULT NULL,
  `address` text,
  `terms` enum('15days','30days') DEFAULT NULL,
  `contact_person` varchar(255) DEFAULT NULL,
  `ordered_by` varchar(255) DEFAULT NULL,
  `requested_by` varchar(255) DEFAULT NULL,
  `received_by` varchar(255) DEFAULT NULL,
  `status` enum('pending','approved') NOT NULL,
  `deleted` tinyint(1) DEFAULT '0',
  `created_on` datetime DEFAULT '0000-00-00 00:00:00',
  `modified_on` datetime DEFAULT '0000-00-00 00:00:00',
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=4 DEFAULT CHARSET=utf8;

/*Data for the table `bf_purchase_order` */

insert  into `bf_purchase_order`(`id`,`purchase_order_no`,`sales_order_id`,`supplier`,`address`,`terms`,`contact_person`,`ordered_by`,`requested_by`,`received_by`,`status`,`deleted`,`created_on`,`modified_on`) values (2,'PO123',2,'Test Supplier','....','15days','Youss','Test Orders','Test Requests','Test Receives','approved',0,'2014-02-16 17:45:13','2014-02-16 18:30:20'),(3,'WHPO123',3,'Wheelmasters','North reclamation area, Mandaue city 6300','30days','Ronnie Balabat','Test Orders','Test Requests','Test Receives','approved',0,'2014-02-16 18:35:24','2014-02-16 18:36:34');

/*Table structure for table `bf_purchase_order_details` */

DROP TABLE IF EXISTS `bf_purchase_order_details`;

CREATE TABLE `bf_purchase_order_details` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `purchase_order_id` int(11) NOT NULL DEFAULT '0',
  `item_id` int(11) DEFAULT '0',
  `quantity` float(14,2) DEFAULT '0.00',
  `unit_cost` float(14,2) DEFAULT '0.00',
  `total` float(14,2) DEFAULT '0.00',
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=63 DEFAULT CHARSET=latin1;

/*Data for the table `bf_purchase_order_details` */

insert  into `bf_purchase_order_details`(`id`,`purchase_order_id`,`item_id`,`quantity`,`unit_cost`,`total`) values (41,2,1,234.00,23.00,5382.00),(42,2,15,55.00,344.00,18920.00),(59,3,13,18.00,200.00,3600.00),(60,3,5,7.00,150.00,1050.00),(61,3,4,5.00,120.00,600.00),(62,3,3,6.00,135.44,812.64);

/*Table structure for table `bf_returned_items` */

DROP TABLE IF EXISTS `bf_returned_items`;

CREATE TABLE `bf_returned_items` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `worker_id` int(11) DEFAULT NULL,
  `student_id` int(11) DEFAULT NULL,
  `item_id` int(11) DEFAULT NULL,
  `item_status` enum('ok','broken') NOT NULL,
  `damage_charge` float(14,2) DEFAULT NULL,
  `quantity` int(11) DEFAULT NULL,
  `return_qty` int(11) DEFAULT '0',
  `due_date` date NOT NULL DEFAULT '0000-00-00',
  `overdue_charge` float(14,2) DEFAULT NULL,
  `status` enum('pending','approved','borrowed','lacking','returned') NOT NULL,
  `confirmation_code` varchar(255) DEFAULT NULL,
  `id_number` varchar(255) DEFAULT NULL,
  `date_borrowed` date NOT NULL DEFAULT '0000-00-00',
  `created_on` date DEFAULT '0000-00-00',
  `modified_on` date DEFAULT '0000-00-00',
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=103 DEFAULT CHARSET=utf8;

/*Data for the table `bf_returned_items` */

insert  into `bf_returned_items`(`id`,`worker_id`,`student_id`,`item_id`,`item_status`,`damage_charge`,`quantity`,`return_qty`,`due_date`,`overdue_charge`,`status`,`confirmation_code`,`id_number`,`date_borrowed`,`created_on`,`modified_on`) values (34,0,8,1,'ok',NULL,2,2,'2014-01-20',50.00,'returned','49bb10d4322195cf',NULL,'0000-00-00','2014-01-15','2014-01-15'),(35,0,8,2,'ok',NULL,5,5,'2014-01-23',25.00,'returned','6c476e77217e8245',NULL,'2014-01-20','2014-01-15','2014-01-15'),(36,0,8,4,'ok',NULL,5,3,'2014-01-08',0.00,'returned','2962bd49be51b77b',NULL,'2014-01-05','2014-01-15','2014-01-15'),(38,NULL,8,2,'ok',NULL,6,0,'0000-00-00',NULL,'returned','79c04292414331b9',NULL,'0000-00-00','2014-01-16','2014-01-16'),(39,NULL,8,3,'ok',NULL,15,15,'2014-01-13',60.00,'returned','6c476e77217e8245',NULL,'2014-01-10','2014-01-17','2014-01-17'),(40,NULL,8,3,'ok',0.00,5,5,'2014-01-20',0.00,'returned','084ec236f72611d2',NULL,'2014-01-17','2014-01-16','2014-01-16'),(41,NULL,8,2,'ok',0.00,5,5,'2014-01-25',0.00,'returned','8c475d694cb3a45d',NULL,'2014-01-22','2014-01-16','2014-01-16'),(42,NULL,8,4,'ok',0.00,4,4,'2014-01-25',0.00,'returned','8c475d694cb3a45d',NULL,'2014-01-22','2014-01-16','2014-01-16'),(43,NULL,8,4,'ok',0.00,5,5,'2014-01-20',0.00,'returned','29653d61102d30f5',NULL,'2014-01-17','2014-01-16','2014-01-16'),(44,NULL,8,1,'ok',0.00,5,1,'2014-01-12',0.00,'returned','ed8478a2b930c8c7',NULL,'2014-01-09','2014-01-16','2014-01-16'),(45,NULL,8,1,'ok',0.00,5,5,'2014-01-24',0.00,'returned','37739a4b84c1fc19',NULL,'2014-01-21','2014-01-16','2014-01-16'),(46,NULL,8,2,'ok',0.00,5,3,'2014-01-24',0.00,'lacking','de916151e2398232',NULL,'2014-01-21','2014-01-16','2014-01-16'),(47,NULL,11,2,'ok',0.00,2,2,'2014-02-04',0.00,'returned','b6190604313f8354','ARC-123','2014-02-01','2014-01-28','2014-01-28'),(48,NULL,11,4,'ok',0.00,3,3,'2014-01-31',0.00,'returned','2d1785a11fb88709','ARC-123','2014-01-28','2014-01-28','2014-01-28'),(49,NULL,11,5,'ok',0.00,5,5,'2014-01-31',0.00,'returned','2d1785a11fb88709','ARC-123','2014-01-28','2014-01-28','2014-01-28'),(50,NULL,11,3,'ok',0.00,5,5,'2014-01-31',0.00,'returned','f4a2a10f26521d5b','ARC-123','2014-01-28','2014-01-28','2014-01-28'),(51,NULL,11,2,'ok',0.00,4,4,'2014-01-31',0.00,'returned','f4a2a10f26521d5b','ARC-123','2014-01-28','2014-01-28','2014-01-28'),(52,NULL,8,3,'ok',0.00,5,5,'2014-02-04',0.00,'returned',NULL,'ARC-124','2014-02-01','2014-02-01','2014-02-01'),(53,NULL,8,1,'ok',0.00,3,3,'2014-02-04',0.00,'returned',NULL,'ARC-124','2014-02-01','2014-02-01','2014-02-01'),(54,NULL,8,5,'ok',0.00,4,4,'2014-02-04',0.00,'returned',NULL,'ARC-124','2014-02-01','2014-02-01','2014-02-01'),(55,NULL,11,1,'ok',0.00,3,3,'2014-02-05',0.00,'returned',NULL,'ARC-123','2014-02-02','2014-02-01','2014-02-01'),(56,NULL,11,2,'ok',0.00,3,3,'2014-02-05',0.00,'returned',NULL,'ARC-123','2014-02-02','2014-02-01','2014-02-01'),(57,NULL,11,3,'ok',0.00,3,3,'2014-02-05',0.00,'returned',NULL,'ARC-123','2014-02-02','2014-02-01','2014-02-01'),(58,NULL,11,1,'ok',0.00,3,3,'2014-02-05',0.00,'returned',NULL,'ARC-123','2014-02-02','2014-02-01','2014-02-01'),(59,NULL,11,2,'ok',0.00,3,3,'2014-02-05',0.00,'returned',NULL,'ARC-123','2014-02-02','2014-02-01','2014-02-01'),(60,NULL,11,3,'ok',0.00,3,3,'2014-02-05',0.00,'returned',NULL,'ARC-123','2014-02-02','2014-02-01','2014-02-01'),(61,NULL,11,1,'ok',0.00,8,8,'2014-02-05',0.00,'returned',NULL,'ARC-123','2014-02-02','2014-02-01','2014-02-01'),(62,NULL,11,2,'ok',0.00,9,9,'2014-02-05',0.00,'returned',NULL,'ARC-123','2014-02-02','2014-02-01','2014-02-01'),(63,NULL,11,3,'ok',0.00,9,9,'2014-02-05',0.00,'returned',NULL,'ARC-123','2014-02-02','2014-02-01','2014-02-01'),(64,NULL,11,1,'ok',0.00,8,8,'2014-02-06',0.00,'returned',NULL,'ARC-123','2014-02-03','2014-02-01','2014-02-01'),(65,NULL,11,2,'ok',0.00,9,9,'2014-02-06',0.00,'returned',NULL,'ARC-123','2014-02-03','2014-02-01','2014-02-01'),(66,NULL,11,3,'ok',0.00,9,9,'2014-02-06',0.00,'returned',NULL,'ARC-123','2014-02-03','2014-02-01','2014-02-01'),(67,NULL,11,1,'ok',0.00,2,2,'2014-02-06',0.00,'returned',NULL,'ARC-123','2014-02-03','2014-02-01','2014-02-01'),(68,NULL,11,2,'ok',0.00,1,1,'2014-02-06',0.00,'returned',NULL,'ARC-123','2014-02-03','2014-02-01','2014-02-01'),(69,NULL,11,3,'ok',0.00,4,4,'2014-02-06',0.00,'returned',NULL,'ARC-123','2014-02-03','2014-02-01','2014-02-01'),(70,NULL,11,4,'ok',0.00,2,2,'2014-02-07',0.00,'returned',NULL,'ARC-123','2014-02-04','2014-02-04','2014-02-04'),(71,NULL,8,5,'ok',NULL,3,2,'2014-02-14',0.00,'returned',NULL,'ARC-124','2014-02-11','2014-02-11','2014-02-11'),(72,NULL,8,4,'ok',NULL,5,2,'2014-02-14',0.00,'returned',NULL,'ARC-124','2014-02-11','2014-02-11','2014-02-11'),(73,NULL,8,3,'ok',NULL,2,2,'2014-02-20',0.00,'returned',NULL,'ARC-124','2014-02-17','2014-02-11','2014-02-11'),(74,NULL,8,2,'ok',NULL,2,2,'2014-02-20',0.00,'returned',NULL,'ARC-124','2014-02-17','2014-02-11','2014-02-11'),(75,NULL,8,1,'ok',NULL,2,2,'2014-02-21',0.00,'returned',NULL,'ARC-124','2014-02-18','2014-02-11','2014-02-11'),(76,NULL,8,2,'ok',NULL,2,2,'2014-02-21',0.00,'returned',NULL,'ARC-124','2014-02-18','2014-02-11','2014-02-11'),(77,NULL,8,16,'ok',NULL,2,2,'2014-02-08',0.00,'returned',NULL,'ARC-124','2014-02-05','2014-02-11','2014-02-11'),(78,NULL,8,5,'ok',NULL,3,3,'2014-02-08',0.00,'returned',NULL,'ARC-124','2014-02-05','2014-02-11','2014-02-11'),(79,NULL,8,16,'ok',NULL,2,2,'2014-02-06',132.00,'returned',NULL,'ARC-124','2014-02-03','2014-02-11','2014-02-11'),(80,NULL,11,5,'ok',NULL,2,2,'2014-02-13',0.00,'returned',NULL,'ARC-123','2014-02-10','2014-02-12','2014-02-12'),(81,NULL,11,4,'ok',NULL,3,3,'2014-02-13',0.00,'returned',NULL,'ARC-123','2014-02-10','2014-02-12','2014-02-12'),(82,NULL,11,14,'ok',NULL,2,2,'2014-02-21',0.00,'returned',NULL,'ARC-123','2014-02-18','2014-02-12','2014-02-12'),(83,NULL,11,15,'ok',NULL,2,2,'2014-02-21',0.00,'returned',NULL,'ARC-123','2014-02-18','2014-02-12','2014-02-12'),(84,NULL,11,3,'ok',NULL,2,2,'2014-02-21',0.00,'returned',NULL,'ARC-123','2014-02-18','2014-02-12','2014-02-12'),(85,NULL,11,4,'ok',NULL,2,2,'2014-02-21',0.00,'returned',NULL,'ARC-123','2014-02-18','2014-02-12','2014-02-12'),(86,NULL,11,14,'ok',NULL,2,2,'2014-02-21',0.00,'returned',NULL,'ARC-123','2014-02-18','2014-02-12','2014-02-12'),(87,NULL,11,15,'ok',NULL,2,2,'2014-02-21',0.00,'returned',NULL,'ARC-123','2014-02-18','2014-02-12','2014-02-12'),(88,NULL,11,3,'ok',NULL,2,2,'2014-03-02',0.00,'returned',NULL,'ARC-123','2014-02-27','2014-02-12','2014-02-12'),(89,NULL,11,4,'ok',NULL,2,2,'2014-03-02',0.00,'returned',NULL,'ARC-123','2014-02-27','2014-02-12','2014-02-12'),(90,NULL,11,15,'ok',NULL,2,2,'2014-03-02',0.00,'returned',NULL,'ARC-123','2014-02-27','2014-02-12','2014-02-12'),(91,NULL,11,16,'ok',NULL,2,2,'2014-03-02',0.00,'returned',NULL,'ARC-123','2014-02-27','2014-02-12','2014-02-12'),(92,NULL,11,14,'ok',NULL,2,2,'2014-02-28',0.00,'returned',NULL,'ARC-123','2014-02-25','2014-02-12','2014-02-12'),(93,NULL,11,15,'ok',NULL,2,2,'2014-02-28',0.00,'returned',NULL,'ARC-123','2014-02-25','2014-02-12','2014-02-12'),(94,NULL,11,16,'ok',NULL,2,2,'2014-02-28',0.00,'returned',NULL,'ARC-123','2014-02-25','2014-02-12','2014-02-12'),(95,NULL,11,1,'ok',NULL,2,2,'2014-03-01',0.00,'returned',NULL,'ARC-123','2014-02-26','2014-02-12','2014-02-12'),(96,NULL,11,2,'ok',NULL,2,2,'2014-03-01',0.00,'returned',NULL,'ARC-123','2014-02-26','2014-02-12','2014-02-12'),(97,NULL,11,3,'ok',NULL,2,2,'2014-03-01',0.00,'returned',NULL,'ARC-123','2014-02-26','2014-02-12','2014-02-12'),(98,NULL,11,4,'ok',NULL,2,2,'2014-03-01',0.00,'returned',NULL,'ARC-123','2014-02-26','2014-02-12','2014-02-12'),(99,NULL,11,5,'ok',NULL,2,2,'2014-03-01',0.00,'returned',NULL,'ARC-123','2014-02-26','2014-02-12','2014-02-12'),(100,NULL,11,14,'ok',NULL,2,2,'2014-02-28',0.00,'returned',NULL,'ARC-123','2014-02-25','2014-02-12','2014-02-12'),(101,NULL,11,15,'ok',NULL,2,2,'2014-02-28',0.00,'returned',NULL,'ARC-123','2014-02-25','2014-02-12','2014-02-12'),(102,NULL,11,16,'ok',NULL,3,3,'2014-02-28',0.00,'returned',NULL,'ARC-123','2014-02-25','2014-02-12','2014-02-12');

/*Table structure for table `bf_returned_items_lacking` */

DROP TABLE IF EXISTS `bf_returned_items_lacking`;

CREATE TABLE `bf_returned_items_lacking` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `returned_items_id` int(11) NOT NULL DEFAULT '0',
  `quantity` int(11) DEFAULT NULL,
  `date_returned` date DEFAULT '0000-00-00',
  `created_on` date DEFAULT '0000-00-00',
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=3 DEFAULT CHARSET=latin1;

/*Data for the table `bf_returned_items_lacking` */

insert  into `bf_returned_items_lacking`(`id`,`returned_items_id`,`quantity`,`date_returned`,`created_on`) values (1,71,1,'2014-02-11','2014-02-11'),(2,72,3,'2014-02-11','2014-02-11');

/*Table structure for table `bf_role_permissions` */

DROP TABLE IF EXISTS `bf_role_permissions`;

CREATE TABLE `bf_role_permissions` (
  `role_id` int(11) NOT NULL,
  `permission_id` int(11) NOT NULL,
  PRIMARY KEY (`role_id`,`permission_id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

/*Data for the table `bf_role_permissions` */

insert  into `bf_role_permissions`(`role_id`,`permission_id`) values (1,2),(1,3),(1,4),(1,5),(1,6),(1,7),(1,8),(1,9),(1,10),(1,11),(1,12),(1,13),(1,14),(1,15),(1,16),(1,17),(1,18),(1,19),(1,20),(1,21),(1,22),(1,24),(1,25),(1,27),(1,28),(1,29),(1,30),(1,31),(1,32),(1,33),(1,34),(1,35),(1,36),(1,37),(1,38),(1,39),(1,40),(1,41),(1,42),(1,43),(1,44),(1,45),(1,46),(1,49),(1,50),(1,51),(1,56),(1,57),(1,58),(1,59),(1,60),(1,61),(1,62),(1,63),(1,64),(1,65),(1,66),(1,67),(1,68),(1,69),(1,70),(1,71),(1,72),(1,73),(1,74),(1,75),(1,76),(1,77),(1,78),(1,79),(1,80),(1,81),(1,82),(1,83),(1,84),(1,85),(1,86),(1,87),(1,88),(1,89),(1,90),(1,91),(1,92),(1,93),(1,94),(1,95),(1,96),(1,97),(1,98),(1,99),(1,100),(2,2),(2,3),(2,51),(2,68),(2,81),(2,92),(6,2),(6,3),(6,4),(6,5),(6,6),(6,7),(6,8),(6,9),(6,10),(6,11),(6,12),(6,13),(6,49),(6,51),(6,68),(6,81),(6,92);

/*Table structure for table `bf_roles` */

DROP TABLE IF EXISTS `bf_roles`;

CREATE TABLE `bf_roles` (
  `role_id` int(11) NOT NULL AUTO_INCREMENT,
  `role_name` varchar(60) NOT NULL,
  `description` varchar(255) DEFAULT NULL,
  `default` tinyint(1) NOT NULL DEFAULT '0',
  `can_delete` tinyint(1) NOT NULL DEFAULT '1',
  `login_destination` varchar(255) NOT NULL DEFAULT '/',
  `deleted` int(1) NOT NULL DEFAULT '0',
  `default_context` varchar(255) NOT NULL DEFAULT 'content',
  PRIMARY KEY (`role_id`)
) ENGINE=InnoDB AUTO_INCREMENT=7 DEFAULT CHARSET=utf8;

/*Data for the table `bf_roles` */

insert  into `bf_roles`(`role_id`,`role_name`,`description`,`default`,`can_delete`,`login_destination`,`deleted`,`default_context`) values (1,'Administrator','Has full control over every aspect of the site.',0,0,'',0,'content'),(2,'Editor','Can handle day-to-day management, but does not have full power.',0,1,'',0,'content'),(4,'User','This is the default user with access to login.',1,0,'',0,'content'),(6,'Developer','Developers typically are the only ones that can access the developer tools. Otherwise identical to Administrators, at least until the site is handed off.',0,1,'',0,'content');

/*Table structure for table `bf_sales_order` */

DROP TABLE IF EXISTS `bf_sales_order`;

CREATE TABLE `bf_sales_order` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `invoice_no` varchar(255) NOT NULL,
  `supplier` varchar(255) NOT NULL,
  `ris_no` varchar(255) DEFAULT NULL,
  `po_no` varchar(255) DEFAULT NULL,
  `jor_no` varchar(255) DEFAULT NULL,
  `date_received` date NOT NULL DEFAULT '0000-00-00',
  `date_invoice` date NOT NULL DEFAULT '0000-00-00',
  `receiving_dept` varchar(255) DEFAULT NULL,
  `received_by` int(11) DEFAULT NULL,
  `noted_by` varbinary(255) DEFAULT NULL,
  `created_on` datetime NOT NULL DEFAULT '0000-00-00 00:00:00',
  `modified_on` datetime NOT NULL DEFAULT '0000-00-00 00:00:00',
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=4 DEFAULT CHARSET=utf8;

/*Data for the table `bf_sales_order` */

insert  into `bf_sales_order`(`id`,`invoice_no`,`supplier`,`ris_no`,`po_no`,`jor_no`,`date_received`,`date_invoice`,`receiving_dept`,`received_by`,`noted_by`,`created_on`,`modified_on`) values (2,'RIC2123','Test Supplier','RIS1235','PO1235','JOR1235','2014-02-19','2014-02-20','Test Dept',1,'Test Chair','2014-02-15 15:47:04','2014-02-15 15:47:04'),(3,'WH123','Wheelmasters','WHRIS123','WHPO123','WHJOR123','2014-02-20','2014-02-28','Logistics',1,'Edna Dospordos','2014-02-16 18:32:27','2014-02-16 18:34:19');

/*Table structure for table `bf_sales_order_details` */

DROP TABLE IF EXISTS `bf_sales_order_details`;

CREATE TABLE `bf_sales_order_details` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `sales_order_id` int(11) NOT NULL DEFAULT '0',
  `item_id` int(11) DEFAULT '0',
  `quantity` float(14,2) DEFAULT NULL,
  `unit_cost` float(14,2) DEFAULT NULL,
  `total` float(14,2) DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=46 DEFAULT CHARSET=latin1;

/*Data for the table `bf_sales_order_details` */

insert  into `bf_sales_order_details`(`id`,`sales_order_id`,`item_id`,`quantity`,`unit_cost`,`total`) values (40,2,1,234.00,23.00,5382.00),(41,2,15,55.00,344.00,18920.00),(42,3,13,18.00,200.00,3600.00),(43,3,5,7.00,150.00,1050.00),(44,3,4,5.00,120.00,600.00),(45,3,3,6.00,135.44,812.64);

/*Table structure for table `bf_schema_version` */

DROP TABLE IF EXISTS `bf_schema_version`;

CREATE TABLE `bf_schema_version` (
  `type` varchar(40) NOT NULL,
  `version` int(4) NOT NULL DEFAULT '0',
  PRIMARY KEY (`type`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

/*Data for the table `bf_schema_version` */

insert  into `bf_schema_version`(`type`,`version`) values ('core',37),('items_',2),('laboratories_',2),('lab_incharge_',2),('notifications_',2),('purchase_order_',2),('returned_items_',2),('sales_order_',2),('students_',2),('subjects_',2),('teachers_',2);

/*Table structure for table `bf_sessions` */

DROP TABLE IF EXISTS `bf_sessions`;

CREATE TABLE `bf_sessions` (
  `session_id` varchar(40) NOT NULL DEFAULT '0',
  `ip_address` varchar(45) NOT NULL DEFAULT '0',
  `user_agent` varchar(120) NOT NULL,
  `last_activity` int(10) unsigned NOT NULL DEFAULT '0',
  `user_data` text NOT NULL,
  PRIMARY KEY (`session_id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

/*Data for the table `bf_sessions` */

/*Table structure for table `bf_settings` */

DROP TABLE IF EXISTS `bf_settings`;

CREATE TABLE `bf_settings` (
  `name` varchar(30) NOT NULL,
  `module` varchar(50) NOT NULL,
  `value` varchar(255) NOT NULL,
  PRIMARY KEY (`name`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

/*Data for the table `bf_settings` */

insert  into `bf_settings`(`name`,`module`,`value`) values ('auth.allow_name_change','core','1'),('auth.allow_register','core','1'),('auth.allow_remember','core','1'),('auth.do_login_redirect','core','1'),('auth.login_type','core','email'),('auth.name_change_frequency','core','1'),('auth.name_change_limit','core','1'),('auth.password_force_mixed_case','core','0'),('auth.password_force_numbers','core','0'),('auth.password_force_symbols','core','0'),('auth.password_min_length','core','8'),('auth.password_show_labels','core','0'),('auth.remember_length','core','1209600'),('auth.user_activation_method','core','0'),('auth.use_extended_profile','core','0'),('auth.use_usernames','core','1'),('ext.country','core','US'),('ext.state','core','CA'),('ext.street_name','core',''),('ext.type','core','small'),('form_save','core.ui','ctrl+s/⌘+s'),('goto_content','core.ui','alt+c'),('mailpath','email','/usr/sbin/sendmail'),('mailtype','email','text'),('password_iterations','users','8'),('protocol','email','mail'),('sender_email','email',''),('site.languages','core','a:3:{i:0;s:7:\"english\";i:1;s:7:\"persian\";i:2;s:10:\"portuguese\";}'),('site.list_limit','core','25'),('site.show_front_profiler','core','1'),('site.show_profiler','core','1'),('site.status','core','1'),('site.system_email','core','admin@irscl.com'),('site.title','core','IRSCL'),('smtp_host','email',''),('smtp_pass','email',''),('smtp_port','email',''),('smtp_timeout','email',''),('smtp_user','email',''),('updates.bleeding_edge','core','0'),('updates.do_check','core','0');

/*Table structure for table `bf_states` */

DROP TABLE IF EXISTS `bf_states`;

CREATE TABLE `bf_states` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `name` char(40) NOT NULL,
  `abbrev` char(2) NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=64 DEFAULT CHARSET=utf8;

/*Data for the table `bf_states` */

insert  into `bf_states`(`id`,`name`,`abbrev`) values (1,'Alaska','AK'),(2,'Alabama','AL'),(3,'American Samoa','AS'),(4,'Arizona','AZ'),(5,'Arkansas','AR'),(6,'California','CA'),(7,'Colorado','CO'),(8,'Connecticut','CT'),(9,'Delaware','DE'),(10,'District of Columbia','DC'),(11,'Florida','FL'),(12,'Georgia','GA'),(13,'Guam','GU'),(14,'Hawaii','HI'),(15,'Idaho','ID'),(16,'Illinois','IL'),(17,'Indiana','IN'),(18,'Iowa','IA'),(19,'Kansas','KS'),(20,'Kentucky','KY'),(21,'Louisiana','LA'),(22,'Maine','ME'),(23,'Marshall Islands','MH'),(24,'Maryland','MD'),(25,'Massachusetts','MA'),(26,'Michigan','MI'),(27,'Minnesota','MN'),(28,'Mississippi','MS'),(29,'Missouri','MO'),(30,'Montana','MT'),(31,'Nebraska','NE'),(32,'Nevada','NV'),(33,'New Hampshire','NH'),(34,'New Jersey','NJ'),(35,'New Mexico','NM'),(36,'New York','NY'),(37,'North Carolina','NC'),(38,'North Dakota','ND'),(39,'Northern Mariana Islands','MP'),(40,'Ohio','OH'),(41,'Oklahoma','OK'),(42,'Oregon','OR'),(43,'Palau','PW'),(44,'Pennsylvania','PA'),(45,'Puerto Rico','PR'),(46,'Rhode Island','RI'),(47,'South Carolina','SC'),(48,'South Dakota','SD'),(49,'Tennessee','TN'),(50,'Texas','TX'),(51,'Utah','UT'),(52,'Vermont','VT'),(53,'Virgin Islands','VI'),(54,'Virginia','VA'),(55,'Washington','WA'),(56,'West Virginia','WV'),(57,'Wisconsin','WI'),(58,'Wyoming','WY'),(59,'Armed Forces Africa','AE'),(60,'Armed Forces Canada','AE'),(61,'Armed Forces Europe','AE'),(62,'Armed Forces Middle East','AE'),(63,'Armed Forces Pacific','AP');

/*Table structure for table `bf_students` */

DROP TABLE IF EXISTS `bf_students`;

CREATE TABLE `bf_students` (
  `student_id` int(11) NOT NULL AUTO_INCREMENT,
  `user_id` int(11) DEFAULT '0',
  `id_number` varchar(255) DEFAULT NULL,
  `firstname` varchar(255) NOT NULL,
  `lastname` varchar(255) NOT NULL,
  `address` text NOT NULL,
  `contact_details` text NOT NULL,
  `status` enum('Active','Inactive') DEFAULT NULL,
  `created_on` datetime NOT NULL DEFAULT '0000-00-00 00:00:00',
  `modified_on` datetime NOT NULL DEFAULT '0000-00-00 00:00:00',
  PRIMARY KEY (`student_id`)
) ENGINE=InnoDB AUTO_INCREMENT=13 DEFAULT CHARSET=utf8;

/*Data for the table `bf_students` */

insert  into `bf_students`(`student_id`,`user_id`,`id_number`,`firstname`,`lastname`,`address`,`contact_details`,`status`,`created_on`,`modified_on`) values (6,13,NULL,'Janico','Pag-ong','over there','1234',NULL,'2014-01-12 15:30:19','0000-00-00 00:00:00'),(8,16,'ARC-124','Nica','Doggy','Over there','123456',NULL,'0000-00-00 00:00:00','0000-00-00 00:00:00'),(9,17,'ARC-22','Dummy','Test','...','1234','Inactive','0000-00-00 00:00:00','0000-00-00 00:00:00'),(10,18,'10306430','cherrym','montecalvo','','','Inactive','0000-00-00 00:00:00','0000-00-00 00:00:00'),(11,19,'ARC-123','Nico','Nico','...','...','Inactive','0000-00-00 00:00:00','0000-00-00 00:00:00'),(12,20,'2014','Sinulog','Cebu','test','test','Inactive','0000-00-00 00:00:00','0000-00-00 00:00:00');

/*Table structure for table `bf_subjects` */

DROP TABLE IF EXISTS `bf_subjects`;

CREATE TABLE `bf_subjects` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `name` varchar(255) NOT NULL,
  `description` text NOT NULL,
  `time_start` time NOT NULL,
  `time_end` time NOT NULL,
  `status` enum('Active','Inactive') NOT NULL,
  `created_on` datetime NOT NULL DEFAULT '0000-00-00 00:00:00',
  `modified_on` datetime NOT NULL DEFAULT '0000-00-00 00:00:00',
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=2 DEFAULT CHARSET=utf8;

/*Data for the table `bf_subjects` */

insert  into `bf_subjects`(`id`,`name`,`description`,`time_start`,`time_end`,`status`,`created_on`,`modified_on`) values (1,'test','test','10:15:00','03:20:00','Active','2013-12-14 10:31:33','2014-01-08 15:37:22');

/*Table structure for table `bf_teachers` */

DROP TABLE IF EXISTS `bf_teachers`;

CREATE TABLE `bf_teachers` (
  `teacher_id` int(11) NOT NULL AUTO_INCREMENT,
  `user_id` int(11) DEFAULT '0',
  `id_number` varchar(255) DEFAULT NULL,
  `firstname` varchar(255) NOT NULL,
  `lastname` varchar(255) NOT NULL,
  `address` text NOT NULL,
  `contact_details` text NOT NULL,
  `status` enum('Active','Inactive') DEFAULT NULL,
  `created_on` datetime NOT NULL DEFAULT '0000-00-00 00:00:00',
  `modified_on` datetime NOT NULL DEFAULT '0000-00-00 00:00:00',
  PRIMARY KEY (`teacher_id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

/*Data for the table `bf_teachers` */

/*Table structure for table `bf_user_cookies` */

DROP TABLE IF EXISTS `bf_user_cookies`;

CREATE TABLE `bf_user_cookies` (
  `user_id` bigint(20) NOT NULL,
  `token` varchar(128) NOT NULL,
  `created_on` datetime NOT NULL,
  KEY `token` (`token`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

/*Data for the table `bf_user_cookies` */

/*Table structure for table `bf_user_meta` */

DROP TABLE IF EXISTS `bf_user_meta`;

CREATE TABLE `bf_user_meta` (
  `meta_id` int(20) unsigned NOT NULL AUTO_INCREMENT,
  `user_id` int(20) unsigned NOT NULL DEFAULT '0',
  `meta_key` varchar(255) NOT NULL DEFAULT '',
  `meta_value` text,
  PRIMARY KEY (`meta_id`)
) ENGINE=InnoDB AUTO_INCREMENT=22 DEFAULT CHARSET=utf8;

/*Data for the table `bf_user_meta` */

insert  into `bf_user_meta`(`meta_id`,`user_id`,`meta_key`,`meta_value`) values (1,14,'street_name','0'),(2,14,'state','0'),(3,14,'country','0'),(4,15,'street_name','0'),(5,15,'state','0'),(6,15,'country','0'),(7,16,'street_name','0'),(8,16,'state','0'),(9,16,'country','0'),(10,17,'street_name','0'),(11,17,'state','0'),(12,17,'country','0'),(13,18,'street_name','0'),(14,18,'state','0'),(15,18,'country','0'),(16,19,'street_name','0'),(17,19,'state','0'),(18,19,'country','0'),(19,20,'street_name','0'),(20,20,'state','0'),(21,20,'country','0');

/*Table structure for table `bf_users` */

DROP TABLE IF EXISTS `bf_users`;

CREATE TABLE `bf_users` (
  `id` bigint(20) unsigned NOT NULL AUTO_INCREMENT,
  `role_id` int(11) NOT NULL DEFAULT '4',
  `role_desc` varchar(30) DEFAULT NULL,
  `email` varchar(120) NOT NULL,
  `username` varchar(30) NOT NULL DEFAULT '',
  `password_hash` char(60) NOT NULL,
  `reset_hash` varchar(40) DEFAULT NULL,
  `last_login` datetime NOT NULL DEFAULT '0000-00-00 00:00:00',
  `last_ip` varchar(40) NOT NULL DEFAULT '',
  `created_on` datetime NOT NULL DEFAULT '0000-00-00 00:00:00',
  `deleted` tinyint(1) NOT NULL DEFAULT '0',
  `reset_by` int(10) DEFAULT NULL,
  `banned` tinyint(1) NOT NULL DEFAULT '0',
  `ban_message` varchar(255) DEFAULT NULL,
  `display_name` varchar(255) DEFAULT '',
  `display_name_changed` date DEFAULT NULL,
  `timezone` char(4) NOT NULL DEFAULT 'UM6',
  `language` varchar(20) NOT NULL DEFAULT 'english',
  `active` tinyint(1) NOT NULL DEFAULT '0',
  `activate_hash` varchar(40) NOT NULL DEFAULT '',
  `password_iterations` int(4) NOT NULL,
  `force_password_reset` tinyint(1) NOT NULL DEFAULT '0',
  PRIMARY KEY (`id`),
  KEY `email` (`email`)
) ENGINE=InnoDB AUTO_INCREMENT=22 DEFAULT CHARSET=utf8;

/*Data for the table `bf_users` */

insert  into `bf_users`(`id`,`role_id`,`role_desc`,`email`,`username`,`password_hash`,`reset_hash`,`last_login`,`last_ip`,`created_on`,`deleted`,`reset_by`,`banned`,`ban_message`,`display_name`,`display_name_changed`,`timezone`,`language`,`active`,`activate_hash`,`password_iterations`,`force_password_reset`) values (1,1,NULL,'admin@irscl.com','admin','$2a$08$2/uriM88AssTxWV77HtOj.H9jRjuXFsREKvgoAi0hwvjU.whUx7v6',NULL,'2014-02-16 17:44:45','127.0.0.1','2013-12-07 09:29:58',0,NULL,0,NULL,'admin',NULL,'UM6','english',1,'',0,0),(2,1,NULL,'admin@irscl.com','admin','$2a$08$vJqDur1JWy4oeEo8vQ7iku/uH5t1ALKfFURWJjYQjLNsVHrhQnoXu',NULL,'0000-00-00 00:00:00','','2013-12-07 09:39:14',1,NULL,0,NULL,'admin',NULL,'UM6','english',1,'',0,0),(13,4,'student','vaganic@gmail.com','vaganic@gmail.com','$2a$08$SbmttDWSSw2HO5gC/bm.7eq7wdwn4cBmZhc5sDhVXnRoZrmGN/jua',NULL,'2014-01-15 12:21:10','127.0.0.1','2014-01-12 15:30:19',0,NULL,0,NULL,'vaganic@gmail.com',NULL,'UM6','english',1,'',8,0),(16,4,'student','nica@gmail.com','Nica','$2a$08$hnkw4zKIh52a.L2SMxIW2eXtNa4Zz9RCJpIbcgQ3q.R8ooD38IcJG',NULL,'2014-02-12 18:26:39','127.0.0.1','2014-01-15 14:58:06',0,NULL,0,NULL,'Nica',NULL,'0','0',1,'',8,0),(17,4,'student','dummy@gmail.com','dummy','$2a$08$WyJLV6dsq6lr8wXq0W82lOL4B/oxxIWwSN1.JW9DUFOz8guvjT.lu',NULL,'0000-00-00 00:00:00','','2014-01-16 03:42:15',0,NULL,0,NULL,'dummy',NULL,'0','0',1,'',8,0),(18,4,'student','akoh_che07@yahoo.com','tzerine','$2a$08$esrXkwzL83A83ez4tzHe0eShgUWq9w1uVTafpTtPtNrsPjGj0mIB2',NULL,'2014-01-16 19:29:50','127.0.0.1','2014-01-16 19:29:07',0,NULL,0,NULL,'ching2',NULL,'0','0',1,'',8,0),(19,4,'student','nico@gmail.com','nico','$2a$08$zbm5.tv3OAxz30AfZIQ.zejtATFQXE9jIAxsAeX9v/F9GF0s6g4Xq',NULL,'2014-02-16 18:47:07','127.0.0.1','2014-01-16 20:59:35',0,NULL,0,NULL,'nico',NULL,'0','0',1,'',8,0),(20,4,'student','sinulog@cebu.com','sinulog','$2a$08$LWpByCRatfyncR/gHkcSn.swIby883jhC21feHWlc6vUFyLG2AxBC',NULL,'2014-01-22 17:21:41','127.0.0.1','2014-01-22 17:17:47',0,NULL,0,NULL,'Sinulog 2014',NULL,'0','0',1,'',8,0),(21,4,'lab_incharge','test@test.com','testing@yahoo.com','$2a$08$6NNaOEwa1BTHrk4d4dF0suDVnCsdMGGWXZwPGjMXKhZjS2b38XEIu',NULL,'0000-00-00 00:00:00','','2014-02-15 13:45:00',0,NULL,0,NULL,'testing@yahoo.com',NULL,'UM6','english',1,'',8,0);

/*!40101 SET SQL_MODE=@OLD_SQL_MODE */;
/*!40014 SET FOREIGN_KEY_CHECKS=@OLD_FOREIGN_KEY_CHECKS */;
/*!40014 SET UNIQUE_CHECKS=@OLD_UNIQUE_CHECKS */;
/*!40111 SET SQL_NOTES=@OLD_SQL_NOTES */;
