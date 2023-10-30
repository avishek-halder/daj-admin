-- phpMyAdmin SQL Dump
-- version 4.8.5
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Generation Time: Oct 30, 2023 at 06:18 PM
-- Server version: 10.1.38-MariaDB
-- PHP Version: 7.3.2

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
SET AUTOCOMMIT = 0;
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `daj_home`
--

-- --------------------------------------------------------

--
-- Table structure for table `admin_menus`
--

CREATE TABLE `admin_menus` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `name` varchar(255) NOT NULL,
  `type` varchar(255) NOT NULL,
  `path` varchar(255) DEFAULT NULL,
  `icon` varchar(255) DEFAULT NULL,
  `parent_id` bigint(20) UNSIGNED DEFAULT NULL,
  `is_active` tinyint(4) NOT NULL DEFAULT '1',
  `sorting` int(11) DEFAULT NULL,
  `sql_query` text,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `admin_menus`
--

INSERT INTO `admin_menus` (`id`, `name`, `type`, `path`, `icon`, `parent_id`, `is_active`, `sorting`, `sql_query`, `created_at`, `updated_at`) VALUES
(1, 'Settings', 'Route', 'getGeneralSettings', 'fa fa-cog', 0, 0, 20, NULL, '2023-07-28 08:52:14', '2023-08-28 07:30:48'),
(2, 'Manage CMS', 'Route', 'getManageCMS', 'fa fa-th-list', 0, 1, 26, NULL, '2023-07-28 09:06:31', '2023-09-21 10:35:15'),
(5, 'FAQ Category', 'Route', 'getManageFaqCategory', NULL, 4, 1, 1, NULL, '2023-07-31 07:00:24', '2023-08-02 13:10:02'),
(6, 'FAQ Lists', 'Route', 'getManageFaq', NULL, 4, 1, 2, NULL, '2023-07-31 07:01:50', '2023-08-02 13:10:13'),
(10, 'How It Works', 'Route', 'getHowitworks', NULL, 12, 1, 8, NULL, '2023-08-08 14:21:33', '2023-08-10 11:19:39'),
(13, 'About Us', 'Route', 'getHomeAbout', NULL, 12, 1, 9, NULL, '2023-08-10 12:04:48', NULL),
(17, 'Category', 'Route', 'getBlogCategoryIndex', NULL, 16, 1, 1, NULL, '2023-08-26 11:41:24', NULL),
(19, 'Manage Users', 'Route', 'users.index', 'fa fa-users', 0, 1, 1, 'SELECT COUNT(*) as total FROM users', '2023-08-28 07:36:15', '2023-10-29 11:30:28');

-- --------------------------------------------------------

--
-- Table structure for table `admin_privileges`
--

CREATE TABLE `admin_privileges` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `name` varchar(50) NOT NULL,
  `is_superadmin` tinyint(4) NOT NULL,
  `created_by` bigint(20) UNSIGNED NOT NULL,
  `updated_by` bigint(20) UNSIGNED DEFAULT NULL,
  `user_ip` varchar(45) DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `admin_privileges`
--

INSERT INTO `admin_privileges` (`id`, `name`, `is_superadmin`, `created_by`, `updated_by`, `user_ip`, `created_at`, `updated_at`) VALUES
(1, 'super Admin', 1, 1, 1, '45.64.237.122', '2023-07-28 07:38:43', '2023-09-01 07:16:41'),
(2, 'Admin', 0, 1, 1, '127.0.0.1', '2023-08-28 07:34:00', '2023-10-29 12:26:15');

-- --------------------------------------------------------

--
-- Table structure for table `admin_privileges_roles`
--

CREATE TABLE `admin_privileges_roles` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `id_admin_privileges` bigint(20) UNSIGNED NOT NULL,
  `id_admin_menus` int(11) DEFAULT NULL,
  `is_visible` tinyint(4) DEFAULT NULL,
  `is_create` tinyint(4) DEFAULT NULL,
  `is_read` tinyint(4) DEFAULT NULL,
  `is_edit` tinyint(4) DEFAULT NULL,
  `is_delete` tinyint(4) DEFAULT NULL,
  `created_by` bigint(20) UNSIGNED NOT NULL,
  `updated_by` bigint(20) UNSIGNED DEFAULT NULL,
  `user_ip` varchar(45) DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `admin_privileges_roles`
--

INSERT INTO `admin_privileges_roles` (`id`, `id_admin_privileges`, `id_admin_menus`, `is_visible`, `is_create`, `is_read`, `is_edit`, `is_delete`, `created_by`, `updated_by`, `user_ip`, `created_at`, `updated_at`) VALUES
(268, 1, 2, 1, 1, 1, 1, 1, 1, NULL, NULL, '2023-09-01 07:16:41', NULL),
(274, 1, 1, 1, 1, 1, 1, 1, 1, NULL, NULL, '2023-09-01 07:16:41', NULL),
(275, 1, 19, 1, 1, 1, 1, 1, 1, NULL, NULL, '2023-09-01 07:16:41', NULL),
(278, 1, 5, 1, 1, 1, 1, 1, 1, NULL, NULL, '2023-09-01 07:16:41', NULL),
(279, 1, 6, 1, 1, 1, 1, 1, 1, NULL, NULL, '2023-09-01 07:16:41', NULL),
(280, 1, 14, 1, 1, 1, 1, 1, 1, NULL, NULL, '2023-09-01 07:16:41', NULL),
(281, 1, 10, 1, 1, 1, 1, 1, 1, NULL, NULL, '2023-09-01 07:16:41', NULL),
(282, 1, 13, 1, 1, 1, 1, 1, 1, NULL, NULL, '2023-09-01 07:16:41', NULL),
(283, 1, 11, 1, 1, 1, 1, 1, 1, NULL, NULL, '2023-09-01 07:16:41', NULL),
(284, 1, 17, 1, 1, 1, 1, 1, 1, NULL, NULL, '2023-09-01 07:16:41', NULL),
(285, 1, 18, 1, 1, 1, 1, 1, 1, NULL, NULL, '2023-09-01 07:16:41', NULL),
(331, 2, 19, 1, 1, 1, 1, 1, 1, NULL, NULL, '2023-10-29 12:26:15', NULL),
(332, 2, 2, 1, 1, 1, 1, 1, 1, NULL, NULL, '2023-10-29 12:26:15', NULL);

-- --------------------------------------------------------

--
-- Table structure for table `admin_settings`
--

