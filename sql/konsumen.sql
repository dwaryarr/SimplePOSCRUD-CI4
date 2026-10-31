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

/*Table structure for table `konsumen` */

DROP TABLE IF EXISTS `konsumen`;

CREATE TABLE `konsumen` (
  `id_konsumen` int(11) NOT NULL AUTO_INCREMENT,
  `nama_konsumen` varchar(100) DEFAULT NULL,
  `alamat` varchar(200) DEFAULT NULL,
  `no_hp` varchar(20) DEFAULT NULL,
  PRIMARY KEY (`id_konsumen`)
) ENGINE=InnoDB AUTO_INCREMENT=7 DEFAULT CHARSET=latin1;

/*Data for the table `konsumen` */

insert  into `konsumen`(`id_konsumen`,`nama_konsumen`,`alamat`,`no_hp`) values
(3,'Hafizh Muzani','Medan','082327239421'),
(4,'Kohang Reyhan','Pedurungan','087786895004'),
(5,'Rizki Ardiansyah','Jl. Pekunden','0812345678'),
(6,'Suryo','Batang','0877123449421');

/*!40101 SET SQL_MODE=@OLD_SQL_MODE */;
/*!40014 SET FOREIGN_KEY_CHECKS=@OLD_FOREIGN_KEY_CHECKS */;
/*!40014 SET UNIQUE_CHECKS=@OLD_UNIQUE_CHECKS */;
/*!40111 SET SQL_NOTES=@OLD_SQL_NOTES */;
