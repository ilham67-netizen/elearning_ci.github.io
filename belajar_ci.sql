-- --------------------------------------------------------
-- Host:                         127.0.0.1
-- Server version:               10.1.37-MariaDB - mariadb.org binary distribution
-- Server OS:                    Win32
-- HeidiSQL Version:             9.5.0.5196
-- --------------------------------------------------------

/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET NAMES utf8 */;
/*!50503 SET NAMES utf8mb4 */;
/*!40014 SET @OLD_FOREIGN_KEY_CHECKS=@@FOREIGN_KEY_CHECKS, FOREIGN_KEY_CHECKS=0 */;
/*!40101 SET @OLD_SQL_MODE=@@SQL_MODE, SQL_MODE='NO_AUTO_VALUE_ON_ZERO' */;


-- Dumping database structure for belajar_ci
CREATE DATABASE IF NOT EXISTS `belajar_ci` /*!40100 DEFAULT CHARACTER SET latin1 */;
USE `belajar_ci`;

-- Dumping structure for table belajar_ci.absensi
CREATE TABLE IF NOT EXISTS `absensi` (
  `id_absen` int(11) NOT NULL AUTO_INCREMENT,
  `kd_jadwal` varchar(10) DEFAULT NULL,
  `nim` varchar(50) DEFAULT NULL,
  `waktu_absen` datetime DEFAULT NULL,
  PRIMARY KEY (`id_absen`)
) ENGINE=InnoDB AUTO_INCREMENT=8 DEFAULT CHARSET=latin1;

-- Dumping data for table belajar_ci.absensi: ~0 rows (approximately)
/*!40000 ALTER TABLE `absensi` DISABLE KEYS */;
INSERT INTO `absensi` (`id_absen`, `kd_jadwal`, `nim`, `waktu_absen`) VALUES
	(6, 'J0002', '16030040015', '2020-10-11 12:05:00'),
	(7, 'J0003', '16030040015', '2020-10-25 12:58:00');
/*!40000 ALTER TABLE `absensi` ENABLE KEYS */;

-- Dumping structure for table belajar_ci.absen_ujian
CREATE TABLE IF NOT EXISTS `absen_ujian` (
  `id_absen` int(11) NOT NULL AUTO_INCREMENT,
  `kd_paket` varchar(10) DEFAULT NULL,
  `kd_pengawas` varchar(10) DEFAULT NULL,
  `nim` varchar(50) DEFAULT NULL,
  `tanggal_absen` datetime DEFAULT NULL,
  PRIMARY KEY (`id_absen`)
) ENGINE=InnoDB AUTO_INCREMENT=4 DEFAULT CHARSET=latin1;

-- Dumping data for table belajar_ci.absen_ujian: ~2 rows (approximately)
/*!40000 ALTER TABLE `absen_ujian` DISABLE KEYS */;
INSERT INTO `absen_ujian` (`id_absen`, `kd_paket`, `kd_pengawas`, `nim`, `tanggal_absen`) VALUES
	(1, 'PS0001', 'KP0001', '16030040015', '2020-10-25 02:20:00'),
	(2, 'PS0004', 'KP0002', '16030040015', '2020-10-25 02:52:00'),
	(3, 'PS0005', 'KP0003', '16030040015', '2020-10-26 21:21:00');
/*!40000 ALTER TABLE `absen_ujian` ENABLE KEYS */;

