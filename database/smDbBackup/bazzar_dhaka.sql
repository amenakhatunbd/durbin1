-- phpMyAdmin SQL Dump
-- version 4.8.3
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Generation Time: May 15, 2019 at 07:59 AM
-- Server version: 10.1.36-MariaDB
-- PHP Version: 7.1.22

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
SET AUTOCOMMIT = 0;
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `bazzar_dhaka`
--

-- --------------------------------------------------------

--
-- Table structure for table `admins`
--

CREATE TABLE `admins` (
  `id` int(10) UNSIGNED NOT NULL,
  `username` varchar(191) NOT NULL,
  `email` varchar(191) NOT NULL,
  `firstname` varchar(191) DEFAULT NULL,
  `lastname` varchar(191) DEFAULT NULL,
  `password` varchar(60) NOT NULL,
  `image` varchar(191) DEFAULT NULL,
  `role_id` int(10) UNSIGNED NOT NULL DEFAULT '0',
  `status` tinyint(4) NOT NULL DEFAULT '2' COMMENT '1=active, 2=pending, 3=cancel',
  `remember_token` varchar(100) DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Dumping data for table `admins`
--

INSERT INTO `admins` (`id`, `username`, `email`, `firstname`, `lastname`, `password`, `image`, `role_id`, `status`, `remember_token`, `created_at`, `updated_at`) VALUES
(1, 'admin', 'admin@gmail.com', NULL, NULL, '$2y$10$7uGrDkSV9ywM9g0lWfQm9OyKccTiFQcWsid5zyjT0AkXT5PYFaICO', '', 1, 1, 'nfES9Qc3Qej9O753gtClYLKCjfo2AYFeZ6GZb68o5DtaUQmC46EnYcFIz8sf', NULL, NULL);

-- --------------------------------------------------------

--
-- Table structure for table `admins_metas`
--

CREATE TABLE `admins_metas` (
  `id` int(10) UNSIGNED NOT NULL,
  `admin_id` int(11) NOT NULL,
  `meta_key` text NOT NULL,
  `meta_value` longtext,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Dumping data for table `admins_metas`
--

INSERT INTO `admins_metas` (`id`, `admin_id`, `meta_key`, `meta_value`, `created_at`, `updated_at`) VALUES
(1, 1, 'user_online_status', '1', '2019-04-18 09:40:36', '2019-05-06 03:18:24'),
(2, 1, 'user_last_activity', '2019-05-06 09:18:05', '2019-04-30 08:45:31', '2019-05-06 03:18:05');

-- --------------------------------------------------------

--
-- Table structure for table `attributes`
--

CREATE TABLE `attributes` (
  `id` int(10) UNSIGNED NOT NULL,
  `attributetitle_id` int(10) UNSIGNED NOT NULL,
  `title` varchar(191) NOT NULL,
  `type` varchar(191) DEFAULT NULL,
  `status` tinyint(4) NOT NULL DEFAULT '2' COMMENT '1=active, 2=pending, 3=cancel',
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Dumping data for table `attributes`
--

INSERT INTO `attributes` (`id`, `attributetitle_id`, `title`, `type`, `status`, `created_at`, `updated_at`) VALUES
(1, 2, 'S', 'Size', 2, '2019-04-18 11:17:04', '2019-04-18 11:17:04'),
(2, 2, 'M', 'Size', 2, '2019-04-18 11:17:11', '2019-04-18 11:17:11'),
(3, 2, 'L', 'Size', 2, '2019-04-18 11:17:17', '2019-04-18 11:17:17'),
(4, 2, 'XL', 'Size', 2, '2019-04-18 11:17:27', '2019-04-18 11:17:27'),
(5, 2, 'XXL', 'Size', 2, '2019-04-18 11:17:39', '2019-04-18 11:17:39'),
(6, 2, 'XXXL', 'Size', 2, '2019-04-18 11:18:08', '2019-04-18 11:18:08'),
(7, 1, 'Variable', 'Color', 2, '2019-04-18 11:18:55', '2019-04-18 11:18:55'),
(8, 1, 'Grey', 'Color', 2, '2019-04-18 11:19:17', '2019-04-18 11:19:17'),
(9, 1, 'Black', 'Color', 2, '2019-04-18 11:19:27', '2019-04-18 11:19:27'),
(10, 1, 'White', 'Color', 2, '2019-04-18 11:19:38', '2019-04-18 11:19:38'),
(11, 1, 'Navy Blue', 'Color', 2, '2019-04-18 11:19:50', '2019-04-18 11:19:50');

-- --------------------------------------------------------

--
-- Table structure for table `attributetitles`
--

CREATE TABLE `attributetitles` (
  `id` int(10) UNSIGNED NOT NULL,
  `title` varchar(191) NOT NULL,
  `description` text,
  `image` varchar(191) DEFAULT NULL,
  `slug` varchar(191) NOT NULL,
  `created_by` int(10) UNSIGNED DEFAULT NULL,
  `modified_by` int(10) UNSIGNED DEFAULT NULL,
  `seo_title` varchar(191) DEFAULT NULL,
  `meta_key` text,
  `meta_description` text,
  `status` tinyint(4) NOT NULL DEFAULT '2' COMMENT '1=active, 2=pending, 3=cancel',
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Dumping data for table `attributetitles`
--

INSERT INTO `attributetitles` (`id`, `title`, `description`, `image`, `slug`, `created_by`, `modified_by`, `seo_title`, `meta_key`, `meta_description`, `status`, `created_at`, `updated_at`) VALUES
(1, 'Color', NULL, NULL, 'color', 1, NULL, NULL, NULL, NULL, 1, '2019-04-18 11:16:20', '2019-04-18 11:16:20'),
(2, 'Size', NULL, NULL, 'size', 1, NULL, NULL, NULL, NULL, 1, '2019-04-18 11:16:35', '2019-04-18 11:16:35');

-- --------------------------------------------------------

--
-- Table structure for table `attribute_product`
--

CREATE TABLE `attribute_product` (
  `id` int(10) UNSIGNED NOT NULL,
  `attribute_id` int(10) UNSIGNED DEFAULT NULL,
  `product_id` int(10) UNSIGNED DEFAULT NULL,
  `color_id` int(10) UNSIGNED DEFAULT NULL,
  `attribute_image` varchar(191) DEFAULT NULL,
  `attribute_qty` int(11) DEFAULT NULL,
  `attribute_legnth` varchar(50) DEFAULT NULL,
  `attribute_front` varchar(50) DEFAULT NULL,
  `attribute_back` varchar(50) DEFAULT NULL,
  `attribute_chest` varchar(50) DEFAULT NULL,
  `attribute_price` decimal(10,2) DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Dumping data for table `attribute_product`
--

INSERT INTO `attribute_product` (`id`, `attribute_id`, `product_id`, `color_id`, `attribute_image`, `attribute_qty`, `attribute_legnth`, `attribute_front`, `attribute_back`, `attribute_chest`, `attribute_price`, `created_at`, `updated_at`) VALUES
(1, 3, 1, 7, 'img_1231.jpg', 1, '31', NULL, NULL, '40', '2850.00', NULL, '2019-04-20 07:05:51'),
(2, 2, 1, 7, 'img_1275.jpg', 2, '30.5', NULL, NULL, '38', '2850.00', NULL, '2019-04-20 07:05:51'),
(3, 1, 1, 7, 'img_1274.jpg', 1, '30', NULL, NULL, '36', '2850.00', NULL, '2019-04-20 07:05:52'),
(4, 4, 1, 7, 'img_1272.jpg', 1, '31.5', NULL, NULL, '42', '2850.00', NULL, '2019-04-20 07:05:52'),
(5, 3, 2, 7, NULL, 3, '43', NULL, NULL, '40', '1950.00', NULL, '2019-04-20 07:10:31'),
(6, 2, 2, 7, NULL, 3, '42.5', NULL, NULL, '38', '1950.00', NULL, '2019-04-20 07:10:31'),
(7, 1, 2, 7, NULL, 2, '42', NULL, NULL, '36', '1950.00', NULL, '2019-04-20 07:10:31'),
(8, 4, 2, 7, NULL, 1, '43.5', NULL, NULL, '42', '1950.00', NULL, '2019-04-20 07:10:32'),
(9, 5, 2, 7, NULL, 1, '44', NULL, NULL, '44', '1950.00', NULL, '2019-04-20 07:10:32'),
(10, 3, 3, 7, NULL, 2, NULL, '32.5', '33.5', '40', '1550.00', NULL, '2019-04-20 07:25:44'),
(11, 2, 3, 7, NULL, 2, NULL, '32', '33', '38', '1550.00', NULL, '2019-04-20 07:25:44'),
(12, 1, 3, 7, NULL, 1, NULL, '31.5', '32.5', '36', '1550.00', NULL, '2019-04-20 07:25:44'),
(13, 4, 3, 7, NULL, 1, NULL, '33', '34', '42', '1550.00', NULL, '2019-04-20 07:25:44'),
(14, 1, 4, 7, NULL, 1, NULL, '28', '30', '36', '1850.00', NULL, NULL),
(15, 2, 4, 7, NULL, 1, NULL, '28.5', '30.5', '38', '1850.00', NULL, NULL),
(16, 3, 4, 7, NULL, 1, NULL, '29', '31', '40', '1850.00', NULL, NULL),
(17, 4, 4, 7, NULL, 1, NULL, '29.5', '31.5', '42', '1850.00', NULL, NULL),
(18, 5, 4, 7, NULL, 1, NULL, '30', '32', '44', '1850.00', NULL, NULL),
(19, 3, 5, 7, NULL, 1, NULL, '28.5', '30', '40', '1650.00', NULL, NULL),
(20, 2, 5, 7, NULL, 1, NULL, '28', '29.5', '38', '1650.00', NULL, NULL),
(21, 1, 5, 7, NULL, 1, NULL, '27.5', '29', '36', '1650.00', NULL, NULL),
(22, 4, 5, 7, NULL, 1, NULL, '29', '30.5', '42', '1650.00', NULL, NULL),
(23, 3, 6, 7, NULL, 3, '43', NULL, NULL, '40', '2250.00', NULL, '2019-04-20 08:29:39'),
(24, 2, 6, 7, NULL, 3, '42.5', NULL, NULL, '38', '2250.00', NULL, '2019-04-20 08:29:39'),
(25, 1, 6, 7, NULL, 3, '42', NULL, NULL, '36', '2250.00', NULL, '2019-04-20 08:29:39'),
(26, 4, 6, 7, NULL, 2, '43.5', NULL, NULL, '42', '2250.00', NULL, '2019-04-20 08:29:39'),
(27, 5, 6, 7, NULL, 1, '44', NULL, NULL, '44', '2250.00', NULL, NULL),
(28, 3, 7, 7, NULL, 2, '39', NULL, NULL, '40', '2150.00', NULL, NULL),
(29, 2, 7, 7, NULL, 2, '38.5', NULL, NULL, '38', '2150.00', NULL, NULL),
(30, 1, 7, 7, NULL, 1, '38', NULL, NULL, '36', '2150.00', NULL, NULL),
(31, 4, 7, 7, NULL, 1, '39.5', NULL, NULL, '42', '2150.00', NULL, NULL),
(32, 3, 8, 7, NULL, 2, '41', NULL, NULL, '40', '2650.00', NULL, NULL),
(33, 2, 8, 7, NULL, 3, '41', NULL, NULL, '38', '2650.00', NULL, NULL),
(34, 1, 8, 7, NULL, 2, '40', NULL, NULL, '36', '2650.00', NULL, NULL),
(35, 4, 8, 7, NULL, 1, '42', NULL, NULL, '42', '2650.00', NULL, NULL),
(36, 5, 8, 7, NULL, 1, '42.5', NULL, NULL, '44', '2650.00', NULL, NULL),
(37, 3, 9, 7, NULL, 1, '45', NULL, NULL, '40', '2250.00', NULL, NULL),
(38, 2, 9, 7, NULL, 2, '44.5', NULL, NULL, '38', '2250.00', NULL, NULL),
(39, 1, 9, 7, NULL, 1, '44', NULL, NULL, '36', '2250.00', NULL, NULL),
(40, 4, 9, 7, NULL, 1, '45.5', NULL, NULL, '42', '2250.00', NULL, NULL),
(41, 3, 10, 7, NULL, 2, '43', NULL, NULL, '40', '2650.00', NULL, NULL),
(42, 2, 10, 7, NULL, 2, '42.5', NULL, NULL, '38', '2650.00', NULL, NULL),
(43, 1, 10, 7, NULL, 1, '42', NULL, NULL, '36', '2650.00', NULL, NULL),
(44, 4, 10, 7, NULL, 1, '43.5', NULL, NULL, '42', '2650.00', NULL, NULL),
(45, 3, 11, 7, NULL, 2, 'Left side 49 Right side 40', NULL, NULL, '40', '2450.00', NULL, NULL),
(46, 2, 11, 7, NULL, 2, 'Left side 48.5 Right side 39.5', NULL, NULL, '38', '2450.00', NULL, NULL),
(47, 1, 11, 7, NULL, 1, 'Left side 48 Right side 39', NULL, NULL, '36', '2450.00', NULL, NULL),
(48, 4, 11, 7, NULL, 1, 'left side 49.5 right side 40.5', NULL, NULL, '42', '2450.00', NULL, NULL),
(49, 3, 12, 7, NULL, 3, '38', NULL, NULL, '40', '2050.00', NULL, NULL),
(50, 2, 12, 7, NULL, 3, '37.5', NULL, NULL, '38', '2050.00', NULL, NULL),
(51, 1, 12, 7, NULL, 2, '37', NULL, NULL, '36', '2050.00', NULL, NULL),
(52, 4, 12, 7, NULL, 2, '38.5', NULL, NULL, '42', '2050.00', NULL, NULL),
(53, 5, 12, 7, NULL, 1, '39', NULL, NULL, '42', '2050.00', NULL, NULL),
(54, 3, 13, 7, NULL, 2, '43', NULL, NULL, '40', '2350.00', NULL, NULL),
(55, 2, 13, 7, NULL, 2, '42.5', NULL, NULL, '38', '2350.00', NULL, NULL),
(56, 1, 13, 7, NULL, 1, '42', NULL, NULL, '36', '2350.00', NULL, NULL),
(57, 4, 13, 7, NULL, 1, '38.5', NULL, NULL, '42', NULL, NULL, NULL),
(58, 5, 13, 7, NULL, 1, '39', NULL, NULL, '44', '2350.00', NULL, NULL),
(59, 3, 14, 7, NULL, 2, '39.5', NULL, NULL, '40', '1750.00', NULL, NULL),
(60, 2, 14, 7, NULL, 2, '39', NULL, NULL, '38', '1750.00', NULL, NULL),
(61, 1, 14, 7, NULL, 2, '38.5', NULL, NULL, '36', '1750.00', NULL, NULL),
(62, 4, 14, 7, NULL, 1, '40', NULL, NULL, '42', '1750.00', NULL, NULL),
(63, 3, 15, 7, NULL, 2, 'side 32.5 M iddle 51.5', NULL, NULL, '40', '2250.00', NULL, NULL),
(64, 2, 15, 7, NULL, 2, 'side 32 Middle 51', NULL, NULL, '38', '2250.00', NULL, NULL),
(65, 1, 15, 7, NULL, 2, 'side 31.5 Middle 50.5', NULL, NULL, '36', '2250.00', NULL, NULL),
(66, 4, 15, 7, NULL, 1, 'Side 33 Middle 52', NULL, NULL, '42', '2250.00', NULL, NULL),
(67, 3, 16, 7, NULL, 2, 'Left side 31.5 Right side 49', NULL, NULL, '40', '2950.00', NULL, NULL),
(68, 2, 16, 7, NULL, 2, 'Left side 31 Right side 48.5', NULL, NULL, '38', '2950.00', NULL, NULL),
(69, 1, 16, 7, NULL, 2, 'Left side 30.5 Right side 48', NULL, NULL, '36', '2950.00', NULL, NULL),
(70, 4, 16, 7, NULL, 1, 'left side 32 right side 49.5', NULL, NULL, '42', '2950.00', NULL, NULL),
(71, 3, 17, 7, NULL, 1, NULL, '36', '47', '40', '2450.00', NULL, NULL),
(72, 2, 17, 7, NULL, 2, NULL, '35.5', '46.5', '38', '2450.00', NULL, NULL),
(73, 1, 17, 7, NULL, 1, NULL, '35', '46', '36', '2450.00', NULL, NULL),
(74, 3, 18, 7, NULL, 3, NULL, '39', '47', '40', '2950.00', NULL, '2019-05-09 03:36:31'),
(75, 2, 18, 7, NULL, 3, NULL, '38.5', '46.5', '38', '2950.00', NULL, '2019-05-09 03:36:32'),
(76, 1, 18, 7, NULL, 1, NULL, '38', '46', '36', '2950.00', NULL, '2019-05-09 03:36:32'),
(77, 4, 18, 7, NULL, 1, NULL, NULL, NULL, NULL, '2950.00', NULL, '2019-05-09 03:36:32'),
(78, 3, 19, 7, NULL, 3, 'Left side 30.5 Right side 48.5', NULL, NULL, '40', '2550.00', NULL, '2019-05-09 03:36:06'),
(79, 2, 19, 7, NULL, 3, 'Left side 30 Right side 48', NULL, NULL, '38', '2550.00', NULL, '2019-05-09 03:36:06'),
(80, 1, 19, 7, NULL, 2, 'Left side 29.5 Right side 47.5', NULL, NULL, '36', '2550.00', NULL, '2019-05-09 03:36:06'),
(81, 4, 19, 7, NULL, 1, 'left side 31 right side 49', NULL, NULL, '42', '2550.00', NULL, '2019-05-09 03:36:06'),
(82, 1, 20, 7, NULL, 1, '34', NULL, NULL, '36', '1650.00', NULL, '2019-05-09 05:09:51'),
(83, 2, 20, 7, NULL, 2, '34.5', NULL, NULL, '38', '1650.00', NULL, '2019-05-09 05:09:51'),
(84, 3, 20, 7, NULL, 2, '35', NULL, NULL, '40', '1650.00', NULL, '2019-05-09 05:09:52'),
(85, 4, 20, 7, NULL, 1, '35.5', NULL, NULL, '42', '1650.00', NULL, '2019-05-09 05:09:52'),
(86, 1, 21, 7, NULL, 1, NULL, '28.5', '39.5', '36', '1850.00', NULL, '2019-05-09 05:08:22'),
(87, 2, 21, 7, NULL, 1, NULL, '29', '40', '38', '1850.00', NULL, '2019-05-09 05:08:22'),
(88, 3, 21, 7, NULL, 1, NULL, '29.5', '40.5', '40', '1850.00', NULL, '2019-05-09 05:08:22'),
(89, 4, 21, 7, NULL, 1, NULL, '30', '41', '42', '1850.00', NULL, '2019-05-09 05:08:22'),
(90, 5, 21, 7, NULL, 1, NULL, '30.5', '41.5', '44', '1850.00', NULL, '2019-05-09 05:08:22'),
(91, 1, 22, 7, NULL, 1, '47.5', NULL, NULL, '36', '2150.00', NULL, '2019-05-09 05:07:26'),
(92, 2, 22, 7, NULL, 2, '48', NULL, NULL, '38', '2150.00', NULL, '2019-05-09 05:07:26'),
(93, 3, 22, 7, NULL, 2, '48.5', NULL, NULL, '40', '2150.00', NULL, '2019-05-09 05:07:26'),
(94, 4, 22, 7, NULL, 1, '49', NULL, NULL, '42', '2150.00', NULL, '2019-05-09 05:07:26'),
(95, 5, 22, 7, NULL, 1, '49.5', NULL, NULL, '44', '2150.00', NULL, '2019-05-09 05:07:26'),
(96, 1, 23, 7, NULL, 1, '36', NULL, NULL, '36', '1750.00', NULL, '2019-05-09 05:06:19'),
(97, 2, 23, 7, NULL, 1, '36.5', NULL, NULL, '38', '1750.00', NULL, '2019-05-09 05:06:19'),
(98, 3, 23, 7, NULL, 1, '37', NULL, NULL, '40', '1750.00', NULL, '2019-05-09 05:06:19'),
(99, 4, 23, 7, NULL, 1, '37.5', NULL, NULL, '42', '1750.00', NULL, '2019-05-09 05:06:19'),
(100, 5, 23, 7, NULL, 1, '38', NULL, NULL, '44', '1750.00', NULL, '2019-05-09 05:06:19'),
(101, 1, 24, 7, NULL, 1, '47', NULL, NULL, '36', '2950.00', NULL, '2019-05-09 05:05:24'),
(102, 2, 24, 7, NULL, 2, '47.5', NULL, NULL, '38', '2950.00', NULL, '2019-05-09 05:05:24'),
(103, 3, 24, 7, NULL, 2, '48', NULL, NULL, '40', '2950.00', NULL, '2019-05-09 05:05:24'),
(104, 4, 24, 7, NULL, 1, '48.5', NULL, NULL, '42', '2950.00', NULL, '2019-05-09 05:05:24'),
(105, 1, 25, 7, NULL, 3, '45', NULL, NULL, '36', '2550.00', NULL, '2019-05-09 05:03:16'),
(106, 2, 25, 7, NULL, 2, '45.5', NULL, NULL, '38', '2550.00', NULL, '2019-05-09 05:03:16'),
(107, 3, 25, 7, NULL, 2, '46', NULL, NULL, '40', '2550.00', NULL, '2019-05-09 05:03:16'),
(108, 4, 25, 7, NULL, 1, '46.5', NULL, NULL, '42', '2550.00', NULL, '2019-05-09 05:03:16'),
(109, 5, 25, 7, NULL, 1, '47', NULL, NULL, '44', '2550.00', NULL, '2019-05-09 05:03:16'),
(110, 1, 26, 7, NULL, 1, '44.5', NULL, NULL, '36', '3050.00', NULL, '2019-05-09 04:59:58'),
(111, 2, 26, 7, NULL, 1, '45', NULL, NULL, '38', '3050.00', NULL, '2019-05-09 04:59:58'),
(112, 3, 26, 7, NULL, 1, '45.5', NULL, NULL, '40', '3050.00', NULL, '2019-05-09 04:59:58'),
(113, 4, 26, 7, NULL, 1, '46', NULL, NULL, '42', '3050.00', NULL, '2019-05-09 04:59:58'),
(114, 5, 26, 7, NULL, 1, '46.5', NULL, NULL, '44', '3050.00', NULL, '2019-05-09 04:59:58');

-- --------------------------------------------------------

--
-- Table structure for table `blogs`
--

CREATE TABLE `blogs` (
  `id` int(10) UNSIGNED NOT NULL,
  `title` varchar(100) NOT NULL,
  `short_description` text,
  `long_description` longtext,
  `image` text,
  `slug` varchar(191) NOT NULL,
  `is_sticky` int(10) UNSIGNED NOT NULL DEFAULT '0',
  `comment_enable` int(10) UNSIGNED NOT NULL DEFAULT '0',
  `comments` int(10) UNSIGNED NOT NULL DEFAULT '0',
  `views` int(10) UNSIGNED NOT NULL DEFAULT '0',
  `likes` int(10) UNSIGNED NOT NULL DEFAULT '0',
  `seo_title` varchar(191) DEFAULT NULL,
  `meta_key` text,
  `meta_description` text,
  `created_by` int(10) UNSIGNED DEFAULT NULL,
  `modified_by` int(10) UNSIGNED DEFAULT NULL,
  `status` tinyint(4) NOT NULL DEFAULT '2' COMMENT '1=active, 2=pending, 3=cancel',
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Dumping data for table `blogs`
--

INSERT INTO `blogs` (`id`, `title`, `short_description`, `long_description`, `image`, `slug`, `is_sticky`, `comment_enable`, `comments`, `views`, `likes`, `seo_title`, `meta_key`, `meta_description`, `created_by`, `modified_by`, `status`, `created_at`, `updated_at`) VALUES
(1, 'Organic Food', 'Lorem Ipsum is simply dummy text of the printing and typesetting industry. Lorem Ipsum has been the industry\'s standard dummy text ever since the 1500s, when an unknown printer took a galley of type and scrambled it to make a type specimen book. It has survived not only five centuries, but also the leap into electronic typesetting', '<p><strong>Lorem Ipsum</strong> is simply dummy text of the printing and typesetting industry. Lorem Ipsum has been the industry&#39;s standard dummy text ever since the 1500s, when an unknown printer took a galley of type and scrambled it to make a type specimen book. It has survived not only five centuries, but also the leap into electronic typesetting, remaining essentially unchanged. It was popularised in the 1960s with the release of Letraset sheets containing Lorem Ipsum passages, and more recently with desktop publishing software like Aldus PageMaker including versions of Lorem Ipsum<strong>Lorem Ipsum</strong> is simply dummy text of the printing and typesetting industry. Lorem Ipsum has been the industry&#39;s standard dummy text ever since the 1500s, when an unknown printer took a galley of type and scrambled it to make a type specimen book. It has survived not only five centuries, but also the leap into electronic typesetting, remaining essentially unchanged. It was popularised in the 1960s with the release of Letraset sheets containing Lorem Ipsum passages, and more recently with desktop publishing software like Aldus PageMaker including versions of Lorem Ipsum<strong>Lorem Ipsum</strong> is simply dummy text of the printing and typesetting industry. Lorem Ipsum has been the industry&#39;s standard dummy text ever since the 1500s, when an unknown printer took a galley of type and scrambled it to make a type specimen book. It has survived not only five centuries, but also the leap into electronic typesetting, remaining essentially unchanged. It was popularised in the 1960s with the release of Letraset sheets containing Lorem Ipsum passages, and more recently with desktop publishing software like Aldus PageMaker including versions of Lorem Ipsum<strong>Lorem Ipsum</strong> is simply dummy text of the printing and typesetting industry. Lorem Ipsum has been the industry&#39;s standard dummy text ever since the 1500s, when an unknown printer took a galley of type and scrambled it to make a type specimen book. It has survived not only five centuries, but also the leap into electronic typesetting, remaining essentially unchanged. It was popularised in the 1960s with the release of Letraset sheets containing Lorem Ipsum passages, and more recently with desktop publishing software like Aldus PageMaker including versions of Lorem Ipsum<strong>Lorem Ipsum</strong> is simply dummy text of the printing and typesetting industry. Lorem Ipsum has been the industry&#39;s standard dummy text ever since the 1500s, when an unknown printer took a galley of type and scrambled it to make a type specimen book. It has survived not only five centuries, but also the leap into electronic typesetting, remaining essentially unchanged. It was popularised in the 1960s with the release of Letraset sheets containing Lorem Ipsum passages, and more recently with desktop publishing software like Aldus PageMaker including versions of Lorem Ipsum<strong>Lorem Ipsum</strong> is simply dummy text of the printing and typesetting industry. Lorem Ipsum has been the industry&#39;s standard dummy text ever since the 1500s, when an unknown printer took a galley of type and scrambled it to make a type specimen book. It has survived not only five centuries, but also the leap into electronic typesetting, remaining essentially unchanged. It was popularised in the 1960s with the release of Letraset sheets containing Lorem Ipsum passages, and more recently with desktop publishing software like Aldus PageMaker including versions of Lorem Ipsum</p>', 'blogging.jpg', 'formal-full-shirt', 0, 1, 0, 0, 0, NULL, NULL, NULL, 1, 1, 1, '2019-05-13 04:54:13', '2019-05-13 09:24:56'),
(2, 'blog new', 'uries, but also the leap into electronic typesetting, remaining essentially unchanged. It was popularised in the 1960s with the release of Letraset sheets containing Lorem Ipsum passages, and more recently with desktop publishing software like Aldus PageMaker including versions of Lorem Ipsum.', '<p>uries, but also the leap into electronic typesetting, remaining essentially unchanged. It was popularised in the 1960s with the release of Letraset sheets containing Lorem Ipsum passages, and more recently with desktop publishing software like Aldus PageMaker including versions of Lorem Ipsum.</p>\r\n\r\n<div>\r\n<h2>Why do we use it?</h2>\r\n\r\n<p>It is a long established fact that a reader will be distracted by the readable content of a page when looking at its layout. The point of using Lorem Ipsum is that it has a more-or-less normal distribution of letters, as opposed to using &#39;Content here, content here&#39;, making it look like readable English. Many desktop publishing packages and web page editors now use Lorem Ipsum as their default model text, and a search for &#39;lorem ipsum&#39; will uncover many web sites still in their infancy. Various versions have evolved over the years, sometimes by accident, sometimes on purpose (injected humour and the like).</p>\r\n</div>\r\n\r\n<p>&nbsp;</p>\r\n\r\n<div>\r\n<h2>Where does it come from?</h2>\r\n\r\n<p>Contrary to popular belief, Lorem Ipsum is not simply random text. It has roots in a piece of classical Latin literature from 45 BC, making it over 2000 years old. Richard McClintock, a Latin professor at Hampden-Sydney College in Virginia, looked up one of the more obscure Latin words, consectetur, from a Lorem Ipsum passage, and going through the cites of the word in classical literature, discovered the undoubtable source. Lorem Ipsum comes from sections 1.10.32 and 1.10.33 of &quot;de Finibus Bonorum et Malorum&quot; (The Extremes of Good and Evil) by Cicero, written in 45 BC. This book is a treatise on the theory of ethics, very popular during the Renaissance. The first line of Lorem Ipsum, &quot;Lorem ipsum dolor sit amet..&quot;, comes from a line in section 1.10.32.</p>\r\n\r\n<p>The standard chunk of Lorem Ipsum used since the 1500s is reproduced below for those interested. Sections 1.10.32 and 1.10.33 from &quot;de Finibus Bonorum et Malorum&quot; by Cicero are also reproduced in their exact original form, accompanied by English versions from the 1914 translation by H. Rackham.</p>\r\n</div>\r\n\r\n<h2>Where can I get some?</h2>\r\n\r\n<p>There are many variations of passages of Lorem Ipsum available, but the majority have suffered alteration in some form, by injected humour, or randomised words which don&#39;t look even slightly believable. If you are going to use a passage of Lorem Ipsum, you need to be sure there isn&#39;t anything embarrassing hidden in the middle of text. All the Lorem Ipsum generators on the Internet tend to repeat predefined chunks as necessary, making this the first true gen</p>', 'blog-image.jpg', 'lorem-ipsum-is-simply-du', 0, 1, 0, 0, 0, NULL, NULL, NULL, 1, NULL, 1, '2019-05-13 06:32:07', '2019-05-13 06:32:07'),
(3, 'blog new for product', 'uries, but also the leap into electronic typesetting, remaining essentially unchanged. It was popularised in the 1960s with the release of Letraset sheets containing Lorem Ipsum passages, and more recently with desktop publishing software like Aldus PageMaker including versions of Lorem Ipsum.uries, but also the leap into electronic', '<p>typesetting, remaining essentially unchanged. It was popularised in the 1960s with the release of Letraset sheets containing Lorem Ipsum passages, and more recently with desktop publishing software like Aldus PageMaker including versions of Lorem Ipsum.uries, but also the leap into electronic typesetting, remaining essentially unchanged. It was popularised in the 1960s with the release of Letraset sheets containing Lorem Ipsum passages, and more recently with desktop publishing software like Aldus PageMaker including versions of Lorem Ipsum.uries, but also the leap into electronic typesetting, remaining essentially unchanged. It was popularised in the 1960s with the release of Letraset sheets containing Lorem Ipsum passages, and more recently with desktop publishing software like Aldus PageMaker including versions of Lorem Ipsum.uries, but also the leap into electronic typesetting, remaining essentially unchanged. It was popularised in the 1960s with the release of Letraset sheets containing Lorem Ipsum passages, and more recently with desktop publishing software like Aldus PageMaker including versions of Lorem Ipsum.</p>', 'blog-laptop-copy-2-1.jpg', 'blog-new-for-product', 0, 1, 0, 0, 0, NULL, NULL, NULL, 1, NULL, 1, '2019-05-13 06:34:40', '2019-05-13 06:34:40');

-- --------------------------------------------------------

--
-- Table structure for table `brands`
--

CREATE TABLE `brands` (
  `id` int(10) UNSIGNED NOT NULL,
  `title` varchar(191) NOT NULL,
  `description` text,
  `image` varchar(191) DEFAULT NULL,
  `slug` varchar(191) NOT NULL,
  `website` varchar(191) DEFAULT NULL,
  `views` int(10) UNSIGNED NOT NULL DEFAULT '0',
  `priority` int(11) DEFAULT NULL,
  `is_featured` int(10) UNSIGNED DEFAULT '0',
  `total_products` int(10) UNSIGNED NOT NULL DEFAULT '0',
  `created_by` int(10) UNSIGNED DEFAULT NULL,
  `modified_by` int(10) UNSIGNED DEFAULT NULL,
  `seo_title` varchar(191) DEFAULT NULL,
  `meta_key` text,
  `meta_description` text,
  `status` tinyint(4) NOT NULL DEFAULT '2' COMMENT '1=active, 2=pending, 3=cancel',
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Dumping data for table `brands`
--

INSERT INTO `brands` (`id`, `title`, `description`, `image`, `slug`, `website`, `views`, `priority`, `is_featured`, `total_products`, `created_by`, `modified_by`, `seo_title`, `meta_key`, `meta_description`, `status`, `created_at`, `updated_at`) VALUES
(1, 'Knife Pleated', NULL, 'pepvsdfgsico-brands.jpg', 'knife-pleated', NULL, 0, 1, 1, 0, 1, 1, NULL, NULL, NULL, 1, '2019-04-18 11:14:26', '2019-05-09 05:41:51'),
(2, 'Gulabi Noor', NULL, 'pepsico-bdfsdfsdfrands.jpg', 'gulabi-noor', NULL, 0, 2, 1, 0, 1, 1, NULL, NULL, NULL, 1, '2019-04-29 11:43:51', '2019-05-09 05:38:23'),
(3, 'The Red Phonix', NULL, 'pepsico-brands.jpg', 'the-red-phonix', NULL, 0, 3, 1, 0, 1, 1, NULL, NULL, NULL, 1, '2019-04-29 11:44:39', '2019-05-09 05:37:48'),
(4, 'M&M', NULL, 'pepsicofsdfsd-brands.jpg', 'mm', 'mm.com', 0, NULL, 0, 0, 1, 1, NULL, NULL, NULL, 1, '2019-05-09 05:23:28', '2019-05-09 05:37:26');

-- --------------------------------------------------------

--
-- Table structure for table `categories`
--

CREATE TABLE `categories` (
  `id` int(10) UNSIGNED NOT NULL,
  `parent_id` int(10) UNSIGNED NOT NULL DEFAULT '0',
  `title` varchar(191) NOT NULL,
  `description` text,
  `image` varchar(191) DEFAULT NULL,
  `fav_icon` varchar(191) DEFAULT NULL,
  `image_gallery` varchar(150) DEFAULT NULL,
  `color_code` varchar(191) DEFAULT NULL,
  `priority` int(11) DEFAULT NULL,
  `slug` varchar(191) NOT NULL,
  `views` int(10) UNSIGNED NOT NULL DEFAULT '0',
  `total_posts` int(10) UNSIGNED NOT NULL DEFAULT '0',
  `total_products` int(10) UNSIGNED NOT NULL DEFAULT '0',
  `is_featured` int(10) UNSIGNED NOT NULL DEFAULT '0',
  `seo_title` varchar(191) DEFAULT NULL,
  `meta_key` text,
  `meta_description` text,
  `created_by` int(10) UNSIGNED DEFAULT NULL,
  `modified_by` int(10) UNSIGNED DEFAULT NULL,
  `status` tinyint(4) NOT NULL DEFAULT '2' COMMENT '1=active, 2=pending, 3=cancel',
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Dumping data for table `categories`
--

INSERT INTO `categories` (`id`, `parent_id`, `title`, `description`, `image`, `fav_icon`, `image_gallery`, `color_code`, `priority`, `slug`, `views`, `total_posts`, `total_products`, `is_featured`, `seo_title`, `meta_key`, `meta_description`, `created_by`, `modified_by`, `status`, `created_at`, `updated_at`) VALUES
(1, 0, 'Organic Food', NULL, 'leaves-mashed-drugs-organic-product-icon-ve-vector-6584765.jpg', 'leaves-mashed-drugs-organic-product-icon-ve-vector-6584765.jpg', NULL, '#fa110d', NULL, 'organic-food', 0, 1, 0, 0, NULL, NULL, NULL, 1, 1, 1, '2019-04-18 09:42:34', '2019-05-13 04:54:14'),
(2, 1, 'SHORT TOPS', NULL, NULL, NULL, NULL, '#ff0000', NULL, 'short-tops-and-shirts', 0, 3, 16, 0, NULL, NULL, NULL, 1, 1, 1, '2019-04-18 09:43:31', '2019-05-13 06:34:40'),
(3, 1, 'LONG TOPS', NULL, NULL, NULL, NULL, '#ff0000', NULL, 'long-tops', 0, 1, 4, 0, NULL, NULL, NULL, 1, NULL, 1, '2019-04-18 09:46:33', '2019-04-29 09:21:09'),
(4, 1, 'MID LONG TOPS', NULL, NULL, NULL, NULL, '#ff0000', NULL, 'mid-long-tops', 0, 0, 7, 0, NULL, NULL, NULL, 1, NULL, 1, '2019-04-18 09:47:17', '2019-04-20 09:23:39'),
(5, 1, 'TWO PIECE', NULL, NULL, NULL, NULL, '#ff0000', NULL, 'two-piece', 0, 0, 1, 0, NULL, NULL, NULL, 1, NULL, 1, '2019-04-18 09:47:55', '2019-04-23 11:13:17'),
(6, 1, 'SALWAR KAMEEZ', NULL, NULL, NULL, NULL, '#ff0000', NULL, 'salwar-kameez', 0, 0, 2, 0, NULL, NULL, NULL, 1, NULL, 1, '2019-04-18 09:51:01', '2019-04-20 09:29:05'),
(7, 1, 'GOWN', NULL, NULL, NULL, NULL, '#ff0000', NULL, 'gown', 0, 1, 1, 0, NULL, NULL, NULL, 1, NULL, 1, '2019-04-18 09:51:22', '2019-05-13 06:32:07'),
(8, 1, 'LONG SHRUGS', NULL, NULL, NULL, NULL, '#ff0000', NULL, 'long-shrugs', 0, 0, 0, 0, NULL, NULL, NULL, 1, NULL, 1, '2019-04-18 09:52:04', '2019-04-18 09:52:04'),
(9, 1, 'PANT', NULL, NULL, NULL, NULL, '#ff0000', NULL, 'pant', 0, 0, 0, 0, NULL, NULL, NULL, 1, 1, 1, '2019-04-18 09:52:23', '2019-04-27 09:15:00'),
(10, 1, 'EID COLLECTION', NULL, NULL, NULL, NULL, '#ff0000', NULL, 'eid-collection', 0, 0, 0, 0, NULL, NULL, NULL, 1, NULL, 1, '2019-04-18 09:52:46', '2019-04-18 09:52:46'),
(11, 0, 'MEN', NULL, 'images.png', 'images.png', NULL, '#00a360', NULL, 'men', 0, 0, 0, 0, NULL, NULL, NULL, 1, 1, 1, '2019-04-18 09:58:44', '2019-05-09 04:45:06'),
(12, 11, 'PANJABI', NULL, NULL, NULL, NULL, '#ff0000', NULL, 'panjabi', 0, 0, 0, 0, NULL, NULL, NULL, 1, NULL, 1, '2019-04-18 10:07:00', '2019-04-18 10:07:00'),
(13, 11, 'KABLI SUIT', NULL, NULL, NULL, NULL, '#ff0000', NULL, 'kabli-suit', 0, 0, 0, 0, NULL, NULL, NULL, 1, NULL, 1, '2019-04-18 10:07:21', '2019-04-18 10:07:21'),
(14, 11, 'PAJAMA', NULL, NULL, NULL, NULL, '#ff0000', NULL, 'pajama', 0, 0, 0, 0, NULL, NULL, NULL, 1, NULL, 1, '2019-04-18 10:08:14', '2019-04-18 10:08:14'),
(15, 0, 'GRACE (WOMEN)', NULL, 'img_1241.jpg', 'grace.png', NULL, '#0090c9', NULL, 'grace-women', 0, 0, 0, 0, NULL, NULL, NULL, 1, 1, 1, '2019-04-18 10:10:24', '2019-04-29 11:35:48'),
(16, 15, 'LONG', NULL, NULL, NULL, NULL, '#ff0000', NULL, 'long', 0, 0, 0, 0, NULL, NULL, NULL, 1, NULL, 1, '2019-04-18 10:10:56', '2019-04-18 10:10:56'),
(17, 15, 'MID LONG', NULL, 'saree-collection-midriff-drama.jpg', NULL, NULL, '#ff0000', 30, 'mid-long', 0, 0, 0, 1, NULL, NULL, NULL, 1, 1, 1, '2019-04-18 10:11:16', '2019-04-29 11:14:20'),
(18, 15, 'TWO PIECE', NULL, NULL, NULL, NULL, '#ff0000', NULL, 'two-piece-1', 0, 0, 0, 0, NULL, NULL, NULL, 1, NULL, 1, '2019-04-18 10:11:32', '2019-04-18 10:11:32'),
(19, 15, 'SALWAR KAMEEZ', NULL, 'pallazo-suits-floral-frenzy.jpg', NULL, NULL, '#ff0000', 10, 'salwar-kameez-1', 0, 0, 1, 1, NULL, NULL, NULL, 1, 1, 1, '2019-04-18 10:11:53', '2019-04-29 11:14:03'),
(20, 15, 'GOWN', NULL, 'party-gowns-retro-bling.jpg', NULL, NULL, '#ff0000', 20, 'gown-1', 0, 0, 0, 1, NULL, NULL, NULL, 1, 1, 1, '2019-04-18 10:12:09', '2019-04-29 11:13:41'),
(21, 0, 'NEW ARRIVALS', NULL, NULL, 'newarivel.png', NULL, '#3f5eca', NULL, 'new-arrivals', 0, 0, 0, 0, NULL, NULL, NULL, 1, 1, 1, '2019-04-18 10:13:50', '2019-04-18 10:27:20'),
(22, 0, 'SALE', NULL, 'lehengas-mirror-trance.jpg', 'sale.png', '3.jpg,2.jpg,1.jpg', '#669900', 40, 'sale', 0, 1, 0, 1, NULL, NULL, NULL, 1, 1, 1, '2019-04-18 10:16:54', '2019-05-13 06:34:40'),
(23, 22, 'WOMEN', NULL, NULL, NULL, NULL, '#ff0000', NULL, 'women-1', 0, 0, 0, 0, NULL, NULL, NULL, 1, NULL, 1, '2019-04-18 10:17:15', '2019-04-18 10:17:15'),
(24, 22, 'MEN', NULL, NULL, NULL, NULL, '#ff0000', NULL, 'men-1', 0, 0, 0, 0, NULL, NULL, NULL, 1, NULL, 1, '2019-04-18 10:17:34', '2019-04-18 10:17:34'),
(25, 1, 'KAFTAN', NULL, NULL, NULL, NULL, NULL, NULL, 'kaftan', 0, 1, 4, 0, NULL, NULL, NULL, 1, 1, 3, '2019-04-20 09:30:23', '2019-05-02 06:27:00');

-- --------------------------------------------------------

--
-- Table structure for table `categoryables`
--

CREATE TABLE `categoryables` (
  `id` int(10) UNSIGNED NOT NULL,
  `category_id` int(10) UNSIGNED NOT NULL,
  `categoryable_id` int(10) UNSIGNED NOT NULL,
  `categoryable_type` varchar(191) NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Dumping data for table `categoryables`
--

INSERT INTO `categoryables` (`id`, `category_id`, `categoryable_id`, `categoryable_type`, `created_at`, `updated_at`) VALUES
(1, 6, 1, 'App\\Model\\Common\\Product', '2019-04-20 07:05:52', '2019-04-20 07:05:52'),
(3, 2, 3, 'App\\Model\\Common\\Product', '2019-04-20 07:25:44', '2019-04-20 07:25:44'),
(6, 3, 2, 'App\\Model\\Common\\Product', '2019-04-20 07:10:32', '2019-04-20 07:10:32'),
(7, 2, 4, 'App\\Model\\Common\\Product', '2019-04-20 07:39:41', '2019-04-20 07:39:41'),
(8, 2, 5, 'App\\Model\\Common\\Product', '2019-04-20 08:07:05', '2019-04-20 08:07:05'),
(9, 2, 6, 'App\\Model\\Common\\Product', '2019-04-20 08:29:40', '2019-04-20 08:29:40'),
(10, 4, 7, 'App\\Model\\Common\\Product', '2019-04-20 08:39:51', '2019-04-20 08:39:51'),
(11, 4, 8, 'App\\Model\\Common\\Product', '2019-04-20 08:48:31', '2019-04-20 08:48:31'),
(12, 4, 9, 'App\\Model\\Common\\Product', '2019-04-20 08:54:56', '2019-04-20 08:54:56'),
(13, 4, 10, 'App\\Model\\Common\\Product', '2019-04-20 09:01:21', '2019-04-20 09:01:21'),
(14, 4, 11, 'App\\Model\\Common\\Product', '2019-04-20 09:11:01', '2019-04-20 09:11:01'),
(15, 4, 12, 'App\\Model\\Common\\Product', '2019-04-20 09:18:27', '2019-04-20 09:18:27'),
(16, 4, 13, 'App\\Model\\Common\\Product', '2019-04-20 09:23:39', '2019-04-20 09:23:39'),
(18, 25, 14, 'App\\Model\\Common\\Product', '2019-04-20 09:33:13', '2019-04-20 09:33:13'),
(19, 25, 15, 'App\\Model\\Common\\Product', '2019-04-20 09:42:28', '2019-04-20 09:42:28'),
(20, 25, 16, 'App\\Model\\Common\\Product', '2019-04-20 09:51:25', '2019-04-20 09:51:25'),
(21, 25, 17, 'App\\Model\\Common\\Product', '2019-04-20 09:56:16', '2019-04-20 09:56:16'),
(22, 19, 18, 'App\\Model\\Common\\Product', '2019-05-09 03:36:32', '2019-05-09 03:36:32'),
(23, 25, 19, 'App\\Model\\Common\\Product', '2019-05-09 03:36:06', '2019-05-09 03:36:06'),
(24, 2, 20, 'App\\Model\\Common\\Product', '2019-05-09 05:09:52', '2019-05-09 05:09:52'),
(25, 2, 21, 'App\\Model\\Common\\Product', '2019-05-09 05:08:22', '2019-05-09 05:08:22'),
(26, 2, 22, 'App\\Model\\Common\\Product', '2019-05-09 05:07:26', '2019-05-09 05:07:26'),
(27, 2, 23, 'App\\Model\\Common\\Product', '2019-05-09 05:06:19', '2019-05-09 05:06:19'),
(28, 7, 24, 'App\\Model\\Common\\Product', '2019-05-09 05:05:24', '2019-05-09 05:05:24'),
(29, 3, 25, 'App\\Model\\Common\\Product', '2019-05-09 05:03:16', '2019-05-09 05:03:16'),
(30, 5, 26, 'App\\Model\\Common\\Product', '2019-05-09 04:59:58', '2019-05-09 04:59:58'),
(31, 2, 27, 'App\\Model\\Common\\Product', '2019-04-29 08:32:46', '2019-04-29 08:32:46'),
(32, 2, 28, 'App\\Model\\Common\\Product', '2019-04-29 08:33:19', '2019-04-29 08:33:19'),
(33, 2, 29, 'App\\Model\\Common\\Product', '2019-04-29 08:33:54', '2019-04-29 08:33:54'),
(34, 2, 30, 'App\\Model\\Common\\Product', '2019-04-29 08:34:11', '2019-04-29 08:34:11'),
(35, 2, 31, 'App\\Model\\Common\\Product', '2019-04-29 08:34:34', '2019-04-29 08:34:34'),
(36, 2, 32, 'App\\Model\\Common\\Product', '2019-04-29 08:34:47', '2019-04-29 08:34:47'),
(37, 2, 33, 'App\\Model\\Common\\Product', '2019-04-29 08:37:33', '2019-04-29 08:37:33'),
(38, 3, 34, 'App\\Model\\Common\\Product', '2019-04-29 09:14:22', '2019-04-29 09:14:22'),
(39, 3, 35, 'App\\Model\\Common\\Product', '2019-04-29 09:21:09', '2019-04-29 09:21:09'),
(40, 2, 36, 'App\\Model\\Common\\Product', '2019-04-29 09:22:49', '2019-04-29 09:22:49'),
(41, 1, 1, 'App\\Model\\Common\\Blog', '2019-05-13 09:24:56', '2019-05-13 09:24:56'),
(42, 7, 2, 'App\\Model\\Common\\Blog', '2019-05-13 06:32:07', '2019-05-13 06:32:07'),
(43, 2, 3, 'App\\Model\\Common\\Blog', '2019-05-13 06:34:40', '2019-05-13 06:34:40'),
(44, 22, 3, 'App\\Model\\Common\\Blog', '2019-05-13 06:34:40', '2019-05-13 06:34:40');

-- --------------------------------------------------------

--
-- Table structure for table `comments`
--

CREATE TABLE `comments` (
  `id` int(10) UNSIGNED NOT NULL,
  `commentable_id` int(10) UNSIGNED NOT NULL,
  `commentable_type` varchar(191) NOT NULL,
  `p_c_id` int(10) UNSIGNED NOT NULL,
  `comments` longtext NOT NULL,
  `created_by` int(10) UNSIGNED DEFAULT NULL,
  `modified_by` int(10) UNSIGNED DEFAULT NULL,
  `status` tinyint(4) NOT NULL DEFAULT '2' COMMENT '1=active, 2=pending, 3=cancel',
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

-- --------------------------------------------------------

--
-- Table structure for table `countries`
--

CREATE TABLE `countries` (
  `id` int(5) NOT NULL,
  `name` varchar(20) NOT NULL,
  `code` varchar(2) NOT NULL,
  `dial_code` varchar(5) NOT NULL,
  `currency_name` varchar(20) NOT NULL,
  `currency_symbol` varchar(20) CHARACTER SET utf8 COLLATE utf8_unicode_ci NOT NULL,
  `currency_code` varchar(10) NOT NULL,
  `currency_rate` float NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `countries`
--

INSERT INTO `countries` (`id`, `name`, `code`, `dial_code`, `currency_name`, `currency_symbol`, `currency_code`, `currency_rate`, `created_at`, `updated_at`) VALUES
(1, 'Afghanistan', 'AF', '+93', 'Afghan afghani', '؋', 'AFN', 0.93, NULL, NULL),
(2, 'Aland Islands', 'AX', '+358', '', '', '', 0, NULL, NULL),
(3, 'Albania', 'AL', '+355', 'Albanian lek', 'L', 'ALL', 1.32, NULL, NULL),
(4, 'Algeria', 'DZ', '+213', 'Algerian dinar', 'د.ج', 'DZD', 1.42, NULL, '2019-05-02 11:29:00'),
(5, 'AmericanSamoa', 'AS', '+1684', '', '', '', 0, NULL, NULL),
(6, 'Andorra', 'AD', '+376', 'Euro', '€', 'EUR', 0.011, NULL, NULL),
(7, 'Angola', 'AO', '+244', 'Angolan kwanza', 'Kz', 'AOA', 0.083, NULL, NULL),
(8, 'Anguilla', 'AI', '+1264', 'East Caribbean dolla', '$', 'XCD', 0.032, NULL, NULL),
(9, 'Antarctica', 'AQ', '+672', '', '', '', 0, NULL, NULL),
(10, 'Antigua and Barbuda', 'AG', '+1268', 'East Caribbean dolla', '$', 'XCD', 0.032, NULL, NULL),
(11, 'Argentina', 'AR', '+54', 'Argentine peso', '$', 'ARS', 0, NULL, NULL),
(12, 'Armenia', 'AM', '+374', 'Armenian dram', '', 'AMD', 5.73, NULL, NULL),
(13, 'Aruba', 'AW', '+297', 'Aruban florin', 'ƒ', 'AWG', 0.15, NULL, NULL),
(14, 'Australia', 'AU', '+61', 'Australian dollar', '$', 'AUD', 0.017, NULL, NULL),
(15, 'Austria', 'AT', '+43', 'Euro', '€', 'EUR', 0.011, NULL, NULL),
(16, 'Azerbaijan', 'AZ', '+994', 'Azerbaijani manat', '', 'AZN', 0.02, NULL, NULL),
(17, 'Bahamas', 'BS', '+1242', '', '', '', 0, NULL, NULL),
(18, 'Bahrain', 'BH', '+973', 'Bahraini dinar', '.د.ب', 'BHD', 0, NULL, NULL),
(19, 'Bangladesh', 'BD', '+880', 'Bangladeshi taka', '৳', 'BDT', 0, NULL, '2019-05-02 11:28:51'),
(20, 'Barbados', 'BB', '+1246', 'Barbadian dollar', '$', 'BBD', 0.024, NULL, NULL),
(21, 'Belarus', 'BY', '+375', 'Belarusian ruble', 'Br', 'BYR', 0.025, NULL, NULL),
(22, 'Belgium', 'BE', '+32', 'Euro', '€', 'EUR', 0.011, NULL, NULL),
(23, 'Belize', 'BZ', '+501', 'Belize dollar', '$', 'BZD', 0.024, NULL, NULL),
(24, 'Benin', 'BJ', '+229', 'West African CFA fra', 'Fr', 'XOF', 7.01, NULL, NULL),
(25, 'Bermuda', 'BM', '+1441', 'Bermudian dollar', '$', 'BMD', 0, NULL, NULL),
(26, 'Bhutan', 'BT', '+975', 'Bhutanese ngultrum', 'Nu.', 'BTN', 0, NULL, NULL),
(27, 'Bolivia, Plurination', 'BO', '+591', '', '', '', 0, NULL, NULL),
(28, 'Bosnia and Herzegovi', 'BA', '+387', '', '', '', 0, NULL, NULL),
(29, 'Botswana', 'BW', '+267', 'Botswana pula', 'P', 'BWP', 0, NULL, NULL),
(30, 'Brazil', 'BR', '+55', 'Brazilian real', 'R$', 'BRL', 0, NULL, NULL),
(31, 'British Indian Ocean', 'IO', '+246', '', '', '', 0, NULL, NULL),
(32, 'Brunei Darussalam', 'BN', '+673', '', '', '', 0, NULL, NULL),
(33, 'Bulgaria', 'BG', '+359', 'Bulgarian lev', 'лв', 'BGN', 0, NULL, NULL),
(34, 'Burkina Faso', 'BF', '+226', 'West African CFA fra', 'Fr', 'XOF', 7.01, NULL, NULL),
(35, 'Burundi', 'BI', '+257', 'Burundian franc', 'Fr', 'BIF', 0, NULL, NULL),
(36, 'Cambodia', 'KH', '+855', 'Cambodian riel', '៛', 'KHR', 0, NULL, NULL),
(37, 'Cameroon', 'CM', '+237', 'Central African CFA ', 'Fr', 'XAF', 0, NULL, NULL),
(38, 'Canada', 'CA', '+1', 'Canadian dollar', '$', 'CAD', 0, NULL, NULL),
(39, 'Cape Verde', 'CV', '+238', 'Cape Verdean escudo', 'Esc or $', 'CVE', 0, NULL, NULL),
(40, 'Cayman Islands', 'KY', '+ 345', 'Cayman Islands dolla', '$', 'KYD', 0, NULL, NULL),
(41, 'Central African Repu', 'CF', '+236', '', '', '', 0, NULL, NULL),
(42, 'Chad', 'TD', '+235', 'Central African CFA ', 'Fr', 'XAF', 0, NULL, NULL),
(43, 'Chile', 'CL', '+56', 'Chilean peso', '$', 'CLP', 83.8345, NULL, NULL),
(44, 'China', 'CN', '+86', 'Chinese yuan', '¥ or 元', 'CNY', 0, NULL, NULL),
(45, 'Christmas Island', 'CX', '+61', '', '', '', 0, NULL, NULL),
(46, 'Cocos (Keeling) Isla', 'CC', '+61', '', '', '', 0, NULL, NULL),
(47, 'Colombia', 'CO', '+57', 'Colombian peso', '$', 'COP', 0, NULL, NULL),
(48, 'Comoros', 'KM', '+269', 'Comorian franc', 'Fr', 'KMF', 0, NULL, NULL),
(49, 'Congo', 'CG', '+242', '', '', '', 0, NULL, NULL),
(50, 'Congo, The Democrati', 'CD', '+243', '', '', '', 0, NULL, NULL),
(51, 'Cook Islands', 'CK', '+682', 'New Zealand dollar', '$', 'NZD', 0, NULL, NULL),
(52, 'Costa Rica', 'CR', '+506', 'Costa Rican colón', '₡', 'CRC', 0, NULL, NULL),
(53, 'Cote d\'Ivoire', 'CI', '+225', 'West African CFA fra', 'Fr', 'XOF', 7.01, NULL, NULL),
(54, 'Croatia', 'HR', '+385', 'Croatian kuna', 'kn', 'HRK', 0, NULL, NULL),
(55, 'Cuba', 'CU', '+53', 'Cuban convertible pe', '$', 'CUC', 0, NULL, NULL),
(56, 'Cyprus', 'CY', '+357', 'Euro', '€', 'EUR', 0.011, NULL, NULL),
(57, 'Czech Republic', 'CZ', '+420', 'Czech koruna', 'Kč', 'CZK', 0, NULL, NULL),
(58, 'Denmark', 'DK', '+45', 'Danish krone', 'kr', 'DKK', 0, NULL, NULL),
(59, 'Djibouti', 'DJ', '+253', 'Djiboutian franc', 'Fr', 'DJF', 0, NULL, NULL),
(60, 'Dominica', 'DM', '+1767', 'East Caribbean dolla', '$', 'XCD', 0.032, NULL, NULL),
(61, 'Dominican Republic', 'DO', '+1849', 'Dominican peso', '$', 'DOP', 0, NULL, NULL),
(62, 'Ecuador', 'EC', '+593', 'United States dollar', '$', 'USD', 0.012, NULL, NULL),
(63, 'Egypt', 'EG', '+20', 'Egyptian pound', '£ or ج.م', 'EGP', 0.2, NULL, NULL),
(64, 'El Salvador', 'SV', '+503', 'United States dollar', '$', 'USD', 0.012, NULL, NULL),
(65, 'Equatorial Guinea', 'GQ', '+240', 'Central African CFA ', 'Fr', 'XAF', 0, NULL, NULL),
(66, 'Eritrea', 'ER', '+291', 'Eritrean nakfa', 'Nfk', 'ERN', 0, NULL, NULL),
(67, 'Estonia', 'EE', '+372', 'Euro', '€', 'EUR', 0.011, NULL, NULL),
(68, 'Ethiopia', 'ET', '+251', 'Ethiopian birr', 'Br', 'ETB', 0, NULL, NULL),
(69, 'Falkland Islands (Ma', 'FK', '+500', '', '', '', 0, NULL, NULL),
(70, 'Faroe Islands', 'FO', '+298', 'Danish krone', 'kr', 'DKK', 0, NULL, NULL),
(71, 'Fiji', 'FJ', '+679', 'Fijian dollar', '$', 'FJD', 0, NULL, NULL),
(72, 'Finland', 'FI', '+358', 'Euro', '€', 'EUR', 0.011, NULL, NULL),
(73, 'France', 'FR', '+33', 'Euro', '€', 'EUR', 0.011, NULL, NULL),
(74, 'French Guiana', 'GF', '+594', '', '', '', 0, NULL, NULL),
(75, 'French Polynesia', 'PF', '+689', 'CFP franc', 'Fr', 'XPF', 0, NULL, NULL),
(76, 'Gabon', 'GA', '+241', 'Central African CFA ', 'Fr', 'XAF', 0, NULL, NULL),
(77, 'Gambia', 'GM', '+220', '', '', '', 0, NULL, NULL),
(78, 'Georgia', 'GE', '+995', 'Georgian lari', 'ლ', 'GEL', 0, NULL, NULL),
(79, 'Germany', 'DE', '+49', 'Euro', '€', 'EUR', 0.011, NULL, NULL),
(80, 'Ghana', 'GH', '+233', 'Ghana cedi', '₵', 'GHS', 0, NULL, NULL),
(81, 'Gibraltar', 'GI', '+350', 'Gibraltar pound', '£', 'GIP', 0, NULL, NULL),
(82, 'Greece', 'GR', '+30', 'Euro', '€', 'EUR', 0.011, NULL, NULL),
(83, 'Greenland', 'GL', '+299', '', '', '', 0, NULL, NULL),
(84, 'Grenada', 'GD', '+1473', 'East Caribbean dolla', '$', 'XCD', 0.032, NULL, NULL),
(85, 'Guadeloupe', 'GP', '+590', '', '', '', 0, NULL, NULL),
(86, 'Guam', 'GU', '+1671', '', '', '', 0, NULL, NULL),
(87, 'Guatemala', 'GT', '+502', 'Guatemalan quetzal', 'Q', 'GTQ', 0, NULL, NULL),
(88, 'Guernsey', 'GG', '+44', 'British pound', '£', 'GBP', 0, NULL, NULL),
(89, 'Guinea', 'GN', '+224', 'Guinean franc', 'Fr', 'GNF', 0, NULL, NULL),
(90, 'Guinea-Bissau', 'GW', '+245', 'West African CFA fra', 'Fr', 'XOF', 7.01, NULL, NULL),
(91, 'Guyana', 'GY', '+595', 'Guyanese dollar', '$', 'GYD', 0, NULL, NULL),
(92, 'Haiti', 'HT', '+509', 'Haitian gourde', 'G', 'HTG', 0, NULL, NULL),
(93, 'Holy See (Vatican Ci', 'VA', '+379', '', '', '', 0, NULL, NULL),
(94, 'Honduras', 'HN', '+504', 'Honduran lempira', 'L', 'HNL', 0, NULL, NULL),
(95, 'Hong Kong', 'HK', '+852', 'Hong Kong dollar', '$', 'HKD', 0, NULL, NULL),
(96, 'Hungary', 'HU', '+36', 'Hungarian forint', 'Ft', 'HUF', 0, NULL, NULL),
(97, 'Iceland', 'IS', '+354', 'Icelandic króna', 'kr', 'ISK', 0, NULL, NULL),
(98, 'India', 'IN', '+91', 'Indian rupee', '₹', 'INR', 0.83, NULL, NULL),
(99, 'Indonesia', 'ID', '+62', 'Indonesian rupiah', 'Rp', 'IDR', 0, NULL, NULL),
(100, 'Iran, Islamic Republ', 'IR', '+98', '', '', '', 0, NULL, NULL),
(101, 'Iraq', 'IQ', '+964', 'Iraqi dinar', 'ع.د', 'IQD', 0, NULL, NULL),
(102, 'Ireland', 'IE', '+353', 'Euro', '€', 'EUR', 0.011, NULL, NULL),
(103, 'Isle of Man', 'IM', '+44', 'British pound', '£', 'GBP', 0, NULL, NULL),
(104, 'Israel', 'IL', '+972', 'Israeli new shekel', '₪', 'ILS', 0, NULL, NULL),
(105, 'Italy', 'IT', '+39', 'Euro', '€', 'EUR', 0.011, NULL, NULL),
(106, 'Jamaica', 'JM', '+1876', 'Jamaican dollar', '$', 'JMD', 0, NULL, NULL),
(107, 'Japan', 'JP', '+81', 'Japanese yen', '¥', 'JPY', 0, NULL, NULL),
(108, 'Jersey', 'JE', '+44', 'British pound', '£', 'GBP', 83.8345, NULL, NULL),
(109, 'Jordan', 'JO', '+962', 'Jordanian dinar', 'د.ا', 'JOD', 0, NULL, NULL),
(110, 'Kazakhstan', 'KZ', '+7 7', 'Kazakhstani tenge', '', 'KZT', 0, NULL, NULL),
(111, 'Kenya', 'KE', '+254', 'Kenyan shilling', 'Sh', 'KES', 0, NULL, NULL),
(112, 'Kiribati', 'KI', '+686', 'Australian dollar', '$', 'AUD', 0.017, NULL, NULL),
(113, 'Korea, Democratic Pe', 'KP', '+850', '', '', '', 0, NULL, NULL),
(114, 'Korea, Republic of S', 'KR', '+82', '', '', '', 0, NULL, NULL),
(115, 'Kuwait', 'KW', '+965', 'Kuwaiti dinar', 'د.ك', 'KWD', 0, NULL, NULL),
(116, 'Kyrgyzstan', 'KG', '+996', 'Kyrgyzstani som', 'лв', 'KGS', 0, NULL, NULL),
(117, 'Laos', 'LA', '+856', 'Lao kip', '₭', 'LAK', 0, NULL, NULL),
(118, 'Latvia', 'LV', '+371', 'Euro', '€', 'EUR', 0.011, NULL, NULL),
(119, 'Lebanon', 'LB', '+961', 'Lebanese pound', 'ل.ل', 'LBP', 0, NULL, NULL),
(120, 'Lesotho', 'LS', '+266', 'Lesotho loti', 'L', 'LSL', 0, NULL, NULL),
(121, 'Liberia', 'LR', '+231', 'Liberian dollar', '$', 'LRD', 0, NULL, NULL),
(122, 'Libyan Arab Jamahiri', 'LY', '+218', '', '', '', 0, NULL, NULL),
(123, 'Liechtenstein', 'LI', '+423', 'Swiss franc', 'Fr', 'CHF', 0.012, NULL, NULL),
(124, 'Lithuania', 'LT', '+370', 'Euro', '€', 'EUR', 0.011, NULL, NULL),
(125, 'Luxembourg', 'LU', '+352', 'Euro', '€', 'EUR', 0.011, NULL, NULL),
(126, 'Macao', 'MO', '+853', '', '', '', 0, NULL, NULL),
(127, 'Macedonia', 'MK', '+389', '', '', '', 0, NULL, NULL),
(128, 'Madagascar', 'MG', '+261', 'Malagasy ariary', 'Ar', 'MGA', 0, NULL, NULL),
(129, 'Malawi', 'MW', '+265', 'Malawian kwacha', 'MK', 'MWK', 0, NULL, NULL),
(130, 'Malaysia', 'MY', '+60', 'Malaysian ringgit', 'RM', 'MYR', 0, NULL, NULL),
(131, 'Maldives', 'MV', '+960', 'Maldivian rufiyaa', '.ރ', 'MVR', 0, NULL, NULL),
(132, 'Mali', 'ML', '+223', 'West African CFA fra', 'Fr', 'XOF', 7.01, NULL, NULL),
(133, 'Malta', 'MT', '+356', 'Euro', '€', 'EUR', 0.011, NULL, NULL),
(134, 'Marshall Islands', 'MH', '+692', 'United States dollar', '$', 'USD', 0.012, NULL, NULL),
(135, 'Martinique', 'MQ', '+596', '', '', '', 0, NULL, NULL),
(136, 'Mauritania', 'MR', '+222', 'Mauritanian ouguiya', 'UM', 'MRO', 0, NULL, NULL),
(137, 'Mauritius', 'MU', '+230', 'Mauritian rupee', '₨', 'MUR', 0, NULL, NULL),
(138, 'Mayotte', 'YT', '+262', '', '', '', 0, NULL, NULL),
(139, 'Mexico', 'MX', '+52', 'Mexican peso', '$', 'MXN', 0, NULL, NULL),
(140, 'Micronesia, Federate', 'FM', '+691', '', '', '', 0, NULL, NULL),
(141, 'Moldova', 'MD', '+373', 'Moldovan leu', 'L', 'MDL', 0, NULL, NULL),
(142, 'Monaco', 'MC', '+377', 'Euro', '€', 'EUR', 0.011, NULL, NULL),
(143, 'Mongolia', 'MN', '+976', 'Mongolian tögrög', '₮', 'MNT', 0, NULL, NULL),
(144, 'Montenegro', 'ME', '+382', 'Euro', '€', 'EUR', 0.011, NULL, NULL),
(145, 'Montserrat', 'MS', '+1664', 'East Caribbean dolla', '$', 'XCD', 0.032, NULL, NULL),
(146, 'Morocco', 'MA', '+212', 'Moroccan dirham', 'د.م.', 'MAD', 0, NULL, NULL),
(147, 'Mozambique', 'MZ', '+258', 'Mozambican metical', 'MT', 'MZN', 0, NULL, NULL),
(148, 'Myanmar', 'MM', '+95', 'Burmese kyat', 'Ks', 'MMK', 0, NULL, NULL),
(149, 'Namibia', 'NA', '+264', 'Namibian dollar', '$', 'NAD', 0, NULL, NULL),
(150, 'Nauru', 'NR', '+674', 'Australian dollar', '$', 'AUD', 0.017, NULL, NULL),
(151, 'Nepal', 'NP', '+977', 'Nepalese rupee', '₨', 'NPR', 0, NULL, NULL),
(152, 'Netherlands', 'NL', '+31', 'Euro', '€', 'EUR', 0.011, NULL, NULL),
(153, 'Netherlands Antilles', 'AN', '+599', '', '', '', 0, NULL, NULL),
(154, 'New Caledonia', 'NC', '+687', 'CFP franc', 'Fr', 'XPF', 0, NULL, NULL),
(155, 'New Zealand', 'NZ', '+64', 'New Zealand dollar', '$', 'NZD', 0, NULL, NULL),
(156, 'Nicaragua', 'NI', '+505', 'Nicaraguan córdoba', 'C$', 'NIO', 0, NULL, NULL),
(157, 'Niger', 'NE', '+227', 'West African CFA fra', 'Fr', 'XOF', 7.01, NULL, NULL),
(158, 'Nigeria', 'NG', '+234', 'Nigerian naira', '₦', 'NGN', 4.28, NULL, NULL),
(159, 'Niue', 'NU', '+683', 'New Zealand dollar', '$', 'NZD', 0, NULL, NULL),
(160, 'Norfolk Island', 'NF', '+672', '', '', '', 0, NULL, NULL),
(161, 'Northern Mariana Isl', 'MP', '+1670', '', '', '', 0, NULL, NULL),
(162, 'Norway', 'NO', '+47', 'Norwegian krone', 'kr', 'NOK', 0, NULL, NULL),
(163, 'Oman', 'OM', '+968', 'Omani rial', 'ر.ع.', 'OMR', 0.0046, NULL, NULL),
(164, 'Pakistan', 'PK', '+92', 'Pakistani rupee', '₨', 'PKR', 1.68, NULL, NULL),
(165, 'Palau', 'PW', '+680', 'Palauan dollar', '$', '', 0, NULL, NULL),
(166, 'Palestinian Territor', 'PS', '+970', '', '', '', 0, NULL, NULL),
(167, 'Panama', 'PA', '+507', 'Panamanian balboa', 'B/.', 'PAB', 0, NULL, NULL),
(168, 'Papua New Guinea', 'PG', '+675', 'Papua New Guinean ki', 'K', 'PGK', 0, NULL, NULL),
(169, 'Paraguay', 'PY', '+595', 'Paraguayan guaraní', '₲', 'PYG', 0, NULL, NULL),
(170, 'Peru', 'PE', '+51', 'Peruvian nuevo sol', 'S/.', 'PEN', 0, NULL, NULL),
(171, 'Philippines', 'PH', '+63', 'Philippine peso', '₱', 'PHP', 0.62, NULL, NULL),
(172, 'Pitcairn', 'PN', '+872', '', '', '', 0, NULL, NULL),
(173, 'Poland', 'PL', '+48', 'Polish z?oty', 'zł', 'PLN', 0, NULL, NULL),
(174, 'Portugal', 'PT', '+351', 'Euro', '€', 'EUR', 0.011, NULL, NULL),
(175, 'Puerto Rico', 'PR', '+1939', '', '', '', 0, NULL, NULL),
(176, 'Qatar', 'QA', '+974', 'Qatari riyal', 'ر.ق', 'QAR', 0, NULL, NULL),
(177, 'Romania', 'RO', '+40', 'Romanian leu', 'lei', 'RON', 0.051, NULL, NULL),
(178, 'Russia', 'RU', '+7', 'Russian ruble', '', 'RUB', 0, NULL, NULL),
(179, 'Rwanda', 'RW', '+250', 'Rwandan franc', 'Fr', 'RWF', 0, NULL, NULL),
(180, 'Reunion', 'RE', '+262', '', '', '', 0, NULL, NULL),
(181, 'Saint Barthelemy', 'BL', '+590', '', '', '', 0, NULL, NULL),
(182, 'Saint Helena, Ascens', 'SH', '+290', '', '', '', 0, NULL, NULL),
(183, 'Saint Kitts and Nevi', 'KN', '+1869', '', '', '', 0, NULL, NULL),
(184, 'Saint Lucia', 'LC', '+1758', 'East Caribbean dolla', '$', 'XCD', 0.032, NULL, NULL),
(185, 'Saint Martin', 'MF', '+590', '', '', '', 0, NULL, NULL),
(186, 'Saint Pierre and Miq', 'PM', '+508', '', '', '', 0, NULL, NULL),
(187, 'Saint Vincent and th', 'VC', '+1784', '', '', '', 0, NULL, NULL),
(188, 'Samoa', 'WS', '+685', 'Samoan t?l?', 'T', 'WST', 0, NULL, NULL),
(189, 'San Marino', 'SM', '+378', 'Euro', '€', 'EUR', 0.011, NULL, NULL),
(190, 'Sao Tome and Princip', 'ST', '+239', '', '', '', 0, NULL, NULL),
(191, 'Saudi Arabia', 'SA', '+966', 'Saudi riyal', 'ر.س', 'SAR', 0.045, NULL, NULL),
(192, 'Senegal', 'SN', '+221', 'West African CFA fra', 'Fr', 'XOF', 7.01, NULL, NULL),
(193, 'Serbia', 'RS', '+381', 'Serbian dinar', 'дин. or din.', 'RSD', 0, NULL, NULL),
(194, 'Seychelles', 'SC', '+248', 'Seychellois rupee', '₨', 'SCR', 0, NULL, NULL),
(195, 'Sierra Leone', 'SL', '+232', 'Sierra Leonean leone', 'Le', 'SLL', 105.1, NULL, NULL),
(196, 'Singapore', 'SG', '+65', 'Brunei dollar', '$', 'BND', 0.016, NULL, NULL),
(197, 'Slovakia', 'SK', '+421', 'Euro', '€', 'EUR', 0.011, NULL, NULL),
(198, 'Slovenia', 'SI', '+386', 'Euro', '€', 'EUR', 0.011, NULL, NULL),
(199, 'Solomon Islands', 'SB', '+677', 'Solomon Islands doll', '$', 'SBD', 0, NULL, NULL),
(200, 'Somalia', 'SO', '+252', 'Somali shilling', 'Sh', 'SOS', 0, NULL, NULL),
(201, 'South Africa', 'ZA', '+27', 'South African rand', 'R', 'ZAR', 0, NULL, NULL),
(202, 'South Georgia and th', 'GS', '+500', '', '', '', 0, NULL, NULL),
(203, 'Spain', 'ES', '+34', 'Euro', '€', 'EUR', 0.011, NULL, NULL),
(204, 'Sri Lanka', 'LK', '+94', 'Sri Lankan rupee', 'Rs or රු', 'LKR', 0, NULL, NULL),
(205, 'Sudan', 'SD', '+249', 'Sudanese pound', 'ج.س.', 'SDG', 0, NULL, NULL),
(206, 'Suriname', 'SR', '+597', 'Surinamese dollar', '$', 'SRD', 0.089, NULL, NULL),
(207, 'Svalbard and Jan May', 'SJ', '+47', '', '', '', 0, NULL, NULL),
(208, 'Swaziland', 'SZ', '+268', 'Swazi lilangeni', 'L', 'SZL', 0, NULL, NULL),
(209, 'Sweden', 'SE', '+46', 'Swedish krona', 'kr', 'SEK', 0, NULL, NULL),
(210, 'Switzerland', 'CH', '+41', 'Swiss franc', 'Fr', 'CHF', 0.012, NULL, NULL),
(211, 'Syrian Arab Republic', 'SY', '+963', '', '', '', 0, NULL, NULL),
(212, 'Taiwan', 'TW', '+886', 'New Taiwan dollar', '$', 'TWD', 0, NULL, NULL),
(213, 'Tajikistan', 'TJ', '+992', 'Tajikistani somoni', 'ЅМ', 'TJS', 0, NULL, NULL),
(214, 'Tanzania, United Rep', 'TZ', '+255', '', '', '', 0, NULL, NULL),
(215, 'Thailand', 'TH', '+66', 'Thai baht', '฿', 'THB', 0.38, NULL, NULL),
(216, 'Timor-Leste', 'TL', '+670', '', '', '', 0, NULL, NULL),
(217, 'Togo', 'TG', '+228', 'West African CFA fra', 'Fr', 'XOF', 7.01, NULL, NULL),
(218, 'Tokelau', 'TK', '+690', '', '', '', 0, NULL, NULL),
(219, 'Tonga', 'TO', '+676', 'Tongan pa?anga', 'T$', 'TOP', 0, NULL, NULL),
(220, 'Trinidad and Tobago', 'TT', '+1868', 'Trinidad and Tobago ', '$', 'TTD', 0, NULL, NULL),
(221, 'Tunisia', 'TN', '+216', 'Tunisian dinar', 'د.ت', 'TND', 0.036, NULL, NULL),
(222, 'Turkey', 'TR', '+90', 'Turkish lira', '', 'TRY', 0, NULL, NULL),
(223, 'Turkmenistan', 'TM', '+993', 'Turkmenistan manat', 'm', 'TMT', 0, NULL, NULL),
(224, 'Turks and Caicos Isl', 'TC', '+1649', '', '', '', 0, NULL, NULL),
(225, 'Tuvalu', 'TV', '+688', 'Australian dollar', '$', 'AUD', 0.017, NULL, NULL),
(226, 'Uganda', 'UG', '+256', 'Ugandan shilling', 'Sh', 'UGX', 0, NULL, NULL),
(227, 'Ukraine', 'UA', '+380', 'Ukrainian hryvnia', '₴', 'UAH', 0.31, NULL, NULL),
(228, 'United Arab Emirates', 'AE', '+971', 'United Arab Emirates', 'د.إ', 'AED', 0, NULL, NULL),
(229, 'United Kingdom', 'GB', '+44', 'British pound', '£', 'GBP', 0, NULL, NULL),
(230, 'United States', 'US', '+1', 'United States dollar', '$', 'USD', 2.72612, NULL, NULL),
(231, 'Uruguay', 'UY', '+598', 'Uruguayan peso', '$', 'UYU', 0, NULL, NULL),
(232, 'Uzbekistan', 'UZ', '+998', 'Uzbekistani som', '', 'UZS', 0, NULL, NULL),
(233, 'Vanuatu', 'VU', '+678', 'Vanuatu vatu', 'Vt', 'VUV', 0, NULL, NULL),
(234, 'Venezuela, Bolivaria', 'VE', '+58', '', '', '', 0, NULL, NULL),
(235, 'Vietnam', 'VN', '+84', 'Vietnamese ??ng', '₫', 'VND', 0, NULL, NULL),
(236, 'Virgin Islands, Brit', 'VG', '+1284', '', '', '', 0, NULL, NULL),
(237, 'Virgin Islands, U.S.', 'VI', '+1340', '', '', '', 0, NULL, NULL),
(238, 'Wallis and Futuna', 'WF', '+681', 'CFP franc', 'Fr', 'XPF', 0, NULL, NULL),
(239, 'Yemen', 'YE', '+967', 'Yemeni rial', '﷼', 'YER', 0, NULL, NULL),
(240, 'Zambia', 'ZM', '+260', 'Zambian kwacha', 'ZK', 'ZMW', 0, NULL, NULL),
(241, 'Zimbabwe', 'ZW', '+263', 'Botswana pula', 'P', 'BWP', 0, NULL, NULL);

-- --------------------------------------------------------

--
-- Table structure for table `coupons`
--

CREATE TABLE `coupons` (
  `id` int(10) UNSIGNED NOT NULL,
  `title` varchar(191) NOT NULL,
  `discount_type` int(11) NOT NULL,
  `coupon_code` varchar(191) DEFAULT NULL,
  `validity` date NOT NULL,
  `qty` int(11) DEFAULT NULL,
  `balance_qty` int(11) DEFAULT NULL,
  `coupon_amount` double(5,2) NOT NULL DEFAULT '0.00',
  `type` tinyint(3) UNSIGNED NOT NULL DEFAULT '0' COMMENT '1 = Fixed and 2 = Percentage',
  `created_by` int(10) UNSIGNED NOT NULL,
  `modified_by` int(10) UNSIGNED DEFAULT NULL,
  `status` tinyint(4) NOT NULL DEFAULT '3' COMMENT '1=Completed, 2=Processing, 3=Pending, 4=cancel',
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Dumping data for table `coupons`
--

INSERT INTO `coupons` (`id`, `title`, `discount_type`, `coupon_code`, `validity`, `qty`, `balance_qty`, `coupon_amount`, `type`, `created_by`, `modified_by`, `status`, `created_at`, `updated_at`) VALUES
(1, 'Eid offer', 0, '123', '2019-04-21', 3, 1, 10.00, 1, 1, NULL, 1, '2019-04-20 04:45:33', '2019-04-20 05:02:36'),
(3, 'Affiliates', 1, NULL, '2019-05-10', NULL, NULL, 10.00, 2, 1, 1, 2, '2019-05-02 10:32:45', '2019-05-02 12:19:35');

-- --------------------------------------------------------

--
-- Table structure for table `likes`
--

CREATE TABLE `likes` (
  `id` int(10) UNSIGNED NOT NULL,
  `liker_id` int(10) UNSIGNED DEFAULT NULL,
  `liker_ip` varchar(191) DEFAULT NULL,
  `likeable_id` int(10) UNSIGNED NOT NULL,
  `likeable_type` varchar(191) NOT NULL,
  `status` tinyint(4) NOT NULL DEFAULT '1' COMMENT '0=Not Liked yet, 1=Liked',
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

-- --------------------------------------------------------

--
-- Table structure for table `media`
--

CREATE TABLE `media` (
  `id` int(10) UNSIGNED NOT NULL,
  `is_private` tinyint(4) NOT NULL DEFAULT '0' COMMENT '1=Yes, 0=No',
  `title` varchar(191) DEFAULT NULL,
  `caption` text,
  `alt` text,
  `description` text,
  `slug` varchar(191) NOT NULL,
  `created_by` int(10) UNSIGNED DEFAULT NULL,
  `modified_by` int(10) UNSIGNED DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Dumping data for table `media`
--

INSERT INTO `media` (`id`, `is_private`, `title`, `caption`, `alt`, `description`, `slug`, `created_by`, `modified_by`, `created_at`, `updated_at`) VALUES
(1, 0, 'weman', NULL, NULL, NULL, 'weman.png', 1, NULL, '2019-04-18 09:42:11', '2019-04-18 09:42:11'),
(2, 0, 'listslide2', NULL, NULL, NULL, 'listslide2.png', 1, NULL, '2019-04-18 09:42:34', '2019-04-18 09:42:34'),
(5, 0, 'men', NULL, NULL, NULL, 'men.png', 1, NULL, '2019-04-18 10:02:13', '2019-04-18 10:02:13'),
(7, 0, 'men', NULL, NULL, NULL, 'men.jpg', 1, NULL, '2019-04-18 10:04:06', '2019-04-18 10:04:06'),
(8, 0, 'nav', NULL, NULL, NULL, 'nav.png', 1, NULL, '2019-04-18 10:09:50', '2019-04-18 10:09:50'),
(9, 0, 'grace', NULL, NULL, NULL, 'grace.png', 1, NULL, '2019-04-18 10:10:15', '2019-04-18 10:10:15'),
(10, 0, 'newarivel', NULL, NULL, NULL, 'newarivel.png', 1, NULL, '2019-04-18 10:13:44', '2019-04-18 10:13:44'),
(11, 0, 'listslide1', NULL, NULL, NULL, 'listslide1.png', 1, NULL, '2019-04-18 10:16:01', '2019-04-18 10:16:01'),
(12, 0, 'sale', NULL, NULL, NULL, 'sale.png', 1, NULL, '2019-04-18 10:16:43', '2019-04-18 10:16:43'),
(13, 0, 'logo-buckelup', NULL, NULL, NULL, 'logo-buckelup.png', 1, NULL, '2019-04-18 10:22:41', '2019-04-18 10:22:41'),
(14, 0, 'slider2', NULL, NULL, NULL, 'slider2.jpg', 1, NULL, '2019-04-18 10:31:19', '2019-04-18 10:31:19'),
(15, 0, 'slider1', NULL, NULL, NULL, 'slider1.jpg', 1, NULL, '2019-04-18 10:31:29', '2019-04-18 10:31:29'),
(16, 0, 'slider3psd', NULL, NULL, NULL, 'slider3psd.jpg', 1, NULL, '2019-04-18 10:31:37', '2019-04-18 10:31:37'),
(17, 0, 'slider5', NULL, NULL, NULL, 'slider5.png', 1, NULL, '2019-04-18 10:31:53', '2019-04-18 10:31:53'),
(18, 0, 'icon-s1', NULL, NULL, NULL, 'icon-s1.png', 1, NULL, '2019-04-18 10:35:48', '2019-04-18 10:35:48'),
(19, 0, 'icon-s2', NULL, NULL, NULL, 'icon-s2.png', 1, NULL, '2019-04-18 10:36:01', '2019-04-18 10:36:01'),
(20, 0, 'icon-s3', NULL, NULL, NULL, 'icon-s3.png', 1, NULL, '2019-04-18 10:36:15', '2019-04-18 10:36:15'),
(21, 0, 'icon-s4', NULL, NULL, NULL, 'icon-s4.png', 1, NULL, '2019-04-18 10:36:28', '2019-04-18 10:36:28'),
(22, 0, 'icon-s5', NULL, NULL, NULL, 'icon-s5.png', 1, NULL, '2019-04-18 10:36:41', '2019-04-18 10:36:41'),
(23, 0, 'icon-s6', NULL, NULL, NULL, 'icon-s6.png', 1, NULL, '2019-04-18 10:36:54', '2019-04-18 10:36:54'),
(24, 0, 'trademark-mc', NULL, NULL, NULL, 'trademark-mc.jpg', 1, NULL, '2019-04-18 10:44:18', '2019-04-18 10:44:18'),
(25, 0, 'trademark-visa', NULL, NULL, NULL, 'trademark-visa.jpg', 1, NULL, '2019-04-18 10:44:25', '2019-04-18 10:44:25'),
(117, 0, '1-3', NULL, NULL, NULL, '1-3.jpg', 1, NULL, '2019-04-23 11:11:58', '2019-04-23 11:11:58'),
(118, 0, '2-3', NULL, NULL, NULL, '2-3.jpg', 1, NULL, '2019-04-23 11:11:58', '2019-04-23 11:11:58'),
(119, 0, 'logo-buckelup', NULL, NULL, NULL, 'logo-buckelup.jpg', 1, NULL, '2019-04-24 10:54:27', '2019-04-24 10:54:27'),
(120, 0, 'pi25', NULL, NULL, NULL, 'pi25.png', 1, NULL, '2019-04-25 03:48:09', '2019-04-25 03:48:09'),
(121, 0, 's1', NULL, NULL, NULL, 's1.jpg', 1, NULL, '2019-04-25 10:25:47', '2019-04-25 10:25:47'),
(122, 0, 's2', NULL, NULL, NULL, 's2.jpg', 1, NULL, '2019-04-25 10:25:56', '2019-04-25 10:25:56'),
(123, 0, 's3', NULL, NULL, NULL, 's3.jpg', 1, NULL, '2019-04-25 10:26:05', '2019-04-25 10:26:05'),
(124, 0, 's4', NULL, NULL, NULL, 's4.jpg', 1, NULL, '2019-04-25 10:26:14', '2019-04-25 10:26:14'),
(125, 0, 's5', NULL, NULL, NULL, 's5.jpg', 1, NULL, '2019-04-25 10:26:22', '2019-04-25 10:26:22'),
(126, 0, 'coustom-made1', NULL, NULL, NULL, 'coustom-made1.jpg', 1, NULL, '2019-04-27 03:53:32', '2019-04-27 03:53:32'),
(127, 0, 'first-order1 (1)', NULL, NULL, NULL, 'first-order1__281_29.jpg', 1, NULL, '2019-04-27 03:53:40', '2019-04-27 03:53:40'),
(128, 0, 'first-order1', NULL, NULL, NULL, 'first-order1.jpg', 1, NULL, '2019-04-27 03:53:48', '2019-04-27 03:53:48'),
(129, 0, 'free-shipping3', NULL, NULL, NULL, 'free-shipping3.jpg', 1, NULL, '2019-04-27 03:53:55', '2019-04-27 03:53:55'),
(130, 0, 'testimonial', NULL, NULL, NULL, 'testimonial.jpg', 1, NULL, '2019-04-27 06:47:10', '2019-04-27 06:47:10'),
(131, 0, 'pi26', NULL, NULL, NULL, 'pi26.png', 1, NULL, '2019-04-27 06:56:50', '2019-04-27 06:56:50'),
(145, 0, 'loader', NULL, NULL, NULL, 'loader.gif', 1, NULL, '2019-04-29 04:27:01', '2019-04-29 04:27:01'),
(146, 0, 'alaminsha', NULL, NULL, NULL, 'alaminsha.png', 1, NULL, '2019-04-29 04:35:37', '2019-04-29 04:35:37'),
(150, 0, '1', NULL, NULL, NULL, '1.jpg', 1, NULL, '2019-04-29 07:02:16', '2019-04-29 07:02:16'),
(151, 0, '2', NULL, NULL, NULL, '2.jpg', 1, NULL, '2019-04-29 07:02:26', '2019-04-29 07:02:26'),
(152, 0, '3', NULL, NULL, NULL, '3.jpg', 1, NULL, '2019-04-29 07:02:36', '2019-04-29 07:02:36'),
(201, 0, 'IMG_1129', NULL, NULL, NULL, 'img_1129.jpg', 1, NULL, '2019-04-29 10:46:14', '2019-04-29 10:46:14'),
(205, 0, 'IMG_1138', NULL, NULL, NULL, 'img_1138.jpg', 1, NULL, '2019-04-29 10:47:00', '2019-04-29 10:47:00'),
(228, 0, 'IMG_1201', NULL, NULL, NULL, 'img_1201.jpg', 1, NULL, '2019-04-29 10:51:27', '2019-04-29 10:51:27'),
(229, 0, 'IMG_1203', NULL, NULL, NULL, 'img_1203.jpg', 1, NULL, '2019-04-29 10:51:38', '2019-04-29 10:51:38'),
(256, 0, 'IMG_1279', NULL, NULL, NULL, 'img_1279.jpg', 1, NULL, '2019-04-29 10:56:49', '2019-04-29 10:56:49'),
(258, 0, 's1', NULL, NULL, NULL, 's1_1.jpg', 1, NULL, '2019-04-29 10:58:59', '2019-04-29 10:58:59'),
(259, 0, 's2', NULL, NULL, NULL, 's2_1.jpg', 1, NULL, '2019-04-29 10:59:09', '2019-04-29 10:59:09'),
(260, 0, 's3', NULL, NULL, NULL, 's3_1.jpg', 1, NULL, '2019-04-29 10:59:20', '2019-04-29 10:59:20'),
(261, 0, 's4', NULL, NULL, NULL, 's4_1.jpg', 1, NULL, '2019-04-29 10:59:32', '2019-04-29 10:59:32'),
(262, 0, 's5', NULL, NULL, NULL, 's5_1.jpg', 1, NULL, '2019-04-29 10:59:44', '2019-04-29 10:59:44'),
(264, 0, 'coustom-made1', NULL, NULL, NULL, 'coustom-made1_1.jpg', 1, NULL, '2019-04-29 11:02:55', '2019-04-29 11:02:55'),
(267, 0, 'pallazo-suits-floral-frenzy', NULL, NULL, NULL, 'pallazo-suits-floral-frenzy.jpg', 1, NULL, '2019-04-29 11:07:18', '2019-04-29 11:07:18'),
(268, 0, 'party-gowns-retro-bling', NULL, NULL, NULL, 'party-gowns-retro-bling.jpg', 1, NULL, '2019-04-29 11:09:13', '2019-04-29 11:09:13'),
(269, 0, 'saree-collection-midriff-drama', NULL, NULL, NULL, 'saree-collection-midriff-drama.jpg', 1, NULL, '2019-04-29 11:10:47', '2019-04-29 11:10:47'),
(270, 0, 'lehengas-mirror-trance', NULL, NULL, NULL, 'lehengas-mirror-trance.jpg', 1, 1, '2019-04-29 11:11:51', '2019-05-08 04:45:01'),
(271, 0, 'logo', NULL, NULL, NULL, 'logo.png', 1, NULL, '2019-04-29 11:24:04', '2019-04-29 11:24:04'),
(272, 0, 'slider2', NULL, NULL, NULL, 'slider2_1.jpg', 1, NULL, '2019-04-29 11:37:58', '2019-04-29 11:37:58'),
(273, 0, 'facetime-videos-call', NULL, NULL, NULL, 'facetime-videos-call.jpg', 1, NULL, '2019-05-01 02:43:00', '2019-05-01 02:43:00'),
(274, 0, 'fairytale-fashion-anarkali-suits', NULL, NULL, NULL, 'fairytale-fashion-anarkali-suits.jpg', 1, NULL, '2019-05-01 02:43:00', '2019-05-01 02:43:00'),
(275, 0, 'footer-image-payment-24sep', NULL, NULL, NULL, 'footer-image-payment-24sep.png', 1, NULL, '2019-05-01 02:43:03', '2019-05-01 02:43:03'),
(276, 0, 'indowestern-gown-retro-bling', NULL, NULL, NULL, 'indowestern-gown-retro-bling.jpg', 1, NULL, '2019-05-01 02:43:03', '2019-05-01 02:43:03'),
(277, 0, 'kalkiviviana_new', NULL, NULL, NULL, 'kalkiviviana_new.jpg', 1, NULL, '2019-05-01 02:43:05', '2019-05-01 02:43:05'),
(278, 0, 'kalkimalad_news', NULL, NULL, NULL, 'kalkimalad_news.jpg', 1, NULL, '2019-05-01 02:43:05', '2019-05-01 02:43:05'),
(279, 0, 'part-statemant-accessories', NULL, NULL, NULL, 'part-statemant-accessories.jpg', 1, NULL, '2019-05-01 02:43:07', '2019-05-01 02:43:07'),
(280, 0, 'party-gown-collection_2_1', NULL, NULL, NULL, 'party-gown-collection_2_1.jpg', 1, NULL, '2019-05-01 02:43:09', '2019-05-01 02:43:09'),
(281, 0, 'ruling-jacket-lehenga_1', NULL, NULL, NULL, 'ruling-jacket-lehenga_1.jpg', 1, NULL, '2019-05-01 02:43:10', '2019-05-01 02:43:10'),
(282, 0, 'santa-min-1', NULL, NULL, NULL, 'santa-min-1.jpg', 1, NULL, '2019-05-01 02:43:10', '2019-05-01 02:43:10'),
(283, 0, 'worli-min-4', NULL, NULL, NULL, 'worli-min-4.jpg', 1, NULL, '2019-05-01 02:43:12', '2019-05-01 02:43:12'),
(284, 0, 'Testimonialsbannerhomepage-min-1', NULL, NULL, NULL, 'testimonialsbannerhomepage-min-1.jpg', 1, NULL, '2019-05-01 02:43:12', '2019-05-01 02:43:12'),
(285, 0, 'Bandani_Sareee', NULL, NULL, NULL, 'bandani_sareee.jpg', 1, NULL, '2019-05-01 02:55:17', '2019-05-01 02:55:17'),
(286, 0, 'ready-pleatrd-saree', NULL, NULL, NULL, 'ready-pleatrd-saree.jpg', 1, NULL, '2019-05-01 02:55:17', '2019-05-01 02:55:17'),
(287, 0, 'awardbanner', NULL, NULL, NULL, 'awardbanner.jpg', 1, NULL, '2019-05-01 02:55:18', '2019-05-01 02:55:18'),
(289, 0, 'logo', NULL, NULL, NULL, 'logo_1.png', 1, 1, '2019-05-05 10:04:46', '2019-05-05 10:04:56'),
(293, 0, 'banner1', NULL, NULL, NULL, 'banner1.jpg', 1, NULL, '2019-05-05 11:52:20', '2019-05-05 11:52:20'),
(294, 0, 'banner2', NULL, NULL, NULL, 'banner2.jpg', 1, NULL, '2019-05-05 11:52:29', '2019-05-05 11:52:29'),
(295, 0, 'banner3', NULL, NULL, NULL, 'banner3.jpg', 1, NULL, '2019-05-05 11:52:38', '2019-05-05 11:52:38'),
(305, 0, 'dt4', NULL, NULL, NULL, 'dt4.png', 1, NULL, '2019-05-06 04:17:01', '2019-05-06 04:17:01'),
(306, 0, 'dt5', NULL, NULL, NULL, 'dt5.png', 1, NULL, '2019-05-06 04:17:21', '2019-05-06 04:17:21'),
(307, 0, 'dt6', NULL, NULL, NULL, 'dt6.png', 1, NULL, '2019-05-06 04:17:41', '2019-05-06 04:17:41'),
(308, 0, 's2', NULL, NULL, NULL, 's2_2.jpg', 1, NULL, '2019-05-09 03:48:44', '2019-05-09 03:48:44'),
(309, 0, 's3', NULL, NULL, NULL, 's3_2.jpg', 1, NULL, '2019-05-09 03:48:55', '2019-05-09 03:48:55'),
(310, 0, 's4', NULL, NULL, NULL, 's4_2.jpg', 1, NULL, '2019-05-09 03:49:06', '2019-05-09 03:49:06'),
(311, 0, '1553335256.PRIMA3', NULL, NULL, NULL, '1553335256.prima3.jpg', 1, NULL, '2019-05-09 04:37:39', '2019-05-09 04:37:39'),
(312, 0, 'leaves-mashed-drugs-organic-product-icon-ve-vector-6584765', NULL, NULL, NULL, 'leaves-mashed-drugs-organic-product-icon-ve-vector-6584765.jpg', 1, NULL, '2019-05-09 04:41:29', '2019-05-09 04:41:29'),
(313, 0, 'images', NULL, NULL, NULL, 'images.png', 1, NULL, '2019-05-09 04:43:58', '2019-05-09 04:43:58'),
(314, 0, '1', NULL, NULL, NULL, '1.png', 1, NULL, '2019-05-09 04:49:01', '2019-05-09 04:49:01'),
(315, 0, '2', NULL, NULL, NULL, '2.png', 1, NULL, '2019-05-09 04:49:19', '2019-05-09 04:49:19'),
(316, 0, '3', NULL, NULL, NULL, '3.png', 1, NULL, '2019-05-09 04:49:37', '2019-05-09 04:49:37'),
(317, 0, '4', NULL, NULL, NULL, '4.png', 1, NULL, '2019-05-09 04:49:54', '2019-05-09 04:49:54'),
(318, 0, '5', NULL, NULL, NULL, '5.png', 1, NULL, '2019-05-09 04:50:12', '2019-05-09 04:50:12'),
(319, 0, '6', NULL, NULL, NULL, '6.png', 1, NULL, '2019-05-09 04:50:34', '2019-05-09 04:50:34'),
(320, 0, '7', NULL, NULL, NULL, '7.png', 1, NULL, '2019-05-09 04:50:52', '2019-05-09 04:50:52'),
(321, 0, '8', NULL, NULL, NULL, '8.png', 1, NULL, '2019-05-09 04:51:09', '2019-05-09 04:51:09'),
(322, 0, '9', NULL, NULL, NULL, '9.png', 1, NULL, '2019-05-09 04:51:28', '2019-05-09 04:51:28'),
(323, 0, '10', NULL, NULL, NULL, '10.png', 1, NULL, '2019-05-09 04:51:45', '2019-05-09 04:51:45'),
(324, 0, '12', NULL, NULL, NULL, '12.png', 1, NULL, '2019-05-09 04:52:04', '2019-05-09 04:52:04'),
(325, 0, '13', NULL, NULL, NULL, '13.png', 1, NULL, '2019-05-09 04:52:24', '2019-05-09 04:52:24'),
(326, 0, '14', NULL, NULL, NULL, '14.png', 1, NULL, '2019-05-09 04:52:41', '2019-05-09 04:52:41'),
(327, 0, '15', NULL, NULL, NULL, '15.png', 1, NULL, '2019-05-09 04:52:59', '2019-05-09 04:52:59'),
(328, 0, '16', NULL, NULL, NULL, '16.png', 1, NULL, '2019-05-09 04:53:17', '2019-05-09 04:53:17'),
(329, 0, '17', NULL, NULL, NULL, '17.png', 1, NULL, '2019-05-09 04:53:35', '2019-05-09 04:53:35'),
(330, 0, '18', NULL, NULL, NULL, '18.png', 1, NULL, '2019-05-09 04:53:53', '2019-05-09 04:53:53'),
(331, 0, '19', NULL, NULL, NULL, '19.png', 1, NULL, '2019-05-09 04:54:10', '2019-05-09 04:54:10'),
(332, 0, '18F025A', NULL, NULL, NULL, '18f025a.jpg', 1, NULL, '2019-05-09 04:54:22', '2019-05-09 04:54:22'),
(333, 0, '20', NULL, NULL, NULL, '20.png', 1, NULL, '2019-05-09 04:54:40', '2019-05-09 04:54:40'),
(334, 0, '21', NULL, NULL, NULL, '21.png', 1, NULL, '2019-05-09 04:54:57', '2019-05-09 04:54:57'),
(335, 0, '19H002', NULL, NULL, NULL, '19h002.jpg', 1, NULL, '2019-05-09 04:55:11', '2019-05-09 04:55:11'),
(336, 0, '22', NULL, NULL, NULL, '22.png', 1, NULL, '2019-05-09 04:55:28', '2019-05-09 04:55:28'),
(337, 0, '4697bb66ed3b0d6c85af7019898e61989ecff850', NULL, NULL, NULL, '4697bb66ed3b0d6c85af7019898e61989ecff850.jpg', 1, NULL, '2019-05-09 04:55:40', '2019-05-09 04:55:40'),
(338, 0, 'Bisto_Chip_Shop_Curry_Sauce_200__00696_zoom_o4y5-7p', NULL, NULL, NULL, 'bisto_chip_shop_curry_sauce_200__00696_zoom_o4y5-7p.jpg', 1, NULL, '2019-05-09 04:55:49', '2019-05-09 04:55:49'),
(339, 0, 'Greek-Caprice-Papadopoulou-Viennese-Wafers-With-Hazelnut', NULL, NULL, NULL, 'greek-caprice-papadopoulou-viennese-wafers-with-hazelnut.jpg', 1, NULL, '2019-05-09 04:55:58', '2019-05-09 04:55:58'),
(340, 0, 's-l225', NULL, NULL, NULL, 's-l225.jpg', 1, NULL, '2019-05-09 04:56:07', '2019-05-09 04:56:07'),
(341, 0, 'IDShot_540x540', NULL, NULL, NULL, 'idshot_540x540.jpg', 1, NULL, '2019-05-09 04:56:17', '2019-05-09 04:56:17'),
(352, 0, 'pepsico-bdfsdfsdfrands', NULL, NULL, NULL, 'pepsico-bdfsdfsdfrands.jpg', 1, NULL, '2019-05-09 05:36:09', '2019-05-09 05:36:09'),
(353, 0, 'pepsico-brands', NULL, NULL, NULL, 'pepsico-brands.jpg', 1, NULL, '2019-05-09 05:36:18', '2019-05-09 05:36:18'),
(354, 0, 'pepsicofsdfsd-brands', NULL, NULL, NULL, 'pepsicofsdfsd-brands.jpg', 1, NULL, '2019-05-09 05:36:30', '2019-05-09 05:36:30'),
(355, 0, 'pepsidfgdco-brands', NULL, NULL, NULL, 'pepsidfgdco-brands.jpg', 1, NULL, '2019-05-09 05:39:26', '2019-05-09 05:39:26'),
(356, 0, 'pepvsdfgsico-brands', NULL, NULL, NULL, 'pepvsdfgsico-brands.jpg', 1, NULL, '2019-05-09 05:40:18', '2019-05-09 05:40:18'),
(357, 0, '1531931534.SLIDE_3', NULL, NULL, NULL, '1531931534.slide_3.jpg', 1, NULL, '2019-05-09 05:45:27', '2019-05-09 05:45:27'),
(358, 0, '1531931568.Slide-5_1', NULL, NULL, NULL, '1531931568.slide-5_1.jpg', 1, NULL, '2019-05-09 05:45:37', '2019-05-09 05:45:37'),
(359, 0, '1531931702.slide_4_1', NULL, NULL, NULL, '1531931702.slide_4_1.jpg', 1, NULL, '2019-05-09 05:45:46', '2019-05-09 05:45:46'),
(360, 0, '72466_new-orange-fluorescent-circle-stickers-and-labels', NULL, NULL, NULL, '72466_new-orange-fluorescent-circle-stickers-and-labels.png', 1, NULL, '2019-05-09 06:38:26', '2019-05-09 06:38:26'),
(361, 0, 'logo', NULL, NULL, NULL, 'logo_2.png', 1, NULL, '2019-05-09 08:17:55', '2019-05-09 08:17:55'),
(362, 0, 'kisspng-avatar-user-profile-male-logo-profile-icon-5b238cb002ed52.870627731529056432012', NULL, NULL, NULL, 'kisspng-avatar-user-profile-male-logo-profile-icon-5b238cb002ed52.870627731529056432012.jpg', 1, NULL, '2019-05-12 07:39:14', '2019-05-12 07:39:14'),
(372, 0, 'blogging', NULL, NULL, NULL, 'blogging.jpg', 1, NULL, '2019-05-13 06:48:58', '2019-05-13 06:48:58'),
(373, 0, 'Blog-Image', NULL, NULL, NULL, 'blog-image.jpg', 1, NULL, '2019-05-13 06:49:10', '2019-05-13 06:49:10'),
(374, 0, 'blog-laptop-copy-2-1', NULL, NULL, NULL, 'blog-laptop-copy-2-1.jpg', 1, NULL, '2019-05-13 06:49:23', '2019-05-13 06:49:23');

-- --------------------------------------------------------

--
-- Table structure for table `media_permissions`
--

CREATE TABLE `media_permissions` (
  `id` int(10) UNSIGNED NOT NULL,
  `media_id` int(10) UNSIGNED NOT NULL,
  `user_id` int(10) UNSIGNED NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

-- --------------------------------------------------------

--
-- Table structure for table `migrations`
--

CREATE TABLE `migrations` (
  `id` int(10) UNSIGNED NOT NULL,
  `migration` varchar(191) NOT NULL,
  `batch` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Dumping data for table `migrations`
--

INSERT INTO `migrations` (`id`, `migration`, `batch`) VALUES
(1, '2014_10_12_000000_create_users_table', 1),
(2, '2014_10_12_100000_create_password_resets_table', 1),
(3, '2017_08_07_034348_create_settings_table', 1),
(4, '2017_08_07_035559_create_users_metas_table', 1),
(5, '2017_08_07_042628_create_roles_table', 1),
(6, '2017_08_07_092248_create_media_table', 1),
(7, '2017_08_08_093255_create_visitors_table', 1),
(8, '2017_08_10_091903_create_pages_table', 1),
(9, '2017_08_10_091915_create_sliders_table', 1),
(10, '2017_10_03_070336_create_categories_table', 1),
(11, '2017_10_03_070345_create_categoryables_table', 1),
(12, '2017_10_03_070354_create_tags_table', 1),
(13, '2017_10_03_070407_create_taggables_table', 1),
(14, '2017_10_03_071431_create_comments_table', 1),
(15, '2017_10_03_071448_create_blogs_table', 1),
(16, '2017_10_30_054713_create_admins_table', 1),
(17, '2017_10_30_055642_create_admins_metas_table', 1),
(18, '2017_11_09_064245_create_orders_table', 1),
(19, '2017_11_09_064315_create_payments_table', 1),
(20, '2017_11_09_064335_create_order_details_table', 1),
(21, '2017_11_09_083522_create_payment_methods_table', 1),
(22, '2017_11_11_040005_create_coupons_table', 1),
(23, '2017_11_11_040822_add_auth_id_to_users_table', 1),
(24, '2017_11_19_063429_create_taxes_table', 1),
(25, '2017_12_09_032351_create_media_permissions_table', 1),
(26, '2017_12_10_035008_create_subscribers_table', 1),
(27, '2017_12_11_061154_create_wishlists_table', 1),
(28, '2018_03_13_041023_add_style_to_sliders_table', 1),
(29, '2018_03_14_051359_create_likes_table', 1),
(30, '2018_03_14_052316_add_likes_to_blogs_table', 1),
(31, '2018_04_09_104924_add_banner_title_to_pages_table', 1),
(32, '2018_04_09_104948_add_banner_subtitle_to_pages_table', 1),
(33, '2019_03_19_050137_create_brands_table', 1),
(34, '2019_03_19_102008_create_attributetitles_table', 1),
(35, '2019_03_19_103516_create_attributes_table', 1),
(36, '2019_03_19_113141_create_products_table', 1),
(37, '2019_03_21_054136_create_attribute_product_table', 1),
(38, '2019_03_21_063225_create_units_table', 1),
(39, '2019_03_27_091510_create_shoppingcart_table', 1),
(40, '2019_04_08_090946_create_product_reviews_table', 1),
(41, '2019_04_16_090954_create_shippings_table', 1),
(42, '2019_04_16_120742_create_shipping_methods_table', 1);

-- --------------------------------------------------------

--
-- Table structure for table `orders`
--

CREATE TABLE `orders` (
  `id` int(10) UNSIGNED NOT NULL,
  `user_id` int(10) UNSIGNED NOT NULL,
  `customer_name` varchar(191) DEFAULT NULL,
  `contact_email` varchar(191) DEFAULT NULL,
  `cart_json` longtext,
  `sub_total` double(10,2) NOT NULL,
  `discount` double(5,2) NOT NULL,
  `coupon_code` varchar(191) DEFAULT NULL,
  `coupon_amount` double(6,2) NOT NULL DEFAULT '0.00',
  `tax` double(6,2) NOT NULL DEFAULT '0.00',
  `baseCurrency` varchar(20) NOT NULL,
  `currency` varchar(20) NOT NULL,
  `currencyRate` float NOT NULL,
  `currency_symbol` varchar(20) NOT NULL,
  `grand_total` double(10,2) NOT NULL,
  `paid` double(10,2) NOT NULL,
  `payment_method_id` int(10) UNSIGNED DEFAULT NULL,
  `order_note` text,
  `attachments` text,
  `completed_files` text,
  `created_by` int(10) UNSIGNED NOT NULL,
  `modified_by` int(10) UNSIGNED DEFAULT NULL,
  `order_status` tinyint(4) NOT NULL DEFAULT '3' COMMENT '1=Completed, 2=Processing, 3=Pending, 4=Cancelled',
  `payment_status` tinyint(4) NOT NULL DEFAULT '3' COMMENT '1=Completed, 2=Pending, 3=Cancelled',
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Dumping data for table `orders`
--

INSERT INTO `orders` (`id`, `user_id`, `customer_name`, `contact_email`, `cart_json`, `sub_total`, `discount`, `coupon_code`, `coupon_amount`, `tax`, `baseCurrency`, `currency`, `currencyRate`, `currency_symbol`, `grand_total`, `paid`, `payment_method_id`, `order_note`, `attachments`, `completed_files`, `created_by`, `modified_by`, `order_status`, `payment_status`, `created_at`, `updated_at`) VALUES
(27, 4, NULL, 'rubelm677@gmail.com', '{\"d97ddbeb9c0ed03db18f60c614c40a28\":{\"rowId\":\"d97ddbeb9c0ed03db18f60c614c40a28\",\"id\":\"24\",\"name\":\"BU-W-MD-5-1259\",\"qty\":\"2\",\"price\":2950,\"options\":{\"image\":\"img_1111.jpg\",\"slug\":\"bu-w-md-5-1259\",\"sku\":\"B01288\",\"size\":\"2\",\"color\":\"7\",\"sizename\":\"M\",\"colorname\":\"Variable\"},\"tax\":0,\"subtotal\":5900}}', 5900.00, 0.00, NULL, 0.00, 590.00, 'BDT', 'USD', 0.012, '$', 6540.00, 0.00, 3, 'gfsdfg sdfg', NULL, NULL, 0, NULL, 3, 3, '2019-04-30 09:29:05', '2019-04-30 09:29:05'),
(28, 4, NULL, 'rubelm677@gmail.com', '{\"9198675da6cfe769a674529f9dd95c49\":{\"rowId\":\"9198675da6cfe769a674529f9dd95c49\",\"id\":\"24\",\"name\":\"BU-W-MD-5-1259\",\"qty\":\"5\",\"price\":2950,\"options\":{\"image\":\"img_1111.jpg\",\"slug\":\"bu-w-md-5-1259\",\"sku\":\"B01288\",\"size\":\"4\",\"color\":\"7\",\"sizename\":\"XL\",\"colorname\":\"Variable\"},\"tax\":0,\"subtotal\":14750}}', 14750.00, 0.00, NULL, 0.00, 1475.00, 'BDT', 'EUR', 0.011, '€', 16285.00, 16285.00, 3, NULL, NULL, NULL, 0, NULL, 1, 1, '2019-04-30 09:53:38', '2019-04-30 10:01:00'),
(29, 4, NULL, 'rubelm677@gmail.com', '{\"4df0f615718dd4ea477994143e27bc2e\":{\"rowId\":\"4df0f615718dd4ea477994143e27bc2e\",\"id\":\"24\",\"name\":\"BU-W-MD-5-1259\",\"qty\":\"3\",\"price\":2950,\"options\":{\"image\":\"img_1111.jpg\",\"slug\":\"bu-w-md-5-1259\",\"sku\":\"B01288\",\"size\":\"1\",\"color\":\"7\",\"sizename\":\"S\",\"colorname\":\"Variable\"},\"tax\":0,\"subtotal\":8850}}', 8850.00, 0.00, NULL, 0.00, 885.00, 'BDT', '230', 2.72612, '$', 9795.00, 0.00, 3, 'fasdf asdf', NULL, NULL, 0, NULL, 3, 3, '2019-04-30 11:18:59', '2019-04-30 11:18:59'),
(30, 2, NULL, 'admin1@gmail.com', '{\"470a2a5a65e1effa514da5c206e5582a\":{\"rowId\":\"470a2a5a65e1effa514da5c206e5582a\",\"id\":\"1\",\"name\":\"BU-W-T3PC-3-1549\",\"qty\":3,\"price\":2850,\"options\":{\"image\":\"img_1274.jpg\",\"slug\":\"bu-w-t3pc-3-1549\",\"sku\":\"B01591\",\"size\":\"1\",\"color\":\"7\",\"sizename\":\"S\",\"colorname\":\"Variable\"},\"tax\":0,\"subtotal\":8550}}', 8550.00, 999.99, NULL, 0.00, 855.00, '19', '19', 0, '৳', 7745.00, 0.00, 3, 'adasdas', NULL, NULL, 0, NULL, 4, 2, '2019-05-02 11:19:58', '2019-05-04 03:44:01');

-- --------------------------------------------------------

--
-- Table structure for table `order_details`
--

CREATE TABLE `order_details` (
  `id` int(10) UNSIGNED NOT NULL,
  `order_id` int(10) UNSIGNED NOT NULL,
  `product_id` int(10) UNSIGNED NOT NULL,
  `product_color` varchar(191) DEFAULT NULL,
  `product_size` varchar(191) DEFAULT NULL,
  `product_image` varchar(100) DEFAULT NULL,
  `product_qty` int(10) UNSIGNED NOT NULL DEFAULT '1',
  `product_price` double(10,2) NOT NULL,
  `sub_total` double(10,2) NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Dumping data for table `order_details`
--

INSERT INTO `order_details` (`id`, `order_id`, `product_id`, `product_color`, `product_size`, `product_image`, `product_qty`, `product_price`, `sub_total`, `created_at`, `updated_at`) VALUES
(1, 27, 24, 'Variable', 'M', 'img_1111.jpg', 2, 2950.00, 5900.00, '2019-04-30 09:29:06', '2019-04-30 09:29:06'),
(2, 28, 24, 'Variable', 'XL', 'img_1111.jpg', 5, 2950.00, 14750.00, '2019-04-30 09:53:38', '2019-04-30 09:53:38'),
(3, 29, 24, 'Variable', 'S', 'img_1111.jpg', 3, 2950.00, 8850.00, '2019-04-30 11:18:59', '2019-04-30 11:18:59'),
(4, 30, 1, 'Variable', 'S', 'img_1274.jpg', 3, 2850.00, 8550.00, '2019-05-02 11:19:58', '2019-05-02 11:19:58');

-- --------------------------------------------------------

--
-- Table structure for table `pages`
--

CREATE TABLE `pages` (
  `id` int(10) UNSIGNED NOT NULL,
  `menu_title` varchar(191) NOT NULL,
  `page_title` varchar(191) NOT NULL,
  `page_subtitle` varchar(191) DEFAULT NULL,
  `banner_title` varchar(191) DEFAULT NULL,
  `banner_subtitle` text,
  `banner_image` varchar(191) DEFAULT NULL,
  `content` longtext NOT NULL,
  `slug` varchar(191) NOT NULL,
  `template` varchar(191) DEFAULT NULL,
  `views` int(10) UNSIGNED NOT NULL DEFAULT '0',
  `seo_title` varchar(191) DEFAULT NULL,
  `meta_key` text,
  `meta_description` text,
  `created_by` int(10) UNSIGNED DEFAULT NULL,
  `modified_by` int(10) UNSIGNED DEFAULT NULL,
  `status` tinyint(4) NOT NULL DEFAULT '2' COMMENT '1=active, 2=pending, 3=cancel',
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Dumping data for table `pages`
--

INSERT INTO `pages` (`id`, `menu_title`, `page_title`, `page_subtitle`, `banner_title`, `banner_subtitle`, `banner_image`, `content`, `slug`, `template`, `views`, `seo_title`, `meta_key`, `meta_description`, `created_by`, `modified_by`, `status`, `created_at`, `updated_at`) VALUES
(1, 'PRIVACY POLICY', 'PRIVACY POLICY', NULL, NULL, NULL, NULL, '<pre>\r\n<strong>&lt;?php\r\n</strong><em>/**\r\n</em><em> * Created by PhpStorm.\r\n</em><em> * User: mrksohag\r\n</em><em> * Date: 8/16/17\r\n</em><em> * Time: 4:33 PM\r\n</em><em> */\r\n</em><strong>?&gt;\r\n</strong><em>&lt;!-- start login form --&gt;\r\n</em><span style=\"background-color:#efefef\">&lt;</span><strong>input </strong><strong>type=</strong><strong>&quot;hidden&quot; </strong><strong>name=</strong><strong>&quot;_token&quot; </strong><strong>id=</strong><strong>&quot;table_csrf_token&quot; </strong><strong>value=</strong><strong>&quot;</strong><span style=\"background-color:#f7faff\">{!! csrf_token() !!}</span><strong>&quot;</strong><span style=\"background-color:#efefef\">&gt;</span>\r\n<strong>&lt;?php\r\n</strong><span style=\"background-color:#f7faff; color:#660000\">$authCheck </span><span style=\"background-color:#f7faff\">= Auth::</span><em>check</em><span style=\"background-color:#f7faff\">();\r\n</span><span style=\"background-color:#f7faff; color:#660000\">$newsletter_pop_is_enable </span><span style=\"background-color:#f7faff\">= SM::</span><em>smGetThemeOption</em><span style=\"background-color:#f7faff\">( </span><strong>&quot;newsletter_pop_is_enable&quot;</strong><span style=\"background-color:#f7faff\">, </span><span style=\"background-color:#f7faff; color:#0000ff\">0 </span><span style=\"background-color:#f7faff\">);\r\n</span><span style=\"background-color:#f7faff; color:#660000\">$offer_is_enable </span><span style=\"background-color:#f7faff\">= SM::</span><em>smGetThemeOption</em><span style=\"background-color:#f7faff\">( </span><strong>&quot;offer_is_enable&quot;</strong><span style=\"background-color:#f7faff\">, </span><span style=\"background-color:#f7faff; color:#0000ff\">0 </span><span style=\"background-color:#f7faff\">);\r\n</span>\r\n<strong>echo </strong><span style=\"background-color:#f7faff\">Cookie::</span><em>get</em><span style=\"background-color:#f7faff\">( </span><strong>&quot;smSubscribe&quot; </strong><span style=\"background-color:#f7faff\">);\r\n</span><strong>?&gt;\r\n</strong><strong>@if(</strong><span style=\"background-color:#f7faff; color:#660000\">$newsletter_pop_is_enable</span><span style=\"background-color:#f7faff\">==</span><span style=\"background-color:#f7faff; color:#0000ff\">1</span><strong>)\r\n</strong><strong>   &lt;?php\r\n</strong><strong>   </strong><span style=\"background-color:#f7faff; color:#660000\">$doodleSubscriber </span><span style=\"background-color:#f7faff\">= Cookie::</span><em>get</em><span style=\"background-color:#f7faff\">( </span><strong>&quot;doodleSubscriber&quot; </strong><span style=\"background-color:#f7faff\">);\r\n</span><span style=\"background-color:#f7faff\">   </span><strong>if </strong><span style=\"background-color:#f7faff\">( !</span><span style=\"background-color:#f7faff; color:#660000\">$doodleSubscriber </span><span style=\"background-color:#f7faff\">&amp;&amp; </span><span style=\"background-color:#f7faff; color:#660000\">$authCheck </span><span style=\"background-color:#f7faff\">) {\r\n</span><span style=\"background-color:#f7faff\">      </span><span style=\"background-color:#f7faff; color:#660000\">$doodleSubscriber </span><span style=\"background-color:#f7faff\">= SM::</span><em>isSubscribed</em><span style=\"background-color:#f7faff\">( Auth::</span><em>user</em><span style=\"background-color:#f7faff\">()-&gt;</span><strong>email </strong><span style=\"background-color:#f7faff\">);\r\n</span><span style=\"background-color:#f7faff\">   }\r\n</span><span style=\"background-color:#f7faff\">   </span><strong>?&gt;\r\n</strong><strong>    @if(</strong><span style=\"background-color:#f7faff\">!</span><span style=\"background-color:#f7faff; color:#660000\">$doodleSubscriber</span><strong>)\r\n</strong><strong>        </strong><span style=\"background-color:#efefef\">&lt;</span><strong>div </strong><strong>class=</strong><strong>&quot;newslatter-popup-item&quot;</strong><span style=\"background-color:#efefef\">&gt;</span>\r\n            <span style=\"background-color:#efefef\">&lt;</span><strong>div </strong><strong>class=</strong><strong>&quot;newslatter-content&quot; </strong><strong>id=</strong><strong>&quot;doodle-newslatter-popup&quot;</strong><span style=\"background-color:#efefef\">&gt;</span>\r\n                <span style=\"background-color:#efefef\">&lt;</span><strong>div </strong><strong>class=</strong><strong>&quot;newslatter-popup-header&quot;</strong><span style=\"background-color:#efefef\">&gt;</span>\r\n                    <span style=\"background-color:#efefef\">&lt;</span><strong>img </strong><strong>src=</strong><strong>&quot;</strong><strong>&lt;?php echo </strong><span style=\"background-color:#f7faff\">SM::</span><em>sm_get_the_src</em><span style=\"background-color:#f7faff\">( SM::</span><em>sm_get_site_logo</em><span style=\"background-color:#f7faff\">(), </span><span style=\"background-color:#f7faff; color:#0000ff\">193</span><span style=\"background-color:#f7faff\">, </span><span style=\"background-color:#f7faff; color:#0000ff\">78 </span><span style=\"background-color:#f7faff\">); </span><strong>?&gt;</strong><strong>&quot; </strong><strong>alt=</strong><strong>&quot;Logo&quot;</strong><span style=\"background-color:#efefef\">&gt;</span>\r\n                    <span style=\"background-color:#efefef\">&lt;</span><strong>div </strong><strong>class=</strong><strong>&quot;closeBar subscriptionClosedForADay&quot; </strong><strong>data-id=</strong><strong>&quot;#newsletter&quot;</strong><span style=\"background-color:#efefef\">&gt;</span>\r\n                        <span style=\"background-color:#efefef\">&lt;</span><strong>span</strong><span style=\"background-color:#efefef\">&gt;&lt;/</span><strong>span</strong><span style=\"background-color:#efefef\">&gt;</span>\r\n                        <span style=\"background-color:#efefef\">&lt;</span><strong>span</strong><span style=\"background-color:#efefef\">&gt;&lt;/</span><strong>span</strong><span style=\"background-color:#efefef\">&gt;</span>\r\n                    <span style=\"background-color:#efefef\">&lt;/</span><strong>div</strong><span style=\"background-color:#efefef\">&gt;</span>\r\n                <span style=\"background-color:#efefef\">&lt;/</span><strong>div</strong><span style=\"background-color:#efefef\">&gt;</span>\r\n                <span style=\"background-color:#efefef\">&lt;</span><strong>div </strong><strong>class=</strong><strong>&quot;newslatter-popup-content pull-left&quot;</strong><span style=\"background-color:#efefef\">&gt;</span>\r\n                    <span style=\"background-color:#efefef\">&lt;</span><strong>h3</strong><span style=\"background-color:#efefef\">&gt;</span><span style=\"background-color:#f7faff\">{{ SM::</span><em>smGetThemeOption</em><span style=\"background-color:#f7faff\">( </span><strong>&quot;newsletter_pop_title&quot;</strong><span style=\"background-color:#f7faff\">,  </span><strong>&#39;Join Our Newsletter&#39;</strong><span style=\"background-color:#f7faff\">) }}</span><span style=\"background-color:#efefef\">&lt;/</span><strong>h3</strong><span style=\"background-color:#efefef\">&gt;</span>\r\n                    <span style=\"background-color:#f7faff\">{!!  SM::</span><em>smGetThemeOption</em><span style=\"background-color:#f7faff\">( </span><strong>&quot;newsletter_pop_description&quot;</strong><span style=\"background-color:#f7faff\">,  </span><strong>&#39;&lt;p&gt;\r\n</strong><strong>                    We really care about you and your website as much as you do. from us you get 100% free support.\r\n</strong><strong>                &lt;/p&gt;&#39;</strong><span style=\"background-color:#f7faff\">) !!}\r\n</span>\r\n<span style=\"background-color:#f7faff\">                    {!! Form::</span><em>open</em><span style=\"background-color:#f7faff\">([</span><strong>&quot;method&quot;</strong><span style=\"background-color:#f7faff\">=&gt;</span><strong>&quot;post&quot;</strong><span style=\"background-color:#f7faff\">, </span><strong>&quot;action&quot;</strong><span style=\"background-color:#f7faff\">=&gt;</span><strong>&#39;Front\\HomeController@subscribe&#39;</strong><span style=\"background-color:#f7faff\">, </span><strong>&#39;id&#39;</strong><span style=\"background-color:#f7faff\">=&gt;</span><strong>&quot;newsletterPopUpForm&quot;</strong><span style=\"background-color:#f7faff\">]) !!}\r\n</span><span style=\"background-color:#f7faff\">                    </span><span style=\"background-color:#efefef\">&lt;</span><strong>div </strong><strong>class=</strong><strong>&quot;newslatter-popup-form&quot;</strong><span style=\"background-color:#efefef\">&gt;</span>\r\n                        <span style=\"background-color:#efefef\">&lt;</span><strong>input </strong><strong>type=</strong><strong>&quot;email&quot; </strong><strong>class=</strong><strong>&quot;popup-email-type&quot; </strong><strong>name=</strong><strong>&quot;email&quot; </strong><strong>value=</strong><strong>&quot;&quot; </strong><strong>placeholder=</strong><strong>&quot;Your E-mail&quot;</strong><span style=\"background-color:#efefef\">&gt;</span>\r\n                        <span style=\"background-color:#efefef\">&lt;</span><strong>button </strong><strong>type=</strong><strong>&quot;submit&quot; </strong><strong>id=</strong><strong>&quot;newsletterPopUpFormSubmit&quot;</strong><span style=\"background-color:#efefef\">&gt;</span>Submit<span style=\"background-color:#efefef\">&lt;/</span><strong>button</strong><span style=\"background-color:#efefef\">&gt;</span>\r\n                    <span style=\"background-color:#efefef\">&lt;/</span><strong>div</strong><span style=\"background-color:#efefef\">&gt;</span>\r\n                    <span style=\"background-color:#f7faff\">{!! Form::</span><em>close</em><span style=\"background-color:#f7faff\">() !!}\r\n</span><span style=\"background-color:#f7faff\">                    </span><span style=\"background-color:#efefef\">&lt;</span><strong>ul </strong><strong>class=</strong><strong>&quot;newslatter-popup-socail&quot;</strong><span style=\"background-color:#efefef\">&gt;</span>\r\n                        <strong>@empty(</strong><span style=\"background-color:#f7faff\">!SM::</span><em>smGetThemeOption</em><span style=\"background-color:#f7faff\">(</span><strong>&quot;social_facebook&quot;</strong><span style=\"background-color:#f7faff\">)</span><strong>)\r\n</strong><strong>                            </strong><span style=\"background-color:#efefef\">&lt;</span><strong>li</strong><span style=\"background-color:#efefef\">&gt;</span>\r\n                                <span style=\"background-color:#efefef\">&lt;</span><strong>a </strong><strong>href=</strong><strong>&quot;</strong><span style=\"background-color:#f7faff\">{{ SM::</span><em>smGetThemeOption</em><span style=\"background-color:#f7faff\">(</span><strong>&quot;social_facebook&quot;</strong><span style=\"background-color:#f7faff\">) }}</span><strong>&quot;</strong><span style=\"background-color:#efefef\">&gt;&lt;</span><strong>i </strong><strong>class=</strong><strong>&quot;fa fa-facebook&quot;</strong><span style=\"background-color:#efefef\">&gt;&lt;/</span><strong>i</strong><span style=\"background-color:#efefef\">&gt;</span>\r\n                                <span style=\"background-color:#efefef\">&lt;/</span><strong>a</strong><span style=\"background-color:#efefef\">&gt;</span>\r\n                            <span style=\"background-color:#efefef\">&lt;/</span><strong>li</strong><span style=\"background-color:#efefef\">&gt;</span>\r\n                        <strong>@endempty\r\n</strong><strong>                        @empty(</strong><span style=\"background-color:#f7faff\">!SM::</span><em>smGetThemeOption</em><span style=\"background-color:#f7faff\">(</span><strong>&quot;social_twitter&quot;</strong><span style=\"background-color:#f7faff\">)</span><strong>)\r\n</strong><strong>                            </strong><span style=\"background-color:#efefef\">&lt;</span><strong>li</strong><span style=\"background-color:#efefef\">&gt;</span>\r\n                                <span style=\"background-color:#efefef\">&lt;</span><strong>a </strong><strong>href=</strong><strong>&quot;</strong><span style=\"background-color:#f7faff\">{{ SM::</span><em>smGetThemeOption</em><span style=\"background-color:#f7faff\">(</span><strong>&quot;social_twitter&quot;</strong><span style=\"background-color:#f7faff\">) }}</span><strong>&quot;</strong><span style=\"background-color:#efefef\">&gt;&lt;</span><strong>i </strong><strong>class=</strong><strong>&quot;fa fa-twitter&quot;</strong><span style=\"background-color:#efefef\">&gt;&lt;/</span><strong>i</strong><span style=\"background-color:#efefef\">&gt;</span>\r\n                                <span style=\"background-color:#efefef\">&lt;/</span><strong>a</strong><span style=\"background-color:#efefef\">&gt;</span>\r\n                            <span style=\"background-color:#efefef\">&lt;/</span><strong>li</strong><span style=\"background-color:#efefef\">&gt;</span>\r\n                        <strong>@endempty\r\n</strong><strong>                        @empty(</strong><span style=\"background-color:#f7faff\">!SM::</span><em>smGetThemeOption</em><span style=\"background-color:#f7faff\">(</span><strong>&quot;social_linkedin&quot;</strong><span style=\"background-color:#f7faff\">)</span><strong>)\r\n</strong><strong>                            </strong><span style=\"background-color:#efefef\">&lt;</span><strong>li</strong><span style=\"background-color:#efefef\">&gt;</span>\r\n                                <span style=\"background-color:#efefef\">&lt;</span><strong>a </strong><strong>href=</strong><strong>&quot;</strong><span style=\"background-color:#f7faff\">{{ SM::</span><em>smGetThemeOption</em><span style=\"background-color:#f7faff\">(</span><strong>&quot;social_linkedin&quot;</strong><span style=\"background-color:#f7faff\">) }}</span><strong>&quot;</strong><span style=\"background-color:#efefef\">&gt;&lt;</span><strong>i </strong><strong>class=</strong><strong>&quot;fa fa-linkedin&quot;</strong><span style=\"background-color:#efefef\">&gt;&lt;/</span><strong>i</strong><span style=\"background-color:#efefef\">&gt;</span>\r\n                                <span style=\"background-color:#efefef\">&lt;/</span><strong>a</strong><span style=\"background-color:#efefef\">&gt;</span>\r\n                            <span style=\"background-color:#efefef\">&lt;/</span><strong>li</strong><span style=\"background-color:#efefef\">&gt;</span>\r\n                        <strong>@endempty\r\n</strong><strong>                        @empty(</strong><span style=\"background-color:#f7faff\">!SM::</span><em>smGetThemeOption</em><span style=\"background-color:#f7faff\">(</span><strong>&quot;social_github&quot;</strong><span style=\"background-color:#f7faff\">)</span><strong>)\r\n</strong><strong>                            </strong><span style=\"background-color:#efefef\">&lt;</span><strong>li</strong><span style=\"background-color:#efefef\">&gt;</span>\r\n                                <span style=\"background-color:#efefef\">&lt;</span><strong>a </strong><strong>href=</strong><strong>&quot;</strong><span style=\"background-color:#f7faff\">{{ SM::</span><em>smGetThemeOption</em><span style=\"background-color:#f7faff\">(</span><strong>&quot;social_github&quot;</strong><span style=\"background-color:#f7faff\">) }}</span><strong>&quot;</strong><span style=\"background-color:#efefef\">&gt;&lt;</span><strong>i </strong><strong>class=</strong><strong>&quot;fa fa-github&quot;</strong><span style=\"background-color:#efefef\">&gt;&lt;/</span><strong>i</strong><span style=\"background-color:#efefef\">&gt;</span> <span style=\"background-color:#efefef\">&lt;/</span><strong>a</strong><span style=\"background-color:#efefef\">&gt;</span>\r\n                            <span style=\"background-color:#efefef\">&lt;/</span><strong>li</strong><span style=\"background-color:#efefef\">&gt;</span>\r\n                        <strong>@endempty\r\n</strong><strong>                        @empty(</strong><span style=\"background-color:#f7faff\">!SM::</span><em>smGetThemeOption</em><span style=\"background-color:#f7faff\">(</span><strong>&quot;social_behance&quot;</strong><span style=\"background-color:#f7faff\">)</span><strong>)\r\n</strong><strong>                            </strong><span style=\"background-color:#efefef\">&lt;</span><strong>li</strong><span style=\"background-color:#efefef\">&gt;</span>\r\n                                <span style=\"background-color:#efefef\">&lt;</span><strong>a </strong><strong>href=</strong><strong>&quot;</strong><span style=\"background-color:#f7faff\">{{ SM::</span><em>smGetThemeOption</em><span style=\"background-color:#f7faff\">(</span><strong>&quot;social_behance&quot;</strong><span style=\"background-color:#f7faff\">) }}</span><strong>&quot;</strong><span style=\"background-color:#efefef\">&gt;&lt;</span><strong>i </strong><strong>class=</strong><strong>&quot;fa fa-behance&quot;</strong><span style=\"background-color:#efefef\">&gt;&lt;/</span><strong>i</strong><span style=\"background-color:#efefef\">&gt;</span>\r\n                                <span style=\"background-color:#efefef\">&lt;/</span><strong>a</strong><span style=\"background-color:#efefef\">&gt;</span>\r\n                            <span style=\"background-color:#efefef\">&lt;/</span><strong>li</strong><span style=\"background-color:#efefef\">&gt;</span>\r\n                        <strong>@endempty\r\n</strong><strong>                        @empty(</strong><span style=\"background-color:#f7faff\">!SM::</span><em>smGetThemeOption</em><span style=\"background-color:#f7faff\">(</span><strong>&quot;social_pinterest&quot;</strong><span style=\"background-color:#f7faff\">)</span><strong>)\r\n</strong><strong>                            </strong><span style=\"background-color:#efefef\">&lt;</span><strong>li</strong><span style=\"background-color:#efefef\">&gt;</span>\r\n                                <span style=\"background-color:#efefef\">&lt;</span><strong>a </strong><strong>href=</strong><strong>&quot;</strong><span style=\"background-color:#f7faff\">{{ SM::</span><em>smGetThemeOption</em><span style=\"background-color:#f7faff\">(</span><strong>&quot;social_pinterest&quot;</strong><span style=\"background-color:#f7faff\">) }}</span><strong>&quot;</strong><span style=\"background-color:#efefef\">&gt;&lt;</span><strong>i\r\n</strong><strong>                                            </strong><strong>class=</strong><strong>&quot;fa fa-pinterest-p&quot;</strong><span style=\"background-color:#efefef\">&gt;&lt;/</span><strong>i</strong><span style=\"background-color:#efefef\">&gt;</span>\r\n                                <span style=\"background-color:#efefef\">&lt;/</span><strong>a</strong><span style=\"background-color:#efefef\">&gt;</span>\r\n                            <span style=\"background-color:#efefef\">&lt;/</span><strong>li</strong><span style=\"background-color:#efefef\">&gt;</span>\r\n                        <strong>@endempty\r\n</strong><strong>                    </strong><span style=\"background-color:#efefef\">&lt;/</span><strong>ul</strong><span style=\"background-color:#efefef\">&gt;</span>\r\n                <span style=\"background-color:#efefef\">&lt;/</span><strong>div</strong><span style=\"background-color:#efefef\">&gt;</span>\r\n                <span style=\"background-color:#efefef\">&lt;</span><strong>div </strong><strong>class=</strong><strong>&quot;newslatter-popup-img pull-right&quot;</strong><span style=\"background-color:#efefef\">&gt;</span>\r\n                    <span style=\"background-color:#efefef\">&lt;</span><strong>img </strong><strong>src=</strong><strong>&quot;</strong><span style=\"background-color:#f7faff\">{{ asset(</span><strong>&#39;images/newslatter-popup.png&#39;</strong><span style=\"background-color:#f7faff\">) }}</span><strong>&quot; </strong><strong>alt=</strong><strong>&quot;Doodle digital&quot;</strong><span style=\"background-color:#efefef\">&gt;</span>\r\n                <span style=\"background-color:#efefef\">&lt;/</span><strong>div</strong><span style=\"background-color:#efefef\">&gt;</span>\r\n            <span style=\"background-color:#efefef\">&lt;/</span><strong>div</strong><span style=\"background-color:#efefef\">&gt;</span>\r\n        <span style=\"background-color:#efefef\">&lt;/</span><strong>div</strong><span style=\"background-color:#efefef\">&gt;</span>\r\n    <strong>@endif\r\n</strong><strong>@endif\r\n</strong><strong>@if(</strong><span style=\"background-color:#f7faff; color:#660000\">$offer_is_enable</span><span style=\"background-color:#f7faff\">==</span><span style=\"background-color:#f7faff; color:#0000ff\">1</span><strong>)\r\n</strong><strong>   &lt;?php\r\n</strong><strong>   </strong><span style=\"background-color:#f7faff; color:#660000\">$doodleOffer </span><span style=\"background-color:#f7faff\">= Cookie::</span><em>get</em><span style=\"background-color:#f7faff\">( </span><strong>&quot;doodleOffer&quot; </strong><span style=\"background-color:#f7faff\">);\r\n</span><span style=\"background-color:#f7faff\">   </span><strong>?&gt;\r\n</strong><strong>    @if(</strong><span style=\"background-color:#f7faff\">!</span><span style=\"background-color:#f7faff; color:#660000\">$doodleOffer</span><strong>)\r\n</strong><strong>        </strong><span style=\"background-color:#efefef\">&lt;</span><strong>div </strong><strong>class=</strong><strong>&quot;offer-popup-item&quot;</strong><span style=\"background-color:#efefef\">&gt;</span>\r\n            <span style=\"background-color:#efefef\">&lt;</span><strong>div </strong><strong>class=</strong><strong>&quot;offer-popup-content&quot; </strong><strong>id=</strong><strong>&quot;doodle-offer-popup&quot;</strong><span style=\"background-color:#efefef\">&gt;</span>\r\n                <span style=\"background-color:#efefef\">&lt;</span><strong>div </strong><strong>class=</strong><strong>&quot;newslatter-popup-header offer-popup-header clearfix&quot;</strong><span style=\"background-color:#efefef\">&gt;</span>\r\n                    <span style=\"background-color:#efefef\">&lt;</span><strong>div </strong><strong>class=</strong><strong>&quot;offer-closeBar pull-right offerClosedForADay&quot;</strong><span style=\"background-color:#efefef\">&gt;</span>\r\n                        <span style=\"background-color:#efefef\">&lt;</span><strong>span</strong><span style=\"background-color:#efefef\">&gt;&lt;/</span><strong>span</strong><span style=\"background-color:#efefef\">&gt;</span>\r\n                        <span style=\"background-color:#efefef\">&lt;</span><strong>span</strong><span style=\"background-color:#efefef\">&gt;&lt;/</span><strong>span</strong><span style=\"background-color:#efefef\">&gt;</span>\r\n                    <span style=\"background-color:#efefef\">&lt;/</span><strong>div</strong><span style=\"background-color:#efefef\">&gt;</span>\r\n                <span style=\"background-color:#efefef\">&lt;/</span><strong>div</strong><span style=\"background-color:#efefef\">&gt;</span>\r\n                <span style=\"background-color:#efefef\">&lt;</span><strong>div </strong><strong>class=</strong><strong>&quot;newslatter-popup-content offer-popup-cont text-center pull-left&quot;</strong><span style=\"background-color:#efefef\">&gt;</span>\r\n                    <span style=\"background-color:#efefef\">&lt;</span><strong>h3</strong><span style=\"background-color:#efefef\">&gt;</span><span style=\"background-color:#f7faff\">{{ SM::</span><em>smGetThemeOption</em><span style=\"background-color:#f7faff\">( </span><strong>&quot;offer_title&quot;</strong><span style=\"background-color:#f7faff\">,  </span><strong>&#39;1st Order To 30% Off&#39;</strong><span style=\"background-color:#f7faff\">) }}</span><span style=\"background-color:#efefef\">&lt;/</span><strong>h3</strong><span style=\"background-color:#efefef\">&gt;</span>\r\n                    <span style=\"background-color:#f7faff\">{!!  SM::</span><em>smGetThemeOption</em><span style=\"background-color:#f7faff\">( </span><strong>&quot;offer_description&quot;</strong><span style=\"background-color:#f7faff\">,  </span><strong>&#39;&lt;p&gt;\r\n</strong><strong>                        As content marketing continues to drive results for businesses trying to reach their audience\r\n</strong><strong>                    &lt;/p&gt;\r\n</strong><strong>                    &lt;a href=&quot;#&quot;&gt;Get More&lt;/a&gt;&#39;</strong><span style=\"background-color:#f7faff\">) !!}\r\n</span><span style=\"background-color:#f7faff\">                </span><span style=\"background-color:#efefef\">&lt;/</span><strong>div</strong><span style=\"background-color:#efefef\">&gt;</span>\r\n                <span style=\"background-color:#efefef\">&lt;</span><strong>div </strong><strong>class=</strong><strong>&quot;offer-popup-img pull-right&quot;</strong><span style=\"background-color:#efefef\">&gt;</span>\r\n                    <span style=\"background-color:#efefef\">&lt;</span><strong>img </strong><strong>src=</strong><strong>&quot;</strong><span style=\"background-color:#f7faff\">{{ asset(</span><strong>&#39;images/offer-popup.png&#39;</strong><span style=\"background-color:#f7faff\">) }}</span><strong>&quot; </strong><strong>alt=</strong><strong>&quot;Doodle Digital&quot;</strong><span style=\"background-color:#efefef\">&gt;</span>\r\n                <span style=\"background-color:#efefef\">&lt;/</span><strong>div</strong><span style=\"background-color:#efefef\">&gt;</span>\r\n                <span style=\"background-color:#efefef\">&lt;</span><strong>div </strong><strong>class=</strong><strong>&quot;clearfix&quot;</strong><span style=\"background-color:#efefef\">&gt;&lt;/</span><strong>div</strong><span style=\"background-color:#efefef\">&gt;</span>\r\n            <span style=\"background-color:#efefef\">&lt;/</span><strong>div</strong><span style=\"background-color:#efefef\">&gt;</span>\r\n        <span style=\"background-color:#efefef\">&lt;/</span><strong>div</strong><span style=\"background-color:#efefef\">&gt;</span>\r\n    <strong>@endif\r\n</strong><strong>@endif\r\n</strong><span style=\"background-color:#efefef\">&lt;</span><strong>div </strong><strong>class=</strong><strong>&quot;search-wrap&quot;</strong><span style=\"background-color:#efefef\">&gt;</span>\r\n    <span style=\"background-color:#efefef\">&lt;</span><strong>div </strong><strong>class=</strong><strong>&quot;search-inner&quot; </strong><strong>id=</strong><strong>&quot;main_search&quot;</strong><span style=\"background-color:#efefef\">&gt;</span>\r\n        <span style=\"background-color:#efefef\">&lt;</span><strong>div </strong><strong>class=</strong><strong>&quot;search-select&quot;</strong><span style=\"background-color:#efefef\">&gt;</span>\r\n            <span style=\"background-color:#efefef\">&lt;</span><strong>select </strong><strong>id=</strong><strong>&quot;search_type&quot;</strong><span style=\"background-color:#efefef\">&gt;</span>\r\n                <span style=\"background-color:#efefef\">&lt;</span><strong>option</strong><span style=\"background-color:#efefef\">&gt;</span>All<span style=\"background-color:#efefef\">&lt;/</span><strong>option</strong><span style=\"background-color:#efefef\">&gt;</span>\r\n                <span style=\"background-color:#efefef\">&lt;</span><strong>option </strong><strong>selected</strong><span style=\"background-color:#efefef\">&gt;</span>Package<span style=\"background-color:#efefef\">&lt;/</span><strong>option</strong><span style=\"background-color:#efefef\">&gt;</span>\r\n                <span style=\"background-color:#efefef\">&lt;</span><strong>option</strong><span style=\"background-color:#efefef\">&gt;</span>Blog<span style=\"background-color:#efefef\">&lt;/</span><strong>option</strong><span style=\"background-color:#efefef\">&gt;</span>\r\n                <span style=\"background-color:#efefef\">&lt;</span><strong>option</strong><span style=\"background-color:#efefef\">&gt;</span>Service<span style=\"background-color:#efefef\">&lt;/</span><strong>option</strong><span style=\"background-color:#efefef\">&gt;</span>\r\n                <span style=\"background-color:#efefef\">&lt;</span><strong>option</strong><span style=\"background-color:#efefef\">&gt;</span>Case<span style=\"background-color:#efefef\">&lt;/</span><strong>option</strong><span style=\"background-color:#efefef\">&gt;</span>\r\n            <span style=\"background-color:#efefef\">&lt;/</span><strong>select</strong><span style=\"background-color:#efefef\">&gt;</span>\r\n        <span style=\"background-color:#efefef\">&lt;/</span><strong>div</strong><span style=\"background-color:#efefef\">&gt;</span>\r\n        <span style=\"background-color:#efefef\">&lt;</span><strong>input </strong><strong>id=</strong><strong>&quot;search_text&quot; </strong><strong>type=</strong><strong>&quot;search&quot; </strong><strong>placeholder=</strong><strong>&quot;Search...&quot; </strong><strong>autocomplete=</strong><strong>&quot;off&quot;</strong><span style=\"background-color:#efefef\">&gt;</span>\r\n        <span style=\"background-color:#efefef\">&lt;</span><strong>button </strong><strong>id=</strong><strong>&quot;searchbtn&quot;</strong><span style=\"background-color:#efefef\">&gt;&lt;</span><strong>i </strong><strong>class=</strong><strong>&quot;fa fa-search&quot;</strong><span style=\"background-color:#efefef\">&gt;&lt;/</span><strong>i</strong><span style=\"background-color:#efefef\">&gt;&lt;/</span><strong>button</strong><span style=\"background-color:#efefef\">&gt;</span>\r\n        <span style=\"background-color:#efefef\">&lt;</span><strong>div </strong><strong>class=</strong><strong>&quot;search-list-wrap&quot;</strong><span style=\"background-color:#efefef\">&gt;</span>\r\n        <span style=\"background-color:#efefef\">&lt;/</span><strong>div</strong><span style=\"background-color:#efefef\">&gt;</span>\r\n    <span style=\"background-color:#efefef\">&lt;/</span><strong>div</strong><span style=\"background-color:#efefef\">&gt;</span>\r\n<span style=\"background-color:#efefef\">&lt;/</span><strong>div</strong><span style=\"background-color:#efefef\">&gt;</span>\r\n<span style=\"background-color:#efefef\">&lt;</span><strong>form </strong><strong>id=</strong><strong>&quot;loginForm1&quot; </strong><strong>method=</strong><strong>&quot;post&quot; </strong><strong>action=</strong><strong>&quot;</strong><span style=\"background-color:#f7faff\">{{ url(</span><strong>&#39;/login&#39;</strong><span style=\"background-color:#f7faff\">) }}</span><strong>&quot;\r\n</strong><strong>      </strong><strong>class=</strong><strong>&quot;login-form-wraper smAuthHide smAuthForm </strong><span style=\"background-color:#f7faff\">{{ SM::</span><em>current_controller</em><span style=\"background-color:#f7faff\">()==</span><strong>&quot;LoginController&quot; </strong><span style=\"background-color:#f7faff\">&amp;&amp; SM::</span><em>current_method</em><span style=\"background-color:#f7faff\">()==</span><strong>&quot;index&quot; </strong><span style=\"background-color:#f7faff\">? </span><strong>&#39; active&#39; </strong><span style=\"background-color:#f7faff\">: </span><strong>&#39;&#39; </strong><span style=\"background-color:#f7faff\">}}</span><strong>&quot;\r\n</strong><strong>      </strong><strong>style=</strong><strong>&quot;</strong><strong>display</strong>: <span style=\"background-color:#f7faff\">{{ !</span><span style=\"background-color:#f7faff; color:#660000\">$authCheck </span><span style=\"background-color:#f7faff\">&amp;&amp; SM::</span><em>current_controller</em><span style=\"background-color:#f7faff\">()==</span><strong>&quot;LoginController&quot; </strong><span style=\"background-color:#f7faff\">&amp;&amp; SM::</span><em>current_method</em><span style=\"background-color:#f7faff\">()==</span><strong>&quot;index&quot; </strong><span style=\"background-color:#f7faff\">? </span><strong>&#39;block&#39; </strong><span style=\"background-color:#f7faff\">: </span><strong>&#39;none&#39; </strong><span style=\"background-color:#f7faff\">}}</span><strong>&quot;</strong><span style=\"background-color:#efefef\">&gt;</span>\r\n   <strong>&lt;?php\r\n</strong><strong>   </strong><span style=\"background-color:#f7faff; color:#660000\">$isLoginController </span><span style=\"background-color:#f7faff\">= SM::</span><em>current_controller</em><span style=\"background-color:#f7faff\">() == </span><strong>&quot;LoginController&quot; </strong><span style=\"background-color:#f7faff\">? </span><strong>true </strong><span style=\"background-color:#f7faff\">: </span><strong>false</strong><span style=\"background-color:#f7faff\">;\r\n</span><span style=\"background-color:#f7faff\">   </span><strong>?&gt;\r\n</strong><strong>    </strong><span style=\"background-color:#f7faff\">{!! csrf_field() !!}\r\n</span><span style=\"background-color:#f7faff\">    </span><span style=\"background-color:#efefef\">&lt;</span><strong>div </strong><strong>class=</strong><strong>&quot;commom-form login-form-new&quot;</strong><span style=\"background-color:#efefef\">&gt;</span>\r\n        <span style=\"background-color:#efefef\">&lt;</span><strong>div </strong><strong>class=</strong><strong>&quot;login-form-new-inner&quot;</strong><span style=\"background-color:#efefef\">&gt;</span>\r\n            <span style=\"background-color:#efefef\">&lt;</span><strong>a </strong><strong>href=</strong><strong>&quot;#&quot; </strong><strong>class=</strong><strong>&quot;close-icon&quot;</strong><span style=\"background-color:#efefef\">&gt;&lt;</span><strong>i </strong><strong>class=</strong><strong>&quot;fa fa-times-circle&quot;</strong><span style=\"background-color:#efefef\">&gt;&lt;/</span><strong>i</strong><span style=\"background-color:#efefef\">&gt;&lt;/</span><strong>a</strong><span style=\"background-color:#efefef\">&gt;</span>\r\n            <span style=\"background-color:#efefef\">&lt;</span><strong>div </strong><strong>class=</strong><strong>&quot;row&quot;</strong><span style=\"background-color:#efefef\">&gt;</span>\r\n                <span style=\"background-color:#efefef\">&lt;</span><strong>div </strong><strong>class=</strong><strong>&quot;col-sm-6&quot;</strong><span style=\"background-color:#efefef\">&gt;</span>\r\n                    <span style=\"background-color:#efefef\">&lt;</span><strong>div </strong><strong>class=</strong><strong>&quot;reg-customers&quot;</strong><span style=\"background-color:#efefef\">&gt;</span>\r\n                        <strong>@include(</strong><strong>&#39;common.login_fields&#39;</strong><strong>)\r\n</strong><strong>                    </strong><span style=\"background-color:#efefef\">&lt;/</span><strong>div</strong><span style=\"background-color:#efefef\">&gt;</span>\r\n                <span style=\"background-color:#efefef\">&lt;/</span><strong>div</strong><span style=\"background-color:#efefef\">&gt;</span>\r\n                <span style=\"background-color:#efefef\">&lt;</span><strong>div </strong><strong>class=</strong><strong>&quot;col-sm-6&quot;</strong><span style=\"background-color:#efefef\">&gt;</span>\r\n                    <span style=\"background-color:#efefef\">&lt;</span><strong>div </strong><strong>class=</strong><strong>&quot;new-customers clearfix&quot;</strong><span style=\"background-color:#efefef\">&gt;</span>\r\n                        <span style=\"background-color:#efefef\">&lt;</span><strong>h3</strong><span style=\"background-color:#efefef\">&gt;</span>New Customers<span style=\"background-color:#efefef\">&lt;/</span><strong>h3</strong><span style=\"background-color:#efefef\">&gt;</span>\r\n                        <span style=\"background-color:#efefef\">&lt;</span><strong>p</strong><span style=\"background-color:#efefef\">&gt;</span>Create an account with Doodle Digital, and more exciting things await you upon signing up. What are you waiting for? It&rsquo;s easy and rewarding.<span style=\"background-color:#efefef\">&lt;/</span><strong>p</strong><span style=\"background-color:#efefef\">&gt;</span>\r\n                        <span style=\"background-color:#efefef\">&lt;</span><strong>div </strong><strong>class=</strong><strong>&quot;form-button pull-right&quot;</strong><span style=\"background-color:#efefef\">&gt;</span>\r\n                            <span style=\"background-color:#efefef\">&lt;</span><strong>span</strong><span style=\"background-color:#efefef\">&gt;&lt;/</span><strong>span</strong><span style=\"background-color:#efefef\">&gt;&lt;</span><strong>b</strong><span style=\"background-color:#efefef\">&gt;&lt;/</span><strong>b</strong><span style=\"background-color:#efefef\">&gt;</span>\r\n                            <span style=\"background-color:#efefef\">&lt;</span><strong>input </strong><strong>class=</strong><strong>&quot;signUpFormShow&quot; </strong><strong>type=</strong><strong>&quot;submit&quot; </strong><strong>value=</strong><strong>&quot;Join Now&quot;</strong><span style=\"background-color:#efefef\">&gt;</span>\r\n                        <span style=\"background-color:#efefef\">&lt;/</span><strong>div</strong><span style=\"background-color:#efefef\">&gt;</span>\r\n                    <span style=\"background-color:#efefef\">&lt;/</span><strong>div</strong><span style=\"background-color:#efefef\">&gt;</span>\r\n                <span style=\"background-color:#efefef\">&lt;/</span><strong>div</strong><span style=\"background-color:#efefef\">&gt;</span>\r\n            <span style=\"background-color:#efefef\">&lt;/</span><strong>div</strong><span style=\"background-color:#efefef\">&gt;</span>\r\n        <span style=\"background-color:#efefef\">&lt;/</span><strong>div</strong><span style=\"background-color:#efefef\">&gt;</span>\r\n    <span style=\"background-color:#efefef\">&lt;/</span><strong>div</strong><span style=\"background-color:#efefef\">&gt;</span>\r\n<span style=\"background-color:#efefef\">&lt;/</span><strong>form</strong><span style=\"background-color:#efefef\">&gt;</span>\r\n\r\n<span style=\"background-color:#efefef\">&lt;</span><strong>form </strong><strong>method=</strong><strong>&quot;post&quot; </strong><strong>action=</strong><strong>&quot;</strong><span style=\"background-color:#f7faff\">{{ url(</span><strong>&#39;/login&#39;</strong><span style=\"background-color:#f7faff\">) }}</span><strong>&quot; </strong><strong>class=</strong><strong>&quot;guest-form-wraper smAuthHide smAuthForm&quot; </strong><strong>id=</strong><strong>&quot;guestForm&quot;\r\n</strong><strong>      </strong><strong>style=</strong><strong>&quot;</strong><strong>display</strong>: <strong>none</strong><strong>&quot;</strong><span style=\"background-color:#efefef\">&gt;</span>\r\n    <span style=\"background-color:#efefef\">&lt;</span><strong>div </strong><strong>class=</strong><strong>&quot;commom-form login-form-new&quot;</strong><span style=\"background-color:#efefef\">&gt;</span>\r\n        <span style=\"background-color:#efefef\">&lt;</span><strong>div </strong><strong>class=</strong><strong>&quot;login-form-new-inner&quot;</strong><span style=\"background-color:#efefef\">&gt;</span>\r\n            <span style=\"background-color:#efefef\">&lt;</span><strong>a </strong><strong>href=</strong><strong>&quot;#&quot; </strong><strong>class=</strong><strong>&quot;close-icon&quot;</strong><span style=\"background-color:#efefef\">&gt;&lt;</span><strong>i </strong><strong>class=</strong><strong>&quot;fa fa-times-circle&quot;</strong><span style=\"background-color:#efefef\">&gt;&lt;/</span><strong>i</strong><span style=\"background-color:#efefef\">&gt;&lt;/</span><strong>a</strong><span style=\"background-color:#efefef\">&gt;</span>\r\n            <span style=\"background-color:#efefef\">&lt;</span><strong>div </strong><strong>class=</strong><strong>&quot;row&quot;</strong><span style=\"background-color:#efefef\">&gt;</span>\r\n                <span style=\"background-color:#efefef\">&lt;</span><strong>div </strong><strong>class=</strong><strong>&quot;col-md-6&quot;</strong><span style=\"background-color:#efefef\">&gt;</span>\r\n                    <span style=\"background-color:#f7faff\">{!! csrf_field() !!}\r\n</span><span style=\"background-color:#f7faff\">                    </span><strong>@include(</strong><strong>&#39;common.login_fields&#39;</strong><strong>)\r\n</strong><strong>                </strong><span style=\"background-color:#efefef\">&lt;/</span><strong>div</strong><span style=\"background-color:#efefef\">&gt;</span>\r\n                <span style=\"background-color:#efefef\">&lt;</span><strong>div </strong><strong>class=</strong><strong>&quot;col-md-6&quot;</strong><span style=\"background-color:#efefef\">&gt;</span>\r\n                    <span style=\"background-color:#efefef\">&lt;</span><strong>div </strong><strong>class=</strong><strong>&quot;or-separator&quot;</strong><span style=\"background-color:#efefef\">&gt;</span>\r\n                        <span style=\"background-color:#efefef\">&lt;</span><strong>p</strong><span style=\"background-color:#efefef\">&gt;</span>OR<span style=\"background-color:#efefef\">&lt;/</span><strong>p</strong><span style=\"background-color:#efefef\">&gt;</span>\r\n                    <span style=\"background-color:#efefef\">&lt;/</span><strong>div</strong><span style=\"background-color:#efefef\">&gt;</span>\r\n                    <span style=\"background-color:#efefef\">&lt;</span><strong>div </strong><strong>class=</strong><strong>&quot;reg-customers&quot;</strong><span style=\"background-color:#efefef\">&gt;</span>\r\n                        <span style=\"background-color:#efefef\">&lt;</span><strong>div </strong><strong>class=</strong><strong>&quot;guest-login-here&quot;</strong><span style=\"background-color:#efefef\">&gt;</span>\r\n                            <span style=\"background-color:#efefef\">&lt;</span><strong>div </strong><strong>class=</strong><strong>&quot;form-button inline&quot;</strong><span style=\"background-color:#efefef\">&gt;</span>\r\n                                <span style=\"background-color:#efefef\">&lt;</span><strong>span</strong><span style=\"background-color:#efefef\">&gt;&lt;/</span><strong>span</strong><span style=\"background-color:#efefef\">&gt;&lt;</span><strong>b</strong><span style=\"background-color:#efefef\">&gt;&lt;/</span><strong>b</strong><span style=\"background-color:#efefef\">&gt;</span>\r\n                                <span style=\"background-color:#efefef\">&lt;</span><strong>button </strong><strong>class=</strong><strong>&quot;guestLogin&quot;</strong><span style=\"background-color:#efefef\">&gt;</span>Continue as a Guest<span style=\"background-color:#efefef\">&lt;/</span><strong>button</strong><span style=\"background-color:#efefef\">&gt;</span>\r\n                            <span style=\"background-color:#efefef\">&lt;/</span><strong>div</strong><span style=\"background-color:#efefef\">&gt;</span>\r\n                            <span style=\"background-color:#efefef\">&lt;</span><strong>br</strong><span style=\"background-color:#efefef\">&gt;</span>\r\n                            <span style=\"background-color:#efefef\">&lt;</span><strong>p</strong><span style=\"background-color:#efefef\">&gt;</span>You,ll have the option to register for an account after your purchase.<span style=\"background-color:#efefef\">&lt;/</span><strong>p</strong><span style=\"background-color:#efefef\">&gt;</span>\r\n\r\n                            <span style=\"background-color:#efefef\">&lt;</span><strong>div </strong><strong>class=</strong><strong>&quot;login-socail-form&quot;</strong><span style=\"background-color:#efefef\">&gt;</span>\r\n                                <span style=\"background-color:#efefef\">&lt;</span><strong>div </strong><strong>class=</strong><strong>&quot;form-button inline&quot;</strong><span style=\"background-color:#efefef\">&gt;</span>\r\n                                    <span style=\"background-color:#efefef\">&lt;</span><strong>span</strong><span style=\"background-color:#efefef\">&gt;&lt;/</span><strong>span</strong><span style=\"background-color:#efefef\">&gt;&lt;</span><strong>b</strong><span style=\"background-color:#efefef\">&gt;&lt;/</span><strong>b</strong><span style=\"background-color:#efefef\">&gt;</span>\r\n                                    <span style=\"background-color:#efefef\">&lt;</span><strong>button </strong><strong>class=</strong><strong>&quot;signUpFormShow guestSignUp&quot;</strong><span style=\"background-color:#efefef\">&gt;</span>Signup Now<span style=\"background-color:#efefef\">&lt;/</span><strong>button</strong><span style=\"background-color:#efefef\">&gt;</span>\r\n                                <span style=\"background-color:#efefef\">&lt;/</span><strong>div</strong><span style=\"background-color:#efefef\">&gt;</span>\r\n                            <span style=\"background-color:#efefef\">&lt;/</span><strong>div</strong><span style=\"background-color:#efefef\">&gt;</span>\r\n                        <span style=\"background-color:#efefef\">&lt;/</span><strong>div</strong><span style=\"background-color:#efefef\">&gt;</span>\r\n\r\n\r\n                    <span style=\"background-color:#efefef\">&lt;/</span><strong>div</strong><span style=\"background-color:#efefef\">&gt;</span>\r\n                <span style=\"background-color:#efefef\">&lt;/</span><strong>div</strong><span style=\"background-color:#efefef\">&gt;</span>\r\n            <span style=\"background-color:#efefef\">&lt;/</span><strong>div</strong><span style=\"background-color:#efefef\">&gt;</span>\r\n        <span style=\"background-color:#efefef\">&lt;/</span><strong>div</strong><span style=\"background-color:#efefef\">&gt;</span>\r\n    <span style=\"background-color:#efefef\">&lt;/</span><strong>div</strong><span style=\"background-color:#efefef\">&gt;</span>\r\n<span style=\"background-color:#efefef\">&lt;/</span><strong>form</strong><span style=\"background-color:#efefef\">&gt;</span>\r\n\r\n\r\n<span style=\"background-color:#efefef\">&lt;</span><strong>form </strong><strong>method=</strong><strong>&quot;post&quot; </strong><strong>action=</strong><strong>&quot;</strong><span style=\"background-color:#f7faff\">{{ url(</span><strong>&#39;/password/reset&#39;</strong><span style=\"background-color:#f7faff\">) }}</span><strong>&quot; </strong><strong>id=</strong><strong>&quot;forgotPassword&quot;\r\n</strong><strong>      </strong><strong>class=</strong><strong>&quot;forgot-form-wraper  smAuthHide smAuthForm </strong><span style=\"background-color:#f7faff\">{{ !</span><span style=\"background-color:#f7faff; color:#660000\">$authCheck </span><span style=\"background-color:#f7faff\">&amp;&amp; SM::</span><em>current_controller</em><span style=\"background-color:#f7faff\">()==</span><strong>&quot;ForgotPassword&quot; </strong><span style=\"background-color:#f7faff\">&amp;&amp; SM::</span><em>current_method</em><span style=\"background-color:#f7faff\">()==</span><strong>&quot;index&quot; </strong><span style=\"background-color:#f7faff\">? </span><strong>&#39; active&#39; </strong><span style=\"background-color:#f7faff\">: </span><strong>&#39;&#39; </strong><span style=\"background-color:#f7faff\">}}</span><strong>&quot;\r\n</strong><strong>      </strong><strong>style=</strong><strong>&quot;</strong><strong>display</strong>: <span style=\"background-color:#f7faff\">{{ SM::</span><em>current_controller</em><span style=\"background-color:#f7faff\">()==</span><strong>&quot;ForgotPassword&quot; </strong><span style=\"background-color:#f7faff\">&amp;&amp; SM::</span><em>current_method</em><span style=\"background-color:#f7faff\">()==</span><strong>&quot;index&quot; </strong><span style=\"background-color:#f7faff\">? </span><strong>&#39;block&#39; </strong><span style=\"background-color:#f7faff\">: </span><strong>&#39;none&#39; </strong><span style=\"background-color:#f7faff\">}}</span><strong>&quot;</strong><span style=\"background-color:#efefef\">&gt;</span>\r\n    <span style=\"background-color:#f7faff\">{!! csrf_field() !!}\r\n</span><span style=\"background-color:#f7faff\">   </span><strong>&lt;?php\r\n</strong><strong>   </strong><span style=\"background-color:#f7faff; color:#660000\">$isForgotPassword </span><span style=\"background-color:#f7faff\">= SM::</span><em>current_controller</em><span style=\"background-color:#f7faff\">() == </span><strong>&quot;ForgotPassword&quot; </strong><span style=\"background-color:#f7faff\">? </span><strong>true </strong><span style=\"background-color:#f7faff\">: </span><strong>false</strong><span style=\"background-color:#f7faff\">;\r\n</span><span style=\"background-color:#f7faff\">   </span><strong>?&gt;\r\n</strong><strong>    </strong><span style=\"background-color:#efefef\">&lt;</span><strong>div </strong><strong>class=</strong><strong>&quot;commom-form login-form-new&quot;</strong><span style=\"background-color:#efefef\">&gt;</span>\r\n        <span style=\"background-color:#efefef\">&lt;</span><strong>div </strong><strong>class=</strong><strong>&quot;login-form-new-inner&quot;</strong><span style=\"background-color:#efefef\">&gt;</span>\r\n            <span style=\"background-color:#efefef\">&lt;</span><strong>a </strong><strong>href=</strong><strong>&quot;#&quot; </strong><strong>class=</strong><strong>&quot;close-icon&quot;</strong><span style=\"background-color:#efefef\">&gt;&lt;</span><strong>i </strong><strong>class=</strong><strong>&quot;fa fa-times-circle&quot;</strong><span style=\"background-color:#efefef\">&gt;&lt;/</span><strong>i</strong><span style=\"background-color:#efefef\">&gt;&lt;/</span><strong>a</strong><span style=\"background-color:#efefef\">&gt;</span>\r\n            <span style=\"background-color:#efefef\">&lt;</span><strong>div </strong><strong>class=</strong><strong>&quot;row&quot;</strong><span style=\"background-color:#efefef\">&gt;</span>\r\n                <span style=\"background-color:#efefef\">&lt;</span><strong>div </strong><strong>class=</strong><strong>&quot;col-lg-12&quot;</strong><span style=\"background-color:#efefef\">&gt;</span>\r\n                    <span style=\"background-color:#efefef\">&lt;</span><strong>h3</strong><span style=\"background-color:#efefef\">&gt;</span>Forgot Your Password<span style=\"background-color:#efefef\">&lt;/</span><strong>h3</strong><span style=\"background-color:#efefef\">&gt;</span>\r\n                    <span style=\"background-color:#efefef\">&lt;</span><strong>p</strong><span style=\"background-color:#efefef\">&gt;</span>Can&rsquo;t remember your log in details? Don&rsquo;t worry. Follow these simple steps and get your access to our site back in a moment.<span style=\"background-color:#efefef\">&lt;/</span><strong>p</strong><span style=\"background-color:#efefef\">&gt;</span>\r\n                    <span style=\"background-color:#efefef\">&lt;</span><strong>div </strong><strong>class=</strong><strong>&quot;form-input&quot;</strong><span style=\"background-color:#efefef\">&gt;</span>\r\n                        <span style=\"background-color:#efefef\">&lt;</span><strong>label </strong><strong>for=</strong><strong>&quot;forgot-email&quot;</strong><span style=\"background-color:#efefef\">&gt;</span>Email Address<span style=\"background-color:#efefef\">&lt;</span><strong>span</strong><span style=\"background-color:#efefef\">&gt;</span>*<span style=\"background-color:#efefef\">&lt;/</span><strong>span</strong><span style=\"background-color:#efefef\">&gt;&lt;/</span><strong>label</strong><span style=\"background-color:#efefef\">&gt;</span>\r\n                        <span style=\"background-color:#f7faff\">{!! Form::</span><em>email</em><span style=\"background-color:#f7faff\">(</span><strong>&quot;email&quot;</strong><span style=\"background-color:#f7faff\">,  </span><strong>null</strong><span style=\"background-color:#f7faff\">, [</span><strong>&quot;id&quot;</strong><span style=\"background-color:#f7faff\">=&gt;</span><strong>&quot;forgot-email&quot;</strong><span style=\"background-color:#f7faff\">]) !!}\r\n</span><span style=\"background-color:#f7faff\">                        </span><span style=\"background-color:#efefef\">&lt;</span><strong>span </strong><strong>class=</strong><strong>&quot;error-notice&quot;</strong><span style=\"background-color:#efefef\">&gt;&lt;/</span><strong>span</strong><span style=\"background-color:#efefef\">&gt;</span>\r\n                    <span style=\"background-color:#efefef\">&lt;/</span><strong>div</strong><span style=\"background-color:#efefef\">&gt;</span>\r\n                    <span style=\"background-color:#efefef\">&lt;</span><strong>div </strong><strong>class=</strong><strong>&quot;clearfix&quot;</strong><span style=\"background-color:#efefef\">&gt;</span>\r\n                        <span style=\"background-color:#efefef\">&lt;</span><strong>div </strong><strong>class=</strong><strong>&quot;form-button pull-left&quot;</strong><span style=\"background-color:#efefef\">&gt;</span>\r\n                            <span style=\"background-color:#efefef\">&lt;</span><strong>span</strong><span style=\"background-color:#efefef\">&gt;&lt;/</span><strong>span</strong><span style=\"background-color:#efefef\">&gt;&lt;</span><strong>b</strong><span style=\"background-color:#efefef\">&gt;&lt;/</span><strong>b</strong><span style=\"background-color:#efefef\">&gt;</span>\r\n                            <span style=\"background-color:#efefef\">&lt;</span><strong>input </strong><strong>type=</strong><strong>&quot;submit&quot; </strong><strong>value=</strong><strong>&quot;Forgot Password&quot;</strong><span style=\"background-color:#efefef\">&gt;</span>\r\n                        <span style=\"background-color:#efefef\">&lt;/</span><strong>div</strong><span style=\"background-color:#efefef\">&gt;</span>\r\n                    <span style=\"background-color:#efefef\">&lt;/</span><strong>div</strong><span style=\"background-color:#efefef\">&gt;</span>\r\n                    <span style=\"background-color:#efefef\">&lt;</span><strong>div </strong><strong>class=</strong><strong>&quot;clearfix&quot;</strong><span style=\"background-color:#efefef\">&gt;</span>\r\n                        <span style=\"background-color:#efefef\">&lt;</span><strong>span </strong><strong>class=</strong><strong>&quot;success-notice&quot;</strong><span style=\"background-color:#efefef\">&gt;&lt;/</span><strong>span</strong><span style=\"background-color:#efefef\">&gt;</span>\r\n                    <span style=\"background-color:#efefef\">&lt;/</span><strong>div</strong><span style=\"background-color:#efefef\">&gt;</span>\r\n                <span style=\"background-color:#efefef\">&lt;/</span><strong>div</strong><span style=\"background-color:#efefef\">&gt;</span>\r\n            <span style=\"background-color:#efefef\">&lt;/</span><strong>div</strong><span style=\"background-color:#efefef\">&gt;</span>\r\n        <span style=\"background-color:#efefef\">&lt;/</span><strong>div</strong><span style=\"background-color:#efefef\">&gt;</span>\r\n    <span style=\"background-color:#efefef\">&lt;/</span><strong>div</strong><span style=\"background-color:#efefef\">&gt;</span>\r\n<span style=\"background-color:#efefef\">&lt;/</span><strong>form</strong><span style=\"background-color:#efefef\">&gt;</span>\r\n<strong>@if(</strong><span style=\"background-color:#f7faff\">SM::</span><em>current_method</em><span style=\"background-color:#f7faff\">()==</span><strong>&quot;showResetForm&quot;</strong><strong>)\r\n</strong>\r\n<strong>    </strong><span style=\"background-color:#efefef\">&lt;</span><strong>div\r\n</strong><strong>            </strong><strong>class=</strong><strong>&quot;singup-form-wraper  smAuthHide&quot;\r\n</strong><strong>            </strong><strong>style=</strong><strong>&quot;</strong><strong>display</strong>: <strong>block</strong><strong>&quot;</strong><span style=\"background-color:#efefef\">&gt;</span>\r\n        <span style=\"background-color:#efefef\">&lt;</span><strong>div </strong><strong>class=</strong><strong>&quot;commom-form login-form-new&quot;</strong><span style=\"background-color:#efefef\">&gt;</span>\r\n            <span style=\"background-color:#efefef\">&lt;</span><strong>div </strong><strong>class=</strong><strong>&quot;login-form-new-inner&quot;</strong><span style=\"background-color:#efefef\">&gt;</span>\r\n                <span style=\"background-color:#efefef\">&lt;</span><strong>a </strong><strong>href=</strong><strong>&quot;#&quot; </strong><strong>class=</strong><strong>&quot;close-icon&quot;</strong><span style=\"background-color:#efefef\">&gt;&lt;</span><strong>i </strong><strong>class=</strong><strong>&quot;fa fa-times-circle&quot;</strong><span style=\"background-color:#efefef\">&gt;&lt;/</span><strong>i</strong><span style=\"background-color:#efefef\">&gt;&lt;/</span><strong>a</strong><span style=\"background-color:#efefef\">&gt;</span>\r\n                <span style=\"background-color:#efefef\">&lt;</span><strong>div </strong><strong>class=</strong><strong>&quot;row&quot;</strong><span style=\"background-color:#efefef\">&gt;</span>\r\n                    <span style=\"background-color:#efefef\">&lt;</span><strong>div </strong><strong>class=</strong><strong>&quot;col-md-6&quot;</strong><span style=\"background-color:#efefef\">&gt;</span>\r\n                        <span style=\"background-color:#efefef\">&lt;</span><strong>form </strong><strong>method=</strong><strong>&quot;post&quot; </strong><strong>class=</strong><strong>&quot;smAuthForm&quot; </strong><strong>id=</strong><strong>&quot;resetPassword&quot;\r\n</strong><strong>                              </strong><strong>action=</strong><strong>&quot;</strong><span style=\"background-color:#f7faff\">{{ url(</span><strong>&#39;/password/update&#39;</strong><span style=\"background-color:#f7faff\">) }}</span><strong>&quot;</strong><span style=\"background-color:#efefef\">&gt;</span>\r\n                            <span style=\"background-color:#f7faff\">{!! csrf_field() !!}\r\n</span><span style=\"background-color:#f7faff\">                     </span><strong>&lt;?php\r\n</strong><strong>                     </strong><span style=\"background-color:#f7faff; color:#660000\">$isshowResetForm </span><span style=\"background-color:#f7faff\">= SM::</span><em>current_method</em><span style=\"background-color:#f7faff\">() == </span><strong>&quot;showResetForm&quot; </strong><span style=\"background-color:#f7faff\">? </span><strong>true </strong><span style=\"background-color:#f7faff\">: </span><strong>false</strong><span style=\"background-color:#f7faff\">;\r\n</span><span style=\"background-color:#f7faff\">                     </span><strong>?&gt;\r\n</strong><strong>                            </strong><span style=\"background-color:#efefef\">&lt;</span><strong>h3</strong><span style=\"background-color:#efefef\">&gt;</span>Reset Password Form<span style=\"background-color:#efefef\">&lt;/</span><strong>h3</strong><span style=\"background-color:#efefef\">&gt;</span>\r\n                            <span style=\"background-color:#efefef\">&lt;</span><strong>div </strong><strong>class=</strong><strong>&quot;form-input&quot;</strong><span style=\"background-color:#efefef\">&gt;</span>\r\n                                <span style=\"background-color:#efefef\">&lt;</span><strong>input </strong><strong>type=</strong><strong>&quot;hidden&quot; </strong><strong>name=</strong><strong>&quot;token&quot; </strong><strong>value=</strong><strong>&quot;</strong><span style=\"background-color:#f7faff\">{{</span><span style=\"background-color:#f7faff; color:#660000\">$token</span><span style=\"background-color:#f7faff\">}}</span><strong>&quot;</strong><span style=\"background-color:#efefef\">&gt;</span>\r\n                                <span style=\"background-color:#efefef\">&lt;</span><strong>label </strong><strong>for=</strong><strong>&quot;email&quot;</strong><span style=\"background-color:#efefef\">&gt;</span>Email Address<span style=\"background-color:#efefef\">&lt;</span><strong>span</strong><span style=\"background-color:#efefef\">&gt;</span>*<span style=\"background-color:#efefef\">&lt;/</span><strong>span</strong><span style=\"background-color:#efefef\">&gt;&lt;/</span><strong>label</strong><span style=\"background-color:#efefef\">&gt;</span>\r\n                                <span style=\"background-color:#f7faff\">{!! Form::</span><em>email</em><span style=\"background-color:#f7faff\">(</span><strong>&quot;email&quot;</strong><span style=\"background-color:#f7faff\">,  </span><strong>null</strong><span style=\"background-color:#f7faff\">, [</span><strong>&quot;id&quot;</strong><span style=\"background-color:#f7faff\">=&gt;</span><strong>&quot;email&quot;</strong><span style=\"background-color:#f7faff\">]) !!}\r\n</span><span style=\"background-color:#f7faff\">                                </span><span style=\"background-color:#efefef\">&lt;</span><strong>span </strong><strong>class=</strong><strong>&quot;error-notice&quot;</strong><span style=\"background-color:#efefef\">&gt;&lt;/</span><strong>span</strong><span style=\"background-color:#efefef\">&gt;</span>\r\n                            <span style=\"background-color:#efefef\">&lt;/</span><strong>div</strong><span style=\"background-color:#efefef\">&gt;</span>\r\n                            <span style=\"background-color:#efefef\">&lt;</span><strong>div </strong><strong>class=</strong><strong>&quot;form-input&quot;</strong><span style=\"background-color:#efefef\">&gt;</span>\r\n                                <span style=\"background-color:#efefef\">&lt;</span><strong>label </strong><strong>for=</strong><strong>&quot;password&quot;</strong><span style=\"background-color:#efefef\">&gt;</span>Password<span style=\"background-color:#efefef\">&lt;</span><strong>span</strong><span style=\"background-color:#efefef\">&gt;</span>*<span style=\"background-color:#efefef\">&lt;/</span><strong>span</strong><span style=\"background-color:#efefef\">&gt;&lt;/</span><strong>label</strong><span style=\"background-color:#efefef\">&gt;</span>\r\n                                <span style=\"background-color:#efefef\">&lt;</span><strong>input </strong><strong>name=</strong><strong>&quot;password&quot; </strong><strong>id=</strong><strong>&quot;password&quot; </strong><strong>type=</strong><strong>&quot;password&quot;</strong><span style=\"background-color:#efefef\">&gt;</span>\r\n                                <span style=\"background-color:#efefef\">&lt;</span><strong>span </strong><strong>class=</strong><strong>&quot;error-notice&quot;</strong><span style=\"background-color:#efefef\">&gt;&lt;/</span><strong>span</strong><span style=\"background-color:#efefef\">&gt;</span>\r\n                            <span style=\"background-color:#efefef\">&lt;/</span><strong>div</strong><span style=\"background-color:#efefef\">&gt;</span>\r\n\r\n                            <span style=\"background-color:#efefef\">&lt;</span><strong>div </strong><strong>class=</strong><strong>&quot;form-input&quot;</strong><span style=\"background-color:#efefef\">&gt;</span>\r\n                                <span style=\"background-color:#efefef\">&lt;</span><strong>label </strong><strong>for=</strong><strong>&quot;password_confirmation&quot;</strong><span style=\"background-color:#efefef\">&gt;</span>Confirmation Password<span style=\"background-color:#efefef\">&lt;</span><strong>span</strong><span style=\"background-color:#efefef\">&gt;</span>*<span style=\"background-color:#efefef\">&lt;/</span><strong>span</strong><span style=\"background-color:#efefef\">&gt;&lt;/</span><strong>label</strong><span style=\"background-color:#efefef\">&gt;</span>\r\n                                <span style=\"background-color:#efefef\">&lt;</span><strong>input </strong><strong>name=</strong><strong>&quot;password_confirmation&quot; </strong><strong>id=</strong><strong>&quot;password_confirmation&quot; </strong><strong>type=</strong><strong>&quot;password&quot;</strong><span style=\"background-color:#efefef\">&gt;</span>\r\n                                <span style=\"background-color:#efefef\">&lt;</span><strong>span </strong><strong>class=</strong><strong>&quot;error-notice&quot;</strong><span style=\"background-color:#efefef\">&gt;&lt;/</span><strong>span</strong><span style=\"background-color:#efefef\">&gt;</span>\r\n                            <span style=\"background-color:#efefef\">&lt;/</span><strong>div</strong><span style=\"background-color:#efefef\">&gt;</span>\r\n                            <span style=\"background-color:#efefef\">&lt;</span><strong>div </strong><strong>class=</strong><strong>&quot;clearfix&quot;</strong><span style=\"background-color:#efefef\">&gt;</span>\r\n                                <span style=\"background-color:#efefef\">&lt;</span><strong>div </strong><strong>class=</strong><strong>&quot;form-button pull-left&quot;</strong><span style=\"background-color:#efefef\">&gt;</span>\r\n                                    <span style=\"background-color:#efefef\">&lt;</span><strong>span</strong><span style=\"background-color:#efefef\">&gt;&lt;/</span><strong>span</strong><span style=\"background-color:#efefef\">&gt;&lt;</span><strong>b</strong><span style=\"background-color:#efefef\">&gt;&lt;/</span><strong>b</strong><span style=\"background-color:#efefef\">&gt;</span>\r\n                                    <span style=\"background-color:#efefef\">&lt;</span><strong>input </strong><strong>type=</strong><strong>&quot;submit&quot; </strong><strong>value=</strong><strong>&quot;Reset Now&quot;</strong><span style=\"background-color:#efefef\">&gt;</span>\r\n                                <span style=\"background-color:#efefef\">&lt;/</span><strong>div</strong><span style=\"background-color:#efefef\">&gt;</span>\r\n                            <span style=\"background-color:#efefef\">&lt;/</span><strong>div</strong><span style=\"background-color:#efefef\">&gt;</span>\r\n                        <span style=\"background-color:#efefef\">&lt;/</span><strong>form</strong><span style=\"background-color:#efefef\">&gt;</span>\r\n                    <span style=\"background-color:#efefef\">&lt;/</span><strong>div</strong><span style=\"background-color:#efefef\">&gt;</span>\r\n                    <span style=\"background-color:#efefef\">&lt;</span><strong>div </strong><strong>class=</strong><strong>&quot;col-md-6&quot;</strong><span style=\"background-color:#efefef\">&gt;</span>\r\n                        <span style=\"background-color:#efefef\">&lt;</span><strong>form </strong><strong>method=</strong><strong>&quot;post&quot; </strong><strong>class=</strong><strong>&quot;smAuthForm&quot; </strong><strong>id=</strong><strong>&quot;loginForm2&quot; </strong><strong>action=</strong><strong>&quot;</strong><span style=\"background-color:#f7faff\">{{ url(</span><strong>&#39;/login&#39;</strong><span style=\"background-color:#f7faff\">) }}</span><strong>&quot;</strong><span style=\"background-color:#efefef\">&gt;</span>\r\n                            <span style=\"background-color:#f7faff\">{!! csrf_field() !!}\r\n</span><span style=\"background-color:#f7faff\">                            </span><span style=\"background-color:#efefef\">&lt;</span><strong>div </strong><strong>class=</strong><strong>&quot;reg-customers hidden-xs hidden-sm&quot;</strong><span style=\"background-color:#efefef\">&gt;</span>\r\n                                <strong>@include(</strong><strong>&#39;common.login_fields&#39;</strong><strong>)\r\n</strong><strong>                            </strong><span style=\"background-color:#efefef\">&lt;/</span><strong>div</strong><span style=\"background-color:#efefef\">&gt;</span>\r\n                        <span style=\"background-color:#efefef\">&lt;/</span><strong>form</strong><span style=\"background-color:#efefef\">&gt;</span>\r\n                    <span style=\"background-color:#efefef\">&lt;/</span><strong>div</strong><span style=\"background-color:#efefef\">&gt;</span>\r\n                <span style=\"background-color:#efefef\">&lt;/</span><strong>div</strong><span style=\"background-color:#efefef\">&gt;</span>\r\n            <span style=\"background-color:#efefef\">&lt;/</span><strong>div</strong><span style=\"background-color:#efefef\">&gt;</span>\r\n        <span style=\"background-color:#efefef\">&lt;/</span><strong>div</strong><span style=\"background-color:#efefef\">&gt;</span>\r\n    <span style=\"background-color:#efefef\">&lt;/</span><strong>div</strong><span style=\"background-color:#efefef\">&gt;</span>\r\n<strong>@endif\r\n</strong><span style=\"background-color:#efefef\">&lt;</span><strong>div\r\n</strong><strong>        </strong><strong>class=</strong><strong>&quot;singup-form-wraper smAuthHide </strong><span style=\"background-color:#f7faff\">{{ (SM::</span><em>current_controller</em><span style=\"background-color:#f7faff\">()==</span><strong>&quot;RegisterController&quot;\r\n</strong><strong>        </strong><span style=\"background-color:#f7faff\">&amp;&amp; SM::</span><em>current_method</em><span style=\"background-color:#f7faff\">()==</span><strong>&quot;index&quot;</strong><span style=\"background-color:#f7faff\">) ? </span><strong>&#39; active&#39; </strong><span style=\"background-color:#f7faff\">: </span><strong>&#39;&#39; </strong><span style=\"background-color:#f7faff\">}}</span><strong>&quot;\r\n</strong><strong>        </strong><strong>style=</strong><strong>&quot;</strong><strong>display</strong>: <span style=\"background-color:#f7faff\">{{ !</span><span style=\"background-color:#f7faff; color:#660000\">$authCheck </span><span style=\"background-color:#f7faff\">&amp;&amp; (\r\n</span><span style=\"background-color:#f7faff\">      request()-&gt;</span><strong>isAuthRegistration </strong><span style=\"background-color:#f7faff\">==</span><span style=\"background-color:#f7faff; color:#0000ff\">1 </span><span style=\"background-color:#f7faff\">||\r\n</span><span style=\"background-color:#f7faff\">      (SM::</span><em>current_controller</em><span style=\"background-color:#f7faff\">() == </span><strong>&quot;RegisterController&quot; </strong><span style=\"background-color:#f7faff\">&amp;&amp; SM::</span><em>current_method</em><span style=\"background-color:#f7faff\">() == </span><strong>&quot;index&quot; </strong><span style=\"background-color:#f7faff\">)\r\n</span><span style=\"background-color:#f7faff\">        ) ? </span><strong>&#39;block&#39; </strong><span style=\"background-color:#f7faff\">: </span><strong>&#39;none&#39; </strong><span style=\"background-color:#f7faff\">}}</span><strong>&quot;</strong><span style=\"background-color:#efefef\">&gt;</span>\r\n    <span style=\"background-color:#efefef\">&lt;</span><strong>div </strong><strong>class=</strong><strong>&quot;commom-form login-form-new&quot;</strong><span style=\"background-color:#efefef\">&gt;</span>\r\n        <span style=\"background-color:#efefef\">&lt;</span><strong>div </strong><strong>class=</strong><strong>&quot;login-form-new-inner&quot;</strong><span style=\"background-color:#efefef\">&gt;</span>\r\n            <span style=\"background-color:#efefef\">&lt;</span><strong>a </strong><strong>href=</strong><strong>&quot;#&quot; </strong><strong>class=</strong><strong>&quot;close-icon&quot;</strong><span style=\"background-color:#efefef\">&gt;&lt;</span><strong>i </strong><strong>class=</strong><strong>&quot;fa fa-times-circle&quot;</strong><span style=\"background-color:#efefef\">&gt;&lt;/</span><strong>i</strong><span style=\"background-color:#efefef\">&gt;&lt;/</span><strong>a</strong><span style=\"background-color:#efefef\">&gt;</span>\r\n            <span style=\"background-color:#efefef\">&lt;</span><strong>div </strong><strong>class=</strong><strong>&quot;row&quot;</strong><span style=\"background-color:#efefef\">&gt;</span>\r\n                <span style=\"background-color:#efefef\">&lt;</span><strong>div </strong><strong>class=</strong><strong>&quot;col-sm-12&quot;</strong><span style=\"background-color:#efefef\">&gt;</span>\r\n                    <strong>@if(</strong><span style=\"background-color:#f7faff\">Session::</span><em>has</em><span style=\"background-color:#f7faff\">(</span><strong>&quot;socialAuthSuccessMessage&quot;</strong><span style=\"background-color:#f7faff\">)</span><strong>)\r\n</strong><strong>                        </strong><span style=\"background-color:#efefef\">&lt;</span><strong>div </strong><strong>class=</strong><strong>&quot;alert alert-success&quot;</strong><span style=\"background-color:#efefef\">&gt;</span>\r\n                            <span style=\"background-color:#f7faff\">{{ session( </span><strong>&#39;socialAuthSuccessMessage&#39; </strong><span style=\"background-color:#f7faff\">) }}\r\n</span><span style=\"background-color:#f7faff\">                     </span><strong>&lt;?php\r\n</strong><strong>                     </strong><span style=\"background-color:#f7faff\">Session::</span><em>forget</em><span style=\"background-color:#f7faff\">( </span><strong>&quot;socialAuthSuccessMessage&quot; </strong><span style=\"background-color:#f7faff\">);\r\n</span><span style=\"background-color:#f7faff\">                     Session::</span><em>save</em><span style=\"background-color:#f7faff\">();\r\n</span><span style=\"background-color:#f7faff\">                     </span><strong>?&gt;\r\n</strong><strong>                        </strong><span style=\"background-color:#efefef\">&lt;/</span><strong>div</strong><span style=\"background-color:#efefef\">&gt;</span>\r\n                    <strong>@endif\r\n</strong><strong>                    @if(</strong><span style=\"background-color:#f7faff\">Session::</span><em>has</em><span style=\"background-color:#f7faff\">(</span><strong>&quot;socialAuthWarningMessage&quot;</strong><span style=\"background-color:#f7faff\">)</span><strong>)\r\n</strong><strong>                        </strong><span style=\"background-color:#efefef\">&lt;</span><strong>div </strong><strong>class=</strong><strong>&quot;alert alert-warning&quot;</strong><span style=\"background-color:#efefef\">&gt;</span>\r\n                            <span style=\"background-color:#f7faff\">{{ session( </span><strong>&#39;socialAuthWarningMessage&#39; </strong><span style=\"background-color:#f7faff\">) }}\r\n</span><span style=\"background-color:#f7faff\">                     </span><strong>&lt;?php\r\n</strong><strong>                     </strong><span style=\"background-color:#f7faff\">Session::</span><em>forget</em><span style=\"background-color:#f7faff\">( </span><strong>&quot;socialAuthWarningMessage&quot; </strong><span style=\"background-color:#f7faff\">);\r\n</span><span style=\"background-color:#f7faff\">                     Session::</span><em>save</em><span style=\"background-color:#f7faff\">();\r\n</span><span style=\"background-color:#f7faff\">                     </span><strong>?&gt;\r\n</strong><strong>                        </strong><span style=\"background-color:#efefef\">&lt;/</span><strong>div</strong><span style=\"background-color:#efefef\">&gt;</span>\r\n                    <strong>@endif\r\n</strong><strong>                </strong><span style=\"background-color:#efefef\">&lt;/</span><strong>div</strong><span style=\"background-color:#efefef\">&gt;</span>\r\n                <span style=\"background-color:#efefef\">&lt;</span><strong>div </strong><strong>class=</strong><strong>&quot;col-md-6&quot;</strong><span style=\"background-color:#efefef\">&gt;</span>\r\n                    <span style=\"background-color:#efefef\">&lt;</span><strong>form </strong><strong>method=</strong><strong>&quot;post&quot; </strong><strong>id=</strong><strong>&quot;registrationForm&quot; </strong><strong>class=</strong><strong>&quot;smAuthForm&quot; </strong><strong>action=</strong><strong>&quot;</strong><span style=\"background-color:#f7faff\">{{ url(</span><strong>&#39;/register&#39;</strong><span style=\"background-color:#f7faff\">) }}</span><strong>&quot;</strong><span style=\"background-color:#efefef\">&gt;</span>\r\n                        <span style=\"background-color:#f7faff\">{!! csrf_field() !!}\r\n</span><span style=\"background-color:#f7faff\">                        </span><span style=\"background-color:#efefef\">&lt;</span><strong>h3</strong><span style=\"background-color:#efefef\">&gt;</span>Create an Account<span style=\"background-color:#efefef\">&lt;/</span><strong>h3</strong><span style=\"background-color:#efefef\">&gt;</span>\r\n                        <span style=\"background-color:#efefef\">&lt;</span><strong>p</strong><span style=\"background-color:#efefef\">&gt;</span>Please provide the details in the required fields. Your information is safe with us! <span style=\"background-color:#efefef\">&lt;/</span><strong>p</strong><span style=\"background-color:#efefef\">&gt;</span>\r\n                        <span style=\"background-color:#efefef\">&lt;</span><strong>div </strong><strong>class=</strong><strong>&quot;form-input&quot;</strong><span style=\"background-color:#efefef\">&gt;</span>\r\n                            <span style=\"background-color:#efefef\">&lt;</span><strong>label </strong><strong>for=</strong><strong>&quot;username&quot;</strong><span style=\"background-color:#efefef\">&gt;</span>Username<span style=\"background-color:#efefef\">&lt;</span><strong>span</strong><span style=\"background-color:#efefef\">&gt;</span>*<span style=\"background-color:#efefef\">&lt;/</span><strong>span</strong><span style=\"background-color:#efefef\">&gt;&lt;/</span><strong>label</strong><span style=\"background-color:#efefef\">&gt;</span>\r\n                            <span style=\"background-color:#f7faff\">{!! Form::</span><em>text</em><span style=\"background-color:#f7faff\">(</span><strong>&quot;username&quot;</strong><span style=\"background-color:#f7faff\">,  </span><strong>null</strong><span style=\"background-color:#f7faff\">, [</span><strong>&quot;id&quot;</strong><span style=\"background-color:#f7faff\">=&gt;</span><strong>&quot;username&quot;</strong><span style=\"background-color:#f7faff\">]) !!}\r\n</span><span style=\"background-color:#f7faff\">                            </span><span style=\"background-color:#efefef\">&lt;</span><strong>span </strong><strong>class=</strong><strong>&quot;error-notice&quot;</strong><span style=\"background-color:#efefef\">&gt;&lt;/</span><strong>span</strong><span style=\"background-color:#efefef\">&gt;</span>\r\n                        <span style=\"background-color:#efefef\">&lt;/</span><strong>div</strong><span style=\"background-color:#efefef\">&gt;</span>\r\n                  <strong>&lt;?php\r\n</strong><strong>                  if </strong><span style=\"background-color:#f7faff\">( Session::</span><em>has</em><span style=\"background-color:#f7faff\">( </span><strong>&quot;profile&quot; </strong><span style=\"background-color:#f7faff\">) &amp;&amp; </span><em>count</em><span style=\"background-color:#f7faff\">( Session::</span><em>get</em><span style=\"background-color:#f7faff\">( </span><strong>&quot;profile&quot; </strong><span style=\"background-color:#f7faff\">) ) &gt; </span><span style=\"background-color:#f7faff; color:#0000ff\">0\r\n</span><span style=\"background-color:#f7faff; color:#0000ff\">                       </span><span style=\"background-color:#f7faff\">&amp;&amp; </span><strong>isset</strong><span style=\"background-color:#f7faff\">( Session::</span><em>get</em><span style=\"background-color:#f7faff\">( </span><strong>&quot;profile&quot; </strong><span style=\"background-color:#f7faff\">)-&gt;</span><strong>email </strong><span style=\"background-color:#f7faff\">) &amp;&amp; Session::</span><em>get</em><span style=\"background-color:#f7faff\">( </span><strong>&quot;profile&quot; </strong><span style=\"background-color:#f7faff\">)-&gt;</span><strong>email </strong><span style=\"background-color:#f7faff\">!= </span><strong>&#39;&#39; </strong><span style=\"background-color:#f7faff\">) {\r\n</span><span style=\"background-color:#f7faff\">                     </span><span style=\"background-color:#f7faff; color:#660000\">$profile </span><span style=\"background-color:#f7faff\">= Session::</span><em>get</em><span style=\"background-color:#f7faff\">( </span><strong>&quot;profile&quot; </strong><span style=\"background-color:#f7faff\">);\r\n</span><span style=\"background-color:#f7faff\">                     </span><span style=\"background-color:#f7faff; color:#660000\">$email   </span><span style=\"background-color:#f7faff\">= </span><span style=\"background-color:#f7faff; color:#660000\">$profile</span><span style=\"background-color:#f7faff\">-&gt;</span><strong>email</strong><span style=\"background-color:#f7faff\">;\r\n</span><span style=\"background-color:#f7faff\">                     </span><span style=\"background-color:#f7faff; color:#660000\">$extra   </span><span style=\"background-color:#f7faff\">= [ </span><strong>&quot;id&quot; </strong><span style=\"background-color:#f7faff\">=&gt; </span><strong>&quot;email&quot;</strong><span style=\"background-color:#f7faff\">, </span><strong>&quot;readonly&quot; </strong><span style=\"background-color:#f7faff\">=&gt; </span><strong>&quot;&quot; </strong><span style=\"background-color:#f7faff\">];\r\n</span><span style=\"background-color:#f7faff\">                  } </span><strong>else </strong><span style=\"background-color:#f7faff\">{\r\n</span><span style=\"background-color:#f7faff\">                     </span><span style=\"background-color:#f7faff; color:#660000\">$email </span><span style=\"background-color:#f7faff\">= </span><strong>null</strong><span style=\"background-color:#f7faff\">;\r\n</span><span style=\"background-color:#f7faff\">                     </span><span style=\"background-color:#f7faff; color:#660000\">$extra </span><span style=\"background-color:#f7faff\">= [ </span><strong>&quot;id&quot; </strong><span style=\"background-color:#f7faff\">=&gt; </span><strong>&quot;email&quot; </strong><span style=\"background-color:#f7faff\">];\r\n</span><span style=\"background-color:#f7faff\">                  }\r\n</span><span style=\"background-color:#f7faff\">                  </span><strong>?&gt;\r\n</strong><strong>                        </strong><span style=\"background-color:#efefef\">&lt;</span><strong>div </strong><strong>class=</strong><strong>&quot;form-input&quot;</strong><span style=\"background-color:#efefef\">&gt;</span>\r\n                            <span style=\"background-color:#efefef\">&lt;</span><strong>label </strong><strong>for=</strong><strong>&quot;email&quot;</strong><span style=\"background-color:#efefef\">&gt;</span>Email Address<span style=\"background-color:#efefef\">&lt;</span><strong>span</strong><span style=\"background-color:#efefef\">&gt;</span>*<span style=\"background-color:#efefef\">&lt;/</span><strong>span</strong><span style=\"background-color:#efefef\">&gt;&lt;/</span><strong>label</strong><span style=\"background-color:#efefef\">&gt;</span>\r\n                            <span style=\"background-color:#f7faff\">{!! Form::</span><em>email</em><span style=\"background-color:#f7faff\">(</span><strong>&quot;email&quot;</strong><span style=\"background-color:#f7faff\">,  </span><span style=\"background-color:#f7faff; color:#660000\">$email</span><span style=\"background-color:#f7faff\">, </span><span style=\"background-color:#f7faff; color:#660000\">$extra</span><span style=\"background-color:#f7faff\">) !!}\r\n</span><span style=\"background-color:#f7faff\">                            </span><span style=\"background-color:#efefef\">&lt;</span><strong>span </strong><strong>class=</strong><strong>&quot;error-notice&quot;</strong><span style=\"background-color:#efefef\">&gt;&lt;/</span><strong>span</strong><span style=\"background-color:#efefef\">&gt;</span>\r\n                        <span style=\"background-color:#efefef\">&lt;/</span><strong>div</strong><span style=\"background-color:#efefef\">&gt;</span>\r\n                        <span style=\"background-color:#efefef\">&lt;</span><strong>div </strong><strong>class=</strong><strong>&quot;form-input&quot;</strong><span style=\"background-color:#efefef\">&gt;</span>\r\n                            <span style=\"background-color:#efefef\">&lt;</span><strong>label </strong><strong>for=</strong><strong>&quot;password&quot;</strong><span style=\"background-color:#efefef\">&gt;</span>Password<span style=\"background-color:#efefef\">&lt;</span><strong>span</strong><span style=\"background-color:#efefef\">&gt;</span>*<span style=\"background-color:#efefef\">&lt;/</span><strong>span</strong><span style=\"background-color:#efefef\">&gt;&lt;/</span><strong>label</strong><span style=\"background-color:#efefef\">&gt;</span>\r\n                            <span style=\"background-color:#efefef\">&lt;</span><strong>input </strong><strong>name=</strong><strong>&quot;password&quot; </strong><strong>id=</strong><strong>&quot;password&quot; </strong><strong>type=</strong><strong>&quot;password&quot;</strong><span style=\"background-color:#efefef\">&gt;</span>\r\n                            <span style=\"background-color:#efefef\">&lt;</span><strong>span </strong><strong>class=</strong><strong>&quot;error-notice&quot;</strong><span style=\"background-color:#efefef\">&gt;&lt;/</span><strong>span</strong><span style=\"background-color:#efefef\">&gt;</span>\r\n                        <span style=\"background-color:#efefef\">&lt;/</span><strong>div</strong><span style=\"background-color:#efefef\">&gt;</span>\r\n\r\n                        <span style=\"background-color:#efefef\">&lt;</span><strong>div </strong><strong>class=</strong><strong>&quot;form-input&quot;</strong><span style=\"background-color:#efefef\">&gt;</span>\r\n                            <span style=\"background-color:#efefef\">&lt;</span><strong>label </strong><strong>for=</strong><strong>&quot;password_confirmation&quot;</strong><span style=\"background-color:#efefef\">&gt;</span>Confirmation Password<span style=\"background-color:#efefef\">&lt;</span><strong>span</strong><span style=\"background-color:#efefef\">&gt;</span>*<span style=\"background-color:#efefef\">&lt;/</span><strong>span</strong><span style=\"background-color:#efefef\">&gt;&lt;/</span><strong>label</strong><span style=\"background-color:#efefef\">&gt;</span>\r\n                            <span style=\"background-color:#efefef\">&lt;</span><strong>input </strong><strong>name=</strong><strong>&quot;password_confirmation&quot; </strong><strong>id=</strong><strong>&quot;password_confirmation&quot; </strong><strong>type=</strong><strong>&quot;password&quot;</strong><span style=\"background-color:#efefef\">&gt;</span>\r\n                            <span style=\"background-color:#efefef\">&lt;</span><strong>span </strong><strong>class=</strong><strong>&quot;error-notice&quot;</strong><span style=\"background-color:#efefef\">&gt;&lt;/</span><strong>span</strong><span style=\"background-color:#efefef\">&gt;</span>\r\n                        <span style=\"background-color:#efefef\">&lt;/</span><strong>div</strong><span style=\"background-color:#efefef\">&gt;</span>\r\n                        <span style=\"background-color:#efefef\">&lt;</span><strong>div </strong><strong>class=</strong><strong>&quot;clearfix&quot;</strong><span style=\"background-color:#efefef\">&gt;</span>\r\n                            <span style=\"background-color:#efefef\">&lt;</span><strong>div </strong><strong>class=</strong><strong>&quot;form-button pull-left&quot;</strong><span style=\"background-color:#efefef\">&gt;</span>\r\n                                <span style=\"background-color:#efefef\">&lt;</span><strong>span</strong><span style=\"background-color:#efefef\">&gt;&lt;/</span><strong>span</strong><span style=\"background-color:#efefef\">&gt;&lt;</span><strong>b</strong><span style=\"background-color:#efefef\">&gt;&lt;/</span><strong>b</strong><span style=\"background-color:#efefef\">&gt;</span>\r\n                                <span style=\"background-color:#efefef\">&lt;</span><strong>input </strong><strong>type=</strong><strong>&quot;submit&quot; </strong><strong>value=</strong><strong>&quot;Signup Now&quot;</strong><span style=\"background-color:#efefef\">&gt;</span>\r\n                            <span style=\"background-color:#efefef\">&lt;/</span><strong>div</strong><span style=\"background-color:#efefef\">&gt;</span>\r\n                        <span style=\"background-color:#efefef\">&lt;/</span><strong>div</strong><span style=\"background-color:#efefef\">&gt;</span>\r\n                        <strong>@include(</strong><strong>&quot;common.register_social&quot;</strong><strong>)\r\n</strong><strong>                    </strong><span style=\"background-color:#efefef\">&lt;/</span><strong>form</strong><span style=\"background-color:#efefef\">&gt;</span>\r\n                <span style=\"background-color:#efefef\">&lt;/</span><strong>div</strong><span style=\"background-color:#efefef\">&gt;</span>\r\n                <span style=\"background-color:#efefef\">&lt;</span><strong>div </strong><strong>class=</strong><strong>&quot;col-md-6&quot;</strong><span style=\"background-color:#efefef\">&gt;</span>\r\n                    <span style=\"background-color:#efefef\">&lt;</span><strong>form </strong><strong>method=</strong><strong>&quot;post&quot; </strong><strong>class=</strong><strong>&quot;smAuthForm&quot; </strong><strong>action=</strong><strong>&quot;</strong><span style=\"background-color:#f7faff\">{{ url(</span><strong>&#39;/login&#39;</strong><span style=\"background-color:#f7faff\">) }}</span><strong>&quot; </strong><strong>id=</strong><strong>&quot;loginForm3&quot;</strong><span style=\"background-color:#efefef\">&gt;</span>\r\n                        <span style=\"background-color:#f7faff\">{!! csrf_field() !!}\r\n</span><span style=\"background-color:#f7faff\">                        </span><span style=\"background-color:#efefef\">&lt;</span><strong>div </strong><strong>class=</strong><strong>&quot;reg-customers hidden-xs hidden-sm&quot;</strong><span style=\"background-color:#efefef\">&gt;</span>\r\n                            <strong>@include(</strong><strong>&#39;common.login_fields&#39;</strong><strong>)\r\n</strong><strong>                        </strong><span style=\"background-color:#efefef\">&lt;/</span><strong>div</strong><span style=\"background-color:#efefef\">&gt;</span>\r\n                    <span style=\"background-color:#efefef\">&lt;/</span><strong>form</strong><span style=\"background-color:#efefef\">&gt;</span>\r\n                <span style=\"background-color:#efefef\">&lt;/</span><strong>div</strong><span style=\"background-color:#efefef\">&gt;</span>\r\n            <span style=\"background-color:#efefef\">&lt;/</span><strong>div</strong><span style=\"background-color:#efefef\">&gt;</span>\r\n        <span style=\"background-color:#efefef\">&lt;/</span><strong>div</strong><span style=\"background-color:#efefef\">&gt;</span>\r\n    <span style=\"background-color:#efefef\">&lt;/</span><strong>div</strong><span style=\"background-color:#efefef\">&gt;</span>\r\n<span style=\"background-color:#efefef\">&lt;/</span><strong>div</strong><span style=\"background-color:#efefef\">&gt;</span>\r\n</pre>', 'privacy-policy', NULL, 9, NULL, NULL, NULL, 1, NULL, 1, '2019-04-24 13:10:27', '2019-04-25 03:49:30');

-- --------------------------------------------------------

--
-- Table structure for table `password_resets`
--

CREATE TABLE `password_resets` (
  `email` varchar(191) NOT NULL,
  `token` varchar(191) NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

-- --------------------------------------------------------

--
-- Table structure for table `payments`
--

CREATE TABLE `payments` (
  `id` int(10) UNSIGNED NOT NULL,
  `order_id` int(10) UNSIGNED NOT NULL,
  `payment_method_id` int(10) UNSIGNED NOT NULL,
  `paid` double(10,2) NOT NULL,
  `transaction_id` text,
  `return_url` text,
  `status` tinyint(4) NOT NULL DEFAULT '2' COMMENT '1=Completed, 2=Pending, 3=cancel',
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

-- --------------------------------------------------------

--
-- Table structure for table `payment_methods`
--

CREATE TABLE `payment_methods` (
  `id` int(10) UNSIGNED NOT NULL,
  `title` varchar(191) NOT NULL,
  `description` text,
  `image` text,
  `type` tinyint(3) UNSIGNED NOT NULL DEFAULT '1' COMMENT '1=Offline and 2 = Online Without Card and 3 = Online With Card',
  `mode` varchar(50) DEFAULT 'sandbox' COMMENT 'sandbox=Demo and live = Live',
  `api_key` varchar(191) DEFAULT NULL,
  `api_secret` varchar(191) DEFAULT NULL,
  `created_by` int(10) UNSIGNED NOT NULL,
  `modified_by` int(10) UNSIGNED DEFAULT NULL,
  `status` tinyint(4) NOT NULL DEFAULT '2' COMMENT '1=Completed, 2=Pending, 3=cancel',
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Dumping data for table `payment_methods`
--

INSERT INTO `payment_methods` (`id`, `title`, `description`, `image`, `type`, `mode`, `api_key`, `api_secret`, `created_by`, `modified_by`, `status`, `created_at`, `updated_at`) VALUES
(1, 'Visa', NULL, 'trademark-visa.jpg', 1, 'sandbox', NULL, NULL, 1, NULL, 3, '2019-04-18 10:44:33', '2019-04-21 04:47:06'),
(2, 'Master Card', NULL, 'trademark-mc.jpg', 1, 'sandbox', NULL, NULL, 1, NULL, 3, '2019-04-18 10:44:58', '2019-04-21 04:47:02'),
(3, 'Cash on Delivery', NULL, NULL, 1, 'sandbox', NULL, NULL, 1, NULL, 1, '2019-04-20 04:46:55', '2019-04-30 05:17:40'),
(4, 'SSL Commerce.', NULL, NULL, 1, 'sandbox', NULL, NULL, 1, NULL, 1, '2019-04-20 04:47:13', '2019-04-20 04:47:13'),
(5, 'Paypal', NULL, NULL, 1, 'sandbox', NULL, NULL, 1, NULL, 3, '2019-04-21 04:36:24', '2019-04-21 04:46:51');

-- --------------------------------------------------------

--
-- Table structure for table `products`
--

CREATE TABLE `products` (
  `id` int(10) UNSIGNED NOT NULL,
  `title` varchar(100) NOT NULL,
  `short_description` text,
  `long_description` longtext,
  `image` text,
  `slug` varchar(191) NOT NULL,
  `sku` varchar(191) NOT NULL,
  `stock_status` varchar(191) DEFAULT NULL,
  `tax_class` varchar(191) DEFAULT NULL,
  `regular_price` decimal(10,2) NOT NULL DEFAULT '0.00',
  `sale_price` decimal(10,2) NOT NULL DEFAULT '0.00',
  `brand_id` int(10) UNSIGNED DEFAULT NULL,
  `product_qty` varchar(191) DEFAULT NULL,
  `alert_quantity` varchar(191) DEFAULT NULL,
  `product_weight` varchar(191) DEFAULT NULL,
  `product_model` varchar(191) DEFAULT NULL,
  `product_type` int(11) NOT NULL,
  `unit_id` int(10) UNSIGNED DEFAULT NULL,
  `image_gallery` text,
  `views` int(10) UNSIGNED NOT NULL DEFAULT '0',
  `seo_title` varchar(191) DEFAULT NULL,
  `meta_key` text,
  `meta_description` text,
  `created_by` int(10) UNSIGNED DEFAULT NULL,
  `modified_by` int(10) UNSIGNED DEFAULT NULL,
  `status` tinyint(4) NOT NULL DEFAULT '2' COMMENT '1=active, 2=pending, 3=cancel',
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Dumping data for table `products`
--

INSERT INTO `products` (`id`, `title`, `short_description`, `long_description`, `image`, `slug`, `sku`, `stock_status`, `tax_class`, `regular_price`, `sale_price`, `brand_id`, `product_qty`, `alert_quantity`, `product_weight`, `product_model`, `product_type`, `unit_id`, `image_gallery`, `views`, `seo_title`, `meta_key`, `meta_description`, `created_by`, `modified_by`, `status`, `created_at`, `updated_at`) VALUES
(1, 'BU-W-T3PC-3-1549', NULL, '<p>Maroon self work sequins georgette kameez with maroon tassel attached on the front. Comes with grey satin flare pants and self work sequins georgette dupatta</p>\r\n\r\n<p><strong>Fabric Material</strong></p>\r\n\r\n<p>Self work sequins georgette&nbsp; satin pants</p>', 'img_1227.jpg', 'bu-w-t3pc-3-1549', 'B01591', 'in_stock', NULL, '2850.00', '0.00', 1, '5', '2', NULL, NULL, 2, 1, 'img_1231.jpg,img_1229.jpg,img_1227.jpg', 86, NULL, NULL, NULL, 1, 1, 1, '2019-04-18 11:24:45', '2019-05-02 12:19:37'),
(2, 'BU-W-LT-3-1127', NULL, '<p>Navy blue crepe georgette and stripe top with asymmetric sleeves.</p>', 'img_1274.jpg', 'bu-w-lt-3-1127', 'B01227', 'in_stock', NULL, '1950.00', '0.00', 1, NULL, NULL, NULL, NULL, 2, 1, 'img_1279.jpg,img_1275.jpg,img_1274.jpg', 15, NULL, NULL, NULL, 1, 1, 1, '2019-04-18 11:53:19', '2019-05-02 00:39:25'),
(3, 'BU-W-TST-3-1651', NULL, '<p>Lemon all over printed top with black tassel</p>', 'img_1075.jpg', 'bu-w-tst-3-1651', 'B01628', 'in_stock', NULL, '1550.00', '0.00', 1, NULL, NULL, NULL, NULL, 2, 1, 'img_1079.jpg,img_1077.jpg,img_1075.jpg', 12, NULL, NULL, NULL, 1, 1, 1, '2019-04-18 12:04:58', '2019-04-24 06:56:17'),
(4, 'BU-W-ST-2-1646', NULL, '<p>Light pastel green top with embroidery on the side. Long frill bell sleeves.</p>', 'img_1056.jpg', 'bu-w-st-2-1646', 'B01627', 'in_stock', NULL, '1850.00', '0.00', 1, '4', '2', NULL, NULL, 2, 1, 'img_1061.jpg,img_1059.jpg,img_1056.jpg', 39, NULL, NULL, NULL, 1, 1, 1, '2019-04-20 07:16:20', '2019-05-01 03:54:50'),
(5, 'BU-W-ST-5-1655', NULL, '<p>Purple all over printed shirt georgette shirt with frill on the front</p>', 'img_1085.jpg', 'bu-w-st-5-1655', 'B01629', 'in_stock', NULL, '1650.00', '0.00', 1, '4', NULL, NULL, NULL, 2, 1, 'img_1085.jpg,img_1083.jpg,img_1081.jpg', 8, NULL, NULL, NULL, 1, NULL, 1, '2019-04-20 08:07:05', '2019-05-15 05:18:28'),
(6, 'BU-W-MT-5-1300', NULL, '<p>Navy blue color mid top with white embroidery work on front</p>', 'img_1138.jpg', 'bu-w-mt-5-1300', 'B01290', 'in_stock', NULL, '2250.00', '0.00', 1, '12', NULL, NULL, NULL, 2, 1, 'img_1138.jpg,img_1137.jpg,img_1132.jpg', 3, NULL, NULL, NULL, 1, 1, 1, '2019-04-20 08:09:07', '2019-04-29 10:29:01'),
(7, 'BU-W-MT-5-1568', NULL, '<p>Navy blue mid top with silver lace &amp; Embroidered buttons</p>', 'img_1140.jpg', 'bu-w-mt-5-1568', 'B01551', 'in_stock', NULL, '2150.00', '0.00', 1, '6', NULL, NULL, NULL, 2, 1, 'img_1147.jpg,img_1143.jpg,img_1140.jpg', 11, NULL, NULL, NULL, 1, NULL, 1, '2019-04-20 08:39:51', '2019-04-24 08:33:48'),
(8, 'BU-W-MT-5-1446', NULL, '<p>Sky color mid top with white pearl karchupi on front with self fabric design</p>', 'img_1152.jpg', 'bu-w-mt-5-1446', 'B01457', 'in_stock', NULL, '2650.00', '0.00', 1, '9', NULL, NULL, NULL, 2, 1, 'img_1153.jpg,img_1152.jpg,img_1150.jpg', 1, NULL, NULL, NULL, 1, NULL, 1, '2019-04-20 08:48:31', '2019-04-20 08:48:39'),
(9, 'BU-W-MT-5-1381', NULL, '<p>Purple color mid top with golden karchupi work on the front</p>', 'img_1156.jpg', 'bu-w-mt-5-1381', 'B01372', 'in_stock', NULL, '2250.00', '0.00', 1, '5', NULL, NULL, NULL, 2, 1, 'img_1161.jpg,img_1159.jpg,img_1156.jpg', 0, NULL, NULL, NULL, 1, NULL, 1, '2019-04-20 08:54:55', '2019-04-20 08:54:55'),
(10, 'BU-W-MT-5-1256', NULL, '<p>Black &amp; white printed mid top with black Embroidery</p>', 'img_1169.jpg', 'bu-w-mt-5-1256', 'B01289', 'in_stock', NULL, '2650.00', '0.00', 1, '6', NULL, NULL, NULL, 2, 1, 'img_1169.jpg,img_1167.jpg,img_1164.jpg', 0, NULL, NULL, NULL, 1, NULL, 1, '2019-04-20 09:01:21', '2019-04-20 09:01:21'),
(11, 'BU-W-MT-5-1217', NULL, '<p>Olive green color mid top with black karchupi work on neckline</p>', 'img_1171.jpg', 'bu-w-mt-5-1217', 'B01219', 'in_stock', NULL, '2450.00', '0.00', 1, NULL, NULL, NULL, NULL, 2, 1, 'img_1174.jpg,img_1172.jpg,img_1171.jpg', 1, NULL, NULL, NULL, 1, NULL, 1, '2019-04-20 09:11:01', '2019-04-20 09:11:09'),
(12, 'BU-W-MT-5-1116', NULL, '<p>Black &amp; white printed top with black sequin lace</p>', 'img_1183.jpg', 'bu-w-mt-5-1116', 'B01125', 'in_stock', NULL, '2050.00', '0.00', 1, '11', NULL, NULL, NULL, 2, 1, 'img_1183.jpg,img_1181.jpg,img_1179.jpg', 1, NULL, NULL, NULL, 1, NULL, 1, '2019-04-20 09:18:27', '2019-04-24 08:30:43'),
(13, 'BU-W-MT-5-1096', NULL, '<p>Light pink color mid top with long flared sleeves silver yoke on the side</p>', 'img_1185.jpg', 'bu-w-mt-5-1096', 'B01097', 'in_stock', NULL, '2350.00', '0.00', 1, '7', NULL, NULL, NULL, 2, 1, 'img_1189.jpg,img_1187.jpg,img_1185.jpg', 0, NULL, NULL, NULL, 1, NULL, 1, '2019-04-20 09:23:38', '2019-04-20 09:23:38'),
(14, 'BU-W-K-3-1438', NULL, '<p>Navy blue georgette kaftan with frill work</p>', 'img_1198.jpg', 'bu-w-k-3-1438', 'B01431', 'in_stock', NULL, '1750.00', '0.00', 1, '7', NULL, NULL, NULL, 2, 1, 'img_1203.jpg,img_1198.jpg,img_1201.jpg', 1, NULL, NULL, NULL, 1, 1, 1, '2019-04-20 09:29:05', '2019-04-23 06:26:40'),
(15, 'BU-W-K-3-1122', NULL, '<p>Light grey color silk kaftan with sequin lace and silver yoke</p>', 'img_1208.jpg', 'bu-w-k-3-1122', 'B01141', 'in_stock', NULL, '2250.00', '0.00', 1, NULL, NULL, NULL, NULL, 2, 1, 'img_1208.jpg,img_1207.jpg,img_1204.jpg', 3, NULL, NULL, NULL, 1, NULL, 1, '2019-04-20 09:42:28', '2019-04-23 07:07:47'),
(16, 'BU-W-K-3-1121', NULL, '<p>Maroon crepe georgette kaftan with yoke and black pipe lace&nbsp;</p>', 'img_1220.jpg', 'bu-w-k-3-1121', 'B01121', 'in_stock', NULL, '2950.00', '0.00', 1, '7', NULL, NULL, NULL, 2, 1, 'img_1223.jpg,img_1222.jpg,img_1220.jpg', 10, NULL, NULL, NULL, 1, NULL, 1, '2019-04-20 09:51:25', '2019-04-21 10:25:57'),
(17, 'BU-W--K-3-1123', NULL, NULL, 'img_1231.jpg', 'bu-w-k-3-1123', 'B01122', 'in_stock', NULL, '2450.00', '0.00', 1, '4', NULL, NULL, NULL, 2, 1, 'img_1231.jpg,img_1229.jpg,img_1227.jpg', 1, NULL, NULL, NULL, 1, NULL, 1, '2019-04-20 09:56:16', '2019-04-21 03:30:53'),
(18, 'BU-W-O3PC-5-1274', NULL, '<p>Grey Color kameez with green color embroidery on both side of the shoulder. Comes with green cigarette pant and green georgette dupatta.</p>', 'img_1235.jpg', 'bu-w-o3pc-5-1274', 'B01308', 'in_stock', NULL, '2950.00', '2650.00', 1, '8', NULL, NULL, NULL, 1, 1, 'img_1239.jpg,img_1238.jpg,img_1235.jpg', 0, NULL, NULL, NULL, 1, 1, 1, '2019-04-21 10:09:33', '2019-05-09 03:36:31'),
(19, 'BU-W-K-3-1120', NULL, '<p>Navy blue crepe georgette kaftan with silver embroidery work and pipe lace&nbsp;</p>', 'img_1241.jpg', 'bu-w-k-3-1120', 'B01119', 'in_stock', NULL, '2550.00', '0.00', 1, '9', NULL, NULL, NULL, 1, 1, 'img_1246.jpg,img_1243.jpg,img_1241.jpg', 2, NULL, NULL, NULL, 1, 1, 1, '2019-04-21 10:18:14', '2019-05-09 03:36:06'),
(20, 'BU-W-TST-3-1420', NULL, '<p>Light pink and white stripe top with red piping and embroidery</p>', '14.png', 'bu-w-tst-3-1420', 'B01412', 'in_stock', NULL, '1650.00', '1400.00', 1, '6', NULL, NULL, NULL, 1, 1, '14.png', 2, NULL, NULL, NULL, 1, 1, 1, '2019-04-23 09:55:20', '2019-05-09 05:09:21'),
(21, 'BU-W-ST-2-1645', NULL, '<p>Blue cotton shirt with two flap pockets and embroidered collar.</p>', '6.png', 'bu-w-st-2-1645', 'B01626', 'in_stock', NULL, '1850.00', '0.00', 1, '5', NULL, NULL, NULL, 1, 1, '6.png', 34, NULL, NULL, NULL, 1, 1, 1, '2019-04-23 10:06:23', '2019-05-09 05:08:22'),
(22, 'BU-W-ST-2-1656', NULL, '<p>Navy blue long shirt with multi-colour embroidery.</p>', '10.png', 'bu-w-st-2-1656', 'B01630', 'in_stock', NULL, '2150.00', '0.00', 1, '7', NULL, NULL, NULL, 1, 1, '10.png', 7, NULL, NULL, NULL, 1, 1, 1, '2019-04-23 10:11:38', '2019-05-15 05:02:00'),
(23, 'BU-M-ST-2-1640', 'Red double georgette short shirt with printed collar and buttons', '<p>Red double georgette short shirt with printed collar and buttons</p>', '12.png', 'bu-m-st-2-1640', 'B01614', 'in_stock', NULL, '1750.00', '1500.00', 1, '5', NULL, NULL, NULL, 1, 1, '12.png', 4, NULL, NULL, NULL, 1, 1, 1, '2019-04-23 10:20:06', '2019-05-14 07:18:29'),
(24, 'BU-W-MD-5-1259', 'Light pink color gown with multi color hand embroidery', '<p>Light pink color gown with multi color hand embroidery</p>', '19.png', 'bu-w-md-5-1259', 'B01288', 'in_stock', NULL, '2950.00', '2200.00', 1, '6', NULL, NULL, NULL, 1, 1, '19.png,19.png', 46, NULL, NULL, NULL, 1, 1, 1, '2019-04-23 10:30:51', '2019-05-15 05:21:16'),
(25, 'BU-W-LT-3-1315', 'Light peach long top with royal blue karchupi work on the collar and side. Buttons and loop on the sleeves.', '<p>Light peach long top with royal blue karchupi work on the collar and side. Buttons and loop on the sleeves.</p>', 'bisto_chip_shop_curry_sauce_200__00696_zoom_o4y5-7p.jpg', 'bu-w-lt-3-1315', 'B01329', 'in_stock', NULL, '2550.00', '0.00', 1, '9', NULL, NULL, NULL, 1, 1, 'bisto_chip_shop_curry_sauce_200__00696_zoom_o4y5-7p.jpg,20.png', 32, NULL, NULL, NULL, 1, 1, 1, '2019-04-23 10:53:02', '2019-05-09 05:01:41'),
(26, 'BU-W-2PC-2-1269', 'Light pink cotton slub kameez with pintucks and multi colour sequins karchupi work. Comes with white all over printed cigarette pants.', '<p>Light pink cotton slub kameez with pintucks and multi colour sequins karchupi work. Comes with white all over printed cigarette pants.</p>', 'idshot_540x540.jpg', 'bu-w-2pc-2-1269', 'B01265', 'in_stock', NULL, '3050.00', '2550.00', 1, '5', NULL, NULL, NULL, 1, 1, 'idshot_540x540.jpg', 16, NULL, NULL, NULL, 1, 1, 1, '2019-04-23 11:13:17', '2019-05-14 07:28:14');

-- --------------------------------------------------------

--
-- Table structure for table `reviews`
--

CREATE TABLE `reviews` (
  `id` int(10) UNSIGNED NOT NULL,
  `user_id` int(10) UNSIGNED NOT NULL,
  `product_id` int(10) UNSIGNED NOT NULL,
  `title` varchar(191) DEFAULT NULL,
  `description` varchar(191) DEFAULT NULL,
  `rating` varchar(191) DEFAULT NULL,
  `status` tinyint(4) NOT NULL DEFAULT '2' COMMENT '1=active, 2=pending, 3=cancel',
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 ROW_FORMAT=COMPACT;

--
-- Dumping data for table `reviews`
--

INSERT INTO `reviews` (`id`, `user_id`, `product_id`, `title`, `description`, `rating`, `status`, `created_at`, `updated_at`) VALUES
(1, 2, 1, NULL, 'asdasda', 'on', 2, '2019-04-28 10:54:54', '2019-04-28 10:54:54'),
(2, 2, 1, NULL, 'asdsada', 'on', 2, '2019-04-28 10:56:21', '2019-04-28 10:56:21');

-- --------------------------------------------------------

--
-- Table structure for table `roles`
--

CREATE TABLE `roles` (
  `id` int(10) UNSIGNED NOT NULL,
  `name` varchar(100) NOT NULL,
  `permission` mediumtext NOT NULL,
  `created_by` int(10) UNSIGNED NOT NULL,
  `modified_by` int(10) UNSIGNED DEFAULT NULL,
  `status` tinyint(4) NOT NULL DEFAULT '2' COMMENT '1=active, 2=pending, 3=cancel',
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Dumping data for table `roles`
--

INSERT INTO `roles` (`id`, `name`, `permission`, `created_by`, `modified_by`, `status`, `created_at`, `updated_at`) VALUES
(1, 'Admin', '', 1, NULL, 1, NULL, NULL);

-- --------------------------------------------------------

--
-- Table structure for table `settings`
--

CREATE TABLE `settings` (
  `id` int(10) UNSIGNED NOT NULL,
  `option_name` varchar(191) NOT NULL,
  `option_value` longtext,
  `created_by` int(10) UNSIGNED DEFAULT NULL,
  `modified_by` int(10) UNSIGNED DEFAULT NULL,
  `autoload` tinyint(4) NOT NULL DEFAULT '0' COMMENT '0=No, 1=Yes',
  `status` tinyint(4) NOT NULL DEFAULT '2' COMMENT '1=active, 2=pending, 3=cancel',
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Dumping data for table `settings`
--

INSERT INTO `settings` (`id`, `option_name`, `option_value`, `created_by`, `modified_by`, `autoload`, `status`, `created_at`, `updated_at`) VALUES
(1, 'site_name', 'Bazaar Dhaka', 1, 1, 1, 1, NULL, '2019-05-06 03:20:13'),
(2, 'tag_line', 'Bazaar Dhaka', 1, 1, 1, 1, NULL, '2019-05-06 03:20:13'),
(3, 'address', 'Nekunjo-2, Dhaka', 1, 1, 1, 1, NULL, '2019-04-18 10:24:42'),
(4, 'email', 'alaminlock@gmail.com', 1, 1, 1, 1, NULL, '2019-04-29 11:16:51'),
(5, 'secondary_email', 'nextpagetl@gmail.com', 1, 1, 1, 1, NULL, '2019-04-18 10:24:42'),
(6, 'mobile', '01827624296', 1, 1, 1, 1, NULL, '2019-04-29 11:16:51'),
(7, 'logo', 'logo_2.png', 1, 1, 1, 1, NULL, '2019-05-09 08:18:14'),
(8, 'favicon', 'logo_2.png', 1, 1, 1, 1, NULL, '2019-05-09 08:18:14'),
(9, 'site_screenshot', '33', 1, 1, 1, 1, NULL, '2019-05-01 03:03:55'),
(10, 'site_meta_keywords', 'Shop, ecommerce, products, nptlshop', 1, 1, 1, 1, NULL, '2019-05-01 03:03:55'),
(11, 'site_meta_description', 'Alamin Shah online shopping in bangladesh with free home delivery. Shop online for latest electronics, mobiles, fashion apparels. ✓Cash On Delivery ✓Low Prices', 1, 1, 1, 1, NULL, '2019-05-01 03:03:55'),
(12, 'main_menu', 'a:1:{s:9:\"menu_item\";a:25:{i:1;a:8:{s:2:\"id\";s:1:\"1\";s:4:\"p_id\";s:1:\"0\";s:9:\"menu_type\";s:2:\"cl\";s:5:\"title\";s:4:\"Shop\";s:4:\"link\";s:5:\"/shop\";s:3:\"cls\";s:0:\"\";s:8:\"link_cls\";s:0:\"\";s:8:\"icon_cls\";s:0:\"\";}i:2;a:8:{s:2:\"id\";s:1:\"2\";s:4:\"p_id\";s:1:\"0\";s:9:\"menu_type\";s:10:\"category|1\";s:5:\"title\";s:5:\"WOMEN\";s:4:\"link\";s:15:\"/category/women\";s:3:\"cls\";s:0:\"\";s:8:\"link_cls\";s:0:\"\";s:8:\"icon_cls\";s:0:\"\";}i:3;a:8:{s:2:\"id\";s:1:\"3\";s:4:\"p_id\";s:1:\"2\";s:9:\"menu_type\";s:10:\"category|2\";s:5:\"title\";s:21:\"SHORT TOPS AND SHIRTS\";s:4:\"link\";s:31:\"/category/short-tops-and-shirts\";s:3:\"cls\";s:0:\"\";s:8:\"link_cls\";s:0:\"\";s:8:\"icon_cls\";s:0:\"\";}i:4;a:8:{s:2:\"id\";s:1:\"4\";s:4:\"p_id\";s:1:\"2\";s:9:\"menu_type\";s:10:\"category|3\";s:5:\"title\";s:9:\"LONG TOPS\";s:4:\"link\";s:19:\"/category/long-tops\";s:3:\"cls\";s:0:\"\";s:8:\"link_cls\";s:0:\"\";s:8:\"icon_cls\";s:0:\"\";}i:5;a:8:{s:2:\"id\";s:1:\"5\";s:4:\"p_id\";s:1:\"2\";s:9:\"menu_type\";s:10:\"category|4\";s:5:\"title\";s:13:\"MID LONG TOPS\";s:4:\"link\";s:23:\"/category/mid-long-tops\";s:3:\"cls\";s:0:\"\";s:8:\"link_cls\";s:0:\"\";s:8:\"icon_cls\";s:0:\"\";}i:6;a:8:{s:2:\"id\";s:1:\"6\";s:4:\"p_id\";s:1:\"2\";s:9:\"menu_type\";s:10:\"category|5\";s:5:\"title\";s:9:\"TWO PIECE\";s:4:\"link\";s:19:\"/category/two-piece\";s:3:\"cls\";s:0:\"\";s:8:\"link_cls\";s:0:\"\";s:8:\"icon_cls\";s:0:\"\";}i:7;a:8:{s:2:\"id\";s:1:\"7\";s:4:\"p_id\";s:1:\"2\";s:9:\"menu_type\";s:10:\"category|6\";s:5:\"title\";s:13:\"SALWAR KAMEEZ\";s:4:\"link\";s:23:\"/category/salwar-kameez\";s:3:\"cls\";s:0:\"\";s:8:\"link_cls\";s:0:\"\";s:8:\"icon_cls\";s:0:\"\";}i:8;a:8:{s:2:\"id\";s:1:\"8\";s:4:\"p_id\";s:1:\"2\";s:9:\"menu_type\";s:10:\"category|7\";s:5:\"title\";s:4:\"GOWN\";s:4:\"link\";s:14:\"/category/gown\";s:3:\"cls\";s:0:\"\";s:8:\"link_cls\";s:0:\"\";s:8:\"icon_cls\";s:0:\"\";}i:9;a:8:{s:2:\"id\";s:1:\"9\";s:4:\"p_id\";s:1:\"2\";s:9:\"menu_type\";s:10:\"category|8\";s:5:\"title\";s:11:\"LONG SHRUGS\";s:4:\"link\";s:21:\"/category/long-shrugs\";s:3:\"cls\";s:0:\"\";s:8:\"link_cls\";s:0:\"\";s:8:\"icon_cls\";s:0:\"\";}i:10;a:8:{s:2:\"id\";s:2:\"10\";s:4:\"p_id\";s:1:\"2\";s:9:\"menu_type\";s:10:\"category|9\";s:5:\"title\";s:22:\"PANTS/LEGGINGS/PALAZZO\";s:4:\"link\";s:30:\"/category/pantsleggingspalazzo\";s:3:\"cls\";s:0:\"\";s:8:\"link_cls\";s:0:\"\";s:8:\"icon_cls\";s:0:\"\";}i:11;a:8:{s:2:\"id\";s:2:\"11\";s:4:\"p_id\";s:1:\"2\";s:9:\"menu_type\";s:11:\"category|10\";s:5:\"title\";s:14:\"EID COLLECTION\";s:4:\"link\";s:24:\"/category/eid-collection\";s:3:\"cls\";s:0:\"\";s:8:\"link_cls\";s:0:\"\";s:8:\"icon_cls\";s:0:\"\";}i:12;a:8:{s:2:\"id\";s:2:\"12\";s:4:\"p_id\";s:1:\"0\";s:9:\"menu_type\";s:11:\"category|11\";s:5:\"title\";s:3:\"MEN\";s:4:\"link\";s:13:\"/category/men\";s:3:\"cls\";s:0:\"\";s:8:\"link_cls\";s:0:\"\";s:8:\"icon_cls\";s:0:\"\";}i:13;a:8:{s:2:\"id\";s:2:\"13\";s:4:\"p_id\";s:2:\"12\";s:9:\"menu_type\";s:11:\"category|12\";s:5:\"title\";s:7:\"PANJABI\";s:4:\"link\";s:17:\"/category/panjabi\";s:3:\"cls\";s:0:\"\";s:8:\"link_cls\";s:0:\"\";s:8:\"icon_cls\";s:0:\"\";}i:14;a:8:{s:2:\"id\";s:2:\"14\";s:4:\"p_id\";s:2:\"12\";s:9:\"menu_type\";s:11:\"category|13\";s:5:\"title\";s:10:\"KABLI SUIT\";s:4:\"link\";s:20:\"/category/kabli-suit\";s:3:\"cls\";s:0:\"\";s:8:\"link_cls\";s:0:\"\";s:8:\"icon_cls\";s:0:\"\";}i:15;a:8:{s:2:\"id\";s:2:\"15\";s:4:\"p_id\";s:2:\"12\";s:9:\"menu_type\";s:11:\"category|14\";s:5:\"title\";s:6:\"PAJAMA\";s:4:\"link\";s:16:\"/category/pajama\";s:3:\"cls\";s:0:\"\";s:8:\"link_cls\";s:0:\"\";s:8:\"icon_cls\";s:0:\"\";}i:16;a:8:{s:2:\"id\";s:2:\"16\";s:4:\"p_id\";s:1:\"0\";s:9:\"menu_type\";s:11:\"category|15\";s:5:\"title\";s:13:\"GRACE (WOMEN)\";s:4:\"link\";s:21:\"/category/grace-women\";s:3:\"cls\";s:0:\"\";s:8:\"link_cls\";s:0:\"\";s:8:\"icon_cls\";s:0:\"\";}i:17;a:8:{s:2:\"id\";s:2:\"17\";s:4:\"p_id\";s:2:\"16\";s:9:\"menu_type\";s:11:\"category|16\";s:5:\"title\";s:4:\"LONG\";s:4:\"link\";s:14:\"/category/long\";s:3:\"cls\";s:0:\"\";s:8:\"link_cls\";s:0:\"\";s:8:\"icon_cls\";s:0:\"\";}i:18;a:8:{s:2:\"id\";s:2:\"18\";s:4:\"p_id\";s:2:\"16\";s:9:\"menu_type\";s:11:\"category|17\";s:5:\"title\";s:8:\"MID LONG\";s:4:\"link\";s:18:\"/category/mid-long\";s:3:\"cls\";s:0:\"\";s:8:\"link_cls\";s:0:\"\";s:8:\"icon_cls\";s:0:\"\";}i:19;a:8:{s:2:\"id\";s:2:\"19\";s:4:\"p_id\";s:2:\"16\";s:9:\"menu_type\";s:11:\"category|18\";s:5:\"title\";s:9:\"TWO PIECE\";s:4:\"link\";s:21:\"/category/two-piece-1\";s:3:\"cls\";s:0:\"\";s:8:\"link_cls\";s:0:\"\";s:8:\"icon_cls\";s:0:\"\";}i:20;a:8:{s:2:\"id\";s:2:\"20\";s:4:\"p_id\";s:2:\"16\";s:9:\"menu_type\";s:11:\"category|19\";s:5:\"title\";s:13:\"SALWAR KAMEEZ\";s:4:\"link\";s:25:\"/category/salwar-kameez-1\";s:3:\"cls\";s:0:\"\";s:8:\"link_cls\";s:0:\"\";s:8:\"icon_cls\";s:0:\"\";}i:21;a:8:{s:2:\"id\";s:2:\"21\";s:4:\"p_id\";s:2:\"16\";s:9:\"menu_type\";s:11:\"category|20\";s:5:\"title\";s:4:\"GOWN\";s:4:\"link\";s:16:\"/category/gown-1\";s:3:\"cls\";s:0:\"\";s:8:\"link_cls\";s:0:\"\";s:8:\"icon_cls\";s:0:\"\";}i:22;a:8:{s:2:\"id\";s:2:\"22\";s:4:\"p_id\";s:1:\"0\";s:9:\"menu_type\";s:11:\"category|21\";s:5:\"title\";s:12:\"NEW ARRIVALS\";s:4:\"link\";s:22:\"/category/new-arrivals\";s:3:\"cls\";s:0:\"\";s:8:\"link_cls\";s:0:\"\";s:8:\"icon_cls\";s:0:\"\";}i:23;a:8:{s:2:\"id\";s:2:\"23\";s:4:\"p_id\";s:1:\"0\";s:9:\"menu_type\";s:11:\"category|22\";s:5:\"title\";s:4:\"SALE\";s:4:\"link\";s:14:\"/category/sale\";s:3:\"cls\";s:0:\"\";s:8:\"link_cls\";s:0:\"\";s:8:\"icon_cls\";s:0:\"\";}i:24;a:8:{s:2:\"id\";s:2:\"24\";s:4:\"p_id\";s:2:\"23\";s:9:\"menu_type\";s:11:\"category|23\";s:5:\"title\";s:5:\"WOMEN\";s:4:\"link\";s:17:\"/category/women-1\";s:3:\"cls\";s:0:\"\";s:8:\"link_cls\";s:0:\"\";s:8:\"icon_cls\";s:0:\"\";}i:25;a:8:{s:2:\"id\";s:2:\"25\";s:4:\"p_id\";s:2:\"23\";s:9:\"menu_type\";s:11:\"category|24\";s:5:\"title\";s:3:\"MEN\";s:4:\"link\";s:15:\"/category/men-1\";s:3:\"cls\";s:0:\"\";s:8:\"link_cls\";s:0:\"\";s:8:\"icon_cls\";s:0:\"\";}}}', 1, 1, 1, 1, NULL, '2019-04-20 06:00:26'),
(13, 'fb_page', 'http://facebook.com/nextpagetl', 1, NULL, 1, 1, NULL, NULL),
(14, 'gp_page', 'http://facebook.com/nextpagetl', 1, NULL, 1, 1, NULL, NULL),
(15, 'tt_page', 'http://facebook.com/nextpagetl', 1, NULL, 1, 1, NULL, NULL),
(16, 'li_page', 'http://facebook.com/nextpagetl', 1, NULL, 1, 1, NULL, NULL),
(17, 'youtube_page', 'http://facebook.com/nextpagetl', 1, NULL, 1, 1, NULL, NULL),
(18, 'website', 'http://bazzardhaka.com', 1, 1, 1, 2, NULL, '2019-05-06 03:20:13'),
(19, 'about', 'Bazaar Dhaka', 1, 1, 1, 2, NULL, '2019-05-06 03:20:13'),
(20, 'country', 'Bangladesh', 1, 1, 1, 2, NULL, '2019-04-18 10:25:09'),
(21, 'is_cache_enable', '0', 1, 1, 1, 2, NULL, '2019-05-05 11:48:26'),
(22, 'cache_update_time', '10', 1, 1, 1, 2, NULL, '2019-04-29 11:15:26'),
(23, 'sm_theme_options_home_setting', 'a:55:{s:22:\"slider_change_autoplay\";N;s:15:\"canonical_title\";s:44:\"Cornerstones Of Our Digital Marketing Agency\";s:8:\"features\";a:3:{i:0;a:4:{s:13:\"feature_title\";s:1:\"1\";s:19:\"feature_description\";s:0:\"\";s:12:\"feature_link\";s:0:\"\";s:13:\"feature_image\";s:24:\"1531931702.slide_4_1.jpg\";}i:1;a:4:{s:13:\"feature_title\";s:1:\"2\";s:19:\"feature_description\";s:0:\"\";s:12:\"feature_link\";s:0:\"\";s:13:\"feature_image\";s:24:\"1531931568.slide-5_1.jpg\";}i:2;a:4:{s:13:\"feature_title\";s:1:\"4\";s:19:\"feature_description\";s:0:\"\";s:12:\"feature_link\";s:0:\"\";s:13:\"feature_image\";s:22:\"1531931534.slide_3.jpg\";}}s:19:\"thumbnail_add_title\";s:12:\"TREND ALERTS\";s:21:\"video_thumbnail_image\";s:24:\"facetime-videos-call.jpg\";s:20:\"video_thumbnail_link\";s:41:\"https://www.youtube.com/embed/HqCbUU0OLKM\";s:20:\"payment_method_image\";s:30:\"footer-image-payment-24sep.png\";s:15:\"middle_left_add\";s:30:\"part-statemant-accessories.jpg\";s:16:\"middle_right_add\";s:29:\"party-gown-collection_2_1.jpg\";s:17:\"middle_bottom_add\";s:36:\"testimonialsbannerhomepage-min-1.jpg\";s:26:\"home_is_seo_section_enable\";s:1:\"1\";s:14:\"home_seo_title\";s:15:\"Your SEO Score?\";s:18:\"home_seo_btn_title\";s:12:\"Check up now\";s:17:\"seo_feature_title\";s:45:\"DO YOU WANT TO BE SEEN? YOURE IN RIGHT PLACE!\";s:23:\"seo_feature_description\";s:123:\"SEOis a section of Search Engine Land that focuses not on search marketing advice but rather the search marketing industry.\";s:17:\"seo_feature_image\";N;s:30:\"seo_feature_more_btn_is_enable\";s:1:\"1\";s:26:\"seo_feature_more_btn_label\";s:10:\"Learn more\";s:25:\"seo_feature_more_btn_link\";s:1:\"#\";s:31:\"seo_feature_quote_btn_is_enable\";s:1:\"1\";s:27:\"seo_feature_quote_btn_label\";s:11:\"Learn quote\";s:26:\"seo_feature_quote_btn_link\";s:1:\"#\";s:22:\"seo_marketing_subtitle\";s:15:\"WATCH THE VIDEO\";s:19:\"seo_marketing_title\";s:35:\"HOW TO WORKING DOODLE SEO MARKETING\";s:25:\"seo_marketing_description\";s:941:\"<p>our daily recap of search news. At the end of each business day, we&#39;ll email you a summary of th what happened in search. This will include all stories we&#39;ve covered on Search Engine Land Land as well as headlines from sources from across the web. Anyone involved with digital marketinge deals with marketing technology every day. Keep up with the latest curves thrown by Google an Bing, whether they&#39;re tweaking Product Listing Ads, adjusting Enhanced Campaigns, or changiw the way ads display on various platforms. Get the weekly recap on what&#39;s important from Search Engine Land&#39;s knowledgeable news team and our expert contributors. Everything you need to know about SEO, whether it&#39;s the latest thw news or how-tos from practitioners. Once a week, get the curated scoop from Search Engine ths Land&#39;s SEO newsletter. Reach your customers and potential customers on the popular socialalys platforms and.</p>\";s:16:\"seo_video_banner\";N;s:26:\"seo_marketing_video_poster\";N;s:19:\"seo_marketing_video\";N;s:18:\"home_service_title\";N;s:21:\"home_service_subtitle\";N;s:8:\"services\";a:4:{i:0;a:4:{s:5:\"title\";s:11:\"GREAT VALUE\";s:11:\"description\";s:66:\"We offer competitive prices on our 100 million plus product range.\";s:4:\"link\";s:0:\"\";s:13:\"service_image\";s:15:\"santa-min-1.jpg\";}i:1;a:4:{s:5:\"title\";s:18:\"WORLDWIDE DELIVERY\";s:11:\"description\";s:67:\"With sites in 5 languages, we ship to over 200 countries & regions.\";s:4:\"link\";s:0:\"\";s:13:\"service_image\";s:15:\"worli-min-4.jpg\";}i:2;a:4:{s:5:\"title\";s:12:\"SAFE PAYMENT\";s:11:\"description\";s:63:\"Pay with the world’s most popular and secure payment methods.\";s:4:\"link\";s:0:\"\";s:13:\"service_image\";s:20:\"kalkiviviana_new.jpg\";}i:3;a:4:{s:5:\"title\";s:20:\"SHOP WITH CONFIDENCE\";s:11:\"description\";s:65:\"Our Buyer Protection covers your purchase from click to delivery.\";s:4:\"link\";s:0:\"\";s:13:\"service_image\";s:19:\"kalkimalad_news.jpg\";}}s:17:\"achievement_title\";s:13:\"OUR ACHIVMENT\";s:23:\"achievement_description\";s:82:\"SEO Boost is an experienced of online marketing firm with a big record of success!\";s:17:\"achievement_image\";N;s:13:\"total_project\";s:3:\"222\";s:19:\"total_active_client\";s:3:\"333\";s:18:\"total_success_rate\";s:2:\"98\";s:16:\"total_commitment\";s:3:\"100\";s:9:\"wcu_title\";s:26:\"Why Choose Doodle Digital?\";s:12:\"wcu_subtitle\";s:62:\"Many Services! Big Claims Everywhere! Then, why us? Because...\";s:15:\"wcu_description\";N;s:9:\"wcu_image\";N;s:22:\"home_testimonial_style\";s:8:\"bg-black\";s:25:\"recommended_product_title\";s:19:\"Recommended for you\";s:28:\"recommended_product_subtitle\";s:28:\"Recommended for you products\";s:24:\"recommended_product_show\";N;s:13:\"product_title\";s:23:\"Fashion Show Collection\";s:16:\"product_subtitle\";s:32:\"Fashion Show Collection Products\";s:12:\"product_show\";N;s:10:\"blog_title\";s:11:\"Latest Blog\";s:13:\"blog_subtitle\";s:63:\"Claritas est etiam processus dynamicus, qui sequitur mutationem\";s:9:\"blog_show\";N;s:14:\"branding_title\";s:16:\"Valuable Clients\";s:17:\"branding_subtitle\";s:63:\"Claritas est etiam processus dynamicus, qui sequitur mutationem\";s:5:\"logos\";N;}', 1, 1, 1, 2, NULL, '2019-05-09 05:46:43'),
(24, 'sm_theme_options_contact_setting', 'a:21:{s:20:\"contact_banner_title\";s:10:\"CONTACT US\";s:23:\"contact_banner_subtitle\";s:24:\"A World of Opportunities\";s:20:\"contact_banner_image\";N;s:13:\"contact_title\";s:14:\"We Always Help\";s:16:\"contact_subtitle\";s:78:\"It is Easy To Reach Us For Any Digital Marketing Support Anytime From Anywhere\";s:17:\"contact_des_title\";s:15:\"CONNECT WITH US\";s:19:\"contact_description\";s:299:\"<p><span style=\"font-family:arial,sans-serif; font-size:14px\">Lorem ipsum dolor sit amet onsectetuer adipiscing elit. Mauris fermentum dictum magna. Sed laoreet aliquam leo. Ut tellus dolor dapibus eget. Mauris tincidunt aliquam lectus sed vestibulum. Vestibulum bibendum suscipit mattis.</span></p>\";s:18:\"contact_form_title\";s:18:\"leave us a message\";s:28:\"contact_form_success_message\";s:64:\"Mail successfully send. We will contact you as soon as possible.\";s:20:\"contact_branch_image\";N;s:20:\"contact_branch_title\";s:12:\"Our branches\";s:23:\"contact_branch_subtitle\";s:77:\"Claritas est etiam processus dynamicus, qui sequitur mutationem consuetudium.\";s:19:\"contact_share_title\";s:13:\"Share With Us\";s:19:\"contact_share_image\";N;s:22:\"contact_location_title\";s:14:\"Map & Location\";s:25:\"contact_location_subtitle\";s:77:\"Claritas est etiam processus dynamicus, qui sequitur mutationem consuetudium.\";s:25:\"contact_location_latitude\";s:9:\"23.797424\";s:26:\"contact_location_longitude\";s:9:\"90.369409\";s:17:\"contact_seo_title\";N;s:21:\"contact_meta_keywords\";N;s:24:\"contact_meta_description\";N;}', 1, 1, 1, 2, NULL, '2019-04-24 12:52:30'),
(25, 'sm_theme_options_about_setting', 'a:14:{s:18:\"about_banner_title\";s:8:\"ABOUT US\";s:21:\"about_banner_subtitle\";s:24:\"A World of Opportunities\";s:18:\"about_banner_image\";N;s:9:\"wwr_title\";s:10:\"Who we are\";s:12:\"wwr_subtitle\";N;s:15:\"wwr_description\";s:2715:\"<p style=\"text-align:justify\">Ut tellus dolor, dapibus eget, elementum vel, cursus eleifend, elit. Aenean auctor wisi et urna. Aliquam erat volutpat. Duis ac turpis. Donec sit amet eros. Lorem ipsum dolor sit amet, consecvtetuer adipiscing elit. Mauris fermentum dictum magna. Sed laoreet aliquam leo. Ut tellus dolor, dapibus eget, elementum vel.</p>\r\n\r\n<p style=\"text-align:justify\">Aenean auctor wisi et urna. Aliquam erat volutpat. Duis ac turpis. Integer rutrum ante eu lacus. Vestibulum libero nisl, porta vel, scelerisque eget, malesuada at, neque. Vivamus eget nibh. Etiam cursus leo vel metus. Nulla facilisi. Aenean nec eros.</p>\r\n\r\n<p style=\"text-align:justify\">Integer rutrum ante eu lacus.Vestibulum libero nisl, porta vel, scelerisque eget,&nbsp;<a href=\"http://127.0.0.1:8000/about#\" style=\"box-sizing: border-box; margin: 0px; padding: 0px; border: 0px; background: transparent; color: rgb(102, 102, 102); text-decoration-line: none; font-weight: inherit; vertical-align: top; outline: none !important;\">malesuada at</a>, neque. Vivamus eget nibh. Etiam cursus leo vel metus. Nulla facilisi. Aenean nec eros. Vestibulum ante ipsum primis in faucibus orci luctus et ultrices posuere cubilia Curae; Suspendisse sollicitudin velit sed leo. Ut pharetra augue nec augue.</p>\r\n\r\n<p style=\"text-align:justify\">Nam elit agna,endrerit sit amet, tincidunt ac, viverra sed, nulla. Donec porta diam eu massa. Quisque diam lorem, interdum vitae,dapibus ac, scelerisque vitae, pede. Donec eget tellus non erat lacinia fermentum. Donec in velit vel ipsum auctor pulvinar. Vestibulum iaculis lacinia est. Proin dictum elementum velit. Fusce euismod consequat ante. Lorem ipsum dolor sit amet, consectetuer adipiscing elit. Pellentesque sed dolor. Aliquam congue fermentum nisl.</p>\r\n\r\n<p style=\"text-align:justify\">Aenean auctor wisi et urna. Aliquam erat volutpat. Duis ac turpis. Integer rutrum ante eu lacus. Vestibulum libero nisl, porta vel, scelerisque eget, malesuada at, neque. Vivamus eget nibh. Etiam cursus leo vel metus. Nulla facilisi. Aenean nec eros.</p>\r\n\r\n<p style=\"text-align:justify\">Integer rutrum ante eu lacus.Vestibulum libero nisl, porta vel, scelerisque eget,&nbsp;<a href=\"http://127.0.0.1:8000/about#\" style=\"box-sizing: border-box; margin: 0px; padding: 0px; border: 0px; background: transparent; color: rgb(102, 102, 102); text-decoration-line: none; font-weight: inherit; vertical-align: top; outline: none !important;\">malesuada at</a>, neque. Vivamus eget nibh. Etiam cursus leo vel metus. Nulla facilisi. Aenean nec eros. Vestibulum ante ipsum primis in faucibus orci luctus et ultrices posuere cubilia Curae; Suspendisse sollicitudin velit sed leo. Ut pharetra augue nec augue.</p>\";s:11:\"our_mission\";N;s:10:\"our_vision\";N;s:23:\"about_testimonial_style\";N;s:14:\"about_page_add\";s:8:\"pi25.png\";s:19:\"about_page_add_link\";s:1:\"#\";s:15:\"about_seo_title\";N;s:19:\"about_meta_keywords\";N;s:22:\"about_meta_description\";N;}', 1, 1, 1, 2, NULL, '2019-04-25 03:48:19'),
(26, 'sm_theme_options_faq_setting', 'a:4:{s:16:\"faq_banner_image\";N;s:13:\"faq_seo_title\";N;s:17:\"faq_meta_keywords\";N;s:20:\"faq_meta_description\";N;}', 1, 1, 1, 2, NULL, '2019-04-18 10:40:01'),
(27, 'sm_theme_options_testimonial_setting', 'a:2:{s:17:\"testimonial_title\";s:12:\"TESTIMONIALS\";s:12:\"testimonials\";a:3:{i:0;a:5:{s:5:\"title\";s:15:\"Roverto & Maria\";s:11:\"description\";s:78:\"Your product needs to improve more. To suit the needs and update your image up\";s:17:\"testimonial_image\";s:15:\"testimonial.jpg\";s:16:\"testimonial_logo\";s:0:\"\";s:22:\"testimonial_logo_about\";s:0:\"\";}i:1;a:5:{s:5:\"title\";s:17:\"Roverto & Maria 2\";s:11:\"description\";s:81:\"Your product needs to improve more. To suit the needs and update your image up -2\";s:17:\"testimonial_image\";s:15:\"testimonial.jpg\";s:16:\"testimonial_logo\";s:0:\"\";s:22:\"testimonial_logo_about\";s:0:\"\";}i:2;a:5:{s:5:\"title\";s:17:\"Roverto & Maria-3\";s:11:\"description\";s:81:\"Your product needs to improve more. To suit the needs and update your image up -3\";s:17:\"testimonial_image\";s:15:\"testimonial.jpg\";s:16:\"testimonial_logo\";s:0:\"\";s:22:\"testimonial_logo_about\";s:0:\"\";}}}', 1, 1, 1, 2, NULL, '2019-04-27 06:47:40'),
(28, 'sm_theme_options_team_setting', 'a:8:{s:17:\"team_banner_title\";s:13:\"JOIN OUR TEAM\";s:20:\"team_banner_subtitle\";s:24:\"A World of Opportunities\";s:17:\"team_banner_image\";N;s:10:\"team_title\";s:11:\"Expert Team\";s:13:\"team_subtitle\";s:77:\"Claritas est etiam processus dynamicus, qui sequitur mutationem consuetudium.\";s:14:\"team_seo_title\";N;s:18:\"team_meta_keywords\";N;s:21:\"team_meta_description\";N;}', 1, 1, 1, 2, NULL, '2019-04-18 10:40:01'),
(29, 'sm_theme_options_services_setting', 'a:14:{s:20:\"service_banner_title\";s:12:\"OUR SERVICES\";s:23:\"service_banner_subtitle\";s:24:\"A World of Opportunities\";s:20:\"service_banner_image\";N;s:13:\"service_title\";s:39:\"Full Services of Our <br>Digital Agency\";s:16:\"service_subtitle\";s:77:\"Claritas est etiam processus dynamicus, qui sequitur mutationem consuetudium.\";s:17:\"service_seo_image\";N;s:17:\"service_seo_title\";s:26:\"Search Engine Optimization\";s:23:\"service_seo_description\";s:818:\"Search engine marketing has evolved a way faster than other online services. To cope with the                            fast-changing scenario in digital marketing, Doodle Digital has adopted tried and true                            techniques and up-to-date insights to be able to assist businesses of all levels, from small                            concerns to large corporations with their digital marketing goals.Being committed to making                            online marketing services easy, affordable, and useful for businesses, we cooperate with                            professionals at different levels and interact with people, so we know how people think,                            buy,                            and live. This is how, we create each of our search engine marketing strategies.\";s:16:\"service_seo_link\";s:1:\"#\";s:23:\"services_posts_per_page\";N;s:29:\"services_is_breadcrumb_enable\";s:1:\"0\";s:18:\"services_seo_title\";N;s:22:\"services_meta_keywords\";N;s:25:\"services_meta_description\";N;}', 1, 1, 1, 2, NULL, '2019-04-18 10:40:01'),
(30, 'sm_theme_options_services_detail_setting', 'a:6:{s:27:\"service_detail_banner_title\";s:12:\"OUR SERVICES\";s:30:\"service_detail_banner_subtitle\";s:24:\"A World of Opportunities\";s:27:\"service_detail_banner_image\";N;s:35:\"service_detail_is_breadcrumb_enable\";s:1:\"0\";s:25:\"service_detail_mail_title\";s:7:\"Hire Us\";s:28:\"service_detail_mail_subtitle\";s:17:\"15 Day FREE Trial\";}', 1, 1, 1, 2, NULL, '2019-04-18 10:40:01'),
(31, 'sm_theme_options_package_setting', 'a:5:{s:20:\"package_banner_title\";s:16:\"VIEW ALL PACKAGE\";s:23:\"package_banner_subtitle\";s:64:\"A World of Opportunities We all know that content has to be good\";s:20:\"package_banner_image\";N;s:28:\"package_is_breadcrumb_enable\";s:1:\"0\";s:22:\"package_posts_per_page\";N;}', 1, 1, 1, 2, NULL, '2019-04-18 10:40:01'),
(32, 'sm_theme_options_package_detail_setting', 'a:10:{s:35:\"package_detail_is_breadcrumb_enable\";s:1:\"0\";s:26:\"package_pricing_info_title\";s:12:\"Pricing Info\";s:25:\"package_detail_move_title\";s:20:\"Move to Package info\";s:24:\"package_detail_move_icon\";s:8:\"fa-heart\";s:11:\"step1_image\";N;s:11:\"step1_title\";s:21:\"Money Back Guaranteed\";s:17:\"step1_description\";s:46:\"Ang Lorem Ipsum ay ginaamit na modelo ng print\";s:11:\"step3_image\";N;s:11:\"step3_title\";s:22:\"Satisfaction Guarantee\";s:17:\"step3_description\";s:46:\"Ang Lorem Ipsum ay ginaamit na modelo ng print\";}', 1, 1, 1, 2, NULL, '2019-04-18 10:40:01'),
(33, 'sm_theme_options_blog_setting', 'a:9:{s:19:\"blog_posts_per_page\";N;s:17:\"blog_banner_title\";s:9:\"BLOG HOME\";s:20:\"blog_banner_subtitle\";s:24:\"A World of Opportunities\";s:17:\"blog_banner_image\";N;s:25:\"blog_is_breadcrumb_enable\";s:1:\"0\";s:13:\"blog_ad_image\";N;s:14:\"blog_seo_title\";N;s:18:\"blog_meta_keywords\";N;s:21:\"blog_meta_description\";N;}', 1, 1, 1, 2, NULL, '2019-04-18 10:40:01'),
(34, 'sm_theme_options_blog_detail_setting', 'a:6:{s:24:\"blog_detail_banner_title\";s:9:\"BLOG HOME\";s:27:\"blog_detail_banner_subtitle\";s:24:\"A World of Opportunities\";s:24:\"blog_detail_banner_image\";N;s:32:\"blog_detail_is_breadcrumb_enable\";s:1:\"0\";s:27:\"blog_related_posts_per_page\";N;s:22:\"blog_comments_per_page\";N;}', 1, 1, 1, 2, NULL, '2019-04-18 10:40:01'),
(35, 'sm_theme_options_blog_sidebar_setting', 'a:6:{s:22:\"blog_popular_is_enable\";s:1:\"1\";s:27:\"blog_popular_posts_per_page\";N;s:18:\"blog_show_category\";s:1:\"1\";s:13:\"blog_show_tag\";s:1:\"1\";s:15:\"blog_sidebar_ad\";N;s:20:\"blog_sidebar_ad_link\";s:1:\"#\";}', 1, 1, 1, 2, NULL, '2019-04-18 10:40:01'),
(36, 'sm_theme_options_product_setting', 'a:9:{s:21:\"shop_page_per_product\";s:1:\"9\";s:20:\"product_banner_title\";s:12:\"PRODUCT HOME\";s:23:\"product_banner_subtitle\";s:373:\"The classic and evergreen Indian Salwar Kameez, that can be as simple as a straight cut suit that you can wear to work or an intricately embellished Anarkali that is apt for a royal wedding. Available in a plethora of designs and combinations to suit your mood and to fit your requirement, salwar suits are your all weather friend for the perfectly traditional Indian look.\";s:20:\"product_banner_image\";N;s:28:\"product_is_breadcrumb_enable\";s:1:\"0\";s:16:\"product_ad_image\";N;s:17:\"product_seo_title\";N;s:21:\"product_meta_keywords\";N;s:24:\"product_meta_description\";N;}', 1, 1, 1, 2, NULL, '2019-04-27 06:27:35'),
(37, 'sm_theme_options_product_detail_setting', 'a:10:{s:27:\"product_detail_banner_title\";s:12:\"PRODUCT HOME\";s:30:\"product_detail_banner_subtitle\";s:24:\"A World of Opportunities\";s:27:\"product_detail_banner_image\";N;s:35:\"product_detail_is_breadcrumb_enable\";s:1:\"0\";s:24:\"product_related_per_page\";N;s:25:\"product_comments_per_page\";N;s:25:\"product_special_is_enable\";s:1:\"1\";s:24:\"product_special_per_page\";N;s:18:\"product_detail_add\";N;s:23:\"product_detail_add_link\";s:1:\"#\";}', 1, 1, 1, 2, NULL, '2019-05-01 02:48:22'),
(38, 'sm_theme_options_product_sidebar_setting', 'a:10:{s:27:\"product_best_sale_is_enable\";s:1:\"1\";s:26:\"product_best_sale_per_page\";N;s:21:\"product_show_category\";s:1:\"1\";s:16:\"product_show_tag\";s:1:\"1\";s:18:\"product_show_brand\";s:1:\"1\";s:17:\"product_show_size\";s:1:\"1\";s:18:\"product_show_color\";s:1:\"1\";s:24:\"product_show_testimonial\";s:1:\"0\";s:26:\"product_show_advertisement\";s:1:\"1\";s:29:\"product_sidebar_advertisement\";a:3:{i:0;a:4:{s:5:\"title\";s:1:\"1\";s:11:\"description\";s:3:\"sds\";s:4:\"link\";s:1:\"#\";s:5:\"image\";s:15:\"awardbanner.jpg\";}i:1;a:4:{s:5:\"title\";s:1:\"2\";s:11:\"description\";s:1:\"2\";s:4:\"link\";s:1:\"#\";s:5:\"image\";s:23:\"ready-pleatrd-saree.jpg\";}i:2;a:4:{s:5:\"title\";s:1:\"3\";s:11:\"description\";s:1:\"3\";s:4:\"link\";s:1:\"#\";s:5:\"image\";s:18:\"bandani_sareee.jpg\";}}}', 1, 1, 1, 2, NULL, '2019-05-01 02:55:51'),
(39, 'sm_theme_options_case_setting', 'a:8:{s:17:\"case_banner_title\";s:12:\"CASE DETAILS\";s:20:\"case_banner_subtitle\";s:24:\"A World of Opportunities\";s:17:\"case_banner_image\";N;s:25:\"case_is_breadcrumb_enable\";s:1:\"0\";s:19:\"case_posts_per_page\";N;s:14:\"case_seo_title\";N;s:18:\"case_meta_keywords\";N;s:21:\"case_meta_description\";N;}', 1, 1, 1, 2, NULL, '2019-04-18 10:40:01'),
(40, 'sm_theme_options_case_detail_setting', 'a:4:{s:24:\"case_detail_banner_title\";s:12:\"CASE DETAILS\";s:27:\"case_detail_banner_subtitle\";s:24:\"A World of Opportunities\";s:24:\"case_detail_banner_image\";N;s:32:\"case_detail_is_breadcrumb_enable\";s:1:\"0\";}', 1, 1, 1, 2, NULL, '2019-04-18 10:40:01'),
(41, 'sm_theme_options_order_setting', 'a:7:{s:20:\"order_posts_per_page\";N;s:17:\"invoice_signature\";N;s:24:\"invoice_approved_by_name\";s:11:\"NPTL Author\";s:31:\"invoice_approved_by_designation\";s:23:\"Director of Development\";s:20:\"invoice_banner_title\";s:13:\"ORDER DETAILS\";s:23:\"invoice_banner_subtitle\";s:44:\"If you\'re struggling to get more information\";s:20:\"invoice_banner_image\";N;}', 1, 1, 1, 2, NULL, '2019-04-24 12:12:47'),
(42, 'sm_theme_options_social_setting', 'a:10:{s:15:\"social_facebook\";s:1:\"#\";s:14:\"social_twitter\";s:1:\"#\";s:15:\"social_linkedin\";s:1:\"#\";s:18:\"social_google_plus\";s:1:\"#\";s:13:\"social_github\";N;s:16:\"social_pinterest\";N;s:14:\"social_behance\";N;s:15:\"social_dribbble\";N;s:16:\"social_instagram\";N;s:14:\"social_youtube\";N;}', 1, 1, 1, 2, NULL, '2019-04-29 07:10:35'),
(43, 'sm_theme_options_footer_setting', 'a:8:{s:11:\"footer_logo\";s:17:\"logo-buckelup.jpg\";s:20:\"footer_widget2_title\";s:7:\"COMPANY\";s:26:\"footer_widget2_description\";s:1624:\"<ul>\r\n	<li><a href=\"http://localhost/alaminshah_html/index.php#\" style=\"box-sizing: border-box; margin: 0px 0px 0px -25px; padding: 0px; border: 0px; background: transparent; color: rgb(153, 153, 153); text-decoration-line: none; font-weight: inherit; vertical-align: top; outline: none !important;\">About Us</a></li>\r\n	<li><a href=\"http://localhost/alaminshah_html/index.php#\" style=\"box-sizing: border-box; margin: 0px 0px 0px -25px; padding: 0px; border: 0px; background: transparent; color: rgb(255, 255, 255); text-decoration-line: none; font-weight: inherit; outline: 0px; vertical-align: top; transition: all 0.25s ease 0s;\">Testimonials</a></li>\r\n	<li><a href=\"http://localhost/alaminshah_html/index.php#\" style=\"box-sizing: border-box; margin: 0px 0px 0px -25px; padding: 0px; border: 0px; background: transparent; color: rgb(153, 153, 153); text-decoration-line: none; font-weight: inherit; vertical-align: top; outline: none !important;\">Affiliate Program</a></li>\r\n	<li><a href=\"http://localhost/alaminshah_html/index.php#\" style=\"box-sizing: border-box; margin: 0px 0px 0px -25px; padding: 0px; border: 0px; background: transparent; color: rgb(153, 153, 153); text-decoration-line: none; font-weight: inherit; vertical-align: top; outline: none !important;\">Terms &amp; Conditions</a></li>\r\n	<li><a href=\"http://localhost/alaminshah_html/index.php#\" style=\"box-sizing: border-box; margin: 0px 0px 0px -25px; padding: 0px; border: 0px; background: transparent; color: rgb(153, 153, 153); text-decoration-line: none; font-weight: inherit; vertical-align: top; outline: none !important;\">Contact Us</a></li>\r\n</ul>\";s:20:\"footer_widget3_title\";s:10:\"MY ACCOUNT\";s:26:\"footer_widget3_description\";s:1501:\"<ul>\r\n	<li><a href=\"http://127.0.0.1:8000/?#\" style=\"box-sizing: border-box; margin: 0px 0px 0px -25px; padding: 0px; border: 0px; background: transparent; color: rgb(153, 153, 153); text-decoration-line: none; font-weight: inherit; vertical-align: top; outline: none !important;\">My Orders</a></li>\r\n	<li><a href=\"http://127.0.0.1:8000/?#\" style=\"box-sizing: border-box; margin: 0px 0px 0px -25px; padding: 0px; border: 0px; background: transparent; color: rgb(153, 153, 153); text-decoration-line: none; font-weight: inherit; vertical-align: top; outline: none !important;\">My Credit Slips</a></li>\r\n	<li><a href=\"http://127.0.0.1:8000/?#\" style=\"box-sizing: border-box; margin: 0px 0px 0px -25px; padding: 0px; border: 0px; background: transparent; color: rgb(153, 153, 153); text-decoration-line: none; font-weight: inherit; vertical-align: top; outline: none !important;\">My Addresses</a></li>\r\n	<li><a href=\"http://127.0.0.1:8000/?#\" style=\"box-sizing: border-box; margin: 0px 0px 0px -25px; padding: 0px; border: 0px; background: transparent; color: rgb(153, 153, 153); text-decoration-line: none; font-weight: inherit; vertical-align: top; outline: none !important;\">My Personal Info</a></li>\r\n	<li><a href=\"http://127.0.0.1:8000/?#\" style=\"box-sizing: border-box; margin: 0px 0px 0px -25px; padding: 0px; border: 0px; background: transparent; color: rgb(153, 153, 153); text-decoration-line: none; font-weight: inherit; vertical-align: top; outline: none !important;\">Specials</a></li>\r\n</ul>\";s:20:\"footer_widget4_title\";s:7:\"SUPPORT\";s:26:\"footer_widget4_description\";s:1636:\"<ul>\r\n	<li><a href=\"http://localhost/alaminshah_html/index.php#\" style=\"box-sizing: border-box; margin: 0px 0px 0px -25px; padding: 0px; border: 0px; background: transparent; color: rgb(153, 153, 153); text-decoration-line: none; font-weight: inherit; vertical-align: top; outline: none !important;\">Payments &amp; My Vouchers</a></li>\r\n	<li><a href=\"http://localhost/alaminshah_html/index.php#\" style=\"box-sizing: border-box; margin: 0px 0px 0px -25px; padding: 0px; border: 0px; background: transparent; color: rgb(153, 153, 153); text-decoration-line: none; font-weight: inherit; vertical-align: top; outline: none !important;\">Saved Cards</a></li>\r\n	<li><a href=\"http://localhost/alaminshah_html/index.php#\" style=\"box-sizing: border-box; margin: 0px 0px 0px -25px; padding: 0px; border: 0px; background: transparent; color: rgb(153, 153, 153); text-decoration-line: none; font-weight: inherit; vertical-align: top; outline: none !important;\">Shipping Free</a></li>\r\n	<li><a href=\"http://localhost/alaminshah_html/index.php#\" style=\"box-sizing: border-box; margin: 0px 0px 0px -25px; padding: 0px; border: 0px; background: transparent; color: rgb(153, 153, 153); text-decoration-line: none; font-weight: inherit; vertical-align: top; outline: none !important;\">Cancellation &amp; Returns</a></li>\r\n	<li><a href=\"http://localhost/alaminshah_html/index.php#\" style=\"box-sizing: border-box; margin: 0px 0px 0px -25px; padding: 0px; border: 0px; background: transparent; color: rgb(153, 153, 153); text-decoration-line: none; font-weight: inherit; vertical-align: top; outline: none !important;\">FAQ &amp; Support Online</a></li>\r\n</ul>\";s:9:\"copyright\";s:30:\"© 2019 | All rights reserved.\";}', 1, 1, 1, 2, NULL, '2019-04-27 04:16:53'),
(44, 'sm_theme_options_popup_setting', 'a:11:{s:24:\"newsletter_pop_is_enable\";s:1:\"1\";s:20:\"newsletter_pop_title\";s:19:\"Join Our Newsletter\";s:26:\"newsletter_pop_description\";s:102:\"<p>We really care about you and your website as much as you do. from us you get 100% free support.</p>\";s:24:\"newsletter_success_title\";s:26:\"Thank You For Subscribing!\";s:30:\"newsletter_success_description\";s:131:\"You\'re just one step away from being one of our dear susbcribers.<br>Please check the Email provided and confirm your susbcription.\";s:32:\"newsletter_already_success_title\";s:27:\"Thank You For Your Efforts!\";s:38:\"newsletter_already_success_description\";s:41:\"You Already Subscribed To Our Newsletter!\";s:31:\"newsletter_form_success_message\";s:24:\"Subscribed successfully.\";s:15:\"offer_is_enable\";s:1:\"1\";s:11:\"offer_title\";s:20:\"1st Order To 30% Off\";s:17:\"offer_description\";s:135:\"<p>As content marketing continues to drive results for businesses trying to reach their audience</p>\r\n\r\n<p><a href=\"#\">Get More</a></p>\";}', 1, 1, 1, 2, NULL, '2019-04-18 10:40:02'),
(45, 'sm_theme_options_style_n_script_setting', 'a:3:{s:20:\"google_analytic_code\";s:668:\"<script>\r\n        (function(i,s,o,g,r,a,m){i[\'GoogleAnalyticsObject\']=r;i[r]=i[r]||function(){\r\n            (i[r].q=i[r].q||[]).push(arguments)},i[r].l=1*new Date();a=s.createElement(o),\r\n            m=s.getElementsByTagName(o)[0];a.async=1;a.src=g;m.parentNode.insertBefore(a,m)\r\n        })(window,document,\'script\',\'https://www.google-analytics.com/analytics.js\',\'ga\');\r\n\r\n        ga(\'create\', \'UA-XXXXXXXX-X\', \'auto\');\r\n        ga(\'send\', \'pageview\');\r\n        ga(\'require\', \'linkid\', \'linkid.js\');\r\n        ga(\'require\', \'displayfeatures\');\r\n        setTimeout(\"ga(\'send\',\'event\',\'Profitable Engagement\',\'time on page more than 30 seconds\')\",30000);\r\n    </script>\";s:21:\"mrks_theme_custom_css\";N;s:20:\"mrks_theme_custom_js\";N;}', 1, 1, 1, 2, NULL, '2019-05-01 02:50:09'),
(46, 'sm_theme_options_other_setting', 'a:7:{s:29:\"checkout_is_breadcrumb_enable\";s:1:\"0\";s:21:\"checkout_banner_title\";s:8:\"Checkout\";s:24:\"checkout_banner_subtitle\";s:24:\"A World of Opportunities\";s:21:\"checkout_banner_image\";N;s:20:\"checkout_email_label\";s:35:\"Please provide your email address :\";s:26:\"checkout_email_description\";s:147:\"Please enter an email address you check regularly, as we use this to send updates regarding your job. this email address with the service provider.\";s:28:\"checkout_payment_description\";N;}', 1, 1, 1, 2, NULL, '2019-04-18 10:40:02'),
(47, 'currency', '19', 1, 1, 1, 2, NULL, '2019-05-02 05:28:29'),
(48, 'primary_color', NULL, 1, 1, 1, 2, NULL, '2019-04-29 04:36:12'),
(49, 'secondary_color', NULL, 1, 1, 1, 2, NULL, '2019-04-29 04:36:12'),
(50, 'fb_api_enable', 'on', 1, 1, 1, 2, NULL, '2019-04-24 11:10:58'),
(51, 'fb_app_id', '425239464956412', 1, 1, 1, 2, NULL, '2019-04-24 11:10:58'),
(52, 'fb_app_secret', 'c94997886427edf56235f6655b504ee8', 1, 1, 1, 2, NULL, '2019-04-24 11:10:58'),
(53, 'gp_api_enable', 'on', 1, NULL, 1, 2, NULL, NULL),
(54, 'gp_client_id', 'wwqewq', 1, NULL, 1, 2, NULL, NULL),
(55, 'gp_client_secret', '1421321', 1, NULL, 1, 2, NULL, NULL),
(56, 'seo_title', 'Online Shopping In Bangladesh: Fashion- Alamin Shah', 1, NULL, 1, 2, NULL, NULL),
(57, 'is_tax_enable', '0', 1, NULL, 1, 2, NULL, NULL),
(58, 'default_tax', '1', 1, NULL, 1, 2, NULL, NULL),
(59, 'default_tax_type', '1', 1, NULL, 1, 2, NULL, NULL);

-- --------------------------------------------------------

--
-- Table structure for table `shipping_methods`
--

CREATE TABLE `shipping_methods` (
  `id` int(10) UNSIGNED NOT NULL,
  `title` varchar(191) NOT NULL,
  `description` text,
  `image` text,
  `charge` decimal(8,2) DEFAULT NULL,
  `created_by` int(10) UNSIGNED NOT NULL,
  `modified_by` int(10) UNSIGNED DEFAULT NULL,
  `status` tinyint(4) NOT NULL DEFAULT '2' COMMENT '1=active, 2=pending, 3=cancel',
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Dumping data for table `shipping_methods`
--

INSERT INTO `shipping_methods` (`id`, `title`, `description`, `image`, `charge`, `created_by`, `modified_by`, `status`, `created_at`, `updated_at`) VALUES
(1, 'Flat Rate', NULL, NULL, '50.00', 1, NULL, 1, '2019-04-20 04:41:25', '2019-04-20 04:41:25'),
(2, 'Local Pickup', NULL, NULL, '60.00', 1, NULL, 1, '2019-04-20 04:41:40', '2019-04-20 04:41:40'),
(3, 'Free Shipping', NULL, NULL, '0.00', 1, NULL, 1, '2019-04-20 04:41:56', '2019-04-20 04:41:56');

-- --------------------------------------------------------

--
-- Table structure for table `shoppingcart`
--

CREATE TABLE `shoppingcart` (
  `identifier` varchar(191) NOT NULL,
  `instance` varchar(191) NOT NULL,
  `content` longtext NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

-- --------------------------------------------------------

--
-- Table structure for table `sliders`
--

CREATE TABLE `sliders` (
  `id` int(10) UNSIGNED NOT NULL,
  `style` varchar(191) NOT NULL,
  `title` varchar(191) NOT NULL,
  `description` text,
  `image` varchar(191) NOT NULL,
  `extra` varchar(191) NOT NULL,
  `created_by` int(10) UNSIGNED DEFAULT NULL,
  `modified_by` int(10) UNSIGNED DEFAULT NULL,
  `status` tinyint(4) NOT NULL DEFAULT '2' COMMENT '1=active, 2=pending, 3=cancel',
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Dumping data for table `sliders`
--

INSERT INTO `sliders` (`id`, `style`, `title`, `description`, `image`, `extra`, `created_by`, `modified_by`, `status`, `created_at`, `updated_at`) VALUES
(1, 'slide1', 'Slider1', NULL, 's4_2.jpg', 'a:2:{s:12:\"button_label\";a:1:{i:0;N;}s:11:\"button_link\";a:1:{i:0;N;}}', 1, 1, 1, '2019-04-18 10:31:56', '2019-05-09 03:49:42'),
(2, 'slide1', 'Slider 2', NULL, 's3_2.jpg', 'a:2:{s:12:\"button_label\";a:1:{i:0;N;}s:11:\"button_link\";a:1:{i:0;N;}}', 1, 1, 1, '2019-04-18 10:32:18', '2019-05-09 03:50:28'),
(3, 'slide1', 'Slider3', NULL, 's2_2.jpg', 'a:2:{s:12:\"button_label\";a:1:{i:0;N;}s:11:\"button_link\";a:1:{i:0;N;}}', 1, 1, 1, '2019-04-18 10:32:35', '2019-05-09 03:52:00'),
(4, 'slide1', 'Slider 4', NULL, '1553335256.prima3.jpg', 'a:2:{s:12:\"button_label\";a:1:{i:0;N;}s:11:\"button_link\";a:1:{i:0;N;}}', 1, 1, 1, '2019-04-18 10:33:01', '2019-05-09 04:37:58');

-- --------------------------------------------------------

--
-- Table structure for table `subscribers`
--

CREATE TABLE `subscribers` (
  `id` int(10) UNSIGNED NOT NULL,
  `email` varchar(191) NOT NULL,
  `firstname` varchar(191) DEFAULT NULL,
  `lastname` varchar(191) DEFAULT NULL,
  `ip` varchar(191) DEFAULT NULL,
  `city` varchar(191) DEFAULT NULL,
  `state` varchar(191) DEFAULT NULL,
  `country` varchar(191) DEFAULT NULL,
  `extra` varchar(191) DEFAULT NULL,
  `status` tinyint(4) NOT NULL DEFAULT '1' COMMENT '1=Active, 0=Disabled',
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Dumping data for table `subscribers`
--

INSERT INTO `subscribers` (`id`, `email`, `firstname`, `lastname`, `ip`, `city`, `state`, `country`, `extra`, `status`, `created_at`, `updated_at`) VALUES
(1, 'admin@gmail.com', NULL, NULL, '220.158.206.79', '', '', '', NULL, 0, '2019-04-23 11:15:29', '2019-04-23 11:15:29'),
(2, 'admin1@gmail.com', NULL, NULL, '127.0.0.1', '', '', '', NULL, 0, '2019-04-24 08:49:06', '2019-04-24 08:49:06'),
(3, 'admin@dprescription.com', NULL, NULL, '127.0.0.1', '', '', '', NULL, 0, '2019-04-24 08:49:16', '2019-04-24 08:49:16'),
(4, 'manager@gmail.com', NULL, NULL, '127.0.0.1', '', '', '', NULL, 0, '2019-04-24 08:49:27', '2019-04-24 08:49:27'),
(5, 'nextpagetl@gmail.com', NULL, NULL, '127.0.0.1', '', '', '', NULL, 0, '2019-04-25 03:50:19', '2019-04-25 03:50:19'),
(6, 'mmsumon799@gmail.com', NULL, NULL, '127.0.0.1', '', '', '', NULL, 1, '2019-04-29 07:12:42', '2019-04-29 08:45:39'),
(7, 'demo@ecommerce.com', NULL, NULL, '127.0.0.1', '', '', '', NULL, 0, '2019-04-29 11:30:25', '2019-04-29 11:30:25'),
(8, 'demo@ecomfrmerce.com', NULL, NULL, '127.0.0.1', '', '', '', NULL, 0, '2019-04-29 11:32:39', '2019-04-29 11:32:39'),
(9, 'admin2@gmail.com', NULL, NULL, '103.197.155.226', '', '', '', NULL, 0, '2019-05-01 03:43:54', '2019-05-01 03:43:54');

-- --------------------------------------------------------

--
-- Table structure for table `taggables`
--

CREATE TABLE `taggables` (
  `id` int(10) UNSIGNED NOT NULL,
  `tag_id` int(10) UNSIGNED NOT NULL,
  `taggable_id` int(10) UNSIGNED NOT NULL,
  `taggable_type` varchar(191) NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Dumping data for table `taggables`
--

INSERT INTO `taggables` (`id`, `tag_id`, `taggable_id`, `taggable_type`, `created_at`, `updated_at`) VALUES
(2, 2, 6, 'App\\Model\\Common\\Product', '2019-04-20 08:29:40', '2019-04-20 08:29:40'),
(3, 3, 7, 'App\\Model\\Common\\Product', '2019-04-20 08:39:51', '2019-04-20 08:39:51'),
(4, 1, 8, 'App\\Model\\Common\\Product', '2019-04-20 08:48:32', '2019-04-20 08:48:32'),
(5, 1, 9, 'App\\Model\\Common\\Product', '2019-04-20 08:54:56', '2019-04-20 08:54:56'),
(6, 4, 10, 'App\\Model\\Common\\Product', '2019-04-20 09:01:21', '2019-04-20 09:01:21'),
(7, 5, 11, 'App\\Model\\Common\\Product', '2019-04-20 09:11:02', '2019-04-20 09:11:02'),
(8, 1, 12, 'App\\Model\\Common\\Product', '2019-04-20 09:18:27', '2019-04-20 09:18:27'),
(9, 6, 13, 'App\\Model\\Common\\Product', '2019-04-20 09:23:39', '2019-04-20 09:23:39'),
(10, 1, 14, 'App\\Model\\Common\\Product', '2019-04-20 09:33:13', '2019-04-20 09:33:13'),
(11, 3, 15, 'App\\Model\\Common\\Product', '2019-04-20 09:42:29', '2019-04-20 09:42:29'),
(12, 6, 16, 'App\\Model\\Common\\Product', '2019-04-20 09:51:25', '2019-04-20 09:51:25'),
(13, 1, 17, 'App\\Model\\Common\\Product', '2019-04-20 09:56:16', '2019-04-20 09:56:16'),
(14, 7, 18, 'App\\Model\\Common\\Product', '2019-05-09 03:36:32', '2019-05-09 03:36:32'),
(15, 6, 19, 'App\\Model\\Common\\Product', '2019-05-09 03:36:06', '2019-05-09 03:36:06'),
(16, 8, 20, 'App\\Model\\Common\\Product', '2019-05-09 05:09:52', '2019-05-09 05:09:52'),
(17, 8, 21, 'App\\Model\\Common\\Product', '2019-05-09 05:08:22', '2019-05-09 05:08:22'),
(18, 9, 22, 'App\\Model\\Common\\Product', '2019-05-09 05:07:26', '2019-05-09 05:07:26'),
(19, 1, 23, 'App\\Model\\Common\\Product', '2019-05-09 05:06:19', '2019-05-09 05:06:19'),
(20, 1, 24, 'App\\Model\\Common\\Product', '2019-05-09 05:05:24', '2019-05-09 05:05:24'),
(21, 9, 25, 'App\\Model\\Common\\Product', '2019-05-09 05:03:17', '2019-05-09 05:03:17'),
(22, 10, 26, 'App\\Model\\Common\\Product', '2019-05-09 04:59:58', '2019-05-09 04:59:58');

-- --------------------------------------------------------

--
-- Table structure for table `tags`
--

CREATE TABLE `tags` (
  `id` int(10) UNSIGNED NOT NULL,
  `title` varchar(191) NOT NULL,
  `description` text,
  `image` varchar(191) DEFAULT NULL,
  `slug` varchar(191) NOT NULL,
  `views` int(10) UNSIGNED NOT NULL DEFAULT '0',
  `total_posts` int(10) UNSIGNED NOT NULL DEFAULT '0',
  `total_products` int(11) NOT NULL,
  `seo_title` varchar(191) DEFAULT NULL,
  `meta_key` text,
  `meta_description` text,
  `created_by` int(10) UNSIGNED DEFAULT NULL,
  `modified_by` int(10) UNSIGNED DEFAULT NULL,
  `status` tinyint(4) NOT NULL DEFAULT '2' COMMENT '1=active, 2=pending, 3=cancel',
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Dumping data for table `tags`
--

INSERT INTO `tags` (`id`, `title`, `description`, `image`, `slug`, `views`, `total_posts`, `total_products`, `seo_title`, `meta_key`, `meta_description`, `created_by`, `modified_by`, `status`, `created_at`, `updated_at`) VALUES
(1, 'Georgette', NULL, NULL, 'georgette', 0, 0, 8, NULL, NULL, NULL, 1, NULL, 1, '2019-04-20 08:07:05', '2019-04-23 10:30:51'),
(2, 'Double georgette', NULL, NULL, 'double-georgette', 0, 1, 0, NULL, NULL, NULL, 1, NULL, 1, '2019-04-20 08:21:51', '2019-04-20 08:21:51'),
(3, 'Silk', NULL, NULL, 'silk', 0, 0, 2, NULL, NULL, NULL, 1, NULL, 1, '2019-04-20 08:39:51', '2019-04-20 09:42:29'),
(4, 'Crepc Georgette', NULL, NULL, 'crepc-georgette', 0, 0, 1, NULL, NULL, NULL, 1, NULL, 1, '2019-04-20 09:01:21', '2019-04-20 09:01:21'),
(5, 'Chesse Cotton', NULL, NULL, 'chesse-cotton', 0, 0, 1, NULL, NULL, NULL, 1, NULL, 1, '2019-04-20 09:11:02', '2019-04-20 09:11:02'),
(6, 'Crepe Georgette', NULL, NULL, 'crepe-georgette', 0, 0, 3, NULL, NULL, NULL, 1, NULL, 1, '2019-04-20 09:23:39', '2019-04-21 10:18:14'),
(7, 'Satin Pant Georgette Dupatta', NULL, NULL, 'satin-pant-georgette-dupatta', 0, 0, 1, NULL, NULL, NULL, 1, NULL, 1, '2019-04-21 10:09:33', '2019-04-21 10:09:33'),
(8, 'Cotton', NULL, NULL, 'cotton', 0, 0, 2, NULL, NULL, NULL, 1, NULL, 1, '2019-04-23 09:55:20', '2019-04-23 10:06:24'),
(9, 'Viscose', NULL, NULL, 'viscose', 0, 0, 2, NULL, NULL, NULL, 1, NULL, 1, '2019-04-23 10:11:38', '2019-04-23 10:53:02'),
(10, 'Dress: Cotton Slub Pant: Georgette', NULL, NULL, 'dress-cotton-slub-pant-georgette', 0, 0, 1, NULL, NULL, NULL, 1, NULL, 1, '2019-04-23 11:13:17', '2019-04-23 11:13:17');

-- --------------------------------------------------------

--
-- Table structure for table `taxes`
--

CREATE TABLE `taxes` (
  `id` int(10) UNSIGNED NOT NULL,
  `title` varchar(191) NOT NULL,
  `country` varchar(191) NOT NULL,
  `tax` double(5,2) NOT NULL DEFAULT '0.00',
  `type` tinyint(3) UNSIGNED NOT NULL DEFAULT '0' COMMENT '1 = Fixed and 2 = Percentage',
  `created_by` int(10) UNSIGNED NOT NULL,
  `modified_by` int(10) UNSIGNED DEFAULT NULL,
  `status` tinyint(4) NOT NULL DEFAULT '3' COMMENT '1=Completed, 2=Processing, 3=Pending, 4=cancel',
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Dumping data for table `taxes`
--

INSERT INTO `taxes` (`id`, `title`, `country`, `tax`, `type`, `created_by`, `modified_by`, `status`, `created_at`, `updated_at`) VALUES
(1, 'Tax', 'Bangladesh', 10.00, 2, 1, 1, 1, '2019-04-20 04:43:16', '2019-04-20 04:44:08');

-- --------------------------------------------------------

--
-- Table structure for table `units`
--

CREATE TABLE `units` (
  `id` int(10) UNSIGNED NOT NULL,
  `title` varchar(191) NOT NULL,
  `slug` varchar(191) NOT NULL,
  `actual_name` varchar(191) DEFAULT NULL,
  `created_by` int(10) UNSIGNED DEFAULT NULL,
  `modified_by` int(10) UNSIGNED DEFAULT NULL,
  `status` tinyint(4) NOT NULL DEFAULT '2' COMMENT '1=active, 2=pending, 3=cancel',
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Dumping data for table `units`
--

INSERT INTO `units` (`id`, `title`, `slug`, `actual_name`, `created_by`, `modified_by`, `status`, `created_at`, `updated_at`) VALUES
(1, 'Pcs', 'pcs', 'Pisces', 1, NULL, 1, '2019-04-18 11:11:35', '2019-05-02 09:21:40');

-- --------------------------------------------------------

--
-- Table structure for table `users`
--

CREATE TABLE `users` (
  `id` int(10) UNSIGNED NOT NULL,
  `auth_id` varchar(191) DEFAULT NULL,
  `username` varchar(50) NOT NULL,
  `email` varchar(191) DEFAULT NULL,
  `firstname` varchar(191) DEFAULT NULL,
  `lastname` varchar(191) DEFAULT NULL,
  `mobile` varchar(20) DEFAULT NULL,
  `company` varchar(191) DEFAULT NULL,
  `address` text,
  `country` varchar(191) DEFAULT NULL,
  `state` varchar(191) DEFAULT NULL,
  `city` varchar(191) DEFAULT NULL,
  `zip` varchar(5) DEFAULT NULL,
  `billing_firstname` varchar(191) DEFAULT NULL,
  `billing_lastname` varchar(191) DEFAULT NULL,
  `billing_mobile` varchar(20) DEFAULT NULL,
  `billing_company` varchar(191) DEFAULT NULL,
  `billing_address` text,
  `billing_country` varchar(191) DEFAULT NULL,
  `billing_state` varchar(191) DEFAULT NULL,
  `billing_city` varchar(191) DEFAULT NULL,
  `billing_zip` varchar(5) DEFAULT NULL,
  `job_title` varchar(191) DEFAULT NULL,
  `password` varchar(60) NOT NULL,
  `image` varchar(191) DEFAULT NULL,
  `remember_token` varchar(100) DEFAULT NULL,
  `status` tinyint(4) NOT NULL DEFAULT '2' COMMENT '1=Active, 2=Pending, 3=Cancel',
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Dumping data for table `users`
--

INSERT INTO `users` (`id`, `auth_id`, `username`, `email`, `firstname`, `lastname`, `mobile`, `company`, `address`, `country`, `state`, `city`, `zip`, `billing_firstname`, `billing_lastname`, `billing_mobile`, `billing_company`, `billing_address`, `billing_country`, `billing_state`, `billing_city`, `billing_zip`, `job_title`, `password`, `image`, `remember_token`, `status`, `created_at`, `updated_at`) VALUES
(1, NULL, 'sumon', 'sumon@gmail.com', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, '$2y$10$vtM9BmMnRFcgIZFF1BdFIOD5zvuqyPNhf/pxr5z8vRsWY0eYu//2m', '', NULL, 1, NULL, NULL),
(2, NULL, 'admin1', 'admin1@gmail.com', 'Timothy', 'Jefferson', '23432424', 'Nunez and Santos Inc', 'Est voluptatem dolor', 'Bangladesh', 'Dhaka', 'Mollitia tenetur eli', '93755', 'Timothy', 'Jefferson', '23432424', 'Nunez and Santos Inc', 'Est voluptatem dolor', NULL, NULL, 'Mollitia tenetur eli', '93755', NULL, '$2y$10$6u7H9cU6FUtM9D62JCkUVuq2jgm9f/.ti32RYDiu0fw5wz03rvpmu', '145', 'qSy1fZjY0Z575ZBEZJoZVNZRzDBovbQnJ7NbMkyswRsHSojgyVWsr7mDRY28', 1, '2019-04-24 06:05:23', '2019-05-02 11:19:58'),
(3, NULL, 'admin2', 'mmsumon799@gmail.com', 'Buckle', 'BD', '23432424', 'Nunez and Santos Inc', 'House 34 (3B), Road 2, Nikunja 2, Dhaka 1229', 'Bangladesh', 'Dhaka', 'Dhaka', '1229', 'Buckle', 'BD', '23432424', 'Nunez and Santos Inc', 'House 34 (3B), Road 2, Nikunja 2, Dhaka 1229', NULL, NULL, 'Dhaka', '1229', NULL, '$2y$10$P.diOQRzca1homQIeQQys.Lrtr5HYnq..lS8qPaGmBP3/ULBi2n..', NULL, 'NkI3OiKvNQvrqD42rtcDb0IhEG25uU99c7ydujglGTlGVZCCtd39iiJo7KMW', 1, '2019-04-24 10:07:55', '2019-04-24 11:55:39'),
(4, NULL, 'rubelm677@gmail.com', 'rubelm677@gmail.com', 'Rubel', 'Howlader', '1723331925', 'asdfasd', '55 East 52nd Street', 'Bangladesh', 'Jhalokati', 'New York', '75974', 'Rubel', 'Howlader', '1723331925', 'asdfasd', '55 East 52nd Street', NULL, NULL, 'New York', '75974', NULL, '$2y$10$N9wTV5GIwqy2sxmEmw43h.m6QoZmVipuc8O2OjiojTQ2b1J8E1iKy', NULL, NULL, 1, '2019-04-30 05:10:58', '2019-04-30 06:53:24'),
(5, NULL, 'admin3@gmail.com', 'admin3@gmail.com', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, '$2y$10$L.FNjG96QDCc.sn75J7UNeBfKMf6umZQLgWZ6CWqUTPRbHVNwsK4O', NULL, 'RiiCdu4aLj5oQkFrXms0jmHmsyHJMm3u7iWHD5MAedJfDLFEbyzGsneMN8GS', 1, '2019-05-01 03:14:19', '2019-05-01 03:14:19'),
(6, NULL, 'admin@gmail.com', 'admin@gmail.com', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, '$2y$10$yUxp0YS/2yggZ45rb4enCuVqd0DyTTWF.MjDVDff1IXUvGJ3zI2Zm', '360', NULL, 1, '2019-05-09 06:30:19', '2019-05-09 06:38:26'),
(7, NULL, 'mostafiztou@yahoo.com', 'mostafiztou@yahoo.com', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, '$2y$10$x16EF3p5LvvPC7jybZwt9.13VY/BYK7C.CRQpIb3beEWQhGcRV2xC', '362', 'nqUikr0DnR12J5K1YwPWJEJDDFJ9tPNZG45zi2pUQylegAtItHTfluA4GJQR', 1, '2019-05-12 04:09:48', '2019-05-12 07:39:14'),
(8, NULL, 'admin123@gmail.com', 'admin123@gmail.com', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, '$2y$10$R/o6KHpECLJ7iiFNHoqVLOv45Lusl6gxwCjteC.8qkuOBo7eMdZDW', NULL, NULL, 1, '2019-05-13 04:45:14', '2019-05-13 04:45:14');

-- --------------------------------------------------------

--
-- Table structure for table `users_metas`
--

CREATE TABLE `users_metas` (
  `id` int(10) UNSIGNED NOT NULL,
  `user_id` int(11) NOT NULL,
  `meta_key` text NOT NULL,
  `meta_value` longtext,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Dumping data for table `users_metas`
--

INSERT INTO `users_metas` (`id`, `user_id`, `meta_key`, `meta_value`, `created_at`, `updated_at`) VALUES
(1, 2, 'skype', '645', '2019-04-20 04:39:34', '2019-04-20 04:39:34'),
(2, 2, 'user_online_status', '1', '2019-04-21 04:35:04', '2019-04-21 04:35:04'),
(3, 2, 'user_online_status', '1', '2019-04-21 04:35:04', '2019-04-21 04:35:04'),
(4, 2, 'front_user_online_status', '0', '2019-04-24 07:02:16', '2019-04-24 07:02:16'),
(5, 2, 'front_user_last_activity', '2019-05-02 11:29:17', '2019-04-24 07:02:16', '2019-05-02 05:29:17'),
(6, 3, 'front_user_online_status', '0', '2019-04-24 10:31:51', '2019-04-24 10:31:51'),
(7, 3, 'front_user_last_activity', '2019-04-24 05:54:20', '2019-04-24 10:31:51', '2019-04-24 11:54:20'),
(8, 3, 'user_online_status', '1', '2019-04-24 10:46:48', '2019-04-24 10:46:48'),
(9, 4, 'user_online_status', '1', '2019-04-30 09:01:18', '2019-04-30 09:01:18'),
(10, 5, 'front_user_online_status', '0', '2019-05-01 04:12:58', '2019-05-01 04:12:58'),
(11, 5, 'front_user_last_activity', '2019-04-30 11:12:58', '2019-05-01 04:12:58', '2019-05-01 04:12:58'),
(12, 7, 'user_online_status', '1', '2019-05-13 04:44:38', '2019-05-13 04:44:38'),
(13, 7, 'front_user_online_status', '0', '2019-05-13 04:44:53', '2019-05-13 04:44:53'),
(14, 7, 'front_user_last_activity', '2019-05-13 10:44:53', '2019-05-13 04:44:53', '2019-05-13 04:44:53');

-- --------------------------------------------------------

--
-- Table structure for table `visitors`
--

CREATE TABLE `visitors` (
  `id` int(10) UNSIGNED NOT NULL,
  `date` date NOT NULL,
  `views` int(10) UNSIGNED NOT NULL DEFAULT '0'
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Dumping data for table `visitors`
--

INSERT INTO `visitors` (`id`, `date`, `views`) VALUES
(1, '2019-04-18', 1),
(2, '2019-04-20', 2),
(3, '2019-04-21', 11),
(4, '2019-04-22', 4),
(5, '2019-04-23', 9),
(6, '2019-04-24', 25),
(7, '2019-04-25', 2),
(8, '2019-04-27', 3),
(9, '2019-04-28', 10),
(10, '2019-04-29', 3),
(11, '2019-04-30', 26),
(12, '2019-05-01', 7),
(13, '2019-05-02', 6),
(14, '2019-05-04', 6),
(15, '2019-05-05', 4),
(16, '2019-05-05', 1),
(17, '2019-05-05', 1),
(18, '2019-05-06', 4),
(19, '2019-05-07', 1),
(20, '2019-05-08', 2),
(21, '2019-05-09', 1),
(22, '2019-05-12', 1),
(23, '2019-05-13', 2),
(24, '2019-05-14', 1),
(25, '2019-05-15', 2);

-- --------------------------------------------------------

--
-- Table structure for table `wishlists`
--

CREATE TABLE `wishlists` (
  `id` int(10) UNSIGNED NOT NULL,
  `user_id` int(10) UNSIGNED NOT NULL,
  `product_id` int(10) UNSIGNED NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Dumping data for table `wishlists`
--

INSERT INTO `wishlists` (`id`, `user_id`, `product_id`, `created_at`, `updated_at`) VALUES
(1, 2, 4, '2019-04-28 11:44:47', '2019-04-28 11:44:47'),
(9, 6, 24, '2019-05-09 08:09:20', '2019-05-09 08:09:20'),
(10, 6, 25, '2019-05-09 08:09:45', '2019-05-09 08:09:45'),
(60, 7, 23, '2019-05-12 09:53:37', '2019-05-12 09:53:37'),
(61, 7, 24, '2019-05-12 10:01:39', '2019-05-12 10:01:39'),
(62, 8, 23, '2019-05-13 04:49:28', '2019-05-13 04:49:28'),
(63, 8, 20, '2019-05-13 04:49:30', '2019-05-13 04:49:30');

--
-- Indexes for dumped tables
--

--
-- Indexes for table `admins`
--
ALTER TABLE `admins`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `admins_username_unique` (`username`),
  ADD UNIQUE KEY `admins_email_unique` (`email`),
  ADD KEY `admins_firstname_index` (`firstname`),
  ADD KEY `admins_lastname_index` (`lastname`),
  ADD KEY `admins_role_id_index` (`role_id`),
  ADD KEY `admins_status_index` (`status`);

--
-- Indexes for table `admins_metas`
--
ALTER TABLE `admins_metas`
  ADD PRIMARY KEY (`id`),
  ADD KEY `admins_metas_admin_id_index` (`admin_id`);

--
-- Indexes for table `attributes`
--
ALTER TABLE `attributes`
  ADD PRIMARY KEY (`id`),
  ADD KEY `attributes_attributetitle_id_index` (`attributetitle_id`),
  ADD KEY `attributes_title_index` (`title`),
  ADD KEY `attributes_type_index` (`type`),
  ADD KEY `attributes_status_index` (`status`);

--
-- Indexes for table `attributetitles`
--
ALTER TABLE `attributetitles`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `attributetitles_slug_unique` (`slug`),
  ADD KEY `attributetitles_title_index` (`title`),
  ADD KEY `attributetitles_status_index` (`status`);

--
-- Indexes for table `attribute_product`
--
ALTER TABLE `attribute_product`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `blogs`
--
ALTER TABLE `blogs`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `blogs_slug_unique` (`slug`),
  ADD KEY `blogs_title_index` (`title`),
  ADD KEY `blogs_is_sticky_index` (`is_sticky`),
  ADD KEY `blogs_comment_enable_index` (`comment_enable`),
  ADD KEY `blogs_status_index` (`status`);

--
-- Indexes for table `brands`
--
ALTER TABLE `brands`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `brands_slug_unique` (`slug`),
  ADD KEY `brands_title_index` (`title`),
  ADD KEY `brands_status_index` (`status`);

--
-- Indexes for table `categories`
--
ALTER TABLE `categories`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `categories_slug_unique` (`slug`),
  ADD KEY `categories_parent_id_index` (`parent_id`),
  ADD KEY `categories_title_index` (`title`),
  ADD KEY `categories_status_index` (`status`);

--
-- Indexes for table `categoryables`
--
ALTER TABLE `categoryables`
  ADD PRIMARY KEY (`id`),
  ADD KEY `categoryables_category_id_index` (`category_id`),
  ADD KEY `categoryables_categoryable_id_index` (`categoryable_id`);

--
-- Indexes for table `comments`
--
ALTER TABLE `comments`
  ADD PRIMARY KEY (`id`),
  ADD KEY `comments_commentable_id_index` (`commentable_id`),
  ADD KEY `comments_p_c_id_index` (`p_c_id`),
  ADD KEY `comments_created_by_index` (`created_by`),
  ADD KEY `comments_status_index` (`status`);

--
-- Indexes for table `countries`
--
ALTER TABLE `countries`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `code` (`code`);

--
-- Indexes for table `coupons`
--
ALTER TABLE `coupons`
  ADD PRIMARY KEY (`id`),
  ADD KEY `coupons_status_index` (`status`);

--
-- Indexes for table `likes`
--
ALTER TABLE `likes`
  ADD PRIMARY KEY (`id`),
  ADD KEY `likes_liker_id_index` (`liker_id`),
  ADD KEY `likes_liker_ip_index` (`liker_ip`),
  ADD KEY `likes_likeable_id_index` (`likeable_id`),
  ADD KEY `likes_likeable_type_index` (`likeable_type`),
  ADD KEY `likes_status_index` (`status`);

--
-- Indexes for table `media`
--
ALTER TABLE `media`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `media_slug_unique` (`slug`),
  ADD KEY `media_is_private_index` (`is_private`),
  ADD KEY `media_title_index` (`title`);

--
-- Indexes for table `media_permissions`
--
ALTER TABLE `media_permissions`
  ADD PRIMARY KEY (`id`),
  ADD KEY `media_permissions_media_id_index` (`media_id`),
  ADD KEY `media_permissions_user_id_index` (`user_id`);

--
-- Indexes for table `migrations`
--
ALTER TABLE `migrations`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `orders`
--
ALTER TABLE `orders`
  ADD PRIMARY KEY (`id`),
  ADD KEY `orders_user_id_index` (`user_id`),
  ADD KEY `orders_grand_total_index` (`grand_total`),
  ADD KEY `orders_paid_index` (`paid`),
  ADD KEY `orders_payment_method_id_index` (`payment_method_id`),
  ADD KEY `orders_order_status_index` (`order_status`),
  ADD KEY `orders_payment_status_index` (`payment_status`);

--
-- Indexes for table `order_details`
--
ALTER TABLE `order_details`
  ADD PRIMARY KEY (`id`),
  ADD KEY `order_details_order_id_index` (`order_id`),
  ADD KEY `order_details_product_id_index` (`product_id`);

--
-- Indexes for table `pages`
--
ALTER TABLE `pages`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `pages_slug_unique` (`slug`),
  ADD KEY `pages_menu_title_index` (`menu_title`),
  ADD KEY `pages_page_title_index` (`page_title`),
  ADD KEY `pages_views_index` (`views`),
  ADD KEY `pages_created_by_index` (`created_by`),
  ADD KEY `pages_status_index` (`status`);

--
-- Indexes for table `password_resets`
--
ALTER TABLE `password_resets`
  ADD KEY `password_resets_email_index` (`email`);

--
-- Indexes for table `payments`
--
ALTER TABLE `payments`
  ADD PRIMARY KEY (`id`),
  ADD KEY `payments_status_index` (`status`);

--
-- Indexes for table `payment_methods`
--
ALTER TABLE `payment_methods`
  ADD PRIMARY KEY (`id`),
  ADD KEY `payment_methods_status_index` (`status`);

--
-- Indexes for table `products`
--
ALTER TABLE `products`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `products_slug_unique` (`slug`),
  ADD UNIQUE KEY `products_sku_unique` (`sku`),
  ADD KEY `products_title_index` (`title`),
  ADD KEY `products_brand_id_index` (`brand_id`),
  ADD KEY `products_unit_id_index` (`unit_id`),
  ADD KEY `products_status_index` (`status`);

--
-- Indexes for table `reviews`
--
ALTER TABLE `reviews`
  ADD PRIMARY KEY (`id`),
  ADD KEY `product_reviews_product_id_foreign` (`product_id`),
  ADD KEY `product_reviews_status_index` (`status`);

--
-- Indexes for table `roles`
--
ALTER TABLE `roles`
  ADD PRIMARY KEY (`id`),
  ADD KEY `roles_name_index` (`name`),
  ADD KEY `roles_created_by_index` (`created_by`),
  ADD KEY `roles_status_index` (`status`);

--
-- Indexes for table `settings`
--
ALTER TABLE `settings`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `settings_option_name_unique` (`option_name`),
  ADD KEY `settings_created_by_index` (`created_by`),
  ADD KEY `settings_autoload_index` (`autoload`),
  ADD KEY `settings_status_index` (`status`);

--
-- Indexes for table `shipping_methods`
--
ALTER TABLE `shipping_methods`
  ADD PRIMARY KEY (`id`),
  ADD KEY `shipping_methods_status_index` (`status`);

--
-- Indexes for table `shoppingcart`
--
ALTER TABLE `shoppingcart`
  ADD PRIMARY KEY (`identifier`,`instance`);

--
-- Indexes for table `sliders`
--
ALTER TABLE `sliders`
  ADD PRIMARY KEY (`id`),
  ADD KEY `sliders_created_by_index` (`created_by`),
  ADD KEY `sliders_status_index` (`status`);

--
-- Indexes for table `subscribers`
--
ALTER TABLE `subscribers`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `subscribers_email_unique` (`email`),
  ADD KEY `subscribers_firstname_index` (`firstname`),
  ADD KEY `subscribers_lastname_index` (`lastname`),
  ADD KEY `subscribers_status_index` (`status`);

--
-- Indexes for table `taggables`
--
ALTER TABLE `taggables`
  ADD PRIMARY KEY (`id`),
  ADD KEY `taggables_tag_id_index` (`tag_id`),
  ADD KEY `taggables_taggable_id_index` (`taggable_id`);

--
-- Indexes for table `tags`
--
ALTER TABLE `tags`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `tags_slug_unique` (`slug`),
  ADD KEY `tags_title_index` (`title`),
  ADD KEY `tags_created_by_index` (`created_by`),
  ADD KEY `tags_status_index` (`status`);

--
-- Indexes for table `taxes`
--
ALTER TABLE `taxes`
  ADD PRIMARY KEY (`id`),
  ADD KEY `taxes_status_index` (`status`);

--
-- Indexes for table `units`
--
ALTER TABLE `units`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `units_slug_unique` (`slug`),
  ADD KEY `units_status_index` (`status`);

--
-- Indexes for table `users`
--
ALTER TABLE `users`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `users_username_unique` (`username`),
  ADD UNIQUE KEY `users_email_unique` (`email`),
  ADD KEY `users_firstname_index` (`firstname`),
  ADD KEY `users_lastname_index` (`lastname`),
  ADD KEY `users_company_index` (`company`),
  ADD KEY `users_billing_firstname_index` (`billing_firstname`),
  ADD KEY `users_billing_lastname_index` (`billing_lastname`),
  ADD KEY `users_billing_company_index` (`billing_company`),
  ADD KEY `users_job_title_index` (`job_title`),
  ADD KEY `users_status_index` (`status`),
  ADD KEY `users_auth_id_index` (`auth_id`);

--
-- Indexes for table `users_metas`
--
ALTER TABLE `users_metas`
  ADD PRIMARY KEY (`id`),
  ADD KEY `users_metas_user_id_index` (`user_id`);

--
-- Indexes for table `visitors`
--
ALTER TABLE `visitors`
  ADD PRIMARY KEY (`id`),
  ADD KEY `visitors_date_index` (`date`);

--
-- Indexes for table `wishlists`
--
ALTER TABLE `wishlists`
  ADD PRIMARY KEY (`id`),
  ADD KEY `wishlists_user_id_foreign` (`user_id`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `admins`
--
ALTER TABLE `admins`
  MODIFY `id` int(10) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2;

--
-- AUTO_INCREMENT for table `admins_metas`
--
ALTER TABLE `admins_metas`
  MODIFY `id` int(10) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=3;

--
-- AUTO_INCREMENT for table `attributes`
--
ALTER TABLE `attributes`
  MODIFY `id` int(10) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=12;

--
-- AUTO_INCREMENT for table `attributetitles`
--
ALTER TABLE `attributetitles`
  MODIFY `id` int(10) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=3;

--
-- AUTO_INCREMENT for table `attribute_product`
--
ALTER TABLE `attribute_product`
  MODIFY `id` int(10) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=115;

--
-- AUTO_INCREMENT for table `blogs`
--
ALTER TABLE `blogs`
  MODIFY `id` int(10) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=4;

--
-- AUTO_INCREMENT for table `brands`
--
ALTER TABLE `brands`
  MODIFY `id` int(10) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=5;

--
-- AUTO_INCREMENT for table `categories`
--
ALTER TABLE `categories`
  MODIFY `id` int(10) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=26;

--
-- AUTO_INCREMENT for table `categoryables`
--
ALTER TABLE `categoryables`
  MODIFY `id` int(10) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=45;

--
-- AUTO_INCREMENT for table `comments`
--
ALTER TABLE `comments`
  MODIFY `id` int(10) UNSIGNED NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `countries`
--
ALTER TABLE `countries`
  MODIFY `id` int(5) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=242;

--
-- AUTO_INCREMENT for table `coupons`
--
ALTER TABLE `coupons`
  MODIFY `id` int(10) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=4;

--
-- AUTO_INCREMENT for table `likes`
--
ALTER TABLE `likes`
  MODIFY `id` int(10) UNSIGNED NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `media`
--
ALTER TABLE `media`
  MODIFY `id` int(10) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=375;

--
-- AUTO_INCREMENT for table `media_permissions`
--
ALTER TABLE `media_permissions`
  MODIFY `id` int(10) UNSIGNED NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `migrations`
--
ALTER TABLE `migrations`
  MODIFY `id` int(10) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=43;

--
-- AUTO_INCREMENT for table `orders`
--
ALTER TABLE `orders`
  MODIFY `id` int(10) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=31;

--
-- AUTO_INCREMENT for table `order_details`
--
ALTER TABLE `order_details`
  MODIFY `id` int(10) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=5;

--
-- AUTO_INCREMENT for table `pages`
--
ALTER TABLE `pages`
  MODIFY `id` int(10) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2;

--
-- AUTO_INCREMENT for table `payments`
--
ALTER TABLE `payments`
  MODIFY `id` int(10) UNSIGNED NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `payment_methods`
--
ALTER TABLE `payment_methods`
  MODIFY `id` int(10) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=6;

--
-- AUTO_INCREMENT for table `products`
--
ALTER TABLE `products`
  MODIFY `id` int(10) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=27;

--
-- AUTO_INCREMENT for table `reviews`
--
ALTER TABLE `reviews`
  MODIFY `id` int(10) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=3;

--
-- AUTO_INCREMENT for table `roles`
--
ALTER TABLE `roles`
  MODIFY `id` int(10) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2;

--
-- AUTO_INCREMENT for table `settings`
--
ALTER TABLE `settings`
  MODIFY `id` int(10) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=60;

--
-- AUTO_INCREMENT for table `shipping_methods`
--
ALTER TABLE `shipping_methods`
  MODIFY `id` int(10) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=4;

--
-- AUTO_INCREMENT for table `sliders`
--
ALTER TABLE `sliders`
  MODIFY `id` int(10) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=5;

--
-- AUTO_INCREMENT for table `subscribers`
--
ALTER TABLE `subscribers`
  MODIFY `id` int(10) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=10;

--
-- AUTO_INCREMENT for table `taggables`
--
ALTER TABLE `taggables`
  MODIFY `id` int(10) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=23;

--
-- AUTO_INCREMENT for table `tags`
--
ALTER TABLE `tags`
  MODIFY `id` int(10) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=11;

--
-- AUTO_INCREMENT for table `taxes`
--
ALTER TABLE `taxes`
  MODIFY `id` int(10) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2;

--
-- AUTO_INCREMENT for table `units`
--
ALTER TABLE `units`
  MODIFY `id` int(10) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2;

--
-- AUTO_INCREMENT for table `users`
--
ALTER TABLE `users`
  MODIFY `id` int(10) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=9;

--
-- AUTO_INCREMENT for table `users_metas`
--
ALTER TABLE `users_metas`
  MODIFY `id` int(10) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=15;

--
-- AUTO_INCREMENT for table `visitors`
--
ALTER TABLE `visitors`
  MODIFY `id` int(10) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=26;

--
-- AUTO_INCREMENT for table `wishlists`
--
ALTER TABLE `wishlists`
  MODIFY `id` int(10) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=64;

--
-- Constraints for dumped tables
--

--
-- Constraints for table `attributes`
--
ALTER TABLE `attributes`
  ADD CONSTRAINT `attributes_attributetitle_id_foreign` FOREIGN KEY (`attributetitle_id`) REFERENCES `attributetitles` (`id`) ON DELETE CASCADE;

--
-- Constraints for table `orders`
--
ALTER TABLE `orders`
  ADD CONSTRAINT `orders_user_id_foreign` FOREIGN KEY (`user_id`) REFERENCES `users` (`id`) ON DELETE CASCADE;

--
-- Constraints for table `order_details`
--
ALTER TABLE `order_details`
  ADD CONSTRAINT `order_details_order_id_foreign` FOREIGN KEY (`order_id`) REFERENCES `orders` (`id`) ON DELETE CASCADE;

--
-- Constraints for table `reviews`
--
ALTER TABLE `reviews`
  ADD CONSTRAINT `product_reviews_product_id_foreign` FOREIGN KEY (`product_id`) REFERENCES `products` (`id`) ON DELETE CASCADE;

--
-- Constraints for table `wishlists`
--
ALTER TABLE `wishlists`
  ADD CONSTRAINT `wishlists_user_id_foreign` FOREIGN KEY (`user_id`) REFERENCES `users` (`id`) ON DELETE CASCADE;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
