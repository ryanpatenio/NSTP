-- phpMyAdmin SQL Dump
-- version 4.7.0
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Generation Time: Mar 10, 2022 at 09:17 AM
-- Server version: 10.1.26-MariaDB
-- PHP Version: 7.1.8

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
SET AUTOCOMMIT = 0;
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `nstpport`
--

-- --------------------------------------------------------

--
-- Table structure for table `acad_year`
--

CREATE TABLE `acad_year` (
  `ACAD_ID` int(11) NOT NULL,
  `SCHOOL_YEAR` varchar(100) NOT NULL,
  `SEMESTER` varchar(50) NOT NULL,
  `STATUS` varchar(100) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `acad_year`
--

INSERT INTO `acad_year` (`ACAD_ID`, `SCHOOL_YEAR`, `SEMESTER`, `STATUS`) VALUES
(1, '2021-2022', 'FIRST', 'YES'),
(2, '2021-2022', 'SECOND', 'NO'),
(3, '2022-2023', 'FIRST', 'NO');

-- --------------------------------------------------------

--
-- Table structure for table `announcement`
--

CREATE TABLE `announcement` (
  `ANN_ID` int(11) NOT NULL,
  `CLASS_ID` int(11) NOT NULL DEFAULT '0',
  `ACAD_ID` int(11) NOT NULL DEFAULT '0',
  `CONTENT` varchar(200) NOT NULL DEFAULT '0',
  `ANN_DATE` date NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `announcement`
--

INSERT INTO `announcement` (`ANN_ID`, `CLASS_ID`, `ACAD_ID`, `CONTENT`, `ANN_DATE`) VALUES
(1, 1, 1, 'good afternoon students\r\nmay hiwaton ta bwas na feeding program sa school to all officers of CWTS BSIT 1-1 your attendance is a must', '2022-03-08');

-- --------------------------------------------------------

--
-- Table structure for table `assign_module`
--

CREATE TABLE `assign_module` (
  `ASSIGN_ID` int(11) NOT NULL,
  `IDNO` varchar(100) NOT NULL DEFAULT '0',
  `MOD_ID` int(50) NOT NULL DEFAULT '0',
  `CLASS_ID` int(50) NOT NULL DEFAULT '0',
  `ACAD_ID` int(50) NOT NULL DEFAULT '0',
  `STATUS` int(50) NOT NULL DEFAULT '0'
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `assign_module`
--

INSERT INTO `assign_module` (`ASSIGN_ID`, `IDNO`, `MOD_ID`, `CLASS_ID`, `ACAD_ID`, `STATUS`) VALUES
(6, 'PRA100699', 4, 1, 1, 0),
(7, 'JSM10068800', 4, 1, 1, 0),
(8, 'HSN20293992', 4, 2, 1, 0),
(9, 'GSM293981', 4, 2, 1, 0),
(10, 'KLM1992883', 4, 4, 1, 0),
(11, 'SMB1003882', 4, 4, 1, 0),
(12, 'PRA100699', 5, 1, 1, 0),
(13, 'JSM10068800', 5, 1, 1, 0),
(14, 'HSN20293992', 5, 2, 1, 0),
(15, 'GSM293981', 5, 2, 1, 0),
(16, 'KLM1992883', 5, 4, 1, 0),
(17, 'SMB1003882', 5, 4, 1, 0);

-- --------------------------------------------------------

--
-- Table structure for table `attendance`
--

CREATE TABLE `attendance` (
  `ATT_ID` int(11) NOT NULL,
  `CLASS_SCHED_ID` int(50) NOT NULL DEFAULT '0',
  `IDNO` varchar(100) NOT NULL DEFAULT '0',
  `ACAD_ID` int(50) NOT NULL DEFAULT '0',
  `STATUS` varchar(50) NOT NULL DEFAULT '0'
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `attendance`
--

INSERT INTO `attendance` (`ATT_ID`, `CLASS_SCHED_ID`, `IDNO`, `ACAD_ID`, `STATUS`) VALUES
(1, 1, 'JMA298388', 1, 'Absent'),
(2, 2, 'JMA298388', 1, 'Present'),
(3, 3, 'PRA100699', 1, 'Present'),
(4, 3, 'JSM10068800', 1, 'Present'),
(5, 4, 'PRA100699', 1, 'Present'),
(6, 4, 'JSM10068800', 1, 'Absent');

-- --------------------------------------------------------

--
-- Table structure for table `autocode`
--

CREATE TABLE `autocode` (
  `AUTO_ID` int(11) NOT NULL,
  `START` int(11) NOT NULL DEFAULT '0',
  `END` int(11) NOT NULL DEFAULT '0',
  `INCREMENT` int(11) NOT NULL DEFAULT '0',
  `DESCRIPTION` varchar(50) NOT NULL DEFAULT '0'
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `autocode`
--

INSERT INTO `autocode` (`AUTO_ID`, `START`, `END`, `INCREMENT`, `DESCRIPTION`) VALUES
(1, 100, 6, 1, 'SEC'),
(2, 100, 7, 1, 'CLASS');

-- --------------------------------------------------------

--
-- Table structure for table `class`
--

CREATE TABLE `class` (
  `CLASS_ID` int(11) NOT NULL,
  `CLASS_CODE` varchar(100) NOT NULL DEFAULT '0',
  `CLASS_NAME` varchar(100) NOT NULL DEFAULT '0',
  `INST_ID` varchar(100) NOT NULL DEFAULT '0'
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `class`
--

INSERT INTO `class` (`CLASS_ID`, `CLASS_CODE`, `CLASS_NAME`, `INST_ID`) VALUES
(1, '101-CLASS', 'CWTS BSIT 1-1', '1'),
(2, '102-CLASS', 'CWTS BSIT 1-2', '1'),
(3, '103-CLASS', 'CWTS BSIT 1-3', '8'),
(4, '104-CLASS', 'CWTS BSIT 1-4', '1'),
(5, '105-CLASS', 'CWTS IRREGULAR', '0'),
(6, '106-CLASS', 'LTS IRREGULAR', '0');

-- --------------------------------------------------------

--
-- Table structure for table `class_sched`
--

CREATE TABLE `class_sched` (
  `CLASS_SCHED_ID` int(11) NOT NULL,
  `CLASS_ID` int(100) NOT NULL DEFAULT '0',
  `SESS_DATE` date NOT NULL,
  `TOPIC` varchar(100) NOT NULL DEFAULT '0',
  `ACAD_ID` int(50) NOT NULL DEFAULT '0',
  `STATUS` varchar(50) NOT NULL DEFAULT '0'
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `class_sched`
--

INSERT INTO `class_sched` (`CLASS_SCHED_ID`, `CLASS_ID`, `SESS_DATE`, `TOPIC`, `ACAD_ID`, `STATUS`) VALUES
(3, 1, '2022-03-29', 'Environtmental Issue', 1, 'DONE'),
(4, 1, '2022-03-26', 'Self Awareness', 1, 'DONE'),
(5, 2, '2022-03-24', 'Environtmental Issue', 1, 'UNDONE'),
(6, 2, '2022-03-26', 'Self Awareness', 1, 'UNDONE');

-- --------------------------------------------------------

--
-- Table structure for table `course`
--

CREATE TABLE `course` (
  `COURSE_ID` int(11) NOT NULL,
  `COURSE_NAME` varchar(100) NOT NULL DEFAULT '0',
  `COURSE_DESC` varchar(100) NOT NULL DEFAULT '0'
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `course`
--

INSERT INTO `course` (`COURSE_ID`, `COURSE_NAME`, `COURSE_DESC`) VALUES
(1, 'BSIT', 'Bachelor of Science in information Technology'),
(2, 'BSFI', 'Bachelor of Science in Fisheries'),
(3, 'BS-CRIM', 'Bachelor of Science in Criminology'),
(4, 'BEED', 'Bachelor of Science in Elementary Education'),
(5, 'BTLED', 'Bachelor of Technology and Livelihood Education'),
(6, 'BSED', 'Bachelor of Science in Education'),
(7, 'BSBA', 'Bachelor of Science in Business Administration');

-- --------------------------------------------------------

--
-- Table structure for table `drop_students`
--

CREATE TABLE `drop_students` (
  `DROP_ID` int(11) NOT NULL,
  `IDNO` varchar(100) NOT NULL DEFAULT '0',
  `CLASS_ID` int(50) NOT NULL DEFAULT '0',
  `ACAD_ID` int(50) NOT NULL DEFAULT '0',
  `REASON` varchar(100) NOT NULL DEFAULT '0',
  `STATUS` varchar(50) NOT NULL DEFAULT '0'
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `drop_students`
--

INSERT INTO `drop_students` (`DROP_ID`, `IDNO`, `CLASS_ID`, `ACAD_ID`, `REASON`, `STATUS`) VALUES
(2, 'KLM1992883', 4, 1, 'wala na ga sulod2', 'DROP');

-- --------------------------------------------------------

--
-- Table structure for table `enrollees`
--

CREATE TABLE `enrollees` (
  `ENROLL_ID` int(11) NOT NULL,
  `IDNO` varchar(200) NOT NULL DEFAULT '0',
  `DATE_ENROLLED` date NOT NULL,
  `CLASS_ID` int(11) NOT NULL,
  `SECT_ID` int(11) NOT NULL DEFAULT '0',
  `COURSE_ID` int(11) NOT NULL DEFAULT '0',
  `ACAD_ID` int(11) NOT NULL,
  `STATUS` varchar(50) NOT NULL,
  `R_STATUS` varchar(50) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `enrollees`
--

INSERT INTO `enrollees` (`ENROLL_ID`, `IDNO`, `DATE_ENROLLED`, `CLASS_ID`, `SECT_ID`, `COURSE_ID`, `ACAD_ID`, `STATUS`, `R_STATUS`) VALUES
(47, 'PRA100699', '2022-03-08', 1, 35, 1, 1, 'New Student', 'DONE'),
(48, 'JSM10068800', '2022-03-08', 1, 35, 1, 1, 'New Student', 'DONE'),
(49, 'HSN20293992', '2022-03-08', 2, 36, 1, 1, 'New Student', 'INC'),
(50, 'GSM293981', '2022-03-08', 2, 36, 1, 1, 'New Student', 'DONE'),
(51, 'KLM1992883', '2022-03-08', 4, 38, 1, 1, 'New Student', 'DROP'),
(52, 'SMB1003882', '2022-03-08', 4, 38, 1, 1, 'New Student', 'DONE'),
(53, 'PRA100699', '2022-03-09', 1, 35, 1, 2, 'continuing', 'DONE');

-- --------------------------------------------------------

--
-- Table structure for table `grades`
--

CREATE TABLE `grades` (
  `GRD_ID` int(11) NOT NULL,
  `IDNO` varchar(100) NOT NULL DEFAULT '0',
  `ENROLL_ID` int(50) NOT NULL DEFAULT '0',
  `MID_TERM` varchar(100) NOT NULL DEFAULT '0',
  `END_TERM` varchar(100) NOT NULL DEFAULT '0',
  `FINAL` varchar(100) NOT NULL DEFAULT '0',
  `REMARKS` varchar(50) NOT NULL DEFAULT '0',
  `ACAD_ID` int(50) NOT NULL DEFAULT '0'
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `grades`
--

INSERT INTO `grades` (`GRD_ID`, `IDNO`, `ENROLL_ID`, `MID_TERM`, `END_TERM`, `FINAL`, `REMARKS`, `ACAD_ID`) VALUES
(64, 'PRA100699', 47, '92', '89', '90.5', 'PASSED', 1),
(65, 'JSM10068800', 48, '80', '95', '87.5', 'PASSED', 1),
(66, 'HSN20293992', 49, '', '', '', 'INC', 1),
(67, 'GSM293981', 50, '89', '97', '93', 'PASSED', 1),
(68, 'KLM1992883', 51, '', '', '', 'DROP', 1),
(69, 'SMB1003882', 52, '96', '98', '97', 'PASSED', 1),
(70, 'PRA100699', 53, '94', '90', '92', 'PASSED', 2);

-- --------------------------------------------------------

--
-- Table structure for table `inc_students`
--

CREATE TABLE `inc_students` (
  `INC_ID` int(11) NOT NULL,
  `CLASS_ID` int(50) NOT NULL DEFAULT '0',
  `IDNO` varchar(100) NOT NULL DEFAULT '0',
  `ACAD_ID` int(50) NOT NULL DEFAULT '0',
  `REASON` varchar(200) NOT NULL DEFAULT '0',
  `STATUS` varchar(50) NOT NULL DEFAULT '0'
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `inc_students`
--

INSERT INTO `inc_students` (`INC_ID`, `CLASS_ID`, `IDNO`, `ACAD_ID`, `REASON`, `STATUS`) VALUES
(2, 2, 'HSN20293992', 1, 'wala lang', 'INC');

-- --------------------------------------------------------

--
-- Table structure for table `instructor`
--

CREATE TABLE `instructor` (
  `INST_ID` int(11) NOT NULL,
  `FNAME` varchar(100) NOT NULL DEFAULT '0',
  `LNAME` varchar(100) NOT NULL DEFAULT '0',
  `USERNAME` varchar(100) NOT NULL DEFAULT '0',
  `PASSWORD` varchar(100) NOT NULL DEFAULT '0',
  `TYPE` varchar(100) NOT NULL DEFAULT '0',
  `AVATAR` varchar(100) NOT NULL DEFAULT 'null',
  `STATUS` varchar(100) NOT NULL DEFAULT '0'
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `instructor`
--

INSERT INTO `instructor` (`INST_ID`, `FNAME`, `LNAME`, `USERNAME`, `PASSWORD`, `TYPE`, `AVATAR`, `STATUS`) VALUES
(1, 'Prof. ROLANDO', 'EZPARAGOZA', 'jam@yahoo.com', '21232f297a57a5a743894a0e4a801fc3', 'INSTRUCTOR', '2802202210273616112021084645blue alienware desktop wallpaper hot Alienware Full hd.jpg', 'active'),
(2, 'Prof. JOSE', 'TIERRA', 'joseTierra@yahoo.com', '21232f297a57a5a743894a0e4a801fc3', 'INSTRUCTOR', 'null', 'active'),
(3, 'Prof. Ray Anthony', 'Zuniga', 'rayAnthony@yahoo.com', '21232f297a57a5a743894a0e4a801fc3', 'INSTRUCTOR', '14112021114101wall.jpg', 'active'),
(4, 'Dr. Mary Luna', 'Mabasa', 'maryLuna@yahoo.com', '21232f297a57a5a743894a0e4a801fc3', 'INSTRUCTOR', 'null', 'active'),
(5, 'Dr. Maria Hayde', 'Cabarles', 'Hayde@yahoo.com', '21232f297a57a5a743894a0e4a801fc3', 'INSTRUCTOR', '16112021084645blue alienware desktop wallpaper hot Alienware Full hd.jpg', 'active'),
(6, 'Prof. Regina', 'Manoso', 'reginaManoso@yahoo.com', '21232f297a57a5a743894a0e4a801fc3', 'INSTRUCTOR', 'null', 'active'),
(7, 'John', 'Doe', 'johndoe@yahoo.com', '21232f297a57a5a743894a0e4a801fc3', 'INSTRUCTOR', 'null', 'active'),
(8, 'Johny', 'Park', 'johny@yahoo.com', '21232f297a57a5a743894a0e4a801fc3', 'INSTRUCTOR', 'null', 'active');

-- --------------------------------------------------------

--
-- Table structure for table `module`
--

CREATE TABLE `module` (
  `MOD_ID` int(11) NOT NULL,
  `FILE_LOC` varchar(100) NOT NULL DEFAULT '0',
  `FILE_IN` datetime NOT NULL,
  `DUE` date NOT NULL,
  `FILE_TYPE` int(50) NOT NULL,
  `FILE_TITLE` varchar(100) NOT NULL,
  `FILE_DESC` varchar(100) NOT NULL,
  `ACAD_ID` int(50) NOT NULL,
  `INST_ID` int(50) NOT NULL,
  `STATUS` int(50) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `module`
--

INSERT INTO `module` (`MOD_ID`, `FILE_LOC`, `FILE_IN`, `DUE`, `FILE_TYPE`, `FILE_TITLE`, `FILE_DESC`, `ACAD_ID`, `INST_ID`, `STATUS`) VALUES
(4, '1k7--9g8efjhcbi0da08032022232515CHAPTER III.docx', '2022-03-08 13:57:38', '0000-00-00', 1, 'ASSIGNMENT', 'Please answer all the following in your module', 1, 1, 1),
(5, 'ig90hkfbae71-c8jd-09032022001019CHAPTER III.docx', '2022-03-08 13:59:27', '0000-00-00', 0, 'New Material for chapter 1', 'Please study this', 1, 1, 1),
(12, 'uxbkrlv9zcwtja0sdy109032022031325CHAPTER III.docx', '2022-03-08 18:13:25', '0000-00-00', 1, 'Sample', 'asda', 1, 1, 0);

-- --------------------------------------------------------

--
-- Table structure for table `pass_module`
--

CREATE TABLE `pass_module` (
  `PASS_ID` int(11) NOT NULL,
  `ASSIGN_ID` int(11) NOT NULL DEFAULT '0',
  `IDNO` varchar(100) NOT NULL DEFAULT '0',
  `ACAD_ID` int(50) NOT NULL DEFAULT '0',
  `FILE_LOC` varchar(100) NOT NULL DEFAULT '0',
  `UPLOAD_DATE` datetime NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

-- --------------------------------------------------------

--
-- Table structure for table `sections`
--

CREATE TABLE `sections` (
  `SECT_ID` int(11) NOT NULL,
  `SECT_CODE` varchar(100) NOT NULL DEFAULT '0',
  `YR_SECTION` varchar(100) NOT NULL DEFAULT '0'
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `sections`
--

INSERT INTO `sections` (`SECT_ID`, `SECT_CODE`, `YR_SECTION`) VALUES
(35, '101-SEC', '1-1'),
(36, '102-SEC', '1-2'),
(37, '103-SEC', '1-3'),
(38, '104-SEC', '1-4'),
(39, '105-SEC', '1-5');

-- --------------------------------------------------------

--
-- Table structure for table `students`
--

CREATE TABLE `students` (
  `STUD_ID` int(11) NOT NULL,
  `IDNO` varchar(100) NOT NULL DEFAULT '0',
  `FNAME` varchar(100) NOT NULL DEFAULT '0',
  `LNAME` varchar(100) NOT NULL DEFAULT '0',
  `USERNAME` varchar(100) NOT NULL DEFAULT '0',
  `PASSWORD` varchar(100) NOT NULL DEFAULT '0',
  `AVATAR` varchar(100) NOT NULL DEFAULT '0',
  `REGISTERED` int(50) NOT NULL DEFAULT '0',
  `ENROLLED` int(50) NOT NULL DEFAULT '0'
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `students`
--

INSERT INTO `students` (`STUD_ID`, `IDNO`, `FNAME`, `LNAME`, `USERNAME`, `PASSWORD`, `AVATAR`, `REGISTERED`, `ENROLLED`) VALUES
(60, 'PRA100699', 'Ryan', 'Patenio', 'ryan@yahoo.com', '21232f297a57a5a743894a0e4a801fc3', 'null', 1, 1),
(61, 'JSM10068800', 'John', 'Steven', 'null', 'yHZc08032022225108', 'null', 0, 1),
(62, 'HSN20293992', 'Hanna', 'Nauller', 'null', 'ZyHc08032022225125', 'null', 0, 1),
(63, 'GSM293981', 'Ginebra', 'San Miguel', 'null', 'yZHc08032022225153', 'null', 0, 1),
(64, 'KLM1992883', 'Kelly', 'Manolangan', 'null', 'HycZ08032022225225', 'null', 0, 1),
(65, 'SMB1003882', 'San Miguel', 'Beer', 'null', 'ZcyH08032022225246', 'null', 0, 1),
(67, '323', 'Sample', 'lang', 'null', 'ZHyc10032022084024', 'null', 0, 0);

-- --------------------------------------------------------

--
-- Table structure for table `student_history`
--

CREATE TABLE `student_history` (
  `HISTORY_ID` int(11) NOT NULL,
  `IDNO` varchar(100) NOT NULL DEFAULT '0',
  `ACTIVITY` varchar(100) NOT NULL DEFAULT '0',
  `ACAD_ID` int(11) NOT NULL DEFAULT '0',
  `PERSON_INCHARGE` varchar(100) NOT NULL DEFAULT '0',
  `PERSON_POSITION` varchar(100) NOT NULL DEFAULT '0',
  `CLASS_ID` int(11) NOT NULL DEFAULT '0',
  `H_DATE` date NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `student_history`
--

INSERT INTO `student_history` (`HISTORY_ID`, `IDNO`, `ACTIVITY`, `ACAD_ID`, `PERSON_INCHARGE`, `PERSON_POSITION`, `CLASS_ID`, `H_DATE`) VALUES
(26, 'PRA100699', 'ENROLLED', 1, 'Prof. ROLANDO EZPARAGOZA', 'INSTRUCTOR', 1, '2022-03-08'),
(27, 'JSM10068800', 'ENROLLED', 1, 'Prof. ROLANDO EZPARAGOZA', 'INSTRUCTOR', 1, '2022-03-08'),
(28, 'HSN20293992', 'ENROLLED', 1, 'Prof. ROLANDO EZPARAGOZA', 'INSTRUCTOR', 2, '2022-03-08'),
(29, 'GSM293981', 'ENROLLED', 1, 'Prof. ROLANDO EZPARAGOZA', 'INSTRUCTOR', 2, '2022-03-08'),
(30, 'KLM1992883', 'ENROLLED', 1, 'Prof. ROLANDO EZPARAGOZA', 'INSTRUCTOR', 4, '2022-03-08'),
(31, 'SMB1003882', 'ENROLLED', 1, 'Prof. ROLANDO EZPARAGOZA', 'INSTRUCTOR', 4, '2022-03-08'),
(32, 'KLM1992883', 'DROP', 1, 'Prof. ROLANDO EZPARAGOZA', 'INSTRUCTOR', 4, '2022-03-08'),
(33, 'PRA100699', 'ENROLLED', 2, 'Ryan Wong', 'ADMIN', 1, '2022-03-09'),
(34, '24234', 'ENROLLED', 2, 'Ryan Wong', 'ADMIN', 1, '2022-03-09');

-- --------------------------------------------------------

--
-- Table structure for table `student_notif`
--

CREATE TABLE `student_notif` (
  `STD_NOTIF_ID` int(11) NOT NULL,
  `ANN_ID` int(50) NOT NULL,
  `IDNO` varchar(150) NOT NULL,
  `ACAD_ID` int(50) NOT NULL,
  `STATUS` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `student_notif`
--

INSERT INTO `student_notif` (`STD_NOTIF_ID`, `ANN_ID`, `IDNO`, `ACAD_ID`, `STATUS`) VALUES
(1, 1, 'PRA100699', 1, 0),
(2, 1, 'JSM10068800', 1, 0);

-- --------------------------------------------------------

--
-- Table structure for table `stud_details`
--

CREATE TABLE `stud_details` (
  `STD_ID` int(11) NOT NULL,
  `IDNO` varchar(100) NOT NULL DEFAULT '0',
  `BDAY` date NOT NULL,
  `GENDER` varchar(50) NOT NULL DEFAULT '0',
  `ADDRESS` varchar(100) NOT NULL DEFAULT '0',
  `CONTACT` varchar(50) NOT NULL DEFAULT '0'
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `stud_details`
--

INSERT INTO `stud_details` (`STD_ID`, `IDNO`, `BDAY`, `GENDER`, `ADDRESS`, `CONTACT`) VALUES
(61, 'PRA100699', '2022-03-23', 'Male', 'Sipalay City', '09939949399'),
(62, 'JSM10068800', '2022-03-15', 'Male', 'BInalbagan Negros Occidental', '09288388282'),
(63, 'HSN20293992', '2022-03-27', 'Female', 'Sipalay City', '09770772400'),
(64, 'GSM293981', '2022-03-18', 'Male', 'BInalbagan Negros Occidental', '09770772409'),
(65, 'KLM1992883', '2022-04-09', 'Male', 'Sipalay City', '09770772409'),
(66, 'SMB1003882', '2022-05-25', 'Male', 'BInalbagan Negros Occidental', '09099388483'),
(68, '323', '2022-03-04', 'Male', 'BInalbagan Negros Occidental', '09288388282');

-- --------------------------------------------------------

--
-- Table structure for table `teacher_notif`
--

CREATE TABLE `teacher_notif` (
  `T_NOTIF_ID` int(11) NOT NULL,
  `IDNO` varchar(100) NOT NULL DEFAULT '0',
  `CLASS_ID` int(50) NOT NULL DEFAULT '0',
  `ASSIGN_ID` int(50) NOT NULL DEFAULT '0',
  `PASS_ID` int(50) NOT NULL DEFAULT '0',
  `ACAD_ID` int(50) NOT NULL DEFAULT '0',
  `UPLOADED_DATE` datetime NOT NULL,
  `MESSAGE` varchar(50) NOT NULL,
  `READM` int(50) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `teacher_notif`
--

INSERT INTO `teacher_notif` (`T_NOTIF_ID`, `IDNO`, `CLASS_ID`, `ASSIGN_ID`, `PASS_ID`, `ACAD_ID`, `UPLOADED_DATE`, `MESSAGE`, `READM`) VALUES
(14, 'PRA100699', 1, 6, 1, 1, '2022-03-08 14:01:29', 'UPLOADED FILE MODULE', 0),
(15, 'PRA100699', 1, 6, 1, 1, '2022-03-08 15:23:09', 'UNSUBMITTED FILE', 0),
(16, 'PRA100699', 1, 6, 2, 1, '2022-03-08 15:25:31', 'UPLOADED FILE MODULE', 0),
(17, 'PRA100699', 1, 6, 2, 1, '2022-03-08 15:25:43', 'UNSUBMITTED FILE', 0),
(18, 'PRA100699', 1, 6, 3, 1, '2022-03-08 15:26:44', 'UPLOADED FILE MODULE', 0),
(19, 'PRA100699', 1, 6, 3, 1, '2022-03-08 15:26:55', 'UNSUBMITTED FILE', 0),
(20, 'PRA100699', 1, 6, 4, 1, '2022-03-08 15:28:20', 'UPLOADED FILE MODULE', 0),
(21, 'PRA100699', 1, 6, 4, 1, '2022-03-08 15:28:54', 'UNSUBMITTED FILE', 0),
(22, 'PRA100699', 1, 6, 5, 1, '2022-03-08 15:29:23', 'UPLOADED FILE MODULE', 0),
(23, 'PRA100699', 1, 6, 5, 1, '2022-03-08 15:29:40', 'UNSUBMITTED FILE', 0);

-- --------------------------------------------------------

--
-- Table structure for table `user`
--

CREATE TABLE `user` (
  `USER_ID` int(11) NOT NULL,
  `FNAME` varchar(100) NOT NULL,
  `LNAME` varchar(100) NOT NULL,
  `USERNAME` varchar(100) NOT NULL,
  `PASSWORD` varchar(100) NOT NULL,
  `TYPE` varchar(50) NOT NULL,
  `AVATAR` varchar(100) NOT NULL DEFAULT 'null'
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `user`
--

INSERT INTO `user` (`USER_ID`, `FNAME`, `LNAME`, `USERNAME`, `PASSWORD`, `TYPE`, `AVATAR`) VALUES
(1, 'Ryan', 'Wong', 'admin@yahoo.com', '21232f297a57a5a743894a0e4a801fc3', 'ADMIN', '2sm3t2w1yxonuqrzpv02802202222450211112021105226rpg1.jpg'),
(2, 'Wong', 'Chan', 'registrar@yahoo.com', '21232f297a57a5a743894a0e4a801fc3', 'REGISTRAR', 'null');

-- --------------------------------------------------------

--
-- Table structure for table `user_log`
--

CREATE TABLE `user_log` (
  `USERLOG_ID` int(11) NOT NULL,
  `NAME` varchar(200) NOT NULL DEFAULT '0',
  `ACTIVITY` varchar(100) NOT NULL DEFAULT '0',
  `ACTIVITY_DATE` datetime NOT NULL,
  `TYPE` varchar(50) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `user_log`
--

INSERT INTO `user_log` (`USERLOG_ID`, `NAME`, `ACTIVITY`, `ACTIVITY_DATE`, `TYPE`) VALUES
(486, 'Ryan Wong', 'Logout', '2022-03-04 11:54:30', 'ADMIN'),
(487, 'Prof. ROLANDO EZPARAGOZA', 'Login', '2022-03-04 11:54:36', 'INSTRUCTOR'),
(488, 'Prof. ROLANDO EZPARAGOZA', 'Logout', '2022-03-04 11:55:04', 'INSTRUCTOR'),
(489, 'Ryan Wong', 'Login', '2022-03-04 11:55:17', 'ADMIN'),
(490, 'Ryan Wong', 'Logout', '2022-03-04 11:58:06', 'ADMIN'),
(491, 'Ryan Wong', 'Login', '2022-03-04 14:48:38', 'ADMIN'),
(492, 'Ryan Wong', 'Login', '2022-03-04 15:02:30', 'ADMIN'),
(493, 'Ryan Wong', 'Logout', '2022-03-04 15:02:55', 'ADMIN'),
(494, 'Prof. ROLANDO EZPARAGOZA', 'Login', '2022-03-04 15:02:59', 'INSTRUCTOR'),
(495, 'Prof. ROLANDO EZPARAGOZA', 'Logout', '2022-03-04 15:07:23', 'INSTRUCTOR'),
(496, 'Ryan Wong', 'Login', '2022-03-04 15:07:29', 'ADMIN'),
(497, 'Ryan Wong', 'Login', '2022-03-04 15:11:21', 'ADMIN'),
(498, 'Ryan Wong', 'Logout', '2022-03-04 15:37:49', 'ADMIN'),
(499, 'Prof. ROLANDO EZPARAGOZA', 'Login', '2022-03-04 15:37:55', 'INSTRUCTOR'),
(500, 'Ryan Wong', 'Login', '2022-03-04 15:49:22', 'ADMIN'),
(501, 'Ryan Wong', 'Logout', '2022-03-04 16:18:54', 'ADMIN'),
(502, 'Prof. ROLANDO EZPARAGOZA', 'Login', '2022-03-04 16:18:59', 'INSTRUCTOR'),
(503, 'Prof. ROLANDO EZPARAGOZA', 'Logout', '2022-03-04 16:28:27', 'INSTRUCTOR'),
(504, 'Ryan Wong', 'Login', '2022-03-04 16:28:37', 'ADMIN'),
(505, 'Ryan Wong', 'Logout', '2022-03-04 16:31:02', 'ADMIN'),
(506, 'Ryan Wong', 'Login', '2022-03-07 10:22:31', 'ADMIN'),
(507, 'Ryan Wong', 'Logout', '2022-03-07 10:26:02', 'ADMIN'),
(508, 'Prof. ROLANDO EZPARAGOZA', 'Login', '2022-03-07 10:26:09', 'INSTRUCTOR'),
(509, 'Prof. ROLANDO EZPARAGOZA', 'Logout', '2022-03-07 10:26:26', 'INSTRUCTOR'),
(510, 'Ryan Wong', 'Login', '2022-03-07 10:26:35', 'ADMIN'),
(511, 'Ryan Wong', 'Login', '2022-03-07 10:36:06', 'ADMIN'),
(512, 'Ryan Wong', 'Logout', '2022-03-07 11:27:57', 'ADMIN'),
(513, 'Prof. ROLANDO EZPARAGOZA', 'Login', '2022-03-07 11:28:58', 'INSTRUCTOR'),
(514, 'Prof. ROLANDO EZPARAGOZA', 'Logout', '2022-03-07 11:30:28', 'INSTRUCTOR'),
(515, 'Ryan Wong', 'Login', '2022-03-07 11:30:33', 'ADMIN'),
(516, 'Prof. ROLANDO EZPARAGOZA', 'Login', '2022-03-07 11:42:29', 'INSTRUCTOR'),
(517, 'Prof. ROLANDO EZPARAGOZA', 'Logout', '2022-03-07 11:43:53', 'INSTRUCTOR'),
(518, 'Ryan Wong', 'Login', '2022-03-07 11:43:58', 'ADMIN'),
(519, 'Ryan Wong', 'Login', '2022-03-07 11:48:51', 'ADMIN'),
(520, 'Ryan Wong', 'Logout', '2022-03-07 12:10:06', 'ADMIN'),
(521, 'Ryan Wong', 'Login', '2022-03-07 13:58:20', 'ADMIN'),
(522, 'Ryan Wong', 'Logout', '2022-03-07 16:58:47', 'ADMIN'),
(523, 'Ryan Wong', 'Login', '2022-03-07 21:47:12', 'ADMIN'),
(524, 'Ryan Wong', 'Logout', '2022-03-07 22:16:27', 'ADMIN'),
(525, 'Prof. ROLANDO EZPARAGOZA', 'Login', '2022-03-07 22:16:35', 'INSTRUCTOR'),
(526, 'Prof. ROLANDO EZPARAGOZA', 'Logout', '2022-03-07 22:20:13', 'INSTRUCTOR'),
(527, 'Ryan Wong', 'Login', '2022-03-07 22:20:18', 'ADMIN'),
(528, 'Ryan Wong', 'Login', '2022-03-07 22:33:55', 'ADMIN'),
(529, 'Ryan Wong', 'Logout', '2022-03-07 22:49:20', 'ADMIN'),
(530, 'Prof. ROLANDO EZPARAGOZA', 'Login', '2022-03-07 22:49:26', 'INSTRUCTOR'),
(531, 'Prof. ROLANDO EZPARAGOZA', 'Logout', '2022-03-07 23:04:53', 'INSTRUCTOR'),
(532, 'Ryan Wong', 'Login', '2022-03-07 23:04:59', 'ADMIN'),
(533, 'Ryan Wong', 'Logout', '2022-03-07 23:05:11', 'ADMIN'),
(534, 'Prof. ROLANDO EZPARAGOZA', 'Login', '2022-03-07 23:05:17', 'INSTRUCTOR'),
(535, 'Prof. ROLANDO EZPARAGOZA', 'Logout', '2022-03-07 23:06:16', 'INSTRUCTOR'),
(536, 'Ryan Wong', 'Login', '2022-03-07 23:06:22', 'ADMIN'),
(537, 'Ryan Wong', 'Logout', '2022-03-07 23:08:58', 'ADMIN'),
(538, 'Prof. ROLANDO EZPARAGOZA', 'Login', '2022-03-07 23:09:04', 'INSTRUCTOR'),
(539, 'Prof. ROLANDO EZPARAGOZA', 'Logout', '2022-03-07 23:09:27', 'INSTRUCTOR'),
(540, 'Ryan Wong', 'Login', '2022-03-07 23:09:36', 'ADMIN'),
(541, 'Ryan Wong', 'Logout', '2022-03-07 23:16:46', 'ADMIN'),
(542, 'Prof. ROLANDO EZPARAGOZA', 'Login', '2022-03-07 23:16:51', 'INSTRUCTOR'),
(543, 'Prof. ROLANDO EZPARAGOZA', 'Logout', '2022-03-07 23:17:49', 'INSTRUCTOR'),
(544, 'Ryan Wong', 'Login', '2022-03-07 23:17:59', 'ADMIN'),
(545, 'Ryan Wong', 'Logout', '2022-03-07 23:22:36', 'ADMIN'),
(546, 'Prof. ROLANDO EZPARAGOZA', 'Login', '2022-03-07 23:22:41', 'INSTRUCTOR'),
(547, 'Prof. ROLANDO EZPARAGOZA', 'Login', '2022-03-07 23:44:01', 'INSTRUCTOR'),
(548, 'Prof. ROLANDO EZPARAGOZA', 'Logout', '2022-03-08 00:00:11', 'INSTRUCTOR'),
(549, 'Ryan Wong', 'Login', '2022-03-08 13:17:26', 'ADMIN'),
(550, 'Ryan Wong', 'Logout', '2022-03-08 13:29:44', 'ADMIN'),
(551, 'Prof. ROLANDO EZPARAGOZA', 'Login', '2022-03-08 13:29:49', 'INSTRUCTOR'),
(552, 'Prof. ROLANDO EZPARAGOZA', 'Login', '2022-03-08 13:47:02', 'INSTRUCTOR'),
(553, 'Prof. ROLANDO EZPARAGOZA', 'Logout', '2022-03-08 13:52:58', 'INSTRUCTOR'),
(554, 'Ryan Wong', 'Login', '2022-03-08 13:53:05', 'ADMIN'),
(555, 'Ryan Wong', 'Logout', '2022-03-08 13:54:53', 'ADMIN'),
(556, 'Prof. ROLANDO EZPARAGOZA', 'Login', '2022-03-08 13:54:59', 'INSTRUCTOR'),
(557, 'Prof. ROLANDO EZPARAGOZA', 'Login', '2022-03-08 14:02:47', 'INSTRUCTOR'),
(558, 'Prof. ROLANDO EZPARAGOZA', 'Login', '2022-03-08 14:20:32', 'INSTRUCTOR'),
(559, 'Prof. ROLANDO EZPARAGOZA', 'Logout', '2022-03-08 15:19:32', 'INSTRUCTOR'),
(560, 'Ryan Wong', 'Login', '2022-03-08 15:19:48', 'ADMIN'),
(561, 'Ryan Wong', 'Logout', '2022-03-08 15:21:57', 'ADMIN'),
(562, 'Prof. ROLANDO EZPARAGOZA', 'Login', '2022-03-08 15:22:14', 'INSTRUCTOR'),
(563, 'Prof. ROLANDO EZPARAGOZA', 'Logout', '2022-03-08 15:22:32', 'INSTRUCTOR'),
(564, 'Ryan Wong', 'Login', '2022-03-08 15:22:38', 'ADMIN'),
(565, 'Prof. ROLANDO EZPARAGOZA', 'Login', '2022-03-08 15:30:34', 'INSTRUCTOR'),
(566, 'Prof. ROLANDO EZPARAGOZA', 'Logout', '2022-03-08 16:33:32', 'INSTRUCTOR'),
(567, 'Ryan Wong', 'Login', '2022-03-08 16:33:37', 'ADMIN'),
(568, 'Ryan Wong', 'Logout', '2022-03-08 16:37:27', 'ADMIN'),
(569, 'Prof. ROLANDO EZPARAGOZA', 'Login', '2022-03-08 16:37:46', 'INSTRUCTOR'),
(570, 'Prof. ROLANDO EZPARAGOZA', 'Logout', '2022-03-08 17:12:07', 'INSTRUCTOR'),
(571, 'Ryan Wong', 'Login', '2022-03-08 17:12:12', 'ADMIN'),
(572, 'Ryan Wong', 'Logout', '2022-03-08 17:12:26', 'ADMIN'),
(573, 'Prof. ROLANDO EZPARAGOZA', 'Login', '2022-03-08 17:12:35', 'INSTRUCTOR'),
(574, 'Prof. ROLANDO EZPARAGOZA', 'Login', '2022-03-09 00:31:25', 'INSTRUCTOR'),
(575, 'Prof. ROLANDO EZPARAGOZA', 'Login', '2022-03-09 01:25:16', 'INSTRUCTOR'),
(576, 'Prof. ROLANDO EZPARAGOZA', 'Logout', '2022-03-09 01:26:35', 'INSTRUCTOR'),
(577, 'Ryan Wong', 'Login', '2022-03-09 01:26:41', 'ADMIN'),
(578, 'Ryan Wong', 'Logout', '2022-03-09 01:53:29', 'ADMIN'),
(579, 'Prof. ROLANDO EZPARAGOZA', 'Login', '2022-03-09 01:53:38', 'INSTRUCTOR'),
(580, 'Prof. ROLANDO EZPARAGOZA', 'Logout', '2022-03-09 01:54:41', 'INSTRUCTOR'),
(581, 'Ryan Wong', 'Login', '2022-03-09 01:54:48', 'ADMIN'),
(582, 'Ryan Wong', 'Login', '2022-03-09 02:57:29', 'ADMIN'),
(583, 'Ryan Wong', 'Login', '2022-03-09 15:30:26', 'ADMIN'),
(584, 'Ryan Wong', 'Logout', '2022-03-09 16:40:05', 'ADMIN'),
(585, 'Prof. ROLANDO EZPARAGOZA', 'Login', '2022-03-09 16:40:10', 'INSTRUCTOR'),
(586, 'Prof. ROLANDO EZPARAGOZA', 'Logout', '2022-03-09 16:41:33', 'INSTRUCTOR'),
(587, 'Prof. ROLANDO EZPARAGOZA', 'Logout', '2022-03-09 16:41:33', 'INSTRUCTOR'),
(588, 'Ryan Wong', 'Login', '2022-03-09 16:41:40', 'ADMIN'),
(589, 'Ryan Wong', 'Logout', '2022-03-09 19:33:48', 'ADMIN'),
(590, 'Wong Chan', 'Logout', '2022-03-09 23:18:58', 'REGISTRAR'),
(591, 'Ryan Wong', 'Login', '2022-03-09 23:19:08', 'ADMIN'),
(592, 'Ryan Wong', 'Logout', '2022-03-09 23:27:28', 'ADMIN'),
(593, 'Wong Chan', 'Logout', '2022-03-09 23:28:25', 'REGISTRAR'),
(594, 'Wong Chan', 'Logout', '2022-03-09 23:28:47', 'REGISTRAR'),
(595, 'Prof. ROLANDO EZPARAGOZA', 'Login', '2022-03-09 23:28:53', 'INSTRUCTOR'),
(596, 'Prof. ROLANDO EZPARAGOZA', 'Logout', '2022-03-09 23:29:45', 'INSTRUCTOR'),
(597, 'Ryan Wong', 'Login', '2022-03-09 23:29:52', 'ADMIN'),
(598, 'Ryan Wong', 'Logout', '2022-03-09 23:40:48', 'ADMIN'),
(599, 'Prof. ROLANDO EZPARAGOZA', 'Login', '2022-03-09 23:40:54', 'INSTRUCTOR'),
(600, 'Prof. ROLANDO EZPARAGOZA', 'Logout', '2022-03-09 23:52:05', 'INSTRUCTOR'),
(601, 'Ryan Wong', 'Login', '2022-03-09 23:52:12', 'ADMIN'),
(602, 'Ryan Wong', 'Logout', '2022-03-10 00:13:41', 'ADMIN'),
(603, 'Prof. ROLANDO EZPARAGOZA', 'Login', '2022-03-10 00:13:46', 'INSTRUCTOR'),
(604, 'Prof. ROLANDO EZPARAGOZA', 'Logout', '2022-03-10 00:15:50', 'INSTRUCTOR');

--
-- Indexes for dumped tables
--

--
-- Indexes for table `acad_year`
--
ALTER TABLE `acad_year`
  ADD PRIMARY KEY (`ACAD_ID`);

--
-- Indexes for table `announcement`
--
ALTER TABLE `announcement`
  ADD PRIMARY KEY (`ANN_ID`);

--
-- Indexes for table `assign_module`
--
ALTER TABLE `assign_module`
  ADD PRIMARY KEY (`ASSIGN_ID`);

--
-- Indexes for table `attendance`
--
ALTER TABLE `attendance`
  ADD PRIMARY KEY (`ATT_ID`);

--
-- Indexes for table `autocode`
--
ALTER TABLE `autocode`
  ADD PRIMARY KEY (`AUTO_ID`);

--
-- Indexes for table `class`
--
ALTER TABLE `class`
  ADD PRIMARY KEY (`CLASS_ID`);

--
-- Indexes for table `class_sched`
--
ALTER TABLE `class_sched`
  ADD PRIMARY KEY (`CLASS_SCHED_ID`);

--
-- Indexes for table `course`
--
ALTER TABLE `course`
  ADD PRIMARY KEY (`COURSE_ID`);

--
-- Indexes for table `drop_students`
--
ALTER TABLE `drop_students`
  ADD PRIMARY KEY (`DROP_ID`);

--
-- Indexes for table `enrollees`
--
ALTER TABLE `enrollees`
  ADD PRIMARY KEY (`ENROLL_ID`);

--
-- Indexes for table `grades`
--
ALTER TABLE `grades`
  ADD PRIMARY KEY (`GRD_ID`);

--
-- Indexes for table `inc_students`
--
ALTER TABLE `inc_students`
  ADD PRIMARY KEY (`INC_ID`);

--
-- Indexes for table `instructor`
--
ALTER TABLE `instructor`
  ADD PRIMARY KEY (`INST_ID`);

--
-- Indexes for table `module`
--
ALTER TABLE `module`
  ADD PRIMARY KEY (`MOD_ID`);

--
-- Indexes for table `pass_module`
--
ALTER TABLE `pass_module`
  ADD PRIMARY KEY (`PASS_ID`);

--
-- Indexes for table `sections`
--
ALTER TABLE `sections`
  ADD PRIMARY KEY (`SECT_ID`);

--
-- Indexes for table `students`
--
ALTER TABLE `students`
  ADD PRIMARY KEY (`STUD_ID`);

--
-- Indexes for table `student_history`
--
ALTER TABLE `student_history`
  ADD PRIMARY KEY (`HISTORY_ID`);

--
-- Indexes for table `student_notif`
--
ALTER TABLE `student_notif`
  ADD PRIMARY KEY (`STD_NOTIF_ID`);

--
-- Indexes for table `stud_details`
--
ALTER TABLE `stud_details`
  ADD PRIMARY KEY (`STD_ID`);

--
-- Indexes for table `teacher_notif`
--
ALTER TABLE `teacher_notif`
  ADD PRIMARY KEY (`T_NOTIF_ID`);

--
-- Indexes for table `user`
--
ALTER TABLE `user`
  ADD PRIMARY KEY (`USER_ID`);

--
-- Indexes for table `user_log`
--
ALTER TABLE `user_log`
  ADD PRIMARY KEY (`USERLOG_ID`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `acad_year`
--
ALTER TABLE `acad_year`
  MODIFY `ACAD_ID` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=4;
--
-- AUTO_INCREMENT for table `announcement`
--
ALTER TABLE `announcement`
  MODIFY `ANN_ID` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2;
--
-- AUTO_INCREMENT for table `assign_module`
--
ALTER TABLE `assign_module`
  MODIFY `ASSIGN_ID` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=18;
--
-- AUTO_INCREMENT for table `attendance`
--
ALTER TABLE `attendance`
  MODIFY `ATT_ID` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=7;
--
-- AUTO_INCREMENT for table `autocode`
--
ALTER TABLE `autocode`
  MODIFY `AUTO_ID` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=3;
--
-- AUTO_INCREMENT for table `class`
--
ALTER TABLE `class`
  MODIFY `CLASS_ID` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=7;
--
-- AUTO_INCREMENT for table `class_sched`
--
ALTER TABLE `class_sched`
  MODIFY `CLASS_SCHED_ID` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=7;
--
-- AUTO_INCREMENT for table `course`
--
ALTER TABLE `course`
  MODIFY `COURSE_ID` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=8;
--
-- AUTO_INCREMENT for table `drop_students`
--
ALTER TABLE `drop_students`
  MODIFY `DROP_ID` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=3;
--
-- AUTO_INCREMENT for table `enrollees`
--
ALTER TABLE `enrollees`
  MODIFY `ENROLL_ID` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=55;
--
-- AUTO_INCREMENT for table `grades`
--
ALTER TABLE `grades`
  MODIFY `GRD_ID` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=72;
--
-- AUTO_INCREMENT for table `inc_students`
--
ALTER TABLE `inc_students`
  MODIFY `INC_ID` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=3;
--
-- AUTO_INCREMENT for table `instructor`
--
ALTER TABLE `instructor`
  MODIFY `INST_ID` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=9;
--
-- AUTO_INCREMENT for table `module`
--
ALTER TABLE `module`
  MODIFY `MOD_ID` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=13;
--
-- AUTO_INCREMENT for table `pass_module`
--
ALTER TABLE `pass_module`
  MODIFY `PASS_ID` int(11) NOT NULL AUTO_INCREMENT;
--
-- AUTO_INCREMENT for table `sections`
--
ALTER TABLE `sections`
  MODIFY `SECT_ID` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=40;
--
-- AUTO_INCREMENT for table `students`
--
ALTER TABLE `students`
  MODIFY `STUD_ID` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=68;
--
-- AUTO_INCREMENT for table `student_history`
--
ALTER TABLE `student_history`
  MODIFY `HISTORY_ID` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=35;
--
-- AUTO_INCREMENT for table `student_notif`
--
ALTER TABLE `student_notif`
  MODIFY `STD_NOTIF_ID` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=3;
--
-- AUTO_INCREMENT for table `stud_details`
--
ALTER TABLE `stud_details`
  MODIFY `STD_ID` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=69;
--
-- AUTO_INCREMENT for table `teacher_notif`
--
ALTER TABLE `teacher_notif`
  MODIFY `T_NOTIF_ID` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=24;
--
-- AUTO_INCREMENT for table `user`
--
ALTER TABLE `user`
  MODIFY `USER_ID` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=3;
--
-- AUTO_INCREMENT for table `user_log`
--
ALTER TABLE `user_log`
  MODIFY `USERLOG_ID` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=605;COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
