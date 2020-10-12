/*
SQLyog Ultimate v9.10 
MySQL - 5.5.5-10.1.16-MariaDB : Database - supplychain1
*********************************************************************
*/

/*!40101 SET NAMES utf8 */;

/*!40101 SET SQL_MODE=''*/;

/*!40014 SET @OLD_UNIQUE_CHECKS=@@UNIQUE_CHECKS, UNIQUE_CHECKS=0 */;
/*!40014 SET @OLD_FOREIGN_KEY_CHECKS=@@FOREIGN_KEY_CHECKS, FOREIGN_KEY_CHECKS=0 */;
/*!40101 SET @OLD_SQL_MODE=@@SQL_MODE, SQL_MODE='NO_AUTO_VALUE_ON_ZERO' */;
/*!40111 SET @OLD_SQL_NOTES=@@SQL_NOTES, SQL_NOTES=0 */;
CREATE DATABASE /*!32312 IF NOT EXISTS*/`supplychain1` /*!40100 DEFAULT CHARACTER SET latin1 */;

USE `supplychain1`;

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

/*Table structure for table `movement_log` */

DROP TABLE IF EXISTS `movement_log`;

CREATE TABLE `movement_log` (
  `id_log_movement` int(11) NOT NULL AUTO_INCREMENT,
  `id_pengiriman` int(11) NOT NULL,
  `move_from` varchar(100) DEFAULT NULL COMMENT 'id_rph',
  `move_to` varchar(100) DEFAULT NULL COMMENT 'id_rph',
  `move_time` datetime DEFAULT NULL,
  `movement_number` varchar(100) DEFAULT NULL,
  `user` varchar(100) DEFAULT NULL COMMENT 'name',
  PRIMARY KEY (`id_log_movement`)
) ENGINE=InnoDB AUTO_INCREMENT=7 DEFAULT CHARSET=latin1;

/*Data for the table `movement_log` */

insert  into `movement_log`(`id_log_movement`,`id_pengiriman`,`move_from`,`move_to`,`move_time`,`movement_number`,`user`) values (6,155,'GGL','Depot Gaharu ','2018-04-20 09:06:26','Log.65.1804200906','Admin Supply Chain');

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
) ENGINE=InnoDB AUTO_INCREMENT=31 DEFAULT CHARSET=latin1;

/*Data for the table `mst_awo` */

insert  into `mst_awo`(`id_awo`,`nama_awo`,`telpon_awo`,`id_rph`,`username`,`password`,`mac`) values (1,'ANGGA SOPIAN','0897676767',15,'angga','angga17','08:8C:2C:02:AE:73'),(3,'SUTRISNO','0821 8213 3307',2,'sutrisno','sutrisno17','00:00:00:00:00:00'),(4,'SIDIK PURNOMO','90086755587',5,'sidik','sidik17',NULL),(6,'A. CHRISNA N ','0813 6709 29277',15,'krisna','krisna17',NULL),(8,'ACHMAD AFDILLAH','0856 6424 4739',41,'Fadillah','fadillah17',NULL),(9,'AHMAD EKA SETIAWAN','0823 7749 1980',22,'ahmadeka','ahmadeka17',NULL),(10,'ANDIKA EKA PURBAYA','0823 8038 3776',60,'andikaeka','andikaeka17',NULL),(11,'ANDREAS ARIS KURNIAWAN','0813 1015 9535',41,'andreas','andreas17',NULL),(12,'ANDRIANDI HERNAWAN','ANDRIANDI HERNA',42,'hernawan','hernawan17',NULL),(14,'ARI PURWANTO','0821 7996 3521',25,'purwanto','purwanto17',NULL),(16,'ARI YANUARDI','0896 4987 7927',57,'yanuardi','yanuardi17',NULL),(17,'ARYA ISMAIL','0821 7890 4115',64,'arya','arya17',NULL),(18,'BAYU APRILYANTO','0823 7582 0782',18,'aprilyanto','aprilyanto17',NULL),(19,'BOBBY ARIF SETIAWAN','0821 8213 3304',65,'setiawan','setiawan17',NULL),(20,'DANANG ULY ASTOKO','0812 7181 1286',12,'astoko','astoko17',NULL),(21,'DEDI WIJAYA','0822 7800 6257',35,'wijaya','wijaya17',NULL),(22,'DITAMA WAHYU','0823 7492 5705',54,'wahyu','wahyu17',NULL),(23,'EKO ANDRIANTO','0852 7820 0111',56,'andrianto','andrianto17',NULL),(24,'EKO WAHYU PRASTYO','0812 7140 7979',11,'prastyo','prastyo17',NULL),(25,'ERDI MARFIYAN','0823 8689 0880',20,'marfiyan','marfiyan17',NULL),(26,'HENRYCUS GABRIEL','0812 9097 8271',60,'gabriel','gabriel17',NULL),(27,'NOPIAN SAPARUDIN','',58,'nopian','nopian17',NULL),(28,'Rengga Yulisa Wibowo','081367964971',68,'rengga','rengga17',NULL),(29,'HIDAYATUL MUSTOFA','082179963526',61,'hidayatul','hidayatul17',NULL),(30,'test','123',64,'test','teset','tes');

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

