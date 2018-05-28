/*
 Navicat Premium Data Transfer

 Source Server         : con
 Source Server Type    : MySQL
 Source Server Version : 100108
 Source Host           : 127.0.0.1:3306
 Source Schema         : osas

 Target Server Type    : MySQL
 Target Server Version : 100108
 File Encoding         : 65001

 Date: 28/05/2018 10:57:56
*/

SET NAMES utf8mb4;
SET FOREIGN_KEY_CHECKS = 0;

-- ----------------------------
-- Table structure for active_academic_year
-- ----------------------------
DROP TABLE IF EXISTS `active_academic_year`;
CREATE TABLE `active_academic_year`  (
  `ActiveAcadYear_ID` int(11) NOT NULL AUTO_INCREMENT,
  `ActiveAcadYear_Batch_YEAR` varchar(50) CHARACTER SET latin1 COLLATE latin1_swedish_ci NOT NULL,
  `ActiveAcadYear_IS_ACTIVE` enum('1','0') CHARACTER SET latin1 COLLATE latin1_swedish_ci NOT NULL DEFAULT '1',
  `ActiveAcadYear_DATE_ADD` datetime(0) NOT NULL DEFAULT CURRENT_TIMESTAMP,
  `ActiveAcadYear_DATE_MOD` datetime(0) NULL DEFAULT NULL,
  PRIMARY KEY (`ActiveAcadYear_ID`) USING BTREE,
  INDEX `FK_ActiveAcadYear_Batch_YEAR`(`ActiveAcadYear_Batch_YEAR`) USING BTREE,
  CONSTRAINT `FK_ActiveAcadYear_Batch_YEAR` FOREIGN KEY (`ActiveAcadYear_Batch_YEAR`) REFERENCES `r_batch_details` (`Batch_YEAR`) ON DELETE NO ACTION ON UPDATE CASCADE
) ENGINE = InnoDB AUTO_INCREMENT = 6 CHARACTER SET = latin1 COLLATE = latin1_swedish_ci ROW_FORMAT = Compact;

-- ----------------------------
-- Records of active_academic_year
-- ----------------------------
INSERT INTO `active_academic_year` VALUES (5, '2019-2020', '1', '2018-05-21 00:38:41', NULL);

-- ----------------------------
-- Table structure for active_semester
-- ----------------------------
DROP TABLE IF EXISTS `active_semester`;
CREATE TABLE `active_semester`  (
  `ActiveSemester_ID` int(11) NOT NULL AUTO_INCREMENT,
  `ActiveSemester_SEMESTRAL_NAME` varchar(50) CHARACTER SET latin1 COLLATE latin1_swedish_ci NOT NULL,
  `ActiveSemester_IS_ACTIVE` enum('1','0') CHARACTER SET latin1 COLLATE latin1_swedish_ci NOT NULL DEFAULT '1',
  `ActiveSemester_DATE_ADD` datetime(0) NOT NULL DEFAULT CURRENT_TIMESTAMP,
  `ActiveSemester_DATE_MOD` datetime(0) NULL DEFAULT NULL,
  PRIMARY KEY (`ActiveSemester_ID`) USING BTREE,
  INDEX `FK_ActiveSemester_SEMESTRAL_NAME`(`ActiveSemester_SEMESTRAL_NAME`) USING BTREE,
  CONSTRAINT `FK_ActiveSemester_SEMESTRAL_NAME` FOREIGN KEY (`ActiveSemester_SEMESTRAL_NAME`) REFERENCES `r_semester` (`Semestral_NAME`) ON DELETE NO ACTION ON UPDATE CASCADE
) ENGINE = InnoDB AUTO_INCREMENT = 5 CHARACTER SET = latin1 COLLATE = latin1_swedish_ci ROW_FORMAT = Compact;

-- ----------------------------
-- Records of active_semester
-- ----------------------------
INSERT INTO `active_semester` VALUES (4, 'Summer Semester', '1', '2018-05-21 00:38:44', NULL);

-- ----------------------------
-- Table structure for log_sanction
-- ----------------------------
DROP TABLE IF EXISTS `log_sanction`;
CREATE TABLE `log_sanction`  (
  `LogSanc_ID` int(11) NOT NULL AUTO_INCREMENT,
  `LogSanc_AssSancSudent_ID` int(11) NOT NULL,
  `LogSanc_CONSUMED_HOURS` int(11) NULL DEFAULT 0,
  `LogSanc_REMARKS` varchar(100) CHARACTER SET latin1 COLLATE latin1_swedish_ci NOT NULL,
  `LogSanc_TO_BE_DONE` date NOT NULL,
  `LogSanc_SEMESTER` varchar(50) CHARACTER SET latin1 COLLATE latin1_swedish_ci NOT NULL,
  `LogSanc_ACAD_YEAR` varchar(15) CHARACTER SET latin1 COLLATE latin1_swedish_ci NOT NULL,
  `LogSanc_IS_FINISH` enum('Processing','Finished') CHARACTER SET latin1 COLLATE latin1_swedish_ci NOT NULL,
  `LogSanc_DATE_MOD` datetime(0) NOT NULL DEFAULT CURRENT_TIMESTAMP,
  PRIMARY KEY (`LogSanc_ID`) USING BTREE,
  INDEX `FK_LogSanc_AssSancSudent_ID`(`LogSanc_AssSancSudent_ID`) USING BTREE,
  CONSTRAINT `FK_LogSanc_AssSancSudent_ID` FOREIGN KEY (`LogSanc_AssSancSudent_ID`) REFERENCES `t_assign_stud_saction` (`AssSancStudStudent_ID`) ON DELETE NO ACTION ON UPDATE CASCADE
) ENGINE = InnoDB AUTO_INCREMENT = 6 CHARACTER SET = latin1 COLLATE = latin1_swedish_ci ROW_FORMAT = Compact;

-- ----------------------------
-- Records of log_sanction
-- ----------------------------
INSERT INTO `log_sanction` VALUES (1, 1, 0, '', '2018-05-24', 'Summer Semester', '2019-2020', 'Processing', '2018-05-21 15:01:19');
INSERT INTO `log_sanction` VALUES (2, 1, 12, '', '2018-05-24', 'Summer Semester', '2019-2020', 'Processing', '2018-05-21 15:01:31');
INSERT INTO `log_sanction` VALUES (3, 1, 16, '', '2018-05-24', 'Summer Semester', '2019-2020', 'Finished', '2018-05-22 13:59:23');
INSERT INTO `log_sanction` VALUES (4, 2, 0, '', '2018-05-29', 'Summer Semester', '2019-2020', 'Processing', '2018-05-26 10:16:11');
INSERT INTO `log_sanction` VALUES (5, 2, 16, '', '2018-05-29', 'Summer Semester', '2019-2020', 'Finished', '2018-05-26 10:21:10');

-- ----------------------------
-- Table structure for notif_announcement
-- ----------------------------
DROP TABLE IF EXISTS `notif_announcement`;
CREATE TABLE `notif_announcement`  (
  `Notif_ID` int(11) NOT NULL AUTO_INCREMENT,
  `Notif_SUBJECT` varchar(1000) CHARACTER SET latin1 COLLATE latin1_swedish_ci NOT NULL,
  `Notif_MESSAGE` text CHARACTER SET latin1 COLLATE latin1_swedish_ci NOT NULL,
  `Notif_SEMESTER` varchar(50) CHARACTER SET latin1 COLLATE latin1_swedish_ci NOT NULL,
  `Notif_ACAD_YEAR` varchar(15) CHARACTER SET latin1 COLLATE latin1_swedish_ci NOT NULL,
  `Notif_SEND_BY` varchar(100) CHARACTER SET latin1 COLLATE latin1_swedish_ci NOT NULL,
  `Notif_REC_BY` enum('All','Student','Organization') CHARACTER SET latin1 COLLATE latin1_swedish_ci NULL DEFAULT NULL,
  `Notif_DATE_ADD` datetime(0) NOT NULL DEFAULT CURRENT_TIMESTAMP,
  PRIMARY KEY (`Notif_ID`) USING BTREE
) ENGINE = InnoDB AUTO_INCREMENT = 1 CHARACTER SET = latin1 COLLATE = latin1_swedish_ci ROW_FORMAT = Compact;

-- ----------------------------
-- Table structure for r_application_wizard
-- ----------------------------
DROP TABLE IF EXISTS `r_application_wizard`;
CREATE TABLE `r_application_wizard`  (
  `WIZARD_ID` int(11) NOT NULL AUTO_INCREMENT,
  `WIZARD_ORG_CODE` varchar(15) CHARACTER SET latin1 COLLATE latin1_swedish_ci NOT NULL,
  `WIZARD_CURRENT_STEP` int(11) NOT NULL,
  PRIMARY KEY (`WIZARD_ID`) USING BTREE,
  UNIQUE INDEX `WIZARD_ORG_CODE_2`(`WIZARD_ORG_CODE`) USING BTREE,
  INDEX `WIZARD_ORG_CODE`(`WIZARD_ORG_CODE`) USING BTREE,
  CONSTRAINT `r_application_wizard_ibfk_1` FOREIGN KEY (`WIZARD_ORG_CODE`) REFERENCES `t_org_for_compliance` (`OrgForCompliance_ORG_CODE`) ON DELETE RESTRICT ON UPDATE RESTRICT
) ENGINE = InnoDB AUTO_INCREMENT = 2 CHARACTER SET = latin1 COLLATE = latin1_swedish_ci ROW_FORMAT = Compact;

-- ----------------------------
-- Records of r_application_wizard
-- ----------------------------
INSERT INTO `r_application_wizard` VALUES (1, 'CITS2019', 5);

-- ----------------------------
-- Table structure for r_archiving_documents
-- ----------------------------
DROP TABLE IF EXISTS `r_archiving_documents`;
CREATE TABLE `r_archiving_documents`  (
  `ArchDocuments_ID` int(11) NOT NULL AUTO_INCREMENT,
  `ArchDocuments_ORDER_NO` varchar(50) CHARACTER SET latin1 COLLATE latin1_swedish_ci NOT NULL,
  `ArchDocuments_NAME` varchar(100) CHARACTER SET latin1 COLLATE latin1_swedish_ci NOT NULL,
  `ArchDocuments_DESC` varchar(100) CHARACTER SET latin1 COLLATE latin1_swedish_ci NOT NULL DEFAULT 'Document Description',
  `ArchDocuments_FILE_PATH` varchar(1000) CHARACTER SET latin1 COLLATE latin1_swedish_ci NOT NULL,
  `ArchDocuments_STATUS` enum('Available','Dispose') CHARACTER SET latin1 COLLATE latin1_swedish_ci NOT NULL DEFAULT 'Available',
  `ArchDocuments_DATE_ADD` datetime(0) NOT NULL DEFAULT CURRENT_TIMESTAMP,
  `ArchDocuments_DATE_MOD` datetime(0) NOT NULL DEFAULT CURRENT_TIMESTAMP,
  `ArchDocuments_DISPLAY_STAT` enum('Active','Inactive') CHARACTER SET latin1 COLLATE latin1_swedish_ci NULL DEFAULT 'Active',
  PRIMARY KEY (`ArchDocuments_ID`) USING BTREE,
  UNIQUE INDEX `UNQ_ArchDocuments_ORDER_NO`(`ArchDocuments_ORDER_NO`) USING BTREE
) ENGINE = InnoDB AUTO_INCREMENT = 1 CHARACTER SET = latin1 COLLATE = latin1_swedish_ci ROW_FORMAT = Compact;

-- ----------------------------
-- Table structure for r_assign_case_to_case_sanction
-- ----------------------------
DROP TABLE IF EXISTS `r_assign_case_to_case_sanction`;
CREATE TABLE `r_assign_case_to_case_sanction`  (
  `Case_ID` int(11) NOT NULL AUTO_INCREMENT,
  `Case_SancDetails_CODE` varchar(15) CHARACTER SET latin1 COLLATE latin1_swedish_ci NOT NULL,
  `Case_SancLevelOffense` int(11) NOT NULL DEFAULT 0,
  `Case_SanctionCategory` enum('Loss ID','Loss Registration Card','Late Claim') CHARACTER SET latin1 COLLATE latin1_swedish_ci NULL DEFAULT NULL,
  `Case_DATE_ADD` datetime(0) NOT NULL DEFAULT CURRENT_TIMESTAMP,
  `Case_DATE_MOD` datetime(0) NOT NULL DEFAULT CURRENT_TIMESTAMP,
  `Case_DISPLAY_STAT` enum('Active','InActive') CHARACTER SET latin1 COLLATE latin1_swedish_ci NOT NULL DEFAULT 'Active',
  PRIMARY KEY (`Case_ID`) USING BTREE,
  INDEX `FK_Case_SancDetails_CODE`(`Case_SancDetails_CODE`) USING BTREE,
  CONSTRAINT `FK_Case_SancDetails_CODE` FOREIGN KEY (`Case_SancDetails_CODE`) REFERENCES `r_sanction_details` (`SancDetails_CODE`) ON DELETE CASCADE ON UPDATE CASCADE
) ENGINE = InnoDB AUTO_INCREMENT = 1 CHARACTER SET = latin1 COLLATE = latin1_swedish_ci ROW_FORMAT = Compact;

-- ----------------------------
-- Table structure for r_batch_details
-- ----------------------------
DROP TABLE IF EXISTS `r_batch_details`;
CREATE TABLE `r_batch_details`  (
  `Batch_ID` int(11) NOT NULL AUTO_INCREMENT,
  `Batch_YEAR` varchar(15) CHARACTER SET latin1 COLLATE latin1_swedish_ci NOT NULL,
  `Batch_DESC` varchar(100) CHARACTER SET latin1 COLLATE latin1_swedish_ci NULL DEFAULT NULL,
  `Batch_DISPLAY_STAT` enum('Active','Inactive') CHARACTER SET latin1 COLLATE latin1_swedish_ci NULL DEFAULT 'Active',
  PRIMARY KEY (`Batch_ID`) USING BTREE,
  UNIQUE INDEX `UNQ_Batch_YEAR`(`Batch_YEAR`) USING BTREE
) ENGINE = InnoDB AUTO_INCREMENT = 18 CHARACTER SET = latin1 COLLATE = latin1_swedish_ci ROW_FORMAT = Compact;

-- ----------------------------
-- Records of r_batch_details
-- ----------------------------
INSERT INTO `r_batch_details` VALUES (9, '2011-2012', '2011-2012', 'Active');
INSERT INTO `r_batch_details` VALUES (10, '2012-2013', '2012-2013', 'Active');
INSERT INTO `r_batch_details` VALUES (11, '2013-2014', '2013-2014', 'Active');
INSERT INTO `r_batch_details` VALUES (12, '2014-2015', '2014-2015', 'Active');
INSERT INTO `r_batch_details` VALUES (13, '2015-2016', '2015-2016', 'Active');
INSERT INTO `r_batch_details` VALUES (14, '2016-2017', '2016-2017', 'Active');
INSERT INTO `r_batch_details` VALUES (15, '2017-2018', '2017-2018', 'Active');
INSERT INTO `r_batch_details` VALUES (16, '2018-2019', '2018-2019', 'Active');
INSERT INTO `r_batch_details` VALUES (17, '2019-2020', '2019-2020', 'Active');

-- ----------------------------
-- Table structure for r_civil_stat
-- ----------------------------
DROP TABLE IF EXISTS `r_civil_stat`;
CREATE TABLE `r_civil_stat`  (
  `Stud_CIVIL_STATUS_ID` int(11) NOT NULL AUTO_INCREMENT,
  `Stud_CIVIL_STATUS` varchar(15) CHARACTER SET latin1 COLLATE latin1_swedish_ci NOT NULL,
  `Stud_CIVIL_STATUS_STAT` enum('Active','Inactive') CHARACTER SET latin1 COLLATE latin1_swedish_ci NULL DEFAULT 'Active',
  PRIMARY KEY (`Stud_CIVIL_STATUS_ID`) USING BTREE,
  UNIQUE INDEX `Stud_CIVIL_STATUS`(`Stud_CIVIL_STATUS`) USING BTREE
) ENGINE = InnoDB AUTO_INCREMENT = 3 CHARACTER SET = latin1 COLLATE = latin1_swedish_ci ROW_FORMAT = Compact;

-- ----------------------------
-- Records of r_civil_stat
-- ----------------------------
INSERT INTO `r_civil_stat` VALUES (1, 'Single', 'Active');
INSERT INTO `r_civil_stat` VALUES (2, 'Married', 'Active');

-- ----------------------------
-- Table structure for r_clearance_signatories
-- ----------------------------
DROP TABLE IF EXISTS `r_clearance_signatories`;
CREATE TABLE `r_clearance_signatories`  (
  `ClearSignatories_ID` int(11) NOT NULL AUTO_INCREMENT,
  `ClearSignatories_CODE` varchar(15) CHARACTER SET latin1 COLLATE latin1_swedish_ci NOT NULL,
  `ClearSignatories_NAME` varchar(100) CHARACTER SET latin1 COLLATE latin1_swedish_ci NOT NULL,
  `ClearSignatories_DESC` varchar(100) CHARACTER SET latin1 COLLATE latin1_swedish_ci NULL DEFAULT 'Clearance Signatories Description',
  `ClearSignatories_DATE_MOD` datetime(0) NOT NULL DEFAULT CURRENT_TIMESTAMP,
  `ClearSignatories_DATE_ADD` datetime(0) NOT NULL DEFAULT CURRENT_TIMESTAMP,
  `ClearSignatories_DISPLAY_STAT` enum('Active','Inactive') CHARACTER SET latin1 COLLATE latin1_swedish_ci NULL DEFAULT 'Active',
  PRIMARY KEY (`ClearSignatories_ID`) USING BTREE,
  UNIQUE INDEX `UNQ_SancDetails_CODE`(`ClearSignatories_CODE`) USING BTREE
) ENGINE = InnoDB AUTO_INCREMENT = 16 CHARACTER SET = latin1 COLLATE = latin1_swedish_ci ROW_FORMAT = Compact;

-- ----------------------------
-- Records of r_clearance_signatories
-- ----------------------------
INSERT INTO `r_clearance_signatories` VALUES (11, 'SIG00001', 'Accounting Office', 'Accounting Office', '2018-05-21 00:32:21', '2018-05-21 00:32:21', 'Active');
INSERT INTO `r_clearance_signatories` VALUES (12, 'SIG00002', 'Library', 'Library', '2018-05-21 00:34:38', '2018-05-21 00:34:38', 'Active');
INSERT INTO `r_clearance_signatories` VALUES (13, 'SIG00003', 'Academic/ Director\'s Office', 'Academic/ Director\'s Office', '2018-05-21 00:34:56', '2018-05-21 00:34:56', 'Active');
INSERT INTO `r_clearance_signatories` VALUES (14, 'SIG00004', 'Guidance and Counseling Office', 'Guidance and Counseling Office', '2018-05-21 00:35:18', '2018-05-21 00:35:18', 'Active');
INSERT INTO `r_clearance_signatories` VALUES (15, 'SIG00005', 'Student Affairs and Services', 'Student Affairs and Services', '2018-05-21 00:35:40', '2018-05-21 00:35:40', 'Active');

-- ----------------------------
-- Table structure for r_couns_appointment_type
-- ----------------------------
DROP TABLE IF EXISTS `r_couns_appointment_type`;
CREATE TABLE `r_couns_appointment_type`  (
  `Appmnt_ID` int(11) NOT NULL AUTO_INCREMENT,
  `Appmnt_TYPE` varchar(25) CHARACTER SET latin1 COLLATE latin1_swedish_ci NOT NULL,
  `Appmnt_STAT` enum('Active','Inactive') CHARACTER SET latin1 COLLATE latin1_swedish_ci NULL DEFAULT 'Active',
  PRIMARY KEY (`Appmnt_ID`) USING BTREE,
  UNIQUE INDEX `Appmnt_TYPE`(`Appmnt_TYPE`) USING BTREE
) ENGINE = InnoDB AUTO_INCREMENT = 3 CHARACTER SET = latin1 COLLATE = latin1_swedish_ci ROW_FORMAT = Compact;

-- ----------------------------
-- Records of r_couns_appointment_type
-- ----------------------------
INSERT INTO `r_couns_appointment_type` VALUES (1, 'Walk-in', 'Inactive');
INSERT INTO `r_couns_appointment_type` VALUES (2, 'Referral', 'Active');

-- ----------------------------
-- Table structure for r_couns_approach
-- ----------------------------
DROP TABLE IF EXISTS `r_couns_approach`;
CREATE TABLE `r_couns_approach`  (
  `Couns_APPROACH_ID` int(11) NOT NULL AUTO_INCREMENT,
  `Couns_APPROACH` varchar(50) CHARACTER SET latin1 COLLATE latin1_swedish_ci NOT NULL,
  `COUNS_APPROACH_DESC` text CHARACTER SET latin1 COLLATE latin1_swedish_ci NULL,
  PRIMARY KEY (`Couns_APPROACH_ID`) USING BTREE,
  UNIQUE INDEX `Couns_APPROACH`(`Couns_APPROACH`) USING BTREE
) ENGINE = InnoDB AUTO_INCREMENT = 1 CHARACTER SET = latin1 COLLATE = latin1_swedish_ci ROW_FORMAT = Compact;

-- ----------------------------
-- Table structure for r_couns_type
-- ----------------------------
DROP TABLE IF EXISTS `r_couns_type`;
CREATE TABLE `r_couns_type`  (
  `Couns_TYPE_ID` int(11) NOT NULL AUTO_INCREMENT,
  `Couns_TYPE` varchar(50) CHARACTER SET latin1 COLLATE latin1_swedish_ci NOT NULL,
  `Couns_TYPE_STAT` enum('Active','Inactive') CHARACTER SET latin1 COLLATE latin1_swedish_ci NULL DEFAULT 'Active',
  PRIMARY KEY (`Couns_TYPE_ID`) USING BTREE,
  UNIQUE INDEX `Couns_TYPE`(`Couns_TYPE`) USING BTREE
) ENGINE = InnoDB AUTO_INCREMENT = 3 CHARACTER SET = latin1 COLLATE = latin1_swedish_ci ROW_FORMAT = Compact;

-- ----------------------------
-- Records of r_couns_type
-- ----------------------------
INSERT INTO `r_couns_type` VALUES (1, 'Individual Counseling', 'Active');
INSERT INTO `r_couns_type` VALUES (2, 'Group Counseling', 'Active');

-- ----------------------------
-- Table structure for r_courses
-- ----------------------------
DROP TABLE IF EXISTS `r_courses`;
CREATE TABLE `r_courses`  (
  `Course_ID` int(11) NOT NULL AUTO_INCREMENT,
  `Course_CODE` varchar(15) CHARACTER SET latin1 COLLATE latin1_swedish_ci NOT NULL,
  `Course_NAME` varchar(100) CHARACTER SET latin1 COLLATE latin1_swedish_ci NOT NULL,
  `Course_DESC` varchar(100) CHARACTER SET latin1 COLLATE latin1_swedish_ci NOT NULL DEFAULT 'Course Description',
  `Course_CURR_YEAR` varchar(15) CHARACTER SET latin1 COLLATE latin1_swedish_ci NULL DEFAULT NULL,
  `Course_DATE_MOD` datetime(0) NOT NULL DEFAULT CURRENT_TIMESTAMP,
  `Course_DATE_ADD` datetime(0) NOT NULL DEFAULT CURRENT_TIMESTAMP,
  `Course_DISPLAY_STAT` enum('Active','Inactive') CHARACTER SET latin1 COLLATE latin1_swedish_ci NULL DEFAULT 'Active',
  PRIMARY KEY (`Course_ID`) USING BTREE,
  UNIQUE INDEX `UNQ_Course_CODE`(`Course_CODE`) USING BTREE,
  INDEX `FK_Course_CURR_YEAR`(`Course_CURR_YEAR`) USING BTREE,
  CONSTRAINT `FK_Course_CURR_YEAR` FOREIGN KEY (`Course_CURR_YEAR`) REFERENCES `r_batch_details` (`Batch_YEAR`) ON DELETE CASCADE ON UPDATE CASCADE
) ENGINE = InnoDB AUTO_INCREMENT = 5 CHARACTER SET = latin1 COLLATE = latin1_swedish_ci ROW_FORMAT = Compact;

-- ----------------------------
-- Records of r_courses
-- ----------------------------
INSERT INTO `r_courses` VALUES (1, 'BSIT', 'Bachelor of Science in Information Technology', 'Course Descriptions', '2011-2012', '2018-04-25 23:23:43', '2018-02-07 18:41:43', 'Active');
INSERT INTO `r_courses` VALUES (2, 'DOMT', 'Diploma In Office Management Technology', 'Course Description', '2011-2012', '2018-02-09 17:54:51', '2018-02-09 17:54:51', 'Active');
INSERT INTO `r_courses` VALUES (3, 'DICT', 'Diploma in Information Communication Technology', 'Diploma in Information Communication Technology', '2011-2012', '2018-03-11 20:40:22', '2018-03-11 20:40:22', 'Active');
INSERT INTO `r_courses` VALUES (4, '5151', '312312', '3123123', '2017-2018', '2018-04-25 23:24:00', '2018-04-25 23:23:51', 'Active');

