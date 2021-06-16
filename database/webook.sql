-- phpMyAdmin SQL Dump
-- version 4.9.2
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1:3306
-- Generation Time: Jun 16, 2021 at 09:48 PM
-- Server version: 10.4.10-MariaDB
-- PHP Version: 7.3.12

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
SET AUTOCOMMIT = 0;
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `webook`
--

-- --------------------------------------------------------

--
-- Table structure for table `adventure`
--

DROP TABLE IF EXISTS `adventure`;
CREATE TABLE IF NOT EXISTS `adventure` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `picture_id` int(11) NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

-- --------------------------------------------------------

--
-- Table structure for table `articles`
--

DROP TABLE IF EXISTS `articles`;
CREATE TABLE IF NOT EXISTS `articles` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `title` varchar(256) NOT NULL,
  `description` varchar(256) NOT NULL,
  `content` text NOT NULL,
  `language` varchar(256) NOT NULL,
  `category` varchar(256) NOT NULL,
  `date` timestamp NOT NULL DEFAULT current_timestamp() ON UPDATE current_timestamp(),
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=5 DEFAULT CHARSET=utf8;

--
-- Dumping data for table `articles`
--

INSERT INTO `articles` (`id`, `title`, `description`, `content`, `language`, `category`, `date`) VALUES
(4, 'World\'s first wooden satellite to be launched from New Zealand', 'The satellite, designed and built in Finland will orbit at around 500-600 km altitude in a roughly polar Sun-synchronous orbit.', 'The European Space Agency (ESA) has planned to put the world’s first wooden satellite, WISA Woodsat, on Earth’s orbit by the end of this year. The mission of the satellite is to test the applicability of wooden materials like plywood in spacecraft structures and expose it to extreme space conditions, such as heat, cold, vacuum and radiation, for an extended period of time.\r\n\r\nIt will be launched to space by the end of 2021 with a Rocket Lab Electron rocket from the Mahia Peninsula launch complex in New Zealand.\r\n\r\nThe satellite, designed and built in Finland will orbit at around 500-600 km altitude in a roughly polar Sun-synchronous orbit. WISA Woodsat is a 10x10x10 cm nano satellite built up from standardised boxes and surface panels made from plywood, the same material that is found in a hardware store or to make furniture.\r\n\r\nDesigners have placed the wood in a thermal vacuum chamber to keep dry when its in space. They have also added a very thin aluminium oxide layer to minimise vapour coming from the wood and to protect it from erosive effects of atomic oxygen.\r\n\r\nWoodsat’s only non-wooden external parts are corner aluminium rails used for its deployment into space and a metal selfie stick. The selfie stick with its camera can take pictures of the satellite and look how the plywood is behaving.\r\n\r\nIt can show if there is any cracking on the plywood or any colour changing as the wood is expected to be darkened by the ultraviolet radiation of unfiltered sunlight, said Jari Makinen, a Finnish writer and broadcaster who initiated the mission.\r\n\r\n“The good thing here is we have ended up devising a low-cost device that could find all kinds of further uses, both in orbit and down on the ground in test environments,\" said Bruno Bras, materials engineer at ESA.', 'english', 'technology', '2021-06-15 22:45:10');

-- --------------------------------------------------------

--
-- Table structure for table `article_comments`
--

DROP TABLE IF EXISTS `article_comments`;
CREATE TABLE IF NOT EXISTS `article_comments` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `article_id` int(11) NOT NULL,
  `user_id` int(11) NOT NULL,
  `text` varchar(256) NOT NULL,
  `date` timestamp NOT NULL DEFAULT current_timestamp() ON UPDATE current_timestamp(),
  PRIMARY KEY (`id`)
) ENGINE=MyISAM AUTO_INCREMENT=137 DEFAULT CHARSET=utf8;

--
-- Dumping data for table `article_comments`
--