insert  into `mst_login`(`id_login`,`nama`,`username`,`password`) values (1,'Admin Supply Chain','admin','202cb962ac59075b964b07152d234b70'),(2,'Awo','awo','202cb962ac59075b964b07152d234b70');

/*Table structure for table `mst_rph` */

DROP TABLE IF EXISTS `mst_rph`;

CREATE TABLE `mst_rph` (
  `id_rph` int(11) NOT NULL AUTO_INCREMENT,
  `nama_rph` varchar(50) DEFAULT NULL,
  `kota` varchar(25) DEFAULT NULL,
  `alamat` text,
  `koordinat` varchar(15) DEFAULT NULL,
  `jenis_rph` enum('RPH','Depot') NOT NULL,
  PRIMARY KEY (`id_rph`)
) ENGINE=InnoDB AUTO_INCREMENT=71 DEFAULT CHARSET=latin1;

/*Data for the table `mst_rph` */

insert  into `mst_rph`(`id_rph`,`nama_rph`,`kota`,`alamat`,`koordinat`,`jenis_rph`) values (2,'RPH Bubulak','Bogor','UPTD Rumah Potong Hewan Terpadu Jl. KH R Abdullah Bin Nuh, Kelurahan Bubulak, Kecamatan Bogor Barat, Bogor, Provinsi Jawa Bar','','RPH'),(3,'RPH Andri Pratama','Lampung','Komplek RPH Jogoboyo Jl. Jendral Sudirman, RT 01, Kel. Jogoboyo, Kota Lubuk Linggau,  Sumatera Selatan','','RPH'),(5,'RPH Sorek','Riau','Jl. PT. Serikat RT/RW: 01/09, Engkolan, Kel. Sorek Satu, Kel. Pangkalan Kuras, Riau','','RPH'),(6,'RPH Air Molek','Riau','Jl. Jendral Sudirman, No. 10, Air Molek, Riau\r\n','','RPH'),(7,'RPH Aneka Jaya Petir','Tanggerang','RT. 02/RW.06, Kelurahan Petir, Kecamatan Cipondoh, Kota Tanggerang, Banten\r\n','','RPH'),(8,'RPH Aneka Jaya Sepatan','Tanggerang','Kampung Pangsor, RT. 001/003, Desa Sangiang, Kecamatan Sepatan Timur, Kabupaten Tanggerang','','RPH'),(9,'RPH Bangkinang','Riau','Kab. Kampar (UPT Rumah Potong Hewan), Jl. Bangkinang Petapahan Km 6, Kel Pasir Sialang, Kab Kampar, Provinsi Riau\r\n','','RPH'),(10,'RPH Batu Riset','Pagar Alam','Jl. Lingkar Desa Mekar Alam, Kota Pagar Alam, Provinsi Sumatera Selatan\r\n','','RPH'),(11,'RPH Bayur','Banten','Jl. Sangego Raya, Bayur Raya, Kec. Karawaci, Prov. Banten','','RPH'),(12,'RPH Bengkulu','Bengkulu','Komplek RPH Bengkulu Kel. Padang Serai, Kec. Kampung Melayu, Bengkulu Provinsi Bengkulu','','RPH'),(13,'RPH Beni/Bahri','Palembang','Gandus Slaughtering House Complex of Local Government Facility-Jl. Tp H Sofyan Kenawas, Gandus, Palembang-Provinsi Sumatera Selatan','','RPH'),(14,'RPH Bukit Kemuning','Lampung','Dusun5, RK 1, Desa Suka Menanti, Kec. Bukit Kemuning, Kab. Lampung Utara, Lampung','','RPH'),(15,'RPH Cibinong','Bogor','Jl. H. Ashari Kp. Bojong Koneng, Kel. Tengah, Kec. Cibinong, Bogor.','','RPH'),(16,'RPH Cikampek','Cikampek','Jl. Kamojing Cikampek, Kab. Karawang, Provinsi Jawa Barat','','RPH'),(17,'RPH Cirangrang','Cirangrang','JL. H. Wahid Hasyim, Kopo Cirangrang, Bandung','','RPH'),(18,'RPH Cirebon (Battembat)','Cirebon','JI. Pejagan Baru Desa Battembat Kec. Tengah Tani Kab. Cirebon Indonesia','','RPH'),(19,'RPH Ciroyom (PT. BLI)','Bandung','PT BLI, Jl. Arjuna No 45 Bandung, Indonesia','','RPH'),(20,'RPH Dhamasraya (H. Anto)','Dhamasraya','Jl. Muara Momong KM.4, Sungai Kambut, Kec. Pulau Punjung, Kab. Dhamasraya, Sumatera Barat','','RPH'),(21,'RPH Dumai','Dumai','Jl. KUD, Kelurahan Bagan Besar, Kec. Bukit Kapur, Dumai, Propinsi Riau','','RPH'),(22,'RPH Edward','Edward','Gg. Mulia RT 01/01 Komplek Indraputra Subing Kec. Terbanggi Besar, Lampung Tengah, Provinsi Lampung','','RPH'),(23,'RPH Elders','Bogor','Jl. Agatis, Lingkar Kampus IPB, RPH. Dramaga, Bogor, Provinsi Jawa Barat','','RPH'),(24,'RPH GGL','Lampung','Jl. Raya Arah Menggala Km. 77, Terbanggi Besar, Lampung Tengah, Provinsi Lampung.','','RPH'),(25,'RPH H Andak','Palembang','Gandus Slaughtering House Complex of Local Government Facility-Jl. Tp H Sofyan Kenawas, Gandus, Palembang-Provinsi Sumatera Selatan','','RPH'),(26,'RPH H Mamat','Bekasi','INKOPABRI Slaughtering-House Complex Jl. Raya Hankam, Penjagalan H. Mamat, Kel. Jatiwarna, Kec. Pondok Melati Kota Bekasi,  Provinsi Jawa Barat','','RPH'),(27,'RPH H Sidik','Depok','Jl. Caringin Kamp. Kepupu Kel. Rangkapan Jaya, Kec. Pancoran Mas, Depok Provinsi Jawa Barat','','RPH'),(28,'RPH H Somad','Lampung','Desa Bandar Kertahayu, RT 12 RW 3 Kec. Way Pangubuan, Lampung Tengah, Lampung','','RPH'),(29,'RPH H Tatang','Tangerang','Kp. Waru 2 RT 01/04 Ds. Sukaharja Kec. Sindang Jaya, Tangerang, Indonesia','','RPH'),(30,'RPH Kabupaten Bandung Barat','Bandung','Jln. Raya Padalarang - Purwakarta Km. 5,3 Kampung Asrama, RT 02/RW 04, Desa Campakamekar, Kecamatan Padalarang, Kab. Bandung Barat','','RPH'),(31,'RPH Karawaci','Karawaci','Taman Cisadane No. 189. Panunggangan Barat RT. 003/RW. 01, Cibodas, Tanggerang, Banten / Jl. Taman Cisadane no 99 Kelurahan Penunggangan Barat, Kecamatan Jatiuwung, Kotamadya,Tangerang, Banten./Jalan Panunggangan Barat No.14, Karawaci, Tangerang, Banten.','','RPH'),(32,'RPH Koto Baru','Koto Baru','Nagari Jorong Seberang Piruko Barat, Koto Baru, Kec. Koto Baru. Kab. Dhamasraya, Sumatera Barat','','RPH'),(33,'RPH Labuhan Ratu','Labuhan Ratu','Plangkawati RT 021 Rw 004 elurahan Labuhan Ratu 7, Kec. Labuhan Ratu,  Kab Lampung Timur, Lampung','','RPH'),(34,'RPH Madin','Palembang','Gandus Slaughtering House Complex of Local Government Facility-Jl. Tp H Sofyan Kenawas, Gandus, Palembang Provinsi Sumatera Selatan.','','RPH'),(35,'RPH Metro','Metro','Jl. Macan No. 22 Kelurahan Hadimulyo Timur, Kecamatan Metro Pusat, Provinsi Lampung, Indonesia','','RPH'),(36,'RPH Muara Bungo','Muara Bungo','Jl. Durian RT.003 Desa Talang Pantai, Kec. Bungo Dani, Kab. Muara Bung, Jambi','','RPH'),(37,'RPH Muara Enim','Muara Enim','Jl. Kirab Remaja RT V RW III Desa Sukamaju, Kel. Air Lintang, Kec. Muara Enim, Sumatera Selatan','','RPH'),(38,'RPH Nilasari','Palembang','Gandus Slaughtering House Complex of Local Government Facility-Jl. Tp H Sofyan Kenawas, Gandus, Palembang-Provinsi Sumatera Selatan','','RPH'),(39,'RPH Padang (Lubuk Buaya)','Padang','Jl. Adinegoro KM. 5 Lubuk Buaya, Kota Padang, Provinsi Sumatera Barat','','RPH'),(40,'RPH Padang Pariaman','Padang Pariaman','Jl. Punggung Kasiak, Nagari Punggung Kasiak, Kec. Lubuk Alung, Padang Pariaman, Sumatera Barat','','RPH'),(41,'RPH Panam','Pekanbaru','Komplek RPH Pekanbaru Jl. Cipta Karya Ujung, Kompleks RPH, Kel. Swahkarya, Kec. Tampan, Pekanbaru, Riau','','RPH'),(42,'RPH Pangkal Pinang','Pangkal Pinang','Kelurahan Air Mawar, Kec. Bukit Intan, Kab/Kota Pangkal Pinang, Prop. Bangka Belitung','','RPH'),(43,'RPH PD. Dharmajaya','Jakarta','Jl.Penggilingan  Raya no.25 Cakung, Jakarta Timur.  ','','RPH'),(44,'RPH Prabumulih','Prabumulih','Jl. Sungai Medang Samping Perumnas Medang permai, Prabumulih, Sumatera Selatan','','RPH'),(45,'RPH PT. Anugerah Nagari Indonesia','Tangerang','Jl.Ki Hajar Dewantoro, RT 002, RW 10, Kel. Sawah Ciputat, Kota Tangerang Selatan, Provinsi Banten','','RPH'),(46,'RPH Purwakarta','Purwakarta','Jl. Raya Ciselang No.3 Munjul Jaya Purwakarta, Jawa Barat, Indonesia ','','RPH'),(47,'RPH Riau Galang Perkasa','Siak','Jl. Raya Pertiwi Pinang Sebatang Timur, Perawang, Kab. Siak, Riau','','RPH'),(48,'RPH Shampico Abattoir','Bekasi','Jl. Andini Sakti KM.44 Desa Gandasari Kecamatan Cikarang Barat Cibitung, Kabupaten Bekasi, Indonesia','','RPH'),(49,'RPH Solok','Solok','Jl. Imam Bonjol No. 366, Tanah Garam, Kota Solok, Provinsi Sumatera Barat','','RPH'),(50,'RPH Sumber Makanan Sehat','Cianjur','Kampung 18, Desa Sarampad, Kecamatan Cugenang, Cianjur, Jawa Barat, Indonesia','','RPH'),(51,'RPH Sungai Liat','Sungai Liat','Jl. Pesona, Kampung Rambak, Sungai Liat, Bangka-Belitung','','RPH'),(52,'RPH Syahril','Lahat','Jl. Lematang 2, No. 85, RT 05, Kec. Kotajaya Lahat, Kab. Lahat, Sumatera Selatan','','RPH'),(53,'RPH Tapos','Depok','Jl. Raya Tapos RT 02 RW 3 Kel. Tapos Kecamatan Tapos, Depok, Jawa Barat.','','RPH'),(54,'RPH Tasikmalaya','Tasikmalaya','Jl. Letjen Ibrahim Adjie KM7, Kelurahan Sukamaju Kaler, Kecamatan Indihiang, Kota Tasikmalaya, Jawa Barat 46151, Indonesia ','','RPH'),(55,'RPH Tengki','Ciputat',' Jl. Cendrawasih no. 25. Sawah Lama,   Ciputat, Tangerang Selatan','','RPH'),(56,'RPH UPTD Kota Solok','Solok','Jl. Lingkar Utara, Kelurahan Kp. Jawa, Kecamatan Tj. Harapan, Kota Solok, Sumatera Barat','','RPH'),(57,'RPH Way Laga','Bandar Lampung','Jl. Wala Abadi Km.6 Kelurahan Way Laga Kecamatan Panjang, Bandar Lampung','','RPH'),(58,'RPH Zainudin','Bandar Lampung','Jl. Dr. Warsito No 77, Rt 01 Rk 01, Kelurahan Kupang, Kec. Teluk Betung Utara, Kota Bandar Lampung','','RPH'),(59,'RPH Zidin','Medan','Jl. Stasiun, Kelurahan Tanjung Gusta, Kecamatan Medan Sunggal, kabupaten Deli Serdang, Provinsi Sumatera Utara','','RPH'),(60,'RPH Bina Hilir Utama Niaga Utama / Jakabaring','Palembang','JI. Sisingamangaraja, Desa Babatan Saudagar, Dusun III, Kec. Pemulutan, Kab. Ogan Ilir. Provinsi Sumatera Selatan','','RPH'),(61,'RPH UPTD Pringsewu','Pringsewu','Jl. Podomoro, RT.12/RW.2, Pringsewu Kabupaten Pringsewu, Provinsi Lampung','','RPH'),(62,'RPH Lintas Nusa Pratama','Tasikmalaya','Jl. Raya Indihiang  Panoongan KM. 6, Kota Tasikmalaya, Provinsi Jawa Barat','','RPH'),(63,'Depot Mitra Sarana Niaga','Tasikmalaya','Jl. Babakan Pala, RT 01 / RW 10, Kelurahan Kersamenak, Kecamatan Kawalu, Kota Tasikmalaya','','Depot'),(64,'Depot Beni/bahri','Palembang','JI. Sisingamangaraja, Desa Babatan Saudagar, Dusun III, Kec. Pemulutan, Kab. Ogan Ilir. Provinsi Sumatera Selatan','','Depot'),(65,'Depot Gaharu ','Bogor','Pabuaran Kaler RT 04 RW 04,Desa Pabuaran, Kecamatan Kemang, Kabupaten Bogor','','Depot'),(66,'Depot H Andak','Palembang','Jl. Kajawen No. 1986 Rt. 24, Kelurahan Pipareja, Kecamatan Kemuning, Kota Palembang, Propinsi Sumatera Selatan ','','Depot'),(67,'RPH Syaiful Bahri','Pagaralam','Jl. Kapten Sanap No.21, Rt 05, Rw 02, Demporeokan, Kec. Pagar Alam, Kota Pagar Alam, Sumatera Selatan ','','RPH'),(68,'RPH H Samud','','','','RPH'),(69,'RPH Kuningan','Kuningan','Desa Ancaran, Kecamatan Kuningan, Kabupaten Kuningan, Jawa Barat','','RPH'),(70,'RPH Martapura','Martapura','Desa Metro Rejo, Kec Buay Madang Timur, Kab Ogan Komering Ulu Timur, Sumatera Selatan','','RPH');

