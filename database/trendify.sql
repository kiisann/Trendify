-- phpMyAdmin SQL Dump
-- version 5.2.0
-- https://www.phpmyadmin.net/
--
-- Host: localhost:3306
-- Generation Time: Apr 07, 2026 at 12:37 AM
-- Server version: 8.0.30
-- PHP Version: 8.1.10

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `trendify`
--

DELIMITER $$
--
-- Procedures
--
CREATE DEFINER=`root`@`localhost` PROCEDURE `delete_produk` (IN `p_id` INT)   BEGIN
    DELETE FROM produk WHERE id_produk = p_id;
END$$

CREATE DEFINER=`root`@`localhost` PROCEDURE `insert_produk` (IN `p_nama` VARCHAR(100), IN `p_harga` INT, IN `p_gambar` VARCHAR(255), IN `p_stok` INT, IN `p_id_kategori` INT)   BEGIN
    INSERT INTO produk (nama, harga, gambar, stok, id_kategori)
    VALUES (p_nama, p_harga, p_gambar, p_stok, p_id_kategori);
END$$

CREATE DEFINER=`root`@`localhost` PROCEDURE `select_produk` ()   BEGIN
    SELECT * FROM view_produk ORDER BY id_produk DESC;
END$$

CREATE DEFINER=`root`@`localhost` PROCEDURE `update_produk` (IN `p_id` INT, IN `p_nama` VARCHAR(100), IN `p_harga` INT, IN `p_stok` INT, IN `p_id_kategori` INT)   BEGIN
    UPDATE produk
    SET nama = p_nama,
        harga = p_harga,
        stok = p_stok,
        id_kategori = p_id_kategori
    WHERE id_produk = p_id;
END$$

--
-- Functions
--
CREATE DEFINER=`root`@`localhost` FUNCTION `hitung_total` (`jumlah` INT, `harga` INT) RETURNS INT DETERMINISTIC BEGIN
    RETURN jumlah * harga;
END$$

DELIMITER ;

-- --------------------------------------------------------

--
-- Table structure for table `detail_pesanan`
--

