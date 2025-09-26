<?php
session_start();

// Handle login form submission
if ($_POST && isset($_POST['login'])) {
    $email = $_POST['email'];
    $password = $_POST['password'];
    
    // Simple authentication (in production, use proper password hashing)
    if ($email === 'admin@coolhomes.co.ke' && $password === 'admin123') {
        $_SESSION['user_id'] = 1;
        $_SESSION['user_name'] = 'Norbert';
        $_SESSION['user_role'] = 'admin';
        header('Location: dashboard.php');
        exit;
    } else {
        $loginError = 'Invalid email or password';
    }
}

$pageTitle = "Login";
$pageDescription = "Login to your Cool Homes account to access exclusive features and manage your properties.";

include 'includes/header.php';
?>


<section class="login-section">
    <div class="container">
        <div class="row justify-content-center">
            <div class="col-md-6">
                <div class="login-card">
                    <div class="login-header">
                        <h2 class="mb-0">Welcome Back</h2>
                        <p class="mb-0">Sign in to your account</p>
                    </div>
                    <div class="login-body">
                        <?php if (isset($loginError)): ?>
                        <div class="alert alert-danger">
                            <i class="fas fa-exclamation-circle"></i> <?php echo $loginError; ?>
                        </div>
                        <?php endif; ?>
                        
                        <form method="POST">
                            <input type="hidden" name="login" value="1">
                            <div class="mb-3">
                                <label class="form-label">Email Address</label>
                                <input type="email" class="form-control" name="email" required>
                            </div>
                            <div class="mb-3">
                                <label class="form-label">Password</label>
                                <input type="password" class="form-control" name="password" required>
                            </div>
                            <button type="submit" class="btn btn-primary btn-login">
                                <i class="fas fa-sign-in-alt"></i> Sign In
                            </button>
                        </form>
                        
                        <div class="demo-credentials">
                            <h6 class="mb-2">Demo Credentials:</h6>
                            <p class="mb-1"><strong>Email:</strong> admin@coolhomes.co.ke</p>
                            <p class="mb-0"><strong>Password:</strong> admin123</p>
                        </div>
                        
                        <div class="text-center mt-3">
                            <a href="index.html" class="btn btn-outline-primary">
                                <i class="fas fa-arrow-left"></i> Back to Website
                            </a>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</section>

<?php include 'includes/footer.php'; ?>