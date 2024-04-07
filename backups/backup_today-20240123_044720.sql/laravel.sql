/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;
/*!40014 SET @OLD_UNIQUE_CHECKS=@@UNIQUE_CHECKS, UNIQUE_CHECKS=0 */;
/*!40014 SET @OLD_FOREIGN_KEY_CHECKS=@@FOREIGN_KEY_CHECKS, FOREIGN_KEY_CHECKS=0 */;
/*!40101 SET @OLD_SQL_MODE=@@SQL_MODE, SQL_MODE='NO_AUTO_VALUE_ON_ZERO' */;
/*!40111 SET @OLD_SQL_NOTES=@@SQL_NOTES, SQL_NOTES=0 */;

CREATE TABLE `account_balance` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `student_id` int(11) NOT NULL,
  `semester` varchar(255) NOT NULL,
  `academic_year` varchar(255) NOT NULL,
  `school_year` varchar(255) NOT NULL,
  `total_fees` decimal(10,2) NOT NULL,
  `amount_paid` decimal(10,2) NOT NULL,
  `balance` decimal(10,2) NOT NULL,
  `created_at` timestamp NOT NULL DEFAULT current_timestamp(),
  `updated_at` timestamp NOT NULL DEFAULT current_timestamp() ON UPDATE current_timestamp(),
  PRIMARY KEY (`id`),
  KEY `fk_account_balance_students` (`student_id`),
  CONSTRAINT `fk_account_balance_students` FOREIGN KEY (`student_id`) REFERENCES `students` (`id`) ON DELETE NO ACTION ON UPDATE NO ACTION
) ENGINE=InnoDB AUTO_INCREMENT=4 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

CREATE TABLE `accounts` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `email` varchar(255) NOT NULL,
  `email_verified_at` timestamp NULL DEFAULT NULL,
  `password` varchar(255) NOT NULL,
  `role` varchar(255) NOT NULL DEFAULT 'student',
  `department` varchar(255) DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT current_timestamp(),
  `updated_at` timestamp NULL DEFAULT NULL,
  `username` varchar(255) NOT NULL,
  `token` varchar(255) DEFAULT 'NULL',
  `two_factor_auth` tinyint(1) DEFAULT 0,
  `person_id` int(11) DEFAULT NULL,
  PRIMARY KEY (`id`),
  UNIQUE KEY `accounts_email_unique` (`email`),
  KEY `fk_accounts_faculty` (`person_id`),
  KEY `unq_accounts_role` (`role`)
) ENGINE=InnoDB AUTO_INCREMENT=7 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

CREATE TABLE `admin_accounts` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `username` varchar(255) NOT NULL,
  `password` varchar(255) NOT NULL,
  `email` varchar(255) NOT NULL,
  `permissions` text DEFAULT '[]',
  `roles` varchar(11) DEFAULT 'unspecified',
  `created_at` date DEFAULT curdate(),
  `last_login` datetime DEFAULT NULL,
  `status` int(11) DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=3 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

CREATE TABLE `admin_audit_logs` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `admin_id` int(11) DEFAULT NULL,
  `acitivity_type` int(11) DEFAULT NULL,
  `timestamp` datetime DEFAULT current_timestamp(),
  `description` text DEFAULT NULL,
  PRIMARY KEY (`id`),
  KEY `fk_admin_audit_logs_admin_accounts` (`admin_id`),
  CONSTRAINT `fk_admin_audit_logs_admin_accounts` FOREIGN KEY (`admin_id`) REFERENCES `admin_accounts` (`id`) ON DELETE NO ACTION ON UPDATE NO ACTION
) ENGINE=InnoDB DEFAULT CHARSET=latin1 COLLATE=latin1_swedish_ci;

CREATE TABLE `admin_permissions` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `permission_name` varchar(100) DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=latin1 COLLATE=latin1_swedish_ci;

CREATE TABLE `adminroles` (
  `admin_id` int(11) DEFAULT NULL,
  `role_id` int(11) DEFAULT NULL,
  KEY `fk_adminroles_admin_accounts` (`admin_id`),
  KEY `unq_adminroles_role_id` (`role_id`),
  CONSTRAINT `fk_adminroles_admin_accounts` FOREIGN KEY (`admin_id`) REFERENCES `admin_accounts` (`id`) ON DELETE NO ACTION ON UPDATE NO ACTION,
  CONSTRAINT `fk_adminroles_roles` FOREIGN KEY (`role_id`) REFERENCES `roles` (`RoleID`) ON DELETE NO ACTION ON UPDATE NO ACTION
) ENGINE=InnoDB DEFAULT CHARSET=latin1 COLLATE=latin1_swedish_ci;

