-- phpMyAdmin SQL Dump
-- version 3.5.2
-- http://www.phpmyadmin.net
--
-- Host: localhost
-- Generation Time: Mar 15, 2013 at 08:42 AM
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
  `booklet_id` int(8) NOT NULL AUTO_INCREMENT,
  `user_id` int(8) NOT NULL,
  `upload_date` date NOT NULL,
  `data` longtext NOT NULL,
  `starting_date` datetime NOT NULL,
  `expired_date` datetime NOT NULL,
  `test_time` int(11) NOT NULL,
  `subject` varchar(255) DEFAULT NULL,
  `description` varchar(255) DEFAULT NULL,
  PRIMARY KEY (`booklet_id`),
  KEY `User_do_test` (`user_id`)
) ENGINE=InnoDB  DEFAULT CHARSET=utf8 AUTO_INCREMENT=76 ;

--
-- Dumping data for table `booklet`
--

INSERT INTO `booklet` (`booklet_id`, `user_id`, `upload_date`, `data`, `starting_date`, `expired_date`, `test_time`, `subject`, `description`) VALUES
(73, 5, '2013-03-15', '{"TestSubTitle":"\\u65e5\\u672c\\u8a9e\\u30c6\\u30b9\\u30c8\\u7b2c\\uff13\\u9031","StartDateTime":2076,"TestTime":60,"TestType":"Fix","0":{"type":"QS","question":"Meeting \\u3092\\u30ab\\u30bf\\u30ab\\u30ca\\u3067\\u8868\\u8a18\\u3057\\u306a\\u3055\\u3044\\u3002","selection":{"1":"\\u30df\\u30fc\\u30c6\\u30a3\\u30f3\\u30b0","2":"\\u30e1\\u30fc\\u30c6\\u30a3\\u30f3\\u30b0","3":"\\u30df\\u30c3\\u30c6\\u30a3\\u30f3\\u30b0","4":"\\u30e1\\u30c6\\u30a3\\u30f3\\u30b0","5":"\\u30df\\u30c6\\u30a3\\u30f3\\u30b0","6":"\\u30df\\u30fc\\u30c1\\u30f3\\u30b0"},"question_timeout":{"type":"LM","type_lm":"TRI","value":"1","value_ults":"m"},"answer":{"1":{"KS":"S(1)"}},"SC":{"AN(1)":"10"}},"1":{"type":"QS","question":"computer \\u3092\\u30ab\\u30bf\\u30ab\\u30ca\\u3067\\u8868\\u8a18\\u3057\\u306a\\u3055\\u3044\\u3002","selection":{"1":"\\u30b3\\u30e0\\u30d4\\u30e5\\u30fc\\u30bf","2":"\\u30b3\\u30e0\\u30d4\\u30e5\\u30fc\\u30bf\\u30fc","3":"\\u30b3\\u30f3\\u30d7\\u30fc\\u30bf","4":"\\u30b3\\u30f3\\u30d4\\u30e5\\u30fc\\u30bf\\u30fc","5":"\\u30b3\\u30f3\\u30d4\\u30e5\\u30fc\\u30bf","6":"\\u30b3\\u30e0\\u30d4\\u30e5\\u30fc\\u30bf\\u30fc"},"question_timeout":{"type":"LM","type_lm":"REC","value":"1","value_ults":"m"},"answer":{"1":{"KSO":["S(4)","S(5)"]}},"SC":{"AN(1)":"10"}},"2":{"type":"QW","question":"\\u300c\\u91cd\\u8907\\u300d\\u3092\\u3072\\u3089\\u304c\\u306a\\u3067\\u89e3\\u7b54\\u6b04\\u306b\\u8868\\u8a18\\u3057\\u306a\\u3055\\u3044\\u3002","selection":{"1":"20"},"question_timeout":{"type":"LM","type_lm":"TRAP","value1":"30","value_ults1":"s","value2":"1","value_ults2":"m"},"SC":{"AN(1)":"10","AN(2)":"20"}},"3":{"type":"QS","question":"\\u4ee5\\u4e0b\\u306e\\u8aac\\u660e\\u3067\\u9069\\u5207\\u3060\\u3068\\u601d\\u308f\\u308c\\u308b\\u3082\\u306e\\u3092\\u5168\\u3066\\u9078\\u629e\\u3057\\u306a\\u3055\\u3044\\u3002","selection":{"1":"\\u6606\\u866b\\u306f\\uff16\\u672c\\u8db3\\u3067\\u3042\\u308b\\u3002","2":"\\u722c\\u866b\\u985e\\u306f\\uff14\\u672c\\u8db3\\u3067\\u3042\\u308b\\u3002","3":"\\u7bc0\\u8db3\\u985e\\u306f\\u5076\\u6570\\u672c\\u8db3\\u3067\\u3042\\u308b\\u3002","4":"\\u54fa\\u4e73\\u985e\\u306f\\uff12\\u672c\\u8db3\\u3067\\u3042\\u308b\\u3002","5":"\\u9ce5\\u985e\\u306f\\uff14\\u672c\\u8db3\\u3067\\u3042\\u308b\\u3002","6":"\\u7537\\u6027\\u306f\\uff13\\u672c\\u8db3\\u3067\\u3042\\u308b\\u3002","7":"\\u5358\\u7d30\\u80de\\u751f\\u7269\\u306b\\u306f\\u8db3\\u304c\\u7121\\u3044\\u3002"},"question_timeout":{"type":"TM","value":"3"},"answer":{"3":{"KWA":"S(1)"}},"ANC":["AN(1)","AN(2)"],"SC":{"AN(1)":"5","AN(2)":"5","AN(3)":"10","AN(4)":"2"}}}', '2012-10-12 07:35:00', '0000-00-00 00:00:00', 60, '日本語テスト第３週', NULL),
(74, 5, '2013-03-15', '{"TestSubTitle":"\\u65e5\\u672c\\u8a9e\\u30c6\\u30b9\\u30c8\\u7b2c\\uff13\\u9031","StartDateTime":2076,"EndDateTime":2086,"TestType":"Unfix","0":{"type":"QS","question":"Meeting \\u3092\\u30ab\\u30bf\\u30ab\\u30ca\\u3067\\u8868\\u8a18\\u3057\\u306a\\u3055\\u3044\\u3002","selection":{"1":"\\u30df\\u30fc\\u30c6\\u30a3\\u30f3\\u30b0","2":"\\u30e1\\u30fc\\u30c6\\u30a3\\u30f3\\u30b0","3":"\\u30df\\u30c3\\u30c6\\u30a3\\u30f3\\u30b0","4":"\\u30e1\\u30c6\\u30a3\\u30f3\\u30b0","5":"\\u30df\\u30c6\\u30a3\\u30f3\\u30b0","6":"\\u30df\\u30fc\\u30c1\\u30f3\\u30b0"},"answer":{"1":{"KS":"S(1)"}}},"1":{"type":"QS","question":"computer \\u3092\\u30ab\\u30bf\\u30ab\\u30ca\\u3067\\u8868\\u8a18\\u3057\\u306a\\u3055\\u3044\\u3002","selection":{"1":"\\u30b3\\u30e0\\u30d4\\u30e5\\u30fc\\u30bf","2":"\\u30b3\\u30e0\\u30d4\\u30e5\\u30fc\\u30bf\\u30fc","3":"\\u30b3\\u30f3\\u30d7\\u30fc\\u30bf","4":"\\u30b3\\u30f3\\u30d4\\u30e5\\u30fc\\u30bf\\u30fc","5":"\\u30b3\\u30f3\\u30d4\\u30e5\\u30fc\\u30bf","6":"\\u30b3\\u30e0\\u30d4\\u30e5\\u30fc\\u30bf\\u30fc"},"answer":{"1":{"KSO":["S(4)","S(5)"]}},"SC":{"AN(1)":"10"}},"2":{"type":"QS","question":"computer \\u3092\\u30ab\\u30bf\\u30ab\\u30ca\\u3067\\u8868\\u8a18\\u3057\\u306a\\u3055\\u3044\\u3002","selection":{"1":"\\u30b3\\u30e0\\u30d4\\u30e5\\u30fc\\u30bf","2":"\\u30b3\\u30e0\\u30d4\\u30e5\\u30fc\\u30bf\\u30fc","3":"\\u30b3\\u30f3\\u30d7\\u30fc\\u30bf","4":"\\u30b3\\u30f3\\u30d4\\u30e5\\u30fc\\u30bf\\u30fc","5":"\\u30b3\\u30f3\\u30d4\\u30e5\\u30fc\\u30bf","6":"\\u30b3\\u30e0\\u30d4\\u30e5\\u30fc\\u30bf\\u30fc"},"answer":{"1":{"KSO":["S(4)","S(5)"]}},"SC":{"AN(1)":"10"}},"3":{"type":"QW","question":"\\u300c\\u91cd\\u8907\\u300d\\u3092\\u3072\\u3089\\u304c\\u306a\\u3067\\u89e3\\u7b54\\u6b04\\u306b\\u8868\\u8a18\\u3057\\u306a\\u3055\\u3044\\u3002","selection":{"1":"20"}},"4":{"type":"QS","question":"\\u4ee5\\u4e0b\\u306e\\u8aac\\u660e\\u3067\\u9069\\u5207\\u3060\\u3068\\u601d\\u308f\\u308c\\u308b\\u3082\\u306e\\u3092\\u5168\\u3066\\u9078\\u629e\\u3057\\u306a\\u3055\\u3044\\u3002","selection":{"1":"\\u6606\\u866b\\u306f\\uff16\\u672c\\u8db3\\u3067\\u3042\\u308b\\u3002","2":"\\u722c\\u866b\\u985e\\u306f\\u5168\\u3066\\uff14\\u672c\\u8db3\\u3067\\u3042\\u308b\\u3002","3":"\\u7bc0\\u8db3\\u985e\\u306f\\u5076\\u6570\\u672c\\u8db3\\u3067\\u3042\\u308b\\u3002","4":"\\u54fa\\u4e73\\u985e\\u306f\\uff12\\u672c\\u8db3\\u3067\\u3042\\u308b\\u3002","5":"\\u9ce5\\u985e\\u306f\\uff14\\u672c\\u8db3\\u3067\\u3042\\u308b\\u3002","6":"\\u7537\\u6027\\u306f\\uff13\\u672c\\u8db3\\u3067\\u3042\\u308b\\u3002","7":"\\u5358\\u7d30\\u80de\\u751f\\u7269\\u306b\\u306f\\u8db3\\u304c\\u7121\\u3044\\u3002"},"answer":{"1":{"KS":"S(1)"},"2":{"KS":"S(3)"},"3":{"KSA":["S(1)","S(3)"]},"4":{"KSO":["S(2)","S(4)","S(5)","S(6)","S(7)"]}},"SC":{"AN(1)":"5","AN(2)":"5","AN(3)":"10","AN(4)":"3"}},"5":{"type":"QW","question":"\\u30ea\\u30fc\\u30c0\\u3068\\u3057\\u3066\\u5fc5\\u8981\\u306a\\u8cc7\\u683c\\u3092\\u601d\\u3044\\u3064\\u304f\\u9650\\u308a\\u5168\\u3066\\u8ff0\\u3079\\u306a\\u3055\\u3044\\u3002","selection":{"1":"1000"},"INS":"CINP","SC":{"VINP":"\\/* \\u63a1\\u70b9\\u8005\\u4ecb\\u5165\\u5f97\\u70b9\\u5165\\u529b *\\/"}},"6":{"type":"QW","question":"\\u30c1\\u30fc\\u30e0\\u30ef\\u30fc\\u30af\\u306b\\u5fc5\\u8981\\u306a\\u3082\\u306e\\u3092\\u601d\\u3044\\u3064\\u304f\\u9650\\u308a\\u5168\\u3066\\u8ff0\\u3079\\u306a\\u3055\\u3044\\u3002","selection":{"1":"20","2":"20","3":"20","4":"20","5":"20","6":"20","7":"20","8":"20","9":"20","10":"20"},"answer":{"1":{"KWPO":["\\u3084\\u308b\\u6c17","\\u30e2\\u30c1\\u30d9\\u30fc\\u30b7\\u30e7\\u30f3"]},"2":{"KWP":"\\u30b3\\u30df\\u30e5\\u30cb\\u30b1\\u30fc\\u30b7\\u30e7\\u30f3"},"3":{"KWP":"\\u98f2\\u30df\\u30cb\\u30b1\\u30fc\\u30b7\\u30e7\\u30f3"},"4":{"KWP":"\\u601d\\u3044\\u3084\\u308a"},"5":{"KWP":"\\u30ea\\u30fc\\u30c0"},"6":{"KWP":"\\u30e1\\u30f3\\u30d0"},"7":{"KWP":"\\u76ee\\u7684"},"8":{"KWP":"\\u76ee\\u6a19"},"9":{"KWP":"\\u8cea\\u554f"},"10":{"KWP":"\\u78ba\\u8a8d"}},"INS":"CINP","SC":{"AN(1)":"3","AN(2)":"3","AN(3)":"3","AN(4)":"3","AN(5)":"3","AN(6)":"3","AN(7)":"3","AN(8)":"3","AN(9)":"3","AN(10)":"3","VINP":"\\/* \\u63a1\\u70b9\\u8005\\u4ecb\\u5165\\u70b9\\u6570\\u5909\\u66f4\\u5165\\u529b *\\/"}},"7":{"type":"QW","question":"\\u30d6\\u30ea\\u30c3\\u30b8\\uff33\\uff25\\u306b\\u671f\\u5f85\\u3055\\u308c\\u308b\\u3053\\u3068\\u3092\\uff13\\u3064\\u8ff0\\u3079\\u306a\\u3055\\u3044\\u3002","selection":{"1":"16","2":"16","3":"16"},"answer":{"1":{"KWPO":["\\u8a9e\\u5b66","\\u30d0\\u30a4\\u30ea\\u30f3\\u30ac\\u30eb"]},"2":{"KWPO":["\\u8a2d\\u8a08","\\u30c7\\u30b6\\u30a4\\u30f3"]},"3":{"KWPO":["\\u30ea\\u30fc\\u30c0\\u30b7\\u30c3\\u30d7","\\u30de\\u30cd\\u30fc\\u30b8\\u30e1\\u30f3\\u30c8"]}},"ANC":["AN(1)","AN(2)","AN(3)","AN(4)","","\\/* \\u9806\\u4e0d\\u540c *\\/"],"INS":"CINP","SC":{"AN(1)":"5","AN(2)":"5","AN(3)":"5","AN(4)":"1","VINP":"\\/* \\u63a1\\u70b9\\u8005\\u4ecb\\u5165\\u70b9\\u6570\\u5909\\u66f4\\u5165\\u529b *\\/"}}}', '2012-10-12 07:35:00', '2012-10-12 07:45:00', 0, '日本語テスト第３週', NULL),
(75, 5, '2013-03-15', '{"TestSubTitle":"\\u65e5\\u672c\\u8a9e\\u30c6\\u30b9\\u30c8\\u7b2c\\uff13\\u9031","StartDateTime":2076,"TestTime":60,"TestType":"Fix","0":{"type":"QS","question":"Meeting \\u3092\\u30ab\\u30bf\\u30ab\\u30ca\\u3067\\u8868\\u8a18\\u3057\\u306a\\u3055\\u3044\\u3002","selection":{"1":"\\u30df\\u30fc\\u30c6\\u30a3\\u30f3\\u30b0","2":"\\u30e1\\u30fc\\u30c6\\u30a3\\u30f3\\u30b0","3":"\\u30df\\u30c3\\u30c6\\u30a3\\u30f3\\u30b0","4":"\\u30e1\\u30c6\\u30a3\\u30f3\\u30b0","5":"\\u30df\\u30c6\\u30a3\\u30f3\\u30b0","6":"\\u30df\\u30fc\\u30c1\\u30f3\\u30b0"},"question_timeout":{"type":"LM","type_lm":"TRI","value":"1","value_ults":"m"},"answer":{"1":{"KS":"S(1)"}},"SC":{"AN(1)":"10"}},"1":{"type":"QS","question":"computer \\u3092\\u30ab\\u30bf\\u30ab\\u30ca\\u3067\\u8868\\u8a18\\u3057\\u306a\\u3055\\u3044\\u3002","selection":{"1":"\\u30b3\\u30e0\\u30d4\\u30e5\\u30fc\\u30bf","2":"\\u30b3\\u30e0\\u30d4\\u30e5\\u30fc\\u30bf\\u30fc","3":"\\u30b3\\u30f3\\u30d7\\u30fc\\u30bf","4":"\\u30b3\\u30f3\\u30d4\\u30e5\\u30fc\\u30bf\\u30fc","5":"\\u30b3\\u30f3\\u30d4\\u30e5\\u30fc\\u30bf","6":"\\u30b3\\u30e0\\u30d4\\u30e5\\u30fc\\u30bf\\u30fc"},"question_timeout":{"type":"LM","type_lm":"REC","value":"1","value_ults":"m"},"answer":{"1":{"KSO":["S(4)","S(5)"]}},"SC":{"AN(1)":"10"}},"2":{"type":"QW","question":"\\u300c\\u91cd\\u8907\\u300d\\u3092\\u3072\\u3089\\u304c\\u306a\\u3067\\u89e3\\u7b54\\u6b04\\u306b\\u8868\\u8a18\\u3057\\u306a\\u3055\\u3044\\u3002","selection":{"1":"20"},"question_timeout":{"type":"LM","type_lm":"TRAP","value1":"30","value_ults1":"s","value2":"1","value_ults2":"m"},"SC":{"AN(1)":"10","AN(2)":"20"}},"3":{"type":"QS","question":"\\u4ee5\\u4e0b\\u306e\\u8aac\\u660e\\u3067\\u9069\\u5207\\u3060\\u3068\\u601d\\u308f\\u308c\\u308b\\u3082\\u306e\\u3092\\u5168\\u3066\\u9078\\u629e\\u3057\\u306a\\u3055\\u3044\\u3002","selection":{"1":"\\u6606\\u866b\\u306f\\uff16\\u672c\\u8db3\\u3067\\u3042\\u308b\\u3002","2":"\\u722c\\u866b\\u985e\\u306f\\uff14\\u672c\\u8db3\\u3067\\u3042\\u308b\\u3002","3":"\\u7bc0\\u8db3\\u985e\\u306f\\u5076\\u6570\\u672c\\u8db3\\u3067\\u3042\\u308b\\u3002","4":"\\u54fa\\u4e73\\u985e\\u306f\\uff12\\u672c\\u8db3\\u3067\\u3042\\u308b\\u3002","5":"\\u9ce5\\u985e\\u306f\\uff14\\u672c\\u8db3\\u3067\\u3042\\u308b\\u3002","6":"\\u7537\\u6027\\u306f\\uff13\\u672c\\u8db3\\u3067\\u3042\\u308b\\u3002","7":"\\u5358\\u7d30\\u80de\\u751f\\u7269\\u306b\\u306f\\u8db3\\u304c\\u7121\\u3044\\u3002"},"question_timeout":{"type":"TM","value":"3"},"answer":{"3":{"KWA":"S(1)"}},"ANC":["AN(1)","AN(2)"],"SC":{"AN(1)":"5","AN(2)":"5","AN(3)":"10","AN(4)":"2"}}}', '2012-10-12 07:35:00', '0000-00-00 00:00:00', 60, '日本語テスト第３週', NULL);

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
(49, 39, 0, '', 0.000),
(49, 40, 0, '', 0.000),
(50, 31, 0, '', 0.000),
(50, 32, 0, '', 0.000),
(50, 33, 0, '', 0.000),
(50, 34, 0, '', 0.000),
(50, 35, 0, '', 0.000),
(50, 36, 0, '', 0.000),
(50, 37, 0, '', 0.000),
(50, 38, 0, '', 0.000),
(50, 39, 0, '', 0.000),
(50, 40, 0, '', 0.000),
(51, 31, 0, '', 0.000),
(51, 32, 0, '', 0.000),
(51, 33, 0, '', 0.000),
(51, 34, 0, '', 0.000),
(51, 36, 0, '', 0.000),
(51, 38, 0, '', 0.000),
(52, 41, 0, '', 0.000),
(52, 42, 0, '', 0.000),
(52, 43, 0, '', 0.000),
(52, 44, 0, '', 0.000),
(52, 45, 0, '', 0.000),
(52, 46, 0, '', 0.000),
(52, 47, 0, '', 0.000),
(52, 48, 0, '', 0.000),
(52, 49, 0, '', 0.000),
(52, 50, 0, '', 0.000),
(52, 51, 0, '', 0.000),
(52, 52, 0, '', 0.000),
(52, 53, 0, '', 0.000),
(52, 54, 0, '', 0.000),
(52, 55, 0, '', 0.000),
(52, 56, 0, '', 0.000),
(52, 57, 0, '', 0.000),
(52, 58, 0, '', 0.000),
(52, 59, 0, '', 0.000),
(52, 60, 0, '', 0.000),
(52, 61, 0, '', 0.000),
(52, 62, 0, '', 0.000),
(52, 63, 0, '', 0.000),
(52, 64, 0, '', 0.000),
(52, 65, 0, '', 0.000),
(52, 66, 0, '', 0.000),
(52, 67, 0, '', 0.000),
(52, 68, 0, '', 0.000),
(52, 69, 0, '', 0.000),
(52, 70, 0, '', 0.000),
(52, 71, 0, '', 0.000),
(52, 72, 0, '', 0.000),
(52, 73, 0, '', 0.000),
(52, 74, 0, '', 0.000),
(52, 75, 0, '', 0.000),
(53, 41, 0, '', 0.000),
(53, 42, 0, '', 0.000),
(53, 43, 0, '', 0.000),
(53, 44, 0, '', 0.000),
(53, 45, 0, '', 0.000),
(53, 46, 0, '', 0.000),
(53, 47, 0, '', 0.000),
(53, 48, 0, '', 0.000),
(53, 49, 0, '', 0.000),
(53, 50, 0, '', 0.000),
(53, 51, 0, '', 0.000),
(53, 52, 0, '', 0.000),
(53, 53, 0, '', 0.000),
(53, 54, 0, '', 0.000),
(53, 55, 0, '', 0.000),
(53, 56, 0, '', 0.000),
(53, 57, 0, '', 0.000),
(53, 58, 0, '', 0.000),
(53, 59, 0, '', 0.000),
(53, 60, 0, '', 0.000),
(53, 61, 0, '', 0.000),
(53, 62, 0, '', 0.000),
(53, 63, 0, '', 0.000),
(53, 64, 0, '', 0.000),
(53, 65, 0, '', 0.000),
(53, 66, 0, '', 0.000),
(53, 67, 0, '', 0.000),
(53, 68, 0, '', 0.000),
(53, 69, 0, '', 0.000),
(53, 70, 0, '', 0.000),
(53, 71, 0, '', 0.000),
(53, 72, 0, '', 0.000),
(53, 73, 0, '', 0.000),
(53, 74, 0, '', 0.000),
(53, 75, 0, '', 0.000),
(54, 41, 0, '', 0.000),
(54, 42, 0, '', 0.000),
(54, 43, 0, '', 0.000),
(54, 44, 0, '', 0.000),
(54, 45, 0, '', 0.000),
(54, 46, 0, '', 0.000),
(54, 47, 0, '', 0.000),
(54, 48, 0, '', 0.000),
(54, 49, 0, '', 0.000),
(54, 50, 0, '', 0.000),
(54, 51, 0, '', 0.000),
(54, 52, 0, '', 0.000),
(54, 53, 0, '', 0.000),
(54, 54, 0, '', 0.000),
(54, 55, 0, '', 0.000),
(54, 56, 0, '', 0.000),
(54, 57, 0, '', 0.000),
(54, 58, 0, '', 0.000),
(54, 59, 0, '', 0.000),
(54, 60, 0, '', 0.000),
(54, 61, 0, '', 0.000),
(54, 62, 0, '', 0.000),
(54, 63, 0, '', 0.000),
(54, 64, 0, '', 0.000),
(54, 65, 0, '', 0.000),
(54, 66, 0, '', 0.000),
(54, 67, 0, '', 0.000),
(54, 68, 0, '', 0.000),
(54, 69, 0, '', 0.000),
(54, 70, 0, '', 0.000),
(54, 71, 0, '', 0.000),
(54, 72, 0, '', 0.000),
(54, 73, 0, '', 0.000),
(54, 74, 0, '', 0.000),
(54, 75, 0, '', 0.000),
(55, 41, 0, '', 0.000),
(55, 42, 0, '', 0.000),
(55, 43, 0, '', 0.000),
(55, 44, 0, '', 0.000),
(55, 45, 0, '', 0.000),
(55, 46, 0, '', 0.000),
(55, 47, 0, '', 0.000),
(55, 48, 0, '', 0.000),
(55, 49, 0, '', 0.000),
(55, 50, 0, '', 0.000),
(55, 51, 0, '', 0.000),
(55, 52, 0, '', 0.000),
(55, 53, 0, '', 0.000),
(55, 54, 0, '', 0.000),
(55, 55, 0, '', 0.000),
(55, 56, 0, '', 0.000),
(55, 57, 0, '', 0.000),
(55, 58, 0, '', 0.000),
(55, 59, 0, '', 0.000),
(55, 60, 0, '', 0.000),
(55, 61, 0, '', 0.000),
(55, 62, 0, '', 0.000),
(55, 63, 0, '', 0.000),
(55, 64, 0, '', 0.000),
(55, 65, 0, '', 0.000),
(55, 66, 0, '', 0.000),
(55, 67, 0, '', 0.000),
(55, 68, 0, '', 0.000),
(55, 69, 0, '', 0.000),
(55, 70, 0, '', 0.000),
(55, 71, 0, '', 0.000),
(55, 72, 0, '', 0.000),
(55, 73, 0, '', 0.000),
(55, 74, 0, '', 0.000),
(55, 75, 0, '', 0.000),
(56, 48, 0, '', 0.000),
(56, 53, 0, '', 0.000),
(56, 57, 0, '', 0.000),
(56, 74, 0, '', 0.000);

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
  `user_id` int(8) NOT NULL AUTO_INCREMENT,
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
) ENGINE=InnoDB  DEFAULT CHARSET=utf8 AUTO_INCREMENT=57 ;

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
(8, 'HUST', 'HUST20080002', 'Bê ka A', 'c4ca4238a0b923820dcc509a6f75849b', '00100', '9174981', 'kacacnlamc@aknxa.com', 'Bắc Giang', '2013-03-08'),
(52, 'NEU', 'HUST20083562', 'AS1-権代', '50fef5ff033cc991787d5afcd5217490', '00001', '', '', NULL, NULL),
(53, 'NEU', 'HUST20083563', 'AS2-コン', '50fef5ff033cc991787d5afcd5217490', '00001', '', '', NULL, NULL),
(54, 'NEU', 'HUST20083565', 'AS1-ゴック', '50fef5ff033cc991787d5afcd5217490', '00001', '', '', NULL, NULL),
(55, 'NEU', 'HUST20083566', 'AS3-Ly', '50fef5ff033cc991787d5afcd5217490', '00001', '', '', NULL, NULL),
(56, 'NEU', 'HUST20083567', 'AS3-Ly', '50fef5ff033cc991787d5afcd5217490', '00001', '', '', NULL, NULL);

--
-- Constraints for dumped tables
--

--
-- Constraints for table `booklet`
--
ALTER TABLE `booklet`
  ADD CONSTRAINT `User_do_test` FOREIGN KEY (`user_id`) REFERENCES `user` (`user_id`) ON DELETE NO ACTION ON UPDATE NO ACTION;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