-- ----------------------------
-- Table structure for r_designated_offices_details
-- ----------------------------
DROP TABLE IF EXISTS `r_designated_offices_details`;
CREATE TABLE `r_designated_offices_details`  (
  `DesOffDetails_ID` int(11) NOT NULL AUTO_INCREMENT,
  `DesOffDetails_CODE` varchar(15) CHARACTER SET latin1 COLLATE latin1_swedish_ci NOT NULL,
  `DesOffDetails_NAME` varchar(100) CHARACTER SET latin1 COLLATE latin1_swedish_ci NOT NULL,
  `DesOffDetails_DESC` varchar(100) CHARACTER SET latin1 COLLATE latin1_swedish_ci NULL DEFAULT 'Offices Description',
  `DesOffDetails_DATE_ADD` datetime(0) NOT NULL DEFAULT CURRENT_TIMESTAMP,
  `DesOffDetails_DATE_MOD` datetime(0) NOT NULL DEFAULT CURRENT_TIMESTAMP,
  `DesOffDetails_DISPLAY_STAT` enum('Active','Inactive') CHARACTER SET latin1 COLLATE latin1_swedish_ci NULL DEFAULT 'Active',
  PRIMARY KEY (`DesOffDetails_ID`) USING BTREE,
  UNIQUE INDEX `UNQ_DesOffDetails_CODE`(`DesOffDetails_CODE`) USING BTREE
) ENGINE = InnoDB AUTO_INCREMENT = 14 CHARACTER SET = latin1 COLLATE = latin1_swedish_ci ROW_FORMAT = Compact;

-- ----------------------------
-- Records of r_designated_offices_details
-- ----------------------------
INSERT INTO `r_designated_offices_details` VALUES (10, 'OFF00001', 'Library', 'Library', '2018-05-21 00:01:33', '2018-05-21 00:01:33', 'Active');
INSERT INTO `r_designated_offices_details` VALUES (11, 'OFF00002', 'Student Affairs and Services', 'Student Affairs and Services', '2018-05-21 00:35:51', '2018-05-21 00:35:51', 'Active');
INSERT INTO `r_designated_offices_details` VALUES (12, 'OFF00003', 'Office of the Property Custodian ', 'Office of the Property Custodian ', '2018-05-21 00:36:15', '2018-05-21 00:36:15', 'Active');
INSERT INTO `r_designated_offices_details` VALUES (13, 'QEWQ', 'QWEQWE', 'QWEQWE', '2018-05-26 10:27:10', '2018-05-26 10:27:10', 'Active');

-- ----------------------------
-- Table structure for r_financial_assistance_title
-- ----------------------------
DROP TABLE IF EXISTS `r_financial_assistance_title`;
CREATE TABLE `r_financial_assistance_title`  (
  `FinAssiTitle_ID` int(11) NOT NULL AUTO_INCREMENT,
  `FinAssiTitle_CODE` varchar(15) CHARACTER SET latin1 COLLATE latin1_swedish_ci NOT NULL,
  `FinAssiTitle_NAME` varchar(100) CHARACTER SET latin1 COLLATE latin1_swedish_ci NOT NULL,
  `FinAssiTitle_DESC` varchar(100) CHARACTER SET latin1 COLLATE latin1_swedish_ci NULL DEFAULT 'Financial Assistantce Description',
  `FinAssiTitle_DATE_ADD` datetime(0) NOT NULL DEFAULT CURRENT_TIMESTAMP,
  `FinAssiTitle_DATE_MOD` datetime(0) NOT NULL DEFAULT CURRENT_TIMESTAMP,
  `FinAssiTitle_DISPLAY_STAT` enum('Active','Inactive') CHARACTER SET latin1 COLLATE latin1_swedish_ci NULL DEFAULT 'Active',
  PRIMARY KEY (`FinAssiTitle_ID`) USING BTREE,
  UNIQUE INDEX `UNQ_FinAssiTitle_NAME`(`FinAssiTitle_NAME`) USING BTREE
) ENGINE = InnoDB AUTO_INCREMENT = 19 CHARACTER SET = latin1 COLLATE = latin1_swedish_ci ROW_FORMAT = Compact;

-- ----------------------------
-- Records of r_financial_assistance_title
-- ----------------------------
INSERT INTO `r_financial_assistance_title` VALUES (13, 'Finan00001', 'CHED', 'Commission on Higher Education', '2018-05-21 00:12:05', '2018-05-21 00:12:05', 'Active');
INSERT INTO `r_financial_assistance_title` VALUES (14, 'Finan00002', 'SYDP', 'Scholarship & Youth Development Program', '2018-05-21 00:12:25', '2018-05-21 00:12:25', 'Active');
INSERT INTO `r_financial_assistance_title` VALUES (15, 'Finan00003', 'MegaWorld Foundation', 'MegaWorld Foundation', '2018-05-21 00:12:39', '2018-05-21 00:12:58', 'Active');
INSERT INTO `r_financial_assistance_title` VALUES (16, 'Finan00004', 'SM Foundation', 'SM Foundation', '2018-05-21 00:12:50', '2018-05-21 00:12:50', 'Active');
INSERT INTO `r_financial_assistance_title` VALUES (17, 'Finan00005', 'Dean\'s Lister', 'Dean\'s Lister', '2018-05-21 00:13:39', '2018-05-21 00:13:39', 'Active');
INSERT INTO `r_financial_assistance_title` VALUES (18, 'Finan00006', 'President\'s Lister', 'President\'s Lister', '2018-05-21 00:13:52', '2018-05-21 00:13:52', 'Active');

-- ----------------------------
-- Table structure for r_guidance_counselor
-- ----------------------------
DROP TABLE IF EXISTS `r_guidance_counselor`;
CREATE TABLE `r_guidance_counselor`  (
  `Counselor_ID` int(11) NOT NULL AUTO_INCREMENT,
  `Counselor_CODE` varchar(15) CHARACTER SET latin1 COLLATE latin1_swedish_ci NOT NULL,
  `Counselor_FNAME` varchar(100) CHARACTER SET latin1 COLLATE latin1_swedish_ci NOT NULL,
  `Counselor_MNAME` varchar(100) CHARACTER SET latin1 COLLATE latin1_swedish_ci NOT NULL,
  `Counselor_LNAME` varchar(100) CHARACTER SET latin1 COLLATE latin1_swedish_ci NOT NULL,
  PRIMARY KEY (`Counselor_ID`) USING BTREE
) ENGINE = InnoDB AUTO_INCREMENT = 2 CHARACTER SET = latin1 COLLATE = latin1_swedish_ci ROW_FORMAT = Compact;

-- ----------------------------
-- Records of r_guidance_counselor
-- ----------------------------
INSERT INTO `r_guidance_counselor` VALUES (1, 'GC-0001', 'Oliver', 'Juan', 'Gabriel');

-- ----------------------------
-- Table structure for r_nature_of_case
-- ----------------------------
DROP TABLE IF EXISTS `r_nature_of_case`;
CREATE TABLE `r_nature_of_case`  (
  `Case_NAME` varchar(50) CHARACTER SET latin1 COLLATE latin1_swedish_ci NOT NULL,
  `Case_STAT` enum('Active','Inactive') CHARACTER SET latin1 COLLATE latin1_swedish_ci NULL DEFAULT 'Active',
  UNIQUE INDEX `Case_NAME`(`Case_NAME`) USING BTREE
) ENGINE = InnoDB CHARACTER SET = latin1 COLLATE = latin1_swedish_ci ROW_FORMAT = Compact;

-- ----------------------------
-- Table structure for r_notification
-- ----------------------------
DROP TABLE IF EXISTS `r_notification`;
CREATE TABLE `r_notification`  (
  `Notification_ID` int(11) NOT NULL AUTO_INCREMENT,
  `Notification_ITEM` varchar(15) CHARACTER SET latin1 COLLATE latin1_swedish_ci NOT NULL,
  `Notification_SENDER` varchar(15) CHARACTER SET latin1 COLLATE latin1_swedish_ci NOT NULL,
  `Notification_RECEIVER` varchar(15) CHARACTER SET latin1 COLLATE latin1_swedish_ci NOT NULL,
  `Notification_SEEN` varchar(15) CHARACTER SET latin1 COLLATE latin1_swedish_ci NOT NULL DEFAULT 'Unseen',
  `Notification_CLICKED` varchar(15) CHARACTER SET latin1 COLLATE latin1_swedish_ci NOT NULL DEFAULT 'Unclick',
  `Notification_USERROLE` varchar(15) CHARACTER SET latin1 COLLATE latin1_swedish_ci NOT NULL DEFAULT 'OSAS Head',
  `Notification_DATE_SEEN` datetime(0) NULL DEFAULT NULL,
  `Notification_DATE_CLICKED` datetime(0) NULL DEFAULT NULL,
  `Notification_DATE_ADDED` datetime(0) NOT NULL DEFAULT CURRENT_TIMESTAMP,
  PRIMARY KEY (`Notification_ID`) USING BTREE
) ENGINE = InnoDB AUTO_INCREMENT = 3 CHARACTER SET = latin1 COLLATE = latin1_swedish_ci ROW_FORMAT = Compact;

-- ----------------------------
-- Records of r_notification
-- ----------------------------
INSERT INTO `r_notification` VALUES (1, 'EVNT00003', 'CITS2019', '2018-OSAS-CM', 'Seen', 'Clicked', 'Organization', '2018-05-23 13:47:13', '2018-05-25 00:23:54', '2018-05-23 13:46:57');
INSERT INTO `r_notification` VALUES (2, 'Vouch #00001', 'CITS2019', '2018-OSAS-CM', 'Seen', 'Clicked', 'OSAS Head', '2018-05-26 10:29:07', '2018-05-26 10:29:09', '2018-05-26 10:29:02');

-- ----------------------------
-- Table structure for r_org_accreditation_details
-- ----------------------------
DROP TABLE IF EXISTS `r_org_accreditation_details`;
CREATE TABLE `r_org_accreditation_details`  (
  `OrgAccrDetail_ID` int(11) NOT NULL AUTO_INCREMENT,
  `OrgAccrDetail_CODE` varchar(15) CHARACTER SET latin1 COLLATE latin1_swedish_ci NOT NULL,
  `OrgAccrDetail_NAME` varchar(100) CHARACTER SET latin1 COLLATE latin1_swedish_ci NOT NULL,
  `OrgAccrDetail_DESC` varchar(100) CHARACTER SET latin1 COLLATE latin1_swedish_ci NULL DEFAULT 'Accreditation Description',
  `OrgAccrDetail_DATE_ADD` datetime(0) NOT NULL DEFAULT CURRENT_TIMESTAMP,
  `OrgAccrDetail_DATE_MOD` datetime(0) NOT NULL DEFAULT CURRENT_TIMESTAMP,
  `OrgAccrDetail_DISPLAY_STAT` enum('Active','Inactive') CHARACTER SET latin1 COLLATE latin1_swedish_ci NULL DEFAULT 'Active',
  PRIMARY KEY (`OrgAccrDetail_ID`) USING BTREE,
  UNIQUE INDEX `UNQ_OrgAccrDetail_CODE`(`OrgAccrDetail_CODE`) USING BTREE
) ENGINE = InnoDB AUTO_INCREMENT = 5 CHARACTER SET = latin1 COLLATE = latin1_swedish_ci ROW_FORMAT = Compact;

-- ----------------------------
-- Records of r_org_accreditation_details
-- ----------------------------
INSERT INTO `r_org_accreditation_details` VALUES (1, 'REQ00001', 'Organization Name', 'Organization Name Description', '2018-05-23 12:46:05', '2018-05-23 12:46:05', 'Active');
INSERT INTO `r_org_accreditation_details` VALUES (2, 'REQ00002', 'Organization Category', 'Organization Category Description', '2018-05-23 12:46:20', '2018-05-23 12:46:56', 'Active');
INSERT INTO `r_org_accreditation_details` VALUES (3, 'REQ00003', 'Organization Members', 'Organization Members Description', '2018-05-23 12:46:36', '2018-05-23 12:47:00', 'Active');
INSERT INTO `r_org_accreditation_details` VALUES (4, 'REQ00004', 'Organization Officers', 'Organization Officers Description', '2018-05-23 12:46:45', '2018-05-23 12:47:03', 'Active');

-- ----------------------------
-- Table structure for r_org_applicant_profile
-- ----------------------------
DROP TABLE IF EXISTS `r_org_applicant_profile`;
CREATE TABLE `r_org_applicant_profile`  (
  `OrgAppProfile_ID` int(11) NOT NULL AUTO_INCREMENT,
  `OrgAppProfile_APPL_CODE` varchar(15) CHARACTER SET latin1 COLLATE latin1_swedish_ci NOT NULL,
  `OrgAppProfile_NAME` varchar(100) CHARACTER SET latin1 COLLATE latin1_swedish_ci NOT NULL,
  `OrgAppProfile_DESCRIPTION` varchar(500) CHARACTER SET latin1 COLLATE latin1_swedish_ci NULL DEFAULT 'Organization description should be here!',
  `OrgAppProfile_STATUS` varchar(100) CHARACTER SET latin1 COLLATE latin1_swedish_ci NOT NULL DEFAULT 'This application is ready for accreditation',
  `OrgAppProfile_DATE_ADD` datetime(0) NOT NULL DEFAULT CURRENT_TIMESTAMP,
  `OrgAppProfile_DATE_MOD` datetime(0) NOT NULL DEFAULT CURRENT_TIMESTAMP,
  `OrgAppProfile_DISPLAY_STAT` enum('Active','Inactive') CHARACTER SET latin1 COLLATE latin1_swedish_ci NULL DEFAULT 'Active',
  PRIMARY KEY (`OrgAppProfile_ID`) USING BTREE,
  UNIQUE INDEX `UNQ_OrgAppProfile_ORG_CODE`(`OrgAppProfile_APPL_CODE`) USING BTREE
) ENGINE = InnoDB AUTO_INCREMENT = 2 CHARACTER SET = latin1 COLLATE = latin1_swedish_ci ROW_FORMAT = Compact;

-- ----------------------------
-- Records of r_org_applicant_profile
-- ----------------------------
INSERT INTO `r_org_applicant_profile` VALUES (1, 'CITS2019', 'Commonwealth Information Technology Society', 'This is an Academic Organization, responsible for managing and inspiring its members.', 'This application is ready for accreditation', '2018-05-23 12:44:12', '2018-05-23 12:44:12', 'Active');

-- ----------------------------
-- Table structure for r_org_category
-- ----------------------------
DROP TABLE IF EXISTS `r_org_category`;
CREATE TABLE `r_org_category`  (
  `OrgCat_ID` int(11) NOT NULL AUTO_INCREMENT,
  `OrgCat_CODE` varchar(15) CHARACTER SET latin1 COLLATE latin1_swedish_ci NOT NULL,
  `OrgCat_NAME` varchar(100) CHARACTER SET latin1 COLLATE latin1_swedish_ci NOT NULL,
  `OrgCat_DESC` varchar(100) CHARACTER SET latin1 COLLATE latin1_swedish_ci NULL DEFAULT 'Org Category Description',
  `OrgCat_DATE_ADD` datetime(0) NOT NULL DEFAULT CURRENT_TIMESTAMP,
  `OrgCat_DATE_MOD` datetime(0) NOT NULL DEFAULT CURRENT_TIMESTAMP,
  `OrgCat_DISPLAY_STAT` enum('Active','Inactive') CHARACTER SET latin1 COLLATE latin1_swedish_ci NULL DEFAULT 'Active',
  PRIMARY KEY (`OrgCat_ID`) USING BTREE,
  UNIQUE INDEX `UNQ_OrgCat_NAME`(`OrgCat_CODE`) USING BTREE
) ENGINE = InnoDB AUTO_INCREMENT = 6 CHARACTER SET = latin1 COLLATE = latin1_swedish_ci ROW_FORMAT = Compact;

-- ----------------------------
-- Records of r_org_category
-- ----------------------------
INSERT INTO `r_org_category` VALUES (4, 'ACAD_ORG', 'Academic Organization', 'Academic Organization', '2018-05-21 00:23:24', '2018-05-21 00:23:24', 'Active');
INSERT INTO `r_org_category` VALUES (5, 'NON-ACAD_ORG', 'Non-Academic Organization', 'Non-Academic Organization', '2018-05-21 00:25:49', '2018-05-21 00:25:49', 'Active');

-- ----------------------------
-- Table structure for r_org_essentials
-- ----------------------------
DROP TABLE IF EXISTS `r_org_essentials`;
CREATE TABLE `r_org_essentials`  (
  `OrgEssentials_ID` int(11) NOT NULL AUTO_INCREMENT,
  `OrgEssentials_ORG_CODE` varchar(15) CHARACTER SET latin1 COLLATE latin1_swedish_ci NOT NULL,
  `OrgEssentials_MISSION` varchar(1000) CHARACTER SET latin1 COLLATE latin1_swedish_ci NOT NULL,
  `OrgEssentials_VISION` varchar(1000) CHARACTER SET latin1 COLLATE latin1_swedish_ci NOT NULL,
  `OrgEssentials_LOGO` blob NOT NULL,
  `OrgEssentials_DATE_ADD` datetime(0) NULL DEFAULT CURRENT_TIMESTAMP,
  `OrgEssentials_DATE_MOD` datetime(0) NULL DEFAULT CURRENT_TIMESTAMP,
  `OrgEssentials_DISPLAY_STAT` enum('Active','Inactive') CHARACTER SET latin1 COLLATE latin1_swedish_ci NULL DEFAULT 'Active',
  PRIMARY KEY (`OrgEssentials_ID`) USING BTREE,
  INDEX `FK_OrgEssentials_ORG_CODE`(`OrgEssentials_ORG_CODE`) USING BTREE,
  CONSTRAINT `FK_OrgEssentials_ORG_CODE` FOREIGN KEY (`OrgEssentials_ORG_CODE`) REFERENCES `t_org_for_compliance` (`OrgForCompliance_ORG_CODE`) ON DELETE CASCADE ON UPDATE CASCADE
) ENGINE = InnoDB AUTO_INCREMENT = 2 CHARACTER SET = latin1 COLLATE = latin1_swedish_ci ROW_FORMAT = Compact;

-- ----------------------------
-- Records of r_org_essentials
-- ----------------------------
INSERT INTO `r_org_essentials` VALUES (1, 'CITS2019', 'MissionMissionMission', 'VisionVisionVision', '', '2018-05-23 12:45:08', '2018-05-23 12:45:08', 'Active');

-- ----------------------------
-- Table structure for r_org_event_management
-- ----------------------------
DROP TABLE IF EXISTS `r_org_event_management`;
CREATE TABLE `r_org_event_management`  (
  `OrgEvent_ID` int(11) NOT NULL AUTO_INCREMENT,
  `OrgEvent_OrgCode` varchar(15) CHARACTER SET latin1 COLLATE latin1_swedish_ci NOT NULL,
  `OrgEvent_Code` varchar(15) CHARACTER SET latin1 COLLATE latin1_swedish_ci NOT NULL,
  `OrgEvent_NAME` varchar(50) CHARACTER SET latin1 COLLATE latin1_swedish_ci NOT NULL,
  `OrgEvent_DESCRIPTION` varchar(50) CHARACTER SET latin1 COLLATE latin1_swedish_ci NOT NULL,
  `OrgEvent_FILES` varchar(100) CHARACTER SET latin1 COLLATE latin1_swedish_ci NOT NULL,
  `OrgEvent_STATUS` enum('Cancelled','Pending','Approved','Rejected') CHARACTER SET latin1 COLLATE latin1_swedish_ci NOT NULL DEFAULT 'Pending',
  `OrgEvent_PROPOSED_DATE` date NOT NULL,
  `OrgEvent_ReviewdBy` varchar(15) CHARACTER SET latin1 COLLATE latin1_swedish_ci NOT NULL,
  `OrgEvent_DATE_ADD` datetime(0) NOT NULL DEFAULT CURRENT_TIMESTAMP,
  `OrgEvent_DATE_MOD` datetime(0) NULL DEFAULT NULL,
  `OrgEvent_DISPLAY_STAT` enum('Active','Inactive') CHARACTER SET latin1 COLLATE latin1_swedish_ci NOT NULL DEFAULT 'Active',
  PRIMARY KEY (`OrgEvent_ID`) USING BTREE,
  UNIQUE INDEX `UNQ_ORGEVENT_CODE`(`OrgEvent_Code`) USING BTREE,
  INDEX `FK_ORGEVENT_ORGCODE`(`OrgEvent_OrgCode`) USING BTREE,
  CONSTRAINT `FK_ORGEVENT_ORGCODE` FOREIGN KEY (`OrgEvent_OrgCode`) REFERENCES `t_org_for_compliance` (`OrgForCompliance_ORG_CODE`) ON DELETE RESTRICT ON UPDATE RESTRICT
) ENGINE = InnoDB AUTO_INCREMENT = 4 CHARACTER SET = latin1 COLLATE = latin1_swedish_ci ROW_FORMAT = Compact;

-- ----------------------------
-- Records of r_org_event_management
-- ----------------------------
INSERT INTO `r_org_event_management` VALUES (2, 'CITS2019', 'EVNT00002', 'sdsa', 'sdsa', '../../../Documents/EventDocu-2019-2020-Summer Semester-CITS2019-sdsa.png', 'Approved', '3123-02-12', 'Demelyn E. Monz', '2018-05-23 13:41:40', NULL, 'Active');
INSERT INTO `r_org_event_management` VALUES (3, 'CITS2019', 'EVNT00003', '$orgcode', 'asd', '../../Documents/EventDocu-2019-2020-Summer Semester-CITS2019-$orgcode.png', 'Pending', '0000-00-00', '', '2018-05-23 13:46:57', NULL, 'Active');

-- ----------------------------
-- Table structure for r_org_non_academic_details
-- ----------------------------
DROP TABLE IF EXISTS `r_org_non_academic_details`;
CREATE TABLE `r_org_non_academic_details`  (
  `OrgNonAcad_ID` int(11) NOT NULL AUTO_INCREMENT,
  `OrgNonAcad_CODE` varchar(15) CHARACTER SET latin1 COLLATE latin1_swedish_ci NOT NULL,
  `OrgNonAcad_NAME` varchar(100) CHARACTER SET latin1 COLLATE latin1_swedish_ci NOT NULL,
  `OrgNonAcad_DESC` varchar(100) CHARACTER SET latin1 COLLATE latin1_swedish_ci NULL DEFAULT NULL,
  `OrgNonAcad_DATE_ADD` datetime(0) NOT NULL DEFAULT CURRENT_TIMESTAMP,
  `OrgNonAcad_DATE_MOD` datetime(0) NOT NULL DEFAULT CURRENT_TIMESTAMP,
  `OrgNonAcad_DISPLAY_STAT` enum('Active','Inactive') CHARACTER SET latin1 COLLATE latin1_swedish_ci NOT NULL DEFAULT 'Active',
  PRIMARY KEY (`OrgNonAcad_ID`) USING BTREE,
  UNIQUE INDEX `UNQ_OrgNonAcad_CODE`(`OrgNonAcad_CODE`) USING BTREE,
  UNIQUE INDEX `UNQ_OrgNonAcad_NAME`(`OrgNonAcad_NAME`) USING BTREE
) ENGINE = InnoDB AUTO_INCREMENT = 3 CHARACTER SET = latin1 COLLATE = latin1_swedish_ci ROW_FORMAT = Compact;

-- ----------------------------
-- Records of r_org_non_academic_details
-- ----------------------------
INSERT INTO `r_org_non_academic_details` VALUES (2, 'REL_ORG', 'Relogious Organization', 'Relogious Organization', '2018-05-21 00:31:56', '2018-05-21 00:31:56', 'Active');

-- ----------------------------
-- Table structure for r_org_officer_position_details
-- ----------------------------
DROP TABLE IF EXISTS `r_org_officer_position_details`;
CREATE TABLE `r_org_officer_position_details`  (
  `OrgOffiPosDetails_ID` int(11) NOT NULL AUTO_INCREMENT,
  `OrgOffiPosDetails_ORG_CODE` varchar(15) CHARACTER SET latin1 COLLATE latin1_swedish_ci NOT NULL,
  `OrgOffiPosDetails_NAME` varchar(100) CHARACTER SET latin1 COLLATE latin1_swedish_ci NOT NULL,
  `OrgOffiPosDetails_DESC` varchar(100) CHARACTER SET latin1 COLLATE latin1_swedish_ci NOT NULL DEFAULT 'Office Position Description',
  `OrgOffiPosDetails_NumOfOcc` int(11) NOT NULL DEFAULT 1,
  `OrgOffiPosDetails_DATE_MOD` datetime(0) NOT NULL DEFAULT CURRENT_TIMESTAMP,
  `OrgOffiPosDetails_DATE_ADD` datetime(0) NOT NULL DEFAULT CURRENT_TIMESTAMP,
  `OrgOffiPosDetails_DISPLAY_STAT` enum('Active','Inactive') CHARACTER SET latin1 COLLATE latin1_swedish_ci NULL DEFAULT 'Active',
  PRIMARY KEY (`OrgOffiPosDetails_ID`) USING BTREE,
  INDEX `FK_OrgOffiPosDetails_ORG_CODE`(`OrgOffiPosDetails_ORG_CODE`) USING BTREE,
  CONSTRAINT `FK_OrgOffiPosDetails_ORG_CODE` FOREIGN KEY (`OrgOffiPosDetails_ORG_CODE`) REFERENCES `t_org_for_compliance` (`OrgForCompliance_ORG_CODE`) ON DELETE CASCADE ON UPDATE CASCADE
) ENGINE = InnoDB AUTO_INCREMENT = 17 CHARACTER SET = latin1 COLLATE = latin1_swedish_ci ROW_FORMAT = Compact;

