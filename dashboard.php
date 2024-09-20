<?php
session_start();
// Check if user is logged in
if (!isset($_SESSION['username'])) {
    header("Location: login.html");
    exit();
}

$username = htmlspecialchars($_SESSION['username']);
$loginTime = isset($_SESSION['login_time']) ? $_SESSION['login_time'] : date("Y-m-d H:i:s");

// Fetch user count from the Lambda function via API Gateway
$api_url = "https://np0u5x1lz6.execute-api.us-east-1.amazonaws.com/prod";
$user_count = "N/A";

try {
    // Initialize cURL session
    $ch = curl_init($api_url);
    
    // Set cURL options
    curl_setopt($ch, CURLOPT_RETURNTRANSFER, true); // Return the response as a string
    curl_setopt($ch, CURLOPT_FOLLOWLOCATION, true); // Follow redirects

    // Execute cURL request
    $response = curl_exec($ch);

    // Check for cURL errors
    if (curl_errno($ch)) {
        throw new Exception('cURL error: ' . curl_error($ch));
    }

    // Decode the JSON response
    $data = json_decode($response, true);

    // Check if the 'body' is set
    if (isset($data['body'])) {
        $body_data = json_decode($data['body'], true);
        // Check if user_count is available
        $user_count = isset($body_data['user_count']) ? $body_data['user_count'] : "No user count data found";
    } else {
        $user_count = "No body data found";
    }

    // Close cURL session
    curl_close($ch);
} catch (Exception $e) {
    // Handle error
    $user_count = "Error fetching user count: " . $e->getMessage();
}
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Student Dashboard</title>
    <link rel="stylesheet" href="dashboard.css">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0-beta3/css/all.min.css">
</head>
<body>
    <header class="header">
        <div class="logo">🚀 Nebula</div>
        <div class="user-info">
            <i class="fas fa-user-circle"></i>
            <span>Welcome, <?php echo $username; ?></span>
            <small>Logged in at: <?php echo $loginTime; ?></small>
        </div>
    </header>

    <!-- Navigation Menu -->
    <nav class="menu">
        <ul>
            <li><a href="dashboard.php">Dashboard</a></li>
            <li><a href="newuser.html">Create New User</a></li>
            <li><a href="viewusers.html">View Users</a></li>
        </ul>
    </nav>

    <main class="dashboard">
        <div class="dashboard-header">
            <h2>Student Dashboard</h2>
            <p><strong>Number of users: <?php echo $user_count; ?></strong></p>
        </div>

        <!-- Announcements or Recent Activities Section -->
        <div class="announcements">
            <h3>Announcements</h3>
            <p>No new announcements at this time.</p>
        </div>
    </main>

    <footer class="footer">
        &copy; 2024 Nebula. All rights reserved.
    </footer>
</body>
</html>
