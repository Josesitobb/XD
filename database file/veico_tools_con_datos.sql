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
  MODIFY `id_category` int NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=1;
--
-- AUTO_INCREMENT for table `unit`
--
ALTER TABLE `unit`
  MODIFY `id_unit` int NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=1;
--
-- AUTO_INCREMENT for table `supplier`
--
ALTER TABLE `supplier`
  MODIFY `id_supplier` int NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=1;
--
-- AUTO_INCREMENT for table `user`
--
ALTER TABLE `user`
  MODIFY `id_user` int NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=1;

  
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


--
-- Dumping data for table `user`
--

INSERT INTO `user` (`name`, `username`, `email`, `phone_number`, `role`, `password`, `created_at`, `picture`, `is_active`) VALUES
  ('Administrator', 'admin', 'admin@email.com', '315-321-5743', 'admin', '$2y$10$7rLSvRVyTQORapkDOqmkhetjF6H9lJHngr4hJMSM2lHObJbW5EQh6', UNIX_TIMESTAMP(NOW()), 'user.png', 1),
  ('Juan Pérez', 'juanperez', 'juan.perez@email.com', '315-123-4567', 'admin', '$2y$10$7rLSvRVyTQORapkDOqmkhetjF6H9lJHngr4hJMSM2lHObJbW5EQh6', UNIX_TIMESTAMP(NOW()), 'user.png', 1),
  ('Maria García', 'mariagarcia', 'maria.garcia@email.com', '312-987-6543', 'employee', '$2y$10$7rLSvRVyTQORapkDOqmkhetjF6H9lJHngr4hJMSM2lHObJbW5EQh6', UNIX_TIMESTAMP(NOW()), 'user.png', 0),
  ('Luis Rodríguez', 'luisrodriguez', 'luis.rodriguez@email.com', '318-456-7890', 'employee', '$2y$10$7rLSvRVyTQORapkDOqmkhetjF6H9lJHngr4hJMSM2lHObJbW5EQh6', UNIX_TIMESTAMP(NOW()), 'user.png', 1),
  ('Ana López', 'analopez', 'ana.lopez@email.com', '314-789-1234', 'employee', '$2y$10$7rLSvRVyTQORapkDOqmkhetjF6H9lJHngr4hJMSM2lHObJbW5EQh6', UNIX_TIMESTAMP(NOW()), 'user.png', 1),
  ('Pedro Ramírez', 'pedroramirez', 'pedro.ramirez@email.com', '319-654-7890', 'employee', '$2y$10$7rLSvRVyTQORapkDOqmkhetjF6H9lJHngr4hJMSM2lHObJbW5EQh6', UNIX_TIMESTAMP(NOW()), 'user.png', 1);


--
-- Dumping data for table `supplier`
--

INSERT INTO `supplier` (`supplier_name`, `phone_number`, `address`) VALUES
  ('Proveedor Uno', '321-123-4567', 'Calle 123, Bogotá'),
  ('Proveedor Dos', '320-987-6543', 'Avenida Principal, Medellín'),
  ('Proveedor Tres', '315-456-7890', 'Carrera 45, Cali'),
  ('Proveedor Cuatro', '318-789-1234', 'Calle 67, Barranquilla'),
  ('Proveedor Cinco', '314-654-7890', 'Avenida Central, Cartagena');


--
-- Dumping data for table `category`
--

INSERT INTO `category` (`category_name`) VALUES
  ('Electrodomésticos'),
  ('Electrónica'),
  ('Ropa'),
  ('Juguetes'),
  ('Herramientas'),
  ('Muebles'),
  ('Alimentos'),
  ('Bebidas'),
  ('Automóviles'),
  ('Libros');


--
-- Dumping data for table `unit`
--

INSERT INTO `unit` (`unit_name`) VALUES
  ('Unidades'),
  ('Kilogramos'),
  ('Litros'),
  ('Metros'),
  ('Paquetes'),
  ('Cajas'),
  ('Pares'),
  ('Galones');


--
-- Dumping data for table `item`
--