-- ----------------------------
-- Records of r_org_officer_position_details
-- ----------------------------
INSERT INTO `r_org_officer_position_details` VALUES (1, 'CITS2019', 'President', 'Office Position Description', 1, '2018-05-23 12:44:12', '2018-05-23 12:44:12', 'Active');
INSERT INTO `r_org_officer_position_details` VALUES (2, 'CITS2019', 'Vice-President of internal affair', 'Office Position Description', 1, '2018-05-23 12:44:12', '2018-05-23 12:44:12', 'Active');
INSERT INTO `r_org_officer_position_details` VALUES (3, 'CITS2019', 'Vice-President of external affair', 'Office Position Description', 1, '2018-05-23 12:44:13', '2018-05-23 12:44:13', 'Active');
INSERT INTO `r_org_officer_position_details` VALUES (4, 'CITS2019', 'Budget and Finance', 'Office Position Description', 1, '2018-05-23 12:44:13', '2018-05-23 12:44:13', 'Active');
INSERT INTO `r_org_officer_position_details` VALUES (5, 'CITS2019', 'Auditor', 'Office Position Description', 1, '2018-05-23 12:44:13', '2018-05-23 12:44:13', 'Active');
INSERT INTO `r_org_officer_position_details` VALUES (16, 'CITS2019', 'Research and Development Team', 'Research and Development Team', 4, '2018-05-24 10:28:11', '2018-05-24 10:28:11', 'Active');

-- ----------------------------
-- Table structure for r_osas_head
-- ----------------------------
DROP TABLE IF EXISTS `r_osas_head`;
CREATE TABLE `r_osas_head`  (
  `OSASHead_ID` int(11) NOT NULL AUTO_INCREMENT,
  `OSASHead_CODE` varchar(15) CHARACTER SET latin1 COLLATE latin1_swedish_ci NOT NULL,
  `OSASHead_NAME` varchar(100) CHARACTER SET latin1 COLLATE latin1_swedish_ci NOT NULL,
  `OSASHead_DESC` varchar(100) CHARACTER SET latin1 COLLATE latin1_swedish_ci NOT NULL DEFAULT 'Introduce your self',
  `OSASHead_DATE_PROMOTED` datetime(0) NOT NULL DEFAULT CURRENT_TIMESTAMP,
  `OSASHead_DATE_ADD` datetime(0) NOT NULL DEFAULT CURRENT_TIMESTAMP,
  `OSASHead_DATE_MOD` datetime(0) NOT NULL DEFAULT CURRENT_TIMESTAMP,
  `OSASHead_DISPLAY_STAT` enum('Active','Inactive') CHARACTER SET latin1 COLLATE latin1_swedish_ci NULL DEFAULT 'Active',
  PRIMARY KEY (`OSASHead_ID`) USING BTREE,
  UNIQUE INDEX `UNQ_OSASHead_CODE`(`OSASHead_CODE`) USING BTREE
) ENGINE = InnoDB AUTO_INCREMENT = 3 CHARACTER SET = latin1 COLLATE = latin1_swedish_ci ROW_FORMAT = Compact;

-- ----------------------------
-- Records of r_osas_head
-- ----------------------------
INSERT INTO `r_osas_head` VALUES (2, '2018-OSAS-CM', 'Demelyn E. Monzon', 'Introduce your self', '2018-05-20 23:48:58', '2018-05-20 23:48:58', '2018-05-20 23:48:58', 'Active');

-- ----------------------------
-- Table structure for r_remarks
-- ----------------------------
DROP TABLE IF EXISTS `r_remarks`;
CREATE TABLE `r_remarks`  (
  `Remarks_ID` int(11) NOT NULL AUTO_INCREMENT,
  `Remarks_TYPE` varchar(50) CHARACTER SET latin1 COLLATE latin1_swedish_ci NOT NULL,
  `Remarks_DESC` text CHARACTER SET latin1 COLLATE latin1_swedish_ci NULL,
  `Remarks_STAT` enum('Active','Inactive') CHARACTER SET latin1 COLLATE latin1_swedish_ci NULL DEFAULT 'Active',
  PRIMARY KEY (`Remarks_ID`) USING BTREE,
  UNIQUE INDEX `Remarks_TYPE`(`Remarks_TYPE`) USING BTREE
) ENGINE = InnoDB AUTO_INCREMENT = 1 CHARACTER SET = latin1 COLLATE = latin1_swedish_ci ROW_FORMAT = Compact;

-- ----------------------------
-- Table structure for r_sanction_details
-- ----------------------------
DROP TABLE IF EXISTS `r_sanction_details`;
CREATE TABLE `r_sanction_details`  (
  `SancDetails_ID` int(11) NOT NULL AUTO_INCREMENT,
  `SancDetails_CODE` varchar(100) CHARACTER SET latin1 COLLATE latin1_swedish_ci NOT NULL,
  `SancDetails_NAME` varchar(100) CHARACTER SET latin1 COLLATE latin1_swedish_ci NOT NULL,
  `SancDetails_DESC` varchar(1000) CHARACTER SET latin1 COLLATE latin1_swedish_ci NULL DEFAULT 'Sanction Description',
  `SancDetails_TIMEVAL` int(11) NOT NULL DEFAULT 0,
  `SancDetails_DATE_MOD` datetime(0) NOT NULL DEFAULT CURRENT_TIMESTAMP,
  `SancDetails_DATE_ADD` datetime(0) NOT NULL DEFAULT CURRENT_TIMESTAMP,
  `SancDetails_DISPLAY_STAT` enum('Active','Inactive') CHARACTER SET latin1 COLLATE latin1_swedish_ci NULL DEFAULT 'Active',
  PRIMARY KEY (`SancDetails_ID`) USING BTREE,
  UNIQUE INDEX `UNQ_SancDetails_CODE`(`SancDetails_CODE`) USING BTREE
) ENGINE = InnoDB AUTO_INCREMENT = 20 CHARACTER SET = latin1 COLLATE = latin1_swedish_ci ROW_FORMAT = Compact;

-- ----------------------------
-- Records of r_sanction_details
-- ----------------------------
INSERT INTO `r_sanction_details` VALUES (17, 'LossRegi_16', 'Loss of Registration Card', 'Loss of Registration Card', 16, '2018-05-21 08:09:48', '2018-05-21 00:38:11', 'Active');
INSERT INTO `r_sanction_details` VALUES (18, 'LossID_16', 'Loss of Identification Card', 'Loss of Identification Card	', 16, '2018-05-21 08:09:42', '2018-05-21 00:38:30', 'Active');
INSERT INTO `r_sanction_details` VALUES (19, 'Late_Regi', 'Late Claim of Registration Card', 'Late Claim of Registration Card', 16, '2018-05-21 08:09:32', '2018-05-21 08:09:32', 'Active');

-- ----------------------------
-- Table structure for r_semester
-- ----------------------------
DROP TABLE IF EXISTS `r_semester`;
CREATE TABLE `r_semester`  (
  `Semestral_ID` int(11) NOT NULL AUTO_INCREMENT,
  `Semestral_CODE` varchar(15) CHARACTER SET latin1 COLLATE latin1_swedish_ci NOT NULL,
  `Semestral_NAME` varchar(50) CHARACTER SET latin1 COLLATE latin1_swedish_ci NOT NULL,
  `Semestral_DESC` varchar(100) CHARACTER SET latin1 COLLATE latin1_swedish_ci NULL DEFAULT 'Semester Description',
  `Semestral_DATE_ADD` datetime(0) NOT NULL DEFAULT CURRENT_TIMESTAMP,
  `Semestral_DATE_MOD` datetime(0) NOT NULL DEFAULT CURRENT_TIMESTAMP,
  `Semestral_DISPLAY_STAT` enum('Active','Inactive') CHARACTER SET latin1 COLLATE latin1_swedish_ci NULL DEFAULT 'Active',
  PRIMARY KEY (`Semestral_ID`) USING BTREE,
  UNIQUE INDEX `UNQ_Semstral_NAME`(`Semestral_NAME`) USING BTREE
) ENGINE = InnoDB AUTO_INCREMENT = 12 CHARACTER SET = latin1 COLLATE = latin1_swedish_ci ROW_FORMAT = Compact;

-- ----------------------------
-- Records of r_semester
-- ----------------------------
INSERT INTO `r_semester` VALUES (7, 'SEM00001', 'First Semester', 'First Semester', '2018-05-21 00:14:49', '2018-05-21 00:14:49', 'Active');
INSERT INTO `r_semester` VALUES (8, 'SEM00002', 'Second Semester', 'Second Semester', '2018-05-21 00:14:57', '2018-05-21 00:14:57', 'Active');
INSERT INTO `r_semester` VALUES (9, 'SEM00003', 'Third Semester', 'Third Semester', '2018-05-21 00:15:08', '2018-05-21 00:15:08', 'Active');
INSERT INTO `r_semester` VALUES (10, 'SEM00004', 'Fourth Semester', 'Fourth Semester', '2018-05-21 00:15:16', '2018-05-21 00:15:16', 'Active');
INSERT INTO `r_semester` VALUES (11, 'SEM00005', 'Summer Semester', 'Summer Semester', '2018-05-21 00:15:25', '2018-05-21 00:15:25', 'Active');

-- ----------------------------
-- Table structure for r_stud_batch
-- ----------------------------
DROP TABLE IF EXISTS `r_stud_batch`;
CREATE TABLE `r_stud_batch`  (
  `Stud_BATCH_ID` int(11) NOT NULL AUTO_INCREMENT,
  `Stud_NO` varchar(15) CHARACTER SET latin1 COLLATE latin1_swedish_ci NOT NULL,
  `Batch_YEAR` varchar(15) CHARACTER SET latin1 COLLATE latin1_swedish_ci NOT NULL,
  `Stud_STATUS` enum('Regular','Irregular','Disqualified','LOA','Transferee') CHARACTER SET latin1 COLLATE latin1_swedish_ci NULL DEFAULT 'Regular',
  PRIMARY KEY (`Stud_BATCH_ID`) USING BTREE,
  INDEX `FK_stdbtchrfrnc_STUD_NO`(`Stud_NO`) USING BTREE,
  INDEX `FK_stdbtchyrrfrnc`(`Batch_YEAR`) USING BTREE,
  CONSTRAINT `FK_stdbtchrfrnc_STUD_NO` FOREIGN KEY (`Stud_NO`) REFERENCES `r_stud_profile` (`Stud_NO`) ON DELETE CASCADE ON UPDATE CASCADE,
  CONSTRAINT `FK_stdbtchyrrfrnc` FOREIGN KEY (`Batch_YEAR`) REFERENCES `r_batch_details` (`Batch_YEAR`) ON DELETE CASCADE ON UPDATE CASCADE
) ENGINE = InnoDB AUTO_INCREMENT = 2 CHARACTER SET = latin1 COLLATE = latin1_swedish_ci ROW_FORMAT = Compact;

-- ----------------------------
-- Records of r_stud_batch
-- ----------------------------
INSERT INTO `r_stud_batch` VALUES (1, '2015-00138-CM-0', '2017-2018', 'Regular');

-- ----------------------------
-- Table structure for r_stud_educ_background
-- ----------------------------
DROP TABLE IF EXISTS `r_stud_educ_background`;
CREATE TABLE `r_stud_educ_background`  (
  `Educ_BG_ID` int(11) NOT NULL AUTO_INCREMENT,
  `Stud_NO_REFERENCE` varchar(15) CHARACTER SET latin1 COLLATE latin1_swedish_ci NOT NULL,
  `Educ_NATURE_OF_SCHOOLING` enum('Continuous','Interrupted') CHARACTER SET latin1 COLLATE latin1_swedish_ci NULL DEFAULT 'Continuous',
  `Interrupted_REASON` varchar(500) CHARACTER SET latin1 COLLATE latin1_swedish_ci NULL DEFAULT 'None',
  PRIMARY KEY (`Educ_BG_ID`) USING BTREE,
  INDEX `FK_edcbckgrndrfrnc_STUD_NO`(`Stud_NO_REFERENCE`) USING BTREE,
  CONSTRAINT `FK_edcbckgrndrfrnc_STUD_NO` FOREIGN KEY (`Stud_NO_REFERENCE`) REFERENCES `r_stud_profile` (`Stud_NO`) ON DELETE CASCADE ON UPDATE CASCADE
) ENGINE = InnoDB AUTO_INCREMENT = 1 CHARACTER SET = latin1 COLLATE = latin1_swedish_ci ROW_FORMAT = Compact;

-- ----------------------------
-- Table structure for r_stud_educ_bg_details
-- ----------------------------
DROP TABLE IF EXISTS `r_stud_educ_bg_details`;
CREATE TABLE `r_stud_educ_bg_details`  (
  `Educ_BG_ID` int(11) NOT NULL,
  `Educ_LEVEL` enum('Pre-elementary','Elementary','High School','Vocational','College if any') CHARACTER SET latin1 COLLATE latin1_swedish_ci NOT NULL,
  `Educ_SCHOOL_GRADUATED` varchar(500) CHARACTER SET latin1 COLLATE latin1_swedish_ci NULL DEFAULT 'None',
  `Educ_SCHOOL_ADDRESS` varchar(500) CHARACTER SET latin1 COLLATE latin1_swedish_ci NULL DEFAULT 'None',
  `Educ_SCHOOL_TYPE` enum('Public','Private') CHARACTER SET latin1 COLLATE latin1_swedish_ci NULL DEFAULT 'Public',
  `Educ_DATES_OF_ATTENDANCE` varchar(15) CHARACTER SET latin1 COLLATE latin1_swedish_ci NOT NULL,
  INDEX `FK_stdedcbgdtlsedcbg_ID`(`Educ_BG_ID`) USING BTREE,
  CONSTRAINT `FK_stdedcbgdtlsedcbg_ID` FOREIGN KEY (`Educ_BG_ID`) REFERENCES `r_stud_educ_background` (`Educ_BG_ID`) ON DELETE CASCADE ON UPDATE CASCADE
) ENGINE = InnoDB CHARACTER SET = latin1 COLLATE = latin1_swedish_ci ROW_FORMAT = Compact;

-- ----------------------------
-- Table structure for r_stud_family_bg_details
-- ----------------------------
DROP TABLE IF EXISTS `r_stud_family_bg_details`;
CREATE TABLE `r_stud_family_bg_details`  (
  `Stud_NO_REFERENCE` varchar(15) CHARACTER SET latin1 COLLATE latin1_swedish_ci NOT NULL,
  `FamilyBG_INFO` enum('Father','Mother','Guardian') CHARACTER SET latin1 COLLATE latin1_swedish_ci NOT NULL,
  `Info_FNAME` varchar(100) CHARACTER SET latin1 COLLATE latin1_swedish_ci NOT NULL,
  `Info_MNAME` varchar(100) CHARACTER SET latin1 COLLATE latin1_swedish_ci NOT NULL,
  `Info_LNAME` varchar(100) CHARACTER SET latin1 COLLATE latin1_swedish_ci NOT NULL,
  `Info_AGE` int(11) NOT NULL,
  `Info_STAT` enum('Living','Deceased') CHARACTER SET latin1 COLLATE latin1_swedish_ci NULL DEFAULT 'Living',
  `Info_EDUC_ATTAINMENT` varchar(100) CHARACTER SET latin1 COLLATE latin1_swedish_ci NOT NULL,
  `Info_OCCUPATION` varchar(100) CHARACTER SET latin1 COLLATE latin1_swedish_ci NOT NULL,
  `Info_EMPLOYER_NAME` varchar(300) CHARACTER SET latin1 COLLATE latin1_swedish_ci NULL DEFAULT 'None',
  `Info_EMPLOYER_ADDRESS` varchar(500) CHARACTER SET latin1 COLLATE latin1_swedish_ci NULL DEFAULT 'None',
  INDEX `FK_stdfmlybckgrndrfrnc_STUD_NO`(`Stud_NO_REFERENCE`) USING BTREE,
  CONSTRAINT `FK_stdfmlybckgrndrfrnc_STUD_NO` FOREIGN KEY (`Stud_NO_REFERENCE`) REFERENCES `r_stud_profile` (`Stud_NO`) ON DELETE CASCADE ON UPDATE CASCADE
) ENGINE = InnoDB CHARACTER SET = latin1 COLLATE = latin1_swedish_ci ROW_FORMAT = Compact;

-- ----------------------------
-- Table structure for r_stud_general_info
-- ----------------------------
DROP TABLE IF EXISTS `r_stud_general_info`;
CREATE TABLE `r_stud_general_info`  (
  `Stud_NO` varchar(15) CHARACTER SET latin1 COLLATE latin1_swedish_ci NOT NULL,
  `Gen_Info_DETAILS` enum('Favorite Subject/s','Subject/s Least Like','Club','Hobbies','Organization') CHARACTER SET latin1 COLLATE latin1_swedish_ci NOT NULL,
  `Gen_Info_CONTENT` varchar(100) CHARACTER SET latin1 COLLATE latin1_swedish_ci NOT NULL,
  INDEX `FK_gnrlinf_STUD_NO`(`Stud_NO`) USING BTREE,
  CONSTRAINT `FK_gnrlinf_STUD_NO` FOREIGN KEY (`Stud_NO`) REFERENCES `r_stud_profile` (`Stud_NO`) ON DELETE CASCADE ON UPDATE CASCADE
) ENGINE = InnoDB CHARACTER SET = latin1 COLLATE = latin1_swedish_ci ROW_FORMAT = Compact;

-- ----------------------------
-- Table structure for r_stud_honors_awards
-- ----------------------------
DROP TABLE IF EXISTS `r_stud_honors_awards`;
CREATE TABLE `r_stud_honors_awards`  (
  `Educ_BG_ID` int(11) NOT NULL,
  `Stud_NO_REFERENCE` varchar(15) CHARACTER SET latin1 COLLATE latin1_swedish_ci NOT NULL,
  `Received_TYPE` enum('Honors Received','Special Awards') CHARACTER SET latin1 COLLATE latin1_swedish_ci NULL DEFAULT 'Honors Received',
  `Received_Desc` varchar(100) CHARACTER SET latin1 COLLATE latin1_swedish_ci NOT NULL,
  INDEX `FK_stdhnrsawrdsedcbg_ID`(`Educ_BG_ID`) USING BTREE,
  INDEX `FK_hnrsawrds_STUD_NO`(`Stud_NO_REFERENCE`) USING BTREE,
  CONSTRAINT `FK_hnrsawrds_STUD_NO` FOREIGN KEY (`Stud_NO_REFERENCE`) REFERENCES `r_stud_profile` (`Stud_NO`) ON DELETE CASCADE ON UPDATE CASCADE,
  CONSTRAINT `FK_stdhnrsawrdsedcbg_ID` FOREIGN KEY (`Educ_BG_ID`) REFERENCES `r_stud_educ_background` (`Educ_BG_ID`) ON DELETE CASCADE ON UPDATE CASCADE
) ENGINE = InnoDB CHARACTER SET = latin1 COLLATE = latin1_swedish_ci ROW_FORMAT = Compact;

-- ----------------------------
-- Table structure for r_stud_org_position
-- ----------------------------
DROP TABLE IF EXISTS `r_stud_org_position`;
CREATE TABLE `r_stud_org_position`  (
  `Stud_NO_REFERENCE` varchar(15) CHARACTER SET latin1 COLLATE latin1_swedish_ci NOT NULL,
  `Stud_POSITION` text CHARACTER SET latin1 COLLATE latin1_swedish_ci NOT NULL,
  INDEX `FK_orgpstn_STUD_NO`(`Stud_NO_REFERENCE`) USING BTREE,
  CONSTRAINT `FK_orgpstn_STUD_NO` FOREIGN KEY (`Stud_NO_REFERENCE`) REFERENCES `r_stud_profile` (`Stud_NO`) ON DELETE CASCADE ON UPDATE CASCADE
) ENGINE = InnoDB CHARACTER SET = latin1 COLLATE = latin1_swedish_ci ROW_FORMAT = Compact;

-- ----------------------------
-- Table structure for r_stud_personal_info
-- ----------------------------
DROP TABLE IF EXISTS `r_stud_personal_info`;
CREATE TABLE `r_stud_personal_info`  (
  `Stud_NO_REFERENCE` varchar(15) CHARACTER SET latin1 COLLATE latin1_swedish_ci NOT NULL,
  `Stud_HEIGHT` double(9, 2) NOT NULL,
  `Stud_WEIGHT` double(9, 2) NOT NULL,
  `Stud_COMPLEXION` varchar(50) CHARACTER SET latin1 COLLATE latin1_swedish_ci NOT NULL,
  `Stud_HS_GEN_AVERAGE` double(3, 2) NOT NULL,
  `Stud_RELIGION` varchar(100) CHARACTER SET latin1 COLLATE latin1_swedish_ci NOT NULL,
  `Stud_CIVIL_STAT` varchar(15) CHARACTER SET latin1 COLLATE latin1_swedish_ci NOT NULL,
  `Stud_WORKING` enum('Yes','No') CHARACTER SET latin1 COLLATE latin1_swedish_ci NULL DEFAULT 'No',
  `Employer_NAME` varchar(300) CHARACTER SET latin1 COLLATE latin1_swedish_ci NULL DEFAULT 'None',
  `Employer_ADDRESS` varchar(100) CHARACTER SET latin1 COLLATE latin1_swedish_ci NULL DEFAULT 'None',
  `Emergency_CONTACT_PERSON` varchar(500) CHARACTER SET latin1 COLLATE latin1_swedish_ci NOT NULL,
  `Emergency_CONTACT_ADDRESS` varchar(500) CHARACTER SET latin1 COLLATE latin1_swedish_ci NOT NULL,
  `Emergency_CONTACT_NUMBER` varchar(20) CHARACTER SET latin1 COLLATE latin1_swedish_ci NOT NULL DEFAULT 'None',
  `ContactPerson_RELATIONSHIP` varchar(100) CHARACTER SET latin1 COLLATE latin1_swedish_ci NOT NULL,
  `Parents_MARITAL_RELATIONSHIP` varchar(100) CHARACTER SET latin1 COLLATE latin1_swedish_ci NOT NULL,
  `Stud_FAM_CHILDREN_NO` int(11) NOT NULL,
  `Stud_BROTHER_NO` int(11) NULL DEFAULT 0,
  `Stud_SISTER_NO` int(11) NULL DEFAULT 0,
  `Employed_BS_NO` int(11) NULL DEFAULT 0,
  `Stud_ORDINAL_POSITION` varchar(50) CHARACTER SET latin1 COLLATE latin1_swedish_ci NOT NULL,
  `Stud_SCHOOLING_FINANCE` enum('Parents','Brother/Sister','Spouse','Scholarship','Relatives','Self-supporting/working student') CHARACTER SET latin1 COLLATE latin1_swedish_ci NULL DEFAULT 'Parents',
  `Stud_WEEKLY_ALLOWANCE` double(9, 2) NOT NULL,
  `Parents_TOTAL_MONTHLY_INCOME` varchar(100) CHARACTER SET latin1 COLLATE latin1_swedish_ci NOT NULL,
  `Stud_QUIET_PLACE` enum('Yes','No') CHARACTER SET latin1 COLLATE latin1_swedish_ci NULL DEFAULT 'Yes',
  `Stud_ROOM_SHARE` varchar(50) CHARACTER SET latin1 COLLATE latin1_swedish_ci NOT NULL,
  `Stud_RESIDENCE` enum('family home','relative''s house','share apartment with friends','share apartment with relatives','bed spacer','rented apartment','house of married brother/sister','dorm (including board & lodging)') CHARACTER SET latin1 COLLATE latin1_swedish_ci NULL DEFAULT 'family home',
  INDEX `FK_stdprsnlnfrfrnc_STUD_NO`(`Stud_NO_REFERENCE`) USING BTREE,
  INDEX `FK_stdprsnlnfcvlsttrfrnc`(`Stud_CIVIL_STAT`) USING BTREE,
  CONSTRAINT `FK_stdprsnlnfcvlsttrfrnc` FOREIGN KEY (`Stud_CIVIL_STAT`) REFERENCES `r_civil_stat` (`Stud_CIVIL_STATUS`) ON DELETE CASCADE ON UPDATE CASCADE,
  CONSTRAINT `FK_stdprsnlnfrfrnc_STUD_NO` FOREIGN KEY (`Stud_NO_REFERENCE`) REFERENCES `r_stud_profile` (`Stud_NO`) ON DELETE CASCADE ON UPDATE CASCADE
) ENGINE = InnoDB CHARACTER SET = latin1 COLLATE = latin1_swedish_ci ROW_FORMAT = Compact;

