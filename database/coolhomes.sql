-- Cool Homes Real Estate Database
-- Comprehensive database structure for real estate management system
-- Created: 2025-01-26
-- Version: 1.0

-- Create database
CREATE DATABASE IF NOT EXISTS coolhomes_db;
USE coolhomes_db;

-- =============================================
-- USERS TABLE
-- =============================================
CREATE TABLE users (
    id INT AUTO_INCREMENT PRIMARY KEY,
    name VARCHAR(100) NOT NULL,
    email VARCHAR(100) UNIQUE NOT NULL,
    phone VARCHAR(20),
    password VARCHAR(255) NOT NULL,
    role ENUM('admin', 'agent', 'buyer', 'seller') DEFAULT 'buyer',
    status ENUM('active', 'inactive', 'suspended') DEFAULT 'active',
    profile_image VARCHAR(500),
    bio TEXT,
    specialization VARCHAR(200),
    experience_years INT DEFAULT 0,
    commission_rate DECIMAL(5,2) DEFAULT 2.50,
    created_at TIMESTAMP DEFAULT CURRENT_TIMESTAMP,
    updated_at TIMESTAMP DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP,
    last_login TIMESTAMP NULL,
    INDEX idx_email (email),
    INDEX idx_role (role),
    INDEX idx_status (status)
);

-- =============================================
-- PROPERTIES TABLE
-- =============================================
CREATE TABLE properties (
    id INT AUTO_INCREMENT PRIMARY KEY,
    title VARCHAR(200) NOT NULL,
    description TEXT,
    short_description VARCHAR(500),
    price DECIMAL(15,2) NOT NULL,
    currency VARCHAR(3) DEFAULT 'KSh',
    location VARCHAR(200) NOT NULL,
    address TEXT,
    city VARCHAR(100),
    county VARCHAR(100),
    coordinates_lat DECIMAL(10, 8),
    coordinates_lng DECIMAL(11, 8),
    type ENUM('house', 'apartment', 'villa', 'commercial', 'land', 'office', 'warehouse') NOT NULL,
    status ENUM('available', 'sold', 'rented', 'pending', 'off_market') DEFAULT 'available',
    bedrooms INT DEFAULT 0,
    bathrooms INT DEFAULT 0,
    area DECIMAL(10,2),
    area_unit ENUM('sq_ft', 'sq_m', 'acres', 'hectares') DEFAULT 'sq_ft',
    year_built YEAR,
    parking_spaces INT DEFAULT 0,
    floors INT DEFAULT 1,
    features TEXT,
    amenities TEXT,
    agent_id INT,
    owner_id INT,
    property_code VARCHAR(50) UNIQUE,
    is_featured BOOLEAN DEFAULT FALSE,
    is_premium BOOLEAN DEFAULT FALSE,
    views_count INT DEFAULT 0,
    created_at TIMESTAMP DEFAULT CURRENT_TIMESTAMP,
    updated_at TIMESTAMP DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP,
    FOREIGN KEY (agent_id) REFERENCES users(id) ON DELETE SET NULL,
    FOREIGN KEY (owner_id) REFERENCES users(id) ON DELETE SET NULL,
    INDEX idx_type (type),
    INDEX idx_status (status),
    INDEX idx_location (location),
    INDEX idx_price (price),
    INDEX idx_agent (agent_id),
    INDEX idx_featured (is_featured),
    INDEX idx_created (created_at)
);

-- =============================================
-- PROPERTY IMAGES TABLE
-- =============================================
CREATE TABLE property_images (
    id INT AUTO_INCREMENT PRIMARY KEY,
    property_id INT NOT NULL,
    image_url VARCHAR(500) NOT NULL,
    image_alt VARCHAR(200),
    is_primary BOOLEAN DEFAULT FALSE,
    image_order INT DEFAULT 0,
    file_size INT,
    dimensions VARCHAR(20),
    created_at TIMESTAMP DEFAULT CURRENT_TIMESTAMP,
    FOREIGN KEY (property_id) REFERENCES properties(id) ON DELETE CASCADE,
    INDEX idx_property (property_id),
    INDEX idx_primary (is_primary),
    INDEX idx_order (image_order)
);

