/*
SQLyog Ultimate v9.10 
MySQL - 5.5.5-10.1.16-MariaDB : Database - supplychain
*********************************************************************
*/

/*!40101 SET NAMES utf8 */;

/*!40101 SET SQL_MODE=''*/;

/*!40014 SET @OLD_UNIQUE_CHECKS=@@UNIQUE_CHECKS, UNIQUE_CHECKS=0 */;
/*!40014 SET @OLD_FOREIGN_KEY_CHECKS=@@FOREIGN_KEY_CHECKS, FOREIGN_KEY_CHECKS=0 */;
/*!40101 SET @OLD_SQL_MODE=@@SQL_MODE, SQL_MODE='NO_AUTO_VALUE_ON_ZERO' */;
/*!40111 SET @OLD_SQL_NOTES=@@SQL_NOTES, SQL_NOTES=0 */;
CREATE DATABASE /*!32312 IF NOT EXISTS*/`supplychain` /*!40100 DEFAULT CHARACTER SET latin1 */;

USE `supplychain`;

/*Table structure for table `asset_awo` */

DROP TABLE IF EXISTS `asset_awo`;

CREATE TABLE `asset_awo` (
  `id_asset_awo` int(11) NOT NULL AUTO_INCREMENT,
  `tanggal` date DEFAULT NULL,
  `id_awo` int(11) DEFAULT NULL,
  `id_barang` int(11) DEFAULT NULL,
  `keadaan_barang` enum('Baik','Rusak') DEFAULT NULL,
  `jumlah_barang` int(11) DEFAULT NULL,
  `keterangan` varchar(125) DEFAULT NULL,
  PRIMARY KEY (`id_asset_awo`),
  KEY `FK_asset_awo` (`id_barang`),
  CONSTRAINT `FK_asset_awo` FOREIGN KEY (`id_barang`) REFERENCES `mst_barang` (`id_barang`)
) ENGINE=InnoDB AUTO_INCREMENT=28 DEFAULT CHARSET=latin1;

/*Data for the table `asset_awo` */

insert  into `asset_awo`(`id_asset_awo`,`tanggal`,`id_awo`,`id_barang`,`keadaan_barang`,`jumlah_barang`,`keterangan`) values (26,'2017-06-08',3,17,'Baik',1,'Mutasi'),(27,'2017-06-20',4,15,'Baik',1,'Replacement');

/*Table structure for table `asset_awo_kondisi` */

DROP TABLE IF EXISTS `asset_awo_kondisi`;

CREATE TABLE `asset_awo_kondisi` (
  `id_asset_awo_kondisi` int(11) NOT NULL AUTO_INCREMENT,
  `id_awo` int(11) DEFAULT NULL,
  `id_barang` int(11) DEFAULT NULL,
  `tanggal` date DEFAULT NULL,
  `keadaan_barang` enum('Baik','Rusak') DEFAULT NULL,
  `keterangan` varchar(125) DEFAULT NULL,
  PRIMARY KEY (`id_asset_awo_kondisi`),
  KEY `FK_asset_awo_kondisi` (`id_barang`),
  KEY `FK_asset_awo_kondisi1` (`id_awo`),
  CONSTRAINT `FK_asset_awo_kondisi` FOREIGN KEY (`id_barang`) REFERENCES `mst_barang` (`id_barang`),
  CONSTRAINT `FK_asset_awo_kondisi1` FOREIGN KEY (`id_awo`) REFERENCES `mst_awo` (`id_awo`)
) ENGINE=InnoDB AUTO_INCREMENT=44 DEFAULT CHARSET=latin1;

/*Data for the table `asset_awo_kondisi` */

insert  into `asset_awo_kondisi`(`id_asset_awo_kondisi`,`id_awo`,`id_barang`,`tanggal`,`keadaan_barang`,`keterangan`) values (41,1,17,'2017-06-07','Baik',NULL),(42,4,16,'2017-06-10','Baik',NULL),(43,4,16,'2017-06-09','Rusak','Rusak');

/*Table structure for table `asset_awo_mutasi` */

DROP TABLE IF EXISTS `asset_awo_mutasi`;

