-- phpMyAdmin SQL Dump
-- version 4.5.1
-- http://www.phpmyadmin.net
--
-- Host: 127.0.0.1
-- Generation Time: May 27, 2018 at 07:19 AM
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
CREATE DEFINER="root"@"localhost" PROCEDURE "Active_AssignConfilicts_SemClearance" (IN `id` INT)  NO SQL
UPDATE `t_assign_student_clearance` SET 
`AssStudClearance_DATE_MOD`=CURRENT_TIMESTAMP
,`AssStudClearance_DISPLAY_STAT`='Active' 
WHERE `AssStudClearance_ID` =id$$

DROP PROCEDURE IF EXISTS `Archive_AssignConfilicts_SemClearance`$$
CREATE DEFINER="root"@"localhost" PROCEDURE "Archive_AssignConfilicts_SemClearance" (IN `id` INT)  NO SQL
UPDATE `t_assign_student_clearance` SET 
`AssStudClearance_DATE_MOD`=CURRENT_TIMESTAMP
,`AssStudClearance_DISPLAY_STAT`='Inactive' 
WHERE `AssStudClearance_ID` =id$$

DROP PROCEDURE IF EXISTS `Archive_AssignSanction`$$
CREATE DEFINER="root"@"localhost" PROCEDURE "Archive_AssignSanction" (IN `ID` INT)  NO SQL
UPDATE `t_assign_stud_saction` SET `AssSancStudStudent_DISPLAY_STAT`='Inactive' 
,`AssSancStudStudent_DATE_MOD` = CURRENT_TIMESTAMP
WHERE
`AssSancStudStudent_ID` =ID$$

DROP PROCEDURE IF EXISTS `Archive_FinancialAss`$$
CREATE DEFINER="root"@"localhost" PROCEDURE "Archive_FinancialAss" (IN `ID` INT(100))  NO SQL
delete from `t_assign_stud_finan_assistance`  
where AssStudFinanAssistance_ID = ID$$

DROP PROCEDURE IF EXISTS `Archive_LossIDRegi`$$
CREATE DEFINER="root"@"localhost" PROCEDURE "Archive_LossIDRegi" (IN `ID` INT)  NO SQL
update t_assign_stud_loss_id_regicard 
set AssLoss_DISPLAY_STAT ='Inactive'
where AssLoss_ID =ID$$

DROP PROCEDURE IF EXISTS `FinishSanction`$$
CREATE DEFINER="root"@"localhost" PROCEDURE "FinishSanction" (IN `ID` INT)  NO SQL
UPDATE t_assign_stud_saction 
set AssSancStudStudent_IS_FINISH ='Finished'
where AssSancStudStudent_ID =ID$$

DROP PROCEDURE IF EXISTS `Insert_AssignConfilicts_SemClearance`$$
CREATE DEFINER="root"@"localhost" PROCEDURE "Insert_AssignConfilicts_SemClearance" (IN `Studno` VARCHAR(15), IN `acadyear` VARCHAR(15), IN `sem` VARCHAR(50), IN `sigcode` VARCHAR(15))  NO SQL
INSERT INTO `t_assign_student_clearance` (`AssStudClearance_STUD_NO`, `AssStudClearance_BATCH`, `AssStudClearance_SEMESTER`, `AssStudClearance_SIGNATORIES_CODE`) VALUES (Studno,acadyear,sem,sigcode)$$

DROP PROCEDURE IF EXISTS `Insert_AssignFinancialAss`$$
CREATE DEFINER="root"@"localhost" PROCEDURE "Insert_AssignFinancialAss" (IN `StudNo` VARCHAR(15), IN `FinanAssTitle` VARCHAR(100), IN `FinanAssStatus` ENUM('Active','Inactive','Void','Cancelled'), IN `FinanAssRemarks` VARCHAR(500))  NO SQL
INSERT INTO `t_assign_stud_finan_assistance` (`AssStudFinanAssistance_STUD_NO`, `AssStudFinanAssistance_FINAN_NAME`, `AssStudFinanAssistance_STATUS`, `AssStudFinanAssistance_REMARKS`, `AssStudFinanAssistance_DATE_ADD`) VALUES (StudNo,FinanAssTitle , FinanAssStatus, FinanAssRemarks, CURRENT_TIMESTAMP)$$

DROP PROCEDURE IF EXISTS `Insert_AssignSanction`$$
CREATE DEFINER=`root`@`localhost` PROCEDURE `Insert_AssignSanction` (IN `StudNo` VARCHAR(15), IN `SancCode` VARCHAR(100), IN `DesOffCode` VARCHAR(15), IN `Cons` INT, IN `Finish` ENUM('Finished','Processing'), IN `remarks` VARCHAR(100), IN `done` DATE)  NO SQL
INSERT INTO `t_assign_stud_saction`(`AssSancStudStudent_STUD_NO`, `AssSancStudStudent_SancDetails_CODE`, `AssSancStudStudent_DesOffDetails_CODE`,
`AssSancStudStudent_CONSUMED_HOURS`,
`AssSancStudStudent_IS_FINISH`,
`AssSancStudStudent_REMARKS`,
`AssSancStudStudent_TO_BE_DONE`) VALUES (StudNo,SancCode,DesOffCode,Cons,Finish,remarks,done)$$

DROP PROCEDURE IF EXISTS `Insert_DesignatedOffice`$$
CREATE DEFINER="root"@"localhost" PROCEDURE "Insert_DesignatedOffice" (IN `DesiCode` VARCHAR(15), IN `DesiName` VARCHAR(100), IN `DesiDesc` VARCHAR(100))  NO SQL
INSERT INTO `r_designated_offices_details` (  `DesOffDetails_CODE`, `DesOffDetails_NAME`, `DesOffDetails_DESC`) VALUES (DesiCode,DesiName,DesiDesc)$$

DROP PROCEDURE IF EXISTS `Insert_LossIDRegi`$$
CREATE DEFINER="root"@"localhost" PROCEDURE "Insert_LossIDRegi" (IN `StudNo` VARCHAR(15), IN `Type` ENUM('Identification Card','Registration Card'), IN `Claim` DATETIME, IN `Remarks` VARCHAR(500))  NO SQL
INSERT INTO `t_assign_stud_loss_id_regicard` ( `AssLoss_STUD_NO`, `AssLoss_TYPE`, `AssLoss_REMARKS`, `AssLoss_DATE_CLAIM`) VALUES (StudNo,Type,Remarks,Claim)$$

DROP PROCEDURE IF EXISTS `Insert_SanctionDetails`$$
CREATE DEFINER="root"@"localhost" PROCEDURE "Insert_SanctionDetails" (IN `SancCode` VARCHAR(100), IN `SancName` VARCHAR(100), IN `SancDesc` VARCHAR(1000), IN `TimeVal` INT(11))  NO SQL
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
CREATE DEFINER="root"@"localhost" PROCEDURE "Insert_Signatories" (IN `sCODE` VARCHAR(15), IN `sNAME` VARCHAR(100), IN `sDESC` VARCHAR(100))  NO SQL
INSERT INTO `r_clearance_signatories` (`ClearSignatories_CODE`, `ClearSignatories_NAME`, `ClearSignatories_DESC` ) VALUES (sCODE,sNAME,sDESC)$$

DROP PROCEDURE IF EXISTS `Insert_StudProfile`$$
CREATE DEFINER="root"@"localhost" PROCEDURE "Insert_StudProfile" (IN `StudNO` VARCHAR(15), IN `FNAME` VARCHAR(100), IN `MNAME` VARCHAR(100), IN `LNAME` VARCHAR(100), IN `COUSRE` VARCHAR(15), IN `SECTION` VARCHAR(5), IN `GENDER` VARCHAR(10), IN `EMAIL` VARCHAR(100), IN `CONTACT` VARCHAR(20), IN `BDAY` DATE, IN `BPLACE` VARCHAR(500), IN `ADDRESS` VARCHAR(500), IN `STATUS` VARCHAR(50))  NO SQL
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
CREATE DEFINER=`root`@`localhost` PROCEDURE `Insert_Users` (IN `Username` VARCHAR(15), IN `referencedUser` VARCHAR(15), IN `userRole` ENUM('Administrator','OSAS HEAD','Organization','Student','Staff','Student Assistant'), IN `UPassword` VARCHAR(500))  NO SQL
INSERT INTO `r_users` (`Users_USERNAME`, `Users_REFERENCED`, `Users_ROLES`,`Users_PASSWORD`) VALUES (Username,referencedUser,userRole,AES_Encrypt(UPassword,PASSWORD('OSASMIS')))$$

DROP PROCEDURE IF EXISTS `Insert_Voucher`$$
CREATE DEFINER="root"@"localhost" PROCEDURE "Insert_Voucher" (IN `Vouch` VARCHAR(15), IN `org` VARCHAR(15), IN `checkk` VARCHAR(100))  NO SQL
INSERT INTO `t_org_voucher` (`OrgVoucher_CASH_VOUCHER_NO`, `OrgVoucher_ORG_CODE`,`OrgVoucher_VOUCHED_BY`) VALUES ( Vouch, org, checkk)$$

DROP PROCEDURE IF EXISTS `Insert_Voucher_Item`$$
CREATE DEFINER="root"@"localhost" PROCEDURE "Insert_Voucher_Item" (IN `Vouch` VARCHAR(15), IN `itemss` VARCHAR(100), IN `amo` DOUBLE(10,3))  NO SQL
INSERT INTO `t_org_voucher_items` (`OrgVouchItems_VOUCHER_NO`, `OrgVouchItems_ITEM_NAME`, `OrgVouchItems_AMOUNT`) VALUES (Vouch,itemss,amo)$$

DROP PROCEDURE IF EXISTS `Login_User`$$
CREATE DEFINER="root"@"localhost" PROCEDURE "Login_User" (IN `username` VARCHAR(100), IN `password` VARCHAR(100))  NO SQL
SELECT * 
FROM osas.r_users 
WHERE Users_USERNAME = username 
AND AES_DECRYPT(Users_PASSWORD , Password('OSASMIS')) =password
AND Users_DISPLAY_STAT = 'Active'$$

DROP PROCEDURE IF EXISTS `Log_Sanction`$$
CREATE DEFINER="root"@"localhost" PROCEDURE "Log_Sanction" (IN `SancID` INT, IN `Consuumed` INT, IN `Remarks` VARCHAR(100), IN `isFinish` ENUM('Processing','Finished'))  NO SQL
INSERT INTO `log_sanction` ( `LogSanc_AssSancSudent_ID`, `LogSanc_CONSUMED_HOURS`, `LogSanc_REMARKS`, `LogSanc_IS_FINISH`) VALUES (SancID,Consuumed, Remarks, isFinish)$$

DROP PROCEDURE IF EXISTS `Update_AssignFinancialAss`$$
CREATE DEFINER="root"@"localhost" PROCEDURE "Update_AssignFinancialAss" (IN `ID` INT, IN `FinanAssStat` ENUM('Active','Inactive','Void','Cancelled'), IN `Remarks` VARCHAR(500))  NO SQL
UPDATE `t_assign_stud_finan_assistance` 
SET `AssStudFinanAssistance_STATUS` = FinanAssStat 
,`AssStudFinanAssistance_REMARKS` = Remarks
,`AssStudFinanAssistance_DATE_MOD` = CURRENT_TIMESTAMP
WHERE `AssStudFinanAssistance_ID` = ID$$

