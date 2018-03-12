-- phpMyAdmin SQL Dump
-- version 4.5.1
-- http://www.phpmyadmin.net
--
-- Host: 127.0.0.1
-- Generation Time: Mar 12, 2018 at 06:08 AM
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
CREATE DEFINER=`root`@`localhost` PROCEDURE `Archive_AssignSanction` (IN `ID` INT)  NO SQL
UPDATE `t_assign_stud_saction` SET `AssSancStudStudent_DISPLAY_STAT`='Inactive' 
,`AssSancStudStudent_DATE_MOD` = CURRENT_TIMESTAMP
WHERE
`AssSancStudStudent_ID` =ID$$

CREATE DEFINER=`root`@`localhost` PROCEDURE `Archive_FinancialAss` (IN `ID` INT(100))  NO SQL
delete from `t_assign_stud_finan_assistance`  
where AssStudFinanAssistance_ID = ID$$

CREATE DEFINER=`root`@`localhost` PROCEDURE `Archive_LossIDRegi` (IN `ID` INT)  NO SQL
update t_assign_stud_loss_id_regicard 
set AssLoss_DISPLAY_STAT ='Inactive'
where AssLoss_ID =ID$$

CREATE DEFINER=`root`@`localhost` PROCEDURE `FinishSanction` (IN `ID` INT)  NO SQL
UPDATE t_assign_stud_saction 
set AssSancStudStudent_IS_FINISH ='Finished'
where AssSancStudStudent_ID =ID$$

CREATE DEFINER=`root`@`localhost` PROCEDURE `Insert_AssignFinancialAss` (IN `StudNo` VARCHAR(15), IN `FinanAssTitle` VARCHAR(100), IN `FinanAssStatus` ENUM('Active','Inactive','Void','Cancelled'), IN `FinanAssRemarks` VARCHAR(500))  NO SQL
INSERT INTO `t_assign_stud_finan_assistance` (`AssStudFinanAssistance_STUD_NO`, `AssStudFinanAssistance_FINAN_NAME`, `AssStudFinanAssistance_STATUS`, `AssStudFinanAssistance_REMARKS`, `AssStudFinanAssistance_DATE_ADD`) VALUES (StudNo,FinanAssTitle , FinanAssStatus, FinanAssRemarks, CURRENT_TIMESTAMP)$$

CREATE DEFINER=`root`@`localhost` PROCEDURE `Insert_AssignSanction` (IN `StudNo` VARCHAR(15), IN `SancCode` VARCHAR(100), IN `DesOffCode` VARCHAR(15), IN `Cons` INT, IN `Finish` ENUM('Finished','Processing'), IN `remarks` VARCHAR(100))  NO SQL
INSERT INTO `t_assign_stud_saction`(`AssSancStudStudent_STUD_NO`, `AssSancStudStudent_SancDetails_CODE`, `AssSancStudStudent_DesOffDetails_CODE`,
`AssSancStudStudent_CONSUMED_HOURS`,
`AssSancStudStudent_IS_FINISH`,
`AssSancStudStudent_REMARKS`) VALUES (StudNo,SancCode,DesOffCode,Cons,Finish,remarks)$$

CREATE DEFINER=`root`@`localhost` PROCEDURE `Insert_DesignatedOffice` (IN `DesiCode` VARCHAR(15), IN `DesiName` VARCHAR(100), IN `DesiDesc` VARCHAR(100))  NO SQL
INSERT INTO `r_designated_offices_details` (  `DesOffDetails_CODE`, `DesOffDetails_NAME`, `DesOffDetails_DESC`) VALUES (DesiCode,DesiName,DesiDesc)$$

CREATE DEFINER=`root`@`localhost` PROCEDURE `Insert_LossIDRegi` (IN `StudNo` VARCHAR(15), IN `Type` ENUM('Identification Card','Registration Card'), IN `Claim` DATETIME, IN `Remarks` VARCHAR(500))  NO SQL
INSERT INTO `t_assign_stud_loss_id_regicard` ( `AssLoss_STUD_NO`, `AssLoss_TYPE`, `AssLoss_REMARKS`, `AssLoss_DATE_CLAIM`) VALUES (StudNo,Type,Remarks,Claim)$$

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

CREATE DEFINER=`root`@`localhost` PROCEDURE `Insert_Users` (IN `Username` VARCHAR(15), IN `referencedUser` VARCHAR(15), IN `userRole` ENUM('Administrator','OSAS HEAD','Organization','Student'), IN `UPassword` VARCHAR(500))  NO SQL
INSERT INTO `r_users` (`Users_USERNAME`, `Users_REFERENCED`, `Users_ROLES`,`Users_PASSWORD`) VALUES (Username,referencedUser,userRole,AES_Encrypt(UPassword,PASSWORD('OSASMIS')))$$

CREATE DEFINER=`root`@`localhost` PROCEDURE `Login_User` (IN `username` VARCHAR(100), IN `password` VARCHAR(100))  NO SQL
SELECT * 
FROM osas.r_users 
WHERE Users_USERNAME = username 
AND AES_DECRYPT(Users_PASSWORD , Password('OSASMIS')) =password
AND Users_DISPLAY_STAT = 'Active'$$

CREATE DEFINER=`root`@`localhost` PROCEDURE `Update_AssignFinancialAss` (IN `ID` INT, IN `FinanAssStat` ENUM('Active','Inactive','Void','Cancelled'), IN `Remarks` VARCHAR(500))  NO SQL
UPDATE `t_assign_stud_finan_assistance` 
SET `AssStudFinanAssistance_STATUS` = FinanAssStat 
,`AssStudFinanAssistance_REMARKS` = Remarks
,`AssStudFinanAssistance_DATE_MOD` = CURRENT_TIMESTAMP
WHERE `AssStudFinanAssistance_ID` = ID$$