-- ----------------------------
-- Table structure for r_stud_phys_rec
-- ----------------------------
DROP TABLE IF EXISTS `r_stud_phys_rec`;
CREATE TABLE `r_stud_phys_rec`  (
  `Stud_NO_REFERENCE` varchar(15) CHARACTER SET latin1 COLLATE latin1_swedish_ci NOT NULL,
  `PhysicalRec_VISION` text CHARACTER SET latin1 COLLATE latin1_swedish_ci NOT NULL,
  `PhysicalRec_HEARING` text CHARACTER SET latin1 COLLATE latin1_swedish_ci NOT NULL,
  `PhysicalRec_SPEECH` text CHARACTER SET latin1 COLLATE latin1_swedish_ci NOT NULL,
  `PhysicalRec_GEN_HEALTH` text CHARACTER SET latin1 COLLATE latin1_swedish_ci NOT NULL,
  INDEX `FK_physrc_STUD_NO`(`Stud_NO_REFERENCE`) USING BTREE,
  CONSTRAINT `FK_physrc_STUD_NO` FOREIGN KEY (`Stud_NO_REFERENCE`) REFERENCES `r_stud_profile` (`Stud_NO`) ON DELETE CASCADE ON UPDATE CASCADE
) ENGINE = InnoDB CHARACTER SET = latin1 COLLATE = latin1_swedish_ci ROW_FORMAT = Compact;

-- ----------------------------
-- Table structure for r_stud_profile
-- ----------------------------
DROP TABLE IF EXISTS `r_stud_profile`;
CREATE TABLE `r_stud_profile`  (
  `Stud_ID` int(11) NOT NULL AUTO_INCREMENT,
  `Stud_NO` varchar(15) CHARACTER SET latin1 COLLATE latin1_swedish_ci NOT NULL,
  `Stud_FNAME` varchar(100) CHARACTER SET latin1 COLLATE latin1_swedish_ci NOT NULL,
  `Stud_MNAME` varchar(100) CHARACTER SET latin1 COLLATE latin1_swedish_ci NULL DEFAULT NULL,
  `Stud_LNAME` varchar(100) CHARACTER SET latin1 COLLATE latin1_swedish_ci NOT NULL,
  `Stud_GENDER` enum('Male','Female') CHARACTER SET latin1 COLLATE latin1_swedish_ci NOT NULL DEFAULT 'Male',
  `Stud_COURSE` varchar(15) CHARACTER SET latin1 COLLATE latin1_swedish_ci NOT NULL,
  `Stud_YEAR_LEVEL` int(11) NOT NULL DEFAULT 1,
  `Stud_SECTION` varchar(5) CHARACTER SET latin1 COLLATE latin1_swedish_ci NOT NULL DEFAULT '1',
  `Stud_BIRTH_DATE` date NOT NULL,
  `Stud_CITY_ADDRESS` varchar(500) CHARACTER SET latin1 COLLATE latin1_swedish_ci NOT NULL DEFAULT 'Not Specify',
  `Stud_PROVINCIAL_ADDRESS` varchar(500) CHARACTER SET latin1 COLLATE latin1_swedish_ci NOT NULL DEFAULT 'Not Specify',
  `Stud_TELEPHONE_NO` varchar(20) CHARACTER SET latin1 COLLATE latin1_swedish_ci NOT NULL DEFAULT 'None',
  `Stud_MOBILE_NO` varchar(20) CHARACTER SET latin1 COLLATE latin1_swedish_ci NOT NULL DEFAULT 'None',
  `Stud_EMAIL` varchar(100) CHARACTER SET latin1 COLLATE latin1_swedish_ci NOT NULL,
  `Stud_BIRTH_PLACE` varchar(500) CHARACTER SET latin1 COLLATE latin1_swedish_ci NULL DEFAULT NULL,
  `Stud_STATUS` enum('Regular','Irregular','Disqualified','LOA','Transferee') CHARACTER SET latin1 COLLATE latin1_swedish_ci NULL DEFAULT 'Regular',
  `Stud_DATE_MOD` datetime(0) NOT NULL DEFAULT CURRENT_TIMESTAMP,
  `Stud_DATE_ADD` datetime(0) NOT NULL DEFAULT CURRENT_TIMESTAMP,
  `Stud_DATE_DEACTIVATE` datetime(0) NULL DEFAULT NULL,
  `Stud_DISPLAY_STATUS` enum('Active','Inactive') CHARACTER SET latin1 COLLATE latin1_swedish_ci NULL DEFAULT 'Active',
  PRIMARY KEY (`Stud_ID`) USING BTREE,
  UNIQUE INDEX `PK_Stud_NO`(`Stud_NO`) USING BTREE,
  INDEX `FK_COURSE`(`Stud_COURSE`) USING BTREE,
  CONSTRAINT `FK_COURSE` FOREIGN KEY (`Stud_COURSE`) REFERENCES `r_courses` (`Course_CODE`) ON DELETE CASCADE ON UPDATE CASCADE
) ENGINE = InnoDB AUTO_INCREMENT = 74 CHARACTER SET = latin1 COLLATE = latin1_swedish_ci ROW_FORMAT = Compact;

-- ----------------------------
-- Records of r_stud_profile
-- ----------------------------
INSERT INTO `r_stud_profile` VALUES (1, '2015-00138-CM-0', 'Oliver', NULL, 'Gabriel', 'Male', 'BSIT', 3, '1', '1998-11-16', '24-D4 Oliveros Drive Apolonio Samson Quezon City', 'Not Specify', 'Not Specify', 'Not Specify', 'Not Specify', 'Not Specify', 'Regular', '2018-05-21 14:11:00', '2018-05-21 14:11:00', NULL, 'Active');
INSERT INTO `r_stud_profile` VALUES (2, '2017-00056', 'jennifer', '', 'sanchez', 'Female', 'BSIT', 3, '1', '2015-11-11', 'Quezon City', 'Ilocos', '12479837', '98765432187', 'jen@gmail.com', 'Ilocos', 'Regular', '2018-05-24 18:03:12', '2018-05-24 18:03:12', NULL, 'Active');
INSERT INTO `r_stud_profile` VALUES (3, '2017-00057', 'Bryan ', '', 'Cortesiano', 'Female', 'BSIT', 3, '1', '2015-11-12', 'Commonwealth', 'Agusan', '12479837', '90453567245', 'bry@gmail.com', 'Agusan', 'Regular', '2018-05-24 18:03:12', '2018-05-24 18:03:12', NULL, 'Active');
INSERT INTO `r_stud_profile` VALUES (4, '2017-00058', 'Francheska', 'Nillo', 'Ronquillo', 'Female', 'BSIT', 3, '1', '2015-11-13', 'Caloocan', 'Zambales', '12479837', '98765423465', 'ches@gmail.com', 'Zambales', 'Regular', '2018-05-24 18:03:12', '2018-05-24 18:03:12', NULL, 'Active');
INSERT INTO `r_stud_profile` VALUES (5, '2017-00059', 'Lkier', '', 'FFT', 'Female', 'BSIT', 3, '1', '2015-11-14', 'Fairview', 'Nueva Ecija', '12479837', '92929292923', 'fft@gmail.com', 'Nueva Ecija', 'Regular', '2018-05-24 18:03:13', '2018-05-24 18:03:13', NULL, 'Active');
INSERT INTO `r_stud_profile` VALUES (6, '2017-00060', 'Gfoor', '', 'CSSS', 'Female', 'BSIT', 3, '1', '2015-11-15', 'Novaliches', 'Bataan', '12479837', '98765432187', 'csss@gmail.com', 'Bataan', 'Regular', '2018-05-24 18:03:13', '2018-05-24 18:03:13', NULL, 'Active');
INSERT INTO `r_stud_profile` VALUES (7, '2017-00061', 'BFeg', '', 'POPOP', 'Female', 'BSIT', 3, '1', '2015-11-16', 'Bulacan', 'Tarlac', '12479837', '90453567245', 'popop@gmail.com', 'Tarlac', 'Regular', '2018-05-24 18:03:13', '2018-05-24 18:03:13', NULL, 'Active');
INSERT INTO `r_stud_profile` VALUES (8, '2017-00062', 'Rhea', '', 'Rios', 'Female', 'BSIT', 3, '1', '2015-11-17', 'Navotas', 'Cabanatuan', '12479837', '98765423465', 'rhe@gmail.com', 'Cabanatuan', 'Regular', '2018-05-24 18:03:13', '2018-05-24 18:03:13', NULL, 'Active');
INSERT INTO `r_stud_profile` VALUES (9, '2017-00063', 'Jean', '', 'Ramos', 'Female', 'BSIT', 3, '1', '2015-11-18', 'Valenzuela', 'Baguio', '12479837', '92929292923', 'jea@gmail.com', 'Baguio', 'Regular', '2018-05-24 18:03:13', '2018-05-24 18:03:13', NULL, 'Active');
INSERT INTO `r_stud_profile` VALUES (10, '2017-00064', 'Melissa', '', 'Delos', 'Female', 'BSIT', 3, '1', '2015-11-19', 'Quezon City', 'Cebu', '12479837', '98765432187', 'mel@gmail.com', 'Cebu', 'Regular', '2018-05-24 18:03:14', '2018-05-24 18:03:14', NULL, 'Active');
INSERT INTO `r_stud_profile` VALUES (11, '2017-00065', 'Nikki', '', 'Castilo', 'Female', 'BSIT', 3, '1', '2015-11-20', 'Commonwealth', 'Samar', '12479837', '90453567245', 'nik@gmail.com', 'Samar', 'Regular', '2018-05-24 18:03:14', '2018-05-24 18:03:14', NULL, 'Active');
INSERT INTO `r_stud_profile` VALUES (12, '2017-00066', 'Mami', '', 'Alejandria', 'Female', 'BSIT', 3, '1', '2015-11-21', 'Caloocan', 'Leyte', '12479837', '98765423465', 'mam@gmail.com', 'Leyte', 'Regular', '2018-05-24 18:03:14', '2018-05-24 18:03:14', NULL, 'Active');
INSERT INTO `r_stud_profile` VALUES (13, '2017-0067', 'Jade', '', 'Ago', 'Female', 'BSIT', 3, '1', '2015-11-22', 'Fairview', 'Palawan', '12479837', '92929292923', 'jad@gmail.com', 'Palawan', 'Regular', '2018-05-24 18:03:14', '2018-05-24 18:03:14', NULL, 'Active');
INSERT INTO `r_stud_profile` VALUES (14, '2017-0068', 'Kate', '', 'De Jesus', 'Female', 'BSIT', 3, '1', '2015-10-01', 'Novaliches', 'Aklan', '12479837', '98765432187', 'de jesus@gfail.cof', 'Aklan', 'Regular', '2018-05-24 18:03:14', '2018-05-24 18:03:14', NULL, 'Active');
INSERT INTO `r_stud_profile` VALUES (15, '2017-0069', 'Andrea', '', 'Villajuan', 'Female', 'BSIT', 3, '1', '2015-10-02', 'Bulacan', 'Marinduque', '12479837', '90453567245', 'and@gmail.com', 'Marinduque', 'Regular', '2018-05-24 18:03:14', '2018-05-24 18:03:14', NULL, 'Active');
INSERT INTO `r_stud_profile` VALUES (16, '2017-0070', 'Teri', '', 'De Castro', 'Female', 'BSIT', 3, '1', '2015-10-03', 'Navotas', 'Ilocos', '12479837', '98765423465', 'de castro@gfail.cof', 'Navotas', 'Regular', '2018-05-24 18:03:14', '2018-05-24 18:03:14', NULL, 'Active');
INSERT INTO `r_stud_profile` VALUES (17, '2017-0071', 'Adrian', '', 'Geronilla', 'Female', 'BSIT', 3, '1', '2015-10-04', 'Valenzuela', 'Agusan', '12479837', '92929292923', 'adr@gmail.com', 'Valenzuela', 'Regular', '2018-05-24 18:03:14', '2018-05-24 18:03:14', NULL, 'Active');
INSERT INTO `r_stud_profile` VALUES (18, '2017-0072', 'Sharlyn', '', 'Lee', 'Female', 'BSIT', 3, '1', '2015-10-05', 'Quezon City', 'Zambales', '12479837', '98765432187', 'sha@gmail.com', 'Quezon City', 'Regular', '2018-05-24 18:03:14', '2018-05-24 18:03:14', NULL, 'Active');
INSERT INTO `r_stud_profile` VALUES (19, '2017-0073', 'Dave', '', 'Dogayo', 'Female', 'BSIT', 3, '1', '2015-10-06', 'Commonwealth', 'Nueva Ecija', '12479837', '90453567245', 'dav@gmail.com', 'Commonwealth', 'Regular', '2018-05-24 18:03:14', '2018-05-24 18:03:14', NULL, 'Active');
INSERT INTO `r_stud_profile` VALUES (20, '2017-0074', 'Edward', 'Rito', 'Alfante', 'Female', 'BSIT', 3, '1', '2015-10-07', 'Caloocan', 'Bataan', '12479837', '98765423465', 'edward@gmail.com', 'Caloocan', 'Regular', '2018-05-24 18:03:14', '2018-05-24 18:03:14', NULL, 'Active');
INSERT INTO `r_stud_profile` VALUES (21, '2017-0075', 'Christan', 'ocampo', 'Tan', 'Female', 'BSIT', 3, '1', '2015-10-08', 'Fairview', 'Tarlac', '12479837', '92929292923', 'stan@gmail.com', 'Fairview', 'Regular', '2018-05-24 18:03:14', '2018-05-24 18:03:14', NULL, 'Active');
INSERT INTO `r_stud_profile` VALUES (22, '2017-0076', 'John', 'Duran', 'Albis', 'Female', 'BSIT', 3, '1', '2015-10-09', 'Novaliches', 'Cabanatuan', '12479837', '98765432187', 'john@gmail.com', 'Novaliches', 'Regular', '2018-05-24 18:03:14', '2018-05-24 18:03:14', NULL, 'Active');
INSERT INTO `r_stud_profile` VALUES (23, '2017-0077', 'Luis', '', 'Lantape', 'Female', 'BSIT', 3, '1', '2015-10-10', 'Bulacan', 'Baguio', '12479837', '90453567245', 'lui@gmail.com', 'Bulacan', 'Regular', '2018-05-24 18:03:14', '2018-05-24 18:03:14', NULL, 'Active');
INSERT INTO `r_stud_profile` VALUES (24, '2017-0078', 'Romeo', '', 'Gonzales', 'Female', 'BSIT', 3, '1', '2015-10-11', 'Navotas', 'Cebu', '12479837', '98765423465', 'rom@gmail.com', 'Navotas', 'Regular', '2018-05-24 18:03:15', '2018-05-24 18:03:15', NULL, 'Active');
INSERT INTO `r_stud_profile` VALUES (25, '2017-0079', 'Vin', '', 'Dacuag', 'Female', 'BSIT', 3, '1', '2015-10-12', 'Valenzuela', 'Samar', '12479837', '92929292923', 'vin@gmail.com', 'Valenzuela', 'Regular', '2018-05-24 18:03:15', '2018-05-24 18:03:15', NULL, 'Active');
INSERT INTO `r_stud_profile` VALUES (26, '2017-0080', 'Lynne', '', 'Roque', 'Female', 'BSIT', 3, '1', '2015-10-13', 'Quezon City', 'Leyte', '12479837', '98765432187', 'lyn@gmail.com', 'Quezon City', 'Regular', '2018-05-24 18:03:15', '2018-05-24 18:03:15', NULL, 'Active');
INSERT INTO `r_stud_profile` VALUES (27, '2017-0081', 'Sam', '', 'Foley', 'Female', 'BSIT', 3, '1', '2015-10-14', 'Commonwealth', 'Palawan', '12479837', '90453567245', 'sam@gmail.com', 'Commonwealth', 'Regular', '2018-05-24 18:03:15', '2018-05-24 18:03:15', NULL, 'Active');
INSERT INTO `r_stud_profile` VALUES (28, '2017-0082', 'Hannah', '', 'Panaderya', 'Female', 'BSIT', 3, '1', '2015-10-15', 'Caloocan', 'Aklan', '12479837', '98765423465', 'han@gmail.com', 'Caloocan', 'Regular', '2018-05-24 18:03:15', '2018-05-24 18:03:15', NULL, 'Active');
INSERT INTO `r_stud_profile` VALUES (29, '2017-0083', 'Jessica', '', 'Jones', 'Female', 'BSIT', 3, '1', '2015-10-16', 'Fairview', 'Marinduque', '12479837', '92929292923', 'jes@gmail.com', 'Fairview', 'Regular', '2018-05-24 18:03:15', '2018-05-24 18:03:15', NULL, 'Active');
INSERT INTO `r_stud_profile` VALUES (30, '2017-0084', 'Ryan', '', 'Talledo', 'Female', 'BSIT', 3, '1', '2015-10-17', 'Novaliches', 'Ilocos', '12479837', '98765432187', 'rya@gmail.com', 'Novaliches', 'Regular', '2018-05-24 18:03:15', '2018-05-24 18:03:15', NULL, 'Active');
INSERT INTO `r_stud_profile` VALUES (31, '2017-0085', 'Jasmine', '', 'Flores', 'Female', 'BSIT', 3, '1', '2015-10-18', 'Bulacan', 'Agusan', '12479837', '90453567245', 'jas@gmail.com', 'Bulacan', 'Regular', '2018-05-24 18:03:15', '2018-05-24 18:03:15', NULL, 'Active');
INSERT INTO `r_stud_profile` VALUES (32, '2017-0086', 'Nikki', '', 'Arias', 'Female', 'BSIT', 3, '1', '2015-10-19', 'Navotas', 'Zambales', '12479837', '98765423465', 'nik@gmail.com', 'Navotas', 'Regular', '2018-05-24 18:03:15', '2018-05-24 18:03:15', NULL, 'Active');
INSERT INTO `r_stud_profile` VALUES (33, '2017-0087', 'Remmuel', 'Baniqued', 'Yapit', 'Female', 'BSIT', 3, '1', '2015-10-20', 'Valenzuela', 'Nueva Ecija', '12479837', '92929292923', 'u@gmail.com', 'Valenzuela', 'Regular', '2018-05-24 18:03:16', '2018-05-24 18:03:16', NULL, 'Active');
INSERT INTO `r_stud_profile` VALUES (34, '2017-0088', 'Rina', 'Villanueva', 'Ong', 'Female', 'BSIT', 3, '1', '2015-10-21', 'Quezon City', 'Bataan', '12479837', '98765432187', 'rina@gmail.com', 'Quezon City', 'Regular', '2018-05-24 18:03:16', '2018-05-24 18:03:16', NULL, 'Active');
INSERT INTO `r_stud_profile` VALUES (35, '2017-0089', 'Vallery', 'Santos', 'Melchor', 'Female', 'BSIT', 3, '1', '2015-10-22', 'Commonwealth', 'Tarlac', '12479837', '90453567245', 'e@gmail.com', 'Commonwealth', 'Regular', '2018-05-24 18:03:16', '2018-05-24 18:03:16', NULL, 'Active');
INSERT INTO `r_stud_profile` VALUES (36, '2017-0090', 'Patrick', 'Moon', 'Bituin', 'Female', 'BSIT', 3, '1', '2015-10-23', 'Caloocan', 'Cabanatuan', '12479837', '98765423465', 'i@gmail.com', 'Caloocan', 'Regular', '2018-05-24 18:03:16', '2018-05-24 18:03:16', NULL, 'Active');
INSERT INTO `r_stud_profile` VALUES (37, '2017-0091', 'Ina', 'Yan', 'Chan', 'Female', 'BSIT', 3, '1', '2015-10-24', 'Fairview', 'Baguio', '12479837', '92929292923', 'pat@gmail.com', 'Zambales', 'Regular', '2018-05-24 18:03:16', '2018-05-24 18:03:16', NULL, 'Active');
INSERT INTO `r_stud_profile` VALUES (38, '2017-0092', 'Princess', 'Galicia', 'Kane', 'Female', 'BSIT', 3, '1', '2015-10-25', 'Novaliches', 'Cebu', '12479837', '98765432187', 'cess@gmail.com', 'Nueva Ecija', 'Regular', '2018-05-24 18:03:16', '2018-05-24 18:03:16', NULL, 'Active');
INSERT INTO `r_stud_profile` VALUES (39, '2017-0093', 'Jasey', 'Flores', 'Rae', 'Female', 'BSIT', 3, '1', '2015-09-01', 'Bulacan', 'Samar', '12479837', '90453567245', 'jasey@gmail.com', 'Bataan', 'Regular', '2018-05-24 18:03:16', '2018-05-24 18:03:16', NULL, 'Active');
INSERT INTO `r_stud_profile` VALUES (40, '2017-0094', 'Nadine ', 'Marquez', 'Fabray', 'Female', 'BSIT', 3, '1', '2015-09-02', 'Navotas', 'Leyte', '12479837', '98765423465', 'nadz@gmail.com', 'Tarlac', 'Regular', '2018-05-24 18:03:16', '2018-05-24 18:03:16', NULL, 'Active');
INSERT INTO `r_stud_profile` VALUES (41, '2017-0095', 'Estella ', 'Dela Cruz', 'Baltimore', 'Female', 'BSIT', 3, '1', '2015-09-03', 'Valenzuela', 'Palawan', '12479837', '92929292923', 'estella@gmail.com', 'Cabanatuan', 'Regular', '2018-05-24 18:03:16', '2018-05-24 18:03:16', NULL, 'Active');
INSERT INTO `r_stud_profile` VALUES (42, '2017-0096', 'Jim', 'Oracion', 'Santos', 'Female', 'BSIT', 3, '1', '2015-09-04', 'Dela Costa', 'Aklan', '12479837', '98765432187', 'jiim@gmail.com', 'Baguio', 'Regular', '2018-05-24 18:03:16', '2018-05-24 18:03:16', NULL, 'Active');
INSERT INTO `r_stud_profile` VALUES (43, '2017-0097', 'Celine', 'Mallari', 'Balboa', 'Female', 'BSIT', 3, '1', '2015-09-05', 'Fairview', 'Marinduque', '12479837', '90453567245', 'celine@gmail.com', 'Cebu', 'Regular', '2018-05-24 18:03:16', '2018-05-24 18:03:16', NULL, 'Active');
INSERT INTO `r_stud_profile` VALUES (44, '2017-00156', 'Mayhem', '', 'Lim', 'Female', 'BSIT', 2, '1', '2015-09-06', 'Fairview', 'Marinduque', '12479837', '90453567245', 'mayhem@gmail.com', 'Samar', 'Regular', '2018-05-24 18:03:16', '2018-05-24 18:03:16', NULL, 'Active');
INSERT INTO `r_stud_profile` VALUES (45, '2017-00157', 'Teresita', '', 'Cortez', 'Female', 'BSIT', 2, '1', '2015-09-07', 'Novaliches', 'Ilocos', '12479837', '98765423465', 'teresita@gmail.com', 'Leyte', 'Regular', '2018-05-24 18:03:16', '2018-05-24 18:03:16', NULL, 'Active');
INSERT INTO `r_stud_profile` VALUES (46, '2017-00158', 'Melba', '', 'Venga', 'Female', 'BSIT', 2, '1', '2015-09-08', 'Bulacan', 'Agusan', '12479837', '92929292923', 'melba@gmail.com', 'Valenzuela', 'Regular', '2018-05-24 18:03:16', '2018-05-24 18:03:16', NULL, 'Active');
INSERT INTO `r_stud_profile` VALUES (47, '2017-00159', 'Cynthia', '', 'Bolzinco', 'Female', 'BSIT', 2, '1', '2015-09-09', 'Navotas', 'Zambales', '12479837', '98765432187', 'cynthia@gmail.com', 'Quezon City', 'Regular', '2018-05-24 18:03:16', '2018-05-24 18:03:16', NULL, 'Active');
INSERT INTO `r_stud_profile` VALUES (48, '2017-00160', 'Celia', '', 'Perez', 'Female', 'BSIT', 2, '1', '2015-09-10', 'Valenzuela', 'Nueva Ecija', '12479837', '90453567245', 'celia@gmail.com', 'Commonwealth', 'Regular', '2018-05-24 18:03:16', '2018-05-24 18:03:16', NULL, 'Active');
INSERT INTO `r_stud_profile` VALUES (49, '2017-00161', 'Francisco', '', 'Mendez', 'Female', 'BSIT', 2, '1', '2015-09-11', 'Quezon City', 'Bataan', '12479837', '98765423465', 'francisco@gmail.com', 'Caloocan', 'Regular', '2018-05-24 18:03:16', '2018-05-24 18:03:16', NULL, 'Active');
INSERT INTO `r_stud_profile` VALUES (50, '2017-00162', 'Jeremiah', '', 'Rollo', 'Female', 'BSIT', 2, '1', '2015-09-12', 'Commonwealth', 'Tarlac', '12479837', '92929292923', 'jeremiah@gmail.com', 'Fairview', 'Regular', '2018-05-24 18:03:16', '2018-05-24 18:03:16', NULL, 'Active');
INSERT INTO `r_stud_profile` VALUES (51, '2017-00163', 'John Michael', '', 'Roque', 'Female', 'BSIT', 2, '1', '2015-09-13', 'Caloocan', 'Cabanatuan', '12479837', '98765432187', 'john michael@gmail.com', 'Novaliches', 'Regular', '2018-05-24 18:03:16', '2018-05-24 18:03:16', NULL, 'Active');
INSERT INTO `r_stud_profile` VALUES (52, '2017-00164', 'Michael', '', 'Delima', 'Female', 'BSIT', 2, '1', '2015-09-14', 'Fairview', 'Baguio', '12479837', '90453567245', 'michael@gmail.com', 'Bulacan', 'Regular', '2018-05-24 18:03:16', '2018-05-24 18:03:16', NULL, 'Active');
INSERT INTO `r_stud_profile` VALUES (53, '2017-00165', 'Francis', '', 'Makalintal', 'Female', 'BSIT', 2, '1', '2015-09-15', 'Novaliches', 'Cebu', '12479837', '98765423465', 'francis@gmail.com', 'Navotas', 'Regular', '2018-05-24 18:03:16', '2018-05-24 18:03:16', NULL, 'Active');
INSERT INTO `r_stud_profile` VALUES (54, '2017-00166', 'Joanne', '', 'Dimagiba', 'Female', 'BSIT', 2, '1', '2015-09-16', 'Bulacan', 'Samar', '12479837', '92929292923', 'joanne@gmail.com', 'Cebu', 'Regular', '2018-05-24 18:03:16', '2018-05-24 18:03:16', NULL, 'Active');
INSERT INTO `r_stud_profile` VALUES (55, '2017-00145', 'Noel', '', 'Bulos', 'Female', 'BSIT', 2, '1', '2015-09-17', 'Navotas', 'Leyte', '12479837', '98765432187', 'noel@gmail.com', 'Samar', 'Regular', '2018-05-24 18:03:16', '2018-05-24 18:03:16', NULL, 'Active');
INSERT INTO `r_stud_profile` VALUES (56, '2017-00169', 'Joselito', '', 'Dimal', 'Female', 'BSIT', 2, '1', '2015-09-18', 'Valenzuela', 'Palawan', '12479837', '90453567245', 'joselito@gmail.com', 'Leyte', 'Regular', '2018-05-24 18:03:17', '2018-05-24 18:03:17', NULL, 'Active');
INSERT INTO `r_stud_profile` VALUES (57, '2017-00171', 'Robert', '', 'Zorco', 'Female', 'BSIT', 2, '1', '2015-09-19', 'Dela Costa', 'Aklan', '12234567', '98765432187', 'robert@gmail.com', 'Palawan', 'Regular', '2018-05-24 18:03:17', '2018-05-24 18:03:17', NULL, 'Active');
INSERT INTO `r_stud_profile` VALUES (58, '2017-00140', 'Bianca', '', 'Ezra', 'Female', 'BSIT', 2, '1', '2015-09-20', 'Fairview', 'Marinduque', '12345678', '90453567245', 'bianca@gmail.com', 'Aklan', 'Regular', '2018-05-24 18:03:17', '2018-05-24 18:03:17', NULL, 'Active');
INSERT INTO `r_stud_profile` VALUES (59, '2017-00256', 'Donna', '', 'Pelo', 'Female', 'BSIT', 1, '1', '2015-09-21', 'Quezon City', 'Ilocos', '12479837', '98765432187', 'donna@gmail.com', 'Ilocos', 'Regular', '2018-05-24 18:03:17', '2018-05-24 18:03:17', NULL, 'Active');
INSERT INTO `r_stud_profile` VALUES (60, '2017-00257', 'Brian', '', 'Ortiz', 'Female', 'BSIT', 1, '1', '2015-09-22', 'Commonwealth', 'Agusan', '12479837', '90453567245', 'brian@gmail.com', 'Agusan', 'Regular', '2018-05-24 18:03:17', '2018-05-24 18:03:17', NULL, 'Active');
INSERT INTO `r_stud_profile` VALUES (61, '2017-00258', 'Bianca', '', 'Yeti', 'Female', 'BSIT', 1, '1', '2015-09-23', 'Caloocan', 'Zambales', '12479837', '98765423465', 'bianca@gmail.com', 'Zambales', 'Regular', '2018-05-24 18:03:17', '2018-05-24 18:03:17', NULL, 'Active');
INSERT INTO `r_stud_profile` VALUES (62, '2017-00259', 'Gino', '', 'Heusaff', 'Female', 'BSIT', 1, '1', '2015-09-24', 'Fairview', 'Nueva Ecija', '12479837', '92929292923', 'gino@gmail.com', 'Nueva Ecija', 'Regular', '2018-05-24 18:03:17', '2018-05-24 18:03:17', NULL, 'Active');
INSERT INTO `r_stud_profile` VALUES (63, '2017-00260', 'Selena', '', 'Ayres', 'Female', 'BSIT', 1, '1', '2015-09-25', 'Novaliches', 'Bataan', '12479837', '98765432187', 'selena@gmail.com', 'Bataan', 'Regular', '2018-05-24 18:03:17', '2018-05-24 18:03:17', NULL, 'Active');
INSERT INTO `r_stud_profile` VALUES (64, '2017-00261', 'Joroz', '', 'Abott', 'Female', 'BSIT', 1, '1', '2015-09-26', 'Bulacan', 'Tarlac', '12479837', '90453567245', 'joroz@gmail.com', 'Tarlac', 'Regular', '2018-05-24 18:03:17', '2018-05-24 18:03:17', NULL, 'Active');
INSERT INTO `r_stud_profile` VALUES (65, '2017-00262', 'Alexandra', '', 'Myers', 'Female', 'BSIT', 1, '1', '2015-07-12', 'Navotas', 'Cabanatuan', '12479837', '98765423465', 'alexandra@gmail.com', 'Cabanatuan', 'Regular', '2018-05-24 18:03:17', '2018-05-24 18:03:17', NULL, 'Active');
INSERT INTO `r_stud_profile` VALUES (66, '2017-00263', 'Christian', '', 'Dimatulac', 'Female', 'BSIT', 1, '1', '2015-07-13', 'Valenzuela', 'Baguio', '12479837', '92929292923', 'christian@gmail.com', 'Baguio', 'Regular', '2018-05-24 18:03:17', '2018-05-24 18:03:17', NULL, 'Active');
INSERT INTO `r_stud_profile` VALUES (67, '2017-00264', 'Christene', '', 'Maykapa', 'Female', 'BSIT', 1, '1', '2015-07-14', 'Quezon City', 'Cebu', '12479837', '98765432187', 'christene@gmail.com', 'Cebu', 'Regular', '2018-05-24 18:03:17', '2018-05-24 18:03:17', NULL, 'Active');
INSERT INTO `r_stud_profile` VALUES (68, '2017-00265', 'Polo', '', 'Woods', 'Female', 'BSIT', 1, '1', '2015-07-15', 'Commonwealth', 'Samar', '12479837', '90453567245', 'polo@gmail.com', 'Samar', 'Regular', '2018-05-24 18:03:17', '2018-05-24 18:03:17', NULL, 'Active');
INSERT INTO `r_stud_profile` VALUES (69, '2017-00266', 'Lara', '', 'Agbayani', 'Female', 'BSIT', 1, '1', '2015-07-16', 'Caloocan', 'Leyte', '12479837', '98765423465', 'lara@gmail.com', 'Leyte', 'Regular', '2018-05-24 18:03:17', '2018-05-24 18:03:17', NULL, 'Active');
INSERT INTO `r_stud_profile` VALUES (70, '2017-00245', 'Cholo', '', 'Abuang', 'Female', 'BSIT', 1, '1', '2015-07-17', 'Fairview', 'Palawan', '12479837', '92929292923', 'cholo@gmail.com', 'Palawan', 'Regular', '2018-05-24 18:03:17', '2018-05-24 18:03:17', NULL, 'Active');
INSERT INTO `r_stud_profile` VALUES (71, '2017-00269', 'Venice', '', 'Bocasan', 'Female', 'BSIT', 1, '1', '2015-07-18', 'Novaliches', 'Aklan', '12479837', '98765432187', 'venice@gmail.com', 'Aklan', 'Regular', '2018-05-24 18:03:17', '2018-05-24 18:03:17', NULL, 'Active');
INSERT INTO `r_stud_profile` VALUES (72, '2017-00271', 'Xavier', '', 'Guipit', 'Female', 'BSIT', 1, '1', '2015-07-19', 'Bulacan', 'Marinduque', '12479837', '90453567245', 'xavier@gmail.com', 'Marinduque', 'Regular', '2018-05-24 18:03:17', '2018-05-24 18:03:17', NULL, 'Active');
INSERT INTO `r_stud_profile` VALUES (73, '2017-00240', 'Zara', '', 'Sawit', 'Female', 'BSIT', 1, '1', '2015-07-20', 'Navotas', 'Ilocos', '12479837', '98765423465', 'zara@gmail.com', 'Navotas', 'Regular', '2018-05-24 18:03:17', '2018-05-24 18:03:17', NULL, 'Active');