/*Table structure for table `pemotongan_log` */

DROP TABLE IF EXISTS `pemotongan_log`;

CREATE TABLE `pemotongan_log` (
  `id_log_pengerjaan` int(11) NOT NULL AUTO_INCREMENT,
  `id_penerimaan_detail` int(11) DEFAULT NULL,
  `id_awo` int(11) DEFAULT NULL,
  `log` varchar(100) DEFAULT NULL,
  `status` int(11) DEFAULT NULL,
  `tanggal_laporan` date DEFAULT NULL,
  `jam` time DEFAULT NULL,
  `id_rph` int(11) DEFAULT NULL,
  PRIMARY KEY (`id_log_pengerjaan`)
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

/*Data for the table `pemotongan_log` */

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
  `flag` char(1) DEFAULT '0',
  `intransit` int(11) NOT NULL,
  PRIMARY KEY (`id_penerimaan_detail`),
  UNIQUE KEY `NewIndex1` (`rfid`),
  KEY `FK_pengiriman_detail` (`id_pengiriman`),
  CONSTRAINT `FK_penerimaan_detail` FOREIGN KEY (`id_pengiriman`) REFERENCES `pengiriman` (`id_pengiriman`) ON DELETE CASCADE ON UPDATE CASCADE
) ENGINE=InnoDB AUTO_INCREMENT=14 DEFAULT CHARSET=latin1;

