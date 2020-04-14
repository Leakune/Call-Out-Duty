-- phpMyAdmin SQL Dump
-- version 4.8.3
-- https://www.phpmyadmin.net/
--
-- Host: localhost:3308
-- Generation Time: Apr 13, 2020 at 03:32 PM
-- Server version: 5.7.24-log
-- PHP Version: 7.2.10

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
SET AUTOCOMMIT = 0;
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `projet_annuel`
--

-- --------------------------------------------------------

--
-- Table structure for table `services`
--

CREATE TABLE `services` (
  `id` int(11) NOT NULL,
  `name` varchar(100) DEFAULT NULL,
  `price` float DEFAULT NULL,
  `img_name` varchar(65) DEFAULT NULL,
  `img_path` varchar(200) DEFAULT NULL,
  `description` varchar(200) DEFAULT NULL,
  `status` tinyint(4) DEFAULT NULL,
  `Category_id` int(11) DEFAULT NULL,
  `intervalle` varchar(10) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Dumping data for table `services`
--

INSERT INTO `services` (`id`, `name`, `price`, `img_name`, `img_path`, `description`, `status`, `Category_id`, `intervalle`) VALUES
(95, 'Table basse', 199.99, 'table-basse.jpg', NULL, 'Table basse grave stylé', 1, 14, ''),
(121, 'KAJEIOU', 230, '559116.png', 'files/559116.png', 'sqd', 1, 17, ''),
(126, 'service1', 230, 'banaue-rice-terraces-164196.jpg', 'files/banaue-rice-terraces-164196.jpg', 'qda', 1, 15, ''),
(127, 'service2', 230, 'battle-black-board-game-chess-411207.jpg', 'files/battle-black-board-game-chess-411207.jpg', 'fqfsdf', 1, 18, ''),
(128, 'service3', 230, '19550_en_1.jfif', 'files/19550_en_1.jfif', 'fsfsdfa', 1, 16, ''),
(134, 'Garde d\'enfant', 12, NULL, NULL, 'Garde d\'enfant chez vous pour 12€/h', 1, 18, 'heures');

--
-- Indexes for dumped tables
--

--
-- Indexes for table `services`
--
ALTER TABLE `services`
  ADD PRIMARY KEY (`id`),
  ADD KEY `fk_Service_Category1` (`Category_id`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `services`
--
ALTER TABLE `services`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=135;

--
-- Constraints for dumped tables
--

--
-- Constraints for table `services`
--
ALTER TABLE `services`
  ADD CONSTRAINT `fk_Service_Category1` FOREIGN KEY (`Category_id`) REFERENCES `category` (`id`);
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