-- =============================================
-- INQUIRIES TABLE
-- =============================================
CREATE TABLE inquiries (
    id INT AUTO_INCREMENT PRIMARY KEY,
    property_id INT,
    name VARCHAR(100) NOT NULL,
    email VARCHAR(100) NOT NULL,
    phone VARCHAR(20),
    subject VARCHAR(200),
    message TEXT NOT NULL,
    inquiry_type ENUM('general', 'viewing', 'price', 'financing', 'rental') DEFAULT 'general',
    status ENUM('new', 'contacted', 'in_progress', 'closed', 'spam') DEFAULT 'new',
    priority ENUM('low', 'medium', 'high', 'urgent') DEFAULT 'medium',
    assigned_to INT,
    response TEXT,
    responded_at TIMESTAMP NULL,
    created_at TIMESTAMP DEFAULT CURRENT_TIMESTAMP,
    updated_at TIMESTAMP DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP,
    FOREIGN KEY (property_id) REFERENCES properties(id) ON DELETE SET NULL,
    FOREIGN KEY (assigned_to) REFERENCES users(id) ON DELETE SET NULL,
    INDEX idx_property (property_id),
    INDEX idx_status (status),
    INDEX idx_priority (priority),
    INDEX idx_created (created_at)
);

-- =============================================
-- APPOINTMENTS TABLE
-- =============================================
CREATE TABLE appointments (
    id INT AUTO_INCREMENT PRIMARY KEY,
    property_id INT,
    client_name VARCHAR(100) NOT NULL,
    client_email VARCHAR(100) NOT NULL,
    client_phone VARCHAR(20),
    appointment_date DATE NOT NULL,
    appointment_time TIME NOT NULL,
    duration INT DEFAULT 60,
    status ENUM('pending', 'confirmed', 'completed', 'cancelled', 'rescheduled') DEFAULT 'pending',
    appointment_type ENUM('viewing', 'inspection', 'meeting', 'consultation') DEFAULT 'viewing',
    notes TEXT,
    agent_notes TEXT,
    reminder_sent BOOLEAN DEFAULT FALSE,
    created_at TIMESTAMP DEFAULT CURRENT_TIMESTAMP,
    updated_at TIMESTAMP DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP,
    FOREIGN KEY (property_id) REFERENCES properties(id) ON DELETE CASCADE,
    INDEX idx_property (property_id),
    INDEX idx_date (appointment_date),
    INDEX idx_status (status),
    INDEX idx_created (created_at)
);

-- =============================================
-- BLOG POSTS TABLE
-- =============================================
CREATE TABLE blog_posts (
    id INT AUTO_INCREMENT PRIMARY KEY,
    title VARCHAR(200) NOT NULL,
    slug VARCHAR(250) UNIQUE NOT NULL,
    excerpt TEXT,
    content LONGTEXT NOT NULL,
    author_id INT NOT NULL,
    category VARCHAR(50),
    tags TEXT,
    featured_image VARCHAR(500),
    status ENUM('draft', 'published', 'archived') DEFAULT 'draft',
    is_featured BOOLEAN DEFAULT FALSE,
    views_count INT DEFAULT 0,
    likes_count INT DEFAULT 0,
    comments_count INT DEFAULT 0,
    seo_title VARCHAR(200),
    seo_description TEXT,
    seo_keywords TEXT,
    published_at TIMESTAMP NULL,
    created_at TIMESTAMP DEFAULT CURRENT_TIMESTAMP,
    updated_at TIMESTAMP DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP,
    FOREIGN KEY (author_id) REFERENCES users(id) ON DELETE CASCADE,
    INDEX idx_author (author_id),
    INDEX idx_status (status),
    INDEX idx_category (category),
    INDEX idx_featured (is_featured),
    INDEX idx_published (published_at),
    INDEX idx_slug (slug)
);

