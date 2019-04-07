-- phpMyAdmin SQL Dump
-- version 4.7.7
-- https://www.phpmyadmin.net/
--
-- Host: localhost
-- Generation Time: Apr 07, 2019 at 01:55 PM
-- Server version: 5.6.38
-- PHP Version: 7.2.1

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `G4_php_masrawy`
--

-- --------------------------------------------------------

--
-- Table structure for table `ads`
--

CREATE TABLE `ads` (
  `id` int(11) NOT NULL,
  `cat_id` int(11) NOT NULL,
  `image` text NOT NULL,
  `title` text NOT NULL,
  `link` text NOT NULL,
  `start_date` text NOT NULL,
  `end_date` text NOT NULL,
  `price` decimal(9,2) NOT NULL,
  `status` tinyint(1) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

-- --------------------------------------------------------

--
-- Table structure for table `categories`
--

CREATE TABLE `categories` (
  `id` int(11) NOT NULL,
  `name` text NOT NULL,
  `cat_date` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP,
  `deleted` int(1) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Dumping data for table `categories`
--

INSERT INTO `categories` (`id`, `name`, `cat_date`, `deleted`) VALUES
(2, 'الفن', '2019-02-01 17:13:34', 0),
(6, 'الرياضة', '2019-02-01 17:13:39', 0),
(7, 'الارصاد', '2019-02-01 17:15:01', 0),
(8, 'منوعات', '2019-02-01 17:13:53', 0),
(9, '098f6bcd4621d373cade4e832627b4f6', '2019-02-08 16:56:56', 1),
(10, 'test category', '2019-02-08 16:57:02', 1),
(11, 'test category', '2019-02-08 16:57:01', 1);

-- --------------------------------------------------------

--
-- Table structure for table `contact_us`
--

CREATE TABLE `contact_us` (
  `id` int(11) NOT NULL,
  `name` text NOT NULL,
  `email` text NOT NULL,
  `mobile` text,
  `company` text,
  `message` longtext NOT NULL,
  `seen` int(1) NOT NULL DEFAULT '0',
  `at_date` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Dumping data for table `contact_us`
--

INSERT INTO `contact_us` (`id`, `name`, `email`, `mobile`, `company`, `message`, `seen`, `at_date`) VALUES
(1, 'ahmed', 'ahmed@gmail.com', '', NULL, 'test message', 1, '2019-02-08 18:48:22'),
(3, 'ali', 'ali@asdmc.om', '', '', 'hahashdhasd sad adasd', 1, '2019-02-08 18:44:19'),
(4, 'Kareem', 'kemo@gmail.com', '0191019101910', 'kemo MM', 'question ? :D', 1, '2019-02-08 18:49:28');

-- --------------------------------------------------------

--
-- Table structure for table `news`
--

CREATE TABLE `news` (
  `id` int(11) NOT NULL,
  `user_id` int(11) NOT NULL,
  `cat_id` int(11) NOT NULL,
  `image` text NOT NULL,
  `title` text NOT NULL,
  `content` longtext NOT NULL,
  `link` text NOT NULL,
  `news_date` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP,
  `copywrite` text NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Dumping data for table `news`
--

INSERT INTO `news` (`id`, `user_id`, `cat_id`, `image`, `title`, `content`, `link`, `news_date`, `copywrite`) VALUES
(11, 0, 2, 'uploads/news/2019-02-08-17-54-59.png', '2017 Market Performance: ', 'Sed ut perspiciatis unde omnis iste natus error sit voluptatem accusantium doloremque laudantium, totam rem aperiam, eaque ipsa quae ab illo inventore.', '#', '2019-02-08 16:54:59', ' Olivia Capzallo'),
(12, 0, 2, 'uploads/news/2019-02-08-17-55-24.png', '2017 Market Performance: ', 'Sed ut perspiciatis unde omnis iste natus error sit voluptatem accusantium doloremque laudantium, totam rem aperiam, eaque ipsa quae ab illo inventore.', '#', '2019-02-08 16:55:24', ' Olivia Capzallo'),
(13, 0, 2, 'uploads/news/2019-02-08-17-55-34.png', '2017 Market Performance: ', 'Sed ut perspiciatis unde omnis iste natus error sit voluptatem accusantium doloremque laudantium, totam rem aperiam, eaque ipsa quae ab illo inventore.', '#', '2019-02-08 16:55:34', ' Olivia Capzallo'),
(14, 0, 6, 'uploads/news/2019-02-08-17-55-48.png', '2017 Market Performance: ', 'Sed ut perspiciatis unde omnis iste natus error sit voluptatem accusantium doloremque laudantium, totam rem aperiam, eaque ipsa quae ab illo inventore.', '#', '2019-02-08 16:55:48', ' Olivia Capzallo'),
(15, 0, 2, 'uploads/news/2019-02-08-17-55-56.png', '2017 Market Performance: ', 'Sed ut perspiciatis unde omnis iste natus error sit voluptatem accusantium doloremque laudantium, totam rem aperiam, eaque ipsa quae ab illo inventore.', '#', '2019-02-08 16:55:56', ' Olivia Capzallo'),
(16, 0, 8, 'uploads/news/2019-02-08-17-56-06.png', '2017 Market Performance: ', 'Sed ut perspiciatis unde omnis iste natus error sit voluptatem accusantium doloremque laudantium, totam rem aperiam, eaque ipsa quae ab illo inventore.', '#', '2019-02-08 16:56:06', ' Olivia Capzallo'),
(17, 0, 7, 'uploads/news/2019-02-08-17-56-25.png', '2017 Market Performance: ', 'Sed ut perspiciatis unde omnis iste natus error sit voluptatem accusantium doloremque laudantium, totam rem aperiam, eaque ipsa quae ab illo inventore.', '#', '2019-02-08 16:56:25', ' Olivia Capzallo'),
(18, 0, 7, 'uploads/news/2019-02-08-17-56-36.png', '2017 Market Performance: ', 'Sed ut perspiciatis unde omnis iste natus error sit voluptatem accusantium doloremque laudantium, totam rem aperiam, eaque ipsa quae ab illo inventore.', '#', '2019-02-08 16:56:36', ' Olivia Capzallo'),
(19, 0, 8, 'uploads/news/2019-02-08-17-56-49.png', '2017 Market Performance: ', 'Sed ut perspiciatis unde omnis iste natus error sit voluptatem accusantium doloremque laudantium, totam rem aperiam, eaque ipsa quae ab illo inventore.', '#', '2019-02-08 16:56:49', ' Olivia Capzallo'),
(20, 0, 7, 'uploads/news/2019-02-08-18-04-37.png', 'New Title of News', 'asdasd asd asdas das da sda asdasd asd asdas das da sdaasdasd asd asdas das da sdaasdasd asd asdas das da sdaasdasd asd asdas das da sda', 'https://google.com', '2019-02-08 17:04:37', ' Olivia Capzallo');

-- --------------------------------------------------------

--
-- Table structure for table `news_comments`
--

CREATE TABLE `news_comments` (
  `id` int(11) NOT NULL,
  `news_id` int(11) NOT NULL,
  `user_id` int(11) NOT NULL,
  `comment` longtext NOT NULL,
  `at_date` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Dumping data for table `news_comments`
--

INSERT INTO `news_comments` (`id`, `news_id`, `user_id`, `comment`, `at_date`) VALUES
(1, 20, 4, 'comment.....', '2019-02-10 22:00:00'),
(2, 20, 5, 'comment tany', '2019-02-10 22:00:00'),
(3, 20, 3, 'tes ttestset', '2019-02-10 22:00:00'),
(9, 20, 6, 'asdas', '2019-02-11 17:38:13'),
(10, 20, 6, 'asd', '2019-02-11 17:39:00'),
(11, 20, 6, 'asdas', '2019-02-11 17:39:16'),
(12, 20, 6, 'aasd', '2019-02-11 17:40:16'),
(13, 20, 6, 'test commmmmmm', '2019-02-11 17:41:05'),
(14, 20, 6, 'new comment', '2019-02-11 17:43:52'),
(15, 20, 6, 'masdnamasdsa', '2019-02-11 17:44:19'),
(16, 20, 6, 'new comm', '2019-02-11 17:44:52'),
(17, 11, 6, 'first comment', '2019-02-11 17:45:35'),
(18, 11, 6, 'new comment', '2019-02-11 17:48:10'),
(19, 11, 6, 'test 2', '2019-02-11 17:50:06'),
(20, 11, 6, 'new comment 3', '2019-02-11 17:50:40'),
(21, 11, 6, 'test comment 4', '2019-02-11 17:51:09'),
(22, 11, 6, 'asdasdsa', '2019-02-11 17:51:16'),
(23, 11, 6, 'asdasd', '2019-02-11 17:51:33'),
(24, 11, 6, '12312312', '2019-02-11 17:51:40'),
(25, 11, 6, 'asdasdsadas', '2019-02-11 17:52:39'),
(26, 11, 6, 'comment num 10', '2019-02-11 17:53:37'),
(27, 11, 6, 'comment 11', '2019-02-11 17:54:41'),
(28, 11, 6, 'asdasdasd', '2019-02-11 17:55:21'),
(29, 13, 6, 'asdasd', '2019-02-11 17:55:31'),
(30, 13, 6, 'dasd', '2019-02-11 17:55:35'),
(31, 13, 6, 'mashasmasdas', '2019-02-11 17:56:07'),
(32, 13, 6, 'asdasdasd', '2019-02-11 17:57:22'),
(33, 13, 6, 'asdasd', '2019-02-11 18:02:14'),
(35, 19, 6, 'asdasd', '2019-02-11 18:45:17'),
(37, 20, 6, 'asd', '2019-02-11 19:06:47'),
(38, 20, 6, 'alert(\'xx\')', '2019-02-11 19:21:26');

-- --------------------------------------------------------

--
-- Table structure for table `news_view`
--

CREATE TABLE `news_view` (
  `id` int(11) NOT NULL,
  `news_id` int(11) NOT NULL,
  `ip_address` varchar(50) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Dumping data for table `news_view`
--

INSERT INTO `news_view` (`id`, `news_id`, `ip_address`) VALUES
(14, 11, '::1'),
(13, 12, '::1'),
(68, 13, '::1'),
(9, 14, '::1'),
(73, 16, '::1'),
(114, 18, '::1'),
(12, 19, '::1'),
(6, 20, '192.188.13.1'),
(7, 20, '198.2.2.1'),
(1, 20, '::1');

-- --------------------------------------------------------

--
-- Table structure for table `users`
--

CREATE TABLE `users` (
  `id` int(11) NOT NULL,
  `name` text NOT NULL,
  `image` text NOT NULL,
  `email` varchar(100) NOT NULL,
  `password` text NOT NULL,
  `user_type` int(1) NOT NULL DEFAULT '0',
  `user_date` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP,
  `activation_key` text,
  `active` tinyint(1) NOT NULL DEFAULT '0'
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Dumping data for table `users`
--

INSERT INTO `users` (`id`, `name`, `image`, `email`, `password`, `user_type`, `user_date`, `activation_key`, `active`) VALUES
(3, 'Ahmed', 'uploads/avatar.jpg', 'ahmed@gmail.com', '7c4a8d09ca3762af61e59520943dc26494f8941b', 0, '2019-02-04 16:43:04', NULL, 1),
(4, 'Omar Hassan', 'uploads/profiles/2019-02-04-20-15-18.png', 'omar@gmail.com', '73da7bb9d2a475bbc2ab79da7d4e94940cb9f9d5', 0, '2019-02-04 17:53:17', NULL, 1),
(5, 'Admin', 'uploads/avatar.jpg', 'admin@admin.com', '7c4a8d09ca3762af61e59520943dc26494f8941b', 1, '2019-02-08 16:49:50', NULL, 1),
(6, 'Ali', 'uploads/profiles/2019-02-11-18-45-11.png', 'ali2@ali.com', '601f1889667efaebb33b8c12572835da3f027f78', 0, '2019-02-11 17:08:01', NULL, 1);

--
-- Indexes for dumped tables
--

--
-- Indexes for table `ads`
--
ALTER TABLE `ads`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `categories`
--
ALTER TABLE `categories`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `contact_us`
--
ALTER TABLE `contact_us`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `news`
--
ALTER TABLE `news`
  ADD PRIMARY KEY (`id`),
  ADD KEY `cat_id` (`cat_id`);

--
-- Indexes for table `news_comments`
--
ALTER TABLE `news_comments`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `news_view`
--
ALTER TABLE `news_view`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `news_id` (`news_id`,`ip_address`);

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
-- AUTO_INCREMENT for table `ads`
--
ALTER TABLE `ads`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `categories`
--
ALTER TABLE `categories`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=12;

--
-- AUTO_INCREMENT for table `contact_us`
--
ALTER TABLE `contact_us`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=5;

--
-- AUTO_INCREMENT for table `news`
--
ALTER TABLE `news`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=21;

--
-- AUTO_INCREMENT for table `news_comments`
--
ALTER TABLE `news_comments`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=39;

--
-- AUTO_INCREMENT for table `news_view`
--
ALTER TABLE `news_view`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=115;

--
-- AUTO_INCREMENT for table `users`
--
ALTER TABLE `users`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=7;

--
-- Constraints for dumped tables
--

--
-- Constraints for table `news`
--
ALTER TABLE `news`
  ADD CONSTRAINT `news_ibfk_1` FOREIGN KEY (`cat_id`) REFERENCES `categories` (`id`);

--
-- Constraints for table `news_view`
--
ALTER TABLE `news_view`
  ADD CONSTRAINT `news_view_ibfk_1` FOREIGN KEY (`news_id`) REFERENCES `news` (`id`);

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
