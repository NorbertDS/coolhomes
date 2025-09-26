<?php
$pageTitle = "Our Services";
$pageDescription = "Comprehensive real estate services in Kenya - property sales, rentals, management, and investment consulting.";
include 'includes/header.php';
?>

<section class="hero-section">
    <div class="container">
        <div class="row">
            <div class="col-lg-8 mx-auto text-center">
                <h1 class="hero-title">Our Services</h1>
                <p class="hero-subtitle">Comprehensive real estate solutions tailored for the Kenyan market</p>
            </div>
        </div>
    </div>
</section>

<section class="services-section py-5">
    <div class="container">
        <div class="row">
            <div class="col-lg-4 mb-4">
                <div class="service-card">
                    <div class="service-icon">
                        <i class="fas fa-home"></i>
                    </div>
                    <h3>Property Sales</h3>
                    <p>Expert assistance in buying and selling residential and commercial properties across Kenya.</p>
                    <ul class="service-features">
                        <li>Property valuation and pricing</li>
                        <li>Market analysis and trends</li>
                        <li>Negotiation and closing</li>
                        <li>Legal documentation support</li>
                    </ul>
                </div>
            </div>
            
            <div class="col-lg-4 mb-4">
                <div class="service-card">
                    <div class="service-icon">
                        <i class="fas fa-key"></i>
                    </div>
                    <h3>Property Rentals</h3>
                    <p>Comprehensive rental services for both landlords and tenants in Nairobi and beyond.</p>
                    <ul class="service-features">
                        <li>Tenant screening and verification</li>
                        <li>Rent collection and management</li>
                        <li>Property maintenance coordination</li>
                        <li>Lease agreement preparation</li>
                    </ul>
                </div>
            </div>
            
            <div class="col-lg-4 mb-4">
                <div class="service-card">
                    <div class="service-icon">
                        <i class="fas fa-chart-line"></i>
                    </div>
                    <h3>Investment Consulting</h3>
                    <p>Strategic investment advice to help you make informed real estate decisions.</p>
                    <ul class="service-features">
                        <li>ROI analysis and projections</li>
                        <li>Market research and insights</li>
                        <li>Portfolio diversification strategies</li>
                        <li>Risk assessment and mitigation</li>
                    </ul>
                </div>
            </div>
        </div>
        
        <div class="row">
            <div class="col-lg-4 mb-4">
                <div class="service-card">
                    <div class="service-icon">
                        <i class="fas fa-building"></i>
                    </div>
                    <h3>Property Management</h3>
                    <p>Complete property management services for residential and commercial properties.</p>
                    <ul class="service-features">
                        <li>24/7 maintenance support</li>
                        <li>Tenant relationship management</li>
                        <li>Financial reporting and accounting</li>
                        <li>Property marketing and advertising</li>
                    </ul>
                </div>
            </div>
            
            <div class="col-lg-4 mb-4">
                <div class="service-card">
                    <div class="service-icon">
                        <i class="fas fa-search"></i>
                    </div>
                    <h3>Property Search</h3>
                    <p>Advanced search tools and personalized assistance to find your perfect property.</p>
                    <ul class="service-features">
                        <li>Customized property matching</li>
                        <li>Virtual and in-person viewings</li>
                        <li>Neighborhood analysis</li>
                        <li>Market comparison reports</li>
                    </ul>
                </div>
            </div>
            
            <div class="col-lg-4 mb-4">
                <div class="service-card">
                    <div class="service-icon">
                        <i class="fas fa-handshake"></i>
                    </div>
                    <h3>Legal Services</h3>
                    <p>Professional legal support for all your real estate transactions and documentation.</p>
                    <ul class="service-features">
                        <li>Title deed verification</li>
                        <li>Contract review and preparation</li>
                        <li>Transfer process assistance</li>
                        <li>Legal compliance guidance</li>
                    </ul>
                </div>
            </div>
        </div>
    </div>
</section>

<section class="process-section py-5 bg-light">
    <div class="container">
        <div class="row">
            <div class="col-lg-8 mx-auto text-center">
                <h2 class="section-title">Our Process</h2>
                <p class="section-subtitle">How we deliver exceptional real estate services</p>
            </div>
        </div>
        
        <div class="row mt-5">
            <div class="col-lg-3 col-md-6 mb-4">
                <div class="process-step">
                    <div class="step-number">1</div>
                    <h4>Consultation</h4>
                    <p>We start with a detailed consultation to understand your needs, budget, and preferences.</p>
                </div>
            </div>
            
            <div class="col-lg-3 col-md-6 mb-4">
                <div class="process-step">
                    <div class="step-number">2</div>
                    <h4>Property Search</h4>
                    <p>Our team searches our extensive database and network to find suitable properties.</p>
                </div>
            </div>
            
            <div class="col-lg-3 col-md-6 mb-4">
                <div class="process-step">
                    <div class="step-number">3</div>
                    <h4>Viewing & Analysis</h4>
                    <p>We arrange property viewings and provide detailed analysis of each option.</p>
                </div>
            </div>
            
            <div class="col-lg-3 col-md-6 mb-4">
                <div class="process-step">
                    <div class="step-number">4</div>
                    <h4>Transaction</h4>
                    <p>We handle all negotiations, documentation, and legal processes for a smooth transaction.</p>
                </div>
            </div>
        </div>
    </div>