-- =============================================
-- BLOG COMMENTS TABLE
-- =============================================
CREATE TABLE blog_comments (
    id INT AUTO_INCREMENT PRIMARY KEY,
    post_id INT NOT NULL,
    name VARCHAR(100) NOT NULL,
    email VARCHAR(100) NOT NULL,
    comment TEXT NOT NULL,
    status ENUM('pending', 'approved', 'spam', 'rejected') DEFAULT 'pending',
    parent_id INT NULL,
    created_at TIMESTAMP DEFAULT CURRENT_TIMESTAMP,
    FOREIGN KEY (post_id) REFERENCES blog_posts(id) ON DELETE CASCADE,
    FOREIGN KEY (parent_id) REFERENCES blog_comments(id) ON DELETE CASCADE,
    INDEX idx_post (post_id),
    INDEX idx_status (status),
    INDEX idx_parent (parent_id)
);

-- =============================================
-- FAVORITES TABLE
-- =============================================
CREATE TABLE favorites (
    id INT AUTO_INCREMENT PRIMARY KEY,
    user_id INT NOT NULL,
    property_id INT NOT NULL,
    created_at TIMESTAMP DEFAULT CURRENT_TIMESTAMP,
    FOREIGN KEY (user_id) REFERENCES users(id) ON DELETE CASCADE,
    FOREIGN KEY (property_id) REFERENCES properties(id) ON DELETE CASCADE,
    UNIQUE KEY unique_favorite (user_id, property_id),
    INDEX idx_user (user_id),
    INDEX idx_property (property_id)
);

-- =============================================
-- PROPERTY VIEWS TABLE
-- =============================================
CREATE TABLE property_views (
    id INT AUTO_INCREMENT PRIMARY KEY,
    property_id INT NOT NULL,
    ip_address VARCHAR(45),
    user_agent TEXT,
    referrer VARCHAR(500),
    viewed_at TIMESTAMP DEFAULT CURRENT_TIMESTAMP,
    FOREIGN KEY (property_id) REFERENCES properties(id) ON DELETE CASCADE,
    INDEX idx_property (property_id),
    INDEX idx_viewed (viewed_at)
);

-- =============================================
-- CONTACT MESSAGES TABLE
-- =============================================
CREATE TABLE contact_messages (
    id INT AUTO_INCREMENT PRIMARY KEY,
    name VARCHAR(100) NOT NULL,
    email VARCHAR(100) NOT NULL,
    phone VARCHAR(20),
    subject VARCHAR(200),
    message TEXT NOT NULL,
    status ENUM('new', 'read', 'replied', 'closed') DEFAULT 'new',
    priority ENUM('low', 'medium', 'high') DEFAULT 'medium',
    assigned_to INT,
    response TEXT,
    responded_at TIMESTAMP NULL,
    created_at TIMESTAMP DEFAULT CURRENT_TIMESTAMP,
    FOREIGN KEY (assigned_to) REFERENCES users(id) ON DELETE SET NULL,
    INDEX idx_status (status),
    INDEX idx_priority (priority),
    INDEX idx_created (created_at)
);

-- =============================================
-- NEWSLETTER SUBSCRIBERS TABLE
-- =============================================
CREATE TABLE newsletter_subscribers (
    id INT AUTO_INCREMENT PRIMARY KEY,
    email VARCHAR(100) UNIQUE NOT NULL,
    name VARCHAR(100),
    status ENUM('active', 'unsubscribed', 'bounced') DEFAULT 'active',
    subscribed_at TIMESTAMP DEFAULT CURRENT_TIMESTAMP,
    unsubscribed_at TIMESTAMP NULL,
    INDEX idx_email (email),
    INDEX idx_status (status)
);

-- =============================================
-- SYSTEM SETTINGS TABLE
-- =============================================
CREATE TABLE system_settings (
    id INT AUTO_INCREMENT PRIMARY KEY,
    setting_key VARCHAR(100) UNIQUE NOT NULL,
    setting_value TEXT,
    setting_type ENUM('text', 'number', 'boolean', 'json') DEFAULT 'text',
    description TEXT,
    updated_at TIMESTAMP DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP,
    INDEX idx_key (setting_key)
);

