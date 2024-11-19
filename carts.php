<?php
// cart.php
session_start();

// Include the database connection
require 'DbConnect.php';

// Check if the user is logged in as an admin
if (!isset($_SESSION['admin_logged_in'])) {
    header("Location: index.php"); // Redirect to login page if not logged in
    exit();
}

// Fetch all cart items from the database
$sql = "SELECT * FROM cart"; // Assuming the table for cart is called 'cart'
$result = $conn->query($sql);

// Handle alert owner action (for now, this just shows an alert)
if (isset($_GET['alert'])) {
    $item_id = $_GET['alert'];
    // Here you can add your alert mechanism, e.g., send an email or create a notification
    echo "<script>alert('Owner has been alerted for item ID: $item_id');</script>";
}
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Cart Items</title>
    <style>
        body {
            font-family: Arial, sans-serif;
            background-color: #f4f4f9;
            padding: 20px;
        }

        h1 {
            text-align: center;
            margin-bottom: 20px;
            color: #333;
        }

        .container {
            width: 100%;
            max-width: 1200px;
            margin: 0 auto;
            background-color: #fff;
            border-radius: 8px;
            box-shadow: 0 4px 10px rgba(0, 0, 0, 0.1);
            padding: 30px;
        }

        table {
            width: 100%;
            border-collapse: collapse;
            margin-bottom: 20px;
        }

        th, td {
            padding: 12px;
            text-align: left;
            border-bottom: 1px solid #ddd;
        }

        th {
            background-color: #007bff;
            color: white;
        }

        td a {
            text-decoration: none;
            color: white;
            padding: 8px 15px;
            border-radius: 5px;
            display: inline-block;
            cursor: pointer;
        }

        td a:hover {
            opacity: 0.8;
        }

        .alert-button {
            background-color: #ffc107;
            cursor: pointer;
            transition: background-color 0.3s ease;
        }

        .alert-button:hover {
            background-color: #e0a800;
        }

        .action-buttons {
            display: flex;
            gap: 10px;
        }
    </style>
</head>
<body>

<div class="container">
    <h1>Items Bought</h1>

    <!-- Cart Table -->
    <table>
        <thead>
            <tr>
                <th>Location</th>
                <th>Price</th>
                <th>Actions</th>
            </tr>
        </thead>
        <tbody>
            <?php if ($result->num_rows > 0): ?>
                <?php while ($row = $result->fetch_assoc()): ?>
                    <tr>
                        <td><?php echo htmlspecialchars($row['Location']); ?></td>
                        <td><?php echo htmlspecialchars($row['Price']); ?> ZAR</td>
                        <td class="action-buttons">
                            <!-- Alert Owner Button -->
                            <a href="cart.php?alert=<?php echo $row['id']; ?>" class="alert-button" onclick="return confirm('Are you sure you want to alert the owner for this item?')">Alert Owner</a>
                        </td>
                    </tr>
                <?php endwhile; ?>
            <?php else: ?>
                <tr>
                    <td colspan="3">No items in the cart.</td>
                </tr>
            <?php endif; ?>
        </tbody>
    </table>
</div>

</body>
</html>