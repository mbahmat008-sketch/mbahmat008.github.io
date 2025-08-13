-- db.sql : schema + sample data
CREATE DATABASE IF NOT EXISTS realestate_db CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci;
USE realestate_db;

-- Properties table
CREATE TABLE IF NOT EXISTS properties (
  id INT AUTO_INCREMENT PRIMARY KEY,
  slug VARCHAR(255) UNIQUE,
  title VARCHAR(255) NOT NULL,
  address VARCHAR(255) DEFAULT '',
  category VARCHAR(100) DEFAULT 'Apartment',
  price_label VARCHAR(100) DEFAULT '',
  price_numeric DECIMAL(15,2) DEFAULT 0,
  bedrooms INT DEFAULT 0,
  bathrooms INT DEFAULT 0,
  area INT DEFAULT 0,
  floor VARCHAR(50) DEFAULT '',
  parking VARCHAR(50) DEFAULT '',
  image_url VARCHAR(512) DEFAULT 'assets/images/property-01.jpg',
  description TEXT,
  created_at TIMESTAMP DEFAULT CURRENT_TIMESTAMP,
  is_read TINYINT(1) DEFAULT 0
) ENGINE=InnoDB;

-- Property images
CREATE TABLE IF NOT EXISTS property_images (
  id INT AUTO_INCREMENT PRIMARY KEY,
  property_id INT NOT NULL,
  image_url VARCHAR(512) NOT NULL,
  sort_order INT DEFAULT 0,
  FOREIGN KEY (property_id) REFERENCES properties(id) ON DELETE CASCADE
) ENGINE=InnoDB;

-- Contact / inquiries
CREATE TABLE IF NOT EXISTS inquiries (
  id INT AUTO_INCREMENT PRIMARY KEY,
  name VARCHAR(150) NOT NULL,
  email VARCHAR(150) NOT NULL,
  subject VARCHAR(255) DEFAULT '',
  message TEXT NOT NULL,
  created_at TIMESTAMP DEFAULT CURRENT_TIMESTAMP,
  is_read TINYINT(1) DEFAULT 0
) ENGINE=InnoDB;

-- Sample data
INSERT INTO properties (slug,title,address,category,price_label,price_numeric,bedrooms,bathrooms,area,floor,parking,image_url,description) VALUES
('miami-18-new-st','18 New Street Miami, OR 97219','18 New Street Miami, OR 97219','Luxury Villa','$2.264.000',2264000,8,8,545,'3','6 spots','assets/images/property-01.jpg','Villa mewah dengan akses kota dan pemandangan menawan.'),
('florida-54-mid-st','54 Mid Street Florida, OR 27001','54 Mid Street Florida, OR 27001','Luxury Villa','$1.180.000',1180000,6,5,450,'3','8 spots','assets/images/property-02.jpg','Hunian nyaman dengan lingkungan asri.'),
('miami-26-old-st','26 Old Street Miami, OR 38540','26 Old Street Miami, OR 38540','Luxury Villa','$1.460.000',1460000,5,4,225,'3','10 spots','assets/images/property-03.jpg','Rumah modern minimalis siap huni.'),
('portland-12-new-st','12 New Street Miami, OR 12650','12 New Street Miami, OR 12650','Apartment','$584.500',584500,4,3,125,'25th','2 cars','assets/images/property-04.jpg','Apartemen strategis dekat pusat kota.'),
('portland-34-beach','34 Beach Street Miami, OR 42680','34 Beach Street Miami, OR 42680','Penthouse','$925.600',925600,4,4,180,'38th','2 cars','assets/images/property-05.jpg','Penthouse mewah view kota.'),
('portland-22-new-st','22 New Street Portland, OR 16540','22 New Street Portland, OR 16540','Modern Condo','$450.000',450000,3,2,165,'26th','3 cars','assets/images/property-06.jpg','Condo modern fasilitas lengkap.');

INSERT INTO property_images (property_id, image_url, sort_order)
SELECT id, image_url, 0 FROM properties;

-- Add a couple of extra images to the first property for the gallery
INSERT INTO property_images (property_id, image_url, sort_order) VALUES
((SELECT id FROM properties WHERE slug='miami-18-new-st'),'assets/images/deal-01.jpg',1),
((SELECT id FROM properties WHERE slug='miami-18-new-st'),'assets/images/deal-02.jpg',2);
