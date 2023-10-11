-- phpMyAdmin SQL Dump
-- version 5.2.1
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Generation Time: Oct 11, 2023 at 09:17 PM
-- Server version: 10.4.28-MariaDB
-- PHP Version: 8.2.4

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `security`
--

-- --------------------------------------------------------

--
-- Table structure for table `academic_request`
--

CREATE TABLE `academic_request` (
  `request_id` int(11) NOT NULL,
  `request_text` text NOT NULL,
  `date_submitted` date NOT NULL,
  `comment` text DEFAULT NULL,
  `student_id` int(11) DEFAULT NULL,
  `facilitator_id` int(11) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `academic_request`
--

INSERT INTO `academic_request` (`request_id`, `request_text`, `date_submitted`, `comment`, `student_id`, `facilitator_id`) VALUES
(6, 'Hi there! Wanted to request office hours with you tomorrow 2:00pm', '2023-10-10', 'Yes', 1, 3),
(7, 'How about Friday? Can it work?', '2023-10-10', NULL, 1, 3),
(8, 'Are you attending today\'s class?', '2023-10-11', NULL, 2, 3),
(9, 'Is there an assignment due tonight?', '2023-10-11', 'There are two actually.', 2, 3),
(10, 'Please ma\'am, May you extend the deadline.', '2023-10-11', 'This time ... NO!', 1, 3);

-- --------------------------------------------------------

--
-- Table structure for table `administrative_request`
--

CREATE TABLE `administrative_request` (
  `request_id` int(11) NOT NULL,
  `request_text` text NOT NULL,
  `date_submitted` date NOT NULL,
  `comment` text DEFAULT NULL,
  `student_id` int(11) DEFAULT NULL,
  `lead_id` int(11) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `administrative_request`
--

INSERT INTO `administrative_request` (`request_id`, `request_text`, `date_submitted`, `comment`, `student_id`, `lead_id`) VALUES
(4, 'Hey', '2023-10-11', NULL, 1, 2),
(5, 'I need Financial Aid ', '2023-10-11', 'Give more details.', 2, 2),
(6, 'I can\'t access my school calendar.', '2023-10-11', 'Thank you for letting me know. I will look into it.', 1, 2);

-- --------------------------------------------------------

--
-- Table structure for table `cs_lead`
--

CREATE TABLE `cs_lead` (
  `lead_id` int(11) NOT NULL,
  `fname` varchar(255) NOT NULL,
  `lname` varchar(255) NOT NULL,
  `email` varchar(255) NOT NULL,
  `pwd` varchar(255) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `cs_lead`
--

INSERT INTO `cs_lead` (`lead_id`, `fname`, `lname`, `email`, `pwd`) VALUES
(2, 'Isaac', 'Museveni', 'i.museveni@alueducation.com', '$2y$10$musSauI/cfDGAyYFby/5qujE1vB3UFX5os7tTuyp/Bc5QhpeXMmhm');

-- --------------------------------------------------------

--
-- Table structure for table `facilitator`
--

CREATE TABLE `facilitator` (
  `facilitator_id` int(11) NOT NULL,
  `fname` varchar(255) NOT NULL,
  `lname` varchar(255) NOT NULL,
  `email` varchar(255) NOT NULL,
  `pwd` varchar(255) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `facilitator`
--

INSERT INTO `facilitator` (`facilitator_id`, `fname`, `lname`, `email`, `pwd`) VALUES
(3, 'Natley', 'Nyamukondiwa', 'n.nyamukondiwa2@alueducation.com', '$2y$10$b7PVJo5WiJa1r0Ndy9YfmOVEUQkNY/TzygYETb6O1C3WodTKf1j12'),
(4, 'Bruce', 'Manzi', 'b.manzi@alueducation.com', '$2y$10$3cpBSgUeyaM7xr90fJkeY.x0RF4UD5VuIFkuDrwsUMsJEnBff8vuy'),
(5, 'Natley', 'Nyamukondiwa', 'n.nyamukondiwa@gmail.com', '$2y$10$h2Yys7Np/h3y85iu4zg23eiMb2Z53IDuIgupmEYvFmqjx7nj8JyFe'),
(6, 'Sandrine', 'Ghea', 's.ghea55@gmail.com', '$2y$10$3nxdSQ4Q37zqJ5arLJNhWuxW5PChT15d04KyIFk2iH6BZUv4xXphe');

-- --------------------------------------------------------

--
-- Table structure for table `student`
--

CREATE TABLE `student` (
  `student_id` int(11) NOT NULL,
  `fname` varchar(255) NOT NULL,
  `lname` varchar(255) NOT NULL,
  `email` varchar(255) NOT NULL,
  `pwd` varchar(255) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `student`
--

INSERT INTO `student` (`student_id`, `fname`, `lname`, `email`, `pwd`) VALUES
(1, 'Aimee Marie', 'Ishimwe', 'm.ishimwe1@alustudent.com', '$2y$10$D7DKIGp.rPJjV8FwK.KNOO3wCChryp7qwmOsMnzzmPIv2xesmL.IS'),
(2, 'Yves', 'Manzi', 'y.manzi@alustudent.com', '$2y$10$5k5ciTRhJFXXKFQ.IjxrvOIKe/T7IM.RoL3xl58H/FO2HeOcUAk02'),
(3, 'Emile', 'Kamana', 'e.kamana100@alustudent.com', '$2y$10$klnjLcJBwOWLHZdGJCEFW.lEgs20p5iV8lPQuVBitksypHaw2NeTe');

--
-- Indexes for dumped tables
--

--
-- Indexes for table `academic_request`
--
ALTER TABLE `academic_request`
  ADD PRIMARY KEY (`request_id`),
  ADD KEY `student_id` (`student_id`),
  ADD KEY `facilitator_id` (`facilitator_id`);

--
-- Indexes for table `administrative_request`
--
ALTER TABLE `administrative_request`
  ADD PRIMARY KEY (`request_id`),
  ADD KEY `student_id` (`student_id`),
  ADD KEY `lead_id` (`lead_id`);

--
-- Indexes for table `cs_lead`
--
ALTER TABLE `cs_lead`
  ADD PRIMARY KEY (`lead_id`);

--
-- Indexes for table `facilitator`
--
ALTER TABLE `facilitator`
  ADD PRIMARY KEY (`facilitator_id`);

--
-- Indexes for table `student`
--
ALTER TABLE `student`
  ADD PRIMARY KEY (`student_id`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `academic_request`
--
ALTER TABLE `academic_request`
  MODIFY `request_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=11;

--
-- AUTO_INCREMENT for table `administrative_request`
--
ALTER TABLE `administrative_request`
  MODIFY `request_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=7;

--
-- AUTO_INCREMENT for table `cs_lead`
--
ALTER TABLE `cs_lead`
  MODIFY `lead_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=3;

--
-- AUTO_INCREMENT for table `facilitator`
--
ALTER TABLE `facilitator`
  MODIFY `facilitator_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=7;

--
-- AUTO_INCREMENT for table `student`
--
ALTER TABLE `student`
  MODIFY `student_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=4;

--
-- Constraints for dumped tables
--

--
-- Constraints for table `academic_request`
--
ALTER TABLE `academic_request`
  ADD CONSTRAINT `academic_request_ibfk_1` FOREIGN KEY (`student_id`) REFERENCES `student` (`student_id`),
  ADD CONSTRAINT `academic_request_ibfk_2` FOREIGN KEY (`facilitator_id`) REFERENCES `facilitator` (`facilitator_id`) ON DELETE NO ACTION ON UPDATE CASCADE;

--
-- Constraints for table `administrative_request`
--
ALTER TABLE `administrative_request`
  ADD CONSTRAINT `administrative_request_ibfk_1` FOREIGN KEY (`student_id`) REFERENCES `student` (`student_id`),
  ADD CONSTRAINT `administrative_request_ibfk_2` FOREIGN KEY (`lead_id`) REFERENCES `cs_lead` (`lead_id`) ON DELETE NO ACTION ON UPDATE CASCADE;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
