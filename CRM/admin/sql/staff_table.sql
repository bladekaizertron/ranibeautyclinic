-- Create staff table if it doesn't exist
CREATE TABLE IF NOT EXISTS `staff` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `name` varchar(255) NOT NULL,
  `email` varchar(255) NOT NULL,
  `phone` varchar(50) DEFAULT NULL,
  `role` varchar(100) DEFAULT 'Staff',
  `permission_group` varchar(50) DEFAULT 'provider',
  `location` varchar(100) DEFAULT 'renton',
  `avatar_color` varchar(20) DEFAULT '#9b5de5',
  `alias` varchar(100) DEFAULT NULL,
  `bio` text DEFAULT NULL,
  `created_at` timestamp DEFAULT CURRENT_TIMESTAMP,
  PRIMARY KEY (`id`),
  UNIQUE KEY `email` (`email`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

-- Add status column if it doesn't exist (optional enhancement)
-- ALTER TABLE `staff` ADD COLUMN IF NOT EXISTS `status` varchar(50) DEFAULT 'Active';
