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
        
        $property_id = intval($_POST['property_id']);
        $title = trim($_POST['title']);
        $location = trim($_POST['location']);
        $price = floatval($_POST['price']);
        $bedrooms = intval($_POST['bedrooms']);
        $bathrooms = intval($_POST['bathrooms']);
        $area = intval($_POST['area']);
        $type = trim($_POST['type']);
        $description = trim($_POST['description']);
        $features = trim($_POST['features']);
        $status = trim($_POST['status']);
        
        // Validate required fields
        if (empty($title) || empty($location) || empty($price) || empty($type)) {
            echo json_encode(['success' => false, 'message' => 'Please fill in all required fields']);
            exit;
        }
        
        // Update property
        $stmt = $pdo->prepare("
            UPDATE properties 
            SET title = ?, location = ?, price = ?, bedrooms = ?, bathrooms = ?, 
                area = ?, type = ?, description = ?, features = ?, status = ?, updated_at = NOW()
            WHERE id = ?
        ");
        
        $result = $stmt->execute([
            $title, $location, $price, $bedrooms, $bathrooms, 
            $area, $type, $description, $features, $status, $property_id
        ]);
        
        if ($result) {
            // Handle image uploads if any
            if (isset($_FILES['images']) && !empty($_FILES['images']['name'][0])) {
                // Delete old images
                $stmt = $pdo->prepare("DELETE FROM property_images WHERE property_id = ?");
                $stmt->execute([$property_id]);
                
                // Upload new images
                $upload_dir = '../uploads/properties/';
                if (!file_exists($upload_dir)) {
                    mkdir($upload_dir, 0777, true);
                }
                
                $image_count = count($_FILES['images']['name']);
                for ($i = 0; $i < $image_count; $i++) {
                    if ($_FILES['images']['error'][$i] === UPLOAD_ERR_OK) {
                        $file_extension = pathinfo($_FILES['images']['name'][$i], PATHINFO_EXTENSION);
                        $new_filename = 'property_' . $property_id . '_' . time() . '_' . $i . '.' . $file_extension;
                        $upload_path = $upload_dir . $new_filename;
                        
                        if (move_uploaded_file($_FILES['images']['tmp_name'][$i], $upload_path)) {
                            $stmt = $pdo->prepare("
                                INSERT INTO property_images (property_id, image_url, is_primary, image_order) 
                                VALUES (?, ?, ?, ?)
                            ");
                            $stmt->execute([
                                $property_id, 
                                'uploads/properties/' . $new_filename,
                                $i === 0 ? 1 : 0,
                                $i + 1
                            ]);
                        }
                    }
                }
            }
            
            echo json_encode(['success' => true, 'message' => 'Property updated successfully']);
        } else {
            echo json_encode(['success' => false, 'message' => 'Failed to update property']);
        }
        
    } catch (Exception $e) {
        echo json_encode(['success' => false, 'message' => 'Database error: ' . $e->getMessage()]);
    }
} else {
    echo json_encode(['success' => false, 'message' => 'Invalid request method']);
}
?>