DROP PROCEDURE IF EXISTS `Update_AssignSanction`$$
CREATE DEFINER=`root`@`localhost` PROCEDURE `Update_AssignSanction` (IN `ID` INT, IN `Consume` INT, IN `Finish` ENUM('Finished','Processing'), IN `remarks` VARCHAR(100), IN `done` DATE)  NO SQL
UPDATE `t_assign_stud_saction` SET 
`AssSancStudStudent_CONSUMED_HOURS` =Consume
,`AssSancStudStudent_IS_FINISH` = Finish
,`AssSancStudStudent_REMARKS` = remarks
,`AssSancStudStudent_TO_BE_DONE` = done
,`AssSancStudStudent_DATE_MOD` = CURRENT_TIMESTAMP
WHERE
`AssSancStudStudent_ID` =ID$$

DROP PROCEDURE IF EXISTS `Update_LossIDRegi`$$
CREATE DEFINER="root"@"localhost" PROCEDURE "Update_LossIDRegi" (IN `ID` INT, IN `Claim` DATETIME, IN `Remarks` VARCHAR(500))  NO SQL
update t_assign_stud_loss_id_regicard 
set AssLoss_DATE_CLAIM = Claim
,AssLoss_REMARKS = Remarks
where AssLoss_ID =ID$$

DROP PROCEDURE IF EXISTS `Update_StudProfile`$$
CREATE DEFINER="root"@"localhost" PROCEDURE "Update_StudProfile" (IN `ID` INT(100), IN `StudNO` VARCHAR(15), IN `FNAME` VARCHAR(100), IN `MNAME` VARCHAR(100), IN `LNAME` VARCHAR(100), IN `COURSE` VARCHAR(15), IN `SECTION` VARCHAR(5), IN `GENDER` VARCHAR(10), IN `EMAIL` VARCHAR(100), IN `CONTACT` VARCHAR(20), IN `BDAY` DATE, IN `BPLACE` VARCHAR(500), IN `ADDRESS` VARCHAR(500), IN `STATUS` VARCHAR(50))  NO SQL
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
CREATE DEFINER="root"@"localhost" PROCEDURE "View_Courses" ()  NO SQL
select * from r_courses where course_display_stat ='active'$$

DROP PROCEDURE IF EXISTS `View_StudProfile`$$
CREATE DEFINER="root"@"localhost" PROCEDURE "View_StudProfile" ()  NO SQL
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
CREATE DEFINER="root"@"localhost" PROCEDURE "View_StudSanction" ()  NO SQL
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
) ENGINE=InnoDB DEFAULT CHARSET=latin1 ROW_FORMAT=COMPACT;

--
-- Truncate table before insert `active_academic_year`
--

TRUNCATE TABLE `active_academic_year`;
--
-- Dumping data for table `active_academic_year`
--

INSERT INTO `active_academic_year` (`ActiveAcadYear_ID`, `ActiveAcadYear_Batch_YEAR`, `ActiveAcadYear_IS_ACTIVE`, `ActiveAcadYear_DATE_ADD`, `ActiveAcadYear_DATE_MOD`) VALUES
(5, '2019-2020', '1', '2018-05-21 00:38:41', NULL);

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
) ENGINE=InnoDB DEFAULT CHARSET=latin1 ROW_FORMAT=COMPACT;

--
-- Truncate table before insert `active_semester`
--

TRUNCATE TABLE `active_semester`;
--
-- Dumping data for table `active_semester`
--

INSERT INTO `active_semester` (`ActiveSemester_ID`, `ActiveSemester_SEMESTRAL_NAME`, `ActiveSemester_IS_ACTIVE`, `ActiveSemester_DATE_ADD`, `ActiveSemester_DATE_MOD`) VALUES
(4, 'Summer Semester', '1', '2018-05-21 00:38:44', NULL);

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
  `LogSanc_TO_BE_DONE` date NOT NULL,
  `LogSanc_SEMESTER` varchar(50) NOT NULL,
  `LogSanc_ACAD_YEAR` varchar(15) NOT NULL,
  `LogSanc_IS_FINISH` enum('Processing','Finished') NOT NULL,
  `LogSanc_DATE_MOD` datetime NOT NULL DEFAULT CURRENT_TIMESTAMP
) ENGINE=InnoDB DEFAULT CHARSET=latin1 ROW_FORMAT=COMPACT;

--
-- Truncate table before insert `log_sanction`
--

TRUNCATE TABLE `log_sanction`;
--
-- Dumping data for table `log_sanction`
--

INSERT INTO `log_sanction` (`LogSanc_ID`, `LogSanc_AssSancSudent_ID`, `LogSanc_CONSUMED_HOURS`, `LogSanc_REMARKS`, `LogSanc_TO_BE_DONE`, `LogSanc_SEMESTER`, `LogSanc_ACAD_YEAR`, `LogSanc_IS_FINISH`, `LogSanc_DATE_MOD`) VALUES
(1, 1, 0, '', '2018-05-24', 'Summer Semester', '2019-2020', 'Processing', '2018-05-21 15:01:19'),
(2, 1, 12, '', '2018-05-24', 'Summer Semester', '2019-2020', 'Processing', '2018-05-21 15:01:31'),
(3, 1, 16, '', '2018-05-24', 'Summer Semester', '2019-2020', 'Finished', '2018-05-22 13:59:23'),
(4, 2, 0, '', '2018-05-29', 'Summer Semester', '2019-2020', 'Processing', '2018-05-26 10:16:11'),
(5, 2, 16, '', '2018-05-29', 'Summer Semester', '2019-2020', 'Finished', '2018-05-26 10:21:10');

-- --------------------------------------------------------

--
-- Table structure for table `notif_announcement`
--

DROP TABLE IF EXISTS `notif_announcement`;
CREATE TABLE `notif_announcement` (
  `Notif_ID` int(11) NOT NULL,
  `Notif_SUBJECT` varchar(1000) NOT NULL,
  `Notif_MESSAGE` text NOT NULL,
  `Notif_SEMESTER` varchar(50) NOT NULL,
  `Notif_ACAD_YEAR` varchar(15) NOT NULL,
  `Notif_SEND_BY` varchar(100) NOT NULL,
  `Notif_REC_BY` enum('All','Student','Organization') DEFAULT NULL,
  `Notif_DATE_ADD` datetime NOT NULL DEFAULT CURRENT_TIMESTAMP
) ENGINE=InnoDB DEFAULT CHARSET=latin1 ROW_FORMAT=COMPACT;

--
-- Truncate table before insert `notif_announcement`
--

TRUNCATE TABLE `notif_announcement`;
-- --------------------------------------------------------

--
-- Table structure for table `r_application_wizard`
--

DROP TABLE IF EXISTS `r_application_wizard`;
CREATE TABLE `r_application_wizard` (
  `WIZARD_ID` int(11) NOT NULL,
  `WIZARD_ORG_CODE` varchar(15) NOT NULL,
  `WIZARD_CURRENT_STEP` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1 ROW_FORMAT=COMPACT;

--
-- Truncate table before insert `r_application_wizard`
--

TRUNCATE TABLE `r_application_wizard`;
--
-- Dumping data for table `r_application_wizard`
--

INSERT INTO `r_application_wizard` (`WIZARD_ID`, `WIZARD_ORG_CODE`, `WIZARD_CURRENT_STEP`) VALUES
(1, 'CITS2019', 5);

-- --------------------------------------------------------

--
-- Table structure for table `r_archiving_documents`
--

DROP TABLE IF EXISTS `r_archiving_documents`;
CREATE TABLE `r_archiving_documents` (
  `ArchDocuments_ID` int(11) NOT NULL,
  `ArchDocuments_ORDER_NO` varchar(50) NOT NULL,
  `ArchDocuments_NAME` varchar(100) NOT NULL,
  `ArchDocuments_DESC` varchar(100) NOT NULL DEFAULT 'Document Description',
  `ArchDocuments_FILE_PATH` varchar(1000) NOT NULL,
  `ArchDocuments_STATUS` enum('Available','Dispose') NOT NULL DEFAULT 'Available',
  `ArchDocuments_DATE_ADD` datetime NOT NULL DEFAULT CURRENT_TIMESTAMP,
  `ArchDocuments_DATE_MOD` datetime NOT NULL DEFAULT CURRENT_TIMESTAMP,
  `ArchDocuments_DISPLAY_STAT` enum('Active','Inactive') DEFAULT 'Active'
) ENGINE=InnoDB DEFAULT CHARSET=latin1 ROW_FORMAT=COMPACT;

--
-- Truncate table before insert `r_archiving_documents`
--

TRUNCATE TABLE `r_archiving_documents`;
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
) ENGINE=InnoDB DEFAULT CHARSET=latin1 ROW_FORMAT=COMPACT;

--
-- Truncate table before insert `r_assign_case_to_case_sanction`
--

TRUNCATE TABLE `r_assign_case_to_case_sanction`;
-- --------------------------------------------------------

--
-- Table structure for table `r_batch_details`
--

DROP TABLE IF EXISTS `r_batch_details`;
CREATE TABLE `r_batch_details` (
  `Batch_ID` int(11) NOT NULL,
  `Batch_YEAR` varchar(15) NOT NULL,
  `Batch_DESC` varchar(100) DEFAULT NULL,
  `Batch_DISPLAY_STAT` enum('Active','Inactive') DEFAULT 'Active'
) ENGINE=InnoDB DEFAULT CHARSET=latin1 ROW_FORMAT=COMPACT;

--
-- Truncate table before insert `r_batch_details`
--

TRUNCATE TABLE `r_batch_details`;
--
-- Dumping data for table `r_batch_details`
--

INSERT INTO `r_batch_details` (`Batch_ID`, `Batch_YEAR`, `Batch_DESC`, `Batch_DISPLAY_STAT`) VALUES
(9, '2011-2012', '2011-2012', 'Active'),
(10, '2012-2013', '2012-2013', 'Active'),
(11, '2013-2014', '2013-2014', 'Active'),
(12, '2014-2015', '2014-2015', 'Active'),
(13, '2015-2016', '2015-2016', 'Active'),
(14, '2016-2017', '2016-2017', 'Active'),
(15, '2017-2018', '2017-2018', 'Active'),
(16, '2018-2019', '2018-2019', 'Active'),
(17, '2019-2020', '2019-2020', 'Active');

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
) ENGINE=InnoDB DEFAULT CHARSET=latin1 ROW_FORMAT=COMPACT;

--
-- Truncate table before insert `r_clearance_signatories`
--

TRUNCATE TABLE `r_clearance_signatories`;
--
-- Dumping data for table `r_clearance_signatories`
--

INSERT INTO `r_clearance_signatories` (`ClearSignatories_ID`, `ClearSignatories_CODE`, `ClearSignatories_NAME`, `ClearSignatories_DESC`, `ClearSignatories_DATE_MOD`, `ClearSignatories_DATE_ADD`, `ClearSignatories_DISPLAY_STAT`) VALUES
(11, 'SIG00001', 'Accounting Office', 'Accounting Office', '2018-05-21 00:32:21', '2018-05-21 00:32:21', 'Active'),
(12, 'SIG00002', 'Library', 'Library', '2018-05-21 00:34:38', '2018-05-21 00:34:38', 'Active'),
(13, 'SIG00003', 'Academic/ Director''s Office', 'Academic/ Director''s Office', '2018-05-21 00:34:56', '2018-05-21 00:34:56', 'Active'),
(14, 'SIG00004', 'Guidance and Counseling Office', 'Guidance and Counseling Office', '2018-05-21 00:35:18', '2018-05-21 00:35:18', 'Active'),
(15, 'SIG00005', 'Student Affairs and Services', 'Student Affairs and Services', '2018-05-21 00:35:40', '2018-05-21 00:35:40', 'Active');

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
) ENGINE=InnoDB DEFAULT CHARSET=latin1 ROW_FORMAT=COMPACT;

--
-- Truncate table before insert `r_courses`
--

TRUNCATE TABLE `r_courses`;
--
-- Dumping data for table `r_courses`
--