CREATE TABLE `admin_settings` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `appname` varchar(255) NOT NULL,
  `logo` varchar(255) DEFAULT NULL,
  `favicon` varchar(255) DEFAULT NULL,
  `site_email` varchar(255) DEFAULT NULL,
  `site_address` varchar(255) DEFAULT NULL,
  `site_phone_number` varchar(255) DEFAULT NULL,
  `site_about` text,
  `facebook_link` varchar(255) DEFAULT NULL,
  `instagram_link` varchar(255) DEFAULT NULL,
  `twitter_link` varchar(255) DEFAULT NULL,
  `linkedin_link` varchar(255) DEFAULT NULL,
  `youtube_link` varchar(255) DEFAULT NULL,
  `maintenance_mode` tinyint(4) NOT NULL DEFAULT '0',
  `created_by` bigint(20) UNSIGNED NOT NULL,
  `updated_by` bigint(20) UNSIGNED DEFAULT NULL,
  `user_ip` varchar(45) DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `admin_settings`
--

INSERT INTO `admin_settings` (`id`, `appname`, `logo`, `favicon`, `site_email`, `site_address`, `site_phone_number`, `site_about`, `facebook_link`, `instagram_link`, `twitter_link`, `linkedin_link`, `youtube_link`, `maintenance_mode`, `created_by`, `updated_by`, `user_ip`, `created_at`, `updated_at`) VALUES
(1, 'Otobix', 'uploads/site/logo/logo-1690554300.png', 'uploads/site/favicon/favicon-1690554325.png', 'info@otobix.in', 'Merlin Infinite, Room 609,DN 51, Salt Lake \r\nSector V,Kolkata - 700091', '+91 90888 22999', NULL, 'https://www.facebook.com/otobixtechnologies?mibextid=LQQJ4d', 'https://www.instagram.com/otobixtechnologies/', 'https://twitter.com/otobixt?s=11', 'https://in.linkedin.com/company/otobix', NULL, 0, 1, 1, '::1', '2023-07-28 08:55:25', '2023-07-28 09:11:43');

-- --------------------------------------------------------

--
-- Table structure for table `admin_users`
--

CREATE TABLE `admin_users` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `name` varchar(255) NOT NULL,
  `photo` varchar(255) DEFAULT NULL,
  `email` varchar(255) NOT NULL,
  `password` varchar(255) NOT NULL,
  `id_admin_privileges` bigint(20) UNSIGNED NOT NULL,
  `created_by` bigint(20) UNSIGNED NOT NULL,
  `updated_by` bigint(20) UNSIGNED DEFAULT NULL,
  `user_ip` varchar(45) DEFAULT NULL,
  `status` tinyint(4) NOT NULL DEFAULT '1',
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `admin_users`
--

INSERT INTO `admin_users` (`id`, `name`, `photo`, `email`, `password`, `id_admin_privileges`, `created_by`, `updated_by`, `user_ip`, `status`, `created_at`, `updated_at`) VALUES
(1, 'Super Admin', 'uploads/images/profile/img-1698596126.jpg', 'superadmin@gmail.com', '$2y$10$qqH3YtQY28Sthdw93Ns0YeLIAmCyCtgCN8aLxeMfsFjC0imOn6AVe', 1, 1, 1, NULL, 1, '2023-07-28 07:38:44', '2023-10-29 10:45:26'),
(2, 'Admin', 'uploads/images/profile/img-1698596370.jpg', 'admin@gmail.com', '$2y$10$WZqwOrQGJZdtNcARDW4Im.C7y1Dnr7Ddz9mHe7yGIXWD6zDJvlwVC', 2, 1, NULL, NULL, 1, '2023-08-28 07:34:22', '2023-10-29 10:49:30');

-- --------------------------------------------------------

--
-- Table structure for table `cities`
--

