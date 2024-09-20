<?php
// Start session to handle user information
session_start();

// Check if the form is submitted via POST
if ($_SERVER["REQUEST_METHOD"] == "POST") {
    // Collect and sanitize the form data
    $username = htmlspecialchars(trim($_POST['username']));
    $password = htmlspecialchars(trim($_POST['password']));
    
    // Validate the credentials by reading from users.txt
    $usersFile = 'users.txt';
    $validCredentials = false;

    if (file_exists($usersFile)) {
        $file = fopen($usersFile, 'r');
        if ($file) {
            while (($line = fgets($file)) !== false) {
                // Trim any whitespace
                $line = trim($line);
                
                // Split username and password and check for valid format
                $credentials = explode(',', $line);
                if (count($credentials) == 2) {
                    list($valid_username, $valid_password) = $credentials;

                    // Check if username and password match
                    if ($username === $valid_username && $password === $valid_password) {
                        $validCredentials = true;
                        break;
                    }
                }
            }
            fclose($file);
        } else {
            echo "Error opening file.";
            exit();
        }
    } else {
        echo "User credentials file not found.";
        exit();
    }

    // Redirect to the dashboard page if credentials are valid
    if ($validCredentials) {
        // Start session and set username
        $_SESSION['username'] = $username;
        header("Location: dashboard.php");
        exit();
    } else {
        header("Location: failed.html");
        exit();
    }
}
?>