INSERT INTO `r_courses` (`Course_ID`, `Course_CODE`, `Course_NAME`, `Course_DESC`, `Course_CURR_YEAR`, `Course_DATE_MOD`, `Course_DATE_ADD`, `Course_DISPLAY_STAT`) VALUES
(5, 'BBTEBTL-CM', 'BACHELOR IN BUSINESS TEACHER EDUCATION-MAJOR IN BUSINESS TEACHER AND LIVELIHOOD EDUCATION', 'BBTEBTL-CM - BACHELOR IN BUSINESS TEACHER EDUCATION-MAJOR IN BUSINESS TEACHER AND LIVELIHOOD EDUCATI', '2011-2012', '2018-05-21 00:19:15', '2018-05-21 00:17:31', 'Active'),
(6, 'BBTLEDHE-CM', 'BACHELOR OF BUSINESS TECHNOLOGY AND LIVELIHOOD EDUCATION MAJOR IN HOME ECONOMICS', 'BBTLEDHE-CM - BACHELOR OF BUSINESS TECHNOLOGY AND LIVELIHOOD EDUCATION MAJOR IN HOME ECONOMICS (QUEZ', '2011-2012', '2018-05-21 00:18:12', '2018-05-21 00:18:12', 'Active'),
(7, 'BSBA-HRDM-CM', 'BACHELOR OF SCIENCE IN BUSINESS ADMINISTRATION MAJOR IN HUMAN RESOURCES DEVELOPMENT MANAGEMENT', 'BSBA-HRDM-CM - BACHELOR OF SCIENCE IN BUSINESS ADMINISTRATION MAJOR IN HUMAN RESOURCES DEVELOPMENT M', '2011-2012', '2018-05-21 00:18:42', '2018-05-21 00:18:42', 'Active'),
(8, 'BSBA-MM-CM', 'BACHELOR OF SCIENCE IN BUSINESS ADMINISTRATION MAJOR IN MARKETING MANAGEMENT ', 'BSBA-MM-CM - BACHELOR OF SCIENCE IN BUSINESS ADMINISTRATION MAJOR IN MARKETING MANAGEMENT (QUEZON CI', '2011-2012', '2018-05-21 00:19:10', '2018-05-21 00:19:10', 'Active'),
(9, 'BSBAHRM-CM', 'BACHELOR OF SCIENCE IN BUSINESS ADMINISTRATION MAJOR IN HUMAN RESOURCE MANAGEMENT', 'BSBAHRM-CM - BACHELOR OF SCIENCE IN BUSINESS ADMINISTRATION MAJOR IN HUMAN RESOURCE MANAGEMENT (QUEZ', '2011-2012', '2018-05-21 00:19:46', '2018-05-21 00:19:46', 'Active'),
(10, 'BSENT-CM', 'BACHELOR OF SCIENCE IN ENTREPRENEURSHIP ', 'BSENT-CM   - BACHELOR OF SCIENCE IN ENTREPRENEURSHIP (QUEZON CITY CAMPUS)', '2011-2012', '2018-05-21 00:20:22', '2018-05-21 00:20:22', 'Active'),
(11, 'BSIT-CM', 'BACHELOR OF SCIENCE IN INFORMATION TECHNOLOGY', 'BSIT-CM    - BACHELOR OF SCIENCE IN INFORMATION TECHNOLOGY (QUEZON CITY CAMPUS)', '2011-2012', '2018-05-21 00:20:59', '2018-05-21 00:20:59', 'Active'),
(12, 'DOMT-CM', 'DIPLOMA IN OFFICE MANAGEMENT TECHNOLOGY', 'DOMT-CM    - DIPLOMA IN OFFICE MANAGEMENT TECHNOLOGY (QUEZON CITY CAMPUS)', '2011-2012', '2018-05-21 00:22:22', '2018-05-21 00:22:22', 'Active'),
(13, 'DOMTMOM-CM', 'DIPLOMA IN OFFICE MANAGEMENT TECHNOLOGY WITH SPECIALIZATION IN MEDICAL OFFICE MANAGEMENT', 'DOMTMOM-CM - DIPLOMA IN OFFICE MANAGEMENT TECHNOLOGY WITH SPECIALIZATION IN MEDICAL OFFICE MANAGEMEN', '2011-2012', '2018-05-21 00:22:54', '2018-05-21 00:22:54', 'Active');

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
) ENGINE=InnoDB DEFAULT CHARSET=latin1 ROW_FORMAT=COMPACT;

--
-- Truncate table before insert `r_designated_offices_details`
--

TRUNCATE TABLE `r_designated_offices_details`;
--
-- Dumping data for table `r_designated_offices_details`
--

INSERT INTO `r_designated_offices_details` (`DesOffDetails_ID`, `DesOffDetails_CODE`, `DesOffDetails_NAME`, `DesOffDetails_DESC`, `DesOffDetails_DATE_ADD`, `DesOffDetails_DATE_MOD`, `DesOffDetails_DISPLAY_STAT`) VALUES
(10, 'OFF00001', 'Library', 'Library', '2018-05-21 00:01:33', '2018-05-21 00:01:33', 'Active'),
(11, 'OFF00002', 'Student Affairs and Services', 'Student Affairs and Services', '2018-05-21 00:35:51', '2018-05-21 00:35:51', 'Active'),
(12, 'OFF00003', 'Office of the Property Custodian ', 'Office of the Property Custodian ', '2018-05-21 00:36:15', '2018-05-21 00:36:15', 'Active'),
(13, 'QEWQ', 'QWEQWE', 'QWEQWE', '2018-05-26 10:27:10', '2018-05-26 10:27:10', 'Active');

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
) ENGINE=InnoDB DEFAULT CHARSET=latin1 ROW_FORMAT=COMPACT;

--
-- Truncate table before insert `r_financial_assistance_title`
--

TRUNCATE TABLE `r_financial_assistance_title`;
--
-- Dumping data for table `r_financial_assistance_title`
--

INSERT INTO `r_financial_assistance_title` (`FinAssiTitle_ID`, `FinAssiTitle_CODE`, `FinAssiTitle_NAME`, `FinAssiTitle_DESC`, `FinAssiTitle_DATE_ADD`, `FinAssiTitle_DATE_MOD`, `FinAssiTitle_DISPLAY_STAT`) VALUES
(13, 'Finan00001', 'CHED', 'Commission on Higher Education', '2018-05-21 00:12:05', '2018-05-21 00:12:05', 'Active'),
(14, 'Finan00002', 'SYDP', 'Scholarship & Youth Development Program', '2018-05-21 00:12:25', '2018-05-21 00:12:25', 'Active'),
(15, 'Finan00003', 'MegaWorld Foundation', 'MegaWorld Foundation', '2018-05-21 00:12:39', '2018-05-21 00:12:58', 'Active'),
(16, 'Finan00004', 'SM Foundation', 'SM Foundation', '2018-05-21 00:12:50', '2018-05-21 00:12:50', 'Active'),
(17, 'Finan00005', 'Dean''s Lister', 'Dean''s Lister', '2018-05-21 00:13:39', '2018-05-21 00:13:39', 'Active'),
(18, 'Finan00006', 'President''s Lister', 'President''s Lister', '2018-05-21 00:13:52', '2018-05-21 00:13:52', 'Active');

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
) ENGINE=InnoDB DEFAULT CHARSET=latin1 ROW_FORMAT=COMPACT;

--
-- Truncate table before insert `r_notification`
--

TRUNCATE TABLE `r_notification`;
--
-- Dumping data for table `r_notification`
--

INSERT INTO `r_notification` (`Notification_ID`, `Notification_ITEM`, `Notification_SENDER`, `Notification_RECEIVER`, `Notification_SEEN`, `Notification_CLICKED`, `Notification_USERROLE`, `Notification_DATE_SEEN`, `Notification_DATE_CLICKED`, `Notification_DATE_ADDED`) VALUES
(1, 'EVNT00003', 'CITS2019', '2018-OSAS-CM', 'Seen', 'Clicked', 'Organization', '2018-05-23 13:47:13', '2018-05-25 00:23:54', '2018-05-23 13:46:57'),
(2, 'Vouch #00001', 'CITS2019', '2018-OSAS-CM', 'Seen', 'Clicked', 'OSAS Head', '2018-05-26 10:29:07', '2018-05-26 10:29:09', '2018-05-26 10:29:02');

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
) ENGINE=InnoDB DEFAULT CHARSET=latin1 ROW_FORMAT=COMPACT;

--
-- Truncate table before insert `r_org_accreditation_details`
--

TRUNCATE TABLE `r_org_accreditation_details`;
--
-- Dumping data for table `r_org_accreditation_details`
--

INSERT INTO `r_org_accreditation_details` (`OrgAccrDetail_ID`, `OrgAccrDetail_CODE`, `OrgAccrDetail_NAME`, `OrgAccrDetail_DESC`, `OrgAccrDetail_DATE_ADD`, `OrgAccrDetail_DATE_MOD`, `OrgAccrDetail_DISPLAY_STAT`) VALUES
(1, 'REQ00001', 'Organization Name', 'Organization Name Description', '2018-05-23 12:46:05', '2018-05-23 12:46:05', 'Active'),
(2, 'REQ00002', 'Organization Category', 'Organization Category Description', '2018-05-23 12:46:20', '2018-05-23 12:46:56', 'Active'),
(3, 'REQ00003', 'Organization Members', 'Organization Members Description', '2018-05-23 12:46:36', '2018-05-23 12:47:00', 'Active'),
(4, 'REQ00004', 'Organization Officers', 'Organization Officers Description', '2018-05-23 12:46:45', '2018-05-23 12:47:03', 'Active');

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
) ENGINE=InnoDB DEFAULT CHARSET=latin1 ROW_FORMAT=COMPACT;

--
-- Truncate table before insert `r_org_applicant_profile`
--

TRUNCATE TABLE `r_org_applicant_profile`;
--
-- Dumping data for table `r_org_applicant_profile`
--

INSERT INTO `r_org_applicant_profile` (`OrgAppProfile_ID`, `OrgAppProfile_APPL_CODE`, `OrgAppProfile_NAME`, `OrgAppProfile_DESCRIPTION`, `OrgAppProfile_STATUS`, `OrgAppProfile_DATE_ADD`, `OrgAppProfile_DATE_MOD`, `OrgAppProfile_DISPLAY_STAT`) VALUES
(1, 'CITS2019', 'Commonwealth Information Technology Society', 'This is an Academic Organization, responsible for managing and inspiring its members.', 'This application is ready for accreditation', '2018-05-23 12:44:12', '2018-05-23 12:44:12', 'Active');

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
) ENGINE=InnoDB DEFAULT CHARSET=latin1 ROW_FORMAT=COMPACT;

--
-- Truncate table before insert `r_org_category`
--

TRUNCATE TABLE `r_org_category`;
--
-- Dumping data for table `r_org_category`
--

INSERT INTO `r_org_category` (`OrgCat_ID`, `OrgCat_CODE`, `OrgCat_NAME`, `OrgCat_DESC`, `OrgCat_DATE_ADD`, `OrgCat_DATE_MOD`, `OrgCat_DISPLAY_STAT`) VALUES
(4, 'ACAD_ORG', 'Academic Organization', 'Academic Organization', '2018-05-21 00:23:24', '2018-05-21 00:23:24', 'Active'),
(5, 'NON-ACAD_ORG', 'Non-Academic Organization', 'Non-Academic Organization', '2018-05-21 00:25:49', '2018-05-21 00:25:49', 'Active');

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
) ENGINE=InnoDB DEFAULT CHARSET=latin1 ROW_FORMAT=COMPACT;

--
-- Truncate table before insert `r_org_essentials`
--

TRUNCATE TABLE `r_org_essentials`;
--
-- Dumping data for table `r_org_essentials`
--

