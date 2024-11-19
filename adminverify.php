<?php
session_start();

// Include database connection
require 'DbConnect.php'; // This will include your database connection details

// Check if the form is submitted
if ($_SERVER['REQUEST_METHOD'] == 'POST') {
    // Retrieve form data
    $email = $_POST['email'];
    $password = $_POST['password'];

    // Prepare SQL query to check if the email and password match an admin
    $sql = "SELECT * FROM admin WHERE email = ? AND password = ?";
    $stmt = $conn->prepare($sql);
    
    // Bind the parameters to the query
    $stmt->bind_param('ss', $email, $password); // 'ss' means both parameters are strings
    $stmt->execute();
    $result = $stmt->get_result();

    // Check if any matching admin is found
    if ($result->num_rows > 0) {
        // Admin found, set session variable and redirect to admin page
        $_SESSION['admin_logged_in'] = true;
        header("Location: adminpage.php"); // Redirect to admin dashboard
        exit();
    } else {
        // Admin not found, display an error message
        echo "Invalid email or password.";
    }

    // Close the prepared statement
    $stmt->close();
    
    // Close the database connection
    $conn->close();
}
?>