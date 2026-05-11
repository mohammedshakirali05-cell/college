-- Migration: Update Admissions Table Schema
-- Make Aadhar Number Primary Key and Add Student Password
-- Date: 2026-05-01

-- Step 1: Create temporary table with new structure
CREATE TABLE IF NOT EXISTS `admissions_new` (
  `aadhar_number` varchar(20) NOT NULL,
  `student_id` varchar(20) UNIQUE NOT NULL COMMENT 'Auto-generated student ID',
  `id` int AUTO_INCREMENT,
  `uuid` char(32) NOT NULL,
  `admission_number` varchar(50) NOT NULL,
  `full_name` varchar(255) NOT NULL,
  `father_name` varchar(255),
  `password` varchar(255) NOT NULL COMMENT 'Hashed password for student login',
  `puc_institute` varchar(255),
  `last_attended` varchar(255),
  `puc_subjects` text,
  `payment_method` enum('none','online','cash') NOT NULL DEFAULT 'none',
  `payment_status` enum('pending','paid') NOT NULL DEFAULT 'pending',
  `status` varchar(50) NOT NULL DEFAULT 'payment_in_progress',
  `admin_notes` text DEFAULT NULL,
  `created_at` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP,
  `updated_at` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP,
  PRIMARY KEY (`aadhar_number`),
  UNIQUE KEY `uuid` (`uuid`),
  UNIQUE KEY `admission_number` (`admission_number`),
  UNIQUE KEY `student_id` (`student_id`),
  KEY `id` (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

-- Step 2: Copy existing data from old table to new table (if table exists)
INSERT IGNORE INTO `admissions_new` 
(`aadhar_number`, `id`, `uuid`, `admission_number`, `full_name`, `password`, 
 `puc_institute`, `last_attended`, `puc_subjects`, `payment_method`, `payment_status`, `status`, `admin_notes`, `created_at`, `updated_at`)
SELECT `aadhar_number`, `id`, `uuid`, `admission_number`, `full_name`, 
       CONCAT('$2y$10$', SHA2(CONCAT(`aadhar_number`, 'temp'), 256)) as default_password,
       `puc_institute`, `last_attended`, `puc_subjects`, `payment_method`, `payment_status`, `status`, `admin_notes`, `created_at`, `updated_at`
FROM `admissions` WHERE 1;

-- Step 3: Drop old table and rename new table
DROP TABLE IF EXISTS `admissions`;
RENAME TABLE `admissions_new` TO `admissions`;

-- Note: After running this migration, update AdmissionModel to generate student_id in format: STU-YYYYMMDD-XXXXX