INSERT INTO `r_org_essentials` (`OrgEssentials_ID`, `OrgEssentials_ORG_CODE`, `OrgEssentials_MISSION`, `OrgEssentials_VISION`, `OrgEssentials_LOGO`, `OrgEssentials_DATE_ADD`, `OrgEssentials_DATE_MOD`, `OrgEssentials_DISPLAY_STAT`) VALUES
(1, 'CITS2019', 'MissionMissionMission', 'VisionVisionVision', '', '2018-05-23 12:45:08', '2018-05-23 12:45:08', 'Active');

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
  `OrgEvent_FILES` varchar(100) NOT NULL,
  `OrgEvent_STATUS` enum('Cancelled','Pending','Approved','Rejected') NOT NULL DEFAULT 'Pending',
  `OrgEvent_PROPOSED_DATE` date NOT NULL,
  `OrgEvent_ReviewdBy` varchar(15) NOT NULL,
  `OrgEvent_DATE_ADD` datetime NOT NULL DEFAULT CURRENT_TIMESTAMP,
  `OrgEvent_DATE_MOD` datetime DEFAULT NULL,
  `OrgEvent_DISPLAY_STAT` enum('Active','Inactive') NOT NULL DEFAULT 'Active'
) ENGINE=InnoDB DEFAULT CHARSET=latin1 ROW_FORMAT=COMPACT;

--
-- Truncate table before insert `r_org_event_management`
--

TRUNCATE TABLE `r_org_event_management`;
--
-- Dumping data for table `r_org_event_management`
--

INSERT INTO `r_org_event_management` (`OrgEvent_ID`, `OrgEvent_OrgCode`, `OrgEvent_Code`, `OrgEvent_NAME`, `OrgEvent_DESCRIPTION`, `OrgEvent_FILES`, `OrgEvent_STATUS`, `OrgEvent_PROPOSED_DATE`, `OrgEvent_ReviewdBy`, `OrgEvent_DATE_ADD`, `OrgEvent_DATE_MOD`, `OrgEvent_DISPLAY_STAT`) VALUES
(2, 'CITS2019', 'EVNT00002', 'sdsa', 'sdsa', '../../../Documents/EventDocu-2019-2020-Summer Semester-CITS2019-sdsa.png', 'Approved', '3123-02-12', 'Demelyn E. Monz', '2018-05-23 13:41:40', NULL, 'Active'),
(3, 'CITS2019', 'EVNT00003', '$orgcode', 'asd', '../../Documents/EventDocu-2019-2020-Summer Semester-CITS2019-$orgcode.png', 'Pending', '0000-00-00', '', '2018-05-23 13:46:57', NULL, 'Active');

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
) ENGINE=InnoDB DEFAULT CHARSET=latin1 ROW_FORMAT=COMPACT;

--
-- Truncate table before insert `r_org_non_academic_details`
--

TRUNCATE TABLE `r_org_non_academic_details`;
--
-- Dumping data for table `r_org_non_academic_details`
--

INSERT INTO `r_org_non_academic_details` (`OrgNonAcad_ID`, `OrgNonAcad_CODE`, `OrgNonAcad_NAME`, `OrgNonAcad_DESC`, `OrgNonAcad_DATE_ADD`, `OrgNonAcad_DATE_MOD`, `OrgNonAcad_DISPLAY_STAT`) VALUES
(2, 'REL_ORG', 'Relogious Organization', 'Relogious Organization', '2018-05-21 00:31:56', '2018-05-21 00:31:56', 'Active');

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
) ENGINE=InnoDB DEFAULT CHARSET=latin1 ROW_FORMAT=COMPACT;

--
-- Truncate table before insert `r_org_officer_position_details`
--

TRUNCATE TABLE `r_org_officer_position_details`;
--
-- Dumping data for table `r_org_officer_position_details`
--

INSERT INTO `r_org_officer_position_details` (`OrgOffiPosDetails_ID`, `OrgOffiPosDetails_ORG_CODE`, `OrgOffiPosDetails_NAME`, `OrgOffiPosDetails_DESC`, `OrgOffiPosDetails_NumOfOcc`, `OrgOffiPosDetails_DATE_MOD`, `OrgOffiPosDetails_DATE_ADD`, `OrgOffiPosDetails_DISPLAY_STAT`) VALUES
(1, 'CITS2019', 'President', 'Office Position Description', 1, '2018-05-23 12:44:12', '2018-05-23 12:44:12', 'Active'),
(2, 'CITS2019', 'Vice-President of internal affair', 'Office Position Description', 1, '2018-05-23 12:44:12', '2018-05-23 12:44:12', 'Active'),
(3, 'CITS2019', 'Vice-President of external affair', 'Office Position Description', 1, '2018-05-23 12:44:13', '2018-05-23 12:44:13', 'Active'),
(4, 'CITS2019', 'Budget and Finance', 'Office Position Description', 1, '2018-05-23 12:44:13', '2018-05-23 12:44:13', 'Active'),
(5, 'CITS2019', 'Auditor', 'Office Position Description', 1, '2018-05-23 12:44:13', '2018-05-23 12:44:13', 'Active'),
(16, 'CITS2019', 'Research and Development Team', 'Research and Development Team', 4, '2018-05-24 10:28:11', '2018-05-24 10:28:11', 'Active');

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
) ENGINE=InnoDB DEFAULT CHARSET=latin1 ROW_FORMAT=COMPACT;

--
-- Truncate table before insert `r_osas_head`
--

TRUNCATE TABLE `r_osas_head`;
--
-- Dumping data for table `r_osas_head`
--

INSERT INTO `r_osas_head` (`OSASHead_ID`, `OSASHead_CODE`, `OSASHead_NAME`, `OSASHead_DESC`, `OSASHead_DATE_PROMOTED`, `OSASHead_DATE_ADD`, `OSASHead_DATE_MOD`, `OSASHead_DISPLAY_STAT`) VALUES
(2, '2018-OSAS-CM', 'Demelyn E. Monzon', 'Introduce your self', '2018-05-20 23:48:58', '2018-05-20 23:48:58', '2018-05-20 23:48:58', 'Active');

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
) ENGINE=InnoDB DEFAULT CHARSET=latin1 ROW_FORMAT=COMPACT;

--
-- Truncate table before insert `r_sanction_details`
--

TRUNCATE TABLE `r_sanction_details`;
--
-- Dumping data for table `r_sanction_details`
--

INSERT INTO `r_sanction_details` (`SancDetails_ID`, `SancDetails_CODE`, `SancDetails_NAME`, `SancDetails_DESC`, `SancDetails_TIMEVAL`, `SancDetails_DATE_MOD`, `SancDetails_DATE_ADD`, `SancDetails_DISPLAY_STAT`) VALUES
(17, 'LossRegi_16', 'Loss of Registration Card', 'Loss of Registration Card', 16, '2018-05-21 08:09:48', '2018-05-21 00:38:11', 'Active'),
(18, 'LossID_16', 'Loss of Identification Card', 'Loss of Identification Card	', 16, '2018-05-21 08:09:42', '2018-05-21 00:38:30', 'Active'),
(19, 'Late_Regi', 'Late Claim of Registration Card', 'Late Claim of Registration Card', 16, '2018-05-21 08:09:32', '2018-05-21 08:09:32', 'Active');

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
) ENGINE=InnoDB DEFAULT CHARSET=latin1 ROW_FORMAT=COMPACT;

--
-- Truncate table before insert `r_semester`
--

TRUNCATE TABLE `r_semester`;
--
-- Dumping data for table `r_semester`
--

INSERT INTO `r_semester` (`Semestral_ID`, `Semestral_CODE`, `Semestral_NAME`, `Semestral_DESC`, `Semestral_DATE_ADD`, `Semestral_DATE_MOD`, `Semestral_DISPLAY_STAT`) VALUES
(7, 'SEM00001', 'First Semester', 'First Semester', '2018-05-21 00:14:49', '2018-05-21 00:14:49', 'Active'),
(8, 'SEM00002', 'Second Semester', 'Second Semester', '2018-05-21 00:14:57', '2018-05-21 00:14:57', 'Active'),
(9, 'SEM00003', 'Third Semester', 'Third Semester', '2018-05-21 00:15:08', '2018-05-21 00:15:08', 'Active'),
(10, 'SEM00004', 'Fourth Semester', 'Fourth Semester', '2018-05-21 00:15:16', '2018-05-21 00:15:16', 'Active'),
(11, 'SEM00005', 'Summer Semester', 'Summer Semester', '2018-05-21 00:15:25', '2018-05-21 00:15:25', 'Active');

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
) ENGINE=InnoDB DEFAULT CHARSET=latin1 ROW_FORMAT=COMPACT;

--
-- Truncate table before insert `r_stud_profile`
--

TRUNCATE TABLE `r_stud_profile`;
--
-- Dumping data for table `r_stud_profile`
--

INSERT INTO `r_stud_profile` (`Stud_ID`, `Stud_NO`, `Stud_FNAME`, `Stud_MNAME`, `Stud_LNAME`, `Stud_COURSE`, `Stud_YEAR_LEVEL`, `Stud_SECTION`, `Stud_GENDER`, `Stud_EMAIL`, `Stud_CONTACT_NO`, `Stud_BIRHT_DATE`, `Stud_BIRTH_PLACE`, `Stud_ADDRESS`, `Stud_STATUS`, `Stud_DATE_MOD`, `Stud_DATE_ADD`, `Stud_DATE_DEACTIVATE`, `Stud_DISPLAY_STATUS`) VALUES
(22, '2012-00075-CM-0', 'LOWELL DAVE', 'ELBA', 'AGNIR', 'BSIT-CM', 3, '1', 'Male', 'sampleemail@gmail.com', '9182035678', '2018-05-21', 'qc', 'qc', 'Regular', '2018-05-21 17:12:18', '2018-05-21 08:04:43', NULL, 'Active'),
(23, '2016-00410-CM-0', 'MA. MICHAELA ', 'CRUZ', 'ALEJANDRIA', 'BSIT-CM', 3, '1', 'Female', 'sampleemail@gmail.com', '9182035678', '0000-00-00', 'qc', 'qc', 'Regular', '2018-05-21 08:04:43', '2018-05-21 08:04:43', NULL, 'Active'),
(24, '2015-00046-CM-0', 'KEITH EYVAN ', 'NOBONG', 'ALVIOR', 'BSIT-CM', 3, '1', 'Male', 'sampleemail@gmail.com', '9182035678', '0000-00-00', 'qc', 'qc', 'Regular', '2018-05-21 08:04:43', '2018-05-21 08:04:43', NULL, 'Active'),
(25, '2011-00075-CM-0', 'LOWELL DAVE', 'ELBA', 'AGNIR', 'BSIT-CM', 3, '1', 'Male', 'sampleemail@gmail.com', '9182035678', '0000-00-00', 'qc', 'qc', 'Regular', '2018-05-21 08:04:43', '2018-05-21 08:04:43', NULL, 'Active'),
(26, '2010-00410-CM-0', 'MA. MICHAELA ', 'CRUZ', 'ALEJANDRIA', 'BSIT-CM', 3, '1', 'Female', 'sampleemail@gmail.com', '9182035678', '0000-00-00', 'qc', 'qc', 'Regular', '2018-05-21 08:04:43', '2018-05-21 08:04:43', NULL, 'Active'),
(27, '2020-00410-CM-0', 'MA. MICHAELA ', 'CRUZ', 'ALEJANDRIA', 'BSIT-CM', 3, '1', 'Female', 'sampleemail@gmail.com', '9182035678', '0000-00-00', 'qc', 'qc', 'Regular', '2018-05-21 08:04:43', '2018-05-21 08:04:43', NULL, 'Active'),
(28, '2032-00410-CM-0', 'MA. MICHAELA ', 'CRUZ', 'ALEJANDRIA', 'BSIT-CM', 3, '1', 'Female', 'sampleemail@gmail.com', '9182035678', '0000-00-00', 'qc', 'qc', 'Regular', '2018-05-21 08:04:43', '2018-05-21 08:04:43', NULL, 'Active');

