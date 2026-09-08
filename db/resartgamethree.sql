-- phpMyAdmin SQL Dump
-- version 5.2.0
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Generation Time: Sep 08, 2026 at 04:44 PM
-- Server version: 10.4.24-MariaDB
-- PHP Version: 8.2.0

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `resartgamethree`
--

-- --------------------------------------------------------

--
-- Table structure for table `admin`
--

CREATE TABLE `admin` (
  `admin_id` int(11) NOT NULL,
  `user_name` varchar(100) DEFAULT NULL,
  `user_email` varchar(100) DEFAULT NULL,
  `password` varchar(255) DEFAULT NULL,
  `hash_password` varchar(250) NOT NULL,
  `created_at` timestamp NOT NULL DEFAULT current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `admin`
--

INSERT INTO `admin` (`admin_id`, `user_name`, `user_email`, `password`, `hash_password`, `created_at`) VALUES
(1, 'Admin', 'admin@gmail.com', 'admin', '$2a$11$vVwLDM5sLBQZDvVGNlUzoOLTGruJQsgQihbwaIDDiK7tRTOj6R9Me', '2026-03-25 17:12:50');

-- --------------------------------------------------------

--
-- Table structure for table `admin_category`
--

CREATE TABLE `admin_category` (
  `cid` int(11) NOT NULL,
  `cat_name` varchar(250) NOT NULL,
  `cat_image` varchar(250) NOT NULL,
  `cat_status` enum('Active','InActive') NOT NULL DEFAULT 'Active',
  `created_at` varchar(25) NOT NULL,
  `updated_at` varchar(40) NOT NULL
) ENGINE=MyISAM DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `admin_category`
--

INSERT INTO `admin_category` (`cid`, `cat_name`, `cat_image`, `cat_status`, `created_at`, `updated_at`) VALUES
(1, '1', '1787319478_40b50916aca73cda7753.jpg', 'Active', '2026-08-21 06:27:32', '2026-08-26 13:49:40'),
(2, '2', '1787318412_68ce66ba3460b2201e49.jpg', 'Active', '2026-08-21 06:44:32', '2026-08-26 13:49:47'),
(3, '3', '1787318472_80c2de590d7f37525461.jpg', 'Active', '2026-08-21 06:01:33', '2026-08-26 13:49:53'),
(4, '4', '1787318547_3ddc7388d0b6339adb91.jpg', 'Active', '2026-08-21 06:19:33', '2026-08-26 13:49:59');

-- --------------------------------------------------------

--
-- Table structure for table `admin_subcategory`
--

CREATE TABLE `admin_subcategory` (
  `sid` int(11) NOT NULL,
  `cid` int(11) NOT NULL,
  `web_title` varchar(250) NOT NULL,
  `web_image` varchar(250) NOT NULL,
  `web_status` enum('Active','InActive') NOT NULL DEFAULT 'Active',
  `created_at` varchar(250) NOT NULL,
  `updated_at` varchar(250) NOT NULL
) ENGINE=MyISAM DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `admin_subcategory`
--

INSERT INTO `admin_subcategory` (`sid`, `cid`, `web_title`, `web_image`, `web_status`, `created_at`, `updated_at`) VALUES
(1, 1, 'First', '1787811486_6b91720358e197fba533.jpg', 'Active', '2026-08-21 07:45:37', '2026-08-27 06:18:06'),
(2, 1, 'Test', '1787811473_f05b2f2d5be8eb97a760.jpg', 'Active', '2026-08-21 07:57:37', '2026-08-27 06:17:53'),
(3, 2, 'Test', '1787811458_fd86b57cf9d00402883f.jpg', 'Active', '2026-08-21 07:08:38', '2026-08-27 06:17:38'),
(4, 2, 'Test', '1787811447_7998c8f0b3ae0757a7fb.jpg', 'Active', '2026-08-21 07:05:39', '2026-08-27 06:17:27'),
(5, 3, 'Test', '1787811433_e7dd0b85814d0d9a23e7.jpg', 'Active', '2026-08-21 07:17:39', '2026-08-27 06:17:13'),
(6, 3, 'Test', '1787811420_45f34b0d412519c8f0dc.jpg', 'Active', '2026-08-21 07:12:40', '2026-08-27 06:17:00'),
(7, 4, 'Test', '1787811405_6dfc4f0ac30bf0ed287b.png', 'Active', '2026-08-21 07:23:40', '2026-08-27 06:16:45'),
(8, 4, 'Test', '1787811391_720fda22dde929e2c554.jpg', 'Active', '2026-08-21 07:34:40', '2026-08-27 06:16:31'),
(9, 1, 'Test', '1787811374_1c3f1a98c3f0be010aa2.jpg', 'Active', '2026-08-24 07:02:53', '2026-08-27 06:16:14'),
(10, 1, 'Test', '1787811363_751b268dd46c721d79a2.jpg', 'Active', '2026-08-24 07:16:53', '2026-08-27 06:16:03'),
(11, 1, 'Test', '1787811351_5f9da2da353052c585cc.jpg', 'Active', '2026-08-24 07:48:53', '2026-08-27 06:15:51'),
(12, 1, 'Test', '1787811338_5d821e321029bbbd636c.jpg', 'Active', '2026-08-24 07:11:54', '2026-08-27 06:15:38'),
(13, 1, 'Test', '1787811326_fb10e23eb67bff4e0931.jpg', 'Active', '2026-08-24 07:23:54', '2026-08-27 06:15:26'),
(14, 1, 'Test', '1787811315_c7dd27bbb7f7ca5d1e94.jpg', 'Active', '2026-08-24 07:35:54', '2026-08-27 06:15:15'),
(15, 1, 'Test', '1787811304_47428a0dcd82e82130f3.jpg', 'Active', '2026-08-24 07:45:54', '2026-08-27 06:15:04'),
(16, 1, 'Test', '1787811293_b2d56497cce519f09abd.jpg', 'Active', '2026-08-24 07:57:54', '2026-08-27 06:14:53'),
(17, 2, 'Test', '1787811276_1f0fec5c8eeff390e0ec.jpg', 'Active', '2026-08-24 07:06:56', '2026-08-27 06:14:36'),
(18, 2, 'Test', '1787811264_471b5125985c8937dfcc.jpg', 'Active', '2026-08-24 07:29:56', '2026-08-27 06:14:24'),
(19, 2, 'Test', '1787811252_87089a83312671597ffb.jpg', 'Active', '2026-08-24 07:45:56', '2026-08-27 06:14:12'),
(20, 2, 'Test', '1787811236_54236a025f90a4f1323a.jpg', 'Active', '2026-08-24 07:59:56', '2026-08-27 06:13:56'),
(21, 2, 'Test', '1787811224_1b0b2da89935447019fd.jpg', 'Active', '2026-08-24 07:16:57', '2026-08-27 06:13:44'),
(22, 2, 'Test', '1787811211_36637e1aa70ffa2698bb.jpg', 'Active', '2026-08-24 07:33:57', '2026-08-27 06:13:31'),
(23, 2, 'Test', '1787811200_ff875cb4cb4f75669b6b.jpg', 'Active', '2026-08-24 07:52:57', '2026-08-27 06:13:20'),
(24, 2, 'Test', '1787811189_dbe91a48b3d2a059f9d2.jpg', 'Active', '2026-08-24 07:03:58', '2026-08-27 06:13:09'),
(25, 3, 'Test', '1787811172_1e4d7f1195e16a0c985f.jpg', 'Active', '2026-08-24 07:11:59', '2026-08-27 06:12:52'),
(26, 3, 'Test', '1787811159_07e2daf8517847203e29.jpg', 'Active', '2026-08-24 07:38:59', '2026-08-27 06:12:39'),
(27, 3, 'Test', '1787811143_6c10b37763bdbfd08f02.jpg', 'Active', '2026-08-24 07:50:59', '2026-08-27 06:12:23'),
(28, 3, 'Test', '1787811122_417ac8d34e595e5bf2c0.jpg', 'Active', '2026-08-24 08:04:00', '2026-08-27 06:12:02'),
(29, 3, 'Test', '1787811104_f6abcaaab401e5ebbfe4.jpg', 'Active', '2026-08-24 08:22:00', '2026-08-27 06:11:44'),
(30, 3, 'Test', '1787810989_6f1c2cba295d2ffbb63c.jpg', 'Active', '2026-08-24 08:41:00', '2026-08-27 06:09:49'),
(31, 3, 'Test', '1787810975_bc19b0d43905256e4822.jpg', 'InActive', '2026-08-24 08:53:00', '2026-08-27 06:09:35'),
(32, 3, 'Test', '1787810959_7f7f41987a04165234ed.jpg', 'Active', '2026-08-24 08:06:01', '2026-08-27 06:09:19'),
(33, 3, 'Test', '1787810948_052ef6d2fb704b9d6ba0.jpg', 'Active', '2026-08-24 08:15:01', '2026-08-27 06:09:08'),
(34, 4, 'Test', '1787810930_2410d9e1001890c161e6.jpg', 'Active', '2026-08-24 08:13:02', '2026-08-27 06:08:50'),
(35, 4, 'Test', '1787810920_932adc3baf14b2af27f9.jpg', 'Active', '2026-08-24 08:24:02', '2026-08-27 06:08:40'),
(36, 4, 'Test', '1787810910_696a1a708c06ec298c44.jpg', 'Active', '2026-08-24 08:44:02', '2026-08-27 06:08:30'),
(37, 4, 'Test', '1787810898_bf5f8ad469543e19b4f5.jpg', 'Active', '2026-08-24 08:57:02', '2026-08-27 06:08:18'),
(38, 4, 'Test', '1787810887_dc19df4c0e95a0b75a31.jpg', 'Active', '2026-08-24 08:07:03', '2026-08-27 06:08:07'),
(39, 4, 'Test', '1787810875_9cc2131359126081f4c9.jpg', 'Active', '2026-08-24 08:21:03', '2026-08-27 06:07:55'),
(40, 4, 'Test', '1787810865_4ee6d7976befe760ac9f.jpg', 'Active', '2026-08-24 08:37:03', '2026-08-27 06:07:45'),
(41, 4, 'Test', '1787810852_330f06a625e655816302.jpeg', 'Active', '2026-08-24 08:54:03', '2026-08-27 06:07:32');

-- --------------------------------------------------------

--
-- Table structure for table `admin_update`
--

CREATE TABLE `admin_update` (
  `uid` int(11) NOT NULL,
  `cid` int(10) NOT NULL,
  `activate_time` varchar(250) NOT NULL,
  `c_status` enum('Active','Inactive') NOT NULL DEFAULT 'Active',
  `created_at` timestamp(6) NOT NULL DEFAULT current_timestamp(6) ON UPDATE current_timestamp(6)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `admin_update`
--

INSERT INTO `admin_update` (`uid`, `cid`, `activate_time`, `c_status`, `created_at`) VALUES
(1, 3, '2026-08-29 14:48:45', 'Active', '2026-08-29 09:18:45.720692'),
(2, 1, '2026-08-29 14:50:39', 'Active', '2026-08-29 09:20:39.684169'),
(3, 2, '2026-08-29 14:52:06', 'Active', '2026-08-29 09:22:06.579784'),
(4, 4, '2026-08-29 14:53:16', 'Active', '2026-08-29 09:23:16.948357');

-- --------------------------------------------------------

--
-- Table structure for table `quiz_answers`
--

CREATE TABLE `quiz_answers` (
  `id` int(11) NOT NULL,
  `cid` int(11) DEFAULT NULL,
  `session_id` varchar(255) DEFAULT NULL,
  `image_id` int(11) NOT NULL,
  `submitted_time` varchar(250) NOT NULL,
  `status` enum('right','wrong','skip','timeout') NOT NULL,
  `time_taken` int(11) NOT NULL,
  `submitted_at` datetime DEFAULT NULL,
  `created_at` datetime DEFAULT current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `quiz_answers`
--

INSERT INTO `quiz_answers` (`id`, `cid`, `session_id`, `image_id`, `submitted_time`, `status`, `time_taken`, `submitted_at`, `created_at`) VALUES
(1, 3, '', 5, '14:48:52', 'right', 4, '2026-08-29 14:48:52', '2026-08-29 14:48:52'),
(2, 3, '', 6, '14:48:55', 'wrong', 3, '2026-08-29 14:48:55', '2026-08-29 14:48:55'),
(3, 3, '', 25, '14:48:59', 'right', 3, '2026-08-29 14:48:59', '2026-08-29 14:48:59'),
(4, 3, '', 26, '14:49:02', 'right', 2, '2026-08-29 14:49:02', '2026-08-29 14:49:02'),
(5, 3, '', 27, '14:49:05', 'right', 2, '2026-08-29 14:49:05', '2026-08-29 14:49:05'),
(6, 3, '', 28, '14:49:07', 'right', 2, '2026-08-29 14:49:07', '2026-08-29 14:49:07'),
(7, 3, '', 29, '14:49:11', 'right', 2, '2026-08-29 14:49:11', '2026-08-29 14:49:11'),
(8, 3, '', 30, '14:49:14', 'right', 2, '2026-08-29 14:49:14', '2026-08-29 14:49:14'),
(9, 3, '', 32, '14:49:18', 'right', 3, '2026-08-29 14:49:18', '2026-08-29 14:49:18'),
(10, 3, '', 33, '14:49:25', 'right', 6, '2026-08-29 14:49:25', '2026-08-29 14:49:25'),
(11, 1, '', 1, '14:50:43', 'right', 3, '2026-08-29 14:50:43', '2026-08-29 14:50:43'),
(12, 1, '', 2, '14:50:54', 'wrong', 10, '2026-08-29 14:50:54', '2026-08-29 14:50:54'),
(13, 1, '', 9, '14:50:58', 'right', 4, '2026-08-29 14:50:58', '2026-08-29 14:50:58'),
(14, 1, '', 10, '14:51:02', 'right', 2, '2026-08-29 14:51:02', '2026-08-29 14:51:02'),
(15, 1, '', 11, '14:51:05', 'right', 2, '2026-08-29 14:51:05', '2026-08-29 14:51:05'),
(16, 1, '', 12, '14:51:08', 'right', 2, '2026-08-29 14:51:08', '2026-08-29 14:51:08'),
(17, 1, '', 13, '14:51:13', 'right', 5, '2026-08-29 14:51:13', '2026-08-29 14:51:13'),
(18, 1, '', 14, '14:51:18', 'wrong', 3, '2026-08-29 14:51:18', '2026-08-29 14:51:18'),
(19, 1, '', 15, '14:51:28', 'wrong', 9, '2026-08-29 14:51:28', '2026-08-29 14:51:28'),
(20, 1, '', 16, '14:51:38', 'wrong', 10, '2026-08-29 14:51:38', '2026-08-29 14:51:38'),
(21, 2, '', 3, '14:52:10', 'right', 3, '2026-08-29 14:52:10', '2026-08-29 14:52:10'),
(22, 2, '', 4, '14:52:13', 'right', 2, '2026-08-29 14:52:13', '2026-08-29 14:52:13'),
(23, 2, '', 17, '14:52:18', 'right', 4, '2026-08-29 14:52:18', '2026-08-29 14:52:18'),
(24, 2, '', 18, '14:52:21', 'right', 2, '2026-08-29 14:52:21', '2026-08-29 14:52:21'),
(25, 2, '', 19, '14:52:24', 'right', 2, '2026-08-29 14:52:24', '2026-08-29 14:52:24'),
(26, 2, '', 20, '14:52:27', 'right', 2, '2026-08-29 14:52:27', '2026-08-29 14:52:27'),
(27, 2, '', 21, '14:52:29', 'right', 1, '2026-08-29 14:52:29', '2026-08-29 14:52:29'),
(28, 2, '', 22, '14:52:33', 'right', 3, '2026-08-29 14:52:33', '2026-08-29 14:52:33'),
(29, 2, '', 23, '14:52:36', 'right', 2, '2026-08-29 14:52:36', '2026-08-29 14:52:36'),
(30, 2, '', 24, '14:52:39', 'right', 2, '2026-08-29 14:52:39', '2026-08-29 14:52:39'),
(31, 4, '', 7, '14:53:20', 'right', 2, '2026-08-29 14:53:20', '2026-08-29 14:53:20'),
(32, 4, '', 8, '14:53:24', 'right', 3, '2026-08-29 14:53:24', '2026-08-29 14:53:24'),
(33, 4, '', 34, '14:53:27', 'right', 2, '2026-08-29 14:53:27', '2026-08-29 14:53:27'),
(34, 4, '', 35, '14:53:30', 'right', 2, '2026-08-29 14:53:30', '2026-08-29 14:53:30'),
(35, 4, '', 36, '14:53:37', 'right', 6, '2026-08-29 14:53:37', '2026-08-29 14:53:37'),
(36, 4, '', 37, '14:53:43', 'right', 5, '2026-08-29 14:53:43', '2026-08-29 14:53:43'),
(37, 4, '', 38, '14:53:46', 'right', 2, '2026-08-29 14:53:46', '2026-08-29 14:53:46'),
(38, 4, '', 39, '14:53:49', 'right', 2, '2026-08-29 14:53:49', '2026-08-29 14:53:49'),
(39, 4, '', 40, '14:53:56', 'right', 6, '2026-08-29 14:53:56', '2026-08-29 14:53:56'),
(40, 4, '', 41, '14:54:06', 'wrong', 10, '2026-08-29 14:54:06', '2026-08-29 14:54:06');

--
-- Indexes for dumped tables
--

--
-- Indexes for table `admin`
--
ALTER TABLE `admin`
  ADD PRIMARY KEY (`admin_id`),
  ADD UNIQUE KEY `email` (`user_email`);

--
-- Indexes for table `admin_category`
--
ALTER TABLE `admin_category`
  ADD PRIMARY KEY (`cid`);

--
-- Indexes for table `admin_subcategory`
--
ALTER TABLE `admin_subcategory`
  ADD PRIMARY KEY (`sid`);

--
-- Indexes for table `admin_update`
--
ALTER TABLE `admin_update`
  ADD PRIMARY KEY (`uid`);

--
-- Indexes for table `quiz_answers`
--
ALTER TABLE `quiz_answers`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `unique_user_session_image` (`cid`,`session_id`,`image_id`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `admin`
--
ALTER TABLE `admin`
  MODIFY `admin_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2;

--
-- AUTO_INCREMENT for table `admin_category`
--
ALTER TABLE `admin_category`
  MODIFY `cid` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=5;

--
-- AUTO_INCREMENT for table `admin_subcategory`
--
ALTER TABLE `admin_subcategory`
  MODIFY `sid` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=42;

--
-- AUTO_INCREMENT for table `admin_update`
--
ALTER TABLE `admin_update`
  MODIFY `uid` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=5;

--
-- AUTO_INCREMENT for table `quiz_answers`
--
ALTER TABLE `quiz_answers`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=41;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
