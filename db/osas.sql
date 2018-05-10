-- phpMyAdmin SQL Dump
-- version 4.5.1
-- http://www.phpmyadmin.net
--
-- Host: 127.0.0.1
-- Generation Time: May 09, 2018 at 06:05 PM
-- Server version: 10.1.8-MariaDB
-- PHP Version: 5.6.14

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `osas`
--

DELIMITER $$
--
-- Procedures
--
DROP PROCEDURE IF EXISTS `Active_AssignConfilicts_SemClearance`$$
CREATE DEFINER=`root`@`localhost` PROCEDURE `Active_AssignConfilicts_SemClearance` (IN `id` INT)  NO SQL
UPDATE `t_assign_student_clearance` SET 
`AssStudClearance_DATE_MOD`=CURRENT_TIMESTAMP
,`AssStudClearance_DISPLAY_STAT`='Active' 
WHERE `AssStudClearance_ID` =id$$

DROP PROCEDURE IF EXISTS `Archive_AssignConfilicts_SemClearance`$$
CREATE DEFINER=`root`@`localhost` PROCEDURE `Archive_AssignConfilicts_SemClearance` (IN `id` INT)  NO SQL
UPDATE `t_assign_student_clearance` SET 
`AssStudClearance_DATE_MOD`=CURRENT_TIMESTAMP
,`AssStudClearance_DISPLAY_STAT`='Inactive' 
WHERE `AssStudClearance_ID` =id$$

DROP PROCEDURE IF EXISTS `Archive_AssignSanction`$$
CREATE DEFINER=`root`@`localhost` PROCEDURE `Archive_AssignSanction` (IN `ID` INT)  NO SQL
UPDATE `t_assign_stud_saction` SET `AssSancStudStudent_DISPLAY_STAT`='Inactive' 
,`AssSancStudStudent_DATE_MOD` = CURRENT_TIMESTAMP
WHERE
`AssSancStudStudent_ID` =ID$$

DROP PROCEDURE IF EXISTS `Archive_FinancialAss`$$
CREATE DEFINER=`root`@`localhost` PROCEDURE `Archive_FinancialAss` (IN `ID` INT(100))  NO SQL
delete from `t_assign_stud_finan_assistance`  
where AssStudFinanAssistance_ID = ID$$

DROP PROCEDURE IF EXISTS `Archive_LossIDRegi`$$
CREATE DEFINER=`root`@`localhost` PROCEDURE `Archive_LossIDRegi` (IN `ID` INT)  NO SQL
update t_assign_stud_loss_id_regicard 
set AssLoss_DISPLAY_STAT ='Inactive'
where AssLoss_ID =ID$$

DROP PROCEDURE IF EXISTS `FinishSanction`$$
CREATE DEFINER=`root`@`localhost` PROCEDURE `FinishSanction` (IN `ID` INT)  NO SQL
UPDATE t_assign_stud_saction 
set AssSancStudStudent_IS_FINISH ='Finished'
where AssSancStudStudent_ID =ID$$

DROP PROCEDURE IF EXISTS `Insert_AssignConfilicts_SemClearance`$$
CREATE DEFINER=`root`@`localhost` PROCEDURE `Insert_AssignConfilicts_SemClearance` (IN `Studno` VARCHAR(15), IN `acadyear` VARCHAR(15), IN `sem` VARCHAR(50), IN `sigcode` VARCHAR(15))  NO SQL
INSERT INTO `t_assign_student_clearance` (`AssStudClearance_STUD_NO`, `AssStudClearance_BATCH`, `AssStudClearance_SEMESTER`, `AssStudClearance_SIGNATORIES_CODE`) VALUES (Studno,acadyear,sem,sigcode)$$

DROP PROCEDURE IF EXISTS `Insert_AssignFinancialAss`$$
CREATE DEFINER=`root`@`localhost` PROCEDURE `Insert_AssignFinancialAss` (IN `StudNo` VARCHAR(15), IN `FinanAssTitle` VARCHAR(100), IN `FinanAssStatus` ENUM('Active','Inactive','Void','Cancelled'), IN `FinanAssRemarks` VARCHAR(500))  NO SQL
INSERT INTO `t_assign_stud_finan_assistance` (`AssStudFinanAssistance_STUD_NO`, `AssStudFinanAssistance_FINAN_NAME`, `AssStudFinanAssistance_STATUS`, `AssStudFinanAssistance_REMARKS`, `AssStudFinanAssistance_DATE_ADD`) VALUES (StudNo,FinanAssTitle , FinanAssStatus, FinanAssRemarks, CURRENT_TIMESTAMP)$$

DROP PROCEDURE IF EXISTS `Insert_AssignSanction`$$
CREATE DEFINER=`root`@`localhost` PROCEDURE `Insert_AssignSanction` (IN `StudNo` VARCHAR(15), IN `SancCode` VARCHAR(100), IN `DesOffCode` VARCHAR(15), IN `Cons` INT, IN `Finish` ENUM('Finished','Processing'), IN `remarks` VARCHAR(100), IN `done` DATE)  NO SQL
BEGIN
INSERT INTO `t_assign_stud_saction`(`AssSancStudStudent_STUD_NO`, `AssSancStudStudent_SancDetails_CODE`, `AssSancStudStudent_DesOffDetails_CODE`,
`AssSancStudStudent_CONSUMED_HOURS`,
`AssSancStudStudent_IS_FINISH`,
`AssSancStudStudent_REMARKS`,
`AssSancStudStudent_TO_BE_DONE`) VALUES (StudNo,SancCode,DesOffCode,Cons,Finish,remarks,done);
 CALL LOG_SANCTION((SELECT MAX(`AssSancStudStudent_ID`) FROM `t_assign_stud_saction`),Cons,remarks,Finish);
END$$

DROP PROCEDURE IF EXISTS `Insert_DesignatedOffice`$$
CREATE DEFINER=`root`@`localhost` PROCEDURE `Insert_DesignatedOffice` (IN `DesiCode` VARCHAR(15), IN `DesiName` VARCHAR(100), IN `DesiDesc` VARCHAR(100))  NO SQL
INSERT INTO `r_designated_offices_details` (  `DesOffDetails_CODE`, `DesOffDetails_NAME`, `DesOffDetails_DESC`) VALUES (DesiCode,DesiName,DesiDesc)$$

DROP PROCEDURE IF EXISTS `Insert_LossIDRegi`$$
CREATE DEFINER=`root`@`localhost` PROCEDURE `Insert_LossIDRegi` (IN `StudNo` VARCHAR(15), IN `Type` ENUM('Identification Card','Registration Card'), IN `Claim` DATETIME, IN `Remarks` VARCHAR(500))  NO SQL
INSERT INTO `t_assign_stud_loss_id_regicard` ( `AssLoss_STUD_NO`, `AssLoss_TYPE`, `AssLoss_REMARKS`, `AssLoss_DATE_CLAIM`) VALUES (StudNo,Type,Remarks,Claim)$$

DROP PROCEDURE IF EXISTS `Insert_SanctionDetails`$$
CREATE DEFINER=`root`@`localhost` PROCEDURE `Insert_SanctionDetails` (IN `SancCode` VARCHAR(100), IN `SancName` VARCHAR(100), IN `SancDesc` VARCHAR(1000), IN `TimeVal` INT(11))  NO SQL
INSERT INTO `r_sanction_details` 
(`SancDetails_CODE`
 , `SancDetails_NAME`
 , `SancDetails_DESC`
 , `SancDetails_TIMEVAL`)
 VALUES 
 (SancCode
  ,SancName
  ,SancDesc
  ,TimeVal)$$

DROP PROCEDURE IF EXISTS `Insert_Signatories`$$
CREATE DEFINER=`root`@`localhost` PROCEDURE `Insert_Signatories` (IN `sCODE` VARCHAR(15), IN `sNAME` VARCHAR(100), IN `sDESC` VARCHAR(100))  NO SQL
INSERT INTO `r_clearance_signatories` (`ClearSignatories_CODE`, `ClearSignatories_NAME`, `ClearSignatories_DESC` ) VALUES (sCODE,sNAME,sDESC)$$

DROP PROCEDURE IF EXISTS `Insert_StudProfile`$$
CREATE DEFINER=`root`@`localhost` PROCEDURE `Insert_StudProfile` (IN `StudNO` VARCHAR(15), IN `FNAME` VARCHAR(100), IN `MNAME` VARCHAR(100), IN `LNAME` VARCHAR(100), IN `COUSRE` VARCHAR(15), IN `SECTION` VARCHAR(5), IN `GENDER` VARCHAR(10), IN `EMAIL` VARCHAR(100), IN `CONTACT` VARCHAR(20), IN `BDAY` DATE, IN `BPLACE` VARCHAR(500), IN `ADDRESS` VARCHAR(500), IN `STATUS` VARCHAR(50))  NO SQL
INSERT INTO R_STUD_PROFILE
(
 Stud_No
,Stud_FNAME
,Stud_MNAME
,Stud_LNAME
,Stud_COURSE
,Stud_SECTION
,Stud_GENDER
,Stud_EMAIL
,Stud_CONTACT_NO
,Stud_BIRHT_DATE
,Stud_BIRTH_PLACE
,Stud_ADDRESS
,Stud_STATUS)
VALUES
( 
    STUDNO
    ,FNAME
  ,MNAME
  ,LNAME
  ,COUSRE
  ,SECTION
  ,GENDER
  ,EMAIL
  ,CONTACT
  ,BDAY
  ,BPLACE
  ,ADDRESS
  ,STATUS
)$$

DROP PROCEDURE IF EXISTS `Insert_Users`$$
CREATE DEFINER=`root`@`localhost` PROCEDURE `Insert_Users` (IN `Username` VARCHAR(15), IN `referencedUser` VARCHAR(15), IN `userRole` ENUM('Administrator','OSAS HEAD','Organization','Student'), IN `UPassword` VARCHAR(500))  NO SQL
INSERT INTO `r_users` (`Users_USERNAME`, `Users_REFERENCED`, `Users_ROLES`,`Users_PASSWORD`) VALUES (Username,referencedUser,userRole,AES_Encrypt(UPassword,PASSWORD('OSASMIS')))$$

DROP PROCEDURE IF EXISTS `Insert_Voucher`$$
CREATE DEFINER=`root`@`localhost` PROCEDURE `Insert_Voucher` (IN `Vouch` VARCHAR(15), IN `org` VARCHAR(15), IN `checkk` VARCHAR(100))  NO SQL
INSERT INTO `t_org_voucher` (`OrgVoucher_CASH_VOUCHER_NO`, `OrgVoucher_ORG_CODE`,`OrgVoucher_CHECKED_BY`) VALUES ( Vouch, org, checkk)$$

DROP PROCEDURE IF EXISTS `Insert_Voucher_Item`$$
CREATE DEFINER=`root`@`localhost` PROCEDURE `Insert_Voucher_Item` (IN `Vouch` VARCHAR(15), IN `itemss` VARCHAR(100), IN `amo` DOUBLE(10,3))  NO SQL
INSERT INTO `t_org_voucher_items` (`OrgVouchItems_VOUCHER_NO`, `OrgVouchItems_ITEM_NAME`, `OrgVouchItems_AMOUNT`) VALUES (Vouch,itemss,amo)$$

DROP PROCEDURE IF EXISTS `Login_User`$$
CREATE DEFINER=`root`@`localhost` PROCEDURE `Login_User` (IN `username` VARCHAR(100), IN `password` VARCHAR(100))  NO SQL
SELECT * 
FROM osas.r_users 
WHERE Users_USERNAME = username 
AND AES_DECRYPT(Users_PASSWORD , Password('OSASMIS')) =password
AND Users_DISPLAY_STAT = 'Active'$$

DROP PROCEDURE IF EXISTS `Log_Sanction`$$
CREATE DEFINER=`root`@`localhost` PROCEDURE `Log_Sanction` (IN `SancID` INT, IN `Consuumed` INT, IN `Remarks` VARCHAR(100), IN `isFinish` ENUM('Processing','Finished'))  NO SQL
INSERT INTO `log_sanction` ( `LogSanc_AssSancSudent_ID`, `LogSanc_CONSUMED_HOURS`, `LogSanc_REMARKS`, `LogSanc_IS_FINISH`) VALUES (SancID,Consuumed, Remarks, isFinish)$$

DROP PROCEDURE IF EXISTS `Update_AssignFinancialAss`$$
CREATE DEFINER=`root`@`localhost` PROCEDURE `Update_AssignFinancialAss` (IN `ID` INT, IN `FinanAssStat` ENUM('Active','Inactive','Void','Cancelled'), IN `Remarks` VARCHAR(500))  NO SQL
UPDATE `t_assign_stud_finan_assistance` 
SET `AssStudFinanAssistance_STATUS` = FinanAssStat 
,`AssStudFinanAssistance_REMARKS` = Remarks
,`AssStudFinanAssistance_DATE_MOD` = CURRENT_TIMESTAMP
WHERE `AssStudFinanAssistance_ID` = ID$$

DROP PROCEDURE IF EXISTS `Update_AssignSanction`$$
CREATE DEFINER=`root`@`localhost` PROCEDURE `Update_AssignSanction` (IN `ID` INT, IN `Consume` INT, IN `Finish` ENUM('Finished','Processing'), IN `remarks` VARCHAR(100), IN `done` DATE)  NO SQL
BEGIN
UPDATE `t_assign_stud_saction` SET 
`AssSancStudStudent_CONSUMED_HOURS` =Consume
,`AssSancStudStudent_IS_FINISH` = Finish
,`AssSancStudStudent_REMARKS` = remarks
,`AssSancStudStudent_TO_BE_DONE` = done
,`AssSancStudStudent_DATE_MOD` = CURRENT_TIMESTAMP
WHERE
`AssSancStudStudent_ID` =ID;
 call Log_Sanction(ID,Consume,remarks,Finish) ;
END$$

DROP PROCEDURE IF EXISTS `Update_LossIDRegi`$$
CREATE DEFINER=`root`@`localhost` PROCEDURE `Update_LossIDRegi` (IN `ID` INT, IN `Claim` DATETIME, IN `Remarks` VARCHAR(500))  NO SQL
update t_assign_stud_loss_id_regicard 
set AssLoss_DATE_CLAIM = Claim
,AssLoss_REMARKS = Remarks
where AssLoss_ID =ID$$

DROP PROCEDURE IF EXISTS `Update_StudProfile`$$
CREATE DEFINER=`root`@`localhost` PROCEDURE `Update_StudProfile` (IN `ID` INT(100), IN `StudNO` VARCHAR(15), IN `FNAME` VARCHAR(100), IN `MNAME` VARCHAR(100), IN `LNAME` VARCHAR(100), IN `COURSE` VARCHAR(15), IN `SECTION` VARCHAR(5), IN `GENDER` VARCHAR(10), IN `EMAIL` VARCHAR(100), IN `CONTACT` VARCHAR(20), IN `BDAY` DATE, IN `BPLACE` VARCHAR(500), IN `ADDRESS` VARCHAR(500), IN `STATUS` VARCHAR(50))  NO SQL
UPDATE `r_stud_profile`
SET 
`Stud_NO`=StudNO
,`Stud_FNAME`=FNAME
,`Stud_MNAME`=MNAME
,`Stud_LNAME`=LNAME
,`Stud_COURSE`=COURSE 
,`Stud_SECTION`=SECTION
,`Stud_GENDER`=GENDER
,`Stud_EMAIL`=EMAIL
,`Stud_CONTACT_NO`=CONTACT
,`Stud_BIRHT_DATE`=BDAY
,`Stud_BIRTH_PLACE`=BPLACE
,`Stud_ADDRESS`=ADDRESS
,`Stud_STATUS`=STATUS
,`Stud_DATE_MOD`= CURRENT_TIMESTAMP
WHERE `Stud_ID` = ID$$

DROP PROCEDURE IF EXISTS `View_Courses`$$
CREATE DEFINER=`root`@`localhost` PROCEDURE `View_Courses` ()  NO SQL
select * from r_courses where course_display_stat ='active'$$

DROP PROCEDURE IF EXISTS `View_StudProfile`$$
CREATE DEFINER=`root`@`localhost` PROCEDURE `View_StudProfile` ()  NO SQL
select 
  Stud_NO
  ,CONCAT(Stud_LNAME,', ',Stud_FNAME,' ',COALESCE(Stud_MNAME,'')) as FullName
  ,CONCAT(Stud_COURSE,' ',Stud_YEAR_LEVEL,'-',Stud_SECTION) as Course
  ,Stud_EMAIL
  ,Stud_CONTACT_NO
  ,Stud_GENDER
  ,Stud_BIRHT_DATE
  ,Stud_BIRTH_PLACE
  ,Stud_STATUS
  ,Stud_ADDRESS
FROM osas.r_stud_profile$$

DROP PROCEDURE IF EXISTS `View_StudSanction`$$
CREATE DEFINER=`root`@`localhost` PROCEDURE `View_StudSanction` ()  NO SQL
    DETERMINISTIC
SELECT B.AssSancStudStudent_ID AssSancID
,A.Stud_NO
,CONCAT(A.Stud_LNAME,', ',A.Stud_FNAME,' ',COALESCE(A.Stud_MNAME,'')) AS FullName
,C.SancDetails_NAME AS SanctionName
,C.SancDetails_TIMEVAL AS TimeVal
,D.DesOffDetails_NAME AS Office
,b.AssSancStudStudent_CONSUMED_HOURS AS Consumed
FROM r_stud_profile A
INNER JOIN  t_assign_stud_saction B ON
  A.Stud_NO = B.AssSancStudStudent_STUD_NO
INNER JOIN r_sanction_details C ON
  C.SancDetails_CODE = B.AssSancStudStudent_SancDetails_CODE
INNER JOIN r_designated_offices_details D ON
  D.DesOffDetails_CODE = B.AssSancStudStudent_DesOffDetails_CODE 
WHERE A.Stud_DISPLAY_STATUS='ACTIVE'
AND B.AssSancStudStudent_DISPLAY_STAT='ACTIVE'
AND C.SancDetails_DISPLAY_STAT='ACTIVE'
AND D.DesOffDetails_DISPLAY_STAT='ACTIVE' 
AND B.AssSancStudStudent_IS_FINISH<>'FINISHED'
AND B.AssSancStudStudent_CONSUMED_HOURS <> C.SancDetails_TIMEVAL$$

DELIMITER ;

-- --------------------------------------------------------

--
-- Table structure for table `active_academic_year`
--