CREATE DEFINER=`root`@`localhost` PROCEDURE `Update_AssignSanction` (IN `ID` INT, IN `Consume` INT, IN `Finish` ENUM('Finished','Processing'), IN `remarks` VARCHAR(100))  NO SQL
UPDATE `t_assign_stud_saction` SET 
`AssSancStudStudent_CONSUMED_HOURS` =Consume
,`AssSancStudStudent_IS_FINISH` = Finish
,`AssSancStudStudent_REMARKS` = remarks
,`AssSancStudStudent_DATE_MOD` = CURRENT_TIMESTAMP
WHERE
`AssSancStudStudent_ID` =ID$$

CREATE DEFINER=`root`@`localhost` PROCEDURE `Update_LossIDRegi` (IN `ID` INT, IN `Claim` DATETIME, IN `Remarks` VARCHAR(500))  NO SQL
update t_assign_stud_loss_id_regicard 
set AssLoss_DATE_CLAIM = Claim
,AssLoss_REMARKS = Remarks
where AssLoss_ID =ID$$

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

CREATE DEFINER=`root`@`localhost` PROCEDURE `View_Courses` ()  NO SQL
select * from r_courses where course_display_stat ='active'$$

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
-- Table structure for table `r_archiving_documents`
--

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
-- Table structure for table `r_batch_details`
--

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
(1, 'BAT00001', '2011-2012', 'Batch descriptions', 'Active'),
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
(3, 'SIG00003', 'Academic Affairs', 'Academic Affairs', '2018-02-11 21:34:00', '2018-02-11 21:34:00', 'Active');

-- --------------------------------------------------------

--
-- Table structure for table `r_courses`
--

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
(1, 'BSIT', 'Bachelor of Science in Information Technology', 'Course Description', '2011-2012', '2018-03-11 20:38:21', '2018-02-07 18:41:43', 'Active'),
(2, 'DOMT', 'Diploma In Office Management Technology', 'Course Description', '2011-2012', '2018-02-09 17:54:51', '2018-02-09 17:54:51', 'Active'),
(3, 'DICT', 'Diploma in Information Communication Technology', 'Diploma in Information Communication Technology', '2011-2012', '2018-03-11 20:40:22', '2018-03-11 20:40:22', 'Active');

-- --------------------------------------------------------

--
-- Table structure for table `r_designated_offices_details`
--

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
(2, 'ADDOFF', 'Admission Office', 'Offices Description', '2018-02-13 11:18:42', '2018-03-11 21:00:26', 'Active'),
(3, 'CR MISE', 'Comfort Room', 'CR sa mise', '2018-02-22 00:31:04', '2018-02-22 00:31:04', 'Active');

-- --------------------------------------------------------

--
-- Table structure for table `r_financial_assistance_title`
--

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
(2, 'Finan0002', 'SYDP', 'Quezon City Government - Scholarship & Youth Development Program', '2018-02-09 17:55:45', '2018-02-09 17:55:45', 'Active');

-- --------------------------------------------------------

--
-- Table structure for table `r_org_accreditation_details`
--

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
(2, 'REQ00002', 'Organization must have mission and vision', 'Every organization must have a mission and vision', '2018-03-11 20:23:02', '2018-03-11 20:23:35', 'Active');

-- --------------------------------------------------------

--
-- Table structure for table `r_org_applicant_profile`
--

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
(1, 'CITS2011', 'Commonwealth Information Technology Society', 'Organization description should be here!', 'This application is ready for accreditation', '2018-02-09 17:56:43', '2018-03-01 20:03:28', 'Active');

-- --------------------------------------------------------

--
-- Table structure for table `r_org_category`
--

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
(1, 'ACAD_ORG', 'Academic Organization', 'Academic Organization', '2018-02-08 14:39:16', '2018-03-11 21:24:35', 'Active');

-- --------------------------------------------------------

--
-- Table structure for table `r_org_essentials`
--

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
(8, 'CITS2013', 'Mission', 'Vision', '', '2018-03-05 20:35:02', '2018-03-05 20:35:02', 'Active'),
(10, 'CITS2014', '1', '2', '', '2018-03-06 02:02:26', '2018-03-06 02:02:26', 'Active');

-- --------------------------------------------------------

--
-- Table structure for table `r_org_officer_position_details`
--