-- --------------------------------------------------------

--
-- Table structure for table `r_system_config`
--

DROP TABLE IF EXISTS `r_system_config`;
CREATE TABLE `r_system_config` (
  `SysConfig_ID` int(11) NOT NULL,
  `SysConfig_NAME` varchar(100) NOT NULL,
  `SysConfig_PROPERTIES` varchar(100) NOT NULL,
  `SysConfig_DATE_ADD` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP,
  `SysConfig_DATE_MOD` datetime DEFAULT NULL,
  `SysConfig_DISPLAY_STAT` enum('Active','Inactive') NOT NULL DEFAULT 'Active'
) ENGINE=InnoDB DEFAULT CHARSET=latin1 ROW_FORMAT=COMPACT;

--
-- Truncate table before insert `r_system_config`
--

TRUNCATE TABLE `r_system_config`;
--
-- Dumping data for table `r_system_config`
--

INSERT INTO `r_system_config` (`SysConfig_ID`, `SysConfig_NAME`, `SysConfig_PROPERTIES`, `SysConfig_DATE_ADD`, `SysConfig_DATE_MOD`, `SysConfig_DISPLAY_STAT`) VALUES
(1, 'DisposalDays', '10', '2018-05-20 23:47:57', NULL, 'Active');

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
  `Users_ROLES` enum('Administrator','OSAS HEAD','Organization','Student','Staff','Student Assistat') NOT NULL,
  `Users_PROFILE_PATH` varchar(500) DEFAULT NULL,
  `Users_DATE_ADD` datetime NOT NULL DEFAULT CURRENT_TIMESTAMP,
  `Users_DATE_MOD` datetime NOT NULL DEFAULT CURRENT_TIMESTAMP,
  `Users_DISPLAY_STAT` enum('Active','Inactive') DEFAULT 'Active'
) ENGINE=InnoDB DEFAULT CHARSET=latin1 ROW_FORMAT=COMPACT;

--
-- Truncate table before insert `r_users`
--

TRUNCATE TABLE `r_users`;
--
-- Dumping data for table `r_users`
--

INSERT INTO `r_users` (`Users_ID`, `Users_USERNAME`, `Users_REFERENCED`, `Users_PASSWORD`, `Users_ROLES`, `Users_PROFILE_PATH`, `Users_DATE_ADD`, `Users_DATE_MOD`, `Users_DISPLAY_STAT`) VALUES
(14, 'Demelyn', '2018-OSAS-CM', 0x852fa0a245a1467fcfd3e79a8c1bb0c9, 'OSAS HEAD', NULL, '2018-05-20 23:49:40', '2018-05-20 23:49:40', 'Active'),
(15, 'admin', 'admin', 0x4d8eab5029a8c36fe1bf1c3f13405f73, 'Administrator', NULL, '2018-05-20 23:51:59', '2018-05-20 23:51:59', 'Active'),
(16, 'staff', '-1', 0xc025bdda58e2790a32d70e58b3f5f148, 'Staff', NULL, '2018-05-21 00:01:12', '2018-05-21 00:01:12', 'Active'),
(17, 'CITS2019', 'CITS2019', 0xfefb12fa6206f5695691c396467cd6a1, 'Organization', NULL, '2018-05-23 12:44:31', '2018-05-23 12:44:31', 'Active');

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
) ENGINE=InnoDB DEFAULT CHARSET=latin1 ROW_FORMAT=COMPACT;

--
-- Truncate table before insert `t_assign_org_academic_course`
--

TRUNCATE TABLE `t_assign_org_academic_course`;
--
-- Dumping data for table `t_assign_org_academic_course`
--

INSERT INTO `t_assign_org_academic_course` (`AssOrgAcademic_ID`, `AssOrgAcademic_ORG_CODE`, `AssOrgAcademic_COURSE_CODE`, `AssOrgAcademic_DATE_ADD`, `AssOrgAcademic_DATE_MOD`, `AssOrgAcademic_DISPLAY_STAT`) VALUES
(1, 'CITS2019', 'BSIT-CM', '2018-05-23 12:44:13', '2018-05-23 12:44:13', 'Active');

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
) ENGINE=InnoDB DEFAULT CHARSET=latin1 ROW_FORMAT=COMPACT;

--
-- Truncate table before insert `t_assign_org_category`
--

TRUNCATE TABLE `t_assign_org_category`;
--
-- Dumping data for table `t_assign_org_category`
--

INSERT INTO `t_assign_org_category` (`AssOrgCategory_ID`, `AssOrgCategory_ORG_CODE`, `AssOrgCategory_ORGCAT_CODE`, `AssOrgCategory_DATE_ADD`, `AssOrgCategory_DATE_MOD`, `AssOrgCategory_DISPLAY_STAT`) VALUES
(1, 'CITS2019', 'ACAD_ORG', '2018-05-23 12:44:12', '2018-05-23 12:44:12', 'Active');

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
) ENGINE=InnoDB DEFAULT CHARSET=latin1 ROW_FORMAT=COMPACT;

--
-- Truncate table before insert `t_assign_org_members`
--

TRUNCATE TABLE `t_assign_org_members`;
--
-- Dumping data for table `t_assign_org_members`
--

INSERT INTO `t_assign_org_members` (`AssOrgMem_ID`, `AssOrgMem_STUD_NO`, `AssOrgMem_COMPL_ORG_CODE`, `AssOrgMem_DATE_ADD`, `AssOrgMem_DATE_MOD`, `AssOrgMem_DISPLAY_STAT`) VALUES
(5, '2010-00410-CM-0', 'CITS2019', '2018-05-23 12:45:14', NULL, 'Active'),
(4, '2011-00075-CM-0', 'CITS2019', '2018-05-23 12:45:14', NULL, 'Active'),
(1, '2012-00075-CM-0', 'CITS2019', '2018-05-23 12:45:12', NULL, 'Active'),
(3, '2015-00046-CM-0', 'CITS2019', '2018-05-23 12:45:13', NULL, 'Active'),
(2, '2016-00410-CM-0', 'CITS2019', '2018-05-23 12:45:13', NULL, 'Active'),
(6, '2020-00410-CM-0', 'CITS2019', '2018-05-23 12:45:14', NULL, 'Active'),
(7, '2032-00410-CM-0', 'CITS2019', '2018-05-23 12:45:14', NULL, 'Active');

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
) ENGINE=InnoDB DEFAULT CHARSET=latin1 ROW_FORMAT=COMPACT;

--
-- Truncate table before insert `t_assign_org_non_academic`
--

TRUNCATE TABLE `t_assign_org_non_academic`;
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
) ENGINE=InnoDB DEFAULT CHARSET=latin1 ROW_FORMAT=COMPACT;

--
-- Truncate table before insert `t_assign_org_sanction`
--

TRUNCATE TABLE `t_assign_org_sanction`;
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
) ENGINE=InnoDB DEFAULT CHARSET=latin1 ROW_FORMAT=COMPACT;

--
-- Truncate table before insert `t_assign_student_clearance`
--

TRUNCATE TABLE `t_assign_student_clearance`;
--
-- Dumping data for table `t_assign_student_clearance`
--

INSERT INTO `t_assign_student_clearance` (`AssStudClearance_ID`, `AssStudClearance_STUD_NO`, `AssStudClearance_BATCH`, `AssStudClearance_SEMESTER`, `AssStudClearance_SIGNATORIES_CODE`, `AssStudClearance_DATE_ADD`, `AssStudClearance_DATE_MOD`, `AssStudClearance_DISPLAY_STAT`) VALUES
(1, '2012-00075-CM-0', '2019-2020', 'Summer Semester', 'SIG00001', '2018-05-21 14:56:15', '2018-05-26 10:15:37', 'Active'),
(4, '2012-00075-CM-0', '2019-2020', 'Summer Semester', 'SIG00002', '2018-05-21 14:56:15', '2018-05-22 12:49:54', 'Inactive'),
(3, '2012-00075-CM-0', '2019-2020', 'Summer Semester', 'SIG00003', '2018-05-21 14:56:15', '2018-05-22 12:49:54', 'Inactive'),
(2, '2012-00075-CM-0', '2019-2020', 'Summer Semester', 'SIG00004', '2018-05-21 14:56:15', '2018-05-22 12:49:54', 'Inactive'),
(5, '2012-00075-CM-0', '2019-2020', 'Summer Semester', 'SIG00005', '2018-05-21 14:56:15', '2018-05-22 12:50:04', 'Inactive');

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
) ENGINE=InnoDB DEFAULT CHARSET=latin1 ROW_FORMAT=COMPACT;

--
-- Truncate table before insert `t_assign_stud_finan_assistance`
--

TRUNCATE TABLE `t_assign_stud_finan_assistance`;
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
) ENGINE=InnoDB DEFAULT CHARSET=latin1 ROW_FORMAT=COMPACT;

--
-- Truncate table before insert `t_assign_stud_loss_id_regicard`
--

TRUNCATE TABLE `t_assign_stud_loss_id_regicard`;
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
) ENGINE=InnoDB DEFAULT CHARSET=latin1 ROW_FORMAT=COMPACT;

--
-- Truncate table before insert `t_assign_stud_saction`
--

TRUNCATE TABLE `t_assign_stud_saction`;
--
-- Dumping data for table `t_assign_stud_saction`
--

INSERT INTO `t_assign_stud_saction` (`AssSancStudStudent_ID`, `AssSancStudStudent_STUD_NO`, `AssSancStudStudent_SancDetails_CODE`, `AssSancStudStudent_DesOffDetails_CODE`, `AssSancStudStudent_CONSUMED_HOURS`, `AssSancStudStudent_TO_BE_DONE`, `AssSancStudStudent_REMARKS`, `AssSancStudStudent_IS_FINISH`, `AssSancStudStudent_DATE_ADD`, `AssSancStudStudent_DATE_MOD`, `AssSancStudStudent_DISPLAY_STAT`) VALUES
(1, '2012-00075-CM-0', 'LossRegi_16', 'OFF00001', 16, '2018-05-24', '', 'Finished', '2018-05-21 15:01:19', '2018-05-22 13:59:23', 'Active'),
(2, '2016-00410-CM-0', 'LossRegi_16', 'OFF00001', 16, '2018-05-29', '', 'Finished', '2018-05-26 10:16:11', '2018-05-26 10:21:10', 'Active');

-- --------------------------------------------------------

--
-- Table structure for table `t_clearance_generated_code`
--

DROP TABLE IF EXISTS `t_clearance_generated_code`;
CREATE TABLE `t_clearance_generated_code` (
  `ClearanceGenCode_ID` int(11) NOT NULL,
  `ClearanceGenCode_STUD_NO` varchar(15) NOT NULL,
  `ClearanceGenCode_ACADEMIC_YEAR` varchar(15) NOT NULL,
  `ClearanceGenCode_SEMESTER` varchar(50) NOT NULL,
  `ClearanceGenCode_COD_VALUE` blob NOT NULL,
  `ClearanceGenCode_IS_CLAIMED` datetime DEFAULT NULL,
  `ClearanceGenCode_IS_GENERATE` datetime DEFAULT NULL,
  `ClearanceGenCode_DATE_ADD` datetime NOT NULL DEFAULT CURRENT_TIMESTAMP,
  `ClearanceGenCode_DATE_MOD` datetime NOT NULL,
  `ClearanceGenCode_DISPLAY_STAT` enum('Active','Inactive') DEFAULT 'Active'
) ENGINE=InnoDB DEFAULT CHARSET=latin1 ROW_FORMAT=COMPACT;

