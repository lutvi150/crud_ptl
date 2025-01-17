-- --------------------------------------------------------
-- Host:                         127.0.0.1
-- Server version:               5.7.24 - MySQL Community Server (GPL)
-- Server OS:                    Win64
-- HeidiSQL Version:             12.8.0.6935
-- --------------------------------------------------------

/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET NAMES utf8 */;
/*!50503 SET NAMES utf8mb4 */;
/*!40103 SET @OLD_TIME_ZONE=@@TIME_ZONE */;
/*!40103 SET TIME_ZONE='+00:00' */;
/*!40014 SET @OLD_FOREIGN_KEY_CHECKS=@@FOREIGN_KEY_CHECKS, FOREIGN_KEY_CHECKS=0 */;
/*!40101 SET @OLD_SQL_MODE=@@SQL_MODE, SQL_MODE='NO_AUTO_VALUE_ON_ZERO' */;
/*!40111 SET @OLD_SQL_NOTES=@@SQL_NOTES, SQL_NOTES=0 */;

-- Dumping structure for table reservasi_hotel.cache
CREATE TABLE IF NOT EXISTS `cache` (
  `key` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `value` mediumtext COLLATE utf8mb4_unicode_ci NOT NULL,
  `expiration` int(11) NOT NULL,
  PRIMARY KEY (`key`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- Dumping data for table reservasi_hotel.cache: ~0 rows (approximately)

-- Dumping structure for table reservasi_hotel.cache_locks
CREATE TABLE IF NOT EXISTS `cache_locks` (
  `key` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `owner` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `expiration` int(11) NOT NULL,
  PRIMARY KEY (`key`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- Dumping data for table reservasi_hotel.cache_locks: ~0 rows (approximately)

-- Dumping structure for table reservasi_hotel.categories
CREATE TABLE IF NOT EXISTS `categories` (
  `id` bigint(20) unsigned NOT NULL AUTO_INCREMENT,
  `name` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `description` text COLLATE utf8mb4_unicode_ci NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=3 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- Dumping data for table reservasi_hotel.categories: ~2 rows (approximately)
INSERT INTO `categories` (`id`, `name`, `description`, `created_at`, `updated_at`) VALUES
	(1, 'Kategori 1', 'Kategori 1', '2024-12-24 09:24:59', '2024-12-24 09:24:59'),
	(2, 'Kategori 2', 'Kategori 2', '2024-12-24 09:25:10', '2024-12-24 09:25:10');

-- Dumping structure for table reservasi_hotel.customers
CREATE TABLE IF NOT EXISTS `customers` (
  `id` bigint(20) unsigned NOT NULL AUTO_INCREMENT,
  `name` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `email` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `phone` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `address` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  PRIMARY KEY (`id`),
  UNIQUE KEY `customers_email_unique` (`email`)
) ENGINE=InnoDB AUTO_INCREMENT=5 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- Dumping data for table reservasi_hotel.customers: ~0 rows (approximately)
INSERT INTO `customers` (`id`, `name`, `email`, `phone`, `address`, `created_at`, `updated_at`) VALUES
	(1, 'Ani', 'ani@gmail.com', '082285498005', 'padang', '2024-12-24 09:38:03', '2024-12-24 09:38:03'),
	(2, 'budi', 'budi@gmail.com', '082285498005', 'padang', '2024-12-24 09:38:31', '2024-12-24 09:38:31');

-- Dumping structure for table reservasi_hotel.failed_jobs
CREATE TABLE IF NOT EXISTS `failed_jobs` (
  `id` bigint(20) unsigned NOT NULL AUTO_INCREMENT,
  `uuid` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `connection` text COLLATE utf8mb4_unicode_ci NOT NULL,
  `queue` text COLLATE utf8mb4_unicode_ci NOT NULL,
  `payload` longtext COLLATE utf8mb4_unicode_ci NOT NULL,
  `exception` longtext COLLATE utf8mb4_unicode_ci NOT NULL,
  `failed_at` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP,
  PRIMARY KEY (`id`),
  UNIQUE KEY `failed_jobs_uuid_unique` (`uuid`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- Dumping data for table reservasi_hotel.failed_jobs: ~0 rows (approximately)

-- Dumping structure for table reservasi_hotel.jobs
CREATE TABLE IF NOT EXISTS `jobs` (
  `id` bigint(20) unsigned NOT NULL AUTO_INCREMENT,
  `queue` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `payload` longtext COLLATE utf8mb4_unicode_ci NOT NULL,
  `attempts` tinyint(3) unsigned NOT NULL,
  `reserved_at` int(10) unsigned DEFAULT NULL,
  `available_at` int(10) unsigned NOT NULL,
  `created_at` int(10) unsigned NOT NULL,
  PRIMARY KEY (`id`),
  KEY `jobs_queue_index` (`queue`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- Dumping data for table reservasi_hotel.jobs: ~0 rows (approximately)

-- Dumping structure for table reservasi_hotel.job_batches
CREATE TABLE IF NOT EXISTS `job_batches` (
  `id` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `name` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `total_jobs` int(11) NOT NULL,
  `pending_jobs` int(11) NOT NULL,
  `failed_jobs` int(11) NOT NULL,
  `failed_job_ids` longtext COLLATE utf8mb4_unicode_ci NOT NULL,
  `options` mediumtext COLLATE utf8mb4_unicode_ci,
  `cancelled_at` int(11) DEFAULT NULL,
  `created_at` int(11) NOT NULL,
  `finished_at` int(11) DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- Dumping data for table reservasi_hotel.job_batches: ~0 rows (approximately)

-- Dumping structure for table reservasi_hotel.log_database
CREATE TABLE IF NOT EXISTS `log_database` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `aktivitas` varchar(250) DEFAULT NULL,
  `nama_tabel` varchar(250) DEFAULT NULL,
  `data_sebelum` text,
  `data_sesudah` text,
  `waktu` datetime DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=38 DEFAULT CHARSET=latin1;

-- Dumping data for table reservasi_hotel.log_database: ~36 rows (approximately)
INSERT INTO `log_database` (`id`, `aktivitas`, `nama_tabel`, `data_sebelum`, `data_sesudah`, `waktu`) VALUES
	(1, 'Tambah Data', 'table_kamar', NULL, '{"id_kamar": 5, "fasilitas": "Kamar Mandi di luar", "nama_kamar": "Kamar XL"}', '2024-12-05 20:43:05'),
	(2, 'Update Data', 'table_kamar', '{"id_kamar": 5, "fasilitas": "Kamar Mandi di luar", "nama_kamar": "Kamar XL"}', '{"id_kamar": 5, "fasilitas": "Kamar Mandi di luar dan di dalam", "nama_kamar": "Kamar XL"}', '2024-12-05 20:43:17'),
	(3, 'Tambah Data', 'table_tamu', NULL, '{"tgl_in": "2024-12-04", "id_tamu": 5, "tgl_out": "2024-12-05", "id_kamar": 5, "nama_tamu": "Budi Chen", "nomor_kontak": "082285498005"}', '2024-12-05 20:50:49'),
	(4, 'Update Data', 'table_tamu', '{"tgl_in": "2024-12-04", "id_tamu": 5, "tgl_out": "2024-12-05", "id_kamar": 5, "nama_tamu": "Budi Chen", "nomor_kontak": "082285498005"}', '{"tgl_in": "2024-12-04", "id_tamu": 5, "tgl_out": "2024-12-05", "id_kamar": 5, "nama_tamu": "Budi Chen KL", "nomor_kontak": "082285498005"}', '2024-12-05 20:50:57'),
	(5, 'Tambah Data', 'table_transaksi', NULL, '{"id_tamu": 5, "total_harga": 800000, "id_transaksi": 5, "lama_menginap": 1}', '2024-12-05 20:51:42'),
	(6, 'Update Data', 'table_transaksi', '{"id_tamu": 5, "total_harga": 800000, "id_transaksi": 5, "lama_menginap": 1}', '{"id_tamu": 5, "total_harga": 1600000, "id_transaksi": 5, "lama_menginap": 2}', '2024-12-05 20:51:51'),
	(8, 'Tambah Data', 'table_tamu', NULL, '{"tgl_in": "2024-12-03", "id_tamu": 7, "tgl_out": "2024-12-05", "id_kamar": 2, "nama_tamu": "Agus ", "nomor_kontak": "082285498003"}', '2024-12-05 21:06:16'),
	(9, 'Tambah Data', 'table_transaksi', NULL, '{"id_tamu": 7, "total_harga": 2, "id_transaksi": 6, "lama_menginap": 2}', '2024-12-05 21:06:16'),
	(10, 'Update Data', 'table_transaksi', '{"id_tamu": 7, "total_harga": 2, "id_transaksi": 6, "lama_menginap": 2}', '{"id_tamu": 7, "total_harga": 1110000, "id_transaksi": 6, "lama_menginap": 2}', '2024-12-05 21:07:33'),
	(11, 'Tambah Data', 'table_tamu', NULL, '{"tgl_in": "2024-12-02", "id_tamu": 8, "tgl_out": "2024-12-05", "id_kamar": 5, "nama_tamu": "Gusyono", "nomor_kontak": "082285498005"}', '2024-12-05 21:08:35'),
	(12, 'Tambah Data', 'table_transaksi', NULL, '{"id_tamu": 8, "total_harga": 1800000, "id_transaksi": 7, "lama_menginap": 3}', '2024-12-05 21:08:35'),
	(13, 'Tambah Data', 'table_kamar', NULL, '{"id_kamar": 6, "fasilitas": "Kamar mandi di luar", "nama_kamar": "Kamar tes 1"}', '2024-12-17 00:49:55'),
	(14, 'Tambah Data', 'table_kamar', NULL, '{"id_kamar": 7, "fasilitas": "Tidur di luar", "nama_kamar": "Kamar Tes 3"}', '2024-12-17 00:52:18'),
	(15, 'Update Data', 'table_kamar', '{"id_kamar": 7, "fasilitas": "Tidur di luar", "nama_kamar": "Kamar Tes 3"}', '{"id_kamar": 7, "fasilitas": "Tidur di luar", "nama_kamar": "Kamar Tes 3"}', '2024-12-17 01:02:09'),
	(16, 'Update Data', 'table_kamar', '{"id_kamar": 7, "fasilitas": "Tidur di luar", "nama_kamar": "Kamar Tes 3"}', '{"id_kamar": 7, "fasilitas": "Tidur di luar setengah jam", "nama_kamar": "Kamar Tes 3"}', '2024-12-17 01:02:18'),
	(17, 'Tambah Data', 'table_kamar', NULL, '{"id_kamar": 8, "fasilitas": "makan menyusul", "nama_kamar": "tes hapus data"}', '2024-12-17 01:04:04'),
	(18, 'Tambah Data', 'table_tamu', NULL, '{"tgl_in": "2024-12-15", "id_tamu": 9, "tgl_out": "2024-12-20", "id_kamar": 2, "nama_tamu": "Nana Mayuri", "nomor_kontak": "082285498005"}', '2024-12-17 01:44:09'),
	(19, 'Tambah Data', 'table_transaksi', NULL, '{"id_tamu": 9, "total_harga": 2750000, "id_transaksi": 8, "lama_menginap": 5}', '2024-12-17 01:44:09'),
	(20, 'Update Data', 'table_tamu', '{"tgl_in": "2024-12-15", "id_tamu": 9, "tgl_out": "2024-12-20", "id_kamar": 2, "nama_tamu": "Nana Mayuri", "nomor_kontak": "082285498005"}', '{"tgl_in": "2024-12-15", "id_tamu": 9, "tgl_out": "2024-12-20", "id_kamar": 2, "nama_tamu": "Nana Mayuri Lala", "nomor_kontak": "082285498005"}', '2024-12-17 01:57:16'),
	(21, 'Update Data', 'table_tamu', '{"tgl_in": "2024-12-15", "id_tamu": 9, "tgl_out": "2024-12-20", "id_kamar": 2, "nama_tamu": "Nana Mayuri Lala", "nomor_kontak": "082285498005"}', '{"tgl_in": "2024-12-15", "id_tamu": 9, "tgl_out": "2024-12-20", "id_kamar": 9, "nama_tamu": "Nana Mayuri Lala", "nomor_kontak": "082285498005"}', '2024-12-17 02:10:00'),
	(22, 'Update Data', 'table_tamu', '{"tgl_in": "2024-12-02", "id_tamu": 8, "tgl_out": "2024-12-05", "id_kamar": 5, "nama_tamu": "Gusyono", "nomor_kontak": "082285498005"}', '{"tgl_in": "2024-12-02", "id_tamu": 8, "tgl_out": "2024-12-05", "id_kamar": 8, "nama_tamu": "Gusyono", "nomor_kontak": "082285498005"}', '2024-12-17 02:10:15'),
	(23, 'Update Data', 'table_tamu', '{"tgl_in": "2024-12-03", "id_tamu": 7, "tgl_out": "2024-12-05", "id_kamar": 2, "nama_tamu": "Agus ", "nomor_kontak": "082285498003"}', '{"tgl_in": "2024-12-03", "id_tamu": 7, "tgl_out": "2024-12-05", "id_kamar": 7, "nama_tamu": "Agus ", "nomor_kontak": "082285498003"}', '2024-12-17 02:10:35'),
	(24, 'Update Data', 'table_tamu', '{"tgl_in": "2024-12-03", "id_tamu": 7, "tgl_out": "2024-12-05", "id_kamar": 7, "nama_tamu": "Agus ", "nomor_kontak": "082285498003"}', '{"tgl_in": "2024-12-03", "id_tamu": 7, "tgl_out": "2024-12-05", "id_kamar": 7, "nama_tamu": "Agus ", "nomor_kontak": "082285498003"}', '2024-12-17 02:11:03'),
	(25, 'Update Data', 'table_tamu', '{"tgl_in": "2024-12-03", "id_tamu": 7, "tgl_out": "2024-12-05", "id_kamar": 7, "nama_tamu": "Agus ", "nomor_kontak": "082285498003"}', '{"tgl_in": "2024-12-03", "id_tamu": 7, "tgl_out": "2024-12-20", "id_kamar": 7, "nama_tamu": "Agus ", "nomor_kontak": "082285498003"}', '2024-12-17 02:11:25'),
	(26, 'Update Data', 'table_tamu', '{"tgl_in": "2024-12-02", "id_tamu": 8, "tgl_out": "2024-12-05", "id_kamar": 8, "nama_tamu": "Gusyono", "nomor_kontak": "082285498005"}', '{"tgl_in": "2024-12-02", "id_tamu": 8, "tgl_out": "2024-12-05", "id_kamar": 6, "nama_tamu": "Gusyono", "nomor_kontak": "082285498005"}', '2024-12-17 02:12:35'),
	(27, 'Update Data', 'table_tamu', '{"tgl_in": "2024-12-15", "id_tamu": 9, "tgl_out": "2024-12-20", "id_kamar": 9, "nama_tamu": "Nana Mayuri Lala", "nomor_kontak": "082285498005"}', '{"tgl_in": "2024-12-15", "id_tamu": 9, "tgl_out": "2024-12-20", "id_kamar": 7, "nama_tamu": "Nana Mayuri Lala", "nomor_kontak": "082285498005"}', '2024-12-17 02:12:38'),
	(28, 'Update Data', 'table_tamu', '{"tgl_in": "2024-12-15", "id_tamu": 9, "tgl_out": "2024-12-20", "id_kamar": 7, "nama_tamu": "Nana Mayuri Lala", "nomor_kontak": "082285498005"}', '{"tgl_in": "2024-12-15", "id_tamu": 9, "tgl_out": "2024-12-20", "id_kamar": 9, "nama_tamu": "Nana Mayuri Lala", "nomor_kontak": "082285498005"}', '2024-12-17 02:12:48'),
	(29, 'Update Data', 'table_tamu', '{"tgl_in": "2024-12-02", "id_tamu": 8, "tgl_out": "2024-12-05", "id_kamar": 6, "nama_tamu": "Gusyono", "nomor_kontak": "082285498005"}', '{"tgl_in": "2024-12-02", "id_tamu": 8, "tgl_out": "2024-12-05", "id_kamar": 8, "nama_tamu": "Gusyono", "nomor_kontak": "082285498005"}', '2024-12-17 02:13:43'),
	(30, 'Update Data', 'table_tamu', '{"tgl_in": "2024-12-15", "id_tamu": 9, "tgl_out": "2024-12-20", "id_kamar": 9, "nama_tamu": "Nana Mayuri Lala", "nomor_kontak": "082285498005"}', '{"tgl_in": "2024-12-15", "id_tamu": 9, "tgl_out": "2024-12-20", "id_kamar": 5, "nama_tamu": "Nana Mayuri Lala", "nomor_kontak": "082285498005"}', '2024-12-17 02:14:39'),
	(31, 'Update Data', 'table_tamu', '{"tgl_in": "2024-12-02", "id_tamu": 8, "tgl_out": "2024-12-05", "id_kamar": 8, "nama_tamu": "Gusyono", "nomor_kontak": "082285498005"}', '{"tgl_in": "2024-12-02", "id_tamu": 8, "tgl_out": "2024-12-05", "id_kamar": 5, "nama_tamu": "Gusyono", "nomor_kontak": "082285498005"}', '2024-12-17 02:14:41'),
	(32, 'Update Data', 'table_tamu', '{"tgl_in": "2024-12-15", "id_tamu": 9, "tgl_out": "2024-12-20", "id_kamar": 5, "nama_tamu": "Nana Mayuri Lala", "nomor_kontak": "082285498005"}', '{"tgl_in": "2024-12-15", "id_tamu": 9, "tgl_out": "2024-12-25", "id_kamar": 7, "nama_tamu": "Nana Mayuri Lala", "nomor_kontak": "082285498005"}', '2024-12-17 02:15:01'),
	(33, 'Tambah Data', 'table_tamu', NULL, '{"tgl_in": "2024-12-15", "id_tamu": 10, "tgl_out": "2024-12-31", "id_kamar": 5, "nama_tamu": "Tes untuk ani", "nomor_kontak": "082285498005"}', '2024-12-17 02:15:35'),
	(34, 'Tambah Data', 'table_transaksi', NULL, '{"id_tamu": 10, "total_harga": 9600000, "id_transaksi": 9, "lama_menginap": 16}', '2024-12-17 02:15:35'),
	(35, 'Update Data', 'table_tamu', '{"tgl_in": "2024-12-15", "id_tamu": 10, "tgl_out": "2024-12-31", "id_kamar": 5, "nama_tamu": "Tes untuk ani", "nomor_kontak": "082285498005"}', '{"tgl_in": "2024-12-11", "id_tamu": 10, "tgl_out": "2024-12-31", "id_kamar": 5, "nama_tamu": "Tes untuk ani", "nomor_kontak": "082285498005"}', '2024-12-17 02:18:41'),
	(36, 'Update Data', 'table_tamu', '{"tgl_in": "2024-12-11", "id_tamu": 10, "tgl_out": "2024-12-31", "id_kamar": 5, "nama_tamu": "Tes untuk ani", "nomor_kontak": "082285498005"}', '{"tgl_in": "2024-12-11", "id_tamu": 10, "tgl_out": "2024-12-31", "id_kamar": 5, "nama_tamu": "Tes untuk ani", "nomor_kontak": "082285498005"}', '2024-12-17 02:23:56'),
	(37, 'Update Data', 'table_transaksi', '{"id_tamu": 10, "total_harga": 9600000, "id_transaksi": 9, "lama_menginap": 16}', '{"id_tamu": 10, "total_harga": 12000000, "id_transaksi": 9, "lama_menginap": 20}', '2024-12-17 02:23:56');

-- Dumping structure for table reservasi_hotel.migrations
CREATE TABLE IF NOT EXISTS `migrations` (
  `id` int(10) unsigned NOT NULL AUTO_INCREMENT,
  `migration` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `batch` int(11) NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=9 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- Dumping data for table reservasi_hotel.migrations: ~8 rows (approximately)
INSERT INTO `migrations` (`id`, `migration`, `batch`) VALUES
	(1, '0001_01_01_000000_create_users_table', 1),
	(2, '0001_01_01_000001_create_cache_table', 1),
	(3, '0001_01_01_000002_create_jobs_table', 1),
	(4, '2024_12_17_145140_create_personal_access_tokens_table', 1),
	(5, '2024_12_19_153713_create_categories_table', 2),
	(6, '2024_12_19_153715_create_products_table', 2),
	(7, '2024_12_19_153722_create_customers_table', 2),
	(8, '2024_12_19_153731_create_transactions_table', 2);

-- Dumping structure for table reservasi_hotel.password_reset_tokens
CREATE TABLE IF NOT EXISTS `password_reset_tokens` (
  `email` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `token` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  PRIMARY KEY (`email`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- Dumping data for table reservasi_hotel.password_reset_tokens: ~0 rows (approximately)

-- Dumping structure for procedure reservasi_hotel.pc_edit_kamar
DELIMITER //
CREATE PROCEDURE `pc_edit_kamar`(
	IN `e_id_kamar` INT,
	IN `nama_kamar` VARCHAR(250),
	IN `harga_kamar` DECIMAL(20,6),
	IN `fasilitas` TEXT
)
BEGIN
UPDATE table_kamar
SET
nama_kamar=nama_kamar,
harga_kamar=harga_kamar,
fasilitas=fasilitas
WHERE id_kamar=e_id_kamar;
END//
DELIMITER ;

-- Dumping structure for procedure reservasi_hotel.pc_edit_tamu
DELIMITER //
CREATE PROCEDURE `pc_edit_tamu`(
	IN `e_id_tamu` INT,
	IN `nama_tamu` VARCHAR(250),
	IN `nomor_kontak` VARCHAR(250),
	IN `id_kamar` INT,
	IN `tgl_in` DATE,
	IN `tgl_out` DATE
)
BEGIN
UPDATE table_tamu
SET
nama_tamu=nama_tamu,
nomor_kontak=nomor_kontak,
id_kamar=id_kamar,
tgl_in=tgl_in,
tgl_out=tgl_out
WHERE id_tamu=e_id_tamu;
END//
DELIMITER ;

-- Dumping structure for procedure reservasi_hotel.pc_edit_transaksi
DELIMITER //
CREATE PROCEDURE `pc_edit_transaksi`(
	IN `e_id_transaksi` INT,
	IN `id_tamu` INT,
	IN `total_harga` INT,
	IN `lama_menginap` INT
)
BEGIN
UPDATE table_transaksi
SET
id_tamu=id_tamu,
total_harga=total_harga,
total_harga=total_harga
WHERE id_transaksi=e_id_transaksi;
END//
DELIMITER ;

-- Dumping structure for procedure reservasi_hotel.pc_insert_kamar
DELIMITER //
CREATE PROCEDURE `pc_insert_kamar`(
	IN `nama_kamar` VARCHAR(255),
	IN `harga_kamar` INT,
	IN `fasilitas` VARCHAR(50)
)
BEGIN
INSERT into table_kamar (nama_kamar,harga_kamar,fasilitas)
VALUES (nama_kamar,harga_kamar,fasilitas);
END//
DELIMITER ;

-- Dumping structure for procedure reservasi_hotel.pc_insert_tamu
DELIMITER //
CREATE PROCEDURE `pc_insert_tamu`(
	IN `nama_tamu` VARCHAR(250),
	IN `nomor_kontak` VARCHAR(20),
	IN `id_kamar` INT,
	IN `tgl_in` DATE,
	IN `tgl_out` DATE
)
BEGIN
INSERT into table_tamu (nama_tamu,nomor_kontak,id_kamar,tgl_in,tgl_out)
VALUES (nama_tamu,nomor_kontak,id_kamar,tgl_in,tgl_out);
END//
DELIMITER ;

-- Dumping structure for procedure reservasi_hotel.pc_insert_transaksi
DELIMITER //
CREATE PROCEDURE `pc_insert_transaksi`(
	IN `id_tamu` INT,
	IN `total_harga` INT,
	IN `lama_menginap` INT
)
BEGIN
INSERT into table_transaksi (id_tamu,total_harga,lama_menginap)
VALUES (id_tamu,total_harga,lama_menginap);
END//
DELIMITER ;

-- Dumping structure for table reservasi_hotel.personal_access_tokens
CREATE TABLE IF NOT EXISTS `personal_access_tokens` (
  `id` bigint(20) unsigned NOT NULL AUTO_INCREMENT,
  `tokenable_type` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `tokenable_id` bigint(20) unsigned NOT NULL,
  `name` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `token` varchar(64) COLLATE utf8mb4_unicode_ci NOT NULL,
  `abilities` text COLLATE utf8mb4_unicode_ci,
  `last_used_at` timestamp NULL DEFAULT NULL,
  `expires_at` timestamp NULL DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  PRIMARY KEY (`id`),
  UNIQUE KEY `personal_access_tokens_token_unique` (`token`),
  KEY `personal_access_tokens_tokenable_type_tokenable_id_index` (`tokenable_type`,`tokenable_id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- Dumping data for table reservasi_hotel.personal_access_tokens: ~0 rows (approximately)

-- Dumping structure for table reservasi_hotel.products
CREATE TABLE IF NOT EXISTS `products` (
  `id` bigint(20) unsigned NOT NULL AUTO_INCREMENT,
  `name` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `description` text COLLATE utf8mb4_unicode_ci NOT NULL,
  `price` decimal(10,2) NOT NULL,
  `category_id` bigint(20) unsigned NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  PRIMARY KEY (`id`),
  KEY `products_category_id_foreign` (`category_id`),
  CONSTRAINT `products_category_id_foreign` FOREIGN KEY (`category_id`) REFERENCES `categories` (`id`) ON DELETE CASCADE
) ENGINE=InnoDB AUTO_INCREMENT=3 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- Dumping data for table reservasi_hotel.products: ~1 rows (approximately)
INSERT INTO `products` (`id`, `name`, `description`, `price`, `category_id`, `created_at`, `updated_at`) VALUES
	(1, 'Produk 1', 'Produk', 300000.00, 1, '2024-12-24 09:25:27', '2024-12-24 09:25:27'),
	(2, 'Produk 2', 'Produk 2', 50000.00, 1, '2024-12-24 10:12:13', '2024-12-24 10:12:13');

-- Dumping structure for table reservasi_hotel.sessions
CREATE TABLE IF NOT EXISTS `sessions` (
  `id` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `user_id` bigint(20) unsigned DEFAULT NULL,
  `ip_address` varchar(45) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `user_agent` text COLLATE utf8mb4_unicode_ci,
  `payload` longtext COLLATE utf8mb4_unicode_ci NOT NULL,
  `last_activity` int(11) NOT NULL,
  PRIMARY KEY (`id`),
  KEY `sessions_user_id_index` (`user_id`),
  KEY `sessions_last_activity_index` (`last_activity`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- Dumping data for table reservasi_hotel.sessions: ~0 rows (approximately)

-- Dumping structure for table reservasi_hotel.table_kamar
CREATE TABLE IF NOT EXISTS `table_kamar` (
  `id_kamar` int(11) NOT NULL AUTO_INCREMENT,
  `nama_kamar` varchar(250) DEFAULT NULL,
  `harga_kamar` decimal(20,0) DEFAULT NULL,
  `fasilitas` text,
  PRIMARY KEY (`id_kamar`)
) ENGINE=InnoDB AUTO_INCREMENT=8 DEFAULT CHARSET=latin1;

-- Dumping data for table reservasi_hotel.table_kamar: ~7 rows (approximately)
INSERT INTO `table_kamar` (`id_kamar`, `nama_kamar`, `harga_kamar`, `fasilitas`) VALUES
	(1, 'Superior King', 750000, 'King Bed, Shower, Area Tempat Duduk'),
	(2, 'Superior', 550000, 'Ranjang, Shower, Ac'),
	(3, 'Luxury', 1500000, 'Ranjang, Ruang tamu'),
	(4, 'Kamar Super', 900000, 'Fasilitas lengkap'),
	(5, 'Kamar XL', 600000, 'Kamar Mandi di luar dan di dalam'),
	(6, 'Kamar tes 1', 60000, 'Kamar mandi di luar'),
	(7, 'Kamar Tes 3', 700000, 'Tidur di luar setengah jam');

-- Dumping structure for table reservasi_hotel.table_tamu
CREATE TABLE IF NOT EXISTS `table_tamu` (
  `id_tamu` int(11) NOT NULL AUTO_INCREMENT,
  `nama_tamu` varchar(250) DEFAULT NULL,
  `nomor_kontak` varchar(20) DEFAULT NULL,
  `id_kamar` int(11) DEFAULT NULL,
  `tgl_in` date DEFAULT NULL,
  `tgl_out` date DEFAULT NULL,
  PRIMARY KEY (`id_tamu`),
  KEY `FK_table_tamu_table_kamar` (`id_kamar`),
  CONSTRAINT `FK_table_tamu_table_kamar` FOREIGN KEY (`id_kamar`) REFERENCES `table_kamar` (`id_kamar`) ON DELETE CASCADE ON UPDATE CASCADE
) ENGINE=InnoDB AUTO_INCREMENT=10 DEFAULT CHARSET=latin1;

-- Dumping data for table reservasi_hotel.table_tamu: ~8 rows (approximately)
INSERT INTO `table_tamu` (`id_tamu`, `nama_tamu`, `nomor_kontak`, `id_kamar`, `tgl_in`, `tgl_out`) VALUES
	(1, 'Budi', '0822854898005', 1, '2024-12-05', '2024-12-06'),
	(2, 'Ani', '082285498004', 2, '2024-12-04', '2024-12-05'),
	(3, 'Yaya', '082285498005', 3, '2024-12-03', '2024-12-05'),
	(4, 'Hatono Jaya', '081374475842', 2, '2024-12-02', '2024-12-05'),
	(5, 'Budi Chen KL', '082285498005', 5, '2024-12-04', '2024-12-05'),
	(7, 'Agus ', '082285498003', 7, '2024-12-03', '2024-12-20'),
	(8, 'Gusyono', '082285498005', 5, '2024-12-02', '2024-12-05'),
	(9, 'Nana Mayuri Lala', '082285498005', 7, '2024-12-15', '2024-12-25');

-- Dumping structure for table reservasi_hotel.table_transaksi
CREATE TABLE IF NOT EXISTS `table_transaksi` (
  `id_transaksi` int(11) NOT NULL AUTO_INCREMENT,
  `id_tamu` int(11) NOT NULL,
  `total_harga` int(11) NOT NULL,
  `lama_menginap` int(11) NOT NULL,
  PRIMARY KEY (`id_transaksi`),
  KEY `FK_table_transaksi_table_tamu` (`id_tamu`),
  CONSTRAINT `FK_table_transaksi_table_tamu` FOREIGN KEY (`id_tamu`) REFERENCES `table_tamu` (`id_tamu`) ON DELETE NO ACTION ON UPDATE NO ACTION
) ENGINE=InnoDB AUTO_INCREMENT=9 DEFAULT CHARSET=latin1;

-- Dumping data for table reservasi_hotel.table_transaksi: ~9 rows (approximately)
INSERT INTO `table_transaksi` (`id_transaksi`, `id_tamu`, `total_harga`, `lama_menginap`) VALUES
	(1, 1, 750000, 1),
	(2, 2, 550000, 1),
	(3, 3, 1500000, 2),
	(4, 4, 1650000, 3),
	(5, 5, 1600000, 2),
	(6, 7, 1110000, 2),
	(7, 8, 1800000, 3),
	(8, 9, 2750000, 5);

-- Dumping structure for table reservasi_hotel.transactions
CREATE TABLE IF NOT EXISTS `transactions` (
  `id` bigint(20) unsigned NOT NULL AUTO_INCREMENT,
  `customer_id` bigint(20) unsigned NOT NULL,
  `product_id` bigint(20) unsigned NOT NULL,
  `total_price` decimal(10,2) NOT NULL,
  `transaction_date` date NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  PRIMARY KEY (`id`),
  KEY `transactions_customer_id_foreign` (`customer_id`),
  KEY `transactions_product_id_foreign` (`product_id`),
  CONSTRAINT `transactions_customer_id_foreign` FOREIGN KEY (`customer_id`) REFERENCES `customers` (`id`) ON DELETE CASCADE,
  CONSTRAINT `transactions_product_id_foreign` FOREIGN KEY (`product_id`) REFERENCES `products` (`id`) ON DELETE CASCADE
) ENGINE=InnoDB AUTO_INCREMENT=2 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- Dumping data for table reservasi_hotel.transactions: ~0 rows (approximately)
INSERT INTO `transactions` (`id`, `customer_id`, `product_id`, `total_price`, `transaction_date`, `created_at`, `updated_at`) VALUES
	(1, 2, 1, 300000.00, '2024-12-25', '2024-12-24 10:18:08', '2024-12-24 10:26:20');

-- Dumping structure for table reservasi_hotel.users
CREATE TABLE IF NOT EXISTS `users` (
  `id` bigint(20) unsigned NOT NULL AUTO_INCREMENT,
  `name` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `email` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `email_verified_at` timestamp NULL DEFAULT NULL,
  `password` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `remember_token` varchar(100) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  PRIMARY KEY (`id`),
  UNIQUE KEY `users_email_unique` (`email`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- Dumping data for table reservasi_hotel.users: ~0 rows (approximately)

-- Dumping structure for view reservasi_hotel.v_pembayaran
-- Creating temporary table to overcome VIEW dependency errors
CREATE TABLE `v_pembayaran` (
	`id_transaksi` INT(11) NOT NULL,
	`id_tamu` INT(11) NOT NULL,
	`total_harga` INT(11) NOT NULL,
	`lama_menginap` INT(11) NOT NULL,
	`nama_tamu` VARCHAR(1) NULL COLLATE 'latin1_swedish_ci',
	`nomor_kontak` VARCHAR(1) NULL COLLATE 'latin1_swedish_ci',
	`tgl_in` DATE NULL,
	`tgl_out` DATE NULL,
	`id_kamar` INT(11) NULL,
	`nama_kamar` VARCHAR(1) NULL COLLATE 'latin1_swedish_ci',
	`harga_kamar` DECIMAL(20,0) NULL,
	`fasilitas` TEXT NULL COLLATE 'latin1_swedish_ci'
) ENGINE=MyISAM;

-- Dumping structure for view reservasi_hotel.v_reservasi
-- Creating temporary table to overcome VIEW dependency errors
CREATE TABLE `v_reservasi` (
	`id_tamu` INT(11) NOT NULL,
	`nama_tamu` VARCHAR(1) NULL COLLATE 'latin1_swedish_ci',
	`nomor_kontak` VARCHAR(1) NULL COLLATE 'latin1_swedish_ci',
	`id_kamar` INT(11) NULL,
	`tgl_in` DATE NULL,
	`tgl_out` DATE NULL,
	`nama_kamar` VARCHAR(1) NULL COLLATE 'latin1_swedish_ci',
	`harga_kamar` DECIMAL(20,0) NULL,
	`fasilitas` TEXT NULL COLLATE 'latin1_swedish_ci'
) ENGINE=MyISAM;

-- Dumping structure for trigger reservasi_hotel.log_insert_kamar
SET @OLDTMP_SQL_MODE=@@SQL_MODE, SQL_MODE='ONLY_FULL_GROUP_BY,STRICT_TRANS_TABLES,NO_ZERO_IN_DATE,NO_ZERO_DATE,ERROR_FOR_DIVISION_BY_ZERO,NO_AUTO_CREATE_USER,NO_ENGINE_SUBSTITUTION';
DELIMITER //
CREATE TRIGGER `log_insert_kamar` AFTER INSERT ON `table_kamar` FOR EACH ROW BEGIN
INSERT INTO log_database
 (aktivitas,nama_tabel,data_sebelum, data_sesudah,waktu)
  VALUES('Tambah Data','table_kamar',null,JSON_OBJECT(
  'id_kamar',NEW.id_kamar,
  'nama_kamar',NEW.nama_kamar,
  'fasilitas',NEW.fasilitas
  ),NOW());
END//
DELIMITER ;
SET SQL_MODE=@OLDTMP_SQL_MODE;

-- Dumping structure for trigger reservasi_hotel.log_insert_tamu
SET @OLDTMP_SQL_MODE=@@SQL_MODE, SQL_MODE='ONLY_FULL_GROUP_BY,STRICT_TRANS_TABLES,NO_ZERO_IN_DATE,NO_ZERO_DATE,ERROR_FOR_DIVISION_BY_ZERO,NO_AUTO_CREATE_USER,NO_ENGINE_SUBSTITUTION';
DELIMITER //
CREATE TRIGGER `log_insert_tamu` AFTER INSERT ON `table_tamu` FOR EACH ROW BEGIN
INSERT INTO log_database
 (aktivitas,nama_tabel,data_sebelum, data_sesudah,waktu)
  VALUES('Tambah Data','table_tamu',null,JSON_OBJECT(
  'id_tamu',NEW.id_tamu,
  'nama_tamu',NEW.nama_tamu,
  'nomor_kontak',NEW.nomor_kontak,
  'id_kamar',NEW.id_kamar,
  'tgl_in',NEW.tgl_in,
  'tgl_out',NEW.tgl_out
  ),NOW());
END//
DELIMITER ;
SET SQL_MODE=@OLDTMP_SQL_MODE;

-- Dumping structure for trigger reservasi_hotel.log_insert_transaksi
SET @OLDTMP_SQL_MODE=@@SQL_MODE, SQL_MODE='ONLY_FULL_GROUP_BY,STRICT_TRANS_TABLES,NO_ZERO_IN_DATE,NO_ZERO_DATE,ERROR_FOR_DIVISION_BY_ZERO,NO_AUTO_CREATE_USER,NO_ENGINE_SUBSTITUTION';
DELIMITER //
CREATE TRIGGER `log_insert_transaksi` AFTER INSERT ON `table_transaksi` FOR EACH ROW BEGIN
INSERT INTO log_database
 (aktivitas,nama_tabel,data_sebelum, data_sesudah,waktu)
  VALUES('Tambah Data','table_transaksi',null,JSON_OBJECT(
  'id_transaksi',NEW.id_transaksi,
  'id_tamu',NEW.id_tamu,
  'total_harga',NEW.total_harga,
  'lama_menginap',NEW.lama_menginap
  ),NOW());
END//
DELIMITER ;
SET SQL_MODE=@OLDTMP_SQL_MODE;

-- Dumping structure for trigger reservasi_hotel.log_update_kamar
SET @OLDTMP_SQL_MODE=@@SQL_MODE, SQL_MODE='ONLY_FULL_GROUP_BY,STRICT_TRANS_TABLES,NO_ZERO_IN_DATE,NO_ZERO_DATE,ERROR_FOR_DIVISION_BY_ZERO,NO_AUTO_CREATE_USER,NO_ENGINE_SUBSTITUTION';
DELIMITER //
CREATE TRIGGER `log_update_kamar` AFTER UPDATE ON `table_kamar` FOR EACH ROW BEGIN
INSERT INTO log_database
 (aktivitas,nama_tabel,data_sebelum, data_sesudah,waktu)
  VALUES('Update Data','table_kamar',JSON_OBJECT(
  'id_kamar',OLD.id_kamar,
  'nama_kamar',OLD.nama_kamar,
  'fasilitas',OLD.fasilitas
  ),JSON_OBJECT(
  'id_kamar',NEW.id_kamar,
  'nama_kamar',NEW.nama_kamar,
  'fasilitas',NEW.fasilitas
  ),NOW());
END//
DELIMITER ;
SET SQL_MODE=@OLDTMP_SQL_MODE;

-- Dumping structure for trigger reservasi_hotel.log_update_tamud
SET @OLDTMP_SQL_MODE=@@SQL_MODE, SQL_MODE='ONLY_FULL_GROUP_BY,STRICT_TRANS_TABLES,NO_ZERO_IN_DATE,NO_ZERO_DATE,ERROR_FOR_DIVISION_BY_ZERO,NO_AUTO_CREATE_USER,NO_ENGINE_SUBSTITUTION';
DELIMITER //
CREATE TRIGGER `log_update_tamud` AFTER UPDATE ON `table_tamu` FOR EACH ROW BEGIN
INSERT INTO log_database
 (aktivitas,nama_tabel,data_sebelum, data_sesudah,waktu)
  VALUES('Update Data','table_tamu',JSON_OBJECT(
  'id_tamu',OLD.id_tamu,
  'nama_tamu',OLD.nama_tamu,
  'nomor_kontak',OLD.nomor_kontak,
  'id_kamar',OLD.id_kamar,
  'tgl_in',OLD.tgl_in,
  'tgl_out',OLD.tgl_out
  ),JSON_OBJECT(
  'id_tamu',NEW.id_tamu,
  'nama_tamu',NEW.nama_tamu,
  'nomor_kontak',NEW.nomor_kontak,
  'id_kamar',NEW.id_kamar,
  'tgl_in',NEW.tgl_in,
  'tgl_out',NEW.tgl_out
  ),NOW());
END//
DELIMITER ;
SET SQL_MODE=@OLDTMP_SQL_MODE;

-- Dumping structure for trigger reservasi_hotel.log_update_transaksi
SET @OLDTMP_SQL_MODE=@@SQL_MODE, SQL_MODE='ONLY_FULL_GROUP_BY,STRICT_TRANS_TABLES,NO_ZERO_IN_DATE,NO_ZERO_DATE,ERROR_FOR_DIVISION_BY_ZERO,NO_AUTO_CREATE_USER,NO_ENGINE_SUBSTITUTION';
DELIMITER //
CREATE TRIGGER `log_update_transaksi` AFTER UPDATE ON `table_transaksi` FOR EACH ROW BEGIN
INSERT INTO log_database
 (aktivitas,nama_tabel,data_sebelum, data_sesudah,waktu)
  VALUES('Update Data','table_transaksi',JSON_OBJECT(
  'id_transaksi',OLD.id_transaksi,
  'id_tamu',OLD.id_tamu,
  'total_harga',OLD.total_harga,
  'lama_menginap',OLD.lama_menginap
  ),JSON_OBJECT(
  'id_transaksi',NEW.id_transaksi,
  'id_tamu',NEW.id_tamu,
  'total_harga',NEW.total_harga,
  'lama_menginap',NEW.lama_menginap
  ),NOW());
END//
DELIMITER ;
SET SQL_MODE=@OLDTMP_SQL_MODE;

-- Dumping structure for trigger reservasi_hotel.transaksi_otomatis
SET @OLDTMP_SQL_MODE=@@SQL_MODE, SQL_MODE='ONLY_FULL_GROUP_BY,STRICT_TRANS_TABLES,NO_ZERO_IN_DATE,NO_ZERO_DATE,ERROR_FOR_DIVISION_BY_ZERO,NO_AUTO_CREATE_USER,NO_ENGINE_SUBSTITUTION';
DELIMITER //
CREATE TRIGGER `transaksi_otomatis` AFTER INSERT ON `table_tamu` FOR EACH ROW BEGIN
DECLARE jumlahhari DECIMAL(10, 2);
DECLARE harga_kamar DECIMAL(10, 2);
SELECT t.harga_kamar INTO harga_kamar
FROM table_kamar t
WHERE t.id_kamar=NEW.id_kamar;
 IF NEW.tgl_in IS NULL OR NEW.tgl_out IS NULL THEN
        SET jumlahHari = NULL;
    ELSEIF NEW.tgl_out < NEW.tgl_in THEN
        SIGNAL SQLSTATE '45000'
        SET MESSAGE_TEXT = 'Tanggal Akhir tidak boleh lebih kecil dari Tanggal Mulai';
    ELSE
        SET jumlahHari = DATEDIFF(NEW.tgl_out, NEW.tgl_in);
    END IF;
INSERT INTO table_transaksi (id_tamu,total_harga,lama_menginap)
VALUES (NEW.id_tamu,jumlahHari*harga_kamar,jumlahHari);
END//
DELIMITER ;
SET SQL_MODE=@OLDTMP_SQL_MODE;

-- Removing temporary table and create final VIEW structure
DROP TABLE IF EXISTS `v_pembayaran`;
CREATE ALGORITHM=UNDEFINED SQL SECURITY DEFINER VIEW `v_pembayaran` AS SELECT table_transaksi.*,
table_tamu.nama_tamu,
table_tamu.nomor_kontak,
table_tamu.tgl_in,
table_tamu.tgl_out,
table_tamu.id_kamar,
table_kamar.nama_kamar,
table_kamar.harga_kamar,
table_kamar.fasilitas
 FROM table_transaksi 
JOIN table_tamu
ON table_tamu.id_tamu=table_transaksi.id_transaksi
JOIN table_kamar
ON table_kamar.id_kamar=table_tamu.id_kamar ;

-- Removing temporary table and create final VIEW structure
DROP TABLE IF EXISTS `v_reservasi`;
CREATE ALGORITHM=UNDEFINED SQL SECURITY DEFINER VIEW `v_reservasi` AS SELECT table_tamu.*,table_kamar.nama_kamar,table_kamar.harga_kamar,table_kamar.fasilitas FROM table_tamu 
JOIN table_kamar
ON table_kamar.id_kamar=table_tamu.id_kamar ;

/*!40103 SET TIME_ZONE=IFNULL(@OLD_TIME_ZONE, 'system') */;
/*!40101 SET SQL_MODE=IFNULL(@OLD_SQL_MODE, '') */;
/*!40014 SET FOREIGN_KEY_CHECKS=IFNULL(@OLD_FOREIGN_KEY_CHECKS, 1) */;
/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40111 SET SQL_NOTES=IFNULL(@OLD_SQL_NOTES, 1) */;
