<?php
require 'DbConnect.php'; // Include database connection

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $username = $_POST['username'];
    $email = $_POST['email'];
    $password = password_hash($_POST['password'], PASSWORD_DEFAULT); // Hash password

    // Check if username or email already exists
    $checkUser = $conn->prepare("SELECT * FROM users WHERE username = ? OR email = ?");
    $checkUser->bind_param("ss", $username, $email);
    $checkUser->execute();
    $result = $checkUser->get_result();

    if ($result->num_rows > 0) {
        echo "<script>alert('Username or email already exists. Please try logging in.'); window.location.href = 'index.php';</script>";
    } else {
        // Insert new user
        $stmt = $conn->prepare("INSERT INTO users (username, email, password) VALUES (?, ?, ?)");
        $stmt->bind_param("sss", $username, $email, $password);

        if ($stmt->execute()) {
            echo "<script>alert('Registration successful! Please log in.'); window.location.href = 'index.php';</script>";
        } else {
            echo "<script>alert('Registration failed. Please try again.'); window.location.href = 'index.php';</script>";
        }
        $stmt->close();
    }

    $checkUser->close();
    $conn->close();
}
?>