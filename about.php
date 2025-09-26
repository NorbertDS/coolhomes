<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>About Us - Cool Homes</title>
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
            background-color: #f8fafc;
            color: var(--dark-color);
        }

        .hero-section {
            background: linear-gradient(135deg, var(--primary-color), #1d4ed8);
            color: white;
            padding: 4rem 0;
            text-align: center;
        }

        .hero-title {
            font-size: 3rem;
            font-weight: 700;
            margin-bottom: 1rem;
        }

        .hero-subtitle {
            font-size: 1.2rem;
            opacity: 0.9;
            margin-bottom: 2rem;
        }

        .about-section {
            padding: 4rem 0;
        }

        .about-card {
            background: white;
            border-radius: 15px;
            padding: 2rem;
            box-shadow: 0 4px 20px rgba(0,0,0,0.1);
            margin-bottom: 2rem;
        }

        .team-member {
            text-align: center;
            padding: 1.5rem;
            background: white;
            border-radius: 15px;
            box-shadow: 0 4px 20px rgba(0,0,0,0.1);
            transition: transform 0.3s ease;
        }

        .team-member:hover {
            transform: translateY(-5px);
        }

        .team-avatar {
            width: 120px;
            height: 120px;
            border-radius: 50%;
            background: linear-gradient(135deg, var(--primary-color), #1d4ed8);
            display: flex;
            align-items: center;
            justify-content: center;
            color: white;
            font-size: 3rem;
            font-weight: 700;
            margin: 0 auto 1rem;
        }

        .stats-section {
            background: var(--light-color);
            padding: 4rem 0;
        }

        .stat-item {
            text-align: center;
            padding: 2rem;
        }

        .stat-number {
            font-size: 3rem;
            font-weight: 700;
            color: var(--primary-color);
            margin-bottom: 0.5rem;
        }

        .stat-label {
            color: var(--secondary-color);
            font-size: 1.1rem;
        }

        .navbar {
            background: white;
            box-shadow: 0 2px 10px rgba(0,0,0,0.1);
        }

        .navbar-brand {
            font-weight: 700;
            color: var(--primary-color);
            font-size: 1.5rem;
        }

        .nav-link {
            color: var(--dark-color);
            font-weight: 500;
            transition: color 0.3s ease;
        }

        .nav-link:hover {
            color: var(--primary-color);
        }

        .footer {
            background: var(--dark-color);
            color: white;
            padding: 3rem 0 1rem;
        }

        .footer h6 {
            color: white;
            margin-bottom: 1rem;
            font-weight: 600;
        }

        .footer-links {
            list-style: none;
            padding: 0;
        }

        .footer-links li {
            margin-bottom: 0.5rem;
        }

        .footer-links a {
            color: #94a3b8;
            text-decoration: none;
            transition: color 0.3s ease;
        }

        .footer-links a:hover {
            color: white;
        }
    </style>
</head>
<body>
    <!-- Navigation -->
    <nav class="navbar navbar-expand-lg navbar-light sticky-top">
        <div class="container">
            <a class="navbar-brand" href="home">
                <i class="fas fa-home me-2"></i>Cool Homes
            </a>
            <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#navbarNav">
                <span class="navbar-toggler-icon"></span>
            </button>
            <div class="collapse navbar-collapse" id="navbarNav">
                <ul class="navbar-nav ms-auto">
                    <li class="nav-item">
                        <a class="nav-link" href="home">Home</a>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link" href="properties">Properties</a>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link" href="services">Services</a>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link active" href="about">About</a>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link" href="home#blog">Blog</a>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link" href="home#contact">Contact</a>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link" href="login">Login</a>
                    </li>
                </ul>
            </div>
        </div>
    </nav>

    <!-- Hero Section -->
    <section class="hero-section">
        <div class="container">
            <h1 class="hero-title">About Cool Homes</h1>
            <p class="hero-subtitle">Your trusted partner in Kenya's real estate market</p>
        </div>
    </section>

    <!-- About Section -->
    <section class="about-section">
        <div class="container">
            <div class="row">
                <div class="col-lg-8 mx-auto">
                    <div class="about-card">
                        <h2 class="mb-4">Our Story</h2>
                        <p class="lead mb-4">
                            Founded by Norbert, Cool Homes has been at the forefront of Kenya's real estate revolution, 
                            helping thousands of Kenyans find their dream homes and make smart property investments.
                        </p>
                        <p class="mb-4">
                            Since our inception, we have built a reputation for integrity, professionalism, and results. 
                            Our team of experienced real estate professionals understands the unique challenges and 
                            opportunities in Kenya's property market.
                        </p>
                        <p class="mb-4">
                            We believe that everyone deserves a place to call home, and we're committed to making 
                            that dream a reality through our comprehensive real estate services.
                        </p>
                    </div>
                </div>
            </div>

            <div class="row">
                <div class="col-lg-6">
                    <div class="about-card">
                        <h3 class="mb-4">Our Mission</h3>
                        <p class="mb-3">
                            To provide exceptional real estate services that exceed our clients' expectations while 
                            contributing to the growth and development of Kenya's property market.
                        </p>
                        <ul class="list-unstyled">
                            <li><i class="fas fa-check text-success me-2"></i>Client satisfaction is our priority</li>
                            <li><i class="fas fa-check text-success me-2"></i>Transparency in all transactions</li>
                            <li><i class="fas fa-check text-success me-2"></i>Innovation in service delivery</li>
                            <li><i class="fas fa-check text-success me-2"></i>Community development focus</li>
                        </ul>
                    </div>
                </div>
                <div class="col-lg-6">
                    <div class="about-card">
                        <h3 class="mb-4">Our Vision</h3>
                        <p class="mb-3">
                            To be Kenya's leading real estate company, recognized for our innovation, integrity, 
                            and commitment to transforming the property landscape.
                        </p>
                        <ul class="list-unstyled">
                            <li><i class="fas fa-check text-success me-2"></i>Market leadership in Kenya</li>
                            <li><i class="fas fa-check text-success me-2"></i>Technology-driven solutions</li>
                            <li><i class="fas fa-check text-success me-2"></i>Sustainable development practices</li>
                            <li><i class="fas fa-check text-success me-2"></i>Regional expansion</li>
                        </ul>
                    </div>
                </div>
            </div>
        </div>
    </section>

    <!-- Stats Section -->
    <section class="stats-section">
        <div class="container">
            <div class="row">
                <div class="col-lg-3 col-md-6">
                    <div class="stat-item">
                        <div class="stat-number">500+</div>
                        <div class="stat-label">Properties Sold</div>
                    </div>
                </div>
                <div class="col-lg-3 col-md-6">
                    <div class="stat-item">
                        <div class="stat-number">1000+</div>
                        <div class="stat-label">Happy Clients</div>
                    </div>
                </div>
                <div class="col-lg-3 col-md-6">
                    <div class="stat-item">
                        <div class="stat-number">15+</div>
                        <div class="stat-label">Years Experience</div>
                    </div>
                </div>
                <div class="col-lg-3 col-md-6">
                    <div class="stat-item">
                        <div class="stat-number">50+</div>
                        <div class="stat-label">Expert Agents</div>
                    </div>
                </div>
            </div>
        </div>
    </section>

    <!-- Team Section -->
    <section class="py-5">
        <div class="container">
            <div class="text-center mb-5">
                <h2 class="mb-3">Meet Our Team</h2>
                <p class="text-muted">Experienced professionals dedicated to your success</p>
            </div>
            <div class="row">
                <div class="col-lg-4 col-md-6 mb-4">
                    <div class="team-member">
                        <div class="team-avatar">N</div>
                        <h4>Norbert</h4>
                        <p class="text-primary mb-2">Founder & CEO</p>
                        <p class="text-muted">Visionary leader with 15+ years in real estate, passionate about transforming Kenya's property market.</p>
                    </div>
                </div>
                <div class="col-lg-4 col-md-6 mb-4">
                    <div class="team-member">
                        <div class="team-avatar">S</div>
                        <h4>Sarah Kimani</h4>
                        <p class="text-primary mb-2">Senior Property Agent</p>
                        <p class="text-muted">Expert in residential sales with a track record of successful transactions across Nairobi.</p>
                    </div>
                </div>
                <div class="col-lg-4 col-md-6 mb-4">
                    <div class="team-member">
                        <div class="team-avatar">M</div>
                        <h4>Michael Otieno</h4>
                        <p class="text-primary mb-2">Investment Consultant</p>
                        <p class="text-muted">Specializes in commercial properties and investment opportunities in Kenya's growing market.</p>
                    </div>
                </div>
            </div>
        </div>
    </section>

    <!-- Footer -->
    <footer class="footer">
        <div class="container">
            <div class="row">
                <div class="col-lg-4 col-md-6 mb-4">
                    <h6><i class="fas fa-home me-2"></i>Cool Homes</h6>
                    <p class="text-muted">Your trusted partner in Kenya's real estate market. We provide comprehensive property solutions with professionalism and integrity.</p>
                    <div class="d-flex gap-3">
                        <a href="#" class="text-light"><i class="fab fa-facebook-f"></i></a>
                        <a href="#" class="text-light"><i class="fab fa-twitter"></i></a>
                        <a href="#" class="text-light"><i class="fab fa-instagram"></i></a>
                        <a href="#" class="text-light"><i class="fab fa-linkedin-in"></i></a>
                    </div>
                </div>
                <div class="col-lg-2 col-md-6 mb-4">
                    <h6>Quick Links</h6>
                    <ul class="footer-links">
                        <li><a href="home">Home</a></li>
                        <li><a href="properties">Properties</a></li>
                        <li><a href="services">Services</a></li>
                        <li><a href="about">About</a></li>
                        <li><a href="home#contact">Contact</a></li>
                    </ul>
                </div>
                <div class="col-lg-2 col-md-6 mb-4">
                    <h6>Services</h6>
                    <ul class="footer-links">
                        <li><a href="services">Property Sales</a></li>
                        <li><a href="services">Rentals</a></li>
                        <li><a href="services">Property Management</a></li>
                        <li><a href="services">Investment Consulting</a></li>
                        <li><a href="services">Legal Services</a></li>
                    </ul>
                </div>
                <div class="col-lg-4 col-md-6 mb-4">
                    <h6>Contact Info</h6>
                    <ul class="footer-links">
                        <li><i class="fas fa-map-marker-alt me-2"></i>Westlands, Nairobi, Kenya</li>
                        <li><i class="fas fa-phone me-2"></i>0701274458</li>
                        <li><i class="fas fa-envelope me-2"></i>info@coolhomes.co.ke</li>
                        <li><i class="fas fa-clock me-2"></i>Mon - Fri: 8:00 AM - 6:00 PM</li>
                    </ul>
                </div>
            </div>
            <hr class="my-4">
            <div class="row align-items-center">
                <div class="col-md-6">
                    <p class="mb-0">&copy; 2025 Cool Homes. All rights reserved.</p>
                </div>
                <div class="col-md-6 text-md-end">
                    <p class="mb-0">Designed with <i class="fas fa-heart text-danger"></i> for Kenya</p>
                </div>
            </div>
        </div>
    </footer>

    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/js/bootstrap.bundle.min.js"></script>
</body>
</html>