-- ----------------------------
-- Table structure for r_stud_psych_rec
-- ----------------------------
DROP TABLE IF EXISTS `r_stud_psych_rec`;
CREATE TABLE `r_stud_psych_rec`  (
  `Stud_NO_REFERENCE` varchar(15) CHARACTER SET latin1 COLLATE latin1_swedish_ci NOT NULL,
  `PsychRec_PREV_CONSULTED` enum('Psychiatrist','Psychologist','Counselor') CHARACTER SET latin1 COLLATE latin1_swedish_ci NOT NULL,
  `PsychRec_CONSULTED_WHEN` varchar(1000) CHARACTER SET latin1 COLLATE latin1_swedish_ci NULL DEFAULT 'None',
  `PsychRec_REASON` varchar(1000) CHARACTER SET latin1 COLLATE latin1_swedish_ci NULL DEFAULT 'None',
  INDEX `FK_psychrc_STUD_NO`(`Stud_NO_REFERENCE`) USING BTREE,
  CONSTRAINT `FK_psychrc_STUD_NO` FOREIGN KEY (`Stud_NO_REFERENCE`) REFERENCES `r_stud_profile` (`Stud_NO`) ON DELETE CASCADE ON UPDATE CASCADE
) ENGINE = InnoDB CHARACTER SET = latin1 COLLATE = latin1_swedish_ci ROW_FORMAT = Compact;

-- ----------------------------
-- Table structure for r_system_config
-- ----------------------------
DROP TABLE IF EXISTS `r_system_config`;
CREATE TABLE `r_system_config`  (
  `SysConfig_ID` int(11) NOT NULL AUTO_INCREMENT,
  `SysConfig_NAME` varchar(100) CHARACTER SET latin1 COLLATE latin1_swedish_ci NOT NULL,
  `SysConfig_PROPERTIES` varchar(100) CHARACTER SET latin1 COLLATE latin1_swedish_ci NOT NULL,
  `SysConfig_DATE_ADD` timestamp(0) NOT NULL DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP(0),
  `SysConfig_DATE_MOD` datetime(0) NULL DEFAULT NULL,
  `SysConfig_DISPLAY_STAT` enum('Active','Inactive') CHARACTER SET latin1 COLLATE latin1_swedish_ci NOT NULL DEFAULT 'Active',
  PRIMARY KEY (`SysConfig_ID`) USING BTREE
) ENGINE = InnoDB AUTO_INCREMENT = 2 CHARACTER SET = latin1 COLLATE = latin1_swedish_ci ROW_FORMAT = Compact;

-- ----------------------------
-- Records of r_system_config
-- ----------------------------
INSERT INTO `r_system_config` VALUES (1, 'DisposalDays', '10', '2018-05-21 07:47:57', NULL, 'Active');

-- ----------------------------
-- Table structure for r_upload_category
-- ----------------------------
DROP TABLE IF EXISTS `r_upload_category`;
CREATE TABLE `r_upload_category`  (
  `Upload_CATEGORY_ID` int(11) NOT NULL AUTO_INCREMENT,
  `Upload_FILE_CATEGORY` varchar(100) CHARACTER SET latin1 COLLATE latin1_swedish_ci NOT NULL,
  `Upload_CATEGORY_STAT` enum('Active','Inactive') CHARACTER SET latin1 COLLATE latin1_swedish_ci NULL DEFAULT 'Active',
  PRIMARY KEY (`Upload_CATEGORY_ID`) USING BTREE,
  UNIQUE INDEX `Upload_FILE_CATEGORY`(`Upload_FILE_CATEGORY`) USING BTREE
) ENGINE = InnoDB AUTO_INCREMENT = 2 CHARACTER SET = latin1 COLLATE = latin1_swedish_ci ROW_FORMAT = Compact;

-- ----------------------------
-- Records of r_upload_category
-- ----------------------------
INSERT INTO `r_upload_category` VALUES (1, 'Excuse Letter', 'Active');

-- ----------------------------
-- Table structure for r_users
-- ----------------------------
DROP TABLE IF EXISTS `r_users`;
CREATE TABLE `r_users`  (
  `Users_ID` int(11) NOT NULL AUTO_INCREMENT,
  `Users_USERNAME` varchar(50) CHARACTER SET latin1 COLLATE latin1_swedish_ci NOT NULL,
  `Users_REFERENCED` varchar(15) CHARACTER SET latin1 COLLATE latin1_swedish_ci NOT NULL,
  `Users_PASSWORD` blob NOT NULL,
  `Users_ROLES` enum('Administrator','OSAS HEAD','Organization','Student','Staff','Student Assistat') CHARACTER SET latin1 COLLATE latin1_swedish_ci NOT NULL,
  `Users_PROFILE_PATH` varchar(500) CHARACTER SET latin1 COLLATE latin1_swedish_ci NULL DEFAULT NULL,
  `Users_DATE_ADD` datetime(0) NOT NULL DEFAULT CURRENT_TIMESTAMP,
  `Users_DATE_MOD` datetime(0) NOT NULL DEFAULT CURRENT_TIMESTAMP,
  `Users_DISPLAY_STAT` enum('Active','Inactive') CHARACTER SET latin1 COLLATE latin1_swedish_ci NULL DEFAULT 'Active',
  PRIMARY KEY (`Users_ID`) USING BTREE,
  UNIQUE INDEX `UNQ_Users_USERNAME`(`Users_USERNAME`) USING BTREE
) ENGINE = InnoDB AUTO_INCREMENT = 18 CHARACTER SET = latin1 COLLATE = latin1_swedish_ci ROW_FORMAT = Compact;

-- ----------------------------
-- Records of r_users
-- ----------------------------
INSERT INTO `r_users` VALUES (14, 'Demelyn', '2018-OSAS-CM', 0x852FA0A245A1467FCFD3E79A8C1BB0C9, 'OSAS HEAD', NULL, '2018-05-20 23:49:40', '2018-05-20 23:49:40', 'Active');
INSERT INTO `r_users` VALUES (15, 'admin', 'admin', 0x4D8EAB5029A8C36FE1BF1C3F13405F73, 'Administrator', NULL, '2018-05-20 23:51:59', '2018-05-20 23:51:59', 'Active');
INSERT INTO `r_users` VALUES (16, 'staff', '-1', 0xC025BDDA58E2790A32D70E58B3F5F148, 'Staff', NULL, '2018-05-21 00:01:12', '2018-05-21 00:01:12', 'Active');
INSERT INTO `r_users` VALUES (17, 'CITS2019', 'CITS2019', 0xFEFB12FA6206F5695691C396467CD6A1, 'Organization', NULL, '2018-05-23 12:44:31', '2018-05-23 12:44:31', 'Active');

-- ----------------------------
-- Table structure for r_visit
-- ----------------------------
DROP TABLE IF EXISTS `r_visit`;
CREATE TABLE `r_visit`  (
  `Visit_ID` int(11) NOT NULL AUTO_INCREMENT,
  `Visit_TYPE` varchar(50) CHARACTER SET latin1 COLLATE latin1_swedish_ci NOT NULL,
  `Visit_DESC` text CHARACTER SET latin1 COLLATE latin1_swedish_ci NULL,
  `Visit_TYPE_STAT` enum('Active','Inactive') CHARACTER SET latin1 COLLATE latin1_swedish_ci NULL DEFAULT 'Active',
  PRIMARY KEY (`Visit_ID`) USING BTREE,
  UNIQUE INDEX `Visit_TYPE`(`Visit_TYPE`) USING BTREE
) ENGINE = InnoDB AUTO_INCREMENT = 8 CHARACTER SET = latin1 COLLATE = latin1_swedish_ci ROW_FORMAT = Compact;

-- ----------------------------
-- Records of r_visit
-- ----------------------------
INSERT INTO `r_visit` VALUES (1, 'Signing of Clearance', NULL, 'Active');
INSERT INTO `r_visit` VALUES (3, 'Certificate of Candidacy', NULL, 'Active');
INSERT INTO `r_visit` VALUES (4, 'Excuse Letter', NULL, 'Active');
INSERT INTO `r_visit` VALUES (7, 'Counseling', '', 'Active');

-- ----------------------------
-- Table structure for t_assign_org_academic_course
-- ----------------------------
DROP TABLE IF EXISTS `t_assign_org_academic_course`;
CREATE TABLE `t_assign_org_academic_course`  (
  `AssOrgAcademic_ID` int(11) NOT NULL AUTO_INCREMENT,
  `AssOrgAcademic_ORG_CODE` varchar(15) CHARACTER SET latin1 COLLATE latin1_swedish_ci NOT NULL,
  `AssOrgAcademic_COURSE_CODE` varchar(15) CHARACTER SET latin1 COLLATE latin1_swedish_ci NOT NULL,
  `AssOrgAcademic_DATE_ADD` datetime(0) NOT NULL DEFAULT CURRENT_TIMESTAMP,
  `AssOrgAcademic_DATE_MOD` datetime(0) NOT NULL DEFAULT CURRENT_TIMESTAMP,
  `AssOrgAcademic_DISPLAY_STAT` enum('Active','Inactive') CHARACTER SET latin1 COLLATE latin1_swedish_ci NULL DEFAULT 'Active',
  PRIMARY KEY (`AssOrgAcademic_ORG_CODE`, `AssOrgAcademic_COURSE_CODE`) USING BTREE,
  UNIQUE INDEX `UNQ_AssOrgAcademic_ID`(`AssOrgAcademic_ID`) USING BTREE,
  INDEX `FK_AssOrgAcademic_COURSE_CODE`(`AssOrgAcademic_COURSE_CODE`) USING BTREE,
  CONSTRAINT `FK_AssOrgAcademic_COURSE_CODE` FOREIGN KEY (`AssOrgAcademic_COURSE_CODE`) REFERENCES `r_courses` (`Course_CODE`) ON DELETE CASCADE ON UPDATE CASCADE,
  CONSTRAINT `FK_AssOrgAcademic_ORG_CODE` FOREIGN KEY (`AssOrgAcademic_ORG_CODE`) REFERENCES `t_org_for_compliance` (`OrgForCompliance_ORG_CODE`) ON DELETE CASCADE ON UPDATE CASCADE
) ENGINE = InnoDB AUTO_INCREMENT = 2 CHARACTER SET = latin1 COLLATE = latin1_swedish_ci ROW_FORMAT = Compact;

-- ----------------------------
-- Records of t_assign_org_academic_course
-- ----------------------------
INSERT INTO `t_assign_org_academic_course` VALUES (1, 'CITS2019', 'BSIT-CM', '2018-05-23 12:44:13', '2018-05-23 12:44:13', 'Active');

-- ----------------------------
-- Table structure for t_assign_org_category
-- ----------------------------
DROP TABLE IF EXISTS `t_assign_org_category`;
CREATE TABLE `t_assign_org_category`  (
  `AssOrgCategory_ID` int(11) NOT NULL AUTO_INCREMENT,
  `AssOrgCategory_ORG_CODE` varchar(15) CHARACTER SET latin1 COLLATE latin1_swedish_ci NOT NULL,
  `AssOrgCategory_ORGCAT_CODE` varchar(15) CHARACTER SET latin1 COLLATE latin1_swedish_ci NOT NULL,
  `AssOrgCategory_DATE_ADD` datetime(0) NOT NULL DEFAULT CURRENT_TIMESTAMP,
  `AssOrgCategory_DATE_MOD` datetime(0) NOT NULL DEFAULT CURRENT_TIMESTAMP,
  `AssOrgCategory_DISPLAY_STAT` enum('Active','Inactive') CHARACTER SET latin1 COLLATE latin1_swedish_ci NULL DEFAULT 'Active',
  PRIMARY KEY (`AssOrgCategory_ORG_CODE`, `AssOrgCategory_ORGCAT_CODE`) USING BTREE,
  UNIQUE INDEX `UNQ_AssOrgCategory_ID`(`AssOrgCategory_ID`) USING BTREE,
  INDEX `FK_AssOrgCategory_ORGCAT_CODE`(`AssOrgCategory_ORGCAT_CODE`) USING BTREE,
  CONSTRAINT `FK_AssOrgCategory_ORGCAT_CODE` FOREIGN KEY (`AssOrgCategory_ORGCAT_CODE`) REFERENCES `r_org_category` (`OrgCat_CODE`) ON DELETE CASCADE ON UPDATE CASCADE,
  CONSTRAINT `FK_AssOrgCategory_ORG_CODE` FOREIGN KEY (`AssOrgCategory_ORG_CODE`) REFERENCES `t_org_for_compliance` (`OrgForCompliance_ORG_CODE`) ON DELETE CASCADE ON UPDATE CASCADE
) ENGINE = InnoDB AUTO_INCREMENT = 2 CHARACTER SET = latin1 COLLATE = latin1_swedish_ci ROW_FORMAT = Compact;

-- ----------------------------
-- Records of t_assign_org_category
-- ----------------------------
INSERT INTO `t_assign_org_category` VALUES (1, 'CITS2019', 'ACAD_ORG', '2018-05-23 12:44:12', '2018-05-23 12:44:12', 'Active');

-- ----------------------------
-- Table structure for t_assign_org_members
-- ----------------------------
DROP TABLE IF EXISTS `t_assign_org_members`;
CREATE TABLE `t_assign_org_members`  (
  `AssOrgMem_ID` int(11) NOT NULL AUTO_INCREMENT,
  `AssOrgMem_STUD_NO` varchar(15) CHARACTER SET latin1 COLLATE latin1_swedish_ci NOT NULL,
  `AssOrgMem_COMPL_ORG_CODE` varchar(15) CHARACTER SET latin1 COLLATE latin1_swedish_ci NOT NULL,
  `AssOrgMem_DATE_ADD` datetime(0) NOT NULL DEFAULT CURRENT_TIMESTAMP,
  `AssOrgMem_DATE_MOD` datetime(0) NULL DEFAULT NULL,
  `AssOrgMem_DISPLAY_STAT` enum('Active','Inactive') CHARACTER SET latin1 COLLATE latin1_swedish_ci NOT NULL DEFAULT 'Active',
  PRIMARY KEY (`AssOrgMem_STUD_NO`, `AssOrgMem_COMPL_ORG_CODE`) USING BTREE,
  UNIQUE INDEX `UNQ_AssOrgMem_ID`(`AssOrgMem_ID`) USING BTREE,
  INDEX `FK_AssOrgMem_COMPL_ORG_CODE`(`AssOrgMem_COMPL_ORG_CODE`) USING BTREE,
  CONSTRAINT `FK_AssOrgMem_COMPL_ORG_CODE` FOREIGN KEY (`AssOrgMem_COMPL_ORG_CODE`) REFERENCES `t_org_for_compliance` (`OrgForCompliance_ORG_CODE`) ON DELETE CASCADE ON UPDATE CASCADE,
  CONSTRAINT `FK_AssOrgMem_STUD_NO` FOREIGN KEY (`AssOrgMem_STUD_NO`) REFERENCES `r_stud_profile` (`Stud_NO`) ON DELETE CASCADE ON UPDATE CASCADE
) ENGINE = InnoDB AUTO_INCREMENT = 8 CHARACTER SET = latin1 COLLATE = latin1_swedish_ci ROW_FORMAT = Compact;

-- ----------------------------
-- Records of t_assign_org_members
-- ----------------------------
INSERT INTO `t_assign_org_members` VALUES (5, '2010-00410-CM-0', 'CITS2019', '2018-05-23 12:45:14', NULL, 'Active');
INSERT INTO `t_assign_org_members` VALUES (4, '2011-00075-CM-0', 'CITS2019', '2018-05-23 12:45:14', NULL, 'Active');
INSERT INTO `t_assign_org_members` VALUES (1, '2012-00075-CM-0', 'CITS2019', '2018-05-23 12:45:12', NULL, 'Active');
INSERT INTO `t_assign_org_members` VALUES (3, '2015-00046-CM-0', 'CITS2019', '2018-05-23 12:45:13', NULL, 'Active');
INSERT INTO `t_assign_org_members` VALUES (2, '2016-00410-CM-0', 'CITS2019', '2018-05-23 12:45:13', NULL, 'Active');
INSERT INTO `t_assign_org_members` VALUES (6, '2020-00410-CM-0', 'CITS2019', '2018-05-23 12:45:14', NULL, 'Active');
INSERT INTO `t_assign_org_members` VALUES (7, '2032-00410-CM-0', 'CITS2019', '2018-05-23 12:45:14', NULL, 'Active');

