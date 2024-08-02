-- MariaDB dump 10.19  Distrib 10.4.24-MariaDB, for Win64 (AMD64)
--
-- Host: localhost    Database: mawar1
-- ------------------------------------------------------
-- Server version	10.4.24-MariaDB

/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;
/*!40103 SET @OLD_TIME_ZONE=@@TIME_ZONE */;
/*!40103 SET TIME_ZONE='+00:00' */;
/*!40014 SET @OLD_UNIQUE_CHECKS=@@UNIQUE_CHECKS, UNIQUE_CHECKS=0 */;
/*!40014 SET @OLD_FOREIGN_KEY_CHECKS=@@FOREIGN_KEY_CHECKS, FOREIGN_KEY_CHECKS=0 */;
/*!40101 SET @OLD_SQL_MODE=@@SQL_MODE, SQL_MODE='NO_AUTO_VALUE_ON_ZERO' */;
/*!40111 SET @OLD_SQL_NOTES=@@SQL_NOTES, SQL_NOTES=0 */;

--
-- Table structure for table `login`
--

DROP TABLE IF EXISTS `login`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `login` (
  `iduser` int(11) NOT NULL AUTO_INCREMENT,
  `email` varchar(50) NOT NULL,
  `password` varchar(50) NOT NULL,
  PRIMARY KEY (`iduser`)
) ENGINE=InnoDB AUTO_INCREMENT=2 DEFAULT CHARSET=utf8mb4;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `login`
--

