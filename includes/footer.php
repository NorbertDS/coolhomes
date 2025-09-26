    <!-- Footer -->
    <footer class="footer-section">
        <div class="container">
            <div class="row">
                <div class="col-lg-4 col-md-6 mb-4">
                    <h5 class="text-light mb-3">
                        <i class="fas fa-home me-2"></i>Cool Homes
                    </h5>
                    <p class="text-light">Your trusted partner in finding the perfect home in Kenya. We specialize in luxury properties, investment opportunities, and exceptional service.</p>
                    <div class="social-links">
                        <a href="#" class="text-light me-3"><i class="fab fa-facebook-f"></i></a>
                        <a href="#" class="text-light me-3"><i class="fab fa-twitter"></i></a>
                        <a href="#" class="text-light me-3"><i class="fab fa-instagram"></i></a>
                        <a href="#" class="text-light me-3"><i class="fab fa-linkedin-in"></i></a>
                    </div>
                </div>
                <div class="col-lg-2 col-md-6 mb-4">
                    <h6 class="text-light mb-3">Quick Links</h6>
                    <ul class="list-unstyled">
                        <li><a href="index.html" class="text-light">Home</a></li>
                        <li><a href="properties.php" class="text-light">Properties</a></li>
                        <li><a href="services.php" class="text-light">Services</a></li>
                        <li><a href="about.php" class="text-light">About</a></li>
                        <li><a href="index.html#blog" class="text-light">Blog</a></li>
                        <li><a href="index.html#contact" class="text-light">Contact</a></li>
                    </ul>
                </div>
                <div class="col-lg-2 col-md-6 mb-4">
                    <h6 class="text-light mb-3">Services</h6>
                    <ul class="list-unstyled">
                        <li><a href="services.php#buying" class="text-light">Property Buying</a></li>
                        <li><a href="services.php#selling" class="text-light">Property Selling</a></li>
                        <li><a href="services.php#rental" class="text-light">Rental Services</a></li>
                        <li><a href="services.php#investment" class="text-light">Investment</a></li>
                        <li><a href="services.php#valuation" class="text-light">Property Valuation</a></li>
                        <li><a href="services.php#consultation" class="text-light">Consultation</a></li>
                    </ul>
                </div>
                <div class="col-lg-4 col-md-6 mb-4">
                    <h6 class="text-light mb-3">Contact Info</h6>
                    <div class="contact-info">
                        <p class="text-light mb-2">
                            <i class="fas fa-map-marker-alt me-2"></i>
                            Westlands, Nairobi, Kenya
                        </p>
                        <p class="text-light mb-2">
                            <i class="fas fa-phone me-2"></i>
                            +254 701 274 458
                        </p>
                        <p class="text-light mb-2">
                            <i class="fas fa-envelope me-2"></i>
                            info@coolhomes.co.ke
                        </p>
                        <p class="text-light">
                            <i class="fas fa-clock me-2"></i>
                            Mon - Fri: 8:00 AM - 6:00 PM
                        </p>
                    </div>
                </div>
            </div>
            <hr class="my-4" style="border-color: rgba(255,255,255,0.2);">
            <div class="row align-items-center">
                <div class="col-md-6">
                    <p class="text-light mb-0">&copy; <?php echo date('Y'); ?> Cool Homes. All rights reserved.</p>
                </div>
                <div class="col-md-6 text-md-end">
                    <a href="#" class="text-light me-3">Privacy Policy</a>
                    <a href="#" class="text-light me-3">Terms of Service</a>
                    <a href="#" class="text-light">Sitemap</a>
                </div>
            </div>
        </div>
    </footer>

    <!-- Bootstrap JS -->
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/js/bootstrap.bundle.min.js"></script>
    
    <style>
        .footer-section {
            background: linear-gradient(135deg, var(--dark-color) 0%, #374151 100%);
            color: white;
            padding: 3rem 0 1rem;
            margin-top: 3rem;
        }

        .footer-section h5, .footer-section h6 {
            color: white;
            font-weight: 600;
        }

        .footer-section a {
            color: rgba(255,255,255,0.8);
            text-decoration: none;
            transition: all 0.3s ease;
        }

        .footer-section a:hover {
            color: white;
            text-decoration: none;
        }

        .social-links a {
            display: inline-block;
            width: 40px;
            height: 40px;
            background: rgba(255,255,255,0.1);
            border-radius: 50%;
            text-align: center;
            line-height: 40px;
            transition: all 0.3s ease;
        }

        .social-links a:hover {
            background: var(--primary-color);
            transform: translateY(-3px);
        }
    </style>
</body>
</html>
