-- phpMyAdmin SQL Dump
-- version 5.2.1
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Generation Time: Jun 03, 2026 at 09:02 PM
-- Server version: 10.4.32-MariaDB
-- PHP Version: 8.2.12

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `company_app`
--

-- --------------------------------------------------------

--
-- Table structure for table `announcements`
--

CREATE TABLE `announcements` (
  `id` int(11) NOT NULL,
  `title` varchar(200) NOT NULL,
  `short_description` varchar(255) NOT NULL,
  `description` text NOT NULL,
  `image` varchar(255) DEFAULT NULL,
  `created_at` timestamp NOT NULL DEFAULT current_timestamp(),
  `link` varchar(500) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `announcements`
--

INSERT INTO `announcements` (`id`, `title`, `short_description`, `description`, `image`, `created_at`, `link`) VALUES
(1, 'إطلاق خدمة جديدة', 'الإعلان عن إطلاق خدمة جديدة لعملائنا.', '.', NULL, '2026-05-30 15:22:25', NULL);

-- --------------------------------------------------------

--
-- Table structure for table `contact_messages`
--

CREATE TABLE `contact_messages` (
  `id` int(11) NOT NULL,
  `name` varchar(120) NOT NULL,
  `email` varchar(150) NOT NULL,
  `phone` varchar(50) DEFAULT NULL,
  `message` text NOT NULL,
  `created_at` timestamp NOT NULL DEFAULT current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `contact_messages`
--

INSERT INTO `contact_messages` (`id`, `name`, `email`, `phone`, `message`, `created_at`) VALUES
(1, 'Editor', 'Editor@company.com', '0780000001', 'dfxb hfdxgbfdcxgfdxgbxfdcgbdfxgbvdxfgvbdfgdxgvdfgbvfdgbvdxfgv', '2026-05-30 15:26:21');

-- --------------------------------------------------------

--
-- Table structure for table `team_members`
--

CREATE TABLE `team_members` (
  `id` int(11) NOT NULL,
  `name` varchar(120) NOT NULL,
  `position` varchar(120) NOT NULL,
  `image` varchar(255) DEFAULT NULL,
  `created_at` timestamp NOT NULL DEFAULT current_timestamp(),
  `member_type` enum('board','executive') NOT NULL DEFAULT 'board'
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `team_members`
--

INSERT INTO `team_members` (`id`, `name`, `position`, `image`, `created_at`, `member_type`) VALUES
(1, 'نبيل محمد عبد الرحمن مزق', 'القائم بأعمال الرئيس التنفيذي', 'img_6a1c85e84bf1a4.93714515.png', '2026-05-30 15:22:25', 'executive'),
(8, 'محمد يوسف حسن غانم', 'المراقب المالي', 'img_6a1c85e0f076e8.10999139.png', '2026-05-31 18:59:20', 'executive'),
(9, 'محمد عبد الرحيم ازمقنا', 'مدير الشؤون الإدارية والقانونية', 'img_6a1c85d82aefc2.01849755.png', '2026-05-31 18:59:30', 'executive'),
(10, 'الأستاذ محمد أحمد موسى العزب', 'رئيس مجلس الإدارة', 'img_6a1c85d0472123.63263002.png', '2026-05-31 18:59:44', 'board'),
(11, 'الدكتور فاروق محمد مراد مراد', 'نائب رئيس مجلس الإدارة', 'img_6a1c85c86fe1b9.31005103.png', '2026-05-31 18:59:57', 'board'),
(13, 'الأستاذ كفاح أحمد مصطفى المحارمة', 'عضو مجلس الإدارة', 'img_6a1c85c097ba62.39309046.png', '2026-05-31 19:00:29', 'board'),
(14, 'الأستاذ سعيد محمد حسن المسعود', 'عضو مجلس الادارة', 'img_6a1c85b975e843.94800366.png', '2026-05-31 19:00:41', 'board'),
(15, 'جامعة آل البيت ويمثلها الدكتور أسامه خالد إبراهيم نصير', 'عضو مجلس الادارة', 'img_6a1c85a4e09169.04788074.png', '2026-05-31 19:01:00', 'board');

-- --------------------------------------------------------

--
-- Table structure for table `users`
--

CREATE TABLE `users` (
  `id` int(11) NOT NULL,
  `name` varchar(120) NOT NULL,
  `email` varchar(150) NOT NULL,
  `password` varchar(255) NOT NULL,
  `role` enum('Admin','Editor') NOT NULL DEFAULT 'Editor',
  `created_at` timestamp NOT NULL DEFAULT current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `users`
--

INSERT INTO `users` (`id`, `name`, `email`, `password`, `role`, `created_at`) VALUES
(1, 'Main Admin', 'admin@alaman.com', '', 'Admin', '2026-05-30 15:22:25'),
(2, 'Mohammed', 'mohammed@alaman.com', '', 'Editor', '2026-05-30 15:25:34');

--
-- Indexes for dumped tables
--

--
-- Indexes for table `announcements`
--
ALTER TABLE `announcements`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `contact_messages`
--
ALTER TABLE `contact_messages`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `team_members`
--
ALTER TABLE `team_members`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `users`
--
ALTER TABLE `users`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `email` (`email`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `announcements`
--
ALTER TABLE `announcements`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=5;

--
-- AUTO_INCREMENT for table `contact_messages`
--
ALTER TABLE `contact_messages`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2;

--
-- AUTO_INCREMENT for table `team_members`
--
ALTER TABLE `team_members`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=16;

--
-- AUTO_INCREMENT for table `users`
--
ALTER TABLE `users`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=4;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
