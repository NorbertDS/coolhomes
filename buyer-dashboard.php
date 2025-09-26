<?php
session_start();

// Check if user is logged in and is buyer
if (!isset($_SESSION['user_id']) || $_SESSION['user_role'] !== 'buyer') {
    header('Location: login.php');
    exit;
}

$pageTitle = "Buyer Dashboard";
$pageDescription = "Find your dream home - Cool Homes Buyer Portal.";
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Buyer Dashboard - Cool Homes</title>
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
                <p>Buyer Portal</p>
            </div>
            <div class="sidebar-menu">
                <a href="#dashboard" class="menu-item active" onclick="showSection('dashboard')">
                    <i class="fas fa-tachometer-alt"></i> Dashboard
                </a>
                <a href="#search" class="menu-item" onclick="showSection('search')">
                    <i class="fas fa-search"></i> Search Properties
                </a>
                <a href="#favorites" class="menu-item" onclick="showSection('favorites')">
                    <i class="fas fa-heart"></i> My Favorites
                </a>
                <a href="#inquiries" class="menu-item" onclick="showSection('inquiries')">
                    <i class="fas fa-envelope"></i> My Inquiries
                </a>
                <a href="#appointments" class="menu-item" onclick="showSection('appointments')">
                    <i class="fas fa-calendar"></i> My Appointments
                </a>
                <a href="#calculator" class="menu-item" onclick="showSection('calculator')">
                    <i class="fas fa-calculator"></i> Mortgage Calculator
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
                    <p>Find Your Dream Home</p>
                </div>
                <div class="content-section">
                    <h3>Your Home Search Overview</h3>
                    <div class="stats-grid">
                        <div class="stat-card">
                            <div class="stat-number">8</div>
                            <div class="stat-label">Saved Properties</div>
                        </div>
                        <div class="stat-card success">
                            <div class="stat-number">3</div>
                            <div class="stat-label">Active Inquiries</div>
                        </div>
                        <div class="stat-card warning">
                            <div class="stat-number">2</div>
                            <div class="stat-label">Upcoming Viewings</div>
                        </div>
                        <div class="stat-card danger">
                            <div class="stat-number">1</div>
                            <div class="stat-label">Pending Offers</div>
                        </div>
                    </div>
                    
                    <div class="row mt-4">
                        <div class="col-md-6">
                            <div class="card">
                                <div class="card-header">
                                    <h5>Recent Searches</h5>
                                </div>
                                <div class="card-body">
                                    <div class="search-item">
                                        <strong>3 Bedroom Apartments</strong> in Westlands
                                        <small class="text-muted d-block">Budget: 5M - 10M</small>
                                    </div>
                                    <div class="search-item">
                                        <strong>Modern Houses</strong> in Karen
                                        <small class="text-muted d-block">Budget: 10M - 20M</small>
                                    </div>
                                </div>
                            </div>
                        </div>
                        <div class="col-md-6">
                            <div class="card">
                                <div class="card-header">
                                    <h5>Recommended Properties</h5>
                                </div>
                                <div class="card-body">
                                    <div class="property-item">
                                        <strong>Luxury Apartment</strong> - Westlands
                                        <small class="text-muted d-block">KSh 8,500,000</small>
                                    </div>
                                    <div class="property-item">
                                        <strong>Modern Villa</strong> - Karen
                                        <small class="text-muted d-block">KSh 15,000,000</small>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>

            <!-- Search Section -->
            <div id="search-section" style="display: none;">
                <div class="content-section">
                    <div class="section-header">
                        <h3>Search Properties</h3>
                    </div>
                    
                    <!-- Search Filters -->
                    <div class="card mb-4">
                        <div class="card-header">
                            <h5>Search Filters</h5>
                        </div>
                        <div class="card-body">
                            <form id="searchForm" onsubmit="searchProperties(event)">
                                <div class="row">
                                    <div class="col-md-3">
                                        <div class="mb-3">
                                            <label class="form-label">Location</label>
                                            <input type="text" name="location" class="form-control" placeholder="e.g., Westlands, Karen">
                                        </div>
                                    </div>
                                    <div class="col-md-3">
                                        <div class="mb-3">
                                            <label class="form-label">Property Type</label>
                                            <select name="type" class="form-control">
                                                <option value="">All Types</option>
                                                <option value="apartment">Apartment</option>
                                                <option value="house">House</option>
                                                <option value="villa">Villa</option>
                                                <option value="commercial">Commercial</option>
                                            </select>
                                        </div>
                                    </div>
                                    <div class="col-md-3">
                                        <div class="mb-3">
                                            <label class="form-label">Min Price (KSh)</label>
                                            <input type="number" name="min_price" class="form-control" placeholder="0">
                                        </div>
                                    </div>
                                    <div class="col-md-3">
                                        <div class="mb-3">
                                            <label class="form-label">Max Price (KSh)</label>
                                            <input type="number" name="max_price" class="form-control" placeholder="No limit">
                                        </div>
                                    </div>
                                </div>
                                <div class="row">
                                    <div class="col-md-2">
                                        <div class="mb-3">
                                            <label class="form-label">Bedrooms</label>
                                            <select name="bedrooms" class="form-control">
                                                <option value="">Any</option>
                                                <option value="1">1+</option>
                                                <option value="2">2+</option>
                                                <option value="3">3+</option>
                                                <option value="4">4+</option>
                                            </select>
                                        </div>
                                    </div>
                                    <div class="col-md-2">
                                        <div class="mb-3">
                                            <label class="form-label">Bathrooms</label>
                                            <select name="bathrooms" class="form-control">
                                                <option value="">Any</option>
                                                <option value="1">1+</option>
                                                <option value="2">2+</option>
                                                <option value="3">3+</option>
                                            </select>
                                        </div>
                                    </div>
                                    <div class="col-md-2">
                                        <div class="mb-3">
                                            <label class="form-label">Min Area (sq ft)</label>
                                            <input type="number" name="min_area" class="form-control" placeholder="0">
                                        </div>
                                    </div>
                                    <div class="col-md-6">
                                        <div class="mb-3">
                                            <label class="form-label">Keywords</label>
                                            <input type="text" name="keywords" class="form-control" placeholder="e.g., swimming pool, garden, security">
                                        </div>
                                    </div>
                                </div>
                                <div class="text-center">
                                    <button type="submit" class="btn-primary">
                                        <i class="fas fa-search"></i> Search Properties
                                    </button>
                                    <button type="button" class="btn btn-outline-secondary ms-2" onclick="clearFilters()">
                                        <i class="fas fa-times"></i> Clear Filters
                                    </button>
                                </div>
                            </form>
                        </div>
                    </div>
                    
                    <!-- Search Results -->
                    <div class="card">
                        <div class="card-header">
                            <h5>Search Results</h5>
                        </div>
                        <div class="card-body">
                            <div id="search-results">
                                <!-- Search results will be loaded here -->
                            </div>
                        </div>
                    </div>
                </div>
            </div>

            <!-- Favorites Section -->
            <div id="favorites-section" style="display: none;">
                <div class="content-section">
                    <div class="section-header">
                        <h3>My Favorite Properties</h3>
                    </div>
                    <div class="row" id="favorites-grid">
                        <!-- Favorite properties will be loaded here -->
                    </div>
                </div>
            </div>

            <!-- Inquiries Section -->
            <div id="inquiries-section" style="display: none;">
                <div class="content-section">
                    <div class="section-header">
                        <h3>My Property Inquiries</h3>
                    </div>
                    <div class="table-responsive">
                        <table class="table" id="inquiries-table">
                            <thead>
                                <tr>
                                    <th>Property</th>
                                    <th>Message</th>
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
                        <h3>My Property Viewings</h3>
                    </div>
                    <div class="table-responsive">
                        <table class="table" id="appointments-table">
                            <thead>
                                <tr>
                                    <th>Property</th>
                                    <th>Date</th>
                                    <th>Time</th>
                                    <th>Agent</th>
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

            <!-- Calculator Section -->
            <div id="calculator-section" style="display: none;">
                <div class="content-section">
                    <div class="section-header">
                        <h3>Mortgage Calculator</h3>
                    </div>
                    <div class="row">
                        <div class="col-md-6">
                            <div class="card">
                                <div class="card-header">
                                    <h5>Calculate Your Mortgage</h5>
                                </div>
                                <div class="card-body">
                                    <form id="mortgageForm" onsubmit="calculateMortgage(event)">
                                        <div class="mb-3">
                                            <label class="form-label">Property Price (KSh)</label>
                                            <input type="number" name="property_price" class="form-control" required>
                                        </div>
                                        <div class="mb-3">
                                            <label class="form-label">Down Payment (KSh)</label>
                                            <input type="number" name="down_payment" class="form-control" required>
                                        </div>
                                        <div class="mb-3">
                                            <label class="form-label">Interest Rate (%)</label>
                                            <input type="number" name="interest_rate" class="form-control" step="0.1" value="12.5" required>
                                        </div>
                                        <div class="mb-3">
                                            <label class="form-label">Loan Term (Years)</label>
                                            <select name="loan_term" class="form-control" required>
                                                <option value="5">5 Years</option>
                                                <option value="10">10 Years</option>
                                                <option value="15">15 Years</option>
                                                <option value="20">20 Years</option>
                                                <option value="25">25 Years</option>
                                                <option value="30">30 Years</option>
                                            </select>
                                        </div>
                                        <button type="submit" class="btn-primary w-100">
                                            <i class="fas fa-calculator"></i> Calculate
                                        </button>
                                    </form>
                                </div>
                            </div>
                        </div>
                        <div class="col-md-6">
                            <div class="card">
                                <div class="card-header">
                                    <h5>Mortgage Results</h5>
                                </div>
                                <div class="card-body">
                                    <div id="mortgage-results" class="text-center">
                                        <p class="text-muted">Enter property details to calculate your mortgage</p>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </main>
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
                case 'search':
                    loadSearchResults();
                    break;
                case 'favorites':
                    loadFavorites();
                    break;
                case 'inquiries':
                    loadInquiries();
                    break;
                case 'appointments':
                    loadAppointments();
                    break;
            }
        }

        // Search properties
        function searchProperties(event) {
            event.preventDefault();
            const form = event.target;
            const formData = new FormData(form);
            
            // Sample search results
            const results = [
                {
                    id: 1,
                    title: 'Luxury Apartment',
                    location: 'Westlands, Nairobi',
                    price: '8,500,000',
                    type: 'Apartment',
                    bedrooms: 3,
                    bathrooms: 2,
                    area: 1200,
                    image: 'https://via.placeholder.com/300x200'
                },
                {
                    id: 2,
                    title: 'Modern Villa',
                    location: 'Karen, Nairobi',
                    price: '15,000,000',
                    type: 'Villa',
                    bedrooms: 4,
                    bathrooms: 3,
                    area: 2500,
                    image: 'https://via.placeholder.com/300x200'
                }
            ];
            
            displaySearchResults(results);
        }

        // Display search results
        function displaySearchResults(results) {
            const container = document.getElementById('search-results');
            container.innerHTML = '';
            
            if (results.length === 0) {
                container.innerHTML = '<p class="text-center text-muted">No properties found matching your criteria.</p>';
                return;
            }
            
            results.forEach(property => {
                const propertyCard = document.createElement('div');
                propertyCard.className = 'col-md-4 mb-4';
                propertyCard.innerHTML = `
                    <div class="card property-card">
                        <img src="${property.image}" class="card-img-top" alt="${property.title}">
                        <div class="card-body">
                            <h5 class="card-title">${property.title}</h5>
                            <p class="card-text text-muted">${property.location}</p>
                            <p class="card-text"><strong>KSh ${Number(property.price).toLocaleString()}</strong></p>
                            <p class="card-text">
                                <small class="text-muted">
                                    ${property.bedrooms} bed • ${property.bathrooms} bath • ${property.area} sq ft
                                </small>
                            </p>
                            <div class="d-flex justify-content-between">
                                <button class="btn btn-outline-primary btn-sm" onclick="viewProperty(${property.id})">
                                    <i class="fas fa-eye"></i> View
                                </button>
                                <button class="btn btn-outline-danger btn-sm" onclick="toggleFavorite(${property.id})">
                                    <i class="fas fa-heart"></i> Favorite
                                </button>
                            </div>
                        </div>
                    </div>
                `;
                container.appendChild(propertyCard);
            });
        }

        // Load favorites
        function loadFavorites() {
            const container = document.getElementById('favorites-grid');
            container.innerHTML = '<div class="col-12"><p class="text-center text-muted">No favorite properties yet.</p></div>';
        }

        // Load inquiries
        function loadInquiries() {
            const tbody = document.querySelector('#inquiries-table tbody');
            tbody.innerHTML = '<tr><td colspan="5" class="text-center">No inquiries found</td></tr>';
        }

        // Load appointments
        function loadAppointments() {
            const tbody = document.querySelector('#appointments-table tbody');
            tbody.innerHTML = '<tr><td colspan="6" class="text-center">No appointments found</td></tr>';
        }

        // Mortgage calculator
        function calculateMortgage(event) {
            event.preventDefault();
            const form = event.target;
            const formData = new FormData(form);
            
            const propertyPrice = parseFloat(formData.get('property_price'));
            const downPayment = parseFloat(formData.get('down_payment'));
            const interestRate = parseFloat(formData.get('interest_rate')) / 100;
            const loanTerm = parseInt(formData.get('loan_term'));
            
            const loanAmount = propertyPrice - downPayment;
            const monthlyRate = interestRate / 12;
            const numberOfPayments = loanTerm * 12;
            
            const monthlyPayment = (loanAmount * monthlyRate * Math.pow(1 + monthlyRate, numberOfPayments)) / 
                                 (Math.pow(1 + monthlyRate, numberOfPayments) - 1);
            
            const totalPayment = monthlyPayment * numberOfPayments;
            const totalInterest = totalPayment - loanAmount;
            
            const results = document.getElementById('mortgage-results');
            results.innerHTML = `
                <div class="mortgage-result">
                    <h4>Monthly Payment</h4>
                    <h2 class="text-primary">KSh ${Math.round(monthlyPayment).toLocaleString()}</h2>
                </div>
                <hr>
                <div class="mortgage-details">
                    <div class="row">
                        <div class="col-6">
                            <strong>Loan Amount:</strong><br>
                            KSh ${loanAmount.toLocaleString()}
                        </div>
                        <div class="col-6">
                            <strong>Total Interest:</strong><br>
                            KSh ${Math.round(totalInterest).toLocaleString()}
                        </div>
                    </div>
                    <div class="row mt-2">
                        <div class="col-6">
                            <strong>Total Payment:</strong><br>
                            KSh ${Math.round(totalPayment).toLocaleString()}
                        </div>
                        <div class="col-6">
                            <strong>Loan Term:</strong><br>
                            ${loanTerm} years
                        </div>
                    </div>
                </div>
            `;
        }

        // Clear search filters
        function clearFilters() {
            document.getElementById('searchForm').reset();
            document.getElementById('search-results').innerHTML = '';
        }

        // Property actions
        function viewProperty(propertyId) {
            showNotification('info', 'Info', `Viewing property #${propertyId}`);
        }

        function toggleFavorite(propertyId) {
            showNotification('success', 'Success', `Property #${propertyId} added to favorites!`);
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
            loadSearchResults();
        });
    </script>
</body>
</html>