CREATE TABLE `asset_awo_mutasi` (
  `id_asset_awo_mutasi` int(11) NOT NULL AUTO_INCREMENT,
  `id_barang` int(11) DEFAULT NULL,
  `id_awo` int(11) DEFAULT NULL,
  `awo_penerima` int(11) DEFAULT NULL,
  `tanggal` date DEFAULT NULL,
  `keterangan` varchar(150) DEFAULT NULL,
  PRIMARY KEY (`id_asset_awo_mutasi`),
  KEY `FK_asset_awo_mutasi` (`id_barang`),
  KEY `FK_asset_awo_mutasi2` (`id_awo`),
  CONSTRAINT `FK_asset_awo_mutasi` FOREIGN KEY (`id_barang`) REFERENCES `mst_barang` (`id_barang`),
  CONSTRAINT `FK_asset_awo_mutasi2` FOREIGN KEY (`id_awo`) REFERENCES `mst_awo` (`id_awo`)
) ENGINE=InnoDB AUTO_INCREMENT=9 DEFAULT CHARSET=latin1;

/*Data for the table `asset_awo_mutasi` */

insert  into `asset_awo_mutasi`(`id_asset_awo_mutasi`,`id_barang`,`id_awo`,`awo_penerima`,`tanggal`,`keterangan`) values (8,17,1,3,'2017-06-08','Mutasi');

/*Table structure for table `asset_awo_replacement` */

DROP TABLE IF EXISTS `asset_awo_replacement`;

CREATE TABLE `asset_awo_replacement` (
  `id_asset_awo_replacement` int(11) NOT NULL AUTO_INCREMENT,
  `id_awo` int(11) DEFAULT NULL,
  `id_barang` int(11) DEFAULT NULL,
  `barang_pengganti` int(11) DEFAULT NULL,
  `tanggal` date DEFAULT NULL,
  `keterangan` varchar(125) DEFAULT NULL,
  PRIMARY KEY (`id_asset_awo_replacement`),
  KEY `FK_asset_awo_replacement` (`id_barang`),
  KEY `FK_asset_awo_replacement3` (`id_awo`),
  CONSTRAINT `FK_asset_awo_replacement` FOREIGN KEY (`id_barang`) REFERENCES `mst_barang` (`id_barang`),
  CONSTRAINT `FK_asset_awo_replacement3` FOREIGN KEY (`id_awo`) REFERENCES `mst_awo` (`id_awo`)
) ENGINE=InnoDB AUTO_INCREMENT=10 DEFAULT CHARSET=latin1;

/*Data for the table `asset_awo_replacement` */

insert  into `asset_awo_replacement`(`id_asset_awo_replacement`,`id_awo`,`id_barang`,`barang_pengganti`,`tanggal`,`keterangan`) values (9,4,16,15,'2017-06-20','Replacement');

/*Table structure for table `asset_rph` */

DROP TABLE IF EXISTS `asset_rph`;

CREATE TABLE `asset_rph` (
  `id_asset_rph` int(11) NOT NULL AUTO_INCREMENT,
  `tanggal` date DEFAULT NULL,
  `id_rph` int(11) DEFAULT NULL,
  `id_barang` int(11) DEFAULT NULL,
  `keadaan_barang` enum('Baik','Rusak') DEFAULT NULL,
  `jumlah_barang` varchar(5) DEFAULT NULL,
  `keterangan` varchar(125) DEFAULT NULL,
  PRIMARY KEY (`id_asset_rph`),
  KEY `FK_asset_rph` (`id_barang`),
  CONSTRAINT `FK_asset_rph` FOREIGN KEY (`id_barang`) REFERENCES `mst_barang` (`id_barang`)
) ENGINE=InnoDB AUTO_INCREMENT=20 DEFAULT CHARSET=latin1;

/*Data for the table `asset_rph` */

insert  into `asset_rph`(`id_asset_rph`,`tanggal`,`id_rph`,`id_barang`,`keadaan_barang`,`jumlah_barang`,`keterangan`) values (18,'2017-06-20',5,20,'Baik','1','Mutasi'),(19,'2017-06-13',6,18,'Baik','1','Replacement');

/*Table structure for table `asset_rph_kondisi` */

DROP TABLE IF EXISTS `asset_rph_kondisi`;

