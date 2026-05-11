-- Migration: Add Admin Approval Status to Admissions Table
-- Date: 2026-05-11

ALTER TABLE `admissions` ADD COLUMN `admin_approval_status` ENUM('pending', 'approved', 'rejected') NOT NULL DEFAULT 'pending' AFTER `status`;
ALTER TABLE `admissions` ADD COLUMN `admin_approval_notes` TEXT NULL AFTER `admin_approval_status`;
ALTER TABLE `admissions` ADD COLUMN `admin_approved_by` INT NULL AFTER `admin_approval_notes`;
ALTER TABLE `admissions` ADD COLUMN `admin_approved_at` TIMESTAMP NULL AFTER `admin_approved_by`;

-- Add index for faster queries
CREATE INDEX idx_admin_approval_status ON `admissions` (`admin_approval_status`);
CREATE INDEX idx_approved_by ON `admissions` (`admin_approved_by`);
