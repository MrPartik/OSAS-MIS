-- phpMyAdmin SQL Dump
-- version 4.5.1
-- http://www.phpmyadmin.net
--
-- Host: 127.0.0.1
-- Generation Time: May 29, 2018 at 06:20 PM
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

DROP PROCEDURE IF EXISTS `counseling_type_add`$$
CREATE DEFINER=`root`@`localhost` PROCEDURE `counseling_type_add` (IN `type` VARCHAR(50))  NO SQL
insert into r_couns_type (Couns_TYPE) values (type)$$

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

DROP PROCEDURE IF EXISTS `login_check`$$
CREATE DEFINER=`root`@`localhost` PROCEDURE `login_check` (IN `username` VARCHAR(50), IN `userpass` VARCHAR(100))  NO SQL
select * from r_users where Users_USERNAME = username and AES_DECRYPT(Users_PASSWORD,password('GC&SMS')) = userpass$$

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

DROP PROCEDURE IF EXISTS `stud_counseling_add`$$
CREATE DEFINER=`root`@`localhost` PROCEDURE `stud_counseling_add` (IN `visitRef` INT, IN `counsType` VARCHAR(50), IN `appmtType` VARCHAR(25), IN `studNo` VARCHAR(15), IN `bg` TEXT, IN `goal` TEXT, IN `commnt` TEXT, IN `recommendation` TEXT, IN `remarks` VARCHAR(50))  NO SQL
begin
set @counsCode = (select if(counsType = 'Individual Counseling',(select concat('IC',date_format(current_date,'%y-%c%d'),convert((select count(*) from t_counseling where Couns_COUNSELING_TYPE = 'Individual Counseling'),int)+1)),(select concat('GC',date_format(current_date,'%y-%c%d'),convert((select count(*) from t_counseling where Couns_COUNSELING_TYPE = 'Individual Counseling'),int)+1))) as CounselingCode);
insert into t_counseling (
    Couns_CODE,
    Visit_ID_REFERENCE,
    Couns_COUNSELING_TYPE,
    Couns_APPOINTMENT_TYPE,
    Couns_BACKGROUND,
    Couns_GOALS,
    Couns_COMMENT,
	Couns_RECOMMENDATION)
values (
	@counsCode,
	visitRef,
	counsType,
	appmtType,
	if (bg = '',null,bg),
	if (goal = '',null,bg),
	if (commnt,null,commnt),
	if (recommendation = '',null,recommendation));
insert into t_couns_details (Couns_ID_REFERENCE,Stud_NO,Couns_REMARKS) values (LAST_INSERT_ID(),studNo,if (remarks = '',null,remarks));
end$$

DROP PROCEDURE IF EXISTS `stud_profile_add`$$
CREATE DEFINER=`root`@`localhost` PROCEDURE `stud_profile_add` (IN `studNo` VARCHAR(15), IN `fname` VARCHAR(100), IN `mname` VARCHAR(100), IN `lname` VARCHAR(100), IN `gender` VARCHAR(10), IN `course` VARCHAR(15), IN `yearLevel` INT(11), IN `section` VARCHAR(5), IN `bdate` DATE, IN `cityAddress` VARCHAR(500), IN `provAddress` VARCHAR(500), IN `telNo` VARCHAR(20), IN `mobNo` VARCHAR(20), IN `email` VARCHAR(100), IN `birthplace` VARCHAR(500), IN `stat` VARCHAR(20))  NO SQL
insert into r_stud_profile (
    Stud_NO,
    Stud_FNAME,
    Stud_MNAME,
    Stud_LNAME,
    Stud_GENDER,
    Stud_COURSE,
    Stud_YEAR_LEVEL,
    Stud_SECTION,
    Stud_BIRTH_DATE,
	Stud_CITY_ADDRESS,
	Stud_PROVINCIAL_ADDRESS,
	Stud_TELEPHONE_NO,
	Stud_MOBILE_NO,
	Stud_EMAIL,
	Stud_BIRTH_PLACE,
	Stud_STATUS)
values (
    studNo,
    fname,
    mname,
    lname,
    gender,
    course,
    yearLevel,
    section,
    bdate,
	cityAddress,
	provAddress,
	telNo,
	mobNo,
	email,
	birthplace,
	stat)$$

DROP PROCEDURE IF EXISTS `stud_visit_add`$$
CREATE DEFINER=`root`@`localhost` PROCEDURE `stud_visit_add` (IN `studNo` VARCHAR(15), IN `purpose` VARCHAR(50), IN `details` TEXT)  NO SQL
begin
set @visitCode = (select concat('VS',(select date_format(CURRENT_TIMESTAMP,'%y-%c%d')),convert((select count(*) from t_stud_visit where date(Visit_DATE) = CURRENT_DATE),int)+1) as VisitCode);
insert into t_stud_visit (Visit_CODE,Stud_NO,Visit_PURPOSE,Visit_DETAILS)
values (@visitCode,studNo,purpose,details);
end$$

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

DROP PROCEDURE IF EXISTS `upload_category_add`$$
CREATE DEFINER=`root`@`localhost` PROCEDURE `upload_category_add` (IN `category` VARCHAR(100))  NO SQL
insert into r_upload_category (Upload_FILE_CATEGORY) values (category)$$

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

DROP PROCEDURE IF EXISTS `visit_type_add`$$
CREATE DEFINER=`root`@`localhost` PROCEDURE `visit_type_add` (IN `type` VARCHAR(50), IN `visitDesc` TEXT)  NO SQL
insert into r_visit (Visit_TYPE,Visit_DESC)
values (type,if (visitDesc = '',null,visitDesc))$$

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
-- Table structure for table `r_civil_stat`
--

DROP TABLE IF EXISTS `r_civil_stat`;
CREATE TABLE `r_civil_stat` (
  `Stud_CIVIL_STATUS_ID` int(11) NOT NULL,
  `Stud_CIVIL_STATUS` varchar(15) NOT NULL,
  `Stud_CIVIL_STATUS_STAT` enum('Active','Inactive') DEFAULT 'Active'
) ENGINE=InnoDB DEFAULT CHARSET=latin1 ROW_FORMAT=COMPACT;

--
-- Truncate table before insert `r_civil_stat`
--

TRUNCATE TABLE `r_civil_stat`;
--
-- Dumping data for table `r_civil_stat`
--

INSERT INTO `r_civil_stat` (`Stud_CIVIL_STATUS_ID`, `Stud_CIVIL_STATUS`, `Stud_CIVIL_STATUS_STAT`) VALUES
(1, 'Single', 'Active'),
(2, 'Married', 'Active');

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
  `ClearSignatories_TYPE` varchar(100) NOT NULL,
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

INSERT INTO `r_clearance_signatories` (`ClearSignatories_ID`, `ClearSignatories_CODE`, `ClearSignatories_NAME`, `ClearSignatories_DESC`, `ClearSignatories_TYPE`, `ClearSignatories_DATE_MOD`, `ClearSignatories_DATE_ADD`, `ClearSignatories_DISPLAY_STAT`) VALUES
(11, 'SIG00001', 'Accounting Office', 'Accounting Office', 'SEMESTRAL', '2018-05-21 00:32:21', '2018-05-21 00:32:21', 'Active'),
(12, 'SIG00002', 'Library', 'Library', 'SEMESTRAL', '2018-05-21 00:34:38', '2018-05-21 00:34:38', 'Active'),
(13, 'SIG00003', 'Academic/ Director''s Office', 'Academic/ Director''s Office', 'SEMESTRAL', '2018-05-21 00:34:56', '2018-05-21 00:34:56', 'Active'),
(14, 'SIG00004', 'Guidance and Counseling Office', 'Guidance and Counseling Office', 'SEMESTRAL', '2018-05-21 00:35:18', '2018-05-21 00:35:18', 'Active'),
(15, 'SIG00005', 'Student Affairs and Services', 'Student Affairs and Services', 'SEMESTRAL', '2018-05-21 00:35:40', '2018-05-21 00:35:40', 'Active'),
(16, 'Other', 'Other', 'Clearance Signatories Description', 'SEMESTRAL', '2018-05-29 21:53:37', '2018-05-29 21:53:37', 'Active'),
(17, 'asd', 'sda', 'Clearance Signatories Description', 'SEMESTRAL', '2018-05-29 22:12:36', '2018-05-29 22:12:36', 'Inactive');

-- --------------------------------------------------------

--
-- Table structure for table `r_couns_appointment_type`
--

DROP TABLE IF EXISTS `r_couns_appointment_type`;
CREATE TABLE `r_couns_appointment_type` (
  `Appmnt_ID` int(11) NOT NULL,
  `Appmnt_TYPE` varchar(25) NOT NULL,
  `Appmnt_STAT` enum('Active','Inactive') DEFAULT 'Active'
) ENGINE=InnoDB DEFAULT CHARSET=latin1 ROW_FORMAT=COMPACT;

--
-- Truncate table before insert `r_couns_appointment_type`
--

TRUNCATE TABLE `r_couns_appointment_type`;
--
-- Dumping data for table `r_couns_appointment_type`
--

INSERT INTO `r_couns_appointment_type` (`Appmnt_ID`, `Appmnt_TYPE`, `Appmnt_STAT`) VALUES
(1, 'Walk-in', 'Inactive'),
(2, 'Referral', 'Active');

-- --------------------------------------------------------

--
-- Table structure for table `r_couns_approach`
--

DROP TABLE IF EXISTS `r_couns_approach`;
CREATE TABLE `r_couns_approach` (
  `Couns_APPROACH_ID` int(11) NOT NULL,
  `Couns_APPROACH` varchar(50) NOT NULL,
  `COUNS_APPROACH_DESC` text
) ENGINE=InnoDB DEFAULT CHARSET=latin1 ROW_FORMAT=COMPACT;

--
-- Truncate table before insert `r_couns_approach`
--

TRUNCATE TABLE `r_couns_approach`;
-- --------------------------------------------------------

--
-- Table structure for table `r_couns_type`
--

DROP TABLE IF EXISTS `r_couns_type`;
CREATE TABLE `r_couns_type` (
  `Couns_TYPE_ID` int(11) NOT NULL,
  `Couns_TYPE` varchar(50) NOT NULL,
  `Couns_TYPE_STAT` enum('Active','Inactive') DEFAULT 'Active'
) ENGINE=InnoDB DEFAULT CHARSET=latin1 ROW_FORMAT=COMPACT;

--
-- Truncate table before insert `r_couns_type`
--

TRUNCATE TABLE `r_couns_type`;
--
-- Dumping data for table `r_couns_type`
--

INSERT INTO `r_couns_type` (`Couns_TYPE_ID`, `Couns_TYPE`, `Couns_TYPE_STAT`) VALUES
(1, 'Individual Counseling', 'Active'),
(2, 'Group Counseling', 'Active');

-- --------------------------------------------------------

--
-- Table structure for table `r_courses`
--