CREATE TABLE `asset_rph_kondisi` (
  `id_asset_rph_kondisi` int(11) NOT NULL AUTO_INCREMENT,
  `tanggal` date DEFAULT NULL,
  `id_rph` int(11) DEFAULT NULL,
  `id_barang` int(11) DEFAULT NULL,
  `keadaan_barang` enum('Baik','Rusak') DEFAULT NULL,
  `keterangan` varchar(125) DEFAULT NULL,
  PRIMARY KEY (`id_asset_rph_kondisi`),
  KEY `FK_asset_rph_kondisi` (`id_rph`),
  KEY `FK_asset_rph_kondisi1` (`id_barang`),
  CONSTRAINT `FK_asset_rph_kondisi` FOREIGN KEY (`id_rph`) REFERENCES `mst_rph` (`id_rph`),
  CONSTRAINT `FK_asset_rph_kondisi1` FOREIGN KEY (`id_barang`) REFERENCES `mst_barang` (`id_barang`)
) ENGINE=InnoDB AUTO_INCREMENT=25 DEFAULT CHARSET=latin1;

/*Data for the table `asset_rph_kondisi` */

insert  into `asset_rph_kondisi`(`id_asset_rph_kondisi`,`tanggal`,`id_rph`,`id_barang`,`keadaan_barang`,`keterangan`) values (22,'2017-06-07',6,20,'Baik',''),(23,'2017-06-07',6,19,'Baik',''),(24,'2017-06-10',6,19,'Rusak','Rusak');

/*Table structure for table `asset_rph_mutasi` */

DROP TABLE IF EXISTS `asset_rph_mutasi`;

CREATE TABLE `asset_rph_mutasi` (
  `id_asset_rph_mutasi` int(11) NOT NULL AUTO_INCREMENT,
  `id_barang` int(11) DEFAULT NULL,
  `id_rph` int(11) DEFAULT NULL,
  `rph_penerima` int(11) DEFAULT NULL,
  `tanggal` date DEFAULT NULL,
  `keterangan` varchar(125) DEFAULT NULL,
  PRIMARY KEY (`id_asset_rph_mutasi`),
  KEY `FK_asset_rph_mutasi` (`id_rph`),
  KEY `FK_asset_rph_mutasi1` (`id_barang`),
  CONSTRAINT `FK_asset_rph_mutasi` FOREIGN KEY (`id_rph`) REFERENCES `mst_rph` (`id_rph`),
  CONSTRAINT `FK_asset_rph_mutasi1` FOREIGN KEY (`id_barang`) REFERENCES `mst_barang` (`id_barang`)
) ENGINE=InnoDB AUTO_INCREMENT=5 DEFAULT CHARSET=latin1;

/*Data for the table `asset_rph_mutasi` */

insert  into `asset_rph_mutasi`(`id_asset_rph_mutasi`,`id_barang`,`id_rph`,`rph_penerima`,`tanggal`,`keterangan`) values (4,20,6,5,'2017-06-20','Mutasi');

/*Table structure for table `asset_rph_replacement` */

DROP TABLE IF EXISTS `asset_rph_replacement`;

CREATE TABLE `asset_rph_replacement` (
  `id_asset_rph_replacement` int(11) NOT NULL AUTO_INCREMENT,
  `id_rph` int(11) DEFAULT NULL,
  `id_barang` int(11) DEFAULT NULL,
  `barang_pengganti` int(11) DEFAULT NULL,
  `tanggal` date DEFAULT NULL,
  `keterangan` varchar(125) DEFAULT NULL,
  PRIMARY KEY (`id_asset_rph_replacement`),
  KEY `FK_asset_rph_replacement` (`id_rph`),
  KEY `FK_asset_rph_replacement1` (`id_barang`),
  CONSTRAINT `FK_asset_rph_replacement` FOREIGN KEY (`id_rph`) REFERENCES `mst_rph` (`id_rph`),
  CONSTRAINT `FK_asset_rph_replacement1` FOREIGN KEY (`id_barang`) REFERENCES `mst_barang` (`id_barang`)
) ENGINE=InnoDB AUTO_INCREMENT=5 DEFAULT CHARSET=latin1;

/*Data for the table `asset_rph_replacement` */

insert  into `asset_rph_replacement`(`id_asset_rph_replacement`,`id_rph`,`id_barang`,`barang_pengganti`,`tanggal`,`keterangan`) values (4,6,19,18,'2017-06-13','Replacement');

/*Table structure for table `mst_absen` */

DROP TABLE IF EXISTS `mst_absen`;

