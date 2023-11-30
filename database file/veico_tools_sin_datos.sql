-- phpMyAdmin SQL Dump
-- version 5.2.0
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Generation Time: Sep 14, 2023 at 09:00 AM
-- Server version: 8.0.31
-- PHP Version: 8.0.26

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

-- Create the database
CREATE DATABASE IF NOT EXISTS `veico_tools` DEFAULT CHARACTER SET utf8mb4 COLLATE utf8mb4_general_ci;


-- Use the database
USE `veico_tools`;

--
-- Database: `veico_tools`
--

-- --------------------------------------------------------

--
-- Table structure for table `item`
--

CREATE TABLE `item` (
  `id_item` char(7) NOT NULL,
  `name_item` varchar(255) NOT NULL ,
  `stock` int NOT NULL,
  `id_unit` int NOT NULL,
  `id_category` int NOT NULL,
  `price` int NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE utf8mb4_general_ci;


-- --------------------------------------------------------

--
-- Table structure for table `outgoing_goods`
--

CREATE TABLE `outgoing_goods` (
  `id_outgoing_goods` char(16) NOT NULL,
  `id_user` int NOT NULL,
  `recipient_name` char(50) NOT NULL,
  `address` text NOT NULL,
  `departure_date` date NOT NULL,
  `discount` double DEFAULT '0',
  `total_amount` int NOT NULL,
  `grand_total` int NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE utf8mb4_general_ci;


-- --------------------------------------------------------

--
-- Table structure for table `outgoing_goods_copy1`
--

CREATE TABLE `outgoing_goods_copy1` (
  `id_outgoing_goods` char(16) NOT NULL,
  `id_user` int NOT NULL,
  `id_item` char(7) NOT NULL,
  `recipient_name` char(50) NOT NULL,
  `address` text NOT NULL,
  `quantity_out` int NOT NULL,
  `departure_date` date NOT NULL,
  `total_amount` int NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE utf8mb4_general_ci;

--
-- Triggers `outgoing_goods_copy1`
--
DELIMITER $$
CREATE TRIGGER `update_stock_out_copy1` BEFORE INSERT ON `outgoing_goods_copy1` FOR EACH ROW UPDATE `item` SET `item`.`stock` = `item`.`stock` - NEW.quantity_out WHERE `item`.`id_item` = NEW.id_item
$$
DELIMITER ;

-- --------------------------------------------------------

--
-- Table structure for table `outgoing_goods_detail`
--

CREATE TABLE `outgoing_goods_detail` (
  `id_detail` int NOT NULL,
  `id_outgoing_goods` char(16) NOT NULL,
  `id_item` char(7) NOT NULL,
  `price` int NOT NULL,
  `quantity_out` int NOT NULL,
  `total_detail_amount` int NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE utf8mb4_general_ci;


--
-- Triggers `outgoing_goods_detail`
--
DELIMITER $$
CREATE TRIGGER `restore_stock_on_delete` AFTER DELETE ON `outgoing_goods_detail` FOR EACH ROW UPDATE `item` SET `item`.`stock` = `item`.`stock` + OLD.quantity_out WHERE `item`.`id_item` = OLD.id_item
$$
DELIMITER ;
DELIMITER $$
CREATE TRIGGER `out_update_stock_on_insert` BEFORE INSERT ON `outgoing_goods_detail` FOR EACH ROW UPDATE `item` SET `item`.`stock` = `item`.`stock` - NEW.quantity_out WHERE `item`.`id_item` = NEW.id_item
$$
DELIMITER ;


-- --------------------------------------------------------

--
-- Table structure for table `incoming_goods`
--

CREATE TABLE `incoming_goods` (
  `id_incoming_goods` char(16) NOT NULL,
  `id_supplier` int NOT NULL,
  `id_user` int NOT NULL,
  `id_item` char(7) NOT NULL,
  `quantity_in` int NOT NULL,
  `arrival_date` date NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE utf8mb4_general_ci;


--
-- Triggers `incoming_goods`
--
DELIMITER $$
CREATE TRIGGER `in_update_stock_on_insert` BEFORE INSERT ON `incoming_goods` FOR EACH ROW UPDATE `item` SET `item`.`stock` = `item`.`stock` + NEW.quantity_in WHERE `item`.`id_item` = NEW.id_item
$$
DELIMITER ;


-- --------------------------------------------------------

--
-- Table structure for table `category`
--

CREATE TABLE `category` (
  `id_category` int NOT NULL,
  `category_name` varchar(20) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE utf8mb4_general_ci;


-- --------------------------------------------------------

--
-- Table structure for table `unit`
--

CREATE TABLE `unit` (
  `id_unit` int NOT NULL,
  `unit_name` varchar(15) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE utf8mb4_general_ci;


-- --------------------------------------------------------

--
-- Table structure for table `supplier`
--

CREATE TABLE `supplier` (
  `id_supplier` int NOT NULL,
  `supplier_name` varchar(50) NOT NULL,
  `phone_number` varchar(15) NOT NULL,
  `address` text NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE utf8mb4_general_ci;


-- --------------------------------------------------------

--
-- Table structure for table `user`
--

CREATE TABLE `user` (
  `id_user` int NOT NULL,
  `name` varchar(50) NOT NULL,
  `username` varchar(50) NOT NULL,
  `email` varchar(100) NOT NULL,
  `phone_number` varchar(15) NOT NULL,
  `role` enum('employee','admin') NOT NULL,
  `password` varchar(255) NOT NULL,
  `created_at` int NOT NULL,
  `picture` text NOT NULL,
  `is_active` tinyint(1) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE utf8mb4_general_ci;


--
-- Dumping data for table `user`
--

INSERT INTO `user` (`id_user`, `name`, `username`, `email`, `phone_number`, `role`, `password`, `created_at`, `picture`, `is_active`) VALUES
(1, 'Administrator', 'admin', 'admin@email.com', '315-321-5743', 'admin', '$2y$10$7rLSvRVyTQORapkDOqmkhetjF6H9lJHngr4hJMSM2lHObJbW5EQh6', UNIX_TIMESTAMP(NOW()), 'user.png', 1);


--
-- Indexes for dumped tables
--

--
-- Indexes for table `item`
--
ALTER TABLE `item`
  ADD PRIMARY KEY (`id_item`) USING BTREE,
  ADD KEY `id_unit` (`id_unit`) USING BTREE,
  ADD KEY `id_category` (`id_category`) USING BTREE;

--
-- Indexes for table `outgoing_goods`
--
ALTER TABLE `outgoing_goods`
  ADD PRIMARY KEY (`id_outgoing_goods`) USING BTREE,
  ADD KEY `id_user` (`id_user`) USING BTREE;

--
-- Indexes for table `outgoing_goods_copy1`
--
ALTER TABLE `outgoing_goods_copy1`
  ADD PRIMARY KEY (`id_outgoing_goods`) USING BTREE,
  ADD KEY `id_user` (`id_user`) USING BTREE,
  ADD KEY `id_item` (`id_item`) USING BTREE;

--
-- Indexes for table `outgoing_goods_detail`
--
ALTER TABLE `outgoing_goods_detail`
  ADD PRIMARY KEY (`id_detail`) USING BTREE,
  ADD KEY `id_outgoing_goods` (`id_outgoing_goods`) USING BTREE;

--
-- Indexes for table `incoming_goods`
--
ALTER TABLE `incoming_goods`
  ADD PRIMARY KEY (`id_incoming_goods`) USING BTREE,
  ADD KEY `id_user` (`id_user`) USING BTREE,
  ADD KEY `id_supplier` (`id_supplier`) USING BTREE,
  ADD KEY `id_item` (`id_item`) USING BTREE;

--
-- Indexes for table `category`
--
ALTER TABLE `category`
  ADD PRIMARY KEY (`id_category`) USING BTREE;

--
-- Indexes for table `unit`
--
ALTER TABLE `unit`
  ADD PRIMARY KEY (`id_unit`) USING BTREE;

--
-- Indexes for table `supplier`
--
ALTER TABLE `supplier`
  ADD PRIMARY KEY (`id_supplier`) USING BTREE;

--
-- Indexes for table `user`
--
ALTER TABLE `user`
  ADD PRIMARY KEY (`id_user`) USING BTREE;

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `outgoing_goods_detail`
--
ALTER TABLE `outgoing_goods_detail`
  MODIFY `id_detail` int NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=29;
--
-- AUTO_INCREMENT for table `category`
--
ALTER TABLE `category`
  MODIFY `id_category` int NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=16;
--
-- AUTO_INCREMENT for table `unit`
--
ALTER TABLE `unit`
  MODIFY `id_unit` int NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=8;
--
-- AUTO_INCREMENT for table `supplier`
--
ALTER TABLE `supplier`
  MODIFY `id_supplier` int NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=11;
--
-- AUTO_INCREMENT for table `user`
--
ALTER TABLE `user`
  MODIFY `id_user` int NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=16;
--
-- Constraints for dumped tables
--

--
-- Constraints for table `item`
--
ALTER TABLE `item`
  ADD CONSTRAINT `item_fk1` FOREIGN KEY (`id_unit`) REFERENCES `unit` (`id_unit`) ON DELETE CASCADE ON UPDATE CASCADE,
  ADD CONSTRAINT `item_fk2` FOREIGN KEY (`id_category`) REFERENCES `category` (`id_category`) ON DELETE CASCADE ON UPDATE CASCADE;

--
-- Constraints for table `outgoing_goods`
--
ALTER TABLE `outgoing_goods`
  ADD CONSTRAINT `outgoing_goods_fk1` FOREIGN KEY (`id_user`) REFERENCES `user` (`id_user`) ON DELETE CASCADE ON UPDATE CASCADE;

--
-- Constraints for table `outgoing_goods_copy1`
--
ALTER TABLE `outgoing_goods_copy1`
  ADD CONSTRAINT `outgoing_goods_copy1_fk1` FOREIGN KEY (`id_user`) REFERENCES `user` (`id_user`) ON DELETE CASCADE ON UPDATE CASCADE,
  ADD CONSTRAINT `outgoing_goods_copy1_fk2` FOREIGN KEY (`id_item`) REFERENCES `item` (`id_item`) ON DELETE CASCADE ON UPDATE CASCADE;

--
-- Constraints for table `outgoing_goods_detail`
--
ALTER TABLE `outgoing_goods_detail`
  ADD CONSTRAINT `outgoing_goods_detail_fk1` FOREIGN KEY (`id_outgoing_goods`) REFERENCES `outgoing_goods` (`id_outgoing_goods`) ON DELETE CASCADE ON UPDATE CASCADE;

--
-- Constraints for table `incoming_goods`
--
ALTER TABLE `incoming_goods`
  ADD CONSTRAINT `incoming_goods_fk1` FOREIGN KEY (`id_user`) REFERENCES `user` (`id_user`) ON DELETE CASCADE ON UPDATE CASCADE,
  ADD CONSTRAINT `incoming_goods_fk2` FOREIGN KEY (`id_supplier`) REFERENCES `supplier` (`id_supplier`) ON DELETE CASCADE ON UPDATE CASCADE,
  ADD CONSTRAINT `incoming_goods_fk3` FOREIGN KEY (`id_item`) REFERENCES `item` (`id_item`) ON DELETE CASCADE ON UPDATE CASCADE;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