-- ----------------------------
-- Table structure for t_assign_org_non_academic
-- ----------------------------
DROP TABLE IF EXISTS `t_assign_org_non_academic`;
CREATE TABLE `t_assign_org_non_academic`  (
  `AssOrgNonAcademic_ID` int(11) NOT NULL AUTO_INCREMENT,
  `AssOrgNonAcademic_ORG_CODE` varchar(15) CHARACTER SET latin1 COLLATE latin1_swedish_ci NOT NULL,
  `AssOrgNonAcademic_NON_ACAD` varchar(15) CHARACTER SET latin1 COLLATE latin1_swedish_ci NOT NULL,
  `AssOrgNonAcademic_DATE_ADD` datetime(0) NOT NULL DEFAULT CURRENT_TIMESTAMP,
  `AssOrgNonAcademic_DATE_MOD` datetime(0) NOT NULL DEFAULT CURRENT_TIMESTAMP,
  `AssOrgNonAcademic_DISPLAY_STAT` enum('Active','Inactive') CHARACTER SET latin1 COLLATE latin1_swedish_ci NOT NULL DEFAULT 'Active',
  PRIMARY KEY (`AssOrgNonAcademic_ORG_CODE`) USING BTREE,
  UNIQUE INDEX `UNQ_AssOrgNonAcademic_ID`(`AssOrgNonAcademic_ID`) USING BTREE,
  INDEX `FK_AssOrgNonAcademic_NON_ACAD`(`AssOrgNonAcademic_NON_ACAD`) USING BTREE,
  CONSTRAINT `FK_AssOrgNonAcademic_NON_ACAD` FOREIGN KEY (`AssOrgNonAcademic_NON_ACAD`) REFERENCES `r_org_non_academic_details` (`OrgNonAcad_CODE`) ON DELETE CASCADE ON UPDATE CASCADE,
  CONSTRAINT `FK_AssOrgNonAcademic_ORG_CODE` FOREIGN KEY (`AssOrgNonAcademic_ORG_CODE`) REFERENCES `t_org_for_compliance` (`OrgForCompliance_ORG_CODE`) ON DELETE CASCADE ON UPDATE CASCADE
) ENGINE = InnoDB AUTO_INCREMENT = 1 CHARACTER SET = latin1 COLLATE = latin1_swedish_ci ROW_FORMAT = Compact;

-- ----------------------------
-- Table structure for t_assign_org_sanction
-- ----------------------------
DROP TABLE IF EXISTS `t_assign_org_sanction`;
CREATE TABLE `t_assign_org_sanction`  (
  `AssSancOrgStudent_ID` int(11) NOT NULL AUTO_INCREMENT,
  `AssSancOrgStudent_REG_ORG` varchar(15) CHARACTER SET latin1 COLLATE latin1_swedish_ci NOT NULL,
  `AssSancOrgStudent_SancDetails_CODE` varchar(15) CHARACTER SET latin1 COLLATE latin1_swedish_ci NOT NULL,
  `AssSancOrgStudent_REMARKS` varchar(15) CHARACTER SET latin1 COLLATE latin1_swedish_ci NOT NULL,
  `AssSancOrgStudent_DATE_ADD` datetime(0) NOT NULL DEFAULT CURRENT_TIMESTAMP,
  `AssSancOrgStudent_DATE_MOD` datetime(0) NOT NULL DEFAULT CURRENT_TIMESTAMP,
  `AssSancOrgStudent_DISPLAY_STAT` enum('Active','Inactive') CHARACTER SET latin1 COLLATE latin1_swedish_ci NULL DEFAULT 'Active',
  PRIMARY KEY (`AssSancOrgStudent_ID`) USING BTREE,
  INDEX `FK_AssSancOrgStudent_STUD_NO`(`AssSancOrgStudent_REG_ORG`) USING BTREE,
  INDEX `FK_AssSancOrgStudent_SancDetails_CODE`(`AssSancOrgStudent_SancDetails_CODE`) USING BTREE,
  CONSTRAINT `FK_AssSancOrgStudent_STUD_NO` FOREIGN KEY (`AssSancOrgStudent_REG_ORG`) REFERENCES `t_org_for_compliance` (`OrgForCompliance_ORG_CODE`) ON DELETE CASCADE ON UPDATE CASCADE,
  CONSTRAINT `FK_AssSancOrgStudent_SancDetails_CODE` FOREIGN KEY (`AssSancOrgStudent_SancDetails_CODE`) REFERENCES `r_sanction_details` (`SancDetails_CODE`) ON DELETE CASCADE ON UPDATE CASCADE
) ENGINE = InnoDB AUTO_INCREMENT = 1 CHARACTER SET = latin1 COLLATE = latin1_swedish_ci ROW_FORMAT = Compact;

-- ----------------------------
-- Table structure for t_assign_stud_finan_assistance
-- ----------------------------
DROP TABLE IF EXISTS `t_assign_stud_finan_assistance`;
CREATE TABLE `t_assign_stud_finan_assistance`  (
  `AssStudFinanAssistance_ID` int(11) NOT NULL AUTO_INCREMENT,
  `AssStudFinanAssistance_STUD_NO` varchar(15) CHARACTER SET latin1 COLLATE latin1_swedish_ci NOT NULL,
  `AssStudFinanAssistance_FINAN_NAME` varchar(100) CHARACTER SET latin1 COLLATE latin1_swedish_ci NOT NULL,
  `AssStudFinanAssistance_STATUS` enum('Active','Inactive','Void','Cancelled') CHARACTER SET latin1 COLLATE latin1_swedish_ci NOT NULL DEFAULT 'Active',
  `AssStudFinanAssistance_REMARKS` varchar(500) CHARACTER SET latin1 COLLATE latin1_swedish_ci NOT NULL DEFAULT 'Remarks',
  `AssStudFinanAssistance_DATE_ADD` datetime(0) NOT NULL DEFAULT CURRENT_TIMESTAMP,
  `AssStudFinanAssistance_DATE_MOD` datetime(0) NOT NULL DEFAULT CURRENT_TIMESTAMP,
  `AssStudFinanAssistance_DISPLAY_STAT` enum('Active','Inactive') CHARACTER SET latin1 COLLATE latin1_swedish_ci NULL DEFAULT 'Active',
  PRIMARY KEY (`AssStudFinanAssistance_STUD_NO`, `AssStudFinanAssistance_FINAN_NAME`) USING BTREE,
  UNIQUE INDEX `UNQ_AssStudFinanAssistance_ID`(`AssStudFinanAssistance_ID`) USING BTREE,
  INDEX `FK_AssStudFinanAssistance_FINAN_NAME`(`AssStudFinanAssistance_FINAN_NAME`) USING BTREE,
  CONSTRAINT `FK_AssStudFinanAssistance_FINAN_NAME` FOREIGN KEY (`AssStudFinanAssistance_FINAN_NAME`) REFERENCES `r_financial_assistance_title` (`FinAssiTitle_NAME`) ON DELETE CASCADE ON UPDATE CASCADE,
  CONSTRAINT `FK_AssStudFinanAssistance_STUD_NO` FOREIGN KEY (`AssStudFinanAssistance_STUD_NO`) REFERENCES `r_stud_profile` (`Stud_NO`) ON DELETE CASCADE ON UPDATE CASCADE
) ENGINE = InnoDB AUTO_INCREMENT = 1 CHARACTER SET = latin1 COLLATE = latin1_swedish_ci ROW_FORMAT = Compact;

-- ----------------------------
-- Table structure for t_assign_stud_loss_id_regicard
-- ----------------------------
DROP TABLE IF EXISTS `t_assign_stud_loss_id_regicard`;
CREATE TABLE `t_assign_stud_loss_id_regicard`  (
  `AssLoss_ID` int(11) NOT NULL AUTO_INCREMENT,
  `AssLoss_STUD_NO` varchar(15) CHARACTER SET latin1 COLLATE latin1_swedish_ci NOT NULL,
  `AssLoss_TYPE` enum('Identification Card','Registration Card') CHARACTER SET latin1 COLLATE latin1_swedish_ci NOT NULL,
  `AssLoss_REMARKS` varchar(500) CHARACTER SET latin1 COLLATE latin1_swedish_ci NOT NULL DEFAULT 'Remarks Description',
  `AssLoss_DATE_CLAIM` datetime(0) NULL DEFAULT NULL,
  `AssLoss_DATE_ADD` datetime(0) NOT NULL DEFAULT CURRENT_TIMESTAMP,
  `AssLoss_DATE_MOD` datetime(0) NOT NULL DEFAULT CURRENT_TIMESTAMP,
  `AssLoss_DISPLAY_STAT` enum('Active','Inactive') CHARACTER SET latin1 COLLATE latin1_swedish_ci NULL DEFAULT 'Active',
  PRIMARY KEY (`AssLoss_ID`) USING BTREE,
  INDEX `FK_AssLoss_STUD_NO`(`AssLoss_STUD_NO`) USING BTREE,
  CONSTRAINT `FK_AssLoss_STUD_NO` FOREIGN KEY (`AssLoss_STUD_NO`) REFERENCES `r_stud_profile` (`Stud_NO`) ON DELETE CASCADE ON UPDATE CASCADE
) ENGINE = InnoDB AUTO_INCREMENT = 1 CHARACTER SET = latin1 COLLATE = latin1_swedish_ci ROW_FORMAT = Compact;

-- ----------------------------
-- Table structure for t_assign_stud_saction
-- ----------------------------
DROP TABLE IF EXISTS `t_assign_stud_saction`;
CREATE TABLE `t_assign_stud_saction`  (
  `AssSancStudStudent_ID` int(11) NOT NULL AUTO_INCREMENT,
  `AssSancStudStudent_STUD_NO` varchar(15) CHARACTER SET latin1 COLLATE latin1_swedish_ci NOT NULL,
  `AssSancStudStudent_SancDetails_CODE` varchar(100) CHARACTER SET latin1 COLLATE latin1_swedish_ci NOT NULL,
  `AssSancStudStudent_DesOffDetails_CODE` varchar(15) CHARACTER SET latin1 COLLATE latin1_swedish_ci NOT NULL,
  `AssSancStudStudent_CONSUMED_HOURS` int(11) NULL DEFAULT 0,
  `AssSancStudStudent_TO_BE_DONE` date NULL DEFAULT NULL,
  `AssSancStudStudent_REMARKS` varchar(100) CHARACTER SET latin1 COLLATE latin1_swedish_ci NULL DEFAULT NULL,
  `AssSancStudStudent_IS_FINISH` enum('Processing','Finished') CHARACTER SET latin1 COLLATE latin1_swedish_ci NOT NULL DEFAULT 'Processing',
  `AssSancStudStudent_DATE_ADD` datetime(0) NOT NULL DEFAULT CURRENT_TIMESTAMP,
  `AssSancStudStudent_DATE_MOD` datetime(0) NOT NULL DEFAULT CURRENT_TIMESTAMP,
  `AssSancStudStudent_DISPLAY_STAT` enum('Active','Inactive') CHARACTER SET latin1 COLLATE latin1_swedish_ci NULL DEFAULT 'Active',
  PRIMARY KEY (`AssSancStudStudent_ID`) USING BTREE,
  INDEX `FK_AssSancStudStudent_STUD_NO`(`AssSancStudStudent_STUD_NO`) USING BTREE,
  INDEX `FK_AssSancStudStudent_DesOffDetails_CODE`(`AssSancStudStudent_DesOffDetails_CODE`) USING BTREE,
  INDEX `FK_AssSancStudStudent_SancDetails_CODE`(`AssSancStudStudent_SancDetails_CODE`) USING BTREE,
  CONSTRAINT `FK_AssSancStudStudent_DesOffDetails_CODE` FOREIGN KEY (`AssSancStudStudent_DesOffDetails_CODE`) REFERENCES `r_designated_offices_details` (`DesOffDetails_CODE`) ON DELETE CASCADE ON UPDATE CASCADE,
  CONSTRAINT `FK_AssSancStudStudent_STUD_NO` FOREIGN KEY (`AssSancStudStudent_STUD_NO`) REFERENCES `r_stud_profile` (`Stud_NO`) ON DELETE CASCADE ON UPDATE CASCADE,
  CONSTRAINT `FK_AssSancStudStudent_SancDetails_CODE` FOREIGN KEY (`AssSancStudStudent_SancDetails_CODE`) REFERENCES `r_sanction_details` (`SancDetails_CODE`) ON DELETE CASCADE ON UPDATE CASCADE
) ENGINE = InnoDB AUTO_INCREMENT = 3 CHARACTER SET = latin1 COLLATE = latin1_swedish_ci ROW_FORMAT = Compact;

-- ----------------------------
-- Records of t_assign_stud_saction
-- ----------------------------
INSERT INTO `t_assign_stud_saction` VALUES (1, '2012-00075-CM-0', 'LossRegi_16', 'OFF00001', 16, '2018-05-24', '', 'Finished', '2018-05-21 15:01:19', '2018-05-22 13:59:23', 'Active');
INSERT INTO `t_assign_stud_saction` VALUES (2, '2016-00410-CM-0', 'LossRegi_16', 'OFF00001', 16, '2018-05-29', '', 'Finished', '2018-05-26 10:16:11', '2018-05-26 10:21:10', 'Active');

-- ----------------------------
-- Table structure for t_assign_student_clearance
-- ----------------------------
DROP TABLE IF EXISTS `t_assign_student_clearance`;
CREATE TABLE `t_assign_student_clearance`  (
  `AssStudClearance_ID` int(11) NOT NULL AUTO_INCREMENT,
  `AssStudClearance_STUD_NO` varchar(15) CHARACTER SET latin1 COLLATE latin1_swedish_ci NOT NULL,
  `AssStudClearance_BATCH` varchar(15) CHARACTER SET latin1 COLLATE latin1_swedish_ci NOT NULL,
  `AssStudClearance_SEMESTER` varchar(50) CHARACTER SET latin1 COLLATE latin1_swedish_ci NOT NULL,
  `AssStudClearance_SIGNATORIES_CODE` varchar(15) CHARACTER SET latin1 COLLATE latin1_swedish_ci NOT NULL,
  `AssStudClearance_DATE_ADD` datetime(0) NOT NULL DEFAULT CURRENT_TIMESTAMP,
  `AssStudClearance_DATE_MOD` datetime(0) NOT NULL DEFAULT CURRENT_TIMESTAMP,
  `AssStudClearance_DISPLAY_STAT` enum('Active','Inactive') CHARACTER SET latin1 COLLATE latin1_swedish_ci NULL DEFAULT 'Active',
  PRIMARY KEY (`AssStudClearance_STUD_NO`, `AssStudClearance_BATCH`, `AssStudClearance_SEMESTER`, `AssStudClearance_SIGNATORIES_CODE`) USING BTREE,
  UNIQUE INDEX `UNQ_AssStudClearance_ID`(`AssStudClearance_ID`) USING BTREE,
  INDEX `FK_AssStudClearance_SEMESTER`(`AssStudClearance_SEMESTER`) USING BTREE,
  INDEX `FK_AssStudClearance_SIGNATORIES_CODE`(`AssStudClearance_SIGNATORIES_CODE`) USING BTREE,
  INDEX `FK_AssStudClearance_BATCH`(`AssStudClearance_BATCH`) USING BTREE,
  CONSTRAINT `FK_AssStudClearance_BATCH` FOREIGN KEY (`AssStudClearance_BATCH`) REFERENCES `r_batch_details` (`Batch_YEAR`) ON DELETE RESTRICT ON UPDATE RESTRICT,
  CONSTRAINT `FK_AssStudClearance_SEMESTER` FOREIGN KEY (`AssStudClearance_SEMESTER`) REFERENCES `r_semester` (`Semestral_NAME`) ON DELETE CASCADE ON UPDATE CASCADE,
  CONSTRAINT `FK_AssStudClearance_SIGNATORIES_CODE` FOREIGN KEY (`AssStudClearance_SIGNATORIES_CODE`) REFERENCES `r_clearance_signatories` (`ClearSignatories_CODE`) ON DELETE CASCADE ON UPDATE CASCADE,
  CONSTRAINT `FK_AssStudClearance_STUD_NO` FOREIGN KEY (`AssStudClearance_STUD_NO`) REFERENCES `r_stud_profile` (`Stud_NO`) ON DELETE CASCADE ON UPDATE CASCADE
) ENGINE = InnoDB AUTO_INCREMENT = 6 CHARACTER SET = latin1 COLLATE = latin1_swedish_ci ROW_FORMAT = Compact;

-- ----------------------------
-- Records of t_assign_student_clearance
-- ----------------------------
INSERT INTO `t_assign_student_clearance` VALUES (1, '2012-00075-CM-0', '2019-2020', 'Summer Semester', 'SIG00001', '2018-05-21 14:56:15', '2018-05-26 10:15:37', 'Active');
INSERT INTO `t_assign_student_clearance` VALUES (4, '2012-00075-CM-0', '2019-2020', 'Summer Semester', 'SIG00002', '2018-05-21 14:56:15', '2018-05-22 12:49:54', 'Inactive');
INSERT INTO `t_assign_student_clearance` VALUES (3, '2012-00075-CM-0', '2019-2020', 'Summer Semester', 'SIG00003', '2018-05-21 14:56:15', '2018-05-22 12:49:54', 'Inactive');
INSERT INTO `t_assign_student_clearance` VALUES (2, '2012-00075-CM-0', '2019-2020', 'Summer Semester', 'SIG00004', '2018-05-21 14:56:15', '2018-05-22 12:49:54', 'Inactive');
INSERT INTO `t_assign_student_clearance` VALUES (5, '2012-00075-CM-0', '2019-2020', 'Summer Semester', 'SIG00005', '2018-05-21 14:56:15', '2018-05-22 12:50:04', 'Inactive');

-- ----------------------------
-- Table structure for t_clearance_generated_code
-- ----------------------------
DROP TABLE IF EXISTS `t_clearance_generated_code`;
CREATE TABLE `t_clearance_generated_code`  (
  `ClearanceGenCode_ID` int(11) NOT NULL AUTO_INCREMENT,
  `ClearanceGenCode_STUD_NO` varchar(15) CHARACTER SET latin1 COLLATE latin1_swedish_ci NOT NULL,
  `ClearanceGenCode_ACADEMIC_YEAR` varchar(15) CHARACTER SET latin1 COLLATE latin1_swedish_ci NOT NULL,
  `ClearanceGenCode_SEMESTER` varchar(50) CHARACTER SET latin1 COLLATE latin1_swedish_ci NOT NULL,
  `ClearanceGenCode_COD_VALUE` blob NOT NULL,
  `ClearanceGenCode_IS_CLAIMED` datetime(0) NULL DEFAULT NULL,
  `ClearanceGenCode_IS_GENERATE` datetime(0) NULL DEFAULT NULL,
  `ClearanceGenCode_DATE_ADD` datetime(0) NOT NULL DEFAULT CURRENT_TIMESTAMP,
  `ClearanceGenCode_DATE_MOD` datetime(0) NOT NULL,
  `ClearanceGenCode_DISPLAY_STAT` enum('Active','Inactive') CHARACTER SET latin1 COLLATE latin1_swedish_ci NULL DEFAULT 'Active',
  PRIMARY KEY (`ClearanceGenCode_STUD_NO`, `ClearanceGenCode_ACADEMIC_YEAR`, `ClearanceGenCode_SEMESTER`) USING BTREE,
  UNIQUE INDEX `UNQ_QRValStudClearance_ID`(`ClearanceGenCode_ID`) USING BTREE,
  INDEX `FK_QRValStudClearance_BATCH`(`ClearanceGenCode_ACADEMIC_YEAR`) USING BTREE,
  INDEX `FK_QRValStudClearance_SEMESTER`(`ClearanceGenCode_SEMESTER`) USING BTREE,
  CONSTRAINT `FK_ClearanceGenCode_BATCH` FOREIGN KEY (`ClearanceGenCode_ACADEMIC_YEAR`) REFERENCES `r_batch_details` (`Batch_YEAR`) ON DELETE CASCADE ON UPDATE CASCADE,
  CONSTRAINT `FK_ClearanceGenCode_SEMESTER` FOREIGN KEY (`ClearanceGenCode_SEMESTER`) REFERENCES `r_semester` (`Semestral_NAME`) ON DELETE CASCADE ON UPDATE CASCADE,
  CONSTRAINT `FK_ClearanceGenCode_STUD_NO` FOREIGN KEY (`ClearanceGenCode_STUD_NO`) REFERENCES `r_stud_profile` (`Stud_NO`) ON DELETE CASCADE ON UPDATE CASCADE
) ENGINE = InnoDB AUTO_INCREMENT = 1 CHARACTER SET = latin1 COLLATE = latin1_swedish_ci ROW_FORMAT = Compact;

-- ----------------------------
-- Table structure for t_couns_approach
-- ----------------------------
DROP TABLE IF EXISTS `t_couns_approach`;
CREATE TABLE `t_couns_approach`  (
  `Couns_ID_REFERENCE` int(11) NOT NULL,
  `Couns_APPROACH` varchar(50) CHARACTER SET latin1 COLLATE latin1_swedish_ci NOT NULL,
  INDEX `FK_cnspprchcnsidrfrnc`(`Couns_ID_REFERENCE`) USING BTREE,
  INDEX `FK_C_CA_REFERENCE`(`Couns_APPROACH`) USING BTREE,
  CONSTRAINT `FK_C_CA_REFERENCE` FOREIGN KEY (`Couns_APPROACH`) REFERENCES `r_couns_approach` (`Couns_APPROACH`) ON DELETE CASCADE ON UPDATE CASCADE,
  CONSTRAINT `FK_cnspprchcnsidrfrnc` FOREIGN KEY (`Couns_ID_REFERENCE`) REFERENCES `t_counseling` (`Couns_ID`) ON DELETE CASCADE ON UPDATE CASCADE
) ENGINE = InnoDB CHARACTER SET = latin1 COLLATE = latin1_swedish_ci ROW_FORMAT = Compact;

-- ----------------------------
-- Table structure for t_couns_details
-- ----------------------------
DROP TABLE IF EXISTS `t_couns_details`;
CREATE TABLE `t_couns_details`  (
  `Couns_ID_REFERENCE` int(11) NOT NULL,
  `Stud_NO` varchar(15) CHARACTER SET latin1 COLLATE latin1_swedish_ci NOT NULL,
  `Couns_REMARKS` varchar(50) CHARACTER SET latin1 COLLATE latin1_swedish_ci NULL DEFAULT NULL,
  `Couns_REMARKS_DETAILS` text CHARACTER SET latin1 COLLATE latin1_swedish_ci NULL,
  INDEX `FK_CnsIDrfrnc`(`Couns_ID_REFERENCE`) USING BTREE,
  INDEX `FK_cnslngstdnrfrnc`(`Stud_NO`) USING BTREE,
  INDEX `FK_cnsdtlscnsrmrksrfrnc`(`Couns_REMARKS`) USING BTREE,
  CONSTRAINT `FK_CnsIDrfrnc` FOREIGN KEY (`Couns_ID_REFERENCE`) REFERENCES `t_counseling` (`Couns_ID`) ON DELETE CASCADE ON UPDATE CASCADE,
  CONSTRAINT `FK_cnsdtlscnsrmrksrfrnc` FOREIGN KEY (`Couns_REMARKS`) REFERENCES `r_remarks` (`Remarks_TYPE`) ON DELETE CASCADE ON UPDATE CASCADE,
  CONSTRAINT `FK_cnslngstdnrfrnc` FOREIGN KEY (`Stud_NO`) REFERENCES `r_stud_profile` (`Stud_NO`) ON DELETE CASCADE ON UPDATE CASCADE
) ENGINE = InnoDB CHARACTER SET = latin1 COLLATE = latin1_swedish_ci ROW_FORMAT = Compact;

-- ----------------------------
-- Records of t_couns_details
-- ----------------------------
INSERT INTO `t_couns_details` VALUES (1, '2015-00138-CM-0', NULL, NULL);

-- ----------------------------
-- Table structure for t_counseling
-- ----------------------------
DROP TABLE IF EXISTS `t_counseling`;
CREATE TABLE `t_counseling`  (
  `Couns_ID` int(11) NOT NULL AUTO_INCREMENT,
  `Couns_CODE` varchar(15) CHARACTER SET latin1 COLLATE latin1_swedish_ci NOT NULL,
  `Visit_ID_REFERENCE` int(11) NOT NULL,
  `Couns_DATE` timestamp(0) NOT NULL DEFAULT CURRENT_TIMESTAMP,
  `Couns_COUNSELING_TYPE` varchar(50) CHARACTER SET latin1 COLLATE latin1_swedish_ci NOT NULL,
  `Couns_APPOINTMENT_TYPE` varchar(25) CHARACTER SET latin1 COLLATE latin1_swedish_ci NOT NULL,
  `Nature_Of_Case` varchar(50) CHARACTER SET latin1 COLLATE latin1_swedish_ci NULL DEFAULT NULL,
  `Couns_BACKGROUND` text CHARACTER SET latin1 COLLATE latin1_swedish_ci NULL,
  `Couns_GOALS` text CHARACTER SET latin1 COLLATE latin1_swedish_ci NULL,
  `Couns_COMMENT` text CHARACTER SET latin1 COLLATE latin1_swedish_ci NULL,
  `Couns_RECOMMENDATION` text CHARACTER SET latin1 COLLATE latin1_swedish_ci NULL,
  PRIMARY KEY (`Couns_ID`) USING BTREE,
  UNIQUE INDEX `Couns_CODE`(`Couns_CODE`) USING BTREE,
  INDEX `FK_cnslngvstidrfrnc`(`Visit_ID_REFERENCE`) USING BTREE,
  INDEX `FK_C_CT_REFERENCE`(`Couns_COUNSELING_TYPE`) USING BTREE,
  INDEX `FK_cnslngcnsppntmnttyp`(`Couns_APPOINTMENT_TYPE`) USING BTREE,
  INDEX `FK_cnslngntrfcsrfrnc`(`Nature_Of_Case`) USING BTREE,
  CONSTRAINT `FK_C_CT_REFERENCE` FOREIGN KEY (`Couns_COUNSELING_TYPE`) REFERENCES `r_couns_type` (`Couns_TYPE`) ON DELETE CASCADE ON UPDATE CASCADE,
  CONSTRAINT `FK_cnslngcnsppntmnttyp` FOREIGN KEY (`Couns_APPOINTMENT_TYPE`) REFERENCES `r_couns_appointment_type` (`Appmnt_TYPE`) ON DELETE CASCADE ON UPDATE CASCADE,
  CONSTRAINT `FK_cnslngntrfcsrfrnc` FOREIGN KEY (`Nature_Of_Case`) REFERENCES `r_nature_of_case` (`Case_NAME`) ON DELETE CASCADE ON UPDATE CASCADE,
  CONSTRAINT `FK_cnslngvstidrfrnc` FOREIGN KEY (`Visit_ID_REFERENCE`) REFERENCES `t_stud_visit` (`Stud_VISIT_ID`) ON DELETE CASCADE ON UPDATE CASCADE
) ENGINE = InnoDB AUTO_INCREMENT = 2 CHARACTER SET = latin1 COLLATE = latin1_swedish_ci ROW_FORMAT = Compact;

