<?php
session_start();

// Check if user is logged in and is admin
if (!isset($_SESSION['user_id']) || $_SESSION['user_role'] !== 'admin') {
    header('Location: login.php');
    exit;
}
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Admin Dashboard - Cool Homes</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">
    <link href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0/css/all.min.css" rel="stylesheet">
    <style>
        body { font-family: Arial, sans-serif; margin: 0; padding: 20px; background: #f5f5f5; }
        .container { max-width: 1200px; margin: 0 auto; }
        .header { background: white; padding: 20px; border-radius: 10px; margin-bottom: 20px; box-shadow: 0 2px 10px rgba(0,0,0,0.1); }
        .import-btn { background: #ff0000 !important; color: white !important; font-size: 18px !important; padding: 15px 30px !important; }
        .test-message { background: #ffff00; padding: 15px; border-radius: 5px; margin-bottom: 20px; font-weight: bold; }
    </style>
</head>
<body>
    <div class="container">
        <div class="test-message">
            🚨 TEST MESSAGE: If you can see this, the dashboard is working! Look for the RED IMPORT button below.
        </div>
        
        <div class="header">
            <div class="d-flex justify-content-between align-items-center">
                <div>
                    <h1>Welcome, <?php echo $_SESSION['user_name']; ?>!</h1>
                    <p>Cool Homes Founder</p>
                </div>
                <div>
                    <a href="admin-import-properties.php" class="btn btn-primary import-btn">
                        <i class="fas fa-download"></i> IMPORT PROPERTIES - CLICK HERE
                    </a>
                </div>
            </div>
        </div>
        
        <div class="header">
            <h3>Quick Actions</h3>
            <div class="d-flex gap-3">
                <a href="admin-import-properties.php" class="btn btn-warning">
                    <i class="fas fa-download"></i> Import Properties
                </a>
                <button class="btn btn-primary">Add Property</button>
                <button class="btn btn-success">Add User</button>
            </div>
        </div>
        
        <div class="header">
            <h3>Navigation Links</h3>
            <div class="d-flex flex-column gap-2">
                <a href="admin-import-properties.php" class="btn btn-outline-primary">
                    <i class="fas fa-download"></i> Import Properties (Link 1)
                </a>
                <a href="admin-import-properties.php" class="btn btn-outline-success">
                    <i class="fas fa-download"></i> Import Properties (Link 2)
                </a>
                <a href="admin-import-properties.php" class="btn btn-outline-warning">
                    <i class="fas fa-download"></i> Import Properties (Link 3)
                </a>
            </div>
        </div>
        
        <div class="header">
            <h3>Debug Information</h3>
            <p><strong>User ID:</strong> <?php echo $_SESSION['user_id']; ?></p>
            <p><strong>User Name:</strong> <?php echo $_SESSION['user_name']; ?></p>
            <p><strong>User Role:</strong> <?php echo $_SESSION['user_role']; ?></p>
            <p><strong>Current Time:</strong> <?php echo date('Y-m-d H:i:s'); ?></p>
        </div>
    </div>
</body>
</html>
