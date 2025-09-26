<?php
header('Content-Type: application/json');
session_start();

// Check if user is logged in and is admin
if (!isset($_SESSION['user_id']) || $_SESSION['user_role'] !== 'admin') {
    echo json_encode(['success' => false, 'message' => 'Unauthorized access']);
    exit;
}

require_once '../config/database.php';

try {
    $pdo = getDBConnection();
    $data = [];
    
    // Get properties
    $stmt = $pdo->prepare("
        SELECT p.*, u.name as agent_name, pi.image_url 
        FROM properties p 
        LEFT JOIN users u ON p.agent_id = u.id 
        LEFT JOIN property_images pi ON p.id = pi.property_id AND pi.is_primary = 1
        ORDER BY p.created_at DESC
    ");
    $stmt->execute();
    $data['properties'] = $stmt->fetchAll();
    
    // Get users
    $stmt = $pdo->prepare("
        SELECT id, name, email, phone, role, status, created_at 
        FROM users 
        WHERE role != 'admin' 
        ORDER BY created_at DESC
    ");
    $stmt->execute();
    $data['users'] = $stmt->fetchAll();
    
    // Get inquiries
    $stmt = $pdo->prepare("
        SELECT i.*, p.title as property_title 
        FROM inquiries i 
        LEFT JOIN properties p ON i.property_id = p.id 
        ORDER BY i.created_at DESC
    ");
    $stmt->execute();
    $data['inquiries'] = $stmt->fetchAll();
    
    // Get appointments
    $stmt = $pdo->prepare("
        SELECT a.*, p.title as property_title 
        FROM appointments a 
        LEFT JOIN properties p ON a.property_id = p.id 
        ORDER BY a.appointment_date DESC
    ");
    $stmt->execute();
    $data['appointments'] = $stmt->fetchAll();
    
    echo json_encode(['success' => true, 'data' => $data]);
    
} catch (Exception $e) {
    echo json_encode(['success' => false, 'message' => 'Database error: ' . $e->getMessage()]);
}
?>
