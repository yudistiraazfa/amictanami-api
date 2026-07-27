-- MySQL dump 10.13  Distrib 8.0.30, for Win64 (x86_64)
--
-- Host: localhost    Database: tanami_android
-- ------------------------------------------------------
-- Server version	8.0.30

/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!50503 SET NAMES utf8mb4 */;
/*!40103 SET @OLD_TIME_ZONE=@@TIME_ZONE */;
/*!40103 SET TIME_ZONE='+00:00' */;
/*!40014 SET @OLD_UNIQUE_CHECKS=@@UNIQUE_CHECKS, UNIQUE_CHECKS=0 */;
/*!40014 SET @OLD_FOREIGN_KEY_CHECKS=@@FOREIGN_KEY_CHECKS, FOREIGN_KEY_CHECKS=0 */;
/*!40101 SET @OLD_SQL_MODE=@@SQL_MODE, SQL_MODE='NO_AUTO_VALUE_ON_ZERO' */;
/*!40111 SET @OLD_SQL_NOTES=@@SQL_NOTES, SQL_NOTES=0 */;

--
-- Table structure for table `activity_logs`
--

DROP TABLE IF EXISTS `activity_logs`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!50503 SET character_set_client = utf8mb4 */;
CREATE TABLE `activity_logs` (
  `id` int NOT NULL AUTO_INCREMENT,
  `user_id` int NOT NULL,
  `judul` varchar(255) NOT NULL,
  `jam` varchar(50) NOT NULL,
  `tanggal` varchar(50) NOT NULL,
  `tipe` varchar(50) NOT NULL,
  `created_at` timestamp NULL DEFAULT CURRENT_TIMESTAMP,
  PRIMARY KEY (`id`),
  KEY `user_id` (`user_id`),
  CONSTRAINT `activity_logs_ibfk_1` FOREIGN KEY (`user_id`) REFERENCES `users` (`id`) ON DELETE CASCADE
) ENGINE=InnoDB AUTO_INCREMENT=3 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_0900_ai_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `activity_logs`
--

LOCK TABLES `activity_logs` WRITE;
/*!40000 ALTER TABLE `activity_logs` DISABLE KEYS */;
INSERT INTO `activity_logs` VALUES (1,4,'Penyiraman Manual','18:44','27 Juli 2026','MANUAL','2026-07-27 11:44:18'),(2,4,'Penyiraman Manual','18:53','27 Juli 2026','MANUAL','2026-07-27 11:53:34');
/*!40000 ALTER TABLE `activity_logs` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `bibit_media`
--

DROP TABLE IF EXISTS `bibit_media`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!50503 SET character_set_client = utf8mb4 */;
CREATE TABLE `bibit_media` (
  `id` int NOT NULL AUTO_INCREMENT,
  `tanaman_id` int DEFAULT NULL,
  `jenis_bibit` varchar(100) DEFAULT NULL,
  `sumber_bibit` text,
  `jenis_media` text,
  `rasio_media` varchar(50) DEFAULT NULL,
  `drainase` text,
  `ukuran_pot` varchar(50) DEFAULT NULL,
  PRIMARY KEY (`id`),
  KEY `tanaman_id` (`tanaman_id`),
  CONSTRAINT `bibit_media_ibfk_1` FOREIGN KEY (`tanaman_id`) REFERENCES `tanaman` (`id`) ON DELETE CASCADE
) ENGINE=InnoDB AUTO_INCREMENT=9 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_0900_ai_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `bibit_media`
--