-- =============================================
-- SAMPLE DATA INSERTION
-- =============================================

-- Insert default admin user
INSERT INTO users (name, email, phone, password, role, status, bio, specialization, experience_years) VALUES
('Norbert', 'admin@coolhomes.co.ke', '+254 701 274 458', '$2y$10$92IXUNpkjO0rOQ5byMi.Ye4oKoEa3Ro9llC/.og/at2.uheWG/igi', 'admin', 'active', 'Founder and CEO of Cool Homes', 'Real Estate Development', 10);

-- Insert sample agents
INSERT INTO users (name, email, phone, password, role, status, bio, specialization, experience_years, commission_rate) VALUES
('Sarah Kimani', 'sarah@coolhomes.co.ke', '+254 712 345 678', '$2y$10$92IXUNpkjO0rOQ5byMi.Ye4oKoEa3Ro9llC/.og/at2.uheWG/igi', 'agent', 'active', 'Senior Real Estate Agent', 'Luxury Properties', 8, 3.00),
('Michael Otieno', 'michael@coolhomes.co.ke', '+254 723 456 789', '$2y$10$92IXUNpkjO0rOQ5byMi.Ye4oKoEa3Ro9llC/.og/at2.uheWG/igi', 'agent', 'active', 'Commercial Real Estate Specialist', 'Commercial Properties', 6, 2.75);

-- Insert sample properties
INSERT INTO properties (title, description, short_description, price, location, address, city, county, type, status, bedrooms, bathrooms, area, year_built, parking_spaces, features, amenities, agent_id, property_code, is_featured) VALUES
('Luxury Villa in Karen', 'This stunning villa offers the perfect blend of modern luxury and classic elegance. Located in the prestigious Karen area, this property features spacious rooms, a beautiful garden, and all modern amenities.', 'Stunning villa in prestigious Karen area with modern amenities', 45000000, 'Karen, Nairobi', 'Karen Road, Nairobi', 'Nairobi', 'Nairobi', 'villa', 'available', 5, 4, 800, 2020, 3, 'Swimming Pool,Garden,Security System,Modern Kitchen', 'Gated Community,24/7 Security,Swimming Pool,Garden,Modern Kitchen', 1, 'VIL001', TRUE),
('Modern Apartment in Westlands', 'Contemporary apartment in the heart of Westlands with stunning city views. Features modern finishes, open-plan living, and premium amenities.', 'Contemporary apartment with city views in Westlands', 8500000, 'Westlands, Nairobi', 'Waiyaki Way, Westlands', 'Nairobi', 'Nairobi', 'apartment', 'available', 3, 2, 120, 2022, 1, 'City Views,Modern Finishes,Open Plan', 'Gym,Swimming Pool,Concierge,Parking', 2, 'APT001', FALSE),
('Beach House in Mombasa', 'Beautiful beachfront property in Nyali with direct beach access. Perfect for vacation rental or permanent residence.', 'Beachfront property with direct beach access in Nyali', 25000000, 'Nyali, Mombasa', 'Nyali Beach Road, Mombasa', 'Mombasa', 'Mombasa', 'house', 'available', 4, 3, 300, 2019, 2, 'Beach Access,Sea Views,Private Garden', 'Beach Access,Sea Views,Private Garden,Swimming Pool', 3, 'BEH001', TRUE),
('Commercial Office Space', 'Prime office space in Upper Hill business district. Modern facilities with excellent connectivity and parking.', 'Prime office space in Upper Hill business district', 15000000, 'Upper Hill, Nairobi', 'Upper Hill Road, Nairobi', 'Nairobi', 'Nairobi', 'commercial', 'available', 0, 2, 200, 2021, 5, 'Modern Facilities,Excellent Connectivity', 'Parking,24/7 Security,Modern Facilities', 1, 'COM001', FALSE);

