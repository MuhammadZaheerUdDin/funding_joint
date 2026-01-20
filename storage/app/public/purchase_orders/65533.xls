-- phpMyAdmin SQL Dump
-- version 4.9.0.1
-- https://www.phpmyadmin.net/
--
-- Host: localhost
-- Generation Time: Jul 29, 2021 at 04:28 PM
-- Server version: 10.3.16-MariaDB
-- PHP Version: 7.3.7

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
SET AUTOCOMMIT = 0;
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `funding_joint`
--

-- --------------------------------------------------------

--
-- Table structure for table `account_balance`
--

CREATE TABLE `account_balance` (
  `id` int(10) UNSIGNED NOT NULL,
  `user_id` int(10) UNSIGNED NOT NULL,
  `balance` decimal(65,2) UNSIGNED NOT NULL DEFAULT 0.00,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  `deleted_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `account_balance`
--

INSERT INTO `account_balance` (`id`, `user_id`, `balance`, `created_at`, `updated_at`, `deleted_at`) VALUES
(29, 338, '5000.00', '2021-06-08 16:09:09', '2021-06-08 16:09:09', NULL),
(30, 339, '22295.00', '2021-06-08 17:54:06', '2021-07-28 02:32:18', NULL),
(31, 1, '85970.00', '2021-06-08 16:09:09', '2021-07-29 11:25:14', NULL),
(32, 340, '0.00', '2021-06-18 11:58:11', '2021-07-13 12:16:53', NULL),
(33, 345, '0.00', '2021-06-21 11:54:41', '2021-06-21 11:54:41', NULL),
(34, 346, '0.00', '2021-06-23 17:48:20', '2021-07-09 18:58:46', NULL),
(35, 347, '43590.00', '2021-06-25 14:54:15', '2021-07-29 13:39:52', NULL),
(36, 348, '0.00', '2021-06-25 23:35:08', '2021-06-25 23:35:08', NULL),
(37, 351, '27900.00', '2021-07-19 16:30:05', '2021-07-26 23:41:37', NULL),
(38, 352, '0.00', '2021-07-28 12:00:02', '2021-07-28 12:00:02', NULL),
(39, 353, '0.00', '2021-07-28 12:12:26', '2021-07-28 12:12:26', NULL);

-- --------------------------------------------------------

--
-- Table structure for table `admin_settings`
--

CREATE TABLE `admin_settings` (
  `id` int(10) UNSIGNED NOT NULL,
  `minimum_auction_length` int(11) DEFAULT NULL,
  `maximum_auction_length` int(11) DEFAULT NULL,
  `maximum_discount_limit` int(11) DEFAULT NULL,
  `maximum_time_to_invoice` int(11) DEFAULT NULL,
  `maximum_invoice_issue` int(11) DEFAULT NULL,
  `anti_sniping_policy` int(11) DEFAULT NULL,
  `po_settings` int(11) DEFAULT NULL,
  `funding_joint_admin_fee` decimal(5,2) DEFAULT NULL,
  `maximum_expected_roi` int(11) DEFAULT NULL,
  `minimum_bid_amount` int(11) DEFAULT NULL,
  `agency_fee` int(11) DEFAULT NULL,
  `minimum_expected_invoice_term` int(11) NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `admin_settings`
--

INSERT INTO `admin_settings` (`id`, `minimum_auction_length`, `maximum_auction_length`, `maximum_discount_limit`, `maximum_time_to_invoice`, `maximum_invoice_issue`, `anti_sniping_policy`, `po_settings`, `funding_joint_admin_fee`, `maximum_expected_roi`, `minimum_bid_amount`, `agency_fee`, `minimum_expected_invoice_term`, `created_at`, `updated_at`) VALUES
(1, 6, 10, 50, 15, 92, 30, 90, '2.99', 1000, 100, 10, 1, '2018-11-16 13:29:44', '2021-07-28 02:05:57');

-- --------------------------------------------------------

--
-- Table structure for table `auctions`
--

CREATE TABLE `auctions` (
  `id` int(10) UNSIGNED NOT NULL,
  `user_id` int(10) UNSIGNED DEFAULT NULL,
  `buyer_id` int(10) UNSIGNED DEFAULT NULL,
  `po_number` varchar(150) DEFAULT NULL,
  `po_approved` smallint(6) DEFAULT 0,
  `po_file_name` varchar(191) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `total_amount_of_po` int(11) DEFAULT NULL,
  `amount_funding_required` int(11) DEFAULT NULL,
  `maximum_discount_limit` int(11) DEFAULT NULL,
  `agency_fee` varchar(60) DEFAULT NULL,
  `funding_joint_fee` varchar(60) DEFAULT NULL,
  `net_funding_available` varchar(255) DEFAULT NULL,
  `why_require_funding` longtext CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `expected_invoice_issue_date` date DEFAULT NULL,
  `expected_invoice_term` int(11) DEFAULT NULL,
  `indicative_funding_period` int(11) DEFAULT NULL,
  `percentage_invoice` int(11) DEFAULT NULL,
  `date_repayment_due` date DEFAULT NULL,
  `start_auction` date DEFAULT NULL,
  `end_auction` date DEFAULT NULL,
  `approved` int(11) DEFAULT NULL,
  `paid_out` tinyint(1) NOT NULL DEFAULT 0,
  `paid_out_reference` varchar(50) DEFAULT NULL,
  `paid_out_datetime` timestamp NULL DEFAULT NULL,
  `fees_release` tinyint(1) NOT NULL DEFAULT 0,
  `fees_release_reference` varchar(50) DEFAULT NULL,
  `fees_release_datetime` timestamp NULL DEFAULT NULL,
  `paid_back` tinyint(1) DEFAULT 0,
  `is_transferred` tinyint(1) NOT NULL DEFAULT 0,
  `auction_confirmed` tinyint(1) DEFAULT NULL,
  `status` varchar(191) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  `auction_completed` int(11) DEFAULT 0
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Dumping data for table `auctions`
--

INSERT INTO `auctions` (`id`, `user_id`, `buyer_id`, `po_number`, `po_approved`, `po_file_name`, `total_amount_of_po`, `amount_funding_required`, `maximum_discount_limit`, `agency_fee`, `funding_joint_fee`, `net_funding_available`, `why_require_funding`, `expected_invoice_issue_date`, `expected_invoice_term`, `indicative_funding_period`, `percentage_invoice`, `date_repayment_due`, `start_auction`, `end_auction`, `approved`, `paid_out`, `paid_out_reference`, `paid_out_datetime`, `fees_release`, `fees_release_reference`, `fees_release_datetime`, `paid_back`, `is_transferred`, `auction_confirmed`, `status`, `created_at`, `updated_at`, `auction_completed`) VALUES
(51, 338, 19, '123', 1, '17779.xls', 2000, 1000, 50, '£ 80', '£ 48', '672', 'xckvzxclvx', '2021-06-23', 30, NULL, 80, '2021-07-23', '2021-06-08', '2021-06-18', 1, 0, NULL, NULL, 0, NULL, NULL, 0, 0, NULL, 'Live', '2021-06-08 17:50:17', '2021-06-08 17:51:29', 1),
(52, 338, 19, '1234', 1, '30599.xls', 500, 300, 5, '£ 29', '£ 9', '247', 'dsd', '2021-06-12', 30, NULL, 60, '2021-07-12', '2021-06-09', '2021-06-19', 1, 0, NULL, NULL, 0, NULL, NULL, 0, 0, NULL, 'Live', '2021-06-09 02:10:42', '2021-06-09 04:51:07', 1),
(53, 338, 20, '12', 1, '17170.xls', 2000, 1800, 25, '£ 135', '£ 54', '1161', 'kjhgfdghjl,khgfdxhjkljhgzsfghlkjhfdsscfvkjhgfdsxckjhgfds', '2021-06-23', 25, NULL, 90, '2021-07-18', '2021-06-23', '2021-06-27', 1, 0, NULL, NULL, 0, NULL, NULL, 0, 0, NULL, 'Live', '2021-06-23 09:47:14', '2021-06-23 12:28:04', 1),
(54, 340, 22, '4', 0, '37053.xls', 1000, 800, 25, '£ 60', '£ 24', '516', 'jhgfjkjhgfhgf', NULL, NULL, NULL, 80, NULL, NULL, NULL, NULL, 0, NULL, NULL, 0, NULL, NULL, 0, 0, NULL, NULL, '2021-06-27 09:12:49', '2021-06-27 09:12:49', 0),
(55, 340, 22, '12', 0, '98964.xls', 2000, 1500, 10, '£ 135', '£ 45', '1170', 'juytrujihygfdriuytfdfghjhgf', NULL, NULL, NULL, 75, NULL, NULL, NULL, NULL, 0, NULL, NULL, 0, NULL, NULL, 0, 0, NULL, NULL, '2021-06-27 09:56:02', '2021-06-27 09:56:02', 0),
(56, 340, 23, '234', 0, '66721.xls', NULL, NULL, 7, '£ 837', '£ 269', '7264', 'expansion', '2021-06-28', 90, NULL, 90, '2021-09-26', NULL, NULL, NULL, 0, NULL, NULL, 0, NULL, NULL, 0, 0, NULL, NULL, '2021-06-28 12:42:06', '2021-06-28 12:42:24', 0),
(57, 340, 22, '456', 0, '42854.xls', 10000, 0, 7, '£ 837', '£ 269', '7264', 'expand', '2021-06-28', 30, NULL, NULL, '2021-07-28', NULL, NULL, NULL, 0, NULL, NULL, 0, NULL, NULL, 0, 0, NULL, NULL, '2021-06-28 12:58:04', '2021-06-28 13:52:15', 1),
(58, 340, 23, '28/06 15:20', 0, '18956.xls', 10000, 9000, 7, '£ 900', '£ 269', '8101', 'expand', '2021-06-28', 30, NULL, 90, '2021-07-28', NULL, NULL, NULL, 0, NULL, NULL, 0, NULL, NULL, 0, 0, NULL, NULL, '2021-06-28 14:21:19', '2021-06-28 14:22:20', 1),
(59, 340, 22, 'e332423rwer', 0, '91847.xls', 10000, 9000, 7, '£ 837', '£ 269', '7264', 'expansion', '2021-06-28', 30, NULL, 90, '2021-07-28', NULL, NULL, NULL, 0, NULL, NULL, 0, NULL, NULL, 0, 0, NULL, NULL, '2021-06-28 17:00:30', '2021-06-28 17:00:46', 0),
(60, 340, 22, '1232', 1, '21326.xls', 9000, 0, 7, '£ 753', '£ 242', '6538', 'expansion', '2021-06-28', 30, NULL, 90, '2021-07-28', '2021-06-29', '2021-07-04', 1, 0, NULL, NULL, 0, NULL, NULL, 0, 0, NULL, 'Live', '2021-06-28 17:03:36', '2021-06-29 15:12:55', 1),
(61, 340, 23, 'e332423r', 1, '86967.xls', 10000, 8100, 7, '£ 0', '£ 269', '8100', 'expansion', '2021-06-28', 30, NULL, 90, '2021-07-28', '2021-06-23', '2021-07-02', 1, 0, NULL, NULL, 0, NULL, NULL, 0, 0, NULL, 'Live', '2021-06-28 17:07:31', '2021-06-28 17:07:44', 1),
(62, 340, 22, 'hg', 1, '75793.xls', 6000, 578, 25, '£ 43', '£ 17', '373.5', 'jgfggf', NULL, NULL, NULL, 10, NULL, '2021-06-29', '2021-07-03', 1, 0, NULL, NULL, 0, NULL, NULL, 0, 0, NULL, 'Ended', '2021-06-29 15:05:16', '2021-07-03 06:49:09', 1),
(63, 340, 22, '123', 1, '64302.xls', 10000, 9000, 7, '£ 837', '£ 269', '7264', 'wsd', '2021-06-29', 30, NULL, 90, '2021-07-29', '2021-06-29', '2021-07-03', 1, 0, NULL, NULL, 0, NULL, NULL, 0, 0, NULL, 'Live', '2021-06-29 15:09:27', '2021-06-29 15:10:39', 1),
(64, 340, 22, '4', 1, '95950.xls', 10000, 9000, 25, '£ 675', '£ 269', '5806', 'ncvbnbvcvbnbv', '2021-06-30', 8, NULL, 90, '2021-07-08', '2021-06-30', '2021-07-05', 1, 0, NULL, NULL, 0, NULL, NULL, 0, 0, NULL, 'Live', '2021-06-30 12:15:59', '2021-06-30 12:20:23', 1),
(65, 340, 22, '2134', 0, '48959.xls', 10000, 9000, 7, '£ 0', '£ 269', '8101', 'expa', '2021-06-30', 30, NULL, 90, '2021-07-30', NULL, NULL, NULL, 0, NULL, NULL, 0, NULL, NULL, 0, 0, NULL, NULL, '2021-06-30 12:28:40', '2021-06-30 12:28:47', 0),
(66, 340, 23, '1234123', 0, '89781.xls', 10000, 9000, 7, '£ 0', '£ 269', '8101', 'exp', '2021-06-30', 15, NULL, 90, '2021-07-15', '2021-06-30', '2021-07-14', 1, 0, NULL, NULL, 0, NULL, NULL, 0, 0, NULL, 'Live', '2021-06-30 13:02:39', '2021-06-30 13:03:12', 1),
(67, 346, 25, 'hgfdfg', 1, '98870.xls', 12333, 9000, 10, '£ 0', '£ 269', '7831', 'bccvxc', '2021-07-05', 16, NULL, 73, '2021-07-13', '2021-07-05', '2021-07-15', 1, 0, NULL, NULL, 0, NULL, NULL, 0, 0, NULL, 'Live', '2021-07-05 03:51:31', '2021-07-05 04:54:21', 1),
(68, 346, 26, '12', 1, '76551.xls', 10000, 9000, 25, '£ 0', '£ 269', '6481', 'nbnbcbxccvc', '2021-07-06', 6, NULL, 90, '2021-07-12', '2021-07-05', '2021-07-15', 1, 0, NULL, NULL, 0, NULL, NULL, 0, 0, NULL, 'Live', '2021-07-05 03:56:28', '2021-07-05 04:53:26', 0),
(69, 346, 27, 'hjgh', 1, '95924.xls', 50000, 45000, 10, '£ 0', '£ 1,346', '39154', 'fvbnbvcbc', '2021-07-05', 11, NULL, 90, '2021-07-16', '2021-07-05', '2021-07-05', 1, 0, NULL, NULL, 0, NULL, NULL, 0, 0, NULL, 'Ended', '2021-07-05 04:48:46', '2021-07-05 05:00:07', 1),
(70, 340, 22, 'e332423rwer', 1, '60985.xls', 10000, 9000, 7, '£ 0', '£ 269', '8101', 'esad', '2021-07-05', 30, NULL, 90, '2021-08-04', '2021-07-05', '2021-07-15', 1, 0, NULL, NULL, 0, NULL, NULL, 0, 0, NULL, 'Live', '2021-07-05 16:22:55', '2021-07-05 16:26:27', 1),
(71, 340, 22, '4', 0, '58992.xls', 6000, 1500, 10, '£ 0', '£ 45', '1305', 'mjhffgkjv', '2021-07-08', 11, NULL, 25, '2021-07-19', NULL, NULL, NULL, 0, NULL, NULL, 0, NULL, NULL, 0, 0, NULL, NULL, '2021-07-07 13:34:40', '2021-07-07 13:35:03', 0),
(72, 340, 23, '2321', 0, '26562.xls', 10000, 9000, 7, '£ 0', '£ 269', '8101', 'asd', '2021-07-09', 30, NULL, 90, '2021-08-08', NULL, NULL, NULL, 0, NULL, NULL, 0, NULL, NULL, 0, 0, NULL, NULL, '2021-07-09 14:29:45', '2021-07-09 14:29:57', 0),
(73, 340, 23, 'q23', 0, '72390.xls', 10000, 9000, 7, '£ 0', '£ 269', '8101', 'sdefr', '2021-07-09', 30, NULL, 90, '2021-08-08', NULL, NULL, NULL, 0, NULL, NULL, 0, NULL, NULL, 0, 0, NULL, NULL, '2021-07-09 14:33:20', '2021-07-09 14:33:51', 0),
(74, 340, 23, 'q23', 0, '64017.xls', NULL, NULL, 7, '£ 0', '£ 269', '8101', 'sdefr', '2021-07-09', 30, NULL, 90, '2021-08-08', NULL, NULL, NULL, 0, NULL, NULL, 0, NULL, NULL, 0, 0, NULL, NULL, '2021-07-09 14:35:46', '2021-07-09 14:35:53', 0),
(75, 340, 23, 'e332423rwer', 1, '69341.xls', 10000, 9000, 7, '£ 0', '£ 269', '8101', 'ffgcdfg', '2021-07-09', 30, NULL, 90, '2021-08-08', '2021-07-09', '2021-07-19', 1, 0, NULL, NULL, 0, NULL, NULL, 0, 0, NULL, 'Live', '2021-07-09 15:10:56', '2021-07-09 15:15:58', 1),
(76, 346, 25, '4', 1, '37286.xls', 400, 300, 25, '£ 0', '£ 9', '216', 'hgjhgfxjhghfg', '2021-07-10', 11, NULL, 75, '2021-07-21', '2021-07-09', '2021-07-09', 1, 0, NULL, NULL, 0, NULL, NULL, 0, 0, NULL, 'Ended', '2021-07-09 18:49:18', '2021-07-09 18:56:06', 1),
(77, 340, 23, '12312', 1, '98474.xls', 10000, 9000, 7, '£ 0', '£ 269', '8101', 'ew234', '2021-07-09', 30, NULL, 90, '2021-08-08', '2021-07-09', '2021-07-19', 1, 0, NULL, NULL, 0, NULL, NULL, 0, 0, NULL, 'Live', '2021-07-09 19:19:03', '2021-07-09 19:20:57', 1),
(78, 340, 23, 'e332423rwer', 0, '54182.xls', 10000, 9000, 7, '£ 0', '£ 269', '8101', 'werf', NULL, NULL, NULL, 90, NULL, NULL, NULL, NULL, 0, NULL, NULL, 0, NULL, NULL, 0, 0, NULL, NULL, '2021-07-09 19:52:08', '2021-07-09 19:52:08', 0),
(79, 340, 23, 'e332423rwer', 0, '66545.xls', NULL, NULL, 7, '£ 0', '£ 269', '8101', 'werf', NULL, NULL, NULL, 90, NULL, NULL, NULL, NULL, 0, NULL, NULL, 0, NULL, NULL, 0, 0, NULL, NULL, '2021-07-09 19:53:19', '2021-07-09 19:53:19', 0),
(80, 340, 23, '123', 0, '22178.xls', 10000, 9000, 7, '£ 0', '£ 269', '8101', 'wetre', '2021-07-09', 1, NULL, NULL, '2021-07-10', NULL, NULL, NULL, 0, NULL, NULL, 0, NULL, NULL, 0, 0, NULL, NULL, '2021-07-09 19:55:03', '2021-07-09 19:57:17', 0),
(81, 340, 23, '1243', 1, '35946.xls', 10000, 9000, 7, '£ 0', '£ 269', '8101', 'erter', '2021-07-09', 1, NULL, 90, '2021-07-10', '2021-07-12', '2021-07-22', 1, 0, NULL, NULL, 0, NULL, NULL, 0, 0, NULL, 'Live', '2021-07-09 19:59:10', '2021-07-12 09:06:41', 0),
(82, 340, 23, '1423', 1, '54648.xls', 10000, 9000, 7, '£ 0', '£ 269', '8101', 'szdf', '2021-07-09', 1, NULL, 90, '2021-07-10', '2021-07-12', '2021-07-22', 1, 0, NULL, NULL, 0, NULL, NULL, 0, 0, NULL, 'Live', '2021-07-09 20:03:31', '2021-07-12 09:06:21', 1),
(83, 340, 22, '234', 1, '59284.xls', 10000, 9000, 7, '£ 0', '£ 269', '8101', 'sdfr', '2021-07-09', 1, NULL, 90, '2021-07-10', '2021-07-12', '2021-07-22', 1, 0, NULL, NULL, 0, NULL, NULL, 0, 0, NULL, 'Live', '2021-07-09 20:23:45', '2021-07-12 09:05:57', 0),
(84, 340, 23, '234', 1, '64881.xls', 10000, 9000, 7, '£ 0', '£ 269', '8101', '234', '2021-07-12', 30, NULL, 90, '2021-08-11', '2021-07-12', '2021-07-22', 1, 0, NULL, NULL, 0, NULL, NULL, 0, 0, NULL, 'Live', '2021-07-12 08:28:17', '2021-07-12 09:02:38', 1),
(85, 340, 22, '12', 1, '77858.xls', 50000, 45000, 10, '£ 0', '£ 1,346', '39154', 'jhgffgkjhgfdvbn', '2021-07-13', 11, NULL, 90, '2021-07-24', '2021-07-13', '2021-07-13', 1, 0, NULL, NULL, 0, NULL, NULL, 0, 0, NULL, 'Ended', '2021-07-13 12:06:32', '2021-07-13 12:14:05', 1),
(86, 340, 22, '10', 1, '40279.xls', 10000, 9000, 7, '£ 0', '£ 269', '7831', 'mngfmnbvcvb', '2021-07-19', 11, NULL, 90, '2021-07-30', '2021-07-19', '2021-07-29', 1, 0, NULL, NULL, 0, NULL, NULL, 0, 0, NULL, 'Live', '2021-07-19 15:50:22', '2021-07-19 15:53:05', 1),
(87, 340, 23, '32423', 1, '52645.xls', 10000, 9000, 7, '£ 0', '£ 269', '8101', 'sdasd', '2021-07-19', 30, NULL, 90, '2021-08-18', '2021-07-20', '2021-07-30', 1, 0, NULL, NULL, 0, NULL, NULL, 0, 0, NULL, 'Live', '2021-07-19 16:25:00', '2021-07-20 15:18:37', 1),
(88, 340, 23, '123', 1, '23452.xls', 10000, 9000, 7, '£ 0', '£ 269', '8101', 'sfsdf', '2021-07-20', 30, NULL, 90, '2021-08-19', '2021-07-20', '2021-07-30', 1, 0, NULL, NULL, 0, NULL, NULL, 0, 0, NULL, 'Live', '2021-07-20 15:15:27', '2021-07-20 15:20:12', 1),
(89, 340, 22, 'werwe', 1, '23569.xls', 10000, 9000, 7, '£ 0', '£ 269', '8101', 'werwe', '2021-07-20', 30, NULL, 90, '2021-08-19', '2021-07-20', '2021-07-30', 1, 0, NULL, NULL, 0, NULL, NULL, 0, 0, NULL, 'Live', '2021-07-20 15:16:32', '2021-07-20 15:19:29', 1),
(90, 340, 22, '21312', 1, '87626.xls', 10000, 9000, 7, '£ 0', '£ 269', '8101', '21312', '2021-07-22', 30, NULL, 90, '2021-08-21', '2021-07-22', '2021-07-29', 1, 0, NULL, NULL, 0, NULL, NULL, 0, 0, NULL, 'Live', '2021-07-22 17:11:18', '2021-07-22 17:15:25', 1),
(91, 340, 23, '123123', 1, '37727.xls', 10000, 9000, 7, '£ 0', '£ 269', '8101', 'dgfd', '2021-07-22', 30, NULL, 90, '2021-08-21', '2021-07-22', '2021-08-01', 1, 0, NULL, NULL, 0, NULL, NULL, 0, 0, NULL, 'Live', '2021-07-22 17:12:09', '2021-07-22 17:15:03', 1),
(92, 340, 22, '324', 1, '25799.xls', 10000, 9000, 7, '£ 0', '£ 269', '8101', 'wer', '2021-07-22', 30, NULL, 90, '2021-08-21', '2021-07-22', '2021-08-01', 1, 0, NULL, NULL, 0, NULL, NULL, 0, 0, NULL, 'Live', '2021-07-22 17:13:16', '2021-07-22 17:14:32', 1),
(93, 340, 22, '10', 1, '59113.xls', 10000, 9000, 7, '£ 0', '£ 269', '8101', 'mnbvcxvbnm,nbv', '2021-07-26', 25, NULL, 90, '2021-08-20', '2021-07-27', '2021-08-06', 1, 0, NULL, NULL, 0, NULL, NULL, 0, 0, NULL, 'Live', '2021-07-26 14:01:36', '2021-07-27 07:59:30', 0),
(94, 340, 22, '123', 1, '30498.xls', 10000, 9000, 7, '£ 0', '£ 269', '8101', 'dfgdfg', '2021-07-27', 30, NULL, 90, '2021-08-26', '2021-07-26', '2021-08-05', 1, 0, NULL, NULL, 0, NULL, NULL, 0, 0, NULL, 'Live', '2021-07-26 23:02:27', '2021-07-26 23:21:00', 1),
(95, 340, 23, '123', 1, '65182.xls', 10000, 9000, 7, '£ 0', '£ 269', '8101', 'df', '2021-07-27', 30, NULL, 90, '2021-08-26', '2021-07-26', '2021-08-05', 1, 0, NULL, NULL, 0, NULL, NULL, 0, 0, NULL, 'Live', '2021-07-26 23:16:37', '2021-07-26 23:19:53', 1),
(96, 340, 23, '23423', 1, '96147.xls', 10000, 9000, 7, '£ 0', '£ 269', '8101', 'sdfds', '2021-07-27', 30, NULL, 90, '2021-08-26', '2021-07-26', '2021-08-05', 1, 0, NULL, NULL, 0, NULL, NULL, 0, 0, NULL, 'Live', '2021-07-26 23:17:30', '2021-07-26 23:19:23', 1);

-- --------------------------------------------------------

--
-- Table structure for table `bank_details`
--

CREATE TABLE `bank_details` (
  `id` int(10) UNSIGNED NOT NULL,
  `user_id` int(10) UNSIGNED NOT NULL,
  `bank_name` varchar(191) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `account_name` varchar(191) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `account_number` int(11) DEFAULT NULL,
  `sort_code` varchar(191) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `swift` varchar(191) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `bic` varchar(191) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `iban` varchar(191) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `bank_details`
--

INSERT INTO `bank_details` (`id`, `user_id`, `bank_name`, `account_name`, `account_number`, `sort_code`, `swift`, `bic`, `iban`, `created_at`, `updated_at`) VALUES
(23, 338, 'adjfklasdjf', 'sdfasd', 123456, '123456', NULL, NULL, NULL, '2021-06-08 16:11:14', '2021-06-08 16:30:58'),
(25, 339, 'adjfklasdjf', 'sdfasd', 123456, '123456', NULL, NULL, NULL, '2021-06-08 16:11:14', '2021-06-08 16:30:58'),
(26, 345, 'sj  banks', 'SM technologies', 8786554, '123456', NULL, NULL, NULL, '2021-06-21 12:03:05', '2021-06-21 12:03:05'),
(27, 340, 'sj  banks', 'SM technologies', 8786554, '123456', NULL, NULL, NULL, '2021-06-22 12:42:21', '2021-06-22 12:42:21'),
(28, 346, 'jhxfgh', 'mhgdfgh', 12345, '123456', NULL, NULL, NULL, '2021-06-23 17:54:13', '2021-06-23 18:34:15'),
(29, 347, 'Bank of America', 'K', 80579523, '404040', NULL, NULL, NULL, '2021-06-25 23:41:56', '2021-06-25 23:41:56'),
(30, 351, 'Bank of America', 'K', 80579523, '404040', NULL, NULL, NULL, '2021-07-19 16:32:34', '2021-07-19 16:32:34'),
(31, 352, 'fvbdf', 'fdgd', 2525234, '342355', NULL, NULL, NULL, '2021-07-28 12:02:23', '2021-07-28 12:02:23'),
(32, 353, 'bnmbm', '6456', 75765, '564566', 'vcnhbvjn', NULL, 'hgjgh', '2021-07-28 12:13:52', '2021-07-28 12:13:52');

-- --------------------------------------------------------

--
-- Table structure for table `bank_statements`
--

CREATE TABLE `bank_statements` (
  `id` int(10) UNSIGNED NOT NULL,
  `user_id` int(10) UNSIGNED NOT NULL,
  `statement_name` varchar(191) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `status` int(11) DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `bank_statements`
--

INSERT INTO `bank_statements` (`id`, `user_id`, `statement_name`, `status`, `created_at`, `updated_at`) VALUES
(14, 338, 'user-338-bankStatement-1623186686.pdf', NULL, '2021-06-08 16:11:26', '2021-06-08 16:11:26'),
(15, 340, 'user-340-bankStatement-1624365876.png', NULL, '2021-06-22 12:44:36', '2021-06-22 12:44:36'),
(16, 346, 'user-346-bankStatement-1624473271.png', NULL, '2021-06-23 18:34:31', '2021-06-23 18:34:31'),
(17, 352, 'user-352-bankStatement-1627473806.jpg', NULL, '2021-07-28 12:03:26', '2021-07-28 12:03:26');

-- --------------------------------------------------------

--
-- Table structure for table `bids`
--

CREATE TABLE `bids` (
  `id` int(10) UNSIGNED NOT NULL,
  `user_id` int(10) UNSIGNED NOT NULL,
  `auction_id` int(10) UNSIGNED NOT NULL,
  `amount` decimal(10,2) UNSIGNED NOT NULL DEFAULT 0.00,
  `accepted_amount` decimal(10,2) DEFAULT NULL,
  `rank` int(11) DEFAULT NULL,
  `bid_discount` float UNSIGNED NOT NULL DEFAULT 0,
  `roi` float UNSIGNED DEFAULT NULL,
  `roi_in_pound` decimal(10,2) DEFAULT NULL,
  `approved` tinyint(1) NOT NULL DEFAULT 0,
  `paid` tinyint(1) DEFAULT 0,
  `paid_datetime` timestamp NULL DEFAULT NULL,
  `reference` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  `deleted_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `bids`
--

INSERT INTO `bids` (`id`, `user_id`, `auction_id`, `amount`, `accepted_amount`, `rank`, `bid_discount`, `roi`, `roi_in_pound`, `approved`, `paid`, `paid_datetime`, `reference`, `created_at`, `updated_at`, `deleted_at`) VALUES
(52, 339, 51, '500.00', NULL, NULL, 5, 5, '25.00', 1, 0, NULL, NULL, '2021-06-08 18:01:10', '2021-06-08 18:01:10', NULL),
(76, 339, 53, '840.00', NULL, NULL, 33.33, 33.3298, '279.97', 1, 0, NULL, NULL, '2021-06-23 13:55:00', '2021-06-24 11:35:02', NULL),
(77, 347, 53, '700.00', NULL, NULL, 2, NULL, '14.00', 1, 0, NULL, NULL, '2021-06-26 00:02:09', '2021-06-28 15:18:29', NULL),
(78, 347, 61, '8100.00', NULL, NULL, 0, 0, '0.00', 1, 0, NULL, NULL, '2021-06-29 12:43:08', '2021-06-29 15:45:11', NULL),
(79, 339, 66, '5078.00', NULL, NULL, 7.53, 7.52993, '382.37', 1, 0, NULL, NULL, '2021-06-30 13:12:13', '2021-07-05 04:41:45', NULL),
(80, 347, 63, '7621.00', NULL, NULL, 7.53, 7.53, '573.86', 1, 0, NULL, NULL, '2021-07-02 16:08:04', '2021-07-02 16:08:04', NULL),
(81, 339, 64, '4500.00', NULL, NULL, 33.33, 33.33, '1499.85', 1, 0, NULL, NULL, '2021-07-03 06:45:38', '2021-07-03 06:45:38', NULL),
(82, 339, 62, '578.00', '578.00', 1, 0, 0, '0.00', 1, 0, NULL, NULL, '2021-07-03 06:49:09', '2021-07-03 06:49:09', NULL),
(83, 339, 69, '45000.00', '45000.00', 1, 0, 0, '0.00', 1, 0, NULL, NULL, '2021-07-05 05:00:07', '2021-07-05 05:00:07', NULL),
(84, 347, 67, '7622.00', NULL, NULL, 11.11, 11.1099, '846.80', 1, 0, NULL, NULL, '2021-07-05 15:42:53', '2021-07-05 16:15:37', NULL),
(85, 347, 66, '1000.00', NULL, NULL, 7.57, 7.57, '75.70', 1, 0, NULL, NULL, '2021-07-05 15:43:54', '2021-07-05 15:43:54', NULL),
(86, 339, 70, '4160.00', NULL, NULL, 1, 1, '41.60', 1, 0, NULL, NULL, '2021-07-07 15:56:34', '2021-07-07 15:56:34', NULL),
(87, 347, 70, '999.00', NULL, NULL, 7.53, 7.53, '75.22', 1, 0, NULL, NULL, '2021-07-07 16:13:58', '2021-07-07 16:13:58', NULL),
(88, 347, 75, '900.00', NULL, NULL, 7.53, 7.53, '67.77', 1, 0, NULL, NULL, '2021-07-09 15:19:17', '2021-07-09 15:19:17', NULL),
(89, 339, 75, '520.00', NULL, NULL, 5, 5, '26.00', 1, 0, NULL, NULL, '2021-07-09 18:41:11', '2021-07-09 18:41:11', NULL),
(90, 339, 76, '300.00', '300.00', 1, 0, 0, '0.00', 1, 0, NULL, NULL, '2021-07-09 18:56:06', '2021-07-09 18:56:06', NULL),
(91, 347, 77, '5000.00', NULL, NULL, 7, 7, '350.00', 1, 0, NULL, NULL, '2021-07-11 15:24:11', '2021-07-11 15:24:11', NULL),
(92, 347, 84, '1500.00', NULL, NULL, 5, 5, '75.00', 1, 0, NULL, NULL, '2021-07-12 09:48:40', '2021-07-12 09:48:40', NULL),
(93, 339, 85, '45000.00', '45000.00', 1, 0, 0, '0.00', 1, 0, NULL, NULL, '2021-07-13 12:14:05', '2021-07-13 12:14:05', NULL),
(94, 339, 84, '6570.00', NULL, NULL, 8.11, 8.11, '532.83', 1, 0, NULL, NULL, '2021-07-13 17:27:31', '2021-07-13 17:27:31', NULL),
(95, 347, 83, '3000.00', NULL, NULL, 7, 7, '210.00', 1, 0, NULL, NULL, '2021-07-14 16:25:35', '2021-07-14 16:25:36', NULL),
(96, 347, 82, '750.00', NULL, NULL, 5, 5, '37.50', 1, 0, NULL, NULL, '2021-07-18 08:09:50', '2021-07-18 08:09:50', NULL),
(97, 347, 81, '950.00', NULL, NULL, 2.5, 2.5, '23.75', 1, 0, NULL, NULL, '2021-07-19 10:03:41', '2021-07-19 10:57:13', NULL),
(98, 347, 86, '1000.00', NULL, NULL, 7, 7, '70.00', 1, 0, NULL, NULL, '2021-07-19 16:07:06', '2021-07-25 17:19:43', NULL),
(99, 339, 86, '900.00', NULL, NULL, 5, 5, '45.00', 1, 0, NULL, NULL, '2021-07-19 16:14:22', '2021-07-22 23:24:55', NULL),
(100, 351, 86, '6500.00', NULL, NULL, 7, 7, '455.00', 1, 0, NULL, NULL, '2021-07-19 16:35:28', '2021-07-22 23:21:18', NULL),
(101, 347, 89, '800.00', NULL, NULL, 2.5, 2.5, '20.00', 1, 0, NULL, NULL, '2021-07-20 16:09:21', '2021-07-20 16:16:43', NULL),
(102, 339, 89, '750.00', NULL, NULL, 5, 5, '37.50', 1, 0, NULL, NULL, '2021-07-20 16:25:06', '2021-07-20 16:25:06', NULL),
(103, 351, 89, '950.00', NULL, NULL, 3, 3, '28.50', 1, 0, NULL, NULL, '2021-07-20 16:26:29', '2021-07-20 16:26:29', NULL),
(104, 351, 88, '800.00', NULL, NULL, 2.5, 2.5, '20.00', 1, 0, NULL, NULL, '2021-07-20 16:34:06', '2021-07-21 12:49:41', NULL),
(105, 351, 87, '800.00', NULL, NULL, 5, 5, '40.00', 1, 0, NULL, NULL, '2021-07-21 12:37:08', '2021-07-21 12:48:42', NULL),
(106, 351, 87, '750.00', NULL, NULL, 5, 5, '37.50', 1, 0, NULL, NULL, '2021-07-21 12:40:04', '2021-07-21 12:40:04', NULL),
(107, 351, 87, '750.00', NULL, NULL, 5, 5, '37.50', 1, 0, NULL, NULL, '2021-07-21 12:40:27', '2021-07-21 12:40:27', NULL),
(108, 351, 87, '750.00', NULL, NULL, 5, 5, '37.50', 1, 0, NULL, NULL, '2021-07-21 12:41:10', '2021-07-21 12:41:10', NULL),
(109, 351, 87, '750.00', NULL, NULL, 5, 5, '37.50', 1, 0, NULL, NULL, '2021-07-21 12:42:41', '2021-07-21 12:42:41', NULL),
(110, 351, 87, '750.00', NULL, NULL, 5, 5, '37.50', 1, 0, NULL, NULL, '2021-07-21 12:45:48', '2021-07-21 12:45:48', NULL),
(111, 347, 88, '900.00', NULL, NULL, 2.5, 2.5, '22.50', 1, 0, NULL, NULL, '2021-07-22 12:31:26', '2021-07-22 14:06:32', NULL),
(112, 339, 88, '750.00', NULL, NULL, 5, 5, '37.50', 1, 0, NULL, NULL, '2021-07-22 17:39:53', '2021-07-22 17:39:53', NULL),
(113, 339, 92, '750.00', NULL, NULL, 5, 5, '37.50', 1, 0, NULL, NULL, '2021-07-23 00:02:58', '2021-07-23 00:02:58', NULL),
(114, 347, 91, '800.00', NULL, NULL, 5, 5, '40.00', 1, 0, NULL, NULL, '2021-07-25 22:54:54', '2021-07-25 22:58:39', NULL),
(115, 351, 91, '950.00', NULL, NULL, 3, 3, '28.50', 1, 0, NULL, NULL, '2021-07-25 23:01:01', '2021-07-25 23:01:01', NULL),
(116, 351, 92, '500.00', NULL, NULL, 5, 5, '25.00', 1, 0, NULL, NULL, '2021-07-26 16:35:55', '2021-07-26 16:35:55', NULL),
(117, 339, 91, '6275.00', NULL, NULL, 7, 7, '439.25', 1, 0, NULL, NULL, '2021-07-26 21:25:02', '2021-07-26 21:44:55', NULL),
(118, 339, 90, '850.00', NULL, NULL, 5, 5, '42.50', 1, 0, NULL, NULL, '2021-07-26 22:57:58', '2021-07-26 22:59:26', NULL),
(122, 351, 96, '850.00', NULL, NULL, 5, 5, '42.50', 1, 0, NULL, NULL, '2021-07-26 23:40:47', '2021-07-26 23:41:37', NULL),
(123, 339, 96, '5780.00', NULL, NULL, 6, 6, '346.80', 1, 0, NULL, NULL, '2021-07-28 01:52:03', '2021-07-28 02:32:18', NULL),
(124, 339, 95, '530.00', NULL, NULL, 6, 6, '31.80', 1, 0, NULL, NULL, '2021-07-28 02:02:06', '2021-07-28 02:02:06', NULL),
(125, 347, 90, '8150.00', NULL, NULL, 5, 5, '407.50', 1, 0, NULL, NULL, '2021-07-29 11:25:14', '2021-07-29 11:25:14', NULL);

-- --------------------------------------------------------

--
-- Table structure for table `buyers`
--

CREATE TABLE `buyers` (
  `id` int(10) UNSIGNED NOT NULL,
  `user_id` int(10) UNSIGNED NOT NULL,
  `title` varchar(191) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `first_name` varchar(191) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `last_name` varchar(191) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `job_title` varchar(191) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `company_name` varchar(191) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `company_registration` varchar(191) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `company_registration_date` varchar(200) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `address_1` varchar(191) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `address_2` varchar(191) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `address_3` varchar(191) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `town` varchar(191) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `county` varchar(191) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `post_code` varchar(191) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `company_website` varchar(191) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `email` varchar(191) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `phone_code` varchar(191) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `phone` varchar(191) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `approved` tinyint(1) NOT NULL DEFAULT 2,
  `experian_rating` varchar(191) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `business_type` varchar(191) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  `turnover` int(11) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `buyers`
--

INSERT INTO `buyers` (`id`, `user_id`, `title`, `first_name`, `last_name`, `job_title`, `company_name`, `company_registration`, `company_registration_date`, `address_1`, `address_2`, `address_3`, `town`, `county`, `post_code`, `company_website`, `email`, `phone_code`, `phone`, `approved`, `experian_rating`, `business_type`, `created_at`, `updated_at`, `turnover`) VALUES
(19, 338, '0', 'dfasd', 'fFDSF', 'xzczxcd', 'xasxas', '12345678', '2000-06-15', 'fsdf', 'sdfsd', '123', '123', 'Islamabad', '45210', '45210', 'zaheer4195@gmail.com', '+923369981628', '+92 336 9981628', 1, 'Good', 'dfkjasdof', '2021-06-08 17:44:35', '2021-06-21 22:37:36', NULL),
(20, 338, NULL, 'Shahzeb', 'Naseer', 'gfghg', 'SM technologies', '1162', '2021-06-10', 'gfhjgff', NULL, NULL, 'bcghgf', 'gffg', 'gfdfghgfd', '92', 'hfdghh', '92', '+923323335361', 1, NULL, 'hfdsfgfdf', '2021-06-23 09:45:59', '2021-06-24 12:01:20', NULL),
(21, 338, '0', 'Shahzeb sb', 'Khan', 'Director', 'Shahzeb Company', '12345677', NULL, 'Garan', 'Fulwood', NULL, 'Rehara', 'Lancashire', '20012', NULL, 'sadfdsfs@sdfds.com', '01772', '525252', 1, 'Good', 'Buying stuff', '2021-06-24 17:46:18', '2021-06-24 17:49:10', NULL),
(22, 340, '0', 'jhgfdsgh', 'hgfdsdfg', 'jhgfdnbv', 'sds', '3456', '2021-06-17', 'hfgjhgf', NULL, NULL, 'jhgfdsgh', NULL, 'mjhgfdfgjh', NULL, 'mnjhgfdxcvb', '44', '44545634654', 1, NULL, 'hfdsfgfdf', '2021-06-25 12:28:31', '2021-06-25 12:32:39', NULL),
(23, 340, '0', 'kjhgfjhgf', 'nbgb', 'bvvc', 'shahzeb', '7675', '2021-06-05', 'mjhgffgh', NULL, NULL, 'mjhvbv', NULL, 'hgfdfg', NULL, 'ncxvb', '7678', '67887667', 1, NULL, 'nbvvccbv', '2021-06-25 12:31:10', '2021-07-07 13:35:50', NULL),
(24, 346, '0', 'nhgfdf', 'fdxbvcx', 'hgdfg', 'nmgfdhg', '1162', '2021-07-14', 'jhgfds', NULL, NULL, 'njhgfsghj', NULL, 'hjgfdsh', NULL, 'nxzcvbv', 'hgfg', 'hgfghgfc', 1, NULL, 'nbvsdb', '2021-07-05 03:49:24', '2021-07-07 07:16:20', NULL),
(25, 346, NULL, 'Shahzeb', 'Naseer', 'cvcb', 'nmgfdhg', '1162', '2021-07-14', 'ffdfdfrd', NULL, NULL, 'fgffd', 'gffg', '92', '92', 'bhfggzxc', 'nvb', 'bvxv', 1, NULL, 'bvb', '2021-07-05 03:50:18', '2021-07-05 04:54:21', NULL),
(26, 346, NULL, 'Shahzeb', 'Naseer', 'hghgh', 'sds', 'bvcxcbv', NULL, 'ffdfdfrd', NULL, NULL, 'fgffd', 'gffg', '92', '92', 'admin@fundingjoint.com', '92', 'bvcv', 1, NULL, 'nbcvbv', '2021-07-05 03:54:42', '2021-07-05 04:53:26', NULL),
(27, 346, NULL, 'Shahzeb', 'Naseer', 'jhgh', 'sds', '1162', NULL, 'ffdfdfrd', NULL, NULL, 'fgffd', 'gffg', '92', '92', 'nbvgh', 'jb', 'bc', 1, NULL, 'bx', '2021-07-05 04:47:26', '2021-07-05 04:51:18', NULL);

-- --------------------------------------------------------

--
-- Table structure for table `buyer_transactions`
--

CREATE TABLE `buyer_transactions` (
  `id` int(11) NOT NULL,
  `invoice_amount` decimal(10,0) NOT NULL,
  `auction_id` int(11) NOT NULL,
  `invoice_repayment_due_date` date NOT NULL,
  `amount_received` decimal(10,0) NOT NULL,
  `date_of_receipt` date NOT NULL,
  `reference` varchar(100) NOT NULL,
  `outstanding_balance` decimal(10,0) NOT NULL,
  `days_overdue` int(11) DEFAULT NULL,
  `payment_status` varchar(100) NOT NULL,
  `status` varchar(100) NOT NULL DEFAULT 'Paid',
  `created_at` timestamp NOT NULL DEFAULT current_timestamp(),
  `updated_at` timestamp NULL DEFAULT NULL ON UPDATE current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

-- --------------------------------------------------------

--
-- Table structure for table `comments`
--

CREATE TABLE `comments` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `commenter_id` bigint(20) UNSIGNED NOT NULL,
  `commentable_type` varchar(191) COLLATE utf8mb4_unicode_ci NOT NULL,
  `commentable_id` bigint(20) UNSIGNED NOT NULL,
  `comment` text COLLATE utf8mb4_unicode_ci NOT NULL,
  `child_id` bigint(20) UNSIGNED DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `comments`
--

INSERT INTO `comments` (`id`, `commenter_id`, `commentable_type`, `commentable_id`, `comment`, `child_id`, `created_at`, `updated_at`) VALUES
(136, 345, 'App\\Model\\Comment', 345, 'nbgvnmjnhb', 1, '2021-06-21 13:56:31', '2021-06-21 13:56:31'),
(137, 345, 'App\\Model\\Comment', 345, 'hi ', 1, '2021-06-22 08:20:14', '2021-06-22 08:20:14'),
(138, 339, 'App\\Model\\Comment', 339, 'jhggjhgfdggh', 1, '2021-06-24 12:00:44', '2021-06-24 12:00:44'),
(139, 340, 'App\\Model\\Comment', 340, 'lkjhghjklkjhgzxvbnm,mnbvcxzxcvbnm,mdcvbn', 1, '2021-06-24 12:12:42', '2021-06-24 12:12:42'),
(140, 346, 'App\\Model\\Comment', 346, 'jhdghjhgfdjhgfgh', 1, '2021-06-24 17:51:32', '2021-06-24 17:51:32'),
(141, 340, 'App\\Model\\Comment', 340, 'kjhgfhgfg', 1, '2021-06-25 12:12:13', '2021-06-25 12:12:13'),
(142, 340, 'App\\Model\\Comment', 340, 'hi  whats up', 1, '2021-06-30 11:30:51', '2021-06-30 11:30:51'),
(143, 346, 'App\\Model\\Comment', 346, 'mnbvcvnbcx', 1, '2021-06-30 11:52:21', '2021-06-30 11:52:21'),
(144, 347, 'App\\Model\\Comment', 347, ',mjnhgfxcvbnm,mnbvcvbnm,mnbvbnmnbvmnbvbnmnbvbnbv', 1, '2021-07-29 02:29:44', '2021-07-29 02:29:44');

-- --------------------------------------------------------

--
-- Table structure for table `documents`
--

CREATE TABLE `documents` (
  `id` int(10) UNSIGNED NOT NULL,
  `user_id` int(10) UNSIGNED NOT NULL,
  `type_proof` varchar(191) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `file_name` varchar(191) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `documents`
--

INSERT INTO `documents` (`id`, `user_id`, `type_proof`, `file_name`, `created_at`, `updated_at`) VALUES
(1, 3, 'identity', 'Funding Joint Ltd (26226) Auction Process.xlsx', '2018-11-16 14:32:04', '2018-11-16 14:32:04'),
(2, 3, 'address', 'Funding Joint Ltd (26226) Auction Process.xlsx', '2018-11-16 14:32:17', '2018-11-16 14:32:17'),
(3, 63, 'identity', 'IMG_6106c.jpg', '2018-11-26 16:29:29', '2018-11-26 16:29:29'),
(4, 63, 'address', 'IMG_6106cb.jpg', '2018-11-26 16:30:05', '2018-11-26 16:30:05'),
(5, 72, 'identity', '20181119_WO52446_chelgate-local-slider-testimonial.pdf', '2018-11-27 15:11:05', '2018-11-27 15:11:05'),
(6, 72, 'address', '20181119_WO52446_chelgate-local-slider-testimonial.pdf', '2018-11-27 15:11:16', '2018-11-27 15:11:16'),
(7, 74, 'identity', 'Cv_Stefan_Izdrail_No_Infos.pdf', '2018-11-28 11:13:16', '2018-11-28 11:13:16'),
(8, 74, 'address', 'Cv_Stefan_Izdrail_No_Infos.pdf', '2018-11-28 11:13:21', '2018-11-28 11:13:21'),
(9, 79, 'identity', 'sample.pdf', '2018-11-28 15:13:50', '2018-11-28 15:13:50'),
(10, 79, 'address', 'sample.pdf', '2018-11-28 15:13:58', '2018-11-28 15:13:58'),
(11, 85, 'identity', 'Dummy Statement 2.docx', '2018-12-04 16:25:30', '2018-12-04 16:25:30'),
(12, 85, 'address', 'Hasib Bank Statement 1.docx', '2018-12-04 16:28:41', '2018-12-04 16:28:41'),
(13, 100, 'identity', 'user-100-proof-documents-2018-12-20.png', '2018-12-20 13:26:08', '2018-12-20 13:26:08'),
(14, 100, 'address', 'user-100-proof-documents-2018-12-20.png', '2018-12-20 13:26:13', '2018-12-20 13:26:13'),
(15, 102, 'identity', 'user-102-proof-documents-2018-12-20.png', '2018-12-20 16:04:14', '2018-12-20 16:04:14'),
(16, 102, 'address', 'user-102-proof-documents-2018-12-20.png', '2018-12-20 16:04:30', '2018-12-20 16:04:30'),
(17, 104, 'identity', 'user-104-proof-documents-2018-12-30.pdf', '2018-12-30 15:11:57', '2018-12-30 15:11:57'),
(18, 104, 'address', 'user-104-proof-documents-2018-12-30.pdf', '2018-12-30 15:12:13', '2018-12-30 15:12:13'),
(19, 113, 'identity', 'user_113_document_1547828642_20190111_WO55246_leaderboard-bid-overfunding-calculations.pdf', '2019-01-18 16:24:02', '2019-01-18 16:24:02'),
(20, 113, 'address', 'user_113_document_1547828666_20190111_WO55246_leaderboard-bid-overfunding-calculations.pdf', '2019-01-18 16:24:26', '2019-01-18 16:24:26'),
(21, 117, 'identity', 'user_117_document_1548172354_Dummy Statement 1.pdf', '2019-01-22 15:52:34', '2019-01-22 15:52:34'),
(22, 117, 'address', 'user_117_document_1548172367_Dummy Statement 2.pdf', '2019-01-22 15:52:47', '2019-01-22 15:52:47'),
(23, 118, 'identity', 'user_118_document_1548178658_Dummy Statement 1.pdf', '2019-01-22 17:37:38', '2019-01-22 17:37:38'),
(24, 118, 'address', 'user_118_document_1548178663_Dummy Statement 2.pdf', '2019-01-22 17:37:43', '2019-01-22 17:37:43'),
(25, 116, 'identity', 'user_116_document_1548242444_profile_user.jpg', '2019-01-23 11:20:44', '2019-01-23 11:20:44'),
(26, 116, 'address', 'user_116_document_1548242450_profile_user.jpg', '2019-01-23 11:20:50', '2019-01-23 11:20:50'),
(27, 119, 'identity', 'user_119_document_1548428611_Dummy Statement 1.pdf', '2019-01-25 15:03:31', '2019-01-25 15:03:31'),
(28, 119, 'address', 'user_119_document_1548428625_Dummy Statement 2.pdf', '2019-01-25 15:03:45', '2019-01-25 15:03:45'),
(29, 134, 'identity', 'user_134_document_1554471487.png', '2019-04-05 13:38:07', '2019-04-05 13:38:07'),
(30, 134, 'address', 'user_134_document_1554471499.png', '2019-04-05 13:38:19', '2019-04-05 13:38:19'),
(31, 137, 'identity', 'user_137_document_1555304505.png', '2019-04-15 05:01:45', '2019-04-15 05:01:45'),
(32, 137, 'address', 'user_137_document_1555304516.png', '2019-04-15 05:01:56', '2019-04-15 05:01:56'),
(33, 136, 'identity', 'user_136_document_1556792217.jpeg', '2019-05-02 10:16:57', '2019-05-02 10:16:57'),
(34, 136, 'address', 'user_136_document_1556792223.jpeg', '2019-05-02 10:17:03', '2019-05-02 10:17:03'),
(35, 209, 'identity', 'user_209_document_1562741277.jpg', '2019-07-10 06:47:57', '2019-07-10 06:47:57'),
(36, 209, 'identity', 'user_209_document_1562741330.jpg', '2019-07-10 06:48:50', '2019-07-10 06:48:50'),
(37, 209, 'identity', 'user_209_document_1562741791.jpg', '2019-07-10 06:56:31', '2019-07-10 06:56:31'),
(38, 209, 'address', 'user_209_document_1562742055.png', '2019-07-10 07:00:55', '2019-07-10 07:00:55'),
(39, 209, 'address', 'user_209_document_1562742068.png', '2019-07-10 07:01:08', '2019-07-10 07:01:08'),
(40, 209, 'address', 'user_209_document_1562742281.png', '2019-07-10 07:04:41', '2019-07-10 07:04:41'),
(41, 209, 'identity', 'user_209_document_1562742553.jpg', '2019-07-10 07:09:13', '2019-07-10 07:09:13'),
(42, 194, 'identity', 'user_194_document_1562751854.pdf', '2019-07-10 09:44:14', '2019-07-10 09:44:14'),
(43, 194, 'address', 'user_194_document_1562751869.pdf', '2019-07-10 09:44:29', '2019-07-10 09:44:29'),
(44, 212, 'identity', 'user_212_document_1562757071.jpg', '2019-07-10 11:11:11', '2019-07-10 11:11:11'),
(45, 212, 'identity', 'user_212_document_1562757082.jpg', '2019-07-10 11:11:22', '2019-07-10 11:11:22'),
(46, 212, 'address', 'user_212_document_1562757101.jpeg', '2019-07-10 11:11:41', '2019-07-10 11:11:41'),
(47, 212, 'address', 'user_212_document_1562757398.jpeg', '2019-07-10 11:16:38', '2019-07-10 11:16:38'),
(48, 216, 'address', 'user_216_document_1563346117.jpg', '2019-07-17 06:48:37', '2019-07-17 06:48:37'),
(49, 216, 'identity', 'user_216_document_1563346164.jpg', '2019-07-17 06:49:24', '2019-07-17 06:49:24'),
(50, 217, 'identity', 'user_217_document_1563519220.jpg', '2019-07-19 06:53:40', '2019-07-19 06:53:40'),
(51, 217, 'address', 'user_217_document_1563519314.png', '2019-07-19 06:55:14', '2019-07-19 06:55:14'),
(52, 220, 'address', 'user_220_document_1563529078.png', '2019-07-19 09:37:58', '2019-07-19 09:37:58'),
(53, 220, 'identity', 'user_220_document_1563529078.jpg', '2019-07-19 09:37:58', '2019-07-19 09:37:58'),
(54, 222, 'address', 'user_222_document_1564499281.pdf', '2019-07-30 19:08:01', '2019-07-30 19:08:01'),
(55, 222, 'identity', 'user_222_document_1564499295.pdf', '2019-07-30 19:08:15', '2019-07-30 19:08:15'),
(56, 225, 'identity', 'user_225_document_1565077490.png', '2019-08-06 11:44:50', '2019-08-06 11:44:50'),
(57, 225, 'address', 'user_225_document_1565077502.png', '2019-08-06 11:45:02', '2019-08-06 11:45:02'),
(58, 233, 'identity', 'user_233_document_1566466295.pdf', '2019-08-22 13:31:35', '2019-08-22 13:31:35'),
(59, 233, 'address', 'user_233_document_1566466304.pdf', '2019-08-22 13:31:44', '2019-08-22 13:31:44'),
(60, 241, 'identity', 'user_241_document_1568025550.png', '2019-09-09 14:39:10', '2019-09-09 14:39:10'),
(61, 241, 'address', 'user_241_document_1568025560.png', '2019-09-09 14:39:20', '2019-09-09 14:39:20'),
(62, 231, 'identity', 'user_231_document_1569482795.png', '2019-09-26 11:26:35', '2019-09-26 11:26:35'),
(63, 231, 'address', 'user_231_document_1569482801.png', '2019-09-26 11:26:41', '2019-09-26 11:26:41'),
(64, 131, 'identity', 'user_131_document_1569484950.png', '2019-09-26 12:02:30', '2019-09-26 12:02:30'),
(65, 131, 'address', 'user_131_document_1569484959.png', '2019-09-26 12:02:39', '2019-09-26 12:02:39'),
(66, 266, 'identity', 'user_266_document_1578308720.png', '2020-01-06 11:05:20', '2020-01-06 11:05:20'),
(67, 266, 'address', 'user_266_document_1578308726.png', '2020-01-06 11:05:26', '2020-01-06 11:05:26'),
(68, 273, 'identity', 'user_273_document_1589541796.pdf', '2020-05-15 11:23:16', '2020-05-15 11:23:16'),
(69, 273, 'address', 'user_273_document_1589541804.pdf', '2020-05-15 11:23:24', '2020-05-15 11:23:24'),
(70, 275, 'address', 'user_275_document_1589802591.png', '2020-05-18 11:49:51', '2020-05-18 11:49:51'),
(71, 275, 'identity', 'user_275_document_1589802603.png', '2020-05-18 11:50:03', '2020-05-18 11:50:03'),
(72, 279, 'identity', 'user_279_document_1591906952.png', '2020-06-11 20:22:32', '2020-06-11 20:22:32'),
(73, 279, 'address', 'user_279_document_1591906967.png', '2020-06-11 20:22:47', '2020-06-11 20:22:47'),
(74, 281, 'identity', 'user_281_document_1593519454.png', '2020-06-30 12:17:34', '2020-06-30 12:17:34'),
(75, 281, 'address', 'user_281_document_1593519472.png', '2020-06-30 12:17:52', '2020-06-30 12:17:52'),
(76, 286, 'identity', 'user_286_document_1594307454.png', '2020-07-09 15:10:54', '2020-07-09 15:10:54'),
(77, 286, 'address', 'user_286_document_1594307463.png', '2020-07-09 15:11:03', '2020-07-09 15:11:03'),
(78, 289, 'identity', 'user_289_document_1598437664.png', '2020-08-26 10:27:44', '2020-08-26 10:27:44'),
(79, 289, 'address', 'user_289_document_1598437765.png', '2020-08-26 10:29:25', '2020-08-26 10:29:25'),
(80, 292, 'identity', 'user_292_document_1598862428.png', '2020-08-31 08:27:08', '2020-08-31 08:27:08'),
(81, 292, 'address', 'user_292_document_1598862438.png', '2020-08-31 08:27:18', '2020-08-31 08:27:18'),
(82, 293, 'identity', 'user_293_document_1598864066.png', '2020-08-31 08:54:26', '2020-08-31 08:54:26'),
(83, 293, 'address', 'user_293_document_1598864072.png', '2020-08-31 08:54:32', '2020-08-31 08:54:32'),
(84, 294, 'identity', 'user_294_document_1598870906.png', '2020-08-31 10:48:26', '2020-08-31 10:48:26'),
(85, 294, 'address', 'user_294_document_1598870911.png', '2020-08-31 10:48:31', '2020-08-31 10:48:31'),
(86, 295, 'identity', 'user_295_document_1598873064.png', '2020-08-31 11:24:24', '2020-08-31 11:24:24'),
(87, 295, 'address', 'user_295_document_1598873069.png', '2020-08-31 11:24:29', '2020-08-31 11:24:29'),
(88, 302, 'identity', 'user_302_document_1598952912.pdf', '2020-09-01 09:35:12', '2020-09-01 09:35:12'),
(89, 302, 'address', 'user_302_document_1598952918.pdf', '2020-09-01 09:35:18', '2020-09-01 09:35:18'),
(90, 305, 'identity', 'user_305_document_1598957622.pdf', '2020-09-01 10:53:42', '2020-09-01 10:53:42'),
(91, 305, 'address', 'user_305_document_1598957630.pdf', '2020-09-01 10:53:50', '2020-09-01 10:53:50'),
(92, 307, 'identity', 'user_307_document_1601633756.pdf', '2020-10-02 10:15:56', '2020-10-02 10:15:56'),
(93, 307, 'address', 'user_307_document_1601633763.pdf', '2020-10-02 10:16:03', '2020-10-02 10:16:03'),
(94, 309, 'identity', 'user_309_document_1601705353.pdf', '2020-10-03 06:09:13', '2020-10-03 06:09:13'),
(95, 309, 'address', 'user_309_document_1601705406.pdf', '2020-10-03 06:10:06', '2020-10-03 06:10:06'),
(96, 310, 'identity', 'user_310_document_1601708824.pdf', '2020-10-03 07:07:04', '2020-10-03 07:07:04'),
(97, 310, 'address', 'user_310_document_1601708829.pdf', '2020-10-03 07:07:09', '2020-10-03 07:07:09'),
(98, 311, 'identity', 'user_311_document_1601971525.png', '2020-10-06 08:05:25', '2020-10-06 08:05:25'),
(99, 311, 'address', 'user_311_document_1601971533.png', '2020-10-06 08:05:33', '2020-10-06 08:05:33'),
(100, 313, 'identity', 'user_313_document_1601979517.jpg', '2020-10-06 10:18:37', '2020-10-06 10:18:37'),
(101, 313, 'address', 'user_313_document_1601979525.jpg', '2020-10-06 10:18:45', '2020-10-06 10:18:45'),
(102, 317, 'identity', 'user_317_document_1602746803.pdf', '2020-10-15 07:26:43', '2020-10-15 07:26:43'),
(103, 317, 'address', 'user_317_document_1602746811.pdf', '2020-10-15 07:26:51', '2020-10-15 07:26:51'),
(104, 318, 'identity', 'user_318_document_1602747239.pdf', '2020-10-15 07:33:59', '2020-10-15 07:33:59'),
(105, 318, 'address', 'user_318_document_1602747246.pdf', '2020-10-15 07:34:06', '2020-10-15 07:34:06'),
(106, 319, 'identity', 'user_319_document_1602747600.pdf', '2020-10-15 07:40:00', '2020-10-15 07:40:00'),
(107, 319, 'address', 'user_319_document_1602747607.pdf', '2020-10-15 07:40:07', '2020-10-15 07:40:07'),
(108, 322, 'identity', 'user_322_document_1605374987.pdf', '2020-11-14 17:29:47', '2020-11-14 17:29:47'),
(109, 322, 'address', 'user_322_document_1605374998.pdf', '2020-11-14 17:29:58', '2020-11-14 17:29:58'),
(110, 323, 'identity', 'user_323_document_1605376305.pdf', '2020-11-14 17:51:45', '2020-11-14 17:51:45'),
(111, 323, 'address', 'user_323_document_1605376318.pdf', '2020-11-14 17:51:58', '2020-11-14 17:51:58'),
(112, 335, 'address', 'user_335_document_1622216343.pdf', '2021-05-28 10:39:03', '2021-05-28 10:39:03'),
(113, 335, 'identity', 'user_335_document_1622216343.pdf', '2021-05-28 10:39:03', '2021-05-28 10:39:03'),
(114, 335, 'address', 'user_335_document_1623152587.pdf', '2021-06-08 06:43:07', '2021-06-08 06:43:07'),
(115, 335, 'identity', 'user_335_document_1623152588.pdf', '2021-06-08 06:43:08', '2021-06-08 06:43:08'),
(116, 339, 'address', 'user_339_document_1623193121.pdf', '2021-06-08 17:58:41', '2021-06-08 17:58:41'),
(117, 339, 'identity', 'user_339_document_1623193121.pdf', '2021-06-08 17:58:41', '2021-06-08 17:58:41'),
(118, 347, 'identity', 'user_347_document_1624664720.pdf', '2021-06-25 23:45:20', '2021-06-25 23:45:20'),
(119, 347, 'address', 'user_347_document_1624664737.pdf', '2021-06-25 23:45:37', '2021-06-25 23:45:37'),
(120, 351, 'identity', 'user_351_document_1626712383.pdf', '2021-07-19 16:33:03', '2021-07-19 16:33:03'),
(121, 351, 'address', 'user_351_document_1626712395.pdf', '2021-07-19 16:33:15', '2021-07-19 16:33:15'),
(122, 353, 'identity', 'user_353_document_1627474448.jpg', '2021-07-28 12:14:08', '2021-07-28 12:14:08'),
(123, 353, 'address', 'user_353_document_1627474454.jpg', '2021-07-28 12:14:14', '2021-07-28 12:14:14');

-- --------------------------------------------------------

--
-- Table structure for table `homepage_section`
--

CREATE TABLE `homepage_section` (
  `id` int(10) UNSIGNED NOT NULL,
  `title` text COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `slug` char(191) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `content` longtext COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `homepage_section`
--

INSERT INTO `homepage_section` (`id`, `title`, `slug`, `content`, `created_at`, `updated_at`) VALUES
(1, 'Funding Opportunities', 'funding', ' <p>             Lorem ipsum dolor sit amet, consectetur adipiscing elit. Cras ut laoreet turpis. In sed turpis             sagittis, iaculis velit sed, convallis arcu. Praesent magna egestas accumsan.         </p>         <div class=\"row\">             <div class=\"col col-sm-4\">                 <div class=\"op-icon\">                     <img src=\"assets/img/cash-icon.png\" alt=\"Quick funding\">                     <p>                       Generate quick                       funding                     </p>                 </div>             </div>             <div class=\"col col-sm-4\">                 <div class=\"op-icon\">                     <img src=\"assets/img/bank-icon.png\" alt=\"Unlimited auctions\">                     <p>                       Create unlimited                       auctions                     </p>                 </div>             </div>             <div class=\"col col-sm-4\">                 <div class=\"op-icon\">                     <img src=\"assets/img/settings-icon.png\" alt=\"Set and Control\">                     <p>                       Set and control                       finance terms                     </p>                 </div>             </div>         </div>         <div class=\"row justify-content-center invest-button\">           <a href=\"/registration/seller\" class=\"btn btn-primary waves-effect waves-light\">Fund your business </a>         </div>\n', '2018-11-16 13:29:43', '2018-11-16 13:29:43'),
(2, 'Investor Opportunities', 'investor', '        <p>\n            Lorem ipsum dolor sit amet, consectetur adipiscing elit. Cras ut laoreet turpis. In sed turpis\n            sagittis, iaculis velit sed, convallis arcu. Praesent magna egestas accumsan.\n        </p>\n        <div class=\"row\">\n          <div class=\"col-sm\">\n            <div class=\"op-icon\">\n              <img src=\"assets/img/coin-icon.png\" alt=\"Browse marketplace\"/>\n              <p>\n                Browse marketplace\n              </p>\n            </div>\n          </div>\n          <div class=\"col-sm\">\n            <div class=\"op-icon\">\n              <img src=\"assets/img/safe.png\" alt=\"Safe investment opportunities\"/>\n              <p>\n                Safe investment opportunities\n              </p>\n            </div>\n          </div>\n          <div class=\"col-sm\">\n            <div class=\"op-icon\">\n              <img src=\"assets/img/settings-icon.png\" alt=\"Control your ROI\"/>\n              <p>\n                Control your ROI\n              </p>\n            </div>\n          </div>\n        </div>\n        <div class=\"row justify-content-center invest-button-secondary\">\n          <a href=\"/registration/investor\" class=\"btn btn-danger\">Start Investing\n          </a>\n        </div>', '2018-11-16 13:29:43', '2018-11-16 13:29:43'),
(3, 'How The Platform Works', 'how-the-platform-works', '<div class=\"row\">\n<div class=\"col-12 col-md\">\n <p class=\"platform-copy text-center\">Lorem ipsum dolor sit amet, consectetur adipiscing elit. Cras ut laoreet turpis. In sed turpis sagittis, iaculis convallis velit sed, convallis laoreetarcu.</p>\n</div>\n</div>\n<div class=\"row\">\n    <div class=\"col-12 col-md working-points\">\n      <div class=\"row\">\n        <div class=\"col-0 col-md\">\n\n        </div>\n        <div class=\"col\">\n          <div class=\"row bullet-row\">\n            <div class=\"col\">\n              <p>\n                <img src=\"assets/img/notes.png\" alt=\"Register\">\n                Create and register your business profile or register as an investor.\n              </p>\n            </div>\n          </div>\n          <div class=\"row bullet-row\">\n            <div class=\"col\">\n              <p>\n                <img src=\"assets/img/bullet-bank.png\" alt=\"Create\">\n                Create an auction in the marketplace and set your terms to raise business funds.\n              </p>\n            </div>\n          </div>\n          <div class=\"row bullet-row\">\n            <div class=\"col\">\n              <p>\n                <img src=\"assets/img/bullet-coin.png\" alt=\"Investors\">\n                Investors browse and bid to invest in credit-worthy, short-term opportunities.\n              </p>\n            </div>\n          </div>\n          <div class=\"row bullet-row\">\n            <div class=\"col\">\n              <p>\n                <img src=\"assets/img/bullet-leader.png\" alt=\"Leaderboard\">\n                Leaderboard displays auction dynamics. Most competitive bids fund the\n                opportunity.\n              </p>\n            </div>\n          </div>\n          <div class=\"row bullet-row\">\n            <div class=\"col\">\n              <p>\n                <img src=\"assets/img/bullet-face.png\" alt=\"Funds\">\n                Funds are released to business. Repayments and returns are collected on behalf of\n                investors.\n              </p>\n            </div>\n          </div>\n        </div>\n      </div>\n    </div>\n    <div class=\"col-12 col-md p-0 right-background\"><!--container for ipad background image-->\n\n    </div>\n  </div>', '2018-11-16 13:29:43', '2018-11-16 13:29:43'),
(4, 'create-auction-info', NULL, '<p>create-auction-info<span id=\"pastemarkerend\">  description</span><br>\n\n</p>', '2019-05-30 09:21:40', '2019-05-30 09:21:40');

-- --------------------------------------------------------

--
-- Table structure for table `inquiry`
--

CREATE TABLE `inquiry` (
  `id` int(11) NOT NULL,
  `name` varchar(255) NOT NULL,
  `email` varchar(255) NOT NULL,
  `type` varchar(20) NOT NULL DEFAULT 'Investor',
  `created_at` timestamp NOT NULL DEFAULT current_timestamp(),
  `updated_at` timestamp NULL DEFAULT NULL ON UPDATE current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `inquiry`
--

INSERT INTO `inquiry` (`id`, `name`, `email`, `type`, `created_at`, `updated_at`) VALUES
(6, 'shahzeb', 'shahzebnaseer76@gmail.com', 'Investor', '2021-06-21 11:03:00', '2021-06-21 11:03:00'),
(7, 'shahzeb', 'shahzebnaseer@hotmail.com', 'Investor', '2021-06-21 13:40:32', '2021-06-21 13:40:32'),
(8, 'Muhammad Zaheer Ud Din', 'zaheer4195@gmail.com', 'Investor', '2021-06-21 14:22:25', '2021-06-21 14:22:25'),
(9, 'Khalid Khan', 'khalidkhan7408@hotmail.com', 'Investor', '2021-06-21 15:39:00', '2021-06-21 15:39:00'),
(10, 'K K Downing - Coming soon', 'khalidkhan7408@hotmail.com', 'Investor', '2021-06-21 22:24:57', '2021-06-21 22:24:57'),
(11, 'Shahzeb Naseer', 'shahzebnaseer@hotmail.com', 'Investor', '2021-06-29 09:14:32', '2021-06-29 09:14:32'),
(12, 'shahzeb', 'shahzebnaseer76@gmail.com', 'Investor', '2021-06-30 11:24:59', '2021-06-30 11:24:59');

-- --------------------------------------------------------

--
-- Table structure for table `investors`
--

CREATE TABLE `investors` (
  `id` int(10) UNSIGNED NOT NULL,
  `user_id` int(10) UNSIGNED NOT NULL,
  `title` varchar(191) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `first_name` varchar(191) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `last_name` varchar(191) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `middle_name` varchar(191) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `user_name` varchar(191) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `dob` date DEFAULT NULL,
  `nationality` varchar(191) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `gender` varchar(191) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `phone_code` varchar(191) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `phone` varchar(191) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `country_residence` varchar(191) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `building_no` varchar(191) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `address_1` varchar(191) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `address_2` varchar(191) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `address_3` varchar(191) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `town` varchar(191) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `county` varchar(191) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `post_code` varchar(191) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `country` varchar(191) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `read_investors_declaration` tinyint(1) NOT NULL DEFAULT 0,
  `source_of_funds` varchar(191) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `job_title` varchar(191) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `employer_name` varchar(191) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `nature_employers_business` varchar(191) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `agree` tinyint(1) NOT NULL DEFAULT 0,
  `location_of_business` varchar(191) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `investors`
--

INSERT INTO `investors` (`id`, `user_id`, `title`, `first_name`, `last_name`, `middle_name`, `user_name`, `dob`, `nationality`, `gender`, `phone_code`, `phone`, `country_residence`, `building_no`, `address_1`, `address_2`, `address_3`, `town`, `county`, `post_code`, `country`, `read_investors_declaration`, `source_of_funds`, `job_title`, `employer_name`, `nature_employers_business`, `agree`, `location_of_business`, `created_at`, `updated_at`) VALUES
(12, 339, 'Mr', 'investot', 'asdf', 'asdasd', 'investor12', '2000-01-01', 'Pakistani', 'male', '123', '+923369981628', 'Palau', 'sdafkjadslf', 'fsdf', 'sdfsd', '123', '123', 'Islamabad', '45210', NULL, 1, '40000', 'Laravel Developer', 'xczxc', 'uni', 1, NULL, '2021-06-08 17:56:20', '2021-06-08 17:58:41'),
(13, 345, 'Mr', 'Shahzeb', 'Naseer', NULL, 'dsd', '1997-01-10', 'Pakistani', 'male', '92', '+923323335361', 'United Kingdom', 'ttuyyty', 'ffdfdfrd', NULL, NULL, 'fgffd', 'gffg', '92', 'Pakistan', 1, 'gffg', 'hghgh', 'ghgfg', 'bgfggjhgf', 0, NULL, '2021-06-21 12:02:24', '2021-06-21 12:02:24'),
(14, 347, 'Mr', 'Invest', 'Alot', NULL, 'MrInvestALot', '1973-01-01', 'Ugandan', 'male', '01772', '2345665', 'Uganda', '2899', 'The Avenue', NULL, NULL, 'The Town', NULL, 'LA1 3DW', 'land Islands', 1, 'earned it', 'Earn a lot', 'givea lot', 'giving', 1, NULL, '2021-06-25 23:41:34', '2021-06-25 23:49:47'),
(15, 351, 'Mrs', 'Fancy', 'Investor', NULL, 'FancyInvestor', '1995-01-01', 'Barbudans', 'female', '+44', '7998985', 'land Islands', '2899', '9435 Waterstone Boulevard Suite 140', NULL, NULL, 'Cincinnati', NULL, '45249', 'American Samoa', 1, 'savings', 'Investor', 'givea lot', 'business', 1, NULL, '2021-07-19 16:32:23', '2021-07-19 16:33:26'),
(16, 353, 'Mr', 'fgfbfxh', 'gfdhdfg', 'dfghdf', 'gfdhdfg', '1996-10-02', 'French', 'female', '65756', '6577567', 'Aruba', 'ghfhs', 'dgfhgdf', 'hgfdh', 'ghf', 'gfhd', 'ghfd', 'ghfd', 'Azerbaijan', 1, 'hgj', 'hgmjn', 'hjgj', 'hgjg', 1, NULL, '2021-07-28 12:13:37', '2021-07-28 12:14:20');

-- --------------------------------------------------------

--
-- Table structure for table `invoices`
--

CREATE TABLE `invoices` (
  `id` int(10) UNSIGNED NOT NULL,
  `user_id` int(10) UNSIGNED NOT NULL,
  `auction_id` int(10) UNSIGNED DEFAULT NULL,
  `invoice_file_name` varchar(191) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `approved` int(11) DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------

--
-- Table structure for table `laravel_inline_editor`
--

CREATE TABLE `laravel_inline_editor` (
  `id` int(10) UNSIGNED NOT NULL,
  `key` varchar(191) COLLATE utf8mb4_unicode_ci NOT NULL,
  `content` text COLLATE utf8mb4_unicode_ci NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `laravel_inline_editor`
--

INSERT INTO `laravel_inline_editor` (`id`, `key`, `content`, `created_at`, `updated_at`) VALUES
(1, 'hero-title', '<p>Release cash from your invoices<br></p>\n<p>Fund your business growth and development<br></p>', '2018-11-26 22:06:24', '2018-11-26 22:06:24'),
(2, 'hero-lead', '<p>Funding Joint offers a fair and ethical method of raising finance from your unpaid invoices.<br></p>', '2018-11-26 22:06:24', '2018-11-26 22:06:24'),
(3, 'funding-opportunities', '<p>Improve your business\'s cash flow</p>', '2018-11-26 23:26:33', '2018-11-26 23:26:33'),
(4, 'funding-opportunities-lead', 'Lorem ipsum dolor sit amet, consectetur adipiscing elit. Cras ut laoreet turpis. In sed turpis sagittis, iaculis velit sed, convallis arcu. Praesent magna egestas accumsan.', '2018-11-26 23:26:33', '2018-11-26 23:26:33'),
(5, 'investor-opportunities', '<p>Invest in UK companies </p>', '2018-11-26 23:26:33', '2018-11-26 23:26:33'),
(6, 'investor-opportunities-lead', 'Lorem ipsum dolor sit amet, consectetur adipiscing elit. Cras ut laoreet turpis. In sed turpis sagittis, iaculis velit sed, convallis arcu. Praesent magna egestas accumsan.', '2018-11-26 23:26:33', '2018-11-26 23:26:33'),
(7, 'browse-marketplace', 'Browse marketplace', '2018-11-26 23:26:33', '2018-11-26 23:26:33'),
(8, 'generate-quick-funding', 'Generate funds', '2018-11-27 12:41:19', '2018-11-27 12:41:19'),
(9, 'create-unlimited-auctions', 'Create an auction', '2018-11-27 12:41:19', '2018-11-27 12:41:19'),
(10, 'set-and-control', 'Set and control finance terms', '2018-11-27 12:41:19', '2018-11-27 12:41:19'),
(11, 'fund-your-business', 'Fund your business', '2018-11-27 12:41:19', '2018-11-27 12:41:19'),
(12, 'safe-investment-opportunities', 'Bid to fund a suitable opportunity', '2018-11-27 12:41:19', '2018-11-27 12:41:19'),
(13, 'control-your-roi', 'Control your ROI', '2018-11-27 12:41:19', '2018-11-27 12:41:19'),
(14, 'start-investing', 'Start Investing', '2018-11-27 12:41:19', '2018-11-27 12:41:19'),
(15, 'create-and-register', 'SMEs create their business profile. Investors register to provide funding.', '2018-11-27 12:41:19', '2018-11-27 12:41:19'),
(16, 'create-an-auction', 'SMEs create an auction and set their term to raise funds against their unpaid trade invoices.', '2018-11-27 12:41:19', '2018-11-27 12:41:19'),
(17, 'investors-browse', 'Investors browse the marketplace and bid to invest in credit-worthy, short-term opportunities.', '2018-11-27 12:41:19', '2018-11-27 12:41:19'),
(18, 'leaderboard-displays', 'Leaderboard displays auction dynamics. Most competitive bids fund the\n         opportunity.', '2018-11-27 12:41:19', '2018-11-27 12:41:19'),
(19, 'fund-are-released', 'Funds are released to business. Repayments and returns are collected on behalf of\n         investors.', '2018-11-27 12:41:19', '2018-11-27 12:41:19'),
(20, 'sign-up-newsletter', 'Subscribe to our mailing list', '2018-11-27 12:41:19', '2018-11-27 12:41:19'),
(21, 'stay-up-date', 'Stay up to date with Funding Joint', '2018-11-27 12:41:19', '2018-11-27 12:41:19'),
(22, 'stay-up-date-leed', '<p>Lorem ipsum dolor sit amet, consectetur adipisicing elit. Accusamus, aliquam aspernatur consequatur corporis debitis error esse, eveniet exercitationem harum in molestiae natus omnis, pariatur quidem recusandae repellendus sed similique veniam..</p>', '2018-11-27 12:41:19', '2018-11-27 12:41:19'),
(23, 'how-it-works-title', 'How It Works', '2018-11-28 12:23:43', '2018-11-28 12:23:43'),
(24, 'how-it-works-lead', 'Lorem ipsum dolor sit amet, consectetur adipisicing elit. Amet architecto asperiores, dicta distinctio dolor iusto magnam, nihil numquam quaerat, recusandae veniam vero. Illum impedit ipsam nihil odio ratione tempora voluptatem!', '2018-11-28 12:23:43', '2018-11-28 12:23:43'),
(25, 'register-as-an-investor-or-seller', 'Register as an Investor or a Seller', '2018-11-28 12:23:43', '2018-11-28 12:23:43'),
(26, 'register-as-an-investor-or-seller-lead', 'Lorem ipsum dolor sit amet, consectetur adipisicing elit. Accusamus, dicta dolore esse eveniet excepturi exercitationem hic ipsam laborum libero modi mollitia officiis perspiciatis rem sapiente soluta suscipit veniam, voluptate voluptatibus.', '2018-11-28 12:23:43', '2018-11-28 12:23:43'),
(27, 'create-an-auction-or-bid-header', 'Create an Auction or Bid for an Investment', '2018-11-28 12:23:43', '2018-11-28 12:23:43'),
(28, 'create-an-auction-or-bid-lead', 'Lorem ipsum dolor sit amet, consectetur adipisicing elit. Accusamus, dicta dolore esse eveniet excepturi exercitationem hic ipsam laborum libero modi mollitia officiis perspiciatis rem sapiente soluta suscipit veniam, voluptate voluptatibus.', '2018-11-28 12:23:43', '2018-11-28 12:23:43'),
(29, 'competitive-bids-are-top', 'Competitive Bids are top of the Leaderboard.', '2018-11-28 12:23:43', '2018-11-28 12:23:43'),
(30, 'competitive-bids-are-top-lead', 'Lorem ipsum dolor sit amet, consectetur adipisicing elit. Accusamus, dicta dolore esse eveniet excepturi exercitationem hic ipsam laborum libero modi mollitia officiis perspiciatis rem sapiente soluta suscipit veniam, voluptate voluptatibus.', '2018-11-28 12:23:43', '2018-11-28 12:23:43'),
(31, 'payment-is-released-to-investor', 'Payments is released to Investor or funding to Seller', '2018-11-28 12:23:43', '2018-11-28 12:23:43'),
(32, 'payment-is-released-to-investor-lead', 'Lorem ipsum dolor sit amet, consectetur adipisicing elit. Accusamus, dicta dolore esse eveniet excepturi exercitationem hic ipsam laborum libero modi mollitia officiis perspiciatis rem sapiente soluta suscipit veniam, voluptate voluptatibus.', '2018-11-28 12:23:43', '2018-11-28 12:23:43'),
(33, 'safe-efficient-platform-with-an-ethical-mindset-header', 'Safe, Efficient platform with Ethical mindset', '2018-11-28 12:23:43', '2018-11-28 12:23:43'),
(34, 'safe-efficient-platform-with-an-ethical-mindset-lead', 'Lorem ipsum dolor sit amet, consectetur adipisicing elit. Accusamus, dicta dolore esse eveniet excepturi exercitationem hic ipsam laborum libero modi mollitia officiis perspiciatis rem sapiente soluta suscipit veniam, voluptate voluptatibus.', '2018-11-28 12:23:43', '2018-11-28 12:23:43'),
(35, 'who-we-are-title', '<p>Who We Are</p>', '2018-11-28 13:06:36', '2018-11-28 13:06:36'),
(36, 'who-we-are-lead', 'Lorem ipsum dolor sit amet, consectetur adipisicing elit. Amet architecto asperiores, dicta distinctio dolor iusto magnam, nihil numquam quaerat, recusandae veniam vero. Illum impedit ipsam nihil odio ratione tempora voluptatem!', '2018-11-28 13:06:36', '2018-11-28 13:06:36'),
(37, 'investor-platform-title', 'Investment Platform', '2018-11-28 13:06:36', '2018-11-28 13:06:36'),
(38, 'investor-platform-lead', '<p>Lorem ipsum dolor sit amet, consectetur adipisicing elit. Aperiam fugit in nobis perferendis velit. Accusantium doloremque eaque earum eius eum fuga incidunt libero mollitia quae, rerum soluta suscipit ut veniam.</p>', '2018-11-28 13:06:36', '2018-11-28 13:06:36'),
(39, 'our-history-title', 'Our History', '2018-11-28 13:06:36', '2018-11-28 13:06:36'),
(40, 'our-history-lead', '<p>\n              Lorem ipsum dolor sit amet, consectetur adipisicing elit. A, adipisci architecto consequatur deserunt dignissimos ea et exercitationem ipsa laudantium maxime mollitia quaerat quas quibusdam quo rem saepe tempore vitae, voluptas!\n            </p>\n            <p>\n              Lorem ipsum dolor sit amet, consectetur adipisicing elit. A, adipisci architecto consequatur deserunt dignissimos ea et exercitationem ipsa laudantium maxime mollitia quaerat quas quibusdam quo rem saepe tempore vitae, voluptas!\n            </p>', '2018-11-28 13:06:36', '2018-11-28 13:06:36'),
(41, 'contact-title', 'Contact us', '2018-11-30 08:51:07', '2018-11-30 08:51:07'),
(42, 'contact-lead', 'For general enquiries, please fill out the form below, and we will get back to you as soon as we can', '2018-11-30 08:51:07', '2018-11-30 08:51:07'),
(43, 'privacy-title', 'Privacy', '2018-11-30 09:19:40', '2018-11-30 09:19:40'),
(44, 'privacy-content', 'Coming soon', '2018-11-30 09:19:40', '2018-11-30 09:19:40'),
(45, 'terms-title', 'Terms', '2018-11-30 09:19:43', '2018-11-30 09:19:43'),
(46, 'terms-content', 'Coming Soon', '2018-11-30 09:19:43', '2018-11-30 09:19:43'),
(47, 'sql-title', 'Record not found', '2018-11-30 16:32:25', '2018-11-30 16:32:25'),
(48, 'sql-lead', 'Lorem ipsum dolor sit amet, consectetur adipiscing elit. Cras ut laoreet turpis. In sed turpis sagittis, iaculis velit sed, convallis arcu. Praesent magna egestas accumsan.', '2018-11-30 16:32:25', '2018-11-30 16:32:25'),
(49, '404-title', 'Your page is missing', '2018-11-30 16:32:57', '2018-11-30 16:32:57'),
(50, '404-lead', 'Lorem ipsum dolor sit amet, consectetur adipiscing elit. Cras ut laoreet turpis. In sed turpis sagittis, iaculis velit sed, convallis arcu. Praesent magna egestas accumsan.', '2018-11-30 16:32:57', '2018-11-30 16:32:57'),
(51, 'disclaimer-page', 'Lorem ipsum', '2018-12-14 14:04:17', '2018-12-14 14:04:17'),
(52, 'discalimer-title', 'Terms', '2018-12-14 14:17:02', '2018-12-14 14:17:02'),
(53, 'discalimer-content', 'Coming soon', '2018-12-14 14:17:02', '2018-12-14 14:17:02'),
(54, 'discalimer-title-new', 'Disclaimer', '2018-12-19 16:00:39', '2018-12-19 16:00:39'),
(55, 'discalimer-content-new', 'Coming Soon', '2018-12-19 16:00:39', '2018-12-19 16:00:39'),
(56, 'investorHWN-title', 'Funding Joint Sophisticated investor / High Net Worth Individual Declaration', '2019-01-18 14:48:11', '2019-01-18 14:48:11'),
(57, 'investorHWN-content', 'The Funding Joint Platform is a new and innovative approach to the traditional factoring model. Consequently, there may arise certain risks which may not be suitable for retail investors. As such, any investment opportunities listed on the Platform (or associated services) are currently only available to sophisticated investors, high net worth individuals and companies and institutions.\n      For the avoidance of doubt, the Funding Joint Platform does not offer any investment of a specified kind or undertake any regulated activity under the Financial Services and Markets Act 2000. The specimen statements provided in the Financial Services and Markets Act (Financial Promotion) Order 2005 are being used as good industry practice and without prejudice to the above.\n\n      Declaration for sophisticated investors:\n\n      I declare that I am a self-certified sophisticated investor for the purposes of the Financial Services and Markets Act (Financial Promotion) Order 2005.\n      I understand that this means that:\n      a.   I can receive financial promotions that may not have been approved by a person authorised by the Financial Conduct Authority;\n      b.  the content of such financial promotions may not conform to the rules issued by the Financial Conduct Authority;\n      c.   by providing this statement I may lose significant rights;\n      d.  I may have no right to complain to either of the following:\n      i.  the Financial Conduct Authority; or\n      ii.  the Financial Ombudsman Scheme;\n      e.   I may have no right to seek compensation from the Financial Services Compensation Scheme.\n      I also declare that I am a self-certified sophisticated investor because at least one of the following applies to me:\n      f.   I am a member of a network or syndicate of business angels and have been so for at least the last six months prior to today’s date;\n      g.  I have made more than one investment in an unlisted company in the two years prior to today’s date;\n      h.   I am working, or have worked in the two years prior to today’s date, in a professional capacity in the private equity sector, or in the provision of finance for small and medium enterprises;\n      i.   I am currently, or have been in the two years prior to today’s date, a director of a company with an annual turnover of at least £1 million.\n      I accept that I can lose my property and other assets from making investment decisions based on financial promotions.\n      I am aware that it is open to me to seek advice of someone who specialises in advising on investments.\n\n      Declaration for high net worth individuals:\n\n      I declare that I am a self-certified high net worth individual for the purposes of the Financial Services and Markets Act (Financial Promotion) Order 2005.\n      I understand that this means that:\n      a.   I can receive financial promotions that may not have been approved by a person authorised by the Financial Conduct Authority;\n      b.  the content of such financial promotions may not conform to the rules issued by the Financial Conduct Authority;\n      c.   by providing this statement I may lose significant rights;\n      d.  I may have no right to complain to either of the following:\n      i.  the Financial Conduct Authority; or\n      ii.  the Financial Ombudsman Scheme;\n      e.   I may have no right to seek compensation from the Financial Services Compensation Scheme.\n      I also declare that I am a high net worth individual because at least one of the following applies to me:\n      f.   I had, during the financial year immediately preceding today’s date, an annual income to the value of £100,000 or more;\n      g.  I held, throughout the financial year immediately preceding today’s date, net assets to the value of £250,000 or more. Net assets for these purposes do not include:\n      i.  the property which is my primary residence or any loan secured on that residence;\n      ii.  any rights of mine under a qualifying contract of insurance within the meaning for the Financial Services and Markets Act 200 (Regulated Activities) Order 2001; or\n      iii.  any benefits (in the form of pensions or otherwise) which are payable on the termination of my service or on my death or retirement and to which I am (or my dependants are), or may be, entitled.\n      I accept that I can lose my property and other assets from making investment decisions based on financial promotions.\n      I am aware that it is open to me to seek advice of someone who specialises in advising on investments.', '2019-01-18 14:48:11', '2019-01-18 14:48:11'),
(58, 'compliance-policy-title', 'Compliance Policy', '2019-05-27 09:14:13', '2019-05-27 09:14:13'),
(59, 'compliance-policy-content', 'Lorem ipsum dolor sit amet, consectetur adipisicing elit. Amet architecto asperiores, dicta distinctio dolor iusto magnam, nihil numquam quaerat, recusandae veniam vero. Illum impedit ipsam nihil odio ratione tempora voluptatem!', '2019-05-27 09:14:13', '2019-05-27 09:14:13'),
(60, 'hero-title-base-1', 'Our first of a kind sharia approved structure will improve your cash flow and provide a competitive advantage for your next business project.', NULL, NULL),
(61, 'hero-title-base-2', 'Look out for our new proprietary platform which will be launching early next year.  In the meantime, you can register your business now, or register as a potential peer-to-peer investor looking for strong short-term returns from invoice financing, and we’ll get in touch soon.', NULL, NULL);

-- --------------------------------------------------------

--
-- Table structure for table `migrations`
--

CREATE TABLE `migrations` (
  `id` int(10) UNSIGNED NOT NULL,
  `migration` varchar(191) COLLATE utf8mb4_unicode_ci NOT NULL,
  `batch` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `migrations`
--

INSERT INTO `migrations` (`id`, `migration`, `batch`) VALUES
(1, '2014_10_12_000000_create_users_table', 1),
(2, '2014_10_12_100000_create_password_resets_table', 1),
(3, '2018_06_30_113500_create_comments_table', 1),
(4, '2018_09_21_113845_create_sellers_table', 1),
(5, '2018_09_24_162516_create_bank_details_table', 1),
(6, '2018_09_27_100306_create_bank_statements_table', 1),
(7, '2018_10_01_104956_create_investors_table', 1),
(8, '2018_10_01_111347_create_documents_table', 1),
(9, '2018_10_15_122240_create_buyers_table', 1),
(10, '2018_10_19_092314_create_permission_tables', 1),
(11, '2018_10_19_134416_create_auctions_table', 1),
(12, '2018_10_19_145217_create_notifications_table', 1),
(13, '2018_10_22_160957_create_settings_table', 1),
(14, '2018_10_30_104423_account_balance', 1),
(15, '2018_10_30_151844_create_bids_table', 1),
(16, '2018_10_30_160033_create_transactions_table', 1),
(17, '2018_11_06_130652_create_site_pages', 1),
(18, '2018_11_06_162208_create_faq', 1),
(19, '2018_11_12_145125_create_invoices_table', 1),
(20, '2018_11_14_155133_create_homepage_sections', 1),
(21, '2018_11_18_151111_create_purchase_orders_table', 1),
(22, '0000_00_00_000000_create_laravel_inline_editor_table', 2);

-- --------------------------------------------------------

--
-- Table structure for table `model_has_permissions`
--

CREATE TABLE `model_has_permissions` (
  `permission_id` int(10) UNSIGNED NOT NULL,
  `model_type` varchar(191) COLLATE utf8mb4_unicode_ci NOT NULL,
  `model_id` bigint(20) UNSIGNED NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `model_has_permissions`
--

INSERT INTO `model_has_permissions` (`permission_id`, `model_type`, `model_id`) VALUES
(1, 'App\\Model\\Users\\User', 1),
(2, 'App\\Model\\Users\\User', 1),
(3, 'App\\Model\\Users\\User', 1),
(4, 'App\\Model\\Users\\User', 1),
(5, 'App\\Model\\Users\\User', 1),
(5, 'App\\Model\\Users\\User', 2),
(5, 'App\\Model\\Users\\User', 4),
(5, 'App\\Model\\Users\\User', 5),
(5, 'App\\Model\\Users\\User', 7),
(5, 'App\\Model\\Users\\User', 8),
(5, 'App\\Model\\Users\\User', 9),
(5, 'App\\Model\\Users\\User', 11),
(5, 'App\\Model\\Users\\User', 13),
(5, 'App\\Model\\Users\\User', 16),
(5, 'App\\Model\\Users\\User', 17),
(5, 'App\\Model\\Users\\User', 19),
(5, 'App\\Model\\Users\\User', 20),
(5, 'App\\Model\\Users\\User', 24),
(5, 'App\\Model\\Users\\User', 27),
(5, 'App\\Model\\Users\\User', 28),
(5, 'App\\Model\\Users\\User', 29),
(5, 'App\\Model\\Users\\User', 31),
(5, 'App\\Model\\Users\\User', 32),
(5, 'App\\Model\\Users\\User', 33),
(5, 'App\\Model\\Users\\User', 36),
(5, 'App\\Model\\Users\\User', 37),
(5, 'App\\Model\\Users\\User', 39),
(5, 'App\\Model\\Users\\User', 41),
(6, 'App\\Model\\Users\\User', 1),
(6, 'App\\Model\\Users\\User', 2),
(6, 'App\\Model\\Users\\User', 4),
(6, 'App\\Model\\Users\\User', 5),
(6, 'App\\Model\\Users\\User', 7),
(6, 'App\\Model\\Users\\User', 8),
(6, 'App\\Model\\Users\\User', 9),
(6, 'App\\Model\\Users\\User', 11),
(6, 'App\\Model\\Users\\User', 13),
(6, 'App\\Model\\Users\\User', 16),
(6, 'App\\Model\\Users\\User', 17),
(6, 'App\\Model\\Users\\User', 19),
(6, 'App\\Model\\Users\\User', 20),
(6, 'App\\Model\\Users\\User', 24),
(6, 'App\\Model\\Users\\User', 27),
(6, 'App\\Model\\Users\\User', 28),
(6, 'App\\Model\\Users\\User', 29),
(6, 'App\\Model\\Users\\User', 31),
(6, 'App\\Model\\Users\\User', 32),
(6, 'App\\Model\\Users\\User', 33),
(6, 'App\\Model\\Users\\User', 36),
(6, 'App\\Model\\Users\\User', 37),
(6, 'App\\Model\\Users\\User', 39),
(6, 'App\\Model\\Users\\User', 41),
(7, 'App\\Model\\Users\\User', 1),
(7, 'App\\Model\\Users\\User', 2),
(7, 'App\\Model\\Users\\User', 4),
(7, 'App\\Model\\Users\\User', 5),
(7, 'App\\Model\\Users\\User', 7),
(7, 'App\\Model\\Users\\User', 8),
(7, 'App\\Model\\Users\\User', 9),
(7, 'App\\Model\\Users\\User', 11),
(7, 'App\\Model\\Users\\User', 13),
(7, 'App\\Model\\Users\\User', 16),
(7, 'App\\Model\\Users\\User', 17),
(7, 'App\\Model\\Users\\User', 19),
(7, 'App\\Model\\Users\\User', 20),
(7, 'App\\Model\\Users\\User', 24),
(7, 'App\\Model\\Users\\User', 27),
(7, 'App\\Model\\Users\\User', 28),
(7, 'App\\Model\\Users\\User', 29),
(7, 'App\\Model\\Users\\User', 31),
(7, 'App\\Model\\Users\\User', 32),
(7, 'App\\Model\\Users\\User', 33),
(7, 'App\\Model\\Users\\User', 36),
(7, 'App\\Model\\Users\\User', 37),
(7, 'App\\Model\\Users\\User', 39),
(7, 'App\\Model\\Users\\User', 41),
(8, 'App\\Model\\Users\\User', 1),
(8, 'App\\Model\\Users\\User', 2),
(8, 'App\\Model\\Users\\User', 4),
(8, 'App\\Model\\Users\\User', 5),
(8, 'App\\Model\\Users\\User', 7),
(8, 'App\\Model\\Users\\User', 8),
(8, 'App\\Model\\Users\\User', 9),
(8, 'App\\Model\\Users\\User', 11),
(8, 'App\\Model\\Users\\User', 13),
(8, 'App\\Model\\Users\\User', 16),
(8, 'App\\Model\\Users\\User', 17),
(8, 'App\\Model\\Users\\User', 19),
(8, 'App\\Model\\Users\\User', 20),
(8, 'App\\Model\\Users\\User', 24),
(8, 'App\\Model\\Users\\User', 27),
(8, 'App\\Model\\Users\\User', 28),
(8, 'App\\Model\\Users\\User', 29),
(8, 'App\\Model\\Users\\User', 31),
(8, 'App\\Model\\Users\\User', 32),
(8, 'App\\Model\\Users\\User', 33),
(8, 'App\\Model\\Users\\User', 36),
(8, 'App\\Model\\Users\\User', 37),
(8, 'App\\Model\\Users\\User', 39),
(8, 'App\\Model\\Users\\User', 41),
(9, 'App\\Model\\Users\\User', 1),
(9, 'App\\Model\\Users\\User', 3),
(9, 'App\\Model\\Users\\User', 6),
(9, 'App\\Model\\Users\\User', 10),
(9, 'App\\Model\\Users\\User', 12),
(9, 'App\\Model\\Users\\User', 14),
(9, 'App\\Model\\Users\\User', 15),
(9, 'App\\Model\\Users\\User', 18),
(9, 'App\\Model\\Users\\User', 21),
(9, 'App\\Model\\Users\\User', 22),
(9, 'App\\Model\\Users\\User', 23),
(9, 'App\\Model\\Users\\User', 25),
(9, 'App\\Model\\Users\\User', 26),
(9, 'App\\Model\\Users\\User', 30),
(9, 'App\\Model\\Users\\User', 34),
(9, 'App\\Model\\Users\\User', 35),
(9, 'App\\Model\\Users\\User', 38),
(9, 'App\\Model\\Users\\User', 40),
(9, 'App\\Model\\Users\\User', 42),
(9, 'App\\Model\\Users\\User', 43),
(10, 'App\\Model\\Users\\User', 1),
(10, 'App\\Model\\Users\\User', 3),
(10, 'App\\Model\\Users\\User', 6),
(10, 'App\\Model\\Users\\User', 10),
(10, 'App\\Model\\Users\\User', 12),
(10, 'App\\Model\\Users\\User', 14),
(10, 'App\\Model\\Users\\User', 15),
(10, 'App\\Model\\Users\\User', 18),
(10, 'App\\Model\\Users\\User', 21),
(10, 'App\\Model\\Users\\User', 22),
(10, 'App\\Model\\Users\\User', 23),
(10, 'App\\Model\\Users\\User', 25),
(10, 'App\\Model\\Users\\User', 26),
(10, 'App\\Model\\Users\\User', 30),
(10, 'App\\Model\\Users\\User', 34),
(10, 'App\\Model\\Users\\User', 35),
(10, 'App\\Model\\Users\\User', 38),
(10, 'App\\Model\\Users\\User', 40),
(10, 'App\\Model\\Users\\User', 42),
(10, 'App\\Model\\Users\\User', 43),
(11, 'App\\Model\\Users\\User', 1),
(11, 'App\\Model\\Users\\User', 3),
(11, 'App\\Model\\Users\\User', 6),
(11, 'App\\Model\\Users\\User', 10),
(11, 'App\\Model\\Users\\User', 12),
(11, 'App\\Model\\Users\\User', 14),
(11, 'App\\Model\\Users\\User', 15),
(11, 'App\\Model\\Users\\User', 18),
(11, 'App\\Model\\Users\\User', 21),
(11, 'App\\Model\\Users\\User', 22),
(11, 'App\\Model\\Users\\User', 23),
(11, 'App\\Model\\Users\\User', 25),
(11, 'App\\Model\\Users\\User', 26),
(11, 'App\\Model\\Users\\User', 30),
(11, 'App\\Model\\Users\\User', 34),
(11, 'App\\Model\\Users\\User', 35),
(11, 'App\\Model\\Users\\User', 38),
(11, 'App\\Model\\Users\\User', 40),
(11, 'App\\Model\\Users\\User', 42),
(11, 'App\\Model\\Users\\User', 43),
(12, 'App\\Model\\Users\\User', 1),
(12, 'App\\Model\\Users\\User', 3),
(12, 'App\\Model\\Users\\User', 6),
(12, 'App\\Model\\Users\\User', 10),
(12, 'App\\Model\\Users\\User', 12),
(12, 'App\\Model\\Users\\User', 14),
(12, 'App\\Model\\Users\\User', 15),
(12, 'App\\Model\\Users\\User', 18),
(12, 'App\\Model\\Users\\User', 21),
(12, 'App\\Model\\Users\\User', 22),
(12, 'App\\Model\\Users\\User', 23),
(12, 'App\\Model\\Users\\User', 25),
(12, 'App\\Model\\Users\\User', 26),
(12, 'App\\Model\\Users\\User', 30),
(12, 'App\\Model\\Users\\User', 34),
(12, 'App\\Model\\Users\\User', 35),
(12, 'App\\Model\\Users\\User', 38),
(12, 'App\\Model\\Users\\User', 40),
(12, 'App\\Model\\Users\\User', 42),
(12, 'App\\Model\\Users\\User', 43);

-- --------------------------------------------------------

--
-- Table structure for table `model_has_roles`
--

CREATE TABLE `model_has_roles` (
  `role_id` int(10) UNSIGNED NOT NULL,
  `model_type` varchar(191) COLLATE utf8mb4_unicode_ci NOT NULL,
  `model_id` bigint(20) UNSIGNED NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `model_has_roles`
--

INSERT INTO `model_has_roles` (`role_id`, `model_type`, `model_id`) VALUES
(1, 'App\\Model\\Users\\User', 1),
(2, 'App\\Model\\Users\\User', 2),
(2, 'App\\Model\\Users\\User', 5),
(2, 'App\\Model\\Users\\User', 7),
(2, 'App\\Model\\Users\\User', 8),
(2, 'App\\Model\\Users\\User', 9),
(2, 'App\\Model\\Users\\User', 11),
(2, 'App\\Model\\Users\\User', 13),
(2, 'App\\Model\\Users\\User', 16),
(2, 'App\\Model\\Users\\User', 17),
(2, 'App\\Model\\Users\\User', 19),
(2, 'App\\Model\\Users\\User', 20),
(2, 'App\\Model\\Users\\User', 24),
(2, 'App\\Model\\Users\\User', 27),
(2, 'App\\Model\\Users\\User', 28),
(2, 'App\\Model\\Users\\User', 29),
(2, 'App\\Model\\Users\\User', 31),
(2, 'App\\Model\\Users\\User', 32),
(2, 'App\\Model\\Users\\User', 33),
(2, 'App\\Model\\Users\\User', 36),
(2, 'App\\Model\\Users\\User', 37),
(2, 'App\\Model\\Users\\User', 39),
(2, 'App\\Model\\Users\\User', 41),
(2, 'App\\Model\\Users\\User', 44),
(2, 'App\\Model\\Users\\User', 46),
(2, 'App\\Model\\Users\\User', 47),
(2, 'App\\Model\\Users\\User', 48),
(2, 'App\\Model\\Users\\User', 50),
(2, 'App\\Model\\Users\\User', 51),
(2, 'App\\Model\\Users\\User', 53),
(2, 'App\\Model\\Users\\User', 58),
(2, 'App\\Model\\Users\\User', 60),
(2, 'App\\Model\\Users\\User', 61),
(2, 'App\\Model\\Users\\User', 62),
(2, 'App\\Model\\Users\\User', 66),
(2, 'App\\Model\\Users\\User', 69),
(2, 'App\\Model\\Users\\User', 70),
(2, 'App\\Model\\Users\\User', 71),
(2, 'App\\Model\\Users\\User', 73),
(2, 'App\\Model\\Users\\User', 77),
(2, 'App\\Model\\Users\\User', 78),
(2, 'App\\Model\\Users\\User', 80),
(2, 'App\\Model\\Users\\User', 81),
(2, 'App\\Model\\Users\\User', 83),
(2, 'App\\Model\\Users\\User', 84),
(2, 'App\\Model\\Users\\User', 87),
(2, 'App\\Model\\Users\\User', 88),
(2, 'App\\Model\\Users\\User', 90),
(2, 'App\\Model\\Users\\User', 91),
(2, 'App\\Model\\Users\\User', 92),
(2, 'App\\Model\\Users\\User', 93),
(2, 'App\\Model\\Users\\User', 95),
(2, 'App\\Model\\Users\\User', 98),
(2, 'App\\Model\\Users\\User', 99),
(2, 'App\\Model\\Users\\User', 101),
(2, 'App\\Model\\Users\\User', 103),
(2, 'App\\Model\\Users\\User', 105),
(2, 'App\\Model\\Users\\User', 107),
(2, 'App\\Model\\Users\\User', 109),
(2, 'App\\Model\\Users\\User', 110),
(2, 'App\\Model\\Users\\User', 112),
(2, 'App\\Model\\Users\\User', 114),
(2, 'App\\Model\\Users\\User', 115),
(2, 'App\\Model\\Users\\User', 124),
(2, 'App\\Model\\Users\\User', 126),
(2, 'App\\Model\\Users\\User', 130),
(2, 'App\\Model\\Users\\User', 132),
(2, 'App\\Model\\Users\\User', 133),
(2, 'App\\Model\\Users\\User', 140),
(2, 'App\\Model\\Users\\User', 142),
(2, 'App\\Model\\Users\\User', 144),
(2, 'App\\Model\\Users\\User', 147),
(2, 'App\\Model\\Users\\User', 152),
(2, 'App\\Model\\Users\\User', 155),
(2, 'App\\Model\\Users\\User', 156),
(2, 'App\\Model\\Users\\User', 161),
(2, 'App\\Model\\Users\\User', 163),
(2, 'App\\Model\\Users\\User', 165),
(2, 'App\\Model\\Users\\User', 167),
(2, 'App\\Model\\Users\\User', 169),
(2, 'App\\Model\\Users\\User', 171),
(2, 'App\\Model\\Users\\User', 172),
(2, 'App\\Model\\Users\\User', 173),
(2, 'App\\Model\\Users\\User', 174),
(2, 'App\\Model\\Users\\User', 175),
(2, 'App\\Model\\Users\\User', 176),
(2, 'App\\Model\\Users\\User', 180),
(2, 'App\\Model\\Users\\User', 183),
(2, 'App\\Model\\Users\\User', 185),
(2, 'App\\Model\\Users\\User', 187),
(2, 'App\\Model\\Users\\User', 188),
(2, 'App\\Model\\Users\\User', 189),
(2, 'App\\Model\\Users\\User', 190),
(2, 'App\\Model\\Users\\User', 192),
(2, 'App\\Model\\Users\\User', 193),
(2, 'App\\Model\\Users\\User', 195),
(2, 'App\\Model\\Users\\User', 196),
(2, 'App\\Model\\Users\\User', 198),
(2, 'App\\Model\\Users\\User', 199),
(2, 'App\\Model\\Users\\User', 200),
(2, 'App\\Model\\Users\\User', 201),
(2, 'App\\Model\\Users\\User', 202),
(2, 'App\\Model\\Users\\User', 203),
(2, 'App\\Model\\Users\\User', 204),
(2, 'App\\Model\\Users\\User', 205),
(2, 'App\\Model\\Users\\User', 214),
(2, 'App\\Model\\Users\\User', 218),
(2, 'App\\Model\\Users\\User', 227),
(2, 'App\\Model\\Users\\User', 232),
(2, 'App\\Model\\Users\\User', 234),
(2, 'App\\Model\\Users\\User', 235),
(2, 'App\\Model\\Users\\User', 237),
(2, 'App\\Model\\Users\\User', 240),
(2, 'App\\Model\\Users\\User', 246),
(2, 'App\\Model\\Users\\User', 248),
(2, 'App\\Model\\Users\\User', 252),
(2, 'App\\Model\\Users\\User', 263),
(2, 'App\\Model\\Users\\User', 264),
(2, 'App\\Model\\Users\\User', 265),
(2, 'App\\Model\\Users\\User', 267),
(2, 'App\\Model\\Users\\User', 268),
(2, 'App\\Model\\Users\\User', 269),
(2, 'App\\Model\\Users\\User', 270),
(2, 'App\\Model\\Users\\User', 272),
(2, 'App\\Model\\Users\\User', 274),
(2, 'App\\Model\\Users\\User', 276),
(2, 'App\\Model\\Users\\User', 278),
(2, 'App\\Model\\Users\\User', 280),
(2, 'App\\Model\\Users\\User', 282),
(2, 'App\\Model\\Users\\User', 283),
(2, 'App\\Model\\Users\\User', 284),
(2, 'App\\Model\\Users\\User', 285),
(2, 'App\\Model\\Users\\User', 288),
(2, 'App\\Model\\Users\\User', 290),
(2, 'App\\Model\\Users\\User', 291),
(2, 'App\\Model\\Users\\User', 297),
(2, 'App\\Model\\Users\\User', 298),
(2, 'App\\Model\\Users\\User', 299),
(2, 'App\\Model\\Users\\User', 300),
(2, 'App\\Model\\Users\\User', 301),
(2, 'App\\Model\\Users\\User', 303),
(2, 'App\\Model\\Users\\User', 304),
(2, 'App\\Model\\Users\\User', 306),
(2, 'App\\Model\\Users\\User', 308),
(2, 'App\\Model\\Users\\User', 312),
(2, 'App\\Model\\Users\\User', 314),
(2, 'App\\Model\\Users\\User', 315),
(2, 'App\\Model\\Users\\User', 316),
(2, 'App\\Model\\Users\\User', 320),
(2, 'App\\Model\\Users\\User', 321),
(2, 'App\\Model\\Users\\User', 324),
(2, 'App\\Model\\Users\\User', 325),
(2, 'App\\Model\\Users\\User', 326),
(2, 'App\\Model\\Users\\User', 327),
(2, 'App\\Model\\Users\\User', 331),
(2, 'App\\Model\\Users\\User', 332),
(2, 'App\\Model\\Users\\User', 333),
(2, 'App\\Model\\Users\\User', 338),
(2, 'App\\Model\\Users\\User', 340),
(2, 'App\\Model\\Users\\User', 346),
(2, 'App\\Model\\Users\\User', 352),
(3, 'App\\Model\\Users\\User', 3),
(3, 'App\\Model\\Users\\User', 4),
(3, 'App\\Model\\Users\\User', 6),
(3, 'App\\Model\\Users\\User', 10),
(3, 'App\\Model\\Users\\User', 12),
(3, 'App\\Model\\Users\\User', 14),
(3, 'App\\Model\\Users\\User', 15),
(3, 'App\\Model\\Users\\User', 18),
(3, 'App\\Model\\Users\\User', 21),
(3, 'App\\Model\\Users\\User', 22),
(3, 'App\\Model\\Users\\User', 23),
(3, 'App\\Model\\Users\\User', 25),
(3, 'App\\Model\\Users\\User', 26),
(3, 'App\\Model\\Users\\User', 30),
(3, 'App\\Model\\Users\\User', 34),
(3, 'App\\Model\\Users\\User', 35),
(3, 'App\\Model\\Users\\User', 38),
(3, 'App\\Model\\Users\\User', 40),
(3, 'App\\Model\\Users\\User', 42),
(3, 'App\\Model\\Users\\User', 43),
(3, 'App\\Model\\Users\\User', 45),
(3, 'App\\Model\\Users\\User', 49),
(3, 'App\\Model\\Users\\User', 63),
(3, 'App\\Model\\Users\\User', 72),
(3, 'App\\Model\\Users\\User', 74),
(3, 'App\\Model\\Users\\User', 75),
(3, 'App\\Model\\Users\\User', 79),
(3, 'App\\Model\\Users\\User', 85),
(3, 'App\\Model\\Users\\User', 97),
(3, 'App\\Model\\Users\\User', 100),
(3, 'App\\Model\\Users\\User', 102),
(3, 'App\\Model\\Users\\User', 104),
(3, 'App\\Model\\Users\\User', 108),
(3, 'App\\Model\\Users\\User', 111),
(3, 'App\\Model\\Users\\User', 113),
(3, 'App\\Model\\Users\\User', 116),
(3, 'App\\Model\\Users\\User', 117),
(3, 'App\\Model\\Users\\User', 118),
(3, 'App\\Model\\Users\\User', 119),
(3, 'App\\Model\\Users\\User', 125),
(3, 'App\\Model\\Users\\User', 127),
(3, 'App\\Model\\Users\\User', 131),
(3, 'App\\Model\\Users\\User', 134),
(3, 'App\\Model\\Users\\User', 135),
(3, 'App\\Model\\Users\\User', 136),
(3, 'App\\Model\\Users\\User', 137),
(3, 'App\\Model\\Users\\User', 138),
(3, 'App\\Model\\Users\\User', 141),
(3, 'App\\Model\\Users\\User', 182),
(3, 'App\\Model\\Users\\User', 184),
(3, 'App\\Model\\Users\\User', 194),
(3, 'App\\Model\\Users\\User', 206),
(3, 'App\\Model\\Users\\User', 209),
(3, 'App\\Model\\Users\\User', 210),
(3, 'App\\Model\\Users\\User', 212),
(3, 'App\\Model\\Users\\User', 213),
(3, 'App\\Model\\Users\\User', 215),
(3, 'App\\Model\\Users\\User', 216),
(3, 'App\\Model\\Users\\User', 217),
(3, 'App\\Model\\Users\\User', 219),
(3, 'App\\Model\\Users\\User', 220),
(3, 'App\\Model\\Users\\User', 221),
(3, 'App\\Model\\Users\\User', 222),
(3, 'App\\Model\\Users\\User', 223),
(3, 'App\\Model\\Users\\User', 225),
(3, 'App\\Model\\Users\\User', 226),
(3, 'App\\Model\\Users\\User', 228),
(3, 'App\\Model\\Users\\User', 231),
(3, 'App\\Model\\Users\\User', 233),
(3, 'App\\Model\\Users\\User', 241),
(3, 'App\\Model\\Users\\User', 247),
(3, 'App\\Model\\Users\\User', 249),
(3, 'App\\Model\\Users\\User', 250),
(3, 'App\\Model\\Users\\User', 251),
(3, 'App\\Model\\Users\\User', 266),
(3, 'App\\Model\\Users\\User', 273),
(3, 'App\\Model\\Users\\User', 275),
(3, 'App\\Model\\Users\\User', 279),
(3, 'App\\Model\\Users\\User', 281),
(3, 'App\\Model\\Users\\User', 286),
(3, 'App\\Model\\Users\\User', 289),
(3, 'App\\Model\\Users\\User', 292),
(3, 'App\\Model\\Users\\User', 293),
(3, 'App\\Model\\Users\\User', 294),
(3, 'App\\Model\\Users\\User', 295),
(3, 'App\\Model\\Users\\User', 296),
(3, 'App\\Model\\Users\\User', 302),
(3, 'App\\Model\\Users\\User', 305),
(3, 'App\\Model\\Users\\User', 307),
(3, 'App\\Model\\Users\\User', 309),
(3, 'App\\Model\\Users\\User', 310),
(3, 'App\\Model\\Users\\User', 311),
(3, 'App\\Model\\Users\\User', 313),
(3, 'App\\Model\\Users\\User', 317),
(3, 'App\\Model\\Users\\User', 318),
(3, 'App\\Model\\Users\\User', 319),
(3, 'App\\Model\\Users\\User', 322),
(3, 'App\\Model\\Users\\User', 323),
(3, 'App\\Model\\Users\\User', 328),
(3, 'App\\Model\\Users\\User', 335),
(3, 'App\\Model\\Users\\User', 339),
(3, 'App\\Model\\Users\\User', 345),
(3, 'App\\Model\\Users\\User', 347),
(3, 'App\\Model\\Users\\User', 348),
(3, 'App\\Model\\Users\\User', 351),
(3, 'App\\Model\\Users\\User', 353);

-- --------------------------------------------------------

--
-- Table structure for table `notifications`
--

CREATE TABLE `notifications` (
  `id` char(36) COLLATE utf8mb4_unicode_ci NOT NULL,
  `type` varchar(191) COLLATE utf8mb4_unicode_ci NOT NULL,
  `notifiable_type` varchar(191) COLLATE utf8mb4_unicode_ci NOT NULL,
  `notifiable_id` bigint(20) UNSIGNED NOT NULL,
  `data` text COLLATE utf8mb4_unicode_ci NOT NULL,
  `read_at` timestamp NULL DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `notifications`
--

INSERT INTO `notifications` (`id`, `type`, `notifiable_type`, `notifiable_id`, `data`, `read_at`, `created_at`, `updated_at`) VALUES
('00473a97-66a0-4584-beb0-c833ec0a75f7', 'App\\Notifications\\UserNotification', 'App\\Model\\Users\\User', 340, '{\"title\":\"Your auction received a bid\",\"body\":\"Your auction ( nmgfdhg ) has received a bid\",\"link\":\"http:\\/\\/3.8.199.229\\/funding_joint\\/public\\/auctions\\/86\"}', '2021-07-26 13:13:52', '2021-07-22 14:12:15', '2021-07-26 13:13:52'),
('0076f87c-c63c-4ce4-ac02-68c74dbe573d', 'App\\Notifications\\AdminNotification', 'App\\Model\\Users\\User', 1, '{\"title\":\"Seller Registered\",\"body\":\"seller faslkj registered as a seller. Click to review and approve.\",\"link\":\"http:\\/\\/localhost\\/Join_Funding\\/funding_joint_28_05_21\\/public\\/users?id=338\"}', '2021-06-21 13:56:00', '2021-06-08 16:22:25', '2021-06-21 13:56:00'),
('012a5850-4ad1-4db4-9373-93b3ab7ea5ba', 'App\\Notifications\\AdminNotification', 'App\\Model\\Users\\User', 1, '{\"title\":\"User Added Funds\",\"body\":\"Investor- mostwantedpreston@gmail.com added funds, review and confirm\",\"link\":\"http:\\/\\/18.170.35.138\\/funding_joint\\/public\\/transactions?id=387\"}', '2021-07-28 15:18:10', '2021-07-26 16:34:18', '2021-07-28 15:18:10'),
('0243d525-d561-488e-a27a-2c5faa54488e', 'App\\Notifications\\UserNotification', 'App\\Model\\Users\\User', 340, '{\"title\":\"Your auction received a bid\",\"body\":\"Your auction ( nmgfdhg ) has received a bid\",\"link\":\"http:\\/\\/18.170.35.138\\/funding_joint\\/public\\/auctions\\/96\"}', '2021-07-29 11:22:37', '2021-07-28 02:32:18', '2021-07-29 11:22:37'),
('04b30987-af13-4956-a4a5-bf9466f981f0', 'App\\Notifications\\UserNotification', 'App\\Model\\Users\\User', 338, '{\"title\":\"Your auction received a bid\",\"body\":\"Your auction ( none ) has received a bid\",\"link\":\"http:\\/\\/localhost\\/Join_Funding\\/funding_joint_28_05_21\\/public\\/auctions\\/51\"}', '2021-06-21 15:46:46', '2021-06-08 18:15:26', '2021-06-21 15:46:46'),
('051c5f1e-ee4b-4adc-9ae7-fe19c57b7cf5', 'App\\Notifications\\UserNotification', 'App\\Model\\Users\\User', 340, '{\"title\":\"Your auction received a bid\",\"body\":\"Your auction ( nmgfdhg ) has received a bid\",\"link\":\"http:\\/\\/3.8.199.229\\/funding_joint_20210622\\/public\\/auctions\\/61\"}', '2021-06-30 11:31:35', '2021-06-29 15:21:32', '2021-06-30 11:31:35'),
('054959b4-ee3a-4d3d-802d-591531c4066b', 'App\\Notifications\\UserNotification', 'App\\Model\\Users\\User', 340, '{\"title\":\"Your auction received a bid\",\"body\":\"Your auction ( nmgfdhg ) has received a bid\",\"link\":\"http:\\/\\/3.8.199.229\\/funding_joint\\/public\\/auctions\\/75\"}', '2021-07-09 19:17:07', '2021-07-09 15:19:17', '2021-07-09 19:17:07'),
('059d0fa0-f378-447f-88ad-4fcc41001d62', 'App\\Notifications\\UserNotification', 'App\\Model\\Users\\User', 340, '{\"title\":\"Your auction received a bid\",\"body\":\"Your auction ( nmgfdhg ) has received a bid\",\"link\":\"http:\\/\\/3.8.199.229\\/funding_joint\\/public\\/auctions\\/83\"}', '2021-07-26 13:15:40', '2021-07-14 16:25:36', '2021-07-26 13:15:40'),
('05ec786d-bc77-4774-8332-79e29b7b9641', 'App\\Notifications\\AdminNotification', 'App\\Model\\Users\\User', 1, '{\"title\":\"User Added Funds\",\"body\":\"Investor- khalidkhan7408@gmail.com added funds, review and confirm\",\"link\":\"http:\\/\\/3.8.199.229\\/funding_joint\\/public\\/transactions?id=329\"}', '2021-07-14 16:24:24', '2021-07-14 16:23:06', '2021-07-14 16:24:24'),
('06c71397-8f6e-4a58-8357-cac0e8f86fe1', 'App\\Notifications\\AdminNotification', 'App\\Model\\Users\\User', 1, '{\"title\":\"User Added Funds\",\"body\":\"Investor- mostwantedpreston@gmail.com added funds, review and confirm\",\"link\":\"http:\\/\\/3.8.199.229\\/funding_joint\\/public\\/transactions?id=342\"}', '2021-07-19 16:34:21', '2021-07-19 16:34:17', '2021-07-19 16:34:21'),
('07282fc2-2bd7-4ebc-bacc-5c6cef4266ae', 'App\\Notifications\\UserNotification', 'App\\Model\\Users\\User', 339, '{\"title\":\"Outbidded\",\"body\":\"You have been outbidded for auction : nmgfdhg\",\"link\":\"http:\\/\\/3.8.199.229\\/funding_joint\\/public\\/auctions\\/86\"}', NULL, '2021-07-22 14:08:27', '2021-07-22 14:08:27'),
('07c792ae-f202-438e-aca5-378196f6bd44', 'App\\Notifications\\AdminNotification', 'App\\Model\\Users\\User', 1, '{\"title\":\"User Added Funds\",\"body\":\"Investor- 34279@iqraisb.edu.pk added funds, review and confirm\",\"link\":\"http:\\/\\/18.132.204.246\\/funding_joint_20210620\\/public\\/transactions?id=254\"}', '2021-06-23 12:25:41', '2021-06-23 09:53:51', '2021-06-23 12:25:41'),
('086fcd6a-cb0b-4e4b-986d-58dcdc399572', 'App\\Notifications\\UserNotification', 'App\\Model\\Users\\User', 340, '{\"title\":\"Your auction received a bid\",\"body\":\"Your auction ( nmgfdhg ) has received a bid\",\"link\":\"http:\\/\\/3.8.199.229\\/funding_joint\\/public\\/auctions\\/87\"}', '2021-07-26 13:13:52', '2021-07-21 12:42:41', '2021-07-26 13:13:52'),
('08e092c9-222e-4a0a-be49-cfd75888c654', 'App\\Notifications\\AdminNotification', 'App\\Model\\Users\\User', 1, '{\"title\":\"Auction Ends\",\"body\":\"Auction #69 has come to end \",\"link\":\"http:\\/\\/3.8.199.229\\/funding_joint\\/public\\/auctions\\/69\"}', '2021-07-05 10:53:39', '2021-07-05 05:00:07', '2021-07-05 10:53:39'),
('0adae521-8de4-4d81-b12c-5f15f1b7eebb', 'App\\Notifications\\AdminNotification', 'App\\Model\\Users\\User', 1, '{\"title\":\"Auction Ends\",\"body\":\"Auction #85 has come to end \",\"link\":\"http:\\/\\/3.8.199.229\\/funding_joint\\/public\\/auctions\\/85\"}', '2021-07-14 16:24:24', '2021-07-13 12:14:05', '2021-07-14 16:24:24'),
('0b381309-4d07-4168-b7b5-2d8b22a972a7', 'App\\Notifications\\AdminNotification', 'App\\Model\\Users\\User', 1, '{\"title\":\"User Added Funds\",\"body\":\"Investor- khalidkhan7408@gmail.com added funds, review and confirm\",\"link\":\"http:\\/\\/3.8.199.229\\/funding_joint\\/public\\/transactions?id=369\"}', NULL, '2021-07-22 14:08:59', '2021-07-22 14:08:59'),
('0dc9c345-8f65-4c78-a415-dda384bb106d', 'App\\Notifications\\UserNotification', 'App\\Model\\Users\\User', 338, '{\"title\":\"Buyer Declined\",\"body\":\"Your Buyer SM technologies has been declined by the admin for the following reason:<br\\/><strong>jhchgfxfgjhgxgh<\\/strong>\",\"link\":\"http:\\/\\/18.132.204.246\\/funding_joint_20210622\\/public\\/buyers\\/show\\/20\"}', '2021-06-24 16:23:42', '2021-06-24 11:40:13', '2021-06-24 16:23:42'),
('0e9e1192-c1f9-4336-8790-d61465a75015', 'App\\Notifications\\UserNotification', 'App\\Model\\Users\\User', 340, '{\"title\":\"Your auction received a bid\",\"body\":\"Your auction ( nmgfdhg ) has received a bid\",\"link\":\"http:\\/\\/3.8.199.229\\/funding_joint\\/public\\/auctions\\/87\"}', '2021-07-26 13:13:52', '2021-07-21 12:48:42', '2021-07-26 13:13:52'),
('0f9fcf9b-02a0-4939-869f-b3a14d53a0da', 'App\\Notifications\\UserNotification', 'App\\Model\\Users\\User', 340, '{\"title\":\"Your auction received a bid\",\"body\":\"Your auction ( nmgfdhg ) has received a bid\",\"link\":\"http:\\/\\/3.8.199.229\\/funding_joint\\/public\\/auctions\\/82\"}', '2021-07-26 13:15:40', '2021-07-18 08:09:50', '2021-07-26 13:15:40'),
('103f0b5e-06d2-41ce-ac36-64ba3ccef1fa', 'App\\Notifications\\UserNotification', 'App\\Model\\Users\\User', 340, '{\"title\":\"Your auction received a bid\",\"body\":\"Your auction ( nmgfdhg ) has received a bid\",\"link\":\"http:\\/\\/3.8.199.229\\/funding_joint\\/public\\/auctions\\/85\"}', '2021-07-13 17:14:35', '2021-07-13 12:14:05', '2021-07-13 17:14:35'),
('10f6fc00-3011-4420-9633-e8b1ec14442f', 'App\\Notifications\\UserNotification', 'App\\Model\\Users\\User', 339, '{\"title\":\"Outbidded\",\"body\":\"You have been outbidded for auction : nmgfdhg\",\"link\":\"http:\\/\\/3.8.199.229\\/funding_joint\\/public\\/auctions\\/89\"}', NULL, '2021-07-20 16:26:29', '2021-07-20 16:26:29'),
('13757f88-353a-4c3c-bd63-8e76e791d775', 'App\\Notifications\\UserNotification', 'App\\Model\\Users\\User', 338, '{\"title\":\"Your auction received a bid\",\"body\":\"Your auction ( none ) has received a bid\",\"link\":\"http:\\/\\/3.8.199.229\\/funding_joint_20210622\\/public\\/auctions\\/53\"}', NULL, '2021-06-26 00:31:22', '2021-06-26 00:31:22'),
('14719f46-4e86-48fc-a33a-7a9345521bd1', 'App\\Notifications\\UserNotification', 'App\\Model\\Users\\User', 340, '{\"title\":\"Your auction received a bid\",\"body\":\"Your auction ( nmgfdhg ) has received a bid\",\"link\":\"http:\\/\\/3.8.199.229\\/funding_joint\\/public\\/auctions\\/66\"}', '2021-07-07 07:13:09', '2021-07-05 15:43:54', '2021-07-07 07:13:09'),
('165bf8c1-50ad-46d3-98cd-35bfca25789e', 'App\\Notifications\\UserNotification', 'App\\Model\\Users\\User', 340, '{\"title\":\"Your auction received a bid\",\"body\":\"Your auction ( nmgfdhg ) has received a bid\",\"link\":\"http:\\/\\/18.170.35.138\\/funding_joint\\/public\\/auctions\\/90\"}', NULL, '2021-07-26 22:57:58', '2021-07-26 22:57:58'),
('16bc983a-3eda-4690-b0fc-a9c47b3439a0', 'App\\Notifications\\UserNotification', 'App\\Model\\Users\\User', 339, '{\"title\":\"Bid rejected\",\"body\":\"Your Bid for auction #51 is rejected. \",\"link\":\"http:\\/\\/localhost\\/Join_Funding\\/funding_joint_28_05_21\\/public\\/auctions\\/51\"}', '2021-06-08 18:28:41', '2021-06-08 18:15:37', '2021-06-08 18:28:41'),
('1897bbe9-9df4-4619-bb8a-9d67709ce39f', 'App\\Notifications\\UserNotification', 'App\\Model\\Users\\User', 351, '{\"title\":\"Payment Received\",\"body\":\"Admin has released your funds!\",\"link\":\"http:\\/\\/3.8.199.229\\/funding_joint\\/public\\/account\"}', '2021-07-22 12:16:53', '2021-07-22 10:37:36', '2021-07-22 12:16:53'),
('18e4d3d6-9bb0-4877-bc17-35a6eb2dbfb9', 'App\\Notifications\\AdminNotification', 'App\\Model\\Users\\User', 1, '{\"title\":\"User Added Funds\",\"body\":\"Investor- mostwantedpreston@gmail.com added funds, review and confirm\",\"link\":\"http:\\/\\/18.170.35.138\\/funding_joint\\/public\\/transactions?id=386\"}', NULL, '2021-07-25 23:25:06', '2021-07-25 23:25:06'),
('1aa32695-2ccc-4f9b-9800-0c1ff5fae2d6', 'App\\Notifications\\UserNotification', 'App\\Model\\Users\\User', 346, '{\"title\":\"Your auction has come to end\",\"body\":\"Your auction #69 has come to end, please upload the invoice by 05\\/07\\/2021\",\"link\":\"http:\\/\\/3.8.199.229\\/funding_joint\\/public\\/auctions\\/69\"}', '2021-07-05 05:05:08', '2021-07-05 05:00:07', '2021-07-05 05:05:08'),
('1b278957-c7ce-4298-bd7b-004ee8c195fc', 'App\\Notifications\\UserNotification', 'App\\Model\\Users\\User', 340, '{\"title\":\"Your auction received a bid\",\"body\":\"Your auction ( nmgfdhg ) has received a bid\",\"link\":\"http:\\/\\/18.170.35.138\\/funding_joint\\/public\\/auctions\\/91\"}', '2021-07-26 12:28:51', '2021-07-25 22:54:54', '2021-07-26 12:28:51'),
('1c0ba61b-7db2-4cf0-b1c0-131d182b0e5a', 'App\\Notifications\\UserNotification', 'App\\Model\\Users\\User', 339, '{\"title\":\"Bid Partially Accepted\",\"body\":\"Your Bid for auction #53 is Partially Accepted. \",\"link\":\"http:\\/\\/3.8.199.229\\/funding_joint_20210622\\/public\\/auctions\\/53\"}', '2021-07-05 04:46:00', '2021-06-26 00:02:09', '2021-07-05 04:46:00'),
('1cb1fffa-2124-4d00-b205-57bc89aac94a', 'App\\Notifications\\UserNotification', 'App\\Model\\Users\\User', 338, '{\"title\":\"Your auction received a bid\",\"body\":\"Your auction ( none ) has received a bid\",\"link\":\"http:\\/\\/localhost\\/Join_Funding\\/funding_joint_28_05_21\\/public\\/auctions\\/51\"}', '2021-06-21 15:50:09', '2021-06-08 18:11:52', '2021-06-21 15:50:09'),
('1cf9a298-b573-47d0-942e-427d42183eaf', 'App\\Notifications\\UserNotification', 'App\\Model\\Users\\User', 338, '{\"title\":\"Buyer Approved\",\"body\":\"Admin has approved xasxas ( 19 )\",\"link\":\"http:\\/\\/localhost\\/Join_Funding\\/funding_joint_28_05_21\\/public\\/buyers\\/show\\/19\"}', '2021-06-21 15:50:04', '2021-06-08 17:44:59', '2021-06-21 15:50:04'),
('1d1f29b1-15e1-40d0-96d5-e3099c8feeab', 'App\\Notifications\\UserNotification', 'App\\Model\\Users\\User', 339, '{\"title\":\"Bid rejected\",\"body\":\"Your Bid for auction #51 is rejected. \",\"link\":\"http:\\/\\/localhost\\/Join_Funding\\/funding_joint_28_05_21\\/public\\/auctions\\/51\"}', NULL, '2021-06-08 18:15:36', '2021-06-08 18:15:36'),
('1d57e625-5f03-4bad-bd4d-cfc4626b11b0', 'App\\Notifications\\UserNotification', 'App\\Model\\Users\\User', 340, '{\"title\":\"Your auction received a bid\",\"body\":\"Your auction ( nmgfdhg ) has received a bid\",\"link\":\"http:\\/\\/3.8.199.229\\/funding_joint\\/public\\/auctions\\/86\"}', '2021-07-26 13:15:36', '2021-07-19 16:07:06', '2021-07-26 13:15:36'),
('1d5ba91d-d549-4a12-93ae-d08bf52dbe0b', 'App\\Notifications\\UserNotification', 'App\\Model\\Users\\User', 340, '{\"title\":\"Auction Approved\",\"body\":\"Your Auction #60 has been approved by the admin!\",\"link\":\"http:\\/\\/3.8.199.229\\/funding_joint_20210622\\/public\\/auctions\\/60\"}', '2021-06-30 11:31:35', '2021-06-29 15:12:55', '2021-06-30 11:31:35'),
('1d76f48e-84e3-4955-9c0f-4dbab430956a', 'App\\Notifications\\UserNotification', 'App\\Model\\Users\\User', 340, '{\"title\":\"Your auction received a bid\",\"body\":\"Your auction ( nmgfdhg ) has received a bid\",\"link\":\"http:\\/\\/18.170.35.138\\/funding_joint\\/public\\/auctions\\/92\"}', NULL, '2021-07-26 16:35:56', '2021-07-26 16:35:56'),
('1e06af31-f71e-4eb2-874f-be0b9f78ab38', 'App\\Notifications\\UserNotification', 'App\\Model\\Users\\User', 338, '{\"title\":\"Your auction received a bid\",\"body\":\"Your auction ( none ) has received a bid\",\"link\":\"http:\\/\\/18.132.204.246\\/funding_joint_20210620\\/public\\/auctions\\/53\"}', '2021-06-24 16:23:42', '2021-06-23 13:55:00', '2021-06-24 16:23:42'),
('1e3fe0f1-276f-487a-bda4-6b97a0e76f85', 'App\\Notifications\\AdminNotification', 'App\\Model\\Users\\User', 1, '{\"title\":\"Auction Created\",\"body\":\"khalid khan created an auction for shahzeb\",\"link\":\"http:\\/\\/3.8.199.229\\/funding_joint\\/public\\/auctions?id=84\"}', '2021-07-12 08:30:44', '2021-07-12 08:28:30', '2021-07-12 08:30:44'),
('1e573984-8d62-4f94-87a6-0bce008d76cb', 'App\\Notifications\\AdminNotification', 'App\\Model\\Users\\User', 1, '{\"title\":\"User Added Funds\",\"body\":\"Investor- mostwantedpreston@gmail.com added funds, review and confirm\",\"link\":\"http:\\/\\/18.170.35.138\\/funding_joint\\/public\\/transactions?id=390\"}', '2021-07-28 15:18:10', '2021-07-26 16:37:40', '2021-07-28 15:18:10'),
('1f5d87e8-1dfc-42a8-a152-d0b3c1f2d445', 'App\\Notifications\\UserNotification', 'App\\Model\\Users\\User', 340, '{\"title\":\"Auction Approved\",\"body\":\"Your Auction #88 has been approved by the admin!\",\"link\":\"http:\\/\\/3.8.199.229\\/funding_joint\\/public\\/auctions\\/88\"}', '2021-07-26 13:15:36', '2021-07-20 15:20:13', '2021-07-26 13:15:36'),
('20504135-4cba-4774-b547-3379a0dfa1d3', 'App\\Notifications\\UserNotification', 'App\\Model\\Users\\User', 339, '{\"title\":\"Bid rejected\",\"body\":\"Your Bid for auction #51 is rejected. \",\"link\":\"http:\\/\\/localhost\\/Join_Funding\\/funding_joint_28_05_21\\/public\\/auctions\\/51\"}', NULL, '2021-06-08 18:15:36', '2021-06-08 18:15:36'),
('2064decd-2c10-455e-88c9-6d5d1d831281', 'App\\Notifications\\UserNotification', 'App\\Model\\Users\\User', 340, '{\"title\":\"Admin Message\",\"body\":\"You have got message from Admin\",\"link\":\"\"}', '2021-06-25 12:13:02', '2021-06-25 12:12:14', '2021-06-25 12:13:02'),
('21439c82-0b09-4176-922e-485d770c1997', 'App\\Notifications\\UserNotification', 'App\\Model\\Users\\User', 345, '{\"title\":\"Admin Message\",\"body\":\"You have got message from Admin\",\"link\":\"\"}', NULL, '2021-06-21 13:56:31', '2021-06-21 13:56:31'),
('21f3bed8-b7ed-4ce6-8a04-d08870552744', 'App\\Notifications\\AdminNotification', 'App\\Model\\Users\\User', 1, '{\"title\":\"Auction Created\",\"body\":\"seller faslkj created an auction for xasxas\",\"link\":\"http:\\/\\/localhost\\/Join_Funding\\/funding_joint_28_05_21\\/public\\/auctions?id=51\"}', '2021-06-21 13:56:00', '2021-06-08 17:50:41', '2021-06-21 13:56:00'),
('22b51daf-4b39-4944-9edc-844c6fc8b2af', 'App\\Notifications\\UserNotification', 'App\\Model\\Users\\User', 346, '{\"title\":\"Admin Message\",\"body\":\"You have got message from Admin\",\"link\":\"\"}', NULL, '2021-06-30 11:52:21', '2021-06-30 11:52:21'),
('24bd3c5c-9fa8-44d8-9f79-69a12a17317c', 'App\\Notifications\\UserNotification', 'App\\Model\\Users\\User', 340, '{\"title\":\"Your auction received a bid\",\"body\":\"Your auction ( nmgfdhg ) has received a bid\",\"link\":\"http:\\/\\/18.170.35.138\\/funding_joint\\/public\\/auctions\\/86\"}', '2021-07-26 12:28:51', '2021-07-25 17:19:43', '2021-07-26 12:28:51'),
('26597d29-052d-4639-9f68-1395af223860', 'App\\Notifications\\UserNotification', 'App\\Model\\Users\\User', 351, '{\"title\":\"Payment Received\",\"body\":\"Admin has confirmed your funds!\",\"link\":\"http:\\/\\/18.170.35.138\\/funding_joint\\/public\\/account\"}', NULL, '2021-07-25 23:26:46', '2021-07-25 23:26:46'),
('2689cbe9-8953-4490-b2c0-2d8ccd9d37ca', 'App\\Notifications\\UserNotification', 'App\\Model\\Users\\User', 340, '{\"title\":\"Auction Approved\",\"body\":\"Your Auction #87 has been approved by the admin!\",\"link\":\"http:\\/\\/3.8.199.229\\/funding_joint\\/public\\/auctions\\/87\"}', '2021-07-26 13:15:36', '2021-07-20 15:18:37', '2021-07-26 13:15:36'),
('27d42750-da46-40eb-96dc-1674b4737179', 'App\\Notifications\\UserNotification', 'App\\Model\\Users\\User', 340, '{\"title\":\"Your auction received a bid\",\"body\":\"Your auction ( nmgfdhg ) has received a bid\",\"link\":\"http:\\/\\/3.8.199.229\\/funding_joint\\/public\\/auctions\\/87\"}', '2021-07-26 13:14:00', '2021-07-21 12:37:08', '2021-07-26 13:14:00'),
('2938941f-291a-4c76-b348-0a1b44e98a80', 'App\\Notifications\\UserNotification', 'App\\Model\\Users\\User', 340, '{\"title\":\"Your auction received a bid\",\"body\":\"Your auction ( nmgfdhg ) has received a bid\",\"link\":\"http:\\/\\/18.170.35.138\\/funding_joint\\/public\\/auctions\\/90\"}', '2021-07-29 14:10:28', '2021-07-29 11:25:14', '2021-07-29 14:10:28'),
('29af38c6-5f3c-40c8-86e7-4a335df036c3', 'App\\Notifications\\AdminNotification', 'App\\Model\\Users\\User', 1, '{\"title\":\"Auction Created\",\"body\":\"khalid khan created an auction for shahzeb\",\"link\":\"http:\\/\\/18.170.35.138\\/funding_joint\\/public\\/auctions?id=96\"}', '2021-07-28 15:18:10', '2021-07-26 23:17:43', '2021-07-28 15:18:10'),
('29f4cee3-f1e0-4856-a511-98bef3347c5c', 'App\\Notifications\\UserNotification', 'App\\Model\\Users\\User', 346, '{\"title\":\"Registration Approval\",\"body\":\"You have been approved by the Admin\",\"link\":\"\"}', '2021-07-09 18:59:55', '2021-07-05 16:25:28', '2021-07-09 18:59:55'),
('2a46f407-b96c-4d7d-82cc-feffd35a6631', 'App\\Notifications\\UserNotification', 'App\\Model\\Users\\User', 338, '{\"title\":\"Your auction received a bid\",\"body\":\"Your auction ( none ) has received a bid\",\"link\":\"http:\\/\\/localhost\\/Join_Funding\\/funding_joint_28_05_21\\/public\\/auctions\\/51\"}', '2021-06-21 15:50:09', '2021-06-08 18:08:36', '2021-06-21 15:50:09'),
('2cb927ce-9a57-44aa-a71f-743b73c5c406', 'App\\Notifications\\AdminNotification', 'App\\Model\\Users\\User', 1, '{\"title\":\"User Added Funds\",\"body\":\"Investor- 34279@iqraisb.edu.pk added funds, review and confirm\",\"link\":\"http:\\/\\/3.8.199.229\\/funding_joint\\/public\\/transactions?id=373\"}', NULL, '2021-07-22 16:51:20', '2021-07-22 16:51:20'),
('2d6a7cb0-449a-44fd-80c9-eb448be417ff', 'App\\Notifications\\AdminNotification', 'App\\Model\\Users\\User', 1, '{\"title\":\"Auction Created\",\"body\":\"seller faslkj created an auction for SM technologies\",\"link\":\"http:\\/\\/18.132.204.246\\/funding_joint_20210620\\/public\\/auctions?id=53\"}', '2021-06-23 12:25:41', '2021-06-23 09:49:05', '2021-06-23 12:25:41'),
('2e1b7c0b-6ecf-4921-b175-503dd7659158', 'App\\Notifications\\AdminNotification', 'App\\Model\\Users\\User', 1, '{\"title\":\"Auction Created\",\"body\":\"khalid khan created an auction for sds\",\"link\":\"http:\\/\\/3.8.199.229\\/funding_joint\\/public\\/auctions?id=90\"}', NULL, '2021-07-22 17:11:36', '2021-07-22 17:11:36'),
('2e1d26e1-4d97-496e-8ffe-f41488e582d2', 'App\\Notifications\\UserNotification', 'App\\Model\\Users\\User', 346, '{\"title\":\"Payment Received\",\"body\":\"Admin has released your funds!\",\"link\":\"http:\\/\\/3.8.199.229\\/funding_joint\\/public\\/account\"}', '2021-07-05 05:05:08', '2021-07-05 05:04:27', '2021-07-05 05:05:08'),
('2f27bdae-7c89-40f9-8096-1a52df497d11', 'App\\Notifications\\AdminNotification', 'App\\Model\\Users\\User', 1, '{\"title\":\"User Added Funds\",\"body\":\"Investor- 34279@iqraisb.edu.pk added funds, review and confirm\",\"link\":\"http:\\/\\/3.8.199.229\\/funding_joint\\/public\\/transactions?id=326\"}', '2021-07-14 16:24:24', '2021-07-13 17:17:15', '2021-07-14 16:24:24'),
('2f812443-c206-4eed-a60f-102e2a10d9b2', 'App\\Notifications\\AdminNotification', 'App\\Model\\Users\\User', 1, '{\"title\":\"Auction Ends\",\"body\":\"Auction #53 has come to end \",\"link\":\"http:\\/\\/3.8.199.229\\/funding_joint_20210622\\/public\\/auctions\\/53\"}', '2021-06-27 09:09:49', '2021-06-26 00:02:09', '2021-06-27 09:09:49'),
('305c8768-2b2a-4dcb-86b5-0f4e1c9fd76b', 'App\\Notifications\\UserNotification', 'App\\Model\\Users\\User', 340, '{\"title\":\"Your auction received a bid\",\"body\":\"Your auction ( nmgfdhg ) has received a bid\",\"link\":\"http:\\/\\/18.170.35.138\\/funding_joint\\/public\\/auctions\\/91\"}', NULL, '2021-07-26 21:44:55', '2021-07-26 21:44:55'),
('30c94d8b-ae7d-4991-89d9-0c30232e21a3', 'App\\Notifications\\UserNotification', 'App\\Model\\Users\\User', 339, '{\"title\":\"Payment Received\",\"body\":\"Admin has confirmed your funds!\",\"link\":\"http:\\/\\/3.8.199.229\\/funding_joint\\/public\\/account\"}', NULL, '2021-07-22 16:51:42', '2021-07-22 16:51:42'),
('31ce6b8e-b437-4fe8-a879-9bc50022a32f', 'App\\Notifications\\UserNotification', 'App\\Model\\Users\\User', 347, '{\"title\":\"Payment Received\",\"body\":\"Admin has confirmed your funds!\",\"link\":\"http:\\/\\/18.170.35.138\\/funding_joint\\/public\\/account\"}', '2021-07-29 13:41:32', '2021-07-29 13:39:52', '2021-07-29 13:41:32'),
('327040a7-b81a-41ac-b257-2ad79695b2e8', 'App\\Notifications\\UserNotification', 'App\\Model\\Users\\User', 347, '{\"title\":\"Payment Received\",\"body\":\"Admin has confirmed your funds!\",\"link\":\"http:\\/\\/3.8.199.229\\/funding_joint_20210622\\/public\\/account\"}', '2021-06-30 11:47:41', '2021-06-29 15:41:21', '2021-06-30 11:47:41'),
('32d8418a-47b0-411c-a405-8ccf9c9e2526', 'App\\Notifications\\UserNotification', 'App\\Model\\Users\\User', 340, '{\"title\":\"Auction Approved\",\"body\":\"Your Auction #92 has been approved by the admin!\",\"link\":\"http:\\/\\/3.8.199.229\\/funding_joint\\/public\\/auctions\\/92\"}', '2021-07-26 13:13:52', '2021-07-22 17:14:32', '2021-07-26 13:13:52'),
('330ae818-5e46-4cb8-9569-1743ccea499f', 'App\\Notifications\\UserNotification', 'App\\Model\\Users\\User', 340, '{\"title\":\"Auction Approved\",\"body\":\"Your Auction #75 has been approved by the admin!\",\"link\":\"http:\\/\\/3.8.199.229\\/funding_joint\\/public\\/auctions\\/75\"}', '2021-07-09 19:17:07', '2021-07-09 15:15:58', '2021-07-09 19:17:07'),
('33318f07-816c-4fb8-8d0f-df6647155e1d', 'App\\Notifications\\AdminNotification', 'App\\Model\\Users\\User', 1, '{\"title\":\"User Withdraws Funds\",\"body\":\"Investor- mostwantedpreston@gmail.com Requested to withdraw funds, review and confirm\",\"link\":\"http:\\/\\/18.170.35.138\\/funding_joint\\/public\\/transactions?id=400\"}', '2021-07-28 15:18:10', '2021-07-26 23:37:52', '2021-07-28 15:18:10'),
('33565949-51b8-468c-829c-b7f67f03a7bb', 'App\\Notifications\\UserNotification', 'App\\Model\\Users\\User', 347, '{\"title\":\"Payment Received\",\"body\":\"Admin has confirmed your funds!\",\"link\":\"http:\\/\\/3.8.199.229\\/funding_joint_20210622\\/public\\/account\"}', '2021-06-29 15:31:53', '2021-06-29 15:31:39', '2021-06-29 15:31:53'),
('35d7dbe4-7edc-49fd-8e39-38a577af25b5', 'App\\Notifications\\UserNotification', 'App\\Model\\Users\\User', 346, '{\"title\":\"Your auction received a bid\",\"body\":\"Your auction ( Gfgf ) has received a bid\",\"link\":\"http:\\/\\/3.8.199.229\\/funding_joint\\/public\\/auctions\\/67\"}', '2021-07-09 18:59:55', '2021-07-05 15:42:53', '2021-07-09 18:59:55'),
('35e12f39-27c3-4d5f-bd11-c14ea92d224b', 'App\\Notifications\\UserNotification', 'App\\Model\\Users\\User', 339, '{\"title\":\"Bid rejected\",\"body\":\"Your Bid for auction #51 is rejected. \",\"link\":\"http:\\/\\/localhost\\/Join_Funding\\/funding_joint_28_05_21\\/public\\/auctions\\/51\"}', '2021-06-08 18:28:41', '2021-06-08 18:15:37', '2021-06-08 18:28:41'),
('3602f1b6-bf3c-4193-8e3a-c0c9005c3b25', 'App\\Notifications\\AdminNotification', 'App\\Model\\Users\\User', 1, '{\"title\":\"Buyer Created\",\"body\":\"khalid khan has registered a buyer :  sds ( 22 )\",\"link\":\"http:\\/\\/18.132.204.246\\/funding_joint_20210622\\/public\\/buyers\"}', '2021-06-25 12:32:45', '2021-06-25 12:28:31', '2021-06-25 12:32:45'),
('361e96f2-6cd7-4b3c-bfb4-f733e1edfc8f', 'App\\Notifications\\AdminNotification', 'App\\Model\\Users\\User', 1, '{\"title\":\"Auction Created\",\"body\":\"khalid khan created an auction for sds\",\"link\":\"http:\\/\\/3.8.199.229\\/funding_joint_20210622\\/public\\/auctions?id=60\"}', '2021-06-28 17:05:31', '2021-06-28 17:04:30', '2021-06-28 17:05:31'),
('3660f262-15d2-40d6-b2ac-14c76851420e', 'App\\Notifications\\UserNotification', 'App\\Model\\Users\\User', 340, '{\"title\":\"Admin Message\",\"body\":\"You have got message from Admin\",\"link\":\"\"}', '2021-06-24 12:13:17', '2021-06-24 12:12:42', '2021-06-24 12:13:17'),
('377390f8-1ef2-4b86-bac2-80c6b684742f', 'App\\Notifications\\AdminNotification', 'App\\Model\\Users\\User', 1, '{\"title\":\"Auction Ends\",\"body\":\"Auction #62 has come to end \",\"link\":\"http:\\/\\/3.8.199.229\\/funding_joint\\/public\\/auctions\\/62\"}', '2021-07-04 05:41:16', '2021-07-03 06:49:09', '2021-07-04 05:41:16'),
('391e1814-c5e9-4da0-b13d-a467f4f21b26', 'App\\Notifications\\AdminNotification', 'App\\Model\\Users\\User', 1, '{\"title\":\"Auction Created\",\"body\":\"khalid khan created an auction for sds\",\"link\":\"http:\\/\\/3.8.199.229\\/funding_joint\\/public\\/auctions?id=86\"}', '2021-07-19 16:26:20', '2021-07-19 15:50:39', '2021-07-19 16:26:20'),
('39f784c7-5099-4ec8-afb1-ba5d8eb1bfa8', 'App\\Notifications\\UserNotification', 'App\\Model\\Users\\User', 340, '{\"title\":\"Auction Approved\",\"body\":\"Your Auction #70 has been approved by the admin!\",\"link\":\"http:\\/\\/3.8.199.229\\/funding_joint\\/public\\/auctions\\/70\"}', '2021-07-07 07:13:09', '2021-07-05 16:26:28', '2021-07-07 07:13:09'),
('3a3e9604-14d5-41d3-aee1-e8bd5689063c', 'App\\Notifications\\UserNotification', 'App\\Model\\Users\\User', 347, '{\"title\":\"Payment Received\",\"body\":\"Admin has released your funds!\",\"link\":\"http:\\/\\/3.8.199.229\\/funding_joint\\/public\\/account\"}', '2021-07-29 02:30:25', '2021-07-22 14:14:00', '2021-07-29 02:30:25'),
('3a74bb42-a7af-43b2-9f0b-c6c22898c287', 'App\\Notifications\\UserNotification', 'App\\Model\\Users\\User', 340, '{\"title\":\"Your auction received a bid\",\"body\":\"Your auction ( nmgfdhg ) has received a bid\",\"link\":\"http:\\/\\/3.8.199.229\\/funding_joint\\/public\\/auctions\\/86\"}', '2021-07-26 13:15:36', '2021-07-19 16:14:22', '2021-07-26 13:15:36'),
('3aeef32c-7233-483a-8bfe-9151f88c07dd', 'App\\Notifications\\UserNotification', 'App\\Model\\Users\\User', 340, '{\"title\":\"Your auction received a bid\",\"body\":\"Your auction ( nmgfdhg ) has received a bid\",\"link\":\"http:\\/\\/3.8.199.229\\/funding_joint\\/public\\/auctions\\/84\"}', '2021-07-13 17:14:35', '2021-07-12 09:48:40', '2021-07-13 17:14:35'),
('3bebe2d8-c1dc-49ad-b026-66a7b3b1bb80', 'App\\Notifications\\UserNotification', 'App\\Model\\Users\\User', 346, '{\"title\":\"Payment Received\",\"body\":\"Admin has released your funds!\",\"link\":\"http:\\/\\/3.8.199.229\\/funding_joint\\/public\\/account\"}', '2021-07-09 18:59:55', '2021-07-09 18:58:46', '2021-07-09 18:59:55'),
('3c75489b-139a-422d-9f37-3e94547bd2c0', 'App\\Notifications\\UserNotification', 'App\\Model\\Users\\User', 340, '{\"title\":\"Your auction received a bid\",\"body\":\"Your auction ( nmgfdhg ) has received a bid\",\"link\":\"http:\\/\\/18.170.35.138\\/funding_joint\\/public\\/auctions\\/91\"}', '2021-07-26 12:28:51', '2021-07-25 23:01:01', '2021-07-26 12:28:51'),
('3cb374b8-0cde-4be8-bcbd-9e2d1e9ff5f6', 'App\\Notifications\\AdminNotification', 'App\\Model\\Users\\User', 1, '{\"title\":\"User Withdraws Funds\",\"body\":\"Investor- khalidkhan7408@gmail.com Requested to withdraw funds, review and confirm\",\"link\":\"http:\\/\\/3.8.199.229\\/funding_joint\\/public\\/transactions?id=370\"}', NULL, '2021-07-22 14:11:28', '2021-07-22 14:11:28'),
('3e499ab1-b94c-4f60-be2a-7b3e7d734e34', 'App\\Notifications\\UserNotification', 'App\\Model\\Users\\User', 338, '{\"title\":\"Buyer Approved\",\"body\":\"Admin has approved Shahzeb Company ( 21 )\",\"link\":\"http:\\/\\/18.132.204.246\\/funding_joint_20210622\\/public\\/buyers\\/show\\/21\"}', '2021-06-25 15:05:32', '2021-06-24 17:49:10', '2021-06-25 15:05:32'),
('3ec0ac10-d352-4b01-a077-a9b5401bde32', 'App\\Notifications\\UserNotification', 'App\\Model\\Users\\User', 340, '{\"title\":\"Your auction received a bid\",\"body\":\"Your auction ( nmgfdhg ) has received a bid\",\"link\":\"http:\\/\\/3.8.199.229\\/funding_joint\\/public\\/auctions\\/75\"}', '2021-07-09 19:17:07', '2021-07-09 18:41:11', '2021-07-09 19:17:07'),
('42dff064-92cc-4534-b272-5ed9452d36bb', 'App\\Notifications\\UserNotification', 'App\\Model\\Users\\User', 340, '{\"title\":\"Your auction has come to end\",\"body\":\"Your auction #62 has come to end, please upload the invoice by 01\\/01\\/1970\",\"link\":\"http:\\/\\/3.8.199.229\\/funding_joint\\/public\\/auctions\\/62\"}', '2021-07-05 02:26:24', '2021-07-03 06:49:09', '2021-07-05 02:26:24'),
('43d2377b-355f-4f89-8d3e-35d34aeb2cdc', 'App\\Notifications\\UserNotification', 'App\\Model\\Users\\User', 340, '{\"title\":\"Your auction received a bid\",\"body\":\"Your auction ( nmgfdhg ) has received a bid\",\"link\":\"http:\\/\\/3.8.199.229\\/funding_joint\\/public\\/auctions\\/88\"}', '2021-07-26 13:14:00', '2021-07-20 16:34:06', '2021-07-26 13:14:00'),
('43f80927-710a-496d-9b84-0f4ba9aed067', 'App\\Notifications\\UserNotification', 'App\\Model\\Users\\User', 347, '{\"title\":\"Registration Approval\",\"body\":\"You have been approved by the Admin\",\"link\":\"\"}', '2021-06-25 23:49:51', '2021-06-25 23:47:03', '2021-06-25 23:49:51'),
('453ce39a-67f8-4a09-9322-6e43badced1c', 'App\\Notifications\\UserNotification', 'App\\Model\\Users\\User', 351, '{\"title\":\"Registration Approval\",\"body\":\"You have been approved by the Admin\",\"link\":\"\"}', '2021-07-22 12:16:53', '2021-07-19 16:33:38', '2021-07-22 12:16:53'),
('45b95ef0-3101-4eb1-8fbc-3745fa97ed43', 'App\\Notifications\\UserNotification', 'App\\Model\\Users\\User', 351, '{\"title\":\"Payment Received\",\"body\":\"Admin has confirmed your funds!\",\"link\":\"http:\\/\\/3.8.199.229\\/funding_joint\\/public\\/account\"}', NULL, '2021-07-22 12:17:54', '2021-07-22 12:17:54'),
('46b81678-56d0-4506-8cc3-a91d10fb3850', 'App\\Notifications\\UserNotification', 'App\\Model\\Users\\User', 340, '{\"title\":\"Auction Approved\",\"body\":\"Your Auction #84 has been approved by the admin!\",\"link\":\"http:\\/\\/3.8.199.229\\/funding_joint\\/public\\/auctions\\/84\"}', '2021-07-13 17:14:35', '2021-07-12 09:02:38', '2021-07-13 17:14:35'),
('46ea3fb4-0336-458c-b633-f5773555a259', 'App\\Notifications\\AdminNotification', 'App\\Model\\Users\\User', 1, '{\"title\":\"User Withdraws Funds\",\"body\":\"Investor- mostwantedpreston@gmail.com Requested to withdraw funds, review and confirm\",\"link\":\"http:\\/\\/3.8.199.229\\/funding_joint\\/public\\/transactions?id=363\"}', NULL, '2021-07-22 10:37:28', '2021-07-22 10:37:28'),
('475e3c92-b4df-42a2-8112-7895295c9ea1', 'App\\Notifications\\UserNotification', 'App\\Model\\Users\\User', 338, '{\"title\":\"Your auction received a bid\",\"body\":\"Your auction ( none ) has received a bid\",\"link\":\"http:\\/\\/localhost\\/Join_Funding\\/funding_joint_28_05_21\\/public\\/auctions\\/51\"}', '2021-06-21 15:50:09', '2021-06-08 18:10:45', '2021-06-21 15:50:09'),
('476a9d64-5680-48a5-8c90-38093319d920', 'App\\Notifications\\UserNotification', 'App\\Model\\Users\\User', 340, '{\"title\":\"Your auction received a bid\",\"body\":\"Your auction ( nmgfdhg ) has received a bid\",\"link\":\"http:\\/\\/3.8.199.229\\/funding_joint\\/public\\/auctions\\/86\"}', '2021-07-26 13:13:52', '2021-07-22 14:08:27', '2021-07-26 13:13:52'),
('47f93b01-6784-42c1-8c62-621027aa9295', 'App\\Notifications\\AdminNotification', 'App\\Model\\Users\\User', 1, '{\"title\":\"User Added Funds\",\"body\":\"Investor- khalidkhan7408@gmail.com added funds, review and confirm\",\"link\":\"http:\\/\\/3.8.199.229\\/funding_joint\\/public\\/transactions?id=304\"}', '2021-07-07 05:41:03', '2021-07-05 16:26:37', '2021-07-07 05:41:03'),
('48deb9e4-8693-4ac9-af90-0450a606709d', 'App\\Notifications\\UserNotification', 'App\\Model\\Users\\User', 351, '{\"title\":\"Payment Received\",\"body\":\"Admin has released your funds!\",\"link\":\"http:\\/\\/3.8.199.229\\/funding_joint\\/public\\/account\"}', '2021-07-22 12:16:53', '2021-07-22 12:14:19', '2021-07-22 12:16:53'),
('499e6677-05a8-4b6d-a479-31da64f791b5', 'App\\Notifications\\UserNotification', 'App\\Model\\Users\\User', 339, '{\"title\":\"Bid rejected\",\"body\":\"Your Bid for auction #51 is rejected. \",\"link\":\"http:\\/\\/localhost\\/Join_Funding\\/funding_joint_28_05_21\\/public\\/auctions\\/51\"}', '2021-06-08 18:28:41', '2021-06-08 18:15:37', '2021-06-08 18:28:41'),
('4bcaa3a5-13d8-47ec-9f2e-7c7df3c3900a', 'App\\Notifications\\UserNotification', 'App\\Model\\Users\\User', 340, '{\"title\":\"Your auction received a bid\",\"body\":\"Your auction ( nmgfdhg ) has received a bid\",\"link\":\"http:\\/\\/3.8.199.229\\/funding_joint\\/public\\/auctions\\/89\"}', '2021-07-26 13:14:00', '2021-07-20 16:18:15', '2021-07-26 13:14:00'),
('4cc807d6-7289-48e0-a1b6-35361cd75b78', 'App\\Notifications\\UserNotification', 'App\\Model\\Users\\User', 351, '{\"title\":\"Payment Received\",\"body\":\"Admin has confirmed your funds!\",\"link\":\"http:\\/\\/3.8.199.229\\/funding_joint\\/public\\/account\"}', '2021-07-22 12:16:53', '2021-07-19 16:34:28', '2021-07-22 12:16:53'),
('4f5da988-f283-40f9-9d9f-f104c007fbbe', 'App\\Notifications\\AdminNotification', 'App\\Model\\Users\\User', 1, '{\"title\":\"Seller Registered\",\"body\":\"m zaheer registered as a seller. Click to review and approve.\",\"link\":\"http:\\/\\/localhost\\/Join_Funding\\/funding_joint_28_05_21\\/public\\/users?id=338\"}', '2021-06-08 16:13:30', '2021-06-08 16:10:54', '2021-06-08 16:13:30'),
('5026c0f9-d3f3-4fb8-a244-ea910ebeb74a', 'App\\Notifications\\UserNotification', 'App\\Model\\Users\\User', 339, '{\"title\":\"Bid rejected\",\"body\":\"Your Bid for auction #51 is rejected. \",\"link\":\"http:\\/\\/localhost\\/Join_Funding\\/funding_joint_28_05_21\\/public\\/auctions\\/51\"}', '2021-06-08 18:28:41', '2021-06-08 18:15:37', '2021-06-08 18:28:41'),
('5032cd81-e6f6-41c5-a047-49d7df355265', 'App\\Notifications\\UserNotification', 'App\\Model\\Users\\User', 340, '{\"title\":\"Your auction received a bid\",\"body\":\"Your auction ( nmgfdhg ) has received a bid\",\"link\":\"http:\\/\\/3.8.199.229\\/funding_joint\\/public\\/auctions\\/89\"}', '2021-07-26 13:14:00', '2021-07-20 16:25:06', '2021-07-26 13:14:00'),
('5035c518-cb39-4db9-b23c-63ae5a1d2279', 'App\\Notifications\\UserNotification', 'App\\Model\\Users\\User', 340, '{\"title\":\"Your auction received a bid\",\"body\":\"Your auction ( nmgfdhg ) has received a bid\",\"link\":\"http:\\/\\/3.8.199.229\\/funding_joint\\/public\\/auctions\\/81\"}', '2021-07-26 13:15:40', '2021-07-19 10:03:41', '2021-07-26 13:15:40'),
('5048bb5e-4f05-4c1c-89da-50caebc7aa9d', 'App\\Notifications\\AdminNotification', 'App\\Model\\Users\\User', 1, '{\"title\":\"Auction Ends\",\"body\":\"Auction #76 has come to end \",\"link\":\"http:\\/\\/3.8.199.229\\/funding_joint\\/public\\/auctions\\/76\"}', '2021-07-09 18:57:54', '2021-07-09 18:56:06', '2021-07-09 18:57:54'),
('50b89047-4fd0-42c3-b187-354de4731b38', 'App\\Notifications\\UserNotification', 'App\\Model\\Users\\User', 339, '{\"title\":\"Payment Received\",\"body\":\"Admin has confirmed your funds!\",\"link\":\"http:\\/\\/3.8.199.229\\/funding_joint\\/public\\/account\"}', '2021-07-05 04:46:00', '2021-07-05 04:44:17', '2021-07-05 04:46:00'),
('50cad2a0-2996-408d-b6b6-6b6f652923bd', 'App\\Notifications\\UserNotification', 'App\\Model\\Users\\User', 338, '{\"title\":\"Registration Approval\",\"body\":\"You have been approved by the Admin\",\"link\":\"\"}', '2021-06-21 15:50:04', '2021-06-08 17:57:17', '2021-06-21 15:50:04'),
('50db1a23-e951-4370-b5af-3dc9627659a3', 'App\\Notifications\\UserNotification', 'App\\Model\\Users\\User', 347, '{\"title\":\"Payment Received\",\"body\":\"Admin has confirmed your funds!\",\"link\":\"http:\\/\\/3.8.199.229\\/funding_joint_20210622\\/public\\/account\"}', '2021-06-26 00:39:09', '2021-06-26 00:00:50', '2021-06-26 00:39:09'),
('50eb3cac-1c86-4361-8d73-9577f301bdbd', 'App\\Notifications\\UserNotification', 'App\\Model\\Users\\User', 339, '{\"title\":\"Bid rejected\",\"body\":\"Your Bid for auction #51 is rejected. \",\"link\":\"http:\\/\\/localhost\\/Join_Funding\\/funding_joint_28_05_21\\/public\\/auctions\\/51\"}', '2021-06-08 18:28:41', '2021-06-08 18:15:37', '2021-06-08 18:28:41'),
('5187f2b1-f015-4fef-a118-1980746ba689', 'App\\Notifications\\UserNotification', 'App\\Model\\Users\\User', 338, '{\"title\":\"Your auction received a bid\",\"body\":\"Your auction ( none ) has received a bid\",\"link\":\"http:\\/\\/localhost\\/Join_Funding\\/funding_joint_28_05_21\\/public\\/auctions\\/51\"}', '2021-06-21 15:46:46', '2021-06-08 18:13:17', '2021-06-21 15:46:46'),
('5253ec3a-2931-4179-b049-cad50e5dab08', 'App\\Notifications\\UserNotification', 'App\\Model\\Users\\User', 345, '{\"title\":\"Registration Approval\",\"body\":\"You have been approved by the Admin\",\"link\":\"\"}', NULL, '2021-06-21 13:56:45', '2021-06-21 13:56:45'),
('52616765-04e1-47de-af9e-c0899620eeee', 'App\\Notifications\\UserNotification', 'App\\Model\\Users\\User', 340, '{\"title\":\"Your auction received a bid\",\"body\":\"Your auction ( nmgfdhg ) has received a bid\",\"link\":\"http:\\/\\/3.8.199.229\\/funding_joint\\/public\\/auctions\\/86\"}', '2021-07-26 13:15:36', '2021-07-19 16:09:59', '2021-07-26 13:15:36'),
('52a17518-2e7c-4b17-b08a-5d4e6f6fc545', 'App\\Notifications\\AdminNotification', 'App\\Model\\Users\\User', 1, '{\"title\":\"Auction Created\",\"body\":\"khalid khan created an auction for sds\",\"link\":\"http:\\/\\/3.8.199.229\\/funding_joint_20210622\\/public\\/auctions?id=57\"}', '2021-06-28 13:06:28', '2021-06-28 12:58:31', '2021-06-28 13:06:28'),
('539e1c2a-0fe3-4fff-95a7-221732465583', 'App\\Notifications\\UserNotification', 'App\\Model\\Users\\User', 340, '{\"title\":\"Your auction received a bid\",\"body\":\"Your auction ( nmgfdhg ) has received a bid\",\"link\":\"http:\\/\\/3.8.199.229\\/funding_joint\\/public\\/auctions\\/89\"}', '2021-07-26 13:15:36', '2021-07-20 16:09:21', '2021-07-26 13:15:36'),
('53ad9dc6-e2e4-4305-b05c-037dd77a3dcc', 'App\\Notifications\\UserNotification', 'App\\Model\\Users\\User', 346, '{\"title\":\"Your auction has come to end\",\"body\":\"Your auction #76 has come to end, please upload the invoice by 10\\/07\\/2021\",\"link\":\"http:\\/\\/3.8.199.229\\/funding_joint\\/public\\/auctions\\/76\"}', '2021-07-09 18:59:55', '2021-07-09 18:56:06', '2021-07-09 18:59:55'),
('53ce2190-15c8-4f32-a08b-cc52f1cf85ee', 'App\\Notifications\\UserNotification', 'App\\Model\\Users\\User', 339, '{\"title\":\"Bid rejected\",\"body\":\"Your Bid for auction #51 is rejected. \",\"link\":\"http:\\/\\/localhost\\/Join_Funding\\/funding_joint_28_05_21\\/public\\/auctions\\/51\"}', '2021-06-08 18:28:41', '2021-06-08 18:15:37', '2021-06-08 18:28:41'),
('549655c0-7378-4f90-a263-f6f1dd51afe5', 'App\\Notifications\\UserNotification', 'App\\Model\\Users\\User', 339, '{\"title\":\"Payment Received\",\"body\":\"Admin has confirmed your funds!\",\"link\":\"http:\\/\\/3.8.199.229\\/funding_joint\\/public\\/account\"}', '2021-07-05 04:46:00', '2021-06-30 12:59:38', '2021-07-05 04:46:00'),
('54f4a29f-f732-4bf4-a757-4ea6c4c4d628', 'App\\Notifications\\UserNotification', 'App\\Model\\Users\\User', 346, '{\"title\":\"Buyer Approved\",\"body\":\"Admin has approved sds ( 27 )\",\"link\":\"http:\\/\\/3.8.199.229\\/funding_joint\\/public\\/buyers\\/show\\/27\"}', '2021-07-05 05:05:09', '2021-07-05 04:51:18', '2021-07-05 05:05:09'),
('550f928f-8f6f-4be8-a7d7-7aed083f42e9', 'App\\Notifications\\UserNotification', 'App\\Model\\Users\\User', 340, '{\"title\":\"Your auction received a bid\",\"body\":\"Your auction ( nmgfdhg ) has received a bid\",\"link\":\"http:\\/\\/18.170.35.138\\/funding_joint\\/public\\/auctions\\/96\"}', '2021-07-29 11:22:37', '2021-07-26 23:28:46', '2021-07-29 11:22:37'),
('554eb4d8-5ea5-4f7c-8c11-f14ad612ac03', 'App\\Notifications\\UserNotification', 'App\\Model\\Users\\User', 340, '{\"title\":\"Your auction received a bid\",\"body\":\"Your auction ( nmgfdhg ) has received a bid\",\"link\":\"http:\\/\\/3.8.199.229\\/funding_joint\\/public\\/auctions\\/89\"}', '2021-07-26 13:14:00', '2021-07-20 16:26:29', '2021-07-26 13:14:00'),
('55b88037-7304-4fc0-ab67-f997117a7ddf', 'App\\Notifications\\UserNotification', 'App\\Model\\Users\\User', 338, '{\"title\":\"Your auction received a bid\",\"body\":\"Your auction ( none ) has received a bid\",\"link\":\"http:\\/\\/localhost\\/Join_Funding\\/funding_joint_28_05_21\\/public\\/auctions\\/51\"}', '2021-06-21 15:50:04', '2021-06-08 18:04:11', '2021-06-21 15:50:04'),
('569614f7-2615-4089-8573-4faee7b76e7e', 'App\\Notifications\\UserNotification', 'App\\Model\\Users\\User', 340, '{\"title\":\"Your auction received a bid\",\"body\":\"Your auction ( nmgfdhg ) has received a bid\",\"link\":\"http:\\/\\/3.8.199.229\\/funding_joint\\/public\\/auctions\\/70\"}', '2021-07-09 19:17:07', '2021-07-07 15:56:34', '2021-07-09 19:17:07'),
('56c57013-ea0f-4c00-9d0e-af845a5d8037', 'App\\Notifications\\UserNotification', 'App\\Model\\Users\\User', 347, '{\"title\":\"Payment Received\",\"body\":\"Admin has confirmed your funds!\",\"link\":\"http:\\/\\/3.8.199.229\\/funding_joint_20210622\\/public\\/account\"}', '2021-06-30 11:47:41', '2021-06-29 15:35:15', '2021-06-30 11:47:41'),
('573945ef-3962-41e5-a74e-f682a1262634', 'App\\Notifications\\AdminNotification', 'App\\Model\\Users\\User', 1, '{\"title\":\"User Added Funds\",\"body\":\"Investor- 34279@iqraisb.edu.pk added funds, review and confirm\",\"link\":\"http:\\/\\/3.8.199.229\\/funding_joint\\/public\\/transactions?id=294\"}', '2021-07-05 04:43:58', '2021-07-05 04:43:15', '2021-07-05 04:43:58'),
('5775fc11-1732-4370-842a-84b082e3177f', 'App\\Notifications\\UserNotification', 'App\\Model\\Users\\User', 347, '{\"title\":\"Payment Received\",\"body\":\"Admin has confirmed your funds!\",\"link\":\"http:\\/\\/3.8.199.229\\/funding_joint\\/public\\/account\"}', '2021-07-05 15:20:00', '2021-07-02 16:07:04', '2021-07-05 15:20:00'),
('58be1575-58fa-453f-8c32-dc9ce554ba0f', 'App\\Notifications\\UserNotification', 'App\\Model\\Users\\User', 340, '{\"title\":\"Your auction received a bid\",\"body\":\"Your auction ( nmgfdhg ) has received a bid\",\"link\":\"http:\\/\\/3.8.199.229\\/funding_joint_20210622\\/public\\/auctions\\/61\"}', '2021-06-30 11:31:35', '2021-06-29 15:37:26', '2021-06-30 11:31:35'),
('593c385e-ed11-44e2-8bbd-d1c43203ce29', 'App\\Notifications\\AdminNotification', 'App\\Model\\Users\\User', 1, '{\"title\":\"User Withdraws Funds\",\"body\":\"Investor- 34279@iqraisb.edu.pk Requested to withdraw funds, review and confirm\",\"link\":\"http:\\/\\/18.170.35.138\\/funding_joint\\/public\\/transactions?id=406\"}', '2021-07-28 15:18:10', '2021-07-28 01:56:14', '2021-07-28 15:18:10'),
('5c90cb0d-4120-4853-b7b1-145cf836e297', 'App\\Notifications\\UserNotification', 'App\\Model\\Users\\User', 339, '{\"title\":\"Bid rejected\",\"body\":\"Your Bid for auction #51 is rejected. \",\"link\":\"http:\\/\\/localhost\\/Join_Funding\\/funding_joint_28_05_21\\/public\\/auctions\\/51\"}', NULL, '2021-06-08 18:15:36', '2021-06-08 18:15:36'),
('5c9cffde-06e3-405b-9a81-a3cc27cfbdf0', 'App\\Notifications\\UserNotification', 'App\\Model\\Users\\User', 346, '{\"title\":\"Registration Approval\",\"body\":\"You have been approved by the Admin\",\"link\":\"\"}', '2021-06-29 04:05:40', '2021-06-24 12:02:33', '2021-06-29 04:05:40'),
('5d95ec04-2f6b-4870-b27c-028ab50d1ccf', 'App\\Notifications\\UserNotification', 'App\\Model\\Users\\User', 340, '{\"title\":\"Your auction received a bid\",\"body\":\"Your auction ( nmgfdhg ) has received a bid\",\"link\":\"http:\\/\\/3.8.199.229\\/funding_joint\\/public\\/auctions\\/84\"}', '2021-07-26 13:15:40', '2021-07-13 17:27:31', '2021-07-26 13:15:40'),
('5ed092be-2e6c-44ee-b95b-94c2de77dc1d', 'App\\Notifications\\UserNotification', 'App\\Model\\Users\\User', 338, '{\"title\":\"Your auction received a bid\",\"body\":\"Your auction ( none ) has received a bid\",\"link\":\"http:\\/\\/localhost\\/Join_Funding\\/funding_joint_28_05_21\\/public\\/auctions\\/51\"}', '2021-06-21 15:50:09', '2021-06-08 18:12:23', '2021-06-21 15:50:09'),
('5ee8a9d1-e997-4fd2-927c-0a0d6876c39f', 'App\\Notifications\\UserNotification', 'App\\Model\\Users\\User', 347, '{\"title\":\"Admin Message\",\"body\":\"You have got message from Admin\",\"link\":\"\"}', '2021-07-29 02:30:25', '2021-07-29 02:29:44', '2021-07-29 02:30:25'),
('5f478418-8018-49b9-beed-ccc17c7f0491', 'App\\Notifications\\AdminNotification', 'App\\Model\\Users\\User', 1, '{\"title\":\"Seller Registered\",\"body\":\"akhan hello registered as a seller. Click to review and approve.\",\"link\":\"http:\\/\\/18.170.35.138\\/funding_joint\\/public\\/users?id=352\"}', '2021-07-28 15:18:10', '2021-07-28 12:02:07', '2021-07-28 15:18:10'),
('5f8dca9a-5179-4888-81bc-bf891d45a75d', 'App\\Notifications\\AdminNotification', 'App\\Model\\Users\\User', 1, '{\"title\":\"Auction Created\",\"body\":\"Fgff Gfgf created an auction for nmgfdhg\",\"link\":\"http:\\/\\/3.8.199.229\\/funding_joint\\/public\\/auctions?id=67\"}', '2021-07-05 04:43:58', '2021-07-05 03:52:29', '2021-07-05 04:43:58'),
('5fe2191b-2998-40fb-872d-7bbb48b9098d', 'App\\Notifications\\AdminNotification', 'App\\Model\\Users\\User', 1, '{\"title\":\"User Added Funds\",\"body\":\"Investor- khalidkhan7408@gmail.com added funds, review and confirm\",\"link\":\"http:\\/\\/3.8.199.229\\/funding_joint_20210622\\/public\\/transactions?id=274\"}', '2021-06-29 15:31:33', '2021-06-29 15:31:25', '2021-06-29 15:31:33'),
('62042f0c-acc0-4b95-b61f-35e4775c394e', 'App\\Notifications\\AdminNotification', 'App\\Model\\Users\\User', 1, '{\"title\":\"User Added Funds\",\"body\":\"Investor- khalidkhan7408@gmail.com added funds, review and confirm\",\"link\":\"http:\\/\\/3.8.199.229\\/funding_joint_20210622\\/public\\/transactions?id=260\"}', '2021-06-25 23:54:30', '2021-06-25 23:54:12', '2021-06-25 23:54:30'),
('62ac8cb8-0ed9-49ae-a996-e58d386de06a', 'App\\Notifications\\UserNotification', 'App\\Model\\Users\\User', 339, '{\"title\":\"Bid rejected\",\"body\":\"Your Bid for auction #51 is rejected. \",\"link\":\"http:\\/\\/localhost\\/Join_Funding\\/funding_joint_28_05_21\\/public\\/auctions\\/51\"}', NULL, '2021-06-08 18:15:36', '2021-06-08 18:15:36'),
('62d9cfe9-b9df-471d-a040-a994827d82ca', 'App\\Notifications\\UserNotification', 'App\\Model\\Users\\User', 351, '{\"title\":\"Payment Received\",\"body\":\"Admin has confirmed your funds!\",\"link\":\"http:\\/\\/18.170.35.138\\/funding_joint\\/public\\/account\"}', NULL, '2021-07-26 16:34:42', '2021-07-26 16:34:42'),
('63a08aec-9e73-48c8-84d2-5ca25fdb8baa', 'App\\Notifications\\UserNotification', 'App\\Model\\Users\\User', 340, '{\"title\":\"Auction Approved\",\"body\":\"Your Auction #81 has been approved by the admin!\",\"link\":\"http:\\/\\/3.8.199.229\\/funding_joint\\/public\\/auctions\\/81\"}', '2021-07-13 17:14:35', '2021-07-12 09:06:41', '2021-07-13 17:14:35'),
('6709c979-fb64-4084-b41c-ee156742919f', 'App\\Notifications\\UserNotification', 'App\\Model\\Users\\User', 338, '{\"title\":\"Your auction received a bid\",\"body\":\"Your auction ( none ) has received a bid\",\"link\":\"http:\\/\\/localhost\\/Join_Funding\\/funding_joint_28_05_21\\/public\\/auctions\\/51\"}', '2021-06-21 15:50:04', '2021-06-08 18:05:36', '2021-06-21 15:50:04'),
('670fe526-888f-4c90-9a6a-b57176a7465f', 'App\\Notifications\\UserNotification', 'App\\Model\\Users\\User', 340, '{\"title\":\"Registration Approval\",\"body\":\"You have been approved by the Admin\",\"link\":\"\"}', '2021-06-24 12:13:17', '2021-06-23 18:37:50', '2021-06-24 12:13:17'),
('6ae6c996-2703-4d8f-be91-f7e396f9a971', 'App\\Notifications\\UserNotification', 'App\\Model\\Users\\User', 338, '{\"title\":\"Your auction received a bid\",\"body\":\"Your auction ( none ) has received a bid\",\"link\":\"http:\\/\\/localhost\\/Join_Funding\\/funding_joint_28_05_21\\/public\\/auctions\\/51\"}', '2021-06-21 15:46:46', '2021-06-08 18:13:01', '2021-06-21 15:46:46'),
('6c2768ba-eb3a-4c81-be94-919584f8fed3', 'App\\Notifications\\UserNotification', 'App\\Model\\Users\\User', 347, '{\"title\":\"Payment Received\",\"body\":\"Admin has confirmed your funds!\",\"link\":\"http:\\/\\/3.8.199.229\\/funding_joint\\/public\\/account\"}', '2021-07-29 02:30:25', '2021-07-14 16:24:32', '2021-07-29 02:30:25'),
('6d5b3736-c5d4-4244-93a8-4ce26d7946cb', 'App\\Notifications\\AdminNotification', 'App\\Model\\Users\\User', 1, '{\"title\":\"User Added Funds\",\"body\":\"Investor- 34279@iqraisb.edu.pk added funds, review and confirm\",\"link\":\"http:\\/\\/3.8.199.229\\/funding_joint\\/public\\/transactions?id=281\"}', '2021-06-30 12:58:50', '2021-06-30 12:57:49', '2021-06-30 12:58:50');
INSERT INTO `notifications` (`id`, `type`, `notifiable_type`, `notifiable_id`, `data`, `read_at`, `created_at`, `updated_at`) VALUES
('6db07d25-9bb0-4b56-8e02-55b0b40c58f4', 'App\\Notifications\\UserNotification', 'App\\Model\\Users\\User', 340, '{\"title\":\"Your auction received a bid\",\"body\":\"Your auction ( nmgfdhg ) has received a bid\",\"link\":\"http:\\/\\/3.8.199.229\\/funding_joint\\/public\\/auctions\\/92\"}', '2021-07-26 12:28:51', '2021-07-23 00:02:58', '2021-07-26 12:28:51'),
('6f449a68-0a19-4323-b2db-3bb81031c690', 'App\\Notifications\\UserNotification', 'App\\Model\\Users\\User', 346, '{\"title\":\"Payment Received\",\"body\":\"Admin has released your funds!\",\"link\":\"http:\\/\\/3.8.199.229\\/funding_joint\\/public\\/account\"}', '2021-07-05 05:05:09', '2021-07-05 03:46:01', '2021-07-05 05:05:09'),
('6fddbaf9-88db-43dd-82f4-756ec8963597', 'App\\Notifications\\AdminNotification', 'App\\Model\\Users\\User', 1, '{\"title\":\"Buyer Created\",\"body\":\"seller faslkj has registered a buyer :  SM technologies ( 20 )\",\"link\":\"http:\\/\\/18.132.204.246\\/funding_joint_20210620\\/public\\/buyers\"}', '2021-06-23 12:25:41', '2021-06-23 09:45:59', '2021-06-23 12:25:41'),
('6fe73704-a0fd-4af0-984f-16c2b607457c', 'App\\Notifications\\UserNotification', 'App\\Model\\Users\\User', 338, '{\"title\":\"Your auction received a bid\",\"body\":\"Your auction ( none ) has received a bid\",\"link\":\"http:\\/\\/18.132.204.246\\/funding_joint_20210622\\/public\\/auctions\\/53\"}', '2021-06-24 16:23:42', '2021-06-24 11:35:02', '2021-06-24 16:23:42'),
('7245e543-7556-4101-96b5-71fac93f7a4f', 'App\\Notifications\\AdminNotification', 'App\\Model\\Users\\User', 1, '{\"title\":\"Auction Created\",\"body\":\"khalid khan created an auction for shahzeb\",\"link\":\"http:\\/\\/3.8.199.229\\/funding_joint\\/public\\/auctions?id=82\"}', '2021-07-12 08:30:44', '2021-07-09 20:04:13', '2021-07-12 08:30:44'),
('728b9ba6-f0ea-4769-8d23-3824302ef0e7', 'App\\Notifications\\AdminNotification', 'App\\Model\\Users\\User', 1, '{\"title\":\"User Added Funds\",\"body\":\"Investor- khalidkhan7408@gmail.com added funds, review and confirm\",\"link\":\"http:\\/\\/3.8.199.229\\/funding_joint_20210622\\/public\\/transactions?id=261\"}', '2021-06-27 09:09:49', '2021-06-26 00:00:39', '2021-06-27 09:09:49'),
('729d1481-1a55-4d8a-9b33-a007abdfcf5a', 'App\\Notifications\\AdminNotification', 'App\\Model\\Users\\User', 1, '{\"title\":\"Buyer Created\",\"body\":\"seller faslkj has registered a buyer :  Shahzeb Company ( 21 )\",\"link\":\"http:\\/\\/18.132.204.246\\/funding_joint_20210622\\/public\\/buyers\"}', '2021-06-24 17:47:29', '2021-06-24 17:46:18', '2021-06-24 17:47:29'),
('7374e597-2f9c-45ac-bd04-12d566e446b5', 'App\\Notifications\\UserNotification', 'App\\Model\\Users\\User', 339, '{\"title\":\"Bid Partially Accepted\",\"body\":\"Your Bid for auction #51 is Partially Accepted. \",\"link\":\"http:\\/\\/localhost\\/Join_Funding\\/funding_joint_28_05_21\\/public\\/auctions\\/51\"}', NULL, '2021-06-08 18:15:36', '2021-06-08 18:15:36'),
('73ed8fdf-46cc-4ac6-9cfa-1964f4db64e2', 'App\\Notifications\\UserNotification', 'App\\Model\\Users\\User', 340, '{\"title\":\"Auction Approved\",\"body\":\"Your Auction #94 has been approved by the admin!\",\"link\":\"http:\\/\\/18.170.35.138\\/funding_joint\\/public\\/auctions\\/94\"}', '2021-07-29 11:22:37', '2021-07-26 23:21:00', '2021-07-29 11:22:37'),
('7409fe02-f0d4-407c-a4df-043fb673cb3d', 'App\\Notifications\\UserNotification', 'App\\Model\\Users\\User', 340, '{\"title\":\"Your auction received a bid\",\"body\":\"Your auction ( nmgfdhg ) has received a bid\",\"link\":\"http:\\/\\/3.8.199.229\\/funding_joint\\/public\\/auctions\\/66\"}', '2021-07-05 02:26:24', '2021-06-30 13:12:13', '2021-07-05 02:26:24'),
('7473d057-53ca-4022-8562-3b52c6e054f6', 'App\\Notifications\\UserNotification', 'App\\Model\\Users\\User', 346, '{\"title\":\"Registration Rejected\",\"body\":\"You have been rejected by the Admin\",\"link\":\"\"}', '2021-06-29 04:05:40', '2021-06-24 12:02:02', '2021-06-29 04:05:40'),
('74a80a0a-725c-45e3-9fdf-92ddd81ab2bb', 'App\\Notifications\\AdminNotification', 'App\\Model\\Users\\User', 1, '{\"title\":\"Buyer Created\",\"body\":\"Fgff Gfgf has registered a buyer :  nmgfdhg ( 25 )\",\"link\":\"http:\\/\\/3.8.199.229\\/funding_joint\\/public\\/buyers\"}', '2021-07-05 04:43:58', '2021-07-05 03:50:18', '2021-07-05 04:43:58'),
('74ad6788-a0df-4ce3-9a4f-b56ef95043e3', 'App\\Notifications\\UserNotification', 'App\\Model\\Users\\User', 340, '{\"title\":\"Your auction received a bid\",\"body\":\"Your auction ( nmgfdhg ) has received a bid\",\"link\":\"http:\\/\\/3.8.199.229\\/funding_joint\\/public\\/auctions\\/87\"}', '2021-07-26 13:13:52', '2021-07-21 12:45:48', '2021-07-26 13:13:52'),
('753fa7cc-65a8-4171-a038-b97cad6b0934', 'App\\Notifications\\UserNotification', 'App\\Model\\Users\\User', 338, '{\"title\":\"Your auction received a bid\",\"body\":\"Your auction ( none ) has received a bid\",\"link\":\"http:\\/\\/localhost\\/Join_Funding\\/funding_joint_28_05_21\\/public\\/auctions\\/51\"}', '2021-06-21 15:46:46', '2021-06-08 18:13:38', '2021-06-21 15:46:46'),
('7589482d-5014-48cc-b609-2707f8884d95', 'App\\Notifications\\UserNotification', 'App\\Model\\Users\\User', 345, '{\"title\":\"Registration Approval\",\"body\":\"You have been approved by the Admin\",\"link\":\"\"}', NULL, '2021-06-22 12:50:26', '2021-06-22 12:50:26'),
('75b44276-8025-4aaa-a1a6-bbe5dbf9af56', 'App\\Notifications\\UserNotification', 'App\\Model\\Users\\User', 338, '{\"title\":\"Your auction received a bid\",\"body\":\"Your auction ( none ) has received a bid\",\"link\":\"http:\\/\\/localhost\\/Join_Funding\\/funding_joint_28_05_21\\/public\\/auctions\\/51\"}', '2021-06-21 15:46:46', '2021-06-08 18:13:28', '2021-06-21 15:46:46'),
('77a504ea-74af-4fe6-b95f-9edad152bf6c', 'App\\Notifications\\AdminNotification', 'App\\Model\\Users\\User', 1, '{\"title\":\"Seller Registered\",\"body\":\"seller faslkj registered as a seller. Click to review and approve.\",\"link\":\"http:\\/\\/localhost\\/Join_Funding\\/funding_joint_28_05_21\\/public\\/users?id=338\"}', '2021-06-21 13:56:00', '2021-06-08 16:30:49', '2021-06-21 13:56:00'),
('77a996fe-0aa0-462c-973d-d9c60349aa43', 'App\\Notifications\\UserNotification', 'App\\Model\\Users\\User', 340, '{\"title\":\"Your auction received a bid\",\"body\":\"Your auction ( nmgfdhg ) has received a bid\",\"link\":\"http:\\/\\/18.170.35.138\\/funding_joint\\/public\\/auctions\\/91\"}', NULL, '2021-07-26 21:25:02', '2021-07-26 21:25:02'),
('77b7769a-5e21-4a84-85ae-5cb2e0a63419', 'App\\Notifications\\AdminNotification', 'App\\Model\\Users\\User', 1, '{\"title\":\"Auction Created\",\"body\":\"khalid khan created an auction for sds\",\"link\":\"http:\\/\\/3.8.199.229\\/funding_joint\\/public\\/auctions?id=89\"}', '2021-07-21 12:35:24', '2021-07-20 15:16:45', '2021-07-21 12:35:24'),
('77c882cb-8da5-42ff-8b13-56ff2a4fb931', 'App\\Notifications\\UserNotification', 'App\\Model\\Users\\User', 340, '{\"title\":\"Your auction received a bid\",\"body\":\"Your auction ( nmgfdhg ) has received a bid\",\"link\":\"http:\\/\\/3.8.199.229\\/funding_joint_20210622\\/public\\/auctions\\/61\"}', '2021-06-30 11:31:35', '2021-06-29 15:37:37', '2021-06-30 11:31:35'),
('78eeee70-337f-4b27-a957-bf6d62ddd8b3', 'App\\Notifications\\UserNotification', 'App\\Model\\Users\\User', 338, '{\"title\":\"Your auction received a bid\",\"body\":\"Your auction ( none ) has received a bid\",\"link\":\"http:\\/\\/localhost\\/Join_Funding\\/funding_joint_28_05_21\\/public\\/auctions\\/51\"}', '2021-06-21 15:46:46', '2021-06-08 18:14:06', '2021-06-21 15:46:46'),
('798d2294-9ffb-45b5-97e9-3d01355ae899', 'App\\Notifications\\UserNotification', 'App\\Model\\Users\\User', 340, '{\"title\":\"Your auction received a bid\",\"body\":\"Your auction ( nmgfdhg ) has received a bid\",\"link\":\"http:\\/\\/18.170.35.138\\/funding_joint\\/public\\/auctions\\/96\"}', '2021-07-29 11:22:37', '2021-07-28 01:52:03', '2021-07-29 11:22:37'),
('79af615c-251e-4069-a7c4-c8039c3f65be', 'App\\Notifications\\UserNotification', 'App\\Model\\Users\\User', 338, '{\"title\":\"Auction Approved\",\"body\":\"Your Auction #52 has been approved by the admin!\",\"link\":\"http:\\/\\/localhost\\/Join_Funding\\/funding_joint_28_05_21\\/public\\/auctions\\/52\"}', '2021-06-21 15:46:46', '2021-06-09 04:51:08', '2021-06-21 15:46:46'),
('7a0f41ab-901b-4d3d-bd6c-0cdc812fd81c', 'App\\Notifications\\AdminNotification', 'App\\Model\\Users\\User', 1, '{\"title\":\"User Withdraws Funds\",\"body\":\"Investor- mostwantedpreston@gmail.com Requested to withdraw funds, review and confirm\",\"link\":\"http:\\/\\/3.8.199.229\\/funding_joint\\/public\\/transactions?id=362\"}', NULL, '2021-07-22 10:36:38', '2021-07-22 10:36:38'),
('7a4b2111-ab96-4ee1-a5a1-699af6e5fc70', 'App\\Notifications\\UserNotification', 'App\\Model\\Users\\User', 340, '{\"title\":\"Your auction received a bid\",\"body\":\"Your auction ( nmgfdhg ) has received a bid\",\"link\":\"http:\\/\\/3.8.199.229\\/funding_joint\\/public\\/auctions\\/88\"}', '2021-07-26 12:28:51', '2021-07-22 17:39:53', '2021-07-26 12:28:51'),
('7a9c9a3b-ec8f-4b9b-870a-8cacc508a31d', 'App\\Notifications\\UserNotification', 'App\\Model\\Users\\User', 340, '{\"title\":\"Your auction received a bid\",\"body\":\"Your auction ( nmgfdhg ) has received a bid\",\"link\":\"http:\\/\\/3.8.199.229\\/funding_joint\\/public\\/auctions\\/77\"}', '2021-07-13 17:14:35', '2021-07-11 15:24:11', '2021-07-13 17:14:35'),
('7cc2b75a-a150-4949-8e34-e8ab2d1386b8', 'App\\Notifications\\UserNotification', 'App\\Model\\Users\\User', 340, '{\"title\":\"Your auction received a bid\",\"body\":\"Your auction ( nmgfdhg ) has received a bid\",\"link\":\"http:\\/\\/3.8.199.229\\/funding_joint\\/public\\/auctions\\/89\"}', '2021-07-26 13:14:00', '2021-07-20 16:16:43', '2021-07-26 13:14:00'),
('7d458ef6-c9d3-4821-b09f-bcbcb4206617', 'App\\Notifications\\AdminNotification', 'App\\Model\\Users\\User', 1, '{\"title\":\"User Added Funds\",\"body\":\"Investor- 34279@iqraisb.edu.pk added funds, review and confirm\",\"link\":\"http:\\/\\/3.8.199.229\\/funding_joint\\/public\\/transactions?id=322\"}', '2021-07-13 12:03:08', '2021-07-13 12:01:10', '2021-07-13 12:03:08'),
('7df8efac-74c5-4521-935b-5a3b379bfba8', 'App\\Notifications\\UserNotification', 'App\\Model\\Users\\User', 340, '{\"title\":\"Your auction received a bid\",\"body\":\"Your auction ( nmgfdhg ) has received a bid\",\"link\":\"http:\\/\\/3.8.199.229\\/funding_joint\\/public\\/auctions\\/86\"}', '2021-07-26 12:28:51', '2021-07-22 23:24:55', '2021-07-26 12:28:51'),
('8100bae6-eafb-4bac-bd8e-71e075cdc72d', 'App\\Notifications\\UserNotification', 'App\\Model\\Users\\User', 347, '{\"title\":\"Payment Received\",\"body\":\"Admin has confirmed your funds!\",\"link\":\"http:\\/\\/3.8.199.229\\/funding_joint\\/public\\/account\"}', '2021-07-29 02:30:25', '2021-07-22 14:09:35', '2021-07-29 02:30:25'),
('8395f40a-d416-44d2-87fd-ee7e1b23dc15', 'App\\Notifications\\UserNotification', 'App\\Model\\Users\\User', 338, '{\"title\":\"Your auction received a bid\",\"body\":\"Your auction ( none ) has received a bid\",\"link\":\"http:\\/\\/3.8.199.229\\/funding_joint_20210622\\/public\\/auctions\\/53\"}', NULL, '2021-06-26 00:31:14', '2021-06-26 00:31:14'),
('83bec58a-0cc7-4b29-a225-21c32f776aa3', 'App\\Notifications\\UserNotification', 'App\\Model\\Users\\User', 340, '{\"title\":\"Your auction received a bid\",\"body\":\"Your auction ( nmgfdhg ) has received a bid\",\"link\":\"http:\\/\\/3.8.199.229\\/funding_joint_20210622\\/public\\/auctions\\/61\"}', '2021-06-30 11:31:35', '2021-06-29 15:39:56', '2021-06-30 11:31:35'),
('84e9ad55-2dd3-4fae-bae5-87018497775e', 'App\\Notifications\\UserNotification', 'App\\Model\\Users\\User', 340, '{\"title\":\"Your auction received a bid\",\"body\":\"Your auction ( nmgfdhg ) has received a bid\",\"link\":\"http:\\/\\/18.170.35.138\\/funding_joint\\/public\\/auctions\\/96\"}', '2021-07-29 11:22:37', '2021-07-26 23:20:10', '2021-07-29 11:22:37'),
('85962d2e-ae9e-4b92-bb52-2ef26597b7ce', 'App\\Notifications\\AdminNotification', 'App\\Model\\Users\\User', 1, '{\"title\":\"User Added Funds\",\"body\":\"Investor- mostwantedpreston@gmail.com added funds, review and confirm\",\"link\":\"http:\\/\\/3.8.199.229\\/funding_joint\\/public\\/transactions?id=365\"}', NULL, '2021-07-22 12:17:42', '2021-07-22 12:17:42'),
('85ce7e96-060e-48e2-8bbf-0cd0039402d3', 'App\\Notifications\\UserNotification', 'App\\Model\\Users\\User', 338, '{\"title\":\"Auction Approved\",\"body\":\"Your Auction #51 has been approved by the admin!\",\"link\":\"http:\\/\\/localhost\\/Join_Funding\\/funding_joint_28_05_21\\/public\\/auctions\\/51\"}', '2021-06-21 15:50:04', '2021-06-08 17:51:29', '2021-06-21 15:50:04'),
('860a9bcc-4d74-4e5b-9446-f6a2f73d47a9', 'App\\Notifications\\UserNotification', 'App\\Model\\Users\\User', 340, '{\"title\":\"Your auction received a bid\",\"body\":\"Your auction ( nmgfdhg ) has received a bid\",\"link\":\"http:\\/\\/18.170.35.138\\/funding_joint\\/public\\/auctions\\/95\"}', '2021-07-29 11:22:37', '2021-07-28 02:02:06', '2021-07-29 11:22:37'),
('875d0fcc-1baa-4ad7-a5d2-eef8047241ef', 'App\\Notifications\\AdminNotification', 'App\\Model\\Users\\User', 1, '{\"title\":\"Buyer Created\",\"body\":\"khalid khan has registered a buyer :  SM technologies ( 23 )\",\"link\":\"http:\\/\\/18.132.204.246\\/funding_joint_20210622\\/public\\/buyers\"}', '2021-06-25 12:32:45', '2021-06-25 12:31:10', '2021-06-25 12:32:45'),
('8842cde9-7fb6-4d2e-8769-28a82694057f', 'App\\Notifications\\AdminNotification', 'App\\Model\\Users\\User', 1, '{\"title\":\"Investor Registered\",\"body\":\"Invest Alot registered as investor. Click to review and approve.\",\"link\":\"http:\\/\\/3.8.199.229\\/funding_joint_20210622\\/public\\/users?id=347\"}', '2021-06-25 23:54:30', '2021-06-25 23:41:34', '2021-06-25 23:54:30'),
('88e32860-89e9-4bfc-9d6b-156732aa74c9', 'App\\Notifications\\UserNotification', 'App\\Model\\Users\\User', 340, '{\"title\":\"Auction Approved\",\"body\":\"Your Auction #62 has been approved by the admin!\",\"link\":\"http:\\/\\/3.8.199.229\\/funding_joint_20210622\\/public\\/auctions\\/62\"}', '2021-06-30 11:31:35', '2021-06-29 15:11:21', '2021-06-30 11:31:35'),
('89789f2e-051f-496c-be32-02ee9bfabd21', 'App\\Notifications\\UserNotification', 'App\\Model\\Users\\User', 340, '{\"title\":\"Your auction received a bid\",\"body\":\"Your auction ( nmgfdhg ) has received a bid\",\"link\":\"http:\\/\\/3.8.199.229\\/funding_joint\\/public\\/auctions\\/81\"}', '2021-07-26 13:15:36', '2021-07-19 10:57:13', '2021-07-26 13:15:36'),
('8c31c670-20e4-4c18-bc45-4d180a363501', 'App\\Notifications\\UserNotification', 'App\\Model\\Users\\User', 340, '{\"title\":\"Your auction received a bid\",\"body\":\"Your auction ( nmgfdhg ) has received a bid\",\"link\":\"http:\\/\\/3.8.199.229\\/funding_joint\\/public\\/auctions\\/88\"}', '2021-07-26 13:13:52', '2021-07-21 12:49:41', '2021-07-26 13:13:52'),
('8c37b02b-16fb-4f25-a495-10ff729dc656', 'App\\Notifications\\UserNotification', 'App\\Model\\Users\\User', 340, '{\"title\":\"Auction Approved\",\"body\":\"Your Auction #91 has been approved by the admin!\",\"link\":\"http:\\/\\/3.8.199.229\\/funding_joint\\/public\\/auctions\\/91\"}', '2021-07-26 12:28:51', '2021-07-22 17:15:03', '2021-07-26 12:28:51'),
('8c680513-6964-49ea-8ea3-60d76579fe03', 'App\\Notifications\\UserNotification', 'App\\Model\\Users\\User', 339, '{\"title\":\"Registration Approval\",\"body\":\"You have been approved by the Admin\",\"link\":\"\"}', '2021-06-08 17:57:33', '2021-06-08 17:57:27', '2021-06-08 17:57:33'),
('8d4a07c0-fb4d-4ac9-a41a-047c52db425c', 'App\\Notifications\\UserNotification', 'App\\Model\\Users\\User', 338, '{\"title\":\"Your auction received a bid\",\"body\":\"Your auction ( none ) has received a bid\",\"link\":\"http:\\/\\/localhost\\/Join_Funding\\/funding_joint_28_05_21\\/public\\/auctions\\/51\"}', '2021-06-21 15:46:46', '2021-06-08 18:14:29', '2021-06-21 15:46:46'),
('8f280ae8-22e0-4161-8345-efe4809fe7d7', 'App\\Notifications\\AdminNotification', 'App\\Model\\Users\\User', 1, '{\"title\":\"Seller Registered\",\"body\":\"khalid khan registered as a seller. Click to review and approve.\",\"link\":\"http:\\/\\/18.132.204.246\\/funding_joint_20210620\\/public\\/users?id=340\"}', '2021-06-21 13:56:00', '2021-06-21 13:45:02', '2021-06-21 13:56:00'),
('9093a0b1-8c32-4329-994e-2c3d372782d6', 'App\\Notifications\\UserNotification', 'App\\Model\\Users\\User', 347, '{\"title\":\"Payment Received\",\"body\":\"Admin has confirmed your funds!\",\"link\":\"http:\\/\\/3.8.199.229\\/funding_joint\\/public\\/account\"}', '2021-07-12 07:33:15', '2021-07-09 19:24:10', '2021-07-12 07:33:15'),
('90c2e9d3-14b4-4256-b98d-1811b5545555', 'App\\Notifications\\UserNotification', 'App\\Model\\Users\\User', 339, '{\"title\":\"Bid Partially Accepted\",\"body\":\"Your Bid for auction #90 is Partially Accepted. \",\"link\":\"http:\\/\\/18.170.35.138\\/funding_joint\\/public\\/auctions\\/90\"}', NULL, '2021-07-29 11:25:14', '2021-07-29 11:25:14'),
('912ad64a-d4da-4ddc-bebe-9014e67529c0', 'App\\Notifications\\UserNotification', 'App\\Model\\Users\\User', 346, '{\"title\":\"Buyer Approved\",\"body\":\"Admin has approved nmgfdhg ( 24 )\",\"link\":\"http:\\/\\/3.8.199.229\\/funding_joint\\/public\\/buyers\\/show\\/24\"}', '2021-07-09 18:59:55', '2021-07-07 07:16:20', '2021-07-09 18:59:55'),
('923d8a19-3833-44a0-81ef-95de4bc93b23', 'App\\Notifications\\UserNotification', 'App\\Model\\Users\\User', 340, '{\"title\":\"Your auction received a bid\",\"body\":\"Your auction ( nmgfdhg ) has received a bid\",\"link\":\"http:\\/\\/3.8.199.229\\/funding_joint\\/public\\/auctions\\/87\"}', '2021-07-26 13:14:00', '2021-07-21 12:40:27', '2021-07-26 13:14:00'),
('92401d43-bfd0-4180-9626-4d8dd3e1ec07', 'App\\Notifications\\UserNotification', 'App\\Model\\Users\\User', 340, '{\"title\":\"Auction Approved\",\"body\":\"Your Auction #82 has been approved by the admin!\",\"link\":\"http:\\/\\/3.8.199.229\\/funding_joint\\/public\\/auctions\\/82\"}', '2021-07-13 17:14:35', '2021-07-12 09:06:21', '2021-07-13 17:14:35'),
('92a4e061-bfa8-42a1-8cfd-424ed3106ccb', 'App\\Notifications\\UserNotification', 'App\\Model\\Users\\User', 340, '{\"title\":\"Auction Approved\",\"body\":\"Your Auction #63 has been approved by the admin!\",\"link\":\"http:\\/\\/3.8.199.229\\/funding_joint_20210622\\/public\\/auctions\\/63\"}', NULL, '2021-06-29 15:10:39', '2021-06-29 15:10:39'),
('94b8521c-ffd5-4610-baa0-a9e11c812907', 'App\\Notifications\\UserNotification', 'App\\Model\\Users\\User', 339, '{\"title\":\"Bid rejected\",\"body\":\"Your Bid for auction #51 is rejected. \",\"link\":\"http:\\/\\/localhost\\/Join_Funding\\/funding_joint_28_05_21\\/public\\/auctions\\/51\"}', '2021-06-08 18:28:42', '2021-06-08 18:15:37', '2021-06-08 18:28:42'),
('94c36894-3b91-4d71-badf-7c2e227d3bec', 'App\\Notifications\\AdminNotification', 'App\\Model\\Users\\User', 1, '{\"title\":\"User Added Funds\",\"body\":\"Investor- khalidkhan7408@gmail.com added funds, review and confirm\",\"link\":\"http:\\/\\/3.8.199.229\\/funding_joint_20210622\\/public\\/transactions?id=275\"}', '2021-06-29 15:34:47', '2021-06-29 15:34:34', '2021-06-29 15:34:47'),
('9625cc78-90f7-411a-8493-c61a7233dd98', 'App\\Notifications\\AdminNotification', 'App\\Model\\Users\\User', 1, '{\"title\":\"Buyer Created\",\"body\":\"seller faslkj has registered a buyer :  xasxas ( 19 )\",\"link\":\"http:\\/\\/localhost\\/Join_Funding\\/funding_joint_28_05_21\\/public\\/buyers\"}', '2021-06-21 13:56:00', '2021-06-08 17:44:35', '2021-06-21 13:56:00'),
('966c9b48-9ddb-4a00-8470-75cf2eaea3ea', 'App\\Notifications\\AdminNotification', 'App\\Model\\Users\\User', 1, '{\"title\":\"Auction Created\",\"body\":\"Fgff Gfgf created an auction for sds\",\"link\":\"http:\\/\\/3.8.199.229\\/funding_joint\\/public\\/auctions?id=69\"}', '2021-07-05 04:50:49', '2021-07-05 04:49:42', '2021-07-05 04:50:49'),
('96d7b343-8b09-4854-b7d8-b0037c8371fc', 'App\\Notifications\\AdminNotification', 'App\\Model\\Users\\User', 1, '{\"title\":\"Auction Created\",\"body\":\"khalid khan created an auction for sds\",\"link\":\"http:\\/\\/3.8.199.229\\/funding_joint\\/public\\/auctions?id=85\"}', '2021-07-13 12:10:09', '2021-07-13 12:07:09', '2021-07-13 12:10:09'),
('96f08422-1d24-41c6-8e96-15e7b7bc9bec', 'App\\Notifications\\UserNotification', 'App\\Model\\Users\\User', 347, '{\"title\":\"Payment Confirmation Declined\",\"body\":\"Admin has declined confirmation of your funds!\",\"link\":\"http:\\/\\/3.8.199.229\\/funding_joint_20210622\\/public\\/account\"}', '2021-06-25 23:55:10', '2021-06-25 23:55:00', '2021-06-25 23:55:10'),
('978ee1ef-962c-4b3c-9226-188ce2b986b7', 'App\\Notifications\\AdminNotification', 'App\\Model\\Users\\User', 1, '{\"title\":\"Auction Created\",\"body\":\"khalid khan created an auction for sds\",\"link\":\"http:\\/\\/3.8.199.229\\/funding_joint\\/public\\/auctions?id=92\"}', NULL, '2021-07-22 17:13:43', '2021-07-22 17:13:43'),
('97a38105-633a-4bac-b7f0-694e624c78af', 'App\\Notifications\\AdminNotification', 'App\\Model\\Users\\User', 1, '{\"title\":\"User Withdraws Funds\",\"body\":\"Investor- 34279@iqraisb.edu.pk Requested to withdraw funds, review and confirm\",\"link\":\"http:\\/\\/3.8.199.229\\/funding_joint\\/public\\/transactions?id=298\"}', '2021-07-05 10:53:39', '2021-07-05 10:51:37', '2021-07-05 10:53:39'),
('97fad280-3da9-452f-aec8-55d16683319c', 'App\\Notifications\\AdminNotification', 'App\\Model\\Users\\User', 1, '{\"title\":\"User Withdraws Funds\",\"body\":\"Investor- mostwantedpreston@gmail.com Requested to withdraw funds, review and confirm\",\"link\":\"http:\\/\\/3.8.199.229\\/funding_joint\\/public\\/transactions?id=361\"}', NULL, '2021-07-22 10:29:50', '2021-07-22 10:29:50'),
('99fea398-ed01-45cb-961c-6543a7ac312e', 'App\\Notifications\\UserNotification', 'App\\Model\\Users\\User', 340, '{\"title\":\"Payment Received\",\"body\":\"Admin has released your funds!\",\"link\":\"http:\\/\\/3.8.199.229\\/funding_joint\\/public\\/account\"}', '2021-07-13 17:14:35', '2021-07-13 12:16:53', '2021-07-13 17:14:35'),
('9b789fb7-40b0-4947-9200-5ffae63acd24', 'App\\Notifications\\AdminNotification', 'App\\Model\\Users\\User', 1, '{\"title\":\"Investor Registered\",\"body\":\"Shahzeb Naseer registered as investor. Click to review and approve.\",\"link\":\"http:\\/\\/18.132.204.246\\/funding_joint_20210620\\/public\\/users?id=345\"}', '2021-06-21 13:56:00', '2021-06-21 12:02:24', '2021-06-21 13:56:00'),
('9bd3c8ce-4ceb-4d06-97a1-4fb2bd057670', 'App\\Notifications\\AdminNotification', 'App\\Model\\Users\\User', 1, '{\"title\":\"User Added Funds\",\"body\":\"Investor- khalidkhan7408@gmail.com added funds, review and confirm\",\"link\":\"http:\\/\\/3.8.199.229\\/funding_joint\\/public\\/transactions?id=316\"}', '2021-07-09 19:23:51', '2021-07-09 19:23:40', '2021-07-09 19:23:51'),
('9cc2c1b4-6a33-472e-9d37-9ff459b25fb1', 'App\\Notifications\\UserNotification', 'App\\Model\\Users\\User', 346, '{\"title\":\"Buyer Approved\",\"body\":\"Admin has approved sds ( 26 )\",\"link\":\"http:\\/\\/3.8.199.229\\/funding_joint\\/public\\/buyers\\/show\\/26\"}', '2021-07-05 05:05:09', '2021-07-05 04:53:26', '2021-07-05 05:05:09'),
('9ceda08a-ee16-4af6-a530-8e58e7b63be5', 'App\\Notifications\\UserNotification', 'App\\Model\\Users\\User', 340, '{\"title\":\"Auction Approved\",\"body\":\"Your Auction #93 has been approved by the admin!\",\"link\":\"http:\\/\\/18.170.35.138\\/funding_joint\\/public\\/auctions\\/93\"}', '2021-07-29 11:22:37', '2021-07-27 07:59:30', '2021-07-29 11:22:37'),
('9d53e308-e175-45a3-8e18-3808e7be4094', 'App\\Notifications\\UserNotification', 'App\\Model\\Users\\User', 338, '{\"title\":\"Your auction received a bid\",\"body\":\"Your auction ( none ) has received a bid\",\"link\":\"http:\\/\\/localhost\\/Join_Funding\\/funding_joint_28_05_21\\/public\\/auctions\\/51\"}', '2021-06-21 15:50:04', '2021-06-08 18:05:00', '2021-06-21 15:50:04'),
('9dc34ffa-7bbf-47ec-b9a7-c5c07f10dbac', 'App\\Notifications\\UserNotification', 'App\\Model\\Users\\User', 339, '{\"title\":\"Payment Received\",\"body\":\"Admin has released your funds!\",\"link\":\"http:\\/\\/18.170.35.138\\/funding_joint\\/public\\/account\"}', NULL, '2021-07-28 02:01:03', '2021-07-28 02:01:03'),
('9e24ac25-fc1c-4d88-a714-71cb30fe8cb4', 'App\\Notifications\\UserNotification', 'App\\Model\\Users\\User', 339, '{\"title\":\"Bid rejected\",\"body\":\"Your Bid for auction #51 is rejected. \",\"link\":\"http:\\/\\/localhost\\/Join_Funding\\/funding_joint_28_05_21\\/public\\/auctions\\/51\"}', '2021-06-08 18:28:42', '2021-06-08 18:15:37', '2021-06-08 18:28:42'),
('9e669231-d67e-46aa-b2ef-a1b4cbc3f3ce', 'App\\Notifications\\UserNotification', 'App\\Model\\Users\\User', 340, '{\"title\":\"Auction Approved\",\"body\":\"Your Auction #86 has been approved by the admin!\",\"link\":\"http:\\/\\/3.8.199.229\\/funding_joint\\/public\\/auctions\\/86\"}', '2021-07-26 13:15:36', '2021-07-19 15:53:05', '2021-07-26 13:15:36'),
('9ed75bf4-7e86-4513-83ab-3ce01c11980c', 'App\\Notifications\\UserNotification', 'App\\Model\\Users\\User', 339, '{\"title\":\"Payment Received\",\"body\":\"Admin has released your funds!\",\"link\":\"http:\\/\\/3.8.199.229\\/funding_joint\\/public\\/account\"}', '2021-07-07 07:12:22', '2021-07-05 10:54:17', '2021-07-07 07:12:22'),
('9ef8b411-35bf-431b-898b-65c9f57343bb', 'App\\Notifications\\UserNotification', 'App\\Model\\Users\\User', 338, '{\"title\":\"Your auction has come to end\",\"body\":\"Your auction #53 has come to end, please upload the invoice by 23\\/06\\/2021\",\"link\":\"http:\\/\\/3.8.199.229\\/funding_joint_20210622\\/public\\/auctions\\/53\"}', NULL, '2021-06-26 00:02:09', '2021-06-26 00:02:09'),
('9efbcc16-ea16-4bf3-8681-906a0d9f33f7', 'App\\Notifications\\UserNotification', 'App\\Model\\Users\\User', 346, '{\"title\":\"Buyer Approved\",\"body\":\"Admin has approved nmgfdhg ( 25 )\",\"link\":\"http:\\/\\/3.8.199.229\\/funding_joint\\/public\\/buyers\\/show\\/25\"}', '2021-07-05 05:05:09', '2021-07-05 04:54:21', '2021-07-05 05:05:09'),
('a0934966-8cf5-4c47-a89c-f4ddd36d3dc1', 'App\\Notifications\\UserNotification', 'App\\Model\\Users\\User', 347, '{\"title\":\"Payment Received\",\"body\":\"Admin has released your funds!\",\"link\":\"http:\\/\\/18.170.35.138\\/funding_joint\\/public\\/account\"}', '2021-07-29 02:30:25', '2021-07-29 02:22:39', '2021-07-29 02:30:25'),
('a0b390c4-8a0e-4e0c-94bb-e1bc59200a2b', 'App\\Notifications\\UserNotification', 'App\\Model\\Users\\User', 340, '{\"title\":\"Your auction received a bid\",\"body\":\"Your auction ( nmgfdhg ) has received a bid\",\"link\":\"http:\\/\\/18.170.35.138\\/funding_joint\\/public\\/auctions\\/96\"}', '2021-07-29 11:22:37', '2021-07-26 23:40:47', '2021-07-29 11:22:37'),
('a0ff9b5f-0989-4be6-be30-1e7d1dd950e5', 'App\\Notifications\\UserNotification', 'App\\Model\\Users\\User', 338, '{\"title\":\"Your auction received a bid\",\"body\":\"Your auction ( none ) has received a bid\",\"link\":\"http:\\/\\/localhost\\/Join_Funding\\/funding_joint_28_05_21\\/public\\/auctions\\/51\"}', '2021-06-21 15:50:04', '2021-06-08 18:05:50', '2021-06-21 15:50:04'),
('a145c1f5-c1e1-43d3-bc3d-e6b7f77ebb59', 'App\\Notifications\\UserNotification', 'App\\Model\\Users\\User', 340, '{\"title\":\"Your auction received a bid\",\"body\":\"Your auction ( nmgfdhg ) has received a bid\",\"link\":\"http:\\/\\/3.8.199.229\\/funding_joint_20210622\\/public\\/auctions\\/61\"}', '2021-06-30 11:31:35', '2021-06-29 15:16:45', '2021-06-30 11:31:35'),
('a1ba3d4a-b437-4378-bf40-5a94fddc07e3', 'App\\Notifications\\UserNotification', 'App\\Model\\Users\\User', 340, '{\"title\":\"Your auction received a bid\",\"body\":\"Your auction ( nmgfdhg ) has received a bid\",\"link\":\"http:\\/\\/18.170.35.138\\/funding_joint\\/public\\/auctions\\/90\"}', NULL, '2021-07-26 22:59:26', '2021-07-26 22:59:26'),
('a35bfd6b-4c74-4bf2-aef6-ca1896867e06', 'App\\Notifications\\UserNotification', 'App\\Model\\Users\\User', 351, '{\"title\":\"Payment Received\",\"body\":\"Admin has released your funds!\",\"link\":\"http:\\/\\/3.8.199.229\\/funding_joint\\/public\\/account\"}', '2021-07-22 12:16:53', '2021-07-22 10:30:01', '2021-07-22 12:16:53'),
('a3c508ab-bfe0-4546-9abc-6f35bb69bf69', 'App\\Notifications\\UserNotification', 'App\\Model\\Users\\User', 351, '{\"title\":\"Payment Received\",\"body\":\"Admin has confirmed your funds!\",\"link\":\"http:\\/\\/18.170.35.138\\/funding_joint\\/public\\/account\"}', NULL, '2021-07-26 16:37:52', '2021-07-26 16:37:52'),
('a4155674-2a89-4f24-a445-8c5f0b60c87a', 'App\\Notifications\\UserNotification', 'App\\Model\\Users\\User', 339, '{\"title\":\"Bid rejected\",\"body\":\"Your Bid for auction #51 is rejected. \",\"link\":\"http:\\/\\/localhost\\/Join_Funding\\/funding_joint_28_05_21\\/public\\/auctions\\/51\"}', NULL, '2021-06-08 18:15:37', '2021-06-08 18:15:37'),
('a4661af4-bb4a-4092-a4e1-4318dbc9996f', 'App\\Notifications\\UserNotification', 'App\\Model\\Users\\User', 346, '{\"title\":\"Auction Approved\",\"body\":\"Your Auction #69 has been approved by the admin!\",\"link\":\"http:\\/\\/3.8.199.229\\/funding_joint\\/public\\/auctions\\/69\"}', '2021-07-05 05:05:09', '2021-07-05 04:51:18', '2021-07-05 05:05:09'),
('a7f67b2d-5b77-4c15-bdcc-a6d2aac2043d', 'App\\Notifications\\UserNotification', 'App\\Model\\Users\\User', 338, '{\"title\":\"Your auction received a bid\",\"body\":\"Your auction ( none ) has received a bid\",\"link\":\"http:\\/\\/localhost\\/Join_Funding\\/funding_joint_28_05_21\\/public\\/auctions\\/51\"}', '2021-06-21 15:50:09', '2021-06-08 18:08:00', '2021-06-21 15:50:09'),
('a9d1a6b1-6595-4866-a5de-9d0a212d3f4b', 'App\\Notifications\\UserNotification', 'App\\Model\\Users\\User', 340, '{\"title\":\"Your auction received a bid\",\"body\":\"Your auction ( nmgfdhg ) has received a bid\",\"link\":\"http:\\/\\/18.170.35.138\\/funding_joint\\/public\\/auctions\\/96\"}', '2021-07-29 11:22:37', '2021-07-26 23:26:10', '2021-07-29 11:22:37'),
('aab98419-482f-4901-966f-73da190e77b5', 'App\\Notifications\\UserNotification', 'App\\Model\\Users\\User', 339, '{\"title\":\"Bid rejected\",\"body\":\"Your Bid for auction #51 is rejected. \",\"link\":\"http:\\/\\/localhost\\/Join_Funding\\/funding_joint_28_05_21\\/public\\/auctions\\/51\"}', NULL, '2021-06-08 18:15:37', '2021-06-08 18:15:37'),
('abc54466-4052-4026-b616-ce5c9d0f3094', 'App\\Notifications\\UserNotification', 'App\\Model\\Users\\User', 346, '{\"title\":\"Your auction received a bid\",\"body\":\"Your auction ( Gfgf ) has received a bid\",\"link\":\"http:\\/\\/3.8.199.229\\/funding_joint\\/public\\/auctions\\/76\"}', '2021-07-09 18:59:55', '2021-07-09 18:56:06', '2021-07-09 18:59:55'),
('af83dd56-06fd-44a2-8128-acbd94686cd1', 'App\\Notifications\\AdminNotification', 'App\\Model\\Users\\User', 1, '{\"title\":\"Investor Registered\",\"body\":\"Fancy Investor registered as investor. Click to review and approve.\",\"link\":\"http:\\/\\/3.8.199.229\\/funding_joint\\/public\\/users?id=351\"}', '2021-07-19 16:34:21', '2021-07-19 16:32:23', '2021-07-19 16:34:21'),
('b118316c-2c23-4b51-a3ad-988dd0e648ea', 'App\\Notifications\\UserNotification', 'App\\Model\\Users\\User', 339, '{\"title\":\"Bid rejected\",\"body\":\"Your Bid for auction #51 is rejected. \",\"link\":\"http:\\/\\/localhost\\/Join_Funding\\/funding_joint_28_05_21\\/public\\/auctions\\/51\"}', NULL, '2021-06-08 18:15:37', '2021-06-08 18:15:37'),
('b159a7f0-d71e-4626-8880-4d23ab51bff5', 'App\\Notifications\\UserNotification', 'App\\Model\\Users\\User', 338, '{\"title\":\"Your auction received a bid\",\"body\":\"Your auction ( none ) has received a bid\",\"link\":\"http:\\/\\/localhost\\/Join_Funding\\/funding_joint_28_05_21\\/public\\/auctions\\/51\"}', '2021-06-21 15:46:46', '2021-06-08 18:15:35', '2021-06-21 15:46:46'),
('b2bbc27d-67eb-48c8-8557-b534c8c17098', 'App\\Notifications\\UserNotification', 'App\\Model\\Users\\User', 338, '{\"title\":\"Your auction received a bid\",\"body\":\"Your auction ( none ) has received a bid\",\"link\":\"http:\\/\\/localhost\\/Join_Funding\\/funding_joint_28_05_21\\/public\\/auctions\\/51\"}', '2021-06-21 15:50:09', '2021-06-08 18:10:34', '2021-06-21 15:50:09'),
('b2dd3393-2800-46c9-96c6-b5e296eec1a8', 'App\\Notifications\\AdminNotification', 'App\\Model\\Users\\User', 1, '{\"title\":\"Auction Created\",\"body\":\"khalid khan created an auction for shahzeb\",\"link\":\"http:\\/\\/3.8.199.229\\/funding_joint\\/public\\/auctions?id=77\"}', '2021-07-09 19:23:51', '2021-07-09 19:19:31', '2021-07-09 19:23:51'),
('b3cb2194-b975-4a94-9ada-97a5fe61c45c', 'App\\Notifications\\UserNotification', 'App\\Model\\Users\\User', 338, '{\"title\":\"Auction Approved\",\"body\":\"Your Auction #53 has been approved by the admin!\",\"link\":\"http:\\/\\/18.132.204.246\\/funding_joint_20210620\\/public\\/auctions\\/53\"}', '2021-06-24 16:23:42', '2021-06-23 12:28:04', '2021-06-24 16:23:42'),
('b3d58adc-7a00-4071-a0f9-d8431513dd18', 'App\\Notifications\\UserNotification', 'App\\Model\\Users\\User', 339, '{\"title\":\"Bid rejected\",\"body\":\"Your Bid for auction #51 is rejected. \",\"link\":\"http:\\/\\/localhost\\/Join_Funding\\/funding_joint_28_05_21\\/public\\/auctions\\/51\"}', NULL, '2021-06-08 18:15:37', '2021-06-08 18:15:37'),
('b43920aa-19a6-429c-b899-ea18650b4f9e', 'App\\Notifications\\UserNotification', 'App\\Model\\Users\\User', 339, '{\"title\":\"Payment Received\",\"body\":\"Admin has released your funds!\",\"link\":\"http:\\/\\/3.8.199.229\\/funding_joint\\/public\\/account\"}', '2021-07-15 10:26:07', '2021-07-12 18:06:03', '2021-07-15 10:26:07'),
('b4f0483a-2a2a-4210-9a2d-8e9cef8d68bb', 'App\\Notifications\\UserNotification', 'App\\Model\\Users\\User', 340, '{\"title\":\"Auction Approved\",\"body\":\"Your Auction #77 has been approved by the admin!\",\"link\":\"http:\\/\\/3.8.199.229\\/funding_joint\\/public\\/auctions\\/77\"}', NULL, '2021-07-09 19:20:57', '2021-07-09 19:20:57'),
('b591d99f-0f90-4a47-a7f0-236c1a1f3117', 'App\\Notifications\\UserNotification', 'App\\Model\\Users\\User', 351, '{\"title\":\"Payment Received\",\"body\":\"Admin has confirmed your funds!\",\"link\":\"http:\\/\\/3.8.199.229\\/funding_joint\\/public\\/account\"}', '2021-07-22 12:16:53', '2021-07-21 12:35:28', '2021-07-22 12:16:53'),
('b6aa9cd2-7704-4f88-a29c-41d20343ddd2', 'App\\Notifications\\UserNotification', 'App\\Model\\Users\\User', 347, '{\"title\":\"Registration Approval\",\"body\":\"You have been approved by the Admin\",\"link\":\"\"}', '2021-07-09 15:30:23', '2021-07-05 16:25:25', '2021-07-09 15:30:23'),
('b746dfa2-e1d1-4229-af64-2d4560de4420', 'App\\Notifications\\AdminNotification', 'App\\Model\\Users\\User', 1, '{\"title\":\"User Added Funds\",\"body\":\"Investor- khalidkhan7408@gmail.com added funds, review and confirm\",\"link\":\"http:\\/\\/3.8.199.229\\/funding_joint_20210622\\/public\\/transactions?id=279\"}', '2021-06-30 11:34:47', '2021-06-29 15:41:06', '2021-06-30 11:34:47'),
('b89e5967-42b1-40c6-bd64-8e55cdaa7017', 'App\\Notifications\\AdminNotification', 'App\\Model\\Users\\User', 1, '{\"title\":\"Auction Created\",\"body\":\"khalid khan created an auction for kjgfhjg\",\"link\":\"http:\\/\\/3.8.199.229\\/funding_joint_20210622\\/public\\/auctions?id=58\"}', '2021-06-28 14:47:00', '2021-06-28 14:22:20', '2021-06-28 14:47:00'),
('b9c34c7c-402a-4c28-afef-348e7cdfdb2e', 'App\\Notifications\\UserNotification', 'App\\Model\\Users\\User', 340, '{\"title\":\"Your auction received a bid\",\"body\":\"Your auction ( nmgfdhg ) has received a bid\",\"link\":\"http:\\/\\/3.8.199.229\\/funding_joint\\/public\\/auctions\\/70\"}', '2021-07-09 19:17:07', '2021-07-07 16:13:58', '2021-07-09 19:17:07'),
('ba62441c-3b76-4eb2-a6b0-d30a14bf4957', 'App\\Notifications\\UserNotification', 'App\\Model\\Users\\User', 339, '{\"title\":\"Payment Received\",\"body\":\"Admin has confirmed your funds!\",\"link\":\"http:\\/\\/18.132.204.246\\/funding_joint_20210620\\/public\\/account\"}', '2021-06-23 13:51:32', '2021-06-23 12:25:52', '2021-06-23 13:51:32'),
('babbda9d-09a9-4b0b-88c2-5047ec48d052', 'App\\Notifications\\UserNotification', 'App\\Model\\Users\\User', 340, '{\"title\":\"Your auction received a bid\",\"body\":\"Your auction ( nmgfdhg ) has received a bid\",\"link\":\"http:\\/\\/3.8.199.229\\/funding_joint\\/public\\/auctions\\/89\"}', '2021-07-26 13:14:00', '2021-07-20 16:18:04', '2021-07-26 13:14:00'),
('bba325fd-e64f-4758-ab22-213032f50c06', 'App\\Notifications\\UserNotification', 'App\\Model\\Users\\User', 340, '{\"title\":\"Auction Approved\",\"body\":\"Your Auction #83 has been approved by the admin!\",\"link\":\"http:\\/\\/3.8.199.229\\/funding_joint\\/public\\/auctions\\/83\"}', '2021-07-13 17:14:35', '2021-07-12 09:05:57', '2021-07-13 17:14:35'),
('bba63f01-be22-418a-9d9a-83bd02c65006', 'App\\Notifications\\AdminNotification', 'App\\Model\\Users\\User', 1, '{\"title\":\"Buyer Created\",\"body\":\"Fgff Gfgf has registered a buyer :  nmgfdhg ( 24 )\",\"link\":\"http:\\/\\/3.8.199.229\\/funding_joint\\/public\\/buyers\"}', '2021-07-05 04:43:58', '2021-07-05 03:49:24', '2021-07-05 04:43:58'),
('bc271b4e-40fe-47b8-ab27-bb7ab5444555', 'App\\Notifications\\UserNotification', 'App\\Model\\Users\\User', 339, '{\"title\":\"Bid rejected\",\"body\":\"Your Bid for auction #51 is rejected. \",\"link\":\"http:\\/\\/localhost\\/Join_Funding\\/funding_joint_28_05_21\\/public\\/auctions\\/51\"}', NULL, '2021-06-08 18:15:36', '2021-06-08 18:15:36'),
('bd567f3e-8088-4906-8795-8eec99fe89ae', 'App\\Notifications\\AdminNotification', 'App\\Model\\Users\\User', 1, '{\"title\":\"User Added Funds\",\"body\":\"Investor- 34279@iqraisb.edu.pk added funds, review and confirm\",\"link\":\"http:\\/\\/3.8.199.229\\/funding_joint\\/public\\/transactions?id=293\"}', '2021-07-05 04:43:58', '2021-07-05 04:42:46', '2021-07-05 04:43:58'),
('bfa242a3-d269-4e05-97df-94e3bd149e6a', 'App\\Notifications\\UserNotification', 'App\\Model\\Users\\User', 340, '{\"title\":\"Your auction has come to end\",\"body\":\"Your auction #85 has come to end, please upload the invoice by 13\\/07\\/2021\",\"link\":\"http:\\/\\/3.8.199.229\\/funding_joint\\/public\\/auctions\\/85\"}', '2021-07-13 17:14:35', '2021-07-13 12:14:05', '2021-07-13 17:14:35'),
('c0092688-7faf-434f-9d41-23679e2e40b9', 'App\\Notifications\\UserNotification', 'App\\Model\\Users\\User', 340, '{\"title\":\"Auction Approved\",\"body\":\"Your Auction #85 has been approved by the admin!\",\"link\":\"http:\\/\\/3.8.199.229\\/funding_joint\\/public\\/auctions\\/85\"}', '2021-07-13 17:14:35', '2021-07-13 12:10:53', '2021-07-13 17:14:35'),
('c1dca4ce-1edf-4b2c-a36d-88ec85d9b05b', 'App\\Notifications\\UserNotification', 'App\\Model\\Users\\User', 353, '{\"title\":\"Registration Approval\",\"body\":\"You have been approved by the Admin\",\"link\":\"\"}', NULL, '2021-07-28 15:16:01', '2021-07-28 15:16:01'),
('c25ff54b-b04f-4cce-939f-82851f892fdc', 'App\\Notifications\\UserNotification', 'App\\Model\\Users\\User', 347, '{\"title\":\"Outbidded\",\"body\":\"You have been outbidded for auction : nmgfdhg\",\"link\":\"http:\\/\\/18.170.35.138\\/funding_joint\\/public\\/auctions\\/91\"}', '2021-07-29 02:30:25', '2021-07-25 23:01:01', '2021-07-29 02:30:25'),
('c2ed8bd2-2fa5-4455-b74c-4353ec59493e', 'App\\Notifications\\AdminNotification', 'App\\Model\\Users\\User', 1, '{\"title\":\"Buyer Created\",\"body\":\"Fgff Gfgf has registered a buyer :  sds ( 27 )\",\"link\":\"http:\\/\\/3.8.199.229\\/funding_joint\\/public\\/buyers\"}', '2021-07-05 04:50:49', '2021-07-05 04:47:26', '2021-07-05 04:50:49'),
('c3675e64-85bf-42a6-b903-0d5fb71ab7a8', 'App\\Notifications\\UserNotification', 'App\\Model\\Users\\User', 340, '{\"title\":\"Your auction received a bid\",\"body\":\"Your auction ( nmgfdhg ) has received a bid\",\"link\":\"http:\\/\\/3.8.199.229\\/funding_joint\\/public\\/auctions\\/88\"}', '2021-07-26 13:13:52', '2021-07-21 13:23:10', '2021-07-26 13:13:52'),
('c4d6e04c-8bc8-4e78-a292-9e3eb973bc82', 'App\\Notifications\\AdminNotification', 'App\\Model\\Users\\User', 1, '{\"title\":\"User Added Funds\",\"body\":\"Investor- mostwantedpreston@gmail.com added funds, review and confirm\",\"link\":\"http:\\/\\/3.8.199.229\\/funding_joint\\/public\\/transactions?id=357\"}', '2021-07-21 12:35:24', '2021-07-21 12:34:47', '2021-07-21 12:35:24'),
('c607aa70-78ca-4966-9ea4-54673d8c3db7', 'App\\Notifications\\UserNotification', 'App\\Model\\Users\\User', 339, '{\"title\":\"Admin Message\",\"body\":\"You have got message from Admin\",\"link\":\"\"}', '2021-06-24 16:37:06', '2021-06-24 12:00:44', '2021-06-24 16:37:06'),
('c7b9919d-bc63-4153-aa61-41d0e29b86f1', 'App\\Notifications\\UserNotification', 'App\\Model\\Users\\User', 339, '{\"title\":\"Payment Received\",\"body\":\"Admin has released your funds!\",\"link\":\"http:\\/\\/18.170.35.138\\/funding_joint\\/public\\/account\"}', NULL, '2021-07-26 21:34:04', '2021-07-26 21:34:04'),
('c83e3c71-eb4c-4a5f-885b-7c6862b9e23f', 'App\\Notifications\\AdminNotification', 'App\\Model\\Users\\User', 1, '{\"title\":\"Auction Created\",\"body\":\"khalid khan created an auction for sds\",\"link\":\"http:\\/\\/3.8.199.229\\/funding_joint_20210622\\/public\\/auctions?id=64\"}', '2021-06-30 12:58:50', '2021-06-30 12:18:15', '2021-06-30 12:58:50'),
('c857a0de-d5f3-43c2-ad1e-f566e632427c', 'App\\Notifications\\AdminNotification', 'App\\Model\\Users\\User', 1, '{\"title\":\"Seller Registered\",\"body\":\"gfg ffd registered as a seller. Click to review and approve.\",\"link\":\"http:\\/\\/18.132.204.246\\/funding_joint_20210620\\/public\\/users?id=346\"}', '2021-06-23 18:35:19', '2021-06-23 18:33:59', '2021-06-23 18:35:19'),
('c895e56a-aa4a-4d69-8a02-a479a1c143f5', 'App\\Notifications\\AdminNotification', 'App\\Model\\Users\\User', 1, '{\"title\":\"Auction Created\",\"body\":\"khalid khan created an auction for kgfgh\",\"link\":\"http:\\/\\/3.8.199.229\\/funding_joint\\/public\\/auctions?id=66\"}', '2021-07-01 06:16:06', '2021-06-30 13:03:12', '2021-07-01 06:16:06'),
('c9d39c69-39c6-44cc-92e3-b2816cf15df6', 'App\\Notifications\\UserNotification', 'App\\Model\\Users\\User', 340, '{\"title\":\"Auction Approved\",\"body\":\"Your Auction #89 has been approved by the admin!\",\"link\":\"http:\\/\\/3.8.199.229\\/funding_joint\\/public\\/auctions\\/89\"}', '2021-07-26 13:15:36', '2021-07-20 15:19:29', '2021-07-26 13:15:36'),
('ca2249dd-7195-424f-af03-41e68000418e', 'App\\Notifications\\UserNotification', 'App\\Model\\Users\\User', 340, '{\"title\":\"Your auction received a bid\",\"body\":\"Your auction ( nmgfdhg ) has received a bid\",\"link\":\"http:\\/\\/18.170.35.138\\/funding_joint\\/public\\/auctions\\/91\"}', '2021-07-26 12:28:51', '2021-07-25 22:58:39', '2021-07-26 12:28:51'),
('ca7765f8-4beb-4178-b5a1-68c81822e8ed', 'App\\Notifications\\UserNotification', 'App\\Model\\Users\\User', 338, '{\"title\":\"Buyer Approved\",\"body\":\"Admin has approved SM technologies ( 20 )\",\"link\":\"http:\\/\\/18.132.204.246\\/funding_joint_20210622\\/public\\/buyers\\/show\\/20\"}', '2021-06-24 16:23:42', '2021-06-24 12:01:20', '2021-06-24 16:23:42'),
('caca0529-19ae-48b6-97a6-c9993a525b7c', 'App\\Notifications\\UserNotification', 'App\\Model\\Users\\User', 339, '{\"title\":\"Bid rejected\",\"body\":\"Your Bid for auction #51 is rejected. \",\"link\":\"http:\\/\\/localhost\\/Join_Funding\\/funding_joint_28_05_21\\/public\\/auctions\\/51\"}', NULL, '2021-06-08 18:15:37', '2021-06-08 18:15:37'),
('cb13dacd-c981-4ddd-9bb8-05299ec5edd7', 'App\\Notifications\\AdminNotification', 'App\\Model\\Users\\User', 1, '{\"title\":\"Auction Created\",\"body\":\"khalid khan created an auction for shahzeb\",\"link\":\"http:\\/\\/3.8.199.229\\/funding_joint\\/public\\/auctions?id=87\"}', '2021-07-19 16:26:20', '2021-07-19 16:25:27', '2021-07-19 16:26:20'),
('cb3b38fd-4622-4dee-9212-625f5f793ef8', 'App\\Notifications\\AdminNotification', 'App\\Model\\Users\\User', 1, '{\"title\":\"User Withdraws Funds\",\"body\":\"Investor- 34279@iqraisb.edu.pk Requested to withdraw funds, review and confirm\",\"link\":\"http:\\/\\/18.170.35.138\\/funding_joint\\/public\\/transactions?id=393\"}', '2021-07-28 15:18:10', '2021-07-26 21:33:32', '2021-07-28 15:18:10'),
('cc77c86e-ddc7-4385-83e2-c79bca860b58', 'App\\Notifications\\UserNotification', 'App\\Model\\Users\\User', 340, '{\"title\":\"Buyer Approved\",\"body\":\"Admin has approved SM technologies ( 23 )\",\"link\":\"http:\\/\\/18.132.204.246\\/funding_joint_20210622\\/public\\/buyers\\/show\\/23\"}', '2021-06-25 12:35:00', '2021-06-25 12:32:32', '2021-06-25 12:35:00'),
('cd34ac4f-aabc-417a-aa7d-82155dae3542', 'App\\Notifications\\AdminNotification', 'App\\Model\\Users\\User', 1, '{\"title\":\"User Added Funds\",\"body\":\"Investor- khalidkhan7408@gmail.com added funds, review and confirm\",\"link\":\"http:\\/\\/3.8.199.229\\/funding_joint\\/public\\/transactions?id=284\"}', '2021-07-02 16:06:58', '2021-07-02 15:50:49', '2021-07-02 16:06:58'),
('cd47fb5b-def0-4946-99a9-5feb492f87f4', 'App\\Notifications\\UserNotification', 'App\\Model\\Users\\User', 340, '{\"title\":\"Admin Message\",\"body\":\"You have got message from Admin\",\"link\":\"\"}', '2021-06-30 11:31:35', '2021-06-30 11:30:51', '2021-06-30 11:31:35'),
('cdf6473e-968b-421b-87d0-21101496ed64', 'App\\Notifications\\AdminNotification', 'App\\Model\\Users\\User', 1, '{\"title\":\"Auction Created\",\"body\":\"khalid khan created an auction for shahzeb\",\"link\":\"http:\\/\\/3.8.199.229\\/funding_joint\\/public\\/auctions?id=75\"}', '2021-07-09 18:57:54', '2021-07-09 15:11:39', '2021-07-09 18:57:54'),
('ce8c0d1f-b963-4427-8fb0-62fd64488e21', 'App\\Notifications\\UserNotification', 'App\\Model\\Users\\User', 340, '{\"title\":\"Auction Approved\",\"body\":\"Your Auction #64 has been approved by the admin!\",\"link\":\"http:\\/\\/3.8.199.229\\/funding_joint_20210622\\/public\\/auctions\\/64\"}', '2021-06-30 12:26:54', '2021-06-30 12:20:23', '2021-06-30 12:26:54'),
('ce9c2a01-c38b-4831-9826-0e2f9adcbab2', 'App\\Notifications\\UserNotification', 'App\\Model\\Users\\User', 340, '{\"title\":\"Your auction received a bid\",\"body\":\"Your auction ( nmgfdhg ) has received a bid\",\"link\":\"http:\\/\\/3.8.199.229\\/funding_joint\\/public\\/auctions\\/86\"}', '2021-07-26 13:15:36', '2021-07-19 16:35:28', '2021-07-26 13:15:36'),
('cfc24292-dde4-4853-9177-dffc5099d6cb', 'App\\Notifications\\UserNotification', 'App\\Model\\Users\\User', 339, '{\"title\":\"Payment Received\",\"body\":\"Admin has confirmed your funds!\",\"link\":\"http:\\/\\/3.8.199.229\\/funding_joint\\/public\\/account\"}', '2021-07-15 10:26:07', '2021-07-13 12:03:27', '2021-07-15 10:26:07'),
('d2ae9959-6e5d-474e-980f-b8ac10d9a4a0', 'App\\Notifications\\UserNotification', 'App\\Model\\Users\\User', 338, '{\"title\":\"Your auction received a bid\",\"body\":\"Your auction ( none ) has received a bid\",\"link\":\"http:\\/\\/18.132.204.246\\/funding_joint_20210622\\/public\\/auctions\\/53\"}', '2021-06-24 16:23:42', '2021-06-24 10:59:00', '2021-06-24 16:23:42'),
('d37165dc-dc18-475e-94d8-f2e5ff2e79f9', 'App\\Notifications\\UserNotification', 'App\\Model\\Users\\User', 346, '{\"title\":\"Auction Approved\",\"body\":\"Your Auction #67 has been approved by the admin!\",\"link\":\"http:\\/\\/3.8.199.229\\/funding_joint\\/public\\/auctions\\/67\"}', '2021-07-05 05:05:09', '2021-07-05 04:54:21', '2021-07-05 05:05:09'),
('d3a975bf-9269-49c4-b630-ba9eab6f0c75', 'App\\Notifications\\UserNotification', 'App\\Model\\Users\\User', 340, '{\"title\":\"Your auction received a bid\",\"body\":\"Your auction ( nmgfdhg ) has received a bid\",\"link\":\"http:\\/\\/3.8.199.229\\/funding_joint\\/public\\/auctions\\/89\"}', '2021-07-26 13:14:00', '2021-07-20 16:17:50', '2021-07-26 13:14:00'),
('d3b67ae4-55cf-4d61-abe1-04893880af42', 'App\\Notifications\\UserNotification', 'App\\Model\\Users\\User', 340, '{\"title\":\"Your auction received a bid\",\"body\":\"Your auction ( nmgfdhg ) has received a bid\",\"link\":\"http:\\/\\/3.8.199.229\\/funding_joint_20210622\\/public\\/auctions\\/61\"}', '2021-06-29 13:12:52', '2021-06-29 12:43:08', '2021-06-29 13:12:52'),
('d44187b0-a4c1-4b7b-897d-34435c64172e', 'App\\Notifications\\AdminNotification', 'App\\Model\\Users\\User', 1, '{\"title\":\"Auction Created\",\"body\":\"khalid khan created an auction for kjgfhjg\",\"link\":\"http:\\/\\/3.8.199.229\\/funding_joint_20210622\\/public\\/auctions?id=61\"}', '2021-06-29 08:01:37', '2021-06-28 17:07:44', '2021-06-29 08:01:37'),
('d4e06611-d07c-4611-8e8f-ae9440110714', 'App\\Notifications\\UserNotification', 'App\\Model\\Users\\User', 340, '{\"title\":\"Your auction received a bid\",\"body\":\"Your auction ( nmgfdhg ) has received a bid\",\"link\":\"http:\\/\\/3.8.199.229\\/funding_joint\\/public\\/auctions\\/66\"}', '2021-07-07 07:13:09', '2021-07-05 04:41:45', '2021-07-07 07:13:09'),
('d52d9fc9-d75a-4a83-ae28-934d009c1af2', 'App\\Notifications\\UserNotification', 'App\\Model\\Users\\User', 346, '{\"title\":\"Auction Approved\",\"body\":\"Your Auction #76 has been approved by the admin!\",\"link\":\"http:\\/\\/3.8.199.229\\/funding_joint\\/public\\/auctions\\/76\"}', '2021-07-09 18:59:55', '2021-07-09 18:52:53', '2021-07-09 18:59:55'),
('d58686eb-58e0-498f-a64b-baf9dea93538', 'App\\Notifications\\UserNotification', 'App\\Model\\Users\\User', 338, '{\"title\":\"Your auction received a bid\",\"body\":\"Your auction ( none ) has received a bid\",\"link\":\"http:\\/\\/localhost\\/Join_Funding\\/funding_joint_28_05_21\\/public\\/auctions\\/51\"}', '2021-06-21 15:50:09', '2021-06-08 18:11:13', '2021-06-21 15:50:09'),
('d7df7c39-ee01-46f0-88f3-13423a6d0b65', 'App\\Notifications\\AdminNotification', 'App\\Model\\Users\\User', 1, '{\"title\":\"Auction Created\",\"body\":\"khalid khan created an auction for shahzeb\",\"link\":\"http:\\/\\/3.8.199.229\\/funding_joint\\/public\\/auctions?id=91\"}', NULL, '2021-07-22 17:12:33', '2021-07-22 17:12:33');
INSERT INTO `notifications` (`id`, `type`, `notifiable_type`, `notifiable_id`, `data`, `read_at`, `created_at`, `updated_at`) VALUES
('da7826f1-3bd8-43e8-848a-883d66e44e76', 'App\\Notifications\\AdminNotification', 'App\\Model\\Users\\User', 1, '{\"title\":\"Auction Created\",\"body\":\"khalid khan created an auction for sds\",\"link\":\"http:\\/\\/18.170.35.138\\/funding_joint\\/public\\/auctions?id=94\"}', '2021-07-28 15:18:10', '2021-07-26 23:02:41', '2021-07-28 15:18:10'),
('dc67dce7-d2f3-4bcb-993e-1417f9bac675', 'App\\Notifications\\UserNotification', 'App\\Model\\Users\\User', 338, '{\"title\":\"Your auction received a bid\",\"body\":\"Your auction ( none ) has received a bid\",\"link\":\"http:\\/\\/3.8.199.229\\/funding_joint_20210622\\/public\\/auctions\\/53\"}', NULL, '2021-06-26 00:11:42', '2021-06-26 00:11:42'),
('dd087495-f2ce-4a95-984a-b8bb6ca618dd', 'App\\Notifications\\UserNotification', 'App\\Model\\Users\\User', 340, '{\"title\":\"Your auction received a bid\",\"body\":\"Your auction ( nmgfdhg ) has received a bid\",\"link\":\"http:\\/\\/3.8.199.229\\/funding_joint\\/public\\/auctions\\/88\"}', '2021-07-26 13:13:52', '2021-07-22 12:31:26', '2021-07-26 13:13:52'),
('dd606cd4-90fd-4782-8109-6491f7d9022a', 'App\\Notifications\\UserNotification', 'App\\Model\\Users\\User', 338, '{\"title\":\"Your auction received a bid\",\"body\":\"Your auction ( none ) has received a bid\",\"link\":\"http:\\/\\/localhost\\/Join_Funding\\/funding_joint_28_05_21\\/public\\/auctions\\/51\"}', '2021-06-21 15:50:09', '2021-06-08 18:11:18', '2021-06-21 15:50:09'),
('dd973e03-192a-4db7-916b-e172ba44e34d', 'App\\Notifications\\UserNotification', 'App\\Model\\Users\\User', 338, '{\"title\":\"Buyer Approved\",\"body\":\"Admin has approved SM technologies ( 20 )\",\"link\":\"http:\\/\\/18.132.204.246\\/funding_joint_20210620\\/public\\/buyers\\/show\\/20\"}', '2021-06-24 16:23:42', '2021-06-23 12:28:04', '2021-06-24 16:23:42'),
('ddb1cc23-960a-4b5d-9018-b489f97fc9ad', 'App\\Notifications\\AdminNotification', 'App\\Model\\Users\\User', 1, '{\"title\":\"Auction Created\",\"body\":\"Fgff Gfgf created an auction for nmgfdhg\",\"link\":\"http:\\/\\/3.8.199.229\\/funding_joint\\/public\\/auctions?id=76\"}', '2021-07-09 18:57:54', '2021-07-09 18:49:41', '2021-07-09 18:57:54'),
('ddf61823-4a17-4b96-b9e7-b35a09ae5b8d', 'App\\Notifications\\UserNotification', 'App\\Model\\Users\\User', 338, '{\"title\":\"Your auction received a bid\",\"body\":\"Your auction ( none ) has received a bid\",\"link\":\"http:\\/\\/localhost\\/Join_Funding\\/funding_joint_28_05_21\\/public\\/auctions\\/51\"}', '2021-06-21 15:50:09', '2021-06-08 18:08:52', '2021-06-21 15:50:09'),
('de097f93-9708-4438-b4a8-d348e634a4c3', 'App\\Notifications\\UserNotification', 'App\\Model\\Users\\User', 340, '{\"title\":\"Your auction received a bid\",\"body\":\"Your auction ( nmgfdhg ) has received a bid\",\"link\":\"http:\\/\\/3.8.199.229\\/funding_joint\\/public\\/auctions\\/63\"}', '2021-07-05 02:26:24', '2021-07-02 16:08:04', '2021-07-05 02:26:24'),
('de5b65b4-b272-439b-9a66-6ec9575ae954', 'App\\Notifications\\UserNotification', 'App\\Model\\Users\\User', 351, '{\"title\":\"Payment Received\",\"body\":\"Admin has released your funds!\",\"link\":\"http:\\/\\/3.8.199.229\\/funding_joint\\/public\\/account\"}', '2021-07-22 12:16:53', '2021-07-22 12:13:30', '2021-07-22 12:16:53'),
('dec7629c-7df6-450d-afc2-73ac1a4ef375', 'App\\Notifications\\UserNotification', 'App\\Model\\Users\\User', 340, '{\"title\":\"Your auction received a bid\",\"body\":\"Your auction ( nmgfdhg ) has received a bid\",\"link\":\"http:\\/\\/18.170.35.138\\/funding_joint\\/public\\/auctions\\/96\"}', '2021-07-29 11:22:37', '2021-07-26 23:41:37', '2021-07-29 11:22:37'),
('df5f29eb-c14e-4a52-a99b-83d39e2011e2', 'App\\Notifications\\UserNotification', 'App\\Model\\Users\\User', 340, '{\"title\":\"Your auction received a bid\",\"body\":\"Your auction ( nmgfdhg ) has received a bid\",\"link\":\"http:\\/\\/3.8.199.229\\/funding_joint_20210622\\/public\\/auctions\\/61\"}', '2021-06-30 11:31:35', '2021-06-29 15:45:11', '2021-06-30 11:31:35'),
('df645826-a1eb-4f6a-a77b-5edc1fdc27ff', 'App\\Notifications\\UserNotification', 'App\\Model\\Users\\User', 339, '{\"title\":\"Payment Received\",\"body\":\"Admin has confirmed your funds!\",\"link\":\"http:\\/\\/3.8.199.229\\/funding_joint\\/public\\/account\"}', '2021-07-15 10:26:07', '2021-07-13 17:20:57', '2021-07-15 10:26:07'),
('df6efd19-83f8-47f4-bc7c-8eaf37306571', 'App\\Notifications\\AdminNotification', 'App\\Model\\Users\\User', 1, '{\"title\":\"Auction Created\",\"body\":\"khalid khan created an auction for shahzeb\",\"link\":\"http:\\/\\/3.8.199.229\\/funding_joint\\/public\\/auctions?id=88\"}', '2021-07-21 12:35:24', '2021-07-20 15:15:55', '2021-07-21 12:35:24'),
('df7cd153-6391-43d3-9771-d1695480eb1d', 'App\\Notifications\\AdminNotification', 'App\\Model\\Users\\User', 1, '{\"title\":\"Buyer Created\",\"body\":\"Fgff Gfgf has registered a buyer :  sds ( 26 )\",\"link\":\"http:\\/\\/3.8.199.229\\/funding_joint\\/public\\/buyers\"}', '2021-07-05 04:43:58', '2021-07-05 03:54:42', '2021-07-05 04:43:58'),
('e01c1485-8e54-4848-a393-86a4d3c1cf20', 'App\\Notifications\\UserNotification', 'App\\Model\\Users\\User', 346, '{\"title\":\"Your auction received a bid\",\"body\":\"Your auction ( Gfgf ) has received a bid\",\"link\":\"http:\\/\\/3.8.199.229\\/funding_joint\\/public\\/auctions\\/69\"}', '2021-07-05 05:05:08', '2021-07-05 05:00:07', '2021-07-05 05:05:08'),
('e028f922-7b6c-4ae2-ae88-773a272f5620', 'App\\Notifications\\UserNotification', 'App\\Model\\Users\\User', 340, '{\"title\":\"Your auction received a bid\",\"body\":\"Your auction ( nmgfdhg ) has received a bid\",\"link\":\"http:\\/\\/3.8.199.229\\/funding_joint\\/public\\/auctions\\/62\"}', '2021-07-05 02:26:24', '2021-07-03 06:49:09', '2021-07-05 02:26:24'),
('e174bcca-6d7d-4d0c-8523-7aad95566811', 'App\\Notifications\\AdminNotification', 'App\\Model\\Users\\User', 1, '{\"title\":\"User Added Funds\",\"body\":\"Investor- khalidkhan7408@gmail.com added funds, review and confirm\",\"link\":\"http:\\/\\/3.8.199.229\\/funding_joint\\/public\\/transactions?id=372\"}', NULL, '2021-07-22 14:20:25', '2021-07-22 14:20:25'),
('e1cfb5f5-b6b8-4094-92ae-07d13445179b', 'App\\Notifications\\UserNotification', 'App\\Model\\Users\\User', 340, '{\"title\":\"Your auction received a bid\",\"body\":\"Your auction ( nmgfdhg ) has received a bid\",\"link\":\"http:\\/\\/3.8.199.229\\/funding_joint\\/public\\/auctions\\/87\"}', '2021-07-26 13:14:00', '2021-07-21 12:40:04', '2021-07-26 13:14:00'),
('e2d5229c-1d71-4cab-bc96-8e63805e5921', 'App\\Notifications\\UserNotification', 'App\\Model\\Users\\User', 345, '{\"title\":\"Admin Message\",\"body\":\"You have got message from Admin\",\"link\":\"\"}', NULL, '2021-06-22 08:20:14', '2021-06-22 08:20:14'),
('e2fb272e-79cb-4484-9eb8-8639ce4bfa44', 'App\\Notifications\\AdminNotification', 'App\\Model\\Users\\User', 1, '{\"title\":\"User Withdraws Funds\",\"body\":\"Investor- mostwantedpreston@gmail.com Requested to withdraw funds, review and confirm\",\"link\":\"http:\\/\\/3.8.199.229\\/funding_joint\\/public\\/transactions?id=364\"}', NULL, '2021-07-22 11:36:20', '2021-07-22 11:36:20'),
('e361d0a6-bd0e-44d9-aa6f-806bbb763fc2', 'App\\Notifications\\UserNotification', 'App\\Model\\Users\\User', 346, '{\"title\":\"Admin Message\",\"body\":\"You have got message from Admin\",\"link\":\"\"}', '2021-06-29 04:05:40', '2021-06-24 17:51:32', '2021-06-29 04:05:40'),
('e3719338-8dfd-40d6-ab76-02279872e160', 'App\\Notifications\\UserNotification', 'App\\Model\\Users\\User', 340, '{\"title\":\"Buyer Approved\",\"body\":\"Admin has approved sds ( 22 )\",\"link\":\"http:\\/\\/18.132.204.246\\/funding_joint_20210622\\/public\\/buyers\\/show\\/22\"}', '2021-06-25 12:35:00', '2021-06-25 12:32:39', '2021-06-25 12:35:00'),
('e4c56d9f-e4a0-4182-a8c2-a0e1d9be25da', 'App\\Notifications\\UserNotification', 'App\\Model\\Users\\User', 351, '{\"title\":\"Payment Received\",\"body\":\"Admin has released your funds!\",\"link\":\"http:\\/\\/3.8.199.229\\/funding_joint\\/public\\/account\"}', '2021-07-22 12:16:53', '2021-07-22 12:04:26', '2021-07-22 12:16:53'),
('e5b1cb7f-4ebb-4d0c-8e16-244d92f9bd2f', 'App\\Notifications\\AdminNotification', 'App\\Model\\Users\\User', 1, '{\"title\":\"Investor Registered\",\"body\":\"fgfbfxh gfdhdfg registered as investor. Click to review and approve.\",\"link\":\"http:\\/\\/18.170.35.138\\/funding_joint\\/public\\/users?id=353\"}', '2021-07-28 15:18:10', '2021-07-28 12:13:37', '2021-07-28 15:18:10'),
('e60ca14d-b794-422b-aa1b-d2afac44dd8e', 'App\\Notifications\\UserNotification', 'App\\Model\\Users\\User', 339, '{\"title\":\"Bid rejected\",\"body\":\"Your Bid for auction #51 is rejected. \",\"link\":\"http:\\/\\/localhost\\/Join_Funding\\/funding_joint_28_05_21\\/public\\/auctions\\/51\"}', NULL, '2021-06-08 18:15:36', '2021-06-08 18:15:36'),
('e64e4caf-b690-484a-ad76-6997713103a7', 'App\\Notifications\\AdminNotification', 'App\\Model\\Users\\User', 1, '{\"title\":\"Auction Created\",\"body\":\"seller faslkj created an auction for xasxas\",\"link\":\"http:\\/\\/localhost\\/Join_Funding\\/funding_joint_28_05_21\\/public\\/auctions?id=52\"}', '2021-06-21 13:56:00', '2021-06-09 02:11:01', '2021-06-21 13:56:00'),
('e6bb9e3c-ab5b-4a42-8590-d212dc34aac4', 'App\\Notifications\\UserNotification', 'App\\Model\\Users\\User', 340, '{\"title\":\"Your auction received a bid\",\"body\":\"Your auction ( nmgfdhg ) has received a bid\",\"link\":\"http:\\/\\/3.8.199.229\\/funding_joint\\/public\\/auctions\\/86\"}', '2021-07-26 12:28:51', '2021-07-22 23:21:18', '2021-07-26 12:28:51'),
('e8ff567a-e958-4818-94ef-7884c03d5e30', 'App\\Notifications\\UserNotification', 'App\\Model\\Users\\User', 339, '{\"title\":\"Bid rejected\",\"body\":\"Your Bid for auction #51 is rejected. \",\"link\":\"http:\\/\\/localhost\\/Join_Funding\\/funding_joint_28_05_21\\/public\\/auctions\\/51\"}', '2021-06-08 18:28:41', '2021-06-08 18:15:38', '2021-06-08 18:28:41'),
('ea033467-1576-4b1d-a8cd-d509c5aa0028', 'App\\Notifications\\UserNotification', 'App\\Model\\Users\\User', 347, '{\"title\":\"Payment Received\",\"body\":\"Admin has confirmed your funds!\",\"link\":\"http:\\/\\/3.8.199.229\\/funding_joint\\/public\\/account\"}', '2021-07-29 02:30:25', '2021-07-22 14:20:36', '2021-07-29 02:30:25'),
('ea114f06-28c1-43cc-bcca-a0f9708f8e55', 'App\\Notifications\\UserNotification', 'App\\Model\\Users\\User', 338, '{\"title\":\"Your auction received a bid\",\"body\":\"Your auction ( none ) has received a bid\",\"link\":\"http:\\/\\/localhost\\/Join_Funding\\/funding_joint_28_05_21\\/public\\/auctions\\/51\"}', '2021-06-21 15:46:46', '2021-06-08 18:14:49', '2021-06-21 15:46:46'),
('ea7bc7ee-da95-4bda-9477-4312993f9822', 'App\\Notifications\\UserNotification', 'App\\Model\\Users\\User', 339, '{\"title\":\"Bid rejected\",\"body\":\"Your Bid for auction #51 is rejected. \",\"link\":\"http:\\/\\/localhost\\/Join_Funding\\/funding_joint_28_05_21\\/public\\/auctions\\/51\"}', '2021-06-08 18:28:41', '2021-06-08 18:15:38', '2021-06-08 18:28:41'),
('ec3a7bf3-20ca-4cf8-b70b-02c381a88632', 'App\\Notifications\\AdminNotification', 'App\\Model\\Users\\User', 1, '{\"title\":\"Auction Created\",\"body\":\"khalid khan created an auction for sds\",\"link\":\"http:\\/\\/3.8.199.229\\/funding_joint\\/public\\/auctions?id=70\"}', '2021-07-05 16:25:13', '2021-07-05 16:24:17', '2021-07-05 16:25:13'),
('ee353ad7-8ef7-48e3-898f-63c62e970ef3', 'App\\Notifications\\UserNotification', 'App\\Model\\Users\\User', 338, '{\"title\":\"Your auction received a bid\",\"body\":\"Your auction ( none ) has received a bid\",\"link\":\"http:\\/\\/18.132.204.246\\/funding_joint_20210622\\/public\\/auctions\\/53\"}', '2021-06-24 16:23:42', '2021-06-24 10:56:44', '2021-06-24 16:23:42'),
('ee8dde38-f8d7-45e7-8bf3-8bfa52e7759f', 'App\\Notifications\\UserNotification', 'App\\Model\\Users\\User', 340, '{\"title\":\"Your auction received a bid\",\"body\":\"Your auction ( nmgfdhg ) has received a bid\",\"link\":\"http:\\/\\/3.8.199.229\\/funding_joint_20210622\\/public\\/auctions\\/61\"}', '2021-06-30 11:31:35', '2021-06-29 15:17:15', '2021-06-30 11:31:35'),
('ee9464f6-a6d4-44da-9387-3ba2a96a879a', 'App\\Notifications\\UserNotification', 'App\\Model\\Users\\User', 340, '{\"title\":\"Your auction received a bid\",\"body\":\"Your auction ( nmgfdhg ) has received a bid\",\"link\":\"http:\\/\\/3.8.199.229\\/funding_joint_20210622\\/public\\/auctions\\/61\"}', '2021-06-29 13:12:52', '2021-06-29 12:47:33', '2021-06-29 13:12:52'),
('f07e30db-72a4-47e8-af92-ea98dff2e1c4', 'App\\Notifications\\UserNotification', 'App\\Model\\Users\\User', 346, '{\"title\":\"Your auction received a bid\",\"body\":\"Your auction ( Gfgf ) has received a bid\",\"link\":\"http:\\/\\/3.8.199.229\\/funding_joint\\/public\\/auctions\\/67\"}', '2021-07-09 18:59:55', '2021-07-05 16:15:37', '2021-07-09 18:59:55'),
('f0d1b18f-3339-459b-aaf4-5d424540cfd5', 'App\\Notifications\\UserNotification', 'App\\Model\\Users\\User', 340, '{\"title\":\"Auction Approved\",\"body\":\"Your Auction #95 has been approved by the admin!\",\"link\":\"http:\\/\\/18.170.35.138\\/funding_joint\\/public\\/auctions\\/95\"}', NULL, '2021-07-26 23:19:53', '2021-07-26 23:19:53'),
('f1ac7bee-88a6-4813-934d-a5f8c427e292', 'App\\Notifications\\UserNotification', 'App\\Model\\Users\\User', 340, '{\"title\":\"Auction Approved\",\"body\":\"Your Auction #96 has been approved by the admin!\",\"link\":\"http:\\/\\/18.170.35.138\\/funding_joint\\/public\\/auctions\\/96\"}', NULL, '2021-07-26 23:19:23', '2021-07-26 23:19:23'),
('f2f037c4-9127-487e-b94a-0e3aca8c4716', 'App\\Notifications\\UserNotification', 'App\\Model\\Users\\User', 338, '{\"title\":\"Your auction received a bid\",\"body\":\"Your auction ( none ) has received a bid\",\"link\":\"http:\\/\\/3.8.199.229\\/funding_joint_20210622\\/public\\/auctions\\/53\"}', NULL, '2021-06-28 15:18:29', '2021-06-28 15:18:29'),
('f413ff6a-9067-4f8a-89de-c0c2ac9bd472', 'App\\Notifications\\UserNotification', 'App\\Model\\Users\\User', 340, '{\"title\":\"Your auction received a bid\",\"body\":\"Your auction ( nmgfdhg ) has received a bid\",\"link\":\"http:\\/\\/3.8.199.229\\/funding_joint\\/public\\/auctions\\/87\"}', '2021-07-26 13:13:52', '2021-07-21 12:41:10', '2021-07-26 13:13:52'),
('f419c6b1-3b41-44f0-a1d2-121a3ca55de3', 'App\\Notifications\\UserNotification', 'App\\Model\\Users\\User', 351, '{\"title\":\"Payment Received\",\"body\":\"Admin has released your funds!\",\"link\":\"http:\\/\\/18.170.35.138\\/funding_joint\\/public\\/account\"}', NULL, '2021-07-26 23:37:59', '2021-07-26 23:37:59'),
('f4e1fbd8-c20a-4cbb-85f1-7bd42f13c54f', 'App\\Notifications\\AdminNotification', 'App\\Model\\Users\\User', 1, '{\"title\":\"Auction Created\",\"body\":\"khalid khan created an auction for shahzeb\",\"link\":\"http:\\/\\/18.170.35.138\\/funding_joint\\/public\\/auctions?id=95\"}', '2021-07-28 15:18:10', '2021-07-26 23:16:49', '2021-07-28 15:18:10'),
('f5191252-d202-453d-b782-f1a90b01dc3d', 'App\\Notifications\\UserNotification', 'App\\Model\\Users\\User', 346, '{\"title\":\"Auction Approved\",\"body\":\"Your Auction #68 has been approved by the admin!\",\"link\":\"http:\\/\\/3.8.199.229\\/funding_joint\\/public\\/auctions\\/68\"}', '2021-07-05 05:05:09', '2021-07-05 04:53:26', '2021-07-05 05:05:09'),
('f6de5c2f-a7cd-464c-a672-5c0dfd53dfd3', 'App\\Notifications\\UserNotification', 'App\\Model\\Users\\User', 338, '{\"title\":\"Your auction received a bid\",\"body\":\"Your auction ( none ) has received a bid\",\"link\":\"http:\\/\\/localhost\\/Join_Funding\\/funding_joint_28_05_21\\/public\\/auctions\\/51\"}', '2021-06-21 15:50:04', '2021-06-08 18:01:10', '2021-06-21 15:50:04'),
('f6ffa9f8-5592-45ba-9a3a-2178a444287e', 'App\\Notifications\\AdminNotification', 'App\\Model\\Users\\User', 1, '{\"title\":\"Seller Registered\",\"body\":\"Fgff Gfgf registered as a seller. Click to review and approve.\",\"link\":\"http:\\/\\/18.132.204.246\\/funding_joint_20210620\\/public\\/users?id=346\"}', '2021-06-23 18:35:19', '2021-06-23 17:53:53', '2021-06-23 18:35:19'),
('f8e15a22-a8fe-46d2-9b3c-e338fb8041d8', 'App\\Notifications\\UserNotification', 'App\\Model\\Users\\User', 338, '{\"title\":\"Your auction received a bid\",\"body\":\"Your auction ( none ) has received a bid\",\"link\":\"http:\\/\\/localhost\\/Join_Funding\\/funding_joint_28_05_21\\/public\\/auctions\\/51\"}', '2021-06-21 15:50:09', '2021-06-08 18:08:22', '2021-06-21 15:50:09'),
('f9171a4a-1d87-4013-9053-edd5c8e06b4c', 'App\\Notifications\\UserNotification', 'App\\Model\\Users\\User', 351, '{\"title\":\"Payment Received\",\"body\":\"Admin has released your funds!\",\"link\":\"http:\\/\\/3.8.199.229\\/funding_joint\\/public\\/account\"}', '2021-07-22 12:16:53', '2021-07-22 10:36:57', '2021-07-22 12:16:53'),
('f91f15ad-0d21-4feb-a0ec-087006e90e64', 'App\\Notifications\\UserNotification', 'App\\Model\\Users\\User', 340, '{\"title\":\"Auction Approved\",\"body\":\"Your Auction #90 has been approved by the admin!\",\"link\":\"http:\\/\\/3.8.199.229\\/funding_joint\\/public\\/auctions\\/90\"}', '2021-07-26 12:28:51', '2021-07-22 17:15:25', '2021-07-26 12:28:51'),
('f9947a7c-f42a-498c-af67-89feea538a91', 'App\\Notifications\\AdminNotification', 'App\\Model\\Users\\User', 1, '{\"title\":\"Investor Registered\",\"body\":\"investot asdf registered as investor. Click to review and approve.\",\"link\":\"http:\\/\\/localhost\\/Join_Funding\\/funding_joint_28_05_21\\/public\\/users?id=339\"}', '2021-06-21 13:56:00', '2021-06-08 17:56:20', '2021-06-21 13:56:00'),
('faa08bc6-3f7b-417d-9bff-ebb098aff333', 'App\\Notifications\\UserNotification', 'App\\Model\\Users\\User', 339, '{\"title\":\"Payment Received\",\"body\":\"Admin has confirmed your funds!\",\"link\":\"http:\\/\\/3.8.199.229\\/funding_joint\\/public\\/account\"}', '2021-07-05 04:46:00', '2021-07-05 04:44:13', '2021-07-05 04:46:00'),
('fcb90c6c-b71f-4c17-989d-d85bb9f91c8f', 'App\\Notifications\\UserNotification', 'App\\Model\\Users\\User', 338, '{\"title\":\"Registration Approval\",\"body\":\"You have been approved by the Admin\",\"link\":\"\"}', '2021-06-08 16:13:22', '2021-06-08 16:13:14', '2021-06-08 16:13:22'),
('fce0300a-25b5-4814-a610-9b0e83041ba7', 'App\\Notifications\\UserNotification', 'App\\Model\\Users\\User', 338, '{\"title\":\"Your auction received a bid\",\"body\":\"Your auction ( none ) has received a bid\",\"link\":\"http:\\/\\/3.8.199.229\\/funding_joint_20210622\\/public\\/auctions\\/53\"}', NULL, '2021-06-26 00:02:09', '2021-06-26 00:02:09'),
('fd1339be-d191-4ba6-81ff-18e8f517dbc3', 'App\\Notifications\\AdminNotification', 'App\\Model\\Users\\User', 1, '{\"title\":\"Auction Created\",\"body\":\"khalid khan created an auction for sds\",\"link\":\"http:\\/\\/3.8.199.229\\/funding_joint_20210622\\/public\\/auctions?id=63\"}', '2021-06-29 15:10:34', '2021-06-29 15:09:41', '2021-06-29 15:10:34'),
('fd4ab63b-cc55-4648-b37f-ba3bbf71b3d8', 'App\\Notifications\\UserNotification', 'App\\Model\\Users\\User', 346, '{\"title\":\"Registration Approval\",\"body\":\"You have been approved by the Admin\",\"link\":\"\"}', '2021-06-29 04:05:40', '2021-06-23 18:37:11', '2021-06-29 04:05:40'),
('ff41a729-e150-4635-8d7d-f49daf72c640', 'App\\Notifications\\UserNotification', 'App\\Model\\Users\\User', 340, '{\"title\":\"Your auction received a bid\",\"body\":\"Your auction ( nmgfdhg ) has received a bid\",\"link\":\"http:\\/\\/3.8.199.229\\/funding_joint\\/public\\/auctions\\/64\"}', '2021-07-05 02:26:24', '2021-07-03 06:45:38', '2021-07-05 02:26:24'),
('ff63e583-be06-4ef2-b781-03d3dd84a4da', 'App\\Notifications\\UserNotification', 'App\\Model\\Users\\User', 347, '{\"title\":\"Payment Received\",\"body\":\"Admin has confirmed your funds!\",\"link\":\"http:\\/\\/3.8.199.229\\/funding_joint\\/public\\/account\"}', '2021-07-09 15:30:23', '2021-07-05 16:26:44', '2021-07-09 15:30:23'),
('ffd9e472-6fd8-49bd-a703-ec8cef3c9b28', 'App\\Notifications\\UserNotification', 'App\\Model\\Users\\User', 339, '{\"title\":\"Bid rejected\",\"body\":\"Your Bid for auction #51 is rejected. \",\"link\":\"http:\\/\\/localhost\\/Join_Funding\\/funding_joint_28_05_21\\/public\\/auctions\\/51\"}', NULL, '2021-06-08 18:15:36', '2021-06-08 18:15:36');

-- --------------------------------------------------------

--
-- Table structure for table `password_resets`
--

CREATE TABLE `password_resets` (
  `email` varchar(191) COLLATE utf8mb4_unicode_ci NOT NULL,
  `token` varchar(191) COLLATE utf8mb4_unicode_ci NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `password_resets`
--

INSERT INTO `password_resets` (`email`, `token`, `created_at`) VALUES
('sibycal+investor01@gmail.com', '$2y$10$e2GmRy0U8SiZTy4zdnESsurVgmzFsCs05BJHXiY.T2lQp8dSIihQ6', '2019-01-22 17:34:20'),
('kamrandhami65+investor10@gmail.com', '$2y$10$rV8CQFINXAzMp49H9Hoaj./cZzjuTfUoyf9EnFlmfCZf5lO863Uze', '2019-04-03 16:16:31'),
('zaheer4195@gmail.com', '$2y$10$6zJPsdUWgCTKGfan881ywebuFczYDJ9cu11xCCUUzHyQ1o2u7Ytiq', '2021-06-21 13:53:54'),
('shahzebnaseer@hotmail.com', '$2y$10$ZPtzpBKETausOuoisXdjrOSHRDXzt0BkVccX1xkAHJgjm/brtB5tO', '2021-07-07 07:20:53'),
('shahzebnaseer76@gmail.com', '$2y$10$9OAUweYaBcCxs7C7rBMVP.KSgX4zMa9mMRISbvoS386B4bd30jlMm', '2021-07-07 13:30:51');

-- --------------------------------------------------------

--
-- Table structure for table `permissions`
--

CREATE TABLE `permissions` (
  `id` int(10) UNSIGNED NOT NULL,
  `name` varchar(191) COLLATE utf8mb4_unicode_ci NOT NULL,
  `guard_name` varchar(191) COLLATE utf8mb4_unicode_ci NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `permissions`
--

INSERT INTO `permissions` (`id`, `name`, `guard_name`, `created_at`, `updated_at`) VALUES
(1, 'role-list', 'web', '2018-11-16 13:29:43', '2018-11-16 13:29:43'),
(2, 'role-create', 'web', '2018-11-16 13:29:43', '2018-11-16 13:29:43'),
(3, 'role-edit', 'web', '2018-11-16 13:29:43', '2018-11-16 13:29:43'),
(4, 'role-delete', 'web', '2018-11-16 13:29:43', '2018-11-16 13:29:43'),
(5, 'seller-list', 'web', '2018-11-16 13:29:43', '2018-11-16 13:29:43'),
(6, 'seller-create', 'web', '2018-11-16 13:29:43', '2018-11-16 13:29:43'),
(7, 'seller-edit', 'web', '2018-11-16 13:29:43', '2018-11-16 13:29:43'),
(8, 'seller-delete', 'web', '2018-11-16 13:29:43', '2018-11-16 13:29:43'),
(9, 'investor-list', 'web', '2018-11-16 13:29:43', '2018-11-16 13:29:43'),
(10, 'investor-create', 'web', '2018-11-16 13:29:43', '2018-11-16 13:29:43'),
(11, 'investor-edit', 'web', '2018-11-16 13:29:43', '2018-11-16 13:29:43'),
(12, 'investor-delete', 'web', '2018-11-16 13:29:43', '2018-11-16 13:29:43');

-- --------------------------------------------------------

--
-- Table structure for table `purchase_orders`
--

CREATE TABLE `purchase_orders` (
  `id` int(10) UNSIGNED NOT NULL,
  `auction_id` int(10) UNSIGNED NOT NULL,
  `approved` tinyint(1) NOT NULL DEFAULT 0,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------

--
-- Table structure for table `roles`
--

CREATE TABLE `roles` (
  `id` int(10) UNSIGNED NOT NULL,
  `name` varchar(191) COLLATE utf8mb4_unicode_ci NOT NULL,
  `guard_name` varchar(191) COLLATE utf8mb4_unicode_ci NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `roles`
--

INSERT INTO `roles` (`id`, `name`, `guard_name`, `created_at`, `updated_at`) VALUES
(1, 'admin', 'web', '2018-11-16 13:29:43', '2018-11-16 13:29:43'),
(2, 'seller', 'web', '2018-11-16 13:29:43', '2018-11-16 13:29:43'),
(3, 'investor', 'web', '2018-11-16 13:29:43', '2018-11-16 13:29:43');

-- --------------------------------------------------------

--
-- Table structure for table `role_has_permissions`
--

CREATE TABLE `role_has_permissions` (
  `permission_id` int(10) UNSIGNED NOT NULL,
  `role_id` int(10) UNSIGNED NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `role_has_permissions`
--

INSERT INTO `role_has_permissions` (`permission_id`, `role_id`) VALUES
(1, 1),
(2, 1),
(3, 1),
(4, 1),
(5, 1),
(5, 2),
(6, 1),
(6, 2),
(7, 1),
(7, 2),
(8, 1),
(8, 2),
(9, 1),
(9, 3),
(10, 1),
(10, 3),
(11, 1),
(11, 3),
(12, 1),
(12, 3);

-- --------------------------------------------------------

--
-- Table structure for table `sellers`
--

CREATE TABLE `sellers` (
  `id` int(10) UNSIGNED NOT NULL,
  `user_id` int(10) UNSIGNED NOT NULL,
  `title` varchar(191) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `first_name` varchar(191) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `last_name` varchar(191) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `dob_incorporation` date DEFAULT NULL,
  `dob` date DEFAULT NULL,
  `job_title` varchar(191) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `phone_code` varchar(45) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `phone` varchar(191) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `company_name` varchar(191) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `company_reg_no` varchar(191) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `building_no` varchar(191) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `address_1` varchar(191) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `address_2` varchar(191) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `address_3` varchar(191) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `town` varchar(191) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `county` varchar(191) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `hear_of_us` text COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `post_code` varchar(191) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `business_type` varchar(191) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `about_your_business` longtext COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `your_company_website` varchar(191) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `company_authorised` tinyint(1) DEFAULT 1,
  `credit_limit` varchar(191) COLLATE utf8mb4_unicode_ci DEFAULT '0',
  `experian_rating` varchar(191) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `no_other_bank` tinyint(1) DEFAULT NULL,
  `agree` tinyint(1) DEFAULT NULL,
  `turnover` decimal(15,0) DEFAULT NULL,
  `trading_time` tinyint(1) DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `sellers`
--

INSERT INTO `sellers` (`id`, `user_id`, `title`, `first_name`, `last_name`, `dob_incorporation`, `dob`, `job_title`, `phone_code`, `phone`, `company_name`, `company_reg_no`, `building_no`, `address_1`, `address_2`, `address_3`, `town`, `county`, `hear_of_us`, `post_code`, `business_type`, `about_your_business`, `your_company_website`, `company_authorised`, `credit_limit`, `experian_rating`, `no_other_bank`, `agree`, `turnover`, `trading_time`, `created_at`, `updated_at`) VALUES
(16, 338, 'Mr', 'seller', 'faslkj', '2000-12-01', '2001-01-01', 'Xzczxcd', '0313', '+923369981628', 'none', '123456', 'sdafkjadslf', 'fsdf', 'sdfsd', '123', '123', 'Pakistan', 'Billboard', '1200', NULL, 'fasd flkasdfl', 'fsdf', 1, '8000', 'Good', 1, 1, '1222', 1, '2021-06-08 16:30:49', '2021-06-08 17:48:10'),
(17, 340, 'Mr', 'khalid', 'khan', '2021-06-21', '1980-10-04', 'Jhgdfgh', '92', '76567567665', 'nmgfdhg', 'jhgfgf', 'bvgfgh', 'hvfgf', NULL, NULL, 'bbgh', 'gffg', 'Twitter', '92', NULL, 'jhgdfghmkjh', 'bhgdfgjh', 1, '200000', 'Good', 1, 1, '3434', 1, '2021-06-21 13:45:02', '2021-06-23 18:37:44'),
(18, 346, 'Mr', 'Fgff', 'Gfgf', '2019-06-23', '1994-06-14', 'Fgff', '44', '644634764', 'Gfgf', '3434', '4433', '123gdff', NULL, NULL, 'Ggghg', 'Fgg', 'Google', '44454', NULL, 'Fffffdh', 'Dffddgf.com', 1, '20,000', 'Fair', 1, 1, '43454', 1, '2021-06-23 17:53:53', '2021-06-23 18:37:02'),
(19, 346, 'Mr', 'gfg', 'ffd', '2019-12-04', '1990-12-04', 'jfghg', '44', '44545634654', 'hghg', '1162', '15', 'mvbvgh', NULL, NULL, 'hgfghjh', NULL, 'Search Engine', '566', NULL, 'hfgjhgghjhgfjh', 'jhgdjklkjhgfdhjjhgfds', 1, '0', NULL, 1, 1, '123445', 1, '2021-06-23 18:33:59', '2021-06-23 18:34:42'),
(20, 352, 'Ms', 'akhan', 'hello', '2021-07-10', '1990-08-01', 'dfvdf', '95', '456456435634', 'cbv cv', 'fvgbnnc', 'gnf', 'gbn', 'nfgh', 'g', 'ghf', 'fghn', 'Newspaper', 'hffnghf', NULL, 'gfghn', 'nfh', 1, '0', NULL, 1, 1, '67565', 1, '2021-07-28 12:02:07', '2021-07-28 12:03:33');

-- --------------------------------------------------------

--
-- Table structure for table `site_faqs`
--

CREATE TABLE `site_faqs` (
  `id` int(10) UNSIGNED NOT NULL,
  `title` text COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `content` longtext COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `site_faqs`
--

INSERT INTO `site_faqs` (`id`, `title`, `content`, `created_at`, `updated_at`) VALUES
(2, 'Coming Soon', '<p>We will soon provide a list of common FAQ\'s<br>\r\n</p>', '2018-11-16 13:29:43', '2021-07-07 12:13:06');

-- --------------------------------------------------------

--
-- Table structure for table `site_pages`
--

CREATE TABLE `site_pages` (
  `id` int(10) UNSIGNED NOT NULL,
  `title` text COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `slug` char(191) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `content` longtext COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `site_pages`
--

INSERT INTO `site_pages` (`id`, `title`, `slug`, `content`, `created_at`, `updated_at`) VALUES
(1, 'DISCLAIMER', 'disclaimer', NULL, '2018-11-16 13:29:43', '2021-07-07 12:14:05'),
(2, 'TERMS OF SERVICE', 'terms', NULL, '2018-11-16 13:29:43', '2021-07-07 12:14:30'),
(3, 'PRIVACY POLICY', 'privacy', NULL, '2018-11-16 13:29:43', '2021-07-07 12:14:46'),
(4, 'CONTACT US', 'contact', '5beec647651e9', '2018-11-16 13:29:43', '2018-11-16 13:29:43'),
(5, 'WHO WE ARE', 'who-we-are', '<h2 style=\"box-sizing: border-box; margin: 0px 0px 10px; color: rgb(33, 37, 41); padding: 0px;\">What is Lorem Ipsum?</h2>\r\n\r\n<p ,=\"\" arial,=\"\" sans-serif;\"=\"\" style=\"box-sizing: border-box; margin: 0px 0px 1rem; color: rgb(33, 37, 41); padding: 0px; text-align: justify;\"><span id=\"pastemarkerend\" style=\"box-sizing: border-box;\">We’ve innovated invoice financing.  We’ve repurposed a tried and tested business funding\r\noption to provide financial inclusivity for all.<span id=\"pastemarkerend\"> </span> <span id=\"pastemarkerend\"> </span></span></p>', '2018-11-16 13:29:43', '2020-07-23 17:02:28'),
(6, 'HOW IT WORKS', 'how-it-works', NULL, '2018-11-16 13:29:43', '2021-07-07 12:15:07'),
(7, 'Creating an auction', 'create-auction-info', 'create-auction-info create-auction-info', NULL, NULL);

-- --------------------------------------------------------

--
-- Table structure for table `transactions`
--

CREATE TABLE `transactions` (
  `id` int(10) UNSIGNED NOT NULL,
  `reference` varchar(191) COLLATE utf8mb4_unicode_ci NOT NULL DEFAULT '0',
  `user_id` int(10) UNSIGNED NOT NULL,
  `amount` decimal(65,2) NOT NULL,
  `new_balance` decimal(65,2) DEFAULT NULL,
  `description` varchar(191) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `type` varchar(191) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `auction_id` int(11) DEFAULT NULL,
  `status` varchar(191) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `remarks` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `confirmed` tinyint(4) NOT NULL DEFAULT 0,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  `deleted_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `transactions`
--

INSERT INTO `transactions` (`id`, `reference`, `user_id`, `amount`, `new_balance`, `description`, `type`, `auction_id`, `status`, `remarks`, `confirmed`, `created_at`, `updated_at`, `deleted_at`) VALUES
(252, 'ia_339_1623194135', 339, '500.00', '47500.00', 'none Investment', 'debit', 51, 'Complete', 'Investment', 1, '2021-06-08 18:15:36', '2021-06-08 18:15:36', NULL),
(253, 'FundingJoint 1_1623194136', 1, '500.00', '500.00', 'none Investment', 'credit', 51, 'Complete', 'Investment', 1, '2021-06-08 18:15:36', '2021-06-08 18:15:36', NULL),
(254, 'ia_339_1624441980', 339, '20.00', '0.00', 'Added to my Wallet', 'credit', NULL, 'Complete', '', 1, '2021-06-23 09:53:51', '2021-06-23 12:25:52', NULL),
(255, 'ia_339_1624456500', 339, '520.00', '0.00', 'none Investment', 'debit', 53, 'Complete', 'Investment', 1, '2021-06-23 13:55:00', '2021-06-23 13:55:00', NULL),
(256, 'FundingJoint 1_1624456500', 1, '520.00', '520.00', 'none Investment', 'credit', 53, 'Complete', 'Investment', 1, '2021-06-23 13:55:00', '2021-06-23 13:55:00', NULL),
(257, 'ia_339_1624532204', 339, '10.00', '510.00', 'none Investment', 'debit', 53, 'Complete', 'Investment', 1, '2021-06-24 10:56:44', '2021-06-24 10:56:44', NULL),
(258, 'ia_339_1624532339', 339, '140.00', '370.00', 'none Investment', 'debit', 53, 'Complete', 'Investment', 1, '2021-06-24 10:59:00', '2021-06-24 10:59:00', NULL),
(259, 'ia_339_1624534502', 339, '170.00', '200.00', 'none Investment', 'debit', 53, 'Complete', 'Investment', 1, '2021-06-24 11:35:02', '2021-06-24 11:35:02', NULL),
(260, 'IA_347_1624665207', 347, '2000.00', NULL, 'Added to my Wallet', 'credit', NULL, 'Decline', '', 0, '2021-06-25 23:54:12', '2021-06-25 23:55:00', NULL),
(261, 'IA_347_1624665627', 347, '2000.00', '0.00', 'Added to my Wallet', 'credit', NULL, 'Complete', '', 1, '2021-06-26 00:00:39', '2021-06-26 00:00:50', NULL),
(262, 'IA_347_1624665729', 347, '680.03', '1319.97', 'none Investment', 'debit', 53, 'Complete', 'Investment', 1, '2021-06-26 00:02:09', '2021-06-26 00:02:09', NULL),
(263, 'FundingJoint 1_1624665729', 1, '680.03', '680.03', 'none Investment', 'credit', 53, 'Complete', 'Investment', 1, '2021-06-26 00:02:09', '2021-06-26 00:02:09', NULL),
(264, 'IA_347_1624666302', 347, '0.00', '680.03', 'none Investment', 'debit', 53, 'Complete', 'Investment', 1, '2021-06-26 00:11:42', '2021-06-26 00:11:42', NULL),
(265, 'IA_347_1624667474', 347, '0.00', '680.03', 'none Investment', 'debit', 53, 'Complete', 'Investment', 1, '2021-06-26 00:31:14', '2021-06-26 00:31:14', NULL),
(266, 'IA_347_1624667482', 347, '0.00', '680.03', 'none Investment', 'debit', 53, 'Complete', 'Investment', 1, '2021-06-26 00:31:22', '2021-06-26 00:31:22', NULL),
(267, 'IA_347_1624893509', 347, '19.97', '660.06', 'none Investment', 'debit', 53, 'Complete', 'Investment', 1, '2021-06-28 15:18:29', '2021-06-28 15:18:29', NULL),
(268, 'IA_347_1624970588', 347, '200.00', '460.06', 'nmgfdhg Investment', 'debit', 61, 'Complete', 'Investment', 1, '2021-06-29 12:43:09', '2021-06-29 12:43:09', NULL),
(269, 'FundingJoint 1_1624970588', 1, '200.00', '200.00', 'nmgfdhg Investment', 'credit', 61, 'Complete', 'Investment', 1, '2021-06-29 12:43:09', '2021-06-29 12:43:09', NULL),
(270, 'IA_347_1624970853', 347, '100.00', '100.00', 'nmgfdhg Investment', 'debit', 61, 'Complete', 'Investment', 1, '2021-06-29 12:47:33', '2021-06-29 12:47:33', NULL),
(271, 'IA_347_1624979805', 347, '10.00', '90.00', 'nmgfdhg Investment', 'debit', 61, 'Complete', 'Investment', 1, '2021-06-29 15:16:45', '2021-06-29 15:16:45', NULL),
(272, 'IA_347_1624979835', 347, '1.00', '89.00', 'nmgfdhg Investment', 'debit', 61, 'Complete', 'Investment', 1, '2021-06-29 15:17:15', '2021-06-29 15:17:15', NULL),
(273, 'IA_347_1624980092', 347, '0.00', '89.00', 'nmgfdhg Investment', 'debit', 61, 'Complete', 'Investment', 1, '2021-06-29 15:21:32', '2021-06-29 15:21:32', NULL),
(274, 'IA_347_1624980665', 347, '2000.00', '0.00', 'Added to my Wallet', 'credit', NULL, 'Complete', '', 1, '2021-06-29 15:31:25', '2021-06-29 15:31:39', NULL),
(275, 'IA_347_1624980835', 347, '1000.00', '0.00', 'Added to my Wallet', 'credit', NULL, 'Complete', '', 1, '2021-06-29 15:34:34', '2021-06-29 15:35:15', NULL),
(276, 'IA_347_1624981046', 347, '0.00', '3089.00', 'nmgfdhg Investment', 'debit', 61, 'Complete', 'Investment', 1, '2021-06-29 15:37:26', '2021-06-29 15:37:26', NULL),
(277, 'IA_347_1624981057', 347, '0.00', '3089.00', 'nmgfdhg Investment', 'debit', 61, 'Complete', 'Investment', 1, '2021-06-29 15:37:37', '2021-06-29 15:37:37', NULL),
(278, 'IA_347_1624981196', 347, '9.00', '3080.00', 'nmgfdhg Investment', 'debit', 61, 'Complete', 'Investment', 1, '2021-06-29 15:39:56', '2021-06-29 15:39:56', NULL),
(279, 'IA_347_1624981258', 347, '10000.00', '0.00', 'Added to my Wallet', 'credit', NULL, 'Complete', '', 1, '2021-06-29 15:41:06', '2021-06-29 15:41:21', NULL),
(280, 'IA_347_1624981511', 347, '7780.00', '5300.00', 'nmgfdhg Investment', 'debit', 61, 'Complete', 'Investment', 1, '2021-06-29 15:45:11', '2021-06-29 15:45:11', NULL),
(281, 'ia_339_1625057846', 339, '10000.00', '0.00', 'Added to my Wallet', 'credit', NULL, 'Complete', '', 1, '2021-06-30 12:57:49', '2021-06-30 12:59:38', NULL),
(282, 'ia_339_1625058733', 339, '4500.00', '5700.00', 'nmgfdhg Investment', 'debit', 66, 'Complete', 'Investment', 1, '2021-06-30 13:12:13', '2021-06-30 13:12:13', NULL),
(283, 'FundingJoint 1_1625058733', 1, '4500.00', '4500.00', 'nmgfdhg Investment', 'credit', 66, 'Complete', 'Investment', 1, '2021-06-30 13:12:13', '2021-06-30 13:12:13', NULL),
(284, 'IA_347_1625241032', 347, '20000.00', '0.00', 'Added to my Wallet', 'credit', NULL, 'Complete', '', 1, '2021-07-02 15:50:49', '2021-07-02 16:07:04', NULL),
(285, 'IA_347_1625242084', 347, '7621.00', '17679.00', 'nmgfdhg Investment', 'debit', 63, 'Complete', 'Investment', 1, '2021-07-02 16:08:04', '2021-07-02 16:08:04', NULL),
(286, 'FundingJoint 1_1625242084', 1, '7621.00', '7621.00', 'nmgfdhg Investment', 'credit', 63, 'Complete', 'Investment', 1, '2021-07-02 16:08:04', '2021-07-02 16:08:04', NULL),
(287, 'ia_339_1625294738', 339, '4500.00', '0.00', 'nmgfdhg Investment', 'debit', 64, 'Complete', 'Investment', 1, '2021-07-03 06:45:38', '2021-07-03 06:45:38', NULL),
(288, 'FundingJoint 1_1625294738', 1, '4500.00', '4500.00', 'nmgfdhg Investment', 'credit', 64, 'Complete', 'Investment', 1, '2021-07-03 06:45:38', '2021-07-03 06:45:38', NULL),
(289, 'ia_339_1625294949', 339, '578.00', '3922.00', 'nmgfdhg Investment', 'debit', 62, 'Complete', 'Investment', 1, '2021-07-03 06:49:09', '2021-07-03 06:49:09', NULL),
(290, 'FundingJoint 1_1625294949', 1, '578.00', '578.00', 'nmgfdhg Investment', 'credit', 62, 'Complete', 'Investment', 1, '2021-07-03 06:49:09', '2021-07-03 06:49:09', NULL),
(291, 'FG_346_1625456715', 346, '15.00', '0.00', 'jhddklkjhgfdjkjhgf', 'debit', NULL, 'Complete', NULL, 1, '2021-07-05 03:46:01', '2021-07-05 03:46:01', NULL),
(292, 'ia_339_1625460105', 339, '578.00', '0.00', 'nmgfdhg Investment', 'debit', 66, 'Complete', 'Investment', 1, '2021-07-05 04:41:45', '2021-07-05 04:41:45', NULL),
(293, 'ia_339_1625460124', 339, '20.00', '0.00', 'Added to my Wallet', 'credit', NULL, 'Complete', '', 1, '2021-07-05 04:42:46', '2021-07-05 04:44:17', NULL),
(294, 'ia_339_1625460166', 339, '45000.00', '0.00', 'Added to my Wallet', 'credit', NULL, 'Complete', '', 1, '2021-07-05 04:43:15', '2021-07-05 04:44:13', NULL),
(295, 'ia_339_1625461207', 339, '45000.00', '20.00', 'Gfgf Investment', 'debit', 69, 'Complete', 'Investment', 1, '2021-07-05 05:00:07', '2021-07-05 05:00:07', NULL),
(296, 'FundingJoint 1_1625461207', 1, '45000.00', '45000.00', 'Gfgf Investment', 'credit', 69, 'Complete', 'Investment', 1, '2021-07-05 05:00:07', '2021-07-05 05:00:07', NULL),
(297, 'FG_346_1625461437', 346, '39154.00', '0.00', 'nmnvbnbv', NULL, 69, 'Complete', NULL, 1, '2021-07-05 05:04:27', '2021-07-05 05:04:27', NULL),
(298, 'ia_339_1625482246', 339, '840.00', '0.00', 'Withdrawal', 'debit', NULL, 'Complete', 'Withdrawal', 1, '2021-07-05 10:51:37', '2021-07-05 10:54:17', NULL),
(299, 'IA_347_1625499773', 347, '7621.00', '0.00', 'Gfgf Investment', 'debit', 67, 'Complete', 'Investment', 1, '2021-07-05 15:42:53', '2021-07-05 15:42:53', NULL),
(300, 'FundingJoint 1_1625499773', 1, '7621.00', '7621.00', 'Gfgf Investment', 'credit', 67, 'Complete', 'Investment', 1, '2021-07-05 15:42:53', '2021-07-05 15:42:53', NULL),
(301, 'IA_347_1625499834', 347, '1000.00', '6621.00', 'nmgfdhg Investment', 'debit', 66, 'Complete', 'Investment', 1, '2021-07-05 15:43:54', '2021-07-05 15:43:54', NULL),
(302, 'FundingJoint 1_1625499834', 1, '1000.00', '1000.00', 'nmgfdhg Investment', 'credit', 66, 'Complete', 'Investment', 1, '2021-07-05 15:43:54', '2021-07-05 15:43:54', NULL),
(303, 'IA_347_1625501737', 347, '1.00', '999.00', 'Gfgf Investment', 'debit', 67, 'Complete', 'Investment', 1, '2021-07-05 16:15:37', '2021-07-05 16:15:37', NULL),
(304, 'IA_347_1625502387', 347, '9000.00', '9999.00', 'Added to my Wallet', 'credit', NULL, 'Complete', '', 1, '2021-07-05 16:26:37', '2021-07-05 16:26:44', NULL),
(305, 'ia_339_1625673394', 339, '4160.00', '40000.00', 'nmgfdhg Investment', 'debit', 70, 'Complete', 'Investment', 1, '2021-07-07 15:56:34', '2021-07-07 15:56:34', NULL),
(306, 'FundingJoint 1_1625673394', 1, '4160.00', '4160.00', 'nmgfdhg Investment', 'credit', 70, 'Complete', 'Investment', 1, '2021-07-07 15:56:34', '2021-07-07 15:56:34', NULL),
(307, 'IA_347_1625674438', 347, '999.00', '9000.00', 'nmgfdhg Investment', 'debit', 70, 'Complete', 'Investment', 1, '2021-07-07 16:13:58', '2021-07-07 16:13:58', NULL),
(308, 'FundingJoint 1_1625674438', 1, '999.00', '999.00', 'nmgfdhg Investment', 'credit', 70, 'Complete', 'Investment', 1, '2021-07-07 16:13:58', '2021-07-07 16:13:58', NULL),
(309, 'IA_347_1625843957', 347, '900.00', '999.00', 'nmgfdhg Investment', 'debit', 75, 'Complete', 'Investment', 1, '2021-07-09 15:19:17', '2021-07-09 15:19:17', NULL),
(310, 'FundingJoint 1_1625843957', 1, '900.00', '900.00', 'nmgfdhg Investment', 'credit', 75, 'Complete', 'Investment', 1, '2021-07-09 15:19:17', '2021-07-09 15:19:17', NULL),
(311, 'ia_339_1625856071', 339, '520.00', '4160.00', 'nmgfdhg Investment', 'debit', 75, 'Complete', 'Investment', 1, '2021-07-09 18:41:11', '2021-07-09 18:41:11', NULL),
(312, 'FundingJoint 1_1625856071', 1, '520.00', '520.00', 'nmgfdhg Investment', 'credit', 75, 'Complete', 'Investment', 1, '2021-07-09 18:41:11', '2021-07-09 18:41:11', NULL),
(313, 'ia_339_1625856966', 339, '300.00', '520.00', 'Gfgf Investment', 'debit', 76, 'Complete', 'Investment', 1, '2021-07-09 18:56:06', '2021-07-09 18:56:06', NULL),
(314, 'FundingJoint 1_1625856966', 1, '300.00', '300.00', 'Gfgf Investment', 'credit', 76, 'Complete', 'Investment', 1, '2021-07-09 18:56:06', '2021-07-09 18:56:06', NULL),
(315, 'FG_346_1625857101', 346, '300.00', '0.00', 'mbhbjnb', 'debit', 76, 'Complete', NULL, 1, '2021-07-09 18:58:46', '2021-07-09 18:58:46', NULL),
(316, 'IA_347_1625858605', 347, '40000.00', '40900.00', 'Added to my Wallet', 'credit', NULL, 'Complete', '', 1, '2021-07-09 19:23:40', '2021-07-09 19:24:10', NULL),
(317, 'IA_347_1626017051', 347, '5000.00', '40900.00', 'nmgfdhg Investment', 'debit', 77, 'Complete', 'Investment', 1, '2021-07-11 15:24:11', '2021-07-11 15:24:11', NULL),
(318, 'FundingJoint 1_1626017051', 1, '5000.00', '5000.00', 'nmgfdhg Investment', 'credit', 77, 'Complete', 'Investment', 1, '2021-07-11 15:24:11', '2021-07-11 15:24:11', NULL),
(319, 'IA_347_1626083320', 347, '1500.00', '5000.00', 'nmgfdhg Investment', 'debit', 84, 'Complete', 'Investment', 1, '2021-07-12 09:48:40', '2021-07-12 09:48:40', NULL),
(320, 'FundingJoint 1_1626083320', 1, '1500.00', '1500.00', 'nmgfdhg Investment', 'credit', 84, 'Complete', 'Investment', 1, '2021-07-12 09:48:40', '2021-07-12 09:48:40', NULL),
(321, 'ia_339_1626113139', 339, '670.00', '0.00', 'kgjkjhgb', 'debit', 51, 'Complete', NULL, 1, '2021-07-12 18:06:03', '2021-07-12 18:06:03', NULL),
(322, 'ia_339_1626177645', 339, '45000.00', '45000.00', 'Added to my Wallet', 'credit', NULL, 'Complete', '', 1, '2021-07-13 12:01:10', '2021-07-13 12:03:27', NULL),
(323, 'ia_339_1626178445', 339, '45000.00', '45000.00', 'nmgfdhg Investment', 'debit', 85, 'Complete', 'Investment', 1, '2021-07-13 12:14:05', '2021-07-13 12:14:05', NULL),
(324, 'FundingJoint 1_1626178445', 1, '45000.00', '45000.00', 'nmgfdhg Investment', 'credit', 85, 'Complete', 'Investment', 1, '2021-07-13 12:14:05', '2021-07-13 12:14:05', NULL),
(325, 'kk_340_1626178582', 340, '45000.00', '0.00', 'jhgfdghjhgfgh', 'debit', 85, 'Complete', NULL, 1, '2021-07-13 12:16:53', '2021-07-13 12:16:53', NULL),
(326, 'ia_339_1626196594', 339, '45000.00', '45000.00', 'Added to my Wallet', 'credit', NULL, 'Complete', '', 1, '2021-07-13 17:17:15', '2021-07-13 17:20:57', NULL),
(327, 'ia_339_1626197251', 339, '6570.00', '45000.00', 'nmgfdhg Investment', 'debit', 84, 'Complete', 'Investment', 1, '2021-07-13 17:27:31', '2021-07-13 17:27:31', NULL),
(328, 'FundingJoint 1_1626197251', 1, '6570.00', '51570.00', 'nmgfdhg Investment', 'credit', 84, 'Complete', 'Investment', 1, '2021-07-13 17:27:31', '2021-07-13 17:27:31', NULL),
(329, 'IA_347_1626279772', 347, '60000.00', '61500.00', 'Added to my Wallet', 'credit', NULL, 'Complete', '', 1, '2021-07-14 16:23:06', '2021-07-14 16:24:32', NULL),
(330, 'IA_347_1626279936', 347, '3000.00', '61500.00', 'nmgfdhg Investment', 'debit', 83, 'Complete', 'Investment', 1, '2021-07-14 16:25:36', '2021-07-14 16:25:36', NULL),
(331, 'FundingJoint 1_1626279936', 1, '3000.00', '54570.00', 'nmgfdhg Investment', 'credit', 83, 'Complete', 'Investment', 1, '2021-07-14 16:25:36', '2021-07-14 16:25:36', NULL),
(332, 'IA_347_1626595790', 347, '750.00', '58500.00', 'nmgfdhg Investment', 'debit', 82, 'Complete', 'Investment', 1, '2021-07-18 08:09:50', '2021-07-18 08:09:50', NULL),
(333, 'FundingJoint 1_1626595790', 1, '750.00', '55320.00', 'nmgfdhg Investment', 'credit', 82, 'Complete', 'Investment', 1, '2021-07-18 08:09:50', '2021-07-18 08:09:50', NULL),
(334, 'IA_347_1626689021', 347, '800.00', '57750.00', 'nmgfdhg Investment', 'debit', 81, 'Complete', 'Investment', 1, '2021-07-19 10:03:41', '2021-07-19 10:03:41', NULL),
(335, 'FundingJoint 1_1626689021', 1, '800.00', '56120.00', 'nmgfdhg Investment', 'credit', 81, 'Complete', 'Investment', 1, '2021-07-19 10:03:41', '2021-07-19 10:03:41', NULL),
(336, 'IA_347_1626692233', 347, '150.00', '56800.00', 'nmgfdhg Investment', 'debit', 81, 'Complete', 'Investment', 1, '2021-07-19 10:57:13', '2021-07-19 10:57:13', NULL),
(337, 'IA_347_1626710826', 347, '750.00', '56800.00', 'nmgfdhg Investment', 'debit', 86, 'Complete', 'Investment', 1, '2021-07-19 16:07:06', '2021-07-19 16:07:06', NULL),
(338, 'FundingJoint 1_1626710826', 1, '750.00', '56870.00', 'nmgfdhg Investment', 'credit', 86, 'Complete', 'Investment', 1, '2021-07-19 16:07:06', '2021-07-19 16:07:06', NULL),
(339, 'IA_347_1626710999', 347, '50.00', '56000.00', 'nmgfdhg Investment', 'debit', 86, 'Complete', 'Investment', 1, '2021-07-19 16:09:59', '2021-07-19 16:09:59', NULL),
(340, 'ia_339_1626711262', 339, '750.00', '38430.00', 'nmgfdhg Investment', 'debit', 86, 'Complete', 'Investment', 1, '2021-07-19 16:14:22', '2021-07-19 16:14:22', NULL),
(341, 'FundingJoint 1_1626711262', 1, '750.00', '57620.00', 'nmgfdhg Investment', 'credit', 86, 'Complete', 'Investment', 1, '2021-07-19 16:14:22', '2021-07-19 16:14:22', NULL),
(342, 'FI_351_1626712448', 351, '40000.00', '40000.00', 'Added to my Wallet', 'credit', NULL, 'Complete', '', 1, '2021-07-19 16:34:17', '2021-07-19 16:34:28', NULL),
(343, 'FI_351_1626712528', 351, '3000.00', '40000.00', 'nmgfdhg Investment', 'debit', 86, 'Complete', 'Investment', 1, '2021-07-19 16:35:28', '2021-07-19 16:35:28', NULL),
(344, 'FundingJoint 1_1626712528', 1, '3000.00', '60620.00', 'nmgfdhg Investment', 'credit', 86, 'Complete', 'Investment', 1, '2021-07-19 16:35:28', '2021-07-19 16:35:28', NULL),
(345, 'IA_347_1626797361', 347, '750.00', '56000.00', 'nmgfdhg Investment', 'debit', 89, 'Complete', 'Investment', 1, '2021-07-20 16:09:21', '2021-07-20 16:09:21', NULL),
(346, 'FundingJoint 1_1626797361', 1, '750.00', '61370.00', 'nmgfdhg Investment', 'credit', 89, 'Complete', 'Investment', 1, '2021-07-20 16:09:21', '2021-07-20 16:09:21', NULL),
(347, 'IA_347_1626797803', 347, '50.00', '55200.00', 'nmgfdhg Investment', 'debit', 89, 'Complete', 'Investment', 1, '2021-07-20 16:16:43', '2021-07-20 16:16:43', NULL),
(348, 'IA_347_1626797869', 347, '0.00', '55200.00', 'nmgfdhg Investment', 'debit', 89, 'Complete', 'Investment', 1, '2021-07-20 16:17:49', '2021-07-20 16:17:49', NULL),
(349, 'IA_347_1626797884', 347, '0.00', '55200.00', 'nmgfdhg Investment', 'debit', 89, 'Complete', 'Investment', 1, '2021-07-20 16:18:04', '2021-07-20 16:18:04', NULL),
(350, 'IA_347_1626797895', 347, '0.00', '55200.00', 'nmgfdhg Investment', 'debit', 89, 'Complete', 'Investment', 1, '2021-07-20 16:18:15', '2021-07-20 16:18:15', NULL),
(351, 'ia_339_1626798306', 339, '750.00', '37680.00', 'nmgfdhg Investment', 'debit', 89, 'Complete', 'Investment', 1, '2021-07-20 16:25:06', '2021-07-20 16:25:06', NULL),
(352, 'FundingJoint 1_1626798306', 1, '750.00', '62120.00', 'nmgfdhg Investment', 'credit', 89, 'Complete', 'Investment', 1, '2021-07-20 16:25:06', '2021-07-20 16:25:06', NULL),
(353, 'FI_351_1626798389', 351, '950.00', '37000.00', 'nmgfdhg Investment', 'debit', 89, 'Complete', 'Investment', 1, '2021-07-20 16:26:29', '2021-07-20 16:26:29', NULL),
(354, 'FundingJoint 1_1626798389', 1, '950.00', '63070.00', 'nmgfdhg Investment', 'credit', 89, 'Complete', 'Investment', 1, '2021-07-20 16:26:29', '2021-07-20 16:26:29', NULL),
(355, 'FI_351_1626798846', 351, '750.00', '36050.00', 'nmgfdhg Investment', 'debit', 88, 'Complete', 'Investment', 1, '2021-07-20 16:34:06', '2021-07-20 16:34:06', NULL),
(356, 'FundingJoint 1_1626798846', 1, '750.00', '63820.00', 'nmgfdhg Investment', 'credit', 88, 'Complete', 'Investment', 1, '2021-07-20 16:34:06', '2021-07-20 16:34:06', NULL),
(357, 'FI_351_1626868755', 351, '1000.00', '36300.00', 'Added to my Wallet', 'credit', NULL, 'Complete', '', 1, '2021-07-21 12:34:47', '2021-07-21 12:35:28', NULL),
(358, 'FI_351_1626871722', 351, '50.00', '32500.00', 'nmgfdhg Investment', 'debit', 87, 'Complete', 'Investment', 1, '2021-07-21 12:48:42', '2021-07-21 12:48:42', NULL),
(359, 'FI_351_1626871781', 351, '50.00', '32450.00', 'nmgfdhg Investment', 'debit', 88, 'Complete', 'Investment', 1, '2021-07-21 12:49:41', '2021-07-21 12:49:41', NULL),
(360, 'FI_351_1626873790', 351, '0.00', '32450.00', 'nmgfdhg Investment', 'debit', 88, 'Complete', 'Investment', 1, '2021-07-21 13:23:10', '2021-07-21 13:23:10', NULL),
(361, 'FI_351_1626949764', 351, '450.00', '32000.00', 'Withdrawal', 'debit', NULL, 'Complete', 'Withdrawal', 1, '2021-07-22 10:29:50', '2021-07-22 10:30:01', NULL),
(362, 'FI_351_1626950067', 351, '100.00', '31900.00', 'Withdrawal', 'debit', NULL, 'Complete', 'Withdrawal', 1, '2021-07-22 10:36:38', '2021-07-22 10:36:57', NULL),
(363, 'FI_351_1626950240', 351, '100.00', '31800.00', 'Withdrawal', 'debit', NULL, 'Complete', 'Withdrawal', 1, '2021-07-22 10:37:28', '2021-07-22 10:37:36', NULL),
(364, 'FI_351_1626950262', 351, '100.00', '31500.00', 'Withdrawal', 'debit', NULL, 'Complete', 'Withdrawal', 1, '2021-07-22 11:36:20', '2021-07-22 12:14:19', NULL),
(365, 'FI_351_1626956245', 351, '500.00', '32000.00', 'Added to my Wallet', 'credit', NULL, 'Complete', '', 1, '2021-07-22 12:17:42', '2021-07-22 12:17:54', NULL),
(366, 'IA_347_1626957086', 347, '750.00', '54450.00', 'nmgfdhg Investment', 'debit', 88, 'Complete', 'Investment', 1, '2021-07-22 12:31:26', '2021-07-22 12:31:26', NULL),
(367, 'FundingJoint 1_1626957086', 1, '750.00', '64570.00', 'nmgfdhg Investment', 'credit', 88, 'Complete', 'Investment', 1, '2021-07-22 12:31:26', '2021-07-22 12:31:26', NULL),
(368, 'IA_347_1626962907', 347, '100.00', '54350.00', 'nmgfdhg Investment', 'debit', 86, 'Complete', 'Investment', 1, '2021-07-22 14:08:27', '2021-07-22 14:08:27', NULL),
(369, 'IA_347_1626962910', 347, '200.00', '54550.00', 'Added to my Wallet', 'credit', NULL, 'Complete', '', 1, '2021-07-22 14:08:59', '2021-07-22 14:09:35', NULL),
(370, 'IA_347_1626962984', 347, '10001.00', '44499.00', 'Withdrawal', 'debit', NULL, 'Complete', 'Withdrawal', 1, '2021-07-22 14:11:28', '2021-07-22 14:14:00', NULL),
(371, 'IA_347_1626963135', 347, '50.00', '54500.00', 'nmgfdhg Investment', 'debit', 86, 'Complete', 'Investment', 1, '2021-07-22 14:12:15', '2021-07-22 14:12:15', NULL),
(372, 'IA_347_1626963244', 347, '100.00', '44599.00', 'Added to my Wallet', 'credit', NULL, 'Complete', '', 1, '2021-07-22 14:20:25', '2021-07-22 14:20:36', NULL),
(373, 'ia_339_1626972656', 339, '1000.00', '37930.00', 'Added to my Wallet', 'credit', NULL, 'Complete', '', 1, '2021-07-22 16:51:20', '2021-07-22 16:51:42', NULL),
(374, 'ia_339_1626975593', 339, '750.00', '37930.00', 'nmgfdhg Investment', 'debit', 88, 'Complete', 'Investment', 1, '2021-07-22 17:39:53', '2021-07-22 17:39:53', NULL),
(375, 'FundingJoint 1_1626975593', 1, '750.00', '65320.00', 'nmgfdhg Investment', 'credit', 88, 'Complete', 'Investment', 1, '2021-07-22 17:39:53', '2021-07-22 17:39:53', NULL),
(376, 'FI_351_1626996078', 351, '3500.00', '28500.00', 'nmgfdhg Investment', 'debit', 86, 'Complete', 'Investment', 1, '2021-07-22 23:21:18', '2021-07-22 23:21:18', NULL),
(377, 'ia_339_1626996295', 339, '150.00', '37030.00', 'nmgfdhg Investment', 'debit', 86, 'Complete', 'Investment', 1, '2021-07-22 23:24:55', '2021-07-22 23:24:55', NULL),
(378, 'ia_339_1626998578', 339, '750.00', '37030.00', 'nmgfdhg Investment', 'debit', 92, 'Complete', 'Investment', 1, '2021-07-23 00:02:58', '2021-07-23 00:02:58', NULL),
(379, 'FundingJoint 1_1626998578', 1, '750.00', '66070.00', 'nmgfdhg Investment', 'credit', 92, 'Complete', 'Investment', 1, '2021-07-23 00:02:58', '2021-07-23 00:02:58', NULL),
(380, 'IA_347_1627233583', 347, '50.00', '44549.00', 'nmgfdhg Investment', 'debit', 86, 'Complete', 'Investment', 1, '2021-07-25 17:19:43', '2021-07-25 17:19:43', NULL),
(381, 'IA_347_1627253694', 347, '750.00', '44549.00', 'nmgfdhg Investment', 'debit', 91, 'Complete', 'Investment', 1, '2021-07-25 22:54:54', '2021-07-25 22:54:54', NULL),
(382, 'FundingJoint 1_1627253694', 1, '750.00', '66820.00', 'nmgfdhg Investment', 'credit', 91, 'Complete', 'Investment', 1, '2021-07-25 22:54:54', '2021-07-25 22:54:54', NULL),
(383, 'IA_347_1627253919', 347, '50.00', '43749.00', 'nmgfdhg Investment', 'debit', 91, 'Complete', 'Investment', 1, '2021-07-25 22:58:39', '2021-07-25 22:58:39', NULL),
(384, 'FI_351_1627254061', 351, '950.00', '28500.00', 'nmgfdhg Investment', 'debit', 91, 'Complete', 'Investment', 1, '2021-07-25 23:01:01', '2021-07-25 23:01:01', NULL),
(385, 'FundingJoint 1_1627254061', 1, '950.00', '67770.00', 'nmgfdhg Investment', 'credit', 91, 'Complete', 'Investment', 1, '2021-07-25 23:01:01', '2021-07-25 23:01:01', NULL),
(386, 'FI_351_1627255489', 351, '450.00', '28000.00', 'Added to my Wallet', 'credit', NULL, 'Complete', '', 1, '2021-07-25 23:25:06', '2021-07-25 23:26:46', NULL),
(387, 'FI_351_1627317221', 351, '500.00', '28500.00', 'Added to my Wallet', 'credit', NULL, 'Complete', '', 1, '2021-07-26 16:34:18', '2021-07-26 16:34:42', NULL),
(388, 'FI_351_1627317356', 351, '500.00', '28500.00', 'nmgfdhg Investment', 'debit', 92, 'Complete', 'Investment', 1, '2021-07-26 16:35:56', '2021-07-26 16:35:56', NULL),
(389, 'FundingJoint 1_1627317356', 1, '500.00', '68270.00', 'nmgfdhg Investment', 'credit', 92, 'Complete', 'Investment', 1, '2021-07-26 16:35:56', '2021-07-26 16:35:56', NULL),
(390, 'FI_351_1627317431', 351, '1000.00', '29000.00', 'Added to my Wallet', 'credit', NULL, 'Complete', '', 1, '2021-07-26 16:37:40', '2021-07-26 16:37:52', NULL),
(391, 'ia_339_1627334702', 339, '6250.00', '36280.00', 'nmgfdhg Investment', 'debit', 91, 'Complete', 'Investment', 1, '2021-07-26 21:25:02', '2021-07-26 21:25:02', NULL),
(392, 'FundingJoint 1_1627334702', 1, '6250.00', '74520.00', 'nmgfdhg Investment', 'credit', 91, 'Complete', 'Investment', 1, '2021-07-26 21:25:02', '2021-07-26 21:25:02', NULL),
(393, 'ia_339_1627334939', 339, '1000.00', '29030.00', 'Withdrawal', 'debit', NULL, 'Complete', 'Withdrawal', 1, '2021-07-26 21:33:32', '2021-07-26 21:34:04', NULL),
(394, 'ia_339_1627335895', 339, '25.00', '29005.00', 'nmgfdhg Investment', 'debit', 91, 'Complete', 'Investment', 1, '2021-07-26 21:44:55', '2021-07-26 21:44:55', NULL),
(395, 'ia_339_1627340278', 339, '750.00', '28255.00', 'nmgfdhg Investment', 'debit', 90, 'Complete', 'Investment', 1, '2021-07-26 22:57:58', '2021-07-26 22:57:58', NULL),
(396, 'FundingJoint 1_1627340278', 1, '750.00', '75270.00', 'nmgfdhg Investment', 'credit', 90, 'Complete', 'Investment', 1, '2021-07-26 22:57:58', '2021-07-26 22:57:58', NULL),
(397, 'ia_339_1627340366', 339, '100.00', '28905.00', 'nmgfdhg Investment', 'debit', 90, 'Complete', 'Investment', 1, '2021-07-26 22:59:26', '2021-07-26 22:59:26', NULL),
(398, 'FI_351_1627342126', 351, '750.00', '28250.00', 'nmgfdhg Investment', 'debit', 96, 'Complete', 'Investment', 1, '2021-07-26 23:28:46', '2021-07-26 23:28:46', NULL),
(399, 'FundingJoint 1_1627342126', 1, '750.00', '76020.00', 'nmgfdhg Investment', 'credit', 96, 'Complete', 'Investment', 1, '2021-07-26 23:28:46', '2021-07-26 23:28:46', NULL),
(400, 'FI_351_1627342131', 351, '250.00', '28750.00', 'Withdrawal', 'debit', NULL, 'Complete', 'Withdrawal', 1, '2021-07-26 23:37:52', '2021-07-26 23:37:59', NULL),
(401, 'FI_351_1627342847', 351, '750.00', '28000.00', 'nmgfdhg Investment', 'debit', 96, 'Complete', 'Investment', 1, '2021-07-26 23:40:47', '2021-07-26 23:40:47', NULL),
(402, 'FundingJoint 1_1627342847', 1, '750.00', '76770.00', 'nmgfdhg Investment', 'credit', 96, 'Complete', 'Investment', 1, '2021-07-26 23:40:47', '2021-07-26 23:40:47', NULL),
(403, 'FI_351_1627342897', 351, '100.00', '27900.00', 'nmgfdhg Investment', 'debit', 96, 'Complete', 'Investment', 1, '2021-07-26 23:41:37', '2021-07-26 23:41:37', NULL),
(404, 'ia_339_1627437123', 339, '520.00', '28385.00', 'nmgfdhg Investment', 'debit', 96, 'Complete', 'Investment', 1, '2021-07-28 01:52:03', '2021-07-28 01:52:03', NULL),
(405, 'FundingJoint 1_1627437123', 1, '520.00', '77290.00', 'nmgfdhg Investment', 'credit', 96, 'Complete', 'Investment', 1, '2021-07-28 01:52:03', '2021-07-28 01:52:03', NULL),
(406, 'ia_339_1627437310', 339, '300.00', '28085.00', 'Withdrawal', 'debit', NULL, 'Complete', 'Withdrawal', 1, '2021-07-28 01:56:14', '2021-07-28 02:01:03', NULL),
(407, 'ia_339_1627437726', 339, '530.00', '27555.00', 'nmgfdhg Investment', 'debit', 95, 'Complete', 'Investment', 1, '2021-07-28 02:02:06', '2021-07-28 02:02:06', NULL),
(408, 'FundingJoint 1_1627437726', 1, '530.00', '77820.00', 'nmgfdhg Investment', 'credit', 95, 'Complete', 'Investment', 1, '2021-07-28 02:02:06', '2021-07-28 02:02:06', NULL),
(409, 'ia_339_1627439538', 339, '5260.00', '22295.00', 'nmgfdhg Investment', 'debit', 96, 'Complete', 'Investment', 1, '2021-07-28 02:32:18', '2021-07-28 02:32:18', NULL),
(410, 'IA_347_1627525332', 347, '159.00', '43590.00', 'mkjxvbnjmnb', 'debit', 53, 'Complete', NULL, 1, '2021-07-29 02:22:39', '2021-07-29 02:22:39', NULL),
(411, 'IA_347_1627557914', 347, '8150.00', '35440.00', 'nmgfdhg Investment', 'debit', 90, 'Complete', 'Investment', 1, '2021-07-29 11:25:14', '2021-07-29 11:25:14', NULL),
(412, 'FundingJoint 1_1627557914', 1, '8150.00', '85970.00', 'nmgfdhg Investment', 'credit', 90, 'Complete', 'Investment', 1, '2021-07-29 11:25:14', '2021-07-29 11:25:14', NULL),
(413, 'IA_347_1627565955', 347, '8150.00', '43590.00', 'Adjustment', 'credit', 90, 'Complete', NULL, 1, '2021-07-29 13:39:52', '2021-07-29 13:39:52', NULL);

-- --------------------------------------------------------

--
-- Table structure for table `users`
--

CREATE TABLE `users` (
  `id` int(10) UNSIGNED NOT NULL,
  `email` varchar(191) COLLATE utf8mb4_unicode_ci NOT NULL,
  `password` varchar(191) COLLATE utf8mb4_unicode_ci NOT NULL,
  `activation_code` varchar(191) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `status` int(11) NOT NULL DEFAULT 0,
  `user_type` int(11) DEFAULT NULL,
  `approved` tinyint(1) NOT NULL DEFAULT 0,
  `is_completed` int(11) NOT NULL DEFAULT 0,
  `remember_token` varchar(100) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `users`
--

INSERT INTO `users` (`id`, `email`, `password`, `activation_code`, `status`, `user_type`, `approved`, `is_completed`, `remember_token`, `created_at`, `updated_at`) VALUES
(1, 'admin@fundingjoint.com', '$2y$10$wnfyHoSqUprjof2Xyne5jeWrixYebAj.5CTD1H2dwVVGceraI.Pkq', 'activated', 1, 1, 1, 1, 'oFwqnv86F6G8z9r7Jc55txlzii4YM1GQ9WlHyWiZqc9VZlvU0o1t67LXNdDv', '2018-11-16 13:29:42', '2018-11-16 13:29:42'),
(338, 'zaheer4195@gmail.com', '$2y$10$e4eav3QkhG2PF1Mo0U2U/OENyx9IT2k5TtrZhYM0akLobpYwwgWay', 'activated', 1, 2, 1, 1, '5cJu6aKZobMRhG5AW75EwxAsPEf1mlGQU9UsOHtUH9mdwgQMjZlYs1JSkOLe', '2021-06-08 16:08:17', '2021-06-08 16:13:14'),
(339, '34279@iqraisb.edu.pk', '$2y$10$YZxytw2Galt5Z5kbtOsPmekvdpl.qSGehoaEWKIZV1BTapGKI6WLm', 'activated', 1, 3, 1, 1, 'HJcr6SVHSxKsEEwRAtINxrq1PpbbFkbuF43rx7YbGjwVMyXrFdMgA8g8TKA7', '2021-06-08 17:52:07', '2021-06-08 17:57:27'),
(340, 'khalidkhan7408@hotmail.com', '$2y$10$RcQvts9g.vZFTrE0bDbKLOKvi1aBXsFZiTQbf6zAlZwC95NdDJlf6', 'activated', 1, 2, 1, 1, 'EnkZzhA0xtgKQ6IJIzhE6q06gpoUapeIhsVByDwL1DnhioCuofeabtE97qO8', '2021-06-18 11:57:54', '2021-06-23 18:37:50'),
(346, 'shahzebnaseer@hotmail.com', '$2y$10$tTP2ab/uCjMxlvjtOjPgS.0W4UOe13zvAq9rp4G1QBHyx7m4M/KfK', 'activated', 1, 2, 1, 1, 'Vp1McspC3e8ZXVPIETBfm2ksh9RD3BrSdKjYMNYCFafPXSk7BEHiNkbFOx5H', '2021-06-23 17:47:50', '2021-06-24 12:02:33'),
(347, 'khalidkhan7408@gmail.com', '$2y$10$9B9tiFSNkXwcYBc2ULHFcenDOR3QpAaVTdBLS27dUfRBBVauu5phe', 'activated', 1, 3, 1, 1, 'P8il2w43Ni4qWh47ZTJP9IVZEG1cmPg93OvcZt9qmn0Hg5p8jxzs35sm1YWj', '2021-06-25 14:50:43', '2021-06-25 23:47:03'),
(348, 'khalidkhan7408@googlemail.com', '$2y$10$BzNXamIoTMDOURu4muVUTOJkm/rtrrNXD3xKttPmSs3hRKK47xYbK', 'activated', 1, 3, 0, 0, 'eU0p2oKcl4lR925CjtBw5MJp9q80XGWP1TqoRqM4YYBO4VpZgrogpPvexdbW', '2021-06-25 23:28:46', '2021-06-25 23:35:08'),
(351, 'mostwantedpreston@gmail.com', '$2y$10$DKWZewy1AOQK.CaChgqCw.34SPj9FbQUef9vwaFuBgqZDS1DkFtGG', 'activated', 1, 3, 1, 1, 'jHchivbwfV90K8hhgWjyOapPax7VTfMDmKkPqmNqUs5z5lWDYNoLxchcyH2F', '2021-07-19 16:29:17', '2021-07-19 16:33:38'),
(352, 'annisa.khan@ymail.com', '$2y$10$YeZPMohgAX74BF7ktN8Cyuqqh1r0wLJ5TONxRhQhcXY8lYFzfkSrq', 'activated', 1, 2, 0, 1, 'eJgh5bjVLQykBuaA6PNT9bdev2jzpGhZ5zkbOIEZToTP5Fpa3we9NYbLOkdc', '2021-07-28 11:59:44', '2021-07-28 12:42:41'),
(353, 'annisa.khan7443@gmail.com', '$2y$10$3gkuTCLER2qi9XJaBAcppOy/Yhf.fWUOiZ58z02n4roFiH9ZEEY3S', 'activated', 1, 3, 0, 1, 'm97FpJREncJHUe5KIITLhghNtbbPEh7Ikl7PCLoYl80jfsfdSQC27E0k725W', '2021-07-28 12:05:18', '2021-07-28 15:16:01');

-- --------------------------------------------------------

--
-- Table structure for table `user_session`
--

CREATE TABLE `user_session` (
  `id` int(11) NOT NULL,
  `session_id` varchar(255) NOT NULL,
  `created_at` timestamp NOT NULL DEFAULT current_timestamp(),
  `updated_at` timestamp NULL DEFAULT NULL ON UPDATE current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `user_session`
--

INSERT INTO `user_session` (`id`, `session_id`, `created_at`, `updated_at`) VALUES
(26, 'z5wDpgqvioAGlCK1cI7gIqtFnz1GCoYIAnvfVOvt', '2020-10-03 07:17:16', '2020-10-03 07:17:16'),
(27, 'B8G7ysFtrsWWGUGAWe0QeksNNXbXJYNwTw1xr5U1', '2020-10-03 07:17:59', '2020-10-03 07:17:59'),
(28, 'Aq3gGEfeC4zcMydOCw3zkLiBM5lv7q79EwiOryaZ', '2020-10-03 07:18:19', '2020-10-03 07:18:19'),
(29, 'Ei38PexqPGJuAxJ2G1hcPgahnK6H9JBJ3jfHUShi', '2020-10-03 07:30:24', '2020-10-03 07:30:24'),
(30, 'RhBVUg79m0KCut4nm2UUHv58fjQwqvO6O7XhSc5l', '2020-10-03 07:30:37', '2020-10-03 07:30:37'),
(31, 'hSxAL4sj638JLeKFYIpKElSxluWMvWO06pIii89Q', '2020-10-03 07:30:56', '2020-10-03 07:30:56'),
(32, 'hm16lTOXMifoyoZQLWXDlNqGvYPcDtU68rR6lcGj', '2020-10-03 07:31:13', '2020-10-03 07:31:13'),
(33, '4M2lUj3ASWJQpecgFXcghoOnAL7dsNhNnflsVXZB', '2020-10-03 07:31:25', '2020-10-03 07:31:25'),
(34, '8s2kLpAaHnJFcMRHxWeyBEcCTcI8xFRdD8YOqSno', '2020-10-03 07:35:35', '2020-10-03 07:35:35'),
(35, '5eku0422uoynYGJ7hGnlr4IVUWSgkVshrKwz5x2I', '2020-10-03 07:35:51', '2020-10-03 07:35:51'),
(36, 'nad84DAaR6sqHLqqerTjkUMI9a5Lm1Wlg7RqDzwz', '2020-10-03 07:43:12', '2020-10-03 07:43:12'),
(37, 'AD4QBxiwsMgBObyiwzneyneOKgDOYeI0OdiY7Jc7', '2020-10-03 07:44:27', '2020-10-03 07:44:27'),
(38, 'ThfP0Vel3UkaLTpE5NZBWim5DU2WdEbxxX4uXiiV', '2020-10-03 07:44:46', '2020-10-03 07:44:46'),
(39, 'QRCeX9DDJp6AG3sONGx9AcavcR1yWfOn5a1ZUQaL', '2020-10-03 07:46:11', '2020-10-03 07:46:11'),
(40, 'jiS4kuTeOxi0JsgcJuLzRDjUtWRuYlrx8zYFMq6f', '2020-10-03 07:46:52', '2020-10-03 07:46:52'),
(41, 'L08eCCc2tUkqp0YYlnReqrAAL4qQbn90crhLO6gF', '2020-10-03 07:46:58', '2020-10-03 07:46:58'),
(42, 'DJ1eDbOD54q3BqstULQM3wBlLNnBKwKxS4T4Yie7', '2020-10-03 10:46:37', '2020-10-03 10:46:37'),
(43, 'zuCVxrhaQwyr86K0f2RODJbHSUw1PPQnpGdrlup8', '2020-10-06 07:30:39', '2020-10-06 07:30:39'),
(44, 't31B8ZAQOl93nhLWZS39m75NqeWSSnwbGDEpwQgU', '2020-10-06 07:52:35', '2020-10-06 07:52:35'),
(45, 'Ul7yOdKuTtJgc4HGsBH53VB9zraaeWPhCTg0scUC', '2020-10-06 07:53:56', '2020-10-06 07:53:56'),
(46, 'zJVXkngh77bpdfyjbmtMzZu0jAiBXKd4JeTvSBd9', '2020-10-06 08:05:47', '2020-10-06 08:05:47'),
(47, '15U3AIENobUj2auUx41nQaJyX87FzizZh6wbkLXx', '2020-10-06 08:06:10', '2020-10-06 08:06:10'),
(48, '6BpoSD4YEtXLO6bClQyBZPDTSLvHcAk09ik3qday', '2020-10-06 08:07:48', '2020-10-06 08:07:48'),
(49, 'FgqfyXNwFYJBcmMhu4xaLX1GdRIMFXfOD2tyit8x', '2020-10-06 08:09:16', '2020-10-06 08:09:16'),
(50, 'c8o2VLEgYUvHShQlCauYb7BbGxm0elJjl4WMTtxB', '2020-10-06 08:09:31', '2020-10-06 08:09:31'),
(51, 'qxs0weKGnRz7TWTJIoM5bKvslylhKZU6DrV5FkMJ', '2020-10-06 08:21:06', '2020-10-06 08:21:06'),
(52, 'y3rxKjqYqHIrRwUQDqRakdKMAAn3DURSRIMxEMXO', '2020-10-06 09:20:13', '2020-10-06 09:20:13'),
(53, 'BGBQb9S2J8MBBpgqtdSbVPD0N9Dtno5JzmVbgi0Q', '2020-10-06 10:08:40', '2020-10-06 10:08:40'),
(54, 'qs1FqXrgUNqtSLapTNHq99386Vhyuk3ctItlT2XM', '2020-10-06 10:10:21', '2020-10-06 10:10:21'),
(55, 'x0s69iud8nYvvCehn0uFvGJ8MfgMFuaxtWHgpWr8', '2020-10-06 10:12:22', '2020-10-06 10:12:22'),
(56, 'BpMuzcKHi3ENWigEqy08q1BVq5TXafCsGWeJcHqn', '2020-10-06 10:14:00', '2020-10-06 10:14:00'),
(57, '122ejX4NsnYaRfMBi3XNGwGRPCCXjLudwomV3nvV', '2020-10-06 10:19:04', '2020-10-06 10:19:04'),
(58, 'VWt1ob3DmMAjb1zlKcHwclEDrY0aAcgwImDddivP', '2020-10-06 10:19:18', '2020-10-06 10:19:18'),
(59, 'rXfA0NIS18UT3txRrJrPH5oySfEtABVyxPQTs9bS', '2020-10-06 11:01:39', '2020-10-06 11:01:39'),
(60, 'x5y1YPyWCyhQKe781zDvskkPfCsQKVIGUYzNFWF1', '2020-10-06 11:03:19', '2020-10-06 11:03:19'),
(61, 'AIRTHi5DAIRw2gOKFLpvcIZpizjQehIZ2E40pZZL', '2020-10-06 11:03:20', '2020-10-06 11:03:20'),
(62, 'lnHiTr6fvZaQSb8d9QdwqfZqendYv2XLA9PZVZUb', '2020-10-06 11:03:39', '2020-10-06 11:03:39'),
(63, 'wyDcr5CeSdnh5NSg9Gq6EFWNH0Um5mOK3mDUAV0s', '2020-10-06 11:05:15', '2020-10-06 11:05:15'),
(64, 'g0cMo73DjEYBOKAomjarhRGG1GQtwZmk2mpflLnR', '2020-10-06 11:08:04', '2020-10-06 11:08:04'),
(65, 'WelscCttfVWIxEWLzAY2T7cPfzOCLQjdDxDLFBfI', '2020-10-06 11:09:06', '2020-10-06 11:09:06'),
(66, 'Vwc75laMLvWZmcqCTXe5MKaoqqYUWV668PcjXYE8', '2020-10-06 11:10:04', '2020-10-06 11:10:04'),
(67, 'ECziPuuKA3VdTxGzIhr9QLK5DDgWETIlIFLWI2Mx', '2020-10-06 11:12:32', '2020-10-06 11:12:32'),
(68, 'ShHvod7cHxQGff7cdXXgV0zTFnTEPz20HvrZfBSG', '2020-10-06 11:17:06', '2020-10-06 11:17:06'),
(69, '2ZmLAOMm8vUquhr7GIxOuZYJSGnqgeZZJk2W0D7U', '2020-10-06 11:18:03', '2020-10-06 11:18:03'),
(70, 'f38QMK9gFS5GhcNNKTnZaiaeXiKnMTZRFU0EH9ig', '2020-10-06 11:20:37', '2020-10-06 11:20:37'),
(71, 'VsgKhtTspXngBIZZGG2WOTsXCFoyj2YcpKOZZ4lA', '2020-10-06 11:20:45', '2020-10-06 11:20:45'),
(72, 'HVPLRVPd6BKNJSoM9l8g7MJ2mANoPuYigmHtvpr1', '2020-10-06 11:20:58', '2020-10-06 11:20:58'),
(73, 'mPk7X7kPH0h2LuFhqhBbuVCb5vHwHC0WE9OXSVc9', '2020-10-06 11:29:54', '2020-10-06 11:29:54'),
(74, 'qmMuDdjxy5lgeWxQgqH4OdcbFX3jWlqX5ZOq3KE3', '2020-10-06 11:45:25', '2020-10-06 11:45:25'),
(75, 'xLKzhBuy6xW6ee5xwWR77zPHCoxoXrYveNVkJ8FL', '2020-10-06 12:07:15', '2020-10-06 12:07:15'),
(76, 'WJxFeKD46kb3KbiDcPGqadL4hWPSRqalVMLRmJmy', '2020-10-06 12:09:52', '2020-10-06 12:09:52'),
(77, '2GUSNtkPDa0saCmorzIRiOgPPRrGZsuAoT43f0pH', '2020-10-06 12:31:17', '2020-10-06 12:31:17'),
(78, 'tqzQ5oXQCxsjYAs00cvXEUQRtK06AAtFQlbmEkkT', '2020-10-06 12:36:51', '2020-10-06 12:36:51'),
(79, 'A1RRrejG0wVZA1hSasqdfOI8xjkppBgimpHMMctJ', '2020-10-07 06:18:01', '2020-10-07 06:18:01'),
(80, 'lMJV8B3LKM3xbrSg4SJZwAIp5VzeZdpdBhS1MUob', '2020-10-07 06:47:34', '2020-10-07 06:47:34'),
(81, '1fBGeN6LlLUn06RGes9xVhNKPSQfK2RgP6RXqGT9', '2020-10-07 22:21:27', '2020-10-07 22:21:27'),
(82, 'oGsUrMMlZ5zOxqdQno15cltZDCb9j0ob1pnFcwpR', '2020-10-08 13:56:12', '2020-10-08 13:56:12'),
(83, 'JxEJbSXa46KXQjO2hKFslxPWydwCOz1OxKbict5D', '2020-10-08 15:07:43', '2020-10-08 15:07:43'),
(84, 'mbJOvwCimO9eA9GGjOPGDeBxLDSk8D60sIoBWP6F', '2020-10-09 16:25:48', '2020-10-09 16:25:48'),
(85, 'sfzgw9ktYpkaKCHhyQlMLbHHjcDh5SCJNTxrsWpP', '2020-10-13 05:07:57', '2020-10-13 05:07:57'),
(86, '4EyTDDVT54Z8W3ORBqyZ5xVaFkJvmkff9pG6I6ub', '2020-10-13 05:13:41', '2020-10-13 05:13:41'),
(87, 'OoQDgXpdAgV6k1w6enYJvG2TWvTGFqDNFnspTYpO', '2020-10-13 05:16:41', '2020-10-13 05:16:41'),
(88, 'NeoGGnSjzWkJeyeFBUHhLKVOaPTi1J4qd7V9x5ny', '2020-10-13 05:54:45', '2020-10-13 05:54:45'),
(89, 'K6S2VYfcAhmcmDowe3G62fW07dUtT8wwNFBWYcef', '2020-10-13 06:32:27', '2020-10-13 06:32:27'),
(90, 'v7WliWNBns2RAafl2XTs0xM5SQpOAlsj5X0VPUHO', '2020-10-13 06:33:31', '2020-10-13 06:33:31'),
(91, 'fxL2BD14E8VZrAgO0SIhuDJn6jUjuuhVGN5XP7NX', '2020-10-13 06:34:53', '2020-10-13 06:34:53'),
(92, 'x9GG0zsBhjza9eJczFqT19ItvDV4oD9JBtmDwzbz', '2020-10-13 06:35:24', '2020-10-13 06:35:24'),
(93, 'L5GgsfkKfzyNk5HMXSOpSncLXtAuuZ11A7ECLfsO', '2020-10-13 06:36:55', '2020-10-13 06:36:55'),
(94, 'XTwshKfaZlPW95F7VEsV6xyOAoBWyGfmkWw5JZyW', '2020-10-13 06:45:59', '2020-10-13 06:45:59'),
(95, 'hFrBpOZUcjmrADJBT0FGRnIvgEa4B7hPXF4iMz4L', '2020-10-13 06:51:17', '2020-10-13 06:51:17'),
(96, 'Qt4hBsiQ1IETwKDego31BgswZPcBaiwixfzk7fUH', '2020-10-13 06:51:45', '2020-10-13 06:51:45'),
(97, 'p0jkvSAwBu175McwnE6l2NtA3iV2VVG86yk08Fan', '2020-10-13 08:31:37', '2020-10-13 08:31:37'),
(98, 'w39cW2dCreORtuIqyMCKUBKgrZ0pbcXaAWGHIGGC', '2020-10-13 10:49:04', '2020-10-13 10:49:04'),
(99, '756FOgfu5R5DsfIPl8S0yVbZYiu1gre5TzmonxBE', '2020-10-13 18:12:43', '2020-10-13 18:12:43'),
(100, 'GESbDjT6gIK8tIEpkoed6m7sfIHJVodXwjdaudfo', '2020-10-13 18:16:25', '2020-10-13 18:16:25'),
(101, 'lg4rekPgrlfyWEV2ot4VVqk9lDb4IeOZkfVUGcDv', '2020-10-13 18:33:33', '2020-10-13 18:33:33'),
(102, 'Txytig2Y8rlHLwQAvTxo2rueWkMBopdYWIgCqwRW', '2020-10-13 18:43:18', '2020-10-13 18:43:18'),
(103, 'wNqFYdLUjO41R8ajQ7fWW5Ld1VUVNepHkVJzYj4y', '2020-10-13 19:00:24', '2020-10-13 19:00:24'),
(104, 'T6WV60dZlogeU4XpHRrHYZNw7uJNXQAtDxpjDHm5', '2020-10-13 19:01:30', '2020-10-13 19:01:30'),
(105, 'LQ2ueFa2rzUn74EQY1XdyD8k5M6arc1nLTn7aatc', '2020-10-13 19:21:44', '2020-10-13 19:21:44'),
(106, 'pSih7fXSJU3ysBMhfMqsV21XpRrKAIQSfodbpTkd', '2020-10-13 19:23:12', '2020-10-13 19:23:12'),
(107, '2fbIGVTrJQiVufLku4BGnRoVECPy3lOZrldKOjcB', '2020-10-13 19:54:16', '2020-10-13 19:54:16'),
(108, 'wqTYAtmOinMxVBHKtM5wBRV1LfEL4aaCDWO7mF8g', '2020-10-14 05:05:48', '2020-10-14 05:05:48'),
(109, 'quK5aVSQQaYv3ISgz8K8C26d8Hxak8KovNv8AsMH', '2020-10-14 05:11:14', '2020-10-14 05:11:14'),
(110, '6ZnDTQojc2k5wIHk6wr7zMEr9KkvKtpNiYPz69oU', '2020-10-14 05:13:46', '2020-10-14 05:13:46'),
(111, 'znqLBuc9WxzHhFa82qjF6jREUQ8U3dNaMBVoNDaz', '2020-10-14 05:15:49', '2020-10-14 05:15:49'),
(112, 'MM1PkboRvm8RAZznNGGtg3ryNmeJx853SaGqU7ku', '2020-10-14 11:47:53', '2020-10-14 11:47:53'),
(113, 'Msqpawr8kQfsci0mvA1d1t49Ov8Q6kx7ZuBGvS45', '2020-10-14 11:49:07', '2020-10-14 11:49:07'),
(114, 'tESVATiRRGNhq1FTrZvwc6BTcXkds9l9VMMcNLHi', '2020-10-14 11:49:22', '2020-10-14 11:49:22'),
(115, 'RVEzZ8rhxgtUkxJT2ysqwxIqjXmeFjVUIJDZCwYo', '2020-10-14 11:50:03', '2020-10-14 11:50:03'),
(116, '92Ksatax9ZBAMcfDFWtGW5gRK2Q9z6L3OaHrPYQB', '2020-10-14 11:51:01', '2020-10-14 11:51:01'),
(117, 'AkP8PKDmef1Ov5G7NC0NfQRVYHPmyaCFPDBbf5Of', '2020-10-14 11:55:17', '2020-10-14 11:55:17'),
(118, 'qQJ3JwV1AT01uyHxMNqz5Us2A644PVHCcFVndnyg', '2020-10-14 12:01:16', '2020-10-14 12:01:16'),
(119, '9EViVK68MpFCzxXl6xwSQnU2uMXF6gAJgU7A2VBU', '2020-10-14 12:06:42', '2020-10-14 12:06:42'),
(120, 'uYaw6PguJFfcKoUYFWsalTc2jFoWj89HdmASymz7', '2020-10-14 12:13:43', '2020-10-14 12:13:43'),
(121, '5hMHKxMTSAt7prys7JM7Cii8FWxUJRKDotPYieAm', '2020-10-15 07:00:57', '2020-10-15 07:00:57'),
(122, 'KAYWs7TSxpvNYvjWjYPsVcnTOKEknBnSwkicZX2J', '2020-10-15 07:23:15', '2020-10-15 07:23:15'),
(123, 'Wf09UoFaDAPL9li2RbWFAANqR6zTgwSv81w8egeG', '2020-10-15 07:27:24', '2020-10-15 07:27:24'),
(124, 'e0RiO6FvGZRrfpX8QzfW034ycB8nJdgwJlz4nk1E', '2020-10-15 07:28:29', '2020-10-15 07:28:29'),
(125, 'ReLMqxRUmreQiWmcrI2aamyIakA2OqPdg0Yt2N3P', '2020-10-15 07:35:01', '2020-10-15 07:35:01'),
(126, 'w4SV3wj8VIc1QRn1ZlpwNigdFQdIpiRm87a7v9wM', '2020-10-15 07:41:48', '2020-10-15 07:41:48'),
(127, 'M1NwPLsvNbisAY2gmVtthkRqD0wOfqPfs6s67yl3', '2020-10-15 07:43:19', '2020-10-15 07:43:19'),
(128, 'T1dZdC1H4NO2BNMb6XSol1XcZ4WlnkWRz4qe8xtk', '2020-10-15 07:45:59', '2020-10-15 07:45:59'),
(129, 'gcWcdfExoXut7RCseP4p0pFQr8jaCixzVAehVD1z', '2020-10-15 07:47:36', '2020-10-15 07:47:36'),
(130, '9COpPysZap7z6rLUo9LTs0kPgTZszpaGByajXcVU', '2020-10-15 07:49:25', '2020-10-15 07:49:25'),
(131, 'u7WxiURZhWtM5EM8ynyULG9TEH0q5y27fDr4ZFws', '2020-10-15 08:54:39', '2020-10-15 08:54:39'),
(132, 'MliaP3Xb3tLqGYdUDxe45jZIh4OrYX593UUNyKyl', '2020-10-15 09:45:20', '2020-10-15 09:45:20'),
(133, '9vQNDYxiAofi7ciQhfzTneN1MZarEtyUuSlevSIJ', '2020-10-15 09:52:00', '2020-10-15 09:52:00'),
(134, 'ML9zp0IKmk0h5M3vUF3WpjAlBVm796zXduZ7NhXQ', '2020-10-15 10:05:50', '2020-10-15 10:05:50'),
(135, 'l6uACilRATlXDuBtXe5lismaTAl4gT84Jimk7XwJ', '2020-10-15 10:08:39', '2020-10-15 10:08:39'),
(136, 'FMnkYFaYuR2EyVTc9v40iB3QDfpTvGsl5zDBQDuJ', '2020-10-15 10:14:12', '2020-10-15 10:14:12'),
(137, 'mCJPKhcIuYtPoJ2RRC2Qd7a3U7Kxi8qPD1AFVZoG', '2020-10-15 10:18:30', '2020-10-15 10:18:30'),
(138, '3idtmV8jgVNf4sJIOgt8lE9xFBeNuBGcOhKs72nn', '2020-10-15 10:20:43', '2020-10-15 10:20:43'),
(139, '78j67ofielJZrAuLPI4rwpEeXvng5V2Iry9NSn8w', '2020-10-15 10:21:49', '2020-10-15 10:21:49'),
(140, 'c4tzYztgkOFB46rIFHnkzKKNtOlig2uH7JXIKtDf', '2020-10-15 10:24:45', '2020-10-15 10:24:45'),
(141, 'CE8TFTzqY6rNLX648gvvKUWQ18nCgwGaqqomHZfR', '2020-10-15 10:29:21', '2020-10-15 10:29:21'),
(142, 'vj8ghb3wmGSXu3ngz451aDZLp5KdaYaUhACrt4Bw', '2020-10-15 10:57:25', '2020-10-15 10:57:25'),
(143, 'SkJfUDWAL1CHb1Hf5gjawpuK95sugnwdF7XpP2CV', '2020-10-15 11:17:55', '2020-10-15 11:17:55'),
(144, 'HjaFajaQrJQaRXAg7YwOKjwcjI98tYKO2c0NLNcu', '2020-10-22 07:00:13', '2020-10-22 07:00:13'),
(145, 'Q1zxNOTZkjfj1b55yYdODy1fwJM9ezGQnlveUUIa', '2020-10-23 07:45:06', '2020-10-23 07:45:06'),
(146, '7MHmujd9VITVD8T5sKBAwZdPlrIAUUrg8dIFwwaj', '2020-10-23 07:46:29', '2020-10-23 07:46:29'),
(147, 'L0qdKafymZkMo5XPlg7ADrCOURwVoPFDX5gZkLER', '2020-10-23 07:57:25', '2020-10-23 07:57:25'),
(148, 'tw38IHRpOCMft8ej77ITVKcgX6HV1C6tTMiKCaFk', '2020-10-23 07:59:02', '2020-10-23 07:59:02'),
(149, 'Tt4HyRSv4Mnk2RvZRviS8opjae38g5978RMUTJme', '2020-10-23 08:00:06', '2020-10-23 08:00:06'),
(150, 'lnNcRav3ZB2WGo2q6KywbbPCdFGm1oEHvRBv0A5L', '2020-10-23 11:17:05', '2020-10-23 11:17:05'),
(151, 'tZwcvXESkN2aRs82z34hbSyqFU3113bn0F8CkFUI', '2020-10-23 11:32:53', '2020-10-23 11:32:53'),
(152, '6jyIqKHQKArvjUFL5tKxSBSKSz0kQP2RmmTkeZg8', '2020-10-23 11:37:54', '2020-10-23 11:37:54'),
(153, 'ppGHk4YyG6AV1GZuleaq0U1Y6pwBMrk8DEbq14RF', '2020-10-23 11:38:25', '2020-10-23 11:38:25'),
(154, '4ozNtsmYEP4vbNEo9cei9mBGG715Dd0ClZx5ltPl', '2020-10-23 11:39:56', '2020-10-23 11:39:56'),
(155, 'O0Ggz1XvNsQlAzVh8oMyYZE5scY5ELdVg3oDKvvi', '2020-10-23 11:42:11', '2020-10-23 11:42:11'),
(156, 'wsUxXX6xvPTrxrS7LaN3ByE0GQehDjln7VfJunpd', '2020-10-23 11:47:04', '2020-10-23 11:47:04'),
(157, '3DfoZvkriyARBAK4PxhKwsr1UKgBWDzQbNCk5b5J', '2020-10-23 11:47:38', '2020-10-23 11:47:38'),
(158, 'RwrxBaHMVMwQuu6c2u34MQpSzxnVSCMdFj0hE3n7', '2020-10-23 11:49:11', '2020-10-23 11:49:11'),
(159, '0Ta3xN6vpUUZZxUkGcxZoFTFVV993dk4u4o70Arx', '2020-10-23 11:50:01', '2020-10-23 11:50:01'),
(160, 'EJ6A7PNnXWUD4aGAUzXb0VCaBsRZKYFOn2yUsM1n', '2020-10-23 12:07:42', '2020-10-23 12:07:42'),
(161, '3vlFFz5pxoDUOfrW85DlGKi3qByGRl9KNhTCqOUz', '2020-10-23 12:08:12', '2020-10-23 12:08:12'),
(162, 'YTyQ5ECpmCYh1o93ws0c5q5v85hsQ9Y0HhJdCEIH', '2020-10-23 12:31:34', '2020-10-23 12:31:34'),
(163, '6G58JsmbQjk9f6YsuIovR1YNinV1Eb91ioLTR6XN', '2020-10-23 12:33:27', '2020-10-23 12:33:27'),
(164, 'CgVQevoxhXu65I4QhXiFEADIvOJFztlbGQdSguLs', '2020-10-23 12:33:59', '2020-10-23 12:33:59'),
(165, '31K6lbKXqamuAFcTxyOONeFHXmf4QP1e9BrtGmZr', '2020-10-23 12:35:08', '2020-10-23 12:35:08'),
(166, 'KBo9CzBHbOVNQbouGbuAkwN646EMq3LgEQTah5rU', '2020-10-23 12:35:36', '2020-10-23 12:35:36'),
(167, 'aNBlGel8AqDhkQNoOt43Z5hAw2p80q3qtOXo8b7B', '2020-10-23 12:35:49', '2020-10-23 12:35:49'),
(168, 'WB0qhftt23vaudbksbApa29IqMxpUCBz0hoPyvJm', '2020-10-23 12:36:29', '2020-10-23 12:36:29'),
(169, 'R54ti5XzN6JA78Y2cOi6R1NDOkjg8wfoKrsebkaR', '2020-10-23 12:37:18', '2020-10-23 12:37:18'),
(170, 'mSSdpJL1BnbddfJr1tYwVO9NywmgDXA1sKSobnQr', '2020-10-23 12:37:55', '2020-10-23 12:37:55'),
(171, 'Wzpg4ci82WIAvkX2XVzMx94rAr6O7kLAqNieQCf7', '2020-10-23 12:39:11', '2020-10-23 12:39:11'),
(172, '7l1f56m0A6RaonNwNMzEQMZm8LvI5b1CBMCS4Ly4', '2020-10-23 12:51:26', '2020-10-23 12:51:26'),
(173, '3aXEqw9w5VwFgQ70vYP1KHOpDMW5vQycjlrFHKq8', '2020-10-23 12:53:47', '2020-10-23 12:53:47'),
(174, 'QLhwDB81V3dp9nwAL0mweAg7ToaHPwCKg4225BPz', '2020-10-23 12:54:23', '2020-10-23 12:54:23'),
(175, 'eH3wahnn3TTIw8bWP1g8PbRq2EleUDogPGKK4lEm', '2020-10-23 12:55:36', '2020-10-23 12:55:36'),
(176, 'SJVg4RS5kr8M3ssTeuli7Tyymn2mbaHgHMPboLYr', '2020-10-24 09:16:34', '2020-10-24 09:16:34'),
(177, 'ftZngJ4U7yf6PUskphSSiKIGgFOWNUHhguBaHSvA', '2020-10-24 09:18:43', '2020-10-24 09:18:43'),
(178, '4jPAvpL0kA3mpTuDG8DTyrZhA73mwWWpcDsvABY4', '2020-10-24 09:19:55', '2020-10-24 09:19:55'),
(179, '7zG0xUBzrYP1M74GUv3OVdouHsUtY09H9DSs1OYs', '2020-10-24 09:25:45', '2020-10-24 09:25:45'),
(180, 'bgRYS3OwqcUanh4f9ZWUz5swtg6mf1qbsLe4TVCZ', '2020-10-24 09:29:21', '2020-10-24 09:29:21'),
(181, 'R4uD2LzXS1VN7WbqQt5Opibr1oA20sMyFIzdF6Wm', '2020-10-24 09:31:22', '2020-10-24 09:31:22'),
(182, 'S6GVNlay1ehNwiMbkrXeVSEUQ0CwmefqAROohr4E', '2020-10-24 09:32:02', '2020-10-24 09:32:02'),
(183, '9X0opX43DnHAtFwxQTcyyRT0cpx70NWLFNwIVJlI', '2020-10-24 09:32:45', '2020-10-24 09:32:45'),
(184, 'c1x3WEIM8WB1Gj511kgxNd5layDEnRUwh4XzpYSK', '2020-10-24 09:32:51', '2020-10-24 09:32:51'),
(185, 'G63nwZ2AfpgLYT3vPOd9CtSTzEMLTw8QBKXgxoWw', '2020-10-26 06:00:25', '2020-10-26 06:00:25'),
(186, '3F989I0PawKsUn6EK14osM1vohnuztjDGsfyuMrX', '2020-10-26 06:02:53', '2020-10-26 06:02:53'),
(187, 'u3oyYYmy7EpBz7rMMJNeCTM2Ijvff5bBzuDlvE1k', '2020-10-26 06:05:15', '2020-10-26 06:05:15'),
(188, 'XX0o8L1rGVKhUZNUSMPEq0F17uSqy7YoXn9MF62z', '2020-10-26 06:05:44', '2020-10-26 06:05:44'),
(189, 'cy5ghhZuYcBpDFKKrR1e9QsbOSa0tstvXzse4QLY', '2020-10-26 06:06:56', '2020-10-26 06:06:56'),
(190, 'PSp4QPQ3NSU10uoPUZ2OnB34JwtsvnLgComTXK6p', '2020-10-26 06:13:32', '2020-10-26 06:13:32'),
(191, 'i5ZpWEhLBS4lSIh71G0UXdvHMlogH3YQ78PvNziv', '2020-10-26 06:14:17', '2020-10-26 06:14:17'),
(192, 'csObTylYzJtr3aldJpmIPuztFafqmiBvZqlRzCf5', '2020-10-26 07:48:07', '2020-10-26 07:48:07'),
(193, 'kmmjKKwpSgpw7BJvVwplOwYPSHqCJ3F0hQlDAP1c', '2020-10-26 07:48:14', '2020-10-26 07:48:14'),
(194, 'RblDuZSaEm4dftS4Og7wBI9Z4ySxxcPnJk6FZPEp', '2020-10-26 08:02:09', '2020-10-26 08:02:09'),
(195, '90rEXq5IcKm5YHnNyADYHsxFHTcAnrEPPWD7v4wO', '2020-10-26 09:59:03', '2020-10-26 09:59:03'),
(196, 'nhUuejANDCRrPEyIcNDw2pmmVCoAGaBHgYyJfTnL', '2020-10-26 13:30:33', '2020-10-26 13:30:33'),
(197, '8nip4QUWJcDg0QV7TSA303QxAI0vxf64eseA5IWh', '2020-10-27 11:02:28', '2020-10-27 11:02:28'),
(198, 'PjuemXNabX3bXrwRTrjz4abi2jsE0T38CWvRuDyn', '2020-10-27 11:42:28', '2020-10-27 11:42:28'),
(199, 'UuUXDLbNTYslKCQIOHBwCaJIiuwSW0aT4nhMh2A5', '2020-10-27 12:31:29', '2020-10-27 12:31:29'),
(200, 'yJrgXPsFAiL4IsSHTfrZy0OK3Zj0MvJiEjOv5Csn', '2020-10-27 15:20:04', '2020-10-27 15:20:04'),
(201, 'orGmtXb81bY0cPOMh7pPf0OPn3Ql4zVZVavC8cvf', '2020-10-27 15:20:43', '2020-10-27 15:20:43'),
(202, 'LQcvcV3dxEttfY4oaoLYIZkHC592lHUcs9RFrd4g', '2020-10-27 15:23:51', '2020-10-27 15:23:51'),
(203, 'HiAtulYnK2AgYf6p0YtAjIFKnqeBxKkD8ZNP1wkg', '2020-10-27 15:27:38', '2020-10-27 15:27:38'),
(204, '2mLO1HBfjrmwIEYnizt0WOAncsdZsrvZn6CaqXif', '2020-10-27 15:35:01', '2020-10-27 15:35:01'),
(205, 'ESAFlKYV9fkCF7iIcdaAwbo3MMaOIjvqL50L1egi', '2020-10-27 15:40:18', '2020-10-27 15:40:18'),
(206, '3qJMhnFjCXf9ZAGOfkghk1IGlrG342EqhFELkXPq', '2020-10-28 05:59:24', '2020-10-28 05:59:24'),
(207, 'm9SWNz3lKX35yci7hmjTiC7L9VIzeFjHCKHEOzRl', '2020-10-28 06:00:03', '2020-10-28 06:00:03'),
(208, 'VcOzdyTxvfrY7SyjyokpxCvKLBTlw7R6UJvebDz3', '2020-10-28 06:03:48', '2020-10-28 06:03:48'),
(209, '3vL35VOInWQL7acluVhKlGxBOcCuBTkdrdbnedzF', '2020-10-28 06:06:46', '2020-10-28 06:06:46'),
(210, 'FLD9fQeiLQawYG7TgE8cTiY8ZuRT42yDRcf3eYCM', '2020-10-28 06:11:18', '2020-10-28 06:11:18'),
(211, 'kdqSJKcBgu4NOc1yNBrJlzxFQD6V3TT9ILjDCeFS', '2020-10-28 06:14:02', '2020-10-28 06:14:02'),
(212, 'BSBaAcH35USSWB3Syw8BmrTvIOozlC0xwEbcG26U', '2020-10-28 06:19:42', '2020-10-28 06:19:42'),
(213, 'w4zbckNUgKFzyihnF5UdYn0RmlPHv2ortiKGYnyt', '2020-10-28 06:20:56', '2020-10-28 06:20:56'),
(214, 'i6u9GdcBq1XC9qzdE4fnzfbedwATWGvINeyeRSzb', '2020-10-28 06:23:03', '2020-10-28 06:23:03'),
(215, 'Yd4jnmkqnM2dYniSpXlSRAfKm25iMUQrblwW7Le0', '2020-10-28 06:31:09', '2020-10-28 06:31:09'),
(216, 'eYUTpjylZqXqqqEZ156GviT799MGIf9pvWfiwgJk', '2020-10-28 06:32:41', '2020-10-28 06:32:41'),
(217, 'HSfPJvhsrO0B2jvx7WdKqRfOw6f5xUPXpVGIs16X', '2020-10-28 06:33:19', '2020-10-28 06:33:19'),
(218, 'f9TD5ZUFysJT0zamGv1OQtFBcB7dvwDOe16tAhk0', '2020-10-28 06:43:42', '2020-10-28 06:43:42'),
(219, 'jSB1VEBuwcT0hV7MYVrHFYmn7HYKDmKj9ZSujLhw', '2020-10-28 06:43:54', '2020-10-28 06:43:54'),
(220, 'F3MY3PZXTplAMb98x4h0sX4fpgGvSF3kcKoWNpHL', '2020-10-28 06:47:29', '2020-10-28 06:47:29'),
(221, 'dwcAjvv8QREC8owXqh3wmzmxPSmTmuplJsoIVOuA', '2020-10-28 07:13:14', '2020-10-28 07:13:14'),
(222, 'ErbLq28s5MmP97ORDUD605rwODCidDslqXrStKLr', '2020-10-28 07:16:47', '2020-10-28 07:16:47'),
(223, 'sC7e4LJD18djKXfEhxig51EdKMvVeQ7AsXUDI6uK', '2020-10-28 07:19:15', '2020-10-28 07:19:15'),
(224, 'nQAbhRoiQRtnNfKcwn040yfoB23vBpkegDpayiHc', '2020-10-28 07:23:23', '2020-10-28 07:23:23'),
(225, 'NLyo12f6IChyecQUjxpyK7uCpxcSEClTooYXNNpH', '2020-10-28 07:23:27', '2020-10-28 07:23:27'),
(226, 'fS7mqd4KDfGWO0DsepuDxwAedQccEBn12L8ycHkw', '2020-10-28 07:26:25', '2020-10-28 07:26:25'),
(227, 'rOl7zDMTQDLIK0octPIErh0XVxk3Lir3sYcqD42M', '2020-10-28 09:44:06', '2020-10-28 09:44:06'),
(228, 'XYgbl5cJNWLfyTo2x9mSVY5rkVUSaCqA7lhEkxPV', '2020-10-28 09:47:08', '2020-10-28 09:47:08'),
(229, 'FvkjxepWQk9WoyZAhPrVV6EikEGzH5O0GcYmp0SP', '2020-10-28 10:27:30', '2020-10-28 10:27:30'),
(230, 'Opol2TxC3QAGS6n4tKwPMNXoolcQs9LHlnELzbF8', '2020-10-28 10:27:39', '2020-10-28 10:27:39'),
(231, '3PDvHAHAC4z3Fe0IJNGf1OGFJy2nOkCmzk6uSmuF', '2020-10-28 10:31:31', '2020-10-28 10:31:31'),
(232, 'EvRxqurRrZ2RXc9ZNnXffImLXty6pqSHmY59QsfM', '2020-10-28 10:32:07', '2020-10-28 10:32:07'),
(233, 'OAQLZlcsvy6TheJYrf6s3eRUdzIfWc4KSKEFu7Eh', '2020-10-28 10:44:11', '2020-10-28 10:44:11'),
(234, 'dtwa3NiFSHTGiztQq3geMzHECIpZUyDDEyhFZjMe', '2020-10-28 10:44:44', '2020-10-28 10:44:44'),
(235, 'ekwZQyej8ls2SLbGsF36hkhyaG7AuhHmorC9XmN5', '2020-10-28 10:45:07', '2020-10-28 10:45:07'),
(236, '5l3ygcOuEgo9xuFnWCG6wsX7jXcCs4ZFqacZ7Lh9', '2020-10-28 10:55:13', '2020-10-28 10:55:13'),
(237, 'DKfdIZWTNn9NxpIhMCf0jGNulCUrEzGyd99ED4sm', '2020-10-28 10:55:50', '2020-10-28 10:55:50'),
(238, 'f382bOhZVtvuYRhG64RSfjn2LqvQDJJb8M3CBwZ9', '2020-10-28 10:56:31', '2020-10-28 10:56:31'),
(239, 'fjatZf7BifsQnpvk5IOITZmhcW21vU9GySYqgdkc', '2020-10-28 10:57:11', '2020-10-28 10:57:11'),
(240, 'OfkZLS7XDAG6oO7JHhRfedXzKlQAWB34NfJxS0uS', '2020-10-28 10:59:01', '2020-10-28 10:59:01'),
(241, 'dvQ1UfdRY6Bz0IpElH06yfATfg4etlbzbNmHCzr7', '2020-10-30 16:55:53', '2020-10-30 16:55:53'),
(242, 'AhWGhoAU4zx0038xKDKnegM4pGdbRTCoIkrfOrZE', '2020-10-30 17:03:41', '2020-10-30 17:03:41'),
(243, 'wpqmpjLSPmXCAK6YmhsOyYXAwCUjTdeFyYMSrab7', '2020-10-30 17:06:29', '2020-10-30 17:06:29'),
(244, 'QEyjIPUpEbF9pSZtIJjrT5GaGwyYDsro2cnYotp0', '2020-10-30 17:35:56', '2020-10-30 17:35:56'),
(245, 'VOCJwEDT4RxTPIrZvlYlFRD8Fs2cADQ0WmVK5GN6', '2020-10-30 17:39:37', '2020-10-30 17:39:37'),
(246, 'X8lxGSV9Cc2Mai8r79Y9LUJUgzquGDbnWS5Kf4HB', '2020-10-30 17:41:28', '2020-10-30 17:41:28'),
(247, 'I93fWCy0n0x9wt4SotDYeSQlhEzXA50SqS0Xs4uR', '2020-10-30 17:45:51', '2020-10-30 17:45:51'),
(248, 'DHZtuz9Sl8pa9ohOwMVh9MuM3xKw4l07Vl9Sea4S', '2020-10-30 18:02:30', '2020-10-30 18:02:30'),
(249, 'vC1z8fo6JcC7V8Ac3woNJguabNDrjqypyFBa5d9A', '2020-10-30 18:03:29', '2020-10-30 18:03:29'),
(250, '7AziUBgL2bSHNiZfwiOBU3jpHw5psnJW6xoA0pPL', '2020-10-30 18:11:14', '2020-10-30 18:11:14'),
(251, '4fIuOpCUM8mehuzoybAKAWoIbQIGpPx7MCZSc2g1', '2020-10-30 18:18:26', '2020-10-30 18:18:26'),
(252, '8OCnkEbuvtQNOjoIwJuQErT08n46Epw6iXLGUPcK', '2020-10-31 09:02:04', '2020-10-31 09:02:04'),
(253, 'RRsg6u0MXqKBVUpTgSDzNRYcAwLO2ojNcyk2sjme', '2020-10-31 14:07:24', '2020-10-31 14:07:24'),
(254, '6j1XhPkeKEaf2wDGewyW5dtEg3THjQMWalg8PpDU', '2020-11-02 11:25:24', '2020-11-02 11:25:24'),
(255, '1vpKopJNC0OtHnjODXwG76go5ym4XacWpuCQGIWq', '2020-11-03 08:36:02', '2020-11-03 08:36:02'),
(256, '7PBDbcKG6lQfWcLP6qxIl3kHpBK5l6tKV3sO8YG5', '2020-11-05 19:18:44', '2020-11-05 19:18:44'),
(257, 'FbruYclUDDYTgkOpcLGkqi1fYmk8QpR0gpnzZe7E', '2020-11-10 11:45:49', '2020-11-10 11:45:49'),
(258, 'OCCBuMZprqFkgYGNqWPXzc6obItyk9qtGMBDeOig', '2020-11-10 15:37:45', '2020-11-10 15:37:45'),
(259, '1Aq0g6VjANz9cNRokxQ2lziib7U3lkqFWV0MQ9u7', '2020-11-10 15:38:02', '2020-11-10 15:38:02'),
(260, 'VYQsEsWwuyaXbvqi5psAS0z7WcpRqz1DcHtYiEk2', '2020-11-10 15:38:23', '2020-11-10 15:38:23'),
(261, 'DD1PqaafkhTIbCQs9cCK9LzukiSdAD8YDyB2Eegz', '2020-11-10 15:41:06', '2020-11-10 15:41:06'),
(262, 'pKXru46n5pR4U3gyk3SjuNrUl8xttD6Q79FrFXvk', '2020-11-10 17:27:45', '2020-11-10 17:27:45'),
(263, 'DDUty8UznnoVawVSM3kx8vK7ETV5AGqCnkYcjHJB', '2020-11-11 11:36:44', '2020-11-11 11:36:44'),
(264, 'D7hTixfOx8rv4kS7jPEFAGYJxLGgo4HLgKpqn18Y', '2020-11-11 11:40:57', '2020-11-11 11:40:57'),
(265, 'kQhXJcYQOG4NTVZi6d3N5jjlQqeCrD6QakV8IQtd', '2020-11-11 11:44:53', '2020-11-11 11:44:53'),
(266, '9t9WuwhvS2awZ2s7e2QWIs5vf6IONE7CorW95w0A', '2020-11-11 12:09:00', '2020-11-11 12:09:00'),
(267, 'mKoIvFQEV0VnIsDhY4gsTXWDZeuVLAwv8XpSX7F8', '2020-11-11 12:09:21', '2020-11-11 12:09:21'),
(268, 'd4ahBbxSfytUogz6XNVI4aycO3QW0r2vg8HFXddh', '2020-11-11 12:09:57', '2020-11-11 12:09:57'),
(269, 'RgVFIwmeTzx0ygLU1g3qT3tTB62fvfZvtYyPNWAC', '2020-11-14 17:03:35', '2020-11-14 17:03:35'),
(270, 'f3m6Dv1X1JgTrTn4pY0dFRJFn3Qj7zZTjHGb7x5W', '2020-11-14 17:05:28', '2020-11-14 17:05:28'),
(271, 'R0qMg746gRaJnp2uiSLpS7pc2vNpbRjVJQn1xknV', '2020-11-14 17:06:43', '2020-11-14 17:06:43'),
(272, 'n8I5oZdFmBjWiemdAro8yQKsOu7j3cU4IF3adsJL', '2020-11-14 17:07:49', '2020-11-14 17:07:49'),
(273, 'AmGBmMgzwxVdeffTenFcHUcshu4nz27NxVDfUrCa', '2020-11-14 17:23:08', '2020-11-14 17:23:08'),
(274, 'P947TJFrqS9QWmTYD8MTFNRrGOLy8ZZIE3y51Loq', '2020-11-14 17:49:12', '2020-11-14 17:49:12'),
(275, 'Ww4m13ZVSRYNtOn4S6vR2Tx0d666LzsHUCJhMDWu', '2020-11-14 17:54:37', '2020-11-14 17:54:37'),
(276, 'LZt0HjTiKxNc5iQWqZLu7qbLq2JCNR4nwAL5nr5q', '2020-11-14 18:13:18', '2020-11-14 18:13:18'),
(277, 'CHEKGBsrI5K7pWzjlaKCApdEQpIHulMEN7FQteAX', '2020-11-14 18:14:38', '2020-11-14 18:14:38'),
(278, '6xzAGq3mGGXdocVkfuQO6oIgrEdq5zrBInZPdMbu', '2020-11-14 18:34:46', '2020-11-14 18:34:46'),
(279, 'T22Aal84z0iXA4oec0BHDmQzhmPVnLuVji3H1Gt0', '2020-11-14 18:51:05', '2020-11-14 18:51:05'),
(280, '2G5aO3BWJabg7RkkxkahZlZLc5aNmv31g1YLHYtj', '2020-11-14 19:17:16', '2020-11-14 19:17:16'),
(281, 'PibeyDQmKGrVkayd0KKk19VwF0MIEzM0pTbxEpRA', '2020-11-14 19:20:57', '2020-11-14 19:20:57'),
(282, 'frtWZkQutMLGtQsHewnQpz2WbnL1QNqRP7UpWjVb', '2020-11-14 19:32:37', '2020-11-14 19:32:37'),
(283, 'vV6K0N4Wyauv6ZSegBbuBRrQ1eId2bc7t4GlxKXU', '2020-11-16 01:32:06', '2020-11-16 01:32:06'),
(284, '3HJNTDSk3R0ie3bx2hoFJXfOQv2rvY4hXJB85QfO', '2020-11-16 01:58:11', '2020-11-16 01:58:11'),
(285, 'q3egYFUPXXvTuRHJe57zwOdy7PIsaUOuuZPqQ4LB', '2020-11-16 02:12:33', '2020-11-16 02:12:33'),
(286, 'MYnQxvmmn4NctAKOzZYWdJ5eesG90LLTpKFu5yIf', '2020-11-18 05:09:40', '2020-11-18 05:09:40'),
(287, 'Zrp68cM9WXmHpEBxgJAgEi8YlXwpnXdlhVXg3Cnd', '2020-11-26 07:44:25', '2020-11-26 07:44:25'),
(288, 'KKJTVIxnWsPN8xvliAmGp2lxWAysMHUXayPvKUig', '2020-11-26 09:10:30', '2020-11-26 09:10:30'),
(289, 'HT100eNv1zsy1CZs17B3vwsYvGtj8KXSJgAX4xKw', '2020-11-26 09:13:55', '2020-11-26 09:13:55'),
(290, 'WVJf8l4HnhfLo7MJ2t6cPDBIKgLqU8Kb3exCenhP', '2020-11-26 09:16:13', '2020-11-26 09:16:13'),
(291, 'jFZuDO8Ue0CNMgati9xVUZ3Mp8xnOWyUCTFtMApk', '2020-11-26 09:27:20', '2020-11-26 09:27:20'),
(292, 'nsCcPoDqbb308TenBMIEwLDESN8DIQg4qbiYGcTq', '2020-11-26 09:27:54', '2020-11-26 09:27:54'),
(293, 'LFixBF4KKnrMwPLpDQLmUIQ5bJhinTIsXGMJEYkD', '2020-11-26 09:28:53', '2020-11-26 09:28:53'),
(294, '9HsmyFecrNP8NuX7BvPCCM7xF18rBDO8fD8CNVtq', '2020-11-26 09:29:22', '2020-11-26 09:29:22'),
(295, 'r4VgcS2Nw4jk90YfRBMiB6cWk6XXIIshqtS1pkTJ', '2020-11-26 09:43:10', '2020-11-26 09:43:10'),
(296, 'g2TlZ4kkkfGkXno5A2uSmcbyM6p9lCz8TTd7ZVTa', '2020-11-26 09:50:19', '2020-11-26 09:50:19'),
(297, 'fLvYoFWi53jVFzZmv5gR2SPITqUXRD1NXb9bxXK8', '2020-11-26 10:59:49', '2020-11-26 10:59:49'),
(298, 'KBbZSXRIo8PNFmsf44IrVKaGjvGrUq5ejmCDQ9Qm', '2020-11-26 11:04:57', '2020-11-26 11:04:57'),
(299, 'JF0qry0PECEl8a2Hlt9mlbIBfg8WLSrwGhMz8rnr', '2020-11-27 05:43:54', '2020-11-27 05:43:54'),
(300, '71CU7sgCFm0erVoTuSyO8xNu9jyyi42rodGF2glc', '2020-11-27 06:20:40', '2020-11-27 06:20:40'),
(301, 'j3FlFPgDjayRZ0ViAEBWSmVBKdoR9KmzSIJP5rOm', '2020-11-27 06:36:48', '2020-11-27 06:36:48'),
(302, 'wUZOTS7DGFLs25VmyqzTsSCBoMb8WmVEskK0ogjd', '2020-11-27 06:36:51', '2020-11-27 06:36:51'),
(303, '5vfTjICKqo4WVvenFrtqJLKLz9nBlNBkwPglo3E0', '2020-11-27 07:03:05', '2020-11-27 07:03:05'),
(304, 'OeRmjq5UHv0nsvjOoe9cj3HHmERDqikwiL50Zu7T', '2020-11-27 07:34:49', '2020-11-27 07:34:49'),
(305, '0nj0d2SIqAv6lsgRC9HnxwVacqBRs6ByNwGuOZPy', '2020-11-27 07:35:42', '2020-11-27 07:35:42'),
(306, 'tTWj4aaroTyBCRvH6khYQAvKufymotZZgt3b7kGm', '2020-11-27 08:06:08', '2020-11-27 08:06:08'),
(307, 'xmSNNLRZWk6JVOw6zu6UeiZXcufAxENYa9jQTbMt', '2020-11-28 07:52:12', '2020-11-28 07:52:12'),
(308, '30bNh0lcLrUKwiCgrCXE5ki7Kj9GjDE5901CbQbT', '2020-11-28 07:52:38', '2020-11-28 07:52:38'),
(309, 'mcBwfzzkGADzBBzMPR2ZdcTpSO43gJ1ahQWBnC8O', '2020-11-28 07:54:13', '2020-11-28 07:54:13'),
(310, '4IebqVCR9t70tndJN3aWljuzXPsDAiucMPcZWvhA', '2020-11-28 07:54:31', '2020-11-28 07:54:31'),
(311, 'DTo0PYP7cdfo3AmzTYX4kPPIA0K6x1q77De8gsDz', '2020-11-28 07:54:41', '2020-11-28 07:54:41'),
(312, 'jPiDVurqcG5x1rkNOdb6tw4HVCG0WgNJA0bXRyv5', '2020-11-28 07:54:50', '2020-11-28 07:54:50'),
(313, 'WrYvhTj6gX38GGgbIoFlwja7OIOLdhT5dDbZuJFM', '2020-11-28 10:04:47', '2020-11-28 10:04:47'),
(314, 'nHM9rZnP597ZrmSNP06LeDXNzu4BEYw6tgSoZGtJ', '2020-11-28 10:05:04', '2020-11-28 10:05:04'),
(315, '8bbRhj36SE6IUdypLVWdCekuw5deEwjfaHX2CmJn', '2020-11-28 10:05:21', '2020-11-28 10:05:21'),
(316, 'cSDXc585dGwg0bdDQYssSjoS36mloCe3mPLsXebS', '2020-11-28 11:16:00', '2020-11-28 11:16:00'),
(317, 'dHX4GM9o2xZDzXv7ZzRyHHVESMTVN5eRmAcZ0AmG', '2020-11-28 11:29:33', '2020-11-28 11:29:33'),
(318, 'dwIx3JARQtawefXoxMktsIwj0Y9PXp0wj2fFM3kX', '2020-11-28 11:29:57', '2020-11-28 11:29:57'),
(319, 'BxZLdZy01GSWBZAI80bHRNfpJ7Bvp0ASvHaBX7WY', '2020-11-28 11:30:27', '2020-11-28 11:30:27'),
(320, 'dSeCK0UIYGgcJefgyrocfsjnJ7IsiT7j9tCIvudm', '2020-11-28 11:31:00', '2020-11-28 11:31:00'),
(321, '0IzlDW0PdyoOo0QTd6I8yuCcyvUDwOOzlA3owSlk', '2020-11-28 11:31:11', '2020-11-28 11:31:11'),
(322, 'uvnKJ20TaCWyJqBT6DcnevscsagKmxKmZCZC6YPp', '2020-11-28 11:32:00', '2020-11-28 11:32:00'),
(323, 'oyqxSmM7VlN8IlXdmnOOhtiHkk36SVNGS74LbhRx', '2020-11-28 11:33:31', '2020-11-28 11:33:31'),
(324, 'zkzVNf4Aq4lKQz3Ago12IvM3zuNAlp85Wc1F6kBt', '2020-11-28 12:12:17', '2020-11-28 12:12:17'),
(325, 'czaqqSktauizDxbECFWWgOiXJzMXoUvv5nOqRQDJ', '2020-11-28 12:12:52', '2020-11-28 12:12:52'),
(326, 'v6Mr9fsyt2vO8wTGWjVauFzpOajnP0z9vwFkyYuD', '2020-11-28 12:34:33', '2020-11-28 12:34:33'),
(327, 'rephrztVVL0Hyq2k0e19m9CD7c5ipEWuNl1vHI9g', '2020-11-28 12:44:57', '2020-11-28 12:44:57'),
(328, 'oupp8YeKpOCMsKzJokfpXO0FHvZlzlgPAtgo19tA', '2020-11-28 12:46:02', '2020-11-28 12:46:02'),
(329, 'vn5vN4JXTVBAkBlAlzXsxT6gYnipdLJ16PEHvgam', '2020-11-28 13:19:52', '2020-11-28 13:19:52'),
(330, 'Aqt6sVvDqCRSI0WBiMiun9OCA7vqWLIRrrBi8fvk', '2020-11-28 13:34:36', '2020-11-28 13:34:36'),
(331, 'IfiuzFLTNFmLM950XCUSRCOKFH1ci38uAlk3gvhE', '2020-11-30 09:21:30', '2020-11-30 09:21:30'),
(332, 'vCDD70FLQvAnGrlzUg7HoAYi2UTm5eKM0hjdYYlI', '2020-11-30 09:23:11', '2020-11-30 09:23:11'),
(333, 'dHmHXaCQmoVDNexTBPTiwiYrP3wSPS6aIGjYRyzU', '2020-11-30 09:30:25', '2020-11-30 09:30:25'),
(334, 'jPlRiNi3OspDihpkCVUQe6PPCfMNpxJf5396xnAR', '2020-11-30 09:33:52', '2020-11-30 09:33:52'),
(335, 'xfmLhwjK1eLphQJK2xB9TTjWFynY4lp7OWoMH1id', '2020-11-30 09:37:20', '2020-11-30 09:37:20'),
(336, '1JYEGUKvCAUjRqFIARfc6mPHEPi4kvxwHE9mz31S', '2020-11-30 09:50:09', '2020-11-30 09:50:09'),
(337, '4cqpVHVTVlxcPLo9WG2OM6sjO1KwZ2Wwjfm6FF0U', '2020-11-30 09:50:31', '2020-11-30 09:50:31'),
(338, 'gB840uPiLUkDDICDPf02lxtUSVPmKQ0Uvoe0gyLe', '2020-11-30 09:51:59', '2020-11-30 09:51:59'),
(339, 'qmRK0qgZ89fpVAyMLRf0YuJfNG8Mdc8jDAwXkwPX', '2020-11-30 09:54:04', '2020-11-30 09:54:04'),
(340, 'l0cBtq1PSNJrlH58fEQ1OzP9cPaE0xTgd6qxR3zC', '2020-11-30 10:27:50', '2020-11-30 10:27:50'),
(341, '6qy9w3utAxyhagpJwPb10LXJ1udne7Qrmu5qwXVh', '2020-11-30 10:46:06', '2020-11-30 10:46:06'),
(342, 'rkmOG7sFmtZHaHpvE4pXDET30Fb3rG60HSTW8lce', '2020-12-02 06:21:27', '2020-12-02 06:21:27'),
(343, '7HX7kR2n1JSENwH9pWM4nDhmkFb8AU2yeUxTf8kC', '2020-12-03 06:59:46', '2020-12-03 06:59:46'),
(344, 'IayEPXnfA68LJRuhOcplMlQC6A9id2T1SyRWxKjV', '2020-12-03 07:00:16', '2020-12-03 07:00:16'),
(345, 'WPpBbtLlzW5xn9MktPL2ZeNZW3HWSEauY9kcQiwy', '2020-12-03 07:01:06', '2020-12-03 07:01:06'),
(346, '8EDbv99plWoBEKYm7Qn7fHa74qoVJQ2AJQt65Ojt', '2020-12-03 07:01:59', '2020-12-03 07:01:59'),
(347, 'Aq6z7VKFzOSYOClpuEShU4eeFpwakB1wekZ536g2', '2020-12-03 07:11:03', '2020-12-03 07:11:03'),
(348, 'qhHjcCM44DWWmBrPQiQvMIZ0s329BwmhThmr2TYF', '2020-12-03 07:32:43', '2020-12-03 07:32:43'),
(349, '1pFLgDfox77SE7fLMvmL7sqxwgVqcdT7XGdNvy5D', '2020-12-03 09:32:15', '2020-12-03 09:32:15'),
(350, 'ufgCNZmuzFQmmGFTzMAq93Zt2KoekQgyTOySDj0N', '2020-12-03 10:01:00', '2020-12-03 10:01:00'),
(351, 'TN64nfzGzka1AGZvUphncIU3jeZ3Mr1dbiuvDdnB', '2020-12-03 10:03:02', '2020-12-03 10:03:02'),
(352, '0E7zJgWBFewETMzByQgCNErIXg8awtd4sJAOsBjT', '2020-12-03 10:03:38', '2020-12-03 10:03:38'),
(353, 'uLKswaNTRPe5sRSbEXMew4iB6I2mII57Fq75xrJN', '2020-12-03 10:26:38', '2020-12-03 10:26:38'),
(354, 'MvGjzUVPs0iMdHv8mN1FDP56UcldO7Qlbcqun1XC', '2020-12-03 10:38:22', '2020-12-03 10:38:22'),
(355, 'Gt3qLg52WIHIqmiuR1lqDe1wDiIg0pD6U4Xz0gaf', '2020-12-03 10:45:32', '2020-12-03 10:45:32'),
(356, '1meWEw461ZTYvvkIc6RiqqVGR9p31lMkoM9utjVK', '2020-12-03 11:42:16', '2020-12-03 11:42:16'),
(357, 'X7HRqkrYWjqYhNL8iXR9yp3sFvB5RbSDcnVZktcy', '2020-12-03 11:44:59', '2020-12-03 11:44:59'),
(358, 'hDiVPqxZ7iiTkFikcUr3JnqrySdZTdp7zRKz8Yvt', '2020-12-03 13:51:48', '2020-12-03 13:51:48'),
(359, 'joEOpLGytR3LB7LPTnS5ov3xDJfLuyDacBYohgtu', '2020-12-15 06:51:01', '2020-12-15 06:51:01'),
(360, 'JCropQWqF2P7wUwrKgqI9RnuRGUqV4tKt9bFvbtz', '2020-12-17 07:15:50', '2020-12-17 07:15:50'),
(361, 'pPBARxc5oRy6ytxo9hHbOwEZqygqO2uTYpe6YkSX', '2020-12-17 07:18:43', '2020-12-17 07:18:43'),
(362, '0SnPzo2xPBfk0SMH4MHyNDW2XFgHQbJxxvat4AiB', '2020-12-17 07:57:59', '2020-12-17 07:57:59'),
(363, 'i6vquf71mF3hizjPcaDMsoXsD7E7JQar504N8GcA', '2020-12-24 07:45:12', '2020-12-24 07:45:12'),
(364, '9uEhAyPDl2YkMOjACs42LRpBbno5Xx9M8ajZSGQJ', '2021-01-13 13:41:08', '2021-01-13 13:41:08'),
(365, '5PzrK4sBcoYAHncTZvwdvE5I0s3R36BEszCA51x5', '2021-01-13 13:51:51', '2021-01-13 13:51:51'),
(366, 'tIeARJtsReoUbKO8w1EpECURsg0O8doYbBbUOCrk', '2021-01-13 13:52:00', '2021-01-13 13:52:00'),
(367, 'Yrq5XRdVVvOwKfoKaQEMuWv6DVdTqbcAyPlXKTDX', '2021-01-13 13:54:24', '2021-01-13 13:54:24'),
(368, 'UFgbyci66dmTrYQgXxk7g6N9uZTQthaLso5NyZdC', '2021-01-13 14:21:36', '2021-01-13 14:21:36'),
(369, 'lR4rQaUeUNdVu51dOkBlf0EBoVq5dIUSAEPfmFf1', '2021-01-13 16:58:02', '2021-01-13 16:58:02'),
(370, '7M4BnewgTndnlnah6ZikTW6zURgyy4Xay6ogFzWR', '2021-01-15 11:33:00', '2021-01-15 11:33:00'),
(371, '00SO4H1vvLIpYU5CZmJzB7Q9MUpzUHHrszKgGesz', '2021-01-15 12:25:16', '2021-01-15 12:25:16'),
(372, 'bhfZ26fOFiMIheJH7hnLsm4wkxLqNAGhhJPWAgOI', '2021-01-15 12:51:30', '2021-01-15 12:51:30'),
(373, 'XbpnkEqalHJqyXvHLgazMsAOedgKyaKHZkqztOzk', '2021-01-17 07:58:51', '2021-01-17 07:58:51'),
(374, 'p8MhFkzP1GEohly2CZK3ivT3gSNKFNbq4GNaGp1C', '2021-01-18 05:44:11', '2021-01-18 05:44:11'),
(375, 'ttDi1U4aWbUZ582FsqzABEBagtKkcsDKPyfeNZ3i', '2021-01-18 16:56:36', '2021-01-18 16:56:36'),
(376, 'FusjhDerLuTlddM1AiYOAlzqafcTgGRMOaw2HHfq', '2021-01-18 16:56:43', '2021-01-18 16:56:43'),
(377, 'wy2zPw49RzQRjmxX5wXtaQda25AgPbLM5jNrJf35', '2021-01-22 10:22:57', '2021-01-22 10:22:57'),
(378, 'Z4phbwVY3wiESE7d61lICHTbb7Ob4PRC1LrBvdkD', '2021-01-22 13:15:19', '2021-01-22 13:15:19'),
(379, 'sUx9xKbpOxqaVa8sgl8ebV6QukgAR0RSiTZdrHMD', '2021-01-22 13:15:44', '2021-01-22 13:15:44'),
(380, 'xicjDRWtVU2xK2IKoifQJ0aBuQ5tdZUIQKlGidyg', '2021-01-28 10:54:07', '2021-01-28 10:54:07'),
(381, 'SnUxGu6PjK37vYnGiRFEVdHg9rKttHyz5fgWhBQm', '2021-01-28 10:55:32', '2021-01-28 10:55:32'),
(382, 'DfnvV6JqTmCFfwq0CnXa2qRMNRjbxmLpBukAbeg0', '2021-01-28 10:56:23', '2021-01-28 10:56:23'),
(383, 'GS2FVfVEpZs9Cm79hO69FXYZyCdeM3Sc426BCnS9', '2021-01-28 10:58:09', '2021-01-28 10:58:09'),
(384, '68NEvd0ZK5Pzm4Y9dRIqSZ06ZjrJed9ChuiYMOlb', '2021-01-28 10:59:26', '2021-01-28 10:59:26'),
(385, 'VqqHNWdGewbSHAOfo3Zp6lr6msjoxVvdCJVE8Lm8', '2021-01-28 11:01:59', '2021-01-28 11:01:59'),
(386, '5fwk42THLeX7LKIBPJeGmuHWHmbrzIaHmSLw9Bgs', '2021-01-28 11:06:13', '2021-01-28 11:06:13'),
(387, 'BGFPwfZTY3lJXj6Jt8XetT8RlI2uR95xLgRkiKnN', '2021-01-28 11:11:10', '2021-01-28 11:11:10'),
(388, 'P1clzbq7dGk3N4LekISC50Zho9hZI1C5k7qO6RsA', '2021-01-28 11:54:47', '2021-01-28 11:54:47'),
(389, '8KyO8RnibDfaHubVoDUk13w1vMkLxjY7gi7eNi0a', '2021-01-28 12:01:43', '2021-01-28 12:01:43'),
(390, 'ceYQQ34gheXxTHGd7m81V2BlAIir5IepQFEnyhkq', '2021-01-28 12:12:08', '2021-01-28 12:12:08'),
(391, '2ymSMT0Z9NVtGDcEoT9dlYaJovmTIDMmOfeE0Vxq', '2021-01-28 12:19:28', '2021-01-28 12:19:28'),
(392, 'Ktce0VAhRDKl8RS7YgHKv4BEhtoe5w0D7nO7nd3Y', '2021-01-28 12:31:13', '2021-01-28 12:31:13'),
(393, 'XV1fd7y5rylncNoH35YLlxF2V1urRc7cAv8NsjWX', '2021-01-28 12:44:04', '2021-01-28 12:44:04'),
(394, 'NYxP4c28EOzrcSESBBKpr53iEgULNODrJlEqnbyV', '2021-01-28 12:45:49', '2021-01-28 12:45:49'),
(395, 'O1urujJo7ukaCeZmJcH7t5epC7zGylvO9EwBZ6rY', '2021-02-11 05:40:39', '2021-02-11 05:40:39'),
(396, 'C6lWFCea0BYPL6cE0y3TjSIvcrKOvFXsX7z7SRta', '2021-02-11 07:06:01', '2021-02-11 07:06:01'),
(397, 'iRtgQMRTPfgC5QdqPhwGngkqnaGOl7xHfskYTgTe', '2021-02-11 07:06:41', '2021-02-11 07:06:41'),
(398, '6vaiZXXoQ1Akh3ouIoYWOeGK0F5mt98Y0ZogjI0v', '2021-02-11 07:12:17', '2021-02-11 07:12:17'),
(399, 'gNcTUTYRRgOPlGShZCQQ4Wld2CfDk3jW7dI4hEJG', '2021-02-11 08:06:14', '2021-02-11 08:06:14'),
(400, 'IZUwLupwguGnrGRjHCWwTOiYRYPxvMaUSRsMjZpx', '2021-02-15 15:54:54', '2021-02-15 15:54:54'),
(401, 'PrRsXJqzSF7For3luOcxqY3KoVyAuoA0jJsye8Mc', '2021-02-15 16:09:37', '2021-02-15 16:09:37'),
(402, 'ZGdpmk9PxYnEBCQC3pj4tmJWV3VCOHBKikIflmVp', '2021-02-17 20:31:22', '2021-02-17 20:31:22'),
(403, '8wWOPzCC77YAKFqCpylAvuCR5lumQmBz0rQ5YGU8', '2021-02-18 13:31:46', '2021-02-18 13:31:46'),
(404, 'BYdq1qx4zoALmkvqnZ2r0Tf5bB5YQWSvB0NpemD0', '2021-02-26 06:52:11', '2021-02-26 06:52:11'),
(405, 'K2ojjb9IXtRXpIIDK5IPtayEdkSFH5jBcGLIW20k', '2021-02-26 06:52:21', '2021-02-26 06:52:21'),
(406, 'xp4cCke1eZeE5ZR4JBcUzQAODeLB7lX1unzUQAOb', '2021-02-26 06:52:27', '2021-02-26 06:52:27'),
(407, 'cy6oolSElFWgza0l2WQ488D5ejJMrISvWjVPpNM1', '2021-02-26 06:53:10', '2021-02-26 06:53:10'),
(408, 'Z61vg1kpEl3JeT3Culred2e1OrxsPBD8ixc1UoxJ', '2021-02-26 06:54:12', '2021-02-26 06:54:12'),
(409, 'l1ElehMBzdWnW0IOZStJbyG168NO1iMw0j3iyjYl', '2021-02-26 06:59:23', '2021-02-26 06:59:23'),
(410, 'rqABxlqzYTm58YOXENtfew35Jhq4r1pjjMPWfjXV', '2021-03-01 06:29:16', '2021-03-01 06:29:16'),
(411, 'WDVdA2DzXo3JplVEPSHJQ7enbk0yH9pkKyQKdENg', '2021-03-01 08:21:57', '2021-03-01 08:21:57'),
(412, 'EGZjOKNZmyBH8bZq5h2i2ze57VP4JWRXgxheGOup', '2021-03-01 15:25:36', '2021-03-01 15:25:36'),
(413, 'SBGaKhPFEGfGET6tzWiT17mPQRfsTzh7dJiCc5dK', '2021-03-02 06:48:52', '2021-03-02 06:48:52'),
(414, 'TUGEAGsFEX7Q5E43NeS4jkknymtcHcL1fCWF9xy1', '2021-03-02 13:58:13', '2021-03-02 13:58:13'),
(415, 'w00Ge8FAY209ms3z7nw6X0KFYm1fedHx0RFDbdCO', '2021-03-02 14:04:10', '2021-03-02 14:04:10'),
(416, 'S7jBiQ6MQbL3sysmwWypnA2NhTMAbso38kZJNANK', '2021-03-02 14:08:41', '2021-03-02 14:08:41'),
(417, 'tbERisNv3ZBp4lQMkN03W3Hp42KaYybhn7W4Ba2U', '2021-03-02 14:10:43', '2021-03-02 14:10:43'),
(418, 'kPBkmIPlILZiETumsnSP6qWeP1scTP8eqnw1MM2b', '2021-03-03 04:12:08', '2021-03-03 04:12:08'),
(419, 'DJaGaAXBQW7LL5iiDvMRuyk3tMIiuH61H0CQmaca', '2021-03-03 05:04:32', '2021-03-03 05:04:32'),
(420, 'xwtOAwRytvzxp2gqlT94h5pgjPi67RV7NmimlcYh', '2021-03-03 05:08:26', '2021-03-03 05:08:26'),
(421, '8NeRJtojZZLNfU8pa87fwf79SGS4HoOKo8T7ANBy', '2021-03-03 05:31:53', '2021-03-03 05:31:53'),
(422, 'l0iJ9MJg8WXP6M4P9qAm285txtdbteIyRz9uZpji', '2021-03-03 09:42:36', '2021-03-03 09:42:36'),
(423, 'qycTycrtsd1BbqfoW2uODVW656M6niWLlXOnie0H', '2021-03-07 16:22:58', '2021-03-07 16:22:58'),
(424, 'F8BR59vbFJO7jJm3deRDJwmAsekc3bCwq6A5lkKz', '2021-03-07 18:00:00', '2021-03-07 18:00:00'),
(425, 'M8p63gBjISv9MntKw1UMcpPlYdJc7lQ16ADs9b9U', '2021-03-08 14:57:35', '2021-03-08 14:57:35'),
(426, 'GBhuxRQpSQfQtXRIVfL7DHbO199gHrKXapO8Wa3Q', '2021-03-10 06:36:09', '2021-03-10 06:36:09'),
(427, '0zYF2xFMzvlfadE302foJEltJ9KPcRiSpqyuZ5QD', '2021-03-10 10:28:45', '2021-03-10 10:28:45'),
(428, 'ZwzKiA8outM1LJ1ocUzDHRgPxORf1B29D4OS9Bbm', '2021-03-11 14:06:12', '2021-03-11 14:06:12'),
(429, 'VUiKJ2apTRndMMLc3exKsXJ3kDDmPZtP1DLQ1jwM', '2021-03-11 14:34:46', '2021-03-11 14:34:46'),
(430, 'izSqURQiltAMdWPdGi36FAzjv2aAeqgHbl7LrN8P', '2021-03-11 14:59:56', '2021-03-11 14:59:56'),
(431, 't3cSBO0CIPmSP0qIoQtIqXh9rYN7LfqQDmMsNdM0', '2021-03-11 15:00:45', '2021-03-11 15:00:45'),
(432, 'ySaDYcbGloZnB5jrnqOejDG1KUIEIhv9FvokSF1Y', '2021-03-11 15:00:48', '2021-03-11 15:00:48'),
(433, 'Gb4cT8vZNM8YNHrwP2snE6XKRMQd0jruoVvZlU0z', '2021-03-11 15:56:58', '2021-03-11 15:56:58'),
(434, 'AqJmhrjHmBmevt8S1WmFsqqn3p7UCUR21FDU8l8u', '2021-03-12 08:37:04', '2021-03-12 08:37:04'),
(435, 'rmQZtgU5WWtgpQ3YnDhZc79BWsslSTOXemoxpqAK', '2021-03-17 08:06:29', '2021-03-17 08:06:29'),
(436, 'UlJ43xMCIUnlyNu5i5KyQg8GCaSqpQBjFqAHCtg7', '2021-03-17 08:08:04', '2021-03-17 08:08:04'),
(437, '7X6NR58thAsKJaeG5AlinWx24Dl6SYSNPqlX9hJC', '2021-03-17 08:08:17', '2021-03-17 08:08:17'),
(438, 'g5eKHnDg2PxR1er9zl1gRuB1XhqyuG4hGAUzOe92', '2021-03-17 08:08:33', '2021-03-17 08:08:33'),
(439, 'yigucbX6vzUIWssLGLXmoMfh8bU3V9tkkgvvMmjI', '2021-03-17 08:08:46', '2021-03-17 08:08:46'),
(440, '97TjA3o6TCqOE74YDKYAhFhA27uU8vPPXlfe7plU', '2021-03-17 14:22:48', '2021-03-17 14:22:48'),
(441, 'ThadXlo8NXse6fAPXXto2puD2OWBeQaDQLxKcl1z', '2021-03-17 14:28:24', '2021-03-17 14:28:24'),
(442, '5eg0mdB1HaCPBMPaan2uYA6FINYZKaJphj5XajQV', '2021-03-17 14:30:01', '2021-03-17 14:30:01'),
(443, '3cug6sHciLtTXO8w5Re8Yn65tjoN1gGmxNreNtVX', '2021-03-17 14:30:59', '2021-03-17 14:30:59'),
(444, 'xIctcQqgki21jbEtBAYuwIn4ZYTuW5awcmYsITDy', '2021-03-17 14:31:46', '2021-03-17 14:31:46'),
(445, '3x5dt3LIFb1reXkp48Jdhm2mCD29C1kUkgFcEqt2', '2021-03-17 14:33:39', '2021-03-17 14:33:39'),
(446, '7EzmeAY1SBsMNxhJGyCuzbiUQrazCYCqjGvEIX3Q', '2021-03-18 06:51:02', '2021-03-18 06:51:02'),
(447, 'v1oa6yYXYAiq9wpv3dQMSICAnOD65Rmqqm6L174o', '2021-03-18 06:54:32', '2021-03-18 06:54:32'),
(448, 'e4ocbd9fQI2CyYeb3koYXF90ZKy8etwPhRLoXDdK', '2021-03-19 08:00:02', '2021-03-19 08:00:02'),
(449, 'ZOZaqQ0v2h0B9uWTrmCxdwmaLBUFW3i2CpVq85I4', '2021-04-01 06:30:13', '2021-04-01 06:30:13'),
(450, 'ANJvuFgN2T5O0VLXBOnW6CAbo2ESWAxcGEPOowSx', '2021-04-07 10:55:18', '2021-04-07 10:55:18'),
(451, 'Ly4DoJq8OmMQN4o64AbQewDw0n7xC9hNbuJauA1y', '2021-04-11 17:12:58', '2021-04-11 17:12:58'),
(452, '6twLu37MfYDmMOgY13mkt6Vijjy9O5hLROddgDoS', '2021-04-13 09:24:20', '2021-04-13 09:24:20'),
(453, 'NEsvVR1NRF8Rcjcbsz4SLvtMG5yrcMkrSZVTuS0S', '2021-04-13 17:19:54', '2021-04-13 17:19:54'),
(454, 'HiydrX7D2pkadjo3jJ77csH7k88v0HerkEw1Kwsm', '2021-04-13 17:24:55', '2021-04-13 17:24:55'),
(455, '7S3NKacVmSHlI0CtiRq3bGQZ6E96exoCnyRmkE25', '2021-04-14 15:53:51', '2021-04-14 15:53:51'),
(456, 'nZmkbuq6OpnEDy6QWzaVocwJzNiyLWSXBwY4iXlm', '2021-04-14 15:57:13', '2021-04-14 15:57:13'),
(457, 'ABNf0uWB2Qukr7LXOi1mMAhsRr5T1RQNxV8KSZIX', '2021-04-20 15:00:23', '2021-04-20 15:00:23'),
(458, 'adyZdoBjtQ39fzSSBWALEiaQkrHXAZXaGEzDKUgA', '2021-04-22 17:35:57', '2021-04-22 17:35:57'),
(459, 'pZNHrs5SqCnpKgaTbeHWefGceAzdaBMmfnDj894M', '2021-04-22 17:36:51', '2021-04-22 17:36:51'),
(460, 'cSY6KKJrc4RcYUi8knC33SX67aZLuv9ow6sYXP8p', '2021-05-19 07:26:21', '2021-05-19 07:26:21'),
(461, '3wnGDmIKEabfD23ZzRQCtqJZcL2ksSurpjvw4nVT', '2021-05-19 07:49:17', '2021-05-19 07:49:17'),
(462, 'TM4iFJNfM2VZ4X5qsphknH3vfWq34uFQcZ0Z0tSg', '2021-05-19 07:52:32', '2021-05-19 07:52:32'),
(463, 'L9LkqN3ORPlw0P77oIP1Fi7E8bzVTt3BNQyDfYkB', '2021-05-19 07:54:01', '2021-05-19 07:54:01'),
(464, 'LaxmI4I378j0sdJk5UEHpqrvTspolJOt73PLyOjK', '2021-05-19 07:58:51', '2021-05-19 07:58:51'),
(465, 'pkSPYjoo8wYCuNZpGvnZcvVunZcI9MiCL2ycotrd', '2021-05-19 07:59:30', '2021-05-19 07:59:30'),
(466, 'zh0ZhHvJkg8FcsAHlTnuRcmFU8LF2E58geTwD4QD', '2021-05-19 07:59:36', '2021-05-19 07:59:36'),
(467, 'd8RDb6JIZM4IKqKSpPRNSlSYq88agAclX3aamXos', '2021-05-19 08:05:49', '2021-05-19 08:05:49'),
(468, 'AD7jWaMCLgNHDF9MyS6OU7oFPJZqT7u1sBWo6NpN', '2021-05-19 08:05:53', '2021-05-19 08:05:53'),
(469, 'xGHeY2nzV99FKTuQuNeiiMHzs1IzQi5QXcSUVMPZ', '2021-05-19 08:15:26', '2021-05-19 08:15:26'),
(470, 'O8C2WRQmuyPjp1Zkud9SCQ2e49xydjw54odlAFbE', '2021-05-20 04:21:44', '2021-05-20 04:21:44'),
(471, '9ehcSWUG1bMxyTERwsR1NSfDOMqpOjMkdZr6inXQ', '2021-05-20 04:46:13', '2021-05-20 04:46:13'),
(472, 'OSAllQ1C3RMGsgev6b3nt40q0gsmnPD1DEZOLc3n', '2021-05-20 10:05:45', '2021-05-20 10:05:45'),
(473, 'AAEpbLq9VPe16FZjBvwPTzPoz9ONxZpOeV7xvq5w', '2021-05-20 10:24:30', '2021-05-20 10:24:30'),
(474, 'LS7KYM8FWC7LcOrpzcP0ZlZ1MDpf408noiOhkVGA', '2021-05-20 10:57:19', '2021-05-20 10:57:19'),
(475, '4kEPzBYJkMRW9hgRbDAc8wRaOAuk3RLhcQjdWTza', '2021-05-21 10:31:26', '2021-05-21 10:31:26'),
(476, 'QhZnKvGwhgukqKU8Ep0uSBBpEfop6lSrsBUEIwJs', '2021-05-21 10:31:26', '2021-05-21 10:31:26'),
(477, '83GFvo3x02NDdDbxe3lzjNHwBbEjxqVBc0KkF0pL', '2021-05-24 04:02:49', '2021-05-24 04:02:49'),
(478, 'YMM3qOaqKFsVTOLf1RodspO5wUcyx9IwEyN8olhf', '2021-05-24 04:19:13', '2021-05-24 04:19:13'),
(479, '5B5dI4bpN8FLMdO3JHMcxPs6HvOfGZklzVcrpQf6', '2021-05-24 04:21:43', '2021-05-24 04:21:43'),
(480, '86GUCTnDKpYqYrnLDHLWkgq9oyKFtQW0Ntt2ZjNV', '2021-05-24 12:45:32', '2021-05-24 12:45:32'),
(481, 'xxqItqbLjX8znNeldyrz4sWK4lOAUDxV4LP1esGi', '2021-05-24 12:52:09', '2021-05-24 12:52:09'),
(482, 'JG6ZNMjNQOyx8AMCmgapl2DNm5POJPsueSX4OV37', '2021-05-24 12:53:19', '2021-05-24 12:53:19'),
(483, 'x6HyiRQpBu0UaJ6zxsTIwjrBFTonQe9yDVetrT0O', '2021-05-24 12:54:15', '2021-05-24 12:54:15'),
(484, 'cBtbihuVMrtZT6rbdPdvxAvhWqgqRXvyrxkWWD2x', '2021-05-24 13:08:21', '2021-05-24 13:08:21'),
(485, '4jYvIWIBCFaLp8JX39UXujepq5JoMyqbNb2cFOO5', '2021-05-25 02:37:11', '2021-05-25 02:37:11'),
(486, 'bxbmniqg91n3jmwurcGl2Sh2sKMT0B3A6I7PCzPv', '2021-05-27 07:26:40', '2021-05-27 07:26:40'),
(487, '1A8SZxG8TJt3gRlTjzkNaTKbxDl9Lb4cQBqsWDPd', '2021-05-27 10:50:20', '2021-05-27 10:50:20'),
(488, 'bXkxQDXQJjz5cDIq3Ei75ZZuWI6V5HdHuuKfuSe5', '2021-05-27 14:37:11', '2021-05-27 14:37:11'),
(489, 'y2ta9IL7yVYXbjPYtwKE26uP8YZHu7mIu8apiood', '2021-05-27 15:16:20', '2021-05-27 15:16:20'),
(490, 'i5WNpyzGiYim5AMfH58GXF8n6bRMg6RprLcEYXsw', '2021-05-27 15:22:52', '2021-05-27 15:22:52'),
(491, 'ymkena4uJyAT0mMMTppVmHzHoz6tHlKN51c45Hha', '2021-05-27 15:40:39', '2021-05-27 15:40:39'),
(492, 'D2puTb2dbgOZ9wM5awpUpwF4FlM13Wc630dH1Ysp', '2021-05-27 15:49:33', '2021-05-27 15:49:33'),
(493, '14kMYg6iZfut6GE4tQTWW5Qin9MIBLU6jWUmUrV9', '2021-05-28 05:52:23', '2021-05-28 05:52:23'),
(494, 'tCq7lpCPiVfjuF3XjgO13tsdKnBvzC77lMMkMNXg', '2021-05-28 10:27:22', '2021-05-28 10:27:22'),
(495, 'plrWPZAPE67BbLCSBNVLbW9J556dcKy2rsVsLbOp', '2021-05-28 10:37:51', '2021-05-28 10:37:51'),
(496, 'vMJfajH7GR9Ikz00o22Rf97SKKyCTwu6Xb2Ig0ds', '2021-05-28 10:49:30', '2021-05-28 10:49:30'),
(497, 'wbSIovAqbJaFsbpNKHcHlAmvGSEMlCf2P7pOBvRW', '2021-05-31 09:59:28', '2021-05-31 09:59:28'),
(498, 'qoiUwLp4oUWP335Qlr9DCNIrm32nC3Shl5XbWeqN', '2021-05-31 10:05:37', '2021-05-31 10:05:37'),
(499, 'gPuOspl3FUT0HEJm2jm6FH0WrI5B5GHkMziQWTdq', '2021-06-01 03:38:06', '2021-06-01 03:38:06'),
(500, 'wSqY3gTH4zD4av4hqcEuUDUDa5uTmIyjxzhyWbzD', '2021-06-01 04:01:39', '2021-06-01 04:01:39'),
(501, 'keHw5YSS247ijpxnVVdptCaQXxY5UgNvVLlFvFv4', '2021-06-01 04:03:40', '2021-06-01 04:03:40'),
(502, 'Y2mqGWMOVKMl1Qs9qyAPXffJGh2ooxQm1g3tYrmx', '2021-06-01 04:04:27', '2021-06-01 04:04:27'),
(503, 'AjodvxsaGTFo1DeCLcM5JXqoMd42m9a7aR3PW0wt', '2021-06-01 04:36:22', '2021-06-01 04:36:22'),
(504, '8HTIknmy6IujelfoDcNOWKhzdjc3ZALuT3LLCAcN', '2021-06-01 07:45:13', '2021-06-01 07:45:13'),
(505, 'v2dErNS5GNMj2N0MwptIt1MZMk3eCl8DxnrVDdVr', '2021-06-02 03:09:59', '2021-06-02 03:09:59'),
(506, 'JzX8PqOYPTSbCt28XmYuHRrpvUKxIkGsXKsuHXSr', '2021-06-02 03:16:46', '2021-06-02 03:16:46'),
(507, 'YynN0d4lyxVECtRT2w5q0uFcfLwOttCigO8BiDox', '2021-06-02 05:00:21', '2021-06-02 05:00:21'),
(508, 'My4wMSsqYatooqtJ19thiqWwzGTkyY1MljjnefuI', '2021-06-02 06:26:37', '2021-06-02 06:26:37'),
(509, 'XNrQtDykOGemGHCgoDfz7nhZgzQFBBgCkFUM8fEj', '2021-06-02 06:37:50', '2021-06-02 06:37:50'),
(510, 'LniTBxWkPwTGW7H0q1oGTy9iikqc1EDQSYtmJYHH', '2021-06-03 11:58:49', '2021-06-03 11:58:49'),
(511, 'bgeAE5r5eOL0LRkQKcpBVlxoCR4hOxtbqVOfqHRL', '2021-06-05 08:23:32', '2021-06-05 08:23:32'),
(512, '4g4QbBNBLBdfnwHm058DajJJ7grhiG9YFBX9eTZq', '2021-06-05 08:24:39', '2021-06-05 08:24:39'),
(513, '6FpNxoBryPPAPK2WOP8hWGwVYcOP7qVJF9fXRbWl', '2021-06-05 08:25:24', '2021-06-05 08:25:24'),
(514, 'wYQoFg3w41Ky7PZMv15PcUKFRpSiI4R3xoyMZlzV', '2021-06-05 08:39:34', '2021-06-05 08:39:34'),
(515, 'gRJJq56GUJGa8p2i1NXIEY5lDz48DaOzpslaoM0z', '2021-06-07 02:24:48', '2021-06-07 02:24:48'),
(516, 'K4Ofeajy22CwOwOJlA2dSWkyMhZHoiRa64bUj54t', '2021-06-08 05:38:31', '2021-06-08 05:38:31'),
(517, 'UPSAoeMyWzhhTPaWxsA7E2HkaUrFiMN7Q2IuzTfH', '2021-06-08 05:40:55', '2021-06-08 05:40:55'),
(518, 'tNEZCgItS6BxuoE0IXqxAcOT5LygXxmQVbG8gJtJ', '2021-06-08 05:43:45', '2021-06-08 05:43:45'),
(519, 'KbawH4HzVCT4kDBGZFhTGJv4z4VqqBYpjbRMmeZX', '2021-06-08 05:44:33', '2021-06-08 05:44:33'),
(520, 'CQLW61Xe3zWEx0rrIzIeh2WUINuYKz3thK2Rfw6Q', '2021-06-08 05:54:57', '2021-06-08 05:54:57'),
(521, 'xSU1k92BlSuc7fBl4Mr6EJ4YRFMbHLJ5uOMQEvoe', '2021-06-08 06:41:16', '2021-06-08 06:41:16'),
(522, 'YjimFj3Q0U2zHujIGySSV8bVuiiSw7HqENHnODvw', '2021-06-08 15:56:18', '2021-06-08 15:56:18'),
(523, 'aT58EPUtcwA58xLbkDr0SNsjrJnnPdkqJ0rnXNGH', '2021-06-08 15:59:18', '2021-06-08 15:59:18'),
(524, '9LRUkCd2uTdRjKUAPHkOtYKt9gZzgogmtgj5havU', '2021-06-08 16:07:27', '2021-06-08 16:07:27'),
(525, 'PMjzwIL0qHvnFCcFP58EdNc3yItJ6ec2FfMfjapR', '2021-06-08 16:07:32', '2021-06-08 16:07:32'),
(526, 'OHE1wg5eqrCEGqSOlNWwJTCuFHrY0efCsYnTXgPU', '2021-06-08 16:11:55', '2021-06-08 16:11:55'),
(527, 'yJ4klOFcGtQqfA76NCfKfmLWbEZ3rIyR8T58O0cf', '2021-06-08 16:12:19', '2021-06-08 16:12:19'),
(528, 'yui0MczxKmLaSOipgufuGWFElEwWMTX1YgHZ9r4R', '2021-06-08 17:51:36', '2021-06-08 17:51:36'),
(529, 'R2zalnwweCgAlEIGrVU7QRy0fGPRw6uj4Yy2ulPE', '2021-06-08 18:23:19', '2021-06-08 18:23:19'),
(530, 'v9CtcGhF9i0l8qsmB1TmvQpVw2wpYw2LB7WREFF8', '2021-06-09 02:06:56', '2021-06-09 02:06:56'),
(531, 'XIhclvdsiOXwCrbLoG7Rw35k2UT3328Om4DVuubI', '2021-06-09 02:07:17', '2021-06-09 02:07:17'),
(532, 'KbrCBkxnBxOSNCPbJRhopLfboCu6CBmkYZJZXyjF', '2021-06-09 02:07:52', '2021-06-09 02:07:52'),
(533, 'oz7XGffRcGVJcthUskH8xVNhYurBpLrKsY2yrmvy', '2021-06-09 04:48:05', '2021-06-09 04:48:05'),
(534, 'kZB7qltmbRsakfCfRQlpotdrH1vRoJVUE93Hu1je', '2021-06-09 04:48:18', '2021-06-09 04:48:18'),
(535, 'b0LYfTczjaDIxcrbftpy8WEcAUeoWm0Lruue1MH1', '2021-06-18 11:57:00', '2021-06-18 11:57:00'),
(536, 'OWVpCd5UzChV4LG2RmhxA0GpNC7lBtlYgHOkcKnS', '2021-06-18 11:59:13', '2021-06-18 11:59:13'),
(537, 'XcTNdENvQVQ8C02CFDxC1fvit59vCaaZxbBFo8VS', '2021-06-18 12:58:32', '2021-06-18 12:58:32'),
(538, 'FtB4vgf0T3VIOZeNPjizhkipcI7W8Sj5jHyZRsEG', '2021-06-18 17:25:32', '2021-06-18 17:25:32'),
(539, 'ukIAr3y5lJIEILr40OK6D6lqaBZyVi8m5J48KHqg', '2021-06-19 17:47:36', '2021-06-19 17:47:36'),
(540, 'zbe30rvKOMZpeQzQDbAJuNqvoADNbAlY4cU1d3NO', '2021-06-20 18:20:04', '2021-06-20 18:20:04'),
(541, 'iVAMpXmQWjQRkVpz0v9y4PuSnrCEoS8jD2ba5QNm', '2021-06-20 18:40:15', '2021-06-20 18:40:15'),
(542, 'AEimuItoyGilaXuaX9KwK0csZfAXVpoJNHQCarVp', '2021-06-20 19:38:12', '2021-06-20 19:38:12'),
(543, 'frVDQb28TQkQuM97SKB1BbHwRQ0Svxc3ubk0KB0x', '2021-06-20 19:38:14', '2021-06-20 19:38:14'),
(544, 'ERilkDCiG9xb5ubU7uSdzCnQw1rmaK5XkkI5Duo8', '2021-06-21 03:00:06', '2021-06-21 03:00:06'),
(545, 'JMJCjVvsgExYs9E5BVniYZ0UXNR5agydMHtWqra4', '2021-06-21 07:26:56', '2021-06-21 07:26:56'),
(546, 'YbaHDaBNdNralUxNsUGi0UtkYOb32acV0kc0Zwmu', '2021-06-21 09:47:40', '2021-06-21 09:47:40'),
(547, '9J8Y4bikxp2sexhmWA6OBHx4hPricGCP6szxotdR', '2021-06-21 10:45:25', '2021-06-21 10:45:25'),
(548, 'lSGvpyv3mlTxVJl0NwWoHuuMaSL40wJtJWtSvy0Q', '2021-06-21 10:50:17', '2021-06-21 10:50:17'),
(549, 'e2x45yqkzbOH2L9Spf193JM85xo5krFhsPdi0iin', '2021-06-21 10:51:30', '2021-06-21 10:51:30'),
(550, '8CM0Pcl4py4SDUWjhZBRbZeiZtQ2MyXoLsiqYWQZ', '2021-06-21 11:57:06', '2021-06-21 11:57:06'),
(551, 'jalYLK9EHvm5ZgQ9p1Pa8MeaJmkBFQj1emKjyamq', '2021-06-21 13:38:13', '2021-06-21 13:38:13');
INSERT INTO `user_session` (`id`, `session_id`, `created_at`, `updated_at`) VALUES
(552, '2RCYBPJdcGxx4PxnoMX2w4szXjcDDfn6glB6nd6n', '2021-06-21 13:39:59', '2021-06-21 13:39:59'),
(553, 'Y0mwV525xKYX3wwb7OwgdyMa4TUxENVryKNOCoUr', '2021-06-21 13:48:40', '2021-06-21 13:48:40'),
(554, '7SAh20LvubBk6mCFB20yJ0Y7MzTiNrl5mUbCe0iF', '2021-06-21 13:54:33', '2021-06-21 13:54:33'),
(555, 'yOskACuEFRoY1DQq5Gwb1q0pCtvQbB16u16RmvkQ', '2021-06-21 14:22:10', '2021-06-21 14:22:10'),
(556, 'QmUdDGBn0pj54EkpoisYff4mUYrGji3bFRXkeOTp', '2021-06-21 15:00:56', '2021-06-21 15:00:56'),
(557, '1zHKypirreSXgtyhVzTPg6ClKywVnipr7Texoew0', '2021-06-21 15:38:38', '2021-06-21 15:38:38'),
(558, 'pvE8sNiwPdvE8BBa74X6TNHvXRAcbXzE36EJatfK', '2021-06-21 16:11:21', '2021-06-21 16:11:21'),
(559, 'gAJLeSR5W3KXjQLYu9LUis2SCWUL0xSzn0ks3e9i', '2021-06-21 16:13:26', '2021-06-21 16:13:26'),
(560, 'bHOoFOLLerqYOodrR4o4k5vBZP4WRIpBCvL0UT6p', '2021-06-21 22:23:52', '2021-06-21 22:23:52'),
(561, 'yEYroLEbVqYF90COIXkFbLZOuu5U2kEU5KakFnMd', '2021-06-21 22:49:24', '2021-06-21 22:49:24'),
(562, 'oxtJmukRd21cNi8bAq6UUZewiR3oSoWSeEBc8K1o', '2021-06-22 08:04:03', '2021-06-22 08:04:03'),
(563, 'lxqCNyim83rnItkiVgxc8kKKLoFzcNtHZ5NKBLdH', '2021-06-22 08:19:16', '2021-06-22 08:19:16'),
(564, 'H5SKvk0ScmxwcEP4qD1Cp0KXiKBZI1e9CtADNp23', '2021-06-22 12:27:05', '2021-06-22 12:27:05'),
(565, 'ioMI8nmjMxuoWkXeaExGtQ47Yvb7hJ1i7oMAdAK9', '2021-06-22 12:48:14', '2021-06-22 12:48:14'),
(566, 'Hn9GxR2IePwbWQ7anI0VidibWlgSf9lxNjEupHtk', '2021-06-22 12:54:16', '2021-06-22 12:54:16'),
(567, 'GCao9BbFAaD1V4IAvZBfqAfyffR80h9fJoahLDuI', '2021-06-22 12:56:35', '2021-06-22 12:56:35'),
(568, 'IsCYyqm9TWB8JM3bGPCVwxloc3scOhJCfi19m3BH', '2021-06-22 12:58:09', '2021-06-22 12:58:09'),
(569, 'M1MFAR8pfL2QY6EA9dJRMMf5ibcdTbvtKo3b0tgk', '2021-06-22 13:00:12', '2021-06-22 13:00:12'),
(570, 'Z572tUE9IoAkvMMJJviNp7mYUpxRe3r1BtjyHJSF', '2021-06-23 04:37:59', '2021-06-23 04:37:59'),
(571, 'xDU6L2lAbTSAeTRU7qMynNqEzaluaRoOCGLbsheG', '2021-06-23 04:46:19', '2021-06-23 04:46:19'),
(572, 'psU0ouFagbRFrZvSbEcQHsOKSzfwe3V1ShJAnPtz', '2021-06-23 04:46:39', '2021-06-23 04:46:39'),
(573, '3m8csi7yrabfqMfsAVdDT6jQcsfcSpC3HcRhLokS', '2021-06-23 06:58:01', '2021-06-23 06:58:01'),
(574, '91pp4Iq6zHPYxb9e4zmOpwWcK94Vx2J4gghrFniB', '2021-06-23 09:36:34', '2021-06-23 09:36:34'),
(575, 'KvTEY805gJilxtNRfYTqIeaEqmnJZsYTz8LvFdlH', '2021-06-23 09:51:47', '2021-06-23 09:51:47'),
(576, 'Olc6I79V8oWk1i63SW4Ph542LtWizIs8uCxMCrca', '2021-06-23 09:57:07', '2021-06-23 09:57:07'),
(577, 'C8VnH8j6HCVb1CCtpGmnG9mJMMwz836iYnOKMZKk', '2021-06-23 09:57:23', '2021-06-23 09:57:23'),
(578, 'AZpFM9i62QcwBrPKKM1tWc2QaLob7z3741JUWd4O', '2021-06-23 12:24:30', '2021-06-23 12:24:30'),
(579, 'yNljNZSCoGnQJDKD7liVhsD48TmXCgjkhpYPvfAq', '2021-06-23 12:28:30', '2021-06-23 12:28:30'),
(580, 'wws3cv2r4CTDJER2MP5NugHW4rHu5jKCxJMl5w2H', '2021-06-23 14:41:04', '2021-06-23 14:41:04'),
(581, 'WbggaFIEbC7VWPBhFUCpPO9lghNWd6Ln5MLsMRvK', '2021-06-23 14:52:22', '2021-06-23 14:52:22'),
(582, 'KZKEgCJnOwHF5mJItdujk3MjW6GptaqXqrNTG9CI', '2021-06-23 14:55:06', '2021-06-23 14:55:06'),
(583, 'GwFBEEZOSnRGqWeRmcf98Z4oeUTtYX3pJLkP9gyK', '2021-06-23 16:53:42', '2021-06-23 16:53:42'),
(584, 'WsObQk6ujwQmNPd0exrOIxgetru60djNNhwGfTBZ', '2021-06-23 18:34:52', '2021-06-23 18:34:52'),
(585, '0PdDSLhcWiOlbEIMHXfp1O5Iz5mRk4pVpKzYNGJp', '2021-06-23 18:42:40', '2021-06-23 18:42:40'),
(586, 'm3gooPm2pPNpEqyl1VW4XrDvwZNotd7zufLoPbzd', '2021-06-23 20:43:10', '2021-06-23 20:43:10'),
(587, 'wIVXWW2EohAFeuXC1y5f8XFLkKZ2aGn2iNANL8FK', '2021-06-23 20:44:08', '2021-06-23 20:44:08'),
(588, 'gjIzCjd2Shy7PK1sBztKNDkETbac5wqyn3IMMbQc', '2021-06-24 03:59:28', '2021-06-24 03:59:28'),
(589, 'jKizNobXgTJP57Dx4dkBq1CljnGa6lUo9WJfT57r', '2021-06-24 04:52:49', '2021-06-24 04:52:49'),
(590, 'Yue3pkftL6LKIKn3BXDgmIdzcnqaHKOdVMy9Hj4F', '2021-06-24 04:58:09', '2021-06-24 04:58:09'),
(591, 'l1UlNyC7quOK0iDUaW8YeAIg2IWENEJVdFZkOmfj', '2021-06-24 04:59:47', '2021-06-24 04:59:47'),
(592, 'TpDFzBYMOjYbiJCFnner4DKRqQGz9ojJm39nXmUI', '2021-06-24 07:33:09', '2021-06-24 07:33:09'),
(593, '3sEANvw5T6soe4473Qix94KQl66LpcyWwKwpTNcm', '2021-06-24 10:00:24', '2021-06-24 10:00:24'),
(594, '5nOai4E1Dg0c906xHCVF9Ui4yKScc3IUMf8dyuKh', '2021-06-24 10:30:40', '2021-06-24 10:30:40'),
(595, 'ZwPB8wrWQzqeslBLzErTuB27KornTtUopsSmHn9Q', '2021-06-24 10:54:23', '2021-06-24 10:54:23'),
(596, 'dog5M12dlK6Sl4ZgxEnxRNlgTO37VgsOb7GWUQIA', '2021-06-24 11:38:27', '2021-06-24 11:38:27'),
(597, '5aHyhmzKTFXcz3uHrubrdttv9AwbaBUUWW1GChlh', '2021-06-24 12:12:47', '2021-06-24 12:12:47'),
(598, 'GXCr7yN5n1y8x3ng5bH5T6TOnueHrM1h7G8bcGih', '2021-06-24 16:31:23', '2021-06-24 16:31:23'),
(599, 'NqcMErOa7QTOspfN1bF0bVcBnXKP13msXCNGLARZ', '2021-06-24 16:32:15', '2021-06-24 16:32:15'),
(600, 'NKSpxt1A3k8HIUnQEZ23rV77rriEGNFDv9RQoNh1', '2021-06-24 16:41:52', '2021-06-24 16:41:52'),
(601, 'CeteinpP2J7Zrfh1kgXWjKBLlKL0vAAtyZfcVn8E', '2021-06-24 17:22:48', '2021-06-24 17:22:48'),
(602, 'UoCrV652rCJmAI5j5u9ygQjBOyNjJyIxNPWFXmKY', '2021-06-24 17:38:44', '2021-06-24 17:38:44'),
(603, '0joQ4DDFiaaQ4IbKRP1ygRQVhEIePee2bTG62qWW', '2021-06-24 17:47:06', '2021-06-24 17:47:06'),
(604, 'ubqM1xkZaQUWZ4WzzLbezAaulgV2DWZv3yBm0Hpa', '2021-06-24 17:49:14', '2021-06-24 17:49:14'),
(605, 'fxF4gepz08sQw8uGDyh1cMSU7Xm4WZvv5XpJn5TQ', '2021-06-24 17:50:17', '2021-06-24 17:50:17'),
(606, 'VPcuWGy3yccStycQMY1bELciLEZHEy66jLwV2RFl', '2021-06-24 17:51:39', '2021-06-24 17:51:39'),
(607, 'xq41mPdweFNvV69ok5lp5p3D5qVHFGKmPAm8GTEm', '2021-06-25 11:49:17', '2021-06-25 11:49:17'),
(608, 'iAP8j5nIPNZhoWNU9HMln2soTizE1F2Docs9lyq8', '2021-06-25 11:49:20', '2021-06-25 11:49:20'),
(609, '37CvdHBJ0yt0yjHthf1NHOhK6amUBBtc2s60IYkn', '2021-06-25 12:08:08', '2021-06-25 12:08:08'),
(610, 'FCxd0lHBHZE29yvRV6gl6nK2qFOWO7w1du1W7Ove', '2021-06-25 12:10:19', '2021-06-25 12:10:19'),
(611, 'F3dtcVyTrwPAKi9P2YcZtDIvQaSCss0c0FQJjGdC', '2021-06-25 12:12:31', '2021-06-25 12:12:31'),
(612, 'DpoecbVGXeQtjmTjN39BuMGHmGutB3ClBkc8E52B', '2021-06-25 12:31:19', '2021-06-25 12:31:19'),
(613, 'dMBShNujH6Zmr1AuZoFLLKqjHjYy30ayeOIALaYm', '2021-06-25 12:33:02', '2021-06-25 12:33:02'),
(614, 'atqCVbZSUeRFDskoqrNV0yIBYrVCqc4MXlQXy88A', '2021-06-25 12:37:35', '2021-06-25 12:37:35'),
(615, 'JDYaGBpf4vyQxGGhFY0QdsepwAEySCYISBFGaj6i', '2021-06-25 14:36:45', '2021-06-25 14:36:45'),
(616, 'ehFh23XxbF6n5JpGOICWwhDorDCr35jY28LLNnVa', '2021-06-25 14:38:46', '2021-06-25 14:38:46'),
(617, 'mOoGBf2CP2qo5iyp7zckY3vOQLJDFxgw2e0Ngwn9', '2021-06-25 14:55:51', '2021-06-25 14:55:51'),
(618, '5Nh34CP9dWB1ZV5ESxZs6xU9h2TMs9wOoSxelJDJ', '2021-06-25 14:56:26', '2021-06-25 14:56:26'),
(619, 'xMKYRQzwHNoICwHuOqkuA6gX49z52dyBXIpvyFr4', '2021-06-25 15:05:06', '2021-06-25 15:05:06'),
(620, 'BttoMPnUCvgGllAAAK0h44FrBGMNpCx0rjE9mU7a', '2021-06-25 20:16:46', '2021-06-25 20:16:46'),
(621, 'AJOaNeFy2yXzWBcKRDbahbuMobViJH73PUviWEtK', '2021-06-25 23:28:14', '2021-06-25 23:28:14'),
(622, 'iG3ADFwmZ5IuK4PUIwMTFMQKx6A8foL72s1wnc9y', '2021-06-25 23:38:19', '2021-06-25 23:38:19'),
(623, 'fIBlzJfF3zPB2Ug8OnDeUeRWfkC6SrpHx9dHAlZl', '2021-06-25 23:38:23', '2021-06-25 23:38:23'),
(624, 'j9lPRMaQVZmttwzgRpiHiQsfUJV2Ka8WHlSU4cnK', '2021-06-25 23:38:40', '2021-06-25 23:38:40'),
(625, '6rUxrOazVPUPwCGjF4SkTTmjAWbiWuPOmT2wYkn8', '2021-06-26 00:46:12', '2021-06-26 00:46:12'),
(626, 'Oyf1jZlYsANM5FYKInCnOpXR6HQHAN3eUGDbenNn', '2021-06-26 09:09:24', '2021-06-26 09:09:24'),
(627, 'UAe4b7HzRgoJyShBTYVG2QChZt1JMsPK69839V2O', '2021-06-27 09:10:38', '2021-06-27 09:10:38'),
(628, 'nOPMkvx8JKJhZCVgXye968SVArmEM5Pxdco5MK2v', '2021-06-27 09:21:19', '2021-06-27 09:21:19'),
(629, 'X7dj1ZhZgj2NfgRxHlXAxFLw3U3W4rkKMfeSnQu9', '2021-06-27 09:21:22', '2021-06-27 09:21:22'),
(630, '84SGEf9eo5ogTLtXfaqlAkTJN2U049qgDqAWIbZP', '2021-06-27 09:41:46', '2021-06-27 09:41:46'),
(631, 'ykwvd6MYIfSQigT1xgoWI2ItELgmj7FpHSYNvs8U', '2021-06-27 09:43:14', '2021-06-27 09:43:14'),
(632, 'aBmro58j37wyFgZcnm51tdsGilwET0fgq9Znz6zP', '2021-06-27 10:03:28', '2021-06-27 10:03:28'),
(633, 'nvhvzwQ7Ru1BlY5bzsoYoKUzpezlzCymgA1XdZIq', '2021-06-27 11:05:31', '2021-06-27 11:05:31'),
(634, '1ylc9CXAxviVHqFM0PBB1SvrrEVOymKyT1OSRM3a', '2021-06-27 13:13:15', '2021-06-27 13:13:15'),
(635, 'iDQthk7xdRIESVJ2BJzigcSvsMnGSgDH0CCTgRct', '2021-06-27 16:45:44', '2021-06-27 16:45:44'),
(636, '1qoII1ctmTKa1M21mHpI5c5VcjSH1qbWliZwS1ee', '2021-06-27 16:46:34', '2021-06-27 16:46:34'),
(637, 'fKSFMHMqsO9yOX5qezhPx06GK4ph4BdtXTWsbzCq', '2021-06-27 16:47:53', '2021-06-27 16:47:53'),
(638, 'cJoHs8tBxJEhXqSFTH0ec2fhKUYyc8Vd7630TS2G', '2021-06-27 16:56:52', '2021-06-27 16:56:52'),
(639, 'uYEzQGksLXfEwS8B5d5sq6Spi9KiM48WozV73Lyc', '2021-06-27 17:38:59', '2021-06-27 17:38:59'),
(640, 'EB3Y4mGAS9CT7osG6XuHdMjgYIgTnu0k8mCswsVl', '2021-06-28 02:57:36', '2021-06-28 02:57:36'),
(641, '057Ztzwmi2dMp9ribyqqpZDCfCijCYeQCcCm1Nig', '2021-06-28 03:21:00', '2021-06-28 03:21:00'),
(642, 'MiYMa0u2Ed7XQ6bEusKkk0yprXuDcpdVTtm8deHz', '2021-06-28 12:44:23', '2021-06-28 12:44:23'),
(643, 'uS3RXAaU0rch5gbbFvBfGdfdKUWeWyA8tlRFO0fD', '2021-06-28 14:58:36', '2021-06-28 14:58:36'),
(644, 'EBTVOtKw8ybULRxk9PPFFhznbf5UMBGSIXFbAtHc', '2021-06-28 15:03:50', '2021-06-28 15:03:50'),
(645, '3IjYoZuRcVcLu91I4oU7jTUhkpEBEeve55sdU8LO', '2021-06-28 15:08:14', '2021-06-28 15:08:14'),
(646, '1XywYaAfmd51dTdv9vVm8xPiSrFjLT4vHEWq9yba', '2021-06-28 15:16:57', '2021-06-28 15:16:57'),
(647, 'w6h6xNZ9NKH9JaBXyDJLJy6CqjTbNXh1dLsarYut', '2021-06-28 15:54:54', '2021-06-28 15:54:54'),
(648, 'GHxpvT3CfG3JTPzLFqTyM3QhgOliOOvA2Von7PsO', '2021-06-28 16:13:06', '2021-06-28 16:13:06'),
(649, 'wC025iiLz6yhYzgw0VluO6XshWYGn2bJKAU60ITR', '2021-06-28 16:23:15', '2021-06-28 16:23:15'),
(650, 'dllrFc6Y313fx5EA0LE48pFBUuyAXQCXEYHeJdFL', '2021-06-28 16:29:31', '2021-06-28 16:29:31'),
(651, '8j2cZShIXtuaCdPwClqigscpBidlCjN9LGFqlO8f', '2021-06-28 16:36:54', '2021-06-28 16:36:54'),
(652, 'p6BaXta2ey9BM75mIXTBUiYRD1mt6hdA2S54Y5tk', '2021-06-28 17:17:41', '2021-06-28 17:17:41'),
(653, 'CIZMoFQ7isYZ0BwjlIFo11e7zEMF3uYOqhe6IfS2', '2021-06-28 17:24:31', '2021-06-28 17:24:31'),
(654, 'xnGJay47T0ZfkHsxptcEcXctSfJyxfuv37WMaQnv', '2021-06-29 03:52:11', '2021-06-29 03:52:11'),
(655, 'tVXXHzHgBcZYqtkLgirNGT2N8zkh0wJxbQoAJVJj', '2021-06-29 04:04:34', '2021-06-29 04:04:34'),
(656, 'RMLbYVXsFxWxsIKXef7LAkj1bruMrOB8mj8xwKXW', '2021-06-29 04:10:39', '2021-06-29 04:10:39'),
(657, 'rUtBppfKTf6mswJ06Aqk5eS87uKDRpoUojajUuOe', '2021-06-29 04:11:56', '2021-06-29 04:11:56'),
(658, '17nvWRTwsizqH0YZ4kQMktEnDk7X1W7YTCCdotsq', '2021-06-29 08:12:01', '2021-06-29 08:12:01'),
(659, 'S1q0OIbmZzrwl9nHO2sUms7MM3CVwQ7EfCzB49mp', '2021-06-29 09:14:07', '2021-06-29 09:14:07'),
(660, 'K62rKg2AwheZvQcCWjVBlGzT70h072PPsQBuIHEd', '2021-06-29 09:16:09', '2021-06-29 09:16:09'),
(661, '8xeoSt1XHv9NFMkZonmgH5tYNV9LbaHDkhzuyqHP', '2021-06-29 13:12:36', '2021-06-29 13:12:36'),
(662, 'wiBM5Jx8MeovrtDSbOpsfEehLbuimzyYumHBGDHN', '2021-06-29 14:57:17', '2021-06-29 14:57:17'),
(663, 'LhU2IYhBzTDSIvh9dCsxzRgExBO3oPfQzSe5sCYJ', '2021-06-29 15:10:00', '2021-06-29 15:10:00'),
(664, '28i6q0grZxOkqCP8m1B8q3nokHOqZbwp2f8ZhMgF', '2021-06-29 15:10:06', '2021-06-29 15:10:06'),
(665, 'Bc94q4YvKhfDE8w0Nn9ukPyrRkkcyKjaSEnPTrTm', '2021-06-29 15:13:11', '2021-06-29 15:13:11'),
(666, 'xtqirLrqX2wKTM4SfbH1Ca3H7ZSHUEfUJ2qoVQwO', '2021-06-29 15:15:07', '2021-06-29 15:15:07'),
(667, 'PHj6bFlX5kgytzkMVK5ZMm9GwOJMIMuANKaKBJ7M', '2021-06-29 15:23:11', '2021-06-29 15:23:11'),
(668, 'KRkrYszs63NtiVaORNEA22Kzp3GjTsbqW92zGKaG', '2021-06-29 18:27:22', '2021-06-29 18:27:22'),
(669, 'MPvduSSZWZsFkvLDtFVyUIJszMipvMoL38PtpOPt', '2021-06-30 01:32:29', '2021-06-30 01:32:29'),
(670, 'rViPGXfcgJVRHU4d6CFKN5PfFhstEPBgMyAJflVl', '2021-06-30 01:32:32', '2021-06-30 01:32:32'),
(671, 'NyRwExtGrW7KMc1iQ5tnYtxSPMb2Ad0LwlgVMGoL', '2021-06-30 08:11:07', '2021-06-30 08:11:07'),
(672, '0iSHN0hB4Dp4ghsbTlQ4VOqI0Cz604SO3wmdmFbs', '2021-06-30 08:11:07', '2021-06-30 08:11:07'),
(673, 'tdQe8x6kKujfXTerF5UAqdqDhGLSLbSWDseNVvJc', '2021-06-30 09:25:11', '2021-06-30 09:25:11'),
(674, 'bjSbV1w6zYyjEtN01nsNGCb414BtCxVTC5jgt1Mg', '2021-06-30 11:24:23', '2021-06-30 11:24:23'),
(675, 'AZWepwPxhabF0dFLYxPXiy0nmuVO6m973Nfx42SX', '2021-06-30 11:31:00', '2021-06-30 11:31:00'),
(676, 'CeoYMeYRPChmpuqLZhTSKag8HALoWyozFRIGsU3g', '2021-06-30 11:34:19', '2021-06-30 11:34:19'),
(677, 'zIWoeXUoxpyK6GdcIModi5hY4PZ4yOG0I4LK4bRO', '2021-06-30 11:43:41', '2021-06-30 11:43:41'),
(678, '6n3ROGMuVyf5N7Cs2uhzmyX9EWIJvYlguztcmOrP', '2021-06-30 11:47:12', '2021-06-30 11:47:12'),
(679, '2QdyNn5uD971iQtx4xaZiDvFHt31kgFOXUTVumo7', '2021-06-30 11:51:02', '2021-06-30 11:51:02'),
(680, 'rPNmuWkmo6NQWkdnP0g2fnEEjOktJ1hmaKeuNli0', '2021-06-30 11:51:34', '2021-06-30 11:51:34'),
(681, 'igaL7pt98On8kSLuJFXFEk8ndsEr230xWAh9stGM', '2021-06-30 11:54:29', '2021-06-30 11:54:29'),
(682, 'mkNrUjTEhKV1FXKQTREhJvE5Q9FoPkU2z8m5IJLt', '2021-06-30 11:59:21', '2021-06-30 11:59:21'),
(683, '4AeknhiUQHIhtpu2su4tj56p1vT8qjirXEzVs99N', '2021-06-30 12:01:36', '2021-06-30 12:01:36'),
(684, 'O0XPS5bZGslPAvap0aGkWkJzokrD4ZZhaD79JcGU', '2021-06-30 12:10:14', '2021-06-30 12:10:14'),
(685, '6K0JUuKRUDMaEI0LEmoQHBgnlJnEJ0X7SvSm6cF3', '2021-06-30 12:13:12', '2021-06-30 12:13:12'),
(686, 'bDtMBnBhjPxaDRtGj3Y5BfJlOt8RugRpM0Go8XXZ', '2021-06-30 12:19:38', '2021-06-30 12:19:38'),
(687, 'ZraOIcRwZOgm4vcKhcf4rNObsPBK8Q0cLh9JcgSU', '2021-06-30 12:21:14', '2021-06-30 12:21:14'),
(688, 'pEopyDQvCfSeyST06BWUFIFfcBJ5gGRwhGLmXfp0', '2021-06-30 12:56:35', '2021-06-30 12:56:35'),
(689, 'leCqJG3Oj3cbm7axkmmsYJvKz6Axf2Yb0nsg6YBF', '2021-06-30 12:58:31', '2021-06-30 12:58:31'),
(690, 'BNlyiuyZrv2UoN7UQ8W9vJRYbTtSgTzarEOQaIBY', '2021-06-30 13:01:30', '2021-06-30 13:01:30'),
(691, 'McGc9AlAnm6e0JZHToQSVhiJuZE4YwyvxceQZfH6', '2021-06-30 13:03:05', '2021-06-30 13:03:05'),
(692, 'Hyj2nITxSScycvjYLAACSHSRfjqNnKKmr9abUDak', '2021-06-30 14:57:01', '2021-06-30 14:57:01'),
(693, 'jB0lk03rMlfnBtwxb0YQawvLbS1VScQp5AxPBJLW', '2021-06-30 18:15:09', '2021-06-30 18:15:09'),
(694, 'oE5G7Fbys7n9Z4m2MGAS102SuctyYXdR3PN2dZHC', '2021-06-30 18:15:15', '2021-06-30 18:15:15'),
(695, 'ikjup4OYfvVducVp2TwoCptJXxMI4R6I94vw9L6u', '2021-06-30 18:15:18', '2021-06-30 18:15:18'),
(696, 'MWkn6RCYhLNotdmktVjW2PIE9tAPi3EmZ17X1b81', '2021-07-01 06:09:27', '2021-07-01 06:09:27'),
(697, 'PPaeV8Vwmzjq0PfGSwP22ekT9CTcFVeegBBVPzZl', '2021-07-01 21:39:16', '2021-07-01 21:39:16'),
(698, 'y87FgsekwPtxkQaEXuCMSUXg5nPG9oHhQsRjcVfO', '2021-07-01 21:48:51', '2021-07-01 21:48:51'),
(699, 'wLX1TS4iS7bO7djvj904iwJQXnLFMzB3GFOgveXA', '2021-07-02 11:51:55', '2021-07-02 11:51:55'),
(700, 'qftviKdVsOqUdSi1ZWPmN3ygCUByctbptc0TyTUY', '2021-07-02 15:40:04', '2021-07-02 15:40:04'),
(701, 'dAg3qPhP2lNc8CFbWzBeyB18OOVDhuKnnsU434c5', '2021-07-02 16:08:15', '2021-07-02 16:08:15'),
(702, 'j6cCLpfBD5IEO4MQQzgSzzfb4XbENShzRUIP4AFo', '2021-07-03 06:31:20', '2021-07-03 06:31:20'),
(703, 'InOwbtvfwVvaWu7qus02gCWdNFjeunDbQ4yYA0TR', '2021-07-03 06:34:47', '2021-07-03 06:34:47'),
(704, 'MoXueeRzajuONIkEzylH8jfckRTNqCz8YNFSKjWk', '2021-07-04 05:38:59', '2021-07-04 05:38:59'),
(705, '6b3Sh6sccXXYjOBwoJbbd0h6rtNCmqKMruTGhA6E', '2021-07-05 02:24:56', '2021-07-05 02:24:56'),
(706, 'Trij0DydaW1BDsm75BHzLRPRaI6HuqRUTFKupAQD', '2021-07-05 03:37:35', '2021-07-05 03:37:35'),
(707, 'sULBNlt10hjanF5fvY9LtDLzAe1oFlNalkHsycUJ', '2021-07-05 03:42:59', '2021-07-05 03:42:59'),
(708, '2fD9GMFeYbJjCTWoic1vD0hTopzbdsP3PLSaYvjF', '2021-07-05 03:47:35', '2021-07-05 03:47:35'),
(709, '3Vkkqbgvi9pw8KFP6Hr1cfP4C2cNfvVwjIbQJfM3', '2021-07-05 03:57:46', '2021-07-05 03:57:46'),
(710, 'chPUVeJ866doWfZZGRRy53iB3HkJwoSjfQjgUwzb', '2021-07-05 03:58:55', '2021-07-05 03:58:55'),
(711, 'Nsexw9YXHHMZQuHYDAD96fQ6MuYoODPUy0p05ewn', '2021-07-05 04:39:34', '2021-07-05 04:39:34'),
(712, 'dwIT81UdOoh1Y8IUtnhfG7N4skybqFidegXyCqqc', '2021-07-05 04:43:23', '2021-07-05 04:43:23'),
(713, 'bGLQ8ahCeIGzNp5rO0ty9Vm9Ya8XgOB61MUFNxt1', '2021-07-05 04:44:28', '2021-07-05 04:44:28'),
(714, 'Ehuro94ltxXSUjQTUtU2J6kD1xU8RkpIdNQwbYaT', '2021-07-05 04:45:18', '2021-07-05 04:45:18'),
(715, 'bEcYhk2FuaJTEbuZ0EY0N52JGo5UXfgtR7ZBWzqr', '2021-07-05 04:46:21', '2021-07-05 04:46:21'),
(716, 'nGVbfgnS1rGh6FFri83rkbUZhhy8cOmdiK99Othq', '2021-07-05 04:50:06', '2021-07-05 04:50:06'),
(717, 'BByabJcH17OW1DRV4dcPSCNJY101IXFDFL5pRoWA', '2021-07-05 04:55:31', '2021-07-05 04:55:31'),
(718, 'Znd6fhSt2UsEWVgNr0e3a9P6GKopylhP99N3GSlL', '2021-07-05 05:00:51', '2021-07-05 05:00:51'),
(719, 'KNTFUMar06HtvWG37GpDQ01krP3G0gcsEM4zFgkR', '2021-07-05 05:02:42', '2021-07-05 05:02:42'),
(720, 'KwzTIkkrZbrJAHRZJaBVPa4Wuoc5w6PRBkM3v6BO', '2021-07-05 05:04:34', '2021-07-05 05:04:34'),
(721, 'jRCryifaryRRlUXq1P5EJZ529Cxq7QbH2RFDhJwe', '2021-07-05 10:49:30', '2021-07-05 10:49:30'),
(722, 'twwYghfpNelZ43wTBkbsjiTSNNVSHQdgdmRZzqMu', '2021-07-05 10:52:00', '2021-07-05 10:52:00'),
(723, '5BBemyLBlvrLxUG9swb5qtQsip7QIFxKtS8568Fr', '2021-07-05 12:32:31', '2021-07-05 12:32:31'),
(724, 'Tf1tSZnzgzViAyIf1B14YyakfofTF1E8rCRt0j99', '2021-07-05 14:53:24', '2021-07-05 14:53:24'),
(725, 'SBEog6079j9zdk07YupXtOm3IUCOynKOBg6NGvkj', '2021-07-05 15:40:37', '2021-07-05 15:40:37'),
(726, 'oeo2wz9lolm25MuzmkuRIH3bdDNkxzGsv2WsrkbI', '2021-07-05 15:41:01', '2021-07-05 15:41:01'),
(727, 'gBAE2IeeyNTKxGUe3NnXhwzGAY0LOACsFjmSt7XA', '2021-07-05 16:05:55', '2021-07-05 16:05:55'),
(728, 'yPO6ljrxdjSd1WDuHCWyTAnmvvV7dF4RpVcdnMud', '2021-07-05 16:20:14', '2021-07-05 16:20:14'),
(729, 'GmjwuMalpJyrY6woiSenOnbD9ZXeBYGzc8EYU2JN', '2021-07-05 16:20:37', '2021-07-05 16:20:37'),
(730, 'bRhPKLAfu0ytdT9MkkgvQ10AO5di4gJLSpHRwXTc', '2021-07-05 16:24:38', '2021-07-05 16:24:38'),
(731, 'joWEuRO0n6AyowgQh7itrTikoA2hXyUABfjTkQpr', '2021-07-05 16:25:18', '2021-07-05 16:25:18'),
(732, 'x4i0rneLS28UJ74N7YazbnFE9tmBkg2k72LbupoC', '2021-07-07 00:27:52', '2021-07-07 00:27:52'),
(733, 's7bv9ugUu1GWvWGAXrATKqzTPjwyABwue6RnQJQR', '2021-07-07 00:27:59', '2021-07-07 00:27:59'),
(734, 'Fm3wAY97QaePPvayjBu5G32ZpQuljjMMuCavZ0Ad', '2021-07-07 00:28:02', '2021-07-07 00:28:02'),
(735, 'OskD89jan3R9y7pnHBOTTO9H6D96Hss66KtH47ov', '2021-07-07 00:28:05', '2021-07-07 00:28:05'),
(736, 'AwYDhQhYK15WueQrfiifvTYYYFyZYnf0HRoaxcpa', '2021-07-07 05:39:16', '2021-07-07 05:39:16'),
(737, 'fz50cmx7beonUuQYJmoPXN09AhzlK9rjBWde0Xdd', '2021-07-07 07:00:03', '2021-07-07 07:00:03'),
(738, 'OB8vZFGCNFbdxN8p9XlloZGqgH3g9JrtYfeKZCiA', '2021-07-07 07:09:34', '2021-07-07 07:09:34'),
(739, 'zEkkbr7EawLaqiuKMqtL9PW262rI6GoWoGKVfUDx', '2021-07-07 07:12:31', '2021-07-07 07:12:31'),
(740, 'ImajTR5hrq8qTPgM46By9DVh5DO2itNLbtTD5DSf', '2021-07-07 07:15:31', '2021-07-07 07:15:31'),
(741, 'FpHokBPiKe55AHFMxWmnxFaiwYFePodnsWVk5Oct', '2021-07-07 07:20:23', '2021-07-07 07:20:23'),
(742, 'uGRxwFWG6soZQA8gmVDixGPrwYHpFA27fgoXFAYo', '2021-07-07 07:46:50', '2021-07-07 07:46:50'),
(743, 'E89vaPlzNbAoQDwYe7kqJZaxqQ8g7dwaesnLEA5Q', '2021-07-07 08:11:40', '2021-07-07 08:11:40'),
(744, 'L7lfuxMYmJZL6VtTavlbu1xDuphramDHubEbsPq2', '2021-07-07 08:11:41', '2021-07-07 08:11:41'),
(745, '0RUBy6u6QqtULgX4DqtXnMaxOGrKGqetliRZ4FyH', '2021-07-07 08:11:41', '2021-07-07 08:11:41'),
(746, 'GNDr6luWvc2kPkO2ISGDL0HwL9SgjbhbEULauPUd', '2021-07-07 08:11:41', '2021-07-07 08:11:41'),
(747, 'IEL5YpFpvxtmHsKiZw3SV1WrDwiYwQheoH2EDg3m', '2021-07-07 08:11:43', '2021-07-07 08:11:43'),
(748, 'xDEagJSVp0kHSgZkcKrRKqtDKJZhLrCHIho94uO3', '2021-07-07 08:22:55', '2021-07-07 08:22:55'),
(749, '9ALUkMPmuvNlN68hjipC973s1rf9VHtg1Zj7OlRb', '2021-07-07 08:24:38', '2021-07-07 08:24:38'),
(750, '76uP9Zhyp4Jzyv8mnLFeunhizAbhvqELD7HkNRov', '2021-07-07 09:42:55', '2021-07-07 09:42:55'),
(751, 'K7v5zo2PokgN5SrynDPjpvUBzOwKhEnpjTlSPTm7', '2021-07-07 12:06:14', '2021-07-07 12:06:14'),
(752, 'f8R7HZBF6Um16bxT1dcwwU2SJKz6QG1tzaK0fVUJ', '2021-07-07 12:12:09', '2021-07-07 12:12:09'),
(753, 'iX1WtPnFtfoE5xmTmvrSpdetNbXPDsrJ2f2dmbIi', '2021-07-07 13:14:36', '2021-07-07 13:14:36'),
(754, 'ejd083BD8cvLN9GwPZ6JSQi5jfoH0YNaBpO7ivPK', '2021-07-07 13:18:42', '2021-07-07 13:18:42'),
(755, 'zw24tmVOKUSMRoeeLiqXIwH39lABPqo0ZxVKQpBM', '2021-07-07 13:21:20', '2021-07-07 13:21:20'),
(756, 'fwArfLK48EBjasUuL60hrcK39ICMzNqQ4pClbRj5', '2021-07-07 13:28:26', '2021-07-07 13:28:26'),
(757, 'GhahoyE28MrEAj30OjISqHZjrysMYE8zjbgbU99Q', '2021-07-07 13:30:26', '2021-07-07 13:30:26'),
(758, 'p2iJD6G7OWH1Yg0gLZVNatbCaM5o5nEMqWTLJHnZ', '2021-07-07 13:37:32', '2021-07-07 13:37:32'),
(759, 'fyDku7Wd8BPJg8i97YTCwK7loYALFO7XqwvkDLhz', '2021-07-07 13:38:36', '2021-07-07 13:38:36'),
(760, 'lLsZMvbFAgfgRtevQFNdNWFNsLOWQalaboZz2e65', '2021-07-07 13:42:13', '2021-07-07 13:42:13'),
(761, '3buZAOsgeqSze65gPoP1T87lqHWFSE2cgTjDuFW1', '2021-07-07 13:44:17', '2021-07-07 13:44:17'),
(762, 'So6g6bwGaIvcolHYAkVIXyCHIRL7IQiHRgtKCMWI', '2021-07-07 13:45:13', '2021-07-07 13:45:13'),
(763, 'E2gjBAWlTSxu0yHvfFco5I0kEXkRZtzNUz2WUtl1', '2021-07-07 15:30:19', '2021-07-07 15:30:19'),
(764, 'EBNNTDjDXc6BYlxzfTr7oTZqgNKQU7J6o42WlrTZ', '2021-07-07 15:40:36', '2021-07-07 15:40:36'),
(765, 'YSPwXHMJtqluHl325ZqeJPkvdVHGrq14F4ennaX9', '2021-07-07 15:40:40', '2021-07-07 15:40:40'),
(766, 'd81FKw60Nh6agLUneIX97UZ10K77JoBOWqHhG78O', '2021-07-07 15:41:27', '2021-07-07 15:41:27'),
(767, 'zlQ8ULUi2agG1pWdmqx9Qg3znxobvui2ifSrIpzr', '2021-07-07 15:59:55', '2021-07-07 15:59:55'),
(768, '57FV5FN0njbhBYstpPSsuKLB8mDWkGp1eLawYUGN', '2021-07-07 16:27:21', '2021-07-07 16:27:21'),
(769, 'N90jxO4Qu0EK8IQVXYwm9z6S4prklEFJbdnHWPzr', '2021-07-07 16:45:02', '2021-07-07 16:45:02'),
(770, '2yJtCWUaYMzFBT14kC3yKQGqBi1xWcVBc9nJegtu', '2021-07-08 17:08:54', '2021-07-08 17:08:54'),
(771, 'wffh0tG8Q0T8tXArZsStJZpJZEgYQsENdW6xvnXU', '2021-07-09 08:48:57', '2021-07-09 08:48:57'),
(772, 'l9yezPiT0HenXTfoWrzpAw4mF1rqqjWVFQQxQpBW', '2021-07-09 14:26:00', '2021-07-09 14:26:00'),
(773, 'sL6BArP7Esp2VM4gjLKXpm3jAhNhObHfvJHtoLG2', '2021-07-09 15:09:09', '2021-07-09 15:09:09'),
(774, 'lfx2lCNjkPQBIL6usLfQegtF5FYNPyZnr6isjLhI', '2021-07-09 15:09:15', '2021-07-09 15:09:15'),
(775, '0S66y08NLJbztlhLt1RO4Iq0X7WuDY4NsEZLaX4A', '2021-07-09 15:15:19', '2021-07-09 15:15:19'),
(776, 'u2mKl4LYXlyYrzPohI2r6GJ6ybFuKpPbN5iqjpmw', '2021-07-09 15:16:23', '2021-07-09 15:16:23'),
(777, 'ytEqKQaJDNGrBV78d2lOu2ZuHNaplWC5KPTtE8f8', '2021-07-09 18:39:18', '2021-07-09 18:39:18'),
(778, 'dcZw0alrM0I6heNrmu6BUIUqPwGpPPuaem5IxFvC', '2021-07-09 18:42:16', '2021-07-09 18:42:16'),
(779, 'bvVcBN8WctMYAHg3XplNkjauHp96Ti0wvPjaLS3H', '2021-07-09 18:49:52', '2021-07-09 18:49:52'),
(780, 'hxrO7BujL7gHGOQXyH2ADumHuJKW7yEx9CFZKvhS', '2021-07-09 18:51:35', '2021-07-09 18:51:35'),
(781, 'ePMpUZHTnXzrG46v4ZhPU6lHmk2tMKq77NtV2WPD', '2021-07-09 18:53:50', '2021-07-09 18:53:50'),
(782, 'Tj4wf02BHtzEDTncyLJyqeadMhWUMUX49aNaMcOh', '2021-07-09 18:56:28', '2021-07-09 18:56:28'),
(783, 'ik2yrp5cx0oYZvUSBNuQf7nutkmPFDh3gUMBYgvn', '2021-07-09 18:59:00', '2021-07-09 18:59:00'),
(784, '3AJZPf37Bx4UYLvn12mukIqwC2IpAbXDZMGxA0pd', '2021-07-09 19:14:45', '2021-07-09 19:14:45'),
(785, 'XLF0xcKkzcwFNN1dnC15FCsyp9tseTbMevaLLv3V', '2021-07-09 19:19:59', '2021-07-09 19:19:59'),
(786, '4BtKUwlL34uEF74cNeOOAESn6ohJrg4DeyHTWnTw', '2021-07-09 19:22:53', '2021-07-09 19:22:53'),
(787, 'N5l6myGzqjRgIrRyksdP4jwnCznUBEeE9pKVV5x8', '2021-07-09 19:49:37', '2021-07-09 19:49:37'),
(788, 'kt3gfj8v4uIqNuNnGgC5winU3Ua7gk9mi3cLXyCO', '2021-07-09 19:53:51', '2021-07-09 19:53:51'),
(789, 'hjdOPAMuN8pkCHouDHnfdxPON3jJv2xHff9TODhZ', '2021-07-09 19:54:00', '2021-07-09 19:54:00'),
(790, 'u7pWquEwLbPwLCgH7fVbCPg13KLPEZbRriCAUstD', '2021-07-09 20:15:22', '2021-07-09 20:15:22'),
(791, 'X13MLGbz8ERuVl9LFZIgLuYnTAcLEJZ7tChu9Syr', '2021-07-09 20:22:20', '2021-07-09 20:22:20'),
(792, 'rX0oVDMJjzLlSHTJZLz3mIcTTjoklcyYboWWFB0o', '2021-07-10 07:16:03', '2021-07-10 07:16:03'),
(793, 'tmGawy9Ay7lG8429NalcvEyeZ4VXH6tjBDuGOIog', '2021-07-10 19:00:31', '2021-07-10 19:00:31'),
(794, 'uSpmewNFRMWr1n1tT9YYyFUGFFTdsG1wErLeLBDk', '2021-07-11 04:02:18', '2021-07-11 04:02:18'),
(795, 'OjZDQ4jsYmdbQMp19j9afKMnN0HVwzCizWPEHxDp', '2021-07-11 14:11:57', '2021-07-11 14:11:57'),
(796, 'AXhaNRDsf4XKkKcZ0Vg8GNL2cWnhvyhi17Xgx8YZ', '2021-07-12 07:52:26', '2021-07-12 07:52:26'),
(797, 'vN3p3OlfMBJnZXQJNHkwpdCIFthdnQVQuTfnSC5J', '2021-07-12 08:28:43', '2021-07-12 08:28:43'),
(798, 'W1y3y3rA3m7fc9qdMOBO5IdecM2XagH0tLUW6OnU', '2021-07-12 08:49:25', '2021-07-12 08:49:25'),
(799, 'RWRH8yRfGvACY5PtaAcQneS3GEJV6ya1ZrYMmY4x', '2021-07-12 09:01:06', '2021-07-12 09:01:06'),
(800, 'FMxRPYDTPZzTSTH3anjPg0VB8cNfFv0buGJUpnia', '2021-07-12 09:07:12', '2021-07-12 09:07:12'),
(801, 'SyvMD7C5Dbu2bTV7CUjl8eDmr2PwW0X4bY772fLC', '2021-07-12 12:19:50', '2021-07-12 12:19:50'),
(802, '1eiODVdrRVvCPGmvwtUbX9n75lH0aXWS55IQ4C5h', '2021-07-12 12:26:02', '2021-07-12 12:26:02'),
(803, '8TnkaHYXsoh2JmQXgGkzHzWHvqem8K5SvytbUNFK', '2021-07-12 14:28:14', '2021-07-12 14:28:14'),
(804, 'bJlrjafd5RMa1xRgvhgzUog8b3xdZxZ8wr5dxGk8', '2021-07-12 14:28:21', '2021-07-12 14:28:21'),
(805, 'vq220VEwC88zZ0j9lP0CUZrOn8zdUVYin6KV3wmq', '2021-07-12 14:28:24', '2021-07-12 14:28:24'),
(806, '1Z65SypvAA1mH30DQcCvHmZ7V0m3De6sI4mzBUNF', '2021-07-12 14:28:27', '2021-07-12 14:28:27'),
(807, 'lFEmbbZDE4Ub4hHlbukhTgEb9FAynG3RPRkIsMHU', '2021-07-12 14:28:30', '2021-07-12 14:28:30'),
(808, 'OcRLmf7EIT6z5hlqBSDuYofGQXNjtbBOOE9bUvFg', '2021-07-12 14:28:33', '2021-07-12 14:28:33'),
(809, '2bV5llmnQ1r6eah57D4PaH7j9Cl8EMLhBLgCNJzu', '2021-07-12 17:53:49', '2021-07-12 17:53:49'),
(810, 'H0PePJTbtYH5pd9ryQNr6r6lkokogz7DZcvXNt2s', '2021-07-12 18:06:39', '2021-07-12 18:06:39'),
(811, 'peLgvRryFvDlFXplk0W2BZ88oiyQlZQLW3KaWc8N', '2021-07-12 19:26:51', '2021-07-12 19:26:51'),
(812, 'yVlVvhT3JTOltETeA0AdlB6knmjfj7AUDdwgHGBA', '2021-07-13 08:21:56', '2021-07-13 08:21:56'),
(813, '6v5vhu2rubBYl6SdZfeHDrKTUgWO9AN1zfSnD2le', '2021-07-13 11:58:57', '2021-07-13 11:58:57'),
(814, '6cO2ZHAZN2OjrKiDsQkFtmJiXZbav0CQBIzu1lg6', '2021-07-13 12:01:24', '2021-07-13 12:01:24'),
(815, 'cVZcEdrsMytj1yucJIVLTYwcLI50fadOslZow8kI', '2021-07-13 12:03:38', '2021-07-13 12:03:38'),
(816, '9Y2oKmVHIDfOBFKBezh027oY3LzLzmwrV5oYtHri', '2021-07-13 12:07:25', '2021-07-13 12:07:25'),
(817, 'YjnjJ41DOoGZ2AVF1noZGdtsMYPElrFwKGhzrTGt', '2021-07-13 12:09:04', '2021-07-13 12:09:04'),
(818, 'ocpArOe5z8azWzVdCOhX7jnVzRdcBiigQ1Mk64rw', '2021-07-13 12:11:20', '2021-07-13 12:11:20'),
(819, 'B9TgJSRI8WajJ0IuVvXUp7bNc8qU474188wnEsyc', '2021-07-13 12:14:15', '2021-07-13 12:14:15'),
(820, '0UMUh3VvOB2GfTSFBnRZGhgTdbmyrONhYkreVWEZ', '2021-07-13 12:17:06', '2021-07-13 12:17:06'),
(821, 'zgiVQcmxlSOpzdWBkfayE6fntHFVpZWzLv1Ht9tn', '2021-07-13 17:13:10', '2021-07-13 17:13:10'),
(822, 'yr0gxPiDU4fAdc9a95t2K5gWK394VgKsL6noNDYG', '2021-07-13 17:15:31', '2021-07-13 17:15:31'),
(823, 'l1ognGbSDotfvvl4zeGXi0OLW8y4Sdh4qjpABPHs', '2021-07-13 17:18:38', '2021-07-13 17:18:38'),
(824, 'WMziA5jilj2Os5Nb52xUw08NVH8zHk4hlfJpE3cm', '2021-07-13 17:21:12', '2021-07-13 17:21:12'),
(825, 'y5328P6suRrzcpEkEbg5isYB9SP4sAuhlWQ0iimQ', '2021-07-13 21:11:49', '2021-07-13 21:11:49'),
(826, 'i7GAkSq2KLqLvftWFriRe2TfScRNDjfUsDlviSSg', '2021-07-14 07:53:32', '2021-07-14 07:53:32'),
(827, '34eN5mMG7HeBdPflUmniTcTUHNCGTWMom2KAxDlv', '2021-07-14 08:22:07', '2021-07-14 08:22:07'),
(828, 'HkXu1LWdNJDYcaxgApPLUODEE0DV2ZbYNeoj2beB', '2021-07-14 08:22:08', '2021-07-14 08:22:08'),
(829, 'q3tK8OfKvH52ydcIuBHANh3SzPAGIojJb0GvXgPa', '2021-07-14 08:22:10', '2021-07-14 08:22:10'),
(830, '0HG3A7ZFlE22HAhJhOeo19aFRZVs3MkDXp4Mnw7I', '2021-07-14 08:22:11', '2021-07-14 08:22:11'),
(831, 'fAF1eRCcamMMkRDHvMpR0O8jKmdGGAggLc5wBwg9', '2021-07-14 08:22:11', '2021-07-14 08:22:11'),
(832, 'dPGnAC4rYvfaichCzRQhagTFANrgFyzOhFLobGjE', '2021-07-14 08:22:12', '2021-07-14 08:22:12'),
(833, 'mkbFVz8Dx4sW4jgGITQiI6WMDngwLrOWEsnyLn0o', '2021-07-14 08:22:13', '2021-07-14 08:22:13'),
(834, 'JlllJZRRKJAn7E7STFNNfX1fQUnz6CmvUs2cAcli', '2021-07-14 16:13:35', '2021-07-14 16:13:35'),
(835, 'oFFzYGwaAvrPZvvsnIkwFxV1UtX83cIpjoPkGXGD', '2021-07-14 16:23:24', '2021-07-14 16:23:24'),
(836, 'kkXykxYnkg1BVfA921sQ9KrfL8GOoapVbdAALqrb', '2021-07-14 16:23:53', '2021-07-14 16:23:53'),
(837, 'ZI0KWhKYtCuLeHSivtmX68OPTaqOLX0rZ0tpqsdB', '2021-07-14 16:24:32', '2021-07-14 16:24:32'),
(838, 'N2HLsptbR1NJdsDyMjKAuAOhIyrvIvyvvzFHICbV', '2021-07-14 16:41:02', '2021-07-14 16:41:02'),
(839, 'fqtjmCiJPECku92YEhvnqPhQtn6W4BCikDApqFlA', '2021-07-14 16:41:05', '2021-07-14 16:41:05'),
(840, 'xNIGGGqubDt1EFyDpvpg3IUFrin2eMU90FieUB6t', '2021-07-14 16:41:08', '2021-07-14 16:41:08'),
(841, 'yIzciz9vlcDtUAmqwMBEcfjlpxu3ZVchSL36Tdbu', '2021-07-14 16:41:11', '2021-07-14 16:41:11'),
(842, 'InNEEnomZP30MNxuKdFO9Cv33qQfUAmERM9J27mC', '2021-07-14 16:41:14', '2021-07-14 16:41:14'),
(843, 'dax6sP8X0W4sPR3yJqWNw8TzP5cSDXFxwNZmTA3w', '2021-07-14 16:41:17', '2021-07-14 16:41:17'),
(844, '05pvKhicJ9grnamybUfL9cU6rRAzGbHfBAIh7IY0', '2021-07-14 19:41:51', '2021-07-14 19:41:51'),
(845, 'nC0FRAB6JSNO6pXdGRvVuz89rJT5ITl8fGWCa5ft', '2021-07-15 10:25:28', '2021-07-15 10:25:28'),
(846, 'QCB8UUM2KE8ky2XSctVtkYVE24wVMIxBMurTLbYC', '2021-07-15 10:35:29', '2021-07-15 10:35:29'),
(847, '4iepEAUZMvl8d5CgKN4xZ4cx9ClT6RHoT6v9j5AQ', '2021-07-15 15:07:52', '2021-07-15 15:07:52'),
(848, 'TcG6d9Vr5yjIUFGre4Gl85QOuVvlsQ8OPGg5lQIK', '2021-07-15 15:10:00', '2021-07-15 15:10:00'),
(849, 'rXGkc0xY24PqVGnnVCGbHPoyqro8hXPtAYLC7k4c', '2021-07-15 15:13:09', '2021-07-15 15:13:09'),
(850, 'M2xOeNkKjMFUSG6bQ8KtPVkzNlyCVR7okXAiJp5d', '2021-07-17 08:09:49', '2021-07-17 08:09:49'),
(851, 'FG7O65ikftH1fHcI5dPygNXhoX0Tfn0IhseqsKQv', '2021-07-18 09:56:49', '2021-07-18 09:56:49'),
(852, 'PYPMMDKHLLnwBYL2Sb1cy5cz0MrKd3qVCHoPHbMG', '2021-07-18 17:56:27', '2021-07-18 17:56:27'),
(853, 'atEGpkAu70R1HwztIeeNxRTf7oGMdk40qeUhOJ23', '2021-07-19 09:46:01', '2021-07-19 09:46:01'),
(854, 'HtprYw31GWOZOypLIJcWHq6LeHGUyt9VwDaSrabv', '2021-07-19 09:46:02', '2021-07-19 09:46:02'),
(855, '8D6oNisc9I2onTDGVNBRxdfA42fUKW02IlAL96Ji', '2021-07-19 09:51:19', '2021-07-19 09:51:19'),
(856, 'c7U5zzh1PXw4UunRrFrkFIcpvtjWSSerxYsUTAdP', '2021-07-19 09:51:20', '2021-07-19 09:51:20'),
(857, 'KnBvqfivhabHMBnQRJ6mMwNKZAlmoOVtWJwStp4I', '2021-07-19 09:54:08', '2021-07-19 09:54:08'),
(858, 'fbZzLF2ahBfD2dcBZYm6dfYCzTtrXDp0LjB9Pkce', '2021-07-19 09:54:15', '2021-07-19 09:54:15'),
(859, '1eQ2mp2weGgRNFUka2v3LpM9zIDBVjyheJzizohW', '2021-07-19 09:57:14', '2021-07-19 09:57:14'),
(860, 'JSGtXxqFqQelNQtrQTCSHLpWsqbM3oBNqoigIW7y', '2021-07-19 09:57:22', '2021-07-19 09:57:22'),
(861, 'RVj3pZSSjRMfujSxk1EZMGpMxEUdg7oxcgDaI06F', '2021-07-19 15:45:50', '2021-07-19 15:45:50'),
(862, 'VOuX5gjzKmwHI3t73FjvCfytHVzSJ1rk49pOEHWt', '2021-07-19 15:50:46', '2021-07-19 15:50:46'),
(863, 'BrKa1SVCAvnkpBb1OFrCaUaJZheJV88pkFhevg3t', '2021-07-19 16:03:35', '2021-07-19 16:03:35'),
(864, 'K6wUptTlU0LVRAzR1weYxHGcrjNZbn7MlQxRTu4v', '2021-07-19 16:03:40', '2021-07-19 16:03:40'),
(865, 'ITMPRJhburLrW1x3xWLqHiGoxjyPvJfYzOmkIrKI', '2021-07-19 16:12:49', '2021-07-19 16:12:49'),
(866, 'SqItQa5gmdV7aGgdkcy7PPcDQTRaY461cGPL2cZN', '2021-07-19 16:16:34', '2021-07-19 16:16:34'),
(867, 'G2xsEpW6ncS49Mk8kLUmvsWEbd6lxtwfA64DfZAo', '2021-07-19 16:17:19', '2021-07-19 16:17:19'),
(868, '2J5MWALhqMEnItaIuWgufzPX6LUqpb90LhQjuIsO', '2021-07-19 16:20:50', '2021-07-19 16:20:50'),
(869, '3ncApl4Z4tZnbnO7vdSam5nnjAX1G3lQKrV5cO5G', '2021-07-19 16:25:33', '2021-07-19 16:25:33'),
(870, 'pOcF570toaGqglEFcXigJ0f2rE4IHrmDsNN5h1t3', '2021-07-19 16:26:09', '2021-07-19 16:26:09'),
(871, 'd7qFOc4UglWnlvzleULRZb2QvLWcTkOr1uhhuBZP', '2021-07-19 16:28:20', '2021-07-19 16:28:20'),
(872, 'izVXYcGVkKAdh3nXpLh8QjI3JkgbNlQhjDurDls9', '2021-07-19 16:29:59', '2021-07-19 16:29:59'),
(873, 'xqF18z90Diw9xHdUPTCxxdGwUmvtZSjy6SgHOJYE', '2021-07-19 16:30:17', '2021-07-19 16:30:17'),
(874, 'k6oJBtBt22buhWBzUXIGyLlu4ZwTE355xvssp4il', '2021-07-20 11:06:07', '2021-07-20 11:06:07'),
(875, '01nLCG3wbInV2klJK4HUyyPnPRihzR4vusMjb6Bp', '2021-07-20 11:06:17', '2021-07-20 11:06:17'),
(876, 'RZoJKLfQl042TfLnqqZzTUqO9fKYp8a5zxChEFet', '2021-07-20 11:23:40', '2021-07-20 11:23:40'),
(877, 'uvTjFScDhHuKckLGcOgPEyL8PZjTYxR7r44qtKaM', '2021-07-20 11:59:10', '2021-07-20 11:59:10'),
(878, '85SgtJCwtSoemdcpDFktfvRsf2SllU7kWIv6Fc7E', '2021-07-20 11:59:15', '2021-07-20 11:59:15'),
(879, 'eNlcaVJAgrqzewfi8iailksULh8c1dol3dtmJIHA', '2021-07-20 12:00:30', '2021-07-20 12:00:30'),
(880, 'WKMw18NwIQuQ6bewXc013G2pVLheuGZP1WxfUcfF', '2021-07-20 15:13:34', '2021-07-20 15:13:34'),
(881, '7BhPpCmpStOg3FdjQgfbDZjkc2hHunPjb64s9S1x', '2021-07-20 15:20:28', '2021-07-20 15:20:28'),
(882, 'Za6tfsnRDtk8WpQU7VbLo3k7FvWU34yTB1vUavIb', '2021-07-20 16:22:25', '2021-07-20 16:22:25'),
(883, 'CDWrI4hHENH2vewUngXN8XY5ecueVpaWOVzioEAw', '2021-07-20 16:23:31', '2021-07-20 16:23:31'),
(884, 'iIIbxPdc5sBRfHC7vdSJi0YLL6oUMgDlIkwo1b5R', '2021-07-20 16:25:25', '2021-07-20 16:25:25'),
(885, '19UlMSRhZBOHyJg4Ir3jqCZcH6ibQoqH40ZxFf7i', '2021-07-21 08:33:07', '2021-07-21 08:33:07'),
(886, 'KvbDaFq1bqvjUFXK7esovUEMa1x0BSHdyK6Lv8e3', '2021-07-21 08:33:08', '2021-07-21 08:33:08'),
(887, 'QXpoej4eSTHWnfO0Ro97dXoKpzTjxRBOb579iTdF', '2021-07-21 08:33:08', '2021-07-21 08:33:08'),
(888, 'CkQoNgmbUHmrqmKavnPp3tFmyaLD1odLWhHB7fwJ', '2021-07-21 08:33:09', '2021-07-21 08:33:09'),
(889, 'BTedfxHvxVfQuJQfl47nPEpjOhq8NKUOIqAttAs0', '2021-07-21 08:33:10', '2021-07-21 08:33:10'),
(890, 'G2DYW4fbURxpyjHbz139oPVIFFXHzN4b6vfNC1Zd', '2021-07-21 08:33:10', '2021-07-21 08:33:10'),
(891, 'k0ZnMik0uiCHDXkKwJabXYsf4PNKY7Xr4dBBw6Sc', '2021-07-21 08:33:11', '2021-07-21 08:33:11'),
(892, '1aMaHfD3oP9DC7hdiAaFkc3V8hBamI54kf8jgBhX', '2021-07-21 08:33:12', '2021-07-21 08:33:12'),
(893, 'SKNMchSFP01rFePQYHYPUF6DU1EqygVPzi1zHDDX', '2021-07-21 11:01:52', '2021-07-21 11:01:52'),
(894, 'ceErGVOL0jJPeARhyel1wRM26Lana3FVeI91SbrQ', '2021-07-21 11:01:55', '2021-07-21 11:01:55'),
(895, '3ZZZD44j526H1U0jkKHouIj4BDS7cUryW2vEpVVP', '2021-07-21 11:04:27', '2021-07-21 11:04:27'),
(896, 'CCSFWnwEZBm7svOl4Pjo03sdbOeSHFlLbFyy4B9i', '2021-07-21 11:04:34', '2021-07-21 11:04:34'),
(897, '3AFLaYFEl7IagqCzOy6XQ1OrBMvvnUVGQZt08SAw', '2021-07-21 11:47:30', '2021-07-21 11:47:30'),
(898, 'yGeWS7zz4AhyXhgd3XpHm8R0TYbsIjR2Ng1d1FV1', '2021-07-21 14:09:13', '2021-07-21 14:09:13'),
(899, 'acwcNyrKnDeG622kCkFwaz2HbBpgxOZ1nnwEtgdJ', '2021-07-21 14:09:16', '2021-07-21 14:09:16'),
(900, 'XyLE87GXyNT2tMxm29o2tA1R1GYaYtLM6iLrwDoH', '2021-07-21 14:09:19', '2021-07-21 14:09:19'),
(901, 'n0QgaJ2IxSW7HbvxHBxFMiGVCsKFne0EBeUM0rxX', '2021-07-21 14:09:22', '2021-07-21 14:09:22'),
(902, '9GULly9Ci65dU4j1EDGwE5uNpnSGUyIZ8GO6Eydg', '2021-07-21 14:09:25', '2021-07-21 14:09:25'),
(903, 'PnQ0kdIOHtP2aBIpTdpnVgpvFcw7DiqvDGF516au', '2021-07-21 14:09:28', '2021-07-21 14:09:28'),
(904, 'TWRabB2lGHu9L7YRFI1hfdctQ19xrN7yKN8GlBXD', '2021-07-21 14:09:30', '2021-07-21 14:09:30'),
(905, '855PkkDkljYACLFDKx1tjqNX2J5sFPiA1NsOzAWz', '2021-07-22 06:57:48', '2021-07-22 06:57:48'),
(906, 'AoATG7WmR699yyAqnUp6gLTtVvdDMKbL6eGYL53C', '2021-07-22 06:57:51', '2021-07-22 06:57:51'),
(907, 'DdVc0J1OAvoibGyiO3Nnt0AxhHtAixnI4Ukv6ZJY', '2021-07-22 06:57:54', '2021-07-22 06:57:54'),
(908, 'ZzArjV1RECzSYbLluRdAUe28pcpx97TIdkAY2wpp', '2021-07-22 06:57:58', '2021-07-22 06:57:58'),
(909, 'A4Gk6KxYLxiP7Lo7y29GE7Hl8vnTR8SHDHQlJPsl', '2021-07-22 06:58:01', '2021-07-22 06:58:01'),
(910, '8tq6d50FZM6XvYMDhi8XTTgTb25LKzYJx2DnHclD', '2021-07-22 06:58:04', '2021-07-22 06:58:04'),
(911, 'UbvPcK8M8701bTyJXTVuctfcA6kzs5RVGR6MumBP', '2021-07-22 06:58:06', '2021-07-22 06:58:06'),
(912, 'LbgeaWQ8R5hfBfsBjrBECBYBNmxwmnZmubClDcXZ', '2021-07-22 10:29:12', '2021-07-22 10:29:12'),
(913, 'LBQ9gvGPTSXHNPFAXi90GZ6N81cfJarNbCY42QKf', '2021-07-22 12:19:16', '2021-07-22 12:19:16'),
(914, 'pEzYvYQFjhnDH93JCWWIOlwUUlT9GkmoL7k9xe2a', '2021-07-22 16:50:42', '2021-07-22 16:50:42'),
(915, 'WDt9Naxr3TCl2Xx8JE8dyLQb4ersGlKAxgDgpbD3', '2021-07-22 17:08:58', '2021-07-22 17:08:58'),
(916, 'UwAWOULaifJG6wRHjQH1wAdwjxlNjTtly4rgafhD', '2021-07-22 17:13:46', '2021-07-22 17:13:46'),
(917, 'v5oYQZ6OeEWkI9ZR6RzDYqvrKZdzAglKvpu7GBlD', '2021-07-22 23:22:59', '2021-07-22 23:22:59'),
(918, 'LVEwt3xlcj2LXvAUPLfWNnh1YknL84sywOiSFaMb', '2021-07-23 08:42:53', '2021-07-23 08:42:53'),
(919, 'nv5ruBmgwtl92kiPSeplySMViR9HXCtziO9ldLZA', '2021-07-23 08:53:09', '2021-07-23 08:53:09'),
(920, '2UkU1N6geTJcmlDlx1AEdDx5M39NPsQEpHBTkzMd', '2021-07-23 08:53:22', '2021-07-23 08:53:22'),
(921, 'CyPQaLOwggUjgvRBYZKbcXYSle5R9rPSdeSa9oey', '2021-07-23 09:10:31', '2021-07-23 09:10:31'),
(922, 'CbUqrmC7ymojVWfk3RladaleogqdBGapHLhvX4pl', '2021-07-23 09:13:53', '2021-07-23 09:13:53'),
(923, 'eG0hakZFz0rbKCdWR3kdEG173Wm2knBCRlYKKxle', '2021-07-23 10:10:48', '2021-07-23 10:10:48'),
(924, 'VmhEQ4nvtyU0pz8YqI9V3Y5zvGcfmZkbCTyYpAbI', '2021-07-23 16:26:42', '2021-07-23 16:26:42'),
(925, 'EyE8F9PMFVQwPAhlVjo5jkbAE1mGBNLL4XvP8vu1', '2021-07-24 02:46:45', '2021-07-24 02:46:45'),
(926, 'CptWqdC5bdao21akD24knM2hVdq5Xl3lN4ByQ0Op', '2021-07-24 02:47:24', '2021-07-24 02:47:24'),
(927, 'UyByUS1Jz81E2SGCusUAj8ynRSWYGFHOvI83te0i', '2021-07-25 17:00:27', '2021-07-25 17:00:27'),
(928, 'OFl5VBNQtaylM4ZdSXlMnBcWgDfhczqJZIz5axlz', '2021-07-25 17:17:55', '2021-07-25 17:17:55'),
(929, 'v0kiVXcdBZxJ79qCXFXJQSnonG1swlMFKvuk32Eg', '2021-07-25 19:26:23', '2021-07-25 19:26:23'),
(930, 'l9dMUDJUfsbXQLhIggtl5TrrEABJq0KPOMXrTzhX', '2021-07-25 21:42:25', '2021-07-25 21:42:25'),
(931, 'skFRXZqUI8oO6154S6eaCtD0ofydscDYilRpF3qE', '2021-07-25 22:59:45', '2021-07-25 22:59:45'),
(932, 'bvLR42gPXr1XH3xu97q78dVnc95uxc75cd2AZYPy', '2021-07-25 23:26:11', '2021-07-25 23:26:11'),
(933, 'NL6WSXxZraNEeXuAnvYKmtUOgjUumiEmpQDqBEbB', '2021-07-26 06:09:08', '2021-07-26 06:09:08'),
(934, '8eYFGQA1y2iknjmXQlnY903UtJnugz6SP5Ezk4np', '2021-07-26 06:19:45', '2021-07-26 06:19:45'),
(935, 'ys3CZ43MSk9shRYKgVetO7Z7Y6Wur1AmdAtSnSvb', '2021-07-26 07:47:05', '2021-07-26 07:47:05'),
(936, 'R0cLr7b10mlzLuO90JJqpl4stqLEs8luRYA5YyuH', '2021-07-26 07:47:06', '2021-07-26 07:47:06'),
(937, 'MbyyCeWn1PqOiOc2q1Fjd3drTpn9bKHKSYxLZEad', '2021-07-26 09:40:01', '2021-07-26 09:40:01'),
(938, 'BdzJLdD3P5CTaHyxcWy5ZKFm398rwuTGVKqne2C3', '2021-07-26 10:07:52', '2021-07-26 10:07:52'),
(939, 'aAQhYqUMx1YpFzKvxEK71JJAfplqVTRNCmsrOzi4', '2021-07-26 12:28:37', '2021-07-26 12:28:37'),
(940, 'VBsGUNYf8N1RfJC2pRWGPQw7j0QByyCNWCMeee1V', '2021-07-26 12:30:18', '2021-07-26 12:30:18'),
(941, 'r9zG8puyDbnv2A4TaUsb3JHqlbJFmM1iehUTiYTu', '2021-07-26 16:33:14', '2021-07-26 16:33:14'),
(942, 'uvA7ZrCmzNMRkhgqn8q2daWmHeED79uiwy9Cd26K', '2021-07-26 16:40:09', '2021-07-26 16:40:09'),
(943, 'e8nSAfVq7VH7dSOlbaBZznV58A4ZFW7CudeuCgcq', '2021-07-26 16:44:33', '2021-07-26 16:44:33'),
(944, 'UsshEFKloF6rt1RLLuAXHP0IUK7H3uaKzJTLwDxO', '2021-07-26 22:51:29', '2021-07-26 22:51:29'),
(945, 'qcAFBDSy4ss1NnPBCazTSmiRLgFaJ2X3o9xofFWb', '2021-07-26 23:00:51', '2021-07-26 23:00:51'),
(946, 'cRT9GAmGlTj3wOF2JGAYe2phEtDEorFwhtB1opsz', '2021-07-26 23:17:47', '2021-07-26 23:17:47'),
(947, 'n9PX0accGKkfmzhwapm41fkh4UOBYpuoNRwLLvlg', '2021-07-26 23:41:29', '2021-07-26 23:41:29'),
(948, '4ELPDKRKrvgJ0zVlCh2b7UtsAu1dBR0cwk3oFNm4', '2021-07-26 23:43:04', '2021-07-26 23:43:04'),
(949, 'qVSsEu1RawxGJIZzsflJl8bJ6GBuCnWCm3yIOp2z', '2021-07-27 07:57:49', '2021-07-27 07:57:49'),
(950, '6SJaAvd2rllMK8YUxisTWZri7lCIhiv4IpO3TGRx', '2021-07-27 07:59:44', '2021-07-27 07:59:44'),
(951, 'aJiHDEpGhmk0LHkGlGnRBcimzlWagCtLSuVX1a7u', '2021-07-27 14:30:33', '2021-07-27 14:30:33'),
(952, '3cNn6mjOAAttLAtK8IYLktNKBs4JX9SBziiX0zeV', '2021-07-27 14:46:00', '2021-07-27 14:46:00'),
(953, 'DzhjimA245VlXvpTQ0VBD2cTrkEUNe7eIKCN9GrM', '2021-07-27 14:47:30', '2021-07-27 14:47:30'),
(954, 'f0jC1bhyNZGL8JRIXL8IuRKNjMzIcdyqA1Iz61z5', '2021-07-27 19:14:24', '2021-07-27 19:14:24'),
(955, 'b8IZNCpfM5xBHQcmtLJnucVuyNPIRNKCfKhQx0GV', '2021-07-28 01:38:38', '2021-07-28 01:38:38'),
(956, 'XpzfVwX7NGf3Oze07OiPEL5hlSMeoLIdoWkxsB3t', '2021-07-28 01:57:26', '2021-07-28 01:57:26'),
(957, '9HVI8j39sIKUoq2kV1UToT3hNF2FgzmJIiQaRZ4H', '2021-07-28 01:58:09', '2021-07-28 01:58:09'),
(958, '5Ql6gkSZGK2C0Xo1hbQ7x41srWr6oMefQIxvMSbk', '2021-07-28 11:49:33', '2021-07-28 11:49:33'),
(959, 'kvkRUTJu4gpEnafpqm1H4zMX4M6QZMzdJfIxebTW', '2021-07-28 11:53:37', '2021-07-28 11:53:37'),
(960, 'saORTYREIWMTImJehUR4qFCxbfEQx1v3euccWXoV', '2021-07-28 11:58:22', '2021-07-28 11:58:22'),
(961, 'kP2gi0b1QrpElmFhLeRYwjzDfqa08a8fucuQK9Ds', '2021-07-28 12:03:41', '2021-07-28 12:03:41'),
(962, '6QgL9vsKqapOe6ys5Qw4e7lPLXIWpFdtsZyxL5Qc', '2021-07-28 15:15:28', '2021-07-28 15:15:28'),
(963, 'hMczlvxRSnpCw6b3Iy4Wt29iEAjaS1fEJRV1r817', '2021-07-29 03:32:21', '2021-07-29 03:32:21'),
(964, 'IdAx89pHq4sC9hWTWsAcWPYtNWE9olhoAnxRYrqu', '2021-07-29 08:00:45', '2021-07-29 08:00:45'),
(965, '4feQnqbg0EqPxXu1UJmpXTi2pkGbech7bWm2Nuk9', '2021-07-29 11:19:13', '2021-07-29 11:19:13'),
(966, 'MblNBQcFlweEpa0m6rcPEH8KxODyPUAPcIPTXdTE', '2021-07-29 11:22:55', '2021-07-29 11:22:55'),
(967, 'PP2REeNS3MV9ctnYljDThLqza91b4AcYgQfPJScn', '2021-07-29 11:22:56', '2021-07-29 11:22:56'),
(968, 'n2vgX2pEcpOf8srF7cAt78VfFCxvowKr0eZzoCqn', '2021-07-29 11:23:43', '2021-07-29 11:23:43'),
(969, '6J4UsWYeLFerLdv2n4BDMXCzgInx1FraOAtKbc0X', '2021-07-29 11:24:33', '2021-07-29 11:24:33'),
(970, 'mZIzj8be3aBrf706LyEueC7dMei11aLr1b1M0zbN', '2021-07-29 13:11:44', '2021-07-29 13:11:44'),
(971, 'aks0pyJIAJDUFo0NIIOSsZqsf55gbYW3deJBk8Rt', '2021-07-29 14:10:03', '2021-07-29 14:10:03'),
(972, '9qO5pQFDxdF4SXRmo1nB9yhwJkol4Qu6dSFbt3Fc', '2021-07-29 14:20:49', '2021-07-29 14:20:49');

-- --------------------------------------------------------

--
-- Table structure for table `website_contents`
--

CREATE TABLE `website_contents` (
  `id` int(11) NOT NULL,
  `title` text NOT NULL,
  `type` tinyint(1) NOT NULL DEFAULT 1,
  `content` text DEFAULT NULL,
  `created_at` timestamp NOT NULL DEFAULT current_timestamp(),
  `updated_at` timestamp NULL DEFAULT NULL ON UPDATE current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `website_contents`
--

INSERT INTO `website_contents` (`id`, `title`, `type`, `content`, `created_at`, `updated_at`) VALUES
(1, 'Seller box content', 1, '<p>Funding Joint can help your business access the cash tied up in your unpaid invoices sooner, in a fair and ethical way, so that you can fund your next project or acquire new clients.</p>', '2020-07-24 11:50:56', '2021-06-24 04:57:14'),
(2, 'Investor box content', 1, '<p>Invest in a share of an invoice from as little as &pound;100 in approved, credit-worthy companies and gain strong short-term sharia-compliant returns without interest. Capital at risk.</p>', '2020-07-24 11:51:09', '2020-08-14 17:19:06'),
(3, 'Seller Content', 1, '<p>Offering credit to your buyers is important to secure their business, but this means your money is tied up for the agreed credit-period and late payments can affect your cash flow.</p>\r\n\r\n<p>Releasing cash from invoices issued to buyers is a proven method of raising business finance and can be used for growth and development.&nbsp; Many companies, especially small and medium sized businesses, would benefit from invoice financing but are prohibited from the high cost of finance and from the lack of options that align with their values or beliefs.</p>\r\n\r\n<p>At Funding Joint, there are no pre-set rates and our smart platform allows businesses to control finance costs.&nbsp; Invoices are funded through auction by several investors using a peer-to-peer model which encourages the most competitive rates for your business.</p>\r\n\r\n<p>And because our structure is sharia-compliant, your business will be using a means of financing that does not involve interest.</p>', '2020-07-24 11:59:51', '2020-08-14 16:53:33'),
(4, 'Seller Image', 2, '159559522111.jpg', '2020-07-24 12:00:10', '2020-07-24 12:53:41'),
(5, 'Investor Content', 1, '<p>Investing in invoices can help to diversify your portfolio and obtain reliable, short-term returns.</p>\r\n\r\n<p>You can browse Funding Joint&rsquo;s marketplace for suitable investment opportunities that fit your investment profile.&nbsp; All companies are UK registered, have a proven trading history and are credit checked by us.</p>\r\n\r\n<p>Together with other investors, you can bid to fund a share of an invoice starting with a minimum investment of &pound;100.&nbsp; Funding Joint&rsquo;s platform lets you decide how much capital you want to invest and your desired rate of return.</p>\r\n\r\n<p>Our financing structure is sharia-compliant, so you can be confident you are investing in fair and ethical investments that do not rely on interest to provide returns.</p>\r\n\r\n<p>And unlike other invoice financing facilities, we do not charge investors any fees &ndash; there are no costs and you keep 100% of your return.</p>\r\n\r\n<p>Like all investment opportunities, there is risk that you may not get back your money.</p>', '2020-07-24 12:00:31', '2020-08-14 16:53:43'),
(6, 'Investor Image', 2, '15975142119.jpg', '2020-07-24 12:00:43', '2020-08-15 17:56:51'),
(7, 'Newsletter Content', 1, '<p>Enter your details here and we&#39;ll keep you updated with the latest news and developments at Funding Joint.</p>', '2020-07-24 12:00:55', '2020-08-14 16:54:02'),
(8, 'Who we are page Seller Content', 1, '<p>Alternative Finance serves a genuine need but despite the significant demand, there are limited options for businesses seeking a sharia compliant means of raising finance.&nbsp;</p>\r\n\r\n<p>But Funding Joint was not set up just to help businesses; we also provide the opportunity for investors to invest in sharia compliant asset-classes.</p>', '2020-07-24 11:59:51', '2021-06-24 04:59:41'),
(9, 'Who we are page Seller Image', 2, '15975167635.jpg', '2020-07-24 12:00:10', '2020-08-15 18:39:23'),
(10, 'Who we are page Investor Content', 1, '<p>Funding Joint is not just about being sharia compliant; our drive to provide a genuine and long-awaited alternative for lenders and investors alike means that we are non-conventional and unique.&nbsp;</p>\r\n\r\n<p>And this makes our service attractive to anyone interested in fair and ethical lending and borrowing: be that a business looking for a fairer form of funding and the benefits of invoice financing, or an investor seeking to invest in ethical short-term fixed income asset-based opportunities.</p>', '2020-07-24 12:00:31', '2020-08-02 16:14:21'),
(11, 'Who we are page Investor Image', 2, '15975168205.jpg', '2020-07-24 12:00:43', '2020-08-15 18:40:20'),
(12, 'How it works Seller Content', 1, '<p>If you are a UK registered company that&rsquo;s been trading for at least six months and have a turnover of &pound;100,000 or more, then you can place a funding request on Funding Joint&rsquo;s platform.</p>\r\n\r\n<p>You must have received a confirmation in the form of a Purchase Order (or an official document or communication) from another company to buy your products or services at a future date, for which you will issue an invoice with a minimum credit period of 14 days upon delivery of the order.</p>\r\n\r\n<p>Our registration process is simple and once approved, you can create a funding request against your future invoices.&nbsp; Our platform puts you in control and you can decide what share of the invoice you want funded and how much you are willing to discount that share by when placing it on sale to investors.&nbsp; And because your request will be fulfilled through an auction, you will receive the most competitive price for your funding, as investors actively compete against each other for a share in the investment.</p>\r\n\r\n<p>After the auction, we will transfer the funds raised to your business account when you issue your invoice; this means you don&rsquo;t have to wait the full term of the credit period before receiving payment and can start investing your money back into your business sooner.</p>\r\n\r\n<p>Funding Joint&rsquo;s unique structure means that you have assurance at the Purchase Order stage that finance will be available to you upon issue of an invoice, thereby improving your cashflow and allowing you to focus on your next project or client.</p>', '2020-07-24 11:59:51', '2020-08-14 16:57:51'),
(13, 'How it works Seller Image', 2, '160261599812.jpg', '2020-07-24 12:00:10', '2020-10-13 19:06:38'),
(14, 'How it works Investor Content', 1, '<p>Invoice financing has been a reliable source of return for many investors but most retail investors have been deterred by the lack of ethical alternatives or the minimum investment amounts required by some brokers.</p>\r\n\r\n<p>At Funding Joint, our investment opportunities are credit checked and must meet our ethical policy requirements before they are posted on our marketplace to ensure they are ethical and sharia compliant.</p>\r\n\r\n<p>Once you&#39;ve registered and been approved, you can browse the Funding Joint marketplace for investments that suit your profile and bid to invest in a share of an invoice at a discounted rate.&nbsp; And because our platform provides you with control, you can set your own rate of return.</p>\r\n\r\n<p>When the invoice is due, we will collect the payment and return your capital together with your profit.&nbsp; As with all investments, your capital is at risk.</p>\r\n\r\n<p>And not only do we offer a unique opportunity for retail investors to invest in a fixed income asset-class that is sharia compliant, but unlike other brokers, Funding Joint charge absolutely no fees to investors - you receive 100% of your returns.</p>', '2020-07-24 12:00:31', '2020-08-15 17:37:18'),
(15, 'How it works Investor Image', 2, '15955952107.jpg', '2020-07-24 12:00:43', '2020-07-24 12:53:30'),
(16, 'Who we are page Title', 1, '<p>We&rsquo;ve repurposed a tried and tested business funding option to provide financial inclusivity for all.</p>', '2020-07-24 11:59:51', '2020-08-14 17:24:14'),
(17, 'How it works title', 1, '<p>Invoice financing that&rsquo;s fairer for businesses and offers ethical and sharia compliant opportunities for investors.</p>', '2020-07-24 12:00:43', '2020-08-02 16:15:49'),
(18, 'Seller Content Title', 1, '<p>Funding for your business</p>', '2020-07-24 11:59:51', '2020-08-14 16:47:34'),
(19, 'Investor Content Title', 1, '<p>Invest in trade&nbsp;invoices for strong, fixed-income returns</p>', '2020-07-24 11:59:51', '2020-08-14 16:48:25'),
(20, 'Who we are Page Title', 1, '<p>Who we are</p>', '2020-07-24 11:59:51', '2020-08-02 16:12:23'),
(21, 'Who we are page Seller Content Title', 1, '<p>Why we were set up</p>', '2020-07-24 11:59:51', '2020-08-14 17:01:53'),
(22, 'Who we are page Investor Content Title', 1, '<p>Driven by our values</p>', '2020-07-24 12:00:31', '2020-08-14 17:03:59'),
(23, 'How it works Page Title', 1, '<p>How it works</p>', '2020-07-24 11:59:51', '2020-09-28 10:03:47'),
(24, 'How it works page Seller Content Title', 1, '<p>Pre-arrange your finance before issuing your invoices</p>', '2020-07-24 11:59:51', '2020-08-14 17:10:04'),
(25, 'How it works page Investor Content Title', 1, '<p>Ethical and sharia approved returns from invoice financing</p>', '2020-07-24 12:00:31', '2020-09-28 10:06:42'),
(26, 'Who we are header image ', 2, '160261683114.jpg', '2020-07-24 12:00:31', '2020-10-13 19:20:31'),
(27, 'How it works page header image ', 2, '160261881813.jpg', '2020-07-24 12:00:31', '2020-10-13 19:53:38');

--
-- Indexes for dumped tables
--

--
-- Indexes for table `account_balance`
--
ALTER TABLE `account_balance`
  ADD PRIMARY KEY (`id`),
  ADD KEY `account_balance_user_id_foreign` (`user_id`);

--
-- Indexes for table `admin_settings`
--
ALTER TABLE `admin_settings`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `auctions`
--
ALTER TABLE `auctions`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `bank_details`
--
ALTER TABLE `bank_details`
  ADD PRIMARY KEY (`id`),
  ADD KEY `bank_details_user_id_foreign` (`user_id`);

--
-- Indexes for table `bank_statements`
--
ALTER TABLE `bank_statements`
  ADD PRIMARY KEY (`id`),
  ADD KEY `bank_statements_user_id_index` (`user_id`);

--
-- Indexes for table `bids`
--
ALTER TABLE `bids`
  ADD PRIMARY KEY (`id`),
  ADD KEY `bids_user_id_foreign` (`user_id`),
  ADD KEY `bids_auction_id_foreign` (`auction_id`);

--
-- Indexes for table `buyers`
--
ALTER TABLE `buyers`
  ADD PRIMARY KEY (`id`),
  ADD KEY `buyers_user_id_foreign` (`user_id`);

--
-- Indexes for table `buyer_transactions`
--
ALTER TABLE `buyer_transactions`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `comments`
--
ALTER TABLE `comments`
  ADD PRIMARY KEY (`id`),
  ADD KEY `comments_commentable_type_commentable_id_index` (`commentable_type`,`commentable_id`),
  ADD KEY `comments_child_id_foreign` (`child_id`);

--
-- Indexes for table `documents`
--
ALTER TABLE `documents`
  ADD PRIMARY KEY (`id`),
  ADD KEY `documents_user_id_foreign` (`user_id`);

--
-- Indexes for table `homepage_section`
--
ALTER TABLE `homepage_section`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `inquiry`
--
ALTER TABLE `inquiry`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `investors`
--
ALTER TABLE `investors`
  ADD PRIMARY KEY (`id`),
  ADD KEY `investors_user_id_foreign` (`user_id`);

--
-- Indexes for table `invoices`
--
ALTER TABLE `invoices`
  ADD PRIMARY KEY (`id`),
  ADD KEY `invoices_auction_id_foreign` (`auction_id`),
  ADD KEY `invoices_user_id_index` (`user_id`);

--
-- Indexes for table `laravel_inline_editor`
--
ALTER TABLE `laravel_inline_editor`
  ADD PRIMARY KEY (`id`),
  ADD KEY `laravel_inline_editor_key_index` (`key`);

--
-- Indexes for table `migrations`
--
ALTER TABLE `migrations`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `model_has_permissions`
--
ALTER TABLE `model_has_permissions`
  ADD PRIMARY KEY (`permission_id`,`model_id`,`model_type`),
  ADD KEY `model_has_permissions_model_id_model_type_index` (`model_id`,`model_type`);

--
-- Indexes for table `model_has_roles`
--
ALTER TABLE `model_has_roles`
  ADD PRIMARY KEY (`role_id`,`model_id`,`model_type`),
  ADD KEY `model_has_roles_model_id_model_type_index` (`model_id`,`model_type`);

--
-- Indexes for table `notifications`
--
ALTER TABLE `notifications`
  ADD PRIMARY KEY (`id`),
  ADD KEY `notifications_notifiable_type_notifiable_id_index` (`notifiable_type`,`notifiable_id`);

--
-- Indexes for table `password_resets`
--
ALTER TABLE `password_resets`
  ADD KEY `password_resets_email_index` (`email`);

--
-- Indexes for table `permissions`
--
ALTER TABLE `permissions`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `purchase_orders`
--
ALTER TABLE `purchase_orders`
  ADD PRIMARY KEY (`id`),
  ADD KEY `purchase_orders_auction_id_foreign` (`auction_id`);

--
-- Indexes for table `roles`
--
ALTER TABLE `roles`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `role_has_permissions`
--
ALTER TABLE `role_has_permissions`
  ADD PRIMARY KEY (`permission_id`,`role_id`),
  ADD KEY `role_has_permissions_role_id_foreign` (`role_id`);

--
-- Indexes for table `sellers`
--
ALTER TABLE `sellers`
  ADD PRIMARY KEY (`id`),
  ADD KEY `sellers_user_id_foreign` (`user_id`);

--
-- Indexes for table `site_faqs`
--
ALTER TABLE `site_faqs`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `site_pages`
--
ALTER TABLE `site_pages`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `transactions`
--
ALTER TABLE `transactions`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `transactions_reference_unique` (`reference`),
  ADD KEY `transactions_user_id_foreign` (`user_id`);

--
-- Indexes for table `users`
--
ALTER TABLE `users`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `users_email_unique` (`email`);

--
-- Indexes for table `user_session`
--
ALTER TABLE `user_session`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `website_contents`
--
ALTER TABLE `website_contents`
  ADD PRIMARY KEY (`id`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `account_balance`
--
ALTER TABLE `account_balance`
  MODIFY `id` int(10) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=40;

--
-- AUTO_INCREMENT for table `admin_settings`
--
ALTER TABLE `admin_settings`
  MODIFY `id` int(10) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2;

--
-- AUTO_INCREMENT for table `auctions`
--
ALTER TABLE `auctions`
  MODIFY `id` int(10) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=97;

--
-- AUTO_INCREMENT for table `bank_details`
--
ALTER TABLE `bank_details`
  MODIFY `id` int(10) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=33;

--
-- AUTO_INCREMENT for table `bank_statements`
--
ALTER TABLE `bank_statements`
  MODIFY `id` int(10) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=18;

--
-- AUTO_INCREMENT for table `bids`
--
ALTER TABLE `bids`
  MODIFY `id` int(10) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=126;

--
-- AUTO_INCREMENT for table `buyers`
--
ALTER TABLE `buyers`
  MODIFY `id` int(10) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=28;

--
-- AUTO_INCREMENT for table `buyer_transactions`
--
ALTER TABLE `buyer_transactions`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=21;

--
-- AUTO_INCREMENT for table `comments`
--
ALTER TABLE `comments`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=145;

--
-- AUTO_INCREMENT for table `documents`
--
ALTER TABLE `documents`
  MODIFY `id` int(10) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=124;

--
-- AUTO_INCREMENT for table `homepage_section`
--
ALTER TABLE `homepage_section`
  MODIFY `id` int(10) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=5;

--
-- AUTO_INCREMENT for table `inquiry`
--
ALTER TABLE `inquiry`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=13;

--
-- AUTO_INCREMENT for table `investors`
--
ALTER TABLE `investors`
  MODIFY `id` int(10) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=17;

--
-- AUTO_INCREMENT for table `invoices`
--
ALTER TABLE `invoices`
  MODIFY `id` int(10) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=14;

--
-- AUTO_INCREMENT for table `laravel_inline_editor`
--
ALTER TABLE `laravel_inline_editor`
  MODIFY `id` int(10) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=62;

--
-- AUTO_INCREMENT for table `migrations`
--
ALTER TABLE `migrations`
  MODIFY `id` int(10) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=23;

--
-- AUTO_INCREMENT for table `permissions`
--
ALTER TABLE `permissions`
  MODIFY `id` int(10) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=13;

--
-- AUTO_INCREMENT for table `purchase_orders`
--
ALTER TABLE `purchase_orders`
  MODIFY `id` int(10) UNSIGNED NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `roles`
--
ALTER TABLE `roles`
  MODIFY `id` int(10) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=4;

--
-- AUTO_INCREMENT for table `sellers`
--
ALTER TABLE `sellers`
  MODIFY `id` int(10) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=21;

--
-- AUTO_INCREMENT for table `site_faqs`
--
ALTER TABLE `site_faqs`
  MODIFY `id` int(10) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=15;

--
-- AUTO_INCREMENT for table `site_pages`
--
ALTER TABLE `site_pages`
  MODIFY `id` int(10) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=8;

--
-- AUTO_INCREMENT for table `transactions`
--
ALTER TABLE `transactions`
  MODIFY `id` int(10) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=414;

--
-- AUTO_INCREMENT for table `users`
--
ALTER TABLE `users`
  MODIFY `id` int(10) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=354;

--
-- AUTO_INCREMENT for table `user_session`
--
ALTER TABLE `user_session`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=973;

--
-- AUTO_INCREMENT for table `website_contents`
--
ALTER TABLE `website_contents`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=28;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