--
-- Truncate table before insert `t_clearance_generated_code`
--

TRUNCATE TABLE `t_clearance_generated_code`;
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
) ENGINE=InnoDB DEFAULT CHARSET=latin1 ROW_FORMAT=COMPACT;

--
-- Truncate table before insert `t_org_accreditation_process`
--

TRUNCATE TABLE `t_org_accreditation_process`;
--
-- Dumping data for table `t_org_accreditation_process`
--

INSERT INTO `t_org_accreditation_process` (`OrgAccrProcess_ID`, `OrgAccrProcess_ORG_CODE`, `OrgAccrProcess_OrgAccrDetail_CODE`, `OrgAccrProcess_IS_ACCREDITED`, `OrgAccrProcess_DATE_ADD`, `OrgAccrProcess_DATE_MOD`, `OrgAccrProcess_DISPLAY_STAT`) VALUES
(4, 'CITS2019', 'REQ00001', 1, '2018-05-23 12:47:14', '2018-05-23 12:47:14', 'Active'),
(1, 'CITS2019', 'REQ00002', 1, '2018-05-23 12:47:14', '2018-05-23 12:47:14', 'Active'),
(2, 'CITS2019', 'REQ00003', 1, '2018-05-23 12:47:14', '2018-05-23 12:47:14', 'Active'),
(3, 'CITS2019', 'REQ00004', 1, '2018-05-23 12:47:14', '2018-05-23 12:47:14', 'Active');

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
) ENGINE=InnoDB DEFAULT CHARSET=latin1 ROW_FORMAT=COMPACT;

--
-- Truncate table before insert `t_org_cash_flow_statement`
--

TRUNCATE TABLE `t_org_cash_flow_statement`;
--
-- Dumping data for table `t_org_cash_flow_statement`
--

INSERT INTO `t_org_cash_flow_statement` (`OrgCashFlowStatement_ID`, `OrgCashFlowStatement_ORG_CODE`, `OrgCashFlowStatement_ITEM`, `OrgCashFlowStatement_COLLECTION`, `OrgCashFlowStatement_EXPENSES`, `OrgCashFlowStatement_REMARKS`, `OrgCashFlowStatement_DATE_ADD`, `OrgCashFlowStatement_DATE_MOD`, `OrgCashFlowStatement_DISPLAY_STAT`) VALUES
(1, 'CITS2019', 'Remit #00001', 1000.000, NULL, 'Received by: Demelyn E. Monzon', '2018-05-26 10:28:08', '2018-05-26 10:28:08', 'Active'),
(2, 'CITS2019', 'Vouch #00001', NULL, 400.000, 'Received by: Demelyn', '2018-05-26 10:29:02', '2018-05-26 10:29:02', 'Active');

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
) ENGINE=InnoDB DEFAULT CHARSET=latin1 ROW_FORMAT=COMPACT;

--
-- Truncate table before insert `t_org_financial_statement`
--

TRUNCATE TABLE `t_org_financial_statement`;
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
) ENGINE=InnoDB DEFAULT CHARSET=latin1 ROW_FORMAT=COMPACT;

--
-- Truncate table before insert `t_org_financial_statement_items`
--

TRUNCATE TABLE `t_org_financial_statement_items`;
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
) ENGINE=InnoDB DEFAULT CHARSET=latin1 ROW_FORMAT=COMPACT;

--
-- Truncate table before insert `t_org_for_compliance`
--

TRUNCATE TABLE `t_org_for_compliance`;
--
-- Dumping data for table `t_org_for_compliance`
--

INSERT INTO `t_org_for_compliance` (`OrgForCompliance_ID`, `OrgForCompliance_ORG_CODE`, `OrgForCompliance_OrgApplProfile_APPL_CODE`, `OrgForCompliance_ADVISER`, `OrgForCompliance_BATCH_YEAR`, `OrgForCompliance_DATE_ADD`, `OrgForCompliance_DATE_MOD`, `OrgForCompliance_DISPAY_STAT`) VALUES
(1, 'CITS2019', 'CITS2019', 'Alma C. Fernandez', '2019-2020', '2018-05-23 12:44:12', '2018-05-23 12:44:12', 'Active');

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
) ENGINE=InnoDB DEFAULT CHARSET=latin1 ROW_FORMAT=COMPACT;

--
-- Truncate table before insert `t_org_officers`
--

TRUNCATE TABLE `t_org_officers`;
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
) ENGINE=InnoDB DEFAULT CHARSET=latin1 ROW_FORMAT=COMPACT;

--
-- Truncate table before insert `t_org_remittance`
--

TRUNCATE TABLE `t_org_remittance`;
--
-- Dumping data for table `t_org_remittance`
--

INSERT INTO `t_org_remittance` (`OrgRemittance_ID`, `OrgRemittance_NUMBER`, `OrgRemittance_ORG_CODE`, `OrgRemittance_SEND_BY`, `OrgRemittance_REC_BY`, `OrgRemittance_AMOUNT`, `OrgRemittance_DESC`, `OrgRemittance_DATE_ADD`, `OrgRemittance_DATE_MOD`, `OrgRemittance_DISPLAY_STAT`, `OrgRemittance_APPROVED_STATUS`) VALUES
(1, 'Remit #00001', 'CITS2019', 'Patrick', 'Demelyn E. Monzon', 1000.000, 'Remittance', '2018-05-26 10:28:08', '2018-05-26 10:28:08', 'Active', 'Approved');

-- --------------------------------------------------------

--
-- Table structure for table `t_org_voucher`
--

DROP TABLE IF EXISTS `t_org_voucher`;
CREATE TABLE `t_org_voucher` (
  `OrgVoucher_ID` int(11) NOT NULL,
  `OrgVoucher_CASH_VOUCHER_NO` varchar(15) NOT NULL,
  `OrgVoucher_CHECKED_BY` varchar(100) NOT NULL,
  `OrgVoucher_VOUCHED_BY` varchar(100) DEFAULT NULL,
  `OrgVoucher_ORG_CODE` varchar(15) NOT NULL,
  `OrgVoucher_STATUS` enum('Cancelled','Pending','Approved','Rejected') NOT NULL DEFAULT 'Pending',
  `OrgVoucher_DATE_ADD` datetime NOT NULL DEFAULT CURRENT_TIMESTAMP,
  `OrgVoucher_DATE_MOD` datetime NOT NULL DEFAULT CURRENT_TIMESTAMP,
  `OrgVoucher_DISPLAY_STAT` enum('Active','Inactive') DEFAULT 'Active'
) ENGINE=InnoDB DEFAULT CHARSET=latin1 ROW_FORMAT=COMPACT;

--
-- Truncate table before insert `t_org_voucher`
--

TRUNCATE TABLE `t_org_voucher`;
--
-- Dumping data for table `t_org_voucher`
--

INSERT INTO `t_org_voucher` (`OrgVoucher_ID`, `OrgVoucher_CASH_VOUCHER_NO`, `OrgVoucher_CHECKED_BY`, `OrgVoucher_VOUCHED_BY`, `OrgVoucher_ORG_CODE`, `OrgVoucher_STATUS`, `OrgVoucher_DATE_ADD`, `OrgVoucher_DATE_MOD`, `OrgVoucher_DISPLAY_STAT`) VALUES
(1, 'Vouch #00001', 'Demelyn', 'Patrick', 'CITS2019', 'Approved', '2018-05-26 10:29:02', '2018-05-26 10:29:02', 'Active');

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
) ENGINE=InnoDB DEFAULT CHARSET=latin1 ROW_FORMAT=COMPACT;

--
-- Truncate table before insert `t_org_voucher_items`
--

TRUNCATE TABLE `t_org_voucher_items`;
--
-- Dumping data for table `t_org_voucher_items`
--

INSERT INTO `t_org_voucher_items` (`OrgVouchItems_ID`, `OrgVouchItems_VOUCHER_NO`, `OrgVouchItems_ITEM_NAME`, `OrgVouchItems_AMOUNT`, `OrgVouchItems_DATE_ADD`, `OrgVouchItems_DATE_MOD`, `OrgVouchItems_DISPLAY_STAT`) VALUES
(2, 'Vouch #00001', 'Hello Chocolates', 100.000, '2018-05-26 10:29:03', '2018-05-26 10:29:03', 'Active'),
(1, 'Vouch #00001', 'Nova Chips', 100.000, '2018-05-26 10:29:03', '2018-05-26 10:29:03', 'Active'),
(3, 'Vouch #00001', 'Pandesal ', 200.000, '2018-05-26 10:29:03', '2018-05-26 10:29:03', 'Active');

--
-- Indexes for dumped tables
--

--
-- Indexes for table `active_academic_year`
--
ALTER TABLE `active_academic_year`
  ADD PRIMARY KEY (`ActiveAcadYear_ID`) USING BTREE,
  ADD KEY `FK_ActiveAcadYear_Batch_YEAR` (`ActiveAcadYear_Batch_YEAR`) USING BTREE;

--
-- Indexes for table `active_semester`
--
ALTER TABLE `active_semester`
  ADD PRIMARY KEY (`ActiveSemester_ID`) USING BTREE,
  ADD KEY `FK_ActiveSemester_SEMESTRAL_NAME` (`ActiveSemester_SEMESTRAL_NAME`) USING BTREE;

--
-- Indexes for table `log_sanction`
--
ALTER TABLE `log_sanction`
  ADD PRIMARY KEY (`LogSanc_ID`) USING BTREE,
  ADD KEY `FK_LogSanc_AssSancSudent_ID` (`LogSanc_AssSancSudent_ID`) USING BTREE;

--
-- Indexes for table `notif_announcement`
--
ALTER TABLE `notif_announcement`
  ADD PRIMARY KEY (`Notif_ID`) USING BTREE;

--
-- Indexes for table `r_application_wizard`
--
ALTER TABLE `r_application_wizard`
  ADD PRIMARY KEY (`WIZARD_ID`) USING BTREE,
  ADD UNIQUE KEY `WIZARD_ORG_CODE_2` (`WIZARD_ORG_CODE`) USING BTREE,
  ADD KEY `WIZARD_ORG_CODE` (`WIZARD_ORG_CODE`) USING BTREE;

--
-- Indexes for table `r_archiving_documents`
--
ALTER TABLE `r_archiving_documents`
  ADD PRIMARY KEY (`ArchDocuments_ID`) USING BTREE,
  ADD UNIQUE KEY `UNQ_ArchDocuments_ORDER_NO` (`ArchDocuments_ORDER_NO`) USING BTREE;

--
-- Indexes for table `r_assign_case_to_case_sanction`
--
ALTER TABLE `r_assign_case_to_case_sanction`
  ADD PRIMARY KEY (`Case_ID`) USING BTREE,
  ADD KEY `FK_Case_SancDetails_CODE` (`Case_SancDetails_CODE`) USING BTREE;

--
-- Indexes for table `r_batch_details`
--
ALTER TABLE `r_batch_details`
  ADD PRIMARY KEY (`Batch_ID`) USING BTREE,
  ADD UNIQUE KEY `UNQ_Batch_YEAR` (`Batch_YEAR`) USING BTREE;

--
-- Indexes for table `r_clearance_signatories`
--
ALTER TABLE `r_clearance_signatories`
  ADD PRIMARY KEY (`ClearSignatories_ID`) USING BTREE,
  ADD UNIQUE KEY `UNQ_SancDetails_CODE` (`ClearSignatories_CODE`) USING BTREE;

