-- phpMyAdmin SQL Dump
-- version 4.6.6deb5
-- https://www.phpmyadmin.net/
--
-- Host: localhost:3306
-- Generation Time: Jun 18, 2019 at 07:29 AM
-- Server version: 5.7.26-0ubuntu0.18.04.1
-- PHP Version: 7.2.19-0ubuntu0.18.04.1

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `prasang`
--

-- --------------------------------------------------------

--
-- Table structure for table `admin`
--

CREATE TABLE `admin` (
  `id` int(11) NOT NULL,
  `email` varchar(255) NOT NULL,
  `password` varchar(255) NOT NULL,
  `email_verified_at` int(11) NOT NULL,
  `remember_token` varchar(255) NOT NULL,
  `created_at` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP,
  `updated_at` timestamp NULL DEFAULT NULL,
  `deleted_at` time DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Dumping data for table `admin`
--

INSERT INTO `admin` (`id`, `email`, `password`, `email_verified_at`, `remember_token`, `created_at`, `updated_at`, `deleted_at`) VALUES
(1, 'admin@admin.com', '$2y$10$ZLigH0DlsVhAh2Bvroer1OuMJpaKgD.Y07gojVKslGGlEiAzpfhNq', 0, '', '2019-06-07 10:48:41', NULL, NULL);

-- --------------------------------------------------------

--
-- Table structure for table `banner_images`
--

CREATE TABLE `banner_images` (
  `id` int(11) NOT NULL,
  `description` varchar(255) NOT NULL,
  `image` varchar(255) NOT NULL,
  `created_at` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP,
  `updated_at` timestamp NULL DEFAULT NULL,
  `deleted_at` time DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Dumping data for table `banner_images`
--

INSERT INTO `banner_images` (`id`, `description`, `image`, `created_at`, `updated_at`, `deleted_at`) VALUES
(2, 'STEP BEYOND YOUR EXPECTATIONS. LET\'S CREATE EVERY OCCASION/MOMENT MORE THAN PERFECT!', '33816.jpg', '2019-06-11 04:41:26', '2019-06-16 13:47:30', NULL),
(4, 'YOUR VISION. OUR INNOVATION. LET\'S MAKE IT GRAND!', '71432.jpg', '2019-06-14 06:40:00', '2019-06-16 13:46:08', NULL),
(5, 'TRANSCENDING YOU INTO A HAPPILY EVER AFTER.MAKE MOMENTS SURREAL WITH US.', '13783.jpg', '2019-06-16 13:52:52', '2019-06-16 13:52:52', NULL),
(6, 'SPECIAL OCCASIONS MADE SPECTACULARLY BEAUTIFUL.', '75756.jpg', '2019-06-16 13:53:21', '2019-06-16 13:53:21', NULL),
(7, 'YOUR DREAMS, OUR PLEASURE. WE ARE CREATORS OF MAGNIFICENT MASTERPIECES', '23648.jpg', '2019-06-16 13:58:45', '2019-06-16 13:58:45', NULL);

-- --------------------------------------------------------

--
-- Table structure for table `contact`
--

CREATE TABLE `contact` (
  `id` int(11) NOT NULL,
  `address` varchar(255) NOT NULL,
  `phone_number` varchar(255) NOT NULL,
  `email` varchar(255) NOT NULL,
  `created_at` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP,
  `updated_at` timestamp NULL DEFAULT NULL,
  `deleted_at` time DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Dumping data for table `contact`
--

INSERT INTO `contact` (`id`, `address`, `phone_number`, `email`, `created_at`, `updated_at`, `deleted_at`) VALUES
(1, 'B – 106 , Titanium Square Next to Oreva House, SG Highway , Thaltej, Ahmedabad – 380054 (Gujarat India)', '7929702502', 'info@prasang.com', '2019-06-11 09:04:46', '2019-06-14 06:44:35', NULL);

-- --------------------------------------------------------

--
-- Table structure for table `corporate_events`
--

CREATE TABLE `corporate_events` (
  `id` int(11) NOT NULL,
  `function_name` varchar(255) NOT NULL,
  `client_name` varchar(255) NOT NULL,
  `image` varchar(255) NOT NULL,
  `youtube_link` text NOT NULL,
  `created_at` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP,
  `updated_at` timestamp NULL DEFAULT NULL,
  `deleted_at` time DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Dumping data for table `corporate_events`
--

INSERT INTO `corporate_events` (`id`, `function_name`, `client_name`, `image`, `youtube_link`, `created_at`, `updated_at`, `deleted_at`) VALUES
(1, 'Kids at Party', 'Birthday Parties', '41507.jpg', 'https://www.youtube.com/watch?v=vhvdnKfpG1s', '2019-06-11 01:23:05', '2019-06-11 01:23:05', NULL);

-- --------------------------------------------------------

--
-- Table structure for table `destination_gallery`
--

CREATE TABLE `destination_gallery` (
  `id` int(11) NOT NULL,
  `function_name` varchar(255) NOT NULL,
  `client_name` varchar(255) NOT NULL,
  `image` varchar(255) NOT NULL,
  `youtube_link` text NOT NULL,
  `created_at` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP,
  `updated_at` timestamp NULL DEFAULT NULL,
  `deleted_at` time DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Dumping data for table `destination_gallery`
--

INSERT INTO `destination_gallery` (`id`, `function_name`, `client_name`, `image`, `youtube_link`, `created_at`, `updated_at`, `deleted_at`) VALUES
(1, 'Garba Night -Goa', 'Girish Desai', '55682.jpg', 'https://www.youtube.com/watch?v=vhvdnKfpG1s', '2019-06-10 23:47:05', '2019-06-15 12:11:28', NULL),
(2, 'Garba Night -Goa', 'Girish Desai', '75183.jpg', 'https://www.youtube.com/watch?v=vhvdnKfpG1s', '2019-06-10 23:51:40', '2019-06-15 12:11:07', NULL),
(3, 'Beach Party -Goa', 'Birthday Parties', '63994.jpg', 'https://www.youtube.com/watch?v=vhvdnKfpG1s', '2019-06-11 03:03:43', '2019-06-15 12:09:23', NULL),
(4, 'Beach Party -Goa', 'Girish Desai', '50420.jpg', 'https://www.youtube.com/watch?v=vhvdnKfpG1s', '2019-06-11 03:03:53', '2019-06-15 11:57:34', NULL),
(5, 'Beach Party -Goa', 'Girish Desai', '99761.jpg', 'https://www.test.com', '2019-06-14 05:45:30', '2019-06-15 11:57:08', NULL),
(8, 'Mehendi', 'Girish Desai', '86338.jpg', 'https://www.youtube.com/channel/UCHFPv5qB7co0eWDIchBSQzQ/videos', '2019-06-15 12:13:43', '2019-06-15 12:13:43', NULL),
(9, 'Mehendi', 'Girish Desai', '20134.jpg', 'https://www.youtube.com/channel/UCHFPv5qB7co0eWDIchBSQzQ/videos', '2019-06-15 12:14:25', '2019-06-15 12:14:25', NULL),
(10, 'Mehendi', 'Girish Desai', '75665.jpg', 'https://www.youtube.com/channel/UCHFPv5qB7co0eWDIchBSQzQ/videos', '2019-06-15 12:15:17', '2019-06-15 12:15:17', NULL),
(11, 'Mehendi', 'Girish Desai', '25888.jpg', 'https://www.youtube.com/channel/UCHFPv5qB7co0eWDIchBSQzQ/videos', '2019-06-15 12:15:42', '2019-06-15 12:15:42', NULL),
(12, 'Mehendi', 'Girish Desai', '88168.jpg', 'https://www.youtube.com/channel/UCHFPv5qB7co0eWDIchBSQzQ/videos', '2019-06-15 12:16:02', '2019-06-15 12:16:02', NULL),
(13, 'Mehendi', 'Girish Desai', '31496.jpg', 'https://www.youtube.com/channel/UCHFPv5qB7co0eWDIchBSQzQ/videos', '2019-06-15 12:17:00', '2019-06-15 12:17:00', NULL),
(14, 'Reception', 'Girish Desai', '94081.jpg', 'https://www.youtube.com/channel/UCHFPv5qB7co0eWDIchBSQzQ/videos', '2019-06-15 12:17:38', '2019-06-15 12:17:38', NULL),
(15, 'Reception', 'Girish Desai', '80146.jpg', 'https://www.youtube.com/channel/UCHFPv5qB7co0eWDIchBSQzQ/videos', '2019-06-15 12:18:08', '2019-06-15 12:18:08', NULL),
(16, 'Beach Party -Goa', 'Girish Desai', '45915.jpg', 'https://www.youtube.com/channel/UCHFPv5qB7co0eWDIchBSQzQ/videos', '2019-06-15 12:25:24', '2019-06-15 12:25:24', NULL),
(17, 'Beach Party -Goa', 'Girish Desai', '50386.jpg', 'https://www.youtube.com/channel/UCHFPv5qB7co0eWDIchBSQzQ/videos', '2019-06-15 12:25:53', '2019-06-15 12:25:53', NULL),
(18, 'Beach Party -Goa', 'Girish Desai', '16094.jpg', 'https://www.youtube.com/channel/UCHFPv5qB7co0eWDIchBSQzQ/videos', '2019-06-15 12:28:01', '2019-06-15 12:28:01', NULL),
(19, 'Beach Party -Goa', 'Girish Desai', '58856.jpg', 'https://www.youtube.com/channel/UCHFPv5qB7co0eWDIchBSQzQ/videos', '2019-06-15 12:28:48', '2019-06-15 12:28:48', NULL),
(20, 'Mehendi', 'Girish Desai', '75240.jpg', 'https://www.youtube.com/channel/UCHFPv5qB7co0eWDIchBSQzQ/videos', '2019-06-15 12:29:47', '2019-06-15 12:29:47', NULL),
(21, 'Mehendi', 'Girish Desai', '57349.jpg', 'https://www.youtube.com/channel/UCHFPv5qB7co0eWDIchBSQzQ/videos', '2019-06-15 12:30:15', '2019-06-15 12:30:15', NULL),
(22, 'Reception', 'Girish Desai', '63676.jpg', 'https://www.youtube.com/channel/UCHFPv5qB7co0eWDIchBSQzQ/videos', '2019-06-15 12:31:09', '2019-06-15 12:31:09', NULL),
(23, 'Beach Party -Goa', 'Girish Desai', '92650.jpg', 'https://www.youtube.com/channel/UCHFPv5qB7co0eWDIchBSQzQ/videos', '2019-06-15 12:40:33', '2019-06-15 12:40:33', NULL),
(24, 'Garba Night -Goa', 'Girish Desai', '92676.jpg', 'https://www.youtube.com/channel/UCHFPv5qB7co0eWDIchBSQzQ/videos', '2019-06-15 12:46:47', '2019-06-15 12:46:47', NULL);

-- --------------------------------------------------------

--
-- Table structure for table `event_gallery`
--

CREATE TABLE `event_gallery` (
  `id` int(11) NOT NULL,
  `function_name` varchar(255) NOT NULL,
  `client_name` varchar(255) NOT NULL,
  `image` varchar(255) NOT NULL,
  `created_at` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP,
  `updated_at` timestamp NULL DEFAULT NULL,
  `deleted_at` time DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Dumping data for table `event_gallery`
--

INSERT INTO `event_gallery` (`id`, `function_name`, `client_name`, `image`, `created_at`, `updated_at`, `deleted_at`) VALUES
(1, 'Kids at Party', 'Birthday Parties', '43620.jpg', '2019-06-11 04:18:00', '2019-06-11 04:18:00', NULL),
(2, 'Kids at Party', 'Birthday Parties', '16778.jpg', '2019-06-14 06:26:18', '2019-06-14 06:34:05', NULL);

-- --------------------------------------------------------

--
-- Table structure for table `event_video`
--

CREATE TABLE `event_video` (
  `id` int(11) NOT NULL,
  `function_name` varchar(255) NOT NULL,
  `client_name` varchar(255) NOT NULL,
  `image` varchar(255) NOT NULL,
  `youtube_link` text NOT NULL,
  `created_at` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP,
  `updated_at` timestamp NULL DEFAULT NULL,
  `deleted_at` time DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Dumping data for table `event_video`
--

INSERT INTO `event_video` (`id`, `function_name`, `client_name`, `image`, `youtube_link`, `created_at`, `updated_at`, `deleted_at`) VALUES
(1, 'Kids at Party', 'Birthday Parties', '86824.jpg', 'https://www.youtube.com/watch?v=vhvdnKfpG1s', '2019-06-11 06:39:28', '2019-06-11 06:39:28', NULL),
(2, 'Kids at Party', 'Birthday Parties', '89431.jpg', 'https://www.youtube.com/watch?v=vhvdnKfpG1s', '2019-06-11 06:46:15', '2019-06-11 06:46:15', NULL),
(3, 'Kids at Party', 'Birthday Parties', '45114.jpg', 'https://www.youtube.com/watch?v=vhvdnKfpG1s', '2019-06-11 06:46:22', '2019-06-11 06:46:22', NULL),
(4, 'Kids at Party', 'Birthday Parties', '82693.jpg', 'https://www.youtube.com/watch?v=vhvdnKfpG1s', '2019-06-11 06:46:29', '2019-06-11 06:46:29', NULL),
(5, 'Kids at Party', 'Birthday Parties', '38335.jpg', 'https://www.youtube.com/watch?v=vhvdnKfpG1s', '2019-06-11 06:46:36', '2019-06-11 06:46:36', NULL),
(6, 'Kids at Party', 'Birthday Parties', '51487.jpg', 'https://www.youtube.com/watch?v=vhvdnKfpG1s', '2019-06-11 06:48:23', '2019-06-11 06:48:23', NULL),
(7, 'Kids at Party', 'Birthday Parties', '58109.jpg', 'https://www.youtube.com/watch?v=vhvdnKfpG1s', '2019-06-11 06:48:30', '2019-06-11 06:48:30', NULL),
(8, 'Kids at Party', 'Birthday Parties', '71458.jpg', 'https://www.youtube.com/watch?v=vhvdnKfpG1s', '2019-06-11 06:48:37', '2019-06-11 06:48:37', NULL);

-- --------------------------------------------------------

--
-- Table structure for table `in_city_wedding`
--

CREATE TABLE `in_city_wedding` (
  `id` int(11) NOT NULL,
  `function_name` varchar(255) NOT NULL,
  `client_name` varchar(255) NOT NULL,
  `image` varchar(255) NOT NULL,
  `youtube_link` text NOT NULL,
  `created_at` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP,
  `updated_at` timestamp NULL DEFAULT NULL,
  `deleted_at` time DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Dumping data for table `in_city_wedding`
--

INSERT INTO `in_city_wedding` (`id`, `function_name`, `client_name`, `image`, `youtube_link`, `created_at`, `updated_at`, `deleted_at`) VALUES
(1, 'Kids at Party', 'Birthday Parties', '30254.jpg', 'https://www.youtube.com/watch?v=vhvdnKfpG1s', '2019-06-11 01:09:51', '2019-06-11 01:10:02', NULL),
(2, 'Kids at Party', 'Birthday Parties', '84826.jpg', 'https://www.youtube.com/watch?v=vhvdnKfpG1s', '2019-06-14 05:42:14', '2019-06-14 06:48:06', NULL);

-- --------------------------------------------------------

--
-- Table structure for table `social_events`
--

CREATE TABLE `social_events` (
  `id` int(11) NOT NULL,
  `function_name` varchar(255) NOT NULL,
  `client_name` varchar(255) NOT NULL,
  `image` varchar(255) NOT NULL,
  `youtube_link` text NOT NULL,
  `created_at` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP,
  `updated_at` timestamp NULL DEFAULT NULL,
  `deleted_at` time DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Dumping data for table `social_events`
--

INSERT INTO `social_events` (`id`, `function_name`, `client_name`, `image`, `youtube_link`, `created_at`, `updated_at`, `deleted_at`) VALUES
(1, 'Kids at Party', 'Birthday Parties', '12308.jpg', 'https://www.youtube.com/watch?v=vhvdnKfpG1s', '2019-06-11 01:29:52', '2019-06-14 06:42:49', NULL);

-- --------------------------------------------------------

--
-- Table structure for table `team`
--

CREATE TABLE `team` (
  `id` int(11) NOT NULL,
  `team_member` varchar(255) NOT NULL,
  `position` varchar(255) NOT NULL,
  `image` varchar(255) NOT NULL,
  `created_at` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP,
  `updated_at` timestamp NULL DEFAULT NULL,
  `deleted_at` time DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Dumping data for table `team`
--

INSERT INTO `team` (`id`, `team_member`, `position`, `image`, `created_at`, `updated_at`, `deleted_at`) VALUES
(1, 'Charles Hasmana', 'Founder & Director', '51141.jpg', '2019-06-11 03:25:20', '2019-06-11 03:26:55', NULL);

--
-- Indexes for dumped tables
--

--
-- Indexes for table `admin`
--
ALTER TABLE `admin`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `banner_images`
--
ALTER TABLE `banner_images`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `contact`
--
ALTER TABLE `contact`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `corporate_events`
--
ALTER TABLE `corporate_events`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `destination_gallery`
--
ALTER TABLE `destination_gallery`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `event_gallery`
--
ALTER TABLE `event_gallery`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `event_video`
--
ALTER TABLE `event_video`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `in_city_wedding`
--
ALTER TABLE `in_city_wedding`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `social_events`
--
ALTER TABLE `social_events`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `team`
--
ALTER TABLE `team`
  ADD PRIMARY KEY (`id`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `admin`
--
ALTER TABLE `admin`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2;
--
-- AUTO_INCREMENT for table `banner_images`
--
ALTER TABLE `banner_images`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=8;
--
-- AUTO_INCREMENT for table `contact`
--
ALTER TABLE `contact`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2;
--
-- AUTO_INCREMENT for table `corporate_events`
--
ALTER TABLE `corporate_events`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=3;
--
-- AUTO_INCREMENT for table `destination_gallery`
--
ALTER TABLE `destination_gallery`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=25;
--
-- AUTO_INCREMENT for table `event_gallery`
--
ALTER TABLE `event_gallery`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=4;
--
-- AUTO_INCREMENT for table `event_video`
--
ALTER TABLE `event_video`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=9;
--
-- AUTO_INCREMENT for table `in_city_wedding`
--
ALTER TABLE `in_city_wedding`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=4;
--
-- AUTO_INCREMENT for table `social_events`
--
ALTER TABLE `social_events`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2;
--
-- AUTO_INCREMENT for table `team`
--
ALTER TABLE `team`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=3;
/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
