-- phpMyAdmin SQL Dump
-- version 4.8.4
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Generation Time: Jun 07, 2019 at 05:41 AM
-- Server version: 10.1.37-MariaDB
-- PHP Version: 5.6.40

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
SET AUTOCOMMIT = 0;
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `hasitube`
--

-- --------------------------------------------------------

--
-- Table structure for table `categories`
--

CREATE TABLE `categories` (
  `id` int(11) NOT NULL,
  `name` varchar(50) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `categories`
--

INSERT INTO `categories` (`id`, `name`) VALUES
(1, 'Films & Animation'),
(2, 'Autos & Vehicles'),
(3, 'Music'),
(4, 'Pets & Animals'),
(5, 'Sports'),
(6, 'Travel & Events'),
(7, 'Gaming'),
(8, 'People & Blogs'),
(9, 'Comedy'),
(10, 'Entertainment'),
(11, 'News and Politics'),
(12, 'Howto & Style'),
(13, 'Education'),
(14, 'Sciene & Technology'),
(15, 'Nonprofit & Activism');

-- --------------------------------------------------------

--
-- Table structure for table `comments`
--

CREATE TABLE `comments` (
  `id` int(11) NOT NULL,
  `postedBy` varchar(50) NOT NULL,
  `videoId` int(11) NOT NULL,
  `responseTo` int(11) NOT NULL,
  `body` text NOT NULL,
  `datePosted` datetime NOT NULL DEFAULT CURRENT_TIMESTAMP
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `comments`
--

INSERT INTO `comments` (`id`, `postedBy`, `videoId`, `responseTo`, `body`, `datePosted`) VALUES
(1, 'Hasitha', 4, 0, 'asasas', '2019-05-28 20:11:39'),
(2, 'Hasitha', 4, 0, 'This is very helpful', '2019-05-28 20:50:03'),
(3, 'Hasitha', 4, 0, 'This is very Helpful', '2019-05-28 20:51:57'),
(4, 'Hasitha', 4, 0, 'Nice Video', '2019-05-28 20:56:57'),
(5, 'Hasitha', 4, 0, 'test', '2019-05-28 21:05:43'),
(6, 'Hasitha', 5, 0, 'asas', '2019-05-28 21:09:15'),
(7, 'Hasitha', 5, 0, 'asas', '2019-05-28 21:09:48'),
(8, 'Hasitha', 5, 0, 'asas', '2019-05-28 21:17:33'),
(9, 'Hasitha', 5, 0, 'asas', '2019-05-28 21:18:41'),
(10, 'Hasitha', 5, 0, 'likes', '2019-05-28 21:31:31'),
(11, 'Hasitha', 4, 0, 'asas', '2019-05-28 21:39:16'),
(12, 'Hasitha', 4, 0, 'asas', '2019-05-28 21:39:39'),
(13, 'Hasitha', 4, 0, 'Hasi', '2019-05-31 10:22:05'),
(14, 'Hasitha', 4, 0, 'Hasi', '2019-05-31 10:51:53'),
(15, 'Hasitha', 4, 0, 'as', '2019-05-31 10:54:51'),
(16, 'Hasitha', 4, 0, 'asas', '2019-05-31 10:55:06'),
(17, 'Hasitha', 4, 0, 'as', '2019-05-31 10:55:33'),
(18, 'Hasitha', 4, 0, 'as', '2019-05-31 10:56:37'),
(19, 'Hasitha', 4, 0, 'asasas', '2019-05-31 10:57:50'),
(20, 'Hasitha', 4, 0, 'Hasi\n', '2019-05-31 10:59:25'),
(21, 'Hasitha', 4, 0, 'asasasas', '2019-05-31 11:05:17'),
(22, 'Hasitha', 4, 0, 'asas', '2019-05-31 11:05:54'),
(23, 'Hasitha', 4, 0, 'as', '2019-05-31 11:40:41'),
(24, 'Hasitha', 4, 0, 'asasas', '2019-05-31 11:41:16'),
(25, 'Hasitha', 4, 0, 'asasa', '2019-05-31 11:42:01'),
(26, 'Hasitha', 4, 0, 'asasas', '2019-05-31 11:42:47'),
(27, 'Hasitha', 4, 0, 'hasi', '2019-05-31 13:28:30'),
(28, 'Hasitha', 4, 0, 'asas', '2019-05-31 13:30:43'),
(29, 'Hasitha', 4, 0, 'asas', '2019-05-31 13:42:35'),
(30, 'Hasitha', 4, 0, 'asas', '2019-05-31 13:55:27'),
(31, 'Hasitha', 4, 0, 'as', '2019-05-31 13:56:16'),
(32, 'Hasitha', 4, 0, 'asas', '2019-05-31 14:04:33'),
(33, 'Hasitha', 4, 0, 'asas', '2019-05-31 14:07:46'),
(34, 'Hasitha', 4, 0, 'asasas', '2019-05-31 14:31:08'),
(35, 'Hasitha', 4, 0, 'as', '2019-05-31 14:36:18'),
(36, 'Hasitha', 4, 0, 'as', '2019-05-31 14:36:33'),
(37, 'Hasitha', 4, 0, 'as', '2019-05-31 14:48:48'),
(38, 'Hasitha', 4, 0, 'as', '2019-05-31 14:49:52'),
(39, 'Hasitha', 4, 0, 'as', '2019-05-31 14:54:28'),
(40, 'Hasitha', 4, 0, 'as', '2019-05-31 14:55:12'),
(41, 'Hasitha', 4, 0, 'as', '2019-05-31 15:00:49'),
(42, 'Hasitha', 4, 0, 'as', '2019-05-31 15:01:33'),
(43, 'Hasitha', 4, 0, 'as', '2019-05-31 15:01:51'),
(44, 'Hasitha', 4, 0, 'asa', '2019-05-31 15:04:01'),
(45, 'Hasitha', 4, 0, 'as', '2019-05-31 15:07:26'),
(46, 'Hasitha', 4, 0, 'as', '2019-05-31 15:08:04'),
(47, 'Hasitha', 4, 0, 'as', '2019-05-31 15:08:23'),
(48, 'Hasitha', 4, 0, 'as', '2019-05-31 15:09:47'),
(49, 'Hasitha', 4, 0, 'as', '2019-05-31 15:11:40'),
(50, 'Hasitha', 4, 0, 'as', '2019-05-31 15:14:07'),
(51, 'Hasitha', 4, 0, 'asasas', '2019-05-31 15:19:57'),
(52, 'Hasitha', 4, 0, 'as', '2019-05-31 15:21:07'),
(53, 'Hasitha', 4, 0, 'asas', '2019-05-31 15:25:59'),
(54, 'Hasitha', 4, 0, 'asas', '2019-05-31 15:26:27'),
(55, 'Hasitha', 4, 0, 'as', '2019-05-31 15:26:40'),
(56, 'Hasitha', 4, 0, 'asas', '2019-05-31 15:27:05'),
(57, 'Hasitha', 4, 0, 'as', '2019-05-31 15:27:19'),
(58, 'Hasitha', 4, 0, 'as', '2019-05-31 15:27:36'),
(59, 'Hasitha', 4, 0, 'asas', '2019-05-31 15:28:23'),
(60, 'Hasitha', 4, 0, 'asas', '2019-05-31 15:29:05'),
(61, 'Hasitha', 4, 0, 'as', '2019-05-31 15:29:20'),
(62, 'Hasitha', 4, 0, 'asas', '2019-05-31 15:29:42'),
(63, 'Hasitha', 4, 0, 'as', '2019-05-31 15:30:17'),
(64, 'Hasitha', 4, 0, 'as', '2019-05-31 15:33:03'),
(65, 'Hasitha', 4, 0, 'asas', '2019-05-31 15:33:38'),
(66, 'Hasitha', 4, 0, 'asas', '2019-05-31 15:34:38'),
(67, 'Hasitha', 4, 0, 'as', '2019-05-31 15:38:53'),
(68, 'Hasitha', 4, 0, 'as', '2019-05-31 15:39:10'),
(69, 'Hasitha', 4, 0, 'asas', '2019-05-31 15:39:38'),
(70, 'Hasitha', 4, 0, 'asas', '2019-05-31 15:41:07'),
(71, 'Hasitha', 4, 0, 'asas', '2019-05-31 15:42:10'),
(72, 'Hasitha', 4, 0, 'as', '2019-05-31 15:42:35'),
(73, 'Hasitha', 4, 0, 'as', '2019-05-31 15:42:55'),
(74, 'Hasitha', 4, 0, 'as', '2019-05-31 15:43:55'),
(75, 'Hasitha', 4, 0, 'as', '2019-05-31 15:44:16'),
(76, 'Hasitha', 4, 0, 'gj', '2019-05-31 15:47:41'),
(77, 'Hasitha', 4, 0, 'jk', '2019-05-31 15:48:13'),
(78, 'Hasitha', 4, 0, 'k', '2019-05-31 15:48:33'),
(79, 'Hasitha', 4, 0, 'jio\n', '2019-05-31 15:48:51'),
(80, 'Hasitha', 4, 0, 'as', '2019-05-31 15:50:31'),
(81, 'Hasitha', 4, 0, 'as', '2019-05-31 15:50:49'),
(82, 'Hasitha', 4, 0, 'as', '2019-05-31 15:51:07'),
(83, 'Hasitha', 4, 0, 'as', '2019-05-31 15:51:18'),
(84, 'Hasitha', 4, 0, 'as', '2019-05-31 15:51:29'),
(85, 'Hasitha', 4, 84, 'as', '2019-05-31 15:51:32'),
(86, 'Hasitha', 4, 85, 'asas', '2019-05-31 15:51:38'),
(87, 'Hasitha', 4, 0, 'as', '2019-05-31 15:52:48'),
(88, 'Hasitha', 4, 0, 'as', '2019-05-31 17:58:19'),
(89, 'Hasitha', 4, 0, 'as', '2019-05-31 18:08:00'),
(90, 'Hasitha', 4, 0, 'as', '2019-05-31 18:08:35'),
(91, 'Hasitha', 5, 0, 'Hasi', '2019-05-31 18:36:19'),
(92, 'Hasitha', 4, 0, 'as', '2019-05-31 18:57:06'),
(93, 'Hasitha', 4, 0, 'as', '2019-05-31 18:57:17'),
(94, 'Hasitha', 4, 0, 'as', '2019-05-31 18:57:44'),
(95, 'Hasitha', 4, 0, 'qwqw', '2019-05-31 18:59:13'),
(96, 'Hasitha', 4, 0, 'Aa', '2019-05-31 19:09:56'),
(97, 'Hasitha', 4, 0, 'asas', '2019-05-31 19:10:24'),
(98, 'Hasitha', 4, 0, 'as', '2019-05-31 19:11:20'),
(99, 'Hasitha', 4, 0, 'as', '2019-05-31 19:12:30'),
(100, 'Hasitha', 4, 0, 'as', '2019-05-31 19:12:41'),
(101, 'Hasitha', 4, 0, 'as', '2019-05-31 19:14:38'),
(102, 'Hasitha', 4, 0, 'as', '2019-05-31 19:16:18'),
(103, 'Hasitha', 4, 0, 'as', '2019-05-31 19:17:54'),
(104, 'Hasitha', 4, 0, 'as', '2019-05-31 19:20:54'),
(105, 'Hasitha', 4, 0, 'as', '2019-05-31 19:24:02'),
(106, 'Hasitha', 4, 0, 'sd', '2019-05-31 19:26:42'),
(107, 'Hasitha', 4, 0, 'as', '2019-05-31 19:28:56'),
(108, 'Hasitha', 4, 0, 'as', '2019-05-31 19:33:25'),
(109, 'Hasitha', 4, 107, 'hasi', '2019-05-31 21:09:26'),
(110, 'Hasitha', 4, 109, 'as', '2019-05-31 21:34:18'),
(111, 'Hasitha', 4, 107, 'asas', '2019-05-31 21:34:40'),
(112, 'Hasitha', 4, 110, 'as', '2019-05-31 21:39:30'),
(113, 'Hasitha', 11, 0, 'asas', '2019-06-03 08:18:09'),
(114, 'Hasitha', 11, 113, 'asas', '2019-06-03 08:18:13');

-- --------------------------------------------------------

--
-- Table structure for table `dislikes`
--

CREATE TABLE `dislikes` (
  `id` int(11) NOT NULL,
  `username` varchar(50) NOT NULL,
  `commentId` int(11) NOT NULL,
  `videoId` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

-- --------------------------------------------------------

--
-- Table structure for table `likes`
--

CREATE TABLE `likes` (
  `id` int(11) NOT NULL,
  `username` varchar(50) NOT NULL,
  `commentId` int(11) NOT NULL,
  `videoId` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `likes`
--

INSERT INTO `likes` (`id`, `username`, `commentId`, `videoId`) VALUES
(50, 'hasitha56', 0, 1),
(55, 'hasitha56', 0, 2),
(56, 'Tirosha', 0, 4),
(57, 'Amma123', 0, 4),
(60, 'Hasitha', 0, 5),
(62, 'Hasitha', 92, 0),
(63, 'Hasitha', 94, 0),
(64, 'Hasitha', 95, 0),
(65, 'Hasitha', 96, 0),
(66, 'Hasitha', 97, 0),
(67, 'Hasitha', 98, 0),
(68, 'Hasitha', 99, 0),
(69, 'Hasitha', 100, 0),
(70, 'Hasitha', 101, 0),
(71, 'Hasitha', 102, 0),
(72, 'Hasitha', 103, 0),
(73, 'Hasitha', 104, 0),
(74, 'Hasitha', 105, 0),
(75, 'Hasitha', 106, 0),
(76, 'Hasitha', 108, 0),
(78, 'Hasitha', 83, 0),
(79, 'Hasitha', 109, 0),
(80, 'Hasitha', 0, 17);

-- --------------------------------------------------------

--
-- Table structure for table `subscribers`
--

CREATE TABLE `subscribers` (
  `id` int(11) NOT NULL,
  `userTo` varchar(50) NOT NULL,
  `userFrom` varchar(50) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `subscribers`
--

INSERT INTO `subscribers` (`id`, `userTo`, `userFrom`) VALUES
(6, 'Hasitha', 'Tirosha'),
(7, 'Tirosha', 'Amma123'),
(9, 'Hasitha', 'Thilina'),
(16, 'Tirosha', 'Hasitha');

-- --------------------------------------------------------

--
-- Table structure for table `thumbnails`
--

CREATE TABLE `thumbnails` (
  `id` int(11) NOT NULL,
  `videoid` int(11) NOT NULL,
  `filePath` varchar(250) NOT NULL,
  `selected` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `thumbnails`
--

INSERT INTO `thumbnails` (`id`, `videoid`, `filePath`, `selected`) VALUES
(1, 1, 'uploads/videos/thumbnails/1-5ce7e55b5b8f3.jpg', 1),
(2, 1, 'uploads/videos/thumbnails/1-5ce7e55e3b673.jpg', 0),
(3, 1, 'uploads/videos/thumbnails/1-5ce7e5635c373.jpg', 0),
(4, 2, 'uploads/videos/thumbnails/2-5ce7ead0190f5.jpg', 1),
(5, 2, 'uploads/videos/thumbnails/2-5ce7ead2325ad.jpg', 0),
(6, 2, 'uploads/videos/thumbnails/2-5ce7ead6355f1.jpg', 0),
(7, 3, 'uploads/videos/thumbnails/3-5ce95e43beb5e.jpg', 1),
(8, 3, 'uploads/videos/thumbnails/3-5ce95e456ee06.jpg', 0),
(9, 3, 'uploads/videos/thumbnails/3-5ce95e487c9e2.jpg', 0),
(10, 4, 'uploads/videos/thumbnails/4-5cebec239169d.jpg', 1),
(11, 4, 'uploads/videos/thumbnails/4-5cebec25b0d8f.jpg', 0),
(12, 4, 'uploads/videos/thumbnails/4-5cebec29a16eb.jpg', 0),
(13, 5, 'uploads/videos/thumbnails/5-5cec02a20f913.jpg', 1),
(14, 5, 'uploads/videos/thumbnails/5-5cec02a3b0fde.jpg', 0),
(15, 5, 'uploads/videos/thumbnails/5-5cec02a6de0cf.jpg', 0),
(16, 6, 'uploads/videos/thumbnails/6-5cf26dec804ec.jpg', 1),
(17, 6, 'uploads/videos/thumbnails/6-5cf26def17ecf.jpg', 0),
(18, 6, 'uploads/videos/thumbnails/6-5cf26df41af52.jpg', 0),
(19, 7, 'uploads/videos/thumbnails/7-5cf2818833584.jpg', 1),
(20, 7, 'uploads/videos/thumbnails/7-5cf2818a2a100.jpg', 0),
(21, 7, 'uploads/videos/thumbnails/7-5cf2818d5bf55.jpg', 0),
(22, 8, 'uploads/videos/thumbnails/8-5cf281a6ee315.jpg', 1),
(23, 8, 'uploads/videos/thumbnails/8-5cf281a78c0b2.jpg', 0),
(24, 8, 'uploads/videos/thumbnails/8-5cf281a89f74a.jpg', 0),
(25, 10, 'uploads/videos/thumbnails/10-5cf281b1bbcb9.jpg', 0),
(26, 10, 'uploads/videos/thumbnails/10-5cf281b2059c5.jpg', 1),
(27, 10, 'uploads/videos/thumbnails/10-5cf281b25d7ef.jpg', 0),
(28, 11, 'uploads/videos/thumbnails/11-5cf281be66099.jpg', 0),
(29, 11, 'uploads/videos/thumbnails/11-5cf281bed12ec.jpg', 0),
(30, 11, 'uploads/videos/thumbnails/11-5cf281bf7ebb9.jpg', 1),
(31, 12, 'uploads/videos/thumbnails/12-5cf281ca359b5.jpg', 1),
(32, 12, 'uploads/videos/thumbnails/12-5cf281ca91912.jpg', 0),
(33, 12, 'uploads/videos/thumbnails/12-5cf281cb1f810.jpg', 0),
(34, 15, 'uploads/videos/thumbnails/15-5cf283362a36e.jpg', 1),
(35, 15, 'uploads/videos/thumbnails/15-5cf283382cf78.jpg', 0),
(36, 15, 'uploads/videos/thumbnails/15-5cf2833bd8143.jpg', 0),
(37, 17, 'uploads/videos/thumbnails/17-5cf283e0b100f.jpg', 1),
(38, 17, 'uploads/videos/thumbnails/17-5cf283e1b64b7.jpg', 0),
(39, 17, 'uploads/videos/thumbnails/17-5cf283e397e47.jpg', 0),
(40, 18, 'uploads/videos/thumbnails/18-5cf2840947326.jpg', 1),
(41, 18, 'uploads/videos/thumbnails/18-5cf2840a389da.jpg', 0),
(42, 18, 'uploads/videos/thumbnails/18-5cf2840be1564.jpg', 0),
(43, 19, 'uploads/videos/thumbnails/19-5cf9c859a38c1.jpg', 1),
(44, 19, 'uploads/videos/thumbnails/19-5cf9c85d168c6.jpg', 0),
(45, 19, 'uploads/videos/thumbnails/19-5cf9c8638e5d7.jpg', 0);

-- --------------------------------------------------------

--
-- Table structure for table `users`
--

CREATE TABLE `users` (
  `id` int(11) NOT NULL,
  `firstName` varchar(25) NOT NULL,
  `lastName` varchar(25) NOT NULL,
  `username` varchar(25) NOT NULL,
  `email` varchar(100) NOT NULL,
  `password` varchar(255) NOT NULL,
  `signUpDate` datetime NOT NULL DEFAULT CURRENT_TIMESTAMP,
  `profilePic` varchar(255) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `users`
--

INSERT INTO `users` (`id`, `firstName`, `lastName`, `username`, `email`, `password`, `signUpDate`, `profilePic`) VALUES
(8, 'Hasi', 'Chandula', 'Hasitha', 'Hasitha.chadula@gmail.com', '7a43052e626ecf9c3e107967dcf9b245d4f3a49f64565198a5ec59226b3a08e740f8988704e2193db01a1a28b43ce971018f23349d65602ba3d38b2f484ef5cd', '2019-05-27 19:22:53', 'assets/images/icons/profile.png'),
(9, 'Tirosha', 'Kavindi', 'Tirosha', 'tiro@gmail.com', '7a43052e626ecf9c3e107967dcf9b245d4f3a49f64565198a5ec59226b3a08e740f8988704e2193db01a1a28b43ce971018f23349d65602ba3d38b2f484ef5cd', '2019-05-27 20:11:57', 'assets/images/icons/profile.png'),
(10, 'Amma', 'Amma', 'Amma123', 'amma@gmail.com', '7a43052e626ecf9c3e107967dcf9b245d4f3a49f64565198a5ec59226b3a08e740f8988704e2193db01a1a28b43ce971018f23349d65602ba3d38b2f484ef5cd', '2019-05-27 22:55:21', 'assets/images/icons/profile.png'),
(11, 'Thilina', 'Dilshan', 'Thilina', 'thilina@gmail.com', '7a43052e626ecf9c3e107967dcf9b245d4f3a49f64565198a5ec59226b3a08e740f8988704e2193db01a1a28b43ce971018f23349d65602ba3d38b2f484ef5cd', '2019-06-01 20:16:46', 'assets/images/icons/profile.png');

-- --------------------------------------------------------

--
-- Table structure for table `videos`
--

CREATE TABLE `videos` (
  `id` int(11) NOT NULL,
  `uploadedBy` varchar(50) NOT NULL,
  `title` varchar(70) NOT NULL,
  `description` varchar(1000) NOT NULL,
  `privacy` int(11) NOT NULL,
  `filePath` varchar(250) NOT NULL,
  `category` int(11) NOT NULL,
  `uploadDate` datetime NOT NULL DEFAULT CURRENT_TIMESTAMP,
  `views` int(11) NOT NULL,
  `duration` varchar(10) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `videos`
--

INSERT INTO `videos` (`id`, `uploadedBy`, `title`, `description`, `privacy`, `filePath`, `category`, `uploadDate`, `views`, `duration`) VALUES
(4, 'Hasitha', 'Break Tags', 'This will help you to understand about the break Tags', 1, 'uploads/videos/5cebec134fe44.mp4', 13, '2019-05-27 19:24:27', 319, '02:29'),
(5, 'Tirosha', 'Ordered an unorderd Lists', 'Any', 1, 'uploads/videos/5cec029258eae.mp4', 13, '2019-05-27 21:00:26', 62, '04:07'),
(6, 'Hasitha', 'Hasitha', 'as', 0, 'uploads/videos/5cf26dd7ae882.mp4', 1, '2019-06-01 17:51:43', 6, '03:09'),
(7, 'Hasitha', 'Hashika Nidi', 'Hashika', 1, 'uploads/videos/5cf2813a407a7.mp4', 1, '2019-06-01 19:14:26', 4, '01:12'),
(8, 'Hasitha', 'Hasi', 'Hasi', 1, 'uploads/videos/5cf281924702f.mp4', 1, '2019-06-01 19:15:54', 20, '00:25'),
(10, 'Hasitha', 'Chamiya Kanawa', 'Chamiya', 1, 'uploads/videos/5cf281ab19af6.mp4', 1, '2019-06-01 19:16:19', 17, '00:05'),
(11, 'Hasitha', 'Hasika, Wachcha, Ashen', 'Hasika, Wachcha, Ashen Athal', 1, 'uploads/videos/5cf281b2d3a39.mp4', 9, '2019-06-01 19:16:26', 4, '00:12'),
(12, 'Hasitha', 'Dilan Card', 'Dilan', 1, 'uploads/videos/5cf281c06a990.mp4', 1, '2019-06-01 19:16:40', 9, '00:10'),
(15, 'Hasitha', 'Wachcha vs Dilan Mortal Combat', 'Game', 1, 'uploads/videos/5cf282ec41dd7.mp4', 1, '2019-06-01 19:21:40', 5, '00:23'),
(17, 'Hasitha', 'Dilan And Ashen ', 'Dilan, Ashen', 1, 'uploads/videos/5cf283bb3e751.mp4', 9, '2019-06-01 19:25:07', 8, '00:11'),
(18, 'Hasitha', 'Dialn And Chamith BirthDay', 'Dilan, Chamith', 1, 'uploads/videos/5cf283e6141ed.mp4', 1, '2019-06-01 19:25:50', 15, '00:10'),
(19, 'Hasitha', 'Angular', 'Angular', 1, 'uploads/videos/5cf9c8384576a.mp4', 13, '2019-06-07 07:43:12', 2, '04:13');

--
-- Indexes for dumped tables
--

--
-- Indexes for table `categories`
--
ALTER TABLE `categories`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `comments`
--
ALTER TABLE `comments`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `dislikes`
--
ALTER TABLE `dislikes`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `likes`
--
ALTER TABLE `likes`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `subscribers`
--
ALTER TABLE `subscribers`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `thumbnails`
--
ALTER TABLE `thumbnails`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `users`
--
ALTER TABLE `users`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `videos`
--
ALTER TABLE `videos`
  ADD PRIMARY KEY (`id`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `categories`
--
ALTER TABLE `categories`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=16;

--
-- AUTO_INCREMENT for table `comments`
--
ALTER TABLE `comments`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=115;

--
-- AUTO_INCREMENT for table `dislikes`
--
ALTER TABLE `dislikes`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `likes`
--
ALTER TABLE `likes`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=81;

--
-- AUTO_INCREMENT for table `subscribers`
--
ALTER TABLE `subscribers`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=17;

--
-- AUTO_INCREMENT for table `thumbnails`
--
ALTER TABLE `thumbnails`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=46;

--
-- AUTO_INCREMENT for table `users`
--
ALTER TABLE `users`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=12;

--
-- AUTO_INCREMENT for table `videos`
--
ALTER TABLE `videos`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=20;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