-- Insert property images
INSERT INTO property_images (property_id, image_url, image_alt, is_primary, image_order) VALUES
(1, '26-Mzizi-Court.webp', 'Luxury Villa in Karen - Main View', TRUE, 1),
(1, 'Loft-Residences.webp', 'Luxury Villa in Karen - Interior', FALSE, 2),
(1, 'Riverbank.webp', 'Luxury Villa in Karen - Garden', FALSE, 3),
(2, 'Loft-Residences.webp', 'Modern Apartment in Westlands', TRUE, 1),
(2, 'The-One-at-Two-Rivers.webp', 'Modern Apartment - Living Area', FALSE, 2),
(3, 'Riverbank.webp', 'Beach House in Mombasa', TRUE, 1),
(3, '26-Mzizi-Court.webp', 'Beach House - Interior', FALSE, 2),
(4, 'The-One-at-Two-Rivers.webp', 'Commercial Office Space', TRUE, 1);

-- Insert sample blog posts
INSERT INTO blog_posts (title, slug, excerpt, content, author_id, category, tags, featured_image, status, is_featured, seo_title, seo_description) VALUES
('Kenya\'s Real Estate Market Trends 2024', 'kenya-real-estate-market-trends-2024', 'Discover the latest trends in Kenya\'s booming real estate market, from Nairobi\'s skyline to Mombasa\'s coastal properties.', 'Kenya\'s real estate market has shown remarkable resilience and growth in 2024. Nairobi continues to lead with innovative mixed-use developments, while coastal areas like Mombasa and Malindi are experiencing unprecedented demand for vacation homes and rental properties...', 1, 'market-trends', 'real estate,market trends,Nairobi,Mombasa', '26-Mzizi-Court.webp', 'published', TRUE, 'Kenya Real Estate Market Trends 2024 | Cool Homes', 'Discover the latest trends in Kenya\'s booming real estate market with expert insights and market analysis.'),
('Rental Market Analysis: Nairobi vs Mombasa', 'rental-market-analysis-nairobi-vs-mombasa', 'A comprehensive comparison of rental markets in Nairobi and Mombasa, including yields, trends, and investment opportunities.', 'The rental market in Kenya presents diverse opportunities across different regions. Understanding the unique characteristics of each market is crucial for investors and tenants alike...', 1, 'rental', 'rental market,Nairobi,Mombasa,investment', 'The-One-at-Two-Rivers.webp', 'published', FALSE, 'Rental Market Analysis: Nairobi vs Mombasa | Cool Homes', 'Compare rental markets in Nairobi and Mombasa with detailed analysis and investment opportunities.'),
('Affordable Housing in Kenya: Opportunities and Challenges', 'affordable-housing-kenya-opportunities-challenges', 'Exploring Kenya\'s affordable housing sector, government initiatives, and investment opportunities for developers and buyers.', 'Kenya\'s affordable housing sector has gained significant momentum with the government\'s Big 4 Agenda, aiming to deliver 500,000 affordable homes by 2022...', 1, 'affordable-housing', 'affordable housing,government initiatives,investment', '26-Mzizi-Court.webp', 'published', FALSE, 'Affordable Housing in Kenya | Cool Homes', 'Explore Kenya\'s affordable housing sector with government initiatives and investment opportunities.');

-- Insert system settings
INSERT INTO system_settings (setting_key, setting_value, setting_type, description) VALUES
('site_name', 'Cool Homes', 'text', 'Website name'),
('site_email', 'info@coolhomes.co.ke', 'text', 'Main contact email'),
('site_phone', '+254 701 274 458', 'text', 'Main contact phone'),
('currency', 'KSh', 'text', 'Default currency'),
('properties_per_page', '12', 'number', 'Number of properties per page'),
('featured_properties_count', '6', 'number', 'Number of featured properties to show'),
('blog_posts_per_page', '9', 'number', 'Number of blog posts per page'),
('enable_registration', 'true', 'boolean', 'Allow user registration'),
('maintenance_mode', 'false', 'boolean', 'Enable maintenance mode');

-- =============================================
-- INDEXES FOR PERFORMANCE
-- =============================================