/*Data for the table `penerimaan_detail` */

insert  into `penerimaan_detail`(`id_penerimaan_detail`,`id_pengiriman`,`nota`,`eartag`,`shipment`,`material_description`,`rfid`,`berat`,`customer`,`no_kendaraan`,`status_potong`,`tanggal_potong`,`jam_potong`,`keterangan_potong`,`pasar`,`nama_pedagang`,`berat_karkas`,`merah`,`orange`,`hitam`,`kuning`,`peneumatic`,`score_stune`,`flag`,`intransit`) values (1,155,'36100302821','3203715','N1642FB','Escass Bull','982 0910151501781','550','MUHAMMAD JIHAD RAMADHAN','B 9601 BYX','0',NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,'0',1),(2,155,'36100302821','3203481','N1642FB','Escass Bull','982 1235093885401','548','MUHAMMAD JIHAD RAMADHAN','B 9601 BYX','0',NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,'0',1),(3,155,'36100302821','3203447','N1642FB','Escass Bull','982 0910112098941','491','MUHAMMAD JIHAD RAMADHAN','B 9601 BYX','0',NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,'0',1),(4,155,'36100302821','3203404','N1642FB','Escass Bull','942 0000256870671','640','MUHAMMAD JIHAD RAMADHAN','B 9601 BYX','0',NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,'0',1),(5,155,'36100302821','3203370','N1642FB','Escass Bull','982 1250044717511','500','MUHAMMAD JIHAD RAMADHAN','B 9601 BYX','0',NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,'0',1),(6,155,'36100302821','3203339','N1642FB','Escass Bull','982 1235093856151','468','MUHAMMAD JIHAD RAMADHAN','B 9601 BYX','0',NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,'0',1),(7,155,'36100302821','3203159','N1642FB','Escass Bull','982 1235093886331','602','MUHAMMAD JIHAD RAMADHAN','B 9601 BYX','0',NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,'0',1),(8,155,'36100302821','3200981','N1642FB','Escass Bull','982 1235202257881','506','MUHAMMAD JIHAD RAMADHAN','B 9601 BYX','0',NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,'0',1),(9,155,'36100302821','3200927','N1642FB','Escass Bull','982 1235093839701','454','MUHAMMAD JIHAD RAMADHAN','B 9601 BYX','0',NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,'0',1),(10,155,'36100302821','3202897','N1642FB','Escass Bull','982 1235199530221','472','MUHAMMAD JIHAD RAMADHAN','B 9601 BYX','0',NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,'0',1),(11,155,'36100302821','3202874','N1642FB','Escass Bull','982 1235092876151','610','MUHAMMAD JIHAD RAMADHAN','B 9601 BYX','0',NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,'0',1),(12,155,'36100302821','3202720','N1642FB','Escass Bull','982 1234757846851','485','MUHAMMAD JIHAD RAMADHAN','B 9601 BYX','0',NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,'0',1),(13,155,'36100302821','3202535','N1642FB','Escass Bull','982 1235100467461','446','MUHAMMAD JIHAD RAMADHAN','B 9601 BYX','0',NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,'0',1);