DROP TABLE IF EXISTS `r_courses`;
CREATE TABLE `r_courses` (
  `Course_ID` int(11) NOT NULL,
  `Course_CODE` varchar(15) NOT NULL,
  `Course_NAME` varchar(100) NOT NULL,
  `Course_DESC` varchar(100) NOT NULL DEFAULT 'Course Description',
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
-- Table structure for table `r_guidance_counselor`
--

DROP TABLE IF EXISTS `r_guidance_counselor`;
CREATE TABLE `r_guidance_counselor` (
  `Counselor_ID` int(11) NOT NULL,
  `Counselor_CODE` varchar(15) NOT NULL,
  `Counselor_FNAME` varchar(100) NOT NULL,
  `Counselor_MNAME` varchar(100) NOT NULL,
  `Counselor_LNAME` varchar(100) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1 ROW_FORMAT=COMPACT;

--
-- Truncate table before insert `r_guidance_counselor`
--

TRUNCATE TABLE `r_guidance_counselor`;
--
-- Dumping data for table `r_guidance_counselor`
--

INSERT INTO `r_guidance_counselor` (`Counselor_ID`, `Counselor_CODE`, `Counselor_FNAME`, `Counselor_MNAME`, `Counselor_LNAME`) VALUES
(1, 'GC-0001', 'Oliver', 'Juan', 'Gabriel');

-- --------------------------------------------------------

--
-- Table structure for table `r_nature_of_case`
--

DROP TABLE IF EXISTS `r_nature_of_case`;
CREATE TABLE `r_nature_of_case` (
  `Case_NAME` varchar(50) NOT NULL,
  `Case_STAT` enum('Active','Inactive') DEFAULT 'Active'
) ENGINE=InnoDB DEFAULT CHARSET=latin1 ROW_FORMAT=COMPACT;

--
-- Truncate table before insert `r_nature_of_case`
--

TRUNCATE TABLE `r_nature_of_case`;
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
(1, 'EVNT00003', 'CITS2019', '2018-OSAS-CM', 'Seen', 'Clicked', 'Organization', '2018-05-23 13:47:13', '2018-05-28 13:45:29', '2018-05-23 13:46:57'),
(2, 'Vouch #00001', 'CITS2019', '2018-OSAS-CM', 'Seen', 'Clicked', 'OSAS Head', '2018-05-26 10:29:07', '2018-05-28 13:45:32', '2018-05-26 10:29:02');

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
-- Table structure for table `r_remarks`
--

DROP TABLE IF EXISTS `r_remarks`;
CREATE TABLE `r_remarks` (
  `Remarks_ID` int(11) NOT NULL,
  `Remarks_TYPE` varchar(50) NOT NULL,
  `Remarks_DESC` text,
  `Remarks_STAT` enum('Active','Inactive') DEFAULT 'Active'
) ENGINE=InnoDB DEFAULT CHARSET=latin1 ROW_FORMAT=COMPACT;

--
-- Truncate table before insert `r_remarks`
--

TRUNCATE TABLE `r_remarks`;
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
-- Table structure for table `r_stud_batch`
--

DROP TABLE IF EXISTS `r_stud_batch`;
CREATE TABLE `r_stud_batch` (
  `Stud_BATCH_ID` int(11) NOT NULL,
  `Stud_NO` varchar(15) NOT NULL,
  `Batch_YEAR` varchar(15) NOT NULL,
  `Stud_STATUS` enum('Regular','Irregular','Disqualified','LOA','Transferee') DEFAULT 'Regular'
) ENGINE=InnoDB DEFAULT CHARSET=latin1 ROW_FORMAT=COMPACT;

--
-- Truncate table before insert `r_stud_batch`
--

TRUNCATE TABLE `r_stud_batch`;
--
-- Dumping data for table `r_stud_batch`
--

INSERT INTO `r_stud_batch` (`Stud_BATCH_ID`, `Stud_NO`, `Batch_YEAR`, `Stud_STATUS`) VALUES
(1, '2015-00138-CM-0', '2017-2018', 'Regular');

-- --------------------------------------------------------

--
-- Table structure for table `r_stud_educ_background`
--

DROP TABLE IF EXISTS `r_stud_educ_background`;
CREATE TABLE `r_stud_educ_background` (
  `Educ_BG_ID` int(11) NOT NULL,
  `Stud_NO_REFERENCE` varchar(15) NOT NULL,
  `Educ_NATURE_OF_SCHOOLING` enum('Continuous','Interrupted') DEFAULT 'Continuous',
  `Interrupted_REASON` varchar(500) DEFAULT 'None'
) ENGINE=InnoDB DEFAULT CHARSET=latin1 ROW_FORMAT=COMPACT;

--
-- Truncate table before insert `r_stud_educ_background`
--

TRUNCATE TABLE `r_stud_educ_background`;
-- --------------------------------------------------------

--
-- Table structure for table `r_stud_educ_bg_details`
--

DROP TABLE IF EXISTS `r_stud_educ_bg_details`;
CREATE TABLE `r_stud_educ_bg_details` (
  `Educ_BG_ID` int(11) NOT NULL,
  `Educ_LEVEL` enum('Pre-elementary','Elementary','High School','Vocational','College if any') NOT NULL,
  `Educ_SCHOOL_GRADUATED` varchar(500) DEFAULT 'None',
  `Educ_SCHOOL_ADDRESS` varchar(500) DEFAULT 'None',
  `Educ_SCHOOL_TYPE` enum('Public','Private') DEFAULT 'Public',
  `Educ_DATES_OF_ATTENDANCE` varchar(15) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1 ROW_FORMAT=COMPACT;

--
-- Truncate table before insert `r_stud_educ_bg_details`
--

TRUNCATE TABLE `r_stud_educ_bg_details`;
-- --------------------------------------------------------

--
-- Table structure for table `r_stud_family_bg_details`
--

DROP TABLE IF EXISTS `r_stud_family_bg_details`;
CREATE TABLE `r_stud_family_bg_details` (
  `Stud_NO_REFERENCE` varchar(15) NOT NULL,
  `FamilyBG_INFO` enum('Father','Mother','Guardian') NOT NULL,
  `Info_FNAME` varchar(100) NOT NULL,
  `Info_MNAME` varchar(100) NOT NULL,
  `Info_LNAME` varchar(100) NOT NULL,
  `Info_AGE` int(11) NOT NULL,
  `Info_STAT` enum('Living','Deceased') DEFAULT 'Living',
  `Info_EDUC_ATTAINMENT` varchar(100) NOT NULL,
  `Info_OCCUPATION` varchar(100) NOT NULL,
  `Info_EMPLOYER_NAME` varchar(300) DEFAULT 'None',
  `Info_EMPLOYER_ADDRESS` varchar(500) DEFAULT 'None'
) ENGINE=InnoDB DEFAULT CHARSET=latin1 ROW_FORMAT=COMPACT;

--
-- Truncate table before insert `r_stud_family_bg_details`
--

TRUNCATE TABLE `r_stud_family_bg_details`;
-- --------------------------------------------------------

--
-- Table structure for table `r_stud_general_info`
--

DROP TABLE IF EXISTS `r_stud_general_info`;
CREATE TABLE `r_stud_general_info` (
  `Stud_NO` varchar(15) NOT NULL,
  `Gen_Info_DETAILS` enum('Favorite Subject/s','Subject/s Least Like','Club','Hobbies','Organization') NOT NULL,
  `Gen_Info_CONTENT` varchar(100) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1 ROW_FORMAT=COMPACT;

--
-- Truncate table before insert `r_stud_general_info`
--

TRUNCATE TABLE `r_stud_general_info`;
-- --------------------------------------------------------

--
-- Table structure for table `r_stud_honors_awards`
--

DROP TABLE IF EXISTS `r_stud_honors_awards`;
CREATE TABLE `r_stud_honors_awards` (
  `Educ_BG_ID` int(11) NOT NULL,
  `Stud_NO_REFERENCE` varchar(15) NOT NULL,
  `Received_TYPE` enum('Honors Received','Special Awards') DEFAULT 'Honors Received',
  `Received_Desc` varchar(100) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1 ROW_FORMAT=COMPACT;

--
-- Truncate table before insert `r_stud_honors_awards`
--

TRUNCATE TABLE `r_stud_honors_awards`;
-- --------------------------------------------------------

--
-- Table structure for table `r_stud_org_position`
--

DROP TABLE IF EXISTS `r_stud_org_position`;
CREATE TABLE `r_stud_org_position` (
  `Stud_NO_REFERENCE` varchar(15) NOT NULL,
  `Stud_POSITION` text NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1 ROW_FORMAT=COMPACT;

--
-- Truncate table before insert `r_stud_org_position`
--

TRUNCATE TABLE `r_stud_org_position`;
-- --------------------------------------------------------

--
-- Table structure for table `r_stud_personal_info`
--

DROP TABLE IF EXISTS `r_stud_personal_info`;
CREATE TABLE `r_stud_personal_info` (
  `Stud_NO_REFERENCE` varchar(15) NOT NULL,
  `Stud_HEIGHT` double(9,2) NOT NULL,
  `Stud_WEIGHT` double(9,2) NOT NULL,
  `Stud_COMPLEXION` varchar(50) NOT NULL,
  `Stud_HS_GEN_AVERAGE` double(3,2) NOT NULL,
  `Stud_RELIGION` varchar(100) NOT NULL,
  `Stud_CIVIL_STAT` varchar(15) NOT NULL,
  `Stud_WORKING` enum('Yes','No') DEFAULT 'No',
  `Employer_NAME` varchar(300) DEFAULT 'None',
  `Employer_ADDRESS` varchar(100) DEFAULT 'None',
  `Emergency_CONTACT_PERSON` varchar(500) NOT NULL,
  `Emergency_CONTACT_ADDRESS` varchar(500) NOT NULL,
  `Emergency_CONTACT_NUMBER` varchar(20) NOT NULL DEFAULT 'None',
  `ContactPerson_RELATIONSHIP` varchar(100) NOT NULL,
  `Parents_MARITAL_RELATIONSHIP` varchar(100) NOT NULL,
  `Stud_FAM_CHILDREN_NO` int(11) NOT NULL,
  `Stud_BROTHER_NO` int(11) DEFAULT '0',
  `Stud_SISTER_NO` int(11) DEFAULT '0',
  `Employed_BS_NO` int(11) DEFAULT '0',
  `Stud_ORDINAL_POSITION` varchar(50) NOT NULL,
  `Stud_SCHOOLING_FINANCE` enum('Parents','Brother/Sister','Spouse','Scholarship','Relatives','Self-supporting/working student') DEFAULT 'Parents',
  `Stud_WEEKLY_ALLOWANCE` double(9,2) NOT NULL,
  `Parents_TOTAL_MONTHLY_INCOME` varchar(100) NOT NULL,
  `Stud_QUIET_PLACE` enum('Yes','No') DEFAULT 'Yes',
  `Stud_ROOM_SHARE` varchar(50) NOT NULL,
  `Stud_RESIDENCE` enum('family home','relative''s house','share apartment with friends','share apartment with relatives','bed spacer','rented apartment','house of married brother/sister','dorm (including board & lodging)') DEFAULT 'family home'
) ENGINE=InnoDB DEFAULT CHARSET=latin1 ROW_FORMAT=COMPACT;

--
-- Truncate table before insert `r_stud_personal_info`
--

TRUNCATE TABLE `r_stud_personal_info`;
-- --------------------------------------------------------

--
-- Table structure for table `r_stud_phys_rec`
--

DROP TABLE IF EXISTS `r_stud_phys_rec`;
CREATE TABLE `r_stud_phys_rec` (
  `Stud_NO_REFERENCE` varchar(15) NOT NULL,
  `PhysicalRec_VISION` text NOT NULL,
  `PhysicalRec_HEARING` text NOT NULL,
  `PhysicalRec_SPEECH` text NOT NULL,
  `PhysicalRec_GEN_HEALTH` text NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1 ROW_FORMAT=COMPACT;

--
-- Truncate table before insert `r_stud_phys_rec`
--

TRUNCATE TABLE `r_stud_phys_rec`;
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
  `Stud_GENDER` enum('Male','Female') NOT NULL DEFAULT 'Male',
  `Stud_COURSE` varchar(15) NOT NULL,
  `Stud_YEAR_LEVEL` int(11) NOT NULL DEFAULT '1',
  `Stud_SECTION` varchar(5) NOT NULL DEFAULT '1',
  `Stud_BIRTH_DATE` date NOT NULL,
  `Stud_CITY_ADDRESS` varchar(500) NOT NULL DEFAULT 'Not Specify',
  `Stud_PROVINCIAL_ADDRESS` varchar(500) NOT NULL DEFAULT 'Not Specify',
  `Stud_TELEPHONE_NO` varchar(20) NOT NULL DEFAULT 'None',
  `Stud_MOBILE_NO` varchar(20) NOT NULL DEFAULT 'None',
  `Stud_EMAIL` varchar(100) NOT NULL,
  `Stud_BIRTH_PLACE` varchar(500) DEFAULT NULL,
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

INSERT INTO `r_stud_profile` (`Stud_ID`, `Stud_NO`, `Stud_FNAME`, `Stud_MNAME`, `Stud_LNAME`, `Stud_GENDER`, `Stud_COURSE`, `Stud_YEAR_LEVEL`, `Stud_SECTION`, `Stud_BIRTH_DATE`, `Stud_CITY_ADDRESS`, `Stud_PROVINCIAL_ADDRESS`, `Stud_TELEPHONE_NO`, `Stud_MOBILE_NO`, `Stud_EMAIL`, `Stud_BIRTH_PLACE`, `Stud_STATUS`, `Stud_DATE_MOD`, `Stud_DATE_ADD`, `Stud_DATE_DEACTIVATE`, `Stud_DISPLAY_STATUS`) VALUES
(1, '2015-00138-CM-0', 'Oliver', NULL, 'Gabriel', 'Male', 'BSIT', 3, '1', '1998-11-16', '24-D4 Oliveros Drive Apolonio Samson Quezon City', 'Not Specify', 'Not Specify', 'Not Specify', 'Not Specify', 'Not Specify', 'Regular', '2018-05-21 14:11:00', '2018-05-21 14:11:00', NULL, 'Active'),
(2, '2015-00073-Cm-0', 'John Patrick', 'Balmonte', 'Loyola', 'Male', 'BSIT', 3, '1', '2015-11-11', 'Quezon City', 'Metro Manila', '12479837', '98765432187', 'loyolapat04@gmail.com', 'Metro Manila', 'Regular', '2018-05-24 18:03:12', '2018-05-24 18:03:12', NULL, 'Active'),
(3, '2017-00057', 'Bryan ', '', 'Cortesiano', 'Female', 'BSIT', 3, '1', '2015-11-12', 'Commonwealth', 'Agusan', '12479837', '90453567245', 'bry@gmail.com', 'Agusan', 'Regular', '2018-05-24 18:03:12', '2018-05-24 18:03:12', NULL, 'Active'),
(4, '2017-00058', 'Francheska', 'Nillo', 'Ronquillo', 'Female', 'BSIT', 3, '1', '2015-11-13', 'Caloocan', 'Zambales', '12479837', '98765423465', 'ches@gmail.com', 'Zambales', 'Regular', '2018-05-24 18:03:12', '2018-05-24 18:03:12', NULL, 'Active'),
(5, '2017-00059', 'Lkier', '', 'FFT', 'Female', 'BSIT', 3, '1', '2015-11-14', 'Fairview', 'Nueva Ecija', '12479837', '92929292923', 'fft@gmail.com', 'Nueva Ecija', 'Regular', '2018-05-24 18:03:13', '2018-05-24 18:03:13', NULL, 'Active'),
(6, '2017-00060', 'Gfoor', '', 'CSSS', 'Female', 'BSIT', 3, '1', '2015-11-15', 'Novaliches', 'Bataan', '12479837', '98765432187', 'csss@gmail.com', 'Bataan', 'Regular', '2018-05-24 18:03:13', '2018-05-24 18:03:13', NULL, 'Active'),
(7, '2017-00061', 'BFeg', '', 'POPOP', 'Female', 'BSIT', 3, '1', '2015-11-16', 'Bulacan', 'Tarlac', '12479837', '90453567245', 'popop@gmail.com', 'Tarlac', 'Regular', '2018-05-24 18:03:13', '2018-05-24 18:03:13', NULL, 'Active'),
(8, '2017-00062', 'Rhea', '', 'Rios', 'Female', 'BSIT', 3, '1', '2015-11-17', 'Navotas', 'Cabanatuan', '12479837', '98765423465', 'rhe@gmail.com', 'Cabanatuan', 'Regular', '2018-05-24 18:03:13', '2018-05-24 18:03:13', NULL, 'Active'),
(9, '2017-00063', 'Jean', '', 'Ramos', 'Female', 'BSIT', 3, '1', '2015-11-18', 'Valenzuela', 'Baguio', '12479837', '92929292923', 'jea@gmail.com', 'Baguio', 'Regular', '2018-05-24 18:03:13', '2018-05-24 18:03:13', NULL, 'Active'),
(10, '2017-00064', 'Melissa', '', 'Delos', 'Female', 'BSIT', 3, '1', '2015-11-19', 'Quezon City', 'Cebu', '12479837', '98765432187', 'mel@gmail.com', 'Cebu', 'Regular', '2018-05-24 18:03:14', '2018-05-24 18:03:14', NULL, 'Active'),
(11, '2017-00065', 'Nikki', '', 'Castilo', 'Female', 'BSIT', 3, '1', '2015-11-20', 'Commonwealth', 'Samar', '12479837', '90453567245', 'nik@gmail.com', 'Samar', 'Regular', '2018-05-24 18:03:14', '2018-05-24 18:03:14', NULL, 'Active'),
(12, '2017-00066', 'Mami', '', 'Alejandria', 'Female', 'BSIT', 3, '1', '2015-11-21', 'Caloocan', 'Leyte', '12479837', '98765423465', 'mam@gmail.com', 'Leyte', 'Regular', '2018-05-24 18:03:14', '2018-05-24 18:03:14', NULL, 'Active'),
(13, '2017-0067', 'Jade', '', 'Ago', 'Female', 'BSIT', 3, '1', '2015-11-22', 'Fairview', 'Palawan', '12479837', '92929292923', 'jad@gmail.com', 'Palawan', 'Regular', '2018-05-24 18:03:14', '2018-05-24 18:03:14', NULL, 'Active'),
(14, '2017-0068', 'Kate', '', 'De Jesus', 'Female', 'BSIT', 3, '1', '2015-10-01', 'Novaliches', 'Aklan', '12479837', '98765432187', 'de jesus@gfail.cof', 'Aklan', 'Regular', '2018-05-24 18:03:14', '2018-05-24 18:03:14', NULL, 'Active'),
(15, '2017-0069', 'Andrea', '', 'Villajuan', 'Female', 'BSIT', 3, '1', '2015-10-02', 'Bulacan', 'Marinduque', '12479837', '90453567245', 'and@gmail.com', 'Marinduque', 'Regular', '2018-05-24 18:03:14', '2018-05-24 18:03:14', NULL, 'Active'),
(16, '2017-0070', 'Teri', '', 'De Castro', 'Female', 'BSIT', 3, '1', '2015-10-03', 'Navotas', 'Ilocos', '12479837', '98765423465', 'de castro@gfail.cof', 'Navotas', 'Regular', '2018-05-24 18:03:14', '2018-05-24 18:03:14', NULL, 'Active'),
(17, '2017-0071', 'Adrian', '', 'Geronilla', 'Female', 'BSIT', 3, '1', '2015-10-04', 'Valenzuela', 'Agusan', '12479837', '92929292923', 'adr@gmail.com', 'Valenzuela', 'Regular', '2018-05-24 18:03:14', '2018-05-24 18:03:14', NULL, 'Active'),
(18, '2017-0072', 'Sharlyn', '', 'Lee', 'Female', 'BSIT', 3, '1', '2015-10-05', 'Quezon City', 'Zambales', '12479837', '98765432187', 'sha@gmail.com', 'Quezon City', 'Regular', '2018-05-24 18:03:14', '2018-05-24 18:03:14', NULL, 'Active'),
(19, '2017-0073', 'Dave', '', 'Dogayo', 'Female', 'BSIT', 3, '1', '2015-10-06', 'Commonwealth', 'Nueva Ecija', '12479837', '90453567245', 'dav@gmail.com', 'Commonwealth', 'Regular', '2018-05-24 18:03:14', '2018-05-24 18:03:14', NULL, 'Active'),
(20, '2017-0074', 'Edward', 'Rito', 'Alfante', 'Female', 'BSIT', 3, '1', '2015-10-07', 'Caloocan', 'Bataan', '12479837', '98765423465', 'edward@gmail.com', 'Caloocan', 'Regular', '2018-05-24 18:03:14', '2018-05-24 18:03:14', NULL, 'Active'),
(21, '2017-0075', 'Christan', 'ocampo', 'Tan', 'Female', 'BSIT', 3, '1', '2015-10-08', 'Fairview', 'Tarlac', '12479837', '92929292923', 'stan@gmail.com', 'Fairview', 'Regular', '2018-05-24 18:03:14', '2018-05-24 18:03:14', NULL, 'Active'),
(22, '2017-0076', 'John', 'Duran', 'Albis', 'Female', 'BSIT', 3, '1', '2015-10-09', 'Novaliches', 'Cabanatuan', '12479837', '98765432187', 'john@gmail.com', 'Novaliches', 'Regular', '2018-05-24 18:03:14', '2018-05-24 18:03:14', NULL, 'Active'),
(23, '2017-0077', 'Luis', '', 'Lantape', 'Female', 'BSIT', 3, '1', '2015-10-10', 'Bulacan', 'Baguio', '12479837', '90453567245', 'lui@gmail.com', 'Bulacan', 'Regular', '2018-05-24 18:03:14', '2018-05-24 18:03:14', NULL, 'Active'),
(24, '2017-0078', 'Romeo', '', 'Gonzales', 'Female', 'BSIT', 3, '1', '2015-10-11', 'Navotas', 'Cebu', '12479837', '98765423465', 'rom@gmail.com', 'Navotas', 'Regular', '2018-05-24 18:03:15', '2018-05-24 18:03:15', NULL, 'Active'),
(25, '2017-0079', 'Vin', '', 'Dacuag', 'Female', 'BSIT', 3, '1', '2015-10-12', 'Valenzuela', 'Samar', '12479837', '92929292923', 'vin@gmail.com', 'Valenzuela', 'Regular', '2018-05-24 18:03:15', '2018-05-24 18:03:15', NULL, 'Active'),
(26, '2017-0080', 'Lynne', '', 'Roque', 'Female', 'BSIT', 3, '1', '2015-10-13', 'Quezon City', 'Leyte', '12479837', '98765432187', 'lyn@gmail.com', 'Quezon City', 'Regular', '2018-05-24 18:03:15', '2018-05-24 18:03:15', NULL, 'Active'),
(27, '2017-0081', 'Sam', '', 'Foley', 'Female', 'BSIT', 3, '1', '2015-10-14', 'Commonwealth', 'Palawan', '12479837', '90453567245', 'sam@gmail.com', 'Commonwealth', 'Regular', '2018-05-24 18:03:15', '2018-05-24 18:03:15', NULL, 'Active'),
(28, '2017-0082', 'Hannah', '', 'Panaderya', 'Female', 'BSIT', 3, '1', '2015-10-15', 'Caloocan', 'Aklan', '12479837', '98765423465', 'han@gmail.com', 'Caloocan', 'Regular', '2018-05-24 18:03:15', '2018-05-24 18:03:15', NULL, 'Active'),
(29, '2017-0083', 'Jessica', '', 'Jones', 'Female', 'BSIT', 3, '1', '2015-10-16', 'Fairview', 'Marinduque', '12479837', '92929292923', 'jes@gmail.com', 'Fairview', 'Regular', '2018-05-24 18:03:15', '2018-05-24 18:03:15', NULL, 'Active'),
(30, '2017-0084', 'Ryan', '', 'Talledo', 'Female', 'BSIT', 3, '1', '2015-10-17', 'Novaliches', 'Ilocos', '12479837', '98765432187', 'rya@gmail.com', 'Novaliches', 'Regular', '2018-05-24 18:03:15', '2018-05-24 18:03:15', NULL, 'Active'),
(31, '2017-0085', 'Jasmine', '', 'Flores', 'Female', 'BSIT', 3, '1', '2015-10-18', 'Bulacan', 'Agusan', '12479837', '90453567245', 'jas@gmail.com', 'Bulacan', 'Regular', '2018-05-24 18:03:15', '2018-05-24 18:03:15', NULL, 'Active'),
(32, '2017-0086', 'Nikki', '', 'Arias', 'Female', 'BSIT', 3, '1', '2015-10-19', 'Navotas', 'Zambales', '12479837', '98765423465', 'nik@gmail.com', 'Navotas', 'Regular', '2018-05-24 18:03:15', '2018-05-24 18:03:15', NULL, 'Active'),
(33, '2017-0087', 'Remmuel', 'Baniqued', 'Yapit', 'Female', 'BSIT', 3, '1', '2015-10-20', 'Valenzuela', 'Nueva Ecija', '12479837', '92929292923', 'u@gmail.com', 'Valenzuela', 'Regular', '2018-05-24 18:03:16', '2018-05-24 18:03:16', NULL, 'Active'),
(34, '2017-0088', 'Rina', 'Villanueva', 'Ong', 'Female', 'BSIT', 3, '1', '2015-10-21', 'Quezon City', 'Bataan', '12479837', '98765432187', 'rina@gmail.com', 'Quezon City', 'Regular', '2018-05-24 18:03:16', '2018-05-24 18:03:16', NULL, 'Active'),
(35, '2017-0089', 'Vallery', 'Santos', 'Melchor', 'Female', 'BSIT', 3, '1', '2015-10-22', 'Commonwealth', 'Tarlac', '12479837', '90453567245', 'e@gmail.com', 'Commonwealth', 'Regular', '2018-05-24 18:03:16', '2018-05-24 18:03:16', NULL, 'Active'),
(36, '2017-0090', 'Patrick', 'Moon', 'Bituin', 'Female', 'BSIT', 3, '1', '2015-10-23', 'Caloocan', 'Cabanatuan', '12479837', '98765423465', 'i@gmail.com', 'Caloocan', 'Regular', '2018-05-24 18:03:16', '2018-05-24 18:03:16', NULL, 'Active'),
(37, '2017-0091', 'Ina', 'Yan', 'Chan', 'Female', 'BSIT', 3, '1', '2015-10-24', 'Fairview', 'Baguio', '12479837', '92929292923', 'pat@gmail.com', 'Zambales', 'Regular', '2018-05-24 18:03:16', '2018-05-24 18:03:16', NULL, 'Active'),
(38, '2017-0092', 'Princess', 'Galicia', 'Kane', 'Female', 'BSIT', 3, '1', '2015-10-25', 'Novaliches', 'Cebu', '12479837', '98765432187', 'cess@gmail.com', 'Nueva Ecija', 'Regular', '2018-05-24 18:03:16', '2018-05-24 18:03:16', NULL, 'Active'),
(39, '2017-0093', 'Jasey', 'Flores', 'Rae', 'Female', 'BSIT', 3, '1', '2015-09-01', 'Bulacan', 'Samar', '12479837', '90453567245', 'jasey@gmail.com', 'Bataan', 'Regular', '2018-05-24 18:03:16', '2018-05-24 18:03:16', NULL, 'Active'),
(40, '2017-0094', 'Nadine ', 'Marquez', 'Fabray', 'Female', 'BSIT', 3, '1', '2015-09-02', 'Navotas', 'Leyte', '12479837', '98765423465', 'nadz@gmail.com', 'Tarlac', 'Regular', '2018-05-24 18:03:16', '2018-05-24 18:03:16', NULL, 'Active'),
(41, '2017-0095', 'Estella ', 'Dela Cruz', 'Baltimore', 'Female', 'BSIT', 3, '1', '2015-09-03', 'Valenzuela', 'Palawan', '12479837', '92929292923', 'estella@gmail.com', 'Cabanatuan', 'Regular', '2018-05-24 18:03:16', '2018-05-24 18:03:16', NULL, 'Active'),
(42, '2017-0096', 'Jim', 'Oracion', 'Santos', 'Female', 'BSIT', 3, '1', '2015-09-04', 'Dela Costa', 'Aklan', '12479837', '98765432187', 'jiim@gmail.com', 'Baguio', 'Regular', '2018-05-24 18:03:16', '2018-05-24 18:03:16', NULL, 'Active'),
(43, '2017-0097', 'Celine', 'Mallari', 'Balboa', 'Female', 'BSIT', 3, '1', '2015-09-05', 'Fairview', 'Marinduque', '12479837', '90453567245', 'celine@gmail.com', 'Cebu', 'Regular', '2018-05-24 18:03:16', '2018-05-24 18:03:16', NULL, 'Active'),
(44, '2017-00156', 'Mayhem', '', 'Lim', 'Female', 'BSIT', 2, '1', '2015-09-06', 'Fairview', 'Marinduque', '12479837', '90453567245', 'mayhem@gmail.com', 'Samar', 'Regular', '2018-05-24 18:03:16', '2018-05-24 18:03:16', NULL, 'Active'),
(45, '2017-00157', 'Teresita', '', 'Cortez', 'Female', 'BSIT', 2, '1', '2015-09-07', 'Novaliches', 'Ilocos', '12479837', '98765423465', 'teresita@gmail.com', 'Leyte', 'Regular', '2018-05-24 18:03:16', '2018-05-24 18:03:16', NULL, 'Active'),
(46, '2017-00158', 'Melba', '', 'Venga', 'Female', 'BSIT', 2, '1', '2015-09-08', 'Bulacan', 'Agusan', '12479837', '92929292923', 'melba@gmail.com', 'Valenzuela', 'Regular', '2018-05-24 18:03:16', '2018-05-24 18:03:16', NULL, 'Active'),
(47, '2017-00159', 'Cynthia', '', 'Bolzinco', 'Female', 'BSIT', 2, '1', '2015-09-09', 'Navotas', 'Zambales', '12479837', '98765432187', 'cynthia@gmail.com', 'Quezon City', 'Regular', '2018-05-24 18:03:16', '2018-05-24 18:03:16', NULL, 'Active'),
(48, '2017-00160', 'Celia', '', 'Perez', 'Female', 'BSIT', 2, '1', '2015-09-10', 'Valenzuela', 'Nueva Ecija', '12479837', '90453567245', 'celia@gmail.com', 'Commonwealth', 'Regular', '2018-05-24 18:03:16', '2018-05-24 18:03:16', NULL, 'Active'),
(49, '2017-00161', 'Francisco', '', 'Mendez', 'Female', 'BSIT', 2, '1', '2015-09-11', 'Quezon City', 'Bataan', '12479837', '98765423465', 'francisco@gmail.com', 'Caloocan', 'Regular', '2018-05-24 18:03:16', '2018-05-24 18:03:16', NULL, 'Active'),
(50, '2017-00162', 'Jeremiah', '', 'Rollo', 'Female', 'BSIT', 2, '1', '2015-09-12', 'Commonwealth', 'Tarlac', '12479837', '92929292923', 'jeremiah@gmail.com', 'Fairview', 'Regular', '2018-05-24 18:03:16', '2018-05-24 18:03:16', NULL, 'Active'),
(51, '2017-00163', 'John Michael', '', 'Roque', 'Female', 'BSIT', 2, '1', '2015-09-13', 'Caloocan', 'Cabanatuan', '12479837', '98765432187', 'john michael@gmail.com', 'Novaliches', 'Regular', '2018-05-24 18:03:16', '2018-05-24 18:03:16', NULL, 'Active'),
(52, '2017-00164', 'Michael', '', 'Delima', 'Female', 'BSIT', 2, '1', '2015-09-14', 'Fairview', 'Baguio', '12479837', '90453567245', 'michael@gmail.com', 'Bulacan', 'Regular', '2018-05-24 18:03:16', '2018-05-24 18:03:16', NULL, 'Active'),
(53, '2017-00165', 'Francis', '', 'Makalintal', 'Female', 'BSIT', 2, '1', '2015-09-15', 'Novaliches', 'Cebu', '12479837', '98765423465', 'francis@gmail.com', 'Navotas', 'Regular', '2018-05-24 18:03:16', '2018-05-24 18:03:16', NULL, 'Active'),
(54, '2017-00166', 'Joanne', '', 'Dimagiba', 'Female', 'BSIT', 2, '1', '2015-09-16', 'Bulacan', 'Samar', '12479837', '92929292923', 'joanne@gmail.com', 'Cebu', 'Regular', '2018-05-24 18:03:16', '2018-05-24 18:03:16', NULL, 'Active'),
(55, '2017-00145', 'Noel', '', 'Bulos', 'Female', 'BSIT', 2, '1', '2015-09-17', 'Navotas', 'Leyte', '12479837', '98765432187', 'noel@gmail.com', 'Samar', 'Regular', '2018-05-24 18:03:16', '2018-05-24 18:03:16', NULL, 'Active'),
(56, '2017-00169', 'Joselito', '', 'Dimal', 'Female', 'BSIT', 2, '1', '2015-09-18', 'Valenzuela', 'Palawan', '12479837', '90453567245', 'joselito@gmail.com', 'Leyte', 'Regular', '2018-05-24 18:03:17', '2018-05-24 18:03:17', NULL, 'Active'),
(57, '2017-00171', 'Robert', '', 'Zorco', 'Female', 'BSIT', 2, '1', '2015-09-19', 'Dela Costa', 'Aklan', '12234567', '98765432187', 'robert@gmail.com', 'Palawan', 'Regular', '2018-05-24 18:03:17', '2018-05-24 18:03:17', NULL, 'Active'),
(58, '2017-00140', 'Bianca', '', 'Ezra', 'Female', 'BSIT', 2, '1', '2015-09-20', 'Fairview', 'Marinduque', '12345678', '90453567245', 'bianca@gmail.com', 'Aklan', 'Regular', '2018-05-24 18:03:17', '2018-05-24 18:03:17', NULL, 'Active'),
(59, '2017-00256', 'Donna', '', 'Pelo', 'Female', 'BSIT', 1, '1', '2015-09-21', 'Quezon City', 'Ilocos', '12479837', '98765432187', 'donna@gmail.com', 'Ilocos', 'Regular', '2018-05-24 18:03:17', '2018-05-24 18:03:17', NULL, 'Active'),
(60, '2017-00257', 'Brian', '', 'Ortiz', 'Female', 'BSIT', 1, '1', '2015-09-22', 'Commonwealth', 'Agusan', '12479837', '90453567245', 'brian@gmail.com', 'Agusan', 'Regular', '2018-05-24 18:03:17', '2018-05-24 18:03:17', NULL, 'Active'),
(61, '2017-00258', 'Bianca', '', 'Yeti', 'Female', 'BSIT', 1, '1', '2015-09-23', 'Caloocan', 'Zambales', '12479837', '98765423465', 'bianca@gmail.com', 'Zambales', 'Regular', '2018-05-24 18:03:17', '2018-05-24 18:03:17', NULL, 'Active'),
(62, '2017-00259', 'Gino', '', 'Heusaff', 'Female', 'BSIT', 1, '1', '2015-09-24', 'Fairview', 'Nueva Ecija', '12479837', '92929292923', 'gino@gmail.com', 'Nueva Ecija', 'Regular', '2018-05-24 18:03:17', '2018-05-24 18:03:17', NULL, 'Active'),
(63, '2017-00260', 'Selena', '', 'Ayres', 'Female', 'BSIT', 1, '1', '2015-09-25', 'Novaliches', 'Bataan', '12479837', '98765432187', 'selena@gmail.com', 'Bataan', 'Regular', '2018-05-24 18:03:17', '2018-05-24 18:03:17', NULL, 'Active'),
(64, '2017-00261', 'Joroz', '', 'Abott', 'Female', 'BSIT', 1, '1', '2015-09-26', 'Bulacan', 'Tarlac', '12479837', '90453567245', 'joroz@gmail.com', 'Tarlac', 'Regular', '2018-05-24 18:03:17', '2018-05-24 18:03:17', NULL, 'Active'),
(65, '2017-00262', 'Alexandra', '', 'Myers', 'Female', 'BSIT', 1, '1', '2015-07-12', 'Navotas', 'Cabanatuan', '12479837', '98765423465', 'alexandra@gmail.com', 'Cabanatuan', 'Regular', '2018-05-24 18:03:17', '2018-05-24 18:03:17', NULL, 'Active'),
(66, '2017-00263', 'Christian', '', 'Dimatulac', 'Female', 'BSIT', 1, '1', '2015-07-13', 'Valenzuela', 'Baguio', '12479837', '92929292923', 'christian@gmail.com', 'Baguio', 'Regular', '2018-05-24 18:03:17', '2018-05-24 18:03:17', NULL, 'Active'),
(67, '2017-00264', 'Christene', '', 'Maykapa', 'Female', 'BSIT', 1, '1', '2015-07-14', 'Quezon City', 'Cebu', '12479837', '98765432187', 'christene@gmail.com', 'Cebu', 'Regular', '2018-05-24 18:03:17', '2018-05-24 18:03:17', NULL, 'Active'),
(68, '2017-00265', 'Polo', '', 'Woods', 'Female', 'BSIT', 1, '1', '2015-07-15', 'Commonwealth', 'Samar', '12479837', '90453567245', 'polo@gmail.com', 'Samar', 'Regular', '2018-05-24 18:03:17', '2018-05-24 18:03:17', NULL, 'Active'),
(69, '2017-00266', 'Lara', '', 'Agbayani', 'Female', 'BSIT', 1, '1', '2015-07-16', 'Caloocan', 'Leyte', '12479837', '98765423465', 'lara@gmail.com', 'Leyte', 'Regular', '2018-05-24 18:03:17', '2018-05-24 18:03:17', NULL, 'Active'),
(70, '2017-00245', 'Cholo', '', 'Abuang', 'Female', 'BSIT', 1, '1', '2015-07-17', 'Fairview', 'Palawan', '12479837', '92929292923', 'cholo@gmail.com', 'Palawan', 'Regular', '2018-05-24 18:03:17', '2018-05-24 18:03:17', NULL, 'Active'),
(71, '2017-00269', 'Venice', '', 'Bocasan', 'Female', 'BSIT', 1, '1', '2015-07-18', 'Novaliches', 'Aklan', '12479837', '98765432187', 'venice@gmail.com', 'Aklan', 'Regular', '2018-05-24 18:03:17', '2018-05-24 18:03:17', NULL, 'Active'),
(72, '2017-00271', 'Xavier', '', 'Guipit', 'Female', 'BSIT', 1, '1', '2015-07-19', 'Bulacan', 'Marinduque', '12479837', '90453567245', 'xavier@gmail.com', 'Marinduque', 'Regular', '2018-05-24 18:03:17', '2018-05-24 18:03:17', NULL, 'Active'),
(73, '2017-00240', 'Zara', '', 'Sawit', 'Female', 'BSIT', 1, '1', '2015-07-20', 'Navotas', 'Ilocos', '12479837', '98765423465', 'zara@gmail.com', 'Navotas', 'Regular', '2018-05-24 18:03:17', '2018-05-24 18:03:17', NULL, 'Active');

-- --------------------------------------------------------

--
-- Table structure for table `r_stud_psych_rec`
--

DROP TABLE IF EXISTS `r_stud_psych_rec`;
CREATE TABLE `r_stud_psych_rec` (
  `Stud_NO_REFERENCE` varchar(15) NOT NULL,
  `PsychRec_PREV_CONSULTED` enum('Psychiatrist','Psychologist','Counselor') NOT NULL,
  `PsychRec_CONSULTED_WHEN` varchar(1000) DEFAULT 'None',
  `PsychRec_REASON` varchar(1000) DEFAULT 'None'
) ENGINE=InnoDB DEFAULT CHARSET=latin1 ROW_FORMAT=COMPACT;

--
-- Truncate table before insert `r_stud_psych_rec`
--

TRUNCATE TABLE `r_stud_psych_rec`;
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
-- Table structure for table `r_upload_category`
--

DROP TABLE IF EXISTS `r_upload_category`;
CREATE TABLE `r_upload_category` (
  `Upload_CATEGORY_ID` int(11) NOT NULL,
  `Upload_FILE_CATEGORY` varchar(100) NOT NULL,
  `Upload_CATEGORY_STAT` enum('Active','Inactive') DEFAULT 'Active'
) ENGINE=InnoDB DEFAULT CHARSET=latin1 ROW_FORMAT=COMPACT;

--
-- Truncate table before insert `r_upload_category`
--

TRUNCATE TABLE `r_upload_category`;
--
-- Dumping data for table `r_upload_category`
--

INSERT INTO `r_upload_category` (`Upload_CATEGORY_ID`, `Upload_FILE_CATEGORY`, `Upload_CATEGORY_STAT`) VALUES
(1, 'Excuse Letter', 'Active');

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
-- Table structure for table `r_visit`
--

DROP TABLE IF EXISTS `r_visit`;
CREATE TABLE `r_visit` (
  `Visit_ID` int(11) NOT NULL,
  `Visit_TYPE` varchar(50) NOT NULL,
  `Visit_DESC` text,
  `Visit_TYPE_STAT` enum('Active','Inactive') DEFAULT 'Active'
) ENGINE=InnoDB DEFAULT CHARSET=latin1 ROW_FORMAT=COMPACT;

--
-- Truncate table before insert `r_visit`
--

TRUNCATE TABLE `r_visit`;
--
-- Dumping data for table `r_visit`
--

INSERT INTO `r_visit` (`Visit_ID`, `Visit_TYPE`, `Visit_DESC`, `Visit_TYPE_STAT`) VALUES
(1, 'Signing of Clearance', NULL, 'Active'),
(3, 'Certificate of Candidacy', NULL, 'Active'),
(4, 'Excuse Letter', NULL, 'Active'),
(7, 'Counseling', '', 'Active');

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
(5, '2012-00075-CM-0', '2019-2020', 'Summer Semester', 'SIG00005', '2018-05-21 14:56:15', '2018-05-22 12:50:04', 'Inactive'),
(6, '2015-00138-CM-0', '2019-2020', 'Summer Semester', 'SIG00001', '2018-05-28 14:03:23', '2018-05-28 16:12:16', 'Active'),
(7, '2015-00138-CM-0', '2019-2020', 'Summer Semester', 'SIG00002', '2018-05-28 14:03:23', '2018-05-28 16:12:16', 'Active'),
(9, '2015-00138-CM-0', '2019-2020', 'Summer Semester', 'SIG00003', '2018-05-28 14:03:23', '2018-05-28 14:03:23', 'Inactive'),
(10, '2015-00138-CM-0', '2019-2020', 'Summer Semester', 'SIG00004', '2018-05-28 14:03:23', '2018-05-28 14:03:41', 'Inactive'),
(8, '2015-00138-CM-0', '2019-2020', 'Summer Semester', 'SIG00005', '2018-05-28 14:03:23', '2018-05-28 14:03:41', 'Inactive');

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
--
-- Dumping data for table `t_clearance_generated_code`
--

INSERT INTO `t_clearance_generated_code` (`ClearanceGenCode_ID`, `ClearanceGenCode_STUD_NO`, `ClearanceGenCode_ACADEMIC_YEAR`, `ClearanceGenCode_SEMESTER`, `ClearanceGenCode_COD_VALUE`, `ClearanceGenCode_IS_CLAIMED`, `ClearanceGenCode_IS_GENERATE`, `ClearanceGenCode_DATE_ADD`, `ClearanceGenCode_DATE_MOD`, `ClearanceGenCode_DISPLAY_STAT`) VALUES
(2, '2015-00073-Cm-0', '2019-2020', 'Summer Semester', 0x68645655793734693676545a525570, NULL, '2018-05-29 09:57:33', '2018-05-29 09:57:33', '2018-05-29 09:57:33', 'Active'),
(1, '2017-00057', '2019-2020', 'Summer Semester', 0x3852756950426743744f324b694a70, NULL, '2018-05-29 09:57:33', '2018-05-29 09:57:33', '2018-05-29 09:57:33', 'Active'),
(3, '2017-00058', '2019-2020', 'Summer Semester', 0x7a553856646b5072574c3548723738, NULL, '2018-05-29 09:57:33', '2018-05-29 09:57:33', '2018-05-29 09:57:33', 'Active'),
(6, '2017-00059', '2019-2020', 'Summer Semester', 0x35463879787955326b38634358754d, NULL, '2018-05-29 09:57:33', '2018-05-29 09:57:33', '2018-05-29 09:57:33', 'Active'),
(5, '2017-00060', '2019-2020', 'Summer Semester', 0x70744c386e674d5a4a326d46533851, NULL, '2018-05-29 09:57:33', '2018-05-29 09:57:33', '2018-05-29 09:57:33', 'Active'),
(4, '2017-00061', '2019-2020', 'Summer Semester', 0x6133673564775679506f4f30307344, NULL, '2018-05-29 09:57:33', '2018-05-29 09:57:33', '2018-05-29 09:57:33', 'Active'),
(7, '2017-00062', '2019-2020', 'Summer Semester', 0x3552644f7641635a70557768475771, NULL, '2018-05-29 09:57:34', '2018-05-29 09:57:34', '2018-05-29 09:57:34', 'Active'),
(8, '2017-00063', '2019-2020', 'Summer Semester', 0x46706f6953624d4552643579754654, NULL, '2018-05-29 09:57:35', '2018-05-29 09:57:35', '2018-05-29 09:57:35', 'Active'),
(9, '2017-00064', '2019-2020', 'Summer Semester', 0x5077333341316d59504f6e4363394a, NULL, '2018-05-29 09:57:35', '2018-05-29 09:57:35', '2018-05-29 09:57:35', 'Active'),
(11, '2017-00065', '2019-2020', 'Summer Semester', 0x4d4e50314347346a4f47526931624d, NULL, '2018-05-29 09:57:36', '2018-05-29 09:57:36', '2018-05-29 09:57:36', 'Active'),
(10, '2017-00066', '2019-2020', 'Summer Semester', 0x4131724976577a5645387a415a7733, NULL, '2018-05-29 09:57:36', '2018-05-29 09:57:36', '2018-05-29 09:57:36', 'Active'),
(53, '2017-00140', '2019-2020', 'Summer Semester', 0x764d694831426c374a464859466356, NULL, '2018-05-29 09:57:39', '2018-05-29 09:57:39', '2018-05-29 09:57:39', 'Active'),
(55, '2017-00145', '2019-2020', 'Summer Semester', 0x33724d477144686c42385156386e4e, NULL, '2018-05-29 09:57:39', '2018-05-29 09:57:39', '2018-05-29 09:57:39', 'Active'),
(44, '2017-00156', '2019-2020', 'Summer Semester', 0x6c696845494e4d7454557461393274, NULL, '2018-05-29 09:57:39', '2018-05-29 09:57:39', '2018-05-29 09:57:39', 'Active'),
(43, '2017-00157', '2019-2020', 'Summer Semester', 0x7578696c72795967316341704e5547, NULL, '2018-05-29 09:57:39', '2018-05-29 09:57:39', '2018-05-29 09:57:39', 'Active'),
(45, '2017-00158', '2019-2020', 'Summer Semester', 0x544c3177587477704b476d48344a55, NULL, '2018-05-29 09:57:39', '2018-05-29 09:57:39', '2018-05-29 09:57:39', 'Active'),
(46, '2017-00159', '2019-2020', 'Summer Semester', 0x416b7757677866594e67464b536d65, NULL, '2018-05-29 09:57:39', '2018-05-29 09:57:39', '2018-05-29 09:57:39', 'Active'),
(47, '2017-00160', '2019-2020', 'Summer Semester', 0x74554f586c6e4b7455685532395267, NULL, '2018-05-29 09:57:39', '2018-05-29 09:57:39', '2018-05-29 09:57:39', 'Active'),
(51, '2017-00161', '2019-2020', 'Summer Semester', 0x7a6556544d707044503156444b3555, NULL, '2018-05-29 09:57:39', '2018-05-29 09:57:39', '2018-05-29 09:57:39', 'Active'),
(50, '2017-00162', '2019-2020', 'Summer Semester', 0x5a4e66336a306d47666a7336445661, NULL, '2018-05-29 09:57:39', '2018-05-29 09:57:39', '2018-05-29 09:57:39', 'Active'),
(49, '2017-00163', '2019-2020', 'Summer Semester', 0x3677795671656f3848456e516a3932, NULL, '2018-05-29 09:57:39', '2018-05-29 09:57:39', '2018-05-29 09:57:39', 'Active'),
(48, '2017-00164', '2019-2020', 'Summer Semester', 0x464d4f574771766b566f316334545a, NULL, '2018-05-29 09:57:39', '2018-05-29 09:57:39', '2018-05-29 09:57:39', 'Active'),
(52, '2017-00165', '2019-2020', 'Summer Semester', 0x5365614a31417745646a43724e5943, NULL, '2018-05-29 09:57:39', '2018-05-29 09:57:39', '2018-05-29 09:57:39', 'Active'),
(57, '2017-00166', '2019-2020', 'Summer Semester', 0x61324f384e5a4f427a39416b393738, NULL, '2018-05-29 09:57:39', '2018-05-29 09:57:39', '2018-05-29 09:57:39', 'Active'),
(54, '2017-00169', '2019-2020', 'Summer Semester', 0x385859736a31486e4e364d675a7331, NULL, '2018-05-29 09:57:39', '2018-05-29 09:57:39', '2018-05-29 09:57:39', 'Active'),
(56, '2017-00171', '2019-2020', 'Summer Semester', 0x4a6a707a353264664155506a6c7737, NULL, '2018-05-29 09:57:39', '2018-05-29 09:57:39', '2018-05-29 09:57:39', 'Active'),
(72, '2017-00240', '2019-2020', 'Summer Semester', 0x516a526d47785458314a7644334672, NULL, '2018-05-29 09:57:40', '2018-05-29 09:57:40', '2018-05-29 09:57:40', 'Active'),
(67, '2017-00245', '2019-2020', 'Summer Semester', 0x7433677352424735777a6952366f57, NULL, '2018-05-29 09:57:40', '2018-05-29 09:57:40', '2018-05-29 09:57:40', 'Active'),
(58, '2017-00256', '2019-2020', 'Summer Semester', 0x42704d4866374e48476f495a52304d, NULL, '2018-05-29 09:57:39', '2018-05-29 09:57:39', '2018-05-29 09:57:39', 'Active'),
(64, '2017-00257', '2019-2020', 'Summer Semester', 0x6d616a457472676965494133423831, NULL, '2018-05-29 09:57:39', '2018-05-29 09:57:39', '2018-05-29 09:57:39', 'Active'),
(59, '2017-00258', '2019-2020', 'Summer Semester', 0x78344b494f533837395a4d596f354d, NULL, '2018-05-29 09:57:39', '2018-05-29 09:57:39', '2018-05-29 09:57:39', 'Active'),
(62, '2017-00259', '2019-2020', 'Summer Semester', 0x4e46777943744e5232556e38425448, NULL, '2018-05-29 09:57:39', '2018-05-29 09:57:39', '2018-05-29 09:57:39', 'Active'),
(61, '2017-00260', '2019-2020', 'Summer Semester', 0x504a7776796f6e754145346553657a, NULL, '2018-05-29 09:57:39', '2018-05-29 09:57:39', '2018-05-29 09:57:39', 'Active'),
(60, '2017-00261', '2019-2020', 'Summer Semester', 0x4f6f75393154435247433635535267, NULL, '2018-05-29 09:57:39', '2018-05-29 09:57:39', '2018-05-29 09:57:39', 'Active'),
(63, '2017-00262', '2019-2020', 'Summer Semester', 0x78434a496f796e49786b35356c3046, NULL, '2018-05-29 09:57:39', '2018-05-29 09:57:39', '2018-05-29 09:57:39', 'Active'),
(65, '2017-00263', '2019-2020', 'Summer Semester', 0x36544679676b6c586f687275517846, NULL, '2018-05-29 09:57:40', '2018-05-29 09:57:40', '2018-05-29 09:57:40', 'Active'),
(68, '2017-00264', '2019-2020', 'Summer Semester', 0x4334345a634e4c67486b6567664545, NULL, '2018-05-29 09:57:40', '2018-05-29 09:57:40', '2018-05-29 09:57:40', 'Active'),
(69, '2017-00265', '2019-2020', 'Summer Semester', 0x4a5342597062756f716a5932374362, NULL, '2018-05-29 09:57:40', '2018-05-29 09:57:40', '2018-05-29 09:57:40', 'Active'),
(66, '2017-00266', '2019-2020', 'Summer Semester', 0x316e66464c664e3653324e456a4e6b, NULL, '2018-05-29 09:57:40', '2018-05-29 09:57:40', '2018-05-29 09:57:40', 'Active'),
(70, '2017-00269', '2019-2020', 'Summer Semester', 0x48577151624e324b4a62336138584d, NULL, '2018-05-29 09:57:40', '2018-05-29 09:57:40', '2018-05-29 09:57:40', 'Active'),
(71, '2017-00271', '2019-2020', 'Summer Semester', 0x52316139775842496e5472736f6c43, NULL, '2018-05-29 09:57:40', '2018-05-29 09:57:40', '2018-05-29 09:57:40', 'Active'),
(12, '2017-0067', '2019-2020', 'Summer Semester', 0x36706a666257314b6a376a6c786934, NULL, '2018-05-29 09:57:36', '2018-05-29 09:57:36', '2018-05-29 09:57:36', 'Active'),
(13, '2017-0068', '2019-2020', 'Summer Semester', 0x6f45766d6f327033644c3064616361, NULL, '2018-05-29 09:57:37', '2018-05-29 09:57:37', '2018-05-29 09:57:37', 'Active'),
(15, '2017-0069', '2019-2020', 'Summer Semester', 0x706c73356e4b67497746386663314d, NULL, '2018-05-29 09:57:37', '2018-05-29 09:57:37', '2018-05-29 09:57:37', 'Active'),
(16, '2017-0070', '2019-2020', 'Summer Semester', 0x776879417456626a5731454e4a4e33, NULL, '2018-05-29 09:57:37', '2018-05-29 09:57:37', '2018-05-29 09:57:37', 'Active'),
(14, '2017-0071', '2019-2020', 'Summer Semester', 0x644370336936576c6e774269434276, NULL, '2018-05-29 09:57:37', '2018-05-29 09:57:37', '2018-05-29 09:57:37', 'Active'),
(18, '2017-0072', '2019-2020', 'Summer Semester', 0x323448543165365a7a73576a5a5375, NULL, '2018-05-29 09:57:37', '2018-05-29 09:57:37', '2018-05-29 09:57:37', 'Active'),
(17, '2017-0073', '2019-2020', 'Summer Semester', 0x387558756b69306d7278784e6e3654, NULL, '2018-05-29 09:57:37', '2018-05-29 09:57:37', '2018-05-29 09:57:37', 'Active'),
(19, '2017-0074', '2019-2020', 'Summer Semester', 0x6a5871373370536a704852306c4747, NULL, '2018-05-29 09:57:37', '2018-05-29 09:57:37', '2018-05-29 09:57:37', 'Active'),
(20, '2017-0075', '2019-2020', 'Summer Semester', 0x526561764b4f5376576859796d744e, NULL, '2018-05-29 09:57:37', '2018-05-29 09:57:37', '2018-05-29 09:57:37', 'Active'),
(23, '2017-0076', '2019-2020', 'Summer Semester', 0x376e6e4b67744654654d5679695933, NULL, '2018-05-29 09:57:37', '2018-05-29 09:57:37', '2018-05-29 09:57:37', 'Active'),
(21, '2017-0077', '2019-2020', 'Summer Semester', 0x50716335615034516b4c326b704745, NULL, '2018-05-29 09:57:37', '2018-05-29 09:57:37', '2018-05-29 09:57:37', 'Active'),
(22, '2017-0078', '2019-2020', 'Summer Semester', 0x775038394133553548594173304763, NULL, '2018-05-29 09:57:37', '2018-05-29 09:57:37', '2018-05-29 09:57:37', 'Active'),
(24, '2017-0079', '2019-2020', 'Summer Semester', 0x7744376e6d694f666b6d6b5039734a, NULL, '2018-05-29 09:57:37', '2018-05-29 09:57:37', '2018-05-29 09:57:37', 'Active'),
(27, '2017-0080', '2019-2020', 'Summer Semester', 0x504a467346427468627449754b5033, NULL, '2018-05-29 09:57:37', '2018-05-29 09:57:37', '2018-05-29 09:57:37', 'Active'),
(25, '2017-0081', '2019-2020', 'Summer Semester', 0x3136627550586670454a483035376d, NULL, '2018-05-29 09:57:37', '2018-05-29 09:57:37', '2018-05-29 09:57:37', 'Active'),
(26, '2017-0082', '2019-2020', 'Summer Semester', 0x39486f74336d70596c546d4b74357a, NULL, '2018-05-29 09:57:37', '2018-05-29 09:57:37', '2018-05-29 09:57:37', 'Active'),
(30, '2017-0083', '2019-2020', 'Summer Semester', 0x44737865704657735336565a6f6d50, NULL, '2018-05-29 09:57:38', '2018-05-29 09:57:38', '2018-05-29 09:57:38', 'Active'),
(28, '2017-0084', '2019-2020', 'Summer Semester', 0x6259326f726443456b556270737061, NULL, '2018-05-29 09:57:38', '2018-05-29 09:57:38', '2018-05-29 09:57:38', 'Active'),
(33, '2017-0085', '2019-2020', 'Summer Semester', 0x763648717558754d3145485972766a, NULL, '2018-05-29 09:57:38', '2018-05-29 09:57:38', '2018-05-29 09:57:38', 'Active'),
(31, '2017-0086', '2019-2020', 'Summer Semester', 0x73344331536d464d424a5663314768, NULL, '2018-05-29 09:57:38', '2018-05-29 09:57:38', '2018-05-29 09:57:38', 'Active'),
(32, '2017-0087', '2019-2020', 'Summer Semester', 0x6958714b6548533763433944617664, NULL, '2018-05-29 09:57:38', '2018-05-29 09:57:38', '2018-05-29 09:57:38', 'Active'),
(29, '2017-0088', '2019-2020', 'Summer Semester', 0x456b4346726a465559633071564552, NULL, '2018-05-29 09:57:38', '2018-05-29 09:57:38', '2018-05-29 09:57:38', 'Active'),
(34, '2017-0089', '2019-2020', 'Summer Semester', 0x354a737a78664b427731517a797974, NULL, '2018-05-29 09:57:38', '2018-05-29 09:57:38', '2018-05-29 09:57:38', 'Active'),
(36, '2017-0090', '2019-2020', 'Summer Semester', 0x783057384273614d466545587a4932, NULL, '2018-05-29 09:57:38', '2018-05-29 09:57:38', '2018-05-29 09:57:38', 'Active'),
(39, '2017-0091', '2019-2020', 'Summer Semester', 0x703639424735584877786e69545146, NULL, '2018-05-29 09:57:38', '2018-05-29 09:57:38', '2018-05-29 09:57:38', 'Active'),
(35, '2017-0092', '2019-2020', 'Summer Semester', 0x75566e374e61626d5239595834704c, NULL, '2018-05-29 09:57:38', '2018-05-29 09:57:38', '2018-05-29 09:57:38', 'Active'),
(38, '2017-0093', '2019-2020', 'Summer Semester', 0x385369306d53474274553052495758, NULL, '2018-05-29 09:57:38', '2018-05-29 09:57:38', '2018-05-29 09:57:38', 'Active'),
(37, '2017-0094', '2019-2020', 'Summer Semester', 0x77527732715a5a6c416354357a6f55, NULL, '2018-05-29 09:57:38', '2018-05-29 09:57:38', '2018-05-29 09:57:38', 'Active'),
(40, '2017-0095', '2019-2020', 'Summer Semester', 0x6b5763764961594630627335695a41, NULL, '2018-05-29 09:57:38', '2018-05-29 09:57:38', '2018-05-29 09:57:38', 'Active'),
(42, '2017-0096', '2019-2020', 'Summer Semester', 0x7875727972317a6b6c767542386971, NULL, '2018-05-29 09:57:39', '2018-05-29 09:57:39', '2018-05-29 09:57:39', 'Active'),
(41, '2017-0097', '2019-2020', 'Summer Semester', 0x4f6b4835384e5a3054446572653654, NULL, '2018-05-29 09:57:38', '2018-05-29 09:57:38', '2018-05-29 09:57:38', 'Active');

-- --------------------------------------------------------

--
-- Table structure for table `t_counseling`
--

DROP TABLE IF EXISTS `t_counseling`;
CREATE TABLE `t_counseling` (
  `Couns_ID` int(11) NOT NULL,
  `Couns_CODE` varchar(15) NOT NULL,
  `Visit_ID_REFERENCE` int(11) NOT NULL,
  `Couns_DATE` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP,
  `Couns_COUNSELING_TYPE` varchar(50) NOT NULL,
  `Couns_APPOINTMENT_TYPE` varchar(25) NOT NULL,
  `Nature_Of_Case` varchar(50) DEFAULT NULL,
  `Couns_BACKGROUND` text,
  `Couns_GOALS` text,
  `Couns_COMMENT` text,
  `Couns_RECOMMENDATION` text
) ENGINE=InnoDB DEFAULT CHARSET=latin1 ROW_FORMAT=COMPACT;

--
-- Truncate table before insert `t_counseling`
--

TRUNCATE TABLE `t_counseling`;
--
-- Dumping data for table `t_counseling`
--

INSERT INTO `t_counseling` (`Couns_ID`, `Couns_CODE`, `Visit_ID_REFERENCE`, `Couns_DATE`, `Couns_COUNSELING_TYPE`, `Couns_APPOINTMENT_TYPE`, `Nature_Of_Case`, `Couns_BACKGROUND`, `Couns_GOALS`, `Couns_COMMENT`, `Couns_RECOMMENDATION`) VALUES
(1, 'IC18-5231', 2, '2018-05-22 17:54:41', 'Individual Counseling', 'Referral', NULL, 'null', 'null', 'null', NULL);

-- --------------------------------------------------------

--
-- Table structure for table `t_couns_approach`
--

DROP TABLE IF EXISTS `t_couns_approach`;
CREATE TABLE `t_couns_approach` (
  `Couns_ID_REFERENCE` int(11) NOT NULL,
  `Couns_APPROACH` varchar(50) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1 ROW_FORMAT=COMPACT;

--
-- Truncate table before insert `t_couns_approach`
--

TRUNCATE TABLE `t_couns_approach`;
-- --------------------------------------------------------

--
-- Table structure for table `t_couns_details`
--

DROP TABLE IF EXISTS `t_couns_details`;
CREATE TABLE `t_couns_details` (
  `Couns_ID_REFERENCE` int(11) NOT NULL,
  `Stud_NO` varchar(15) NOT NULL,
  `Couns_REMARKS` varchar(50) DEFAULT NULL,
  `Couns_REMARKS_DETAILS` text
) ENGINE=InnoDB DEFAULT CHARSET=latin1 ROW_FORMAT=COMPACT;

--
-- Truncate table before insert `t_couns_details`
--

TRUNCATE TABLE `t_couns_details`;
--
-- Dumping data for table `t_couns_details`
--

INSERT INTO `t_couns_details` (`Couns_ID_REFERENCE`, `Stud_NO`, `Couns_REMARKS`, `Couns_REMARKS_DETAILS`) VALUES
(1, '2015-00138-CM-0', NULL, NULL);

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

-- --------------------------------------------------------

--
-- Table structure for table `t_stud_visit`
--

DROP TABLE IF EXISTS `t_stud_visit`;
CREATE TABLE `t_stud_visit` (
  `Stud_VISIT_ID` int(11) NOT NULL,
  `Visit_CODE` varchar(15) NOT NULL,
  `Visit_DATE` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP,
  `Stud_NO` varchar(15) NOT NULL,
  `Visit_PURPOSE` varchar(50) NOT NULL,
  `Visit_DETAILS` text
) ENGINE=InnoDB DEFAULT CHARSET=latin1 ROW_FORMAT=COMPACT;

--
-- Truncate table before insert `t_stud_visit`
--

TRUNCATE TABLE `t_stud_visit`;
--
-- Dumping data for table `t_stud_visit`
--

INSERT INTO `t_stud_visit` (`Stud_VISIT_ID`, `Visit_CODE`, `Visit_DATE`, `Stud_NO`, `Visit_PURPOSE`, `Visit_DETAILS`) VALUES
(1, 'VS18-5231', '2018-05-22 16:10:38', '2015-00138-CM-0', 'Excuse Letter', 'Excuse Letter'),
(2, 'VS18-5232', '2018-05-22 16:25:05', '2015-00138-CM-0', 'Counseling', 'nahuling natutulog sa klase'),
(3, 'VS18-5233', '2018-05-22 18:03:58', '2015-00138-CM-0', 'Signing of Clearance', 'null');

-- --------------------------------------------------------

--
-- Table structure for table `t_upload`
--

DROP TABLE IF EXISTS `t_upload`;
CREATE TABLE `t_upload` (
  `Upload_FILE_ID` int(11) NOT NULL,
  `Upload_DATE` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP,
  `Upload_USER` varchar(15) NOT NULL,
  `Upload_FILENAME` varchar(200) NOT NULL,
  `Upload_CATEGORY` varchar(100) NOT NULL,
  `Upload_TYPE` varchar(15) NOT NULL,
  `Upload_FILETYPE` varchar(100) NOT NULL,
  `Upload_FILEPATH` varchar(100) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1 ROW_FORMAT=COMPACT;

--
-- Truncate table before insert `t_upload`
--

TRUNCATE TABLE `t_upload`;
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
-- Indexes for table `r_civil_stat`
--
ALTER TABLE `r_civil_stat`
  ADD PRIMARY KEY (`Stud_CIVIL_STATUS_ID`) USING BTREE,
  ADD UNIQUE KEY `Stud_CIVIL_STATUS` (`Stud_CIVIL_STATUS`) USING BTREE;

--
-- Indexes for table `r_clearance_signatories`
--
ALTER TABLE `r_clearance_signatories`
  ADD PRIMARY KEY (`ClearSignatories_ID`) USING BTREE,
  ADD UNIQUE KEY `UNQ_SancDetails_CODE` (`ClearSignatories_CODE`) USING BTREE;

--
-- Indexes for table `r_couns_appointment_type`
--
ALTER TABLE `r_couns_appointment_type`
  ADD PRIMARY KEY (`Appmnt_ID`) USING BTREE,
  ADD UNIQUE KEY `Appmnt_TYPE` (`Appmnt_TYPE`) USING BTREE;

--
-- Indexes for table `r_couns_approach`
--
ALTER TABLE `r_couns_approach`
  ADD PRIMARY KEY (`Couns_APPROACH_ID`) USING BTREE,
  ADD UNIQUE KEY `Couns_APPROACH` (`Couns_APPROACH`) USING BTREE;

--
-- Indexes for table `r_couns_type`
--
ALTER TABLE `r_couns_type`
  ADD PRIMARY KEY (`Couns_TYPE_ID`) USING BTREE,
  ADD UNIQUE KEY `Couns_TYPE` (`Couns_TYPE`) USING BTREE;

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
-- Indexes for table `r_guidance_counselor`
--
ALTER TABLE `r_guidance_counselor`
  ADD PRIMARY KEY (`Counselor_ID`) USING BTREE;

--
-- Indexes for table `r_nature_of_case`
--
ALTER TABLE `r_nature_of_case`
  ADD UNIQUE KEY `Case_NAME` (`Case_NAME`) USING BTREE;

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
-- Indexes for table `r_remarks`
--
ALTER TABLE `r_remarks`
  ADD PRIMARY KEY (`Remarks_ID`) USING BTREE,
  ADD UNIQUE KEY `Remarks_TYPE` (`Remarks_TYPE`) USING BTREE;

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
-- Indexes for table `r_stud_batch`
--
ALTER TABLE `r_stud_batch`
  ADD PRIMARY KEY (`Stud_BATCH_ID`) USING BTREE,
  ADD KEY `FK_stdbtchrfrnc_STUD_NO` (`Stud_NO`) USING BTREE,
  ADD KEY `FK_stdbtchyrrfrnc` (`Batch_YEAR`) USING BTREE;

--
-- Indexes for table `r_stud_educ_background`
--
ALTER TABLE `r_stud_educ_background`
  ADD PRIMARY KEY (`Educ_BG_ID`) USING BTREE,
  ADD KEY `FK_edcbckgrndrfrnc_STUD_NO` (`Stud_NO_REFERENCE`) USING BTREE;

--
-- Indexes for table `r_stud_educ_bg_details`
--
ALTER TABLE `r_stud_educ_bg_details`
  ADD KEY `FK_stdedcbgdtlsedcbg_ID` (`Educ_BG_ID`) USING BTREE;

--
-- Indexes for table `r_stud_family_bg_details`
--
ALTER TABLE `r_stud_family_bg_details`
  ADD KEY `FK_stdfmlybckgrndrfrnc_STUD_NO` (`Stud_NO_REFERENCE`) USING BTREE;

--
-- Indexes for table `r_stud_general_info`
--
ALTER TABLE `r_stud_general_info`
  ADD KEY `FK_gnrlinf_STUD_NO` (`Stud_NO`) USING BTREE;

--
-- Indexes for table `r_stud_honors_awards`
--
ALTER TABLE `r_stud_honors_awards`
  ADD KEY `FK_stdhnrsawrdsedcbg_ID` (`Educ_BG_ID`) USING BTREE,
  ADD KEY `FK_hnrsawrds_STUD_NO` (`Stud_NO_REFERENCE`) USING BTREE;

--
-- Indexes for table `r_stud_org_position`
--
ALTER TABLE `r_stud_org_position`
  ADD KEY `FK_orgpstn_STUD_NO` (`Stud_NO_REFERENCE`) USING BTREE;

--
-- Indexes for table `r_stud_personal_info`
--
ALTER TABLE `r_stud_personal_info`
  ADD KEY `FK_stdprsnlnfrfrnc_STUD_NO` (`Stud_NO_REFERENCE`) USING BTREE,
  ADD KEY `FK_stdprsnlnfcvlsttrfrnc` (`Stud_CIVIL_STAT`) USING BTREE;

--
-- Indexes for table `r_stud_phys_rec`
--
ALTER TABLE `r_stud_phys_rec`
  ADD KEY `FK_physrc_STUD_NO` (`Stud_NO_REFERENCE`) USING BTREE;

--
-- Indexes for table `r_stud_profile`
--
ALTER TABLE `r_stud_profile`
  ADD PRIMARY KEY (`Stud_ID`) USING BTREE,
  ADD UNIQUE KEY `PK_Stud_NO` (`Stud_NO`) USING BTREE,
  ADD KEY `FK_COURSE` (`Stud_COURSE`) USING BTREE;

--
-- Indexes for table `r_stud_psych_rec`
--
ALTER TABLE `r_stud_psych_rec`
  ADD KEY `FK_psychrc_STUD_NO` (`Stud_NO_REFERENCE`) USING BTREE;

--
-- Indexes for table `r_system_config`
--
ALTER TABLE `r_system_config`
  ADD PRIMARY KEY (`SysConfig_ID`) USING BTREE;

--
-- Indexes for table `r_upload_category`
--
ALTER TABLE `r_upload_category`
  ADD PRIMARY KEY (`Upload_CATEGORY_ID`) USING BTREE,
  ADD UNIQUE KEY `Upload_FILE_CATEGORY` (`Upload_FILE_CATEGORY`) USING BTREE;

--
-- Indexes for table `r_users`
--
ALTER TABLE `r_users`
  ADD PRIMARY KEY (`Users_ID`) USING BTREE,
  ADD UNIQUE KEY `UNQ_Users_USERNAME` (`Users_USERNAME`) USING BTREE;

--
-- Indexes for table `r_visit`
--
ALTER TABLE `r_visit`
  ADD PRIMARY KEY (`Visit_ID`) USING BTREE,
  ADD UNIQUE KEY `Visit_TYPE` (`Visit_TYPE`) USING BTREE;

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
-- Indexes for table `t_counseling`
--
ALTER TABLE `t_counseling`
  ADD PRIMARY KEY (`Couns_ID`) USING BTREE,
  ADD UNIQUE KEY `Couns_CODE` (`Couns_CODE`) USING BTREE,
  ADD KEY `FK_cnslngvstidrfrnc` (`Visit_ID_REFERENCE`) USING BTREE,
  ADD KEY `FK_C_CT_REFERENCE` (`Couns_COUNSELING_TYPE`) USING BTREE,
  ADD KEY `FK_cnslngcnsppntmnttyp` (`Couns_APPOINTMENT_TYPE`) USING BTREE,
  ADD KEY `FK_cnslngntrfcsrfrnc` (`Nature_Of_Case`) USING BTREE;

--
-- Indexes for table `t_couns_approach`
--
ALTER TABLE `t_couns_approach`
  ADD KEY `FK_cnspprchcnsidrfrnc` (`Couns_ID_REFERENCE`) USING BTREE,
  ADD KEY `FK_C_CA_REFERENCE` (`Couns_APPROACH`) USING BTREE;

--
-- Indexes for table `t_couns_details`
--
ALTER TABLE `t_couns_details`
  ADD KEY `FK_CnsIDrfrnc` (`Couns_ID_REFERENCE`) USING BTREE,
  ADD KEY `FK_cnslngstdnrfrnc` (`Stud_NO`) USING BTREE,
  ADD KEY `FK_cnsdtlscnsrmrksrfrnc` (`Couns_REMARKS`) USING BTREE;

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
-- Indexes for table `t_stud_visit`
--
ALTER TABLE `t_stud_visit`
  ADD PRIMARY KEY (`Stud_VISIT_ID`) USING BTREE,
  ADD UNIQUE KEY `Visit_CODE` (`Visit_CODE`) USING BTREE,
  ADD KEY `FK_vst_STUD_NO` (`Stud_NO`) USING BTREE,
  ADD KEY `FK_stdvstprps_vstrfrnc` (`Visit_PURPOSE`) USING BTREE;

--
-- Indexes for table `t_upload`
--
ALTER TABLE `t_upload`
  ADD PRIMARY KEY (`Upload_FILE_ID`) USING BTREE,
  ADD KEY `FK_pldctgryrfrnc` (`Upload_CATEGORY`) USING BTREE;

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
-- AUTO_INCREMENT for table `r_civil_stat`
--
ALTER TABLE `r_civil_stat`
  MODIFY `Stud_CIVIL_STATUS_ID` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=3;
--
-- AUTO_INCREMENT for table `r_clearance_signatories`
--
ALTER TABLE `r_clearance_signatories`
  MODIFY `ClearSignatories_ID` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=18;
--
-- AUTO_INCREMENT for table `r_couns_appointment_type`
--
ALTER TABLE `r_couns_appointment_type`
  MODIFY `Appmnt_ID` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=3;
--
-- AUTO_INCREMENT for table `r_couns_approach`
--
ALTER TABLE `r_couns_approach`
  MODIFY `Couns_APPROACH_ID` int(11) NOT NULL AUTO_INCREMENT;
--
-- AUTO_INCREMENT for table `r_couns_type`
--
ALTER TABLE `r_couns_type`
  MODIFY `Couns_TYPE_ID` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=3;
--
-- AUTO_INCREMENT for table `r_courses`
--
ALTER TABLE `r_courses`
  MODIFY `Course_ID` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=5;
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
-- AUTO_INCREMENT for table `r_guidance_counselor`
--
ALTER TABLE `r_guidance_counselor`
  MODIFY `Counselor_ID` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2;
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
-- AUTO_INCREMENT for table `r_remarks`
--
ALTER TABLE `r_remarks`
  MODIFY `Remarks_ID` int(11) NOT NULL AUTO_INCREMENT;
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
-- AUTO_INCREMENT for table `r_stud_batch`
--
ALTER TABLE `r_stud_batch`
  MODIFY `Stud_BATCH_ID` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2;
--
-- AUTO_INCREMENT for table `r_stud_educ_background`
--
ALTER TABLE `r_stud_educ_background`
  MODIFY `Educ_BG_ID` int(11) NOT NULL AUTO_INCREMENT;
--
-- AUTO_INCREMENT for table `r_stud_profile`
--
ALTER TABLE `r_stud_profile`
  MODIFY `Stud_ID` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=74;
--
-- AUTO_INCREMENT for table `r_system_config`
--
ALTER TABLE `r_system_config`
  MODIFY `SysConfig_ID` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2;
--
-- AUTO_INCREMENT for table `r_upload_category`
--
ALTER TABLE `r_upload_category`
  MODIFY `Upload_CATEGORY_ID` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2;
--
-- AUTO_INCREMENT for table `r_users`
--
ALTER TABLE `r_users`
  MODIFY `Users_ID` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=18;
--
-- AUTO_INCREMENT for table `r_visit`
--
ALTER TABLE `r_visit`
  MODIFY `Visit_ID` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=8;
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
  MODIFY `AssStudClearance_ID` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=11;
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
  MODIFY `ClearanceGenCode_ID` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=73;
--
-- AUTO_INCREMENT for table `t_counseling`
--
ALTER TABLE `t_counseling`
  MODIFY `Couns_ID` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2;
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
-- AUTO_INCREMENT for table `t_stud_visit`
--
ALTER TABLE `t_stud_visit`
  MODIFY `Stud_VISIT_ID` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=4;
--
-- AUTO_INCREMENT for table `t_upload`
--
ALTER TABLE `t_upload`
  MODIFY `Upload_FILE_ID` int(11) NOT NULL AUTO_INCREMENT;
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
-- Constraints for table `r_stud_batch`
--
ALTER TABLE `r_stud_batch`
  ADD CONSTRAINT `FK_stdbtchrfrnc_STUD_NO` FOREIGN KEY (`Stud_NO`) REFERENCES `r_stud_profile` (`Stud_NO`) ON DELETE CASCADE ON UPDATE CASCADE,
  ADD CONSTRAINT `FK_stdbtchyrrfrnc` FOREIGN KEY (`Batch_YEAR`) REFERENCES `r_batch_details` (`Batch_YEAR`) ON DELETE CASCADE ON UPDATE CASCADE;

--
-- Constraints for table `r_stud_educ_background`
--
ALTER TABLE `r_stud_educ_background`
  ADD CONSTRAINT `FK_edcbckgrndrfrnc_STUD_NO` FOREIGN KEY (`Stud_NO_REFERENCE`) REFERENCES `r_stud_profile` (`Stud_NO`) ON DELETE CASCADE ON UPDATE CASCADE;

--
-- Constraints for table `r_stud_educ_bg_details`
--
ALTER TABLE `r_stud_educ_bg_details`
  ADD CONSTRAINT `FK_stdedcbgdtlsedcbg_ID` FOREIGN KEY (`Educ_BG_ID`) REFERENCES `r_stud_educ_background` (`Educ_BG_ID`) ON DELETE CASCADE ON UPDATE CASCADE;

--
-- Constraints for table `r_stud_family_bg_details`
--
ALTER TABLE `r_stud_family_bg_details`
  ADD CONSTRAINT `FK_stdfmlybckgrndrfrnc_STUD_NO` FOREIGN KEY (`Stud_NO_REFERENCE`) REFERENCES `r_stud_profile` (`Stud_NO`) ON DELETE CASCADE ON UPDATE CASCADE;

--
-- Constraints for table `r_stud_general_info`
--
ALTER TABLE `r_stud_general_info`
  ADD CONSTRAINT `FK_gnrlinf_STUD_NO` FOREIGN KEY (`Stud_NO`) REFERENCES `r_stud_profile` (`Stud_NO`) ON DELETE CASCADE ON UPDATE CASCADE;

--
-- Constraints for table `r_stud_honors_awards`
--
ALTER TABLE `r_stud_honors_awards`
  ADD CONSTRAINT `FK_hnrsawrds_STUD_NO` FOREIGN KEY (`Stud_NO_REFERENCE`) REFERENCES `r_stud_profile` (`Stud_NO`) ON DELETE CASCADE ON UPDATE CASCADE,
  ADD CONSTRAINT `FK_stdhnrsawrdsedcbg_ID` FOREIGN KEY (`Educ_BG_ID`) REFERENCES `r_stud_educ_background` (`Educ_BG_ID`) ON DELETE CASCADE ON UPDATE CASCADE;

--
-- Constraints for table `r_stud_org_position`
--
ALTER TABLE `r_stud_org_position`
  ADD CONSTRAINT `FK_orgpstn_STUD_NO` FOREIGN KEY (`Stud_NO_REFERENCE`) REFERENCES `r_stud_profile` (`Stud_NO`) ON DELETE CASCADE ON UPDATE CASCADE;

--
-- Constraints for table `r_stud_personal_info`
--
ALTER TABLE `r_stud_personal_info`
  ADD CONSTRAINT `FK_stdprsnlnfcvlsttrfrnc` FOREIGN KEY (`Stud_CIVIL_STAT`) REFERENCES `r_civil_stat` (`Stud_CIVIL_STATUS`) ON DELETE CASCADE ON UPDATE CASCADE,
  ADD CONSTRAINT `FK_stdprsnlnfrfrnc_STUD_NO` FOREIGN KEY (`Stud_NO_REFERENCE`) REFERENCES `r_stud_profile` (`Stud_NO`) ON DELETE CASCADE ON UPDATE CASCADE;

--
-- Constraints for table `r_stud_phys_rec`
--
ALTER TABLE `r_stud_phys_rec`
  ADD CONSTRAINT `FK_physrc_STUD_NO` FOREIGN KEY (`Stud_NO_REFERENCE`) REFERENCES `r_stud_profile` (`Stud_NO`) ON DELETE CASCADE ON UPDATE CASCADE;

--
-- Constraints for table `r_stud_profile`
--
ALTER TABLE `r_stud_profile`
  ADD CONSTRAINT `FK_COURSE` FOREIGN KEY (`Stud_COURSE`) REFERENCES `r_courses` (`Course_CODE`) ON DELETE CASCADE ON UPDATE CASCADE;

--
-- Constraints for table `r_stud_psych_rec`
--
ALTER TABLE `r_stud_psych_rec`
  ADD CONSTRAINT `FK_psychrc_STUD_NO` FOREIGN KEY (`Stud_NO_REFERENCE`) REFERENCES `r_stud_profile` (`Stud_NO`) ON DELETE CASCADE ON UPDATE CASCADE;

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
-- Constraints for table `t_counseling`
--
ALTER TABLE `t_counseling`
  ADD CONSTRAINT `FK_C_CT_REFERENCE` FOREIGN KEY (`Couns_COUNSELING_TYPE`) REFERENCES `r_couns_type` (`Couns_TYPE`) ON DELETE CASCADE ON UPDATE CASCADE,
  ADD CONSTRAINT `FK_cnslngcnsppntmnttyp` FOREIGN KEY (`Couns_APPOINTMENT_TYPE`) REFERENCES `r_couns_appointment_type` (`Appmnt_TYPE`) ON DELETE CASCADE ON UPDATE CASCADE,
  ADD CONSTRAINT `FK_cnslngntrfcsrfrnc` FOREIGN KEY (`Nature_Of_Case`) REFERENCES `r_nature_of_case` (`Case_NAME`) ON DELETE CASCADE ON UPDATE CASCADE,
  ADD CONSTRAINT `FK_cnslngvstidrfrnc` FOREIGN KEY (`Visit_ID_REFERENCE`) REFERENCES `t_stud_visit` (`Stud_VISIT_ID`) ON DELETE CASCADE ON UPDATE CASCADE;

--
-- Constraints for table `t_couns_approach`
--
ALTER TABLE `t_couns_approach`
  ADD CONSTRAINT `FK_C_CA_REFERENCE` FOREIGN KEY (`Couns_APPROACH`) REFERENCES `r_couns_approach` (`Couns_APPROACH`) ON DELETE CASCADE ON UPDATE CASCADE,
  ADD CONSTRAINT `FK_cnspprchcnsidrfrnc` FOREIGN KEY (`Couns_ID_REFERENCE`) REFERENCES `t_counseling` (`Couns_ID`) ON DELETE CASCADE ON UPDATE CASCADE;

--
-- Constraints for table `t_couns_details`
--
ALTER TABLE `t_couns_details`
  ADD CONSTRAINT `FK_CnsIDrfrnc` FOREIGN KEY (`Couns_ID_REFERENCE`) REFERENCES `t_counseling` (`Couns_ID`) ON DELETE CASCADE ON UPDATE CASCADE,
  ADD CONSTRAINT `FK_cnsdtlscnsrmrksrfrnc` FOREIGN KEY (`Couns_REMARKS`) REFERENCES `r_remarks` (`Remarks_TYPE`) ON DELETE CASCADE ON UPDATE CASCADE,
  ADD CONSTRAINT `FK_cnslngstdnrfrnc` FOREIGN KEY (`Stud_NO`) REFERENCES `r_stud_profile` (`Stud_NO`) ON DELETE CASCADE ON UPDATE CASCADE;

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
-- Constraints for table `t_stud_visit`
--
ALTER TABLE `t_stud_visit`
  ADD CONSTRAINT `FK_stdvstprps_vstrfrnc` FOREIGN KEY (`Visit_PURPOSE`) REFERENCES `r_visit` (`Visit_TYPE`) ON DELETE CASCADE ON UPDATE CASCADE,
  ADD CONSTRAINT `FK_vst_STUD_NO` FOREIGN KEY (`Stud_NO`) REFERENCES `r_stud_profile` (`Stud_NO`) ON DELETE CASCADE ON UPDATE CASCADE;

--
-- Constraints for table `t_upload`
--
ALTER TABLE `t_upload`
  ADD CONSTRAINT `FK_pldctgryrfrnc` FOREIGN KEY (`Upload_CATEGORY`) REFERENCES `r_upload_category` (`Upload_FILE_CATEGORY`) ON DELETE CASCADE ON UPDATE CASCADE;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
