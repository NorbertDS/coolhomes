<?php
// Get property ID from URL
$propertyId = isset($_GET['id']) ? (int)$_GET['id'] : 1;

// Get property details from database
$pdo = getDBConnection();
$property = null;
$images = [];

try {
    // Get property details
    $stmt = $pdo->prepare("
        SELECT p.*, u.name as agent_name, u.email as agent_email, u.phone as agent_phone
        FROM properties p 
        LEFT JOIN users u ON p.agent_id = u.id 
        WHERE p.id = ?
    ");
    $stmt->execute([$propertyId]);
    $property = $stmt->fetch(PDO::FETCH_ASSOC);
    
    // Get property images
    $stmt = $pdo->prepare("SELECT * FROM property_images WHERE property_id = ? ORDER BY is_primary DESC");
    $stmt->execute([$propertyId]);
    $images = $stmt->fetchAll(PDO::FETCH_ASSOC);
} catch(PDOException $e) {
    // Fallback to sample data
    $property = [
        'id' => $propertyId,
        'title' => 'Luxury Villa in Karen',
        'description' => 'This stunning villa offers the perfect blend of modern luxury and classic elegance. Located in the prestigious Karen area, this property features spacious rooms, a beautiful garden, and all modern amenities.',
        'price' => 45000000,
        'location' => 'Karen, Nairobi',
        'type' => 'villa',
        'bedrooms' => 5,
        'bathrooms' => 4,
        'area' => 800,
        'features' => 'Swimming Pool, Garden, Security, Parking, Modern Kitchen',
        'agent_name' => 'Norbert',
        'agent_email' => 'norbert@coolhomes.co.ke',
        'agent_phone' => '+254 701 274 458'
    ];
    
    $images = [
        ['image_url' => '26-Mzizi-Court.webp', 'is_primary' => 1],
        ['image_url' => 'Loft-Residences.webp', 'is_primary' => 0],
        ['image_url' => 'Riverbank.webp', 'is_primary' => 0]
    ];
}

if (!$property) {
    header('Location: properties.php');
    exit;
}

$pageTitle = $property['title'];
$pageDescription = $property['description'];

// Handle inquiry submission
if ($_POST && isset($_POST['inquiry'])) {
    $name = $_POST['name'];
    $email = $_POST['email'];
    $phone = $_POST['phone'];
    $message = $_POST['message'];
    
    try {
        $stmt = $pdo->prepare("INSERT INTO inquiries (property_id, name, email, phone, message) VALUES (?, ?, ?, ?, ?)");
        $stmt->execute([$propertyId, $name, $email, $phone, $message]);
        $inquirySuccess = true;
    } catch(PDOException $e) {
        $inquiryError = "Failed to send inquiry. Please try again.";
    }
}

// Handle appointment booking
if ($_POST && isset($_POST['appointment'])) {
    $name = $_POST['appointment_name'];
    $email = $_POST['appointment_email'];
    $phone = $_POST['appointment_phone'];
    $date = $_POST['appointment_date'];
    $time = $_POST['appointment_time'];
    $notes = $_POST['appointment_notes'];
    
    try {
        $stmt = $pdo->prepare("INSERT INTO appointments (property_id, client_name, client_email, client_phone, appointment_date, appointment_time, notes) VALUES (?, ?, ?, ?, ?, ?, ?)");
        $stmt->execute([$propertyId, $name, $email, $phone, $date, $time, $notes]);
        $appointmentSuccess = true;
    } catch(PDOException $e) {
        $appointmentError = "Failed to book appointment. Please try again.";
    }
}

include 'includes/header.php';
?>

    <style>
    .property-hero {
        background: linear-gradient(135deg, var(--primary-color) 0%, var(--secondary-color) 100%);
        color: white;
        padding: 2rem 0;
    }

    .property-gallery {
        position: relative;
        height: 400px;
        border-radius: 15px;
        overflow: hidden;
        margin-bottom: 2rem;
    }

    .main-image {
        width: 100%;
        height: 100%;
        object-fit: cover;
    }

    .gallery-thumbnails {
        display: flex;
        gap: 0.5rem;
        margin-top: 1rem;
    }

    .thumbnail {
        width: 80px;
        height: 60px;
        object-fit: cover;
        border-radius: 8px;
        cursor: pointer;
        opacity: 0.7;
        transition: opacity 0.3s ease;
    }

    .thumbnail:hover,
    .thumbnail.active {
        opacity: 1;
    }

    .property-info {
        background: white;
        padding: 2rem;
        border-radius: 15px;
        box-shadow: 0 5px 20px rgba(0,0,0,0.1);
        margin-bottom: 2rem;
    }

    .property-price {
        font-size: 2.5rem;
        font-weight: 700;
        color: var(--primary-color);
        margin-bottom: 1rem;
    }

    .property-features {
        display: grid;
        grid-template-columns: repeat(auto-fit, minmax(200px, 1fr));
        gap: 1rem;
        margin: 2rem 0;
    }

    .feature-item {
        display: flex;
        align-items: center;
        gap: 0.5rem;
        padding: 1rem;
        background: var(--light-color);
        border-radius: 10px;
    }

    .contact-form {
        background: var(--light-color);
        padding: 2rem;
        border-radius: 15px;
        margin-top: 2rem;
    }

    .form-group {
        margin-bottom: 1rem;
    }

    .form-label {
        font-weight: 600;
        color: var(--dark-color);
        margin-bottom: 0.5rem;
    }

    .form-control {
        border: 2px solid #e5e7eb;
        border-radius: 10px;
        padding: 0.75rem;
            transition: border-color 0.3s ease;
        }

    .form-control:focus {
            border-color: var(--primary-color);
        box-shadow: 0 0 0 0.2rem rgba(37, 99, 235, 0.25);
    }

    .btn-submit {
        background: var(--primary-color);
        color: white;
        border: none;
        padding: 0.75rem 2rem;
        border-radius: 25px;
        font-weight: 600;
        transition: all 0.3s ease;
        width: 100%;
    }

    .btn-submit:hover {
        background: var(--secondary-color);
            transform: translateY(-2px);
        }

    .alert {
        border-radius: 10px;
        margin-bottom: 1rem;
        }
    </style>

<!-- Property Hero -->
<section class="property-hero">
            <div class="container">
        <nav aria-label="breadcrumb">
            <ol class="breadcrumb">
                <li class="breadcrumb-item"><a href="index.html" class="text-white">Home</a></li>
                <li class="breadcrumb-item"><a href="properties.php" class="text-white">Properties</a></li>
                <li class="breadcrumb-item active text-white"><?php echo htmlspecialchars($property['title']); ?></li>
            </ol>
        </nav>
    </div>
</section>

<!-- Property Details -->
<section class="py-5">
    <div class="container">
        <div class="row">
            <div class="col-lg-8">
                <!-- Property Gallery -->
                <div class="property-gallery">
                    <img src="<?php echo $images[0]['image_url']; ?>" alt="<?php echo htmlspecialchars($property['title']); ?>" class="main-image" id="mainImage">
                    </div>
                    
                <?php if (count($images) > 1): ?>
                <div class="gallery-thumbnails">
                    <?php foreach ($images as $index => $image): ?>
                    <img src="<?php echo $image['image_url']; ?>" alt="Property Image" class="thumbnail <?php echo $index === 0 ? 'active' : ''; ?>" onclick="changeImage('<?php echo $image['image_url']; ?>', this)">
                    <?php endforeach; ?>
                        </div>
                <?php endif; ?>

                <!-- Property Information -->
                <div class="property-info">
                    <h1 class="h2 mb-3"><?php echo htmlspecialchars($property['title']); ?></h1>
                    <p class="text-muted mb-4">
                        <i class="fas fa-map-marker-alt"></i> <?php echo htmlspecialchars($property['location']); ?>
                    </p>
                    
                    <div class="property-features">
                        <?php if ($property['bedrooms'] > 0): ?>
                        <div class="feature-item">
                            <i class="fas fa-bed text-primary"></i>
                            <div>
                                <strong><?php echo $property['bedrooms']; ?></strong>
                                <div class="text-muted">Bedrooms</div>
                            </div>
                        </div>
                        <?php endif; ?>
                        
                        <div class="feature-item">
                            <i class="fas fa-bath text-primary"></i>
                            <div>
                                <strong><?php echo $property['bathrooms']; ?></strong>
                                <div class="text-muted">Bathrooms</div>
                            </div>
                        </div>
                        
                        <div class="feature-item">
                            <i class="fas fa-ruler-combined text-primary"></i>
                            <div>
                                <strong><?php echo $property['area']; ?> sq ft</strong>
                                <div class="text-muted">Area</div>
                            </div>
                        </div>
                        
                        <div class="feature-item">
                            <i class="fas fa-home text-primary"></i>
                            <div>
                                <strong><?php echo ucfirst($property['type']); ?></strong>
                                <div class="text-muted">Type</div>
                            </div>
                        </div>
                    </div>

                    <h4 class="mt-4 mb-3">Description</h4>
                    <p><?php echo nl2br(htmlspecialchars($property['description'])); ?></p>
                    
                    <?php if ($property['features']): ?>
                    <h4 class="mt-4 mb-3">Features</h4>
                    <ul class="list-unstyled">
                        <?php foreach (explode(',', $property['features']) as $feature): ?>
                        <li class="mb-2"><i class="fas fa-check text-success me-2"></i><?php echo trim($feature); ?></li>
                        <?php endforeach; ?>
                    </ul>
                    <?php endif; ?>
                        </div>
                    </div>

            <div class="col-lg-4">
                <!-- Property Price -->
                <div class="property-info">
                    <div class="property-price">KSh <?php echo number_format($property['price']); ?></div>
                    <p class="text-muted mb-4">Contact our agent for more information</p>
                    
                        <div class="d-grid gap-2">
                        <a href="tel:<?php echo $property['agent_phone']; ?>" class="btn btn-primary">
                            <i class="fas fa-phone"></i> Call Agent
                        </a>
                        <a href="mailto:<?php echo $property['agent_email']; ?>" class="btn btn-outline-primary">
                            <i class="fas fa-envelope"></i> Email Agent
                        </a>
                    </div>
                </div>

                <!-- Agent Information -->
                <div class="property-info">
                    <h5 class="mb-3">Property Agent</h5>
                            <div class="d-flex align-items-center mb-3">
                        <div class="agent-avatar bg-primary text-white rounded-circle d-flex align-items-center justify-content-center me-3" style="width: 50px; height: 50px;">
                            <?php echo strtoupper(substr($property['agent_name'], 0, 1)); ?>
                                </div>
                                <div>
                            <h6 class="mb-0"><?php echo htmlspecialchars($property['agent_name']); ?></h6>
                                    <small class="text-muted">Real Estate Agent</small>
                                </div>
                            </div>
                    <p class="text-muted">
                        <i class="fas fa-phone me-2"></i><?php echo $property['agent_phone']; ?><br>
                        <i class="fas fa-envelope me-2"></i><?php echo $property['agent_email']; ?>
                            </p>
                        </div>
                
                <!-- Inquiry Form -->
                <div class="contact-form">
                    <h5 class="mb-3">Send Inquiry</h5>
                    
                    <?php if (isset($inquirySuccess)): ?>
                    <div class="alert alert-success">
                        <i class="fas fa-check-circle"></i> Your inquiry has been sent successfully!
                    </div>
                    <?php endif; ?>
                    
                    <?php if (isset($inquiryError)): ?>
                    <div class="alert alert-danger">
                        <i class="fas fa-exclamation-circle"></i> <?php echo $inquiryError; ?>
                </div>
                    <?php endif; ?>
                    
                    <form method="POST">
                        <input type="hidden" name="inquiry" value="1">
                        <div class="form-group">
                            <label class="form-label">Name</label>
                            <input type="text" class="form-control" name="name" required>
                            </div>
                        <div class="form-group">
                            <label class="form-label">Email</label>
                            <input type="email" class="form-control" name="email" required>
                            </div>
                        <div class="form-group">
                            <label class="form-label">Phone</label>
                            <input type="tel" class="form-control" name="phone">
                            </div>
                        <div class="form-group">
                            <label class="form-label">Message</label>
                            <textarea class="form-control" name="message" rows="4" required></textarea>
                            </div>
                        <button type="submit" class="btn-submit">
                            <i class="fas fa-paper-plane"></i> Send Inquiry
                        </button>
                    </form>
        </div>

                <!-- Appointment Booking -->
                <div class="contact-form">
                    <h5 class="mb-3">Book Viewing</h5>
                    
                    <?php if (isset($appointmentSuccess)): ?>
                    <div class="alert alert-success">
                        <i class="fas fa-check-circle"></i> Your appointment has been booked successfully!
            </div>
                    <?php endif; ?>
                    
                    <?php if (isset($appointmentError)): ?>
                    <div class="alert alert-danger">
                        <i class="fas fa-exclamation-circle"></i> <?php echo $appointmentError; ?>
        </div>
                    <?php endif; ?>
                    
                    <form method="POST">
                        <input type="hidden" name="appointment" value="1">
                        <div class="form-group">
                            <label class="form-label">Name</label>
                            <input type="text" class="form-control" name="appointment_name" required>
                </div>
                        <div class="form-group">
                            <label class="form-label">Email</label>
                            <input type="email" class="form-control" name="appointment_email" required>
                        </div>
                        <div class="form-group">
                            <label class="form-label">Phone</label>
                            <input type="tel" class="form-control" name="appointment_phone" required>
                        </div>
                        <div class="row">
                            <div class="col-6">
                                <div class="form-group">
                                    <label class="form-label">Date</label>
                                    <input type="date" class="form-control" name="appointment_date" required>
                        </div>
                    </div>
                            <div class="col-6">
                                <div class="form-group">
                                    <label class="form-label">Time</label>
                                    <select class="form-control" name="appointment_time" required>
                                        <option value="">Select Time</option>
                                        <option value="09:00">9:00 AM</option>
                                        <option value="10:00">10:00 AM</option>
                                        <option value="11:00">11:00 AM</option>
                                        <option value="14:00">2:00 PM</option>
                                        <option value="15:00">3:00 PM</option>
                                        <option value="16:00">4:00 PM</option>
                                    </select>
            </div>
        </div>
    </div>
                        <div class="form-group">
                            <label class="form-label">Notes (Optional)</label>
                            <textarea class="form-control" name="appointment_notes" rows="3"></textarea>
                </div>
                        <button type="submit" class="btn-submit">
                            <i class="fas fa-calendar"></i> Book Appointment
                        </button>
                </form>
            </div>
        </div>
    </div>
    </div>
</section>

    <script>
function changeImage(imageSrc, thumbnail) {
    document.getElementById('mainImage').src = imageSrc;
                    
                    // Update active thumbnail
    document.querySelectorAll('.thumbnail').forEach(t => t.classList.remove('active'));
    thumbnail.classList.add('active');
                }
    </script>

<?php include 'includes/footer.php'; ?>