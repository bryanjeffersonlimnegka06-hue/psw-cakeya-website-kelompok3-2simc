<?php
// Start a secure session
session_start();

// Import your existing database connection file
require_once('../database connector/connect.php'); 

// Process data only if the form is submitted via POST
if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    // Sanitize input values
    $inputUser = trim($_POST['username'] ?? '');
    $inputPass = trim($_POST['password'] ?? '');

    if (!empty($inputUser) && !empty($inputPass)) {
        
        // Escape the strings to protect against basic SQL Injection bugs
        $safeUser = $connect->real_escape_string($inputUser);
        $safePass = $connect->real_escape_string($inputPass);

        // SQL Query tailored to your schema: changed 'user_id' to 'id'
        $sql = "SELECT id, username FROM users WHERE username = '$safeUser' AND password = '$safePass' LIMIT 1";
        $result = $connect->query($sql);

        if ($result && $result->num_rows === 1) {
            $user = $result->fetch_assoc();

            // Success! Setup persistent authentication session variables
            $_SESSION['admin_logged_in'] = true;
            $_SESSION['admin_user']      = $user['username'];
            // Fetching 'id' from the database result instead of 'user_id'
            $_SESSION['admin_id']        = (int)$user['id'];

            // Close connection before routing away
            $connect->close();

            // Redirect smoothly to your main product list dashboard layout
            header("Location: http://localhost/Admin-Panel/product-list/admin-panel.html");
            exit;
        } else {
            $error_message = "Invalid username or password.";
        }
    } else {
        $error_message = "Please fill in all fields.";
    }
}

// Close connection if error occurs
if (isset($connect)) {
    $connect->close();
}

// Redirect back to UI along with an error description parameter
header("Location: login.html?error=" . urlencode($error_message ?? 'Authentication failed.'));
exit;
?>