CREATE TABLE `cities` (
  `id` bigint(20) NOT NULL,
  `name` varchar(200) NOT NULL,
  `country_id` varchar(200) NOT NULL,
  `status` tinyint(4) NOT NULL,
  `updated_at` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP,
  `created_at` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `cities`
--

INSERT INTO `cities` (`id`, `name`, `country_id`, `status`, `updated_at`, `created_at`) VALUES
(1, 'Bombuflat', '1', 1, '2023-09-02 07:04:44', '2023-09-02 07:04:44'),
(2, 'Garacharma', '1', 1, '2023-09-02 07:04:44', '2023-09-02 07:04:44'),
(3, 'Port Blair', '2', 1, '2023-09-02 07:04:44', '2023-09-02 07:04:44'),
(4, 'Rangat', '3', 1, '2023-09-02 07:04:44', '2023-09-02 07:04:44'),
(5, 'Addanki', '3', 2, '2023-09-02 07:04:44', '2023-09-02 07:04:44'),
(6, 'Adivivaram', '4', 2, '2023-09-02 07:04:44', '2023-09-02 07:04:44'),
(7, 'Adoni', '4', 2, '2023-09-02 07:04:44', '2023-09-02 07:04:44');

-- --------------------------------------------------------

--
-- Table structure for table `cms_logs`
--

CREATE TABLE `cms_logs` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `ipaddress` varchar(50) DEFAULT NULL,
  `useragent` varchar(255) DEFAULT NULL,
  `url` varchar(255) DEFAULT NULL,
  `description` varchar(255) DEFAULT NULL,
  `details` text,
  `id_cms_users` int(11) DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `cms_logs`
--

INSERT INTO `cms_logs` (`id`, `ipaddress`, `useragent`, `url`, `description`, `details`, `id_cms_users`, `created_at`, `updated_at`) VALUES
(1, '::1', 'Mozilla/5.0 (Windows NT 10.0; Win64; x64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/115.0.0.0 Safari/537.36', 'http://localhost/amit_otobix/public/admin/faq-list/action-selected', 'Updated data 2 by Admin ip: ::1', '', 1, '2023-07-31 08:05:00', NULL),
(2, '::1', 'Mozilla/5.0 (Windows NT 10.0; Win64; x64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/115.0.0.0 Safari/537.36', 'http://localhost/amit_otobix/public/admin/faq-list/action-selected', 'Updated data 2 by Admin ip: ::1', '', 1, '2023-07-31 08:05:25', NULL),
(3, '::1', 'Mozilla/5.0 (Windows NT 10.0; Win64; x64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/115.0.0.0 Safari/537.36', 'http://localhost/amit_otobix/public/admin/faq-list/action-selected', 'Updated data 2 by Admin ip: ::1', '', 1, '2023-07-31 08:05:29', NULL),
(4, '45.121.111.84', 'Mozilla/5.0 (Windows NT 10.0; Win64; x64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/115.0.0.0 Safari/537.36', 'https://developer-beta.com/p5/otobix/admin/logout', 'admin@gmail.com logout', '', 1, '2023-08-02 12:17:48', NULL),
(5, '45.64.237.122', 'Mozilla/5.0 (Windows NT 10.0; Win64; x64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/115.0.0.0 Safari/537.36', 'https://developer-beta.com/p5/otobix/admin/logout', 'admin@gmail.com logout', '', 1, '2023-08-02 12:20:29', NULL),
(6, '45.121.111.84', 'Mozilla/5.0 (Windows NT 10.0; Win64; x64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/115.0.0.0 Safari/537.36', 'https://developer-beta.com/p5/otobix/admin/logout', 'admin@gmail.com logout', '', 1, '2023-08-02 12:20:31', NULL),
(7, '45.121.111.84', 'Mozilla/5.0 (Windows NT 10.0; Win64; x64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/115.0.0.0 Safari/537.36', 'https://developer-beta.com/p5/otobix/admin/logout', 'admin@gmail.com logout', '', 1, '2023-08-02 12:22:49', NULL),
(8, '45.121.111.34', 'Mozilla/5.0 (Windows NT 10.0; Win64; x64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/116.0.0.0 Safari/537.36', 'https://developer-beta.com/p5/otobix/admin/manage-blog-category/action-selected', 'Updated data 1 by Admin ip: 45.121.111.34', '', 1, '2023-08-26 11:46:22', NULL),
(9, '45.121.111.34', 'Mozilla/5.0 (Windows NT 10.0; Win64; x64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/116.0.0.0 Safari/537.36', 'https://developer-beta.com/p5/otobix/admin/manage-blog-category/action-selected', 'Updated data 1 by Admin ip: 45.121.111.34', '', 1, '2023-08-26 11:46:28', NULL),
(10, '45.121.111.34', 'Mozilla/5.0 (Windows NT 10.0; Win64; x64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/116.0.0.0 Safari/537.36', 'https://developer-beta.com/p5/otobix/admin/manage-blog-category/action-selected', 'Updated data 1 by Admin ip: 45.121.111.34', '', 1, '2023-08-26 11:46:32', NULL),
(11, '157.34.38.57', 'Mozilla/5.0 (Windows NT 10.0; Win64; x64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/116.0.0.0 Safari/537.36', 'http://3.109.133.36/p3/real_estate/admin/logout', 'superadmin@gmail.com logout', '', 1, '2023-08-28 07:31:38', NULL),
(12, '157.34.38.57', 'Mozilla/5.0 (Windows NT 10.0; Win64; x64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/116.0.0.0 Safari/537.36', 'http://3.109.133.36/p3/real_estate/admin/logout', 'superadmin@gmail.com logout', '', 1, '2023-08-28 07:34:37', NULL),
(13, '157.34.38.57', 'Mozilla/5.0 (Windows NT 10.0; Win64; x64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/116.0.0.0 Safari/537.36', 'http://3.109.133.36/p3/real_estate/admin/logout', 'admin@gmail.com logout', '', 2, '2023-08-28 07:35:01', NULL),
(14, '103.121.117.98', 'Mozilla/5.0 (X11; Linux x86_64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/100.0.4896.88 Safari/537.36', 'http://3.109.133.36/p3/real_estate/admin/logout', 'superadmin@gmail.com logout', '', 1, '2023-09-01 04:58:03', NULL),
(15, '45.64.237.122', 'Mozilla/5.0 (X11; Linux x86_64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/100.0.4896.88 Safari/537.36', 'http://3.109.133.36/p3/real_estate/admin/logout', 'admin@gmail.com logout', '', 2, '2023-09-01 04:58:22', NULL),
(16, '45.64.237.122', 'Mozilla/5.0 (Windows NT 10.0; Win64; x64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/116.0.0.0 Safari/537.36', 'http://3.109.133.36/p3/real_estate/admin/manage-subcriptions/action-selected', 'Updated data 1 by admin ip: 45.64.237.122', '', 2, '2023-09-01 07:06:19', NULL),
(17, '103.121.117.98', 'Mozilla/5.0 (Windows NT 10.0; Win64; x64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/116.0.0.0 Safari/537.36', 'http://3.109.133.36/p3/real_estate/admin/manage-subcriptions/action-selected', 'Updated data 1 by admin ip: 103.121.117.98', '', 2, '2023-09-01 07:06:29', NULL),
(18, '45.64.237.122', 'Mozilla/5.0 (Windows NT 10.0; Win64; x64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/116.0.0.0 Safari/537.36', 'http://3.109.133.36/p3/real_estate/admin/manage-subcriptions/action-selected', 'Updated data 1 by admin ip: 45.64.237.122', '', 2, '2023-09-01 07:11:16', NULL),
(19, '45.64.237.122', 'Mozilla/5.0 (Windows NT 10.0; Win64; x64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/116.0.0.0 Safari/537.36', 'http://3.109.133.36/p3/real_estate/admin/manage-subcriptions/action-selected', 'Updated data 1 by admin ip: 45.64.237.122', '', 2, '2023-09-01 07:14:44', NULL),
(20, '103.121.117.98', 'Mozilla/5.0 (Windows NT 10.0; Win64; x64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/116.0.0.0 Safari/537.36', 'http://3.109.133.36/p3/real_estate/admin/manage-subcriptions/action-selected', 'Updated data 1 by super Admin ip: 103.121.117.98', '', 1, '2023-09-01 07:27:58', NULL),
(21, '45.64.237.122', 'Mozilla/5.0 (X11; Linux x86_64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/100.0.4896.88 Safari/537.36', 'http://3.109.133.36/p3/real_estate/admin/manage-subcriptions/action-selected', 'Updated data 2,1 by super Admin ip: 45.64.237.122', '', 1, '2023-09-01 08:06:01', NULL),
(22, '45.64.237.122', 'Mozilla/5.0 (X11; Linux x86_64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/100.0.4896.88 Safari/537.36', 'http://3.109.133.36/p3/real_estate/admin/manage-subcriptions/action-selected', 'Updated data 2,1 by super Admin ip: 45.64.237.122', '', 1, '2023-09-01 08:06:08', NULL),
(23, '103.121.117.98', 'Mozilla/5.0 (X11; Linux x86_64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/100.0.4896.88 Safari/537.36', 'http://3.109.133.36/p3/real_estate/admin/manage-subcriptions/action-selected', 'Updated data 2,1 by super Admin ip: 103.121.117.98', '', 1, '2023-09-01 08:07:26', NULL),
(24, '103.121.117.98', 'Mozilla/5.0 (Windows NT 10.0; Win64; x64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/116.0.0.0 Safari/537.36', 'http://3.109.133.36/p3/real_estate/admin/manage-subscriptions/action-selected', 'Updated data 2 by admin ip: 103.121.117.98', '', 2, '2023-09-01 09:01:00', NULL),
(25, '45.64.237.122', 'Mozilla/5.0 (Windows NT 10.0; Win64; x64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/116.0.0.0 Safari/537.36', 'http://3.109.133.36/p3/real_estate/admin/manage-property/action-selected', 'Updated data 17 by admin ip: 45.64.237.122', '', 2, '2023-09-02 10:15:16', NULL),
(26, '103.121.117.98', 'Mozilla/5.0 (Windows NT 10.0; Win64; x64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/116.0.0.0 Safari/537.36', 'http://3.109.133.36/p3/real_estate/admin/manage-country/action-selected', 'Updated data 13 by admin ip: 103.121.117.98', '', 2, '2023-09-02 11:42:51', NULL),
(27, '45.64.237.122', 'Mozilla/5.0 (Windows NT 10.0; Win64; x64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/116.0.0.0 Safari/537.36', 'http://3.109.133.36/p3/real_estate/admin/manage-country/action-selected', 'Updated data 13 by admin ip: 45.64.237.122', '', 2, '2023-09-02 11:42:57', NULL),
(28, '45.64.237.122', 'Mozilla/5.0 (Windows NT 10.0; Win64; x64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/116.0.0.0 Safari/537.36', 'http://3.109.133.36/p3/real_estate/admin/logout', 'admin@gmail.com logout', '', 2, '2023-09-05 06:52:03', NULL),
(29, '103.121.117.98', 'Mozilla/5.0 (Windows NT 10.0; Win64; x64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/116.0.0.0 Safari/537.36', 'http://3.109.133.36/p3/real_estate/admin/logout', 'admin@gmail.com logout', '', 2, '2023-09-07 05:31:24', NULL),
(30, '103.121.117.98', 'Mozilla/5.0 (X11; Linux x86_64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/100.0.4896.88 Safari/537.36', 'http://3.109.133.36/p3/real_estate/admin/manage-user/action-selected', 'Updated data 1 by admin ip: 103.121.117.98', '', 2, '2023-09-07 07:08:25', NULL),
(31, '103.121.117.98', 'Mozilla/5.0 (X11; Linux x86_64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/100.0.4896.88 Safari/537.36', 'http://3.109.133.36/p3/real_estate/admin/manage-user/action-selected', 'Updated data 7,6 by admin ip: 103.121.117.98', '', 2, '2023-09-07 07:08:53', NULL),
(32, '103.121.117.98', 'Mozilla/5.0 (X11; Linux x86_64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/100.0.4896.88 Safari/537.36', 'http://3.109.133.36/p3/real_estate/admin/manage-user/action-selected', 'Updated data 7,6 by admin ip: 103.121.117.98', '', 2, '2023-09-07 07:08:58', NULL),
(33, '103.121.117.98', 'Mozilla/5.0 (Windows NT 10.0; Win64; x64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/116.0.0.0 Safari/537.36', 'http://3.109.133.36/p3/real_estate/admin/logout', 'admin@gmail.com logout', '', 2, '2023-09-07 07:18:54', NULL),
(34, '103.121.117.98', 'Mozilla/5.0 (Windows NT 10.0; Win64; x64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/116.0.0.0 Safari/537.36', 'http://3.7.220.246/p3/real_estate/admin/logout', 'admin@gmail.com logout', '', 2, '2023-09-07 11:50:33', NULL),
(35, '103.121.117.98', 'Mozilla/5.0 (Windows NT 10.0; Win64; x64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/116.0.0.0 Safari/537.36', 'http://3.7.220.246/p3/real_estate/admin/logout', 'admin@gmail.com logout', '', 2, '2023-09-07 12:13:14', NULL),
(36, '45.64.237.122', 'Mozilla/5.0 (Windows NT 10.0; Win64; x64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/116.0.0.0 Safari/537.36', 'http://3.7.220.246/p3/real_estate/admin/logout', 'admin@gmail.com logout', '', 2, '2023-09-07 12:29:47', NULL),
(37, '45.64.237.122', 'Mozilla/5.0 (X11; Linux x86_64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/116.0.0.0 Safari/537.36', 'http://3.7.220.246/p3/real_estate/admin/manage-property/action-selected', 'Updated data 20,19 by admin ip: 45.64.237.122', '', 2, '2023-09-07 12:45:57', NULL),
(38, '45.64.237.122', 'Mozilla/5.0 (X11; Linux x86_64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/116.0.0.0 Safari/537.36', 'http://3.7.220.246/p3/real_estate/admin/manage-property/action-selected', 'Updated data 20,19,17 by admin ip: 45.64.237.122', '', 2, '2023-09-07 12:46:05', NULL),
(39, '45.64.237.122', 'Mozilla/5.0 (X11; Linux x86_64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/116.0.0.0 Safari/537.36', 'http://3.7.220.246/p3/real_estate/admin/manage-property/action-selected', 'Updated data 20,19,17 by admin ip: 45.64.237.122', '', 2, '2023-09-07 12:46:18', NULL),
(40, '103.121.117.98', 'Mozilla/5.0 (X11; Linux x86_64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/116.0.0.0 Safari/537.36', 'http://3.7.220.246/p3/real_estate/admin/manage-property/action-selected', 'Updated data 22 by admin ip: 103.121.117.98', '', 2, '2023-09-07 12:48:44', NULL),
(41, '103.121.117.98', 'Mozilla/5.0 (X11; Linux x86_64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/116.0.0.0 Safari/537.36', 'http://3.7.220.246/p3/real_estate/admin/manage-property/action-selected', 'Updated data 22,20,19,17 by admin ip: 103.121.117.98', '', 2, '2023-09-07 12:49:07', NULL),
(42, '45.64.237.122', 'Mozilla/5.0 (X11; Linux x86_64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/116.0.0.0 Safari/537.36', 'http://3.7.220.246/p3/real_estate/admin/manage-payments-buyer/action-selected', 'Updated data 2,1 by admin ip: 45.64.237.122', '', 2, '2023-09-07 12:54:34', NULL),
(43, '103.121.117.98', 'Mozilla/5.0 (X11; Linux x86_64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/116.0.0.0 Safari/537.36', 'http://3.7.220.246/p3/real_estate/admin/manage-payments-buyer/action-selected', 'Updated data 2,1 by admin ip: 103.121.117.98', '', 2, '2023-09-07 12:54:51', NULL),
(44, '103.121.117.98', 'Mozilla/5.0 (Windows NT 10.0; Win64; x64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/116.0.0.0 Safari/537.36', 'http://3.7.220.246/p3/real_estate/admin/manage-user/action-selected', 'Updated data 7,6 by admin ip: 103.121.117.98', '', 2, '2023-09-07 13:01:20', NULL),
(45, '45.64.237.122', 'Mozilla/5.0 (Windows NT 10.0; Win64; x64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/116.0.0.0 Safari/537.36', 'http://3.7.220.246/p3/real_estate/admin/manage-user/action-selected', 'Updated data 7,6 by admin ip: 45.64.237.122', '', 2, '2023-09-07 13:01:27', NULL),
(46, '45.64.237.122', 'Mozilla/5.0 (X11; Ubuntu; Linux x86_64; rv:88.0) Gecko/20100101 Firefox/88.0', 'http://3.7.220.246/p3/real_estate/admin/logout', 'admin@gmail.com logout', '', 2, '2023-09-07 13:08:41', NULL),
(47, '45.64.237.122', 'Mozilla/5.0 (Windows NT 10.0; Win64; x64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/116.0.0.0 Safari/537.36', 'http://3.7.220.246/p3/real_estate/admin/manage-payments-buyer/action-selected', 'Updated data 1 by admin ip: 45.64.237.122', '', 2, '2023-09-07 13:10:30', NULL),
(48, '45.64.237.122', 'Mozilla/5.0 (Windows NT 10.0; Win64; x64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/116.0.0.0 Safari/537.36', 'http://3.7.220.246/p3/real_estate/admin/manage-payments-buyer/action-selected', 'Updated data 1 by admin ip: 45.64.237.122', '', 2, '2023-09-07 13:10:42', NULL),
(49, '103.121.117.98', 'Mozilla/5.0 (Windows NT 10.0; Win64; x64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/116.0.0.0 Safari/537.36', 'http://3.7.220.246/p3/real_estate/admin/manage-subscriptions/action-selected', 'Updated data 2,1 by admin ip: 103.121.117.98', '', 2, '2023-09-08 09:50:07', NULL),
(50, '45.64.237.122', 'Mozilla/5.0 (Windows NT 10.0; Win64; x64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/116.0.0.0 Safari/537.36', 'http://3.7.220.246/p3/real_estate/admin/logout', 'admin@gmail.com logout', '', 2, '2023-09-20 07:57:32', NULL),
(51, '45.64.237.122', 'Mozilla/5.0 (Windows NT 10.0; Win64; x64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/116.0.0.0 Safari/537.36', 'http://3.7.220.246/p3/real_estate/admin/logout', 'admin@gmail.com logout', '', 2, '2023-09-21 10:02:36', NULL),
(52, '103.121.117.98', 'Mozilla/5.0 (Windows NT 10.0; Win64; x64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/116.0.0.0 Safari/537.36', 'http://3.7.220.246/p3/real_estate/admin/logout', 'superadmin@gmail.com logout', '', 1, '2023-09-21 10:14:03', NULL),
(53, '103.121.117.98', 'Mozilla/5.0 (Windows NT 10.0; Win64; x64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/116.0.0.0 Safari/537.36', 'http://3.7.220.246/p3/real_estate/admin/logout', 'admin@gmail.com logout', '', 2, '2023-09-21 10:33:04', NULL),
(54, '45.64.237.122', 'Mozilla/5.0 (Windows NT 10.0; Win64; x64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/116.0.0.0 Safari/537.36', 'http://3.7.220.246/p3/real_estate/admin/logout', 'superadmin@gmail.com logout', '', 1, '2023-09-21 10:35:36', NULL),
(55, '45.64.237.122', 'Mozilla/5.0 (Windows NT 10.0; Win64; x64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/117.0.0.0 Safari/537.36', 'http://3.7.220.246/p3/real_estate/admin/logout', 'admin@gmail.com logout', '', 2, '2023-09-28 12:36:01', NULL),
(56, '127.0.0.1', 'Mozilla/5.0 (Windows NT 10.0; Win64; x64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/109.0.0.0 Safari/537.36', 'http://127.0.0.1:8000/admin/logout', 'superadmin@gmail.com logout', '', 1, '2023-10-29 10:47:45', NULL),
(57, '127.0.0.1', 'Mozilla/5.0 (Windows NT 10.0; Win64; x64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/109.0.0.0 Safari/537.36', 'http://127.0.0.1:8000/admin/logout', 'admin@gmail.com logout', '', 2, '2023-10-29 10:49:40', NULL);

-- --------------------------------------------------------

--
-- Table structure for table `cms_pages`
--

CREATE TABLE `cms_pages` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `page_title` varchar(255) NOT NULL,
  `page_slug` varchar(255) NOT NULL,
  `page_content` longtext,
  `featured_image` varchar(255) DEFAULT NULL,
  `meta_title` varchar(255) NOT NULL,
  `meta_keywords` text,
  `meta_description` text,
  `status` tinyint(4) NOT NULL DEFAULT '0',
  `created_by` bigint(20) UNSIGNED NOT NULL,
  `updated_by` bigint(20) UNSIGNED DEFAULT NULL,
  `user_ip` varchar(45) DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `cms_pages`
--

INSERT INTO `cms_pages` (`id`, `page_title`, `page_slug`, `page_content`, `featured_image`, `meta_title`, `meta_keywords`, `meta_description`, `status`, `created_by`, `updated_by`, `user_ip`, `created_at`, `updated_at`) VALUES
(2, 'About Us', 'about-us', '<div class=\"container\">\r\n<div class=\"page_content\">\r\n<h1>About Us</h1>\r\n</div>\r\n\r\n<div class=\"about_content\">\r\n<p>&nbsp; &nbsp; It is a long established fact that a reader will be distracted by the readable content of a page when looking at its layout. The point of using Lorem Ipsum is that it has a more-or-less normal distribution of letters, as opposed to using &#39;Content here, content here&#39;, making it look like readable English. Many desktop publishing packages and web page editors now use Lorem Ipsum as their default model text, and a search for &#39;lorem ipsum&#39; will uncover many web sites still in their infancy. Various versions have evolved over the years, sometimes by accident, sometimes on purpose (injected humour and the like).</p>\r\n</div>\r\n</div>', 'uploads/site/cmspage/featured-image-1690978082.jpg', 'About us', NULL, NULL, 1, 1, 2, '103.121.117.98', '2023-07-28 09:07:42', '2023-09-21 11:16:12'),
(7, 'Terms and Conditions', 'terms-and-conditions', '<div class=\"inner_page text_only\">\r\n<div class=\"container\">\r\n<div class=\"page_content\">\r\n<h1>Terms &amp; Conditions</h1>\r\n</div>\r\n\r\n<div class=\"about_content\">\r\n<p>&nbsp; &nbsp; It is a long established fact that a reader will be distracted by the readable content of a page when looking at its layout. The point of using Lorem Ipsum is that it has a more-or-less normal distribution of letters, as opposed to using &#39;Content here, content here&#39;, making it look like readable English. Many desktop publishing packages and web page editors now use Lorem Ipsum as their default model text, and a search for &#39;lorem ipsum&#39; will uncover many web sites still in their infancy. Various versions have evolved over the years, sometimes by accident, sometimes on purpose (injected humour and the like).</p>\r\n</div>\r\n</div>\r\n</div>', '', 'Terms and Conditions', NULL, NULL, 1, 1, 2, '103.121.117.98', '2023-07-28 09:11:17', '2023-09-21 11:14:21'),
(8, 'Privacy Policy', 'privacy-policy', '<div class=\"inner_page text_only\">\r\n<div class=\"container\">\r\n<div class=\"page_content\">\r\n<h1>Privacy Policy</h1>\r\n</div>\r\n\r\n<div class=\"about_content\">\r\n<p>&nbsp; It is a long established fact that a reader will be distracted by the readable content of a page when looking at its layout. The point of using Lorem Ipsum is that it has a more-or-less normal distribution of letters, as opposed to using &#39;Content here, content here&#39;, making it look like readable English. Many desktop publishing packages and web page editors now use Lorem Ipsum as their default model text, and a search for &#39;lorem ipsum&#39; will uncover many web sites still in their infancy. Various versions have evolved over the years, sometimes by accident, sometimes on purpose (injected humour and the like).</p>\r\n</div>\r\n</div>\r\n</div>', '', 'Privacy Policy', NULL, NULL, 1, 1, 2, '45.64.237.122', '2023-07-28 09:11:22', '2023-09-21 11:15:45');

-- --------------------------------------------------------

--
-- Table structure for table `countries`
--

CREATE TABLE `countries` (
  `id` bigint(20) NOT NULL,
  `shortname` varchar(200) NOT NULL,
  `name` varchar(200) NOT NULL,
  `phonecode` varchar(200) NOT NULL,
  `status` tinyint(4) NOT NULL,
  `updated_at` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP,
  `created_at` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `countries`
--

INSERT INTO `countries` (`id`, `shortname`, `name`, `phonecode`, `status`, `updated_at`, `created_at`) VALUES
(1, 'AF', 'Afghanistan', '93', 1, '2023-09-02 07:00:27', '2023-09-02 07:00:27'),
(2, 'AL', 'Albania', '355', 1, '2023-09-02 07:00:27', '2023-09-02 07:00:27'),
(3, 'DZ', 'Algeria', '213', 1, '2023-09-02 07:00:27', '2023-09-02 07:00:27'),
(4, 'AS', 'American Samoa', '1684', 1, '2023-09-02 07:00:27', '2023-09-02 07:00:27'),
(5, 'AD', 'Andorra', '376', 1, '2023-09-02 07:00:27', '2023-09-02 07:00:27'),
(6, 'AO', 'Angola', '244', 1, '2023-09-02 07:00:27', '2023-09-02 07:00:27'),
(7, 'AI', 'Anguilla', '1264', 1, '2023-09-02 07:00:27', '2023-09-02 07:00:27'),
(8, 'AQ', 'Antarctica', '0', 1, '2023-09-02 07:00:27', '2023-09-02 07:00:27'),
(9, 'AG', 'Antigua And Barbuda', '1268', 1, '2023-09-02 07:00:27', '2023-09-02 07:00:27'),
(10, 'AR', 'Argentina', '54', 1, '2023-09-02 07:00:27', '2023-09-02 07:00:27'),
(11, 'AM', 'Armenia', '374', 1, '2023-09-02 07:00:27', '2023-09-02 07:00:27');

-- --------------------------------------------------------

--
-- Table structure for table `email_settings`
--

CREATE TABLE `email_settings` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `email_sender` varchar(255) NOT NULL,
  `mail_driver` varchar(255) NOT NULL,
  `smtp_host` varchar(255) NOT NULL,
  `smtp_port` varchar(255) NOT NULL,
  `smtp_username` varchar(255) NOT NULL,
  `smtp_password` varchar(255) NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

-- --------------------------------------------------------

--
-- Table structure for table `failed_jobs`
--

CREATE TABLE `failed_jobs` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `connection` text NOT NULL,
  `queue` text NOT NULL,
  `payload` longtext NOT NULL,
  `exception` longtext NOT NULL,
  `failed_at` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

-- --------------------------------------------------------

--
-- Table structure for table `faqs`
--

CREATE TABLE `faqs` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `faq_category_id` bigint(20) UNSIGNED DEFAULT NULL,
  `title` varchar(255) NOT NULL,
  `description` longtext,
  `status` tinyint(1) NOT NULL DEFAULT '1',
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `faqs`
--

INSERT INTO `faqs` (`id`, `faq_category_id`, `title`, `description`, `status`, `created_at`, `updated_at`) VALUES
(1, 1, 'What makes Otobix the best place to buy a car?', '<p><strong>Otobix is a revolutionary digital auction platform for the automobile dealer community and Pre-Owned Car Sellers:</strong></p>\r\n\r\n<ul>\r\n	<li>Addresses one of the biggest challenges of a used-owned car dealer today i.e. procurement of vehicles at the right price.</li>\r\n	<li>Map the used car dealer&rsquo;s for pre-owned car inventory, addresses used car dealer&rsquo;s problem statement of procurement by creating a robust, efficient supply chain. At Otobix, we are creating a synergy between the two entities and creating an ecosystem to efficiently manage stocks and procurement.</li>\r\n	<li>Transparent seamless transactions &ndash; zero margin, only transaction fee-based model makes it economically viable for a used car dealers to buy through us and further resell.</li>\r\n	<li>We work on logic and do not encourage greed &ndash; a unique feature of our platform is that we close the auction once the target price is achieved and do not encourage a bidding war inflating the purchase price which impacts the viability of a used car dealer&rsquo;s business. We address the seller&rsquo;s problem statement i.e. &ndash; liquidating stock and hence focus on getting them the fair price for their inventory while ensuring profitability for used car dealers.</li>\r\n	<li>another unique feature of our platform is that you can initiate an auction from the list of cars with basic details which are in the inventory section &ndash; so if there is a car that is of interest to you or your customer, request for an auction and our team will ensure that we complete the uploading process of that vehicle first and put it up for auction and guess what? &ndash; as a reward for being proactive &ndash; we shall also give you an exclusive window of 15 minutes before it opens up for all.</li>\r\n	<li>We also value your time and hence do not want you to be distracted from your regular work and constantly work on our app. Select the car you wish to bid on from our upcoming auction list, put your pre-bid offer, and once the auction goes live &ndash; you don&rsquo;t need to monitor the bidding, we at Otobix will do that for you. Only if your offer is outmatched, you will be needed to review and rebid.</li>\r\n	<li>You can get the car at a price lower than what you bid. &ndash; yes, as we close the auction/trade at target price, even if your bid is higher than the target price, you will be required to pay only the target price that was set. Isn&rsquo;t this great?</li>\r\n</ul>', 1, '2023-07-31 07:55:11', NULL),
(2, 2, 'What makes Otobix the best place to sell the car?', '<p>Otobix is a revolutionary b2b digital auction platform for the automobile</p>\r\n\r\n<p><strong>Dealer community:</strong></p>\r\n\r\n<ul>\r\n	<li>Provides a <strong>reliable, transparent platform for liquidation of your car</strong>.</li>\r\n	<li><strong>Optimizes return on your car</strong> by taking your product to a larger audience.</li>\r\n	<li>Seamless, real-time transactions with complete transparency &ndash; dealers can upload inventory stock, submit inspection report or follow our template and submit online inspection, activate auctions, view bids/offers, accept offers, and close transactions &ndash; all can happen in less than 60 minutes &ndash; simple!</li>\r\n	<li><strong>You can sell your car by staying at your home only.</strong></li>\r\n</ul>', 1, '2023-07-31 07:56:09', '2023-07-31 08:05:29');

-- --------------------------------------------------------

--
-- Table structure for table `images`
--

CREATE TABLE `images` (
  `id` int(11) NOT NULL,
  `name` varchar(255) NOT NULL,
  `path` varchar(255) NOT NULL,
  `property_id` varchar(50) NOT NULL,
  `created_at` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP,
  `updated_at` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP,
  `type` varchar(50) NOT NULL COMMENT 'image /video'
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

-- --------------------------------------------------------

--
-- Table structure for table `migrations`
--

CREATE TABLE `migrations` (
  `id` int(10) NOT NULL,
  `migration` varchar(255) NOT NULL,
  `batch` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `migrations`
--

INSERT INTO `migrations` (`id`, `migration`, `batch`) VALUES
(1, '2014_10_12_000000_create_users_table', 1),
(2, '2014_10_12_100000_create_password_resets_table', 1),
(3, '2019_08_19_000000_create_failed_jobs_table', 1),
(4, '2022_08_04_092124_create_admin_privileges_table', 1),
(5, '2022_08_04_092144_create_admin_privileges_roles_table', 1),
(6, '2022_08_04_092257_create_admin_users_table', 1),
(7, '2022_08_04_100101_create_admin_settings_table', 1),
(8, '2022_08_08_071054_create_email_settings_table', 1),
(9, '2022_08_08_073736_create_cms_pages_table', 1),
(10, '2022_08_08_073833_create_cms_page_contents_table', 1),
(11, '2023_07_10_140156_create_admin_menus_table', 1),
(12, '2023_07_31_095808_create_testimonials_table', 2),
(13, '2023_07_31_120114_create_faq_categories_table', 3),
(14, '2023_07_31_120207_create_faqs_table', 3),
(15, '2023_08_01_114133_create_brands_table', 4),
(16, '2023_08_01_120335_create_brand_models_table', 4),
(17, '2023_08_02_120943_create_teams_table', 5),
(18, '2023_08_07_113746_create_home_banners_table', 6),
(19, '2023_08_08_131002_create_how_it_works_table', 7);

-- --------------------------------------------------------

--
-- Table structure for table `password_resets`
--

CREATE TABLE `password_resets` (
  `email` varchar(255) NOT NULL,
  `token` varchar(255) NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

-- --------------------------------------------------------

--
-- Table structure for table `roles`
--

CREATE TABLE `roles` (
  `id` int(11) NOT NULL,
  `name` varchar(50) NOT NULL,
  `status` int(11) NOT NULL DEFAULT '0'
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `roles`
--

INSERT INTO `roles` (`id`, `name`, `status`) VALUES
(1, 'buyer', 1),
(2, 'seller', 1),
(3, 'landlord', 1);

-- --------------------------------------------------------

--
-- Table structure for table `testimonials`
--

CREATE TABLE `testimonials` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `author` varchar(255) NOT NULL,
  `author_image` varchar(255) DEFAULT NULL,
  `message` text,
  `status` tinyint(1) NOT NULL DEFAULT '0',
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `testimonials`
--

INSERT INTO `testimonials` (`id`, `author`, `author_image`, `message`, `status`, `created_at`, `updated_at`) VALUES
(1, 'Alex Farnandez', 'admin/uploads/testimonials/author-image-1690802059.png', 'Great experience, want to deal again with this company in future, very good price given for my car. Payment was done superfasr.Very good', 1, '2023-07-31 05:44:19', '2023-07-31 05:56:04'),
(2, 'Chitta Ranjan Khandikar', 'admin/uploads/testimonials/author-image-1690803036.png', 'It was such a wonderful selling experience of my car 🚘to OtoBix ,Quick response & pricing better than others. Payment was very fast .The sell executive was polite and efficient. Overall it was a smooth and wonderful experience with OtoBix 🙏', 1, '2023-07-31 06:00:36', NULL),
(3, 'Sayan Goswami', 'admin/uploads/testimonials/author-image-1690803300.png', 'Brilliant Organization to sell one’s Car. Best Price. Hassle Free Transaction. I strongly recommend others to sell their Cars through them.', 1, '2023-07-31 06:05:00', NULL),
(4, 'Akshay Bajoria', 'admin/uploads/testimonials/author-image-1690803346.png', 'Super experience. Quick and hassle free. Best price compared to others. Strongly recommend selling your car through them!', 1, '2023-07-31 06:05:46', NULL);

-- --------------------------------------------------------

--
-- Table structure for table `users`
--

CREATE TABLE `users` (
  `id` int(20) UNSIGNED NOT NULL,
  `fname` varchar(150) DEFAULT NULL,
  `lname` varchar(150) DEFAULT NULL,
  `uname` varchar(150) NOT NULL,
  `email` varchar(255) DEFAULT NULL,
  `phone_number` varchar(15) NOT NULL,
  `email_verified_at` timestamp NULL DEFAULT NULL,
  `password` varchar(255) NOT NULL,
  `remember_token` varchar(100) DEFAULT NULL,
  `country` int(11) DEFAULT NULL,
  `city` int(11) DEFAULT NULL,
  `status` tinyint(4) NOT NULL DEFAULT '1',
  `profile_image` varchar(250) DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `users`
--

INSERT INTO `users` (`id`, `fname`, `lname`, `uname`, `email`, `phone_number`, `email_verified_at`, `password`, `remember_token`, `country`, `city`, `status`, `profile_image`, `created_at`, `updated_at`) VALUES
(6, 'Avishek', 'halder', 'Avishek halder', 'avishek@gmail.com', '906268869', NULL, '$2y$10$SxlDjahQzXe8Thmm13OwtOywXzbLhb9wTLNSyTMB.VmWUNa805f0e', NULL, 0, 0, 1, 'admin/uploads/user/author-image-1693896646.png', '2023-09-02 13:21:26', '2023-09-20 10:25:22'),
(7, 'Jhon', 'Ady', 'Jhon Ady', 'jhon@gmail.com', '9876543111', NULL, '$2y$10$/JFXeMMoix1heKzPJ5/HLu/J56cbRf1MwxoYhjWVw9iUTyvbuwsWe', NULL, 0, 0, 1, 'admin/uploads/user/author-image-1693909341.png', '2023-09-05 10:22:21', '2023-09-19 11:40:27'),
(18, 'Seeme', 'Test', 'TEST USER', 'test@yopmail.com', '9876543210', NULL, '$2y$10$9.fttYMNfnB1XWbbalzCWujNukt.SmhIeLa5w/NidQZKH2bASDAV2', NULL, 0, 0, 0, '', '2023-09-12 12:48:28', '2023-09-20 10:42:41'),
(20, 'Rozer', 'Test', 'TEST USER', 'testuser2@yopmail.com', '7878787002', NULL, '$2y$10$8sPKW5HE8ObM07KZGtaoiuwtch6R9TIMLwDbokcHnmJiYimj53z.2', NULL, 0, 0, 1, '', '2023-09-12 12:52:53', '2023-09-12 12:52:53'),
(21, 'Richael', 'USER', 'TEST USER', 'testuser@yopmaisl.com', '7878787878', NULL, '$2y$10$NLgcV1Ye13xh3wF30Gtc1u86wPzjIXPx8gmncRixpK2Q8B9MFzp7y', NULL, 0, 0, 1, '', '2023-09-12 12:53:16', '2023-09-12 12:53:16'),
(54, 'John', 'Sinha', 'John Sinha', 'john@yopmain.com', '9876543210.', NULL, '$2y$10$g3dg7q2qT/dxldV4CjN/TO7exW3GcrH3.UR956TRwmuJyO0Gc0xTK', NULL, 1, 1, 0, '', '2023-09-20 06:49:19', '2023-09-20 06:50:03'),
(55, 'Aditya', 'Sambyal', 'Aditya Sambyal', 'aditya@yopmail.com', '9876543210', NULL, '$2y$10$hVZBu5p7pNiXHhgk7BNyX.zQV7qmar96V9B1oCo8g8Ra4ONBN8HXC', NULL, 2, 3, 0, '', '2023-09-20 07:10:46', '2023-09-21 17:33:36'),
(56, 'Saurav', 'Chhetri', 'Saurav Chhetri', 'sourav@yopmail.com', '9876543210', NULL, '$2y$10$ezGgI8Q26EvYk/v3jbO/KuUUF1phcA0hc9YaAzRF/r4RY9yR7WK9y', NULL, 1, 1, 0, '', '2023-09-20 07:16:52', '2023-09-20 07:33:16'),
(58, 'Sunil', 'Gavaskar', 'Sunil Gavaskar', 'sunil@gmail.com', '9062688630', NULL, '$2y$10$VSe9x2ru/1DHEF8gR8Q2C.YR5Zg6ShEgZnI5p2kuuibQHeA/9vjZe', NULL, NULL, NULL, 1, '', '2023-09-20 10:59:36', '2023-09-20 10:59:36'),
(59, 'Saurav', 'Chhetri', 'Saurav Chhetri', 'chetri@yopmail.com', '9876543210', NULL, '$2y$10$MpVRYU2xrNx9H2WbprUBauMqQw2Do26y/Wj70tZbXzwSdRsBT9l.S', NULL, 1, 1, 0, '', '2023-09-21 12:57:49', '2023-09-21 13:16:51'),
(60, 'Saurav', 'Chhetri', 'Saurav Chhetri', 's@yopmail.com', '9876543210.', NULL, '$2y$10$12Xjjjija7rT3VHPh0DL5.Y6ad.VQvkDORuhXu2xFIHUQV3DcMM3.', NULL, 1, 1, 0, '', '2023-09-21 13:21:04', '2023-09-22 12:56:40'),
(61, 'SChhetri', 'Singh', 'SChhetri Singh', 'webguruschhetri@gmail.com', '8497949494', NULL, '$2y$10$F3Gl9RKHA3MDxRZmB7XUQuPpG5RD4h/8wCiM.JbhZX3mqDJYxGIrq', NULL, 1, 1, 1, '', '2023-09-22 12:59:56', '2023-09-22 12:59:56');

-- --------------------------------------------------------

--
-- Table structure for table `user_role_mapping`
--

CREATE TABLE `user_role_mapping` (
  `id` int(11) NOT NULL,
  `user_id` varchar(200) NOT NULL,
  `role_id` varchar(200) NOT NULL,
  `created_at` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP,
  `updated_at` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Indexes for dumped tables
--

--
-- Indexes for table `admin_menus`
--
ALTER TABLE `admin_menus`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `admin_privileges`
--
ALTER TABLE `admin_privileges`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `admin_privileges_roles`
--
ALTER TABLE `admin_privileges_roles`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `admin_settings`
--
ALTER TABLE `admin_settings`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `admin_users`
--
ALTER TABLE `admin_users`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `cities`
--
ALTER TABLE `cities`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `cms_logs`
--
ALTER TABLE `cms_logs`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `cms_pages`
--
ALTER TABLE `cms_pages`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `countries`
--
ALTER TABLE `countries`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `email_settings`
--
ALTER TABLE `email_settings`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `faqs`
--
ALTER TABLE `faqs`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `images`
--
ALTER TABLE `images`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `migrations`
--
ALTER TABLE `migrations`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `roles`
--
ALTER TABLE `roles`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `testimonials`
--
ALTER TABLE `testimonials`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `users`
--
ALTER TABLE `users`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `user_role_mapping`
--
ALTER TABLE `user_role_mapping`
  ADD PRIMARY KEY (`id`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `admin_menus`
--
ALTER TABLE `admin_menus`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=20;

--
-- AUTO_INCREMENT for table `admin_privileges`
--
ALTER TABLE `admin_privileges`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=3;

--
-- AUTO_INCREMENT for table `admin_privileges_roles`
--
ALTER TABLE `admin_privileges_roles`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=333;

--
-- AUTO_INCREMENT for table `admin_settings`
--
ALTER TABLE `admin_settings`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2;

--
-- AUTO_INCREMENT for table `admin_users`
--
ALTER TABLE `admin_users`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=3;

--
-- AUTO_INCREMENT for table `cities`
--
ALTER TABLE `cities`
  MODIFY `id` bigint(20) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=8;

--
-- AUTO_INCREMENT for table `cms_logs`
--
ALTER TABLE `cms_logs`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=58;

--
-- AUTO_INCREMENT for table `cms_pages`
--
ALTER TABLE `cms_pages`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=9;

--
-- AUTO_INCREMENT for table `countries`
--
ALTER TABLE `countries`
  MODIFY `id` bigint(20) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=12;

--
-- AUTO_INCREMENT for table `faqs`
--
ALTER TABLE `faqs`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=3;

--
-- AUTO_INCREMENT for table `images`
--
ALTER TABLE `images`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `migrations`
--
ALTER TABLE `migrations`
  MODIFY `id` int(10) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=20;

--
-- AUTO_INCREMENT for table `roles`
--
ALTER TABLE `roles`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=4;

--
-- AUTO_INCREMENT for table `testimonials`
--
ALTER TABLE `testimonials`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=5;

--
-- AUTO_INCREMENT for table `users`
--
ALTER TABLE `users`
  MODIFY `id` int(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=62;

--
-- AUTO_INCREMENT for table `user_role_mapping`
--
ALTER TABLE `user_role_mapping`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
