<?php
header('Content-Type: application/json');
require_once '../config/database.php';

$pdo = getDBConnection();

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $title = $_POST['title'] ?? '';
    $excerpt = $_POST['excerpt'] ?? '';
    $content = $_POST['content'] ?? '';
    $author = $_POST['author'] ?? '';
    $category = $_POST['category'] ?? 'market-trends';
    $status = $_POST['status'] ?? 'draft';

    // Validate required fields
    if (!$title || !$content || !$author) {
        echo json_encode(['success' => false, 'message' => 'Missing required fields.']);
        exit;
    }

    try {
        // Handle featured image upload
        $featuredImage = '';
        if (isset($_FILES['featured_image']) && !empty($_FILES['featured_image']['name'])) {
            $uploadDir = '../uploads/blog/';
            if (!is_dir($uploadDir)) {
                mkdir($uploadDir, 0777, true);
            }
            
            $fileExtension = pathinfo($_FILES['featured_image']['name'], PATHINFO_EXTENSION);
            $newFilename = uniqid() . '_' . time() . '.' . $fileExtension;
            $uploadPath = $uploadDir . $newFilename;
            
            if (move_uploaded_file($_FILES['featured_image']['tmp_name'], $uploadPath)) {
                $featuredImage = 'uploads/blog/' . $newFilename;
            }
        }

        // Insert blog post into database
        $stmt = $pdo->prepare("INSERT INTO blog_posts (title, excerpt, content, author, category, featured_image, status, created_at) VALUES (?, ?, ?, ?, ?, ?, ?, NOW())");
        $stmt->execute([$title, $excerpt, $content, $author, $category, $featuredImage, $status]);

        echo json_encode(['success' => true, 'message' => 'Blog post added successfully!']);
    } catch (PDOException $e) {
        echo json_encode(['success' => false, 'message' => 'Database error: ' . $e->getMessage()]);
    }
} else {
    echo json_encode(['success' => false, 'message' => 'Invalid request method.']);
}
?>
