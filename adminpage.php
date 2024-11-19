<?php
// adminpage.php
session_start();

// Check if the user is logged in as an admin
if (!isset($_SESSION['admin_logged_in'])) {
    header("Location: index.php"); // Redirect to homepage or login page
    exit();
}
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Admin Dashboard</title>
    <style>
        /* Basic styles for the admin page */
        body {
            font-family: Arial, sans-serif;
            background-color: #f4f4f9;
            margin: 0;
            padding: 0;
            display: flex;
            justify-content: center;
            align-items: center;
            height: 100vh;
        }

        h1 {
            color: #333;
            text-align: center;
            font-size: 2rem;
            margin-bottom: 20px;
        }

        .admin-container {
            width: 100%;
            max-width: 1200px;
            background-color: #fff;
            border-radius: 10px;
            box-shadow: 0 4px 10px rgba(0, 0, 0, 0.1);
            padding: 40px;
            text-align: center;
        }

        .button-container {
            display: flex;
            justify-content: space-around;
            gap: 20px;
            margin-top: 40px;
        }

        .button {
            position: relative;
            width: 200px;
            height: 200px;
            border-radius: 10px;
            overflow: hidden;
            cursor: pointer;
            box-shadow: 0 4px 10px rgba(0, 0, 0, 0.3);
            transition: transform 0.3s ease-in-out;
        }

        .button img {
            width: 100%;
            height: 100%;
            object-fit: cover;
            filter: blur(8px);
            transition: filter 0.3s ease;
        }

        .button:hover img {
            filter: blur(0);
        }

        .button-text {
            position: absolute;
            top: 50%;
            left: 50%;
            transform: translate(-50%, -50%);
            color: white;
            font-size: 1.5rem;
            font-weight: bold;
            text-shadow: 2px 2px 4px rgba(0, 0, 0, 0.5);
        }

        .button:hover {
            transform: scale(1.1);
        }

        /* Logout button */
        .logout-button {
            display: block;
            margin-top: 30px;
            padding: 12px 30px;
            background-color: #007bff;
            color: white;
            font-size: 1rem;
            font-weight: bold;
            text-align: center;
            border-radius: 5px;
            text-decoration: none;
            width: 200px;
            margin-left: auto;
            margin-right: auto;
            transition: background-color 0.3s ease;
        }

        .logout-button:hover {
            background-color: #0056b3;
        }
    </style>
</head>
<body>

<div class="admin-container">
    <h1>Welcome, Admin</h1>

    <div class="button-container">
        <!-- Users Button -->
        <a href="users.php" class="button">
            <img src="images/users.jpg" alt="Users">
            <div class="button-text">Users</div>
        </a>

        <!-- Kota Request Button -->
        <a href="kotarequest.php" class="button">
            <img src="images/kotarequest.jpg" alt="Kota Request">
            <div class="button-text">Kota Request</div>
        </a>

        <!-- Cart Button -->
        <a href="carts.php" class="button">
            <img src="images/cart.jpg" alt="Cart">
            <div class="button-text">Cart</div>
        </a>
    </div>

    <a href="logout.php" class="logout-button">Logout</a>
</div>

</body>
</html>