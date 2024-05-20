-- phpMyAdmin SQL Dump
-- version 5.2.1
-- https://www.phpmyadmin.net/
--
-- Host: localhost:3306
-- Generation Time: May 20, 2024 at 01:43 PM
-- Server version: 10.3.39-MariaDB
-- PHP Version: 8.1.27

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `nguyenro_nursing`
--

-- --------------------------------------------------------

--
-- Table structure for table `ExperienceFormSubmissions`
--

CREATE TABLE `ExperienceFormSubmissions` (
  `SubmissionID` mediumint(8) UNSIGNED NOT NULL,
  `SiteAttended` varchar(255) NOT NULL,
  `EnjoyedSite` tinyint(4) NOT NULL,
  `StaffSupportive` tinyint(4) NOT NULL,
  `SiteLearningObjectives` tinyint(4) NOT NULL,
  `PreceptorLearningObjectives` tinyint(4) NOT NULL,
  `RecommendSite` tinyint(4) NOT NULL,
  `SiteOrStaffFeedback` varchar(500) DEFAULT NULL,
  `InstructorFeedback` varchar(500) DEFAULT NULL,
  `Seen` tinyint(4) NOT NULL
) ENGINE=MyISAM DEFAULT CHARSET=latin1 COLLATE=latin1_swedish_ci;

--
-- Dumping data for table `ExperienceFormSubmissions`
--

INSERT INTO `ExperienceFormSubmissions` (`SubmissionID`, `SiteAttended`, `EnjoyedSite`, `StaffSupportive`, `SiteLearningObjectives`, `PreceptorLearningObjectives`, `RecommendSite`, `SiteOrStaffFeedback`, `InstructorFeedback`, `Seen`) VALUES
(1, 'Clinical Site 1', 1, 3, 3, 1, 1, 'The site wasn\'t the greatest', 'The instructor wasn\'t the greatest', 1),
(2, 'Clinical Site 1', 1, 1, 4, 1, 1, '', 'I gotta say, never in my entire career as a student have I ever encountered an instructor of this caliber. Guy was late half the time, sleeping the other half?! I mean c\'mon what is the standard of ethics this place is attempting to hold up. Would not recommend this place', 1),
(3, 'Clinical Site 1', 5, 3, 5, 3, 5, '', '', 1),
(4, 'Clinical Site 1', 3, 5, 3, 2, 2, '', '', 1),
(5, 'Clinical Site 1', 1, 1, 2, 1, 1, '', 'This guy doesn\'t know what he\'s saying half the time', 1),
(6, 'Clinical Site 1', 2, 1, 3, 1, 1, '', '', 1),
(7, 'Clinical Site 1', 3, 2, 4, 1, 1, 'I think about this place too often.. save yourself!', '', 1),
(8, 'Clinical Site 1', 2, 2, 3, 1, 4, '', '', 1),
(9, 'Clinical Site 1', 5, 3, 2, 2, 2, '', '', 1),
(10, 'Clinical Site 12', 2, 2, 2, 4, 2, '', '', 1),
(11, 'Clinical Site 12', 2, 3, 2, 2, 1, '', '', 1),
(12, 'Clinical Site 12', 2, 2, 2, 2, 2, 'The site could use some improvements', '', 1),
(13, 'Clinical Site 12', 2, 3, 2, 2, 2, '', 'Instructor was late most of the time', 1),
(14, 'Clinical Site 12', 2, 3, 2, 2, 2, '', '', 1),
(15, 'Clinical Site 12', 3, 3, 5, 4, 2, 'The staff was great!', '', 1),
(16, 'Clinical Site 12', 2, 1, 2, 5, 2, '', '', 1),
(17, 'Clinical Site 12', 5, 2, 2, 3, 2, '', '', 1),
(18, 'Clinical Site 12', 2, 3, 2, 2, 1, '', '', 1),
(19, 'Clinical Site 12', 1, 3, 5, 2, 2, '', '', 1),
(20, 'Clinical Site 12', 5, 5, 5, 5, 5, 'The staff was great!', '', 1),
(21, 'Clinical Site 12', 1, 2, 2, 5, 1, '', '', 1),
(22, 'Clinical Site 1', 3, 3, 4, 3, 3, 'I\'ve seen worse', '', 1),
(23, 'Clinical Site 1', 3, 3, 3, 3, 3, '', '', 1),
(24, 'Clinical Site 1', 2, 3, 3, 3, 4, '', '', 1),
(25, 'Clinical Site 1', 3, 3, 3, 3, 3, '', '', 1),
(26, 'Clinical Site 5', 5, 5, 5, 5, 5, 'Best experience EVER!!', 'Never met a kinder person in my entire life. So dedicated to teaching!', 1),
(27, 'Clinical Site 5', 5, 5, 5, 5, 5, '', '', 1),
(28, 'Clinical Site 11', 1, 5, 2, 2, 2, '', '', 1),
(29, 'Clinical Site 11', 3, 5, 3, 2, 2, '', '', 1),
(30, 'Clinical Site 11', 5, 3, 5, 3, 5, '', '', 1),
(31, 'Clinical Site 11', 3, 5, 1, 2, 1, 'The site could use some improvements', '', 1),
(32, 'Clinical Site 11', 2, 2, 1, 5, 1, '', '', 1),
(33, 'Clinical Site 11', 4, 4, 2, 4, 2, '', '', 1),
(34, 'Clinical Site 11', 3, 5, 3, 2, 2, '', '', 1),
(35, 'Clinical Site 11', 3, 5, 4, 4, 2, 'The staff were very kind!', '', 1),
(36, 'Clinical Site 9', 5, 3, 5, 3, 5, 'Bathrooms.. oof', '', 1),
(37, 'Clinical Site 9', 4, 4, 2, 4, 2, '', '', 1),
(38, 'Clinical Site 9', 3, 5, 3, 2, 2, '', 'I literally attended the same exact lecture 6 times??', 1),
(39, 'Clinical Site 9', 4, 4, 2, 4, 2, '', '', 1);

--
-- Indexes for dumped tables
--

--
-- Indexes for table `ExperienceFormSubmissions`
--
ALTER TABLE `ExperienceFormSubmissions`
  ADD PRIMARY KEY (`SubmissionID`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `ExperienceFormSubmissions`
--
ALTER TABLE `ExperienceFormSubmissions`
  MODIFY `SubmissionID` mediumint(8) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=40;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
