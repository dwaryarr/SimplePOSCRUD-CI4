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

/*Table structure for table `barang` */

DROP TABLE IF EXISTS `barang`;

CREATE TABLE `barang` (
  `kode_brg` varchar(20) NOT NULL,
  `nama_barang` varchar(100) NOT NULL,
  `jenis` varchar(50) NOT NULL,
  `harga_beli` int(11) NOT NULL,
  `total_beli` int(11) NOT NULL,
  `kode_konsumen` varchar(20) DEFAULT NULL,
  PRIMARY KEY (`kode_brg`)
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

/*Data for the table `barang` */

insert  into `barang`(`kode_brg`,`nama_barang`,`jenis`,`harga_beli`,`total_beli`,`kode_konsumen`) values
('K001','Monitor Xiomi','Elektronik',10000,490,NULL),
('K002','Monitor','Elektronik',1000000,50,NULL),
('K003','Iphone 18 Promax 5TB','Elektronik',25000000,35,NULL),
('K004','Mouse Gaming','Elektronik',5000000,60,NULL),
('K005','Kipas Gaming','Elektronik',500000,490,NULL);

/*!40101 SET SQL_MODE=@OLD_SQL_MODE */;
/*!40014 SET FOREIGN_KEY_CHECKS=@OLD_FOREIGN_KEY_CHECKS */;
/*!40014 SET UNIQUE_CHECKS=@OLD_UNIQUE_CHECKS */;
/*!40111 SET SQL_NOTES=@OLD_SQL_NOTES */;
