/*
SQLyog Community v13.2.0 (64 bit)
MySQL - 10.1.48-MariaDB : Database - indomaret_ci4
*********************************************************************
*/

/*!40101 SET NAMES utf8 */;

/*!40101 SET SQL_MODE=''*/;

/*!40014 SET @OLD_UNIQUE_CHECKS=@@UNIQUE_CHECKS, UNIQUE_CHECKS=0 */;
/*!40014 SET @OLD_FOREIGN_KEY_CHECKS=@@FOREIGN_KEY_CHECKS, FOREIGN_KEY_CHECKS=0 */;
/*!40101 SET @OLD_SQL_MODE=@@SQL_MODE, SQL_MODE='NO_AUTO_VALUE_ON_ZERO' */;
/*!40111 SET @OLD_SQL_NOTES=@@SQL_NOTES, SQL_NOTES=0 */;
CREATE DATABASE /*!32312 IF NOT EXISTS*/`indomaret_ci4` /*!40100 DEFAULT CHARACTER SET latin1 */;

USE `indomaret_ci4`;

/*Table structure for table `kasir` */

DROP TABLE IF EXISTS `kasir`;

CREATE TABLE `kasir` (
  `id_kasir` int(11) NOT NULL AUTO_INCREMENT,
  `nama_kasir` varchar(100) NOT NULL,
  `username` varchar(50) NOT NULL,
  `no_hp` varchar(20) NOT NULL,
  PRIMARY KEY (`id_kasir`),
  UNIQUE KEY `username` (`username`)
) ENGINE=InnoDB AUTO_INCREMENT=4 DEFAULT CHARSET=latin1;

/*Data for the table `kasir` */

insert  into `kasir`(`id_kasir`,`nama_kasir`,`username`,`no_hp`) values
(1,'Admin Kasir','kasir1','081234567890'),
(2,'Falih Rifky Saputra','falih_kasir','087786895004'),
(3,'Suryo','suryo_kasir','08123456789');

/*!40101 SET SQL_MODE=@OLD_SQL_MODE */;
/*!40014 SET FOREIGN_KEY_CHECKS=@OLD_FOREIGN_KEY_CHECKS */;
/*!40014 SET UNIQUE_CHECKS=@OLD_UNIQUE_CHECKS */;
/*!40111 SET SQL_NOTES=@OLD_SQL_NOTES */;
