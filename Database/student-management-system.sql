-- phpMyAdmin SQL Dump
-- version 4.6.6deb5ubuntu0.5
-- https://www.phpmyadmin.net/
--
-- Host: localhost:3306
-- Generation Time: May 30, 2022 at 07:57 PM
-- Server version: 5.7.38-0ubuntu0.18.04.1
-- PHP Version: 7.4.29

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `schoolnew1`
--

-- --------------------------------------------------------

--
-- Table structure for table `attendance`
--

CREATE TABLE `attendance` (
  `sid` int(10) NOT NULL,
  `date` date NOT NULL,
  `aid` int(10) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `attendance`
--

INSERT INTO `attendance` (`sid`, `date`, `aid`) VALUES
(2, '2020-05-25', 3),
(1, '2020-05-30', 4),
(2, '2020-05-02', 5),
(2, '1975-09-17', 6),
(3, '2005-06-30', 7);

-- --------------------------------------------------------

--
-- Table structure for table `attendancereport`
--

CREATE TABLE `attendancereport` (
  `aid` int(20) NOT NULL,
  `sid` varchar(50) NOT NULL,
  `status` varchar(50) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `attendancereport`
--

INSERT INTO `attendancereport` (`aid`, `sid`, `status`) VALUES
(3, 'ST1000010001', 'Absent'),
(3, 'ST1000010002', 'Present'),
(4, 'ST1000010001', 'Present'),
(4, 'ST1000010002', 'Present');

-- --------------------------------------------------------

--
-- Table structure for table `classroom`
--

CREATE TABLE `classroom` (
  `hno` varchar(50) NOT NULL,
  `title` varchar(50) NOT NULL,
  `location` varchar(50) NOT NULL,
  `capacity` int(3) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `classroom`
--

INSERT INTO `classroom` (`hno`, `title`, `location`, `capacity`) VALUES
('4-B', 'Nilwala', 'Block-D', 50),
('Aute in irure autem ', 'Aut magnam fugiat r', 'Aliquam minim numqua', 12),
('Sunt cillum qui iust', 'Eum hic ipsum ration', 'Ut nostrum laborum ', 48);

-- --------------------------------------------------------

--
-- Table structure for table `exam`
--

CREATE TABLE `exam` (
  `id` int(11) NOT NULL,
  `subject` varchar(50) NOT NULL,
  `teacher` varchar(50) NOT NULL,
  `classroom` varchar(50) NOT NULL,
  `date` date NOT NULL,
  `stime` time NOT NULL,
  `etime` time NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `exam`
--

INSERT INTO `exam` (`id`, `subject`, `teacher`, `classroom`, `date`, `stime`, `etime`) VALUES
(1, 'SCM4251', 'TC1000020000', '4-B', '2020-05-26', '11:45:00', '12:45:00'),
(2, '', 'Andrew', '4-B', '2022-05-20', '00:00:00', '00:00:00');

-- --------------------------------------------------------

--
-- Table structure for table `examresult`
--

CREATE TABLE `examresult` (
  `exam` int(11) NOT NULL,
  `student` varchar(50) NOT NULL,
  `marks` int(10) NOT NULL,
  `grade` varchar(10) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `examresult`
--

INSERT INTO `examresult` (`exam`, `student`, `marks`, `grade`) VALUES
(1, 'Brittany', 44, 'C-'),
(1, 'ST1000010001', 55, 'C+'),
(1, 'ST1000010002', 77, 'A+'),
(2, 'Kiayada', 91, 'C+');

-- --------------------------------------------------------

--
-- Table structure for table `notice`
--

CREATE TABLE `notice` (
  `id` int(11) NOT NULL,
  `notice` varchar(1500) NOT NULL,
  `odience` varchar(100) NOT NULL,
  `date` datetime NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `notice`
--

INSERT INTO `notice` (`id`, `notice`, `odience`, `date`) VALUES
(5, 'Ea cum labore illo n', 'Parent', '2022-05-30 10:52:24'),
(6, 'Dolores suscipit qui', 'Select Odience', '2022-05-30 10:52:27');

-- --------------------------------------------------------

--
-- Table structure for table `parent`
--

CREATE TABLE `parent` (
  `pid` int(11) NOT NULL,
  `fname` varchar(50) NOT NULL,
  `lname` varchar(50) NOT NULL,
  `contact` varchar(20) NOT NULL,
  `job` varchar(50) NOT NULL,
  `address` varchar(250) NOT NULL,
  `gender` varchar(25) NOT NULL,
  `nic` varchar(50) NOT NULL,
  `email` varchar(50) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `parent`
--

INSERT INTO `parent` (`pid`, `fname`, `lname`, `contact`, `job`, `address`, `gender`, `nic`, `email`) VALUES
(1, 'Kelly', 'Kelly', '0785566022555', 'Engineer', 'Colombo Road\r\nPilimathalawa.', 'Male', '7855485552V', 'parent@gmail.com'),
(2, 'Natasha', 'Belle', 'Rebecca', 'Alvin', 'Laborum Iure ea nos', 'Female', 'Aladdin', 'qiwip@mailinator.com'),
(3, 'Taylor', 'Swift', 'Roary', 'Price', 'Laborum maiores vel ', 'Male', 'Merrill', 'dabecapywa@mailinator.com');

-- --------------------------------------------------------

--
-- Table structure for table `schedule`
--

CREATE TABLE `schedule` (
  `id` int(11) NOT NULL,
  `subject` varchar(50) NOT NULL,
  `teacher` varchar(50) NOT NULL,
  `day` varchar(50) NOT NULL,
  `stime` time NOT NULL,
  `class` varchar(50) NOT NULL,
  `etime` time NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `schedule`
--

INSERT INTO `schedule` (`id`, `subject`, `teacher`, `day`, `stime`, `class`, `etime`) VALUES
(1, 'SCM4251', 'TC1000020000', 'Wendsday', '04:15:00', '4-B', '04:15:00'),
(2, 'SCM4251', 'TC1000020000', 'Thursday', '05:30:00', '4-B', '07:45:00'),
(3, 'Voluptatem Consequa', 'Andrew', 'Monday', '01:21:23', '4-B', '00:01:23'),
(4, 'Quas laudantium nem', 'TC1000020000', 'Thursday', '12:31:23', 'Aute in irure autem ', '00:01:23'),
(5, 'Sequi fugiat molliti', 'Andrew', 'Sunday', '00:00:00', 'Select Class Room', '00:00:00'),
(6, '', 'TC1000020000', 'Saturday', '00:00:00', 'Aute in irure autem ', '00:00:00'),
(7, 'Select Subject', 'Andrew', 'Monday', '00:00:00', 'Select Class Room', '00:00:00'),
(8, 'Quaerat illum nesci', 'Andrew', 'Wendsday', '00:00:00', 'Aute in irure autem ', '00:00:00');

-- --------------------------------------------------------

--
-- Table structure for table `student`
--

CREATE TABLE `student` (
  `sid` varchar(25) NOT NULL,
  `fname` varchar(50) NOT NULL,
  `lname` varchar(50) NOT NULL,
  `bday` date NOT NULL,
  `address` varchar(250) NOT NULL,
  `parent` int(10) NOT NULL,
  `gender` varchar(10) NOT NULL,
  `classroom` varchar(25) NOT NULL,
  `email` varchar(50) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `student`
--

INSERT INTO `student` (`sid`, `fname`, `lname`, `bday`, `address`, `parent`, `gender`, `classroom`, `email`) VALUES
('Bethany', 'Walker', 'Nathaniel', '1971-02-23', 'Velit accusamus rer', 0, 'Male', 'Select Class Room', 'behof@mailinator.com'),
('Brittany', 'Noah', 'Odessa', '2017-08-22', 'Expedita nobis et al', 0, 'Male', 'Select Class Room', 'hocy@mailinator.com'),
('Brody', 'Kendall', 'Isabelle', '1989-01-11', 'Nostrud dolor est ve', 1, 'Female', '4-B', 'vabylem@mailinator.com'),
('Illana', 'Mufutau', 'Walker', '2016-04-06', 'In voluptates rem no', 0, 'Male', '4-B', 'sibokuzi@mailinator.com'),
('Kiayada', 'Robin', 'Ariel', '1997-05-31', 'Magna architecto sol', 0, 'Female', '4-B', 'qofydynif@mailinator.com'),
('Lilah', 'Miranda', 'Xavier', '2010-03-12', 'Proident vel perspi', 1, 'Female', '4-B', 'xohunelocy@mailinator.com'),
('Rafael', 'Montana', 'Molly', '2017-12-29', 'Cumque voluptatem O', 1, 'Male', 'Select Class Room', 'tiqohababo@mailinator.com'),
('ST1000010001', 'Kasun1', 'Chamara', '2022-05-19', 'Colombo Road \r\nKandy', 1, 'Female', '4-B', 'student@gmail.com'),
('ST1000010002', 'Dasun4', 'Shanuka', '2020-05-31', 'Ampara Road \r\nUhana', 1, 'Male', '4-B', 'stu1@stu1.stu1'),
('STU1000040000', 'Dilip', 'Silva', '2022-05-19', 'asasas', 1, 'Male', '4-B', 'dil@dil.dil'),
('STU100004005', 'Hashini', 'Asiri', '2020-05-27', 'asassas', 1, 'Female', 'Select Class Room', 'h@h.h');

-- --------------------------------------------------------

--
-- Table structure for table `subject`
--

CREATE TABLE `subject` (
  `sid` varchar(50) NOT NULL,
  `title` varchar(200) NOT NULL,
  `description` varchar(500) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `subject`
--

INSERT INTO `subject` (`sid`, `title`, `description`) VALUES
('Aute est nulla volup', 'Ipsa in voluptas vo', 'Saepe officia culpa '),
('Autem at ea sint co', 'Est recusandae Quos', 'Aut illum porro id '),
('Et pariatur Dolores', 'Animi amet dolor f', 'Et atque et pariatur'),
('Lorem sipsum', 'Loadfushn gulg', 'Lores informr'),
('Odio quasi enim nost', 'Quia ut libero dolor', 'Necessitatibus non n'),
('Praesentium quo et a', 'Dicta error est sunt', 'Est eaque ea placea'),
('Quaerat illum nesci', 'Velit voluptatem N', 'Alias quis quam elig'),
('Quas laudantium nem', 'Aspernatur Nam sapie', 'Ea animi culpa ill'),
('SCM4251', 'Science and Technology', 'Chemistry Basics\r\n'),
('Sequi fugiat molliti', 'Quas debitis volupta444', 'Ex reiciendis omnis '),
('Vero aperiam facere ', 'Animi est sed aliq', 'Atque quidem explica'),
('Voluptatem Consequa', 'Dignissimos in eos ', 'Excepturi deserunt i');

-- --------------------------------------------------------

--
-- Table structure for table `teacher`
--

CREATE TABLE `teacher` (
  `tid` varchar(50) NOT NULL,
  `fname` varchar(50) NOT NULL,
  `lname` varchar(50) NOT NULL,
  `address` varchar(50) NOT NULL,
  `contact` varchar(50) NOT NULL,
  `bday` date NOT NULL,
  `skill` varchar(500) NOT NULL,
  `gender` varchar(25) NOT NULL,
  `email` varchar(50) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `teacher`
--

INSERT INTO `teacher` (`tid`, `fname`, `lname`, `address`, `contact`, `bday`, `skill`, `gender`, `email`) VALUES
('Andrew', 'Lawrence45', 'Odette', 'Ipsa et distinctio', 'Eve123123', '2022-05-19', 'Ut voluptatem dolor', 'Female', 'hina@mailinator.com'),
('Ramona', 'Raphael', 'Seth', 'Tempor sit doloribu', 'Roary', '1978-09-27', 'Rerum dolor et nulla', 'Male', 'gojewili@mailinator.com'),
('TC1000020000', 'Nimal ', 'Soyza555', 'Kandy Road\r\nNittambuwa', '0339988554', '2022-05-21', 'Science\r\nMathematics\r\nHistory', 'Male', 'tea@tea.tea');

-- --------------------------------------------------------

--
-- Table structure for table `user`
--

CREATE TABLE `user` (
  `role` varchar(50) NOT NULL,
  `email` varchar(50) NOT NULL,
  `password` varchar(50) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `user`
--

INSERT INTO `user` (`role`, `email`, `password`) VALUES
('Parent', 'parent@gmail.com', '81dc9bdb52d04dc20036dbd8313ed055'),
('Student', 'student@gmail.com', '81dc9bdb52d04dc20036dbd8313ed055'),
('Teacher', 'teacher@gmail.com', '81dc9bdb52d04dc20036dbd8313ed055');

--
-- Indexes for dumped tables
--

--
-- Indexes for table `attendance`
--
ALTER TABLE `attendance`
  ADD PRIMARY KEY (`aid`);

--
-- Indexes for table `attendancereport`
--
ALTER TABLE `attendancereport`
  ADD PRIMARY KEY (`aid`,`sid`);

--
-- Indexes for table `classroom`
--
ALTER TABLE `classroom`
  ADD PRIMARY KEY (`hno`);

--
-- Indexes for table `exam`
--
ALTER TABLE `exam`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `examresult`
--
ALTER TABLE `examresult`
  ADD PRIMARY KEY (`exam`,`student`);

--
-- Indexes for table `notice`
--
ALTER TABLE `notice`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `parent`
--
ALTER TABLE `parent`
  ADD PRIMARY KEY (`pid`),
  ADD UNIQUE KEY `email` (`email`);

--
-- Indexes for table `schedule`
--
ALTER TABLE `schedule`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `student`
--
ALTER TABLE `student`
  ADD PRIMARY KEY (`sid`),
  ADD UNIQUE KEY `email` (`email`);

--
-- Indexes for table `subject`
--
ALTER TABLE `subject`
  ADD PRIMARY KEY (`sid`);

--
-- Indexes for table `teacher`
--
ALTER TABLE `teacher`
  ADD PRIMARY KEY (`tid`),
  ADD UNIQUE KEY `email` (`email`);

--
-- Indexes for table `user`
--
ALTER TABLE `user`
  ADD PRIMARY KEY (`email`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `attendance`
--
ALTER TABLE `attendance`
  MODIFY `aid` int(10) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=8;
--
-- AUTO_INCREMENT for table `exam`
--
ALTER TABLE `exam`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=3;
--
-- AUTO_INCREMENT for table `notice`
--
ALTER TABLE `notice`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=7;
--
-- AUTO_INCREMENT for table `parent`
--
ALTER TABLE `parent`
  MODIFY `pid` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=4;
--
-- AUTO_INCREMENT for table `schedule`
--
ALTER TABLE `schedule`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=9;
/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