-- Dumping structure for table belajar_ci.dosen
CREATE TABLE IF NOT EXISTS `dosen` (
  `nip_dosen` varchar(15) NOT NULL,
  `nama_dosen` varchar(150) DEFAULT NULL,
  `tempat_lahir` varchar(150) DEFAULT NULL,
  `tgl_lahir` date DEFAULT NULL,
  `no_telp` varchar(13) DEFAULT NULL,
  `fakultas` varchar(10) DEFAULT NULL,
  `prodi` varchar(10) DEFAULT NULL,
  `alamat` text,
  `password` varchar(150) DEFAULT NULL,
  PRIMARY KEY (`nip_dosen`),
  KEY `FK_dosen_fakultas` (`fakultas`),
  KEY `FK_dosen_prodi` (`prodi`),
  CONSTRAINT `FK_dosen_fakultas` FOREIGN KEY (`fakultas`) REFERENCES `fakultas` (`kd_fakultas`) ON DELETE SET NULL ON UPDATE CASCADE,
  CONSTRAINT `FK_dosen_prodi` FOREIGN KEY (`prodi`) REFERENCES `prodi` (`kd_prodi`) ON DELETE SET NULL ON UPDATE CASCADE
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

-- Dumping data for table belajar_ci.dosen: ~6 rows (approximately)
/*!40000 ALTER TABLE `dosen` DISABLE KEYS */;
INSERT INTO `dosen` (`nip_dosen`, `nama_dosen`, `tempat_lahir`, `tgl_lahir`, `no_telp`, `fakultas`, `prodi`, `alamat`, `password`) VALUES
	('20402', 'Riza Bahtiar', 'Purworejo', '1998-08-11', '089584738439', '030', '0304', 'Jl. Bali', '7110eda4d09e062aa5e4a390b0a572ac0d2c0220'),
	('210201', 'Bintang', 'Purablingga', '1998-07-09', '08736438438', '030', '0303', 'Jl. Neraka', '7110eda4d09e062aa5e4a390b0a572ac0d2c0220'),
	('232323', 'ilham2', 'sdadas', '2020-09-14', '5656445', '030', '0304', 'asdsdaasd', '7110eda4d09e062aa5e4a390b0a572ac0d2c0220'),
	('7348348', 'Ujang', 'Banyumas', '1996-05-17', '0834892489', '030', '0302', 'Jl.  Satria', '7110eda4d09e062aa5e4a390b0a572ac0d2c0220'),
	('829289', 'Rita Wahyuning', 'Tangerang', '1997-07-17', '089839293', '020', '0201', 'Jl, Antah Berantah', '7110eda4d09e062aa5e4a390b0a572ac0d2c0220'),
	('834938', 'Bagus', 'Cilengsi', '1998-12-12', '079459845', '030', '0301', 'Jl. Odading', '7110eda4d09e062aa5e4a390b0a572ac0d2c0220');
/*!40000 ALTER TABLE `dosen` ENABLE KEYS */;

-- Dumping structure for table belajar_ci.fakultas
CREATE TABLE IF NOT EXISTS `fakultas` (
  `kd_fakultas` varchar(10) NOT NULL,
  `nama_fakultas` varchar(150) DEFAULT NULL,
  PRIMARY KEY (`kd_fakultas`)
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

-- Dumping data for table belajar_ci.fakultas: ~1 rows (approximately)
/*!40000 ALTER TABLE `fakultas` DISABLE KEYS */;
INSERT INTO `fakultas` (`kd_fakultas`, `nama_fakultas`) VALUES
	('020', 'Psikologi'),
	('030', 'Teknik dan Sains');
/*!40000 ALTER TABLE `fakultas` ENABLE KEYS */;

-- Dumping structure for table belajar_ci.jadwal
CREATE TABLE IF NOT EXISTS `jadwal` (
  `kd_jadwal` varchar(10) NOT NULL,
  `nama_kuliah` varchar(150) DEFAULT NULL,
  `kd_matkul` varchar(15) DEFAULT NULL,
  `waktu_mulai` datetime DEFAULT NULL,
  `waktu_akhir` datetime DEFAULT NULL,
  `link` text,
  `status` int(11) DEFAULT NULL,
  `allow_absen` int(11) DEFAULT NULL,
  PRIMARY KEY (`kd_jadwal`)
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

-- Dumping data for table belajar_ci.jadwal: ~2 rows (approximately)
/*!40000 ALTER TABLE `jadwal` DISABLE KEYS */;
INSERT INTO `jadwal` (`kd_jadwal`, `nama_kuliah`, `kd_matkul`, `waktu_mulai`, `waktu_akhir`, `link`, `status`, `allow_absen`) VALUES
	('J0001', 'Membuat Program Laundry', 'KM0001', '2020-10-09 23:45:25', '2020-10-09 23:57:00', 'https://meet.jit.si/ilham', 1, 1),
	('J0002', 'Membuat Program Bank Sampah', 'KM0001', '2020-10-11 12:00:00', '2020-10-11 13:00:00', 'https://meet.jit.si/dsaaa', 1, 1),
	('J0003', 'SIG', 'KM0001', '2020-10-25 12:55:00', '2020-10-25 12:59:00', 'https://meet.jit.si/UUHYY', 1, 1),
	('J0004', 'Hasim', 'KM0001', '2020-10-25 22:16:00', NULL, 'https://meet.jit.si/asyaipp', 1, 0);
/*!40000 ALTER TABLE `jadwal` ENABLE KEYS */;

-- Dumping structure for table belajar_ci.jawaban
CREATE TABLE IF NOT EXISTS `jawaban` (
  `id_jawab` int(11) NOT NULL AUTO_INCREMENT,
  `nim` varchar(50) DEFAULT NULL,
  `kd_pengawas` varchar(10) DEFAULT NULL,
  `kd_soal` varchar(10) DEFAULT NULL,
  `jawaban` text,
  `jawaban_opsi` varchar(50) DEFAULT NULL,
  PRIMARY KEY (`id_jawab`)
) ENGINE=InnoDB AUTO_INCREMENT=34 DEFAULT CHARSET=latin1;

-- Dumping data for table belajar_ci.jawaban: ~8 rows (approximately)
/*!40000 ALTER TABLE `jawaban` DISABLE KEYS */;
INSERT INTO `jawaban` (`id_jawab`, `nim`, `kd_pengawas`, `kd_soal`, `jawaban`, `jawaban_opsi`) VALUES
	(25, '16030040015', 'KP0001', 'SO0001', '-', 'A'),
	(26, '16030040015', 'KP0001', 'SO0002', '-', 'C'),
	(27, '16030040015', 'KP0001', 'SO0003', '-', 'C'),
	(28, '16030040015', 'KP0001', 'SO0004', '-', 'C'),
	(29, '16030040015', 'KP0001', 'SO0005', '-', 'E'),
	(30, '16030040015', 'KP0002', 'SO0008', '<p>1. Pergi ke table yang akan di foreign key</p>\r\n\r\n<p>2. Kemudian ke foriegn key&nbsp;</p>\r\n\r\n<p>3. Pilih kolom yang akan di foreign key</p>\r\n', '-'),
	(31, '16030040015', 'KP0002', 'SO0009', '<p>1. Klik new database</p>\r\n\r\n<p>2. Isilah Nama database</p>\r\n\r\n<p>3. Klik Create</p>\r\n', '-'),
	(32, '16030040015', 'KP0002', 'SO0010', '<p>Object Oriented Programming</p>\r\n', '-'),
	(33, '16030040015', 'KP0002', 'SO0011', '<p>1. Klik kanan kolom yang akan di primary key</p>\r\n\r\n<p>2. Kemudian pilih opsi primary key&nbsp;</p>\r\n', '-');
/*!40000 ALTER TABLE `jawaban` ENABLE KEYS */;

-- Dumping structure for table belajar_ci.jawaban_koding
CREATE TABLE IF NOT EXISTS `jawaban_koding` (
  `id_jawaban` int(11) NOT NULL AUTO_INCREMENT,
  `nim` varchar(50) DEFAULT NULL,
  `kd_paket` varchar(10) DEFAULT NULL,
  `kd_pengawas` varchar(10) DEFAULT NULL,
  `teks_koding` text,
  PRIMARY KEY (`id_jawaban`)
) ENGINE=InnoDB AUTO_INCREMENT=2 DEFAULT CHARSET=latin1;

-- Dumping data for table belajar_ci.jawaban_koding: ~0 rows (approximately)
/*!40000 ALTER TABLE `jawaban_koding` DISABLE KEYS */;
INSERT INTO `jawaban_koding` (`id_jawaban`, `nim`, `kd_paket`, `kd_pengawas`, `teks_koding`) VALUES
	(1, '16030040015', 'PS0005', 'KP0003', '<?php\r\n	echo \'<div style="color: red;">ILHAM MUHAMMAD ASYIAPPP</div>\';\r\n?>');
/*!40000 ALTER TABLE `jawaban_koding` ENABLE KEYS */;

-- Dumping structure for table belajar_ci.kelas
CREATE TABLE IF NOT EXISTS `kelas` (
  `kd_kelas` varchar(10) NOT NULL,
  `nama_kelas` varchar(150) DEFAULT NULL,
  `fakultas` varchar(10) DEFAULT NULL,
  `prodi` varchar(10) DEFAULT NULL,
  PRIMARY KEY (`kd_kelas`)
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

-- Dumping data for table belajar_ci.kelas: ~5 rows (approximately)
/*!40000 ALTER TABLE `kelas` DISABLE KEYS */;
INSERT INTO `kelas` (`kd_kelas`, `nama_kelas`, `fakultas`, `prodi`) VALUES
	('K0001', 'TS A', '030', '0301'),
	('K0002', 'PS A', '020', '0201'),
	('K0003', 'TE A', '030', '0303'),
	('K0004', 'TI A', '030', '0304'),
	('K0005', 'TK A', '030', '0302'),
	('K0006', 'TI B', '030', '0304');
/*!40000 ALTER TABLE `kelas` ENABLE KEYS */;

-- Dumping structure for table belajar_ci.mahasiswa
CREATE TABLE IF NOT EXISTS `mahasiswa` (
  `nim` varchar(50) NOT NULL,
  `nama_mhs` varchar(250) DEFAULT NULL,
  `no_telp` varchar(13) DEFAULT NULL,
  `tgl_lahir` date DEFAULT NULL,
  `tempat_lahir` varchar(150) DEFAULT NULL,
  `alamat` text,
  `fakultas` varchar(10) DEFAULT NULL,
  `prodi` varchar(10) DEFAULT NULL,
  `email` varchar(50) DEFAULT NULL,
  `password` varchar(150) DEFAULT NULL,
  `dosbing_akad` varchar(10) DEFAULT NULL,
  PRIMARY KEY (`nim`)
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

-- Dumping data for table belajar_ci.mahasiswa: ~0 rows (approximately)
/*!40000 ALTER TABLE `mahasiswa` DISABLE KEYS */;
INSERT INTO `mahasiswa` (`nim`, `nama_mhs`, `no_telp`, `tgl_lahir`, `tempat_lahir`, `alamat`, `fakultas`, `prodi`, `email`, `password`, `dosbing_akad`) VALUES
	('16030040015', 'ILHAM MUHAMMAD PRASETYO', '0895390413246', '1997-07-19', 'Cilacap', 'Maos', '030', '0304', 'ilham@gmail.com', '7110eda4d09e062aa5e4a390b0a572ac0d2c0220', '232323'),
	('1603040021', 'YAMIN', '08934734349', '1998-03-10', 'Jakarta', 'Jl.. Ki Hajar Dewantara', '030', '0304', 'ratatuli645@gmail.com', '7110eda4d09e062aa5e4a390b0a572ac0d2c0220', '232323');
/*!40000 ALTER TABLE `mahasiswa` ENABLE KEYS */;

-- Dumping structure for table belajar_ci.matkul
CREATE TABLE IF NOT EXISTS `matkul` (
  `kd_matkul` varchar(15) NOT NULL,
  `nama_matkul` varchar(150) DEFAULT NULL,
  `kelas` varchar(10) DEFAULT NULL,
  `nip_dosen` varchar(15) DEFAULT NULL,
  `fakultas` varchar(10) DEFAULT NULL,
  `prodi` varchar(10) DEFAULT NULL,
  `semester` int(11) DEFAULT NULL,
  PRIMARY KEY (`kd_matkul`),
  KEY `FK_matkul_dosen` (`nip_dosen`),
  KEY `FK_matkul_kelas` (`kelas`),
  CONSTRAINT `FK_matkul_dosen` FOREIGN KEY (`nip_dosen`) REFERENCES `dosen` (`nip_dosen`) ON DELETE CASCADE ON UPDATE CASCADE,
  CONSTRAINT `FK_matkul_kelas` FOREIGN KEY (`kelas`) REFERENCES `kelas` (`kd_kelas`) ON DELETE CASCADE ON UPDATE CASCADE
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

-- Dumping data for table belajar_ci.matkul: ~6 rows (approximately)
/*!40000 ALTER TABLE `matkul` DISABLE KEYS */;
INSERT INTO `matkul` (`kd_matkul`, `nama_matkul`, `kelas`, `nip_dosen`, `fakultas`, `prodi`, `semester`) VALUES
	('KM0001', 'Pemrograman Dasar', 'K0004', '20402', '030', '0304', 1),
	('KM0002', 'Kepribadian Seseorang', 'K0002', '829289', '020', '0201', 1),
	('KM0003', 'Arus Lemah', 'K0003', '210201', '030', '0303', 2),
	('KM0004', 'Pembangunan Jalan Raya', 'K0001', '834938', '030', '0301', 5),
	('KM0005', 'Analis', 'K0005', '7348348', '030', '0302', 3),
	('KM0006', 'Konstruksi Gedung', 'K0001', '834938', '030', '0301', 7),
	('KM0007', 'Basis Data', 'K0006', '232323', '030', '0304', 1);
/*!40000 ALTER TABLE `matkul` ENABLE KEYS */;

-- Dumping structure for table belajar_ci.mhs_krs
CREATE TABLE IF NOT EXISTS `mhs_krs` (
  `id_krs` int(11) NOT NULL AUTO_INCREMENT,
  `kd_matkul` varchar(15) DEFAULT NULL,
  `nim` varchar(50) DEFAULT NULL,
  PRIMARY KEY (`id_krs`),
  KEY `FK_mhs_krs_matkul` (`kd_matkul`),
  KEY `FK_mhs_krs_mahasiswa` (`nim`),
  CONSTRAINT `FK_mhs_krs_mahasiswa` FOREIGN KEY (`nim`) REFERENCES `mahasiswa` (`nim`) ON DELETE CASCADE ON UPDATE CASCADE,
  CONSTRAINT `FK_mhs_krs_matkul` FOREIGN KEY (`kd_matkul`) REFERENCES `matkul` (`kd_matkul`) ON DELETE CASCADE ON UPDATE CASCADE
) ENGINE=InnoDB AUTO_INCREMENT=10 DEFAULT CHARSET=latin1;

-- Dumping data for table belajar_ci.mhs_krs: ~2 rows (approximately)
/*!40000 ALTER TABLE `mhs_krs` DISABLE KEYS */;
INSERT INTO `mhs_krs` (`id_krs`, `kd_matkul`, `nim`) VALUES
	(5, 'KM0007', '16030040015'),
	(8, 'KM0001', '16030040015'),
	(9, 'KM0007', '1603040021');
/*!40000 ALTER TABLE `mhs_krs` ENABLE KEYS */;

-- Dumping structure for table belajar_ci.mhs_tugas
CREATE TABLE IF NOT EXISTS `mhs_tugas` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `kd_tugas` varchar(10) NOT NULL,
  `nim` varchar(50) DEFAULT NULL,
  `tgl_uplod` datetime DEFAULT NULL,
  `status` varchar(50) DEFAULT NULL,
  `nilai` varchar(10) DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=5 DEFAULT CHARSET=latin1;

-- Dumping data for table belajar_ci.mhs_tugas: ~1 rows (approximately)
/*!40000 ALTER TABLE `mhs_tugas` DISABLE KEYS */;
INSERT INTO `mhs_tugas` (`id`, `kd_tugas`, `nim`, `tgl_uplod`, `status`, `nilai`) VALUES
	(2, 'T0004', '16030040015', '2020-10-08 09:46:00', 'Sudah Mengumpulkan', '70'),
	(3, 'T0006', '16030040015', '2020-10-25 06:53:00', 'Sudah Mengumpulkan', '60'),
	(4, 'T0007', '16030040015', '2020-10-25 15:40:00', 'Sudah Mengumpulkan', '80');
/*!40000 ALTER TABLE `mhs_tugas` ENABLE KEYS */;

-- Dumping structure for table belajar_ci.nilai_essay
CREATE TABLE IF NOT EXISTS `nilai_essay` (
  `id_nilai` int(11) NOT NULL AUTO_INCREMENT,
  `nim` varchar(50) DEFAULT NULL,
  `kd_pengawas` varchar(10) DEFAULT NULL,
  `kd_paket` varchar(10) DEFAULT NULL,
  `nilai` int(11) DEFAULT NULL,
  PRIMARY KEY (`id_nilai`)
) ENGINE=InnoDB AUTO_INCREMENT=2 DEFAULT CHARSET=latin1;

-- Dumping data for table belajar_ci.nilai_essay: ~1 rows (approximately)
/*!40000 ALTER TABLE `nilai_essay` DISABLE KEYS */;
INSERT INTO `nilai_essay` (`id_nilai`, `nim`, `kd_pengawas`, `kd_paket`, `nilai`) VALUES
	(1, '16030040015', 'KP0002', 'PS0004', 60);
/*!40000 ALTER TABLE `nilai_essay` ENABLE KEYS */;

-- Dumping structure for table belajar_ci.nilai_koding
CREATE TABLE IF NOT EXISTS `nilai_koding` (
  `id_nilai` int(11) NOT NULL AUTO_INCREMENT,
  `nim` varchar(50) DEFAULT NULL,
  `kd_paket` varchar(10) DEFAULT NULL,
  `kd_pengawas` varchar(10) DEFAULT NULL,
  `nilai` int(11) DEFAULT NULL,
  PRIMARY KEY (`id_nilai`)
) ENGINE=InnoDB AUTO_INCREMENT=2 DEFAULT CHARSET=latin1;

-- Dumping data for table belajar_ci.nilai_koding: ~0 rows (approximately)
/*!40000 ALTER TABLE `nilai_koding` DISABLE KEYS */;
INSERT INTO `nilai_koding` (`id_nilai`, `nim`, `kd_paket`, `kd_pengawas`, `nilai`) VALUES
	(1, '16030040015', 'PS0005', 'KP0003', 70);
/*!40000 ALTER TABLE `nilai_koding` ENABLE KEYS */;

-- Dumping structure for table belajar_ci.nilai_pilgan
CREATE TABLE IF NOT EXISTS `nilai_pilgan` (
  `id_nilai` int(11) NOT NULL AUTO_INCREMENT,
  `nim` varchar(50) NOT NULL DEFAULT '0',
  `kd_pengawas` varchar(10) DEFAULT NULL,
  `kd_paket` varchar(10) DEFAULT NULL,
  `benar` int(11) DEFAULT NULL,
  `salah` int(11) DEFAULT NULL,
  `tidak_dikerjakan` int(11) DEFAULT NULL,
  `nilai` int(11) DEFAULT NULL,
  PRIMARY KEY (`id_nilai`)
) ENGINE=InnoDB AUTO_INCREMENT=6 DEFAULT CHARSET=latin1;

-- Dumping data for table belajar_ci.nilai_pilgan: ~1 rows (approximately)
/*!40000 ALTER TABLE `nilai_pilgan` DISABLE KEYS */;
INSERT INTO `nilai_pilgan` (`id_nilai`, `nim`, `kd_pengawas`, `kd_paket`, `benar`, `salah`, `tidak_dikerjakan`, `nilai`) VALUES
	(5, '16030040015', 'KP0001', 'PS0001', 2, 3, 0, 40);
/*!40000 ALTER TABLE `nilai_pilgan` ENABLE KEYS */;

-- Dumping structure for table belajar_ci.opsi_pilgan
CREATE TABLE IF NOT EXISTS `opsi_pilgan` (
  `id_opsi` int(11) NOT NULL AUTO_INCREMENT,
  `kd_soal` varchar(10) DEFAULT NULL,
  `kd_paket` varchar(10) DEFAULT NULL,
  `opsi_a` text,
  `opsi_b` text,
  `opsi_c` text,
  `opsi_d` text,
  `opsi_e` text,
  PRIMARY KEY (`id_opsi`),
  KEY `FK_opsi_pilgan_soal` (`kd_soal`),
  KEY `FK_opsi_pilgan_paket_soal` (`kd_paket`),
  CONSTRAINT `FK_opsi_pilgan_paket_soal` FOREIGN KEY (`kd_paket`) REFERENCES `paket_soal` (`kd_paket`) ON DELETE CASCADE ON UPDATE CASCADE,
  CONSTRAINT `FK_opsi_pilgan_soal` FOREIGN KEY (`kd_soal`) REFERENCES `soal` (`kd_soal`) ON DELETE CASCADE ON UPDATE CASCADE
) ENGINE=InnoDB AUTO_INCREMENT=11 DEFAULT CHARSET=latin1;

-- Dumping data for table belajar_ci.opsi_pilgan: ~4 rows (approximately)
/*!40000 ALTER TABLE `opsi_pilgan` DISABLE KEYS */;
INSERT INTO `opsi_pilgan` (`id_opsi`, `kd_soal`, `kd_paket`, `opsi_a`, `opsi_b`, `opsi_c`, `opsi_d`, `opsi_e`) VALUES
	(5, 'SO0002', 'PS0001', 'jawaban 2A', 'jawaban 2B', 'jawaban 2C', 'jawaban 2D', 'jawaban 2E'),
	(6, 'SO0003', 'PS0001', 'DJSASDK', 'SDKALASDK', 'KLDASKLSDA', 'KLDASKLDFKS', 'NDDNDFKD'),
	(7, 'SO0004', 'PS0001', 'ASDASDDASA', 'DASSWEQ', 'DFFDS', 'FSDSDF', 'SDFFSD'),
	(8, 'SO0005', 'PS0001', 'DSASDSD', 'CXZXCZ', 'NBNV', 'BCVCVBV', 'DFGDF');
/*!40000 ALTER TABLE `opsi_pilgan` ENABLE KEYS */;

-- Dumping structure for table belajar_ci.paket_soal
CREATE TABLE IF NOT EXISTS `paket_soal` (
  `kd_paket` varchar(10) NOT NULL,
  `kd_matkul` varchar(10) DEFAULT NULL,
  `jenis_soal` int(11) DEFAULT NULL COMMENT '1 : essay, 2: pilgan, 3:koding',
  `waktu_soal` int(11) NOT NULL,
  `tanggal_buat` datetime NOT NULL,
  PRIMARY KEY (`kd_paket`)
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

-- Dumping data for table belajar_ci.paket_soal: ~4 rows (approximately)
/*!40000 ALTER TABLE `paket_soal` DISABLE KEYS */;
INSERT INTO `paket_soal` (`kd_paket`, `kd_matkul`, `jenis_soal`, `waktu_soal`, `tanggal_buat`) VALUES
	('PS0001', 'KM0001', 2, 60, '2020-11-01 16:06:00'),
	('PS0003', 'KM0001', 1, 90, '2020-10-17 09:16:00'),
	('PS0004', 'KM0001', 1, 50, '2020-10-17 09:32:00'),
	('PS0005', 'KM0001', 3, 60, '2020-10-26 20:54:00'),
	('PS0006', 'KM0007', 1, 30, '2020-10-30 15:27:00');
/*!40000 ALTER TABLE `paket_soal` ENABLE KEYS */;

-- Dumping structure for table belajar_ci.pelatihan
CREATE TABLE IF NOT EXISTS `pelatihan` (
  `kd_pelatihan` varchar(10) NOT NULL,
  `nama_pelatihan` varchar(150) DEFAULT NULL,
  `nip_dosen` varchar(50) DEFAULT NULL,
  `kd_matkul` varchar(10) DEFAULT NULL,
  `status` int(11) DEFAULT NULL COMMENT '1: aktif, 0: tidak aktif, 2:sudah berakhir',
  `nama_file` text,
  `tanggal_pelatihan` datetime DEFAULT NULL,
  PRIMARY KEY (`kd_pelatihan`)
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

-- Dumping data for table belajar_ci.pelatihan: ~2 rows (approximately)
/*!40000 ALTER TABLE `pelatihan` DISABLE KEYS */;
INSERT INTO `pelatihan` (`kd_pelatihan`, `nama_pelatihan`, `nip_dosen`, `kd_matkul`, `status`, `nama_file`, `tanggal_pelatihan`) VALUES
	('PL0001', 'Membuat Array Multidimensi', '20402', 'KM0001', 1, '1603968766_ijazah_ilham.pdf', '2020-10-31 00:14:00'),
	('PL0002', 'Membuat Timer', '20402', 'KM0001', 1, '1603972214_contoh.pdf', '2020-10-29 20:00:00');
/*!40000 ALTER TABLE `pelatihan` ENABLE KEYS */;

-- Dumping structure for table belajar_ci.pengaturan_ujian
CREATE TABLE IF NOT EXISTS `pengaturan_ujian` (
  `kd_pengawas` varchar(10) NOT NULL,
  `nama_pengawas` varchar(100) DEFAULT NULL,
  `nama_ujian` varchar(100) DEFAULT NULL,
  `kd_paket` varchar(10) DEFAULT NULL,
  `tanggal_ujian` datetime DEFAULT NULL,
  `batas_telat` int(11) DEFAULT NULL,
  `nip_dosen` varchar(50) DEFAULT NULL,
  `password` varchar(150) DEFAULT NULL,
  `status` int(11) DEFAULT NULL,
  PRIMARY KEY (`kd_pengawas`),
  KEY `FK_pengaturan_ujian_paket_soal` (`kd_paket`),
  CONSTRAINT `FK_pengaturan_ujian_paket_soal` FOREIGN KEY (`kd_paket`) REFERENCES `paket_soal` (`kd_paket`) ON DELETE CASCADE ON UPDATE CASCADE
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

-- Dumping data for table belajar_ci.pengaturan_ujian: ~3 rows (approximately)
/*!40000 ALTER TABLE `pengaturan_ujian` DISABLE KEYS */;
INSERT INTO `pengaturan_ujian` (`kd_pengawas`, `nama_pengawas`, `nama_ujian`, `kd_paket`, `tanggal_ujian`, `batas_telat`, `nip_dosen`, `password`, `status`) VALUES
	('KP0001', 'Ilham', 'UAS', 'PS0001', '2020-10-25 12:48:00', 20, '20402', '7110eda4d09e062aa5e4a390b0a572ac0d2c0220', 1),
	('KP0002', 'Ageng', 'UTS', 'PS0004', '2020-10-25 22:48:00', 20, '20402', '7110eda4d09e062aa5e4a390b0a572ac0d2c0220', 1),
	('KP0003', 'Tono', 'UTS', 'PS0005', '2020-10-27 15:28:00', 20, '20402', '7110eda4d09e062aa5e4a390b0a572ac0d2c0220', 1);
/*!40000 ALTER TABLE `pengaturan_ujian` ENABLE KEYS */;

-- Dumping structure for table belajar_ci.prodi
CREATE TABLE IF NOT EXISTS `prodi` (
  `kd_prodi` varchar(10) NOT NULL,
  `fakultas` varchar(10) DEFAULT NULL,
  `nama_prodi` varchar(150) DEFAULT NULL,
  PRIMARY KEY (`kd_prodi`),
  KEY `FK_prodi_fakultas` (`fakultas`),
  CONSTRAINT `FK_prodi_fakultas` FOREIGN KEY (`fakultas`) REFERENCES `fakultas` (`kd_fakultas`) ON DELETE SET NULL ON UPDATE CASCADE
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

-- Dumping data for table belajar_ci.prodi: ~4 rows (approximately)
/*!40000 ALTER TABLE `prodi` DISABLE KEYS */;
INSERT INTO `prodi` (`kd_prodi`, `fakultas`, `nama_prodi`) VALUES
	('0201', '020', 'Psikologi'),
	('0301', '030', 'Teknik Sipil'),
	('0302', '030', 'Teknik Kimia'),
	('0303', '030', 'Teknik Elektro'),
	('0304', '030', 'Teknik Informatika');
/*!40000 ALTER TABLE `prodi` ENABLE KEYS */;

-- Dumping structure for table belajar_ci.soal
CREATE TABLE IF NOT EXISTS `soal` (
  `kd_soal` varchar(10) NOT NULL,
  `kd_paket` varchar(10) DEFAULT NULL,
  `pertanyaan` text,
  `kunci_jawaban` varchar(10) DEFAULT NULL,
  PRIMARY KEY (`kd_soal`)
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

-- Dumping data for table belajar_ci.soal: ~11 rows (approximately)
/*!40000 ALTER TABLE `soal` DISABLE KEYS */;
INSERT INTO `soal` (`kd_soal`, `kd_paket`, `pertanyaan`, `kunci_jawaban`) VALUES
	('SO0002', 'PS0001', '<p>Pertanyaan 2</p>\r\n', 'A'),
	('SO0003', 'PS0001', '<p>Jika anda ingin menjalankan form diatas untuk diproses oleh PHP, kita perlu menambahkan beberapa atribut dan aturan untuk tag form.<strong>Tag input</strong>&nbsp;dengan atribut&nbsp;<strong>type=&rdquo;file&rdquo;</strong>&nbsp;adalah&nbsp;<strong>objek form</strong>&nbsp;yang digunakan untuk&nbsp;<strong>upload</strong>&nbsp;file. Pemrosesan&nbsp;<strong>upload</strong>&nbsp;sendiri akan banyak melibatkan web server (menggunakan PHP). Saya tidak akan membahasnya pemograman PHPnya, namun akan fokus pada kode HTML yang diperlukan.</p>\r\n', 'A'),
	('SO0004', 'PS0001', '<p>Halo ! Cuma Coder kali ini akan membagikan tutorial mengenai Upload Gambar (Image) pada framework CodeIgniter 3. Tutorial ini selain membahas tentang Upload Gambar kita akan sekaligus membahas mengenai fungsi rename (mengubah nama file gambar) dan resize (merubah ukuran gambar ) setelah kira melakukan upload.&nbsp;</p>\r\n\r\n<p>Di dalam framework CodeIgniter sendiri juga sudah disediakan library upload dan image_lib (library untuk manipulasi gambar) . Pastikan kedua library tersebut sudah ada pada folder library CodeIgniter 3. Biasanya sih sudah ada kalau kita mendownload CodeIgniter dari web resminya.</p>\r\n', 'C'),
	('SO0005', 'PS0001', '<ol>\r\n	<li>Karena kita menggunakan Bootstrap silahkan&nbsp;<a href="https://cumalinkcoder.blogspot.com/p/generate.html?url=aHR0cDovL2dldGJvb3RzdHJhcC5jb20v" rel="nofollow" target="_blank">Download Bootstrap</a>&nbsp;dan letakan di folder&nbsp;<strong>assets</strong></li>\r\n	<li>Setting default controller menjadi upload di&nbsp;<strong>config/routes.php</strong></li>\r\n	<li>Karena kita menggunakan library upload dan library&nbsp;image_lib serta penyimpanan data kedatabase. maka kita load libray tersebut secara otomatis di&nbsp;<strong>config/autoload.php</strong></li>\r\n	<li>Sebaiknya kita menghilangkan index.php pada url untuk mepercantik url.</li>\r\n</ol>\r\n', 'E'),
	('SO0006', 'PS0003', '<p>sdaasddassdasdsdasdaasdsda</p>\r\n', '-'),
	('SO0007', 'PS0003', '<p>dasdaadassssssssssssssssssssssssssssssasdaaaaaaaaaaaaaaaaaaaaadsadasdasssssssssssasddddddddddd</p>\r\n', '-'),
	('SO0008', 'PS0004', '<p>Sebutkan cara membuat foriegn key !</p>\r\n', '-'),
	('SO0009', 'PS0004', '<p>Sebutkan cara membuat database dari gambar diatas&nbsp;!</p>\r\n', '-'),
	('SO0010', 'PS0004', '<p>Jelaskan pengertian oop !</p>\r\n', '-'),
	('SO0011', 'PS0004', '<p>Jelaskan cara membuat primary key</p>\r\n', '-'),
	('SO0012', 'PS0004', '<p>Sebutkan cara menginstall xampp !</p>\r\n', '-');
/*!40000 ALTER TABLE `soal` ENABLE KEYS */;

-- Dumping structure for table belajar_ci.tugas
CREATE TABLE IF NOT EXISTS `tugas` (
  `kd_tugas` varchar(10) NOT NULL,
  `kd_matkul` varchar(15) NOT NULL,
  `judul_tugas` varchar(50) DEFAULT NULL,
  `tanggal_uplod` datetime DEFAULT NULL,
  `batas_waktu` datetime DEFAULT NULL,
  `kelas` varchar(10) DEFAULT NULL,
  `nip_dosen` varchar(15) DEFAULT NULL,
  `keterangan` text,
  `semester` int(11) DEFAULT NULL,
  PRIMARY KEY (`kd_tugas`)
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

-- Dumping data for table belajar_ci.tugas: ~2 rows (approximately)
/*!40000 ALTER TABLE `tugas` DISABLE KEYS */;
INSERT INTO `tugas` (`kd_tugas`, `kd_matkul`, `judul_tugas`, `tanggal_uplod`, `batas_waktu`, `kelas`, `nip_dosen`, `keterangan`, `semester`) VALUES
	('T0004', 'KM0007', 'Membuat Database Penjualan', '2020-09-27 15:03:00', '2020-10-08 10:45:00', 'K0006', '232323', 'Kerjakan Individu', 2),
	('T0005', 'KM0001', 'Membuat Program Kalkulator Sederhana', '2020-09-27 22:48:00', '2020-10-07 22:49:00', 'K0004', '20402', 'Kerjakan dengan individu dan mengerjakan menggunakan bahasa c#', 1),
	('T0006', 'KM0001', 'Membuat PROGRAM APLIKASI', '2020-10-25 12:50:00', '2020-10-25 14:00:00', 'K0004', '20402', 'KSDJASDJK', 1),
	('T0007', 'KM0001', 'Membuat Rancangan Database', '2020-10-25 21:38:00', '2020-10-25 23:00:00', 'K0004', '20402', 'Kerjakan dengan Serius', 1);
/*!40000 ALTER TABLE `tugas` ENABLE KEYS */;

-- Dumping structure for table belajar_ci.upload_gambar_soal
CREATE TABLE IF NOT EXISTS `upload_gambar_soal` (
  `id_gambar` int(11) NOT NULL AUTO_INCREMENT,
  `kd_soal` varchar(10) DEFAULT NULL,
  `nama_file` text,
  `kd_paket` varchar(10),
  PRIMARY KEY (`id_gambar`),
  KEY `FK_upload_gambar_soal_soal` (`kd_soal`),
  KEY `FK_upload_gambar_soal_paket_soal` (`kd_paket`),
  CONSTRAINT `FK_upload_gambar_soal_paket_soal` FOREIGN KEY (`kd_paket`) REFERENCES `paket_soal` (`kd_paket`) ON DELETE CASCADE ON UPDATE CASCADE,
  CONSTRAINT `FK_upload_gambar_soal_soal` FOREIGN KEY (`kd_soal`) REFERENCES `soal` (`kd_soal`) ON DELETE CASCADE ON UPDATE CASCADE
) ENGINE=InnoDB AUTO_INCREMENT=13 DEFAULT CHARSET=latin1;

-- Dumping data for table belajar_ci.upload_gambar_soal: ~8 rows (approximately)
/*!40000 ALTER TABLE `upload_gambar_soal` DISABLE KEYS */;
INSERT INTO `upload_gambar_soal` (`id_gambar`, `kd_soal`, `nama_file`, `kd_paket`) VALUES
	(5, 'SO0003', '16029090610_1.PNG', 'PS0001'),
	(6, 'SO0004', '16029090611_2.PNG', 'PS0001'),
	(7, 'SO0005', '16029090612_3.PNG', 'PS0001'),
	(8, 'SO0006', '16029448130_1.PNG', 'PS0003'),
	(9, 'SO0007', '16029448131_2.PNG', 'PS0003'),
	(10, 'SO0008', '16036408110_1.PNG', 'PS0004'),
	(11, 'SO0009', '16036408111_2.PNG', 'PS0004'),
	(12, 'SO0012', '16036408114_5.PNG', 'PS0004');
/*!40000 ALTER TABLE `upload_gambar_soal` ENABLE KEYS */;

-- Dumping structure for table belajar_ci.upload_materi
CREATE TABLE IF NOT EXISTS `upload_materi` (
  `id_materi` int(11) NOT NULL AUTO_INCREMENT,
  `token` varchar(50) DEFAULT NULL,
  `kd_jadwal` varchar(10) DEFAULT NULL,
  `nama_file` text,
  `error` text,
  PRIMARY KEY (`id_materi`),
  KEY `FK_upload_materi_jadwal` (`kd_jadwal`)
) ENGINE=InnoDB AUTO_INCREMENT=19 DEFAULT CHARSET=latin1;

-- Dumping data for table belajar_ci.upload_materi: ~3 rows (approximately)
/*!40000 ALTER TABLE `upload_materi` DISABLE KEYS */;
INSERT INTO `upload_materi` (`id_materi`, `token`, `kd_jadwal`, `nama_file`, `error`) VALUES
	(7, '0.9691521643400498', 'J0001', 'mantab.PNG', NULL),
	(12, '0.8411260636785971', 'J0002', 'bnsp.pdf', NULL),
	(14, '0.6052885156119165', 'J0002', 'ktp.pdf', NULL),
	(16, '0.1925481151543864', 'J0003', 'sdfs.PNG', NULL),
	(18, '0.6335853789533554', 'J0004', 'loss3.PNG', NULL);
/*!40000 ALTER TABLE `upload_materi` ENABLE KEYS */;

-- Dumping structure for table belajar_ci.upload_soal_program
CREATE TABLE IF NOT EXISTS `upload_soal_program` (
  `id_upload` int(11) NOT NULL AUTO_INCREMENT,
  `kd_paket` varchar(10) DEFAULT NULL,
  `nama_file` varchar(150) DEFAULT NULL,
  `nip_dosen` varchar(10) DEFAULT NULL,
  `error` text,
  PRIMARY KEY (`id_upload`),
  KEY `FK_upload_soal_program_paket_soal` (`kd_paket`),
  CONSTRAINT `FK_upload_soal_program_paket_soal` FOREIGN KEY (`kd_paket`) REFERENCES `paket_soal` (`kd_paket`) ON DELETE CASCADE ON UPDATE CASCADE
) ENGINE=InnoDB AUTO_INCREMENT=14 DEFAULT CHARSET=latin1;

-- Dumping data for table belajar_ci.upload_soal_program: ~2 rows (approximately)
/*!40000 ALTER TABLE `upload_soal_program` DISABLE KEYS */;
INSERT INTO `upload_soal_program` (`id_upload`, `kd_paket`, `nama_file`, `nip_dosen`, `error`) VALUES
	(9, NULL, NULL, NULL, '<p>You did not select a file to upload.</p>'),
	(12, 'PS0005', '1603720442_contoh.pdf', '20402', NULL);
/*!40000 ALTER TABLE `upload_soal_program` ENABLE KEYS */;

-- Dumping structure for table belajar_ci.upload_tugas
CREATE TABLE IF NOT EXISTS `upload_tugas` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `token` varchar(50) NOT NULL,
  `kd_tugas` varchar(10) DEFAULT NULL,
  `nama_file` text,
  `error` text NOT NULL,
  PRIMARY KEY (`id`),
  KEY `FK_upload_tugas_tugas` (`kd_tugas`)
) ENGINE=InnoDB AUTO_INCREMENT=54 DEFAULT CHARSET=latin1;

-- Dumping data for table belajar_ci.upload_tugas: ~6 rows (approximately)
/*!40000 ALTER TABLE `upload_tugas` DISABLE KEYS */;
INSERT INTO `upload_tugas` (`id`, `token`, `kd_tugas`, `nama_file`, `error`) VALUES
	(44, '0.5467779094512175', 'T0004', 'fddf.pdf', ''),
	(45, '0.9573895483984076', 'T0005', 'ddfe.PNG', ''),
	(46, '0.35794022844362083', 'T0005', 'contoh.pdf', ''),
	(50, '0.7802114934832569', 'T0006', 'ENDI.PNG', ''),
	(52, '0.5889501201389058', 'T0007', 'zafirah1.PNG', ''),
	(53, '0.3455919999916559', 'T0008', 'ktp.PNG', '');
/*!40000 ALTER TABLE `upload_tugas` ENABLE KEYS */;

-- Dumping structure for table belajar_ci.upload_tugas_mhs
CREATE TABLE IF NOT EXISTS `upload_tugas_mhs` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `kd_tugas` varchar(15) NOT NULL DEFAULT '0',
  `nim` varchar(50) NOT NULL DEFAULT '0',
  `nama_file` text,
  `token` varchar(50) DEFAULT NULL,
  `error` text,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=12 DEFAULT CHARSET=latin1;

-- Dumping data for table belajar_ci.upload_tugas_mhs: ~1 rows (approximately)
/*!40000 ALTER TABLE `upload_tugas_mhs` DISABLE KEYS */;
INSERT INTO `upload_tugas_mhs` (`id`, `kd_tugas`, `nim`, `nama_file`, `token`, `error`) VALUES
	(8, 'T0004', '16030040015', 'kehh.PNG', '0.8992920692130613', NULL),
	(9, 'T0004', '16030040015', 'JSJSD.PNG', '0.6727834620673241', NULL),
	(10, 'T0006', '16030040015', 'loss2.PNG', '0.7837863898410768', NULL),
	(11, 'T0007', '16030040015', 'mantab.PNG', '0.6200323112562414', NULL);
/*!40000 ALTER TABLE `upload_tugas_mhs` ENABLE KEYS */;

-- Dumping structure for table belajar_ci.user
CREATE TABLE IF NOT EXISTS `user` (
  `user_id` int(11) NOT NULL AUTO_INCREMENT,
  `name` varchar(250) DEFAULT NULL,
  `username` varchar(250) DEFAULT NULL,
  `password` varchar(150) DEFAULT NULL,
  `level` varchar(50) DEFAULT NULL,
  PRIMARY KEY (`user_id`)
) ENGINE=InnoDB AUTO_INCREMENT=2 DEFAULT CHARSET=latin1;

-- Dumping data for table belajar_ci.user: ~0 rows (approximately)
/*!40000 ALTER TABLE `user` DISABLE KEYS */;
INSERT INTO `user` (`user_id`, `name`, `username`, `password`, `level`) VALUES
	(1, 'Ilham Muhammad Prasetyo', 'admin', '21232f297a57a5a743894a0e4a801fc3', 'Admin');
/*!40000 ALTER TABLE `user` ENABLE KEYS */;

/*!40101 SET SQL_MODE=IFNULL(@OLD_SQL_MODE, '') */;
/*!40014 SET FOREIGN_KEY_CHECKS=IF(@OLD_FOREIGN_KEY_CHECKS IS NULL, 1, @OLD_FOREIGN_KEY_CHECKS) */;
/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
