-- phpMyAdmin SQL Dump
-- version 5.2.1
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Generation Time: Mar 12, 2025 at 08:49 AM
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
-- Database: `paperfinder`
--

-- --------------------------------------------------------

--
-- Table structure for table `class`
--

CREATE TABLE `class` (
  `id` int(11) NOT NULL,
  `classname` varchar(255) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `class`
--

INSERT INTO `class` (`id`, `classname`) VALUES
(1, 'S4 MCE'),
(2, 'S4 MPC'),
(3, 'S4 MEG'),
(4, 'S4 PCB'),
(5, 'S4 HGL'),
(6, 'S5 MCE'),
(7, 'S5 MPC'),
(8, 'S5 MEG'),
(9, 'S5 PCB'),
(10, 'S5 HGL'),
(11, 'S6 MCE'),
(12, 'S6 MPC'),
(13, 'S6 MEG'),
(14, 'S6 PCB'),
(15, 'S6 HGL');

-- --------------------------------------------------------

--
-- Table structure for table `favourite`
--

CREATE TABLE `favourite` (
  `id` int(11) NOT NULL,
  `user_id` int(11) NOT NULL,
  `paper_id` int(11) NOT NULL,
  `added_at` timestamp NOT NULL DEFAULT current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `favourite`
--

INSERT INTO `favourite` (`id`, `user_id`, `paper_id`, `added_at`) VALUES
(5, 2, 1, '2025-02-09 12:58:29'),
(6, 3, 3, '2025-02-13 12:05:51'),
(7, 3, 3, '2025-02-13 12:05:55'),
(8, 2, 2, '2025-02-13 12:10:18'),
(9, 2, 4, '2025-02-13 12:15:26'),
(10, 2, 3, '2025-02-27 12:44:40');

-- --------------------------------------------------------

--
-- Table structure for table `past_papers`
--

CREATE TABLE `past_papers` (
  `id` int(11) NOT NULL,
  `Term` varchar(255) DEFAULT NULL,
  `weeks` varchar(255) DEFAULT NULL,
  `subject` varchar(255) NOT NULL,
  `class_selection` varchar(255) NOT NULL,
  `year` date NOT NULL,
  `category` varchar(255) NOT NULL,
  `cover_page` varchar(255) NOT NULL,
  `uploaded_by` varchar(255) NOT NULL,
  `file_path` varchar(255) NOT NULL,
  `answers` varchar(255) DEFAULT NULL,
  `uploaded_at` timestamp NOT NULL DEFAULT current_timestamp(),
  `searches_count` int(11) DEFAULT 0,
  `views_count` int(11) DEFAULT 0
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `past_papers`
--

INSERT INTO `past_papers` (`id`, `Term`, `weeks`, `subject`, `class_selection`, `year`, `category`, `cover_page`, `uploaded_by`, `file_path`, `answers`, `uploaded_at`, `searches_count`, `views_count`) VALUES
(1, 'Term 2', 'Week 5', 'Computer science', 'S6MCE', '2025-02-01', 'Nationalexam', 'C:/xampp/htdocs/steam/pastpaper/uploads/covers/1738415743_1737213767_download.jpeg', 'Seraphin Mukiza', 'C:/xampp/htdocs/steam/pastpaper/uploads/papers/1738415743_1737213767_2011 Computer Science Past Paper.pdf', NULL, '2025-02-01 13:15:43', 29, 8),
(2, 'Term 2', 'Week 5', 'Computer science', 'S6 All', '2025-02-07', 'Nationalexam', 'C:/xampp/htdocs/steam/pastpaper/uploads/covers/1738934605_1737213781_download.jpeg', 'Nagakuze samuel', 'C:/xampp/htdocs/steam/pastpaper/uploads/papers/1738934605_1737213781_2012 Computer Science Past Paper.pdf', 'C:/xampp/htdocs/steam/pastpaper/uploads/answers/1738934605_1737213781_2012 Computer Science Past Paper.pdf', '2025-02-07 13:23:25', 30, 2),
(3, 'Term 2', 'Week 5', 'Computer science', 'S6 All', '2025-02-07', 'Nationalexam', 'C:/xampp/htdocs/steam/pastpaper/uploads/covers/1738934676_1737213781_download.jpeg', 'Nagakuze samuel', 'C:/xampp/htdocs/steam/pastpaper/uploads/papers/1738934676_1737213781_2012 Computer Science Past Paper.pdf', 'C:/xampp/htdocs/steam/pastpaper/uploads/answers/1738934676_1737213781_2012 Computer Science Past Paper.pdf', '2025-02-07 13:24:36', 30, 2),
(4, 'Term 2', 'Week 5', 'Computer science', 'S6 All', '2025-02-07', 'Nationalexam', 'C:/xampp/htdocs/steam/pastpaper/uploads/covers/1738935801_1737213811_download.jpeg', 'Seraphin Mukiza', 'C:/xampp/htdocs/steam/pastpaper/uploads/papers/1738935801_1737213788_2013 Computer Science Past Paper.pdf', 'C:/xampp/htdocs/steam/pastpaper/uploads/answers/1738935801_1737213788_2013 Computer Science Past Paper.pdf', '2025-02-07 13:43:21', 29, 2),
(5, 'Term 2', 'Week 8', 'Biology', 'S6PCB', '0000-00-00', 'Nationalexam', 'C:/xampp/htdocs/steam/pastpaperfinder/uploads/covers/1741714099_1737213804_download.jpeg', 'MBONARUZA Jean Jule', 'C:/xampp/htdocs/steam/pastpaperfinder/uploads/papers/1741714099_2004 Biology II Past Paper.pdf', 'C:/xampp/htdocs/steam/pastpaperfinder/uploads/answers/1741714099_2004 Biology II Past Paper.pdf', '2025-03-11 17:28:19', 18, 1);

-- --------------------------------------------------------

--
-- Table structure for table `requests`
--

CREATE TABLE `requests` (
  `id` int(11) NOT NULL,
  `subject` varchar(255) NOT NULL,
  `otherSubject` varchar(255) DEFAULT NULL,
  `grade` varchar(50) NOT NULL,
  `date` date NOT NULL,
  `category` varchar(255) NOT NULL,
  `otherCategory` varchar(255) DEFAULT NULL,
  `class_id` int(11) NOT NULL,
  `details` text DEFAULT NULL,
  `created_at` timestamp NOT NULL DEFAULT current_timestamp(),
  `solved` enum('No','Yes') DEFAULT 'No'
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `requests`
--

INSERT INTO `requests` (`id`, `subject`, `otherSubject`, `grade`, `date`, `category`, `otherCategory`, `class_id`, `details`, `created_at`, `solved`) VALUES
(1, 'Chemistry', NULL, 'Ishami', '2025-02-01', 'Exam', NULL, 7, 'Missing paper request', '2025-02-02 11:37:41', 'Yes'),
(2, 'kinyarwanda', '', 'Ishami', '2025-02-02', 'weeklyexam', '', 7, 'Can you upload weekly exam of s5 kinyarwanda.', '2025-02-02 11:39:26', 'No');

-- --------------------------------------------------------

--
-- Table structure for table `users`
--

CREATE TABLE `users` (
  `id` int(11) NOT NULL,
  `name` varchar(255) DEFAULT NULL,
  `email` varchar(255) NOT NULL,
  `password` varchar(255) NOT NULL,
  `userrole` varchar(255) NOT NULL,
  `class_id` int(11) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `users`
--

INSERT INTO `users` (`id`, `name`, `email`, `password`, `userrole`, `class_id`) VALUES
(1, 'Jay B', 'admin@asyv', 'user', 'admin', NULL),
(2, 'Agahozo', 'student@asyv.org', 'heyman', 'student', 2),
(3, 'Mukiza Seraphin', 'teachers@asyv.org', 'teachers', 'teacher', NULL),
(4, 'Emmanuel Semaza', 'emmy@gmail.com', 'emmanuel', 'student', NULL);

--
-- Indexes for dumped tables
--

--
-- Indexes for table `class`
--
ALTER TABLE `class`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `favourite`
--
ALTER TABLE `favourite`
  ADD PRIMARY KEY (`id`),
  ADD KEY `user_id` (`user_id`),
  ADD KEY `paper_id` (`paper_id`);

--
-- Indexes for table `past_papers`
--
ALTER TABLE `past_papers`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `requests`
--
ALTER TABLE `requests`
  ADD PRIMARY KEY (`id`),
  ADD KEY `class_id` (`class_id`);

--
-- Indexes for table `users`
--
ALTER TABLE `users`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `email` (`email`),
  ADD KEY `fk_class` (`class_id`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `class`
--
ALTER TABLE `class`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=16;

--
-- AUTO_INCREMENT for table `favourite`
--
ALTER TABLE `favourite`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=11;

--
-- AUTO_INCREMENT for table `past_papers`
--
ALTER TABLE `past_papers`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=8;

--
-- AUTO_INCREMENT for table `requests`
--
ALTER TABLE `requests`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=3;

--
-- AUTO_INCREMENT for table `users`
--
ALTER TABLE `users`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=5;

--
-- Constraints for dumped tables
--

--
-- Constraints for table `favourite`
--
ALTER TABLE `favourite`
  ADD CONSTRAINT `favourite_ibfk_1` FOREIGN KEY (`user_id`) REFERENCES `users` (`id`) ON DELETE CASCADE,
  ADD CONSTRAINT `favourite_ibfk_2` FOREIGN KEY (`paper_id`) REFERENCES `past_papers` (`id`) ON DELETE CASCADE;

--
-- Constraints for table `requests`
--
ALTER TABLE `requests`
  ADD CONSTRAINT `requests_ibfk_1` FOREIGN KEY (`class_id`) REFERENCES `class` (`id`);

--
-- Constraints for table `users`
--
ALTER TABLE `users`
  ADD CONSTRAINT `fk_class` FOREIGN KEY (`class_id`) REFERENCES `class` (`id`) ON DELETE SET NULL;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