CREATE TABLE `mst_absen` (
  `id_absen` int(11) NOT NULL AUTO_INCREMENT,
  `id_awo` int(11) DEFAULT NULL,
  `tanggal` date DEFAULT NULL,
  `jam` time DEFAULT NULL,
  `lat` varchar(50) DEFAULT NULL,
  `lng` varchar(50) DEFAULT NULL,
  PRIMARY KEY (`id_absen`)
) ENGINE=InnoDB AUTO_INCREMENT=58 DEFAULT CHARSET=latin1;

/*Data for the table `mst_absen` */

insert  into `mst_absen`(`id_absen`,`id_awo`,`tanggal`,`jam`,`lat`,`lng`) values (24,4,'2017-06-13','09:46:00','-4.8240878','105.2716084'),(25,4,'2017-06-13','09:46:00','-4.8240878','105.2716084'),(26,4,'2017-06-13','09:47:00','-4.8240873','105.2716312'),(27,4,'2017-06-13','09:48:00','-4.8240883','105.2715855'),(28,1,'2017-06-13','11:13:00','-4.8241079','105.2715855'),(29,1,'2017-06-13','11:23:00','-4.8240682','105.2716084'),(30,1,'2017-06-13','11:24:00','-4.8240682','105.2716084'),(31,3,'2017-06-13','15:15:00','-4.8240682','105.2716084'),(32,3,'2017-06-13','15:16:00','-4.8240486','105.2716084'),(33,1,'2017-06-13','15:53:00','-4.8240682','105.2716084'),(34,1,'2017-06-13','15:53:00','-4.8240682','105.2716084'),(35,1,'2017-06-13','15:54:00','-4.8240486','105.2716084'),(36,1,'2017-06-13','15:54:00','-4.8240486','105.2716084'),(37,1,'2017-06-14','09:28:00','-4.8240682','105.2716084'),(38,4,'2017-06-14','09:29:00','-4.8240682','105.2716084'),(39,4,'2017-06-14','09:30:00','-4.8240878','105.2716084'),(40,3,'2017-06-15','11:29:00','-4.8240682','105.2716084'),(41,3,'2017-06-15','13:30:00','-4.8240486','105.2716084'),(42,3,'2017-06-15','13:54:00','-4.8241069','105.2716312'),(43,3,'2017-06-15','14:03:00','-4.8240687','105.2715855'),(44,3,'2017-06-15','14:18:00','-4.8240682','105.2716084'),(45,3,'2017-06-15','14:20:00','-4.8240777','105.2716198'),(46,3,'2017-06-15','14:27:00','-4.8240338','105.2716141'),(47,3,'2017-06-15','14:42:00','-4.8240486','105.2716084'),(48,3,'2017-06-16','14:54:00','-4.8240883','105.2715855'),(49,3,'2017-06-16','16:19:00','-4.8240094','105.2716084'),(50,3,'2017-06-17','10:39:00','-4.8240481','105.2716312'),(51,3,'2017-06-17','10:39:00','-4.8240481','105.2716312'),(52,3,'2017-06-17','10:39:00','-4.8240475','105.2716541'),(53,3,'2017-06-17','10:48:00','-4.8240274','105.2716769'),(54,3,'2017-06-17','10:48:00','-4.8240274','105.2716769'),(55,3,'2017-06-19','08:12:00','-4.8240698','105.2715398'),(56,3,'2017-06-19','11:24:00','-4.8240671','105.2716541'),(57,3,'2017-06-19','11:25:00','-4.8240671','105.2716541');

/*Table structure for table `mst_awo` */

DROP TABLE IF EXISTS `mst_awo`;

CREATE TABLE `mst_awo` (
  `id_awo` int(11) NOT NULL AUTO_INCREMENT,
  `nama_awo` varchar(25) DEFAULT NULL,
  `telpon_awo` varchar(15) DEFAULT NULL,
  `id_rph` int(11) DEFAULT NULL,
  `username` varchar(25) DEFAULT NULL,
  `password` varchar(125) DEFAULT NULL,
  `mac` varchar(50) DEFAULT NULL,
  PRIMARY KEY (`id_awo`)
) ENGINE=InnoDB AUTO_INCREMENT=5 DEFAULT CHARSET=latin1;

/*Data for the table `mst_awo` */

insert  into `mst_awo`(`id_awo`,`nama_awo`,`telpon_awo`,`id_rph`,`username`,`password`,`mac`) values (1,'ANGGA SOPIAN','0897676767',3,'angga','angga2017',NULL),(3,'SUTRISNO','0821 8213 3307',6,'sutrisno','sutrisno2017','F4:0E:22:1F:FB:E8'),(4,'SIDIK PURNOMO','900867',5,'sidik','sidik2017',NULL);

