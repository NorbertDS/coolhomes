<?php
session_start();

echo "<h2>Session Debug Information</h2>";
echo "<p><strong>User ID:</strong> " . (isset($_SESSION['user_id']) ? $_SESSION['user_id'] : 'Not set') . "</p>";
echo "<p><strong>User Name:</strong> " . (isset($_SESSION['user_name']) ? $_SESSION['user_name'] : 'Not set') . "</p>";
echo "<p><strong>User Role:</strong> " . (isset($_SESSION['user_role']) ? $_SESSION['user_role'] : 'Not set') . "</p>";

echo "<h3>All Session Data:</h3>";
echo "<pre>";
print_r($_SESSION);
echo "</pre>";

echo "<h3>Server Information:</h3>";
echo "<p><strong>PHP Version:</strong> " . phpversion() . "</p>";
echo "<p><strong>Session ID:</strong> " . session_id() . "</p>";
echo "<p><strong>Session Status:</strong> " . session_status() . "</p>";

echo "<h3>Test Links:</h3>";
echo "<p><a href='login.php'>Go to Login</a></p>";
echo "<p><a href='agent-dashboard.php'>Go to Agent Dashboard</a></p>";
echo "<p><a href='buyer-dashboard.php'>Go to Buyer Dashboard</a></p>";
echo "<p><a href='dashboard.php'>Go to Admin Dashboard</a></p>";
?>