--
-- Indexes for table `r_courses`
--
ALTER TABLE `r_courses`
  ADD PRIMARY KEY (`Course_ID`) USING BTREE,
  ADD UNIQUE KEY `UNQ_Course_CODE` (`Course_CODE`) USING BTREE,
  ADD KEY `FK_Course_CURR_YEAR` (`Course_CURR_YEAR`) USING BTREE;

--
-- Indexes for table `r_designated_offices_details`
--
ALTER TABLE `r_designated_offices_details`
  ADD PRIMARY KEY (`DesOffDetails_ID`) USING BTREE,
  ADD UNIQUE KEY `UNQ_DesOffDetails_CODE` (`DesOffDetails_CODE`) USING BTREE;

--
-- Indexes for table `r_financial_assistance_title`
--
ALTER TABLE `r_financial_assistance_title`
  ADD PRIMARY KEY (`FinAssiTitle_ID`) USING BTREE,
  ADD UNIQUE KEY `UNQ_FinAssiTitle_NAME` (`FinAssiTitle_NAME`) USING BTREE;

--
-- Indexes for table `r_notification`
--
ALTER TABLE `r_notification`
  ADD PRIMARY KEY (`Notification_ID`) USING BTREE;

--
-- Indexes for table `r_org_accreditation_details`
--
ALTER TABLE `r_org_accreditation_details`
  ADD PRIMARY KEY (`OrgAccrDetail_ID`) USING BTREE,
  ADD UNIQUE KEY `UNQ_OrgAccrDetail_CODE` (`OrgAccrDetail_CODE`) USING BTREE;

--
-- Indexes for table `r_org_applicant_profile`
--
ALTER TABLE `r_org_applicant_profile`
  ADD PRIMARY KEY (`OrgAppProfile_ID`) USING BTREE,
  ADD UNIQUE KEY `UNQ_OrgAppProfile_ORG_CODE` (`OrgAppProfile_APPL_CODE`) USING BTREE;

--
-- Indexes for table `r_org_category`
--
ALTER TABLE `r_org_category`
  ADD PRIMARY KEY (`OrgCat_ID`) USING BTREE,
  ADD UNIQUE KEY `UNQ_OrgCat_NAME` (`OrgCat_CODE`) USING BTREE;

--
-- Indexes for table `r_org_essentials`
--
ALTER TABLE `r_org_essentials`
  ADD PRIMARY KEY (`OrgEssentials_ID`) USING BTREE,
  ADD KEY `FK_OrgEssentials_ORG_CODE` (`OrgEssentials_ORG_CODE`) USING BTREE;

--
-- Indexes for table `r_org_event_management`
--
ALTER TABLE `r_org_event_management`
  ADD PRIMARY KEY (`OrgEvent_ID`) USING BTREE,
  ADD UNIQUE KEY `UNQ_ORGEVENT_CODE` (`OrgEvent_Code`) USING BTREE,
  ADD KEY `FK_ORGEVENT_ORGCODE` (`OrgEvent_OrgCode`) USING BTREE;

--
-- Indexes for table `r_org_non_academic_details`
--
ALTER TABLE `r_org_non_academic_details`
  ADD PRIMARY KEY (`OrgNonAcad_ID`) USING BTREE,
  ADD UNIQUE KEY `UNQ_OrgNonAcad_CODE` (`OrgNonAcad_CODE`) USING BTREE,
  ADD UNIQUE KEY `UNQ_OrgNonAcad_NAME` (`OrgNonAcad_NAME`) USING BTREE;

--
-- Indexes for table `r_org_officer_position_details`
--
ALTER TABLE `r_org_officer_position_details`
  ADD PRIMARY KEY (`OrgOffiPosDetails_ID`) USING BTREE,
  ADD KEY `FK_OrgOffiPosDetails_ORG_CODE` (`OrgOffiPosDetails_ORG_CODE`) USING BTREE;

--
-- Indexes for table `r_osas_head`
--
ALTER TABLE `r_osas_head`
  ADD PRIMARY KEY (`OSASHead_ID`) USING BTREE,
  ADD UNIQUE KEY `UNQ_OSASHead_CODE` (`OSASHead_CODE`) USING BTREE;

--
-- Indexes for table `r_sanction_details`
--
ALTER TABLE `r_sanction_details`
  ADD PRIMARY KEY (`SancDetails_ID`) USING BTREE,
  ADD UNIQUE KEY `UNQ_SancDetails_CODE` (`SancDetails_CODE`) USING BTREE;

--
-- Indexes for table `r_semester`
--
ALTER TABLE `r_semester`
  ADD PRIMARY KEY (`Semestral_ID`) USING BTREE,
  ADD UNIQUE KEY `UNQ_Semstral_NAME` (`Semestral_NAME`) USING BTREE;

--
-- Indexes for table `r_stud_profile`
--
ALTER TABLE `r_stud_profile`
  ADD PRIMARY KEY (`Stud_ID`) USING BTREE,
  ADD UNIQUE KEY `PK_Stud_NO` (`Stud_NO`) USING BTREE,
  ADD KEY `FK_COURSE` (`Stud_COURSE`) USING BTREE;

--
-- Indexes for table `r_system_config`
--
ALTER TABLE `r_system_config`
  ADD PRIMARY KEY (`SysConfig_ID`) USING BTREE;

--
-- Indexes for table `r_users`
--
ALTER TABLE `r_users`
  ADD PRIMARY KEY (`Users_ID`) USING BTREE,
  ADD UNIQUE KEY `UNQ_Users_USERNAME` (`Users_USERNAME`) USING BTREE;

--
-- Indexes for table `t_assign_org_academic_course`
--
ALTER TABLE `t_assign_org_academic_course`
  ADD PRIMARY KEY (`AssOrgAcademic_ORG_CODE`,`AssOrgAcademic_COURSE_CODE`) USING BTREE,
  ADD UNIQUE KEY `UNQ_AssOrgAcademic_ID` (`AssOrgAcademic_ID`) USING BTREE,
  ADD KEY `FK_AssOrgAcademic_COURSE_CODE` (`AssOrgAcademic_COURSE_CODE`) USING BTREE;

--
-- Indexes for table `t_assign_org_category`
--
ALTER TABLE `t_assign_org_category`
  ADD PRIMARY KEY (`AssOrgCategory_ORG_CODE`,`AssOrgCategory_ORGCAT_CODE`) USING BTREE,
  ADD UNIQUE KEY `UNQ_AssOrgCategory_ID` (`AssOrgCategory_ID`) USING BTREE,
  ADD KEY `FK_AssOrgCategory_ORGCAT_CODE` (`AssOrgCategory_ORGCAT_CODE`) USING BTREE;

--
-- Indexes for table `t_assign_org_members`
--
ALTER TABLE `t_assign_org_members`
  ADD PRIMARY KEY (`AssOrgMem_STUD_NO`,`AssOrgMem_COMPL_ORG_CODE`) USING BTREE,
  ADD UNIQUE KEY `UNQ_AssOrgMem_ID` (`AssOrgMem_ID`) USING BTREE,
  ADD KEY `FK_AssOrgMem_COMPL_ORG_CODE` (`AssOrgMem_COMPL_ORG_CODE`) USING BTREE;

--
-- Indexes for table `t_assign_org_non_academic`
--
ALTER TABLE `t_assign_org_non_academic`
  ADD PRIMARY KEY (`AssOrgNonAcademic_ORG_CODE`) USING BTREE,
  ADD UNIQUE KEY `UNQ_AssOrgNonAcademic_ID` (`AssOrgNonAcademic_ID`) USING BTREE,
  ADD KEY `FK_AssOrgNonAcademic_NON_ACAD` (`AssOrgNonAcademic_NON_ACAD`) USING BTREE;

--
-- Indexes for table `t_assign_org_sanction`
--
ALTER TABLE `t_assign_org_sanction`
  ADD PRIMARY KEY (`AssSancOrgStudent_ID`) USING BTREE,
  ADD KEY `FK_AssSancOrgStudent_STUD_NO` (`AssSancOrgStudent_REG_ORG`) USING BTREE,
  ADD KEY `FK_AssSancOrgStudent_SancDetails_CODE` (`AssSancOrgStudent_SancDetails_CODE`) USING BTREE;

--
-- Indexes for table `t_assign_student_clearance`
--
ALTER TABLE `t_assign_student_clearance`
  ADD PRIMARY KEY (`AssStudClearance_STUD_NO`,`AssStudClearance_BATCH`,`AssStudClearance_SEMESTER`,`AssStudClearance_SIGNATORIES_CODE`) USING BTREE,
  ADD UNIQUE KEY `UNQ_AssStudClearance_ID` (`AssStudClearance_ID`) USING BTREE,
  ADD KEY `FK_AssStudClearance_SEMESTER` (`AssStudClearance_SEMESTER`) USING BTREE,
  ADD KEY `FK_AssStudClearance_SIGNATORIES_CODE` (`AssStudClearance_SIGNATORIES_CODE`) USING BTREE,
  ADD KEY `FK_AssStudClearance_BATCH` (`AssStudClearance_BATCH`) USING BTREE;

--
-- Indexes for table `t_assign_stud_finan_assistance`
--
ALTER TABLE `t_assign_stud_finan_assistance`
  ADD PRIMARY KEY (`AssStudFinanAssistance_STUD_NO`,`AssStudFinanAssistance_FINAN_NAME`) USING BTREE,
  ADD UNIQUE KEY `UNQ_AssStudFinanAssistance_ID` (`AssStudFinanAssistance_ID`) USING BTREE,
  ADD KEY `FK_AssStudFinanAssistance_FINAN_NAME` (`AssStudFinanAssistance_FINAN_NAME`) USING BTREE;

--
-- Indexes for table `t_assign_stud_loss_id_regicard`
--
ALTER TABLE `t_assign_stud_loss_id_regicard`
  ADD PRIMARY KEY (`AssLoss_ID`) USING BTREE,
  ADD KEY `FK_AssLoss_STUD_NO` (`AssLoss_STUD_NO`) USING BTREE;

--
-- Indexes for table `t_assign_stud_saction`
--
ALTER TABLE `t_assign_stud_saction`
  ADD PRIMARY KEY (`AssSancStudStudent_ID`) USING BTREE,
  ADD KEY `FK_AssSancStudStudent_STUD_NO` (`AssSancStudStudent_STUD_NO`) USING BTREE,
  ADD KEY `FK_AssSancStudStudent_DesOffDetails_CODE` (`AssSancStudStudent_DesOffDetails_CODE`) USING BTREE,
  ADD KEY `FK_AssSancStudStudent_SancDetails_CODE` (`AssSancStudStudent_SancDetails_CODE`) USING BTREE;

--
-- Indexes for table `t_clearance_generated_code`
--
ALTER TABLE `t_clearance_generated_code`
  ADD PRIMARY KEY (`ClearanceGenCode_STUD_NO`,`ClearanceGenCode_ACADEMIC_YEAR`,`ClearanceGenCode_SEMESTER`) USING BTREE,
  ADD UNIQUE KEY `UNQ_QRValStudClearance_ID` (`ClearanceGenCode_ID`) USING BTREE,
  ADD KEY `FK_QRValStudClearance_BATCH` (`ClearanceGenCode_ACADEMIC_YEAR`) USING BTREE,
  ADD KEY `FK_QRValStudClearance_SEMESTER` (`ClearanceGenCode_SEMESTER`) USING BTREE;

--
-- Indexes for table `t_org_accreditation_process`
--
ALTER TABLE `t_org_accreditation_process`
  ADD PRIMARY KEY (`OrgAccrProcess_ORG_CODE`,`OrgAccrProcess_OrgAccrDetail_CODE`) USING BTREE,
  ADD UNIQUE KEY `UNQ_OrgAccrProcess_ID` (`OrgAccrProcess_ID`) USING BTREE,
  ADD KEY `FK_OrgAccrProcess_OrgAccrDetail_CODE` (`OrgAccrProcess_OrgAccrDetail_CODE`) USING BTREE;