INSERT INTO `article_comments` (`id`, `article_id`, `user_id`, `text`, `date`) VALUES
(130, 3, 1, 'hi', '2021-06-14 21:24:03'),
(135, 3, 1, 'hi', '2021-06-15 10:52:01'),
(132, 3, 3, 'Amazing', '2021-06-14 21:46:34'),
(136, 3, 1, 'jjh', '2021-06-15 10:52:06');

-- --------------------------------------------------------

--
-- Table structure for table `beach`
--

DROP TABLE IF EXISTS `beach`;
CREATE TABLE IF NOT EXISTS `beach` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `picture_id` int(11) NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

-- --------------------------------------------------------

--
-- Table structure for table `chats`
--

DROP TABLE IF EXISTS `chats`;
CREATE TABLE IF NOT EXISTS `chats` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `sender_id` int(11) NOT NULL,
  `receiver_id` int(11) NOT NULL,
  `message` text NOT NULL,
  `date` timestamp NOT NULL DEFAULT current_timestamp() ON UPDATE current_timestamp(),
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=164 DEFAULT CHARSET=utf8;

--
-- Dumping data for table `chats`
--

INSERT INTO `chats` (`id`, `sender_id`, `receiver_id`, `message`, `date`) VALUES
(2, 3, 2, 'Hello', '2021-03-29 17:56:04'),
(3, 3, 2, 'Prince', '2021-03-29 17:58:57'),
(4, 3, 2, 'Chaurasiya', '2021-03-29 18:02:46'),
(5, 3, 2, 'Hi', '2021-03-29 18:44:57'),
(6, 3, 2, 'How are you?', '2021-03-29 18:47:42'),
(7, 3, 1, 'Hello Prince!', '2021-03-29 18:56:03'),
(8, 3, 1, 'How are you?', '2021-03-29 19:03:15'),
(9, 1, 3, 'Yes, Satyam!', '2021-03-29 19:06:03'),
(10, 1, 3, 'I\'m fine!', '2021-03-29 19:06:17'),
(11, 1, 3, 'What about you?', '2021-03-29 19:06:25'),
(12, 3, 1, 'I\'m fine too', '2021-03-29 19:07:55'),
(13, 1, 3, 'Well! That\'s great!', '2021-03-29 19:08:50'),
(14, 1, 3, 'Are you going to college tomorrow?', '2021-03-29 19:09:17'),
(15, 3, 1, 'Naah! I\'m not', '2021-03-29 19:10:23'),
(16, 3, 1, 'It\'s too boring to get there', '2021-03-29 19:10:39'),
(17, 3, 1, 'What about you? Are you going?', '2021-03-29 19:10:58'),
(18, 1, 3, 'Yeah! I\'m considering', '2021-03-29 19:12:20'),
(19, 3, 1, 'Hello', '2021-03-29 19:20:04'),
(20, 3, 1, 'Well then good night', '2021-03-29 19:25:55'),
(21, 3, 1, 'Hi', '2021-03-30 04:20:07'),
(22, 3, 1, 'Where are you? I\'m looking for you.', '2021-03-30 04:58:23'),
(23, 3, 2, 'Sandeep tum kahan pr ho?', '2021-03-30 05:15:46'),
(24, 2, 3, 'Main ghar pr hoon', '2021-03-30 07:47:04'),
(25, 1, 3, 'Aa rha hoon', '2021-03-30 08:44:36'),
(26, 3, 1, 'Jaldi aao', '2021-03-30 09:56:30'),
(27, 1, 3, 'Okay', '2021-03-30 10:02:19'),
(28, 3, 1, 'Good afternoon', '2021-03-31 09:33:08'),
(29, 3, 1, 'Kaise ho', '2021-03-31 09:36:15'),
(30, 3, 1, 'Aao jaldi', '2021-03-31 09:36:32'),
(31, 3, 1, 'Kyaa hua?', '2021-03-31 09:54:15'),
(32, 3, 1, 'Haa', '2021-03-31 10:03:54'),
(33, 3, 1, 'Bolo', '2021-03-31 10:04:01'),
(34, 3, 1, 'Bhai', '2021-03-31 11:14:33'),
(35, 3, 1, 'Bolo bhai', '2021-03-31 11:28:14'),
(36, 3, 1, 'Kahan ho', '2021-03-31 11:28:41'),
(37, 3, 1, 'Kyaa hua', '2021-03-31 11:29:22'),
(38, 3, 1, 'M', '2021-03-31 11:29:42'),
(39, 1, 3, 'Okay', '2021-03-31 15:45:11'),
(40, 1, 3, 'I\'m coming', '2021-03-31 16:29:46'),
(41, 1, 3, 'Aur btaao', '2021-03-31 16:40:49'),
(42, 1, 3, 'Kyaa hua?', '2021-03-31 16:43:11'),
(43, 1, 3, 'Hello', '2021-03-31 16:46:10'),
(44, 1, 3, 'Bolo', '2021-03-31 16:47:53'),
(45, 1, 3, 'Bhai', '2021-03-31 16:51:21'),
(46, 1, 3, 'Sorry', '2021-03-31 16:58:34'),
(47, 1, 3, 'Bye', '2021-03-31 17:00:41'),
(48, 1, 3, 'Hello', '2021-03-31 17:16:02'),
(49, 1, 3, 'Bolo', '2021-03-31 17:16:50'),
(50, 3, 1, 'Hello', '2021-03-31 17:25:13'),
(51, 3, 1, 'Bye', '2021-03-31 17:30:37'),
(52, 3, 1, 'Bye', '2021-03-31 17:30:58'),
(53, 3, 1, 'Hello', '2021-03-31 17:33:11'),
(54, 3, 1, 'Bolo', '2021-03-31 17:36:36'),
(55, 3, 1, 'Bhai', '2021-03-31 17:41:11'),
(56, 3, 1, 'Hi', '2021-03-31 18:40:47'),
(57, 3, 1, 'Nhi', '2021-03-31 18:44:34'),
(58, 1, 3, 'Haa', '2021-04-01 16:36:16'),
(59, 1, 3, '', '2021-04-02 04:45:03'),
(60, 1, 3, 'Hello', '2021-04-02 04:45:11'),
(61, 1, 3, '', '2021-04-02 05:00:43'),
(62, 1, 3, 'Hello', '2021-04-02 05:18:22'),
(63, 1, 3, 'Hi', '2021-04-02 05:33:28'),
(64, 1, 3, 'Hello', '2021-04-02 06:24:21'),
(65, 1, 3, 'Hi', '2021-04-02 06:24:36'),
(66, 1, 3, 'No', '2021-04-02 06:30:39'),
(67, 1, 3, 'Kyaa', '2021-04-02 06:32:01'),
(68, 3, 2, 'Bolo', '2021-04-02 06:35:25'),
(69, 3, 1, 'Kuchh nhi', '2021-04-02 07:02:34'),
(70, 3, 1, 'Yaar', '2021-04-02 07:03:17'),
(71, 3, 1, 'Hi', '2021-04-02 07:22:56'),
(72, 3, 2, 'Haa', '2021-04-02 07:30:45'),
(73, 3, 1, 'Hi', '2021-04-02 07:31:08'),
(74, 3, 1, 'Bolo', '2021-04-02 07:33:26'),
(75, 3, 2, 'Bol', '2021-04-02 07:33:46'),
(76, 3, 1, 'Hi', '2021-04-02 08:01:21'),
(77, 3, 1, 'Hello', '2021-04-02 08:01:51'),
(78, 3, 1, 'Haa', '2021-04-02 08:42:19'),
(79, 3, 1, 'Hi', '2021-04-02 13:23:31'),
(80, 3, 1, 'Kyun', '2021-04-02 13:30:57'),
(81, 3, 1, 'Hi', '2021-04-02 13:32:28'),
(82, 3, 1, 'Bhai', '2021-04-02 13:35:14'),
(83, 3, 1, 'Hi', '2021-04-02 13:36:14'),
(84, 3, 1, 'Hi', '2021-04-02 13:45:28'),
(85, 3, 1, 'Hi', '2021-04-02 14:45:55'),
(86, 3, 1, 'Haa bhai', '2021-04-02 14:49:42'),
(87, 3, 1, 'Hi', '2021-04-02 14:50:48'),
(88, 3, 1, 'Hello', '2021-04-02 14:54:45'),
(89, 3, 1, 'Haa', '2021-04-02 15:31:34'),
(90, 3, 1, 'Hi', '2021-04-02 15:34:57'),
(91, 3, 1, 'Aur btaao kyaa haal hai?', '2021-04-02 17:19:01'),
(92, 2, 1, 'Hi', '2021-04-06 15:44:26'),
(93, 1, 2, 'Hi', '2021-04-06 15:44:38'),
(94, 1, 2, 'Hello', '2021-04-06 15:45:13'),
(95, 1, 3, 'Hi', '2021-05-22 10:41:01'),
(96, 3, 1, 'Hi', '2021-05-22 10:41:20'),
(97, 3, 1, 'Hi', '2021-05-22 10:41:43'),
(98, 3, 1, 'Hello', '2021-05-22 10:42:03'),
(99, 1, 3, 'Bolo', '2021-05-22 10:42:20'),
(100, 3, 1, 'hello', '2021-06-03 19:52:02'),
(101, 1, 3, 'hi', '2021-06-03 19:52:12'),
(102, 1, 3, 'no', '2021-06-03 19:52:37'),
(103, 1, 3, 'hi', '2021-06-03 19:52:48'),
(104, 1, 3, 'hello', '2021-06-03 19:53:01'),
(105, 1, 3, 'hi', '2021-06-03 19:53:23'),
(106, 3, 1, 'do you write', '2021-06-03 19:53:53'),
(107, 3, 1, 'are you', '2021-06-03 19:54:03'),
(108, 1, 3, 'Hi', '2021-06-12 21:38:04'),
(109, 1, 2, 'Hello', '2021-06-14 06:51:28'),
(110, 2, 1, 'Hi', '2021-06-14 06:52:56'),
(111, 2, 1, 'How are you?', '2021-06-14 06:53:09'),
(112, 1, 2, 'I\'m fine', '2021-06-14 06:53:22'),
(113, 1, 2, 'How are you?', '2021-06-14 06:53:35'),
(114, 2, 1, 'I\'m fine too', '2021-06-14 06:53:44'),
(115, 1, 2, 'okay great', '2021-06-14 06:53:50'),
(116, 2, 1, 'I will call you later', '2021-06-14 06:54:11'),
(117, 1, 2, 'wait', '2021-06-14 06:54:19'),
(118, 2, 1, 'Why', '2021-06-14 06:54:25'),
(119, 1, 2, 'i need help', '2021-06-14 06:54:47'),
(120, 2, 1, 'For what', '2021-06-14 06:54:53'),
(121, 1, 2, 'how you been?', '2021-06-14 06:55:12'),
(122, 2, 1, 'I was fine', '2021-06-14 06:55:21'),
(123, 1, 2, 'okay', '2021-06-14 06:55:32'),
(124, 2, 1, 'How can I help you?', '2021-06-14 06:55:50'),
(125, 1, 2, 'are you coming', '2021-06-14 06:56:03'),
(126, 2, 1, 'Where?', '2021-06-14 06:56:13'),
(127, 1, 2, 'kannauj', '2021-06-14 06:57:04'),
(128, 2, 1, 'Okay', '2021-06-14 06:57:09'),
(129, 2, 1, 'I\'m coming', '2021-06-14 06:57:36'),
(130, 1, 2, 'thank you so much buddy', '2021-06-14 06:57:47'),
(131, 1, 2, 'okay', '2021-06-14 06:58:03'),
(132, 1, 2, 'I will tell you', '2021-06-14 06:58:16'),
(133, 1, 2, 'hi', '2021-06-14 06:58:36'),
(134, 1, 2, 'where are you now?', '2021-06-14 06:59:52'),
(135, 2, 1, 'I\'m in sonbhadra', '2021-06-14 07:00:16'),
(136, 1, 2, 'okay', '2021-06-14 07:00:27'),
(137, 1, 2, 'great', '2021-06-14 07:01:25'),
(138, 1, 2, 'i will wait', '2021-06-14 07:01:35'),
(139, 2, 1, 'Okay', '2021-06-14 07:01:41'),
(140, 1, 2, 'you are great', '2021-06-14 07:01:54'),
(141, 1, 2, 'such a nice person', '2021-06-14 07:02:02'),
(142, 2, 1, 'So sweet of you', '2021-06-14 07:03:27'),
(143, 3, 1, 'Hi prince', '2021-06-14 07:06:15'),
(144, 3, 1, 'Kyaa kr rhe ho?', '2021-06-14 07:06:27'),
(145, 1, 3, 'Kuchh nhi', '2021-06-14 07:06:41'),
(146, 3, 1, 'Achcha', '2021-06-14 07:07:55'),
(147, 1, 3, 'to ab kya?', '2021-06-14 07:08:14'),
(148, 1, 3, 'yahan pr aaoge ki nhi?', '2021-06-14 07:08:24'),
(149, 3, 1, 'Kahan pr?', '2021-06-14 07:08:39'),
(150, 1, 3, 'Yaar mera ek kaam tha. Mujhe samajh nhi aa rha ki kya karoon. Main abhi bahut pareshan chal  rha hoon.', '2021-06-14 07:09:41'),
(151, 1, 3, 'theek hai to ab  chalte hain', '2021-06-14 07:10:56'),
(152, 1, 3, 'bye', '2021-06-14 07:11:01'),
(153, 1, 3, 'good night', '2021-06-14 07:11:07'),
(154, 3, 1, 'Okay', '2021-06-14 07:11:17'),
(155, 1, 3, 'take care', '2021-06-14 07:11:27'),
(156, 3, 1, 'Bye', '2021-06-14 07:11:35'),
(157, 1, 3, 'bye', '2021-06-14 07:18:30'),
(158, 1, 3, 'bye', '2021-06-14 07:23:50'),
(159, 3, 1, 'Bye', '2021-06-14 07:25:37'),
(160, 3, 1, 'Hi', '2021-06-14 07:26:48'),
(161, 3, 1, 'Hi', '2021-06-14 17:30:06'),
(162, 3, 1, 'N', '2021-06-14 17:30:13'),
(163, 3, 1, 'P', '2021-06-14 17:30:21');