CREATE TABLE `cache` (
  `key` varchar(255) NOT NULL,
  `value` mediumtext NOT NULL,
  `expiration` int(11) NOT NULL,
  PRIMARY KEY (`key`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

CREATE TABLE `cache_locks` (
  `key` varchar(255) NOT NULL,
  `owner` varchar(255) NOT NULL,
  `expiration` int(11) NOT NULL,
  PRIMARY KEY (`key`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

CREATE TABLE `class_enrollments` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `class_id` int(11) NOT NULL,
  `student_id` int(11) NOT NULL,
  PRIMARY KEY (`id`),
  KEY `fk_class_enrollments_classes` (`class_id`),
  KEY `fk_class_enrollments_students` (`student_id`),
  CONSTRAINT `fk_class_enrollments_classes` FOREIGN KEY (`class_id`) REFERENCES `classes` (`id`) ON DELETE NO ACTION ON UPDATE NO ACTION,
  CONSTRAINT `fk_class_enrollments_students` FOREIGN KEY (`student_id`) REFERENCES `students` (`id`) ON DELETE NO ACTION ON UPDATE NO ACTION
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

CREATE TABLE `classes` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `subject_code` varchar(255) NOT NULL,
  `faculty_id` int(11) NOT NULL,
  `academic_year` varchar(255) NOT NULL,
  `semester` varchar(255) NOT NULL,
  `schedule_id` int(11) DEFAULT NULL,
  PRIMARY KEY (`id`),
  KEY `idx_classes_schedule_id` (`schedule_id`),
  KEY `fk_classes_subject1` (`subject_code`),
  KEY `fk_classes_facultyb` (`faculty_id`),
  CONSTRAINT `fk_classes_faculty` FOREIGN KEY (`faculty_id`) REFERENCES `faculty` (`id`) ON DELETE NO ACTION ON UPDATE NO ACTION,
  CONSTRAINT `fk_classes_facultyb` FOREIGN KEY (`faculty_id`) REFERENCES `faculty` (`id`) ON DELETE NO ACTION ON UPDATE NO ACTION,
  CONSTRAINT `fk_classes_schedules` FOREIGN KEY (`schedule_id`) REFERENCES `schedules` (`id`) ON DELETE CASCADE ON UPDATE CASCADE
) ENGINE=InnoDB AUTO_INCREMENT=18 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

CREATE TABLE `courses` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `code` varchar(20) NOT NULL,
  `title` varchar(60) NOT NULL,
  `description` text NOT NULL,
  `department` varchar(255) NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=6 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

CREATE TABLE `document_locations` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `documents` text DEFAULT '[]',
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=12 DEFAULT CHARSET=latin1 COLLATE=latin1_swedish_ci;

CREATE TABLE `enrolled_subjects` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `student_id` int(11) NOT NULL,
  `subjects_array` text NOT NULL,
  `academic_year` varchar(255) NOT NULL,
  `semester` varchar(255) NOT NULL,
  `school_year` varchar(255) NOT NULL,
  PRIMARY KEY (`id`),
  KEY `fk_enrolled_subjects_students` (`student_id`),
  CONSTRAINT `fk_enrolled_subjects_students` FOREIGN KEY (`student_id`) REFERENCES `students` (`id`) ON DELETE NO ACTION ON UPDATE NO ACTION
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

CREATE TABLE `faculty` (
  `id` int(11) NOT NULL,
  `first_name` varchar(255) NOT NULL,
  `last_name` varchar(255) NOT NULL,
  `middle_name` varchar(255) DEFAULT NULL,
  `email` varchar(255) NOT NULL,
  `phone_number` varchar(20) DEFAULT NULL,
  `department` varchar(11) DEFAULT NULL,
  `office_hours` varchar(255) DEFAULT NULL,
  `birth_date` date DEFAULT NULL,
  `address_line1` varchar(255) DEFAULT NULL,
  `biography` text DEFAULT NULL,
  `education` text DEFAULT NULL,
  `courses_taught` text DEFAULT NULL,
  `photo_url` varchar(255) DEFAULT NULL,
  `status` enum('active','inactive','on_leave','retired') DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT current_timestamp(),
  `updated_at` timestamp NULL DEFAULT current_timestamp() ON UPDATE current_timestamp(),
  `gender` enum('male','female','other') DEFAULT NULL,
  `age` int(3) DEFAULT NULL,
  PRIMARY KEY (`id`),
  UNIQUE KEY `email` (`email`)
) ENGINE=InnoDB DEFAULT CHARSET=latin1 COLLATE=latin1_swedish_ci;

CREATE TABLE `failed_jobs` (
  `id` bigint(20) unsigned NOT NULL AUTO_INCREMENT,
  `uuid` varchar(255) NOT NULL,
  `connection` text NOT NULL,
  `queue` text NOT NULL,
  `payload` longtext NOT NULL,
  `exception` longtext NOT NULL,
  `failed_at` timestamp NOT NULL DEFAULT current_timestamp(),
  PRIMARY KEY (`id`),
  UNIQUE KEY `failed_jobs_uuid_unique` (`uuid`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

CREATE TABLE `guest_education_id` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `elementaryschoolname` varchar(100) DEFAULT NULL,
  `elementarygraduationyear` int(11) DEFAULT NULL,
  `seniorhighschoolname` varchar(100) DEFAULT NULL,
  `seniorhighgraduationyear` int(11) DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=16 DEFAULT CHARSET=latin1 COLLATE=latin1_swedish_ci;

CREATE TABLE `guest_enrollments` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `selected_course` int(11) NOT NULL,
  `academic_year` int(11) DEFAULT NULL,
  `selected_semester` int(11) NOT NULL,
  `guest_personal_info_id` int(11) NOT NULL,
  `geust_education_id` int(11) DEFAULT NULL,
  `special_skills` text DEFAULT NULL,
  `guest_parents_id` int(11) DEFAULT NULL,
  `guest_guardian_id` int(11) DEFAULT NULL,
  `guest_documents_id` int(11) DEFAULT NULL,
  `guest_tuition_id` int(11) DEFAULT NULL,
  `created_at` timestamp NOT NULL DEFAULT current_timestamp(),
  `updated_at` datetime DEFAULT current_timestamp() ON UPDATE current_timestamp(),
  `student_id` int(11) DEFAULT NULL,
  PRIMARY KEY (`id`),
  KEY `fk_guest_enrolments_guest_guardian_contact` (`guest_guardian_id`),
  KEY `fk_guest_enrollments_guests_parents_info` (`guest_parents_id`),
  KEY `fk_guest_enrollments_guest_personal_info` (`guest_personal_info_id`),
  KEY `idx_guest_enrollments_guest_documents_id` (`guest_documents_id`),
  KEY `idx_guest_enrollments_guest_tuition_id` (`guest_tuition_id`),
  KEY `fk_guest_enrollments_guest_education_id` (`geust_education_id`),
  CONSTRAINT `fk_guest_enrollments_document_locations` FOREIGN KEY (`guest_documents_id`) REFERENCES `document_locations` (`id`) ON DELETE CASCADE ON UPDATE CASCADE,
  CONSTRAINT `fk_guest_enrollments_guest_education_id` FOREIGN KEY (`geust_education_id`) REFERENCES `guest_education_id` (`id`) ON DELETE CASCADE ON UPDATE CASCADE,
  CONSTRAINT `fk_guest_enrollments_guest_personal_info` FOREIGN KEY (`guest_personal_info_id`) REFERENCES `guest_personal_info` (`id`) ON DELETE CASCADE ON UPDATE CASCADE,
  CONSTRAINT `fk_guest_enrollments_guest_tuition` FOREIGN KEY (`guest_tuition_id`) REFERENCES `guest_tuition` (`id`) ON DELETE CASCADE ON UPDATE CASCADE,
  CONSTRAINT `fk_guest_enrollments_guests_parents_info` FOREIGN KEY (`guest_parents_id`) REFERENCES `guests_parents_info` (`id`) ON DELETE CASCADE ON UPDATE CASCADE,
  CONSTRAINT `fk_guest_enrolments_guest_guardian_contact` FOREIGN KEY (`guest_guardian_id`) REFERENCES `guest_guardian_contact` (`id`) ON DELETE CASCADE ON UPDATE CASCADE
) ENGINE=InnoDB AUTO_INCREMENT=14 DEFAULT CHARSET=latin1 COLLATE=latin1_swedish_ci;

CREATE TABLE `guest_guardian_contact` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `emergencycontactname` varchar(100) DEFAULT NULL,
  `emergencycontactphone` int(11) DEFAULT NULL,
  `emergencycontactaddress` text DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=16 DEFAULT CHARSET=latin1 COLLATE=latin1_swedish_ci;

CREATE TABLE `guest_personal_info` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `firstname` varchar(100) DEFAULT NULL,
  `middleinitial` char(1) DEFAULT NULL,
  `lastname` varchar(100) DEFAULT NULL,
  `birthdate` date DEFAULT NULL,
  `birthplace` varchar(255) DEFAULT NULL,
  `citizenship` varchar(50) DEFAULT NULL,
  `religion` varchar(50) DEFAULT NULL,
  `sex` varchar(50) DEFAULT NULL,
  `civilstatus` varchar(50) DEFAULT NULL,
  `weight` int(11) DEFAULT NULL,
  `height` int(11) DEFAULT NULL,
  `currentaddress` text DEFAULT NULL,
  `permanentaddress` text DEFAULT NULL,
  `inputemail` varchar(255) DEFAULT NULL,
  `phone` int(11) DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=16 DEFAULT CHARSET=latin1 COLLATE=latin1_swedish_ci;

CREATE TABLE `guest_tuition` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `totaltuition` int(11) DEFAULT NULL,
  `downpayment` int(11) DEFAULT NULL,
  `totalbalance` int(11) DEFAULT NULL,
  `payment_method` varchar(50) DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=12 DEFAULT CHARSET=latin1 COLLATE=latin1_swedish_ci;

CREATE TABLE `guests_parents_info` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `fathersname` varchar(100) DEFAULT NULL,
  `mothersname` varchar(100) DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=16 DEFAULT CHARSET=latin1 COLLATE=latin1_swedish_ci;

CREATE TABLE `job_batches` (
  `id` varchar(255) NOT NULL,
  `name` varchar(255) NOT NULL,
  `total_jobs` int(11) NOT NULL,
  `pending_jobs` int(11) NOT NULL,
  `failed_jobs` int(11) NOT NULL,
  `failed_job_ids` longtext NOT NULL,
  `options` mediumtext DEFAULT NULL,
  `cancelled_at` int(11) DEFAULT NULL,
  `created_at` int(11) NOT NULL,
  `finished_at` int(11) DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

CREATE TABLE `jobs` (
  `id` bigint(20) unsigned NOT NULL AUTO_INCREMENT,
  `queue` varchar(255) NOT NULL,
  `payload` longtext NOT NULL,
  `attempts` tinyint(3) unsigned NOT NULL,
  `reserved_at` int(10) unsigned DEFAULT NULL,
  `available_at` int(10) unsigned NOT NULL,
  `created_at` int(10) unsigned NOT NULL,
  PRIMARY KEY (`id`),
  KEY `jobs_queue_index` (`queue`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

CREATE TABLE `migrations` (
  `id` int(10) unsigned NOT NULL AUTO_INCREMENT,
  `migration` varchar(255) NOT NULL,
  `batch` int(11) NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=13 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

CREATE TABLE `password_reset_tokens` (
  `email` varchar(255) NOT NULL,
  `token` varchar(255) NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  PRIMARY KEY (`email`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

CREATE TABLE `permission_role` (
  `permission_id` int(10) NOT NULL,
  `role_id` int(10) NOT NULL,
  KEY `fk_permission_role_permissions` (`permission_id`),
  KEY `fk_permission_role_roles` (`role_id`),
  CONSTRAINT `fk_permission_role_permissions` FOREIGN KEY (`permission_id`) REFERENCES `permissions` (`id`) ON DELETE NO ACTION ON UPDATE NO ACTION,
  CONSTRAINT `fk_permission_role_roles` FOREIGN KEY (`role_id`) REFERENCES `roles` (`RoleID`) ON DELETE NO ACTION ON UPDATE NO ACTION
) ENGINE=InnoDB DEFAULT CHARSET=latin1 COLLATE=latin1_swedish_ci;

CREATE TABLE `permission_type` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `permission_array` int(11) DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=latin1 COLLATE=latin1_swedish_ci;

CREATE TABLE `permissions` (
  `id` int(10) NOT NULL AUTO_INCREMENT,
  `name` varchar(255) NOT NULL,
  `display_name` varchar(255) NOT NULL,
  `description` varchar(255) NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=27 DEFAULT CHARSET=latin1 COLLATE=latin1_swedish_ci;

CREATE TABLE `personal_access_tokens` (
  `id` bigint(20) unsigned NOT NULL AUTO_INCREMENT,
  `tokenable_type` varchar(255) NOT NULL,
  `tokenable_id` bigint(20) unsigned NOT NULL,
  `name` varchar(255) NOT NULL,
  `token` varchar(64) NOT NULL,
  `abilities` text DEFAULT NULL,
  `last_used_at` timestamp NULL DEFAULT NULL,
  `expires_at` timestamp NULL DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  PRIMARY KEY (`id`),
  UNIQUE KEY `personal_access_tokens_token_unique` (`token`),
  KEY `personal_access_tokens_tokenable_type_tokenable_id_index` (`tokenable_type`,`tokenable_id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

CREATE TABLE `roles` (
  `RoleID` int(11) NOT NULL AUTO_INCREMENT,
  `RoleName` varchar(255) NOT NULL,
  PRIMARY KEY (`RoleID`)
) ENGINE=InnoDB AUTO_INCREMENT=15 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

CREATE TABLE `roles_permission` (
  `role_id` int(11) DEFAULT NULL,
  `permission_id` int(11) DEFAULT NULL,
  `permission_type_id` int(11) DEFAULT NULL,
  KEY `fk_roles_permission_roles` (`role_id`),
  KEY `fk_roles_permission_admin_permissions` (`permission_id`),
  KEY `fk_roles_permission_permission_type` (`permission_type_id`),
  CONSTRAINT `fk_roles_permission_admin_permissions` FOREIGN KEY (`permission_id`) REFERENCES `admin_permissions` (`id`) ON DELETE NO ACTION ON UPDATE NO ACTION,
  CONSTRAINT `fk_roles_permission_permission_type` FOREIGN KEY (`permission_type_id`) REFERENCES `permission_type` (`id`) ON DELETE NO ACTION ON UPDATE NO ACTION,
  CONSTRAINT `fk_roles_permission_roles` FOREIGN KEY (`role_id`) REFERENCES `roles` (`RoleID`) ON DELETE NO ACTION ON UPDATE NO ACTION
) ENGINE=InnoDB DEFAULT CHARSET=latin1 COLLATE=latin1_swedish_ci;

CREATE TABLE `rooms` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `room_name` varchar(255) NOT NULL,
  `facility` varchar(255) NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=4 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

CREATE TABLE `schedules` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `subject_code` varchar(20) NOT NULL,
  `courses` text NOT NULL DEFAULT '[]',
  `academic_year` varchar(255) NOT NULL,
  `room_id` int(11) NOT NULL,
  `days` text NOT NULL,
  `start_time` time NOT NULL,
  `end_time` time NOT NULL,
  `type` varchar(255) NOT NULL,
  PRIMARY KEY (`id`),
  KEY `fk_schedules_courses` (`courses`(768)),
  KEY `fk_schedules_rooms` (`room_id`),
  KEY `fk_schedules_subject` (`subject_code`),
  CONSTRAINT `fk_schedules_rooms` FOREIGN KEY (`room_id`) REFERENCES `rooms` (`id`) ON DELETE NO ACTION ON UPDATE NO ACTION
) ENGINE=InnoDB AUTO_INCREMENT=14 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

CREATE TABLE `sessions` (
  `id` varchar(255) NOT NULL,
  `user_id` bigint(20) unsigned DEFAULT NULL,
  `ip_address` varchar(45) DEFAULT NULL,
  `user_agent` text DEFAULT NULL,
  `payload` longtext NOT NULL,
  `last_activity` int(11) NOT NULL,
  PRIMARY KEY (`id`),
  KEY `sessions_user_id_index` (`user_id`),
  KEY `sessions_last_activity_index` (`last_activity`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

CREATE TABLE `student_contacts` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `emergency_contact_name` varchar(100) DEFAULT NULL,
  `emergency_contact_phone` int(11) DEFAULT NULL,
  `emergency_contact_address` varchar(100) DEFAULT NULL,
  `facebook_contact` varchar(255) DEFAULT NULL,
  `personal_contact` int(11) DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=62 DEFAULT CHARSET=latin1 COLLATE=latin1_swedish_ci;

CREATE TABLE `student_education_info` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `elementary_school` varchar(100) DEFAULT NULL,
  `elementary_graduate_year` int(11) DEFAULT NULL,
  `senior_high_name` varchar(100) DEFAULT NULL,
  `senior_high_graduate_year` int(11) DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=62 DEFAULT CHARSET=latin1 COLLATE=latin1_swedish_ci;

CREATE TABLE `student_parents_info` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `fathers_name` varchar(100) DEFAULT NULL,
  `mothers_name` varchar(100) DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=62 DEFAULT CHARSET=latin1 COLLATE=latin1_swedish_ci;

CREATE TABLE `students` (
  `id` int(11) NOT NULL,
  `first_name` varchar(50) NOT NULL,
  `last_name` varchar(50) NOT NULL,
  `middle_name` varchar(20) NOT NULL,
  `gender` varchar(10) NOT NULL,
  `birth_date` date NOT NULL,
  `age` int(11) NOT NULL,
  `address` varchar(255) NOT NULL,
  `contacts` text NOT NULL,
  `course_id` int(11) NOT NULL,
  `academic_year` int(11) NOT NULL,
  `email` varchar(255) NOT NULL,
  `remarks` text DEFAULT NULL,
  `created_at` timestamp NOT NULL DEFAULT current_timestamp(),
  `updated_at` timestamp NOT NULL DEFAULT current_timestamp() ON UPDATE current_timestamp(),
  `profile_url` varchar(255) NOT NULL,
  `student_contact_id` int(11) DEFAULT NULL,
  `student_parent_info` int(11) DEFAULT NULL,
  `student_education_id` int(11) DEFAULT NULL,
  `student_personal_id` int(11) DEFAULT NULL,
  `document_location_id` int(11) DEFAULT NULL,
  PRIMARY KEY (`id`),
  KEY `fk_students_courses` (`course_id`),
  KEY `fk_students_student_contacts` (`student_contact_id`),
  KEY `idx_students_student_parent_info` (`student_parent_info`),
  KEY `idx_students_student_education_id` (`student_education_id`),
  KEY `idx_students_student_personal_id` (`student_personal_id`),
  KEY `idx_students_document_location_id` (`document_location_id`),
  CONSTRAINT `fk_students_courses` FOREIGN KEY (`course_id`) REFERENCES `courses` (`id`) ON DELETE NO ACTION ON UPDATE NO ACTION,
  CONSTRAINT `fk_students_document_locations` FOREIGN KEY (`document_location_id`) REFERENCES `document_locations` (`id`) ON DELETE NO ACTION ON UPDATE NO ACTION,
  CONSTRAINT `fk_students_student_contacts` FOREIGN KEY (`student_contact_id`) REFERENCES `student_contacts` (`id`) ON DELETE NO ACTION ON UPDATE NO ACTION,
  CONSTRAINT `fk_students_student_education_info` FOREIGN KEY (`student_education_id`) REFERENCES `student_education_info` (`id`) ON DELETE CASCADE ON UPDATE CASCADE,
  CONSTRAINT `fk_students_student_parents_info` FOREIGN KEY (`student_parent_info`) REFERENCES `student_parents_info` (`id`) ON DELETE CASCADE ON UPDATE CASCADE,
  CONSTRAINT `fk_students_students_personal_info` FOREIGN KEY (`student_personal_id`) REFERENCES `students_personal_info` (`id`) ON DELETE CASCADE ON UPDATE CASCADE
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

CREATE TABLE `students_personal_info` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `birthplace` varchar(100) DEFAULT NULL,
  `civil_status` varchar(40) DEFAULT NULL,
  `citizenship` varchar(20) DEFAULT NULL,
  `religion` varchar(30) DEFAULT NULL,
  `weight` int(11) DEFAULT NULL,
  `height` int(11) DEFAULT NULL,
  `current_adress` varchar(200) DEFAULT NULL,
  `permanent_address` varchar(255) DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=62 DEFAULT CHARSET=latin1 COLLATE=latin1_swedish_ci;

CREATE TABLE `subject` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `code` varchar(255) NOT NULL,
  `title` varchar(255) NOT NULL,
  `units` int(11) NOT NULL,
  `lecture` int(11) NOT NULL,
  `laboratory` int(11) DEFAULT NULL,
  `pre_riquisite` text NOT NULL DEFAULT '[]',
  `academic_year` int(11) NOT NULL,
  `semester` int(11) NOT NULL,
  `course_id` int(11) NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=301 DEFAULT CHARSET=latin1 COLLATE=latin1_swedish_ci;

CREATE TABLE `team_invitations` (
  `id` bigint(20) unsigned NOT NULL AUTO_INCREMENT,
  `team_id` bigint(20) unsigned NOT NULL,
  `email` varchar(255) NOT NULL,
  `role` varchar(255) DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  PRIMARY KEY (`id`),
  UNIQUE KEY `team_invitations_team_id_email_unique` (`team_id`,`email`),
  CONSTRAINT `team_invitations_team_id_foreign` FOREIGN KEY (`team_id`) REFERENCES `teams` (`id`) ON DELETE CASCADE
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

CREATE TABLE `team_user` (
  `id` bigint(20) unsigned NOT NULL AUTO_INCREMENT,
  `team_id` bigint(20) unsigned NOT NULL,
  `user_id` bigint(20) unsigned NOT NULL,
  `role` varchar(255) DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  PRIMARY KEY (`id`),
  UNIQUE KEY `team_user_team_id_user_id_unique` (`team_id`,`user_id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

CREATE TABLE `teams` (
  `id` bigint(20) unsigned NOT NULL AUTO_INCREMENT,
  `user_id` bigint(20) NOT NULL,
  `name` varchar(255) NOT NULL,
  `personal_team` tinyint(1) NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  PRIMARY KEY (`id`),
  KEY `teams_user_id_index` (`user_id`)
) ENGINE=InnoDB AUTO_INCREMENT=2 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

CREATE TABLE `user_role` (
  `user_id` bigint(20) DEFAULT NULL,
  `role_id` int(11) NOT NULL,
  KEY `idx_user_role_user_id` (`user_id`),
  KEY `fk_user_role_roles` (`role_id`),
  CONSTRAINT `fk_user_role_roles` FOREIGN KEY (`role_id`) REFERENCES `roles` (`RoleID`) ON DELETE NO ACTION ON UPDATE NO ACTION,
  CONSTRAINT `fk_user_role_users` FOREIGN KEY (`user_id`) REFERENCES `users` (`id`) ON DELETE NO ACTION ON UPDATE NO ACTION
) ENGINE=InnoDB DEFAULT CHARSET=latin1 COLLATE=latin1_swedish_ci;

CREATE TABLE `users` (
  `id` bigint(20) NOT NULL AUTO_INCREMENT,
  `name` varchar(255) NOT NULL,
  `email` varchar(255) NOT NULL,
  `email_verified_at` timestamp NULL DEFAULT NULL,
  `password` varchar(255) NOT NULL,
  `two_factor_secret` text DEFAULT NULL,
  `two_factor_recovery_codes` text DEFAULT NULL,
  `two_factor_confirmed_at` timestamp NULL DEFAULT NULL,
  `remember_token` varchar(100) DEFAULT NULL,
  `current_team_id` bigint(20) unsigned DEFAULT NULL,
  `profile_photo_path` varchar(2048) DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=3 DEFAULT CHARSET=latin1 COLLATE=latin1_swedish_ci;

INSERT INTO `account_balance` (`id`, `student_id`, `semester`, `academic_year`, `school_year`, `total_fees`, `amount_paid`, `balance`, `created_at`, `updated_at`) VALUES
(1, 0, '1', '1', '2023 - 2024', '12275.00', '0.00', '9275.00', '2024-04-01 06:39:38', '2024-04-01 06:39:38');
INSERT INTO `account_balance` (`id`, `student_id`, `semester`, `academic_year`, `school_year`, `total_fees`, `amount_paid`, `balance`, `created_at`, `updated_at`) VALUES
(2, 0, '1', '1', '2023 - 2024', '12275.00', '0.00', '8781.00', '2024-04-01 06:42:28', '2024-04-01 06:42:28');
INSERT INTO `account_balance` (`id`, `student_id`, `semester`, `academic_year`, `school_year`, `total_fees`, `amount_paid`, `balance`, `created_at`, `updated_at`) VALUES
(3, 0, '1', '1', '2023 - 2024', '12275.00', '0.00', '8277.00', '2024-04-01 06:51:39', '2024-04-01 06:51:39');

INSERT INTO `accounts` (`id`, `email`, `email_verified_at`, `password`, `role`, `department`, `created_at`, `updated_at`, `username`, `token`, `two_factor_auth`, `person_id`) VALUES
(4, 'marianolukkanit17@gmail.com', NULL, '$2y$10$DBBunKJsc47u4yamtxcylObAQVjWaH/mNPqqMWOAK.jcItcj2E5By', 'student', NULL, '2024-03-23 17:36:07', NULL, 'Louis', NULL, 0, 205495);
INSERT INTO `accounts` (`id`, `email`, `email_verified_at`, `password`, `role`, `department`, `created_at`, `updated_at`, `username`, `token`, `two_factor_auth`, `person_id`) VALUES
(5, 'marianolouis18@gmail.com', NULL, '$2y$10$G0HEDr91qGQijDGzMIgGAeQVTs7IkbtTGhhOcKIeFQ9cl./Mxoase', 'faculty', NULL, '2024-03-24 10:44:55', NULL, 'Ray Faculty', NULL, 0, 386);
INSERT INTO `accounts` (`id`, `email`, `email_verified_at`, `password`, `role`, `department`, `created_at`, `updated_at`, `username`, `token`, `two_factor_auth`, `person_id`) VALUES
(6, 'tristanneilbenedito@gmail.com', NULL, '$2y$10$Rkgmlgu7kfE0Jme6T6ayp.HM9sMDs2g0pq6nbHGfKZg5kmyN9Pgri', 'student', NULL, '2024-03-26 10:31:26', NULL, 'Tan Bento', NULL, 0, 201431);

INSERT INTO `admin_accounts` (`id`, `username`, `password`, `email`, `permissions`, `roles`, `created_at`, `last_login`, `status`) VALUES
(1, 'dccp', '$2y$10$DdfFIaXv0l4tBrMXT2lhPexhMnZrpKD98t1FVV.53MW1UJLihd4Ja', 'dccp@gmail.com', NULL, 'unspecified', '2024-04-02', NULL, NULL);
INSERT INTO `admin_accounts` (`id`, `username`, `password`, `email`, `permissions`, `roles`, `created_at`, `last_login`, `status`) VALUES
(2, 'admin', '$2y$10$vUXxNUqaaymWOZUewsJaEOZSrtyqGKA.nQhjWcWmkBCjEURXMZJ5q', 'dccp.edu.com@gmail.com', '[\"manageStudents\",\"manageAdmins\",\"manageFaculty\",\"viewSchedules\",\"editStudentAccounts\",\"setupAnnouncements\",\"editSchedules\"]', 'unspecified', '2024-04-02', NULL, NULL);








INSERT INTO `cache` (`key`, `value`, `expiration`) VALUES
('b2d0e8bb4b992394e2022b992fefe6da', 'i:1;', 1712311453);
INSERT INTO `cache` (`key`, `value`, `expiration`) VALUES
('b2d0e8bb4b992394e2022b992fefe6da:timer', 'i:1712311453;', 1712311453);
INSERT INTO `cache` (`key`, `value`, `expiration`) VALUES
('fbbac14114c5ec0dd641ed4ba68ea485', 'i:2;', 1712297233);
INSERT INTO `cache` (`key`, `value`, `expiration`) VALUES
('fbbac14114c5ec0dd641ed4ba68ea485:timer', 'i:1712297233;', 1712297233),
('marianolukkanit17@gmail.com|127.0.0.1', 'i:2;', 1712297128),
('marianolukkanit17@gmail.com|127.0.0.1:timer', 'i:1712297128;', 1712297128),
('users_with_roles', 'a:1:{i:0;a:11:{s:2:\"id\";i:2;s:4:\"name\";s:6:\"lorean\";s:5:\"email\";s:27:\"marianolukkanit17@gmail.com\";s:17:\"email_verified_at\";N;s:23:\"two_factor_confirmed_at\";N;s:15:\"current_team_id\";i:2;s:18:\"profile_photo_path\";N;s:10:\"created_at\";s:27:\"2024-04-03T14:06:42.000000Z\";s:10:\"updated_at\";s:27:\"2024-04-03T14:06:46.000000Z\";s:17:\"profile_photo_url\";N;s:5:\"roles\";a:1:{i:0;s:4:\"user\";}}}', 1712235467);





INSERT INTO `classes` (`id`, `subject_code`, `faculty_id`, `academic_year`, `semester`, `schedule_id`) VALUES
(13, 'GE-1', 386, '1', '1', 9);
INSERT INTO `classes` (`id`, `subject_code`, `faculty_id`, `academic_year`, `semester`, `schedule_id`) VALUES
(15, 'GE-2', 386, '1', '1', 11);
INSERT INTO `classes` (`id`, `subject_code`, `faculty_id`, `academic_year`, `semester`, `schedule_id`) VALUES
(16, 'ITW 314', 208080, '3', '2', 12);

INSERT INTO `courses` (`id`, `code`, `title`, `description`, `department`) VALUES
(1, 'BSIT', 'Bachelor of Science in Information Technology', 'Web Application', 'IT');
INSERT INTO `courses` (`id`, `code`, `title`, `description`, `department`) VALUES
(2, 'BSHM non-ABM', 'Bachelor of Science in Hospitality Management', 'for non-ABM students', 'HM');
INSERT INTO `courses` (`id`, `code`, `title`, `description`, `department`) VALUES
(3, 'BSHM', 'Bachelor of Science in Hospitality Management', 'for ABM students', 'HM');
INSERT INTO `courses` (`id`, `code`, `title`, `description`, `department`) VALUES
(4, 'BSBA non-ABM', 'Bachelor of Science in Business Administration', 'for non-ABM students', 'BA'),
(5, 'BSBA', 'Bachelor of Science in Business Administration', 'for ABM students', 'BA');

INSERT INTO `document_locations` (`id`, `documents`) VALUES
(1, '[\"C:\\\\xampp\\\\htdocs\\\\dccp-portal\\\\Routes\\\\..\\\\Resources\\\\Assets\\\\images\\\\ShayleeGleason\\\\BirthCertificate.png\"]');
INSERT INTO `document_locations` (`id`, `documents`) VALUES
(7, '{\"birthcertificate\":\"Documents\\\\students\\\\2062610\\\\BirthCertificate.csv\",\"form138\":null,\"form137\":null,\"certificateofgoodmoral\":null,\"transfercredential\":null,\"transcriptofrecords\":null,\"1x1photo\":\"Documents\\\\students\\\\2062610\\\\1x1Photo.gif\"}');
INSERT INTO `document_locations` (`id`, `documents`) VALUES
(8, '{\"birthcertificate\":null,\"form138\":null,\"form137\":null,\"certificateofgoodmoral\":null,\"transfercredential\":null,\"transcriptofrecords\":null,\"1x1photo\":\"Documents\\\\students\\\\2062611\\\\1x1Photo.gif\"}');
INSERT INTO `document_locations` (`id`, `documents`) VALUES
(9, '{\"birthcertificate\":null,\"form138\":null,\"form137\":null,\"certificateofgoodmoral\":null,\"transfercredential\":null,\"transcriptofrecords\":null,\"1x1photo\":\"Documents\\\\students\\\\2062612\\\\1x1Photo.gif\"}'),
(10, '{\"birthcertificate\":null,\"form138\":null,\"form137\":null,\"certificateofgoodmoral\":null,\"transfercredential\":null,\"transcriptofrecords\":null,\"1x1photo\":\"Documents\\\\students\\\\2062613\\\\1x1Photo.gif\"}'),
(11, '{\"birthcertificate\":null,\"form138\":null,\"form137\":null,\"certificateofgoodmoral\":null,\"transfercredential\":null,\"transcriptofrecords\":null,\"1x1photo\":null}');



INSERT INTO `faculty` (`id`, `first_name`, `last_name`, `middle_name`, `email`, `phone_number`, `department`, `office_hours`, `birth_date`, `address_line1`, `biography`, `education`, `courses_taught`, `photo_url`, `status`, `created_at`, `updated_at`, `gender`, `age`) VALUES
(386, 'Julius', 'Harris', 'Reta Bosco', 'your.email+fakedata97479@gmail.com', '295', NULL, NULL, '2024-12-01', '635 Gulgowski Locks', NULL, NULL, NULL, '/Resources/Assets/images/profiles/bot.jpg', NULL, '2024-03-20 14:57:00', '2024-03-24 20:36:54', 'male', 26);
INSERT INTO `faculty` (`id`, `first_name`, `last_name`, `middle_name`, `email`, `phone_number`, `department`, `office_hours`, `birth_date`, `address_line1`, `biography`, `education`, `courses_taught`, `photo_url`, `status`, `created_at`, `updated_at`, `gender`, `age`) VALUES
(208080, 'Data', 'Center', 'C.', 'tristanneilbenedito@gmail.com', '09497572075', NULL, NULL, '2020-03-14', 'Pinsao Pilot Project, Baguio City', NULL, NULL, NULL, '/Resources/Assets/images/profiles/bot.jpg', NULL, '2024-03-26 03:50:32', '2024-03-26 03:50:32', NULL, NULL);




INSERT INTO `guest_education_id` (`id`, `elementaryschoolname`, `elementarygraduationyear`, `seniorhighschoolname`, `seniorhighgraduationyear`) VALUES
(5, 'Junior Jacobi', 0, 'Billy Bradtke', 0);
INSERT INTO `guest_education_id` (`id`, `elementaryschoolname`, `elementarygraduationyear`, `seniorhighschoolname`, `seniorhighgraduationyear`) VALUES
(14, 'Dexter Denesik', 0, 'Ezekiel Christiansen', 0);
INSERT INTO `guest_education_id` (`id`, `elementaryschoolname`, `elementarygraduationyear`, `seniorhighschoolname`, `seniorhighgraduationyear`) VALUES
(15, 'Rebecca Schulist', 0, 'Leilani Sanford', 0);

INSERT INTO `guest_enrollments` (`id`, `selected_course`, `academic_year`, `selected_semester`, `guest_personal_info_id`, `geust_education_id`, `special_skills`, `guest_parents_id`, `guest_guardian_id`, `guest_documents_id`, `guest_tuition_id`, `created_at`, `updated_at`, `student_id`) VALUES
(12, 1, 1, 1, 14, 14, 'Cumque molestiae ducimus cum.', 14, 14, 10, 10, '2024-04-03 15:22:25', '2024-04-03 15:22:25', 2062613);
INSERT INTO `guest_enrollments` (`id`, `selected_course`, `academic_year`, `selected_semester`, `guest_personal_info_id`, `geust_education_id`, `special_skills`, `guest_parents_id`, `guest_guardian_id`, `guest_documents_id`, `guest_tuition_id`, `created_at`, `updated_at`, `student_id`) VALUES
(13, 1, 1, 1, 15, 15, 'Sed minus eius.', 15, 15, 11, 11, '2024-04-03 15:32:33', '2024-04-03 15:32:33', 2062614);


INSERT INTO `guest_guardian_contact` (`id`, `emergencycontactname`, `emergencycontactphone`, `emergencycontactaddress`) VALUES
(5, 'Lane Padberg', 84, '5290 Koepp Trafficway');
INSERT INTO `guest_guardian_contact` (`id`, `emergencycontactname`, `emergencycontactphone`, `emergencycontactaddress`) VALUES
(14, 'Leonardo Stark', 903, '193 Krajcik Inlet');
INSERT INTO `guest_guardian_contact` (`id`, `emergencycontactname`, `emergencycontactphone`, `emergencycontactaddress`) VALUES
(15, 'Johann Zemlak', 280, '592 Florida Terrace');

INSERT INTO `guest_personal_info` (`id`, `firstname`, `middleinitial`, `lastname`, `birthdate`, `birthplace`, `citizenship`, `religion`, `sex`, `civilstatus`, `weight`, `height`, `currentaddress`, `permanentaddress`, `inputemail`, `phone`) VALUES
(5, 'Shaylee', 'N', 'Gleason', '2024-06-04', '29073 Antonina Village', 'Garden Grove', 'Veniam repellat alias aliquam distinctio nam moles', 'female', 'divorced', 255, 361, '2381 Emmerich Underpass', '666 Gunner Ville', 'your.email+fakedata36448@gmail.com', 54);
INSERT INTO `guest_personal_info` (`id`, `firstname`, `middleinitial`, `lastname`, `birthdate`, `birthplace`, `citizenship`, `religion`, `sex`, `civilstatus`, `weight`, `height`, `currentaddress`, `permanentaddress`, `inputemail`, `phone`) VALUES
(14, 'Josh', 'M', 'Upton', '2025-01-17', '2996 Waino Valleys', 'Farmington Hills', 'Architecto earum harum veniam sapiente harum repud', 'female', 'married', 411, 220, '13589 Clarabelle Row', '9015 Denesik Overpass', 'your.email+fakedata96006@gmail.com', 708);
INSERT INTO `guest_personal_info` (`id`, `firstname`, `middleinitial`, `lastname`, `birthdate`, `birthplace`, `citizenship`, `religion`, `sex`, `civilstatus`, `weight`, `height`, `currentaddress`, `permanentaddress`, `inputemail`, `phone`) VALUES
(15, 'Gonzalo', 'P', 'McDermott', '2023-09-17', '724 Donnelly Fields', 'Pearland', 'Veniam fugiat velit cum eius vero blanditiis dolor', 'female', 'divorced', 1, 303, '546 Grant Terrace', '8849 Harris Orchard', 'your.email+fakedata23584@gmail.com', 381);

INSERT INTO `guest_tuition` (`id`, `totaltuition`, `downpayment`, `totalbalance`, `payment_method`) VALUES
(1, 12275, 3000, 9275, '');
INSERT INTO `guest_tuition` (`id`, `totaltuition`, `downpayment`, `totalbalance`, `payment_method`) VALUES
(10, 12275, 3001, 9274, 'cash');
INSERT INTO `guest_tuition` (`id`, `totaltuition`, `downpayment`, `totalbalance`, `payment_method`) VALUES
(11, 12275, 3000, 9275, 'digital');

INSERT INTO `guests_parents_info` (`id`, `fathersname`, `mothersname`) VALUES
(5, 'Jordane', 'Dianna Bins');
INSERT INTO `guests_parents_info` (`id`, `fathersname`, `mothersname`) VALUES
(14, 'Lazaro', 'Missouri Weimann');
INSERT INTO `guests_parents_info` (`id`, `fathersname`, `mothersname`) VALUES
(15, 'Isabel', 'Christiana Kirlin');





INSERT INTO `migrations` (`id`, `migration`, `batch`) VALUES
(1, '0001_01_01_000000_create_users_table', 1);
INSERT INTO `migrations` (`id`, `migration`, `batch`) VALUES
(2, '0001_01_01_000001_create_cache_table', 1);
INSERT INTO `migrations` (`id`, `migration`, `batch`) VALUES
(3, '0001_01_01_000002_create_jobs_table', 1);
INSERT INTO `migrations` (`id`, `migration`, `batch`) VALUES
(4, '2024_04_03_134045_add_two_factor_columns_to_users_table', 1),
(9, '2024_04_03_134128_create_personal_access_tokens_table', 2),
(10, '2024_04_03_134128_create_teams_table', 2),
(11, '2024_04_03_134129_create_team_user_table', 2),
(12, '2024_04_03_134130_create_team_invitations_table', 2);



INSERT INTO `permission_role` (`permission_id`, `role_id`) VALUES
(1, 8);
INSERT INTO `permission_role` (`permission_id`, `role_id`) VALUES
(2, 8);
INSERT INTO `permission_role` (`permission_id`, `role_id`) VALUES
(3, 8);
INSERT INTO `permission_role` (`permission_id`, `role_id`) VALUES
(4, 8),
(5, 8),
(6, 8),
(7, 8),
(8, 8),
(9, 8),
(10, 8),
(11, 8),
(12, 8),
(13, 8),
(14, 8),
(15, 8),
(16, 8),
(17, 8),
(18, 8),
(19, 8),
(20, 8),
(21, 8),
(22, 8),
(23, 8),
(24, 8),
(25, 8),
(26, 8),
(1, 10),
(2, 10),
(3, 10),
(4, 10),
(5, 10),
(6, 10),
(7, 10),
(8, 10),
(9, 10),
(10, 10),
(11, 10),
(12, 10),
(13, 10),
(14, 10),
(15, 10),
(16, 10),
(17, 10),
(18, 10),
(19, 10),
(20, 10),
(21, 10),
(22, 10),
(23, 10),
(24, 10),
(25, 10),
(26, 10),
(23, 11),
(13, 12),
(14, 12),
(15, 12),
(16, 12),
(21, 12),
(17, 13),
(18, 13),
(21, 13),
(13, 14),
(14, 14),
(15, 14),
(16, 14),
(24, 14);



INSERT INTO `permissions` (`id`, `name`, `display_name`, `description`) VALUES
(1, 'create_user', 'Create User', 'Allows the admin to create a user account');
INSERT INTO `permissions` (`id`, `name`, `display_name`, `description`) VALUES
(2, 'read_user', 'Read User', 'Allows the admin to view user account details');
INSERT INTO `permissions` (`id`, `name`, `display_name`, `description`) VALUES
(3, 'update_user', 'Update User', 'Allows the admin to update user account details');
INSERT INTO `permissions` (`id`, `name`, `display_name`, `description`) VALUES
(4, 'delete_user', 'Delete User', 'Allows the admin to delete a user account'),
(5, 'create_role', 'Create Role', 'Allows the admin to create a role for users'),
(6, 'read_role', 'Read Role', 'Allows the admin to view details of roles'),
(7, 'update_role', 'Update Role', 'Allows the admin to update role information'),
(8, 'delete_role', 'Delete Role', 'Allows the admin to delete a role'),
(9, 'create_permission', 'Create Permission', 'Allows the admin to create permissions for roles'),
(10, 'read_permission', 'Read Permission', 'Allows the admin to view details of permissions'),
(11, 'update_permission', 'Update Permission', 'Allows the admin to update permission details'),
(12, 'delete_permission', 'Delete Permission', 'Allows the admin to delete permissions'),
(13, 'create_course', 'Create Course', 'Allows the admin to create a new course'),
(14, 'read_course', 'Read Course', 'Allows the admin to view course details'),
(15, 'update_course', 'Update Course', 'Allows the admin to update course information'),
(16, 'delete_course', 'Delete Course', 'Allows the admin to delete a course'),
(17, 'create_announcement', 'Create Announcement', 'Allows the admin to create an announcement for the portal'),
(18, 'read_announcement', 'Read Announcement', 'Allows the admin to view announcements'),
(19, 'update_announcement', 'Update Announcement', 'Allows the admin to update announcement details'),
(20, 'delete_announcement', 'Delete Announcement', 'Allows the admin to delete an announcement'),
(21, 'manage_enrollment', 'Manage Enrollment', 'Allows the admin to manage student enrollments'),
(22, 'view_reports', 'View Reports', 'Allows the admin to view various reports and analytics'),
(23, 'manage_finances', 'Manage Finances', 'Allows the admin to manage financial aspects of the school'),
(24, 'schedule_classes', 'Schedule Classes', 'Allows the admin to schedule classes for courses'),
(25, 'manage_library', 'Manage Library', 'Allows the admin to manage library resources'),
(26, 'manage_facilities', 'Manage Facilities', 'Allows the admin to manage school facilities');



INSERT INTO `roles` (`RoleID`, `RoleName`) VALUES
(8, 'admin');
INSERT INTO `roles` (`RoleID`, `RoleName`) VALUES
(9, 'user');
INSERT INTO `roles` (`RoleID`, `RoleName`) VALUES
(10, 'superadmin');
INSERT INTO `roles` (`RoleID`, `RoleName`) VALUES
(11, 'cashier'),
(12, 'registrar'),
(13, 'student_affairs'),
(14, 'academic_affairs');



INSERT INTO `rooms` (`id`, `room_name`, `facility`) VALUES
(1, 'LAN', 'laboratory');
INSERT INTO `rooms` (`id`, `room_name`, `facility`) VALUES
(2, '402', 'lecture');
INSERT INTO `rooms` (`id`, `room_name`, `facility`) VALUES
(3, '401', 'lecture');

INSERT INTO `schedules` (`id`, `subject_code`, `courses`, `academic_year`, `room_id`, `days`, `start_time`, `end_time`, `type`) VALUES
(9, 'GE-1', '[\"1\",\"2\"]', '1', 2, '[\"wednesday\",\"thursday\"]', '11:00:00', '12:00:00', 'lecture');
INSERT INTO `schedules` (`id`, `subject_code`, `courses`, `academic_year`, `room_id`, `days`, `start_time`, `end_time`, `type`) VALUES
(10, 'ITW 327', '[\"1\"]', '3', 1, '[\"saturday\"]', '08:30:00', '11:00:00', 'lecture');
INSERT INTO `schedules` (`id`, `subject_code`, `courses`, `academic_year`, `room_id`, `days`, `start_time`, `end_time`, `type`) VALUES
(11, 'GE-2', '[\"1\"]', '1', 3, '[\"monday\"]', '08:00:00', '11:00:00', 'lecture');
INSERT INTO `schedules` (`id`, `subject_code`, `courses`, `academic_year`, `room_id`, `days`, `start_time`, `end_time`, `type`) VALUES
(12, 'ITW 314', '[\"1\"]', '3', 1, '[\"monday\",\"wednesday\",\"friday\"]', '08:00:00', '09:00:00', 'laboratory'),
(13, 'GE-1', '[\"4\"]', '1', 1, '[\"monday\"]', '09:00:00', '10:00:00', 'lecture');

INSERT INTO `sessions` (`id`, `user_id`, `ip_address`, `user_agent`, `payload`, `last_activity`) VALUES
('1o7Zf3ykCXKfP74IVsgo6CK9iDhth0rx4LZpixEk', NULL, '127.0.0.1', 'Mozilla/5.0 (Windows NT 10.0; Win64; x64; rv:124.0) Gecko/20100101 Firefox/124.0', 'YTo0OntzOjY6Il90b2tlbiI7czo0MDoiVU5veEZjNUdXNGNhWW1MVG92VkZRNGhpc0kxbXhnM0R3TzN4bTQwSCI7czozOiJ1cmwiO2E6MTp7czo4OiJpbnRlbmRlZCI7czozMzoiaHR0cDovLzEyNy4wLjAuMTo4MDAwL2FkbWlucy9saXN0Ijt9czo5OiJfcHJldmlvdXMiO2E6MTp7czozOiJ1cmwiO3M6Mjc6Imh0dHA6Ly8xMjcuMC4wLjE6ODAwMC9sb2dpbiI7fXM6NjoiX2ZsYXNoIjthOjI6e3M6Mzoib2xkIjthOjA6e31zOjM6Im5ldyI7YTowOnt9fX0=', 1712300939);
INSERT INTO `sessions` (`id`, `user_id`, `ip_address`, `user_agent`, `payload`, `last_activity`) VALUES
('qo3JikDNVsQXphcaZ8KK9E96Wibmgi8csH2vvqxu', 2, '127.0.0.1', 'Mozilla/5.0 (Windows NT 10.0; Win64; x64; rv:124.0) Gecko/20100101 Firefox/124.0', 'YTo2OntzOjM6InVybCI7YTowOnt9czo5OiJfcHJldmlvdXMiO2E6MTp7czozOiJ1cmwiO3M6Mzc6Imh0dHA6Ly8xMjcuMC4wLjE6ODAwMC9zdHVkZW50cy9tYW5hZ2UiO31zOjY6Il9mbGFzaCI7YToyOntzOjM6Im9sZCI7YTowOnt9czozOiJuZXciO2E6MDp7fX1zOjY6Il90b2tlbiI7czo0MDoidTdGSEJjb25tSEdadjN4TEZoNDV0OTBFMFFFRFJBdzgzdlpEUVgydCI7czo1MDoibG9naW5fd2ViXzU5YmEzNmFkZGMyYjJmOTQwMTU4MGYwMTRjN2Y1OGVhNGUzMDk4OWQiO2k6MjtzOjIxOiJwYXNzd29yZF9oYXNoX3NhbmN0dW0iO3M6NjA6IiQyeSQxMiR4RkxsN1NrUFRjQlhRS3VibE9YdWlPQVBra3RCcmdvRHJsbHo4dG9wbWFRSDFxQmJGY3NTNiI7fQ==', 1712300779);
INSERT INTO `sessions` (`id`, `user_id`, `ip_address`, `user_agent`, `payload`, `last_activity`) VALUES
('rQIE0J4wAPeQLeap5qFMqkHFyVqAeapnqzqLPLSA', 2, '127.0.0.1', 'Mozilla/5.0 (Windows NT 10.0; Win64; x64; rv:124.0) Gecko/20100101 Firefox/124.0', 'YTo0OntzOjY6Il90b2tlbiI7czo0MDoiQVFBUTZIUWZxbFYyaEpXUFpKWGN4TlFRdjd1dVQ3VjRhWWIwdHRSMCI7czo5OiJfcHJldmlvdXMiO2E6MTp7czozOiJ1cmwiO3M6MzE6Imh0dHA6Ly8xMjcuMC4wLjE6ODAwMC9kYXNoYm9hcmQiO31zOjY6Il9mbGFzaCI7YToyOntzOjM6Im9sZCI7YTowOnt9czozOiJuZXciO2E6MDp7fX1zOjUwOiJsb2dpbl93ZWJfNTliYTM2YWRkYzJiMmY5NDAxNTgwZjAxNGM3ZjU4ZWE0ZTMwOTg5ZCI7aToyO30=', 1712319293);
INSERT INTO `sessions` (`id`, `user_id`, `ip_address`, `user_agent`, `payload`, `last_activity`) VALUES
('yzliAsapxUqUSGVA8vfOlytATijSGI30il93GD0x', NULL, '127.0.0.1', 'Mozilla/5.0 (Windows NT 10.0; Win64; x64; rv:124.0) Gecko/20100101 Firefox/124.0', 'YTozOntzOjY6Il90b2tlbiI7czo0MDoiWEpNejZpdjVCdzV4VFZGN25vRVlmTG1BRUxmTzRpdFlTMGpIS0NjayI7czo5OiJfcHJldmlvdXMiO2E6MTp7czozOiJ1cmwiO3M6Mjc6Imh0dHA6Ly8xMjcuMC4wLjE6ODAwMC9sb2dpbiI7fXM6NjoiX2ZsYXNoIjthOjI6e3M6Mzoib2xkIjthOjA6e31zOjM6Im5ldyI7YTowOnt9fX0=', 1712300958);

INSERT INTO `student_contacts` (`id`, `emergency_contact_name`, `emergency_contact_phone`, `emergency_contact_address`, `facebook_contact`, `personal_contact`) VALUES
(1, 'Kari Becker', 140, '4141 Nikolaus Passage', NULL, 577);
INSERT INTO `student_contacts` (`id`, `emergency_contact_name`, `emergency_contact_phone`, `emergency_contact_address`, `facebook_contact`, `personal_contact`) VALUES
(2, 'Kari Becker', 140, '4141 Nikolaus Passage', NULL, 577);
INSERT INTO `student_contacts` (`id`, `emergency_contact_name`, `emergency_contact_phone`, `emergency_contact_address`, `facebook_contact`, `personal_contact`) VALUES
(3, 'Kari Becker', 140, '4141 Nikolaus Passage', NULL, 577);
INSERT INTO `student_contacts` (`id`, `emergency_contact_name`, `emergency_contact_phone`, `emergency_contact_address`, `facebook_contact`, `personal_contact`) VALUES
(4, 'Kari Becker', 140, '4141 Nikolaus Passage', NULL, 577),
(5, 'Kari Becker', 140, '4141 Nikolaus Passage', NULL, 577),
(6, 'Kari Becker', 140, '4141 Nikolaus Passage', NULL, 577),
(7, 'Kari Becker', 140, '4141 Nikolaus Passage', NULL, 577),
(8, 'Kari Becker', 140, '4141 Nikolaus Passage', NULL, 577),
(9, 'Kari Becker', 140, '4141 Nikolaus Passage', NULL, 577),
(10, 'Kari Becker', 140, '4141 Nikolaus Passage', NULL, 577),
(11, 'Kari Becker', 140, '4141 Nikolaus Passage', NULL, 577),
(12, 'Kari Becker', 140, '4141 Nikolaus Passage', NULL, 577),
(13, 'Kari Becker', 140, '4141 Nikolaus Passage', NULL, 577),
(14, 'Kari Becker', 140, '4141 Nikolaus Passage', NULL, 577),
(15, 'Kari Becker', 140, '4141 Nikolaus Passage', NULL, 577),
(16, 'Kari Becker', 140, '4141 Nikolaus Passage', NULL, 577),
(17, 'Kari Becker', 140, '4141 Nikolaus Passage', NULL, 577),
(18, 'Kari Becker', 140, '4141 Nikolaus Passage', NULL, 577),
(19, 'Kari Becker', 140, '4141 Nikolaus Passage', NULL, 577),
(20, 'Kari Becker', 140, '4141 Nikolaus Passage', NULL, 577),
(21, 'Kari Becker', 140, '4141 Nikolaus Passage', NULL, 577),
(22, 'Kari Becker', 140, '4141 Nikolaus Passage', NULL, 577),
(23, 'Kari Becker', 140, '4141 Nikolaus Passage', NULL, 577),
(24, 'Kari Becker', 140, '4141 Nikolaus Passage', NULL, 577),
(25, 'Kari Becker', 140, '4141 Nikolaus Passage', NULL, 577),
(26, 'Kari Becker', 140, '4141 Nikolaus Passage', NULL, 577),
(27, 'Kari Becker', 140, '4141 Nikolaus Passage', NULL, 577),
(28, 'Kari Becker', 140, '4141 Nikolaus Passage', NULL, 577),
(29, 'Kari Becker', 140, '4141 Nikolaus Passage', NULL, 577),
(30, 'Kari Becker', 140, '4141 Nikolaus Passage', NULL, 577),
(31, 'Kari Becker', 140, '4141 Nikolaus Passage', NULL, 577),
(32, 'Kari Becker', 140, '4141 Nikolaus Passage', NULL, 577),
(33, 'Kari Becker', 140, '4141 Nikolaus Passage', NULL, 577),
(34, 'Kari Becker', 140, '4141 Nikolaus Passage', NULL, 577),
(35, 'Kari Becker', 140, '4141 Nikolaus Passage', NULL, 577),
(36, 'Kari Becker', 140, '4141 Nikolaus Passage', NULL, 577),
(37, 'Kari Becker', 140, '4141 Nikolaus Passage', NULL, 577),
(38, 'Kari Becker', 140, '4141 Nikolaus Passage', NULL, 577),
(39, 'Kari Becker', 140, '4141 Nikolaus Passage', NULL, 577),
(40, 'Kari Becker', 140, '4141 Nikolaus Passage', NULL, 577),
(41, 'Kari Becker', 140, '4141 Nikolaus Passage', NULL, 577),
(42, 'Kari Becker', 140, '4141 Nikolaus Passage', NULL, 577),
(43, 'Kari Becker', 140, '4141 Nikolaus Passage', NULL, 577),
(44, 'Kari Becker', 140, '4141 Nikolaus Passage', NULL, 577),
(45, 'Kari Becker', 140, '4141 Nikolaus Passage', NULL, 577),
(46, 'Kari Becker', 140, '4141 Nikolaus Passage', NULL, 577),
(47, 'Kari Becker', 140, '4141 Nikolaus Passage', NULL, 577),
(48, 'Kari Becker', 140, '4141 Nikolaus Passage', NULL, 577),
(49, 'Kari Becker', 140, '4141 Nikolaus Passage', NULL, 577),
(50, 'Kari Becker', 140, '4141 Nikolaus Passage', NULL, 577),
(51, 'Kari Becker', 140, '4141 Nikolaus Passage', NULL, 577),
(52, 'Kari Becker', 140, '4141 Nikolaus Passage', NULL, 577),
(53, 'Kari Becker', 140, '4141 Nikolaus Passage', NULL, 577),
(54, 'Kari Becker', 140, '4141 Nikolaus Passage', NULL, 577),
(55, 'Kari Becker', 140, '4141 Nikolaus Passage', NULL, 577),
(56, 'Kari Becker', 140, '4141 Nikolaus Passage', NULL, 577),
(57, 'Kari Becker', 140, '4141 Nikolaus Passage', NULL, 577),
(58, 'Giovanna Veum', 332, '23673 Botsford-Shields Loaf', NULL, 426),
(59, NULL, NULL, NULL, NULL, NULL),
(60, 'Alison Thompson', 692, '221 Ardella Extensions', NULL, 887),
(61, NULL, NULL, NULL, NULL, NULL);

INSERT INTO `student_education_info` (`id`, `elementary_school`, `elementary_graduate_year`, `senior_high_name`, `senior_high_graduate_year`) VALUES
(1, 'Henri Harris', NULL, NULL, NULL);
INSERT INTO `student_education_info` (`id`, `elementary_school`, `elementary_graduate_year`, `senior_high_name`, `senior_high_graduate_year`) VALUES
(2, 'Henri Harris', NULL, NULL, NULL);
INSERT INTO `student_education_info` (`id`, `elementary_school`, `elementary_graduate_year`, `senior_high_name`, `senior_high_graduate_year`) VALUES
(3, 'Henri Harris', NULL, NULL, NULL);
INSERT INTO `student_education_info` (`id`, `elementary_school`, `elementary_graduate_year`, `senior_high_name`, `senior_high_graduate_year`) VALUES
(4, 'Henri Harris', NULL, NULL, NULL),
(5, 'Henri Harris', NULL, NULL, NULL),
(6, 'Henri Harris', NULL, NULL, NULL),
(7, 'Henri Harris', NULL, NULL, NULL),
(8, 'Henri Harris', NULL, NULL, NULL),
(9, 'Henri Harris', NULL, NULL, NULL),
(10, 'Henri Harris', NULL, NULL, NULL),
(11, 'Henri Harris', NULL, NULL, NULL),
(12, 'Henri Harris', NULL, NULL, NULL),
(13, 'Henri Harris', NULL, NULL, NULL),
(14, 'Henri Harris', NULL, NULL, NULL),
(15, 'Henri Harris', NULL, NULL, NULL),
(16, 'Henri Harris', NULL, NULL, NULL),
(17, 'Henri Harris', NULL, NULL, NULL),
(18, 'Henri Harris', NULL, NULL, NULL),
(19, 'Henri Harris', NULL, NULL, NULL),
(20, 'Henri Harris', NULL, NULL, NULL),
(21, 'Henri Harris', NULL, NULL, NULL),
(22, 'Henri Harris', NULL, NULL, NULL),
(23, 'Henri Harris', NULL, NULL, NULL),
(24, 'Henri Harris', NULL, NULL, NULL),
(25, 'Henri Harris', NULL, NULL, NULL),
(26, 'Henri Harris', NULL, NULL, NULL),
(27, 'Henri Harris', NULL, NULL, NULL),
(28, 'Henri Harris', NULL, NULL, NULL),
(29, 'Henri Harris', NULL, NULL, NULL),
(30, 'Henri Harris', NULL, NULL, NULL),
(31, 'Henri Harris', NULL, NULL, NULL),
(32, 'Henri Harris', NULL, NULL, NULL),
(33, 'Henri Harris', NULL, NULL, NULL),
(34, 'Henri Harris', NULL, NULL, NULL),
(35, 'Henri Harris', NULL, NULL, NULL),
(36, 'Henri Harris', NULL, NULL, NULL),
(37, 'Henri Harris', NULL, NULL, NULL),
(38, 'Henri Harris', NULL, NULL, NULL),
(39, 'Henri Harris', NULL, NULL, NULL),
(40, 'Henri Harris', NULL, NULL, NULL),
(41, 'Henri Harris', NULL, NULL, NULL),
(42, 'Henri Harris', NULL, NULL, NULL),
(43, 'Henri Harris', NULL, NULL, NULL),
(44, 'Henri Harris', NULL, NULL, NULL),
(45, 'Henri Harris', NULL, NULL, NULL),
(46, 'Henri Harris', NULL, NULL, NULL),
(47, 'Henri Harris', NULL, NULL, NULL),
(48, 'Henri Harris', NULL, NULL, NULL),
(49, 'Henri Harris', NULL, NULL, NULL),
(50, 'Henri Harris', NULL, NULL, NULL),
(51, 'Henri Harris', NULL, NULL, NULL),
(52, 'Henri Harris', NULL, NULL, NULL),
(53, 'Henri Harris', NULL, NULL, NULL),
(54, 'Henri Harris', NULL, NULL, NULL),
(55, 'Henri Harris', NULL, NULL, NULL),
(56, 'Henri Harris', NULL, NULL, NULL),
(57, 'Henri Harris', NULL, NULL, NULL),
(58, 'Jovany Klein', NULL, NULL, NULL),
(59, NULL, NULL, NULL, NULL),
(60, 'Jessica Ryan', NULL, NULL, NULL),
(61, NULL, NULL, NULL, NULL);

INSERT INTO `student_parents_info` (`id`, `fathers_name`, `mothers_name`) VALUES
(1, 'Christopher', 'Serena Zemlak');
INSERT INTO `student_parents_info` (`id`, `fathers_name`, `mothers_name`) VALUES
(2, 'Christopher', 'Serena Zemlak');
INSERT INTO `student_parents_info` (`id`, `fathers_name`, `mothers_name`) VALUES
(3, 'Christopher', 'Serena Zemlak');
INSERT INTO `student_parents_info` (`id`, `fathers_name`, `mothers_name`) VALUES
(4, 'Christopher', 'Serena Zemlak'),
(5, 'Christopher', 'Serena Zemlak'),
(6, 'Christopher', 'Serena Zemlak'),
(7, 'Christopher', 'Serena Zemlak'),
(8, 'Christopher', 'Serena Zemlak'),
(9, 'Christopher', 'Serena Zemlak'),
(10, 'Christopher', 'Serena Zemlak'),
(11, 'Christopher', 'Serena Zemlak'),
(12, 'Christopher', 'Serena Zemlak'),
(13, 'Christopher', 'Serena Zemlak'),
(14, 'Christopher', 'Serena Zemlak'),
(15, 'Christopher', 'Serena Zemlak'),
(16, 'Christopher', 'Serena Zemlak'),
(17, 'Christopher', 'Serena Zemlak'),
(18, 'Christopher', 'Serena Zemlak'),
(19, 'Christopher', 'Serena Zemlak'),
(20, 'Christopher', 'Serena Zemlak'),
(21, 'Christopher', 'Serena Zemlak'),
(22, 'Christopher', 'Serena Zemlak'),
(23, 'Christopher', 'Serena Zemlak'),
(24, 'Christopher', 'Serena Zemlak'),
(25, 'Christopher', 'Serena Zemlak'),
(26, 'Christopher', 'Serena Zemlak'),
(27, 'Christopher', 'Serena Zemlak'),
(28, 'Christopher', 'Serena Zemlak'),
(29, 'Christopher', 'Serena Zemlak'),
(30, 'Christopher', 'Serena Zemlak'),
(31, 'Christopher', 'Serena Zemlak'),
(32, 'Christopher', 'Serena Zemlak'),
(33, 'Christopher', 'Serena Zemlak'),
(34, 'Christopher', 'Serena Zemlak'),
(35, 'Christopher', 'Serena Zemlak'),
(36, 'Christopher', 'Serena Zemlak'),
(37, 'Christopher', 'Serena Zemlak'),
(38, 'Christopher', 'Serena Zemlak'),
(39, 'Christopher', 'Serena Zemlak'),
(40, 'Christopher', 'Serena Zemlak'),
(41, 'Christopher', 'Serena Zemlak'),
(42, 'Christopher', 'Serena Zemlak'),
(43, 'Christopher', 'Serena Zemlak'),
(44, 'Christopher', 'Serena Zemlak'),
(45, 'Christopher', 'Serena Zemlak'),
(46, 'Christopher', 'Serena Zemlak'),
(47, 'Christopher', 'Serena Zemlak'),
(48, 'Christopher', 'Serena Zemlak'),
(49, 'Christopher', 'Serena Zemlak'),
(50, 'Christopher', 'Serena Zemlak'),
(51, 'Christopher', 'Serena Zemlak'),
(52, 'Christopher', 'Serena Zemlak'),
(53, 'Christopher', 'Serena Zemlak'),
(54, 'Christopher', 'Serena Zemlak'),
(55, 'Christopher', 'Serena Zemlak'),
(56, 'Christopher', 'Serena Zemlak'),
(57, 'Christopher', 'Serena Zemlak'),
(58, 'Orland', 'Buddy Mayer'),
(59, NULL, NULL),
(60, 'Gustave', 'Adah Kuhlman'),
(61, NULL, NULL);

INSERT INTO `students` (`id`, `first_name`, `last_name`, `middle_name`, `gender`, `birth_date`, `age`, `address`, `contacts`, `course_id`, `academic_year`, `email`, `remarks`, `created_at`, `updated_at`, `profile_url`, `student_contact_id`, `student_parent_info`, `student_education_id`, `student_personal_id`, `document_location_id`) VALUES
(0, 'Kurt Russel', 'Hufana', 'Balodong', 'male', '2004-07-14', 19, '74 engineers hill', '{\"Guardian_contact\":null,\"Personal_contact\":\"09196836374\",\"Facebook\":null}', 1, 1, 'krhufana04@gmail.com', '                                anglelika', '2024-03-20 09:58:04', '2024-03-20 09:58:04', '/Resources/Assets/images/profiles/bot.jpg', NULL, NULL, NULL, NULL, NULL);
INSERT INTO `students` (`id`, `first_name`, `last_name`, `middle_name`, `gender`, `birth_date`, `age`, `address`, `contacts`, `course_id`, `academic_year`, `email`, `remarks`, `created_at`, `updated_at`, `profile_url`, `student_contact_id`, `student_parent_info`, `student_education_id`, `student_personal_id`, `document_location_id`) VALUES
(94823, 'gadfs', 'gasdf', 'adgasd', 'female', '5000-05-31', 24, '38c1 brookside', '{\"Guardian_contact\":null,\"Personal_contact\":\"092489238477\",\"Facebook\":null}', 1, 3, 'kleidmephisto3@gmail.com', 'HAHAHAH GAY                                ', '2024-03-20 07:46:10', '2024-03-20 07:46:10', '/Resources/Assets/images/profiles/bot.jpg', NULL, NULL, NULL, NULL, NULL);
INSERT INTO `students` (`id`, `first_name`, `last_name`, `middle_name`, `gender`, `birth_date`, `age`, `address`, `contacts`, `course_id`, `academic_year`, `email`, `remarks`, `created_at`, `updated_at`, `profile_url`, `student_contact_id`, `student_parent_info`, `student_education_id`, `student_personal_id`, `document_location_id`) VALUES
(201431, 'Tan', 'Bento', 'Reyes', 'male', '2002-03-14', 22, 'Pinsao Pilot Project, Baguio City', '{\"Guardian_contact\":null,\"Personal_contact\":\"09497572079\",\"Facebook\":null}', 1, 4, 'tristanneilbenedito@gmail.com', '                                ', '2024-03-26 03:27:24', '2024-03-26 03:27:24', '/Resources/Assets/images/profiles/bot.jpg', NULL, NULL, NULL, NULL, NULL);
INSERT INTO `students` (`id`, `first_name`, `last_name`, `middle_name`, `gender`, `birth_date`, `age`, `address`, `contacts`, `course_id`, `academic_year`, `email`, `remarks`, `created_at`, `updated_at`, `profile_url`, `student_contact_id`, `student_parent_info`, `student_education_id`, `student_personal_id`, `document_location_id`) VALUES
(205073, 'Jake Christon', 'Agustin', 'Kumanab', 'male', '1999-03-04', 25, 'Au #31 Upper Ambiong La Trinidad Benguet', '{\"Guardian_contact\":null,\"Personal_contact\":\"09662034981\",\"Facebook\":null}', 1, 3, 'jakeagustin38@gmail.com', '                                ', '2024-03-23 14:58:51', '2024-03-23 14:58:51', '/Resources/Assets/images/profiles/bot.jpg', NULL, NULL, NULL, NULL, NULL),
(205247, 'Tristan Neil', 'Benedito', 'Reyes', 'male', '2002-03-14', 22, 'Pinsao Pilot Project, Baguio City', '{\"Guardian_contact\":null,\"Personal_contact\":\"09497572078\",\"Facebook\":null}', 1, 4, 'tristanneilb.14@gmail.com', '                                ', '2024-03-26 02:51:23', '2024-03-26 02:51:23', '/Resources/Assets/images/profiles/bot.jpg', NULL, NULL, NULL, NULL, NULL),
(205443, 'Jelmar', 'Tinong', 'Guimba', 'male', '2002-02-05', 22, 'Bogayong Ampucao Itogon Benguet', '{\"Guardian_contact\":null,\"Personal_contact\":\"09630240566\",\"Facebook\":null}', 1, 3, 'jelmartinong2002@gmail.com', '     Si Zed ang Master ng kalokohan.                ', '2024-03-20 08:18:05', '2024-03-20 08:18:05', '/Resources/Assets/images/profiles/bot.jpg', NULL, NULL, NULL, NULL, NULL),
(205495, 'Loreano Dee Louis', 'Lukkani', 'M', 'male', '2002-09-08', 22, '4329 Lenna Divide', '{\"Guardian_contact\":null,\"Personal_contact\":\"550234234\",\"Facebook\":null}', 1, 3, 'marianolukkanit17@gmail.com', '                                ', '2024-03-18 04:03:27', '2024-03-18 04:03:27', '/Resources/Assets/images/profiles/bot.jpg', NULL, NULL, NULL, NULL, NULL),
(205531, 'Sophia', 'Hagnaya', 'Boiser', 'female', '2002-09-07', 21, 'Binga, Tinongdan, Itogon, Benguet', '{\"Guardian_contact\":null,\"Personal_contact\":\"09814556195\",\"Facebook\":null}', 1, 3, 'sofiabangtan07@gmail.com', 'Thank You!', '2024-03-20 08:14:51', '2024-03-20 08:14:51', '/Resources/Assets/images/profiles/bot.jpg', NULL, NULL, NULL, NULL, NULL),
(205711, 'Zedrick Piolo', 'Castro', 'Taracatac', 'male', '2000-04-13', 23, '38c1 Upper Brookside', '{\"Guardian_contact\":null,\"Personal_contact\":\"09381258928\",\"Facebook\":null}', 1, 3, 'zedrickpiolocastro@gmail.lcom', '                                POGI', '2024-03-20 07:43:10', '2024-03-20 07:43:10', '/Resources/Assets/images/profiles/bot.jpg', NULL, NULL, NULL, NULL, NULL),
(205809, 'Sara ', 'Esperas ', 'H', 'female', '2004-03-05', 20, '#59 A Palma street. Baguio City ', '{\"Guardian_contact\":null,\"Personal_contact\":\"09085220862\",\"Facebook\":null}', 1, 2, 'Saraesperas539@gamil.com', '                                ', '2024-03-23 14:46:48', '2024-03-23 14:46:48', '/Resources/Assets/images/profiles/bot.jpg', NULL, NULL, NULL, NULL, NULL),
(205810, 'Ronamie', 'Frigillana', 'O', 'female', '2001-06-03', 22, 'Camp 7 Baguio city', '{\"Guardian_contact\":null,\"Personal_contact\":\"09660820384\",\"Facebook\":null}', 1, 2, 'frigillanaronamie@gmail.com', '                                ', '2024-03-23 14:56:43', '2024-03-23 14:56:43', '/Resources/Assets/images/profiles/bot.jpg', NULL, NULL, NULL, NULL, NULL),
(205814, 'Nestor', 'Macadaeg', 'B', 'male', '2003-11-25', 20, '05-A Navy Base Rd. ', '{\"Guardian_contact\":null,\"Personal_contact\":\"09473230982\",\"Facebook\":null}', 1, 2, 'nestormacadaeg25@gmail.com', '                                ', '2024-03-23 15:10:25', '2024-03-23 15:10:25', '/Resources/Assets/images/profiles/bot.jpg', NULL, NULL, NULL, NULL, NULL),
(205819, 'Tom Jones ', 'Laban', 'Dengyasen', 'male', '0004-05-26', 19, 'Loakan liwanag Baguio City', '{\"Guardian_contact\":null,\"Personal_contact\":\"09817497985\",\"Facebook\":null}', 1, 2, 'tjlaban@gmail.com', '                                ', '2024-03-23 15:12:33', '2024-03-23 15:12:33', '/Resources/Assets/images/profiles/bot.jpg', NULL, NULL, NULL, NULL, NULL),
(205844, 'Erika', 'Bangco', 'L', 'female', '2004-05-19', 19, 'Blk 1 lot 5 Pinesville SUBD.', '{\"Guardian_contact\":null,\"Personal_contact\":\"09562537726\",\"Facebook\":null}', 1, 2, 'erikabangco19@gmail.com', '                                ', '2024-03-23 14:53:23', '2024-03-23 14:53:23', '/Resources/Assets/images/profiles/bot.jpg', NULL, NULL, NULL, NULL, NULL),
(205859, 'Jan Mart ', 'Macadaeg', 'Balangue', 'male', '2003-01-17', 21, '110 BHD Compound T. Alonzo St. Baguio City', '{\"Guardian_contact\":null,\"Personal_contact\":\"09056531625\",\"Facebook\":null}', 1, 2, 'jmmacadaeg17@gmail.com', '                                ', '2024-03-23 14:34:54', '2024-03-23 14:34:54', '/Resources/Assets/images/profiles/bot.jpg', NULL, NULL, NULL, NULL, NULL),
(205861, 'Michael Anthony ', 'Jimenez', 'D.', 'female', '2003-07-13', 20, '092 Happy Homes Old Lucban,Baguio City', '{\"Guardian_contact\":null,\"Personal_contact\":\"09060795431\",\"Facebook\":null}', 1, 2, 'michaelanthonyjimenez013@gmail.com', '                                ', '2024-03-23 14:31:56', '2024-03-23 14:31:56', '/Resources/Assets/images/profiles/bot.jpg', NULL, NULL, NULL, NULL, NULL),
(205890, 'Honey Grace', 'Oliveria', 'M', 'female', '2004-10-29', 19, '6118 Purok #6 Kias', '{\"Guardian_contact\":null,\"Personal_contact\":\"09359489227\",\"Facebook\":null}', 1, 2, 'honeygraceoliveria@gmail.com', '                                ', '2024-03-23 15:01:07', '2024-03-23 15:01:07', '/Resources/Assets/images/profiles/bot.jpg', NULL, NULL, NULL, NULL, NULL),
(205968, 'Micaella', 'Dela Cruz ', 'G', 'female', '2003-07-07', 20, '#06 daisy street upper Fairview baguio city ', '{\"Guardian_contact\":null,\"Personal_contact\":\"09501252531\",\"Facebook\":null}', 1, 2, 'micaellad15@gmail.com', '                                ', '2024-03-23 14:49:39', '2024-03-23 14:49:39', '/Resources/Assets/images/profiles/bot.jpg', NULL, NULL, NULL, NULL, NULL),
(206086, 'Mark Joseph', 'Sasa', 'N', 'male', '1996-12-23', 27, 'Barangay Lualhati, Benguet, Baguio City', '{\"Guardian_contact\":null,\"Personal_contact\":\"09662546388\",\"Facebook\":null}', 1, 1, 'markjoseph995@gmail.com', '                                ', '2024-03-23 14:39:40', '2024-03-23 14:39:40', '/Resources/Assets/images/profiles/bot.jpg', NULL, NULL, NULL, NULL, NULL),
(206099, 'Jerick Chris', 'Omilig', 'Pecay', 'Select gen', '0005-10-29', 18, 'Upper P. Burgos #17c', '{\"Guardian_contact\":null,\"Personal_contact\":\"09615925122\",\"Facebook\":null}', 1, 1, 'jerickomilig@gmail.com', '                                ', '2024-03-23 14:42:51', '2024-03-23 14:42:51', '/Resources/Assets/images/profiles/bot.jpg', NULL, NULL, NULL, NULL, NULL),
(206114, 'Nica Marie', 'Macdangdang', 'Comorposa', 'female', '1996-09-30', 27, 'camp 7 carantes compound', '{\"Guardian_contact\":null,\"Personal_contact\":\"09277181467\",\"Facebook\":null}', 2, 1, 'nicamariemacdangdang3@gmail.com', '                                ', '2024-03-20 09:56:15', '2024-03-20 09:56:15', '/Resources/Assets/images/profiles/bot.jpg', NULL, NULL, NULL, NULL, NULL),
(206224, 'christine', 'dinos', 'palalay', 'female', '2004-12-27', 19, '648 magnolia st qm', '{\"Guardian_contact\":null,\"Personal_contact\":\"09318977702\",\"Facebook\":null}', 2, 1, 'dinoschristine448@gmail.com', '                                angelika', '2024-03-20 09:56:17', '2024-03-20 09:56:17', '/Resources/Assets/images/profiles/bot.jpg', NULL, NULL, NULL, NULL, NULL),
(206243, 'philip daniel', 'patiion', 'n/a', 'male', '2005-08-23', 18, 'pacdal, maria basa', '{\"Guardian_contact\":null,\"Personal_contact\":\"09695048428\",\"Facebook\":null}', 1, 1, 'philipdanielpp@gmail.com', '                dasdasd                ', '2024-03-20 09:54:23', '2024-03-20 09:54:23', '/Resources/Assets/images/profiles/bot.jpg', NULL, NULL, NULL, NULL, NULL),
(206246, 'Maria Mae', 'Banggoy', 'Luis', 'female', '2003-10-01', 20, '17-C Upper Brookside', '{\"Guardian_contact\":null,\"Personal_contact\":\"09614910579\",\"Facebook\":null}', 2, 1, 'Mariamaebanggoy97@gmail.com', '                              angelika  ', '2024-03-20 09:51:46', '2024-03-20 09:51:46', '/Resources/Assets/images/profiles/bot.jpg', NULL, NULL, NULL, NULL, NULL),
(206263, 'Jearl Frances', 'Batiyeg', 'Tengco', 'female', '2001-06-19', 22, '#214 Purok 5 Lower Dagsian, Baguio City', '{\"Guardian_contact\":null,\"Personal_contact\":\"09291821418\",\"Facebook\":null}', 1, 1, 'delacruzjearl19@gmail.com', '                               angelika ', '2024-03-20 09:50:25', '2024-03-20 09:50:25', '/Resources/Assets/images/profiles/bot.jpg', NULL, NULL, NULL, NULL, NULL),
(206270, 'Rey', 'Pagaddut', 'A', 'male', '1993-10-23', 24, 'Suyoc, Banangan, Sablan, Benguet ', '{\"Guardian_contact\":null,\"Personal_contact\":\"09102758752\",\"Facebook\":null}', 1, 2, '1023rey@gmail.com', '                                ', '2024-03-23 15:08:24', '2024-03-23 15:08:24', '/Resources/Assets/images/profiles/bot.jpg', NULL, NULL, NULL, NULL, NULL),
(206376, 'KIim Xavier', 'Hufana', 'B', 'male', '2003-04-27', 20, 'Aurora Hill', '{\"Guardian_contact\":null,\"Personal_contact\":\"09692559977\",\"Facebook\":null}', 1, 1, 'hufana@gmail.com', '                                n/a', '2024-03-20 09:58:17', '2024-03-20 09:58:17', '/Resources/Assets/images/profiles/bot.jpg', NULL, NULL, NULL, NULL, NULL),
(2062609, 'Angelica', 'Gragasin', 'Lalong', 'female', '2004-06-28', 19, 'Lubas, La Trinidad, Benguet', '{\"Guardian_contact\":null,\"Personal_contact\":\"09928704827\",\"Facebook\":null}', 2, 1, 'dsfsefas@gmai.com', '                            yr    ', '2024-03-20 09:58:21', '2024-03-20 09:58:21', '/Resources/Assets/images/profiles/bot.jpg', NULL, NULL, NULL, NULL, NULL),
(2062610, 'Araceli', 'Pfeffer', 'E', 'female', '2023-04-24', 0, '4105 Cristobal Streets', '577', 1, 1, 'your.email+fakedata73740@gmail.com', '', '2024-04-01 06:39:38', '2024-04-01 06:39:38', 'Documents\\students\\2062610\\1x1Photo.gif', 57, 57, 57, 57, NULL),
(2062611, 'Rubye', 'Bartoletti', 'I', 'female', '2025-03-05', 0, '3142 Veum Loaf', '426', 1, 1, 'your.email+fakedata45959@gmail.com', '', '2024-04-01 06:42:28', '2024-04-01 06:42:28', '/Documents\\students\\2062611\\1x1Photo.gif', 58, 58, 58, 58, NULL),
(2062612, 'Leopoldo', 'Okuneva', 'E', 'female', '2024-11-05', 0, '53652 Prudence Plaza', '887', 1, 1, 'your.email+fakedata59085@gmail.com', '', '2024-04-01 06:51:39', '2024-04-01 06:51:39', '/Documents\\students\\2062612\\1x1Photo.gif', 60, 60, 60, 60, NULL);

INSERT INTO `students_personal_info` (`id`, `birthplace`, `civil_status`, `citizenship`, `religion`, `weight`, `height`, `current_adress`, `permanent_address`) VALUES
(1, '65209 Luettgen Wells', 'widowed', 'Inglewood', 'Illum perspiciatis adipisci di', 35, 263, NULL, '4105 Cristobal Streets');
INSERT INTO `students_personal_info` (`id`, `birthplace`, `civil_status`, `citizenship`, `religion`, `weight`, `height`, `current_adress`, `permanent_address`) VALUES
(2, '65209 Luettgen Wells', 'widowed', 'Inglewood', 'Illum perspiciatis adipisci di', 35, 263, NULL, '4105 Cristobal Streets');
INSERT INTO `students_personal_info` (`id`, `birthplace`, `civil_status`, `citizenship`, `religion`, `weight`, `height`, `current_adress`, `permanent_address`) VALUES
(3, '65209 Luettgen Wells', 'widowed', 'Inglewood', 'Illum perspiciatis adipisci di', 35, 263, NULL, '4105 Cristobal Streets');
INSERT INTO `students_personal_info` (`id`, `birthplace`, `civil_status`, `citizenship`, `religion`, `weight`, `height`, `current_adress`, `permanent_address`) VALUES
(4, '65209 Luettgen Wells', 'widowed', 'Inglewood', 'Illum perspiciatis adipisci di', 35, 263, NULL, '4105 Cristobal Streets'),
(5, '65209 Luettgen Wells', 'widowed', 'Inglewood', 'Illum perspiciatis adipisci di', 35, 263, NULL, '4105 Cristobal Streets'),
(6, '65209 Luettgen Wells', 'widowed', 'Inglewood', 'Illum perspiciatis adipisci di', 35, 263, NULL, '4105 Cristobal Streets'),
(7, '65209 Luettgen Wells', 'widowed', 'Inglewood', 'Illum perspiciatis adipisci di', 35, 263, NULL, '4105 Cristobal Streets'),
(8, '65209 Luettgen Wells', 'widowed', 'Inglewood', 'Illum perspiciatis adipisci di', 35, 263, NULL, '4105 Cristobal Streets'),
(9, '65209 Luettgen Wells', 'widowed', 'Inglewood', 'Illum perspiciatis adipisci di', 35, 263, NULL, '4105 Cristobal Streets'),
(10, '65209 Luettgen Wells', 'widowed', 'Inglewood', 'Illum perspiciatis adipisci di', 35, 263, NULL, '4105 Cristobal Streets'),
(11, '65209 Luettgen Wells', 'widowed', 'Inglewood', 'Illum perspiciatis adipisci di', 35, 263, NULL, '4105 Cristobal Streets'),
(12, '65209 Luettgen Wells', 'widowed', 'Inglewood', 'Illum perspiciatis adipisci di', 35, 263, NULL, '4105 Cristobal Streets'),
(13, '65209 Luettgen Wells', 'widowed', 'Inglewood', 'Illum perspiciatis adipisci di', 35, 263, NULL, '4105 Cristobal Streets'),
(14, '65209 Luettgen Wells', 'widowed', 'Inglewood', 'Illum perspiciatis adipisci di', 35, 263, NULL, '4105 Cristobal Streets'),
(15, '65209 Luettgen Wells', 'widowed', 'Inglewood', 'Illum perspiciatis adipisci di', 35, 263, NULL, '4105 Cristobal Streets'),
(16, '65209 Luettgen Wells', 'widowed', 'Inglewood', 'Illum perspiciatis adipisci di', 35, 263, NULL, '4105 Cristobal Streets'),
(17, '65209 Luettgen Wells', 'widowed', 'Inglewood', 'Illum perspiciatis adipisci di', 35, 263, NULL, '4105 Cristobal Streets'),
(18, '65209 Luettgen Wells', 'widowed', 'Inglewood', 'Illum perspiciatis adipisci di', 35, 263, NULL, '4105 Cristobal Streets'),
(19, '65209 Luettgen Wells', 'widowed', 'Inglewood', 'Illum perspiciatis adipisci di', 35, 263, NULL, '4105 Cristobal Streets'),
(20, '65209 Luettgen Wells', 'widowed', 'Inglewood', 'Illum perspiciatis adipisci di', 35, 263, NULL, '4105 Cristobal Streets'),
(21, '65209 Luettgen Wells', 'widowed', 'Inglewood', 'Illum perspiciatis adipisci di', 35, 263, NULL, '4105 Cristobal Streets'),
(22, '65209 Luettgen Wells', 'widowed', 'Inglewood', 'Illum perspiciatis adipisci di', 35, 263, NULL, '4105 Cristobal Streets'),
(23, '65209 Luettgen Wells', 'widowed', 'Inglewood', 'Illum perspiciatis adipisci di', 35, 263, NULL, '4105 Cristobal Streets'),
(24, '65209 Luettgen Wells', 'widowed', 'Inglewood', 'Illum perspiciatis adipisci di', 35, 263, NULL, '4105 Cristobal Streets'),
(25, '65209 Luettgen Wells', 'widowed', 'Inglewood', 'Illum perspiciatis adipisci di', 35, 263, NULL, '4105 Cristobal Streets'),
(26, '65209 Luettgen Wells', 'widowed', 'Inglewood', 'Illum perspiciatis adipisci di', 35, 263, NULL, '4105 Cristobal Streets'),
(27, '65209 Luettgen Wells', 'widowed', 'Inglewood', 'Illum perspiciatis adipisci di', 35, 263, NULL, '4105 Cristobal Streets'),
(28, '65209 Luettgen Wells', 'widowed', 'Inglewood', 'Illum perspiciatis adipisci di', 35, 263, NULL, '4105 Cristobal Streets'),
(29, '65209 Luettgen Wells', 'widowed', 'Inglewood', 'Illum perspiciatis adipisci di', 35, 263, NULL, '4105 Cristobal Streets'),
(30, '65209 Luettgen Wells', 'widowed', 'Inglewood', 'Illum perspiciatis adipisci di', 35, 263, NULL, '4105 Cristobal Streets'),
(31, '65209 Luettgen Wells', 'widowed', 'Inglewood', 'Illum perspiciatis adipisci di', 35, 263, NULL, '4105 Cristobal Streets'),
(32, '65209 Luettgen Wells', 'widowed', 'Inglewood', 'Illum perspiciatis adipisci di', 35, 263, NULL, '4105 Cristobal Streets'),
(33, '65209 Luettgen Wells', 'widowed', 'Inglewood', 'Illum perspiciatis adipisci di', 35, 263, NULL, '4105 Cristobal Streets'),
(34, '65209 Luettgen Wells', 'widowed', 'Inglewood', 'Illum perspiciatis adipisci di', 35, 263, NULL, '4105 Cristobal Streets'),
(35, '65209 Luettgen Wells', 'widowed', 'Inglewood', 'Illum perspiciatis adipisci di', 35, 263, NULL, '4105 Cristobal Streets'),
(36, '65209 Luettgen Wells', 'widowed', 'Inglewood', 'Illum perspiciatis adipisci di', 35, 263, NULL, '4105 Cristobal Streets'),
(37, '65209 Luettgen Wells', 'widowed', 'Inglewood', 'Illum perspiciatis adipisci di', 35, 263, NULL, '4105 Cristobal Streets'),
(38, '65209 Luettgen Wells', 'widowed', 'Inglewood', 'Illum perspiciatis adipisci di', 35, 263, NULL, '4105 Cristobal Streets'),
(39, '65209 Luettgen Wells', 'widowed', 'Inglewood', 'Illum perspiciatis adipisci di', 35, 263, NULL, '4105 Cristobal Streets'),
(40, '65209 Luettgen Wells', 'widowed', 'Inglewood', 'Illum perspiciatis adipisci di', 35, 263, NULL, '4105 Cristobal Streets'),
(41, '65209 Luettgen Wells', 'widowed', 'Inglewood', 'Illum perspiciatis adipisci di', 35, 263, NULL, '4105 Cristobal Streets'),
(42, '65209 Luettgen Wells', 'widowed', 'Inglewood', 'Illum perspiciatis adipisci di', 35, 263, NULL, '4105 Cristobal Streets'),
(43, '65209 Luettgen Wells', 'widowed', 'Inglewood', 'Illum perspiciatis adipisci di', 35, 263, NULL, '4105 Cristobal Streets'),
(44, '65209 Luettgen Wells', 'widowed', 'Inglewood', 'Illum perspiciatis adipisci di', 35, 263, NULL, '4105 Cristobal Streets'),
(45, '65209 Luettgen Wells', 'widowed', 'Inglewood', 'Illum perspiciatis adipisci di', 35, 263, NULL, '4105 Cristobal Streets'),
(46, '65209 Luettgen Wells', 'widowed', 'Inglewood', 'Illum perspiciatis adipisci di', 35, 263, NULL, '4105 Cristobal Streets'),
(47, '65209 Luettgen Wells', 'widowed', 'Inglewood', 'Illum perspiciatis adipisci di', 35, 263, NULL, '4105 Cristobal Streets'),
(48, '65209 Luettgen Wells', 'widowed', 'Inglewood', 'Illum perspiciatis adipisci di', 35, 263, NULL, '4105 Cristobal Streets'),
(49, '65209 Luettgen Wells', 'widowed', 'Inglewood', 'Illum perspiciatis adipisci di', 35, 263, NULL, '4105 Cristobal Streets'),
(50, '65209 Luettgen Wells', 'widowed', 'Inglewood', 'Illum perspiciatis adipisci di', 35, 263, NULL, '4105 Cristobal Streets'),
(51, '65209 Luettgen Wells', 'widowed', 'Inglewood', 'Illum perspiciatis adipisci di', 35, 263, NULL, '4105 Cristobal Streets'),
(52, '65209 Luettgen Wells', 'widowed', 'Inglewood', 'Illum perspiciatis adipisci di', 35, 263, NULL, '4105 Cristobal Streets'),
(53, '65209 Luettgen Wells', 'widowed', 'Inglewood', 'Illum perspiciatis adipisci di', 35, 263, NULL, '4105 Cristobal Streets'),
(54, '65209 Luettgen Wells', 'widowed', 'Inglewood', 'Illum perspiciatis adipisci di', 35, 263, NULL, '4105 Cristobal Streets'),
(55, '65209 Luettgen Wells', 'widowed', 'Inglewood', 'Illum perspiciatis adipisci di', 35, 263, NULL, '4105 Cristobal Streets'),
(56, '65209 Luettgen Wells', 'widowed', 'Inglewood', 'Illum perspiciatis adipisci di', 35, 263, NULL, '4105 Cristobal Streets'),
(57, '65209 Luettgen Wells', 'widowed', 'Inglewood', 'Illum perspiciatis adipisci di', 35, 263, NULL, '4105 Cristobal Streets'),
(58, '605 Jeramie Circles', 'widowed', 'Aloha', 'Corrupti tempore iste.', 255, 460, NULL, '3142 Veum Loaf'),
(59, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL),
(60, '155 Lebsack Club', 'married', 'Roseville', 'Iusto tempora laudantium enim ', 641, 452, NULL, '53652 Prudence Plaza'),
(61, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL);

INSERT INTO `subject` (`id`, `code`, `title`, `units`, `lecture`, `laboratory`, `pre_riquisite`, `academic_year`, `semester`, `course_id`) VALUES
(2, 'GE-2', 'Reading in the Philippine History', 3, 3, 0, '[]', 1, 1, 1);
INSERT INTO `subject` (`id`, `code`, `title`, `units`, `lecture`, `laboratory`, `pre_riquisite`, `academic_year`, `semester`, `course_id`) VALUES
(3, 'GE-3', 'The Contemporary World', 3, 3, 0, '[]', 1, 1, 1);
INSERT INTO `subject` (`id`, `code`, `title`, `units`, `lecture`, `laboratory`, `pre_riquisite`, `academic_year`, `semester`, `course_id`) VALUES
(4, 'GE-4', 'Art Appreciation', 3, 3, 0, '[\"\"]', 1, 1, 1);
INSERT INTO `subject` (`id`, `code`, `title`, `units`, `lecture`, `laboratory`, `pre_riquisite`, `academic_year`, `semester`, `course_id`) VALUES
(5, 'GE-5', 'Mathematics in Modern World', 3, 3, 0, '[]', 1, 1, 1),
(6, 'GE-6', 'Science, Technology, and Society', 3, 3, 0, '[]', 1, 1, 1),
(7, 'ITW 101', 'Introduction to Computing', 3, 3, 0, '[]', 1, 1, 1),
(8, 'PE 1', 'Self-Testing Activities', 2, 2, 0, '[\"\"]', 1, 1, 1),
(9, 'NSTP 1', 'Civil Welfare Training Service 1', 3, 3, 0, '[]', 1, 1, 1),
(10, 'GE-7', 'Purposive Communication', 3, 3, 0, '[\"GE-1\"]', 1, 2, 1),
(11, 'GE-8', 'Ethics', 3, 3, 0, '[\"\"]', 1, 2, 1),
(12, 'GE-9', 'Rizal\'s Life and Works', 3, 3, 0, '[]', 1, 2, 1),
(13, 'GE-10', 'Living in IT Era', 3, 3, 0, '[\"ITW 101\"]', 1, 2, 1),
(14, 'GE-11', 'Philippine Popular Culture', 3, 3, 0, '[\"GE-2\"]', 1, 2, 1),
(15, 'GE-12', 'The Entrepreneurial Mind', 3, 3, 0, '[\"ITW 101\"]', 1, 2, 1),
(16, 'ITW 102', 'Computer Programming 1 (Java)', 3, 2, 1, '[\"ITW 101\"]', 1, 2, 1),
(17, 'PE 2', 'Individual Sports', 2, 2, 0, '[\"PE 1\"]', 1, 2, 1),
(18, 'NSTP 2', 'Civil Welfare Training Service 2', 3, 3, 0, '[\"NSTP 1\"]', 1, 2, 1),
(19, 'NatSci 221', 'General Science (Chemistry and Biology)', 3, 3, 0, '[\"GE-6\"]', 2, 1, 1),
(20, 'Human 211', 'Philosophy (Logic)', 3, 3, 0, '[\"GE-4\"]', 2, 1, 1),
(21, 'CTyp 201', 'Computer Typing 1', 3, 1, 2, '[\"ITW 101\"]', 2, 1, 1),
(22, 'ITW 211', 'Computer Programming 2 (C#.Net)', 3, 1, 2, '[\"ITW 101\",\"ITW 102\"]', 2, 1, 1),
(23, 'ITW 212', 'Computer Architecture and Organization with Assembly', 3, 1, 2, '[\"ITW 101\",\"GE-10\"]', 2, 1, 1),
(24, 'ITW 213', 'Graphic Design (Photoshop)', 3, 1, 2, '[\"GE-10\"]', 2, 1, 1),
(25, 'ITW 214', 'Discrete Mathematics', 3, 3, 0, '[\"GE-5\",\"ITW 102\"]', 2, 1, 1),
(26, 'NatSci 222', 'Physics 1', 3, 3, 0, '[]', 2, 1, 1),
(27, 'Fil 1', 'Kontekstuwalisadong Komonikasyon sa Filipino', 3, 3, 0, '[]', 2, 1, 1),
(28, 'PE 3', 'Rhytmic Activities', 2, 2, 0, '[\"PE 2\"]', 2, 1, 1),
(29, 'SocSci 221', 'General Psychology', 3, 3, 0, '[\"GE-1\"]', 2, 2, 1),
(30, 'SocSci 222', 'Principles of Economics with TAR', 3, 3, 0, '[\"GE-5\",\"GE-11\"]', 2, 2, 1),
(32, 'ITW 221', 'Data Structures and Algorithm Analysis', 3, 1, 2, '[\"ITW 211\",\"ITW 214\"]', 2, 2, 1),
(35, 'ITW 222', 'Layouting (Adobe InDesign)', 3, 1, 2, '[\"GE-10\",\"ITW 213\"]', 2, 2, 1),
(38, 'ITW 223', 'Object Oriented Programming', 3, 1, 2, '[\"ITW 102\",\"ITW 211\"]', 2, 2, 1),
(52, 'GE-1', 'Understanding the Self', 3, 3, 0, '[]', 1, 1, 4),
(53, 'GE-2', 'Readings in the Philippine History', 3, 3, 0, '[]', 1, 1, 4),
(54, 'GE-3', 'The Contemporary World', 3, 3, 0, '[]', 1, 1, 4),
(55, 'GE-4', 'Art Appreciation', 3, 3, 0, '[]', 1, 1, 4),
(56, 'GE-5', 'Mathematics in the Modern World', 3, 3, 0, '[]', 1, 1, 4),
(57, 'GE-6', 'Science, Technology, and Society', 3, 3, 0, '[]', 1, 1, 4),
(58, 'BMGMT 1', 'Business Management and Organization', 3, 3, 0, '[]', 1, 1, 4),
(59, 'BFIN 1', 'Business Finance', 3, 3, 0, '[]', 1, 1, 4),
(60, 'PE1', 'Self-Testing Activities', 2, 2, 0, '[\"\"]', 1, 1, 4),
(61, 'NSTP 1', 'Civic Welfare Training Service', 3, 3, 0, '[\"\"]', 1, 1, 4),
(62, 'GE-7', 'Purposive Communication', 3, 3, 0, '[]', 1, 2, 4),
(63, 'GE-8', 'Ethics', 3, 3, 0, '[]', 1, 2, 4),
(66, 'BUSLAW 1', 'Law on Obligation and Contracts', 3, 3, 0, '[]', 2, 1, 4),
(67, 'GE-1', 'Understanding the Self', 3, 3, 0, '[]', 1, 1, 2),
(68, 'GE-2', 'Readings in the Philippine History', 3, 3, 0, '[]', 1, 1, 2),
(69, 'GE-9', 'Rizal\'s Life and Works', 3, 3, 0, '[]', 1, 2, 4),
(70, 'GE-3', 'The Contemporary World ', 3, 3, 0, '[]', 1, 1, 2),
(71, 'GE-10', 'Living in the IT Era', 3, 3, 0, '[]', 1, 2, 4),
(72, 'GE-11', 'Philippine Popular Culture', 3, 3, 0, '[]', 1, 2, 4),
(73, 'GE-4', 'Art Appreciation', 3, 3, 0, '[]', 1, 1, 2),
(74, 'GE-5', 'Mathematics in the Modern World ', 3, 3, 0, '[]', 1, 1, 2),
(75, 'GE-12', 'The Entrepreneurial Mind', 3, 3, 0, '[]', 1, 2, 4),
(76, 'GE-6', 'Science, Technology and Society', 3, 3, 0, '[]', 1, 1, 2),
(77, 'BMGMT 1', 'Business Management and Organization', 3, 3, 0, '[]', 1, 1, 2),
(78, 'PE1', 'Self-Testing Activities', 2, 2, 0, '[]', 1, 1, 2),
(79, 'NSTP 1', 'Civic Welfare Training Service ', 3, 3, 0, '[]', 1, 1, 2),
(80, 'GE-7', 'Purposive Communication', 3, 3, 0, '[]', 1, 2, 2),
(81, 'GE-8', 'Ethics', 3, 3, 0, '[]', 1, 2, 2),
(82, 'ACCTNG 1', 'Fundamentals of Accounting', 6, 6, 0, '[]', 1, 2, 4),
(83, 'GE-9', 'Rizal\'s Life and Works', 3, 3, 0, '[]', 1, 2, 2),
(84, 'PE2', 'Individual Sports', 2, 2, 0, '[]', 1, 2, 4),
(85, 'GE-10', 'Living in the IT Era', 3, 3, 0, '[]', 1, 2, 2),
(86, 'NSTP 2', 'Civic Welfare Training Service', 3, 3, 0, '[\"NSTP 1\"]', 1, 2, 4),
(87, 'GE-11', 'Philippine Popular Culture', 3, 3, 0, '[]', 1, 2, 2),
(88, 'GE-12', 'The Entrepreneurial Mind ', 3, 3, 0, '[]', 1, 2, 2),
(89, 'BFIN 1', 'Business Finance ', 3, 3, 0, '[\" \"]', 1, 2, 2),
(90, 'TAX 1', 'Income Tax', 3, 3, 0, '[]', 2, 1, 4),
(92, 'FINMAN 1', 'Monetary Policy and Central Banking', 3, 3, 0, '[]', 2, 1, 4),
(93, 'PE 2 ', 'Individual Sport', 2, 2, 0, '[]', 1, 2, 2),
(94, 'MGMT 1', 'Operations Management (TQM)', 3, 3, 0, '[\"BMGMT 1\"]', 2, 1, 4),
(95, 'COMP 1', 'Computer Application in the Business Industry', 3, 2, 1, '[\"GE-10\"]', 2, 1, 4),
(96, 'FIN 1', 'Personal Finance', 3, 3, 0, '[]', 2, 1, 4),
(97, 'FIN 2', 'Global Finance with Electronic Banking', 3, 3, 0, '[]', 2, 1, 4),
(98, 'B-ECON', 'Applied Economics', 3, 2, 0, '[]', 2, 1, 4),
(99, 'PE3', 'Rhythmic Activities', 2, 2, 0, '[]', 2, 1, 4),
(100, 'FINMAN 2', 'Financial Management', 3, 3, 0, '[\"ACCTNG 1\"]', 2, 2, 4),
(101, 'FINMAN 3', 'Banking and Financial Institutions', 3, 3, 0, '[]', 2, 2, 4),
(102, 'FINMAN 4', 'Capital Markets', 3, 3, 0, '[]', 2, 2, 4),
(103, 'NSTP 2', 'Civic Welfare Training Service', 3, 3, 0, '[\"NSTP 1\"]', 1, 2, 2),
(104, 'MGMT 2', 'Risk Management', 3, 3, 0, '[]', 2, 2, 4),
(105, 'MGMT 3', 'Human Resource Management', 3, 3, 0, '[\"BMGMT 1\"]', 2, 2, 4),
(106, 'MKTNG 1', 'Business Marketing', 3, 3, 0, '[]', 2, 2, 4),
(107, 'FIN 3', 'Franchising', 3, 3, 0, '[]', 2, 2, 4),
(108, 'THC 1', 'Macro Perspective of Tourism and Hospitality ', 3, 3, 0, '[]', 2, 1, 2),
(109, 'FIN 4', 'Public Finance', 3, 3, 0, '[\"BFIN 1\"]', 2, 2, 4),
(110, 'PE4', 'Team Sports', 2, 2, 0, '[]', 2, 2, 4),
(111, 'THC 2 ', 'Risk Management as Applied to Safety, Security and Sanitation', 3, 3, 0, '[]', 2, 1, 2),
(112, 'THC 3 ', 'Quality Service Management in Tourism and Hospitality', 3, 3, 0, '[]', 2, 1, 2),
(113, 'FIL 1', 'Kontekstwalisadong Komonikasyon sa Filipino', 3, 3, 0, '[]', 2, 1, 4),
(114, 'FIL 2', 'Filipino sa Iba\'t Ibang Disiplina', 3, 3, 0, '[\"FIL 1\"]', 2, 2, 4),
(115, 'HPC 1', 'Kitchen Essential & Basic Food ', 5, 2, 3, '[]', 2, 1, 2),
(117, 'HPC 2', 'Fundamentals in Lodging Operations ', 5, 2, 3, '[]', 2, 1, 2),
(120, 'ACCTNG 1 ', 'Fundamentals of Accounting ', 3, 3, 0, '[]', 2, 1, 2),
(123, 'PE 3', ' Rhythmic Activities ', 2, 2, 0, '[]', 2, 1, 2),
(126, 'FIL 1', 'Kontekstuwalisadong  Komonikasyon sa Filipino', 3, 3, 0, '[]', 2, 1, 2),
(127, 'BS', 'Business Research', 6, 6, 0, '[\"3rd Year Standing\"]', 3, 2, 4),
(128, 'TAX 2', 'Business and Transfer Taxes', 3, 3, 0, '[\"TAX 1\"]', 3, 2, 4),
(129, 'ECON 2', 'International Business and Trade', 3, 3, 0, '[\"ECON 1\"]', 3, 2, 4),
(130, 'THC 4 ', 'Philippine Tourism, Geography and Culture', 3, 3, 0, '[]', 2, 2, 2),
(131, 'MGMT 6', 'Strategic Management', 3, 3, 0, '[]', 3, 2, 4),
(132, 'FIN 6', 'Financial Controllership', 3, 3, 0, '[]', 3, 2, 4),
(133, 'THC 5', 'Micro Perspective of Tourism and Hospitality', 3, 3, 0, '[\"\"]', 2, 2, 2),
(134, 'FS', 'Feasibility Study', 6, 6, 0, '[\"Business Research\"]', 4, 1, 4),
(135, 'FINMAN 8', 'Special Topics in Financial Management', 3, 3, 0, '[\"FINMAN 2\"]', 4, 1, 4),
(136, 'BUSLAW 2', 'Labor and Legislation', 3, 3, 0, '[]', 4, 1, 4),
(137, 'PRAC', 'Internship (600 hours)', 6, 6, 0, '[\"4th Year Standing\"]', 4, 2, 4),
(138, 'HPC 3', 'Applied Bus Tools and Technologies(PMS) with lab', 3, 1, 2, '[]', 2, 2, 2),
(139, 'HPC 6', 'Fundamentals in FS Operation', 5, 2, 3, '[]', 2, 2, 2),
(140, 'HM PE 1', 'Bread and Pastry Production ', 5, 2, 3, '[]', 2, 2, 2),
(141, 'MKTNG 1 ', 'Business Marketing ', 3, 3, 0, '[]', 2, 2, 2),
(142, 'B-ECON', 'Applied Economics', 3, 0, 0, '[]', 2, 2, 2),
(143, 'PE 4', 'Team Sports', 2, 2, 0, '[]', 2, 2, 2),
(144, 'FIL 2', 'Filipino sa iba\'t-ibang wika', 3, 3, 0, '[]', 2, 2, 2),
(145, 'Acctg 301', 'Fundamentals of Accounting', 3, 3, 0, '[\"GE-5\"]', 3, 1, 1),
(146, 'BME 1 ', 'Operation Management in TH Industry', 3, 3, 0, '[]', 3, 1, 2),
(147, 'THC 6', 'Professional Development & Applied', 3, 3, 0, '[]', 3, 1, 2),
(148, 'SocSci 322', 'Sociology with Pop. Ed. & Drug Prevention', 3, 3, 0, '[]', 3, 1, 1),
(149, 'HPC 4 ', 'Supply Chain Management in Hospitality Industry', 3, 3, 0, '[]', 3, 1, 2),
(150, 'ITW 311', 'Information Management (ER/SQL)', 3, 2, 1, '[\"ITW 223 and ITW 225\"]', 3, 1, 1),
(151, 'HPC 5 ', 'Foreign Language 1', 3, 3, 0, '[]', 3, 1, 2),
(152, 'HPC 7 ', 'Introduction to MICE', 3, 3, 0, '[]', 3, 1, 2),
(153, 'ITW 312', 'Computer Programming 4 (Web Programming & Design)', 3, 2, 1, '[\"ITW 223 and ITW 224\"]', 3, 1, 1),
(154, 'ITW 313', 'Hardware and Software Installation', 3, 2, 1, '[\"ITW 212 and ITW 226\"]', 3, 1, 1),
(155, 'HM PE 2', 'Bar and Beverage Management- with lab', 5, 3, 2, '[]', 3, 1, 2),
(156, 'HM PE 3', 'Front Office Operation', 5, 3, 2, '[]', 3, 1, 2),
(157, 'ITW 314', 'Data Communication and Networking', 3, 3, 0, '[\"ITW 101 and ITW 212\"]', 3, 1, 1),
(158, 'BME 2 ', 'Strategic Management in Tourism and Hospitality ', 3, 3, 0, '[]', 3, 2, 2),
(159, 'ITW 315', 'Management Information System', 3, 3, 0, '[\"GE-12, ITW 224 and ITW 225\"]', 3, 1, 1),
(160, 'THC 7', 'Tourism and Hospitality Marketing ', 3, 3, 0, '[]', 3, 2, 2),
(161, 'ITW 316', 'Software Engineering', 3, 3, 0, '[\"ITW 101 and ITW 225\"]', 3, 1, 1),
(162, 'THC 8', 'Legal Aspects in Tourism and Hospitality ', 3, 3, 0, '[\" \"]', 3, 2, 2),
(163, 'THC 9', 'Multicultural Diversity in Workplace for the Tourism Professionals', 3, 3, 0, '[]', 3, 2, 2),
(164, 'HPC 10', 'Research in Hospitality ', 6, 6, 0, '[\"\"]', 3, 2, 2),
(165, 'HPC 8', 'Foreign Language 2', 3, 3, 0, '[]', 3, 2, 2),
(166, 'HM PE 4', 'Trends and Issues in Hospitality Industry ', 3, 3, 0, '[]', 3, 2, 2),
(167, 'FS', 'Feasibility Study', 6, 6, 0, '[\"\"]', 4, 1, 2),
(168, 'THC10', 'Entrepreneurship in Tourism and Hospitality ', 3, 3, 0, '[]', 4, 1, 2),
(169, 'ITW 224', 'Computer Programming 3 (Python)', 3, 2, 1, '[\"ITW 211\"]', 2, 2, 1),
(170, 'HPC 9', 'Ergonomics & Facilities Planning for the Hospitality Industry', 3, 3, 0, '[]', 4, 1, 2),
(171, 'HM PE 5', 'Catering Management ', 5, 2, 3, '[]', 4, 1, 2),
(172, 'ITW 225', 'Operating System Concepts', 3, 3, 0, '[\"ITW 101 and GE-10\"]', 2, 2, 1),
(173, 'PRAC', 'Internship (600 hours)', 6, 6, 0, '[]', 4, 2, 2),
(174, 'ITW 226', 'Digital Circuits', 3, 3, 0, '[\"Human 211 and ITW 212\"]', 2, 2, 1),
(175, 'GE-1', 'Understanding the Self', 3, 3, 0, '[]', 1, 1, 3),
(176, 'GE-2', 'Readings in the Philippine History ', 3, 3, 0, '[]', 1, 1, 3),
(177, 'GE-3 ', 'The Contemporary World', 3, 3, 0, '[]', 1, 1, 3),
(178, 'GE-4', 'Art Appreciation', 3, 3, 0, '[]', 1, 1, 3),
(179, 'FINMAN 5', 'Financial Analysis and Reporting', 3, 3, 0, '[\"ACCTNG 1\"]', 3, 1, 4),
(180, 'GE-5', 'Mathematics in the Modern World', 3, 3, 0, '[]', 1, 1, 3),
(181, 'GE-6', 'Science, Technology and Society ', 3, 3, 0, '[]', 1, 1, 3),
(182, 'MGMT 4', 'Good Governance and Social Responsibility', 3, 3, 0, '[]', 3, 1, 4),
(183, 'PE 1', 'Self-Testing Activities', 2, 2, 0, '[]', 1, 1, 3),
(184, 'NSTP 1', 'Civic Welfare Training Service ', 3, 3, 0, '[]', 1, 1, 3),
(185, 'FINMAN 6', 'Investment and Portfolio Management', 3, 3, 0, '[\"FINMAN 4 and MGMT 2\"]', 3, 1, 4),
(186, 'FINMAN 7', 'Credit and Collection', 3, 3, 0, '[]', 3, 1, 4),
(187, 'GE-7', 'Purposive Communication ', 3, 3, 0, '[]', 1, 2, 3),
(188, 'MGMT 5', 'Entrepreneurial Mind', 3, 3, 0, '[\"BMGMT 1\"]', 3, 1, 4),
(189, 'GE-8', 'Ethics ', 3, 3, 0, '[]', 1, 2, 3),
(190, 'GE-9', 'Rizal\'s Life and Works ', 3, 3, 0, '[]', 1, 2, 3),
(191, 'ECON 1', 'Basic Microeconomics', 3, 3, 0, '[\"ECON\"]', 3, 1, 4),
(192, 'GE-10', 'Living in the IT Era ', 3, 3, 0, '[]', 1, 2, 3),
(193, 'GE-11', 'Philippine Popular Culture', 3, 3, 0, '[\"\"]', 1, 2, 3),
(194, 'GE-12', 'The Entrepreneurial Mind', 3, 3, 0, '[]', 1, 2, 3),
(195, 'FIN 5', 'Security Analysis', 3, 3, 0, '[]', 3, 1, 4),
(196, 'PE 2 ', 'Individual Sports ', 2, 2, 0, '[]', 1, 2, 3),
(197, 'Fil 2', 'Filipino sa Iba\'t Ibang Disiplina', 3, 3, 0, '[\"Fil 1\"]', 2, 2, 1),
(198, 'NSTP 2 ', 'Civic Welfare Training Service ', 3, 3, 0, '[\"NSTP 1\"]', 1, 2, 3),
(199, 'PE 4', 'Team Sports', 2, 2, 0, '[\"PE 3\"]', 2, 2, 1),
(200, 'THC 1 ', 'Macro Perspective of Tourism and Hospitality ', 3, 3, 0, '[]', 2, 1, 3),
(201, 'ITW 321', 'System Analysis and Design', 3, 2, 1, '[\"ITW 311, 315 and 316\"]', 3, 2, 1),
(202, 'THC 2 ', 'Risk Management as Applied to Safety, Security and Sanitation', 3, 3, 0, '[]', 2, 1, 3),
(203, 'THC 3', 'Quality Service Management in Tourism and Hospitality', 3, 3, 0, '[]', 2, 1, 3),
(204, 'ITW 322', 'Linux Operating System', 3, 2, 1, '[\"ITW 225 and ITW 313\"]', 3, 2, 1),
(205, 'ITW 323', 'Computer Programming 5 (Web Design & Development)', 3, 2, 1, '[\"ITW 312\"]', 3, 2, 1),
(206, 'HPC 1 ', 'Kitchen Essential & basic Food Preparation', 5, 2, 3, '[]', 2, 1, 3),
(207, 'ITW 324', 'System Administration and Maintenance', 3, 3, 0, '[\"ITW 225, ITW 313 and ITW 314\"]', 3, 2, 1),
(208, 'HPC 2 ', 'Fundamentals in Lodging Operations ', 5, 2, 3, '[]', 2, 1, 3),
(209, 'PE 3 ', 'Rhythmic Avtivities', 2, 2, 0, '[]', 2, 1, 3),
(210, 'ITW 325', 'Business Analytics', 3, 3, 0, '[\"GE-5, ITW 214 and ITW 316\"]', 3, 2, 1),
(211, 'ITW 326', 'Information Assurance and Security', 3, 3, 0, '[\"ITW 311, ITW 314 and ITW 316\"]', 3, 2, 1),
(212, 'FIL 1 ', 'Kontekstuwalisadong Komonikasyon sa Filipino', 3, 3, 0, '[]', 2, 1, 3),
(213, 'ITW 327', 'Project Management', 3, 3, 0, '[\"ITW 311, ITW 315 and ITW 316\"]', 3, 2, 1),
(214, 'THC 4 ', 'Philippine Tourism, Geography and Culture ', 3, 3, 0, '[]', 2, 2, 3),
(215, 'ITW 328', 'Professional Ethics in IT and Comp. Issues', 3, 3, 0, '[\"GE-8 and ITW 316\"]', 3, 2, 1),
(216, 'THC 5', 'Micro Perspective of Tourism and Hospitality', 3, 3, 0, '[]', 2, 2, 3),
(217, 'ITW 411', 'Capstone Project -1', 3, 3, 0, '[\"ITW 312\",\"325 and ITW 327\"]', 4, 1, 1),
(218, 'HPC 3 ', 'Applied Bus Tools and Technologies (PMS) with Lab ', 3, 1, 2, '[]', 2, 2, 3),
(219, 'HPC 6 ', 'Fundamentals in FS Operation ', 5, 2, 3, '[]', 2, 2, 3),
(220, 'HM PE 1', 'Bread and Pastry Production ', 5, 2, 3, '[]', 2, 2, 3),
(221, 'ITW 412', 'Mobile Technology', 3, 2, 1, '[\"4th Year Standing\"]', 4, 1, 1),
(222, 'PE 4 ', 'Team Sports ', 2, 2, 0, '[]', 2, 2, 3),
(223, 'FIL 2 ', 'Filipino sa Iba\'t-ibang Disiplina ', 3, 3, 0, '[]', 2, 2, 3),
(224, 'ITW Elec1', 'Integrative Programming Technologies', 3, 2, 1, '[\"4th Year Standing\"]', 4, 1, 1),
(225, 'ITW Elec2', 'Systems Integration and Architecture', 3, 3, 0, '[\"4th Year Standing\"]', 4, 1, 1),
(226, 'BME 1', 'Operation Management in TH Industry ', 3, 3, 0, '[]', 3, 1, 3),
(227, 'THC 6 ', 'Professional Development & Applied Ethics ', 3, 3, 0, '[]', 3, 1, 3),
(228, 'ITW Elec3', 'Special Topics in IT', 3, 3, 0, '[\"4th Year Standing\"]', 4, 1, 1),
(229, 'ITW 413', 'Seminars and Workshops', 3, 3, 0, '[\"4th Year Standing\"]', 4, 1, 1),
(230, 'HPC 4 ', 'Supply Chain Management in Hospitality Industry ', 3, 3, 0, '[]', 3, 1, 3),
(231, 'HPC 5 ', 'Foreign language ', 3, 3, 0, '[]', 3, 1, 3),
(232, 'HPC 7', 'Introduction to MICE ', 3, 3, 0, '[]', 3, 1, 3),
(233, 'ITW 421', 'Capstone Project-2', 3, 3, 0, '[\"ITW 321 and ITW 411\"]', 4, 2, 1),
(234, 'ITW Elec4', 'Human Computer Interaction', 3, 3, 0, '[\"4th Year Standing\"]', 4, 2, 1),
(235, 'HM PE 2', 'Bar and Beverage Management- with lab', 5, 2, 3, '[]', 3, 1, 3),
(236, 'ITW Elec5', 'Web Enhanced Animation Graphics', 3, 2, 1, '[\"4th Year Standing\"]', 4, 2, 1),
(237, 'HM PE 3', 'Front Office Operation ', 5, 2, 3, '[]', 3, 1, 3),
(238, 'BME 2 ', 'Strategic Management in Tourism and Hospitality ', 3, 3, 0, '[\"3rd year standing \"]', 3, 2, 3),
(239, 'THC 7 ', 'Tourism and Hospitality Marketing ', 3, 3, 0, '[]', 3, 2, 3),
(240, 'THC 8', ' Legal Aspects in Tourism and Hospitality ', 3, 3, 0, '[]', 3, 2, 3),
(241, 'THC 9 ', 'Multicultural Diversity in Workplace for the Tourism Professionals ', 3, 3, 0, '[]', 3, 2, 3),
(242, 'HPC 10 ', 'Research in Hospitality ', 6, 6, 0, '[]', 3, 2, 3),
(243, 'HPC 8 ', 'Foreign Language 2', 3, 3, 0, '[]', 3, 2, 3),
(244, 'HM PE4', 'Trends and Issues in Hospitality Industry ', 3, 3, 0, '[]', 3, 2, 3),
(245, 'FS ', 'Feasibility Study ', 6, 6, 0, '[]', 4, 1, 3),
(246, 'THC 10 ', 'Entrepreneurship in Tourism and Hospitality ', 3, 3, 0, '[]', 4, 1, 3),
(247, 'HPC 9', 'Ergonomics & Facilities Planning for the Hospitality Industry ', 3, 3, 0, '[]', 4, 1, 3),
(248, 'HM PE 5 ', 'Catering Management ', 5, 2, 3, '[]', 4, 1, 3),
(249, 'PRAC', 'Internship (600 hours)', 6, 6, 0, '[\" 4th year standing \"]', 4, 2, 3),
(250, 'GE-1', 'Understanding the Self', 3, 3, 0, '[]', 1, 1, 5),
(251, 'GE-2', 'Reading in the Philippine History', 3, 3, 0, '[]', 1, 1, 5),
(252, 'GE-3', 'The Contemporary World', 3, 3, 0, '[]', 1, 1, 5),
(253, 'GE-4', 'Art Appreciation', 3, 3, 0, '[]', 1, 1, 5),
(254, 'GE-5', 'Mathematics in the Modern World', 3, 3, 0, '[]', 1, 1, 5),
(255, 'GE-6', 'Science, Technology, and Society', 3, 3, 0, '[]', 1, 1, 5),
(256, 'PE 1', 'Self-Testing Activities', 2, 2, 0, '[]', 1, 1, 5),
(257, 'NSTP 1', 'Civic Welfare Training Service', 3, 3, 0, '[]', 1, 1, 5),
(258, 'GE-7', 'Purposive Communication', 3, 3, 0, '[]', 1, 2, 5),
(259, 'GE-8', 'Ethics', 3, 3, 0, '[]', 1, 2, 5),
(260, 'GE-9', 'Rizal\'s Life and Works', 3, 3, 0, '[]', 1, 2, 5),
(261, 'GE-10', 'Living in the IT Era', 3, 3, 0, '[]', 1, 2, 5),
(262, 'GE-11', 'Philippine Popular Culture', 3, 3, 0, '[]', 1, 2, 5),
(263, 'GE-12', 'The Entrepreneurial Mind', 3, 3, 0, '[]', 1, 2, 5),
(264, 'PE 2', 'Individual Sports', 3, 3, 0, '[]', 1, 2, 5),
(265, 'NSTP 2', 'Civic Welfare Training Service', 2, 2, 0, '[\"NSTP 1\"]', 1, 2, 5),
(266, 'BUSLAW 1', 'Law on Obligation and Contracts', 3, 3, 0, '[]', 2, 1, 5),
(267, 'TAX 1', 'Income Tax', 3, 3, 0, '[]', 2, 1, 5),
(268, 'MGMT 1', 'Operations Management (TQM)', 3, 3, 0, '[]', 2, 1, 5),
(269, 'FINMAN 1', 'Monetary Policy and Central Banking', 3, 3, 0, '[]', 2, 1, 5),
(270, 'COMP 1', 'Computer Application in the Business Industry', 3, 2, 1, '[\"GE-10\"]', 2, 1, 5),
(271, 'FIN 1', 'Personal Finance', 3, 3, 0, '[]', 2, 1, 5),
(272, 'FIN 2', 'Global Finance with Electronic Banking', 3, 3, 0, '[]', 2, 1, 5),
(273, 'FIL 1', 'Kontekstwalisadong Komunikasyon sa Filipino', 3, 3, 0, '[]', 2, 1, 5),
(274, 'PE 3', 'Rhythmic Activities', 2, 2, 0, '[]', 2, 1, 5),
(275, 'FINMAN 2', 'Financial Management', 3, 3, 0, '[]', 2, 2, 5),
(276, 'FINMAN 3', 'Banking and Financial Institutions', 3, 3, 0, '[]', 2, 2, 5),
(277, 'FINMAN 4', 'Capital Market', 3, 3, 0, '[]', 2, 2, 5),
(278, 'MGMT 2', 'Risk Management', 3, 3, 0, '[]', 2, 2, 5),
(279, 'MGMT 3', 'Human Resources Management', 3, 3, 0, '[\"BMBMT 1\"]', 2, 2, 5);
INSERT INTO `subject` (`id`, `code`, `title`, `units`, `lecture`, `laboratory`, `pre_riquisite`, `academic_year`, `semester`, `course_id`) VALUES
(280, 'FIN 3', 'Franchising', 3, 3, 0, '[]', 2, 2, 5),
(281, 'FIN 4', 'Public Finance', 3, 3, 0, '[\" \"]', 2, 2, 5),
(282, 'FIL 2', 'Filipino sa Iba\'t Ibang Disiplina', 3, 3, 0, '[\"FIL 1\"]', 2, 2, 5),
(283, 'PE 4', 'Team Sports', 2, 2, 0, '[]', 2, 2, 5),
(284, 'FINMAN 5', 'Financial Analysis and Reporting', 3, 3, 0, '[\"ACCTNG 1\"]', 3, 1, 5),
(285, 'MGMT 4', 'Good Governance and Social Responsibility', 3, 3, 0, '[]', 3, 1, 5),
(286, 'FINMAN 6', 'Investment and Portfolio Management', 3, 3, 0, '[\"FINMAN 4 and MGMT 2\"]', 3, 1, 5),
(287, 'FINMAN 7', 'Credit and Collection', 3, 3, 0, '[]', 3, 1, 5),
(288, 'MGMT 5', 'Entrepreneurial Management', 3, 3, 0, '[\"BMGMT 1\"]', 3, 1, 5),
(289, 'ECON', 'Basic Microeconomics', 3, 3, 0, '[]', 3, 1, 5),
(290, 'FIN 5', 'Security Analysis', 3, 3, 0, '[]', 3, 1, 5),
(291, 'BS', 'Business Research', 6, 6, 0, '[\"3rd Year Standing\"]', 3, 2, 5),
(292, 'TAX 2', 'Business and Transfer Taxes', 3, 3, 0, '[\"TAX 1\"]', 3, 2, 5),
(293, 'ECON 2', 'International Business and Trade', 3, 3, 0, '[\"ECON 1\"]', 3, 2, 5),
(294, 'MGMT 6', 'Strategic Management', 3, 3, 0, '[]', 3, 2, 5),
(295, 'FIN 6', 'Financial Controllership', 3, 3, 0, '[]', 3, 2, 5),
(296, 'FS', 'Feasibility Study', 6, 6, 0, '[\"Business Research\"]', 4, 1, 5),
(297, 'FINMAN 8', 'Special Topics in Financial Management', 3, 3, 0, '[\"FINMAN 2\"]', 4, 1, 5),
(298, 'BUSLAW 2', 'Labor and Law Legislation', 3, 3, 0, '[]', 4, 1, 5),
(299, 'PRAC', 'Internship (600 HOURS)', 4, 4, 0, '[\"4th Year Standing\"]', 4, 2, 5),
(300, 'GE-1', 'Understanding the Self', 3, 3, 0, '[]', 1, 1, 1);





INSERT INTO `teams` (`id`, `user_id`, `name`, `personal_team`, `created_at`, `updated_at`) VALUES
(1, 2, 'adminLouis\'s Team', 1, '2024-04-05 06:43:17', '2024-04-05 06:43:17');


INSERT INTO `user_role` (`user_id`, `role_id`) VALUES
(2, 8);
INSERT INTO `user_role` (`user_id`, `role_id`) VALUES
(2, 9);


INSERT INTO `users` (`id`, `name`, `email`, `email_verified_at`, `password`, `two_factor_secret`, `two_factor_recovery_codes`, `two_factor_confirmed_at`, `remember_token`, `current_team_id`, `profile_photo_path`, `created_at`, `updated_at`) VALUES
(2, 'adminLouis', 'marianolouis18@gmail.com', NULL, '$2y$12$xFLl7SkPTcBXQKublOXuiOAPkktBrgoDrllz8topmaQH1qBbFcsS6', NULL, NULL, NULL, NULL, 1, NULL, '2024-04-05 06:43:17', '2024-04-05 06:43:21');



/*!40101 SET SQL_MODE=@OLD_SQL_MODE */;
/*!40014 SET FOREIGN_KEY_CHECKS=@OLD_FOREIGN_KEY_CHECKS */;
/*!40014 SET UNIQUE_CHECKS=@OLD_UNIQUE_CHECKS */;
/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
/*!40111 SET SQL_NOTES=@OLD_SQL_NOTES */;