/*Table structure for table `mst_barang` */

DROP TABLE IF EXISTS `mst_barang`;

CREATE TABLE `mst_barang` (
  `id_barang` int(11) NOT NULL AUTO_INCREMENT,
  `id_jenis_barang` int(11) DEFAULT NULL,
  `identitas` varchar(50) DEFAULT NULL,
  PRIMARY KEY (`id_barang`)
) ENGINE=InnoDB AUTO_INCREMENT=21 DEFAULT CHARSET=latin1;

/*Data for the table `mst_barang` */

insert  into `mst_barang`(`id_barang`,`id_jenis_barang`,`identitas`) values (13,2,'QWERTY'),(14,2,'ABCD'),(15,2,'EFG'),(16,3,'TYUI'),(17,3,'VBN'),(18,1,'SN1334'),(19,1,'SN3142343'),(20,1,'SN23145');

/*Table structure for table `mst_jenis_barang` */

DROP TABLE IF EXISTS `mst_jenis_barang`;

CREATE TABLE `mst_jenis_barang` (
  `id_jenis_barang` int(11) NOT NULL AUTO_INCREMENT,
  `nama_barang` varchar(50) DEFAULT NULL,
  `merk` varchar(50) DEFAULT NULL,
  PRIMARY KEY (`id_jenis_barang`)
) ENGINE=InnoDB AUTO_INCREMENT=4 DEFAULT CHARSET=latin1;

/*Data for the table `mst_jenis_barang` */

insert  into `mst_jenis_barang`(`id_jenis_barang`,`nama_barang`,`merk`) values (1,'CASH MAGNUM KNOCKER 25 CAL','Cal .25 Accies & Shelvoke'),(2,'Notebook','Asus'),(3,'Notebook','Acer Aspire One');

/*Table structure for table `mst_login` */

DROP TABLE IF EXISTS `mst_login`;

CREATE TABLE `mst_login` (
  `id_login` int(11) NOT NULL AUTO_INCREMENT,
  `nama` varchar(25) DEFAULT NULL,
  `username` varchar(25) DEFAULT NULL,
  `password` varchar(125) DEFAULT NULL,
  PRIMARY KEY (`id_login`)
) ENGINE=InnoDB AUTO_INCREMENT=3 DEFAULT CHARSET=latin1;

/*Data for the table `mst_login` */

insert  into `mst_login`(`id_login`,`nama`,`username`,`password`) values (1,'Admin Supply Chain','admin','202cb962ac59075b964b07152d234b70'),(2,'Awo','awo','123');

/*Table structure for table `mst_rph` */

DROP TABLE IF EXISTS `mst_rph`;

CREATE TABLE `mst_rph` (
  `id_rph` int(11) NOT NULL AUTO_INCREMENT,
  `nama_rph` varchar(50) DEFAULT NULL,
  `kota` varchar(25) DEFAULT NULL,
  `alamat` text,
  `koordinat` varchar(15) DEFAULT NULL,
  PRIMARY KEY (`id_rph`)
) ENGINE=InnoDB AUTO_INCREMENT=9 DEFAULT CHARSET=latin1;

/*Data for the table `mst_rph` */

insert  into `mst_rph`(`id_rph`,`nama_rph`,`kota`,`alamat`,`koordinat`) values (2,'RPH Bubulak','Bogor','UPTD Rumah Potong Hewan Terpadu Jl. KH R Abdullah Bin Nuh, Kelurahan Bubulak, Kecamatan Bogor Barat, Bogor, Provinsi Jawa Bar',''),(3,'RPH Andri Pratama','Lampung','Komplek RPH Jogoboyo Jl. Jendral Sudirman, RT 01, Kel. Jogoboyo, Kota Lubuk Linggau,  Sumatera Selatan',''),(5,'RPH Sorek','Riau','Jl. PT. Serikat RT/RW: 01/09, Engkolan, Kel. Sorek Satu, Kel. Pangkalan Kuras, Riau',''),(6,'RPH Air Molek','Riau','Jl. Jendral Sudirman, No. 10, Air Molek, Riau\r\n',''),(7,'RPH Aneka Jaya Petir','Tanggerang','RT. 02/RW.06, Kelurahan Petir, Kecamatan Cipondoh, Kota Tanggerang, Banten\r\n',''),(8,'RPH Aneka Jaya Sepatan','Tanggerang','Kampung Pangsor, RT. 001/003, Desa Sangiang, Kecamatan Sepatan Timur, Kabupaten Tanggerang','');

