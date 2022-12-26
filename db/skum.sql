-- phpMyAdmin SQL Dump
-- version 5.0.4
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Generation Time: Dec 26, 2022 at 08:58 AM
-- Server version: 10.4.17-MariaDB
-- PHP Version: 8.0.2

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `skum`
--

-- --------------------------------------------------------

--
-- Table structure for table `jenis_perkara`
--

CREATE TABLE `jenis_perkara` (
  `id` int(2) NOT NULL,
  `jenis_perkara_id` int(3) NOT NULL,
  `nama` varchar(50) NOT NULL,
  `alur` varchar(2) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `jenis_perkara`
--

INSERT INTO `jenis_perkara` (`id`, `jenis_perkara_id`, `nama`, `alur`) VALUES
(1, 341, 'Izin Poligami', 'G'),
(2, 342, 'Pencegahan Perkawinan', 'P'),
(3, 343, 'Penolakan Perkawinan', 'P'),
(4, 344, 'Pembatalan Perkawinan', 'G'),
(5, 345, 'Kelalaian Atas Kewajiban Suami/Istri', 'G'),
(6, 346, 'Cerai Talak', 'G'),
(7, 347, 'Cerai Gugat', 'G'),
(8, 348, 'Harta Bersama', 'G'),
(9, 349, 'Penguasaan Anak (Hadhonah)', 'G'),
(10, 350, 'Nafkah Anak Oleh Ibu Karena Ayah Tidak Mampu', 'G'),
(11, 351, 'Hak-Hak Bekas Istri/Kewajiban Bekas Suami', 'G'),
(12, 352, 'Pengesahan Anak', 'G'),
(13, 353, 'Pencabutan Kekuasaan Orang Tua', 'G'),
(14, 354, 'Perwalian', 'P'),
(15, 355, 'Pencabutan Kekuasaan Wali', 'G'),
(16, 356, 'Penunjukan Orang Lain Sebagai Wali Oleh Pengadilan', 'G'),
(17, 357, 'Ganti Rugi Terhadap Wali', 'P'),
(18, 358, 'Asal-Usul Anak (Pengangkatan Anak)', 'G'),
(19, 359, 'Perkawinan Campuran', 'P'),
(20, 360, 'Pengesahan Perkawinan/Itsbat Nikah', 'G'),
(21, 361, 'Izin Kawin', 'G'),
(22, 362, 'Dispensasi Kawin', 'P'),
(23, 363, 'Wali Adhol', 'P'),
(24, 364, 'Waris', 'P'),
(25, 365, 'Wasiat', 'P'),
(26, 366, 'Hibah', 'G'),
(27, 367, 'Wakaf', 'G'),
(28, 369, 'Lain-Lain', 'G'),
(29, 370, 'Ekonomi Syariah', 'G'),
(30, 371, 'P3HP/Penetapan Ahli Waris', 'P');

-- --------------------------------------------------------

--
-- Table structure for table `kecamatan`
--

CREATE TABLE `kecamatan` (
  `id` int(5) NOT NULL,
  `id_kota` int(5) NOT NULL,
  `nama` varchar(50) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `kecamatan`
--

INSERT INTO `kecamatan` (`id`, `id_kota`, `nama`) VALUES
(1, 1, 'Oebobo'),
(2, 1, 'Kota Lama'),
(3, 1, 'Kota Raja'),
(4, 1, 'Kelapa Lima'),
(5, 1, 'Maulafa'),
(6, 1, 'Alak'),
(7, 2, 'Taebenu'),
(8, 2, 'Nekamese'),
(9, 2, 'Kupang Barat'),
(10, 2, 'Kupang Timur'),
(11, 2, 'Kupang Tengah'),
(12, 2, 'Amarasi'),
(13, 2, 'Amarasi Barat'),
(14, 2, 'Amarasi Timur'),
(15, 2, 'Amarasi Selatan'),
(16, 2, 'Amabi Oefeto'),
(17, 2, 'Amabi Oefeto Timur'),
(18, 2, 'Fatuleu'),
(19, 2, 'Fatuleu Tengah'),
(20, 2, 'Fatuleu Barat'),
(21, 2, 'Takari'),
(22, 2, 'Sulamu'),
(23, 2, 'Amfoang Barat Laut'),
(24, 2, 'Amfoang Timur'),
(25, 2, 'Amfoang Selatan'),
(26, 2, 'Amfoang Utara'),
(27, 2, 'Amfoang Barat Daya'),
(28, 2, 'Semau'),
(29, 2, 'Semau Selatan'),
(30, 3, 'Lobalain'),
(31, 3, 'Rote Tengah'),
(32, 3, 'Pantai Baru'),
(33, 3, 'Rote Timur'),
(34, 3, 'Rote Barat'),
(35, 3, 'Rote Barat Laut'),
(36, 3, 'Rote Barat Daya'),
(37, 3, 'Rote Selatan'),
(38, 3, 'Ndao Nuse'),
(39, 3, 'Landu Leko'),
(40, 4, 'Sabu Timur'),
(41, 4, 'Sabu Tengah'),
(42, 4, 'Sabu Liae'),
(43, 4, 'Sabu Barat'),
(44, 4, 'Hawu Mehara'),
(45, 4, 'Raijua');

-- --------------------------------------------------------

--
-- Table structure for table `kelurahan`
--

CREATE TABLE `kelurahan` (
  `id` int(5) NOT NULL,
  `id_kota` int(5) NOT NULL,
  `id_kecamatan` int(5) NOT NULL,
  `nama` varchar(40) NOT NULL,
  `biaya` int(10) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `kelurahan`
--

INSERT INTO `kelurahan` (`id`, `id_kota`, `id_kecamatan`, `nama`, `biaya`) VALUES
(1, 1, 1, 'FATULULI', 85000),
(2, 1, 1, 'KAYU PUTIH', 85000),
(3, 1, 1, 'TUAK DAUN MERAH', 85000),
(4, 1, 1, 'OEBOBO', 85000),
(5, 1, 1, 'OEBUFU', 85000),
(6, 1, 1, 'OETETE', 85000),
(7, 1, 1, 'LILIBA', 100000),
(8, 1, 2, 'AIR MATA', 85000),
(9, 1, 2, 'BONIPOI', 85000),
(10, 1, 2, 'FATUBESI', 85000),
(11, 1, 2, 'LLBK', 85000),
(12, 1, 2, 'MERDEKA', 85000),
(13, 1, 2, 'NEFONAEK', 85000),
(14, 1, 2, 'OEBA', 85000),
(15, 1, 2, 'PASIR PANJANG', 85000),
(16, 1, 2, 'SOLOR', 85000),
(17, 1, 2, 'TODE KISAR', 85000),
(18, 1, 3, 'AIRNONA', 85000),
(19, 1, 3, 'NAIKOTEN I', 85000),
(20, 1, 3, 'NAIKOTEN II', 85000),
(21, 1, 3, 'FONTEIN', 85000),
(22, 1, 3, 'KUANINO', 85000),
(23, 1, 3, 'NUNLEU', 85000),
(24, 1, 3, 'BAKUNASE ', 100000),
(25, 1, 3, 'BAKUNASE II', 100000),
(26, 1, 4, 'KELAPA LIMA', 100000),
(27, 1, 4, 'OESAPA', 100000),
(28, 1, 4, 'OESAPA BARAT', 100000),
(29, 1, 4, 'OESAPA SELATAN', 100000),
(30, 1, 4, 'LASIANA', 100000),
(31, 1, 5, 'MAULAFA', 100000),
(32, 1, 5, 'OEPURA', 100000),
(33, 1, 5, 'SIKUMANA', 100000),
(34, 1, 5, 'KOLHUA', 100000),
(35, 1, 5, 'NAIKOLAN', 100000),
(36, 1, 5, 'NAIMATA', 125000),
(37, 1, 5, 'PENFUI', 125000),
(38, 1, 5, 'FATUKOA', 125000),
(39, 1, 5, 'BELLO', 125000),
(40, 1, 6, 'MANTASI', 100000),
(41, 1, 6, 'NUNHILA', 125000),
(42, 1, 6, 'FATUFETO', 125000),
(43, 1, 6, 'NUNBAUN SABU', 125000),
(44, 1, 6, 'NUNBAUN DELHA', 125000),
(45, 1, 6, 'MANUTAPEN', 125000),
(46, 1, 6, 'NAMOSAIN', 125000),
(47, 1, 6, 'NAIONI', 150000),
(48, 1, 6, 'MANULAI II', 150000),
(49, 1, 6, 'PENKASE OELETA', 150000),
(50, 1, 6, 'ALAK', 150000),
(51, 1, 6, 'BATUPLAT', 150000),
(52, 2, 7, 'BAUMATA', 225000),
(53, 2, 7, 'BAUMATA BARAT', 225000),
(54, 2, 7, 'BAUMATA TIMUR', 225000),
(55, 2, 7, 'BAUMATA UTARA', 225000),
(56, 2, 7, 'BOKONG', 225000),
(57, 2, 7, 'KUAKLALO', 225000),
(58, 2, 7, 'OELETSALA', 225000),
(59, 2, 7, 'OELTUAH', 225000),
(60, 2, 8, 'BISMARAK', 375000),
(61, 2, 8, 'BONE', 375000),
(62, 2, 8, 'OBEN', 375000),
(63, 2, 8, 'OEMASI', 375000),
(64, 2, 8, 'OELOMIN', 375000),
(65, 2, 8, 'OENIF', 375000),
(66, 2, 8, 'OEPAHA', 375000),
(67, 2, 8, 'TALOETAN', 375000),
(68, 2, 8, 'TASIKONA', 375000),
(69, 2, 8, 'TUNFEU', 375000),
(70, 2, 8, 'USAPI SONBAI', 375000),
(71, 2, 9, 'BATAKTE', 225000),
(72, 2, 9, 'OENESU', 225000),
(73, 2, 9, 'BOLOK', 225000),
(74, 2, 9, 'KUANHEUN', 225000),
(75, 2, 9, 'LIFULEO', 225000),
(76, 2, 9, 'MANULAI 1', 225000),
(77, 2, 9, 'NITNEO', 225000),
(78, 2, 9, 'OEMATNUNU', 225000),
(79, 2, 9, 'SUMLILI', 225000),
(80, 2, 9, 'TABLOLONG', 225000),
(81, 2, 9, 'TESABELA', 225000),
(82, 2, 10, 'BABAU', 250000),
(83, 2, 10, 'MERDEKA', 250000),
(84, 2, 10, 'NAIBONAT', 250000),
(85, 2, 10, 'OESAO', 250000),
(86, 2, 10, 'TUATUKA', 250000),
(87, 2, 10, 'MANUSAK', 250000),
(88, 2, 10, 'NUNKURUS', 250000),
(89, 2, 10, 'OEFAFI', 250000),
(90, 2, 10, 'OELATIMO', 250000),
(91, 2, 10, 'PUKDALE', 250000),
(92, 2, 10, 'TANAH PUTIH', 250000),
(93, 2, 10, 'TUAPUKAN', 250000),
(94, 2, 11, 'TARUS', 200000),
(95, 2, 11, 'MATA AIR', 200000),
(96, 2, 11, 'NOELBAKI', 200000),
(97, 2, 11, 'OEBELO', 200000),
(98, 2, 11, 'OELNASI', 200000),
(99, 2, 11, 'OELPUAH', 200000),
(100, 2, 11, 'PENFUI TIMUR', 200000),
(101, 2, 11, 'TANAH MERAH', 200000),
(102, 2, 12, 'NONBES', 475000),
(103, 2, 12, 'APREN', 475000),
(104, 2, 12, 'KOTABES', 475000),
(105, 2, 12, 'OENONI', 475000),
(106, 2, 12, 'OENONI 2', 475000),
(107, 2, 12, 'OESENA', 475000),
(108, 2, 12, 'PONAIN', 475000),
(109, 2, 12, 'TESBATAN', 475000),
(110, 2, 12, 'TESBATAN 2', 475000),
(111, 2, 13, 'TEUNBAUN', 475000),
(112, 2, 13, 'ERBAUN', 475000),
(113, 2, 13, 'MERBAUN', 475000),
(114, 2, 13, 'NEKBAUN', 475000),
(115, 2, 13, 'NIUKBAUN', 475000),
(116, 2, 13, 'SOBA', 475000),
(117, 2, 13, 'TOOBAUN', 475000),
(118, 2, 13, 'TUNBAUN', 475000),
(119, 2, 14, 'OEBESI', 475000),
(120, 2, 14, 'PAKUBAUN', 475000),
(121, 2, 14, 'RABEKA', 475000),
(122, 2, 14, 'ENORAEN', 475000),
(123, 2, 15, 'BURAEN ', 475000),
(124, 2, 15, 'SONRAEN', 475000),
(125, 2, 15, 'NEKMESE', 475000),
(126, 2, 15, 'RETRAEN', 475000),
(127, 2, 15, 'SONRAEN', 475000),
(128, 2, 16, 'FATUKANUTU', 475000),
(129, 2, 16, 'FATUTETA', 475000),
(130, 2, 16, 'KAIRANE', 475000),
(131, 2, 16, 'KUANHEUM', 475000),
(132, 2, 16, 'NIUNBAUN', 475000),
(133, 2, 16, 'OEFETO', 475000),
(134, 2, 16, 'RAKNAMO', 475000),
(135, 2, 17, 'ENOLALAN', 500000),
(136, 2, 17, 'MUKE', 500000),
(137, 2, 17, 'NUNMAFO', 500000),
(138, 2, 17, 'OEMOFA', 500000),
(139, 2, 17, 'OEMOLO', 500000),
(140, 2, 17, 'OENAUNU', 500000),
(141, 2, 17, 'OENIKO', 500000),
(142, 2, 17, 'OENUNTONO', 500000),
(143, 2, 17, 'PATHAU', 500000),
(144, 2, 17, 'SEKI', 500000),
(145, 2, 18, 'CAMPLONG I', 475000),
(146, 2, 18, 'CAMPLONG II', 475000),
(147, 2, 18, 'EKATETA', 475000),
(148, 2, 18, 'KIUONI', 475000),
(149, 2, 18, 'NAUNU', 475000),
(150, 2, 18, 'OEBOLA', 475000),
(151, 2, 18, 'OEBOLA DALAM', 475000),
(152, 2, 18, 'OELBITENO', 475000),
(153, 2, 18, 'SILLI', 475000),
(154, 2, 18, 'KUIMASI', 475000),
(155, 2, 18, 'TOLNAKU', 475000),
(156, 2, 19, 'NONBAUN', 550000),
(157, 2, 19, 'NUNSAEN', 550000),
(158, 2, 19, 'PASSI', 550000),
(159, 2, 19, 'OELBITENO', 550000),
(160, 2, 20, 'KALALI', 550000),
(161, 2, 20, 'NAITALE', 550000),
(162, 2, 20, 'NUATAUS', 550000),
(163, 2, 20, 'POTO', 550000),
(164, 2, 20, 'TUAKAU', 550000),
(165, 2, 21, 'TAKARI', 550000),
(166, 2, 21, 'BENU', 550000),
(167, 2, 21, 'FATUKOA', 550000),
(168, 2, 21, 'HUEKNUTU', 550000),
(169, 2, 21, 'KAUNIKI', 550000),
(170, 2, 21, 'NOELMINA', 550000),
(171, 2, 21, 'OELNAINENO', 550000),
(172, 2, 21, 'OESUSU', 550000),
(173, 2, 21, 'TANINI', 550000),
(174, 2, 21, 'TUAPANAF', 550000),
(175, 2, 22, 'SULAMU', 550000),
(176, 2, 22, 'BIPOLO', 550000),
(177, 2, 22, 'OETETA', 550000),
(178, 2, 22, 'PANTAI BERINGIN', 550000),
(179, 2, 22, 'PANTULAN ', 550000),
(180, 2, 22, 'PARITI', 550000),
(181, 2, 22, 'PITAI', 550000),
(182, 2, 22, 'PULAU KERA', 550000),
(183, 2, 23, 'FAUMES', 850000),
(184, 2, 23, 'HONUK', 850000),
(185, 2, 23, 'OELFATU', 850000),
(186, 2, 23, 'SAUKIBE', 850000),
(187, 2, 23, 'SOLIU', 850000),
(188, 2, 23, 'TIMAU', 850000),
(189, 2, 24, 'KIFU', 1000000),
(190, 2, 24, 'NETEMNANU', 1000000),
(191, 2, 24, 'NETEMNANU SELATAN', 1000000),
(192, 2, 24, 'NETEMNANU UTARA', 1000000),
(193, 2, 24, 'NUNUANAH', 1000000),
(194, 2, 25, 'LELOGAMA', 850000),
(195, 2, 25, 'FATUMETAN', 850000),
(196, 2, 25, 'FATUSUKI', 850000),
(197, 2, 25, 'LELOBOKO', 850000),
(198, 2, 25, 'OELBANU', 850000),
(199, 2, 25, 'OH AEM ', 850000),
(200, 2, 25, 'OH AEM 2', 850000),
(201, 2, 26, 'NAIKLIU', 900000),
(202, 2, 26, 'AFOAN', 900000),
(203, 2, 26, 'BAKUIN', 900000),
(204, 2, 26, 'FATUNAUS', 900000),
(205, 2, 26, 'KOLABE', 900000),
(206, 2, 26, 'LILMUS', 900000),
(207, 2, 27, 'MANUBELON', 900000),
(208, 2, 27, 'LETKOLE', 900000),
(209, 2, 27, 'NEFONEUT', 900000),
(210, 2, 27, 'BIOBA BARUTAEN', 900000),
(211, 2, 28, 'BATUINAN', 550000),
(212, 2, 28, 'BOKONUSAN ', 550000),
(213, 2, 28, 'HANSISI', 550000),
(214, 2, 28, 'HULELOT', 550000),
(215, 2, 28, 'LETBAUN', 550000),
(216, 2, 28, 'OTAN ', 550000),
(217, 2, 28, 'UIASA', 550000),
(218, 2, 28, 'UITAO', 550000),
(219, 2, 28, 'OESALAIN', 550000),
(220, 2, 29, 'AKLE ', 550000),
(221, 2, 29, 'NAIKEAN', 550000),
(222, 2, 29, 'ONANSILA', 550000),
(223, 2, 29, 'UIBOA', 550000),
(224, 2, 29, 'UITIUHANA', 550000),
(225, 2, 29, 'UITIUHTUAN', 550000),
(226, 3, 30, 'METINA', 1400000),
(227, 3, 30, 'MOKDALE', 1400000),
(228, 3, 30, 'NAMODALE', 1400000),
(229, 3, 30, 'BAADALE', 1400000),
(230, 3, 30, 'BEBALAIN', 1400000),
(231, 3, 30, 'HELEBEIK', 1400000),
(232, 3, 30, 'HOLOAMA', 1400000),
(233, 3, 30, 'KOLOBOLON', 1400000),
(234, 3, 30, 'KULI', 1400000),
(235, 3, 30, 'OELUNGGU', 1400000),
(236, 3, 30, 'OEMATAMBOLI', 1400000),
(237, 3, 30, 'SANGGOEN', 1400000),
(238, 3, 30, 'SUELAIN', 1400000),
(239, 3, 30, 'TUANATUK', 1400000),
(240, 3, 31, 'ONATALI', 1475000),
(241, 3, 31, 'LIDABESI', 1475000),
(242, 3, 31, 'LIDAMANU', 1475000),
(243, 3, 31, 'LIMAKOLI', 1475000),
(244, 3, 31, 'MAUBESI', 1475000),
(245, 3, 31, 'NGGODIMEDA', 1475000),
(246, 3, 31, 'SUEBELA', 1475000),
(247, 3, 32, 'OLAFULIHA', 1500000),
(248, 3, 32, 'BATULILOK', 1500000),
(249, 3, 32, 'EDALODE', 1500000),
(250, 3, 32, 'KEOEN', 1500000),
(251, 3, 32, 'LENUPETU', 1500000),
(252, 3, 32, 'NUSAKDALE', 1500000),
(253, 3, 32, 'OEBAU', 1500000),
(254, 3, 32, 'OELEDO', 1500000),
(255, 3, 32, 'SONIMAU', 1500000),
(256, 3, 32, 'TESABELA', 1500000),
(257, 3, 32, 'TUNGANAMO', 1500000),
(258, 3, 33, 'LONDALUSI', 1500000),
(259, 3, 33, 'BOLATENA', 1500000),
(260, 3, 33, 'DAIAMA', 1500000),
(261, 3, 33, 'FAIFUA', 1500000),
(262, 3, 33, 'HUNDI HOPO', 1500000),
(263, 3, 33, 'LAKAMOLA', 1500000),
(264, 3, 33, 'MATASIO', 1500000),
(265, 3, 33, 'MUKEKUKU', 1500000),
(266, 3, 33, 'SERUBEBA', 1500000),
(267, 3, 33, 'SOTIMORI', 1500000),
(268, 3, 34, 'BO\'A', 1600000),
(269, 3, 34, 'MBUEAIN', 1600000),
(270, 3, 34, 'NEMBERALA', 1600000),
(271, 3, 34, 'OELOLOT', 1600000),
(272, 3, 34, 'OENGGAUT', 1600000),
(273, 3, 34, 'OENITAS', 1600000),
(274, 3, 34, 'SEDEOEN', 1600000),
(275, 3, 35, 'BUSALANGGA', 1600000),
(276, 3, 35, 'BONI', 1600000),
(277, 3, 35, 'BDAUDOLO', 1600000),
(278, 3, 35, 'INGGUINAK', 1600000),
(279, 3, 35, 'LIDOR', 1600000),
(280, 3, 35, 'MODOSINAL', 1600000),
(281, 3, 35, 'NETENAEN', 1600000),
(282, 3, 35, 'OEBELA', 1600000),
(283, 3, 35, 'OELUA', 1600000),
(284, 3, 35, 'OETUTULU', 1600000),
(285, 3, 35, 'TEMAS ', 1600000),
(286, 3, 35, 'TOLAMA', 1600000),
(287, 3, 36, 'BATUTUA', 1600000),
(288, 3, 36, 'DALEK ESA', 1600000),
(289, 3, 36, 'DOLASI', 1600000),
(290, 3, 36, 'FUAFUNI', 1600000),
(291, 3, 36, 'LALUKOEN', 1600000),
(292, 3, 36, 'LANDU', 1600000),
(293, 3, 36, 'LEKIK', 1600000),
(294, 3, 36, 'LENTERA', 1600000),
(295, 3, 36, 'MBOKAK', 1600000),
(296, 3, 36, 'MEOAIN', 1600000),
(297, 3, 36, 'OEBAFOK', 1600000),
(298, 3, 36, 'OEBATU', 1600000),
(299, 3, 36, 'OEBAU', 1600000),
(300, 3, 36, 'OEHANDI', 1600000),
(301, 3, 36, 'OELASIN', 1600000),
(302, 3, 36, 'OESELI', 1600000),
(303, 3, 36, 'OETEFU', 1600000),
(304, 3, 36, 'SAKUBATUN', 1600000),
(305, 3, 36, 'SANGGANDOLU', 1600000),
(306, 3, 37, 'LIDABESI', 1600000),
(307, 3, 37, 'LIDAMANU', 1600000),
(308, 3, 37, 'LIMAKOLI', 1600000),
(309, 3, 37, 'MAUBESI', 1600000),
(310, 3, 37, 'NGGODIMEDA', 1600000),
(311, 3, 37, 'SUEBELA', 1600000),
(312, 3, 37, 'ONOTALI', 1600000),
(313, 3, 38, 'ANARAE', 1850000),
(314, 3, 38, 'MBALI LENDEIKI', 1850000),
(315, 3, 38, 'MBIU LOMBO', 1850000),
(316, 3, 38, 'NDAONUSE', 1850000),
(317, 3, 38, 'NUSE', 1850000),
(318, 3, 39, 'BOLATENA', 1850000),
(319, 3, 39, 'DAEURENDALE', 1850000),
(320, 3, 39, 'DAIAMA', 1850000),
(321, 3, 39, 'LIFULEO', 1850000),
(322, 3, 39, 'PUKUAFU', 1850000),
(323, 3, 39, 'SOTIMORI', 1850000),
(324, 3, 39, 'TENA LAI', 1850000),
(325, 4, 40, 'BODAE', 2000000),
(326, 4, 40, 'EIADA', 2000000),
(327, 4, 40, 'HUWAGA', 2000000),
(328, 4, 40, 'KEDURU', 2000000),
(329, 4, 40, 'KELIHA', 2000000),
(330, 4, 40, 'KUJI RATU', 2000000),
(331, 4, 40, 'LOBODEI', 2000000),
(332, 4, 40, 'LOBORAI', 2000000),
(333, 4, 41, ' BEBAE', 2000000),
(334, 4, 41, 'EILODE', 2000000),
(335, 4, 41, 'EIMADAKE', 2000000),
(336, 4, 41, 'EIMAU', 2000000),
(337, 4, 41, 'JIWUWU', 2000000),
(338, 4, 41, 'LOBOAJU', 2000000),
(339, 4, 41, 'MATEI', 2000000),
(340, 4, 41, 'LOBORAI', 2000000),
(341, 4, 42, 'DAINAO', 2000000),
(342, 4, 42, 'DEME', 2000000),
(343, 4, 42, 'EIKARE ', 2000000),
(344, 4, 42, 'EILOGO', 2000000),
(345, 4, 42, 'HALLA PAJI', 2000000),
(346, 4, 42, 'KOTAHAWU', 2000000),
(347, 4, 42, 'LEDEKE', 2000000),
(348, 4, 42, 'LEDETALO', 2000000),
(349, 4, 42, 'LOBORUI', 2000000),
(350, 4, 42, 'MEHONA', 2000000),
(351, 4, 42, 'RAEROBO', 2000000),
(352, 4, 42, 'WADUWALLA', 2000000),
(353, 4, 43, 'MEBBA', 2000000),
(354, 4, 43, 'DELO', 2000000),
(355, 4, 43, 'DESADEPE', 2000000),
(356, 4, 43, 'DJADU', 2000000),
(357, 4, 43, 'LEDEANA', 2000000),
(358, 4, 43, 'LEDEKEPAKA', 2000000),
(359, 4, 43, 'MENIA ', 2000000),
(360, 4, 43, 'NAAWAWI', 2000000),
(361, 4, 43, 'RAEDEWA', 2000000),
(362, 4, 43, 'RAEMUDE', 2000000),
(363, 4, 43, 'RAEKORE', 2000000),
(364, 4, 43, 'RAELORO', 2000000),
(365, 4, 43, 'RAEMADIA', 2000000),
(366, 4, 43, 'RAENALULU', 2000000),
(367, 4, 43, 'RAENYALE', 2000000),
(368, 4, 43, 'ROBOABA', 2000000),
(369, 4, 43, 'TEROIWO', 2000000),
(370, 4, 43, 'TITINALEDE', 2000000),
(371, 4, 44, 'DAIEKO', 2200000),
(372, 4, 44, 'GURIMONEARU', 2200000),
(373, 4, 44, 'LEDEAE', 2200000),
(374, 4, 44, 'LEDERAGA', 2200000),
(375, 4, 44, 'LOBOHEDE', 2200000),
(376, 4, 44, 'MOLIE', 2200000),
(377, 4, 44, 'PEDARRO', 2200000),
(378, 4, 44, 'RAMEDUE', 2200000),
(379, 4, 44, 'TANAJAWA', 2200000),
(380, 4, 44, 'WADUMADDI', 2200000),
(381, 4, 45, 'LEDEKE', 2200000),
(382, 4, 45, 'LEDEUNU', 2200000),
(383, 4, 45, 'BALLU', 2200000),
(384, 4, 45, 'BOLUA', 2200000),
(385, 4, 45, 'KOLORAE', 2200000);

-- --------------------------------------------------------

--
-- Table structure for table `kota`
--

CREATE TABLE `kota` (
  `id` int(5) NOT NULL,
  `nama` varchar(30) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `kota`
--

INSERT INTO `kota` (`id`, `nama`) VALUES
(1, 'Kota Kupang'),
(2, 'Kab. Kupang'),
(3, 'Kab. Rote Ndao'),
(4, 'Kab. Sabu Raijua');

-- --------------------------------------------------------

--
-- Table structure for table `skum`
--

CREATE TABLE `skum` (
  `id` int(5) NOT NULL,
  `no_skum` varchar(15) DEFAULT NULL,
  `no_perkara` varchar(50) DEFAULT NULL,
  `penyetor` varchar(100) NOT NULL,
  `biaya` int(20) NOT NULL,
  `untuk` varchar(50) NOT NULL,
  `tanggal` date DEFAULT NULL,
  `alur` varchar(1) NOT NULL,
  `bayar` int(1) NOT NULL DEFAULT 0
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Indexes for dumped tables
--

--
-- Indexes for table `jenis_perkara`
--
ALTER TABLE `jenis_perkara`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `kecamatan`
--
ALTER TABLE `kecamatan`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `kelurahan`
--
ALTER TABLE `kelurahan`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `kota`
--
ALTER TABLE `kota`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `skum`
--
ALTER TABLE `skum`
  ADD PRIMARY KEY (`id`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `jenis_perkara`
--
ALTER TABLE `jenis_perkara`
  MODIFY `id` int(2) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=31;

--
-- AUTO_INCREMENT for table `kecamatan`
--
ALTER TABLE `kecamatan`
  MODIFY `id` int(5) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=46;

--
-- AUTO_INCREMENT for table `kelurahan`
--
ALTER TABLE `kelurahan`
  MODIFY `id` int(5) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=386;

--
-- AUTO_INCREMENT for table `kota`
--
ALTER TABLE `kota`
  MODIFY `id` int(5) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=5;

--
-- AUTO_INCREMENT for table `skum`
--
ALTER TABLE `skum`
  MODIFY `id` int(5) NOT NULL AUTO_INCREMENT;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
