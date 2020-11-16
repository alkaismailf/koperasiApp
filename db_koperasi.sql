-- phpMyAdmin SQL Dump
-- version 4.8.2
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Generation Time: Feb 07, 2019 at 10:36 AM
-- Server version: 10.1.34-MariaDB
-- PHP Version: 7.2.8

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
SET AUTOCOMMIT = 0;
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `db_koperasi`
--

-- --------------------------------------------------------

--
-- Table structure for table `tb_ambil`
--

CREATE TABLE `tb_ambil` (
  `no_ambil` varchar(100) NOT NULL,
  `id_anggota` varchar(100) NOT NULL,
  `jml_ambil` int(11) NOT NULL,
  `tgl_ambil` date NOT NULL,
  `id_karyawan` varchar(100) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `tb_ambil`
--

INSERT INTO `tb_ambil` (`no_ambil`, `id_anggota`, `jml_ambil`, `tgl_ambil`, `id_karyawan`) VALUES
('AB001', 'M001', 100000, '2018-09-06', 'K002'),
('AB002', 'M001', 200000, '2018-11-07', 'K001'),
('AB003', 'M002', 350000, '2018-11-14', 'K002'),
('AB004', 'M004', 400000, '2018-12-20', 'K003'),
('AB005', 'M005', 200000, '2018-12-31', 'K003');

-- --------------------------------------------------------

--
-- Table structure for table `tb_anggota`
--

CREATE TABLE `tb_anggota` (
  `id_anggota` varchar(100) NOT NULL,
  `nik` varchar(100) NOT NULL,
  `nama` varchar(100) NOT NULL,
  `jekel` enum('L','P') NOT NULL,
  `ttl` varchar(100) NOT NULL,
  `email` varchar(100) NOT NULL,
  `no_telp` varchar(100) NOT NULL,
  `status` enum('Aktif','Tidak Aktif') NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `tb_anggota`
--

INSERT INTO `tb_anggota` (`id_anggota`, `nik`, `nama`, `jekel`, `ttl`, `email`, `no_telp`, `status`) VALUES
('M001', '098177492818', 'Johnny', 'L', 'Bandung, 04-12-1991', 'johnny@gmail.com', '084927716221', 'Aktif'),
('M002', '019274112883', 'Ujang Pantry', 'L', 'Cirebon, 13-08-1991', 'ujang.pantry@yahoo.com', '085829112654', 'Aktif'),
('M003', '09816582913', 'Jihan', 'P', 'Garut, 17-12-1995', 'jihan1712@gmail.com', '085764829116', 'Aktif'),
('M004', '997629100817', 'Zaenab ', 'P', 'Jakarta, 14-04-1993', 'zaenab@yahoo.com', '085276392210', 'Aktif'),
('M005', '998230175543', 'Lesti Minerva', 'P', 'Palembang, 11-03-1994', 'lesti.mnrv@gmail.com', '085817229375', 'Aktif');

-- --------------------------------------------------------

--
-- Table structure for table `tb_berita`
--

CREATE TABLE `tb_berita` (
  `id_berita` int(11) NOT NULL,
  `judul` varchar(100) NOT NULL,
  `konten` text NOT NULL,
  `penulis` varchar(100) NOT NULL,
  `tgl_buat` date NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `tb_berita`
--

INSERT INTO `tb_berita` (`id_berita`, `judul`, `konten`, `penulis`, `tgl_buat`) VALUES
(1, 'Jokowi Ingin Koperasi Indonesia Mendunia', 'Liputan6.com, Jakarta- Presiden Joko Widodo (Jokowi) meminta koperasi-koperasi nasional belajar dari yang terbaik-terbaik di dunia sehingga kelak ada koperasi dari Indonesia yang masuk ke-100 besar koperasi global atau 300 besar koperasi global.\r\n\r\n“Saya tadi sudah sampaikan, Kospin Jasa sudah melantai di bursa. Saya tahu koperasi Sidogiri juga omzetnya/perputaran uangnya sudah lebih dari Rp 16 triliun. Seperti ini yang harus diikuti oleh koperasi-koperasi yang lain,” kata Jokowi seperti dikutip dari laman Setkab, Jumata (13/7/2018).\r\n\r\nJokowi mencontohkan, Koperasi Fonterra dari Selandia Baru, yang bergerak di bidang susu dan produk susu yang dimiliki bersama oleh 10.500 petani, menghasilkan omzet 17,2 miliar dolar Selandia Baru atau sekitar Rp 165 triliun per tahun.\r\n\r\n“Coba datangi saja Fonterra. Memulainya dari seperti apa, kemudian berkembang menjadi Rp 165 triliun per tahun itu kuncinya di mana. Belajar di sana seminggu, 2 minggu atau 3 minggu,” tutur Jokowi.\r\n\r\nIa menyampaikan bahwa kita pintar kalau disuruh meng-menjiplak atau meniru. Namun, menurutnya, tidak apa-apa, modifikasi menjadi lebih dari Fonterra. “Tiru, modifikasi sedikit, melompat kita,” ujarJokowi.\r\n\r\nDengan omzet Rp 165 triliun per tahun, ucap Presiden, Fonterra telah menjadi perusahaan terbesar di Selandia baru baru. “Kita ingin di Indonesia juga sama, ada perusahaan Indonesia yang terbesar, dan itu adalah koperasi. Pak Menteri dan Pak Ketua Dekopin, ajak bareng-bareng ke sana, tapi jangan banyak belanjanya. Ke sana untuk betul-betul belajar, bagaimana mereka me-manage koperasinya sehingga menjadi perusahaan terbesar di Selandia Baru,” tutur Jokowi.', 'Tommy Kurnia', '2018-07-13'),
(2, 'Koperasi Masa Kini Harus Berkonsep Digital', 'Liputan6.com, Jakarta - Koperasi merupakan kekuatan utama ekonomi Indonesia. Hal ini ketika menghadapi krisis ekonomi 1997 dan 2008, ekonomi Indonesia tetap bisa bertahan karena peran koperasi yang begitu dominan.\r\n\r\n“Kenapa ini terjadi? Karena kita tahu bahwa koperasi itu telah menjadi tiang utama dari ekonomi kita secara nasional,” kata Sekretaris Kabinet (Seskab) Pramono Anung, dikutip dari laman Setkab, Kamis (12/7/2018).\r\n\r\nIbarat dalam aliran darah, koperasi merupakan urat nadi utama di dalam kehidupan berbangsa dan bernegara terutama di bidang ekonomi. Karena itu, pemerintah tentunya harus memfasilitasi, menjaga, dan membuat koperasi bisa tumbuh dan berkembang menjadi lebih baik.\r\n\r\nNamun dalam era digital saat ini, Seskab Pramono Anung mengakui, koperasi tidak hanya perlu melakukan modernisasi. Tetapi juga harus menyesuaikan cara berpikir, konsep, pendekatan.\r\n\r\n“Koperasi harus masuk pada wilayah itu, semakin dekat antar konsumen dimanapun berada dengan koperasi maupun dengan produsen kita,” tutur Seskab.\r\n\r\nPramono meyakini, kalau bisa dikelola dengan baik, dan masuk dengan menggunakan digital sebagai sarana untuk itu, maka koperasi akan menjadi semakin kuat, semakin besar sehingga bisa menopang pertumbuhan ekonomi nasional semakin baik.', 'Arthur Gideon', '2018-07-12'),
(3, 'Uji coba posting', 'Post ini adalah uji coba', 'Ismail', '2018-12-19');

-- --------------------------------------------------------

--
-- Table structure for table `tb_dokumen`
--

CREATE TABLE `tb_dokumen` (
  `id_dokumen` int(11) NOT NULL,
  `nama_file` varchar(100) NOT NULL,
  `file` varchar(200) NOT NULL,
  `keterangan` varchar(100) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `tb_dokumen`
--

INSERT INTO `tb_dokumen` (`id_dokumen`, `nama_file`, `file`, `keterangan`) VALUES
(1, 'Data Simpan Koperasi Sejahtera', '1536049081.pdf', 'Data penyimpanan uang pada Koperasi Sejahtera keseluruhan'),
(4, 'Data Ambil Koperasi Sejahtera', '1536389988.pdf', 'Data pengambilan uang Koperasi Sejahtera keseluruhan'),
(6, 'Data Pinjam Koperasi Sejahtera', '1545189386.pdf', 'Data peminjaman uang Koperasi Sejahtera keseluruhan'),
(7, 'tester', '1545233824.txt', 'coba-coba');

-- --------------------------------------------------------

--
-- Table structure for table `tb_karyawan`
--

CREATE TABLE `tb_karyawan` (
  `id_karyawan` varchar(100) NOT NULL,
  `nama` varchar(100) NOT NULL,
  `jekel` enum('L','P') NOT NULL,
  `ttl` varchar(100) NOT NULL,
  `email` varchar(100) NOT NULL,
  `no_telp` varchar(100) NOT NULL,
  `tgl_masuk_kerja` date NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `tb_karyawan`
--

INSERT INTO `tb_karyawan` (`id_karyawan`, `nama`, `jekel`, `ttl`, `email`, `no_telp`, `tgl_masuk_kerja`) VALUES
('K001', 'Ishak', 'L', 'Cirebon, 15-01-1989', 'ishak1501@yahoo.com', '085742310984', '2018-08-22'),
('K002', 'Rini Aulia', 'P', 'Jakarta, 04-05-1994', 'riniaul@gmail.com', '087856401245', '2018-09-02'),
('K003', 'Maulana Saputra', 'L', 'Tasikmalaya, 12-12-1990', 'maulana.saputra@gmail.com', '085256902356', '2018-09-18'),
('K004', 'Elisa Natalegawa', 'P', 'Pontianak, 21-05-1993', 'elisa_nata@gmail.com', '085256123360', '2018-10-02');

-- --------------------------------------------------------

--
-- Table structure for table `tb_masterdata`
--

CREATE TABLE `tb_masterdata` (
  `id` int(10) NOT NULL,
  `username` varchar(100) NOT NULL,
  `namauser` varchar(100) NOT NULL,
  `emailuser` varchar(100) NOT NULL,
  `nohpuser` varchar(100) NOT NULL,
  `password` varchar(100) NOT NULL,
  `token` varchar(100) NOT NULL,
  `roletype` enum('Anggota','Karyawan','Manajemen dan Pengurus','System Admin') NOT NULL,
  `auth_key` varchar(100) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `tb_masterdata`
--

INSERT INTO `tb_masterdata` (`id`, `username`, `namauser`, `emailuser`, `nohpuser`, `password`, `token`, `roletype`, `auth_key`) VALUES
(1, 'admin', 'Alka Ismail', 'alka.ismail@gmail.com', '085770930430', 'admin', '', 'System Admin', ''),
(2, 'K001', 'Ishak', 'ishak1501@yahoo.com', '085742310984', '1111', '', 'Karyawan', ''),
(3, 'M001', 'Johnny', 'johnny@gmail.com', '084927716221', '1111', '', 'Anggota', ''),
(4, 'manager', 'Alexander', 'alex.ander@gmail.com', '089547613040', 'manager', '', 'Manajemen dan Pengurus', ''),
(5, 'M002', 'Ujang Pantry', 'ujang.pantry@yahoo.com', '085829112654', '2222', '', 'Anggota', 'N-YhW3FKUuVmy5tdNT09vva1go-HwIZj'),
(6, 'M003', 'Jihan', 'jihan1712@gmail.com', '085764829116', '3333', '', 'Anggota', 'jJNXAbTCYa6Aif0vdopDkHT9ne0du0s5'),
(7, 'M004', 'Zaenab', 'zaenab@yahoo.com', '085276392210', '4444', '', 'Anggota', 'fF9ekYAn12bgXVlnL-KMem99BwifIOgX'),
(8, 'M005', 'Lesti Minerva', 'lesti.mnrv@gmail.com', '085817229375', '5555', '', 'Anggota', '_ROe8Icvl-EDirXMX8BIvWABnJZXPQs3'),
(9, 'K002', 'Rini Aulia', 'riniaul@gmail.com', '087856401245', '2222', '', 'Karyawan', 'DwvzHPlvVozpQoI03ytKFrtoGN8iCFr9'),
(10, 'K003', 'Maulana Saputra', 'maulana.saputra@gmail.com', '085256902356', '3333', '', 'Karyawan', 'IFrr8UFTP5YCGCod04GHtFvux_kh9XL2'),
(11, 'K004', 'Elisa Natalegawa', 'elisa_nata@gmail.com', '085256123360', '4444', '', 'Karyawan', 'pjOCtTXlsUg5-EEnPhv-HM8z0IOWfG-9');

-- --------------------------------------------------------

--
-- Table structure for table `tb_pinjam`
--

CREATE TABLE `tb_pinjam` (
  `no_pinjam` varchar(100) NOT NULL,
  `id_anggota` varchar(100) NOT NULL,
  `jml_pinjam` int(11) NOT NULL,
  `tenor` date NOT NULL,
  `tgl_pinjam` date NOT NULL,
  `cicilan` int(100) NOT NULL,
  `bayar_cicilan` int(100) DEFAULT NULL,
  `id_karyawan` varchar(100) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `tb_pinjam`
--

INSERT INTO `tb_pinjam` (`no_pinjam`, `id_anggota`, `jml_pinjam`, `tenor`, `tgl_pinjam`, `cicilan`, `bayar_cicilan`, `id_karyawan`) VALUES
('PJ001', 'M003', 1000000, '2019-08-03', '2018-10-03', 100000, 0, 'K001'),
('PJ002', 'M002', 750000, '2019-01-16', '2018-10-16', 250000, 0, 'K002'),
('PJ003', 'M003', 500000, '2019-03-22', '2018-11-22', 125000, 0, 'K001'),
('PJ004', 'M002', 300000, '2019-04-25', '2018-11-25', 60000, 0, 'K001'),
('PJ005', 'M001', 1500000, '2019-06-16', '2018-12-16', 250000, 3, 'K003');

-- --------------------------------------------------------

--
-- Table structure for table `tb_simpan`
--

CREATE TABLE `tb_simpan` (
  `no_simpan` varchar(100) NOT NULL,
  `id_anggota` varchar(100) NOT NULL,
  `jml_simpan` int(11) NOT NULL,
  `tgl_simpan` date NOT NULL,
  `id_karyawan` varchar(100) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `tb_simpan`
--

INSERT INTO `tb_simpan` (`no_simpan`, `id_anggota`, `jml_simpan`, `tgl_simpan`, `id_karyawan`) VALUES
('SP001', 'M001', 500000, '2018-09-03', 'K001'),
('SP002', 'M002', 750000, '2018-09-07', 'K001'),
('SP003', 'M001', 250000, '2018-12-11', 'K002'),
('SP004', 'M002', 500000, '2018-12-12', 'K002'),
('SP005', 'M002', 300000, '2018-12-15', 'K001'),
('SP006', 'M004', 750000, '2018-12-19', 'K003'),
('SP007', 'M005', 1000000, '2018-12-22', 'K004'),
('SP008', 'M001', 500000, '2019-01-12', 'K001');

--
-- Indexes for dumped tables
--

--
-- Indexes for table `tb_ambil`
--
ALTER TABLE `tb_ambil`
  ADD PRIMARY KEY (`no_ambil`),
  ADD KEY `id_anggota` (`id_anggota`),
  ADD KEY `id_karyawan` (`id_karyawan`);

--
-- Indexes for table `tb_anggota`
--
ALTER TABLE `tb_anggota`
  ADD PRIMARY KEY (`id_anggota`);

--
-- Indexes for table `tb_berita`
--
ALTER TABLE `tb_berita`
  ADD PRIMARY KEY (`id_berita`);

--
-- Indexes for table `tb_dokumen`
--
ALTER TABLE `tb_dokumen`
  ADD PRIMARY KEY (`id_dokumen`);

--
-- Indexes for table `tb_karyawan`
--
ALTER TABLE `tb_karyawan`
  ADD PRIMARY KEY (`id_karyawan`);

--
-- Indexes for table `tb_masterdata`
--
ALTER TABLE `tb_masterdata`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `tb_pinjam`
--
ALTER TABLE `tb_pinjam`
  ADD PRIMARY KEY (`no_pinjam`),
  ADD KEY `id_anggota` (`id_anggota`),
  ADD KEY `id_karyawan` (`id_karyawan`);

--
-- Indexes for table `tb_simpan`
--
ALTER TABLE `tb_simpan`
  ADD PRIMARY KEY (`no_simpan`),
  ADD KEY `id_anggota` (`id_anggota`),
  ADD KEY `id_karyawan` (`id_karyawan`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `tb_berita`
--
ALTER TABLE `tb_berita`
  MODIFY `id_berita` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=4;

--
-- AUTO_INCREMENT for table `tb_dokumen`
--
ALTER TABLE `tb_dokumen`
  MODIFY `id_dokumen` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=8;

--
-- AUTO_INCREMENT for table `tb_masterdata`
--
ALTER TABLE `tb_masterdata`
  MODIFY `id` int(10) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=12;

--
-- Constraints for dumped tables
--

--
-- Constraints for table `tb_ambil`
--
ALTER TABLE `tb_ambil`
  ADD CONSTRAINT `tb_ambil_ibfk_1` FOREIGN KEY (`id_anggota`) REFERENCES `tb_anggota` (`id_anggota`),
  ADD CONSTRAINT `tb_ambil_ibfk_2` FOREIGN KEY (`id_karyawan`) REFERENCES `tb_karyawan` (`id_karyawan`);

--
-- Constraints for table `tb_pinjam`
--
ALTER TABLE `tb_pinjam`
  ADD CONSTRAINT `tb_pinjam_ibfk_1` FOREIGN KEY (`id_anggota`) REFERENCES `tb_anggota` (`id_anggota`),
  ADD CONSTRAINT `tb_pinjam_ibfk_2` FOREIGN KEY (`id_karyawan`) REFERENCES `tb_karyawan` (`id_karyawan`);

--
-- Constraints for table `tb_simpan`
--
ALTER TABLE `tb_simpan`
  ADD CONSTRAINT `tb_simpan_ibfk_1` FOREIGN KEY (`id_anggota`) REFERENCES `tb_anggota` (`id_anggota`),
  ADD CONSTRAINT `tb_simpan_ibfk_2` FOREIGN KEY (`id_karyawan`) REFERENCES `tb_karyawan` (`id_karyawan`);
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