-- Additional indexes for better performance
CREATE INDEX idx_properties_price_range ON properties(price, status, type);
CREATE INDEX idx_properties_location_type ON properties(location, type, status);
CREATE INDEX idx_inquiries_status_created ON inquiries(status, created_at);
CREATE INDEX idx_appointments_date_status ON appointments(appointment_date, status);
CREATE INDEX idx_blog_posts_status_published ON blog_posts(status, published_at);

-- =============================================
-- VIEWS FOR COMMON QUERIES
-- =============================================

-- Featured properties view
CREATE VIEW featured_properties AS
SELECT p.*, u.name as agent_name, pi.image_url
FROM properties p
LEFT JOIN users u ON p.agent_id = u.id
LEFT JOIN property_images pi ON p.id = pi.property_id AND pi.is_primary = 1
WHERE p.is_featured = TRUE AND p.status = 'available'
ORDER BY p.created_at DESC;

-- Recent blog posts view
CREATE VIEW recent_blog_posts AS
SELECT bp.*, u.name as author_name
FROM blog_posts bp
JOIN users u ON bp.author_id = u.id
WHERE bp.status = 'published'
ORDER BY bp.published_at DESC;

-- Property statistics view
CREATE VIEW property_stats AS
SELECT 
    COUNT(*) as total_properties,
    COUNT(CASE WHEN status = 'available' THEN 1 END) as available_properties,
    COUNT(CASE WHEN status = 'sold' THEN 1 END) as sold_properties,
    COUNT(CASE WHEN status = 'rented' THEN 1 END) as rented_properties,
    AVG(price) as average_price,
    MIN(price) as min_price,
    MAX(price) as max_price
FROM properties;

-- =============================================
-- STORED PROCEDURES
-- =============================================

DELIMITER //

-- Procedure to get property details with images
CREATE PROCEDURE GetPropertyDetails(IN property_id INT)
BEGIN
    SELECT p.*, u.name as agent_name, u.email as agent_email, u.phone as agent_phone
    FROM properties p
    LEFT JOIN users u ON p.agent_id = u.id
    WHERE p.id = property_id;
    
    SELECT * FROM property_images WHERE property_id = property_id ORDER BY is_primary DESC, image_order ASC;
END //

-- Procedure to search properties
CREATE PROCEDURE SearchProperties(
    IN search_term VARCHAR(200),
    IN property_type VARCHAR(50),
    IN min_price DECIMAL(15,2),
    IN max_price DECIMAL(15,2),
    IN location VARCHAR(200)
)
BEGIN
    SELECT p.*, u.name as agent_name, pi.image_url
    FROM properties p
    LEFT JOIN users u ON p.agent_id = u.id
    LEFT JOIN property_images pi ON p.id = pi.property_id AND pi.is_primary = 1
    WHERE p.status = 'available'
    AND (search_term IS NULL OR p.title LIKE CONCAT('%', search_term, '%') OR p.description LIKE CONCAT('%', search_term, '%'))
    AND (property_type IS NULL OR p.type = property_type)
    AND (min_price IS NULL OR p.price >= min_price)
    AND (max_price IS NULL OR p.price <= max_price)
    AND (location IS NULL OR p.location LIKE CONCAT('%', location, '%'))
    ORDER BY p.created_at DESC;
END //

DELIMITER ;

-- =============================================
-- TRIGGERS
-- =============================================

-- Trigger to update property views count
DELIMITER //
CREATE TRIGGER update_property_views
AFTER INSERT ON property_views
FOR EACH ROW
BEGIN
    UPDATE properties 
    SET views_count = views_count + 1 
    WHERE id = NEW.property_id;
END //
DELIMITER ;

-- Trigger to update blog post views count
DELIMITER //
CREATE TRIGGER update_blog_views
AFTER INSERT ON property_views
FOR EACH ROW
BEGIN
    UPDATE blog_posts 
    SET views_count = views_count + 1 
    WHERE id = NEW.property_id;
END //
DELIMITER ;

-- =============================================
-- END OF DATABASE SETUP
-- =============================================

-- Display completion message
SELECT 'Cool Homes Database Setup Complete!' as message;
