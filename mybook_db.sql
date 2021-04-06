-- phpMyAdmin SQL Dump
-- version 5.0.2
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1:3306
-- Generation Time: Jan 24, 2021 at 12:20 PM
-- Server version: 10.4.14-MariaDB
-- PHP Version: 7.4.10

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `mybook_db`
--

-- --------------------------------------------------------

--
-- Table structure for table `likes`
--

CREATE TABLE `likes` (
  `id` bigint(20) NOT NULL,
  `type` varchar(10) NOT NULL,
  `contentid` bigint(20) NOT NULL,
  `likes` text NOT NULL,
  `following` text NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `likes`
--

INSERT INTO `likes` (`id`, `type`, `contentid`, `likes`, `following`) VALUES
(1, 'user', 71553256270745688, '[{\"userid\":\"82130014235811\",\"date\":\"2021-01-22 09:35:56\"}]', '[{\"userid\":\"9070161575806\",\"date\":\"2021-01-22 21:06:21\"}]'),
(2, 'user', 82130014235811, '[]', '{\"1\":{\"userid\":\"6960251469\",\"date\":\"2021-01-24 01:59:14\"}}'),
(3, 'user', 9070161575806, '[{\"userid\":\"71553256270745688\",\"date\":\"2021-01-22 21:06:21\"}]', ''),
(4, 'post', 89634114, '[]', ''),
(5, 'post', 7685982, '[]', ''),
(6, 'post', 126, '[]', ''),
(7, 'post', 7297633666709122471, '[{\"userid\":\"82130014235811\",\"date\":\"2021-01-22 22:50:45\"}]', ''),
(8, 'user', 61112, '[]', ''),
(9, 'user', 6960251469, '[]', '');

-- --------------------------------------------------------

--
-- Table structure for table `posts`
--

CREATE TABLE `posts` (
  `id` bigint(19) NOT NULL,
  `postid` bigint(19) NOT NULL,
  `userid` bigint(19) NOT NULL,
  `post` text NOT NULL,
  `image` varchar(500) NOT NULL,
  `comments` int(11) NOT NULL,
  `likes` int(11) NOT NULL,
  `date` timestamp NOT NULL DEFAULT current_timestamp() ON UPDATE current_timestamp(),
  `has_image` tinyint(1) NOT NULL,
  `is_profile_image` tinyint(1) NOT NULL,
  `is_cover_image` tinyint(1) NOT NULL,
  `parent` bigint(20) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `posts`
--

INSERT INTO `posts` (`id`, `postid`, `userid`, `post`, `image`, `comments`, `likes`, `date`, `has_image`, `is_profile_image`, `is_cover_image`, `parent`) VALUES
(1, 7297633666709122471, 82130014235811, '', 'uploads/82130014235811/xa52071v09tecbs.jpg', 0, 1, '2021-01-22 21:50:45', 1, 0, 1, 0),
(3, 1762626615786, 3959056, '', 'uploads/3959056/b9vnaueffevpdz1.jpg', 0, 0, '2021-01-21 18:31:13', 1, 0, 1, 0),
(4, 4068, 3959056, '', 'uploads/3959056/jszvcuharf108m0.jpg', 0, 0, '2021-01-21 18:31:18', 1, 1, 0, 0),
(5, 200724808669500420, 3959056, 'some post with picture', 'uploads/3959056/hcvdnkcpcyx87p7.jpg', 0, 0, '2021-01-21 18:30:54', 1, 0, 0, 0),
(6, 520429955492387776, 71553256270745688, '', 'uploads/71553256270745688/bgao5ebl6twusz6.jpg', 0, 0, '2021-01-21 18:31:05', 1, 1, 0, 0),
(7, 1494, 71553256270745688, '', 'uploads/71553256270745688/1phrmbv9ml93tvn.jpg', 0, 0, '2021-01-21 18:31:09', 1, 0, 1, 0),
(8, 605489411021179, 9070161575806, '', 'uploads/9070161575806/cdbm4qc9ntp2t9n.jpg', 0, 0, '2021-01-21 01:32:49', 1, 1, 0, 0),
(9, 53174319, 9070161575806, '', 'uploads/9070161575806/lekr1oajqzr2296.jpg', 0, 0, '2021-01-21 01:33:05', 1, 0, 1, 0),
(10, 8390236344721, 61112, '', 'uploads/61112/19dqn9x34igwvch.jpg', 0, 0, '2021-01-21 01:34:59', 1, 1, 0, 0),
(11, 671974996877428, 61112, '', 'uploads/61112/up3kcr7mgf7lftl.jpg', 0, 0, '2021-01-21 01:35:13', 1, 0, 1, 0),
(12, 74355329372, 8895902653818759816, '', 'uploads/8895902653818759816/kqewioj6fvoep5f.jpg', 0, 0, '2021-01-21 01:36:41', 1, 1, 0, 0),
(16, 5328622978, 9223372036854775807, 'hello  i am really happy with my project haha', '', 0, 0, '2021-01-21 01:45:42', 0, 0, 0, 0),
(26, 616049405, 82130014235811, 'this is my first post in time line from index.php', 'uploads/82130014235811/p8yd9pazgb3cuuz.jpg', 0, 0, '2021-01-21 22:55:43', 1, 0, 0, 0),
(32, 126, 82130014235811, 'nice pic', 'uploads/82130014235811/n9mnikh0oqmrmzy.jpg', 0, 0, '2021-01-23 00:14:49', 1, 0, 0, 0),
(91, 763043428592779, 6960251469, '', 'uploads/6960251469/9bjsg1xmj69mkck.jpg', 0, 0, '2021-01-23 20:02:45', 1, 1, 0, 0),
(92, 539860483614, 6960251469, '', 'uploads/6960251469/91vs4v5gl1rag1r.jpg', 0, 0, '2021-01-23 20:03:11', 1, 0, 1, 0),
(97, 65480240117295190, 8895902653818759816, '', 'uploads/8895902653818759816/b9igmw9mlmgjew9.jpg', 0, 0, '2021-01-24 10:09:26', 1, 1, 0, 0),
(98, 664495130724, 8895902653818759816, '', 'uploads/8895902653818759816/8cqc933pb8nm222.jpg', 0, 0, '2021-01-24 10:10:30', 1, 0, 1, 0);

-- --------------------------------------------------------

--
-- Table structure for table `tbl_messages`
--

CREATE TABLE `tbl_messages` (
  `id` bigint(20) NOT NULL,
  `from_userid` varchar(50) NOT NULL,
  `to_userid` varchar(50) NOT NULL,
  `message_text` text NOT NULL,
  `sent_dt` datetime NOT NULL,
  `read_status` tinyint(4) NOT NULL DEFAULT 0
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `tbl_messages`
--

INSERT INTO `tbl_messages` (`id`, `from_userid`, `to_userid`, `message_text`, `sent_dt`, `read_status`) VALUES
(1, '82130014235811', '8895902653818759816', 'rkaigfeb gergreg ergfe', '2021-01-23 06:24:03', 1),
(2, '8895902653818759816', '71553256270745688', 'apu kemon achen', '2021-01-23 06:51:59', 0),
(3, '8895902653818759816', '', '', '2021-01-23 07:05:43', 0),
(4, '8895902653818759816', '', '', '2021-01-23 07:08:44', 0),
(5, '8895902653818759816', '82130014235811', '', '2021-01-23 07:10:47', 1),
(6, '8895902653818759816', '3959056', 'fdgreerb ', '2021-01-23 07:11:45', 0),
(7, '8895902653818759816', '3959056', 'ragte', '2021-01-23 07:17:37', 0),
(8, '8895902653818759816', '61112', 'helllo bro', '2021-01-23 07:20:40', 1),
(9, '8895902653818759816', '3959056', 'reergrg', '2021-01-23 07:21:57', 0),
(10, '8895902653818759816', '3959056', 'reergrg', '2021-01-23 07:27:07', 0),
(11, '8895902653818759816', '3959056', 'reergrg', '2021-01-23 07:27:36', 0);

-- --------------------------------------------------------

--
-- Table structure for table `users`
--

CREATE TABLE `users` (
  `id` bigint(19) NOT NULL,
  `userid` bigint(19) NOT NULL,
  `first_name` varchar(50) NOT NULL,
  `last_name` varchar(50) NOT NULL,
  `gender` varchar(6) NOT NULL,
  `email` varchar(100) NOT NULL,
  `password` varchar(100) NOT NULL,
  `url_address` varchar(100) NOT NULL,
  `date` timestamp NOT NULL DEFAULT current_timestamp() ON UPDATE current_timestamp(),
  `profile_image` varchar(1000) NOT NULL,
  `cover_image` varchar(1000) NOT NULL,
  `likes` int(11) NOT NULL,
  `about` varchar(1000) NOT NULL,
  `is_admin` tinyint(1) NOT NULL DEFAULT 0,
  `user_status` tinyint(4) NOT NULL COMMENT '1=active, 0 = inactive, 2= supended'
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `users`
--

INSERT INTO `users` (`id`, `userid`, `first_name`, `last_name`, `gender`, `email`, `password`, `url_address`, `date`, `profile_image`, `cover_image`, `likes`, `about`, `is_admin`, `user_status`) VALUES
(1, 82130014235811, 'Mr', 'rakib', 'Male', 'rakib@gmail.com', '7110eda4d09e062aa5e4a390b0a572ac0d2c0220', 'mr.rakib', '2021-01-24 11:16:28', 'uploads/82130014235811/ztvtxp5m6i3alv6.jpg', 'uploads/82130014235811/xa52071v09tecbs.jpg', 0, 'i am a student of computer science in austria', 0, 1),
(2, 3959056, 'Mr', 'Mehedi', 'Male', 'mehedi@gmail.com', '7110eda4d09e062aa5e4a390b0a572ac0d2c0220', 'mr.mehedi', '2021-01-24 11:17:44', 'uploads/3959056/jszvcuharf108m0.jpg', 'uploads/3959056/b9vnaueffevpdz1.jpg', 0, '', 0, 0),
(3, 71553256270745688, 'mr', 'humu', 'Female', 'humayra@gmail.com', '7c4a8d09ca3762af61e59520943dc26494f8941b', 'miss.humayra', '2021-01-24 10:58:18', 'uploads/71553256270745688/bgao5ebl6twusz6.jpg', 'uploads/71553256270745688/1phrmbv9ml93tvn.jpg', 1, '', 0, 1),
(4, 9070161575806, 'Miss', 'Simu', 'Female', 'simu@gmail.com', '7110eda4d09e062aa5e4a390b0a572ac0d2c0220', 'miss.simu', '2021-01-24 11:09:53', 'uploads/9070161575806/cdbm4qc9ntp2t9n.jpg', 'uploads/9070161575806/lekr1oajqzr2296.jpg', 1, '', 0, 1),
(5, 61112, 'Mr', 'Abdulla', 'Male', 'abdulla@gmail.com', '7110eda4d09e062aa5e4a390b0a572ac0d2c0220', 'mr.abdulla', '2021-01-24 10:58:48', 'uploads/61112/19dqn9x34igwvch.jpg', 'uploads/61112/up3kcr7mgf7lftl.jpg', 0, '', 0, 1),
(6, 8895902653818759816, 'Mr', 'hasani', 'Male', 'hasani@gmail.com', '7110eda4d09e062aa5e4a390b0a572ac0d2c0220', 'mr.sabbir', '2021-01-24 11:10:28', 'uploads/8895902653818759816/b9igmw9mlmgjew9.jpg', 'uploads/8895902653818759816/8cqc933pb8nm222.jpg', 0, '', 1, 0),
(10, 6960251469, 'Miss', 'Karina', 'Female', 'karina@gmail.com', '8cb2237d0679ca88db6464eac60da96345513964', 'miss.karina', '2021-01-24 10:59:11', 'uploads/6960251469/9bjsg1xmj69mkck.jpg', 'uploads/6960251469/91vs4v5gl1rag1r.jpg', 0, '', 0, 1),
(16, 5808689196025, 'Mr', 'Stevan', 'Male', 'stevan@gmail.com', '7110eda4d09e062aa5e4a390b0a572ac0d2c0220', 'mr.stevan', '2021-01-24 11:19:16', '', '', 0, '', 0, 1);

--
-- Indexes for dumped tables
--

--
-- Indexes for table `likes`
--
ALTER TABLE `likes`
  ADD PRIMARY KEY (`id`),
  ADD KEY `type` (`type`),
  ADD KEY `contentid` (`contentid`);

--
-- Indexes for table `posts`
--
ALTER TABLE `posts`
  ADD PRIMARY KEY (`id`),
  ADD KEY `postid` (`postid`),
  ADD KEY `userid` (`userid`),
  ADD KEY `comments` (`comments`),
  ADD KEY `likes` (`likes`),
  ADD KEY `date` (`date`),
  ADD KEY `has_image` (`has_image`),
  ADD KEY `is_profile_image` (`is_profile_image`),
  ADD KEY `is_cover_image` (`is_cover_image`),
  ADD KEY `parent` (`parent`);
ALTER TABLE `posts` ADD FULLTEXT KEY `post` (`post`);

--
-- Indexes for table `tbl_messages`
--
ALTER TABLE `tbl_messages`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `users`
--
ALTER TABLE `users`
  ADD PRIMARY KEY (`id`),
  ADD KEY `userid` (`userid`),
  ADD KEY `first_name` (`first_name`),
  ADD KEY `last_name` (`last_name`),
  ADD KEY `gender` (`gender`),
  ADD KEY `email` (`email`),
  ADD KEY `url_address` (`url_address`),
  ADD KEY `date` (`date`),
  ADD KEY `likes` (`likes`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `likes`
--
ALTER TABLE `likes`
  MODIFY `id` bigint(20) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=10;

--
-- AUTO_INCREMENT for table `posts`
--
ALTER TABLE `posts`
  MODIFY `id` bigint(19) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=99;

--
-- AUTO_INCREMENT for table `tbl_messages`
--
ALTER TABLE `tbl_messages`
  MODIFY `id` bigint(20) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=12;

--
-- AUTO_INCREMENT for table `users`
--
ALTER TABLE `users`
  MODIFY `id` bigint(19) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=17;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