CREATE TABLE `detail_pesanan` (
  `id_detail` int NOT NULL,
  `id_pesanan` int DEFAULT NULL,
  `id_produk` int DEFAULT NULL,
  `jumlah` int DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_0900_ai_ci;

--
-- Dumping data for table `detail_pesanan`
--

INSERT INTO `detail_pesanan` (`id_detail`, `id_pesanan`, `id_produk`, `jumlah`) VALUES
(1, 1, 1, 2),
(2, 1, 3, 1),
(3, 2, 2, 1),
(4, 2, 4, 2),
(5, 3, 5, 1),
(6, 3, 8, 1),
(7, 4, 6, 1),
(8, 4, 7, 2),
(9, 5, 1, 6),
(10, 6, 2, 1),
(11, 6, 6, 1),
(12, 7, 2, 1),
(13, 8, 6, 1),
(14, 9, 6, 1),
(15, 10, 5, 1),
(16, 11, 5, 1),
(17, 12, 2, 1),
(18, 13, 4, 1),
(19, 14, 7, 1),
(20, 15, 3, 1),
(21, 16, 12, 1),
(22, 18, 7, 2),
(23, 19, 4, 1),
(24, 20, 3, 1),
(25, 21, 13, 1),
(26, 22, 13, 1),
(27, 23, 3, 1),
(28, 24, 13, 3),
(29, 27, 2, 2),
(30, 27, 6, 5),
(31, 29, 12, 3),
(32, 30, 12, 1);

-- --------------------------------------------------------

--
-- Table structure for table `kategori`
--

CREATE TABLE `kategori` (
  `id_kategori` int NOT NULL,
  `nama` varchar(100) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_0900_ai_ci;

--
-- Dumping data for table `kategori`
--

INSERT INTO `kategori` (`id_kategori`, `nama`) VALUES
(1, 'Pria - Pakaian'),
(2, 'Pria - Sepatu'),
(3, 'Pria - Aksesoris'),
(4, 'Wanita - Pakaian'),
(5, 'Wanita - Sepatu'),
(6, 'Wanita - Aksesoris');

-- --------------------------------------------------------

--
-- Table structure for table `keranjang`
--

CREATE TABLE `keranjang` (
  `id_keranjang` int NOT NULL,
  `id_user` int NOT NULL,
  `id_produk` int NOT NULL,
  `jumlah` int NOT NULL DEFAULT '1'
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_0900_ai_ci;

--
-- Dumping data for table `keranjang`
--

INSERT INTO `keranjang` (`id_keranjang`, `id_user`, `id_produk`, `jumlah`) VALUES
(24, 3, 3, 3),
(26, 4, 3, 2),
(27, 4, 8, 1);

-- --------------------------------------------------------

--
-- Table structure for table `pesanan`
--

CREATE TABLE `pesanan` (
  `id_pesanan` int NOT NULL,
  `id_user` int DEFAULT NULL,
  `tanggal` datetime DEFAULT NULL,
  `status` varchar(50) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_0900_ai_ci;

--
-- Dumping data for table `pesanan`
--

INSERT INTO `pesanan` (`id_pesanan`, `id_user`, `tanggal`, `status`) VALUES
(1, 1, '2026-04-01 00:00:00', 'selesai'),
(2, 2, '2026-04-02 00:00:00', 'pending'),
(3, 3, '2026-04-03 00:00:00', 'selesai'),
(4, 4, '2026-04-04 00:00:00', 'pending'),
(5, 2, '2026-04-06 00:00:00', 'selesai'),
(6, 4, '2026-04-06 00:00:00', 'selesai'),
(7, 4, '2026-04-06 00:00:00', 'selesai'),
(8, 4, '2026-04-06 00:00:00', 'selesai'),
(9, 4, '2026-04-06 00:00:00', 'selesai'),
(10, 4, '2026-04-06 00:00:00', 'selesai'),
(11, 4, '2026-04-06 00:00:00', 'selesai'),
(12, 4, '2026-04-06 00:00:00', 'selesai'),
(13, 4, '2026-04-06 00:00:00', 'selesai'),
(14, 4, '2026-04-06 00:00:00', 'selesai'),
(15, 4, '2026-04-07 00:00:00', 'selesai'),
(16, 4, '2026-04-07 00:00:00', 'selesai'),
(18, 4, '2026-04-07 00:00:00', 'selesai'),
(19, 4, '2026-04-07 00:00:00', 'selesai'),
(20, 3, '2026-04-07 00:00:00', 'selesai'),
(21, 4, '2026-04-07 00:00:00', 'selesai'),
(22, 4, '2026-04-07 00:00:00', 'selesai'),
(23, 4, '2026-04-07 00:00:00', 'selesai'),
(24, 4, '2026-04-07 00:00:00', 'selesai'),
(27, 4, '2026-04-07 00:00:00', 'selesai'),
(29, 4, '2026-04-07 00:00:00', 'selesai'),
(30, 4, '2026-04-07 00:00:00', 'selesai');

-- --------------------------------------------------------

--
-- Table structure for table `produk`
--

CREATE TABLE `produk` (
  `id_produk` int NOT NULL,
  `nama` varchar(100) DEFAULT NULL,
  `harga` int DEFAULT NULL,
  `gambar` varchar(255) DEFAULT NULL,
  `stok` int DEFAULT NULL,
  `id_kategori` int DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_0900_ai_ci;

--
-- Dumping data for table `produk`
--

INSERT INTO `produk` (`id_produk`, `nama`, `harga`, `gambar`, `stok`, `id_kategori`) VALUES
(1, 'Kaos Polos Pria', 50000, 'kaos.jpg', 4, 1),
(2, 'Hoodie Pria', 120000, 'hodie.jpg', 0, 1),
(3, 'Sepatu Sneakers Pria', 250000, 'sneakers.jpg', 1, 2),
(4, 'Jam Tangan Pria', 150000, 'jam.jpg', 4, 3),
(5, 'Dress Wanita', 150000, 'dress.jpg', 5, 4),
(6, 'Blouse Wanita', 90000, 'blouse.jpg', 0, 4),
(7, 'Heels Wanita', 200000, 'heels.jpg', 0, 5),
(8, 'Tas Wanita', 130000, 'taswanita.jpg', 8, 6),
(12, 'Sepatu Lari', 1200000, '1775508200_sepatulari.jpg', 7, 2),
(13, 'Jaket Varsity', 400000, '1775511358_varsity.jpg', 18, 1);

-- --------------------------------------------------------

--
-- Table structure for table `user`
--

CREATE TABLE `user` (
  `id_user` int NOT NULL,
  `nama` varchar(100) DEFAULT NULL,
  `email` varchar(100) DEFAULT NULL,
  `password` varchar(255) DEFAULT NULL,
  `role` enum('admin','user') DEFAULT 'user',
  `alamat` text
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_0900_ai_ci;

--
-- Dumping data for table `user`
--

INSERT INTO `user` (`id_user`, `nama`, `email`, `password`, `role`, `alamat`) VALUES
(1, 'Surya', 'Surya@gmail.com', '123', 'admin', 'Jl. Pahoman No. 10, Bandar Lampung'),
(2, 'Fiki', 'Fiki@gmail.com', '234', 'admin', 'Jl. Stasiun Tulung Buyut No. 22, Lampung Utara'),
(3, 'Naura', 'Naura@gmail.com', '456', 'user', 'Jl. Raden Intan No. 5, Bandar Lampung'),
(4, 'Iqlima', 'Iqlima@gmail.com', '345', 'user', 'Jl. Silitonga No. 8, Lampung Tengah');

-- --------------------------------------------------------

--
-- Stand-in structure for view `view_produk`
-- (See below for the actual view)
--
CREATE TABLE `view_produk` (
`gambar` varchar(255)
,`harga` int
,`id_kategori` int
,`id_produk` int
,`kategori` varchar(100)
,`nama_produk` varchar(100)
,`stok` int
);

-- --------------------------------------------------------

--
-- Stand-in structure for view `view_transaksi`
-- (See below for the actual view)
--
CREATE TABLE `view_transaksi` (
`harga` int
,`id_pesanan` int
,`id_user` int
,`jumlah` int
,`nama_produk` varchar(100)
,`nama_user` varchar(100)
,`status` varchar(50)
,`tanggal` datetime
,`total` int
);

-- --------------------------------------------------------

--
-- Structure for view `view_produk`
--
DROP TABLE IF EXISTS `view_produk`;

CREATE ALGORITHM=UNDEFINED DEFINER=`root`@`localhost` SQL SECURITY DEFINER VIEW `view_produk`  AS SELECT `p`.`id_produk` AS `id_produk`, `p`.`nama` AS `nama_produk`, `p`.`harga` AS `harga`, `p`.`stok` AS `stok`, `p`.`id_kategori` AS `id_kategori`, `p`.`gambar` AS `gambar`, `k`.`nama` AS `kategori` FROM (`produk` `p` join `kategori` `k` on((`p`.`id_kategori` = `k`.`id_kategori`)))  ;

-- --------------------------------------------------------

--
-- Structure for view `view_transaksi`
--
DROP TABLE IF EXISTS `view_transaksi`;

CREATE ALGORITHM=UNDEFINED DEFINER=`root`@`localhost` SQL SECURITY DEFINER VIEW `view_transaksi`  AS SELECT `p`.`id_pesanan` AS `id_pesanan`, `p`.`id_user` AS `id_user`, `u`.`nama` AS `nama_user`, `pr`.`nama` AS `nama_produk`, `dp`.`jumlah` AS `jumlah`, `pr`.`harga` AS `harga`, `hitung_total`(`dp`.`jumlah`,`pr`.`harga`) AS `total`, `p`.`status` AS `status`, `p`.`tanggal` AS `tanggal` FROM (((`pesanan` `p` join `user` `u` on((`p`.`id_user` = `u`.`id_user`))) join `detail_pesanan` `dp` on((`p`.`id_pesanan` = `dp`.`id_pesanan`))) join `produk` `pr` on((`dp`.`id_produk` = `pr`.`id_produk`)))  ;

--
-- Indexes for dumped tables
--

--
-- Indexes for table `detail_pesanan`
--
ALTER TABLE `detail_pesanan`
  ADD PRIMARY KEY (`id_detail`),
  ADD KEY `id_pesanan` (`id_pesanan`),
  ADD KEY `id_produk` (`id_produk`);

--
-- Indexes for table `kategori`
--
ALTER TABLE `kategori`
  ADD PRIMARY KEY (`id_kategori`);

--
-- Indexes for table `keranjang`
--
ALTER TABLE `keranjang`
  ADD PRIMARY KEY (`id_keranjang`),
  ADD KEY `id_user` (`id_user`),
  ADD KEY `id_produk` (`id_produk`);

--
-- Indexes for table `pesanan`
--
ALTER TABLE `pesanan`
  ADD PRIMARY KEY (`id_pesanan`),
  ADD KEY `id_user` (`id_user`);

--
-- Indexes for table `produk`
--
ALTER TABLE `produk`
  ADD PRIMARY KEY (`id_produk`),
  ADD KEY `id_kategori` (`id_kategori`);

--
-- Indexes for table `user`
--
ALTER TABLE `user`
  ADD PRIMARY KEY (`id_user`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `detail_pesanan`
--
ALTER TABLE `detail_pesanan`
  MODIFY `id_detail` int NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=33;

--
-- AUTO_INCREMENT for table `kategori`
--
ALTER TABLE `kategori`
  MODIFY `id_kategori` int NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=7;

--
-- AUTO_INCREMENT for table `keranjang`
--
ALTER TABLE `keranjang`
  MODIFY `id_keranjang` int NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=29;

--
-- AUTO_INCREMENT for table `pesanan`
--
ALTER TABLE `pesanan`
  MODIFY `id_pesanan` int NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=31;

--
-- AUTO_INCREMENT for table `produk`
--
ALTER TABLE `produk`
  MODIFY `id_produk` int NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=15;

--
-- AUTO_INCREMENT for table `user`
--
ALTER TABLE `user`
  MODIFY `id_user` int NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=9;

--
-- Constraints for dumped tables
--

--
-- Constraints for table `detail_pesanan`
--
ALTER TABLE `detail_pesanan`
  ADD CONSTRAINT `detail_pesanan_ibfk_1` FOREIGN KEY (`id_pesanan`) REFERENCES `pesanan` (`id_pesanan`),
  ADD CONSTRAINT `detail_pesanan_ibfk_2` FOREIGN KEY (`id_produk`) REFERENCES `produk` (`id_produk`);

--
-- Constraints for table `keranjang`
--
ALTER TABLE `keranjang`
  ADD CONSTRAINT `keranjang_ibfk_1` FOREIGN KEY (`id_user`) REFERENCES `user` (`id_user`),
  ADD CONSTRAINT `keranjang_ibfk_2` FOREIGN KEY (`id_produk`) REFERENCES `produk` (`id_produk`);

--
-- Constraints for table `pesanan`
--
ALTER TABLE `pesanan`
  ADD CONSTRAINT `pesanan_ibfk_1` FOREIGN KEY (`id_user`) REFERENCES `user` (`id_user`);

--
-- Constraints for table `produk`
--
ALTER TABLE `produk`
  ADD CONSTRAINT `produk_ibfk_1` FOREIGN KEY (`id_kategori`) REFERENCES `kategori` (`id_kategori`);
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