-- ----------------------------
-- Records of t_counseling
-- ----------------------------
INSERT INTO `t_counseling` VALUES (1, 'IC18-5231', 2, '2018-05-23 01:54:41', 'Individual Counseling', 'Referral', NULL, 'null', 'null', 'null', NULL);

-- ----------------------------
-- Table structure for t_org_accreditation_process
-- ----------------------------
DROP TABLE IF EXISTS `t_org_accreditation_process`;
CREATE TABLE `t_org_accreditation_process`  (
  `OrgAccrProcess_ID` int(11) NOT NULL AUTO_INCREMENT,
  `OrgAccrProcess_ORG_CODE` varchar(15) CHARACTER SET latin1 COLLATE latin1_swedish_ci NOT NULL,
  `OrgAccrProcess_OrgAccrDetail_CODE` varchar(15) CHARACTER SET latin1 COLLATE latin1_swedish_ci NOT NULL,
  `OrgAccrProcess_IS_ACCREDITED` int(11) NOT NULL DEFAULT 0,
  `OrgAccrProcess_DATE_ADD` datetime(0) NOT NULL DEFAULT CURRENT_TIMESTAMP,
  `OrgAccrProcess_DATE_MOD` datetime(0) NOT NULL DEFAULT CURRENT_TIMESTAMP,
  `OrgAccrProcess_DISPLAY_STAT` enum('Active','Inactive') CHARACTER SET latin1 COLLATE latin1_swedish_ci NULL DEFAULT 'Active',
  PRIMARY KEY (`OrgAccrProcess_ORG_CODE`, `OrgAccrProcess_OrgAccrDetail_CODE`) USING BTREE,
  UNIQUE INDEX `UNQ_OrgAccrProcess_ID`(`OrgAccrProcess_ID`) USING BTREE,
  INDEX `FK_OrgAccrProcess_OrgAccrDetail_CODE`(`OrgAccrProcess_OrgAccrDetail_CODE`) USING BTREE,
  CONSTRAINT `FK_OrgAccrProcess_ORG_CODE` FOREIGN KEY (`OrgAccrProcess_ORG_CODE`) REFERENCES `t_org_for_compliance` (`OrgForCompliance_ORG_CODE`) ON DELETE CASCADE ON UPDATE CASCADE,
  CONSTRAINT `FK_OrgAccrProcess_OrgAccrDetail_CODE` FOREIGN KEY (`OrgAccrProcess_OrgAccrDetail_CODE`) REFERENCES `r_org_accreditation_details` (`OrgAccrDetail_CODE`) ON DELETE CASCADE ON UPDATE CASCADE
) ENGINE = InnoDB AUTO_INCREMENT = 5 CHARACTER SET = latin1 COLLATE = latin1_swedish_ci ROW_FORMAT = Compact;

-- ----------------------------
-- Records of t_org_accreditation_process
-- ----------------------------
INSERT INTO `t_org_accreditation_process` VALUES (4, 'CITS2019', 'REQ00001', 1, '2018-05-23 12:47:14', '2018-05-23 12:47:14', 'Active');
INSERT INTO `t_org_accreditation_process` VALUES (1, 'CITS2019', 'REQ00002', 1, '2018-05-23 12:47:14', '2018-05-23 12:47:14', 'Active');
INSERT INTO `t_org_accreditation_process` VALUES (2, 'CITS2019', 'REQ00003', 1, '2018-05-23 12:47:14', '2018-05-23 12:47:14', 'Active');
INSERT INTO `t_org_accreditation_process` VALUES (3, 'CITS2019', 'REQ00004', 1, '2018-05-23 12:47:14', '2018-05-23 12:47:14', 'Active');

-- ----------------------------
-- Table structure for t_org_cash_flow_statement
-- ----------------------------
DROP TABLE IF EXISTS `t_org_cash_flow_statement`;
CREATE TABLE `t_org_cash_flow_statement`  (
  `OrgCashFlowStatement_ID` int(11) NOT NULL AUTO_INCREMENT,
  `OrgCashFlowStatement_ORG_CODE` varchar(15) CHARACTER SET latin1 COLLATE latin1_swedish_ci NOT NULL,
  `OrgCashFlowStatement_ITEM` varchar(100) CHARACTER SET latin1 COLLATE latin1_swedish_ci NOT NULL,
  `OrgCashFlowStatement_COLLECTION` double(10, 3) NULL DEFAULT NULL,
  `OrgCashFlowStatement_EXPENSES` double(10, 3) NULL DEFAULT NULL,
  `OrgCashFlowStatement_REMARKS` varchar(100) CHARACTER SET latin1 COLLATE latin1_swedish_ci NULL DEFAULT NULL,
  `OrgCashFlowStatement_DATE_ADD` datetime(0) NOT NULL DEFAULT CURRENT_TIMESTAMP,
  `OrgCashFlowStatement_DATE_MOD` datetime(0) NOT NULL DEFAULT CURRENT_TIMESTAMP,
  `OrgCashFlowStatement_DISPLAY_STAT` enum('Active','Inactive') CHARACTER SET latin1 COLLATE latin1_swedish_ci NULL DEFAULT 'Active',
  PRIMARY KEY (`OrgCashFlowStatement_ID`) USING BTREE,
  INDEX `FK_OrgCashFlowStatement_ORG_CODE`(`OrgCashFlowStatement_ORG_CODE`) USING BTREE,
  CONSTRAINT `FK_OrgCashFlowStatement_ORG_CODE` FOREIGN KEY (`OrgCashFlowStatement_ORG_CODE`) REFERENCES `t_org_for_compliance` (`OrgForCompliance_ORG_CODE`) ON DELETE CASCADE ON UPDATE CASCADE
) ENGINE = InnoDB AUTO_INCREMENT = 3 CHARACTER SET = latin1 COLLATE = latin1_swedish_ci ROW_FORMAT = Compact;

-- ----------------------------
-- Records of t_org_cash_flow_statement
-- ----------------------------
INSERT INTO `t_org_cash_flow_statement` VALUES (1, 'CITS2019', 'Remit #00001', 1000.000, NULL, 'Received by: Demelyn E. Monzon', '2018-05-26 10:28:08', '2018-05-26 10:28:08', 'Active');
INSERT INTO `t_org_cash_flow_statement` VALUES (2, 'CITS2019', 'Vouch #00001', NULL, 400.000, 'Received by: Demelyn', '2018-05-26 10:29:02', '2018-05-26 10:29:02', 'Active');

-- ----------------------------
-- Table structure for t_org_financial_statement
-- ----------------------------
DROP TABLE IF EXISTS `t_org_financial_statement`;
CREATE TABLE `t_org_financial_statement`  (
  `OrgFinStatement_ID` int(11) NOT NULL AUTO_INCREMENT,
  `OrgFinStatement_ORG_CODE` varchar(15) CHARACTER SET latin1 COLLATE latin1_swedish_ci NOT NULL,
  `OrgFinStatement_SEMESTER` varchar(50) CHARACTER SET latin1 COLLATE latin1_swedish_ci NOT NULL,
  `OrgFinStatement_DATE_ADD` datetime(0) NOT NULL DEFAULT CURRENT_TIMESTAMP,
  `OrgFinStatement_DATE_MOD` datetime(0) NOT NULL DEFAULT CURRENT_TIMESTAMP,
  `OrgFinStatement_DISPLAY_STAT` enum('Active','Inactive') CHARACTER SET latin1 COLLATE latin1_swedish_ci NULL DEFAULT 'Active',
  PRIMARY KEY (`OrgFinStatement_ID`) USING BTREE,
  INDEX `FK_OrgFinStatement_ORG_CODE`(`OrgFinStatement_ORG_CODE`) USING BTREE,
  INDEX `FK_OrgFinStatement_SEMESTER`(`OrgFinStatement_SEMESTER`) USING BTREE,
  CONSTRAINT `FK_OrgFinStatement_ORG_CODE` FOREIGN KEY (`OrgFinStatement_ORG_CODE`) REFERENCES `t_org_for_compliance` (`OrgForCompliance_ORG_CODE`) ON DELETE CASCADE ON UPDATE CASCADE,
  CONSTRAINT `FK_OrgFinStatement_SEMESTER` FOREIGN KEY (`OrgFinStatement_SEMESTER`) REFERENCES `r_semester` (`Semestral_NAME`) ON DELETE CASCADE ON UPDATE CASCADE
) ENGINE = InnoDB AUTO_INCREMENT = 1 CHARACTER SET = latin1 COLLATE = latin1_swedish_ci ROW_FORMAT = Compact;

-- ----------------------------
-- Table structure for t_org_financial_statement_items
-- ----------------------------
DROP TABLE IF EXISTS `t_org_financial_statement_items`;
CREATE TABLE `t_org_financial_statement_items`  (
  `OrgFinStatExpenses_ID` int(11) NOT NULL AUTO_INCREMENT,
  `OrgFinStatExpenses_OrgFinStatement_ID` int(11) NOT NULL,
  `OrgFinStatExpenses_ITEM` varchar(100) CHARACTER SET latin1 COLLATE latin1_swedish_ci NOT NULL,
  `OrgFinStatExpenses_AMOUNT` double(10, 3) NOT NULL DEFAULT 0.000,
  `OrgFinStatExpenses_DATE_ADD` datetime(0) NOT NULL DEFAULT CURRENT_TIMESTAMP,
  `OrgFinStatExpenses_DATE_MOD` datetime(0) NOT NULL DEFAULT CURRENT_TIMESTAMP,
  `OrgFinStatExpenses_DISPLAY_STAT` enum('Active','Inactive') CHARACTER SET latin1 COLLATE latin1_swedish_ci NULL DEFAULT 'Active',
  PRIMARY KEY (`OrgFinStatExpenses_ID`) USING BTREE,
  INDEX `FK_OrgFinStatExpenses_OrgFinStatement_ID`(`OrgFinStatExpenses_OrgFinStatement_ID`) USING BTREE,
  CONSTRAINT `FK_OrgFinStatExpenses_OrgFinStatement_ID` FOREIGN KEY (`OrgFinStatExpenses_OrgFinStatement_ID`) REFERENCES `t_org_financial_statement` (`OrgFinStatement_ID`) ON DELETE CASCADE ON UPDATE CASCADE
) ENGINE = InnoDB AUTO_INCREMENT = 1 CHARACTER SET = latin1 COLLATE = latin1_swedish_ci ROW_FORMAT = Compact;

-- ----------------------------
-- Table structure for t_org_for_compliance
-- ----------------------------
DROP TABLE IF EXISTS `t_org_for_compliance`;
CREATE TABLE `t_org_for_compliance`  (
  `OrgForCompliance_ID` int(11) NOT NULL AUTO_INCREMENT,
  `OrgForCompliance_ORG_CODE` varchar(15) CHARACTER SET latin1 COLLATE latin1_swedish_ci NOT NULL,
  `OrgForCompliance_OrgApplProfile_APPL_CODE` varchar(15) CHARACTER SET latin1 COLLATE latin1_swedish_ci NOT NULL,
  `OrgForCompliance_ADVISER` varchar(100) CHARACTER SET latin1 COLLATE latin1_swedish_ci NULL DEFAULT 'Organization Adviser should be here!',
  `OrgForCompliance_BATCH_YEAR` varchar(15) CHARACTER SET latin1 COLLATE latin1_swedish_ci NOT NULL,
  `OrgForCompliance_DATE_ADD` datetime(0) NOT NULL DEFAULT CURRENT_TIMESTAMP,
  `OrgForCompliance_DATE_MOD` datetime(0) NOT NULL DEFAULT CURRENT_TIMESTAMP,
  `OrgForCompliance_DISPAY_STAT` enum('Active','Inactive') CHARACTER SET latin1 COLLATE latin1_swedish_ci NULL DEFAULT 'Active',
  PRIMARY KEY (`OrgForCompliance_ID`) USING BTREE,
  UNIQUE INDEX `UNQ_OrgForCompliance_CODE`(`OrgForCompliance_ORG_CODE`) USING BTREE,
  UNIQUE INDEX `UNQ_OrgForCompliance_ORG_CODE`(`OrgForCompliance_ORG_CODE`) USING BTREE,
  INDEX `FK_OrgForCompliance_CODE`(`OrgForCompliance_OrgApplProfile_APPL_CODE`) USING BTREE,
  INDEX `FK_OR_ORG_FOUNDED_BATCH_YEAR`(`OrgForCompliance_BATCH_YEAR`) USING BTREE,
  CONSTRAINT `FK_OR_ORG_FOUNDED_BATCH_YEAR` FOREIGN KEY (`OrgForCompliance_BATCH_YEAR`) REFERENCES `r_batch_details` (`Batch_YEAR`) ON DELETE CASCADE ON UPDATE CASCADE,
  CONSTRAINT `FK_OrgForCompliance_CODE` FOREIGN KEY (`OrgForCompliance_OrgApplProfile_APPL_CODE`) REFERENCES `r_org_applicant_profile` (`OrgAppProfile_APPL_CODE`) ON DELETE CASCADE ON UPDATE CASCADE
) ENGINE = InnoDB AUTO_INCREMENT = 2 CHARACTER SET = latin1 COLLATE = latin1_swedish_ci ROW_FORMAT = Compact;

-- ----------------------------
-- Records of t_org_for_compliance
-- ----------------------------
INSERT INTO `t_org_for_compliance` VALUES (1, 'CITS2019', 'CITS2019', 'Alma C. Fernandez', '2019-2020', '2018-05-23 12:44:12', '2018-05-23 12:44:12', 'Active');

-- ----------------------------
-- Table structure for t_org_officers
-- ----------------------------
DROP TABLE IF EXISTS `t_org_officers`;
CREATE TABLE `t_org_officers`  (
  `OrgOffi_ID` int(11) NOT NULL AUTO_INCREMENT,
  `OrgOffi_OrgOffiPosDetails_ID` int(11) NOT NULL,
  `OrgOffi_STUD_NO` varchar(15) CHARACTER SET latin1 COLLATE latin1_swedish_ci NOT NULL,
  `OrgOffi_DATE_ADD` datetime(0) NOT NULL DEFAULT CURRENT_TIMESTAMP,
  `OrgOffi_DATE_MODIFIED` datetime(0) NOT NULL DEFAULT CURRENT_TIMESTAMP,
  `OrgOffi_DISPLAY_STAT` enum('Active','Inactive') CHARACTER SET latin1 COLLATE latin1_swedish_ci NULL DEFAULT 'Active',
  PRIMARY KEY (`OrgOffi_STUD_NO`, `OrgOffi_OrgOffiPosDetails_ID`) USING BTREE,
  UNIQUE INDEX `UNQ_OrgOffi_ID`(`OrgOffi_ID`) USING BTREE,
  INDEX `FK_OrgOffi_OrgOffiPosDetails_ID`(`OrgOffi_OrgOffiPosDetails_ID`) USING BTREE,
  CONSTRAINT `FK_OrgOffi_OrgOffiPosDetails_ID` FOREIGN KEY (`OrgOffi_OrgOffiPosDetails_ID`) REFERENCES `r_org_officer_position_details` (`OrgOffiPosDetails_ID`) ON DELETE CASCADE ON UPDATE CASCADE,
  CONSTRAINT `FK_OrgOffi_STUD_NO` FOREIGN KEY (`OrgOffi_STUD_NO`) REFERENCES `r_stud_profile` (`Stud_NO`) ON DELETE CASCADE ON UPDATE CASCADE
) ENGINE = InnoDB AUTO_INCREMENT = 1 CHARACTER SET = latin1 COLLATE = latin1_swedish_ci ROW_FORMAT = Compact;

-- ----------------------------
-- Table structure for t_org_remittance
-- ----------------------------
DROP TABLE IF EXISTS `t_org_remittance`;
CREATE TABLE `t_org_remittance`  (
  `OrgRemittance_ID` int(11) NOT NULL AUTO_INCREMENT,
  `OrgRemittance_NUMBER` varchar(15) CHARACTER SET latin1 COLLATE latin1_swedish_ci NOT NULL,
  `OrgRemittance_ORG_CODE` varchar(15) CHARACTER SET latin1 COLLATE latin1_swedish_ci NOT NULL,
  `OrgRemittance_SEND_BY` varchar(100) CHARACTER SET latin1 COLLATE latin1_swedish_ci NOT NULL,
  `OrgRemittance_REC_BY` varchar(100) CHARACTER SET latin1 COLLATE latin1_swedish_ci NOT NULL,
  `OrgRemittance_AMOUNT` double(10, 3) NOT NULL,
  `OrgRemittance_DESC` varchar(100) CHARACTER SET latin1 COLLATE latin1_swedish_ci NULL DEFAULT 'Remittance Description',
  `OrgRemittance_DATE_ADD` datetime(0) NOT NULL DEFAULT CURRENT_TIMESTAMP,
  `OrgRemittance_DATE_MOD` datetime(0) NOT NULL DEFAULT CURRENT_TIMESTAMP,
  `OrgRemittance_DISPLAY_STAT` enum('Active','Inactive') CHARACTER SET latin1 COLLATE latin1_swedish_ci NULL DEFAULT 'Active',
  `OrgRemittance_APPROVED_STATUS` enum('Pending','Rejected','Approved') CHARACTER SET latin1 COLLATE latin1_swedish_ci NOT NULL DEFAULT 'Approved',
  PRIMARY KEY (`OrgRemittance_ID`) USING BTREE,
  INDEX `FK_OrgRemittance_ORG_CODE`(`OrgRemittance_ORG_CODE`) USING BTREE,
  CONSTRAINT `FK_OrgRemittance_ORG_CODE` FOREIGN KEY (`OrgRemittance_ORG_CODE`) REFERENCES `t_org_for_compliance` (`OrgForCompliance_ORG_CODE`) ON DELETE CASCADE ON UPDATE CASCADE
) ENGINE = InnoDB AUTO_INCREMENT = 2 CHARACTER SET = latin1 COLLATE = latin1_swedish_ci ROW_FORMAT = Compact;

-- ----------------------------
-- Records of t_org_remittance
-- ----------------------------
INSERT INTO `t_org_remittance` VALUES (1, 'Remit #00001', 'CITS2019', 'Patrick', 'Demelyn E. Monzon', 1000.000, 'Remittance', '2018-05-26 10:28:08', '2018-05-26 10:28:08', 'Active', 'Approved');

-- ----------------------------
-- Table structure for t_org_voucher
-- ----------------------------
DROP TABLE IF EXISTS `t_org_voucher`;
CREATE TABLE `t_org_voucher`  (
  `OrgVoucher_ID` int(11) NOT NULL AUTO_INCREMENT,
  `OrgVoucher_CASH_VOUCHER_NO` varchar(15) CHARACTER SET latin1 COLLATE latin1_swedish_ci NOT NULL,
  `OrgVoucher_CHECKED_BY` varchar(100) CHARACTER SET latin1 COLLATE latin1_swedish_ci NOT NULL,
  `OrgVoucher_VOUCHED_BY` varchar(100) CHARACTER SET latin1 COLLATE latin1_swedish_ci NULL DEFAULT NULL,
  `OrgVoucher_ORG_CODE` varchar(15) CHARACTER SET latin1 COLLATE latin1_swedish_ci NOT NULL,
  `OrgVoucher_STATUS` enum('Cancelled','Pending','Approved','Rejected') CHARACTER SET latin1 COLLATE latin1_swedish_ci NOT NULL DEFAULT 'Pending',
  `OrgVoucher_DATE_ADD` datetime(0) NOT NULL DEFAULT CURRENT_TIMESTAMP,
  `OrgVoucher_DATE_MOD` datetime(0) NOT NULL DEFAULT CURRENT_TIMESTAMP,
  `OrgVoucher_DISPLAY_STAT` enum('Active','Inactive') CHARACTER SET latin1 COLLATE latin1_swedish_ci NULL DEFAULT 'Active',
  PRIMARY KEY (`OrgVoucher_ID`) USING BTREE,
  UNIQUE INDEX `UNQ_OrgVoucher_CASH_VOUCHER_NO`(`OrgVoucher_CASH_VOUCHER_NO`) USING BTREE,
  INDEX `FK_OrgVoucher_ORG_CODE`(`OrgVoucher_ORG_CODE`) USING BTREE,
  CONSTRAINT `FK_OrgVoucher_ORG_CODE` FOREIGN KEY (`OrgVoucher_ORG_CODE`) REFERENCES `t_org_for_compliance` (`OrgForCompliance_ORG_CODE`) ON DELETE CASCADE ON UPDATE CASCADE
) ENGINE = InnoDB AUTO_INCREMENT = 2 CHARACTER SET = latin1 COLLATE = latin1_swedish_ci ROW_FORMAT = Compact;

-- ----------------------------
-- Records of t_org_voucher
-- ----------------------------
INSERT INTO `t_org_voucher` VALUES (1, 'Vouch #00001', 'Demelyn', 'Patrick', 'CITS2019', 'Approved', '2018-05-26 10:29:02', '2018-05-26 10:29:02', 'Active');

-- ----------------------------
-- Table structure for t_org_voucher_items
-- ----------------------------
DROP TABLE IF EXISTS `t_org_voucher_items`;
CREATE TABLE `t_org_voucher_items`  (
  `OrgVouchItems_ID` int(11) NOT NULL AUTO_INCREMENT,
  `OrgVouchItems_VOUCHER_NO` varchar(15) CHARACTER SET latin1 COLLATE latin1_swedish_ci NOT NULL,
  `OrgVouchItems_ITEM_NAME` varchar(100) CHARACTER SET latin1 COLLATE latin1_swedish_ci NOT NULL,
  `OrgVouchItems_AMOUNT` double(10, 3) NOT NULL DEFAULT 0.000,
  `OrgVouchItems_DATE_ADD` datetime(0) NOT NULL DEFAULT CURRENT_TIMESTAMP,
  `OrgVouchItems_DATE_MOD` datetime(0) NOT NULL DEFAULT CURRENT_TIMESTAMP,
  `OrgVouchItems_DISPLAY_STAT` enum('Active','Inactive') CHARACTER SET latin1 COLLATE latin1_swedish_ci NULL DEFAULT 'Active',
  PRIMARY KEY (`OrgVouchItems_ITEM_NAME`, `OrgVouchItems_VOUCHER_NO`) USING BTREE,
  UNIQUE INDEX `UNQ_OrgVouchItems_ID`(`OrgVouchItems_ID`) USING BTREE,
  INDEX `FK_OrgVouchItems_VOUCHER_NO`(`OrgVouchItems_VOUCHER_NO`) USING BTREE,
  CONSTRAINT `FK_OrgVouchItems_VOUCHER_NO` FOREIGN KEY (`OrgVouchItems_VOUCHER_NO`) REFERENCES `t_org_voucher` (`OrgVoucher_CASH_VOUCHER_NO`) ON DELETE CASCADE ON UPDATE CASCADE
) ENGINE = InnoDB AUTO_INCREMENT = 4 CHARACTER SET = latin1 COLLATE = latin1_swedish_ci ROW_FORMAT = Compact;

-- ----------------------------
-- Records of t_org_voucher_items
-- ----------------------------
INSERT INTO `t_org_voucher_items` VALUES (2, 'Vouch #00001', 'Hello Chocolates', 100.000, '2018-05-26 10:29:03', '2018-05-26 10:29:03', 'Active');
INSERT INTO `t_org_voucher_items` VALUES (1, 'Vouch #00001', 'Nova Chips', 100.000, '2018-05-26 10:29:03', '2018-05-26 10:29:03', 'Active');
INSERT INTO `t_org_voucher_items` VALUES (3, 'Vouch #00001', 'Pandesal ', 200.000, '2018-05-26 10:29:03', '2018-05-26 10:29:03', 'Active');

