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

/*Table structure for table `bf_returned_items` */

DROP TABLE IF EXISTS `bf_returned_items`;

CREATE TABLE `bf_returned_items` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `worker_id` int(11) DEFAULT NULL,
  `student_id` int(11) DEFAULT NULL,
  `item_id` int(11) DEFAULT NULL,
  `quantity` int(11) DEFAULT NULL,
  `return_qty` int(11) DEFAULT '0',
  `status` enum('lacking','for approval','returned') NOT NULL,
  `created_on` datetime DEFAULT '0000-00-00 00:00:00',
  `modified_on` datetime DEFAULT '0000-00-00 00:00:00',
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=23 DEFAULT CHARSET=utf8;

/*Data for the table `bf_returned_items` */

insert  into `bf_returned_items`(`id`,`worker_id`,`student_id`,`item_id`,`quantity`,`return_qty`,`status`,`created_on`,`modified_on`) values (4,NULL,6,1,2,2,'returned','2014-01-12 15:50:33','2014-01-12 15:50:33'),(5,NULL,6,2,2,2,'returned','2014-01-12 15:50:33','2014-01-12 15:50:33'),(6,NULL,6,3,5,5,'returned','2014-01-12 15:50:33','2014-01-12 15:50:33'),(7,NULL,6,4,3,3,'returned','2014-01-12 15:55:39','2014-01-12 15:55:39'),(8,NULL,6,4,2,2,'returned','2014-01-12 15:56:36','2014-01-12 15:56:36'),(9,NULL,6,4,2,2,'returned','2014-01-12 15:57:23','2014-01-12 15:57:23'),(10,NULL,6,4,2,2,'returned','2014-01-12 15:58:15','2014-01-12 15:58:15'),(11,NULL,6,4,1,1,'returned','2014-01-12 15:59:40','2014-01-12 15:59:40'),(12,NULL,6,5,1,1,'returned','2014-01-12 16:01:49','2014-01-12 16:01:49'),(13,NULL,6,4,2,2,'returned','2014-01-12 16:02:24','2014-01-12 16:02:24'),(14,NULL,6,3,2,2,'returned','2014-01-12 16:02:24','2014-01-12 16:02:24'),(15,NULL,6,12,5,5,'returned','2014-01-12 17:38:23','2014-01-12 17:38:23'),(16,NULL,6,13,2,2,'returned','2014-01-12 17:38:23','2014-01-12 17:38:23'),(17,NULL,6,1,2,2,'returned','2014-01-13 16:27:30','2014-01-13 16:27:30'),(18,NULL,6,4,1,1,'returned','2014-01-13 16:28:19','2014-01-13 16:28:19'),(19,NULL,6,2,8,8,'returned','2014-01-13 16:28:19','2014-01-13 16:28:19'),(20,0,6,5,2,2,'returned','2014-01-14 14:10:21','2014-01-15 14:21:25'),(21,NULL,6,2,3,0,'lacking','2014-01-14 14:10:21','2014-01-14 14:10:21'),(22,NULL,6,4,1,0,'lacking','2014-01-14 14:10:21','2014-01-14 14:10:21');

/*!40101 SET SQL_MODE=@OLD_SQL_MODE */;
/*!40014 SET FOREIGN_KEY_CHECKS=@OLD_FOREIGN_KEY_CHECKS */;
/*!40014 SET UNIQUE_CHECKS=@OLD_UNIQUE_CHECKS */;
/*!40111 SET SQL_NOTES=@OLD_SQL_NOTES */;