/*Table structure for table `penerimaan_detail` */

DROP TABLE IF EXISTS `penerimaan_detail`;

CREATE TABLE `penerimaan_detail` (
  `id_penerimaan_detail` int(11) NOT NULL AUTO_INCREMENT,
  `id_pengiriman` int(11) DEFAULT NULL,
  `nota` varchar(30) DEFAULT NULL,
  `eartag` varchar(10) DEFAULT NULL,
  `shipment` varchar(20) DEFAULT NULL,
  `material_description` varchar(100) DEFAULT NULL,
  `rfid` varchar(30) DEFAULT NULL,
  `berat` varchar(10) DEFAULT NULL,
  `customer` varchar(25) DEFAULT NULL,
  `no_kendaraan` varchar(10) DEFAULT NULL,
  `status_potong` char(1) DEFAULT '0',
  `tanggal_potong` date DEFAULT NULL,
  `jam_potong` time DEFAULT NULL,
  `keterangan_potong` varchar(125) DEFAULT NULL,
  `pasar` varchar(50) DEFAULT NULL,
  `nama_pedagang` varchar(50) DEFAULT NULL,
  `berat_karkas` varchar(5) DEFAULT NULL,
  `merah` char(1) DEFAULT NULL,
  `orange` char(1) DEFAULT NULL,
  `hitam` char(1) DEFAULT NULL,
  `kuning` char(1) DEFAULT NULL,
  `peneumatic` varchar(15) DEFAULT NULL,
  `score_stune` char(3) DEFAULT NULL,
  PRIMARY KEY (`id_penerimaan_detail`),
  UNIQUE KEY `NewIndex1` (`rfid`),
  KEY `FK_pengiriman_detail` (`id_pengiriman`),
  CONSTRAINT `FK_penerimaan_detail` FOREIGN KEY (`id_pengiriman`) REFERENCES `pengiriman` (`id_pengiriman`) ON DELETE CASCADE ON UPDATE CASCADE
) ENGINE=InnoDB AUTO_INCREMENT=25 DEFAULT CHARSET=latin1;

/*Data for the table `penerimaan_detail` */

insert  into `penerimaan_detail`(`id_penerimaan_detail`,`id_pengiriman`,`nota`,`eartag`,`shipment`,`material_description`,`rfid`,`berat`,`customer`,`no_kendaraan`,`status_potong`,`tanggal_potong`,`jam_potong`,`keterangan_potong`,`pasar`,`nama_pedagang`,`berat_karkas`,`merah`,`orange`,`hitam`,`kuning`,`peneumatic`,`score_stune`) values (14,70,'3610030282','3203447','N1642FB','Escass Bull','982 091011209894','491','MUHAMMAD JIHAD RAMADHAN','B 9601 BYX','0',NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL),(15,70,'3610030282','3203404','N1642FB','Escass Bull','942 000025687067','640','MUHAMMAD JIHAD RAMADHAN','B 9601 BYX','0',NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL),(16,70,'3610030282','3203370','N1642FB','Escass Bull','982 125004471751','500','MUHAMMAD JIHAD RAMADHAN','B 9601 BYX','0',NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL),(17,70,'3610030282','3203339','N1642FB','Escass Bull','982 123509385615','468','MUHAMMAD JIHAD RAMADHAN','B 9601 BYX','0',NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL),(18,70,'3610030282','3203159','N1642FB','Escass Bull','982 123509388633','602','MUHAMMAD JIHAD RAMADHAN','B 9601 BYX','0',NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL),(19,70,'3610030282','3200981','N1642FB','Escass Bull','982 123520225788','506','MUHAMMAD JIHAD RAMADHAN','B 9601 BYX','0',NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL),(20,70,'3610030282','3200927','N1642FB','Escass Bull','982 123509383970','454','MUHAMMAD JIHAD RAMADHAN','B 9601 BYX','0',NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL),(21,70,'3610030282','3202897','N1642FB','Escass Bull','982 123519953022','472','MUHAMMAD JIHAD RAMADHAN','B 9601 BYX','0',NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL),(22,70,'3610030282','3202874','N1642FB','Escass Bull','982 123509287615','610','MUHAMMAD JIHAD RAMADHAN','B 9601 BYX','1','2017-06-22','03:11:00','','','','','1','0','0','0','1','3'),(23,70,'3610030282','3202720','N1642FB','Escass Bull','982 123475784685','485','MUHAMMAD JIHAD RAMADHAN','B 9601 BYX','1','2017-06-23','03:11:00','','','','','1','0','0','0','1','2'),(24,70,'3610030282','3202535','N1642FB','Escass Bull','982 123510046746','446','MUHAMMAD JIHAD RAMADHAN','B 9601 BYX','1','2017-06-20','02:27:00','','','','','0','1','0','0','1','3');