--
-- Indexes for table `t_org_cash_flow_statement`
--
ALTER TABLE `t_org_cash_flow_statement`
  ADD PRIMARY KEY (`OrgCashFlowStatement_ID`) USING BTREE,
  ADD KEY `FK_OrgCashFlowStatement_ORG_CODE` (`OrgCashFlowStatement_ORG_CODE`) USING BTREE;

--
-- Indexes for table `t_org_financial_statement`
--
ALTER TABLE `t_org_financial_statement`
  ADD PRIMARY KEY (`OrgFinStatement_ID`) USING BTREE,
  ADD KEY `FK_OrgFinStatement_ORG_CODE` (`OrgFinStatement_ORG_CODE`) USING BTREE,
  ADD KEY `FK_OrgFinStatement_SEMESTER` (`OrgFinStatement_SEMESTER`) USING BTREE;

--
-- Indexes for table `t_org_financial_statement_items`
--
ALTER TABLE `t_org_financial_statement_items`
  ADD PRIMARY KEY (`OrgFinStatExpenses_ID`) USING BTREE,
  ADD KEY `FK_OrgFinStatExpenses_OrgFinStatement_ID` (`OrgFinStatExpenses_OrgFinStatement_ID`) USING BTREE;

--
-- Indexes for table `t_org_for_compliance`
--
ALTER TABLE `t_org_for_compliance`
  ADD PRIMARY KEY (`OrgForCompliance_ID`) USING BTREE,
  ADD UNIQUE KEY `UNQ_OrgForCompliance_CODE` (`OrgForCompliance_ORG_CODE`) USING BTREE,
  ADD UNIQUE KEY `UNQ_OrgForCompliance_ORG_CODE` (`OrgForCompliance_ORG_CODE`) USING BTREE,
  ADD KEY `FK_OrgForCompliance_CODE` (`OrgForCompliance_OrgApplProfile_APPL_CODE`) USING BTREE,
  ADD KEY `FK_OR_ORG_FOUNDED_BATCH_YEAR` (`OrgForCompliance_BATCH_YEAR`) USING BTREE;

--
-- Indexes for table `t_org_officers`
--
ALTER TABLE `t_org_officers`
  ADD PRIMARY KEY (`OrgOffi_STUD_NO`,`OrgOffi_OrgOffiPosDetails_ID`) USING BTREE,
  ADD UNIQUE KEY `UNQ_OrgOffi_ID` (`OrgOffi_ID`) USING BTREE,
  ADD KEY `FK_OrgOffi_OrgOffiPosDetails_ID` (`OrgOffi_OrgOffiPosDetails_ID`) USING BTREE;

--
-- Indexes for table `t_org_remittance`
--
ALTER TABLE `t_org_remittance`
  ADD PRIMARY KEY (`OrgRemittance_ID`) USING BTREE,
  ADD KEY `FK_OrgRemittance_ORG_CODE` (`OrgRemittance_ORG_CODE`) USING BTREE;

--
-- Indexes for table `t_org_voucher`
--
ALTER TABLE `t_org_voucher`
  ADD PRIMARY KEY (`OrgVoucher_ID`) USING BTREE,
  ADD UNIQUE KEY `UNQ_OrgVoucher_CASH_VOUCHER_NO` (`OrgVoucher_CASH_VOUCHER_NO`) USING BTREE,
  ADD KEY `FK_OrgVoucher_ORG_CODE` (`OrgVoucher_ORG_CODE`) USING BTREE;

--
-- Indexes for table `t_org_voucher_items`
--
ALTER TABLE `t_org_voucher_items`
  ADD PRIMARY KEY (`OrgVouchItems_ITEM_NAME`,`OrgVouchItems_VOUCHER_NO`) USING BTREE,
  ADD UNIQUE KEY `UNQ_OrgVouchItems_ID` (`OrgVouchItems_ID`) USING BTREE,
  ADD KEY `FK_OrgVouchItems_VOUCHER_NO` (`OrgVouchItems_VOUCHER_NO`) USING BTREE;

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `active_academic_year`
--
ALTER TABLE `active_academic_year`
  MODIFY `ActiveAcadYear_ID` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=6;
--
-- AUTO_INCREMENT for table `active_semester`
--
ALTER TABLE `active_semester`
  MODIFY `ActiveSemester_ID` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=5;
--
-- AUTO_INCREMENT for table `log_sanction`
--
ALTER TABLE `log_sanction`
  MODIFY `LogSanc_ID` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=6;
--
-- AUTO_INCREMENT for table `notif_announcement`
--
ALTER TABLE `notif_announcement`
  MODIFY `Notif_ID` int(11) NOT NULL AUTO_INCREMENT;
--
-- AUTO_INCREMENT for table `r_application_wizard`
--
ALTER TABLE `r_application_wizard`
  MODIFY `WIZARD_ID` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2;
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
  MODIFY `Batch_ID` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=18;
--
-- AUTO_INCREMENT for table `r_clearance_signatories`
--
ALTER TABLE `r_clearance_signatories`
  MODIFY `ClearSignatories_ID` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=16;
--
-- AUTO_INCREMENT for table `r_courses`
--
ALTER TABLE `r_courses`
  MODIFY `Course_ID` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=14;
--
-- AUTO_INCREMENT for table `r_designated_offices_details`
--
ALTER TABLE `r_designated_offices_details`
  MODIFY `DesOffDetails_ID` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=14;
--
-- AUTO_INCREMENT for table `r_financial_assistance_title`
--
ALTER TABLE `r_financial_assistance_title`
  MODIFY `FinAssiTitle_ID` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=19;
--
-- AUTO_INCREMENT for table `r_notification`
--
ALTER TABLE `r_notification`
  MODIFY `Notification_ID` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=3;
--
-- AUTO_INCREMENT for table `r_org_accreditation_details`
--
ALTER TABLE `r_org_accreditation_details`
  MODIFY `OrgAccrDetail_ID` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=5;
--
-- AUTO_INCREMENT for table `r_org_applicant_profile`
--
ALTER TABLE `r_org_applicant_profile`
  MODIFY `OrgAppProfile_ID` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2;
--
-- AUTO_INCREMENT for table `r_org_category`
--
ALTER TABLE `r_org_category`
  MODIFY `OrgCat_ID` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=6;
--
-- AUTO_INCREMENT for table `r_org_essentials`
--
ALTER TABLE `r_org_essentials`
  MODIFY `OrgEssentials_ID` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2;
--
-- AUTO_INCREMENT for table `r_org_event_management`
--
ALTER TABLE `r_org_event_management`
  MODIFY `OrgEvent_ID` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=4;
--
-- AUTO_INCREMENT for table `r_org_non_academic_details`
--
ALTER TABLE `r_org_non_academic_details`
  MODIFY `OrgNonAcad_ID` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=3;
--
-- AUTO_INCREMENT for table `r_org_officer_position_details`
--
ALTER TABLE `r_org_officer_position_details`
  MODIFY `OrgOffiPosDetails_ID` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=17;
--
-- AUTO_INCREMENT for table `r_osas_head`
--
ALTER TABLE `r_osas_head`
  MODIFY `OSASHead_ID` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=3;
--
-- AUTO_INCREMENT for table `r_sanction_details`
--
ALTER TABLE `r_sanction_details`
  MODIFY `SancDetails_ID` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=20;
--
-- AUTO_INCREMENT for table `r_semester`
--
ALTER TABLE `r_semester`
  MODIFY `Semestral_ID` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=12;
--
-- AUTO_INCREMENT for table `r_stud_profile`
--
ALTER TABLE `r_stud_profile`
  MODIFY `Stud_ID` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=29;
--
-- AUTO_INCREMENT for table `r_system_config`
--
ALTER TABLE `r_system_config`
  MODIFY `SysConfig_ID` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2;
--
-- AUTO_INCREMENT for table `r_users`
--
ALTER TABLE `r_users`
  MODIFY `Users_ID` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=18;
--
-- AUTO_INCREMENT for table `t_assign_org_academic_course`
--
ALTER TABLE `t_assign_org_academic_course`
  MODIFY `AssOrgAcademic_ID` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2;
--
-- AUTO_INCREMENT for table `t_assign_org_category`
--
ALTER TABLE `t_assign_org_category`
  MODIFY `AssOrgCategory_ID` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2;
--
-- AUTO_INCREMENT for table `t_assign_org_members`
--
ALTER TABLE `t_assign_org_members`
  MODIFY `AssOrgMem_ID` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=8;
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
  MODIFY `AssStudClearance_ID` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=6;
--
-- AUTO_INCREMENT for table `t_assign_stud_finan_assistance`
--
ALTER TABLE `t_assign_stud_finan_assistance`
  MODIFY `AssStudFinanAssistance_ID` int(11) NOT NULL AUTO_INCREMENT;
--
-- AUTO_INCREMENT for table `t_assign_stud_loss_id_regicard`
--
ALTER TABLE `t_assign_stud_loss_id_regicard`
  MODIFY `AssLoss_ID` int(11) NOT NULL AUTO_INCREMENT;
--
-- AUTO_INCREMENT for table `t_assign_stud_saction`
--
ALTER TABLE `t_assign_stud_saction`
  MODIFY `AssSancStudStudent_ID` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=3;
--
-- AUTO_INCREMENT for table `t_clearance_generated_code`
--
ALTER TABLE `t_clearance_generated_code`
  MODIFY `ClearanceGenCode_ID` int(11) NOT NULL AUTO_INCREMENT;
--
-- AUTO_INCREMENT for table `t_org_accreditation_process`
--
ALTER TABLE `t_org_accreditation_process`
  MODIFY `OrgAccrProcess_ID` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=5;
--
-- AUTO_INCREMENT for table `t_org_cash_flow_statement`
--
ALTER TABLE `t_org_cash_flow_statement`
  MODIFY `OrgCashFlowStatement_ID` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=3;
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
  MODIFY `OrgForCompliance_ID` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2;
--
-- AUTO_INCREMENT for table `t_org_officers`
--
ALTER TABLE `t_org_officers`
  MODIFY `OrgOffi_ID` int(11) NOT NULL AUTO_INCREMENT;
--
-- AUTO_INCREMENT for table `t_org_remittance`
--
ALTER TABLE `t_org_remittance`
  MODIFY `OrgRemittance_ID` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2;
--
-- AUTO_INCREMENT for table `t_org_voucher`
--
ALTER TABLE `t_org_voucher`
  MODIFY `OrgVoucher_ID` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2;
--
-- AUTO_INCREMENT for table `t_org_voucher_items`
--
ALTER TABLE `t_org_voucher_items`
  MODIFY `OrgVouchItems_ID` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=4;
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
-- Constraints for table `t_clearance_generated_code`
--
ALTER TABLE `t_clearance_generated_code`
  ADD CONSTRAINT `FK_ClearanceGenCode_BATCH` FOREIGN KEY (`ClearanceGenCode_ACADEMIC_YEAR`) REFERENCES `r_batch_details` (`Batch_YEAR`) ON DELETE CASCADE ON UPDATE CASCADE,
  ADD CONSTRAINT `FK_ClearanceGenCode_SEMESTER` FOREIGN KEY (`ClearanceGenCode_SEMESTER`) REFERENCES `r_semester` (`Semestral_NAME`) ON DELETE CASCADE ON UPDATE CASCADE,
  ADD CONSTRAINT `FK_ClearanceGenCode_STUD_NO` FOREIGN KEY (`ClearanceGenCode_STUD_NO`) REFERENCES `r_stud_profile` (`Stud_NO`) ON DELETE CASCADE ON UPDATE CASCADE;

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

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
