-- phpMyAdmin SQL Dump
-- version 5.2.1
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Generation Time: Apr 10, 2025 at 01:52 PM
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
-- Database: `pixo`
--

-- --------------------------------------------------------

--
-- Table structure for table `community_data`
--

CREATE TABLE `community_data` (
  `id` int(11) NOT NULL,
  `community_name` text CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `banner` varchar(255) NOT NULL,
  `community_logo` varchar(255) NOT NULL,
  `community_bio` text CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `owner_id` int(11) NOT NULL,
  `created_at` varchar(20) NOT NULL
) ENGINE=MyISAM DEFAULT CHARSET=latin1 COLLATE=latin1_swedish_ci;

--
-- Dumping data for table `community_data`
--

INSERT INTO `community_data` (`id`, `community_name`, `banner`, `community_logo`, `community_bio`, `owner_id`, `created_at`) VALUES
(1, 'AI Enthusiasts', '../Uploads/Community-Data/67e2984e1332e.jpg', '../Uploads/Community-Data/67e2984e1352d.jpg', 'A group dedicated to discussions on AI, machine learning, and deep learning', 1, '2025-03-25 12:49:34'),
(2, 'Crypto Investors', '../Uploads/Community-Data/67e2999df3ec1.jpg', '../Uploads/Community-Data/67e2999df4148.jpg', 'A group for discussing cryptocurrency trends, blockchain, and investment tips.', 1, '2025-03-25 12:55:09'),
(3, 'Startup Hub', '../Uploads/Community-Data/67e299cd99013.jpg', '../Uploads/Community-Data/67e299cd99192.jpg', 'A community for aspiring entrepreneurs to discuss business ideas and strategies.', 1, '2025-03-25 12:55:57'),
(4, 'Food Lovers', '../Uploads/Community-Data/67e29c8b44461.jpg', '../Uploads/Community-Data/67e29c8b44673.jpg', 'A community for foodies to share recipes, restaurant reviews, and cooking tips.', 2, '2025-03-25 13:07:39'),
(5, 'Travel Explorers', '../Uploads/Community-Data/67e29cfccd68e.jpg', '../Uploads/Community-Data/67e29cfccd8ea.jpg', 'A place for travelers to share experiences, tips, and must-visit destinations.', 2, '2025-03-25 13:09:32'),
(6, 'Tech Innovators', '../Uploads/Community-Data/67e2a15ae1079.jpg', '../Uploads/Community-Data/67e2a0ebd986a.jpg', 'A community for tech enthusiasts discussing AI, ML, and latest innovations.', 3, '2025-03-25 13:26:19'),
(7, 'Gamer Zone', '../Uploads/Community-Data/67e2a4ad1326a.jpg', '../Uploads/Community-Data/67e2a4ad13501.jpg', 'A gaming community for discussing the latest games, tournaments, and strategies.', 4, '2025-03-25 13:42:21'),
(8, 'Photography Club', '../Uploads/Community-Data/67e2a9cd640dc.jpg', '../Uploads/Community-Data/67e2a9cd65b35.jpg', 'A place for photographers to share their clicks, tips, and camera gear reviews.', 5, '2025-03-25 14:04:13');

-- --------------------------------------------------------

--
-- Table structure for table `discuss`
--

