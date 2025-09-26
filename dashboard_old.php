<?php
session_start();

// Check if user is logged in and is admin
if (!isset($_SESSION['user_id']) || $_SESSION['user_role'] !== 'admin') {
    header('Location: login.php');
    exit;
}

$pageTitle = "Admin Dashboard";
$pageDescription = "Manage your Cool Homes platform - properties, users, inquiries, and more.";
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Admin Dashboard - Cool Homes</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">
    <link href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0/css/all.min.css" rel="stylesheet">
    <link href="https://fonts.googleapis.com/css2?family=Inter:wght@300;400;500;600;700&display=swap" rel="stylesheet">
    <link rel="stylesheet" href="css/main.css">
    <link rel="stylesheet" href="css/header.css">
    <link rel="stylesheet" href="css/footer.css">
    <link rel="stylesheet" href="css/dashboard.css">
</head>
<body>
    <div class="dashboard-container">
        <!-- Sidebar -->
        <nav class="sidebar">
            <div class="sidebar-header">
                <h3>Cool Homes</h3>
                <p>Admin Dashboard</p>
            </div>
            <div class="sidebar-menu">
                <a href="#dashboard" class="menu-item active" onclick="showSection('dashboard')">
                    <i class="fas fa-tachometer-alt"></i> Dashboard
                </a>
                <a href="#properties" class="menu-item" onclick="showSection('properties')">
                    <i class="fas fa-building"></i> Properties
                </a>
                <a href="#users" class="menu-item" onclick="showSection('users')">
                    <i class="fas fa-users"></i> Users
                </a>
                <a href="#inquiries" class="menu-item" onclick="showSection('inquiries')">
                    <i class="fas fa-envelope"></i> Inquiries
                </a>
                <a href="#appointments" class="menu-item" onclick="showSection('appointments')">
                    <i class="fas fa-calendar"></i> Appointments
                </a>
                <a href="#blog" class="menu-item" onclick="showSection('blog')">
                    <i class="fas fa-blog"></i> Blog
                </a>
                <a href="admin-import-properties.php" class="menu-item" target="_blank">
                    <i class="fas fa-download"></i> Import Properties
                </a>
                <a href="home" class="menu-item">
                    <i class="fas fa-external-link-alt"></i> View Website
                </a>
                <a href="#" class="menu-item" onclick="logout()">
                    <i class="fas fa-sign-out-alt"></i> Logout
                </a>
            </div>
        </nav>

        <!-- Main Content -->
        <main class="main-content">
            <!-- Dashboard Section -->
            <div id="dashboard-section" class="active-section">
                <div class="content-header">
                    <div class="alert alert-warning">
                        <strong>TEST MESSAGE:</strong> If you can see this, the dashboard is updated! Look for the red IMPORT button above.
                    </div>
                    <div class="d-flex justify-content-between align-items-center">
                        <div>
                            <h1>Welcome, <?php echo $_SESSION['user_name']; ?>!</h1>
                            <p>Cool Homes Founder</p>
                        </div>
                        <div>
                            <a href="admin-import-properties.php" class="btn btn-primary btn-lg" style="background-color: #ff0000 !important; border-color: #ff0000 !important;">
                                <i class="fas fa-download"></i> IMPORT PROPERTIES - CLICK HERE
                            </a>
                        </div>
                    </div>
                </div>
                <div class="content-section">
                    <h3>Dashboard Overview</h3>
                    <div class="stats-grid">
                        <div class="stat-card">
                            <div class="stat-number">125</div>
                            <div class="stat-label">Total Properties</div>
                        </div>
                        <div class="stat-card success">
                            <div class="stat-number">87</div>
                            <div class="stat-label">Active Listings</div>
                        </div>
                        <div class="stat-card warning">
                            <div class="stat-number">12</div>
                            <div class="stat-label">Pending Inquiries</div>
                        </div>
                        <div class="stat-card danger">
                            <div class="stat-number">5</div>
                            <div class="stat-label">New Appointments</div>
                        </div>
                    </div>
                    
                    <div class="row mt-4">
                        <div class="col-md-6">
                            <div class="card">
                                <div class="card-header">
                                    <h5>Quick Actions</h5>
                                </div>
                                <div class="card-body">
                                    <a href="admin-import-properties.php" class="btn btn-primary mb-2 w-100">
                                        <i class="fas fa-download"></i> Import Kenyan Properties
                                    </a>
                                    <a href="#properties" class="btn btn-outline-primary mb-2 w-100" onclick="showSection('properties')">
                                        <i class="fas fa-building"></i> Manage Properties
                                    </a>
                                    <a href="#users" class="btn btn-outline-success mb-2 w-100" onclick="showSection('users')">
                                        <i class="fas fa-users"></i> Manage Users
                                    </a>
                                </div>
                            </div>
                        </div>
                        <div class="col-md-6">
                            <div class="card">
                                <div class="card-header">
                                    <h5>Recent Activity</h5>
                                </div>
                                <div class="card-body">
                                    <div class="activity-item">
                                        <strong>New Property Added</strong> - Four-bedroom homes in Kitengela
                                        <small class="text-muted d-block">2 hours ago</small>
                                    </div>
                                    <div class="activity-item">
                                        <strong>User Registration</strong> - New agent joined
                                        <small class="text-muted d-block">1 day ago</small>
                                    </div>
                                    <div class="activity-item">
                                        <strong>Property Inquiry</strong> - Gaia Brookside property
                                        <small class="text-muted d-block">2 days ago</small>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>

            <!-- Properties Section -->
            <div id="properties-section" style="display: none;">
                <div class="content-section">
                    <div class="section-header">
                        <h3>Property Management</h3>
                        <button class="btn-primary" onclick="showAddPropertyModal()">
                            <i class="fas fa-plus"></i> Add New Property
                        </button>
                    </div>
                    <div class="table-responsive">
                        <table class="table" id="properties-table">
                            <thead>
                                <tr>
                                    <th>Title</th>
                                    <th>Location</th>
                                    <th>Price</th>
                                    <th>Type</th>
                                    <th>Status</th>
                                    <th>Actions</th>
                                </tr>
                            </thead>
                            <tbody>
                                <!-- Properties will be loaded here -->
                            </tbody>
                        </table>
                    </div>
                </div>
            </div>

            <!-- Users Section -->
            <div id="users-section" style="display: none;">
                <div class="content-section">
                    <div class="section-header">
                        <h3>User Management</h3>
                        <button class="btn-primary" onclick="showAddUserModal()">
                            <i class="fas fa-plus"></i> Add New User
                        </button>
                    </div>
                    <div class="table-responsive">
                        <table class="table" id="users-table">
                            <thead>
                                <tr>
                                    <th>Name</th>
                                    <th>Email</th>
                                    <th>Role</th>
                                    <th>Status</th>
                                    <th>Actions</th>
                                </tr>
                            </thead>
                            <tbody>
                                <!-- Users will be loaded here -->
                            </tbody>
                        </table>
                    </div>
                </div>
            </div>

            <!-- Inquiries Section -->
            <div id="inquiries-section" style="display: none;">
                <div class="content-section">
                    <div class="section-header">
                        <h3>Inquiry Management</h3>
                    </div>
                    <div class="table-responsive">
                        <table class="table" id="inquiries-table">
                            <thead>
                                <tr>
                                    <th>Name</th>
                                    <th>Email</th>
                                    <th>Property</th>
                                    <th>Status</th>
                                    <th>Date</th>
                                    <th>Actions</th>
                                </tr>
                            </thead>
                            <tbody>
                                <!-- Inquiries will be loaded here -->
                            </tbody>
                        </table>
                    </div>
                </div>
            </div>

            <!-- Appointments Section -->
            <div id="appointments-section" style="display: none;">
                <div class="content-section">
                    <div class="section-header">
                        <h3>Appointment Management</h3>
                    </div>
                    <div class="table-responsive">
                        <table class="table" id="appointments-table">
                            <thead>
                                <tr>
                                    <th>Client Name</th>
                                    <th>Property</th>
                                    <th>Date</th>
                                    <th>Time</th>
                                    <th>Status</th>
                                    <th>Actions</th>
                                </tr>
                            </thead>
                            <tbody>
                                <!-- Appointments will be loaded here -->
                            </tbody>
                        </table>
                    </div>
                </div>
            </div>

            <!-- Blog Section -->
            <div id="blog-section" style="display: none;">
                <div class="content-section">
                    <div class="section-header">
                        <h3>Blog Management</h3>
                        <button class="btn-primary" onclick="showAddBlogModal()">
                            <i class="fas fa-plus"></i> Add Blog Post
                        </button>
                    </div>
                    <div class="table-responsive">
                        <table class="table" id="blog-table">
                            <thead>
                                <tr>
                                    <th>Title</th>
                                    <th>Author</th>
                                    <th>Date</th>
                                    <th>Status</th>
                                    <th>Actions</th>
                                </tr>
                            </thead>
                            <tbody>
                                <!-- Blog posts will be loaded here -->
                            </tbody>
                        </table>
                    </div>
                </div>
            </div>
        </main>
    </div>

    <!-- Add Property Modal -->
    <div class="modal fade" id="addPropertyModal" tabindex="-1">
        <div class="modal-dialog modal-lg">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title">Add New Property</h5>
                    <button type="button" class="btn-close" data-bs-dismiss="modal"></button>
                </div>
                <div class="modal-body">
                    <form id="addPropertyForm" onsubmit="handleAddProperty(event)">
                        <div class="row">
                            <div class="col-md-6">
                                <div class="mb-3">
                                    <label class="form-label">Property Title *</label>
                                    <input type="text" name="title" class="form-control" required>
                                </div>
                                <div class="mb-3">
                                    <label class="form-label">Location *</label>
                                    <input type="text" name="location" class="form-control" required>
                                </div>
                                <div class="mb-3">
                                    <label class="form-label">Price (KSh) *</label>
                                    <input type="number" name="price" class="form-control" required>
                                </div>
                            </div>
                            <div class="col-md-6">
                                <div class="mb-3">
                                    <label class="form-label">Bedrooms *</label>
                                    <input type="number" name="bedrooms" class="form-control" required>
                                </div>
                                <div class="mb-3">
                                    <label class="form-label">Bathrooms *</label>
                                    <input type="number" name="bathrooms" class="form-control" required>
                                </div>
                                <div class="mb-3">
                                    <label class="form-label">Area (sq ft) *</label>
                                    <input type="number" name="area" class="form-control" required>
                                </div>
                                <div class="mb-3">
                                    <label class="form-label">Property Type *</label>
                                    <select name="type" class="form-control" required>
                                        <option value="">Select Type</option>
                                        <option value="apartment">Apartment</option>
                                        <option value="house">House</option>
                                        <option value="villa">Villa</option>
                                        <option value="commercial">Commercial</option>
                                    </select>
                                </div>
                            </div>
                        </div>
                        <div class="mb-3">
                            <label class="form-label">Description *</label>
                            <textarea name="description" class="form-control" rows="4" required></textarea>
                        </div>
                        <div class="mb-3">
                            <label class="form-label">Features</label>
                            <textarea name="features" class="form-control" rows="3" placeholder="Swimming Pool, Garden, Security, etc."></textarea>
                        </div>
                        <div class="mb-3">
                            <label class="form-label">Property Images</label>
                            <input type="file" name="images[]" class="form-control" multiple accept="image/*" onchange="previewImages(this)">
                            <small class="form-text text-muted">Upload multiple images (JPG, PNG, WEBP)</small>
                            <div id="image-preview" class="mt-2" style="display: none;">
                                <h6>Image Previews:</h6>
                                <div id="preview-container" class="d-flex flex-wrap gap-2"></div>
                            </div>
                        </div>
                        <div class="mb-3">
                            <label class="form-label">Status *</label>
                            <select name="status" class="form-control" required>
                                <option value="available">Available</option>
                                <option value="sold">Sold</option>
                                <option value="rented">Rented</option>
                            </select>
                        </div>
                    </form>
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Cancel</button>
                    <button type="submit" form="addPropertyForm" class="btn-primary">Add Property</button>
                </div>
            </div>
        </div>
    </div>

    <!-- Edit Property Modal -->
    <div class="modal fade" id="editPropertyModal" tabindex="-1">
        <div class="modal-dialog modal-lg">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title">Edit Property</h5>
                    <button type="button" class="btn-close" data-bs-dismiss="modal"></button>
                </div>
                <div class="modal-body">
                    <form id="editPropertyForm" onsubmit="handleEditProperty(event)">
                        <input type="hidden" name="property_id" id="edit-property-id">
                        <div class="row">
                            <div class="col-md-6">
                                <div class="mb-3">
                                    <label class="form-label">Property Title *</label>
                                    <input type="text" name="title" id="edit-property-title" class="form-control" required>
                                </div>
                                <div class="mb-3">
                                    <label class="form-label">Location *</label>
                                    <input type="text" name="location" id="edit-property-location" class="form-control" required>
                                </div>
                                <div class="mb-3">
                                    <label class="form-label">Price (KSh) *</label>
                                    <input type="number" name="price" id="edit-property-price" class="form-control" required>
                                </div>
                            </div>
                            <div class="col-md-6">
                                <div class="mb-3">
                                    <label class="form-label">Bedrooms *</label>
                                    <input type="number" name="bedrooms" id="edit-property-bedrooms" class="form-control" required>
                                </div>
                                <div class="mb-3">
                                    <label class="form-label">Bathrooms *</label>
                                    <input type="number" name="bathrooms" id="edit-property-bathrooms" class="form-control" required>
                                </div>
                                <div class="mb-3">
                                    <label class="form-label">Area (sq ft) *</label>
                                    <input type="number" name="area" id="edit-property-area" class="form-control" required>
                                </div>
                                <div class="mb-3">
                                    <label class="form-label">Property Type *</label>
                                    <select name="type" id="edit-property-type" class="form-control" required>
                                        <option value="">Select Type</option>
                                        <option value="apartment">Apartment</option>
                                        <option value="house">House</option>
                                        <option value="villa">Villa</option>
                                        <option value="commercial">Commercial</option>
                                    </select>
                                </div>
                            </div>
                        </div>
                        <div class="mb-3">
                            <label class="form-label">Description *</label>
                            <textarea name="description" id="edit-property-description" class="form-control" rows="4" required></textarea>
                        </div>
                        <div class="mb-3">
                            <label class="form-label">Features</label>
                            <textarea name="features" id="edit-property-features" class="form-control" rows="3" placeholder="Swimming Pool, Garden, Security, etc."></textarea>
                        </div>
                        <div class="mb-3">
                            <label class="form-label">Property Images</label>
                            <input type="file" name="images[]" class="form-control" multiple accept="image/*" onchange="previewEditImages(this)">
                            <small class="form-text text-muted">Upload new images to replace existing ones</small>
                            <div id="edit-image-preview" class="mt-2" style="display: none;">
                                <h6>New Image Previews:</h6>
                                <div id="edit-preview-container" class="d-flex flex-wrap gap-2"></div>
                            </div>
                        </div>
                        <div class="mb-3">
                            <label class="form-label">Status *</label>
                            <select name="status" id="edit-property-status" class="form-control" required>
                                <option value="available">Available</option>
                                <option value="sold">Sold</option>
                                <option value="rented">Rented</option>
                            </select>
                        </div>
                    </form>
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Cancel</button>
                    <button type="submit" form="editPropertyForm" class="btn-primary">Update Property</button>
                </div>
            </div>
        </div>
    </div>

    <!-- Add User Modal -->
    <div class="modal fade" id="addUserModal" tabindex="-1">
        <div class="modal-dialog modal-lg">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title">Add New User</h5>
                    <button type="button" class="btn-close" data-bs-dismiss="modal"></button>
                </div>
                <div class="modal-body">
                    <form id="addUserForm" onsubmit="handleAddUser(event)">
                        <div class="row">
                            <div class="col-md-6">
                                <div class="mb-3">
                                    <label class="form-label">Full Name *</label>
                                    <input type="text" name="name" class="form-control" required>
                                </div>
                                <div class="mb-3">
                                    <label class="form-label">Email *</label>
                                    <input type="email" name="email" class="form-control" required>
                                </div>
                                <div class="mb-3">
                                    <label class="form-label">Phone *</label>
                                    <input type="tel" name="phone" class="form-control" required>
                                </div>
                            </div>
                            <div class="col-md-6">
                                <div class="mb-3">
                                    <label class="form-label">Role *</label>
                                    <select name="role" class="form-control" required>
                                        <option value="">Select Role</option>
                                        <option value="agent">Agent</option>
                                        <option value="buyer">Buyer</option>
                                        <option value="seller">Seller</option>
                                    </select>
                                </div>
                                <div class="mb-3">
                                    <label class="form-label">Status *</label>
                                    <select name="status" class="form-control" required>
                                        <option value="active">Active</option>
                                        <option value="inactive">Inactive</option>
                                    </select>
                                </div>
                            </div>
                        </div>
                        <div class="mb-3">
                            <label class="form-label">Bio</label>
                            <textarea name="bio" class="form-control" rows="3" placeholder="Brief description about the user"></textarea>
                        </div>
                    </form>
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Cancel</button>
                    <button type="submit" form="addUserForm" class="btn-primary">Add User</button>
                </div>
            </div>
        </div>
    </div>

    <!-- Edit User Modal -->
    <div class="modal fade" id="editUserModal" tabindex="-1">
        <div class="modal-dialog modal-lg">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title">Edit User</h5>
                    <button type="button" class="btn-close" data-bs-dismiss="modal"></button>
                </div>
                <div class="modal-body">
                    <form id="editUserForm" onsubmit="handleEditUser(event)">
                        <input type="hidden" name="user_id" id="edit-user-id">
                        <div class="row">
                            <div class="col-md-6">
                                <div class="mb-3">
                                    <label class="form-label">Full Name *</label>
                                    <input type="text" name="name" id="edit-user-name" class="form-control" required>
                                </div>
                                <div class="mb-3">
                                    <label class="form-label">Email *</label>
                                    <input type="email" name="email" id="edit-user-email" class="form-control" required>
                                </div>
                                <div class="mb-3">
                                    <label class="form-label">Phone *</label>
                                    <input type="tel" name="phone" id="edit-user-phone" class="form-control" required>
                                </div>
                            </div>
                            <div class="col-md-6">
                                <div class="mb-3">
                                    <label class="form-label">Role *</label>
                                    <select name="role" id="edit-user-role" class="form-control" required>
                                        <option value="agent">Agent</option>
                                        <option value="buyer">Buyer</option>
                                        <option value="seller">Seller</option>
                                    </select>
                                </div>
                                <div class="mb-3">
                                    <label class="form-label">Status *</label>
                                    <select name="status" id="edit-user-status" class="form-control" required>
                                        <option value="active">Active</option>
                                        <option value="inactive">Inactive</option>
                                    </select>
                                </div>
                            </div>
                        </div>
                        <div class="mb-3">
                            <label class="form-label">Bio</label>
                            <textarea name="bio" id="edit-user-bio" class="form-control" rows="3"></textarea>
                        </div>
                    </form>
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Cancel</button>
                    <button type="submit" form="editUserForm" class="btn-primary">Update User</button>
                </div>
            </div>
        </div>
    </div>

    <!-- Add Blog Modal -->
    <div class="modal fade" id="addBlogModal" tabindex="-1">
        <div class="modal-dialog modal-lg">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title">Add Blog Post</h5>
                    <button type="button" class="btn-close" data-bs-dismiss="modal"></button>
                </div>
                <div class="modal-body">
                    <form id="addBlogForm" onsubmit="handleAddBlog(event)">
                        <div class="mb-3">
                            <label class="form-label">Title *</label>
                            <input type="text" name="title" class="form-control" required>
                        </div>
                        <div class="mb-3">
                            <label class="form-label">Excerpt</label>
                            <textarea name="excerpt" class="form-control" rows="3"></textarea>
                        </div>
                        <div class="mb-3">
                            <label class="form-label">Content *</label>
                            <textarea name="content" class="form-control" rows="8" required></textarea>
                        </div>
                        <div class="row">
                            <div class="col-md-6">
                                <div class="mb-3">
                                    <label class="form-label">Author *</label>
                                    <input type="text" name="author" class="form-control" value="<?php echo $_SESSION['user_name']; ?>" required>
                                </div>
                            </div>
                            <div class="col-md-6">
                                <div class="mb-3">
                                    <label class="form-label">Category</label>
                                    <select name="category" class="form-control">
                                        <option value="market-trends">Market Trends</option>
                                        <option value="investment">Investment</option>
                                        <option value="rental">Rental</option>
                                        <option value="affordable-housing">Affordable Housing</option>
                                        <option value="commercial">Commercial</option>
                                    </select>
                                </div>
                            </div>
                        </div>
                        <div class="mb-3">
                            <label class="form-label">Featured Image</label>
                            <input type="file" name="featured_image" class="form-control" accept="image/*" onchange="previewBlogImage(this)">
                            <div id="blog-image-preview" class="mt-2"></div>
                        </div>
                        <div class="mb-3">
                            <label class="form-label">Status *</label>
                            <select name="status" class="form-control" required>
                                <option value="draft">Draft</option>
                                <option value="published">Published</option>
                            </select>
                        </div>
                    </form>
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Cancel</button>
                    <button type="submit" form="addBlogForm" class="btn-primary">Add Blog Post</button>
                </div>
            </div>
        </div>
    </div>

    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/js/bootstrap.bundle.min.js"></script>
    <script>
        // Navigation
        function showSection(section) {
            // Hide all sections
            document.querySelectorAll('.active-section').forEach(el => {
                el.style.display = 'none';
                el.classList.remove('active-section');
            });
            
            // Show selected section
            const targetSection = document.getElementById(section + '-section');
            if (targetSection) {
                targetSection.style.display = 'block';
                targetSection.classList.add('active-section');
            }
            
            // Update menu items
            document.querySelectorAll('.menu-item').forEach(el => {
                el.classList.remove('active');
            });
            event.target.classList.add('active');
            
            // Load data for the section
            loadSectionData(section);
        }

        // Load data for sections
        function loadSectionData(section) {
            switch(section) {
                case 'properties':
                    loadProperties();
                    break;
                case 'users':
                    loadUsers();
                    break;
                case 'inquiries':
                    loadInquiries();
                    break;
                case 'appointments':
                    loadAppointments();
                    break;
                case 'blog':
                    loadBlogPosts();
                    break;
            }
        }

        // Load properties
        function loadProperties() {
            fetch('api/get-all-data.php')
            .then(response => response.json())
            .then(data => {
                if (data.success) {
                    const properties = data.data.properties;
                    const tbody = document.querySelector('#properties-table tbody');
                    tbody.innerHTML = '';
                    
                    if (properties.length === 0) {
                        tbody.innerHTML = '<tr><td colspan="6" class="text-center">No properties found</td></tr>';
                        return;
                    }
                    
                    properties.forEach(property => {
                        const row = document.createElement('tr');
                        row.innerHTML = `
                            <td>${property.title}</td>
                            <td>${property.location}</td>
                            <td>KSh ${Number(property.price).toLocaleString()}</td>
                            <td>${property.type}</td>
                            <td><span class="badge badge-${property.status === 'available' ? 'success' : 'warning'}">${property.status}</span></td>
                            <td>
                                <div class="action-buttons">
                                    <button class="btn btn-outline-primary btn-sm" onclick="editProperty(${property.id})">Edit</button>
                                    <button class="btn btn-outline-danger btn-sm" onclick="deleteProperty(${property.id})">Delete</button>
                                </div>
                            </td>
                        `;
                        tbody.appendChild(row);
                    });
                } else {
                    showNotification('error', 'Error', 'Failed to load properties.');
                }
            })
            .catch(error => {
                showNotification('error', 'Error', 'Failed to load properties.');
            });
        }

        // Load users
        function loadUsers() {
            fetch('api/get-all-data.php')
            .then(response => response.json())
            .then(data => {
                if (data.success) {
                    const users = data.data.users;
                    const tbody = document.querySelector('#users-table tbody');
                    tbody.innerHTML = '';
                    
                    if (users.length === 0) {
                        tbody.innerHTML = '<tr><td colspan="5" class="text-center">No users found</td></tr>';
                        return;
                    }
                    
                    users.forEach(user => {
                        const row = document.createElement('tr');
                        row.innerHTML = `
                            <td>${user.name}</td>
                            <td>${user.email}</td>
                            <td>${user.role}</td>
                            <td><span class="badge badge-${user.status === 'active' ? 'success' : 'warning'}">${user.status}</span></td>
                            <td>
                                <div class="action-buttons">
                                    <button class="btn btn-outline-primary btn-sm" onclick="editUser(${user.id})">Edit</button>
                                    <button class="btn btn-outline-danger btn-sm" onclick="deleteUser(${user.id})">Delete</button>
                                </div>
                            </td>
                        `;
                        tbody.appendChild(row);
                    });
                } else {
                    showNotification('error', 'Error', 'Failed to load users.');
                }
            })
            .catch(error => {
                showNotification('error', 'Error', 'Failed to load users.');
            });
        }

        // Load inquiries
        function loadInquiries() {
            fetch('api/get-all-data.php')
            .then(response => response.json())
            .then(data => {
                if (data.success) {
                    const inquiries = data.data.inquiries;
                    const tbody = document.querySelector('#inquiries-table tbody');
                    tbody.innerHTML = '';
                    
                    if (inquiries.length === 0) {
                        tbody.innerHTML = '<tr><td colspan="6" class="text-center">No inquiries found</td></tr>';
                        return;
                    }
                    
                    inquiries.forEach(inquiry => {
                        const row = document.createElement('tr');
                        row.innerHTML = `
                            <td>${inquiry.name}</td>
                            <td>${inquiry.email}</td>
                            <td>Property #${inquiry.property_id}</td>
                            <td><span class="badge badge-${inquiry.status === 'new' ? 'success' : 'warning'}">${inquiry.status}</span></td>
                            <td>${new Date(inquiry.created_at).toLocaleDateString()}</td>
                            <td>
                                <div class="action-buttons">
                                    <button class="btn btn-outline-primary btn-sm" onclick="viewInquiry(${inquiry.id})">View</button>
                                    <button class="btn btn-outline-success btn-sm" onclick="replyInquiry(${inquiry.id})">Reply</button>
                                </div>
                            </td>
                        `;
                        tbody.appendChild(row);
                    });
                } else {
                    showNotification('error', 'Error', 'Failed to load inquiries.');
                }
            })
            .catch(error => {
                showNotification('error', 'Error', 'Failed to load inquiries.');
            });
        }

        // Load appointments
        function loadAppointments() {
            fetch('api/get-all-data.php')
            .then(response => response.json())
            .then(data => {
                if (data.success) {
                    const appointments = data.data.appointments;
                    const tbody = document.querySelector('#appointments-table tbody');
                    tbody.innerHTML = '';
                    
                    if (appointments.length === 0) {
                        tbody.innerHTML = '<tr><td colspan="6" class="text-center">No appointments found</td></tr>';
                        return;
                    }
                    
                    appointments.forEach(appointment => {
                        const row = document.createElement('tr');
                        row.innerHTML = `
                            <td>${appointment.client_name}</td>
                            <td>Property #${appointment.property_id}</td>
                            <td>${new Date(appointment.appointment_date).toLocaleDateString()}</td>
                            <td>${appointment.appointment_time}</td>
                            <td><span class="badge badge-${appointment.status === 'confirmed' ? 'success' : 'warning'}">${appointment.status}</span></td>
                            <td>
                                <div class="action-buttons">
                                    <button class="btn btn-outline-primary btn-sm" onclick="viewAppointment(${appointment.id})">View</button>
                                    <button class="btn btn-outline-success btn-sm" onclick="confirmAppointment(${appointment.id})">Confirm</button>
                                </div>
                            </td>
                        `;
                        tbody.appendChild(row);
                    });
                } else {
                    showNotification('error', 'Error', 'Failed to load appointments.');
                }
            })
            .catch(error => {
                showNotification('error', 'Error', 'Failed to load appointments.');
            });
        }

        // Load blog posts
        function loadBlogPosts() {
            fetch('api/get-all-data.php')
            .then(response => response.json())
            .then(data => {
                if (data.success) {
                    const blogPosts = data.data.blog_posts;
                    const tbody = document.querySelector('#blog-table tbody');
                    tbody.innerHTML = '';
                    
                    if (blogPosts.length === 0) {
                        tbody.innerHTML = '<tr><td colspan="5" class="text-center">No blog posts found</td></tr>';
                        return;
                    }
                    
                    blogPosts.forEach(post => {
                        const row = document.createElement('tr');
                        row.innerHTML = `
                            <td>${post.title}</td>
                            <td>${post.author}</td>
                            <td>${new Date(post.created_at).toLocaleDateString()}</td>
                            <td><span class="badge badge-${post.status === 'published' ? 'success' : 'warning'}">${post.status}</span></td>
                            <td>
                                <div class="action-buttons">
                                    <button class="btn btn-outline-primary btn-sm" onclick="editBlogPost(${post.id})">Edit</button>
                                    <button class="btn btn-outline-danger btn-sm" onclick="deleteBlogPost(${post.id})">Delete</button>
                                </div>
                            </td>
                        `;
                        tbody.appendChild(row);
                    });
                } else {
                    showNotification('error', 'Error', 'Failed to load blog posts.');
                }
            })
            .catch(error => {
                showNotification('error', 'Error', 'Failed to load blog posts.');
            });
        }

        // Modal functions
        function showAddPropertyModal() {
            new bootstrap.Modal(document.getElementById('addPropertyModal')).show();
        }

        function showAddUserModal() {
            new bootstrap.Modal(document.getElementById('addUserModal')).show();
        }

        function showAddBlogModal() {
            new bootstrap.Modal(document.getElementById('addBlogModal')).show();
        }

        // Property management
        function editProperty(propertyId) {
            // Load property data and show edit modal
            fetch(`api/get-property.php?id=${propertyId}`)
            .then(response => response.json())
            .then(data => {
                if (data.success) {
                    const property = data.data;
                    document.getElementById('edit-property-id').value = propertyId;
                    document.getElementById('edit-property-title').value = property.title || '';
                    document.getElementById('edit-property-location').value = property.location || '';
                    document.getElementById('edit-property-price').value = property.price || '';
                    document.getElementById('edit-property-bedrooms').value = property.bedrooms || '';
                    document.getElementById('edit-property-bathrooms').value = property.bathrooms || '';
                    document.getElementById('edit-property-area').value = property.area || '';
                    document.getElementById('edit-property-type').value = property.type || '';
                    document.getElementById('edit-property-description').value = property.description || '';
                    document.getElementById('edit-property-features').value = property.features || '';
                    document.getElementById('edit-property-status').value = property.status || '';
                    new bootstrap.Modal(document.getElementById('editPropertyModal')).show();
                } else {
                    showNotification('error', 'Error', data.message || 'Failed to load property data.');
                }
            })
            .catch(error => {
                showNotification('error', 'Error', 'Failed to load property data.');
            });
        }

        function deleteProperty(propertyId) {
            if (confirm('Are you sure you want to delete this property?')) {
                showNotification('success', 'Success', 'Property deleted successfully.');
                loadProperties();
            }
        }

        // User management
        function editUser(userId) {
            // Load user data and show edit modal
            fetch(`api/get-user.php?id=${userId}`)
            .then(response => response.json())
            .then(data => {
                if (data.success) {
                    const user = data.data;
                    document.getElementById('edit-user-id').value = userId;
                    document.getElementById('edit-user-name').value = user.name || '';
                    document.getElementById('edit-user-email').value = user.email || '';
                    document.getElementById('edit-user-phone').value = user.phone || '';
                    document.getElementById('edit-user-role').value = user.role || '';
                    document.getElementById('edit-user-status').value = user.status || '';
                    document.getElementById('edit-user-bio').value = user.bio || '';
                    new bootstrap.Modal(document.getElementById('editUserModal')).show();
                } else {
                    showNotification('error', 'Error', data.message || 'Failed to load user data.');
                }
            })
            .catch(error => {
                showNotification('error', 'Error', 'Failed to load user data.');
            });
        }

        function deleteUser(userId) {
            if (confirm('Are you sure you want to delete this user?')) {
                showNotification('success', 'Success', 'User deleted successfully.');
                loadUsers();
            }
        }

        // Form handlers
        function handleAddProperty(event) {
            event.preventDefault();
            const form = event.target;
            const formData = new FormData(form);
            
            // Validate required fields
            const title = formData.get('title');
            const location = formData.get('location');
            const price = formData.get('price');
            const type = formData.get('type');
            
            if (!title || !location || !price || !type) {
                showNotification('error', 'Validation Error', 'Please fill in all required fields.');
                return;
            }
            
            // Send data to server
            fetch('api/add-property.php', {
                method: 'POST',
                body: formData
            })
            .then(response => response.json())
            .then(data => {
                if (data.success) {
                    showNotification('success', 'Success', `Property "${title}" added successfully!`);
                    bootstrap.Modal.getInstance(document.getElementById('addPropertyModal')).hide();
                    form.reset();
                    loadProperties();
                } else {
                    showNotification('error', 'Error', data.message || 'Failed to add property.');
                }
            })
            .catch(error => {
                showNotification('error', 'Error', 'Failed to add property. Please try again.');
            });
        }

        function handleEditProperty(event) {
            event.preventDefault();
            const form = event.target;
            const formData = new FormData(form);
            
            const title = formData.get('title');
            const location = formData.get('location');
            const price = formData.get('price');
            const type = formData.get('type');
            
            if (!title || !location || !price || !type) {
                showNotification('error', 'Validation Error', 'Please fill in all required fields.');
                return;
            }
            
            fetch('api/update-property.php', {
                method: 'POST',
                body: formData
            })
            .then(response => response.json())
            .then(data => {
                if (data.success) {
                    showNotification('success', 'Success', `Property "${title}" updated successfully!`);
                    bootstrap.Modal.getInstance(document.getElementById('editPropertyModal')).hide();
                    form.reset();
                    loadProperties();
                } else {
                    showNotification('error', 'Error', data.message || 'Failed to update property.');
                }
            })
            .catch(error => {
                showNotification('error', 'Error', 'Failed to update property. Please try again.');
            });
        }

        function handleAddUser(event) {
            event.preventDefault();
            const form = event.target;
            const formData = new FormData(form);
            
            const name = formData.get('name');
            const email = formData.get('email');
            const role = formData.get('role');
            
            if (!name || !email || !role) {
                showNotification('error', 'Validation Error', 'Please fill in all required fields.');
                return;
            }
            
            fetch('api/add-user.php', {
                method: 'POST',
                body: formData
            })
            .then(response => response.json())
            .then(data => {
                if (data.success) {
                    showNotification('success', 'Success', `User "${name}" added successfully!`);
                    bootstrap.Modal.getInstance(document.getElementById('addUserModal')).hide();
                    form.reset();
                    loadUsers();
                } else {
                    showNotification('error', 'Error', data.message || 'Failed to add user.');
                }
            })
            .catch(error => {
                showNotification('error', 'Error', 'Failed to add user. Please try again.');
            });
        }

        function handleEditUser(event) {
            event.preventDefault();
            const form = event.target;
            const formData = new FormData(form);
            
            const name = formData.get('name');
            const email = formData.get('email');
            const role = formData.get('role');
            
            if (!name || !email || !role) {
                showNotification('error', 'Validation Error', 'Please fill in all required fields.');
                return;
            }
            
            fetch('api/update-user.php', {
                method: 'POST',
                body: formData
            })
            .then(response => response.json())
            .then(data => {
                if (data.success) {
                    showNotification('success', 'Success', `User "${name}" updated successfully!`);
                    bootstrap.Modal.getInstance(document.getElementById('editUserModal')).hide();
                    form.reset();
                    loadUsers();
                } else {
                    showNotification('error', 'Error', data.message || 'Failed to update user.');
                }
            })
            .catch(error => {
                showNotification('error', 'Error', 'Failed to update user. Please try again.');
            });
        }

        function handleAddBlog(event) {
            event.preventDefault();
            const form = event.target;
            const formData = new FormData(form);
            
            const title = formData.get('title');
            const content = formData.get('content');
            
            if (!title || !content) {
                showNotification('error', 'Validation Error', 'Please fill in all required fields.');
                return;
            }
            
            fetch('api/add-blog.php', {
                method: 'POST',
                body: formData
            })
            .then(response => response.json())
            .then(data => {
                if (data.success) {
                    showNotification('success', 'Success', `Blog post "${title}" added successfully!`);
                    bootstrap.Modal.getInstance(document.getElementById('addBlogModal')).hide();
                    form.reset();
                    loadBlogPosts();
                } else {
                    showNotification('error', 'Error', data.message || 'Failed to add blog post.');
                }
            })
            .catch(error => {
                showNotification('error', 'Error', 'Failed to add blog post. Please try again.');
            });
        }

        // Image preview functions
        function previewImages(input) {
            const previewContainer = document.getElementById('preview-container');
            const imagePreview = document.getElementById('image-preview');
            
            previewContainer.innerHTML = '';
            
            if (input.files && input.files.length > 0) {
                imagePreview.style.display = 'block';
                
                Array.from(input.files).forEach((file, index) => {
                    if (file.type.startsWith('image/')) {
                        const reader = new FileReader();
                        reader.onload = function(e) {
                            const img = document.createElement('img');
                            img.src = e.target.result;
                            img.className = 'img-thumbnail';
                            img.style.cssText = 'max-width: 100px; max-height: 100px; margin: 5px;';
                            previewContainer.appendChild(img);
                        };
                        reader.readAsDataURL(file);
                    }
                });
            } else {
                imagePreview.style.display = 'none';
            }
        }

        function previewEditImages(input) {
            const previewContainer = document.getElementById('edit-preview-container');
            const imagePreview = document.getElementById('edit-image-preview');
            
            previewContainer.innerHTML = '';
            
            if (input.files && input.files.length > 0) {
                imagePreview.style.display = 'block';
                
                Array.from(input.files).forEach((file, index) => {
                    if (file.type.startsWith('image/')) {
                        const reader = new FileReader();
                        reader.onload = function(e) {
                            const img = document.createElement('img');
                            img.src = e.target.result;
                            img.className = 'img-thumbnail';
                            img.style.cssText = 'max-width: 100px; max-height: 100px; margin: 5px;';
                            previewContainer.appendChild(img);
                        };
                        reader.readAsDataURL(file);
                    }
                });
            } else {
                imagePreview.style.display = 'none';
            }
        }

        function previewBlogImage(input) {
            const preview = document.getElementById('blog-image-preview');
            if (input.files && input.files[0]) {
                const reader = new FileReader();
                reader.onload = function(e) {
                    preview.innerHTML = `<img src="${e.target.result}" class="img-thumbnail" style="max-width: 200px; max-height: 150px;">`;
                };
                reader.readAsDataURL(input.files[0]);
            }
        }

        // Notification system
        function showNotification(type, title, message) {
            const notification = document.createElement('div');
            notification.className = `notification ${type}`;
            notification.innerHTML = `
                <div class="notification-header">
                    <i class="fas fa-${type === 'success' ? 'check-circle' : type === 'error' ? 'exclamation-circle' : 'info-circle'}"></i>
                    <h6 class="notification-title">${title}</h6>
                </div>
                <p class="notification-message">${message}</p>
            `;
            
            document.body.appendChild(notification);
            
            setTimeout(() => {
                notification.classList.add('show');
            }, 100);
            
            setTimeout(() => {
                notification.classList.remove('show');
                setTimeout(() => {
                    document.body.removeChild(notification);
                }, 300);
            }, 5000);
        }

        // Inquiry management
        function viewInquiry(inquiryId) {
            showNotification('info', 'Info', `Viewing inquiry #${inquiryId}`);
        }

        function replyInquiry(inquiryId) {
            showNotification('info', 'Info', `Replying to inquiry #${inquiryId}`);
        }

        // Appointment management
        function viewAppointment(appointmentId) {
            showNotification('info', 'Info', `Viewing appointment #${appointmentId}`);
        }

        function confirmAppointment(appointmentId) {
            showNotification('success', 'Success', `Appointment #${appointmentId} confirmed`);
        }

        // Blog management
        function editBlogPost(postId) {
            showNotification('info', 'Info', `Editing blog post #${postId}`);
        }

        function deleteBlogPost(postId) {
            if (confirm('Are you sure you want to delete this blog post?')) {
                showNotification('success', 'Success', `Blog post #${postId} deleted`);
                loadBlogPosts();
            }
        }

        // Logout function
        function logout() {
            if (confirm('Are you sure you want to logout?')) {
                window.location.href = 'home';
            }
        }

        // Initialize dashboard
        document.addEventListener('DOMContentLoaded', function() {
            loadProperties();
        });
    </script>
</body>
</html>
