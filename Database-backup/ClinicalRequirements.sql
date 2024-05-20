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
-- Table structure for table `ClinicalRequirements`
--

CREATE TABLE `ClinicalRequirements` (
  `RequirementID` mediumint(8) UNSIGNED NOT NULL,
  `RequirementTitle` varchar(255) NOT NULL,
  `RequirementNotes` varchar(100) DEFAULT NULL,
  `Option1` varchar(500) NOT NULL,
  `Option2` varchar(500) DEFAULT NULL
) ENGINE=MyISAM DEFAULT CHARSET=latin1 COLLATE=latin1_swedish_ci;

--
-- Dumping data for table `ClinicalRequirements`
--

INSERT INTO `ClinicalRequirements` (`RequirementID`, `RequirementTitle`, `RequirementNotes`, `Option1`, `Option2`) VALUES
(1, 'Tuberculosis Test', 'Expires Yearly', '2-step PPD\n- Must be two separate 2-step PPD tests done initially done approximately 2 weeks apart\n- Document must show induration in millimeter, date placed, and date read', 'QuantiFERON\n- Results must be negative'),
(2, 'Hepatitis B Titer', NULL, 'Titer\n- Only Anti-HBs or HepB SaB test are accepted', 'Declination Form\n- If currently in process of vaccine series or titer, or if non-converter'),
(3, 'MMR Vaccine or Titer', NULL, '2 documented vaccine dates', 'Titer\n- Separate titer needed for Measles, Mumps, and Rubella\n- If result is negative/low/equivocal must get booster dose'),
(4, 'Varicella Vaccine or Titer', 'History of Chickenpox not accepted', '2 documented vaccine dates', 'Titer\n- If result is negative/low/equivocal must get booster dose'),
(5, 'Tdap Vaccine', NULL, '- Date must be within last 10 years', NULL),
(6, 'Flu Vaccine', 'Expires Yearly', '- Vaccine must be for current season (Sept thru August)', NULL),
(7, 'Covid 19 Vaccine Series', 'Proof must include manufacturer', '- Pfizer, Moderna, and Janssen are the only ones we accept currently', NULL),
(8, 'Covid Booster', 'Proof must include manufacturer', '- Only one dose required currently, but may change in the future', NULL),
(9, 'CPR Card', NULL, '- Must be American Heart Association Basic Life Support', NULL),
(10, 'Professional Liability', NULL, '- <strong>CANNOT</strong> attend lab or clinical prior to purchasing\n- Expires end of each school year (08/31)\n- Purchase at <strong>Cashier`s Office</strong> 253-833-9111 ext. 3399', NULL),
(11, 'Test', '', 'test', '');

--
-- Indexes for dumped tables
--

--
-- Indexes for table `ClinicalRequirements`
--
ALTER TABLE `ClinicalRequirements`
  ADD PRIMARY KEY (`RequirementID`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `ClinicalRequirements`
--
ALTER TABLE `ClinicalRequirements`
  MODIFY `RequirementID` mediumint(8) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=12;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
