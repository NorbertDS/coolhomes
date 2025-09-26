<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Admin Dashboard - Cool Homes</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">
    <link href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0/css/all.min.css" rel="stylesheet">
    <link href="https://fonts.googleapis.com/css2?family=Inter:wght@300;400;500;600;700&display=swap" rel="stylesheet">
    <style>
        :root {
            --primary-color: #2563eb;
            --secondary-color: #64748b;
            --success-color: #10b981;
            --warning-color: #f59e0b;
            --danger-color: #ef4444;
            --light-color: #f8fafc;
            --dark-color: #1e293b;
        }

        * {
            margin: 0;
            padding: 0;
            box-sizing: border-box;
        }

        body {
            font-family: 'Inter', sans-serif;
            background-color: #f1f5f9;
            color: var(--dark-color);
        }

        .sidebar {
            position: fixed;
            top: 0;
            left: 0;
            height: 100vh;
            width: 280px;
            background: linear-gradient(135deg, var(--primary-color), #1d4ed8);
            color: white;
            padding: 0;
            z-index: 1000;
            overflow-y: auto;
        }

        .sidebar-header {
            padding: 2rem 1.5rem;
            border-bottom: 1px solid rgba(255,255,255,0.1);
        }

        .sidebar-header h3 {
            font-weight: 700;
            margin-bottom: 0.5rem;
        }

        .sidebar-header p {
            opacity: 0.8;
            font-size: 0.9rem;
        }

        .sidebar-menu {
            padding: 1rem 0;
        }

        .menu-item {
            display: block;
            padding: 1rem 1.5rem;
            color: white;
            text-decoration: none;
            transition: all 0.3s ease;
            border-left: 3px solid transparent;
        }

        .menu-item:hover {
            background: rgba(255,255,255,0.1);
            border-left-color: white;
            color: white;
        }

        .menu-item.active {
            background: rgba(255,255,255,0.15);
            border-left-color: white;
        }

        .menu-item i {
            width: 20px;
            margin-right: 0.75rem;
        }

        .main-content {
            margin-left: 280px;
            padding: 2rem;
            min-height: 100vh;
        }

        .dashboard-header {
            background: white;
            padding: 1.5rem 2rem;
            border-radius: 10px;
            box-shadow: 0 2px 10px rgba(0,0,0,0.1);
            margin-bottom: 2rem;
            display: flex;
            justify-content: space-between;
            align-items: center;
        }

        .dashboard-header h1 {
            color: var(--dark-color);
            font-weight: 700;
            margin: 0;
        }

        .user-info {
            display: flex;
            align-items: center;
            gap: 1rem;
        }

        .user-avatar {
            width: 40px;
            height: 40px;
            border-radius: 50%;
            background: var(--primary-color);
            display: flex;
            align-items: center;
            justify-content: center;
            color: white;
            font-weight: 600;
        }

        .stats-grid {
            display: grid;
            grid-template-columns: repeat(auto-fit, minmax(250px, 1fr));
            gap: 1.5rem;
            margin-bottom: 2rem;
        }

        .stat-card {
            background: white;
            padding: 1.5rem;
            border-radius: 10px;
            box-shadow: 0 2px 10px rgba(0,0,0,0.1);
            border-left: 4px solid var(--primary-color);
        }

        .stat-card.success {
            border-left-color: var(--success-color);
        }

        .stat-card.warning {
            border-left-color: var(--warning-color);
        }

        .stat-card.danger {
            border-left-color: var(--danger-color);
        }

        .stat-number {
            font-size: 2rem;
            font-weight: 700;
            color: var(--dark-color);
            margin-bottom: 0.5rem;
        }

        .stat-label {
            color: var(--secondary-color);
            font-size: 0.9rem;
            text-transform: uppercase;
            letter-spacing: 0.5px;
        }

        .content-section {
            background: white;
            border-radius: 10px;
            box-shadow: 0 2px 10px rgba(0,0,0,0.1);
            margin-bottom: 2rem;
        }

        .section-header {
            padding: 1.5rem 2rem;
            border-bottom: 1px solid #e2e8f0;
            display: flex;
            justify-content: space-between;
            align-items: center;
        }

        .section-title {
            font-size: 1.25rem;
            font-weight: 600;
            color: var(--dark-color);
            margin: 0;
        }

        .btn-primary {
            background: var(--primary-color);
            border: none;
            padding: 0.5rem 1rem;
            border-radius: 6px;
            color: white;
            text-decoration: none;
            display: inline-flex;
            align-items: center;
            gap: 0.5rem;
            transition: all 0.3s ease;
        }

        .btn-primary:hover {
            background: #1d4ed8;
            color: white;
        }

        .table-responsive {
            border-radius: 0 0 10px 10px;
            overflow: hidden;
        }

        .table {
            margin: 0;
        }

        .table th {
            background: var(--light-color);
            border: none;
            padding: 1rem;
            font-weight: 600;
            color: var(--dark-color);
        }

        .table td {
            padding: 1rem;
            border: none;
            border-bottom: 1px solid #e2e8f0;
        }

        .badge {
            padding: 0.4rem 0.8rem;
            border-radius: 20px;
            font-size: 0.8rem;
            font-weight: 500;
        }

        .badge-success {
            background: #d1fae5;
            color: #065f46;
        }

        .badge-warning {
            background: #fef3c7;
            color: #92400e;
        }

        .badge-danger {
            background: #fee2e2;
            color: #991b1b;
        }

        .badge-info {
            background: #dbeafe;
            color: #1e40af;
        }

        .action-buttons {
            display: flex;
            gap: 0.5rem;
        }

        .btn-sm {
            padding: 0.25rem 0.5rem;
            font-size: 0.8rem;
            border-radius: 4px;
        }

        .btn-outline-primary {
            border: 1px solid var(--primary-color);
            color: var(--primary-color);
            background: transparent;
        }

        .btn-outline-danger {
            border: 1px solid var(--danger-color);
            color: var(--danger-color);
            background: transparent;
        }

        .btn-outline-success {
            border: 1px solid var(--success-color);
            color: var(--success-color);
            background: transparent;
        }

        .modal-content {
            border: none;
            border-radius: 10px;
        }

        .modal-header {
            background: var(--light-color);
            border-bottom: 1px solid #e2e8f0;
            border-radius: 10px 10px 0 0;
        }

        .form-control {
            border: 1px solid #d1d5db;
            border-radius: 6px;
            padding: 0.75rem;
        }

        .form-control:focus {
            border-color: var(--primary-color);
            box-shadow: 0 0 0 0.2rem rgba(37, 99, 235, 0.25);
        }

        .form-label {
            font-weight: 500;
            color: var(--dark-color);
            margin-bottom: 0.5rem;
        }

        .chart-container {
            height: 300px;
            padding: 1rem;
        }

        .recent-activity {
            max-height: 400px;
            overflow-y: auto;
        }

        .activity-item {
            padding: 1rem;
            border-bottom: 1px solid #e2e8f0;
            display: flex;
            align-items: center;
            gap: 1rem;
        }

        .activity-item:last-child {
            border-bottom: none;
        }

        .activity-icon {
            width: 40px;
            height: 40px;
            border-radius: 50%;
            display: flex;
            align-items: center;
            justify-content: center;
            color: white;
            font-size: 0.9rem;
        }

        .activity-content {
            flex: 1;
        }

        .activity-title {
            font-weight: 500;
            color: var(--dark-color);
            margin-bottom: 0.25rem;
        }

        .activity-time {
            color: var(--secondary-color);
            font-size: 0.8rem;
        }

        @media (max-width: 768px) {
            .sidebar {
                transform: translateX(-100%);
                transition: transform 0.3s ease;
            }

            .sidebar.open {
                transform: translateX(0);
            }

            .main-content {
                margin-left: 0;
                padding: 1rem;
            }

            .dashboard-header {
                padding: 1rem;
            }

            .stats-grid {
                grid-template-columns: 1fr;
            }
        }
    </style>
</head>
<body>
            <!-- Sidebar -->
    <nav class="sidebar">
        <div class="sidebar-header">
            <h3><i class="fas fa-home"></i> Cool Homes</h3>
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
            <a href="#analytics" class="menu-item" onclick="showSection('analytics')">
                <i class="fas fa-chart-bar"></i> Analytics
            </a>
            <a href="#content" class="menu-item" onclick="showSection('content')">
                <i class="fas fa-edit"></i> Content
            </a>
            <a href="#blog" class="menu-item" onclick="showSection('blog')">
                <i class="fas fa-blog"></i> Blog
            </a>
            <a href="#finance" class="menu-item" onclick="showSection('finance')">
                <i class="fas fa-dollar-sign"></i> Finance
            </a>
            <a href="#settings" class="menu-item" onclick="showSection('settings')">
                <i class="fas fa-cog"></i> Settings
            </a>
            <a href="index" class="menu-item">
                <i class="fas fa-external-link-alt"></i> View Website
            </a>
            <a href="#" class="menu-item" onclick="logout()">
                <i class="fas fa-sign-out-alt"></i> Logout
            </a>
                </div>
    </nav>

            <!-- Main Content -->
    <div class="main-content">
        <!-- Dashboard Header -->
        <div class="dashboard-header">
            <h1 id="page-title">Dashboard Overview</h1>
            <div class="user-info">
                <div class="user-avatar">N</div>
                        <div>
                    <div style="font-weight: 600;">Norbert</div>
                    <div style="font-size: 0.8rem; color: var(--secondary-color);">Cool Homes Founder</div>
                        </div>
                        </div>
                    </div>

        <!-- Dashboard Section -->
        <div id="dashboard-section">
            <!-- Stats Grid -->
            <div class="stats-grid">
                <div class="stat-card">
                    <div class="stat-number">24</div>
                    <div class="stat-label">Total Properties</div>
                                            </div>
                <div class="stat-card success">
                    <div class="stat-number">18</div>
                    <div class="stat-label">Active Listings</div>
                                            </div>
                <div class="stat-card warning">
                    <div class="stat-number">156</div>
                    <div class="stat-label">Total Inquiries</div>
                                        </div>
                <div class="stat-card danger">
                    <div class="stat-number">42</div>
                    <div class="stat-label">Pending Appointments</div>
                                    </div>
                                </div>

            <!-- Recent Activity -->
            <div class="content-section">
                <div class="section-header">
                    <h3 class="section-title">Recent Activity</h3>
                            </div>
                <div class="recent-activity">
                    <div class="activity-item">
                        <div class="activity-icon" style="background: var(--success-color);">
                            <i class="fas fa-plus"></i>
                                            </div>
                        <div class="activity-content">
                            <div class="activity-title">New property added: Luxury Villa in Karen</div>
                            <div class="activity-time">2 hours ago</div>
                                            </div>
                                        </div>
                    <div class="activity-item">
                        <div class="activity-icon" style="background: var(--primary-color);">
                            <i class="fas fa-envelope"></i>
                                    </div>
                        <div class="activity-content">
                            <div class="activity-title">New inquiry received for Westlands Apartment</div>
                            <div class="activity-time">4 hours ago</div>
                                </div>
                            </div>
                    <div class="activity-item">
                        <div class="activity-icon" style="background: var(--warning-color);">
                            <i class="fas fa-calendar"></i>
                                            </div>
                        <div class="activity-content">
                            <div class="activity-title">Appointment scheduled for tomorrow</div>
                            <div class="activity-time">6 hours ago</div>
                                            </div>
                                        </div>
                    <div class="activity-item">
                        <div class="activity-icon" style="background: var(--danger-color);">
                            <i class="fas fa-user"></i>
                                    </div>
                        <div class="activity-content">
                            <div class="activity-title">New agent registered: Sarah Kimani</div>
                            <div class="activity-time">1 day ago</div>
                                </div>
                            </div>
                                </div>
                            </div>
                        </div>

        <!-- Properties Section -->
        <div id="properties-section" style="display: none;">
            <div class="content-section">
                <div class="section-header">
                    <h3 class="section-title">Property Management</h3>
                    <button class="btn-primary" onclick="showAddPropertyModal()">
                        <i class="fas fa-plus"></i> Add Property
                    </button>
                                    </div>
                <div class="table-responsive">
                    <table class="table">
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
                        <tbody>
                            <tr>
                                <td>
                                    <div style="display: flex; align-items: center; gap: 1rem;">
                                        <img src="26-Mzizi-Court.webp" alt="Property" style="width: 60px; height: 60px; object-fit: cover; border-radius: 6px;">
                                        <div>
                                            <div style="font-weight: 600;">Luxury Apartment</div>
                                            <div style="font-size: 0.8rem; color: var(--secondary-color);">3 Beds, 2 Baths</div>
                                                    </div>
                                                    </div>
                                </td>
                                <td>Westlands, Nairobi</td>
                                <td>KSh 8,500,000</td>
                                <td><span class="badge badge-success">Active</span></td>
                                <td>1,234</td>
                                <td>
                                    <div class="action-buttons">
                                        <button class="btn btn-outline-primary btn-sm" onclick="editProperty('prop1')">Edit</button>
                                        <button class="btn btn-outline-danger btn-sm" onclick="deleteProperty('prop1')">Delete</button>
                                                </div>
                                </td>
                            </tr>
                            <tr>
                                <td>
                                    <div style="display: flex; align-items: center; gap: 1rem;">
                                        <img src="Loft-Residences.webp" alt="Property" style="width: 60px; height: 60px; object-fit: cover; border-radius: 6px;">
                                        <div>
                                            <div style="font-weight: 600;">Modern Villa</div>
                                            <div style="font-size: 0.8rem; color: var(--secondary-color);">4 Beds, 3 Baths</div>
                                            </div>
                                                    </div>
                                </td>
                                <td>Karen, Nairobi</td>
                                <td>KSh 15,000,000</td>
                                <td><span class="badge badge-success">Active</span></td>
                                <td>856</td>
                                <td>
                                    <div class="action-buttons">
                                        <button class="btn btn-outline-primary btn-sm" onclick="editProperty('prop2')">Edit</button>
                                        <button class="btn btn-outline-danger btn-sm" onclick="deleteProperty('prop2')">Delete</button>
                                                    </div>
                                </td>
                            </tr>
                        </tbody>
                    </table>
                                                </div>
                                            </div>
                                                    </div>

        <!-- Users Section -->
        <div id="users-section" style="display: none;">
            <div class="content-section">
                <div class="section-header">
                    <h3 class="section-title">User Management</h3>
                    <button class="btn-primary" onclick="showAddUserModal()">
                        <i class="fas fa-plus"></i> Add User
                    </button>
                                                    </div>
                <div class="table-responsive">
                    <table class="table">
                        <thead>
                            <tr>
                                <th>User</th>
                                <th>Role</th>
                                <th>Email</th>
                                <th>Status</th>
                                <th>Last Login</th>
                                <th>Actions</th>
                            </tr>
                        </thead>
                        <tbody>
                            <tr>
                                <td>
                                    <div style="display: flex; align-items: center; gap: 1rem;">
                                        <div class="user-avatar" style="width: 40px; height: 40px;">N</div>
                                        <div>
                                            <div style="font-weight: 600;">Norbert</div>
                                            <div style="font-size: 0.8rem; color: var(--secondary-color);">Founder</div>
                                                </div>
                                            </div>
                                </td>
                                <td><span class="badge badge-info">Admin</span></td>
                                <td>admin@coolhomes.co.ke</td>
                                <td><span class="badge badge-success">Active</span></td>
                                <td>2 hours ago</td>
                                <td>
                                    <div class="action-buttons">
                                        <button class="btn btn-outline-primary btn-sm" onclick="editUser('user1')">Edit</button>
                                        <button class="btn btn-outline-danger btn-sm" onclick="deactivateUser('user1')">Deactivate</button>
                                        </div>
                                </td>
                            </tr>
                            <tr>
                                <td>
                                    <div style="display: flex; align-items: center; gap: 1rem;">
                                        <div class="user-avatar" style="width: 40px; height: 40px;">S</div>
                                        <div>
                                            <div style="font-weight: 600;">Sarah Kimani</div>
                                            <div style="font-size: 0.8rem; color: var(--secondary-color);">Agent</div>
                                    </div>
                                </div>
                                </td>
                                <td><span class="badge badge-warning">Agent</span></td>
                                <td>sarah@coolhomes.co.ke</td>
                                <td><span class="badge badge-success">Active</span></td>
                                <td>1 day ago</td>
                                <td>
                                    <div class="action-buttons">
                                        <button class="btn btn-outline-primary btn-sm" onclick="editUser('user2')">Edit</button>
                                        <button class="btn btn-outline-danger btn-sm" onclick="deactivateUser('user2')">Deactivate</button>
                            </div>
                                </td>
                            </tr>
                        </tbody>
                    </table>
                            </div>
                        </div>
                    </div>

                    <!-- Inquiries Section -->
                    <div id="inquiries-section" style="display: none;">
            <div class="content-section">
                <div class="section-header">
                    <h3 class="section-title">Inquiry Management</h3>
                            </div>
                                <div class="table-responsive">
                    <table class="table">
                                        <thead>
                                            <tr>
                                <th>Name</th>
                                <th>Email</th>
                                                <th>Property</th>
                                                <th>Type</th>
                                                <th>Date</th>
                                <th>Status</th>
                                                <th>Actions</th>
                                            </tr>
                                        </thead>
                                        <tbody>
                                            <tr>
                                <td>John Mwangi</td>
                                <td>john@email.com</td>
                                <td>Luxury Apartment</td>
                                <td>Purchase</td>
                                <td>2 hours ago</td>
                                <td><span class="badge badge-warning">New</span></td>
                                <td>
                                    <div class="action-buttons">
                                        <button class="btn btn-outline-primary btn-sm" onclick="viewInquiry('inq1')">View</button>
                                        <button class="btn btn-outline-success btn-sm" onclick="replyToInquiry('inq1')">Reply</button>
                                    </div>
                                                </td>
                                            </tr>
                                            <tr>
                                <td>Mary Wanjiku</td>
                                <td>mary@email.com</td>
                                <td>Modern Villa</td>
                                <td>Rental</td>
                                <td>1 day ago</td>
                                <td><span class="badge badge-success">Replied</span></td>
                                <td>
                                    <div class="action-buttons">
                                        <button class="btn btn-outline-primary btn-sm" onclick="viewInquiry('inq2')">View</button>
                                        <button class="btn btn-outline-success btn-sm" onclick="replyToInquiry('inq2')">Reply</button>
                                    </div>
                                                </td>
                                            </tr>
                                        </tbody>
                                    </table>
                            </div>
                        </div>
                    </div>

                    <!-- Appointments Section -->
                    <div id="appointments-section" style="display: none;">
            <div class="content-section">
                <div class="section-header">
                    <h3 class="section-title">Appointment Management</h3>
                            </div>
                                <div class="table-responsive">
                    <table class="table">
                                        <thead>
                                            <tr>
                                <th>Client</th>
                                                <th>Property</th>
                                                <th>Date & Time</th>
                                <th>Agent</th>
                                                <th>Status</th>
                                                <th>Actions</th>
                                            </tr>
                                        </thead>
                                        <tbody>
                                            <tr>
                                <td>Peter Kiprop</td>
                                <td>Luxury Apartment</td>
                                <td>Tomorrow, 2:00 PM</td>
                                <td>Sarah Kimani</td>
                                <td><span class="badge badge-warning">Scheduled</span></td>
                                <td>
                                    <div class="action-buttons">
                                        <button class="btn btn-outline-primary btn-sm" onclick="viewAppointment('apt1')">View</button>
                                        <button class="btn btn-outline-success btn-sm" onclick="confirmAppointment('apt1')">Confirm</button>
                                    </div>
                                                </td>
                                            </tr>
                                            <tr>
                                <td>Grace Akinyi</td>
                                <td>Modern Villa</td>
                                <td>Friday, 10:00 AM</td>
                                <td>Sarah Kimani</td>
                                <td><span class="badge badge-success">Confirmed</span></td>
                                <td>
                                    <div class="action-buttons">
                                        <button class="btn btn-outline-primary btn-sm" onclick="viewAppointment('apt2')">View</button>
                                        <button class="btn btn-outline-danger btn-sm" onclick="cancelAppointment('apt2')">Cancel</button>
                                    </div>
                                                </td>
                                            </tr>
                                        </tbody>
                                    </table>
                </div>
            </div>
        </div>

        <!-- Analytics Section -->
        <div id="analytics-section" style="display: none;">
            <div class="content-section">
                <div class="section-header">
                    <h3 class="section-title">Analytics & Reports</h3>
                </div>
                <div class="chart-container">
                    <div style="text-align: center; padding: 2rem; color: var(--secondary-color);">
                        <i class="fas fa-chart-bar" style="font-size: 3rem; margin-bottom: 1rem;"></i>
                        <h4>Analytics Dashboard</h4>
                        <p>Property views, conversion rates, and performance metrics will be displayed here.</p>
                                </div>
                            </div>
                        </div>
                    </div>

        <!-- Content Section -->
        <div id="content-section" style="display: none;">
            <div class="content-section">
                <div class="section-header">
                    <h3 class="section-title">Content Management</h3>
                    <button class="btn-primary" onclick="showAddContentModal()">
                        <i class="fas fa-plus"></i> Add Content
                    </button>
                </div>
                <div class="table-responsive">
                    <table class="table">
                        <thead>
                            <tr>
                                <th>Title</th>
                                <th>Type</th>
                                <th>Status</th>
                                <th>Created</th>
                                <th>Actions</th>
                            </tr>
                        </thead>
                        <tbody>
                            <tr>
                                <td>Kenya Real Estate Market Trends 2025</td>
                                <td>Blog Post</td>
                                <td><span class="badge badge-success">Published</span></td>
                                <td>2 days ago</td>
                                <td>
                                    <div class="action-buttons">
                                        <button class="btn btn-outline-primary btn-sm" onclick="editContent('content1')">Edit</button>
                                        <button class="btn btn-outline-danger btn-sm" onclick="deleteContent('content1')">Delete</button>
                                    </div>
                                </td>
                            </tr>
                        </tbody>
                    </table>
                </div>
            </div>
        </div>

        <!-- Blog Section -->
        <div id="blog-section" style="display: none;">
            <div class="content-section">
                <div class="section-header">
                    <h3 class="section-title">Blog Management</h3>
                    <button class="btn-primary" onclick="showAddBlogModal()">
                        <i class="fas fa-plus"></i> Add Blog Post
                    </button>
                </div>
                <div class="table-responsive">
                    <table class="table">
                        <thead>
                            <tr>
                                <th>Title</th>
                                <th>Author</th>
                                <th>Date</th>
                                <th>Status</th>
                                <th>Views</th>
                                <th>Actions</th>
                            </tr>
                        </thead>
                        <tbody>
                            <tr>
                                <td>Kenya's Real Estate Market Trends 2024</td>
                                <td>Norbert</td>
                                <td>Jan 26, 2025</td>
                                <td><span class="badge badge-success">Published</span></td>
                                <td>1,234</td>
                                <td>
                                    <div class="action-buttons">
                                        <button class="btn btn-outline-primary btn-sm" onclick="editBlog('blog1')">Edit</button>
                                        <button class="btn btn-outline-danger btn-sm" onclick="deleteBlog('blog1')">Delete</button>
                                    </div>
                                </td>
                            </tr>
                            <tr>
                                <td>Rental Market Analysis: Nairobi vs Mombasa</td>
                                <td>Norbert</td>
                                <td>Jan 10, 2025</td>
                                <td><span class="badge badge-success">Published</span></td>
                                <td>856</td>
                                <td>
                                    <div class="action-buttons">
                                        <button class="btn btn-outline-primary btn-sm" onclick="editBlog('blog4')">Edit</button>
                                        <button class="btn btn-outline-danger btn-sm" onclick="deleteBlog('blog4')">Delete</button>
                                    </div>
                                </td>
                            </tr>
                        </tbody>
                    </table>
                </div>
            </div>
        </div>

        <!-- Finance Section -->
        <div id="finance-section" style="display: none;">
            <div class="content-section">
                <div class="section-header">
                    <h3 class="section-title">Financial Management</h3>
                </div>
                <div class="stats-grid">
                    <div class="stat-card">
                        <div class="stat-number">KSh 2.4M</div>
                        <div class="stat-label">Monthly Revenue</div>
                    </div>
                    <div class="stat-card success">
                        <div class="stat-number">KSh 18.5M</div>
                        <div class="stat-label">Total Sales</div>
                    </div>
                    <div class="stat-card warning">
                        <div class="stat-number">KSh 450K</div>
                        <div class="stat-label">Pending Commissions</div>
                    </div>
                    <div class="stat-card danger">
                        <div class="stat-number">KSh 120K</div>
                        <div class="stat-label">Monthly Expenses</div>
                    </div>
                </div>
            </div>
        </div>

        <!-- Settings Section -->
        <div id="settings-section" style="display: none;">
            <div class="content-section">
                <div class="section-header">
                    <h3 class="section-title">System Settings</h3>
                </div>
                <div style="padding: 2rem;">
                        <div class="row">
                        <div class="col-md-6">
                            <h5>Company Information</h5>
                            <div class="mb-3">
                                <label class="form-label">Company Name</label>
                                <input type="text" class="form-control" value="Cool Homes" readonly>
                                    </div>
                            <div class="mb-3">
                                <label class="form-label">Founder</label>
                                <input type="text" class="form-control" value="Norbert" readonly>
                            </div>
                            <div class="mb-3">
                                <label class="form-label">Email</label>
                                <input type="email" class="form-control" value="info@coolhomes.co.ke">
                            </div>
                            <div class="mb-3">
                                <label class="form-label">Phone</label>
                                <input type="tel" class="form-control" value="0701274458">
                            </div>
                        </div>
                                                <div class="col-md-6">
                            <h5>System Preferences</h5>
                            <div class="mb-3">
                                <label class="form-label">Default Currency</label>
                                <select class="form-control">
                                    <option>Kenyan Shilling (KSh)</option>
                                    <option>US Dollar (USD)</option>
                                </select>
                                                </div>
                            <div class="mb-3">
                                <label class="form-label">Time Zone</label>
                                <select class="form-control">
                                    <option>East Africa Time (GMT+3)</option>
                                </select>
                            </div>
                            <button class="btn-primary">
                                <i class="fas fa-save"></i> Save Settings
                            </button>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <!-- Modals -->
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
                                    <label class="form-label">Property Title</label>
                                    <input type="text" name="title" class="form-control" required>
                                </div>
                                <div class="mb-3">
                                    <label class="form-label">Location</label>
                                    <input type="text" name="location" class="form-control" required>
                                </div>
                                <div class="mb-3">
                                    <label class="form-label">Price</label>
                                    <input type="number" name="price" class="form-control" required>
                                </div>
                            </div>
                            <div class="col-md-6">
                                <div class="mb-3">
                                    <label class="form-label">Bedrooms</label>
                                    <input type="number" name="bedrooms" class="form-control" required>
                                </div>
                                <div class="mb-3">
                                    <label class="form-label">Bathrooms</label>
                                    <input type="number" name="bathrooms" class="form-control" required>
                                </div>
                                <div class="mb-3">
                                    <label class="form-label">Area (sq ft)</label>
                                    <input type="number" name="area" class="form-control" required>
                                </div>
                                <div class="mb-3">
                                    <label class="form-label">Property Type</label>
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
                            <label class="form-label">Description</label>
                            <textarea name="description" class="form-control" rows="4" required></textarea>
                        </div>
                        <div class="mb-3">
                            <label class="form-label">Features</label>
                            <textarea name="features" class="form-control" rows="3" placeholder="Swimming Pool, Garden, Security, etc."></textarea>
                        </div>
                        <div class="mb-3">
                            <label class="form-label">Property Images</label>
                            <input type="file" name="images[]" class="form-control" multiple accept="image/*" id="property-images" onchange="previewImages(this)">
                            <small class="form-text text-muted">Upload multiple images (JPG, PNG, WEBP)</small>
                            <div id="image-preview" class="mt-2" style="display: none;">
                                <h6>Image Previews:</h6>
                                <div id="preview-container" class="d-flex flex-wrap gap-2"></div>
                            </div>
                        </div>
                        <div class="mb-3">
                            <label class="form-label">Property Status</label>
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

    <!-- Additional Modals -->
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
                                    <label class="form-label">Full Name</label>
                                    <input type="text" name="name" class="form-control" required>
                                </div>
                                <div class="mb-3">
                                    <label class="form-label">Email</label>
                                    <input type="email" name="email" class="form-control" required>
                                </div>
                                <div class="mb-3">
                                    <label class="form-label">Phone</label>
                                    <input type="tel" name="phone" class="form-control" required>
                                </div>
                                                </div>
                                                <div class="col-md-6">
                                <div class="mb-3">
                                    <label class="form-label">Role</label>
                                    <select name="role" class="form-control" required>
                                        <option value="">Select Role</option>
                                        <option value="agent">Agent</option>
                                        <option value="buyer">Buyer</option>
                                        <option value="seller">Seller</option>
                                    </select>
                                </div>
                                <div class="mb-3">
                                    <label class="form-label">Status</label>
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
                    <form>
                        <div class="row">
                            <div class="col-md-6">
                                <div class="mb-3">
                                    <label class="form-label">Full Name</label>
                                    <input type="text" class="form-control" value="Norbert" required>
                                </div>
                                <div class="mb-3">
                                    <label class="form-label">Email</label>
                                    <input type="email" class="form-control" value="admin@coolhomes.co.ke" required>
                                </div>
                                <div class="mb-3">
                                                    <label class="form-label">Phone</label>
                                    <input type="tel" class="form-control" value="0701274458" required>
                                </div>
                                                </div>
                                                <div class="col-md-6">
                                <div class="mb-3">
                                    <label class="form-label">Role</label>
                                    <select class="form-control" required>
                                        <option value="admin" selected>Admin</option>
                                        <option value="agent">Agent</option>
                                        <option value="buyer">Buyer</option>
                                        <option value="seller">Seller</option>
                                    </select>
                                                </div>
                                <div class="mb-3">
                                    <label class="form-label">Status</label>
                                    <select class="form-control" required>
                                        <option value="active" selected>Active</option>
                                        <option value="inactive">Inactive</option>
                                        <option value="suspended">Suspended</option>
                                    </select>
                                                </div>
                                <div class="mb-3">
                                    <label class="form-label">New Password (optional)</label>
                                    <input type="password" class="form-control">
                                </div>
                                                </div>
                                            </div>
                                        </form>
                                    </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Cancel</button>
                    <button type="button" class="btn-primary" onclick="handleEditUser()">Save Changes</button>
                </div>
                            </div>
        </div>
    </div>

    <!-- Add Content Modal -->
    <div class="modal fade" id="addContentModal" tabindex="-1">
        <div class="modal-dialog modal-lg">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title">Add New Content</h5>
                    <button type="button" class="btn-close" data-bs-dismiss="modal"></button>
                </div>
                <div class="modal-body">
                    <form id="addContentForm" onsubmit="handleAddContent(event)">
                        <div class="mb-3">
                            <label class="form-label">Title</label>
                            <input type="text" class="form-control" required>
                                        </div>
                        <div class="mb-3">
                            <label class="form-label">Content Type</label>
                            <select class="form-control" required>
                                <option value="">Select Type</option>
                                <option value="blog">Blog Post</option>
                                <option value="news">News Article</option>
                                <option value="guide">Buying Guide</option>
                                <option value="market">Market Report</option>
                            </select>
                                    </div>
                        <div class="mb-3">
                            <label class="form-label">Content</label>
                            <textarea class="form-control" rows="8" required></textarea>
                                </div>
                        <div class="mb-3">
                            <label class="form-label">Featured Image URL</label>
                            <input type="url" class="form-control">
                            </div>
                        <div class="mb-3">
                            <label class="form-label">Status</label>
                            <select class="form-control" required>
                                <option value="draft">Draft</option>
                                <option value="published">Published</option>
                            </select>
                        </div>
                    </form>
                    </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Cancel</button>
                    <button type="submit" form="addContentForm" class="btn-primary">Add Content</button>
                </div>
            </div>
        </div>
    </div>

    <!-- View Inquiry Modal -->
    <div class="modal fade" id="viewInquiryModal" tabindex="-1">
        <div class="modal-dialog modal-lg">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title">Inquiry Details</h5>
                    <button type="button" class="btn-close" data-bs-dismiss="modal"></button>
                </div>
                <div class="modal-body">
                    <div class="row">
                        <div class="col-md-6">
                            <h6>Client Information</h6>
                            <p><strong>Name:</strong> John Mwangi</p>
                            <p><strong>Email:</strong> john@email.com</p>
                            <p><strong>Phone:</strong> +254 712 345 678</p>
                        </div>
                        <div class="col-md-6">
                            <h6>Property Information</h6>
                            <p><strong>Property:</strong> Luxury Apartment</p>
                            <p><strong>Type:</strong> Purchase</p>
                            <p><strong>Date:</strong> 2 hours ago</p>
                        </div>
                    </div>
                    <div class="mt-3">
                        <h6>Message</h6>
                        <p>I am interested in viewing this property. Please let me know when it's available for viewing. I am looking to purchase within the next month.</p>
                    </div>
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Close</button>
                    <button type="button" class="btn-primary" onclick="replyToInquiry('inq1')">Reply</button>
                </div>
            </div>
        </div>
    </div>

    <!-- Reply Inquiry Modal -->
    <div class="modal fade" id="replyInquiryModal" tabindex="-1">
        <div class="modal-dialog modal-lg">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title">Reply to Inquiry</h5>
                    <button type="button" class="btn-close" data-bs-dismiss="modal"></button>
                </div>
                <div class="modal-body">
                    <form id="replyInquiryForm" onsubmit="handleReplyInquiry(event)">
                        <div class="mb-3">
                            <label class="form-label">To</label>
                            <input type="email" class="form-control" value="john@email.com" readonly>
                        </div>
                        <div class="mb-3">
                            <label class="form-label">Subject</label>
                            <input type="text" class="form-control" value="Re: Luxury Apartment Inquiry" required>
                        </div>
                        <div class="mb-3">
                            <label class="form-label">Message</label>
                            <textarea class="form-control" rows="6" required>Dear John,

Thank you for your interest in our Luxury Apartment in Westlands. I would be happy to arrange a viewing for you.

Please let me know your preferred time and I will coordinate with our agent to schedule the viewing.

Best regards,
Norbert
Cool Homes</textarea>
                        </div>
                    </form>
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Cancel</button>
                    <button type="submit" form="replyInquiryForm" class="btn-primary">Send Reply</button>
                </div>
            </div>
        </div>
    </div>

    <!-- View Appointment Modal -->
    <div class="modal fade" id="viewAppointmentModal" tabindex="-1">
        <div class="modal-dialog modal-lg">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title">Appointment Details</h5>
                    <button type="button" class="btn-close" data-bs-dismiss="modal"></button>
                </div>
                <div class="modal-body">
                    <div class="row">
                        <div class="col-md-6">
                            <h6>Client Information</h6>
                            <p><strong>Name:</strong> Peter Kiprop</p>
                            <p><strong>Phone:</strong> +254 723 456 789</p>
                            <p><strong>Email:</strong> peter@email.com</p>
                        </div>
                        <div class="col-md-6">
                            <h6>Appointment Details</h6>
                            <p><strong>Property:</strong> Luxury Apartment</p>
                            <p><strong>Date:</strong> Tomorrow, 2:00 PM</p>
                            <p><strong>Agent:</strong> Sarah Kimani</p>
                        </div>
                    </div>
                    <div class="mt-3">
                        <h6>Notes</h6>
                        <p>Client is interested in purchasing. Wants to see the property and discuss financing options.</p>
                    </div>
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Close</button>
                    <button type="button" class="btn-primary" onclick="confirmAppointment('apt1')">Confirm</button>
                </div>
            </div>
        </div>
    </div>

    <!-- Add Blog Post Modal -->
    <div class="modal fade" id="addBlogModal" tabindex="-1">
        <div class="modal-dialog modal-lg">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title">Add New Blog Post</h5>
                    <button type="button" class="btn-close" data-bs-dismiss="modal"></button>
                </div>
                <div class="modal-body">
                    <form id="addBlogForm" onsubmit="handleAddBlog(event)">
                        <div class="mb-3">
                            <label class="form-label">Title</label>
                            <input type="text" class="form-control" required>
                        </div>
                        <div class="mb-3">
                            <label class="form-label">Excerpt</label>
                            <textarea class="form-control" rows="3" required></textarea>
                        </div>
                        <div class="mb-3">
                            <label class="form-label">Content</label>
                            <textarea class="form-control" rows="8" required></textarea>
                        </div>
                        <div class="row">
                            <div class="col-md-6">
                                <div class="mb-3">
                                    <label class="form-label">Author</label>
                                    <input type="text" class="form-control" value="Norbert" required>
                                </div>
                            </div>
                            <div class="col-md-6">
                                <div class="mb-3">
                                    <label class="form-label">Category</label>
                                    <select class="form-control" required>
                                        <option value="">Select Category</option>
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
                            <input type="file" class="form-control" accept="image/*" onchange="previewBlogImage(this)">
                            <div id="blog-image-preview" class="mt-2"></div>
                        </div>
                        <div class="mb-3">
                            <label class="form-label">Status</label>
                            <select class="form-control" required>
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
            document.querySelectorAll('[id$="-section"]').forEach(el => {
                el.style.display = 'none';
            });
            
            // Show selected section
            document.getElementById(section + '-section').style.display = 'block';
            
            // Update active menu item
            document.querySelectorAll('.menu-item').forEach(item => {
                item.classList.remove('active');
            });
            event.target.classList.add('active');
            
            // Update page title
            const titles = {
                'dashboard': 'Dashboard Overview',
                'properties': 'Property Management',
                'users': 'User Management',
                'inquiries': 'Inquiry Management',
                'appointments': 'Appointment Management',
                'analytics': 'Analytics & Reports',
                'content': 'Content Management',
                'finance': 'Financial Management',
                'settings': 'System Settings'
            };
            document.getElementById('page-title').textContent = titles[section] || 'Dashboard';
        }

        // Modal functions
        function showAddPropertyModal() {
            new bootstrap.Modal(document.getElementById('addPropertyModal')).show();
        }

        function showAddUserModal() {
            new bootstrap.Modal(document.getElementById('addUserModal')).show();
        }

        function showAddContentModal() {
            new bootstrap.Modal(document.getElementById('addContentModal')).show();
        }

        // Property management functions
        function editProperty(propertyId) {
            alert(`Edit property ${propertyId} - This would open the property edit form with pre-filled data.`);
        }

        function deleteProperty(propertyId) {
            if (confirm('Are you sure you want to delete this property? This action cannot be undone.')) {
                alert(`Property ${propertyId} has been deleted successfully.`);
                // In a real application, this would remove the property from the database
            }
        }

        // User management functions
        function editUser(userId) {
            new bootstrap.Modal(document.getElementById('editUserModal')).show();
        }

        function handleEditUser() {
            // Get form data from edit user modal
            const form = document.querySelector('#editUserModal form');
            const name = form.querySelector('input[type="text"]').value;
            const email = form.querySelector('input[type="email"]').value;
            const phone = form.querySelector('input[type="tel"]').value;
            const role = form.querySelector('select').value;
            const status = form.querySelectorAll('select')[1].value;
            
            // Validate required fields
            if (!name || !email || !phone || !role || !status) {
                showNotification('error', 'Validation Error', 'Please fill in all required fields.');
                return;
            }
            
            // Show professional success notification
            showNotification('success', `User "${name}" updated successfully!`, 'The user information has been updated.');
            
            bootstrap.Modal.getInstance(document.getElementById('editUserModal')).hide();
        }

        // Blog management functions
        function showAddBlogModal() {
            new bootstrap.Modal(document.getElementById('addBlogModal')).show();
        }

        function handleAddBlog(event) {
            event.preventDefault();
            
            // Get form data
            const form = event.target;
            const title = form.querySelector('input[type="text"]').value;
            const excerpt = form.querySelector('textarea').value;
            const content = form.querySelectorAll('textarea')[1].value;
            const author = form.querySelectorAll('input[type="text"]')[1].value;
            const category = form.querySelector('select').value;
            const status = form.querySelectorAll('select')[1].value;
            
            // Validate required fields
            if (!title || !excerpt || !content || !author || !category || !status) {
                showNotification('error', 'Validation Error', 'Please fill in all required fields.');
                return;
            }
            
            // Show professional success notification
            showNotification('success', `Blog post "${title}" added successfully!`, 'The blog post has been created and saved.');
            
            // Close modal
            bootstrap.Modal.getInstance(document.getElementById('addBlogModal')).hide();
            
            // Reset form
            form.reset();
        }

        function editBlog(blogId) {
            showNotification('info', 'Edit Blog Post', `Editing blog post ${blogId}. This feature will be implemented soon.`);
        }

        function deleteBlog(blogId) {
            if (confirm('Are you sure you want to delete this blog post? This action cannot be undone.')) {
                showNotification('success', 'Blog Post Deleted', `Blog post ${blogId} has been deleted successfully.`);
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

        function deactivateUser(userId) {
            if (confirm('Are you sure you want to deactivate this user? They will not be able to log in.')) {
                alert(`User ${userId} has been deactivated successfully.`);
                // In a real application, this would update the user status in the database
            }
        }

        function activateUser(userId) {
            alert(`User ${userId} has been activated successfully.`);
            // In a real application, this would update the user status in the database
        }

        // Inquiry management functions
        function viewInquiry(inquiryId) {
            new bootstrap.Modal(document.getElementById('viewInquiryModal')).show();
        }

        function replyToInquiry(inquiryId) {
            new bootstrap.Modal(document.getElementById('replyInquiryModal')).show();
        }

        // Appointment management functions
        function viewAppointment(appointmentId) {
            new bootstrap.Modal(document.getElementById('viewAppointmentModal')).show();
        }

        function confirmAppointment(appointmentId) {
            if (confirm('Confirm this appointment?')) {
                alert(`Appointment ${appointmentId} has been confirmed.`);
            }
        }

        function cancelAppointment(appointmentId) {
            if (confirm('Are you sure you want to cancel this appointment?')) {
                alert(`Appointment ${appointmentId} has been cancelled.`);
            }
        }

        // Content management functions
        function editContent(contentId) {
            alert(`Edit content ${contentId} - This would open the content edit form.`);
        }

        function deleteContent(contentId) {
            if (confirm('Are you sure you want to delete this content?')) {
                alert(`Content ${contentId} has been deleted successfully.`);
            }
        }

        // Form submission handlers
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
                    showNotification('success', `Property "${title}" added successfully!`, 'The property has been created and saved.');
                    bootstrap.Modal.getInstance(document.getElementById('addPropertyModal')).hide();
                    form.reset();
                    // Refresh properties list
                    loadProperties();
                } else {
                    showNotification('error', 'Error', data.message || 'Failed to add property.');
                }
            })
            .catch(error => {
                showNotification('error', 'Error', 'Failed to add property. Please try again.');
            });
        }

        function handleAddUser(event) {
            event.preventDefault();
            
            const form = event.target;
            const formData = new FormData(form);
            
            // Validate required fields
            const name = formData.get('name');
            const email = formData.get('email');
            const role = formData.get('role');
            
            if (!name || !email || !role) {
                showNotification('error', 'Validation Error', 'Please fill in all required fields.');
                return;
            }
            
            // Send data to server
            fetch('api/add-user.php', {
                method: 'POST',
                body: formData
            })
            .then(response => response.json())
            .then(data => {
                if (data.success) {
                    showNotification('success', `User "${name}" added successfully!`, 'The user has been created and saved.');
                    bootstrap.Modal.getInstance(document.getElementById('addUserModal')).hide();
                    form.reset();
                    // Refresh users list
                    loadUsers();
                } else {
                    showNotification('error', 'Error', data.message || 'Failed to add user.');
                }
            })
            .catch(error => {
                showNotification('error', 'Error', 'Failed to add user. Please try again.');
            });
        }

        function handleAddContent(event) {
            event.preventDefault();
            const form = event.target;
            const formData = new FormData(form);
            
            // Get form data
            const title = form.querySelector('input[type="text"]').value;
            const contentType = form.querySelector('select').value;
            const content = form.querySelector('textarea').value;
            const imageUrl = form.querySelector('input[type="url"]').value;
            const status = form.querySelectorAll('select')[1].value;
            
            // Validate required fields
            if (!title || !contentType || !content || !status) {
                showNotification('error', 'Validation Error', 'Please fill in all required fields.');
                return;
            }
            
            // Show professional success notification
            showNotification('success', `Content "${title}" added successfully!`, 'The new content will appear in the content list.');
            
            bootstrap.Modal.getInstance(document.getElementById('addContentModal')).hide();
            form.reset();
        }

        function handleReplyInquiry(event) {
            event.preventDefault();
            const form = event.target;
            const formData = new FormData(form);
            
            // Get form data
            const to = form.querySelector('input[type="email"]').value;
            const subject = form.querySelector('input[type="text"]').value;
            const message = form.querySelector('textarea').value;
            
            // Validate required fields
            if (!to || !subject || !message) {
                showNotification('error', 'Validation Error', 'Please fill in all required fields.');
                return;
            }
            
            // Show professional success notification
            showNotification('success', 'Reply sent successfully!', 'The client will receive your response via email.');
            
            bootstrap.Modal.getInstance(document.getElementById('replyInquiryModal')).hide();
            form.reset();
        }

        // Professional notification system
        function showNotification(type, title, message) {
            // Create notification container if it doesn't exist
            let notificationContainer = document.getElementById('notification-container');
            if (!notificationContainer) {
                notificationContainer = document.createElement('div');
                notificationContainer.id = 'notification-container';
                notificationContainer.style.cssText = `
                    position: fixed;
                    top: 20px;
                    right: 20px;
                    z-index: 9999;
                    max-width: 400px;
                `;
                document.body.appendChild(notificationContainer);
            }

            // Create notification element
            const notification = document.createElement('div');
            notification.style.cssText = `
                background: white;
                border-radius: 8px;
                box-shadow: 0 4px 20px rgba(0,0,0,0.15);
                padding: 1rem;
                margin-bottom: 1rem;
                border-left: 4px solid ${type === 'success' ? '#10b981' : '#ef4444'};
                animation: slideIn 0.3s ease;
            `;

            notification.innerHTML = `
                <div style="display: flex; align-items: flex-start; gap: 0.75rem;">
                    <div style="
                        width: 24px;
                        height: 24px;
                        border-radius: 50%;
                        background: ${type === 'success' ? '#10b981' : '#ef4444'};
                        display: flex;
                        align-items: center;
                        justify-content: center;
                        color: white;
                        font-size: 0.8rem;
                        flex-shrink: 0;
                    ">
                        ${type === 'success' ? '✓' : '✕'}
                    </div>
                    <div style="flex: 1;">
                        <h6 style="margin: 0 0 0.25rem 0; color: #1e293b; font-weight: 600;">${title}</h6>
                        <p style="margin: 0; color: #64748b; font-size: 0.9rem;">${message}</p>
                    </div>
                    <button onclick="this.parentElement.parentElement.remove()" style="
                        background: none;
                        border: none;
                        color: #64748b;
                        cursor: pointer;
                        padding: 0;
                        font-size: 1.2rem;
                    ">×</button>
                </div>
            `;

            // Add CSS animation
            if (!document.getElementById('notification-styles')) {
                const style = document.createElement('style');
                style.id = 'notification-styles';
                style.textContent = `
                    @keyframes slideIn {
                        from { transform: translateX(100%); opacity: 0; }
                        to { transform: translateX(0); opacity: 1; }
                    }
                `;
                document.head.appendChild(style);
            }

            notificationContainer.appendChild(notification);

            // Auto remove after 5 seconds
            setTimeout(() => {
                if (notification.parentElement) {
                    notification.style.animation = 'slideIn 0.3s ease reverse';
                    setTimeout(() => notification.remove(), 300);
                }
            }, 5000);
        }

        // Image preview function
        function previewImages(input) {
            const previewContainer = document.getElementById('preview-container');
            const imagePreview = document.getElementById('image-preview');
            
            // Clear previous previews
            previewContainer.innerHTML = '';
            
            if (input.files && input.files.length > 0) {
                imagePreview.style.display = 'block';
                
                Array.from(input.files).forEach((file, index) => {
                    if (file.type.startsWith('image/')) {
                        const reader = new FileReader();
                        reader.onload = function(e) {
                            const img = document.createElement('img');
                            img.src = e.target.result;
                            img.style.width = '80px';
                            img.style.height = '60px';
                            img.style.objectFit = 'cover';
                            img.style.borderRadius = '4px';
                            img.style.border = '1px solid #ddd';
                            img.title = file.name;
                            previewContainer.appendChild(img);
                        };
                        reader.readAsDataURL(file);
                    }
                });
            } else {
                imagePreview.style.display = 'none';
            }
        }

        // Logout function
        function logout() {
            if (confirm('Are you sure you want to logout?')) {
                localStorage.removeItem('userEmail');
                localStorage.removeItem('userRole');
                window.location.href = 'index';
            }
        }

        // Initialize dashboard
        document.addEventListener('DOMContentLoaded', function() {
            // Check if user is logged in
            const userEmail = localStorage.getItem('userEmail');
            const userRole = localStorage.getItem('userRole');
            
            if (!userEmail || userRole !== 'admin') {
                alert('Access denied. Admin privileges required.');
                window.location.href = 'login';
                return;
            }
            
            // Add form event listeners
            const addPropertyForm = document.querySelector('#addPropertyModal form');
            if (addPropertyForm) {
                addPropertyForm.addEventListener('submit', handleAddProperty);
            }
            
            const addUserForm = document.querySelector('#addUserModal form');
            if (addUserForm) {
                addUserForm.addEventListener('submit', handleAddUser);
            }
            
            const addContentForm = document.querySelector('#addContentModal form');
            if (addContentForm) {
                addContentForm.addEventListener('submit', handleAddContent);
            }
            
            const replyInquiryForm = document.querySelector('#replyInquiryModal form');
            if (replyInquiryForm) {
                replyInquiryForm.addEventListener('submit', handleReplyInquiry);
            }
            
        // Load initial data
        loadData();
        
        // Show welcome message
        console.log('Welcome to Cool Homes Admin Dashboard, Norbert!');
    });

    // Data loading functions
    function loadData() {
        fetch('api/get-data.php')
        .then(response => response.json())
        .then(data => {
            if (data.success) {
                updatePropertiesTable(data.data.properties);
                updateUsersTable(data.data.users);
                updateInquiriesTable(data.data.inquiries);
                updateAppointmentsTable(data.data.appointments);
            }
        })
        .catch(error => {
            console.error('Error loading data:', error);
        });
    }

    function loadProperties() {
        fetch('api/get-data.php')
        .then(response => response.json())
        .then(data => {
            if (data.success) {
                updatePropertiesTable(data.data.properties);
            }
        });
    }

    function loadUsers() {
        fetch('api/get-data.php')
        .then(response => response.json())
        .then(data => {
            if (data.success) {
                updateUsersTable(data.data.users);
            }
        });
    }

    function updatePropertiesTable(properties) {
        const tbody = document.querySelector('#properties-table tbody');
        if (!tbody) return;
        
        tbody.innerHTML = '';
        properties.forEach(property => {
            const row = document.createElement('tr');
            row.innerHTML = `
                <td>${property.title}</td>
                <td>KSh ${parseInt(property.price).toLocaleString()}</td>
                <td>${property.location}</td>
                <td><span class="badge badge-${property.status === 'available' ? 'success' : 'warning'}">${property.status}</span></td>
                <td>${property.agent_name || 'N/A'}</td>
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

    function updateUsersTable(users) {
        const tbody = document.querySelector('#users-table tbody');
        if (!tbody) return;
        
        tbody.innerHTML = '';
        users.forEach(user => {
            const row = document.createElement('tr');
            row.innerHTML = `
                <td>${user.name}</td>
                <td>${user.email}</td>
                <td>${user.phone || 'N/A'}</td>
                <td><span class="badge badge-${user.role === 'agent' ? 'primary' : 'secondary'}">${user.role}</span></td>
                <td><span class="badge badge-${user.status === 'active' ? 'success' : 'warning'}">${user.status}</span></td>
                <td>
                    <div class="action-buttons">
                        <button class="btn btn-outline-primary btn-sm" onclick="editUser(${user.id})">Edit</button>
                        <button class="btn btn-outline-${user.status === 'active' ? 'warning' : 'success'} btn-sm" onclick="toggleUserStatus(${user.id}, '${user.status}')">${user.status === 'active' ? 'Deactivate' : 'Activate'}</button>
                    </div>
                </td>
            `;
            tbody.appendChild(row);
        });
    }

    function updateInquiriesTable(inquiries) {
        const tbody = document.querySelector('#inquiries-table tbody');
        if (!tbody) return;
        
        tbody.innerHTML = '';
        inquiries.forEach(inquiry => {
            const row = document.createElement('tr');
            row.innerHTML = `
                <td>${inquiry.name}</td>
                <td>${inquiry.email}</td>
                <td>${inquiry.property_title || 'General Inquiry'}</td>
                <td><span class="badge badge-${inquiry.status === 'new' ? 'warning' : 'success'}">${inquiry.status}</span></td>
                <td>${new Date(inquiry.created_at).toLocaleDateString()}</td>
                <td>
                    <div class="action-buttons">
                        <button class="btn btn-outline-primary btn-sm" onclick="viewInquiry(${inquiry.id})">View</button>
                        <button class="btn btn-outline-success btn-sm" onclick="replyToInquiry(${inquiry.id})">Reply</button>
                    </div>
                </td>
            `;
            tbody.appendChild(row);
        });
    }

    function updateAppointmentsTable(appointments) {
        const tbody = document.querySelector('#appointments-table tbody');
        if (!tbody) return;
        
        tbody.innerHTML = '';
        appointments.forEach(appointment => {
            const row = document.createElement('tr');
            row.innerHTML = `
                <td>${appointment.client_name}</td>
                <td>${appointment.property_title || 'N/A'}</td>
                <td>${new Date(appointment.appointment_date).toLocaleDateString()}</td>
                <td>${appointment.appointment_time}</td>
                <td><span class="badge badge-${appointment.status === 'pending' ? 'warning' : 'success'}">${appointment.status}</span></td>
                <td>
                    <div class="action-buttons">
                        <button class="btn btn-outline-primary btn-sm" onclick="viewAppointment(${appointment.id})">View</button>
                        <button class="btn btn-outline-success btn-sm" onclick="confirmAppointment(${appointment.id})">Confirm</button>
                    </div>
                </td>
            `;
            tbody.appendChild(row);
        });
    }
    </script>
</body>
</html>