-- ----------------------------
-- Table structure for t_stud_visit
-- ----------------------------
DROP TABLE IF EXISTS `t_stud_visit`;
CREATE TABLE `t_stud_visit`  (
  `Stud_VISIT_ID` int(11) NOT NULL AUTO_INCREMENT,
  `Visit_CODE` varchar(15) CHARACTER SET latin1 COLLATE latin1_swedish_ci NOT NULL,
  `Visit_DATE` timestamp(0) NOT NULL DEFAULT CURRENT_TIMESTAMP,
  `Stud_NO` varchar(15) CHARACTER SET latin1 COLLATE latin1_swedish_ci NOT NULL,
  `Visit_PURPOSE` varchar(50) CHARACTER SET latin1 COLLATE latin1_swedish_ci NOT NULL,
  `Visit_DETAILS` text CHARACTER SET latin1 COLLATE latin1_swedish_ci NULL,
  PRIMARY KEY (`Stud_VISIT_ID`) USING BTREE,
  UNIQUE INDEX `Visit_CODE`(`Visit_CODE`) USING BTREE,
  INDEX `FK_vst_STUD_NO`(`Stud_NO`) USING BTREE,
  INDEX `FK_stdvstprps_vstrfrnc`(`Visit_PURPOSE`) USING BTREE,
  CONSTRAINT `FK_stdvstprps_vstrfrnc` FOREIGN KEY (`Visit_PURPOSE`) REFERENCES `r_visit` (`Visit_TYPE`) ON DELETE CASCADE ON UPDATE CASCADE,
  CONSTRAINT `FK_vst_STUD_NO` FOREIGN KEY (`Stud_NO`) REFERENCES `r_stud_profile` (`Stud_NO`) ON DELETE CASCADE ON UPDATE CASCADE
) ENGINE = InnoDB AUTO_INCREMENT = 4 CHARACTER SET = latin1 COLLATE = latin1_swedish_ci ROW_FORMAT = Compact;

-- ----------------------------
-- Records of t_stud_visit
-- ----------------------------
INSERT INTO `t_stud_visit` VALUES (1, 'VS18-5231', '2018-05-23 00:10:38', '2015-00138-CM-0', 'Excuse Letter', 'Excuse Letter');
INSERT INTO `t_stud_visit` VALUES (2, 'VS18-5232', '2018-05-23 00:25:05', '2015-00138-CM-0', 'Counseling', 'nahuling natutulog sa klase');
INSERT INTO `t_stud_visit` VALUES (3, 'VS18-5233', '2018-05-23 02:03:58', '2015-00138-CM-0', 'Signing of Clearance', 'null');

-- ----------------------------
-- Table structure for t_upload
-- ----------------------------
DROP TABLE IF EXISTS `t_upload`;
CREATE TABLE `t_upload`  (
  `Upload_FILE_ID` int(11) NOT NULL AUTO_INCREMENT,
  `Upload_DATE` timestamp(0) NOT NULL DEFAULT CURRENT_TIMESTAMP,
  `Upload_USER` varchar(15) CHARACTER SET latin1 COLLATE latin1_swedish_ci NOT NULL,
  `Upload_FILENAME` varchar(200) CHARACTER SET latin1 COLLATE latin1_swedish_ci NOT NULL,
  `Upload_CATEGORY` varchar(100) CHARACTER SET latin1 COLLATE latin1_swedish_ci NOT NULL,
  `Upload_TYPE` varchar(15) CHARACTER SET latin1 COLLATE latin1_swedish_ci NOT NULL,
  `Upload_FILETYPE` varchar(100) CHARACTER SET latin1 COLLATE latin1_swedish_ci NOT NULL,
  `Upload_FILEPATH` varchar(100) CHARACTER SET latin1 COLLATE latin1_swedish_ci NOT NULL,
  PRIMARY KEY (`Upload_FILE_ID`) USING BTREE,
  INDEX `FK_pldctgryrfrnc`(`Upload_CATEGORY`) USING BTREE,
  CONSTRAINT `FK_pldctgryrfrnc` FOREIGN KEY (`Upload_CATEGORY`) REFERENCES `r_upload_category` (`Upload_FILE_CATEGORY`) ON DELETE CASCADE ON UPDATE CASCADE
) ENGINE = InnoDB AUTO_INCREMENT = 1 CHARACTER SET = latin1 COLLATE = latin1_swedish_ci ROW_FORMAT = Compact;

-- ----------------------------
-- Procedure structure for Active_AssignConfilicts_SemClearance
-- ----------------------------
DROP PROCEDURE IF EXISTS `Active_AssignConfilicts_SemClearance`;
delimiter ;;
CREATE DEFINER="root"@"localhost" PROCEDURE "Active_AssignConfilicts_SemClearance"(IN `id` INT)
    NO SQL
UPDATE `t_assign_student_clearance` SET 
`AssStudClearance_DATE_MOD`=CURRENT_TIMESTAMP
,`AssStudClearance_DISPLAY_STAT`='Active' 
WHERE `AssStudClearance_ID` =id
;;
delimiter ;

-- ----------------------------
-- Procedure structure for Archive_AssignConfilicts_SemClearance
-- ----------------------------
DROP PROCEDURE IF EXISTS `Archive_AssignConfilicts_SemClearance`;
delimiter ;;
CREATE DEFINER="root"@"localhost" PROCEDURE "Archive_AssignConfilicts_SemClearance"(IN `id` INT)
    NO SQL
UPDATE `t_assign_student_clearance` SET 
`AssStudClearance_DATE_MOD`=CURRENT_TIMESTAMP
,`AssStudClearance_DISPLAY_STAT`='Inactive' 
WHERE `AssStudClearance_ID` =id
;;
delimiter ;

-- ----------------------------
-- Procedure structure for Archive_AssignSanction
-- ----------------------------
DROP PROCEDURE IF EXISTS `Archive_AssignSanction`;
delimiter ;;
CREATE DEFINER="root"@"localhost" PROCEDURE "Archive_AssignSanction"(IN `ID` INT)
    NO SQL
UPDATE `t_assign_stud_saction` SET `AssSancStudStudent_DISPLAY_STAT`='Inactive' 
,`AssSancStudStudent_DATE_MOD` = CURRENT_TIMESTAMP
WHERE
`AssSancStudStudent_ID` =ID
;;
delimiter ;

-- ----------------------------
-- Procedure structure for Archive_FinancialAss
-- ----------------------------
DROP PROCEDURE IF EXISTS `Archive_FinancialAss`;
delimiter ;;
CREATE DEFINER="root"@"localhost" PROCEDURE "Archive_FinancialAss"(IN `ID` INT(100))
    NO SQL
delete from `t_assign_stud_finan_assistance`  
where AssStudFinanAssistance_ID = ID
;;
delimiter ;

-- ----------------------------
-- Procedure structure for Archive_LossIDRegi
-- ----------------------------
DROP PROCEDURE IF EXISTS `Archive_LossIDRegi`;
delimiter ;;
CREATE DEFINER="root"@"localhost" PROCEDURE "Archive_LossIDRegi"(IN `ID` INT)
    NO SQL
update t_assign_stud_loss_id_regicard 
set AssLoss_DISPLAY_STAT ='Inactive'
where AssLoss_ID =ID
;;
delimiter ;

-- ----------------------------
-- Procedure structure for counseling_type_add
-- ----------------------------
DROP PROCEDURE IF EXISTS `counseling_type_add`;
delimiter ;;
CREATE DEFINER=`root`@`localhost` PROCEDURE `counseling_type_add`(IN `type` VARCHAR(50))
    NO SQL
insert into r_couns_type (Couns_TYPE) values (type)
;;
delimiter ;

-- ----------------------------
-- Procedure structure for FinishSanction
-- ----------------------------
DROP PROCEDURE IF EXISTS `FinishSanction`;
delimiter ;;
CREATE DEFINER="root"@"localhost" PROCEDURE "FinishSanction"(IN `ID` INT)
    NO SQL
UPDATE t_assign_stud_saction 
set AssSancStudStudent_IS_FINISH ='Finished'
where AssSancStudStudent_ID =ID
;;
delimiter ;

-- ----------------------------
-- Procedure structure for Insert_AssignConfilicts_SemClearance
-- ----------------------------
DROP PROCEDURE IF EXISTS `Insert_AssignConfilicts_SemClearance`;
delimiter ;;
CREATE DEFINER="root"@"localhost" PROCEDURE "Insert_AssignConfilicts_SemClearance"(IN `Studno` VARCHAR(15), IN `acadyear` VARCHAR(15), IN `sem` VARCHAR(50), IN `sigcode` VARCHAR(15))
    NO SQL
INSERT INTO `t_assign_student_clearance` (`AssStudClearance_STUD_NO`, `AssStudClearance_BATCH`, `AssStudClearance_SEMESTER`, `AssStudClearance_SIGNATORIES_CODE`) VALUES (Studno,acadyear,sem,sigcode)
;;
delimiter ;

-- ----------------------------
-- Procedure structure for Insert_AssignFinancialAss
-- ----------------------------
DROP PROCEDURE IF EXISTS `Insert_AssignFinancialAss`;
delimiter ;;
CREATE DEFINER="root"@"localhost" PROCEDURE "Insert_AssignFinancialAss"(IN `StudNo` VARCHAR(15), IN `FinanAssTitle` VARCHAR(100), IN `FinanAssStatus` ENUM('Active','Inactive','Void','Cancelled'), IN `FinanAssRemarks` VARCHAR(500))
    NO SQL
INSERT INTO `t_assign_stud_finan_assistance` (`AssStudFinanAssistance_STUD_NO`, `AssStudFinanAssistance_FINAN_NAME`, `AssStudFinanAssistance_STATUS`, `AssStudFinanAssistance_REMARKS`, `AssStudFinanAssistance_DATE_ADD`) VALUES (StudNo,FinanAssTitle , FinanAssStatus, FinanAssRemarks, CURRENT_TIMESTAMP)
;;
delimiter ;

-- ----------------------------
-- Procedure structure for Insert_AssignSanction
-- ----------------------------
DROP PROCEDURE IF EXISTS `Insert_AssignSanction`;
delimiter ;;
CREATE DEFINER=`root`@`localhost` PROCEDURE `Insert_AssignSanction`(IN `StudNo` VARCHAR(15), IN `SancCode` VARCHAR(100), IN `DesOffCode` VARCHAR(15), IN `Cons` INT, IN `Finish` ENUM('Finished','Processing'), IN `remarks` VARCHAR(100), IN `done` DATE)
    NO SQL
INSERT INTO `t_assign_stud_saction`(`AssSancStudStudent_STUD_NO`, `AssSancStudStudent_SancDetails_CODE`, `AssSancStudStudent_DesOffDetails_CODE`,
`AssSancStudStudent_CONSUMED_HOURS`,
`AssSancStudStudent_IS_FINISH`,
`AssSancStudStudent_REMARKS`,
`AssSancStudStudent_TO_BE_DONE`) VALUES (StudNo,SancCode,DesOffCode,Cons,Finish,remarks,done)
;;
delimiter ;

-- ----------------------------
-- Procedure structure for Insert_DesignatedOffice
-- ----------------------------
DROP PROCEDURE IF EXISTS `Insert_DesignatedOffice`;
delimiter ;;
CREATE DEFINER="root"@"localhost" PROCEDURE "Insert_DesignatedOffice"(IN `DesiCode` VARCHAR(15), IN `DesiName` VARCHAR(100), IN `DesiDesc` VARCHAR(100))
    NO SQL
INSERT INTO `r_designated_offices_details` (  `DesOffDetails_CODE`, `DesOffDetails_NAME`, `DesOffDetails_DESC`) VALUES (DesiCode,DesiName,DesiDesc)
;;
delimiter ;

-- ----------------------------
-- Procedure structure for Insert_LossIDRegi
-- ----------------------------
DROP PROCEDURE IF EXISTS `Insert_LossIDRegi`;
delimiter ;;
CREATE DEFINER="root"@"localhost" PROCEDURE "Insert_LossIDRegi"(IN `StudNo` VARCHAR(15), IN `Type` ENUM('Identification Card','Registration Card'), IN `Claim` DATETIME, IN `Remarks` VARCHAR(500))
    NO SQL
INSERT INTO `t_assign_stud_loss_id_regicard` ( `AssLoss_STUD_NO`, `AssLoss_TYPE`, `AssLoss_REMARKS`, `AssLoss_DATE_CLAIM`) VALUES (StudNo,Type,Remarks,Claim)
;;
delimiter ;

-- ----------------------------
-- Procedure structure for Insert_SanctionDetails
-- ----------------------------
DROP PROCEDURE IF EXISTS `Insert_SanctionDetails`;
delimiter ;;
CREATE DEFINER="root"@"localhost" PROCEDURE "Insert_SanctionDetails"(IN `SancCode` VARCHAR(100), IN `SancName` VARCHAR(100), IN `SancDesc` VARCHAR(1000), IN `TimeVal` INT(11))
    NO SQL
INSERT INTO `r_sanction_details` 
(`SancDetails_CODE`
 , `SancDetails_NAME`
 , `SancDetails_DESC`
 , `SancDetails_TIMEVAL`)
 VALUES 
 (SancCode
  ,SancName
  ,SancDesc
  ,TimeVal)
;;
delimiter ;

-- ----------------------------
-- Procedure structure for Insert_Signatories
-- ----------------------------
DROP PROCEDURE IF EXISTS `Insert_Signatories`;
delimiter ;;
CREATE DEFINER="root"@"localhost" PROCEDURE "Insert_Signatories"(IN `sCODE` VARCHAR(15), IN `sNAME` VARCHAR(100), IN `sDESC` VARCHAR(100))
    NO SQL
INSERT INTO `r_clearance_signatories` (`ClearSignatories_CODE`, `ClearSignatories_NAME`, `ClearSignatories_DESC` ) VALUES (sCODE,sNAME,sDESC)
;;
delimiter ;

-- ----------------------------
-- Procedure structure for Insert_StudProfile
-- ----------------------------
DROP PROCEDURE IF EXISTS `Insert_StudProfile`;
delimiter ;;
CREATE DEFINER="root"@"localhost" PROCEDURE "Insert_StudProfile"(IN `StudNO` VARCHAR(15), IN `FNAME` VARCHAR(100), IN `MNAME` VARCHAR(100), IN `LNAME` VARCHAR(100), IN `COUSRE` VARCHAR(15), IN `SECTION` VARCHAR(5), IN `GENDER` VARCHAR(10), IN `EMAIL` VARCHAR(100), IN `CONTACT` VARCHAR(20), IN `BDAY` DATE, IN `BPLACE` VARCHAR(500), IN `ADDRESS` VARCHAR(500), IN `STATUS` VARCHAR(50))
    NO SQL
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
)
;;
delimiter ;

-- ----------------------------
-- Procedure structure for Insert_Users
-- ----------------------------
DROP PROCEDURE IF EXISTS `Insert_Users`;
delimiter ;;
CREATE DEFINER=`root`@`localhost` PROCEDURE `Insert_Users`(IN `Username` VARCHAR(15), IN `referencedUser` VARCHAR(15), IN `userRole` ENUM('Administrator','OSAS HEAD','Organization','Student','Staff','Student Assistant'), IN `UPassword` VARCHAR(500))
    NO SQL
INSERT INTO `r_users` (`Users_USERNAME`, `Users_REFERENCED`, `Users_ROLES`,`Users_PASSWORD`) VALUES (Username,referencedUser,userRole,AES_Encrypt(UPassword,PASSWORD('OSASMIS')))
;;
delimiter ;

-- ----------------------------
-- Procedure structure for Insert_Voucher
-- ----------------------------
DROP PROCEDURE IF EXISTS `Insert_Voucher`;
delimiter ;;
CREATE DEFINER="root"@"localhost" PROCEDURE "Insert_Voucher"(IN `Vouch` VARCHAR(15), IN `org` VARCHAR(15), IN `checkk` VARCHAR(100))
    NO SQL
INSERT INTO `t_org_voucher` (`OrgVoucher_CASH_VOUCHER_NO`, `OrgVoucher_ORG_CODE`,`OrgVoucher_VOUCHED_BY`) VALUES ( Vouch, org, checkk)
;;
delimiter ;

-- ----------------------------
-- Procedure structure for Insert_Voucher_Item
-- ----------------------------
DROP PROCEDURE IF EXISTS `Insert_Voucher_Item`;
delimiter ;;
CREATE DEFINER="root"@"localhost" PROCEDURE "Insert_Voucher_Item"(IN `Vouch` VARCHAR(15), IN `itemss` VARCHAR(100), IN `amo` DOUBLE(10,3))
    NO SQL
INSERT INTO `t_org_voucher_items` (`OrgVouchItems_VOUCHER_NO`, `OrgVouchItems_ITEM_NAME`, `OrgVouchItems_AMOUNT`) VALUES (Vouch,itemss,amo)
;;
delimiter ;

-- ----------------------------
-- Procedure structure for login_check
-- ----------------------------
DROP PROCEDURE IF EXISTS `login_check`;
delimiter ;;
CREATE DEFINER=`root`@`localhost` PROCEDURE `login_check`(IN `username` VARCHAR(50), IN `userpass` VARCHAR(100))
    NO SQL
select * from r_users where Users_USERNAME = username and AES_DECRYPT(Users_PASSWORD,password('GC&SMS')) = userpass
;;
delimiter ;

-- ----------------------------
-- Procedure structure for Login_User
-- ----------------------------
DROP PROCEDURE IF EXISTS `Login_User`;
delimiter ;;
CREATE DEFINER="root"@"localhost" PROCEDURE "Login_User"(IN `username` VARCHAR(100), IN `password` VARCHAR(100))
    NO SQL
SELECT * 
FROM osas.r_users 
WHERE Users_USERNAME = username 
AND AES_DECRYPT(Users_PASSWORD , Password('OSASMIS')) =password
AND Users_DISPLAY_STAT = 'Active'
;;
delimiter ;

-- ----------------------------
-- Procedure structure for Log_Sanction
-- ----------------------------
DROP PROCEDURE IF EXISTS `Log_Sanction`;
delimiter ;;
CREATE DEFINER="root"@"localhost" PROCEDURE "Log_Sanction"(IN `SancID` INT, IN `Consuumed` INT, IN `Remarks` VARCHAR(100), IN `isFinish` ENUM('Processing','Finished'))
    NO SQL
INSERT INTO `log_sanction` ( `LogSanc_AssSancSudent_ID`, `LogSanc_CONSUMED_HOURS`, `LogSanc_REMARKS`, `LogSanc_IS_FINISH`) VALUES (SancID,Consuumed, Remarks, isFinish)
;;
delimiter ;

-- ----------------------------
-- Procedure structure for stud_counseling_add
-- ----------------------------
DROP PROCEDURE IF EXISTS `stud_counseling_add`;
delimiter ;;
CREATE DEFINER=`root`@`localhost` PROCEDURE `stud_counseling_add`(IN `visitRef` INT, IN `counsType` VARCHAR(50), IN `appmtType` VARCHAR(25), IN `studNo` VARCHAR(15), IN `bg` TEXT, IN `goal` TEXT, IN `commnt` TEXT, IN `recommendation` TEXT, IN `remarks` VARCHAR(50))
    NO SQL
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
end
;;
delimiter ;

-- ----------------------------
-- Procedure structure for stud_profile_add
-- ----------------------------
DROP PROCEDURE IF EXISTS `stud_profile_add`;
delimiter ;;
CREATE DEFINER=`root`@`localhost` PROCEDURE `stud_profile_add`(IN `studNo` VARCHAR(15), IN `fname` VARCHAR(100), IN `mname` VARCHAR(100), IN `lname` VARCHAR(100), IN `gender` VARCHAR(10), IN `course` VARCHAR(15), IN `yearLevel` INT(11), IN `section` VARCHAR(5), IN `bdate` DATE, IN `cityAddress` VARCHAR(500), IN `provAddress` VARCHAR(500), IN `telNo` VARCHAR(20), IN `mobNo` VARCHAR(20), IN `email` VARCHAR(100), IN `birthplace` VARCHAR(500), IN `stat` VARCHAR(20))
    NO SQL
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
	stat)
;;
delimiter ;

-- ----------------------------
-- Procedure structure for stud_visit_add
-- ----------------------------
DROP PROCEDURE IF EXISTS `stud_visit_add`;
delimiter ;;
CREATE DEFINER=`root`@`localhost` PROCEDURE `stud_visit_add`(IN `studNo` VARCHAR(15), IN `purpose` VARCHAR(50), IN `details` TEXT)
    NO SQL
begin
set @visitCode = (select concat('VS',(select date_format(CURRENT_TIMESTAMP,'%y-%c%d')),convert((select count(*) from t_stud_visit where date(Visit_DATE) = CURRENT_DATE),int)+1) as VisitCode);
insert into t_stud_visit (Visit_CODE,Stud_NO,Visit_PURPOSE,Visit_DETAILS)
values (@visitCode,studNo,purpose,details);
end
;;
delimiter ;

-- ----------------------------
-- Procedure structure for Update_AssignFinancialAss
-- ----------------------------
DROP PROCEDURE IF EXISTS `Update_AssignFinancialAss`;
delimiter ;;
CREATE DEFINER="root"@"localhost" PROCEDURE "Update_AssignFinancialAss"(IN `ID` INT, IN `FinanAssStat` ENUM('Active','Inactive','Void','Cancelled'), IN `Remarks` VARCHAR(500))
    NO SQL
UPDATE `t_assign_stud_finan_assistance` 
SET `AssStudFinanAssistance_STATUS` = FinanAssStat 
,`AssStudFinanAssistance_REMARKS` = Remarks
,`AssStudFinanAssistance_DATE_MOD` = CURRENT_TIMESTAMP
WHERE `AssStudFinanAssistance_ID` = ID
;;
delimiter ;

-- ----------------------------
-- Procedure structure for Update_AssignSanction
-- ----------------------------
DROP PROCEDURE IF EXISTS `Update_AssignSanction`;
delimiter ;;
CREATE DEFINER=`root`@`localhost` PROCEDURE `Update_AssignSanction`(IN `ID` INT, IN `Consume` INT, IN `Finish` ENUM('Finished','Processing'), IN `remarks` VARCHAR(100), IN `done` DATE)
    NO SQL
UPDATE `t_assign_stud_saction` SET 
`AssSancStudStudent_CONSUMED_HOURS` =Consume
,`AssSancStudStudent_IS_FINISH` = Finish
,`AssSancStudStudent_REMARKS` = remarks
,`AssSancStudStudent_TO_BE_DONE` = done
,`AssSancStudStudent_DATE_MOD` = CURRENT_TIMESTAMP
WHERE
`AssSancStudStudent_ID` =ID
;;
delimiter ;

-- ----------------------------
-- Procedure structure for Update_LossIDRegi
-- ----------------------------
DROP PROCEDURE IF EXISTS `Update_LossIDRegi`;
delimiter ;;
CREATE DEFINER="root"@"localhost" PROCEDURE "Update_LossIDRegi"(IN `ID` INT, IN `Claim` DATETIME, IN `Remarks` VARCHAR(500))
    NO SQL
update t_assign_stud_loss_id_regicard 
set AssLoss_DATE_CLAIM = Claim
,AssLoss_REMARKS = Remarks
where AssLoss_ID =ID
;;
delimiter ;

-- ----------------------------
-- Procedure structure for Update_StudProfile
-- ----------------------------
DROP PROCEDURE IF EXISTS `Update_StudProfile`;
delimiter ;;
CREATE DEFINER="root"@"localhost" PROCEDURE "Update_StudProfile"(IN `ID` INT(100), IN `StudNO` VARCHAR(15), IN `FNAME` VARCHAR(100), IN `MNAME` VARCHAR(100), IN `LNAME` VARCHAR(100), IN `COURSE` VARCHAR(15), IN `SECTION` VARCHAR(5), IN `GENDER` VARCHAR(10), IN `EMAIL` VARCHAR(100), IN `CONTACT` VARCHAR(20), IN `BDAY` DATE, IN `BPLACE` VARCHAR(500), IN `ADDRESS` VARCHAR(500), IN `STATUS` VARCHAR(50))
    NO SQL
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
WHERE `Stud_ID` = ID
;;
delimiter ;

-- ----------------------------
-- Procedure structure for upload_category_add
-- ----------------------------
DROP PROCEDURE IF EXISTS `upload_category_add`;
delimiter ;;
CREATE DEFINER=`root`@`localhost` PROCEDURE `upload_category_add`(IN `category` VARCHAR(100))
    NO SQL
insert into r_upload_category (Upload_FILE_CATEGORY) values (category)
;;
delimiter ;

-- ----------------------------
-- Procedure structure for View_Courses
-- ----------------------------
DROP PROCEDURE IF EXISTS `View_Courses`;
delimiter ;;
CREATE DEFINER="root"@"localhost" PROCEDURE "View_Courses"()
    NO SQL
select * from r_courses where course_display_stat ='active'
;;
delimiter ;

-- ----------------------------
-- Procedure structure for View_StudProfile
-- ----------------------------
DROP PROCEDURE IF EXISTS `View_StudProfile`;
delimiter ;;
CREATE DEFINER="root"@"localhost" PROCEDURE "View_StudProfile"()
    NO SQL
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
FROM osas.r_stud_profile
;;
delimiter ;

-- ----------------------------
-- Procedure structure for View_StudSanction
-- ----------------------------
DROP PROCEDURE IF EXISTS `View_StudSanction`;
delimiter ;;
CREATE DEFINER="root"@"localhost" PROCEDURE "View_StudSanction"()
    NO SQL
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
AND B.AssSancStudStudent_CONSUMED_HOURS <> C.SancDetails_TIMEVAL
;;
delimiter ;

-- ----------------------------
-- Procedure structure for visit_type_add
-- ----------------------------
DROP PROCEDURE IF EXISTS `visit_type_add`;
delimiter ;;
CREATE DEFINER=`root`@`localhost` PROCEDURE `visit_type_add`(IN `type` VARCHAR(50), IN `visitDesc` TEXT)
    NO SQL
insert into r_visit (Visit_TYPE,Visit_DESC)
values (type,if (visitDesc = '',null,visitDesc))
;;
delimiter ;

SET FOREIGN_KEY_CHECKS = 1;