INSERT INTO `item` (`id_item`, `name_item`, `stock`, `id_unit`, `id_category`, `price`) VALUES
  ('CA0000', 'Refrigerador', 20, 1, 1, 1500000),
  ('CA0001', 'Televisor LED', 15, 1, 2, 800000),
  ('CA0002', 'Camiseta Deportiva', 50, 2, 3, 50000),
  ('CA0003', 'Juguete Educativo', 30, 1, 4, 35000),
  ('CA0004', 'Taladro Eléctrico', 10, 5, 5, 120000),
  ('CA0005', 'Sofá de Cuero', 8, 5, 6, 2500000),
  ('CA0006', 'Arroz', 100, 3, 7, 3000),
  ('CA0007', 'Refresco de Cola', 80, 3, 8, 2000),
  ('CA0008', 'Automóvil Sedán', 5, 4, 9, 30000000),
  ('CA0009', 'Libro de Ciencia', 25, 2, 10, 45000);
  

--
-- Dumping data for table `incoming_goods`
--

INSERT INTO `incoming_goods` (`id_incoming_goods`, `id_supplier`, `id_user`, `id_item`, `quantity_in`, `arrival_date`) VALUES
  ('I2106030000', 1, 1, 'CA0001', 5, '2023-08-14'),
  ('I2106030001', 2, 1, 'CA0002', 7, '2023-04-15'),
  ('I2106030002', 3, 2, 'CA0003', 10, '2023-08-16'),
  ('I2106030003', 4, 2, 'CA0004', 15, '2023-02-17'),
  ('I2106030004', 5, 3, 'CA0005', 3, '2023-06-18');


--
-- Dumping data for table `outgoing_goods`
--

INSERT INTO `outgoing_goods` (`id_outgoing_goods`, `id_user`, `recipient_name`, `address`, `departure_date`, `discount`, `total_amount`, `grand_total`) VALUES
  ('S2106030001', 1, 'Cliente Uno', 'Calle 1, Bogotá', '2023-09-14', 10000, 300000, 290000),
  ('S2106030002', 2, 'Cliente Dos', 'Avenida 2, Medellín', '2023-07-15', 15000, 500000, 485000),
  ('S2106030003', 3, 'Cliente Tres', 'Carrera 3, Cali', '2023-09-16', 2000, 75000, 73000),
  ('S2106030004', 4, 'Cliente Cuatro', 'Calle 4, Barranquilla', '2023-03-17', 5000, 150000, 145000),
  ('S2106030005', 5, 'Cliente Cinco', 'Avenida 5, Cartagena', '2023-04-18', 30000, 1000000, 970000);


--
-- Dumping data for table `outgoing_goods_detail`
--

INSERT INTO `outgoing_goods_detail` (`id_outgoing_goods`, `id_item`, `price`, `quantity_out`, `total_detail_amount`) VALUES
  ('S2106030001', 'CA0000', 1500000, 2, 3000000),
  ('S2106030002', 'CA0001', 800000, 3, 2400000),
  ('S2106030003', 'CA0002', 50000, 5, 250000),
  ('S2106030004', 'CA0003', 35000, 7, 245000),
  ('S2106030005', 'CA0004', 120000, 1, 120000);


--
-- Triggers `outgoing_goods_copy1`
--
DELIMITER $$
CREATE TRIGGER `update_stock_out_copy1` BEFORE INSERT ON `outgoing_goods_copy1` FOR EACH ROW UPDATE `item` SET `item`.`stock` = `item`.`stock` - NEW.quantity_out WHERE `item`.`id_item` = NEW.id_item
$$
DELIMITER ;

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

--
-- Triggers `incoming_goods`
--
DELIMITER $$
CREATE TRIGGER `in_update_stock_on_insert` BEFORE INSERT ON `incoming_goods` FOR EACH ROW UPDATE `item` SET `item`.`stock` = `item`.`stock` + NEW.quantity_in WHERE `item`.`id_item` = NEW.id_item
$$
DELIMITER ;


/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
