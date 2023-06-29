-- phpMyAdmin SQL Dump
-- version 5.2.0
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Generation Time: Jun 28, 2023 at 04:56 PM
-- Server version: 10.4.27-MariaDB
-- PHP Version: 8.2.0

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `adan_madrassah`
--

DELIMITER $$
--
-- Procedures
--
CREATE DEFINER=`root`@`localhost` PROCEDURE `renumber_grades` ()   BEGIN
  -- Create a temporary table to hold the updated grade_id values
  CREATE TEMPORARY TABLE temp_grades (
    row_number INT AUTO_INCREMENT PRIMARY KEY,
    grade_id INT,
    grade VARCHAR(255),
    grade_code VARCHAR(255)
  );

  -- Insert the remaining rows into the temporary table with updated grade_id values
  INSERT INTO temp_grades (grade_id, grade, grade_code)
  SELECT NULL, grade, grade_code
  FROM grades
  ORDER BY grade_id;

  -- Truncate the original grades table
  TRUNCATE TABLE grades;

  -- Update the grade_id values in the temporary table
  UPDATE temp_grades
  SET grade_id = row_number;

  -- Insert the rows from the temporary table back into the grades table
  INSERT INTO grades (grade_id, grade, grade_code)
  SELECT grade_id, grade, grade_code
  FROM temp_grades
  ORDER BY grade_id;

  -- Drop the temporary table
  DROP TABLE temp_grades;
END$$

DELIMITER ;

-- --------------------------------------------------------

--
-- Table structure for table `admin`
--

