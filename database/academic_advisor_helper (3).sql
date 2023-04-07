-- phpMyAdmin SQL Dump
-- version 5.2.0
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Generation Time: Apr 07, 2023 at 04:07 AM
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
-- Database: `academic_advisor_helper`
--

-- --------------------------------------------------------

--
-- Table structure for table `table_advisors`
--

CREATE TABLE `table_advisors` (
  `Id_Advisor` int(11) NOT NULL,
  `Name_Advisor` varchar(100) NOT NULL,
  `Email_Advisor` varchar(100) NOT NULL,
  `Phone_Number` varchar(13) NOT NULL,
  `Office_Room` varchar(30) NOT NULL,
  `Id_Dept` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `table_advisors`
--

INSERT INTO `table_advisors` (`Id_Advisor`, `Name_Advisor`, `Email_Advisor`, `Phone_Number`, `Office_Room`, `Id_Dept`) VALUES
(999, 'سارة احمد', 'sa.qalfozan@ju.edu.sa', '09999999999', '999', 1),
(565412, 'سارة احمد الفوزان', 'sa.alfozan@ju.edu.sa', '9999999999', 'ج101 ', 1);

-- --------------------------------------------------------

--
-- Table structure for table `table_courses`
--

CREATE TABLE `table_courses` (
  `Id_Course` int(11) NOT NULL,
  `Course_Code` char(10) NOT NULL,
  `Name_Course` varchar(30) NOT NULL,
  `Hour_Credit` int(3) NOT NULL,
  `short_description` mediumtext NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `table_courses`
--

INSERT INTO `table_courses` (`Id_Course`, `Course_Code`, `Name_Course`, `Hour_Credit`, `short_description`) VALUES
(1, 'ENG 001', 'English language(1)', 3, 'learning essential English language '),
(2, 'CIS 101', 'Computer Skill', 3, ''),
(3, 'EDU 101', 'University life Skills', 2, ' '),
(4, 'ENGL 002', 'English language(2)', 4, ''),
(5, 'CIS 102', 'Problem Solving and Programing', 3, ' '),
(6, 'MTH 101', 'Introduction Mathematics', 3, ''),
(7, 'ENGL 003', 'English languag(3)', 4, ' '),
(8, 'CHM 103', 'Principle of Chemistry', 3, ''),
(9, 'MTH 102', 'Differential Calculus', 3, ' '),
(10, 'ISL 101', 'Fundamentals of Islamic Cultur', 2, ''),
(11, 'CIS 203', 'Computer programming(1)', 4, ' '),
(12, 'CIS 211', 'Discrete Maths', 3, ''),
(13, 'MTH 203', 'Integral Calculus', 3, ' '),
(14, 'PHS 101', 'General Physics(1)', 4, ''),
(15, 'CNE 261', 'Logic Design', 4, ' '),
(16, 'CIS 204', 'Computer Programming(2)', 4, ''),
(17, 'ARB 100', 'Arabic Language Skills', 2, ' '),
(18, 'PHS 102', 'General Physics(2)', 4, ''),
(19, 'SWE 201', 'Introduction to Software Engin', 3, ' '),
(20, 'MTH 204', 'Advanced Calculus', 4, ''),
(40, 'ISL 100', 'Studies in the Biography of th', 3, ''),
(41, 'MTH 285', 'Principle of Linear Algebra', 3, ''),
(42, 'SWE 321', 'Software Requirement Engineeri', 3, ''),
(43, 'CIS 205', 'Data Structures', 4, ''),
(44, 'CIS 343', ' Computer Organization', 3, ''),
(45, 'MTH 281', 'Probabilities and Statistics', 3, ''),
(46, 'SWE 342', 'Software Project Managment', 3, ''),
(47, 'SWE 322', 'Software Design and Architectu', 3, ''),
(48, 'ISL 108', 'Contemporary Issues', 2, ''),
(49, 'CIS 322', 'Concepts of Database Systems', 4, ''),
(50, 'CIS 342', 'Operating System', 3, ''),
(51, 'SWE 341', 'Software Testing and Quality A', 3, ''),
(52, 'ARB 102', 'Writing Skills', 2, ''),
(53, 'SWE 441', 'Software Maintenance and Evalu', 3, ''),
(54, 'CNE 436', 'Computer Networks', 3, ''),
(55, 'CIS 414', 'Algorithms Design and Analysis', 3, ''),
(56, 'ISL 107', 'Professional Ethics', 2, ''),
(57, 'BUS 101', 'Work Volunteer', 2, ''),
(58, 'SWE 419', '(1)Graduation Project', 2, ''),
(59, 'SWE 421', 'User Interface Design', 3, ''),
(60, 'ELC 1', 'Elective course 1', 3, ''),
(61, 'SWE 481', 'Software Security', 3, ''),
(62, 'SWE 492', '(2)Graduation Project', 3, ''),
(63, 'ELC 2', 'Elective course 2', 3, ''),
(64, 'ELC 3', 'Elective course 3', 3, '');

-- --------------------------------------------------------

--
-- Table structure for table `table_department`
--

CREATE TABLE `table_department` (
  `Id_Dept` int(11) NOT NULL,
  `Code_Dept` char(11) NOT NULL,
  `Name_Dept` varchar(30) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `table_department`
--

INSERT INTO `table_department` (`Id_Dept`, `Code_Dept`, `Name_Dept`) VALUES
(1, 'SWE', 'هندسة البرمجيات'),
(3, 'ACC', 'محاسبة');

-- --------------------------------------------------------

--
-- Table structure for table `table_grades`
--

CREATE TABLE `table_grades` (
  `Id_Student` int(11) NOT NULL,
  `Id_Level` int(11) NOT NULL,
  `Id_Course` int(11) NOT NULL,
  `Grade` float NOT NULL,
  `Letter_Grade` char(2) NOT NULL,
  `Grade_Point` float NOT NULL,
  `Course_State` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `table_grades`
--

INSERT INTO `table_grades` (`Id_Student`, `Id_Level`, `Id_Course`, `Grade`, `Letter_Grade`, `Grade_Point`, `Course_State`) VALUES
(401204999, 5, 1, 90, 'A', 4.5, 0),
(401204999, 5, 2, 80, 'B', 4, 0),
(401204999, 5, 3, 90, 'A', 4.5, 0),
(401204999, 6, 4, 90, 'A', 4.5, 0),
(401204999, 6, 6, 90, 'A', 4.5, 0),
(401204999, 6, 5, 90, 'A', 4.5, 0),
(401204999, 7, 7, 80, 'B', 4, 0),
(401204999, 7, 8, 90, 'A', 4.5, 0),
(401204999, 7, 9, 80, 'B', 4, 0),
(401204999, 8, 10, 90, 'A', 4.5, 0),
(401204999, 8, 11, 80, 'B', 4, 0),
(401204999, 8, 12, 90, 'A', 4.5, 0);

-- --------------------------------------------------------

--
-- Table structure for table `table_header_program_study_plan`
--

CREATE TABLE `table_header_program_study_plan` (
  `Id_Plan` int(12) NOT NULL,
  `Name_Plan` varchar(30) NOT NULL,
  `Date_create` date NOT NULL,
  `Id_Dept` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `table_header_program_study_plan`
--

INSERT INTO `table_header_program_study_plan` (`Id_Plan`, `Name_Plan`, `Date_create`, `Id_Dept`) VALUES
(2, 'plan 2023', '2023-03-22', 1),
(3, 'plan2', '2023-03-03', 3),
(4, 'خطة2030', '2023-03-26', 1),
(5, 'رؤية 2030', '2023-04-06', 1),
(6, 'رؤية 2031', '2023-05-04', 1),
(7, '2040', '2023-03-26', 1),
(8, 'رؤية2031', '2023-03-26', 1),
(9, 'غغغغ', '2023-04-25', 1);

-- --------------------------------------------------------

--
-- Table structure for table `table_levels`
--

CREATE TABLE `table_levels` (
  `Id_Level` int(11) NOT NULL,
  `Name_Level` varchar(20) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `table_levels`
--

INSERT INTO `table_levels` (`Id_Level`, `Name_Level`) VALUES
(12, ' Eighth level'),
(8, ' Forth level'),
(6, ' Second level'),
(10, ' Sixth level'),
(16, ' Twelfth level'),
(15, 'Eleventh level'),
(9, 'Fifth level'),
(5, 'First level'),
(13, 'Ninth level'),
(11, 'Seventh level'),
(14, 'Tenth level'),
(7, 'Third level');

-- --------------------------------------------------------

--
-- Table structure for table `table_links`
--

CREATE TABLE `table_links` (
  `Id_Student` int(11) NOT NULL,
  `Id_Advisor` int(11) NOT NULL,
  `link_date` date NOT NULL,
  `Status_Join` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `table_links`
--

INSERT INTO `table_links` (`Id_Student`, `Id_Advisor`, `link_date`, `Status_Join`) VALUES
(401204999, 565412, '2023-03-31', 1),
(421205425, 565412, '2023-04-01', 1);

-- --------------------------------------------------------

--
-- Table structure for table `table_program_study_plan`
--

CREATE TABLE `table_program_study_plan` (
  `SN` int(11) NOT NULL,
  `Id_Course` int(10) NOT NULL,
  `Hour_Plan_Credit` int(11) NOT NULL,
  `Course_Type` int(11) NOT NULL,
  `Id_level` int(11) NOT NULL,
  `Id_Plan` int(12) NOT NULL,
  `pre_requisites` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_general_ci;

--
-- Dumping data for table `table_program_study_plan`
--

INSERT INTO `table_program_study_plan` (`SN`, `Id_Course`, `Hour_Plan_Credit`, `Course_Type`, `Id_level`, `Id_Plan`, `pre_requisites`) VALUES
(1, 1, 4, 1, 5, 4, 0),
(1, 1, 4, 1, 5, 5, 0),
(1, 1, 4, 1, 5, 6, 0),
(1, 1, 4, 1, 5, 8, 0),
(2, 2, 3, 1, 5, 5, 0),
(1, 2, 5, 1, 5, 7, 0),
(2, 2, 3, 1, 5, 8, 0),
(3, 3, 3, 1, 5, 5, 0),
(3, 4, 4, 1, 6, 4, 0),
(1, 4, 5, 1, 5, 9, 0),
(4, 5, 3, 1, 6, 4, 0),
(5, 7, 4, 1, 7, 4, 4),
(6, 10, 2, 1, 8, 4, 0),
(3, 64, 3, 1, 16, 8, 0);

-- --------------------------------------------------------

--
-- Table structure for table `table_students`
--

CREATE TABLE `table_students` (
  `Id_Student` int(11) NOT NULL,
  `Name_Student` varchar(100) NOT NULL,
  `Gender_Student` int(1) NOT NULL,
  `Date_Birth` date NOT NULL,
  `Phone_Student` varchar(15) NOT NULL,
  `Email_Student` varchar(100) NOT NULL,
  `Id_Dept` int(11) NOT NULL,
  `Id_Plan` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `table_students`
--

INSERT INTO `table_students` (`Id_Student`, `Name_Student`, `Gender_Student`, `Date_Birth`, `Phone_Student`, `Email_Student`, `Id_Dept`, `Id_Plan`) VALUES
(401204999, 'نوره محمد سعيد الذياب', 2, '1422-05-20', '0509033912', '401204999@ju.edu.sa', 1, 2),
(421205425, 'ملاك تركي خالد', 2, '2023-03-26', '0530244747', '421205425@ju.edu.sa', 1, 7);

-- --------------------------------------------------------

--
-- Table structure for table `table_student_study_plan_progress`
--

CREATE TABLE `table_student_study_plan_progress` (
  `stu_id` int(11) NOT NULL,
  `cou_passed` int(11) NOT NULL,
  `cou_remaining` int(11) NOT NULL,
  `hou_plan` int(11) NOT NULL,
  `hou_passed` int(11) NOT NULL,
  `hou_remaining` int(11) NOT NULL,
  `stu_level` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

-- --------------------------------------------------------

--
-- Table structure for table `table_users`
--

CREATE TABLE `table_users` (
  `u_id` int(11) NOT NULL,
  `username` varchar(30) NOT NULL,
  `password` varchar(30) NOT NULL,
  `u_type` int(11) NOT NULL,
  `ref_join` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `table_users`
--

INSERT INTO `table_users` (`u_id`, `username`, `password`, `u_type`, `ref_join`) VALUES
(0, 'admin', '12345', 1, 0),
(0, 'sarah', '12345', 2, 0),
(0, 'ahmed', '12345', 3, 0);

--
-- Indexes for dumped tables
--

--
-- Indexes for table `table_advisors`
--
ALTER TABLE `table_advisors`
  ADD PRIMARY KEY (`Id_Advisor`),
  ADD UNIQUE KEY `u_niq_email` (`Email_Advisor`),
  ADD UNIQUE KEY `u_phone` (`Phone_Number`),
  ADD KEY `f_k_dept` (`Id_Dept`);

--
-- Indexes for table `table_courses`
--
ALTER TABLE `table_courses`
  ADD PRIMARY KEY (`Id_Course`),
  ADD UNIQUE KEY `Course_Code` (`Course_Code`),
  ADD UNIQUE KEY `Name_Course` (`Name_Course`);

--
-- Indexes for table `table_department`
--
ALTER TABLE `table_department`
  ADD PRIMARY KEY (`Id_Dept`),
  ADD UNIQUE KEY `Code_Dept` (`Code_Dept`);

--
-- Indexes for table `table_grades`
--
ALTER TABLE `table_grades`
  ADD KEY `f_k_student` (`Id_Student`),
  ADD KEY `f_k_levels` (`Id_Level`),
  ADD KEY `f_k_course` (`Id_Course`);

--
-- Indexes for table `table_header_program_study_plan`
--
ALTER TABLE `table_header_program_study_plan`
  ADD PRIMARY KEY (`Id_Plan`),
  ADD UNIQUE KEY `Name_Plan` (`Name_Plan`),
  ADD KEY `f_key_dept` (`Id_Dept`);

--
-- Indexes for table `table_levels`
--
ALTER TABLE `table_levels`
  ADD PRIMARY KEY (`Id_Level`),
  ADD UNIQUE KEY `l_u` (`Name_Level`);

--
-- Indexes for table `table_links`
--
ALTER TABLE `table_links`
  ADD PRIMARY KEY (`Id_Student`),
  ADD KEY `Id_Advisor` (`Id_Advisor`);

--
-- Indexes for table `table_program_study_plan`
--
ALTER TABLE `table_program_study_plan`
  ADD PRIMARY KEY (`Id_Course`,`Id_Plan`),
  ADD KEY `f_key_course` (`Id_Course`),
  ADD KEY `f_key_levels` (`Id_level`),
  ADD KEY `f_key_plan` (`Id_Plan`);

--
-- Indexes for table `table_students`
--
ALTER TABLE `table_students`
  ADD PRIMARY KEY (`Id_Student`),
  ADD UNIQUE KEY `phone_no` (`Phone_Student`),
  ADD UNIQUE KEY `s_email` (`Email_Student`),
  ADD KEY `f_k__s_dept` (`Id_Dept`),
  ADD KEY `f_k_id_plan` (`Id_Plan`);

--
-- Indexes for table `table_users`
--
ALTER TABLE `table_users`
  ADD PRIMARY KEY (`ref_join`,`u_type`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `table_courses`
--
ALTER TABLE `table_courses`
  MODIFY `Id_Course` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=66;

--
-- AUTO_INCREMENT for table `table_department`
--
ALTER TABLE `table_department`
  MODIFY `Id_Dept` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=4;

--
-- AUTO_INCREMENT for table `table_levels`
--
ALTER TABLE `table_levels`
  MODIFY `Id_Level` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=19;

--
-- Constraints for dumped tables
--

--
-- Constraints for table `table_grades`
--
ALTER TABLE `table_grades`
  ADD CONSTRAINT `f_k_course` FOREIGN KEY (`Id_Course`) REFERENCES `table_courses` (`Id_Course`),
  ADD CONSTRAINT `f_k_levels` FOREIGN KEY (`Id_Level`) REFERENCES `table_levels` (`Id_Level`),
  ADD CONSTRAINT `f_k_student` FOREIGN KEY (`Id_Student`) REFERENCES `table_students` (`Id_Student`);

--
-- Constraints for table `table_header_program_study_plan`
--
ALTER TABLE `table_header_program_study_plan`
  ADD CONSTRAINT `f_key_dept` FOREIGN KEY (`Id_Dept`) REFERENCES `table_department` (`Id_Dept`);

--
-- Constraints for table `table_links`
--
ALTER TABLE `table_links`
  ADD CONSTRAINT `table_links_ibfk_1` FOREIGN KEY (`Id_Student`) REFERENCES `table_students` (`Id_Student`),
  ADD CONSTRAINT `table_links_ibfk_2` FOREIGN KEY (`Id_Advisor`) REFERENCES `table_advisors` (`Id_Advisor`);

--
-- Constraints for table `table_program_study_plan`
--
ALTER TABLE `table_program_study_plan`
  ADD CONSTRAINT `f_key_course` FOREIGN KEY (`Id_Course`) REFERENCES `table_courses` (`Id_Course`),
  ADD CONSTRAINT `f_key_levels` FOREIGN KEY (`Id_level`) REFERENCES `table_levels` (`Id_Level`),
  ADD CONSTRAINT `f_key_plan` FOREIGN KEY (`Id_Plan`) REFERENCES `table_header_program_study_plan` (`Id_Plan`);

--
-- Constraints for table `table_students`
--
ALTER TABLE `table_students`
  ADD CONSTRAINT `f_k__s_dept` FOREIGN KEY (`Id_Dept`) REFERENCES `table_department` (`Id_Dept`),
  ADD CONSTRAINT `f_k_id_plan` FOREIGN KEY (`Id_Plan`) REFERENCES `table_header_program_study_plan` (`Id_Plan`);
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
