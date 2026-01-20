-- phpMyAdmin SQL Dump
-- version 4.6.6deb5
-- https://www.phpmyadmin.net/
--
-- Host: localhost:3306
-- Generation Time: Jul 03, 2019 at 12:41 PM
-- Server version: 5.7.26-0ubuntu0.18.04.1
-- PHP Version: 7.2.19-0ubuntu0.18.04.1

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `StudyBreak`
--

-- --------------------------------------------------------

--
-- Table structure for table `admission`
--

CREATE TABLE `admission` (
  `id` int(11) NOT NULL,
  `name` varchar(255) NOT NULL,
  `created_at` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP,
  `updated_at` timestamp NULL DEFAULT NULL,
  `deleted_at` time DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `admission`
--

INSERT INTO `admission` (`id`, `name`, `created_at`, `updated_at`, `deleted_at`) VALUES
(1, 'free', '2019-06-12 08:56:57', NULL, NULL),
(2, 'RSVP-Free', '2019-06-12 08:56:57', NULL, NULL),
(3, 'Paid ticket required', '2019-06-12 08:57:12', NULL, NULL);

-- --------------------------------------------------------

--
-- Table structure for table `annoucement_users`
--

CREATE TABLE `annoucement_users` (
  `id` int(11) NOT NULL,
  `user_id` int(11) NOT NULL,
  `group_id` int(11) NOT NULL,
  `annoucement_id` int(11) NOT NULL,
  `is_shown` int(11) NOT NULL,
  `created_at` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP,
  `updated_at` timestamp NULL DEFAULT NULL,
  `deleted_at` int(11) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `annoucement_users`
--

INSERT INTO `annoucement_users` (`id`, `user_id`, `group_id`, `annoucement_id`, `is_shown`, `created_at`, `updated_at`, `deleted_at`) VALUES
(3, 52, 68, 10, 1, '2019-06-24 09:26:03', '2019-06-27 07:52:01', NULL),
(4, 64, 68, 10, 0, '2019-06-24 09:26:03', '2019-06-24 09:42:28', NULL),
(5, 52, 68, 11, 1, '2019-06-24 09:30:54', '2019-06-27 07:52:01', NULL),
(6, 64, 68, 11, 0, '2019-06-24 09:30:54', '2019-06-24 09:30:54', NULL),
(7, 52, 68, 12, 1, '2019-06-24 09:41:52', '2019-06-27 07:52:01', NULL),
(8, 64, 68, 12, 0, '2019-06-24 09:41:52', '2019-06-24 09:41:52', NULL),
(9, 52, 68, 13, 1, '2019-06-24 11:45:10', '2019-06-27 07:52:01', NULL),
(10, 64, 68, 13, 0, '2019-06-24 11:45:10', '2019-06-24 11:45:10', NULL),
(11, 49, 88, 14, 1, '2019-06-24 13:17:39', '2019-07-02 07:43:56', NULL),
(14, 49, 88, 17, 1, '2019-06-24 13:27:04', '2019-07-02 07:43:56', NULL),
(15, 52, 68, 18, 1, '2019-06-25 06:44:15', '2019-06-27 07:52:01', NULL),
(16, 64, 68, 18, 0, '2019-06-25 06:44:15', '2019-06-25 06:44:15', NULL),
(22, 69, 89, 24, 0, '2019-06-27 09:16:41', '2019-06-27 09:16:41', NULL),
(23, 69, 89, 25, 0, '2019-06-27 09:17:11', '2019-06-27 09:17:11', NULL),
(24, 69, 89, 26, 0, '2019-06-27 09:17:25', '2019-06-27 09:17:25', NULL),
(25, 49, 88, 27, 0, '2019-07-02 11:35:33', '2019-07-02 11:35:33', NULL),
(26, 49, 88, 27, 0, '2019-07-02 11:35:33', '2019-07-02 11:35:33', NULL),
(27, 0, 88, 27, 0, '2019-07-02 11:35:33', '2019-07-02 11:35:33', NULL),
(28, 0, 88, 27, 0, '2019-07-02 11:35:33', '2019-07-02 11:35:33', NULL);

-- --------------------------------------------------------

--
-- Table structure for table `announcement`
--

CREATE TABLE `announcement` (
  `id` int(11) NOT NULL,
  `group_id` int(11) NOT NULL,
  `user_id` int(11) NOT NULL,
  `description` varchar(255) NOT NULL,
  `created_at` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP,
  `updated_at` timestamp NULL DEFAULT NULL,
  `deleted_at` time DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `announcement`
--

INSERT INTO `announcement` (`id`, `group_id`, `user_id`, `description`, `created_at`, `updated_at`, `deleted_at`) VALUES
(1, 68, 52, 'This is description for the annoucement1', '2019-06-24 05:08:20', '2019-06-24 05:25:40', NULL),
(4, 68, 52, 'This is description for the annoucement2', '2019-06-24 07:01:19', '2019-06-24 07:01:19', NULL),
(5, 68, 64, 'This is description for the annoucement2', '2019-06-24 07:01:19', '2019-06-24 07:01:19', NULL),
(6, 68, 52, 'This is description for the annoucement5', '2019-06-24 07:55:10', '2019-06-24 07:55:10', NULL),
(7, 68, 52, 'This is description for the annoucement5', '2019-06-24 07:55:42', '2019-06-24 07:55:42', NULL),
(8, 68, 52, 'This is description for the annoucement5', '2019-06-24 07:58:14', '2019-06-24 07:58:14', NULL),
(10, 68, 52, 'This is description for the annoucemasaent10', '2019-06-24 09:26:03', '2019-06-24 09:42:28', NULL),
(11, 68, 52, 'This is description for the annoucement8733', '2019-06-24 09:30:54', '2019-06-24 09:30:54', NULL),
(12, 68, 52, 'This is description for the annoucement8733', '2019-06-24 09:41:52', '2019-06-24 09:41:52', NULL),
(13, 68, 52, 'This is description for the annoucement8733', '2019-06-24 11:45:10', '2019-06-24 11:45:10', NULL),
(14, 88, 49, 'Welcome selena back! Today we will be hosting a meeting for the new rec hsjsndnnd', '2019-06-24 13:17:39', '2019-06-25 09:56:28', NULL),
(17, 88, 49, 'Welcome back! Today we will be hosting a meeting for the new  gghjhjj', '2019-06-24 13:27:04', '2019-06-24 13:27:04', NULL),
(18, 68, 52, 'This is description for the annoucement8733', '2019-06-25 06:44:15', '2019-06-25 06:44:15', NULL),
(24, 89, 69, 'there are announcement added for the testing from ankit', '2019-06-27 09:16:41', '2019-06-27 09:16:41', NULL),
(25, 89, 69, 'mr.statk is come to here please check here', '2019-06-27 09:17:11', '2019-06-27 09:17:11', NULL),
(26, 89, 69, 'hello all of you', '2019-06-27 09:17:25', '2019-06-27 09:17:25', NULL),
(27, 88, 49, 'r6cyx5d', '2019-07-02 11:35:33', '2019-07-02 11:35:33', NULL);

-- --------------------------------------------------------

--
-- Table structure for table `check_events`
--

CREATE TABLE `check_events` (
  `id` int(11) NOT NULL,
  `user_id` int(11) NOT NULL,
  `event_id` int(11) NOT NULL,
  `is_approved` int(11) NOT NULL DEFAULT '0',
  `is_checked` int(11) NOT NULL,
  `created_at` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP,
  `updated_at` timestamp NULL DEFAULT NULL,
  `deleted_at` time DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `check_events`
--

INSERT INTO `check_events` (`id`, `user_id`, `event_id`, `is_approved`, `is_checked`, `created_at`, `updated_at`, `deleted_at`) VALUES
(1, 50, 17, 0, 1, '2019-06-28 06:53:20', '2019-06-28 12:21:23', NULL),
(2, 54, 17, 0, 1, '2019-06-28 11:08:11', '2019-06-28 12:21:23', NULL),
(3, 49, 24, 0, 0, '2019-07-01 13:34:01', '2019-07-01 13:34:01', NULL);

-- --------------------------------------------------------

--
-- Table structure for table `college`
--

CREATE TABLE `college` (
  `id` int(11) NOT NULL,
  `name` varchar(255) NOT NULL,
  `created_at` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP,
  `updated_at` timestamp NULL DEFAULT NULL,
  `deleted_at` time DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `college`
--

INSERT INTO `college` (`id`, `name`, `created_at`, `updated_at`, `deleted_at`) VALUES
(1, 'test college', '2019-05-28 06:56:50', NULL, NULL),
(2, 'test intrest ', '2019-05-28 06:57:17', NULL, NULL);

-- --------------------------------------------------------

--
-- Table structure for table `events`
--

CREATE TABLE `events` (
  `id` int(11) NOT NULL,
  `name` varchar(255) NOT NULL,
  `group_id` int(11) NOT NULL,
  `guest` varchar(255) NOT NULL,
  `date` varchar(255) DEFAULT NULL,
  `start_time` varchar(255) NOT NULL,
  `end_time` varchar(255) NOT NULL,
  `addmission` int(11) DEFAULT NULL,
  `lo` varchar(255) NOT NULL,
  `la` varchar(255) NOT NULL,
  `address` varchar(500) NOT NULL,
  `description` varchar(255) NOT NULL,
  `is_public` int(11) NOT NULL,
  `created_at` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP,
  `updated_at` timestamp NULL DEFAULT NULL,
  `deleted_at` time DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `events`
--

INSERT INTO `events` (`id`, `name`, `group_id`, `guest`, `date`, `start_time`, `end_time`, `addmission`, `lo`, `la`, `address`, `description`, `is_public`, `created_at`, `updated_at`, `deleted_at`) VALUES
(1, 'Stark Expo', 68, '68', 'Mr. Stark', '8:00 AM', '9:00 AM', 1, '11.11', '22.22', 'mailbu', 'This is best expo', 1, '2019-06-11 12:07:02', '2019-06-11 12:07:02', NULL),
(2, 'Stark Expooasa', 68, 'Mr. Stark', '2019-01-01', '8:00 AM', '9:00 AM', 1, '11.11', '22.22', 'mailbu', 'This is best expo', 1, '2019-06-11 12:08:18', '2019-06-24 05:00:35', NULL),
(3, 'Stark Expo', 68, 'Mr. Stark', '2019-01-01', '8:00 AM', '9:00 AM', 1, '11.11', '22.22', 'mailbu', 'This is best expo', 1, '2019-06-11 12:08:34', '2019-06-11 12:08:34', NULL),
(4, 'Stark Expo', 68, 'Mr. Stark', '2019-01-01', '8:00 AM', '9:00 AM', 1, '11.11', '22.22', 'mailbu', 'This is best expo', 1, '2019-06-11 12:09:03', '2019-06-11 12:09:03', NULL),
(5, 'Stark Expo', 68, 'Mr. Stark', '2019-01-01', '8:00 AM', '9:00 AM', 1, '11.11', '22.22', 'mailbu', 'This is best expo', 1, '2019-06-11 12:09:38', '2019-06-11 12:09:38', NULL),
(6, 'Stark Expo', 68, 'Mr. Stark', '2019-01-01', '8:00 AM', '9:00 AM', 1, '11.11', '22.22', 'mailbu', 'This is best expo', 1, '2019-06-11 12:10:50', '2019-06-11 12:10:50', NULL),
(7, 'Stark Expo', 68, 'Mr. Stark', '2019-01-01', '8:00 AM', '9:00 AM', 1, '11.11', '22.22', 'mailbu', 'This is best expo', 1, '2019-06-11 12:17:39', '2019-06-11 12:17:39', NULL),
(8, 'Stark Expo', 68, 'Mr. Stark', '2019-01-01', '8:00 AM', '9:00 AM', 1, '11.11', '22.22', 'mailbu', 'This is best expo', 1, '2019-06-11 12:21:57', '2019-06-11 12:21:57', NULL),
(9, 'Stark Expo', 68, 'Mr. Stark', '2019-01-01', '8:00 AM', '9:00 AM', 1, '11.11', '22.22', 'mailbu', 'This is best expo', 1, '2019-06-12 05:34:24', '2019-06-12 05:34:24', NULL),
(10, 'Stark Expo', 68, 'Mr. Stark', '2019-01-01', '8:00 AM', '9:00 AM', 1, '11.11', '22.22', 'mailbu', 'This is best expo', 1, '2019-06-12 07:26:38', '2019-06-12 07:26:38', NULL),
(11, 'Stark Expo', 72, 'Mr. Stark', '2019-01-01', '8:00 AM', '9:00 AM', 1, '11.11', '22.22', 'mailbu', 'This is best expo', 1, '2019-06-13 05:02:21', '2019-06-13 05:02:21', NULL),
(12, 'cycle race', 72, 'Mr.Stark', '2019-06-14', '06:00 AM', '08:00 AM', 1, '72.50899319999999', '23.0342822', 'Room No 1', 'there are added description for the testing pupose', 1, '2019-06-13 05:29:48', '2019-06-13 05:29:48', NULL),
(13, 'Cycle Event Race', 74, 'Mr.Stark', '15 06 2019', '19:00 PM', '20:00 PM', 1, '72.50899319999999', '23.0342822', 'Room No 1', 'This description added for the testing', 1, '2019-06-14 13:32:51', '2019-06-14 13:32:51', NULL),
(14, 'Stark Expo Mark  3', 68, 'Mr. Stark', '2019-01-03', '8:00 AM', '9:00 AM', 1, '11.11', '22.22', 'mailbu', 'This is best expo', 1, '2019-06-19 11:36:47', '2019-06-19 11:36:47', NULL),
(15, 'Stark Expooasa', 68, 'Mr. Stark', '2019-06-25', '08:00 AM', '07:00 PM', 1, '16.542320251464843', '48.250118898964146', 'mailbu', 'This is best expo', 1, '2019-06-19 11:36:55', '2019-06-25 04:37:56', NULL),
(16, 'Club Fan Event', 72, 'Mr.Stark', '20 06 2019', '13:00 PM', '14:00 PM', 2, '-88.703656', '32.3643098', 'Room 1', 'there are adding desc for the testing purpose', 1, '2019-06-20 06:40:53', '2019-06-20 06:40:53', NULL),
(17, 'Fan Club', 72, 'Mr.Stark John', '20-06-2019', '01:00 PM', '02:00 PM', 1, '-90.7262088', '33.8390012', 'Room 99', 'There are added desc for the testing purpose.', 1, '2019-06-20 06:46:34', '2019-06-20 06:46:34', NULL),
(18, 'Fan Club', 72, 'Mr.Stark Tony', '2019-06-20', '01:00 PM', '02:00 PM', 1, '-0.05746719999999998', '51.53763299999999', 'Block 1', 'There are added desc for the testing purpose', 1, '2019-06-20 06:55:20', '2019-06-20 06:55:20', NULL),
(19, 'Fan Club Party', 74, 'Mr.Stark John', '2019-06-20', '01:00 PM', '02:00 PM', 1, '-80.1300455', '25.790654', 'at Bar Side', 'There are added desc for the testing purpose .', 1, '2019-06-20 07:25:30', '2019-06-20 07:25:30', NULL),
(20, 'Stark Expo Mark  3', 68, 'Mr. Stark', '2019-01-03', '8:00 AM', '9:00 AM', 1, '11.11', '22.22', 'mailbu', 'This is best expo', 1, '2019-06-20 10:00:17', '2019-06-20 10:00:17', NULL),
(21, 'Tech Event', 86, 'abcde', '1987-07-06', '03:39 PM', '09:27 AM', 2, '4.9035614', '52.3679843', '123', 'This is for testing', 1, '2019-06-20 10:33:04', '2019-06-20 10:33:04', NULL),
(22, 'ycy', 72, 'ctc', '20-06-2019', '4:11 PM', '5:11 PM', 1, '-79.0377388', '43.0962143', 'vuvvuv', 'cg. ycyv', 1, '2019-06-20 10:42:00', '2019-06-20 10:42:00', NULL),
(23, 'fuucufu', 72, 'dyycuf', '2019-06-20', '04:26 PM', '04:57 PM', 2, '-79.0377388', '43.0962143', 'ufhcuf', 'uchxhchc', 1, '2019-06-20 10:57:40', '2019-06-20 10:57:40', NULL),
(24, 'Stark Expooasa', 87, 'Mr. Stark', '2019-01-01', '8:00 AM', '9:00 AM', 1, '11.11', '22.22', 'mailbu', 'This is best expo', 1, '2019-06-20 11:50:08', '2019-06-24 07:44:13', NULL),
(25, 'Stark Expo Mark  3', 87, 'Mr. Stark', '2019-06-20', '8:00 AM', '9:00 AM', 1, '11.11', '22.22', 'mailbu', 'This is best expo', 1, '2019-06-20 11:50:48', '2019-06-20 11:50:48', NULL),
(26, 'Stark Expo Mark  5', 87, 'Mr. Stark', '2019-06-20', '8:00 AM', '9:00 AM', 1, '11.11', '22.22', 'mailbu', 'This is best expo', 1, '2019-06-20 11:51:10', '2019-06-20 11:51:10', NULL),
(27, 'Stark Expo Mark  5', 87, 'Mr. Stark', '2019-06-20', '8:00 AM', '9:00 AM', 1, '11.11', '22.22', 'mailbu', 'This is best expo', 1, '2019-06-20 11:51:42', '2019-06-20 11:51:42', NULL),
(28, 'I got g', 72, 'cg y', '20-06-2019', '5:26 PM', '6:26 PM', 2, '-79.0377388', '43.0962143', 'cycyc', 'yyfyf', 0, '2019-06-20 11:56:29', '2019-06-20 11:56:29', NULL),
(29, 'jcudk', 72, 'jcu', '20-06-2019', '5:28 PM', '6:28 PM', 2, '-79.0377388', '43.0962143', 'cjgxx', 'k bj', 1, '2019-06-20 11:59:02', '2019-06-20 11:59:02', NULL),
(30, 'Stark Expooasa', 88, 'Mr. Stark', '2019-06-24', '10:00 AM', '07:00 PM', 0, '-74.1723667', '40.735657', 'block 11', 'There are testing desc added', 1, '2019-06-24 04:43:47', '2019-06-24 13:43:08', NULL),
(31, 'Cycle Event', 88, 'Mr.Stark', '2019-06-24', '10:00 AM', '07:00 PM', 0, '-117.9298493', '33.6188829', 'block 1', 'hello guys, there added testing desc', 1, '2019-06-24 06:36:29', '2019-06-24 06:36:29', NULL),
(34, 'Stark Expo Mark  3', 88, 'Mr. Stark', '2019-06-25', '09:00 AM', '01:00 PM', 1, '16.440147397806868', '48.20913525537747', 'path 1', 'This is best expo', 1, '2019-06-25 04:39:28', '2019-06-25 04:39:28', NULL),
(35, 'Stark Expo te', 88, 'Mr. Stark', '2019-06-27', '11:00 AM', '07:00 PM', 0, '16.468437190633267', '48.190462182620756', 'path 1', 'This is best expo', 1, '2019-06-25 04:40:20', '2019-06-27 07:11:36', NULL),
(36, 'Cycle event', 88, 'Mr.Rock', '2019-06-27', '08:00 AM', '11:00 PM', 0, '125.1802236', '6.132360900000001', 'Meeting Room 1', 'There are added testing descriptions', 1, '2019-06-25 04:54:37', '2019-06-26 03:06:59', NULL),
(37, 'Stark Expo Mark  3', 68, 'Mr. Stark', '2019-01-03', '8:00 AM', '9:00 AM', 2, '11.11', '22.22', 'mailbu', 'This is best expo', 1, '2019-06-26 11:11:05', '2019-06-26 11:11:05', NULL),
(38, 'Cycle Raceing', 88, 'Mr.Steve Jobs', '2019-06-28', '03:00 PM', '09:00 PM', 0, '-79.0377388', '43.0962143', 'Block 1 Street 44', 'hello there are adding testing desc', 1, '2019-06-28 09:21:34', '2019-06-28 09:26:00', NULL),
(39, 'Daily Cycle Challenge', 88, 'Mr.Robots Sneetch', '2019-06-29', '06:00 AM', '10:00 AM', 0, '-79.0377388', '43.0962143', 'Block 1', 'testing description added to there.', 1, '2019-06-28 09:23:43', '2019-06-28 09:26:24', NULL),
(43, 'Stark Expo Mark  11', 68, 'Mr. Stark', '2019-01-03', '8:00 AM', '9:00 PM', 1, '42.40', '73.45', 'mailbu', 'This is best expo', 1, '2019-07-01 07:38:38', '2019-07-01 07:38:38', NULL),
(44, 'Stark Expo Mark  12', 68, 'Mr. Stark', '2019-01-03', '8:00 AM', '9:00 PM', 1, '35.05', '106.39', 'mailbu', 'This is best expo', 1, '2019-07-01 07:39:06', '2019-07-01 07:39:06', NULL),
(49, 'Stark Expo Mark  14', 68, 'Mr. Stark', '2019-07-01', '8:00 AM', '9:00 PM', 1, '16.468437190633267', '48.190462182620756', 'mailbu', 'This is best expo', 1, '2019-07-01 08:55:25', '2019-07-01 08:55:25', NULL),
(51, 'Stark Expo Mark  16', 68, 'Mr. Starkdd', '2019-07-01', '8:00 AM', '9:00 PM', 1, '16.542320251464843', '48.250118898964146', 'mailbuqqqqq', 'This is best expo', 1, '2019-07-01 09:35:21', '2019-07-01 09:35:21', NULL),
(52, 'Steno Event', 88, 'Mr.Crown Step', '2019-07-02', '08:00 AM', '08:00 PM', 0, '-79.0377388', '43.0962143', 'Block 1', 'there are added testing desc.', 1, '2019-07-01 11:24:37', '2019-07-02 04:30:45', NULL),
(53, 'Jack Event', 88, 'Mr.Archer Jorge', '2019-07-02', '08:00 AM', '01:00 PM', 0, '-79.0377388', '43.0962143', 'BN Plot 1', 'there are added testing desc.', 1, '2019-07-01 11:26:33', '2019-07-02 04:30:22', NULL),
(54, 'Pull Party', 88, 'DJ Juice M', '2019-07-02', '07:00 PM', '11:30 PM', 0, '-79.0377388', '43.0962143', 'Ground no 3', 'there are added testing desc.', 1, '2019-07-01 11:29:05', '2019-07-02 04:31:03', NULL),
(55, 'Cycle event', 93, 'Mr.John Boees', '2019-07-03', '06:00 PM', '08:00 PM', 1, '-79.0377388', '43.0962143', 'Block 1', 'There are added testing desrption', 1, '2019-07-03 11:59:36', '2019-07-03 11:59:36', NULL);

-- --------------------------------------------------------

--
-- Table structure for table `event_images`
--

CREATE TABLE `event_images` (
  `id` int(11) NOT NULL,
  `event_id` int(11) NOT NULL,
  `name` varchar(255) DEFAULT NULL,
  `created_at` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP,
  `updated_at` timestamp NULL DEFAULT NULL,
  `deleted_at` time DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `event_images`
--

INSERT INTO `event_images` (`id`, `event_id`, `name`, `created_at`, `updated_at`, `deleted_at`) VALUES
(1, 8, '13236.jpeg', '2019-06-11 12:21:57', '2019-06-11 12:21:57', NULL),
(2, 8, '62788.jpg', '2019-06-11 12:21:57', '2019-06-11 12:21:57', NULL),
(3, 9, '67963.jpeg', '2019-06-12 05:34:24', '2019-06-12 05:34:24', NULL),
(4, 9, '59348.jpg', '2019-06-12 05:34:24', '2019-06-12 05:34:24', NULL),
(8, 2, '81054.jpg', '2019-06-12 08:58:37', '2019-06-12 08:58:37', NULL),
(9, 2, '53957.jpeg', '2019-06-12 08:58:37', '2019-06-12 08:58:37', NULL),
(10, 11, '91437.jpg', '2019-06-13 05:02:21', '2019-06-13 05:02:21', NULL),
(11, 12, '38494.PNG', '2019-06-13 05:29:48', '2019-06-13 05:29:48', NULL),
(12, 13, '16509.PNG', '2019-06-14 13:32:51', '2019-06-14 13:32:51', NULL),
(13, 13, '85358.PNG', '2019-06-14 13:32:51', '2019-06-14 13:32:51', NULL),
(14, 16, '37273.PNG', '2019-06-20 06:40:53', '2019-06-20 06:40:53', NULL),
(15, 17, '26577.PNG', '2019-06-20 06:46:34', '2019-06-20 06:46:34', NULL),
(16, 18, '25092.PNG', '2019-06-20 06:55:20', '2019-06-20 06:55:20', NULL),
(17, 19, '34225.PNG', '2019-06-20 07:25:31', '2019-06-20 07:25:31', NULL),
(18, 22, '15135.jpg', '2019-06-20 10:42:00', '2019-06-20 10:42:00', NULL),
(19, 22, '86462.jpg', '2019-06-20 10:42:00', '2019-06-20 10:42:00', NULL),
(20, 23, '13760.PNG', '2019-06-20 10:57:40', '2019-06-20 10:57:40', NULL),
(21, 23, '99610.PNG', '2019-06-20 10:57:40', '2019-06-20 10:57:40', NULL),
(22, 23, '54038.PNG', '2019-06-20 10:57:40', '2019-06-20 10:57:40', NULL),
(23, 23, '92562.PNG', '2019-06-20 10:57:41', '2019-06-20 10:57:41', NULL),
(26, 25, '48092.jpg', '2019-06-20 11:50:48', '2019-06-20 11:50:48', NULL),
(27, 25, '14264.jpeg', '2019-06-20 11:50:48', '2019-06-20 11:50:48', NULL),
(28, 26, '63731.jpg', '2019-06-20 11:51:11', '2019-06-20 11:51:11', NULL),
(29, 26, '23808.jpeg', '2019-06-20 11:51:11', '2019-06-20 11:51:11', NULL),
(30, 27, '27596.jpg', '2019-06-20 11:51:42', '2019-06-20 11:51:42', NULL),
(31, 27, '59078.jpeg', '2019-06-20 11:51:42', '2019-06-20 11:51:42', NULL),
(32, 28, '14791.jpg', '2019-06-20 11:56:29', '2019-06-20 11:56:29', NULL),
(33, 29, '18231.jpg', '2019-06-20 11:59:02', '2019-06-20 11:59:02', NULL),
(35, 31, '51135.PNG', '2019-06-24 06:36:30', '2019-06-24 06:36:30', NULL),
(38, 32, '95363.PNG', '2019-06-24 06:49:23', '2019-06-24 06:49:23', NULL),
(39, 33, '78812.PNG', '2019-06-24 06:55:40', '2019-06-24 06:55:40', NULL),
(40, 24, '81042.jpg', '2019-06-24 07:44:13', '2019-06-24 07:44:13', NULL),
(42, 30, '30460.PNG', '2019-06-24 13:43:08', '2019-06-24 13:43:08', NULL),
(43, 15, '14294.png', '2019-06-25 04:37:56', '2019-06-25 04:37:56', NULL),
(46, 36, '98299.PNG', '2019-06-26 03:06:59', '2019-06-26 03:06:59', NULL),
(48, 35, '89480.PNG', '2019-06-27 07:11:36', '2019-06-27 07:11:36', NULL),
(51, 38, '51546.PNG', '2019-06-28 09:26:00', '2019-06-28 09:26:00', NULL),
(52, 39, '84588.PNG', '2019-06-28 09:26:24', '2019-06-28 09:26:24', NULL),
(53, 42, '82686.png', '2019-07-01 06:56:50', '2019-07-01 06:56:50', NULL),
(54, 43, '95291.png', '2019-07-01 07:38:38', '2019-07-01 07:38:38', NULL),
(55, 44, '26859.png', '2019-07-01 07:39:06', '2019-07-01 07:39:06', NULL),
(56, 45, '71575.png', '2019-07-01 07:39:28', '2019-07-01 07:39:28', NULL),
(57, 46, '95594.png', '2019-07-01 07:39:54', '2019-07-01 07:39:54', NULL),
(58, 47, '84493.png', '2019-07-01 08:54:45', '2019-07-01 08:54:45', NULL),
(59, 48, '48894.png', '2019-07-01 08:55:09', '2019-07-01 08:55:09', NULL),
(60, 49, '75750.png', '2019-07-01 08:55:25', '2019-07-01 08:55:25', NULL),
(61, 50, '70907.png', '2019-07-01 09:34:23', '2019-07-01 09:34:23', NULL),
(62, 51, '39625.png', '2019-07-01 09:35:21', '2019-07-01 09:35:21', NULL),
(67, 53, '66664.PNG', '2019-07-02 04:30:22', '2019-07-02 04:30:22', NULL),
(68, 52, '79988.PNG', '2019-07-02 04:30:45', '2019-07-02 04:30:45', NULL),
(69, 54, '52299.PNG', '2019-07-02 04:31:03', '2019-07-02 04:31:03', NULL),
(70, 55, '79695.PNG', '2019-07-03 11:59:36', '2019-07-03 11:59:36', NULL);

-- --------------------------------------------------------

--
-- Table structure for table `groups`
--

CREATE TABLE `groups` (
  `id` int(11) NOT NULL,
  `name` varchar(255) NOT NULL,
  `intrest_id` varchar(255) NOT NULL,
  `photo` varchar(255) DEFAULT NULL,
  `description` varchar(255) DEFAULT NULL,
  `contact_person_id` int(11) DEFAULT NULL,
  `recruitment` int(11) DEFAULT '0',
  `created_at` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP,
  `updated_at` timestamp NULL DEFAULT NULL,
  `deleted_at` time DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `groups`
--

INSERT INTO `groups` (`id`, `name`, `intrest_id`, `photo`, `description`, `contact_person_id`, `recruitment`, `created_at`, `updated_at`, `deleted_at`) VALUES
(63, 'test', '2', '63170.jpg', 'sdasda', 1, 0, '2019-06-10 12:45:09', '2019-06-10 12:46:50', NULL),
(64, 'test', '2', '50203.jpg', 'sdasda', 1, 0, '2019-06-10 12:45:30', '2019-06-10 13:21:20', NULL),
(65, 'test group', '1', '68552.jpg', 'adjhaskjdashdkjasd', 49, 1, '2019-06-10 13:04:23', '2019-06-11 05:09:45', NULL),
(66, 'hitarth', '1', NULL, NULL, 49, 0, '2019-06-11 08:02:02', '2019-06-11 08:02:02', NULL),
(67, 'new group', '1', NULL, NULL, 52, 0, '2019-06-11 08:02:52', '2019-06-11 08:02:52', NULL),
(68, 'Prodigal Sons', '1', NULL, NULL, 52, 0, '2019-06-11 08:03:20', '2019-06-11 08:03:20', NULL),
(69, 'Cycle Fan Club ', '10', NULL, NULL, 49, 0, '2019-06-11 09:03:18', '2019-06-11 09:03:18', NULL),
(70, 'Cycle Fan Club', '10', '55417.PNG', 'There where added description for the testing purpose .', 49, 1, '2019-06-11 09:05:38', '2019-06-11 09:30:18', NULL),
(71, 'Mark 2', '1', NULL, NULL, 50, 0, '2019-06-11 09:09:43', '2019-06-11 09:09:43', NULL),
(72, 'fun Club', '6', '13258.PNG', 'this is testing Description', 52, 0, '2019-06-11 09:54:42', '2019-06-20 10:19:49', NULL),
(73, 'ok', '1', NULL, NULL, 54, 0, '2019-06-11 10:01:10', '2019-06-11 10:01:10', NULL),
(74, 'Ferwell Club Party', '1', '15839.PNG', 'This description added for testing.', 52, 1, '2019-06-11 13:22:57', '2019-06-11 13:23:43', NULL),
(75, 'okay', '1', NULL, NULL, 53, 0, '2019-06-13 06:12:35', '2019-06-13 06:12:35', NULL),
(76, 'testing 123', '1', NULL, NULL, 53, 0, '2019-06-13 06:13:18', '2019-06-13 06:13:18', NULL),
(77, 'update', '1', NULL, NULL, 53, 0, '2019-06-13 06:18:35', '2019-06-28 13:08:59', NULL),
(78, 'Yea', '2', NULL, NULL, 53, 0, '2019-06-13 06:18:43', '2019-06-13 06:18:43', NULL),
(79, 'ok', '1', NULL, NULL, 53, 0, '2019-06-13 06:19:01', '2019-06-13 06:19:01', NULL),
(80, 'b', '1', NULL, NULL, 53, 0, '2019-06-13 10:21:53', '2019-06-13 10:21:53', NULL),
(81, 'test', '7', NULL, NULL, 64, 0, '2019-06-20 05:53:08', '2019-06-20 05:53:08', NULL),
(82, 'Testing Studybreak', '8', NULL, NULL, 65, 0, '2019-06-20 05:58:09', '2019-06-20 05:58:09', NULL),
(83, 'testing sb', '7', NULL, NULL, 66, 0, '2019-06-20 06:00:29', '2019-06-20 06:00:29', NULL),
(84, 'Study break', '5', NULL, NULL, 66, 0, '2019-06-20 06:24:50', '2019-06-20 06:24:50', NULL),
(85, 'Fantastic club', '5', NULL, NULL, 68, 0, '2019-06-20 09:47:20', '2019-06-20 09:47:20', NULL),
(86, 'Studybreak group', '6', '58213.PNG', NULL, 68, 1, '2019-06-20 10:02:17', '2019-06-20 10:07:35', NULL),
(87, 'Mark 3', '1', NULL, NULL, 50, 0, '2019-06-20 11:48:40', '2019-06-20 11:48:40', NULL),
(88, 'selena fan club', '1', '49743.PNG', 'there are adding desc for the testing purpose.', 49, 1, '2019-06-21 10:04:32', '2019-07-02 06:33:44', NULL),
(89, 'Gym', '8', '70651.PNG', NULL, 69, 1, '2019-06-25 12:36:54', '2019-06-25 12:41:53', NULL),
(90, 'Vael Events', '4', '39203.PNG', 'there are added testing describe', 70, 1, '2019-07-02 09:12:10', '2019-07-03 05:10:21', NULL),
(91, 'hyvfdg', '5', NULL, NULL, 49, 0, '2019-07-02 11:35:44', '2019-07-02 11:35:44', NULL),
(92, 'group created', '2', '19274.PNG', NULL, 71, 1, '2019-07-03 09:59:11', '2019-07-03 10:08:29', NULL),
(93, 'religion group', '4', NULL, NULL, 72, 0, '2019-07-03 10:11:33', '2019-07-03 10:11:33', NULL),
(94, 'Kely Fan Club', '4', '57556.png', 'testing in foremost', 73, 1, '2019-07-03 10:20:07', '2019-07-03 11:56:40', NULL);

-- --------------------------------------------------------

--
-- Table structure for table `group_user`
--

CREATE TABLE `group_user` (
  `id` int(11) NOT NULL,
  `group_id` int(11) NOT NULL,
  `user_id` int(11) NOT NULL,
  `user_role` varchar(255) DEFAULT NULL,
  `status` int(11) NOT NULL DEFAULT '1' COMMENT '0:new reqest 1:accepted or creater of group ',
  `created_at` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP,
  `updated_at` timestamp NULL DEFAULT NULL,
  `deleted_at` time DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `group_user`
--

INSERT INTO `group_user` (`id`, `group_id`, `user_id`, `user_role`, `status`, `created_at`, `updated_at`, `deleted_at`) VALUES
(78, 67, 52, 'Administrator', 1, '2019-06-11 08:02:52', '2019-06-11 08:02:52', NULL),
(79, 68, 52, 'Modetator', 1, '2019-06-11 08:03:20', '2019-06-11 09:22:55', NULL),
(89, 73, 54, 'Administrator', 1, '2019-06-11 10:01:10', '2019-06-11 10:01:10', NULL),
(99, 70, 52, 'Member', 0, '2019-06-11 12:46:45', '2019-06-11 12:46:45', NULL),
(100, 70, 53, 'Member', 1, '2019-06-11 12:46:48', '2019-06-11 12:53:57', NULL),
(101, 72, 50, 'Member', 0, '2019-06-11 13:04:54', '2019-06-11 13:04:54', NULL),
(106, 72, 54, 'Member', 1, '2019-06-11 13:05:06', '2019-06-11 13:06:52', NULL),
(108, 70, 0, 'Member', 0, '2019-06-11 13:22:23', '2019-06-11 13:22:23', NULL),
(109, 74, 0, 'Administrator', 1, '2019-06-11 13:22:57', '2019-06-11 13:22:57', NULL),
(112, 74, 51, 'Member', 0, '2019-06-11 13:26:19', '2019-06-11 13:26:19', NULL),
(113, 74, 52, 'Member', 0, '2019-06-11 13:26:20', '2019-06-11 13:26:20', NULL),
(114, 74, 53, 'Member', 0, '2019-06-11 13:26:22', '2019-06-11 13:26:22', NULL),
(115, 74, 54, 'Member', 0, '2019-06-11 13:26:24', '2019-06-11 13:26:24', NULL),
(116, 74, 55, 'Member', 0, '2019-06-11 13:26:25', '2019-06-11 13:26:25', NULL),
(117, 70, 53, 'Member', 0, '2019-06-13 06:01:55', '2019-06-13 06:01:55', NULL),
(118, 70, 53, 'Member', 0, '2019-06-13 06:05:58', '2019-06-13 06:05:58', NULL),
(119, 70, 53, 'Member', 0, '2019-06-13 06:09:39', '2019-06-13 06:09:39', NULL),
(120, 70, 53, 'Member', 0, '2019-06-13 06:11:44', '2019-06-13 06:11:44', NULL),
(121, 75, 53, 'Administrator', 1, '2019-06-13 06:12:35', '2019-06-13 06:12:35', NULL),
(122, 76, 53, 'Administrator', 1, '2019-06-13 06:13:18', '2019-06-13 06:13:18', NULL),
(123, 77, 53, 'Administrator', 1, '2019-06-13 06:18:35', '2019-06-13 06:18:35', NULL),
(124, 78, 53, 'Administrator', 1, '2019-06-13 06:18:43', '2019-06-13 06:18:43', NULL),
(125, 79, 53, 'Administrator', 1, '2019-06-13 06:19:01', '2019-06-13 06:19:01', NULL),
(127, 80, 53, 'Administrator', 1, '2019-06-13 10:21:53', '2019-06-13 10:21:53', NULL),
(128, 74, 0, 'Member', 0, '2019-06-14 13:30:26', '2019-06-14 13:30:26', NULL),
(130, 81, 64, 'Administrator', 1, '2019-06-20 05:53:08', '2019-06-20 05:53:08', NULL),
(131, 82, 65, 'Administrator', 1, '2019-06-20 05:58:09', '2019-06-20 05:58:09', NULL),
(132, 83, 66, 'Administrator', 1, '2019-06-20 06:00:29', '2019-06-20 06:00:29', NULL),
(133, 84, 66, 'Administrator', 1, '2019-06-20 06:24:50', '2019-06-20 06:24:50', NULL),
(134, 85, 68, 'Administrator', 1, '2019-06-20 09:47:20', '2019-06-20 09:47:20', NULL),
(135, 86, 68, 'Administrator', 1, '2019-06-20 10:02:17', '2019-06-20 10:02:17', NULL),
(138, 68, 64, 'Member', 1, '2019-06-24 06:58:01', '2019-06-24 06:58:20', NULL),
(139, 89, 69, 'Administrator', 1, '2019-06-25 12:36:54', '2019-06-25 12:36:54', NULL),
(141, 90, 70, 'Administrator', 1, '2019-07-02 09:12:10', '2019-07-02 09:12:10', NULL),
(142, 88, 0, 'Member', 0, '2019-07-02 09:13:08', '2019-07-02 09:13:08', NULL),
(143, 88, 0, 'Member', 0, '2019-07-02 09:13:32', '2019-07-02 09:13:32', NULL),
(144, 74, 49, 'Member', 0, '2019-07-02 09:14:14', '2019-07-02 09:14:14', NULL),
(145, 74, 49, 'Member', 0, '2019-07-02 09:14:28', '2019-07-02 09:14:28', NULL),
(146, 86, 49, 'Member', 0, '2019-07-02 11:34:38', '2019-07-02 11:34:38', NULL),
(147, 86, 49, 'Member', 0, '2019-07-02 11:34:44', '2019-07-02 11:34:44', NULL),
(148, 91, 49, 'Administrator', 1, '2019-07-02 11:35:44', '2019-07-02 11:35:44', NULL),
(149, 90, 49, 'Member', 1, '2019-07-03 05:10:27', '2019-07-03 05:10:34', NULL),
(150, 88, 70, 'Member', 1, '2019-07-03 05:11:06', '2019-07-03 05:11:27', NULL),
(152, 88, 70, 'Member', 1, '2019-07-03 05:11:18', '2019-07-03 05:11:27', NULL),
(153, 88, 49, 'Member', 0, '2019-07-03 05:11:52', '2019-07-03 05:11:52', NULL),
(154, 92, 71, 'Administrator', 1, '2019-07-03 09:59:12', '2019-07-03 10:09:31', NULL),
(155, 88, 0, 'Member', 0, '2019-07-03 10:02:25', '2019-07-03 10:02:25', NULL),
(156, 74, 71, 'Member', 0, '2019-07-03 10:04:05', '2019-07-03 10:04:05', NULL),
(157, 74, 71, 'Member', 0, '2019-07-03 10:05:59', '2019-07-03 10:05:59', NULL),
(158, 92, 0, 'Member', 0, '2019-07-03 10:08:35', '2019-07-03 10:08:35', NULL),
(159, 92, 71, 'Member', 1, '2019-07-03 10:09:03', '2019-07-03 10:09:31', NULL),
(160, 92, 0, 'Member', 0, '2019-07-03 10:09:39', '2019-07-03 10:09:39', NULL),
(161, 93, 72, 'Administrator', 1, '2019-07-03 10:11:33', '2019-07-03 10:11:33', NULL),
(162, 94, 73, 'Administrator', 1, '2019-07-03 10:20:07', '2019-07-03 10:20:07', NULL),
(163, 90, 73, 'Member', 0, '2019-07-03 11:29:53', '2019-07-03 11:29:53', NULL),
(164, 92, 73, 'Member', 0, '2019-07-03 11:30:02', '2019-07-03 11:30:02', NULL),
(165, 94, 72, 'Member', 1, '2019-07-03 11:56:59', '2019-07-03 11:57:14', NULL);

-- --------------------------------------------------------

--
-- Table structure for table `interests`
--

CREATE TABLE `interests` (
  `id` int(11) NOT NULL,
  `name` varchar(255) NOT NULL,
  `created_at` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP,
  `updated_at` timestamp NULL DEFAULT NULL,
  `deleted_at` time DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `interests`
--

INSERT INTO `interests` (`id`, `name`, `created_at`, `updated_at`, `deleted_at`) VALUES
(1, 'Academics', '2019-05-28 06:54:56', NULL, NULL),
(2, 'Culture', '2019-05-28 06:57:05', NULL, NULL),
(3, 'Greek Organizations', '2019-06-06 12:51:20', NULL, NULL),
(4, 'Religion', '2019-06-06 12:51:20', NULL, NULL),
(5, 'Leisure', '2019-06-06 12:51:38', NULL, NULL),
(6, 'Professional', '2019-06-06 12:51:38', NULL, NULL),
(7, 'Recreational', '2019-06-06 12:51:54', NULL, NULL),
(8, 'Health & wellness', '2019-06-06 12:51:54', NULL, NULL),
(9, 'International', '2019-06-06 12:52:08', NULL, NULL),
(10, 'Student Government', '2019-06-06 12:52:08', NULL, NULL);

-- --------------------------------------------------------

--
-- Table structure for table `save_events`
--

CREATE TABLE `save_events` (
  `id` int(11) NOT NULL,
  `user_id` int(11) NOT NULL,
  `event_id` int(11) NOT NULL,
  `is_saved` int(11) NOT NULL,
  `created_at` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP,
  `updated_at` timestamp NULL DEFAULT NULL,
  `deleted_at` time DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `save_events`
--

INSERT INTO `save_events` (`id`, `user_id`, `event_id`, `is_saved`, `created_at`, `updated_at`, `deleted_at`) VALUES
(1, 52, 36, 1, '2019-06-25 07:55:58', '2019-06-25 07:55:58', NULL),
(2, 49, 36, 1, '2019-06-25 09:03:53', '2019-06-25 09:03:53', NULL),
(3, 49, 35, 1, '2019-06-25 09:04:19', '2019-06-25 09:04:19', NULL),
(4, 49, 30, 1, '2019-06-25 12:16:02', '2019-06-25 12:16:02', NULL);

-- --------------------------------------------------------

--
-- Table structure for table `users`
--

CREATE TABLE `users` (
  `id` int(10) UNSIGNED NOT NULL,
  `role_id` int(12) NOT NULL,
  `first_name` varchar(191) COLLATE utf8mb4_unicode_ci NOT NULL,
  `last_name` varchar(191) COLLATE utf8mb4_unicode_ci NOT NULL,
  `email` varchar(191) COLLATE utf8mb4_unicode_ci NOT NULL,
  `phone` varchar(191) COLLATE utf8mb4_unicode_ci NOT NULL,
  `password` varchar(191) COLLATE utf8mb4_unicode_ci NOT NULL,
  `photo` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `college_id` int(11) DEFAULT NULL,
  `intrest_id` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `user_token` text COLLATE utf8mb4_unicode_ci NOT NULL,
  `device_token` text COLLATE utf8mb4_unicode_ci,
  `remember_token` text COLLATE utf8mb4_unicode_ci,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  `deleted_at` time DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `users`
--

INSERT INTO `users` (`id`, `role_id`, `first_name`, `last_name`, `email`, `phone`, `password`, `photo`, `college_id`, `intrest_id`, `user_token`, `device_token`, `remember_token`, `created_at`, `updated_at`, `deleted_at`) VALUES
(1, 1, 'admin', 'ADMIN', 'admin@admin.com', '124567890', '$2y$10$V1f9cL50y1hEnP36Hs/UkOBOMEeXoHw8hg000yRLO.kWtfpSNBP.u', NULL, 1, '[\"1\",\"2\"]', 'na1c7c10fe33d5009ab4c3fc4', NULL, NULL, '2019-05-28 01:51:24', '2019-05-28 01:51:24', NULL),
(49, 2, 'selena', 'gomez', 'sb@sb.edu', '(123) 456-7841', '$2y$10$uUBM0jI60N1VqMznvLuZKOAVV0oNIGDgxBu8Tw8qsY354Jq4nQqvS', '30133.PNG', 1, '[\"4\", \"5\", \"6\"]', '5b8de602c43830ab5ff036581e79095a650561dfb2d0654e898eb01164c1cec9', NULL, NULL, '2019-06-07 10:49:21', '2019-07-03 10:07:55', NULL),
(50, 2, 'tony', 'stark', 'tony@colcom', '124567890', '$2y$10$jj6EKG6jLy1t0muOWtMyC.fGkZRm/eifbLaMuQqCnjZc0HOZCgfX2', NULL, 1, '[\"1\",\"2\"]', 'X5370b54e0947fc4f6c4fca18', NULL, NULL, '2019-06-10 12:45:09', '2019-06-10 12:45:09', NULL),
(51, 2, 'Dimpal', 'Parmar', 'gd@gmail.edu', '(953) 741-1428', '$2y$10$nK7DOHdBOMWcLGAw/aqBLu3bdpICXnQb3BwYzXWekfjUSMfVNjOdq', NULL, 2, '[5, 6, 9]', 'h70f6c0769a7db3c7161e6a26', NULL, NULL, '2019-06-11 06:34:41', '2019-06-11 06:34:41', NULL),
(52, 2, 'ethan', 'hunt', 'a@a.com', '101010101010', '$2y$10$PCQldbWJYQ8FqDAvxZiFS.be4eSvS6EaF4Il444CtnBoRS9AsIwNK', '74967.jpg', 1, '[\"1\",\"2\"]', 'hcbcf976873c09d7ee64587a4', NULL, NULL, '2019-06-11 08:02:52', '2019-06-28 12:52:46', NULL),
(53, 2, 'Dimpal', 'Parmar', 'dd@gmail.edu', '(953) 741-1428', '$2y$10$0iPJbQIFhbGYjp3ehCo9COafH3/7VXj0DUfD4FbiAupZ5Z36/Ytt2', NULL, 1, '[4, 5, 6]', '101781f5dc5991b45f6fa30283e20464819656526ce4f6a1244efd19ea3e88c0', NULL, NULL, '2019-06-11 08:32:22', '2019-06-13 05:57:54', NULL),
(54, 2, 'olive', 'Okie', 'ola@gmail.edu', '(953) 741-1142', '$2y$10$3eAz76JoU4MhOa/j5r.7beqUhdyz3I7kXUxRNXJF7Q1w8Nz7QZsey', NULL, 1, '[4, 5, 6]', 's851aa7071c0b789a4e10dc69', NULL, NULL, '2019-06-11 10:01:10', '2019-06-11 10:01:10', NULL),
(55, 2, 'dimple', 'parmar', 'okie@gmail.edu', '(123) 456-7896', '$2y$10$GdtItB2migjxDsD6LtwaxuT93ni2/rHePNep9J2KFHzsllyCX0f7y', NULL, 1, '[1, 2, 3]', 'ua17421e46d8388eff9285c22', NULL, NULL, '2019-06-11 10:20:02', '2019-06-11 10:20:02', NULL),
(56, 2, 'dimpi', 'Parmar', 'okay@sb.edu', '(365) 847-5668', '$2y$10$U.J8nbY65Oeh2cqDFZQH/OBbGQBUi0/4Q6yHEyS1pWsuWUFv3j2Zi', NULL, 2, '[2, 3, 1, 2, 3, 4]', 'b937b159b6b67499de0e08664', NULL, NULL, '2019-06-13 05:35:28', '2019-06-13 05:35:28', NULL),
(57, 2, 'ok', 'jan', 'hwhw.edu', '(611) 919-4964', '$2y$10$JVF1qfkb8JbIrf6E2kfP0OkvEFRu3SYWloUGT2G2L9PvaaXd3MzNi', NULL, 0, '[1, 3, 2, 4]', 'Ya9733d5719f78bbfbb9a17c5', NULL, NULL, '2019-06-13 05:53:14', '2019-06-13 05:53:14', NULL),
(58, 2, 'preya', 'Patadia', 'sb@gh.edu', '(676) 467-6764', '$2y$10$chGgWsu1evj.2OzuIYe1huRIy6YC9CtflD.9hwj5H8RbsSb.b5MTu', NULL, 1, '[2, 1, 3, 4, 10, 9]', 'yb5d377a382eb89dc6139a142', NULL, NULL, '2019-06-14 06:10:09', '2019-06-14 06:10:09', NULL),
(59, 2, 'nsn', 'jzbsb', 'ok.edu', '966', '$2y$10$GvkzEqssaM68F6dEZAXYjOufJwGyYX1b/dPZXiFCIg80C/iXgMWga', NULL, 2, '[1, 2, 3]', 'z03853ee9deb516ee5790175b', NULL, NULL, '2019-06-14 06:12:34', '2019-06-14 06:12:34', NULL),
(60, 2, 'vdgh', 'fvkk', 'yfa@hh.edu', '(999) 999-9999', '$2y$10$96Bgk7ss7CxDizZitBUSkeqhhv3Ne/KksJSLYUvaANjglfQgk3kei', NULL, 1, '[1, 2, 4, 5, 3]', 'xbe4052e2fea0dcefa393e4f9', NULL, NULL, '2019-06-14 07:09:06', '2019-06-14 07:09:06', NULL),
(61, 2, 'preya', 'Patadia', 'us@hxb.edu', '(974) 356-7484', '$2y$10$BKrN4vESca40PQXzfGEWwOVOz/DxwhVUw8YfOd4Q/dP7pBCWoqhMa', NULL, 1, '[1, 2, 3]', 'ya7f8757e7e011f6d27fdb611', NULL, NULL, '2019-06-14 09:06:33', '2019-06-14 09:06:33', NULL),
(62, 2, 'rferf', 'ftghr', 'hty@jbf.edu', '(656) 445-4545', '$2y$10$f8Jfl5HQA2NBNG1VnxElLOZ1Z/8ik/.nYggLHzrEPoR4VaA/3.gXS', NULL, 1, '[1, 2]', 'S10a167db5e8ed20bdc1a459b', NULL, NULL, '2019-06-14 12:58:10', '2019-06-14 12:58:10', NULL),
(63, 2, 'tttt', 'rgr,', 'ffuh@ferf.edu', '(444) 444-4444', '$2y$10$yhFfQ43kjigJRIUjw8k5GO4JS8n3eeRA0PTlUYUeLAyxWcpNX1EZi', NULL, 1, '[1, 2]', 'G1675c7f8f25a5054fe736785', NULL, NULL, '2019-06-14 13:22:10', '2019-06-14 13:22:10', NULL),
(64, 2, 'Dimpal', 'Parmar', 'test@gmail.edu', '(953) 741-1428', '$2y$10$3PVset8GnNVG8TEIW16np.SFAtvMWdUPTMmkf017LjcCIkjGkC04C', NULL, 1, '[\"1\", \"2\"]', 'A0e52f8ea3c2c4b5fb5fb4df1', NULL, NULL, '2019-06-20 05:53:08', '2019-06-20 05:53:08', NULL),
(65, 2, 'Elena', 'Gilbert', 'Testing@gmail.edu', '(953) 741-1428', '$2y$10$TFAxr89o7Uj2BT9BXWtXnuJv6Pk373DHEObF181sRYoGfQRb1DjNW', NULL, 1, '[\"1\", \"2\"]', 'G143000a4e44356da893ab493', NULL, NULL, '2019-06-20 05:58:09', '2019-06-20 05:58:09', NULL),
(66, 2, 'elena', 'gilbert', 'testing@studybreak.edu', '(953) 441-1428', '$2y$10$ANrTA2oaqbWpPvEEQztaMe8cpXbvcML2bXnAE61bvlpJNlTHzkIL6', NULL, 1, '[\"1\", \"2\"]', 'read2882156322221adb1267d', NULL, NULL, '2019-06-20 06:00:29', '2019-06-20 06:00:29', NULL),
(67, 2, 'Mark', 'Zuckerberg', 'ok@gmail.edu', '(365) 597-9784', '$2y$10$PD3e6wUIhMFAMWa59HQ6x.fBAqIjuOzbJM719te9ZAnWAgz/NiPvq', NULL, 2, '[1, 2]', 'efde0192662f1c46db8a641a8', NULL, NULL, '2019-06-20 07:55:02', '2019-06-20 07:55:02', NULL),
(68, 2, 'zack', 'zukerberg', 'zack@gmail.edu', '(962) 587-1365', '$2y$10$iM4/PdmcYtWMTRfkaIO6KelaWhMtN30CW7xLj067YrU2Bjuu0ILHq', NULL, 1, '[\"1\", \"2\"]', 'q8d2b6e941e69c7e6257369d4', NULL, NULL, '2019-06-20 09:47:20', '2019-06-20 09:47:20', NULL),
(69, 2, 'Ankit', 'Gajera', 'ankitgajera.ra@gmail.edu', '(901) 658-8970', '$2y$10$4opMvSVMus5yn8S9MxIkTe/YbiwxR.Gh22QSAt0Vldz6gzP2FVlfK', NULL, 1, '[1, 2]', 'ca4556e40ce7506382fdb3afc', NULL, NULL, '2019-06-25 12:23:19', '2019-06-25 12:23:19', NULL),
(70, 2, 'Vael', 'Victus', 'sb1@sb1.edu', '(123) 456-7891', '$2y$10$nVYlkivwAjGsJ1HIPRMgfOFjkknQ4bTiFCVs6C5v7PwMsIcSDw7fi', NULL, 1, '[\"1\", \"2\", \"3\", \"4\", \"5\", \"7\", \"9\"]', 'eadea4743e9c3d38a14d2276682d0b6f62045c126334c16039c1fea3947dbc56', NULL, NULL, '2019-07-02 09:12:10', '2019-07-03 09:00:48', NULL),
(72, 2, 'tony', 'stark', 'thestudybreak.app@gmail.edu', '(123) 456-9780', '$2y$10$oYoWEYQ4z9CbvdWcbPNkEe6BJ3a5r9sEfY59cumNPpXnk2O2srfDG', NULL, 1, '[\"4\"]', 'qd90090d51962064654fa3f30', NULL, NULL, '2019-07-03 10:11:33', '2019-07-03 10:11:33', NULL),
(73, 2, 'kelly', 'jecly', 'test@test.edu', '(665) 553-3441', '$2y$10$OAqdy3d.NkF9BGJ3tHmVJuqToGGLKs0scz.0dcsdQ70YKgD1Jcm/O', NULL, 1, '[\"1\", \"2\", \"3\", \"4\", \"5\", \"6\"]', '457f58875dd5c2196914704056a5e871546587b3c13bccf9456bf9b0db5a7205', NULL, NULL, '2019-07-03 10:20:07', '2019-07-03 12:39:31', NULL);

-- --------------------------------------------------------

--
-- Table structure for table `x_apis`
--

CREATE TABLE `x_apis` (
  `id` int(10) UNSIGNED NOT NULL,
  `api_key` varchar(191) COLLATE utf8mb4_unicode_ci NOT NULL,
  `platform` varchar(191) COLLATE utf8mb4_unicode_ci NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `x_apis`
--

INSERT INTO `x_apis` (`id`, `api_key`, `platform`, `created_at`, `updated_at`) VALUES
(1, 'qiqhyah5kBu9XdyNa1KQsMVhxR', 'android', '2018-08-28 00:00:00', '2018-08-28 00:00:00'),
(2, 'qiqhyah5kBu9XdyNa1KQsMVhxR', 'ios', '2018-08-28 00:00:00', '2018-08-28 00:00:00');

--
-- Indexes for dumped tables
--

--
-- Indexes for table `admission`
--
ALTER TABLE `admission`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `annoucement_users`
--
ALTER TABLE `annoucement_users`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `announcement`
--
ALTER TABLE `announcement`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `check_events`
--
ALTER TABLE `check_events`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `college`
--
ALTER TABLE `college`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `events`
--
ALTER TABLE `events`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `event_images`
--
ALTER TABLE `event_images`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `groups`
--
ALTER TABLE `groups`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `group_user`
--
ALTER TABLE `group_user`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `interests`
--
ALTER TABLE `interests`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `save_events`
--
ALTER TABLE `save_events`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `users`
--
ALTER TABLE `users`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `users_email_unique` (`email`);

--
-- Indexes for table `x_apis`
--
ALTER TABLE `x_apis`
  ADD PRIMARY KEY (`id`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `admission`
--
ALTER TABLE `admission`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=4;
--
-- AUTO_INCREMENT for table `annoucement_users`
--
ALTER TABLE `annoucement_users`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=29;
--
-- AUTO_INCREMENT for table `announcement`
--
ALTER TABLE `announcement`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=28;
--
-- AUTO_INCREMENT for table `check_events`
--
ALTER TABLE `check_events`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=4;
--
-- AUTO_INCREMENT for table `college`
--
ALTER TABLE `college`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=3;
--
-- AUTO_INCREMENT for table `events`
--
ALTER TABLE `events`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=56;
--
-- AUTO_INCREMENT for table `event_images`
--
ALTER TABLE `event_images`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=71;
--
-- AUTO_INCREMENT for table `groups`
--
ALTER TABLE `groups`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=95;
--
-- AUTO_INCREMENT for table `group_user`
--
ALTER TABLE `group_user`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=166;
--
-- AUTO_INCREMENT for table `interests`
--
ALTER TABLE `interests`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=11;
--
-- AUTO_INCREMENT for table `save_events`
--
ALTER TABLE `save_events`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=5;
--
-- AUTO_INCREMENT for table `users`
--
ALTER TABLE `users`
  MODIFY `id` int(10) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=74;
--
-- AUTO_INCREMENT for table `x_apis`
--
ALTER TABLE `x_apis`
  MODIFY `id` int(10) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=3;
/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
