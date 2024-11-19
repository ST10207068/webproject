<?php
// users.php
session_start();

// Include the database connection
require 'DbConnect.php';
error_reporting(E_ALL);
ini_set('display_errors', 1);

// Check if the user is logged in as an admin
if (!isset($_SESSION['admin_logged_in'])) {
    header("Location: index.php"); // Redirect to login page if not logged in
    exit();
}

// Handle delete action via POST
if (isset($_POST['delete_id']) && is_numeric($_POST['delete_id'])) {
    $user_id = $_POST['delete_id'];
    // Prepare delete SQL
    $delete_sql = "DELETE FROM users WHERE id = ?";
    $stmt = $conn->prepare($delete_sql);
    $stmt->bind_param('i', $user_id);

    if ($stmt->execute()) {
        // Redirect with success message
        header("Location: users.php?success=true");
        exit();
    } else {
        // Redirect with error message
        header("Location: users.php?error=true");
        exit();
    }
}

// Pagination setup
$limit = 10; // Number of users per page
$page = isset($_GET['page']) ? (int)$_GET['page'] : 1;
$offset = ($page - 1) * $limit;

// Fetch users with pagination
$sql = "SELECT * FROM users LIMIT ? OFFSET ?";
$stmt = $conn->prepare($sql);
$stmt->bind_param('ii', $limit, $offset);
$stmt->execute();
$result = $stmt->get_result();

// Fetch total number of users for pagination
$total_sql = "SELECT COUNT(*) FROM users";
$total_result = $conn->query($total_sql);
$total_users = $total_result->fetch_row()[0];
$total_pages = ceil($total_users / $limit);
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Manage Users</title>
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
        }

        td a:hover {
            opacity: 0.8;
        }

        .edit-button {
            background-color: #ffc107;
        }

        .edit-button:hover {
            background-color: #e0a800;
        }

        .delete-button {
            background-color: #dc3545;
        }

        .delete-button:hover {
            background-color: #c82333;
        }

        .pagination {
            display: flex;
            justify-content: center;
            gap: 10px;
            margin-top: 20px;
        }

        .pagination a {
            padding: 8px 12px;
            text-decoration: none;
            border-radius: 5px;
            background-color: #007bff;
            color: white;
        }

        .pagination a:hover {
            background-color: #0056b3;
        }

        .pagination .active {
            background-color: #0056b3;
            font-weight: bold;
        }

        .message {
            text-align: center;
            padding: 10px;
            margin-bottom: 20px;
        }

        .message.success {
            background-color: #28a745;
            color: white;
        }

        .message.error {
            background-color: #dc3545;
            color: white;
        }
    </style>
</head>
<body>

<div class="container">
    <h1>Manage Users</h1>

    <!-- Display success or error message -->
    <?php if (isset($_GET['success'])): ?>
        <div class="message success">User deleted successfully!</div>
    <?php elseif (isset($_GET['error'])): ?>
        <div class="message error">Error deleting user.</div>
    <?php endif; ?>

    <!-- Users Table -->
    <table>
        <thead>
            <tr>
                <th>Username</th>
                <th>Email</th>
                <th>Edit</th> <!-- Separate Edit column -->
                <th>Delete</th> <!-- Separate Delete column -->
            </tr>
        </thead>
        <tbody>
    <?php if ($result->num_rows > 0): ?>
        <?php while ($row = $result->fetch_assoc()): ?>
            <tr>
                <td><?php echo htmlspecialchars($row['username']); ?></td>
                <td><?php echo htmlspecialchars($row['email']); ?></td>
                <td>
                    <a href="edit_user.php?id=<?php echo $row['id']; ?>" class="edit-button">Edit</a>
                </td>
                <td>
                    <!-- Delete Button (within a form) -->
                    <form action='users.php' method='POST' onsubmit='return confirm('Are you sure you want to delete this user?')' style='margin: 0;'>
                        <input type="hidden" name="delete_id" value="<?php echo $row['id']; ?>">
                        <button type="submit" class="delete-button">Delete</button>
                    </form>
                </td>
            </tr>
        <?php endwhile; ?>
    <?php else: ?>
        <tr>
            <td colspan="4">No users found.</td> <!-- Adjusted colspan for 4 columns -->
        </tr>
    <?php endif; ?>
</tbody>
    </table>

    <!-- Pagination -->
    <div class="pagination">
        <?php if ($page > 1): ?>
            <a href="users.php?page=<?php echo $page - 1; ?>">Previous</a>
        <?php endif; ?>

        <?php for ($i = 1; $i <= $total_pages; $i++): ?>
            <a href="users.php?page=<?php echo $i; ?>" class="<?php echo ($i == $page) ? 'active' : ''; ?>">
                <?php echo $i; ?>
            </a>
        <?php endfor; ?>

        <?php if ($page < $total_pages): ?>
            <a href="users.php?page=<?php echo $page + 1; ?>">Next</a>
        <?php endif; ?>
    </div>
</div>

</body>
</html>