-- alter_inquiries.sql : add is_read column for unread badge feature
USE realestate_db;
ALTER TABLE inquiries ADD COLUMN IF NOT EXISTS is_read TINYINT(1) DEFAULT 0;
