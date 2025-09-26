<?php
header('Content-Type: application/json');
require_once '../config/database.php';

$pdo = getDBConnection();

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $title = $_POST['title'] ?? '';
    $location = $_POST['location'] ?? '';
    $price = $_POST['price'] ?? 0;
    $bedrooms = $_POST['bedrooms'] ?? 0;
    $bathrooms = $_POST['bathrooms'] ?? 0;
    $area = $_POST['area'] ?? 0;
    $type = $_POST['type'] ?? '';
    $description = $_POST['description'] ?? '';
    $features = $_POST['features'] ?? '';
    $status = $_POST['status'] ?? 'available';

    // Validate required fields
    if (!$title || !$location || !$price || !$type) {
        echo json_encode(['success' => false, 'message' => 'Missing required fields.']);
        exit;
    }

    try {
        // Handle image uploads
        $imagePaths = [];
        if (isset($_FILES['images']) && !empty($_FILES['images']['name'][0])) {
            $uploadDir = '../uploads/properties/';
            if (!is_dir($uploadDir)) {
                mkdir($uploadDir, 0777, true);
            }
            
            foreach ($_FILES['images']['name'] as $key => $filename) {
                if (!empty($filename)) {
                    $fileExtension = pathinfo($filename, PATHINFO_EXTENSION);
                    $newFilename = uniqid() . '_' . time() . '.' . $fileExtension;
                    $uploadPath = $uploadDir . $newFilename;
                    
                    if (move_uploaded_file($_FILES['images']['tmp_name'][$key], $uploadPath)) {
                        $imagePaths[] = 'uploads/properties/' . $newFilename;
                    }
                }
            }
        }

        // Insert property into database
        $stmt = $pdo->prepare("INSERT INTO properties (title, location, price, bedrooms, bathrooms, area, type, description, features, status, images, created_at) VALUES (?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, NOW())");
        $stmt->execute([
            $title,
            $location,
            $price,
            $bedrooms,
            $bathrooms,
            $area,
            $type,
            $description,
            $features,
            $status,
            json_encode($imagePaths)
        ]);

        echo json_encode(['success' => true, 'message' => 'Property added successfully!']);
    } catch (PDOException $e) {
        echo json_encode(['success' => false, 'message' => 'Database error: ' . $e->getMessage()]);
    }
} else {
    echo json_encode(['success' => false, 'message' => 'Invalid request method.']);
}
?>