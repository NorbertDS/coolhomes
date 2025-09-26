<?php
header('Content-Type: application/json');
session_start();

// Check if user is logged in and is admin
if (!isset($_SESSION['user_id']) || $_SESSION['user_role'] !== 'admin') {
    echo json_encode(['success' => false, 'message' => 'Unauthorized access']);
    exit;
}

require_once '../config/database.php';

if ($_SERVER['REQUEST_METHOD'] === 'GET' && isset($_GET['id'])) {
    try {
        $pdo = getDBConnection();
        $property_id = intval($_GET['id']);
        
        // Get property details
        $stmt = $pdo->prepare("
            SELECT p.*, u.name as agent_name 
            FROM properties p 
            LEFT JOIN users u ON p.agent_id = u.id 
            WHERE p.id = ?
        ");
        $stmt->execute([$property_id]);
        $property = $stmt->fetch(PDO::FETCH_ASSOC);
        
        if ($property) {
            // Get property images
            $stmt = $pdo->prepare("SELECT * FROM property_images WHERE property_id = ? ORDER BY is_primary DESC, image_order ASC");
            $stmt->execute([$property_id]);
            $images = $stmt->fetchAll(PDO::FETCH_ASSOC);
            
            $property['images'] = $images;
            echo json_encode(['success' => true, 'data' => $property]);
        } else {
            echo json_encode(['success' => false, 'message' => 'Property not found']);
        }
        
    } catch (Exception $e) {
        echo json_encode(['success' => false, 'message' => 'Database error: ' . $e->getMessage()]);
    }
} else {
    echo json_encode(['success' => false, 'message' => 'Invalid request']);
}
?>
