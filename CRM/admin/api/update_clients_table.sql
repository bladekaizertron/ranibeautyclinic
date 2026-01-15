-- Add New Client Feature: Database Schema Update
-- This migration adds optional fields to the clients table for enhanced client profiles

ALTER TABLE clients 
ADD COLUMN IF NOT EXISTS address TEXT AFTER email,
ADD COLUMN IF NOT EXISTS birthday DATE AFTER address,
ADD COLUMN IF NOT EXISTS gender VARCHAR(50) AFTER birthday,
ADD COLUMN IF NOT EXISTS notes TEXT AFTER gender,
ADD COLUMN IF NOT EXISTS membership_status ENUM('regular', 'vip') DEFAULT 'regular' AFTER notes;