/*Table structure for table `pengiriman` */

DROP TABLE IF EXISTS `pengiriman`;

CREATE TABLE `pengiriman` (
  `id_pengiriman` int(11) NOT NULL AUTO_INCREMENT,
  `id_rph` int(11) DEFAULT NULL,
  `no_pengiriman` varchar(15) DEFAULT NULL,
  `tanggal_kirim` date DEFAULT NULL,
  `jam_kirim` time DEFAULT NULL,
  `keterangan` varchar(125) DEFAULT NULL,
  `status_terima` char(1) DEFAULT '0',
  `tanggal_terima` date DEFAULT NULL,
  `jam_terima` time DEFAULT NULL,
  `keterangan_terima` varchar(125) DEFAULT NULL,
  PRIMARY KEY (`id_pengiriman`)
) ENGINE=InnoDB AUTO_INCREMENT=158 DEFAULT CHARSET=latin1;

/*Data for the table `pengiriman` */

insert  into `pengiriman`(`id_pengiriman`,`id_rph`,`no_pengiriman`,`tanggal_kirim`,`jam_kirim`,`keterangan`,`status_terima`,`tanggal_terima`,`jam_terima`,`keterangan_terima`) values (155,65,'36100302821','2018-04-20','09:06:00','test','1','2018-04-20','11:06:00','ok'),(157,6,NULL,'2018-04-20','11:51:00','ok','0',NULL,NULL,NULL);

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
) ENGINE=InnoDB AUTO_INCREMENT=92 DEFAULT CHARSET=latin1;