LOCK TABLES `login` WRITE;
/*!40000 ALTER TABLE `login` DISABLE KEYS */;
INSERT INTO `login` VALUES (1,'reeyviery@upi.edu','admin');
/*!40000 ALTER TABLE `login` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `tbl_barang`
--

DROP TABLE IF EXISTS `tbl_barang`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `tbl_barang` (
  `brg_id` int(11) NOT NULL AUTO_INCREMENT,
  `brg_nama` varchar(100) NOT NULL,
  `brg_kategori` int(11) NOT NULL,
  `brg_quantity` int(11) NOT NULL,
  `brg_harga` int(11) NOT NULL,
  PRIMARY KEY (`brg_id`),
  KEY `brg_kategori` (`brg_kategori`),
  CONSTRAINT `tbl_barang_ibfk_1` FOREIGN KEY (`brg_kategori`) REFERENCES `tbl_kategori` (`kat_id`)
) ENGINE=InnoDB AUTO_INCREMENT=33 DEFAULT CHARSET=utf8mb4;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `tbl_barang`
--

LOCK TABLES `tbl_barang` WRITE;
/*!40000 ALTER TABLE `tbl_barang` DISABLE KEYS */;
INSERT INTO `tbl_barang` VALUES (11,'Sarung Wadimor Kembang',1,75,85000),(12,'Sarung Wadimor Motif Bali',1,107,78000),(13,'Sarung Wadimor Relif',1,0,78000),(14,'Sarung Wadimor Malay',1,0,80000),(15,'Sarung Wadimor Songket',1,0,91000),(16,'Sarung Wadimor Primer Natural',1,0,162000),(17,'Sarung Atlas Kembang Dobby',18,0,135000),(18,'Sarung Atlas Songket',18,0,124000),(19,'Sarung Atlas Idaman 525',18,0,78000),(20,'Sarung Atlas Premium 750',18,0,105000),(21,'Sarung Atlas Premium 770',18,0,163000),(22,'Sarung Atlas Favorit 500',18,0,65000),(23,'Sarung Atlas Junior 425',18,0,62000),(32,'Kopeah Eri',3,0,50000);
/*!40000 ALTER TABLE `tbl_barang` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `tbl_gudang`
--

DROP TABLE IF EXISTS `tbl_gudang`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `tbl_gudang` (
  `gud_id` int(11) NOT NULL AUTO_INCREMENT,
  `brg_id` int(11) NOT NULL,
  `gud_quantity` int(11) NOT NULL,
  PRIMARY KEY (`gud_id`),
  KEY `brg_id` (`brg_id`),
  CONSTRAINT `tbl_gudang_ibfk_1` FOREIGN KEY (`brg_id`) REFERENCES `tbl_barang` (`brg_id`)
) ENGINE=InnoDB AUTO_INCREMENT=21 DEFAULT CHARSET=utf8mb4;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `tbl_gudang`
--

LOCK TABLES `tbl_gudang` WRITE;
/*!40000 ALTER TABLE `tbl_gudang` DISABLE KEYS */;
INSERT INTO `tbl_gudang` VALUES (1,11,10),(2,12,9),(3,13,7),(4,14,9),(5,15,8),(6,16,4),(7,17,10),(8,18,11),(9,19,8),(10,20,7),(11,21,6),(12,22,6),(13,23,8);
/*!40000 ALTER TABLE `tbl_gudang` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `tbl_karyawan`
--

DROP TABLE IF EXISTS `tbl_karyawan`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `tbl_karyawan` (
  `kry_id` int(11) NOT NULL AUTO_INCREMENT,
  `kry_nama` varchar(100) NOT NULL,
  `kry_jk` varchar(50) NOT NULL,
  `kry_nomor` int(11) NOT NULL,
  `kry_alamat` varchar(100) NOT NULL,
  PRIMARY KEY (`kry_id`)
) ENGINE=InnoDB AUTO_INCREMENT=3 DEFAULT CHARSET=utf8mb4;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `tbl_karyawan`
--

LOCK TABLES `tbl_karyawan` WRITE;
/*!40000 ALTER TABLE `tbl_karyawan` DISABLE KEYS */;
INSERT INTO `tbl_karyawan` VALUES (1,'Yeni','Wanita',628542267,'Banjaran'),(2,'Feri','Pria',756433467,'Banjaran');
/*!40000 ALTER TABLE `tbl_karyawan` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `tbl_kategori`
--

DROP TABLE IF EXISTS `tbl_kategori`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `tbl_kategori` (
  `kat_id` int(11) NOT NULL AUTO_INCREMENT,
  `kat_nama` varchar(100) NOT NULL,
  PRIMARY KEY (`kat_id`)
) ENGINE=InnoDB AUTO_INCREMENT=19 DEFAULT CHARSET=utf8mb4;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `tbl_kategori`
--

LOCK TABLES `tbl_kategori` WRITE;
/*!40000 ALTER TABLE `tbl_kategori` DISABLE KEYS */;
INSERT INTO `tbl_kategori` VALUES (1,'Sarung Wadimor'),(2,'Sarung Anak'),(3,'Sarung Perempuan'),(4,'Kain Panjang'),(5,'Taplak Meja'),(6,'Kopeah'),(7,'Selimut '),(8,'Seprai'),(9,'Sarung Bantal'),(10,'Kemeja Alisan Panjang'),(11,'Kemeja Alisan Pendek'),(12,'Kemeja Alisan Batik'),(13,'Kaos Kerah'),(14,'Gendongan Bayi Modern'),(15,'Bantal Bayi'),(16,'Selimut Bayi'),(17,'Selimut Anak'),(18,'Sarung Atlas');
/*!40000 ALTER TABLE `tbl_kategori` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `tbl_keluar_brg`
--

DROP TABLE IF EXISTS `tbl_keluar_brg`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `tbl_keluar_brg` (
  `idkeluar` int(11) NOT NULL AUTO_INCREMENT,
  `idbarang` int(11) NOT NULL,
  `tanggal` timestamp NOT NULL DEFAULT current_timestamp(),
  `keterangan` varchar(25) NOT NULL,
  `qty` int(11) NOT NULL,
  PRIMARY KEY (`idkeluar`)
) ENGINE=InnoDB AUTO_INCREMENT=3 DEFAULT CHARSET=utf8mb4;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `tbl_keluar_brg`
--

LOCK TABLES `tbl_keluar_brg` WRITE;
/*!40000 ALTER TABLE `tbl_keluar_brg` DISABLE KEYS */;
INSERT INTO `tbl_keluar_brg` VALUES (1,11,'2022-04-26 03:47:25','diambil Raze',1),(2,12,'2022-04-26 03:48:50','Dibakar sama Phoenix',4);
/*!40000 ALTER TABLE `tbl_keluar_brg` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `tbl_masuk_brg`
--

DROP TABLE IF EXISTS `tbl_masuk_brg`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `tbl_masuk_brg` (
  `idmasuk` int(11) NOT NULL AUTO_INCREMENT,
  `idbarang` int(11) NOT NULL,
  `tanggal` timestamp NOT NULL DEFAULT current_timestamp(),
  `penerima` varchar(25) NOT NULL,
  `qty` int(11) NOT NULL,
  PRIMARY KEY (`idmasuk`)
) ENGINE=InnoDB AUTO_INCREMENT=6 DEFAULT CHARSET=utf8mb4;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `tbl_masuk_brg`
--

LOCK TABLES `tbl_masuk_brg` WRITE;
/*!40000 ALTER TABLE `tbl_masuk_brg` DISABLE KEYS */;
INSERT INTO `tbl_masuk_brg` VALUES (1,1,'2022-04-20 03:02:40','Brimstone',1),(2,11,'2022-04-20 03:56:40','Jett',100),(3,12,'2022-04-20 04:01:04','Brimstone',150),(4,11,'2022-04-20 04:10:01','Omen',1),(5,11,'2022-04-20 04:11:42','Brimstone',1);
/*!40000 ALTER TABLE `tbl_masuk_brg` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `tbl_pendapatan`
--

DROP TABLE IF EXISTS `tbl_pendapatan`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `tbl_pendapatan` (
  `pnd_id` int(11) NOT NULL AUTO_INCREMENT,
  `pnd_trx_id` int(11) NOT NULL,
  `pnd_total` int(11) NOT NULL,
  PRIMARY KEY (`pnd_id`),
  KEY `pnd_trx_id` (`pnd_trx_id`),
  CONSTRAINT `tbl_pendapatan_ibfk_1` FOREIGN KEY (`pnd_trx_id`) REFERENCES `tbl_trx` (`trx_id`)
) ENGINE=InnoDB AUTO_INCREMENT=3 DEFAULT CHARSET=utf8mb4;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `tbl_pendapatan`
--

LOCK TABLES `tbl_pendapatan` WRITE;
/*!40000 ALTER TABLE `tbl_pendapatan` DISABLE KEYS */;
INSERT INTO `tbl_pendapatan` VALUES (1,1,100000),(2,2,350000);
/*!40000 ALTER TABLE `tbl_pendapatan` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `tbl_trx`
--

DROP TABLE IF EXISTS `tbl_trx`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `tbl_trx` (
  `trx_id` int(11) NOT NULL AUTO_INCREMENT,
  `trx_kry_id` int(11) NOT NULL,
  `trx_tgl` date NOT NULL,
  PRIMARY KEY (`trx_id`),
  KEY `trx_kry_id` (`trx_kry_id`),
  CONSTRAINT `tbl_trx_ibfk_1` FOREIGN KEY (`trx_kry_id`) REFERENCES `tbl_karyawan` (`kry_id`)
) ENGINE=InnoDB AUTO_INCREMENT=3 DEFAULT CHARSET=utf8mb4;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `tbl_trx`
--

LOCK TABLES `tbl_trx` WRITE;
/*!40000 ALTER TABLE `tbl_trx` DISABLE KEYS */;
INSERT INTO `tbl_trx` VALUES (1,1,'2022-04-15'),(2,2,'2022-04-16');
/*!40000 ALTER TABLE `tbl_trx` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `tbl_trx_brg`
--

DROP TABLE IF EXISTS `tbl_trx_brg`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `tbl_trx_brg` (
  `tbr_id` int(11) NOT NULL AUTO_INCREMENT,
  `tbr_trx_transaksi` int(11) NOT NULL,
  `tbr_brg_code` int(11) NOT NULL,
  PRIMARY KEY (`tbr_id`),
  KEY `tbr_trx_transaksi` (`tbr_trx_transaksi`),
  CONSTRAINT `tbl_trx_brg_ibfk_1` FOREIGN KEY (`tbr_trx_transaksi`) REFERENCES `tbl_trx` (`trx_id`)
) ENGINE=InnoDB AUTO_INCREMENT=3 DEFAULT CHARSET=utf8mb4;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `tbl_trx_brg`
--

LOCK TABLES `tbl_trx_brg` WRITE;
/*!40000 ALTER TABLE `tbl_trx_brg` DISABLE KEYS */;
INSERT INTO `tbl_trx_brg` VALUES (1,1,80666),(2,2,88666);
/*!40000 ALTER TABLE `tbl_trx_brg` ENABLE KEYS */;
UNLOCK TABLES;
/*!40103 SET TIME_ZONE=@OLD_TIME_ZONE */;

/*!40101 SET SQL_MODE=@OLD_SQL_MODE */;
/*!40014 SET FOREIGN_KEY_CHECKS=@OLD_FOREIGN_KEY_CHECKS */;
/*!40014 SET UNIQUE_CHECKS=@OLD_UNIQUE_CHECKS */;
/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
/*!40111 SET SQL_NOTES=@OLD_SQL_NOTES */;

-- Dump completed on 2022-04-27  9:45:44
