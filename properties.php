<?php
$pageTitle = "Properties";
$pageDescription = "Browse our extensive collection of properties in Kenya. Find your dream home with Cool Homes.";

// Get properties from database
$pdo = getDBConnection();
$properties = [];

try {
    $stmt = $pdo->prepare("
        SELECT p.*, u.name as agent_name, pi.image_url 
        FROM properties p 
        LEFT JOIN users u ON p.agent_id = u.id 
        LEFT JOIN property_images pi ON p.id = pi.property_id AND pi.is_primary = 1
        WHERE p.status = 'available'
        ORDER BY p.created_at DESC
    ");
    $stmt->execute();
    $properties = $stmt->fetchAll(PDO::FETCH_ASSOC);
} catch(PDOException $e) {
    // Fallback to sample data if database fails
    $properties = [
        [
            'id' => 1,
            'title' => 'Four-bedroom homes with detached DSQ',
            'price' => 18500000,
            'location' => 'Kitengela',
            'type' => 'house',
            'bedrooms' => 4,
            'bathrooms' => 3,
            'area' => 2500,
            'image_url' => 'https://images.unsplash.com/photo-1564013799919-ab600027ffc6?w=800&h=600&fit=crop',
            'agent_name' => 'Norbert'
        ],
        [
            'id' => 2,
            'title' => 'Greenville Gardens',
            'price' => 16000000,
            'location' => 'General Mathenge, Westlands',
            'type' => 'house',
            'bedrooms' => 4,
            'bathrooms' => 4,
            'area' => 3000,
            'image_url' => 'https://images.unsplash.com/photo-1570129477492-45c003edd2be?w=800&h=600&fit=crop',
            'agent_name' => 'Norbert'
        ],
        [
            'id' => 3,
            'title' => 'Gaia Brookside by Wonder Properties',
            'price' => 25000000,
            'location' => 'Brookside, Westlands',
            'type' => 'apartment',
            'bedrooms' => 3,
            'bathrooms' => 2,
            'area' => 2000,
            'image_url' => 'https://images.unsplash.com/photo-1560448204-e02f11c3d0e2?w=800&h=600&fit=crop',
            'agent_name' => 'Norbert'
        ],
        [
            'id' => 4,
            'title' => 'Arcadia Cove Apartments',
            'price' => 18000000,
            'location' => 'Kizingo, Mombasa Island',
            'type' => 'apartment',
            'bedrooms' => 3,
            'bathrooms' => 2,
            'area' => 1800,
            'image_url' => 'https://images.unsplash.com/photo-1512917774080-9991f1c4c750?w=800&h=600&fit=crop',
            'agent_name' => 'Norbert'
        ]
    ];
}

// Handle search and filters
$search = isset($_GET['search']) ? $_GET['search'] : '';
$type = isset($_GET['type']) ? $_GET['type'] : '';
$minPrice = isset($_GET['min_price']) ? $_GET['min_price'] : '';
$maxPrice = isset($_GET['max_price']) ? $_GET['max_price'] : '';

// Filter properties based on search criteria
if ($search || $type || $minPrice || $maxPrice) {
    $filteredProperties = [];
    foreach ($properties as $property) {
        $matches = true;
        
        if ($search && stripos($property['title'], $search) === false && stripos($property['location'], $search) === false) {
            $matches = false;
        }
        
        if ($type && $property['type'] !== $type) {
            $matches = false;
        }
        
        if ($minPrice && $property['price'] < $minPrice) {
            $matches = false;
        }
        
        if ($maxPrice && $property['price'] > $maxPrice) {
            $matches = false;
        }
        
        if ($matches) {
            $filteredProperties[] = $property;
        }
    }
    $properties = $filteredProperties;
}

include 'includes/header.php';
?>

<style>
    /* Properties Page Specific Styles */
    .hero-section {
        background: linear-gradient(135deg, var(--primary-color) 0%, var(--secondary-color) 100%);
        color: white;
        padding: 4rem 0;
        text-align: center;
    }

    .search-section {
        background: white;
        padding: 2rem 0;
        box-shadow: 0 2px 20px rgba(0,0,0,0.1);
    }

    .search-form {
        background: var(--light-color);
        padding: 2rem;
        border-radius: 15px;
        box-shadow: 0 5px 20px rgba(0,0,0,0.1);
    }

    .property-card {
        background: white;
        border-radius: 15px;
        overflow: hidden;
        box-shadow: 0 5px 20px rgba(0,0,0,0.08);
        transition: all 0.3s ease;
        height: 100%;
    }

    .property-card:hover {
        transform: translateY(-5px);
        box-shadow: 0 15px 30px rgba(0,0,0,0.15);
    }

    .property-image {
        height: 250px;
        background-size: cover;
        background-position: center;
        position: relative;
    }

    .property-badge {
        position: absolute;
        top: 1rem;
        left: 1rem;
        background: var(--primary-color);
        color: white;
        padding: 0.5rem 1rem;
        border-radius: 25px;
        font-size: 0.8rem;
        font-weight: 600;
        text-transform: uppercase;
    }

    .property-content {
        padding: 1.5rem;
    }

    .property-price {
        font-size: 1.5rem;
        font-weight: 700;
        color: var(--primary-color);
        margin-bottom: 0.5rem;
    }

    .property-title {
        font-size: 1.1rem;
        font-weight: 600;
        color: var(--dark-color);
        margin-bottom: 0.5rem;
    }

    .property-location {
        color: #6b7280;
        margin-bottom: 1rem;
    }

    .property-features {
        display: flex;
        gap: 1rem;
        margin-bottom: 1rem;
    }

    .feature {
        display: flex;
        align-items: center;
        gap: 0.5rem;
        color: #6b7280;
        font-size: 0.9rem;
    }

    .btn-view {
        background: var(--primary-color);
        color: white;
        border: none;
        padding: 0.75rem 1.5rem;
        border-radius: 25px;
        font-weight: 600;
        transition: all 0.3s ease;
        text-decoration: none;
        display: inline-block;
        width: 100%;
        text-align: center;
    }

    .btn-view:hover {
        background: var(--secondary-color);
        color: white;
        transform: translateY(-2px);
    }

    .filter-section {
        background: var(--light-color);
        padding: 2rem;
        border-radius: 15px;
        margin-bottom: 2rem;
    }

    .view-toggle {
        display: flex;
        gap: 0.5rem;
        margin-bottom: 2rem;
    }

    .view-btn {
        padding: 0.5rem 1rem;
        border: 2px solid var(--primary-color);
        background: transparent;
        color: var(--primary-color);
        border-radius: 25px;
        transition: all 0.3s ease;
    }

    .view-btn.active {
        background: var(--primary-color);
        color: white;
    }

    .grid-view .property-card {
        margin-bottom: 2rem;
    }

    .list-view .property-card {
        display: flex;
        margin-bottom: 1rem;
    }

    .list-view .property-image {
        width: 300px;
        height: 200px;
        flex-shrink: 0;
    }

    .list-view .property-content {
        flex: 1;
        display: flex;
        flex-direction: column;
        justify-content: space-between;
    }
</style>

<!-- Hero Section -->
<section class="hero-section">
    <div class="container">
        <h1 class="display-4 fw-bold mb-3">Find Your Dream Property</h1>
        <p class="lead">Discover the perfect home in Kenya's most desirable locations</p>
    </div>
</section>

<!-- Search Section -->
<section class="search-section">
    <div class="container">
        <div class="search-form">
            <form method="GET" action="properties.php">
                <div class="row g-3">
                    <div class="col-md-4">
                        <label class="form-label">Search</label>
                        <input type="text" class="form-control" name="search" placeholder="Enter location or property name" value="<?php echo htmlspecialchars($search); ?>">
                    </div>
                    <div class="col-md-2">
                        <label class="form-label">Type</label>
                        <select class="form-control" name="type">
                            <option value="">All Types</option>
                            <option value="house" <?php echo $type === 'house' ? 'selected' : ''; ?>>House</option>
                            <option value="apartment" <?php echo $type === 'apartment' ? 'selected' : ''; ?>>Apartment</option>
                            <option value="villa" <?php echo $type === 'villa' ? 'selected' : ''; ?>>Villa</option>
                            <option value="commercial" <?php echo $type === 'commercial' ? 'selected' : ''; ?>>Commercial</option>
                        </select>
                    </div>
                    <div class="col-md-2">
                        <label class="form-label">Min Price</label>
                        <select class="form-control" name="min_price">
                            <option value="">Any</option>
                            <option value="1000000" <?php echo $minPrice === '1000000' ? 'selected' : ''; ?>>KSh 1M+</option>
                            <option value="5000000" <?php echo $minPrice === '5000000' ? 'selected' : ''; ?>>KSh 5M+</option>
                            <option value="10000000" <?php echo $minPrice === '10000000' ? 'selected' : ''; ?>>KSh 10M+</option>
                            <option value="20000000" <?php echo $minPrice === '20000000' ? 'selected' : ''; ?>>KSh 20M+</option>
                        </select>
                    </div>
                    <div class="col-md-2">
                        <label class="form-label">Max Price</label>
                        <select class="form-control" name="max_price">
                            <option value="">Any</option>
                            <option value="5000000" <?php echo $maxPrice === '5000000' ? 'selected' : ''; ?>>KSh 5M</option>
                            <option value="10000000" <?php echo $maxPrice === '10000000' ? 'selected' : ''; ?>>KSh 10M</option>
                            <option value="20000000" <?php echo $maxPrice === '20000000' ? 'selected' : ''; ?>>KSh 20M</option>
                            <option value="50000000" <?php echo $maxPrice === '50000000' ? 'selected' : ''; ?>>KSh 50M</option>
                        </select>
                    </div>
                    <div class="col-md-2">
                        <label class="form-label">&nbsp;</label>
                        <button type="submit" class="btn btn-primary w-100">
                            <i class="fas fa-search"></i> Search
                        </button>
                    </div>
                </div>
            </form>
        </div>
    </div>
</section>

<!-- Properties Section -->
<section class="py-5">
    <div class="container">
        <div class="d-flex justify-content-between align-items-center mb-4">
            <h2 class="h3">Properties (<?php echo count($properties); ?>)</h2>
            <div class="view-toggle">
                <button class="view-btn active" onclick="toggleView('grid')">
                    <i class="fas fa-th"></i> Grid
                </button>
                <button class="view-btn" onclick="toggleView('list')">
                    <i class="fas fa-list"></i> List
                </button>
            </div>
        </div>

        <div id="properties-container" class="grid-view">
            <div class="row">
                <?php foreach ($properties as $property): ?>
                <div class="col-lg-4 col-md-6 mb-4">
                    <div class="property-card">
                        <div class="property-image" style="background-image: url('<?php echo $property['image_url']; ?>')">
                            <div class="property-badge"><?php echo ucfirst($property['type']); ?></div>
                        </div>
                        <div class="property-content">
                            <div class="property-price">KSh <?php echo number_format($property['price']); ?></div>
                            <h5 class="property-title"><?php echo htmlspecialchars($property['title']); ?></h5>
                            <p class="property-location">
                                <i class="fas fa-map-marker-alt"></i> <?php echo htmlspecialchars($property['location']); ?>
                            </p>
                            <div class="property-features">
                                <?php if ($property['bedrooms'] > 0): ?>
                                <div class="feature">
                                    <i class="fas fa-bed"></i> <?php echo $property['bedrooms']; ?> Beds
                                </div>
                                <?php endif; ?>
                                <div class="feature">
                                    <i class="fas fa-bath"></i> <?php echo $property['bathrooms']; ?> Baths
                                </div>
                                <div class="feature">
                                    <i class="fas fa-ruler-combined"></i> <?php echo $property['area']; ?> sq ft
                                </div>
                            </div>
                            <a href="property-details.php?id=<?php echo $property['id']; ?>" class="btn-view">
                                <i class="fas fa-eye"></i> View Details
                            </a>
                        </div>
                    </div>
                </div>
                <?php endforeach; ?>
            </div>
        </div>

        <?php if (empty($properties)): ?>
        <div class="text-center py-5">
            <i class="fas fa-search fa-3x text-muted mb-3"></i>
            <h4>No Properties Found</h4>
            <p class="text-muted">Try adjusting your search criteria</p>
        </div>
        <?php endif; ?>
    </div>
</section>

<script>
function toggleView(view) {
    const container = document.getElementById('properties-container');
    const buttons = document.querySelectorAll('.view-btn');
    
    buttons.forEach(btn => btn.classList.remove('active'));
    event.target.classList.add('active');
    
    if (view === 'grid') {
        container.className = 'grid-view';
    } else {
        container.className = 'list-view';
    }
}
</script>

<?php include 'includes/footer.php'; ?>