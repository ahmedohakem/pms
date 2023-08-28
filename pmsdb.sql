-- phpMyAdmin SQL Dump
-- version 5.2.1
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1:3306
-- Generation Time: Aug 28, 2023 at 01:00 PM
-- Server version: 8.1.0
-- PHP Version: 7.4.3-4ubuntu2.19

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `developmentpmsdb`
--

-- --------------------------------------------------------

--
-- Table structure for table `companies`
--

CREATE TABLE `companies` (
  `company_id` int NOT NULL,
  `company_name` varchar(200) CHARACTER SET utf8mb3 COLLATE utf8mb3_general_ci DEFAULT NULL,
  `company_logo` varchar(1000) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

-- --------------------------------------------------------

--
-- Table structure for table `competencies`
--

CREATE TABLE `competencies` (
  `comp_id` int NOT NULL,
  `comp_job_type` varchar(100) NOT NULL,
  `comp_year` year NOT NULL,
  `comp_text` varchar(2500) CHARACTER SET utf8mb3 COLLATE utf8mb3_bin NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

-- --------------------------------------------------------

--
-- Stand-in structure for view `comps_raits_avg_by_emp`
-- (See below for the actual view)
--
CREATE TABLE `comps_raits_avg_by_emp` (
`employee_id` int
,`comp_year` year
,`comps_raits_avg` decimal(13,2)
);

-- --------------------------------------------------------

--
-- Table structure for table `courses`
--

CREATE TABLE `courses` (
  `course_id` int NOT NULL,
  `course_name` varchar(1000) CHARACTER SET utf8mb3 COLLATE utf8mb3_general_ci NOT NULL,
  `course_year` year NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

-- --------------------------------------------------------

--
-- Table structure for table `departments`
--

CREATE TABLE `departments` (
  `department_id` int NOT NULL,
  `department_name` varchar(200) CHARACTER SET utf8mb3 COLLATE utf8mb3_general_ci NOT NULL,
  `department_code` varchar(10) CHARACTER SET utf8mb3 COLLATE utf8mb3_general_ci DEFAULT NULL,
  `company_id` int NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

-- --------------------------------------------------------

--
-- Table structure for table `employees`
--

CREATE TABLE `employees` (
  `employee_id` int NOT NULL,
  `first_name` varchar(100) CHARACTER SET utf8mb3 COLLATE utf8mb3_general_ci NOT NULL,
  `second_name` varchar(100) CHARACTER SET utf8mb3 COLLATE utf8mb3_general_ci NOT NULL,
  `third_name` varchar(100) CHARACTER SET utf8mb3 COLLATE utf8mb3_general_ci DEFAULT NULL,
  `fourth_name` varchar(100) CHARACTER SET utf8mb3 COLLATE utf8mb3_general_ci DEFAULT NULL,
  `company_id` int NOT NULL,
  `hire_date` date DEFAULT NULL,
  `department_id` int NOT NULL,
  `job_type` enum('Supervisor','Non-Supervisor') NOT NULL,
  `job_id` int NOT NULL,
  `job_grade_id` int DEFAULT NULL,
  `current_job_join_date` date DEFAULT NULL,
  `manager_employee_id` int DEFAULT NULL,
  `third_generation` varchar(1) DEFAULT NULL,
  `gender` enum('Male','Female') CHARACTER SET utf8mb3 COLLATE utf8mb3_general_ci DEFAULT NULL,
  `nationality_country_id` int DEFAULT NULL,
  `religion` varchar(200) CHARACTER SET utf8mb3 COLLATE utf8mb3_general_ci DEFAULT NULL,
  `date_of_birth` date DEFAULT NULL,
  `national_id` varchar(100) CHARACTER SET utf8mb3 COLLATE utf8mb3_general_ci DEFAULT NULL,
  `work_mobile_no` varchar(20) DEFAULT NULL,
  `personal_mobile_no` varchar(20) DEFAULT NULL,
  `extension_no` varchar(10) DEFAULT NULL,
  `work_email_address` varchar(200) CHARACTER SET utf8mb3 COLLATE utf8mb3_general_ci DEFAULT NULL,
  `home_address` varchar(1000) CHARACTER SET utf8mb3 COLLATE utf8mb3_general_ci DEFAULT NULL,
  `employee_status` enum('ACTIVE','INACTIVE') NOT NULL,
  `deleted` int NOT NULL DEFAULT '0',
  `recorded_timestamp` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP,
  `recorded_by_user_id` int NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Triggers `employees`
--
DELIMITER $$
CREATE TRIGGER `employee_info_update_history_trigger` BEFORE UPDATE ON `employees` FOR EACH ROW BEGIN
  IF NEW.first_name != OLD.first_name
  THEN
      INSERT INTO `employee_info_update_history` (`employee_id`, `first_name`, `second_name`, `third_name`, `fourth_name`, `company_id`, `hire_date`, `department_id`, `job_type`, `job_id`, `job_grade_id`, `current_job_join_date`, `manager_employee_id`, `gender`, `nationality_country_id`, `date_of_birth`, `national_id`, `work_mobile_no`, `personal_mobile_no`, `extension_no`, `work_email_address`, `home_address`, `employee_status`, `deleted`, `recorded_timestamp`, `recorded_by_user_id`, `column_updated`, `new_value`, `updated_by_user_id`)
	  VALUES (old.employee_id, old.first_name, old.second_name, old.third_name, old.fourth_name, old.company_id, old.hire_date, old.department_id, old.job_type, old.job_id, old.job_grade_id, old.current_job_join_date, old.manager_employee_id, old.gender, old.nationality_country_id, old.date_of_birth, old.national_id, old.work_mobile_no, old.personal_mobile_no, old.extension_no, old.work_email_address, old.home_address, old.employee_status, old.deleted, old.recorded_timestamp, old.recorded_by_user_id, 'first_name', new.first_name, @usersession);
  END IF;
  IF NEW.second_name != OLD.second_name
  THEN
      INSERT INTO `employee_info_update_history` (`employee_id`, `first_name`, `second_name`, `third_name`, `fourth_name`, `company_id`, `hire_date`, `department_id`, `job_type`, `job_id`, `job_grade_id`, `current_job_join_date`, `manager_employee_id`, `gender`, `nationality_country_id`, `date_of_birth`, `national_id`, `work_mobile_no`, `personal_mobile_no`, `extension_no`, `work_email_address`, `home_address`, `employee_status`, `deleted`, `recorded_timestamp`, `recorded_by_user_id`, `column_updated`, `new_value`, `updated_by_user_id`)
	  VALUES (old.employee_id, old.first_name, old.second_name, old.third_name, old.fourth_name, old.company_id, old.hire_date, old.department_id, old.job_type, old.job_id, old.job_grade_id, old.current_job_join_date, old.manager_employee_id, old.gender, old.nationality_country_id, old.date_of_birth, old.national_id, old.work_mobile_no, old.personal_mobile_no, old.extension_no, old.work_email_address, old.home_address, old.employee_status, old.deleted, old.recorded_timestamp, old.recorded_by_user_id, 'second_name', new.second_name, @usersession);
  END IF;
  IF NEW.third_name != OLD.third_name
  THEN
      INSERT INTO `employee_info_update_history` (`employee_id`, `first_name`, `second_name`, `third_name`, `fourth_name`, `company_id`, `hire_date`, `department_id`, `job_type`, `job_id`, `job_grade_id`, `current_job_join_date`, `manager_employee_id`, `gender`, `nationality_country_id`, `date_of_birth`, `national_id`, `work_mobile_no`, `personal_mobile_no`, `extension_no`, `work_email_address`, `home_address`, `employee_status`, `deleted`, `recorded_timestamp`, `recorded_by_user_id`, `column_updated`, `new_value`, `updated_by_user_id`)
	  VALUES (old.employee_id, old.first_name, old.second_name, old.third_name, old.fourth_name, old.company_id, old.hire_date, old.department_id, old.job_type, old.job_id, old.job_grade_id, old.current_job_join_date, old.manager_employee_id, old.gender, old.nationality_country_id, old.date_of_birth, old.national_id, old.work_mobile_no, old.personal_mobile_no, old.extension_no, old.work_email_address, old.home_address, old.employee_status, old.deleted, old.recorded_timestamp, old.recorded_by_user_id, 'third_name', new.third_name, @usersession);
  END IF;
  IF NEW.fourth_name != OLD.fourth_name
  THEN
      INSERT INTO `employee_info_update_history` (`employee_id`, `first_name`, `second_name`, `third_name`, `fourth_name`, `company_id`, `hire_date`, `department_id`, `job_type`, `job_id`, `job_grade_id`, `current_job_join_date`, `manager_employee_id`, `gender`, `nationality_country_id`, `date_of_birth`, `national_id`, `work_mobile_no`, `personal_mobile_no`, `extension_no`, `work_email_address`, `home_address`, `employee_status`, `deleted`, `recorded_timestamp`, `recorded_by_user_id`, `column_updated`, `new_value`, `updated_by_user_id`)
	  VALUES (old.employee_id, old.first_name, old.second_name, old.third_name, old.fourth_name, old.company_id, old.hire_date, old.department_id, old.job_type, old.job_id, old.job_grade_id, old.current_job_join_date, old.manager_employee_id, old.gender, old.nationality_country_id, old.date_of_birth, old.national_id, old.work_mobile_no, old.personal_mobile_no, old.extension_no, old.work_email_address, old.home_address, old.employee_status, old.deleted, old.recorded_timestamp, old.recorded_by_user_id, 'fourth_name', new.fourth_name, @usersession);
  END IF;
  IF NEW.company_id != OLD.company_id
  THEN
      INSERT INTO `employee_info_update_history` (`employee_id`, `first_name`, `second_name`, `third_name`, `fourth_name`, `company_id`, `hire_date`, `department_id`, `job_type`, `job_id`, `job_grade_id`, `current_job_join_date`, `manager_employee_id`, `gender`, `nationality_country_id`, `date_of_birth`, `national_id`, `work_mobile_no`, `personal_mobile_no`, `extension_no`, `work_email_address`, `home_address`, `employee_status`, `deleted`, `recorded_timestamp`, `recorded_by_user_id`, `column_updated`, `new_value`, `updated_by_user_id`)
	  VALUES (old.employee_id, old.first_name, old.second_name, old.third_name, old.fourth_name, old.company_id, old.hire_date, old.department_id, old.job_type, old.job_id, old.job_grade_id, old.current_job_join_date, old.manager_employee_id, old.gender, old.nationality_country_id, old.date_of_birth, old.national_id, old.work_mobile_no, old.personal_mobile_no, old.extension_no, old.work_email_address, old.home_address, old.employee_status, old.deleted, old.recorded_timestamp, old.recorded_by_user_id, 'company_id', new.company_id, @usersession);
  END IF;
  IF NEW.hire_date != OLD.hire_date
  THEN
      INSERT INTO `employee_info_update_history` (`employee_id`, `first_name`, `second_name`, `third_name`, `fourth_name`, `company_id`, `hire_date`, `department_id`, `job_type`, `job_id`, `job_grade_id`, `current_job_join_date`, `manager_employee_id`, `gender`, `nationality_country_id`, `date_of_birth`, `national_id`, `work_mobile_no`, `personal_mobile_no`, `extension_no`, `work_email_address`, `home_address`, `employee_status`, `deleted`, `recorded_timestamp`, `recorded_by_user_id`, `column_updated`, `new_value`, `updated_by_user_id`)
	  VALUES (old.employee_id, old.first_name, old.second_name, old.third_name, old.fourth_name, old.company_id, old.hire_date, old.department_id, old.job_type, old.job_id, old.job_grade_id, old.current_job_join_date, old.manager_employee_id, old.gender, old.nationality_country_id, old.date_of_birth, old.national_id, old.work_mobile_no, old.personal_mobile_no, old.extension_no, old.work_email_address, old.home_address, old.employee_status, old.deleted, old.recorded_timestamp, old.recorded_by_user_id, 'hire_date', new.hire_date, @usersession);
  END IF;
  IF NEW.department_id != OLD.department_id
  THEN
      INSERT INTO `employee_info_update_history` (`employee_id`, `first_name`, `second_name`, `third_name`, `fourth_name`, `company_id`, `hire_date`, `department_id`, `job_type`, `job_id`, `job_grade_id`, `current_job_join_date`, `manager_employee_id`, `gender`, `nationality_country_id`, `date_of_birth`, `national_id`, `work_mobile_no`, `personal_mobile_no`, `extension_no`, `work_email_address`, `home_address`, `employee_status`, `deleted`, `recorded_timestamp`, `recorded_by_user_id`, `column_updated`, `new_value`, `updated_by_user_id`)
	  VALUES (old.employee_id, old.first_name, old.second_name, old.third_name, old.fourth_name, old.company_id, old.hire_date, old.department_id, old.job_type, old.job_id, old.job_grade_id, old.current_job_join_date, old.manager_employee_id, old.gender, old.nationality_country_id, old.date_of_birth, old.national_id, old.work_mobile_no, old.personal_mobile_no, old.extension_no, old.work_email_address, old.home_address, old.employee_status, old.deleted, old.recorded_timestamp, old.recorded_by_user_id, 'department_id', new.department_id, @usersession);
  END IF;
  IF NEW.job_type != OLD.job_type
  THEN
      INSERT INTO `employee_info_update_history` (`employee_id`, `first_name`, `second_name`, `third_name`, `fourth_name`, `company_id`, `hire_date`, `department_id`, `job_type`, `job_id`, `job_grade_id`, `current_job_join_date`, `manager_employee_id`, `gender`, `nationality_country_id`, `date_of_birth`, `national_id`, `work_mobile_no`, `personal_mobile_no`, `extension_no`, `work_email_address`, `home_address`, `employee_status`, `deleted`, `recorded_timestamp`, `recorded_by_user_id`, `column_updated`, `new_value`, `updated_by_user_id`)
	  VALUES (old.employee_id, old.first_name, old.second_name, old.third_name, old.fourth_name, old.company_id, old.hire_date, old.department_id, old.job_type, old.job_id, old.job_grade_id, old.current_job_join_date, old.manager_employee_id, old.gender, old.nationality_country_id, old.date_of_birth, old.national_id, old.work_mobile_no, old.personal_mobile_no, old.extension_no, old.work_email_address, old.home_address, old.employee_status, old.deleted, old.recorded_timestamp, old.recorded_by_user_id, 'job_type', new.job_type, @usersession);
  END IF;
  IF NEW.job_id != OLD.job_id
  THEN
      INSERT INTO `employee_info_update_history` (`employee_id`, `first_name`, `second_name`, `third_name`, `fourth_name`, `company_id`, `hire_date`, `department_id`, `job_type`, `job_id`, `job_grade_id`, `current_job_join_date`, `manager_employee_id`, `gender`, `nationality_country_id`, `date_of_birth`, `national_id`, `work_mobile_no`, `personal_mobile_no`, `extension_no`, `work_email_address`, `home_address`, `employee_status`, `deleted`, `recorded_timestamp`, `recorded_by_user_id`, `column_updated`, `new_value`, `updated_by_user_id`)
	  VALUES (old.employee_id, old.first_name, old.second_name, old.third_name, old.fourth_name, old.company_id, old.hire_date, old.department_id, old.job_type, old.job_id, old.job_grade_id, old.current_job_join_date, old.manager_employee_id, old.gender, old.nationality_country_id, old.date_of_birth, old.national_id, old.work_mobile_no, old.personal_mobile_no, old.extension_no, old.work_email_address, old.home_address, old.employee_status, old.deleted, old.recorded_timestamp, old.recorded_by_user_id, 'job_id', new.job_id, @usersession);
  END IF;  
  IF NEW.job_grade_id != OLD.job_grade_id
  THEN
      INSERT INTO `employee_info_update_history` (`employee_id`, `first_name`, `second_name`, `third_name`, `fourth_name`, `company_id`, `hire_date`, `department_id`, `job_type`, `job_id`, `job_grade_id`, `current_job_join_date`, `manager_employee_id`, `gender`, `nationality_country_id`, `date_of_birth`, `national_id`, `work_mobile_no`, `personal_mobile_no`, `extension_no`, `work_email_address`, `home_address`, `employee_status`, `deleted`, `recorded_timestamp`, `recorded_by_user_id`, `column_updated`, `new_value`, `updated_by_user_id`)
	  VALUES (old.employee_id, old.first_name, old.second_name, old.third_name, old.fourth_name, old.company_id, old.hire_date, old.department_id, old.job_type, old.job_id, old.job_grade_id, old.current_job_join_date, old.manager_employee_id, old.gender, old.nationality_country_id, old.date_of_birth, old.national_id, old.work_mobile_no, old.personal_mobile_no, old.extension_no, old.work_email_address, old.home_address, old.employee_status, old.deleted, old.recorded_timestamp, old.recorded_by_user_id, 'job_grade_id', new.job_grade_id, @usersession);
  END IF;
  IF NEW.current_job_join_date != OLD.current_job_join_date
  THEN
      INSERT INTO `employee_info_update_history` (`employee_id`, `first_name`, `second_name`, `third_name`, `fourth_name`, `company_id`, `hire_date`, `department_id`, `job_type`, `job_id`, `job_grade_id`, `current_job_join_date`, `manager_employee_id`, `gender`, `nationality_country_id`, `date_of_birth`, `national_id`, `work_mobile_no`, `personal_mobile_no`, `extension_no`, `work_email_address`, `home_address`, `employee_status`, `deleted`, `recorded_timestamp`, `recorded_by_user_id`, `column_updated`, `new_value`, `updated_by_user_id`)
	  VALUES (old.employee_id, old.first_name, old.second_name, old.third_name, old.fourth_name, old.company_id, old.hire_date, old.department_id, old.job_type, old.job_id, old.job_grade_id, old.current_job_join_date, old.manager_employee_id, old.gender, old.nationality_country_id, old.date_of_birth, old.national_id, old.work_mobile_no, old.personal_mobile_no, old.extension_no, old.work_email_address, old.home_address, old.employee_status, old.deleted, old.recorded_timestamp, old.recorded_by_user_id, 'current_job_join_date', new.current_job_join_date, @usersession);
  END IF;
  IF NEW.manager_employee_id != OLD.manager_employee_id
  THEN
      INSERT INTO `employee_info_update_history` (`employee_id`, `first_name`, `second_name`, `third_name`, `fourth_name`, `company_id`, `hire_date`, `department_id`, `job_type`, `job_id`, `job_grade_id`, `current_job_join_date`, `manager_employee_id`, `gender`, `nationality_country_id`, `date_of_birth`, `national_id`, `work_mobile_no`, `personal_mobile_no`, `extension_no`, `work_email_address`, `home_address`, `employee_status`, `deleted`, `recorded_timestamp`, `recorded_by_user_id`, `column_updated`, `new_value`, `updated_by_user_id`)
	  VALUES (old.employee_id, old.first_name, old.second_name, old.third_name, old.fourth_name, old.company_id, old.hire_date, old.department_id, old.job_type, old.job_id, old.job_grade_id, old.current_job_join_date, old.manager_employee_id, old.gender, old.nationality_country_id, old.date_of_birth, old.national_id, old.work_mobile_no, old.personal_mobile_no, old.extension_no, old.work_email_address, old.home_address, old.employee_status, old.deleted, old.recorded_timestamp, old.recorded_by_user_id, 'manager_employee_id', new.manager_employee_id, @usersession);
  END IF;
  IF NEW.gender != OLD.gender
  THEN
      INSERT INTO `employee_info_update_history` (`employee_id`, `first_name`, `second_name`, `third_name`, `fourth_name`, `company_id`, `hire_date`, `department_id`, `job_type`, `job_id`, `job_grade_id`, `current_job_join_date`, `manager_employee_id`, `gender`, `nationality_country_id`, `date_of_birth`, `national_id`, `work_mobile_no`, `personal_mobile_no`, `extension_no`, `work_email_address`, `home_address`, `employee_status`, `deleted`, `recorded_timestamp`, `recorded_by_user_id`, `column_updated`, `new_value`, `updated_by_user_id`)
	  VALUES (old.employee_id, old.first_name, old.second_name, old.third_name, old.fourth_name, old.company_id, old.hire_date, old.department_id, old.job_type, old.job_id, old.job_grade_id, old.current_job_join_date, old.manager_employee_id, old.gender, old.nationality_country_id, old.date_of_birth, old.national_id, old.work_mobile_no, old.personal_mobile_no, old.extension_no, old.work_email_address, old.home_address, old.employee_status, old.deleted, old.recorded_timestamp, old.recorded_by_user_id, 'gender', new.gender, @usersession);
  END IF;
  IF NEW.nationality_country_id != OLD.nationality_country_id
  THEN
      INSERT INTO `employee_info_update_history` (`employee_id`, `first_name`, `second_name`, `third_name`, `fourth_name`, `company_id`, `hire_date`, `department_id`, `job_type`, `job_id`, `job_grade_id`, `current_job_join_date`, `manager_employee_id`, `gender`, `nationality_country_id`, `date_of_birth`, `national_id`, `work_mobile_no`, `personal_mobile_no`, `extension_no`, `work_email_address`, `home_address`, `employee_status`, `deleted`, `recorded_timestamp`, `recorded_by_user_id`, `column_updated`, `new_value`, `updated_by_user_id`)
	  VALUES (old.employee_id, old.first_name, old.second_name, old.third_name, old.fourth_name, old.company_id, old.hire_date, old.department_id, old.job_type, old.job_id, old.job_grade_id, old.current_job_join_date, old.manager_employee_id, old.gender, old.nationality_country_id, old.date_of_birth, old.national_id, old.work_mobile_no, old.personal_mobile_no, old.extension_no, old.work_email_address, old.home_address, old.employee_status, old.deleted, old.recorded_timestamp, old.recorded_by_user_id, 'nationality_country_id', new.nationality_country_id, @usersession);
  END IF;
  IF NEW.date_of_birth != OLD.date_of_birth
  THEN
      INSERT INTO `employee_info_update_history` (`employee_id`, `first_name`, `second_name`, `third_name`, `fourth_name`, `company_id`, `hire_date`, `department_id`, `job_type`, `job_id`, `job_grade_id`, `current_job_join_date`, `manager_employee_id`, `gender`, `nationality_country_id`, `date_of_birth`, `national_id`, `work_mobile_no`, `personal_mobile_no`, `extension_no`, `work_email_address`, `home_address`, `employee_status`, `deleted`, `recorded_timestamp`, `recorded_by_user_id`, `column_updated`, `new_value`, `updated_by_user_id`)
	  VALUES (old.employee_id, old.first_name, old.second_name, old.third_name, old.fourth_name, old.company_id, old.hire_date, old.department_id, old.job_type, old.job_id, old.job_grade_id, old.current_job_join_date, old.manager_employee_id, old.gender, old.nationality_country_id, old.date_of_birth, old.national_id, old.work_mobile_no, old.personal_mobile_no, old.extension_no, old.work_email_address, old.home_address, old.employee_status, old.deleted, old.recorded_timestamp, old.recorded_by_user_id, 'date_of_birth', new.date_of_birth, @usersession);
  END IF;
  IF NEW.national_id != OLD.national_id
  THEN
      INSERT INTO `employee_info_update_history` (`employee_id`, `first_name`, `second_name`, `third_name`, `fourth_name`, `company_id`, `hire_date`, `department_id`, `job_type`, `job_id`, `job_grade_id`, `current_job_join_date`, `manager_employee_id`, `gender`, `nationality_country_id`, `date_of_birth`, `national_id`, `work_mobile_no`, `personal_mobile_no`, `extension_no`, `work_email_address`, `home_address`, `employee_status`, `deleted`, `recorded_timestamp`, `recorded_by_user_id`, `column_updated`, `new_value`, `updated_by_user_id`)
	  VALUES (old.employee_id, old.first_name, old.second_name, old.third_name, old.fourth_name, old.company_id, old.hire_date, old.department_id, old.job_type, old.job_id, old.job_grade_id, old.current_job_join_date, old.manager_employee_id, old.gender, old.nationality_country_id, old.date_of_birth, old.national_id, old.work_mobile_no, old.personal_mobile_no, old.extension_no, old.work_email_address, old.home_address, old.employee_status, old.deleted, old.recorded_timestamp, old.recorded_by_user_id, 'national_id', new.national_id, @usersession);
  END IF;
  IF NEW.work_mobile_no != OLD.work_mobile_no
  THEN
      INSERT INTO `employee_info_update_history` (`employee_id`, `first_name`, `second_name`, `third_name`, `fourth_name`, `company_id`, `hire_date`, `department_id`, `job_type`, `job_id`, `job_grade_id`, `current_job_join_date`, `manager_employee_id`, `gender`, `nationality_country_id`, `date_of_birth`, `national_id`, `work_mobile_no`, `personal_mobile_no`, `extension_no`, `work_email_address`, `home_address`, `employee_status`, `deleted`, `recorded_timestamp`, `recorded_by_user_id`, `column_updated`, `new_value`, `updated_by_user_id`)
	  VALUES (old.employee_id, old.first_name, old.second_name, old.third_name, old.fourth_name, old.company_id, old.hire_date, old.department_id, old.job_type, old.job_id, old.job_grade_id, old.current_job_join_date, old.manager_employee_id, old.gender, old.nationality_country_id, old.date_of_birth, old.national_id, old.work_mobile_no, old.personal_mobile_no, old.extension_no, old.work_email_address, old.home_address, old.employee_status, old.deleted, old.recorded_timestamp, old.recorded_by_user_id, 'work_mobile_no', new.work_mobile_no, @usersession);
  END IF;
  IF NEW.personal_mobile_no != OLD.personal_mobile_no
  THEN
      INSERT INTO `employee_info_update_history` (`employee_id`, `first_name`, `second_name`, `third_name`, `fourth_name`, `company_id`, `hire_date`, `department_id`, `job_type`, `job_id`, `job_grade_id`, `current_job_join_date`, `manager_employee_id`, `gender`, `nationality_country_id`, `date_of_birth`, `national_id`, `work_mobile_no`, `personal_mobile_no`, `extension_no`, `work_email_address`, `home_address`, `employee_status`, `deleted`, `recorded_timestamp`, `recorded_by_user_id`, `column_updated`, `new_value`, `updated_by_user_id`)
	  VALUES (old.employee_id, old.first_name, old.second_name, old.third_name, old.fourth_name, old.company_id, old.hire_date, old.department_id, old.job_type, old.job_id, old.job_grade_id, old.current_job_join_date, old.manager_employee_id, old.gender, old.nationality_country_id, old.date_of_birth, old.national_id, old.work_mobile_no, old.personal_mobile_no, old.extension_no, old.work_email_address, old.home_address, old.employee_status, old.deleted, old.recorded_timestamp, old.recorded_by_user_id, 'personal_mobile_no', new.personal_mobile_no, @usersession);
  END IF;
  IF NEW.extension_no != OLD.extension_no
  THEN
      INSERT INTO `employee_info_update_history` (`employee_id`, `first_name`, `second_name`, `third_name`, `fourth_name`, `company_id`, `hire_date`, `department_id`, `job_type`, `job_id`, `job_grade_id`, `current_job_join_date`, `manager_employee_id`, `gender`, `nationality_country_id`, `date_of_birth`, `national_id`, `work_mobile_no`, `personal_mobile_no`, `extension_no`, `work_email_address`, `home_address`, `employee_status`, `deleted`, `recorded_timestamp`, `recorded_by_user_id`, `column_updated`, `new_value`, `updated_by_user_id`)
	  VALUES (old.employee_id, old.first_name, old.second_name, old.third_name, old.fourth_name, old.company_id, old.hire_date, old.department_id, old.job_type, old.job_id, old.job_grade_id, old.current_job_join_date, old.manager_employee_id, old.gender, old.nationality_country_id, old.date_of_birth, old.national_id, old.work_mobile_no, old.personal_mobile_no, old.extension_no, old.work_email_address, old.home_address, old.employee_status, old.deleted, old.recorded_timestamp, old.recorded_by_user_id, 'extension_no', new.extension_no, @usersession);
  END IF;
  IF NEW.work_email_address != OLD.work_email_address
  THEN
      INSERT INTO `employee_info_update_history` (`employee_id`, `first_name`, `second_name`, `third_name`, `fourth_name`, `company_id`, `hire_date`, `department_id`, `job_type`, `job_id`, `job_grade_id`, `current_job_join_date`, `manager_employee_id`, `gender`, `nationality_country_id`, `date_of_birth`, `national_id`, `work_mobile_no`, `personal_mobile_no`, `extension_no`, `work_email_address`, `home_address`, `employee_status`, `deleted`, `recorded_timestamp`, `recorded_by_user_id`, `column_updated`, `new_value`, `updated_by_user_id`)
	  VALUES (old.employee_id, old.first_name, old.second_name, old.third_name, old.fourth_name, old.company_id, old.hire_date, old.department_id, old.job_type, old.job_id, old.job_grade_id, old.current_job_join_date, old.manager_employee_id, old.gender, old.nationality_country_id, old.date_of_birth, old.national_id, old.work_mobile_no, old.personal_mobile_no, old.extension_no, old.work_email_address, old.home_address, old.employee_status, old.deleted, old.recorded_timestamp, old.recorded_by_user_id, 'work_email_address', new.work_email_address, @usersession);
  END IF;
  IF NEW.home_address != OLD.home_address
  THEN
      INSERT INTO `employee_info_update_history` (`employee_id`, `first_name`, `second_name`, `third_name`, `fourth_name`, `company_id`, `hire_date`, `department_id`, `job_type`, `job_id`, `job_grade_id`, `current_job_join_date`, `manager_employee_id`, `gender`, `nationality_country_id`, `date_of_birth`, `national_id`, `work_mobile_no`, `personal_mobile_no`, `extension_no`, `work_email_address`, `home_address`, `employee_status`, `deleted`, `recorded_timestamp`, `recorded_by_user_id`, `column_updated`, `new_value`, `updated_by_user_id`)
	  VALUES (old.employee_id, old.first_name, old.second_name, old.third_name, old.fourth_name, old.company_id, old.hire_date, old.department_id, old.job_type, old.job_id, old.job_grade_id, old.current_job_join_date, old.manager_employee_id, old.gender, old.nationality_country_id, old.date_of_birth, old.national_id, old.work_mobile_no, old.personal_mobile_no, old.extension_no, old.work_email_address, old.home_address, old.employee_status, old.deleted, old.recorded_timestamp, old.recorded_by_user_id, 'home_address', new.home_address, @usersession);
  END IF;
  IF NEW.employee_status != OLD.employee_status
  THEN
      INSERT INTO `employee_info_update_history` (`employee_id`, `first_name`, `second_name`, `third_name`, `fourth_name`, `company_id`, `hire_date`, `department_id`, `job_type`, `job_id`, `job_grade_id`, `current_job_join_date`, `manager_employee_id`, `gender`, `nationality_country_id`, `date_of_birth`, `national_id`, `work_mobile_no`, `personal_mobile_no`, `extension_no`, `work_email_address`, `home_address`, `employee_status`, `deleted`, `recorded_timestamp`, `recorded_by_user_id`, `column_updated`, `new_value`, `updated_by_user_id`)
	  VALUES (old.employee_id, old.first_name, old.second_name, old.third_name, old.fourth_name, old.company_id, old.hire_date, old.department_id, old.job_type, old.job_id, old.job_grade_id, old.current_job_join_date, old.manager_employee_id, old.gender, old.nationality_country_id, old.date_of_birth, old.national_id, old.work_mobile_no, old.personal_mobile_no, old.extension_no, old.work_email_address, old.home_address, old.employee_status, old.deleted, old.recorded_timestamp, old.recorded_by_user_id, 'employee_status', new.employee_status, @usersession);
  END IF;
  IF NEW.deleted != OLD.deleted
  THEN
      INSERT INTO `employee_info_update_history` (`employee_id`, `first_name`, `second_name`, `third_name`, `fourth_name`, `company_id`, `hire_date`, `department_id`, `job_type`, `job_id`, `job_grade_id`, `current_job_join_date`, `manager_employee_id`, `gender`, `nationality_country_id`, `date_of_birth`, `national_id`, `work_mobile_no`, `personal_mobile_no`, `extension_no`, `work_email_address`, `home_address`, `employee_status`, `deleted`, `recorded_timestamp`, `recorded_by_user_id`, `column_updated`, `new_value`, `updated_by_user_id`)
	  VALUES (old.employee_id, old.first_name, old.second_name, old.third_name, old.fourth_name, old.company_id, old.hire_date, old.department_id, old.job_type, old.job_id, old.job_grade_id, old.current_job_join_date, old.manager_employee_id, old.gender, old.nationality_country_id, old.date_of_birth, old.national_id, old.work_mobile_no, old.personal_mobile_no, old.extension_no, old.work_email_address, old.home_address, old.employee_status, old.deleted, old.recorded_timestamp, old.recorded_by_user_id, 'deleted', new.deleted, @usersession);
  END IF;
  END
$$
DELIMITER ;

-- --------------------------------------------------------

--
-- Table structure for table `employees_competencies`
--

CREATE TABLE `employees_competencies` (
  `employee_id` int NOT NULL,
  `comp_id` int NOT NULL,
  `comp_rating` int DEFAULT NULL,
  `recorded_timestamp` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

-- --------------------------------------------------------

--
-- Table structure for table `employees_work_dimensions`
--

CREATE TABLE `employees_work_dimensions` (
  `employee_id` int NOT NULL,
  `wd_id` int NOT NULL,
  `wd_rating` int DEFAULT NULL,
  `recorded_timestamp` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

-- --------------------------------------------------------

--
-- Stand-in structure for view `employee_details`
-- (See below for the actual view)
--
CREATE TABLE `employee_details` (
`employee_id` int
,`first_name` varchar(100)
,`second_name` varchar(100)
,`third_name` varchar(100)
,`fourth_name` varchar(100)
,`full_name` varchar(403)
,`company_id` int
,`company_name` varchar(200)
,`hire_date` date
,`department_id` int
,`department_name` varchar(200)
,`job_type` enum('Supervisor','Non-Supervisor')
,`job_id` int
,`job_title` varchar(150)
,`job_grade_id` int
,`job_grade` varchar(123)
,`current_job_join_date` date
,`manager_employee_id` int
,`third_generation` varchar(1)
,`manager_full_name` varchar(403)
,`reviewing_manager_employee_id` int
,`reviewing_manager_full_name` varchar(403)
,`gender` enum('Male','Female')
,`nationality_country_id` int
,`nationality_country_name` varchar(100)
,`religion` varchar(200)
,`date_of_birth` date
,`national_id` varchar(100)
,`work_mobile_no` varchar(20)
,`personal_mobile_no` varchar(20)
,`extension_no` varchar(10)
,`work_email_address` varchar(200)
,`home_address` varchar(1000)
,`employee_status` enum('ACTIVE','INACTIVE')
,`deleted` int
);

-- --------------------------------------------------------

--
-- Table structure for table `employee_info_update_history`
--

CREATE TABLE `employee_info_update_history` (
  `record_id` int NOT NULL,
  `employee_id` int NOT NULL DEFAULT '0',
  `first_name` varchar(100) CHARACTER SET utf8mb3 COLLATE utf8mb3_general_ci NOT NULL,
  `second_name` varchar(100) CHARACTER SET utf8mb3 COLLATE utf8mb3_general_ci NOT NULL,
  `third_name` varchar(100) CHARACTER SET utf8mb3 COLLATE utf8mb3_general_ci DEFAULT NULL,
  `fourth_name` varchar(100) CHARACTER SET utf8mb3 COLLATE utf8mb3_general_ci DEFAULT NULL,
  `company_id` int NOT NULL,
  `hire_date` date DEFAULT NULL,
  `department_id` int NOT NULL,
  `job_type` enum('Supervisor','Non-Supervisor') NOT NULL,
  `job_id` int NOT NULL,
  `job_grade_id` int DEFAULT NULL,
  `current_job_join_date` date DEFAULT NULL,
  `manager_employee_id` int DEFAULT NULL,
  `gender` enum('Male','Female') CHARACTER SET utf8mb3 COLLATE utf8mb3_general_ci DEFAULT NULL,
  `nationality_country_id` int DEFAULT NULL,
  `date_of_birth` date DEFAULT NULL,
  `national_id` varchar(100) CHARACTER SET utf8mb3 COLLATE utf8mb3_general_ci DEFAULT NULL,
  `work_mobile_no` varchar(20) DEFAULT NULL,
  `personal_mobile_no` varchar(20) DEFAULT NULL,
  `extension_no` varchar(10) DEFAULT NULL,
  `work_email_address` varchar(200) CHARACTER SET utf8mb3 COLLATE utf8mb3_general_ci DEFAULT NULL,
  `home_address` varchar(1000) CHARACTER SET utf8mb3 COLLATE utf8mb3_general_ci DEFAULT NULL,
  `employee_status` enum('ACTIVE','INACTIVE') NOT NULL,
  `deleted` int NOT NULL,
  `recorded_timestamp` timestamp NULL DEFAULT NULL,
  `recorded_by_user_id` int NOT NULL,
  `column_updated` varchar(120) CHARACTER SET utf8mb3 COLLATE utf8mb3_general_ci NOT NULL,
  `new_value` varchar(1000) CHARACTER SET utf8mb3 COLLATE utf8mb3_general_ci NOT NULL,
  `updated_timestamp` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP,
  `updated_by_user_id` int DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

-- --------------------------------------------------------

--
-- Table structure for table `fc_emps`
--

CREATE TABLE `fc_emps` (
  `record_id` int NOT NULL,
  `employee_id` int NOT NULL,
  `cycle_year` year NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

-- --------------------------------------------------------

--
-- Table structure for table `form_tracker`
--

CREATE TABLE `form_tracker` (
  `record_id` int NOT NULL,
  `employee_id` int NOT NULL,
  `status_code` int NOT NULL,
  `status_text` varchar(100) CHARACTER SET utf8mb3 COLLATE utf8mb3_general_ci NOT NULL,
  `reviewing_manager_comment` varchar(5000) CHARACTER SET utf8mb3 COLLATE utf8mb3_general_ci DEFAULT NULL,
  `status_timestamp` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

-- --------------------------------------------------------

--
-- Table structure for table `jobs`
--

CREATE TABLE `jobs` (
  `job_id` int NOT NULL,
  `job_title` varchar(150) CHARACTER SET utf8mb3 COLLATE utf8mb3_general_ci NOT NULL,
  `company_id` int NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

-- --------------------------------------------------------

--
-- Table structure for table `jobs_grades`
--

CREATE TABLE `jobs_grades` (
  `job_grade_id` int NOT NULL,
  `category` varchar(100) CHARACTER SET utf8mb3 COLLATE utf8mb3_general_ci DEFAULT NULL,
  `level` varchar(7) CHARACTER SET utf8mb3 COLLATE utf8mb3_general_ci DEFAULT NULL,
  `grade_no` int DEFAULT NULL,
  `grade_letter` varchar(1) CHARACTER SET utf8mb3 COLLATE utf8mb3_general_ci DEFAULT NULL,
  `scale_type` varchar(1) NOT NULL,
  `company_id` int NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

-- --------------------------------------------------------

--
-- Table structure for table `months`
--

CREATE TABLE `months` (
  `month_id` int NOT NULL,
  `month_name` varchar(30) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

-- --------------------------------------------------------

--
-- Table structure for table `nationalities_countries`
--

CREATE TABLE `nationalities_countries` (
  `nationality_country_id` int NOT NULL,
  `nationality_country_code` varchar(2) DEFAULT NULL,
  `nationality_country_name` varchar(100) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb3;

-- --------------------------------------------------------

--
-- Table structure for table `objectives`
--

CREATE TABLE `objectives` (
  `obj_id` int NOT NULL,
  `employee_id` int NOT NULL,
  `obj_year` year NOT NULL,
  `obj_weight` decimal(13,2) DEFAULT NULL,
  `obj_rating` int DEFAULT NULL,
  `obj_text` varchar(2500) CHARACTER SET utf8mb3 COLLATE utf8mb3_bin DEFAULT NULL,
  `course_id` int NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

-- --------------------------------------------------------

--
-- Table structure for table `objectives_submission`
--

CREATE TABLE `objectives_submission` (
  `record_id` int NOT NULL,
  `employee_id` int NOT NULL,
  `objectives_year` year NOT NULL,
  `submitted_by_user_id` int NOT NULL,
  `submitted_timestamp` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP,
  `filed` int NOT NULL DEFAULT '0',
  `filed_timestamp` timestamp NULL DEFAULT NULL,
  `filed_by_user_id` int DEFAULT NULL,
  `mid_reviewed` int DEFAULT '0',
  `mid_reviewed_timestamp` timestamp NULL DEFAULT NULL,
  `mid_reviewed_by_user_id` int DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

-- --------------------------------------------------------

--
-- Stand-in structure for view `objs_scores_sum_by_emp`
-- (See below for the actual view)
--
CREATE TABLE `objs_scores_sum_by_emp` (
`employee_id` int
,`obj_year` year
,`objs_scores_sum` decimal(13,2)
);

-- --------------------------------------------------------

--
-- Stand-in structure for view `obj_score`
-- (See below for the actual view)
--
CREATE TABLE `obj_score` (
`obj_id` int
,`employee_id` int
,`obj_year` year
,`obj_weight` decimal(13,2)
,`obj_score` decimal(13,2)
);

-- --------------------------------------------------------

--
-- Table structure for table `obj_trn_months`
--

CREATE TABLE `obj_trn_months` (
  `obj_id` int NOT NULL,
  `trn_month` int DEFAULT '99'
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

-- --------------------------------------------------------

--
-- Table structure for table `sys_users`
--

CREATE TABLE `sys_users` (
  `sys_user_id` int NOT NULL,
  `employee_id` int NOT NULL,
  `username` varchar(200) NOT NULL,
  `user_password` varchar(200) NOT NULL,
  `user_level` varchar(4) DEFAULT NULL,
  `user_status` varchar(12) NOT NULL DEFAULT 'ACTIVE',
  `recorded_timestamp` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

-- --------------------------------------------------------

--
-- Table structure for table `sys_user_logs`
--

CREATE TABLE `sys_user_logs` (
  `log_id` int NOT NULL,
  `sys_user_id` int NOT NULL,
  `log_in_timestamp` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP,
  `log_in_ip` varchar(100) DEFAULT NULL,
  `log_out_timestamp` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

-- --------------------------------------------------------

--
-- Table structure for table `users_companies`
--

CREATE TABLE `users_companies` (
  `record_id` int NOT NULL,
  `sys_user_id` int NOT NULL,
  `company_id` int NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

-- --------------------------------------------------------

--
-- Stand-in structure for view `wd_raits_avg_by_emp`
-- (See below for the actual view)
--
CREATE TABLE `wd_raits_avg_by_emp` (
`employee_id` int
,`wd_year` year
,`wd_raits_avg` decimal(13,2)
);

-- --------------------------------------------------------

--
-- Table structure for table `work_dimensions`
--

CREATE TABLE `work_dimensions` (
  `wd_id` int NOT NULL,
  `wd_text` varchar(200) DEFAULT NULL,
  `wd_text_arabic` varchar(200) CHARACTER SET utf8mb3 COLLATE utf8mb3_bin DEFAULT NULL,
  `wd_year` year NOT NULL
) ENGINE=MyISAM DEFAULT CHARSET=utf8mb3;

-- --------------------------------------------------------

--
-- Structure for view `comps_raits_avg_by_emp`
--
DROP TABLE IF EXISTS `comps_raits_avg_by_emp`;

CREATE ALGORITHM=UNDEFINED DEFINER=`pmsuser`@`%` SQL SECURITY DEFINER VIEW `comps_raits_avg_by_emp`  AS SELECT `ec`.`employee_id` AS `employee_id`, `c`.`comp_year` AS `comp_year`, cast(avg(`ec`.`comp_rating`) as decimal(13,2)) AS `comps_raits_avg` FROM (`employees_competencies` `ec` join `competencies` `c`) WHERE (`c`.`comp_id` = `ec`.`comp_id`) GROUP BY `ec`.`employee_id`, `c`.`comp_year` ;

-- --------------------------------------------------------

--
-- Structure for view `employee_details`
--
DROP TABLE IF EXISTS `employee_details`;

CREATE ALGORITHM=UNDEFINED DEFINER=`pmsuser`@`%` SQL SECURITY DEFINER VIEW `employee_details`  AS SELECT `e`.`employee_id` AS `employee_id`, `e`.`first_name` AS `first_name`, `e`.`second_name` AS `second_name`, `e`.`third_name` AS `third_name`, `e`.`fourth_name` AS `fourth_name`, concat(`e`.`first_name`,' ',ifnull(`e`.`second_name`,''),' ',ifnull(`e`.`third_name`,''),' ',ifnull(`e`.`fourth_name`,'')) AS `full_name`, `e`.`company_id` AS `company_id`, `c`.`company_name` AS `company_name`, `e`.`hire_date` AS `hire_date`, `e`.`department_id` AS `department_id`, `d`.`department_name` AS `department_name`, `e`.`job_type` AS `job_type`, `e`.`job_id` AS `job_id`, `j`.`job_title` AS `job_title`, `e`.`job_grade_id` AS `job_grade_id`, concat(`jg`.`category`,'-',`jg`.`level`,'- ',`jg`.`grade_no`,' ',`jg`.`grade_letter`) AS `job_grade`, `e`.`current_job_join_date` AS `current_job_join_date`, `e`.`manager_employee_id` AS `manager_employee_id`, `e`.`third_generation` AS `third_generation`, concat(`man`.`first_name`,' ',ifnull(`man`.`second_name`,''),' ',ifnull(`man`.`third_name`,''),' ',ifnull(`man`.`fourth_name`,'')) AS `manager_full_name`, `rman`.`employee_id` AS `reviewing_manager_employee_id`, concat(`rman`.`first_name`,' ',ifnull(`rman`.`second_name`,''),' ',ifnull(`rman`.`third_name`,''),' ',ifnull(`rman`.`fourth_name`,'')) AS `reviewing_manager_full_name`, `e`.`gender` AS `gender`, `e`.`nationality_country_id` AS `nationality_country_id`, `nc`.`nationality_country_name` AS `nationality_country_name`, `e`.`religion` AS `religion`, `e`.`date_of_birth` AS `date_of_birth`, `e`.`national_id` AS `national_id`, `e`.`work_mobile_no` AS `work_mobile_no`, `e`.`personal_mobile_no` AS `personal_mobile_no`, `e`.`extension_no` AS `extension_no`, `e`.`work_email_address` AS `work_email_address`, `e`.`home_address` AS `home_address`, `e`.`employee_status` AS `employee_status`, `e`.`deleted` AS `deleted` FROM (((((((`employees` `e` join `companies` `c`) join `departments` `d`) join `jobs` `j`) join `jobs_grades` `jg`) join `nationalities_countries` `nc`) join `employees` `man`) join `employees` `rman`) WHERE ((`e`.`company_id` = `c`.`company_id`) AND (`e`.`department_id` = `d`.`department_id`) AND (`e`.`job_id` = `j`.`job_id`) AND (`e`.`job_grade_id` = `jg`.`job_grade_id`) AND (`e`.`nationality_country_id` = `nc`.`nationality_country_id`) AND (`man`.`employee_id` = `e`.`manager_employee_id`) AND (`rman`.`employee_id` = `man`.`manager_employee_id`)) ;

-- --------------------------------------------------------

--
-- Structure for view `objs_scores_sum_by_emp`
--
DROP TABLE IF EXISTS `objs_scores_sum_by_emp`;

CREATE ALGORITHM=UNDEFINED DEFINER=`pmsuser`@`%` SQL SECURITY DEFINER VIEW `objs_scores_sum_by_emp`  AS SELECT `obj_score`.`employee_id` AS `employee_id`, `obj_score`.`obj_year` AS `obj_year`, cast(sum(`obj_score`.`obj_score`) as decimal(13,2)) AS `objs_scores_sum` FROM `obj_score` GROUP BY `obj_score`.`employee_id`, `obj_score`.`obj_year` ;

-- --------------------------------------------------------

--
-- Structure for view `obj_score`
--
DROP TABLE IF EXISTS `obj_score`;

CREATE ALGORITHM=UNDEFINED DEFINER=`pmsuser`@`%` SQL SECURITY DEFINER VIEW `obj_score`  AS SELECT `objectives`.`obj_id` AS `obj_id`, `objectives`.`employee_id` AS `employee_id`, `objectives`.`obj_year` AS `obj_year`, `objectives`.`obj_weight` AS `obj_weight`, cast((`objectives`.`obj_weight` * `objectives`.`obj_rating`) as decimal(13,2)) AS `obj_score` FROM `objectives` ;

-- --------------------------------------------------------

--
-- Structure for view `wd_raits_avg_by_emp`
--
DROP TABLE IF EXISTS `wd_raits_avg_by_emp`;

CREATE ALGORITHM=UNDEFINED DEFINER=`pmsuser`@`%` SQL SECURITY DEFINER VIEW `wd_raits_avg_by_emp`  AS SELECT `ewd`.`employee_id` AS `employee_id`, `wd`.`wd_year` AS `wd_year`, cast(avg(`ewd`.`wd_rating`) as decimal(13,2)) AS `wd_raits_avg` FROM (`employees_work_dimensions` `ewd` join `work_dimensions` `wd`) WHERE (`ewd`.`wd_id` = `wd`.`wd_id`) GROUP BY `ewd`.`employee_id`, `wd`.`wd_year` ;

--
-- Indexes for dumped tables
--

--
-- Indexes for table `companies`
--
ALTER TABLE `companies`
  ADD PRIMARY KEY (`company_id`);

--
-- Indexes for table `competencies`
--
ALTER TABLE `competencies`
  ADD PRIMARY KEY (`comp_id`);

--
-- Indexes for table `courses`
--
ALTER TABLE `courses`
  ADD PRIMARY KEY (`course_id`);

--
-- Indexes for table `departments`
--
ALTER TABLE `departments`
  ADD PRIMARY KEY (`department_id`),
  ADD KEY `company_id` (`company_id`);

--
-- Indexes for table `employees`
--
ALTER TABLE `employees`
  ADD PRIMARY KEY (`employee_id`),
  ADD KEY `company_id` (`company_id`),
  ADD KEY `department _id` (`department_id`),
  ADD KEY `job_type_id` (`job_type`),
  ADD KEY `job_id` (`job_id`),
  ADD KEY `job_grade_id` (`job_grade_id`),
  ADD KEY `nationality_country_id` (`nationality_country_id`),
  ADD KEY `deleted` (`deleted`);

--
-- Indexes for table `employees_competencies`
--
ALTER TABLE `employees_competencies`
  ADD PRIMARY KEY (`employee_id`,`comp_id`);

--
-- Indexes for table `employees_work_dimensions`
--
ALTER TABLE `employees_work_dimensions`
  ADD PRIMARY KEY (`employee_id`,`wd_id`);

--
-- Indexes for table `employee_info_update_history`
--
ALTER TABLE `employee_info_update_history`
  ADD PRIMARY KEY (`record_id`);

--
-- Indexes for table `fc_emps`
--
ALTER TABLE `fc_emps`
  ADD PRIMARY KEY (`record_id`),
  ADD KEY `employee_id` (`employee_id`);

--
-- Indexes for table `form_tracker`
--
ALTER TABLE `form_tracker`
  ADD PRIMARY KEY (`record_id`),
  ADD KEY `employee_id` (`employee_id`);

--
-- Indexes for table `jobs`
--
ALTER TABLE `jobs`
  ADD PRIMARY KEY (`job_id`),
  ADD KEY `company_id` (`company_id`);

--
-- Indexes for table `jobs_grades`
--
ALTER TABLE `jobs_grades`
  ADD PRIMARY KEY (`job_grade_id`);

--
-- Indexes for table `months`
--
ALTER TABLE `months`
  ADD PRIMARY KEY (`month_id`);

--
-- Indexes for table `nationalities_countries`
--
ALTER TABLE `nationalities_countries`
  ADD PRIMARY KEY (`nationality_country_id`);

--
-- Indexes for table `objectives`
--
ALTER TABLE `objectives`
  ADD PRIMARY KEY (`obj_id`),
  ADD KEY `course_id` (`course_id`);

--
-- Indexes for table `objectives_submission`
--
ALTER TABLE `objectives_submission`
  ADD PRIMARY KEY (`record_id`),
  ADD KEY `employee_id` (`employee_id`),
  ADD KEY `submitted_by_user_id` (`submitted_by_user_id`),
  ADD KEY `filed_by_user_id` (`filed_by_user_id`),
  ADD KEY `filed` (`filed`),
  ADD KEY `mid_reviewed` (`mid_reviewed`);

--
-- Indexes for table `obj_trn_months`
--
ALTER TABLE `obj_trn_months`
  ADD KEY `obj_id` (`obj_id`);

--
-- Indexes for table `sys_users`
--
ALTER TABLE `sys_users`
  ADD PRIMARY KEY (`sys_user_id`),
  ADD UNIQUE KEY `username` (`username`),
  ADD KEY `employee_id` (`employee_id`);

--
-- Indexes for table `sys_user_logs`
--
ALTER TABLE `sys_user_logs`
  ADD PRIMARY KEY (`log_id`),
  ADD KEY `user_id` (`sys_user_id`);

--
-- Indexes for table `users_companies`
--
ALTER TABLE `users_companies`
  ADD PRIMARY KEY (`record_id`),
  ADD KEY `sys_user_id` (`sys_user_id`),
  ADD KEY `company_id` (`company_id`);

--
-- Indexes for table `work_dimensions`
--
ALTER TABLE `work_dimensions`
  ADD PRIMARY KEY (`wd_id`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `companies`
--
ALTER TABLE `companies`
  MODIFY `company_id` int NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `competencies`
--
ALTER TABLE `competencies`
  MODIFY `comp_id` int NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `courses`
--
ALTER TABLE `courses`
  MODIFY `course_id` int NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `departments`
--
ALTER TABLE `departments`
  MODIFY `department_id` int NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `employees`
--
ALTER TABLE `employees`
  MODIFY `employee_id` int NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `employee_info_update_history`
--
ALTER TABLE `employee_info_update_history`
  MODIFY `record_id` int NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `fc_emps`
--
ALTER TABLE `fc_emps`
  MODIFY `record_id` int NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `form_tracker`
--
ALTER TABLE `form_tracker`
  MODIFY `record_id` int NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `jobs`
--
ALTER TABLE `jobs`
  MODIFY `job_id` int NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `jobs_grades`
--
ALTER TABLE `jobs_grades`
  MODIFY `job_grade_id` int NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `nationalities_countries`
--
ALTER TABLE `nationalities_countries`
  MODIFY `nationality_country_id` int NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `objectives`
--
ALTER TABLE `objectives`
  MODIFY `obj_id` int NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `objectives_submission`
--
ALTER TABLE `objectives_submission`
  MODIFY `record_id` int NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `sys_users`
--
ALTER TABLE `sys_users`
  MODIFY `sys_user_id` int NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `sys_user_logs`
--
ALTER TABLE `sys_user_logs`
  MODIFY `log_id` int NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `users_companies`
--
ALTER TABLE `users_companies`
  MODIFY `record_id` int NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `work_dimensions`
--
ALTER TABLE `work_dimensions`
  MODIFY `wd_id` int NOT NULL AUTO_INCREMENT;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
