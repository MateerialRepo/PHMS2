-- --------------------------------------------------------
-- Host:                         127.0.0.1
-- Server version:               5.7.31 - MySQL Community Server (GPL)
-- Server OS:                    Win64
-- HeidiSQL Version:             11.0.0.5919
-- --------------------------------------------------------

/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET NAMES utf8 */;
/*!50503 SET NAMES utf8mb4 */;
/*!40014 SET @OLD_FOREIGN_KEY_CHECKS=@@FOREIGN_KEY_CHECKS, FOREIGN_KEY_CHECKS=0 */;
/*!40101 SET @OLD_SQL_MODE=@@SQL_MODE, SQL_MODE='NO_AUTO_VALUE_ON_ZERO' */;


-- Dumping database structure for phms
CREATE DATABASE IF NOT EXISTS `phms` /*!40100 DEFAULT CHARACTER SET utf8 */;
USE `phms`;

-- Dumping structure for table phms.patient
CREATE TABLE IF NOT EXISTS `patient` (
  `patient_id` int(11) NOT NULL AUTO_INCREMENT,
  `patient_fname` varchar(45) NOT NULL,
  `patient_lname` varchar(45) NOT NULL,
  `patient_othername` varchar(45) DEFAULT NULL,
  `patient_dob` date NOT NULL,
  `patient_address` varchar(150) NOT NULL,
  `patient_phone` varchar(15) NOT NULL,
  `patient_email` varchar(50) DEFAULT NULL,
  `patient_gender` varchar(10) NOT NULL,
  `patient_bloodgroup` varchar(4) DEFAULT NULL,
  `patient_genotype` varchar(4) DEFAULT NULL,
  `patient_occupation` varchar(45) NOT NULL,
  `patient_maritalstat` varchar(15) DEFAULT NULL,
  `patient_kinid` int(11) NOT NULL,
  PRIMARY KEY (`patient_id`),
  KEY `patient_kinid_idx` (`patient_kinid`),
  CONSTRAINT `patient_kinid` FOREIGN KEY (`patient_kinid`) REFERENCES `patient_kin` (`patient_kinid`) ON DELETE NO ACTION ON UPDATE NO ACTION
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

-- Dumping data for table phms.patient: ~0 rows (approximately)
/*!40000 ALTER TABLE `patient` DISABLE KEYS */;
/*!40000 ALTER TABLE `patient` ENABLE KEYS */;

-- Dumping structure for table phms.patientvisit
CREATE TABLE IF NOT EXISTS `patientvisit` (
  `patientvisit_id` int(11) NOT NULL AUTO_INCREMENT,
  `visit_date` date NOT NULL,
  `patient_id` int(11) NOT NULL,
  `visit_purpose` varchar(60) NOT NULL,
  PRIMARY KEY (`patientvisit_id`),
  KEY `patient_id_idx` (`patient_id`),
  CONSTRAINT `patient_idFK` FOREIGN KEY (`patient_id`) REFERENCES `patient` (`patient_id`) ON DELETE NO ACTION ON UPDATE NO ACTION
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

-- Dumping data for table phms.patientvisit: ~0 rows (approximately)
/*!40000 ALTER TABLE `patientvisit` DISABLE KEYS */;
/*!40000 ALTER TABLE `patientvisit` ENABLE KEYS */;

-- Dumping structure for table phms.patient_kin
CREATE TABLE IF NOT EXISTS `patient_kin` (
  `patient_kinid` int(11) NOT NULL,
  `kin_firstname` varchar(45) NOT NULL,
  `kin_surname` varchar(45) NOT NULL,
  `kin_othername` varchar(45) DEFAULT NULL,
  `kin_address` varchar(150) NOT NULL,
  `kin_phone1` varchar(15) NOT NULL,
  `kin_phone2` varchar(45) DEFAULT NULL,
  `kin_relationship` varchar(45) NOT NULL,
  PRIMARY KEY (`patient_kinid`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

-- Dumping data for table phms.patient_kin: ~0 rows (approximately)
/*!40000 ALTER TABLE `patient_kin` DISABLE KEYS */;
/*!40000 ALTER TABLE `patient_kin` ENABLE KEYS */;

-- Dumping structure for table phms.patient_vitals
CREATE TABLE IF NOT EXISTS `patient_vitals` (
  `vital_id` int(11) NOT NULL,
  `record_id` int(11) NOT NULL,
  `patient_id` int(11) NOT NULL,
  `date` date NOT NULL,
  `weight` int(11) DEFAULT NULL,
  `height` int(11) DEFAULT NULL,
  `temperature` varchar(15) DEFAULT NULL,
  `bp` varchar(15) DEFAULT NULL,
  `blood_sugar` varchar(15) DEFAULT NULL,
  PRIMARY KEY (`vital_id`),
  KEY `record_idfk` (`record_id`),
  KEY `patient_idfk` (`patient_id`)
) ENGINE=MyISAM DEFAULT CHARSET=latin1 COMMENT='This tabel would store the vitals of the patients per appointment';

-- Dumping data for table phms.patient_vitals: 0 rows
/*!40000 ALTER TABLE `patient_vitals` DISABLE KEYS */;
/*!40000 ALTER TABLE `patient_vitals` ENABLE KEYS */;

-- Dumping structure for table phms.records
CREATE TABLE IF NOT EXISTS `records` (
  `record_id` int(11) NOT NULL AUTO_INCREMENT,
  `record_prescription` varchar(200) NOT NULL,
  `record_date` date NOT NULL,
  `patient_id` int(11) NOT NULL,
  `staff_id` int(11) NOT NULL,
  `diagnosis` varchar(1000) NOT NULL,
  `admission_stat` varchar(25) NOT NULL,
  `disease` varchar(50) NOT NULL,
  `discharge_date` date DEFAULT NULL,
  PRIMARY KEY (`record_id`),
  KEY `patient_id_idx` (`patient_id`),
  KEY `staff_id_idx` (`staff_id`),
  CONSTRAINT `patient_id` FOREIGN KEY (`patient_id`) REFERENCES `patient` (`patient_id`) ON DELETE NO ACTION ON UPDATE NO ACTION,
  CONSTRAINT `staff_id` FOREIGN KEY (`staff_id`) REFERENCES `staff` (`staff_id`) ON DELETE NO ACTION ON UPDATE NO ACTION
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

-- Dumping data for table phms.records: ~0 rows (approximately)
/*!40000 ALTER TABLE `records` DISABLE KEYS */;
/*!40000 ALTER TABLE `records` ENABLE KEYS */;

-- Dumping structure for table phms.roaster
CREATE TABLE IF NOT EXISTS `roaster` (
  `roaster_id` int(11) NOT NULL AUTO_INCREMENT,
  `staff_id` int(11) NOT NULL,
  `call_day` date NOT NULL,
  `call_date` date NOT NULL,
  `call_start` time NOT NULL,
  `call_end` time NOT NULL,
  PRIMARY KEY (`roaster_id`),
  KEY `staff_id_idx` (`staff_id`),
  CONSTRAINT `staff_idFK` FOREIGN KEY (`staff_id`) REFERENCES `staff` (`staff_id`) ON DELETE NO ACTION ON UPDATE NO ACTION
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

-- Dumping data for table phms.roaster: ~0 rows (approximately)
/*!40000 ALTER TABLE `roaster` DISABLE KEYS */;
/*!40000 ALTER TABLE `roaster` ENABLE KEYS */;

-- Dumping structure for table phms.staff
CREATE TABLE IF NOT EXISTS `staff` (
  `staff_id` int(11) NOT NULL AUTO_INCREMENT,
  `firstname` varchar(45) NOT NULL,
  `lastname` varchar(45) NOT NULL,
  `othername` varchar(45) DEFAULT NULL,
  `address` varchar(100) NOT NULL,
  `email` varchar(50) NOT NULL,
  `phone` varchar(20) NOT NULL,
  `gender` varchar(10) NOT NULL,
  `username` varchar(50) NOT NULL,
  `password` varchar(255) NOT NULL,
  `speciality` varchar(45) DEFAULT NULL,
  `staff_typeid` int(11) DEFAULT NULL,
  `staff_image` varchar(50) DEFAULT NULL,
  PRIMARY KEY (`staff_id`),
  UNIQUE KEY `username` (`username`),
  UNIQUE KEY `email` (`email`),
  KEY `staff_typeid_idx` (`staff_typeid`),
  CONSTRAINT `staff_typeid` FOREIGN KEY (`staff_typeid`) REFERENCES `staff_type` (`staff_typeid`) ON DELETE NO ACTION ON UPDATE NO ACTION
) ENGINE=InnoDB AUTO_INCREMENT=2 DEFAULT CHARSET=utf8;

-- Dumping data for table phms.staff: ~1 rows (approximately)
/*!40000 ALTER TABLE `staff` DISABLE KEYS */;
INSERT INTO `staff` (`staff_id`, `firstname`, `lastname`, `othername`, `address`, `email`, `phone`, `gender`, `username`, `password`, `speciality`, `staff_typeid`, `staff_image`) VALUES
	(1, 'Luqman', 'Bello', 'Abbey', 'No 2, Adisa Akintoye', 'addictmee@gmail.com', '07030280111', 'Male', 'mateerial', '25f9e794323b453885f5181f1b624d0b', NULL, 1, NULL);
/*!40000 ALTER TABLE `staff` ENABLE KEYS */;

-- Dumping structure for table phms.staff_type
CREATE TABLE IF NOT EXISTS `staff_type` (
  `staff_typeid` int(11) NOT NULL AUTO_INCREMENT,
  `staff_type` varchar(50) NOT NULL,
  PRIMARY KEY (`staff_typeid`)
) ENGINE=InnoDB AUTO_INCREMENT=5 DEFAULT CHARSET=utf8;

-- Dumping data for table phms.staff_type: ~4 rows (approximately)
/*!40000 ALTER TABLE `staff_type` DISABLE KEYS */;
INSERT INTO `staff_type` (`staff_typeid`, `staff_type`) VALUES
	(1, 'Super Admin'),
	(2, 'Doctor'),
	(3, 'Nurse'),
	(4, 'Admin');
/*!40000 ALTER TABLE `staff_type` ENABLE KEYS */;

/*!40101 SET SQL_MODE=IFNULL(@OLD_SQL_MODE, '') */;
/*!40014 SET FOREIGN_KEY_CHECKS=IF(@OLD_FOREIGN_KEY_CHECKS IS NULL, 1, @OLD_FOREIGN_KEY_CHECKS) */;
/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