/*Table structure for table `pengiriman` */

DROP TABLE IF EXISTS `pengiriman`;

CREATE TABLE `pengiriman` (
  `id_pengiriman` int(11) NOT NULL AUTO_INCREMENT,
  `id_rph` int(11) DEFAULT NULL,
  `no_pengiriman` varchar(15) DEFAULT NULL,
  `tanggal_kirim` date DEFAULT NULL,
  `jam_kirim` time DEFAULT NULL,
  `asal_sapi` enum('GGL','NTF','PO') DEFAULT NULL,
  `keterangan` varchar(125) DEFAULT NULL,
  `status_terima` char(1) DEFAULT '0',
  `tanggal_terima` date DEFAULT NULL,
  `jam_terima` time DEFAULT NULL,
  `keterangan_terima` varchar(125) DEFAULT NULL,
  PRIMARY KEY (`id_pengiriman`)
) ENGINE=InnoDB AUTO_INCREMENT=71 DEFAULT CHARSET=latin1;

/*Data for the table `pengiriman` */

insert  into `pengiriman`(`id_pengiriman`,`id_rph`,`no_pengiriman`,`tanggal_kirim`,`jam_kirim`,`asal_sapi`,`keterangan`,`status_terima`,`tanggal_terima`,`jam_terima`,`keterangan_terima`) values (70,6,'TRF.170620.0001','2017-06-20','11:43:00','GGL','','1','2017-06-20','13:43:00','Mati 2');

/*Table structure for table `pengiriman_detail` */

DROP TABLE IF EXISTS `pengiriman_detail`;

CREATE TABLE `pengiriman_detail` (
  `id_pengiriman_detail` int(11) NOT NULL AUTO_INCREMENT,
  `id_pengiriman` int(11) DEFAULT NULL,
  `nota` varchar(30) DEFAULT NULL,
  `eartag` varchar(10) DEFAULT NULL,
  `shipment` varchar(20) DEFAULT NULL,
  `material_description` varchar(100) DEFAULT NULL,
  `rfid` varchar(30) DEFAULT NULL,
  `berat` varchar(10) DEFAULT NULL,
  `customer` varchar(25) DEFAULT NULL,
  `no_kendaraan` varchar(10) DEFAULT NULL,
  `status_terima` char(1) DEFAULT '0',
  PRIMARY KEY (`id_pengiriman_detail`),
  UNIQUE KEY `NewIndex1` (`rfid`),
  KEY `FK_pengiriman_detail` (`id_pengiriman`),
  CONSTRAINT `FK_pengiriman_detail` FOREIGN KEY (`id_pengiriman`) REFERENCES `pengiriman` (`id_pengiriman`) ON DELETE CASCADE ON UPDATE CASCADE
) ENGINE=InnoDB AUTO_INCREMENT=27 DEFAULT CHARSET=latin1;

/*Data for the table `pengiriman_detail` */

