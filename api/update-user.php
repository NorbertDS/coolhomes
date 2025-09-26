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
        
        $user_id = intval($_POST['user_id'] ?? 0);
        
        if ($user_id <= 0) {
            echo json_encode(['success' => false, 'message' => 'Invalid user ID']);
            exit;
        }
        
        // Get form data
        $name = $_POST['name'] ?? '';
        $email = $_POST['email'] ?? '';
        $phone = $_POST['phone'] ?? '';
        $role = $_POST['role'] ?? 'buyer';
        $status = $_POST['status'] ?? 'active';
        $bio = $_POST['bio'] ?? '';
        $specialization = $_POST['specialization'] ?? '';
        $experience_years = intval($_POST['experience_years'] ?? 0);
        $commission_rate = floatval($_POST['commission_rate'] ?? 2.50);
        
        // Validate required fields
        if (empty($name) || empty($email) || empty($role)) {
            echo json_encode(['success' => false, 'message' => 'Please fill in all required fields']);
            exit;
        }
        
        // Check if email already exists for another user
        $check_stmt = $pdo->prepare("SELECT id FROM users WHERE email = ? AND id != ?");
        $check_stmt->execute([$email, $user_id]);
        if ($check_stmt->fetch()) {
            echo json_encode(['success' => false, 'message' => 'Email already exists for another user']);
            exit;
        }
        
        // Update user
        $stmt = $pdo->prepare("
            UPDATE users 
            SET name = ?, email = ?, phone = ?, role = ?, status = ?, bio = ?, 
                specialization = ?, experience_years = ?, commission_rate = ?, updated_at = CURRENT_TIMESTAMP
            WHERE id = ?
        ");
        
        $stmt->execute([
            $name, $email, $phone, $role, $status, $bio, $specialization, $experience_years, $commission_rate, $user_id
        ]);
        
        if ($stmt->rowCount() > 0) {
            echo json_encode([
                'success' => true, 
                'message' => 'User updated successfully'
            ]);
        } else {
            echo json_encode(['success' => false, 'message' => 'User not found or no changes made']);
        }
        
    } catch (Exception $e) {
        echo json_encode(['success' => false, 'message' => 'Database error: ' . $e->getMessage()]);
    }
} else {
    echo json_encode(['success' => false, 'message' => 'Invalid request method']);
}
?>
