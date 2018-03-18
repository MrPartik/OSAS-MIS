-- phpMyAdmin SQL Dump
-- version 4.7.0
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Generation Time: Mar 18, 2018 at 03:15 PM
-- Server version: 10.1.25-MariaDB
-- PHP Version: 5.6.31

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
SET AUTOCOMMIT = 0;
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `osas`
--

-- --------------------------------------------------------

--
-- Table structure for table `r_application_wizard`
--

CREATE TABLE IF NOT EXISTS `r_application_wizard` (
  `WIZARD_ID` int(11) NOT NULL AUTO_INCREMENT,
  `WIZARD_ORG_CODE` varchar(15) NOT NULL,
  `WIZARD_CURRENT_STEP` int(11) NOT NULL,
  PRIMARY KEY (`WIZARD_ID`),
  KEY `WIZARD_ORG_CODE` (`WIZARD_ORG_CODE`)
) ENGINE=InnoDB AUTO_INCREMENT=28 DEFAULT CHARSET=latin1;

-- --------------------------------------------------------

--
-- Table structure for table `r_archiving_documents`
--

CREATE TABLE IF NOT EXISTS `r_archiving_documents` (
  `ArchDocuments_ID` int(11) NOT NULL AUTO_INCREMENT,
  `ArchDocuments_ORDER_NO` int(11) NOT NULL,
  `ArchDocuments_NAME` varchar(100) NOT NULL,
  `ArchDocuments_DESC` varchar(100) NOT NULL DEFAULT 'Document Description',
  `ArchDocuments_FILE_PATH` varchar(1000) NOT NULL,
  `ArchDocuments_DATE_ADD` datetime NOT NULL DEFAULT CURRENT_TIMESTAMP,
  `ArchDocuments_DATE_MOD` datetime NOT NULL DEFAULT CURRENT_TIMESTAMP,
  `ArchDocuments_DISPLAY_STAT` enum('Active','Inactive') DEFAULT 'Active',
  PRIMARY KEY (`ArchDocuments_ID`),
  UNIQUE KEY `UNQ_ArchDocuments_ORDER_NO` (`ArchDocuments_ORDER_NO`)
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

-- --------------------------------------------------------

--
-- Table structure for table `r_batch_details`
--

CREATE TABLE IF NOT EXISTS `r_batch_details` (
  `Batch_ID` int(11) NOT NULL AUTO_INCREMENT,
  `Batch_CODE` varchar(15) NOT NULL,
  `Batch_YEAR` varchar(15) NOT NULL,
  `Batch_DESC` varchar(100) DEFAULT NULL,
  `Batch_DISPLAY_STAT` enum('Active','Inactive') DEFAULT 'Active',
  PRIMARY KEY (`Batch_ID`),
  UNIQUE KEY `UNQ_Batch_YEAR` (`Batch_YEAR`)
) ENGINE=InnoDB AUTO_INCREMENT=9 DEFAULT CHARSET=latin1;

-- --------------------------------------------------------

--
-- Table structure for table `r_clearance_signatories`
--

CREATE TABLE IF NOT EXISTS `r_clearance_signatories` (
  `ClearSignatories_ID` int(11) NOT NULL AUTO_INCREMENT,
  `ClearSignatories_CODE` varchar(15) NOT NULL,
  `ClearSignatories_NAME` varchar(100) NOT NULL,
  `ClearSignatories_DESC` varchar(100) DEFAULT 'Clearance Signatories Description',
  `ClearSignatories_DATE_MOD` datetime NOT NULL DEFAULT CURRENT_TIMESTAMP,
  `ClearSignatories_DATE_ADD` datetime NOT NULL DEFAULT CURRENT_TIMESTAMP,
  `ClearSignatories_DISPLAY_STAT` enum('Active','Inactive') DEFAULT 'Active',
  PRIMARY KEY (`ClearSignatories_ID`),
  UNIQUE KEY `UNQ_SancDetails_CODE` (`ClearSignatories_CODE`)
) ENGINE=InnoDB AUTO_INCREMENT=4 DEFAULT CHARSET=latin1;

-- --------------------------------------------------------

--
-- Table structure for table `r_courses`
--

CREATE TABLE IF NOT EXISTS `r_courses` (
  `Course_ID` int(11) NOT NULL AUTO_INCREMENT,
  `Course_CODE` varchar(15) NOT NULL,
  `Course_NAME` varchar(100) NOT NULL,
  `Course_DESC` varchar(100) DEFAULT 'Course Description',
  `Course_CURR_YEAR` varchar(15) DEFAULT NULL,
  `Course_DATE_MOD` datetime NOT NULL DEFAULT CURRENT_TIMESTAMP,
  `Course_DATE_ADD` datetime NOT NULL DEFAULT CURRENT_TIMESTAMP,
  `Course_DISPLAY_STAT` enum('Active','Inactive') DEFAULT 'Active',
  PRIMARY KEY (`Course_ID`),
  UNIQUE KEY `UNQ_Course_CODE` (`Course_CODE`),
  KEY `FK_Course_CURR_YEAR` (`Course_CURR_YEAR`)
) ENGINE=InnoDB AUTO_INCREMENT=6 DEFAULT CHARSET=latin1;

-- --------------------------------------------------------

--
-- Table structure for table `r_designated_offices_details`
--

CREATE TABLE IF NOT EXISTS `r_designated_offices_details` (
  `DesOffDetails_ID` int(11) NOT NULL AUTO_INCREMENT,
  `DesOffDetails_CODE` varchar(15) NOT NULL,
  `DesOffDetails_NAME` varchar(100) NOT NULL,
  `DesOffDetails_DESC` varchar(100) DEFAULT 'Offices Description',
  `DesOffDetails_DATE_ADD` datetime NOT NULL DEFAULT CURRENT_TIMESTAMP,
  `DesOffDetails_DATE_MOD` datetime NOT NULL DEFAULT CURRENT_TIMESTAMP,
  `DesOffDetails_DISPLAY_STAT` enum('Active','Inactive') DEFAULT 'Active',
  PRIMARY KEY (`DesOffDetails_ID`),
  UNIQUE KEY `UNQ_DesOffDetails_CODE` (`DesOffDetails_CODE`)
) ENGINE=InnoDB AUTO_INCREMENT=4 DEFAULT CHARSET=latin1;

-- --------------------------------------------------------

--
-- Table structure for table `r_financial_assistance_title`
--

CREATE TABLE IF NOT EXISTS `r_financial_assistance_title` (
  `FinAssiTitle_ID` int(11) NOT NULL AUTO_INCREMENT,
  `FinAssiTitle_CODE` varchar(15) NOT NULL,
  `FinAssiTitle_NAME` varchar(100) NOT NULL,
  `FinAssiTitle_DESC` varchar(100) DEFAULT 'Financial Assistantce Description',
  `FinAssiTitle_DATE_ADD` datetime NOT NULL DEFAULT CURRENT_TIMESTAMP,
  `FinAssiTitle_DATE_MOD` datetime NOT NULL DEFAULT CURRENT_TIMESTAMP,
  `FinAssiTitle_DISPLAY_STAT` enum('Active','Inactive') DEFAULT 'Active',
  PRIMARY KEY (`FinAssiTitle_ID`),
  UNIQUE KEY `UNQ_FinAssiTitle_NAME` (`FinAssiTitle_NAME`)
) ENGINE=InnoDB AUTO_INCREMENT=3 DEFAULT CHARSET=latin1;

-- --------------------------------------------------------

--
-- Table structure for table `r_org_accreditation_details`
--

CREATE TABLE IF NOT EXISTS `r_org_accreditation_details` (
  `OrgAccrDetail_ID` int(11) NOT NULL AUTO_INCREMENT,
  `OrgAccrDetail_CODE` varchar(15) NOT NULL,
  `OrgAccrDetail_NAME` varchar(100) NOT NULL,
  `OrgAccrDetail_DESC` varchar(100) DEFAULT 'Accreditation Description',
  `OrgAccrDetail_DATE_ADD` datetime NOT NULL DEFAULT CURRENT_TIMESTAMP,
  `OrgAccrDetail_DATE_MOD` datetime NOT NULL DEFAULT CURRENT_TIMESTAMP,
  `OrgAccrDetail_DISPLAY_STAT` enum('Active','Inactive') DEFAULT 'Active',
  PRIMARY KEY (`OrgAccrDetail_ID`),
  UNIQUE KEY `UNQ_OrgAccrDetail_CODE` (`OrgAccrDetail_CODE`)
) ENGINE=InnoDB AUTO_INCREMENT=4 DEFAULT CHARSET=latin1;

-- --------------------------------------------------------

--
-- Table structure for table `r_org_applicant_profile`
--

CREATE TABLE IF NOT EXISTS `r_org_applicant_profile` (
  `OrgAppProfile_ID` int(11) NOT NULL AUTO_INCREMENT,
  `OrgAppProfile_APPL_CODE` varchar(15) NOT NULL,
  `OrgAppProfile_NAME` varchar(100) NOT NULL,
  `OrgAppProfile_DESCRIPTION` varchar(500) DEFAULT 'Organization description should be here!',
  `OrgAppProfile_STATUS` varchar(100) NOT NULL DEFAULT 'This application is ready for accreditation',
  `OrgAppProfile_DATE_ADD` datetime NOT NULL DEFAULT CURRENT_TIMESTAMP,
  `OrgAppProfile_DATE_MOD` datetime NOT NULL DEFAULT CURRENT_TIMESTAMP,
  `OrgAppProfile_DISPLAY_STAT` enum('Active','Inactive') DEFAULT 'Active',
  PRIMARY KEY (`OrgAppProfile_ID`),
  UNIQUE KEY `UNQ_OrgAppProfile_ORG_CODE` (`OrgAppProfile_APPL_CODE`)
) ENGINE=InnoDB AUTO_INCREMENT=24 DEFAULT CHARSET=latin1;

-- --------------------------------------------------------

--
-- Table structure for table `r_org_category`
--

CREATE TABLE IF NOT EXISTS `r_org_category` (
  `OrgCat_ID` int(11) NOT NULL AUTO_INCREMENT,
  `OrgCat_CODE` varchar(15) NOT NULL,
  `OrgCat_NAME` varchar(100) NOT NULL,
  `OrgCat_DESC` varchar(100) DEFAULT 'Org Category Description',
  `OrgCat_DATE_ADD` datetime NOT NULL DEFAULT CURRENT_TIMESTAMP,
  `OrgCat_DATE_MOD` datetime NOT NULL DEFAULT CURRENT_TIMESTAMP,
  `OrgCat_DISPLAY_STAT` enum('Active','Inactive') DEFAULT 'Active',
  PRIMARY KEY (`OrgCat_ID`),
  UNIQUE KEY `UNQ_OrgCat_NAME` (`OrgCat_CODE`)
) ENGINE=InnoDB AUTO_INCREMENT=4 DEFAULT CHARSET=latin1;

-- --------------------------------------------------------

--
-- Table structure for table `r_org_essentials`
--

CREATE TABLE IF NOT EXISTS `r_org_essentials` (
  `OrgEssentials_ID` int(11) NOT NULL AUTO_INCREMENT,
  `OrgEssentials_ORG_CODE` varchar(15) NOT NULL,
  `OrgEssentials_MISSION` varchar(1000) NOT NULL,
  `OrgEssentials_VISION` varchar(1000) NOT NULL,
  `OrgEssentials_LOGO` blob NOT NULL,
  `OrgEssentials_DATE_ADD` datetime DEFAULT CURRENT_TIMESTAMP,
  `OrgEssentials_DATE_MOD` datetime DEFAULT CURRENT_TIMESTAMP,
  `OrgEssentials_DISPLAY_STAT` enum('Active','Inactive') DEFAULT 'Active',
  PRIMARY KEY (`OrgEssentials_ID`),
  KEY `FK_OrgEssentials_ORG_CODE` (`OrgEssentials_ORG_CODE`)
) ENGINE=InnoDB AUTO_INCREMENT=23 DEFAULT CHARSET=latin1;

-- --------------------------------------------------------

--
-- Table structure for table `r_org_officer_position_details`
--

CREATE TABLE IF NOT EXISTS `r_org_officer_position_details` (
  `OrgOffiPosDetails_ID` int(11) NOT NULL AUTO_INCREMENT,
  `OrgOffiPosDetails_ORG_CODE` varchar(15) NOT NULL,
  `OrgOffiPosDetails_NAME` varchar(100) NOT NULL,
  `OrgOffiPosDetails_DESC` varchar(100) NOT NULL DEFAULT 'Office Position Description',
  `OrgOffiPosDetails_DATE_MOD` datetime NOT NULL DEFAULT CURRENT_TIMESTAMP,
  `OrgOffiPosDetails_DATE_ADD` datetime NOT NULL DEFAULT CURRENT_TIMESTAMP,
  `OrgOffiPosDetails_DISPLAY_STAT` enum('Active','Inactive') DEFAULT 'Active',
  PRIMARY KEY (`OrgOffiPosDetails_ID`),
  KEY `FK_OrgOffiPosDetails_ORG_CODE` (`OrgOffiPosDetails_ORG_CODE`)
) ENGINE=InnoDB AUTO_INCREMENT=6 DEFAULT CHARSET=latin1;

-- --------------------------------------------------------

--
-- Table structure for table `r_osas_head`
--

CREATE TABLE IF NOT EXISTS `r_osas_head` (
  `OSASHead_ID` int(11) NOT NULL AUTO_INCREMENT,
  `OSASHead_CODE` varchar(15) NOT NULL,
  `OSASHead_NAME` varchar(100) NOT NULL,
  `OSASHead_DESC` varchar(100) NOT NULL DEFAULT 'Introduce your self',
  `OSASHead_DATE_PROMOTED` datetime NOT NULL DEFAULT CURRENT_TIMESTAMP,
  `OSASHead_DATE_ADD` datetime NOT NULL DEFAULT CURRENT_TIMESTAMP,
  `OSASHead_DATE_MOD` datetime NOT NULL DEFAULT CURRENT_TIMESTAMP,
  `OSASHead_DISPLAY_STAT` enum('Active','Inactive') DEFAULT 'Active',
  PRIMARY KEY (`OSASHead_ID`),
  UNIQUE KEY `UNQ_OSASHead_CODE` (`OSASHead_CODE`)
) ENGINE=InnoDB AUTO_INCREMENT=2 DEFAULT CHARSET=latin1;

-- --------------------------------------------------------

--
-- Table structure for table `r_sanction_details`
--

CREATE TABLE IF NOT EXISTS `r_sanction_details` (
  `SancDetails_ID` int(11) NOT NULL AUTO_INCREMENT,
  `SancDetails_CODE` varchar(100) NOT NULL,
  `SancDetails_NAME` varchar(100) NOT NULL,
  `SancDetails_DESC` varchar(1000) DEFAULT 'Sanction Description',
  `SancDetails_TIMEVAL` int(11) NOT NULL DEFAULT '0',
  `SancDetails_DATE_MOD` datetime NOT NULL DEFAULT CURRENT_TIMESTAMP,
  `SancDetails_DATE_ADD` datetime NOT NULL DEFAULT CURRENT_TIMESTAMP,
  `SancDetails_DISPLAY_STAT` enum('Active','Inactive') DEFAULT 'Active',
  PRIMARY KEY (`SancDetails_ID`),
  UNIQUE KEY `UNQ_SancDetails_CODE` (`SancDetails_CODE`)
) ENGINE=InnoDB AUTO_INCREMENT=12 DEFAULT CHARSET=latin1;

-- --------------------------------------------------------

--
-- Table structure for table `r_semester`
--

CREATE TABLE IF NOT EXISTS `r_semester` (
  `Semestral_ID` int(11) NOT NULL AUTO_INCREMENT,
  `Semestral_CODE` varchar(15) NOT NULL,
  `Semestral_NAME` varchar(50) NOT NULL,
  `Semestral_DESC` varchar(100) DEFAULT 'Semester Description',
  `Semestral_DATE_ADD` datetime NOT NULL DEFAULT CURRENT_TIMESTAMP,
  `Semestral_DATE_MOD` datetime NOT NULL DEFAULT CURRENT_TIMESTAMP,
  `Semestral_DISPLAY_STAT` enum('Active','Inactive') DEFAULT 'Active',
  PRIMARY KEY (`Semestral_ID`),
  UNIQUE KEY `UNQ_Semstral_NAME` (`Semestral_NAME`)
) ENGINE=InnoDB AUTO_INCREMENT=5 DEFAULT CHARSET=latin1;

-- --------------------------------------------------------

--
-- Table structure for table `r_stud_profile`
--

CREATE TABLE IF NOT EXISTS `r_stud_profile` (
  `Stud_ID` int(11) NOT NULL AUTO_INCREMENT,
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
  `Stud_DISPLAY_STATUS` enum('Active','Inactive') DEFAULT 'Active',
  PRIMARY KEY (`Stud_ID`),
  UNIQUE KEY `PK_Stud_NO` (`Stud_NO`),
  KEY `FK_COURSE` (`Stud_COURSE`)
) ENGINE=InnoDB AUTO_INCREMENT=49 DEFAULT CHARSET=latin1;

-- --------------------------------------------------------

--
-- Table structure for table `r_users`
--

CREATE TABLE IF NOT EXISTS `r_users` (
  `Users_ID` int(11) NOT NULL AUTO_INCREMENT,
  `Users_USERNAME` varchar(50) NOT NULL,
  `Users_REFERENCED` varchar(15) NOT NULL,
  `Users_PASSWORD` blob NOT NULL,
  `Users_ROLES` enum('Administrator','OSAS HEAD','Organization','Student') NOT NULL,
  `Users_PROFILE_PATH` varchar(500) DEFAULT NULL,
  `Users_DATE_ADD` datetime NOT NULL DEFAULT CURRENT_TIMESTAMP,
  `Users_DATE_MOD` datetime NOT NULL DEFAULT CURRENT_TIMESTAMP,
  `Users_DISPLAY_STAT` enum('Active','Inactive') DEFAULT 'Active',
  PRIMARY KEY (`Users_ID`),
  UNIQUE KEY `UNQ_Users_USERNAME` (`Users_USERNAME`)
) ENGINE=InnoDB AUTO_INCREMENT=38 DEFAULT CHARSET=latin1;

-- --------------------------------------------------------

--
-- Table structure for table `t_assign_org_academic_course`
--

CREATE TABLE IF NOT EXISTS `t_assign_org_academic_course` (
  `AssOrgAcademic_ID` int(11) NOT NULL AUTO_INCREMENT,
  `AssOrgAcademic_ORG_CODE` varchar(15) NOT NULL,
  `AssOrgAcademic_COURSE_CODE` varchar(15) NOT NULL,
  `AssOrgAcademic_DATE_ADD` datetime NOT NULL DEFAULT CURRENT_TIMESTAMP,
  `AssOrgAcademic_DATE_MOD` datetime NOT NULL DEFAULT CURRENT_TIMESTAMP,
  `AssOrgAcademic_DISPLAY_STAT` enum('Active','Inactive') DEFAULT 'Active',
  PRIMARY KEY (`AssOrgAcademic_ORG_CODE`,`AssOrgAcademic_COURSE_CODE`),
  UNIQUE KEY `UNQ_AssOrgAcademic_ID` (`AssOrgAcademic_ID`),
  KEY `FK_AssOrgAcademic_COURSE_CODE` (`AssOrgAcademic_COURSE_CODE`)
) ENGINE=InnoDB AUTO_INCREMENT=49 DEFAULT CHARSET=latin1;

-- --------------------------------------------------------

--
-- Table structure for table `t_assign_org_category`
--

CREATE TABLE IF NOT EXISTS `t_assign_org_category` (
  `AssOrgCategory_ID` int(11) NOT NULL AUTO_INCREMENT,
  `AssOrgCategory_ORG_CODE` varchar(15) NOT NULL,
  `AssOrgCategory_ORGCAT_CODE` varchar(15) NOT NULL,
  `AssOrgCategory_DATE_ADD` datetime NOT NULL DEFAULT CURRENT_TIMESTAMP,
  `AssOrgCategory_DATE_MOD` datetime NOT NULL DEFAULT CURRENT_TIMESTAMP,
  `AssOrgCategory_DISPLAY_STAT` enum('Active','Inactive') DEFAULT 'Active',
  PRIMARY KEY (`AssOrgCategory_ORG_CODE`,`AssOrgCategory_ORGCAT_CODE`),
  UNIQUE KEY `UNQ_AssOrgCategory_ID` (`AssOrgCategory_ID`),
  KEY `FK_AssOrgCategory_ORGCAT_CODE` (`AssOrgCategory_ORGCAT_CODE`)
) ENGINE=InnoDB AUTO_INCREMENT=36 DEFAULT CHARSET=latin1;

-- --------------------------------------------------------

--
-- Table structure for table `t_assign_org_members`
--

CREATE TABLE IF NOT EXISTS `t_assign_org_members` (
  `AssOrgMem_ID` int(11) NOT NULL AUTO_INCREMENT,
  `AssOrgMem_STUD_NO` varchar(15) NOT NULL,
  `AssOrgMem_APPL_ORG_CODE` varchar(15) NOT NULL,
  `AssOrgMem_DATE_ADD` datetime NOT NULL DEFAULT CURRENT_TIMESTAMP,
  `AssOrgMem_DATE_MOD` datetime NOT NULL DEFAULT CURRENT_TIMESTAMP,
  `AssOrgMem_DISPLAY_STAT` enum('Active','Inactive') NOT NULL DEFAULT 'Active',
  PRIMARY KEY (`AssOrgMem_STUD_NO`,`AssOrgMem_APPL_ORG_CODE`),
  UNIQUE KEY `UNQ_AssOrgMem_ID` (`AssOrgMem_ID`),
  KEY `FK_AssOrgMem_APPL_ORG_CODE` (`AssOrgMem_APPL_ORG_CODE`)
) ENGINE=InnoDB AUTO_INCREMENT=129 DEFAULT CHARSET=latin1;

-- --------------------------------------------------------

--
-- Table structure for table `t_assign_org_sanction`
--

CREATE TABLE IF NOT EXISTS `t_assign_org_sanction` (
  `AssSancOrgStudent_ID` int(11) NOT NULL AUTO_INCREMENT,
  `AssSancOrgStudent_REG_ORG` varchar(15) NOT NULL,
  `AssSancOrgStudent_SancDetails_CODE` varchar(15) NOT NULL,
  `AssSancOrgStudent_REMARKS` varchar(15) NOT NULL,
  `AssSancOrgStudent_DATE_ADD` datetime NOT NULL DEFAULT CURRENT_TIMESTAMP,
  `AssSancOrgStudent_DATE_MOD` datetime NOT NULL DEFAULT CURRENT_TIMESTAMP,
  `AssSancOrgStudent_DISPLAY_STAT` enum('Active','Inactive') DEFAULT 'Active',
  PRIMARY KEY (`AssSancOrgStudent_ID`),
  KEY `FK_AssSancOrgStudent_STUD_NO` (`AssSancOrgStudent_REG_ORG`),
  KEY `FK_AssSancOrgStudent_SancDetails_CODE` (`AssSancOrgStudent_SancDetails_CODE`)
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

-- --------------------------------------------------------

--
-- Table structure for table `t_assign_student_clearance`
--

CREATE TABLE IF NOT EXISTS `t_assign_student_clearance` (
  `AssStudClearance_ID` int(11) NOT NULL AUTO_INCREMENT,
  `AssStudClearance_STUD_NO` varchar(15) NOT NULL,
  `AssStudClearance_BATCH` varchar(15) NOT NULL,
  `AssStudClearance_SEMESTER` varchar(50) NOT NULL,
  `AssStudClearance_SIGNATORIES_CODE` varchar(15) NOT NULL,
  `AssStudClearance_DATE_ADD` datetime NOT NULL DEFAULT CURRENT_TIMESTAMP,
  `AssStudClearance_DATE_MOD` datetime NOT NULL DEFAULT CURRENT_TIMESTAMP,
  `AssStudClearance_DISPLAY_STAT` enum('Active','Inactive') DEFAULT 'Active',
  PRIMARY KEY (`AssStudClearance_STUD_NO`,`AssStudClearance_BATCH`,`AssStudClearance_SEMESTER`,`AssStudClearance_SIGNATORIES_CODE`),
  UNIQUE KEY `UNQ_AssStudClearance_ID` (`AssStudClearance_ID`),
  KEY `FK_AssStudClearance_SEMESTER` (`AssStudClearance_SEMESTER`),
  KEY `FK_AssStudClearance_SIGNATORIES_CODE` (`AssStudClearance_SIGNATORIES_CODE`)
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

-- --------------------------------------------------------

--
-- Table structure for table `t_assign_stud_finan_assistance`
--

CREATE TABLE IF NOT EXISTS `t_assign_stud_finan_assistance` (
  `AssStudFinanAssistance_ID` int(11) NOT NULL AUTO_INCREMENT,
  `AssStudFinanAssistance_STUD_NO` varchar(15) NOT NULL,
  `AssStudFinanAssistance_FINAN_NAME` varchar(100) NOT NULL,
  `AssStudFinanAssistance_STATUS` enum('Active','Inactive','Void','Cancelled') NOT NULL DEFAULT 'Active',
  `AssStudFinanAssistance_REMARKS` varchar(500) NOT NULL DEFAULT 'Remarks',
  `AssStudFinanAssistance_DATE_ADD` datetime NOT NULL DEFAULT CURRENT_TIMESTAMP,
  `AssStudFinanAssistance_DATE_MOD` datetime NOT NULL DEFAULT CURRENT_TIMESTAMP,
  `AssStudFinanAssistance_DISPLAY_STAT` enum('Active','Inactive') DEFAULT 'Active',
  PRIMARY KEY (`AssStudFinanAssistance_STUD_NO`,`AssStudFinanAssistance_FINAN_NAME`) USING BTREE,
  UNIQUE KEY `UNQ_AssStudFinanAssistance_ID` (`AssStudFinanAssistance_ID`),
  KEY `FK_AssStudFinanAssistance_FINAN_NAME` (`AssStudFinanAssistance_FINAN_NAME`)
) ENGINE=InnoDB AUTO_INCREMENT=32 DEFAULT CHARSET=latin1;

-- --------------------------------------------------------

--
-- Table structure for table `t_assign_stud_loss_id_regicard`
--

CREATE TABLE IF NOT EXISTS `t_assign_stud_loss_id_regicard` (
  `AssLoss_ID` int(11) NOT NULL AUTO_INCREMENT,
  `AssLoss_STUD_NO` varchar(15) NOT NULL,
  `AssLoss_TYPE` enum('Identification Card','Registration Card') NOT NULL,
  `AssLoss_REMARKS` varchar(500) NOT NULL DEFAULT 'Remarks Description',
  `AssLoss_DATE_CLAIM` datetime DEFAULT NULL,
  `AssLoss_DATE_ADD` datetime NOT NULL DEFAULT CURRENT_TIMESTAMP,
  `AssLoss_DATE_MOD` datetime NOT NULL DEFAULT CURRENT_TIMESTAMP,
  `AssLoss_DISPLAY_STAT` enum('Active','Inactive') DEFAULT 'Active',
  PRIMARY KEY (`AssLoss_ID`),
  KEY `FK_AssLoss_STUD_NO` (`AssLoss_STUD_NO`)
) ENGINE=InnoDB AUTO_INCREMENT=5 DEFAULT CHARSET=latin1;

-- --------------------------------------------------------

--
-- Table structure for table `t_assign_stud_saction`
--

CREATE TABLE IF NOT EXISTS `t_assign_stud_saction` (
  `AssSancStudStudent_ID` int(11) NOT NULL AUTO_INCREMENT,
  `AssSancStudStudent_STUD_NO` varchar(15) NOT NULL,
  `AssSancStudStudent_SancDetails_CODE` varchar(100) NOT NULL,
  `AssSancStudStudent_DesOffDetails_CODE` varchar(15) NOT NULL,
  `AssSancStudStudent_CONSUMED_HOURS` int(11) DEFAULT '0',
  `AssSancStudStudent_REMARKS` varchar(100) DEFAULT NULL,
  `AssSancStudStudent_IS_FINISH` enum('Processing','Finished') NOT NULL DEFAULT 'Processing',
  `AssSancStudStudent_DATE_ADD` datetime NOT NULL DEFAULT CURRENT_TIMESTAMP,
  `AssSancStudStudent_DATE_MOD` datetime NOT NULL DEFAULT CURRENT_TIMESTAMP,
  `AssSancStudStudent_DISPLAY_STAT` enum('Active','Inactive') DEFAULT 'Active',
  PRIMARY KEY (`AssSancStudStudent_ID`),
  KEY `FK_AssSancStudStudent_STUD_NO` (`AssSancStudStudent_STUD_NO`),
  KEY `FK_AssSancStudStudent_DesOffDetails_CODE` (`AssSancStudStudent_DesOffDetails_CODE`),
  KEY `FK_AssSancStudStudent_SancDetails_CODE` (`AssSancStudStudent_SancDetails_CODE`)
) ENGINE=InnoDB AUTO_INCREMENT=71 DEFAULT CHARSET=latin1;

-- --------------------------------------------------------

--
-- Table structure for table `t_org_accreditation_process`
--

CREATE TABLE IF NOT EXISTS `t_org_accreditation_process` (
  `OrgAccrProcess_ID` int(11) NOT NULL AUTO_INCREMENT,
  `OrgAccrProcess_ORG_CODE` varchar(15) NOT NULL,
  `OrgAccrProcess_OrgAccrDetail_CODE` varchar(15) NOT NULL,
  `OrgAccrProcess_IS_ACCREDITED` int(11) NOT NULL DEFAULT '0',
  `OrgAccrProcess_DATE_ADD` datetime NOT NULL DEFAULT CURRENT_TIMESTAMP,
  `OrgAccrProcess_DATE_MOD` datetime NOT NULL DEFAULT CURRENT_TIMESTAMP,
  `OrgAccrProcess_DISPLAY_STAT` enum('Active','Inactive') DEFAULT 'Active',
  PRIMARY KEY (`OrgAccrProcess_ORG_CODE`,`OrgAccrProcess_OrgAccrDetail_CODE`),
  UNIQUE KEY `UNQ_OrgAccrProcess_ID` (`OrgAccrProcess_ID`),
  KEY `FK_OrgAccrProcess_OrgAccrDetail_CODE` (`OrgAccrProcess_OrgAccrDetail_CODE`)
) ENGINE=InnoDB AUTO_INCREMENT=59 DEFAULT CHARSET=latin1;

-- --------------------------------------------------------

--
-- Table structure for table `t_org_cash_flow_statement`
--

CREATE TABLE IF NOT EXISTS `t_org_cash_flow_statement` (
  `OrgCashFlowStatement_ID` int(11) NOT NULL AUTO_INCREMENT,
  `OrgCashFlowStatement_ORG_CODE` varchar(15) NOT NULL,
  `OrgCashFlowStatement_ITEM` varchar(100) NOT NULL,
  `OrgCashFlowStatement_COLLECTION` double(10,3) DEFAULT NULL,
  `OrgCashFlowStatement_EXPENSES` double(10,3) DEFAULT NULL,
  `OrgCashFlowStatement_REMARKS` varchar(100) DEFAULT NULL,
  `OrgCashFlowStatement_DATE_ADD` datetime NOT NULL DEFAULT CURRENT_TIMESTAMP,
  `OrgCashFlowStatement_DATE_MOD` datetime NOT NULL DEFAULT CURRENT_TIMESTAMP,
  `OrgCashFlowStatement_DISPLAY_STAT` enum('Active','Inactive') DEFAULT 'Active',
  PRIMARY KEY (`OrgCashFlowStatement_ID`),
  KEY `FK_OrgCashFlowStatement_ORG_CODE` (`OrgCashFlowStatement_ORG_CODE`)
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

-- --------------------------------------------------------

--
-- Table structure for table `t_org_financial_statement`
--

CREATE TABLE IF NOT EXISTS `t_org_financial_statement` (
  `OrgFinStatement_ID` int(11) NOT NULL AUTO_INCREMENT,
  `OrgFinStatement_ORG_CODE` varchar(15) NOT NULL,
  `OrgFinStatement_SEMESTER` varchar(50) NOT NULL,
  `OrgFinStatement_DATE_ADD` datetime NOT NULL DEFAULT CURRENT_TIMESTAMP,
  `OrgFinStatement_DATE_MOD` datetime NOT NULL DEFAULT CURRENT_TIMESTAMP,
  `OrgFinStatement_DISPLAY_STAT` enum('Active','Inactive') DEFAULT 'Active',
  PRIMARY KEY (`OrgFinStatement_ID`),
  KEY `FK_OrgFinStatement_ORG_CODE` (`OrgFinStatement_ORG_CODE`),
  KEY `FK_OrgFinStatement_SEMESTER` (`OrgFinStatement_SEMESTER`)
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

-- --------------------------------------------------------

--
-- Table structure for table `t_org_financial_statement_items`
--

CREATE TABLE IF NOT EXISTS `t_org_financial_statement_items` (
  `OrgFinStatExpenses_ID` int(11) NOT NULL AUTO_INCREMENT,
  `OrgFinStatExpenses_OrgFinStatement_ID` int(11) NOT NULL,
  `OrgFinStatExpenses_ITEM` varchar(100) NOT NULL,
  `OrgFinStatExpenses_AMOUNT` double(10,3) NOT NULL DEFAULT '0.000',
  `OrgFinStatExpenses_DATE_ADD` datetime NOT NULL DEFAULT CURRENT_TIMESTAMP,
  `OrgFinStatExpenses_DATE_MOD` datetime NOT NULL DEFAULT CURRENT_TIMESTAMP,
  `OrgFinStatExpenses_DISPLAY_STAT` enum('Active','Inactive') DEFAULT 'Active',
  PRIMARY KEY (`OrgFinStatExpenses_ID`),
  KEY `FK_OrgFinStatExpenses_OrgFinStatement_ID` (`OrgFinStatExpenses_OrgFinStatement_ID`)
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

-- --------------------------------------------------------

--
-- Table structure for table `t_org_for_compliance`
--

CREATE TABLE IF NOT EXISTS `t_org_for_compliance` (
  `OrgForCompliance_ID` int(11) NOT NULL AUTO_INCREMENT,
  `OrgForCompliance_ORG_CODE` varchar(15) NOT NULL,
  `OrgForCompliance_OrgApplProfile_APPL_CODE` varchar(15) NOT NULL,
  `OrgForCompliance_ADVISER` varchar(100) DEFAULT 'Organization Adviser should be here!',
  `OrgForCompliance_BATCH_YEAR` varchar(15) NOT NULL,
  `OrgForCompliance_DATE_ADD` datetime NOT NULL DEFAULT CURRENT_TIMESTAMP,
  `OrgForCompliance_DATE_MOD` datetime NOT NULL DEFAULT CURRENT_TIMESTAMP,
  `OrgForCompliance_DISPAY_STAT` enum('Active','Inactive') DEFAULT 'Active',
  PRIMARY KEY (`OrgForCompliance_ID`),
  UNIQUE KEY `UNQ_OrgForCompliance_CODE` (`OrgForCompliance_ORG_CODE`),
  UNIQUE KEY `UNQ_OrgForCompliance_ORG_CODE` (`OrgForCompliance_ORG_CODE`),
  KEY `FK_OrgForCompliance_CODE` (`OrgForCompliance_OrgApplProfile_APPL_CODE`),
  KEY `FK_OR_ORG_FOUNDED_BATCH_YEAR` (`OrgForCompliance_BATCH_YEAR`)
) ENGINE=InnoDB AUTO_INCREMENT=34 DEFAULT CHARSET=latin1;

-- --------------------------------------------------------

--
-- Table structure for table `t_org_officers`
--

CREATE TABLE IF NOT EXISTS `t_org_officers` (
  `OrgOffi_ID` int(11) NOT NULL AUTO_INCREMENT,
  `OrgOffi_OrgOffiPosDetails_ID` int(11) NOT NULL,
  `OrgOffi_STUD_NO` varchar(15) NOT NULL,
  `OrgOffi_BATCH_YEAR` varchar(15) DEFAULT NULL,
  `OrgOffi_DATE_ADD` datetime NOT NULL DEFAULT CURRENT_TIMESTAMP,
  `OrgOffi_DATE_MODIFIED` datetime NOT NULL DEFAULT CURRENT_TIMESTAMP,
  `OrgOffi_DISPLAY_STAT` enum('Active','Inactive') DEFAULT 'Active',
  PRIMARY KEY (`OrgOffi_STUD_NO`,`OrgOffi_OrgOffiPosDetails_ID`),
  UNIQUE KEY `UNQ_OrgOffi_ID` (`OrgOffi_ID`),
  KEY `FK_OrgOffi_OrgOffiPosDetails_ID` (`OrgOffi_OrgOffiPosDetails_ID`),
  KEY `FK_OrgOffi_BATCH_YEAR` (`OrgOffi_BATCH_YEAR`)
) ENGINE=InnoDB AUTO_INCREMENT=8 DEFAULT CHARSET=latin1;

-- --------------------------------------------------------

--
-- Table structure for table `t_org_remittance`
--

CREATE TABLE IF NOT EXISTS `t_org_remittance` (
  `OrgRemittance_ID` int(11) NOT NULL AUTO_INCREMENT,
  `OrgRemittance_ORG_CODE` varchar(15) NOT NULL,
  `OrgRemittance_SEND_BY` varchar(100) NOT NULL,
  `OrgRemittance_REC_BY` varchar(100) NOT NULL,
  `OrgRemittance_AMOUNT` double(10,3) NOT NULL,
  `OrgRemittance_DESC` varchar(100) DEFAULT 'Remittance Description',
  `OrgRemittance_DATE_ADD` datetime NOT NULL DEFAULT CURRENT_TIMESTAMP,
  `OrgRemittance_DATE_MOD` datetime NOT NULL DEFAULT CURRENT_TIMESTAMP,
  `OrgRemittance_DISPLAY_STAT` enum('Active','Inactive') DEFAULT 'Active',
  PRIMARY KEY (`OrgRemittance_ID`),
  KEY `FK_OrgRemittance_ORG_CODE` (`OrgRemittance_ORG_CODE`)
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

-- --------------------------------------------------------

--
-- Table structure for table `t_org_voucher`
--

CREATE TABLE IF NOT EXISTS `t_org_voucher` (
  `OrgVoucher_ID` int(11) NOT NULL AUTO_INCREMENT,
  `OrgVoucher_CASH_VOUCHER_NO` int(11) NOT NULL,
  `OrgVoucher_ORG_CODE` varchar(15) NOT NULL,
  `OrgVoucher_DATE_ADD` datetime NOT NULL DEFAULT CURRENT_TIMESTAMP,
  `OrgVoucher_DATE_MOD` datetime NOT NULL DEFAULT CURRENT_TIMESTAMP,
  `OrgVoucher_DISPLAY_STAT` enum('Active','Inactive') DEFAULT 'Active',
  PRIMARY KEY (`OrgVoucher_ID`),
  UNIQUE KEY `UNQ_OrgVoucher_CASH_VOUCHER_NO` (`OrgVoucher_CASH_VOUCHER_NO`),
  KEY `FK_OrgVoucher_ORG_CODE` (`OrgVoucher_ORG_CODE`)
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

-- --------------------------------------------------------

--
-- Table structure for table `t_org_voucher_items`
--

CREATE TABLE IF NOT EXISTS `t_org_voucher_items` (
  `OrgVouchItems_ID` int(11) NOT NULL AUTO_INCREMENT,
  `OrgVouchItems_VOUCHER_NO` int(11) NOT NULL,
  `OrgVouchItems_ITEM_NAME` varchar(100) NOT NULL,
  `OrgVouchItems_AMOUNT` double(10,3) NOT NULL DEFAULT '0.000',
  `OrgVouchItems_DATE_ADD` datetime NOT NULL DEFAULT CURRENT_TIMESTAMP,
  `OrgVouchItems_DATE_MOD` datetime NOT NULL DEFAULT CURRENT_TIMESTAMP,
  `OrgVouchItems_DISPLAY_STAT` enum('Active','Inactive') DEFAULT 'Active',
  PRIMARY KEY (`OrgVouchItems_ITEM_NAME`,`OrgVouchItems_VOUCHER_NO`),
  UNIQUE KEY `UNQ_OrgVouchItems_ID` (`OrgVouchItems_ID`),
  KEY `FK_OrgVouchItems_VOUCHER_NO` (`OrgVouchItems_VOUCHER_NO`)
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

-- --------------------------------------------------------

--
-- Table structure for table `t_qrval_student_clearance`
--

CREATE TABLE IF NOT EXISTS `t_qrval_student_clearance` (
  `QRValStudClearance_ID` int(11) NOT NULL AUTO_INCREMENT,
  `QRValStudClearance_STUD_NO` varchar(15) NOT NULL,
  `QRValStudClearance_BATCH` varchar(15) NOT NULL,
  `QRValStudClearance_SEMESTER` varchar(50) NOT NULL,
  `QRValStudClearance_QR_VALUE` varchar(1000) NOT NULL,
  `QRValStudClearance_DATE_ADD` datetime NOT NULL DEFAULT CURRENT_TIMESTAMP,
  `QRValStudClearance_DATE_MOD` datetime NOT NULL DEFAULT CURRENT_TIMESTAMP,
  `QRValStudClearance_DISPLAY_STAT` enum('Active','Inactive') DEFAULT 'Active',
  PRIMARY KEY (`QRValStudClearance_STUD_NO`,`QRValStudClearance_BATCH`,`QRValStudClearance_SEMESTER`),
  UNIQUE KEY `UNQ_QRValStudClearance_ID` (`QRValStudClearance_ID`),
  KEY `FK_QRValStudClearance_BATCH` (`QRValStudClearance_BATCH`),
  KEY `FK_QRValStudClearance_SEMESTER` (`QRValStudClearance_SEMESTER`)
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

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
-- Constraints for table `t_assign_org_members`
--
ALTER TABLE `t_assign_org_members`
  ADD CONSTRAINT `FK_AssOrgMem_APPL_ORG_CODE` FOREIGN KEY (`AssOrgMem_APPL_ORG_CODE`) REFERENCES `r_org_applicant_profile` (`OrgAppProfile_APPL_CODE`) ON DELETE CASCADE ON UPDATE CASCADE,
  ADD CONSTRAINT `FK_AssOrgMem_STUD_NO` FOREIGN KEY (`AssOrgMem_STUD_NO`) REFERENCES `r_stud_profile` (`Stud_NO`) ON DELETE CASCADE ON UPDATE CASCADE;

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
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