insert  into `pengiriman_detail`(`id_pengiriman_detail`,`id_pengiriman`,`nota`,`eartag`,`shipment`,`material_description`,`rfid`,`berat`,`customer`,`no_kendaraan`,`status_terima`) values (14,70,'3610030282','3203715','N1642FB','Escass Bull','982 091015150178','550','MUHAMMAD JIHAD RAMADHAN','B 9601 BYX','0'),(15,70,'3610030282','3203481','N1642FB','Escass Bull','982 123509388540','548','MUHAMMAD JIHAD RAMADHAN','B 9601 BYX','0'),(16,70,'3610030282','3203447','N1642FB','Escass Bull','982 091011209894','491','MUHAMMAD JIHAD RAMADHAN','B 9601 BYX','1'),(17,70,'3610030282','3203404','N1642FB','Escass Bull','942 000025687067','640','MUHAMMAD JIHAD RAMADHAN','B 9601 BYX','1'),(18,70,'3610030282','3203370','N1642FB','Escass Bull','982 125004471751','500','MUHAMMAD JIHAD RAMADHAN','B 9601 BYX','1'),(19,70,'3610030282','3203339','N1642FB','Escass Bull','982 123509385615','468','MUHAMMAD JIHAD RAMADHAN','B 9601 BYX','1'),(20,70,'3610030282','3203159','N1642FB','Escass Bull','982 123509388633','602','MUHAMMAD JIHAD RAMADHAN','B 9601 BYX','1'),(21,70,'3610030282','3200981','N1642FB','Escass Bull','982 123520225788','506','MUHAMMAD JIHAD RAMADHAN','B 9601 BYX','1'),(22,70,'3610030282','3200927','N1642FB','Escass Bull','982 123509383970','454','MUHAMMAD JIHAD RAMADHAN','B 9601 BYX','1'),(23,70,'3610030282','3202897','N1642FB','Escass Bull','982 123519953022','472','MUHAMMAD JIHAD RAMADHAN','B 9601 BYX','1'),(24,70,'3610030282','3202874','N1642FB','Escass Bull','982 123509287615','610','MUHAMMAD JIHAD RAMADHAN','B 9601 BYX','1'),(25,70,'3610030282','3202720','N1642FB','Escass Bull','982 123475784685','485','MUHAMMAD JIHAD RAMADHAN','B 9601 BYX','1'),(26,70,'3610030282','3202535','N1642FB','Escass Bull','982 123510046746','446','MUHAMMAD JIHAD RAMADHAN','B 9601 BYX','1');

/*Table structure for table `perawatan_asset` */

DROP TABLE IF EXISTS `perawatan_asset`;

CREATE TABLE `perawatan_asset` (
  `id_perawatan` int(11) NOT NULL AUTO_INCREMENT,
  `id_barang` int(11) DEFAULT NULL,
  `tanggal_rusak` date DEFAULT NULL,
  `tanggal_perbaiki` date DEFAULT NULL,
  `keterangan` varchar(125) DEFAULT NULL,
  `status` char(1) DEFAULT '0',
  PRIMARY KEY (`id_perawatan`),
  KEY `FK_perawatan_asset` (`id_barang`),
  CONSTRAINT `FK_perawatan_asset` FOREIGN KEY (`id_barang`) REFERENCES `mst_barang` (`id_barang`)
) ENGINE=InnoDB AUTO_INCREMENT=8 DEFAULT CHARSET=latin1;

/*Data for the table `perawatan_asset` */

insert  into `perawatan_asset`(`id_perawatan`,`id_barang`,`tanggal_rusak`,`tanggal_perbaiki`,`keterangan`,`status`) values (6,17,'2017-06-07','2017-06-10','Fiix','1'),(7,16,'2017-06-08',NULL,'','0');

/*Table structure for table `powerload` */

DROP TABLE IF EXISTS `powerload`;

CREATE TABLE `powerload` (
  `id_powerload` int(11) NOT NULL AUTO_INCREMENT,
  `id_rph` int(11) DEFAULT NULL,
  `tanggal` date DEFAULT NULL,
  `merah` varchar(5) DEFAULT NULL,
  `orange` varchar(5) DEFAULT NULL,
  `hitam` varchar(5) DEFAULT NULL,
  `kuning` varchar(5) DEFAULT NULL,
  PRIMARY KEY (`id_powerload`),
  KEY `FK_powerload` (`id_rph`),
  CONSTRAINT `FK_powerload` FOREIGN KEY (`id_rph`) REFERENCES `mst_rph` (`id_rph`)
) ENGINE=InnoDB AUTO_INCREMENT=6 DEFAULT CHARSET=latin1;

/*Data for the table `powerload` */

insert  into `powerload`(`id_powerload`,`id_rph`,`tanggal`,`merah`,`orange`,`hitam`,`kuning`) values (5,6,'2017-06-11','50','40','35','10');

/*!40101 SET SQL_MODE=@OLD_SQL_MODE */;
/*!40014 SET FOREIGN_KEY_CHECKS=@OLD_FOREIGN_KEY_CHECKS */;
/*!40014 SET UNIQUE_CHECKS=@OLD_UNIQUE_CHECKS */;
/*!40111 SET SQL_NOTES=@OLD_SQL_NOTES */;
