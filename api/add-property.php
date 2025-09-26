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
        $agent_id = $_SESSION['user_id'];
        
        // Validate required fields
        if (empty($title) || empty($location) || $price <= 0 || empty($type)) {
            echo json_encode(['success' => false, 'message' => 'Please fill in all required fields']);
            exit;
        }
        
        // Generate property code
        $property_code = 'PROP' . str_pad(rand(1, 9999), 4, '0', STR_PAD_LEFT);
        
        // Insert property
        $stmt = $pdo->prepare("
            INSERT INTO properties (title, description, price, location, type, bedrooms, bathrooms, area, features, agent_id, property_code, status) 
            VALUES (?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?)
        ");
        
        $stmt->execute([
            $title, $description, $price, $location, $type, $bedrooms, $bathrooms, $area, $features, $agent_id, $property_code, $status
        ]);
        
        $property_id = $pdo->lastInsertId();
        
        // Handle image uploads
        if (isset($_FILES['images']) && !empty($_FILES['images']['name'][0])) {
            $upload_dir = '../uploads/properties/';
            if (!is_dir($upload_dir)) {
                mkdir($upload_dir, 0777, true);
            }
            
            $image_count = 0;
            foreach ($_FILES['images']['name'] as $key => $filename) {
                if ($_FILES['images']['error'][$key] === UPLOAD_ERR_OK) {
                    $file_extension = pathinfo($filename, PATHINFO_EXTENSION);
                    $new_filename = $property_id . '_' . $image_count . '.' . $file_extension;
                    $upload_path = $upload_dir . $new_filename;
                    
                    if (move_uploaded_file($_FILES['images']['tmp_name'][$key], $upload_path)) {
                        // Insert image record
                        $image_stmt = $pdo->prepare("
                            INSERT INTO property_images (property_id, image_url, is_primary, image_order) 
                            VALUES (?, ?, ?, ?)
                        ");
                        $image_stmt->execute([
                            $property_id, 
                            'uploads/properties/' . $new_filename, 
                            $image_count === 0 ? 1 : 0, 
                            $image_count
                        ]);
                        $image_count++;
                    }
                }
            }
        }
        
        echo json_encode([
            'success' => true, 
            'message' => 'Property added successfully',
            'property_id' => $property_id
        ]);
        
    } catch (Exception $e) {
        echo json_encode(['success' => false, 'message' => 'Database error: ' . $e->getMessage()]);
    }
} else {
    echo json_encode(['success' => false, 'message' => 'Invalid request method']);
}
?>
