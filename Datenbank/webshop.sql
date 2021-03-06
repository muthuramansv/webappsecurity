-- phpMyAdmin SQL Dump
-- version 4.8.0
-- https://www.phpmyadmin.net/
--
-- Host: localhost
-- Generation Time: Jun 15, 2018 at 10:19 PM
-- Server version: 10.1.31-MariaDB
-- PHP Version: 7.2.4

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
SET AUTOCOMMIT = 0;
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `webshop`
--

-- --------------------------------------------------------

--
-- Table structure for table `tbl_items`
--

CREATE TABLE `tbl_items` (
  `id` int(11) NOT NULL,
  `name` char(255) NOT NULL,
  `price` float NOT NULL,
  `description` char(255) NOT NULL,
  `stock` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `tbl_items`
--

INSERT INTO `tbl_items` (`id`, `name`, `price`, `description`, `stock`) VALUES
(1, 'The Web Application Hacker\'s Handbook', 34.99, 'Web applications are everywhere, and they\'re insecure. Banks, retailers, and others have deployed millions of applications that are full of holes, allowing attackers to steal personal data, carry out fraud, and compromise other systems.', 5),
(2, 'The Tangled Web: A Guide to Securing Modern Web Applications', 40, 'Modern web applications are built on a tangle of technologies that have been developed over time and then haphazardly pieced together.', 5),
(3, 'The Hacker Playbook 2: Practical Guide To Penetration Testing', 19.31, 'Just as a professional athlete doesn’t show up without a solid game plan, ethical hackers, IT professionals, and security researchers should not be unprepared, either', 5),
(4, 'Black Hat Python: Python Programming for Hackers and Pentesters.', 20.99, 'When it comes to creating powerful and effective hacking tools, Python is the language of choice for most security analysts. But just how does the magic happen?', 5),
(5, 'Attacking Network Protocols: A Hacker\'s Guide to Capture, Analysis, and Exploitation', 28.99, 'Attacking Network Protocols is a deep dive into network protocol security from James ­Forshaw, one of the world’s leading bug ­hunters.', 5);

-- --------------------------------------------------------

--
-- Table structure for table `tbl_orders`
--

CREATE TABLE `tbl_orders` (
  `id` int(11) NOT NULL,
  `id_user` int(11) NOT NULL,
  `id_items` int(11) NOT NULL,
  `count` int(11) NOT NULL,
  `orderdate` datetime NOT NULL DEFAULT CURRENT_TIMESTAMP
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

-- --------------------------------------------------------

--
-- Table structure for table `tbl_user`
--

CREATE TABLE `tbl_user` (
  `id` int(11) NOT NULL,
  `firstname` char(255) NOT NULL,
  `lastname` char(255) NOT NULL,
  `address` char(255) NOT NULL,
  `mail` char(255) NOT NULL,
  `pass` char(255) NOT NULL,
  `token` varchar(255) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Indexes for dumped tables
--

--
-- Indexes for table `tbl_items`
--
ALTER TABLE `tbl_items`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `tbl_orders`
--
ALTER TABLE `tbl_orders`
  ADD PRIMARY KEY (`id`),
  ADD KEY `id_user` (`id_user`),
  ADD KEY `tbl_orders_ibfk_1` (`id_items`);

--
-- Indexes for table `tbl_user`
--
ALTER TABLE `tbl_user`
  ADD PRIMARY KEY (`id`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `tbl_items`
--
ALTER TABLE `tbl_items`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=6;

--
-- AUTO_INCREMENT for table `tbl_orders`
--
ALTER TABLE `tbl_orders`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=6;

--
-- AUTO_INCREMENT for table `tbl_user`
--
ALTER TABLE `tbl_user`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=6;

--
-- Constraints for dumped tables
--

--
-- Constraints for table `tbl_orders`
--
ALTER TABLE `tbl_orders`
  ADD CONSTRAINT `tbl_orders_ibfk_1` FOREIGN KEY (`id_items`) REFERENCES `tbl_items` (`id`);
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
