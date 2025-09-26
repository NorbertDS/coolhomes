<?php
session_start();

// Check if user is logged in and is admin
if (!isset($_SESSION['user_id']) || $_SESSION['user_role'] !== 'admin') {
    header('Location: login.php');
    exit;
}

$pageTitle = "Import Kenyan Properties";
$pageDescription = "Import real Kenyan property data from BuyRentKenya.";

require_once 'config/database.php';

$pdo = getDBConnection();
$message = '';
$successCount = 0;
$errorCount = 0;

if ($_POST && isset($_POST['import'])) {
    try {
        // Clear existing properties (optional)
        if (isset($_POST['clear_existing'])) {
            $pdo->exec("DELETE FROM properties");
            $message .= "Existing properties cleared.<br>";
        }
        
        // Insert real Kenyan properties
        $properties = [
            [
                'title' => 'Four-bedroom homes with detached DSQ',
                'description' => 'This superb development consists of 78 four-bedroom homes with detached DSQ (en-suite). Located in the growing Kitengela area, these homes offer modern living with excellent amenities.',
                'price' => 18500000,
                'location' => 'Kitengela',
                'type' => 'house',
                'bedrooms' => 4,
                'bathrooms' => 3,
                'area' => 2500,
                'features' => 'Detached DSQ, Modern Design, Gated Community, 24/7 Security, Swimming Pool, Children Play Area, Landscaped Gardens'
            ],
            [
                'title' => 'Alkira Apartments',
                'description' => 'Discover these 3 bedroom exclusive upscale development in the heart of Lavington. Premium location with modern amenities and excellent connectivity.',
                'price' => 150000,
                'location' => 'Lavington',
                'type' => 'apartment',
                'bedrooms' => 3,
                'bathrooms' => 2,
                'area' => 1800,
                'features' => 'Upscale Development, Premium Location, Modern Amenities, 24/7 Security, Swimming Pool, Gym, Parking'
            ],
            [
                'title' => 'Greenville Gardens',
                'description' => 'Greenville Gardens is located along the exclusive General Mathenge Road in Westlands. This development offers luxury living with world-class amenities.',
                'price' => 16000000,
                'location' => 'General Mathenge, Westlands',
                'type' => 'house',
                'bedrooms' => 4,
                'bathrooms' => 4,
                'area' => 3000,
                'features' => 'Luxury Living, World-class Amenities, Gated Community, Swimming Pool, Gym, Landscaped Gardens, 24/7 Security'
            ],
            [
                'title' => 'Gaia Brookside by Wonder Properties',
                'description' => 'Discover Luxury Living at Gaia Brookside! Nestled in the prestigious Brookside area of Westlands, this development offers 228 units of modern living.',
                'price' => 25000000,
                'location' => 'Brookside, Westlands',
                'type' => 'apartment',
                'bedrooms' => 3,
                'bathrooms' => 2,
                'area' => 2000,
                'features' => 'Luxury Living, Modern Design, Swimming Pool, Gym, 24/7 Security, Landscaped Gardens, Children Play Area'
            ],
            [
                'title' => 'Diplomat Residencies',
                'description' => 'Discover Diplomat Residencies - An exclusive development of 125 units located on Peponi Road, Westlands. Premium location with excellent amenities.',
                'price' => 5000000,
                'location' => 'Peponi Road, Westlands',
                'type' => 'apartment',
                'bedrooms' => 2,
                'bathrooms' => 2,
                'area' => 1200,
                'features' => 'Exclusive Development, Premium Location, Modern Amenities, Swimming Pool, Gym, 24/7 Security'
            ],
            [
                'title' => 'Arcadia Cove Apartments',
                'description' => 'Welcome to Arcadia Cove Apartments, A family-friendly development located in Kizingo, Mombasa Island. This development offers 52 units with modern amenities.',
                'price' => 18000000,
                'location' => 'Kizingo, Mombasa Island',
                'type' => 'apartment',
                'bedrooms' => 3,
                'bathrooms' => 2,
                'area' => 1800,
                'features' => 'Family-friendly Development, Modern Amenities, Swimming Pool, Gym, 24/7 Security, Sea View'
            ],
            [
                'title' => '143 Brookview - Membley',
                'description' => 'Welcome to 143 Brookview - an ultra-modern, exclusive development in Membley, Ruiru. This development offers 120 units with contemporary design.',
                'price' => 33000000,
                'location' => 'Membley, Ruiru',
                'type' => 'apartment',
                'bedrooms' => 3,
                'bathrooms' => 2,
                'area' => 2000,
                'features' => 'Ultra-modern Design, Exclusive Development, Swimming Pool, Gym, 24/7 Security, Landscaped Gardens'
            ],
            [
                'title' => 'HERENCIA: PREMIUM GATED COMMUNITY',
                'description' => 'HERENCIA: PREMIUM GATED COMMUNITY strategically located at Bob Harris Road, Exit 16 off Thika Superhighway. This massive development offers 1000 units.',
                'price' => 4200000,
                'location' => 'Bob Harris Road, Thika Road',
                'type' => 'house',
                'bedrooms' => 3,
                'bathrooms' => 2,
                'area' => 1800,
                'features' => 'Premium Gated Community, Strategic Location, Swimming Pool, Gym, 24/7 Security, Landscaped Gardens, Children Play Area'
            ],
            [
                'title' => 'Atreus Brookside',
                'description' => 'Welcome to ATREUS BROOKSIDE, the epitome of modern living in Brookside Grove, Westlands. This development offers 198 units with contemporary design.',
                'price' => 7900000,
                'location' => 'Brookside Grove, Westlands',
                'type' => 'apartment',
                'bedrooms' => 2,
                'bathrooms' => 2,
                'area' => 1500,
                'features' => 'Modern Living, Contemporary Design, Swimming Pool, Gym, 24/7 Security, Landscaped Gardens'
            ],
            [
                'title' => '237 GARDEN CITY',
                'description' => '237 by Mi Vida has been designed to provide a unique living experience in Garden City, Thika Road. This development offers 237 units with modern amenities.',
                'price' => 2900000,
                'location' => 'Garden City, Thika Road',
                'type' => 'apartment',
                'bedrooms' => 2,
                'bathrooms' => 2,
                'area' => 1200,
                'features' => 'Unique Living Experience, Modern Amenities, Swimming Pool, Gym, 24/7 Security, Landscaped Gardens'
            ]
        ];
        
        foreach ($properties as $property) {
            $stmt = $pdo->prepare("
                INSERT INTO properties (title, description, price, location, type, bedrooms, bathrooms, area, status, features, created_at) 
                VALUES (?, ?, ?, ?, ?, ?, ?, ?, 'available', ?, NOW())
            ");
            
            $stmt->execute([
                $property['title'],
                $property['description'],
                $property['price'],
                $property['location'],
                $property['type'],
                $property['bedrooms'],
                $property['bathrooms'],
                $property['area'],
                $property['features']
            ]);
            
            $successCount++;
        }
        
        $message .= "Successfully imported $successCount properties from BuyRentKenya data!<br>";
        
    } catch (PDOException $e) {
        $message .= "Error: " . $e->getMessage() . "<br>";
    }
}

// Get current property count
$stmt = $pdo->query("SELECT COUNT(*) as count FROM properties");
$currentCount = $stmt->fetch(PDO::FETCH_ASSOC)['count'];
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title><?php echo $pageTitle; ?> - Cool Homes</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">
    <link href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0/css/all.min.css" rel="stylesheet">
    <link href="https://fonts.googleapis.com/css2?family=Inter:wght@300;400;500;600;700&display=swap" rel="stylesheet">
    <link rel="stylesheet" href="css/main.css">
    <link rel="stylesheet" href="css/header.css">
    <link rel="stylesheet" href="css/footer.css">
</head>
<body>
    <?php include 'includes/header.php'; ?>
    
    <div class="container mt-5">
        <div class="row">
            <div class="col-md-8 mx-auto">
                <div class="card">
                    <div class="card-header">
                        <h3><i class="fas fa-database"></i> Import Kenyan Properties</h3>
                    </div>
                    <div class="card-body">
                        <?php if ($message): ?>
                            <div class="alert alert-info">
                                <?php echo $message; ?>
                            </div>
                        <?php endif; ?>
                        
                        <div class="mb-4">
                            <h5>Current Database Status</h5>
                            <p><strong>Total Properties:</strong> <?php echo $currentCount; ?></p>
                        </div>
                        
                        <div class="mb-4">
                            <h5>Real Kenyan Property Data</h5>
                            <p>This will import real property data from <a href="https://www.buyrentkenya.com/projects" target="_blank">BuyRentKenya</a> including:</p>
                            <ul>
                                <li>Four-bedroom homes in Kitengela - KSh 18,500,000</li>
                                <li>Alkira Apartments in Lavington - KSh 150,000</li>
                                <li>Greenville Gardens in Westlands - KSh 16,000,000</li>
                                <li>Gaia Brookside in Westlands - KSh 25,000,000</li>
                                <li>Diplomat Residencies in Westlands - KSh 5,000,000</li>
                                <li>Arcadia Cove Apartments in Mombasa - KSh 18,000,000</li>
                                <li>143 Brookview in Ruiru - KSh 33,000,000</li>
                                <li>HERENCIA in Thika Road - KSh 4,200,000</li>
                                <li>Atreus Brookside in Westlands - KSh 7,900,000</li>
                                <li>237 Garden City in Thika Road - KSh 2,900,000</li>
                            </ul>
                        </div>
                        
                        <form method="POST">
                            <div class="mb-3">
                                <div class="form-check">
                                    <input class="form-check-input" type="checkbox" name="clear_existing" id="clear_existing">
                                    <label class="form-check-label" for="clear_existing">
                                        Clear existing properties before import
                                    </label>
                                </div>
                            </div>
                            
                            <button type="submit" name="import" class="btn btn-primary">
                                <i class="fas fa-download"></i> Import Kenyan Properties
                            </button>
                            
                            <a href="dashboard.php" class="btn btn-secondary">
                                <i class="fas fa-arrow-left"></i> Back to Dashboard
                            </a>
                        </form>
                    </div>
                </div>
            </div>
        </div>
    </div>
    
    <?php include 'includes/footer.php'; ?>
    
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/js/bootstrap.bundle.min.js"></script>
</body>
</html>