</section>

<section class="cta-section py-5">
    <div class="container">
        <div class="row">
            <div class="col-lg-8 mx-auto text-center">
                <h2 class="cta-title">Ready to Start Your Real Estate Journey?</h2>
                <p class="cta-subtitle">Contact us today for a free consultation and discover how we can help you achieve your property goals.</p>
                <div class="cta-buttons">
                    <a href="contact.php" class="btn btn-primary btn-lg me-3">
                        <i class="fas fa-phone"></i> Contact Us
                    </a>
                    <a href="properties.php" class="btn btn-outline-primary btn-lg">
                        <i class="fas fa-search"></i> Browse Properties
                    </a>
                </div>
            </div>
        </div>
    </div>
</section>

<style>
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

.services-section {
    padding: 4rem 0;
}

.service-card {
    background: white;
    border-radius: 15px;
    padding: 2rem;
    box-shadow: 0 10px 30px rgba(0,0,0,0.1);
    transition: transform 0.3s ease, box-shadow 0.3s ease;
    height: 100%;
}

.service-card:hover {
    transform: translateY(-5px);
    box-shadow: 0 20px 40px rgba(0,0,0,0.15);
}

.service-icon {
    width: 80px;
    height: 80px;
    background: linear-gradient(135deg, var(--primary-color), #1d4ed8);
    border-radius: 50%;
    display: flex;
    align-items: center;
    justify-content: center;
    margin-bottom: 1.5rem;
}

.service-icon i {
    font-size: 2rem;
    color: white;
}

.service-card h3 {
    font-size: 1.5rem;
    font-weight: 600;
    margin-bottom: 1rem;
    color: var(--dark-color);
}

.service-card p {
    color: var(--secondary-color);
    margin-bottom: 1.5rem;
    line-height: 1.6;
}

.service-features {
    list-style: none;
    padding: 0;
}

.service-features li {
    padding: 0.5rem 0;
    color: var(--secondary-color);
    position: relative;
    padding-left: 1.5rem;
}

.service-features li:before {
    content: "✓";
    position: absolute;
    left: 0;
    color: var(--success-color);
    font-weight: bold;
}

.process-section {
    background: var(--light-color);
}

.section-title {
    font-size: 2.5rem;
    font-weight: 700;
    margin-bottom: 1rem;
    color: var(--dark-color);
}

.section-subtitle {
    font-size: 1.1rem;
    color: var(--secondary-color);
    margin-bottom: 2rem;
}

.process-step {
    text-align: center;
    padding: 2rem 1rem;
}

.step-number {
    width: 60px;
    height: 60px;
    background: linear-gradient(135deg, var(--primary-color), #1d4ed8);
    border-radius: 50%;
    display: flex;
    align-items: center;
    justify-content: center;
    margin: 0 auto 1.5rem;
    font-size: 1.5rem;
    font-weight: bold;
    color: white;
}

.process-step h4 {
    font-size: 1.3rem;
    font-weight: 600;
    margin-bottom: 1rem;
    color: var(--dark-color);
}

.process-step p {
    color: var(--secondary-color);
    line-height: 1.6;
}

.cta-section {
    background: linear-gradient(135deg, var(--primary-color), #1d4ed8);
    color: white;
}

.cta-title {
    font-size: 2.5rem;
    font-weight: 700;
    margin-bottom: 1rem;
}

.cta-subtitle {
    font-size: 1.2rem;
    opacity: 0.9;
    margin-bottom: 2rem;
}

.cta-buttons .btn {
    padding: 1rem 2rem;
    font-size: 1.1rem;
    border-radius: 50px;
    transition: all 0.3s ease;
}

.cta-buttons .btn:hover {
    transform: translateY(-2px);
    box-shadow: 0 10px 20px rgba(0,0,0,0.2);
}

@media (max-width: 768px) {
    .hero-title {
        font-size: 2rem;
    }
    
    .section-title {
        font-size: 2rem;
    }
    
    .cta-title {
        font-size: 2rem;
    }
    
    .cta-buttons {
        flex-direction: column;
        gap: 1rem;
    }
    
    .cta-buttons .btn {
        width: 100%;
    }
}
</style>

<?php include 'includes/footer.php'; ?>
