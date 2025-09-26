<?php
header('Content-Type: application/json');
session_start();

// Check if user is logged in and is admin
if (!isset($_SESSION['user_id']) || $_SESSION['user_role'] !== 'admin') {
    echo json_encode(['success' => false, 'message' => 'Unauthorized access']);
    exit;
}

require_once '../config/database.php';

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    try {
        $pdo = getDBConnection();
        
        $property_id = intval($_POST['property_id'] ?? 0);
        
        if ($property_id <= 0) {
            echo json_encode(['success' => false, 'message' => 'Invalid property ID']);
            exit;
        }
        
        // Get form data
        $title = $_POST['title'] ?? '';
        $description = $_POST['description'] ?? '';
        $price = floatval($_POST['price'] ?? 0);
        $location = $_POST['location'] ?? '';
        $type = $_POST['type'] ?? '';
        $bedrooms = intval($_POST['bedrooms'] ?? 0);
        $bathrooms = intval($_POST['bathrooms'] ?? 0);
        $area = floatval($_POST['area'] ?? 0);
        $features = $_POST['features'] ?? '';
        $status = $_POST['status'] ?? 'available';
        
        // Validate required fields
        if (empty($title) || empty($location) || $price <= 0 || empty($type)) {
            echo json_encode(['success' => false, 'message' => 'Please fill in all required fields']);
            exit;
        }
        
        // Update property
        $stmt = $pdo->prepare("
            UPDATE properties 
            SET title = ?, description = ?, price = ?, location = ?, type = ?, 
                bedrooms = ?, bathrooms = ?, area = ?, features = ?, status = ?, updated_at = CURRENT_TIMESTAMP
            WHERE id = ?
        ");
        
        $stmt->execute([
            $title, $description, $price, $location, $type, $bedrooms, $bathrooms, $area, $features, $status, $property_id
        ]);
        
        if ($stmt->rowCount() > 0) {
            echo json_encode([
                'success' => true, 
                'message' => 'Property updated successfully'
            ]);
        } else {
            echo json_encode(['success' => false, 'message' => 'Property not found or no changes made']);
        }
        
    } catch (Exception $e) {
        echo json_encode(['success' => false, 'message' => 'Database error: ' . $e->getMessage()]);
    }
} else {
    echo json_encode(['success' => false, 'message' => 'Invalid request method']);
}
?>
