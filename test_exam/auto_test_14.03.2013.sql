-- phpMyAdmin SQL Dump
-- version 3.5.2
-- http://www.phpmyadmin.net
--
-- Host: localhost
-- Generation Time: Mar 14, 2013 at 04:14 AM
-- Server version: 5.5.25a
-- PHP Version: 5.4.4

SET SQL_MODE="NO_AUTO_VALUE_ON_ZERO";
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8 */;

--
-- Database: `auto_test`
--

-- --------------------------------------------------------

--
-- Table structure for table `booklet`
--

CREATE TABLE IF NOT EXISTS `booklet` (
  `booklet_id` varchar(8) NOT NULL,
  `user_id` int(8) NOT NULL,
  `upload_date` date NOT NULL,
  `data` varchar(255) NOT NULL,
  `expired_date` date NOT NULL,
  `subject` varchar(255) DEFAULT NULL,
  `description` varchar(255) DEFAULT NULL,
  PRIMARY KEY (`booklet_id`),
  KEY `User_do_test` (`user_id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Dumping data for table `booklet`
--

INSERT INTO `booklet` (`booklet_id`, `user_id`, `upload_date`, `data`, `expired_date`, `subject`, `description`) VALUES
('1', 2, '2013-03-04', '123', '2013-03-15', 'Mathematic', 'This is the midterm mathematic test'),
('2', 3, '2013-03-11', '1234', '2013-03-29', NULL, NULL);

-- --------------------------------------------------------

--
-- Table structure for table `exam`
--

CREATE TABLE IF NOT EXISTS `exam` (
  `examinee_id` int(8) NOT NULL,
  `booklet_id` int(8) NOT NULL,
  `examiner_id` int(8) NOT NULL,
  `reply` varchar(255) NOT NULL,
  `result` double(5,3) NOT NULL,
  PRIMARY KEY (`examinee_id`,`booklet_id`),
  KEY `User_Mark_tests` (`examiner_id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Dumping data for table `exam`
--

INSERT INTO `exam` (`examinee_id`, `booklet_id`, `examiner_id`, `reply`, `result`) VALUES
(2, 1, 7, 'abc', 0.000),
(6, 1, 7, 'ffffffffffff', 5.000);

-- --------------------------------------------------------

--
-- Table structure for table `organiztion`
--

CREATE TABLE IF NOT EXISTS `organiztion` (
  `organiztion_id` char(8) NOT NULL,
  `organization_name` varchar(400) NOT NULL,
  `address` varchar(300) NOT NULL,
  PRIMARY KEY (`organiztion_id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Dumping data for table `organiztion`
--

INSERT INTO `organiztion` (`organiztion_id`, `organization_name`, `address`) VALUES
('HUST', 'Đại học Bách Khoa Hà Nội - Hanoi University of Science and Technology', '1, Đại Cồ Việt, Hai Bà Trưng, Hà Nội'),
('NEU', 'Dai hoc kinh te', 'Dai La- Ha Noi');

-- --------------------------------------------------------

--
-- Table structure for table `user`
--

CREATE TABLE IF NOT EXISTS `user` (
  `user_id` int(10) NOT NULL AUTO_INCREMENT,
  `organiztion_id` varchar(8) NOT NULL,
  `username` varchar(30) NOT NULL,
  `name` varchar(100) NOT NULL,
  `password` varchar(255) NOT NULL,
  `type` varchar(5) NOT NULL,
  `phone` varchar(15) NOT NULL,
  `email` varchar(50) NOT NULL,
  `address` varchar(200) DEFAULT NULL,
  `birthday` date DEFAULT NULL,
  PRIMARY KEY (`user_id`,`organiztion_id`),
  KEY `User_Id` (`user_id`)
) ENGINE=InnoDB  DEFAULT CHARSET=utf8 AUTO_INCREMENT=9 ;

--
-- Dumping data for table `user`
--

INSERT INTO `user` (`user_id`, `organiztion_id`, `username`, `name`, `password`, `type`, `phone`, `email`, `address`, `birthday`) VALUES
(1, 'HUST', 'HUST00000001', 'Huỳnh Quyết Thắng', 'c4ca4238a0b923820dcc509a6f75849b', '10000', '0999999999', 'thanghq@hust.vn', '1, Đại Cồ Việt, Hà Nội', '0000-00-00'),
(2, 'HUST', 'HUST20082913', 'Ngô Anh Tuấn', 'c4ca4238a0b923820dcc509a6f75849b', '00001', '01689908435', 'ngoanhtuan.bkhn@gmail.com', '325 Kim Ngưu, Hà Nội', '1990-05-06'),
(3, 'NEU', 'luan', 'Dang Van Luan', 'c4ca4238a0b923820dcc509a6f75849b', '01000', '13123124124123', 'bizongcntt1990@gmail.com', 'Dong Anh- Ha Noi', '0000-00-00'),
(4, 'HUST', 'HUST20080001', 'Nguyễn Thành Bắc', 'c4ca4238a0b923820dcc509a6f75849b', '01000', '01697941913', 'u_bongbot@yahoo.com', 'Long Bien', '1980-01-01'),
(5, 'NEU', 'NEU0002', 'Hoàng Mai Huyền', 'c4ca4238a0b923820dcc509a6f75849b', '00100', '9179414', 'hohaoxa@jajc.com', 'Gia Lâm', '2013-03-01'),
(6, 'HUST', 'HUST20080003', 'Kiếng Cận', 'c4ca4238a0b923820dcc509a6f75849b', '00010', '91741414', 'aiacalc@lalcmac.com', 'Cầu Giấy', '2013-03-24'),
(7, 'NEU', 'NEU20080002', 'Hót Hót', 'c4ca4238a0b923820dcc509a6f75849b', '00001', '979414', 'ọcnax@lamcac.com', 'Mỹ ĐÌnh', '2013-03-25'),
(8, 'HUST', 'HUST20080002', 'Bê ka A', 'c4ca4238a0b923820dcc509a6f75849b', '00100', '9174981', 'kacacnlamc@aknxa.com', 'Bắc Giang', '2013-03-08');

--
-- Constraints for dumped tables
--

--
-- Constraints for table `booklet`
--
ALTER TABLE `booklet`
  ADD CONSTRAINT `User_do_test` FOREIGN KEY (`user_id`) REFERENCES `user` (`user_id`) ON DELETE NO ACTION ON UPDATE NO ACTION;

--
-- Constraints for table `exam`
--
ALTER TABLE `exam`
  ADD CONSTRAINT `User_Mark_tests` FOREIGN KEY (`examiner_id`) REFERENCES `user` (`user_id`) ON DELETE NO ACTION ON UPDATE NO ACTION;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
