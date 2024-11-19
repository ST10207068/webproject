<?php
require 'DbConnect.php'; // Include database connection
session_start();

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $usernameOrEmail = $_POST['username'];
    $password = $_POST['password'];

    // Prepare a statement to fetch user by username or email
    $stmt = $conn->prepare("SELECT * FROM users WHERE username = ? OR email = ?");
    $stmt->bind_param("ss", $usernameOrEmail, $usernameOrEmail);
    $stmt->execute();
    $result = $stmt->get_result();

    if ($result->num_rows == 1) {
        $user = $result->fetch_assoc();

        // Verify password
        if (password_verify($password, $user['password'])) {
            $_SESSION['username'] = $user['username'];
            echo "<script>alert('Login successful!'); window.location.href = 'welcome.php';</script>";
        } else {
            echo "<script>alert('Incorrect password.'); window.location.href = 'index.php';</script>";
        }
    } else {
        echo "<script>alert('Username or email not found.'); window.location.href = 'index.php';</script>";
    }

    $stmt->close();
    $conn->close();
}
?>