CREATE TABLE `admin` (
  `admin_id` int(11) NOT NULL,
  `username` varchar(127) NOT NULL,
  `password` varchar(255) NOT NULL,
  `fname` varchar(127) NOT NULL,
  `lname` varchar(127) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `admin`
--

INSERT INTO `admin` (`admin_id`, `username`, `password`, `fname`, `lname`) VALUES
(1, 'ADMIN/001/ADAN', '$2y$10$GnatnQ6eo.u6pP.2bqDSTOPpoMKnRJ1gwmdTTvBPwEB5cZuX6CYIC', 'Ibrahim Abdillahi ', 'Abdurrahman');

-- --------------------------------------------------------

--
-- Table structure for table `class`
--

CREATE TABLE `class` (
  `class_id` int(11) NOT NULL,
  `grade` int(11) NOT NULL,
  `section` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `class`
--

INSERT INTO `class` (`class_id`, `grade`, `section`) VALUES
(1, 7, 2),
(2, 1, 1),
(3, 3, 3),
(4, 2, 1);

-- --------------------------------------------------------

--
-- Table structure for table `grades`
--

CREATE TABLE `grades` (
  `grade_id` int(11) NOT NULL,
  `grade` varchar(31) NOT NULL,
  `grade_code` varchar(7) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `grades`
--

INSERT INTO `grades` (`grade_id`, `grade`, `grade_code`) VALUES
(1, '1', 'RWDH'),
(2, '1', 'FSL'),
(3, '2', 'FSL'),
(4, '3', 'FSL'),
(5, '4', 'FSL'),
(6, '5', 'FSL'),
(7, '6', 'FSL'),
(8, '1', 'MTWST'),
(9, '2', 'MTWST');

-- --------------------------------------------------------

--
-- Table structure for table `message`
--

CREATE TABLE `message` (
  `message_id` int(11) NOT NULL,
  `sender_full_name` varchar(100) NOT NULL,
  `sender_email` varchar(255) NOT NULL,
  `message` text NOT NULL,
  `date_time` datetime NOT NULL DEFAULT current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `message`
--

INSERT INTO `message` (`message_id`, `sender_full_name`, `sender_email`, `message`, `date_time`) VALUES
(1, 'John doe', 'es@gmail.com', 'Hello, world', '2023-02-17 23:39:15'),
(4, 'Anil Hassan', 'habibfufu@gmail.com', 'I would want to know when is the next intake 🙏', '2023-06-25 17:04:45');

-- --------------------------------------------------------

--
-- Table structure for table `registrar_office`
--

CREATE TABLE `registrar_office` (
  `r_user_id` int(11) NOT NULL,
  `username` varchar(127) NOT NULL,
  `password` varchar(255) NOT NULL,
  `fname` varchar(31) NOT NULL,
  `address` varchar(31) NOT NULL,
  `employee_number` varchar(50) NOT NULL,
  `date_of_birth` date NOT NULL,
  `phone_number` varchar(31) NOT NULL,
  `gender` varchar(7) NOT NULL,
  `email_address` varchar(255) NOT NULL,
  `date_of_joined` datetime NOT NULL DEFAULT current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `registrar_office`
--

INSERT INTO `registrar_office` (`r_user_id`, `username`, `password`, `fname`, `address`, `employee_number`, `date_of_birth`, `phone_number`, `gender`, `email_address`, `date_of_joined`) VALUES
(1, 'REGISTRAR/001/ADAN', '$2y$10$iP4aCxoiMNHMfj5tu52wre3cH/TTIRsuYH2U6zhO92SyQxyUDr5Wi', 'Abdulmalik Mukhtar', 'Nairobi', 'TC/098/2018', '1993-10-04', '+254741566323', 'Male', 'malik33mumtaz@gmail.com', '2018-10-23 08:03:25'),
(2, 'REGISTRAR/002/ADAN', '$2y$10$GnatnQ6eo.u6pP.2bqDSTOPpoMKnRJ1gwmdTTvBPwEB5cZuX6CYIC', 'Suheila Ahmad', 'Machakos,Kenya', 'TC/099/2018', '1997-06-11', '+254733889121', 'Female', 'cuteSuhi@outlook.com', '2018-11-12 23:06:18'),
(4, 'REGISTRAR/003/2019', '$2y$10$O33vf7t/2Qi85gPp4ImPRehRHTWw.nNubYfI2w5nuBeYrQA66kfQq', 'Anas Malik', 'Nairobi,Kenya', 'TC/097/2018', '1998-12-20', '+254733889070', 'Male', 'anas321malik@email.com', '2023-06-25 16:20:19');

-- --------------------------------------------------------

--
-- Table structure for table `section`
--

CREATE TABLE `section` (
  `section_id` int(11) NOT NULL,
  `section` varchar(7) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `section`
--

INSERT INTO `section` (`section_id`, `section`) VALUES
(1, 'A'),
(2, 'B'),
(3, 'C'),
(4, 'E'),
(5, 'F'),
(6, 'D');

-- --------------------------------------------------------

--
-- Table structure for table `setting`
--

CREATE TABLE `setting` (
  `id` int(11) NOT NULL,
  `current_year` int(11) NOT NULL,
  `current_semester` varchar(11) NOT NULL,
  `school_name` varchar(100) NOT NULL,
  `slogan` varchar(300) NOT NULL,
  `about` text NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `setting`
--

INSERT INTO `setting` (`id`, `current_year`, `current_semester`, `school_name`, `slogan`, `about`) VALUES
(1, 2022, 'II', 'Adan Madrassah', 'Proper Din is a Proper Akhera (Hereafter), by Imam Malik', 'We are a Madrassah(Islamic learning center) located in Eastleigh, Nairobi county, Kenya.\r\nWe offer quality Islamic studies to all and sundry, regardless of their age from nursery level(Raudhah) to secondary level(Mutawasit).');

-- --------------------------------------------------------

--
-- Table structure for table `students`
--

CREATE TABLE `students` (
  `student_id` int(11) NOT NULL,
  `username` varchar(127) NOT NULL,
  `password` varchar(255) NOT NULL,
  `fname` varchar(127) NOT NULL,
  `admission_number` varchar(50) DEFAULT NULL,
  `grade` int(11) NOT NULL,
  `subjects` varchar(100) NOT NULL,
  `address` varchar(31) NOT NULL,
  `gender` varchar(7) NOT NULL,
  `email_address` varchar(255) NOT NULL,
  `date_of_birth` date NOT NULL,
  `date_of_joined` timestamp NULL DEFAULT current_timestamp(),
  `parent_fname` varchar(127) NOT NULL,
  `parent_phone_number` varchar(31) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `students`
--

INSERT INTO `students` (`student_id`, `username`, `password`, `fname`, `admission_number`, `grade`, `subjects`, `address`, `gender`, `email_address`, `date_of_birth`, `date_of_joined`, `parent_fname`, `parent_phone_number`) VALUES
(1, 'ST/001/2018', '$2y$10$pvjhEiEILeGljatS17seVuyctgBIX9U/z2tbYzoa3wqs5.0QvEBm2', 'Nadia Khalid', 'ST/001/2018', 8, '12345678', 'Mombasa,Kenya', 'Female', 'wahabi55@gmail.com', '2007-09-01', '2023-06-25 08:51:56', 'AbdulWahhab Musa', '0734211989'),
(2, 'ST/002/2022', '$2y$10$hwtksS61NBEvWa.6l1IAVeVWtPV0of35vjbrUL0Afr.Toznx0ZPq6', 'Ahmed Faiz', 'ST/002/2022', 2, '123456', 'Nairobi,Kenya', 'Male', 'faziin101@yahoo.com', '2007-04-03', '2023-06-25 08:51:56', 'Faiz Ghalib', '0110454323'),
(3, 'ST/012/2019', '$2y$10$oEQwEs6MryVj6NZvzc9faOoJLeIiO.o4vq..OvHeZLialVyX6Vad6', 'Saud Ali', 'ST/012/2019', 3, '123456', 'Nairobi,Kenya', 'Male', 'saudSaudi@gmail.com', '2005-09-11', '2023-06-25 10:42:54', 'Ali bin Sudi', '0711153211'),
(5, 'ST/011/2019', '$2y$10$E6poKFRbtKo.kj4irZlLvuTvL77Iu7Z/L5fqOC9AQ3clf8LNJufeS', 'Zainab Musa', 'ST/011/2019', 7, '123456', 'Nairobi,Kenya', 'Female', 'zainabMemusa@yahoo.com', '2003-01-20', '2023-06-25 10:52:44', 'Musa Memusa Yunus', '0115709070'),
(6, 'ST/013/2019', '$2y$10$URds4BoxBehAniB13hqbieA5dJbGHBQW5eOTH5dkDAghggZQHuFXq', 'Yunus Mohammed Abdi', 'ST/013/2019', 4, '123456', 'Nairobi,Kenya', 'Male', 'abdiyunus@email.com', '2004-03-02', '2023-06-25 16:22:00', 'Mohamed Abdi', '+254733667721'),
(7, 'ST/014/2018', '$2y$10$l/bt55yX/qdKPIb6fYa7FOaCxXUhcs.K3gOowHlTZeLjuLTaZouiu', 'Suleiman Ramadhan', 'ST/014/2018', 5, '123456', 'Mombasa,Kenya', 'Male', 'sule444@gmail.com', '2003-07-07', '2023-06-25 16:24:17', 'Ramadhan Mustafah', '0110911747'),
(8, 'ST/010/2018', '$2y$10$vdf4qtRRfl8muL8H5QNfKOK5c3rFFMZxitA9JuehY9FZiK6udubzy', 'Mustafah Ramadhan', 'ST/010/2018', 6, '123456', 'Mombasa,Kenya', 'Male', 'musti23@outlook.com', '2002-09-02', '2023-06-25 16:25:56', 'Ramadhan Mustafah', '0110911747'),
(9, 'ST/011/2018', '$2y$10$9GdPq2/BGOoMHqACGH8HC.ozvqjgoeFJwqwgLhPKX8WYRjk57Eeyy', 'Afrah Abdulkarim', 'ST/011/2018', 7, '123456', 'Eastleigh,Kenya', 'Male', 'afrah.abd@email.com', '2002-10-11', '2023-06-25 16:27:50', 'Abdilkarim Abdi', '0711322090'),
(10, 'ST/001/2021', '$2y$10$2NnYhd/yn0JqL.IXAusN7emnNbcy8C5nlPex.QEjrZVDRypxjn03K', 'Abduba Abeid', 'ST/001/2021', 1, '1234', 'Eastleigh,Kenya', 'Male', 'abeid.salim.bashamakh@gmail.com', '2007-12-01', '2023-06-25 19:54:22', 'Abeid Salim Bin Bashamakh', '0735899721'),
(11, 'ST/002/2018', '$2y$10$6yLmWqLAA0DBsgAC.xoSyOPQi2pPF.WTo0yvoz1QONgx37Ibi3Y.y', 'Mohammed Hassan', 'ST/002/2018', 9, '12345678', 'Eastleigh,Kenya', 'Male', 'hassan.moha@gmail.com', '2001-07-07', '2023-06-28 14:27:01', 'Ashraf Anil', '+254741674466');

-- --------------------------------------------------------

--
-- Table structure for table `student_results`
--

CREATE TABLE `student_results` (
  `id` int(11) NOT NULL,
  `semester` varchar(50) DEFAULT NULL,
  `year` int(11) DEFAULT NULL,
  `student_id` int(11) DEFAULT NULL,
  `teacher_id` int(11) DEFAULT NULL,
  `subject_id` int(11) DEFAULT NULL,
  `class_id` int(11) DEFAULT NULL,
  `total` decimal(7,4) DEFAULT NULL,
  `fname` varchar(100) DEFAULT NULL,
  `adm_number` varchar(100) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `student_results`
--

INSERT INTO `student_results` (`id`, `semester`, `year`, `student_id`, `teacher_id`, `subject_id`, `class_id`, `total`, `fname`, `adm_number`) VALUES
(1, 'II', 2021, 1, 1, 1, 1, '75.0000', 'Nadia Khalid', 'ST/010/2023'),
(2, 'III', 2023, 1, 1, 4, 1, '78.0000', 'Nadia Khalid', 'ST/010/2023'),
(3, 'I', 2022, 1, 1, 5, 1, '75.0000', 'Nadia Khalid', 'ST/010/2023'),
(4, 'II', 2022, 1, 3, 1, 1, '59.3750', 'Nadia Khalid', 'ST/010/2023'),
(5, 'II', 2022, 2, 3, 1, 2, '84.1667', 'Ahmed Faiz', 'ST/002/2022'),
(6, 'II', 2022, 2, 3, 2, 2, '60.0000', 'Ahmed Faiz', 'ST/002/2022'),
(7, 'II', 2022, 5, 10, 5, 7, '73.0000', 'Zainab Musa', 'ST/011/2019'),
(8, 'II', 2022, 5, 10, 6, 7, '90.0000', 'Zainab Musa', 'ST/011/2019'),
(9, 'II', 2022, 7, 10, 5, 5, '80.0000', 'Suleiman Ramadhan', 'ST/014/2018'),
(10, 'II', 2022, 8, 10, 5, 6, '85.7143', 'Mustafah Ramadhan', 'ST/010/2018'),
(11, 'II', 2022, 8, 10, 6, 6, '85.0000', 'Mustafah Ramadhan', 'ST/010/2018'),
(12, 'II', 2022, 9, 10, 5, 7, '77.0000', 'Afrah Abdulkarim', 'ST/011/2018'),
(13, 'II', 2022, 9, 10, 6, 7, '90.0000', 'Afrah Abdulkarim', 'ST/011/2018'),
(14, 'II', 2022, 1, 15, 6, 8, '74.0000', 'Nadia Khalid', 'ST/001/2018'),
(15, 'II', 2022, 1, 15, 7, 8, '68.8889', 'Nadia Khalid', 'ST/001/2018'),
(16, 'II', 2022, 11, 15, 6, 9, '92.5000', 'Mohammed Hassan', 'ST/002/2018'),
(17, 'II', 2022, 11, 15, 7, 9, '89.0000', 'Mohammed Hassan', 'ST/002/2018');

-- --------------------------------------------------------

--
-- Table structure for table `student_score`
--

CREATE TABLE `student_score` (
  `id` int(11) NOT NULL,
  `semester` varchar(100) NOT NULL,
  `year` int(11) NOT NULL,
  `student_id` int(11) NOT NULL,
  `teacher_id` int(11) NOT NULL,
  `subject_id` int(11) NOT NULL,
  `results` varchar(512) NOT NULL,
  `fname` varchar(100) DEFAULT NULL,
  `adm_number` varchar(100) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `student_score`
--

INSERT INTO `student_score` (`id`, `semester`, `year`, `student_id`, `teacher_id`, `subject_id`, `results`, `fname`, `adm_number`) VALUES
(1, 'II', 2021, 1, 1, 1, '10 15,15 20,10 10,10 20,30 35', 'Nadia Khalid', 'ST/010/2023'),
(2, 'II', 2023, 1, 1, 4, '15 20,4 5', 'Nadia Khalid', 'ST/010/2023'),
(3, 'I', 2022, 1, 1, 5, '10 20,50 50', 'Nadia Khalid', 'ST/010/2023'),
(4, 'II', 2022, 1, 3, 1, '75 100,30 40,30 50,21 30,20 40', 'Nadia Khalid', 'ST/010/2023'),
(5, 'II', 2022, 2, 3, 1, '34 60,100 100,81 90', 'Ahmed Faiz', 'ST/002/2022'),
(6, 'II', 2022, 2, 3, 2, '36 60', 'Ahmed Faiz', 'ST/002/2022'),
(7, 'II', 2022, 5, 10, 5, '73 100', 'Zainab Musa', 'ST/011/2019'),
(8, 'II', 2022, 5, 10, 6, '72 80', 'Zainab Musa', 'ST/011/2019'),
(9, 'II', 2022, 7, 10, 5, '56 70', 'Suleiman Ramadhan', 'ST/014/2018'),
(10, 'II', 2022, 8, 10, 5, '120 140', 'Mustafah Ramadhan', 'ST/010/2018'),
(11, 'II', 2022, 8, 10, 6, '85 100', 'Mustafah Ramadhan', 'ST/010/2018'),
(12, 'II', 2022, 9, 10, 5, '77 100', 'Afrah Abdulkarim', 'ST/011/2018'),
(13, 'II', 2022, 9, 10, 6, '81 90', 'Afrah Abdulkarim', 'ST/011/2018'),
(14, 'II', 2022, 1, 15, 6, '74 100', 'Nadia Khalid', 'ST/001/2018'),
(15, 'II', 2022, 1, 15, 7, '62 90', 'Nadia Khalid', 'ST/001/2018'),
(16, 'II', 2022, 11, 15, 6, '74 80', 'Mohammed Hassan', 'ST/002/2018'),
(17, 'II', 2022, 11, 15, 7, '89 100', 'Mohammed Hassan', 'ST/002/2018');

-- --------------------------------------------------------

--
-- Table structure for table `subjects`
--

CREATE TABLE `subjects` (
  `subject_id` int(11) NOT NULL,
  `subject` varchar(31) NOT NULL,
  `subject_code` varchar(31) NOT NULL,
  `grade` varchar(50) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `subjects`
--

INSERT INTO `subjects` (`subject_id`, `subject`, `subject_code`, `grade`) VALUES
(1, 'Quran', 'Qrn', '123456789'),
(2, 'Hadith', 'Hdth', '123456789'),
(3, 'Arabic Grammar', 'Grmr', '1234'),
(4, 'Hisaab', 'Hsb', '1234'),
(5, 'Islamic History', 'Isl-Hist', '56789'),
(6, 'Islamic shariah', 'Fiqh', '56789'),
(7, 'Swarf', 'Swf', '89'),
(8, 'Nahw', 'Nhw', '89');

-- --------------------------------------------------------

--
-- Table structure for table `teachers`
--

CREATE TABLE `teachers` (
  `teacher_id` int(11) NOT NULL,
  `username` varchar(127) NOT NULL,
  `password` varchar(255) NOT NULL,
  `grades` varchar(31) NOT NULL,
  `fname` varchar(127) NOT NULL,
  `national_id` varchar(100) DEFAULT NULL,
  `subjects` varchar(31) NOT NULL,
  `address` varchar(50) NOT NULL,
  `employee_number` varchar(50) DEFAULT NULL,
  `date_of_birth` date DEFAULT NULL,
  `phone_number` varchar(31) NOT NULL,
  `gender` varchar(7) NOT NULL,
  `email_address` varchar(255) NOT NULL,
  `date_of_joined` datetime NOT NULL DEFAULT current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `teachers`
--

INSERT INTO `teachers` (`teacher_id`, `username`, `password`, `grades`, `fname`, `national_id`, `subjects`, `address`, `employee_number`, `date_of_birth`, `phone_number`, `gender`, `email_address`, `date_of_joined`) VALUES
(1, 'TC/001/2018', '$2y$10$GnatnQ6eo.u6pP.2bqDSTOPpoMKnRJ1gwmdTTvBPwEB5cZuX6CYIC', '8', 'Hamza Muheedin', '11246683', '67', 'Nairobi,Kenya', 'TC/001/2018', '1992-06-02', '0722123878', 'Male', 'hamza423diin@yahoo.com', '2018-06-02 21:25:59'),
(2, 'TC/002/2018', '$2y$10$Q.QGEVCnaVIdktM5tJcUzOFDtLsTEjwjbJkweKd0g11OE03l2w6om', '9', 'Abu Abbas', '20930211', '8', 'Juja,Kiambu', 'TC/002/2018', '1994-08-04', '0726788141', 'Male', 'abu555abaa@gmail.com', '2018-06-24 22:18:49'),
(3, 'TC/003/2018', '$2y$10$a53WzOfgz0bk9vu57Ekyfefe1D5e5pOowOtnb3D3Ba2VfvF8cBrDW', '12', 'Hafswa Abdikadir', '11289091', '12', 'Eastleigh,Kenya', 'TC/003/2018', '1998-04-05', '0721909003', 'Female', 'hafswa342@gmail.com', '2018-06-25 10:55:13'),
(4, 'TC/004/2018', '$2y$10$GnatnQ6eo.u6pP.2bqDSTOPpoMKnRJ1gwmdTTvBPwEB5cZuX6CYIC', '12', 'Mariam Hussein', '12442122', '34', 'Mombasa,Kenya', 'TC/004/2018', '1995-09-01', '0710110211', 'Female', 'mariammia@email.com', '2018-11-01 11:59:07'),
(5, 'TC/006/2018', '$2y$10$GnatnQ6eo.u6pP.2bqDSTOPpoMKnRJ1gwmdTTvBPwEB5cZuX6CYIC', '2', 'Juma Ali', '211001567', '456', 'Kilfi,Kenya', 'TC/006/2018', '1994-11-02', '0733933885', 'Male', 'juma7j@email.com', '2018-11-10 09:12:11'),
(6, 'TC/007/2018', '$2y$10$GnatnQ6eo.u6pP.2bqDSTOPpoMKnRJ1gwmdTTvBPwEB5cZuX6CYIC', '34', 'Afrah Hussein', '14488076', '124', 'Nairobi,Kenya', 'TC/007/2018', '1997-12-12', '0733889001', 'Male', 'husseinafrah92@gmail.com', '2018-05-03 12:12:12'),
(7, 'TC/003/2019', '$2y$10$GnatnQ6eo.u6pP.2bqDSTOPpoMKnRJ1gwmdTTvBPwEB5cZuX6CYIC', '34', 'Husna Shebe', '13131166', '5', 'Lamu,Kenya', 'TC/003/2019', '1998-04-07', '0733909001', 'Female', 'shebe.she@email.com', '2019-06-02 21:25:59'),
(8, 'TC/006/2019 ', '$2y$10$GnatnQ6eo.u6pP.2bqDSTOPpoMKnRJ1gwmdTTvBPwEB5cZuX6CYIC', '34', 'Yusin Adan', '211987652', '36', 'Eastleigh,Kenya', 'TC/006/2019', '1997-11-02', '0745611101', 'Male', 'netflixaddict@gmail.com', '2019-11-10 09:12:11'),
(9, 'TC/001/2019', '$2y$10$lUSoheUwcXcjDYTm8lMWlOBvyghtZr.tNs4lJwVfRH7WZQBfQFLjS', '567', 'Amir Shebe', '30199001', '123', 'Malindi,Kenya', 'TC/001/2019', '1995-08-01', '0710889211', 'Male', 'amir.waraa@yahoo.com', '2019-06-02 21:25:59'),
(10, 'TC/002/2019', '$2y$10$iwLr6QREh8yWI2DChKkPd.Pw05EFmIKvoGqG5nR9b/dyhrOu4JOLK', '567', 'Abdulrazzaq Abdu', '32112197', '567', 'Mombasa,Kenya', 'TC/002/2019', '1994-11-02', '0733090885', 'Male', 'abduballer@gmail.com', '2019-11-10 09:12:11'),
(11, 'TC/009/2019', '$2y$10$czRkC4GCvDTAFyP1dPFFYuNx0lPMpbl1yKj.DpD4UdqL27jACg.Di', '89', 'Aisha Abdulwahhab', '39922231', '123', 'Mombasa,Kenya', 'TC/009/2019', '1998-04-05', '0721909878', 'Female', 'ayesha32@outlook.com', '2019-06-02 21:25:59'),
(12, 'TC/010/2019', '$2y$10$GnatnQ6eo.u6pP.2bqDSTOPpoMKnRJ1gwmdTTvBPwEB5cZuX6CYIC', '89', 'Khalid Ali Mehbub', '29931662', '45', 'Eastleigh,Kenya', 'TC/010/2019', '1997-11-10', '0745611101', 'Male', 'mehu34ele@gmail.com', '2019-11-10 09:12:11'),
(14, 'TC/011/2020', '$2y$10$6m05q.QRxGrHSUhKPMirVuBgsdeKJ7I5XqSRaw2tmysxS5F0SA7A6', '9', 'Zakariah Husni', '22290112', '78', 'Mombasa,Kenya', 'TC/011/2020', '1997-03-18', '0735933455', 'Male', 'zaks23@gmail.com', '2023-06-25 12:26:33'),
(15, 'TC/002/2022', '$2y$10$HyXXCu2e2osf5NWrfO3p5e1OajaxiJc81v4o7KgtfU13yb7/aKKAS', '89', 'Mwanajuma Shee', '27789090', '67', 'Lamu, Kenya', 'TC/002/2022', '1996-07-03', '+254712889070', 'Female', 'shee.mwanajuma@yahoo.com', '2023-06-25 23:16:06');

--
-- Indexes for dumped tables
--

--
-- Indexes for table `admin`
--
ALTER TABLE `admin`
  ADD PRIMARY KEY (`admin_id`),
  ADD UNIQUE KEY `username` (`username`);

--
-- Indexes for table `class`
--
ALTER TABLE `class`
  ADD PRIMARY KEY (`class_id`);

--
-- Indexes for table `grades`
--
ALTER TABLE `grades`
  ADD PRIMARY KEY (`grade_id`);

--
-- Indexes for table `message`
--
ALTER TABLE `message`
  ADD PRIMARY KEY (`message_id`);

--
-- Indexes for table `registrar_office`
--
ALTER TABLE `registrar_office`
  ADD PRIMARY KEY (`r_user_id`);

--
-- Indexes for table `section`
--
ALTER TABLE `section`
  ADD PRIMARY KEY (`section_id`);

--
-- Indexes for table `setting`
--
ALTER TABLE `setting`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `students`
--
ALTER TABLE `students`
  ADD PRIMARY KEY (`student_id`),
  ADD UNIQUE KEY `username` (`username`),
  ADD UNIQUE KEY `admission_number` (`admission_number`);

--
-- Indexes for table `student_results`
--
ALTER TABLE `student_results`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `student_score`
--
ALTER TABLE `student_score`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `subjects`
--
ALTER TABLE `subjects`
  ADD PRIMARY KEY (`subject_id`);

--
-- Indexes for table `teachers`
--
ALTER TABLE `teachers`
  ADD PRIMARY KEY (`teacher_id`),
  ADD UNIQUE KEY `username` (`username`),
  ADD UNIQUE KEY `national_id` (`national_id`),
  ADD UNIQUE KEY `employee_number` (`employee_number`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `admin`
--
ALTER TABLE `admin`
  MODIFY `admin_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2;

--
-- AUTO_INCREMENT for table `class`
--
ALTER TABLE `class`
  MODIFY `class_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=7;

--
-- AUTO_INCREMENT for table `grades`
--
ALTER TABLE `grades`
  MODIFY `grade_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=10;

--
-- AUTO_INCREMENT for table `message`
--
ALTER TABLE `message`
  MODIFY `message_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=5;

--
-- AUTO_INCREMENT for table `registrar_office`
--
ALTER TABLE `registrar_office`
  MODIFY `r_user_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=6;

--
-- AUTO_INCREMENT for table `section`
--
ALTER TABLE `section`
  MODIFY `section_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=7;

--
-- AUTO_INCREMENT for table `setting`
--
ALTER TABLE `setting`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2;

--
-- AUTO_INCREMENT for table `students`
--
ALTER TABLE `students`
  MODIFY `student_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=12;

--
-- AUTO_INCREMENT for table `student_results`
--
ALTER TABLE `student_results`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=18;

--
-- AUTO_INCREMENT for table `student_score`
--
ALTER TABLE `student_score`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=18;

--
-- AUTO_INCREMENT for table `subjects`
--
ALTER TABLE `subjects`
  MODIFY `subject_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=11;

--
-- AUTO_INCREMENT for table `teachers`
--
ALTER TABLE `teachers`
  MODIFY `teacher_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=16;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
