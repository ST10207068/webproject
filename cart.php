<?php 
session_start();

// Include the database connection
include('DbConnect.php'); // Make sure the path is correct

// Check if the cart session variable is set, if not, create an empty array
if (!isset($_SESSION['cart'])) {
    $_SESSION['cart'] = [];
}

// Check if the item and price are passed via the URL for adding items
if (isset($_GET['item']) && isset($_GET['price'])) {
    // Get item and price from the URL (ensure price is a valid float)
    $item = htmlspecialchars($_GET['item']);
    $price = floatval($_GET['price']); // Convert price to float

    // Add the item to the cart session array with the updated price
    $_SESSION['cart'][] = [
        'item' => $item,
        'price' => $price,
    ];
}

// Check if an item needs to be removed from the cart
if (isset($_GET['remove'])) {
    $removeIndex = (int)$_GET['remove'];
    if (isset($_SESSION['cart'][$removeIndex])) {
        unset($_SESSION['cart'][$removeIndex]);
        // Reindex the array after removal
        $_SESSION['cart'] = array_values($_SESSION['cart']);
    }
}

// Calculate total price
$totalPrice = 0;
foreach ($_SESSION['cart'] as $cartItem) {
    $totalPrice += $cartItem['price'];
}

// Allowed locations (List of towns/cities/suburbs in Gauteng)
$allowedLocations = [
    "Braamfontein", "NewTown", "ParkTown", "JHB CBD", "Pretoria", "Sandton", "Midrand", "Alexandra", "Edenvale",
    "Centurion", "Rosebank", "Maboneng", "Randburg", "Fourways", "Kempton Park", "Bedfordview", "Boksburg",
    "Germiston", "Tembisa", "Soweto", "Kyalami", "Hilbrow", "Magaliesburg", "Vanderbijlpark", "Heidelberg"
];

$errorMessage = ''; // Variable to store error message

// Handle checkout process
if ($_SERVER['REQUEST_METHOD'] === 'POST' && isset($_POST['payment_type'], $_POST['address'])) {
    // Collect payment type and address
    $paymentType = htmlspecialchars($_POST['payment_type']);
    $address = htmlspecialchars($_POST['address']);
    
    // Validate if the address is in Gauteng
    $addressValid = false;
    foreach ($allowedLocations as $location) {
        if (stripos($address, $location) !== false) {
            $addressValid = true;
            break;
        }
    }

    if (!$addressValid) {
        $errorMessage = "We can only deliver within Gauteng Province. Please enter a valid address within Gauteng.";
    } else {
        // Save cart items to the database if the address is valid
        foreach ($_SESSION['cart'] as $cartItem) {
            // Prepare and bind
            $stmt = $conn->prepare("INSERT INTO cart (ImageID, Location, Price) VALUES (?, ?, ?)");
            $stmt->bind_param("ssi", $cartItem['item'], $address, $cartItem['price']); // Adjust types if needed

            // Execute the statement
            $stmt->execute();
        }

        // Clear the cart after purchase
        $_SESSION['cart'] = [];

        // Show thank you message (JavaScript to handle full-screen message)
        echo "<script>
                alert('Thank you for buying from us! The owner will contact you soon.');
              </script>";
    }
}

// Close the database connection (optional, as it will close when the script ends)
$conn->close();
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Your Cart</title>
    <style>
        /* Your existing CSS for cart display */
        body {
            font-family: Arial, sans-serif;
            margin: 0;
            padding: 20px;
            background-color: #f4f4f4;
        }
        h1 {
            text-align: center;
            color: #333;
        }
        .cart-item {
            background-color: #fff;
            padding: 10px;
            margin: 10px 0;
            border-radius: 5px;
            box-shadow: 0 2px 5px rgba(0, 0, 0, 0.1);
        }
        .total {
            font-weight: bold;
            font-size: 1.2em;
            margin-top: 20px;
        }
        .checkout-button {
            background-color: #4CAF50;
            color: white;
            padding: 10px 15px;
            border: none;
            border-radius: 5px;
            cursor: pointer;
            text-align: center;
            display: block;
            width: 100%;
            text-decoration: none;
        }
        .checkout-button:hover {
            background-color: #45a049;
        }
        .remove-button {
            color: red;
            text-decoration: none;
            float: right;
        }
        .form-section {
            margin-top: 20px;
            padding: 15px;
            background-color: #fff;
            border-radius: 5px;
            box-shadow: 0 2px 5px rgba(0, 0, 0, 0.1);
        }
        input[type="text"], input[type="submit"] {
            width: 100%;
            padding: 10px;
            margin-top: 5px;
            margin-bottom: 10px;
        }
        .error-message {
            color: red;
            font-weight: bold;
        }
        .continue-shopping {
            background-color: #f4f4f4;
            color: #333;
            text-align: center;
            display: inline-block;
            padding: 10px 20px;
            text-decoration: none;
            margin-top: 20px;
            border-radius: 5px;
        }
        .continue-shopping:hover {
            background-color: #ddd;
        }
    </style>
</head>
<body>

<h1>Your Cart</h1>

<?php if (empty($_SESSION['cart'])): ?>
    <p>Your cart is empty.</p>
<?php else: ?>
    <?php foreach ($_SESSION['cart'] as $index => $cartItem): ?>
        <div class="cart-item">
            <!-- Display the item name -->
            <p>Item: <?php echo htmlspecialchars($cartItem['item']); ?></p>
            <!-- Display the price -->
            <p>Price: R<?php echo number_format($cartItem['price'], 2); ?></p>
            <!-- Remove button -->
            <a class="remove-button" href="?remove=<?php echo $index; ?>">Remove</a>
        </div>
    <?php endforeach; ?>

    <!-- Display the total price -->
    <div class="total">Total: R<?php echo number_format($totalPrice, 2); ?></div>

    <a href="browse_kotas.php" class="continue-shopping">Continue Shopping</a>

    <div class="form-section">
        <h2>Checkout</h2>
        <form method="POST" action="">

            <label for="payment_type">Payment Type:</label>
            <select id="payment_type" name="payment_type" required>
                <option value="">Select a payment method</option>
                <option value="cash">Cash</option>
                <option value="eft">EFT</option>
                <option value="visa">Visa</option>
                <option value="ozow">Ozow</option>
            </select>

            <label for="address">Delivery Address:</label>
            <input type="text" id="address" name="address" required>

            <?php if ($errorMessage): ?>
                <div class="error-message"><?php echo $errorMessage; ?></div>
            <?php endif; ?>

            <input type="submit" value="Buy">
        </form>
    </div>
<?php endif; ?>

</body>
</html>