CREATE TABLE `discuss` (
  `id` int(255) NOT NULL,
  `user_id` int(255) NOT NULL,
  `topic_id` int(255) NOT NULL,
  `content` varchar(255) NOT NULL,
  `posted_at` varchar(20) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `discuss`
--

INSERT INTO `discuss` (`id`, `user_id`, `topic_id`, `content`, `posted_at`) VALUES
(1, 3, 4, 'i m also interested in crypto!! can you help me on that???', '2025-03-25 13:15:58'),
(2, 4, 4, 'Any suggestions for crypto site??', '2025-03-25 13:45:58'),
(3, 4, 7, 'Hey I am fresher here any good languages for coding?', '2025-03-25 13:47:19'),
(4, 1, 4, 'yes y&#039;all can join my crypto course \nDm me i&#039;ll send you the link', '2025-03-25 14:28:36'),
(7, 6, 11, 'yaha to ana hi mat', '2025-03-25 14:42:02'),
(8, 8, 11, 'ye sb yaha nahi chalega', '2025-03-25 14:43:39'),
(9, 9, 11, 'Bharat mata Ki Jai', '2025-03-25 14:44:59'),
(10, 9, 11, 'Mera Desh Badal Raha Hai', '2025-03-25 14:45:08'),
(11, 4, 2, 'Can you tell me more details ?', '2025-03-25 18:26:58'),
(16, 5, 6, 'wait a minute , Riya lekin tu kab se non-veg banaane lagi ??', '2025-03-29 11:10:02'),
(17, 4, 6, 'bhai idhar to sukun se jeene de use', '2025-03-29 11:11:17'),
(18, 0, 7, 'learn code language it is useful in real life', '2025-03-30 12:18:24'),
(19, 4, 7, 'yeah thanks but can you tell me which language', '2025-03-30 12:23:42'),
(20, 0, 7, 'Wanna get removed?', '2025-03-30 12:24:14'),
(21, 4, 7, 'What ? What do you mean by remove?', '2025-03-30 12:24:39'),
(22, 0, 7, 'Milte hai connect page ke registration section mai see ya 😎', '2025-03-30 12:25:34');

-- --------------------------------------------------------

--
-- Table structure for table `topic_data`
--

CREATE TABLE `topic_data` (
  `topic_id` int(11) NOT NULL,
  `title` text CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `body` text CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `user_id` int(11) NOT NULL,
  `categories` varchar(255) NOT NULL,
  `community_id` int(11) NOT NULL,
  `created_at` varchar(20) NOT NULL,
  `report` int(11) NOT NULL DEFAULT 0,
  `reported_users` text NOT NULL DEFAULT '0',
  `reason` text NOT NULL DEFAULT '0'
) ENGINE=MyISAM DEFAULT CHARSET=latin1 COLLATE=latin1_swedish_ci;

--
-- Dumping data for table `topic_data`
--

INSERT INTO `topic_data` (`topic_id`, `title`, `body`, `user_id`, `categories`, `community_id`, `created_at`, `report`, `reported_users`, `reason`) VALUES
(1, 'The Future of AI in Business', '<h2>The Future of AI in Business</h2><p>AI is transforming industries by automating tasks and improving decision-making.</p><p>Key Benefits:</p><p>Enhanced Efficiency, Data-Driven Insights, Cost Reduction</p>', 1, 'National', 0, '2025-03-25 12:36:39', 0, '0', '0'),
(2, 'Quantum Computing: The Next Big Thing', '<h2>How Quantum Computers Will Change Our World</h2><p>From cryptography to AI, quantum computing is a game-changer.</p><p>Future Prospects:</p><p>Superfast Calculations, Secure Communication, Drug Discovery<span class=\"ql-cursor\">﻿</span></p><p><br></p>', 2, 'Games', 0, '2025-03-25 12:42:26', 0, '0', '0'),
(3, 'How to Build a Successful Startup', '<h2>Essential Steps for a Startup</h2><p><br></p><p>Starting a business requires dedication, strategy, and innovation.</p><p>Tips for Success:</p><p>Identify Market Needs, Build a Strong Team, Secure Funding...</p>', 1, 'Games', 3, '2025-03-25 12:58:41', 1, '1', '0'),
(4, 'Trump Media Partners with Crypto.com to Launch Digital Asset Products', '<h1><img src=\"../Uploads/Topic-data/67e29b10ee907.jpeg\"></h1><p>Trump Media and Technology Group\'s stock surged 9.4% after announcing a partnership with Crypto.com. The collaboration aims to introduce ETFs and ETPs focused on digital assets under the brand Truth.Fi, targeting various industries, including energy. Crypto.com will provide technological support and cryptocurrency custody services.</p>', 1, '-1', 2, '2025-03-25 13:01:20', 0, '0', '0'),
(5, 'OpenAI Enhances AI Voice Assistant for Smoother Conversations', '<p><img src=\"../Uploads/Topic-data/67e29bb15c523.jpeg\"></p><p><br></p><p>OpenAI has upgraded its Advanced Voice Mode, improving real-time interactions by making responses more natural and reducing interruptions. This update aims to enhance AI-powered voice assistants\' usability in everyday conversations.</p>', 1, '-1', 1, '2025-03-25 13:04:01', 0, '0', '0'),
(6, 'Authentic Butter Chicken Recipe – A Creamy Delight!', '<p>Butter Chicken, also known as <em>Murgh Makhani</em>, is a rich and creamy Indian dish loved worldwide. Made with marinated chicken cooked in a luscious tomato-based gravy with butter and cream, this dish pairs perfectly with naan or rice. The secret lies in slow-cooking the spices for a deep, aromatic flavor!</p>', 2, '-1', 4, '2025-03-25 13:10:46', 2, '4,11', '6,1'),
(7, 'Mastering Clean Code: Best Practices for Developers', '<p><img src=\"../Uploads/Topic-data/67e2a05c3e7f6.jpeg\"></p><p><br></p><p>Writing clean and maintainable code is crucial for efficient software development. Following principles like meaningful variable names, proper indentation, and avoiding unnecessary complexity can make your code more readable and scalable. Remember, clean code is not just for you—it’s for your future self and your team!</p>', 3, 'Entertainment', 6, '2025-03-25 13:23:56', 0, '0', '0'),
(14, 'Any Recipe for VNSGU type Pulav ?', '<p>Hey I have recently passed my bachlor degree and for success party my college group decided to go to vnsgu canteen .</p><p><br></p><p>Lets put all things on the side but i want to know the recipe or how to make vnsgu style pulav .</p>', 4, 'Entertainment', 4, '2025-03-29 09:43:57', 2, '5,11', '6,6'),
(11, 'UseLess Topic', '<p>kuch nahi hai bolne ke liye...</p><p><br></p><h3>allah hu akbar... pakistan jindabad....</h3><p>inkalam jindabad</p><p>bharat mata ki jai</p><p><br></p><h3>me pagal hu aur ye jo ap dekh rhe ho to ap bhi pagal ho!!</h3><p><img src=\"../Uploads/Topic-data/67e2b25e6a023.jpeg\"></p>', 6, 'National', 0, '2025-03-25 14:40:46', 7, '6,7,8,9,5,10,11', '1,4');

-- --------------------------------------------------------

--
-- Table structure for table `users`
--

CREATE TABLE `users` (
  `id` int(11) NOT NULL,
  `firstname` varchar(10) NOT NULL,
  `lastname` varchar(15) NOT NULL,
  `email` varchar(100) NOT NULL,
  `password` varchar(100) NOT NULL,
  `date_of_birth` date NOT NULL,
  `username` varchar(15) NOT NULL,
  `gender` varchar(50) NOT NULL,
  `profile_image` mediumtext NOT NULL DEFAULT 'user.png',
  `created_at` datetime NOT NULL DEFAULT current_timestamp(),
  `ac_status` int(10) NOT NULL,
  `report` int(11) NOT NULL DEFAULT 0,
  `reported_users` text NOT NULL DEFAULT '0',
  `reason` text NOT NULL DEFAULT '0'
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `users`
--

INSERT INTO `users` (`id`, `firstname`, `lastname`, `email`, `password`, `date_of_birth`, `username`, `gender`, `profile_image`, `created_at`, `ac_status`, `report`, `reported_users`, `reason`) VALUES
(0, 'Pixo', 'Owner', 'pixotowner2817@gmail.com', 'admin123@', '2004-01-01', 'rulers@pixo07', '', '67e2b40180643.png', '2025-03-24 15:00:39', 2, 0, '0', '0'),
(1, 'Ishita', 'Patel', 'ishita.patel@example.com', 'Ishita@123', '2004-02-25', 'ishitapatel25', 'Female', '67e2af035fc0a.jpg', '2025-03-25 14:48:02', 0, 0, '0', '0'),
(2, 'Riya', 'Pandya', 'riya.pandya@example.com', 'Riya#456', '2004-12-08', 'riyapandya08', 'Female', '67e29e19f2e0a.jpg', '2025-03-25 14:48:02', 0, 2, '4,11', '6,3'),
(3, 'Krishna', 'Parekh', 'krishna.parekh@example.com', 'Krishna@789', '2004-11-01', 'krishnaparekh1', 'Male', '67e29ec960585.jpeg', '2025-03-25 14:48:02', 0, 1, '4', '4'),
(4, 'Akshar', 'Patel', 'akptl014@gmail.com', 'Akshar*123', '2004-10-29', 'aksharpatel29', 'Male', '67f7b03ccf5f0.jpg', '2025-03-25 14:48:02', 0, 0, '0', '0'),
(5, 'Shubham', 'Mishra', 'shubham.mishra@example.com', 'Shubham!321', '2003-03-27', 'shubhammishra2', 'Male', '67e2ac707f22a.jpeg', '2025-03-25 14:48:02', 0, 1, '4', '2'),
(6, 'Aarav', 'Sharma', 'aarav.sharma@example.com', 'Aarav@123', '1997-09-12', 'aaravx99', 'Male', '67f7b0aad159e.jpeg', '2025-03-25 14:50:57', 0, 0, '0', '0'),
(7, 'Drashti', 'Patel', 'dr.patel@example.com', 'Drashti#456', '1999-06-25', 'drshkool_22', 'Female', 'user.png', '2025-03-25 14:50:57', 0, 0, '0', '0'),
(8, 'Vihaan', 'Reddy', 'vihaan.reddy@example.com', 'Vihaan@789', '1995-03-18', 'vihaan_007', 'Male', 'user.png', '2025-03-25 14:50:58', 0, 0, '0', '0'),
(9, 'Kavya', 'Mehta', 'kavya.mehta@example.com', 'Kavya*123', '2001-01-05', 'kavyavibes', 'Female', 'user.png', '2025-03-25 14:50:58', 0, 0, '0', '0'),
(10, 'Devansh', 'Verma', 'devansh.verma@example.com', 'Devansh!321', '1998-11-30', 'dev_dynamite', 'Male', 'user.png', '2025-03-25 14:50:58', 0, 0, '0', '0');

-- --------------------------------------------------------

--
-- Table structure for table `user_community_data`
--

CREATE TABLE `user_community_data` (
  `id` int(11) NOT NULL,
  `user_id` int(11) NOT NULL,
  `community_id` int(11) NOT NULL,
  `joined_at` varchar(20) NOT NULL
) ENGINE=MyISAM DEFAULT CHARSET=latin1 COLLATE=latin1_swedish_ci;

--
-- Dumping data for table `user_community_data`
--

INSERT INTO `user_community_data` (`id`, `user_id`, `community_id`, `joined_at`) VALUES
(1, 1, 17, '2025-03-25 12:49:34'),
(2, 1, 2, '2025-03-25 12:55:10'),
(3, 1, 3, '2025-03-25 12:55:57'),
(4, 2, 4, '2025-03-25 13:07:39'),
(5, 2, 5, '2025-03-25 13:09:32'),
(6, 2, 2, '2025-03-25 13:13:35'),
(7, 3, 4, '2025-03-25 13:17:31'),
(8, 3, 2, '2025-03-25 13:17:38'),
(9, 3, 6, '2025-03-25 13:26:19'),
(10, 4, 6, '2025-03-25 13:30:06'),
(32, 4, 4, '2025-03-30 13:03:27'),
(12, 4, 7, '2025-03-25 13:42:21'),
(13, 5, 4, '2025-03-25 14:00:57'),
(14, 5, 2, '2025-03-25 14:01:10'),
(16, 5, 8, '2025-03-25 14:04:13'),
(17, 5, 6, '2025-03-25 14:17:05'),
(19, 1, 1, '01-01-2025'),
(20, 1, 4, '2025-03-25 15:24:00'),
(21, 1, 6, '2025-03-25 15:24:08'),
(23, 1, 7, '2025-03-25 15:47:16'),
(26, 0, 3, '2025-03-30 12:13:08'),
(27, 0, 6, '2025-03-30 12:26:25');

-- --------------------------------------------------------

--
-- Table structure for table `votes`
--

CREATE TABLE `votes` (
  `id` int(255) NOT NULL,
  `vote_user_id` int(255) NOT NULL,
  `vote_topic_id` int(255) NOT NULL,
  `vote_type` int(10) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `votes`
--

INSERT INTO `votes` (`id`, `vote_user_id`, `vote_topic_id`, `vote_type`) VALUES
(1, 2, 4, 1),
(2, 3, 4, 1),
(3, 3, 7, 1),
(4, 4, 4, 1),
(5, 4, 7, 1),
(6, 4, 6, 1),
(10, 5, 7, 1),
(12, 5, 6, 1),
(13, 5, 5, 1),
(14, 5, 4, 1),
(16, 1, 5, 1),
(17, 1, 4, 1),
(18, 1, 7, 1),
(21, 7, 11, -1),
(22, 6, 11, -1),
(23, 8, 11, -1),
(24, 9, 11, -1),
(26, 10, 11, -1),
(28, 5, 2, 1),
(29, 4, 1, 1);

--
-- Indexes for dumped tables
--

--
-- Indexes for table `community_data`
--
ALTER TABLE `community_data`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `discuss`
--
ALTER TABLE `discuss`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `topic_data`
--
ALTER TABLE `topic_data`
  ADD PRIMARY KEY (`topic_id`);

--
-- Indexes for table `users`
--
ALTER TABLE `users`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `user_community_data`
--
ALTER TABLE `user_community_data`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `votes`
--
ALTER TABLE `votes`
  ADD PRIMARY KEY (`id`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `community_data`
--
ALTER TABLE `community_data`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=11;

--
-- AUTO_INCREMENT for table `discuss`
--
ALTER TABLE `discuss`
  MODIFY `id` int(255) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=23;

--
-- AUTO_INCREMENT for table `topic_data`
--
ALTER TABLE `topic_data`
  MODIFY `topic_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=23;

--
-- AUTO_INCREMENT for table `users`
--
ALTER TABLE `users`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=12;

--
-- AUTO_INCREMENT for table `user_community_data`
--
ALTER TABLE `user_community_data`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=37;

--
-- AUTO_INCREMENT for table `votes`
--
ALTER TABLE `votes`
  MODIFY `id` int(255) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=52;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
