<?php
session_start();

// Debug: Log session data
error_log("Agent Dashboard - User ID: " . (isset($_SESSION['user_id']) ? $_SESSION['user_id'] : 'not set'));
error_log("Agent Dashboard - User Role: " . (isset($_SESSION['user_role']) ? $_SESSION['user_role'] : 'not set'));

// Check if user is logged in and is agent
if (!isset($_SESSION['user_id']) || $_SESSION['user_role'] !== 'agent') {
    error_log("Agent Dashboard - Access denied. Redirecting to login.");
    header('Location: login.php');
    exit;
}

$pageTitle = "Agent Dashboard";
$pageDescription = "Manage your properties and clients - Cool Homes Agent Portal.";
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Agent Dashboard - Cool Homes</title>
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
                <p>Agent Portal</p>
            </div>
            <div class="sidebar-menu">
                <a href="#dashboard" class="menu-item active" onclick="showSection('dashboard')">
                    <i class="fas fa-tachometer-alt"></i> Dashboard
                </a>
                <a href="#properties" class="menu-item" onclick="showSection('properties')">
                    <i class="fas fa-building"></i> My Properties
                </a>
                <a href="#clients" class="menu-item" onclick="showSection('clients')">
                    <i class="fas fa-users"></i> My Clients
                </a>
                <a href="#inquiries" class="menu-item" onclick="showSection('inquiries')">
                    <i class="fas fa-envelope"></i> Inquiries
                </a>
                <a href="#appointments" class="menu-item" onclick="showSection('appointments')">
                    <i class="fas fa-calendar"></i> Appointments
                </a>
                <a href="#reports" class="menu-item" onclick="showSection('reports')">
                    <i class="fas fa-chart-bar"></i> Reports
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
                    <h1>Welcome, <?php echo $_SESSION['user_name']; ?>!</h1>
                    <p>Real Estate Agent</p>
                </div>
                <div class="content-section">
                    <h3>Your Performance Overview</h3>
                    <div class="stats-grid">
                        <div class="stat-card">
                            <div class="stat-number">12</div>
                            <div class="stat-label">My Properties</div>
                        </div>
                        <div class="stat-card success">
                            <div class="stat-number">8</div>
                            <div class="stat-label">Active Listings</div>
                        </div>
                        <div class="stat-card warning">
                            <div class="stat-number">15</div>
                            <div class="stat-label">Total Clients</div>
                        </div>
                        <div class="stat-card danger">
                            <div class="stat-number">3</div>
                            <div class="stat-label">Pending Inquiries</div>
                        </div>
                    </div>
                    
                    <div class="row mt-4">
                        <div class="col-md-6">
                            <div class="card">
                                <div class="card-header">
                                    <h5>Recent Inquiries</h5>
                                </div>
                                <div class="card-body">
                                    <div class="inquiry-item">
                                        <strong>John Doe</strong> - Luxury Apartment in Westlands
                                        <small class="text-muted d-block">2 hours ago</small>
                                    </div>
                                    <div class="inquiry-item">
                                        <strong>Jane Smith</strong> - Modern Villa in Karen
                                        <small class="text-muted d-block">1 day ago</small>
                                    </div>
                                </div>
                            </div>
                        </div>
                        <div class="col-md-6">
                            <div class="card">
                                <div class="card-header">
                                    <h5>Upcoming Appointments</h5>
                                </div>
                                <div class="card-body">
                                    <div class="appointment-item">
                                        <strong>Property Viewing</strong> - Tomorrow 2:00 PM
                                        <small class="text-muted d-block">Luxury Apartment, Westlands</small>
                                    </div>
                                    <div class="appointment-item">
                                        <strong>Client Meeting</strong> - Friday 10:00 AM
                                        <small class="text-muted d-block">Office Meeting</small>
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
                        <h3>My Properties</h3>
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

            <!-- Clients Section -->
            <div id="clients-section" style="display: none;">
                <div class="content-section">
                    <div class="section-header">
                        <h3>My Clients</h3>
                        <button class="btn-primary" onclick="showAddClientModal()">
                            <i class="fas fa-plus"></i> Add New Client
                        </button>
                    </div>
                    <div class="table-responsive">
                        <table class="table" id="clients-table">
                            <thead>
                                <tr>
                                    <th>Name</th>
                                    <th>Email</th>
                                    <th>Phone</th>
                                    <th>Type</th>
                                    <th>Status</th>
                                    <th>Actions</th>
                                </tr>
                            </thead>
                            <tbody>
                                <!-- Clients will be loaded here -->
                            </tbody>
                        </table>
                    </div>
                </div>
            </div>

            <!-- Inquiries Section -->
            <div id="inquiries-section" style="display: none;">
                <div class="content-section">
                    <div class="section-header">
                        <h3>Property Inquiries</h3>
                    </div>
                    <div class="table-responsive">
                        <table class="table" id="inquiries-table">
                            <thead>
                                <tr>
                                    <th>Client Name</th>
                                    <th>Email</th>
                                    <th>Property</th>
                                    <th>Message</th>
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
                        <h3>My Appointments</h3>
                        <button class="btn-primary" onclick="showAddAppointmentModal()">
                            <i class="fas fa-plus"></i> Schedule Appointment
                        </button>
                    </div>
                    <div class="table-responsive">
                        <table class="table" id="appointments-table">
                            <thead>
                                <tr>
                                    <th>Client</th>
                                    <th>Property</th>
                                    <th>Date</th>
                                    <th>Time</th>
                                    <th>Type</th>
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

            <!-- Reports Section -->
            <div id="reports-section" style="display: none;">
                <div class="content-section">
                    <div class="section-header">
                        <h3>Performance Reports</h3>
                    </div>
                    <div class="row">
                        <div class="col-md-6">
                            <div class="card">
                                <div class="card-header">
                                    <h5>Monthly Performance</h5>
                                </div>
                                <div class="card-body">
                                    <canvas id="performanceChart" width="400" height="200"></canvas>
                                </div>
                            </div>
                        </div>
                        <div class="col-md-6">
                            <div class="card">
                                <div class="card-header">
                                    <h5>Property Types</h5>
                                </div>
                                <div class="card-body">
                                    <canvas id="propertyTypesChart" width="400" height="200"></canvas>
                                </div>
                            </div>
                        </div>
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

    <!-- Add Client Modal -->
    <div class="modal fade" id="addClientModal" tabindex="-1">
        <div class="modal-dialog modal-lg">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title">Add New Client</h5>
                    <button type="button" class="btn-close" data-bs-dismiss="modal"></button>
                </div>
                <div class="modal-body">
                    <form id="addClientForm" onsubmit="handleAddClient(event)">
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
                                    <label class="form-label">Client Type *</label>
                                    <select name="client_type" class="form-control" required>
                                        <option value="">Select Type</option>
                                        <option value="buyer">Buyer</option>
                                        <option value="seller">Seller</option>
                                        <option value="investor">Investor</option>
                                    </select>
                                </div>
                                <div class="mb-3">
                                    <label class="form-label">Budget Range</label>
                                    <input type="text" name="budget" class="form-control" placeholder="e.g., 5M - 10M">
                                </div>
                                <div class="mb-3">
                                    <label class="form-label">Preferred Location</label>
                                    <input type="text" name="preferred_location" class="form-control" placeholder="e.g., Westlands, Karen">
                                </div>
                            </div>
                        </div>
                        <div class="mb-3">
                            <label class="form-label">Notes</label>
                            <textarea name="notes" class="form-control" rows="3" placeholder="Client preferences, requirements, etc."></textarea>
                        </div>
                    </form>
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Cancel</button>
                    <button type="submit" form="addClientForm" class="btn-primary">Add Client</button>
                </div>
            </div>
        </div>
    </div>

    <!-- Add Appointment Modal -->
    <div class="modal fade" id="addAppointmentModal" tabindex="-1">
        <div class="modal-dialog modal-lg">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title">Schedule Appointment</h5>
                    <button type="button" class="btn-close" data-bs-dismiss="modal"></button>
                </div>
                <div class="modal-body">
                    <form id="addAppointmentForm" onsubmit="handleAddAppointment(event)">
                        <div class="row">
                            <div class="col-md-6">
                                <div class="mb-3">
                                    <label class="form-label">Client *</label>
                                    <select name="client_id" class="form-control" required>
                                        <option value="">Select Client</option>
                                        <!-- Clients will be loaded here -->
                                    </select>
                                </div>
                                <div class="mb-3">
                                    <label class="form-label">Property</label>
                                    <select name="property_id" class="form-control">
                                        <option value="">Select Property</option>
                                        <!-- Properties will be loaded here -->
                                    </select>
                                </div>
                            </div>
                            <div class="col-md-6">
                                <div class="mb-3">
                                    <label class="form-label">Date *</label>
                                    <input type="date" name="appointment_date" class="form-control" required>
                                </div>
                                <div class="mb-3">
                                    <label class="form-label">Time *</label>
                                    <input type="time" name="appointment_time" class="form-control" required>
                                </div>
                            </div>
                        </div>
                        <div class="mb-3">
                            <label class="form-label">Appointment Type *</label>
                            <select name="appointment_type" class="form-control" required>
                                <option value="">Select Type</option>
                                <option value="property_viewing">Property Viewing</option>
                                <option value="client_meeting">Client Meeting</option>
                                <option value="consultation">Consultation</option>
                                <option value="negotiation">Negotiation</option>
                            </select>
                        </div>
                        <div class="mb-3">
                            <label class="form-label">Notes</label>
                            <textarea name="notes" class="form-control" rows="3" placeholder="Appointment details, special instructions, etc."></textarea>
                        </div>
                    </form>
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Cancel</button>
                    <button type="submit" form="addAppointmentForm" class="btn-primary">Schedule Appointment</button>
                </div>
            </div>
        </div>
    </div>

    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/js/bootstrap.bundle.min.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/chart.js"></script>
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
                case 'clients':
                    loadClients();
                    break;
                case 'inquiries':
                    loadInquiries();
                    break;
                case 'appointments':
                    loadAppointments();
                    break;
                case 'reports':
                    loadReports();
                    break;
            }
        }

        // Load properties
        function loadProperties() {
            // Sample data - replace with actual API call
            const properties = [
                {
                    id: 1,
                    title: 'Luxury Apartment',
                    location: 'Westlands, Nairobi',
                    price: '8,500,000',
                    type: 'Apartment',
                    status: 'Available'
                },
                {
                    id: 2,
                    title: 'Modern Villa',
                    location: 'Karen, Nairobi',
                    price: '15,000,000',
                    type: 'Villa',
                    status: 'Available'
                }
            ];
            
            const tbody = document.querySelector('#properties-table tbody');
            tbody.innerHTML = '';
            
            properties.forEach(property => {
                const row = document.createElement('tr');
                row.innerHTML = `
                    <td>${property.title}</td>
                    <td>${property.location}</td>
                    <td>KSh ${property.price}</td>
                    <td>${property.type}</td>
                    <td><span class="badge badge-success">${property.status}</span></td>
                    <td>
                        <div class="action-buttons">
                            <button class="btn btn-outline-primary btn-sm" onclick="editProperty(${property.id})">Edit</button>
                            <button class="btn btn-outline-danger btn-sm" onclick="deleteProperty(${property.id})">Delete</button>
                        </div>
                    </td>
                `;
                tbody.appendChild(row);
            });
        }

        // Load clients
        function loadClients() {
            // Sample data - replace with actual API call
            const clients = [
                {
                    id: 1,
                    name: 'John Doe',
                    email: 'john@example.com',
                    phone: '0701234567',
                    type: 'Buyer',
                    status: 'Active'
                },
                {
                    id: 2,
                    name: 'Jane Smith',
                    email: 'jane@example.com',
                    phone: '0707654321',
                    type: 'Seller',
                    status: 'Active'
                }
            ];
            
            const tbody = document.querySelector('#clients-table tbody');
            tbody.innerHTML = '';
            
            clients.forEach(client => {
                const row = document.createElement('tr');
                row.innerHTML = `
                    <td>${client.name}</td>
                    <td>${client.email}</td>
                    <td>${client.phone}</td>
                    <td>${client.type}</td>
                    <td><span class="badge badge-success">${client.status}</span></td>
                    <td>
                        <div class="action-buttons">
                            <button class="btn btn-outline-primary btn-sm" onclick="editClient(${client.id})">Edit</button>
                            <button class="btn btn-outline-danger btn-sm" onclick="deleteClient(${client.id})">Delete</button>
                        </div>
                    </td>
                `;
                tbody.appendChild(row);
            });
        }

        // Load inquiries
        function loadInquiries() {
            const tbody = document.querySelector('#inquiries-table tbody');
            tbody.innerHTML = '<tr><td colspan="6" class="text-center">No inquiries found</td></tr>';
        }

        // Load appointments
        function loadAppointments() {
            const tbody = document.querySelector('#appointments-table tbody');
            tbody.innerHTML = '<tr><td colspan="7" class="text-center">No appointments found</td></tr>';
        }

        // Load reports
        function loadReports() {
            // Initialize charts
            initPerformanceChart();
            initPropertyTypesChart();
        }

        // Initialize performance chart
        function initPerformanceChart() {
            const ctx = document.getElementById('performanceChart').getContext('2d');
            new Chart(ctx, {
                type: 'line',
                data: {
                    labels: ['Jan', 'Feb', 'Mar', 'Apr', 'May', 'Jun'],
                    datasets: [{
                        label: 'Properties Sold',
                        data: [2, 3, 1, 4, 2, 3],
                        borderColor: 'rgb(75, 192, 192)',
                        tension: 0.1
                    }]
                },
                options: {
                    responsive: true,
                    scales: {
                        y: {
                            beginAtZero: true
                        }
                    }
                }
            });
        }

        // Initialize property types chart
        function initPropertyTypesChart() {
            const ctx = document.getElementById('propertyTypesChart').getContext('2d');
            new Chart(ctx, {
                type: 'doughnut',
                data: {
                    labels: ['Apartments', 'Houses', 'Villas', 'Commercial'],
                    datasets: [{
                        data: [5, 3, 2, 2],
                        backgroundColor: [
                            'rgb(255, 99, 132)',
                            'rgb(54, 162, 235)',
                            'rgb(255, 205, 86)',
                            'rgb(75, 192, 192)'
                        ]
                    }]
                },
                options: {
                    responsive: true
                }
            });
        }

        // Modal functions
        function showAddPropertyModal() {
            new bootstrap.Modal(document.getElementById('addPropertyModal')).show();
        }

        function showAddClientModal() {
            new bootstrap.Modal(document.getElementById('addClientModal')).show();
        }

        function showAddAppointmentModal() {
            new bootstrap.Modal(document.getElementById('addAppointmentModal')).show();
        }

        // Form handlers
        function handleAddProperty(event) {
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
            
            showNotification('success', 'Success', `Property "${title}" added successfully!`);
            bootstrap.Modal.getInstance(document.getElementById('addPropertyModal')).hide();
            form.reset();
            loadProperties();
        }

        function handleAddClient(event) {
            event.preventDefault();
            const form = event.target;
            const formData = new FormData(form);
            
            const name = formData.get('name');
            const email = formData.get('email');
            const clientType = formData.get('client_type');
            
            if (!name || !email || !clientType) {
                showNotification('error', 'Validation Error', 'Please fill in all required fields.');
                return;
            }
            
            showNotification('success', 'Success', `Client "${name}" added successfully!`);
            bootstrap.Modal.getInstance(document.getElementById('addClientModal')).hide();
            form.reset();
            loadClients();
        }

        function handleAddAppointment(event) {
            event.preventDefault();
            const form = event.target;
            const formData = new FormData(form);
            
            const clientId = formData.get('client_id');
            const date = formData.get('appointment_date');
            const time = formData.get('appointment_time');
            const type = formData.get('appointment_type');
            
            if (!clientId || !date || !time || !type) {
                showNotification('error', 'Validation Error', 'Please fill in all required fields.');
                return;
            }
            
            showNotification('success', 'Success', 'Appointment scheduled successfully!');
            bootstrap.Modal.getInstance(document.getElementById('addAppointmentModal')).hide();
            form.reset();
            loadAppointments();
        }

        // Image preview function
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
