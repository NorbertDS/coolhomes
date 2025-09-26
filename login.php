<?php
session_start();

// Handle login form submission
if ($_POST && isset($_POST['login'])) {
    $email = $_POST['email'];
    $password = $_POST['password'];
    
    // Demo credentials for different roles
    $demoUsers = [
        'admin@coolhomes.co.ke' => [
            'password' => 'admin123',
            'name' => 'Norbert',
            'role' => 'admin',
            'id' => 1
        ],
        'agent@coolhomes.co.ke' => [
            'password' => 'agent123',
            'name' => 'John Agent',
            'role' => 'agent',
            'id' => 2
        ],
        'buyer@coolhomes.co.ke' => [
            'password' => 'buyer123',
            'name' => 'Jane Buyer',
            'role' => 'buyer',
            'id' => 3
        ],
        'seller@coolhomes.co.ke' => [
            'password' => 'seller123',
            'name' => 'Mike Seller',
            'role' => 'seller',
            'id' => 4
        ]
    ];
    
    if (isset($demoUsers[$email]) && $demoUsers[$email]['password'] === $password) {
        $user = $demoUsers[$email];
        $_SESSION['user_id'] = $user['id'];
        $_SESSION['user_name'] = $user['name'];
        $_SESSION['user_role'] = $user['role'];
        
        // Debug: Log the session data
        error_log("Login successful for: " . $email . " Role: " . $user['role']);
        
        // Redirect based on role
        switch ($user['role']) {
            case 'admin':
                header('Location: dashboard.php');
                break;
            case 'agent':
                header('Location: agent-dashboard.php');
                break;
            case 'buyer':
                header('Location: buyer-dashboard.php');
                break;
            case 'seller':
                header('Location: buyer-dashboard.php'); // Sellers use buyer dashboard for now
                break;
            default:
                header('Location: home');
        }
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
                            <div class="row">
                                <div class="col-md-6">
                                    <p class="mb-1"><strong>Admin:</strong><br>
                                    admin@coolhomes.co.ke / admin123</p>
                                    <p class="mb-1"><strong>Agent:</strong><br>
                                    agent@coolhomes.co.ke / agent123</p>
                                </div>
                                <div class="col-md-6">
                                    <p class="mb-1"><strong>Buyer:</strong><br>
                                    buyer@coolhomes.co.ke / buyer123</p>
                                    <p class="mb-1"><strong>Seller:</strong><br>
                                    seller@coolhomes.co.ke / seller123</p>
                                </div>
                            </div>
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