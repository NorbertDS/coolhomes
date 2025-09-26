<?php
header('Content-Type: application/json');
require_once '../config/database.php';

$pdo = getDBConnection();

try {
    // Get properties
    $propertiesStmt = $pdo->query("SELECT id, title, location, price, type, status, bedrooms, bathrooms, created_at FROM properties ORDER BY created_at DESC LIMIT 50");
    $properties = $propertiesStmt->fetchAll(PDO::FETCH_ASSOC);

    // Get users
    $usersStmt = $pdo->query("SELECT id, name, email, role, status, created_at FROM users WHERE role != 'admin' ORDER BY created_at DESC LIMIT 50");
    $users = $usersStmt->fetchAll(PDO::FETCH_ASSOC);

    // Get inquiries
    $inquiriesStmt = $pdo->query("SELECT id, name, email, property_id, status, created_at FROM inquiries ORDER BY created_at DESC LIMIT 50");
    $inquiries = $inquiriesStmt->fetchAll(PDO::FETCH_ASSOC);

    // Get appointments
    $appointmentsStmt = $pdo->query("SELECT id, client_name, property_id, appointment_date, appointment_time, status, created_at FROM appointments ORDER BY created_at DESC LIMIT 50");
    $appointments = $appointmentsStmt->fetchAll(PDO::FETCH_ASSOC);

    // Get blog posts
    $blogStmt = $pdo->query("SELECT id, title, author, status, created_at FROM blog_posts ORDER BY created_at DESC LIMIT 50");
    $blogPosts = $blogStmt->fetchAll(PDO::FETCH_ASSOC);

    echo json_encode([
        'success' => true,
        'data' => [
            'properties' => $properties,
            'users' => $users,
            'inquiries' => $inquiries,
            'appointments' => $appointments,
            'blog_posts' => $blogPosts
        ]
    ]);
} catch (PDOException $e) {
    echo json_encode(['success' => false, 'message' => 'Database error: ' . $e->getMessage()]);
}
?>
