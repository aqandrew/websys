-- phpMyAdmin SQL Dump
-- version 4.5.2
-- http://www.phpmyadmin.net
--
-- Host: localhost
-- Generation Time: Nov 17, 2016 at 02:20 AM
-- Server version: 10.1.16-MariaDB
-- PHP Version: 5.6.24

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `aquina-websyslab9`
--

-- --------------------------------------------------------

--
-- Table structure for table `courses`
--

CREATE TABLE `courses` (
  `crn` int(11) NOT NULL,
  `prefix` varchar(4) COLLATE utf8_unicode_ci NOT NULL,
  `number` smallint(4) NOT NULL,
  `title` varchar(255) COLLATE utf8_unicode_ci NOT NULL,
  `section` int(2) DEFAULT NULL,
  `year` int(4) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

--
-- Dumping data for table `courses`
--

INSERT INTO `courses` (`crn`, `prefix`, `number`, `title`, `section`, `year`) VALUES
(35301, 'ARTS', 1020, 'Media Studio: Imaging', 1, 2017),
(35303, 'ARTS', 1020, 'Media Studio: Imaging', 4, 2017),
(35356, 'ARTS', 2020, 'Music and Technology I', 1, 2017),
(37876, 'ARTS', 1200, 'Basic Drawing', 1, 2017),
(37880, 'ARTS', 4220, 'Painting', 1, 2017),
(38182, 'ARTS', 1040, 'Art for Interactive Media', 1, 2017),
(38611, 'ARTS', 1010, 'Introduction to Music and Sound', 1, 2017),
(39027, 'ARTS', 1030, 'Digital Filmmaking', 1, 2017),
(39117, 'ARTS', 1050, 'Art History: Paleolithic to Contemporary', 1, 2017),
(39271, 'ARTS', 1050, 'Art History: Paleolithic to Contemporary', 2, 2017);

-- --------------------------------------------------------

--
-- Table structure for table `grades`
--

CREATE TABLE `grades` (
  `id` int(11) NOT NULL,
  `crn` int(11) DEFAULT NULL,
  `rin` int(9) DEFAULT NULL,
  `grade` int(3) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

--
-- Dumping data for table `grades`
--

INSERT INTO `grades` (`id`, `crn`, `rin`, `grade`) VALUES
(1, 35301, 218967210, 7),
(2, 35301, 851067762, 420),
(3, 35301, 492222908, 666),
(4, 35301, 400149295, 311),
(5, 35301, 383075255, 911),
(6, 37876, 218967210, 0),
(7, 37876, 560588858, 0),
(8, 37876, 851067762, 0),
(9, 37876, 492222908, 0),
(10, 37876, 400149295, 0),
(11, 39271, 218967210, 6),
(12, 39271, 358570031, 5),
(13, 39271, 560588858, 4),
(14, 39271, 851067762, 3),
(15, 39271, 492222908, 33),
(16, 37880, 218967210, 67),
(17, 37880, 560588858, 99),
(18, 37880, 851067762, 69),
(19, 37880, 358570031, 5),
(20, 37880, 851067762, 1),
(21, 37876, 851067762, 100),
(22, 35303, 851067762, 1),
(23, 35303, 851067762, 1),
(24, 35303, 851067762, 1),
(25, 35303, 851067762, 1);

-- --------------------------------------------------------

--
-- Table structure for table `students`
--

CREATE TABLE `students` (
  `rin` int(9) NOT NULL,
  `rcsID` char(7) COLLATE utf8_unicode_ci DEFAULT NULL,
  `first_name` varchar(100) COLLATE utf8_unicode_ci NOT NULL,
  `last_name` varchar(100) COLLATE utf8_unicode_ci NOT NULL,
  `alias` varchar(100) COLLATE utf8_unicode_ci NOT NULL,
  `phone` int(10) DEFAULT NULL,
  `street` varchar(100) COLLATE utf8_unicode_ci DEFAULT NULL,
  `city` varchar(100) COLLATE utf8_unicode_ci DEFAULT NULL,
  `state` varchar(100) COLLATE utf8_unicode_ci DEFAULT NULL,
  `zip` int(5) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

--
-- Dumping data for table `students`
--

INSERT INTO `students` (`rin`, `rcsID`, `first_name`, `last_name`, `alias`, `phone`, `street`, `city`, `state`, `zip`) VALUES
(218967210, 'tuckep7', 'Phyllis', 'Tucker', 'Warfarin Sodium', 2147483647, '8089 Kipling Way', 'Peoria', 'IL', 61640),
(358570031, 'wilsoa3', 'Arthur', 'Wilson', 'Aveeno Eczema Therapy Moisturizing', 2147483647, '6 Delaware Court', 'Shreveport', 'LA', 71115),
(383075255, 'romerw5', 'William', 'Romero', 'WU YANG BRAND MEDICATED PLASTER', 2147483647, '009 Magdeline Street', 'Baltimore', 'MD', 21203),
(400149295, 'bishoa3', 'Angela', 'Bishop', 'childrens wal tap', 2147483647, '31 Hollow Ridge Place', 'Sacramento', 'CA', 94250),
(492222908, 'jenkip8', 'Paul', 'Jenkins', 'Cold Sore Complex', 2147483647, '82 Tomscot Drive', 'Irving', 'TX', 75062),
(560588858, 'freemb2', 'Barbara', 'Freeman', 'LEVOFLOXACIN', 2147483647, '6 Hintze Plaza', 'Long Beach', 'CA', 90831),
(647433053, 'perkia', 'Antonio', 'Perkins', 'Benicar', 2147483647, '29730 Village Hill', 'Miami', 'FL', 33158),
(851067762, 'lewisj', 'Jeremy', 'Lewis', 'BuPROPion Hydrochloride', 2147483647, '68 Tony Alley', 'Austin', 'TX', 78715),
(859439651, 'webbh', 'Harry', 'Webb', 'Prednisolone', 2147483647, '6 Northport Street', 'Salem', 'OR', 97312),
(861826167, 'howelg6', 'Gary', 'Howell', 'Exuviance CoverBlend Concealing Treatment Makeup', 2147483647, '1 Crest Line Lane', 'Northridge', 'CA', 91328);

--
-- Indexes for dumped tables
--

--
-- Indexes for table `courses`
--
ALTER TABLE `courses`
  ADD PRIMARY KEY (`crn`);

--
-- Indexes for table `grades`
--
ALTER TABLE `grades`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `students`
--
ALTER TABLE `students`
  ADD PRIMARY KEY (`rin`);

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
