-- phpMyAdmin SQL Dump
-- version 4.4.11
-- http://www.phpmyadmin.net
--
-- Host: localhost:8080
-- Generation Time: Aug 28, 2015 at 11:46 PM
-- Server version: 5.6.26
-- PHP Version: 5.6.11

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `shoes`
--
CREATE DATABASE IF NOT EXISTS `shoes` DEFAULT CHARACTER SET utf8 COLLATE utf8_general_ci;
USE `shoes`;

-- --------------------------------------------------------

--
-- Table structure for table `brands`
--

CREATE TABLE IF NOT EXISTS `brands` (
  `id` bigint(20) unsigned NOT NULL,
  `brand_name` varchar(255) DEFAULT NULL
) ENGINE=InnoDB AUTO_INCREMENT=5 DEFAULT CHARSET=utf8;

--
-- Dumping data for table `brands`
--

INSERT INTO `brands` (`id`, `brand_name`) VALUES
(1, 'Shoes'),
(2, 'Shoes'),
(3, 'OKAY Sneakers'),
(4, 'OKAY Sneakers');

-- --------------------------------------------------------

--
-- Table structure for table `stores`
--

CREATE TABLE IF NOT EXISTS `stores` (
  `id` bigint(20) unsigned NOT NULL,
  `store_name` varchar(255) DEFAULT NULL
) ENGINE=InnoDB AUTO_INCREMENT=9 DEFAULT CHARSET=utf8;

--
-- Dumping data for table `stores`
--

INSERT INTO `stores` (`id`, `store_name`) VALUES
(8, 'Merely DECENT Shoe Store');

-- --------------------------------------------------------

--
-- Table structure for table `stores_brands`
--

CREATE TABLE IF NOT EXISTS `stores_brands` (
  `id` bigint(20) unsigned NOT NULL,
  `store_id` int(11) DEFAULT NULL,
  `brand_id` int(11) DEFAULT NULL
) ENGINE=InnoDB AUTO_INCREMENT=8 DEFAULT CHARSET=utf8;

--
-- Indexes for dumped tables
--

--
-- Indexes for table `brands`
--
ALTER TABLE `brands`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `id` (`id`);

--
-- Indexes for table `stores`
--
ALTER TABLE `stores`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `id` (`id`);

--
-- Indexes for table `stores_brands`
--
ALTER TABLE `stores_brands`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `id` (`id`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `brands`
--
ALTER TABLE `brands`
  MODIFY `id` bigint(20) unsigned NOT NULL AUTO_INCREMENT,AUTO_INCREMENT=5;
--
-- AUTO_INCREMENT for table `stores`
--
ALTER TABLE `stores`
  MODIFY `id` bigint(20) unsigned NOT NULL AUTO_INCREMENT,AUTO_INCREMENT=9;
--
-- AUTO_INCREMENT for table `stores_brands`
--
ALTER TABLE `stores_brands`
  MODIFY `id` bigint(20) unsigned NOT NULL AUTO_INCREMENT,AUTO_INCREMENT=8;
/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
