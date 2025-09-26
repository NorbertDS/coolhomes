<?php
session_start();

// Check if user is logged in and is admin
if (!isset($_SESSION['user_id']) || $_SESSION['user_role'] !== 'admin') {
    header('Location: login.php');
    exit;
}

$pageTitle = "Admin Dashboard";
$pageDescription = "Cool Homes Admin Dashboard - Manage properties, users, and content";
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
    <link rel="stylesheet" href="css/dashboard.css">
</head>
<body>
    <!-- Header -->
    <?php include 'includes/header.php'; ?>

    <div class="dashboard-container">
        <!-- Sidebar -->
        <aside class="sidebar">
            <div class="sidebar-header">
                <div class="brand">
                    <i class="fas fa-home"></i>
                    <span>Cool Homes</span>
                </div>
                <div class="user-info">
                    <div class="user-avatar">
                        <i class="fas fa-user"></i>
                    </div>
                    <div class="user-details">
                        <div class="user-name"><?php echo $_SESSION['user_name']; ?></div>
                        <div class="user-role">Admin</div>
                    </div>
                </div>
            </div>
            
            <nav class="sidebar-nav">
                <a href="#dashboard" class="nav-item active" data-section="dashboard">
                    <i class="fas fa-tachometer-alt"></i>
                    <span>Dashboard</span>
                </a>
                <a href="#properties" class="nav-item" data-section="properties">
                    <i class="fas fa-building"></i>
                    <span>Properties</span>
                </a>
                <a href="#users" class="nav-item" data-section="users">
                    <i class="fas fa-users"></i>
                    <span>Users</span>
                </a>
                <a href="#inquiries" class="nav-item" data-section="inquiries">
                    <i class="fas fa-envelope"></i>
                    <span>Inquiries</span>
                </a>
                <a href="#appointments" class="nav-item" data-section="appointments">
                    <i class="fas fa-calendar"></i>
                    <span>Appointments</span>
                </a>
                <a href="#blog" class="nav-item" data-section="blog">
                    <i class="fas fa-blog"></i>
                    <span>Blog</span>
                </a>
                <a href="admin-import-properties.php" class="nav-item" target="_blank">
                    <i class="fas fa-download"></i>
                    <span>Import Properties</span>
                </a>
                <a href="home" class="nav-item">
                    <i class="fas fa-external-link-alt"></i>
                    <span>View Website</span>
                </a>
                <a href="logout.php" class="nav-item">
                    <i class="fas fa-sign-out-alt"></i>
                    <span>Logout</span>
                </a>
            </nav>
        </aside>

        <!-- Main Content -->
        <main class="main-content">
            <!-- Dashboard Section -->
            <div id="dashboard-section" class="content-section active">
                <div class="content-header">
                    <div class="d-flex justify-content-between align-items-center">
                        <div>
                            <h1>Welcome, <?php echo $_SESSION['user_name']; ?>!</h1>
                            <p>Cool Homes Founder</p>
                        </div>
                        <div>
                            <a href="admin-import-properties.php" class="btn btn-primary btn-lg">
                                <i class="fas fa-download"></i> Import Properties
                            </a>
                        </div>
                    </div>
                </div>
                
                <div class="content-body">
                    <h3>Dashboard Overview</h3>
                    <div class="stats-grid">
                        <div class="stat-card">
                            <div class="stat-icon">
                                <i class="fas fa-building"></i>
                            </div>
                            <div class="stat-content">
                                <div class="stat-number">125</div>
                                <div class="stat-label">Total Properties</div>
                            </div>
                        </div>
                        <div class="stat-card success">
                            <div class="stat-icon">
                                <i class="fas fa-check-circle"></i>
                            </div>
                            <div class="stat-content">
                                <div class="stat-number">87</div>
                                <div class="stat-label">Active Listings</div>
                            </div>
                        </div>
                        <div class="stat-card warning">
                            <div class="stat-icon">
                                <i class="fas fa-users"></i>
                            </div>
                            <div class="stat-content">
                                <div class="stat-number">12</div>
                                <div class="stat-label">New Users</div>
                            </div>
                        </div>
                        <div class="stat-card danger">
                            <div class="stat-icon">
                                <i class="fas fa-envelope"></i>
                            </div>
                            <div class="stat-content">
                                <div class="stat-number">8</div>
                                <div class="stat-label">Pending Inquiries</div>
                            </div>
                        </div>
                    </div>
                    
                    <div class="quick-actions">
                        <h4>Quick Actions</h4>
                        <div class="action-buttons">
                            <button class="btn btn-primary" onclick="showAddPropertyModal()">
                                <i class="fas fa-plus"></i> Add Property
                            </button>
                            <button class="btn btn-success" onclick="showAddUserModal()">
                                <i class="fas fa-user-plus"></i> Add User
                            </button>
                            <button class="btn btn-info" onclick="showAddBlogModal()">
                                <i class="fas fa-blog"></i> Add Blog Post
                            </button>
                            <a href="admin-import-properties.php" class="btn btn-warning" target="_blank">
                                <i class="fas fa-download"></i> Import Properties
                            </a>
                        </div>
                    </div>
                </div>
            </div>

            <!-- Properties Section -->
            <div id="properties-section" class="content-section">
                <div class="content-header">
                    <h1>Property Management</h1>
                    <button class="btn btn-primary" onclick="showAddPropertyModal()">
                        <i class="fas fa-plus"></i> Add Property
                    </button>
                </div>
                <div class="content-body">
                    <div class="table-responsive">
                        <table class="table table-striped">
                            <thead>
                                <tr>
                                    <th>Property</th>
                                    <th>Location</th>
                                    <th>Price</th>
                                    <th>Status</th>
                                    <th>Views</th>
                                    <th>Actions</th>
                                </tr>
                            </thead>
                            <tbody id="propertiesTableBody">
                                <!-- Properties will be loaded here -->
                            </tbody>
                        </table>
                    </div>
                </div>
            </div>

            <!-- Users Section -->
            <div id="users-section" class="content-section">
                <div class="content-header">
                    <h1>User Management</h1>
                    <button class="btn btn-primary" onclick="showAddUserModal()">
                        <i class="fas fa-plus"></i> Add User
                    </button>
                </div>
                <div class="content-body">
                    <div class="table-responsive">
                        <table class="table table-striped">
                            <thead>
                                <tr>
                                    <th>Name</th>
                                    <th>Email</th>
                                    <th>Role</th>
                                    <th>Status</th>
                                    <th>Actions</th>
                                </tr>
                            </thead>
                            <tbody id="usersTableBody">
                                <!-- Users will be loaded here -->
                            </tbody>
                        </table>
                    </div>
                </div>
            </div>

            <!-- Inquiries Section -->
            <div id="inquiries-section" class="content-section">
                <div class="content-header">
                    <h1>Inquiries</h1>
                </div>
                <div class="content-body">
                    <div class="table-responsive">
                        <table class="table table-striped">
                            <thead>
                                <tr>
                                    <th>Name</th>
                                    <th>Email</th>
                                    <th>Property</th>
                                    <th>Message</th>
                                    <th>Date</th>
                                    <th>Actions</th>
                                </tr>
                            </thead>
                            <tbody id="inquiriesTableBody">
                                <!-- Inquiries will be loaded here -->
                            </tbody>
                        </table>
                    </div>
                </div>
            </div>

            <!-- Appointments Section -->
            <div id="appointments-section" class="content-section">
                <div class="content-header">
                    <h1>Appointments</h1>
                </div>
                <div class="content-body">
                    <div class="table-responsive">
                        <table class="table table-striped">
                            <thead>
                                <tr>
                                    <th>Client</th>
                                    <th>Property</th>
                                    <th>Date</th>
                                    <th>Time</th>
                                    <th>Status</th>
                                    <th>Actions</th>
                                </tr>
                            </thead>
                            <tbody id="appointmentsTableBody">
                                <!-- Appointments will be loaded here -->
                            </tbody>
                        </table>
                    </div>
                </div>
            </div>

            <!-- Blog Section -->
            <div id="blog-section" class="content-section">
                <div class="content-header">
                    <h1>Blog Management</h1>
                    <button class="btn btn-primary" onclick="showAddBlogModal()">
                        <i class="fas fa-plus"></i> Add Blog Post
                    </button>
                </div>
                <div class="content-body">
                    <div class="table-responsive">
                        <table class="table table-striped">
                            <thead>
                                <tr>
                                    <th>Title</th>
                                    <th>Author</th>
                                    <th>Status</th>
                                    <th>Date</th>
                                    <th>Actions</th>
                                </tr>
                            </thead>
                            <tbody id="blogTableBody">
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
                <form id="addPropertyForm" enctype="multipart/form-data">
                    <div class="modal-body">
                        <div class="row">
                            <div class="col-md-6">
                                <div class="mb-3">
                                    <label for="title" class="form-label">Property Title *</label>
                                    <input type="text" class="form-control" id="title" name="title" required>
                                </div>
                            </div>
                            <div class="col-md-6">
                                <div class="mb-3">
                                    <label for="location" class="form-label">Location *</label>
                                    <input type="text" class="form-control" id="location" name="location" required>
                                </div>
                            </div>
                        </div>
                        <div class="row">
                            <div class="col-md-4">
                                <div class="mb-3">
                                    <label for="price" class="form-label">Price (KSh) *</label>
                                    <input type="number" class="form-control" id="price" name="price" required>
                                </div>
                            </div>
                            <div class="col-md-4">
                                <div class="mb-3">
                                    <label for="bedrooms" class="form-label">Bedrooms</label>
                                    <input type="number" class="form-control" id="bedrooms" name="bedrooms">
                                </div>
                            </div>
                            <div class="col-md-4">
                                <div class="mb-3">
                                    <label for="bathrooms" class="form-label">Bathrooms</label>
                                    <input type="number" class="form-control" id="bathrooms" name="bathrooms">
                                </div>
                            </div>
                        </div>
                        <div class="row">
                            <div class="col-md-6">
                                <div class="mb-3">
                                    <label for="area" class="form-label">Area (sq ft)</label>
                                    <input type="number" class="form-control" id="area" name="area">
                                </div>
                            </div>
                            <div class="col-md-6">
                                <div class="mb-3">
                                    <label for="type" class="form-label">Property Type *</label>
                                    <select class="form-control" id="type" name="type" required>
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
                            <label for="description" class="form-label">Description</label>
                            <textarea class="form-control" id="description" name="description" rows="3"></textarea>
                        </div>
                        <div class="mb-3">
                            <label for="features" class="form-label">Features</label>
                            <textarea class="form-control" id="features" name="features" rows="2"></textarea>
                        </div>
                        <div class="mb-3">
                            <label for="images" class="form-label">Property Images</label>
                            <input type="file" class="form-control" id="images" name="images[]" multiple accept="image/*">
                        </div>
                        <div class="mb-3">
                            <label for="status" class="form-label">Status</label>
                            <select class="form-control" id="status" name="status">
                                <option value="available">Available</option>
                                <option value="sold">Sold</option>
                                <option value="rented">Rented</option>
                            </select>
                        </div>
                    </div>
                    <div class="modal-footer">
                        <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Cancel</button>
                        <button type="submit" class="btn btn-primary">Add Property</button>
                    </div>
                </form>
            </div>
        </div>
    </div>

    <!-- Add User Modal -->
    <div class="modal fade" id="addUserModal" tabindex="-1">
        <div class="modal-dialog">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title">Add New User</h5>
                    <button type="button" class="btn-close" data-bs-dismiss="modal"></button>
                </div>
                <form id="addUserForm">
                    <div class="modal-body">
                        <div class="mb-3">
                            <label for="userName" class="form-label">Full Name *</label>
                            <input type="text" class="form-control" id="userName" name="name" required>
                        </div>
                        <div class="mb-3">
                            <label for="userEmail" class="form-label">Email *</label>
                            <input type="email" class="form-control" id="userEmail" name="email" required>
                        </div>
                        <div class="mb-3">
                            <label for="userPhone" class="form-label">Phone</label>
                            <input type="tel" class="form-control" id="userPhone" name="phone">
                        </div>
                        <div class="mb-3">
                            <label for="userRole" class="form-label">Role *</label>
                            <select class="form-control" id="userRole" name="role" required>
                                <option value="">Select Role</option>
                                <option value="buyer">Buyer</option>
                                <option value="seller">Seller</option>
                                <option value="agent">Agent</option>
                                <option value="admin">Admin</option>
                            </select>
                        </div>
                        <div class="mb-3">
                            <label for="userStatus" class="form-label">Status</label>
                            <select class="form-control" id="userStatus" name="status">
                                <option value="active">Active</option>
                                <option value="inactive">Inactive</option>
                            </select>
                        </div>
                        <div class="mb-3">
                            <label for="userBio" class="form-label">Bio</label>
                            <textarea class="form-control" id="userBio" name="bio" rows="3"></textarea>
                        </div>
                    </div>
                    <div class="modal-footer">
                        <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Cancel</button>
                        <button type="submit" class="btn btn-primary">Add User</button>
                    </div>
                </form>
            </div>
        </div>
    </div>

    <!-- Add Blog Modal -->
    <div class="modal fade" id="addBlogModal" tabindex="-1">
        <div class="modal-dialog modal-lg">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title">Add New Blog Post</h5>
                    <button type="button" class="btn-close" data-bs-dismiss="modal"></button>
                </div>
                <form id="addBlogForm" enctype="multipart/form-data">
                    <div class="modal-body">
                        <div class="mb-3">
                            <label for="blogTitle" class="form-label">Title *</label>
                            <input type="text" class="form-control" id="blogTitle" name="title" required>
                        </div>
                        <div class="mb-3">
                            <label for="blogContent" class="form-label">Content *</label>
                            <textarea class="form-control" id="blogContent" name="content" rows="5" required></textarea>
                        </div>
                        <div class="mb-3">
                            <label for="blogImage" class="form-label">Featured Image</label>
                            <input type="file" class="form-control" id="blogImage" name="image" accept="image/*">
                        </div>
                        <div class="mb-3">
                            <label for="blogStatus" class="form-label">Status</label>
                            <select class="form-control" id="blogStatus" name="status">
                                <option value="published">Published</option>
                                <option value="draft">Draft</option>
                            </select>
                        </div>
                    </div>
                    <div class="modal-footer">
                        <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Cancel</button>
                        <button type="submit" class="btn btn-primary">Add Blog Post</button>
                    </div>
                </form>
            </div>
        </div>
    </div>

    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/js/bootstrap.bundle.min.js"></script>
    <script>
        // Navigation
        document.querySelectorAll('.nav-item').forEach(item => {
            item.addEventListener('click', function(e) {
                e.preventDefault();
                const section = this.getAttribute('data-section');
                if (section) {
                    showSection(section);
                }
            });
        });

        function showSection(sectionName) {
            // Hide all sections
            document.querySelectorAll('.content-section').forEach(section => {
                section.classList.remove('active');
            });
            
            // Remove active class from nav items
            document.querySelectorAll('.nav-item').forEach(item => {
                item.classList.remove('active');
            });
            
            // Show selected section
            document.getElementById(sectionName + '-section').classList.add('active');
            
            // Add active class to nav item
            document.querySelector(`[data-section="${sectionName}"]`).classList.add('active');
            
            // Load data for the section
            loadSectionData(sectionName);
        }

        function loadSectionData(sectionName) {
            switch(sectionName) {
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

        // Modal functions
        function showAddPropertyModal() {
            const modal = new bootstrap.Modal(document.getElementById('addPropertyModal'));
            modal.show();
        }

        function showAddUserModal() {
            const modal = new bootstrap.Modal(document.getElementById('addUserModal'));
            modal.show();
        }

        function showAddBlogModal() {
            const modal = new bootstrap.Modal(document.getElementById('addBlogModal'));
            modal.show();
        }

        // Form submissions
        document.getElementById('addPropertyForm').addEventListener('submit', function(e) {
            e.preventDefault();
            handleAddProperty();
        });

        document.getElementById('addUserForm').addEventListener('submit', function(e) {
            e.preventDefault();
            handleAddUser();
        });

        document.getElementById('addBlogForm').addEventListener('submit', function(e) {
            e.preventDefault();
            handleAddBlog();
        });

        function handleAddProperty() {
            const formData = new FormData(document.getElementById('addPropertyForm'));
            
            fetch('api/add-property.php', {
                method: 'POST',
                body: formData
            })
            .then(response => response.json())
            .then(data => {
                if (data.success) {
                    alert('Property added successfully!');
                    bootstrap.Modal.getInstance(document.getElementById('addPropertyModal')).hide();
                    document.getElementById('addPropertyForm').reset();
                    loadProperties();
                } else {
                    alert('Error: ' + data.message);
                }
            })
            .catch(error => {
                console.error('Error:', error);
                alert('An error occurred while adding the property.');
            });
        }

        function handleAddUser() {
            const formData = new FormData(document.getElementById('addUserForm'));
            
            fetch('api/add-user.php', {
                method: 'POST',
                body: formData
            })
            .then(response => response.json())
            .then(data => {
                if (data.success) {
                    alert('User added successfully!');
                    bootstrap.Modal.getInstance(document.getElementById('addUserModal')).hide();
                    document.getElementById('addUserForm').reset();
                    loadUsers();
                } else {
                    alert('Error: ' + data.message);
                }
            })
            .catch(error => {
                console.error('Error:', error);
                alert('An error occurred while adding the user.');
            });
        }

        function handleAddBlog() {
            const formData = new FormData(document.getElementById('addBlogForm'));
            
            fetch('api/add-blog.php', {
                method: 'POST',
                body: formData
            })
            .then(response => response.json())
            .then(data => {
                if (data.success) {
                    alert('Blog post added successfully!');
                    bootstrap.Modal.getInstance(document.getElementById('addBlogModal')).hide();
                    document.getElementById('addBlogForm').reset();
                    loadBlogPosts();
                } else {
                    alert('Error: ' + data.message);
                }
            })
            .catch(error => {
                console.error('Error:', error);
                alert('An error occurred while adding the blog post.');
            });
        }

        // Load data functions
        function loadProperties() {
            fetch('api/get-all-data.php')
            .then(response => response.json())
            .then(data => {
                if (data.success) {
                    const tbody = document.getElementById('propertiesTableBody');
                    tbody.innerHTML = '';
                    
                    data.properties.forEach(property => {
                        const row = document.createElement('tr');
                        row.innerHTML = `
                            <td>
                                <div class="property-info">
                                    <div class="property-title">${property.title}</div>
                                    <div class="property-details">${property.bedrooms} Beds, ${property.bathrooms} Baths</div>
                                </div>
                            </td>
                            <td>${property.location}</td>
                            <td>KSh ${parseInt(property.price).toLocaleString()}</td>
                            <td><span class="badge bg-${property.status === 'available' ? 'success' : 'warning'}">${property.status}</span></td>
                            <td>${property.views || 0}</td>
                            <td>
                                <button class="btn btn-sm btn-primary" onclick="editProperty(${property.id})">Edit</button>
                                <button class="btn btn-sm btn-danger" onclick="deleteProperty(${property.id})">Delete</button>
                            </td>
                        `;
                        tbody.appendChild(row);
                    });
                }
            })
            .catch(error => {
                console.error('Error loading properties:', error);
            });
        }

        function loadUsers() {
            fetch('api/get-all-data.php')
            .then(response => response.json())
            .then(data => {
                if (data.success) {
                    const tbody = document.getElementById('usersTableBody');
                    tbody.innerHTML = '';
                    
                    data.users.forEach(user => {
                        const row = document.createElement('tr');
                        row.innerHTML = `
                            <td>${user.name}</td>
                            <td>${user.email}</td>
                            <td><span class="badge bg-info">${user.role}</span></td>
                            <td><span class="badge bg-${user.status === 'active' ? 'success' : 'secondary'}">${user.status}</span></td>
                            <td>
                                <button class="btn btn-sm btn-primary" onclick="editUser(${user.id})">Edit</button>
                                <button class="btn btn-sm btn-danger" onclick="deleteUser(${user.id})">Delete</button>
                            </td>
                        `;
                        tbody.appendChild(row);
                    });
                }
            })
            .catch(error => {
                console.error('Error loading users:', error);
            });
        }

        function loadInquiries() {
            fetch('api/get-all-data.php')
            .then(response => response.json())
            .then(data => {
                if (data.success) {
                    const tbody = document.getElementById('inquiriesTableBody');
                    tbody.innerHTML = '';
                    
                    data.inquiries.forEach(inquiry => {
                        const row = document.createElement('tr');
                        row.innerHTML = `
                            <td>${inquiry.name}</td>
                            <td>${inquiry.email}</td>
                            <td>${inquiry.property_title || 'N/A'}</td>
                            <td>${inquiry.message.substring(0, 50)}...</td>
                            <td>${new Date(inquiry.created_at).toLocaleDateString()}</td>
                            <td>
                                <button class="btn btn-sm btn-primary" onclick="viewInquiry(${inquiry.id})">View</button>
                                <button class="btn btn-sm btn-success" onclick="replyInquiry(${inquiry.id})">Reply</button>
                            </td>
                        `;
                        tbody.appendChild(row);
                    });
                }
            })
            .catch(error => {
                console.error('Error loading inquiries:', error);
            });
        }

        function loadAppointments() {
            fetch('api/get-all-data.php')
            .then(response => response.json())
            .then(data => {
                if (data.success) {
                    const tbody = document.getElementById('appointmentsTableBody');
                    tbody.innerHTML = '';
                    
                    data.appointments.forEach(appointment => {
                        const row = document.createElement('tr');
                        row.innerHTML = `
                            <td>${appointment.client_name}</td>
                            <td>${appointment.property_title || 'N/A'}</td>
                            <td>${new Date(appointment.appointment_date).toLocaleDateString()}</td>
                            <td>${appointment.appointment_time}</td>
                            <td><span class="badge bg-${appointment.status === 'confirmed' ? 'success' : 'warning'}">${appointment.status}</span></td>
                            <td>
                                <button class="btn btn-sm btn-primary" onclick="viewAppointment(${appointment.id})">View</button>
                                <button class="btn btn-sm btn-success" onclick="confirmAppointment(${appointment.id})">Confirm</button>
                            </td>
                        `;
                        tbody.appendChild(row);
                    });
                }
            })
            .catch(error => {
                console.error('Error loading appointments:', error);
            });
        }

        function loadBlogPosts() {
            fetch('api/get-all-data.php')
            .then(response => response.json())
            .then(data => {
                if (data.success) {
                    const tbody = document.getElementById('blogTableBody');
                    tbody.innerHTML = '';
                    
                    data.blog_posts.forEach(post => {
                        const row = document.createElement('tr');
                        row.innerHTML = `
                            <td>${post.title}</td>
                            <td>${post.author || 'Admin'}</td>
                            <td><span class="badge bg-${post.status === 'published' ? 'success' : 'warning'}">${post.status}</span></td>
                            <td>${new Date(post.created_at).toLocaleDateString()}</td>
                            <td>
                                <button class="btn btn-sm btn-primary" onclick="editBlogPost(${post.id})">Edit</button>
                                <button class="btn btn-sm btn-danger" onclick="deleteBlogPost(${post.id})">Delete</button>
                            </td>
                        `;
                        tbody.appendChild(row);
                    });
                }
            })
            .catch(error => {
                console.error('Error loading blog posts:', error);
            });
        }

        // Action functions
        function editProperty(id) {
            // Implementation for editing property
            alert('Edit property functionality will be implemented');
        }

        function deleteProperty(id) {
            if (confirm('Are you sure you want to delete this property?')) {
                // Implementation for deleting property
                alert('Delete property functionality will be implemented');
            }
        }

        function editUser(id) {
            // Implementation for editing user
            alert('Edit user functionality will be implemented');
        }

        function deleteUser(id) {
            if (confirm('Are you sure you want to delete this user?')) {
                // Implementation for deleting user
                alert('Delete user functionality will be implemented');
            }
        }

        function viewInquiry(id) {
            alert('View inquiry functionality will be implemented');
        }

        function replyInquiry(id) {
            alert('Reply inquiry functionality will be implemented');
        }

        function viewAppointment(id) {
            alert('View appointment functionality will be implemented');
        }

        function confirmAppointment(id) {
            alert('Confirm appointment functionality will be implemented');
        }

        function editBlogPost(id) {
            alert('Edit blog post functionality will be implemented');
        }

        function deleteBlogPost(id) {
            if (confirm('Are you sure you want to delete this blog post?')) {
                alert('Delete blog post functionality will be implemented');
            }
        }

        // Load initial data
        document.addEventListener('DOMContentLoaded', function() {
            loadProperties();
        });
    </script>
</body>
</html>
