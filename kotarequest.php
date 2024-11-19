<?php
// kotarequest.php
session_start();

// Include the database connection
require 'DbConnect.php';

// Check if the user is logged in as an admin
if (!isset($_SESSION['admin_logged_in'])) {
    header("Location: index.php"); // Redirect to login page if not logged in
    exit();
}

// Handle delete action
if (isset($_GET['delete'])) {
    $item_id = $_GET['delete'];
    // Prepare delete SQL
    $delete_sql = "DELETE FROM items WHERE id = ?";
    $stmt = $conn->prepare($delete_sql);
    $stmt->bind_param('i', $item_id);
    $stmt->execute();
    $stmt->close();
    header("Location: kotarequest.php"); // Refresh the page after deletion
    exit();
}

// Handle approve action
if (isset($_GET['approve'])) {
    $item_id = $_GET['approve'];
    
    // Delete the item from the items table
    $delete_sql = "DELETE FROM items WHERE id = ?";
    $stmt = $conn->prepare($delete_sql);
    $stmt->bind_param('i', $item_id);
    $stmt->execute();
    $stmt->close();

    // Get the item details to notify the user
    $select_sql = "SELECT * FROM items WHERE id = ?";
    $stmt = $conn->prepare($select_sql);
    $stmt->bind_param('i', $item_id);
    $stmt->execute();
    $result = $stmt->get_result();
    $item = $result->fetch_assoc();
    $user_email = $item['user_email']; // Assuming 'user_email' exists in the items table
    $item_name = $item['item_name']; // Assuming 'item_name' exists in the items table

    // Send notification to user (you can implement actual email or message here)
    // Mail function (example, assuming you've set up your mail server)
    mail($user_email, "Kota Request Approved", "Your kota request for '$item_name' has been approved!");

    // Show approval message
    echo "<script>
            alert('The kota for \"$item_name\" has been approved. The user will be notified.');
            window.location = 'kotarequest.php'; // Redirect back after approval
          </script>";
    exit();
}

// Fetch all items from the database
$sql = "SELECT * FROM items";
$result = $conn->query($sql);
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Kota Requests</title>
    <style>
        body {
            font-family: Arial, sans-serif;
            background-color: #f4f4f9;
            padding: 20px;
        }

        h1 {
            text-align: center;
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
            padding: 5px 10px;
            border-radius: 5px;
        }

        td a:hover {
            opacity: 0.8;
        }

        .approve-button {
            background-color: #28a745;
        }

        .approve-button:hover {
            background-color: #218838;
        }

        .delete-button {
            background-color: #dc3545;
        }

        .delete-button:hover {
            background-color: #c82333;
        }

        /* Full-screen message for approval */
        .message-box {
            position: fixed;
            top: 0;
            left: 0;
            width: 100%;
            height: 100%;
            background-color: rgba(0, 0, 0, 0.7);
            color: white;
            display: flex;
            justify-content: center;
            align-items: center;
            z-index: 999;
            font-size: 1.5rem;
            text-align: center;
        }
    </style>
</head>
<body>

<div class="container">
    <h1>Kota Requests</h1>

    <!-- Items Table -->
    <table>
        <thead>
            <tr>
                <th>Price</th>
                <th>Location</th>
                <th>Number</th>
                <th>Actions</th>
            </tr>
        </thead>
        <tbody>
            <?php if ($result->num_rows > 0): ?>
                <?php while ($row = $result->fetch_assoc()): ?>
                    <tr>
                        <td><?php echo htmlspecialchars($row['price']); ?></td>
                        <td><?php echo htmlspecialchars($row['location']); ?></td>
                        <td><?php echo htmlspecialchars($row['number']); ?></td>
                        <td>
                            <!-- Approve Button -->
                            <a href="kotarequest.php?approve=<?php echo $row['id']; ?>" class="approve-button" onclick="return confirm('Are you sure you want to approve this kota request?')">Approve</a>
                            <!-- Delete Button -->
                            <a href="kotarequest.php?delete=<?php echo $row['id']; ?>" class="delete-button" onclick="return confirm('Are you sure you want to delete this item?')">Delete</a>
                        </td>
                    </tr>
                <?php endwhile; ?>
            <?php else: ?>
                <tr>
                    <td colspan="4">No items found.</td>
                </tr>
            <?php endif; ?>
        </tbody>
    </table>
</div>

</body>
</html>