-- phpMyAdmin SQL Dump
-- version 4.2.11
-- http://www.phpmyadmin.net
--
-- Host: localhost
-- Generation Time: Apr 09, 2019 at 09:21 AM
-- Server version: 5.6.21
-- PHP Version: 5.6.3

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8 */;

--
-- Database: `vocoda_new`
--

-- --------------------------------------------------------

--
-- Table structure for table `companys`
--

CREATE TABLE IF NOT EXISTS `companys` (
`id` int(11) NOT NULL,
  `name` varchar(255) DEFAULT NULL,
  `description` varchar(255) DEFAULT NULL,
  `parent_company_id` int(11) NOT NULL DEFAULT '1',
  `created_at` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP,
  `updated_at` timestamp NULL DEFAULT NULL,
  `deleted_at` time DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

-- --------------------------------------------------------

--
-- Table structure for table `company_plan`
--

CREATE TABLE IF NOT EXISTS `company_plan` (
`id` int(11) NOT NULL,
  `company_id` int(11) NOT NULL,
  `plan_id` int(11) NOT NULL,
  `licence_count` int(11) DEFAULT NULL,
  `stripe_subscription_id` int(11) DEFAULT NULL,
  `subcription_expired_date` date DEFAULT NULL,
  `created_at` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP,
  `updated_at` timestamp NULL DEFAULT NULL,
  `deleted_at` time DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

-- --------------------------------------------------------

--
-- Table structure for table `company_plan_user`
--

CREATE TABLE IF NOT EXISTS `company_plan_user` (
`id` int(11) NOT NULL,
  `company_plan_id` int(11) NOT NULL,
  `user_id` int(11) NOT NULL,
  `created_at` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP,
  `updated_at` timestamp NULL DEFAULT NULL,
  `deleted_at` time DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

-- --------------------------------------------------------

--
-- Table structure for table `company_users`
--

CREATE TABLE IF NOT EXISTS `company_users` (
`id` int(11) NOT NULL,
  `company_id` int(11) NOT NULL,
  `user_id` int(11) NOT NULL,
  `created_at` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP,
  `updated_at` timestamp NULL DEFAULT NULL,
  `deleted_at` time DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

-- --------------------------------------------------------

--
-- Table structure for table `permission`
--

CREATE TABLE IF NOT EXISTS `permission` (
`id` int(11) NOT NULL,
  `name` varchar(255) NOT NULL,
  `created_at` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP,
  `updated_at` timestamp NULL DEFAULT NULL,
  `deleted_at` time DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

-- --------------------------------------------------------

--
-- Table structure for table `plans`
--

CREATE TABLE IF NOT EXISTS `plans` (
`id` int(11) NOT NULL,
  `plan_stripe_id` varchar(255) DEFAULT NULL,
  `name` varchar(255) NOT NULL,
  `descripition` varchar(255) DEFAULT NULL,
  `price` varchar(255) DEFAULT NULL,
  `interval` varchar(255) DEFAULT NULL,
  `currency` varchar(225) DEFAULT NULL,
  `credits` int(11) DEFAULT NULL,
  `created_at` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP,
  `updated_at` timestamp NULL DEFAULT NULL,
  `deleted_at` time DEFAULT NULL
) ENGINE=InnoDB AUTO_INCREMENT=26 DEFAULT CHARSET=latin1;

--
-- Dumping data for table `plans`
--

INSERT INTO `plans` (`id`, `plan_stripe_id`, `name`, `descripition`, `price`, `interval`, `currency`, `credits`, `created_at`, `updated_at`, `deleted_at`) VALUES
(6, 'plan_Eee8aqslDlGbY0', 'plan test1', 'plan test 66', '0.01', 'month', '£GBP', 1, '2019-03-26 11:08:50', '2019-03-07 18:22:32', NULL),
(12, 'prod_EeExi5x62xBC6E', 'plan test', 'test planb ', '0.01', 'month', '£GBP', 11, '2019-03-26 11:08:55', NULL, NULL),
(16, NULL, 'testingt', 'paln test 555', '2', 'month', '£GBP', 12, '2019-03-26 11:09:40', '2019-03-25 16:51:33', NULL),
(17, NULL, 'hitartq', 'hfiaos', '3', 'month', '£GBP', 12, '2019-03-26 11:09:37', '2019-03-25 16:58:18', NULL),
(18, NULL, 'haiodfk', 'jdladjflqdflj', '1', 'month', '£GBP', 221, '2019-03-26 11:09:35', '2019-03-25 17:05:38', NULL),
(19, NULL, 'gukl', 'jknku', '12', 'month', '£GBP', 1, '2019-03-26 11:09:33', '2019-03-25 17:09:38', NULL),
(20, NULL, 'plan_ElMgjRmEoEDwJu', 'paln test 555', '1', 'month', '£GBP', 1, '2019-03-26 11:09:31', '2019-03-25 17:22:48', NULL),
(21, 'plan_ElMur81gtB3ucX', 'plan work', 'working', '3', 'month', '£GBP', 1, '2019-03-26 11:09:29', '2019-03-25 17:36:23', NULL),
(22, 'plan_EnyoMr7FV3kxDV', 'planfortest', 'testing plan', '500', NULL, '£GBP', 5, '2019-04-01 16:55:11', '2019-04-01 16:55:11', NULL),
(23, 'plan_Enyq4H9m1QoL73', 'Hitarth', 'This is testing plan for hitarth', '5.99', NULL, '£GBP', 56, '2019-04-01 16:56:43', '2019-04-01 16:56:43', NULL),
(24, 'plan_EnyyWijN7Qo2GK', 'vasavada', 'hitarth', '5.99', NULL, '£GBP', 54, '2019-04-01 17:04:49', '2019-04-01 17:04:49', NULL),
(25, 'plan_Enz013GprvfPg4', 'testy33', 'test', '1.25', NULL, '£GBP', 5, '2019-04-01 17:06:58', '2019-04-01 17:06:58', NULL);

-- --------------------------------------------------------

--
-- Table structure for table `plan_roles`
--

CREATE TABLE IF NOT EXISTS `plan_roles` (
`id` int(11) NOT NULL,
  `name` varchar(255) NOT NULL,
  `created_at` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP,
  `updated_at` timestamp NULL DEFAULT NULL,
  `deleted_at` time DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

-- --------------------------------------------------------

--
-- Table structure for table `roles`
--

CREATE TABLE IF NOT EXISTS `roles` (
`id` int(11) NOT NULL,
  `name` varchar(255) NOT NULL,
  `created_at` timestamp NULL DEFAULT CURRENT_TIMESTAMP,
  `updated_at` timestamp NULL DEFAULT NULL,
  `deleted_at` time DEFAULT NULL
) ENGINE=InnoDB AUTO_INCREMENT=5 DEFAULT CHARSET=latin1;

--
-- Dumping data for table `roles`
--

INSERT INTO `roles` (`id`, `name`, `created_at`, `updated_at`, `deleted_at`) VALUES
(1, 'admin', '2019-02-04 07:48:41', NULL, NULL),
(2, 'viewer', '2019-02-04 07:48:41', NULL, NULL),
(3, 'user', '2019-03-21 04:17:57', NULL, NULL),
(4, 'company', '2019-04-03 06:12:08', NULL, NULL);

-- --------------------------------------------------------

--
-- Table structure for table `transcripts`
--

CREATE TABLE IF NOT EXISTS `transcripts` (
`id` int(11) NOT NULL,
  `user_id` int(11) NOT NULL,
  `name` varchar(255) NOT NULL,
  `audio` varchar(255) NOT NULL,
  `text` text NOT NULL,
  `length` varchar(255) NOT NULL,
  `accuracy` varchar(255) NOT NULL,
  `status` int(11) NOT NULL COMMENT '0:done , 1:submitted',
  `created_at` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP,
  `updated_at` timestamp NULL DEFAULT NULL,
  `deleted_at` time DEFAULT NULL
) ENGINE=InnoDB AUTO_INCREMENT=19 DEFAULT CHARSET=latin1;

--
-- Dumping data for table `transcripts`
--

INSERT INTO `transcripts` (`id`, `user_id`, `name`, `audio`, `text`, `length`, `accuracy`, `status`, `created_at`, `updated_at`, `deleted_at`) VALUES
(18, 3, 'transcript_updated', '67345.mp3', 'update', '0:45', '77', 1, '2019-03-28 18:59:53', '2019-03-28 19:15:18', NULL);

-- --------------------------------------------------------

--
-- Table structure for table `users`
--

CREATE TABLE IF NOT EXISTS `users` (
`id` int(10) unsigned NOT NULL,
  `role_id` int(12) NOT NULL,
  `viewer_id` int(11) DEFAULT NULL,
  `company_id` int(11) NOT NULL DEFAULT '0',
  `stripe_customer_id` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `stripe_subscription_id` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `first_name` varchar(191) COLLATE utf8mb4_unicode_ci NOT NULL,
  `last_name` varchar(191) COLLATE utf8mb4_unicode_ci NOT NULL,
  `is_verified` tinyint(4) NOT NULL DEFAULT '1',
  `subscription_expired_date` timestamp NULL DEFAULT NULL,
  `stripe_plan_id` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `email` varchar(191) COLLATE utf8mb4_unicode_ci NOT NULL,
  `password` varchar(191) COLLATE utf8mb4_unicode_ci NOT NULL,
  `user_token` text COLLATE utf8mb4_unicode_ci,
  `device_token` text COLLATE utf8mb4_unicode_ci,
  `remember_token` text COLLATE utf8mb4_unicode_ci,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  `deleted_at` time DEFAULT NULL
) ENGINE=InnoDB AUTO_INCREMENT=75 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `users`
--

INSERT INTO `users` (`id`, `role_id`, `viewer_id`, `company_id`, `stripe_customer_id`, `stripe_subscription_id`, `first_name`, `last_name`, `is_verified`, `subscription_expired_date`, `stripe_plan_id`, `email`, `password`, `user_token`, `device_token`, `remember_token`, `created_at`, `updated_at`, `deleted_at`) VALUES
(45, 1, 3, 61, '', 'sub_00000000000000', 'admin', 'dmin', 1, '2019-04-25 18:55:43', 'planBasic_00000000000000', 'admin_admin@admin.com', '$2y$10$DZIqoJ/yTnijNB.7yCOAV.p2cgwgaD1FK6sQXYm91irG5mkwNbiOC', '8b476aa7c188d7c5c3edd45afd2fed3ccdb8a6cdba612cdfbec2136a56179341', '123456', NULL, '2019-03-25 16:31:55', '2019-04-03 15:57:54', NULL),
(46, 2, 45, 61, 'cus_00000000000000', 'sub_00000000000000', 'hia', 'jijo', 1, '2019-05-04 18:02:42', 'planBasic_00000000000000', 'admin_viewer@admin.com', '$2y$10$wAs0V6wc7kJ8812uFO1FHOf6TBkOD/oWVc1RSigcjW34Go9NuXb4O', NULL, NULL, NULL, '2019-03-25 16:32:32', '2019-04-05 05:37:59', NULL),
(55, 3, 46, 61, 'cus_ElmGaNT6Mt8m6Z', 'sub_ElmMRbH7YgkD2O', 'Harshik', 'Shah', 1, '2016-04-25 16:58:03', 'plan_Eee8aqslDlGbY0', 'shahharshil7894@gmail.com', '$2y$10$JJ280bQxbH.6sfsZ7dSkUOUFnwbb5i5SRQ.fJHHGKRxK7SO80frG.', '6f80302bec3bf03e581553961b58731c9db907f58105d8bfa60553edbd9fdf3f', '123456', NULL, '2019-03-26 18:12:10', '2019-04-05 05:45:21', NULL),
(57, 3, 46, 61, 'cus_Elma5ONDTUL0If', NULL, 'harsgik new', 'shah', 1, '2019-03-26 20:09:07', NULL, 'harshil71894@gmail.com', '$2y$10$/RYfXFaycQdT.J1OCBGe/OCcwzveQ.apTlMMCdXgPneG.QebLOBWG', '48545e9b7ea9047d3307c1fed288b61a070e2af6cad7b83af6217ee76950a424', '123456', NULL, '2019-03-26 20:09:04', '2019-03-26 20:09:54', NULL),
(58, 2, 0, 61, NULL, NULL, 'hitart', 'vasavada', 1, NULL, NULL, 'hitarth@gmail.com', '$2y$10$hTXnuky5rVe5vT4/R5K2/egxm1gmGpXh5SmVImlKo6Y6LqA8Vp0F6', NULL, NULL, NULL, '2019-04-01 11:46:50', '2019-04-01 12:07:15', NULL),
(59, 2, 0, 61, NULL, NULL, 'hitarth', 'vasavda', 1, NULL, NULL, 'hitarth@gmail.comms', '$2y$10$AqXjMB6xwYzYUqOJpFgVE.EN5s7Rbcu7wIXO0UpfSa65cR1x/YSgK', NULL, NULL, NULL, '2019-04-01 14:05:05', '2019-04-01 14:05:05', NULL),
(61, 4, 0, 0, NULL, NULL, 'Company 1', 'Techonology', 1, NULL, NULL, 'no@yopmail.com23', '$2y$10$e0tY5ZbbM5cf3Skj7oBlKeewJ/r7b54m2mke2UAyNxOdXQqeHQz0C', '48545e9b7ea9047d3307c1fed288b61a070e2af6cad7b83af6217ee76950a424', NULL, NULL, '2019-04-03 14:34:23', '2019-04-05 02:08:31', NULL),
(62, 2, 0, 61, NULL, NULL, 'viewer with company', 'viewer compnay', 1, NULL, NULL, 'viewer_company@gmail.com', '$2y$10$FQ.OqT4py3WF37kz2VGLbOuLSMnxkvZ3piKkqin8RgFNqKxnSYJyC', NULL, NULL, NULL, '2019-04-03 14:41:00', '2019-04-03 14:41:00', NULL),
(63, 3, 62, 61, NULL, NULL, 'user with company', 'user company', 1, NULL, NULL, 'user_wiht@company.com', '$2y$10$3sOBKAKY5SD.dOlmS8mS0.AeX55tW5aITMwvGMVH67h11hDJ5EJ2C', NULL, NULL, NULL, '2019-04-03 14:44:27', '2019-04-03 14:44:27', NULL),
(64, 4, 0, 0, NULL, NULL, 'company 2', 'compnay 2', 1, NULL, NULL, 'company@gmail.com', '$2y$10$gEXXYq/yEMrGkZU9ClUGWuo57SDjy0EhLafVTow2VoJDguvjgWDyy', NULL, NULL, NULL, '2019-04-03 15:50:10', '2019-04-03 15:50:10', NULL),
(65, 2, 0, 64, NULL, NULL, 'viewer 2', 'viewer 2', 1, NULL, NULL, 'viewer_compaasdany@gmail.com223846', '$2y$10$JVPggDiYdt.t1bBXuijw8O8bHGm6p6eiHODsDODltoHE8pVyI9QVi', NULL, NULL, NULL, '2019-04-03 16:02:03', '2019-04-03 16:02:03', NULL),
(66, 3, 65, 64, NULL, NULL, 'user 2', 'user 22', 1, NULL, NULL, 'user_wiht@company.com12', '$2y$10$/MDuDMb9WKw0Ut1kOTQnOu1NttIdaHE3HgexbfJZnVeOlnC.m4EPq', NULL, NULL, NULL, '2019-04-03 16:02:49', '2019-04-03 16:02:49', NULL),
(67, 3, 46, 61, NULL, NULL, 'hitarth', 'vasdadava', 1, NULL, NULL, 'no@as.copn', '$2y$10$v8pf0ZUPf9T/ZgsIK7hqPufFKsRa7LHudjSJM.fTXu/nPDalnQyxS', NULL, NULL, NULL, '2019-04-05 02:16:04', '2019-04-05 02:16:04', NULL),
(68, 2, 0, 61, NULL, NULL, 'viewer for comanty 64', 'viewer 64', 1, NULL, NULL, 'viewer_compaasdany@gmail.com223846as', '$2y$10$d4R4cs8m9F/jmPB7vRPET.gfMRe0pg9jD0BmFqWV10Tt0OEHHwYgi', NULL, NULL, NULL, '2019-04-05 02:32:15', '2019-04-05 02:32:15', NULL),
(70, 2, 0, 61, NULL, NULL, 'viewer 641', 'viewer  6412', 1, NULL, NULL, 'viewer_compaasasdany@gmail.com223846as', '$2y$10$rCu3YapXrrVZUx7q0b.2kOSxa2k4Md3yXdiFt9TOXDj4vIbO1OS2W', NULL, NULL, NULL, '2019-04-05 05:38:38', '2019-04-05 05:38:38', NULL),
(72, 3, 70, 61, NULL, NULL, 'hitarth', 'vasavada', 1, NULL, NULL, 'addasassdasd2@admin.com', '$2y$10$7pub28yDIhVdu9KBkJgbVu2674JgVD.pQCkXJl8StQvLw4vULPenq', 'Ud2eb6b9a667a9e3c85a9ccc2', '123456', NULL, '2019-04-05 06:52:15', '2019-04-05 07:03:10', NULL),
(74, 3, 68, 61, NULL, NULL, 'hitarth', 'vasavada', 1, NULL, NULL, 'addasassdasd2@asdasd.com', '$2y$10$7WTXuDrKlns/56iiJ7YiyOlElyfC7RPswMVwuiOkvbJYYkP0aVTwy', 'fae002f9a57182b84c1f888ae', '123456', NULL, '2019-04-05 07:06:30', '2019-04-05 07:06:45', NULL);

-- --------------------------------------------------------

--
-- Table structure for table `user_permission`
--

CREATE TABLE IF NOT EXISTS `user_permission` (
`id` int(11) NOT NULL,
  `company_user_id` int(11) NOT NULL,
  `permission_id` int(11) NOT NULL,
  `created_at` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP,
  `updated_at` timestamp NULL DEFAULT NULL,
  `deleted_at` time DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

-- --------------------------------------------------------

--
-- Table structure for table `user_view`
--

CREATE TABLE IF NOT EXISTS `user_view` (
`id` int(11) NOT NULL,
  `viewer_id` int(11) NOT NULL,
  `target_user_id` int(11) NOT NULL,
  `created_at` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP,
  `updated_at` timestamp NULL DEFAULT NULL,
  `deleted_at` time DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Indexes for dumped tables
--

--
-- Indexes for table `companys`
--
ALTER TABLE `companys`
 ADD PRIMARY KEY (`id`);

--
-- Indexes for table `company_plan`
--
ALTER TABLE `company_plan`
 ADD PRIMARY KEY (`id`);

--
-- Indexes for table `company_plan_user`
--
ALTER TABLE `company_plan_user`
 ADD PRIMARY KEY (`id`);

--
-- Indexes for table `company_users`
--
ALTER TABLE `company_users`
 ADD PRIMARY KEY (`id`);

--
-- Indexes for table `permission`
--
ALTER TABLE `permission`
 ADD PRIMARY KEY (`id`);

--
-- Indexes for table `plans`
--
ALTER TABLE `plans`
 ADD PRIMARY KEY (`id`);

--
-- Indexes for table `plan_roles`
--
ALTER TABLE `plan_roles`
 ADD PRIMARY KEY (`id`);

--
-- Indexes for table `roles`
--
ALTER TABLE `roles`
 ADD PRIMARY KEY (`id`);

--
-- Indexes for table `transcripts`
--
ALTER TABLE `transcripts`
 ADD PRIMARY KEY (`id`);

--
-- Indexes for table `users`
--
ALTER TABLE `users`
 ADD PRIMARY KEY (`id`), ADD UNIQUE KEY `users_email_unique` (`email`);

--
-- Indexes for table `user_permission`
--
ALTER TABLE `user_permission`
 ADD PRIMARY KEY (`id`);

--
-- Indexes for table `user_view`
--
ALTER TABLE `user_view`
 ADD PRIMARY KEY (`id`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `companys`
--
ALTER TABLE `companys`
MODIFY `id` int(11) NOT NULL AUTO_INCREMENT;
--
-- AUTO_INCREMENT for table `company_plan`
--
ALTER TABLE `company_plan`
MODIFY `id` int(11) NOT NULL AUTO_INCREMENT;
--
-- AUTO_INCREMENT for table `company_plan_user`
--
ALTER TABLE `company_plan_user`
MODIFY `id` int(11) NOT NULL AUTO_INCREMENT;
--
-- AUTO_INCREMENT for table `company_users`
--
ALTER TABLE `company_users`
MODIFY `id` int(11) NOT NULL AUTO_INCREMENT;
--
-- AUTO_INCREMENT for table `permission`
--
ALTER TABLE `permission`
MODIFY `id` int(11) NOT NULL AUTO_INCREMENT;
--
-- AUTO_INCREMENT for table `plans`
--
ALTER TABLE `plans`
MODIFY `id` int(11) NOT NULL AUTO_INCREMENT,AUTO_INCREMENT=26;
--
-- AUTO_INCREMENT for table `plan_roles`
--
ALTER TABLE `plan_roles`
MODIFY `id` int(11) NOT NULL AUTO_INCREMENT;
--
-- AUTO_INCREMENT for table `roles`
--
ALTER TABLE `roles`
MODIFY `id` int(11) NOT NULL AUTO_INCREMENT,AUTO_INCREMENT=5;
--
-- AUTO_INCREMENT for table `transcripts`
--
ALTER TABLE `transcripts`
MODIFY `id` int(11) NOT NULL AUTO_INCREMENT,AUTO_INCREMENT=19;
--
-- AUTO_INCREMENT for table `users`
--
ALTER TABLE `users`
MODIFY `id` int(10) unsigned NOT NULL AUTO_INCREMENT,AUTO_INCREMENT=75;
--
-- AUTO_INCREMENT for table `user_permission`
--
ALTER TABLE `user_permission`
MODIFY `id` int(11) NOT NULL AUTO_INCREMENT;
--
-- AUTO_INCREMENT for table `user_view`
--
ALTER TABLE `user_view`
MODIFY `id` int(11) NOT NULL AUTO_INCREMENT;
/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
