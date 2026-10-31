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

/*Table structure for table `transaksi` */

DROP TABLE IF EXISTS `transaksi`;

CREATE TABLE `transaksi` (
  `id_transaksi` int(11) NOT NULL AUTO_INCREMENT,
  `id_konsumen` int(11) NOT NULL,
  `id_kasir` int(11) DEFAULT NULL,
  `kode_brg` varchar(10) NOT NULL,
  `jumlah` int(11) NOT NULL,
  `harga` decimal(15,2) NOT NULL,
  `total_bayar` decimal(15,2) NOT NULL,
  PRIMARY KEY (`id_transaksi`),
  KEY `fk_transaksi_barang` (`kode_brg`),
  KEY `fk_transaksi_konsumen` (`id_konsumen`),
  CONSTRAINT `fk_transaksi_barang` FOREIGN KEY (`kode_brg`) REFERENCES `barang` (`kode_brg`) ON DELETE CASCADE ON UPDATE CASCADE,
  CONSTRAINT `fk_transaksi_konsumen` FOREIGN KEY (`id_konsumen`) REFERENCES `konsumen` (`id_konsumen`) ON DELETE CASCADE ON UPDATE CASCADE
) ENGINE=InnoDB AUTO_INCREMENT=16 DEFAULT CHARSET=latin1;

/*Data for the table `transaksi` */

insert  into `transaksi`(`id_transaksi`,`id_konsumen`,`id_kasir`,`kode_brg`,`jumlah`,`harga`,`total_bayar`) values
(7,3,1,'K002',150,1000000.00,150000000.00),
(10,5,1,'K002',1500,1000000.00,1500000000.00),
(12,5,1,'K003',50,25000000.00,1250000000.00),
(13,3,1,'K001',10,10000.00,100000.00),
(14,5,2,'K003',15,25000000.00,375000000.00),
(15,3,3,'K005',10,500000.00,5000000.00);

/*!40101 SET SQL_MODE=@OLD_SQL_MODE */;
/*!40014 SET FOREIGN_KEY_CHECKS=@OLD_FOREIGN_KEY_CHECKS */;
/*!40014 SET UNIQUE_CHECKS=@OLD_UNIQUE_CHECKS */;
/*!40111 SET SQL_NOTES=@OLD_SQL_NOTES */;
