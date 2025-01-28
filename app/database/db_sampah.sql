-- phpMyAdmin SQL Dump
-- version 5.2.1
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Generation Time: Jan 28, 2025 at 02:19 AM
-- Server version: 10.4.32-MariaDB
-- PHP Version: 8.2.12

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `db_sampah`
--

-- --------------------------------------------------------

--
-- Table structure for table `admins`
--

CREATE TABLE `admins` (
  `IdAdmin` varchar(6) NOT NULL,
  `namaAdmin` varchar(30) NOT NULL,
  `usernameAdmin` varchar(20) NOT NULL,
  `passwordAdmin` varchar(20) NOT NULL,
  `level` varchar(10) NOT NULL,
  `gambar` varchar(200) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `admins`
--

INSERT INTO `admins` (`IdAdmin`, `namaAdmin`, `usernameAdmin`, `passwordAdmin`, `level`, `gambar`) VALUES
('ADM001', 'Super Admin', 'superadmin', 'superadmin', 'admin', '60b75bde91748.png');

-- --------------------------------------------------------

--
-- Table structure for table `berita`
--

CREATE TABLE `berita` (
  `idBerita` varchar(6) NOT NULL,
  `judul` varchar(100) NOT NULL,
  `isi` text NOT NULL,
  `gambar` varchar(100) NOT NULL,
  `sumber` varchar(300) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

-- --------------------------------------------------------

--
-- Table structure for table `penarikan`
--

CREATE TABLE `penarikan` (
  `idTarik` varchar(6) NOT NULL,
  `idUser` varchar(6) NOT NULL,
  `namaUser` varchar(30) NOT NULL,
  `tglTarik` date NOT NULL,
  `jmlPenarikan` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

-- --------------------------------------------------------

--
-- Table structure for table `penjualan`
--

CREATE TABLE `penjualan` (
  `idJual` varchar(6) NOT NULL,
  `idSampah` varchar(6) NOT NULL,
  `berat` varchar(15) NOT NULL,
  `tglPenjualan` date NOT NULL,
  `namaPembeli` varchar(30) NOT NULL,
  `nomorPembeli` varchar(13) NOT NULL,
  `harga` int(11) NOT NULL,
  `totalPendapatan` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

-- --------------------------------------------------------

--
-- Table structure for table `saldo_bank`
--

CREATE TABLE `saldo_bank` (
  `idTransaksi` varchar(6) NOT NULL,
  `aksi` enum('Penambahan','Pengurangan') NOT NULL,
  `tanggal` date NOT NULL,
  `aktor` varchar(6) NOT NULL,
  `jumlah` int(11) NOT NULL,
  `totalSaldo` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

-- --------------------------------------------------------

--
-- Table structure for table `sampah`
--

CREATE TABLE `sampah` (
  `idSampah` varchar(6) NOT NULL,
  `jenisSampah` varchar(15) NOT NULL,
  `namaSampah` varchar(30) NOT NULL,
  `satuan` varchar(5) NOT NULL,
  `harga` int(11) NOT NULL,
  `gambar` varchar(200) NOT NULL,
  `deskripsi` varchar(400) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `sampah`
--

INSERT INTO `sampah` (`idSampah`, `jenisSampah`, `namaSampah`, `satuan`, `harga`, `gambar`, `deskripsi`) VALUES
('SMP001', 'Anorganik', 'Kresek', 'KG', 200, '60d468d995875.jpg', 'Semua jenis kresek (warna apapun)'),
('SMP002', 'Anorganik', 'Plastik', 'KG', 600, '60c0a74d10227.jpg', 'Semua jenis plastik'),
('SMP003', 'Anorganik', 'Karah warna', 'KG', 600, '60c0a75ce594a.jpg', 'Yang dapat dikumpulkan seperti sampah bekas shampoo, sabun, handbody, dll.'),
('SMP004', 'Anorganik', 'botol mineral plastik', 'KG', 1500, '60c0a6224066b.jpg', 'Semua jenis botol plastik yang berbahan plastik.'),
('SMP005', 'Anorganik', 'Botol mineral kaca', 'KG', 200, '60c0a77d59f11.jpg', 'Semua jenis botol yang berbahan kaca.'),
('SMP006', 'Anorganik', 'Gelas mineral plastik', 'KG', 1500, '60c0a7992a1af.jpg', 'Semua jenis gelas mineral yang berbahan plastik.'),
('SMP007', 'Anorganik', 'Kaleng', 'KG', 600, '60c0a7a9ce00e.jpg', 'Semua jenis kaleng.'),
('SMP008', 'Anorganik', 'Kardus/Karton', 'KG', 1100, '60c0a7bcdf002.jpg', 'Semua jenis kardus/karton.'),
('SMP009', 'Organik', 'Dedaunan', 'KG', 100, '60c0a7c765fee.jpg', 'Semua jenis dedaunan yang nantinya dapat diolah menjadi pupuk.'),
('SMP010', 'Organik', 'Sampah hasil masak', 'KG', 50, '60c0a7d21f406.jpeg', 'Semua sampah sisa hasil masak dapat dikumpulkan.'),
('SMP011', 'Anorganik', 'Besi', 'KG', 1000, '60c0a7e0df741.jpg', 'Semua jenis besi.'),
('SMP012', 'Anorganik', 'Baja', 'KG', 1500, '60c0a7f2891ef.jfif', 'Semua jenis baja.'),
('SMP013', 'Anorganik', 'Tembaga', 'KG', 45000, '60c0a801c1069.jpg', 'Semua jenis tembaga.'),
('SMP014', 'Anorganik', 'Aluminium', 'KG', 7000, '60c0a80e7a6cb.jpg', 'Semua jenis aluminium.'),
('SMP015', 'Anorganik', 'Zeng', 'KG', 250, '60c0a8236ab5a.png', 'Semua jenis zeng.'),
('SMP016', 'Anorganik', 'Kain', 'KG', 200, '60c0a8309477f.jpg', 'Semua jenis kain.'),
('SMP017', 'Anorganik', 'Sandal dan Sepatu', 'KG', 85, '60c0a8411719a.jpg', 'Semua jenis dan merek sandal sepatu.'),
('SMP018', 'Anorganik', 'Lampu', 'KG', 100, '60c0a84f6efcf.jpg', 'Semua jenis lampu.');

-- --------------------------------------------------------

--
-- Table structure for table `setoran`
--

CREATE TABLE `setoran` (
  `idSetor` varchar(6) NOT NULL,
  `idUser` varchar(6) NOT NULL,
  `idSampah` varchar(6) NOT NULL,
  `tglSetor` date NOT NULL,
  `berat` varchar(15) NOT NULL,
  `total` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `setoran`
--

INSERT INTO `setoran` (`idSetor`, `idUser`, `idSampah`, `tglSetor`, `berat`, `total`) VALUES
('STR001', 'USR001', 'SMP011', '2025-01-27', '15', 15000);

-- --------------------------------------------------------

--
-- Table structure for table `setting`
--

CREATE TABLE `setting` (
  `idSetting` int(11) NOT NULL,
  `nama` varchar(80) NOT NULL,
  `developer` varchar(80) NOT NULL,
  `status` enum('0','1') NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `setting`
--

INSERT INTO `setting` (`idSetting`, `nama`, `developer`, `status`) VALUES
(1, 'Aplikasi Bank Sampah', 'IkoAlmasDevGame', '1');

-- --------------------------------------------------------

--
-- Table structure for table `stock_sampah`
--

CREATE TABLE `stock_sampah` (
  `idStock` varchar(6) NOT NULL,
  `namaSampah` varchar(30) NOT NULL,
  `stock` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `stock_sampah`
--

INSERT INTO `stock_sampah` (`idStock`, `namaSampah`, `stock`) VALUES
('STK001', 'Kresek', 0),
('STK002', 'Plastik', 0),
('STK003', 'Karah warna', 0),
('STK004', 'botol mineral plastik', 0),
('STK005', 'Botol mineral kaca', 0),
('STK006', 'Gelas mineral plastik', 0),
('STK007', 'Kaleng', 0),
('STK008', 'Kardus/Karton', 0),
('STK009', 'Dedaunan', 0),
('STK010', 'Sampah hasil masak', 0),
('STK011', 'Besi', 15),
('STK012', 'Baja', 0),
('STK013', 'Tembaga', 0),
('STK014', 'Aluminium', 0),
('STK015', 'Zeng', 0),
('STK016', 'Kain', 0),
('STK017', 'Sandal dan Sepatu', 0),
('STK018', 'Lampu', 0),
('STK019', 'testing', 0);

-- --------------------------------------------------------

--
-- Table structure for table `users`
--

CREATE TABLE `users` (
  `idUser` varchar(6) NOT NULL,
  `namaUser` varchar(30) NOT NULL,
  `gambar` varchar(255) NOT NULL,
  `nik` varchar(20) NOT NULL,
  `alamat` varchar(100) NOT NULL,
  `telepon` varchar(13) NOT NULL,
  `username` varchar(20) NOT NULL,
  `passwordUser` varchar(20) NOT NULL,
  `jmlSetoran` int(11) NOT NULL,
  `jmlPenarikan` int(11) NOT NULL,
  `saldo` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `users`
--

INSERT INTO `users` (`idUser`, `namaUser`, `gambar`, `nik`, `alamat`, `telepon`, `username`, `passwordUser`, `jmlSetoran`, `jmlPenarikan`, `saldo`) VALUES
('USR001', 'Chaca Anatasyah', 'Feby_Putri.png', '1133224455667788', 'Bandung', '01233456787', 'anatasyah', 'Chacha1234', 1, 0, 15000);

--
-- Indexes for dumped tables
--

--
-- Indexes for table `admins`
--
ALTER TABLE `admins`
  ADD PRIMARY KEY (`IdAdmin`);

--
-- Indexes for table `berita`
--
ALTER TABLE `berita`
  ADD PRIMARY KEY (`idBerita`);

--
-- Indexes for table `penarikan`
--
ALTER TABLE `penarikan`
  ADD PRIMARY KEY (`idTarik`),
  ADD KEY `idUser` (`idUser`);

--
-- Indexes for table `penjualan`
--
ALTER TABLE `penjualan`
  ADD PRIMARY KEY (`idJual`),
  ADD KEY `idSampah` (`idSampah`);

--
-- Indexes for table `saldo_bank`
--
ALTER TABLE `saldo_bank`
  ADD PRIMARY KEY (`idTransaksi`);

--
-- Indexes for table `sampah`
--
ALTER TABLE `sampah`
  ADD PRIMARY KEY (`idSampah`);

--
-- Indexes for table `setoran`
--
ALTER TABLE `setoran`
  ADD PRIMARY KEY (`idSetor`);

--
-- Indexes for table `setting`
--
ALTER TABLE `setting`
  ADD PRIMARY KEY (`idSetting`);

--
-- Indexes for table `stock_sampah`
--
ALTER TABLE `stock_sampah`
  ADD PRIMARY KEY (`idStock`);

--
-- Indexes for table `users`
--
ALTER TABLE `users`
  ADD PRIMARY KEY (`idUser`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `setting`
--
ALTER TABLE `setting`
  MODIFY `idSetting` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
