<?php
// Database configuration
define('DB_HOST', 'localhost');
define('DB_NAME', 'coolhomes_db');
define('DB_USER', 'root');
define('DB_PASS', '');

// Create database connection
function getDBConnection() {
    try {
        $pdo = new PDO("mysql:host=" . DB_HOST . ";dbname=" . DB_NAME, DB_USER, DB_PASS);
        $pdo->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
        $pdo->setAttribute(PDO::ATTR_DEFAULT_FETCH_MODE, PDO::FETCH_ASSOC);
        return $pdo;
    } catch(PDOException $e) {
        // If database doesn't exist, try to create it
        try {
            $pdo = new PDO("mysql:host=" . DB_HOST, DB_USER, DB_PASS);
            $pdo->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
            $pdo->exec("CREATE DATABASE IF NOT EXISTS " . DB_NAME);
            $pdo->exec("USE " . DB_NAME);
            
            // Import SQL file if it exists
            $sqlFile = __DIR__ . '/../database/coolhomes.sql';
            if (file_exists($sqlFile)) {
                $sql = file_get_contents($sqlFile);
                $statements = explode(';', $sql);
                foreach ($statements as $statement) {
                    $statement = trim($statement);
                    if (!empty($statement)) {
                        $pdo->exec($statement);
                    }
                }
            }
            
            return $pdo;
        } catch(PDOException $e2) {
            die("Database setup failed: " . $e2->getMessage());
        }
    }
}

// Database tables structure
function createTables() {
    $pdo = getDBConnection();
    
    // Users table
    $usersTable = "CREATE TABLE IF NOT EXISTS users (
        id INT AUTO_INCREMENT PRIMARY KEY,
        name VARCHAR(100) NOT NULL,
        email VARCHAR(100) UNIQUE NOT NULL,
        phone VARCHAR(20),
        role ENUM('admin', 'agent', 'buyer', 'seller') DEFAULT 'buyer',
        status ENUM('active', 'inactive') DEFAULT 'active',
        created_at TIMESTAMP DEFAULT CURRENT_TIMESTAMP
    )";
    
    // Properties table
    $propertiesTable = "CREATE TABLE IF NOT EXISTS properties (
        id INT AUTO_INCREMENT PRIMARY KEY,
        title VARCHAR(200) NOT NULL,
        description TEXT,
        price DECIMAL(15,2) NOT NULL,
        location VARCHAR(200) NOT NULL,
        type ENUM('house', 'apartment', 'villa', 'commercial') NOT NULL,
        status ENUM('available', 'sold', 'rented') DEFAULT 'available',
        bedrooms INT,
        bathrooms INT,
        area DECIMAL(10,2),
        features TEXT,
        agent_id INT,
        created_at TIMESTAMP DEFAULT CURRENT_TIMESTAMP,
        FOREIGN KEY (agent_id) REFERENCES users(id)
    )";
    
    // Property images table
    $imagesTable = "CREATE TABLE IF NOT EXISTS property_images (
        id INT AUTO_INCREMENT PRIMARY KEY,
        property_id INT NOT NULL,
        image_url VARCHAR(500) NOT NULL,
        is_primary BOOLEAN DEFAULT FALSE,
        created_at TIMESTAMP DEFAULT CURRENT_TIMESTAMP,
        FOREIGN KEY (property_id) REFERENCES properties(id) ON DELETE CASCADE
    )";
    
    // Inquiries table
    $inquiriesTable = "CREATE TABLE IF NOT EXISTS inquiries (
        id INT AUTO_INCREMENT PRIMARY KEY,
        property_id INT,
        name VARCHAR(100) NOT NULL,
        email VARCHAR(100) NOT NULL,
        phone VARCHAR(20),
        message TEXT NOT NULL,
        status ENUM('new', 'contacted', 'closed') DEFAULT 'new',
        created_at TIMESTAMP DEFAULT CURRENT_TIMESTAMP,
        FOREIGN KEY (property_id) REFERENCES properties(id)
    )";
    
    // Blog posts table
    $blogTable = "CREATE TABLE IF NOT EXISTS blog_posts (
        id INT AUTO_INCREMENT PRIMARY KEY,
        title VARCHAR(200) NOT NULL,
        excerpt TEXT,
        content LONGTEXT NOT NULL,
        author VARCHAR(100) NOT NULL,
        category VARCHAR(50),
        status ENUM('draft', 'published') DEFAULT 'draft',
        featured_image VARCHAR(500),
        views INT DEFAULT 0,
        created_at TIMESTAMP DEFAULT CURRENT_TIMESTAMP,
        updated_at TIMESTAMP DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP
    )";
    
    // Appointments table
    $appointmentsTable = "CREATE TABLE IF NOT EXISTS appointments (
        id INT AUTO_INCREMENT PRIMARY KEY,
        property_id INT,
        client_name VARCHAR(100) NOT NULL,
        client_email VARCHAR(100) NOT NULL,
        client_phone VARCHAR(20),
        appointment_date DATE NOT NULL,
        appointment_time TIME NOT NULL,
        status ENUM('pending', 'confirmed', 'cancelled') DEFAULT 'pending',
        notes TEXT,
        created_at TIMESTAMP DEFAULT CURRENT_TIMESTAMP,
        FOREIGN KEY (property_id) REFERENCES properties(id)
    )";
    
    try {
        $pdo->exec($usersTable);
        $pdo->exec($propertiesTable);
        $pdo->exec($imagesTable);
        $pdo->exec($inquiriesTable);
        $pdo->exec($blogTable);
        $pdo->exec($appointmentsTable);
        return true;
    } catch(PDOException $e) {
        die("Error creating tables: " . $e->getMessage());
    }
}

// Initialize database
createTables();
?>
