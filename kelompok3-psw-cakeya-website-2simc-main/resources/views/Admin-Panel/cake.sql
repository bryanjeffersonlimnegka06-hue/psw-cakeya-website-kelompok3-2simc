-- phpMyAdmin SQL Dump
-- version 5.2.1
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Generation Time: Jun 08, 2026 at 04:18 PM
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
-- Database: `laravel`
--

-- --------------------------------------------------------

--
-- Table structure for table `cake`
--

CREATE TABLE `cake` (
  `cake_id` int(11) NOT NULL,
  `cake_name` varchar(255) DEFAULT NULL,
  `cost` float DEFAULT NULL,
  `description` text DEFAULT NULL,
  `pic` varchar(255) NOT NULL,
  `penjualan` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `cake`
--

INSERT INTO `cake` (`cake_id`, `cake_name`, `cost`, `description`, `pic`, `penjualan`) VALUES
(1, 'Kembang Strawberry', 10000, 'Tampil cantik dengan bentuk bunga yang menggoda, kue ini hadir dengan rasa strawberry yang manis, lembut, dan menyegarkan. Warna dan aromanya membuat siapa saja tertarik untuk mencicipi sejak pertama melihatnya. Sangat cocok untuk jadi sajian meja tamu karena tampilannya yang cantik sekaligus rasanya yang disukai anak-anak hingga orang dewasa. Manisnya pas, bikin suasana kumpul jadi lebih hangat dan menyenangkan.', 'stroberryhd.png', 122),
(2, 'Nastar', 45000, 'Tidak lengkap rasanya momen Lebaran tanpa nastar favorit keluarga. Dibuat dengan kulit kue buttery yang lembut dan lumer di mulut, dipadukan dengan selai nanas premium yang legit dan harum. Setiap gigitan memberikan rasa manis yang pas tanpa berlebihan, membuat siapa saja ingin mengambil lagi dan lagi. Cocok dijadikan suguhan utama saat hari raya maupun hadiah spesial untuk orang tersayang.', 'nastar48k.png', 333),
(3, 'Kastengel', 45000, 'Nikmati sensasi gurih dan renyah dari kastengel premium yang dibuat dengan perpaduan keju pilihan berkualitas. Aroma kejunya yang menggoda langsung terasa sejak kemasan dibuka, sementara teksturnya yang crunchy di luar namun lembut di dalam bikin sulit berhenti ngemil. Cocok disajikan saat kumpul keluarga, menjamu tamu spesial, atau sekadar menemani waktu santai bersama secangkir teh dan kopi favorit. Satu toples rasanya nggak akan pernah cukup!', 'kastengel45k.png', 44),
(4, 'Brownies Stim Coklat', 45000, 'Brownies cokelat dengan tekstur super lembut dan moist yang langsung lumer di mulut. Dipenuhi rasa cokelat yang kaya dan aroma manis yang menggoda, membuat dessert ini jadi favorit banyak orang. Cocok dinikmati saat berbuka puasa, kumpul keluarga, maupun sebagai hadiah spesial untuk orang tersayang.', 'BrowniesStimCoklat_WAR0018.png', 5),
(5, 'Onde-Onde Pandan', 100000, 'Perpaduan sempurna antara harum pandan yang khas dengan taburan wijen yang menggugah selera. Setiap gigitan menghadirkan rasa manis yang pas, lembut, dan bikin nostalgia suasana hangat di rumah saat Lebaran. Teksturnya yang unik memberikan pengalaman ngemil yang berbeda dari kue kering biasa. Cocok untuk kamu yang suka cita rasa tradisional dengan sentuhan modern yang lebih premium dan elegan.', 'onde_onde_pandan.png\n', 66),
(6, 'Choco Chip', 40000, 'Cookies renyah dengan taburan choco chip melimpah yang siap memanjakan pecinta cokelat. Rasanya manis, creamy, dan sangat cocok dinikmati kapan saja — baik saat santai, bekerja, belajar, maupun berkumpul bersama keluarga. Aroma cokelatnya yang menggoda dipadukan dengan tekstur cookies yang crunchy membuat setiap gigitan terasa spesial. Favorit semua usia, dari anak-anak sampai orang dewasa!', 'Choco_Chip.png', 677),
(7, 'Bolu Stim Talas Ungu', 10000, 'Bolu lembut dengan cita rasa talas ungu yang khas dan tampilan warna cantik yang menggoda selera. Dipadukan dengan topping keju melimpah yang gurih dan creamy, menciptakan kombinasi rasa yang unik dan premium. Cocok untuk kamu yang ingin menikmati dessert tradisional dengan sentuhan modern yang elegan.', 'BoluStimTalasUngu.png', 88),
(8, 'Bolu Stim Pandan Keju', 22000, 'Harumnya pandan alami berpadu sempurna dengan topping keju yang melimpah dan creamy. Teksturnya super lembut dan ringan sehingga nyaman dinikmati kapan saja. Rasa manis dan gurihnya seimbang, menjadikan bolu ini salah satu pilihan favorit untuk menemani momen Ramadan bersama keluarga.', 'BoluStimPandanKeju_WAR0066.png', 99),
(9, 'Bolu Stim Ketan Coklat', 33000, 'Perpaduan ketan yang legit dengan rasa cokelat yang manis menciptakan tekstur unik dan memanjakan lidah. Bolu ini memiliki kelembutan yang khas dengan aroma cokelat yang begitu menggoda. Cocok untuk kamu yang suka dessert tradisional dengan cita rasa lebih modern dan premium.', 'BoluStimKetanCoklat_WAR0004 (1).png', 88),
(10, 'Bolu Stim Kelapa', 444000, 'Bolu lembut dengan aroma kelapa yang harum dan rasa manis yang pas di lidah. Dipadukan topping keju yang melimpah sehingga memberikan sensasi gurih dan creamy yang seimbang. Cocok menjadi sajian hangat untuk menemani waktu berkumpul bersama keluarga tercinta.', 'BoluStimKelapa_WAR0100.png', 77),
(11, 'Bolu Stim Durian Keju', 100000, 'Dessert premium untuk pecinta durian dengan rasa creamy khas yang kuat namun tetap lembut di mulut. Dipadukan dengan topping keju melimpah yang menambah sensasi gurih dan mewah di setiap gigitan. Aroma duriannya yang khas membuat bolu ini jadi pilihan spesial yang sulit dilupakan.', 'BoluStimDurianKeju_WAR0080.png', 666),
(12, 'Bolu Stim Coklat Oreo', 100000, 'Bolu cokelat lembut dengan taburan Oreo crumble yang crunchy dan melimpah di atasnya. Kombinasi rasa manis cokelat dan cookies Oreo menciptakan sensasi dessert kekinian yang disukai semua kalangan. Cocok untuk menemani waktu santai maupun jadi sajian spesial saat berkumpul bersama keluarga.', 'BoluStimCoklatOreo_WAR0054.png', 55),
(13, 'Bolu Stim Coklat Keju', 100000, 'Perpaduan cokelat manis dengan topping keju creamy yang gurih menciptakan rasa yang sempurna di setiap potongan. Teksturnya lembut, moist, dan sangat memanjakan lidah. Cocok jadi pilihan dessert favorit untuk segala suasana, mulai dari santai hingga perayaan spesial.', 'BoluStimCoklatKeju_WAR0115.png', 55),
(14, 'Bolu Stim Marble Keju', 100000, 'Cake marble dengan perpaduan motif cantik dan rasa lembut yang lumer di mulut. Topping keju melimpah memberikan sentuhan gurih dan premium yang membuat tampilannya semakin menggoda. Cocok dijadikan suguhan elegan untuk tamu maupun keluarga tercinta.', 'BoluStimCoklatKeju_WAR0025.png', 44),
(15, 'Bolu Stim Coklat Almond', 100000, 'Bolu cokelat premium dengan topping almond renyah yang memberikan sensasi crunchy di setiap gigitan. Rasa cokelatnya kaya dan manisnya pas, dipadukan aroma almond yang membuat dessert ini terasa lebih mewah dan elegan. Pilihan sempurna untuk pecinta dessert premium yang ingin menikmati camilan spesial bersama keluarga.', 'BoluStimCoklatAlmond_WAR0041.png', 33);

-- --------------------------------------------------------

--
-- Table structure for table `user`
--

CREATE TABLE `user` (
  `user_id` int(11) NOT NULL,
  `username` varchar(255) DEFAULT NULL,
  `password` varchar(255) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `user`
--

INSERT INTO `user` (`user_id`, `username`, `password`) VALUES
(2, 'Admin123', 'Admin123');

--
-- Indexes for dumped tables
--

--
-- Indexes for table `cake`
--
ALTER TABLE `cake`
  ADD PRIMARY KEY (`cake_id`);

--
-- Indexes for table `user`
--
ALTER TABLE `user`
  ADD PRIMARY KEY (`user_id`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `cake`
--
ALTER TABLE `cake`
  MODIFY `cake_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=25;

--
-- AUTO_INCREMENT for table `user`
--
ALTER TABLE `user`
  MODIFY `user_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=4;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
