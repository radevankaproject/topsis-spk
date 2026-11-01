-- phpMyAdmin SQL Dump
-- version 5.2.2
-- https://www.phpmyadmin.net/
--
-- Host: localhost:3306
-- Generation Time: Aug 13, 2025 at 10:12 AM
-- Server version: 11.4.7-MariaDB-cll-lve
-- PHP Version: 8.4.10

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `kopf9761_topsis`
--

-- --------------------------------------------------------

--
-- Table structure for table `alternative`
--

CREATE TABLE `alternative` (
  `alternative_id` int(11) NOT NULL,
  `user_id` int(10) UNSIGNED NOT NULL,
  `criteria_id` char(25) NOT NULL,
  `alternative_value` bigint(20) NOT NULL,
  `created_at` datetime NOT NULL,
  `updated_at` datetime NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1 COLLATE=latin1_swedish_ci;

--
-- Dumping data for table `alternative`
--

INSERT INTO `alternative` (`alternative_id`, `user_id`, `criteria_id`, `alternative_value`, `created_at`, `updated_at`) VALUES
(22, 35, 'C1', 3, '2025-06-10 11:27:12', '2025-06-10 12:57:04'),
(23, 35, 'C2', 3, '2025-06-10 11:27:12', '2025-06-10 12:57:04'),
(24, 35, 'C3', 19, '2025-06-10 11:27:12', '2025-06-10 12:57:04'),
(25, 35, 'C4', 3, '2025-06-10 11:27:12', '2025-06-10 12:57:04'),
(26, 36, 'C1', 9, '2025-06-10 11:29:32', '2025-06-10 11:29:32'),
(27, 36, 'C2', 3, '2025-06-10 11:29:32', '2025-06-10 11:29:32'),
(28, 36, 'C3', 15, '2025-06-10 11:29:32', '2025-06-10 11:29:32'),
(29, 36, 'C4', 5, '2025-06-10 11:29:32', '2025-06-10 11:29:32'),
(30, 37, 'C1', 4, '2025-06-10 11:31:01', '2025-06-10 11:31:01'),
(31, 37, 'C2', 3, '2025-06-10 11:31:01', '2025-06-10 11:31:01'),
(32, 37, 'C3', 18, '2025-06-10 11:31:01', '2025-06-10 11:31:01'),
(33, 37, 'C4', 2, '2025-06-10 11:31:01', '2025-06-10 11:31:01'),
(34, 38, 'C1', 7, '2025-06-10 11:31:33', '2025-06-10 11:31:33'),
(35, 38, 'C2', 3, '2025-06-10 11:31:33', '2025-06-10 11:31:33'),
(36, 38, 'C3', 19, '2025-06-10 11:31:33', '2025-06-10 11:31:33'),
(37, 38, 'C4', 3, '2025-06-10 11:31:33', '2025-06-10 11:31:33'),
(38, 39, 'C1', 3, '2025-06-10 11:32:05', '2025-06-10 11:32:05'),
(39, 39, 'C2', 3, '2025-06-10 11:32:05', '2025-06-10 11:32:05'),
(40, 39, 'C3', 20, '2025-06-10 11:32:05', '2025-06-10 11:32:05'),
(41, 39, 'C4', 2, '2025-06-10 11:32:05', '2025-06-10 11:32:05'),
(42, 40, 'C1', 8, '2025-06-10 11:33:37', '2025-06-10 11:33:37'),
(43, 40, 'C2', 3, '2025-06-10 11:33:37', '2025-06-10 11:33:37'),
(44, 40, 'C3', 17, '2025-06-10 11:33:37', '2025-06-10 11:33:37'),
(45, 40, 'C4', 5, '2025-06-10 11:33:37', '2025-06-10 11:33:37'),
(46, 41, 'C1', 3, '2025-06-10 11:34:05', '2025-06-10 11:34:05'),
(47, 41, 'C2', 3, '2025-06-10 11:34:05', '2025-06-10 11:34:05'),
(48, 41, 'C3', 23, '2025-06-10 11:34:05', '2025-06-10 11:34:05'),
(49, 41, 'C4', 3, '2025-06-10 11:34:05', '2025-06-10 11:34:05'),
(50, 42, 'C1', 7, '2025-06-10 11:34:49', '2025-06-10 11:34:49'),
(51, 42, 'C2', 3, '2025-06-10 11:34:49', '2025-06-10 11:34:49'),
(52, 42, 'C3', 24, '2025-06-10 11:34:49', '2025-06-10 11:34:49'),
(53, 42, 'C4', 2, '2025-06-10 11:34:49', '2025-06-10 11:34:49'),
(54, 43, 'C1', 6, '2025-06-10 11:35:25', '2025-06-10 11:35:25'),
(55, 43, 'C2', 3, '2025-06-10 11:35:25', '2025-06-10 11:35:25'),
(56, 43, 'C3', 25, '2025-06-10 11:35:25', '2025-06-10 11:35:25'),
(57, 43, 'C4', 2, '2025-06-10 11:35:25', '2025-06-10 11:35:25'),
(58, 44, 'C1', 7, '2025-06-10 11:35:55', '2025-06-10 11:35:55'),
(59, 44, 'C2', 3, '2025-06-10 11:35:55', '2025-06-10 11:35:55'),
(60, 44, 'C3', 10, '2025-06-10 11:35:55', '2025-06-10 11:35:55'),
(61, 44, 'C4', 2, '2025-06-10 11:35:55', '2025-06-10 11:35:55');

-- --------------------------------------------------------

--
-- Table structure for table `criteria`
--

CREATE TABLE `criteria` (
  `criteria_id` char(25) NOT NULL,
  `criteria_name` varchar(255) NOT NULL,
  `criteria_type` varchar(255) NOT NULL,
  `criteria_information` longtext NOT NULL,
  `criteria_value` float NOT NULL,
  `created_at` datetime NOT NULL,
  `updated_at` datetime NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1 COLLATE=latin1_swedish_ci;

--
-- Dumping data for table `criteria`
--

INSERT INTO `criteria` (`criteria_id`, `criteria_name`, `criteria_type`, `criteria_information`, `criteria_value`, `created_at`, `updated_at`) VALUES
('C1', 'Pendapatan Bulanan (Rp - Juta)', 'cost', 'Semakin sedikit pendapatan, semakin butuh bantuan', 0.2, '2025-06-10 11:18:49', '2025-06-10 11:24:07'),
('C2', 'Legalitas (Izin)', 'benefit', 'Usaha yang legal lebih bisa di priorotaskan.', 0.2, '2025-06-10 11:20:12', '2025-07-07 12:28:57'),
('C3', 'Lama Usaha (Tahun)', 'benefit', 'Semakin lama yang dijalankan semakin layak dibantu karena dianggap serius.', 0.3, '2025-06-10 11:20:52', '2025-07-07 12:29:04'),
('C4', 'Tanggungan (Orang)', 'benefit', 'Semakin banyak yang di tanggung semakin layak dibantu.', 0.3, '2025-06-10 11:21:58', '2025-07-07 12:29:12');

-- --------------------------------------------------------

--
-- Table structure for table `masyarakat`
--

CREATE TABLE `masyarakat` (
  `id` int(11) NOT NULL,
  `user_id` int(10) UNSIGNED NOT NULL,
  `nik` varchar(16) DEFAULT NULL,
  `alamat` text DEFAULT NULL,
  `tempat_lahir` varchar(100) DEFAULT NULL,
  `tanggal_lahir` date DEFAULT NULL,
  `jenis_kelamin` enum('Laki-laki','Perempuan') DEFAULT NULL,
  `ktp_img` varchar(255) DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT current_timestamp(),
  `updated_at` timestamp NULL DEFAULT current_timestamp() ON UPDATE current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_0900_ai_ci;

--
-- Dumping data for table `masyarakat`
--

INSERT INTO `masyarakat` (`id`, `user_id`, `nik`, `alamat`, `tempat_lahir`, `tanggal_lahir`, `jenis_kelamin`, `ktp_img`, `created_at`, `updated_at`) VALUES
(1, 11, '1216252653535535', '', '', '0000-00-00', '', NULL, '2025-08-11 22:34:06', '2025-08-12 10:56:18'),
(3, 41, NULL, NULL, NULL, NULL, NULL, NULL, '2025-08-11 22:34:26', '2025-08-11 22:34:26'),
(4, 39, NULL, NULL, NULL, NULL, NULL, NULL, '2025-08-11 22:35:25', '2025-08-11 22:35:25'),
(5, 37, NULL, NULL, NULL, NULL, NULL, NULL, '2025-08-11 22:35:54', '2025-08-11 22:35:54'),
(6, 43, NULL, NULL, NULL, NULL, NULL, NULL, '2025-08-11 22:36:54', '2025-08-11 22:36:54'),
(7, 44, NULL, NULL, NULL, NULL, NULL, NULL, '2025-08-11 22:37:05', '2025-08-11 22:37:05'),
(8, 45, NULL, NULL, NULL, NULL, NULL, NULL, '2025-08-11 22:37:20', '2025-08-11 22:37:20'),
(9, 40, NULL, NULL, NULL, NULL, NULL, NULL, '2025-08-11 22:37:37', '2025-08-11 22:37:37'),
(10, 36, NULL, NULL, NULL, NULL, NULL, NULL, '2025-08-11 22:37:44', '2025-08-11 22:37:44'),
(11, 42, NULL, NULL, NULL, NULL, NULL, NULL, '2025-08-11 22:37:53', '2025-08-11 22:37:53'),
(12, 38, NULL, NULL, NULL, NULL, NULL, NULL, '2025-08-11 22:37:58', '2025-08-11 22:37:58'),
(13, 35, NULL, NULL, NULL, NULL, NULL, NULL, '2025-08-11 22:38:37', '2025-08-11 22:38:37');

-- --------------------------------------------------------

--
-- Table structure for table `ranking`
--

CREATE TABLE `ranking` (
  `ranking_id` int(11) NOT NULL,
  `user_id` int(10) UNSIGNED NOT NULL,
  `score` decimal(10,8) NOT NULL,
  `peringkat` int(11) NOT NULL,
  `calculated_at` datetime NOT NULL DEFAULT current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=latin1 COLLATE=latin1_swedish_ci;

--
-- Dumping data for table `ranking`
--

INSERT INTO `ranking` (`ranking_id`, `user_id`, `score`, `peringkat`, `calculated_at`) VALUES
(1, 41, 0.60355893, 1, '2025-08-13 00:36:02'),
(2, 40, 0.60172855, 2, '2025-08-13 00:36:02'),
(3, 35, 0.54838475, 3, '2025-08-13 00:36:02'),
(4, 36, 0.54456280, 4, '2025-08-13 00:36:02'),
(5, 39, 0.45543720, 5, '2025-08-13 00:36:02'),
(6, 43, 0.45145493, 6, '2025-08-13 00:36:02'),
(7, 38, 0.41939258, 7, '2025-08-13 00:36:02'),
(8, 42, 0.41507461, 8, '2025-08-13 00:36:02'),
(9, 37, 0.39827145, 9, '2025-08-13 00:36:02'),
(10, 44, 0.14328114, 10, '2025-08-13 00:36:02');

-- --------------------------------------------------------

--
-- Table structure for table `users`
--

CREATE TABLE `users` (
  `user_id` int(10) UNSIGNED NOT NULL,
  `username` varchar(255) NOT NULL,
  `password` varchar(255) NOT NULL,
  `name` varchar(255) DEFAULT NULL,
  `level` enum('1','2','3') NOT NULL,
  `img` longtext DEFAULT NULL,
  `created_at` datetime DEFAULT NULL,
  `updated_at` datetime DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1 COLLATE=latin1_swedish_ci;

--
-- Dumping data for table `users`
--

INSERT INTO `users` (`user_id`, `username`, `password`, `name`, `level`, `img`, `created_at`, `updated_at`) VALUES
(11, 'admin', '$2y$12$yos5xFMt26uwxRPbKrTU3e1/k3tFcbr/BuTqDgL41G7guw7tuNoCK', 'Admin Super', '1', 'profile_689b1dee9a1ca.jpg', '2025-05-13 00:37:21', '2025-05-13 00:37:21'),
(35, 'mul', '$2y$12$F8tUGC6NcH7uoCBPzm2RXOnooWE5Z2LNROjIjHczwBFmeZ4e/p6eu', 'Mul', '2', NULL, '2025-06-10 11:14:20', '2025-06-10 11:14:20'),
(36, 'sarno', '$2y$12$e/696fMAFIKcx7d5bCHwaOTFRMJuz2vcCOiQceeWbAJawXmwVMnEq', 'Sarno', '2', NULL, '2025-06-10 11:14:40', '2025-06-10 11:14:40'),
(37, 'safar', '$2y$12$kCvWY2qyTO/xwSNvrn3yauioVxB6Cwdb4VDikWfdtWO.un4rG6c7C', 'Safar', '2', NULL, '2025-06-10 11:15:07', '2025-06-10 11:15:07'),
(38, 'warto', '$2y$12$aSQ8wpIeY1pJbnrtrfZOHekralLORUBQTIO.hpa/fr.gQroaihn9y', 'Warto', '2', NULL, '2025-06-10 11:15:32', '2025-06-10 11:15:32'),
(39, 'jamil', '$2y$12$tQ0fvnJC/XZO0dwDrsLQrujRafmWhf8tiRjb5jOULBDipf1gf9Vgq', 'Jamil', '2', NULL, '2025-06-10 11:16:04', '2025-06-10 11:16:04'),
(40, 'sairun', '$2y$12$a4WWQHTfB4hLAkvTEJS7VuyTeU57w9Zq9RWkabQc055bdoKDmqARu', 'Sairun', '2', '', '2025-06-10 11:16:28', '2025-06-10 11:32:55'),
(41, 'gunjal', '$2y$12$2qhZzL47fMmuqe3R59H/SOK8CakH8segwbAR.Nqj.qs6gjKqDDxP2', 'Gunjal', '2', NULL, '2025-06-10 11:16:56', '2025-06-10 11:16:56'),
(42, 'unedo', '$2y$12$lDidY93BrHvOZCV/VI5dleUw.sUfkBskhpk9KjlOQ7ypZINvgFBIW', 'Unedo', '2', NULL, '2025-06-10 11:17:24', '2025-06-10 11:17:24'),
(43, 'kari', '$2y$12$lUg.gNQLn5aZSDqJtjgdA.wYeeoKVsYAqAR9Kd4DdkFAU7B5z08.G', 'Kari', '2', NULL, '2025-06-10 11:17:40', '2025-06-10 11:17:40'),
(44, 'rafli', '$2y$12$wxsznivkz92zIL5xEeS0r.pp4F3GCtF.UNHb3sd5ROUGVJtMtxAv6', 'Rafli', '2', NULL, '2025-06-10 11:18:01', '2025-06-10 11:18:01'),
(45, 'rita', '$2y$12$ZtZfxaPEZSm8cGdB4yS0/.uYU7T2cW5qEDRVUoAcYF4oUq4ZvPdWe', 'Rita', '1', '689acabfbdb89.jpg', '2025-06-10 12:53:52', '2025-08-12 12:01:52');

--
-- Indexes for dumped tables
--

--
-- Indexes for table `alternative`
--
ALTER TABLE `alternative`
  ADD PRIMARY KEY (`alternative_id`),
  ADD KEY `user_id` (`user_id`),
  ADD KEY `criteria_id` (`criteria_id`);

--
-- Indexes for table `criteria`
--
ALTER TABLE `criteria`
  ADD PRIMARY KEY (`criteria_id`);

--
-- Indexes for table `masyarakat`
--
ALTER TABLE `masyarakat`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `user_id` (`user_id`),
  ADD UNIQUE KEY `nik` (`nik`);

--
-- Indexes for table `ranking`
--
ALTER TABLE `ranking`
  ADD PRIMARY KEY (`ranking_id`),
  ADD KEY `user_id` (`user_id`);

--
-- Indexes for table `users`
--
ALTER TABLE `users`
  ADD PRIMARY KEY (`user_id`),
  ADD UNIQUE KEY `username` (`username`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `alternative`
--
ALTER TABLE `alternative`
  MODIFY `alternative_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=66;

--
-- AUTO_INCREMENT for table `masyarakat`
--
ALTER TABLE `masyarakat`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=15;

--
-- AUTO_INCREMENT for table `ranking`
--
ALTER TABLE `ranking`
  MODIFY `ranking_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=11;

--
-- AUTO_INCREMENT for table `users`
--
ALTER TABLE `users`
  MODIFY `user_id` int(10) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=49;

--
-- Constraints for dumped tables
--

--
-- Constraints for table `alternative`
--
ALTER TABLE `alternative`
  ADD CONSTRAINT `fk_alternative_criteria` FOREIGN KEY (`criteria_id`) REFERENCES `criteria` (`criteria_id`) ON DELETE CASCADE ON UPDATE CASCADE,
  ADD CONSTRAINT `fk_alternative_user` FOREIGN KEY (`user_id`) REFERENCES `users` (`user_id`) ON DELETE CASCADE ON UPDATE CASCADE;

--
-- Constraints for table `masyarakat`
--
ALTER TABLE `masyarakat`
  ADD CONSTRAINT `fk_masyarakat_user` FOREIGN KEY (`user_id`) REFERENCES `users` (`user_id`) ON DELETE CASCADE ON UPDATE CASCADE;

--
-- Constraints for table `ranking`
--
ALTER TABLE `ranking`
  ADD CONSTRAINT `ranking_ibfk_1` FOREIGN KEY (`user_id`) REFERENCES `users` (`user_id`) ON DELETE CASCADE ON UPDATE CASCADE;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