CREATE TABLE `r_org_officer_position_details` (
  `OrgOffiPosDetails_ID` int(11) NOT NULL,
  `OrgOffiPosDetails_ORG_CODE` varchar(15) NOT NULL,
  `OrgOffiPosDetails_NAME` varchar(100) NOT NULL,
  `OrgOffiPosDetails_DESC` varchar(100) NOT NULL DEFAULT 'Office Position Description',
  `OrgOffiPosDetails_DATE_MOD` datetime NOT NULL DEFAULT CURRENT_TIMESTAMP,
  `OrgOffiPosDetails_DATE_ADD` datetime NOT NULL DEFAULT CURRENT_TIMESTAMP,
  `OrgOffiPosDetails_DISPLAY_STAT` enum('Active','Inactive') DEFAULT 'Active'
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `r_org_officer_position_details`
--

INSERT INTO `r_org_officer_position_details` (`OrgOffiPosDetails_ID`, `OrgOffiPosDetails_ORG_CODE`, `OrgOffiPosDetails_NAME`, `OrgOffiPosDetails_DESC`, `OrgOffiPosDetails_DATE_MOD`, `OrgOffiPosDetails_DATE_ADD`, `OrgOffiPosDetails_DISPLAY_STAT`) VALUES
(1, 'COMMITS2017', 'President', 'Office Position Description', '2018-02-09 18:05:46', '2018-02-09 18:05:46', 'Active');

-- --------------------------------------------------------

--
-- Table structure for table `r_osas_head`
--

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
(1, '2.1 3rdOffense', '3rd Offense Failure to bring valid ID', '2.1 failure to bring valid ID in case the student can present his/her registration certificate', 42, '2018-02-12 01:48:39', '2018-02-12 01:48:39', 'Active'),
(2, '2.1 < 3 Offense', 'Greater than 3Offenses, Failure to bring valid ID', 'minimum of 3 days suspension', 72, '2018-03-11 21:32:19', '2018-02-12 02:46:57', 'Active'),
(8, '123', '123', '', 123, '2018-03-01 20:05:13', '2018-02-21 23:54:35', 'Inactive'),
(9, 'asd', '123123', '', 12, '2018-03-01 20:05:19', '2018-02-21 23:55:11', 'Inactive'),
(10, 'SANC00005', 'sanc1', 'asd', 8, '2018-03-11 21:31:09', '2018-03-01 20:05:55', 'Inactive'),
(11, 'wqe', 'qwe', '123', 21, '2018-03-11 21:37:47', '2018-03-11 21:37:24', 'Inactive');

-- --------------------------------------------------------

--
-- Table structure for table `r_semester`
--

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
(1, 'Sem001', 'First Semester', 'Semester Description', '2018-02-09 18:07:00', '2018-02-09 18:07:00', 'Active'),
(2, 'Sem002', 'Second Semester', 'Semester Description', '2018-02-09 18:07:00', '2018-02-09 18:07:00', 'Active');

-- --------------------------------------------------------

--
-- Table structure for table `r_stud_profile`
--

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
(10, '2015-00001-CM-0', 'Sample fname', 'Mname', 'Lname', 'DOMT', 1, '1', 'Male', 'Emailad@email.com', 'None', '1998-02-10', 'Quezon City', 'Hulaan mo', 'Regular', '2018-02-18 09:47:13', '2018-02-10 22:58:01', NULL, 'Active'),
(36, '2016-00303-CM-0', 'Joana Rose', 'Balmonte', 'Loyola', 'BSIT', 1, '1', 'Female', 'joanaloyola@gmail.com', '099995251071', '1999-10-26', 'Quezon City', 'please see the address of 2015-00073-CM-0', 'Regular', '2018-02-12 11:36:57', '2018-02-11 22:05:44', NULL, 'Active'),
(40, '20', '1', '1', '1', 'DOMT', 1, '1', 'Male', '1212', '11', '2018-01-30', '1', '1', 'Regular', '2018-02-12 00:06:42', '2018-02-11 23:11:43', NULL, 'Inactive'),
(41, '123', '12', '123', '123', 'BSIT', 1, '1', 'Male', '123', '123', '1988-02-13', '123', '213', 'Regular', '2018-02-12 00:09:25', '2018-02-11 23:39:08', NULL, 'Inactive'),
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
(4, 'Patrick', '', 0x852fa0a245a1467fcfd3e79a8c1bb0c9, 'Administrator', NULL, '2018-03-12 02:41:39', '2018-03-12 02:41:39', 'Active');

-- --------------------------------------------------------

--
-- Table structure for table `t_assign_org_academic_course`
--

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
(9, 'CITS2013', 'BSIT', '2018-03-05 20:35:02', '2018-03-05 20:35:02', 'Active'),
(11, 'CITS2014', 'BSIT', '2018-03-06 02:02:26', '2018-03-06 02:02:26', 'Active'),
(1, 'COMMITS2017', 'BSIT', '2018-02-09 18:07:21', '2018-02-09 18:07:21', 'Active');

-- --------------------------------------------------------

--
-- Table structure for table `t_assign_org_category`
--

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
(9, 'CITS2013', 'ACAD_ORG', '2018-03-05 20:35:02', '2018-03-05 20:35:02', 'Active'),
(11, 'CITS2014', 'ACAD_ORG', '2018-03-06 02:02:26', '2018-03-06 02:02:26', 'Active'),
(1, 'COMMITS2017', 'ACAD_ORG', '2018-02-09 18:08:20', '2018-02-09 18:08:20', 'Active');

-- --------------------------------------------------------

--
-- Table structure for table `t_assign_org_sanction`
--

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
(30, '2015-00046-CM-0', 'CHED', 'Active', 'as', '2018-03-05 18:55:22', '2018-03-05 18:55:22', 'Active'),
(31, '2015-00194-CM-0', 'CHED', 'Active', '', '2018-03-06 11:00:25', '2018-03-06 11:00:25', 'Active'),
(29, '2015-00194-CM-0', 'SYDP', 'Active', '', '2018-03-04 22:44:24', '2018-03-07 22:50:34', 'Active');

-- --------------------------------------------------------

--
-- Table structure for table `t_assign_stud_loss_id_regicard`
--

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
(1, '2015-00410-CM-0', 'Registration Card', '', '2018-03-19 00:00:00', '2018-03-01 03:25:35', '2018-03-01 03:25:35', 'Active'),
(2, '2015-00046-CM-0', 'Registration Card', '', '2018-03-01 13:38:00', '2018-03-01 13:38:24', '2018-03-01 13:38:24', 'Active'),
(3, '2015-00194-CM-0', 'Registration Card', 'ds', '2018-12-12 11:11:00', '2018-03-01 15:44:37', '2018-03-01 15:44:37', 'Inactive'),
(4, '2015-00410-CM-0', 'Registration Card', '', '2018-03-09 17:59:19', '2018-03-10 00:59:19', '2018-03-10 00:59:19', 'Active');

-- --------------------------------------------------------

--
-- Table structure for table `t_assign_stud_saction`
--

CREATE TABLE `t_assign_stud_saction` (
  `AssSancStudStudent_ID` int(11) NOT NULL,
  `AssSancStudStudent_STUD_NO` varchar(15) NOT NULL,
  `AssSancStudStudent_SancDetails_CODE` varchar(100) NOT NULL,
  `AssSancStudStudent_DesOffDetails_CODE` varchar(15) NOT NULL,
  `AssSancStudStudent_CONSUMED_HOURS` int(11) DEFAULT '0',
  `AssSancStudStudent_REMARKS` varchar(100) DEFAULT NULL,
  `AssSancStudStudent_IS_FINISH` enum('Processing','Finished') NOT NULL DEFAULT 'Processing',
  `AssSancStudStudent_DATE_ADD` datetime NOT NULL DEFAULT CURRENT_TIMESTAMP,
  `AssSancStudStudent_DATE_MOD` datetime NOT NULL DEFAULT CURRENT_TIMESTAMP,
  `AssSancStudStudent_DISPLAY_STAT` enum('Active','Inactive') DEFAULT 'Active'
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `t_assign_stud_saction`
--

INSERT INTO `t_assign_stud_saction` (`AssSancStudStudent_ID`, `AssSancStudStudent_STUD_NO`, `AssSancStudStudent_SancDetails_CODE`, `AssSancStudStudent_DesOffDetails_CODE`, `AssSancStudStudent_CONSUMED_HOURS`, `AssSancStudStudent_REMARKS`, `AssSancStudStudent_IS_FINISH`, `AssSancStudStudent_DATE_ADD`, `AssSancStudStudent_DATE_MOD`, `AssSancStudStudent_DISPLAY_STAT`) VALUES
(1, '2015-00265-CM-0', '2.1 3rdOffense', 'OFF00001', 10, NULL, 'Processing', '2018-02-12 02:27:05', '2018-02-15 09:51:50', 'Inactive'),
(2, '2015-00265-CM-0', '2.1 < 3 Offense', 'OFF00001', 0, NULL, 'Processing', '2018-02-12 02:48:05', '2018-02-15 10:09:46', 'Inactive'),
(3, '2016-00303-CM-0', '2.1 3rdOffense', 'OFF00001', 17, NULL, 'Processing', '2018-02-12 03:01:56', '2018-02-15 14:35:29', 'Active'),
(4, '2016-00303-CM-0', '2.1 < 3 Offense', 'OFF00001', 72, NULL, 'Finished', '2018-02-12 14:52:22', '2018-02-25 18:23:49', 'Active'),
(18, '2015-00265-CM-0', '2.1 3rdOffense', 'OFF00001', 0, NULL, 'Processing', '2018-02-14 00:10:49', '2018-02-15 10:05:42', 'Inactive'),
(19, '2015-00265-CM-0', '2.1 3rdOffense', 'OFF00001', 0, NULL, 'Processing', '2018-02-14 00:11:26', '2018-02-15 10:09:34', 'Inactive'),
(20, '2015-00265-CM-0', '2.1 3rdOffense', 'OFF00001', 42, NULL, 'Processing', '2018-02-14 00:11:26', '2018-02-15 11:30:34', 'Active'),
(21, '2015-00265-CM-0', '2.1 3rdOffense', 'ADDOFF', 0, NULL, 'Processing', '2018-02-14 00:11:44', '2018-02-15 10:06:43', 'Inactive'),
(22, '2015-00046-CM-0', '2.1 3rdOffense', 'OFF00001', 10, NULL, 'Processing', '2018-02-14 00:11:55', '2018-02-15 11:44:24', 'Inactive'),
(23, '2015-00572-CM-0', '2.1 3rdOffense', 'OFF00001', 0, NULL, 'Processing', '2018-02-14 00:12:17', '2018-02-16 15:47:47', 'Inactive'),
(24, '2015-00410-CM-0', '2.1 3rdOffense', 'OFF00001', 0, NULL, 'Processing', '2018-02-14 00:12:35', '2018-02-16 15:47:52', 'Inactive'),
(25, '2014-00119-CM-0', '2.1 3rdOffense', 'OFF00001', 2, NULL, 'Processing', '2018-02-14 00:13:03', '2018-02-21 20:54:54', 'Active'),
(26, '2015-00394-cm-0', '2.1 3rdOffense', 'OFF00001', 0, NULL, 'Processing', '2018-02-14 00:13:21', '2018-02-19 08:43:57', 'Inactive'),
(27, '2015-00001-CM-0', '2.1 3rdOffense', 'OFF00001', 10, NULL, 'Processing', '2018-02-14 00:21:05', '2018-02-25 17:56:27', 'Active'),
(28, '2015-00046-CM-0', '2.1 3rdOffense', 'OFF00001', 2, NULL, 'Processing', '2018-02-14 00:21:27', '2018-02-16 15:47:40', 'Inactive'),
(29, '2015-00265-CM-0', '2.1 < 3 Offense', 'ADDOFF', 0, NULL, 'Processing', '2018-02-15 08:12:31', '2018-02-15 10:06:19', 'Inactive'),
(30, '2015-00265-CM-0', '2.1 3rdOffense', 'OFF00001', 42, NULL, 'Processing', '2018-02-15 09:08:13', '2018-02-15 11:30:45', 'Active'),
(31, '2015-00265-CM-0', '2.1 3rdOffense', 'OFF00001', 0, NULL, 'Processing', '2018-02-15 09:31:20', '2018-02-15 10:17:03', 'Inactive'),
(33, '2015-00265-CM-0', '2.1 3rdOffense', 'OFF00001', 0, NULL, 'Processing', '2018-02-15 10:06:19', '2018-02-15 10:17:03', 'Inactive'),
(34, '2015-00265-CM-0', '2.1 3rdOffense', 'OFF00001', 0, NULL, 'Processing', '2018-02-15 10:06:20', '2018-02-15 10:17:04', 'Inactive'),
(35, '2015-00265-CM-0', '2.1 3rdOffense', 'OFF00001', 0, NULL, 'Processing', '2018-02-15 10:06:42', '2018-02-15 10:17:04', 'Inactive'),
(36, '2015-00265-CM-0', '2.1 3rdOffense', 'OFF00001', 0, NULL, 'Processing', '2018-02-15 10:06:43', '2018-02-15 10:17:04', 'Inactive'),
(37, '2015-00265-CM-0', '2.1 3rdOffense', 'OFF00001', 0, NULL, 'Processing', '2018-02-15 10:07:02', '2018-02-15 10:17:04', 'Inactive'),
(38, '2015-00265-CM-0', '2.1 3rdOffense', 'OFF00001', 0, NULL, 'Processing', '2018-02-15 10:07:02', '2018-02-15 10:17:05', 'Inactive'),
(39, '2015-00265-CM-0', '2.1 3rdOffense', 'OFF00001', 0, NULL, 'Processing', '2018-02-15 10:07:15', '2018-02-15 10:17:05', 'Inactive'),
(40, '2015-00265-CM-0', '2.1 3rdOffense', 'OFF00001', 0, NULL, 'Processing', '2018-02-15 10:07:15', '2018-02-15 10:17:06', 'Inactive'),
(41, '2015-00265-CM-0', '2.1 3rdOffense', 'ADDOFF', 0, NULL, 'Processing', '2018-02-15 10:09:45', '2018-02-15 10:17:06', 'Inactive'),
(42, '2015-00265-CM-0', '2.1 3rdOffense', 'OFF00001', 42, NULL, 'Processing', '2018-02-15 11:26:54', '2018-02-15 11:30:46', 'Active'),
(43, '2016-00303-CM-0', '2.1 3rdOffense', 'ADDOFF', 3, NULL, 'Processing', '2018-02-15 20:28:16', '2018-02-19 05:49:24', 'Active'),
(44, '2015-00410-CM-0', '2.1 3rdOffense', 'OFF00001', 9, NULL, 'Processing', '2018-02-16 15:48:01', '2018-02-19 05:49:13', 'Active'),
(45, '2015-00572-CM-0', '2.1 3rdOffense', 'OFF00001', 42, NULL, 'Finished', '2018-02-16 15:50:10', '2018-02-25 17:57:39', 'Active'),
(46, '2015-00572-CM-0', '2.1 3rdOffense', 'OFF00001', 42, NULL, 'Finished', '2018-02-16 15:50:22', '2018-02-25 17:57:40', 'Active'),
(47, '2015-00572-CM-0', '2.1 3rdOffense', 'OFF00001', 42, NULL, 'Finished', '2018-02-16 15:50:32', '2018-02-25 17:57:40', 'Active'),
(48, '2015-00194-CM-0', '2.1 3rdOffense', 'OFF00001', 42, NULL, 'Finished', '2018-02-18 09:48:56', '2018-02-25 17:19:57', 'Active'),
(49, '2015-00194-CM-0', '2.1 3rdOffense', 'OFF00001', 2, NULL, 'Processing', '2018-02-18 12:35:54', '2018-02-18 12:35:54', 'Active'),
(50, '2015-00194-CM-0', '2.1 3rdOffense', 'OFF00001', 42, NULL, 'Finished', '2018-02-18 12:37:56', '2018-02-25 17:59:55', 'Active'),
(51, '2015-00194-CM-0', '2.1 3rdOffense', 'OFF00001', 10, NULL, 'Processing', '2018-02-18 12:47:59', '2018-02-19 10:16:15', 'Inactive'),
(52, '2014-00114-CM-0', '2.1 3rdOffense', 'ADDOFF', 2, 'os', 'Processing', '2018-02-19 17:57:55', '2018-03-10 00:56:19', 'Active'),
(53, '2015-00410-CM-0', '2.1 3rdOffense', 'OFF00001', 42, NULL, 'Finished', '2018-02-21 13:58:16', '2018-02-25 18:20:30', 'Active'),
(54, '2015-00394-cm-0', '2.1 < 3 Offense', 'OFF00001', 10, NULL, 'Processing', '2018-02-21 22:20:28', '2018-02-21 22:20:28', 'Active'),
(55, '2015-00194-CM-0', '2.1 3rdOffense', 'CR MISE', 0, NULL, 'Processing', '2018-02-22 00:33:27', '2018-02-22 00:33:47', 'Inactive'),
(56, '2016-00303-CM-0', '2.1 3rdOffense', 'CR MISE', 0, NULL, 'Processing', '2018-02-22 00:34:01', '2018-02-22 00:34:01', 'Active'),
(57, '2015-00046-CM-0', '2.1 3rdOffense', 'OFF00001', 0, NULL, 'Processing', '2018-02-25 18:29:30', '2018-02-26 03:04:51', 'Inactive'),
(58, '2015-00046-CM-0', '2.1 3rdOffense', 'ADDOFF', 20, 'OK', 'Processing', '2018-02-25 18:29:53', '2018-03-07 17:17:13', 'Inactive'),
(59, '2015-00046-CM-0', '2.1 < 3 Offense', 'OFF00001', 5, '', 'Processing', '2018-02-26 01:54:26', '2018-03-07 17:17:21', 'Inactive'),
(60, '2015-00046-CM-0', '2.1 3rdOffense', 'OFF00001', 0, 'q', 'Processing', '2018-02-26 01:54:26', '2018-03-07 17:17:21', 'Inactive'),
(61, '2015-00046-CM-0', '123', 'OFF00001', 0, 'ITO DIN NEW', 'Processing', '2018-02-26 02:05:07', '2018-02-26 03:04:51', 'Inactive'),
(62, '2015-00046-CM-0', '2.1 3rdOffense', 'OFF00001', 0, 'NEW', 'Processing', '2018-02-26 03:00:01', '2018-02-26 03:04:51', 'Inactive'),
(63, '2015-00046-CM-0', '2.1 3rdOffense', 'OFF00001', 0, 'MESS', 'Processing', '2018-02-26 03:02:19', '2018-02-26 03:04:50', 'Inactive'),
(64, '2015-00046-CM-0', '2.1 3rdOffense', 'OFF00001', 42, 'excused', 'Finished', '2018-02-26 07:45:55', '2018-03-07 17:16:55', 'Inactive'),
(65, '2015-00046-CM-0', '2.1 3rdOffense', 'ADDOFF', 42, 'new', 'Finished', '2018-02-26 07:47:13', '2018-02-26 07:47:32', 'Inactive'),
(66, '2015-00202-CM-0', '2.1 3rdOffense', 'OFF00001', 42, '', 'Finished', '2018-02-26 08:59:12', '2018-03-04 18:48:06', 'Active'),
(67, '2015-00046-CM-0', '2.1 < 3 Offense', 'ADDOFF', 72, 'excused', 'Finished', '2018-03-01 15:38:44', '2018-03-10 01:22:07', 'Active'),
(68, '2015-00046-CM-0', 'SANC00005', 'OFF00001', 1, '', 'Processing', '2018-03-01 20:06:11', '2018-03-07 17:18:02', 'Active'),
(69, '2015-00394-cm-0', '2.1 3rdOffense', 'OFF00001', 42, 'as', 'Finished', '2018-03-07 16:42:11', '2018-03-07 17:02:15', 'Active'),
(70, '2015-00394-cm-0', 'SANC00005', 'OFF00001', 0, 'sanction', 'Processing', '2018-03-07 16:43:44', '2018-03-07 17:01:58', 'Active');

-- --------------------------------------------------------

--
-- Table structure for table `t_org_accreditation_process`
--

CREATE TABLE `t_org_accreditation_process` (
  `OrgAccrProcess_ID` int(11) NOT NULL,
  `OrgAccrProcess_ORG_CODE` varchar(15) NOT NULL,
  `OrgAccrProcess_OrgAccrDetail_CODE` varchar(15) NOT NULL,
  `OrgAccrProcess_IS_ACCREDITED` int(11) NOT NULL DEFAULT '0',
  `OrgAccrProcess_DATE_ADD` datetime NOT NULL DEFAULT CURRENT_TIMESTAMP,
  `OrgAccrProcess_DATE_MOD` datetime NOT NULL DEFAULT CURRENT_TIMESTAMP,
  `OrgAccrProcess_DISPLAY_STAT` enum('Active','Inactive') DEFAULT 'Active'
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

-- --------------------------------------------------------

--
-- Table structure for table `t_org_cash_flow_statement`
--

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

-- --------------------------------------------------------

--
-- Table structure for table `t_org_financial_statement`
--

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
(1, 'COMMITS2017', 'CITS2011', 'Organization Adviser should be here!', '2017-2018', '2018-02-09 18:01:19', '2018-03-05 20:33:57', 'Inactive'),
(9, 'CITS2013', 'CITS2011', 'Alma Fernandez', '2013-2014', '2018-03-05 20:35:02', '2018-03-05 20:35:02', 'Active'),
(11, 'CITS2014', 'CITS2011', 'Alma Fermamdez', '2014-2015', '2018-03-06 02:02:25', '2018-03-06 02:02:25', 'Active');

-- --------------------------------------------------------

--
-- Table structure for table `t_org_officers`
--

CREATE TABLE `t_org_officers` (
  `OrgOffi_ID` int(11) NOT NULL,
  `OrgOffi_OrgOffiPosDetails_ID` int(11) NOT NULL,
  `OrgOffi_STUD_NO` varchar(15) NOT NULL,
  `OrgOffi_BATCH_YEAR` varchar(15) NOT NULL,
  `OrgOffi_DATE_ADD` datetime NOT NULL DEFAULT CURRENT_TIMESTAMP,
  `OrgOffi_DATE_MODIFIED` datetime NOT NULL DEFAULT CURRENT_TIMESTAMP,
  `OrgOffi_DISPLAY_STAT` enum('Active','Inactive') DEFAULT 'Active'
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `t_org_officers`
--

INSERT INTO `t_org_officers` (`OrgOffi_ID`, `OrgOffi_OrgOffiPosDetails_ID`, `OrgOffi_STUD_NO`, `OrgOffi_BATCH_YEAR`, `OrgOffi_DATE_ADD`, `OrgOffi_DATE_MODIFIED`, `OrgOffi_DISPLAY_STAT`) VALUES
(1, 1, '2015-00194-CM-0', '2017-2018', '2018-03-10 15:20:04', '2018-03-10 15:20:04', 'Active');

-- --------------------------------------------------------

--
-- Table structure for table `t_org_remittance`
--

CREATE TABLE `t_org_remittance` (
  `OrgRemittance_ID` int(11) NOT NULL,
  `OrgRemittance_ORG_CODE` varchar(15) NOT NULL,
  `OrgRemittance_SEND_BY` varchar(100) NOT NULL,
  `OrgRemittance_REC_BY` varchar(100) NOT NULL,
  `OrgRemittance_AMOUNT` double(10,3) NOT NULL,
  `OrgRemittance_DESC` varchar(100) DEFAULT 'Remittance Description',
  `OrgRemittance_DATE_ADD` datetime NOT NULL DEFAULT CURRENT_TIMESTAMP,
  `OrgRemittance_DATE_MOD` datetime NOT NULL DEFAULT CURRENT_TIMESTAMP,
  `OrgRemittance_DISPLAY_STAT` enum('Active','Inactive') DEFAULT 'Active'
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

-- --------------------------------------------------------

--
-- Table structure for table `t_org_voucher`
--

CREATE TABLE `t_org_voucher` (
  `OrgVoucher_ID` int(11) NOT NULL,
  `OrgVoucher_CASH_VOUCHER_NO` int(11) NOT NULL,
  `OrgVoucher_ORG_CODE` varchar(15) NOT NULL,
  `OrgVoucher_DATE_ADD` datetime NOT NULL DEFAULT CURRENT_TIMESTAMP,
  `OrgVoucher_DATE_MOD` datetime NOT NULL DEFAULT CURRENT_TIMESTAMP,
  `OrgVoucher_DISPLAY_STAT` enum('Active','Inactive') DEFAULT 'Active'
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

-- --------------------------------------------------------

--
-- Table structure for table `t_org_voucher_items`
--

CREATE TABLE `t_org_voucher_items` (
  `OrgVouchItems_ID` int(11) NOT NULL,
  `OrgVouchItems_VOUCHER_NO` int(11) NOT NULL,
  `OrgVouchItems_ITEM_NAME` varchar(100) NOT NULL,
  `OrgVouchItems_AMOUNT` double(10,3) NOT NULL DEFAULT '0.000',
  `OrgVouchItems_DATE_ADD` datetime NOT NULL DEFAULT CURRENT_TIMESTAMP,
  `OrgVouchItems_DATE_MOD` datetime NOT NULL DEFAULT CURRENT_TIMESTAMP,
  `OrgVouchItems_DISPLAY_STAT` enum('Active','Inactive') DEFAULT 'Active'
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

-- --------------------------------------------------------

--
-- Table structure for table `t_qrval_student_clearance`
--

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
-- Indexes for table `r_archiving_documents`
--
ALTER TABLE `r_archiving_documents`
  ADD PRIMARY KEY (`ArchDocuments_ID`),
  ADD UNIQUE KEY `UNQ_ArchDocuments_ORDER_NO` (`ArchDocuments_ORDER_NO`);

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
  ADD KEY `FK_AssStudClearance_SIGNATORIES_CODE` (`AssStudClearance_SIGNATORIES_CODE`);

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
  ADD KEY `FK_OrgOffi_OrgOffiPosDetails_ID` (`OrgOffi_OrgOffiPosDetails_ID`),
  ADD KEY `FK_OrgOffi_BATCH_YEAR` (`OrgOffi_BATCH_YEAR`);

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
-- AUTO_INCREMENT for table `r_archiving_documents`
--
ALTER TABLE `r_archiving_documents`
  MODIFY `ArchDocuments_ID` int(11) NOT NULL AUTO_INCREMENT;
--
-- AUTO_INCREMENT for table `r_batch_details`
--
ALTER TABLE `r_batch_details`
  MODIFY `Batch_ID` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=9;
--
-- AUTO_INCREMENT for table `r_clearance_signatories`
--
ALTER TABLE `r_clearance_signatories`
  MODIFY `ClearSignatories_ID` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=4;
--
-- AUTO_INCREMENT for table `r_courses`
--
ALTER TABLE `r_courses`
  MODIFY `Course_ID` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=4;
--
-- AUTO_INCREMENT for table `r_designated_offices_details`
--
ALTER TABLE `r_designated_offices_details`
  MODIFY `DesOffDetails_ID` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=4;
--
-- AUTO_INCREMENT for table `r_financial_assistance_title`
--
ALTER TABLE `r_financial_assistance_title`
  MODIFY `FinAssiTitle_ID` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=3;
--
-- AUTO_INCREMENT for table `r_org_accreditation_details`
--
ALTER TABLE `r_org_accreditation_details`
  MODIFY `OrgAccrDetail_ID` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=3;
--
-- AUTO_INCREMENT for table `r_org_applicant_profile`
--
ALTER TABLE `r_org_applicant_profile`
  MODIFY `OrgAppProfile_ID` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2;
--
-- AUTO_INCREMENT for table `r_org_category`
--
ALTER TABLE `r_org_category`
  MODIFY `OrgCat_ID` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2;
--
-- AUTO_INCREMENT for table `r_org_essentials`
--
ALTER TABLE `r_org_essentials`
  MODIFY `OrgEssentials_ID` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=11;
--
-- AUTO_INCREMENT for table `r_org_officer_position_details`
--
ALTER TABLE `r_org_officer_position_details`
  MODIFY `OrgOffiPosDetails_ID` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2;
--
-- AUTO_INCREMENT for table `r_osas_head`
--
ALTER TABLE `r_osas_head`
  MODIFY `OSASHead_ID` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2;
--
-- AUTO_INCREMENT for table `r_sanction_details`
--
ALTER TABLE `r_sanction_details`
  MODIFY `SancDetails_ID` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=12;
--
-- AUTO_INCREMENT for table `r_semester`
--
ALTER TABLE `r_semester`
  MODIFY `Semestral_ID` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=3;
--
-- AUTO_INCREMENT for table `r_stud_profile`
--
ALTER TABLE `r_stud_profile`
  MODIFY `Stud_ID` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=49;
--
-- AUTO_INCREMENT for table `r_users`
--
ALTER TABLE `r_users`
  MODIFY `Users_ID` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=5;
--
-- AUTO_INCREMENT for table `t_assign_org_academic_course`
--
ALTER TABLE `t_assign_org_academic_course`
  MODIFY `AssOrgAcademic_ID` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=12;
--
-- AUTO_INCREMENT for table `t_assign_org_category`
--
ALTER TABLE `t_assign_org_category`
  MODIFY `AssOrgCategory_ID` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=12;
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
  MODIFY `AssStudFinanAssistance_ID` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=32;
--
-- AUTO_INCREMENT for table `t_assign_stud_loss_id_regicard`
--
ALTER TABLE `t_assign_stud_loss_id_regicard`
  MODIFY `AssLoss_ID` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=5;
--
-- AUTO_INCREMENT for table `t_assign_stud_saction`
--
ALTER TABLE `t_assign_stud_saction`
  MODIFY `AssSancStudStudent_ID` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=71;
--
-- AUTO_INCREMENT for table `t_org_accreditation_process`
--
ALTER TABLE `t_org_accreditation_process`
  MODIFY `OrgAccrProcess_ID` int(11) NOT NULL AUTO_INCREMENT;
--
-- AUTO_INCREMENT for table `t_org_cash_flow_statement`
--
ALTER TABLE `t_org_cash_flow_statement`
  MODIFY `OrgCashFlowStatement_ID` int(11) NOT NULL AUTO_INCREMENT;
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
  MODIFY `OrgForCompliance_ID` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=12;
--
-- AUTO_INCREMENT for table `t_org_officers`
--
ALTER TABLE `t_org_officers`
  MODIFY `OrgOffi_ID` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2;
--
-- AUTO_INCREMENT for table `t_org_remittance`
--
ALTER TABLE `t_org_remittance`
  MODIFY `OrgRemittance_ID` int(11) NOT NULL AUTO_INCREMENT;
--
-- AUTO_INCREMENT for table `t_org_voucher`
--
ALTER TABLE `t_org_voucher`
  MODIFY `OrgVoucher_ID` int(11) NOT NULL AUTO_INCREMENT;
--
-- AUTO_INCREMENT for table `t_org_voucher_items`
--
ALTER TABLE `t_org_voucher_items`
  MODIFY `OrgVouchItems_ID` int(11) NOT NULL AUTO_INCREMENT;
--
-- AUTO_INCREMENT for table `t_qrval_student_clearance`
--
ALTER TABLE `t_qrval_student_clearance`
  MODIFY `QRValStudClearance_ID` int(11) NOT NULL AUTO_INCREMENT;
--
-- Constraints for dumped tables
--

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
-- Constraints for table `t_assign_org_sanction`
--
ALTER TABLE `t_assign_org_sanction`
  ADD CONSTRAINT `FK_AssSancOrgStudent_STUD_NO` FOREIGN KEY (`AssSancOrgStudent_REG_ORG`) REFERENCES `t_org_for_compliance` (`OrgForCompliance_ORG_CODE`) ON DELETE CASCADE ON UPDATE CASCADE,
  ADD CONSTRAINT `FK_AssSancOrgStudent_SancDetails_CODE` FOREIGN KEY (`AssSancOrgStudent_SancDetails_CODE`) REFERENCES `r_sanction_details` (`SancDetails_CODE`) ON DELETE CASCADE ON UPDATE CASCADE;

--
-- Constraints for table `t_assign_student_clearance`
--
ALTER TABLE `t_assign_student_clearance`
  ADD CONSTRAINT `FK_AssStudClearance_BATCH` FOREIGN KEY (`AssStudClearance_STUD_NO`) REFERENCES `r_batch_details` (`Batch_YEAR`) ON DELETE CASCADE ON UPDATE CASCADE,
  ADD CONSTRAINT `FK_AssStudClearance_SEMESTER` FOREIGN KEY (`AssStudClearance_SEMESTER`) REFERENCES `r_semester` (`Semestral_NAME`) ON DELETE CASCADE ON UPDATE CASCADE,
  ADD CONSTRAINT `FK_AssStudClearance_SIGNATORIES_CODE` FOREIGN KEY (`AssStudClearance_SIGNATORIES_CODE`) REFERENCES `r_clearance_signatories` (`ClearSignatories_CODE`) ON DELETE CASCADE ON UPDATE CASCADE;

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
  ADD CONSTRAINT `FK_OrgOffi_BATCH_YEAR` FOREIGN KEY (`OrgOffi_BATCH_YEAR`) REFERENCES `r_batch_details` (`Batch_YEAR`) ON DELETE CASCADE ON UPDATE CASCADE,
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