/*Data for the table `pengiriman_detail` */

insert  into `pengiriman_detail`(`id_pengiriman_detail`,`id_pengiriman`,`nota`,`eartag`,`shipment`,`material_description`,`rfid`,`berat`,`customer`,`no_kendaraan`,`status_terima`) values (79,155,'36100302821','3203715','N1642FB','Escass Bull','982 0910151501781','550','MUHAMMAD JIHAD RAMADHAN','B 9601 BYX','1'),(80,155,'36100302821','3203481','N1642FB','Escass Bull','982 1235093885401','548','MUHAMMAD JIHAD RAMADHAN','B 9601 BYX','1'),(81,155,'36100302821','3203447','N1642FB','Escass Bull','982 0910112098941','491','MUHAMMAD JIHAD RAMADHAN','B 9601 BYX','1'),(82,155,'36100302821','3203404','N1642FB','Escass Bull','942 0000256870671','640','MUHAMMAD JIHAD RAMADHAN','B 9601 BYX','1'),(83,155,'36100302821','3203370','N1642FB','Escass Bull','982 1250044717511','500','MUHAMMAD JIHAD RAMADHAN','B 9601 BYX','1'),(84,155,'36100302821','3203339','N1642FB','Escass Bull','982 1235093856151','468','MUHAMMAD JIHAD RAMADHAN','B 9601 BYX','1'),(85,155,'36100302821','3203159','N1642FB','Escass Bull','982 1235093886331','602','MUHAMMAD JIHAD RAMADHAN','B 9601 BYX','1'),(86,155,'36100302821','3200981','N1642FB','Escass Bull','982 1235202257881','506','MUHAMMAD JIHAD RAMADHAN','B 9601 BYX','1'),(87,155,'36100302821','3200927','N1642FB','Escass Bull','982 1235093839701','454','MUHAMMAD JIHAD RAMADHAN','B 9601 BYX','1'),(88,155,'36100302821','3202897','N1642FB','Escass Bull','982 1235199530221','472','MUHAMMAD JIHAD RAMADHAN','B 9601 BYX','1'),(89,155,'36100302821','3202874','N1642FB','Escass Bull','982 1235092876151','610','MUHAMMAD JIHAD RAMADHAN','B 9601 BYX','1'),(90,155,'36100302821','3202720','N1642FB','Escass Bull','982 1234757846851','485','MUHAMMAD JIHAD RAMADHAN','B 9601 BYX','1'),(91,155,'36100302821','3202535','N1642FB','Escass Bull','982 1235100467461','446','MUHAMMAD JIHAD RAMADHAN','B 9601 BYX','1');

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
) ENGINE=InnoDB AUTO_INCREMENT=16 DEFAULT CHARSET=latin1;

/*Data for the table `powerload` */

insert  into `powerload`(`id_powerload`,`id_rph`,`tanggal`,`merah`,`orange`,`hitam`,`kuning`) values (5,6,'2017-06-11','50','40','35','10'),(6,58,'2017-06-20','50','','',''),(8,58,'2017-11-15','10','10','10','10'),(10,41,'2017-11-02','10','10','10','0'),(11,35,'2017-10-31','10','10','10','10'),(12,2,'2017-11-10','10','10','10','10'),(13,2,'2017-11-22','10','0','0','0'),(14,2,'2017-11-23','15','','',''),(15,35,'2018-02-13','100','100','100','100');

/*!40101 SET SQL_MODE=@OLD_SQL_MODE */;
/*!40014 SET FOREIGN_KEY_CHECKS=@OLD_FOREIGN_KEY_CHECKS */;
/*!40014 SET UNIQUE_CHECKS=@OLD_UNIQUE_CHECKS */;
/*!40111 SET SQL_NOTES=@OLD_SQL_NOTES */;