LOCK TABLES `bibit_media` WRITE;
/*!40000 ALTER TABLE `bibit_media` DISABLE KEYS */;
INSERT INTO `bibit_media` VALUES (1,1,'Biji cabai','Gunakan biji cabai dari buah matang atau bibit siap tanam','Campuran tanah subur, kompos, sekam bakar','2:1:1','Drainase baik','Diameter minimum 20-30 cm'),(2,2,'Stek batang','Stek batang mawar yang sehat','Tanah gembur, kompos, pasir','2:1:1','Drainase baik','Diameter minimum 25 cm'),(3,3,'Biji jagung','Biji jagung hibrida berkualitas','Tanah subur, pupuk kandang','3:1','Drainase sedang','Langsung di lahan'),(4,4,'Anakan anggrek','Anakan atau bibit dari induk','Media pakis, arang, sabut kelapa','1:1:1','Drainase sangat baik','Pot khusus anggrek'),(5,5,'Biji atau bibit','Biji tomat atau bibit siap tanam','Tanah subur, kompos, sekam','2:1:1','Drainase baik','Diameter 30 cm'),(6,6,'Umbi bibit','Umbi kentang dengan mata tunas','Tanah gembur, kompos','2:1','Drainase baik','Polybag besar atau lahan'),(7,7,'Biji bayam','Biji bayam berkualitas','Tanah subur, pupuk kandang','2:1','Drainase sedang','Polybag atau langsung'),(8,8,'Biji atau bibit','Biji terong atau bibit siap tanam','Tanah subur, kompos, sekam','2:1:1','Drainase baik','Diameter 25-30 cm');
/*!40000 ALTER TABLE `bibit_media` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `kategori`
--

DROP TABLE IF EXISTS `kategori`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!50503 SET character_set_client = utf8mb4 */;
CREATE TABLE `kategori` (
  `id` int NOT NULL AUTO_INCREMENT,
  `nama_kategori` varchar(50) NOT NULL,
  `deskripsi` text,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=5 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_0900_ai_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `kategori`
--

LOCK TABLES `kategori` WRITE;
/*!40000 ALTER TABLE `kategori` DISABLE KEYS */;
INSERT INTO `kategori` VALUES (1,'Sayuran','Tanaman sayur-sayuran untuk konsumsi'),(2,'Tanaman Hias','Tanaman untuk dekorasi dan keindahan'),(3,'Buah','Tanaman buah-buahan'),(4,'Herbal','Tanaman obat dan rempah');
/*!40000 ALTER TABLE `kategori` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `log_aktivitas`
--

DROP TABLE IF EXISTS `log_aktivitas`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!50503 SET character_set_client = utf8mb4 */;
CREATE TABLE `log_aktivitas` (
  `id` int NOT NULL AUTO_INCREMENT,
  `user_id` int DEFAULT NULL,
  `aksi` varchar(255) NOT NULL,
  `keterangan` text,
  `created_at` timestamp NULL DEFAULT CURRENT_TIMESTAMP,
  PRIMARY KEY (`id`),
  KEY `user_id` (`user_id`),
  CONSTRAINT `log_aktivitas_ibfk_1` FOREIGN KEY (`user_id`) REFERENCES `users` (`id`) ON DELETE CASCADE
) ENGINE=InnoDB AUTO_INCREMENT=5 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_0900_ai_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `log_aktivitas`
--

LOCK TABLES `log_aktivitas` WRITE;
/*!40000 ALTER TABLE `log_aktivitas` DISABLE KEYS */;
INSERT INTO `log_aktivitas` VALUES (4,4,'Buka Halaman Log','Uji coba koneksi laravel ke android','2026-07-23 22:26:59');
/*!40000 ALTER TABLE `log_aktivitas` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `masa_panen`
--

DROP TABLE IF EXISTS `masa_panen`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!50503 SET character_set_client = utf8mb4 */;
CREATE TABLE `masa_panen` (
  `id` int NOT NULL AUTO_INCREMENT,
  `tanaman_id` int DEFAULT NULL,
  `durasi_tanam` varchar(100) DEFAULT NULL,
  `ciri_siap_panen` text,
  `cara_panen` text,
  `frekuensi_panen` varchar(100) DEFAULT NULL,
  `hasil_panen` varchar(100) DEFAULT NULL,
  PRIMARY KEY (`id`),
  KEY `tanaman_id` (`tanaman_id`),
  CONSTRAINT `masa_panen_ibfk_1` FOREIGN KEY (`tanaman_id`) REFERENCES `tanaman` (`id`) ON DELETE CASCADE
) ENGINE=InnoDB AUTO_INCREMENT=9 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_0900_ai_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `masa_panen`
--

LOCK TABLES `masa_panen` WRITE;
/*!40000 ALTER TABLE `masa_panen` DISABLE KEYS */;
INSERT INTO `masa_panen` VALUES (1,1,'90-120 hari setelah tanam','Cabai berwarna merah penuh dan keras','Petik dengan tangkai menggunakan gunting atau tangan','Dapat dipanen berkali-kali setiap 3-5 hari','Bervariasi tergantung perawatan'),(2,2,'60-90 hari setelah tanam','Kuncup bunga mekar sempurna','Potong dengan gunting di pagi hari','Terus menerus saat berbunga','Tergantung ukuran tanaman'),(3,3,'90-120 hari','Tongkol berwarna cokelat, biji keras','Patahkan tongkol dari batang','Sekali panen','2-3 tongkol per tanaman'),(4,4,'6-12 bulan (tergantung jenis)','Bunga mekar sempurna','Potong tangkai bunga dengan gunting steril','Sesuai masa berbunga','Tergantung jenis'),(5,5,'60-90 hari','Buah berwarna merah penuh','Petik dengan memutar buah','Berkala setiap 3-5 hari','2-5 kg per tanaman'),(6,6,'90-120 hari','Daun mulai menguning dan layu','Gali umbi dengan hati-hati','Sekali panen','0.5-1 kg per tanaman'),(7,7,'30-45 hari','Daun cukup lebat','Petik daun atau cabut seluruh tanaman','Bisa beberapa kali','Tergantung cara panen'),(8,8,'70-90 hari','Buah ukuran penuh dengan warna mengkilap','Potong dengan gunting beserta tangkainya','Berkala setiap 3-5 hari','3-5 buah per tanaman per panen');
/*!40000 ALTER TABLE `masa_panen` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `password_resets`
--

DROP TABLE IF EXISTS `password_resets`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!50503 SET character_set_client = utf8mb4 */;
CREATE TABLE `password_resets` (
  `id` int NOT NULL AUTO_INCREMENT,
  `email` varchar(150) NOT NULL,
  `code` varchar(6) NOT NULL,
  `reset_token` varchar(255) DEFAULT NULL,
  `is_verified` tinyint(1) DEFAULT '0',
  `expires_at` timestamp NOT NULL,
  `created_at` timestamp NULL DEFAULT CURRENT_TIMESTAMP,
  PRIMARY KEY (`id`),
  KEY `email` (`email`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_0900_ai_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `password_resets`
--

LOCK TABLES `password_resets` WRITE;
/*!40000 ALTER TABLE `password_resets` DISABLE KEYS */;
/*!40000 ALTER TABLE `password_resets` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `pemupukan`
--

DROP TABLE IF EXISTS `pemupukan`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!50503 SET character_set_client = utf8mb4 */;
CREATE TABLE `pemupukan` (
  `id` int NOT NULL AUTO_INCREMENT,
  `tanaman_id` int DEFAULT NULL,
  `jenis_pupuk` varchar(100) DEFAULT NULL,
  `dosis` varchar(100) DEFAULT NULL,
  `frekuensi` varchar(100) DEFAULT NULL,
  `cara_aplikasi` text,
  `catatan` text,
  PRIMARY KEY (`id`),
  KEY `tanaman_id` (`tanaman_id`),
  CONSTRAINT `pemupukan_ibfk_1` FOREIGN KEY (`tanaman_id`) REFERENCES `tanaman` (`id`) ON DELETE CASCADE
) ENGINE=InnoDB AUTO_INCREMENT=10 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_0900_ai_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `pemupukan`
--

LOCK TABLES `pemupukan` WRITE;
/*!40000 ALTER TABLE `pemupukan` DISABLE KEYS */;
INSERT INTO `pemupukan` VALUES (1,1,'Pupuk kandang/kompos','Secukupnya sebagai dasar','Saat penanaman','Campur dengan media tanam','Tambahkan pupuk NPK saat berbunga'),(2,1,'NPK','1 sendok makan per tanaman','Setiap 2-3 minggu','Taburkan di sekitar tanaman','Untuk meningkatkan produktivitas buah'),(3,2,'Pupuk kandang','Secukupnya','Setiap 1 bulan','Campur dengan tanah di sekitar pangkal','Gunakan pupuk organik'),(4,3,'Pupuk kandang','2-3 kg per m2','Saat pengolahan lahan','Campurkan ke tanah','Tambah NPK saat tanaman berumur 3-4 minggu'),(5,4,'Pupuk NPK khusus anggrek','Sesuai petunjuk kemasan','Setiap 2 minggu','Semprotkan pada akar dan daun','Gunakan dosis rendah'),(6,5,'Pupuk kandang/kompos','Secukupnya','Saat penanaman','Campur dengan media','NPK setiap 2-3 minggu setelah tanam'),(7,6,'Pupuk kandang','2-3 kg per m2','Saat pengolahan lahan','Aduk rata dengan tanah','Tambah NPK saat tanaman tumbuh'),(8,7,'Pupuk kompos','Secukupnya','Setiap 2 minggu','Taburkan di sekitar tanaman','Bisa dengan pupuk cair'),(9,8,'Pupuk kandang','Secukupnya','Saat penanaman','Campur dengan media','NPK setiap 2-3 minggu');
/*!40000 ALTER TABLE `pemupukan` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `penyiraman`
--

DROP TABLE IF EXISTS `penyiraman`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!50503 SET character_set_client = utf8mb4 */;
CREATE TABLE `penyiraman` (
  `id` int NOT NULL AUTO_INCREMENT,
  `tanaman_id` int DEFAULT NULL,
  `frekuensi` varchar(100) DEFAULT NULL,
  `waktu_penyiraman` varchar(100) DEFAULT NULL,
  `cara_penyiraman` text,
  `kondisi_khusus` text,
  PRIMARY KEY (`id`),
  KEY `tanaman_id` (`tanaman_id`),
  CONSTRAINT `penyiraman_ibfk_1` FOREIGN KEY (`tanaman_id`) REFERENCES `tanaman` (`id`) ON DELETE CASCADE
) ENGINE=InnoDB AUTO_INCREMENT=9 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_0900_ai_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `penyiraman`
--

LOCK TABLES `penyiraman` WRITE;
/*!40000 ALTER TABLE `penyiraman` DISABLE KEYS */;
INSERT INTO `penyiraman` VALUES (1,1,'1-2 kali sehari saat media kering','Siram secukupnya','Siram pada bagian tanah, hindari genangan','Kurangi saat musim hujan'),(2,2,'1 kali sehari','Pagi atau sore hari','Siram pada media tanam, jangan sampai menggenang','Perhatikan kelembaban udara'),(3,3,'2-3 kali seminggu','Pagi hari','Siram merata pada area tanam','Butuh air lebih saat fase pembungaan'),(4,4,'2-3 kali seminggu','Pagi hari dengan semprotan halus','Semprot pada akar dan media','Hindari air berlebih pada daun'),(5,5,'1-2 kali sehari','Pagi dan sore','Siram merata pada tanah','Jaga kelembaban tanah'),(6,6,'Sesuai kebutuhan','Pagi hari','Siram saat tanah mulai kering','Hindari genangan air'),(7,7,'1-2 kali sehari','Pagi dan sore','Siram dengan gembor halus','Jaga tanah tetap lembab'),(8,8,'1-2 kali sehari','Pagi dan sore','Siram merata pada area perakaran','Kurangi saat mendekati panen');
/*!40000 ALTER TABLE `penyiraman` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `perawatan`
--

DROP TABLE IF EXISTS `perawatan`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!50503 SET character_set_client = utf8mb4 */;
CREATE TABLE `perawatan` (
  `id` int NOT NULL AUTO_INCREMENT,
  `tanaman_id` int DEFAULT NULL,
  `jenis_perawatan` varchar(100) DEFAULT NULL,
  `frekuensi` varchar(100) DEFAULT NULL,
  `cara_perawatan` text,
  `waktu_pelaksanaan` varchar(100) DEFAULT NULL,
  `peralatan` text,
  PRIMARY KEY (`id`),
  KEY `tanaman_id` (`tanaman_id`),
  CONSTRAINT `perawatan_ibfk_1` FOREIGN KEY (`tanaman_id`) REFERENCES `tanaman` (`id`) ON DELETE CASCADE
) ENGINE=InnoDB AUTO_INCREMENT=11 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_0900_ai_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `perawatan`
--

LOCK TABLES `perawatan` WRITE;
/*!40000 ALTER TABLE `perawatan` DISABLE KEYS */;
INSERT INTO `perawatan` VALUES (1,1,'Penyiangan gulma','Sesuai kebutuhan','Cabut gulma yang tumbuh di sekitar tanaman','Kapan saja saat ada gulma','Tangan atau cangkul kecil'),(2,1,'Pemangkasan','Saat diperlukan','Pangkas daun tua atau cabang tidak produktif','Saat tanaman dewasa','Gunting tanaman'),(3,2,'Pemangkasan','Rutin','Pangkas daun kering dan ranting mati','Setiap 2-3 minggu','Gunting stek steril'),(4,2,'Pengendalian hama','Saat terlihat hama','Semprotkan pestisida organik','Pagi atau sore hari','Sprayer'),(5,3,'Pembumbunan','2 kali','Timbun pangkal batang dengan tanah','Umur 3-4 minggu dan 6-7 minggu','Cangkul'),(6,4,'Pemangkasan akar udara','Sesuai kebutuhan','Pangkas akar udara yang rusak','Kapan saja','Gunting steril'),(7,5,'Pewiwilan','Rutin','Buang tunas air di ketiak daun','Setiap minggu','Tangan atau gunting'),(8,6,'Pembumbunan','1-2 kali','Timbun pangkal batang','Saat tanaman 30-40 hari','Cangkul kecil'),(9,7,'Penyiangan','Sesuai kebutuhan','Cabut gulma di sekitar tanaman','Kapan saja','Tangan'),(10,8,'Pemangkasan','Saat perlu','Pangkas tunas air dan daun tua','Setiap 2 minggu','Gunting tanaman');
/*!40000 ALTER TABLE `perawatan` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `tanaman`
--

DROP TABLE IF EXISTS `tanaman`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!50503 SET character_set_client = utf8mb4 */;
CREATE TABLE `tanaman` (
  `id` int NOT NULL AUTO_INCREMENT,
  `nama_umum` varchar(100) NOT NULL,
  `nama_latin` varchar(150) DEFAULT NULL,
  `deskripsi` text,
  `gambar_url` varchar(255) DEFAULT NULL,
  `kategori_id` int DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT CURRENT_TIMESTAMP,
  `updated_at` timestamp NULL DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP,
  PRIMARY KEY (`id`),
  KEY `kategori_id` (`kategori_id`),
  CONSTRAINT `tanaman_ibfk_1` FOREIGN KEY (`kategori_id`) REFERENCES `kategori` (`id`) ON DELETE SET NULL
) ENGINE=InnoDB AUTO_INCREMENT=9 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_0900_ai_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `tanaman`
--

LOCK TABLES `tanaman` WRITE;
/*!40000 ALTER TABLE `tanaman` DISABLE KEYS */;
INSERT INTO `tanaman` VALUES (1,'Cabai','Capsicum annum','Tanaman cabai merah yang populer untuk bumbu masakan Indonesia','images/cabai.jpg',1,'2025-10-19 12:09:33','2025-11-02 22:07:47'),(2,'Mawar','Rosa villosa','Bunga mawar merah yang cantik untuk taman','images/mawar.jpg',2,'2025-10-19 12:09:33','2025-11-02 22:07:50'),(3,'Jagung','Zea mays','Tanaman jagung untuk pangan dan pakan ternak','images/jagung.jpg',1,'2025-10-19 12:09:33','2025-11-02 22:07:51'),(4,'Anggrek','Orchidaceae','Tanaman hias anggrek dengan bunga cantik','images/anggrek.jpg',2,'2025-10-19 12:09:33','2025-11-02 22:07:52'),(5,'Tomat','Solanum lycopersicum','Tanaman tomat untuk sayuran dan bumbu','images/tomat.jpg',1,'2025-10-19 12:09:33','2025-11-02 22:07:49'),(6,'Kentang','Solanum tuberosum','Tanaman umbi kentang untuk konsumsi','images/kentang.jpg',1,'2025-10-19 12:09:33','2025-11-02 22:08:05'),(7,'Bayam','Amaranthus sp.','Sayuran hijau kaya nutrisi','images/bayam.jpg',1,'2025-10-19 12:09:33','2025-11-02 22:07:53'),(8,'Terong Ungu','Solanum melongena L','Sayuran terong berwarna ungu','images/terong.jpg',1,'2025-10-19 12:09:33','2025-11-02 22:07:53');
/*!40000 ALTER TABLE `tanaman` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `tanamcare_history`
--

DROP TABLE IF EXISTS `tanamcare_history`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!50503 SET character_set_client = utf8mb4 */;
CREATE TABLE `tanamcare_history` (
  `id` int NOT NULL AUTO_INCREMENT,
  `user_id` int NOT NULL,
  `title` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `date` varchar(50) COLLATE utf8mb4_unicode_ci NOT NULL,
  `explanation` text COLLATE utf8mb4_unicode_ci NOT NULL,
  `solution` text COLLATE utf8mb4_unicode_ci NOT NULL,
  `created_at` timestamp NULL DEFAULT CURRENT_TIMESTAMP,
  `image_path` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  PRIMARY KEY (`id`),
  KEY `user_id` (`user_id`),
  CONSTRAINT `tanamcare_history_ibfk_1` FOREIGN KEY (`user_id`) REFERENCES `users` (`id`) ON DELETE CASCADE
) ENGINE=InnoDB AUTO_INCREMENT=2 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `tanamcare_history`
--

LOCK TABLES `tanamcare_history` WRITE;
/*!40000 ALTER TABLE `tanamcare_history` DISABLE KEYS */;
INSERT INTO `tanamcare_history` VALUES (1,4,'Hama Pengunyah Daun 🐛🌿','2026-07-27 13:39:39','Wah, daun tanaman kesayanganmu ini kayaknya lagi jadi santapan lezat para tamu tak diundang nih! 🙈 Lihat deh, banyak lubang-lubang bolong dan gerigi di daunnya? Itu tandanya ada hama-hama kecil seperti ulat, belalang, atau siput yang lagi asyik berpesta pora mengunyah daun-daunmu. Mereka memang suka banget bikin \"ukiran\" di daun, hihi! Tapi tenang, Tanamin siap bantu! 💪','1.  Detektif Daun 🕵️‍♀️: Coba cek di pagi atau sore hari, terutama di balik daun atau batang. Cari tahu siapa pelakunya! Kalau ketemu ulat atau belalang yang gede, langsung tangkap dan pindahkan jauh-jauh ya (atau kasih ke ayam kalau ada, hehe)! 🐔\n2.  Ramuan Ajaib Alami ✨: Kalau hamanya banyak atau kecil-kecil, kamu bisa bikin semprotan air sabun (campur beberapa tetes sabun cuci piring ke sebotol air) atau semprotan minyak nimba (neem oil) yang ramah lingkungan. Semprotkan ke daun yang terserang, terutama bagian bawahnya. Lakukan di pagi atau sore hari saat matahari tidak terlalu terik.\n3.  Jaga Kebersihan Lingkungan 🧹: Pastikan area sekitar tanaman bersih dari gulma atau dedaunan kering yang bisa jadi tempat persembunyian hama. Rutin periksa tanamanmu biar kalau ada gejala awal bisa langsung ditangani! 😊\n\nSemangat berkebun terus ya, Tanamin yakin tanamanmu pasti bisa pulih lagi ceria seperti sedia kala! 🌱💚','2026-07-27 13:39:39','uploads/tanamcare/6a675f9b7118e.jpg');
/*!40000 ALTER TABLE `tanamcare_history` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `users`
--

DROP TABLE IF EXISTS `users`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!50503 SET character_set_client = utf8mb4 */;
CREATE TABLE `users` (
  `id` int NOT NULL AUTO_INCREMENT,
  `nama` varchar(100) NOT NULL,
  `email` varchar(150) NOT NULL,
  `password` varchar(255) NOT NULL,
  `token` varchar(255) DEFAULT NULL,
  `email_verified_at` timestamp NULL DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT CURRENT_TIMESTAMP,
  `updated_at` timestamp NULL DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP,
  PRIMARY KEY (`id`),
  UNIQUE KEY `email` (`email`)
) ENGINE=InnoDB AUTO_INCREMENT=7 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_0900_ai_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `users`
--

LOCK TABLES `users` WRITE;
/*!40000 ALTER TABLE `users` DISABLE KEYS */;
INSERT INTO `users` VALUES (1,'Bos Tani','tanami@bt.com','$2y$12$nMtafcFo2pzjfLZwNrVOROb..zDbtwevc3USMuBG/QgMOI/N6/0jW',NULL,'2026-01-15 00:00:00','2026-01-15 00:00:00','2026-07-23 23:09:21'),(2,'Admin Tanami','admin@tanami.id','$2y$10$92IXUNpkjO0rOQ5byMi.Ye4oKoEa3Ro9llC/.og/at2.uheWG/igi',NULL,'2026-01-15 00:00:00','2026-01-15 00:00:00','2026-01-15 00:00:00'),(3,'Test User 2','test2@example.com','$2y$10$iFIdaDE2zznyiPbjMsud5.6Jldh1zytYC1TYZAKH9V0P3Dvk7SjPy',NULL,NULL,'2026-01-15 13:55:58','2026-01-15 13:55:58'),(4,'Bos','tanami@bos.com','$2y$10$yqecwxHFGP7kZ8dGzjTpNOxYA94QgWQCjDIhw7CDfFcWz6gP.lTDy',NULL,NULL,'2026-01-15 14:02:52','2026-07-27 11:20:25'),(5,'Aliev','aliev@pengguna.com','$2y$10$T/9nVicOnq0oIWkpKPk/4u0rbhj8X9MQAmg.jjmKnyJ8Z.bHi3UOW',NULL,NULL,'2026-01-15 14:09:37','2026-01-15 14:09:37'),(6,'joya perdana','joya@dev.id','$2y$10$iVsJ9ojSuLU6nHSt9jINQO5AIVOn4BhiklvtE1ovdogP0W24JsVTS',NULL,NULL,'2026-06-28 02:49:25','2026-06-28 02:49:25');
/*!40000 ALTER TABLE `users` ENABLE KEYS */;
UNLOCK TABLES;
/*!40103 SET TIME_ZONE=@OLD_TIME_ZONE */;

/*!40101 SET SQL_MODE=@OLD_SQL_MODE */;
/*!40014 SET FOREIGN_KEY_CHECKS=@OLD_FOREIGN_KEY_CHECKS */;
/*!40014 SET UNIQUE_CHECKS=@OLD_UNIQUE_CHECKS */;
/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
/*!40111 SET SQL_NOTES=@OLD_SQL_NOTES */;

-- Dump completed on 2026-07-27 20:44:07
