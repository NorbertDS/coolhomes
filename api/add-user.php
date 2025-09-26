<?php
header('Content-Type: application/json');
require_once '../config/database.php';

$pdo = getDBConnection();

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $name = $_POST['name'] ?? '';
    $email = $_POST['email'] ?? '';
    $phone = $_POST['phone'] ?? '';
    $role = $_POST['role'] ?? 'buyer';
    $status = $_POST['status'] ?? 'active';
    $bio = $_POST['bio'] ?? '';

    // Validate required fields
    if (!$name || !$email || !$role) {
        echo json_encode(['success' => false, 'message' => 'Missing required fields.']);
        exit;
    }

    // Check if email already exists
    try {
        $stmt = $pdo->prepare("SELECT id FROM users WHERE email = ?");
        $stmt->execute([$email]);
        if ($stmt->fetch()) {
            echo json_encode(['success' => false, 'message' => 'Email already exists.']);
            exit;
        }

        // Insert user into database
        $stmt = $pdo->prepare("INSERT INTO users (name, email, phone, role, status, bio, created_at) VALUES (?, ?, ?, ?, ?, ?, NOW())");
        $stmt->execute([$name, $email, $phone, $role, $status, $bio]);

        echo json_encode(['success' => true, 'message' => 'User added successfully!']);
    } catch (PDOException $e) {
        echo json_encode(['success' => false, 'message' => 'Database error: ' . $e->getMessage()]);
    }
} else {
    echo json_encode(['success' => false, 'message' => 'Invalid request method.']);
}
?>