DROP TABLE IF EXISTS `active_academic_year`;
CREATE TABLE `active_academic_year` (
  `ActiveAcadYear_ID` int(11) NOT NULL,
  `ActiveAcadYear_Batch_YEAR` varchar(50) NOT NULL,
  `ActiveAcadYear_IS_ACTIVE` enum('1','0') NOT NULL DEFAULT '1',
  `ActiveAcadYear_DATE_ADD` datetime NOT NULL DEFAULT CURRENT_TIMESTAMP,
  `ActiveAcadYear_DATE_MOD` datetime DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `active_academic_year`
--

INSERT INTO `active_academic_year` (`ActiveAcadYear_ID`, `ActiveAcadYear_Batch_YEAR`, `ActiveAcadYear_IS_ACTIVE`, `ActiveAcadYear_DATE_ADD`, `ActiveAcadYear_DATE_MOD`) VALUES
(1, '2017-2018', '1', '2018-03-19 22:29:36', NULL);

-- --------------------------------------------------------

--
-- Table structure for table `active_semester`
--

DROP TABLE IF EXISTS `active_semester`;
CREATE TABLE `active_semester` (
  `ActiveSemester_ID` int(11) NOT NULL,
  `ActiveSemester_SEMESTRAL_NAME` varchar(50) NOT NULL,
  `ActiveSemester_IS_ACTIVE` enum('1','0') NOT NULL DEFAULT '1',
  `ActiveSemester_DATE_ADD` datetime NOT NULL DEFAULT CURRENT_TIMESTAMP,
  `ActiveSemester_DATE_MOD` datetime DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `active_semester`
--

INSERT INTO `active_semester` (`ActiveSemester_ID`, `ActiveSemester_SEMESTRAL_NAME`, `ActiveSemester_IS_ACTIVE`, `ActiveSemester_DATE_ADD`, `ActiveSemester_DATE_MOD`) VALUES
(1, 'First Semester', '1', '2018-03-19 22:29:00', NULL);

-- --------------------------------------------------------

--
-- Table structure for table `log_sanction`
--

DROP TABLE IF EXISTS `log_sanction`;
CREATE TABLE `log_sanction` (
  `LogSanc_ID` int(11) NOT NULL,
  `LogSanc_AssSancSudent_ID` int(11) NOT NULL,
  `LogSanc_CONSUMED_HOURS` int(11) DEFAULT '0',
  `LogSanc_REMARKS` varchar(100) NOT NULL,
  `LogSanc_IS_FINISH` enum('Processing','Finished') NOT NULL,
  `LogSanc_DATE_MOD` datetime NOT NULL DEFAULT CURRENT_TIMESTAMP
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `log_sanction`
--

INSERT INTO `log_sanction` (`LogSanc_ID`, `LogSanc_AssSancSudent_ID`, `LogSanc_CONSUMED_HOURS`, `LogSanc_REMARKS`, `LogSanc_IS_FINISH`, `LogSanc_DATE_MOD`) VALUES
(1, 1, 0, 'OWKAY NA HUEHUE', 'Processing', '2018-03-16 18:02:05'),
(2, 1, 0, 'OWKAY NA HUEHUEs', 'Processing', '2018-03-16 18:04:05'),
(3, 1, 0, 'excused pala', 'Processing', '2018-03-16 18:04:27'),
(4, 1, 0, 'excused pala', 'Processing', '2018-05-01 21:14:39'),
(5, 1, 0, 'excused pala hehehe', 'Processing', '2018-05-06 19:36:41'),
(6, 1, 10, 'excused pala hehehe', 'Processing', '2018-05-06 19:36:59');

-- --------------------------------------------------------

--
-- Table structure for table `notif_announcement`
--

DROP TABLE IF EXISTS `notif_announcement`;
CREATE TABLE `notif_announcement` (
  `Notif_ID` int(11) NOT NULL,
  `Notif_SUBJECT` varchar(1000) NOT NULL,
  `Notif_MESSAGE` text NOT NULL,
  `Notif_SEND_BY` varchar(100) NOT NULL,
  `Notif_REC_BY` enum('All','Student','Organization') DEFAULT NULL,
  `Notif_DATE_ADD` datetime NOT NULL DEFAULT CURRENT_TIMESTAMP
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

-- --------------------------------------------------------

--
-- Table structure for table `r_application_wizard`
--

DROP TABLE IF EXISTS `r_application_wizard`;
CREATE TABLE `r_application_wizard` (
  `WIZARD_ID` int(11) NOT NULL,
  `WIZARD_ORG_CODE` varchar(15) NOT NULL,
  `WIZARD_CURRENT_STEP` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `r_application_wizard`
--

INSERT INTO `r_application_wizard` (`WIZARD_ID`, `WIZARD_ORG_CODE`, `WIZARD_CURRENT_STEP`) VALUES
(25, 'CIT2017', 5),
(27, 'CIT2016', 5),
(28, 'D2017', 5),
(29, 'O2017', 5),
(30, 'CIT2015', 3),
(31, 'ERICZZZ2017', 5),
(32, 'ASD2017', 5),
(33, 'DSA2017', 5),
(34, 'EWQ2017', 5),
(35, 'QWE2017', 5);

-- --------------------------------------------------------

--
-- Table structure for table `r_archiving_documents`
--

DROP TABLE IF EXISTS `r_archiving_documents`;
CREATE TABLE `r_archiving_documents` (
  `ArchDocuments_ID` int(11) NOT NULL,
  `ArchDocuments_ORDER_NO` int(11) NOT NULL,
  `ArchDocuments_NAME` varchar(100) NOT NULL,
  `ArchDocuments_DESC` varchar(100) NOT NULL DEFAULT 'Document Description',
  `ArchDocuments_FILE_PATH` varchar(1000) NOT NULL,
  `ArchDocuments_DATE_ADD` datetime NOT NULL DEFAULT CURRENT_TIMESTAMP,
  `ArchDocuments_DATE_MOD` datetime NOT NULL DEFAULT CURRENT_TIMESTAMP,
  `ArchDocuments_DISPLAY_STAT` enum('Active','Inactive') DEFAULT 'Active'
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

-- --------------------------------------------------------

--
-- Table structure for table `r_assign_case_to_case_sanction`
--

DROP TABLE IF EXISTS `r_assign_case_to_case_sanction`;
CREATE TABLE `r_assign_case_to_case_sanction` (
  `Case_ID` int(11) NOT NULL,
  `Case_SancDetails_CODE` varchar(15) NOT NULL,
  `Case_SancLevelOffense` int(11) NOT NULL DEFAULT '0',
  `Case_SanctionCategory` enum('Loss ID','Loss Registration Card','Late Claim') DEFAULT NULL,
  `Case_DATE_ADD` datetime NOT NULL DEFAULT CURRENT_TIMESTAMP,
  `Case_DATE_MOD` datetime NOT NULL DEFAULT CURRENT_TIMESTAMP,
  `Case_DISPLAY_STAT` enum('Active','InActive') NOT NULL DEFAULT 'Active'
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

-- --------------------------------------------------------

--
-- Table structure for table `r_batch_details`
--

DROP TABLE IF EXISTS `r_batch_details`;
CREATE TABLE `r_batch_details` (
  `Batch_ID` int(11) NOT NULL,
  `Batch_CODE` varchar(15) NOT NULL,
  `Batch_YEAR` varchar(15) NOT NULL,
  `Batch_DESC` varchar(100) DEFAULT NULL,
  `Batch_DISPLAY_STAT` enum('Active','Inactive') DEFAULT 'Active'
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `r_batch_details`
--

INSERT INTO `r_batch_details` (`Batch_ID`, `Batch_CODE`, `Batch_YEAR`, `Batch_DESC`, `Batch_DISPLAY_STAT`) VALUES
(1, 'BAT00001', '2011-2012', 'Batch descrzzzxczxciptions', 'Active'),
(2, 'BAT00002', '2012-2013', 'Batch description', 'Active'),
(3, 'BAT00003', '2013-2014', 'Batch description', 'Active'),
(4, 'BAT00004', '2014-2015', 'Batch description', 'Active'),
(5, 'BAT00005', '2015-2016', 'Batch description', 'Active'),
(6, 'BAT00006', '2016-2017', 'Batch description', 'Active'),
(7, 'BAT00007', '2017-2018', 'Batch description', 'Active');

-- --------------------------------------------------------

--
-- Table structure for table `r_clearance_signatories`
--

DROP TABLE IF EXISTS `r_clearance_signatories`;
CREATE TABLE `r_clearance_signatories` (
  `ClearSignatories_ID` int(11) NOT NULL,
  `ClearSignatories_CODE` varchar(15) NOT NULL,
  `ClearSignatories_NAME` varchar(100) NOT NULL,
  `ClearSignatories_DESC` varchar(100) DEFAULT 'Clearance Signatories Description',
  `ClearSignatories_DATE_MOD` datetime NOT NULL DEFAULT CURRENT_TIMESTAMP,
  `ClearSignatories_DATE_ADD` datetime NOT NULL DEFAULT CURRENT_TIMESTAMP,
  `ClearSignatories_DISPLAY_STAT` enum('Active','Inactive') DEFAULT 'Active'
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `r_clearance_signatories`
--

INSERT INTO `r_clearance_signatories` (`ClearSignatories_ID`, `ClearSignatories_CODE`, `ClearSignatories_NAME`, `ClearSignatories_DESC`, `ClearSignatories_DATE_MOD`, `ClearSignatories_DATE_ADD`, `ClearSignatories_DISPLAY_STAT`) VALUES
(1, 'SIG00001', 'Accounting Office', 'Accounting Offices', '2018-03-11 20:33:05', '2018-02-08 14:27:28', 'Active'),
(2, 'SIG00002', 'Head of Academic Affairs', 'Head of Academic Affairs', '2018-02-10 09:58:18', '2018-02-10 09:58:18', 'Active'),
(3, 'SIG00003', 'Academic Affairs', 'Academic Affairs', '2018-02-11 21:34:00', '2018-02-11 21:34:00', 'Active'),
(4, 'Lib', 'Library2', '0', '2018-04-25 21:55:08', '2018-03-17 02:44:12', 'Active'),
(7, 'osas', 'osass', 'osass', '2018-03-17 02:48:26', '2018-03-17 02:48:26', 'Active'),
(8, 'SIG00006', '51ads', '555666', '2018-04-25 21:55:16', '2018-04-25 21:55:16', 'Active'),
(9, 'SIG00007', '555777', '777', '2018-04-25 21:56:12', '2018-04-25 21:56:12', 'Active');

-- --------------------------------------------------------

--
-- Table structure for table `r_courses`
--

DROP TABLE IF EXISTS `r_courses`;
CREATE TABLE `r_courses` (
  `Course_ID` int(11) NOT NULL,
  `Course_CODE` varchar(15) NOT NULL,
  `Course_NAME` varchar(100) NOT NULL,
  `Course_DESC` varchar(100) DEFAULT 'Course Description',
  `Course_CURR_YEAR` varchar(15) DEFAULT NULL,
  `Course_DATE_MOD` datetime NOT NULL DEFAULT CURRENT_TIMESTAMP,
  `Course_DATE_ADD` datetime NOT NULL DEFAULT CURRENT_TIMESTAMP,
  `Course_DISPLAY_STAT` enum('Active','Inactive') DEFAULT 'Active'
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `r_courses`
--

INSERT INTO `r_courses` (`Course_ID`, `Course_CODE`, `Course_NAME`, `Course_DESC`, `Course_CURR_YEAR`, `Course_DATE_MOD`, `Course_DATE_ADD`, `Course_DISPLAY_STAT`) VALUES
(1, 'BSIT', 'Bachelor of Science in Information Technology', 'Course Descriptions', '2011-2012', '2018-04-25 23:23:43', '2018-02-07 18:41:43', 'Active'),
(2, 'DOMT', 'Diploma In Office Management Technology', 'Course Description', '2011-2012', '2018-02-09 17:54:51', '2018-02-09 17:54:51', 'Active'),
(3, 'DICT', 'Diploma in Information Communication Technology', 'Diploma in Information Communication Technology', '2011-2012', '2018-03-11 20:40:22', '2018-03-11 20:40:22', 'Active'),
(4, '5151', '312312', '3123123', '2017-2018', '2018-04-25 23:24:00', '2018-04-25 23:23:51', 'Active');

-- --------------------------------------------------------

--
-- Table structure for table `r_designated_offices_details`
--

DROP TABLE IF EXISTS `r_designated_offices_details`;
CREATE TABLE `r_designated_offices_details` (
  `DesOffDetails_ID` int(11) NOT NULL,
  `DesOffDetails_CODE` varchar(15) NOT NULL,
  `DesOffDetails_NAME` varchar(100) NOT NULL,
  `DesOffDetails_DESC` varchar(100) DEFAULT 'Offices Description',
  `DesOffDetails_DATE_ADD` datetime NOT NULL DEFAULT CURRENT_TIMESTAMP,
  `DesOffDetails_DATE_MOD` datetime NOT NULL DEFAULT CURRENT_TIMESTAMP,
  `DesOffDetails_DISPLAY_STAT` enum('Active','Inactive') DEFAULT 'Active'
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `r_designated_offices_details`
--

INSERT INTO `r_designated_offices_details` (`DesOffDetails_ID`, `DesOffDetails_CODE`, `DesOffDetails_NAME`, `DesOffDetails_DESC`, `DesOffDetails_DATE_ADD`, `DesOffDetails_DATE_MOD`, `DesOffDetails_DISPLAY_STAT`) VALUES
(1, 'OFF00001', 'Library', 'Library', '2018-02-08 14:28:12', '2018-02-08 14:28:12', 'Active'),
(2, 'ADDOFF', 'Admission Office', 'Offices Description', '2018-02-13 11:18:42', '2018-04-25 22:08:49', 'Active'),
(3, 'CR MISE', 'Comfort Room', 'CR sa mise', '2018-02-22 00:31:04', '2018-02-22 00:31:04', 'Active'),
(4, 'OFF00004', 'zxcasd', 'zxcasd', '2018-04-25 22:04:54', '2018-04-25 22:04:54', 'Active'),
(5, 'OFF00005', 'qweqwezx', 'zz', '2018-04-25 22:06:30', '2018-04-25 22:06:30', 'Active'),
(6, 'OFF00006', 'asdasd', 'q', '2018-04-25 22:07:23', '2018-04-25 22:07:23', 'Active');

-- --------------------------------------------------------

--
-- Table structure for table `r_financial_assistance_title`
--

DROP TABLE IF EXISTS `r_financial_assistance_title`;
CREATE TABLE `r_financial_assistance_title` (
  `FinAssiTitle_ID` int(11) NOT NULL,
  `FinAssiTitle_CODE` varchar(15) NOT NULL,
  `FinAssiTitle_NAME` varchar(100) NOT NULL,
  `FinAssiTitle_DESC` varchar(100) DEFAULT 'Financial Assistantce Description',
  `FinAssiTitle_DATE_ADD` datetime NOT NULL DEFAULT CURRENT_TIMESTAMP,
  `FinAssiTitle_DATE_MOD` datetime NOT NULL DEFAULT CURRENT_TIMESTAMP,
  `FinAssiTitle_DISPLAY_STAT` enum('Active','Inactive') DEFAULT 'Active'
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `r_financial_assistance_title`
--

INSERT INTO `r_financial_assistance_title` (`FinAssiTitle_ID`, `FinAssiTitle_CODE`, `FinAssiTitle_NAME`, `FinAssiTitle_DESC`, `FinAssiTitle_DATE_ADD`, `FinAssiTitle_DATE_MOD`, `FinAssiTitle_DISPLAY_STAT`) VALUES
(1, 'Finan0001', 'CHED', 'Commission on Higher Education of the Philippines', '2018-02-09 17:55:20', '2018-02-09 17:55:20', 'Active'),
(2, 'Finan0002', 'SYDP', 'Quezon City Government - Scholarship & Youth Development Program', '2018-02-09 17:55:45', '2018-02-09 17:55:45', 'Active'),
(3, 'TIT00003', '123123asd', 'zxc41', '2018-04-25 20:56:13', '2018-04-25 20:57:16', 'Active'),
(4, 'TIT00004', 'asd', 'asdqwe', '2018-04-25 20:56:31', '2018-04-25 20:59:18', 'Active'),
(5, 'TIT00005', 'qwe', '152', '2018-04-25 21:01:32', '2018-04-25 21:01:58', 'Active'),
(7, 'TIT00006', 'qe123', '123555z', '2018-04-25 21:02:05', '2018-04-25 21:02:12', 'Active'),
(8, 'TIT00007', '123qwe', 'qwez', '2018-04-25 21:04:49', '2018-04-25 21:04:49', 'Active'),
(9, 'TIT00008', 'qweqwe', '51515', '2018-04-25 21:05:31', '2018-04-25 21:05:31', 'Active'),
(10, 'TIT00009', 'qwe1', '111', '2018-04-25 21:05:40', '2018-04-25 21:05:40', 'Active'),
(11, 'TIT00010', '123zzz', 'zzz', '2018-04-25 21:06:08', '2018-04-25 21:06:08', 'Active');

-- --------------------------------------------------------

--
-- Table structure for table `r_notification`
--

DROP TABLE IF EXISTS `r_notification`;
CREATE TABLE `r_notification` (
  `Notification_ID` int(11) NOT NULL,
  `Notification_ITEM` varchar(15) NOT NULL,
  `Notification_SENDER` varchar(15) NOT NULL,
  `Notification_RECEIVER` varchar(15) NOT NULL,
  `Notification_SEEN` varchar(15) NOT NULL DEFAULT 'Unseen',
  `Notification_CLICKED` varchar(15) NOT NULL DEFAULT 'Unclick',
  `Notification_USERROLE` varchar(15) NOT NULL DEFAULT 'OSAS Head',
  `Notification_DATE_SEEN` datetime DEFAULT NULL,
  `Notification_DATE_CLICKED` datetime DEFAULT NULL,
  `Notification_DATE_ADDED` datetime NOT NULL DEFAULT CURRENT_TIMESTAMP
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `r_notification`
--

INSERT INTO `r_notification` (`Notification_ID`, `Notification_ITEM`, `Notification_SENDER`, `Notification_RECEIVER`, `Notification_SEEN`, `Notification_CLICKED`, `Notification_USERROLE`, `Notification_DATE_SEEN`, `Notification_DATE_CLICKED`, `Notification_DATE_ADDED`) VALUES
(1, 'Remit #00010', '', '2017-OSAS-CM-0', 'Seen', 'Clicked', 'OSAS HEAD', '2018-04-03 00:00:00', '2018-04-03 00:00:00', '2018-04-29 14:48:11'),
(2, 'Remit #00011', '', '2017-OSAS-CM-0', 'Seen', 'Clicked', 'OSAS Head', '2018-04-03 00:00:00', '2018-04-29 19:01:21', '2018-04-29 14:48:12'),
(3, 'Remit #00012', '', '2017-OSAS-CM-0', 'Seen', 'Clicked', 'OSAS Head', '2018-05-06 16:10:11', '2018-05-06 19:25:48', '2018-04-29 14:48:13'),
(4, 'Remit #00013', '', '2017-OSAS-CM-0', 'Seen', 'Clicked', 'OSAS Head', '2018-04-03 00:00:00', '2018-05-06 19:25:43', '2018-04-29 14:48:14'),
(5, 'Remit #00014', '', '2017-OSAS-CM-0', 'Seen', 'Clicked', 'OSAS Head', '2018-04-03 00:00:00', '2018-05-06 19:25:40', '2018-04-29 14:48:15'),
(6, 'Remit #00015', '', '2017-OSAS-CM-0', 'Seen', 'Clicked', 'OSAS Head', '2018-04-03 00:00:00', '2018-04-29 18:58:29', '2018-04-29 14:48:17'),
(7, 'Remit #00016', '', '2017-OSAS-CM-0', 'Seen', 'Clicked', 'OSAS Head', '2018-04-03 00:00:00', '2018-04-29 19:03:57', '2018-04-29 14:48:18'),
(8, 'Remit #00017', '', '2017-OSAS-CM-0', 'Seen', 'Clicked', 'OSAS Head', '2018-04-29 14:46:27', '2018-04-29 19:02:03', '2018-04-29 14:48:19'),
(9, 'Remit #00018', '', '2017-OSAS-CM-0', 'Seen', 'Clicked', 'OSAS Head', '2018-04-29 15:28:01', '2018-04-29 19:01:43', '2018-04-29 15:27:55'),
(10, 'Remit #00019', '', '2017-OSAS-CM-0', 'Seen', 'Clicked', 'OSAS Head', '2018-04-29 15:56:37', '2018-04-29 18:57:21', '2018-04-29 15:56:33'),
(11, 'Remit #00020', '', '2017-OSAS-CM-0', 'Seen', 'Clicked', 'OSAS Head', '2018-04-29 15:57:04', '2018-04-29 18:55:52', '2018-04-29 15:56:57'),
(12, 'Remit #00021', '', '2017-OSAS-CM-0', 'Seen', 'Clicked', 'OSAS Head', '2018-04-29 16:02:49', '2018-05-06 19:30:21', '2018-04-29 16:01:53'),
(13, 'Remit #00022', '', '2017-OSAS-CM-0', 'Seen', 'Clicked', 'OSAS Head', '2018-04-29 16:02:49', '2018-04-29 18:55:46', '2018-04-29 16:02:36'),
(14, 'Remit #00023', '', '2017-OSAS-CM-0', 'Seen', 'Clicked', 'OSAS Head', '2018-04-29 16:02:49', '2018-04-29 18:55:41', '2018-04-29 16:02:45'),
(15, 'Remit #00024', '', '2017-OSAS-CM-0', 'Seen', 'Clicked', 'OSAS Head', '2018-04-29 18:30:00', '2018-04-29 18:56:50', '2018-04-29 18:29:57'),
(16, 'Remit #00025', '', '2017-OSAS-CM-0', 'Seen', 'Clicked', 'OSAS Head', '2018-04-29 18:44:31', '2018-04-29 18:56:43', '2018-04-29 18:44:26'),
(17, 'Remit #00026', '', '2017-OSAS-CM-0', 'Seen', 'Clicked', 'OSAS Head', '2018-04-29 19:12:41', '2018-04-29 19:12:46', '2018-04-29 19:12:33'),
(18, 'Remit #00027', '', '2017-OSAS-CM-0', 'Seen', 'Clicked', 'OSAS Head', '2018-04-29 19:13:31', '2018-05-01 08:27:22', '2018-04-29 19:13:22'),
(19, 'Remit #00028', '', '2017-OSAS-CM-0', 'Seen', 'Clicked', 'OSAS Head', '2018-04-29 19:14:41', '2018-05-06 17:48:30', '2018-04-29 19:14:37'),
(20, 'Remit #00029', '', '2017-OSAS-CM-0', 'Seen', 'Clicked', 'OSAS Head', '2018-04-30 08:38:22', '2018-05-09 09:46:11', '2018-04-30 08:38:18'),
(21, 'Remit #00030', '', '2017-OSAS-CM-0', 'Seen', 'Clicked', 'OSAS Head', '2018-04-30 13:10:41', '2018-05-06 16:10:24', '2018-04-30 13:10:17'),
(22, 'Remit #00031', 'QWE2017', '2017-OSAS-CM-0', 'Seen', 'Clicked', 'Organization', '2018-05-06 17:55:30', '2018-05-06 19:04:22', '2018-05-06 17:55:20'),
(23, 'EVNT00001', 'QWE2017', '2017-OSAS-CM-0', 'Seen', 'Clicked', 'Organization', '2018-05-06 17:56:29', '2018-05-06 18:47:00', '2018-05-06 17:56:26'),
(24, 'EVNT00001', '2017-OSAS-CM-0', 'QWE2017', 'Seen', 'Unclick', 'Organization', '2018-05-06 19:23:40', NULL, '2018-05-06 18:47:04'),
(25, 'Remit #00031', '2017-OSAS-CM-0', 'QWE2017', 'Seen', 'Unclick', 'Organization', '2018-05-06 19:23:40', NULL, '2018-05-06 19:04:25'),
(26, 'EVNT00002', 'CIT2017', '2017-OSAS-CM-0', 'Seen', 'Clicked', 'Organization', '2018-05-09 19:36:55', '2018-05-09 19:37:17', '2018-05-09 19:36:49'),
(27, 'EVNT00002', '2017-OSAS-CM-0', 'CIT2017', 'Seen', 'Clicked', 'Organization', '2018-05-09 19:37:15', '2018-05-09 19:37:17', '2018-05-09 19:37:07');

-- --------------------------------------------------------

--
-- Table structure for table `r_org_accreditation_details`
--

DROP TABLE IF EXISTS `r_org_accreditation_details`;
CREATE TABLE `r_org_accreditation_details` (
  `OrgAccrDetail_ID` int(11) NOT NULL,
  `OrgAccrDetail_CODE` varchar(15) NOT NULL,
  `OrgAccrDetail_NAME` varchar(100) NOT NULL,
  `OrgAccrDetail_DESC` varchar(100) DEFAULT 'Accreditation Description',
  `OrgAccrDetail_DATE_ADD` datetime NOT NULL DEFAULT CURRENT_TIMESTAMP,
  `OrgAccrDetail_DATE_MOD` datetime NOT NULL DEFAULT CURRENT_TIMESTAMP,
  `OrgAccrDetail_DISPLAY_STAT` enum('Active','Inactive') DEFAULT 'Active'
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `r_org_accreditation_details`
--

INSERT INTO `r_org_accreditation_details` (`OrgAccrDetail_ID`, `OrgAccrDetail_CODE`, `OrgAccrDetail_NAME`, `OrgAccrDetail_DESC`, `OrgAccrDetail_DATE_ADD`, `OrgAccrDetail_DATE_MOD`, `OrgAccrDetail_DISPLAY_STAT`) VALUES
(1, 'REQ00001', 'Organization Name', 'Every organization must have unique name', '2018-02-08 14:37:56', '2018-03-11 19:09:28', 'Active'),
(2, 'REQ00002', 'Organization must have mission and vision', 'Every organization must have a mission and vision', '2018-03-11 20:23:02', '2018-03-11 20:23:35', 'Active'),
(3, 'REQ00003', 'Organization Logo', 'Logo ng org', '2018-03-15 16:50:10', '2018-03-15 16:50:10', 'Active'),
(4, 'REQ00004', 'qwe', '4123', '2018-04-25 23:16:29', '2018-04-25 23:16:29', 'Active');

-- --------------------------------------------------------

--
-- Table structure for table `r_org_applicant_profile`
--

DROP TABLE IF EXISTS `r_org_applicant_profile`;
CREATE TABLE `r_org_applicant_profile` (
  `OrgAppProfile_ID` int(11) NOT NULL,
  `OrgAppProfile_APPL_CODE` varchar(15) NOT NULL,
  `OrgAppProfile_NAME` varchar(100) NOT NULL,
  `OrgAppProfile_DESCRIPTION` varchar(500) DEFAULT 'Organization description should be here!',
  `OrgAppProfile_STATUS` varchar(100) NOT NULL DEFAULT 'This application is ready for accreditation',
  `OrgAppProfile_DATE_ADD` datetime NOT NULL DEFAULT CURRENT_TIMESTAMP,
  `OrgAppProfile_DATE_MOD` datetime NOT NULL DEFAULT CURRENT_TIMESTAMP,
  `OrgAppProfile_DISPLAY_STAT` enum('Active','Inactive') DEFAULT 'Active'
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `r_org_applicant_profile`
--

INSERT INTO `r_org_applicant_profile` (`OrgAppProfile_ID`, `OrgAppProfile_APPL_CODE`, `OrgAppProfile_NAME`, `OrgAppProfile_DESCRIPTION`, `OrgAppProfile_STATUS`, `OrgAppProfile_DATE_ADD`, `OrgAppProfile_DATE_MOD`, `OrgAppProfile_DISPLAY_STAT`) VALUES
(6, 'CIT2018', 'Commonwealth Information Technology', 'CommITS inshortS', 'This application is ready for accreditation', '2018-03-15 15:59:39', '2018-03-15 17:40:50', 'Active'),
(7, 'D2018', 'Damlay', 'damlay ito', 'This application is ready for accreditation', '2018-03-19 02:25:47', '2018-04-28 18:50:46', 'Active'),
(8, 'O2018', 'Ohau', 'asd', 'This application is ready for accreditation', '2018-03-19 12:51:30', '2018-03-19 12:51:30', 'Active'),
(9, 'ERICZZZ2017', 'e r i c z z z', 'qweqwe', 'This application is ready for accreditation', '2018-04-29 18:01:54', '2018-04-29 18:01:54', 'Active'),
(10, 'QWE2017', 'q w e ', '123', 'This application is ready for accreditation', '2018-04-29 18:14:02', '2018-04-29 18:14:02', 'Active'),
(11, 'EWQ2017', 'e w q', '123', 'This application is ready for accreditation', '2018-04-29 18:14:15', '2018-04-29 18:14:15', 'Active'),
(12, 'ASD2017', 'a s d ', '123', 'This application is ready for accreditation', '2018-04-29 18:14:25', '2018-04-29 18:14:25', 'Active'),
(13, 'DSA2017', 'd s a', '123z', 'This application is ready for accreditation', '2018-04-29 18:14:33', '2018-04-29 18:14:33', 'Active');

-- --------------------------------------------------------

--
-- Table structure for table `r_org_category`
--

DROP TABLE IF EXISTS `r_org_category`;
CREATE TABLE `r_org_category` (
  `OrgCat_ID` int(11) NOT NULL,
  `OrgCat_CODE` varchar(15) NOT NULL,
  `OrgCat_NAME` varchar(100) NOT NULL,
  `OrgCat_DESC` varchar(100) DEFAULT 'Org Category Description',
  `OrgCat_DATE_ADD` datetime NOT NULL DEFAULT CURRENT_TIMESTAMP,
  `OrgCat_DATE_MOD` datetime NOT NULL DEFAULT CURRENT_TIMESTAMP,
  `OrgCat_DISPLAY_STAT` enum('Active','Inactive') DEFAULT 'Active'
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `r_org_category`
--

INSERT INTO `r_org_category` (`OrgCat_ID`, `OrgCat_CODE`, `OrgCat_NAME`, `OrgCat_DESC`, `OrgCat_DATE_ADD`, `OrgCat_DATE_MOD`, `OrgCat_DISPLAY_STAT`) VALUES
(1, 'ACAD_ORG', 'Academic Organization', 'Academic Organization', '2018-02-08 14:39:16', '2018-04-25 23:34:37', 'Active'),
(2, 'NONACAD_ORG', 'Non-academic Organization', 'Non Academic Ogranization', '2018-03-15 16:13:27', '2018-04-28 15:51:12', 'Active'),
(3, 'asd', 'asd', 'asds', '2018-04-25 23:32:53', '2018-04-25 23:34:15', 'Active');

-- --------------------------------------------------------

--
-- Table structure for table `r_org_essentials`
--

DROP TABLE IF EXISTS `r_org_essentials`;
CREATE TABLE `r_org_essentials` (
  `OrgEssentials_ID` int(11) NOT NULL,
  `OrgEssentials_ORG_CODE` varchar(15) NOT NULL,
  `OrgEssentials_MISSION` varchar(1000) NOT NULL,
  `OrgEssentials_VISION` varchar(1000) NOT NULL,
  `OrgEssentials_LOGO` blob NOT NULL,
  `OrgEssentials_DATE_ADD` datetime DEFAULT CURRENT_TIMESTAMP,
  `OrgEssentials_DATE_MOD` datetime DEFAULT CURRENT_TIMESTAMP,
  `OrgEssentials_DISPLAY_STAT` enum('Active','Inactive') DEFAULT 'Active'
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `r_org_essentials`
--

INSERT INTO `r_org_essentials` (`OrgEssentials_ID`, `OrgEssentials_ORG_CODE`, `OrgEssentials_MISSION`, `OrgEssentials_VISION`, `OrgEssentials_LOGO`, `OrgEssentials_DATE_ADD`, `OrgEssentials_DATE_MOD`, `OrgEssentials_DISPLAY_STAT`) VALUES
(13, 'CIT2017', 'mission', 'vision', '', '2018-03-15 16:29:06', '2018-03-15 16:29:06', 'Active'),
(14, 'D2017', 'd', 'dsf', '', '2018-03-19 02:26:20', '2018-03-19 02:26:20', 'Active'),
(15, 'CIT2016', 'COT2016das', 'asd', '', '2018-03-19 04:21:11', '2018-03-19 04:21:11', 'Active'),
(16, 'O2017', 'd', 'dsf', '', '2018-03-19 13:07:09', '2018-03-19 13:07:09', 'Active'),
(17, 'ERICZZZ2017', 'qwezx q q', 'vuis', '', '2018-04-29 18:03:39', '2018-04-29 18:03:39', 'Active'),
(18, 'ASD2017', 'mis', 'vis', '', '2018-04-29 18:14:51', '2018-04-29 18:14:51', 'Active'),
(19, 'DSA2017', 'qwe', ' eqw', '', '2018-04-29 18:15:54', '2018-04-29 18:15:54', 'Active'),
(20, 'EWQ2017', 'qwe', 'zxc', '', '2018-04-29 18:16:55', '2018-04-29 18:16:55', 'Active'),
(21, 'QWE2017', 'wqe', 'zxc', '', '2018-04-29 18:43:37', '2018-04-29 18:43:37', 'Active');

-- --------------------------------------------------------

--
-- Table structure for table `r_org_event_management`
--

DROP TABLE IF EXISTS `r_org_event_management`;
CREATE TABLE `r_org_event_management` (
  `OrgEvent_ID` int(11) NOT NULL,
  `OrgEvent_OrgCode` varchar(15) NOT NULL,
  `OrgEvent_Code` varchar(15) NOT NULL,
  `OrgEvent_NAME` varchar(50) NOT NULL,
  `OrgEvent_DESCRIPTION` varchar(50) NOT NULL,
  `OrgEvent_FILES` enum('Ok','Pending') NOT NULL DEFAULT 'Pending',
  `OrgEvent_STATUS` enum('Cancelled','Pending','Approved','Rejected') NOT NULL DEFAULT 'Pending',
  `OrgEvent_PROPOSED_DATE` date NOT NULL,
  `OrgEvent_ReviewdBy` varchar(15) NOT NULL,
  `OrgEvent_DATE_ADD` datetime NOT NULL DEFAULT CURRENT_TIMESTAMP,
  `OrgEvent_DATE_MOD` datetime DEFAULT NULL,
  `OrgEvent_DISPLAY_STAT` enum('Active','Inactive') NOT NULL DEFAULT 'Active'
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `r_org_event_management`
--

INSERT INTO `r_org_event_management` (`OrgEvent_ID`, `OrgEvent_OrgCode`, `OrgEvent_Code`, `OrgEvent_NAME`, `OrgEvent_DESCRIPTION`, `OrgEvent_FILES`, `OrgEvent_STATUS`, `OrgEvent_PROPOSED_DATE`, `OrgEvent_ReviewdBy`, `OrgEvent_DATE_ADD`, `OrgEvent_DATE_MOD`, `OrgEvent_DISPLAY_STAT`) VALUES
(1, 'QWE2017', 'EVNT00001', 'Commits General Assembly', 'asd', 'Ok', 'Approved', '2018-05-11', 'Demelyn', '2018-05-06 17:56:26', '2018-05-06 18:47:04', 'Active'),
(2, 'CIT2017', 'EVNT00002', 'Commits General Assembly', 'Event Sample Desc', 'Ok', 'Approved', '2018-05-10', 'Demelyn', '2018-05-09 19:36:49', '2018-05-09 19:37:07', 'Active');

-- --------------------------------------------------------

--
-- Table structure for table `r_org_non_academic_details`
--

DROP TABLE IF EXISTS `r_org_non_academic_details`;
CREATE TABLE `r_org_non_academic_details` (
  `OrgNonAcad_ID` int(11) NOT NULL,
  `OrgNonAcad_CODE` varchar(15) NOT NULL,
  `OrgNonAcad_NAME` varchar(100) NOT NULL,
  `OrgNonAcad_DESC` varchar(100) DEFAULT NULL,
  `OrgNonAcad_DATE_ADD` datetime NOT NULL DEFAULT CURRENT_TIMESTAMP,
  `OrgNonAcad_DATE_MOD` datetime NOT NULL DEFAULT CURRENT_TIMESTAMP,
  `OrgNonAcad_DISPLAY_STAT` enum('Active','Inactive') NOT NULL DEFAULT 'Active'
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `r_org_non_academic_details`
--

INSERT INTO `r_org_non_academic_details` (`OrgNonAcad_ID`, `OrgNonAcad_CODE`, `OrgNonAcad_NAME`, `OrgNonAcad_DESC`, `OrgNonAcad_DATE_ADD`, `OrgNonAcad_DATE_MOD`, `OrgNonAcad_DISPLAY_STAT`) VALUES
(1, 'REL_ORG', 'Religious Org', 'org', '2018-04-27 14:26:36', '2018-04-27 14:26:36', 'Active');

-- --------------------------------------------------------

--
-- Table structure for table `r_org_officer_position_details`
--

DROP TABLE IF EXISTS `r_org_officer_position_details`;
CREATE TABLE `r_org_officer_position_details` (
  `OrgOffiPosDetails_ID` int(11) NOT NULL,
  `OrgOffiPosDetails_ORG_CODE` varchar(15) NOT NULL,
  `OrgOffiPosDetails_NAME` varchar(100) NOT NULL,
  `OrgOffiPosDetails_DESC` varchar(100) NOT NULL DEFAULT 'Office Position Description',
  `OrgOffiPosDetails_NumOfOcc` int(11) NOT NULL DEFAULT '1',
  `OrgOffiPosDetails_DATE_MOD` datetime NOT NULL DEFAULT CURRENT_TIMESTAMP,
  `OrgOffiPosDetails_DATE_ADD` datetime NOT NULL DEFAULT CURRENT_TIMESTAMP,
  `OrgOffiPosDetails_DISPLAY_STAT` enum('Active','Inactive') DEFAULT 'Active'
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `r_org_officer_position_details`
--

INSERT INTO `r_org_officer_position_details` (`OrgOffiPosDetails_ID`, `OrgOffiPosDetails_ORG_CODE`, `OrgOffiPosDetails_NAME`, `OrgOffiPosDetails_DESC`, `OrgOffiPosDetails_NumOfOcc`, `OrgOffiPosDetails_DATE_MOD`, `OrgOffiPosDetails_DATE_ADD`, `OrgOffiPosDetails_DISPLAY_STAT`) VALUES
(1, 'CIT2017', 'President', 'Presidente ako', 1, '2018-03-19 01:30:56', '2018-03-18 22:25:02', 'Active'),
(2, 'ERICZZZ2017', 'President', 'Office Position Description', 1, '2018-04-29 18:01:54', '2018-04-29 18:01:54', 'Active'),
(3, 'ERICZZZ2017', 'Vice-President of internal affair', 'Office Position Description', 1, '2018-04-29 18:01:54', '2018-04-29 18:01:54', 'Active'),
(4, 'ERICZZZ2017', 'Vice-President of external affair', 'Office Position Description', 1, '2018-04-29 18:01:54', '2018-04-29 18:01:54', 'Active'),
(5, 'ERICZZZ2017', 'Budget and Finance', 'Office Position Description', 1, '2018-04-29 18:01:54', '2018-04-29 18:01:54', 'Active'),
(6, 'ERICZZZ2017', 'Auditor', 'Office Position Description', 1, '2018-04-29 18:01:55', '2018-04-29 18:01:55', 'Active'),
(7, 'QWE2017', 'President', 'Office Position Description', 1, '2018-04-29 18:14:03', '2018-04-29 18:14:03', 'Active'),
(8, 'QWE2017', 'Vice-President of internal affair', 'Office Position Description', 1, '2018-04-29 18:14:03', '2018-04-29 18:14:03', 'Active'),
(9, 'QWE2017', 'Vice-President of external affair', 'Office Position Description', 1, '2018-04-29 18:14:03', '2018-04-29 18:14:03', 'Active'),
(10, 'QWE2017', 'Budget and Finance', 'Office Position Description', 1, '2018-04-29 18:14:03', '2018-04-29 18:14:03', 'Active'),
(11, 'QWE2017', 'Auditor', 'Office Position Description', 1, '2018-04-29 18:14:03', '2018-04-29 18:14:03', 'Active'),
(12, 'EWQ2017', 'President', 'Office Position Description', 1, '2018-04-29 18:14:15', '2018-04-29 18:14:15', 'Active'),
(13, 'EWQ2017', 'Vice-President of internal affair', 'Office Position Description', 1, '2018-04-29 18:14:15', '2018-04-29 18:14:15', 'Active'),
(14, 'EWQ2017', 'Vice-President of external affair', 'Office Position Description', 1, '2018-04-29 18:14:15', '2018-04-29 18:14:15', 'Active'),
(15, 'EWQ2017', 'Budget and Finance', 'Office Position Description', 1, '2018-04-29 18:14:15', '2018-04-29 18:14:15', 'Active'),
(16, 'EWQ2017', 'Auditor', 'Office Position Description', 1, '2018-04-29 18:14:15', '2018-04-29 18:14:15', 'Active'),
(17, 'ASD2017', 'President', 'Office Position Description', 1, '2018-04-29 18:14:25', '2018-04-29 18:14:25', 'Active'),
(18, 'ASD2017', 'Vice-President of internal affair', 'Office Position Description', 1, '2018-04-29 18:14:25', '2018-04-29 18:14:25', 'Active'),
(19, 'ASD2017', 'Vice-President of external affair', 'Office Position Description', 1, '2018-04-29 18:14:25', '2018-04-29 18:14:25', 'Active'),
(20, 'ASD2017', 'Budget and Finance', 'Office Position Description', 1, '2018-04-29 18:14:26', '2018-04-29 18:14:26', 'Active'),
(21, 'ASD2017', 'Auditor', 'Office Position Description', 1, '2018-04-29 18:14:26', '2018-04-29 18:14:26', 'Active'),
(22, 'DSA2017', 'President', 'Office Position Description', 1, '2018-04-29 18:14:34', '2018-04-29 18:14:34', 'Active'),
(23, 'DSA2017', 'Vice-President of internal affair', 'Office Position Description', 1, '2018-04-29 18:14:34', '2018-04-29 18:14:34', 'Active'),
(24, 'DSA2017', 'Vice-President of external affair', 'Office Position Description', 1, '2018-04-29 18:14:34', '2018-04-29 18:14:34', 'Active'),
(25, 'DSA2017', 'Budget and Finance', 'Office Position Description', 1, '2018-04-29 18:14:34', '2018-04-29 18:14:34', 'Active'),
(26, 'DSA2017', 'Auditor', 'Office Position Description', 1, '2018-04-29 18:14:34', '2018-04-29 18:14:34', 'Active');

-- --------------------------------------------------------

--
-- Table structure for table `r_osas_head`
--

DROP TABLE IF EXISTS `r_osas_head`;
CREATE TABLE `r_osas_head` (
  `OSASHead_ID` int(11) NOT NULL,
  `OSASHead_CODE` varchar(15) NOT NULL,
  `OSASHead_NAME` varchar(100) NOT NULL,
  `OSASHead_DESC` varchar(100) NOT NULL DEFAULT 'Introduce your self',
  `OSASHead_DATE_PROMOTED` datetime NOT NULL DEFAULT CURRENT_TIMESTAMP,
  `OSASHead_DATE_ADD` datetime NOT NULL DEFAULT CURRENT_TIMESTAMP,
  `OSASHead_DATE_MOD` datetime NOT NULL DEFAULT CURRENT_TIMESTAMP,
  `OSASHead_DISPLAY_STAT` enum('Active','Inactive') DEFAULT 'Active'
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `r_osas_head`
--

INSERT INTO `r_osas_head` (`OSASHead_ID`, `OSASHead_CODE`, `OSASHead_NAME`, `OSASHead_DESC`, `OSASHead_DATE_PROMOTED`, `OSASHead_DATE_ADD`, `OSASHead_DATE_MOD`, `OSASHead_DISPLAY_STAT`) VALUES
(1, '2017-OSAS-CM-0', 'Demelyn Espejo Monzon', 'Introduce your self', '2017-04-27 00:00:00', '2018-02-08 08:13:12', '2018-02-08 08:13:12', 'Active');

-- --------------------------------------------------------

--
-- Table structure for table `r_sanction_details`
--

DROP TABLE IF EXISTS `r_sanction_details`;
CREATE TABLE `r_sanction_details` (
  `SancDetails_ID` int(11) NOT NULL,
  `SancDetails_CODE` varchar(100) NOT NULL,
  `SancDetails_NAME` varchar(100) NOT NULL,
  `SancDetails_DESC` varchar(1000) DEFAULT 'Sanction Description',
  `SancDetails_TIMEVAL` int(11) NOT NULL DEFAULT '0',
  `SancDetails_DATE_MOD` datetime NOT NULL DEFAULT CURRENT_TIMESTAMP,
  `SancDetails_DATE_ADD` datetime NOT NULL DEFAULT CURRENT_TIMESTAMP,
  `SancDetails_DISPLAY_STAT` enum('Active','Inactive') DEFAULT 'Active'
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `r_sanction_details`
--

INSERT INTO `r_sanction_details` (`SancDetails_ID`, `SancDetails_CODE`, `SancDetails_NAME`, `SancDetails_DESC`, `SancDetails_TIMEVAL`, `SancDetails_DATE_MOD`, `SancDetails_DATE_ADD`, `SancDetails_DISPLAY_STAT`) VALUES
(1, '2.1 3rdOffense', '3rd Offense Failure to bring valid ID', '2.1 failure to bring valid ID in case the student can present his/her registration certificate', 42, '2018-04-25 22:36:47', '2018-02-12 01:48:39', 'Active'),
(2, '2.1 < 3 Offense', 'Greater than 3Offenses, Failure to bring valid ID', 'xc', 72, '2018-04-25 23:07:21', '2018-02-12 02:46:57', 'Active'),
(8, '123', '123', '', 123, '2018-04-25 23:05:15', '2018-02-21 23:54:35', 'Inactive'),
(9, 'asd', '2.1 < 3 Offense', 'Greater than 3Offenses, Failure to bring valid ID', 72, '2018-04-25 23:05:53', '2018-02-21 23:55:11', 'Inactive'),
(10, 'SANC00005', 'sanc1', 'asd', 8, '2018-03-11 21:31:09', '2018-03-01 20:05:55', 'Inactive'),
(11, 'wqe', 'qwe', '123', 21, '2018-03-11 21:37:47', '2018-03-11 21:37:24', 'Inactive'),
(12, 'qwewqe', 'zxd', '123a', 7, '2018-04-25 22:37:14', '2018-04-25 22:24:17', 'Inactive'),
(14, '51515', '51515', '515s', 151, '2018-04-25 22:37:39', '2018-04-25 22:37:07', 'Active'),
(15, 'zaa', '555', '123', 123, '2018-04-25 22:53:04', '2018-04-25 22:53:04', 'Active');

-- --------------------------------------------------------

--
-- Table structure for table `r_semester`
--

DROP TABLE IF EXISTS `r_semester`;
CREATE TABLE `r_semester` (
  `Semestral_ID` int(11) NOT NULL,
  `Semestral_CODE` varchar(15) NOT NULL,
  `Semestral_NAME` varchar(50) NOT NULL,
  `Semestral_DESC` varchar(100) DEFAULT 'Semester Description',
  `Semestral_DATE_ADD` datetime NOT NULL DEFAULT CURRENT_TIMESTAMP,
  `Semestral_DATE_MOD` datetime NOT NULL DEFAULT CURRENT_TIMESTAMP,
  `Semestral_DISPLAY_STAT` enum('Active','Inactive') DEFAULT 'Active'
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `r_semester`
--

INSERT INTO `r_semester` (`Semestral_ID`, `Semestral_CODE`, `Semestral_NAME`, `Semestral_DESC`, `Semestral_DATE_ADD`, `Semestral_DATE_MOD`, `Semestral_DISPLAY_STAT`) VALUES
(1, 'Sem001', 'First Semester', 'Semester Descriptions', '2018-02-09 18:07:00', '2018-03-15 13:16:24', 'Active'),
(2, 'Sem002', 'Second Semester', 'Semester Description', '2018-02-09 18:07:00', '2018-02-09 18:07:00', 'Active'),
(3, 'SEM00003', 'Summer', 'Pasukann', '2018-04-25 21:21:05', '2018-04-25 21:21:05', 'Active'),
(4, 'SEM00004', '5131', '123s', '2018-04-25 21:22:03', '2018-04-25 21:25:17', 'Active'),
(5, 'SEM00005', 'zxzxc', 'qwe', '2018-04-25 21:33:38', '2018-04-25 21:33:38', 'Active'),
(6, 'SEM00006', 'tzxdc', 'asd', '2018-04-25 21:33:46', '2018-04-25 21:33:46', 'Active');

-- --------------------------------------------------------

--
-- Table structure for table `r_stud_profile`
--

DROP TABLE IF EXISTS `r_stud_profile`;
CREATE TABLE `r_stud_profile` (
  `Stud_ID` int(11) NOT NULL,
  `Stud_NO` varchar(15) NOT NULL,
  `Stud_FNAME` varchar(100) NOT NULL,
  `Stud_MNAME` varchar(100) DEFAULT NULL,
  `Stud_LNAME` varchar(100) NOT NULL,
  `Stud_COURSE` varchar(15) NOT NULL,
  `Stud_YEAR_LEVEL` int(11) NOT NULL DEFAULT '1',
  `Stud_SECTION` varchar(5) NOT NULL DEFAULT '1',
  `Stud_GENDER` enum('Male','Female') NOT NULL DEFAULT 'Male',
  `Stud_EMAIL` varchar(100) NOT NULL,
  `Stud_CONTACT_NO` varchar(20) NOT NULL DEFAULT 'None',
  `Stud_BIRHT_DATE` date NOT NULL,
  `Stud_BIRTH_PLACE` varchar(500) DEFAULT NULL,
  `Stud_ADDRESS` varchar(500) NOT NULL DEFAULT 'Not Specify',
  `Stud_STATUS` enum('Regular','Irregular','Disqualified','LOA','Transferee') DEFAULT 'Regular',
  `Stud_DATE_MOD` datetime NOT NULL DEFAULT CURRENT_TIMESTAMP,
  `Stud_DATE_ADD` datetime NOT NULL DEFAULT CURRENT_TIMESTAMP,
  `Stud_DATE_DEACTIVATE` datetime DEFAULT NULL,
  `Stud_DISPLAY_STATUS` enum('Active','Inactive') DEFAULT 'Active'
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `r_stud_profile`
--

INSERT INTO `r_stud_profile` (`Stud_ID`, `Stud_NO`, `Stud_FNAME`, `Stud_MNAME`, `Stud_LNAME`, `Stud_COURSE`, `Stud_YEAR_LEVEL`, `Stud_SECTION`, `Stud_GENDER`, `Stud_EMAIL`, `Stud_CONTACT_NO`, `Stud_BIRHT_DATE`, `Stud_BIRTH_PLACE`, `Stud_ADDRESS`, `Stud_STATUS`, `Stud_DATE_MOD`, `Stud_DATE_ADD`, `Stud_DATE_DEACTIVATE`, `Stud_DISPLAY_STATUS`) VALUES
(2, '2015-00265-CM-0', 'Ceriaco', 'Buelva', 'Respecia Jr.', 'BSIT', 3, '1', 'Male', 'ceriaco_respecia@gmail.com', 'None', '1998-10-03', 'Quezon City', 'Not Specified', 'Regular', '2018-02-19 14:07:24', '2018-02-07 18:48:39', NULL, 'Inactive'),
(3, '2015-00046-CM-0', 'Keith Eyvan', 'Nobong', 'Alvior', 'BSIT', 1, '1', 'Male', 'zheuswalker@gmail.com', 'None', '1999-03-26', 'Quezon City', 'Not Specify', 'Regular', '2018-02-21 21:58:22', '2018-02-07 18:49:28', NULL, 'Active'),
(5, '2015-00194-CM-0', 'Eric Kristopher', 'Paras', 'Valdez', 'BSIT', 1, '1', 'Male', 'eric_kristopher@gmail.com', 'None', '1999-09-04', 'Quezon City', 'Not Specify', 'Regular', '2018-02-12 17:20:48', '2018-02-07 18:50:31', NULL, 'Active'),
(6, '2015-00572-CM-0', 'Juan Paolo', '', 'Villanueva', 'BSIT', 1, '1', 'Male', 'juan_villanueva@gmail.com', 'None', '1998-10-10', 'Cavite City', 'Not Specify', 'Regular', '2018-02-07 18:51:28', '2018-02-07 18:51:28', NULL, 'Active'),
(7, '2015-00410-CM-0', 'Ma. Michaela', 'Cruz', 'Alejandria', 'BSIT', 1, '1', 'Female', 'michaeia@gmail.com', 'None', '1998-06-17', 'Quezon City', 'Greater Lagro', 'Regular', '2018-02-08 15:31:40', '2018-02-08 15:31:40', NULL, 'Active'),
(8, '2014-00119-CM-0', 'Ian', 'Badal', 'Avena', 'BSIT', 1, '1', 'Female', 'ianavena4@gmail.com', '09125665771', '1997-11-04', 'Don Fabian', 'PUP', 'Disqualified', '2018-02-28 07:56:25', '2018-02-08 17:35:53', NULL, 'Active'),
(9, '2015-00394-cm-0', 'Malene', '', 'Dizon', 'BSIT', 1, '3', 'Female', 'malene@gmail.com', '09776685572', '1998-06-10', 'QC', 'hhhhhhhhhhhhhhh', 'Regular', '2018-02-08 17:37:12', '2018-02-08 17:37:12', NULL, 'Active'),
(10, '2015-00001-CM-0', 'Sample fname', 'Mname', 'Lname', 'DICT', 1, '1', 'Male', 'Emailad@email.com', 'None', '1998-02-10', 'Quezon City', 'Hulaan mo', 'Regular', '2018-02-18 09:47:13', '2018-02-10 22:58:01', NULL, 'Active'),
(36, '2016-00303-CM-0', 'Joana Rose', 'Balmonte', 'Loyola', 'BSIT', 1, '1', 'Female', 'joanaloyola@gmail.com', '099995251071', '1999-10-26', 'Quezon City', 'please see the address of 2015-00073-CM-0', 'Regular', '2018-02-12 11:36:57', '2018-02-11 22:05:44', NULL, 'Active'),
(40, '20', '1', '1', '1', 'DOMT', 1, '1', 'Male', '1212', '11', '2018-01-30', '1', '1', 'Regular', '2018-02-12 00:06:42', '2018-02-11 23:11:43', NULL, 'Inactive'),
(41, '123', '12', '123', '123', 'DICT', 1, '1', 'Male', '123', '123', '1988-02-13', '123', '213', 'Regular', '2018-02-12 00:09:25', '2018-02-11 23:39:08', NULL, 'Inactive'),
(43, '2014-00114-CM-0', 'lean', 'badal', 'avena', 'BSIT', 1, '2', 'Male', 'ian@gmail.com', '09125665771', '1997-11-04', 'or min', 'pupqc', 'Regular', '2018-02-19 17:55:44', '2018-02-19 17:55:04', NULL, 'Active'),
(44, '2015-00202-CM-0', 'Jennifer', 'Tuban', 'Sanchez', 'BSIT', 1, '1', 'Male', 'eomma@gmail.com', 'None', '1998-07-15', 'Sampaloc, Manila', 'sa bahay', 'Regular', '2018-02-26 08:58:21', '2018-02-26 08:58:21', NULL, 'Active'),
(45, '2015-00040-CM-0', 'Franchesca', 'Ronquillo', 'Silonga', 'BSIT', 1, '1', 'Female', 'chescamae@gmail.com', 'None', '1998-01-22', 'Caloocan City', 'Sa bahay ni blaster', 'Regular', '2018-02-26 19:03:24', '2018-02-26 19:03:24', NULL, 'Active'),
(46, '454545', 'JJ', 'HH', 'GG', 'BSIT', 1, '1', 'Female', 'malene@yahoo', '0988888', '1998-12-30', 'QC', 'hhhhhhhhhhhhhhhhhhh', 'Regular', '2018-02-28 08:29:53', '2018-02-28 08:29:53', NULL, 'Active'),
(47, '2017-00000', 'g', 'g', 'g', 'BSIT', 1, '1', 'Female', 'mh@w', '777', '1996-12-29', 'qc', 'hhh', 'Regular', '2018-03-01 18:13:40', '2018-03-01 18:13:40', NULL, 'Active'),
(48, '2015-00073-CM-0', 'John Patrick', 'Balmonte', 'Loyola', 'BSIT', 1, '1', 'Male', 'loyolapat04@gmail.com', '09995251071', '1998-11-04', 'Quezon City', '1127', 'Regular', '2018-03-04 22:43:03', '2018-03-04 22:43:03', NULL, 'Active');

-- --------------------------------------------------------

--
-- Table structure for table `r_users`
--

DROP TABLE IF EXISTS `r_users`;
CREATE TABLE `r_users` (
  `Users_ID` int(11) NOT NULL,
  `Users_USERNAME` varchar(50) NOT NULL,
  `Users_REFERENCED` varchar(15) NOT NULL,
  `Users_PASSWORD` blob NOT NULL,
  `Users_ROLES` enum('Administrator','OSAS HEAD','Organization','Student') NOT NULL,
  `Users_PROFILE_PATH` varchar(500) DEFAULT NULL,
  `Users_DATE_ADD` datetime NOT NULL DEFAULT CURRENT_TIMESTAMP,
  `Users_DATE_MOD` datetime NOT NULL DEFAULT CURRENT_TIMESTAMP,
  `Users_DISPLAY_STAT` enum('Active','Inactive') DEFAULT 'Active'
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `r_users`
--

INSERT INTO `r_users` (`Users_ID`, `Users_USERNAME`, `Users_REFERENCED`, `Users_PASSWORD`, `Users_ROLES`, `Users_PROFILE_PATH`, `Users_DATE_ADD`, `Users_DATE_MOD`, `Users_DISPLAY_STAT`) VALUES
(1, 'Demelyn', '2017-OSAS-CM-0', 0x852fa0a245a1467fcfd3e79a8c1bb0c9, 'OSAS HEAD', NULL, '2018-02-08 08:47:45', '2018-02-08 08:47:45', 'Active'),
(4, 'Patrick', '', 0x852fa0a245a1467fcfd3e79a8c1bb0c9, 'Administrator', '../avatar/ytyytytyt', '2018-03-12 02:41:39', '2018-03-17 04:18:32', 'Active'),
(5, 'CIT2017', 'CIT2017', 0x852fa0a245a1467fcfd3e79a8c1bb0c9, 'Organization', NULL, '2018-03-18 21:54:15', '2018-03-18 21:54:15', 'Active'),
(6, 'eric', '', 0x852fa0a245a1467fcfd3e79a8c1bb0c9, 'Administrator', NULL, '2018-04-29 17:48:56', '2018-04-29 17:48:56', 'Active'),
(7, 'ERICZZZ2017', 'ERICZZZ2017', 0x7436e1860c662c29fa7045d6baa52850, 'Organization', NULL, '2018-04-29 18:03:28', '2018-04-29 18:03:28', 'Active'),
(8, 'ASD2017', 'ASD2017', 0x405ee0858c9b88d71a455bcd2dba0716, 'Organization', NULL, '2018-04-29 18:14:46', '2018-04-29 18:14:46', 'Active'),
(9, 'DSA2017', 'DSA2017', 0xf17d0079a2d9b316bf91263db2f62659, 'Organization', NULL, '2018-04-29 18:15:50', '2018-04-29 18:15:50', 'Active'),
(10, 'EWQ2017', 'EWQ2017', 0x32541edddbe82e698b46a063c13843c5, 'Organization', NULL, '2018-04-29 18:16:52', '2018-04-29 18:16:52', 'Active'),
(11, 'QWE2017', 'QWE2017', 0x9846f75237937b1800a065bc7cfc51bc, 'Organization', NULL, '2018-04-29 18:43:36', '2018-04-29 18:43:36', 'Active');

-- --------------------------------------------------------

--
-- Table structure for table `t_assign_org_academic_course`
--

DROP TABLE IF EXISTS `t_assign_org_academic_course`;
CREATE TABLE `t_assign_org_academic_course` (
  `AssOrgAcademic_ID` int(11) NOT NULL,
  `AssOrgAcademic_ORG_CODE` varchar(15) NOT NULL,
  `AssOrgAcademic_COURSE_CODE` varchar(15) NOT NULL,
  `AssOrgAcademic_DATE_ADD` datetime NOT NULL DEFAULT CURRENT_TIMESTAMP,
  `AssOrgAcademic_DATE_MOD` datetime NOT NULL DEFAULT CURRENT_TIMESTAMP,
  `AssOrgAcademic_DISPLAY_STAT` enum('Active','Inactive') DEFAULT 'Active'
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `t_assign_org_academic_course`
--

INSERT INTO `t_assign_org_academic_course` (`AssOrgAcademic_ID`, `AssOrgAcademic_ORG_CODE`, `AssOrgAcademic_COURSE_CODE`, `AssOrgAcademic_DATE_ADD`, `AssOrgAcademic_DATE_MOD`, `AssOrgAcademic_DISPLAY_STAT`) VALUES
(32, 'ASD2017', 'DICT', '2018-04-29 18:14:26', '2018-04-29 18:14:26', 'Active'),
(26, 'CIT2015', 'DOMT', '2018-03-19 14:14:42', '2018-03-19 14:14:42', 'Active'),
(23, 'CIT2016', 'BSIT', '2018-03-19 13:21:03', '2018-03-19 13:21:03', 'Active'),
(22, 'CIT2016', 'DICT', '2018-03-19 13:21:03', '2018-03-19 13:21:03', 'Active'),
(21, 'CIT2017', 'BSIT', '2018-03-15 16:42:37', '2018-03-15 16:42:37', 'Active'),
(20, 'CIT2017', 'DICT', '2018-03-15 16:42:37', '2018-03-15 16:42:37', 'Active'),
(19, 'CIT2017', 'DOMT', '2018-03-15 16:28:58', '2018-03-15 16:28:58', 'Active'),
(24, 'D2017', 'BSIT', '2018-03-19 14:01:08', '2018-03-19 14:01:08', 'Active'),
(25, 'D2017', 'DICT', '2018-03-19 14:01:08', '2018-03-19 14:01:08', 'Active'),
(33, 'DSA2017', '5151', '2018-04-29 18:14:34', '2018-04-29 18:14:34', 'Active'),
(27, 'ERICZZZ2017', 'DOMT', '2018-04-29 18:01:55', '2018-04-29 18:01:55', 'Active'),
(31, 'EWQ2017', 'DOMT', '2018-04-29 18:14:15', '2018-04-29 18:14:15', 'Active'),
(28, 'QWE2017', 'BSIT', '2018-04-29 18:14:03', '2018-04-29 18:14:03', 'Active'),
(30, 'QWE2017', 'DICT', '2018-04-29 18:14:03', '2018-04-29 18:14:03', 'Active'),
(29, 'QWE2017', 'DOMT', '2018-04-29 18:14:03', '2018-04-29 18:14:03', 'Active');

-- --------------------------------------------------------

--
-- Table structure for table `t_assign_org_category`
--

DROP TABLE IF EXISTS `t_assign_org_category`;
CREATE TABLE `t_assign_org_category` (
  `AssOrgCategory_ID` int(11) NOT NULL,
  `AssOrgCategory_ORG_CODE` varchar(15) NOT NULL,
  `AssOrgCategory_ORGCAT_CODE` varchar(15) NOT NULL,
  `AssOrgCategory_DATE_ADD` datetime NOT NULL DEFAULT CURRENT_TIMESTAMP,
  `AssOrgCategory_DATE_MOD` datetime NOT NULL DEFAULT CURRENT_TIMESTAMP,
  `AssOrgCategory_DISPLAY_STAT` enum('Active','Inactive') DEFAULT 'Active'
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `t_assign_org_category`
--

INSERT INTO `t_assign_org_category` (`AssOrgCategory_ID`, `AssOrgCategory_ORG_CODE`, `AssOrgCategory_ORGCAT_CODE`, `AssOrgCategory_DATE_ADD`, `AssOrgCategory_DATE_MOD`, `AssOrgCategory_DISPLAY_STAT`) VALUES
(27, 'ASD2017', 'ACAD_ORG', '2018-04-29 18:14:25', '2018-04-29 18:14:25', 'Active'),
(23, 'CIT2015', 'ACAD_ORG', '2018-03-19 14:13:58', '2018-03-19 14:13:58', 'Active'),
(21, 'CIT2016', 'ACAD_ORG', '2018-03-19 04:17:51', '2018-03-19 04:17:51', 'Active'),
(19, 'CIT2017', 'ACAD_ORG', '2018-03-15 16:28:58', '2018-03-15 16:28:58', 'Active'),
(20, 'D2017', 'ACAD_ORG', '2018-03-19 02:26:15', '2018-03-19 02:26:15', 'Active'),
(28, 'DSA2017', 'ACAD_ORG', '2018-04-29 18:14:34', '2018-04-29 18:14:34', 'Active'),
(24, 'ERICZZZ2017', 'ACAD_ORG', '2018-04-29 18:01:54', '2018-04-29 18:01:54', 'Active'),
(26, 'EWQ2017', 'ACAD_ORG', '2018-04-29 18:14:15', '2018-04-29 18:14:15', 'Active'),
(22, 'O2017', 'NONACAD_ORG', '2018-03-19 13:07:02', '2018-03-19 13:07:02', 'Active'),
(25, 'QWE2017', 'ACAD_ORG', '2018-04-29 18:14:03', '2018-04-29 18:14:03', 'Active');

-- --------------------------------------------------------

--
-- Table structure for table `t_assign_org_members`
--

DROP TABLE IF EXISTS `t_assign_org_members`;
CREATE TABLE `t_assign_org_members` (
  `AssOrgMem_ID` int(11) NOT NULL,
  `AssOrgMem_STUD_NO` varchar(15) NOT NULL,
  `AssOrgMem_COMPL_ORG_CODE` varchar(15) NOT NULL,
  `AssOrgMem_DATE_ADD` datetime NOT NULL DEFAULT CURRENT_TIMESTAMP,
  `AssOrgMem_DATE_MOD` datetime DEFAULT NULL,
  `AssOrgMem_DISPLAY_STAT` enum('Active','Inactive') NOT NULL DEFAULT 'Active'
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `t_assign_org_members`
--

INSERT INTO `t_assign_org_members` (`AssOrgMem_ID`, `AssOrgMem_STUD_NO`, `AssOrgMem_COMPL_ORG_CODE`, `AssOrgMem_DATE_ADD`, `AssOrgMem_DATE_MOD`, `AssOrgMem_DISPLAY_STAT`) VALUES
(9, '2014-00114-CM-0', 'CIT2017', '2018-03-18 23:23:27', '2018-03-19 02:18:39', 'Active'),
(22, '2014-00114-CM-0', 'D2017', '2018-04-29 17:37:33', NULL, 'Active'),
(37, '2014-00114-CM-0', 'QWE2017', '2018-04-29 18:43:49', NULL, 'Active'),
(5, '2014-00119-CM-0', 'CIT2017', '2018-03-18 23:23:26', NULL, 'Active'),
(19, '2014-00119-CM-0', 'D2017', '2018-04-29 17:37:33', NULL, 'Active'),
(33, '2014-00119-CM-0', 'QWE2017', '2018-04-29 18:43:49', NULL, 'Active'),
(7, '2015-00001-CM-0', 'CIT2017', '2018-03-18 23:23:27', NULL, 'Active'),
(28, '2015-00001-CM-0', 'D2017', '2018-04-29 17:37:33', NULL, 'Active'),
(35, '2015-00001-CM-0', 'QWE2017', '2018-04-29 18:43:49', NULL, 'Active'),
(11, '2015-00040-CM-0', 'CIT2017', '2018-03-18 23:23:27', NULL, 'Active'),
(24, '2015-00040-CM-0', 'D2017', '2018-04-29 17:37:33', NULL, 'Active'),
(39, '2015-00040-CM-0', 'QWE2017', '2018-04-29 18:43:49', NULL, 'Active'),
(1, '2015-00046-CM-0', 'CIT2017', '2018-03-18 23:10:14', NULL, 'Active'),
(15, '2015-00046-CM-0', 'D2017', '2018-04-29 17:37:32', NULL, 'Active'),
(29, '2015-00046-CM-0', 'QWE2017', '2018-04-29 18:43:49', NULL, 'Active'),
(14, '2015-00073-CM-0', 'CIT2017', '2018-03-18 23:23:27', NULL, 'Active'),
(27, '2015-00073-CM-0', 'D2017', '2018-04-29 17:37:33', NULL, 'Active'),
(42, '2015-00073-CM-0', 'QWE2017', '2018-04-29 18:43:49', NULL, 'Active'),
(2, '2015-00194-CM-0', 'CIT2017', '2018-03-18 23:20:12', NULL, 'Active'),
(16, '2015-00194-CM-0', 'D2017', '2018-04-29 17:37:32', NULL, 'Active'),
(30, '2015-00194-CM-0', 'QWE2017', '2018-04-29 18:43:49', NULL, 'Active'),
(10, '2015-00202-CM-0', 'CIT2017', '2018-03-18 23:23:27', NULL, 'Active'),
(23, '2015-00202-CM-0', 'D2017', '2018-04-29 17:37:33', NULL, 'Active'),
(38, '2015-00202-CM-0', 'QWE2017', '2018-04-29 18:43:49', NULL, 'Active'),
(6, '2015-00394-cm-0', 'CIT2017', '2018-03-18 23:23:26', NULL, 'Active'),
(20, '2015-00394-cm-0', 'D2017', '2018-04-29 17:37:33', NULL, 'Active'),
(34, '2015-00394-cm-0', 'QWE2017', '2018-04-29 18:43:49', NULL, 'Active'),
(4, '2015-00410-CM-0', 'CIT2017', '2018-03-18 23:23:26', NULL, 'Active'),
(18, '2015-00410-CM-0', 'D2017', '2018-04-29 17:37:32', NULL, 'Active'),
(32, '2015-00410-CM-0', 'QWE2017', '2018-04-29 18:43:49', NULL, 'Active'),
(3, '2015-00572-CM-0', 'CIT2017', '2018-03-18 23:23:26', NULL, 'Active'),
(17, '2015-00572-CM-0', 'D2017', '2018-04-29 17:37:32', NULL, 'Active'),
(31, '2015-00572-CM-0', 'QWE2017', '2018-04-29 18:43:49', NULL, 'Active'),
(8, '2016-00303-CM-0', 'CIT2017', '2018-03-18 23:23:27', NULL, 'Active'),
(21, '2016-00303-CM-0', 'D2017', '2018-04-29 17:37:33', NULL, 'Active'),
(36, '2016-00303-CM-0', 'QWE2017', '2018-04-29 18:43:49', NULL, 'Active'),
(13, '2017-00000', 'CIT2017', '2018-03-18 23:23:27', NULL, 'Active'),
(26, '2017-00000', 'D2017', '2018-04-29 17:37:33', NULL, 'Active'),
(41, '2017-00000', 'QWE2017', '2018-04-29 18:43:49', NULL, 'Active'),
(12, '454545', 'CIT2017', '2018-03-18 23:23:27', NULL, 'Active'),
(25, '454545', 'D2017', '2018-04-29 17:37:33', NULL, 'Active'),
(40, '454545', 'QWE2017', '2018-04-29 18:43:49', NULL, 'Active');

-- --------------------------------------------------------

--
-- Table structure for table `t_assign_org_non_academic`
--

DROP TABLE IF EXISTS `t_assign_org_non_academic`;
CREATE TABLE `t_assign_org_non_academic` (
  `AssOrgNonAcademic_ID` int(11) NOT NULL,
  `AssOrgNonAcademic_ORG_CODE` varchar(15) NOT NULL,
  `AssOrgNonAcademic_NON_ACAD` varchar(15) NOT NULL,
  `AssOrgNonAcademic_DATE_ADD` datetime NOT NULL DEFAULT CURRENT_TIMESTAMP,
  `AssOrgNonAcademic_DATE_MOD` datetime NOT NULL DEFAULT CURRENT_TIMESTAMP,
  `AssOrgNonAcademic_DISPLAY_STAT` enum('Active','Inactive') NOT NULL DEFAULT 'Active'
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

-- --------------------------------------------------------

--
-- Table structure for table `t_assign_org_sanction`
--

DROP TABLE IF EXISTS `t_assign_org_sanction`;
CREATE TABLE `t_assign_org_sanction` (
  `AssSancOrgStudent_ID` int(11) NOT NULL,
  `AssSancOrgStudent_REG_ORG` varchar(15) NOT NULL,
  `AssSancOrgStudent_SancDetails_CODE` varchar(15) NOT NULL,
  `AssSancOrgStudent_REMARKS` varchar(15) NOT NULL,
  `AssSancOrgStudent_DATE_ADD` datetime NOT NULL DEFAULT CURRENT_TIMESTAMP,
  `AssSancOrgStudent_DATE_MOD` datetime NOT NULL DEFAULT CURRENT_TIMESTAMP,
  `AssSancOrgStudent_DISPLAY_STAT` enum('Active','Inactive') DEFAULT 'Active'
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

-- --------------------------------------------------------

--
-- Table structure for table `t_assign_student_clearance`
--

DROP TABLE IF EXISTS `t_assign_student_clearance`;
CREATE TABLE `t_assign_student_clearance` (
  `AssStudClearance_ID` int(11) NOT NULL,
  `AssStudClearance_STUD_NO` varchar(15) NOT NULL,
  `AssStudClearance_BATCH` varchar(15) NOT NULL,
  `AssStudClearance_SEMESTER` varchar(50) NOT NULL,
  `AssStudClearance_SIGNATORIES_CODE` varchar(15) NOT NULL,
  `AssStudClearance_DATE_ADD` datetime NOT NULL DEFAULT CURRENT_TIMESTAMP,
  `AssStudClearance_DATE_MOD` datetime NOT NULL DEFAULT CURRENT_TIMESTAMP,
  `AssStudClearance_DISPLAY_STAT` enum('Active','Inactive') DEFAULT 'Active'
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

-- --------------------------------------------------------

--
-- Table structure for table `t_assign_stud_finan_assistance`
--

DROP TABLE IF EXISTS `t_assign_stud_finan_assistance`;
CREATE TABLE `t_assign_stud_finan_assistance` (
  `AssStudFinanAssistance_ID` int(11) NOT NULL,
  `AssStudFinanAssistance_STUD_NO` varchar(15) NOT NULL,
  `AssStudFinanAssistance_FINAN_NAME` varchar(100) NOT NULL,
  `AssStudFinanAssistance_STATUS` enum('Active','Inactive','Void','Cancelled') NOT NULL DEFAULT 'Active',
  `AssStudFinanAssistance_REMARKS` varchar(500) NOT NULL DEFAULT 'Remarks',
  `AssStudFinanAssistance_DATE_ADD` datetime NOT NULL DEFAULT CURRENT_TIMESTAMP,
  `AssStudFinanAssistance_DATE_MOD` datetime NOT NULL DEFAULT CURRENT_TIMESTAMP,
  `AssStudFinanAssistance_DISPLAY_STAT` enum('Active','Inactive') DEFAULT 'Active'
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `t_assign_stud_finan_assistance`
--

INSERT INTO `t_assign_stud_finan_assistance` (`AssStudFinanAssistance_ID`, `AssStudFinanAssistance_STUD_NO`, `AssStudFinanAssistance_FINAN_NAME`, `AssStudFinanAssistance_STATUS`, `AssStudFinanAssistance_REMARKS`, `AssStudFinanAssistance_DATE_ADD`, `AssStudFinanAssistance_DATE_MOD`, `AssStudFinanAssistance_DISPLAY_STAT`) VALUES
(90, '2015-00046-CM-0', 'CHED', 'Active', ' ', '2018-03-17 01:49:02', '2018-03-17 14:39:33', 'Active'),
(91, '2015-00046-CM-0', 'SYDP', 'Active', ' a', '2018-03-17 01:53:49', '2018-03-17 01:54:51', 'Active'),
(93, '2015-00194-CM-0', 'CHED', 'Active', '', '2018-03-18 11:07:11', '2018-03-18 11:07:11', 'Active'),
(92, '2015-00194-CM-0', 'SYDP', 'Inactive', '', '2018-03-18 11:07:11', '2018-03-18 11:07:11', 'Active');

-- --------------------------------------------------------

--
-- Table structure for table `t_assign_stud_loss_id_regicard`
--

DROP TABLE IF EXISTS `t_assign_stud_loss_id_regicard`;
CREATE TABLE `t_assign_stud_loss_id_regicard` (
  `AssLoss_ID` int(11) NOT NULL,
  `AssLoss_STUD_NO` varchar(15) NOT NULL,
  `AssLoss_TYPE` enum('Identification Card','Registration Card') NOT NULL,
  `AssLoss_REMARKS` varchar(500) NOT NULL DEFAULT 'Remarks Description',
  `AssLoss_DATE_CLAIM` datetime DEFAULT NULL,
  `AssLoss_DATE_ADD` datetime NOT NULL DEFAULT CURRENT_TIMESTAMP,
  `AssLoss_DATE_MOD` datetime NOT NULL DEFAULT CURRENT_TIMESTAMP,
  `AssLoss_DISPLAY_STAT` enum('Active','Inactive') DEFAULT 'Active'
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `t_assign_stud_loss_id_regicard`
--

INSERT INTO `t_assign_stud_loss_id_regicard` (`AssLoss_ID`, `AssLoss_STUD_NO`, `AssLoss_TYPE`, `AssLoss_REMARKS`, `AssLoss_DATE_CLAIM`, `AssLoss_DATE_ADD`, `AssLoss_DATE_MOD`, `AssLoss_DISPLAY_STAT`) VALUES
(1, '2015-00410-CM-0', 'Registration Card', '123', '2018-03-19 00:00:00', '2018-03-01 03:25:35', '2018-03-01 03:25:35', 'Inactive'),
(2, '2015-00046-CM-0', 'Registration Card', '', '2018-03-12 00:00:00', '2018-03-01 13:38:24', '2018-03-01 13:38:24', 'Inactive'),
(3, '2015-00194-CM-0', 'Registration Card', 'ds', '2018-12-12 11:11:00', '2018-03-01 15:44:37', '2018-03-01 15:44:37', 'Inactive'),
(4, '2015-00410-CM-0', 'Registration Card', '', '2018-03-09 17:59:19', '2018-03-10 00:59:19', '2018-03-10 00:59:19', 'Inactive'),
(5, '2015-00410-CM-0', 'Identification Card', 'hahaha', '2018-03-12 12:42:30', '2018-03-12 19:42:30', '2018-03-12 19:42:30', 'Inactive'),
(6, '2015-00194-CM-0', 'Identification Card', ' ', '2018-03-12 00:00:00', '2018-03-12 20:00:52', '2018-03-12 20:00:52', 'Inactive'),
(7, '2015-00194-CM-0', 'Registration Card', '', '2018-03-16 19:03:29', '2018-03-17 02:03:29', '2018-03-17 02:03:29', 'Inactive'),
(8, '2015-00194-CM-0', 'Identification Card', '', '2018-03-16 19:07:41', '2018-03-17 02:07:41', '2018-03-17 02:07:41', 'Inactive'),
(9, '2015-00194-CM-0', 'Registration Card', '', '2018-03-16 19:07:41', '2018-03-17 02:07:41', '2018-03-17 02:07:41', 'Inactive'),
(10, '2015-00046-CM-0', 'Registration Card', 'asd', '2018-03-16 19:16:06', '2018-03-17 02:16:06', '2018-03-17 02:16:06', 'Inactive'),
(11, '2015-00046-CM-0', 'Registration Card', '', '2018-03-16 19:24:25', '2018-03-17 02:24:25', '2018-03-17 02:24:25', 'Inactive'),
(12, '2015-00046-CM-0', 'Registration Card', '', '2018-03-16 19:25:16', '2018-03-17 02:25:16', '2018-03-17 02:25:16', 'Inactive'),
(13, '2015-00046-CM-0', 'Registration Card', '', '0000-00-00 00:00:00', '2018-03-17 02:26:46', '2018-03-17 02:26:46', 'Inactive'),
(14, '2015-00046-CM-0', 'Registration Card', '', '0000-00-00 00:00:00', '2018-03-17 02:27:00', '2018-03-17 02:27:00', 'Inactive'),
(15, '2015-00046-CM-0', 'Registration Card', '', '2018-03-17 00:00:00', '2018-03-17 02:27:30', '2018-03-17 02:27:30', 'Inactive'),
(16, '2015-00046-CM-0', 'Registration Card', '', '0000-00-00 00:00:00', '2018-03-17 03:40:42', '2018-03-17 03:40:42', 'Inactive'),
(17, '2015-00046-CM-0', 'Registration Card', '', '0000-00-00 00:00:00', '2018-03-17 04:26:59', '2018-03-17 04:26:59', 'Inactive'),
(18, '2015-00046-CM-0', 'Registration Card', ' rytyty', '2018-03-18 04:06:23', '2018-03-17 04:39:28', '2018-03-17 04:39:28', 'Active'),
(19, '2015-00046-CM-0', 'Identification Card', 'kk', '0000-00-00 00:00:00', '2018-03-18 11:06:43', '2018-03-18 11:06:43', 'Active'),
(20, '2015-00046-CM-0', 'Identification Card', 'kk', '0000-00-00 00:00:00', '2018-03-18 11:06:43', '2018-03-18 11:06:43', 'Active');

-- --------------------------------------------------------

--
-- Table structure for table `t_assign_stud_saction`
--

DROP TABLE IF EXISTS `t_assign_stud_saction`;
CREATE TABLE `t_assign_stud_saction` (
  `AssSancStudStudent_ID` int(11) NOT NULL,
  `AssSancStudStudent_STUD_NO` varchar(15) NOT NULL,
  `AssSancStudStudent_SancDetails_CODE` varchar(100) NOT NULL,
  `AssSancStudStudent_DesOffDetails_CODE` varchar(15) NOT NULL,
  `AssSancStudStudent_CONSUMED_HOURS` int(11) DEFAULT '0',
  `AssSancStudStudent_TO_BE_DONE` date DEFAULT NULL,
  `AssSancStudStudent_REMARKS` varchar(100) DEFAULT NULL,
  `AssSancStudStudent_IS_FINISH` enum('Processing','Finished') NOT NULL DEFAULT 'Processing',
  `AssSancStudStudent_DATE_ADD` datetime NOT NULL DEFAULT CURRENT_TIMESTAMP,
  `AssSancStudStudent_DATE_MOD` datetime NOT NULL DEFAULT CURRENT_TIMESTAMP,
  `AssSancStudStudent_DISPLAY_STAT` enum('Active','Inactive') DEFAULT 'Active'
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `t_assign_stud_saction`
--

INSERT INTO `t_assign_stud_saction` (`AssSancStudStudent_ID`, `AssSancStudStudent_STUD_NO`, `AssSancStudStudent_SancDetails_CODE`, `AssSancStudStudent_DesOffDetails_CODE`, `AssSancStudStudent_CONSUMED_HOURS`, `AssSancStudStudent_TO_BE_DONE`, `AssSancStudStudent_REMARKS`, `AssSancStudStudent_IS_FINISH`, `AssSancStudStudent_DATE_ADD`, `AssSancStudStudent_DATE_MOD`, `AssSancStudStudent_DISPLAY_STAT`) VALUES
(1, '2015-00046-CM-0', '2.1 3rdOffense', 'OFF00001', 10, '2018-05-01', 'excused pala hehehe', 'Processing', '2018-03-16 18:02:05', '2018-05-06 19:36:59', 'Active');

-- --------------------------------------------------------

--
-- Table structure for table `t_org_accreditation_process`
--

DROP TABLE IF EXISTS `t_org_accreditation_process`;
CREATE TABLE `t_org_accreditation_process` (
  `OrgAccrProcess_ID` int(11) NOT NULL,
  `OrgAccrProcess_ORG_CODE` varchar(15) NOT NULL,
  `OrgAccrProcess_OrgAccrDetail_CODE` varchar(15) NOT NULL,
  `OrgAccrProcess_IS_ACCREDITED` int(11) NOT NULL DEFAULT '0',
  `OrgAccrProcess_DATE_ADD` datetime NOT NULL DEFAULT CURRENT_TIMESTAMP,
  `OrgAccrProcess_DATE_MOD` datetime NOT NULL DEFAULT CURRENT_TIMESTAMP,
  `OrgAccrProcess_DISPLAY_STAT` enum('Active','Inactive') DEFAULT 'Active'
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `t_org_accreditation_process`
--

INSERT INTO `t_org_accreditation_process` (`OrgAccrProcess_ID`, `OrgAccrProcess_ORG_CODE`, `OrgAccrProcess_OrgAccrDetail_CODE`, `OrgAccrProcess_IS_ACCREDITED`, `OrgAccrProcess_DATE_ADD`, `OrgAccrProcess_DATE_MOD`, `OrgAccrProcess_DISPLAY_STAT`) VALUES
(24, 'ASD2017', 'REQ00001', 1, '2018-04-29 18:15:04', '2018-04-29 18:15:04', 'Active'),
(26, 'ASD2017', 'REQ00002', 1, '2018-04-29 18:15:04', '2018-04-29 18:15:04', 'Active'),
(27, 'ASD2017', 'REQ00003', 1, '2018-04-29 18:15:04', '2018-04-29 18:15:04', 'Active'),
(25, 'ASD2017', 'REQ00004', 1, '2018-04-29 18:15:04', '2018-04-29 18:15:04', 'Active'),
(12, 'CIT2016', 'REQ00001', 0, '2018-03-19 04:21:12', '2018-03-19 04:21:12', 'Active'),
(13, 'CIT2016', 'REQ00002', 1, '2018-03-19 04:21:12', '2018-03-19 04:21:12', 'Active'),
(11, 'CIT2016', 'REQ00003', 1, '2018-03-19 04:21:12', '2018-03-19 04:21:12', 'Active'),
(5, 'CIT2017', 'REQ00001', 1, '2018-03-15 16:29:07', '2018-03-15 16:29:07', 'Active'),
(6, 'CIT2017', 'REQ00002', 1, '2018-03-15 16:29:07', '2018-03-15 16:29:07', 'Active'),
(7, 'CIT2017', 'REQ00003', 1, '2018-03-15 16:52:25', '2018-03-15 16:52:25', 'Active'),
(17, 'CIT2017', 'REQ00004', 1, '2018-04-28 16:52:59', '2018-04-28 16:52:59', 'Active'),
(9, 'D2017', 'REQ00001', 1, '2018-03-19 02:26:23', '2018-03-19 02:26:23', 'Active'),
(8, 'D2017', 'REQ00002', 1, '2018-03-19 02:26:23', '2018-03-19 02:26:23', 'Active'),
(10, 'D2017', 'REQ00003', 1, '2018-03-19 02:26:23', '2018-03-19 02:26:23', 'Active'),
(18, 'D2017', 'REQ00004', 1, '2018-04-29 17:37:35', '2018-04-29 17:37:35', 'Active'),
(28, 'DSA2017', 'REQ00001', 1, '2018-04-29 18:15:59', '2018-04-29 18:15:59', 'Active'),
(30, 'DSA2017', 'REQ00002', 1, '2018-04-29 18:15:59', '2018-04-29 18:15:59', 'Active'),
(31, 'DSA2017', 'REQ00003', 1, '2018-04-29 18:15:59', '2018-04-29 18:15:59', 'Active'),
(29, 'DSA2017', 'REQ00004', 1, '2018-04-29 18:15:59', '2018-04-29 18:15:59', 'Active'),
(20, 'ERICZZZ2017', 'REQ00001', 1, '2018-04-29 18:03:49', '2018-04-29 18:03:49', 'Active'),
(23, 'ERICZZZ2017', 'REQ00002', 1, '2018-04-29 18:03:49', '2018-04-29 18:03:49', 'Active'),
(22, 'ERICZZZ2017', 'REQ00003', 1, '2018-04-29 18:03:49', '2018-04-29 18:03:49', 'Active'),
(21, 'ERICZZZ2017', 'REQ00004', 1, '2018-04-29 18:03:49', '2018-04-29 18:03:49', 'Active'),
(32, 'EWQ2017', 'REQ00001', 1, '2018-04-29 18:16:59', '2018-04-29 18:16:59', 'Active'),
(33, 'EWQ2017', 'REQ00002', 1, '2018-04-29 18:16:59', '2018-04-29 18:16:59', 'Active'),
(34, 'EWQ2017', 'REQ00003', 1, '2018-04-29 18:16:59', '2018-04-29 18:16:59', 'Active'),
(35, 'EWQ2017', 'REQ00004', 1, '2018-04-29 18:16:59', '2018-04-29 18:16:59', 'Active'),
(16, 'O2017', 'REQ00001', 1, '2018-03-19 13:07:11', '2018-03-19 13:07:11', 'Active'),
(14, 'O2017', 'REQ00002', 1, '2018-03-19 13:07:11', '2018-03-19 13:07:11', 'Active'),
(15, 'O2017', 'REQ00003', 1, '2018-03-19 13:07:11', '2018-03-19 13:07:11', 'Active'),
(19, 'O2017', 'REQ00004', 1, '2018-04-29 17:38:32', '2018-04-29 17:38:32', 'Active'),
(36, 'QWE2017', 'REQ00001', 1, '2018-04-29 18:43:40', '2018-04-29 18:43:40', 'Active'),
(39, 'QWE2017', 'REQ00002', 1, '2018-04-29 18:43:40', '2018-04-29 18:43:40', 'Active'),
(38, 'QWE2017', 'REQ00003', 1, '2018-04-29 18:43:40', '2018-04-29 18:43:40', 'Active'),
(37, 'QWE2017', 'REQ00004', 1, '2018-04-29 18:43:40', '2018-04-29 18:43:40', 'Active');

-- --------------------------------------------------------

--
-- Table structure for table `t_org_cash_flow_statement`
--

DROP TABLE IF EXISTS `t_org_cash_flow_statement`;
CREATE TABLE `t_org_cash_flow_statement` (
  `OrgCashFlowStatement_ID` int(11) NOT NULL,
  `OrgCashFlowStatement_ORG_CODE` varchar(15) NOT NULL,
  `OrgCashFlowStatement_ITEM` varchar(100) NOT NULL,
  `OrgCashFlowStatement_COLLECTION` double(10,3) DEFAULT NULL,
  `OrgCashFlowStatement_EXPENSES` double(10,3) DEFAULT NULL,
  `OrgCashFlowStatement_REMARKS` varchar(100) DEFAULT NULL,
  `OrgCashFlowStatement_DATE_ADD` datetime NOT NULL DEFAULT CURRENT_TIMESTAMP,
  `OrgCashFlowStatement_DATE_MOD` datetime NOT NULL DEFAULT CURRENT_TIMESTAMP,
  `OrgCashFlowStatement_DISPLAY_STAT` enum('Active','Inactive') DEFAULT 'Active'
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `t_org_cash_flow_statement`
--

INSERT INTO `t_org_cash_flow_statement` (`OrgCashFlowStatement_ID`, `OrgCashFlowStatement_ORG_CODE`, `OrgCashFlowStatement_ITEM`, `OrgCashFlowStatement_COLLECTION`, `OrgCashFlowStatement_EXPENSES`, `OrgCashFlowStatement_REMARKS`, `OrgCashFlowStatement_DATE_ADD`, `OrgCashFlowStatement_DATE_MOD`, `OrgCashFlowStatement_DISPLAY_STAT`) VALUES
(1, 'CIT2017', 'Remit #00001', 500.000, NULL, 'Received by: ', '2018-05-09 18:42:36', '2018-05-09 18:42:36', 'Active'),
(2, 'CIT2017', 'Vouch #00001', NULL, 200.000, 'Received by: Demelyn', '2018-05-09 19:30:58', '2018-05-09 19:30:58', 'Active'),
(3, 'CIT2017', 'Vouch #00002', NULL, 110.000, 'Received by: Demelyn', '2018-05-09 19:33:19', '2018-05-09 19:33:19', 'Active');

-- --------------------------------------------------------

--
-- Table structure for table `t_org_financial_statement`
--

DROP TABLE IF EXISTS `t_org_financial_statement`;
CREATE TABLE `t_org_financial_statement` (
  `OrgFinStatement_ID` int(11) NOT NULL,
  `OrgFinStatement_ORG_CODE` varchar(15) NOT NULL,
  `OrgFinStatement_SEMESTER` varchar(50) NOT NULL,
  `OrgFinStatement_DATE_ADD` datetime NOT NULL DEFAULT CURRENT_TIMESTAMP,
  `OrgFinStatement_DATE_MOD` datetime NOT NULL DEFAULT CURRENT_TIMESTAMP,
  `OrgFinStatement_DISPLAY_STAT` enum('Active','Inactive') DEFAULT 'Active'
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

-- --------------------------------------------------------

--
-- Table structure for table `t_org_financial_statement_items`
--

DROP TABLE IF EXISTS `t_org_financial_statement_items`;
CREATE TABLE `t_org_financial_statement_items` (
  `OrgFinStatExpenses_ID` int(11) NOT NULL,
  `OrgFinStatExpenses_OrgFinStatement_ID` int(11) NOT NULL,
  `OrgFinStatExpenses_ITEM` varchar(100) NOT NULL,
  `OrgFinStatExpenses_AMOUNT` double(10,3) NOT NULL DEFAULT '0.000',
  `OrgFinStatExpenses_DATE_ADD` datetime NOT NULL DEFAULT CURRENT_TIMESTAMP,
  `OrgFinStatExpenses_DATE_MOD` datetime NOT NULL DEFAULT CURRENT_TIMESTAMP,
  `OrgFinStatExpenses_DISPLAY_STAT` enum('Active','Inactive') DEFAULT 'Active'
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

-- --------------------------------------------------------

--
-- Table structure for table `t_org_for_compliance`
--

DROP TABLE IF EXISTS `t_org_for_compliance`;
CREATE TABLE `t_org_for_compliance` (
  `OrgForCompliance_ID` int(11) NOT NULL,
  `OrgForCompliance_ORG_CODE` varchar(15) NOT NULL,
  `OrgForCompliance_OrgApplProfile_APPL_CODE` varchar(15) NOT NULL,
  `OrgForCompliance_ADVISER` varchar(100) DEFAULT 'Organization Adviser should be here!',
  `OrgForCompliance_BATCH_YEAR` varchar(15) NOT NULL,
  `OrgForCompliance_DATE_ADD` datetime NOT NULL DEFAULT CURRENT_TIMESTAMP,
  `OrgForCompliance_DATE_MOD` datetime NOT NULL DEFAULT CURRENT_TIMESTAMP,
  `OrgForCompliance_DISPAY_STAT` enum('Active','Inactive') DEFAULT 'Active'
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `t_org_for_compliance`
--

INSERT INTO `t_org_for_compliance` (`OrgForCompliance_ID`, `OrgForCompliance_ORG_CODE`, `OrgForCompliance_OrgApplProfile_APPL_CODE`, `OrgForCompliance_ADVISER`, `OrgForCompliance_BATCH_YEAR`, `OrgForCompliance_DATE_ADD`, `OrgForCompliance_DATE_MOD`, `OrgForCompliance_DISPAY_STAT`) VALUES
(20, 'CIT2017', 'CIT2018', 'Alma Fernandez', '2017-2018', '2018-03-15 16:28:54', '2018-03-15 16:28:54', 'Active'),
(21, 'D2017', 'D2018', 'hjhkjh', '2017-2018', '2018-03-19 02:26:11', '2018-03-19 02:26:11', 'Active'),
(24, 'CIT2016', 'CIT2018', 'Adv CIT2016', '2016-2017', '2018-03-19 03:46:24', '2018-03-19 04:33:05', 'Active'),
(25, 'O2017', 'O2018', 'hjhkjh', '2017-2018', '2018-03-19 13:00:53', '2018-03-19 13:00:53', 'Active'),
(26, 'CIT2015', 'CIT2018', 'Organization Adviser should be here!', '2015-2016', '2018-03-19 14:06:06', '2018-03-19 14:06:06', 'Active'),
(27, 'ERICZZZ2017', 'ERICZZZ2017', 'er c', '2017-2018', '2018-04-29 18:01:54', '2018-04-29 18:01:54', 'Active'),
(28, 'QWE2017', 'QWE2017', 'asd', '2017-2018', '2018-04-29 18:14:02', '2018-04-29 18:14:02', 'Active'),
(29, 'EWQ2017', 'EWQ2017', 'q', '2017-2018', '2018-04-29 18:14:15', '2018-04-29 18:14:15', 'Active'),
(30, 'ASD2017', 'ASD2017', 'z', '2017-2018', '2018-04-29 18:14:25', '2018-04-29 18:14:25', 'Active'),
(31, 'DSA2017', 'DSA2017', 'z', '2017-2018', '2018-04-29 18:14:34', '2018-04-29 18:14:34', 'Active');

-- --------------------------------------------------------

--
-- Table structure for table `t_org_officers`
--

DROP TABLE IF EXISTS `t_org_officers`;
CREATE TABLE `t_org_officers` (
  `OrgOffi_ID` int(11) NOT NULL,
  `OrgOffi_OrgOffiPosDetails_ID` int(11) NOT NULL,
  `OrgOffi_STUD_NO` varchar(15) NOT NULL,
  `OrgOffi_DATE_ADD` datetime NOT NULL DEFAULT CURRENT_TIMESTAMP,
  `OrgOffi_DATE_MODIFIED` datetime NOT NULL DEFAULT CURRENT_TIMESTAMP,
  `OrgOffi_DISPLAY_STAT` enum('Active','Inactive') DEFAULT 'Active'
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `t_org_officers`
--

INSERT INTO `t_org_officers` (`OrgOffi_ID`, `OrgOffi_OrgOffiPosDetails_ID`, `OrgOffi_STUD_NO`, `OrgOffi_DATE_ADD`, `OrgOffi_DATE_MODIFIED`, `OrgOffi_DISPLAY_STAT`) VALUES
(2, 1, '2015-00073-CM-0', '2018-03-19 16:24:38', '2018-03-19 16:24:38', 'Active');

-- --------------------------------------------------------

--
-- Table structure for table `t_org_remittance`
--

DROP TABLE IF EXISTS `t_org_remittance`;
CREATE TABLE `t_org_remittance` (
  `OrgRemittance_ID` int(11) NOT NULL,
  `OrgRemittance_NUMBER` varchar(15) NOT NULL,
  `OrgRemittance_ORG_CODE` varchar(15) NOT NULL,
  `OrgRemittance_SEND_BY` varchar(100) NOT NULL,
  `OrgRemittance_REC_BY` varchar(100) NOT NULL,
  `OrgRemittance_AMOUNT` double(10,3) NOT NULL,
  `OrgRemittance_DESC` varchar(100) DEFAULT 'Remittance Description',
  `OrgRemittance_DATE_ADD` datetime NOT NULL DEFAULT CURRENT_TIMESTAMP,
  `OrgRemittance_DATE_MOD` datetime NOT NULL DEFAULT CURRENT_TIMESTAMP,
  `OrgRemittance_DISPLAY_STAT` enum('Active','Inactive') DEFAULT 'Active',
  `OrgRemittance_APPROVED_STATUS` enum('Pending','Rejected','Approved') NOT NULL DEFAULT 'Approved'
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `t_org_remittance`
--

INSERT INTO `t_org_remittance` (`OrgRemittance_ID`, `OrgRemittance_NUMBER`, `OrgRemittance_ORG_CODE`, `OrgRemittance_SEND_BY`, `OrgRemittance_REC_BY`, `OrgRemittance_AMOUNT`, `OrgRemittance_DESC`, `OrgRemittance_DATE_ADD`, `OrgRemittance_DATE_MOD`, `OrgRemittance_DISPLAY_STAT`, `OrgRemittance_APPROVED_STATUS`) VALUES
(1, 'Remit #00001', 'CIT2017', 'Patrick', '', 500.000, 'First Semester Fee', '2018-05-09 18:42:36', '2018-05-09 18:42:36', 'Active', 'Approved');

-- --------------------------------------------------------

--
-- Table structure for table `t_org_voucher`
--

DROP TABLE IF EXISTS `t_org_voucher`;
CREATE TABLE `t_org_voucher` (
  `OrgVoucher_ID` int(11) NOT NULL,
  `OrgVoucher_CASH_VOUCHER_NO` varchar(15) NOT NULL,
  `OrgVoucher_CHECKED_BY` varchar(100) NOT NULL,
  `OrgVoucher_ORG_CODE` varchar(15) NOT NULL,
  `OrgVoucher_DATE_ADD` datetime NOT NULL DEFAULT CURRENT_TIMESTAMP,
  `OrgVoucher_DATE_MOD` datetime NOT NULL DEFAULT CURRENT_TIMESTAMP,
  `OrgVoucher_DISPLAY_STAT` enum('Active','Inactive') DEFAULT 'Active'
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `t_org_voucher`
--

INSERT INTO `t_org_voucher` (`OrgVoucher_ID`, `OrgVoucher_CASH_VOUCHER_NO`, `OrgVoucher_CHECKED_BY`, `OrgVoucher_ORG_CODE`, `OrgVoucher_DATE_ADD`, `OrgVoucher_DATE_MOD`, `OrgVoucher_DISPLAY_STAT`) VALUES
(2, 'Vouch #00001', 'Patrick', 'CIT2017', '2018-05-09 19:30:58', '2018-05-09 19:30:58', 'Active'),
(3, 'Vouch #00002', '', 'CIT2017', '2018-05-09 19:33:19', '2018-05-09 19:33:19', 'Active');

-- --------------------------------------------------------

--
-- Table structure for table `t_org_voucher_items`
--

DROP TABLE IF EXISTS `t_org_voucher_items`;
CREATE TABLE `t_org_voucher_items` (
  `OrgVouchItems_ID` int(11) NOT NULL,
  `OrgVouchItems_VOUCHER_NO` varchar(15) NOT NULL,
  `OrgVouchItems_ITEM_NAME` varchar(100) NOT NULL,
  `OrgVouchItems_AMOUNT` double(10,3) NOT NULL DEFAULT '0.000',
  `OrgVouchItems_DATE_ADD` datetime NOT NULL DEFAULT CURRENT_TIMESTAMP,
  `OrgVouchItems_DATE_MOD` datetime NOT NULL DEFAULT CURRENT_TIMESTAMP,
  `OrgVouchItems_DISPLAY_STAT` enum('Active','Inactive') DEFAULT 'Active'
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `t_org_voucher_items`
--

INSERT INTO `t_org_voucher_items` (`OrgVouchItems_ID`, `OrgVouchItems_VOUCHER_NO`, `OrgVouchItems_ITEM_NAME`, `OrgVouchItems_AMOUNT`, `OrgVouchItems_DATE_ADD`, `OrgVouchItems_DATE_MOD`, `OrgVouchItems_DISPLAY_STAT`) VALUES
(7, 'Vouch #00001', 'Ballpen', 100.000, '2018-05-09 19:30:58', '2018-05-09 19:30:58', 'Active'),
(10, 'Vouch #00002', 'Ballpen', 10.000, '2018-05-09 19:33:20', '2018-05-09 19:33:20', 'Active'),
(9, 'Vouch #00002', 'Papel', 100.000, '2018-05-09 19:33:20', '2018-05-09 19:33:20', 'Active'),
(8, 'Vouch #00001', 'Paper', 100.000, '2018-05-09 19:30:58', '2018-05-09 19:30:58', 'Active');

-- --------------------------------------------------------

--
-- Table structure for table `t_qrval_student_clearance`
--

DROP TABLE IF EXISTS `t_qrval_student_clearance`;
CREATE TABLE `t_qrval_student_clearance` (
  `QRValStudClearance_ID` int(11) NOT NULL,
  `QRValStudClearance_STUD_NO` varchar(15) NOT NULL,
  `QRValStudClearance_BATCH` varchar(15) NOT NULL,
  `QRValStudClearance_SEMESTER` varchar(50) NOT NULL,
  `QRValStudClearance_QR_VALUE` varchar(1000) NOT NULL,
  `QRValStudClearance_DATE_ADD` datetime NOT NULL DEFAULT CURRENT_TIMESTAMP,
  `QRValStudClearance_DATE_MOD` datetime NOT NULL DEFAULT CURRENT_TIMESTAMP,
  `QRValStudClearance_DISPLAY_STAT` enum('Active','Inactive') DEFAULT 'Active'
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Indexes for dumped tables
--

--
-- Indexes for table `active_academic_year`
--
ALTER TABLE `active_academic_year`
  ADD PRIMARY KEY (`ActiveAcadYear_ID`),
  ADD KEY `FK_ActiveAcadYear_Batch_YEAR` (`ActiveAcadYear_Batch_YEAR`);

--
-- Indexes for table `active_semester`
--
ALTER TABLE `active_semester`
  ADD PRIMARY KEY (`ActiveSemester_ID`),
  ADD KEY `FK_ActiveSemester_SEMESTRAL_NAME` (`ActiveSemester_SEMESTRAL_NAME`);

--
-- Indexes for table `log_sanction`
--
ALTER TABLE `log_sanction`
  ADD PRIMARY KEY (`LogSanc_ID`),
  ADD KEY `FK_LogSanc_AssSancSudent_ID` (`LogSanc_AssSancSudent_ID`);

--
-- Indexes for table `notif_announcement`
--
ALTER TABLE `notif_announcement`
  ADD PRIMARY KEY (`Notif_ID`);

--
-- Indexes for table `r_application_wizard`
--
ALTER TABLE `r_application_wizard`
  ADD PRIMARY KEY (`WIZARD_ID`),
  ADD KEY `WIZARD_ORG_CODE` (`WIZARD_ORG_CODE`);

--
-- Indexes for table `r_archiving_documents`
--
ALTER TABLE `r_archiving_documents`
  ADD PRIMARY KEY (`ArchDocuments_ID`),
  ADD UNIQUE KEY `UNQ_ArchDocuments_ORDER_NO` (`ArchDocuments_ORDER_NO`);

--
-- Indexes for table `r_assign_case_to_case_sanction`
--
ALTER TABLE `r_assign_case_to_case_sanction`
  ADD PRIMARY KEY (`Case_ID`),
  ADD KEY `FK_Case_SancDetails_CODE` (`Case_SancDetails_CODE`);

--
-- Indexes for table `r_batch_details`
--
ALTER TABLE `r_batch_details`
  ADD PRIMARY KEY (`Batch_ID`),
  ADD UNIQUE KEY `UNQ_Batch_YEAR` (`Batch_YEAR`);

--
-- Indexes for table `r_clearance_signatories`
--
ALTER TABLE `r_clearance_signatories`
  ADD PRIMARY KEY (`ClearSignatories_ID`),
  ADD UNIQUE KEY `UNQ_SancDetails_CODE` (`ClearSignatories_CODE`);

--
-- Indexes for table `r_courses`
--
ALTER TABLE `r_courses`
  ADD PRIMARY KEY (`Course_ID`),
  ADD UNIQUE KEY `UNQ_Course_CODE` (`Course_CODE`),
  ADD KEY `FK_Course_CURR_YEAR` (`Course_CURR_YEAR`);

--
-- Indexes for table `r_designated_offices_details`
--
ALTER TABLE `r_designated_offices_details`
  ADD PRIMARY KEY (`DesOffDetails_ID`),
  ADD UNIQUE KEY `UNQ_DesOffDetails_CODE` (`DesOffDetails_CODE`);

--
-- Indexes for table `r_financial_assistance_title`
--
ALTER TABLE `r_financial_assistance_title`
  ADD PRIMARY KEY (`FinAssiTitle_ID`),
  ADD UNIQUE KEY `UNQ_FinAssiTitle_NAME` (`FinAssiTitle_NAME`);

--
-- Indexes for table `r_notification`
--
ALTER TABLE `r_notification`
  ADD PRIMARY KEY (`Notification_ID`);

--
-- Indexes for table `r_org_accreditation_details`
--
ALTER TABLE `r_org_accreditation_details`
  ADD PRIMARY KEY (`OrgAccrDetail_ID`),
  ADD UNIQUE KEY `UNQ_OrgAccrDetail_CODE` (`OrgAccrDetail_CODE`);

--
-- Indexes for table `r_org_applicant_profile`
--
ALTER TABLE `r_org_applicant_profile`
  ADD PRIMARY KEY (`OrgAppProfile_ID`),
  ADD UNIQUE KEY `UNQ_OrgAppProfile_ORG_CODE` (`OrgAppProfile_APPL_CODE`);

--
-- Indexes for table `r_org_category`
--
ALTER TABLE `r_org_category`
  ADD PRIMARY KEY (`OrgCat_ID`),
  ADD UNIQUE KEY `UNQ_OrgCat_NAME` (`OrgCat_CODE`);

--
-- Indexes for table `r_org_essentials`
--
ALTER TABLE `r_org_essentials`
  ADD PRIMARY KEY (`OrgEssentials_ID`),
  ADD KEY `FK_OrgEssentials_ORG_CODE` (`OrgEssentials_ORG_CODE`);

--
-- Indexes for table `r_org_event_management`
--
ALTER TABLE `r_org_event_management`
  ADD PRIMARY KEY (`OrgEvent_ID`),
  ADD UNIQUE KEY `UNQ_ORGEVENT_CODE` (`OrgEvent_Code`),
  ADD KEY `FK_ORGEVENT_ORGCODE` (`OrgEvent_OrgCode`);

--
-- Indexes for table `r_org_non_academic_details`
--
ALTER TABLE `r_org_non_academic_details`
  ADD PRIMARY KEY (`OrgNonAcad_ID`),
  ADD UNIQUE KEY `UNQ_OrgNonAcad_CODE` (`OrgNonAcad_CODE`),
  ADD UNIQUE KEY `UNQ_OrgNonAcad_NAME` (`OrgNonAcad_NAME`);

--
-- Indexes for table `r_org_officer_position_details`
--
ALTER TABLE `r_org_officer_position_details`
  ADD PRIMARY KEY (`OrgOffiPosDetails_ID`),
  ADD KEY `FK_OrgOffiPosDetails_ORG_CODE` (`OrgOffiPosDetails_ORG_CODE`);

--
-- Indexes for table `r_osas_head`
--
ALTER TABLE `r_osas_head`
  ADD PRIMARY KEY (`OSASHead_ID`),
  ADD UNIQUE KEY `UNQ_OSASHead_CODE` (`OSASHead_CODE`);

--
-- Indexes for table `r_sanction_details`
--
ALTER TABLE `r_sanction_details`
  ADD PRIMARY KEY (`SancDetails_ID`),
  ADD UNIQUE KEY `UNQ_SancDetails_CODE` (`SancDetails_CODE`);

--
-- Indexes for table `r_semester`
--
ALTER TABLE `r_semester`
  ADD PRIMARY KEY (`Semestral_ID`),
  ADD UNIQUE KEY `UNQ_Semstral_NAME` (`Semestral_NAME`);

--
-- Indexes for table `r_stud_profile`
--
ALTER TABLE `r_stud_profile`
  ADD PRIMARY KEY (`Stud_ID`),
  ADD UNIQUE KEY `PK_Stud_NO` (`Stud_NO`),
  ADD KEY `FK_COURSE` (`Stud_COURSE`);

--
-- Indexes for table `r_users`
--
ALTER TABLE `r_users`
  ADD PRIMARY KEY (`Users_ID`),
  ADD UNIQUE KEY `UNQ_Users_USERNAME` (`Users_USERNAME`);

--
-- Indexes for table `t_assign_org_academic_course`
--
ALTER TABLE `t_assign_org_academic_course`
  ADD PRIMARY KEY (`AssOrgAcademic_ORG_CODE`,`AssOrgAcademic_COURSE_CODE`),
  ADD UNIQUE KEY `UNQ_AssOrgAcademic_ID` (`AssOrgAcademic_ID`),
  ADD KEY `FK_AssOrgAcademic_COURSE_CODE` (`AssOrgAcademic_COURSE_CODE`);

--
-- Indexes for table `t_assign_org_category`
--
ALTER TABLE `t_assign_org_category`
  ADD PRIMARY KEY (`AssOrgCategory_ORG_CODE`,`AssOrgCategory_ORGCAT_CODE`),
  ADD UNIQUE KEY `UNQ_AssOrgCategory_ID` (`AssOrgCategory_ID`),
  ADD KEY `FK_AssOrgCategory_ORGCAT_CODE` (`AssOrgCategory_ORGCAT_CODE`);

--
-- Indexes for table `t_assign_org_members`
--
ALTER TABLE `t_assign_org_members`
  ADD PRIMARY KEY (`AssOrgMem_STUD_NO`,`AssOrgMem_COMPL_ORG_CODE`),
  ADD UNIQUE KEY `UNQ_AssOrgMem_ID` (`AssOrgMem_ID`),
  ADD KEY `FK_AssOrgMem_COMPL_ORG_CODE` (`AssOrgMem_COMPL_ORG_CODE`);

--
-- Indexes for table `t_assign_org_non_academic`
--
ALTER TABLE `t_assign_org_non_academic`
  ADD PRIMARY KEY (`AssOrgNonAcademic_ORG_CODE`),
  ADD UNIQUE KEY `UNQ_AssOrgNonAcademic_ID` (`AssOrgNonAcademic_ID`),
  ADD KEY `FK_AssOrgNonAcademic_NON_ACAD` (`AssOrgNonAcademic_NON_ACAD`);

--
-- Indexes for table `t_assign_org_sanction`
--
ALTER TABLE `t_assign_org_sanction`
  ADD PRIMARY KEY (`AssSancOrgStudent_ID`),
  ADD KEY `FK_AssSancOrgStudent_STUD_NO` (`AssSancOrgStudent_REG_ORG`),
  ADD KEY `FK_AssSancOrgStudent_SancDetails_CODE` (`AssSancOrgStudent_SancDetails_CODE`);

--
-- Indexes for table `t_assign_student_clearance`
--
ALTER TABLE `t_assign_student_clearance`
  ADD PRIMARY KEY (`AssStudClearance_STUD_NO`,`AssStudClearance_BATCH`,`AssStudClearance_SEMESTER`,`AssStudClearance_SIGNATORIES_CODE`),
  ADD UNIQUE KEY `UNQ_AssStudClearance_ID` (`AssStudClearance_ID`),
  ADD KEY `FK_AssStudClearance_SEMESTER` (`AssStudClearance_SEMESTER`),
  ADD KEY `FK_AssStudClearance_SIGNATORIES_CODE` (`AssStudClearance_SIGNATORIES_CODE`),
  ADD KEY `FK_AssStudClearance_BATCH` (`AssStudClearance_BATCH`);

--
-- Indexes for table `t_assign_stud_finan_assistance`
--
ALTER TABLE `t_assign_stud_finan_assistance`
  ADD PRIMARY KEY (`AssStudFinanAssistance_STUD_NO`,`AssStudFinanAssistance_FINAN_NAME`) USING BTREE,
  ADD UNIQUE KEY `UNQ_AssStudFinanAssistance_ID` (`AssStudFinanAssistance_ID`),
  ADD KEY `FK_AssStudFinanAssistance_FINAN_NAME` (`AssStudFinanAssistance_FINAN_NAME`);

--
-- Indexes for table `t_assign_stud_loss_id_regicard`
--
ALTER TABLE `t_assign_stud_loss_id_regicard`
  ADD PRIMARY KEY (`AssLoss_ID`),
  ADD KEY `FK_AssLoss_STUD_NO` (`AssLoss_STUD_NO`);

--
-- Indexes for table `t_assign_stud_saction`
--
ALTER TABLE `t_assign_stud_saction`
  ADD PRIMARY KEY (`AssSancStudStudent_ID`),
  ADD KEY `FK_AssSancStudStudent_STUD_NO` (`AssSancStudStudent_STUD_NO`),
  ADD KEY `FK_AssSancStudStudent_DesOffDetails_CODE` (`AssSancStudStudent_DesOffDetails_CODE`),
  ADD KEY `FK_AssSancStudStudent_SancDetails_CODE` (`AssSancStudStudent_SancDetails_CODE`);

--
-- Indexes for table `t_org_accreditation_process`
--
ALTER TABLE `t_org_accreditation_process`
  ADD PRIMARY KEY (`OrgAccrProcess_ORG_CODE`,`OrgAccrProcess_OrgAccrDetail_CODE`),
  ADD UNIQUE KEY `UNQ_OrgAccrProcess_ID` (`OrgAccrProcess_ID`),
  ADD KEY `FK_OrgAccrProcess_OrgAccrDetail_CODE` (`OrgAccrProcess_OrgAccrDetail_CODE`);

--
-- Indexes for table `t_org_cash_flow_statement`
--
ALTER TABLE `t_org_cash_flow_statement`
  ADD PRIMARY KEY (`OrgCashFlowStatement_ID`),
  ADD KEY `FK_OrgCashFlowStatement_ORG_CODE` (`OrgCashFlowStatement_ORG_CODE`);

--
-- Indexes for table `t_org_financial_statement`
--
ALTER TABLE `t_org_financial_statement`
  ADD PRIMARY KEY (`OrgFinStatement_ID`),
  ADD KEY `FK_OrgFinStatement_ORG_CODE` (`OrgFinStatement_ORG_CODE`),
  ADD KEY `FK_OrgFinStatement_SEMESTER` (`OrgFinStatement_SEMESTER`);

--
-- Indexes for table `t_org_financial_statement_items`
--
ALTER TABLE `t_org_financial_statement_items`
  ADD PRIMARY KEY (`OrgFinStatExpenses_ID`),
  ADD KEY `FK_OrgFinStatExpenses_OrgFinStatement_ID` (`OrgFinStatExpenses_OrgFinStatement_ID`);

--
-- Indexes for table `t_org_for_compliance`
--
ALTER TABLE `t_org_for_compliance`
  ADD PRIMARY KEY (`OrgForCompliance_ID`),
  ADD UNIQUE KEY `UNQ_OrgForCompliance_CODE` (`OrgForCompliance_ORG_CODE`),
  ADD UNIQUE KEY `UNQ_OrgForCompliance_ORG_CODE` (`OrgForCompliance_ORG_CODE`),
  ADD KEY `FK_OrgForCompliance_CODE` (`OrgForCompliance_OrgApplProfile_APPL_CODE`),
  ADD KEY `FK_OR_ORG_FOUNDED_BATCH_YEAR` (`OrgForCompliance_BATCH_YEAR`);

--
-- Indexes for table `t_org_officers`
--
ALTER TABLE `t_org_officers`
  ADD PRIMARY KEY (`OrgOffi_STUD_NO`,`OrgOffi_OrgOffiPosDetails_ID`),
  ADD UNIQUE KEY `UNQ_OrgOffi_ID` (`OrgOffi_ID`),
  ADD KEY `FK_OrgOffi_OrgOffiPosDetails_ID` (`OrgOffi_OrgOffiPosDetails_ID`);

--
-- Indexes for table `t_org_remittance`
--
ALTER TABLE `t_org_remittance`
  ADD PRIMARY KEY (`OrgRemittance_ID`),
  ADD KEY `FK_OrgRemittance_ORG_CODE` (`OrgRemittance_ORG_CODE`);

--
-- Indexes for table `t_org_voucher`
--
ALTER TABLE `t_org_voucher`
  ADD PRIMARY KEY (`OrgVoucher_ID`),
  ADD UNIQUE KEY `UNQ_OrgVoucher_CASH_VOUCHER_NO` (`OrgVoucher_CASH_VOUCHER_NO`),
  ADD KEY `FK_OrgVoucher_ORG_CODE` (`OrgVoucher_ORG_CODE`);

--
-- Indexes for table `t_org_voucher_items`
--
ALTER TABLE `t_org_voucher_items`
  ADD PRIMARY KEY (`OrgVouchItems_ITEM_NAME`,`OrgVouchItems_VOUCHER_NO`),
  ADD UNIQUE KEY `UNQ_OrgVouchItems_ID` (`OrgVouchItems_ID`),
  ADD KEY `FK_OrgVouchItems_VOUCHER_NO` (`OrgVouchItems_VOUCHER_NO`);

--
-- Indexes for table `t_qrval_student_clearance`
--
ALTER TABLE `t_qrval_student_clearance`
  ADD PRIMARY KEY (`QRValStudClearance_STUD_NO`,`QRValStudClearance_BATCH`,`QRValStudClearance_SEMESTER`),
  ADD UNIQUE KEY `UNQ_QRValStudClearance_ID` (`QRValStudClearance_ID`),
  ADD KEY `FK_QRValStudClearance_BATCH` (`QRValStudClearance_BATCH`),
  ADD KEY `FK_QRValStudClearance_SEMESTER` (`QRValStudClearance_SEMESTER`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `active_academic_year`
--
ALTER TABLE `active_academic_year`
  MODIFY `ActiveAcadYear_ID` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2;
--
-- AUTO_INCREMENT for table `active_semester`
--
ALTER TABLE `active_semester`
  MODIFY `ActiveSemester_ID` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2;
--
-- AUTO_INCREMENT for table `log_sanction`
--
ALTER TABLE `log_sanction`
  MODIFY `LogSanc_ID` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=7;
--
-- AUTO_INCREMENT for table `notif_announcement`
--
ALTER TABLE `notif_announcement`
  MODIFY `Notif_ID` int(11) NOT NULL AUTO_INCREMENT;
--
-- AUTO_INCREMENT for table `r_application_wizard`
--
ALTER TABLE `r_application_wizard`
  MODIFY `WIZARD_ID` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=36;
--
-- AUTO_INCREMENT for table `r_archiving_documents`
--
ALTER TABLE `r_archiving_documents`
  MODIFY `ArchDocuments_ID` int(11) NOT NULL AUTO_INCREMENT;
--
-- AUTO_INCREMENT for table `r_assign_case_to_case_sanction`
--
ALTER TABLE `r_assign_case_to_case_sanction`
  MODIFY `Case_ID` int(11) NOT NULL AUTO_INCREMENT;
--
-- AUTO_INCREMENT for table `r_batch_details`
--
ALTER TABLE `r_batch_details`
  MODIFY `Batch_ID` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=8;
--
-- AUTO_INCREMENT for table `r_clearance_signatories`
--
ALTER TABLE `r_clearance_signatories`
  MODIFY `ClearSignatories_ID` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=10;
--
-- AUTO_INCREMENT for table `r_courses`
--
ALTER TABLE `r_courses`
  MODIFY `Course_ID` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=5;
--
-- AUTO_INCREMENT for table `r_designated_offices_details`
--
ALTER TABLE `r_designated_offices_details`
  MODIFY `DesOffDetails_ID` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=7;
--
-- AUTO_INCREMENT for table `r_financial_assistance_title`
--
ALTER TABLE `r_financial_assistance_title`
  MODIFY `FinAssiTitle_ID` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=12;
--
-- AUTO_INCREMENT for table `r_notification`
--
ALTER TABLE `r_notification`
  MODIFY `Notification_ID` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=28;
--
-- AUTO_INCREMENT for table `r_org_accreditation_details`
--
ALTER TABLE `r_org_accreditation_details`
  MODIFY `OrgAccrDetail_ID` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=5;
--
-- AUTO_INCREMENT for table `r_org_applicant_profile`
--
ALTER TABLE `r_org_applicant_profile`
  MODIFY `OrgAppProfile_ID` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=14;
--
-- AUTO_INCREMENT for table `r_org_category`
--
ALTER TABLE `r_org_category`
  MODIFY `OrgCat_ID` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=4;
--
-- AUTO_INCREMENT for table `r_org_essentials`
--
ALTER TABLE `r_org_essentials`
  MODIFY `OrgEssentials_ID` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=22;
--
-- AUTO_INCREMENT for table `r_org_event_management`
--
ALTER TABLE `r_org_event_management`
  MODIFY `OrgEvent_ID` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=3;
--
-- AUTO_INCREMENT for table `r_org_non_academic_details`
--
ALTER TABLE `r_org_non_academic_details`
  MODIFY `OrgNonAcad_ID` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2;
--
-- AUTO_INCREMENT for table `r_org_officer_position_details`
--
ALTER TABLE `r_org_officer_position_details`
  MODIFY `OrgOffiPosDetails_ID` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=27;
--
-- AUTO_INCREMENT for table `r_osas_head`
--
ALTER TABLE `r_osas_head`
  MODIFY `OSASHead_ID` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2;
--
-- AUTO_INCREMENT for table `r_sanction_details`
--
ALTER TABLE `r_sanction_details`
  MODIFY `SancDetails_ID` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=16;
--
-- AUTO_INCREMENT for table `r_semester`
--
ALTER TABLE `r_semester`
  MODIFY `Semestral_ID` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=7;
--
-- AUTO_INCREMENT for table `r_stud_profile`
--
ALTER TABLE `r_stud_profile`
  MODIFY `Stud_ID` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=49;
--
-- AUTO_INCREMENT for table `r_users`
--
ALTER TABLE `r_users`
  MODIFY `Users_ID` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=12;
--
-- AUTO_INCREMENT for table `t_assign_org_academic_course`
--
ALTER TABLE `t_assign_org_academic_course`
  MODIFY `AssOrgAcademic_ID` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=34;
--
-- AUTO_INCREMENT for table `t_assign_org_category`
--
ALTER TABLE `t_assign_org_category`
  MODIFY `AssOrgCategory_ID` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=29;
--
-- AUTO_INCREMENT for table `t_assign_org_members`
--
ALTER TABLE `t_assign_org_members`
  MODIFY `AssOrgMem_ID` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=43;
--
-- AUTO_INCREMENT for table `t_assign_org_non_academic`
--
ALTER TABLE `t_assign_org_non_academic`
  MODIFY `AssOrgNonAcademic_ID` int(11) NOT NULL AUTO_INCREMENT;
--
-- AUTO_INCREMENT for table `t_assign_org_sanction`
--
ALTER TABLE `t_assign_org_sanction`
  MODIFY `AssSancOrgStudent_ID` int(11) NOT NULL AUTO_INCREMENT;
--
-- AUTO_INCREMENT for table `t_assign_student_clearance`
--
ALTER TABLE `t_assign_student_clearance`
  MODIFY `AssStudClearance_ID` int(11) NOT NULL AUTO_INCREMENT;
--
-- AUTO_INCREMENT for table `t_assign_stud_finan_assistance`
--
ALTER TABLE `t_assign_stud_finan_assistance`
  MODIFY `AssStudFinanAssistance_ID` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=94;
--
-- AUTO_INCREMENT for table `t_assign_stud_loss_id_regicard`
--
ALTER TABLE `t_assign_stud_loss_id_regicard`
  MODIFY `AssLoss_ID` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=21;
--
-- AUTO_INCREMENT for table `t_assign_stud_saction`
--
ALTER TABLE `t_assign_stud_saction`
  MODIFY `AssSancStudStudent_ID` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2;
--
-- AUTO_INCREMENT for table `t_org_accreditation_process`
--
ALTER TABLE `t_org_accreditation_process`
  MODIFY `OrgAccrProcess_ID` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=40;
--
-- AUTO_INCREMENT for table `t_org_cash_flow_statement`
--
ALTER TABLE `t_org_cash_flow_statement`
  MODIFY `OrgCashFlowStatement_ID` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=4;
--
-- AUTO_INCREMENT for table `t_org_financial_statement`
--
ALTER TABLE `t_org_financial_statement`
  MODIFY `OrgFinStatement_ID` int(11) NOT NULL AUTO_INCREMENT;
--
-- AUTO_INCREMENT for table `t_org_financial_statement_items`
--
ALTER TABLE `t_org_financial_statement_items`
  MODIFY `OrgFinStatExpenses_ID` int(11) NOT NULL AUTO_INCREMENT;
--
-- AUTO_INCREMENT for table `t_org_for_compliance`
--
ALTER TABLE `t_org_for_compliance`
  MODIFY `OrgForCompliance_ID` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=32;
--
-- AUTO_INCREMENT for table `t_org_officers`
--
ALTER TABLE `t_org_officers`
  MODIFY `OrgOffi_ID` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=3;
--
-- AUTO_INCREMENT for table `t_org_remittance`
--
ALTER TABLE `t_org_remittance`
  MODIFY `OrgRemittance_ID` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2;
--
-- AUTO_INCREMENT for table `t_org_voucher`
--
ALTER TABLE `t_org_voucher`
  MODIFY `OrgVoucher_ID` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=4;
--
-- AUTO_INCREMENT for table `t_org_voucher_items`
--
ALTER TABLE `t_org_voucher_items`
  MODIFY `OrgVouchItems_ID` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=11;
--
-- AUTO_INCREMENT for table `t_qrval_student_clearance`
--
ALTER TABLE `t_qrval_student_clearance`
  MODIFY `QRValStudClearance_ID` int(11) NOT NULL AUTO_INCREMENT;
--
-- Constraints for dumped tables
--

--
-- Constraints for table `active_academic_year`
--
ALTER TABLE `active_academic_year`
  ADD CONSTRAINT `FK_ActiveAcadYear_Batch_YEAR` FOREIGN KEY (`ActiveAcadYear_Batch_YEAR`) REFERENCES `r_batch_details` (`Batch_YEAR`) ON DELETE NO ACTION ON UPDATE CASCADE;

--
-- Constraints for table `active_semester`
--
ALTER TABLE `active_semester`
  ADD CONSTRAINT `FK_ActiveSemester_SEMESTRAL_NAME` FOREIGN KEY (`ActiveSemester_SEMESTRAL_NAME`) REFERENCES `r_semester` (`Semestral_NAME`) ON DELETE NO ACTION ON UPDATE CASCADE;

--
-- Constraints for table `log_sanction`
--
ALTER TABLE `log_sanction`
  ADD CONSTRAINT `FK_LogSanc_AssSancSudent_ID` FOREIGN KEY (`LogSanc_AssSancSudent_ID`) REFERENCES `t_assign_stud_saction` (`AssSancStudStudent_ID`) ON DELETE NO ACTION ON UPDATE CASCADE;

--
-- Constraints for table `r_application_wizard`
--
ALTER TABLE `r_application_wizard`
  ADD CONSTRAINT `r_application_wizard_ibfk_1` FOREIGN KEY (`WIZARD_ORG_CODE`) REFERENCES `t_org_for_compliance` (`OrgForCompliance_ORG_CODE`);

--
-- Constraints for table `r_assign_case_to_case_sanction`
--
ALTER TABLE `r_assign_case_to_case_sanction`
  ADD CONSTRAINT `FK_Case_SancDetails_CODE` FOREIGN KEY (`Case_SancDetails_CODE`) REFERENCES `r_sanction_details` (`SancDetails_CODE`) ON DELETE CASCADE ON UPDATE CASCADE;

--
-- Constraints for table `r_courses`
--
ALTER TABLE `r_courses`
  ADD CONSTRAINT `FK_Course_CURR_YEAR` FOREIGN KEY (`Course_CURR_YEAR`) REFERENCES `r_batch_details` (`Batch_YEAR`) ON DELETE CASCADE ON UPDATE CASCADE;

--
-- Constraints for table `r_org_essentials`
--
ALTER TABLE `r_org_essentials`
  ADD CONSTRAINT `FK_OrgEssentials_ORG_CODE` FOREIGN KEY (`OrgEssentials_ORG_CODE`) REFERENCES `t_org_for_compliance` (`OrgForCompliance_ORG_CODE`) ON DELETE CASCADE ON UPDATE CASCADE;

--
-- Constraints for table `r_org_event_management`
--
ALTER TABLE `r_org_event_management`
  ADD CONSTRAINT `FK_ORGEVENT_ORGCODE` FOREIGN KEY (`OrgEvent_OrgCode`) REFERENCES `t_org_for_compliance` (`OrgForCompliance_ORG_CODE`);

--
-- Constraints for table `r_org_officer_position_details`
--
ALTER TABLE `r_org_officer_position_details`
  ADD CONSTRAINT `FK_OrgOffiPosDetails_ORG_CODE` FOREIGN KEY (`OrgOffiPosDetails_ORG_CODE`) REFERENCES `t_org_for_compliance` (`OrgForCompliance_ORG_CODE`) ON DELETE CASCADE ON UPDATE CASCADE;

--
-- Constraints for table `r_stud_profile`
--
ALTER TABLE `r_stud_profile`
  ADD CONSTRAINT `FK_COURSE` FOREIGN KEY (`Stud_COURSE`) REFERENCES `r_courses` (`Course_CODE`) ON DELETE CASCADE ON UPDATE CASCADE;

--
-- Constraints for table `t_assign_org_academic_course`
--
ALTER TABLE `t_assign_org_academic_course`
  ADD CONSTRAINT `FK_AssOrgAcademic_COURSE_CODE` FOREIGN KEY (`AssOrgAcademic_COURSE_CODE`) REFERENCES `r_courses` (`Course_CODE`) ON DELETE CASCADE ON UPDATE CASCADE,
  ADD CONSTRAINT `FK_AssOrgAcademic_ORG_CODE` FOREIGN KEY (`AssOrgAcademic_ORG_CODE`) REFERENCES `t_org_for_compliance` (`OrgForCompliance_ORG_CODE`) ON DELETE CASCADE ON UPDATE CASCADE;

--
-- Constraints for table `t_assign_org_category`
--
ALTER TABLE `t_assign_org_category`
  ADD CONSTRAINT `FK_AssOrgCategory_ORGCAT_CODE` FOREIGN KEY (`AssOrgCategory_ORGCAT_CODE`) REFERENCES `r_org_category` (`OrgCat_CODE`) ON DELETE CASCADE ON UPDATE CASCADE,
  ADD CONSTRAINT `FK_AssOrgCategory_ORG_CODE` FOREIGN KEY (`AssOrgCategory_ORG_CODE`) REFERENCES `t_org_for_compliance` (`OrgForCompliance_ORG_CODE`) ON DELETE CASCADE ON UPDATE CASCADE;

--
-- Constraints for table `t_assign_org_members`
--
ALTER TABLE `t_assign_org_members`
  ADD CONSTRAINT `FK_AssOrgMem_COMPL_ORG_CODE` FOREIGN KEY (`AssOrgMem_COMPL_ORG_CODE`) REFERENCES `t_org_for_compliance` (`OrgForCompliance_ORG_CODE`) ON DELETE CASCADE ON UPDATE CASCADE,
  ADD CONSTRAINT `FK_AssOrgMem_STUD_NO` FOREIGN KEY (`AssOrgMem_STUD_NO`) REFERENCES `r_stud_profile` (`Stud_NO`) ON DELETE CASCADE ON UPDATE CASCADE;

--
-- Constraints for table `t_assign_org_non_academic`
--
ALTER TABLE `t_assign_org_non_academic`
  ADD CONSTRAINT `FK_AssOrgNonAcademic_NON_ACAD` FOREIGN KEY (`AssOrgNonAcademic_NON_ACAD`) REFERENCES `r_org_non_academic_details` (`OrgNonAcad_CODE`) ON DELETE CASCADE ON UPDATE CASCADE,
  ADD CONSTRAINT `FK_AssOrgNonAcademic_ORG_CODE` FOREIGN KEY (`AssOrgNonAcademic_ORG_CODE`) REFERENCES `t_org_for_compliance` (`OrgForCompliance_ORG_CODE`) ON DELETE CASCADE ON UPDATE CASCADE;

--
-- Constraints for table `t_assign_org_sanction`
--
ALTER TABLE `t_assign_org_sanction`
  ADD CONSTRAINT `FK_AssSancOrgStudent_STUD_NO` FOREIGN KEY (`AssSancOrgStudent_REG_ORG`) REFERENCES `t_org_for_compliance` (`OrgForCompliance_ORG_CODE`) ON DELETE CASCADE ON UPDATE CASCADE,
  ADD CONSTRAINT `FK_AssSancOrgStudent_SancDetails_CODE` FOREIGN KEY (`AssSancOrgStudent_SancDetails_CODE`) REFERENCES `r_sanction_details` (`SancDetails_CODE`) ON DELETE CASCADE ON UPDATE CASCADE;

--
-- Constraints for table `t_assign_student_clearance`
--
ALTER TABLE `t_assign_student_clearance`
  ADD CONSTRAINT `FK_AssStudClearance_BATCH` FOREIGN KEY (`AssStudClearance_BATCH`) REFERENCES `r_batch_details` (`Batch_YEAR`),
  ADD CONSTRAINT `FK_AssStudClearance_SEMESTER` FOREIGN KEY (`AssStudClearance_SEMESTER`) REFERENCES `r_semester` (`Semestral_NAME`) ON DELETE CASCADE ON UPDATE CASCADE,
  ADD CONSTRAINT `FK_AssStudClearance_SIGNATORIES_CODE` FOREIGN KEY (`AssStudClearance_SIGNATORIES_CODE`) REFERENCES `r_clearance_signatories` (`ClearSignatories_CODE`) ON DELETE CASCADE ON UPDATE CASCADE,
  ADD CONSTRAINT `FK_AssStudClearance_STUD_NO` FOREIGN KEY (`AssStudClearance_STUD_NO`) REFERENCES `r_stud_profile` (`Stud_NO`) ON DELETE CASCADE ON UPDATE CASCADE;

--
-- Constraints for table `t_assign_stud_finan_assistance`
--
ALTER TABLE `t_assign_stud_finan_assistance`
  ADD CONSTRAINT `FK_AssStudFinanAssistance_FINAN_NAME` FOREIGN KEY (`AssStudFinanAssistance_FINAN_NAME`) REFERENCES `r_financial_assistance_title` (`FinAssiTitle_NAME`) ON DELETE CASCADE ON UPDATE CASCADE,
  ADD CONSTRAINT `FK_AssStudFinanAssistance_STUD_NO` FOREIGN KEY (`AssStudFinanAssistance_STUD_NO`) REFERENCES `r_stud_profile` (`Stud_NO`) ON DELETE CASCADE ON UPDATE CASCADE;

--
-- Constraints for table `t_assign_stud_loss_id_regicard`
--
ALTER TABLE `t_assign_stud_loss_id_regicard`
  ADD CONSTRAINT `FK_AssLoss_STUD_NO` FOREIGN KEY (`AssLoss_STUD_NO`) REFERENCES `r_stud_profile` (`Stud_NO`) ON DELETE CASCADE ON UPDATE CASCADE;

--
-- Constraints for table `t_assign_stud_saction`
--
ALTER TABLE `t_assign_stud_saction`
  ADD CONSTRAINT `FK_AssSancStudStudent_DesOffDetails_CODE` FOREIGN KEY (`AssSancStudStudent_DesOffDetails_CODE`) REFERENCES `r_designated_offices_details` (`DesOffDetails_CODE`) ON DELETE CASCADE ON UPDATE CASCADE,
  ADD CONSTRAINT `FK_AssSancStudStudent_STUD_NO` FOREIGN KEY (`AssSancStudStudent_STUD_NO`) REFERENCES `r_stud_profile` (`Stud_NO`) ON DELETE CASCADE ON UPDATE CASCADE,
  ADD CONSTRAINT `FK_AssSancStudStudent_SancDetails_CODE` FOREIGN KEY (`AssSancStudStudent_SancDetails_CODE`) REFERENCES `r_sanction_details` (`SancDetails_CODE`) ON DELETE CASCADE ON UPDATE CASCADE;

--
-- Constraints for table `t_org_accreditation_process`
--
ALTER TABLE `t_org_accreditation_process`
  ADD CONSTRAINT `FK_OrgAccrProcess_ORG_CODE` FOREIGN KEY (`OrgAccrProcess_ORG_CODE`) REFERENCES `t_org_for_compliance` (`OrgForCompliance_ORG_CODE`) ON DELETE CASCADE ON UPDATE CASCADE,
  ADD CONSTRAINT `FK_OrgAccrProcess_OrgAccrDetail_CODE` FOREIGN KEY (`OrgAccrProcess_OrgAccrDetail_CODE`) REFERENCES `r_org_accreditation_details` (`OrgAccrDetail_CODE`) ON DELETE CASCADE ON UPDATE CASCADE;

--
-- Constraints for table `t_org_cash_flow_statement`
--
ALTER TABLE `t_org_cash_flow_statement`
  ADD CONSTRAINT `FK_OrgCashFlowStatement_ORG_CODE` FOREIGN KEY (`OrgCashFlowStatement_ORG_CODE`) REFERENCES `t_org_for_compliance` (`OrgForCompliance_ORG_CODE`) ON DELETE CASCADE ON UPDATE CASCADE;

--
-- Constraints for table `t_org_financial_statement`
--
ALTER TABLE `t_org_financial_statement`
  ADD CONSTRAINT `FK_OrgFinStatement_ORG_CODE` FOREIGN KEY (`OrgFinStatement_ORG_CODE`) REFERENCES `t_org_for_compliance` (`OrgForCompliance_ORG_CODE`) ON DELETE CASCADE ON UPDATE CASCADE,
  ADD CONSTRAINT `FK_OrgFinStatement_SEMESTER` FOREIGN KEY (`OrgFinStatement_SEMESTER`) REFERENCES `r_semester` (`Semestral_NAME`) ON DELETE CASCADE ON UPDATE CASCADE;

--
-- Constraints for table `t_org_financial_statement_items`
--
ALTER TABLE `t_org_financial_statement_items`
  ADD CONSTRAINT `FK_OrgFinStatExpenses_OrgFinStatement_ID` FOREIGN KEY (`OrgFinStatExpenses_OrgFinStatement_ID`) REFERENCES `t_org_financial_statement` (`OrgFinStatement_ID`) ON DELETE CASCADE ON UPDATE CASCADE;

--
-- Constraints for table `t_org_for_compliance`
--
ALTER TABLE `t_org_for_compliance`
  ADD CONSTRAINT `FK_OR_ORG_FOUNDED_BATCH_YEAR` FOREIGN KEY (`OrgForCompliance_BATCH_YEAR`) REFERENCES `r_batch_details` (`Batch_YEAR`) ON DELETE CASCADE ON UPDATE CASCADE,
  ADD CONSTRAINT `FK_OrgForCompliance_CODE` FOREIGN KEY (`OrgForCompliance_OrgApplProfile_APPL_CODE`) REFERENCES `r_org_applicant_profile` (`OrgAppProfile_APPL_CODE`) ON DELETE CASCADE ON UPDATE CASCADE;

--
-- Constraints for table `t_org_officers`
--
ALTER TABLE `t_org_officers`
  ADD CONSTRAINT `FK_OrgOffi_OrgOffiPosDetails_ID` FOREIGN KEY (`OrgOffi_OrgOffiPosDetails_ID`) REFERENCES `r_org_officer_position_details` (`OrgOffiPosDetails_ID`) ON DELETE CASCADE ON UPDATE CASCADE,
  ADD CONSTRAINT `FK_OrgOffi_STUD_NO` FOREIGN KEY (`OrgOffi_STUD_NO`) REFERENCES `r_stud_profile` (`Stud_NO`) ON DELETE CASCADE ON UPDATE CASCADE;

--
-- Constraints for table `t_org_remittance`
--
ALTER TABLE `t_org_remittance`
  ADD CONSTRAINT `FK_OrgRemittance_ORG_CODE` FOREIGN KEY (`OrgRemittance_ORG_CODE`) REFERENCES `t_org_for_compliance` (`OrgForCompliance_ORG_CODE`) ON DELETE CASCADE ON UPDATE CASCADE;

--
-- Constraints for table `t_org_voucher`
--
ALTER TABLE `t_org_voucher`
  ADD CONSTRAINT `FK_OrgVoucher_ORG_CODE` FOREIGN KEY (`OrgVoucher_ORG_CODE`) REFERENCES `t_org_for_compliance` (`OrgForCompliance_ORG_CODE`) ON DELETE CASCADE ON UPDATE CASCADE;

--
-- Constraints for table `t_org_voucher_items`
--
ALTER TABLE `t_org_voucher_items`
  ADD CONSTRAINT `FK_OrgVouchItems_VOUCHER_NO` FOREIGN KEY (`OrgVouchItems_VOUCHER_NO`) REFERENCES `t_org_voucher` (`OrgVoucher_CASH_VOUCHER_NO`) ON DELETE CASCADE ON UPDATE CASCADE;

--
-- Constraints for table `t_qrval_student_clearance`
--
ALTER TABLE `t_qrval_student_clearance`
  ADD CONSTRAINT `FK_QRValStudClearance_BATCH` FOREIGN KEY (`QRValStudClearance_BATCH`) REFERENCES `r_batch_details` (`Batch_YEAR`) ON DELETE CASCADE ON UPDATE CASCADE,
  ADD CONSTRAINT `FK_QRValStudClearance_SEMESTER` FOREIGN KEY (`QRValStudClearance_SEMESTER`) REFERENCES `r_semester` (`Semestral_NAME`) ON DELETE CASCADE ON UPDATE CASCADE,
  ADD CONSTRAINT `FK_QRValStudClearance_STUD_NO` FOREIGN KEY (`QRValStudClearance_STUD_NO`) REFERENCES `r_stud_profile` (`Stud_NO`) ON DELETE CASCADE ON UPDATE CASCADE;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