-- --------------------------------------------------------

--
-- Table structure for table `festival`
--

DROP TABLE IF EXISTS `festival`;
CREATE TABLE IF NOT EXISTS `festival` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `picture_id` int(11) NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=4 DEFAULT CHARSET=utf8;

--
-- Dumping data for table `festival`
--

INSERT INTO `festival` (`id`, `picture_id`) VALUES
(1, 1),
(2, 2),
(3, 3);

-- --------------------------------------------------------

--
-- Table structure for table `friends`
--

DROP TABLE IF EXISTS `friends`;
CREATE TABLE IF NOT EXISTS `friends` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `user_id` int(11) NOT NULL,
  `friend_id` int(11) NOT NULL,
  `date` timestamp NOT NULL DEFAULT current_timestamp() ON UPDATE current_timestamp(),
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=4 DEFAULT CHARSET=utf8;

--
-- Dumping data for table `friends`
--

INSERT INTO `friends` (`id`, `user_id`, `friend_id`, `date`) VALUES
(1, 3, 2, '2021-03-29 11:38:51'),
(2, 3, 1, '2021-03-29 12:50:49'),
(3, 1, 2, '2021-04-06 15:43:23');

-- --------------------------------------------------------

--
-- Table structure for table `friend_requests`
--

DROP TABLE IF EXISTS `friend_requests`;
CREATE TABLE IF NOT EXISTS `friend_requests` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `sender_id` int(11) NOT NULL,
  `receiver_id` int(11) NOT NULL,
  `date` timestamp NOT NULL DEFAULT current_timestamp() ON UPDATE current_timestamp(),
  PRIMARY KEY (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

-- --------------------------------------------------------

--
-- Table structure for table `holy_place`
--

DROP TABLE IF EXISTS `holy_place`;
CREATE TABLE IF NOT EXISTS `holy_place` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `picture_id` int(11) NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=2 DEFAULT CHARSET=utf8;

--
-- Dumping data for table `holy_place`
--

INSERT INTO `holy_place` (`id`, `picture_id`) VALUES
(1, 1);

-- --------------------------------------------------------

--
-- Table structure for table `likes`
--

DROP TABLE IF EXISTS `likes`;
CREATE TABLE IF NOT EXISTS `likes` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `picture_id` int(11) NOT NULL,
  `user_id` int(11) NOT NULL,
  `date` timestamp NOT NULL DEFAULT current_timestamp() ON UPDATE current_timestamp(),
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=6 DEFAULT CHARSET=utf8;

--
-- Dumping data for table `likes`
--

INSERT INTO `likes` (`id`, `picture_id`, `user_id`, `date`) VALUES
(1, 1, 2, '2021-04-06 15:46:05'),
(2, 2, 2, '2021-04-06 15:46:44'),
(3, 1, 3, '2021-06-14 12:47:44'),
(4, 2, 3, '2021-06-14 12:47:49'),
(5, 2, 1, '2021-06-15 05:44:30');

-- --------------------------------------------------------

--
-- Table structure for table `pictures`
--

DROP TABLE IF EXISTS `pictures`;
CREATE TABLE IF NOT EXISTS `pictures` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `name` varchar(255) NOT NULL,
  `user_id` int(11) NOT NULL,
  `date` timestamp NOT NULL DEFAULT current_timestamp() ON UPDATE current_timestamp(),
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=4 DEFAULT CHARSET=utf8;

--
-- Dumping data for table `pictures`
--

INSERT INTO `pictures` (`id`, `name`, `user_id`, `date`) VALUES
(1, '27-03-2021-1616824070.jpg', 1, '2021-03-27 05:47:50'),
(2, '28-03-2021-1616960376.jpg', 2, '2021-03-28 19:39:36'),
(3, '28-03-2021-1616960904.jpg', 3, '2021-03-28 19:48:24');

-- --------------------------------------------------------

--
-- Table structure for table `picture_comments`
--

DROP TABLE IF EXISTS `picture_comments`;
CREATE TABLE IF NOT EXISTS `picture_comments` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `picture_id` int(11) NOT NULL,
  `user_id` int(11) NOT NULL,
  `text` varchar(256) NOT NULL,
  `date` timestamp NOT NULL DEFAULT current_timestamp() ON UPDATE current_timestamp(),
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=49 DEFAULT CHARSET=utf8;

--
-- Dumping data for table `picture_comments`
--

INSERT INTO `picture_comments` (`id`, `picture_id`, `user_id`, `text`, `date`) VALUES
(12, 2, 3, 'hi', '2021-06-12 13:22:19'),
(23, 1, 1, 'hi', '2021-06-14 06:49:05'),
(24, 3, 1, 'Nice', '2021-06-14 07:33:49'),
(30, 2, 1, 'hello', '2021-06-14 07:58:36'),
(37, 1, 1, 'hello', '2021-06-14 15:18:10'),
(39, 3, 1, 'great', '2021-06-14 15:37:05'),
(40, 3, 1, 'hi', '2021-06-14 16:09:46'),
(41, 1, 3, 'Hello', '2021-06-14 16:32:32'),
(44, 3, 3, 'Hi', '2021-06-14 18:20:06'),
(46, 3, 3, 'There', '2021-06-14 18:20:17'),
(47, 2, 3, 'Hurra', '2021-06-14 21:28:45'),
(48, 2, 3, 'Okay', '2021-06-14 21:28:54');

-- --------------------------------------------------------

--
-- Table structure for table `sport`
--

DROP TABLE IF EXISTS `sport`;
CREATE TABLE IF NOT EXISTS `sport` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `picture_id` int(11) NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

-- --------------------------------------------------------

--
-- Table structure for table `travel`
--

DROP TABLE IF EXISTS `travel`;
CREATE TABLE IF NOT EXISTS `travel` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `picture_id` int(11) NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

-- --------------------------------------------------------

--
-- Table structure for table `users`
--

DROP TABLE IF EXISTS `users`;
CREATE TABLE IF NOT EXISTS `users` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `email_id` varchar(255) NOT NULL,
  `name` varchar(255) NOT NULL,
  `phone` bigint(10) NOT NULL,
  `password` varchar(255) NOT NULL,
  `photo` varchar(255) NOT NULL,
  `registration_time` timestamp NOT NULL DEFAULT current_timestamp() ON UPDATE current_timestamp(),
  `gender` enum('male','female') NOT NULL,
  `dob` date NOT NULL,
  `profession` enum('student','entrepreneur','agriculture','government_employee','private_sector') NOT NULL,
  `address` varchar(255) NOT NULL,
  `fav_question` varchar(256) NOT NULL,
  `answer` varchar(256) NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=4 DEFAULT CHARSET=utf8;

--
-- Dumping data for table `users`
--

INSERT INTO `users` (`id`, `email_id`, `name`, `phone`, `password`, `photo`, `registration_time`, `gender`, `dob`, `profession`, `address`, `fav_question`, `answer`) VALUES
(1, 'princechaurasiya992@gmail.com', 'Prince Chaurasiya', 9044291375, '097860c513eb669a4796daac91af6f49', '23-02-2021-1614110005.jpg', '2021-06-16 13:12:45', 'male', '1998-07-15', 'student', 'Rani Avantibai Nagar, near SIMRAN CINEPLEX, Gandhi Chauraha, Tirwaganj, Kannauj', 'fav_superhero', 'Iron Man'),
(2, 'sandeepprasadgon2017@gmail.com', 'Sandeep Prasad Gond', 6393197243, 'e10adc3949ba59abbe56e057f20f883e', '28-03-2021-1616959918.jpg', '2021-03-28 19:31:58', 'male', '0000-00-00', 'student', '', '', ''),
(3, 'satyamsingh15may@gmail.com', 'Satyam Singh', 8127377702, 'e10adc3949ba59abbe56e057f20f883e', '28-03-2021-1616960732.jpg', '2021-03-28 19:46:24', 'male', '0000-00-00', 'student', '', '', '');

-- --------------------------------------------------------

--
-- Table structure for table `user_ratings`
--

DROP TABLE IF EXISTS `user_ratings`;
CREATE TABLE IF NOT EXISTS `user_ratings` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `article_id` int(11) NOT NULL,
  `user_id` int(11) NOT NULL,
  `star` int(11) NOT NULL,
  `date` timestamp NOT NULL DEFAULT current_timestamp() ON UPDATE current_timestamp(),
  PRIMARY KEY (`id`)
) ENGINE=MyISAM AUTO_INCREMENT=66 DEFAULT CHARSET=utf8;

--
-- Dumping data for table `user_ratings`
--

INSERT INTO `user_ratings` (`id`, `article_id`, `user_id`, `star`, `date`) VALUES
(58, 3, 1, 4, '2021-06-15 22:30:59'),
(64, 3, 3, 5, '2021-06-15 22:33:00'),
(65, 4, 1, 3, '2021-06-15 23:14:11');

-- --------------------------------------------------------

--
-- Table structure for table `zoo`
--

DROP TABLE IF EXISTS `zoo`;
CREATE TABLE IF NOT EXISTS `zoo` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `picture_id` int(11) NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
