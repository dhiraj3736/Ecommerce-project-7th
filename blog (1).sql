-- phpMyAdmin SQL Dump
-- version 5.2.1
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Generation Time: Feb 14, 2024 at 01:00 PM
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
-- Database: `blog`
--

-- --------------------------------------------------------

--
-- Table structure for table `brand`
--

CREATE TABLE `brand` (
  `id` int(11) NOT NULL,
  `B_name` varchar(40) NOT NULL,
  `c_id` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `brand`
--

INSERT INTO `brand` (`id`, `B_name`, `c_id`) VALUES
(1, 'yamaha', 13),
(3, 'bajaj', 13),
(4, 'BMW', 12),
(5, 'Audi', 12),
(6, 'TVS', 13),
(7, 'classic', 14);

-- --------------------------------------------------------

--
-- Table structure for table `card`
--

CREATE TABLE `card` (
  `id` int(11) NOT NULL,
  `p_id` int(11) NOT NULL,
  `u_id` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `card`
--

INSERT INTO `card` (`id`, `p_id`, `u_id`) VALUES
(7, 29, 11),
(9, 29, 12),
(10, 21, 12),
(11, 20, 12),
(14, 22, 12),
(15, 20, 11),
(16, 18, 11),
(17, 25, 12),
(18, 22, 11);

-- --------------------------------------------------------

--
-- Table structure for table `category`
--

CREATE TABLE `category` (
  `id` int(11) NOT NULL,
  `Name` varchar(20) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `category`
--

INSERT INTO `category` (`id`, `Name`) VALUES
(12, 'Car'),
(13, 'Bike'),
(14, 'house');

-- --------------------------------------------------------

--
-- Table structure for table `item`
--

CREATE TABLE `item` (
  `id` int(11) NOT NULL,
  `image` text NOT NULL,
  `title` varchar(40) NOT NULL,
  `discription` mediumtext NOT NULL,
  `price` varchar(20) NOT NULL,
  `status` int(11) NOT NULL,
  `u_id` int(11) DEFAULT NULL,
  `i_date` date DEFAULT NULL,
  `c_id` int(11) DEFAULT NULL,
  `b_id` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `item`
--

INSERT INTO `item` (`id`, `image`, `title`, `discription`, `price`, `status`, `u_id`, `i_date`, `c_id`, `b_id`) VALUES
(19, 'PulsarNS125.png', 'ns-bajaj', 'kjnsjdckads', '400000', 0, 11, '2024-02-06', 13, 3),
(20, '6.jpg', 'car', 'JHNASJXJ', '8800000', 0, 11, '2024-02-06', 12, 4),
(21, '35019_AudiA3Cabriolet201735TFSI-015_468x263.jpg', 'audi', 'jkbdsckjb', '12000000', 0, 11, '2024-02-06', 12, 5),
(22, 'images (1).jpg', 'car2', 'djcbwjhb', '10200000', 0, 12, '2024-02-06', 12, 5),
(25, 'download.jpg', 'tvs', 'jdcjnsckjnkjn', '325000', 0, 11, '2024-02-07', 13, 6),
(29, 'pexels-photo-106399.jpeg', 'home', 'iudhcuiwhi', '200000000', 0, 11, '2024-02-12', 14, 7);

-- --------------------------------------------------------

--
-- Table structure for table `practice`
--

CREATE TABLE `practice` (
  `id` int(11) NOT NULL,
  `name` varchar(20) NOT NULL,
  `image` text NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `practice`
--

INSERT INTO `practice` (`id`, `name`, `image`) VALUES
(8, 'ssss', '2.jpg'),
(9, 'ssss', '2.jpg'),
(10, 'QQQQ', '2.jpg'),
(11, 'QQQQ', '2.jpg'),
(12, 'aaaaaa', '3.jpg');

-- --------------------------------------------------------

--
-- Table structure for table `user`
--

CREATE TABLE `user` (
  `id` int(11) NOT NULL,
  `Name` varchar(40) NOT NULL,
  `Email` varchar(40) NOT NULL,
  `Password` varchar(40) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `user`
--

INSERT INTO `user` (`id`, `Name`, `Email`, `Password`) VALUES
(11, 'Dhiraj bikram shah', 'dhiraj@gmail.com', 'dhiraj'),
(12, 'Milan aryal', 'milan@gmail.com', 'Milan');

--
-- Indexes for dumped tables
--

--
-- Indexes for table `brand`
--
ALTER TABLE `brand`
  ADD PRIMARY KEY (`id`),
  ADD KEY `c_id` (`c_id`);

--
-- Indexes for table `card`
--
ALTER TABLE `card`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `category`
--
ALTER TABLE `category`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `item`
--
ALTER TABLE `item`
  ADD PRIMARY KEY (`id`),
  ADD KEY `u_id` (`u_id`),
  ADD KEY `fk_category_id` (`c_id`),
  ADD KEY `FK_item` (`b_id`);

--
-- Indexes for table `practice`
--
ALTER TABLE `practice`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `user`
--
ALTER TABLE `user`
  ADD PRIMARY KEY (`id`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `brand`
--
ALTER TABLE `brand`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=8;

--
-- AUTO_INCREMENT for table `card`
--
ALTER TABLE `card`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=19;

--
-- AUTO_INCREMENT for table `category`
--
ALTER TABLE `category`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=15;

--
-- AUTO_INCREMENT for table `item`
--
ALTER TABLE `item`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=30;

--
-- AUTO_INCREMENT for table `practice`
--
ALTER TABLE `practice`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=13;

--
-- AUTO_INCREMENT for table `user`
--
ALTER TABLE `user`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=13;

--
-- Constraints for dumped tables
--

--
-- Constraints for table `brand`
--
ALTER TABLE `brand`
  ADD CONSTRAINT `brand_ibfk_1` FOREIGN KEY (`c_id`) REFERENCES `category` (`id`);

--
-- Constraints for table `item`
--
ALTER TABLE `item`
  ADD CONSTRAINT `FK_item` FOREIGN KEY (`b_id`) REFERENCES `brand` (`id`),
  ADD CONSTRAINT `fk_category_id` FOREIGN KEY (`c_id`) REFERENCES `category` (`id`),
  ADD CONSTRAINT `item_ibfk_1` FOREIGN KEY (`u_id`) REFERENCES `user` (`id`);
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
